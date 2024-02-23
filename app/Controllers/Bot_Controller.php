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
		// pre($post_data);
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$response = array();
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
		$menu_message="";
		if (isset($_POST['menu_message'])) {
			$menu_message = json_decode($_POST['menu_message'], true); // Decode JSON string to array
			if (isset($menu_message['audioFileName'])) {
				// Extract 'audioFileName'
				$audioFileName = $menu_message['audioFileName'];
				// Specify the directory where you want to save the audio files
				$uploadDirectory = 'assets/bot_audio/'; // Adjust the path as needed
				// Create the upload directory if it doesn't exist
				if (!is_dir($uploadDirectory)) {
					mkdir($uploadDirectory, 0777, true);
				}
				// Move the uploaded audio file to the specified directory
				$sourceFilePath = $_FILES['audioFile']['tmp_name'];
				// pre($sourceFilePath);
				$targetFilePath = $uploadDirectory . $audioFileName;
				if (move_uploaded_file($sourceFilePath, $uploadDirectory . $audioFileName)) {
					// File copied successfully
					$response['status'] = 'success';
					$response['message'] = 'Audio file saved successfully.';
				} else {
					// Error handling if file copy operation failed
					$response['status'] = 'error';
					$response['message'] = 'Error: Failed to save audio file.';
				}
			}
		}
		// $files= $_FILES;
		// if(!empty($files)){
		// 	$uploadDir = 'assets/bot_image/';
		// 	if (!is_dir($uploadDir)) {
		// 		mkdir($uploadDir, 0777, true);
		// 	}
		// 	$filesArr = $_FILES["images"];
		// 	$fileNames = array_filter($filesArr['name']);
		// 	$uploadedFile = '';
		// 	foreach ($filesArr['name'] as $key => $val) {
		// 		$fileName = basename($filesArr['name'][$key]);
		// 		$targetFilePath = $uploadDir . $fileName;
		// 		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
		// 		if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
		// 			if($fileName !== ""){
		// 				if(strlen($fileName) == 1){
		// 					$uploadedFile .= $fileName;
		// 				}else{
		// 					$uploadedFile .= $fileName;
		// 				}
		// 			}
		// 		} else {
		// 			$uploadStatus = 0;
		// 			$response['message'] = 'Sorry, there was an error uploading your file.';
		// 		}
		// 	}
		// }

		
		if ($this->request->getPost("action") == "update") {
			//print_r($_POST);
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			unset($_POST['reports_name']);
			unset($_POST['audioFileName']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				//pre($integrations_type);
				if ($reports_name != '') {
					$update_data['reports_name'] = $reports_name;
				}
				if ($integrations_type != '') {
					$update_data['integration_type'] = $integrations_type;
				}
				// pre($update_data);
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;

			}
		}
		echo json_encode($response);
		die();
	}

	//bot delete question
	public function bot_delete_data()
	{
		$delete_id = $this->request->getPost('id');
		$table_username = getMasterUsername2();
		$sql = 'SELECT * FROM ' . $table_username . '_bot_setup WHERE bot_id = ' . $delete_id;

		$db_connection = \Config\Database::connect('second');
		$query = $db_connection->query($sql);
		$result = $query->getResult();
		
		// If the query returns a result, proceed with the deletion
		if (empty($result)) {
			if ($this->request->getPost("action") == "delete") {
				$delete_id = $this->request->getPost('id');
				$table_name = $this->request->getPost('table');
				$delete_displaydata = $this->MasterInformationModel->delete_entry3($table_name, $delete_id);

				if (!isset($_POST['bot'])) {
					$this->MasterInformationModel->delete_question_sequence($table_name);
				}
				$response = 1;
			}
		} else {
			$response = 0;
		}

		echo $response;
		die();
	}

	public function bot_question_delete_data()
	{
		$delete_id = $this->request->getPost('id');
		
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			$bot_id = $this->request->getPost('bot_id'); 

			$delete_sequence = $this->MasterInformationModel->get_sequence_by_id($table_name, $delete_id); 
			$delete_displaydata = $this->MasterInformationModel->delete_entry3($table_name, $delete_id); 

			$this->MasterInformationModel->delete_question_sequence($table_name, $bot_id, $delete_sequence);
			
			$response = 1; 
		}

		echo $response;
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

		usort($botdisplaydata, function ($a, $b) {
			return $a['sequence'] <=> $b['sequence'];
		});

		foreach ($botdisplaydata as $key => $value) {
			if ($value['bot_id'] == $bot_id) {
				$html .= '
					<div class="col-12 w-100 d-flex flex-wrap p-2 cursor-pointer drag_question">
						<div class="col-12 droppable d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
							<div class="col-10 d-flex flex-wrap align-items-center">
								<label class="text-wrap px-2" for="">';
				if (isset($value['type_of_question']) && $value['type_of_question'] == 1) {
					$html .= '<i class="fa fa-question"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 2) {
					$html .= ' <i class="fa-regular fa-circle-dot"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 3) {
					$html .= ' <i class="fa fa-envelope"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 4) {
					$html .= ' <i class="fa fa-check-square"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 5) {
					$html .= ' <i class="fa-solid fa-mobile-screen-button"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 6) {
					$html .= ' <i class="fa fa-hashtag"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 7) {
					$html .= ' <i class="fa fa-star"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 8) {
					$html .= ' <i class="fa-regular fa-calendar-days"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 9) {
					$html .= ' <i class="fa-regular fa-clock"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 10) {
					$html .= ' <i class="fa-solid fa-location-dot"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 11) {
					$html .= ' <i class="fa fa-expand"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 12) {
					$html .= ' <i class="fa fa-upload"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 13) {
					$html .= ' <i class="fa fa-link"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 14) {
					$html .= ' <i class="fa fa-user-plus"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 15) {
					$html .= ' <i class="fa fa-shopping-cart"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 16) {
					$html .= ' <i class="fa fa-key"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 17) {
					$html .= ' <i class="fa-brands fa-forumbee"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 18) {
					$html .= ' <i class="fa fa-list"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 19) {
					$html .= ' <i class="fa fa-bullseye"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 20) {
					$html .= ' <i class="fa fa-search"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 21) {
					$html .= ' <i class="fa-regular fa-calendar-check"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 22) {
					$html .= ' <i class="fa-solid fa-quote-left"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 23) {
					$html .= ' <i class="fa-regular fa-compass"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 24) {
					$html .= ' <i class="fa-sharp fa-solid fa-sliders"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 25) {
					$html .= ' <i class="fa-regular fa-image"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 26) {
					$html .= ' <i class="fa-regular fa-file-audio"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 27) {
					$html .= ' <i class="fa-sharp fa-solid fa-address-book"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 28) {
					$html .= ' <i class="fa-sharp fa-solid fa-paper-plane"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 29) {
					$html .= ' <i class="fa-solid fa-file"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 30) {
					$html .= ' <i class="fa-solid fa-arrow-up-right-from-square"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 31) {
					$html .= ' <i class="fa-solid fa-scissors"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 32) {
					$html .= ' <i class="fa-solid fa-earth-americas"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 33) {
					$html .= ' <i class="fa-solid fa-signs-post"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 34) {
					$html .= ' <i class="fa-regular fa-circle-question"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 35) {
					$html .= ' <i class="fa-brands fa-wpexplorer"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 36) {
					$html .= ' <i class="fa-solid fa-headphones"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 37) {
					$html .= ' <i class="fa-solid fa-diamond-turn-right"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 38) {
					$html .= ' <i class="fa-solid fa-comment-dots"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 39) {
					$html .= ' <i class="fa-solid fa-users"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 40) {
					$html .= ' <i class="fa-solid fa-list-ol"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 41) {
					$html .= ' <i class="fa-solid fa-cart-shopping"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 42) {
					$html .= ' <i class="fa-brands fa-whatsapp"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 43) {
					$html .= ' <i class="fa-solid fa-cart-arrow-down"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 44) {
					$html .= ' <i class="fa-solid fa-map-pin"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 45) {
					$html .= ' <i class="fa-solid fa-rectangle-ad"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 46) {
					$html .= ' <i class="fa-brands fa-instagram"></i>';
				} else if (isset($value['type_of_question']) && $value['type_of_question'] == 47) {
					$html .= ' <i class="fa-brands fa-instagram"></i>';
				}

				$html .= '
								<p class="fw-semibold d-inline block mx-2 cursor-pointer sequence" data-id=' . $value['id'] . ' data-sequence=' . $value['sequence'] . '>' . $value['question'] . '</p>
							</label>
						</div>
						<div class="col-2 d-flex flex-wrap align-items-center">';
				$html .= '<div class="col-3 p-1">';
				if ($value['type_of_question'] != 31 && $value['type_of_question'] != 32 && $value['type_of_question'] != 33 && $value['type_of_question'] != 45) {
					$html .= '<i class="fa fa-pencil cursor-pointer question_edit" data-id=' . $value['id'] . ' data-type_of_question=' . $value['type_of_question'] . ' data-bs-toggle="modal" data-bs-target="#add-email"></i>';
				}
				$html .= '</div>';

				if ($value['type_of_question'] != 36) {
					$html .= '<div class="col-3 p-1">';
					$html .= '<i class="fa fa-sitemap cursor-pointer question_flow_edit" data-id=' . $value['id'] . ' data-type_of_question=' . $value['type_of_question'] . ' data-bs-toggle="modal" data-bs-target="#exampleModal"></i>';
					$html .= '	</div>';
				}

				$html .= '	<div class="col-3 p-1">
								<i class="fa fa-clone duplicate_question_add cursor-pointer" data-question=' . $value['id'] . '></i>
							</div>
							<div class="col-3 p-1">
								<i class="fa fa-trash question_delete cursor-pointer" data-question=' . $value['id'] . '></i>
							</div>
						</div>
					</div>';

				if (isset($value['type_of_question']) && $value['type_of_question'] >= 1 && $value['type_of_question'] <= 21) {
					$html .= '
					<div class="col-12 d-flex justify-content-end">
						<button type="button" class="btn-primary user_reply" data-question="' . $value['question'] . '" data-skip_question="' . $value['skip_question'] . '" data-menu_message="' . $value['menu_message'] . '">Users Reply</button>
									</div>';
				}


				$html .= '</div>';

			}
		}
		$result['html'] = $html;
		echo json_encode($result);
		die();
	}


	//bot preview
	// public function bot_preview_data()
	// {
	// 	$table = $_POST['table'];
	// 	$bot_id = $_POST['bot_id'];
	// 	$sequence = $_POST['sequence']; // Retrieve the sequence number
	// 	$db_connection = \Config\Database::connect('second');
	// 	$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND sequence = ' . $sequence; // Retrieve the question with the specified sequence
	// 	$resultss = $db_connection->query($sql);
	// 	$bot_chat_data = $resultss->getResultArray();
	// 	$html = '';

	// 	if (!empty($bot_chat_data)) {
	// 		$value = $bot_chat_data[0];
	// 		$html .= '<div class="messege1 d-flex flex-wrap conversion_id" data-conversation-id="'.$value['id'].'" data-sequence="'.$value['sequence'].'">
	// 					<div class="border  rounded-circle overflow-hidden " style="width:40px;height:40px">
	// 						<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
	// 					</div>
	// 					<div class="col px-2">
	// 						<div class="col-12 mb-2">
	// 							<span class="p-2 rounded-pill  d-inline-block   bg-white  px-3 conversion_id" data-conversation-id="'.$value['id'].'">
	// 								'.$value['question'].'
	// 							</span>
	// 						</div>
	// 					</div>
	// 				</div>
	// 				<div class="messege2 d-flex flex-wrap  ">
	// 					<div class="col px-2">
	// 						<div class="col-12 mb-2 text-end ">
	// 							<span class="p-2 rounded-pill text-white d-inline-block  bg-secondary  px-3  ">
	// 							'.$value['answer'].'
	// 							</span>
	// 						</div>
	// 					</div>
	// 					<div class="border  rounded-circle overflow-hidden " style="width:40px;height:40px">
	// 						<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
	// 					</div>
	// 				</div>';
	// 	}
	// 	$dateresult['html'] = $html;
	// 	return json_encode($dateresult, true);
	// 	die();
	// }

	public function bot_preview_data()
	{

		$table = $_POST['table'];
		$bot_id = $_POST['bot_id'];
		$sequence = $_POST['sequence'];

		if (isset($_POST['nextQuestion']) && $_POST['nextQuestion'] != "true") {
			$nextQuestion = $_POST['nextQuestion'];
			// pre($nextQuestion);
		}

		
		if (isset($_POST['next_question_id'])) {
			$next_questions = $_POST['next_questions'];
		}

		if (isset($_POST['next_question_id'])) {
			$next_question_id = $_POST['next_question_id'];
		}
	
		if ($sequence == 1 || isset($_POST['fetch_first_record'])) {
			$db_connection = \Config\Database::connect('second');
			$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' ORDER BY sequence LIMIT 1';
			$result = $db_connection->query($sql);
			$bot_chat_data = $result->getResultArray();
		} else {
			$sequence = isset($result) ? 1 : $sequence;
			$db_connection = \Config\Database::connect('second');

			if (isset($_POST['next_questions']) && $_POST['next_questions'] != "undefined" && $_POST['next_questions'] != "") {
				$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND type_of_question = ' . $_POST['next_questions'] . ' ORDER BY sequence';
				// pre($sql);
			}else {
				$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND sequence <= ' . $sequence . ' ORDER BY sequence';
			}

			if(isset($_POST['nextQuestion'])){
				$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND type_of_question = ' . $_POST['nextQuestion'] . ' ORDER BY sequence';
			}else{
				$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND sequence <= ' . $sequence . ' ORDER BY sequence';
			}	

			//  else {
			// 	$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND next_questions <= ' . $sequence . ' ORDER BY sequence';
			// }

			// Execute query
			$db_connection = \Config\Database::connect('second');
			$result = $db_connection->query($sql);
			$bot_chat_data = $result->getResultArray();
		
			// Retrieve parent-child data
			$sql_parent_child = 'SELECT parent.id AS parent_id, child.id AS child_id, child.question, parent.answer
				FROM admin_bot_setup AS child
				JOIN admin_bot_setup AS parent ON child.type_of_question = parent.next_question_id
				WHERE parent.bot_id = ' . $bot_id . '
				ORDER BY parent.sequence LIMIT 1;';
	
			$resultss_ss = $db_connection->query($sql_parent_child);
			$bot_chat_data_ss = $resultss_ss->getResultArray();
		}

		$bot_chat_data_ss = !empty($bot_chat_data_ss) ? $bot_chat_data_ss : '';
		$html = '';
		$last_que_id = 0;
		$bot_chat_data_ss_index = 0;
		
		if (!empty($bot_chat_data)) {
			// pre($bot_chat_data);
			foreach ($bot_chat_data as $value) {
				if (isset($bot_chat_data_ss[$bot_chat_data_ss_index]['parent_id']) && $last_que_id == $bot_chat_data_ss[$bot_chat_data_ss_index]['parent_id']) {
					$sql_child = 'SELECT * FROM ' . $table . ' WHERE id = ' . $bot_chat_data_ss[$bot_chat_data_ss_index]['child_id'] . ' ';
					$fss = $db_connection->query($sql_child);
					$asasasf = $fss->getResultArray();
					$test_pr_que = $asasasf[0]['question'];
					$test = $value['question'];
					$bot_chat_data_ss_index++;
				} else {
					$test_pr_que = '';
					$test = $value['question'];
				}
				// pre($test);
				$last_que_id = $value['id'];
				// continue;
				if (isset($test_pr_que) && !empty($test_pr_que)) {
					$html .= '<div class="messege1 d-flex flex-wrap conversion_id" data-next_questions="'.$value['next_questions'].'" data-next_question_id="'.$value['next_question_id'].'" data-conversation-id="' . $asasasf[0]['id'] . '" data-sequence="' . $asasasf[0]['sequence'] . '">
								<div class="me-2 border rounded-circle overflow-hidden" style="width:35px;height:35px">
									<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
								</div>';

					$html .= '<div class="col">
									<div class="col-12 mb-2">
										<span class="p-1 rounded-3 d-inline-block bg-white px-3 conversion_id" data-sequence="'.$asasasf[0]['sequence'].'" data-conversation-id="' . $asasasf[0]['id'] . '">
											' . $test_pr_que . '
										</span>';
					if ($asasasf[0]['type_of_question'] == 1 && $asasasf[0]['skip_question'] == 1) {
						$html .= '<div class="col-12 mb-2 mt-1">
														<button class="btn bg-primary rounded-3 text-white skip_questioned">
															Skip
														</button>
													</div>';
					} else {
						$html .= '<div class="col-12 mb-2 mt-1" hidden>
														<button class="btn bg-primary rounded-3 text-white skip_questioned">
															Skip
														</button>
													</div>';
					}
					$html .= '</div>				
					</div>
					';
				}

				if ($sequence == 1 || isset($_POST['fetch_first_record'])) {
					$html .= '<div class="messege1 d-flex flex-wrap conversion_id" data-next_questions="'.$value['next_questions'].'" data-next_question_id="'.$value['next_question_id'].'" data-conversation-id="' . $value['id'] . '" data-sequence="' . $value['sequence'] . '">
								<div class="me-2 border rounded-circle overflow-hidden" style="width:35px;height:35px">
									<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
								</div>';

					$html .= '<div class="col">
									<div class="col-12 mb-2">
										<span class="p-1 rounded-3 d-inline-block bg-white px-3 conversion_id" data-sequence="'.$value['sequence'].'" data-conversation-id="' . $value['id'] . '">
											' . $value['question'] . '
										</span>';
					if ($value['type_of_question'] == 1 && $value['skip_question'] == 1) {
						$html .= '<div class="col-12 mb-2 mt-1">
														<button class="btn bg-primary rounded-3 text-white skip_questioned">
															Skip
														</button>
													</div>';
					}
					else{
						$html .= '<div class="col-12 mb-2 mt-1" hidden>
														<button class="btn bg-primary rounded-3 text-white skip_questioned">
															Skip
														</button>
													</div>';
					}
					$html .= '</div>				
					</div>
					';
				} else {

					$html .= '<div class="messege1 d-flex flex-wrap conversion_id" data-next_questions="'.$value['next_questions'].'" data-next_question_id="'.$value['next_question_id'].'" data-conversation-id="' . $value['id'] . '" data-sequence="' . $value['sequence'] . '">
								<div class="me-2 border rounded-circle overflow-hidden" style="width:35px;height:35px">
									<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
								</div>';


					if ($value['type_of_question'] == "16") {
						$buttonData = json_decode($value['menu_message'], true);

						if (isset($buttonData['button_text']) && isset($buttonData['button_url'])) {
							$buttonText = $buttonData['button_text'];
							$buttonUrl = $buttonData['button_url'];

							$html .= '<div class="col ">
													<div class="col-12 mb-2">
														<span class="p-2 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
															' . $value['question'] . '
															<div class="col-12 text-center my-1">
																<a href="' . $buttonUrl . '" type="button" class="btn-primary" data-id="59" data-type_of_question="1">' . $buttonText . '</a>
															</div>
														</span>
													</div>';
						}
						
					} else if ($value['type_of_question'] == "17") {
						// pre($value['type_of_question']);
						$formData = json_decode($value['menu_message'], true);
						
						$html .= '<div class="col">
									<div class="col-12 mb-2">
										<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
											' . $value['question'] . '
										</span>
									</div>
									<div class="col-10 px-2 form_fill">
										<form action="" class="col-12 text-center shadow-lg border bg-white p-2 rounded-3">';

						if (isset($formData['questions'])) {
							// pre($formData['questions']);
							foreach ($formData['questions'] as $question) {
								if ($question['type'] == 'Question') {
									$html .= '<div class="col-10 my-2 mx-auto">
												<textarea class="form-control main-control text_value" cols="3" rows="3" placeholder="' . $question['text'] . '"></textarea>
											  </div>';
								} elseif ($question['type'] == 'Dropdown') {
									$html .= '<div class="col-10 my-2 mx-auto">
												<select class="form-select form-select-sm mt-2 address_value" aria-label="Small select example">';
									if (!empty($question['options'])) {
										$options = explode(',', $question['options']);
										foreach ($options as $option) {
											$html .= '<option value="' . $option . '">' . $option . '</option>';
										}
									}
									$html .= '</select></div>';
								}
							}
						}
					
						$html .= '<button class="btn bg-primary rounded-3 text-white skip_questioned hide_skip_btn my-2" onclick="formvalue()">Submit</button>
								</form>
							</div>';

					} else if ($value['type_of_question'] == "18") {
						$formData = json_decode($value['menu_message'], true);
						$imageSrc = isset($formData[0]['fileInput']) ? base_url('') . '/assets/bot_image/' . $formData[0]['fileInput'] : 'https://custpostimages.s3.ap-south-1.amazonaws.com/18280/1708079256055.png';
						$questionText = isset($formData[0]['questionText']) ? $formData[0]['questionText'] : '';
						$html .= '<div class="col">
									<div class="col-12 mb-2">
										<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
											' . $value['question'] . '
										</span>
									</div>
									<div class="col-12 text-center">
										<div class="position-relative bg-white border rounded-3 overflow-hidden" style="width:200px;height:200px">
											<img src="' . $imageSrc . '" alt="" class="w-100 h-100 opacity-50">
											<div class="position-absolute bottom-0 start-50 translate-middle mb-2 col-12 px-3">
												<button class="btn-primary col-12" onclick="choose_item(this, \'' . $questionText . '\')">' . $questionText . '</button>
											</div>
										</div>
									</div>
								</div>';

							}  else if ($value['type_of_question'] == "8") {
								$datepickerData = json_decode($value['menu_message'], true);
								// pre($value['type_of_question'] == "8");
								
								$html .= '<div class="col">
											<div class="col-12 mb-2">
												<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
													' . $value['question'] . '
												</span>
											</div>';
		
											if (
												isset($datepickerData['date_range']) &&
												isset($datepickerData['period']) &&
												isset($datepickerData['weekdays']) &&
												isset($datepickerData['date_output_format'])
											) {
												$dateRange = $datepickerData['date_range'];
												$period = $datepickerData['period'];
												$weekdays = json_encode($datepickerData['weekdays']);
												list($start_date_str, $end_date_str) = $dateRange;
											
												// Check if period is empty
												if (empty($period)) {
													// Set future_days and past_days to 0
													$future_days = 0;
													$past_days = 0;
												} else {
													$future_days = $period[0];
													$past_days = $period[1];
												}
												
												
												$start_date = \DateTime::createFromFormat('Y-m-d', $start_date_str);
												$end_date = \DateTime::createFromFormat('Y-m-d', $end_date_str);
												// pre($start_date);
												if ($start_date === false || $end_date === false) {
													echo "Error: Unable to parse date strings.";
												} else {
													$start_date->modify("-$future_days days");
													$end_date->modify("+$past_days days");
											
													$start_date_iso = $start_date->format('Y-m-d');
													$end_date_iso = $end_date->format('Y-m-d');
											
													$interval = $start_date->diff($end_date);
													$num_days = $interval->days;
		
								$html .= ' <div class="container">
											<div class="row d-flex justify-content" style="position: relative; box-shadow:rgba(70, 93, 239, 0.34) 0px 3px 15px; width:400px" >
											<div class="col-12 d-flex overflow-hidden" id="calender-month" style="padding:0px !important">
												<div class="col-12 month-content active" id="january-content">
												<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">January <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												<ul class="days" id="january"></ul>
												</div>
												<div class="col-12 month-content" id="february-content">
												<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">February<div class="month-cal" id="year-date"> &nbsp;2024	</div></h4>
												<ul class="days" id="february"></ul>
												</div>
																		
												<div class="col-12 month-content" id="march-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">March <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="march"></ul>
												</div>
										   
												<div class="col-12 month-content" id="april-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">April<div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="april"></ul>
												</div>
										   
												<div class="col-12 month-content" id="may-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">May <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="may"></ul>
												</div>
										   
												<div class="col-12 month-content" id="june-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">June <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="june"></ul>
												</div>
										   
												<div class="col-12 month-content" id="july-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">July <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="july"></ul>
												</div>
										   
												<div class="col-12 month-content" id="august-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">August <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="august"></ul>
												</div>
										   
												<div class="col-12 month-content" id="september-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">September<div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="september"></ul>
												</div>
										   
												<div class="col-12 month-content" id="october-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">October <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="october"></ul>
												</div>
										   
												<div class="col-12 month-content" id="november-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">November<div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="november"></ul>
												</div>
										   
												<div class="col-12 month-content" id="december-content">
												 <h4 class="d-flex justify-content-center" style="margin-bottom:10px;">December <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
												 <ul class="days" id="december"></ul>
												</div>
												</div>
												
												<div class="col-12" style="margin-top:30px;">
													<ul id="yearSelect" style="display:none;">
													</ul>
												</div>
												
											
												<button class="btn btn-primary d-flex justify-content-center align-items-center prev-btn" style="position:absolute; top:0px; left0px; width:33px; height:33px;"><</button>
												<button class="btn btn-primary d-flex justify-content-center align-items-center next-btn" style="position:absolute; top:0px; right:0px; width:33px; height:33px;">></button>
												</div>
												</div>';
		
												
												
				
										   $html .= '<script>
										   $(document).ready(function() {
		
											function daysInMonth(month, year) {
												return new Date(year, month + 1, 0).getDate();
											}
										
											var weekdays = '.$weekdays.';
									
											function generateDays(monthId, month, year) {
												const daysCount = daysInMonth(month, year);
												const firstDay = new Date(year, month, 1).getDay();
												const ul = $("#" + monthId);
												ul.empty();
									
												const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
												daysOfWeek.forEach(function(day) {
													ul.append("<li>" + day + "</li>");
												});
									
												for (let i = 0; i < firstDay; i++) {
													ul.append("<li></li>");
												}
									
												const startDate = new Date("'. $start_date_iso .'");
												const endDate = new Date("'. $end_date_iso .'");
									
												for (let i = 1; i <= daysCount; i++) {
													const currentDate = new Date(year, month, i);
													const currentDay = currentDate.toLocaleDateString("en-US", { weekday: "short" }).toUpperCase();
									
													// Check if period is empty
													if (' . (empty($period) ? "true" : "false") . ') {
														// Only consider dates within the range of start_date and end_date
														if (currentDate >= startDate && currentDate <= endDate) {
															ul.append("<li class=\"day-time\">" + i + "</li>");
														} else {
															ul.append("<li class=\"disabled\">" + i + "</li>");
														}
													} else {
														// Consider weekdays and the range of start_date and end_date
														if (weekdays.includes(currentDay)) {
															if (currentDate >= startDate && currentDate <= endDate) {
																ul.append("<li class=\"day-time\">" + i + "</li>");
															} else {
																ul.append("<li class=\"disabled\">" + i + "</li>");
															}
														} else {
															ul.append("<li class=\"disabled\">" + i + "</li>");
														}
													}

												}
											}
											
											function generateCalendar(year) {
												for (let i = 0; i < 12; i++) {
													generateDays(getMonthId(i), i, year);
												}
											}
										
											function getMonthId(monthIndex) {
												const months = ["january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"];
												return months[monthIndex];
											}
										
											function populateYearSelect() {
												const startYear = 2001;
												const endYear = 2090;
												const select = $("#yearSelect");
											
												for (let year = startYear; year <= endYear; year++) {
													select.append("<li>" + year + "</li>");
												}
											}
										
											populateYearSelect();
											generateCalendar(new Date().getFullYear());
										
											$(".month-content").not("#january-content").hide();
										
											$(".month-cal").click(function() {
												$(".month-content").addClass("d-none");
												$("#yearSelect").show();
											});
										
											$(".prev-btn").click(function() {
												const currentMonth = $(".month-content:visible");
												currentMonth.hide();
												const prevMonth = currentMonth.prev().length ? currentMonth.prev() : $(".month-content").last();
												prevMonth.show();
											});
										
											$(".next-btn").click(function() {
												const currentMonth = $(".month-content:visible");
												currentMonth.hide();
												const nextMonth = currentMonth.next().length ? currentMonth.next() : $(".month-content").first();
												nextMonth.show();
											});
										
											$(document).on("click", "#yearSelect li", function() {
												const selectedYear = $(this).text();
												generateCalendar(selectedYear);
												$("#yearSelect").hide();
												$(".month-cal").text(selectedYear);
												$(".month-content").removeClass("d-none");
											});
										
											$(document).on("click", ".days li", function() {
												$(this).addClass("color");
												$(this).siblings("li").removeClass("color");
											});
											
											$(document).on("click", ".day-time", function () {
												var day = $(this).text();
												var month = $(this).closest(".month-content").attr("id").split("-")[0];
												var year = $("#year-date").text();
		
												$(".answer_chat").val(day + " " + month + year);
											});
										
											$(document).on("click", "#yearSelect li", function() {
												const selectedYear = $(this).text();
												generateCalendar(selectedYear);
												$("#yearSelect").hide();
												$(".month").text($(".month").text().replace(/\d{4}/, ""));
												$(".month-content").removeClass("d-none");
											});
										});
		
		
										   
										</script>';
									}
								}
							} else if($value['type_of_question'] == "23"){

						$html .= '<div class="col">
										
										<div class="shadow-lg rounded-4 border p-4 bg-white d-flex justify-content-center">
											<div class="col-10">
												<div>
													<span>' . $value['question'] . '</span>
												</div>';
							
												$urlnavigatroData = json_decode($value['menu_message'], true);

												if (isset($urlnavigatroData[0]['url_navigator_select'])) {									
												
													$html .= '<div class="d-flex flex-wrap mt-2">';
													foreach ($urlnavigatroData as $data) {
														$imageName = $data['url_navigator_select'];
														if($imageName == "Facebook"){
															$imageSrc = "https://www.page.smatbot.com/assets/facebook-b1c48260.svg";
														}else if($imageName == "Instagram"){
															$imageSrc = "https://www.page.smatbot.com/assets/instagram-b79de51b.svg";
														}else if($imageName == "Twitter"){
															$imageSrc = "https://www.page.smatbot.com/assets/twiter-5c5e8b47.svg";
														}else if($imageName == "Linkedin"){
														
														}else if($imageName == "Youtube"){
														
														}else if($imageName == "Messenger"){
															$imageSrc = "https://www.page.smatbot.com/assets/messanger-a053b50d.svg";
														}else if($imageName == "Google_Plus"){
															$imageSrc = "https://www.page.smatbot.com/assets/twiter-5c5e8b47.svg";
														}else if($imageName == "Call"){
															$imageSrc = "https://www.page.smatbot.com/assets/call-cb6467cb.svg";
														}else if($imageName == "Whatsapp"){
															
														}else if($imageName == "URL"){
															$imageSrc = "https://www.page.smatbot.com/assets/link-4ffb5844.svg";
														}else if($imageName == "Refresh_chat"){
															$imageSrc = "https://www.page.smatbot.com/assets/reload-ec94a148.svg";
														}else if($imageName == "close_Chat"){
															$imageSrc = "https://www.page.smatbot.com/assets/delete-0612a90c.svg";
														}
														
														$html .= '<div class="me-2 text-center">
																	<a href="' . $data['url_link'] . '" class="d-block">
																		<img src="' . $imageSrc . '" alt="#" style="width:30px;height:30px" class="rounded-circle">
																		<p class="text-dark">' . $data['url_text'] . '</p>
																	</a>
																</div>';
													}
												
													$html .= '</div></div></div>';
												}												

							$html .= '<div class="shadow-lg"></div>';
							
						// }
					} else if($value['type_of_question'] == "24"){
						$formData = json_decode($value['menu_message'], true);
						$html .= '<div class="col">
									<div class="col-12 mb-2">
										<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
											' . $value['question'] . '
										</span>
									</div>';
						
						$product_image = isset($formData[0]['product_image']) ? base_url('') . '/assets/bot_image/' . $formData[0]['product_image'] : 'https://custpostimages.s3.ap-south-1.amazonaws.com/18280/1708079256055.png';
						$product_title = isset($formData[0]['product_title']) ? $formData[0]['product_title'] : '';
						$product_button_text = isset($formData[0]['product_button_text']) ? $formData[0]['product_button_text'] : '';
						$product_description = isset($formData[0]['product_description']) ? $formData[0]['product_description'] : '';
						$product_button_url = isset($formData[0]['product_button_url']) ? $formData[0]['product_button_url'] : '';
						$product_url = isset($formData[0]['product_url']) ? $formData[0]['product_url'] : '';

						if(isset($formData[0]['product_image']) || isset($formData[0]['product_button_text'])){
							$html .= '
										<div class="col-12 text-center">
											<div class="position-relative bg-white border rounded-3 overflow-hidden" style="width:200px;height:200px">
												<img src="' . $product_image . '" alt="" class="w-100 h-100 opacity-50">
												<div class="position-absolute bottom-0 start-50 translate-middle  col-12 px-3">
													<a href="'.$product_url.'" class="d-block text-start ms-4 text-dark">' . $product_title . '</a>
													<a href="'.$product_url.'" class="d-block mb-2 text-start ms-4 text-dark">' . $product_description . '</a>
													<a href="'.$product_button_url.'" class="btn-primary col-12">' . $product_button_text . '</a>
												</div>
											</div>
										</div>
									</div>';
						}
					}else if($value['type_of_question'] == "25"){
						$html .= '<div class="col">
									<div class="col-12 mb-2">
										<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
											' . $value['question'] . '
										</span>
									</div>';

						$carouselData = json_decode($value['menu_message'], true);
						$carousel_image = isset($carouselData[0]['carousel_image']) ? base_url('') . '/assets/bot_image/' . $carouselData[0]['carousel_image'] : 'https://custpostimages.s3.ap-south-1.amazonaws.com/18280/1708079256055.png';
						if(isset($carouselData[0]['carousel_image'])){
							$html .= '<div class="col-12 text-center">
											<div class="position-relative bg-white border rounded-3 overflow-hidden" style="width:200px;height:200px">
												<img src="' . $carousel_image . '" alt="" class="w-100 h-100 opacity-50 skip_questioned">
											</div>
										</div>
									</div>';
						}	
					}else if ($value['type_of_question'] == "27") {
						$contactsData = json_decode($value['menu_message'], true);
						$html .= '<div class="bg-white p-2 position-absolute tabel_div top-0 bottom-0 start-0 end-0 m-auto rounded-2 overflow-x-scroll d-none" style="width: max-content; height: 200px;">
									<div class="d-flex justify-content-end close_btn">
										<i class="bi bi-x fs-3 m-0 p-0" style="cursor: pointer;"></i>
									</div>
									<table class="w-100">
										<tr class="border p-2 rounded-2">
											<th class="border p-2">Name</th>
											<th class="border p-2">Contact(s)</th>
										</tr>';
					
						foreach ($contactsData as $contact) {
							$html .= '<tr class="border p-2 rounded-2">
										<td class="border p-2">' . $contact['contact_name'] . '</td>
										<td class="border p-2">' . $contact['contact_number'] . '</td>
									</tr>';
						}
							
						$html .= '</table>
								</div> 
								<div class="col ">
									<div class="col-12 mb-2">
										<span class="p-2 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
											' . $value['question'] . '
											<div class="col-12 text-center my-1">
											<button type="button" class="btn btn-primary enter_show" >
												Show Contacts
											</button>
											</div>
										</span>
									</div>';

					}else if ($value['type_of_question'] == "29") {
						$html .= '<div class="col">
										<div class="col-12 mb-2">
											<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
												' . $value['question'] . '
											</span>
										';
							$fileData = json_decode($value['menu_message'], true);
							if(isset($fileData['file_upload'])){
								$html .= '<a href="'.$fileData['file_upload'].'">' . $fileData['file_upload'] . '</a>
								</div>';
							}
					}
					else if($value['type_of_question'] == "30"){
						$url_redirect_Data = json_decode($value['menu_message'], true);
						$url_reditrect = isset($url_redirect_Data['redirect_url']) ? $url_redirect_Data['redirect_url'] : '';
					
						$html .= '<div class="col">
												<div class="col-12 mb-2">
													<a href="'.$url_reditrect.'" class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id text-dark" data-conversation-id="' . $value['id'] . '">
														' . $value['question'] . '
													</a>
												</div>';
					}else if($value['type_of_question'] == "40" || $value['type_of_question'] == "42"){
						$html .= '<div class="col">
										<div class="col-12 mb-2">
											<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
												' . $value['question'] . '
											</span>
										';

							$menu_list_Data = json_decode($value['menu_message'], true);
							// pre($menu_list_Data);
							
							if(isset($menu_list_Data['options'])){
								$optionsArray = explode(';', $menu_list_Data['options']);
								foreach ($optionsArray as $option) {
									$html .= '
									<div class="col-12">
										<button class="btn bg-primary rounded-3 text-white col-6 my-1" onclick="selectOption(this, \'' . $option . '\')">
										'.$option.'
										</button>
									</div>';
								}
							}
	
					}
					else {
						$html .= '<div class="col">
												<div class="col-12 mb-2">
													<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
														' . $value['question'] . '
													</span>
												</div>';
					}

					if (($value['type_of_question'] == 6 && $value['skip_question'] == 1) || ($value['type_of_question'] == 10 && $value['skip_question'] == 1) || ($value['type_of_question'] == 11 && $value['skip_question'] == 1) || ($value['type_of_question'] == 12 && $value['skip_question'] == 1) || ($value['type_of_question'] == 13 && $value['skip_question'] == 1) || ($value['type_of_question'] == 14 && $value['skip_question'] == 1)) {
						$html .= '<div class="col-12 mb-2">
													<button class="btn bg-primary rounded-3 text-white skip_questioned hide_skip_btn">
														Skip
													</button>
												</div>';
					}


					$menuOptions = json_decode($value['menu_message'], true);
					if (isset($menuOptions['rating_type']) && $menuOptions['rating_type'] === "smilies") {
						// Output the HTML snippet for smilies
						$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
										<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
											<div class="text-center pt-4">Please rate</div>
												<div class="d-flex text-center justify-content-center mt-2 pb-3 px-2">
										
													<div class="col-2 mb-2 option-wrapper">
														<button class="bg-transparent fs-14" onclick="rating(this, \'Great\')" style="border:none !important; font-size:25px !important">😍</button>
													</div>
													<div class="col-2 mb-2 option-wrapper">
														<button class="bg-transparent fs-14" onclick="rating(this, \'Good\')" style="border:none !important; font-size:25px !important">😃</button>
													</div>
													<div class="col-2 mb-2 option-wrapper">
														<button class="bg-transparent fs-14" onclick="rating(this, \'Okay\')" style="border:none !important; font-size:25px !important">😊</button>
													</div>
													<div class="col-2 mb-2 option-wrapper">
														<button class="bg-transparent fs-14" onclick="rating(this, \'Sad\')" style="border:none !important; font-size:25px !important">😞</button>
													</div>
													<div class="col-2 mb-2 option-wrapper">
														<button class="bg-transparent fs-14" onclick="rating(this, \'Bad\')" style="border:none !important; font-size:25px !important">😪</button>
													</div>
												</div>
											</div>
										</div>
									</div>';
					} else if (isset($menuOptions['rating_type']) == "stars") {
						$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
											<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
												<div class="text-center pt-4">Please rate</div>
													<div class="d-flex text-center justify-content-center mt-2 pb-3 px-2">
														<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Great\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star "></i></button>
														<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Good\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star "></i></button>
														<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Okay\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star "></i></button>
														<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Sad\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star"></i></button>
														<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Bad\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star"></i></button>
													</div>
												
												</div>';
					} else if (isset($menuOptions['rating_type']) == "numbers") {
						$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
										<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
											<div class="text-center pt-4">Please rate</div>
												<div class="d-flex text-center justify-content-center mt-2 pb-3 px-2">
													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'1\')" style="border:none !important; font-size:25px !important">1</button>
													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'2\')" style="border:none !important; font-size:25px !important">2</button>
													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'3\')" style="border:none !important; font-size:25px !important">3</button>
													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'4\')" style="border:none !important; font-size:25px !important">4</button>
													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'5\')" style="border:none !important; font-size:25px !important">5</button>
												</div>  
											</div>';
					} else if (isset($menuOptions['rating_type']) == "options") {
						$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
										<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
											<div class="text-center pt-4">Please rate</div>
											<div class=" mt-2 pb-3 px-2">
												<div class="px-2 "><i class="fa-regular fa-circle"></i> Terrible (1 Star)</div>
												<div class="px-2 "><i class="fa-regular fa-circle"></i> Bad (1 Star)</div>
												<div class="px-2 "><i class="fa-regular fa-circle"></i> Okay (1 Star)</div>
												<div class="px-2 "><i class="fa-regular fa-circle"></i> Good (1 Star)</div>
												<div class="px-2"><i class="fa-regular fa-circle"></i> Great (1 Star)</div>
											</div>  
										</div>';
					} else {
					}

					if (!empty($value['menu_message']) && $value['type_of_question'] == 2) {
						$menuOptions = json_decode($value['menu_message'], true);
						
						if (isset($menuOptions['options'])) {
							$options = explode(';', $menuOptions['options']);
							$nextQuestionsArray = explode(',', $value['next_questions']);
		
							foreach ($options as $index => $option) {
								$nextQuestion = isset($nextQuestionsArray[$index]) ? $nextQuestionsArray[$index] : '';
					
								$html .= '<div class="col-12 mb-2 option-wrapper">
											  <button class="btn bg-primary rounded-3 text-white option-button" data-next_questions="'.$nextQuestion.'" onclick="selectOption(this, \'' . $option . '\')">' . $option . '</button>
										  </div>';
							}
						}
					}
					

					if (!empty($value['menu_message']) && $value['type_of_question'] == 4) {
						$menuOptions = json_decode($value['menu_message'], true);

						if (isset($menuOptions['options'])) {
							$options = explode(';', $menuOptions['options']);
							$html .= '<div class="col-12 mb-2 option-wrapper">';
							foreach ($options as $option) {
								$html .= '<div class="col-12 d-flex flex-wrap align-items-end chat_again_continue my-1">
														  <div class="d-inline-block px-3 py-2 col-6 btn-secondary rounded-3 mx-2">
															  <div class="col-12">
																  <input type="checkbox" class="me-2 main-form option-check rounded-circle" value="' . $option . '">' . $option . '
															  </div>
														  </div>
													  </div>';
							}
							$html .= '<div class="col-6 text-center mt-2 mx-2">
													  <button class="text-white btn bg-primary col-12" onclick="submitOptions()">Submit</button>
												  </div>
											  </div>';
						}
					}

					$html .= '</div>';
					$html .= '<script>
								
								function selectOption(button, value) {
									$(".answer_chat").val(value); 
									var nextQuestion = $(button).data("next_questions");
									console.log("Next Question:", nextQuestion); 
									bot_preview_data(sequence, nextQuestion); 
									insertAnswer(nextQuestion);
								}

								function submitOptions() {
									var selectedOptions = [];
									$(".option-check:checked").each(function() {
										selectedOptions.push($(this).val());
									});
									var selectedOptionsString = selectedOptions.join(" , "); 
									$(".answer_chat").val(selectedOptionsString);
									insertAnswer();
								}
								function rating(button, value) {
									$(".answer_chat").val(value);
									insertAnswer();
								}
								function formvalue() {
									var textareaValue = $(".text_value").val();
									var selectedOption = $(".address_value").val();
									$(".answer_chat").val(textareaValue);
									insertAnswer();
									$(".answer_chat").val(selectedOption);
									insertAnswer();
								}
								function choose_item(button, value){
									$(".answer_chat").val(value); 
									insertAnswer();
								}
							</script>';

					$html .= '</div>
								<div class="messege2 d-flex flex-wrap mt-2">
									<div class="col ">';

								
					if ($value['answer'] != '') {
						$html .= '<div class="col-12 mb-2 text-end">
													<span class="p-2 rounded-3 text-white d-inline-block bg-secondary px-3">
													' . $value['answer'] . '
													</span>
												</div>
											</div>
											<div class="border  rounded-circle overflow-hidden ms-2" style="width:35px;height:35px">
												<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
											</div>
										</div>';
					}
				}
			}
		}

		$dateresult['html'] = $html;
		return json_encode($dateresult, true);
		die();
	}



	public function delete_record()
	{

		$table_username = getMasterUsername2();
		$db_connection = \Config\Database::connect('second');
		$table = '' . $table_username . '_bot_setup';
		$column = 'answer';
		$sql = "UPDATE $table SET $column = '' ";

		$query = $db_connection->query($sql);

		if ($query) {
			$response = array('success' => true);
		} else {
			$response = array('success' => false, 'error' => 'Failed to delete the records.');
		}
		echo json_encode($response);
	}

	public function insert_chat_answer()
	{
		$table = $_POST['table'];
		$bot_id = $_POST['bot_id'];
		$answer = $_POST['answer'];
		$questionId = $_POST['question_id'];
		$sequence = $_POST['sequence'];

		$db_connection = \Config\Database::connect('second');
		$sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND sequence = ' . $sequence;
		$result = $db_connection->query($sql);
		$question = $result->getRowArray();

		$response = []; 

		if (!empty($question)) {
			if ($question['type_of_question'] == 3 && $question['error_text']) {
				// Validate email if the question type is 3
				$regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
				if (preg_match($regex, $answer)) {
					$response['id_validation'] = ""; 
					$response['response'] = 1;
				} else {
					$response['id_validation'] = $question['error_text']; 
					$response['response'] = 2;
				}
			} else if($question['type_of_question'] == 5 && $question['error_text']){
				$regex = '/^([a-zA-Z0-9_ ]{5,10})$/';

				if (preg_match($regex, $answer)) {
					$response['id_validation'] = ""; 
					$response['response'] = 1;
				} else {
					$response['id_validation'] = $question['error_text']; 
					$response['response'] = 2;
				}
			}else {
				// Handle other types of questions
				if (!empty($question) && $question['id'] == $questionId) {
					$updateData = [
						'answer' => $answer,
					];
					$response['response'] = 3;

					$db_connection->table($table)->update($updateData, ['id' => $question['id']]);
					$response['message'] = "Answer inserted successfully for question: " . $question['question'];
				} else {
					// $response['error'] = "Question with sequence " . $sequence . " not found or does not match the specified question id.";

					$updateData = [
						'answer' => $answer,
					];
					$response['response'] = 3;

					$db_connection->table($table)->update($updateData, ['id' => $question['id']]);
					$response['message'] = "Answer inserted successfully for question: " . $question['question'];
				}
			}
		}else{
			$response['error'] = "No question data found.";
		}
		echo json_encode($response);
		exit;
	}


	public function main_bot_list_data()
	{
		// bot main page list data
		$table_name = $_POST['table'];
		$botdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
		$botdisplaydata = json_decode($botdisplaydata, true);
		$i = 1;
		$html = "";

		foreach ($botdisplaydata as $key => $value) {
			$bot_img = empty($value['bot_img']) ? base_url('') . 'assets/bot_image/account.png' : /* bot img uploading path */ base_url('') . 'assets/bot_image/bot_img/bot-1.png';
			$html .= '
			<div class="col-3 p-2">
			<div class="card mb-3 bg-white shadow">
				<div class="row g-0 p-2">
					<div class="d-flex align-items-center">
						<div class="col-md-4 text-center">
							<div class="p-2">
								<img src="' . $bot_img . '"
											class="img-fluid rounded-start mb-1" width="30px">
										<p class="card-text"><small class="text-body-secondary">' . $value['name'] . '</small></p>
									</div>
								</div>
								<div class="border h-100"></div>
								<div class="col-md-8">
									<div class="card-body d-flex flex-wrap py-1 px-2 justify-content-between">
										<div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted bot_setup"
											data-toggle="tooltip" data-placement="top" title="Setup">
											<a href="' . base_url('') . 'bot_setup?bot_id=' . $value['id'] . '" class="text-muted">
												<i class="fa-solid fa-screwdriver-wrench"></i>
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

										<div class="border rounded d-inline w-auto p-1 px-2 icon-box2 text-muted bot_delete"
                                            data-toggle="tooltip" data-placement="top" title="Delete" data-delete_id="' . $value['id'] . '">
                                            <i class="fa-solid fa-trash"></i>
										</div>

									</div>
									<div
										class="card-body d-flex flex-wrap py-1 px-2 justify-content-between align-items-center">
										<div class="form-check form-switch">
											<input class="form-check-input bot_active dfg toggle-switch" type="checkbox" role="switch" id="is_active"
												' . ($value['active'] == 1 ? 'checked' : '') . ' data-update_id="' . $value['id'] . '">
											<label class="form-check-label toggle-label" id="toggleStatus" for="is_active">Inactive</label>
										</div>

										<script>
										$(document).ready(function() {
											$(".toggle-switch").each(function() {
												const $checkbox = $(this);
												const $label = $checkbox.siblings(".toggle-label");
												
												$label.html($checkbox.prop("checked") ? "Active" : "Inactive");
										
												$checkbox.click(function() {
													$label.html($(this).prop("checked") ? "Active" : "Inactive");
												});
											});
										});

										</script>
										
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

	public function bot_update()
	{
		// bot active / inactive code
		if ($this->request->getPost("action") == "update") {
			$update_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			unset($_POST['id']);
			unset($_POST['table']);
			unset($_POST['action']);
			// bot check data
			if ($_POST['type'] == 'activation') {
				$second_table = $this->request->getPost('second_table');
				unset($_POST['type']);
				unset($_POST['second_table']);
				$botdisplaydata = $this->MasterInformationModel->display_all_records2($second_table);
				$botdisplaydata = json_decode($botdisplaydata);
				$i = 0;
				foreach ($botdisplaydata as $key => $val) {
					if ($val->bot_id == $update_id) {
						$i++;
					}
				}

				// if $i < 0 then user is not setup the bot data and it's not active
				if ($i <= 0 && $_POST['active'] == 1) {
					return 'empty';
				}
			}
			$update_data = $_POST;
			$delete_displaydata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);

			echo "success";
		}
	}

	public function get_chat_data()
	{
		if ($_POST['action'] == 'account_list') {
			$token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
			$fileds = 'instagram_business_account{id,username,profile_picture_url},profile_picture_url,access_token,name,id';
			$url = 'https://graph.facebook.com/v19.0/me/accounts?access_token=' . $token . '&fields=' . $fileds;
			// $fb_page_list = fb_page_list($token);
			// $fb_page_list = get_object_vars(json_decode($fb_page_list));
			$fb_page_list = getSocialData($url);
			// pre($fb_page_list);

			$fb_chat_list_html = '';
			$IG_chat_list_html = '';
			$return_result = array();
			$IG_data = array();

			foreach ($fb_page_list['data'] as $key => $value) {
				// pre($value);
				$page_data = fb_page_img($value['id'], $value['access_token']);
				$page_data = json_decode($page_data);

				$fb_chat_list_html .= '<div class="col-12 account-nav my-2 account-box" data-page_id="' . $value['id'] . '" data-platform="messenger" data-page_access_token="' . $value['access_token'] . '" data-page_name="' . $value['name'] . '">
										<div class="col-12 d-flex flex-wrap justify-content-between align-items-center p-2 ms-4">
											<a href="" class="col-4 account_icon border border-1 rounded-circle me-2 align-self-center text-center">
												<img src="' . $page_data->page_img . '" alt="" width="45">
											</a>
											<p class="fs-6 fw-medium col ps-2">' . $value['name'] . '
											</p>
										</div>
									</div>';
				if (isset($value['instagram_business_account'])) {
					$value['instagram_business_account']['access_token'] = $value['access_token'];
					$value['instagram_business_account']['fb_page_id'] = $value['id'];
					$IG_data[] = $value['instagram_business_account'];
				}
			}

			foreach ($IG_data as $IG_key => $IG_value) {
				$IG_chat_list_html .= '
								<div class="col-12 account-nav my-2 account-box" data-page_id="' . $IG_value['fb_page_id'] . '" data-platform="instagram" data-page_access_token="' . $IG_value['access_token'] . '" data-page_name="' . $IG_value['username'] . '">
									<div class="col-12 d-flex flex-wrap justify-content-between align-items-center  p-2 ms-4">
										<a href="" class="col-4 account_icon border border-1 rounded-circle me-2 align-self-center text-center">
											<img src="' . $IG_value['profile_picture_url'] . '" alt="" width="45">
										</a>
										<p class="fs-6 fw-medium col ps-2">' . $IG_value['username'] . '
										</p>
									</div>
								</div>
									';
			}

			// pre($IG_data);
			$return_result['chat_list_html'] = $fb_chat_list_html;
			$return_result['IG_chat_list_html'] = $IG_chat_list_html;
			return json_encode($return_result);
		}

		if ($_POST['action'] == 'chat_list') {

			$page_access_token = $_POST['page_access_token'];
			$page_id = $_POST['page_id'];
			$platform = $_POST['platform'];

			// if ($_POST['api'] === true) {
			$url = 'https://graph.facebook.com/' . $page_id . '/conversations?platform=' . $platform . '&fields=id,participants,messages.limit(1).fields(id,message,created_time,from)&pretty=0&access_token=' . $page_access_token;
			// echo $url;
			$data = getSocialData($url);
			// pre($data);
			$chat_list_html = '';
			$chat_count = count($data['data']);
			if ($chat_count > 0) {

				foreach ($data['data'] as $conversion_value) {
					$times = getTimeDifference($conversion_value['messages']['data'][0]['created_time']);
					// pre($conversion_value);
					if ($times['days'] >= 30) {
						$time_count_text = (int) ($times['days'] / 30) . ' MO';
					} else if ($times['days'] >= 7) {
						$time_count_text = (int) ($times['days'] / 7) . ' W';
					} else if ($times['days'] >= 1) {
						$time_count_text = $times['days'] . ' D';
					} else if ($times['hours'] > 0) {
						$time_count_text = $times['hours'] . ' H';
					} else {
						$time_count_text = $times['minutes'] . ' M';
					}
					if ($platform == 'messenger') {
						$name = 'name';
						$key = 0;
					} else if ($platform == 'instagram') {
						$name = 'username';
						$key = 1;
					}
					$chat_list_html .= '
							<div class=" fw-semibold fs-12 chat-nav-search-bar my-2 col-12 chat-account-box p-1 pe-3
							 chat_list" data-conversion_id="' . $conversion_value['id'] . '" data-page_token="' . $page_access_token . '" data-page_id="' . $page_id . '" data-user_name="' . $conversion_value['participants']['data'][$key][$name] . '" data-platform="' . $platform . '">
							<div class="d-flex flex justify-content-between align-items-center col-12">
										<div class="col-2 p-1">';
					if ($platform == 'messenger') {
						$chat_list_html .= '<svg class="w-100" xmlns="http://www.w3.org/2000/svg" version="1.1"
											xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0"
											viewBox="0 0 176 176" style="enable-background:new 0 0 512 512"
											xml:space="preserve" class="">
											<g>
												<g data-name="Layer 2">
													<g data-name="01.facebook">
														<circle cx="88" cy="88" r="88" fill="#3a559f" opacity="1"
															data-original="#3a559f"></circle>
														<path fill="#ffffff"
															d="m115.88 77.58-1.77 15.33a2.87 2.87 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.9a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.78v12.81h17.87a2.88 2.88 0 0 1 2.82 3.25z"
															opacity="1" data-original="#ffffff"></path>
													</g>
												</g>
											</g>
										</svg>';
					} else if ($platform == 'instagram') {
						$chat_list_html .= '<img src="' . base_url() . 'assets/bot_image/instagram.svg' . '" style="width:40px;height:40px">';
					}
					$chat_list_html .= '</div>
									<div class="col-10 d-flex flex-wrap justify-content-between align-items-center">
									<p class="col-12 ps-2" style="font-size:16px;">' . $conversion_value['participants']['data'][$key][$name] . '</p>
										<p class="col-10 ps-2 d-flex fs-12 text-secondary-emphasis"><span class="text-truncate">' . $conversion_value['messages']['data'][0]['message'] . '</span> <span class="col-3 ms-2">' . $time_count_text . '</span> </p>
									</div>
									
							</div>
						</div>
						';
				}
			} else {
				$chat_list_html .= '<div class="text-center col-12 overflow-y-scroll p-3">No Chats Found!</div>';
			}

			$return_result['chat_list_html'] = $chat_list_html;
			return json_encode($return_result);
		}

		if ($_POST['action'] == 'chat_massage_list') {
			$conversion_id = $_POST['conversion_id'];
			$page_access_token = $_POST['page_access_token'];
			// $massage_id = $_POST['id'];

			$url = "https://graph.facebook.com/$conversion_id/messages?access_token=$page_access_token&fields=id,message,created_time,from,full_picture";
			// $response = file_get_contents($url);
			$massage_data = getSocialData($url);
			// pre($massage_data);
			// $massage_data = json_decode($response);
			$html = '';
			$massage_array = array_reverse($massage_data['data']);
			// $update_data = array();
			// $update_data['massages'] = json_encode($massage_array);
			$massage_table_name = getMasterUsername2() . '_messenge';
			// $delete_displaydata = $this->MasterInformationModel->update_entry2($massage_id, $update_data, $massage_table_name);
			$count = count($massage_array);
			$i = 0;
			$dates = '';
			foreach ($massage_array as $massage_key => $massage_value) {
				$dateTime = new \DateTime($massage_value['created_time']);
				$last7DaysStart = new \DateTime('-7 days');
				$today = new \DateTime();
				// pre($today);
				$date = $dateTime->format('d/m/Y');
				$isWithinLast7Days = $dateTime >= $last7DaysStart;
				if ($date != $dates) {
					if ($isWithinLast7Days) {
						$dayOfWeek = $dateTime->format('l');
					} else {
						$dayOfWeek = $dateTime->format('d/m/Y');
					}
					$html .= '<div class="col-12 text-center mb-2" style="font-size:12px;"><span class="px-3 py-1 rounded-3" style="background:#f3f3f3;">' . $dayOfWeek . '</div>';
					$dates = $date;
				}
				$time = $dateTime->format('H:i a');
				// pre($date);
				// pre($time);
				$message = $massage_value['message'];
				if (!empty($message)) {
					if ($_POST['page_id'] == $massage_value['from']['id']) {
						$html .= '
								<div class="d-flex mb-4 justify-content-end" >
                                <div class="col-9 text-end">
									<span class="me-2" style="font-size:12px;">' . $time . '</span> <span class="px-3 py-2 rounded-3 text-white" style="background:#724EBF;">' . $message . ' </span> 
                                </div>
                            </div>';
					} else {
						$html .= '
							<div class="d-flex mb-4 ">
								<div class="col-9 text-start">
									<span class="px-3 py-2 rounded-3 " style="background:#f3f3f3;">' . $message . ' </span> <span class="ms-2" style="font-size:12px;">' . $time . '</span>
								</div>
							</div>';
					}
					$i++;
				}
			}

			$return_result = array();
			$return_result['html'] = $html;
			return json_encode($return_result);
		}
	}


	public function send_massage()
	{
	}
}
