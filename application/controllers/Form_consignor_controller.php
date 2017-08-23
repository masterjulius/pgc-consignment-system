<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Form_consignor_controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library( array('user_security', 'page_actions', 'ext_queries', 'ext_meta') );
		$this->load->library( array('form_validation', 'session', 'encryption') );
		$this->load->helper( array('url', 'html') );
		$this->current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;
		$this->current_timestamp = date( "Y-m-d H:i:s" );

		$this->load->model( 'consignor/Consignor_model', 'cnsgnr_mdl' );
	}

	public function save_consignor( $consignor_id = null ) {
		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {
			// the action goes here
			$this->form_validation->set_rules( 'consignor_name', 'Consignor Name', 'required', array('required' => 'You must provide a %s.') );
			$this->form_validation->set_rules( 'consignor_address', 'Consignor Address', 'required', array('required' => 'You must provide a %s.') );
			$this->form_validation->set_rules( 'consignor_contact_person', 'Contact Person', 'required', array('required' => 'You must provide a %s.') );
			$this->form_validation->set_rules( 'consignor_contact_person_position', 'Contact Person Position', 'required', array('required' => 'You must provide a %s.') );
			$this->form_validation->set_rules( 'consignor_contact_information', 'Description', 'required', array('required' => 'You must provide a %s.') );

			if ( $this->form_validation->run() == FALSE ) {
				
				$data['page_title'] = "&mdash; Failed to add consignor";
				$data['consignor_documents'] = $this->cnsgnr_mdl->get_accreditation_documents();
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/consignor/Consignor_add_view' );
				$this->load->view( 'footer' );

			} else {

				// load consignor model

				// get values
				$consignor_name = $this->input->post('consignor_name');
				$consignor_address = $this->input->post('consignor_address');
				$consignor_contact_person = $this->input->post('consignor_contact_person');
				$consignor_contact_person_position = $this->input->post('consignor_contact_person_position');
				$consignor_contact_information = $this->input->post('consignor_contact_information');


				$meta_documents = array();
				$meta_logs = array();
				$accredited_documents_count = 0;
				$count_documents = (int) $_POST['count_documents'];
				for ($i=1; $i <= $count_documents; $i++) {
					$strSplit = explode("_", $_POST['accreditation_id__' . $i]);
					$document_id = $strSplit[0];
					$boolean_value = $strSplit[1];
					$meta_documents[$document_id] = $boolean_value;
					if ( (boolean) $boolean_value != false ) {
						$accredited_documents_count++;
					}
				}
				$passed = $accredited_documents_count == $count_documents ? true : false;

				$meta_documents = json_encode($meta_documents);
				$meta_logs = json_encode($meta_logs);

				$this->load->database();
				$args = array(
					'consignor_name'					=>	$consignor_name,
					'consignor_address'					=>	$consignor_address,
					'consignor_contact_person'			=>	$consignor_contact_person,
					'consignor_contact_person_position'	=>	$consignor_contact_person_position,
					'consignor_contact_info'			=>	$consignor_contact_information,
					'consignor_is_accredited'			=>	$passed,
					'consignor_accreditation_details'	=>	$meta_documents,
					'consignor_created_by'				=>	$this->current_user_session_id,
					'consignor_edited_by'				=>	$this->current_user_session_id,
				);
				$result = $this->cnsgnr_mdl->save_consignor($args, $consignor_id);
				if ( $result != false ) {

					$target_url = $this->input->post('target_url');
					$redirect_url = !is_null($consignor_id) || is_numeric($consignor_id) || 0 != $consignor_id ? $target_url : $target_url . $result . '/'; 
					redirect( $redirect_url );

				} else {

					$data['page_title'] = "&mdash; Failed to add consignor";
					$data['fail_insert_msg'] = "Failed to save consignor datas.";
					$data['consignor_documents'] = $this->cnsgnr_mdl->get_accreditation_documents();
					$this->load->view( 'header', $data );
					$this->load->view( 'sidebar' );
					$this->load->view( 'dashboard/consignor/Consignor_add_view' );
					$this->load->view( 'footer' );

				}

			}

		}

	}

}
?>