<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

	// return a specific metadata for a role
	public function get_role_informations( $role_id = null, $isArray = FALSE, $isActive = TRUE, $searchParam = null, $page_query = null ) {

		$returnData = array();
		$query = $this->db->get_where( 'tbl_roles', array( 'role_is_active' => $isActive ) );
		if ( $role_id != '' || $role_id != null ) {

			$query = $this->db->get_where( 'tbl_roles', array( 'role_id' => $role_id, 'role_is_active' => $isActive ) );

		}

		if ( null != $searchParam ) {

			if ( is_array( $searchParam ) ) {

				if ( array_key_exists( 'key', $searchParam ) && array_key_exists( 'limit', $searchParam ) && array_key_exists( 'offset', $searchParam ) ) {

					$this->db->select( array( 'role_id', 'role_name', 'role_description', 'role_value', 'role_created_date', 'role_created_by', 'role_edited_date', 'role_edited_by' ) );
					$this->db->like( 'role_name', $searchParam['key'] );
					$this->db->or_like( 'role_description', $searchParam['key'] );
					$this->db->where('role_is_active', $isActive );

				    // Execute the query.
					$query = $this->db->get( 'tbl_roles', $searchParam['limit'], $searchParam['offset'] );

				}	

			}

		}

		// pagination
		if ( null != $page_query || '' != $page_query ) {

			if ( is_array( $page_query ) ) {

				if ( array_key_exists( 'limit', $page_query ) && array_key_exists( 'offset', $page_query ) ) {

					$this->db->select( array( 'role_id', 'role_name', 'role_description', 'role_value', 'role_created_date', 'role_created_by', 'role_edited_date', 'role_edited_by' ) );
					$this->db->where('role_is_active', $isActive );

					$query = $this->db->get( 'tbl_roles', $page_query['limit'], $page_query['offset'] );

				}

			}

		}

		foreach ( $query->result() as $row ) {
			$array_datas = (object) array(
				'role_id' => $row->role_id,
				'role_name' => $row->role_name,
				'role_description' => $row->role_description,
				'role_value_encr' => $row->role_value,
				'role_value_decr' => $this->_str_decrypt( $row->role_value ),
				'role_value_decoded' => json_decode( $this->_str_decrypt( $row->role_value ) ),
				'role_capability_count' => $this->_count_overall_capabilities( $row->role_value ),
				'role_created_date' => $row->role_created_date,
				'role_created_by' => $row->role_created_by
			);
			if ( $isArray === TRUE ) {
				$array_datas = (array) $array_datas;
			}
			array_push( $returnData, $array_datas );

		}
		if ( $isArray === FALSE ) {
			$returnData = (object) $returnData;
		}
		return $returnData;

	}

	/**
	 * Logs report
	 * @param arary $page_query = an array of keys with it's values for generating the query
	 * @return array/object $returnData = an array or object of fetched datas
	 */
	public function get_roles_log( $page_query = null ) {

		$query = $this->db->get( 'tbl_rolemeta' );

		if ( null != $page_query || '' != $page_query ) {
			if ( array_key_exists( 'limit', $page_query ) && array_key_exists( 'offset', $page_query ) ) {
				$this->db->order_by( "meta_date_created", "desc" );
				$query = $this->db->get('tbl_rolemeta',  $page_query['limit'], $page_query['offset'] );
			}
		}

		if ( $query ) {

			if ( $query->num_rows() > 0 ) {

				$returnData = array();
				foreach ( $query->result() as $row ) {

					$meta_value = $this->encryption->decrypt( $row->meta_value );
					$meta_key_id = $row->meta_key_id;
					$meta_key = $this->ext_meta->get_meta_key_info( array('key_id' => $meta_key_id ) )->key_name;
					if ( $meta_key == '_delete_role' || $meta_key == '_restore_role' ) {

						$meta_value = $row->meta_value;

					}

					$meta_action = 'Created A Role';
					switch ( $meta_key ) {

						case '_edit_role':
							$meta_action = 'Updated A Role';
							break;

						case '_delete_role':
							$meta_action = 'Deleted A Role';
							break;
							
						case '_restore_role':
							$meta_action = 'Restored A Role';
							break;		
						
						default:
							$meta_action = 'Created A Role';
							break;

					}
					
					$arrValues = (object) array(
						'meta_id'			=>	$row->meta_id,
						'meta_action'		=>	$meta_action,
						'meta_role_id'		=>	$row->meta_role_id,
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


	// ----------------------- PRIVATE METHODS -----------------------
	// ---------------------------------------------------------------

	// counting the total capability for a role
	private function _count_overall_capabilities( $mixed_str ) {

		if ( is_string( $mixed_str ) ) {

			$cap_count = 0;
			$mixed_str = $this->_str_decrypt( $mixed_str );
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

	// decrypting
	private function _str_decrypt( $str ) {

		return $this->encryption->decrypt( $str );

	}

}

?>