<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class Alertsetting extends BaseController
{
	public function __construct()
	{
		helper('custom');
		$db = db_connect();
		session();
		//  $this->username = session_username($_SESSION["username"]);
		$this->username = getMasterUsername();
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->timezone = timezonedata();
	}
//alert_setting update data
	public function alert_update_data()
	{
		$table_username = getMasterUsername();
		$username = session_username($_SESSION['username']);
		// pre($_POST);
		// $table = $_POST['table'];
		// $table_name = $this->username . '_' . $table;
		$db_connection = DatabaseDefaultConnection();
		$table_name = $table_username . '_alert_setting';
		$duplicate_table = '';
		$columns = [
			'id int primary key AUTO_INCREMENT',
			'is_alert int',
			'alert_title int',
			'is_sms int',
			'sms_template_id int',
			'is_email int',
			'email_template_id int',
			'is_whatsapp int',
			'whatsapp_template_id int'
		];
		$table = tableCreateAndTableUpdate($table_name, $duplicate_table, $columns);
		$alert_title = $this->request->getPost('alert_title');
		$is_alert = $this->request->getPost('is_alert');
		$is_sms = $this->request->getPost('is_sms');
		$is_email = $this->request->getPost('is_email');
		$is_whatsapp = $this->request->getPost('is_whatsapp');
		$sms_template_id = $this->request->getPost('sms_template_id');
		$email_template_id = $this->request->getPost('email_template_id');
		$whatsapp_template_id = $this->request->getPost('whatsapp_template_id');
		// pre($alert);
		$response = 0;
		$sql = "SELECT * FROM " . $username . "_alert_setting WHERE alert_title=$alert_title";
		// pre($sql);
		$result = $db_connection->query($sql);
		// pre($result);
		// die();
		if ($result->getNumRows() > 0) {
			$updateSql = "UPDATE " . $username . "_alert_setting SET  is_alert = '$is_alert', is_sms = '$is_sms', is_email = '$is_email', is_whatsapp = '$is_whatsapp',sms_template_id = '$sms_template_id',email_template_id ='$email_template_id',whatsapp_template_id='$whatsapp_template_id' WHERE alert_title=$alert_title";
			// pre($updateSql);
			$db_connection->query($updateSql);
		} else {
			$insertSql = "INSERT INTO " . $username . "_alert_setting (alert_title,is_alert) VALUES ('$alert_title','1')";
			// pre($insertSql);
			// die();
			$db_connection->query($insertSql);
		}
		echo $response;
	}

    //alert_list_data
	public function alert_list_data()
	{
		// print_r($_POST);
		// die();
		$table_name = $_POST['table'];


		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		$departmentdisplaydata = $this->MasterInformationModel->display_all_records($table_name);
		$departmentdisplaydata = json_decode($departmentdisplaydata, true);
		$i = 1;
		$html = "";
		foreach ($departmentdisplaydata as $key => $value) {
			print_r($value);

			$html .= '<tr>
					<td>
						<input class="checkbox " type="checkbox"  data-delete_id="' . $value['id'] . '">
					</td>';
			$ts = "";
			$ts .= ' <td class="_edit _delete" data-bs-toggle="modal" data-bs-target="#_update" data-edit_id="">
						<div class="d-flex">
						        <span class="fw-medium me-2">' . $value['id'] . '</span>
								<div class="d-flex align-items-center flex-wrap word-break-all flex-fill">
									<span class="col-lg-4 col-md-4 col-sm-6 col-12">' . $value['alert_title'] . '</span>
									<span class="col-lg-4 col-md-4 col-sm-6 col-12">' . $value['alert_name'] . '</span>
									<span class="col-lg-4 col-md-4 col-sm-6 col-12">' . $value['notification'] . '</span>
								</div>
							</div>
						</td> 
						</tr>';
			$html .= $ts;
			$html .= '</tr>';
			$i++;
		}

		if (!empty($html)) {
			echo $html;
		} else {
			echo '<p style="text-align:center;">Data Not Found </p>';
		}
		die();
	}
	//alert insert data
	public function insert_data_alert()
	{

		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;

				$response = $this->MasterInformationModel->insert_entry($insert_data, $table_name);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
			}
		}
	}
    //notification center list data
	public function notification_center_list()
	{
		$table_name = $_POST['table'];
		$username = session_username($_SESSION['username']);
		$first_db = DatabaseSecondConnection();
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		// $notificationdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
		// $notificationdisplaydata = json_decode($notificationdisplaydata, true);
		$search_date = $_POST['search_date'];
		$searchQuery ='';
		if ($search_date) {
			$searchQuery .= ' DATE_FORMAT(created_at, "%d-%m-%Y") LIKE "%' . $search_date . '%"';
		}
		else
		{
			$searchQuery .= ' DATE(`created_at`) = CURRENT_DATE';
		}

		$notificationdisplay = $first_db->query("SELECT * FROM " . $username . "_notification_center WHERE ".$searchQuery);
		$notificationdisplaydata = $notificationdisplay->getResultArray();

		$i = 1;
		$html = "";
		foreach ($notificationdisplaydata as $key => $value) {
			if (isset($value['is_type']) && ($value['is_type'] == 2 || $value['is_type'] == 3)) {
	
				$query = "SELECT t.*,(SELECT s.title FROM " . $username . "_task_status s WHERE s.id=t.status) as taskstatus 
						FROM " . $username . "_tasks t WHERE t.id = " . $value['inquiry_id'];
				$rowdata = $first_db->query($query);
				$result = $rowdata->getResultArray();
				
				$subject = isset($result[0]['subject']) ? $result[0]['subject'] : 'N/A';
				$priority = isset($result[0]['priority']) ? $result[0]['priority'] : 'N/A';
				$taskstatus = isset($result[0]['taskstatus']) ? $result[0]['taskstatus'] : 'N/A';
				$type = '';
				if($value['is_type'] == 3)
				{
					$type='Reminder';
				}
				else if($value['is_type'] == 2)
				{
					$type='Meeting';
				}

				$html .= ' <li class="event-list" style="border-bottom: 3px dashed #f6f6f6;">
				<div class="d-flex">
					<div class="event-timeline-dot me-1 pt-1"> <i class="bx bx-right-arrow-circle font-size-18"
							style="color:#b55dcd"></i> </div>
					<div class="flex-shrink-0 mb-0 pt-2" style="width:10%;">
						<h5 class="user_created_date_css mb-0 text-body me-2" style="font-size: 9px;">' . Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['created_at']))) . '</h5>
					</div>
					<div class="flex-grow-1 follow-grows">
						<div> <i class="bx bx-right-arrow-alt align-middle  text-secondary"></i>
							<span class="text-body fs-12">' . $value['inquiry_id'] . '</span>
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12"> '.$type.' </span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $subject . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $priority . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $taskstatus . '</span> 
						</div>
					</div>
					<div class="ms-auto me-3">';
				  	if($value['status'] == 1){
						$html .= '<p class="green">on</p>';
					} else if($value['status'] == 0){
						$html .= '<p class="red">off</p>';
					}
				  $html .= '</div>
				</div>	
				</a>
				</li>';
			} else {
				$inquiry_details = "";
				if (!empty($value['alert_title'])) {
					$inquiry_type_name = IdToFieldGetData('alert_title', "id=" . $value['alert_title'] . "", "master_alert_setting");
					$inquiry_details = isset($inquiry_type_name['alert_title']) && !empty($inquiry_type_name['alert_title']) ? $inquiry_type_name['alert_title'] : '';
				}
				$sms_detail = "";
				if (!empty($value['sms_template_id'])) {
					$title = IdToFieldGetData('title', "id=" . $value['sms_template_id'] . "",  $username . "_smstemplate");
					$sms_detail = isset($title['title']) && !empty($title['title']) ? $title['title'] : '';
				}
				$email_detail = "";
				if (!empty($value['email_template_id'])) {
					$title = IdToFieldGetData('title', "id=" . $value['email_template_id'] . "",  $username . "_emailtemplate");
					$email_detail = isset($title['title']) && !empty($title['title']) ? $title['title'] : '';
				}
				$whatsapp_detail = "";
				if (!empty($value['whatsapp_template_id'])) {
					$title = IdToFieldGetData('title', "id=" . $value['whatsapp_template_id'] . "",  $username . "_whatsapp_template");
					$whatsapp_detail = isset($title['title']) && !empty($title['title']) ? $title['title'] : '';
				}

				$html .= ' <li class="event-list" style="border-bottom: 3px dashed #f6f6f6;">
				<div class="d-flex">
					<div class="event-timeline-dot me-1 pt-1"> <i class="bx bx-right-arrow-circle font-size-18"
							style="color:#b55dcd"></i> </div>
					<div class="flex-shrink-0 mb-0 pt-2" style="width:10%;">
						<h5 class="user_created_date_css mb-0 text-body me-2" style="font-size: 9px;">' .Utctodate('d-m-Y h:i A', $this->timezone, date('d-m-Y h:i A', strtotime($value['created_at']))) . '</h5>
					</div>
					<div class="flex-grow-1 follow-grows">
						<div> <i class="bx bx-right-arrow-alt align-middle  text-secondary"></i>
							<span class="text-body fs-12">' . $value['inquiry_id'] . '</span>
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $inquiry_details . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $value['is_sms'] . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $sms_detail . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $value['is_email'] . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $email_detail . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $value['is_whatsapp'] . '</span> 
							<i class="bx bx-right-arrow-alt align-middle ms-2 text-secondary"></i>
							<span class="text-body fs-12">' . $whatsapp_detail . '</span> 
						</div>
					</div>
					<div class="ms-auto me-3">';
				  	if($value['status'] == 1){
						$html .= '<p class="green">on</p>';
					} else if($value['status'] == 0){
						$html .= '<p class="red">off</p>';
					}
				  $html .= '</div>
				</div>	
				</a>
				</li>';
			}
			$i++;
		}

		if (!empty($html)) {
			echo $html;
		} else {
			echo '<p style="text-align:center;">Data Not Found</p>';
		}
		die();
	}
	//product purchase list data
	public function stockin_export_data()
	{
		// pre($_POST);
		// die();
		$action = $this->request->getPost('action');
		$table = $this->request->getPost('table');
		$table_name = $this->username . '_' . $table;
		$username = $_SESSION['username'];
		$ids = $this->request->getPost('checkbox_value');
		// pre($ids);
		// die();
		$i = 1;
		$html = "";
		if (!empty($ids)) {
			$projectdisplaydata = get_table_array_helper($this->username . '_product_purchase');
			// pre($projectdisplaydata);
			$lineData = array();
			foreach ($projectdisplaydata as $key => $value) {
				$list_id = $value[array_key_first($value)];
				$allow_user = 0;
				$stock_type = "";
				if (!empty($value['stock'])) {
					$name = IdToFieldGetData('type', "id=" . $value['stock'] . "",  $username . "_product_type");
					$stock_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				}
				$added_by = "";
				if (!empty($value['added_by'])) {
					$name = IdToFieldGetData('firstname', "id=" . $value['added_by'] . "",  $username . "_user");
					$added_by = isset($name['firstname']) && !empty($name['firstname']) ? $name['firstname'] : '';
				}
				if (in_array($list_id, $ids)) { // Check if the $list_id is in the selected IDs
					$allow_user = 0;
					$lineData[] = array(
						'stock' => $stock_type,
						'quantity' => $value['quantity'],
						'date_time' => $value['date_time'],
						'purchase_amount' => $value['purchase_amount'],
						'GST_amount' => $value['GST_amount'],
						'selling_amount' => $value['selling_amount'],
						'added_by' => $added_by,
					);
				}
			}

			$return_array['export_data'] = $lineData;
		} else {
			$return_array['msg'] = 'Data Not Available';
		}

		// pre($return_array);
		echo json_encode($return_array);
		exit;
		die();
	}
	//product sell export data
	public function stockout_export_data()
	{
		// pre($_POST);
		// die();
		$action = $this->request->getPost('action');
		$table = $this->request->getPost('table');
		$table_name = $this->username . '_' . $table;
		$username = $_SESSION['username'];
		$ids = $this->request->getPost('checkbox_value');
		// pre($ids);
		// die();
		$i = 1;
		$html = "";
		
		if (!empty($ids)) {
			$prodisplaydata = get_table_array_helper($this->username . '_booking');
			// pre($prodisplaydata);

			$lineData = array();
			foreach ($prodisplaydata as $key => $value) {
				$list_id = $value[array_key_first($value)];
				$allow_user = 0;
					if (in_array($list_id, $ids)) { // Check if the $list_id is in the selected IDs
						$allow_user = 0;
						$itms = $value['sell_items'];
						
						$decoded_items = json_decode($itms, true);
						foreach ($decoded_items as $item) {
							$int_product = "";
						if (isset ($item['int_productt']) && !empty( $item['int_productt'])) {
							$product_name = IdToFieldGetData('type', "id=" .  $item['int_productt'] . "", $username . '_product_type');
							$int_product = isset($product_name['type']) && !empty($product_name['type']) ? $product_name['type'] : '';
						}
							$lineData[] = array(
								'partyname' => $value['partyname'],
								'items' => $int_product,
								'product_qty' => $item['product_qty'], 
								'unit_price' => $item['unit_price'] ,
								
							);
					} 
				}
			}

			$return_array['export_data'] = $lineData;

		} else {
			$return_array['msg'] = 'Data Not Available';
		}
		
		// pre($return_array);
		echo json_encode($return_array);
		exit;
		die();

	}

	//return export data
	public function return_export_data()
	{
		// pre($_POST);
		// die();
		$action = $this->request->getPost('action');
		$table = $this->request->getPost('table');
		$table_name = $this->username . '_' . $table;
		$username = $_SESSION['username'];
		$ids = $this->request->getPost('checkbox_value');
		// pre($ids);
		// die();
		$i = 1;
		$html = "";
		if (!empty($ids)) {
			$projectdisplaydata = get_table_array_helper($this->username . '_return_stock');
			$lineData = array();
			foreach ($projectdisplaydata as $key => $value) {
				$list_id = $value[array_key_first($value)];
				$allow_user = 0;
				// $stock_type = "";
				// if (!empty($value[''])) {
				// 	$name = IdToFieldGetData('type', "id=" . $value['stock'] . "",  $username . "_product_type");
				// 	$stock_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				// }
				$stock_type = "";
				if (!empty($value['product_name'])) {
					$title = IdToFieldGetData('type', "id=" . $value['product_name'] . "", $username . "_product_type");
					$stock_type = isset($title['type']) && !empty($title['type']) ? $title['type'] : '';
				}
				$val_name = "";
				if (!empty($value['product_name'])) {
					$title = IdToFieldGetData('product_type', "id=" . $value['product_name'] . "",$username . "_product_type");
					$val_name = isset($title['product_type']) && !empty($title['product_type']) ? $title['product_type'] : '';
				}
				$added_by = "";
				if (!empty($value['added_by'])) {
					$name = IdToFieldGetData('firstname', "id=" . $value['added_by'] . "",  $username . "_user");
					$added_by = isset($name['firstname']) && !empty($name['firstname']) ? $name['firstname'] : '';
				}
				if (in_array($list_id, $ids)) { // Check if the $list_id is in the selected IDs
					$allow_user = 0;
					$lineData[] = array(
						'stock' => $stock_type,
						'type' =>$val_name,
						'stock_quantity' => $value['stock_quantity'],
						'amount' => $value['amount'],
						'datetime_return' => $value['datetime_return'],
						'added_by' => $added_by,
					);
				}
			}

			$return_array['export_data'] = $lineData;
		} else {
			$return_array['msg'] = 'Data Not Available';
		}

		// pre($return_array);
		echo json_encode($return_array);
		exit;
		die();
	}
}
