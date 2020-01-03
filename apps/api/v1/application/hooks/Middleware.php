<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Middleware
{
    

    public function request()
    {
        $CI =& get_instance();
        $CI->load->model('pojo_model', 'pojo');
        $req_headers = $CI->input->request_headers();
        $method = $CI->input->server('REQUEST_METHOD');
        $header_keys = $CI->config->item('header_keys');
        $header_secret = '';
        if (!empty($CI->input->$method('api_source', true))) {
            $header_secret = $header_keys[$CI->input->$method('api_source', true)];
        } else {
            return $CI->returnError(INVALID_API_SOURCE_KEY); 
        }
		
        if (empty($req_headers['Secretkey'])) {
			return $CI->returnError(SECURITY_KEY); 
		} else if($req_headers['Secretkey'] != $header_secret){
			return $CI->returnError(SECURITY_KEY); 
		}
        $this->uri_segment = $CI->uri->segment('1');
        $CI->load->helper('cfunctions');
        $CI->load->driver('cache', ['adapter' => 'file']);
        $this->cache_met = date('YmdH');
    }
}
