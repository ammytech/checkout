<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_BASE_Model extends CI_Model
{
    public $ordersTableName = 'orders';
    public $orderDetailTableName = 'order_detail';
    public $productTableName = 'product';
    public $userTableName = 'users';
    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    
}