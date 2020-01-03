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
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->orderDetailTableName,
            'paramArr' => $param_data,
            'sortcol' => 'orderId',
            'order' => 'desc',
            'offset' => $pageNumber,
            'limit' => $this->requestVar['num'],
            'joinTable' => $this->ordersTableName,
            'joinCondition' => $this->orderDetailTableName . '.orderId=' . $this->ordersTableName . '.orderId',
            'joinType' => 'left',
            'joinTable2' => $this->productTableName,
            'joinCondition2' => $this->orderDetailTableName . '.productId=' . $this->productTableName . '.id',
            'joinType2' => 'left',
            'select' => $column,
            'return' => 1
        ];
        $result = $this->pojo->getPojosByMultiJoin($qyeryData);
        
        return $result;
    }
}