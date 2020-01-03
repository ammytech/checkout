<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/* application custom constant */
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")?'https://':'http://');
defined('PROTOCOL')      OR define('PROTOCOL', $protocol);
defined('DOMAIN_HOST')      OR define("DOMAIN_HOST", PROTOCOL.$_SERVER["HTTP_HOST"]);
defined('LOCAL_PATH')      OR  define("LOCAL_PATH", "/");
defined('FILE_PATH')      OR define("FILE_PATH", DOMAIN_HOST.LOCAL_PATH);

$timezone = "Asia/Calcutta";
if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set($timezone);
}
defined('CURRENT_DATE_TIME')      OR define("CURRENT_DATE_TIME", date('Y-m-d H:i:s'));

/*
 * All response code constant
 *
 */
defined('RES_UNAUT')      OR define("RES_UNAUT", "1");
defined('RES_REQPARAM')      OR define("RES_REQPARAM", "2");
defined('RES_HASH')      OR define("RES_HASH", "3");
defined('RES_INVFIELD')      OR define("RES_INVFIELD", "4");
defined('RES_INVJSON')      OR define("RES_INVJSON", "5");
defined('RES_INVSRC')      OR define("RES_INVSRC", "6");
defined('RES_UKERR')      OR define("RES_UKERR", "520");
defined('SER_ERR_RES')      OR define("SER_ERR_RES", "7");
defined('RES_Forbid')      OR define("RES_Forbid", "8");
defined('TECHNICAL_ERROR')      OR define("TECHNICAL_ERROR", "500");

defined('SECURITY_KEY')     OR define("SECURITY_KEY", "security");
defined('ACCESS_KEY')     OR define("ACCESS_KEY", "accesskey");
defined('MANDATORY_FIELDS_KEY')     OR define("MANDATORY_FIELDS_KEY", "mandatory");
defined('MANDATORY_FIELDS_HASH_KEY')     OR define("MANDATORY_FIELDS_HASH_KEY", "mandatory_hash");
defined('INVALID_FIELD_KEY')     OR define("INVALID_FIELD_KEY", "invalid_field");
defined('INVALID_JSON_KEY')     OR define("INVALID_JSON_KEY", "invalid_json");
defined('INVALID_API_SOURCE_KEY')     OR define("INVALID_API_SOURCE_KEY", "invalid_api_source");
defined('SERVER_ERR_RES_KEY')     OR define("SERVER_ERR_RES_KEY", "server_err_res");
defined('TECHNICAL_ERROR_KEY')     OR define("TECHNICAL_ERROR_KEY", "technical_error");

