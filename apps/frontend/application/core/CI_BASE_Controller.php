<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_BASE_Controller extends CI_Controller
{
    public $data = [];
    public $userdata = [];
    public $sessionid = '';
    public $userId = 0;
    public $isLoggedIn = false;
    public $landingPage = 'home';
    public $accessType = 0;
    public $site_name = 'Ecommerce';
    public $accessD = false;
    public $uname = '';
    public $access_restrict = 'access restricted';
    public $userLogName = '';
    public $AccesUser = ['2'];
    public $user_type_id = '2';
    public $session_name_site = 'site_frontend_user';
    public $currency_code = ['1'=>'&#8377;','2'=>'&#36;'];
    public $cart_amount = 0;
    public $cart_count = 0;
    public $defaultCacheTime = 24*60*60;
    public $productListCacheName = 'product_list';
    public $discount_rate = (120/100);
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cfunctions');
        
        $this->load->driver('cache', array('adapter' => 'file'));
        $this->userdata = $this->session->userdata($this->session_name_site);
        $this->sessionid = $this->session->userdata('session_id');
        $this->userId = (isset($this->userdata['uid'])?$this->userdata['uid']:0);
        $this->userName = (isset($this->userdata['name'])?$this->userdata['name']:'');
        $this->userLogName = (isset($this->userdata['uname'])?$this->userdata['uname']:'');
        $this->isLoggedIn = (isset($this->userdata['user_logged_in'])?$this->userdata['user_logged_in']:false);
        $this->uname = $this->userName;
        $segment_uri = current_url();
        $this->currency_code = $this->currency_code[1];

      
    }

  
    public function commit_rollback($data=array())
    {
        if ($this->pojo->trans_status() === false) {
            //if something went wrong, rollback everything
            $this->pojo->trans_rollback();
            $data['errorCount'] = array('rollback','transaction has been rollbacked,please try again');
            $data['status']='0';
        } else {
            //if everything went right, commit the data to the database
            $this->pojo->trans_commit();
            $data['status']='1';
            
            //return TRUE;
        }
        return $data;
    }
 
}
