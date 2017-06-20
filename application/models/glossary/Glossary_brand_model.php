<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Glossary_brand_model extends CI_Model {

		public function save_brand( $array_values ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( is_array( $array_values ) ) {

					if ( array_key_exists( 'brand_name', $array_values ) || array_key_exists( 'brand_description', $array_values ) ) {

						// set the date meta info
	        			$current_timestamp = date( "Y-m-d H:i:s" );

						if ( array_key_exists( 'brand_id', $array_values ) ) {

							$this->db->trans_start();
							// update action

							$current_datas = $this->_get_current_data( $array_values['brand_id'] );

							$data = array(
							    'brand_name'		=>	$array_values['brand_name'],
							    'brand_description'	=>	$array_values['brand_description'],
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