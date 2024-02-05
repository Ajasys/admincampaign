<?php



namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use CodeIgniter\I18n\Time;
use DateTime;
use DateTimeZone;


class AudianceController extends BaseController
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
   
		public function audience_list_data()
		{
       
            $table_name = $_POST['table'];
            $username = session_username($_SESSION['username']);
            $action = $_POST['action'];
            $i = 1;
            $html = "";
            // $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
            // $departmentdisplaydata = json_decode($departmentdisplaydata, true);
            $secondDb = \Config\Database::connect('second');
            $qry = "SELECT * FROM `admin_all_inquiry` WHERE `inquiry_status` = 13";
            $result = $secondDb->query($qry);
            $departmentdisplaydata = $result->getResultArray();
            // pre($location_result);
            foreach ($departmentdisplaydata as $key => $value) {
        
                $ts = "";
                $ts .= '<tr class="audiance_view audiance_show_data" data-view_id="' . $value['id'] . '">
				    <td><input class="check_box table_list_check" type="checkbox" value="' . $value['id'] . '"/></td>
                    <td class="p-2 text-nowrap"> ' . $value['full_name'] . '</td>
                    <td class="p-2 text-nowrap">' . $value['user_id'] . '</td>
                    <td class="p-2 text-nowrap">2000 - 3000</td>
					<td class="p-2 text-nowrap">' . $value['user_id'] . '</td>
					<td class="p-2 text-nowrap"> ' . $value['created_at'] . '</td>
                    
                   ';
                $ts .= '</tr>';
                $html .= $ts;
                $i++;
            }
          
            if (!empty($html)) {
                echo $html;
            } else {
                echo '<p style="text-align:center;">Data Not Found </p>';
            }
        }

		public function audience_show_data()
		{
			$table_name = $_POST['table'];
			$username = session_username($_SESSION['username']);
			$action = $_POST['action'];
			$FilterStock = $_POST['FilterStock'];
			$selectedAudienceType = $_POST['show_array']; 
			$i = 1;
			$html = "";
			
			$secondDb = \Config\Database::connect('second');
			$builder = $secondDb->table('admin_all_inquiry');

			$FilterStockArray = explode(',', $FilterStock);
			$builder->whereIn('intrested_product', $FilterStockArray);

			if ($selectedAudienceType == '1') {
				$builder->where('lead_list', 1);
			} else if ($selectedAudienceType == '2') {
				$builder->where('qualified', 1);
			} else if ($selectedAudienceType == '3') {
				$builder->where('prospect', 1);
			} else if ($selectedAudienceType == '4') {
				$builder->where('contacted', 1);
			} else if ($selectedAudienceType == '5') {
				$builder->where('block_list', 1);
			}

			$result = $builder->get();
			$departmentdisplaydata = $result->getResultArray();

			foreach ($departmentdisplaydata as $key => $value) {
				$ts = '<tr class="audiance_view" data-view_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#lead_list_modal">
					<td class="p-2 text-nowrap">' . $value['created_at'] . '</td>
					<td class="p-2 text-nowrap">' . $value['user_id'] . '</td>
					<td class="p-2 text-nowrap">' . $value['full_name'] . '</td>
					<td class="p-2 text-nowrap">' . $value['mobileno'] . '</td>
					<td class="p-2 text-nowrap">' . $value['intrested_product'] . '</td>
					<td class="p-2 text-nowrap">' . $value['inquiry_type'] . '</td>
				</tr>';
				$html .= $ts;
				$i++;
			}

			if (!empty($html)) {
				echo $html;
			} else {
				echo '<p style="text-align:center;">Data Not Found </p>';
			}
		}
		public function audience_insert_data()
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



    // View Data Code Start  ===========================================================================>
    public function audience_view_data()
    {
        if ($this->request->getPost("action") == "view") {
            $view_id = $this->request->getPost('view_id');
            $table = $_POST['table'];
            $table_name = $this->username.'_'.$table;
            $userEditdata = $this->MasterInformationModel->edit_entry2($table_name, $view_id);
            return json_encode($userEditdata, true);
        }
        die();
    }
}
?>