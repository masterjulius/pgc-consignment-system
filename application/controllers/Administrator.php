<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public $admin_pages = array();

	public function __construct() {
		parent::__construct();
		$this->load->library( array('user_security', 'page_actions', 'ext_meta') );
		$this->load->library( array('form_validation', 'encryption') );
		$this->load->helper( array('url', 'html', 'form') );

		/**
		 * Assign certain capabilities to the admin pages variable
		*/
		$this->_register_pages();

	}

	public function index() {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$controller = ucwords( $this->uri->segment(1) );
			$data['page_title'] = $controller;
			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/Dashboard_view' );
			$this->load->view( 'footer' );

		} else {

			$this->_get_login_view();

		}

	}

	/** ----------------------------------------------------------------------------------
	* |										Glossary Group 								 |
	* ------------------------------------------------------------------------------------
	*/

	/** -------------------------------------------------------------------------
	* |							Glossary Controller 							|
	* ---------------------------------------------------------------------------
	*/

	public function glossary( $action = 'default', $glossary_id = null ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$config = $this->_init_pagination_config();

			if ( $action === 'new' ) {

				$data['page_title'] = 'New Item';

				// Filling up combo box datas
				$this->load->model( 'brand/Brand_model', 'brnd_mdl' );
				$this->load->model( 'disease/Disease_model', 'dsse_mdl' );

				$data['list_brands'] = $this->brnd_mdl->get_all_brand();
				$data['list_diseases'] = $this->dsse_mdl->get_all_disease();
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/glossary/Glossary_add_view' );
				$this->load->view( 'footer' );

			} else {

				// the default page
				$data['page_title'] = 'Glossary';
				$data['nav_title'] = 'Medicine/Supply List';
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/sub_navbar_view' );
				$this->load->view( 'dashboard/glossary/Glossary_view' );
				$this->load->view( 'footer' );

			}
			
		}		

	}

	/** -------------------------------------------------------------------------
	* |								Brand Controller 							|
	* ---------------------------------------------------------------------------
	*/

	public function brand( $action = 'default', $brand_id = null ) {

		$config = $this->_init_pagination_config();
		$this->load->model( 'brand/Brand_model', 'brnd_mdl' );

		if ( $action === 'new' || $action === 'new-brand' || $action === 'newbrand' || $action === 'add-brand' || $action === 'addbrand' ) {

			// new / add brand
			$data['page_title'] = 'Add Brand';
			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/brand/Brand_add_view' );
			$this->load->view( 'footer' );

		} else if ( $action === 'edit' || $action === 'editbrand' || $action === 'updatebrand' || $action === 'edit-brand' || $action === 'update-brand' ) {

			if ( null != $brand_id || '' != $brand_id ) {

				// new / add brand
				$result_data = $this->brnd_mdl->get_single_brand( $brand_id );

				$data['brand_metadata'] = $result_data;
				//echo $data['brand_metadata'];
				$data['page_title'] = 'Edit Brand';
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/brand/Brand_edit_view' );
				$this->load->view( 'footer' );

			}

		} else if ( $action === 'search' || $action == 's' ) {

			// search action
			// This is the display of list of brands
			$data['page_title'] = 'Brands';
			$data['nav_title'] = 'Brand List';
			$data['add_new_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'new-brand' );
			$data['admin_pages'] = $this->admin_pages;

			$search_key = $this->input->post( 'search_brand' );
			if ( $search_key === '*' ) {
				$search_key = '';
			}
			$data[ 'search_key' ] = $search_key;

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->brnd_mdl->get_all_brand() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['brand_metadata'] = $this->brnd_mdl->get_all_brand( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset, 'key'	=>	$search_key ) );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/sub_navbar_view' );
			$this->load->view( 'dashboard/brand/Brands_view' );
			$this->load->view( 'footer' );

		} else if ( $action === 'logs' || $action === 'logview' ) {

			// This is the logs view
			$data['page_title'] = 'Brands';
			$data['nav_title'] = 'Brand List';
			$data['add_new_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'new-brand' );

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->brnd_mdl->get_activity_logs() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['log_metadata'] = $this->brnd_mdl->get_activity_logs( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset ) );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/brand/Brand_log_view' );
			$this->load->view( 'footer' );


		} else if ( $action === 'trash' ) {

			// Trash / Recycle view
			$data['page_title'] = 'Trash Bin';

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->brnd_mdl->get_all_brand() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['brand_metadata'] = $this->brnd_mdl->get_all_brand( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset ), FALSE, FALSE );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/brand/Brand_trash_view' );
			$this->load->view( 'footer' );

		} else if ( $action === 'delete' ) {

			// delete the brand
			if ( is_numeric( $brand_id ) ) {

				$exec = $this->brnd_mdl->delete_restore_brand( $brand_id );
				if ( $exec ) {

					$redirect_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) );
					redirect( $redirect_url );

				}

			}

		} else if ( $action === 'restore' ) {

			// restore the brand
			if ( is_numeric( $brand_id ) ) {

				$exec = $this->brnd_mdl->delete_restore_brand( $brand_id, 'restore' );
				if ( $exec ) {

					$redirect_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) );
					redirect( $redirect_url );

				}

			}

		} else {

			// This is the display of list of brands
			$data['page_title'] = 'Brands';
			$data['nav_title'] = 'Brand List';
			$data['add_new_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'new-brand' );

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->brnd_mdl->get_all_brand() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['brand_metadata'] = $this->brnd_mdl->get_all_brand( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset ) );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/sub_navbar_view' );
			$this->load->view( 'dashboard/brand/Brands_view' );
			$this->load->view( 'footer' );

		}

	}

	/** -------------------------------------------------------------------------
	* |								Disease Controller 							|
	* ---------------------------------------------------------------------------
	*/

	public function disease( $action = 'default', $disease_id = null ) {

		$this->load->model( 'disease/Disease_model', 'dsse_mdl' );
		$config = $this->_init_pagination_config();

		if ( $action === 'add' || $action === 'new' ) {

			// add action
			$data['page_title'] = 'Diseases';
			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/disease/Disease_add_view' );
			$this->load->view( 'footer' );


		} else if ( $action === 'edit' ) {

			// edit action
			if ( null != $disease_id || '' != $disease_id ) {

				// new / add brand
				$result_data = $this->dsse_mdl->get_single_disease( $disease_id );
				$data['disease_metadata'] = $result_data;
				$data['page_title'] = 'Edit Disease';
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/disease/Disease_edit_view' );
				$this->load->view( 'footer' );

			}

		} else if ( $action === 'search' || $action == 's' ) {

			// search action
			// This is the display of list of brands
			$data['page_title'] = 'Diseases';
			$data['nav_title'] = 'Disease List';
			$data['admin_pages'] = $this->admin_pages;

			$search_key = $this->input->post( 'search_disease' );
			if ( $search_key === '*' ) {
				$search_key = '';
			}
			$data[ 'search_key' ] = $search_key;

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->dsse_mdl->get_all_disease() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['disease_metadata'] = $this->dsse_mdl->get_all_disease( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset, 'key'	=>	$search_key ) );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/sub_navbar_view' );
			$this->load->view( 'dashboard/disease/Diseases_view' );
			$this->load->view( 'footer' );

		} else if ( $action === 'delete' ) {

			// delete the brand
			if ( is_numeric( $disease_id ) ) {

				$exec = $this->dsse_mdl->delete_restore_disease( $disease_id );
				if ( $exec ) {

					$redirect_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) );
					redirect( $redirect_url );

				}

			}

		} else if ( $action === 'restore' ) {

			// restore the brand
			if ( is_numeric( $disease_id ) ) {

				$exec = $this->dsse_mdl->delete_restore_disease( $disease_id, 'restore' );
				if ( $exec ) {

					$redirect_url = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) );
					redirect( $redirect_url );

				}

			}

		} else if ( $action === 'logs' || $action === 'logview' ) {

			// This is the logs view
			$data['page_title'] = 'Disease';
			$data['nav_title'] = 'Disease List';
			$data['add_new_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'new-brand' );

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->dsse_mdl->get_activity_logs() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['log_metadata'] = $this->dsse_mdl->get_activity_logs( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset ) );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/disease/Disease_logs_view' );
			$this->load->view( 'footer' );


		} else if ( $action === 'trash' ) {

			// This is the trash view
			$data['page_title'] = 'Diseases &mdash; Trash';

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->dsse_mdl->get_all_disease() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['disease_metadata'] = $this->dsse_mdl->get_all_disease( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset ), FALSE, FALSE );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/disease/Disease_trash_view' );
			$this->load->view( 'footer' );


		} else {

			// This is the display of list of brands
			$data['page_title'] = 'Diseases';
			$data['nav_title'] = 'Disease List';

			// pagination
			// i will initialize the pagination first
			$this->load->library('pagination');

			$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
			$config['total_rows'] = count( $this->dsse_mdl->get_all_disease() );
			$config['per_page'] = 10;
			$config['num_links'] = 20;

			$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

			$data['disease_metadata'] = $this->dsse_mdl->get_all_disease( array( 'limit'	=>	$config['per_page'], 'offset'	=>	$offset ) );

			$this->load->view( 'header', $data );
			$this->load->view( 'sidebar' );
			$this->load->view( 'dashboard/sub_navbar_view' );
			$this->load->view( 'dashboard/disease/Diseases_view' );
			$this->load->view( 'footer' );

		}

	}


	/** --------------------------------------------------------------------------------------
	* |										End Glossary Group 								 |
	* ----------------------------------------------------------------------------------------
	*/


	/** ---------------------------------------------------------------------------------------------
	 * |																							|
	 * |									SYSTEM DEFAULTS											|
	 * |																							|
	 * ----------------------------------------------------------------------------------------------
	 */


	/** ----------------------------------------------------------------------
	* |							Users Group 								 |
	* ------------------------------------------------------------------------
	*/

	public function users( $action = 'default', $user_id = null ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$config = $this->_init_pagination_config();

			if ( $action === 'new' ) {

				$data['page_title'] = 'Add User';
				$this->load->model( 'Roles_model', 'roles_model' );
				$data['roles_info'] = $this->roles_model->get_role_informations( null, TRUE );
				$data['roles_metadata'] = array();
				foreach ($data['roles_info'] as $value) {
					$data['roles_metadata'][ $value[ 'role_id' ] ] = $value[ 'role_name' ];
				}
				
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/users/User_add_view' );
				$this->load->view( 'footer' );

			} else if ( $action === 'edit' ) {

				// check if the user id exists
				$this->load->model( 'Users_model', 'usr_mdl' );

				if ( $this->usr_mdl->get_user_metadata( $user_id ) != FALSE ) {

					$data['user_metadata'] = $this->usr_mdl->get_user_metadata( $user_id );

					$data['page_title'] = 'Edit User';
					$this->load->model( 'Roles_model', 'roles_model' );
					$data['roles_info'] = $this->roles_model->get_role_informations( null, TRUE );
					$data['roles_metadata'] = array();
					foreach ($data['roles_info'] as $value) {
						$data['roles_metadata'][ $value[ 'role_id' ] ] = $value[ 'role_name' ];
					}
					
					$this->load->view( 'header', $data );
					$this->load->view( 'sidebar' );
					$this->load->view( 'dashboard/users/User_edit_view' );
					$this->load->view( 'footer' );

				} else {

					$this->_get_404_page();

				}	

			} else if ( $action === 'search' ) {

				// seach action
				$data['page_title'] = 'Users Search Results';
				$data['nav_title']= 'Users';
				$data['admin_pages'] = $this->admin_pages;

				$search_key = $this->input->post( 'search_users' );
				if ( $search_key === '*' ) {
					$search_key = '';
				}
				$this->load->model( 'Users_model', 'users_model' );

				// i will initialize the pagination first
				$this->load->library('pagination');

				$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
				$config['total_rows'] = count( $this->users_model->get_all_users() );
				$config['per_page'] = 10;
				$config['num_links'] = 20;

				$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

				$data['users_metadata'] = $this->users_model->get_all_users( null, array( 'key' => $search_key, 'limit' => $config['per_page'], 'offset' => $offset ) );

				$data['config'] = $config;

				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/sub_navbar_view', $data );
				$this->load->view( 'dashboard/users/Users_view' );
				$this->load->view( 'footer' );


			} else if ( $action === 'logs' ) {

				// logs view
				$data['page_title'] = 'User Logs';
				$data['nav_title']= 'User Logs';

				$this->load->model( 'Users_model', 'users_model' );

				//i will initialize the pagination first
				$this->load->library('pagination');
				// configurations
				$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . $this->uri->slash_rsegment(3) );
				$config['total_rows'] = count( (array) $this->users_model->get_users_log() );
				$config['per_page'] = 10;
				$config['num_links'] = 20;

				$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

				$data['users_log_metadata'] = $this->users_model->get_users_log( array( 'limit' => $config['per_page'], 'offset' => $offset ) );

				$data['config'] = $config;

				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/sub_navbar_logs_view' );
				$this->load->view( 'dashboard/users/Users_log_view' );
				$this->load->view( 'footer' );

			} else {

				// load all users
				$data['page_title'] = 'Users';
				$data['nav_title']= 'Users';
				$this->load->model( 'Users_model', 'users_model' );

				//i will initialize the pagination first
				$this->load->library('pagination');
				// configurations
				$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
				$config['total_rows'] = count( $this->users_model->get_all_users() );
				$config['per_page'] = 10;
				$config['num_links'] = 20;

				$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

				$data['users_metadata'] = $this->users_model->get_all_users( array( 'limit' => $config['per_page'], 'offset' => $offset ) );

				$data['config'] = $config;

				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/sub_navbar_view' );
				$this->load->view( 'dashboard/users/Users_view' );
				$this->load->view( 'footer' );

			}

		} else {

			$this->_get_login_view();

		}	

	}

	/** ----------------------------------------------------------------------
	* |							Roles Group 								 |
	* ------------------------------------------------------------------------
	*/			
	public function roles( $action = 'default', $role_id = null ) {

		if ( $this->user_security->is_user_logged_in( 'cnsgnmnt_sess_prefix_' ) ) {

			$config = $this->_init_pagination_config();


			if ( $action === 'new' ) {

				$controller = ucwords( $this->uri->segment(1) );
				$data['page_title'] = 'Add new role';
				$data['page_title'] = $controller;
				$data['admin_pages'] = $this->admin_pages;
				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/roles/Role_add_view', $data );
				$this->load->view( 'footer' );

			} else if ( $action === 'edit' ) {

				if ( !empty( $role_id ) || $role_id != null  ) {

					$controller = ucwords( $this->uri->segment(1) );
					$data['page_title'] = 'Edit role';
					$data['admin_pages'] = $this->admin_pages;
					$this->load->model( 'Roles_model', 'roles_model' );
					$role_metadata = (array) $this->roles_model->get_role_informations( $role_id );
					$data['role_metadata'] = $role_metadata[0];

					$data['role_capabilities'] = $role_metadata[0]->role_value_decoded->pages;

					$this->load->view( 'header', $data );
					$this->load->view( 'sidebar' );
					$this->load->view( 'dashboard/roles/Role_edit_view', $data );
					$this->load->view( 'footer' );

				}

			} else if ( $action === 'trash' ) {

				$controller = ucwords( $this->uri->segment(1) );
				$data['page_title'] = 'Deleted Roles';
				$data['admin_pages'] = $this->admin_pages;
				$this->load->model( 'Roles_model', 'roles_model' );
				$data['role_metadata'] = $this->roles_model->get_role_informations( null, FALSE, FALSE );

				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/roles/Roles_trash_view' );
				$this->load->view( 'footer' );

			} else if ( $action === 'search' ) {

				// the search action
				$controller = ucwords( $this->uri->segment(1) );
				$data['page_title'] = 'User Roles';
				$data['nav_title']= 'User Roles';
				$data['admin_pages'] = $this->admin_pages;

				$search_key = $this->input->post( 'search_roles' );
				if ( $search_key === '*' ) {
					$search_key = '';
				}
				$this->load->model( 'Roles_model', 'roles_model' );

				//i will initialize the pagination first
				$this->load->library('pagination');

				$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
				$config['total_rows'] = count( (array) $this->roles_model->get_role_informations(  null, FALSE, TRUE, $search_key ) );
				$config['per_page'] = 10;
				$config['num_links'] = 20;

				$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

				$searchParam = array(
					'key'		=>	$search_key,
					'limit'		=>	$config['per_page'],
					'offset'	=>	$offset		
				);

				$data['role_metadata'] = $this->roles_model->get_role_informations( null, FALSE, TRUE, $searchParam );

				$data['config'] = $config;

				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/sub_navbar_view', $data );
				$this->load->view( 'dashboard/roles/Roles_view' );
				$this->load->view( 'footer' );

			} else if ( $action === 'logs' ) {

				// logs view
				$data['page_title'] = 'Role Logs';
				$data['nav_title']= 'Role Logs';

				$this->load->model( 'Roles_model', 'roles_model' );

				//i will initialize the pagination first
				$this->load->library('pagination');
				// configurations
				$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . $this->uri->slash_rsegment(3) );
				$config['total_rows'] = count( (array) $this->roles_model->get_roles_log() );
				$config['per_page'] = 10;
				$config['num_links'] = 20;

				$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

				$data['roles_log_metadata'] = $this->roles_model->get_roles_log( array( 'limit' => $config['per_page'], 'offset' => $offset ) );

				$data['config'] = $config;

				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/sub_navbar_logs_view' );
				$this->load->view( 'dashboard/roles/Roles_log_view' );
				$this->load->view( 'footer' );

			} else if ( $action === 'logview' || $action === 'viewlog' || $action === 'readlog' ) {

				echo "Read Log";

			} else {

				// the full view / defult view where all the user roles are listed
				$controller = ucwords( $this->uri->segment(1) );
				$data['page_title'] = 'User Roles';
				$data['nav_title']= 'User Roles';
				$data['admin_pages'] = $this->admin_pages;
				$this->load->model( 'Roles_model', 'roles_model' );
				
				//i will initialize the pagination first
				$this->load->library('pagination');
				// configurations
				$config['base_url'] = base_url( $this->uri->slash_rsegment(1) . $this->uri->slash_rsegment(2) . 'page/' );
				$config['total_rows'] = count( (array) $this->roles_model->get_role_informations() );
				$config['per_page'] = 10;
				$config['num_links'] = 20;

				$offset = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

				$data['role_metadata'] = $this->roles_model->get_role_informations( null, FALSE, TRUE, null, array( 'limit' => $config['per_page'], 'offset' => $offset ) );

				$data['config'] = $config;

				$this->load->view( 'header', $data );
				$this->load->view( 'sidebar' );
				$this->load->view( 'dashboard/sub_navbar_view' );
				$this->load->view( 'dashboard/roles/Roles_view' );
				$this->load->view( 'footer' );

			}

		} else {

			$this->_get_login_view();

		}

	}

	// 404 Page
	public function invalid() {

		$this->_get_404_page();

	}


	// -------------------------------------------------------------------------------

	private function _register_pages() {

		$roles_page = $this->page_actions->_register_single_admin_page( 'Roles_view', 'RolesView', 'dashboard/roles' );
		$roles_add_page = $this->page_actions->_register_single_admin_page( 'Role_add_view', 'RolesAddView', 'dashboard/roles' );
		$roles_edit_page = $this->page_actions->_register_single_admin_page( 'Role_edit_view', 'RolesEditView', 'dashboard/roles' );
		$users_page = $this->page_actions->_register_single_admin_page( 'Users_view', 'UsersView', 'dashboard/users' );
		$payments_page = $this->page_actions->_register_single_admin_page( 'Payments_view', 'PaymentsView', 'dashboard' );

		array_push( $this->admin_pages, $roles_page );
		array_push( $this->admin_pages, $roles_add_page );
		array_push( $this->admin_pages, $roles_edit_page );
		array_push( $this->admin_pages, $users_page );
		array_push( $this->admin_pages, $payments_page );

	}

	private function _get_login_view() {

		$data['page_title'] = 'User Sign In';
		$this->load->view( 'header', $data );
		$this->load->view( 'Login_view' );
		$this->load->view( 'footer' );

	}

	// 404 page
	private function _get_404_page() {

		$data['page_title'] = '404 Not Found!';
		$this->load->view( 'header', $data );
		$this->load->view( 'dashboard/404_view' );
		$this->load->view( 'footer' );

	}

	private function _init_pagination_config() {

		// initialize the pagination markups here
		// html markup configurations
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li class="waves-effect">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="waves-effect">';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_link'] = '&lt';
		$config['next_link'] = '&gt';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';
		return $config;

	}
	
}

?>