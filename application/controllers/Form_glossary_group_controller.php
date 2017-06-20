<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Form_glossary_group_controller extends CI_Controller {

		public function __construct() {

			parent::__construct();
			$this->load->library( array('user_security', 'page_actions', 'ext_queries', 'ext_meta') );
			$this->load->library( array('form_validation', 'session', 'encryption') );
			$this->load->helper( array('url', 'html') );

		}

		public function save_glossary( $item_id = null ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {



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
					$this->load->model( 'glossary/Glossary_brand_model', 'glossary_brnd_mdl' );
					$array_save_datas = array(
						'brand_name'		=>	$brand_name,
						'brand_description'	=>	$brand_remarks
					);
					if ( null != $brand_id ) {

						$array_save_datas['brand_id'] = $brand_id;

					}
					$result = $this->glossary_brnd_mdl->save_brand( $array_save_datas );
					if ( $result != FALSE ) {

						$target_url = $this->input->post( 'target_url' );
						redirect( $target_url . $result );

					}

				}

			} else {

				$this->_get_login_view();

			}

		}

		public function save_item_disease( $disease_id = null ) {

			if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {



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