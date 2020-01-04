<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Product extends CI_BASE_Controller
{
    public $cache_key = 'product_count'; //count all product
    public $flash_sess_name = 'product_done';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel', 'Product');
        $this->load->model('CategoryModel', 'Category');
    }
    
    public function index()
    {
        $this->data['title'] = getSiteTitle($this->router->class); 
        $this->load->library('pagination');
        $config = [];
        $get_vars = $this->input->get();
        if (is_array($get_vars)) {
            $config['suffix'] = '?' . http_build_query($get_vars, '', "&");
        }
        $config['base_url'] = DOMAIN_PATH . $this->router->class . '/index';
        $config['first_url'] = $config['base_url'] . (isset($config['suffix']) ? $config['suffix'] : '');

        if (! $total_rows = $this->cache->get($this->cache_key)) {
            $total_rows =  $this->Product->getProductCount();
            if (!empty($total_rows['error'])){
                $this->cache->save($this->cache_key, $total_rows, 24*60*60);
            }
        }
        //echo ($total_rows);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 5;
        $param_like = [];
        $this->pagination->initialize($config);
       
        $inputData = ['offset' => $this->uri->segment('3'),
                      'per_page' => $config['per_page'],
                     ];
        $productList = $this->Product->getProductList($inputData);
        $this->data['result'] = [];
        if (empty($productList['error'])) {
            $this->data['result'] = $productList;
        }
        $this->load->view('product_view', $this->data);
    }

    public function addProduct()
    {
        $this->data['title'] = getSiteTitle('Add Product'); 
        $this->add_edit_product();
    }
    
    public function publishProduct()
    {
        if ($this->input->post('action', true)=='publish') {
            $this->modifyit('product', 'status', 'id');
        }
    }
    
    public function getProductRowData($id)
    {
        $inputData = ['where'=>['id'=>$id],
                     'return' => 2
        ];
        
        return $this->Product->getProduct($inputData);
    }
    
    public function editProduct()
    {
        $id = $this->uri->segment(3);
        if ($id<1) {
            $this->someThingWrong('something went wrong')    ;
        }
        $this->data['title'] = getSiteTitle('Edit Product'); 
        $this->add_edit_product($id);
    }
    
    public function add_edit_product($id=0)
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        if ($id>0) {
            $this->data['product_row_data'] = $this->getProductRowData($id);
        } else {
            $this->data['product_row_data'] = [];
        }
        $categorResult = $this->Category->getCategoryAll();
        
        if (empty($categorResult['error'])){
            $this->data['category'] = $categorResult;
        } else {
            $this->data['category'] = [];
        }
        
        $this->data['category_attached'] = [];
        if ($id>0) {
            $inputData = ['productId'=>$id];
            $this->data['category_attached'] = $this->Product->getProductCategoryList($inputData);
        }

        $this -> form_validation -> set_rules('title', 'Product Title', 'trim|required|max_length[100]|strtolower');
        if ($this->input->post('product_id') == '') {
            $this -> form_validation -> set_rules('slug', 'slug', 'trim|required|is_unique[product.slug]');
        } else {
            if ($this->input->post('product_id') != '' && $this->input->post('old_slug') != $this->input->post('slug')) {
                $this -> form_validation -> set_rules('slug', 'slug', 'trim|required|is_unique[product.slug]');
            }
        }
        $this -> form_validation -> set_rules('summary', 'Summary', 'trim|max_length[500]');
        $this -> form_validation -> set_rules('description', 'Description', 'trim');
        $this -> form_validation -> set_rules('price', 'Price', 'trim'); // add float value check
        $this -> form_validation -> set_rules('category_term[]', 'Category', 'trim|required');


        if ($this -> form_validation -> run() == false) {
            $this->data['errors'] = $this->form_validation->error_array();

            $this->load->view('product_add_edit_view', $this->data);
        } else {
            $product_data = [];
            $this->data['image_error'] = [];
            if (!empty($_FILES['p_image']['tmp_name'])) {
                $img_url = $this ->input-> post('p_image_path', true);
                $oldimg_url = $img_url;
                $p_image_path = PRODUCT_IMG_ABS_PATH;
                $config = [];
                $config['upload_path'] = $p_image_path . date('Y').'/'.date('m');

                if (file_exists($p_image_path.date('Y')) == false) {
                    mkdir($p_image_path.date('Y'), 0777);
                }

                if (file_exists($p_image_path.date('Y').'/'.date('m'))==false) {
                    mkdir($p_image_path.date('Y').'/'.date('m'), 0777);
                }

                //$config['upload_path'] = celeb_IMG_ABS_PATH;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']    = '800';
                $config['max_width']  = '1200';
                $config['max_height']  = '1200';
                $config['min_width']  = '200';
                $config['min_height']  = '100';

                $this->load->library('upload', $config);

                if (! $this->upload->do_upload('p_image')) {
                    $this->data['image_error'] = array('error' => $this->upload->display_errors());
                } else {
                    $image_data = array('upload_data' => $this->upload->data());
                    $logo = $image_data['upload_data']['file_name'];
                    $parts        = explode('.', $logo);
                    $ext        = array_pop($parts);
                    $filename    = array_shift($parts);

                    $resize_arr = array(
                    0=>array('new_name'=>$config['upload_path'].'/'.$filename.'_'.'500x400.'.$ext ,'width'=>500, 'height'=>400 ),
                    1=>array('new_name'=>$config['upload_path'].'/'.$filename.'_'.'100x80.'.$ext ,'width'=>100, 'height'=>80 ),
                    2=>array('new_name'=>$config['upload_path'].'/'.$filename.'_'.'300x275.'.$ext ,'width'=>300, 'height'=>275 ),
                    3=>array('new_name'=>$config['upload_path'].'/'.$filename.'_'.'620x400.'.$ext ,'width'=>620, 'height'=>400 ),
                    4=>array('new_name'=>$config['upload_path'].'/'.$filename.'_'.'314x346.'.$ext ,'width'=>314, 'height'=>346 ),

                    );

                    foreach ($resize_arr as $e) {
                        $this->resizeImage($config['upload_path'].'/'.$logo, $e['new_name'], $e['width'], $e['height']);
                    }
                    $img_url = date('Y').'/'.date('m').'/'.$filename.'_'.'500x400.'.$ext;
                    $img_url_del = str_ireplace('_500x400', '', $img_url);
                    if (file_exists($p_image_path.$img_url_del)==true) {
                        unlink($p_image_path.$img_url_del);
                    }
                    $product_data ['img'] = $img_url;
                    if ($oldimg_url!='') {
                        $image1 = str_ireplace('_500x400', '', $oldimg_url);
                        $image2 = str_ireplace('_500x400', '_100x80', $oldimg_url);
                        $image3 = str_ireplace('_500x400', '_300x275', $oldimg_url);
                        $image4 = str_ireplace('_500x400', '_620x400', $oldimg_url);
                        $image5 = str_ireplace('_500x400', '_314x346', $oldimg_url);

                        if (file_exists($p_image_path.$oldimg_url)==true) {
                            unlink($p_image_path.$oldimg_url);
                        }
                        if (file_exists($p_image_path.$image1)==true) {
                            unlink($p_image_path.$image1);
                        }
                        if (file_exists($p_image_path.$image2)==true) {
                            unlink($p_image_path.$image2);
                        }
                        if (file_exists($p_image_path.$image3)==true) {
                            unlink($p_image_path.$image3);
                        }
                        if (file_exists($p_image_path.$image4)==true) {
                            unlink($p_image_path.$image4);
                        }
                        if (file_exists($p_image_path.$image5)==true) {
                            unlink($p_image_path.$image5);
                        }
                    }
                }
                if (count($this->data['image_error'])>0) {
                    $this->data['image_error'] = $this->data['image_error']['error'];
                    $this->load->view('product_add_edit_view', $this->data);
                    return;
                }
            }
            //echo '<pre>';print_r($this->input->post(NULL,TRUE));exit;
            foreach ($this->input->post(null, true) as $k=>$e) {
                if ($k == 'submit' || $k == 'save' || $k == 'product_id' || $k == 'old_slug' || $k=='p_image_path') {
                    continue;
                }
                if (!is_array($e)) {
                    $product_data[$k] = trim($e);
                } else {
                    $product_data[$k] = implode(',', $e);
                }
            }
            $sess_title = (isset($product_data['title'])?$product_data['title']:'');
            $sess_id = 0;
                
            //maintain relation of term and post
            $insert_term_p_data = array();
            if (isset($product_data['category_term'])) {
                if (($product_data['category_term'] != $product_data['category_term_old'])) {
                    $cat_term_array =  explode(',', $product_data['category_term']);
                    foreach ($cat_term_array as  $cat_term_array_row) {
                        $insert_term_p_data[]=$cat_term_array_row;
                    }
                }
            }
            unset($product_data['category_term']);
            unset($product_data['category_term_old']);
            unset($product_data['ajax_names']);
            //echo '<pre>';print_r($insert_term_p_data);exit;
            if ($this->input->post('product_id') == '') /**add new record */
            {
                $product_data['status'] = '0';
                $product_data['createdBy'] = $this->userId;
                $product_data['createdAt'] = date('Y-m-d H:m:s');
                $ret = $this->pojo->insertPojoReturnId($this->pojo->writeDb1, 'product', $product_data);
                if ($ret && !empty($insert_term_p_data)) {//insert category and product elation
                    $this->addtermsandproduct($ret, $insert_term_p_data);
                }

            } else {
                $sess_id = $this->input->post('product_id');
                $id= $this->data['product_row_data']['id'];
                $product_data['updatedBy'] = $this->userId;
                $product_data['updatedAt'] = date('Y-m-d H:m:s');
                
                $inputData = ['where' => ['id'=>$id],
                              'data' => $product_data
                ];
                $response = $this->Product->updateProduct($inputData);
                if (empty($response['error'])) {
                    $this->logIt($product_data, 'product');
                    $ret = 1;
                }
                if (!empty($insert_term_p_data)) {//insert category and product after delete

                    $this->pojo->deleteRow($this->pojo->writeDb1, 'product_category', ['productId'=>$id]);
                    $this->addtermsandproduct($id, $insert_term_p_data);
                }
            }

            if ($ret) {
                $this->delete_cache($this->cache_key);
                $this->setFlash($this->flash_sess_name, $sess_id, $sess_title);
            }
            
            redirect(DOMAIN_PATH . $this->router->class, 'refresh');
        }
    }
    private function addtermsandproduct($p_id, $terms)
    {
        $tdata = [];
        foreach ($terms as $row) {
            $tdata[] = ['productId'=>$p_id,'categoryId'=>$row];
        }
        
        return $this->pojo->insertPojos($this->pojo->writeDb1, 'product_category', $tdata);
    }
}
