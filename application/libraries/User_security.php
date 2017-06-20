<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @author      Julius Palcong
 * @copyright   Copyright (c) 2017, Cagayan Provincial Capitol.
 * @license     
 * @link        http://www.cagayan.gov.ph
 * @since       Version 1.0
 * @filesource
 */

class User_security {

	protected $CI;

	public function __construct() {
        
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->library('session');

    }

    public function register_session_data( $data, $prefix = 'CI_extended_sess_' ) {

        if ( !empty( $data ) ) {

            if ( is_array( $data ) ) {

                foreach ($data as $key => $value) {
                
                    $data[ $prefix . $key ] = $value;
                    unset( $data[ $key ] );

                }

            }

            $this->CI->session->set_userdata( $data );

        } else {
            die( 'Parameters in session datas must be array!' );
        }

    }

    public function is_user_logged_in( $prefix = 'CI_extended_sess_', $session_name = 'user_id' ) {

    	$retValue = false;
        if ( !empty( $prefix ) || $prefix !== '' || $prefix !== NULL ) {

            $session_name = $prefix . $session_name;

        }

    	if ( $this->CI->session->userdata( $session_name ) ) {

    		return true;

    	}
    	return $retValue;

    }

    public function unset_session_data( $prefix = 'CI_extended_sess_', $session_name = 'user_id' ) {

        if ( !empty( $prefix ) || $prefix !== '' || $prefix !== NULL ) {

            $session_name = $prefix . $session_name;

        }

    	$this->CI->session->unset_userdata( $session_name );

    }

}

?>