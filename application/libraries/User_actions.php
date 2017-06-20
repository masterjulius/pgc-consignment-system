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

class User_actions {

	protected $CI;

	public function __construct() {
        
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->library( array('session', 'array_actions') );
        $this->CI->load->database();

    }
    /**/

    public function _get_user_roles( $user_id ) {



    }
    /**/

    public function _get_role_capabilities(  ) {

    	
    	
    }

}

?>