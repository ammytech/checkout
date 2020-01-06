<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_BASE_Controller extends CI_Controller
{
    public $data = [];
    public $userdata = [];
    public $sessionid = '';
    public $userId = 0;
    public $isLoggedIn = false;
    public $landingPage = 'home';
    public $accessType = 0;
    public $site_name = 'Ecommerce';
    public $accessD = false;
    public $uname = '';
    public $access_restrict = 'access restricted';
    public $userLogName = '';
    public $AccesUser = ['2'];
    public $user_type_id = '2';
    public $session_name_site = 'site_frontend_user';
    public $currency_code = ['1'=>'&#8377;','2'=>'&#36;'];
    public $cart_amount = 0;
    public $cart_count = 0;
    public $defaultCacheTime = 24*60*60;
    public $productListCacheName = 'product_list';
    public $http_stat = HTTP_OK;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cfunctions');
        $this->sec_array = $this->config->item('header_keys');
        $this->load->driver('cache', ['adapter' => 'file']);
        $this->userdata = $this->session->userdata($this->session_name_site);
        $this->sessionid = $this->session->userdata('session_id');
        $this->userId = (isset($this->userdata['uid'])?$this->userdata['uid']:0);
        $this->userName = (isset($this->userdata['name'])?$this->userdata['name']:'');
        $this->userLogName = (isset($this->userdata['uname'])?$this->userdata['uname']:'');
        $this->isLoggedIn = (isset($this->userdata['user_logged_in'])?$this->userdata['user_logged_in']:false);
        $this->uname = $this->userName;
        $segment_uri = current_url();
        $this->currency_code = $this->currency_code[1];
        $language = $this->config->item('site_language');
        if (empty($language) )
        {
            $language = 'english';
        }
        $language = $language['default']; // this will be change as per multilingual site in future
        $this->lang->load('site', $language, FALSE, TRUE, __DIR__."/../");
        $this->load->library('cart');
        $this->cart_details();
        $this->load->model('UserModel', 'User');
        
      
    }
    public function getProducts()
    {
        $cacheName = $this->productListCacheName;
        if (! $productList = $this->cache->get($cacheName)) {
            $param_in = [];
            $inputData = ['status' => 1];
            $productList = $this->Product->getProductList($inputData);
            if (empty($productList['error'])) {
                $this->cache->save($cacheName, $productList, $this->defaultCacheTime);
            }
        }
        return $productList;
    }
    public function retResponse($returnData, $code)
    {
        $this->output->set_status_header($code);
        echo json_encode($returnData);exit;
    }
    public function cart_details($data= [])
    {
        if (!empty($data)) {
            $this->cart_amount = 0;
            $this->cart_count = 0;
        }
        $this->customcart = new CI_CUSTOM_Cart();
        
        if(!empty($this->customcart->contents())){
            foreach ($this->customcart->contents() as $key=>$row) {
                $this->cart_amount = $this->cart_amount+$row['subtotal'];
                $this->cart_count = $this->cart_count+1;
            }
        }
        
        if (!empty($data)) {
            $data['amount'] = $this->cart_amount;
            $data['count'] = $this->cart_count;
            $data['status'] = '1';
            
            return $data;
        }
    }
  
    public function commit_rollback($data = [])
    {
        if ($this->pojo->trans_status() === false) {
            //if something went wrong, rollback everything
            $this->pojo->trans_rollback();
            $data['errorCount'] = array('rollback','transaction has been rollbacked,please try again');
            $data['status']='0';
        } else {
            //if everything went right, commit the data to the database
            $this->pojo->trans_commit();
            $data['status']='1';
            
            //return TRUE;
        }
        return $data;
    }
    public function hashPassword($password)
    {
        $this->load->helper('security');
        return  do_hash($password, 'md5'); // MD5
    }
    public function callApi($query_str, $source, $f_str, $count, $method='post')
    {
        $sec_key = (!empty($this->sec_array[$source]) ? $this->sec_array[$source] : '');
       
        $ch = curl_init();
        if ($method =='get' && !empty($f_str)) {
            $query_str =$query_str.'?'.$f_str;
        }
        $headers = [];
        $headers[] = 'Secretkey:' . $sec_key;
        $apiHost = $this->config->item('API_HOST');
        curl_setopt($ch, CURLOPT_URL, $apiHost . $query_str);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_POST, $count);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $f_str);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec($ch);
        //var_dump(curl_getinfo($ch));exit;
        curl_close($ch);
        return $server_output ;
    }
    public function setUserSess($uid, $name)
    {
        // add all data to session
        $userdata = [
            'uid' => $uid,
            'name' => $name,
            'user_logged_in' => true
        ];
        // print_r($userdata);exit;
        setSiteSess($userdata, $this->session_name_site);
    }
    public function setHTTPStatus($statusCode)
    {
        switch ($statusCode) {
            
            case HTTP_BAD_REQUEST:
                $this->http_stat = HTTP_BAD_REQUEST;
                break;
            case RES_UNAUT:
                $this->http_stat = RES_UNAUT_CODE;
                break;
            default:
                
                $this->http_stat = RES_UKERR;
                break;
        }
       
    }
    
    public function logout_user($redirect=true)
    {
        if ($this->userId) {
            $inputData =  ['id' => $this->userId];
            $response = $this->User->userInActive($inputData);
            if (empty($response['error'])) {
                $this->session->sess_destroy();
            }  else {
                $data['message'] = $this->lang->line('text_something_went_wrong');
                $data['status'] = '0';
                return $this->retResponse($data, $this->http_stat);
            }
        }
        if ($redirect) {
            
            redirect(frontend_base_url);
        }
    }
}
