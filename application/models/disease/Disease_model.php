<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class disease_model extends CI_Model {

		public function get_all_disease( $args = null, $isArray = FALSE, $isActive = TRUE ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {


				$this->db->select( 'disease_id, disease_name, disease_description, disease_created_date, disease_created_by, disease_edited_date, disease_edited_by' );
				$this->db->where( 'disease_is_active', $isActive );
				$query = $this->db->get( 'tbl_diseases' );

				if ( !empty( $args ) ) {

					if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && !array_key_exists( 'key', $args ) ) {

						$this->db->select( 'disease_id, disease_name, disease_description, disease_created_date, disease_created_by, disease_edited_date, disease_edited_by' );
						$this->db->where( 'disease_is_active', $isActive );
						$query = $this->db->get( 'tbl_diseases', $args['limit'], $args['offset'] );

					} else if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && array_key_exists( 'key', $args ) ) {

						$this->db->select( 'disease_id, disease_name, disease_description, disease_created_date, disease_created_by, disease_edited_date, disease_edited_by' );
						$this->db->like( 'disease_name', $args['key'] );
						$this->db->or_like( 'disease_description', $args['key'] );
						$this->db->where( 'disease_is_active', $isActive );
						$query = $this->db->get( 'tbl_diseases', $args['limit'], $args['offset'] );

					}

				}

						// run the query
				if ( $query ) {

					if ( $query->num_rows() > 0 ) {
						$returnDatas = array();
						foreach ( $query->result() as $row ) {

							$objectDatas = (object) array(
								'disease_id'			=>	$row->disease_id,
								'disease_name'			=>	$row->disease_name,
								'disease_description'	=>	$row->disease_description,
								'disease_created_date'	=>	$row->disease_created_date,
								'disease_created_by'	=>	$row->disease_created_by,
								'disease_edited_date'	=>	$row->disease_edited_date,
								'disease_edited_by'		=>	$row->disease_edited_by,
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

		// getting the single disease meta datas
		public function get_single_disease( $disease_id ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( is_numeric( $disease_id ) ) {

					$this->db->select( 'disease_id, disease_name, disease_description' );
					$this->db->where( array( 'disease_id' => $disease_id, 'disease_is_active' => TRUE ) );
					$query = $this->db->get( 'tbl_diseases' );
					if ( $query ) {

						if ( $query->num_rows() > 0 ) {

							$returnDatas = array();
							while ( $row = $query->unbuffered_row() ) {
								$returnDatas['disease_id'] = $row->disease_id;
								$returnDatas['disease_name'] = $row->disease_name;
								$returnDatas['disease_description'] = $row->disease_description;
							}

							return (object) $returnDatas;

						}

						return false;

					}
					return false;

				}

			}

		}

		public function save_disease( $array_values ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( is_array( $array_values ) ) {

					if ( array_key_exists( 'disease_name', $array_values ) || array_key_exists( 'disease_description', $array_values ) ) {

						// set the date meta info
	        			$current_timestamp = date( "Y-m-d H:i:s" );
	        			$current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;

						if ( array_key_exists( 'disease_id', $array_values ) ) {

							$this->db->trans_start();
							// update action

							$current_datas = $this->_get_current_data( $array_values['disease_id'] );

							$data = array(
							    'disease_name'			=>	$array_values['disease_name'],
							    'disease_description'	=>	$array_values['disease_description'],
							    'disease_edited_by'		=>	$current_user_session_id
							);

							$this->db->where( 'disease_id', $array_values['disease_id'] );
							$query = $this->db->update( 'tbl_diseases', $data );
							if ( $query ) {

								$meta_value = '{ "old" : {
										"disease_name" : "' . $current_datas->disease_name . '",
										"disease_description" : "' . $current_datas->disease_description . '",
										"date_operated" : "' . $current_datas->disease_edited_date . '"
									},
									"new" : {
										"disease_name" : "' . $array_values['disease_name'] . '",
										"disease_description" : "' . $array_values['disease_description'] . '",
										"date_operated" : "' . $current_timestamp . '"
									},
									"created_by" : "'. $current_user_session_id .'"
								}';

								$meta_data = array(
									'meta_key_id'		=>	$this->ext_meta->get_meta_key_info( '_create_disease' )->key_id,
									'meta_disease_id'	=>	$array_values['disease_id'],
									'meta_value'		=>	$this->encryption->encrypt( $meta_value )	
								);

								if ( $this->_save_to_metatable( $meta_data ) ) {

									$this->db->trans_complete();

									return $array_values['disease_id'];

								}

							}

						} else {

							$this->db->trans_start();
							// add action
							$data = array(
							    'disease_name'			=>	$array_values['disease_name'],
							    'disease_description'	=>	$array_values['disease_description'],
							    'disease_created_by'	=>	$current_user_session_id
							);

							$query = $this->db->insert( 'tbl_diseases', $data );
							if ( $query ) {

								$last_id = $this->db->insert_id();

								$meta_value = '{
									"disease_name" : "' . $array_values['disease_name'] . '",
									"disease_description" : "' . $array_values['disease_description'] . '",
									"date_operated" : "' . $current_timestamp . '",
									"created_by" : "'. $current_user_session_id .'"
								}';

								$meta_data = array(
									'meta_key_id'		=>	$this->ext_meta->get_meta_key_info( '_edit_disease' )->key_id,
									'meta_disease_id'		=>	$last_id,
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
		 * - Delete or Restore the disease
		 * @param int $disease_id = the id of the data to be updated
		 * @return boolean - if transaction is successfull then it should retun true. otherwise it should return false.
		 * ---------------------------------------------------------------------------
		 */
		public function delete_restore_disease( $disease_id, $action = 'delete' ) {

			if ( is_numeric( $disease_id ) ) {

				$current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;
				$current_timestamp = date( "Y-m-d H:i:s" );

				$meta_key_id = $this->ext_meta->get_meta_key_info( '_delete_disease' )->key_id;

				$meta_value = '{"date_created":"'. $current_timestamp .'","created_by":"'. $current_user_session_id .'"}';

				$update_value = array(
					'disease_edited_by'	=>	$current_user_session_id,
					'disease_is_active'	=>	FALSE
				);

				if ( $action === 'restore' || $action === 'r' ) {

					// restore
					$update_value = array(
						'disease_edited_by'	=>	$current_user_session_id,
						'disease_is_active'	=>	TRUE
					);
					$meta_key_id = $this->ext_meta->get_meta_key_info( '_restore_disease' )->key_id;

				}

				$this->db->trans_start();

				$this->db->where( 'disease_id', $disease_id );
				$query = $this->db->update( 'tbl_diseases', $update_value );
				if ( $query ) {

					$meta_data = array(
						'meta_key_id'	=>	$meta_key_id,
						'meta_disease_id'	=>	$disease_id,
						'meta_value'	=>	$meta_value
					);
					if ( $this->db->insert( 'tbl_diseasemeta', $meta_data ) ) {

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

			$query = $this->db->get( 'tbl_diseasemeta' );

			if ( null != $parameter_query || '' != $parameter_query ) {

				$this->db->order_by( "meta_created_date", "desc" );
				$query = $this->db->get( 'tbl_diseasemeta' );

				if ( is_array( $parameter_query ) ) {
					
					if ( array_key_exists( 'limit', $parameter_query ) && array_key_exists( 'offset', $parameter_query ) ) {

						$query = $this->db->get( 'tbl_diseasemeta', $parameter_query['limit'], $parameter_query['offset'] );

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
						if ( $meta_key == '_delete_disease' || $meta_key == '_restore_disease' ) {

							$meta_value = $row->meta_value;

						}

						$meta_action = 'Created A disease';
						switch ( $meta_key ) {

							case '_edit_disease':
								$meta_action = 'Updated A disease';
								break;

							case '_delete_disease':
								$meta_action = 'Deleted A disease';
								break;
								
							case '_restore_disease':
								$meta_action = 'Restored A disease';
								break;	
							
							default:
								$meta_action = 'Created A disease';
								break;

						}
						
						$objectDatas = (object) array(
							'meta_id'			=>	$row->meta_id,
							'meta_action'		=>	$meta_action,
							'meta_disease_id'	=>	$row->meta_disease_id,
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
		private function _get_current_data( $disease_id ) {

			$this->db->select( 'disease_name, disease_description, disease_edited_date' );
			$this->db->where( 'disease_id', $disease_id );
			$query = $this->db->get( 'tbl_diseases' );
			if ( $query ) {

				if ( $query->num_rows() > 0 ) {

					$returnDatas = array();

					while ( $row = $query->unbuffered_row() ) {

						$returnDatas['disease_name'] = $row->disease_name;
						$returnDatas['disease_description'] = $row->disease_description;

					}

					return (object) $returnDatas;

				}

			}

		}


		// inserting the meta datas to the meta table
		private function _save_to_metatable( $args ) {

			if ( null != $args || '' != $args ) {

				if ( is_array( $args ) ) {

					if ( $this->db->insert( 'tbl_diseasemeta', $args ) ) {

						return TRUE;

					}

					return FALSE;

				}

			}

		}

	}
?>	