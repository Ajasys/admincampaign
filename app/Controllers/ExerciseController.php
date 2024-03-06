<?php
namespace App\Controllers;
use App\Models\MasterInformationModel;
class ExerciseController extends BaseController
{
    protected $db;

    public function __construct()
    {
        helper('custom');
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        // $this->username = session_username($_SESSION['username']);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        $this->timezone = "";
    }


    public function duplicate_data2($data, $table)
	{
		$this->db = DatabaseDefaultConnection();
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
		$result = $this->db->query($sql);
		if ($result->getNumRows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

    
    public function excercise_insert_data()
	{
		$db = DatabaseSecondConnection();
		$Sdb = DatabaseDefaultConnection();

		$table_username = getMasterUsername();
		$selectedId = $this->request->getPost('id');
		$newName = '';
		if (!empty($selectedId)) {
			$sql = "SELECT e_type FROM master_exercise_sub_type WHERE id = id";
			$result = $Sdb->query($sql);
			$resultsssss = $result->getResultArray();
		}
		foreach ($resultsssss as $key => $result_value) {
		}
		$imgfile = "";
		$data = array();
		$files = $_FILES;
		$fileName = '';
		if (!empty($files)) {
			$uploadDir = 'assets/images/food_type/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			$filesArr = $_FILES["images"];
			$fileNames = array_filter($filesArr['name']);
			$uploadedFile = '';
			foreach ($filesArr['name'] as $key => $val) {
				$fileName = basename($filesArr['name'][$key]);
				$targetFilePath = $uploadDir . $fileName;
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
				if (in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif')) && $filesArr["size"][$key] > 1048576) {
					$compressedImage = compressImage($filesArr["tmp_name"][$key]);
					if ($compressedImage !== false) {
						$targetFilePath = $uploadDir . $fileName;
						if (file_put_contents($targetFilePath, $compressedImage)) {
							$uploadedFile .= $fileName . ',';
						} else {
							$uploadStatus = 0;
							$response['message'] = 'Error while saving the compressed image.';
						}
					} else {
						$uploadStatus = 0;
						$response['message'] = 'Error while compressing the image.';
					}
				} else {
					if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
						$uploadedFile .= $fileName . ',';
					} else {
						$uploadStatus = 0;
						$response['message'] = 'Sorry, there was an error uploading your file.';
					}
				}
			}
		}

		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			unset($_POST['id']);
			if (!empty($_POST)) {
				$insert_data = $_POST;
				if ($fileName != '') {
					$insert_data['e_image'] = $fileName;
				}
				$insert_data['e_type'] = $result_value['e_type'];
				$isduplicate = $this->duplicate_data2($insert_data, $table_name);
				if ($isduplicate == 0) {
					$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
					$excercisedisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$excercisedisplaydata = json_decode($excercisedisplaydata, true);
				} else {
					return "error";
				}
			}
		}
		die();
	}

