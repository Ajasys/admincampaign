<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class CommonController extends BaseController
{

	public function __construct()
	{
		session();
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
	public function delete_all_inq()
	{
	 // pre($this->admin);
	 // die();
		if ($this->request->getPost('checkbox_value')) {
			$ids = $this->request->getPost('checkbox_value');
			$table_name = $this->request->getPost('table');
			$final_table_name = $this->username.'_'.$table_name;
			if($this->admin == 1){
				$username = $_SESSION['name'];
				$user_id = 1;
			} else {
				$username = $_SESSION['firstname'];
				$user_id = $_SESSION['id'];
			}
			if (!empty($ids)) {
				$db = \Config\Database::connect('second');
				$all = implode(",", $ids);
				$find_Array_all = "DELETE FROM $final_table_name WHERE id IN ($all)";
				$db->query($find_Array_all);
				if($table_name == 'all_inquiry'){
					foreach($ids as $key => $val){
						$inquiry_log_data = array(
							'inquiry_id' => $val,
							'inquiry_log' => $val.' Inquiry is Deleted By '. $username,
							'user_id' => $user_id,
							'created_at' =>Utctime('Y-m-d H:i:s',$this->timezone,  date("Y-m-d H:i:s")) ,
						);
						$sql2 = $this->MasterInformationModel->insert_entry2($inquiry_log_data,'admin_inquiry_log');
					}
				}
			}
		}
	   }

    public function delete_all()
	{
		if ($this->request->getPost('checkbox_value')) {
			$ids = $this->request->getPost('checkbox_value');
			$table_name = $this->request->getPost('table');
            $final_table_name = $table_name;

			if($this->admin == 1){
				$username = $_SESSION['name'];
				$user_id = 0;
			} else {
				$username = $_SESSION['firstname'];
				$user_id = $_SESSION['id'];
			}

			// pre($ids);
			// die();

			if (!empty($ids)) {
				$db = \Config\Database::connect('second');
				$all = implode(",", $ids);
				$find_Array_all = "DELETE FROM $final_table_name WHERE id IN ($all)";
				$db->query($find_Array_all);

				if($table_name == 'admin_all_inquiry'){
					foreach($ids as $key => $val){
						$inquiry_log_data = array(
							'inquiry_id' => $val,
							'inquiry_log' => $val.' Inquiry is Deleted By '. $username,
							'user_id' => $user_id,
						);
						$sql2 = $this->MasterInformationModel->insert_entry2($inquiry_log_data,$this->username.'_inquiry_log');
					}
				}
			}

		}
   }
	

}