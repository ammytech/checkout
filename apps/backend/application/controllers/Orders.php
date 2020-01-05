<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orders extends CI_BASE_Controller
{
    public $flash_sess_name = '';
    
    public function __construct()
    {
        parent::__construct();
        
    }
    public function index()
    {
        $this->data['title'] = getSiteTitle($this->router->class);
        $source = 'web';
        $query_str ='order';
        $num = '20';
        $page = '1';
        $fields = ['api_source' => urlencode($source),
                    'page' => urlencode($page),
                    'num' => urlencode($num)];
        //url-ify the data for the POST
        $fields_string = '';
        foreach ($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');

        $res = $this->callApi($query_str, $source, $fields_string, count($fields), 'get');
        $result = json_decode($res, true);
        $this->data['result'] =  (!empty($result['list']) ? $result['list'] : []);
        $this->load->view('order_view', $this->data);
    }
    
}
