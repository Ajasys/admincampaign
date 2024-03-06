<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use DateTime;
use DateTimeZone;

class CronController extends BaseController
{
	public function __construct()
	{
		helper('cron');
		$db = db_connect();
		$this->MasterInformationModel = new MasterInformationModel($db);
	}
	public function timezonedata($masterId)
	{
		// this function is give Selected Timezone The Of user  
		$db = DatabaseSecondConnection();
		if (isset($masterId)) {
			$cat = $db->query("SELECT * FROM master_user WHERE id =" . $masterId);
			$result = $cat->getResultArray();
		}
		if (isset($result[0]['timezone'])) {
			return $result[0]['timezone'];
		} else {
			return 'Asia/Kolkata';
		}
	}
	public function general_setting_verify_connection()
	{
		$db = DatabaseDefaultConnection();
		$username = $this->request->getPost('username');
		$Biometric_status = $this->request->getPost('Biometric_status');
		$Corporateid = $this->request->getPost('corporateid');
		$biometric_username = $this->request->getPost('biometric_username');
		$biometric_password = $this->request->getPost('biometric_password');
		$update_id = $this->request->getPost('update_id');
		$status=0;
		$credentials = $Corporateid . ':' . $biometric_username . ':' . $biometric_password . ':true';
		$authToken = base64_encode($credentials);
		$authHeader = 'Authorization: Basic ' . $authToken;
		$url = 'https://api.etimeoffice.com/api/DownloadInOutPunchData?Empcode=ALL';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		$response_data = json_decode($response, true);
		if ($response === false) {
			// echo 'Error: ' . curl_error($ch);
			$status=1;
		}
		else
		{
			if ($response_data['Error'] == 1) {
				// echo 'Error: ' . $response_data['Msg']; 
				$status=1;
			}
			else
			{
				$insert_data['Biometric_status']=$Biometric_status;
				$insert_data['corporateid'] = $Corporateid;
				$insert_data['biometric_username'] = $biometric_username;
				$insert_data['biometric_password'] = $biometric_password;
				$insert_data['biometric_connection'] = 1;
				if($update_id>0)
				{
					$response = $this->MasterInformationModel->update_entry2($update_id, $insert_data, 'admin_generale_setting', 'id');
					$status=0;
				}
				else
				{
					$response = $this->MasterInformationModel->insert_entry2($insert_data, 'admin_generale_setting');
					$status=0;
				}
			}
		}
		echo $status;
	}
	public function biometric_setting_disconnect()
	{
		$db = DatabaseDefaultConnection();
		$update_id = $this->request->getPost('update_id');
		$status=1;
		$insert_data['Biometric_status']=0;
		$insert_data['corporateid'] = '';
		$insert_data['biometric_username'] = '';
		$insert_data['biometric_password'] = '';
		$insert_data['biometric_connection'] = 0;
		if($update_id>0)
		{
			$response = $this->MasterInformationModel->update_entry2($update_id, $insert_data, 'admin_generale_setting', 'id');
			$status=0;
		}
		echo $status;
	}
	public function biometric_member_attendance()
	{
		$first_db = DatabaseDefaultConnection();
		$today_date1 = '';
		$masterId = 1;
		$masterusername = 'admin';
		$timeZone = 'Asia/Kolkata';
		date_default_timezone_set($timeZone);
		$today_date = UtcTime('d/m/Y', $timeZone, date('Y-m-d'));
		$query90 = "SELECT * FROM admin_generale_setting ORDER BY id DESC limit 1";
		$result = $first_db->query($query90);
		$departmentdisplaydata = $result->getResult();
		if($departmentdisplaydata)
		{
			$corporateID = $departmentdisplaydata[0]->corporateid;
			$username = $departmentdisplaydata[0]->biometric_username;
			$password = $departmentdisplaydata[0]->biometric_password;
			$credentials = $corporateID . ':' . $username . ':' . $password . ':true';
			$authToken = base64_encode($credentials);
			$authHeader = 'Authorization: Basic ' . $authToken;
			$url = 'https://api.etimeoffice.com/api/DownloadPunchDataMCID?Empcode=ALL&FromDate=' . $today_date . '_00:00&ToDate=' . $today_date . '_23:59';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			$response_data = json_decode($response, true);
			if ($response === false) {
				echo 'Error: ' . curl_error($ch);
			} else {
				$response_data = json_decode($response);
				$employeePunches = [];
				if($response_data->PunchData)
				{
					$punchData = $response_data->PunchData;
					foreach ($punchData as $punch) {
						$empcode = $punch->Empcode;
						if (!isset($employeePunches[$empcode])) {
							$employeePunches[$empcode] = [];
						}
						$employeePunches[$empcode][] = $punch;
					}
					foreach ($employeePunches as $empcode => $punches) {
						$punches = array_reverse($punches);
						$empCode = str_replace('00', '', $punches[0]->Empcode);
						$query = "SELECT * FROM " . $masterusername . "_user WHERE emp_id=" . $punches[0]->Empcode;
						if ($first_db->tableExists($masterusername . "_user")) {
							$n_rows = $first_db->query($query);
							$result = $n_rows->getResultArray();
							if (!empty($result) && isset($result[0]['id'])) {
								$memberId = $result[0]['id'];
								$punchTimes = [];
								foreach ($punches as $punch) {
									$punchDateTime = DateTime::createFromFormat('d/m/Y H:i:s', $punch->PunchDate);
									if ($punchDateTime) {
										$punchTime = UtcTime('H:i:s', $timeZone, $punchDateTime->format('H:i:s'));
										$punchTimes[] = $punchTime;
									}
								}
								$totalHours = 0;
								if (count($punchTimes) >= 2) {
									$dateTimePunches = [];
									foreach ($punchTimes as $time) {
										$dateTimePunches[] = DateTime::createFromFormat('H:i:s', $time);
									}
									for ($i = 0; $i < count($dateTimePunches) - 1; $i++) {
										$diff = $dateTimePunches[$i + 1]->getTimestamp() - $dateTimePunches[$i]->getTimestamp();
										$totalHours += intval($diff / 3600);
									}
								}
								$punch_date = UtcTime('Y-m-d', $timeZone, date('Y-m-d'));
								//staff sattandance
								{
									$intime_qry = "SELECT * FROM " . $masterusername . "_attendance WHERE user_id=$memberId AND punch_date='" . $punch_date . "'";
									$intime_rows = $first_db->query($intime_qry);
									$intime_result = $intime_rows->getResultArray();
									if ($intime_rows->getNumRows() == 0) {
										$insert_data['user_id'] = $memberId;
										$insert_data['punch_date'] = $punch_date;
										$insert_data['punch_time_array'] = json_encode($punchTimes);
										$insert_data['hour_count'] = $totalHours;
										$insert_data['created_at'] = Utctodate('Y-m-d H:i:s', $timeZone, date('Y-m-d H:i:s'));
										$insert_data['is_status'] = 1;
										$insert_data['status'] = 1;
										$response_status_log = $this->MasterInformationModel->insert_entry2($insert_data, $masterusername . '_attendance');
									} else {
										$update_data['punch_time_array'] = json_encode($punchTimes);
										$update_data['hour_count'] = $totalHours;
										$this->MasterInformationModel->update_entry2($intime_result[0]['id'], $update_data, $masterusername . '_attendance');
									}
								}
							}
						}
					}
				}
			}
			curl_close($ch);
		}
	}
}
