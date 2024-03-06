<?php
namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class GymMasterController extends BaseController
{
    public function __construct()
    {
        helper('custom');
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
    }
    public function ExerciseViewData()
    {
        $edit_id = $this->request->getPost('edit_id');
        $table_name = $this->request->getPost('table');
        $departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);
        if (isset($departmentEditdata) && !empty($departmentEditdata)) {
            $SubDropDownHTML = '';
            $SubDropDownHTML .= '
                <div class="ExerciseSubTypeDropDownHtmlSet">
                <select name="" id="ex_type"
                    class="selectpicker ExerciseTypeClassDropdown ExerciseTypeClassDropdownEdit MainTypeClassDD form-control form-main ev_type "
                    data-live-search="true"><i class="fa-solid fa-caret-down"></i>
                    <option value="">Select Type</option>
                ';
            $exercise_type = $this->MasterInformationModel->display_all_records2('master_exercise_type', 'ASC');
            $exercise_type = json_decode($exercise_type, true);
            $departmentEditdata = json_encode($departmentEditdata, true);

            $departmentEditdata = json_decode($departmentEditdata, true);

            if (isset($exercise_type)) {
                foreach ($exercise_type as $type_key => $type_value) {
                    $SubDropDownHTML .= '<option value="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                }
            }



            if (intval($departmentEditdata[0]['requesttype']) > 0) {
            } else {
                if ($departmentEditdata[0]['requesttype'] != '') {
                    $SubDropDownHTML .= '<option value="' . $departmentEditdata[0]['requesttype'] . '" data-id="' . $departmentEditdata[0]['requesttype'] . '">' . $departmentEditdata[0]['requesttype'] . ' [NEW]</option>';
                }
            }


            $SubDropDownHTML .= '
                    </select>
                </div>
                ';


            $DropDownHTML = '';
            $DropDownHTML .= '
                <div class="ExerciseSubTypeDropDownHtmlSet">
                    <select id="e_subtype" name="" data-live-search="true" class="selectpicker form-control MainSubTypeClassDD  SubExcercisesDropDownClass form-main">
                        <option selected="">Select Type</option>
            ';
            $master_exercise_sub_type = $this->MasterInformationModel->display_all_records2('master_exercise_sub_type', 'ASC');

            $exercise_sub_type = json_decode($master_exercise_sub_type, true);
            if (isset($exercise_sub_type)) {
                foreach ($exercise_sub_type as $type_key => $type_value) {
                    $DropDownHTML .= '<option value="' . $type_value["id"] . '" data-id="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                }
            }

            if ($departmentEditdata[0]['e_subtype'] == '') {
                if ($departmentEditdata[0]['requestsubtype'] != '') {
                    $DropDownHTML .= '<option value="' . $departmentEditdata[0]['requestsubtype'] . '">' . $departmentEditdata[0]['requestsubtype'] . ' [NEW]</option>';
                }
            }

            $DropDownHTML .= '
                    </select>
                </div>
            ';
            $departmentEditdata[0]['ETypeDDHtml'] = $SubDropDownHTML;


            $departmentEditdata[0]['SubTypeDDHtml'] = $DropDownHTML;
            return json_encode($departmentEditdata, true);
        }


        die();
    }


    public function excercise_insert_data_master()
    {


        $db = DatabaseSecondConnection();
        $Sdb = DatabaseDefaultConnection();

        $FoodsubType = $_POST['e_subtype'];
        $ExerciseType = $_POST['e_type'];

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

            $string = $_SERVER['DOCUMENT_ROOT'];
            $substring = 'rudrramc';
            if (strpos($string, $substring) !== false) {
                $uploadDir = '/home/rudrramc/admin.ajasys.com/assets/ExercisePhotos/';
            } else {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/admin/assets/ExercisePhotos/';
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


    public function excercise_update_data_master()
	{
		// e_subtype
		$db = DatabaseSecondConnection();
		$Sdb = DatabaseDefaultConnection();

		$table_username = getMasterUsername();
		$selectedId = $this->request->getPost('id');
		if (!empty($selectedId)) {
			$sql = "SELECT e_type FROM master_exercise_sub_type WHERE id = id";
			$result = $Sdb->query($sql);
			$resultsssss = $result->getResultArray();
		}
        if(isset($resultssss)){

            foreach ($resultsssss as $key => $result_value) {
            }
        }
		$imgfile = "";
		$data = array();
		$newName = "";
		$fileName = '';
		$files = $_FILES;
		// if (!empty($files)) {
		// 	$uploadDir = 'assets/images/food_type/';
		// 	if (!is_dir($uploadDir)) {
		// 		mkdir($uploadDir, 0755, true);
		// 	}
		// 	$filesArr = $_FILES["images"];
		// 	$fileNames = array_filter($filesArr['name']);
		// 	$uploadedFile = '';
		// 	foreach ($filesArr['name'] as $key => $val) {
		// 		$fileName = basename($filesArr['name'][$key]);
		// 		$targetFilePath = $uploadDir . $fileName;
		// 		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
		// 		if (in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif')) && $filesArr["size"][$key] > 1048576) {
		// 			$compressedImage = compressImage($filesArr["tmp_name"][$key]);
		// 			if ($compressedImage !== false) {
		// 				$targetFilePath = $uploadDir . $fileName;
		// 				if (file_put_contents($targetFilePath, $compressedImage)) {
		// 					$uploadedFile .= $fileName . ',';
		// 				} else {
		// 					$uploadStatus = 0;
		// 					$response['message'] = 'Error while saving the compressed image.';
		// 				}
		// 			} else {
		// 				$uploadStatus = 0;
		// 				$response['message'] = 'Error while compressing the image.';
		// 			}
		// 		} else {
		// 			if (move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)) {
		// 				$uploadedFile .= $fileName . ',';
		// 			} else {
		// 				$uploadStatus = 0;
		// 				$response['message'] = 'Sorry, there was an error uploading your file.';
		// 			}
		// 		}
		// 	}
		// }
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
}
