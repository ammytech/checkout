<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Shard Class
 *
 * This class enables you to partition a system based on a central entity id ..
 * A range of id's belong to a shard .. Whole system is based on a assumption that ids are auto incremented in each shard and all the shards have different ranges ..
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @link
 */

class Shard
{
    public $shard_cache = null;
    public $core = null;
    private static $conn_arr= array();


    public function __construct()
    {
        $this->core = $this->get_core();
        $this->core->load->database();
    }




    /**
     * Enter description here...
     *
     * @param string $shard
     * @return string
     */
    public function write($shard)
    {
        return $shard."-1" ;
    }

    /**
     * Enter description here...
     *
     * @param string $shard
     * @return string
     */
    public function read($shard)
    {
        return $shard."-0" ;
    }


    /**
     * Enter description here...
     *
     * @param string $item
     * @return string
     */
    public function get_item($item)
    {
        return $this->core->config->item($item);
    }

    /**
     * Enter description here...
     *
     * @param string $group
     * @return array
     */
    public function get_db($group, $active = false)
    {
        if (empty(Shard::$conn_arr[$group])) {
            Shard::$conn_arr[$group] = $this->core->load->database($group, $active);
        }
        return Shard::$conn_arr[$group];
    }


    /**
     * Enter description here...
     *
     * @param string $id
     * @return array
     */
    public function get_write_db($name)
    {
        $dbgroup = $this->write($name);
        return $this->get_db($dbgroup, true);
    }

    /**
     * Enter description here...
     *
     * @param string $entityid
     * @return array
     */
    public function get_read_db($name)
    {
        $dbgroup = $this->read($name);
        return $this->get_db($dbgroup, true);
    }

    /**
     * Enter description here...
     *
     * @return object
     */
    public function get_core()
    {
        $CI =& get_instance();
        return $CI;
    }




    public function get_Generic_Db($name, $read_flag=false)
    {
        if ($read_flag) {
            return $this->get_read_db($name);
        } else {
            return $this->get_write_db($name);
        }
    }
}

// END CI_Shard class

/* End of file Shard.php */
/* Location: ./system/libraries/Shard.php */
