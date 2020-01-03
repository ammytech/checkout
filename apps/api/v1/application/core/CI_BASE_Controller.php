<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * API
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Amirullah Khan
 * @link		''
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class CI_BASE_Controller extends REST_Controller
{
    public $requestVar = ['api_source'=>''];
    public $site_name = 'App API';
    public $retMessage = '';
    public $errors = false;
    public $status = false;
    public $response_code = 0;
    public $http_stat = 200;
    public $cache_met = '';
    public $api_source_arr = array('android','ios','web');
    public $AccesUser = ['1'];
    public $tableNames = [];
    public $userName = '';
    public $userId = '';

    public function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
    }

    public function returnError($errortype)
    {
        switch ($errortype) {
            case SECURITY_KEY:
                $this->retMessage = 'Unauthorized';
                $this->response_code = RES_UNAUT;
                $this->http_stat = 401;
                break;
            case ACCESS_KEY:
                $this->retMessage = 'Forbidden';
                $this->response_code = RES_Forbid;
                $this->http_stat = 403;
                break;
            case MANDATORY_FIELDS_KEY:
                $this->retMessage = 'reqired parameter(s) is missing';
                $this->response_code = RES_REQPARAM;
                break;
            case MANDATORY_FIELDS_HASH_KEY:
                $this->retMessage = 'Hash doesn\'t match';
                $this->response_code = RES_HASH;
                $this->http_stat = 401;
                break;
                    
            case INVALID_FIELD_KEY:
                $this->retMessage = 'invalid field(s)';
                $this->response_code = RES_INVFIELD;
                break;
                    
            case INVALID_JSON_KEY:
                $this->retMessage = 'invalid json';
                $this->response_code = RES_INVJSON;
                break;
            case INVALID_API_SOURCE_KEY:
                $this->retMessage = 'invalid api source';
                $this->response_code = RES_INVSRC;
                break;
            case SERVER_ERR_RES_KEY:
                //$this->retMessage = 'mobile unregistered';
                $this->response_code = SER_ERR_RES;
                break;
            case TECHNICAL_ERROR_KEY:
                $this->retMessage = 'Something went wrong';
                $this->response_code = TECHNICAL_ERROR;
                break;
            default:
                $this->retMessage = 'Unknown Error';
                $this->http_stat = 520;
                $this->response_code = RES_UKERR;
                break;
        }

        $retArr = array('status'=>$this->status,
                        'message'=>$this->retMessage,
                        'code'=>$this->response_code,
        );

        $this->retResponse($retArr, $this->http_stat);
    }

    public function returnOutput($data=array(), $status = true, $retMess = '', $code=0)
    {
        $data['status'] = $status;
        $data['message'] = $retMess;
        $data['code'] = $code;
        //$this->responseEMail($data);
        $this->retResponse($data, $this->http_stat);
    }
    public function retResponse($arr, $code)
    {
        //var_dump($this->pojo->transaction_start);exit;
        if ($this->pojo->transaction_start) {
            $this->commit_rollback();
        }
        $this->response($arr, $code);
    }

    public function is_session_create($source)
    {
        return (in_array($source, $this->session_create_source)?true:false);
    }
    public function is_session_load($source='')
    {
        if ($source == '') {
            $method = $this->request->method;
            $source =  $this->input->$method('api_source', true);
        }
        if (in_array($source, $this->session_create_source)) {
            $this->load->library('session');
        }
    }
    public function assignRequestVariables($method = 'get')
    {
        $response =  $this->input->$method(null, true);//$this->input->post(NULL, TRUE)
        //echo '<pre>';print_r($response);exit;
        $response = (is_array($response)?array_map("trim", $response):'');
        foreach ($this->requestVar as $key=>$var) {
            $this->requestVar[$key] = urldecode((isset($response[$key])?$response[$key]:$this->requestVar[$key]));
        }
        $this->validateIt();
        $this->checkApiSource();
    }
    public function validateIt()
    {
        $error_name = '';
        if ($this->requestVar['api_source'] == '') {
            $error_name = 'mandatory';
        }
        if ($error_name!='') {
            $this->returnError($error_name);
        }
    }
    public function checkApiSource()
    {
        $error_name = '';
        if (!in_array($this->requestVar['api_source'], $this->api_source_arr)) {
            $error_name = 'invalid_api_source';
        }
        if ($error_name!='') {
            $this->returnError($error_name);
        }
    }
    public function commit_rollback($data = [])
    {
        //$this->pojo->trans_complete();
        if ($this->pojo->trans_status() === false) {
            //if something went wrong, rollback everything
            $this->pojo->trans_rollback();
            $this->retMessage = 'something went wrong so rollbacked,please try again';
            $this->returnError('server_err_res');
        } else {
            //if everything went right, commit the data to the database
            $this->pojo->trans_commit();
        }
    }
    public function processErrorResponse(){
        if ($this->response_code === RES_UNAUT) {
            return $this->returnError(SECURITY_KEY);
        }
        if ($this->response_code === RES_INVSRC) {
            return $this->returnError(INVALID_API_SOURCE_KEY);
        }
        
    }
    public function logIt($data = [], $tablename='')
    {
        $otherDetails = ['table_name' => $tablename];
        $log_data = ['name' => $this->userName,
            'uid' => $this->userId,
            'description' => json_encode($data + $otherDetails),
            'ip_address' => ip2long($this->input->ip_address())];
        return $this->pojo->insertPojoReturnId($this->pojo->writeDb1, 'backend_logs', $log_data);
        
    }
}
