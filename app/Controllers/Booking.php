<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class Booking extends BaseController
{
	public function __construct()
	{
		helper('custom');
		$db = db_connect();
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->username = session_username($_SESSION['username']);
		$this->admin = 0;
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
	}

	public function created_at_date_convert_indian_dat_without_time($date, $format = 'd-m-Y')
	{
		// Ex - 08-12-2022 05:15 AM
		$formated_date = '';
		if (isset($date)) {
			date_default_timezone_set('Asia/Kolkata');
			// $covert_second = strtotime($date);
			// $formated_date = date ($format, $covert_second);
			$formated_date = date($format, strtotime('+9 hour +30 minutes', strtotime($date)));
		}
		return $formated_date;
	}
	public function check_username_availabilitys()
	{
		$username = $this->request->getPost("username");
		//$username = $requestBody->username;
		if ($username) {
			$result = $this->MasterInformationModel->get_username("paydone_data", $username);
			if ($result === true) {
				echo '<span style="color:red;"> <i class="fa-solid fa-xmark username_check"></i> Username already taken</span>';
			} else {
				echo '<span style="color:green;"><i class="fa-solid fa-check username_check"></i>Username Available</span>';
			}
		} else {
			echo '<span style="color:red;">You must enter username</span>';
		}
		die();
	}

	
	public function list_data()
	{
		// pre($this->request->getPost());
		$table = $this->request->getPost('table');
		$table_name = $this->username . $table;
		// pre($table_name);
		$action = $_POST['action'];
		$html = '';
		$row_count_html = '';
		$return_array = array(
			'row_count_html' => '',
			'html' => '',
			'total_page' => 0,
			'response' => 0
		);

		$db_connection = \Config\Database::connect('second');
		$user_id = $_SESSION['id'];
		$perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
		$pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		// $datastatus = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "'1','2','3','4','6','7','9','10','11','12','13'";

		$not_valid_status = '"0"';
		$getchild = '';
		$getchild = getChildIds($_SESSION['id']);
		$which_result = "";
		$booking_status = $_POST['booking_status'];

		// print_r($_POST);
		// die();

		$ajaxsearch_query = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['perPageCount']);
			unset($_POST['pageNumber']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			unset($_POST['booking_status']);

			foreach ($_POST as $k => $v) {
				// print_r($k);
				// die();


				//$linkget .=  $k."=".$v."&";
				if (!empty($v) && $k == "f_id") {

					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%"';
				}

				if (!empty($v) && $k == "full_name") {

					$ajaxsearch_query .= ' AND 	partyname  LIKE "%' . $v . '%"';
				}

				if (!empty($v) && $k == "f_inquiry_id") {

					$ajaxsearch_query .= ' AND inquiry_id  LIKE "%' . $v . '%"';
				}

				if (!empty($v) && $k == "f_mobileno") {

					$ajaxsearch_query .= ' AND mobileno  LIKE "%' . $v . '%"';
				}

				if (!empty($v) && $k == "f_switcher_amount") {

					$ajaxsearch_query .= ' AND switcher_amount  LIKE "%' . $v . '%"';
				}

				if (!empty($v) && $k == "f_product_name") {

					$ajaxsearch_query .= ' AND product_name  LIKE "%' . $v . '%"';
				}

				if (!empty($v) && $k == "f_product_plan") {

					$ajaxsearch_query .= ' AND product_plan  = "' . $v . '"';
				}

				if (!empty($v) && $k == "f_create_at") {
					$newDate = date("Y-m-d", strtotime($v));
					// $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
					$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%Y-%m-%d") = "' . $newDate . '" ';
				}

				if (!empty($v) && $k == "from_date") {
					$newDate = date("Y-m-d", strtotime($v));
					// $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
					$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%Y-%m-%d") >= "' . $newDate . '" ';
				}

				if (!empty($v) && $k == "to_date") {
					$newDate = date("Y-m-d", strtotime($v));
					//$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") <= '.$newDate.'';
					$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%Y-%m-%d") <= "' . $newDate . '" ';
				}
			}
		}


		// if($ajaxsearch_query)

		if (isset($_SESSION['project']) && !empty($_SESSION['project'])) {
			$projectsss = $_SESSION['project'];
			$projectss = explode(",", $projectsss);
			//$projectss = $_SESSION['project'];

		} else {
			$projectss = array();
		}

		$user_child = array();
		$user_parent = array();
		$sitewisechild = "SELECT t1.id AS child_id, t1.parent_id AS parent_id FROM " . $this->username . "_userrole t1 LEFT JOIN " . $this->username . "_userrole t2 ON t1.id = t2.parent_id WHERE t2.parent_id IS NULL";
		$cntdata = $db_connection->query($sitewisechild);
		$cntdatas = $cntdata->getResultArray();
		foreach ($cntdatas as $k => $v) {
			if (!empty($v['child_id'])) {
				$user_child[] = $v['child_id'];
				$user_parent[] = $v['parent_id'];
			}
		}

		$var_parent = array();
		if (isset($user_parent) && !empty($user_parent)) {
			$sitewiseexecutive = "SELECT * FROM " . $this->username . "_user where switcher_active ='active' AND role IN (" . implode(",", $user_parent) . ")";

			$cntdata = $db_connection->query($sitewiseexecutive);
			$cntdatasa = $cntdata->getResultArray();
			foreach ($cntdatasa as $k => $v) {
				$var_parent[] = $v['id'];
				//$var_parent[] = $v;

			}
		}

		if (isset($_POST['subscription_status'])) {
			$subscription_status = '`cancle_booking` = ' . $_POST["subscription_status"] . '';
		} else {
			$subscription_status = '';
		}


		if ($this->admin == 1) {
			if ($ajaxsearch_query == "") {
				if ($booking_status == 'live') {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE ' . $subscription_status;
				} else if ($booking_status == 'close') {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE `cancle_booking` = 1';
				} else if ($booking_status == 'request') {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE `cancle_booking` = 2';
				}
			} else {
				if ($booking_status == 'live') {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE ' . $subscription_status . ' ' . $ajaxsearch_query;
				} else if ($booking_status == 'close') {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE `cancle_booking` = 1 ' . $ajaxsearch_query;
				} else if ($booking_status == 'request') {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE `cancle_booking` = 2 ' . $ajaxsearch_query;
				}
			}
		} else {
			if (!empty($getchild)) {
				$getchilds = "'" . implode("', '", $getchild) . "'";
			} else {
				$getchilds = "'" . $_SESSION['id'] . "'";
			}
			if ($booking_status == 'live') {
				// ******************** ama sir e project name valu kidhu tu pan atyare sir na keva pramane changis kariyo chhe  date:05/07/2023 ************
				//	pre($var_parent);
				//	pre($_SESSION['id']);
				if (in_array($_SESSION['id'], $var_parent)) {
					//pre($projectsss);
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE ( project_name IN (' . $projectsss . ') ) AND  ' . $subscription_status . ' ' . $ajaxsearch_query;
				} else {
					// echo "dddd";
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE (assign_id ="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') ) AND ' . $subscription_status . ' ' . $ajaxsearch_query;
					//$sql = 'SELECT * FROM ' . $table_name . ' WHERE (assign_id ="' . $_SESSION['id'] . '"  ) AND cancle_booking = 0 '.$ajaxsearch_query; 
				}
				// else{
				//     $sql = 'SELECT * FROM ' . $table_name . ' WHERE (assign_id ="' . $_SESSION['id'] . '" )';
				// }


			} else if ($booking_status == 'close') {
				if (in_array($_SESSION['id'], $var_parent)) {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE (project_name IN (' . $projectsss . ') ) AND cancle_booking = 1 ' . $ajaxsearch_query;
				} else {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE (assign_id ="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') ) AND cancle_booking = 1 ' . $ajaxsearch_query;
				}
			} else if ($booking_status == 'request') {
				if (in_array($_SESSION['id'], $var_parent)) {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE (project_name IN (' . $projectsss . ') ) AND cancle_booking = 2 ' . $ajaxsearch_query;
				} else {
					$sql = 'SELECT * FROM ' . $table_name . ' WHERE (assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ')  ) AND cancle_booking = 2 ' . $ajaxsearch_query;
				}
			}
		}
		// pre($sql);
		// if ($this->admin == 1) {
		// 	if($ajaxsearch_query == ""){
		// 		$sql = 'SELECT * FROM ' .$table_name;
		// 	}else{
		// 		$sql = 'SELECT * FROM ' .$table_name . ' where 1 '. $ajaxsearch_query;
		// 	}
		// } else {
		// 	if (!empty($getchild)) {
		// 		$getchilds = "'" . implode("', '", $getchild) . "'";
		// 	} else {
		// 		$getchilds = "'" . $_SESSION['id'] . "'";
		// 	}
		// 	$sql = 'SELECT * FROM ' . $table_name . ' WHERE (assign_id ="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') )  '.$ajaxsearch_query;
		// }

		// $sql = "SELECT * FROM ". $table_name;
		$mail_sql = $sql;
		// pre($mail_sql);
		$result = $db_connection->query($mail_sql);
		if ($result->getNumRows() > 0) {
			$rowCount = $result->getNumRows();
			$total_no_of_pages = $rowCount;
			$second_last = $total_no_of_pages - 1;

			$pagesCount = ceil($rowCount / $perPageCount);
			$lowerLimit = ($pageNumber - 1) * $perPageCount;
			$sqlQuery = $sql . " ORDER BY `id` DESC LIMIT $lowerLimit , $perPageCount";
			$getresult = $db_connection->query($sqlQuery);
			$booking_all_data = $getresult->getResultArray();
			$rowCount_child = $getresult->getNumRows();
			$start_entries = $lowerLimit + 1;
			$last_entries = $start_entries + $rowCount_child - 1;
			$row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
			$i = 1;
			$loop_break = 0;
			$status = get_table_array_helper('master_inquiry_status');
			$projectss = isset($_SESSION['project']) && !empty($_SESSION['project']) ? $_SESSION['project'] : '';
			$projectss = explode(',', $projectss);

			foreach ($booking_all_data as $key => $value) {
				$username = session_username($_SESSION['username']);
				if (isset($value['booking_by'])) {
					$manager = user_id_to_full_user_data($value['by_ssm']);
					if (isset($manager['firstname'])) {
						$hastak['ssm'] = $manager['firstname'];
					}
					if ($value['booking_by'] == 'direct') {
						$exicutive = user_id_to_full_user_data($value['by_sse']);
						if (isset($exicutive['firstname'])) {
							$hastak['sse'] = $exicutive['firstname'];
						}
						// pre($manager);
					} else if ($value['booking_by'] == 'broker') {
						if ($value['by_broker'] != 0) {
							$broker = any_id_to_full_data($username . '_broker', $value['by_broker']);
							$hastak['broker'] = $broker['brokername'];
						}
					} else if ($value['booking_by'] == 'customer') {
						if ($value['by_customer'] != 0) {
							$customer = any_id_to_full_data($username . '_customer', $value['by_customer']);
							$hastak['customer'] = $customer['name'];
						}
					}
				}

				// $project = get_table_array_helper($this->username . '_project');
				if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
					$get_roll_id_to_roll_duty_var = array();
				} else {
					$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
				}

				$formatbooking_date = date('d-m-Y', strtotime($value['booking_date']));

				// jo booking delete karvanu hoy to aa te avse
				// <td>
				// 	<input class="checkbox mx-1 mt-2 list-checkbox" type="checkbox">
				// </td>

				// if (in_array('inquiry_booking', $get_roll_id_to_roll_duty_var) &&  in_array($value['project_name'], $projectss) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$html .= '<tr>
							<td class="today-follow-tab-content-td ee-todayfollow p-2 col-xxl-12" data-booking_id="' . $value['id'] . '"';
				if (in_array('subscription_request_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$html .= '	 data-bs-toggle="modal" data-bs-target="#booking_model"';
				};
				$html .= '		><div class="tfp-inquiry-list p-2" id="booking_view_model" data-booking_id="' . $value['id'] . '">
									<div class="inquiry-list-topbar d-flex align-items-center justify-content-between flex-wrap">
										<div class="inquiry-list-topbar-id-name d-flex align-items-center col-12 col-xl-4">
											<span><b>' . $value['id'] . '</b></span>
											<span class="mx-2">' . $value['partyname'] . '</span>
										</div>';
				if (in_array('subscription_request_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					if ($booking_status == 'live') {
						if ($value['cancle_booking'] == 1) {
							$html .= '';
						} else {
							$html .= '<div class="btn-secondary-rounded mx-1" id="booking_edit" data-booking_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#conversion_edit_form">
													<i class="bi bi-pencil fs-14"></i>
												</div>';
						}
					}
				}
				$html .= '</div>
									<div class="inquiry-list-content d-flex justify-content-start align-items-center flex-wrap inquery_view"
										data-view_id="">
										<div class="d-flex align-items-center col-12 col-sm-6 col-md-3">
											<p>Mobile no : </p>
											<span class="mx-1">' . $value['mobileno'] . '</span>
										</div>';
				$product_name = any_id_to_full_data($this->username . '_product', $value['product_name']);
				if (isset($value['product_plan'])) {
					$subscription_nameee = any_id_to_full_data($this->username . '_subscription_master', $value['product_plan']);
					$subscription_name = $subscription_nameee['plan_name'];
				} else {
					$subscription_name = '';
				}

				$html .= '<div class="d-flex align-items-center col-12 col-sm-6 col-md-3">
								<p class="">Product : </p>
								<span class="mx-1">' . $product_name['product_name'] . '</span>
							</div>
							<div class="d-flex align-items-center col-12 col-sm-6 col-md-3">
								<p>Plan : </p>
								<span class="mx-1">' . $subscription_name . '</span>
							</div>
							<div class="d-flex align-items-center col-12 col-sm-6 col-md-3">
								<p>Total Price : </p>
								<span class="mx-1">' . $value['total_price'] . '</span>
							</div>
							<div class="d-flex align-items-center col-12 col-sm-6 col-md-3">
								<p>Subscription Status : </p>';
				if ($value['cancle_booking'] == 0) {
					$html .= '<span style="color: green;" class="mx-1">Live';
				} else if ($value['cancle_booking'] == 1) {
					$html .= '<span style="color: red;" class="mx-1">Cancel';
				} else if ($value['cancle_booking'] == 2) {
					$html .= '<span style="color: #8B8000;" class="mx-1">Request';
				}
				$html .= '</span>
										</div>
							<div class="d-flex align-items-center col-12 col-sm-6 col-md-3">
								<p>Created at : </p>
								<span class="mx-1">' . $value['created_at'] . '</span>
							</div>
									</div>
								</div>
							</td>
						</tr>';
			}
			$return_array['row_count_html'] = $row_count_html;
			$return_array['html'] = $html;
			$return_array['total_page'] = $pagesCount;
			$return_array['response'] = 1;
		} else {
			$return_array['row_count_html'] = "Page 0 of 0";
			$return_array['total_page'] = 0;
			$return_array['response'] = 1;
			$return_array['html'] = '<td class="text-center">Data Not Found </td>';
		}
		echo json_encode($return_array);
		die();
	}

	public function project_to_get_unit()
	{
		$this->db = \Config\Database::connect();
		$post_data = $this->request->getPost();
		$field = $this->request->getPost("field");

		$field_value = $this->request->getPost("intrested_site");
		// print_r($field_value);
		// die();

		if ($this->request->getPost("action") == "get_data") {
			// $booked_unit_value = get_booked_unit_id_depend_project_id($field_value);
			$builder = $this->db->table($this->username . '_properties');
			$project_data = $builder->select('*')
				->where($field, $field_value)
				->get();

			$project_result = $project_data->getResult();
			echo $field_value;
			// $booking_table = get_table_array_helper($this->username.'_booking');
			$booking_table = get_booked_unit_id_depend_project_id($field_value, $this->username . '_booking');
			// pre($booking_table);


			if (!empty($project_result)) {

		?>
				<option value="">Select Unit</option>
				<?php
				foreach ($project_result as $key => $value_unit) {
					// die();
					// pre($project_result);
					// die();


					if (!empty($value_unit->unit_no)) {
						if (in_array($value_unit->unit_no, $booking_table)) {
				?>
							<option value="<?php echo $value_unit->unit_no; ?>" style="background-color: #65edaf6b; color: #000000; opacity: 1; pointer-events: none;"><?php echo $value_unit->unit_no; ?></option>
							<?php
						} else {
							if (in_array($value_unit->unit_no, $project_result)) {
							?>
								<option value="<?php echo $value_unit->unit_no; ?>"><?php echo $value_unit->unit_no; ?></option>
							<?php
							} else {
							?>
								<option value="<?php echo $value_unit->unit_no; ?>"><?php echo $value_unit->unit_no; ?></option>
						<?php
							}
						}
					} else { ?>
						<option value="">Not Found</option>
		<?php
					}
				}
				// pre($value_unit);
				// die();

			}
		}
		die();
	}

	public function project_dropdown_list_using_subtype()
	{
		$response = 0;
		$sub_product_type = $this->request->getPost("sub_product_type");
		$option_html = "";
		if ($this->request->getPost("get_data") == "project" && $sub_product_type != '') {
			$project = get_table_array_helper($this->username . '_project');
			// pre($project);
			$option_html .= '<option class="dropdown-item" value="">Select Interested Project</option>';
			foreach ($project as $project_key => $project_value) {
				// pre($project_value);
				if (isset($project_value['project_type']) && $project_value['project_type'] == $sub_product_type) {
					$option_html .= '<option class="dropdown-item" value="' . $project_value["id"] . '">' . $project_value["project_name"] . '</option>';
				}
			}
		}
		echo $option_html;
		die();
	}

	public function projectID_and_unitNo_to_get_Data()
	{

		if (isset($_POST['project_id']) && !empty($_POST['project_id']) && isset($_POST['unit_no']) && !empty($_POST['unit_no'])) {
			$project_id = $_POST['project_id'];
			$unit_no = $_POST['unit_no'];
			$array = array(
				'result_array' => '',
				'response' => false
			);
			$result_array = array();
			$table = $this->username . '_' . $_POST['table'];

			$this->db = \Config\Database::connect();
			$i = 0;

			$sql = 'SELECT * FROM ' . $table . ' WHERE `project_name` =' . $project_id . ' AND `unit_no` = ' . $unit_no;

			$result = $this->db->query($sql);
			if ($result->getNumRows() > 0) {
				$result_array = $result->getResultArray()[0];

				$array = array(
					'result_array' => $result_array,
					'response' => true
				);
			}
			return json_encode($array);
		}
		die();
	}

	public function duplicate_data_check_mobile_and_extra_data($tablename, $find_Data = array())
	{

		$this->db = \Config\Database::connect('second');

		$array['response'] = 0;
		$result = $this->db->table($tablename)->where($find_Data)->get();
		if ($result->getNumRows() > 0) {
			$booking_count = $result->getNumRows();
			$result_array = $result->getResultArray()[0];
			$array['result_array'] = $result_array;
			$array['booking_count'] = $booking_count;
			$array['response'] = 1;
		} else if ($result->getNumRows() == 0) {
			$array['response'] = 2;
		}
		return $array;
	}

	public function Booking_insert()
	{
	
	
		$img = "";
		$data = array();
		$aadhar_card_front = array();
		$customer_Photo = array();
		$aadhar_card_back = array();
		$pancard_photo = array();
		$kyc_check = array();
		$it_check = array();
		$res_check = array();
		$bank_check = array();
		$income_check = array();
		$duration_day = array();
		$payment_date = array();
		$amount = array();

		$mobile = $_POST['mobileno'];
		$partyname = $_POST['partyname'];
		$email = $_POST['email'];
		$houseno = $_POST['houseno'];
		$societyname = $_POST['societyname'];
		$area = $_POST['area'];
		$landmark = $_POST['landmark'];
		$code_country = $_POST['code_country'];
		$code_state = $_POST['code_state'];
		$code_city = $_POST['code_city'];
		$pincode = $_POST['pincode'];
		$aadharno = $_POST['aadharno'];
		$pancard_no = $_POST['pancard_no'];
		$product_name = $_POST['product_name'];
		$product_plan = $_POST['product_plan'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$price = $_POST['price'];
		$total_price = $_POST['total_price'];
		$inquiry_id22 = $_POST['inquiry_id'];
		$user_valid = $_POST['user_valid'];
		$gst = $_POST['gst'];
	
		// $owner_id = $_POST['owner_id'];

	



		$user_id = '';
		$return_result = array(
			'result' => 0,
			'msg' => 'Booking not Inserted!'
		);
		$userfullname = array(
			'fullname' => ''
		);
		$owner_id = $_POST['owner_id'];

		/*
			  $session_data = get_session_data();
			  if(isset($session_data) && !empty($session_data['user_id']))
			  {
				  $user_id = $session_data['user_id'];
				  $userfullname = user_id_to_full_user_data($user_id);
			  }
			  */
		if ($this->admin == 1) {
			$user_id = 0;
		} else {
			$user_id = $_SESSION['id'];
		}

		// $user_id = $this->admin;
		$userfullname = user_id_to_full_user_data($user_id);
		if ($this->admin == 1) {
			// if(isset($userfullname['username'])){
			$userfullnamee = $userfullname['username'];
		} else {
			$userfullnamee = $userfullname['firstname'];
		}

		$inquiry_id = $this->request->getpost("inquiry_id");
		if (!empty($this->request->getPost("amount"))) {
			$amount['amount'] = json_encode($this->request->getPost("amount"));
		}
		if (!empty($this->request->getPost("payment_date"))) {
			$payment_date['payment_date'] = json_encode($this->request->getPost("payment_date"));
		}
		if (!empty($this->request->getPost("duration_day"))) {
			$duration_day['duration_day'] = json_encode($this->request->getPost("duration_day"));
		}

		// pre($_SESSION['id']);
		// die();
		if (isset($_POST['booking_ssm']) && !empty($_POST['booking_ssm'])) {
			$asssign_id['assign_id'] = $_POST['booking_ssm'];
		} else {
			$asssign_id['assign_id'] = $_SESSION['id'];
		}



		// $my_data = array_merge($customer_Photo,$pancard_photo,$aadhar_card_back,$aadhar_card_front,$it_check,$kyc_check,$res_check,$bank_check,$income_check,$duration_day,$payment_date,$amount,$asssign_id);
		$my_data = array_merge($duration_day, $payment_date, $amount, $asssign_id);
		// pre($my_data);
		// die();
		$post_data = $this->request->getPost();
		$table_name = $this->username . '_' . $this->request->getPost("table");
		$customer_table = $this->username . '_customer';
		$action_name = $this->request->getPost("action");
		// $booking_date = $_POST['booking_date'];
		// $converted_booking_date = date('Y-m-d h:i:sa', strtotime($booking_date));
		$update_inquiry_data = array();

		// $booking_sse = $_POST['booking_sse'];
		// $booking_ssm = $_POST['booking_ssm'];
		// $booking_broker = $_POST['booking_broker'];
		// $booking_customer = $_POST['booking_customer'];
		// $booking_by = $_POST['gridRadios'];
		if (isset($_POST['plane_price'])) {
			$price = str_replace(',', '', $_POST['plane_price']);
		}

		if ($this->request->getPost("action") == "insert") {

			unset($_POST['action']);
			unset($_POST['table']);
			// unset($_POST['kyc_check']);
			// unset($_POST['it_check']);
			// unset($_POST['res_check']);
			// unset($_POST['bank_check']);
			// unset($_POST['income_check']);
			unset($_POST['amount']);
			unset($_POST['payment_date']);
			unset($_POST['duration_day']);
			unset($_POST['booking_date']);
			unset($_POST['booking_sse']);
			unset($_POST['booking_ssm']);
			unset($_POST['booking_broker']);
			unset($_POST['booking_customer']);
			unset($_POST['gridRadios']);

			if (!empty($_POST)) {
				// $customer_data_array_du = array(
				// 	'mobileno' => $_POST['mobileno'],
				// );
				// $inquiry_all_data = $this->MasterInformationModel->edit_entry2($this->username . '_all_inquiry', $_POST['inquiry_id']);
				// $customer_duplicate = $this->duplicate_data_check_mobile_and_extra_data($customer_table,$customer_data_array_du);
				// pre($inquiry_all_data);
				// die();
				// if($customer_duplicate['response'] == 2){
				// 	foreach($inquiry_all_data as $kk => $vv){
				// 		// pre($vv);
				// 	}
				// 	// $customer_data_array = array(
				// 	// 	'inquiry_id' => $vv->id,
				// 	// 	'assign_id' => $_SESSION['id'],
				// 	// 	'user_id' => $_SESSION['id'],
				// 	// 	'name' => $vv->full_name,
				// 	// 	'mobileno' => $vv->mobileno,
				// 	// 	'dob' => $vv->dob,
				// 	// 	'anni_date' => $vv->anni_date,
				// 	// 	'houseno' => $vv->houseno,
				// 	// 	'socity' => $vv->society,
				// 	// 	'area' => $vv->area,
				// 	// 	'city' => $vv->city,
				// 	// 	'state' => $vv->state,
				// 	// 	'country' => $vv->country,
				// 	// 	'project_name' => $post_data['project_name'],
				// 	// 	// 'project_type' => $post_data['property_type'],
				// 	// 	'unit_no' => $post_data['unitno'],
				// 	// 	'intrested_area' => $vv->intrested_area_name,
				// 	// );
				// 	// if(!empty($customer_data_array) && is_array($customer_data_array)){
				// 	// 	$response = $this->MasterInformationModel->insert_entry($customer_data_array,$customer_table);
				// 	// }else{
				// 	// 	echo 'data not insert in customer table';
				// 	// }


				// 	$insert_log = array(
				// 		'inquiry_id' => $vv->id,
				// 		'inquiry_log' => 'Booking add By ' . $userfullnamee,
				// 		'status_id' => '12',
				// 		'user_id' => $user_id
				// 	);
				// 	if(!empty($insert_log) && is_array($insert_log)){
				// 		$response = $this->MasterInformationModel->insert_entry2($insert_log,$this->username.'_inquiry_log');
				// 	}else{
				// 		echo 'data not insert in log table';
				// 	}

				// 	// pre($response);
				// }
				// die();

				

				$insert_data = $_POST;
				// $insert_data['plane_price'] = $price;
				$insert_data['user_id'] = $_SESSION['id'];
				// $insert_data['booking_date'] = $converted_booking_date;
				// $insert_data['by_sse'] = $booking_sse;
				// $insert_data['by_ssm'] = $booking_ssm;
				// $insert_data['by_broker'] = $booking_broker;
				// $insert_data['by_customer'] = $booking_customer;
				// $insert_data['booking_by'] = $booking_by;
				$find_Data_array = array(
					"mobileno" => $_POST['mobileno'],
					// "project_name" => $_POST['project_name'],
					// "unitno" => $_POST['unitno'],
					// "inquiry_id" => $_POST[]
				);

				$isduplicate = $this->duplicate_data_check_mobile_and_extra_data($table_name, $find_Data_array);
				if ($isduplicate['response'] == 2) {
					// $booking_status = array();
					// $booking_status['cancle_booking'] = 2;
					// $my_data_with_image = array_merge($my_data, $insert_data, $booking_status);
					// $response = $this->MasterInformationModel->insert_entry2($my_data_with_image, $table_name);
					// if ($response) {

						// pre($converted_booking_date);
						// die();
						$update_inquiry_data = array(
							'inquiry_status' => '14',
							'user_type' => '3',
							// 'booking_date' => $converted_booking_date,
						);
						// if($booking_sse != 0 && $booking_ssm != 0){
						// 	$update_inquiry_data['owner_id'] = $booking_sse;
						// }
						$convert_people_to_customer = $this->MasterInformationModel->update_entry2($inquiry_id, $update_inquiry_data, $this->username . '_all_inquiry');
						$user_id22 = 0;
						$assign_id22 = 0;
						$owner_id22 = 0;
						if(!$this->admin == 1){
							$user_id22 = $_SESSION['id'];
							$assign_id22 = $_SESSION['id'];
							$owner_id22 = $_SESSION['id'];

						}
						$status_name = status_id_to_full_status_data(12, true);
						$status_array = array(
							'mobileno' => $mobile,
							'partyname' => $partyname,
							'email' => $email,
							'houseno' => $houseno,
							'societyname' => $societyname,
							'area' => $area,
							'landmark' => $landmark,
							'code_country' => $code_country,
							'code_state' => $code_state,
							'code_city' => $code_city,
							'pincode' => $pincode,
							'pancard_no' => $pancard_no,
							'aadharno' => $aadharno,
							'product_name' => $product_name,
							'product_plan' => $product_plan,
							'username' => $username,
							// 'password' => $password,
							'password' => encryptPass($password),
							'price' => $price,
							'total_price' => $total_price,
							'inquiry_id' => $inquiry_id22,
							'owner_id' => $owner_id22,
							'assign_id' => $assign_id22,
							'user_id' => $user_id22,
							'cancle_booking'=> 2,
							'gst'=>$gst,
				
						);
						$response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_booking');

						$subscribtion_array = array(
							'mobile' => $mobile,
							'name' => $partyname,
							'email' => $email,
							'username' => $username,
							'password' => encryptPass($password),
							'price' => $price,
							'total_amount' => $total_price,
							'plan_id' => $product_name,
							'user_valid'=>$user_valid,
							'gst'=>$gst,

							// 'houseno' => $houseno,
							// 'societyname' => $societyname,
							// 'area' => $area,
							// 'landmark' => $landmark,
							// 'code_country' => $code_country,
							// 'code_state' => $code_state,
							// 'code_city' => $code_city,
							// 'pincode' => $pincode,
							// 'pancard_no' => $pancard_no,
							// 'aadharno' => $aadharno,
							// 'product_plan' => $product_plan,
						
							'inquiry_id' => $inquiry_id22,
							// 'owner_id' => $owner_id22,
							// 'assign_id' => $assign_id22,
							// 'user_id' => $user_id22,
				
						);
						$subscribtion_array_log = $this->MasterInformationModel->insert_entry($subscribtion_array, 'paydone_data');

						$return_result['result'] = 1;
						$return_result['msg'] = "Booking successfully";
						 //increment audience
						$inquiry_data_audience = array();
						$inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
						$intrested_product = $inquiry_data['intrested_product'];
						$find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 12 AND intrested_product = $intrested_product";
						$db_connection = \Config\Database::connect('second');
						$find_audience = $db_connection->query($find_audience);
						$all_data_audience = $find_audience->getResultArray();
						if (!empty($all_data_audience)&& isset($all_data_audience[0]['intrested_product']) && $all_data_audience[0]['intrested_product'] == $intrested_product && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
							if ($result['response'] == 1) {
								$inquiry_data_audience['inquiry_id'] = $inquiry_id;
								$inquiry_data_audience['full_name'] = $inquiry_data['full_name'];
								$inquiry_data_audience['mobileno'] = $inquiry_data['mobileno'];
								$inquiry_data_audience['email'] = $inquiry_data['email'];
								$inquiry_data_audience['inquiry_status'] =12;
								$inquiry_data_audience['intrested_product'] = $inquiry_data['intrested_product'];
								$inquiry_data_audience['name'] = $all_data_audience[0]['name'];
								$inquiry_data_audience['source'] = $all_data_audience[0]['source'];
								$inquiry_data_audience['inquiry_data'] = 2;
								$response_audience = $this->MasterInformationModel->insert_entry2($inquiry_data_audience, $this->username . "_audience");
							}
						}
                      //live audience auto increment code
						    $inquiry_data_live = array();
                            $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 12 AND intrested_product = $intrested_product";
                            $find_audience_live = $db_connection->query($find_audience_live);
                            $all_data_live = $find_audience_live->getResultArray();
                    
                        if (!empty($all_data_live) && isset($all_data_live[0]['intrested_product']) && $all_data_live[0]['intrested_product'] == $intrested_product && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                            if ($result['response'] == 1) {
                            $inquiry_data_live['inquiry_status'] = 12;
                            $inquiry_data_live['name'] = $all_data_live[0]['name'];
                            $inquiry_data_live['source'] = $all_data_live[0]['source'];
                            $inquiry_data_live['inquiry_data'] = 3;
                            $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                        }
                    }
					// } else {
					// 	// return "error";
					// 	$return_result['result'] = 0;
					// 	$return_result['not_insert'] = 0;
					// 	$return_result['msg'] = "Booking Not Inserted";
					// }
				} else {
					$return_result['result'] = 0;
					$return_result['duplicate'] = 0;
					$return_result['msg'] = "Booking Duplicate data";
				}
			}
		}
		echo json_encode($return_result);

		die();
	}

	public function booking_view_data()
	{
		if ($this->request->getPost("action") == "view") {
			$edit_id = $this->request->getPost('edit_id');
			$username = session_username($_SESSION['username']);
			$table_name = $this->request->getPost('table');
			$userEditdata = $this->MasterInformationModel->edit_entry2($username . "_" . $table_name, $edit_id);
			$address = '';
			// amount table view
			if (isset($userEditdata) && !empty($userEditdata)) {
				$booking_amount_table = '';
				foreach ($userEditdata as $k => $v) {

					$product_name1 = any_id_to_full_data($this->username . '_product', $v->product_name);
					$product_plan1 = any_id_to_full_data($this->username . '_subscription_master', $v->product_plan);
					$product_name = $product_name1['product_name'];
					$product_plan = $product_plan1['plan_name'];

					$address .= $v->houseno . ', ';
					$address .= $v->societyname . ', ';
					if ($v->area == $v->landmark) {
						$address .= $v->area . ', ';
					} else {
						$address .= $v->area . ', ';
						$address .= $v->landmark . ', ';
					}
					$address .= $v->code_city . ', ';
					$address .= $v->code_state . ', ';
					$address .= $v->code_country . ', ';

					$user_data = user_id_to_full_user_data($v->assign_id);
					if (isset($user_data['firstname'])) {
						$v->assign_id = $user_data['firstname'];
					} else {
						$v->assign_id = '';
					}
					$v->address = $address;
					$v->product_name = $product_name;
					$v->product_plan = $product_plan;
				}
			}
			// $project_name = project_id_to_full_project_data($v->project_name);

			// pre($userEditdata);
			// $userEditdata['project_name'] = $project_name['project_name'];
			// $userEditdata['booking_date'] = followup_date_convert_indian_date($v->booking_date);
			// $userEditdata['booking_date'] = date('d-m-Y', strtotime($v->booking_date));
			return json_encode($userEditdata, true);
		}

		die();
	}

	public function booking_edit()
	{
		if ($this->request->getPost('action') == 'edit') {
			$booking_id = $this->request->getPost('view_id');
			$table = $this->request->getPost('table');

			$userEditdata = $this->MasterInformationModel->edit_entry2($this->username . "_" . $table, $booking_id);

			if (isset($userEditdata) && !empty($userEditdata)) {
				$booking_amount_table = '';
				foreach ($userEditdata as $k => $v) {
					$amount = str_replace(array('["', '"]'), '', $v->amount);
					$payment_date = str_replace(array('["', '"]'), '', $v->payment_date);
					$duration_day = str_replace(array('["', '"]'), '', $v->duration_day);
					$amount_1 = explode('","', $amount);
					$payment_date_1 = explode('","', $payment_date);
					$duration_day_1 = explode('","', $duration_day);
					// pre($v);
					// pre($duration_day_1);
					foreach ($payment_date_1 as $ak => $av) {
						$padate = '';
						if (!empty($av)) {
							// $padate = $av;
							$padate = date('d-m-Y', strtotime($av));
						}
						// $booking_date = followup_date_convert_indian_date($v->booking_date,);
						$booking_date = date('d-m-Y', strtotime($v->booking_date));
						$duration_days = " ";
						if ($duration_day_1[$ak] != '') {
							$duration_days = $duration_day_1[$ak];
						}
						// pre($duration_days);
						// else {
						// 	$duration_days = 0;
						// }

						if (is_array($amount_1)) {
							if (isset($amount_1[$ak])) {
								$amountdata_val = $amount_1[$ak];
							} else {
								$amountdata_val = "";
							}
						} else {
							$amountdata_val = $amount_1;
						}
						// pre($duration_days);

						if ($ak == 0) {
							$booking_amount_table .= '<div class="amount_date amount_partition row g-2 align-items-end" >';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6">';
							$booking_amount_table .= '<label for="p_shortname" class="form-label form-labell">Amount :</label>';
							$booking_amount_table .= '<div class="d-flex"><input type="text" class="form-control px-3 py-1 text-black amount" id="amount" name="amount[]" placeholder="Amount" value="' . $amountdata_val . '" required=""></div>';
							$booking_amount_table .= '</div>';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6">';
							$booking_amount_table .= '<label for="p_shortname" class="form-label form-labell">Date :</label>';
							$booking_amount_table .= '<div class="d-flex"><input type="text" class="form-control px-3 py-1 text-black m-date payment_date" onclick="amountDate()" id="payment_date" name="payment_date[]" placeholder="payment date" value="' . $padate . '" required="" data-dtp="dtp_SPKMK"></div>';
							$booking_amount_table .= '</div>';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6">';
							$booking_amount_table .= '<label for="p_shortname" class="form-label form-labell">Duration in days :</label>';
							$booking_amount_table .= '<div class="d-flex"><input type="text" class="form-control px-3 py-1 text-black days duration_day" id="duration_day" name="duration_day[]" placeholder="Duration in days" value="' . $duration_days . '" required=""></div>';
							$booking_amount_table .= '</div>';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6"><div class="view-model-btn mx-auto amount_partition_add"><i class="bi bi-plus"></i></div></div>';
							$booking_amount_table .= '</div>';
						} else {
							$booking_amount_table .= '<div class="amount_date amount_partition row g-2 align-items-end" >';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6">';
							$booking_amount_table .= '<label for="p_shortname" class="form-label form-labell">Amount :</label>';
							$booking_amount_table .= '<div class="d-flex"><input type="text" class="form-control px-3 py-1 text-black amount" id="amount" name="amount[]" placeholder="Amount" value="' . $amountdata_val . '" required=""></div>';
							$booking_amount_table .= '</div>';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6">';
							$booking_amount_table .= '<label for="p_shortname" class="form-label form-labell">Date :</label>';
							$booking_amount_table .= '<div class="d-flex"><input type="text" class="form-control px-3 py-1 text-black m-date payment_date" onclick="amountDate()" id="payment_date" name="payment_date[]" placeholder="payment date" value="' . $padate . '" required="" data-dtp="dtp_SPKMK"></div>';
							$booking_amount_table .= '</div>';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6">';
							$booking_amount_table .= '<label for="p_shortname" class="form-label form-labell">Duration in days :</label>';
							$booking_amount_table .= '<div class="d-flex"><input type="text" class="form-control px-3 py-1 text-black days duration_day" id="duration_day" name="duration_day[]" placeholder="Duration in days" value="' . $duration_days . '" required=""></div>';
							$booking_amount_table .= '</div>';
							$booking_amount_table .= '<div class="col-lg-3 col-md-4 col-sm-6"><div class="view-model-btn mx-auto amount_partition_remove"><i class="bi bi-dash"></i></div></div>';
							$booking_amount_table .= '</div>';
						}
					}
				}
			}

			// pre($userEditdata);
			$userEditdata['amount_partetion'] = $booking_amount_table;
			$userEditdata['booking_date'] = $booking_date;
			return json_encode($userEditdata, true);
		}
	}

	public function booking_update()
	{
		$this->db = \Config\Database::connect('second');

		$return_result = array();

		if ($this->admin == 1) {
			$user_id = 0;
		} else {
			$user_id = $_SESSION['id'];
		}

		$table = $this->request->getPost('table');
		$update_id = $this->request->getPost('update_id');
		$table_fullname = $this->username . '_' . $table;
		$total_price_withour_comas = str_replace(',', '', $_POST['total_price']);
		if ($this->request->getPost('action') == 'update') {
			$post_data = $this->request->getPost();
			unset($post_data['action']);
			unset($post_data['table']);
			unset($post_data['update_id']);
			unset($post_data['inquiry_id']);

			if (!empty($post_data)) {
				$update_data = $post_data;
				$update_data['total_price'] = $total_price_withour_comas;
				$update_data['cancle_booking'] = 0;
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_fullname);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_fullname);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;

				$return_result['result'] = $response;
				$return_result['msg'] = 'Booking Updated';
			} else {
				$return_result['result'] = 0;
				$return_result['not_update'] = 0;
				$return_result['msg'] = 'Booking Not Update!';
			}
		}
		echo json_encode($return_result);

		die();
	}


	public function booking_cancle()
	{
		// pre($_POST);
		$this->db = \Config\Database::connect('second');
		if ($this->request->getPost('action') == 'cancle') {
			$update_id = $this->request->getPost('id');
			$table = $this->request->getPost('table');
			$table_name = $this->username . $table;

			$cancle_id = 1;

			$sql = "UPDATE " . $table_name . " SET cancle_booking = " . $cancle_id . " WHERE id = " . $update_id;

			$query = $this->db->query($sql);

			if (isset($_POST['request']) && $this->request->getPost('request') == 'cancel_request') {
				$inquiry_id = $this->request->getPost('inquiry_id');
				$sql = 'SELECT * FROM ' . $this->username . '_followup WHERE `inquiry_id` = ' . $inquiry_id . ' ORDER BY `id` DESC';
				$query = $this->db->query($sql);
				$query = $query->getResultArray();
				$status_id = array();
				foreach ($query as $key => $value) {
					if ($value['status_id'] != '12') {
						$status_id[] = $value['status_id'];
					}
				}
				if (isset($status_id[0])) {
					$s_id = $status_id[0];
				} else {
					$s_id = 1;
				}

				$update_inquiry = array(
					'inquiry_status' => $s_id,
				);
				$query = $this->MasterInformationModel->update_entry2($inquiry_id, $update_inquiry, $this->username . '_all_inquiry');

				$log_array = array(
					'inquiry_id' => $inquiry_id,
					'inquiry_log' => 'Conversion is Decline by ' . $this->username,
					'status_id' => 12,
					'user_id' => $_SESSION['id']
				);
				$sql2 = $this->MasterInformationModel->insert_entry2($log_array, $this->username . '_inquiry_log');
			} else {
				$inquiry_id = $this->request->getPost('inquiry_id');
				$log_array = array(
					'inquiry_id' => $inquiry_id,
					'inquiry_log' => 'Conversion is Decline by ' . $this->username,
					'status_id' => 12,
					'user_id' => $_SESSION['id']
				);
				$sql2 = $this->MasterInformationModel->insert_entry2($log_array, $this->username . '_inquiry_log');
			}

			echo $query;

			return $query;
		}
	}

	public function approve_conversion()
	{
		$update_id = $this->request->getPost('edit_id');
		$inquiry_id = $this->request->getPost('inquiry_id');
		$table = $this->request->getPost('table');
		$action = $this->request->getPost('action');
		$this->db = \Config\Database::connect('second');

		if (!empty($update_id)) {
			if ($action == 'approve') {
				if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
					$user_id = 0;
				} else {
					$user_id = $_SESSION['id'];
				}
				$table_name = $this->username . '_' . $table;
				// pre($table_name);
				// die();
				$cancle_id = 0;
				$sql = "UPDATE " . $table_name . " SET cancle_booking = " . $cancle_id . " WHERE id = " . $update_id;
				// pre($sql);
				// die();
				$query = $this->db->query($sql);

				$update_inquiry_data = array(
					'inquiry_status' => '12',
				);
				$convert_people_to_customer = $this->MasterInformationModel->update_entry2($inquiry_id, $update_inquiry_data, $this->username . '_all_inquiry');

				$followup_data = array(
					'inquiry_id' => $inquiry_id,
					'user_id' => $user_id,
					'status_id' => 12,
					'remark' => 'Conversion Approve By' . $this->username,
				);
				$response_status_log = $this->MasterInformationModel->insert_entry2($followup_data, $this->username . '_followup');

				$log_data = array(
					'inquiry_id' => $inquiry_id,
					'inquiry_log' => 'Conversion is approved by ' . $this->username,
					'status_id' => 12,
					'user_id' => $_SESSION['id']
				);
				$sql2 = $this->MasterInformationModel->insert_entry2($log_data, $this->username . '_inquiry_log');

				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}
}
