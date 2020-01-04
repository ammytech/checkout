<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_BASE_Controller
{
    public $data = array();
    public function __construct()
    {
        parent::__construct();
    }
     
    public function index()
    {
        $this->data['title'] = 'Login - '.$this->site_name;
        $this->load->view('login', $this->data);
    }
}
