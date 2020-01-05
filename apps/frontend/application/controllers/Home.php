<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel', 'Product');
    }

    public function index()
    {
        $this->data['title'] = getSiteTitle($this->router->class);
        $this->data['username'] = (isset($this->userdata['user_name'])?$this->userdata['user_name']:'');
        $this->data['products'] = $this->getProducts();
        $this->load->view('home', $this->data);
    }
    public function getProducts()
    {
        $cacheName = $this->productListCacheName;
        if (! $productList = $this->cache->get($cacheName)) {
            $param_in = [];
            $inputData = ['status' => 1];
            $productList = $this->Product->getProductList($inputData);
            if (empty($productList['error'])) {
                $this->cache->save($cacheName, $productList, $this->defaultCacheTime);
            }
        }
        return $productList;
    }
}
