<?php



namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
    public function duplicate_data_check_mobile_and_extra_data($tablename ,$find_Data = array() ){
		$this->db = \Config\Database::connect('second');
		$array['response'] = 0;
		$result = $this->db->table($tablename)->where($find_Data)->get();
		if($result->getNumRows() > 0){
			$booking_count = $result->getNumRows();
			$result_array = $result->getResultArray()[0];
			$array['result_array'] = $result_array;
			$array['booking_count'] = $booking_count;
			$array['response'] = 1;
		}else if($result->getNumRows() == 0){
			$array['response'] = 2;
		}
		return $array;
	}
    public function audience_list_data()
    {
        $table_name = $_POST['table'];
        $username = session_username($_SESSION['username']);
        $action = $_POST['action'];
        $i = 1;
        $html = "";
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($username . "_" . $table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);

        $previousValues = array();
        foreach ($departmentdisplaydata as $key => $value) {
            // pre($value);
            if (
                isset($previousValues['product_name']) &&
                $previousValues['product_name'] == $value['product_name'] &&
                isset($previousValues['inquiry_status']) &&
                $previousValues['inquiry_status'] == $value['inquiry_status'] &&
                isset($previousValues['retansion']) &&
                $previousValues['retansion'] == $value['retansion'] &&
                isset($previousValues['source']) &&
                $previousValues['source'] == $value['source']
            ) {
                continue;
            }

            $ts = "";
            $ts .= '<tr class="audiance_view audiance_show_data" data-view_id="' . $value['id'] . '">
                        <td><input class="check_box table_list_check" type="checkbox" value="' . $value['id'] . '"/></td>
                        <td class="p-2 text-nowrap"> ' . $value['product_name'] . '</td>
                        <td class="p-2 text-nowrap">' . $value['source'] . '</td>
                        <td class="p-2 text-nowrap"></td>
                        <td class="p-2 text-nowrap"></td>
                        <td class="p-2 text-nowrap"> ' . $value['created_at'] . '</td>
                    ';
            $ts .= '</tr>';
            $html .= $ts;
            $previousValues = array(
                'product_name' => $value['product_name'],
                'inquiry_status' => $value['inquiry_status'],
                'retansion' => $value['retansion'],
                'source' => $value['source']
            );

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
            $username = session_username($_SESSION['username']);
            $action_name = $this->request->getPost("action");

            if ($action_name == "insert") {
                unset($_POST['action']);
                unset($_POST['table']);

                if (!empty($_POST)) {
                    $insert_data = $_POST;
                    $intrested_product = $_POST['intrested_product'];
                    $inquiry_status = $_POST['inquiry_status'];
                    $product_name = $_POST['product_name'];
                    $source = $_POST['source'];
                    
                    // Set a default retention value if not provided
                    $retention_days = isset($_POST['retansion']) ? $_POST['retansion'] : 0;

                    $retention_date = date('Y-m-d H:i:s', strtotime("-$retention_days days"));

                    // Connect to the 'second' database
                    $secondDb = \Config\Database::connect('second');

                    // Query to retrieve data from admin_all_inquiry with a retention period
                    $qry = "SELECT full_name, inquiry_status, intrested_product, mobileno, email, address FROM `admin_all_inquiry` WHERE intrested_product = ? AND inquiry_status = ? AND created_at >= ?";

                    // Pass placeholders as an associative array
                    $result = $secondDb->query($qry, [$intrested_product, $inquiry_status, $retention_date]);

                    // Check if there are results
                    if ($result->getNumRows() > 0) {
                        $departmentdisplaydata = $result->getResultArray();

                        // Insert the retrieved data along with the insert_data into the audience table
                        $audience_table_name = $username . "_audiences";

                        // Merge $insert_data with each row in $departmentdisplaydata
                        foreach ($departmentdisplaydata as &$row) {
                            $row = array_merge($row, $insert_data, ['retansion' => $retention_days, 'source' => $source, 'product_name' => $product_name]);
                        }

                        // Insert merged data into the audience table
                        $this->MasterInformationModel->insert_entry3($departmentdisplaydata, $audience_table_name);

                        // Retrieve and display all records from the original table
                        $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($username . "_" . $table_name);
                        $departmentdisplaydata = json_decode($departmentdisplaydata, true);
                    }
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

    public function get_data_header_by_file_audience()
    {
        $return_array = array();
        $html = '';
        $btn_html = '';

        if (isset($_FILES['import_file'])) {
            if ($_FILES['import_file']['error'] === UPLOAD_ERR_OK) {
                $db_connection = \Config\Database::connect('second');
                $tmpFilePath = $_FILES['import_file']['tmp_name'];
                $spreadsheet = IOFactory::load($tmpFilePath); // Load the uploaded Excel file
                $worksheet = $spreadsheet->getActiveSheet();
                $highestColumn = $worksheet->getHighestColumn();
                $headerRow = $worksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, false);
                $query = $db_connection->table($this->username . '_audiences')->get();
                if ($query->getNumRows() > 0) {
                    $columnNames = $query->getFieldNames();
                } else {
                    $columnNames = array();
                }
                $btn_html .= '<button class="btn-primary add" type="button" data-bs-toggle="modal" data-bs-target="#column_add_form" aria-controls="column_add_form">
                                + Add Column
                            </button>';
                // pre($columnNames);
                $html .= '<div class="col-12 d-sm-flex d-none flex-wrap mb-2">
                                <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 text-center">
                                    <span class="fs-6">From</span>
                                </div>
                                <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 text-center">
                                    <span class="fs-6">to</span>
                                </div>
                            </div>';
                $i = 0;
                foreach ($headerRow[0] as $value) {
                    if ($value != '') {
                        $noSpaces_value = preg_replace('/\s+/', '', $value);
                        $html .= '<div class="col-12 d-flex flex-wrap mb-2">
                            <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1">
                                <input type="text" class="form-control main-control" id="' . $noSpaces_value . '_file" name="" placeholder="File Column name" value="' . $noSpaces_value . '" readonly required>
                            </div>
                            <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">
                                <span class="mx-auto col-1">to</span>
                                <div class="main-selectpicker col-11 dropdown">
                                    <input type="text" id="list" class="form-control list main-control dropdown-toggle file_columns_input" data-bs-toggle="dropdown" aria-expanded="false"  name="'.$i.'" id="' . $noSpaces_value . '" placeholder="'.$noSpaces_value.'">
                                    <ul class="dropdown-menu dropdown-menu-end w-100 column_list" id="column_list">';
                                    foreach ($columnNames as $columnName) {
                                        if (!preg_match("/id/", $columnName) && !preg_match("/date/", $columnName) && !preg_match("/status/", $columnName) && !preg_match("/type/", $columnName) && !preg_match("/amount/", $columnName) && !preg_match("/inquiry/", $columnName) && !preg_match("/buy/", $columnName) && !preg_match("/pay/", $columnName) && !preg_match("/created/", $columnName) && !preg_match("/head/", $columnName) && !preg_match("/unit/", $columnName) && !preg_match("/follow/", $columnName) && !preg_match("/is/", $columnName) && !preg_match("/tooltip/", $columnName) && !preg_match("/site_/", $columnName) && !preg_match("/area_/", $columnName) ) {
                                            $html .= '<li><button class="dropdown-item list_item" type="button"><span>'.$columnName.'</span></button></li>';
                                        }
                                    }
                                    $html .= '</ul>
                                </div>
                            </div>
                        </div>';
                        $i++;
                    }
                }
            } else {
                $html = 'File upload error. Error code: ' . $_FILES['import_file']['error'];
            }
        }

        $return_array['html'] = $html;
        $return_array['btn_html'] = $btn_html;
        return json_encode($return_array, JSON_FORCE_OBJECT);
    }

    public function import_file_data_audience()
    {
        // pre($_POST);
        $product_name = $_POST['product_name'];
        $source = $_POST['source'];
        if (isset($_FILES['import_file'])) {
            if ($_FILES['import_file']['error'] === UPLOAD_ERR_OK) {
                $db_connection = \Config\Database::connect('second');
                $tmpFilePath = $_FILES['import_file']['tmp_name'];
                $spreadsheet = IOFactory::load($tmpFilePath); // Load the uploaded Excel file
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                // foreach ($rows as $row) {
                $new_column = array();
                unset($_POST['product_name']);
                unset($_POST['source']);
                $post_data = $_POST;
                $num_col = 1;
                $export_data = array();
                $header_export_data = array();
                $custome_column = '';
                $custome_column_value = array();
                $new_column[0] = 'id int primary key AUTO_INCREMENT';
                foreach ($post_data as $key => $value) {
                    if(!empty($value) && !preg_match("/_value/", $key)){
                        $new_column[$num_col] = $value . ' varchar(255)';
                        $num_col++;
                        $header_export_data[] = $value;
                        if(preg_match("/_col/", $key)){
                            $custome_column = $value;
                        }

                    }
                    if(preg_match("/_value/", $key)){
                        $custome_column_value[$custome_column] = $value;
                    }
                }
                // pre($custome_column);
                // pre($new_column);
                // die();
                $export_data[] = $header_export_data;
                $result = array();
                $duplicate_data_count = 0;
                $none_duplicate_data_count = 0;
                $duplicate_data = 0;
                $table_names = $this->username . '_audiences';
                $table_check = tableCreateAndTableUpdate2($table_names, '', $new_column);
                // pre($table_check);

                if (isset($rows) && !empty($rows)) {
                    foreach ($rows as $row_key => $row_value) {
                        $row_value = preg_replace('/\s+/', '', $row_value);
                        if ($row_key != 0) {
                            $insert_data = array();
                            $final_insert_data = array();
                            $num_col = 0; // Initialize the column count for each row
                            $duplicate_check = 0; // Initialize duplicate check for each row
                            
                            foreach ($row_value as $value_key => $value_value) {
                                $value_key += 1;
                                
                                foreach ($post_data as $key => $value) {
                                    if (!empty($value) && !preg_match("/_value/", $key) && !preg_match("/_col/", $key)) {
                                        $key += 1;
                                        if ($key == $value_key) {
                                            $checkduplicate = 0;
                                            
                                            if (preg_match("/mobile/", $value) || preg_match("/phone/", $value)) {
                                                $duplicate_data_cols = array();
                                                $check_mobile = 1;
                                                $mobile_nffo_remove = str_replace(" ", "", $value_value);
                                                $mobile_nffo = substr($mobile_nffo_remove, -10);

                                                $duplicate_data_cols[$value] = $mobile_nffo;
                                                $checkduplicate = $this->duplicate_data_check_mobile_and_extra_data($this->username . '_audiences', $duplicate_data_cols);
                                                if($checkduplicate['response'] == 1){
                                                    $duplicate_data = 1;
                                                    $duplicate_data_count++;
                                                } else {
                                                    $duplicate_data = 0;
                                                }
                                                // Use $last_10_digits in place of $value_value
                                                if ($checkduplicate != 1 && preg_match('/^\d{10}$/', $mobile_nffo)) {
                                                    $insert_data[$value] = $mobile_nffo;
                                                } else {
                                                    $insert_data[$value] = $value_value;
                                                }
                                                // pre($value_value);
                                            } else {
                                                $insert_data[$value] = $value_value;
                                            }
                                            $insert_data['product_name'] = $product_name;
                                            $insert_data['source'] = $source;
                                            $num_col++;
                                            $duplicate_check = 1;
                                            // }
                                        }
                                    }
                                }
                            }
                            // return $insert_data;
                            if ($duplicate_data != 1) {
                                // Insert the data only if it's not a duplicate
                                $final_insert_data = array_merge($insert_data,$custome_column_value);
                                // pre($final_insert_data);
                                $insert = $this->MasterInformationModel->insert_entry2($final_insert_data, $table_names);
                                $none_duplicate_data_count++;
                            } else {
                                $export_data[] = $insert_data;
                            }
                        }
                    }
                }
                // die();
                
                if($none_duplicate_data_count > 0 && $duplicate_data_count > 0){
                    $result['import_data'] = $none_duplicate_data_count;
                    $result['csv_data'] = $duplicate_data_count;
                    $result['export_data'] = $export_data;
                    $result['response'] = 1;
                    $result['msg'] = 'Data Inserted and '.$duplicate_data_count.' Duplicate Data Found';
                } if($duplicate_data_count > 0){
                    $result['import_data'] = $none_duplicate_data_count;
                    $result['csv_data'] = $duplicate_data_count;
                    $result['export_data'] = $export_data;
                    $result['response'] = 0;
                    $result['msg'] = ''.$duplicate_data_count.' Duplicate Data Found';
                } else {
                    $result['response'] = 1;
                    $result['msg'] = 'Data Inserted Success';
                }

                return json_encode($result);
            }
        }
    }
}
?>