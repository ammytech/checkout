<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Common business logic and table name placed here
 * @author amirullahkhan
 *
 */
class CI_BASE_Model extends CI_Model
{
    public $ordersTableName = 'orders';
    public $orderDetailTableName = 'order_detail';
    public $productTableName = 'product';
    public $userTableName = 'users';
    public $categoryTableName = 'category';
    public $productcategoryTablename = 'product_category';
    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    
}