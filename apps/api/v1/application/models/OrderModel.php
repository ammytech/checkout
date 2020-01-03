<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordermodel extends CI_BASE_Model
{    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    
    public function getOrderList($pageNumber){
        $param_data = [];
        $column = $this->orderDetailTableName . '.orderId,' . $this->orderDetailTableName . '.productId,' . $this->orderDetailTableName . '.quantity,' . $this->orderDetailTableName . '.price,' . $this->productTableName . '.title,' . $this->ordersTableName . '.createdAt';
        $result = $this->pojo->getPojosByMultiJoin($this->pojo->readDb1, 'order_detail', $param_data, 'orderId', 'desc', $pageNumber, $this->requestVar['num'], 'orders', $this->orderDetailTableName . '.orderId=' . $this->ordersTableName  .'.orderId', 'left', 'product', $this->orderDetailTableName . '.productId='. $this->productTableName . '.id', 'left', null, null, 'inner', $column, null, 1);
        
        return $result;
    }
}