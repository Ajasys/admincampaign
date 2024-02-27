<?php



namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->post('convertToPdf', 'Quatation_Controller::convertToPdf');
$routes->post('GymQuatationCard', 'Quatation_Controller::GymQuatationCard');
$routes->post('leadmgtCard', 'Quatation_Controller::leadmgtCard');


// $routes->get('convertToPdf1', 'Quatation_Controller::convertToPdf');
$routes->get('/facebook_cron_job', 'FacebookCron::facebook_cron_job');
$routes->get('/signup', 'Home::signup');

$routes->get('/posts', 'Home::posts');

$routes->get('/login', 'Home::login');
$routes->post('user_login', 'Userlogin::user_login');
$routes->get('/exercises', 'Home::exercises');
$routes->post('ExerciseListData', 'ExerciseController::ExerciseListData');
$routes->post('/excercise_insert_data', 'ExerciseController::excercise_insert_data');
$routes->post('/excercise_update_data', 'ExerciseController::excercise_update_data');
$routes->get('/food', 'Home::food');
$routes->post('/food_list_data', 'MasterInformation::food_list_data');
$routes->post('/ftype_list_data', 'MasterInformation::ftype_list_data');
$routes->post('/food_master_insert_data', 'MasterInformation::food_master_insert_data');
$routes->post('/edit_data2', 'MasterInformation::edit_data2');
$routes->post('/edit_data', 'MasterInformation::edit_data');
$routes->post('food_view', 'MasterInformation::view_data2');
$routes->post('exercise_view', 'MasterInformation::view_data2');

$routes->post('ExerciseViewData', 'GymMasterController::ExerciseViewData');
$routes->post('excercise_insert_data_master', 'GymMasterController::excercise_insert_data_master');
$routes->post('excercise_update_data_master', 'GymMasterController::excercise_update_data_master');
$routes->get('/bot_setup_designer', 'Home::bot_setup_designer');

// all-diet
$routes->get('/alldiet', 'Home::alldiet');

// all-workout
$routes->get('/allworkout', 'Home::allworkout');
$routes->post('/masterworkout_list_data', 'workoutController::masterworkout_list_data');
$routes->post('/MasterworkoutView', 'workoutController::MasterworkoutView');
$routes->post('/workoutAvailable', 'workoutController::workoutAvailable');
$routes->post('/AddToMasterworkout', 'workoutController::AddToMasterworkout');
$routes->post('/MainMasterworkoutView', 'workoutController::MainMasterworkoutView');

$routes->get('/EmailConversions', 'Templates_Controller::template');
$routes->post('/template_list_data', 'Templates_Controller::template_list_data');
$routes->post('/insert_data_t', 'Templates_Controller::insert_data_t');
$routes->post('/edit_data_t', 'Templates_Controller::edit_data_t');
$routes->post('/update_data_t', 'Templates_Controller::update_data_t');
$routes->post('template_delete_data', 'Templates_Controller::template_delete_data');
$routes->get('email_history', 'Home::email_fetch');
$routes->get('email_track', 'Home::email_track');
$routes->post('show_data_email', 'Templates_Controller::show_data_email');
$routes->get('email_history_show', 'Home::email_history_show');
$routes->post('fetch_email_track_data', 'Templates_Controller::fetch_email_track_data');
$routes->post('/allinqsmssend', 'Templates_Controller::allinq_sms_send');
$routes->post('/bulkwhatsapp_template_sent', 'Templates_Controller::bulkwhatsapp_template_sent');
$routes->get('email_connection', 'Home::email_connection');
$routes->post('check_email_connection', 'EmailController::check_email_connection');
$routes->get('/EmailConversions', 'Templates_Controller::template');
$routes->post('email_link_track', 'Home::email_link_track');

$routes->get('/alert_setting', 'Home::alert_setting');
$routes->post('/alert_update_data', 'Alertsetting::alert_update_data');
$routes->post('/insert_data_alert', 'Alertsetting::insert_data');

$routes->get('/add_account', 'Home::add_account');
$routes->get('/whatapp_connection', 'Home::whatapp_connection');
$routes->get('/phone_number', 'Home::phone_number');



// post and comment
$routes->get('/post_comments', 'Home::post_comments');
$routes->post('/create_insert_data', 'CreateController::create_insert_data');
$routes->post('/SendPostDataFB', 'CreateController::SendPostDataFB');
// $routes->post('/ShareOfPost', 'CreateController::ShareOfPost');

$routes->post('/list_post_pagewise', 'CreateController::list_post_pagewise');
$routes->post('/comment_replay_send', 'CreateController::comment_replay_send');
$routes->post('/delete_post', 'CreateController::delete_post');
$routes->post('/edit_post', 'CreateController::edit_post');
$routes->post('/UpdatePostDataFB', 'CreateController::UpdatePostDataFB');
$routes->post('/comment_show', 'CreateController::comment_show');
$routes->post('/mail_get', 'EmailController::mail_get');

