<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Middleware
{
    public $ip_address = [];
    public $exclude_path = '';
    public function request()
    {
        $CI =& get_instance();
        $CI->load->model('pojo_model', 'pojo');
        $segment_uri = $_SERVER['REQUEST_URI'];
        $login_path_controller = $CI->config->item('login_path_controller');
        if (empty($login_path_controller)) {
            
            redirect(DOMAIN_HOST);
        }
        $this->exclude_path = $login_path_controller;
        if (stristr($segment_uri, $this->exclude_path) || $CI->uri->segment(1)=='') {
            
            return true;
        }
        $this->checkUserPrevileges($CI, $login_path_controller);
    }
    public function checkUserPrevileges($CI, $login_path_controller)
    {
        if (empty($CI->userId)) {
            redirect(DOMAIN_HOST . '/' . $login_path_controller);
        }
        $inputArr = ['id'=>$CI->userId, 'status'=>'1'];
        
        $resultUser = $CI->User->getUser($inputArr);
        if (empty($resultUser)) {
            redirect(DOMAIN_HOST . '/' . $login_path_controller);
        }
    }
}
