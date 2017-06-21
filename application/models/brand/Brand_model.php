<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Brand_model extends CI_Model {

		public function get_all_brand( $args = null, $isArray = FALSE ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( null != $args ) {

					if ( is_array( $args ) ) {

						$this->db->select('brand_id, brand_name, brand_description, brand_created_date, brand_created_by');
						$query = $this->db->get( 'tbl_item_brand' );

						if ( !empty( $args ) ) {

							if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && !array_key_exists( 'key', $args ) ) {

								$this->db->select('brand_id, brand_name, brand_description, brand_created_date, brand_created_by');
								$query = $this->db->get( 'tbl_item_brand', $args['limit'], $args['offset'] );

							} else if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && array_key_exists( 'key', $args ) ) {

								$this->db->select('brand_id, brand_name, brand_description, brand_created_date, brand_created_by');
								$this->db->like( 'brand_name', $args['key'] );
								$this->db->like( 'brand_description', $args['key'] );
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
									}
								}';

								$meta_data = array(
									'meta_key_id'		=>	$this->ext_meta->get_meta_key_info( '_create_brand' )->key_id,
									'meta_brand_id'		=>	$array_values['brand_id'],
									'meta_value'		=>	$this->encryption->encrypt( $meta_value )	
								);

								if ( $this->_save_to_metatable( $meta_data ) ) {

									return $array_values['brand_id'];

								}

							}

							$this->db->trans_complete();

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
									"date_operated" "' . $current_timestamp . '":
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