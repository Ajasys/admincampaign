<?php
namespace App\Controllers;

use App\Models\MasterInformationModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DateTimeZone;

class DatamoduleController extends BaseController
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
    public function duplicate_data_check_mobile_and_extra_data($tablename ,$find_Data = array() ){
		$this->db = DatabaseDefaultConnection();
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
    public function get_data_header_by_file()
    {
        $return_array = array();
        $html = '';
        $btn_html = '';

        if (isset($_FILES['import_file'])) {
            if ($_FILES['import_file']['error'] === UPLOAD_ERR_OK) {
                $db_connection = DatabaseDefaultConnection();
                $tmpFilePath = $_FILES['import_file']['tmp_name'];
                $spreadsheet = IOFactory::load($tmpFilePath); // Load the uploaded Excel file
                $worksheet = $spreadsheet->getActiveSheet();
                $highestColumn = $worksheet->getHighestColumn();
                $headerRow = $worksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, false);
                $query = $db_connection->table($this->username . '_all_inquiry')->get();
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

    public function import_file_data()
    {
        // pre($_FILES);
        // pre($_POST);

        if (isset($_FILES['import_file'])) {
            if ($_FILES['import_file']['error'] === UPLOAD_ERR_OK) {
                $db_connection = DatabaseDefaultConnection();
                $tmpFilePath = $_FILES['import_file']['tmp_name'];
                $spreadsheet = IOFactory::load($tmpFilePath); // Load the uploaded Excel file
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                // foreach ($rows as $row) {
                $new_column = array();
                $post_data = $_POST;
                // pre($_POST);
                // die();
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
                $table_names = $this->username . '_data';
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
                                                $checkduplicate = $this->duplicate_data_check_mobile_and_extra_data($this->username . '_data', $duplicate_data_cols);
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

    public function livesearch(){
        $xmlDoc=new DOMDocument();
        $xmlDoc->load("links.xml");

        $x=$xmlDoc->getElementsByTagName('link');

        //get the q parameter from URL
        $q=$_GET["q"];

        //lookup all links from the xml file if length of q>0
        if (strlen($q)>0) {
        $hint="";
        for($i=0; $i<($x->length); $i++) {
            $y=$x->item($i)->getElementsByTagName('title');
            $z=$x->item($i)->getElementsByTagName('url');
            if ($y->item(0)->nodeType==1) {
            //find a link matching the search text
            if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
                if ($hint=="") {
                $hint="<a href='" .
                $z->item(0)->childNodes->item(0)->nodeValue .
                "' target='_blank'>" .
                $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
                } else {
                $hint=$hint . "<br /><a href='" .
                $z->item(0)->childNodes->item(0)->nodeValue .
                "' target='_blank'>" .
                $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
                }
            }
            }
        }
        }

        // Set output to "no suggestion" if no hint was found
        // or to the correct values
        if ($hint=="") {
        $response="no suggestion";
        } else {
        $response=$hint;
        }

        //output the response
        echo $response;
    }

    public function data_module_list_data()
    {
        // pre("fdfdfd");
        // die();
        $table_name = 'all_inquiry';
        $delete_status = '0';
        $html = "";
        $row_count_html = '';
        $return_array = array(
            'row_count_html' => '',
            'html' => '',
            'total_page' => 0,
            'response' => 0
        );
        //$allow_data = json_decode($_POST['show_array']);
        //$status = get_table_array_helper('master_inquiry_status');
        // $get_roll_id_to_roll_duty_var = get_roll_id_to_roll_duty();
        $db_connection = DatabaseDefaultConnection();
        $user_id = 1;
        if (!$this->admin == 1) {
            $user_id = $_SESSION['id'];
        }
        $status = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "";
        $perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
        $pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
        $ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
        $which_result = isset($_POST['follow_up_day']) && !empty($_POST['follow_up_day']) ? $_POST['follow_up_day'] : '';
        $not_valid_status = '"0"';
        $getchild = '';
        $getchild = getChildIds($_SESSION['id']);
        $stutus_data_html = "";
        $return_array['stutus_data_allow'] = 0;
        $cnr_query = '';
        if ($status == 17) {
            $cnr_query .= ' AND inquiry_cnr >= 1';
            $datastatus = "'1','2','3','4','6','7','9','10','11','12','13','17'";
            $datastatuss = "'1','2','3','4','6','9','10','11','13','17'";
        }
        $action = $_POST['action'];
        $ajaxsearch_query = '';
        $ajaxsearch_query_tab = '';
        $_f_asss_id = '';
        $total_inq_count = 0;
        $cnr_status_value = '17';
        $cnr_count = 0; // Initialize $cnr_count here

        $data_table = $this->username.'_data';
        if ($action == "filter") {
			// pre($_POST);
			// die();
			unset($_POST['action']);
			unset($_POST['perPageCount']);
			unset($_POST['pageNumber']);
			unset($_POST['datastatus']);
			unset($_POST['follow_up_day']);
			unset($_POST['action1']);
			foreach ($_POST as $k => $v) {
                if(!empty($v)){

                    $column_name =  str_replace('f_','', $k);
                    $ajaxsearch_query .= ' AND '.$column_name.' LIKE "%' . $v . '%"';
                }
			}
			$getStatusWiseData = getStatusWiseData($which_result,$_f_asss_id,$ajaxsearch_query_tab);	
            $sql = "SELECT * FROM $data_table WHERE 1 $ajaxsearch_query";
		} else {
            $sql = "SELECT * FROM $data_table";
        }
        //  pre($sql);
        $main_sql = $sql;
        $return_array['stutus_data_allow'] = 1;
        // pre($sql);
        $result = $db_connection->query($sql);
        if ($result->getNumRows() > 0) {
            $rowCount = $result->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;
            $pagesCount = ceil($rowCount / $perPageCount);
            $lowerLimit = ($pageNumber - 1) * $perPageCount;
            $sqlQuery = $main_sql . " ORDER BY `id` DESC LIMIT $lowerLimit , $perPageCount";
            $Getresult = $db_connection->query($sqlQuery);
            $inquiry_all_data = $Getresult->getResultArray();
            $rowCount_child = $Getresult->getNumRows();
            $start_entries = $lowerLimit + 1;
            $last_entries = $start_entries + $rowCount_child - 1;
            $row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
            $i = 1;
            $loop_break = 0;
            $query = $db_connection->table($this->username . '_data')->get();
            if ($query->getNumRows() > 0) {
                $columnNames = $query->getFieldNames();
            } else {
                $columnNames = array();
            }
            $html .= '<thead>
                            <tr>';
            foreach($columnNames as $columnName) {
                $html .= '<th>'.$columnName.'</th>';
            }
            $html .= '</tr>
                        </thead>';
            $html .= '<tbody>';
            foreach ($inquiry_all_data as $key => $value) {
                // html code hear 
                $html .= '<tr>';
                foreach($value as $r_key => $r_value) {
                    $html .= '<td>'.$r_value.'</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $return_array['stutus_data_html'] = $stutus_data_html;
            $return_array['row_count_html'] = $row_count_html;
            $return_array['html'] = $html;
            $return_array['total_page'] = $pagesCount;
            $return_array['response'] = 1;
        } else {
            $return_array['stutus_data_html'] = $stutus_data_html;
            $return_array['row_count_html'] = "Page 0 of 0";
            $return_array['total_page'] = 0;
            $return_array['response'] = 1;
            $return_array['html'] = '<tr><td></td><td class="text-center">Data Not Found </td></tr>';
        }
        echo json_encode($return_array);
        die();
    }


}
