<?php
namespace App\Controllers\Campaign;
use App\Controllers\BaseController;
use App\Models\MasterInformationModel;
use Config\Database;

class Templates_Controller extends BaseController
{
	public function __construct()
	{
		helper("custom");
		$db = db_connect();
		session();
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->username = session_username($_SESSION["username"]);
		$this->admin = 0;
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
	}

	public function bulkwhatsapp_template_sent(){
		$db_connection = DatabaseDefaultConnection();
		$customer_id = $_POST['customer_id'];
		$customer_id_array = explode(",", $customer_id);
		
		$placeholders = rtrim(str_repeat('?,', count($customer_id_array)), ',');
		$query = "SELECT mobileno FROM admin_all_inquiry WHERE id IN ($placeholders)";
		
		$bind_array = array_map('intval', $customer_id_array);
		
		$result1 = $db_connection->query($query, $bind_array);
		$results_memberdata = $result1->getResultArray();
		
		$phone_nos = array_column($results_memberdata, 'mobileno');
		
	
		$post_data = $_POST;
		$template_name = $post_data['header'];
		$language = $post_data['language'];
	
		$access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
	
		$url = MetaUrl()."156839030844055/messages?access_token=" . $access_token;
		$ReturnResult = 0; 
	
		foreach ($phone_nos as $phone_no) {
			$postData = json_encode([
				"messaging_product" => "whatsapp",
				"recipient_type" => "individual",
				"to" => $phone_no,
				"type" => "template",
				"template" => [
					"name" => $template_name,
					"language" => [
						"code" => $language
					]
				]
			]);
	
			$Result = postSocialData($url, $postData);
			if (!isset($Result['id'])) {
				$ReturnResult = 1; 
			}
		}
		echo $ReturnResult;
	}
	
	public function allinq_sms_send()
	{
		$db = DatabaseDefaultConnection();
		$customer_id = $_POST['customer_id'];
		$customer_id_array = explode(",", $customer_id);

		if (isset($_POST['email_template']) && !empty($_POST['email_template'])) {
			$email_template = $_POST['email_template'];
			$email_template_send = $db->query("SELECT * FROM " . $this->username . "_emailtemplate WHERE id =" . $email_template);
			$get_data_email = $email_template_send->getResult();

			if (isset($get_data_email[0])) {
				$email_data_template = get_object_vars($get_data_email[0]);
				$subject = $email_data_template['title'];
				$var_message = $email_data_template['template'];

				$attachment = $email_data_template['attachment'];
			} else {
				$email_data_template = array();
			}
		} else {
			$email_data_template = array();
		}

		$cat = $db->query("SELECT * FROM master_user WHERE id =" . $_SESSION['master']);
		$result = $cat->getResult();
		if (isset($result[0])) {
			$settings_data = get_object_vars($result[0]);
		} else {
			$settings_data = array();
		}
		$masterId = $settings_data['id'];
		foreach ($customer_id_array as $key => $value) {
			$inq_id = $customer_id_array[$key];
			$data = inquiry_id_to_full_inquiry_data($inq_id);
			$full_name = $data['full_name'];
			$dob = $data['dob'];
			$anni_date = $data['anni_date'];
			$mobileno = $data['mobileno'];
			$email = $data['email'];
			// Replace placeholders in the template
			$var_message = str_replace("{{Enquirer Full Name}}", $full_name, $var_message);
			$var_message = str_replace("{{Enquirer Mobile Number}}", $mobileno, $var_message);
			$var_message = str_replace("{{Enquirer Date of Birth}}", $dob, $var_message);
			$var_message = str_replace("{{Enquirer Anniversary Date}}", $anni_date, $var_message);
			$var_message = str_replace("{{Enquirer Email}}", $email, $var_message);

			$mail_send = SendMail($email, $subject, $var_message, $attachment, '');
		}
	}
	public function template()
	{
		$table_name = $this->username . '_all_inquiry';
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $table_name . "';";
		$thirdDb = \Config\Database::connect('default');
		$result = $thirdDb->query($sql);
		$conversation_chat_user = $result->getResultArray();
		$column_names_array = array();
		foreach ($conversation_chat_user as $column) {
			$column_names_array[] = $column['COLUMN_NAME'];
		}
		$data['data'] = json_encode($column_names_array);
		return view('template', $data);
	}

