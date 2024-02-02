<?php



namespace App\Controllers;



use App\Models\MasterInformationModel;

use Config\Database;



class clint_support_controller extends BaseController

{

	public function __construct()

	{

		helper('custom');

		$db = db_connect();

		$this->MasterInformationModel = new MasterInformationModel($db);

		$this->admin = 0;

		$this->username = session_username($_SESSION['username']);

		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

			$this->admin = 1;

		}

	}

	

	// public function clint_list_data()

	// {

	// 	$name = $_POST["name"] ?? '';

	// 	$user_id_val = $_POST["user_id"] ?? '';

	// 	$all_ticket_status = $_POST["all_ticket_status"] ?? '';

	// 	$statusArray = $all_ticket_status ? explode(',', $all_ticket_status) : [];

	// 	$SupportTicketData = json_decode($this->MasterInformationModel->display_all_records2('master_support_ticket'), true);

	// 	$html = '';

	// 	foreach ($SupportTicketData as $value_st) {

	// 		$UserData = $this->MasterInformationModel->edit_entry('master_user', $value_st['user_id']);

	// 		$UserData = reset($UserData);

	// 		if (empty($name) || preg_match("/" . preg_quote($name, '/') . "/i", $UserData->name)) {

	// 			if (empty($user_id_val) || $UserData->id == $user_id_val) {

	// 				if (empty($all_ticket_status) || in_array($value_st['ticket_status'], $statusArray)) {

	// 					$photo = $UserData->profile_pic

	// 						? "http://localhost/RealtoSmartDev/assets/images/user_profile_pic/{$UserData->profile_pic}"

	// 						: "https://admin.realtosmart.com/assets/images/chat-user.svg";



	// 					$html .= '<div class="nav-link w-100 cursor-pointer text-start d-flex align-items-center rounded-0 click_event_div_list remove_class_active_div"  chat_id_table="' . $value_st['id'] . '" user_name="' . $UserData->name . '" user_id="' . $value_st['user_id'] . '" issue_title="' . $value_st['title'] . '" issue_description="' . $value_st['description'] . '" issue_attchment="' . $value_st['attachment'] . '" user_profile_src="' . $photo . '" support_ticket_status="' . $value_st['ticket_status'] . '">

	// 									<div class="chat-nav-user-img rounded-circle bg-secondary bg-opacity-75 overflow-hidden"> <img src="' . $photo . '" alt="" class=""> </div>

	// 									<p class="ms-3"><b>' . $UserData->name . '</b> ' . $value_st['title'] . '</p>

	// 								</div>';

	// 				}

	// 			}

	// 		}

	// 	}

	// 	if (!empty($html)) {

	// 		echo $html;

	// 	}

	// }



	public function searchbar_url()

    {

		$status_val = ($_POST['status']);

		$html = '';

        $searchText = $_POST['search_text'];

		$SupportTicketData = json_decode($this->MasterInformationModel->display_all_records2('master_support_ticket'), true);

		foreach ($SupportTicketData as $value_st) {

			$UserData = $this->MasterInformationModel->edit_entry('master_user', $value_st['user_id']);

			$UserData = reset($UserData);

			if($searchText == $UserData->id || empty($searchText) || preg_match("/" . preg_quote($searchText, '/') . "/i", $UserData->name) || preg_match("/" . preg_quote($searchText, '/') . "/i", $value_st['title'])){

				if(empty($status_val) || $status_val == $value_st['ticket_status']){

						$photo = $UserData->profile_pic

							? "http://localhost/RealtoSmartDev/assets/images/user_profile_pic/{$UserData->profile_pic}"

							: "https://admin.realtosmart.com/assets/images/chat-user.svg";



						$html .= '<div class="nav-link w-100 cursor-pointer text-start d-flex align-items-center rounded-0 click_event_div_list remove_class_active_div"  chat_id_table="' . $value_st['id'] . '" user_name="' . $UserData->name . '" user_id="' . $value_st['user_id'] . '" issue_title="' . $value_st['title'] . '" issue_description="' . $value_st['description'] . '" issue_attchment="' . $value_st['attachment'] . '" user_profile_src="' . $photo . '" support_ticket_status="' . $value_st['ticket_status'] . '">

										<div class="chat-nav-user-img rounded-circle bg-secondary bg-opacity-75 overflow-hidden"> <img src="' . $photo . '" alt="" class=""> </div>

										<p class="ms-3"><b>' . $UserData->name . '</b> ' . $value_st['title'] . '</p>

									</div>';

				}

			}

		}

		if (!empty($html)) {

			echo $html;

		}

    }



	public function clint_list_data()

    {

		$status_val = ($_POST['status']);

		$html = '';

        $searchText = $_POST['search_text'];

		$SupportTicketData = json_decode($this->MasterInformationModel->display_all_records2('master_support_ticket'), true);

		foreach ($SupportTicketData as $value_st) {
			
			$url = "https://erp.realtosmart.com/";
			$database = "";
			if($value_st['ticket_status'] == 1) {
				$url = "https://erp.realtosmart.com/";
				$database = "";
			} else if($value_st['ticket_status'] == 2) {
				$url = "https://erp.gymsmart.in/";
				$database = "";
			} else if($value_st['ticket_status'] == 3) {
				$url = "https://erp.leadmgtcrm.com/";
				$database = "";
			}
			$UserData = $this->MasterInformationModel->edit_entry('master_user', $value_st['user_id']);

			$UserData = reset($UserData); // Get the first object in the array



			if ($UserData && ($searchText == $UserData->id || empty($searchText) || preg_match("/" . preg_quote($searchText, '/') . "/i", $UserData->name) || preg_match("/" . preg_quote($searchText, '/') . "/i", $value_st['title']))) {

				if (empty($status_val) || $status_val == $value_st['ticket_status']) {

					$photo = $UserData->profile_pic

						? $url."assets/images/user_profile_pic/{$UserData->profile_pic}"

						: $url."assets/images/chat-user.svg";



					$html .= '<div class="nav-link w-100 cursor-pointer text-start d-flex align-items-center rounded-0 click_event_div_list remove_class_active_div" chat_id_table="' . $value_st['id'] . '" user_name="' . $UserData->name . '" user_id="' . $value_st['user_id'] . '" issue_title="' . $value_st['title'] . '" issue_description="' . $value_st['description'] . '" issue_attchment="' . $value_st['attachment'] . '" user_profile_src="' . $photo . '" support_ticket_status="' . $value_st['ticket_status'] . '">

						<div class="chat-nav-user-img rounded-circle bg-secondary bg-opacity-75 overflow-hidden"> <img src="' . $photo . '" alt="" class=""> </div>

						<p class="ms-3"><b>' . $UserData->name . '</b> ' . $value_st['title'] . '</p>

					</div>';

				}

			}



			// if ($searchText == $UserData->id || empty($searchText) || preg_match("/" . preg_quote($searchText, '/') . "/i", $UserData->name) || preg_match("/" . preg_quote($searchText, '/') . "/i",$value_st['title'])) {

			// 	if (empty($status_val) || $status_val == $value_st['ticket_status']) {

			// 		$photo = $UserData->profile_pic

			// 			? "http://localhost/RealtoSmartDev/assets/images/user_profile_pic/{$UserData->profile_pic}"

			// 			: "https://admin.realtosmart.com/assets/images/chat-user.svg";

			

			// 		$html .= '<div class="nav-link w-100 cursor-pointer text-start d-flex align-items-center rounded-0 click_event_div_list remove_class_active_div" chat_id_table="' . $value_st['id'] . '" user_name="' . $UserData->name . '" user_id="' . $value_st['user_id'] . '" issue_title="' . $value_st['title'] . '" issue_description="' . $value_st['description'] . '" issue_attchment="' . $value_st['attachment'] . '" user_profile_src="' . $photo . '" support_ticket_status="' .  $value_st['ticket_status'] . '">

			// 			<div class="chat-nav-user-img rounded-circle bg-secondary bg-opacity-75 overflow-hidden"> <img src="' . $photo . '" alt="" class=""> </div>

			// 			<p class="ms-3"><b>' . $UserData->name . '</b> ' . $value_st['title'] . '</p>

			// 		</div>';

			// 	}

			// }

			

			

		}

		if (!empty($html)) {

			echo $html;

		}

    }



    public function support_chat_list_data_admin()

	{

		$baseurl = base_url();

		$currentDate = date("d-m-Y");

        $previousDate = date("d-m-Y", strtotime("-1 day"));

		$table_name = $_POST['table'];

		$allow_data = json_decode($_POST['show_array']);

		$action = $_POST['action'];

		$html = "";

        $user_id = $_POST['user_id'];

		$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $user_id);

		foreach ($departmentEditdata as $d_key => $d_value) {

		}

			if (isset($d_value->conversation)) {

				if($d_value->conversation !== ""){

					$file_array = explode('[,]', $d_value->conversation);

					$uniqueDates = array(); 	

					foreach ($file_array as $key => $value) {

						$vv = json_decode($value, true);

						$html .= '

						';

						$date = $vv["date"];

						if (!in_array($date, $uniqueDates)) {

							$uniqueDates[] = $date;

							if($date == $currentDate){

								$html .='

								<div class="user-chat-box col-12 user-day-chat w-100 text-center">

									<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">Today</p>

								</div>';			

							}else if($date == $previousDate){

								$html .='

									<div class="user-chat-box col-12 user-day-chat w-100 text-center">

										<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">Yesterday</p>

									</div>';

							}else{

								$html .='

									<div class="user-chat-box col-12 user-day-chat w-100 text-center">

										<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;">'.$date.'</p>

									</div>';

							}

						}

						if($vv["chat"] !== ""){

							if($vv["user_id"] !== "ADMIN"){						

								$html .='

										<div class="user-chat-box user-right-chat w-100 text-start mb-2 user_controller_chat">

											<div class="user-chat bg-white rounded-2 p-2 shadow-sm d-inline-block position-relative text-start" style="max-width: 50%;">'.$vv["chat"].'

												<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">'.$vv["time"].'

												</div>

											</div>

										</div>';

							}else{

								$html .='

										<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">

											<div class="user-chat bg-white rounded-2 p-2 shadow-sm d-inline-block position-relative text-start" style="max-width: 50%;">'.$vv["chat"].'

												<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">'.$vv["time"].'

												</div>

											</div>

										</div>';

							}

						}else{

							if($vv["user_id"] !== "ADMIN"){	

								$filename = $vv['attachment'];

								$file_info = pathinfo($filename);

								$extension = strtolower($file_info['extension']);

								$image_extensions = array("jpg", "jpeg", "png", "gif", "bmp");

								if (in_array($extension, $image_extensions)) {

									$html .='

									<div class="user-chat-box user-right-chat w-100 text-start mb-2 user_controller_chat">

										<div class="user-chat rounded-2 p-2 d-inline-block position-relative text-start"

											style="max-width: 50%;"><span href="http://localhost/RealtoSmartDev/assets/support_ticket_store/'.$filename.'" class="file_attachment_open_div cursor-pointer">

											<img src="http://localhost/RealtoSmartDev/assets/support_ticket_store/'.$filename.'" alt="" style="max-width: 150px; height: auto;" class="d-block rounded-2"></span>

											<div class="user-chat-time text-body-tertiary d-block text-lowercase">

												15:23pm

											</div>

										</div>

									</div>';

								} else {

									$html .='

									<div class="user-chat-box user-right-chat w-100 text-start mb-2 user_controller_chat">

										<div class="user-chat bg-white rounded-2 p-2 shadow-sm border d-inline-block position-relative text-start"

											style="max-width: 50%;">

											 <img src="https://dev.realtosmart.com/assets/images/chat-document.svg" alt="">

											<span href="http://localhost/RealtoSmartDev/assets/support_ticket_store/'.$vv["attachment"].'" class="file_attachment_open_div cursor-pointer">

											'.$vv["attachment"].'</span>

											<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">

											'.$vv["time"].'

											</div>

										</div>

									</div>';

								}

							}else{

								$filename = $vv['attachment'];

								$file_info = pathinfo($filename);

								$extension = strtolower($file_info['extension']);

								$image_extensions = array("jpg", "jpeg", "png", "gif", "bmp");

								if (in_array($extension, $image_extensions)) {

									$html .='

									<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">

										<div class="user-chat  p-2 d-inline-block position-relative text-start"

											style="max-width: 50%;"><span href="'.$baseurl.'assets/support_ticket_store_admin/'.$filename.'" class="file_attachment_open_div cursor-pointer">

											<img src="'.$baseurl.'assets/support_ticket_store_admin/'.$filename.'" alt="" style="max-width: 150px; height: auto;" class="d-block rounded-2"><span>

											<div class="user-chat-time text-body-tertiary d-block text-lowercase">

												15:23pm

											</div>

										</div>

									</div>';

								} else {

									$html .='

									<div class="user-chat-box user-right-chat w-100 text-end mb-2 user_controller_chat">

										<div class="user-chat bg-white  p-2 shadow-sm border  d-inline-block position-relative text-start"

											style="max-width: 50%;">

											<img src="https://dev.realtosmart.com/assets/images/chat-document.svg" alt=""> 

											<span href="'.$baseurl.'assets/support_ticket_store_admin/'.$vv["attachment"].'" class="file_attachment_open_div cursor-pointer" >

											'.$vv["attachment"].' </span>

											<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">

											'.$vv["time"].'

											</div>

										</div>

									</div>';

								}

							}

						}

					}

				}

			}

		if (!empty($html)) {

			echo $html;

		} else {

			echo '

			<div class="user-chat-box col-12 user-day-chat w-100 text-center">

				<p class="bg-white rounded-2 p-2 shadow-sm d-inline-block mb-2 "style="font-size:11px;" >Today

				</p>

			</div>';

		}

	}

	public function update_ticket_status(){

		$chat_id = $_POST['chat_id'];

		$update_data['ticket_status'] = $_POST['ticket_status'];

		$departmentUpdatedata = $this->MasterInformationModel->update_entry2($chat_id, $update_data, "master_support_ticket");

	}

    public function send_message_data_conversion()

	{

		if($_POST['chat'] !== ""){

			$user_id = $_POST['edit_id'];

			$table_name = $_POST['table'];

			$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $user_id);

			foreach ($departmentEditdata as $d_key => $d_value) {

			}            

			$old_chat = ($d_value->conversation);

			if (isset($d_value->conversation)) {

				if($d_value->conversation !== ""){

					$file_array = explode('[,]', $d_value->conversation);

					$uniqueDates = array(); 	

					foreach ($file_array as $key => $value) {

						$vv = json_decode($value, true);

					}

					if($vv["user_id"] !== "ADMIN"){

						$update_data['ticket_status'] = "In Progress";

						$departmentUpdatedata = $this->MasterInformationModel->update_entry2($user_id, $update_data, $table_name);

					}

				}

			}

			$master_id = "ADMIN";

			$chat = $_POST['chat'];

			$date = $_POST['date'];

			$time = $_POST['time'];

			$user_chat=array(

				"user_id" => $master_id,

				"chat" => $chat,

				"date" => $date,

				"time" => $time

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

				unset($_POST['old_conversation']);

					$update_data = $_POST;

					$update_data['conversation'] = $update_chat;

					$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table);

					$response = 1;		

			}

			return $update_chat;

			die();

		}else{

			$edit_id = $_POST['edit_id'];

			$table = $_POST['table'];

			$departmentEditdata = $this->MasterInformationModel->edit_entry2($table, $edit_id);

			foreach ($departmentEditdata as $d_key => $d_value) {

			}            

			$old_chat = ($d_value->conversation);

			$date=$_POST['date'];

			$time=$_POST['time'];

			$master_id = "ADMIN";

			$attachment = $_POST['attachment_files'];

			$attachment_array = explode(',', $attachment);

			$name="";

			$chatArray = array();

			foreach ($attachment_array as $file) {

				$user_chat = array(

					"user_id" => $master_id,

					"chat" => "",

					"date" => $date,

					"time" => $time,

					"attachment" => $file

				);

				$chatArray[] = json_encode($user_chat);

			}

			$chatString = implode('[,]', $chatArray); 



			if($chatString !== ""){

				$newstring = $old_chat . "[,]" . $chatString;

				$update_data['conversation'] = $newstring;

				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($edit_id, $update_data, $table);

			}

			$files= $_FILES;

			if(!empty($files)){

				$uploadDir = 'assets/support_ticket_store_admin/';

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

}







