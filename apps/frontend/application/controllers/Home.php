<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['title'] = getSiteTitle($this->router->class);
        $this->data['username'] = (isset($this->userdata['user_name'])?$this->userdata['user_name']:'');
        $productData = $this->getProducts();
        if(!empty($productData) && is_array($productData)){
            foreach ($productData as $key=>$row) {
                $row['qty'] = 1;
                $row['returnOfferText'] = 1;
                $product_price_rules = $row['price_rules'];
                if (!empty($product_price_rules)) {
                    $customcartObj = new CI_CUSTOM_Cart();
                    $returnData = $customcartObj->cart_product_rules($product_price_rules, $row);
                    if(!empty($returnData['offer_text'])){
                        $productData[$key]['offer_text'] = $returnData['offer_text'];
                    }
                }
            }
        }
        
        $this->data['products'] = $productData;
        $this->load->view('home', $this->data);
    }
    public function logout()
    {
        $this->logout_user();
    }

}
