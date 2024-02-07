<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use CodeIgniter\I18n\Time;

class Bot_Controller extends BaseController
{
	public function __construct()
	{
		helper('custom');
		helper('custom1');
		$db = db_connect();
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->username = session_username($_SESSION['username']);
		$this->admin = 0;
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
	}
	public function bot_messenger()
	{
		return view('bot_messenger');
	}


	// public function messenging_bot_insert_data()
	// {
	// 	$defaultTimezone = 'UTC';
	// 	$timezoneToUse = timezonedata();
	// 	$transaction_date = $this->request->getPost("transaction_date");

	// 	$post_data = $this->request->getPost();
	// 	$table_name = $this->request->getPost("table");

	// 	$action_name = $this->request->getPost("action");
	// 	if ($this->request->getPost("action") == "insert") {
	// 		unset($_POST['action']);
	// 		unset($_POST['table']);
	// 		if (!empty($_POST)) {
	// 			$insert_data = $_POST;

	// 			if (isset($transaction_date) && !empty($transaction_date)) {
	// 				$insert_data['transaction_date'] = UtcTime('Y-m-d', $timezoneToUse, $transaction_date);
	// 			}
	// 			$isduplicate = $this->duplicate_data($insert_data, $table_name);
	// 			if ($isduplicate == 0) {
	// 				$insert_data['status'] = 'new';
	// 				$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
	// 				return json_encode(['status' => 'success', 'userStatus' => 'new', 'insertedData' => $response]);
	// 			} else {
	// 				$insert_data['status'] = 'old';	
	// 				return json_encode(['status' => 'duplicate', 'userStatus' => 'old']);
	// 			}
	// 		}
	// 	}
	// }

