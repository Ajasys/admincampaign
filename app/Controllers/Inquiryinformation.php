<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use CodeIgniter\I18n\Time;
// use CodeIgniter\Files\File;

class Inquiryinformation extends BaseController
{
	public function __construct()
	{
		helper('custom');
		$db = db_connect();
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->username = session_username($_SESSION['username']);
		$this->admin = 0;
		$this->db = DatabaseSecondConnection();
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
		$this->timezone = timezonedata();
	}
	public function duplicate_data_check_mobile_number($table, $mobileno, $field = "")
	{
		$this->db = DatabaseDefaultConnection();
		$i = 0;
		if (!empty($field)) {
			$sql = 'SELECT * FROM ' . $table . ' WHERE ' . $field . ' =' . $mobileno;
		} else {
			$sql = 'SELECT * FROM ' . $table . ' WHERE mobileno ="' . $mobileno . '" OR altmobileno="' . $mobileno . '"';
		}
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->getNumRows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function insert_data()
	{
		$username = session_username($_SESSION['username']);
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$nxt_follow_up = $this->request->getPost("nxt_follow_up");
		$visit_date = $this->request->getPost("visit_date");
		$area = $this->request->getPost("area");
		// $purpose_buy = $this->request->getPost("purpose_buy");
		$city = $this->request->getPost("city");
		$result = array();
		$insert_area = array();
		date_default_timezone_set('Asia/Kolkata');
		$session_data = get_session_data();
		$today_date = date('Y-m-d h:i:sa');
		$full_name = $this->request->getPost("full_name");
		$dob = $this->request->getPost("dob");
		$anni_date = $this->request->getPost("anni_date");
		$mobileno = $this->request->getPost("mobileno");
		$email = $this->request->getPost("email");

		$inquirer_email = $this->request->getPost("email");

		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			unset($_POST['nxt_follow_up']);
			if (!empty($_POST)) {
				$insert_data = $_POST;
				if (isset($visit_date) && !empty($visit_date)) {
					$insert_data['visit_date'] = date('Y-m-d h:i:sa', strtotime($visit_date));
				} else {
					$insert_data['visit_date'] = $today_date;
				}
				if (isset($nxt_follow_up) && !empty($nxt_follow_up)) {
					$insert_data['nxt_follow_up'] = date('Y-m-d h:i:sa', strtotime($nxt_follow_up));
				} else {
					$insert_data['nxt_follow_up'] = $today_date;
				}
				if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
					$insert_data['user_id'] = 0;
					$insert_data['assign_id'] = 0;
					$insert_data['owner_id'] = 0;
				} else {
					$insert_data['user_id'] = $_SESSION['id'];
					$insert_data['assign_id'] = $_SESSION['id'];
					$insert_data['owner_id'] = $_SESSION['id'];
				}
				// if (isset($purpose_buy) && $purpose_buy == "Investment") {
				// 	$insert_data['user_type'] = 4;
				// } else {
				// 	$insert_data['user_type'] = 1;
				// }
				// $data_array = array('area' => $area, 'city' => $city);
				// $checkDuplicateData = $this->MasterInformationModel->checkDuplicateData2($username . "_" . $table_name);
				// if (!empty($checkDuplicateData)) {
				// 	$insert_area['area'] = $area;
				// 	$insert_area['city'] = $city;
				// 	$response = $this->MasterInformationModel->insert_entry2($insert_area, 'master_area');
				// }
				// $isduplicate = $this->duplicate_data_check_mobile_number($this->username . "_" . $table_name, $_POST['mobileno']);
				// $isduplicate = $this->duplicate_data($insert_data, $username . "_" . $table_name);
				$isduplicate = $this->duplicate_data_check_mobile_number($this->username . "_" . $table_name, $_POST['mobileno']);

				if ($isduplicate == 0) {
					$response = $this->MasterInformationModel->insert_entry2($insert_data, $username . "_" . $table_name);
					$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($username . "_" . $table_name);
					$departmentdisplaydata = json_decode($departmentdisplaydata, true);
					$result['response'] = 1;
					$result['message'] = 'Added Successfully !';

					//increment audience table insert productwise inquiry_data=2 in 
					$intrested_product = $insert_data['intrested_product']; // Storing the value in a variable
					$inquiry_datas_audience = array();
					$find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 1 AND intrested_product = $intrested_product";
					$db_connection = DatabaseDefaultConnection();
					$find_audience = $db_connection->query($find_audience);
					$all_datas_audience = $find_audience->getResultArray();
					
					// Check if there are rows returned and if is_status_active is 1
					if (!empty($all_datas_audience)&& isset($all_datas_audience[0]['intrested_product']) && $all_datas_audience[0]['intrested_product'] == $intrested_product && isset($all_datas_audience[0]['inquiry_data']) && $all_datas_audience[0]['inquiry_data'] == 2) {
						if ($result['response'] == 1) {
							$inquiry_datas_audience['inquiry_id'] = $response;
							$inquiry_datas_audience['full_name'] = $insert_data['full_name'];
							$inquiry_datas_audience['mobileno'] = $insert_data['mobileno'];
							$inquiry_datas_audience['email'] = $insert_data['email'];
							$inquiry_datas_audience['inquiry_status'] = 1;
							$inquiry_datas_audience['intrested_product'] = $insert_data['intrested_product'];
							$inquiry_datas_audience['name'] = $all_datas_audience[0]['name'];
							$inquiry_datas_audience['source'] = $all_datas_audience[0]['source'];
							$inquiry_datas_audience['inquiry_data'] = 2;
							$inquiry_datas_audience['pages_name'] = $all_datas_audience[0]['pages_name'];
							$inquiry_datas_audience['facebook_syncro'] = 0;
							$response_audience = $this->MasterInformationModel->insert_entry2($inquiry_datas_audience, $this->username . "_audience");
						}
					}
					 //live audience auto increment code inquiry_data=3 in
						$inquiry_data_live = array();
						$find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 1 AND intrested_product = $intrested_product";
						$find_audience_live = $db_connection->query($find_audience_live);
						$all_data_live = $find_audience_live->getResultArray();
						if (!empty($all_data_live) && isset($all_data_live[0]['intrested_product']) && $all_data_live[0]['intrested_product'] == $intrested_product && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
							if ($result['response'] == 1) {
							$inquiry_data_live['inquiry_id'] = $response;
							$inquiry_data_live['full_name'] = $insert_data['full_name'];
							$inquiry_data_live['mobileno'] = $insert_data['mobileno'];
							$inquiry_data_live['email'] = $insert_data['email'];
							$inquiry_data_live['inquiry_status'] = 1;
							$inquiry_data_live['intrested_product'] = $insert_data['intrested_product'];
							$inquiry_data_live['name'] = $all_data_live[0]['name'];
							$inquiry_data_live['source'] = $all_data_live[0]['source'];
							$inquiry_data_live['inquiry_data'] = 3;
							$inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
							$inquiry_data_live['facebook_syncro'] = 0;
							// Update the existing data in the audience table
							$response_audience1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
						}
					} 
					$inquiry_data = array();
					$find_alert = "SELECT * FROM " . $this->username . "_alert_setting WHERE alert_title=14";
					$db_connection = DatabaseDefaultConnection();
					$find_alert = $db_connection->query($find_alert);
					$all_data = $find_alert->getResultArray();

					if (isset($all_data[0]['is_alert']) && $all_data[0]['is_alert'] == 1) {
						if ($result['response'] == 1) {
							$inquiry_data['inquiry_id'] = $response;
							$inquiry_data['created_at'] = $today_date;
							$inquiry_data['alert_title'] = 14;
							$inquiry_data['is_sms'] = $all_data[0]['is_sms'];
							$inquiry_data['sms_template_id'] = $all_data[0]['sms_template_id'];
							$inquiry_data['is_email'] = $all_data[0]['is_email'];
							$inquiry_data['email_template_id'] = $all_data[0]['email_template_id'];
							$inquiry_data['is_whatsapp'] = $all_data[0]['is_whatsapp'];
							$inquiry_data['whatsapp_template_id'] = $all_data[0]['whatsapp_template_id'];
							$inquiry_data['created_at'] = UtcTime('Y-m-d H:i:s', $this->timezone, date('Y-m-d H:i:s'));
							// pre($inquiry_data);
							$response_alert = $this->MasterInformationModel->insert_entry2($inquiry_data, $this->username . "_notification_center");
							$notification_data = any_id_to_full_data($this->username . "_notification_center", $response_alert);
							$inquiry_dataa = any_id_to_full_data($this->username . "_all_inquiry", $notification_data['inquiry_id']);

							$sse_id = any_id_to_full_data($this->username . "_user", $inquiry_dataa['assign_id']);

							// $dataaaa = notification_center('', $response_alert, $inquiry_dataa['mobileno'], $inquiry_dataa['email'], $sse_id['firstname'], $sse_id['phone']);
							//SEND EMAIL ALERT  
							$var_message = "";
							if ($notification_data['is_email'] != 0 && $notification_data['email_template_id'] != 0) {
								$subject_get = any_id_to_full_data($this->username . "_emailtemplate", $notification_data['email_template_id']);
								$subject = $subject_get['title'];
								$attachment = $subject_get['attachment'];
								$var_message = $subject_get['template'];
							}


							$var_message = str_replace("{{Enquirer Full Name}}", $full_name, $var_message);
							$var_message = str_replace("{{Enquirer Mobile Number}}", $mobileno, $var_message);
							$var_message = str_replace("{{Enquirer Date of Birth}}", $dob, $var_message);
							$var_message = str_replace("{{Enquirer Anniversary Date}}", $anni_date, $var_message);
							$var_message = str_replace("{{Enquirer Email}}", $email, $var_message);

							$test =  html_entity_decode($var_message);

							// $first_db = DatabaseSecondConnection();
							// $generalSetting = $first_db->table('master_general_settings')->get()->getRow();
							$queru = "SELECT * FROM admin_email_data";
							$result = $db_connection->query($queru);
							$followup_data = $result->getResultArray();

							if ($notification_data['is_email'] != 0 && $notification_data['email_template_id'] != 0) {
								$mail_send = SendMail($email, $subject, $var_message, $attachment, '');
							}




							// $data = sendSms("",$response_alert,$inquiry_dataa['mobileno'],$notification_data['sms_template_id'],$sse_id['firstname'],$sse_id['phone']);
						}
					}
				} else {
					$find_Array = array(
						'mobileno' => $_POST['mobileno'],
						'inquiry_status' => '7'
					);
					$find_Array_12 = array(
						'mobileno' => $_POST['mobileno'],
						'inquiry_status' => '12'
					);
					$find_Array_all = "SELECT * FROM " . $this->username . "_" . $table_name . " where mobileno='" . $_POST['mobileno'] . "' OR altmobileno='" . $_POST['mobileno'] . "'";
					$find_Array_all = $this->db->query($find_Array_all);
					$isduplicate_all_data = $find_Array_all->getResultArray();
					$satusus_id = array('1', '2', '3', '4', '5', '6', '9', '10', '11', '13');
					$repo = 0;
					if (!empty($isduplicate_all_data)) {
						foreach ($isduplicate_all_data as $key => $value) {
							if (in_array($value['inquiry_status'], $satusus_id)) {
								$repo = 1;
							}
						}
					}
					if ($repo == 0) {
						$inquiry_log_data = array();
						$response = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . "_" . $table_name);
						if ($response) {
							$inquiry_log_data['inquiry_id'] = $response;
							$userfullname = '';
							if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
								$inquiry_log_data['user_id'] = 0;
								if (isset($session_data['name']) && !empty($session_data['name'])) {
									$userfullname = $session_data['name'];
								}
							} else {
								$inquiry_log_data['user_id'] = $session_data['id'];
								if (isset($session_data['firstname']) && !empty($session_data['firstname'])) {
									$userfullname = $session_data['firstname'];
								}
							}
							$inquiry_log_data['inquiry_id'] = $response;
							$inquiry_log_data['status_id'] = 1;
							$log_content = 'Inquiry Created By ' . $userfullname;
							$inquiry_log_data['inquiry_log'] = $log_content;
							$response_log = $this->MasterInformationModel->insert_entry2($inquiry_log_data, $this->username . "_inquiry_log");
							$result['response'] = 1;
							$result['message'] = 'inquiry added succesfully !';
						} else {
							$result['response'] = 0;
							$result['message'] = 'Something Went Wrong !';
						}
					} else {
						$result['response'] = 0;
						$result['message'] = 'already created !';
					}
				}
			}
			return json_encode($result);
		}
		if ($this->request->getPost("action") == "import") {
			ini_set('memory_limit', '2048M');
			$area = "";
			$city = "";
			if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
				$insert_data['user_id'] = 1;
			} else {
				$insert_data['user_id'] = $_SESSION['id'];
			}
			$csv_data = 0;
			$reopen_data = 0;
			$import_data = 0;
			$duplicate_dat_store = array();
			if (isset($_FILES['import_file'])) {
				$extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);
				if (!empty($_FILES['import_file']['name']) && $extension == 'csv') {
					$totalInserted = 0;
					$csvFile = fopen($_FILES['import_file']['tmp_name'], 'r');
					fgetcsv($csvFile); // Skipping header row
					$csv_data = 0;
					$reopen_data = 0;
					$import_data = 0;
					$duplicate_dat_store = array();
					while (($csvData = fgetcsv($csvFile)) !== FALSE) {
						$csvData = array_map("utf8_encode", $csvData);
						// $data_array = array('area' => $csvData[7], 'city' => $csvData[8]);
						// $checkDuplicateData = $this->MasterInformationModel->checkDuplicateData($data_array, $this->username . "_" . $table_name);
						//	pre($checkDuplicateData);  //9795
						// if (!empty($checkDuplicateData)) {
						// 	$insert_area['area'] =  $csvData[7];
						// 	$insert_area['city'] = $csvData[8];
						// 	$response = $this->MasterInformationModel->insert_entry($insert_area, 'master_area');
						// }
						// $data_array = array('area' => $area, 'city' => $city);
						$data_array_city = array('city' => $csvData[8]);
						$data_array_area = array('area' => $csvData[7]);
						// $checkDuplicateData = $this->MasterInformationModel->checkDuplicateData($data_array, $this->username . "_" . $table_name);
						// $tabel_city1 = 'master_area';
						// $checkDuplicateData_area = $this->MasterInformationModel->checkDuplicateData2($data_array_area, $tabel_city1);
						// $checkDuplicateData_city = $this->MasterInformationModel->checkDuplicateData2($data_array_city, $tabel_city1);
						// if (!empty($checkDuplicateData_area)) {
						// 	$insert_area['area'] = $csvData[7];
						// 	$response = $this->MasterInformationModel->insert_entry($insert_area, 'master_area');
						// }
						// if (!empty($checkDuplicateData_city)) {
						// 	$insert_area['city'] = $csvData[8];
						// 	$response = $this->MasterInformationModel->insert_entry($insert_area, 'master_area');
						// }
						$mobile_nffo = str_replace(" ", "", $csvData[0]);
						$isduplicate = $this->duplicate_data_check_mobile_number($this->username . "_" . $table_name, $mobile_nffo);
						$intrested_area_id = isset($_POST['intrested_area']) && !empty($_POST['intrested_area']) ? $_POST['intrested_area'] : '';
						// $property_sub_type = isset($_POST['property_sub_type']) && !empty($_POST['property_sub_type']) ? $_POST['property_sub_type'] : '';
						$property_type = isset($_POST['property_type']) && !empty($_POST['property_type']) ? $_POST['property_type'] : '';
						$intrested_site = isset($_POST['intrested_site']) && !empty($_POST['intrested_site']) ? $_POST['intrested_site'] : '';
						// $purpose_buy = isset($_POST['purpose_buy']) && !empty($_POST['purpose_buy']) ? $_POST['purpose_buy'] : '';
						$approx_buy = isset($_POST['approx_buy']) && !empty($_POST['approx_buy']) ? $_POST['approx_buy'] : '';
						$inquiry_type = isset($_POST['inquiry_type']) && !empty($_POST['inquiry_type']) ? $_POST['inquiry_type'] : '';
						$inquiry_source_type = isset($_POST['inquiry_source_type']) && !empty($_POST['inquiry_source_type']) ? $_POST['inquiry_source_type'] : '';
						$intrested_area_name = isset($_POST['intrested_area_name']) && !empty($_POST['intrested_area_name']) ? $_POST['intrested_area_name'] : '';
						$intersted_site_name = isset($_POST['intersted_site_name']) && !empty($_POST['intersted_site_name']) ? $_POST['intersted_site_name'] : '';
						$insert_data = array(
							'mobileno' => isset($mobile_nffo) ? $mobile_nffo : '',
							'full_name' => isset($csvData[1]) ? $csvData[1] : '',
							'altmobileno' => !empty(trim($csvData[2])) ? trim($csvData[2]) : '',
							'email' => !empty(trim($csvData[3])) ? trim($csvData[3]) : '',
							'houseno' => !empty(trim($csvData[4])) ? trim($csvData[4]) : '',
							'society' => !empty(trim($csvData[5])) ? trim($csvData[5]) : '',
							'assign_id' => isset($_POST['assign_id']) && !empty($_POST['assign_id']) ? $_POST['assign_id'] : $_SESSION['id'],
							'owner_id' => isset($_POST['owner_id']) && !empty($_POST['owner_id']) ? $_POST['owner_id'] : $_SESSION['id'],
						);
						// $insert_data['intrested_area'] = $intrested_area;
						// $insert_data['property_sub_type'] = $property_sub_type;
						// $insert_data['property_type'] = $property_type;
						$insert_data['intrested_product'] = $intrested_site;
						// $insert_data['intersted_site_name'] = $intersted_site_name;
						// $insert_data['intrested_area_name'] = $intrested_area_name;
						// $insert_data['created_at'] = $today_date;
						//$insert_data['purpose_buy'] = $purpose_buy;
						//$insert_data['approx_buy'] = $approx_buy;
						$insert_data['inquiry_type'] = $inquiry_type;
						$insert_data['inquiry_source_type'] = $inquiry_source_type;
						// $insert_data['intrested_area'] = $intrested_area_id;
						$nxt_follow_up = $this->request->getPost("nxt_follow_up");
						if (isset($nxt_follow_up) && !empty($nxt_follow_up)) {
							$insert_data['nxt_follow_up'] = date('Y-m-d H:i:s', strtotime($nxt_follow_up));
						} else {
							$insert_data['nxt_follow_up'] = $today_date;
						}
						// pre($insert_data);
						// die();
						if ($isduplicate == 0) {
							$response = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . "_" . $table_name);
							$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($this->username . "_" . $table_name);
							$departmentdisplaydata = json_decode($departmentdisplaydata, true);
							$result['response'] = 1;
							$result['message'] = 'Added Successfully !';
							$import_data++;
						} else {
							$find_Array = array(
								'mobileno' => $mobile_nffo,
								'inquiry_status' => '7'
							);
							$find_Array_12 = array(
								'mobileno' => $mobile_nffo,
								'inquiry_status' => '12'
							);
							$find_Array_all = "SELECT * FROM " . $this->username . "_" . $table_name . " where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "'";
							$find_Array_all = $this->db->query($find_Array_all);
							$isduplicate_all_data = $find_Array_all->getResultArray();
							$satusus_id = array('1', '2', '3', '4', '5', '6', '9', '10', '11', '13');
							$repo = 0;
							if (!empty($isduplicate_all_data)) {
								foreach ($isduplicate_all_data as $key => $value) {
									if (in_array($value['inquiry_status'], $satusus_id)) {
										$repo = 1;
									}
								}
							}
							if ($repo == 0) {
								$inquiry_log_data = array();
								$response = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . "_" . $table_name);
								if ($response) {
									$inquiry_log_data['inquiry_id'] = $response;
									$userfullname = '';
									if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
										$inquiry_log_data['user_id'] = 1;
										if (isset($session_data['name']) && !empty($session_data['name'])) {
											$userfullname = $session_data['name'];
										}
									} else {
										$inquiry_log_data['user_id'] = $session_data['id'];
										if (isset($session_data['firstname']) && !empty($session_data['firstname'])) {
											$userfullname = $session_data['firstname'];
										}
									}
									$inquiry_log_data['inquiry_id'] = $response;
									$inquiry_log_data['status_id'] = 1;
									$log_content = 'Inquiry Created By ' . $userfullname;
									$inquiry_log_data['inquiry_log'] = $log_content;
									// $inquiry_log_data['created_at'] = date('Y-m-d H:i:s'));
									$response_log = $this->MasterInformationModel->insert_entry2($inquiry_log_data, $this->username . "_inquiry_log");
									$result['response'] = 1;
									$result['message'] = 'inquiry added succesfully !';
								} else {
									$result['response'] = 0;
									$result['message'] = 'Something Went Wrong !';
								}
								$reopen_data++;
							} else {
								$csv_data++;
								$duplicate_dat_store[] = array(
									'mobileno' => $mobile_nffo,
									'name' => $csvData[1],
									'altmobileno' => $csvData[2],
									'email' => $csvData[3],
									'houseno' => $csvData[4],
									'society' => $csvData[5],
									'landmark' => $csvData[6],
									'code_area' => $csvData[7],
									'code_city' => $csvData[8],
									'budget' => $csvData[9],
								);
								// $result['response'] = 0;
								// $result['message'] = 'inquiry already created';
							}
						}
					}
				}
			}
			$result['import_data'] = $import_data;
			$result['duplicate_dat_store'] = $duplicate_dat_store;
			$result['csv_data'] = $csv_data;
			$result['reopen_data'] = $reopen_data;
			return json_encode($result);
		}

		// $db_connection = DatabaseSecondConnection();
		// $sql1 = "SELECT ca_email FROM " . $this->username . "_general_setting";
		// $result1 = $db_connection->query($sql1);           
		// $resultsss1 = $result1->getResultArray();
		// $ca_email = $resultsss1[0]['ca_email'];
		// // pre($ca_email);


		// if ($ca_email != '') {
		// 	$email = \Config\Services::email();
		// 	$email->setFrom($email_from, 'Confirm Registration');
		// 	$recipients = array($ca_email);
		// 	$email->setTo($ca_email);
		// 	$email->setSubject('Invoice Of Membership');
		// 	$baseurl = base_url();
		// 	$email->setMessage('Dear ' . $table_username . ',');
		// 	$file_path = 'assets/' . $table_username . '_MembershipInvoice_Folder/' . $outputFilename . '';
		// 	$email->attach($file_path);
		// 	// pre($file_path);
		// 	if ($email->send()) {
		// 		// pre($email);
		// 		$result['email_success'] = 'Email sent successfully!';
		// 	} else {
		// 		$result['email_fail'] = $email->printDebugger(['headers']);
		// 	}
		// }

		die();
	}

	public function inquiry_log_show()
	{
		$table_name = $_POST['table'];
		$action = $_POST['action'];
		$get_id_data = $_POST['log_id'];
		if ($get_id_data) {
			$inquiryEditdata = $this->MasterInformationModel->edit_entry_all2($this->username . '_' . $table_name, $get_id_data, 'inquiry_id', $oreder = 'DESC');
			$result_array = array(
				'result' => '0'
			);
			$inquiryEditdata1 = (array) $inquiryEditdata;
			$inquiry_html = '';
			if (isset($inquiryEditdata1)) {
				foreach ($inquiryEditdata1 as $key => $inquiry_log_data) {
					$inquiry_log_data = get_object_vars($inquiry_log_data);
					//$satatus_name = status_id_to_full_status_data($inquiry_log_data['status_id'] , true);
					//$date_formate = created_at_date_convert_indian_date($inquiry_log_data['created_at'] ,"h:i A d-m-Y");
					$inquiry_html .= '<div class="row g-0 border-bottom py-2 justify-content-between">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 d-flex align-items-center">
									<h6 class="fs-10">' . $inquiry_log_data['inquiry_log'] . '</h6>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 text-end">
									<p class="text-lg-start text-md-end text-xl-end fs-12"> ' . $inquiry_log_data['created_at'] . '</p>
								</div>
							</div>';
					// $inquiry_html .='<div class="col-lg-10 col-md-10 col-sm-10 m-0 p-0">';
					// $inquiry_html .='<div class="inquiry-main-sectin">';
					// $inquiry_html .='<div class="inquiry-text-title">';
					// $inquiry_html .='<p class="inquiry-title-text"> '.$inquiry_log_data['inquiry_log'].'</p>';
					// $inquiry_html .='</div>';
					// $inquiry_html .='</div>';
					// $inquiry_html .='</div>';
					// $inquiry_html .='<div class="col-lg-2 col-md-2 col-sm-2 p-0 m-0 inquiry-width" style="text-align: right;">';
					// $inquiry_html .='<label for="" class="inquiry-types-time-date"> '.$satatus_name.'</label>';
					// $inquiry_html .='</div>';
					// $inquiry_html .='<div class=" col-md-12 inquiry-form">';
					// $inquiry_html .='<label class="inquiry-types-time-date" for="">'.$date_formate.'</label>';
					// $inquiry_html .='</div>';
					// $inquiry_html .='</div>';
				}
			}
			if (!empty($inquiry_html)) {
				$result_array = array(
					'result' => '1',
					'inquiry_html' => $inquiry_html,
					'inquiry_id' => $get_id_data
				);
				echo json_encode($result_array, true);
			} else {
			}
			die();
		}
		die();
	}
	public function inqr_show_data()
	{
		$dataBs = DatabaseDefaultConnection();
		$forge = \Config\Database::forge('second');
		$tableName = 'admin_all_inquiry';
		$columnName = 'quatation';
		if ($dataBs->fieldExists($columnName, $tableName)) {
		} else {
			$forge->addColumn($tableName, [
				$columnName => [
					'type' => 'VARCHAR',
					'constraint' => 400,
				],
			]);
		}
		// pre($_POST);
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}
		if (isset($_POST['action1'])) {
			$action1 = $this->request->getPost('action1');
		} else {
			$action1 = '';
		}
		$table_name = 'all_inquiry';
		$action = $_POST['action'];
		$delete_status = '0';
		if (isset($_POST['global_search_val'])) {
			$global_search_value = $_POST['global_search_val'];
		}
		if (isset($_POST['filter_id'])) {
			$filter_search_value = $_POST['filter_id'];
		}
		$html = "";
		$row_count_html = '';
		$return_array = array(
			'row_count_html' => '',
			'html' => '',
			'total_page' => 0,
			'response' => 0
		);
		// $inquiry_id = $_POST['inquiry_id'];
		$db_connection = DatabaseSecondConnection();
		$user_id = 1;
		if (!$this->admin == 1) {
			$user_id = $_SESSION['id'];
		}
		$status = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "";
		$perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
		$pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$datastatus = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "'1','2','3','4','6','7','9','10','11','12','13','14','17'";
		$datastatuss = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "'1','2','3','4','6','9','10','11','13'";
		$which_result = isset($_POST['follow_up_day']) && !empty($_POST['follow_up_day']) ? $_POST['follow_up_day'] : '';
		$view_list = isset($_POST['view']) && !empty($_POST['view']) ? $_POST['view'] : 'list';
		$not_valid_status = '"0"';
		$getchild = '';
		$getchild = getChildIds($_SESSION['id']);
		$stutus_data_html = "";
		$return_array['stutus_data_allow'] = 0;
		$cnr_query = '';
		if ($status == 17) {
			$cnr_query .= ' AND inquiry_cnr >= 1';
			$datastatus = "'1','2','3','4','6','7','9','10','11','12','13','17'";
			$datastatuss = "'1','2','3','4','6','9','10','11','13','17'";
		}
		if (isset($_POST['action1'])) {
			$action1 = $this->request->getPost('action1');
		} else {
			$action1 = '';
		}
		$ajaxsearch_query = '';
		$ajaxsearch_query_tab = '';
		$_f_asss_id = '';
		$total_inq_count = 0;
		$cnr_status_value = '17';
		$cnr_count = 0; // Initialize $cnr_count here
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['perPageCount']);
			unset($_POST['pageNumber']);
			unset($_POST['datastatus']);
			unset($_POST['follow_up_day']);
			unset($_POST['action1']);
			unset($_POST['view']);

			foreach ($_POST as $k => $v) {
				//$linkget .=  $k."=".$v."&";
				if (!empty($v) && $k == "full_name") {
					$ajaxsearch_query .= ' AND full_name  LIKE "%' . $v . '%"';
					$ajaxsearch_query_tab .= ' AND i.full_name  LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "nxt_follow_up") {
					$newDate = date("Y-m-d", strtotime($v));
					$ajaxsearch_query .= ' AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d") ="' . $newDate . '" ';
					$ajaxsearch_query_tab .= ' AND DATE_FORMAT(i.nxt_follow_up,"%Y-%m-%d") ="' . $newDate . '" ';
				}
				if (!empty($v) && $k == "from_date") {
					$newDate = date("Y-m-d", strtotime($v));
					// $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
					$ajaxsearch_query .= ' AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") >= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
					$ajaxsearch_query_tab .= ' AND STR_TO_DATE(i.created_at, "%Y-%m-%d %H:%i:%s") >= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}
				if (!empty($v) && $k == "to_date") {
					$newDate = date("Y-m-d", strtotime($v));
					//$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") <= '.$newDate.'';
					$ajaxsearch_query .= '  AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") <= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}
				if (!empty($v) && $k != "full_name" && $k != "nxt_follow_up" && $k != "from_date" && $k != "to_date") {
					$resStr = str_replace('f_', '', $k);
					$ajaxsearch_query .= " AND " . $resStr . "  = '" . $v . "'  ";
				}
				if (!empty($v) && $k == "f_intrested_product") {
					$ajaxsearch_query .= ' AND intrested_product  LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "from_date") {
					$newDate = date("Y-m-d", strtotime($v));
					// $newDate = Utctodate('Y-m-d', $this->timezone, $newDate);
					// $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
					$ajaxsearch_query .= ' AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") >= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
					$ajaxsearch_query_tab .= ' AND STR_TO_DATE(i.created_at, "%Y-%m-%d %H:%i:%s") >= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}
				if (!empty($v) && $k == "to_date") {
					$newDate = date("Y-m-d", strtotime($v));
					// $newDate = Utctodate('Y-m-d', $this->timezone, $newDate);
					//$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") <= '.$newDate.'';
					$ajaxsearch_query .= '  AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") <= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
					$ajaxsearch_query_tab .= '  AND STR_TO_DATE(i.created_at, "%Y-%m-%d %H:%i:%s") <= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}
				if (!empty($v) && $k == "f_appointment_date") {
					$newDate = date("Y-m-d", strtotime($v));
					$newDate = Utctodate('Y-m-d', $this->timezone, $newDate);
					$ajaxsearch_query .= ' AND DATE_FORMAT(appointment_date,"%Y-%m-%d") = "' . $newDate . '" ';
					$ajaxsearch_query_tab .= ' AND DATE_FORMAT(i.appointment_date,"%Y-%m-%d") = "' . $newDate . '" ';
				}
				if (!empty($v) && $k != "full_name" && $k != "nxt_follow_up" && $k != "f_appointment_date" && $k != "from_date" && $k != "to_date" && $k != 'f_inquiry_status' && $k != 'followupTime') {
					$resStr = str_replace('f_', '', $k);
					$ajaxsearch_query .= " AND " . $resStr . "  = '" . $v . "'  ";
					$ajaxsearch_query_tab .= " AND " . "i." . $resStr . "  = '" . $v . "'  ";
				}
				if (!empty($v) && $k == "f_assign_id") {
					$_f_asss_id = $v;

					// $getStatusWiseData = getStatusWiseData($which_result, $v);
					// //pre($getStatusWiseData);
					// $total_inq_count = 0;
					// $cnr_status_value = '17';
					// $cnr_count = 0; // Initialize $cnr_count here
					// $stutus_data_html = '';
					// if (!empty($getStatusWiseData)) {
					// 	foreach ($getStatusWiseData as $inq_status_key => $inq_status_value) {
					// 		if (!empty($inq_status_value['inq_status_name'])) {
					// 			$total_inq_count += $inq_status_value['total_inq'];
					// 			if (isset($inq_status_value['cnr_count'])) {
					// 				$cnr_count += $inq_status_value['cnr_count'];
					// 			}
					// 			$stutus_data_html .= '<li class="nav-item" role="presentation">
					// 				<button class="nav-link today-btn-2 text-nowrap" data-inquiry="' . $inq_status_value['inquiry_status'] . '">
					// 					' . $inq_status_value['inq_status_name'] . ' (' . $inq_status_value['total_inq'] . ')
					// 				</button>
					// 			</li>';
					// 		}
					// 	}
					// }
					// $stutus_data_html .= '<li class="nav-item" role="presentation">
					// 	<button class="nav-link today-btn-2 active" data-inquiry="">all(' . $total_inq_count . ')</button>
					// </li>
					// ';
					// // <li class="nav-item" role="presentation">
					// // 	<button class="nav-link today-btn-2" data-inquiry="17">Cnr(' . $getStatusWiseData['cnr_count'] . ')</button>
					// // </li>
					// $return_array['stutus_data_allow'] = 1;
				}
			}
			$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
		}

		$newDate = date("Y-m-d");
		if (isset($_POST['datastatus']) && !empty($_POST['datastatus'])) {
			$sql = "SELECT * FROM  `admin_all_inquiry` WHERE inquiry_status = " . $_POST['datastatus'] . " " . $ajaxsearch_query;
		} else {
			$sql = "SELECT * FROM `admin_all_inquiry` WHERE inquiry_status IN ($datastatus) $ajaxsearch_query";
		}

		if (!empty($ajaxsearch_query)) {
			$cnr_querys = "  inquiry_cnr = 1 ";
		} else {
			$cnr_querys = "  inquiry_cnr = 1";
		}
		$filter_data = '';
		if (isset($_POST['user_id'])) {
			$filter_data = ' AND assign_id = ' . $_POST['user_id'] . ' ';
		}

		if (isset($global_search_value)) {
			$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' WHERE `mobileno` LIKE ' . $global_search_value . ' OR `altmobileno` LIKE ' . $global_search_value;
		} else if (isset($filter_search_value)) {
			if ($this->admin == 1) {
				$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' WHERE `id` = ' . $filter_search_value . '';
			} else {
				if (!empty($getchild)) {
					$getchilds = "'" . implode("', '", $getchild) . "'";
				} else {
					$getchilds = "'" . $_SESSION['id'] . "'";
				}
				$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' WHERE `id` = ' . $filter_search_value . ' AND (assign_id=' . $_SESSION['id'] . '  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') ) AND inquiry_status IN (' . $datastatus . ') ';
			}
		} else {
			if ($this->admin == 1) {
				if ($which_result == "today") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					// if (isset($_POST['followupTime']) && !empty($_POST['followupTime'])) {
					// 	$userHour = isset($_POST['followupTime']) ? $_POST['followupTime'] : '00';
					// 	$userHour1 = sprintf("%02d:00:00", $userHour);
					// 	$newTime = UtcTime('H:i:s', $this->timezone, $userHour1); 

					// 	$dateObject = DateTime::createFromFormat('H:i:s', $newTime, new DateTimeZone($this->timezone));
					// 	$dateObject->modify('+1 hour');
					// 	$newTime1 = $dateObject->format('H:i:s');
					// 	$ajaxsearch_query .= ' AND DATE_FORMAT(nxt_follow_up,"%H:%i:%s") BETWEEN "' . $newTime . '" AND "' . $newTime1 . '"';
					// }

					$sql = 'SELECT *,TIME(DATE_FORMAT(nxt_follow_up,"%H:%i:%s")) as inq_hour FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (' . $datastatuss . ')) AND inquiry_cnr = 0 AND  DATE_FORMAT(nxt_follow_up,"%Y-%m-%d")=DATE_FORMAT("' . $newDate . '","%Y-%m-%d") ' . $filter_data . ' ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "pending") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (' . $datastatuss . ')) AND inquiry_cnr = 0 AND  DATE_FORMAT(nxt_follow_up, "%Y-%m-%d") < DATE_FORMAT("' . $newDate . '", "%Y-%m-%d") ' . $filter_data . ' ' . $ajaxsearch_query . ' ' . $cnr_query;
					// echo $sql;
				} elseif ($which_result == "appointment") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (3))   ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "dismissed") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (7))   ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "closerequest") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (8))   ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "cnr") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);

					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where inquiry_status IN (' . $datastatus . ') AND ' . $cnr_querys . ' ' . $ajaxsearch_query;
				} else {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (' . $datastatus . ')) ' . $ajaxsearch_query . ' ' . $cnr_query;
				}
			} else {
				if (!empty($getchild)) {
					$getchilds = "'" . implode("', '", $getchild) . "'";
				} else {
					$getchilds = "'" . $_SESSION['id'] . "'";
				}
				if ($which_result == "today") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT *,TIME(DATE_FORMAT(nxt_follow_up,"%H:%i:%s")) as inq_hour FROM ' . $this->username . "_" . $table_name . ' WHERE  (assign_id="' . $_SESSION['id'] . '" ) AND  inquiry_cnr = 0 AND inquiry_status IN (' . $datastatuss . ') AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d")=DATE_FORMAT("' . $newDate . '","%Y-%m-%d") ' . $filter_data . ' ' . $ajaxsearch_query . ' ' . $cnr_query;
					// echo $sql;
				} elseif ($which_result == "pending") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' WHERE  (assign_id="' . $_SESSION['id'] . '" ) AND inquiry_cnr = 0 AND inquiry_status IN (' . $datastatuss . ') AND DATE_FORMAT(nxt_follow_up, "%Y-%m-%d") < DATE_FORMAT("' . $newDate . '", "%Y-%m-%d") ' . $filter_data . ' ' . $ajaxsearch_query . ' ' . $cnr_query;
					// echo $sql;
				} elseif ($which_result == "appointment") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (3)) AND (assign_id="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') )    ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "assign_to_other") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' WHERE   owner_id="' . $_SESSION['id'] . '" AND  assign_id NOT  IN ("' . $_SESSION['id'] . '") AND NOT assign_id = owner_id  AND inquiry_status IN (' . $datastatus . ') ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "dismissed") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (7)) AND (assign_id="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') )    ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "closerequest") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where (inquiry_status IN (8)) AND (assign_id="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') )    ' . $ajaxsearch_query . ' ' . $cnr_query;
				} elseif ($which_result == "cnr") {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' where inquiry_status IN (' . $datastatus . ') AND ' . $cnr_querys . ' AND (assign_id="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') )    ' . $ajaxsearch_query . '    ';
				} else {
					$getStatusWiseData = getStatusWiseData($which_result, $_f_asss_id, $ajaxsearch_query_tab);
					$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' WHERE  (assign_id=' . $_SESSION['id'] . '  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') ) AND  inquiry_status IN (' . $datastatus . ') ' . $ajaxsearch_query . ' ' . $cnr_query;
				}
			}
		}

		$main_sql = $sql;
		// $db_connection = DatabaseSecondConnection();

		if (!empty($getStatusWiseData)) {
			//  $active =0 ;
			//  $i=1;
			// pre($getStatusWiseData);
			foreach ($getStatusWiseData as $inq_status_key => $inq_status_value) {

				if (!empty($inq_status_value['inq_status_name'])) {
					$total_inq_count += $inq_status_value['total_inq'];
					if (isset($inq_status_value['cnr_count'])) {
						$cnr_count += $inq_status_value['cnr_count'];
					}
					$stutus_data_html .= '<li class="nav-item" role="presentation">
								<button class="nav-link text-nowrap" id="status_main_' . $inq_status_value['inquiry_status'] . '" data-inquiry="' . $inq_status_value['inquiry_status'] . '">
									' . $inq_status_value['inq_status_name'] . ' (' . $inq_status_value['total_inq'] . ')
								</button>
							</li>';
				}
			}
			$stutus_data_html .= '<li class="nav-item" role="presentation">
				<button class="nav-link all" data-inquiry="">all' . '(' . $total_inq_count . ')</button>
			</li>
			<li class="nav-item" role="presentation">';
			if (isset($getStatusWiseData['cnr_count']) && $which_result == 'cnr') {
				$stutus_data_html .= '<button class="nav-link" data-inquiry="17">Cnr(' . $getStatusWiseData['cnr_count'] . ')</button>';
			}
			$stutus_data_html .= '</li>';
		}

		$secondDb = DatabaseDefaultConnection();
		$result = $secondDb->query($main_sql);
		if ($result->getNumRows() > 0) {
			$return_array['stutus_data_allow'] = 1;

			$rowCount = $result->getNumRows();
			$total_no_of_pages = $rowCount;
			$second_last = $total_no_of_pages - 1;
			$pagesCount = ceil($rowCount / $perPageCount);
			$lowerLimit = ($pageNumber - 1) * $perPageCount;
			if ($view_list == 'cardview' || $view_list == 'clockview') {
				$order_by_col_name = "id";
				$limits = "";
			} else {
				$order_by_col_name = "id";
				$limits = "LIMIT $lowerLimit , $perPageCount";
			}
			// $sqlQuery = $main_sql . " ORDER BY `id` DESC LIMIT $order_by_col_name , $perPageCount";

			$sqlQuery = $main_sql . " ORDER BY `$order_by_col_name` DESC " . $limits;
			$secondDb = DatabaseDefaultConnection();
			$Getresult = $secondDb->query($sqlQuery);
			$inquiry_all_data = $Getresult->getResultArray();
			$rowCount_child = $Getresult->getNumRows();
			$start_entries = $lowerLimit + 1;
			$last_entries = $start_entries + $rowCount_child - 1;
			$row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
			$departmentdisplaydata = $result->getResultArray();
			$html = "";
			$status = get_table_array_helper('master_inquiry_status');
			$today = date("d-m-Y");
			$html2 = "";
			if ($view_list == 'listview') {
				foreach ($inquiry_all_data as $key => $value) {
					$t = '';
					if ($this->admin == 1) {
						$access = 1;
					} elseif (in_array($value['assign_id'], $getchild)) {
						$access = 1;
					} elseif ($value['assign_id'] == $_SESSION['id']) {
						$access = 1;
					}
					if (isset($value['appointment_date']) && !empty($value['appointment_date'])) {
						$second = strtotime($value['appointment_date']);
						$t = date('d-m-Y', $second);
					}
					$inquiry_details = "";
					if (isset($value['inquiry_type']) && !empty($value['inquiry_type'])) {
						$inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $value['inquiry_type'] . "", "admin_master_inquiry_type");
						$inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
					}
					$intrested_product = '';
					if (isset($value['intrested_product']) && !empty($value['intrested_product'])) {
						$product_name = IdToFieldGetData('product_name', "id='" . $value['intrested_product'] . "'", "admin_product");
						$intrested_product = isset($product_name['product_name']) && !empty($product_name['product_name']) ? $product_name['product_name'] : $value['intrested_product'];
					}
					// echo $value['inquiry_type'];
					// pre($inquiry_type_name);
					$assign_name = '';
					$user_data = user_id_to_full_user_data($value['assign_id']);
					//pre($value['assign_id']);
					//die();
					if ($value['assign_id'] == 0) {
						if (isset($user_data['name'])) {
							$assign_name = $user_data['name'];
						}
					} else {
						if (isset($user_data['firstname'])) {
							$assign_name = $user_data['firstname'];
						}
					}
					$btn_class = 'status_color_' . $value['inquiry_status'];
					$btn_name = 'Default';
					if (isset($value['inquiry_status']) && !empty($value['inquiry_status'])) {
						if (isset($status[$value['inquiry_status']])) {
							$btn_class = 'status_color_' . $value['inquiry_status'];
							$btn_name = $status[$value['inquiry_status']]['inquiry_status'];
						}
					}
					// die();
					$html .= '<tr>
					<td>
						<input type="checkbox" name="inquiry_id[]" class="checkbox table_list_check mt-2 inquiry_id" data-sms_id="' . $value['id'] . '" value="' . $value['id'] . '">
					</td>';
					$html .= ' <td type="button" class="today-follow-tab-content-td ee-todayfollow mt-2 col-xxl-12">
								<div class="tfp-inquiry-list pe-3 bg-white">
									<div class="inquiry-list-topbar d-flex align-items-center justify-content-between flex-wrap">
										<div class="inquiry-list-topbar-id-name d-flex align-items-center col-12 col-xl-4 flex-wrap">
										<p>' . $value['id'] . '</p>
										<h6 class="mx-2 ">' . $value['full_name'] . '</h6>';
					if (in_array('all_inquiry_information_child_followup_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
						$html .= '<div class="call-btn view-model-btn call-reset-tab inquiry_all_status_call" id="call-btn" product_type = "' . $value['intrested_product'] . '"  inquiry_pno = "' . $value['mobileno'] . '" inquiry_email="' . $value['email'] . '" data-bs-toggle="modal"
													data-bs-target="#callmodal" data-call_id="' . $value['id'] . '">
													<i class="bi bi-telephone"></i>
												</div>';
					};
					$html .= '</div>
							<div class="inquiry-list-topbar-icon d-flex align-items-center col-12 col-xl-4 justify-content-end flex-wrap">
										<button class="' . $btn_class . ' me-1">' . $btn_name . '</button>	';
					if ($value['inquiry_cnr'] == 1) {
						$html .= '<button class="btn btn-primary btn-padding cnr_class status_color_17"> CNR </button>';
					}
					if ($value['inquiry_status'] == 3) {
						if ($t < $today) {
							$html .= '<button class="btn btn-primary btn-padding cnr_class status_color_17">Due Appo</button>';
						}
					}
					// if (in_array('inquiry_vist_inquiry', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$html .= '	<div class="call-btn mx-1 text-center visit_entry_form" type="button" data-inquiry_edit_id="' . $value['id'] . '" data-bs-toggle="modal"
										data-bs-target="#visit_entry_form">
										<img src="https://dev.realtosmart.com/assets/images/location.svg" class="w-75">
									</div>';
					// }
					// ;
					// if (in_array('inquiry_booking', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					// 	$html .= '	<div class="call-btn mx-1 text-center" id="booking-btn" data-bs-toggle="modal" data-bs-target="#conversion_inquery" data-booking_id="' . $value['id'] . '">
					// 					<img src="https://dev.realtosmart.com/assets/images/booking.svg" class="w-75">	
					// 				</div>';
					// };
					$html .= ' </div>
								</div>
									<div class="inquiry-list-content d-flex justify-content-start align-items-center flex-wrap inquery_view" data-view_id="' . $value['id'] . '"';
					if (in_array('all_inquiry_information_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
						$html .= '	 data-bs-toggle="modal" data-bs-target="#view_inquery_list"';
					};
					$html .= '>		<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3 ">
										<p class="text-nowrap"><i class="fa-solid fa-user-tie text-black me-1"></i> : </p>
										<span class="mx-1 text-nowrap">' . $assign_name . '</span>
									</div>
									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">
										<p class="text-nowrap"><i class="bi bi-calendar-plus text-black me-1"></i> : </p>
										<span class="mx-1 text-nowrap">' . followup_date_convert_indian_date($value['created_at']) . '</span>
									</div>
									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">
										<p class="text-nowrap"><i class="bi bi-telephone-fill me-1 text-success"></i> : </p>
										<span class="mx-1 text-nowrap">' . followup_date_convert_indian_date($value['nxt_follow_up']) . '</span>
									</div>
									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">
										<p class="text-nowrap"><i class="bi bi-currency-rupee text-black me-1"></i> : </p>
										<span class="mx-1 text-nowrap">' . $value['budget'] . '</span>
									</div>
									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">
										<p class="text-nowrap">Inq type : </p>
										<span class="mx-1 text-nowrap">' . $inquiry_details . '</span>
									</div>
									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">
										<p class="text-nowrap">Int Product : </p>
										<span class="mx-1 text-nowrap">' . $intrested_product . '</span>
										</div>
									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">

										<p class="text-nowrap">Inq Area : </p>

										<span class="mx-1 text-nowrap">' .  $value['area'] . '</span>

									</div>

									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">

										<p class="text-nowrap">Inq City : </p>

										<span class="mx-1 text-nowrap">' .  $value['city'] . '</span>

									</div>

									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3 flex-wp">
										<p class="text-nowrap">Subscription : </p>
										<span class="mx-1">' . $value['subscription'] . '</span>
									</div>
									<div class="d-flex align-items-center col-12 col-md-4 col-md-6 col-xl-3">
										<p class="text-nowrap">Purpose of Buying : </p>
										<span class="mx-1 text-nowrap">' . $value['buying_as'] . '</span>
									</div>
								</div>
							</div>
						</td>';
					$html .= '</tr>';
				}
			} else if ($view_list == 'cardview') {
				$main_tab = '';
				// $inquiry_all_data = array_reverse($inquiry_all_data);
				$status = array_reverse($status);
				$not_allow_array = array('17', '14', '8', '9', '13');
				foreach ($status as $status_key => $status_value) {
					$inquiry_htmllll = '';
					$i = 0;
					if (!in_array($status_value['id'], $not_allow_array)) {
						foreach ($inquiry_all_data as $key => $value) {

							// pre($inquiry_all_data);
							if ($value['inquiry_status'] == $status_value['id']) {
								// pre($value);
								$access = 0;
								$t = '';
								if ($this->admin == 1) {
									$access = 1;
								} elseif (in_array($value['assign_id'], $getchild)) {
									$access = 1;
								} elseif ($value['assign_id'] == $_SESSION['id']) {
									$access = 1;
								}
								if (isset($value['appointment_date']) && !empty($value['appointment_date'])) {
									$second = strtotime($value['appointment_date']);
									$t = date('d-m-Y', $second);
									if ($t != '30-11--0001') {
										$t = Utctodate('d-m-Y', $this->timezone, $t);
									} else {
										$t = '';
									}
								}
								$username = session_username($_SESSION['username']);
								// if($access ==1){
								$inquiry_details = "";
								if (isset($value['inquiry_type']) && !empty($value['inquiry_type'])) {
									$inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $value['inquiry_type'] . "", 'admin_master_inquiry_type');
									$inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
								}
								$intrested_site_details = "";
								if (isset($value['intrested_site']) && !empty($value['intrested_site'])) {
									$intrested_site = IdToFieldGetData('project_name', "id=" . $value['intrested_site'] . "", $username . "_project");
									$intrested_site_details = isset($intrested_site['project_name']) && !empty($intrested_site['project_name']) ? $intrested_site['project_name'] : '';
								}
								$master_area = "";
								$master_area_details = '';
								if (isset($value['intrested_area']) && !empty($value['intrested_area'])) {
									$master_area = IdToFieldGetData('area', "id=" . $value['intrested_area'] . "", "master_area");
									$master_area_details = isset($master_area['area']) && !empty($master_area['area']) ? $master_area['area'] : '';
								}
								// pre($intrested_site_details);
								// die();
								$project_sub_type_name = "";
								$btn_class = 'status_color_' . $value['inquiry_status'];
								$btn_name = 'Default';
								if (isset($value['inquiry_status']) && !empty($value['inquiry_status'])) {
									if (isset($status[$value['inquiry_status']])) {
										$btn_class = 'status_color_' . $value['inquiry_status'];
										$btn_name = $status[$value['inquiry_status']]['inquiry_status'];
									}
								}
								$assign_name = '';
								$user_data = user_id_to_full_user_data($value['assign_id']);
								//pre($value['assign_id']);
								//die();
								if ($value['assign_id'] == 1) {
									if (isset($user_data['name'])) {
										$assign_name = $user_data['name'];
									}
								} else {
									if (isset($user_data['firstname'])) {
										$assign_name = $user_data['firstname'];
									}
								}
								if ($value['created_at'] != '30-11--0001') {
									$created_at = Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['created_at'])));
								} else {
									$created_at = '';
								}
								if ($value['nxt_follow_up'] != '0000-00-00 00:00:00') {
									$nxt_follow_up = Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['nxt_follow_up'])));
								} else {
									$nxt_follow_up = '';
								}
								$id =  isset($value['id']) && $value['id'] != '' ? $value['id'] : "";
								$name =  isset($value['full_name']) && !empty($value['full_name']) ? preg_replace('/[^A-Za-z0-9\s]/', '', rtrim($value['full_name'])) : "";
								// $id_with_name =  $id." ";
								// if(!empty($name) && $name != "" && $name != " " && $name != "  ") {
								// 	$id_with_name .= $name;
								// 	// echo $name."<br>";
								// }
								$inquiry_htmllll .= '
								<div class="custm-up-class task-card-main-edit-box editable cursor-pointer">
									<div class="task-card task-card-body-inactive">
										<div class="task-card-header p-2">
											<div class="d-flex align-items-center">
												<div class="task-header-dot status_color_' . $status_value['id'] . '"></div>
												<span class="fs-14 fw-medium text-dark ps-3 pe-1 task-header-id">' . $id . '</span>
												<span class="fs-14 text-gray main_task_name_width text-nowrap overflow-hidden" style="text-overflow: ellipsis;">' . $name . '</span>
												<div class="task-header-main-call d-flex align-items-center">
													<div class="btn-secondary-rounded mx-1 cursor-pointer inquiry_all_status_call" style="width: 25px; height: 25px;" id="call-btn" data-bs-toggle="modal" data-bs-target="#callmodal" data-call_id="' . $value['id'] . '">
														<i class="bi bi-telephone fs-12 d-flex"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="task-card-body p-2">
											<div class="d-flex my-1 justify-content-end align-items-center">';

								$inquiry_htmllll .= '	<div class="call-btn mx-1 text-center visit_entry_form" type="button" data-inquiry_edit_id="' . $value['id'] . '" data-bs-toggle="modal"
											data-bs-target="#visit_entry_form">
											<img src="https://dev.realtosmart.com/assets/images/location.svg" class="w-75">
										</div>';

								$inquiry_htmllll .= '	</div>
											<div class="d-flex my-1">
												<span class="fs-12 fw-medium text-dark me-1"><i class="fa-solid fa-user-tie"></i> :</span>
												<span class="fs-12 fw-normal text-dark">' . $assign_name . '</span>
											</div>
											<div class="d-flex my-1">
												<span class="fs-12 fw-medium text-dark me-1"><i class="fa-solid fa-calendar-days"></i> :</span>
												<span class="fs-12 fw-normal text-dark">' . $created_at . '</span>
											</div>
											<div class="d-flex my-1">
												<span class="fs-12 fw-medium text-dark me-1"><i class="bi bi-person-fill-up"></i> :</span>
												<span class="fs-12 fw-normal text-dark">' . $nxt_follow_up . '</span>
											</div>
											<div class="d-flex my-1">
												<span class="fs-12 fw-medium text-dark me-1">Inq type : </span>
												<span class="fs-12 fw-normal text-dark">' . $inquiry_details . '</span>
											</div>';
								$intrested_product = '';
								if (isset($value['intrested_product']) && !empty($value['intrested_product'])) {
									$product_name = IdToFieldGetData('product_name', "id='" . $value['intrested_product'] . "'", "admin_product");
									$intrested_product = isset($product_name['product_name']) && !empty($product_name['product_name']) ? $product_name['product_name'] : $value['intrested_product'];
								}


								$inquiry_htmllll .= '<div class="d-flex my-1">
																			<p>Int product : </p>
																			<span class="mx-1">' . $intrested_product . '</span>
																			
																			</div>';

								$inquiry_htmllll .= '	</div>
									</div>
								</div>';
								$i++;
							}
						}
						$html .= '
						<div class="task-main-board px-2 py-3 task-main-board-inactive">
										<div class="task-board-header p-2 rounded-1 col-12 status_color_' . $status_value['id'] . '">
											<div class="d-flex">
												<p class="fw-medium text-white">' . $status_value['inquiry_status'] . '</p>
												<span class="rounded-pill bg-white text-dark shadow ms-auto r_count">' . $i . '</span>
											</div>
										</div>
										<div id="hygtfytfuytuyv">
											<div class="task-main-index">
												<div class="task-board-body task-card-main-edit w-100 mt-2 p-1">
													<div class="card_html_load">
													' . $inquiry_htmllll . '
													</div>';
						if ($i == 10) {
							$html .= '<button class="load_more_data border-0 w-100 p-2 rounded-2 my-2 text-center task-card cursor-pointer " data-row_count="' . $i . '" data-inquiry_status="' . $status_value['id'] . '">
																+ Show more
															</button>';
						}
						$html .= '</div>
											</div>
										</div>
									</div>';
					}
				}

				// return $main_tab;
			} else if ($view_list == 'clockview') {

				$hour_array = array(
					// '1' => '01:00 to 02:00 am',
					// '2' => '02:00 to 03:00 am',
					// '3' => '03:00 to 04:00 am',
					// '4' => '04:00 to 05:00 am',
					// '5' => '05:00 to 06:00 am',
					// '6' => '06:00 to 07:00 am',
					// '7' => '07:00 to 08:00 am',
					// '8' => '08:00 to 09:00 am',
					'9' => '09:00 to 10:00 am',
					'10' => '10:00 to 11:00 am',
					'11' => '11:00 to 12:00 am',
					'12' => '12:00 to 01:59 am',
					'13' => '01:00 to 02:00 pm',
					'14' => '02:00 to 03:00 pm',
					'15' => '03:00 to 04:00 pm',
					'16' => '04:00 to 05:00 pm',
					'17' => '05:00 to 06:00 pm',
					'18' => '06:00 to 07:00 pm',
					'19' => '07:00 to 08:00 pm',
					'20' => '08:00 to 09:00 pm',
					// '21' => '09:00 to 10:00 pm',
					// '22' => '10:00 to 11:00 pm',
					// '23' => '11:00 to 12:00 pm',
				);
				// pre($inquiry_all_data);
				// // continue;
				// die();
				$currentHour = date('H');
				// pre($currentHour);

				foreach ($hour_array as $hr_key => $hr_value) {
					// die();
					$inquiry_htmllll = '';
					$i = 0;
					// echo $hr_key;
					// continue;


					foreach ($inquiry_all_data as $key => $value) {
						$inq_hour = date('H', strtotime($value['inq_hour']));

						if ($inq_hour == $hr_key) {

							$access = 0;
							$t = '';
							if ($this->admin == 1) {
								$access = 1;
							} elseif (in_array($value['assign_id'], $getchild)) {
								$access = 1;
							} elseif ($value['assign_id'] == $_SESSION['id']) {
								$access = 1;
							}
							if (isset($value['appointment_date']) && !empty($value['appointment_date'])) {
								$second = strtotime($value['appointment_date']);
								$t = date('d-m-Y', $second);
								if ($t != '30-11--0001') {
									$t = Utctodate('d-m-Y', $this->timezone, $t);
								} else {
									$t = '';
								}
							}

							$username = session_username($_SESSION['username']);

							// if($access ==1){
							$inquiry_details = "";
							if (isset($value['inquiry_type']) && !empty($value['inquiry_type'])) {
								$inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $value['inquiry_type'] . "", 'admin_master_inquiry_type');
								$inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
							}

							$intrested_site_details = "";
							if (isset($value['intrested_site']) && !empty($value['intrested_site'])) {
								$intrested_site = IdToFieldGetData('project_name', "id=" . $value['intrested_site'] . "", $username . "_project");
								$intrested_site_details = isset($intrested_site['project_name']) && !empty($intrested_site['project_name']) ? $intrested_site['project_name'] : '';
							}
							$master_area = "";
							$master_area_details = '';
							if (isset($value['intrested_area']) && !empty($value['intrested_area'])) {
								$master_area = IdToFieldGetData('area', "id=" . $value['intrested_area'] . "", "master_area");
								$master_area_details = isset($master_area['area']) && !empty($master_area['area']) ? $master_area['area'] : '';
							}
							// pre($intrested_site_details);
							// die();
							$project_sub_type_name = "";
							$btn_class = 'status_color_' . $value['inquiry_status'];
							$btn_name = 'Default';
							if (isset($value['inquiry_status']) && !empty($value['inquiry_status'])) {
								if (isset($status[$value['inquiry_status']])) {
									$btn_class = 'status_color_' . $value['inquiry_status'];
									$btn_name = $status[$value['inquiry_status']]['inquiry_status'];
								}
							}
							$assign_name = '';
							$user_data = user_id_to_full_user_data($value['assign_id']);

							if ($value['assign_id'] == 1) {
								if (isset($user_data['name'])) {
									$assign_name = $user_data['name'];
								}
							} else {
								if (isset($user_data['firstname'])) {
									$assign_name = $user_data['firstname'];
								}
							}
							if ($value['created_at'] != '30-11--0001') {
								$created_at = Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['created_at'])));
							} else {
								$created_at = '';
							}
							if ($value['nxt_follow_up'] != '0000-00-00 00:00:00') {
								$nxt_follow_up = Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['nxt_follow_up'])));
								$only_time = Utctodate('h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['nxt_follow_up'])));
							} else {
								$nxt_follow_up = '';
								$only_time = '';
							}

							$id =  isset($value['id']) && $value['id'] != '' ? $value['id'] : "";
							$name =  isset($value['full_name']) && !empty($value['full_name']) ? preg_replace('/[^A-Za-z0-9\s]/', '', rtrim($value['full_name'])) : "";
							// $id_with_name =  $id." ";
							// if(!empty($name) && $name != "" && $name != " " && $name != "  ") {
							// 	$id_with_name .= $name;
							// 	// echo $name."<br>";
							// }
							$inquiry_htmllll .= '
							<div class="custm-up-class task-card-main-edit-box editable cursor-pointer">
								<div class="task-card task-card-body-inactive">
									<div class="task-card-header p-2">
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center col-7">
												<div class="task-header-dot status_color_' . $value['inquiry_status'] . '"></div>
												<span class="fs-14 fw-medium text-dark ps-3 pe-1 task-header-id">' . $id . '</span>
												<span class="fs-14 text-gray main_task_name_width text-nowrap overflow-hidden" style="text-overflow: ellipsis;">' . $name . '</span>
											</div>
											<div class="task-header-main-call d-flex align-items-center col-5 justify-content-end">
												<span class="fs-14 text-gray main_task_name_width text-nowrap overflow-hidden" style="text-overflow: ellipsis;">' . $only_time . '</span>
												<div class="btn-secondary-rounded mx-1 cursor-pointer inquiry_all_status_call" style="width: 25px; height: 25px;" id="call-btn" data-bs-toggle="modal" data-bs-target="#callmodal" data-call_id="' . $value['id'] . '">
													<i class="bi bi-telephone fs-12 d-flex"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="task-card-body p-2">';
							$inquiry_htmllll .= '<div class="call-btn mx-1 text-end visit_entry_form" type="button" data-inquiry_edit_id="' . $value['id'] . '" data-bs-toggle="modal"
									data-bs-target="#visit_entry_form">
									<img src="https://dev.realtosmart.com/assets/images/location.svg">
								</div>';
							$inquiry_htmllll .= '<div class="d-flex my-1">
											<span class="fs-12 fw-medium text-dark me-1"><i class="fa-solid fa-user-tie"></i> :</span>
											<span class="fs-12 fw-normal text-dark">' . $assign_name . '</span>
										</div>
										<div class="d-flex my-1">
											<span class="fs-12 fw-medium text-dark me-1"><i class="fa-solid fa-calendar-days"></i> :</span>
											<span class="fs-12 fw-normal text-dark">' . $created_at . '</span>
										</div>
										<div class="d-flex my-1">
											<span class="fs-12 fw-medium text-dark me-1"><i class="bi bi-person-fill-up"></i> :</span>
											<span class="fs-12 fw-normal text-dark">' . $nxt_follow_up . '</span>
										</div>
										<div class="d-flex my-1">
												<span class="fs-12 fw-medium text-dark me-1">Inq type : </span>
												<span class="fs-12 fw-normal text-dark">' . $inquiry_details . '</span>
											</div>';
							$intrested_product = '';
							if (isset($value['intrested_product']) && !empty($value['intrested_product'])) {
								$product_name = IdToFieldGetData('product_name', "id='" . $value['intrested_product'] . "'", "admin_product");
								$intrested_product = isset($product_name['product_name']) && !empty($product_name['product_name']) ? $product_name['product_name'] : $value['intrested_product'];
							}


							$inquiry_htmllll .= '<div class="d-flex my-1">
																			<p>Int product : </p>
																			<span class="mx-1">' . $intrested_product . '</span>
																		</div>';

							$inquiry_htmllll .= '</div>
								</div>
							</div>';
							$i++;
						}
					}

					if ($i > 0 || $currentHour == $hr_key) {
						$html .= '<div class="item">
										<div class="task-main-board px-2 py-3 task-main-board-inactive mt-3" id="';
						if ($currentHour == $hr_key) {
							$html .= 'active_tab';
						}
						$html .= '">
											<div class="task-board-header p-2 rounded-1 col-12 ';
						if ($currentHour == $hr_key) {
							$html .= 'bg-warning bg-gradient text-dark';
						} else if ($currentHour > $hr_key) {
							$html .= 'bg-danger bg-gradient';
						} else if ($i > 0) {
							$html .= 'bg-success bg-gradient';
						} else {
							$html .= 'bg-danger bg-gradient';
						}
						$html .= '">
												<div class="d-flex">
													<p class="fw-medium text-white">' . $hr_value . '</p>
													<span class="rounded-pill bg-white text-dark shadow ms-auto r_count">' . $i . '</span>
												</div>
											</div>
											<div id="hygtfytfuytuyv">
												<div class="task-main-index">
													<div class="task-board-body task-card-main-edit w-100 mt-2 p-1">
														<div class="card_html_load">
														' . $inquiry_htmllll . '
														</div>';
						// if($i == 10){
						// 	$html .= '<button class="load_more_data border-0 w-100 p-2 rounded-2 my-2 text-center task-card cursor-pointer " data-row_count="' . $i . '" data-inquiry_status="' . $status_value['id'] . '">
						// 			+ Show more
						// 		</button>';
						// }
						$html .= '</div>
												</div>
											</div>
										</div>
									</div>
									';
					}
				}
				$html2 .= '
					<script>
						function clock_owlCarousel(){
							$(".clockDiv_main").owlCarousel("destroy");
							// console.log(23);
							$(".clockDiv_main").removeClass("d-flex w-100 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 flex-nowrap");
							$(".clockDiv_main").closest("div").removeClass("overflow-x-scroll scroll-small");
							$(".clockDiv_main").addClass("owl-carousel owl-theme");	
							$(".clockDiv_main").owlCarousel({
								loop:false,
								margin:10,
								nav:true,
								responsive:{
									0:{
										items:1
									},
									600:{
										items:2
									},
									1000:{
										items:4
									}
								}
							});
						}
						clock_owlCarousel();
					</script>
					';
				$return_array['html2'] = $html2;
			}
			if ($result->getNumRows() > 0) {
				if ($action == 'export' || $action1 == 'export') {
					// pre($sql);
					$inquiry_all_data = $result->getResultArray();
					$lineData = array();
					foreach ($inquiry_all_data as $key => $value) {
						if (!empty($value['id']) && !empty(htmlentities($value['full_name'])) && !empty($value['mobileno'])) {
							$lineData[] = array(
								'id' => $value['id'],
								'firstname' => htmlentities($value['full_name']),
								'mobileno' => $value['mobileno']
							);
						}
					}
					$return_array['export_data'] = $lineData;
					return json_encode($return_array);
					// exit;
				}
			}

			
		
					$ConnectionStatus = 1;
					$access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
					$urllistdata = MetaUrl().'135764946295075/message_templates?fields=name,status,language&access_token=' . $access_token;
					$responselistdata = getSocialData($urllistdata);
					$templateNames = [];

					foreach ($responselistdata['data'] as $item) {
						if ($item['status'] == "APPROVED") {
							$templateNames[$item['id']] = $item['name'];
							$templatelanguage[$item['name']] = $item['language'];
						}
					}
				
			
			$return_array['stutus_data_html'] = $stutus_data_html;
			$return_array['row_count_html'] = $row_count_html;
			$return_array['html'] = $html;
			$return_array['total_page'] = $pagesCount;
			$return_array['response'] = 1;
			$return_array['Template_name'] = $templateNames;
			$return_array['templatelanguage'] = $templatelanguage;

		} else {

			$return_array['stutus_data_html'] = $stutus_data_html;
			$return_array['row_count_html'] = "Page 0 of 0";
			$return_array['total_page'] = 0;
			$return_array['response'] = 1;
			$return_array['html'] = '<td></td><td class="text-center">Data Not Found </td>';
		}
		// echo $html;
		echo json_encode($return_array);
		die();
	}
	public function card_inquiry_list_data()
	{
		// pre($_POST);
		$action = $_POST['action'];
		$table_name = 'all_inquiry';
		$status = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "";
		$perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
		$pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$datastatus = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "'1','2','3','4','6','7','9','10','11','12','13','14','17'";
		$datastatuss = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "'1','2','3','4','6','9','10','11','13'";
		$which_result = isset($_POST['follow_up_day']) && !empty($_POST['follow_up_day']) ? $_POST['follow_up_day'] : '';
		$lower_limit = $perPageCount;
		$top_limit = 20;
		$getchild = '';
		$getchild = getChildIds($_SESSION['id']);
		$return_array = array();
		// echo $lower_limit . ' ' .$top_limit; 
		$view_list = isset($_POST['view']) && !empty($_POST['view']) ? $_POST['view'] : 'list';
		if ($status == 17) {
			$cnr_query .= ' AND inquiry_cnr >= 1';
			$datastatus = "'1','2','3','4','6','7','9','10','11','12','13','17'";
			$datastatuss = "'1','2','3','4','6','9','10','11','13','17'";
		}

		$sql = 'SELECT * FROM ' . $this->username . "_" . $table_name . ' WHERE inquiry_status IN (' . $datastatus . ') LIMIT ' . $lower_limit . ' , ' . $top_limit . ';';
		// echo $sql;
		$db_connection50 = DatabaseDefaultConnection();
		$sql_result = $db_connection50->query($sql);
		$finalresult = $sql_result->getResultArray();
		// pre($finalresult);

		$html = '';
		$i = $lower_limit;
		foreach ($finalresult as $key => $value) {
			$access = 0;
			$t = '';
			if ($this->admin == 1) {
				$access = 1;
			} elseif (in_array($value['assign_id'], $getchild)) {
				$access = 1;
			} elseif ($value['assign_id'] == $_SESSION['id']) {
				$access = 1;
			}
			if (isset($value['appointment_date']) && !empty($value['appointment_date'])) {
				$second = strtotime($value['appointment_date']);
				$t = date('d-m-Y', $second);
				if ($t != '30-11--0001') {
					$t = Utctodate('d-m-Y', $this->timezone, $t);
				} else {
					$t = '';
				}
			}
			$username = session_username($_SESSION['username']);
			// if($access ==1){
			$inquiry_details = "";
			if (isset($value['inquiry_type']) && !empty($value['inquiry_type'])) {
				$inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $value['inquiry_type'] . "", "admin_master_inquiry_type");
				$inquiry_details = isset($inquiry_type_name['inquiry_details']) && !($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
			}
			$intrested_site_details = "";
			if (isset($value['intrested_site']) && !empty($value['intrested_site'])) {
				$intrested_site = IdToFieldGetData('project_name', "id=" . $value['intrested_site'] . "", $username . "_project");
				$intrested_site_details = isset($intrested_site['project_name']) && !empty($intrested_site['project_name']) ? $intrested_site['project_name'] : '';
			}
			$master_area = "";
			$master_area_details = '';
			if (isset($value['intrested_area']) && !empty($value['intrested_area'])) {
				$master_area = IdToFieldGetData('area', "id=" . $value['intrested_area'] . "", "master_area");
				$master_area_details = isset($master_area['area']) && !empty($master_area['area']) ? $master_area['area'] : '';
			}
			// pre($intrested_site_details);
			// die();
			$project_sub_type_name = "";
			$btn_class = 'status_color_' . $value['inquiry_status'];
			$btn_name = 'Default';
			if (isset($value['inquiry_status']) && !empty($value['inquiry_status'])) {
				if (isset($status[$value['inquiry_status']])) {
					$btn_class = 'status_color_' . $value['inquiry_status'];
					$btn_name = $status[$value['inquiry_status']]['inquiry_status'];
				}
			}
			$assign_name = '';
			$user_data = user_id_to_full_user_data($value['assign_id']);
			//pre($value['assign_id']);
			//die();
			if ($value['assign_id'] == 1) {
				if (isset($user_data['name'])) {
					$assign_name = $user_data['name'];
				}
			} else {
				if (isset($user_data['firstname'])) {
					$assign_name = $user_data['firstname'];
				}
			}
			if ($value['created_at'] != '30-11--0001') {
				$created_at = Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['created_at'])));
			} else {
				$created_at = '';
			}
			if ($value['nxt_follow_up'] != '0000-00-00 00:00:00') {
				$nxt_follow_up = Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['nxt_follow_up'])));
			} else {
				$nxt_follow_up = '';
			}
			$id =  isset($value['id']) && $value['id'] != '' ? $value['id'] : "";
			$name =  isset($value['full_name']) && !empty($value['full_name']) ? preg_replace('/[^A-Za-z0-9\s]/', '', rtrim($value['full_name'])) : "";

			$html .= '
                    <div class="custm-up-class task-card-main-edit-box editable cursor-pointer">
                        <div class="task-card task-card-body-inactive">
                            <div class="task-card-header p-2">
                                <div class="d-flex align-items-center">
                                <div class="task-header-dot status_color_' . $value['inquiry_status'] . '"></div>
                                <span class="fs-14 fw-medium text-dark ps-3 pe-1 task-header-id">' . $id . '</span>
                                <span class="fs-14 text-gray main_task_name_width text-nowrap overflow-hidden" style="text-overflow: ellipsis;">' . $name . '</span>
                                <div class="task-header-main-call d-flex align-items-center">
                                    <div class="btn-secondary-rounded mx-1 cursor-pointer inquiry_all_status_call" style="width: 25px; height: 25px;" id="call-btn" data-bs-toggle="modal" data-bs-target="#callmodal" data-call_id="' . $value['id'] . '">
                                        <i class="bi bi-telephone fs-12 d-flex"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="task-card-body p-2">
                                <div class="d-flex my-1 justify-content-between align-items-center">
                                    <div class="call-btn mx-1 text-center visit_entry_form" data-inquiry_edit_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#visit_entry_form">
                                        <img src="https://dev.realtosmart.com/assets/images/location.svg" width="20px" height="20px">
                                    </div>
                                    <div class="call-btn mx-1 text-center" id="booking-btn" data-bs-toggle="modal" data-bs-target="#conversion_inquery" data-booking_id="' . $value['id'] . '">
                                    <img src="https://dev.realtosmart.com/assets/images/booking.svg" width="20px" height="20px">
                                    </div>
                                </div>
                                <div class="d-flex my-1">
                                    <span class="fs-12 fw-medium text-dark me-1"><i class="fa-solid fa-user-tie"></i> :</span>
                                    <span class="fs-12 fw-normal text-dark">' . $assign_name . '</span>
                                </div>
                                <div class="d-flex my-1">
                                    <span class="fs-12 fw-medium text-dark me-1"><i class="fa-solid fa-calendar-days"></i> :</span>
                                    <span class="fs-12 fw-normal text-dark">' . $created_at . '</span>
                                </div>
                                <div class="d-flex my-1">
                                    <span class="fs-12 fw-medium text-dark me-1"><i class="bi bi-person-fill-up"></i> :</span>
                                    <span class="fs-12 fw-normal text-dark">' . $nxt_follow_up . '</span>
                                </div>
                                <div class="d-flex my-1">
                                    <span class="fs-12 fw-medium text-dark me-1">Inq type : </span>
                                    <span class="fs-12 fw-normal text-dark">' . $inquiry_details . '</span>
                                </div>
                               
                               
                            </div>
                        </div>
                    </div>';
			$i++;
		}

		$btn_count = (int) $lower_limit + $top_limit;
		if ($i >= $btn_count) {
			$return_array['btn_remove'] = 1;
		} else {
			$return_array['btn_remove'] = 0;
		}

		$return_array['html'] = $html;
		$return_array['row_count'] = $i;

		return json_encode($return_array);
	}
	public function duplicate_data($data, $table)
	{
		$this->db = DatabaseSecondConnection();
		$i = 0;
		$data_duplicat_Query = "";
		$numItems = count($data);
		foreach ($data as $datakey => $data_value) {
			if ($i == $numItems - 1) {
				$data_duplicat_Query .= 'LOWER(TRIM(REPLACE(' . $datakey . ', " ",""))) = "' . strtolower(trim(str_replace(' ', '', $data_value))) . '"';
			} else {
				$data_duplicat_Query .= 'LOWER(TRIM(REPLACE(' . $datakey . '," ",""))) = "' . strtolower(trim(str_replace(' ', '', $data_value))) . '" AND ';
			}
			$i++;
		}
		$sql = 'SELECT * FROM ' . $table . ' WHERE ' . $data_duplicat_Query;
		$secondDb = DatabaseDefaultConnection();
		$result = $secondDb->query($sql);
		if ($result->getNumRows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	// view_data 
	public function view_data()
	{
		if ($this->request->getPost("action") == "view") {
			$view_id = $this->request->getPost('view_id');
			$table_name = $this->request->getPost('table');
			$username = session_username($_SESSION['username']);
			$userEditdata = $this->MasterInformationModel->edit_entry2($username . "_" . $table_name, $view_id);
			$inquirydata = get_object_vars($userEditdata[0]);
			$inquiry_source_type_name = "";
			if (!empty($inquirydata['inquiry_source_type'])) {
				$inquiry_source_type = IdToFieldGetData('source', "id=" . $inquirydata['inquiry_source_type'] . "", "admin_master_inquiry_source");
				$inquiry_source_type_name = isset($inquiry_source_type['source']) && !empty($inquiry_source_type['source']) ? $inquiry_source_type['source'] : '';
			}
			if (isset($inquirydata['nxt_follow_up']) && !empty($inquirydata['nxt_follow_up'])) {
				$nxt_follow_up = followup_date_convert_indian_date($inquirydata['nxt_follow_up']);
			}
			$subscribtion_name = "";
			if (!empty($inquirydata['subscription'])) {
				$subscription = IdToFieldGetData('plan_name', "id=" . $inquirydata['subscription'] . "", "admin_subscription_master");
				$subscribtion_name = isset($subscription['plan_name']) && !empty($subscription['plan_name']) ? $subscription['plan_name'] : '';
			}
			$inquirydata['nxt_follow_up'] = $nxt_follow_up;
			$appointment_date = "";
			if (isset($inquirydata['appointment_date']) && !empty($inquirydata['appointment_date']) && $inquirydata['appointment_date'] != "0000-00-00 00:00:00") {
				$appointment_date = followup_date_convert_indian_date($inquirydata['appointment_date']);
			}
			$inquiry_details = "";
			if (isset($inquirydata['inquiry_type']) && !empty($inquirydata['inquiry_type'])) {
				$inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $inquirydata['inquiry_type'] . "", "admin_master_inquiry_type");
				$inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
			}
			$inquirydata['inquiry_type_name'] = $inquiry_details;

			$admin_details = "";

			if (isset($inquirydata['intrested_product']) && !empty($inquirydata['intrested_product'])) {

				$admin_product_name = IdToFieldGetData('product_name', "id=" . $inquirydata['intrested_product'] . "", "admin_product");

				$admin_details = isset($admin_product_name['product_name']) && !empty($admin_product_name['product_name']) ? $admin_product_name['product_name'] : '';
			}
			$inquirydata['int_product_details'] = $admin_details;


			$inquirydata['inquiry_source_type_name'] = $inquiry_source_type_name;
			$inquirydata['subs_name'] = $subscribtion_name;
			return json_encode($inquirydata, true);
		}
		// die();
	}
	// edit data 
	public function edit_data()
	{
		if ($this->request->getPost("action") == "edit") {
			$edit_id = $this->request->getPost('edit_id');
			$username = session_username($_SESSION['username']);
			$table_name = $this->request->getPost('table');
			$userEditdata = $this->MasterInformationModel->edit_entry2($username . "_" . $table_name, $edit_id);
			return json_encode($userEditdata, true);
		}
		die();
	}
	// update data 
	public function update_data()
	{
		$username = session_username($_SESSION['username']);
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$username = session_username($_SESSION['username']);
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$nxt_follow_up = '';
		if (isset($_POST['nxt_follow_up']) && !empty($_POST['nxt_follow_up'])) {
			$nxt_follow_up = $_POST['nxt_follow_up'];
		}
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			//print_r($_POST);
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				$update_data['nxt_follow_up'] = $nxt_follow_up;
				$isduplicate = $this->duplicate_data($update_data, $username . "_" . $table_name);
				if ($isduplicate == 0) {
					$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $username . "_" . $table_name);
					$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($username . "_" . $table_name);
					$departmentdisplaydata = json_decode($departmentdisplaydata, true);
					$response = 1;
				} else {
					return "error";
				}
			}
		}
		echo $response;
		die();
	}
	//delete
	public function delete_data()
	{
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$username = session_username($_SESSION['username']);
			$table_name = $this->request->getPost('table');
			$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($username . "_" . $table_name, $delete_id);
			//print_r($departmentdisplaydata);
			//die();
		}
		die();
	}
	public function visit_update_data()
	{
		$username = session_username($_SESSION['username']);
		$table_name = $this->request->getPost("table");
		//  $user_tblname=$username ."_".$table_name;
		//  $action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$remark = $_POST['remark'];
		$full_name = $_POST['full_name'];
		if (isset($_POST['intrested_product'])) {
			$intrested_product = $_POST['intrested_product'];
		} else {
			$intrested_product = "";
		}
		// $subscription = $_POST['subscription'];
		$budget = $_POST['budget'];
		$approx_buy = $_POST['approx_buy'];
		$inquiry_id = $_POST['inquiry_id'];
		$buying_as = $_POST['buying_as'];
		$nxt_follow_up = $_POST['nxt_follow_up'];
		$int_subscription = $_POST['int_subscription'];
		$visit_dateee = date('Y-m-d h:i:sa');;
		$visit_date = date('Y-m-d h:i:sa', strtotime($visit_dateee));
		// $property_type = $_POST['property_type'];
		// $purpose_buy = $_POST['purpose_buy'];
		// $visit_dateee = date('Y-m-d h:i:sa');;
		// $visit_date = date('Y-m-d h:i:sa',strtotime($visit_dateee));
		// $intrested_site = $_POST['intrested_site'];
		// $unit_no = $_POST['unit_no'];
		// $paymentref = $_POST['paymentref'];
		// $dp_amount = $_POST['dp_amount'];
		// $loan_amount = $_POST['loan_amount'];
		// pre($nxt_follow_up);
		// die();
		$today_date = date('Y-m-d h:i:sa');
		$nxt_follow_up = $this->request->getPost("nxt_follow_up");
		if (isset($nxt_follow_up) && !empty($nxt_follow_up)) {
			// $str = "-" . implode("', '", $nxt_follow_up) . "'";
			$nxt_follow['nxt_follow_up'] = date('Y-m-d h:i:sa', strtotime($nxt_follow_up));
		} else {
			$nxt_follow['nxt_follow_up'] = $today_date;
		}
		$isSiteVisit = isset($_POST['isSiteVisit']) && !empty($_POST['isSiteVisit']) ? $_POST['isSiteVisit'] : '';
		
		// // $revisit_date =  $_POST['revisit_date'];
		if ($isSiteVisit == 0 || $isSiteVisit =='' ) {
			$isSiteVisit_new_value = 4;
		} else if ($isSiteVisit >= 1) {
			$isSiteVisit_new_value = 11;
		} else {
			$isSiteVisit_new_value = $_POST['inquiry_status'];
		}
			
		if (isset($nxt_follow_up) && !empty($nxt_follow_up)) {
			// $str = "-" . implode("', '", $nxt_follow_up) . "'";
			$nxt_follow['nxt_follow_up'] = date('Y-m-d h:i:sa', strtotime($nxt_follow_up));
		} else {
			$nxt_follow['nxt_follow_up'] = $today_date;
		}
		// pre($nxt_follow);
		// die();
		$update_data = array();
		$status_array_log = array();
		$user_id = '';
		$response = 0;
		$result = array(
			'result' => 0,
			'msg' => 'Inquiry Status Not Updated!'
		);
		$session_data = get_session_data();
		if (isset($session_data) && !empty($session_data['id'])) {
			$user_id = $session_data['id'];
			if (isset($session_data['admin'])) {
				$userfullname = $session_data['name'];
			} else {
				$userfullname = $session_data['firstname'];
			}
		}
		$status_array = array(
			'user_id' => $user_id,
			'inquiry_id' => $inquiry_id,
			'remark' => $remark,
			'status_id' => $isSiteVisit_new_value,
			'nxt_follow_up' => $nxt_follow,
		);
		$response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_followup');
		$log_array = array(
			'user_id' => $user_id,
			'inquiry_id' => $inquiry_id,
			// 'remark' => $remark,
			// 'remark' => $remark,
			// 'nxt_follow_up' => $nxt_follow_up,
			'status_id' => $isSiteVisit_new_value,
			'inquiry_log' => 'Inquiry Demo By ' . $userfullname
		);
		$response_log = $this->MasterInformationModel->insert_entry2($log_array, $this->username . '_inquiry_log');
		$visit_array = array(
			'remark' => $remark,
			'full_name' => $full_name,
			'intrested_product' => $intrested_product,
			// 'subscription' => $subscription,
			// 'property_type' => $property_type,
			'budget' => $budget,
			// 'purpose_buy' => $purpose_buy,
			'approx_buy' => $approx_buy,
			'buying_as' => $buying_as,
			'nxt_follow_up' => $nxt_follow,
			'int_subscription' => $int_subscription,
			'visit_date' => $visit_date,
			// 'intrested_site' => $intrested_site,
			// 'unit_no' => $unit_no,
			// 'paymentref' => $paymentref,
			// 'dp_amount' => $dp_amount,
			// 'loan_amount' => $loan_amount,
			// 'revisit_date' => $revisit_date,
			'inquiry_status' => $isSiteVisit_new_value,
			// 'inquiry_log' => 'Inquiry visited By '.$userfullname
		);
		$result['result'] = 1;
		$departmentUpdatedata = $this->MasterInformationModel->update_entry2($inquiry_id, $visit_array, 'admin_all_inquiry');
		//increment audience table insert productwise inquiry_data=2 in 
			$inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
			$intrested_product = $inquiry_data['intrested_product'];
			$db_connection = DatabaseDefaultConnection();
			
			// Fetching data for inquiry_status = 2
			$inquiry_data_audience = array();
			$find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 11 AND intrested_product = $intrested_product";
			$find_audience = $db_connection->query($find_audience);
			$all_data_audience = $find_audience->getResultArray();
			
			// Fetching data for inquiry_status = 13
			$inquiry_dataas_audience = array();
			$find_audiences = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 4 AND intrested_product = $intrested_product";
			$find_audiences = $db_connection->query($find_audiences);
			$all_dataas_audience = $find_audiences->getResultArray();
			if ($result['result'] == 1 && $isSiteVisit_new_value == 11) {
				if (!empty($all_data_audience)&& isset($all_data_audience[0]['intrested_product']) && $all_data_audience[0]['intrested_product'] == $intrested_product && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
					$inquiry_data_audience['inquiry_id'] = $inquiry_id;
					$inquiry_data_audience['full_name'] = $inquiry_data['full_name'];
					$inquiry_data_audience['mobileno'] = $inquiry_data['mobileno'];
					$inquiry_data_audience['email'] = $inquiry_data['email'];
					$inquiry_data_audience['inquiry_status'] = 11;
					$inquiry_data_audience['intrested_product'] = $inquiry_data['intrested_product'];
					$inquiry_data_audience['name'] = $all_data_audience[0]['name'];
					$inquiry_data_audience['source'] = $all_data_audience[0]['source'];
					$inquiry_data_audience['inquiry_data'] = 2;
					$inquiry_data_audience['pages_name'] = $all_data_audience[0]['pages_name'];
					$inquiry_data_audience['facebook_syncro'] = 0;
					$response_audience = $this->MasterInformationModel->insert_entry2($inquiry_data_audience, $this->username . "_audience");
				}
			} elseif ($result['result'] == 1 && $isSiteVisit_new_value == 4) {
				if (!empty($all_dataas_audience)&& isset($all_dataas_audience[0]['intrested_product']) && $all_dataas_audience[0]['intrested_product'] == $intrested_product && isset($all_dataas_audience[0]['inquiry_data']) && $all_dataas_audience[0]['inquiry_data'] == 2) {
					$inquiry_dataas_audience['inquiry_id'] = $inquiry_id;
					$inquiry_dataas_audience['full_name'] = $inquiry_data['full_name'];
					$inquiry_dataas_audience['mobileno'] = $inquiry_data['mobileno'];
					$inquiry_dataas_audience['email'] = $inquiry_data['email'];
					$inquiry_dataas_audience['inquiry_status'] = 4;
					$inquiry_dataas_audience['intrested_product'] = $inquiry_data['intrested_product'];
					$inquiry_dataas_audience['name'] = $all_dataas_audience[0]['name'];
					$inquiry_dataas_audience['source'] = $all_dataas_audience[0]['source'];
					$inquiry_dataas_audience['inquiry_data'] = 2;
					$inquiry_dataas_audience['pages_name'] = $all_dataas_audience[0]['pages_name'];
					$inquiry_dataas_audience['facebook_syncro'] = 0;
					$response_audience1 = $this->MasterInformationModel->insert_entry2($inquiry_dataas_audience, $this->username . "_audience");
				}
			}
          //live audience auto increment code inquiry_data=3 in
			$inquiry_data_live = array();
			$find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 11 AND intrested_product = $intrested_product";
			$find_audience_live = $db_connection->query($find_audience_live);
			$all_data_live = $find_audience_live->getResultArray();
			
			$inquiry_dataas_live = array();
			$find_audiences_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 4 AND intrested_product = $intrested_product";
			$find_audiences_live = $db_connection->query($find_audiences_live);
			$all_dataas_live = $find_audiences_live->getResultArray();
			
			if ($result['result'] == 1 && $isSiteVisit_new_value == 11) {
				if (!empty($all_data_live) && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
					
					
					$existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
					// pre($inquiry_id);

					if (!empty($existing_entry)) {
						$inquiry_data_live['inquiry_status'] = 11;
						$inquiry_data_live['name'] = $all_data_live[0]['name'];
						$inquiry_data_live['source'] = $all_data_live[0]['source'];
						$inquiry_data_live['inquiry_data'] = 3;
						$inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
						$inquiry_data_live['facebook_syncro'] = 0;
						$response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
					} else {
							// pre('mital');
						// Insert new entry into the audience table
						$inquiry_data_live['inquiry_id'] = $inquiry_id;
						$inquiry_data_live['full_name'] = $inquiry_data['full_name'];
						$inquiry_data_live['mobileno'] = $inquiry_data['mobileno'];
						$inquiry_data_live['email'] = $inquiry_data['email'];
						$inquiry_data_live['inquiry_status'] = 11;
						$inquiry_data_live['intrested_product'] = $inquiry_data['intrested_product'];
						$inquiry_data_live['name'] = $all_data_live[0]['name'];
						$inquiry_data_live['source'] = $all_data_live[0]['source'];
						$inquiry_data_live['inquiry_data'] = 3;
						$inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
						$inquiry_data_live['facebook_syncro'] = 0;
						$response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
						
					}
				}
			} elseif ($result['result'] == 1 && $isSiteVisit_new_value == 4) {
				if (!empty($all_dataas_live) && isset($all_dataas_live[0]['inquiry_data']) && $all_dataas_live[0]['inquiry_data'] == 3) {
					$existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
					// pre($inquiry_id);
					if (!empty($existing_entry)) {
						$inquiry_dataas_live['inquiry_status'] = 4;
						$inquiry_dataas_live['name'] = $all_dataas_live[0]['name'];
						$inquiry_dataas_live['source'] = $all_dataas_live[0]['source'];
						$inquiry_dataas_live['inquiry_data'] = 3; 
						$inquiry_dataas_live['pages_name'] = $all_dataas_live[0]['pages_name'];
						$inquiry_dataas_live['facebook_syncro'] = 0;
						$response_alert2 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_dataas_live, $this->username . "_audience");
					} else {
							// pre('mital');
						// Insert new entry into the audience table
						$inquiry_dataas_live['inquiry_id'] = $inquiry_id;
						$inquiry_dataas_live['full_name'] = $inquiry_data['full_name'];
						$inquiry_dataas_live['mobileno'] = $inquiry_data['mobileno'];
						$inquiry_dataas_live['email'] = $inquiry_data['email'];
						$inquiry_dataas_live['inquiry_status'] = 4;
						$inquiry_dataas_live['intrested_product'] = $inquiry_data['intrested_product'];
						$inquiry_dataas_live['name'] = $all_dataas_live[0]['name'];
						$inquiry_dataas_live['source'] = $all_dataas_live[0]['source'];
						$inquiry_dataas_live['inquiry_data'] = 3;
						$inquiry_dataas_live['pages_name'] = $all_dataas_live[0]['pages_name'];
						$inquiry_dataas_live['facebook_syncro'] = 0;
						$response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_dataas_live, $this->username . "_audience");
						
					}
				}
			}
		echo $response;
		die();
	}
	public function change_value()
	{
		$this->db = DatabaseSecondConnection();
		$secondDb = DatabaseDefaultConnection();
		// Sanitize and validate the input before using it
		$iscountvisit = isset($_POST['iscountvisit']) ? intval($_POST['iscountvisit']) : 0;
		$new_value = $iscountvisit + 1;
		$isSiteVisit = isset($_POST['isSiteVisit']) ? intval($_POST['isSiteVisit']) : 0;
		// Determine the new value for $isSiteVisit
		if ($isSiteVisit == 0) {
			$isSiteVisit_new_value = 1;
		} else if ($isSiteVisit == 1) {
			$isSiteVisit_new_value = 2;
		} else {
			$isSiteVisit_new_value = 2;
		}
		$edit_value = isset($_POST["edit_value"]) ? intval($_POST["edit_value"]) : 0;
		$table_name = isset($_POST['table']) ? $_POST['table'] : '';
		$username = session_username($_SESSION['username']);
		// Sanitize the table_name to avoid SQL injection (you may use other validation methods as well)
		$table_name = $secondDb->escapeString($table_name);
		// Update the iscountvisit and isSiteVisit values in the database
		$query = "UPDATE " . $username . "_all_inquiry SET iscountvisit = $new_value, isSiteVisit = $isSiteVisit_new_value WHERE id = $edit_value";
		$result = $secondDb->query($query);
	}
	// public function change_value()
	// {
	// 	$this->db = DatabaseSecondConnection();
	// 	$secondDb = DatabaseDefaultConnection();
	// 	// Sanitize and validate the input before using it
	// 	$iscountvisit = isset($_POST['iscountvisit']) ? intval($_POST['iscountvisit']) : 0;
	// 	$new_value = $iscountvisit + 1;
	// 	$isSiteVisit = isset($_POST['isSiteVisit']) ? intval($_POST['isSiteVisit']) : 0;
	// 	// Determine the new value for $isSiteVisit
	// 	if ($isSiteVisit == 0) {
	// 		$isSiteVisit_new_value = 1;
	// 	} else if ($isSiteVisit == 1) {
	// 		$isSiteVisit_new_value = 2;
	// 	} else {
	// 		$isSiteVisit_new_value = 2;
	// 	}
	// 	$edit_value = isset($_POST["edit_value"]) ? intval($_POST["edit_value"]) : 0;
	// 	$table_name = isset($_POST['table']) ? $_POST['table'] : '';
	// 	$username = session_username($_SESSION['username']);
	// 	// Sanitize the table_name to avoid SQL injection (you may use other validation methods as well)
	// 	$table_name = $secondDb->escapeString($table_name);
	// 	// Update the iscountvisit and isSiteVisit values in the database
	// 	$query = "UPDATE " . $username . "_all_inquiry SET iscountvisit = $new_value, isSiteVisit = $isSiteVisit_new_value WHERE id = $edit_value";
	// 	$result = $secondDb->query($query);
	// }
}
