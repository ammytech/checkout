<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Dashboard Landing Page
     */
    public function index()
    {
        $this->data['title'] = "Dashboard - ".$this->site_name;
        $this->data['username'] = (isset($this->userdata['user_name'])?$this->userdata['user_name']:'');
        $this->load->view('dashboard', $this->data);
    }
    public function logout()
    {
        $this->logout_user();
    }
    public function clear_cache()
    {
        $this->load->helper('file');
        // backend caches
        $path = BACKEND_CACHE_PATH;
        if (delete_files($path, true)) {
            $this->session->set_flashdata('cache_cleared', true);
        } else {
            $this->session->set_flashdata('cache_cleared', false);
        }


        // frontend caches
        $path = FRONT_CACHE_PATH;
        if (delete_files($path, true)) {
            $this->session->set_flashdata('cache_cleared', true);
        } else {
            $this->session->set_flashdata('cache_cleared', false);
        }

        redirect(DOMAIN_PATH.'dashboard', 'refresh');
    }
}
