<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PojoModel Active Record Model
 *
 * A Model to interface with the MySQL database.
 *
 * @package CodeIgniter
 * @author Amirullah Khan | https://in.linkedin.com/in/amirullahkhan | infoamir225@gmail.com
 * @copyright Copyright (c) 2019, Amirullah Khan.
 * @license http://www.opensource.org/licenses/mit-license.php
 * @link https://in.linkedin.com/in/amirullahkhan
 * @version Version 1.0
 */
class Pojo_Model extends CI_Model
{
    public $readDb1 = 'wb';
    public $writeDb1 = 'wb';
    public $deleteDb1 = 'wbdel';
    public $error_no = '';
    public $error_msg = '';
    public $return = 0;
    public $transaction_start = false;
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $CI = & get_instance();
        $this->load->library('Shard');
    }
    /**
     * --------------------------------------------------------------------------------
     * //! Update or Insert Single
     * --------------------------------------------------------------------------------
     *
     * Update a row into the passed table and where consists id of table to update
     * If no id present a new row will be created
     * @usage : $this->pojo_model->updatePojo('db-name','table-name', $data = array());
     */
    public function updatePojo($dbName, $table, $data, $sql = '')
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            
            if ($db->field_exists('dateupdated', $table)) {
                $data['dateupdated'] = date("Y-m-d H:i:s");
            }
            
            if (!empty($data['id'])) {
                $db->where('id', $data['id']);
                unset($data['id']);
                if (!empty($sql)) {
                    $db->where($sql, null, false);
                }
                $db->update($table, $data);
                $this->return = 1;
            } else {
                if ($db->field_exists('datecreated', $table)) {
                    $data['datecreated'] = date("Y-m-d H:i:s");
                }
                $db->insert($table, $data);
                $this->return = $db->insert_id();
            }
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                return ['error' => true];
            }
               
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $this->return;
       }
    /**
     * --------------------------------------------------------------------------------
     * //! Update in Bulk
     * --------------------------------------------------------------------------------
     *
     * Update row(s) into the passed table
     *
     * @usage : $this->pojo_model->updatePojos('db-name','table-name',$where,$data,$limit,$order_col,$order);
     */
    public function updatePojos($queryData)
    {
        try {
             
            $dbName = $this->writeDb1;
            $table = null ;
            $order = 'asc';
            $where = $data = [];
            $limit = 0;
            $order_col = '';
            
            if (is_array($queryData)) {
                foreach ($queryData as $key => $val) {
                    $$key = $val;
                }
            }
            $db = $this->shard->get_Generic_Db($dbName);
            $db->where($where);
            if ($order_col!='') {
                $db->order_by($order_col, $order);
            }
            if ($limit>0) {
                $db->limit($limit);
            }
            $db->update($table, $data);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return ($db->affected_rows()?true:false);
    }
    /**
     * --------------------------------------------------------------------------------
     * //! Update single and return
     * --------------------------------------------------------------------------------
     *
     * Update row(s) into the passed table and return number of affected rows
     *
     * @usage : $this->pojo_model->updatePojoAndReturnCount('db-name','table-name',$data);
     */
    public function updatePojoAndReturnCount($dbName, $table, $data)
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            if (!empty($data->id)) {
                $db->where('id', $data->id);
                $db->update($table, $data);
                $this->return = $db->affected_rows();
            }
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
       
        return $this->return;
    }

    /**
     * --------------------------------------------------------------------------------
     * //! Update
     * --------------------------------------------------------------------------------
     *
     * Update row(s) into the passed table and return number of affected rows with sql query
     *
     * @usage : $this->pojo_model->updatePojoByQuery('db-name','table-name',$where,$data);
     */
    public function updatePojoByQuery($dbName, $table, $where, $data)
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            if (!empty($where)) {
                $this->addSqlToQuery($where);
                $db->update($table, $data);
                $this->return = $db->affected_rows();
            }
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $this->return;
    }
    /**
     * --------------------------------------------------------------------------------
     * //! Update
     * --------------------------------------------------------------------------------
     *
     * Update row(s) into the passed table value by one and if not affected any insert a new record
     *
     * @usage : $this->pojo_model->updatePojoColumnByone('db-name','table-name',$col,$data);
     */
    public function updatePojoColumnByone($dbName, $table, $col, $data)
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            $db->where($data);
            $db->set($col, ''.$col.'+1', false);
            $db->update($table);
            if (!$db->affected_rows()) {
                $db->insert($table, $data);
            }
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
     
        return $this->return;
    }
    /**
     * --------------------------------------------------------------------------------
     * //! Insert
     * --------------------------------------------------------------------------------
     *
     * Insert row(s) into the passed table
     *
     * @usage : $this->pojo_model->insertPojo('db-name','table-name',$data);
     */
    public function insertPojo($dbName, $table, $data)
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            $db->insert($table, $data);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return ($db->affected_rows()>0 ? true : false);
    }
    /**
     * --------------------------------------------------------------------------------
     * //! Insert
     * --------------------------------------------------------------------------------
     *
     * Insert row(s) into the passed table and return last_insert_id
     *
     * @usage : $this->pojo_model->insertPojoReturnId('db-name','table-name',$data);
     */
    public function insertPojoReturnId($dbName, $table, $data)
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            $db->insert($table, $data);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return ($db->affected_rows()>0?$db->insert_id():0);
    }
    /**
     * --------------------------------------------------------------------------------
     * //! Bulk Insert
     * --------------------------------------------------------------------------------
     *
     * Insert row(s) into the passed table
     *
     * @usage : $this->pojo_model->insertPojos('db-name','table-name',$data);
     */
    public function insertPojos($dbName, $table, $data)
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            $db->insert_batch($table, $data);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
       
        return ($db->affected_rows()>0?true:false);
    }
    /**
     * --------------------------------------------------------------------------------
     * //! Execute a SQL query
     * --------------------------------------------------------------------------------
     *
     * Excute a sql query  with read or write flag and return result array or object
     *
     * @usage : $this->pojo_model->executeSqlandReturnQuery('db-name',$sql,$read_flag,$result_);
     */
    public function executeSqlandReturnQuery($dbName, $sql, $read_flag = false, $result_='1')
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName, $read_flag);
            $result = $db->query($sql);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
            if ($read_flag) {
                return ($result_=='1'?$result->result_array():$result);
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $result ;
    }

    public function addSqlToQuery($sql)
    {
        if (is_array(($sql))) {
            foreach ($sql as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k1 => $v1) {
                        switch ($k1) {
                            case 'in': $query = $this->db->where_in($k, $v1);
                            break;
                            case 'notin': $query = $this->db->where_not_in($k, $v1);
                            break;
                            case 'like': $query = $this->db->like($k, $v1);
                            break;
                        }
                    }
                } else {
                    if (is_string($k)) {
                        $query = $this->db->where($k, $v);
                    } else {
                        $query = $this->db->where($v, null, false);
                    }
                }
            }
        } else {
            $query = $this->db->where($sql, null, false);
        }
        return $query;
    }

    public function table_exists($dbName, $table)
    {
        $this->db = $this->shard->get_Generic_Db($dbName);
        return $this->db->table_exists($table);
    }

    public function getPojo($dbName, $table, $paramArr=null, $sql = null, $sort = null, $read_flag = false, $select = null)
    {
        try {
            $this->db = $this->shard->get_Generic_Db($dbName, $read_flag);
            
            
            if ($select != null) {
                $query = $this->db->select($select, false);
            }
            
            if (!empty($sql)) {
                $this->addSqlToQuery($sql);
            }
            
            if (!empty($paramArr)) {
                foreach ($paramArr as $name=>$value) {
                    $query = $this->db->where($name, $value);
                }
            }
            if (!empty($sort)) {
                $query = $this->db->order_by($sort);
            }
            $query = $this->db->limit(1);
            
            $query = $this->db->get($table);
            if ($this->db->conn_id->errno){
                $this->log_error_db($this->db);
                
                return ['error' => true];
            }
            if (!empty($query) && $query->num_rows() == 0) {
                
                return null;
            }
            
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
                
        return $query->row();
    }

    public function getPojos($qyeryData)
    {
        try {
            $dbName = $this->readDb1;
            $select = $sortcol = $group_by = $table = $sql = null ;
            $order = 'asc';
            $offset = $limit = $return =0;
            $paramArr_in = $paramArr = $like_arr = [];
            
            if (is_array($qyeryData)) {
                foreach ($qyeryData as $key => $val) {
                    $$key = $val;
                }
            }
            $this->db = $this->shard->get_Generic_Db($dbName, true);
            
            if ($select != null) {
                $query = $this->db->select($select, false);
            }
            if (!empty($sql)) {
                $this->addSqlToQuery($sql);
            }
            
            if (!empty($paramArr)) {
                foreach ($paramArr as $name=>$value) {
                    $query = $this->db->where($name, $value);
                }
            }
            if (!empty($like_arr)) {
                foreach ($like_arr as $name=>$value) {
                    //echo print_r($value);
                    if (is_array($value)) {
                        foreach ($value as $name_sub=>$value_sub) {
                            if (is_array($value_sub)) {
                                foreach ($value_sub as $name_sub_con=>$value_sub_con) {
                                    if ($name_sub=='or') {
                                        $this->db->or_like($name_sub_con, $value_sub_con, $name);
                                    } else {
                                        $this->db->like($name_sub_con, $value_sub_con, $name);
                                    }
                                }
                            } else {
                                $this->db->like($name_sub, $value_sub, $name);
                            }
                        }
                    } else {
                        $this->db->like($name, $value);
                    }
                }
            }
            if (!empty($paramArr_in)) {
                foreach ($paramArr_in as $name=>$value) {
                    $query = $this->db->where_in($name, $value);
                }
            }
            if (!empty($sortcol)) {
                $query = $this->db->order_by($sortcol, $order);
            }
            if (!empty($group_by)) {
                $query = $this->db->group_by($group_by);
            }
            if ($limit > 0) {
                $query = $this->db->limit($limit, $offset);
            }
            
            $query = $this->db->get($table);
            if ($this->db->conn_id->errno){
                $this->log_error_db($this->db);
                
                return ['error' => true];
            }
            
            
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
                
        return ($return == 1 ?$query->result_array():($return==2?$query->row_array():$query->result()));
    }
    public function cache_delete_all($dbName)
    {
        $this->db = $this->shard->get_Generic_Db($dbName, true);
        $this->db->cache_delete_all();
    }
    public function getPojosCount($dbName, $sql, $table, $paramArr=null, $cache=false, $group_by = null, $count_field = null, $alias='numrows', $like_arr=array(), $paramArr_in=array())
    {
        try {
            $this->db = $this->shard->get_Generic_Db($dbName, true);
            if ($cache) {
                $this->db->cache_on();
            }
            if (!empty($sql)) {
                $this->addSqlToQuery($sql);
            }
            
            if (!empty($paramArr)) {
                foreach ($paramArr as $name=>$value) {
                    $this->db->where($name, $value);
                }
            }
            if (!empty($like_arr)) {
                foreach ($like_arr as $name=>$value) {
                    //echo print_r($value);
                    if (is_array($value)) {
                        foreach ($value as $name_sub=>$value_sub) {
                            $this->db->like($name_sub, $value_sub, $name);
                        }
                    } else {
                        $this->db->like($name, $value);
                    }
                }
            }
            if (!empty($paramArr_in)) {
                foreach ($paramArr_in as $name=>$value) {
                    $this->db->where_in($name, $value);
                }
            }
            if (!empty($group_by)) {
                $this->db->group_by($group_by);
            }
            if (!empty($count_field) && $alias=='numrows') {
                $this->db->_count_string = "SELECT COUNT(" . $count_field . ") AS ";
            } elseif (!empty($count_field) && $alias!='numrows') {
                $this->db->_count_string = "SELECT ".$count_field." as ".$alias.", COUNT(" . $count_field . ") AS ";
            }
            $this->db->from($table);
            
            $num = $this->db->count_all_results();
            if ($this->db->conn_id->errno){
                $this->log_error_db($this->db);
                
                return ['error' => true];
            }
           
            if ($cache) {
                $this->db->cache_off();
            }
            
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
                
        return $num;
    }

    public function deleteRow($dbName, $table, $paramArr=array())
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            if (!empty($paramArr)) {
                foreach ($paramArr as $name=>$value) {
                    $db->where($name, $value);
                }
            } else {
                return false;
            }
            $db->delete($table);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return ($db->affected_rows() ? true : false);
    }

    public function get_last_query()
    {
        return $this->db->last_query();
    }
    public function db_escape_str_($dbName='', $str)
    {
        try {
            if ($dbName=='') {
                $dbName = $this->readDb1;
            }
            $db = $this->shard->get_Generic_Db($dbName);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $db->escape_str($str) ;
    }
    public function trans_begin($dbName='', $bool=false)
    {
        try {
            if ($dbName=='') {
                $dbName = $this->writeDb1;
            }
            $db = $this->shard->get_Generic_Db($dbName);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $db->trans_begin($bool);
    }
    public function trans_start($dbName='', $bool=false)
    {
        try {
            if ($dbName=='') {
                $dbName = $this->writeDb1;
            }
            $db = $this->shard->get_Generic_Db($dbName);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $db->trans_start($bool);
    }
    public function trans_status($dbName='')
    {
        try {
            if ($dbName=='') {
                $dbName = $this->writeDb1;
            }
            $db = $this->shard->get_Generic_Db($dbName);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $db->trans_status();
    }
    public function trans_complete($dbName='')
    {
        try {
            if ($dbName=='') {
                $dbName = $this->writeDb1;
            }
            $db = $this->shard->get_Generic_Db($dbName);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
            
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $db->trans_complete();
    }
    public function trans_rollback($dbName='')
    {
        try {
            if ($dbName=='') {
                $dbName = $this->writeDb1;
            }
            $db = $this->shard->get_Generic_Db($dbName);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $db->trans_rollback();
    }
    public function trans_commit($dbName='')
    {
        try {
            if ($dbName == '') {
                $dbName = $this->writeDb1;
            }
            $db = $this->shard->get_Generic_Db($dbName);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $db->trans_commit();
    }

    public function getMaxId($dbName, $colName, $table)
    {
        try {
            $db = $this->shard->get_Generic_Db($dbName);
            $db->select_max($colName);
            $query = $db->get($table);
            if ($db->conn_id->errno){
                $this->log_error_db($db);
                
                return ['error' => true];
            }
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return $query->result();
    }

    public function getPojosByMultiJoin($qyeryData)
    {
        try {
            $dbName = $this->readDb1;
            $select = $sortcol = $group_by = $table = $joinTable = $joinCondition = $joinTable2 = $joinCondition2 = $paramArr = $joinTable3 = $joinCondition3 =null ;
            $order = 'asc';
            $offset = $limit = $return =0;
            $joinType = $joinType2 = $joinType3 = 'inner';
            $param_like = $paramArr_in = [];
            if (is_array($qyeryData)) {
                foreach ($qyeryData as $key => $val) {
                    $$key = $val;
                }
            }
            
            $this->db = $this->shard->get_Generic_Db($dbName, true);
            if ($select != null) {
                $this->db->select($select, false);
            }
            
            if (!empty($paramArr)) {
                foreach ($paramArr as $name=>$value) {
                    $this->db->where($name, $value);
                }
            }
            if (!empty($param_like)) {
                foreach ($param_like as $name=>$value) {
                    //echo print_r($value);
                    if (is_array($value)) {
                        foreach ($value as $name_sub=>$value_sub) {
                            $this->db->like($name_sub, $value_sub, $name);
                        }
                    } else {
                        $this->db->like($name, $value);
                    }
                }
            }
            if (!empty($paramArr_in)) {
                foreach ($paramArr_in as $name=>$value) {
                    $query = $this->db->where_in($name, $value);
                }
            }
            if (!empty($sortcol)) {
                $this->db->order_by($sortcol, $order);
            }
            if (!empty($group_by)) {
                $this->db->group_by($group_by);
            }
            if ($limit > 0) {
                $this->db->limit($limit, $offset);
            }
            if (!empty($joinTable) && !empty($joinCondition)) {
                $this->db->join($joinTable, $joinCondition, $joinType, false);
            }
            if (!empty($joinTable2) && !empty($joinCondition2)) {
                $this->db->join($joinTable2, $joinCondition2, $joinType2, false);
            }
            if (!empty($joinTable3) && !empty($joinCondition3)) {
                $this->db->join($joinTable3, $joinCondition3, $joinType3, false);
            }
            $query = $this->db->get($table);
  
            
            if (!empty($query) && $query->num_rows() == 0) {
                return [];
            } 
            if ($this->db->conn_id->errno){
                $this->log_error_db($this->db);
                
                return ['error' => true];
            }
           
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
        
        return ($return == 1 ? $query->result_array() : ($return == 2 ? $query->row_array() : $query->result()));
     }

    public function getPojosbyJoin($dbName, $table, $paramArr, $sortcol=null, $order = 'asc', $offset = 0, $limit = 0, $joinTable = null, $joinCondition = null, $joinType = 'inner', $select = null, $group_by = null, $return=0, $like_arr=array())
    {
        try {
            $this->db = $this->shard->get_Generic_Db($dbName, true);
            if ($select != null) {
                $this->db->select($select, false);
            }
            
            if (!empty($paramArr)) {
                foreach ($paramArr as $name=>$value) {
                    $this->db->where($name, $value);
                }
            }
            if (!empty($like_arr)) {
                foreach ($like_arr as $name=>$value) {
                    //echo print_r($value);
                    if (is_array($value)) {
                        foreach ($value as $name_sub=>$value_sub) {
                            $this->db->like($name_sub, $value_sub, $name);
                        }
                    } else {
                        $this->db->like($name, $value);
                    }
                }
            }
            if (!empty($sortcol)) {
                $this->db->order_by($sortcol, $order);
            }
            if (!empty($group_by)) {
                $this->db->group_by($group_by);
            }
            if ($limit > 0) {
                $this->db->limit($limit, $offset);
            }
            if (!empty($joinTable) && !empty($joinCondition)) {
                $this->db->join($joinTable, $joinCondition, $joinType, false);
            } else {
                $this->db->join($joinTable);
            }
            $query = $this->db->get($table);
            if ($this->db->conn_id->errno){
                $this->log_error_db($this->db);
                
                return ['error' => true];
            }
            if (!empty($query) && $query->num_rows() == 0) {
                
                return [];
            }
            
            
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
               
        return ($return == 1 ?$query->result_array():($return==2?$query->row_array():$query->result()));
    }

    public function getPojosCountbyJoin($dbName, $sql, $table, $paramArr, $joinTable = null, $joinCondition = null, $joinType = 'inner', $select = null, $group_by = null, $count_field = null, $alias='numrows', $paramArr_in=array())
    {
        try {
            $this->db = $this->shard->get_Generic_Db($dbName, true);
            
            if (!empty($sql)) {
                $this->addSqlToQuery($sql);
            }
            
            if ($select != null) {
                $this->db->select($select, false);
            }
            
            if (!empty($paramArr)) {
                foreach ($paramArr as $name=>$value) {
                    $this->db->where($name, $value);
                }
            }
            if (!empty($paramArr_in)) {
                foreach ($paramArr_in as $name=>$value) {
                    $this->db->where_in($name, $value);
                }
            }
            if (!empty($joinTable) && !empty($joinCondition)) {
                $this->db->join($joinTable, $joinCondition, $joinType, false);
            }
            if (!empty($group_by)) {
                $this->db->group_by($group_by);
            }
            if (!empty($count_field) && $alias=='numrows') {
                $this->db->_count_string = "SELECT COUNT(" . $count_field . ") AS ";
            } elseif (!empty($count_field) && $alias!='numrows') {
                $this->db->_count_string = "SELECT ".$count_field." as ".$alias.", COUNT(" . $count_field . ") AS ";
            }
            $this->db->from($table);
            $num = $this->db->count_all_results();
            if ($this->db->conn_id->errno){
                $this->log_error_db($this->db);
                
                return ['error' => true];
            }
            
        } catch (Exception $e) {
            $this->log_error_db($e->getMessage());
            
            return ['error' => true];
        }
                
        return $num;
    }

    public function log_error_db($db)
    {
        if ($db->conn_id->errno) {
            log_message('error', 'Query error: '.$db->conn_id->error);
        }
    }
}
