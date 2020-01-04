<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Category extends CI_BASE_Controller
{
    public $cache_key = 'category_count';
    public $flash_sess_name = 'category_done';
    
    public function __construct()
    {
        parent::__construct();
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
        $config['first_url'] = $config['base_url'] . (isset($config['suffix'])?$config['suffix']:'');

        if (! $total_rows = $this->cache->get($this->cache_key)) {
            
            $total_rows =  $this->Category->getCategoryCount();
            if (!empty($total_rows['error'])){
                $this->cache->save($this->cache_key, $total_rows, 24*60*60);
            }
        }
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 5;
        $param_like = [];
        
        if ($this->input->get('search-term', true)) {
            $param_like = ['both'=> ['title'=>$this->input->get('search-term', true)]];
        } else {
            $this->pagination->initialize($config);
        }
        $inputData = ['per_page' => $config['per_page'],
                      'param_like' => $param_like,
                      'offset' => $this->uri->segment('3')
        ];
        $categoryList = $this->Category->getCategoryList($inputData);
        $this->data['result'] = [];
        if (empty($categoryList['error'])) {
            $this->data['result'] = $categoryList;
        }
        
        $this->load->view('category_view', $this->data);
    }

    public function addCategory()
    {
        $this->data['title'] = getSiteTitle('Add Category'); 
        $this->add_edit_category();
    }
    
    public function publishCategory()
    {
        if ($this->input->post('action', true) == 'publish') {
            $this->modifyit('category', 'status', 'id');
        }
    }
    
    public function editCategory()
    {
        $id = $this->uri->segment(3);
        if ($id<1) {
            $this->someThingWrong('something went wrong')    ;
        }
        $this->data['title'] = getSiteTitle('Edit Category'); 
        $this->add_edit_category($id);
    }
    
    public function getCategoryRowData($id)
    {
        $inputData = ['where'=>['id'=>$id],
                      'return' => 2
        ];
        
        return $this->Category->getCategory($inputData);
    }
    
    public function add_edit_category($id=0)
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if ($id>0) {
            $this->data['cat_row_data'] = $this->getCategoryRowData($id);
        } else {
            $this->data['cat_row_data'] = [];
        }
        
        $this -> form_validation -> set_rules('name', 'Name', 'trim|required|max_length[25]|is_unique[category.name]|strtolower');

        if ($this -> form_validation -> run() == false) {
            $this->data['errors'] = $this->form_validation->error_array();
            return $this->load->view('cat_add_edit_view', $this->data);
        } else {
            $category_data = [];

            foreach ($this->input->post(null, true) as $k=>$e) {
                if ($k == 'submit' || $k== 'cat_id') {
                    continue;
                }
                if (!is_array($e)) {
                    $category_data[$k] = trim($e);
                } else {
                    $category_data[$k] = implode(',', $e);
                }
            }
            $sess_title = (isset($category_data['name'])?$category_data['name']:'');
            $sess_id = 0;

            if ($this->input->post('cat_id') == '') /**add new record */
            {
                $category_data['status'] = '1';
                $ret = $this->pojo->insertPojoReturnId($this->pojo->writeDb1, 'category', $category_data);
            } else {
                $sess_id = $this->input->post('cat_id');
                $category_data['updatedAt'] = date('Y-m-d H:i:s');
                $id = $this->data['cat_row_data']['id'];
                $inputData = ['where' => ['id'=>$id],
                              'data' => $category_data
                ];
                $response = $this->Category->updateCategory($inputData);
                if (empty($response['error'])) {
                    $this->logIt($category_data, 'category');
                    $ret = 1;
                }
            }
            if ($ret>0) {
                $this->delete_cache($this->cache_key);
            }
            if ($ret) {
                $this->setFlash($this->flash_sess_name, $sess_id, $sess_title);
            }
            redirect(DOMAIN_PATH . $this->router->class, 'refresh');
        }
    }
}
