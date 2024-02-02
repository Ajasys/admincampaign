<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.3
$routes->get('/signup', 'Home::signup');
$routes->get('/login', 'Home::login');
$routes->post('user_login', 'Userlogin::user_login');
//user-login
$routes->post('/login_insert_data', 'Userlogin::insert_data');
$routes->group('',['filter' => 'authlogin'], function($routes){


	$routes->get('/allinquiry', 'Home::allinquiry');

	$routes->get('/', 'Home::index');
	$routes->get('/competitormasters', 'Home::competitormasters');
	$routes->get('/peoplelist', 'Home::peoplelist');

	$routes->get('/todayfollowup', 'Home::todayfollowup');
	$routes->get('/pendingfollow', 'Home::pendingfollow');
	$routes->get('/country_list', 'Home::country_list');
	$routes->get('/project_type', 'Home::project_type');
	$routes->get('/managermasterinquiry', 'Home::managermasterinquiry');
	$routes->get('/customer', 'Home::customer');
	$routes->get('/manageinquirystatus', 'Home::manageinquirystatus');
	$routes->get('/property', 'Home::property');
	$routes->get('/project_sub_type', 'Home::projectsubtype');
	$routes->get('/user-admin-role', 'Home::user_admin_role');
	$routes->get('/manage-inquiry-source', 'Home::manage_inquiry_source');
	$routes->get('/inquiry-source-type', 'Home::inquiry_source_type');

	$routes->get('/statelist', 'Home::statelist');
	$routes->get('/citylist', 'Home::citylist');
	$routes->get('/manage_inquiry_close', 'Home::manage_inquiry_close');
	$routes->get('/area_location', 'Home::area_location');
	$routes->get('/surname', 'Home::surname');
	$routes->get('/sub_caste', 'Home::sub_caste');
	$routes->get('/addnew_user', 'Home::addnew_user');
	
	
	$routes->get('competitor_analysis', 'Home::competitor_analysis');
	$routes->get('project_details', 'Home::projectdetails');
	$routes->get('que_ans','Home::que_ans');


	  // occupation
	$routes->get('/occupation', 'Home::occupation');
	$routes->post('/insert_data', 'MasterInformation::insert_data');
	$routes->post('/MasterInformation_Occupationlisting', 'MasterInformation::show_list_data');
	$routes->post('/MasterInformation_edit', 'MasterInformation::edit_data');
	$routes->post('/MasterInformation_update', 'MasterInformation::update_data');
	$routes->post('/MasterInformation_delete', 'MasterInformation::delete_data');


	// project status
	$routes->get('/project_status', 'Home::projectstatus');
	$routes->post('/MasterInformation_project_statuslisting', 'MasterInformation::project_status_show_list_data');

	// project type
	$routes->get('/project_type', 'Home::projecttype');
	$routes->post('/MasterInformation_project_typelisting', 'MasterInformation::MasterInformation_project_typelisting');
	$routes->post('/project_insert_data', 'ProjectInformation::insert_data');
	$routes->post('/project_show_list_data', 'ProjectInformation::project_show_list_data');
	$routes->post('project_sub_type', 'ProjectInformation::project_sub_type');
	$routes->post('project_view', 'ProjectInformation::view_data');
	$routes->post('/project_edit', 'ProjectInformation::edit_data');
	$routes->post('/project_update', 'ProjectInformation::update_data');
	$routes->post('/project_delete', 'ProjectInformation::delete_data');
	$routes->post('/project_sub_type_show_list_data', 'MasterInformation::project_sub_type_show_list_data');
	
		// broker 
	$routes->get('/brokerlist', 'Home::brokerlist');
	$routes->post('/broker_insert_data', 'ProjectInformation::insert_data');
	$routes->post('/broker_show_list_data', 'ProjectInformation::broker_show_list_data');
	$routes->post('/broker_view','ProjectInformation::view_data');
	$routes->post('/broker_edit', 'ProjectInformation::edit_data');
	$routes->post('/broker_update','ProjectInformation::update_data');
	$routes->post('/broker_delete','ProjectInformation::delete_data');

	// user 
	$routes->get('/user', 'Home::user');
	$routes->post('/user_insert_data', 'UserInformation::insert_data');
	$routes->post('/user_show_list_data', 'UserInformation::user_show_list_data');
	$routes->post('user_view','UserInformation::view_data');
	$routes->post('UserInformation_set_password','UserInformation::set_password');
	$routes->post('UserInformation_get_password','UserInformation::get_password');
	$routes->post('/user_edit','UserInformation::edit_data');
	$routes->post('/user_update','UserInformation::update_data');
	$routes->post('/user_delete','UserInformation::delete_data');
	$routes->post('UserInformation_display_data_role_user',  'UserInformation::display_data_user_role');
	$routes->post('/UserInformation_edit', 'UserInformation::edit_data');
	$routes->post('/user_role_update_data', 'UserInformation::user_role_update_data');
	$routes->post('UserInformation_add_department',  'UserInformation::user_role_to_get_departmet');
	$routes->post('/check-username-availability', 'UserInformation::check_username_availability');

	// builder 
	$routes->get('/builderlist', 'Home::builderlist');
	$routes->post('/builder_insert_data', 'ProjectInformation::insert_data');
	$routes->post('/builder_show_list_data', 'ProjectInformation::builder_show_list_data');
	$routes->post('/builder_view','ProjectInformation::view_data');
	$routes->post('/builder_edit', 'ProjectInformation::edit_data');
	$routes->post('/builder_update','ProjectInformation::update_data');
	$routes->post('/builder_delete','ProjectInformation::delete_data');

	// department 
	$routes->get('/department', 'Home::show_master_departmentlisting');
	$routes->post('/department_insertdata', 'MasterInformation::department_insertdata');
	$routes->post('department_listing', 'MasterInformation::department_list_data');
	// $routes->post('que_ans_search', 'HelpController::que_ans_search');
	$routes->post('department_edit_data', 'MasterInformation::department_edit_data');
	$routes->post('department_updatedata', 'MasterInformation::department_updatedata');
	$routes->post('department_delete', 'MasterInformation::department_delete');

	$routes->get('/brokerlist', 'Home::brokerlist');

	$routes->get('/project', 'Home::project');
	$routes->get('/investor_list', 'Home::investorlist');
	
	// inquiry
	$routes->post('/inquiry_source_list_data', 'MasterInformation::inquiry_source_show_list_data');
	$routes->post('/inquiry_source_type_show_list_data', 'MasterInformation::inquiry_source_type_show_list_data');
	$routes->post('/inquiry_source_type_show_list_data', 'MasterInformation::inquiry_source_display_all_records');
	
	/*userrole insert edit delete show*/
	$routes->post('userrole_insert_data', 'UserInformation::userrole_insert_data');
	$routes->post('userrole_list', 'UserInformation::userrole_list_tree');

	// all inquiry routes
	$routes->post('/inquiry_list_data', 'Inquiryinformation::show_list_data');
	$routes->post('/inquiry_insert_data', 'Inquiryinformation::insert_data');
	$routes->post('/all_inquiry_data', 'Inquiryinformation::show_list_allinquiry');
	$routes->post('all_inquiry_data_view','Inquiryinformation::view_data');


	///folllow up
	$routes->post('inquiry_follow_up','Followup::inquiry_call');
	
});

	


// // occupation
// $routes->get('/occupation', 'Home::occupation');
// $routes->post('/occupation_insert', 'Home::occupation_insert');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
