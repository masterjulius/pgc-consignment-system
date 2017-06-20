<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function get_user_from_sign_in( $username, $password ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			redirect('/Administrator/');

		} else {

			$stmt = 'SELECT `user_id`, `user_name`, `user_password`, `user_roles` FROM `tbl_users` WHERE `user_name`=? AND `user_password`=? AND `user_is_active`=1';
			$query = $this->db->query( $stmt, array( $username, $password ) );
			if ( $query ) {

				if ( $query->num_rows() > 0 ) {

					while ( $row = $query->unbuffered_row() ):

						if ( $username != $row->user_name || $password != $row->user_password ) {

							return NULL;

						} else {

							return array(
								'user_id' 		=> $row->user_id,
								'username'		=> $row->user_name,
								'userpassword'	=> $row->user_password,
								'user_roles'	=> $row->user_roles
							);

						}

					endwhile;	

				}

			}

		}

	}

	/**
	 * Saving the user profile
	 * @param array $args
	 * @return boolean/int $result
	 */
	public function save_user_data( $args ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			if ( is_array( $args ) ) {

				// $this->db->trans_start();

				$user_created_by = ( array_key_exists( 'user_created_by' , $args ) ) ? $args['user_created_by']: $args['user_edited_by'];

				$meta_values_json = '{ "username" : "'. $args['user_name'] .'", "password" : "'. $args['user_password'] .'", "created_by" : '. $user_created_by .' }';

				$meta_args = array();
				$meta_args['meta_key_id'] = $this->ext_meta->get_meta_key_info( '_create_user' )->key_id;
				$meta_args['meta_value'] = $this->encryption->encrypt( $meta_values_json );

				if ( array_key_exists( 'user_id', $args ) ) {

					// check if key user_id exists
					$meta_args['meta_user_id'] = $args['user_id'];
					$meta_args['meta_key_id'] = $this->ext_meta->get_meta_key_info( '_edit_user' )->key_id;

					if ( !empty( $args['user_id'] ) || $args['user_id'] != null ) {

						$identifier_id = $args['user_id'];
						unset( $args['user_id'] );

						// update action
						if ( $this->db->update( 'tbl_users', $args, array( 'user_id' => $identifier_id ) ) ) {

							if ( $this->db->insert( 'tbl_usermeta', $meta_args ) ) {

								return TRUE;

							}

						}

					}	

					return FALSE;

				} else {
					// add action
					// check if data already exists
					$this->db->where( array( 'user_name' => $args['user_name'], 'user_is_active' => TRUE ) );
    				$check = $this->db->get('tbl_users');
    				if ( $check->num_rows() > 0 ) {

    					// already exists
    					return FALSE;

    				} else {

    					if ( $this->db->insert('tbl_users', $args) ) {
							$last_id = $this->db->insert_id();
							$meta_args['meta_user_id'] = $last_id;
							if ( $this->db->insert( 'tbl_usermeta', $meta_args ) ) {

								return $last_id;

							}

						}

    				}

					return FALSE;

				}

				// $this->db->trans_complete();
				
			}

		}	

	}

	/** ---------------------------------------------------------------------------------------------
	 * |										FETCHING DATAS 										|
	 * ----------------------------------------------------------------------------------------------
	 */
	public function get_user_metadata( $user_id ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$this->db->select('user_id, user_name, user_roles, user_created_date, user_created_by');
			$this->db->from('tbl_users');
			$this->db->where( array( 'user_id' => $user_id , 'user_is_active' => TRUE ) );
			$query = $this->db->get();

			if ( $query ) {

				if ( $query->num_rows() > 0 ) {
					$returnDatas = array();
					while ( $row = $query->unbuffered_row() ) {

						$returnDatas['user_id'] = $row->user_id;
						$returnDatas['user_name'] = $row->user_name;
						$returnDatas['user_roles'] = $row->user_roles;
						$returnDatas['user_created_date'] = $row->user_created_date;
						$returnDatas['user_created_by'] = $row->user_created_by;

					}

					return (object) $returnDatas;

				}

				return FALSE;

			}

			return FALSE;

		}

	}

	/**
	 * Logs report
	 * @param arary $page_query = an array of keys with it's values for generating the query
	 * @return array/object $returnData = an array or object of fetched datas
	 */
	public function get_users_log( $page_query = null ) {

		$query = $this->db->get( 'tbl_usermeta' );

		if ( null != $page_query || '' != $page_query ) {
			if ( array_key_exists( 'limit', $page_query ) && array_key_exists( 'offset', $page_query ) ) {
				$this->db->order_by( "meta_date_created", "desc" );
				$query = $this->db->get('tbl_usermeta',  $page_query['limit'], $page_query['offset'] );
			}
		}

		if ( $query ) {

			if ( $query->num_rows() > 0 ) {

				$returnData = array();
				foreach ( $query->result() as $row ) {

					$meta_value = $this->encryption->decrypt( $row->meta_value );
					$meta_key_id = $row->meta_key_id;
					$meta_key = $this->ext_meta->get_meta_key_info( array('key_id' => $meta_key_id ) )->key_name;
					if ( $meta_key == '_delete_user' || $meta_key == '_restore_user' ) {

						$meta_value = $row->meta_value;

					}

					$meta_action = 'Created A Role';
					switch ( $meta_key ) {

						case '_edit_user':
							$meta_action = 'Updated A User';
							break;

						case '_delete_user':
							$meta_action = 'Deleted A User';
							break;
							
						case '_restore_user':
							$meta_action = 'Restored A User';
							break;		
						
						default:
							$meta_action = 'Created A User';
							break;

					}
					
					$arrValues = (object) array(
						'meta_id'			=>	$row->meta_id,
						'meta_action'		=>	$meta_action,
						'meta_user_id'		=>	$row->meta_user_id,
						'meta_key_id'		=>	$meta_key_id,
						'meta_value'		=>	$meta_value,
						'meta_date_created'	=>	$row->meta_date_created
					);
					array_push( $returnData, $arrValues );

				}

				return $returnData;

			}

		}
		return false;

	}

	// ------------------------------------------------------------------------------------------

	public function get_all_users( $page_query = null, $searchParam = null ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$query = $this->db->get( 'tbl_users', $page_query['limit'], $page_query['offset'] );

			if ( null != $page_query || '' != $page_query ) {

				if ( is_array( $page_query ) ) {

					if ( array_key_exists( 'limit', $page_query ) && array_key_exists( 'offset', $page_query ) ) {

						$this->db->select( 'user_id, user_name, user_roles, user_created_date, user_created_by' );
						$this->db->where( array( 'user_is_active' => TRUE ) );
						$query = $this->db->get( 'tbl_users', $page_query['limit'], $page_query['offset'] );

					}

				}


			}

			if ( null != $searchParam ) {


				if ( is_array( $searchParam ) ) {

					if ( array_key_exists( 'key', $searchParam ) && array_key_exists( 'limit', $searchParam ) && array_key_exists( 'offset', $searchParam ) ) {

						$this->db->select( 'user_id, user_name, user_roles, user_created_date, user_created_by' );
						$this->db->where( array( 'user_is_active' => TRUE ) );
						$this->db->like( 'user_name', $searchParam['key'] );
						$query = $this->db->get( 'tbl_users', $page_query['limit'], $page_query['offset'] );

					}

				}

			}

			// query execution here
			if ( $query ) {

				if ( $query->num_rows() > 0 ) {

					return $query->result();

				}

			}

			// end of query execution


		}

	}

}

?>	