<?php



namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use CodeIgniter\I18n\Time;
use DateTime;
use DateTimeZone;


class AttendanceController extends BaseController
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
		$this->timezone = timezonedata();
	}
    public function attandance_showdata()
	{
        $db = \Config\Database::connect('second');
		if (isset($_POST['user_id'])) {
			$user_id = $_POST['user_id'];
		} else {
			$user_id = "";
		}
		$username = session_username(session('username'));
		$attendance = $db->table($username . "_attendance");
		$attendance->select('*');
		$attendance->where('user_id', $user_id);
		$attendance->where('punch_date', $_POST['attendance_date']);
		$query = $attendance->get();
		$result = $query->getRow();
		$puncharray = json_decode($result->punch_time_array);
		$data = ''; // Initialize the HTML string
		if (is_array($puncharray)) {
			for ($i = 0; $i < count($puncharray); $i += 2) {
				$inTime = isset($puncharray[$i]) ? $puncharray[$i] : '';
				$outTime = isset($puncharray[$i + 1]) ? $puncharray[$i + 1] : '';
				$utcINTime = Utctodate('h:i A', $this->timezone, $inTime);
				$utcOutTime = Utctodate('h:i A', $this->timezone, $outTime);
				$data .= '<div class="add_fild_outer_main col-12 mb-0 px-2">
							<div class="d-flex my-2 align-items-center">
								<div class="col-3">
									<label class="form-label text-nowrap mb-0 me-2">Check In</label>
								</div>
								<input type="text" class="form-control main-control  punch_time" name="punch_time_array[]" value="' . $utcINTime . '">
								<button type="button" class="ms-2 btn-primary add-fild-btn"><i class="bi bi-plus"></i></button>
							</div>
							<div class="add_fild d-flex my-2 d-none">
								<div class="col-3"></div>
								<input type="text" class="form-control main-control at_time punch_time" name="punch_time_array[]">
								<button type="button" class="remove_fild ms-2 btn-primary"><i class="bi bi-dash"></i></button>
							</div>
						</div>';
				if (isset($outTime) && $outTime != '') {
					$data .= '<div class="add_fild_outer_main col-12 mb-0 px-2">
					<div class="d-flex my-2 align-items-center">
						<div class="col-3">
							<label class="form-label text-nowrap mb-0 me-2">Check Out</label>
						</div>
						<input type="text" class="form-control main-control  punch_time" name="punch_time_array[]" value="' . $utcOutTime . '">
						<button type="button" class="ms-2 btn-primary add-fild-btn"><i class="bi bi-plus"></i></button>	
					</div>
					<div class="add_fild d-flex my-2 d-none">
						<div class="col-3"></div>
						<input type="text" class="form-control main-control at_time punch_time" name="punch_time_array[]" value="">
						<button type="button" class="remove_fild ms-2 btn-primary"><i class="bi bi-dash"></i></button>
					</div>
				</div>';
				}
			}
		} else {
			$data .= '<div class="add_fild_outer_main col-12 mb-0 px-2">
						<div class="d-flex my-2 align-items-center">
							<div class="col-3">
								<label class="form-label text-nowrap mb-0 me-2">Check In</label>
							</div>
							<input type="text" class="form-control main-control punch_time" name="punch_time_array[]" value="">
						</div>
					</div>
					<div class="col-12 mb-0 px-2">
						<div class="d-flex my-2 align-items-center">
							<div class="col-3">
								<label class="form-label text-nowrap mb-0 me-2">Check Out</label>
							</div>
							<input type="text" class="form-control main-control punch_time" name="punch_time_array[]" value="">
						</div>
					</div>';
		}
		$data .= "<script>
					$('.punch_time').bootstrapMaterialDatePicker({
						format: 'h:m A',
						cancelText: 'cancel',
						okText: 'ok',
						clearText: 'clear',
						time: true,
						date: false,
					}); 
				</script>";
		return $data;
	}
    public function update_data()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				// $isduplicate = $this->duplicate_data($update_data, $table_name);
				// if ($isduplicate == 0) {
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
				$updatedisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$updatedisplaydata = json_decode($updatedisplaydata, true);
				$response = 1;
				// } else {
				// 	return 0;
				// }
			}
		}
		echo $response;
		die();
	}
	public function insert_data()
	{
		$defaultTimezone = 'UTC';
		$timezoneToUse = timezonedata();
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;
				// $isduplicate = $this->duplicate_data($insert_data, $table_name);
				// if ($isduplicate == 0) {
				$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
				$insert_displaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$insert_displaydata = json_decode($insert_displaydata, true);
				return 0;
				// } else {
				// 	return 1;
				// }
			}
		}
	}
	public function get_data_attandance()
	{
		$filterId = '';
		if (isset($_POST['gst_status'])) {
			$filterId = $_POST['gst_status'];
		}
		if ($filterId != '') {
			$FilterCause = 'AND id = "' . intval($_POST['Id']) . '"';
		} else {
			$FilterCause = '';
		}
		$html = '';
		$database_exdate = array();
		$currentDate = Utctodate('Y-m-d', $this->timezone, date("Y-m-d"));
		$firstDayOfMonth = Utctodate('Y-m-01', $this->timezone, date("Y-m-01"));
		$currentDateObj = new \DateTime($currentDate);
		$firstDayOfMonthObj = new \DateTime($firstDayOfMonth);
		$month_date = [];
		while ($currentDateObj >= $firstDayOfMonthObj) {
			$month_date[] = $currentDateObj->format("Y-m-d");
			$currentDateObj->modify("-1 day");
		}
		if (isset($_POST['temp']) && $_POST['temp'] != '') {
			$year_Number = $_POST['temp'];
			$year_Number = explode('-', $year_Number);
			$month = $year_Number[1];
			$year = $year_Number[0];
			$firstDayOfMonth = Utctodate('Y-m-d', $this->timezone, date("$year-$month-01"));
			$currentDate = Utctodate('Y-m-d', $this->timezone, date("Y-m-d"));
			$currentDateObj = new \DateTime($currentDate);
			$firstDayOfMonthObj = new \DateTime($firstDayOfMonth);
			$month_date = [];
			while ($currentDateObj >= $firstDayOfMonthObj) {
				$month_date[] = $currentDateObj->format("Y-m-d");
				$currentDateObj->modify("-1 day");
			}
			$month_date = array_reverse($month_date);
		} else {
			$database_exdate = array();
			$currentDate = Utctodate('Y-m-d', $this->timezone, date("Y-m-d"));
			$firstDayOfMonth = Utctodate('Y-m-01', $this->timezone, date("Y-m-01"));
			$currentDateObj = new \DateTime($currentDate);
			$firstDayOfMonthObj = new \DateTime($firstDayOfMonth);
			while ($currentDateObj >= $firstDayOfMonthObj) {
				$month_date[] = $currentDateObj->format("Y-m-d");
				$currentDateObj->modify("-1 day");
			}
		}
		$year_Number2 = $_POST['temp'];
		$startDate = new \DateTime('first day of this month');
		$endDate = new \DateTime('last day of this month');
		$atte_header = "";
		if (isset($_POST['temp']) && $_POST['temp'] != '') {
			$year_Number = $_POST['temp'];
			$year_Number = explode('-', $year_Number);
			$month = $year_Number[1];
			$year = $year_Number[0];
			$datess = getCustomMonthDays($year, $month, 'Y-m-d');
			$datess_day = getCustomMonthDays($year, $month, 'd');
			$atte_header .= '
            <tr>
                <th style="width:97.975px;">Name</th>';
			if (is_array($datess_day)) {
				foreach ($datess_day as $key => $values) {
					$atte_header .= '<th>' . $values . '</th>';
				}
			} 
			// foreach ($datess_day as $key => $values) {
			// 	pre($datess_day);
			// 	$atte_header .= '<th>' . $values . '</th>';
			// }
			$atte_header .= '<th>Present</th>
                        <th>Absent</th>
                    </tr>
                ';
		} else {
			$datess = array();
			while ($startDate <= $endDate) {
				$datess[] = $startDate->format('Y-m-d');
				$datess_day[] = $startDate->format('d');
				$startDate->modify('+1 day');
				$count = count($datess);
			}
			$atte_header .= '<tr>
                				<th>Name</th>';
			if(is_array($datess_day)){
				foreach ($datess_day as $key => $values) {
					$atte_header .= '<th>' . $values . '</th>';
				}
			}
			$atte_header .= '<th>Present</th>
							 <th>Absent</th>
						</tr>';
		}
		$table_username = 'admin';
		$todays = Utctodate("Y-m-d", $this->timezone, date("Y-m-d"));
		if (isset($year_Number)) {
			$qury = "SELECT * FROM " . $table_username . "_attendance WHERE DATE_FORMAT(punch_date, '%Y-%m') = '$year_Number2' ORDER BY id DESC";
		} else {
			$qury = "SELECT * FROM  " . $table_username . "_attendance WHERE MONTH(punch_date) = MONTH(CURDATE()) ORDER BY id DESC";
		}
		$db_connection = \Config\Database::connect('second');
		$result = $db_connection->query($qury);
		$attendence_check = $result->getResultArray();
		$getchild = '';
		$getchild = getChildIds($_SESSION['id']);

		$user_get = "SELECT * FROM " . $table_username . "_user WHERE switcher_active = 'active' AND NOT id = 1 ORDER BY id ASC";
		$user_result = $db_connection->query($user_get);
		$firstNames = $user_result->getResultArray();
		foreach ($firstNames as $key => $value2) {
			$access =  0;
			if ($this->admin == 1) {
				$access =  1;
			} elseif (in_array($value2['id'], $getchild)) {
				$access =  1;
			} elseif ($value2['id'] == $_SESSION['id']) {
				$access =  1;
			}

			if ($access == 1) {
				if (!empty($value2['created_at']) && $value2['created_at'] != "0000-00-00 00:00:00") {
					$user_created_date = date('Y-m-d', strtotime($value2['created_at']));
				} else {
					$user_created_date = '2023-03-08';
				}
				if (!empty($value2['created_at']) && $value2['created_at'] != "0000-00-00 00:00:00") {
					$user_created_date = Utctodate("Y-m-d", $this->timezone, $value2['created_at']);
				} else {
					$user_created_date = '2023-03-08';
				}
				$html .= '<tr>';
				$html .= '<td class="ps-3 pe-2 text-center fs-14">';
				if ($this->admin == 1) {
					$html .= $value2['firstname'];
				}else{
					$html .= $value2['firstname'];
				}
				// $html .= $value2['firstname'];
				$html .= '</td>';
				$i = 1;
				$present_total = 0;
				$absent_total = 0;
				if(is_array($datess)){
				foreach ($datess as $date => $vall) {
					$vall2 =  Utctodate("Y-m-d", $this->timezone, $vall);
					$html .= '<td class="align-middle text-center">';
					$isChecked = false;
					foreach ($attendence_check as $date => $val_date) {
						$fullDayName = Utctodate("l", $this->timezone, $vall);
						$monthNumber = $_POST['attendance_month'];
						$year_Number = $_POST['temp'];
						$dateString2 = $val_date['punch_date'];
						$date2 = new \DateTime($dateString2);
						$year = $date2->format('Y-m');
						$data_date = Utctodate("Y-m-d", $this->timezone,   $val_date['punch_date']);
						if ($data_date == $vall && $val_date['user_id'] == $value2['id']) {
							$isChecked = true;
							break;
						}
					}
					if ($user_created_date > $vall2) {
						$html .= '<input type="checkbox" id="checkbox">';
					} else if ((isset($val_date) && !empty($val_date) && $isChecked) || (isset($val_date) && $val_date['status'] === 1)) {
						$html .= '<div class="position-relative at-check-main">';
						$html .= '<i class="fa-solid fa-square-check present fs-14"></i>';
						if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
							$puncharray = 0;
							if ($val_date['punch_time_array']) {
								$decodedPunchDate = json_decode($val_date['punch_time_array'], true);
								if (is_array($decodedPunchDate)) {
									$puncharray = $decodedPunchDate;
								}
							}
							$html .= '<div class="hidden-div shadow">
									<div class="text-end mb-2">
										<i class="bi bi-pencil text-dark cursor-pointer edti" data-bs-toggle="modal" data-id=' . $val_date['id'] . '  data-day_pre="present"  data-user_id=' . $val_date['user_id'] . ' data-bs-target="#attendance_edit" AttendanceDate="' . $vall . '"></i>
									</div>';
							if (is_array($puncharray)) {
								for ($i = 0; $i < count($puncharray); $i += 2) {
									$inTime = isset($puncharray[$i]) ? $puncharray[$i] : '';
									$outTime = isset($puncharray[$i + 1]) ? $puncharray[$i + 1] : '';
									$utcINTime = Utctodate('h:i A', $this->timezone, $inTime);
									$utcOutTime = Utctodate('h:i A', $this->timezone, $outTime);
									$html .= '<div class="d-flex">
												<i class="fa-solid fa-person-walking-arrow-right me-1"></i>
												<span>' . $utcINTime . '</span>
											</div>';
									if (isset($outTime) && $outTime != '') {
										$html .= '<div class="d-flex">
												<i class="fa-solid fa-person-walking-arrow-right me-1 rotate-180"></i>
												<span>' . $utcOutTime . '</span>
											</div>';
									}
								}
							}
							$html .= '</div></div>';
						}
						$present_total++;
					} else {
						if (in_array($vall, $month_date)) {
							if (isset($val_date) && $val_date['status'] === 1) {
								$html .= '<div class="position-relative at-check-main">';
								$html .= '<i class="fa-solid fa-square-check present fs-14"></i>';
								if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
									$puncharray = 0;
									if ($val_date['punch_time_array']) {
										$decodedPunchDate = json_decode($val_date['punch_time_array'], true);
										if (is_array($decodedPunchDate)) {
											$puncharray = $decodedPunchDate;
										}
									}
									if (is_array($puncharray)) {
										for ($i = 0; $i < count($puncharray); $i += 2) {
											$inTime = isset($puncharray[$i]) ? $puncharray[$i] : '';
											$outTime = isset($puncharray[$i + 1]) ? $puncharray[$i + 1] : '';
											$utcINTime = Utctodate('h:i A', $this->timezone, $inTime);
											$utcOutTime = Utctodate('h:i A', $this->timezone, $outTime);
											$html .= '<div class="d-flex">
														<i class="fa-solid fa-person-walking-arrow-right me-1"></i>
														<span>' . $utcINTime . '</span>
													</div>';
											if (isset($outTime) && $outTime != '') {
												$html .= '<div class="d-flex">
														<i class="fa-solid fa-person-walking-arrow-right me-1 rotate-180"></i>
														<span>' . $utcOutTime . '</span>
													</div>';
											}
										}
									}
								}
								$html .= '</div>';
							} else {
								$html .= '<div class="position-relative at-check-main">';
								$html .= '<i class="fa-solid fa-square-xmark absent fs-14"></i>';
								if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
									$html .= '<div class="hidden-div shadow">
										<div class "text-end mb-2">
											<i class="bi bi-pencil text-dark cursor-pointer edti" data-bs-toggle="modal" data-bs-target="#attendance_edit" data-id="" data-day_pre="absent"  data-in_time=""   data-user_id=' . $value2['id'] . ' data-out_time="" AttendanceDate="' . $vall . '" data-entry_date="' . $vall . '"></i>
										</div>
										<div class="d-flex">
											<i class="fa-solid fa-person-walking-arrow-right me-1"></i>
											<span>00:00</span>
										</div>
										<div class="d-flex">
											<i class="fa-solid fa-person-walking-arrow-right me-1 rotate-180"></i>
											<span>00:00</span>
										</div>
									</div>';
								}
								$html .= '</div>';
								$absent_total++;
							}
						} else {
							$html .= '<input type="checkbox" id="checkbox"  >';
						}
					}
					$html .= '</td>';
				}
				}
				$html .= '<td class="text-center"><b>' . $present_total . '</b></td>
							<td class="text-center"><b>' . $absent_total . '</b></td>';
				$html .= '</tr>';
			}

		
		}
		$results['response'] = 1;
		$results['html'] = $html;
		$results['atte_header'] = $atte_header;
		return json_encode($results);
	}
    public function check_user_biometric_data()
	{
		$response = 0;
		if ($_POST['emp_id'] != '') {
			$db_connection = \Config\Database::connect('second');
			$table_name =  $this->username . '_' . $_POST['table'];
			if ($_POST['edit_id'] != '') {
				$sql = 'SELECT *
				FROM ' . $table_name . '
				WHERE id not in (' . $_POST['edit_id'] . ') AND emp_id = ' . $_POST['emp_id'] . '';
			} else {
				$sql = 'SELECT *
				FROM ' . $table_name . '
				WHERE emp_id = ' . $_POST['emp_id'] . '';
			}
			$resultss = $db_connection->query($sql);
			$biometric_data = $resultss->getResultArray();
			if ($biometric_data) {
				$response = 1;
			} else {
				$response = 0;
			}
		}
		echo $response;
	}
}
?>