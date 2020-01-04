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
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[100]|callback_alpha_dash');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->validateLogin();
        }
        // call Login Service to authenticate user
        $processResponse = $this->processLogin();
        
        if (!empty($processResponse) && isJson($processResponse)) {
            $processResponseArr = json_decode($processResponse, true);
            
            if (!empty($processResponseArr['status'])) {
                //fetch user data to save in session
                $inputArr  = ['username'=>set_value('username')];
                $result = $this->User->getUser($inputArr); // this can be also done with API, will upgrade in future
                
                $ses_array = [];
                if (!empty($result) && count($result) > 0) {
                    $ses_array[0] = [ 'uid'  => (!empty($result['id']) ? $result['id'] : ''),
                        'uname'  => (!empty($result['username']) ? $result['username'] : ''),
                        'name'  => (!empty($result['name']) ? $result['name'] : ''),
                        'utype'  => (!empty($result['user_type_id']) ? $result['user_type_id'] : ''),
                        'user_logged_in'  => true,
                    ];
                    setSiteSess($ses_array);
                }
                $this->status = true;
                $data = [];
                $data['status'] = '1';
                $data['url']  = DOMAIN_PATH.'dashboard';
                return $this->retResponse($data, $this->http_stat);
            } else {
                return $this->retResponse($processResponseArr, $this->http_stat);
            }
            
        } else {
            $this->errors = 'Something went wrong';
            
            return $this->returnError(TECHNICAL_ERROR_KEY);
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
                    'username' => urlencode($this->input->post('username')),
                    'password' => urlencode($this->input->post('password'))];
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
