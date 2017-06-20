<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * It will still use the database reference of the codeigniter
 *
 * @package     CodeIgniter
 * @author      Julius Palcong
 * @copyright   Copyright (c) 2017, Cagayan Provincial Capitol.
 * @license     
 * @link        http://www.cagayan.gov.ph
 * @since       Version 1.0
 *
 * @filesource
 */
	class Ext_meta {

		protected $CI;

		public function __construct() {

			// Assign the CodeIgniter super-object
	        $this->CI =& get_instance();
	        $this->CI->load->library( array('array_actions') );
	        $this->CI->load->library( array('encryption') );
	        $this->CI->load->database();

		}

		// getting the user

		// ---------------------------------- META GROUP -----------------------------------------
		// ** get meta data **/	
		public function get_meta_data( $data_id, $meta_key, $meta_group ) {



		}
		// getting the meta id of a meta key
		public function get_meta_key_info( $mixed_key ) {
			// $mixed_key = string/array()

			if ( is_array( $mixed_key ) ) {

				// if array
				$query = $this->CI->db->get_where( 'tbl_metakeys', $mixed_key );
				return $this->_generate_unbuffered_results( $query );

			} else {

				// if string
				$query = $this->CI->db->get_where( 'tbl_metakeys', array( 'key_name' => $mixed_key ) );
				return $this->_generate_unbuffered_results( $query );

			}

		}

		// getting the user meta data
		public function get_user_meta_data( $user_id, $return_field = '' ) {
			
			if ( $return_field === '' || $return_field === null ) {

				// return an array
				$returnDatas = array(
					'user_id' => 0,
					'user_name' => 'System Default',
					'user_password' => '$6$rounds=5000$@eVrY49(`a sMV6|$p5bggQTL/.M3xfPnJGCe6mMSTStnZ9PBTjE9tIohrHFQYDRlozjblQYzTD4vhlYMrrcbz1cQGuG0L0sWG1Ncy1',
					'user_roles' => '{}',
					'user_created_date' => '0000-00-00',
					'user_created_by' => 0,
				);
				$query = $this->CI->db->get_where( 'tbl_users', array( 'user_id' => $user_id, 'user_is_active' => true ) );
				while ( $row = $query->unbuffered_row() ) {
					$returnDatas['user_id'] = $row->user_id;
					$returnDatas['user_name'] = $row->user_name;
					$returnDatas['user_password'] = $row->user_password;
					$returnDatas['user_roles'] = $this->CI->encryption->decrypt( $row->user_roles );
					$returnDatas['user_created_date'] = $row->user_created_date;
					$returnDatas['user_created_by'] = $row->user_created_by;
				}
				return (object) $returnDatas;

			} else {

				// return single field
				$this->CI->db->select( $return_field );
				$this->CI->db->from('tbl_users');
				$this->CI->db->where( array( 'user_id' => $user_id, 'user_is_active' => TRUE ) );
				$query = $this->CI->db->get();

				if ( $query ) {

					if ( $query->num_rows() > 0 ) {

						while ( $row = $query->unbuffered_row() ) {
							return $row->$return_field;
						}

					}

				}

			}
			
		}

		/** -----------------------------------------------------------------------------------------
		 * |								ROLES META GROUP 										|
		 * ------------------------------------------------------------------------------------------
		 */

		// ROLE META
		public function get_role_meta_data( $role_id, $return_field = '' ) {

			if ( $return_field === '' || $return_field === null ) {

				// return an array
				$returnDatas = array(
					'role_id' => 0,
					'role_name' => 'System Default',
					'role_description' => '',
					'role_value' => '78001d1b7f98388588c20fd1d9efdda0c5cc698f3a068d1db7bcb8c06f7dff3ee73e91f9848ff1add46535c608c0c91bf5aa945f379a81604149bd2bc213f40fsOcIz2wkeOjmP49clIT7q/a/QQTAPdYa0NhlmhqV0BsYUBTHHHmiC7NmJOqI17WV0VhbOCqfgFA51YyHIc6WGeSUIlhr3edhK3t8txepdWB+d4029U9juD8eVeRPg5GGDy4VQ3s84mu4b/VE2bsuqXtSLR4N7LzA91iUQqZtEbE7jcsgYRuQ2U66uyponSlHRylrhV7vH8I01qwiidaYv0qKOnuIA+i9aqVjMZOY3ylW+isDIRVDOcBY1uWPcQNXP8dgMXG5Z7awjW7z2cpYF1SSP7UPEnTDzpDGfloJ7bcdpW9DnK6UNodag1vR5pglHt6Et62+FK9FiS0qDthRuEnDeHjB03qlNIOx3wbOfdbGooSyCEMwGDT8sWyRKpsOBx+d4RsVJz+Z4zxp6ZXjnmVNERPLayNIf2M3hBhLX0mQZWbkLm2Gc1wdKuK9rsKzg7kb12mhyaLe8fFFtA9AdAU32JP0jihP1uGDaeSnLJVKPbPye0ivBAmrplwudpnLStaeCODxRPavYr53gUh51KeiQBazpbhd5LaAhfgpX+RR6/aMmb4SucIb+BD9WDcx/xQq2D7rcwQ+AHoiHYdU7Mh//jB/7ZrOQAZl289nl/Y33dy0IE6/MKC0EQIWh1pfOzEANhayOhc310anQvN8cRn5aq617hhZU4NwT3wNr2Fxo7JoyGu43aYikZrlfx/SDMHASZtTrJXbImsA7/qXgpmXQyWJd1xGq8wpEh7OSdqn1m8p0KWJYRrEC7ZSStdzBupfVnFnV1Z21e1Ymk1Fjgr1Ww6qMnOIQOI4vX0Y9k/bym8Ey/zdG0lJc2M6NBcDYOCeRGGNKyYCrujfM5QlKSczfzQtseHCMBvrC6jk7hd8MvfA4oHZ0x2X4W6Kvd5nD8dXDNLc3sypZipv9p6DcwKuYBNryWgzbd2rwHO/qLWdV2zbCj7p6zqBIwoGOBRzleSMEcSjT+JPSILSJkXT5ffkKtAs2NsNLoUjxy1SfVlMWNm+D1xDexYmT8g4t5oW+eNA7WiX5XQ5Xw/yTvBH7QI2ZeyDYh9sQilLL5ITQGLGk2baOZvHXX++PGzswn1nYrr75O/xc65+PRoEt+FZRf3SL5COD365HxGqDbK+1i6GdQso5XG+4gHjxXjbdbQ7',
					'role_created_date' => '0000-00-00',
					'role_created_by' => 0,
				);
				$query = $this->CI->db->get_where( 'tbl_roles', array( 'role_id' => $role_id, 'role_is_active' => true ) );
				while ( $row = $query->unbuffered_row() ) {
					$returnDatas['role_id'] = $row->role_id;
					$returnDatas['role_name'] = $row->role_name;
					$returnDatas['role_description'] = $row->role_description;
					$returnDatas['role_value'] = $this->CI->encryption->decrypt( $row->role_value );
					$returnDatas['role_created_date'] = $row->role_created_date;
					$returnDatas['role_created_by'] = $row->role_created_by;
				}
				return (object) $returnDatas;

			} else {

				// return single field
				$this->CI->db->select( $return_field );
				$this->CI->db->from('tbl_roles');
				$this->CI->db->where( array( 'role_id' => $role_id, 'role_is_active' => TRUE ) );
				$query = $this->CI->db->get();

				if ( $query ) {

					if ( $query->num_rows() > 0 ) {

						while ( $row = $query->unbuffered_row() ) {
							return $row->$return_field;
						}

					}

				}

			}

		}

		// --------------------------------- Private functions -------------------------------------
		// -----------------------------------------------------------------------------------------
		private function _generate_unbuffered_results( $query, $returnArray = FALSE ) {

			if ( !empty( $query ) ) {

				$returnResult = array();
					
				// if variable is array
				if ( FALSE === $returnArray ) {

					while ( $row = $query->unbuffered_row() ) {

						$returnResult[ 'key_id' ] = $row->key_id;
						$returnResult[ 'key_name' ] = $row->key_name;
						$returnResult[ 'key_is_reserved' ] = $row->key_is_reserved;

					}

					return (object) $returnResult;

				} else {

					while ( $row = $query->unbuffered_row( 'array' ) ) {

						$returnResult[ 'key_id' ] = $row['key_id'];
						$returnResult[ 'key_name' ] = $row['key_name'];
						$returnResult[ 'key_is_reserved' ] = $row['key_is_reserved'];

					}

					return $returnResult;

				}

			}

		}
		
		// counting the total capability for a role
		private function _count_overall_capabilities( $mixed_str ) {

			if ( is_string( $mixed_str ) ) {

				$cap_count = 0;
				$mixed_str = $this->encryption->decrypt( $mixed_str );
				$mixed_str = json_decode( $mixed_str );

				foreach ($mixed_str->pages as $key => $value) {

					foreach ($mixed_str->pages->$key as $capKey => $capValue) {
						
						if ( $capValue == 1 || $capValue == "1" ) {
							$cap_count+=1;
						}

					}

				}

				return $cap_count;

			}

		}

	}

?>