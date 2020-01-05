<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_BASE_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    public function getProduct($inputData){
        $param_data = (!empty($inputData['where']) ? $inputData['where'] : []);
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->productTableName,
            'paramArr' => $param_data,
            'return' =>  (!empty($inputData['return']) ? $inputData['return']: 1) ,
            'limit' => 1
        ];
        $result = $this->pojo->getPojos($qyeryData);
        
        return $result;
    }
    
    public function getProductList($inputData){
        $param_data = (!empty($inputData['where']) ? $inputData['where'] : []);
        
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->productTableName,
            'paramArr' => $param_data,
            'sortcol' => 'id',
            'order' => 'desc',
            'return' => 1,
        ];
        if (!empty($inputData['per_page'])) {
            $qyeryData['limit'] = $inputData['per_page'];
        }
        if (!empty($inputData['offset'])) {
            $qyeryData['offset'] = $inputData['offset'];
        }
        
        
        $result = $this->pojo->getPojos($qyeryData);
        
        return $result;
    }
    
}