	public function template_list_data()
	{
		$return_array = array();
		$table_username = getMasterUsername();
		$DataBase = DatabaseSecondConnection();
		$username = session_username($_SESSION['username']);
		function createOrUpdateTable($tableName, $columns, $DataBase)
		{
			if (!$DataBase->tableExists($tableName)) {
				$columns_str = implode(', ', $columns);
				$sql = "CREATE TABLE $tableName ($columns_str)";
				$DataBase->query($sql);
			} else {
				foreach ($columns as $column) {
					$parts = explode(' ', $column);
					$column_name = $parts[0];
					if (!$DataBase->fieldExists($column_name, $tableName)) {
						$sql = "ALTER TABLE $tableName ADD $column";
						$DataBase->query($sql);
					}
				}
			}
		}

		// For SMS Template 
		$sms_table = $table_username . '_smstemplate';
		$columns_sms = [
			'id int(255) primary key NOT NULL AUTO_INCREMENT',
			'title varchar(400) NOT NULL',
			'template longtext NOT NULL',
			'template_id varchar(400) NOT NULL',
		];
		createOrUpdateTable($sms_table, $columns_sms, $DataBase);

		// For Email Template 
		$email_table = $table_username . '_emailtemplate';
		$columns_email = [
			'id int(255) primary key NOT NULL AUTO_INCREMENT',
			'title varchar(400) NOT NULL',
			'attachment longtext NOT NULL',
			'template longtext NOT NULL',
		];
		createOrUpdateTable($email_table, $columns_email, $DataBase);

		// For WhatsApp Template 
		$whatsapp_table = $table_username . '_whatsapp_template';
		$columns_whatsapp = [
			'id int(255) primary key NOT NULL AUTO_INCREMENT',
			'title varchar(400) NOT NULL',
			'template longtext NOT NULL',
			'attachment longtext NOT NULL',
		];
		createOrUpdateTable($whatsapp_table, $columns_whatsapp, $DataBase);
		$table = $_POST['table'];
		$table_name = $this->username . '_' . $table;
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);

		$data = $departmentdisplaydata = json_decode($departmentdisplaydata, true);

