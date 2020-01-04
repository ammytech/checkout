<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

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
    public function modifyIt($inputData){
        if(empty($inputData['where']) && !is_array($inputData['where'])){
            
            return false;
        }
        
        $qyeryData = [
            'dbName' => $this->pojo->writeDb1,
            'table' => $inputData['table'],
            'where' => $inputData['where'],
            'data' => $inputData['data'],
            'limit' => $inputData['limit'],
        ];
        $result = $this->pojo->updatePojos($qyeryData);
        
        return $result;
    }
    public function getProductCategoryList($data){
        $param_data = $data;
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->productcategoryTablename,
            'select' => 'productId,categoryId',
            'paramArr' => $param_data,
            'return' => 1,
        ];
        $result = $this->pojo->getPojos($qyeryData);
        
        return $result;
    }
    
}