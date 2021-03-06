<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User Model has all the CRUD releated users
 * @author amirullahkhan
 *
 */
class UserModel extends CI_BASE_Model
{    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    /**
     * Method fetches users data 
     * $data is used to fetch required records
     * @param array $data
     * @return $result
     */
    public function getUser($data){
        $param_data = $data;
        
        $qyeryData = [
            'dbName' => $this->pojo->readDb1,
            'table' => $this->userTableName,
            'paramArr' => $param_data,
            'order' => 'desc',
            'return' => 2,
            'paramArr_in' => ['userTypeId'=>$this->AccesUser],
        ];
        $result = $this->pojo->getPojos($qyeryData);
        
        return $result;
    }
    /**
     * Method updates isActive column as disbale
     * @param array $userResult
     * @return $result
     */
    public function userInActive($userResult){
        if(empty($userResult['id'])){
            
          return false;  
        }
        
        $qyeryData = [
            'dbName' => $this->pojo->writeDb1,
            'table' => $this->userTableName,
            'where' => ['id'=>$userResult['id']],
            'data' => ['isActive'=>'0'],
            'limit' => 1,
        ];
        $result = $this->pojo->updatePojos($qyeryData);
        
        return $result;
    }
}