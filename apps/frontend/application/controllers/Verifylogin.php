<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class VerifyLogin extends CI_BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('signin-username', 'Username', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->validateLogin();
        }
        $this->form_validation->set_rules('signin-password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->validateLogin();
        } 
        // call Login Service to authenticate user
        $processResponse = $this->processLogin();
        
        if (!empty($processResponse) && isJson($processResponse)) {
            $processResponseArr = json_decode($processResponse, true);
            
            if (!empty($processResponseArr['status'])) {
                //fetch user data to save in session
                $inputArr  = ['username'=>set_value('signin-username')];
                $result = $this->User->getUser($inputArr); // this can be also done with API, will upgrade in future
                
                $ses_array = [];
                if (!empty($result) && count($result) > 0) {
                    $uid = (isset($result['id']) ? $result['id'] : '');
                    $name = (isset($result['name']) ? $result['name'] : '');
                    $this->setUserSess($uid, $name);
                }
                if ($this->input->is_ajax_request()) {
                    $data['message'] = $this->lang->line('text_successfull_logged_in');
                    $data['status'] = '1';
                    
                    return $this->retResponse($data, $this->http_stat);
                }
            } else {
                if(!empty($processResponseArr['errorCount']) || !empty($processResponseArr['errors']) ){
                    
                    return $this->retResponse($processResponseArr, $this->http_stat);
                } else if (!empty($processResponseArr['code'])){
                    $this->setHTTPStatus($processResponseArr['code']);
                }
                
                return $this->retResponse($processResponseArr, $this->http_stat);
            }
            
        } else {
            $data['message'] = $this->lang->line('text_something_went_wrong');
            $data['status'] = '0';
            
            return $this->retResponse($data, $this->http_stat);
        }
    }

    public function validateLogin()
    {
        $this->form_validation->set_error_delimiters('<p style="color:#FF0000">', '</p>');
        $data = [];
        $data['errorCount'] = $this->form_validation->error_array();
        $data['status'] = '0';
        $data['errors'] = validation_errors();
        $this->http_stat = HTTP_BAD_REQUEST;
        $this->retResponse($data, $this->http_stat);
    }
    public function alpha_dash($str)
    {
        return (! preg_match("/^([a-z0-9!@.-])+$/i", $str))? false : true;
    }
    private function processLogin(){
        $source = 'web';
        $query_str ='login';
        
        $fields = ['api_source' => urlencode($source),
            'username' => urlencode($this->input->post('signin-username')),
            'password' => urlencode($this->input->post('signin-password'))];
        //url-ify the data for the POST
        $fields_string = '';
        foreach ($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');
        
        $apiResponse = $this->callApi($query_str, $source, $fields_string, count($fields), 'post');
        
        return $apiResponse;
    }
}
