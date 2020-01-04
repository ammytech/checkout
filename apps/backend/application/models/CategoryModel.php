<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_BASE_Model
{    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    public function getCategory($data){
        $param_data = $data['where'];
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->categoryTableName,
            'paramArr' => $param_data,
            'return' => (!empty($data['return']) ?$data['return']: 1) ,
            'limit' => 1
        ];
        $result = $this->pojo->getPojos($qyeryData);
        
        return $result;
    }
    public function getCategoryAll($data = []){

        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->categoryTableName,
            'select' => 'id,name',
            'return' => 1,
        ];
        $result = $this->pojo->getPojos($qyeryData);
        
        return $result;
    }
    public function getCategoryCount(){
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->categoryTableName,
        ];
        $total_rows =  $this->pojo->getPojosCount($qyeryData);
        
        return $total_rows;
    }
    public function getCategoryList($inputData){
        
        $column = 'id,name,DATE_FORMAT(createdAt,\'%b %d %Y %h:%i %p\') as created_at,status,DATE_FORMAT(updatedAt,\'%b %d %Y %h:%i %p\') as updated_at';
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->categoryTableName,
            'sortcol' => 'id',
            'order' => 'desc',
            'select' => $column,
            'return' => 1,
        ];
        if (!empty($inputData['per_page'])) {
            $qyeryData['limit'] = $inputData['per_page'];
        }
        if (!empty($inputData['offset'])) {
            $qyeryData['offset'] = $inputData['offset'];
        }
        if (!empty($inputData['param_like'])) {
            $qyeryData['param_like'] = $inputData['param_like'];
        }
        
        $result = $this->pojo->getPojos($qyeryData);
        
        return $result;
    }
    public function updateCategory($inputData){
        if(empty($inputData['where']) && !is_array($inputData['where'])){
            
            return false;
        }
        
        $qyeryData = [
            'dbName' => $this->pojo->writeDb1,
            'table' => $this->categoryTableName,
            'where' => $inputData['where'],
            'data' => $inputData['data'],
            'limit' => 1,
        ];
        $result = $this->pojo->updatePojos($qyeryData);
        
        return $result;
    }
    
}