$routes->post('/insert_data_2DB', 'MasterInformation::insert_data_2DB');
$routes->post('/update_data_2DB', 'MasterInformation::update_data_2DB');
$routes->post('/delete_all', 'MasterInformation::delete_all');
$routes->post('/delete_all_inq', 'CommonController::delete_all_inq');
$routes->post('/delete_data', 'MasterInformation::delete_data');
$routes->post('/delete_data_secound_db', 'MasterInformation::delete_data_secound_db');
$routes->post('/food_master_update_data', 'MasterInformation::food_master_update_data');
$routes->post('/login_insert_data', 'Userlogin::insert_data');
$routes->get('/checkout', 'Razorpay::index');
$routes->get('biometric_member_attendance', 'CronController::biometric_member_attendance');
$routes->post('/web_integrate', 'WebAPIController::web_integrate');
$routes->group('', ['filter' => 'authlogin'], function ($routes) {
	$routes->post('/pdf_view', 'UserInformation::pdf_view');
	$routes->get('/allinquiry', 'Home::allinquiry');
	// $routes->post('/allinquiry', 'Home::allinquiry');
	$routes->post('/inqr_show_data', 'Inquiryinformation::inqr_show_data');
	// global search
	$routes->post('global_search', 'Globalsearch::global_search');
	//notification 
	$routes->post('Inquriry_time_come', 'Globalsearch::Inquriry_time_come');
	$routes->get('/', 'Home::index');
	$routes->get('/competitormasters', 'Home::competitormasters');
	$routes->get('/peoplelist', 'Home::peoplelist');
	// booking 
	$routes->post('/check_username_availabilitys', 'Booking::check_username_availabilitys');
	// $routes->post('/booking_insert', 'Booking::Booking_insert');
	$routes->post('/subscribtion_inserttt', 'Booking::subscribtion_inserttt');
	$routes->get('/todayfollowup', 'Home::todayfollowup');
	$routes->get('/inquiry_report', 'Home::inquiry_report');
	$routes->get('/site_visit', 'Home::site_visit');
	$routes->get('/site_report', 'Home::site_report');
	$routes->get('/performance_report', 'Home::performance_report');
	$routes->get('/lead_module', 'Home::lead_module');

	$routes->get('/attendance', 'Home::attendance');
	$routes->post('/attandance_showdata', 'AttendanceController::attandance_showdata');
	$routes->post('/attandance_update_data', 'AttendanceController::update_data');
	$routes->post('/attandance_insert_data', 'AttendanceController::insert_data');
	$routes->post('/get_data_attandance', 'AttendanceController::get_data_attandance');
	$routes->post('/check_user_biometric_data', 'AttendanceController::check_user_biometric_data');

	$routes->get('/web_settings', 'Home::web_settings');
	$routes->post('/general_setting_verify_connection', 'CronController::general_setting_verify_connection');
	$routes->post('/biometric_setting_disconnect', 'CronController::biometric_setting_disconnect');

	$routes->get('/subscriptions', 'Home::subscriptions');
	$routes->get('/subscription_master', 'Home::subscription_master');
	$routes->get('/payment_method', 'Home::payment_method');
	$routes->get('/configuration', 'Home::configuration');
	$routes->get('/manage_audience', 'Home::manage_audience');
	$routes->get('/integration', 'Home::integration');

	$routes->get('/alert_sms', 'Home::alert_sms');
	$routes->get('/emailsend', 'Home::emailsend');
	$routes->post('/emailsend', 'Home::emailsend');
	$routes->get('/alert_whatsapp', 'Home::alert_whatsapp');
	$routes->get('/alert_image', 'Home::alert_image');
	$routes->get('/invoice', 'Home::invoice');
	$routes->get('/sales_register', 'Home::sales_register');
	$routes->get('/supportticket', 'Home::supportticket');
	$routes->get('/pendingfollow', 'Home::pendingfollow');
	$routes->get('/country_list', 'Home::country_list');
	$routes->get('/project_type', 'Home::project_type');
	$routes->get('/managermasterinquiry', 'Home::managermasterinquiry');
	$routes->get('/customer', 'Home::customer');
	$routes->get('/manageinquirystatus', 'Home::manageinquirystatus');
	$routes->get('/project_sub_type', 'Home::projectsubtype');
	$routes->get('/user-admin-role', 'Home::user_admin_role');
	$routes->get('/manage-inquiry-source', 'Home::manage_inquiry_source');
	$routes->get('/inquiry-source-type', 'Home::inquiry_source_type');
	$routes->get('/user-activity', 'Home::user_activity');
	$routes->get('/statelist', 'Home::statelist');
	$routes->get('/citylist', 'Home::citylist');
	$routes->get('/manage_inquiry_close', 'Home::manage_inquiry_close');
	$routes->get('/area_location', 'Home::area_location');
	$routes->get('/surname', 'Home::surname');
	$routes->get('/sub_caste', 'Home::sub_caste');
	$routes->get('/addnew_user', 'Home::addnew_user');
	$routes->get('/voucher_type', 'Home::voucher_type');
	$routes->get('/account-group', 'Home::accountgroup');
	$routes->get('/all-voucher', 'Home::allvoucher');
	$routes->get('competitor_analysis', 'Home::competitor_analysis');
	$routes->get('project_details', 'Home::projectdetails');
	$routes->get('que_ans', 'Home::que_ans');
	$routes->get('pdf', 'UserInformation::pdf');

	// bot
	$routes->get('bot_messenger', 'Bot_controller::bot_messenger');


	// food
	$routes->post('/food_list_data_new', 'MasterInformation::food_list_data_new');
	$routes->post('/MasterFoodInsertData', 'MasterInformation::MasterFoodInsertData');
	$routes->post('/MasterFoodUpdateData', 'MasterInformation::MasterFoodUpdateData');
	$routes->post('/MasterFoodUpdateDataMain', 'MasterInformation::MasterFoodUpdateDataMain');
	$routes->post('/DietRequestList', 'DietController::DietRequestList');
	$routes->post('/MasterDietView', 'DietController::MasterDietView');
	$routes->post('/DietAvailable', 'DietController::DietAvailable');
	$routes->post('/AddToMasterDiet', 'DietController::AddToMasterDiet');
	$routes->post('/MainMasterDietView', 'DietController::MainMasterDietView');



	$routes->post('/Food_delete_data', 'MasterInformation::Food_delete_data');
	$routes->post('/food_list_request', 'MasterInformation::food_list_request');
	$routes->post('/Food_request_approve', 'MasterInformation::Food_request_approve');
	$routes->post('/master_food_update', 'MasterInformation::master_food_update');
	$routes->post('/master_food_update_insert', 'MasterInformation::master_food_update_insert');
	$routes->post('/requestFoodUpdateData', 'MasterInformation::requestFoodUpdateData');
	$routes->post('/master_foodtype_update', 'MasterInformation::master_foodtype_update');
	$routes->post('/master_foodtype_update_insert', 'MasterInformation::master_foodtype_update_insert');
	$routes->post('/Foodtype_delete_data', 'MasterInformation::Foodtype_delete_data');
	$routes->post('/master_exercisesubtype_update_insert', 'MasterInformation::master_exercisesubtype_update_insert');
	$routes->post('show_task_comments', 'MasterInformation::show_task_comments');
	// exrecise




	$routes->post('/ExerciseRequestListData', 'ExerciseController::ExerciseRequestListData');
	$routes->post('/master_exercise_update', 'ExerciseController::master_exercise_update');
	$routes->post('/master_exercise_update_insert', 'ExerciseController::master_exercise_update_insert');
	$routes->post('/exercise_delete_data', 'ExerciseController::exercise_delete_data');
	$routes->post('/excercise_insert_data1', 'ExerciseController::excercise_insert_data1');
	$routes->post('/exercisetype_delete_data', 'MasterInformation::exercisetype_delete_data');

	$routes->post('/subtypetype_delete_data', 'MasterInformation::subtypetype_delete_data');
	$routes->post('/master_exercisetype_update_insert', 'MasterInformation::master_exercisetype_update_insert');


	// data module
	$routes->get('data_module', 'Home::data_module');
	$routes->get('add_data_module', 'Home::add_data_module');
	$routes->get('livesearch', 'DatamoduleController::livesearch');
	$routes->post('get_data_header_by_file', 'DatamoduleController::get_data_header_by_file');
	$routes->post('fillter_list', 'DatamoduleController::fillter_list');
	$routes->post('import_file_data', 'DatamoduleController::import_file_data');
	$routes->post('data_module_list_data', 'DatamoduleController::data_module_list_data');


	//audiance module
	$routes->post('/audience_list_data', 'AudianceController::audience_list_data');
	$routes->post('/audience_view_data', 'AudianceController::audience_view_data');
	$routes->post('/audience_show_data', 'AudianceController::audience_show_data');
	$routes->post('audience_inquiry_data_view', 'AudianceController::view_data_audience');
	$routes->post('audience_insert_data', 'AudianceController::audience_insert_data');
	$routes->post('get_data_header_by_file_audience', 'AudianceController::get_data_header_by_file_audience');
	$routes->post('import_file_data_audience', 'AudianceController::import_file_data_audience');
	$routes->post('audience_facebook_data', 'AudianceController::audience_facebook_data');
	$routes->post('audience_view_data_facebook', 'AudianceController::audience_view_data_facebook');
	$routes->post('view_integrate_lead_audience', 'AudianceController::view_integrate_lead_audience');

	$routes->post('edit_data_audience', 'AudianceController::edit_data_audience');
	$routes->post('update_data_audience', 'AudianceController::update_data_audience');
    $routes->post('audio_file', 'AudianceController::audio_file');



	// subscribtion master 
	$routes->post('/subscription_master_insert', 'MasterInformation::insert_data');
	$routes->post('/master_subscribtion_list', 'MasterInformation::subscription_list');
	$routes->post('/master_subscribtion_view', 'MasterInformation::view_data');
	$routes->post('/master_subscribtion_edit', 'MasterInformation::edit_data');
	$routes->post('/master_subscribtion_update', 'MasterInformation::update_data');
	$routes->post('/master_subscribtion_delete', 'MasterInformation::delete_data');
	$routes->get('account_dashboard', 'Home::account_dashboard');
	$routes->get('payment_m_master', 'Home::payment_m_master');
	$routes->get('payment_receivable', 'Home::payment_receivable');
	// account
	$routes->post('voucher_type_list_data', 'Account::voucher_type_list_data');
	$routes->post('group_type_list_data', 'Account::group_type_list_data');
	$routes->post('group_insert_data', 'Account::group_insert_data');
	$routes->post('group_edit_data', 'Account::group_edit_data');
	// on checkbox delete 
	// $routes->post('delete_all', 'CommonController::delete_all');
	// occupation
	$routes->get('/occupation', 'Home::occupation');
	$routes->post('/insert_data', 'MasterInformation::insert_data');
	$routes->post('/MasterInformation_Occupationlisting', 'MasterInformation::show_list_data');
	$routes->post('/MasterInformation_listing', 'MasterInformation::show_list_data');
	$routes->post('/MasterInformation_edit', 'MasterInformation::edit_data');
	$routes->post('/MasterInformation_update', 'MasterInformation::update_data');
	$routes->post('/MasterInformation_delete', 'MasterInformation::delete_data');

	$routes->post('/getCountryData', 'MasterInformation::get_country_data');
	$routes->post('/getStatesData', 'MasterInformation::getStatesData');
	$routes->post('/getCitiesData', 'MasterInformation::getCitiesData');

	//task_status
	$routes->get('/task', 'Home::task');
	$routes->post('/task_status_list_data', 'status::task_status_list_data');
	// $routes->post('new_status_list_data', 'MasterInformation::new_status_list_data');
	$routes->post('task_insert_data', 'MasterInformation::task_insert_data');
	$routes->post('email_edit_data', 'MasterInformation::email_edit_data');
	$routes->post('tasks_update_data', 'MasterInformation::tasks_update_data');
	$routes->post('task_template_list_data', 'MasterInformation::task_template_list_data');
	$routes->post('new_status_list_data', 'MasterInformation::new_status_list_data');
	$routes->post('task_status_update_data', 'MasterInformation::task_status_update_data');
	// $routes->post('task_insert_data', 'MasterInformation::task_insert_data');

	// project status
	$routes->get('/project_status', 'Home::projectstatus');
	$routes->post('/MasterInformation_project_statuslisting', 'MasterInformation::project_status_show_list_data');
	// profile
	$routes->get('profile', 'Home::profile');
	$routes->post('UserInformation_password_check', 'UserInformation::password_check');
	$routes->post('profile_view_data', 'UserInformation::profile_view_data');
	$routes->post('UserInformation_password_update', 'UserInformation::password_update');
	// project type
	$routes->get('/project_type', 'Home::projecttype');
	$routes->post('/MasterInformation_project_typelisting', 'MasterInformation::MasterInformation_project_typelisting');
	$routes->post('/MasterInformation_project_status', 'MasterInformation::MasterInformation_project_status');
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
	$routes->post('/broker_view', 'ProjectInformation::view_data');
	$routes->post('/broker_edit', 'ProjectInformation::edit_data');
	$routes->post('/broker_update', 'ProjectInformation::update_data');
	$routes->post('/broker_delete', 'ProjectInformation::delete_data');
	// investor 
	$routes->post('/investor_insert_data', 'ProjectInformation::insert_data');
	$routes->post('/investor_show_list_data', 'ProjectInformation::investor_show_list_data');
	$routes->post('/investor_view', 'ProjectInformation::view_data');
	$routes->post('/investor_edit', 'ProjectInformation::edit_data');
	$routes->post('/investor_update', 'ProjectInformation::update_data');
	$routes->post('/investor_delete', 'ProjectInformation::delete_data');
	// user 
	$routes->get('/user', 'Home::user');
	$routes->post('/user_insert_data', 'UserInformation::insert_data');
	$routes->post('/product_data', 'UserInformation::product_data');
	$routes->post('/user_show_list_data', 'UserInformation::user_show_list_data');
	$routes->post('/user_view', 'UserInformation::view_data');
	$routes->post('/UserInformation_set_password', 'UserInformation::set_password');
	$routes->post('/UserInformation_get_password', 'UserInformation::get_password');
	$routes->post('/user_edit', 'UserInformation::edit_data');
	$routes->post('/user_update', 'UserInformation::update_data');
	$routes->post('/user_delete', 'UserInformation::delete_data');
	$routes->post('/UserInformation_display_data_role_user', 'UserInformation::display_data_user_role');
	$routes->post('/UserInformation_edit', 'UserInformation::edit_data');
	$routes->post('/user_role_update_data', 'UserInformation::user_role_update_data');
	$routes->post('UserInformation_add_department', 'UserInformation::user_role_to_get_departmet');
	$routes->post('/check-username-availability', 'UserInformation::check_username_availability');
	$routes->get('/subscription', 'Home::user_demo');
	$routes->post('/user_data', 'UserInformation::demo_user_show_data');
	$routes->post('/user_data_view', 'UserInformation::view_data_user');
	$routes->post('/subscription_edit', 'UserInformation::edit_data_subscribtion');
	$routes->post('/subscription_update', 'UserInformation::update_data_subscribtion');
	$routes->post('/subscribtion_set_password', 'UserInformation::set_password2');
	$routes->post('/subscribtion_get_password', 'UserInformation::get_password2');
	$routes->post('/userdemo_delete', 'UserInformation::delete_datas');
	$routes->post('task_delete_data', 'MasterInformation::task_delete_data');
	$routes->post('Dashboard_get_lead_statistics_data', 'DashboardController::Dashboard_get_lead_statistics_data');
	$routes->post('Dashboard_get_all_status_data', 'DashboardController::Dashboard_get_all_status_data');
	$routes->post('Dashboard_get_lead_quality_report', 'DashboardController::Dashboard_get_lead_quality_report');
	$routes->post('/master_coupon_edit', 'MasterInformation::edit_data_coupan');
	//signup
	$routes->get('/signuplist', 'Home::sign_up');
	$routes->post('/signup_data', 'UserInformation::signup_data');
	//Discount
	$routes->get('/coupon', 'Home::discount');
	$routes->post('/generate_couponname', 'UserInformation::generate_couponname');
	$routes->post('/coupon_master_insert', 'UserInformation::coupon_master_insert');
	$routes->post('/master_coupon_list', 'UserInformation::coupon_list');
	$routes->post('/master_coupon_view', 'MasterInformation::view_data');
	$routes->post('/master_coupon_edit', 'MasterInformation::edit_data');
	$routes->post('/master_coupon_update', 'UserInformation::master_coupon_update');
	// builder 
	$routes->get('/builderlist', 'Home::builderlist');
	$routes->post('/builder_insert_data', 'ProjectInformation::insert_data');
	$routes->post('/builder_show_list_data', 'ProjectInformation::builder_show_list_data');
	$routes->post('/builder_view', 'ProjectInformation::view_data');
	$routes->post('/builder_edit', 'ProjectInformation::edit_data');
	$routes->post('/builder_update', 'ProjectInformation::update_data');
	$routes->post('/builder_delete', 'ProjectInformation::delete_data');
	// department 
	$routes->get('/department', 'Home::show_master_departmentlisting');
	$routes->post('/department_insertdata', 'MasterInformation::department_insertdata');
	$routes->post('department_listing', 'MasterInformation::show_list_data');
	$routes->post('department_edit_data', 'MasterInformation::department_edit_data');
	$routes->post('department_updatedata', 'MasterInformation::department_updatedata');
	$routes->post('department_delete', 'MasterInformation::department_delete');
	$routes->get('/brokerlist', 'Home::brokerlist');
	$routes->get('/project', 'Home::project');
	$routes->get('/investor_list', 'Home::investorlist');
	// property
	$routes->get('/property', 'Home::property');
	$routes->post('/property_insert_data', 'MasterInformation::property_insert_data');
	$routes->post('/property_listing', 'MasterInformation::property_list_data');
	$routes->post('/property_view', 'MasterInformation::property_view_data');
	$routes->post('/property_edit', 'MasterInformation::property_edit_data');
	$routes->post('/property_update', 'MasterInformation::property_update_data');
	$routes->post('/property_delete', 'MasterInformation::property_delete_data');
	// inquiry
	$routes->post('/inquiry_source_list_data', 'MasterInformation::inquiry_source_show_list_data');
	$routes->post('/inquiry_source_type_show_list_data', 'MasterInformation::inquiry_source_type_show_list_data');
	$routes->post('/inquiry_source_type_show_list_data', 'MasterInformation::inquiry_source_display_all_records');
	/*userrole insert edit delete show*/
	$routes->post('userrole_insert_data', 'UserInformation::userrole_insert_data');
	$routes->post('userrole_list', 'UserInformation::userrole_list_tree');
	$routes->post('userrole_delete_waring', 'UserInformation::userrole_delete_waring');
	$routes->post('userrole_delete_data', 'UserInformation::userrole_delete_data');
	// all inquiry routes
	$routes->post('/inquiry_list_data', 'Inquiryinformation::show_list_data');
	$routes->post('/inquiry_insert_data', 'Inquiryinformation::insert_data');
	$routes->post('/all_inquiry_data', 'Inquiryinformation::show_list_allinquiry');
	$routes->post('all_inquiry_data_view', 'Inquiryinformation::view_data');
	$routes->post('/inquiry_list_data_edit', 'Inquiryinformation::edit_data');
	$routes->post('/inquiry_list_updatedata', 'Inquiryinformation::update_data');
	$routes->post('/inquiry_list_deletedata', 'Inquiryinformation::delete_data');
	$routes->post('/inquiry_list_editallinquiry', 'Inquiryinformation::edit_data');
	$routes->post('/card_inquiry_list_data', 'Inquiryinformation::card_inquiry_list_data');
	$routes->post('inquiry_log_show', 'Inquiryinformation::inquiry_log_show');
	$routes->post('inquiry_update_form', 'Inquiryinformation::visit_update_data');
	$routes->post('inquiry_change_value', 'Inquiryinformation::change_value');
	$routes->post('/inquiryfollowup_update', 'Inquiryinformation::update_data');
	$routes->post('follow_inquiry_update_status', 'Inquiryinformation::inquiry_update_status');
	$routes->post('inquiry_log_show', 'Inquiryinformation::inquiry_log_show');
	$routes->post('Inquirymanagement_project_to_get_unit', 'Inquiryinformation::project_to_get_unit');
	$routes->post('Inquirymanagement_assign_bulk', 'Followup::people_assign_bulk');
	$routes->post('Booking_project_dropdown_using_subtype', 'Booking::project_dropdown_list_using_subtype');
	$routes->post('Booking_projectID_and_unitNo_to_get_Data', 'Booking::projectID_and_unitNo_to_get_Data');
	///folllow up
	// $routes->post('inquiry_follow_up','Followup::inquiry_call');
	// $routes->post('Inquirymanagement_inquiry_update_status','Followup::inquiry_update_status');
	$routes->post('inquiry_follow_up', 'Followup::inquiry_call');
	$routes->post('product_wise_plan', 'Followup::product_wise_plan');
	$routes->post('Inquirymanagement_inquiry_update_status', 'Followup::inquiry_update_status');
	$routes->get('/logout', 'Userlogin::logout');
	// people list 
	$routes->post('/people_list', 'UserInformation::people_list');
	// visit_reg 
	$routes->post('/visit_reg_list_data', 'RegisterController::visit_reg_list_data');
	$routes->post('/revisit_reg_list_data', 'RegisterController::revisit_reg_list_data');
	// booking
	$routes->post('Booking_project_to_get_unit', 'Booking::project_to_get_unit');
	$routes->get('conversion_register', 'Home::conversion');
	$routes->post('Booking_insert', 'Booking::Booking_insert');
	$routes->post('booking_list_data', 'Booking::list_data');
	$routes->post('booking_view', 'Booking::booking_view_data');
	$routes->post('booking_edit', 'Booking::booking_edit');
	$routes->post('booking_update', 'Booking::booking_update');
	$routes->post('booking_cancle', 'Booking::booking_cancle');
	// close request 
	$routes->post('approved_dismiseed_inquiry', 'Followup::approved_dismiseed_inquiry');
	$routes->post('decline_dismissed_inquiry', 'Followup::decline_dismissed_inquiry');
	// close conversion
	// $routes->get('subscription_request','Home::close_conversion');
	// dashboard 

	$routes->post('Dashboard_dismiss_inq_report', 'DashboardController::Dashboard_dismiss_inq_report');
	$routes->post('get_data_followup_tab_fresh', 'DashboardController::get_followup_tab_fresh');
	$routes->post('get_data_activity_tab_fresh', 'DashboardController::get_activity_tab_fresh');
	$routes->post('Dashboard_date_wise_data', 'DashboardController::month_year_date_wise_data');
	$routes->post('demo_list_data', 'DashboardController::demo_list_data');

	$routes->post('Dashboard_get_user_wise_pendingdata', 'DashboardController::Dashboard_get_user_wise_pendingdata');
	$routes->post('/Performance_task', 'DashboardController::Performance_task');
	$routes->post('Front_today_task', 'Globalsearch::today_task');
	//filtetdata
	$routes->post('filter_data', 'FilterController::filter_data');
	$routes->get('filter_data', 'FilterController::filter_data');
	//filtetpdf
	$routes->post('gym_pdf', 'FilterController::gym_pdf');
	// $routes->get('filter_data', 'FilterController::filter_data');
	//report 
	$routes->post('inq_user_wise_report', 'ReportController::inq_user_wise_report');
	$routes->post('inq_site_report', 'ReportController::inq_site_report');
	$routes->post('updatedata_approve', 'UserInformation::updatedata_approve');
	$routes->post('updatedata_suspend', 'UserInformation::updatedata_suspend');
	$routes->get('/demo_register', 'Home::site_visit');
	// subscription
	// subscription no controller code booking controle ma che
	$routes->post('Booking_project_to_get_unit', 'Booking::project_to_get_unit');
	$routes->get('subscription_register', 'Home::conversion');
	// $routes->post('Booking_insert', 'Booking::Booking_insert');
	$routes->post('booking_list_data', 'Booking::list_data');
	$routes->post('booking_view', 'Booking::booking_view_data');
	$routes->post('booking_edit', 'Booking::booking_edit');
	$routes->post('booking_update', 'Booking::booking_update');
	$routes->post('booking_cancle', 'Booking::booking_cancle');
	// subscription request 
	$routes->get('subscription_request', 'Home::conversion_request');
	$routes->post('approve_conversion', 'Booking::approve_conversion');
	$routes->post('update_conversion_request', 'Booking::update_conversion_request');
	$routes->post('decline_conversion', 'Booking::decline_conversion');
	// clint_support
	$routes->post('clint_list_data', 'clint_support_controller::clint_list_data');
	$routes->post('support_chat_list_data_admin', 'clint_support_controller::support_chat_list_data_admin');
	$routes->post('send_message_data_conversion', 'clint_support_controller::send_message_data_conversion');
	$routes->post('searchbar_url', 'clint_support_controller::searchbar_url');
	$routes->post('update_ticket_status', 'clint_support_controller::update_ticket_status');
	$routes->get('/whatsapp', 'Home::whatapp');

	$routes->post('bot_preview_data', 'Bot_Controller::bot_preview_data');
	$routes->post('insert_chat_answer', 'Bot_Controller::insert_chat_answer');
	$routes->post('chat_list', 'Bot_Controller::chat_list');

	//bot setup
	$routes->get('/messenger_bot', 'Home::messenger_bot');
	$routes->get('/bot', 'Home::bot');
	$routes->get('/messenger', 'Home::messenger');
	$routes->get('/bot_setup', 'Home::bot_setup');
	$routes->get('/bot_setup_designer', 'Home::bot_setup_designer');
	$routes->post('/bot_update', 'Bot_Controller::bot_update');
	$routes->post('/main_bot_list_data', 'Bot_Controller::main_bot_list_data');
	$routes->post('/messenging_bot_insert_data', 'Bot_Controller::messenging_bot_insert_data');
	$routes->post('/messeging_bot_list', 'Bot_Controller::messeging_bot_list');
	$routes->post('/update_data_conversion', 'Bot_Controller::update_data_conversion');
	$routes->post('messeging_bot_list_data', 'Bot_Controller::messeging_bot_list_data');

	$routes->post('bot_insert_data', 'Bot_Controller::bot_insert_data');
	$routes->post('bot_list_data', 'Bot_Controller::bot_list_data');
	$routes->post('duplicate_Question', 'Bot_Controller::duplicate_Question');
	$routes->post('bot_delete_data', 'Bot_Controller::bot_delete_data');
	$routes->post('bot_question_delete_data', 'Bot_Controller::bot_question_delete_data');
	$routes->post('update_sequence', 'Bot_Controller::update_sequence');
	$routes->post('bot_question_edit_data', 'Bot_Controller::bot_question_edit_data');
	$routes->post('/bot_question_update', 'Bot_Controller::bot_question_update');
	$routes->post('bot_id_to_quotation', 'Bot_Controller::bot_id_to_quotation');

	$routes->get('/bot_installer', 'Home::bot_installer');
	$routes->post('bot_preview', 'Bot_Controller::bot_preview');
	$routes->post('', 'Bot_Controller::get_chat_data');
	$routes->post('bot_preview_data', 'Bot_Controller::bot_preview_data');
	$routes->post('insert_chat_answer', 'Bot_Controller::insert_chat_answer');

	// massager code routes 
	$routes->post('get_chat_data', 'Bot_Controller::get_chat_data');
	$routes->post('send_chat', 'Bot_Controller::send_chat');
	$routes->post('send_massage', 'Bot_Controller::send_massage');
	$routes->post('delete_record', 'Bot_Controller::delete_record');
	//new facebook

	//facebook 
	$routes->get('/newlead_module', 'Home::newlead_module');
	$routes->post('/new_facebook_user', 'NewFaceBookController::facebook_user');
	$routes->post('/new_facebook_page', 'NewFaceBookController::facebook_page');
	$routes->post('/new_pages_list_data', 'NewFaceBookController::pages_list_data');
	$routes->post('/new_deleted_pages_list_data', 'NewFaceBookController::deleted_pages_list_data');
	$routes->post('/new_updated_pages_list_data', 'NewFaceBookController::updated_pages_list_data');
	$routes->post('/new_draft_pages_list_data', 'NewFaceBookController::draft_pages_list_data');
	$routes->post('/new_delete_pages_fb', 'NewFaceBookController::delete_pages_fb');
	$routes->post('/new_facebook_form', 'NewFaceBookController::facebook_form');
	$routes->post('/new_queue_list_add', 'NewFaceBookController::queue_list_add');
	$routes->post('/lead_list', 'NewFaceBookController::lead_list');

	// =====facebook-connection======
	$routes->get('/facebook_connection', 'Home::facebook_connection');
	$routes->post('/check_fb_connection', 'FacebookController::check_fb_connection');
	$routes->post('/facebook_user', 'FacebookController::facebook_user');
	$routes->post('/facebook_page', 'FacebookController::facebook_page');
	$routes->post('/pages_list_data', 'FacebookController::pages_list_data');
	$routes->post('/deleted_pages_list_data', 'FacebookController::deleted_pages_list_data');
	$routes->post('/updated_pages_list_data', 'FacebookController::updated_pages_list_data');
	$routes->post('/draft_pages_list_data', 'FacebookController::draft_pages_list_data');
	$routes->post('/delete_pages_fb', 'FacebookController::delete_pages_fb');
	$routes->post('/facebook_form', 'FacebookController::facebook_form');
	$routes->post('/queue_list_add', 'FacebookController::queue_list_add');
	$routes->get('/leadlist', 'Home::leadlist');
	$routes->post('/lead_list', 'FacebookController::lead_list');
	$routes->post('/fb_connection_list', 'FacebookController::fb_connection_list');
	$routes->post('/fb_permission_list', 'FacebookController::fb_permission_list');
	$routes->post('/edit_facebook_scenarious', 'FacebookController::edit_facebook_scenarious');
	$routes->post('/delete_fb_connection', 'FacebookController::delete_fb_connection');
	$routes->post('/view_integrate_lead', 'FacebookController::view_integrate_lead');
	
	//website connection
	$routes->get('/website_connection', 'Home::website_connection');
	$routes->post('/add_website_connection', 'WebController::add_website_connection');
	$routes->post('/website_connection_list', 'WebController::website_connection_list');
	$routes->post('/delete_website_connection', 'WebController::delete_website_connection');
	$routes->post('/website_connectionpage', 'WebController::website_connectionpage');

	//linkedin integration
	$routes->get('/linkedin_connection', 'Home::linkedin_connection');
	

	// whatsapp integration 
	$routes->post('/whatsapp_template_insert', 'WhatAppIntegrationController::whatsapp_template_insert');
	$routes->post('/whatsapp_bot_id_update', 'WhatAppIntegrationController::whatsapp_bot_id_update');
	$routes->post('/wa_connextion_edit_data', 'WhatAppIntegrationController::wa_connextion_edit_data');
	$routes->post('/master_whatsapp_list_data', 'WhatAppIntegrationController::master_whatsapp_list_data');
	$routes->post('/whatsapp_template_delete_data', 'WhatAppIntegrationController::whatsapp_template_delete_data');
	$routes->post('/whatsappView', 'WhatAppIntegrationController::whatsappView');
	$routes->post('/whatsapptemplate_edit_data', 'WhatAppIntegrationController::whatsapptemplate_edit_data');
	$routes->post('/WhatAppConnectionCheck', 'WhatAppIntegrationController::WhatAppConnectionCheck');
	$routes->post('/SubmitWhatAppIntegrationResponse', 'WhatAppIntegrationController::SubmitWhatAppIntegrationResponse');
	$routes->post('/GetWhatAppIntegrationInformation', 'WhatAppIntegrationController::GetWhatAppIntegrationInformation');
	$routes->post('/GetWhatAppTemplateList', 'WhatAppIntegrationController::GetWhatAppTemplateList');
	$routes->post('/CheckWhataAppConnection', 'WhatAppIntegrationController::CheckWhataAppConnection');
	$routes->post('/WhatsAppRTemplateDeleteRequest', 'WhatAppIntegrationController::WhatsAppRTemplateDeleteRequest');
	$routes->post('/single_whatsapp_template_sent', 'WhatAppIntegrationController::single_whatsapp_template_sent');
	$routes->post('/SendMessagesHistory', 'WhatAppIntegrationController::SendMessagesHistory');

	$routes->post('/SendWhatsAppTemplate', 'WhatAppIntegrationController::SendWhatsAppTemplate');
	$routes->post('/WhatappFileUpload', 'WhatAppIntegrationController::WhatappFileUpload');
	$routes->post('/GetWhatsAppTemplateDetails', 'WhatAppIntegrationController::GetWhatsAppTemplateDetails');
	$routes->post('/WhatsAppConnectionsList', 'WhatAppIntegrationController::WhatsAppConnectionsList');
	$routes->post('/WhatsAppAccountsContactList', 'WhatAppIntegrationController::WhatsAppAccountsContactList');
	$routes->post('/WhatsAppListConverstion', 'WhatAppIntegrationController::WhatsAppListConverstion');
	$routes->post('/SendWhatsAppChatMessage', 'WhatAppIntegrationController::SendWhatsAppChatMessage');
	$routes->post('/Bracket_whatsapp_insert_data', 'WhatAppIntegrationController::Bracket_whatsapp_insert_data');
	$routes->post('/WhatsAppSendDocumentData', 'WhatAppIntegrationController::WhatsAppSendDocumentData');
    $routes->post('/WhatsAppInsertData', 'WhatAppIntegrationController::WhatsAppInsertData');
    $routes->post('/sendwhatsappcamera', 'WhatAppIntegrationController::sendwhatsappcamera');


	$routes->post('/SendWhatsAppContactNumber', 'WhatAppIntegrationController::SendWhatsAppContactNumber');

	// aaksh
	$routes->get('/whatappaakash', 'Home::whatappaakash');
	$routes->get('/whatsapp_connections', 'Home::whatsapp_connections');
	// $routes->post('/master_whatsapp_list_data', 'WhatAppAakashController::master_whatsapp_list_data');
	$routes->post('/WhatsAppConnectionEntry', 'WhatAppAakashController::WhatsAppConnectionEntry');

	// get live message
    $routes->post('check_new_data_Available','CommonController::check_new_data_Available');
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
