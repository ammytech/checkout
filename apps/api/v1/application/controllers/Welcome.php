<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Amirullah Khan
 * @link		''
 */

class Welcome extends CI_BASE_Controller
{
    public function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
    }
    
    
    public function index_get() //add_post
    {
        $this->retMessage = 'welcomes you';
        $this->returnOutput(array(), $this->status, $this->retMessage, $this->response_code);
    }
}
