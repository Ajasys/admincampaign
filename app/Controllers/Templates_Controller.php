<?php
namespace App\Controllers;
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
        if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
            $this->admin = 1;
        }
    }

	public function template()
	{
		$table_name = $this->username.'_all_inquiry';
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table_name."';";
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
		$return_array = array(

		);
		$table_username = getMasterUsername();
		$DataBase = \Config\Database::connect();
		$username = session_username($_SESSION['username']);
		function createOrUpdateTable($tableName, $columns, $DataBase) {
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
		$table_name = $this->username.'_'.$table;
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
		
		$data = $departmentdisplaydata = json_decode($departmentdisplaydata, true);
		
		$i = 1;
		$html = "";
		if($table == "smstemplate"){
			foreach ($departmentdisplaydata as $key => $value) {
				$ts = '<tr style="width:0%">
							<td style="width:0% !important">
							<input class="checkbox table_list_check" type="checkbox" id="select-all" data-delete_id="' . $value['id'] . '"
							</td>
				';
				$ts .= "";
				$ts .= '
					<td class="edt edit_sms_div" data_edit_id="'.$value['id'].'">
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
		}else{
			foreach ($departmentdisplaydata as $key => $value) 
			{			
				$ts = '<tr style="width:0%">
							<td style="width:0% !important">
								<input class="checkbox table_list_check" type="checkbox" id="select-all" data-delete_id="' . $value['id'] . '"
							</td>
				';

				$ts .= "";
				$ts .= '
					<td>
						<div class="edit_email edit_email_t_changes edit_email_t_changes_email edit_email_t px-0 py-0 w-100" data-bs-toggle="modal" data_table="'.$table.'" data-bs-target="#add-email" data-edit_id="' . $value['id'] . '">
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
		$return_array['html']=$html;
		echo json_encode($return_array, true);
		die();
	}
	// All Template List Data Code End  ================================================================>
	  
	
	// Insert Data Code Start  =========================================================================>
	public function insert_data_t()
	{
		$files= $_FILES;
		if(!empty($files)){
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
		$table_name = $this->username.'_'.$table;
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
		$files= $_FILES;
		if(!empty($files)){
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
		$table_name = $this->username.'_'.$table;
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
		$table_name = $this->username.'_'.$table;
		$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);

		foreach ($departmentEditdata as $d_key => $d_value) {
		}
		if (isset($d_value->attachment)) {
			if($d_value->attachment !== ""){
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
			$table_name =  $this->username.'_'.$table;
			// $table_name = $this->request->getPost('table');
			$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($table_name, $delete_id);
		}
		die();
	}
	// Delete Data Code End  ===========================================================================>

	// Dublicate Data Code Start  ======================================================================>
	public function duplicate_data($data, $table)
	{
		$db = \Config\Database::connect('second');
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
			$table_name = $this->username.'_'.$table;
            $userEditdata = $this->MasterInformationModel->edit_entry($table_name, $view_id);
            return json_encode($userEditdata, true);
        }
        die();
    }
	// View Data Code End  =============================================================================>
	function fetch_email_track_data()
	{
		$db_connection = \Config\Database::connect('second');

		$query = "SELECT admin_email_data.email_subject,admin_email_data.email_address,admin_email_data.email_body,admin_email_data.email_track_code,admin_email_track.email_status,MAX(admin_email_track.email_open_datetime) AS email_open_datetime FROM admin_email_data LEFT JOIN admin_email_track ON admin_email_track.email_track_code = admin_email_data.email_track_code GROUP BY admin_email_data.email_subject,admin_email_data.email_address,admin_email_data.email_body,admin_email_data.email_track_code,admin_email_track.email_status ORDER BY email_open_datetime DESC";
		$db_connection = \Config\Database::connect('second');
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
				$open_date = date('d-m-Y h:i a',strtotime($row["email_open_datetime"]));
				$output .= '
				<tr>
					<td>' . $row["email_address"] . '</td>
					<td>' . $row["email_subject"] . '</td>
					<td>' . $status . '</td>
					<td>' . $open_date . '</td>
					<td>
								<div class="form-group">
									<input type="text" name="email_address"  value="' . $row["email_address"] . '" hidden="true"/>
									<input type="text" name="email_subject"  value="' . $row["email_subject"] . '" hidden="true"/>
									<input type="text" name="email_track_code"  value="' . $row["email_track_code"] . '" hidden="true"/>
									<input type="text" name="email_body"  value="' . $row["email_body"] . '" hidden="true"/>
									
									<a href="' . base_url('email_history_show?email_track_id=' . $row['email_track_code'] . '') . '" class="btn bg-transperent rounded-2 border">See Details</a>
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
		$track_id = $_REQUEST['email_trac_id'];

		$db = \Config\Database::connect('second');
		// $db->query('TRUNCATE TABLE admin_email_data');
		// $db->query('TRUNCATE TABLE admin_email_track');
		$query = "SELECT  admin_email_data.email_subject,admin_email_data.email_address,admin_email_data.email_body,admin_email_data.email_track_code ,admin_email_track.email_status,admin_email_track.email_open_datetime
FROM admin_email_data LEFT  JOIN admin_email_track ON admin_email_track.email_track_code = admin_email_data.email_track_code WHERE admin_email_data.email_track_code = admin_email_track.email_track_code  ORDER BY admin_email_track.email_open_datetime DESC";
		$db_connection = \Config\Database::connect('second');
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
		if ($total_row > 0) {
			foreach ($result as $row) {
				if ($row['email_track_code'] == $track_id) {
					$status = '';
					if ($row['email_status'] == 'yes') {
						$status = '<span class="label label-success">Open</span>';
					} else {
						$status = '<span class="label label-danger">Not Open</span>';
					}
					$open_date = date('d-m-Y h:i a',strtotime($row["email_open_datetime"]));

					$output .= '
					<tr>
					<td class="text-center"> <span>' . $status . '</span></td>
					<td class="text-center"> <span>' . $open_date . '</span></td>
					</tr>';
				}
			}
		}
		$return_array['html'] = $output;
		echo json_encode($return_array, true);
		die();
	}
	public function delete_all_t()
	{
		if ($this->request->getPost('checkbox_value')) {
			$ids = $this->request->getPost('checkbox_value');
			$table = $this->request->getPost('table');
			$table_name = $this->username.'_'.$table;
			//print_r($table_name);
			// die();
			if (!empty($ids)) {
				$this->db = \Config\Database::connect();
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