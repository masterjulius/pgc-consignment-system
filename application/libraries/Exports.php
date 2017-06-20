<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @uses     	PHPExcel Library
 * @link     	https://github.com/PHPOffice/PHPExcel
 * @author      Julius Palcong
 * @copyright   Copyright (c) 2017, Cagayan Provincial Capitol.
 * @license     
 * @link        https://github.com/masterjulius/codeigniterlibrary
 * @since       Version 1.0
 * @filesource
 */

class Exports {

	/** Local Variable Declarations */

	public function excel( $data, $attributes = array(
			'sheetIndex' 			=> 0,
			'sheetTitle'			=> 'My First Sheet',
			'headerColumns'			=> array(),
			'headerColumnStart'		=> 'A',
			'headerRowStart'		=> 1,
			'cellValueKeys'			=> array(),
			'dataColumnStart'		=> 'A',
			'dataRowStart'			=> 2,
			'fileNamePrefix'		=> 'Export_',
			'dateFormat'			=> 'Y-m-d_H-i-s', 
			'passwordProtected'		=> false,
			'workbookPassword'		=> '1234567890',
			'sheetPassword'			=> '1234567890'
		) 
	) {

		// Convert the array to object if it is array
		$attributes = is_array( $attributes ) ? (object) $attributes : $attributes;	

		foreach ( $data as $key => $value ) {

			if ( is_array( $data[$key] ) ) {
				
				// variable is object
				$data[$key] = (object) $data[$key];

			}

		}

		require ( APPPATH . 'third_party/Classes/PHPExcel.php' );
		require ( APPPATH . 'third_party/Classes/PHPExcel/Writer/Excel2007.php' );

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator();
		$objPHPExcel->getProperties()->setTitle();
		$objPHPExcel->getProperties()->setSubject();
		$objPHPExcel->getProperties()->setDescription();

		// set active sheet
		$objPHPExcel->setActiveSheetIndex( $attributes->sheetIndex );

		$headerColumnArr = $attributes->headerColumns;

		$headerColumnStart = $attributes->headerColumnStart;
		$headerRowStart = $attributes->headerRowStart;
		for ( $i = 0; $i < count( $headerColumnArr ); $i++ ) {
			
			$cellLocation = $headerColumnStart . $headerRowStart;

			$objPHPExcel->getActiveSheet()->SetCellValue( $cellLocation, $headerColumnArr[$i] );

			$headerColumnStart++;

		}

		// start with row number 2(Not in array type that starts with the number 0)
		$cellValueKeyArrs = $attributes->cellValueKeys;

		$dataRowIndex = $attributes->dataRowStart;

		foreach ( $data as $row ) {

			$dataColumnStart = $attributes->dataColumnStart;

			for ( $i = 0; $i < count( $cellValueKeyArrs ); $i++ ) {

				$cellLocation = $dataColumnStart . $dataRowIndex;
				$key = $cellValueKeyArrs[$i];

				$objPHPExcel->getActiveSheet()->SetCellValue( $cellLocation, $row->$key );

				$dataColumnStart++;

			}

			$dataRowIndex++;

		}

		$fileName = $attributes->fileNamePrefix . date( $attributes->dateFormat ) . ".xlsx";

		$objPHPExcel->getActiveSheet()->setTitle( $attributes->sheetTitle );

		// Set password against the spreadsheet file
		if ( $attributes->passwordProtected === true ) {

			$objPHPExcel->getSecurity()->setLockWindows( true );
			$objPHPExcel->getSecurity()->setLockStructure( true );
			$objPHPExcel->getSecurity()->setWorkbookPassword( $attributes->workbookPassword );

			$objPHPExcel->getActiveSheet()->getProtection()->setSheet( true );
			$objPHPExcel->getActiveSheet()->getProtection()->setSort( true );
			$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows( true );
			$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells( true );
			$objPHPExcel->getActiveSheet()->getProtection()->setPassword( $attributes->sheetPassword );

		}

		header( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
		header( 'Content-Disposition: attachment;filename="' . $fileName . '"' );
		header( 'Cache-Control: max-age=0' );

		$writer = PHPExcel_IOFactory::createWriter( $objPHPExcel, 'Excel2007' );
		ob_end_clean();
		$writer->save( 'php://output' );
		exit;

	}

}