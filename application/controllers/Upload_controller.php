<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload_controller extends CI_Controller {

	public $current_user_session_id;
	public $current_timestamp;

	public function __construct() {

		parent::__construct();
		$this->load->library( array('user_security', 'ext_meta') );
		$this->load->library( array('session', 'encryption') );
		$this->load->helper( array('url') );
		$this->current_user_session_id = $this->session->cnsgnmnt_sess_prefix_user_id;
		$this->current_timestamp = date( "Y-m-d H:i:s" );

	}

	public function upload_file($group='glossary',$type='excel') {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			switch ($type) {
				case 'excel':
					$config['upload_path'] 		= './uploads/excel/import/glossary/tmp/';
					$config['file_name'] 		= date('y-m-d_H-i-s-v__') . 'import.xlsx';
					$config['allowed_types'] 	= 'xlsx|xls';
					break;
				
				default:
					$config['upload_path'] 		= './uploads/images/';
					$config['filename'] 		= md5( uniqid() . time() ) . '.jpg';
					$config['allowed_types'] 	= 'gif|jpg|png';
					$config['max_size']         = 100;
            		$config['max_width']        = 1024;
            		$config['max_height']       = 768;
					break;
			}

			$this->load->library('upload', $config);

			$returnValue;
			if ( ! $this->upload->do_upload('fileUpload')) {
				$returnValue = array('error' => $this->upload->display_errors('',''));
			} else {
				$returnValue = array('upload_data' =>$this->upload->data());
			}
			/* Send as JSON */
		    // header("Content-Type: application/json", true);
		    echo json_encode($returnValue);
			exit;


		} else {
			redirect(base_url());
		}

	}

	public function scan_excel_datas() {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			require ( APPPATH . 'third_party/Classes/PHPExcel.php' );
			require ( APPPATH . 'third_party/Classes/PHPExcel/Writer/Excel2007.php' );

			$tmpfname = $this->input->post('postFile');

			if ($tmpfname) {
				if ($tmpfname != '' || is_null($tmpfname)) {
					$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
					$excelObj = $excelReader->load($tmpfname);
					$worksheet = $excelObj->getSheet(0);
					$lastRow = $worksheet->getHighestRow();
					for ($row = 2; $row <= $lastRow; $row++) {
						$arr_worksheet[] = array( $worksheet->getCell('A1')->getValue() => $worksheet->getCell('A'.$row)->getValue() , $worksheet->getCell('B1')->getValue() => $worksheet->getCell('B'.$row)->getValue() );
					}
					/* Send as JSON */
		    		header("Content-Type: application/json", true);
		    		echo json_encode($arr_worksheet);
		    		exit;
		    	}	
			}

		} else {
			redirect(base_url());
		}

	}

	/**
	 * Database Saving Action
	 */
	public function save_scanned_datas() {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$jsonDatas = $this->input->post('jsonDatas');
			foreach ($jsonDatas as $value) {
				$jsonDatas[$value]['item_name'] 		= $jsonDatas[$value]['PARTICULARS'];
				$jsonDatas[$value]['item_description']	= $jsonDatas[$value]['REMARKS'];
			}

			$this->load->database();
			$this->load->model('glossary/Glossary_model','glsry_mdl');
			$this->glsry_mdl->batch_save_glossary($jsonDatas);
			
			/* Send as JSON */
			// header("Content-Type: application/json", true);
			// echo json_encode($jsonDatas);
			exit;

		} else {
			redirect(base_url());
		}

	}

}
?>