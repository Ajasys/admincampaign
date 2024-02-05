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
    public function bot_messenger(){
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
		$GetOldConversation = get_editData2($table_username .'_messeging_bot', intval($_POST['edit_id']));
		$currentDate = date("d-m-Y");
		$currentDate = UtcTime('d-m-Y', timezonedata(), $currentDate);
		// $master_id = $this->master_id;
		$current_time = date('H:i');
		$current_time = UtcTime('H:i', timezonedata(), $current_time);
		if($_POST['chat'] !== ""){
			$old_chat = $GetOldConversation['chatting'];
			$chat = $_POST['chat'];
			$user_chat=array(
				// "user_id" => $master_id,
				"chat" => $chat,
				"date" => $currentDate,
				"time" => $current_time
			);
			$chatArray = json_encode($user_chat);
			if($old_chat == ""){
				$update_chat = $chatArray;
			}else{
				$update_chat = $old_chat."[,]".$chatArray;
			}
			$post_data = $this->request->getPost();
			$table = $_POST['table'];
			$table_name = $this->username.'_'.$table;
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
		}else{
			$old_convertsaion = $GetOldConversation['chatting'];
			$edit_id = $_POST['edit_id'];
			$table = $_POST['table'];
			$attachment = $_POST['attachment_files'];
			$attachment_array = explode(',', $attachment);
			$name="";
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
			if($chatString !== ""){
				$newstring = $old_convertsaion . "[,]" . $chatString;
				$update_data['chatting'] = $newstring;
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($edit_id, $update_data, $table);
			}
			$files= $_FILES;
			if(!empty($files)){
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
						if($fileName !== ""){
							if(strlen($fileName) == 1){
								$uploadedFile .= $fileName;
							}else{
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
				if($d_value->chatting !== ""){
					$file_array = explode('[,]', $d_value->chatting);
					$uniqueDates = array(); 
					
					$html .='
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
									if($vv["chat"] !== ""){
										// pre($vv["chat"]);
										// if($vv["user_id"] !== "ADMIN"){						
											$html .='
			
											<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">
												<div class="user-chat rounded-2 p-2 shadow-sm d-inline-block position-relative text-start text-white" style="max-width: 50%; background-color: #724EBF;">'.$vv["chat"].'
													
												</div>

												<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase col-12" style="font-size:14px;">'.Utctodate('H:i', timezonedata(), $vv["time"]).'
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

	public function bot_insert_data()
	{
		$post_data = $this->request->getPost();
		$table = $this->request->getPost("table");

		$action_name = $this->request->getPost("action");
	
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;
				//$insert_data['image'] = $newName;
				// print_r($_POST);
				// die(); 
				$isduplicate = $this->duplicate_data($insert_data, $table);
		
				if ($isduplicate == 0) {
					$response = $this->MasterInformationModel->insert_entry($insert_data, $table);
				
					$expenses_insertdisplaydata = $this->MasterInformationModel->display_all_records($table);
					$expenses_insertdisplaydata = json_decode($expenses_insertdisplaydata, true);
				} else {
					return "error";
				}
			}
		}
	}

    
}