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
    public $landingPage = '';
    public $accessType = 0;
    public $site_name = 'Backend';
    public $accessD = false;
    public $uname = '';
    public $access_restrict = 'access restricted';
    public $userLogName = '';
    public $AccesUser = ['1'];
    public $retMessage = '';
    public $status = 0;
    public $response_code = 0;
    public $http_stat = 200;
    public $errors = [];
    public $sec_array = [];
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cfunctions');
        $this->load->model('UserModel', 'User');
        $this->sec_array = $this->config->item('header_keys');
        $this->load->driver('cache', ['adapter' => 'file']);
        $this->userdata = $this->session->userdata('site_backend_user');
        $this->sessionid = $this->session->userdata('session_id');
        $this->userId = (!empty($this->userdata['uid']) ? $this->userdata['uid'] : 0);
        $this->accessType = (!empty($this->userdata['utype']) ? $this->userdata['utype'] : 0);
        
        $this->userName = (!empty($this->userdata['name']) ? $this->userdata['name']:'');
        $this->userLogName = (!empty($this->userdata['uname']) ? $this->userdata['uname']:'');
        $this->isLoggedIn = (!empty($this->userdata['user_logged_in']) ? $this->userdata['user_logged_in'] : false);
        $this->uname = $this->userName;
        $segment_uri = current_url();
        $login_path_controller = $this->config->item('login_path_controller');
        $this->landingPage = $login_path_controller;
        
        if (!$this->isLoggedIn) { //to avoid multiple redirect to login controller
            if (!stristr($segment_uri, $login_path_controller)) {
                if ($this->input->is_ajax_request()) {
                    echo json_encode(array('loggedout'=>'1'));
                    exit;
                }
                redirect(DOMAIN_PATH . $login_path_controller);
            }
        }
        $this->load->model('CI_BASE_MODEL', 'BASE_MODEL');
    }
    public function returnError($errortype)
    {
        switch ($errortype) {
                
            case HTTP_BAD_REQUEST:
                $this->retMessage = 'bad request';
                $this->response_code = HTTP_BAD_REQUEST;
                $this->http_stat = 400;
                break;
            case INVALID_JSON_KEY:
                $this->retMessage = 'invalid json';
                $this->response_code = RES_INVJSON;
                $this->http_stat = 400;
                break;
            case SERVER_ERR_RES_KEY:
                $this->response_code = SER_ERR_RES;
                $this->http_stat = 500;
                break;
            case TECHNICAL_ERROR_KEY:
                $this->retMessage = 'Something went wrong';
                $this->http_stat = 500;
                $this->response_code = TECHNICAL_ERROR;
                break;
            default:
                $this->retMessage = 'Unknown Error';
                $this->http_stat = 520;
                $this->response_code = RES_UKERR;
                break;
        }
        
        $retArr = ['status' => $this->status,
                   'message' => $this->retMessage,
                   'code' => $this->response_code,
                    'errors' => $this->errors
                   ];
        $this->retResponse($retArr, $this->http_stat);
    }
    public function returnOutput($data=[], $status = true, $retMess = '', $code = 0)
    {
        $data['status'] = $status;
        $data['message'] = $retMess;
        $data['code'] = $code;
        $data['errors'] = $this->errors;

        $this->retResponse($data, $this->http_stat);
    }
    public function retResponse($arr, $code)
    {
       $this->output->set_status_header($code);
       echo json_encode($arr);exit;
    }
    public function delete_cache($key_name, $path='', $seg_match=false)
    {
        if (trim($key_name)=='') {
            return false;
        }
        
        if ($path =='') {
            $path = APPPATH.'cache/'.$key_name;
        }
        
        if ($seg_match) {
            foreach (glob($path."_*") as $filename) {
                unlink($filename);
            }
            return true;
        } else {
            if (file_exists($path)) {
                return unlink($path);
            }
        }
        return false;
    }
    public function resizeImage($source_image, $new_image, $width=100, $height=80)
    {
        if ($source_image == '' || $new_image == '') {
            return false;
        }
        $config = [];
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image;
        $config['new_image'] = $new_image;
        $config['maintain_ratio'] = true;
        $config['width']     = $width;
        $config['height']   = $height;
        
        $this->load->library('image_lib');
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        
        if ($this->image_lib->resize()) {
            return true;
        } else {
            return false;
        }
    }
    public function logIt($data = [], $tablename='')
    {  
         $otherDetails = ['table_name' => $tablename];
         $log_data = ['name' => $this->userName,
                      'uid' => $this->userId,
                      'description' => json_encode($data + $otherDetails),
                      'ip_address' => ip2long($this->input->ip_address())];
         return $this->pojo->insertPojoReturnId($this->pojo->writeDb1, 'backend_logs', $log_data);
         
    }
    public function setFlash($flash_name, $sess_id, $sess_title)
    {
        if ($sess_id === 'custom') {
            $this->session->set_flashdata($flash_name, 'custom~~'.$sess_title);
        } else {
            $this->session->set_flashdata($flash_name, $sess_id.'~~'.$sess_title.'~~'.($sess_id>0?'Edited':'Added'));
        }
    }
    public function logout_user($redirect =  true)
    {
        if ($this->userId) {
            
            $response = $this->User->userInActive(['id'=>$this->userId]);
            if (empty($response['error'])) {
                $this->session->sess_destroy();
                if ($redirect) {
                    redirect(DOMAIN_PATH . $this->landingPage);
                }
            }  
        }
        
    }
    public function modifyit($table, $change_col, $where_col, $sess_name='unknown')
    {
        $retArr = [];
        $retArr['success'] = '0';
        if ($id = $this->input->post('id', true)) {
            $data = [$change_col => $this->input->post('new_status', true)];
            
            if ($this->input->post('action', true)=='publish' || $this->input->post('action', true)=='delete') { //publish--unpublish
                $where = [$where_col => $id];
                $inputData = ['table' => $table,
                              'where' => $where,
                              'data' => $data,
                              'limit' => 1,
                ];
                $response = $this->BASE_MODEL->modifyIt($inputData);
                if (empty($response['error'])) {
                    if ($this->input->post('action', true)=='delete') {
                        $this->session->set_flashdata($sess_name, $id.'~~'.$this->input->post('title').'~~'.($this->input->post('new_status', true)=='-1'?'Deleted':'Undone'));
                    }
                    $this->logIt($data, $table);
                    $retArr['success'] = '1';
                    return $this->retResponse($retArr, $this->http_stat);
                }
            }
        }
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
}
