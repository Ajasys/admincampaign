<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class DashboardController extends BaseController
{


	public function __construct()
	{
		helper('custom');
		$db = db_connect('second');
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->admin = 0;
		$this->username = session_username($_SESSION['username']);
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
	}

	public function get_followup_tab_fresh()
	{
		// $session = session();
		// pre($session);
		// die();
		$return_array = array(
			'result' => '0',
			'row_count' => '0',
			'followup_data_html' => '<p style="text-align:center;">Data Not Found </p>',
		);

		$db_connection = \Config\Database::connect('second');
		$full_username = session_username($_SESSION['username']);
		$tableName = $full_username . '_followup';
		if (isset($this->admin) && $this->admin == 1) {
			$user_id = 0;
		} else {
			$user_id = $_SESSION['id'];
		}
		//$not_valid_status = '"0"';

		if ($_POST['date_dashboard']) {

			$today_datee = $_POST['date_dashboard'];

			$today_date = date('Y-m-d', strtotime($today_datee));
		} else {

			$today_date = date('Y-m-d');
		}
		$user_query = '';

		//if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && isset($_POST['followup_user_list']) && !empty($_POST['followup_user_list']) && $_POST['followup_user_list'] != 0){

		if (isset($this->admin) && $this->admin == 1 && empty($_POST['followup_user_list']) && $_POST['followup_user_list'] == 0) {

			//$followup_get_user_id = $_POST['followup_user_list'];

			$user_query .= 'WHERE ';
		} else if (isset($_POST['followup_user_list']) && !empty($_POST['followup_user_list']) && $_POST['followup_user_list'] != 0) {

			$followup_get_user_id = $_POST['followup_user_list'];

			$user_query .= 'WHERE user_id IN ("' . $followup_get_user_id . '") AND';
		} else {

			$all_gm_under_people = '';

			$all_gm_under_people = getChildIds($user_id);

			$array_push = array_push($all_gm_under_people, $user_id);

			$all_gm_under_people_implode = "'" . implode("', '", $all_gm_under_people) . "'";

			$user_query .= 'WHERE user_id IN (' . $all_gm_under_people_implode . ') AND';
		}

		//$not_valid_status = "0","1";

		$sql = "SELECT *

				FROM " . $tableName . "

				" . $user_query . " DATE_FORMAT(created_at, '%Y-%m-%d') = DATE_FORMAT('" . $today_date . "', '%Y-%m-%d') AND 

				 status_id NOT IN ('0')

				ORDER BY id DESC";





		$result = $db_connection->query($sql);



		if ($result->getNumRows() > 0) {



			$rowCount = $result->getNumRows();



			$followup_data = $result->getResultArray();



			$html = '';

			$count_followup = 0;

			$status = get_table_array_helper('master_inquiry_status');



			foreach ($followup_data as $key => $value) {



				// $created_date_check = loacal_date_to_formate_date_type_3($value['created_at'] , "Y-m-d");

				// $created_date_check = $value['created_at'];

				// $time = strtotime($created_date_check);

				//$created_date_check = created_at_date_convert_indian_date($value['created_at'] , "Y-m-d");

				$created_date_check = date('Y-m-d', strtotime($value['created_at']));

				// pre($created_date_check);

				// pre($today_date);



				// die();

				// $newformat = date('Y-m-d', $time);



				if (isset($created_date_check) && !empty($created_date_check) && $created_date_check == $today_date) {

					//pre($today_date);

					$inquiry_unique_id = '';

					//$created_date = created_at_date_convert_indian_date($value['created_at']);



					// $created_date = loacal_date_to_formate_date_type_2($value['created_at']);

					$inquiry_data = inquiry_id_to_full_inquiry_data($value['inquiry_id']);



					if (isset($inquiry_data) && !empty($inquiry_data)) {

						$inquiry_unique_id = $inquiry_data['id'];
					}

					$inquiry_status = '';

					// pre($value['status_id']);

					if (isset($value['status_id']) && !empty($value['status_id'])) {

						if (isset($status[$value['status_id']])) {



							$inquiry_status = $status[$value['status_id']]['inquiry_status'];
						}
					}

					$remark = $value['remark'];

					// pre($remark);

					// die();

					// $user_fullname = user_id_to_full_user_data($value['user_id']);



					// if (!empty($user_fullname)) {

					//     // $usernamee = $user_fullname['firstname'];

					//     if ($value['user_id'] == 0) {

					//         $usernamee = $user_fullname['name'];

					//     } else {

					//         $usernamee = $user_fullname['firstname'];

					//     }

					// } else {

					//     $usernamee = '';

					// }



					$usernamee = '';

					$session_data = get_session_data();

					// pre($session_data);

					// die();



					$user_data = user_id_to_full_user_data($value['user_id']);

					if ($value['user_id'] == 0) {

						if (isset($user_data['name'])) {

							$usernamee = $user_data['name'];
						}
					} else {

						if (isset($user_data['firstname'])) {

							$usernamee = $user_data['firstname'];
						}
					}

					// pre($usernamee);

					// 	die();

					$username = session_username($_SESSION['username']);

					$inquiry_type_name = "";

					$inquiry_typeas = IdToFieldGetData('inquiry_type', 'id=' . $value['inquiry_id'], $username . '_all_inquiry');



					if (isset($inquiry_typeas['inquiry_type']) && !empty($inquiry_typeas['inquiry_type'])) {

						$inquiry_type = IdToFieldGetData('inquiry_details', 'id=' . $inquiry_typeas['inquiry_type'], $username . '_master_inquiry_type');

						if (isset($inquiry_type['inquiry_details']) && !empty($inquiry_type['inquiry_details'])) {

							$inquiry_type_name = $inquiry_type['inquiry_details'];
						} else {

							$inquiry_type_name = "";
						}
					}





					// $inquiry_type = inquiry_id_to_get_inquiry_type($inquiry_type['inquiry_type']);



					//$created_dates = loacal_date_to_formate_date_type_3($created_date);  

					// pre($value['nxt_follow_up']);

					// $created_dates = created_at_date_convert_indian_date($value['created_at'] ,"j-n-y h:i");
					$created_dates = date('d-m-Y h:i', strtotime($value['created_at']));
					if ($value['nxt_follow_up']) {

						$nxtfollowdate = followup_date_convert_indian_date($value['nxt_follow_up']);

						//    pre($nxtfollowdate);

					} else {

						$nxtfollowdate = '';
					}





					//if($inquiry_status != 'Edited' || $inquiry_status != 'Transfer Ownership' || $inquiry_status != 'Assign Followup'){



					$html .= '<li class="event-list" style="border-bottom: 3px dashed #f6f6f6;">

							<a href="/allinquiry?action=filter&filter_id=' . $value['inquiry_id'] . '">

    						

    						<div class="d-flex">

								<div class="event-timeline-dot me-1 pt-1"">

									<i class="bx bx-right-arrow-circle font-size-18" style="color:#b55dcd"></i>

								</div>

    							<div class="flex-shrink-0 mb-0 pt-2" style="width:10%;">

    								<h5 class="user_created_date_css mb-0 text-body me-2" style="font-size: 9px;">' . $created_dates . '</h5>

    							</div>

    							<div class="flex-grow-1 follow-grows">

    								<div>

										<i class="bx bx-right-arrow-alt font-size-16  align-middle " style="color:#b55dcd"></i>

										<span style="font-size: 11px;"class="text-body">' . $value['inquiry_id'] . '</span>



										<i class="bx bx-right-arrow-alt font-size-16  align-middle ms-1"style="color:#b55dcd"></i>

										<span style="font-size: 12px;"class="text-body">' . $usernamee . '</span>

										<i class="bx bx-right-arrow-alt font-size-16  align-middle ms-1"style="color:#b55dcd"></i>';



					if (!empty($inquiry_status)) {

						$html .= '<span><u style="font-size: 14px; color:#724EBF">' . $inquiry_status . '</u></span>';
					}







					$html .= '<i class="bx bx-right-arrow-alt font-size-16  align-middle ms-1"style="color:#b55dcd"></i>

										

    									<span style="font-size: 11px;"class="text-body"> ' . $inquiry_type_name . '</span>';

					if (!empty($nxtfollowdate) && $nxtfollowdate != "30-11--0001 12:00 AM") {

						$html .= '<i class="bx bx-right-arrow-alt font-size-16  align-middle ms-2" style="color:#b55dcd"></i>

    										<span style="font-size: 10px;"class="text-body">' . followup_date_convert_indian_date($value['nxt_follow_up'])  . '</span>';
					}

					$html .= '<i class="bx bx-right-arrow-alt font-size-16 align-middle ms-1" style="color:#b55dcd"></i>

                                            <span class="text-body" style="font-size: 11px;"> ' . $remark . '</span>

											';



					$html .= '	

                                                        </div>

                                                    </div>

                                                </div>';

					$html .= '</a>

                                            </li>';
					$count_followup++;
				}
			}
			$return_array['result'] = 1;
			$return_array['row_count'] = $count_followup;
			if ($html == '') {
				$return_array['row_count'] = '0';
				$return_array['followup_data_html'] = '<p class="fs-12 text-center">Data Not Found </p>';
			} else {
				$return_array['followup_data_html'] = $html;
			}
		} else {
			$return_array['result'] = 1;
			$return_array['followup_data_html'] = '<p class="fs-12 text-center">Data Not Found </p>';
		}
		echo json_encode($return_array, true);

		die();
	}

	public function demo_list_data()
	{
		// $departmentdisplaydata = $this->MasterInformationModel->display_all_records('paydone');
		// $departmentdisplaydata = json_decode($departmentdisplaydata, true);


		$sql = "SELECT 
		ap.id AS product_id,
		ap.product_name AS product_name,
		COUNT(CASE WHEN ai.intrested_product IS NOT NULL THEN 1 ELSE NULL END) AS inq_count,
		COUNT(CASE WHEN ai.inquiry_status = 3 THEN 1 ELSE NULL END) AS appointment_count,
		COUNT(CASE WHEN  ai.isSiteVisit = 1 OR ai.inquiry_status = 4  THEN 1 ELSE NULL END) AS demo_count
	FROM 
		admin_product AS ap
	LEFT JOIN 
		admin_all_inquiry AS ai ON ap.id = ai.intrested_product 
	GROUP BY 
		ap.id, ap.product_name
	";

		$db_connection = \Config\Database::connect('second');
		$result = $db_connection->query($sql);
		$get_data_all_demo = $result->getResultArray();


		$html = "";
		$user_db_connection = \Config\Database::connect('default');
		$sql2 = "SELECT COUNT(*) as sub_count,product_id FROM paydone_data WHERE status = 1 GROUP BY product_id";
		$sql_run = $user_db_connection->query($sql2);
		$paydone_data_get = $sql_run->getResultArray();

		// $all_data_merge = array_merge($paydone_data_get,$get_data_all_demo);
		// pre($all_data_merge);
		// die();
		foreach ($get_data_all_demo as $key => $value) {
			// pre($value);
			$html .= '<tr>
			<td>' . $value['product_name'] . '</td>
			<td>' . $value['inq_count'] . '</td>
			<td>' . $value['appointment_count'] . '</td>
			<td>' . $value['demo_count'] . '</td>';
			foreach ($paydone_data_get as $key50 => $value50) {
				// pre($value50);
				if($value['product_id'] == $value50['product_id']) {
					$html .= '<td>' . $value50['sub_count'] . '</td>';
				}
			}
			$html .= '</tr>';
		}
		$return_array['html'] = $html;
		echo json_encode($return_array, true);

		die();
	}
	public function get_activity_tab_fresh()

	{



		$return_array = array(

			'result' => '0',

			'row_count' => '0',

			'activity_data_html' => '<p class="text-center fs-12">Data Not Found </p>',

		);



		$db_connection = \Config\Database::connect('second');

		$full_username = session_username($_SESSION['username']);



		$tableName = $full_username . '_inquiry_log';

		$user_id = $_SESSION['id'];





		$not_valid_status = '"0"';

		if ($_POST['date_activity_dashboard']) {

			$today_datee = $_POST['date_activity_dashboard'];

			$today_date = date('Y-m-d', strtotime($today_datee));
		} else {

			$today_date = date('Y-m-d');
		}



		$user_query = '';

		if (isset($this->admin) && $this->admin == 1 && empty($_POST['activity_user_list']) && $_POST['activity_user_list'] == 0) {

			$user_query .= 'WHERE ';
		} else if (isset($_POST['activity_user_list']) && !empty($_POST['activity_user_list']) && $_POST['activity_user_list'] != 0) {

			$followup_get_user_id = $_POST['activity_user_list'];

			$user_query .= 'WHERE user_id IN ("' . $followup_get_user_id . '") AND';
		} else {

			$all_gm_under_people = '';

			$all_gm_under_people = getChildIds($user_id);

			$array_push = array_push($all_gm_under_people, $user_id);

			$all_gm_under_people_implode = "'" . implode("', '", $all_gm_under_people) . "'";

			$user_query .= 'WHERE user_id IN (' . $all_gm_under_people_implode . ') AND';
		}

		//$not_valid_status = "0","1";

		$sql = "SELECT *FROM " . $tableName . " " . $user_query . " DATE_FORMAT(created_at, '%Y-%m-%d') = DATE_FORMAT('" . $today_date . "', '%Y-%m-%d') ORDER BY id DESC";
		$result = $db_connection->query($sql);

		if ($result->getNumRows() > 0) {
			$rowCount = $result->getNumRows();
			$followup_data = $result->getResultArray();

			$html = '';
			$count_activity = 0;
			$status = get_table_array_helper('master_inquiry_status');
			foreach ($followup_data as $key => $value) {
				$created_date_check = date('Y-m-d', strtotime($value['created_at']));
				$inquiry_unique_id = '';
				// $created_dates = created_at_date_convert_indian_date($value['created_at'] ,"j-n-y h:i");
				$created_dates = date('d-m-Y h:i', strtotime($value['created_at']));

				$inquiry_data = inquiry_id_to_full_inquiry_data($value['inquiry_id']);

				if (isset($inquiry_data) && !empty($inquiry_data)) {
					$inquiry_unique_id = $inquiry_data['id'];
				}

				$btn_name = '';

				if (isset($value['status_id']) && !empty($value['status_id'])) {
					if (isset($status[$value['status_id']])) {
						$btn_name = $status[$value['status_id']]['inquiry_status'];
					}
				}

				$usernamee = '';
				$user_data = user_id_to_full_user_data($value['user_id']);
				if ($value['user_id'] == 0) {
					if (isset($user_data['name'])) {
						$usernamee = $user_data['name'];
					}
				} else {
					if (isset($user_data['firstname'])) {
						$usernamee = $user_data['firstname'];
					}
				}
				$inquiry_log = $value['inquiry_log'];

				$html .= '<li class="event-list d-flex">
    						<div class="event-timeline-dot pt-1 pe-2">
    							<i class="bx bx-right-arrow-circle font-size-18" style="color:#b55dcd"></i>
    						</div>
    						<div class="d-flex w-100">
    							<div class="flex-shrink-0 pt-2 me-2" style="width: 14%; ">
    								<h5 class="user_created_date_css " style="font-size:9px;">' . $created_dates . '</h5>
    							</div>
    							<div class="flex-shrink-0 ">
    								<i class="bx bx-right-arrow-alt font-size-12 align-middle me-1"style="color:#b55dcd"></i>
    								<span>' . $usernamee . '</span>
									<i class="bx bx-right-arrow-alt font-size-16  align-middle ms-1"style="color:#b55dcd"></i>
    							</div>
    							<div class="flex-grow-1 ">
    								<div>';
				if (!empty($btn_name)) {
					$html .= '<span><u style="font-size: 14px; color:#724EBF" >' . $btn_name . '</u></span>';
				}
				$html .= '<span  style="font-size: 12px;">' . $inquiry_log . '</span>
    								</div>
    							</div>
    						</div>
    					</li>';

				$count_activity++;
			}

			$return_array['result'] = 1;

			$return_array['row_count'] = $count_activity;

			if ($html == '') {

				$return_array['row_count'] = '0';

				$return_array['activity_data_html'] = '<p class="text-center fs-12">Data Not Found </p>';
			} else {

				$return_array['activity_data_html'] = $html;
			}
		}

		echo json_encode($return_array, true);

		die();
	}
	public function month_year_date_wise_data()
	{
		// pre($_POST['countwise']);
		// die();
		$result = get_user_count_inquiry_dataa($_SESSION['id'], $_POST['countwise']);

		return json_encode($result);
		// pre($result);
		// die();
		die();
	}

	public function Dashboard_get_user_wise_pendingdata()
	{

		$date = '';
		$this->db = \Config\Database::connect();
		// $from_date = $this->request->getPost("from_date");
		// $to_date = $this->request->getPost("to_date");
		// $nxt_flow_date = $_SESSION['nxt_follow_up'];



		$from_dates = '';
		$to_dates = '';
		// if (!empty($from_date) && !empty($to_date)) {
		// 	$from_dates = date('Ymd', strtotime($from_date));
		// 	$to_dates = date('Ymd', strtotime($to_date));
		// }

		// pre($to_dates);
		// die();

		//condtion access
		$getchild = array();
		$user_id = 0;
		$username = session_username($_SESSION['username']);
		if (!$this->admin == 1) {
			$user_id = $_SESSION['id'];
		}
		$getchild = getChildIds($_SESSION['id']);

		if (!empty($getchild)) {
			array_push($getchild, $user_id);
		}
		$all_gm_under_people_implode = "'" . implode("', '", $getchild) . "'";
		// pre($all_gm_under_people_implode);
		// die();
		$usernamee = '';
		$session_data = get_session_data();
		$user_fullname = user_id_to_full_user_data($user_id);
		// pre($user_fullname);
		if ($this->admin == 1) {
			if (isset($user_fullname['name'])) {
				$usernamee = $user_fullname['name'];
			}
		} else {
			if (isset($user_fullname['firstname'])) {
				$usernamee = $user_fullname['firstname'];
			}
		}
		// pre($usernamee);
		// die();


		if ($this->admin == 1) {

			$query = '';
		} else {
			$query = 'WHERE assign_id AND user_id IN (' . $all_gm_under_people_implode . ') ';
		}



		$sql_query = 'SELECT IFNULL(i.assign_id, 0) AS assign_id,
			 u.firstname, 
			 COUNT(CASE WHEN DATE_FORMAT(nxt_follow_up,"%Y%c%d")=DATE_FORMAT(now(),"%Y%c%d") THEN 1 END) AS Today,
			  COUNT(CASE WHEN DATE_FORMAT(nxt_follow_up,"%Y%c%d")<DATE_FORMAT(now(),"%Y%c%d") THEN 1 END) AS Pending, 
			  COUNT(CASE WHEN i.inquiry_type = 1 THEN 1 END) AS AutoLeads, COUNT(CASE WHEN i.inquiry_type = 15 THEN 1 END) AS SelfLeads,
			  COUNT(CASE WHEN DATE_FORMAT(nxt_follow_up,"%Y%c%d")=DATE_FORMAT(now(),"%Y%c%d") AND i.inquiry_status = 1 THEN 1 END) AS due, 
			  COUNT(CASE WHEN DATE_FORMAT(nxt_follow_up,"%Y%c%d")<DATE_FORMAT(now(),"%Y%c%d") AND  i.inquiry_status != 1 THEN 1 END) AS done,
			   COUNT(*) AS total FROM ' . $this->username . '_all_inquiry' . ' as i LEFT JOIN ' . $this->username . '_user' . ' as u ON u.id = i.assign_id OR (u.id = 0 AND i.assign_id IS NULL)' . $query . ' GROUP BY i.assign_id, u.firstname';

		// pre($sql_query);
		// die();
		$sql_query = $this->db->query($sql_query);
		$user_data_array = $sql_query->getResultArray();
		$user_data = "";
		$user_data .= '
		
		   <tr>
			  <th>user name</th>
			  <th>today</th>
			  <th>pending</th>
			  <th>auto leds</th>
			  <th>self leds</th>
			  <th>due</th>
			  <th>done</th>
			  <th>total</th>
		   </tr>
	
         ';
		$Today = 0;
		$Pending = 0;
		$AutoLeads = 0;
		$SelfLeads = 0;
		$due = 0;
		$done = 0;
		$total = 0;

		foreach ($user_data_array as $key => $value) {
			// print_r($value);
			// die();
			$user_data .= ' 
			
			<tr>
				<td>' . $value['firstname'] . '</td>
				<td>' . $value['Today'] . '</td>
				<td>' . $value['Pending'] . '</td>
				<td>' . $value['AutoLeads'] . '</td>
				<td>' . $value['SelfLeads'] . '</td>
				<td>' . $value['due'] . '</td>
				<td>' . $value['done'] . '</td>
				<td>' . $value['total'] . '</td>
	
		 	</tr>
			
			 ';


			$Today += $value['Today'];
			$Pending += $value['Pending'];
			$AutoLeads += $value['AutoLeads'];
			$SelfLeads += $value['SelfLeads'];
			$due += $value['due'];
			$done += $value['done'];
			$total += $value['total'];
		}

		$user_data .= ' 
			
			<tr>
			<td>' . "total" . '</td>
				<td>' . $Today . '</td>
				<td>' . $Pending . '</td>
				<td>' . $AutoLeads . '</td>
				<td>' . $SelfLeads . '</td>
				<td>' . $due . '</td>
				<td>' . $done . '</td>
				<td>' . $total . '</td>
	
		 	</tr>
			
			 ';
		echo json_encode($user_data);
		// echo($user_data);
		die();
	}

	public function Performance_task()
	{

		$this->db = \Config\Database::connect('second');
		if (isset($this->admin) && $this->admin == 1) {
			$user_id = 0;
		} else {
			$user_id = $_SESSION['id'];
		}
		$getchild = getChildIds($_SESSION['id']);
		if (!empty($getchild)) {
			array_push($getchild, $user_id);
		}
		$getchilds = "'" . implode("', '", $getchild) . "'";
		$getQuery = '';
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$getQuery = '';
		} else {
			$getQuery = ' AND (assign_id=' . $_SESSION['id'] . '  OR  assign_id IN (' . $getchilds . ') OR owner_id IN (' . $getchilds . ') ) ';
		}

		$full_name = $this->username . '_all_inquiry';
		$month = "SELECT IFNULL(inquiry_count1.count, 0) AS leads,
					IFNULL(inquiry_count2.count, 0) AS visit,
					IFNULL(inquiry_count3.count, 0) AS booking,
					calendar.month
			FROM (
				SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 2 - month_number MONTH), '%Y-%m') AS month
				FROM (
					SELECT 0 AS month_number UNION ALL SELECT 1 UNION ALL SELECT 2 
				) AS months
			) AS calendar
			LEFT JOIN (
				SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y-%m') AS month
				FROM $full_name as i
				WHERE i.created_at >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) $getQuery
					AND i.inquiry_status IN ('1', '2', '3', '4', '6', '7', '9', '10', '11', '12', '13') 
				GROUP BY month
			) AS inquiry_count1 ON calendar.month = inquiry_count1.month
			LEFT JOIN (
				SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y-%m') AS month
				FROM $full_name as i
				WHERE i.created_at >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) $getQuery
					AND (i.isSiteVisit = 1 OR i.isSiteVisit = 2)
				GROUP BY month
			) AS inquiry_count2 ON calendar.month = inquiry_count2.month

			LEFT JOIN (
				SELECT COUNT(b.id) AS count, DATE_FORMAT(b.booking_date, '%Y-%m') AS month
				FROM " . $this->username . "_booking as b
				WHERE b.booking_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND b.cancle_booking=0 $getQuery
				GROUP BY month
			) AS inquiry_count3 ON calendar.month = inquiry_count3.month
			ORDER BY calendar.month ASC;";
		$Getresult = $this->db->query($month);
		$result_array1 = $Getresult->getResultArray();
		$html = '';
		$html .= '<tr>
					<th>Performance</th>
					<th>lead</th>
					<th>Demo</th>
					<th>Subscription</th>
				</tr>';
		// end($people);
		$pre_month_visit = '';
		$pre_month_booking = '';
		$current_month_visit = '';
		$current_month_booking = '';
		foreach ($result_array1 as $keys => $values) {
			$html .= '
            	   		<tr>
                          <td class="fw-semibold">' . $values['month'] . '</td>
                          <td>' . $values['leads'] . '</td>
                          <td>' . $values['visit'] . '</td>
                          <td>' . $values['booking'] . '</td>
                       	</tr>';
			if ($keys == 0) {
				$pre_month_visit = $values['visit'];
				$pre_month_booking = $values['booking'];
			}
			if ($keys == 1) {
				$current_month_visit = $values['visit'];
				$current_month_booking = $values['booking'];
			}
			$leads = $values['leads'];
			$visit = $values['visit'];
			$booking = $values['booking'];
		}
		// pre($leads);
		//   pre($visit);
		//     pre($booking);
		if (!empty($visit) && $visit != 0 && !empty($leads) && $leads != 0) {
			$coverstion_visit = ($visit * 100) / $leads;
		} else {
			$coverstion_visit = 0;
		}
		if (!empty($booking) && $booking != 0 && !empty($leads) && $leads != 0) {
			$coverstion_booking = ($booking * 100) / $leads;
		} else {
			$coverstion_booking = 0;
		}
		$Growth_visit = 0;
		if ($current_month_visit != 0 && $pre_month_visit != 0) {
			$Growth_visit = (($current_month_visit - $pre_month_visit) / $pre_month_visit) * 100;
		}
		$Growth_boooking = 0;
		if ($current_month_booking != 0 && $pre_month_booking != 0) {
			$Growth_boooking = (($current_month_booking - $pre_month_booking) / $pre_month_booking) * 100;
		}
		// $formattedPercentage = number_format($percentage, 2) . '%';
		//pre($coverstion_visit);
		$html .= ' <tr>
					<td class="fw-semibold">Conversation</td>
					<td>0</td>
					<td>' . number_format($coverstion_visit, 2) . ' %</td>
					<td>' . number_format($coverstion_booking, 2) . ' %</td>
				</tr>';

		$html .= '
	                           	 <tr>
								<td class="fw-semibold">Growth</td>
	                              <td>0</td>';
		if ($Growth_visit <= 0) {
			$html .= ' <td class="red_data text-danger fw-medium">' . number_format($Growth_visit, 2) . '%</td>';
		} else {
			//   if($Growth_visit > 100){
			//         $html .=' <td class="green_data"> '.number_format(100, 2).'%</td>';
			//     } else{
			$html .= ' <td class="green_data text-success fw-medium"> ' . number_format($Growth_visit, 2) . '%</td>';
			// }
		}
		if ($Growth_boooking <= 0) {
			$html .= '<td class="red_data text-danger fw-medium">' . number_format($Growth_boooking, 2) . '%</td>';
		} else {
			//	$html .='<td class="green_data">'.number_format($Growth_boooking, 2).'%</td>';
			// if($Growth_boooking > 100){
			//         $html .=' <td class="green_data"> '.number_format(100, 2).'%</td>';
			//     } else{
			$html .= ' <td class="green_data text-success fw-medium"> ' . number_format($Growth_boooking, 2) . '%</td>';
			//}
		}
		$html .= '</tr> ';
		$html .= '';

		echo json_encode($html);
		die();
	}
	public function Dashboard_get_all_status_data()
	{
		$this->db = \Config\Database::connect();
		if (isset($this->admin) && $this->admin == 1) {
			$user_id = 1;
			$project_id = '';
		} else {
			$user_id = $_SESSION['id'];
			$project_id = $_SESSION['project'];
			if (empty($project_id)) {
				$getchildProjectId1 = getChildProjectIds($_SESSION['id']);
				$project_id = implode(',', $getchildProjectId1);
			}
		}
		$db_connection = \Config\Database::connect('second');
		$username = session_username($_SESSION['username']);
		$query = "SELECT id, inquiry_status FROM master_inquiry_status";
		$inq_status = $db_connection->query($query);
		$inq_status_result = $inq_status->getResultArray($inq_status);
		$inq_sta_id = array_map(function ($value) {
			return $value['id'];
		}, $inq_status_result);
		if (isset($_POST['month']) && $_POST['month'] != '') {
			$full_month = $_POST['month'];
			$full_month = explode('-', $full_month);
			$month = $full_month[1];
			$year = $full_month[0];
			$get_month_days = getCustomMonthDays($year, $month, 'd M');
			// pre($get_month_days);
			$last30Days = $get_month_days;
		} else {
			$currentDateTime = time();
			$last30Days = array_map(function ($i) use ($currentDateTime) {
				$date = Utctime('d M', $this->timezone, date('d M', strtotime("-$i days", $currentDateTime)));   //date('d M', strtotime("-$i days", $currentDateTime));
				return $date;
			}, range(1, 30));
		}
		$getchild = getChildIds($_SESSION['id']);
		if (!empty($getchild)) {
			array_push($getchild, $_SESSION['id']);
		} else {
			$getchild[] = $_SESSION['id'];
		}
		$getchild = implode(",", $getchild);
		$username = session_username($_SESSION['username']);
		$getQuery = '';
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$getQuery = '';
			$getQuery_book = ' ';
		} else {
			$getQuery = ' AND (all_inquiry.assign_id=' . $_SESSION['id'] . '  OR  all_inquiry.assign_id IN (' . $getchild . ') OR all_inquiry.owner_id IN (' . $getchild . ') ) ';
			$getQuery_followup = ' AND (followup.assign_id=' . $_SESSION['id'] . '  OR  followup.assign_id IN (' . $getchild . ') OR followup.owner_id IN (' . $getchild . ') ) ';
			$getQuery_book = ' AND (booking.assign_id=' . $_SESSION['id'] . '  OR  booking.assign_id IN (' . $getchild . ') OR booking.owner_id IN (' . $getchild . ') ) ';
		}
		$full_name = $username . '_all_inquiry';
		$full_name_book = $username . '_booking';
		$followup_data = $username . '_followup';
		$today = date('Y-m-d');
		// nxt_follow_up
		if (isset($_POST['month'])) {
			$month = $_POST['month'];
			$main_query = "SELECT
                IFNULL(inquiry_count1.count, 0) AS `Call`,
                IFNULL(inquiry_count5.count, 0) AS `Close`,
                IFNULL(inquiry_count3.count, 0) AS `Visit`,
                IFNULL(inquiry_count4.count, 0) AS `Inq`,
                DATE_FORMAT(calendar.day, '%d %b') AS day
                    FROM
                        (
                            SELECT DATE_SUB('$month', INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY) AS day
                            FROM(SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                            CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                            CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                        ) AS calendar
                    LEFT JOIN
                        (
                            SELECT COUNT(id) AS count, DATE(created_at) AS day
                            FROM $followup_data AS followup
                            WHERE created_at >= DATE_SUB('$month', INTERVAL 30 DAY)
                            GROUP BY day
                        ) AS inquiry_count1 ON calendar.day = inquiry_count1.day
						
                    LEFT JOIN
                        (
                            SELECT COUNT(id) AS count, DATE(created_at) AS day
                            FROM $full_name AS all_inquiry
                            WHERE created_at >= DATE_SUB('$month', INTERVAL 30 DAY) $getQuery
                            AND inquiry_status = 7
                            GROUP BY day
                        ) AS inquiry_count5 ON calendar.day = inquiry_count5.day
						LEFT JOIN
                        (
                            SELECT COUNT(id) AS count, DATE(created_at) AS day
                            FROM $full_name AS all_inquiry
                            WHERE created_at >= DATE_SUB('$month', INTERVAL 30 DAY) $getQuery
                            AND (isSiteVisit = 1 OR isSiteVisit = 2)
                            GROUP BY day
                        ) AS inquiry_count3 ON calendar.day = inquiry_count3.day
                    LEFT JOIN
                        (
                            SELECT COUNT(id) AS count, DATE(created_at) AS day
                            FROM $full_name AS all_inquiry
                            WHERE created_at >= DATE_SUB('$month', INTERVAL 30 DAY) $getQuery
                            GROUP BY day
                        ) AS inquiry_count4 ON calendar.day = inquiry_count4.day
                    WHERE
                        calendar.day >= DATE_SUB('$month', INTERVAL 30 DAY)
                    ORDER BY
                        calendar.day ";
		} else {
			$main_query = "SELECT
                IFNULL(inquiry_count1.count, 0) AS `Call`,
                IFNULL(inquiry_count5.count, 0) AS `Close`,
                IFNULL(inquiry_count4.count, 0) AS `Inq`,
                IFNULL(inquiry_count3.count, 0) AS `Visit`,
                DATE_FORMAT(calendar.day, '%d %b') AS day
				FROM
					(
						SELECT DATE_SUB('" . $today . "', INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY) AS day
						FROM(SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
						CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
						CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7  UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
					) AS calendar
                LEFT JOIN
                    (
                        SELECT COUNT(id) AS count, DATE(created_at) AS day
                        FROM $followup_data AS followup
                        WHERE nxt_follow_up >= DATE_SUB('" . $today . "', INTERVAL 30 DAY) $getQuery
                        GROUP BY day
                    ) AS inquiry_count1 ON calendar.day = inquiry_count1.day
					
					LEFT JOIN
                    (
                        SELECT COUNT(id) AS count, DATE(created_at) AS day
                        FROM $full_name AS all_inquiry
                        WHERE created_at >= DATE_SUB('" . $today . "', INTERVAL 30 DAY) $getQuery
                        AND (isSiteVisit = 1 OR isSiteVisit = 2)
                        GROUP BY day
                    ) AS inquiry_count3 ON calendar.day = inquiry_count3.day
                LEFT JOIN
                    (
                        SELECT COUNT(id) AS count, DATE(created_at) AS day
                        FROM $full_name AS all_inquiry
                        WHERE created_at >= DATE_SUB('" . $today . "', INTERVAL 30 DAY) $getQuery
                        AND inquiry_status = 7
                        GROUP BY day
                    ) AS inquiry_count5 ON calendar.day = inquiry_count5.day
               
                LEFT JOIN
                    (
                        SELECT COUNT(id) AS count, DATE(created_at) AS day
                        FROM $full_name AS all_inquiry
                        WHERE created_at >= DATE_SUB('" . $today . "', INTERVAL 30 DAY) $getQuery
                        GROUP BY day
                    ) AS inquiry_count4 ON calendar.day = inquiry_count4.day
                WHERE
                    calendar.day >= DATE_SUB('" . $today . "', INTERVAL 30 DAY)
                ORDER BY
                    calendar.day ";
		}
		$fier_main_query = $db_connection->query($main_query);
		$final_inq_status_data = $fier_main_query->getResult();
		$all_inq_sta_id = [];
		$col_array = [0 => 'Inq', 1 => 'Call', 2 => 'Visit', 4 => 'Close'];
		array_reverse($final_inq_status_data);
		if (isset($_POST['month'])) {
		} else {
			$last30Days = array_reverse($last30Days);
		}
		$html = '';
		$html .= "<tr>
					<td>Status</td>";
		foreach ($last30Days as $day_key => $day_value) {
			$html .= '<td>' . $day_value . '</td>';
		}
		$html .= '<td>Total</td>
				</tr>';
		foreach ($col_array as $inq_sta_key => $inq_sta_value) {
			$html .= '<tr><td>' . $inq_sta_value . '</td>';
			$row_count = array_reduce($last30Days, function ($carry, $v) use ($final_inq_status_data, $inq_sta_value, &$html) {
				$valuecheck = false;
				foreach ($final_inq_status_data as $final_key => $final_val) {
					if ($v == $final_val->day) {
						$carry += $final_val->$inq_sta_value;
						$html .= '<td>' . $final_val->$inq_sta_value . '</td>';
						$valuecheck = true;
						break;
					} else {
						$valuecheck = false;
					}
				}
				if (!$valuecheck) {
					$html .= '<td>0</td>';
				}
				return $carry;
			}, 0);
			$html .= '<td>' . $row_count . '</td>';
			$html .= '</tr>';
		}
		echo $html;
	}
	public function Dashboard_get_lead_quality_report(){
		$this->db = \Config\Database::connect();
        if ((isset($this->admin) && $this->admin == 1) || (in_array('data_viewing_child_all',$this->get_roll_id_to_roll_duty_var))) {
            $user_id = 1;
            $project_id = '';
        } else {
            $user_id = $_SESSION['id'];
            $project_id = $_SESSION['project'];
			if(empty($project_id)){
				$getchildProjectId1 = getChildProjectIds($_SESSION['id']);
				$project_id = implode('","',$getchildProjectId1);
			}
        }
		$startdate = '';
		$enddate = '';
		if(isset($_POST['fromdate']) && isset($_POST['todate'])){
			$startdate = $_POST['fromdate'];
			$timezone = isset($_SESSION['timezone']) ? $_SESSION['timezone'] :'UTC';
			$startdate = date('Y-m-d',strtotime($startdate));
			$enddate = $_POST['todate'];
			$enddate = date('Y-m-d',strtotime($enddate));
		}
        $getchild = getChildIds($_SESSION['id']);
        if (!empty($getchild)) {
            array_push($getchild, $_SESSION['id']);
        } else {
            $getchild[] = $_SESSION['id'];
        }
        $getchild = implode(",", $getchild);
        $username = session_username($_SESSION['username']);
        $getQuery = '';
        if ((isset($this->admin) && $this->admin == 1) || (in_array('data_viewing_child_all',$this->get_roll_id_to_roll_duty_var))) {
            $getQuery = '';
			$getQuery_book = ' ';
			$project_access_sql = ' 1';
        } else {
            $getQuery = ' AND (all_inquiry.assign_id=' . $_SESSION['id'] . '  OR  all_inquiry.assign_id IN (' . $getchild . ') OR all_inquiry.owner_id IN (' . $getchild . ') ) ';
            $getQuery_book = ' AND (booking.assign_id=' . $_SESSION['id'] . '  OR  booking.assign_id IN (' . $getchild . ') OR booking.owner_id IN (' . $getchild . ') ) ';
			$project_access_sql = ' id IN ("'.$project_id.'") ';
        }
		// echo $project_id;
		if($startdate != '' && $enddate != ''){
			$date_sql = " AND DATE(created_at) BETWEEN '$startdate' AND '$enddate'";
			$data_book_sql = "AND DATE(booking.booking_date) BETWEEN '$startdate' AND '$enddate'";
		} else {
			$date_sql = " AND DATE(created_at) = DATE_FORMAT('".date("Y-m-d")."' , '%Y-%m-%d') ";
			$data_book_sql = " AND DATE(booking.booking_date) = DATE_FORMAT('".date("Y-m-d")."' , '%Y-%m-%d') ";
		}
        $full_name = $username . '_all_inquiry';
        $full_name_book = $username . '_booking';
		$project_table_name = $username . '_product';
		$main_query = "SELECT
		product.id AS project_id,
		product.product_name AS project_name,
		COALESCE(inquiry_count1.count, 0) AS `lead`,
		COALESCE(inquiry_count2.count, 0) AS `positive`,
		COALESCE(inquiry_count5.count, 0) AS `appointment`,
		COALESCE(inquiry_count3.count, 0) AS `visit`,
		COALESCE(inquiry_count6.count, 0) AS `dismiss`
	FROM (
		SELECT id, product_name
		FROM admin_product
		WHERE 1
	) AS product
	LEFT JOIN (
		SELECT COUNT(id) AS count, intrested_product
		FROM admin_all_inquiry AS all_inquiry
		WHERE inquiry_type = 1 $date_sql $getQuery
		GROUP BY intrested_product
	) AS inquiry_count1 ON product.id = inquiry_count1.intrested_product
	LEFT JOIN (
		SELECT COUNT(id) AS count, intrested_product
		FROM admin_all_inquiry AS all_inquiry
		WHERE inquiry_type = 1 AND intrested_product <> '' AND budget <> '' AND approx_buy <> '' $date_sql $getQuery
		GROUP BY intrested_product
	) AS inquiry_count2 ON product.id = inquiry_count2.intrested_product
	LEFT JOIN (
		SELECT COUNT(id) AS count, intrested_product
		FROM admin_all_inquiry AS all_inquiry
		WHERE inquiry_type = 1 AND isAppoitement = 1 $date_sql $getQuery
		GROUP BY intrested_product
	) AS inquiry_count5 ON product.id = inquiry_count5.intrested_product
	LEFT JOIN (
		SELECT COUNT(id) AS count, intrested_product
		FROM admin_all_inquiry AS all_inquiry
		WHERE inquiry_type = 1 AND isSiteVisit IN ('1', '2') $date_sql $getQuery
		GROUP BY intrested_product
	) AS inquiry_count3 ON product.id = inquiry_count3.intrested_product
	LEFT JOIN (
		SELECT COUNT(id) AS count, intrested_product
		FROM admin_all_inquiry AS all_inquiry
		WHERE inquiry_type = 1 AND inquiry_status = 7 $date_sql $getQuery
		GROUP BY intrested_product
	) AS inquiry_count6 ON product.id = inquiry_count6.intrested_product
	ORDER BY product.id;";

		// $main_query = "SELECT	
		// 			product.id AS project_id,
		// 			product.product_name AS project_name,
		// 			COALESCE(inquiry_count1.count, 0) AS `lead`,
		// 			COALESCE(inquiry_count2.count, 0) AS `positive`,
		// 			COALESCE(inquiry_count5.count, 0) AS `appointment`,
		// 			COALESCE(inquiry_count3.count, 0) AS `visit`,
		// 			COALESCE(inquiry_count6.count, 0) AS `dismiss`
		// 		FROM (
		// 			SELECT id, product_name
		// 			FROM $project_table_name
		// 			WHERE $project_access_sql 
		// 		) AS product
		// 		LEFT JOIN (
		// 			SELECT COUNT(id) AS count, product_name AS project_id
		// 			FROM $full_name AS all_inquiry
		// 			WHERE inquiry_type = 1 $date_sql $getQuery
		// 			GROUP BY project_id
		// 		) AS inquiry_count1 ON product.id = inquiry_count1.project_id
		// 		LEFT JOIN (
		// 			SELECT COUNT(id) AS count, product_name AS project_id
		// 			FROM $full_name AS all_inquiry
		// 			WHERE inquiry_type = 1 AND intrested_product <> '' AND property_sub_type <> '' AND budget <> ''  AND approx_buy <> '' $date_sql $getQuery
		// 			GROUP BY project_id
		// 		) AS inquiry_count2 ON product.id = inquiry_count2.project_id
		// 		LEFT JOIN (
		// 			SELECT COUNT(id) AS count, product_name AS project_id
		// 			FROM $full_name AS all_inquiry
		// 			WHERE inquiry_type = 1 AND isAppoitement = 1 $date_sql $getQuery
		// 			GROUP BY project_id
		// 		) AS inquiry_count5 ON product.id = inquiry_count5.project_id
		// 		LEFT JOIN (
		// 			SELECT COUNT(id) AS count, product_name AS project_id
		// 			FROM $full_name AS all_inquiry
		// 			WHERE inquiry_type = 1 AND isSiteVisit IN ('1','2') $date_sql $getQuery
		// 			GROUP BY project_id
		// 		) AS inquiry_count3 ON product.id = inquiry_count3.project_id

		// 		LEFT JOIN (
		// 			SELECT COUNT(id) AS count, product_name AS project_id
		// 			FROM $full_name AS all_inquiry
		// 			WHERE inquiry_type = 1 AND inquiry_status = 7 $date_sql $getQuery
		// 			GROUP BY project_id
		// 		) AS inquiry_count6 ON project.id = inquiry_count6.project_id
		// 		ORDER BY product.id;
		// 		";
		
		$db = \Config\Database::connect('second');
        $fier_main_query = $db->query($main_query);
        $final_lead_data = $fier_main_query->getResult();
        $all_inq_sta_id = [];
		// $col_array = [ 0 => 'Inq', 1 => 'Call', 2 => 'Visit', 3 => 'Booking', 4 => 'Close' ];
		$html = '';
		$html .= "<tr>
					<td>Site</td>
					<td>Lead</td>
					<td>Positive</td>
					<td>Appointment</td>
					<td>Visit</td>
					<td>Dismiss</td>
					<td>index</td>";
		$html .= '</tr>';
		// pre($final_lead_data);
		foreach ($final_lead_data as $inlead_sta_key => $lead_sta_value) {
			$lead_data = $lead_sta_value->lead;
			$positive = $lead_sta_value->positive;
			$visit_data = $lead_sta_value->visit;
			// $booking_data = $lead_sta_value->booking;
			$index_positive_sum = $lead_data != 0 ? ($positive * 100 / $lead_data) : 0;
			$index_visit_sum = $positive != 0 ? ($visit_data * 100 / $positive) : 0;
			// $index_booking_sum = $visit_data != 0 ? ($booking_data * 100 / $visit_data) : 0;
			$index_positive_sum = number_format($index_positive_sum, 0);
			$index_visit_sum = number_format($index_visit_sum, 0);
			// $index_booking_sum = number_format($index_booking_sum, 0);
			$index_booking_sum = 0;
			$html .= '<tr>
						<td>'.$lead_sta_value->project_name.'</td>
						<td>'.$lead_sta_value->lead.'</td>
						<td>'.$lead_sta_value->positive.'</td>
						<td>'.$lead_sta_value->appointment.'</td>
						<td>'.$lead_sta_value->visit.'</td>
						<td>'.$lead_sta_value->dismiss.'</td>
						<td>'.$index_positive_sum.' <b>:</b> '.$index_visit_sum.' <b>:</b> '.$index_booking_sum.'</td>
					</tr>';
		}
		echo $html;
	}
	public function Dashboard_get_lead_statistics_data()
	{
		$this->db = \Config\Database::connect();
		if ((isset($this->admin) && $this->admin == 1) || (in_array('data_viewing_child_all',$this->get_roll_id_to_roll_duty_var))) {
			$user_id = 1;
			$project_id = '';
		} else {
			$user_id = $_SESSION['id'];
			$project_id = $_SESSION['project'];
			if (empty($project_id)) {
				$getchildProjectId1 = getChildProjectIds($_SESSION['id']);
				$project_id = implode(',', $getchildProjectId1);
			}
		}
		$getchild = getChildIds($_SESSION['id']);
		if (!empty($getchild)) {
			array_push($getchild, $user_id);
		}
		$getchilds = "'" . implode("', '", $getchild) . "'";
		$getQuery = '';
		if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1) || (in_array('data_viewing_child_all',$this->get_roll_id_to_roll_duty_var))) {
			$getQuery = ' ';
		} else {
			$getQuery = 'AND intrested_site IN ( ' . $project_id . ' ) ';
		}
		// if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1) || (in_array('data_viewing_child_all',$this->get_roll_id_to_roll_duty_var))) {
			$project_id_query = "SELECT id,product_name FROM " . $this->username . "_product";
		// } else {
		// 	$project_id_query = "SELECT id,product_name,p_shortname FROM " . $this->username . "_product WHERE is_inactive = 0 AND id IN ( " . $project_id . ")";
		// }
		
		$db = \Config\Database::connect('second');
		$project_id_query_fier = $db->query($project_id_query);
		$project_id_query_fier = $project_id_query_fier->getResultArray();
		$today = $today = date('Y-m-d');
		$query = "SELECT subquery.count, subquery.intrested_product, subquery.time_period
		FROM (
			SELECT COUNT(id) as count, intrested_product, 'Today' AS time_period, DATE(created_at) AS date
			FROM " . $this->username . "_all_inquiry
			WHERE DATE(created_at) = '" . $today . "' AND inquiry_type = 1 $getQuery 
			GROUP BY intrested_product, DATE(created_at) 
			UNION ALL
			SELECT COUNT(id) as count, intrested_product, 'This Week' AS time_period, DATE(created_at) AS date
			FROM " . $this->username . "_all_inquiry
			WHERE YEARWEEK(created_at) = YEARWEEK('" . $today . "') AND inquiry_type = 1 $getQuery 
			GROUP BY intrested_product, YEARWEEK(created_at) 
			UNION ALL
			SELECT COUNT(id) as count, intrested_product, 'This Month' AS time_period, DATE(created_at) AS date
			FROM " . $this->username . "_all_inquiry
			WHERE YEAR(created_at) = YEAR('" . $today . "') AND MONTH(created_at) = MONTH('" . $today . "') AND inquiry_type = 1 $getQuery 
			GROUP BY intrested_product, MONTH(created_at) 
			UNION ALL
			SELECT COUNT(id) as count, intrested_product, DATE_FORMAT(created_at, '%b') AS time_period, DATE(created_at) AS date
			FROM " . $this->username . "_all_inquiry
			WHERE created_at >= DATE_SUB(DATE_FORMAT('" . $today . "', '%Y-%m-01'), INTERVAL 4 MONTH) AND inquiry_type = 1 $getQuery 
			GROUP BY intrested_product, MONTH(created_at) 
		) AS subquery ORDER BY subquery.time_period ASC;";
		
		$lead_data_query_fier = $db->query($query);
		$lead_data_query_fier = $lead_data_query_fier->getResultArray();
		// pre($lead_data_query_fier);
		$months = [];
		for ($i = 1; $i < 5; $i++) {
			$monthYear = date('M Y', strtotime("-$i months"));  //date('M Y', strtotime("-$i months"));
			$monthAbbreviation = substr($monthYear, 0, 3);
			$months[] = $monthAbbreviation;
		}
		$project_id_array = array();
		$html = '';
		$html .= '<tr>
					<th>Month</th>';
		$f = 0;
		foreach ($project_id_query_fier as $pro_id_key => $pro_id_value) {
			$html .= '<th>' . $pro_id_value['product_name'] . '</th>';
			$project_id_array[] = $pro_id_value['id'];
			$f++;
		}
		$html .= '<th>Total</th>
				</tr>';
		$months = array_reverse($months);
		$months[] = 'This Month';
		$col_total = array_fill(0, $f, 0); /* Initialize an array to store column totals */
		foreach ($months as $mon_key => $mon_val) {
			$html .= '<tr>
						<td>' . $mon_val . '</td>';
			$row_count = 0;
			foreach ($project_id_query_fier as $pro_id_key => $pro_id_value) {
				$valuecheck = false;
				foreach ($lead_data_query_fier as $lead_key => $lead_val) {
					if ($lead_val['time_period'] == $mon_val && $pro_id_value['id'] == $lead_val['intrested_product']) {
						$html .= '<td>' . $lead_val['count'] . '</td>';
						$row_count += $lead_val['count'];
						$col_total[$pro_id_key] += $lead_val['count'];
						$valuecheck = true;
						break;
					} else {
						$valuecheck = false;
					}
				}
				if (!$valuecheck) {
					$html .= '<td>0</td>';
				}
			}
			$html .= '<td>' . $row_count . '</td>
						</tr>';
		}
		$html .= '<tr>
					<td>Total</td>';
		$col_total_val_total = 0;
		foreach ($col_total as $col_total_key => $col_total_val) {
			$html .= '<td>' . $col_total_val . '</td>';
			$col_total_val_total += $col_total_val;
		}
		$html .= '<td>' . $col_total_val_total . '</td>
				</tr>';
		$ext_month_col = array(
			0 => 'This Week',
			1 => 'Today',
		);
		foreach ($ext_month_col as $ext_month_col_key => $ext_month_col_val) {
			$html .= '<tr class="bg-success bg-opacity-10 border-2 border border-success border-opacity-25">
						<td>' . $ext_month_col_val . '</td>';
			$row_count = 0;
			foreach ($project_id_query_fier as $pro_id_key1 => $pro_id_value1) {
				$valuecheck = false;
				foreach ($lead_data_query_fier as $lead_key => $lead_val1) {
					if ($lead_val1['time_period'] == $ext_month_col_val && $pro_id_value1['id'] == $lead_val1['intrested_product']) {
						$html .= '<td>' . $lead_val1['count'] . '</td>';
						$row_count += $lead_val1['count'];
						/* $col_total[$pro_id_key] += $lead_val['count']; */
						$valuecheck = true;
						break;
					} else {
						$valuecheck = false;
					}
				}
				if (!$valuecheck) {
					$html .= '<td>0</td>';
				}
			}
			$html .= '<td>' . $row_count . '</td>
					</tr>';
		}
		echo $html;
	}
	public function Dashboard_dismiss_inq_report()
	{
		// pre($_POST);
		// die();
		$test = \Config\Database::connect('second');
		if (isset($this->admin) && $this->admin == 1) {
			$user_id = 1;
		} else {
			$user_id = $_SESSION['id'];
		}
		$startdate = '';
		$enddate = '';
		if (isset($_POST['fromdate']) && isset($_POST['todate'])) {
			// $startdate = strtotime($_POST['fromdate'].' 11:00');
			$startdate = $_POST['fromdate'];
			$timezone = isset($_SESSION['timezone']) ? $_SESSION['timezone'] : 'UTC';
			$startdate = date('Y-m-d',strtotime($startdate));
			$enddate = $_POST['todate'];
			$enddate = date('Y-m-d',strtotime($enddate));
		}
		$query = "SELECT id, inquiry_close_reason FROM admin_master_inquiry_close";
		// print_r($query);
		$inq_close_reson = $test->query($query);

		$inq_close_result = $inq_close_reson->getResultArray();
		$inq_sta_id = array_map(function ($value) {
			return $value['id'];
		}, $inq_close_result);
		$date_sql = '';
		if ($startdate != '' && $enddate != '') {
			$date_sql = " AND DATE(uai.created_at) BETWEEN '$startdate' AND '$enddate'";
		} else {
			$date_sql = " AND DATE(uai.created_at) = DATE_FORMAT('" . date("Y-m-d") . "' , '%Y-%m-%d') ";
		}
		$getchild = getChildIds($_SESSION['id']);
		if (!empty($getchild)) {
			array_push($getchild, $_SESSION['id']);
		} else {
			$getchild[] = $_SESSION['id'];
		}
		$getchild = implode(",", $getchild);
		if (isset($this->admin) && $this->admin == 1) {
			$getQuery = '';
		} else {
			$getQuery = ' AND (assign_id=' . $_SESSION['id'] . '  OR  assign_id IN (' . $getchild . ') OR owner_id IN (' . $getchild . ') ) ';
		}
		$sql = 'SELECT
					CASE
						WHEN uai.inquiry_close_reason < 40 THEN m.inquiry_close_reason
						ELSE um.inquiry_close_reason
					END AS reson,
					COUNT(uai.id) AS count,
					(COUNT(*) / t.total_count) * 100 AS Percentage
					FROM
						' . $this->username . '_all_inquiry uai 
					LEFT JOIN (
						SELECT COUNT(*) AS total_count
						FROM ' . $this->username . '_all_inquiry uai
						WHERE uai.inquiry_status = 7 ' . $date_sql . ' ' . $getQuery . '
					) AS t ON 1 = 1
					LEFT JOIN admin_master_inquiry_close AS m ON m.id = uai.inquiry_close_reason
					LEFT JOIN ' . $this->username . '_master_inquiry_close AS um ON um.id = uai.inquiry_close_reason
					WHERE
						uai.inquiry_status = 7 ' . $date_sql . ' ' . $getQuery . ' 
					GROUP BY
						reson
					ORDER BY
						reson;';
		$query = $test->query($sql);

		$sql_result = $query->getResultArray();

		// pre($sql_result);
		$html = '';
		$html .= '<thead>
					<th>Reson</th>
					<th>Dismiss(%)</th>
			</thead>
			<tbody>';
		$total_count = 0;
		foreach ($sql_result as $d_key => $d_value) {
			$reson = $d_value['reson'] == '' ? 'Without Close Reson' : $d_value['reson'];
			$html .= '<tr>
						<td>' . $reson . '</td>';
			$html .= '<td><b>' . $d_value['count'] . '</b> ( ' . number_format($d_value['Percentage'], 2) . ' % )</td>';
			$html .= '</tr>';
			$total_count += $d_value['count'];
		}
		$html .= '<tr>
					<td>Total</td>
					<td><b>' . $total_count . '</b></td>
				</tr>';
		$html .= '</tbody>';

		// $return_array['html'] = $html;
		//  json_encode($return_array);
		return $html;
		die();
	}
}
