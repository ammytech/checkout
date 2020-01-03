<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Amirullah Khan
 * @link		''
 */

class Order extends CI_BASE_Controller 
{
    public $defaultPageCount = 1;
    public $defaultPageNumber = 10;
    
    public function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->model('OrderModel'); 
    }
    public function index_get() //add_post
    {
        if ($this->response_code != REQUEST_OK) {
            return $this->processErrorResponse();
        }
        
        $this->requestVar = $this->requestVar + ['page'=>$this->defaultPageCount, 'num' => $this->defaultPageNumber];
        $this->assignRequestVariables($this->request->method);
        $pageNumber = ($this->requestVar['num'] * ($this->requestVar['page']-1));
        
        $resultOrders = $this->OrderModel->getOrderList($pageNumber);
        if (!empty($resultOrders['error'])) {
           return $this->returnError('technical_error'); 
        }
        $this->status = true;
        $this->returnOutput(array('list'=>$resultOrders), $this->status, $this->retMessage, $this->response_code);
    }
}