    public function excercise_update_data()
	{ 
        // pre($_FILES);
        // die();
		$db_connection = DatabaseDefaultConnection();
        $FFFnmbnver = '';

        if($_POST['e_subtype'] == ''){
            if($_POST['requestsubtype'] != ''){
                if($_POST['requesttype'] != ''){
                    if(intval($_POST['requesttype']) > 0){
                        $InsertSubTypeData['e_subtype'] = $_POST['requesttype'];
                        $InsertSubTypeData['e_type'] = $_POST['requestsubtype'];
                        $this->MasterInformationModel->insert_entry2($InsertSubTypeData, 'master_exercise_sub_type');
                        $lastInsertID1 = $db_connection->insertID();
                        // pre("lastInsertID1 ".$lastInsertID1);
                        $FFFnmbnver = $lastInsertID1;
                        
                    }else{
                        $InsertTypeData['e_type'] = $_POST['requesttype'];
                        $this->MasterInformationModel->insert_entry2($InsertTypeData, 'master_exercise_type');
                        $lastInsertID2 = $db_connection->insertID();
                        $InsertSubTypeData['e_subtype'] = $lastInsertID2;
                        $InsertSubTypeData['e_type'] = $_POST['requestsubtype'];
                        $this->MasterInformationModel->insert_entry2($InsertSubTypeData, 'master_exercise_sub_type');
                        $lastInsertID3 = $db_connection->insertID();
                        $FFFnmbnver = $lastInsertID3;
                    }
                }
            }
        }else{
            if(intval($_POST['e_subtype']) > 0){
                $FFFnmbnver = $_POST['e_subtype'];
            }
        }
		$imgfile = "";
		$data = array();
		$newName = "";
		$fileName = '';
		$files = $_FILES;
        if (!empty($files)) {
			$uploadDir = 'assets/images/food_type/';

			$string = $_SERVER['DOCUMENT_ROOT'];
			$substring = 'rudrramc';
			if (strpos($string, $substring) !== false) {
				$uploadDir = '/home/rudrramc/admin.ajasys.com/assets/ExercisePhotos/';
			} else {
				$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/admin/assets/ExercisePhotos/';
			}
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}

			$filesArr = $_FILES["images"];
			$fileNames = array_filter($filesArr['name']);
			$uploadedFile = '';
			foreach ($filesArr['name'] as $key => $val) {
				$fileName = basename($filesArr['name'][$key]);
				$targetFilePath = $uploadDir . $fileName;
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
				if (in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif')) && $filesArr["size"][$key] > 1048576) {
					$compressedImage = compressImage($filesArr["tmp_name"][$key]);
					if ($compressedImage !== false) {
						$targetFilePath = $uploadDir . $fileName;
						if (file_put_contents($targetFilePath, $compressedImage)) {
							$uploadedFile .= $fileName . ',';
						} else {
							$uploadStatus = 0;
							$response['message'] = 'Error while saving the compressed image.';
						}
					} else {
						$uploadStatus = 0;
						$response['message'] = 'Error while compressing the image.';
					}
				} else {
					if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
						$uploadedFile .= $fileName . ',';
					} else {
						$uploadStatus = 0;
						$response['message'] = 'Sorry, there was an error uploading your file.';
					}
				}
			}
		}
        if ($fileName != '') {
            $InsertFData['e_image'] = $fileName;
        }

        $InsertFData['e_name'] = $_POST['e_name'];
        $InsertFData['e_type'] = $FFFnmbnver;
        $InsertFData['e_subtype'] = $FFFnmbnver;
        $InsertFData['requestsubtype'] = '';
        $InsertFData['requesttype'] = '';
        $InsertFData['e_rep'] = $_POST['e_rep'];
        $InsertFData['e_calories'] = $_POST['e_calories'];
        $InsertFData['duration'] = $_POST['duration'];
        $InsertFData['DurRepStatus'] = $_POST['DurRepStatus'];
        $response = $this->MasterInformationModel->update_entry2($_POST['edit_id'], $InsertFData, 'master_exercise_request');



        // pre($_POST);
        die();



      	$db = DatabaseSecondConnection();
		$Sdb = DatabaseDefaultConnection();

		$table_username = getMasterUsername();
		$selectedId = $this->request->getPost('id');
		if (!empty($selectedId)) {
			$sql = "SELECT e_type FROM master_exercise_sub_type WHERE id = id";
			$result = $Sdb->query($sql);
			$resultsssss = $result->getResultArray();
		}
		// foreach ($resultsssss as $key => $result_value) {
		// }
		$imgfile = "";
		$data = array();
		$newName = "";
		$fileName = '';
		$files = $_FILES;
		if (!empty($files)) {
			$uploadDir = 'assets/images/food_type/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			$filesArr = $_FILES["images"];
			$fileNames = array_filter($filesArr['name']);
			$uploadedFile = '';
			foreach ($filesArr['name'] as $key => $val) {
				$fileName = basename($filesArr['name'][$key]);
				$targetFilePath = $uploadDir . $fileName;
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
				if (in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif')) && $filesArr["size"][$key] > 1048576) {
					$compressedImage = compressImage($filesArr["tmp_name"][$key]);
					if ($compressedImage !== false) {
						$targetFilePath = $uploadDir . $fileName;
						if (file_put_contents($targetFilePath, $compressedImage)) {
							$uploadedFile .= $fileName . ',';
						} else {
							$uploadStatus = 0;
							$response['message'] = 'Error while saving the compressed image.';
						}
					} else {
						$uploadStatus = 0;
						$response['message'] = 'Error while compressing the image.';
					}
				} else {
					if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
						$uploadedFile .= $fileName . ',';
					} else {
						$uploadStatus = 0;
						$response['message'] = 'Sorry, there was an error uploading your file.';
					}
				}
			}
		}

		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
						if (!empty($post_data)) {
				$update_data = $_POST;
				if ($fileName != '') {
					$update_data['e_image'] = $fileName;
				}
									$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
					$excercise_updatedisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$excercise_updatedisplaydata = json_decode($excercise_updatedisplaydata, true);
					$response = 1;
							}
		}
		echo $response;
		die();
	}
    

    public function ExerciseListData()
    {

        $row_count_html = '';
		$return_array = array(
			'row_count_html' => '',
			'html' => '',
			'total_page' => 0,
			'response' => 0
		);


        $perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
		$pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
        // pre($ajaxsearch);

        $ListDataStatus = $_POST['ListDataStatus'];
        $TableName = $_POST['table'];
        $table_username = getMasterUsername();
        $html = "";
        $ExcerciseType = "";
        $ExerciseSubType = "";
        $ExerciseSubTypeFilter = "";


        $ExerciseData = 'SELECT * FROM '  . $TableName . '';
        $main_sql = $ExerciseData;
        $secondDb = DatabaseDefaultConnection();
        // $result = $secondDb->query($main_sql);

        $sql_result = $secondDb->query($main_sql);
        // $finalresult = $sql_result->getResultArray();
        // pre($ajaxsearch);

        if ($sql_result->getNumRows() > 0) {
            // pre($result);
            $rowCount = $sql_result->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;

            $pagesCount = ceil($rowCount / $perPageCount);
			$lowerLimit = ($pageNumber - 1) * $perPageCount;
			$sqlQuery = $main_sql . " ORDER BY `id` LIMIT $lowerLimit , $perPageCount";
			$Getresult = $secondDb->query($sqlQuery);
			$finalresult = $Getresult->getResultArray();
			$rowCount_child = $Getresult->getNumRows();
			$start_entries = $lowerLimit + 1;
			$last_entries = $start_entries + $rowCount_child - 1;
			$row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
           
            // pre($row_count_html);
            $i = 1;
            $loop_break = 0;


            if ($ListDataStatus == '1') {
                // $ExerciseData = $this->MasterInformationModel->display_all_records2($TableName);
                // $ExerciseData = json_decode($ExerciseData, true);

              
                    $i = 1;
                    $ExcerciseType .= '<select name="e_type" id="ex_type" class="selectpicker ExerciseTypeClassDropdown form-control form-main ev_type" data-live-search="true">';
                    $ExcerciseType .= '<i class="fa-solid fa-caret-down"></i> ';
                    $ExcerciseType .= '<option value="">Select Type</option>';
                    foreach ($finalresult as $key => $value) {
                        $html .= '  <tr >
                                        <td style="width:0%"><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '">
                                        </td>
                                        <td class="EditRecordExerciseType" DataType = "' . $value['e_type'] . '" data-edit_id="' . $value['id'] . '">
                                            <div class=" px-0 py-0 w-100" data-bs-target="#exercise_type_edit" data-bs-toggle="modal">
                                                    <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
                                                        <div class="col d-flex">
                                                                <b>' . $value['id'] . '</b>
                                                            <span class="mx-2  text-capitalize">'. strtolower($value['e_type']) . '</span>
                                                        </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';

                                    $ExcerciseType .= '<option value="' . $value["id"] . '">' . $value["e_type"] . '</option>';
                        $i++;
                    }
                    $ExcerciseType .= '</select>';
                }


            if ($ListDataStatus == '2') {
                // $ExerciseData = $this->MasterInformationModel->display_all_records2($TableName);
                // $ExerciseData = json_decode($ExerciseData, true);

                $ExerciseData = 'SELECT * FROM '  . $TableName . '';
                $main_sql = $ExerciseData;
                $secondDb = DatabaseDefaultConnection();
                // $result = $secondDb->query($main_sql);
    
                $sql_result = $secondDb->query($main_sql);
                // $finalresult = $sql_result->getResultArray();

                

              

                    $i = 1;
                    $ExerciseSubType .= '<select id="e_subtype" name="e_subtype" class="selectpicker form-control ExcercisesDropDownClass form-main">';
                    $ExerciseSubType .= '<option selected="">Select Type</option>';
                    $ExerciseSubTypeFilter .= '<div class="main-selectpicker">
                    <select name="F_subtype" id="F_subtyype" multiple
                    class="multiple-select selectpicker FinventoryType form-control ExerciseMasterFilterSubTypeClass main-control f_subtype"
                    data-live-search="true" required="" tabindex="-98">
                    <option value="" dataTypeId="" disabled style="display:none" selected>
                        Exercise
                        Type</option>';

                    foreach ($finalresult as $key => $value) {



                        $ExerciseTypeData = get_editData2('master_exercise_type', intval($value['e_subtype']));
                        $ExerciseTypeName = '- . -';
                        if(isset($ExerciseTypeData) && !empty($ExerciseTypeData)){
                            $ExerciseTypeName = $ExerciseTypeData['e_type'];
                        }
                        $html .= '  <tr>
                                        <td style="width:0%"><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>
                                        <td class="EditExerciseSubTypeClass" DataExerciseType = "'.$value['e_subtype'].'" DataExerciseSubType = "'.$value['e_type'].'" data-edit_id="' . $value['id'] . '">
                                            <div class=" px-0 py-0 w-100" data-bs-target="#exercise_sub_type_edit" data-bs-toggle="modal">
                                                <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
                                                    <div class="col d-flex">
                                                        <b>' . $value['id'] . '</b>
                                                        <span class="mx-1 text-capitalize">' . strtolower($value['e_type']) . ' </span>
                                                    </div>
                                                    <div class="col">
                                                        <b>Type :</b>
                                                        <span class="mx-1 text-capitalize">'. strtolower($ExerciseTypeName) .
                                                        '</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                        $ExerciseSubType .= '<option value="' . $value["id"] . '" data-id="' . $value["id"] . '">' . $value["e_type"] . '</option>';
                        $ExerciseSubTypeFilter .= '<option class="dropdown-item " dataTypeId = "' . $value["id"] . '" value="' . $value["e_type"] . '">' . $value["e_type"] . '</option>';
                        $i++;
                    }
                    $ExerciseSubType .= '</select>';
                    $ExerciseSubTypeFilter .= '</select></div>';
                }

            
            if ($ListDataStatus == '3') {
                // $ExerciseData = $this->MasterInformationModel->display_all_records2($TableName);
                // $ExerciseData = json_decode($ExerciseData, true);

                $ExerciseData = 'SELECT * FROM '  . $TableName . '';
                $main_sql = $ExerciseData;
                $secondDb = DatabaseDefaultConnection();
                // $result = $secondDb->query($main_sql);
    
                $sql_result = $secondDb->query($main_sql);
                // $finalresult = $sql_result->getResultArray();

              
                    $ExcerciseMasterId = '';
                    $ExerciseMasterName = '';
                    $ExerciseMasterSubType = '';
                    if(isset($_POST['ExcerciseMasterId'])){
                        $ExcerciseMasterId = $_POST['ExcerciseMasterId'];
                    }
                    if(isset($_POST['ExerciseMasterName'])){
                        $ExerciseMasterName = $_POST['ExerciseMasterName'];
                    }
                    if(isset($_POST['ExerciseMasterSubType'])){
                        $ExerciseMasterSubType = $_POST['ExerciseMasterSubType'];
                        $ExerciseMasterSubTypeArray = explode(',', $ExerciseMasterSubType);
                    }
                    $i = 1;
                    foreach ($finalresult as $key => $value) {

                        $from_date = $value['duration'];
                        $newfrom_time = '';
                        if($from_date != 'Invalid date' && $from_date != ''){
                            // $newfrom_time = Utctodate('h:i:s', $this->timezone, $from_date);
                            if(isset($newfrom_time)){
                                $newfrom_time = $from_date;
                            }
                        }
                    
                        
                        if(empty($ExcerciseMasterId) || intval($ExcerciseMasterId) == $value['id']){
                            if(empty($ExerciseMasterName) || preg_match("/" . preg_quote($ExerciseMasterName, '/') . "/i", $value['e_name'])){
                                // if (in_array(intval($value['e_subtype']), $ExerciseMasterSubTypeArray) || $ExerciseMasterSubType == '') {
                                            if ($value['e_image'] != '' && $value['e_image'] != 'undefined') {
                                                $exercise_img = $value['e_image'];
                                            } else {
                                                $exercise_img = '';
                                            }
                                            $ExerciseSubTypeName = '- . -';
                                            $ExerciseTypeName = '- . -';
                                            $ExerciseSubTypeData = get_editData2('master_exercise_sub_type', intval($value['e_subtype']));
                                            if(isset($ExerciseSubTypeData) && !empty($ExerciseSubTypeData)){
                                                $ExerciseSubTypeName = $ExerciseSubTypeData['e_type'];
                                                $ExerciseTypeDataArray = get_editData2('master_exercise_type', intval($ExerciseSubTypeData['e_subtype']));
                                                if(isset($ExerciseTypeDataArray) && !empty($ExerciseTypeDataArray)){
                                                    $ExerciseTypeName = $ExerciseTypeDataArray['e_type'];
                                                }
                                            }
                                            $imgf = base_url('assets/images/food_type/') . $exercise_img;
                                            $string = $_SERVER['DOCUMENT_ROOT'];
                                            $substring = 'rudrramc';
                                            if (strpos($string, $substring) !== false) {
                                                $imgf = 'https://admin.ajasys.com/assets/ExercisePhotos/'.$exercise_img;
                                            } else {
                                                $imgf = 'http://localhost/admin/assets/ExercisePhotos/'.$exercise_img;
                                            }
                                            if($exercise_img == ''){

                                                $imgf = 'https://cdn1.vectorstock.com/i/1000x1000/34/75/default-placeholder-fitness-trainer-in-a-t-shirt-vector-20773475.jpg';
                                            }
                                            
                            
                                            $html .= '  <tr>
                                                            <td><input class="check_box table_list_check" type="checkbox"</td>
                                                            <td class="edt" data-edit_id="' . $value['id'] . '">
                                                                <div class=" px-0 py-0 w-100 exercise_view" locked="1" data-table="master_exercise" data-bs-target="#gymsmart_exercise_view" Image = "' . $imgf.'"  ESubType = "'.$ExerciseSubTypeName.'" EType = "'.$ExerciseTypeName.'" data-view_id="' . $value['id'] . '" data-bs-toggle="modal">
                                                                    <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-4 align-items-center">
                                                                        <div class="col t-pic d-flex flex-wrap align-items-center">
                                                                            <span class="mx-2"><b>' . $value['id'] . '</b></span>
                                                                            <span class="mx-1">
                                                                                <div class="d-flex align-items-center table-thumb">
                                                                                    <img src="'. $imgf . '" alt="" class="profile-image pe-2">
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <b>Name:</b>
                                                                            <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($value['e_name']) .
                                                                            '</span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <b>Type:</b>
                                                                            <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($ExerciseTypeName) . '</span>
                                                                        </div>
                                                                        <div class="col text-wrap">
                                                                            <b>Exercise Subtype:</b>
                                                                            <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($ExerciseSubTypeName) .
                                                                            '</span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <b>Repetation:</b >
                                                                            <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($value['e_rep']) .
                                                                            '</span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <b>Calories:</b>
                                                                            <span class="mx-2" style="text-wrap:balance">' . $value['e_calories'] . '</span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <b>Duration:</b>
                                                                            <span class="mx-2" style="text-wrap:balance">' . $newfrom_time .'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                        }
                                // }
                            }
                        $i++;
                    }
                
            }

            if ($ListDataStatus == '4') {

                $ExcerciseMasterId = '';
                $AppStatus = 0;
                $ExerciseMasterName = '';
                $ExerciseMasterSubType = '';
                if(isset($_POST['ExcerciseMasterId'])){
                    $ExcerciseMasterId = $_POST['ExcerciseMasterId'];
                }
                if(isset($_POST['ExerciseMasterName'])){
                    $ExerciseMasterName = $_POST['ExerciseMasterName'];
                }
                if(isset($_POST['ExerciseMasterSubType'])){
                    $ExerciseMasterSubType = $_POST['ExerciseMasterSubType'];
                    $ExerciseMasterSubTypeArray = explode(',', $ExerciseMasterSubType);
                }
                $i = 1;

                // $DataBase = DatabaseDefaultConnection();
                // $sql = "SELECT * FROM master_exercise_request";
                // $result = $DataBase->query($sql);
                // $ExerciseData = $result->getResultArray();
                    
                $DataBase2 = DatabaseDefaultConnection();

                // $ExerciseData = $this->MasterInformationModel->display_all_records2('master_exercise_request');
                // $ExerciseData = json_decode($ExerciseData, true);
                // $ExerciseDatasql = 'SELECT * FROM `master_exercise_request` ';
                // $ExerciseDataR = $DataBase2->query($ExerciseDatasql);           
                // $ExerciseData = $ExerciseDataR->getResultArray();

                $ExerciseData = 'SELECT * FROM '  . $TableName . '';
                $main_sql = $ExerciseData;
                $secondDb = DatabaseDefaultConnection();
                $sql_result = $secondDb->query($main_sql);


              

                    $Count = 0;
                    $SubDropDownHTML = '';
                    $SubDropDownHTML .= '
                    <div class="ExerciseSubTypeDropDownHtmlSet">
                    <select name="" id="ex_type"
                        class="selectpicker ExerciseTypeClassDropdown ExerciseTypeClassDropdownEdit form-control form-main ev_type "
                        data-live-search="true"><i class="fa-solid fa-caret-down"></i>
                        <option value="">Select Type</option>
                    ';
                    $exercise_type = $this->MasterInformationModel->display_all_records2('master_exercise_type', 'ASC');
                    $exercise_type = json_decode($exercise_type, true);
                    if (isset($exercise_type)) {
                        foreach ($exercise_type as $type_key => $type_value) {
                            $SubDropDownHTML .=  '<option value="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                        }
                    }



                    $DropDownHTML = ''; 
                    $DropDownHTML .= '
                        <div class="ExerciseSubTypeDropDownHtmlSet">
                            <select id="e_subtype" name="" data-live-search="true" class="selectpicker form-control  ExcercisesDropDownClass form-main">
                                <option selected="">Select Type</option>
                    ';
                    $master_exercise_sub_type = $this->MasterInformationModel->display_all_records2('master_exercise_sub_type', 'ASC');

                    $exercise_sub_type = json_decode($master_exercise_sub_type, true);
                            if (isset($exercise_sub_type)) {
                                foreach ($exercise_sub_type as $type_key => $type_value) {
                                    $DropDownHTML .= '<option value="' . $type_value["id"] . '" data-id="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                                }
                            }
                

                    // <div class="ExerciseSubTypeDropDownHtmlSet">
                    //     <select id="e_subtype" name="e_subtype" data-live-search="true" class="selectpicker form-control  ExcercisesDropDownClass form-main">
                    //         <option selected="">Select Type</option>
                    //         <option value="" data-id=""></option>
                    //     </select>
                    // </div>


                    foreach ($finalresult as $key => $value) {
                        $AppStatus = 0;
                        $from_date = $value['duration'];
                        $newfrom_time = '';
                        if($from_date != 'Invalid date' && $from_date != ''){
                            // $newfrom_time = Utctodate('h:i:s', $this->timezone, $from_date);
                            if(isset($newfrom_time)){
                                $newfrom_time = $from_date;
                            }
                        }
                    
                        
                        if(empty($ExcerciseMasterId) || intval($ExcerciseMasterId) == $value['id']){
                            if(empty($ExerciseMasterName) || preg_match("/" . preg_quote($ExerciseMasterName, '/') . "/i", $value['e_name'])){
                                    $exercise_img='';
                                            if ($value['e_image'] != '' && $value['e_image'] != 'undefined') {
                                                $exercise_img = $value['e_image'];
                                            }
                                            $ExerciseTypeName = "";


                                            $ExerciseSubTypeName = "";

                                                if($value['e_subtype'] != ''){
                                                    $ESUBDATA = get_editData2('master_exercise_sub_type', intval($value['e_subtype']));
                                                    if (isset($ESUBDATA) && !empty($ESUBDATA)) {
                                                        $ExerciseSubTypeName = $ESUBDATA['e_type'];  
                                                        $AppStatus = 1;  
                                                        $ESUBSUBDATA = get_editData2('master_exercise_type', intval($ESUBDATA['e_subtype']));
                                                        if (isset($ESUBSUBDATA) && !empty($ESUBSUBDATA)) {
                                                            $ExerciseTypeName = $ESUBSUBDATA['e_type'];
                                                        }
                                                    }
                                                }else{
                                                    $ExerciseSubTypeName = $value['requestsubtype'];
                                                    $AppStatus = 0;
                                                    if($value['requestsubtype'] != ''){

                                                        $DropDownHTML .= '<option value="' . $value["requestsubtype"] . '" data-id="' . $value["requestsubtype"] . '">' . $value["requestsubtype"] . '</option>';
                                                    }

                                                    // pre($value['requestsubtype']);
                                                    $FFrequesttype = $value['requesttype'];
                                                    if($FFrequesttype != ''){
                                                        if(intval($FFrequesttype) > 0){
                                                            $ESUBSUBDATA = get_editData2('master_exercise_type', intval($FFrequesttype));
                                                            if (isset($ESUBSUBDATA) && !empty($ESUBSUBDATA)) {
                                                                $ExerciseTypeName = $ESUBSUBDATA['e_type'];

                                                            }
                                                        }else{
                                                            $ExerciseTypeName = $FFrequesttype;
                                                            if($FFrequesttype != ''){

                                                                $SubDropDownHTML .=  '<option value="' . $FFrequesttype . '">' . $FFrequesttype . '</option>';
                                                            }

                                                        }
                                                    }
                                                }

                                
                                            

                            
                                                $imgf = base_url('assets/images/food_type/') . $exercise_img;
                                                $string = $_SERVER['DOCUMENT_ROOT'];
                                                $substring = 'rudrramc';
                                                if (strpos($string, $substring) !== false) {
                                                    $imgf = 'https://admin.ajasys.com/assets/ExercisePhotos/'.$exercise_img;
                                                } else {
                                                    $imgf = 'http://localhost/admin/assets/ExercisePhotos/'.$exercise_img;
                                                }
                                                if($exercise_img == ''){
            
                                                    $imgf = 'https://cdn1.vectorstock.com/i/1000x1000/34/75/default-placeholder-fitness-trainer-in-a-t-shirt-vector-20773475.jpg';
                                                }
            
                                                $exercise_img = '';
                                                $Count++;
                                            $html .= '  <tr>
                                                            <td><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>
                                                            <td class="edt" data-edit_id="' . $value['id'] . '">
                                                                <div class=" px-0 py-0 w-100  exerciseRequest_view" locked="0"  data-table="master_exercise_request" DataApprovedStatus = "'.$AppStatus.'" DataType="'.$ExerciseTypeName.'" DayaSubType = "'.$ExerciseSubTypeName.'" data-bs-target="#Request_exercise_view" Image = "'.$imgf.'"  ESubType = "'.$ExerciseSubTypeName.'" EType = "'.$ExerciseTypeName.'" data-view_id="' . $value['id'] . '" data-bs-toggle="modal">
                                                                    <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-4 align-items-center">
                                                                        <div class="col t-pic d-flex flex-wrap align-items-center">
                                                                            <span class="mx-2"><b>' . $Count . '</b></span>
                                                                            <span class="mx-1">
                                                                                <div class="d-flex align-items-center table-thumb">';
                                                                                        
                                                                                $html .= ' 
                                                                                    <img src="' . $imgf. '"  alt="" class="profile-image pe-2">
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <b>Name:</b>
                                                                            <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($value['e_name']) .
                                                                            '</span>
                                                                        </div>
                                                                        <div class="col" >
                                                                            <b>Type:</b>
                                                                            <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($ExerciseTypeName) . '</span>
                                                                        </div>
                                                                        <div class="col text-wrap">
                                                                            <b>Exercise Subtype:</b>
                                                                            <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($ExerciseSubTypeName) .
                                                                            '</span>
                                                                        </div>
                                                                        
                                                                        <div class="col">
                                                                            <b>Calories:</b>
                                                                            <span class="mx-2" style="text-wrap:balance">' . $value['e_calories'] . '</span>
                                                                        </div>';
                                                                        if($value['DurRepStatus'] == '0'){ 


                                                                            $html .= '
                                                                            <div class="col">
                                                                                <b>Repetation:</b >
                                                                                <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($value['e_rep']) .
                                                                                '</span>
                                                                            </div>';
                                                                        }

                                                                        if($value['DurRepStatus'] == '1'){ 

                                                                        $html .= '
                                                                        <div class="col">
                                                                            <b>Duration:</b>
                                                                            <span class="mx-2" style="text-wrap:balance">' . $newfrom_time .'</span>
                                                                        </div>';

                                                                        }
                                                                        $html .= '
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                        }
                                }
                        $i++;
                    }
                    
                    $DropDownHTML .= '
                        </select>
                    </div>
                ';

                $SubDropDownHTML .= '
                    </select>
                </div>
                ';
                
            }

            if ($ListDataStatus == '44') {
                // $ExerciseData = $this->MasterInformationModel->display_all_records2($TableName);
                // $ExerciseData = json_decode($ExerciseData, true);
            

                $ExcerciseMasterId = '';
                $ExerciseMasterName = '';
                $ExerciseMasterSubType = '';
                if(isset($_POST['ExcerciseMasterId'])){
                    $ExcerciseMasterId = $_POST['ExcerciseMasterId'];
                }
                if(isset($_POST['ExerciseMasterName'])){
                    $ExerciseMasterName = $_POST['ExerciseMasterName'];
                }
                // if(isset($_POST['ExerciseMasterSubType'])){
                //     $ExerciseMasterSubType = $_POST['ExerciseMasterSubType'];
                //     $ExerciseMasterSubTypeArray = explode(',', $ExerciseMasterSubType);
                // }
                $i = 1;

                // $DataBase = DatabaseDefaultConnection();
                // $sql = "SELECT * FROM master_exercise_request";
                // $result = $DataBase->query($sql);
                // $ExerciseData = $result->getResultArray();
                    

                // $ExerciseData = $this->MasterInformationModel->display_all_records2('master_exercise_request');
                // $ExerciseData = json_decode($ExerciseData, true);
                $DataBase2 = DatabaseDefaultConnection();


                $ExerciseData = $this->MasterInformationModel->display_all_records2('master_exercise_request');
                $ExerciseData = json_decode($ExerciseData, true);
                $ExerciseDatasql = 'SELECT * FROM `master_exercise_request`';
                $ExerciseDataR = $DataBase2->query($ExerciseDatasql);           
                $ExerciseData = $ExerciseDataR->getResultArray();
                $Count = 0;
                $SubDropDownHTML = '';
                $SubDropDownHTML .= '
                <div class="ExerciseSubTypeDropDownHtmlSet">
                <select name="e_type" id="ex_type"
                    class="selectpicker ExerciseTypeClassDropdown ExerciseTypeClassDropdownEdit form-control form-main ev_type "
                    data-live-search="true"><i class="fa-solid fa-caret-down"></i>
                    <option value="">Select Type</option>
                ';
                $exercise_type = $this->MasterInformationModel->display_all_records2('master_exercise_type', 'ASC');
                $exercise_type = json_decode($exercise_type, true);
                if (isset($exercise_type)) {
                    foreach ($exercise_type as $type_key => $type_value) {
                        $SubDropDownHTML .=  '<option value="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                    }
                }



                $DropDownHTML = ''; 
                $DropDownHTML .= '
                    <div class="ExerciseSubTypeDropDownHtmlSet">
                        <select id="e_subtype" name="" data-live-search="true" class="selectpicker form-control  ExcercisesDropDownClass form-main">
                            <option selected="">Select Type</option>
                ';
                $master_exercise_sub_type = $this->MasterInformationModel->display_all_records2('master_exercise_sub_type', 'ASC');

                $exercise_sub_type = json_decode($master_exercise_sub_type, true);
                        if (isset($exercise_sub_type)) {
                            foreach ($exercise_sub_type as $type_key => $type_value) {
                                $DropDownHTML .= '<option value="' . $type_value["id"] . '" data-id="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                            }
                        }


                foreach ($ExerciseData as $key => $value) {


                    
                    if(empty($ExcerciseMasterId) || intval($ExcerciseMasterId) == $value['id']){
                        if(empty($ExerciseMasterName) || preg_match("/" . preg_quote($ExerciseMasterName, '/') . "/i", $value['e_name'])){
                            // if (in_array(intval($value['e_subtype']), $ExerciseMasterSubTypeArray) || $ExerciseMasterSubType == '') {
                                        if ($value['e_image'] != '' && $value['e_image'] != 'undefined') {
                                            $exercise_img = $value['e_image'];
                                        } else {
                                            $exercise_img = 'nofoodphotoimage.png';
                                        }
                                        $ExerciseTypeName = "";


                                        $ExerciseSubTypeName = "";

                                            if($value['e_subtype'] != ''){
                                                $ESUBDATA = get_editData2('master_exercise_sub_type', intval($value['e_subtype']));
                                                if (isset($ESUBDATA) && !empty($ESUBDATA)) {
                                                    $ExerciseSubTypeName = $ESUBDATA['e_type'];    
                                                    $ESUBSUBDATA = get_editData2('master_exercise_type', intval($ESUBDATA['e_subtype']));
                                                    if (isset($ESUBSUBDATA) && !empty($ESUBSUBDATA)) {
                                                        $ExerciseTypeName = $ESUBSUBDATA['e_type'];
                                                    }
                                                }
                                            }else{
                                                $ExerciseSubTypeName = $value['requestsubtype'];
                                                if($value['requestsubtype'] != ''){
                                                    $DropDownHTML .= '<option value="' . $value["requestsubtype"] . '" data-id="' . $value["requestsubtype"] . '">' . $value["requestsubtype"] . '</option>';
                                                }

                                                // pre($value['requestsubtype']);
                                                $FFrequesttype = $value['requesttype'];
                                                if($FFrequesttype != ''){
                                                    if(intval($FFrequesttype) > 0){
                                                        $ESUBSUBDATA = get_editData2('master_exercise_type', intval($FFrequesttype));
                                                        if (isset($ESUBSUBDATA) && !empty($ESUBSUBDATA)) {
                                                            $ExerciseTypeName = $ESUBSUBDATA['e_type'];
                                                        }
                                                    }else{
                                                        $ExerciseTypeName = $FFrequesttype;
                                                        if($FFrequesttype != ''){

                                                            $SubDropDownHTML .=  '<option value="' . $FFrequesttype . '">' . $FFrequesttype . '</option>';
                                                        }

                                                    }
                                                }
                                            }

                                $ExerciseSubTypeName = "-";
                                if (!empty(isset($value['requestsubtype']))) {
                                    $name = SecoundDBIdToFieldGetData('e_type', "id=" . intval($value['requestsubtype']) . "", "master_exercise_sub_type");
                                    if (isset($name) && !empty($name)) {
                                        $ExerciseSubTypeName = isset($name['e_type']) && !empty($name['e_type']) ? $name['e_type'] : '';
                                    }
                                }

                    $from_date = $value['duration'];
                    $newfrom_time = '';
                    if($from_date != 'Invalid date' && $from_date != ''){
                        // $newfrom_time = Utctodate('h:i:s', $this->timezone, $from_date);
                        if(isset($newfrom_time)){
                            $newfrom_time = $from_date;
                        }
                    }
                
                    
                
                                        if ($value['e_image'] != '' && $value['e_image'] != 'undefined') {
                                            $exercise_img = $value['e_image'];
                                        } else {
                                            $exercise_img = 'nofoodphotoimage.png';
                                        }
                                    

                                    
                                        
                        
                                        $html .= '  <tr>
                                                        <td><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>
                                                        <td class="edt" data-edit_id="' . $value['id'] . '">
                                                            <div class=" px-0 py-0 w-100 exerciseRequest_view" locked="0" data-table="master_exercise_request" data-bs-target="#Request_exercise_view" Image = "'.base_url('assets/images/food_type/') . $exercise_img.'"  ESubType = "'.$ExerciseSubTypeName.'"  ExcerciseType =" '.$ExerciseTypeName.'" data-view_id="' . $value['id'] . '" DataId="'.$value['id'].'" data-bs-toggle="modal">
                                                                <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-4 align-items-center">
                                                                    <div class="col t-pic d-flex flex-wrap align-items-center">
                                                                        <span class="mx-2"><b>' . $value['id'] . '</b></span>
                                                                        <span class="mx-1">
                                                                            <div class="d-flex align-items-center table-thumb">
                                                                                <img src="' . base_url('assets/images/food_type/') . $exercise_img . '" alt="" class="profile-image pe-2">
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <b>Name:</b>
                                                                        <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($value['e_name']) .
                                                                        '</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <b>Type:</b>
                                                                        <span class="mx-2 text-capitalize" style="text-wrap:balance">'.strtolower($ExerciseTypeName).'</span>
                                                                    </div>
                                                                    <div class="col text-wrap">
                                                                        <b>Exercise Subtype:</b>
                                                                        <span class="mx-2 text-capitalize" style="text-wrap:balance">' .strtolower($ExerciseSubTypeName) .
                                                                        '</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <b>Repetation:</b >
                                                                        <span class="mx-2 text-capitalize" style="text-wrap:balance">' . strtolower($value['e_rep']) .
                                                                        '</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <b>Calories:</b>
                                                                        <span class="mx-2" style="text-wrap:balance">' . $value['e_calories'] . '</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <b>Duration:</b>
                                                                        <span class="mx-2" style="text-wrap:balance">' . $newfrom_time .'</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>';
                        
                    $i++;
                }
                }
                }
                }
        // }
        $result['row_count_html'] = $row_count_html;
        $result['html'] = $html;
        $result['total_page'] = $pagesCount;
        $result['response'] = 1;

        // $result['html'] = $html;
        $result['ExerciseType'] = $ExcerciseType;
        $result['ExerciseSubType'] = $ExerciseSubType;
        $result['ExerciseSubTypeFilter'] = $ExerciseSubTypeFilter;

        }else{
            $result['row_count_html'] = $row_count_html;
            $result['html'] = $html;
            $result['row_count_html'] = "Page 0 of 0";
            $result['response'] = 1;
            
            // $result['html'] = $html;
            $result['ExerciseType'] = $ExcerciseType;
            $result['ExerciseSubType'] = $ExerciseSubType;
            $result['ExerciseSubTypeFilter'] = $ExerciseSubTypeFilter;
        }
        echo json_encode($result);
        die();
    }

    public function master_exercise_update()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("id");
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			//print_r($_POST);
			unset($_POST['action']);
			unset($_POST['id']);
			unset($_POST['table']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				$isduplicate = duplicate_data2($update_data, $table_name);
				if ($isduplicate == 0) {
					$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
					$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$departmentdisplaydata = json_decode($departmentdisplaydata, true);
					$response = 1;
				} else {
					return "error";
				}
			}
		}
		echo $response;
		die();
	}

    public function master_exercise_update_insert()
	{
        // pre($_POST);
        if($_POST['id'] != ''){
            $GetDataER = $this->MasterInformationModel->edit_entry2('master_exercise_request', $_POST['id']);
            if(isset($GetDataER) && !empty($GetDataER)){
                $GetDataER = json_encode($GetDataER, true);
                $GetDataER = json_decode($GetDataER, true);
                // pre($GetDataER);
                // die();
                if($GetDataER[0]['e_subtype'] != ''){
                    $InsertDatas['e_name'] = $GetDataER[0]['e_name'];
                    $InsertDatas['e_type'] = $GetDataER[0]['e_type'];
                    $InsertDatas['e_subtype'] = $GetDataER[0]['e_subtype'];
                    if($GetDataER[0]['e_image'] != ''){

                        $InsertDatas['e_image'] = $GetDataER[0]['e_image'];
                    }
                    $InsertDatas['e_calories'] = $GetDataER[0]['e_calories'];
                    $InsertDatas['e_rep'] = $GetDataER[0]['e_rep'];
                    $InsertDatas['duration'] = $GetDataER[0]['duration'];
                    $InsertDatas['selected_id'] = $GetDataER[0]['selected_id'];
                    $this->MasterInformationModel->insert_entry2($InsertDatas, 'master_exercise');
                    $db_connection = DatabaseDefaultConnection();
                    $lastInsertID = $db_connection->insertID();
                    if(isset($lastInsertID) && !empty($lastInsertID)){
                        $delete_displaydata = $this->MasterInformationModel->delete_entry3('master_exercise_request', $_POST['id']);
                    }
                }
            }
        }
        die();



		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("id");
		$response = 0;

		$db_connection = DatabaseDefaultConnection();

		if ($action_name == "update") {
			unset($post_data['action']);
			unset($post_data['id']);
			unset($post_data['table']);

			if (!empty($post_data)) {
				$sql = "SELECT * FROM master_exercise_request WHERE id = ?";
				$result = $db_connection->query($sql, [$update_id]);

				$updated_record = $result->getRowArray();
				$status = $updated_record['request_status'];

				if ($status == 1) {
					$insert_data = [
						'e_name' => $updated_record['e_name'],
						'e_type' => $updated_record['e_type'],
						'e_subtype' => $updated_record['e_subtype'],
						'e_rep' => $updated_record['e_rep'],
						'e_calories' => isset($updated_record['e_calories']),
						'e_image' => isset($updated_record['e_image']),
						'duration' => $updated_record['duration'],
						
					];

					$this->MasterInformationModel->insert_entry2($insert_data, 'master_exercise');
				}


				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;
			}
		}

		echo $response;
		die();
	}

    public function exercise_delete_data()
	{

		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			$delete_displaydata = $this->MasterInformationModel->delete_entry3($table_name, $delete_id);
		}
		die();
	}



}
