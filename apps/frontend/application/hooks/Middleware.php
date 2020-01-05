<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Middleware
{
    public $ip_address = [];
    public $exclude_path = 'home';
    public function request()
    {
        $CI =& get_instance();
        $CI->load->model('Pojo_Model', 'pojo');
        $segment_uri = current_url();
    }
    
}
