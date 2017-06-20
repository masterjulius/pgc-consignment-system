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

class Page_actions {

	protected $CI;

	public function __construct() {
        
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->library( array('array_actions') );

    }

    public function page_body_class() {

        $segments = array();
        $segments[0] = !empty( $this->CI->uri->segment(1) ) ? $this->CI->uri->segment(1) : 'home';
        $segments[1] = !empty( $this->CI->uri->segment(2) ) ? $this->CI->uri->segment(2) : 'index';
        return $segments[0] . '-' . $segments[1];

    }

    public function format_page_title( $title = '', $subtitle = '', $divider = '&mdash;', $format = 't-s' ) {

        $returnTitle = '';
        $splitStr = explode("-", $format);
        if ( $splitStr[0] === 't' ) {
            $returnTitle .= $title;
        } else if ( $splitStr[0] === 's' ) {
            $returnTitle .= $subtitle;
        }

        $returnTitle .= $divider;

        if ( $splitStr[1] === 't' ) {
            $returnTitle .= $title;
        } else if ( $splitStr[1] === 's' ) {
            $returnTitle .= $subtitle;
        }

        return $returnTitle;

    }


    public function _register_admin_pages( $args ) {

    	if ( !empty( $args ) || $args !== NULL ) {

    		foreach ( $args as $key => $value ) {
    			
    			

    		}

    	}

    }
    /**/

    public function _register_single_admin_page( $pageName, $capabilityPrefix, $parentFolder = '', $capabilityLevel = 10, $isArray = FALSE, $extension = 'php' ) {
        
        if ( $parentFolder != '' || $parentFolder != null ) {
            $parentFolder = $parentFolder . '/';
        }
        if ( file_exists( APPPATH . "views/{$parentFolder}{$pageName}." . $extension ) && !empty( $capabilityPrefix ) ) {

        	if ( $capabilityLevel === 10 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true,
                        'edit'          => true,
                        'delete'        => true,
                        'read'          => true,
                        'save'          => true,
                        'edit_others'   => true,
                        'delete_others' => true,
                        'print'         => true,
                        'import'        => true,
                        'export'        => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else if ( $capabilityLevel === 9 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true,
                        'edit'          => true,
                        'delete'        => true,
                        'read'          => true,
                        'save'          => true,
                        'edit_others'   => true,
                        'delete_others' => true,
                        'print'         => true,
                        'export'        => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else if ( $capabilityLevel === 8 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                    	'create' 		=> true,
                    	'edit'			=> true,
                    	'delete'		=> true,
                    	'read'			=> true,
                    	'save'			=> true,
                    	'edit_others'	=> true,
                    	'delete_others' => true,
                        'print'         => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else if ( $capabilityLevel === 7 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true,
                        'edit'          => true,
                        'delete'        => true,
                        'read'          => true,
                        'save'          => true,
                        'edit_others'   => true,
                        'delete_others' => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            }  else if ( $capabilityLevel === 6 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true,
                        'edit'          => true,
                        'delete'        => true,
                        'read'          => true,
                        'save'          => true,
                        'edit_others'   => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else if ( $capabilityLevel === 5 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                    	'create' 		=> true,
                    	'edit'			=> true,
                    	'delete'		=> true,
                    	'read'			=> true,
                    	'save'			=> true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else if ( $capabilityLevel === 4 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true,
                        'edit'          => true,
                        'delete'        => true,
                        'read'          => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else if ( $capabilityLevel === 3 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true,
                        'edit'          => true,
                        'delete'        => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else if ( $capabilityLevel === 2 ) {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true,
                        'edit'          => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            } else {

                $returnValue = array(
                    'name'          => $pageName,
                    'capabilities'  => array(
                        'create'        => true
                    )
                );

                $returnValue =  $isArray == FALSE ? $this->CI->array_actions->array_to_object( $returnValue ) : $returnValue;

                return $returnValue;

            }

        } else {

            die('Die: File(s) not found!');

        }  

    }
    /**/

    public function _get_page_capabilities( $pageName  ) {

    	if ( !empty( $pageName ) ) {

    		echo $pageName;

    	}

    }

}    

?>    