		$i = 1;
		$html = "";
		if ($table == "smstemplate") {
			foreach ($departmentdisplaydata as $key => $value) {
				$ts = '<tr style="width:0%">
							<td style="width:0% !important">
							<input class="checkbox table_list_check" type="checkbox" id="select-all" data-delete_id="' . $value['id'] . '"
							</td>
				';
				$ts .= "";
				$ts .= '
					<td class="edt edit_sms_div" data_edit_id="' . $value['id'] . '">
						<div class="px-0 py-0 w-100 sms_template_view" data-bs-target="#sms_template_view" data-view_id="' . $value['id'] . '" data-bs-toggle="modal">
						<div class="row row-cols-1">
							<div class="col">
								<b>' . $value['id'] . ' Title :</b>
								<span class="mx-2">' . $value['title'] . '</span>
							</div>
						</div>
					</div>
				</td>
				';
				$html .= $ts;
				$html .= '</tr>';
				$i++;
			}
		} else {
			foreach ($departmentdisplaydata as $key => $value) {
				$ts = '<tr style="width:0%">
							<td style="width:0% !important">
								<input class="checkbox table_list_check" type="checkbox" id="select-all" data-delete_id="' . $value['id'] . '"
							</td>
				';

				$ts .= "";
				$ts .= '
					<td>
						<div class="edit_email edit_email_t_changes edit_email_t_changes_email edit_email_t px-0 py-0 w-100" data-bs-toggle="modal" data_table="' . $table . '" data-bs-target="#add-email" data-edit_id="' . $value['id'] . '">
							<div class="row row-cols-1">
								<div class="col">
									<b>' . $value['id'] . ' Title :</b>
									<span class="mx-2">' . $value['title'] . '</span>
								</div>
							</div>
						</div>
					</td>
					';
				$html .= $ts;
				$html .= '</tr>';
				$i++;
			}
		}
		if (!empty($html)) {
			// echo $html;
		} else {
			// echo '<p style="text-align:center;">Data Not Found </p>';
		}
		$return_array['html'] = $html;
		echo json_encode($return_array, true);
		die();
	}
	// All Template List Data Code End  ================================================================>


	// Insert Data Code Start  =========================================================================>
	public function insert_data_t()
	{
		$files = $_FILES;
		if (!empty($files)) {
			$uploadDir = 'assets/whatapp_email_store/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			$filesArr = $_FILES["attachment"];
			$fileNames = array_filter($filesArr['name']);
			$uploadedFile = '';
			foreach ($filesArr['name'] as $key => $val) {
				$fileName = basename($filesArr['name'][$key]);
				$targetFilePath = $uploadDir . $fileName;
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
				if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
					$uploadedFile .= $fileName . ',';
				} else {
					$uploadStatus = 0;
					$response['message'] = 'Sorry, there was an error uploading your file.';
				}
			}
		}
		$post_data = $this->request->getPost();
		$table = $_POST['table'];
		$table_name = $this->username . '_' . $table;
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);


			// $inputCode = $_POST["template"];

			// Create an HTML file and write the input code to it
			// $htmlFileName = "output.html";
			// $htmlFile = fopen($htmlFileName, "w");

			// if ($htmlFile) {
			// 	fwrite($inputCode);
			// 	fclose($htmlFile);

			// $test =  html_entity_decode($inputCode);
			// } else {
			// 	$test =  "Error creating HTML file.";
			// }

			if (!empty($_POST)) {
				$insert_data = $_POST;
				$isduplicate = $this->duplicate_data($insert_data, $table_name);
				if ($isduplicate == 0) {
					// $insert_data['template'] = $inputCode;
					$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
					$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				} else {
					return "error";
				}
			}
		}
		die();
	}
	// Insert Data Code End  ===========================================================================>

	// Update Data Code Start  =========================================================================>
	public function update_data_t()
	{
		$files = $_FILES;
		if (!empty($files)) {
			$uploadDir = 'assets/whatapp_email_store/';
			$filesArr = $_FILES["attachment"];
			$fileNames = array_filter($filesArr['name']);
			$uploadedFile = '';
			foreach ($filesArr['name'] as $key => $val) {
				$fileName = basename($filesArr['name'][$key]);
				$targetFilePath = $uploadDir . $fileName;
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
				if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
					$uploadedFile .= $fileName . ',';
				} else {
					$uploadStatus = 0;
					$response['message'] = 'Sorry, there was an error uploading your file.';
				}
			}
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
			if (!empty($post_data)) {
				$update_data = $_POST;
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;
			}
		}
		die();
	}
	// Update Data Code End  ===========================================================================>

	// Edit Data Code Start  ===========================================================================>
	public function edit_data_t()
	{
		$edit_id = $_POST['edit_id'];
		$table = $_POST['table'];
		$table_name = $this->username . '_' . $table;
		$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);

		foreach ($departmentEditdata as $d_key => $d_value) {
		}
		if (isset($d_value->attachment)) {
			if ($d_value->attachment !== "") {
				$html = '';
				$file_array = explode(',', $d_value->attachment);
				foreach ($file_array as $key => $value) {
					$html .= '<div class="col-12 controller_ubtn view-file-link d-flex m-1 px-2 rounded"><p id="files" data-files="' . $value . '">' . $value . '</p>  <span class="ms-auto remove_btn_files " id="file_crodd_btn"><i class="bi bi-x-circle"></i></span> </div>';
				}
				$departmentEditdata['file_html'] = $html;
			}
		}
		return json_encode($departmentEditdata, true);
	}
	// Edit Data Code End  =============================================================================>

	// Delete Data Code Start  =========================================================================>
	public function template_delete_data()
	{
		$table_username = getMasterUsername();
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$table = $_POST['table'];
			$table_name =  $this->username . '_' . $table;
			// $table_name = $this->request->getPost('table');
			$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($table_name, $delete_id);
		}
		die();
	}
	// Delete Data Code End  ===========================================================================>

	// Dublicate Data Code Start  ======================================================================>
	public function duplicate_data($data, $table)
	{
		$db = DatabaseDefaultConnection();
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

		$result = $db->query($sql);
		if ($result->getNumRows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	// Dublicate Data Code End  ========================================================================>

	// View Data Code Start  ===========================================================================>
	public function view_data()
	{
		if ($this->request->getPost("action") == "view") {
			$view_id = $this->request->getPost('view_id');
			$table = $_POST['table'];
			$table_name = $this->username . '_' . $table;
			$userEditdata = $this->MasterInformationModel->edit_entry($table_name, $view_id);
			return json_encode($userEditdata, true);
		}
		die();
	}
	// View Data Code End  =============================================================================>
	function fetch_email_track_data()
	{
		$db_connection = DatabaseDefaultConnection();

		$query = "SELECT admin_email_data.email_subject,admin_email_data.email_address,admin_email_data.email_body,admin_email_data.email_track_code,admin_email_track.email_status,MAX(admin_email_track.email_open_datetime) AS email_open_datetime FROM admin_email_data LEFT JOIN admin_email_track ON admin_email_track.email_track_code = admin_email_data.email_track_code GROUP BY admin_email_data.email_subject,admin_email_data.email_address,admin_email_data.email_body,admin_email_data.email_track_code,admin_email_track.email_status ORDER BY email_open_datetime DESC";
		$query = "SELECT 
		admin_email_data.email_subject,
		admin_email_data.email_address,
		admin_email_data.email_body,
		admin_email_data.email_track_code,
		admin_email_data.email_link_track_code,  -- Include email_link_track_code here
		admin_email_track.email_status,
		MAX(admin_email_track.email_open_datetime) AS email_open_datetime 
	FROM 
		admin_email_data 
	LEFT JOIN 
		admin_email_track ON admin_email_track.email_track_code = admin_email_data.email_track_code 
	GROUP BY 
		admin_email_data.email_subject,
		admin_email_data.email_address,
		admin_email_data.email_body,
		admin_email_data.email_track_code,
		admin_email_data.email_link_track_code,  -- Group by email_link_track_code as well
		admin_email_track.email_status 
	ORDER BY 
		email_open_datetime DESC";
		// $query = "SELECT * FROM admin_email_data";
		$db_connection = DatabaseDefaultConnection();
		// $statement = $db_connection->prepare($query);
		$result1 = $db_connection->query($query);
		$result = $result1->getResultArray();

		// $statement->execute();
		// $result = $statement->fetchAll();
		// $total_row = $statement->rowCount();
		$total_row = 1;
		$output = "";
		if ($total_row > 0) {
			foreach ($result as $row) {
				$status = '';
				if ($row['email_status'] == 'yes') {
					$status = '<span class="label label-success">Open</span>';
				} else {
					$status = '<span class="label label-danger">Not Open</span>';
				}
				if (isset($row['email_track_code'])) {
					$email_track_codee = $row['email_track_code'];
				}
				if (isset($row['email_link_track_code'])) {
					$email_link_track_code = $row['email_link_track_code'];
				}
				$open_date = date('d-m-Y h:i a', strtotime($row["email_open_datetime"]));
				$output .= '
					<tr>
						<td>' . ($row["email_address"]) . '</td>
						<td>' . ($row["email_subject"]) . '</td>
						<td>' . ($status) . '</td>
						<td>' . ($open_date) . '</td>
						<td>
							<div class="form-group">                                   
								<a href="' . (base_url('email_history_show?email_track_id=' . $email_track_codee . '&email_track_link=' . $email_link_track_code)) . '" class="btn bg-transperent rounded-2 btn_purple">See Details</a>
							</div>
						</td>
					</tr>';
			}
		}

		$return_array['html'] = $output;
		echo json_encode($return_array);
		die();
	}

	function show_data_email()
	{

		if (isset($_POST['email_trac_id'])) {
			$track_id = $_POST['email_trac_id'];
		} else {
			$track_id = "";
		}
		if (isset($_POST['email_track_link'])) {
			$track_link = $_POST['email_track_link'];
		} else {
			$track_link = "";
		}

		$db = DatabaseDefaultConnection();
		// $db->query('TRUNCATE TABLE admin_email_data');
		// $db->query('TRUNCATE TABLE admin_email_track');
		$query = "SELECT  admin_email_data.email_subject,admin_email_data.email_address,admin_email_data.email_body,admin_email_data.email_track_code ,admin_email_track.email_status,admin_email_track.email_open_datetime
FROM admin_email_data LEFT  JOIN admin_email_track ON admin_email_track.email_track_code = admin_email_data.email_track_code WHERE admin_email_data.email_track_code = admin_email_track.email_track_code  ORDER BY admin_email_track.email_open_datetime DESC";
		$db_connection = DatabaseDefaultConnection();
		// $statement = $db_connection->prepare($query);
		$result1 = $db_connection->query($query);
		$result = $result1->getResultArray();

		// pre($result);
		// die();
		$total_row = 1;
		// $statement = $connect->prepare($query);
		// $statement->execute([$email_track_code]);
		// $result = $statement->fetchAll();
		// $total_row = $statement->rowCount();
		$output = "";
		$html_link = "";
		if ($total_row > 0) {
			foreach ($result as $row) {
				if ($row['email_track_code'] == $track_id) {
					$status = '';
					if ($row['email_status'] == 'yes') {
						$status = '<span class="label label-success">Open</span>';
					} else {
						$status = '<span class="label label-danger">Not Open</span>';
					}
					$open_date = date('d-m-Y h:i a', strtotime($row["email_open_datetime"]));

					$output .= '
					<tr>
					<td class="border-bottom-1"> <span>' . $status . '</span></td>
					<td class="border-bottom-1"> <span>' . $open_date . '</span></td>
					</tr>';
				}
			}


			$query_link = "SELECT * FROM admin_email_track WHERE email_link_track_code = '" . $track_link . "'";

			$result15 = $db_connection->query($query_link);
			$result_link = $result15->getResultArray();

			foreach ($result_link as $row_link) {
				if ($row_link['email_link_track_code'] == $track_link) {
					$status = '';
					if ($row_link['email_status'] == 'yes') {
						$status = '<span class="label label-success">Open</span>';
					} else {
						$status = '<span class="label label-danger">Not Open</span>';
					}
					$open_date50 = date('d-m-Y h:i a', strtotime($row_link["email_open_datetime"]));

					$html_link .= '
					<tr>
					<td class="border-bottom-1"> <span>' . $status . '</span></td>
					<td class="border-bottom-1"> <span>' . $open_date50 . '</span></td>
					</tr>';
				}
			}
		}

		$query10 = "SELECT * FROM admin_email_data WHERE email_track_code = '" . $track_id . "'";
		$result10 = $db_connection->query($query10);
		$result_full_data = $result10->getResultArray();

		$full_message_show = "";
		foreach ($result_full_data as $row_data) {

			$open_date = date('d-m-Y h:i a', strtotime($row_data["email_open_datetime"]));
			$full_message_show .= '
				<tr>
					<td>' . ($row_data["from_email_address"]) . '</td>
					<td>' . ($row_data["email_address"]) . '</td>
					<td>' . ($row_data["email_subject"]) . '</td>
					<td>' . ($row_data["email_body"]) . '</td>			
				</tr>';
		}

		$return_array['html'] = $output;
		$return_array['html_link'] = $html_link;
		$return_array['full_message_show'] = $full_message_show;

		echo json_encode($return_array, true);
		die();
	}
	public function delete_all_t()
	{
		if ($this->request->getPost('checkbox_value')) {
			$ids = $this->request->getPost('checkbox_value');
			$table = $this->request->getPost('table');
			$table_name = $this->username . '_' . $table;
			//print_r($table_name);
			// die();
			if (!empty($ids)) {
				$this->db = DatabaseSecondConnection();
				if (!empty($ids)) {
				}
				$all = implode(",", $ids);
				print_r($all);
				// die();
				$find_Array_all = "DELETE FROM $table_name WHERE id IN ($all)";
				/// print_r($find_Array_all );
				//die();
				$this->db->query($find_Array_all);
			}
		}
	}
}
