<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SITS
 *
 * @package		SITS
 * @author		SITS Dev Team
 */

/**
 * Template CSS Path - Return Templates CSS
 *
 * @access	public
 * @param	string
 * @return	string	depends on what the array contains
 */
if ( ! function_exists('c_site_url'))
{
    function c_site_url( $url = NULL )
    {
        if(NULL!==$url)
            $url = $url ;//. '.html';
                
        return base_url($url);
    }
}

if (!function_exists('show_flash_message')) {
    function show_flash_message($return = FALSE) {
        $CI =& get_instance();
        $message = $CI->session->flashdata('message');
        if (!empty($message)) {
            //echo'<pre>';print_r($message);die;
            $message['type'] = isset($message['type']) ? $message['type'] : 'error';
            $alert = '<div class="alert alert-' . $message['type'] . '">';
            $alert .= '<button class="close" data-dismiss="alert"></button>';
            $alert .= '<span>' . $message['message'] . '</span>';
            $alert .= '</div>';
            if ($return == TRUE) {
                return $alert;
            }
            echo $alert;
        }
        return FALSE;
    }
}