	public function messenging_bot_insert_data()
	{
		$defaultTimezone = 'UTC';
		$timezoneToUse = timezonedata();
		$transaction_date = $this->request->getPost("transaction_date");

		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");

		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;

				if (isset($transaction_date) && !empty($transaction_date)) {
					$insert_data['transaction_date'] = UtcTime('Y-m-d', $timezoneToUse, $transaction_date);
				}
				$isduplicate = $this->duplicate_data($insert_data, $table_name);
				if ($isduplicate == 0) {
					$insert_data['status'] = 'new';
					$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
					return json_encode(['status' => 'success', 'userStatus' => 'new', 'insertedData' => $response]);
				} else {

					$isduplicate = $this->duplicate_data($insert_data, $table_name);
					return json_encode(['status' => 'duplicate']);
				}
			}
		}
	}


	public function duplicate_data($data, $table)
	{
		$this->db = \Config\Database::connect();
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
		$secondDb = \Config\Database::connect('second');
		$result = $secondDb->query($sql);
		if ($result->getNumRows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	public function update_data_conversion()
	{
		$table_username = getMasterUsername2();
		$GetOldConversation = get_editData2($table_username . '_messeging_bot', intval($_POST['edit_id']));
		$currentDate = date("d-m-Y");
		$currentDate = UtcTime('d-m-Y', timezonedata(), $currentDate);
		// $master_id = $this->master_id;
		$current_time = date('H:i');
		$current_time = UtcTime('H:i', timezonedata(), $current_time);
		if ($_POST['chat'] !== "") {
			$old_chat = $GetOldConversation['chatting'];
			$chat = $_POST['chat'];
			$user_chat = array(
				// "user_id" => $master_id,
				"chat" => $chat,
				"date" => $currentDate,
				"time" => $current_time
			);
			$chatArray = json_encode($user_chat);
			if ($old_chat == "") {
				$update_chat = $chatArray;
			} else {
				$update_chat = $old_chat . "[,]" . $chatArray;
			}
			$post_data = $this->request->getPost();
			$table = $_POST['table'];
			$table_name = $this->username . '_' . $table;
			$action_name = $this->request->getPost("action");
			$update_id = $this->request->getPost("edit_id");
			$response = 0;
			if ($this->request->getPost("action") == "update") {
				unset($_POST['action']);
				unset($_POST['edit_id']);
				unset($_POST['table']);
				unset($_POST['chat']);
				unset($_POST['date']);
				unset($_POST['time']);
				$update_data = $_POST;
				$update_data['chatting'] = $update_chat;
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table);
				$response = 1;
			}
			return $update_chat;
			die();
		} else {
			$old_convertsaion = $GetOldConversation['chatting'];
			$edit_id = $_POST['edit_id'];
			$table = $_POST['table'];
			$attachment = $_POST['attachment_files'];
			$attachment_array = explode(',', $attachment);
			$name = "";
			$chatArray = array();
			foreach ($attachment_array as $file) {
				$user_chat = array(
					// "user_id" => $master_id,
					"chat" => "",
					"date" => $currentDate,
					"time" => $current_time,
					"attachment" => $file
				);
				$chatArray[] = json_encode($user_chat);
			}
			$chatString = implode('[,]', $chatArray);
			if ($chatString !== "") {
				$newstring = $old_convertsaion . "[,]" . $chatString;
				$update_data['chatting'] = $newstring;
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($edit_id, $update_data, $table);
			}
			$files = $_FILES;
			if (!empty($files)) {
				$uploadDir = 'assets/support_ticket_store/';
				if (!is_dir($uploadDir)) {
					mkdir($uploadDir, 0777, true);
				}
				$filesArr = $_FILES["attachment"];
				$fileNames = array_filter($filesArr['name']);
				$uploadedFile = '';
				foreach ($filesArr['name'] as $key => $val) {
					$fileName = basename($filesArr['name'][$key]);
					$targetFilePath = $uploadDir . $fileName;
					$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
					if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
						if ($fileName !== "") {
							if (strlen($fileName) == 1) {
								$uploadedFile .= $fileName;
							} else {
								$uploadedFile .= $fileName;
							}
						}
					} else {
						$uploadStatus = 0;
						$response['message'] = 'Sorry, there was an error uploading your file.';
					}
				}
			}
		}
	}

	public function messeging_bot_list_data()
	{
		$baseurl = base_url();
		$currentDate = date("d-m-Y");
		$currentDate = UtcTime('d-m-Y', timezonedata(), $currentDate);
		$currentDate = Utctodate('d-m-Y', timezonedata(), $currentDate);

		$previousDate = date("d-m-Y", strtotime("-1 day"));
		$previousDate = UtcTime('d-m-Y', timezonedata(), $previousDate);
		$previousDate = Utctodate('d-m-Y', timezonedata(), $previousDate);

		$table_name = $_POST['table'];
		$action = $_POST['action'];
		$user_id = $_POST['user_id'];
		$html = "";
		$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $user_id);
		foreach ($departmentEditdata as $d_key => $d_value) {
		}
		if (isset($d_value->chatting)) {
			if ($d_value->chatting !== "") {
				$file_array = explode('[,]', $d_value->chatting);
				$uniqueDates = array();

				$html .= '
									<div class="bot-msg-bg-color-bg p-4 rounded-2" style="background-color: #82a7de3d;">
										<div class="msg-content">
											<p>Hi there! 👋, <br><br>Welcome to live chat support. <br><br>How can we help you today?</p>
										</div>
									</div>
									<span class="chat-time d-inline-block text-muted text-body-tertiary d-inline-block text-lowercase" style="font-size:14px;" id="current-time">
									</span>
							
									<script>
										var currentTime = new Date();
										var formattedTime = currentTime.toLocaleTimeString([], {
											hour: "2-digit",
											minute: "2-digit"
										});
										document.getElementById("current-time").innerText = formattedTime;
									</script>
								';


				foreach ($file_array as $key => $value) {
					$vv = json_decode($value, true);
					// pre($vv);
					$html .= '';
					$date = $vv["date"];
					$date = Utctodate('d-m-Y', timezonedata(), $date);

					// if (!in_array($date, $uniqueDates)) {
					// 	$uniqueDates[] = $date;
					// 	if($date == $currentDate){
					// 		$html .='
					// 		<div class="user-chat-box col-12 user-day-chat w-100 text-center">
					// 			<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">Today</p>
					// 		</div>';			
					// 	}else if($date == $previousDate){
					// 		$html .='
					// 			<div class="user-chat-box col-12 user-day-chat w-100 text-center">
					// 				<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">Yesterday</p>
					// 			</div>';
					// 	}else{
					// 		$html .='
					// 			<div class="user-chat-box col-12 user-day-chat w-100 text-center">
					// 				<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">'.$date.'</p>
					// 			</div>';
					// 	}
					// }
					if ($vv["chat"] !== "") {
						// pre($vv["chat"]);
						// if($vv["user_id"] !== "ADMIN"){						
						$html .= '
			
											<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">
												<div class="user-chat rounded-2 p-2 shadow-sm d-inline-block position-relative text-start text-white" style="max-width: 50%; background-color: #724EBF;">' . $vv["chat"] . '
													
												</div>

												<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase col-12" style="font-size:14px;">' . Utctodate('H:i', timezonedata(), $vv["time"]) . '
												</div>
											</div>';
					}

				}



				// foreach ($file_array as $key => $value) {
				$vv = json_decode($value, true);
				// pre($vv);
				$html .= '';
				$date = $vv["date"];
				$date = Utctodate('d-m-Y', timezonedata(), $date);

				// if (!in_array($date, $uniqueDates)) {
				// 	$uniqueDates[] = $date;
				// 	if($date == $currentDate){
				// 		$html .='
				// 		<div class="user-chat-box col-12 user-day-chat w-100 text-center">
				// 			<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">Today</p>
				// 		</div>';			
				// 	}else if($date == $previousDate){
				// 		$html .='
				// 			<div class="user-chat-box col-12 user-day-chat w-100 text-center">
				// 				<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">Yesterday</p>
				// 			</div>';
				// 	}else{
				// 		$html .='
				// 			<div class="user-chat-box col-12 user-day-chat w-100 text-center">
				// 				<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">'.$date.'</p>
				// 			</div>';
				// 	}
				// }
				// if($vv["chat"] !== ""){
				// 	// pre($vv["chat"]);
				// 	// if($vv["user_id"] !== "ADMIN"){						
				// 		$html .='



				// 		<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">
				// 			<div class="user-chat bg-white rounded-2 p-2 shadow-sm d-inline-block position-relative text-start" style="max-width: 50%;">'.$vv["chat"].'
				// 				<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">'.Utctodate('H:i', timezonedata(), $vv["time"]).'
				// 				</div>
				// 			</div>
				// 		</div>';
				// echo $html;
				// }
				// if($vv["user_id"] == "ADMIN" || $vv["user_id"] == " "){
				// $html .='
				// 	<div class="user-chat-box user-right-chat w-100 text-start mb-2 user_controller_chat">
				// 		<div class="user-chat bg-white rounded-2 p-2 shadow-sm d-inline-block position-relative text-start" style="max-width: 50%;">'.$vv["chat"].'
				// 			<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">'.Utctodate('H:i', timezonedata(), $vv["time"]).'
				// 			</div>
				// 		</div>
				// 	</div>';
				// }
				// }else{
				// 	if(isset($vv['attachment'])){
				// 		// pre($vv["user_id"]);
				// 		// die();
				// 		// if($vv["user_id"] != "ADMIN" && $vv["user_id"] != ''){	
				// 				$filename = $vv['attachment'];
				// 				$file_info = pathinfo($filename);
				// 				$extension = strtolower($file_info['extension']);
				// 				$image_extensions = array("jpg", "jpeg", "png", "gif", "bmp");
				// 				if (in_array($extension, $image_extensions)) {
				// 					$html .='
				// 					<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">
				// 						<div class="user-chat rounded-2 p-2 d-inline-block position-relative text-start"
				// 							style="max-width: 50%;"><span href="'.$baseurl.'assets/support_ticket_store/'.$filename.'" class="file_attachment_open_div cursor-pointer">
				// 							<img src="'.$baseurl.'assets/support_ticket_store/'.$filename.'" alt="" style="max-width: 150px; height: auto;" class="d-block rounded-2"></span>
				// 							<div class="user-chat-time text-body-tertiary d-block text-lowercase">
				// 								'.Utctodate('H:i', timezonedata(), $vv["time"]).'
				// 							</div>
				// 						</div>
				// 					</div>';

				// 				} else {
				// 					$html .='
				// 					<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">
				// 						<div class="user-chat bg-white rounded-2 p-2 shadow-sm border d-inline-block position-relative text-start"
				// 							style="max-width: 50%;">
				// 							<img src="https://dev.realtosmart.com/assets/images/chat-document.svg" alt="">
				// 							<span href="'.$baseurl.'assets/support_ticket_store/'.$vv["attachment"].'" class="file_attachment_open_div cursor-pointer">
				// 							'.$vv["attachment"].'</span>
				// 							<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">
				// 							'.Utctodate('H:i', timezonedata(), $vv["time"]).'
				// 							</div>
				// 						</div>
				// 					</div>';
				// 				}
				// 		// }
				// 		// if($vv["user_id"] == "ADMIN" && $vv["user_id"] == ''){
				// 			if(isset($vv['attachment'])){
				// 				$filename = $vv['attachment'];
				// 				$file_info = pathinfo($filename);
				// 				$extension = strtolower($file_info['extension']);
				// 				$image_extensions = array("jpg", "jpeg", "png", "gif", "bmp");
				// 				if (in_array($extension, $image_extensions)) {
				// 					$html .='
				// 					<div class="user-chat-box user-right-chat w-100 text-start mb-2 user_controller_chat">
				// 						<div class="user-chat rounded-2 p-2 d-inline-block position-relative text-start"
				// 							style="max-width: 50%;"><span href="http://localhost/RealtoSmartAdmin/assets/support_ticket_store_admin/'.$filename.'" class="file_attachment_open_div cursor-pointer">
				// 							<img src="http://localhost/RealtoSmartAdmin/assets/support_ticket_store_admin/'.$filename.'" alt="" style="max-width: 150px; height: auto;" class="d-block rounded-2"><span>
				// 							<div class="user-chat-time text-body-tertiary d-block text-lowercase">
				// 								'.Utctodate('H:i', timezonedata(), $vv["time"]).'
				// 							</div>
				// 						</div>
				// 					</div>';
				// 				} else {
				// 					$html .='
				// 					<div class="user-chat-box user-right-chat w-100 text-start mb-2 user_controller_chat">
				// 						<div class="user-chat bg-white rounded-2 p-2 shadow-sm border d-inline-block position-relative text-start"
				// 							style="max-width: 50%;">
				// 							<img src="https://dev.realtosmart.com/assets/images/chat-document.svg" alt=""> <span href="http://localhost/RealtoSmartAdmin/assets/support_ticket_store_admin/'.$vv["attachment"].'" class="file_attachment_open_div cursor-pointer" >
				// 							'.$vv["attachment"].' </span>
				// 							<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">
				// 							'.Utctodate('H:i', timezonedata(), $vv["time"]).'
				// 							</div>
				// 						</div>
				// 					</div>';
				// 				}
				// 			}
				// 		// }
				// 	}
				// }
				// }
			}
		}
		if (!empty($html)) {
			echo $html;
		} else {
			echo '
				<div class="bot-msg-bg-color-bg p-4 rounded-2" style="background-color: #82a7de3d;">
					<div class="msg-content">
						<p>Hi there! 👋, <br><br>Welcome to live chat support. <br><br>How can we help you today?</p>
					</div>
				</div>
				<span class="chat-time d-inline-block text-muted" style="font-size:14px; " id="current-time">
				</span>
		
				<script>
					var currentTime = new Date();
					var formattedTime = currentTime.toLocaleTimeString([], {
						hour: "2-digit",
						minute: "2-digit"
					});
					document.getElementById("current-time").innerText = formattedTime;
				</script>
					';
		}
	}


	//bot question add
	public function bot_insert_data()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$bot_id = $this->request->getPost("bot_id");

		if ($action_name == "insert" && !empty($post_data)) {
			unset($post_data['action']);
			unset($post_data['table']);

			$max_sequence = $this->MasterInformationModel->get_max_sequence($table_name, $bot_id);

			if ($max_sequence === null) {
				$sequence = 1;
			} else {
				$sequence = $max_sequence + 1;
			}
			$post_data['sequence'] = $sequence;

			$response = $this->MasterInformationModel->insert_entry2($post_data, $table_name);
			$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
			$departmentdisplaydata = json_decode($departmentdisplaydata, true);
		}

		if ($this->request->getPost("action") == "bot_insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;

				$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				return 1;
			} else {
				return 0;
			}
		}
		die();
	}

	//bot duplicate question add
	public function duplicate_Question() 
	{
		$table_username = getMasterUsername2();
		$questionId = $this->request->getPost("questionId");
		$db = \Config\Database::connect('second');
		$sql = 'SELECT * FROM ' . $table_username . '_bot_setup WHERE id = ' . $questionId;
		$result = $db->query($sql);
		$question_data = $result->getRowArray();

		$insertedId = $this->insertQuestionData($question_data);
		return $insertedId;
	}


	//bot insert duplicate question
	private function insertQuestionData($question_data) 
	{
		$table_username = getMasterUsername2();
		$db = \Config\Database::connect('second');
		$table_name = $this->request->getPost("table");
		$existing_records_count = $this->MasterInformationModel->get_record_count($table_name);
		$_SESSION['records_count'] = $existing_records_count;
		$_SESSION['records_count']++;
		$question_data['sequence'] = $_SESSION['records_count'];
		// $question_data['sequence'] = 0;
		unset($question_data['id']);

		$db->table($table_username . '_bot_setup')->insert($question_data);
		return $db->insertID();
	}


	//update question sequence
	public function update_sequence()
	{
		$droppedQuestionId = $_POST['droppedQuestionId'];
		$targetQuestionId = $_POST['targetQuestionId'];
		$droppedSequence = $_POST['droppedSequence'];
		$targetSequence = $_POST['targetSequence'];
		
		$db = \Config\Database::connect('second');
		$table_username = getMasterUsername2();

		$db->transStart();
		$db->table($table_username . '_bot_setup')
		->where('id', $droppedQuestionId)
		->set('sequence', $droppedSequence)
		->update();

		$db->table($table_username . '_bot_setup')
		->where('id', $targetQuestionId)
		->set('sequence', $targetSequence)
		->update();

		$db->transComplete();

		if ($db->transStatus() === FALSE) {
			echo "Transaction failed!";
		} else {
			echo "Sequence updated successfully!";
		}
	}


	//edit question 
	public function bot_question_edit_data()
	{
		if ($this->request->getPost("action") == "edit") {
			$edit_id = $this->request->getPost('edit_id');
			$table_name = $this->request->getPost('table');
			$username = session_username($_SESSION['username']);
			$departmentEditdata = $this->MasterInformationModel->edit_entry2($username . "_" . $table_name, $edit_id);
			return json_encode($departmentEditdata, true);
		}
		die();
	}


	public function bot_question_update()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$reports_name = "";
		if (isset($_POST['reports_name'])) {
			$reports_name2 = $_POST['reports_name'];
			$reports_name = implode(',', $reports_name2);
		}
		$integrations_type = "";
		if (isset($_POST['integration_type'])) {
			$integration_type2 = $_POST['integration_type'];
			$integrations_type = implode(',', $integration_type2);
		}
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			//print_r($_POST);
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			unset($_POST['reports_name']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				//pre($integrations_type);
				if ($reports_name != '') {
					$update_data['reports_name'] = $reports_name;
				}
				if ($integrations_type != '') {
					$update_data['integration_type'] = $integrations_type;
				}
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;
				
			}
		}
		echo $response;
		die();
	}

	//bot delete question
	public function bot_delete_data()
	{
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			$delete_displaydata = $this->MasterInformationModel->delete_entry3($table_name, $delete_id);

			if(!isset($_POST['bot'])) {
                $this->MasterInformationModel->delete_question_sequence($table_name);
            }
            echo "success";
		}
		die();
	}

	

	//bot list question
	public function bot_list_data()
	{
		$table_name = $_POST['table'];
		$action = $_POST['action'];
		$bot_id = $_POST['bot_id'];
		$botdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
		$botdisplaydata = json_decode($botdisplaydata, true);
		$html = "";

		usort($botdisplaydata, function($a, $b) {
			return $a['sequence'] <=> $b['sequence'];
		});

		foreach ($botdisplaydata as $key => $value) {
			if($value['bot_id'] == $bot_id){
				$html .= '
					<div class="col-12 w-100 d-flex flex-wrap p-2 cursor-pointer drag_question">
						<div class="col-12 droppable d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup" draggable="true">
							<div class="col-10 d-flex flex-wrap align-items-center">
								<label class="text-wrap px-2" for="">';
								if(isset($value['type_of_question']) && $value['type_of_question'] == 1) {
									$html .= '<i class="fa fa-question"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 2){
									$html .= ' <i class="fa-regular fa-circle-dot"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 3){
									$html .= ' <i class="fa fa-envelope"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 4){
									$html .= ' <i class="fa fa-check-square"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 5){
									$html .= ' <i class="fa-solid fa-mobile-screen-button"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 6){
									$html .= ' <i class="fa fa-hashtag"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 7){
									$html .= ' <i class="fa fa-star"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 8){
									$html .= ' <i class="fa-regular fa-calendar-days"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 9){
									$html .= ' <i class="fa-regular fa-clock"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 10){
									$html .= ' <i class="fa-solid fa-location-dot"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 11){
									$html .= ' <i class="fa fa-expand"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 12){
									$html .= ' <i class="fa fa-upload"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 13){
									$html .= ' <i class="fa fa-link"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 14){
									$html .= ' <i class="fa fa-user-plus"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 15){
									$html .= ' <i class="fa fa-shopping-cart"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 16){
									$html .= ' <i class="fa fa-key"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 17){
									$html .= ' <i class="fa-brands fa-forumbee"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 18){
									$html .= ' <i class="fa fa-list"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 19){
									$html .= ' <i class="fa fa-bullseye"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 20){
									$html .= ' <i class="fa fa-search"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 21){
									$html .= ' <i class="fa-regular fa-calendar-check"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 22){
									$html .= ' <i class="fa-solid fa-quote-left"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 23){
									$html .= ' <i class="fa-regular fa-compass"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 24){
									$html .= ' <i class="fa-sharp fa-solid fa-sliders"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 25){
									$html .= ' <i class="fa-regular fa-image"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 26){
									$html .= ' <i class="fa-regular fa-file-audio"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 27){
									$html .= ' <i class="fa-sharp fa-solid fa-address-book"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 28){
									$html .= ' <i class="fa-sharp fa-solid fa-paper-plane"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 29){
									$html .= ' <i class="fa-solid fa-file"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 30){
									$html .= ' <i class="fa-solid fa-arrow-up-right-from-square"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 31){
									$html .= ' <i class="fa-solid fa-scissors"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 32){
									$html .= ' <i class="fa-solid fa-earth-americas"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 33){
									$html .= ' <i class="fa-solid fa-signs-post"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 34){
									$html .= ' <i class="fa-regular fa-circle-question"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 35){
									$html .= ' <i class="fa-brands fa-wpexplorer"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 36){
									$html .= ' <i class="fa-solid fa-headphones"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 37){
									$html .= ' <i class="fa-solid fa-diamond-turn-right"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 38){
									$html .= ' <i class="fa-solid fa-comment-dots"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 39){
									$html .= ' <i class="fa-solid fa-users"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 40){
									$html .= ' <i class="fa-solid fa-list-ol"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 41){
									$html .= ' <i class="fa-solid fa-cart-shopping"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 42){
									$html .= ' <i class="fa-brands fa-whatsapp"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 43){
									$html .= ' <i class="fa-solid fa-cart-arrow-down"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 44){
									$html .= ' <i class="fa-solid fa-map-pin"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 45){
									$html .= ' <i class="fa-solid fa-rectangle-ad"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 46){
									$html .= ' <i class="fa-brands fa-instagram"></i>';
								}else if(isset($value['type_of_question']) && $value['type_of_question'] == 47){
									$html .= ' <i class="fa-brands fa-instagram"></i>';
								}
								
							$html .= '
								<p class="fw-semibold d-inline block mx-2 cursor-pointer sequence" data-id='.$value['id'].' data-sequence='.$value['sequence'].'>' . $value['question'] . '</p>
							</label>
						</div>
						<div class="col-2 d-flex flex-wrap align-items-center">
							<div class="col-3 p-1">
								<i class="fa fa-pencil cursor-pointer question_edit" data-id='.$value['id'].' data-bs-toggle="modal" data-bs-target="#add-email"></i>
							</div>
							<div class="col-3 p-1">
								<i class="fa fa-sitemap cursor-pointer question_flow_edit" data-id='.$value['id'].' data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
							</div>
							<div class="col-3 p-1">
								<i class="fa fa-clone duplicate_question_add cursor-pointer" data-question='.$value['id'].'></i>
							</div>
							<div class="col-3 p-1">
								<i class="fa fa-trash question_delete cursor-pointer" data-question='.$value['id'].'></i>
							</div>
						</div>
					</div>

					<div class="col-12 d-flex justify-content-end">
						<button type="button" class="btn btn-primary">Users Replay</button>
					</div>
				</div>';
		
			}
		}
		$result['html'] = $html;
		echo json_encode($result);
		die();
	}

	public function main_bot_list_data() {
		$table_name = $_POST['table'];
		$botdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
		$botdisplaydata = json_decode($botdisplaydata, true);
		$i = 1;
		$html = "";

		foreach($botdisplaydata as $key => $value) {
			$bot_img = empty($value['bot_img']) ? base_url('') .'assets/images/bot_img/bot-1.png' : /* bot img uploading path */base_url('') .'assets/images/bot_img/bot-1.png' ;
			$html .= '
			<div class="col-3 p-2">
			<div class="card mb-3 bg-white shadow">
				<div class="row g-0 p-2">
					<div class="d-flex align-items-center">
						<div class="col-md-4 text-center">
							<div class="p-2">
								<img src="'. $bot_img .'"
											class="img-fluid rounded-start mb-1" width="30px">
										<p class="card-text"><small class="text-body-secondary">'.$value['name'].'</small></p>
									</div>
								</div>
								<div class="border h-100"></div>
								<div class="col-md-8">
									<div class="card-body d-flex flex-wrap py-1 px-2 justify-content-between">
										<div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
											data-toggle="tooltip" data-placement="top" title="Setup">
											<a href="'. base_url('') .'/bot_setup?bot_id='.$value['id'].'" class="text-muted">
												<i class="fa-solid fa-screwdriver-wrench"></i>
											</a>
										</div>
										<div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
											data-toggle="tooltip" data-placement="top" title="Trigger">
											<a href="#" class="text-muted">
												<i class="fa-solid fa-bell"></i>
											</a>
										</div>
										<div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
											data-toggle="tooltip" data-placement="top" title="Bot Chats">
											<a href="#" class="text-muted">
												<i class="fa-solid fa-comment"></i>
											</a>
										</div>
										<div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
											data-toggle="tooltip" data-placement="top" title="Setting">
											<a href="#" class="text-muted">
												<i class="fa-solid fa-gear"></i>
											</a>
										</div>
									</div>
									<div
										class="card-body d-flex flex-wrap py-1 px-2 justify-content-between align-items-center">
										<div class="form-check form-switch">
											<input class="form-check-input bot_active" type="checkbox" role="switch" id="is_active"
												'.($value['active'] == 1 ? 'checked' : '').' data-update_id="'.$value['id'].'">
											<label class="form-check-label" for="is_active">Active</label>
										</div>
										<div class="border rounded d-inline w-auto p-1 px-2 icon-box2 text-muted bot_delete"
                                            data-toggle="tooltip" data-placement="top" title="Delete" data-delete_id="'.$value['id'].'">
                                            <i class="fa-solid fa-trash"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			';
		}

		return $html;
	}

	public function bot_update() {
		if ($this->request->getPost("action") == "update") {
			$update_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			unset($_POST['id']);
			unset($_POST['table']);
			unset($_POST['action']);
			if($_POST['type'] == 'activation') {
				$second_table = $this->request->getPost('second_table');
				unset($_POST['type']);
				unset($_POST['second_table']);
				$botdisplaydata = $this->MasterInformationModel->display_all_records2($second_table);
				$botdisplaydata = json_decode($botdisplaydata);
				$i = 0;
				foreach ($botdisplaydata as $key => $val) {
					if($val->bot_id == $update_id) {
						$i++;
					}
				}

				if($i <= 0 && $_POST['active'] == 1) {
					return 'empty';
				}
			}
			$update_data = $_POST;
			$delete_displaydata = $this->MasterInformationModel->update_entry2($update_id,$update_data,$table_name);

            echo "success";
		}
	}
}