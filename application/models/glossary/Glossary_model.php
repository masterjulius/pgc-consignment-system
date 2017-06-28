<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Glossary_model extends CI_Model {

		private $current_timestamp = date( "Y-m-d H:i:s" );

		public function save_glossary( $args ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				$array_datas = array(
					'item_type'					=>	$args['item_type'],
					'item_name'					=>	$args['item_name'],
					'item_description'			=>	$args['item_description'],
					'item_disinfects_disease_id'=>	$args['item_disinfects_disease_id'],
					'item_created_by'			=>	$args['item_created_by'],
					'item_edited_by'			=>	$args['item_created_by']
				);

				$json_data = '{ "meta_datas" : { "item_type" : "'. $args['item_type'] .'", "item_name" : "'. $args['item_name'] .'", "item_disinfects" : "'. $args['item_disinfects_disease_id'] .'", "item_description" : "'. $args['item_description'] .'", "item_created_by" : "'. $args['item_created_by'] .'", }, "date_operated" : "'. $this->current_timestamp .'" }';

				$meta_key_id = $this->db->get_meta_key_info( '_create_glossary_item' )->key_id;

				$this->db->trans_start();

				$query = $this->db->insert( 'tbl_items', $array_datas );

				if ( array_key_exists( 'glossary_id' , $args ) ) {

					if ( $args['glossary_id'] != null ) {

						$curr_datas = $this->_get_current_glossary_datas( $glossary_id );

						$json_data = '{ "old" : { "meta_datas" : { "item_type" : "'.$curr_datas->item_type.'", "item_name" : "'.$curr_datas->item_name.'", "item_disinfects" : "'.$curr_datas->item_disinfects_disease_id.'", "item_description" : "'.$curr_datas->item_description.'", "operated_by" : "'.$curr_datas->item_edited_by.'" }, "date_operated" : "'.$curr_datas->item_edited_date.'" }, "new" : { "meta_datas" : { "item_type" : "'.$args['item_type'].'", "item_name" : "'.$args['item_name'].'", "item_disinfects" : "'.$args['item_disinfects_disease_id'].'", "item_description" : "'.$args['item_description'].'", "operated_by" : "'.$args['item_created_by'].'" },
								"date_operated" : "'.$this->current_timestamp.'" } }';

						$meta_key_id = $this->db->get_meta_key_info( '_edit_glossary_item' )->key_id;

						$array_datas['item_id'] = $args['glossary_id'];
						$query = $this->db->update( 'tbl_items', $array_datas );
						
					}
					
				}

				// action
				if ( $query ) {

					$last_id = $this->db->insert_id;

					$meta_datas = array(
						'meta_item_id'	=>	$last_id,
						'meta_key_id'	=>	$meta_key_id,
						'meta_value'	=>	$json_data,
					);

					if ( $this->db->insert( 'tbl_items', $json_data ) ) {

						$this->db->trans_complete();
						return $last_id;

					}

				}

			}	
			
		}

		// get the datas current datas
		private function _get_current_glossary_datas( $glossary_id ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				if ( !is_null( $glossary_id ) || !empty( $glossary_id ) ) {

					$this->db->select( 'item_type, item_name, item_disinfects_disease_id, item_description, item_edited_date, item_edited_by' );
					$this->db->where( 'item_id', $glossary_id );
					$this->db->where( 'item_is_active', TRUE );
					$query = $this->db->get( 'tbl_items' );
					if ( $query ) {

						if ( $query->num_rows() > 0 ) {
							$returnData = array();
							while ( $row = $query->unbuffered_row() ) {

								$object_datas = (object) array(
									'item_type'						=>	$row->item_type,
									'item_name'						=>	$row->item_name,
									'item_disinfects_disease_id'	=>	$row->item_disinfects_disease_id,
									'item_description'				=>	$row->item_description,
									'item_edited_date'				=>	$row->item_edited_date,
									'item_edited_by'				=>	$row->item_edited_by
								);
								array_push( $returnData , $object_datas );

							}
							return $returnData;

						}

						return false;

					}

					return false;

				}

			}

		}

	}
?>	