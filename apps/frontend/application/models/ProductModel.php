<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Product method has CRUD related product 
 * @author amirullahkhan
 *
 */
class ProductModel extends CI_BASE_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    /**
     * Method fetches product data
     * 
     * @param array $inputData
     * @return $result
     */
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
    /**
     * Method fetchs product with different params as a request
     * @param unknown $inputData
     * @return unknown
     */
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