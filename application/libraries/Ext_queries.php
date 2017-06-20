<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * It will still use the database reference of the codeigniter
 *
 * @package     CodeIgniter
 * @author      Julius Palcong
 * @copyright   Copyright (c) 2017, Cagayan Provincial Capitol.
 * @license     
 * @link        http://www.cagayan.gov.ph
 * @since       Version 1.0
 *
 * @filesource
 */
	class Ext_queries {

		protected $CI;

		public function __construct() {

			// Assign the CodeIgniter super-object
	        $this->CI =& get_instance();
	        $this->CI->load->library( array('array_actions') );
	        $this->CI->load->database();

		}

		/**
		* get_query
		* insert_query
		* update_dquery
		* delete_query
		* restore_query
		* ------------
		* meta_ext_query
		* ------------
		* join_get_query
		* union_get_query
		*/

		public function get_query( $tableName, $columnsToShow, $arguments ) {
			
			if ( $this->CI->db->table_exists( $tableName ) ) {

				$returnValue = array();
				$stmt = "SELECT ";
				$bindedValues = array();

				if ( !empty( $columnsToShow ) || $columnsToShow != null ) {
					
					if ( is_array( $columnsToShow ) ) {
						$indexCols = 1;
						foreach ($columnsToShow as $value) {
							
							if ($this->CI->db->field_exists( $value, $tableName ) ) {

								if ( $indexCols == count( $columnsToShow ) ) {

									$stmt .= "`{$value}` ";									

								} else {

									$stmt .= "`{$value}`, ";

								}

							}

							$indexCols++;	

						}

					} else {

						$stmt .= "`{$columnsToShow}` ";

					}

				}

				$stmt .= "FROM `{$tableName}` ";

				// ------------------------------------------------------------------

				if ( !empty( $arguments ) || $arguments != null ) {

					$stmt .= 'WHERE ';

					if ( is_array( $arguments ) ) {

						$index = 1;
						
						foreach ($arguments as $key => $value) {

							if ( $key == 'meta_ext_query' ) {
							
								if ( is_array( $arguments[ $key ] ) ) {

									

								}

							} else {

								if ($this->CI->db->field_exists( $key, $tableName ) ) {
			        				
									if ( is_array( $arguments[ $key ] ) ) {

										$stmt .= "`{$key}` IN ( ";

										$indexFields = 1;
										$fieldArrs = $arguments[ $key ];
										foreach ($fieldArrs as $fieldValues) {

											if ( $index == count ( $fieldArrs ) ) {

												$stmt .= "? ";

											} else {

												$stmt .= "?, ";

											}

											array_push($bindedValues, $fieldValues);

											$indexFields++;

										}	

										$stmt .= " )";

									} else {

										if ( $index == count( $arguments ) ) {

											$stmt .= "`{$key}`=?";

										} else {

											$stmt .= "`{$key}`=? AND ";

										}
										
										array_push($bindedValues, $value);

									}

								} else {

									echo "<p>The field {$key} does not exist in the {$tableName} table.</p>";

								}

							}

							$index++;

						} // end of the foreach loop

					}

				}

				// -----------------------------------------------------------------------


				// return the query statement
				echo $stmt;
				echo '<hr/>';
				echo '<pre>';
					print_r($bindedValues);
				echo '</pre>';

			} else {

				echo "<p>The table does not exist in the database.</p>";

			}

		}

		public function get_user_query( $arguments ) {

			$returnValue = array();
				$stmt = "SELECT ";
				$bindedValues = array();

				if ( !empty( $columnsToShow ) || $columnsToShow != null ) {
					
					if ( is_array( $columnsToShow ) ) {
						$indexCols = 1;
						foreach ($columnsToShow as $value) {
							
							if ($this->CI->db->field_exists( $value, $tableName ) ) {

								if ( $indexCols == count( $columnsToShow ) ) {

									$stmt .= "`{$value}` ";									

								} else {

									$stmt .= "`{$value}`, ";

								}

							}

							$indexCols++;	

						}

					} else {

						$stmt .= "`{$columnsToShow}` ";

					}

				}

				$stmt .= "FROM `{$tableName}` ";

				// ------------------------------------------------------------------

				if ( !empty( $arguments ) || $arguments != null ) {

					$stmt .= 'WHERE ';

					if ( is_array( $arguments ) ) {

						$index = 1;
						
						foreach ($arguments as $key => $value) {

							if ( $key == 'meta_ext_query' ) {
							
								if ( is_array( $arguments[ $key ] ) ) {

									

								}

							} else {

								if ($this->CI->db->field_exists( $key, $tableName ) ) {
			        				
									if ( is_array( $arguments[ $key ] ) ) {

										$stmt .= "`{$key}` IN ( ";

										$indexFields = 1;
										$fieldArrs = $arguments[ $key ];
										foreach ($fieldArrs as $fieldValues) {

											if ( $index == count ( $fieldArrs ) ) {

												$stmt .= "? ";

											} else {

												$stmt .= "?, ";

											}

											array_push($bindedValues, $fieldValues);

											$indexFields++;

										}	

										$stmt .= " )";

									} else {

										if ( $index == count( $arguments ) ) {

											$stmt .= "`{$key}`=?";

										} else {

											$stmt .= "`{$key}`=? AND ";

										}
										
										array_push($bindedValues, $value);

									}

								} else {

									echo "<p>The field {$key} does not exist in the {$tableName} table.</p>";

								}

							}

							$index++;

						} // end of the foreach loop

					}

				}

				// -----------------------------------------------------------------------


				// return the query statement
				echo $stmt;
				echo '<hr/>';
				echo '<pre>';
					print_r($bindedValues);
				echo '</pre>';

		}
		

		// --------------------------------- RESULT GENERATING --------------------------------------
		// ------------------------------------------------------------------------------------------
		private function _generate_unbuffered_results( $query, $returnArray = FALSE ) {

			if ( !empty( $query ) ) {

				$returnResult = array();
					
				// if variable is array
				if ( FALSE === $returnArray ) {

					while ( $row = $query->unbuffered_row() ) {

						$returnResult[ 'key_id' ] = $row->key_id;
						$returnResult[ 'key_name' ] = $row->key_name;
						$returnResult[ 'key_is_reserved' ] = $row->key_is_reserved;

					}

					return (object) $returnResult;

				} else {

					while ( $row = $query->unbuffered_row( 'array' ) ) {

						$returnResult[ 'key_id' ] = $row['key_id'];
						$returnResult[ 'key_name' ] = $row['key_name'];
						$returnResult[ 'key_is_reserved' ] = $row['key_is_reserved'];

					}

					return $returnResult;

				}

			}

		} 


		//** ------------------------------------------------------- **/

		// Private
		private function _execute_bind_query( $query, $bindValues ) {

			return $sql = $this->CI->db->query( $query, $bindValues );

		}


	}
	
?>		