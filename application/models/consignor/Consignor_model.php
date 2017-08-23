<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Consignor_model extends CI_Model {

	/**
	 * Fetching all consingors
	 */
	public function get_all_consignors($args = null, $isArray = FALSE, $isActive = TRUE) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$select_fields = 'consignor_id, consignor_name, consignor_address, consignor_contact_person, consignor_contact_person_position, consignor_contact_info, consignor_is_accredited, consignor_accreditation_details, consignor_created_date, consignor_edited_date, consignor_created_by, consignor_edited_by';
			$this->db->select( $select_fields );
			$this->db->where( array( 'consignor_is_active'	=>	$isActive ) );
			$query = $this->db->get( 'tbl_consignor' );


			if ( !empty( $args ) ) {

				if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && !array_key_exists( 'key', $args ) ) {

					$this->db->select( $select_fields );
					$this->db->where( 'consignor_is_active', $isActive );
					$query = $this->db->get( 'tbl_consignor', $args['limit'], $args['offset'] );

				} else if ( array_key_exists( 'limit', $args ) && array_key_exists( 'offset', $args ) && array_key_exists( 'key', $args ) ) {

					$this->db->select( $select_fields );
					$this->db->where( 'consignor_is_active', $isActive );
					$this->db->group_start();
					$this->db->or_like(
						array(
							'consignor_name'			=>	$args['key'],
							'consignor_address'			=>	$args['key'],
							'consignor_contact_person'	=>	$args['key'],
							'consignor_contact_info'	=>	$args['key']
						)
					);
					$this->db->group_end();
					$query = $this->db->get( 'tbl_consignor', $args['limit'], $args['offset'] );

				} else if ( !array_key_exists( 'limit', $args ) && !array_key_exists( 'offset', $args ) && array_key_exists( 'key', $args ) ) {

					$this->db->select( $select_fields );
					$this->db->where( 'consignor_is_active', $isActive );
					$this->db->group_start();
					$this->db->or_like(
						array(
							'consignor_name'			=>	$args['key'],
							'consignor_address'			=>	$args['key'],
							'consignor_contact_person'	=>	$args['key'],
							'consignor_contact_info'	=>	$args['key']
						)
					);
					$this->db->group_end();
					$query = $this->db->get( 'tbl_consignor' );

				}

			}


			if ($query) {

				if ( $query->num_rows() > 0 ) {
					$returnValue = array();
					foreach ( $query->result() as $row ) {
						$returnValue[] = $row;
					}

					if ( $isArray === FALSE ) {
						$returnValue = (object) $returnValue;
					}

					return $returnValue;

				}

				return false;

			}
			return false;

		}

	}

	public function get_accreditation_documents() {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$this->db->select( 'accreditation_id, accreditation_document, accreditation_description' );
			$this->db->where( 'accreditation_is_active', TRUE );
			$query = $this->db->get( 'tbl_consignor_accreditations' );
			if ( $query ) {

				if ( $query->num_rows() > 0 ) {
					$returnValue = array();
					foreach ( $query->result() as $row ) {
						$arr_values = (object) array(
							'accreditation_id'		=>	$row->accreditation_id,
							'accreditation_document'=>	$row->accreditation_document,
						);
						array_push(	$returnValue,	$arr_values	);
					}
					return (object) $returnValue;
				}
				return false;
			}

		}

	}

	/**
	 * Consignor Add
	 */
	public function save_consignor($args, $consignor_id = null) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$this->db->trans_start();
			if ( is_numeric($consignor_id) && !is_null($consignor_id) && 0 != $consignor_id ) {
				$query = $this->db->update( 'tbl_consignor', $args, array( 'consignor_id'	=>	$consignor_id, 'consignor_is_active'	=>	TRUE ) );
			} else {
				$query = $this->db->insert('tbl_consignor', $args);
			}
			if ( $query ) {

				$last_id = $this->db->insert_id();
				$this->db->reset_query();

				$meta_key_id = $this->ext_meta->get_meta_key_info( '_create_consignor' )->key_id;

				$json_values = array();
				if ( is_numeric($consignor_id) || !is_null($consignor_id) || 0 != $consignor_id ) {
					$last_id = $consignor_id;
					$current_value = $this->get_current_values($last_id);

					$meta_key_id = $this->ext_meta->get_meta_key_info( '_edit_consignor' )->key_id;

					if ( $current_value != false ) {
						$json_values['old'] = array(
												'consignor_name'					=>	$current_value->consignor_name,
												'consignor_address'					=>	$current_value->consignor_address,
												'consignor_contact_person'			=>	$current_value->consignor_contact_person,
												'consignor_contact_person_position'	=>	$current_value->consignor_contact_person_position,
												'consignor_contact_info'			=>	$current_value->consignor_contact_info,
												'consignor_is_accredited'			=>	$current_value->consignor_is_accredited,
												'consignor_accreditation_details'	=>	$current_value->consignor_accreditation_details,
												'consignor_created_by'				=>	$current_value->consignor_created_by,
												'consignor_edited_by'				=>	$current_value->consignor_edited_by
											);
					}

				}

				$json_values['new']	=	array(
									'consignor_name'					=>	$args['consignor_name'],
									'consignor_address'					=>	$args['consignor_address'],
									'consignor_contact_person'			=>	$args['consignor_contact_person'],
									'consignor_contact_person_position'	=>	$args['consignor_contact_person_position'],
									'consignor_contact_info'			=>	$args['consignor_contact_info'],
									'consignor_is_accredited'			=>	$args['consignor_is_accredited'],
									'consignor_accreditation_details'	=>	$args['consignor_accreditation_details'],
									'consignor_created_by'				=>	$args['consignor_created_by'],
									'consignor_edited_by'				=>	$args['consignor_edited_by']
								);

				$json_values = json_encode( $json_values );
				$json_values = $this->encryption->encrypt($json_values);
				$meta_values = array(
					'meta_key_id'		=>	$meta_key_id,
					'meta_consignor_id'	=>	$last_id,
					'meta_value'		=>	$json_values
				);
				if ( $this->db->insert('tbl_consignormeta', $meta_values) ) {
					$this->db->trans_complete();
					return $last_id;
				}

			}

			return false;

		}

	}

	/** Get current values */
	public function get_current_values($consignor_id) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$this->db->select( 'consignor_name, consignor_address, consignor_contact_person, consignor_contact_person_position, consignor_contact_info, consignor_is_accredited, consignor_accreditation_details, consignor_created_by, consignor_edited_by' );
			$this->db->where( array( 'consignor_id'			=>	$consignor_id ) );
			$this->db->where( array( 'consignor_is_active'	=>	TRUE ) );
			$query = $this->db->get( 'tbl_consignor' );
			if ($query) {

				if ( $query->num_rows() > 0 ) {
					$returnArray = array();
					while ( $row = $query->unbuffered_row() ) {
						$arr_values = (object) array(
							'consignor_name'					=>	$row->consignor_name,
							'consignor_address'					=>	$row->consignor_address,
							'consignor_contact_person'			=>	$row->consignor_contact_person,		
							'consignor_contact_person_position'	=>	$row->consignor_contact_person_position,
							'consignor_contact_info'			=>	$row->consignor_contact_info,		
							'consignor_is_accredited'			=>	$row->consignor_is_accredited,		
							'consignor_accreditation_details'	=>	$row->consignor_accreditation_details,
							'consignor_created_by'				=>	$row->consignor_created_by,	
							'consignor_edited_by'				=>	$row->consignor_edited_by	
						);
					}
					return $arr_values;

				}

			}
			return false;
			
		}

	}

	/**
	 * Removing and
	 * Restoring Consignor
	 */
	public function remove_restore_consignor($consignor_id, $action = 'delete') {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			if ( is_numeric($consignor_id) && !is_null($consignor_id) && !empty($consignor_id) && 0 != $consignor_id ) {

				$current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;
				$current_timestamp = date( "Y-m-d H:i:s" );

				$datas = array(
							'consignor_is_active'	=>	FALSE,
							'consignor_edited_by'	=>	$current_user_session_id
						);
				$where = array('consignor_id'	=>	$consignor_id, 'consignor_is_active'	=>	TRUE);
				$meta_key_id = $this->ext_meta->get_meta_key_info( '_delete_consignor' )->key_id;

				if ( $action === 'restore' || $action === 'r' ) {

					$datas = array(
								'consignor_is_active'	=>	TRUE,
								'consignor_edited_by'	=>	$current_user_session_id
							);
					$where = array('consignor_id'	=>	$consignor_id, 'consignor_is_active'	=>	FALSE);
					$meta_key_id = $this->ext_meta->get_meta_key_info( '_restore_consignor' )->key_id;

				}

				$meta_value = '{"date_created":"'. $current_timestamp .'","created_by":"'. $current_user_session_id .'"}';

				$this->db->trans_start();
				if ( $this->db->update( 'tbl_consignor', $datas, $where ) ) {

					$meta_data = array(
						'meta_key_id'		=>	$meta_key_id,
						'meta_consignor_id'	=>	$consignor_id,
						'meta_value'		=>	$meta_value
					);

					if ( $this->db->insert( 'tbl_consignormeta', $meta_data ) ) {
						$this->db->trans_complete();
						return true;
					}

				}

			}

			return false;

		}

	}

	/** ----------------------------------------------------------------------------------------- */

	/**
	 * ------------------------------------------------------------------------------------------
	 * The list of transaction logs
	 * @param array $parameter_query - the array parameter for the query
	 * @return array/boolean - if it has data to fetch then the return value shoul be an array of datas with it's assigned array key. Otherwise it should return false.
	 * ------------------------------------------------------------------------------------------
	 */
	public function get_activity_logs( $parameter_query = null ) {

		$query = $this->db->get( 'tbl_consignormeta' );

		if ( null != $parameter_query || '' != $parameter_query ) {

			$this->db->order_by( "meta_created_date", "desc" );
			$query = $this->db->get( 'tbl_consignormeta' );

			if ( is_array( $parameter_query ) ) {

				if ( array_key_exists( 'limit', $parameter_query ) && array_key_exists( 'offset', $parameter_query ) ) {

					$query = $this->db->get( 'tbl_consignormeta', $parameter_query['limit'], $parameter_query['offset'] );

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
					if ( $meta_key == '_delete_consignor' || $meta_key == '_restore_consignor' ) {

						$meta_value = $row->meta_value;

					}

					$meta_action = 'Created A Consignor';
					switch ( $meta_key ) {

						case '_edit_consignor':
						$meta_action = 'Updated A Consignor';
						break;

						case '_delete_consignor':
						$meta_action = 'Deleted A Consignor';
						break;

						case '_restore_consignor':
						$meta_action = 'Restored A Consignor';
						break;	

						default:
						$meta_action = 'Created A Consignor';
						break;

					}

					$objectDatas = (object) array(
						'meta_id'			=>	$row->meta_id,
						'meta_action'		=>	$meta_action,
						'meta_consignor_id'	=>	$row->meta_consignor_id,
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

}
?>