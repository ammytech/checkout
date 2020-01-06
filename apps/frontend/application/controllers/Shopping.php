<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shopping extends CI_BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->customcart = new CI_CUSTOM_Cart();
        
    }

    public function index()
    {
    }

    public function add()
    {
        $this->load->library('form_validation');
        $config = [
            [
                'field' => 'id',
                'label' => 'Product Code',
                'rules' => 'trim|required|is_numeric'
            ],
            [
                'field' => 'name',
                'label' => 'Product Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'trim|required|decimal'
            ]
        ];

        $this->form_validation->set_rules($config);
        $data['status'] = '0';
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_error_delimiters('<p style="color:#FF0000">', '</p>');
            $data['errorCount'] = $this->form_validation->error_array();

            if ($this->input->is_ajax_request()) {

                return $this->retResponse($data, HTTP_BAD_REQUEST);
            }
        } else {
            $insert_data = [
                'id' => set_value('id'),
                'name' => set_value('name'),
                'price' => set_value('price'),
                'qty' => 1
            ];
            $this->customcart->insert($insert_data);
            $data = $this->cart_details($data);
            return $this->retResponse($data, $this->http_stat);
                    
        }
    }

    public function remove()
    {
        $this->load->library('form_validation');
        $config = [
            [
                'field' => 'rowid',
                'label' => 'Row Id',
                'rules' => 'trim|required'
            ]
        ];

        $this->form_validation->set_rules($config);
        $data['status'] = '0';
        if ($this->form_validation->run() == false) {
            //echo $this->db->last_query();exit;
                    $this->form_validation->set_error_delimiters('<p style="color:#FF0000">', '</p>');
            $data['errorCount'] = $this->form_validation->error_array();

            if ($this->input->is_ajax_request()) {
                return $this->retResponse($data, HTTP_BAD_REQUEST);
            }
        } else {
            // Destroy selected rowid in session.
            $data = [
                'rowid' => set_value('rowid'),
                'qty' => 0
            ];
            // Update cart data, after cancle.
            $this->cart->update($data);
            $data = $this->cart_details($data);
            
            return $this->retResponse($data, $this->http_stat);
        }
    }

    public function cart()
    {
        $this->data['title'] = getSiteTitle($this->router->class);
        $this->data['products'] = $this->getProducts();
        $this->load->view('cart', $this->data);
    }
    public function checkout()
    {
        $this->data['title'] = getSiteTitle($this->router->class);
        $this->data['products'] = $this->getProducts();
        $this->load->view('checkout', $this->data);
    }
    public function save_order()
    {
        if ($this->input->is_ajax_request()) {
            
            $this->pojo->trans_begin();
            $data['status'] = '0';
            if (!$this->isLoggedIn) {
                $data['status'] = '2';
                $data['message'] = $this->lang->line('text_login_to_place_order');
                
                return $this->retResponse($data, $this->http_stat);
            }
            if ($this->cart_count<1) {
                $data['status'] = '3';
                $data['message'] = $this->lang->line('text_add_item_to_place_order');
                
                return $this->retResponse($data, $this->http_stat);
            }
            $order = [
                'userId' => $this->userId
            ];

            $ord_id =  $this->pojo->insertPojoReturnId($this->pojo->writeDb1, 'orders', $order);
           
            if ($cart = $this->cart->contents()):
            foreach ($cart as $item) :
                    $order_detail[] = [
                        'orderId' => $ord_id,
                        'productId' => $item['id'],
                        'quantity' => $item['qty'],
                        'price' => $item['price']
                    ];

            // Insert product imformation with order detail, store in cart also store in database.
            endforeach;
            endif;
            $this->pojo->insertPojos($this->pojo->writeDb1, 'order_detail', $order_detail);
            $this->cart->destroy();
            //send email
            $data = $this->commit_rollback($data);
            if ($data['status'] == '1') {
                $inputArr  = ['id'=>$this->userId];
                $created = ['createdAt' => date('Y-m-d H:i:s')];
                $resultUser = $this->User->getUser($inputArr);
                $email_data = array('name'=>$resultUser['name']);
                sitemail('thank_you', $resultUser['email'], '', '', '', " Customer Order", 'Customer Team', $email_data);
            }
            return $this->retResponse($data, $this->http_stat);
        }
    }
    public function thankyou()
    {
        $this->data['title'] = getSiteTitle($this->router->class);
        $this->load->view('thankyou', $this->data);
    }
}
