<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Glossary_model extends CI_Model {

		public function get_all_glossary( $args = null, $isArray = FALSE, $isActive = TRUE ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				$select_fields = 'item_id, item_type, item_code, item_name, item_disinfects_disease_id, item_description, item_date_created, item_created_by, item_edited_date, item_edited_by';
				$this->db->select( $select_fields );
				$this->db->where( 'item_is_active', $isActive );
				$query = $this->db->get( 'tbl_items' );

				if ( !empty( $args ) ) {

					if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && !array_key_exists( 'key', $args ) ) {

						$this->db->select( $select_fields );
						$this->db->where( 'item_is_active', $isActive );
						$query = $this->db->get( 'tbl_items', $args['limit'], $args['offset'] );

					} else if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && array_key_exists( 'key', $args ) ) {

						$this->db->select( $select_fields );
						$this->db->like( 'item_name', $args['key'] );
						$this->db->or_like( 'item_description', $args['key'] );
						$this->db->where( 'item_is_active', $isActive );
						$query = $this->db->get( 'tbl_items', $args['limit'], $args['offset'] );

					}

				}
					
				// run the query
				if ( $query ) {

					if ( $query->num_rows() > 0 ) {
						$returnDatas = array();
						foreach ( $query->result() as $row ) {
							
							$objectDatas = (object) array(
								'item_id'					=>	$row->item_id,
								'item_type'					=>	$row->item_type,
								'item_code'					=>	$row->item_code,
								'item_name'					=>	$row->item_name,
								'item_disinfects_disease_id'=>	$row->item_disinfects_disease_id,
								'item_description'			=>	$row->item_description,
								'item_date_created'			=>	$row->item_date_created,
								'item_created_by'			=>	$row->item_created_by,
								'item_edited_date'			=>	$row->item_edited_date,
								'item_edited_by'			=>	$row->item_edited_by
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

		public function save_glossary( $args ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( array_key_exists( 'item_id' , $args ) ) {

					if ( $args['item_id'] != null ) {

						$array_datas = array(
							'item_type'					=>	$args['item_type'],
							'item_name'					=>	$args['item_name'],
							'item_description'			=>	$args['item_description'],
							'item_disinfects_disease_id'=>	$args['item_disinfects_disease_id'],
							'item_edited_by'			=>	$args['item_created_by']
						);

						$curr_datas = $this->_get_current_glossary_datas( $args['item_id'] );

						$json_data = '{ "old" : { "meta_datas" : { "item_type" : "'.$curr_datas->item_type.'", "item_name" : "'.$curr_datas->item_name.'", "item_disinfects" : "'.$curr_datas->item_disinfects_disease_id.'", "item_description" : "'.$curr_datas->item_description.'", "operated_by" : "'.$curr_datas->item_edited_by.'" }, "date_operated" : "'.$curr_datas->item_edited_date.'" }, "new" : { "meta_datas" : { "item_type" : "'.$args['item_type'].'", "item_name" : "'.$args['item_name'].'", "item_disinfects" : "'.$args['item_disinfects_disease_id'].'", "item_description" : "'.$args['item_description'].'", "operated_by" : "'.$args['item_created_by'].'" },
								"date_operated" : "'.$this->current_timestamp.'" } }';

						$meta_key_id = $this->ext_meta->get_meta_key_info( '_edit_glossary_item' )->key_id;
						$array_datas['item_id'] = $args['item_id'];
						$this->db->trans_start();
						$query = $this->db->update( 'tbl_items', $array_datas, array( 'item_id' => $args['item_id'] ) );
						if ( $query ) {
							$this->db->trans_complete();
							return $args['item_id'];
						}
						
					}
					
				} else {

					$array_datas = array(
						'item_type'					=>	$args['item_type'],
						'item_name'					=>	$args['item_name'],
						'item_description'			=>	$args['item_description'],
						'item_disinfects_disease_id'=>	$args['item_disinfects_disease_id'],
						'item_created_by'			=>	$args['item_created_by'],
						'item_edited_by'			=>	$args['item_created_by']
					);

					$json_data = '{ "meta_datas" : { "item_type" : "'. $args['item_type'] .'", "item_name" : "'. $args['item_name'] .'", "item_disinfects" : "'. $args['item_disinfects_disease_id'] .'", "item_description" : "'. $args['item_description'] .'", "item_created_by" : "'. $args['item_created_by'] .'", }, "date_operated" : "'. $this->current_timestamp .'" }';

					$meta_key_id = $this->ext_meta->get_meta_key_info( '_create_glossary_item' )->key_id;
					$query = $this->db->insert( 'tbl_items', $array_datas );

					//action
					if ( $query ) {

						$last_id = $this->db->insert_id();

						$json_data = $this->encryption->encrypt( $json_data );

						$meta_datas = array(
							'meta_item_id'	=>	$last_id,
							'meta_key_id'	=>	$meta_key_id,
							'meta_value'	=>	$json_data,
						);

						if ( $this->db->insert( 'tbl_itemmeta', $meta_datas ) ) {

							$this->db->trans_complete();
							return $last_id;

						}

					}

				}

			}	
			
		}

		// delete glossary / item
		public function remove_restore_glossary( $glossary_id, $action = 'delete' ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( is_numeric( $glossary_id ) ) {

					$meta_key_id = $this->ext_meta->get_meta_key_info( '_delete_glossary_item' )->key_id;

					$meta_value = '{"date_created":"'. $this->current_timestamp .'","created_by":"'. $this->current_user_session_id .'"}';

					$update_value = array(
						'item_edited_by'	=>	$this->current_user_session_id,
						'item_is_active'	=>	FALSE
					);

					if ( $action === 'restore' || $action === 'r' ) {

						// restore
						$update_value = array(
							'item_edited_by'	=>	$this->current_user_session_id,
							'item_is_active'	=>	TRUE
						);
						$meta_key_id = $this->ext_meta->get_meta_key_info( '_restore_glossary_item' )->key_id;

					}

					$this->db->trans_start();

					$this->db->where( 'item_id', $glossary_id );
					$query = $this->db->update( 'tbl_items', $update_value );
					if ( $query ) {

						$meta_data = array(
							'meta_key_id'	=>	$meta_key_id,
							'meta_item_id'	=>	$glossary_id,
							'meta_value'	=>	$meta_value
						);
						if ( $this->db->insert( 'tbl_itemmeta', $meta_data ) ) {

							$this->db->trans_complete();

							return TRUE;

						}

						return FALSE;

					}

					return FALSE;

				}

			}	

		}

		public function get_single_data( $glossary_id ) {

			return $this->_get_current_glossary_datas( $glossary_id );

		}

		// -------------------------------------------------------------------------------

		// get the datas current datas
		private function _get_current_glossary_datas( $glossary_id ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( !is_null( $glossary_id ) || !empty( $glossary_id ) ) {

					$this->db->select( 'item_id, item_type, item_code, item_name, item_disinfects_disease_id, item_description, item_date_created, item_created_by, item_edited_date, item_edited_by' );
					$this->db->where( 'item_id', $glossary_id );
					$this->db->where( 'item_is_active', TRUE );
					$query = $this->db->get( 'tbl_items' );
					if ( $query ) {

						if ( $query->num_rows() > 0 ) {
							$returnData = array();
							while ( $row = $query->unbuffered_row() ) {

								$object_datas = (object) array(
									'item_id'					=>	$row->item_id,
									'item_type'					=>	$row->item_type,
									'item_code'					=>	$row->item_code,
									'item_name'					=>	$row->item_name,
									'item_disinfects_disease_id'=>	$row->item_disinfects_disease_id,
									'item_description'			=>	$row->item_description,
									'item_date_created'			=>	$row->item_date_created,
									'item_created_by'			=>	$row->item_created_by,
									'item_edited_date'			=>	$row->item_edited_date,
									'item_edited_by'			=>	$row->item_edited_by
								);
								$returnData = $object_datas;

							}
							return (object) $returnData;

						}

						return false;

					}

					return false;

				}

			}

		}

	}
?>	