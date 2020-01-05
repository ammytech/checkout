<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Registeration extends CI_BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('form_validation');
        $config = [
            [
                'field' => 'signup-username',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[50]'
            ],
            [
                'field' => 'signup-email',
                'label' => 'Email Id',
                'rules' => 'trim|is_unique[users.email]|valid_email|max_length[100]'
            ],
            [
                'field' => 'signup-mobile',
                'label' => 'Mobile Number',
                'rules' => 'trim|required|is_unique[users.mobile]|max_length[12]'
            ],

            [
                'field' => 'signup-password',
                'label' => 'Password',
                'rules' => 'trim|required|max_length[32]'
            ],
            [
                'field' => 'signup-address',
                'label' => 'Address',
                'rules' => 'trim|required|max_length[250]'
            ],
            [
                'field' => 'accept-terms',
                'label' => 'Accept Terms and Condition',
                'rules' => 'trim|required'
            ]
        ];

        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('is_unique', '"<b style="font:bold;font-size:16px">%s</b>"  is already taken!, please login <br>');
        $data['status'] = '0';
        if ($this->form_validation->run() == false) {
            
            $this->form_validation->set_error_delimiters('<p style="color:#FF0000">', '</p>');
            $data['errorCount'] = $this->form_validation->error_array();

            if ($this->input->is_ajax_request()) {
                
                return $this->retResponse($data, $this->http_stat);
            }
        } else {
            
            if ($this->input->is_ajax_request()) {
                $this->pojo->trans_begin();
                // check for mobile number
                if (strlen(ltrim(set_value('signup-mobile', true), '0')) != 10) {
                    $data['errorCount'] = [
                        'cnumber' => $this->lang->line('text_login_to_place_order'),
                    ];

                    return $this->retResponse($data, $this->http_stat);
                }

                $u_data = [
                    'name' => set_value('signup-username'),
                    'password' => $this->hashPassword(set_value('signup-password')),
                    'mobile' => set_value('signup-mobile'),
                    'address' => set_value('signup-address'),
                    'email' => set_value('signup-email')
                ];
               
                $processData = $this->register_process($u_data, $data);
                if (empty($processData['error'])) {
                    $data['message'] = $this->lang->line('text_successfully_registered');
                    $data['status'] = 1;
                    $data = $this->commit_rollback($data);
                } else {
                    $data['status'] = 0;
                    $data['errorCount'] = [$this->lang->line('text_something_went_wrong')];
                    $data['message'] = $this->lang->line('text_something_went_wrong');
                }
                
                return $this->retResponse($data, $this->http_stat);
            }
        }
    }
    private function register_process($u_data, $data)
    {
        $user_data = [
            'createdAt' => date('Y-m-d H:i:s'),
            'ipAddress' => ip2long($this->input->ip_address()),
            'username' => $u_data['email'],
            'userTypeId' => $this->user_type_id,
            'status' => '1' // status => '0' when token based verifcation or OTP
        ];
        $user_data = $user_data+$u_data;
        
        return $this->pojo->insertPojoReturnId($this->pojo->writeDb1, 'users', $user_data);

        return $data;
    }
}
