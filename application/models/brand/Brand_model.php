<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Brand_model extends CI_Model {

		public function get_all_brand( $args = null, $isArray = FALSE, $isActive = TRUE ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( null != $args ) {

					if ( is_array( $args ) ) {

						$this->db->select( 'brand_id, brand_name, brand_description, brand_created_date, brand_created_by, brand_edited_date, brand_edited_by' );
						$this->db->where( 'brand_is_active', $isActive );
						$query = $this->db->get( 'tbl_item_brand' );

						if ( !empty( $args ) ) {

							if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && !array_key_exists( 'key', $args ) ) {

								$this->db->select( 'brand_id, brand_name, brand_description, brand_created_date, brand_created_by, brand_edited_date, brand_edited_by' );
								$this->db->where( 'brand_is_active', $isActive );
								$query = $this->db->get( 'tbl_item_brand', $args['limit'], $args['offset'] );

							} else if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && array_key_exists( 'key', $args ) ) {

								$this->db->select( 'brand_id, brand_name, brand_description, brand_created_date, brand_created_by, brand_edited_date, brand_edited_by' );
								$this->db->like( 'brand_name', $args['key'] );
								$this->db->or_like( 'brand_description', $args['key'] );
								$this->db->where( 'brand_is_active', $isActive );
								$query = $this->db->get( 'tbl_item_brand', $args['limit'], $args['offset'] );

							}

						}

						// run the query
						if ( $query ) {

							if ( $query->num_rows() > 0 ) {
								$returnDatas = array();
								foreach ( $query->result() as $row ) {
									
									$objectDatas = (object) array(
										'brand_id'				=>	$row->brand_id,
										'brand_name'			=>	$row->brand_name,
										'brand_description'		=>	$row->brand_description,
										'brand_created_date'	=>	$row->brand_created_date,
										'brand_created_by'		=>	$row->brand_created_by,
										'brand_edited_date'		=>	$row->brand_edited_date,
										'brand_edited_by'		=>	$row->brand_edited_by,
									);
									array_push( $returnDatas , $objectDatas );

								}

								if ( $isArray === FALSE ) {
									$returnDatas = (object) $returnDatas;
								}

								return $returnDatas;

							}

							return FALSE;

						}

					}

				}

			}

		}

		// getting the single brand meta datas
		public function get_single_brand( $user_id ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( is_numeric( $user_id ) ) {

					$this->db->select( 'brand_id, brand_name, brand_description' );
					$this->db->where( array( 'brand_id' => $user_id, 'brand_is_active' => TRUE ) );
					$query = $this->db->get( 'tbl_item_brand' );
					if ( $query ) {

						if ( $query->num_rows() > 0 ) {

							$returnDatas = array();
							while ( $row = $query->unbuffered_row() ) {
								$returnDatas['brand_id'] = $row->brand_id;
								$returnDatas['brand_name'] = $row->brand_name;
								$returnDatas['brand_description'] = $row->brand_description;

							}

							return (object) $returnDatas;

						}

						return false;

					}
					return false;

				}

			}

		}

		public function save_brand( $array_values ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( is_array( $array_values ) ) {

					if ( array_key_exists( 'brand_name', $array_values ) || array_key_exists( 'brand_description', $array_values ) ) {

						// set the date meta info
	        			$current_timestamp = date( "Y-m-d H:i:s" );
	        			$current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;

						if ( array_key_exists( 'brand_id', $array_values ) ) {

							$this->db->trans_start();
							// update action

							$current_datas = $this->_get_current_data( $array_values['brand_id'] );

							$data = array(
							    'brand_name'		=>	$array_values['brand_name'],
							    'brand_description'	=>	$array_values['brand_description'],
							    'brand_edited_by'	=>	$current_user_session_id
							);

							$this->db->where( 'brand_id', $array_values['brand_id'] );
							$query = $this->db->update( 'tbl_item_brand', $data );
							if ( $query ) {

								$meta_value = '{ "old" : {
										"brand_name" : "' . $current_datas->brand_name . '",
										"brand_description" "' . $current_datas->brand_description . '": ,
										"date_operated" "' . $current_datas->brand_edited_date . '":
									},
									"new" : {
										"brand_name" : "' . $array_values['brand_name'] . '",
										"brand_description" : "' . $array_values['brand_description'] . '",
										"date_operated" "' . $current_timestamp . '":
									},
									"created_by" : "'. $current_user_session_id .'"
								}';

								$meta_data = array(
									'meta_key_id'		=>	$this->ext_meta->get_meta_key_info( '_create_brand' )->key_id,
									'meta_brand_id'		=>	$array_values['brand_id'],
									'meta_value'		=>	$this->encryption->encrypt( $meta_value )	
								);

								if ( $this->_save_to_metatable( $meta_data ) ) {

									$this->db->trans_complete();

									return $array_values['brand_id'];

								}

							}

						} else {

							$this->db->trans_start();
							// add action
							$data = array(
							    'brand_name'		=>	$array_values['brand_name'],
							    'brand_description'	=>	$array_values['brand_description'],
							    'brand_created_by'	=>	$current_user_session_id
							);

							$query = $this->db->insert( 'tbl_item_brand', $data );
							if ( $query ) {

								$last_id = $this->db->insert_id();

								$meta_value = '{
									"brand_name" : "' . $array_values['brand_name'] . '",
									"brand_description" : "' . $array_values['brand_description'] . '",
									"date_operated" : "' . $current_timestamp . '",
									"created_by" : "'. $current_user_session_id .'"
								}';

								$meta_data = array(
									'meta_key_id'		=>	$this->ext_meta->get_meta_key_info( '_edit_brand' )->key_id,
									'meta_brand_id'		=>	$last_id,
									'meta_value'		=>	$this->encryption->encrypt( $meta_value )	
								);

								if ( $this->_save_to_metatable( $meta_data ) ) {

									if ($this->db->trans_status() === FALSE) {
										log_message();
									}

									$this->db->trans_complete();

									return $last_id;

								}

							}

						}

						return FALSE;

					}

				}

			}

		}

		/**
		 * ---------------------------------------------------------------------------
		 * - Delete or Restore the Brand
		 * @param int $brand_id = the id of the data to be updated
		 * @return boolean - if transaction is successfull then it should retun true. otherwise it should return false.
		 * ---------------------------------------------------------------------------
		 */
		public function delete_restore_brand( $brand_id, $action = 'delete' ) {

			if ( is_numeric( $brand_id ) ) {

				$current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;
				$current_timestamp = date( "Y-m-d H:i:s" );

				$meta_key_id = $this->ext_meta->get_meta_key_info( '_delete_brand' )->key_id;

				$meta_value = '{"date_created":"'. $current_timestamp .'","created_by":"'. $current_user_session_id .'"}';

				$update_value = array(
					'brand_edited_by'	=>	$current_user_session_id,
					'brand_is_active'	=>	FALSE
				);

				if ( $action === 'restore' || $action === 'r' ) {

					// restore
					$update_value = array(
						'brand_edited_by'	=>	$current_user_session_id,
						'brand_is_active'	=>	TRUE
					);
					$meta_key_id = $this->ext_meta->get_meta_key_info( '_restore_brand' )->key_id;

				}

				$this->db->trans_start();

				$this->db->where( 'brand_id', $brand_id );
				$query = $this->db->update( 'tbl_item_brand', $update_value );
				if ( $query ) {

					$meta_data = array(
						'meta_key_id'	=>	$meta_key_id,
						'meta_brand_id'	=>	$brand_id,
						'meta_value'	=>	$meta_value
					);
					if ( $this->db->insert( 'tbl_itembrandmeta', $meta_data ) ) {

						$this->db->trans_complete();

						return TRUE;

					}

					return FALSE;

				}

				return FALSE;

			}

		}

		// End method

		/**
		 * ---------------------------------------------------------------------------
		 * The list of transaction logs
		 * @param array $parameter_query - the array parameter for the query
		 * @return array/boolean - if it has data to fetch then the return value shoul be an array of datas with it's assigned array key. Otherwise it should return false.
		 * ---------------------------------------------------------------------------
		 */
		public function get_activity_logs( $parameter_query = null ) {

			$query = $this->db->get( 'tbl_itembrandmeta' );

			if ( null != $parameter_query || '' != $parameter_query ) {

				$query = $this->db->get( 'tbl_itembrandmeta' );

				if ( is_array( $parameter_query ) ) {
					
					if ( array_key_exists( 'limit', $parameter_query ) && array_key_exists( 'offset', $parameter_query ) ) {

						$query = $this->db->get( 'tbl_itembrandmeta', $parameter_query['limit'], $parameter_query['offset'] );

					}

				}

			}

			if ( $query ) {

				if ( $query->num_rows() > 0 ) {

					$returnDatas = array();

					foreach ( $query->result() as $row ) {

						$meta_value = $this->encryption->decrypt( $row->meta_value );
						$meta_key_id = $row->meta_key_id;
						$meta_key = $this->ext_meta->get_meta_key_info( array( 'key_id' => $meta_key_id ) )->key_name;
						if ( $meta_key == '_delete_brand' || $meta_key == '_restore_brand' ) {

							$meta_value = $row->meta_value;

						}

						$meta_action = 'Created A Brand';
						switch ( $meta_key ) {

							case '_edit_brand':
								$meta_action = 'Updated A Brand';
								break;

							case '_delete_brand':
								$meta_action = 'Deleted A Brand';
								break;
								
							case '_restore_brand':
								$meta_action = 'Restored A Brand';
								break;	
							
							default:
								$meta_action = 'Created A Brand';
								break;

						}
						
						$objectDatas = (object) array(
							'meta_id'			=>	$row->meta_id,
							'meta_action'		=>	$meta_action,
							'meta_brand_id'		=>	$row->meta_brand_id,
							'meta_key_id'		=>	$meta_key_id,
							'meta_value'		=>	$meta_value,
							'meta_created_date'	=>	$row->meta_created_date
						);

						array_push( $returnDatas , $objectDatas );

					}

					return $returnDatas;
				}
				return false;

			}

			return false;	

		}

		// ---------------------------------------------------------------------------

		// get the previous / current data
		private function _get_current_data( $brand_id ) {

			$this->db->select( 'brand_name, brand_description, brand_edited_date' );
			$this->db->where( 'brand_id', $brand_id );
			$query = $this->db->get( 'tbl_item_brand' );
			if ( $query ) {

				if ( $query->num_rows() > 0 ) {

					$returnDatas = array();

					while ( $row = $query->unbuffered_row() ) {

						$returnDatas['brand_name'] = $row->brand_name;
						$returnDatas['brand_description'] = $row->brand_description;

					}

					return (object) $returnDatas;

				}

			}

		}


		// inserting the meta datas to the meta table
		private function _save_to_metatable( $args ) {

			if ( null != $args || '' != $args ) {

				if ( is_array( $args ) ) {

					if ( $this->db->insert( 'tbl_itembrandmeta', $args ) ) {

						return TRUE;

					}

					return FALSE;

				}

			}

		}

	}
?>	