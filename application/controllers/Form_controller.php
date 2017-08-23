<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library( array('user_security', 'page_actions', 'ext_queries', 'ext_meta') );
		$this->load->library( array('form_validation', 'session', 'encryption') );
		$this->load->helper( array('url', 'html') );
	}

	public function user_sign_in() {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			redirect( '/Administrator/' );

		} else {

			// call login to action
  			$this->form_validation->set_rules('username', 'Username', 'required', array('required' => 'You must provide a %s.'));
	        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));

	        if ( $this->form_validation->run() == FALSE ) {

	        	// reload login form
	        	$this->_get_login_view( 'Retry Sign In' );

	        } else {

	        	// if form validation is successfull
	        	$this->load->library( 'ext_queries' );
	        	$username = $this->input->post( 'username' );
	        	$password = $this->input->post( 'password' );

	        	// encrypt the password
	        	$salt = $salt = '$6$rounds=5000$' . $this->config->item('salt_str') . '$';
	        	$password = crypt( $password, $salt );

	        	$this->load->model( 'Users_model', 'usr_mdl' );
	        	$user_result = $this->usr_mdl->get_user_from_sign_in( $username, $password );
	        	
	        	if ( $user_result != NULL ) {

	        		// set the date meta info
	        		$current_timestamp = date( "Y-m-d H:i:s" );

	        		$ip_address = $this->input->ip_address();
	        		$user_agent = $this->input->user_agent();

	        		$user_id = $user_result['user_id'];
	        		$user_name = $user_result['username'];

	        		$meta_value = '{ "ip_address" : "'. $ip_address .'", "user_agent" : "'. $user_agent .'", "session_datas" : { "session_id" : '. $user_id .', "user_name"	: "'. $user_name .'" }, "date" : "'. $current_timestamp .'" }';

	        		$user_meta = array(
	        			'meta_user_id'	=>	$user_id,
	        			'meta_key_id'	=>	$this->ext_meta->get_meta_key_info( '_last_login' )->key_id,
	        			'meta_value'	=>	$meta_value,
	        		);

	        		if ( $this->db->insert( 'tbl_usermeta', $user_meta ) ) {

	        			$this->user_security->register_session_data( $user_result, 'cnsgnmnt_sess_prefix_' );
		        		$target_url = !empty($this->input->post('target_url')) ? $this->input->post('target_url') : '/administrator/';
		        		redirect( $target_url );

	        		} else {
	        			error_log();
	        		}

	        	} else {

	        		// error
	        		$this->_get_login_view( 'Sign In Failed', 'Invalid username or password' );

	        	}

	        }


		}

	}
	// end of user sign in method

	/** ------------------------------------------------------------------------------------------
	 * |										ROLE GROUP 										 |
	 * -------------------------------------------------------------------------------------------
	 */ 

	// this is the save role action / method
	public function save_role( $roleID = null ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			// the action goes here
			$this->form_validation->set_rules('role_name', 'Role name', 'required', array('required' => 'You must provide a %s.'));

			if ( $this->form_validation->run() == FALSE ) {

				echo 'You must provide a role name';

			} else {

				$this->load->library( 'ext_queries' );

				$json_final_str = array();
				$compiled_str = array();

				$role_name = $this->input->post( 'role_name' );
	        	$role_description = $this->input->post( 'role_description' );
	        	$target_url = $this->input->post( 'target_url' );

	        	$json_final_str[ 'role_name' ] = $role_name;
	        	$json_final_str[ 'description' ] = $role_description;

	        	// page_name
	        	$page_name = $this->input->post('page_name');
	        	if ( isset( $page_name ) ) {

	    			foreach ($page_name as $value) {
	    				
	    				$array_init = array(
	    									"create" => 0,
	    									"edit" => 0,
	    									"delete" => 0,
	    									"read" => 0,
	    									"save" => 0,
	    									"edit_others" => 0,
	    									"delete_others" => 0,
	    									"print" => 0
	    								);
	    				$compiled_str[ $value ] = $array_init;

	    			}

	        	}

	        	// -------------------------------------
	        	// loop all array keys and convert each key value or array

	        	// create
	        	$create = $this->input->post('create');
	        	if ( isset( $create ) ) {

	    			foreach ($create as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// edit
	        	$edit = $this->input->post('edit');
	        	if ( isset( $edit ) ) {

	    			foreach ($edit as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// delete
	        	$delete = $this->input->post('delete');
	        	if ( isset( $delete ) ) {


	    			foreach ($delete as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// save
	        	$save = $this->input->post('save');
	        	if ( isset( $save ) ) {

	    			foreach ($save as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// read
	        	$read = $this->input->post('read');
	        	if ( isset( $read ) ) {

	    			foreach ($read as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// edit_others
	        	$edit_others = $this->input->post('edit_others');
	        	if ( isset( $edit_others ) ) {

	    			foreach ($edit_others as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// delete_others
	        	$delete_others = $this->input->post('delete_others');
	        	if ( isset( $delete_others ) ) {

	    			foreach ($delete_others as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// print
	        	$print = $this->input->post('print');
	        	if ( isset( $print ) ) {

	    			foreach ($print as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// import
	        	$import = $this->input->post('import');
	        	if ( isset( $import ) ) {

	    			foreach ($import as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// export
	        	$export = $this->input->post('export');
	        	if ( isset( $export ) ) {

	    			foreach ($export as $value) {
	    				
	    				$split_str = explode("-", $value);
	    				$compiled_str[ $split_str[1] ][ $split_str[0] ] = 1;

	    			}

	        	}

	        	// set the date meta info
	        	$current_timestamp = date( "Y-m-d H:i:s" );

	        	//Compiled String
	        	$json_final_str[ 'pages' ] = $compiled_str;
	        	$json_final_str[ 'date_created' ] = $current_timestamp;
	        	$json_final_str[ 'created_by' ] = $this->session->cnsgnmnt_sess_prefix_user_id;

	    		$encoded_json_final_str = json_encode( $json_final_str );
	    		$encrypted_encoded_json_final_str = $this->_encrypt_str( $encoded_json_final_str );

	    		/* !!!!!!!!!!!!!!!!
				 * Move this block to it's model afterwards
				 */
	    		// start the transaction
	    		$this->db->trans_start();

	    		// initialize component variables
	    		$last_id = $roleID;
	    		$meta_infos = $this->ext_meta->get_meta_key_info( '_edit_role' );

				$session_role_id_name = 'cnsgnmnt_sess_prefix_role_id_to_edit';

	    		// conditional statement if method is to insert or update
	    		if ( $roleID != '' || $roleID != null ) {
	    			//edit / update
	    			if ( is_numeric( $roleID ) ) {

	    				if ( $this->session->userdata( $session_role_id_name ) != $roleID ) {

	    					$last_id = $this->session->userdata( $session_role_id_name );

	    				}

	    				// initialize the datas needed to insert in the first table of the database
			    		$data_tbl_roles = array(
							'role_name' => $role_name,
							'role_description' => $role_description,
							'role_value' => $encrypted_encoded_json_final_str,
							'role_edited_by' => $this->session->cnsgnmnt_sess_prefix_user_id
						);

	    				$this->db->where('role_id', $last_id);
						$this->db->update('tbl_roles', $data_tbl_roles);

	    			}

				} else {
					// add / insert
					// initialize the datas needed to insert in the first table of the database
		    		$data_tbl_roles = array(
						'role_name' => $role_name,
						'role_description' => $role_description,
						'role_value' => $encrypted_encoded_json_final_str,
						'role_created_by' => $this->session->cnsgnmnt_sess_prefix_user_id
					);

					$this->db->insert('tbl_roles', $data_tbl_roles);
					$last_id = $this->db->insert_id();

					// get meta key infos via keyname
	        		$meta_infos = $this->ext_meta->get_meta_key_info( '_create_role' );

				}

	        	// -----------------------------------------------------------------------
    			// insert role informations into the role meta table for activity tracking
    			$data_tbl_rolemeta = array(
    				'meta_role_id' => $last_id,
    				'meta_key_id' => $meta_infos->key_id,
    				'meta_value' => $encrypted_encoded_json_final_str
    			);
    			$this->db->insert('tbl_rolemeta', $data_tbl_rolemeta);

    			// end the transaction	
    			$this->db->trans_complete();

    			// redirect now to the edit
    			redirect( $target_url . $last_id . '/' );

			}

		} else {

			// load login form
			$this->_get_login_view();

		}	

	} // end of saving the role data

	/** DELETING */

	// deleting the role
	public function delete_role( $roleID ) {

		//_delete_role
		if ( $roleID != '' || $roleID != null ) {

			if ( is_numeric( $roleID ) ) {

				$this->priv_delete_restore_role( $roleID );

			}

		}

	}

	// restoring the role deleted
	public function restore_role( $roleID ) {

		//_delete_role
		if ( $roleID != '' || $roleID != null ) {

			if ( is_numeric( $roleID ) ) {

				$this->priv_delete_restore_role( $roleID, 'restore' );

			}

		}

	}

	// This next line is a private method for deleting or restoring datas
	private function priv_delete_restore_role( $roleID, $action = 'delete' ) {

		$last_id = $roleID;

		// get meta key infos via keyname
		$meta_infos = $this->ext_meta->get_meta_key_info( '_delete_role' );
		$boolAction = FALSE;

		if ( 'restore' == $action ) {

			$meta_infos = $this->ext_meta->get_meta_key_info( '_restore_role' );
			$boolAction = TRUE;

		}

		$data_tbl_roles = array(
			'role_edited_by' => $this->session->cnsgnmnt_sess_prefix_user_id,
			'role_is_active' => $boolAction
		);

		// start the transaction
		$this->db->trans_start();

		$this->db->where('role_id', $last_id);
		$this->db->update('tbl_roles', $data_tbl_roles);

	    // set the date meta info
		$current_timestamp = date( "Y-m-d H:i:s" );

		$json_final_str = array();
		$json_final_str[ 'date_created' ] = $current_timestamp;
		$json_final_str[ 'created_by' ] = $this->session->cnsgnmnt_sess_prefix_user_id;

		$encoded_json_final_str = json_encode( $json_final_str );

		// insert role informations into the role meta table for activity tracking
		$data_tbl_rolemeta = array(
			'meta_role_id' => $last_id,
			'meta_key_id' => $meta_infos->key_id,
			'meta_value' => $encoded_json_final_str
		);
		$this->db->insert('tbl_rolemeta', $data_tbl_rolemeta);

		// end the transaction	
		$this->db->trans_complete();

	    // redirect now
		redirect( base_url( '/administrator/roles/' ) );

	}

	/** ------------------------------------------------------------------------------------------
	 * |										USER GROUP 										 |
	 * -------------------------------------------------------------------------------------------
	 */
	/**
	 * Saving the user profile
	 */
	public function save_user( $userID = null ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			// the action goes here
			$this->form_validation->set_rules( 'user_name', 'User name', 'required', array('required' => 'You must provide a %s.') );
			$this->form_validation->set_rules( 'user_password', 'User password', 'required', array('required' => 'You must provide a %s.') );
			$this->form_validation->set_rules( 'confirm_user_password', 'Confirm Password', 'required', array('required' => 'You must provide a %s.') );
			$this->form_validation->set_rules( 'user_role', 'Role name', 'required', array('required' => 'You must provide a %s.') );

			if ( $this->form_validation->run() == FALSE ) {

				$data['page_title'] = 'Invalid User Registration';
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'User_add_view' );
				$this->load->view( 'footer' );

			} else {

				$g_username = $this->input->post( 'user_name' );
				$g_password = $this->input->post( 'user_password' );
				$g_c_password = $this->input->post( 'confirm_user_password' );
				$g_role = $this->input->post( 'user_role' );

				// check if password and password confirmation is matched
				if ( $g_password != $g_c_password ) {

					$data['page_title'] = 'Invalid User Registration';
					$data['err_msg'] = 'Passwords did not match';
					$this->load->view( 'header', $data);
					$this->load->view( 'sidebar' );
					$this->load->view( 'dashboard/users/User_add_view', $data );
					$this->load->view( 'footer' );

				} else {

					// encrypt now the password
	        		$salt = $salt = '$6$rounds=5000$' . $this->config->item('salt_str') . '$';
	        		$g_password = crypt( $g_password, $salt );

	        		$arguments = array(
	        			'user_name' 		=> $g_username,
	        			'user_password'		=> $g_password,
	        			'user_roles'		=> $this->encryption->encrypt( '{ "roles" : { "0" : "'. $g_role .'" } }' ),
	        			'user_created_by'	=> $this->session->cnsgnmnt_sess_prefix_user_id
	        		);
	        		if ( '' != $userID || null != $userID ) {

	        			if ( $this->input->post( 'current_password' ) ) {

	        				$g_curr_password = $this->input->post( 'current_password' );
	        				echo $g_curr_password = crypt( $g_curr_password, $salt ) . '<br/>';
	        				echo $current_pass_meta = $this->ext_meta->get_user_meta_data( $userID, 'user_password' ) . '<br/>';
	        				if ( $g_curr_password != $current_pass_meta ) {

								echo '<script>alert("Passwords did not matched!");</script>';
								redirect( 'administrator/users/edit/' . $userID . '/' );
	        					return;

	        				}

	        			}

	        			$arguments = array(
	        				'user_id'			=> $userID,
		        			'user_name' 		=> $g_username,
		        			'user_password'		=> $g_password,
		        			'user_roles'		=> $this->encryption->encrypt( '{ "roles" : { "0" : "'. $g_role .'" } }' ),
		        			'user_edited_by'	=> $this->session->cnsgnmnt_sess_prefix_user_id
		        		);

	        		}

	        		$this->load->model( 'Users_model', 'usr_mdl' );
	        		$result = $this->usr_mdl->save_user_data( $arguments );
	        		if ( $result != FALSE ) {

	        			$target_url = $this->input->post( 'target_url' );
	        			if ( $result === TRUE ) {
	        				echo $result;
	        				redirect( $target_url );

	        			} else {
	        				echo $result;
	        				redirect( $target_url . $result );

	        			}

	        		} else {
	        			
	        			// get the error page
	        			$this->_get_error_page( 'Error' , "Username already exists!" );

	        		}

				}

			}	

		} else {

			$this->_get_login_view( 'User Sign In' );

		}

	}

	/** Deleting the user */
	public function delete_user( $userID ) {

		if ( $userID != '' || $userID != null ) {

			if ( is_numeric( $userID ) ) {

				$this->priv_delete_restor_user( $userID );

			}

		}

	}

	/** Restoring the user deleted */
	public function restore_user( $userID ) {

		if ( $userID != '' || $userID != null ) {

			if ( is_numeric( $userID ) ) {

				$this->priv_delete_restor_user( $userID, 'restore' );

			}

		}

	}

	// this next line is a private method
	// delete / restor function
	private function priv_delete_restor_user( $userID, $action = 'delete' ) {

		$last_id = $userID;
		// get meta key infos via keyname
		$meta_infos = $this->ext_meta->get_meta_key_info( '_delete_user' );
		// the boolean action value. delete = FALSE/restore = TRUE
		$boolAction = FALSE;

		// action checking if delete or restore the data
		if ( 'restore' == $action ) {

			$meta_infos = $this->ext_meta->get_meta_key_info( '_restore_user' );
			$boolAction = TRUE;
			
		}

		$data_tbl_users = array(
			'user_edited_by' => $this->session->cnsgnmnt_sess_prefix_user_id,
			'user_is_active' => $boolAction
		);

		// start the transaction
		$this->db->trans_start();

		$this->db->where('user_id', $last_id);
		$this->db->update('tbl_users', $data_tbl_users);

	    // set the date meta info
		$current_timestamp = date( "Y-m-d H:i:s" );

		$json_final_str = array();
		$json_final_str[ 'date_created' ] = $current_timestamp;
		$json_final_str[ 'created_by' ] = $this->session->cnsgnmnt_sess_prefix_user_id;

		$encoded_json_final_str = json_encode( $json_final_str );

		// insert role informations into the role meta table for activity tracking
		$data_tbl_usermeta = array(
			'meta_user_id' => $last_id,
			'meta_key_id' => $meta_infos->key_id,
			'meta_value' => $encoded_json_final_str
		);
		$this->db->insert('tbl_usermeta', $data_tbl_usermeta);

		// end the transaction	
		$this->db->trans_complete();

	    // redirect now
		redirect( base_url( '/administrator/users/' ) );

	}


	/** ------------------------------------------------------------------------------------------
	 * |									PRIVATE METHODS 									 |
	 * -------------------------------------------------------------------------------------------
	 */

	// Here goes the private methods usable only in this controller
	// ------------------------------------------------------------------------------------------

	// encrypting a string
	private function _encrypt_str( $str ) {

		return $this->encryption->encrypt( $str );

	}

	// get error page
	private function _get_error_page( $page_title = 'Error', $error_message = '' ) {

		$data['page_title'] = $page_title;
		$data['err_msg'] = $error_message;
		$this->load->view( 'header', $data );
		$this->load->view( 'dashboard/Error_view' );
		$this->load->view( 'footer' );

	}

	// getting and displaying the login form
	private function _get_login_view( $page_title = 'User Sign In', $error_message = '' ) {

		$data['page_title'] = $page_title;
		$data['err_msg'] = $error_message;
		$this->load->view( 'header', $data );
		$this->load->view( 'Login_view' );
		$this->load->view( 'footer' );

	}
	
}

?>