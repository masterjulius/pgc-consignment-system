<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Form_glossary_group_controller extends CI_Controller {

		private $current_user_session_id;

		public function __construct() {

			parent::__construct();
			$this->load->library( array('user_security', 'page_actions', 'ext_queries', 'ext_meta') );
			$this->load->library( array('form_validation', 'session', 'encryption') );
			$this->load->helper( array('url', 'html') );
			$this->current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;

		}

		public function save_glossary( $item_id = null ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				// the action goes here
				$this->form_validation->set_rules( 'supply_type', 'Supply Type', 'required', array('required' => 'You must provide a %s.') );
				$this->form_validation->set_rules( 'supply_name', 'Supply Name', 'required', array('required' => 'You must provide a %s.') );
				$this->form_validation->set_rules( 'brand', 'Brand', 'required', array('required' => 'You must provide a %s.') );
				$this->form_validation->set_rules( 'disease', 'Disease', 'required', array('required' => 'You must provide a %s.') );
				$this->form_validation->set_rules( 'description', 'Description', 'required', array('required' => 'You must provide a %s.') );

				if ( $this->form_validation->run() == FALSE ) {

					$this->_get_error_page( 'Validate Form', 'Please fill up all the required fields' );

				} else {

					// get form inputs
					$supply_type = $this->input->post( 'supply_type' );
					$supply_name = $this->input->post( 'supply_name' );
					$brand = $this->input->post( 'brand' );
					$disease = $this->input->post( 'disease' );
					$description = $this->input->post( 'description' );

					$meta_datas = array(
						'item_type'						=>	$supply_type,
						'item_name'						=>	$supply_name,
						'item_description'				=>	$description,
						'item_disinfects_disease_id'	=>	$disease,	
						'item_created_by'				=>	$this->current_user_session_id
					);

					if ( !is_null( $this->input->post( 'supply_id' ) ) ) {

						$meta_datas['item_id'] = $this->input->post( 'supply_id' );

					}

				}

			}

		}

		public function save_item_brand( $brand_id = null ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				// the action goes here
				$this->form_validation->set_rules( 'brand_name', 'Brand Name', 'required', array('required' => 'You must provide a %s.') );
				$this->form_validation->set_rules( 'remarks', 'Remarks', 'required', array('required' => 'You must provide a %s.') );

				if ( $this->form_validation->run() == FALSE ) {

					$this->_get_error_form( 'Validate Form', 'Please fill up all the required fields' );

				} else {

					// get form inputs
					$brand_name = $this->input->post( 'brand_name' );
					$brand_remarks = $this->input->post( 'remarks' );

					// load the glossary model
					$this->load->model( 'brand/Brand_model', 'brnd_mdl' );
					$array_save_datas = array(
						'brand_name'		=>	$brand_name,
						'brand_description'	=>	$brand_remarks
					);
					if ( null != $brand_id ) {

						$array_save_datas['brand_id'] = $brand_id;

					}
					$result = $this->brnd_mdl->save_brand( $array_save_datas );
					if ( $result != FALSE ) {

						$target_url = $this->input->post( 'target_url' );
						redirect( $target_url . $result );

					}

				}

			} else {

				$this->_get_login_view();

			}

		}

		public function save_disease( $disease_id = null ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

				// the action goes here
				$this->form_validation->set_rules( 'disease_name', 'Disease Name', 'required', array('required' => 'You must provide a %s.') );
				$this->form_validation->set_rules( 'description', 'Description', 'required', array('required' => 'You must provide a %s.') );

				if ( $this->form_validation->run() == FALSE ) {

					$this->_get_error_form( 'Validate Form', 'Please fill up all the required fields' );

				} else {

					// get form inputs
					$disease_name = $this->input->post( 'disease_name' );
					$description = $this->input->post( 'description' );

					// load the glossary model
					$this->load->model( 'disease/Disease_model', 'dsse_mdl' );
					$array_save_datas = array(
						'disease_name'	=>	$disease_name,
						'disease_description'	=>	$description
					);
					if ( null != $disease_id ) {

						$array_save_datas['disease_id'] = $disease_id;

					}
					$result = $this->dsse_mdl->save_disease( $array_save_datas );
					if ( $result != FALSE ) {

						$target_url = $this->input->post( 'target_url' );
						redirect( $target_url . $result );

					}

				}

			} else {

				$this->_get_login_view();

			}

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

		private function _get_error_form( $page_title = 'Add Branch', $err_msg = '' ) {

			$data['page_title'] = $page_title;
			$data['err_msg'] = $err_msg;
			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'sidebar' );
			$this->load->view( 'footer' );

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