<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (! function_exists('encrypt_decrypt')) {
    function encrypt_decrypt($action, $string)
    {
        $output = false;
        $key = 'wodos12';
        // initialization vector
        $iv = md5(md5($key));
        if ($action == 'encrypt') {
            $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
            $output = base64_encode($output);
        } elseif ($action == 'decrypt') {
            $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
            $output = rtrim($output, "");
        }
        return $output;
    }
}

if (! function_exists('setSiteCookie')) {
    function setSiteCookie($name='', $value='', $expire=0, $domain='', $path='/', $prefix='', $secure=false)
    {
        $CI = & get_instance();
        $CI->load->helper('cookie');
        $cookie = array(
                'name'   => $name,
                'value'  => encrypt_decrypt('encrypt', $value),
                'expire' => $expire,
                'domain' => $domain,
                'path'   => $path,
                'prefix' => $prefix,
                'secure' => $secure,
        );
        $CI->input->set_cookie($cookie);
    }
}

if (! function_exists('setSiteSess')) {
    function setSiteSess($sess_data = array(), $session_name = 'site_backend_user')
    {
        $CI = & get_instance();
        $userdata = array();

        foreach ($sess_data as $key => $rows) {
            if (is_array($key)) {
            } else {
                $userdata [$session_name] = $rows;
            }
        }
        // print_r($userdata);exit;
        $CI->session->set_userdata($userdata);
        return true;
    }
}
if (! function_exists('unsetSiteSess')) {
    function unsetSiteSess($array_items)
    {
        if (empty($array_items)) {
            return false;
        }
        $CI = & get_instance();
        $CI->session->unset_userdata($array_items);
        return true;
    }
}
if (! function_exists('in_array_r')) {
    function in_array_r($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}
if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null)
    {
        $array = array();
        foreach ($input as $value) {
            if (! isset($value[$columnKey])) {
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            } else {
                if (! isset($value[$indexKey])) {
                    return false;
                }
                if (! is_scalar($value[$indexKey])) {
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

if (! function_exists('getSiteTitle')) {
    function getSiteTitle($title)
    {
        $CI = & get_instance();
        return ucfirst($CI->router->class) . ' - '. $CI->site_name;
    }
}


if (! function_exists('isJson')) {

    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}



/* End of file cfunctions_helper.php */
/* Location: ./application/helpers/cfunctions_helper.php */
