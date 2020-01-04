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

class Login extends CI_BASE_Controller 
{
    public $defaultPageCount = 1;
    public $defaultPageNumber = 10;
    
    public function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->model('UserModel'); 
    }
    public function index_post() 
    {
        
        if ($this->response_code != REQUEST_OK) {
            return $this->processErrorResponse();
        }
        
        $this->assignRequestVariables($this->request->method);
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[100]|callback_alpha_dash');
        if ($this->form_validation->run() == false) {
            $this->validateLogin();
        }
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|callback_alpha_dash|callback_auth_user');
        
        if ($this->form_validation->run() == false) {
            return $this->validateLogin();
        }
        
        $this->status = true;
        $this->returnOutput([], $this->status, $this->retMessage, $this->response_code);
    }
    public function validateLogin()
    {
        $this->form_validation->set_error_delimiters('<p style="color:#FF0000">', '</p>');
        $data = [];
        $data['errorCount'] = $this->form_validation->error_array();
        $data['status'] = '0';
        $data['errors'] = validation_errors();
        $this->status = false;
        $this->returnOutput($data, $this->status, $this->retMessage, $this->response_code);
    }
    public function alpha_dash($str)
    {
        return (! preg_match("/^([a-z0-9!@.-])+$/i", $str))? false : true;
    }
    public function auth_user($password)
    {
        $inputArr  = ['username'=>set_value('username'),
                      'password'=>$password
        ];
        $created = ['createdAt' => date('Y-m-d H:i:s')];
        $resultUser = $this->UserModel->getUser($inputArr);

        if (!empty($resultUser['error'])) {
            $this->errors = 'Something went wrong';
            
            return $this->returnError(TECHNICAL_ERROR_KEY);
        }
        $deactivate = false;
        if (!empty($resultUser['status']) && $resultUser['status'] !== '1') {
            $deactivate = true;
            $resultUser = [];
        }
        
        if (!empty($resultUser) && count($resultUser) > 0) {
            
            //update last login datetime
            
            $this->userName = $resultUser['username'];
            $this->userId = $resultUser['id'];
            $this->UserModel->updateUserLastLogin($resultUser);
            $this->logIt($inputArr + $created, 'backend_users');
            
            return true;
        } else {
            if ($deactivate) {
                $message = 'Account Is Deactivated';
            } else {
                $message = 'Invalid username or password';
            }
            $this->form_validation->set_message('auth_user', $message);
            $this->logIt($inputArr+$created, 'backend_users');
            
            return false;
        }
    }
}
