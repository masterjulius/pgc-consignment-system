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
	class Array_actions {

		public function __construct() {
			// parent::__construct();
		}

		public function array_to_object( $a ) {
			if ( is_array( $a ) ) {
			    foreach($a as $k => $v) {
			        if ( is_integer( $k ) ) {
			            // only need this if you want to keep the array indexes separate
			            // from the object notation: eg. $o->{1}
			            $a['index'][$k] = $this->array_to_object( $v );
			        } 
			        else {
			        	$a[$k] = $this->array_to_object( $v );
			        }
			    }

			    return (object) $a;
			}

			// else maintain the type of $a
			return $a;
		}

		// checking if array is associated
		public function isAssoc( $arr ) {
			return array_keys($arr) !== range(0, count($arr) - 1);
		}

	}
?>