<?php



namespace App\Controllers;



use App\Models\MasterInformationModel;

use Config\Database;



class MasterInformation extends BaseController
{
	public function __construct()
	{
		helper('custom');
		$db = db_connect();
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->admin = 0;
		// $this->username = session_username($_SESSION['username']);
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
			$this->user_id = 1;
		}
		$session = \Config\Services::session();
		$this->username = session_username($_SESSION['username']);
	}
	public function department_insertdata()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;
				$isduplicate = $this->duplicate_data($insert_data, $table_name);
				if ($isduplicate == 0) {
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

	public function duplicate_data2($data, $table)
	{
		$this->db = \Config\Database::connect('second');
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

	public function show_list_data()
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}
		$table_name = $_POST['table'];
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
		$departmentdisplaydata = json_decode($departmentdisplaydata, true);
		$i = 1;
		$html = "";
		foreach ($departmentdisplaydata as $key => $value) {
			$list_id = $value[array_key_first($value)];
			// class="' . $table_name . '_edit" data-bs-toggle="modal" data-bs-target="#' . $table_name . '_update" data-edit_id="' . $list_id . '"
			$html .= '<tr>';
			$html .= '
					<td class="align-middle">
						<input class="checkbox mx-3 mt-0" type="checkbox" value="' . $value['id'] . '"/>
					</td>
					<td>
						<div class="px-0 py-0 w-100 ' . $table_name . '_edt" data-edit_id="' . $value['id'] . '"';
			if (in_array('departmentinformation_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$html .= '	 data-bs-toggle="modal" data-bs-target="#' . $table_name . '_view"';
			};
			$html .= '>	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-xl-5">';
			$ts = "";
			foreach ($value as $k => $v) {
				if (in_array($k, $allow_data)) {
					$ts .= '<div class="col"><span class="mx-1 text-wrap w-100">' . $v . '</span></div>';
				}
			}
			$html .= $ts;
			$html .= '</div>
						</div>
					</td>';
			$html .= '</tr>';
			$i++;
		}
		if (!empty($html)) {
			echo $html;
		} else {
			echo '<td></td><td style="text-align:center;">Data Not Found </td>';
		}
		die();
	}

	// list data



	public function food_list_data_new()
	{
		$table_name = $_POST['table'];
		$db_connection = \Config\Database::connect('second');
		$action = $_POST['action'];
		$username = session_username($_SESSION['username']);

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

		$ajaxsearch_query = '';
		$html = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			foreach ($_POST as $k => $v) {
				if (!empty($v) && $k == "f_id") {
					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%" ';
				}
				if (!empty($v) && $k == "f_food") {
					$ajaxsearch_query .= ' AND FoodName LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_unit") {
					$ajaxsearch_query .= ' AND NutritionUnit LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_type") {
					$ajaxsearch_query .= ' AND VegNonVeg LIKE "%' . $v . '%"';
				}


				if (!empty($v) && $k == "f_food_type") {
					$ajaxsearch_query .= ' AND FoodType = "' . $v . '"';
				}


				if ($ajaxsearch != '') {
					$ajaxsearch_query .= ' AND CONCAT(FoodType) LIKE "%' . $ajaxsearch . '%" ';
				}
			}
		}
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

			if ($ajaxsearch_query == "") {
				$sql = 'SELECT * FROM `master_food_items` ';
			} else {
				$sql = 'SELECT * FROM `master_food_items` WHERE 1 ' . $ajaxsearch_query;
			}
		}

		$main_sql = $sql;
		$result = $db_connection->query($sql);
		$FoodDataArray = $result->getResultArray();
		$food_img = '';
		$base_url = base_url();
		
		if ($result->getNumRows() > 0) {
            // pre($result);
            $rowCount = $result->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;

            $pagesCount = ceil($rowCount / $perPageCount);
			$lowerLimit = ($pageNumber - 1) * $perPageCount;
			$sqlQuery = $main_sql . " ORDER BY `id` LIMIT $lowerLimit , $perPageCount";
			$Getresult = $db_connection->query($sqlQuery);
			$finalresult = $Getresult->getResultArray();
			$rowCount_child = $Getresult->getNumRows();
			$start_entries = $lowerLimit + 1;
			$last_entries = $start_entries + $rowCount_child - 1;
			$row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';

			foreach ($finalresult as $key => $value) {
			$food_img = !empty($value['Image']) ? base_url('assets/images/food_type/') . $value['Image'] : 'assets/image/member.png';
			if ($value['Image'] != '') {
				$targetDirectory = '' . FCPATH . 'assets/images/food_type/' . $value['Image'];
				if (!file_exists($targetDirectory)) {
					$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
				}
			} else {
				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}
			$exercise_img = '';

			if($value['Image'] != '' && intval($value['Image']) == '0' && $value['Image'] != 'undefined'){
				$exercise_img = $value['Image'];
			}


			$string = $_SERVER['DOCUMENT_ROOT'];
			$substring = 'rudrramc';
			if (strpos($string, $substring) !== false) {
				$food_img = 'https://admin.ajasys.com/assets/FoodPhotos/'.$exercise_img;
			} else {
				$food_img = 'http://localhost/admin/assets/FoodPhotos/'.$exercise_img;
			}
			if($exercise_img == ''){

				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}

			$food_type = "-";
			if (!empty(isset($value['FoodType']))) {
				$name = SecoundDBIdToFieldGetData('type', "id=" . intval($value['FoodType']) . "", "master_food_type");
				if (isset($name) && !empty($name)) {
					$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				}
			}



			if ($value['VegNonVeg'] == '1') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"/>
							<circle cx="1318" cy="1317" r="611" fill="#19C82A"/>
						</svg>
				';
			}
			if ($value['VegNonVeg'] == '2') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#FF0000"/>
							<circle cx="1318" cy="1317" r="611" fill="#FF0000"/>
						</svg>
				';
			}
			if ($value['VegNonVeg'] == '3') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#747474"/>
							<path d="M1317.5 1960.12C1033.45 1960.12 803 1686.8 803 1402.75C803 1102.62 974.5 673.875 1317.5 673.875C1660.5 673.875 1832 1102.62 1832 1402.75C1832 1686.8 1601.55 1960.12 1317.5 1960.12ZM1217.82 990.078C1235.23 974 1236.57 946.935 1220.5 929.517C1204.42 912.099 1177.35 910.759 1159.93 926.838C1095.89 985.255 1049.8 1068.06 1019.79 1152.47C989.774 1236.88 974.5 1326.91 974.5 1402.75C974.5 1426.33 993.794 1445.62 1017.38 1445.62C1040.96 1445.62 1060.25 1426.33 1060.25 1402.75C1060.25 1337.1 1073.65 1256.97 1100.71 1180.87C1127.78 1104.5 1167.71 1035.9 1217.82 990.078Z" fill="#747474"/>
						</svg>
				';
			}
			$html .= '
			<tr>
				<td class="align-middle">
				<input class="check_box table_list_check mt-2"  type="checkbox">
				</td>
				<td>
					<div>
						<div class="d-flex align-items-center flex-wrap EditFoodListData List1Food" DataTable="Master" data-bs-toggle="modal" data-bs-target="#AdminViwwModelID" data-bs-target="#foodUpdate" FoodSubType = "' . $food_type . '" FoodName= "' . $value['FoodName'] . '" VegSVG = "" DataImageSRC = "' . $food_img . '" DataId = "' . $value['id'] . '">
							<div class="col-lg-5 col-md-5 col-sm-6 col-12">
								<div class="d-flex align-items-center flex-wrap">
									<img src="' . $food_img . '" alt="" class="profile-image">
									<h5 class="mx-2 fs-6"> <span class="fw-medium">' . $value['FoodName'] . '</span> <span class="fw-light"> - ( ' . $food_type . ' )</span></h5> <div class="VegNonVegSVG' . $value['id'] . '">' . $Veghtml . '</div>';



			$html .= '			</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-6 col-12 my-1">
								<div class="d-flex align-items-center flex-wrap">
									<h5 class="mx-2 fs-6"> <span class="fw-medium">Nutr val pr.</span> <span class="fw-light"> - ' . $value['NutritionValue'] . $value['NutritionUnit'] . ' </span></h5>
								</div>
							</div>
							<div class="col-lg-5 col-md-4 col-sm-12 col-12">
								<div class="row row-cols-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-3">
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Calories.svg" alt="Calories">
											</span> 
											<span class="fw-light"> : ' . $value['Calories'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Protein.svg" alt="Protein">
											</span> 
											<span class="fw-light"> : ' . $value['Protein'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Carbons.svg" alt="Carbons">
											</span> 
											<span class="fw-light"> : ' . $value['Carbs'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Fats.svg" alt="Fats">
											</span> 
											<span class="fw-light"> : ' . $value['Fats'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Fiber.svg" alt="Fiber">
											</span> 
											<span class="fw-light"> : ' . $value['Fiber'] . ' </span>
										</h5>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</td>
	   		</tr>';
		}



		// if (!empty($html)) {
// 	$Rresult['html'] = $html;
		// } else {
		// 	$Rresult['html'] = '<p style="text-align:center;">Data Not Found</p>';
		// }
		$Rresult['row_count_html'] = $row_count_html;
        $Rresult['total_page'] = $pagesCount;

			$Rresult['html'] = $html;
		$Rresult['response'] = 1;

		}else{
			$Rresult['row_count_html'] = $row_count_html;
            // $result['html'] = $html;
            $Rresult['row_count_html'] = "Page 0 of 0";
            $Rresult['response'] = 1;
		}
		return json_encode($Rresult);
		die();

		$table_name = $_POST['table'];
		$db_connection = \Config\Database::connect('second');
		$action = $_POST['action'];
		$username = session_username($_SESSION['username']);
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$ajaxsearch_query = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			foreach ($_POST as $k => $v) {
				if (!empty($v) && $k == "f_id") {
					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%" ';
				}
				if (!empty($v) && $k == "f_food") {
					$ajaxsearch_query .= ' AND food LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_unit") {
					$ajaxsearch_query .= ' AND unit LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_type") {
					$ajaxsearch_query .= ' AND type LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_food_type") {
					$ajaxsearch_query .= ' AND food_type LIKE "%' . $v . '%"';
				}
			}
		}
		if ($ajaxsearch_query == "") {
			$sql = 'SELECT * FROM `master_food` ';
		} else {
			$sql = 'SELECT * FROM `master_food` WHERE 1 ' . $ajaxsearch_query;
		}

		$main_sql = $sql;
		$result = $db_connection->query($sql);
		$resultsss = $result->getResultArray();
		$result = array();
		$i = 1;
		$food_img = '';
		$html = "";
		foreach ($resultsss as $key => $value) {
			$food_type = "-";
			if (!empty(isset($value['food_type']))) {
				$name = SecoundDBIdToFieldGetData('type', "id=" . intval($value['food_type']) . "", "master_food_type");
				if (isset($name) && !empty($name)) {
					$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				}
			}
			// if (empty($food) || preg_match("/" . preg_quote($food, '/') . "/i", $value['food'])) {
			// 	if (empty($F_unit) || $F_unit == $value['unit']) {
			// 		if (empty($F_type) || $F_type == $value['type']) {
			// print_r($value);
			// if ($value['image'] != '' && $value['image'] != 'undefined') {
			// 	$food_img = $value['image'];
			// } else {
			// 	$food_img = 'food_image.jpg';
			// }

			$food_img = !empty($value['image']) ? base_url('assets/images/food_type/') . $value['image'] : 'assets/image/member.png';



			if ($value['image'] != '') {
				$targetDirectory = '' . FCPATH . 'assets/images/food_type/' . $value['image'];
				if (!file_exists($targetDirectory)) {
					// $food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
					$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
				}
			} else {
				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}





			$html .= '<tr>			
			<td style="width:0%"><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>';
			$ts = "";
			$ts .= '
			<td class="edit" data-edit_id="' . $value['id'] . '">
			<div class=" px-0 py-0 w-100 food_view" data-bs-target="#view_model" DataImageSrc = "' . $food_img . '" data-view_id="' . $value['id'] . '" data-bs-toggle="modal">
				<div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-6">
					<div class="col t-pic">
						<span class="mx-2"><b>' . $value['id'] . '</b></span>
						<span class="mx-1">
								<div class="d-flex align-items-center">
									<img width="50px" heigth="50px" src="  ' . $food_img . '" alt="" class="profile-image">
								</div
								<span class="mx-2 text-capitalize">' . strtolower($value['food']) . '</span>
						</span>									
					</div>
					<div class="col">
						<b>Unit: </b>
						<span class="mx-2">' . $value['unit'] . '</span>
					</div>
					<div class="col">
						<b>Quantity: </b>
						<span class="mx-2">' . $value['quantity'] . '</span>
					</div>
					<div class="col">
						<b>Type: </b>
						<span class="mx-2 text-capitalize">' . strtolower($value['type']) . '</span>
					</div>
					<div class="col">
						<b>Food Type: </b>
						<span class="mx-2 text-capitalize">' . strtolower($food_type) . '</span>
					</div>
					
					<div class="col">
					
					</div>
					
					<div class="col">
					<b>Small: </b>
					<span class="mx-2">' . $value['small'] . '</span>
				</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['small_protein'] . '</span>
					</div>
				
					
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['small_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['small_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['small_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['small_calories'] . '</span>
					</div>
					
						<div class="col">
							<b>Medium: </b>
							<span class="mx-2">' . $value['medium'] . '</span>
						</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['medium_protein'] . '</span>
					</div>
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['medium_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['medium_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['medium_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['medium_calories'] . '</span>
					</div>
					<div class="col">
						<b>Large: </b>
						<span class="mx-2">' . $value['large'] . '</span>
					</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['large_protein'] . '</span>
					</div>
					
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['large_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['large_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['large_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['large_calories'] . '</span>
					</div>
				</div>
			</div>
		</td>
					';
			$html .= $ts;
			$html .= '</tr>';
			$i++;
		}
		// if (!empty($html)) {
// 	$result['html'] = $html;
		// } else {
		// 	$result['html'] = '<p style="text-align:center;">Data Not Found</p>';
		// }

		$result['html'] = $html;
		$result['response'] = 1;

		return json_encode($result);
		die();
	}

	public function food_list_request()
	{
		// print_r($_POST);

		$table_name = $_POST['table'];
		$db_connection = \Config\Database::connect('second');
		$action = $_POST['action'];
		$username = session_username($_SESSION['username']);

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

		$ajaxsearch_query = '';
		$html = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			foreach ($_POST as $k => $v) {
				if (!empty($v) && $k == "f_id") {
					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%" ';
				}
				if (!empty($v) && $k == "f_food") {
					$ajaxsearch_query .= ' AND FoodName LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_unit") {
					$ajaxsearch_query .= ' AND NutritionUnit LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_type") {
					$ajaxsearch_query .= ' AND VegNonVeg LIKE "%' . $v . '%"';
				}


				if (!empty($v) && $k == "f_food_type") {
					$ajaxsearch_query .= ' AND FoodType = "' . $v . '"';
				}


				if ($ajaxsearch != '') {
					$ajaxsearch_query .= ' AND CONCAT(FoodType) LIKE "%' . $ajaxsearch . '%" ';
				}
			}
		}
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

			if ($ajaxsearch_query == "") {
				$sql = 'SELECT * FROM `master_food_request` ';
			} else {
				$sql = 'SELECT * FROM `master_food_request` WHERE 1 ' . $ajaxsearch_query;
			}
		}

		$main_sql = $sql;
		$result = $db_connection->query($sql);
		$FoodDataArray1 = $result->getResultArray();
		$food_img = '';
		$base_url = base_url();
		
		if ($result->getNumRows() > 0) {
            // pre($result);
            $rowCount = $result->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;

            $pagesCount = ceil($rowCount / $perPageCount);
			$lowerLimit = ($pageNumber - 1) * $perPageCount;
			$sqlQuery = $main_sql . " ORDER BY `id` LIMIT $lowerLimit , $perPageCount";
			$Getresult = $db_connection->query($sqlQuery);
			$finalresult = $Getresult->getResultArray();
			$rowCount_child = $Getresult->getNumRows();
			$start_entries = $lowerLimit + 1;
			$last_entries = $start_entries + $rowCount_child - 1;
			$row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';


		foreach ($finalresult as $key => $value) {

			$food_img = !empty($value['Image']) ? base_url('assets/images/food_type/') . $value['Image'] : 'assets/image/member.png';
			if ($value['Image'] != '') {
				$targetDirectory = '' . FCPATH . 'assets/images/food_type/' . $value['Image'];
				if (!file_exists($targetDirectory)) {
					$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
				}
			} else {
				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}

			$exercise_img = '';

			if($value['Image'] != '' && intval($value['Image']) == '0' && $value['Image'] != 'undefined'){
				$exercise_img = $value['Image'];
			}


			$string = $_SERVER['DOCUMENT_ROOT'];
			$substring = 'rudrramc';
			if (strpos($string, $substring) !== false) {
				$food_img = 'https://admin.ajasys.com/assets/FoodPhotos/'.$exercise_img;
			} else {
				$food_img = 'http://localhost/admin/assets/FoodPhotos/'.$exercise_img;
			}
			if($exercise_img == ''){

				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}





			$food_type = "-";

			if (!empty($value['requestype'])) {
				$name = SecoundDBIdToFieldGetData('type', "id=" . intval($value['requestype']) . "", "master_food_type");

				if (isset($name) && !empty($name)) {
					$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				} else {
					$name = SecoundDBIdToFieldGetData('requestype', "FoodType=" . intval($value['FoodType']) . "", "master_food_request");

					if (isset($name) && !empty($name)) {
						$food_type = isset($name['requestype']) && !empty($name['requestype']) ? $name['requestype'] : '';
					}
				}
			}




			if ($value['request_status'] == "0") {
				$buttonText = 'Request';
			} elseif ($value['request_status'] == "1") {
				$buttonText = 'Approve';
			}

			if ($value['VegNonVeg'] == '1') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"/>
							<circle cx="1318" cy="1317" r="611" fill="#19C82A"/>
						</svg>
				';
			}
			if ($value['VegNonVeg'] == '2') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#FF0000"/>
							<circle cx="1318" cy="1317" r="611" fill="#FF0000"/>
						</svg>
				';
			}
			if ($value['VegNonVeg'] == '3') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#747474"/>
							<path d="M1317.5 1960.12C1033.45 1960.12 803 1686.8 803 1402.75C803 1102.62 974.5 673.875 1317.5 673.875C1660.5 673.875 1832 1102.62 1832 1402.75C1832 1686.8 1601.55 1960.12 1317.5 1960.12ZM1217.82 990.078C1235.23 974 1236.57 946.935 1220.5 929.517C1204.42 912.099 1177.35 910.759 1159.93 926.838C1095.89 985.255 1049.8 1068.06 1019.79 1152.47C989.774 1236.88 974.5 1326.91 974.5 1402.75C974.5 1426.33 993.794 1445.62 1017.38 1445.62C1040.96 1445.62 1060.25 1426.33 1060.25 1402.75C1060.25 1337.1 1073.65 1256.97 1100.71 1180.87C1127.78 1104.5 1167.71 1035.9 1217.82 990.078Z" fill="#747474"/>
						</svg>
				';
			}

			$html .= '
		<tr>
			<td class="align-middle">
			<input class="check_box table_list_check mt-2"  type="checkbox">
			</td>
			<td>
				<div>
					<div class="d-flex align-items-center flex-wrap EditFoodListDatarequest List2Food" DataTable="Master" data-bs-toggle="modal" data-bs-target="#FoodViwwModelID" data-bs-target="#foodrequest" FoodSubType = "' . $food_type . '" FoodName= "' . $value['FoodName'] . '" VegSVG = "" DataImageSRC = "' . $food_img . '" DataId = "' . $value['id'] . '">
						<div class="col-lg-5 col-md-5 col-sm-6 col-12">
							<div class="d-flex align-items-center flex-wrap">
					<img src="' . $food_img . '" alt="" class="profile-image">
								<h5 class="mx-2 fs-6">
									<span class="fw-medium">' . $value['FoodName'] . '</span>
					<span class="fw-light"> - ( ' . $food_type . ' )</span>
								</h5>
								<div class="VegNonVegSVG' . $value['id'] . '">' . $Veghtml . '</div>
						
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-6 col-12 my-1">
							<div class="d-flex align-items-center flex-wrap">
								<h5 class="mx-2 fs-6"> <span class="fw-medium">Nutr val pr.</span> <span class="fw-light"> - ' . $value['NutritionValue'] . $value['NutritionUnit'] . ' </span></h5>
							</div>
						</div>
						<div class="col-lg-5 col-md-4 col-sm-12 col-12">
							<div class="row row-cols-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-3">
								<div class="col my-1">
									<h5 class="mx-2 fs-14"> 
										<span class="fw-medium">
											<img src="' . $base_url . '/assets/image/food-m/Calories.svg" alt="Calories">
										</span> 
										<span class="fw-light"> : ' . $value['Calories'] . ' </span>
									</h5>
								</div>
								<div class="col my-1">
									<h5 class="mx-2 fs-14"> 
										<span class="fw-medium">
											<img src="' . $base_url . '/assets/image/food-m/Protein.svg" alt="Protein">
										</span> 
										<span class="fw-light"> : ' . $value['Protein'] . ' </span>
									</h5>
								</div>
								<div class="col my-1">
									<h5 class="mx-2 fs-14"> 
										<span class="fw-medium">
											<img src="' . $base_url . '/assets/image/food-m/Carbons.svg" alt="Carbons">
										</span> 
										<span class="fw-light"> : ' . $value['Carbs'] . ' </span>
									</h5>
								</div>
								<div class="col my-1">
									<h5 class="mx-2 fs-14"> 
										<span class="fw-medium">
											<img src="' . $base_url . '/assets/image/food-m/Fats.svg" alt="Fats">
										</span> 
										<span class="fw-light"> : ' . $value['Fats'] . ' </span>
									</h5>
								</div>
								<div class="col my-1">
									<h5 class="mx-2 fs-14"> 
										<span class="fw-medium">
											<img src="' . $base_url . '/assets/image/food-m/Fiber.svg" alt="Fiber">
										</span> 
										<span class="fw-light"> : ' . $value['Fiber'] . ' </span>
									</h5>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</td>
		   </tr>';
		}

			$Rresult['row_count_html'] = $row_count_html;
			$Rresult['total_page'] = $pagesCount;
			$Rresult['html'] = $html;
			$Rresult['response'] = 1;

		}else{
			$Rresult['row_count_html'] = $row_count_html;
			$Rresult['row_count_html'] = "Page 0 of 0";

			$Rresult['html'] = $html;
			$Rresult['response'] = 1;
		}

		// if (!empty($html)) {
		// 	$Rresult['html'] = $html;
		// } else {
			// 	$Rresult['html'] = '<p style="text-align:center;">Data Not Found</p>';
		// }
		
		return json_encode($Rresult);
		die();

		$table_name = $_POST['table'];
		$db_connection = \Config\Database::connect('second');
		$action = $_POST['action'];
		$username = session_username($_SESSION['username']);
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$ajaxsearch_query = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			foreach ($_POST as $k => $v) {
				if (!empty($v) && $k == "f_id") {
					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%" ';
				}
				if (!empty($v) && $k == "f_food") {
					$ajaxsearch_query .= ' AND food LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_unit") {
					$ajaxsearch_query .= ' AND unit LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_type") {
					$ajaxsearch_query .= ' AND type LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_food_type") {
					$ajaxsearch_query .= ' AND food_type LIKE "%' . $v . '%"';
				}
			}
		}
		if ($ajaxsearch_query == "") {
			$sql = 'SELECT * FROM `master_food` ';
		} else {
			$sql = 'SELECT * FROM `master_food` WHERE 1 ' . $ajaxsearch_query;
		}

		$main_sql = $sql;
		$result = $db_connection->query($sql);
		$resultsss = $result->getResultArray();
		$result = array();
		$i = 1;
		$food_img = '';
		$html = "";
		foreach ($resultsss as $key => $value) {
			$food_type = "-";
			if (!empty(isset($value['food_type']))) {
				$name = SecoundDBIdToFieldGetData('type', "id=" . intval($value['food_type']) . "", "master_food_type");
				if (isset($name) && !empty($name)) {
					$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				}
			}
			// if (empty($food) || preg_match("/" . preg_quote($food, '/') . "/i", $value['food'])) {
			// 	if (empty($F_unit) || $F_unit == $value['unit']) {
			// 		if (empty($F_type) || $F_type == $value['type']) {
			// print_r($value);
			// if ($value['image'] != '' && $value['image'] != 'undefined') {
			// 	$food_img = $value['image'];
			// } else {
			// 	$food_img = 'food_image.jpg';
			// }

			$food_img = !empty($value['image']) ? base_url('assets/images/food_type/') . $value['image'] : 'assets/image/member.png';



			if ($value['image'] != '') {
				$targetDirectory = '' . FCPATH . 'assets/images/food_type/' . $value['image'];
				if (!file_exists($targetDirectory)) {
					// $food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
					$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
				}
			} else {
				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}





			$html .= '<tr>			
			<td style="width:0%"><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>';
			$ts = "";
			$ts .= '
			<td class="edit" data-edit_id="' . $value['id'] . '">
			<div class=" px-0 py-0 w-100 food_view" data-bs-target="#view_model" DataImageSrc = "' . $food_img . '" data-view_id="' . $value['id'] . '" data-bs-toggle="modal">
				<div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-6">
					<div class="col t-pic">
						<span class="mx-2"><b>' . $value['id'] . '</b></span>
						<span class="mx-1">
								<div class="d-flex align-items-center">
									<img width="50px" heigth="50px" src="  ' . $food_img . '" alt="" class="profile-image">
								</div
								<span class="mx-2 text-capitalize">' . strtolower($value['food']) . '</span>
						</span>									
					</div>
					<div class="col">
						<b>Unit: </b>
						<span class="mx-2">' . $value['unit'] . '</span>
					</div>
					<div class="col">
						<b>Quantity: </b>
						<span class="mx-2">' . $value['quantity'] . '</span>
					</div>
					<div class="col">
						<b>Type: </b>
						<span class="mx-2 text-capitalize">' . strtolower($value['type']) . '</span>
					</div>
					<div class="col">
						<b>Food Type: </b>
						<span class="mx-2 text-capitalize">' . strtolower($food_type) . '</span>
					</div>
					
					<div class="col">
					
					</div>
					
					<div class="col">
					<b>Small: </b>
					<span class="mx-2">' . $value['small'] . '</span>
				</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['small_protein'] . '</span>
					</div>
				
					
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['small_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['small_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['small_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['small_calories'] . '</span>
					</div>
					
						<div class="col">
							<b>Medium: </b>
							<span class="mx-2">' . $value['medium'] . '</span>
						</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['medium_protein'] . '</span>
					</div>
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['medium_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['medium_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['medium_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['medium_calories'] . '</span>
					</div>
					<div class="col">
						<b>Large: </b>
						<span class="mx-2">' . $value['large'] . '</span>
					</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['large_protein'] . '</span>
					</div>
					
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['large_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['large_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['large_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['large_calories'] . '</span>
					</div>
				</div>
			</div>
		</td>
					';
			$html .= $ts;
			$html .= '</tr>';
			$i++;
		}
		// if (!empty($html)) {
		// 	$result['html'] = $html;
		// } else {
		// 	$result['html'] = '<p style="text-align:center;">Data Not Found</p>';
		// }
			$result['html'] = $html;
		$result['response'] = 1;
		return json_encode($result);
		die();
	}


	public function MasterFoodUpdateData()
	{

		$db_connection = \Config\Database::connect('second');
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");

		$FoodType = $_POST['FoodType'];


		$insert_data = [
			'type' => $FoodType,
		];

		if (!is_numeric($FoodType)) {
			$existing_entry = duplicate_data2($insert_data, 'master_food_type');

			if ($existing_entry == 0) {
				$this->MasterInformationModel->insert_entry2($insert_data, 'master_food_type');
				$lastInsertID = $db_connection->insertID();
			} else {
				$lastInsertID = $existing_entry['id'];
			}
		} else {
			$lastInsertID = null;
		}



		$delete_id = $this->request->getPost('id');
		$db_connection = \Config\Database::connect('second');

		$sql = "UPDATE master_food_request SET requestype = NULL WHERE id = ?";
		$db_connection->query($sql, [$delete_id]);




		$EditId = $_POST['edit_id'];
		unset($_POST['edit_id']);

		$ReturnSaveStatus = 0;
		$FoodName = $_POST['FoodName'];
		$sql = "SELECT * FROM master_food_request WHERE LOWER(TRIM(REPLACE(FoodName, ' ', ''))) = '$FoodName'";
		$SecondDB = \Config\Database::connect('second');
		$result = $SecondDB->query($sql);
		// if ($result->getNumRows() > 0) {
		// 	$ReturnSaveStatus = 0;
		// } else {
		$files = $_FILES;
		$uploadedFile = '';
		$newName = '';
		if (!empty($files)) {
			$uploadDir = 'assets/images/food_type/';
			$string = $_SERVER['DOCUMENT_ROOT'];
			$substring = 'rudrramc';
			if (strpos($string, $substring) !== false) {
				$uploadDir = '/home/rudrramc/admin.ajasys.com/assets/FoodPhotos/';
			} else {
				$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/admin/assets/FoodPhotos/';
			}
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			if (isset($_FILES["images"])) {
				$filesArr = $_FILES["images"];
				$fileNames = array_filter($filesArr['name']);
				foreach ($filesArr['name'] as $key => $val) {
					$fileName = basename($filesArr['name'][$key]);
					$newName = $fileName;
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
		}
		$insert_data = $_POST;
		if ($newName != '') {
			$insert_data['Image'] = $newName;
		}
		if (!is_numeric($FoodType)) {
			$insert_data['requestype'] = $lastInsertID;
			$insert_data['FoodType'] = $lastInsertID;
		} else {
			$insert_data['requestype'] = $FoodType;
			$insert_data['FoodType'] = $FoodType;
		}


		$response = $this->MasterInformationModel->update_entry2($EditId, $insert_data, 'master_food_request');

		$ReturnSaveStatus = 1;
		// }
		$returnresult['RStuts'] = $ReturnSaveStatus;
		return json_encode($returnresult);
	}

	public function MasterFoodUpdateDataMain()
	{
		$EditId = $_POST['edit_id'];
		unset($_POST['edit_id']);
		$ReturnSaveStatus = 0;
		$FoodName = $_POST['FoodName'];
		$sql = 'SELECT * FROM master_food_items WHERE LOWER(TRIM(REPLACE(FoodName," ",""))) = "' . $FoodName . '"';
		$SecondDB = \Config\Database::connect('second');
		$result = $SecondDB->query($sql);
		// if ($result->getNumRows() > 0) {
		// 	$ReturnSaveStatus = 0;
		// } else {
		$files = $_FILES;
		$uploadedFile = '';
		$newName = '';
		if (!empty($files)) {
			$uploadDir = 'assets/images/food_type/';
			$string = $_SERVER['DOCUMENT_ROOT'];
			$substring = 'rudrramc';
			if (strpos($string, $substring) !== false) {
				$uploadDir = '/home/rudrramc/admin.ajasys.com/assets/FoodPhotos/';
			} else {
				$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/admin/assets/FoodPhotos/';
			}
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			if (isset($_FILES["images"])) {
				$filesArr = $_FILES["images"];
				$fileNames = array_filter($filesArr['name']);
				foreach ($filesArr['name'] as $key => $val) {
					$fileName = basename($filesArr['name'][$key]);
					$newName = $fileName;
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
		}
		$insert_data = $_POST;
		if ($newName != '') {
			$insert_data['Image'] = $newName;
		}
		$response = $this->MasterInformationModel->update_entry2($EditId, $insert_data, 'master_food_items');
		$ReturnSaveStatus = 1;
		// }
		$returnresult['RStuts'] = $ReturnSaveStatus;
		return json_encode($returnresult);
		die();
		$db_connection = \Config\Database::connect('second');
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");

		$FoodType = $_POST['FoodType'];


		$insert_data = [
			'type' => $FoodType,
		];

		if (!is_numeric($FoodType)) {
			$existing_entry = duplicate_data2($insert_data, 'master_food_type');

			if ($existing_entry == 0) {
				$this->MasterInformationModel->insert_entry2($insert_data, 'master_food_type');
				$lastInsertID = $db_connection->insertID();
			} else {
				$lastInsertID = $existing_entry['id'];
			}
		} else {
			$lastInsertID = null;
		}



		$delete_id = $this->request->getPost('id');
		$db_connection = \Config\Database::connect('second');

		$sql = "UPDATE master_food_request SET requestype = NULL WHERE id = ?";
		$db_connection->query($sql, [$delete_id]);




		$EditId = $_POST['edit_id'];
		unset($_POST['edit_id']);

		$ReturnSaveStatus = 0;
		$FoodName = $_POST['FoodName'];
		$sql = "SELECT * FROM master_food_request WHERE LOWER(TRIM(REPLACE(FoodName, ' ', ''))) = '$FoodName'";
		$SecondDB = \Config\Database::connect('second');
		$result = $SecondDB->query($sql);
		// if ($result->getNumRows() > 0) {
		// 	$ReturnSaveStatus = 0;
		// } else {
		$files = $_FILES;
		$uploadedFile = '';
		$newName = '';
		if (!empty($files)) {
			$uploadDir = 'assets/images/food_type/';
			$string = $_SERVER['DOCUMENT_ROOT'];
			$substring = 'rudrramc';
			if (strpos($string, $substring) !== false) {
				$uploadDir = '/home/rudrramc/admin.ajasys.com/assets/FoodPhotos/';
			} else {
				$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/admin/assets/FoodPhotos/';
			}
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			if (isset($_FILES["images"])) {
				$filesArr = $_FILES["images"];
				$fileNames = array_filter($filesArr['name']);
				foreach ($filesArr['name'] as $key => $val) {
					$fileName = basename($filesArr['name'][$key]);
					$newName = $fileName;
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
		}
		$insert_data = $_POST;
		if ($newName != '') {
			$insert_data['Image'] = $newName;
		}
		if (!is_numeric($FoodType)) {
			$insert_data['requestype'] = $lastInsertID;
			$insert_data['FoodType'] = $lastInsertID;
		} else {
			$insert_data['requestype'] = $FoodType;
			$insert_data['FoodType'] = $FoodType;
		}


		$response = $this->MasterInformationModel->update_entry2($EditId, $insert_data, 'master_exercise');

		$ReturnSaveStatus = 1;
		// }
		$returnresult['RStuts'] = $ReturnSaveStatus;
		return json_encode($returnresult);
	}

	public function requestFoodUpdateData()
	{
		// die();
		$EditId = $_POST['edit_id'];
		unset($_POST['edit_id']);
		$ReturnSaveStatus = 0;
		$FoodName = $_POST['FoodName'];
		$sql = 'SELECT * FROM master_food_request WHERE LOWER(TRIM(REPLACE(FoodName," ",""))) = "' . $FoodName . '"';
		$SecondDB = \Config\Database::connect('second');
		$result = $SecondDB->query($sql);
		if ($result->getNumRows() > 0) {
			$ReturnSaveStatus = 0;
		} else {
			$files = $_FILES;
			$uploadedFile = '';
			$newName = '';
			if (!empty($files)) {
				$uploadDir = 'assets/images/food_type/';
				if (!is_dir($uploadDir)) {
					mkdir($uploadDir, 0755, true);
				}
				if (isset($_FILES["images"])) {
					$filesArr = $_FILES["images"];
					$fileNames = array_filter($filesArr['name']);
					foreach ($filesArr['name'] as $key => $val) {
						$fileName = basename($filesArr['name'][$key]);
						$newName = $fileName;
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
			}
			$insert_data = $_POST;
			if ($newName != '') {
				$insert_data['Image'] = $newName;
			}
			$response = $this->MasterInformationModel->update_entry2($EditId, $insert_data, 'master_food_request');
			$ReturnSaveStatus = 1;
		}
		$returnresult['RStuts'] = $ReturnSaveStatus;
		return json_encode($returnresult);
	}


	public function Food_delete_data()
	{

		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			$delete_displaydata = $this->MasterInformationModel->delete_entry3($table_name, $delete_id);
		}
		die();
	}

	public function Foodtype_delete_data()
	{

		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$set_id = $this->request->getPost('setvalue');

			$table_name = $this->request->getPost('table');
			$db_connection = \Config\Database::connect('second');

			$sql = "UPDATE $table_name SET requestype = $set_id WHERE id = ?";
			$db_connection->query($sql, [$delete_id]);
		}
		die();
	}

	// public function subtypetype_delete_data()
	// {
	// 	if ($this->request->getPost("action") == "delete") {
	// 		$delete_id = $this->request->getPost('id');
	// 		$set_id = $this->request->getPost('setvalue');

	// 		$table_name = $this->request->getPost('table');
	// 		$db_connection = \Config\Database::connect('second');

	// 		$sql = "UPDATE $table_name SET requestsubtype = ? WHERE id = ?";
	// 		$db_connection->query($sql, [$set_id, $delete_id]);
	// 	}

	// 	die();
	// }



	public function subtypetype_delete_data()
	{


		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$set_id = $this->request->getPost('setdata');

			$table_name = $this->request->getPost('table');
			$db_connection = \Config\Database::connect('second');

			$sql = "UPDATE $table_name SET requestsubtype = $set_id WHERE id = ?";
			$db_connection->query($sql, [$delete_id]);
		}
		die();
	}

	public function exercisetype_delete_data()
	{

		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$set_id = $this->request->getPost('setdata');

			$table_name = $this->request->getPost('table');
			$db_connection = \Config\Database::connect('second');

			$sql = "UPDATE $table_name SET requesttype = $set_id WHERE id = $delete_id";
			$db_connection->query($sql, [$set_id, $delete_id]);
		}

		die();
	}






	// edit data 
	public function department_edit_data()
	{
		if ($this->request->getPost("action") == "edit") {
			$edit_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);
			return json_encode($departmentEditdata, true);
		}
		die();
	}

	// public function master_food_update()
	// {
	// 	if ($this->request->getPost("action") == "edit") {
	// 		$edit_id = $this->request->getPost('id');
	// 		$table_name = $this->request->getPost('table');
	// 		$departmentEditdata = $this->MasterInformationModel->update_entry2($table_name, $edit_id);
	// 		return json_encode($departmentEditdata, true);
	// 	}
	// 	die();
	// }

	public function master_food_update()
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


	public function master_foodtype_update()
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

	// 	public function master_food_update()
	// 	{
	//     $post_data = $this->request->getPost();
	//     $table_name = $this->request->getPost("table");
	//     $action_name = $this->request->getPost("action");
	//     $update_id = $this->request->getPost("id");
	//     $response = 0;
	// 	$db_connection = \Config\Database::connect('second');


	//     if ($this->request->getPost("action") == "update") {
	//         unset($_POST['action']);
	//         unset($_POST['id']);
	//         unset($_POST['table']);

	//         if (!empty($post_data)) {
	//             $update_data = $_POST;

	// 			$sql = "SELECT * FROM master_food_request WHERE id = $update_id";

	// 			$main_sql = $sql;
	// 			$result = $db_connection->query($sql);
	// 			$updated_record = $result->getResultArray();
	//             if (!empty($updated_record) && isset($updated_record['FoodName'])) {
	//                 $status = $updated_record['request_status'];

	//                 if ($status == 1) {
	//                     $insert_data = array(

	// 						'id' => $updated_record['id'],
	//                         'FoodName' => $updated_record['FoodName'],
	//                         'VegNonVeg' => $updated_record['VegNonVeg'],
	//                         'FoodType' => $updated_record['FoodType'],
	//                         'Image' => $updated_record['Image'],
	//                         'NutritionValue' => $updated_record['NutritionValue'],
	//                         'NutritionUnit' => $updated_record['NutritionUnit'],
	//                         'Calories' => $updated_record['Calories'],
	//                         'Carbs' => $updated_record['Carbs'],
	//                         'Protein' => $updated_record['Protein'],
	//                         'Fats' => $updated_record['Fats'],
	//                         'Fiber' => $updated_record['Fiber'],
	//                         'Measurement' => $updated_record['Measurement'],
	//                         'MeasurementUnitStoreArray' => $updated_record['MeasurementUnitStoreArray'],
	//                         'CreatedAt' => date('Y-m-d H:i:s') 
	//                     );

	//                     $this->MasterInformationModel->insert_entry($insert_data, 'master_food_items');
	//                 }

	//                 $this->MasterInformationModel->delete_entry($update_id, 'master_food_request');

	//                 $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
	//                 $departmentdisplaydata = json_decode($departmentdisplaydata, true);
	//                 $response = 1;
	//             } else {
	//                 return "error"; 
	//             }
	//         }
	//     }

	//     echo $response;
	//     die();
	// }

	public function master_food_update_insert()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("id");
		$response = 0;

		$db_connection = \Config\Database::connect('second');

		if ($action_name == "update") {
			unset($post_data['action']);
			unset($post_data['id']);
			unset($post_data['table']);

			if (!empty($post_data)) {
				$sql = "SELECT * FROM master_food_request WHERE id = ?";
				$result = $db_connection->query($sql, [$update_id]);

				$updated_record = $result->getRowArray();
				$status = $updated_record['request_status'];

				if ($status == 1) {
					$insert_data = [
						// 'id' => $updated_record['id'],
						'FoodName' => $updated_record['FoodName'],
						'VegNonVeg' => $updated_record['VegNonVeg'],
						'FoodType' => $updated_record['FoodType'],
						'Image' => $updated_record['Image'],
						'NutritionValue' => $updated_record['NutritionValue'],
						'NutritionUnit' => $updated_record['NutritionUnit'],
						'Calories' => $updated_record['Calories'],
						'Carbs' => $updated_record['Carbs'],
						'Protein' => $updated_record['Protein'],
						'Fats' => $updated_record['Fats'],
						'Fiber' => $updated_record['Fiber'],
						'Measurement' => $updated_record['Measurement'],
						'MeasurementUnitStoreArray' => $updated_record['MeasurementUnitStoreArray'],
						'CreatedAt' => date('Y-m-d H:i:s')
					];

					$this->MasterInformationModel->insert_entry2($insert_data, 'master_food_items');
				}

				// $this->MasterInformationModel->delete_entry3($update_id, 'master_food_request');

				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;
			}
		}

		echo $response;
		die();
	}


	public function master_exercisetype_update_insert()
	{

		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("id");
		$response = 0;

		$db_connection = \Config\Database::connect('second');

		if ($action_name == "update") {
			unset($post_data['action']);
			unset($post_data['id']);
			unset($post_data['table']);

			if (!empty($post_data)) {
				$sql = "SELECT * FROM master_exercise_request WHERE id = ?";
				$result = $db_connection->query($sql, [$update_id]);

				$updated_record = $result->getRowArray();
				$status = $updated_record['request_status'];

				$insert_data = [
					'e_type' => $updated_record['requesttype'],
				];

				$this->MasterInformationModel->insert_entry2($insert_data, 'master_exercise_type');
				$lastInsertID = $db_connection->insertID();

				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);

				$response = 1;
				// $DataBase = \Config\Database::connect('default');
				// $lastInsertID = $DataBase->insertID();
			}
			echo $lastInsertID;
		}
		die();
	}


	public function master_foodtype_update_insert()
	{

		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("id");
		$response = 0;

		$db_connection = \Config\Database::connect('second');

		if ($action_name == "update") {
			unset($post_data['action']);
			unset($post_data['id']);
			unset($post_data['table']);

			if (!empty($post_data)) {
				$sql = "SELECT * FROM master_food_request WHERE id = ?";
				$result = $db_connection->query($sql, [$update_id]);

				$updated_record = $result->getRowArray();
				$status = $updated_record['FoodTypeRequest'];

				$insert_data = [
					'type' => $updated_record['requestype'],

				];

				$this->MasterInformationModel->insert_entry2($insert_data, 'master_food_type');
				$lastInsertID = $db_connection->insertID();



				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;

				// $DataBase = \Config\Database::connect('default');
				// $lastInsertID = $DataBase->insertID();
			}
			echo $lastInsertID;
		}


		die();
	}


	public function master_exercisesubtype_update_insert()
	{

		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("id");
		$response = 0;

		$db_connection = \Config\Database::connect('second');

		if ($action_name == "update") {
			unset($post_data['action']);
			unset($post_data['id']);
			unset($post_data['table']);

			if (!empty($post_data)) {
				$sql = "SELECT * FROM master_exercise_request WHERE id = ?";
				$result = $db_connection->query($sql, [$update_id]);

				$updated_record = $result->getRowArray();
				$status = $updated_record['request_status'];

				$insert_data = [
					'e_type' => $updated_record['requestsubtype'],

				];

				$this->MasterInformationModel->insert_entry2($insert_data, 'master_exercise_sub_type');
				$lastInsertID = $db_connection->insertID();


				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;
				// $DataBase = \Config\Database::connect('default');
				// $lastInsertID = $DataBase->insertID();
			}
			echo $lastInsertID;
		}

		die();
	}



	public function view_data()
	{
		if ($this->request->getPost("action") == "view") {
			$view_id = $this->request->getPost('view_id');
			$table_name = $this->request->getPost('table');
			$userEditdata = $this->MasterInformationModel->edit_entry2($table_name, $view_id);
			$userEditdata1 = get_object_vars($userEditdata[0]);
			
			if(isset($userEditdata1['start_date'] ) && !empty($userEditdata1['start_date']))
            {
                $start_format_date = date('d-m-Y',strtotime($userEditdata1['start_date']));
            }else{
                $start_format_date = "";
            }
            if(isset($userEditdata1['end_date'] ) && !empty($userEditdata1['end_date']))
            {
                $end_format_date = date('d-m-Y',strtotime($userEditdata1['end_date']));

            }else{
                $end_format_date = "";
            }
			$userEditdata1 = reset($userEditdata);
			if (isset($userEditdata1->product_type)) {
				$userEditdata['product'] = $this->MasterInformationModel->edit_entry2('admin_product', $userEditdata1->product_type);
			}
			$userEditdata['start_formated_date'] = $start_format_date;
            $userEditdata['end_formated_date'] = $end_format_date;
			return json_encode($userEditdata, true);
		}
		// die();
	}
	// update data 
	public function department_updatedata()
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
	// delete data 
	public function department_delete()
	{
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('id');
			$table_name = $this->request->getPost('table');
			$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($table_name, $delete_id);
		}
		die();
	}
	// occ type
	public function insert_data()
	{
		$integrations_type = "";
		if (isset($_POST['integration_type'])) {
			$integration_type2 = $_POST['integration_type'];
			$integrations_type = implode(',', $integration_type2);
		}
		$reports_name = "";
		if (isset($_POST['reports_name'])) {
			$reports_name2 = $_POST['reports_name'];
			$reports_name = implode(',', $reports_name2);
		}
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			unset($_POST['reports_name']);
			if (!empty($_POST)) {
				$insert_data = $_POST;

				if (isset($reports_name) && !empty($reports_name)) {
					$insert_data['reports_name'] = $reports_name;
				}
				if (isset($integrations_type) && !empty($integrations_type)) {
					$insert_data['integration_type'] = $integrations_type;
				}
				$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
			}
		}
		die();
	}
	// list data 
	public function subscription_list()
	{
		$html = "";
		$row_count_html = '';
		$return_array = array(
			'row_count_html' => '',
			'html' => '',
			'total_page' => 0,
			'response' => 0
		);
		$perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
		$pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
		// $which_result = isset($_POST['follow_up_day']) && !empty($_POST['follow_up_day']) ? $_POST['follow_up_day'] : '';
		// $not_valid_status = '"0"';
		$stutus_data_html = "";
		$return_array['stutus_data_allow'] = 0;
		$sql = "SELECT * FROM  `admin_subscription_master`";
		$main_sql = $sql;
		// pre($_SESSION);
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}
		$secondDb = \Config\Database::connect('second');
		$result = $secondDb->query($sql);
		if ($result->getNumRows() > 0) {
			$rowCount = $result->getNumRows();
			$total_no_of_pages = $rowCount;
			$second_last = $total_no_of_pages - 1;
			$pagesCount = ceil($rowCount / $perPageCount);
			$lowerLimit = ($pageNumber - 1) * $perPageCount;
			$sqlQuery = $main_sql . " ORDER BY `id` DESC LIMIT $lowerLimit , $perPageCount";
			$Getresult = $secondDb->query($sqlQuery);
			$subscribtion_all_data = $Getresult->getResultArray();
			$rowCount_child = $Getresult->getNumRows();
			$start_entries = $lowerLimit + 1;
			$last_entries = $start_entries + $rowCount_child - 1;
			$row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
			foreach ($subscribtion_all_data as $key => $value) {
				if ($value['hr_form'] == 1) {
					$hr_form = "Yes";
				} else {
					$hr_form = "No";
				}
				if ($value['sms'] == 1) {
					$sms = "Yes";
				} else {
					$sms = "No";
				}
				if ($value['email'] == 1) {
					$email = "Yes";
				} else {
					$email = "No";
				}
				if ($value['whatsapp'] == 1) {
					$whatsapp = "Yes";
				} else {
					$whatsapp = "No";
				}
				if ($value['account_module'] == 1) {
					$account_module = "Yes";
				} else {
					$account_module = "No";
				}
				$html .= '<tr>';
				$html .= '
								<td class="align-middle">
									<input class="checkbox" type="checkbox" value="' . $value['id'] . '"/>
								</td>
								<td class="d-flex "  id="people_list_model">
								   <div class="bg-white py-2 w-100 master_subscribtion_view"';
				if (in_array('subscription_management_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$html .= '    data-bs-toggle="modal"
									  data-bs-target="#master_subscribtion_view"';
				};
				$html .= ' id="people_list_model" data-view_id="' . $value['id'] . '">
									  <div
										 class="people-list-content d-flex align-items-center justify-content-start flex-wrap col-12">
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
											  <div class=" d-flex me-2">
													<b>' . $value['id'] . '</b>
											  </div>
										   <p>Plan Name : </p>
										   <span class="mx-1">' . $value['plan_name'] . '</span>
										  </div>	
										 <div class="d-flex col align-items-center 3 ">
											  <p>
											  User :
											  </p>
											  <span class="mx-1">' . $value['user'] . '</span>
										 </div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
											<p>Project : </p>
											<span class="mx-1">' . $value['project'] . '</span>
										 </div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
											<span class="" style=" word-break: break-all;"> <b class="text-body-secondary">Leads Integration : </b>' . $value['integration_type'] . '</span>
										 </div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
											<p>Plan In Rupees (₹) : </p>
											<span class="mx-1">' . $value['plan_price'] . '</span>
										</div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
											<p>Plan In Dollar : </p>
											<span class="mx-1">' . $value['plan_dollar'] . '</span>
										</div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
										 <p>Property Limit : </p>
										 <span class="mx-1">' . $value['property_type'] . '</span>
										</div>
									  	<div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
										 <p>Hr : </p>
										 <span class="mx-1">' . $hr_form . '</span>
										 </div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
										 <p>Sms : </p>
										 <span class="mx-1">' . $sms . '</span>
										 </div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
										 <p>Email : </p>
										 <span class="mx-1">' . $email . '</span>
										 </div>
										 <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
										 <p>Whatsapp : </p>
										 <span class="mx-1">' . $whatsapp . '</span>
										 </div>
										<div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
											<p>Account Module : </p>
											<span class="mx-1">' . $account_module . '</span>
										</div>
										<div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3 ">
											<p>Validity : </p>
											<span class="mx-1">' . $value['validity'] . '</span>
										</div>
									  </div>
								   </div>
								</td>';
				$html .= '</tr>';
				//}
			}
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
			$return_array['html'] = '<td></td><td style="text-align:center;">Data Not Found </td>';
		}
		echo json_encode($return_array);
		die();
	}
	// public function duplicate_data($data, $table)
	// {
	// 	$secondDb = \Config\Database::connect('second');
	// 	$i = 0;
	// 	$data_duplicat_Query = "";
	// 	$numItems = count($data);
	// 	foreach ($data as $datakey => $data_value) {
	// 		if ($i == $numItems - 1) {
	// 			$data_duplicat_Query .= 'LOWER(TRIM(REPLACE(' . $datakey . ', " ",""))) = "' . strtolower(trim(str_replace(' ', '', $data_value))) . '"';
	// 		} else {
	// 			$data_duplicat_Query .= 'LOWER(TRIM(REPLACE(' . $datakey . '," ",""))) = "' . strtolower(trim(str_replace(' ', '', $data_value))) . '" AND ';
	// 		}
	// 		$i++;
	// 	}
	// 	$sql = 'SELECT * FROM ' . $table . ' WHERE ' . $data_duplicat_Query;
	// 	$result = $secondDb->query($sql);
	// 	if ($result->getNumRows() > 0) {
	// 		return TRUE;
	// 	} else {
	// 		return FALSE;
	// 	}
	// }
	//edit data
	public function edit_data()
	{
		if ($this->request->getPost("action") == "edit") {
			$edit_id = $this->request->getPost('edit_id');
			$table_name = $this->request->getPost('table');
			$username = session_username($_SESSION['username']);
			$departmentEditdata = $this->MasterInformationModel->edit_entry2($username . "_" . $table_name, $edit_id);
			return json_encode($departmentEditdata, true);
		}
		die();
	}

	public function edit_data_coupan()
	{
		if ($this->request->getPost("action") == "edit") {
			$edit_id = $this->request->getPost('edit_id');
			$table_name = $this->request->getPost('table');
			$username = session_username($_SESSION['username']);
			$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);
			return json_encode($departmentEditdata, true);
		}
		die();
	}
	//task view and comments view
	public function show_task_comments()
	{
		$task_id = $_POST['edit_id'];
		$table = $_POST['table'];
		$databs = db_connect('second');
		$sql_comment_show = "SELECT * FROM " . $this->username . "_task_comments WHERE task_id = " . $task_id;
		$result_comment_show = $databs->query($sql_comment_show);
		$comment_count_show = $result_comment_show->getResultArray();
		$html = '';
		$count = '';
		if ($result_comment_show->getNumRows() > 0) {
			$commentNumber = 0;
			$html .= '<div id="task_comment_list">';
			foreach ($comment_count_show as $key => $value) {
				$commentNumber++;
				$html .= '
					<div class="task-comment-box shadow-sm rounded-2 my-2 slice_div_comment_' . $value['id'] . '">
						<div class="task-comment-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between">
							<p class="text-body-tertiary fw-medium">' . $commentNumber . '</p>
							<div class="comment-header-icons">
								<div class="comment-icons delete_comment_btn" data-delete_id ="' . $value['id'] . '" >
									<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;">
										<polyline points="3 6 5 6 21 6"></polyline>
										<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
									</svg>
								</div>
							</div>
						</div>
						<div class="task-comment-body px-3 py-2">
							' . $value['comment'] . '
						</div>
					</div>
							';
			}
			$html .= '</div>';
		} else {
			$html = '<div class="shadow-sm rounded-2 p-4 text-center">No Task Comments</div>';
		}
		// print_r($html);
		return $html;
	}
	public function update_data()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$reports_name = "";
		if (isset($_POST['reports_name'])) {
			$reports_name2 = $_POST['reports_name'];
			$reports_name = implode(',', $reports_name2);
		}
		$integrations_type = "";
		if (isset($_POST['integration_type'])) {
			$integration_type2 = $_POST['integration_type'];
			$integrations_type = implode(',', $integration_type2);
		}
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			//print_r($_POST);
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			unset($_POST['reports_name']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				//pre($integrations_type);
				if ($reports_name != '') {
					$update_data['reports_name'] = $reports_name;
				}
				if ($integrations_type != '') {
					$update_data['integration_type'] = $integrations_type;
				}
				// $isduplicate = $this->duplicate_data($update_data, $table_name);
				// if ($isduplicate == 0) {
				$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
				$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
				$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				$response = 1;
				// } else {
				// 	return "error";
				// }
			}
		}
		echo $response;
		die();
	}
	public function task_status_update_data()
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}

		$status_id = $this->request->getPost("status_id");
		$table_name = $this->request->getPost("table");
		$update_id = $this->request->getPost("id");
		$type = $this->request->getPost("type");

		// if($status_id == 2)
		// {
		// 	if($status_id ==2)
		// 	{
		// 		$time = date('h:i:s', time());
		// 	}else if($time !="")
		// 	{

		// 	}
		// }

		// pre($time);
		// die();
		$ispermission = 0;
		if ($type == 1) {
			// if (in_array('task_manage_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
			$ispermission = 1;
			// }
		} else if ($type == 2) {
			// if (in_array('task_manage_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
			$ispermission = 1;
			// }
		} else if ($type == 3) {
			// if (in_array('task_manage_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
			$ispermission = 1;
			// }
		}

		if ($ispermission == 1) {
			if (isset($status_id) && isset($update_id)) {
				// $time = date('h:i:s', time());
				// if ($status_id == 2) {
				// 	$update_data['start_time_task'] = $time;
				// }
				// if ($status_id != 2 && isset($status_id) && isset($update_id)) {
				// 	// Update end_time to current time
				// 	$update_data['end_time_task'] = $time;
				// }
				$time_array = array();
				$time = date('d-m-Y h:i A', time());
				$query = "SELECT * FROM " . $this->username . "_" . $table_name . " WHERE id = $update_id ";
				$db_connection = \Config\Database::connect('second');
				$result50 = $db_connection->query($query);
				$old_entry = $result50->getResultArray();

				if ($status_id == 2) {
					$old_start_time = json_decode($old_entry[0]['start_time_task'], true);

					$formatted_start_time = ['formatted_start_time' => $time];

					if ($old_start_time === null) {
						$update_data50['start_time_task'] = json_encode([$formatted_start_time]);
					} else {
						$combined_start_time = array_merge($old_start_time, [$formatted_start_time]);
						$update_data50['start_time_task'] = json_encode($combined_start_time);
					}
					$update_data50['status_check'] = 2;
					$update50 = $this->MasterInformationModel->update_entry2($update_id, $update_data50, $this->username . "_" . $table_name);
				}

				$update_data['status'] = $status_id;

				$update = $this->MasterInformationModel->update_entry2($update_id, $update_data, $this->username . "_" . $table_name);

				$queryyy = "SELECT * FROM admin_tasks WHERE id = " . $update_id;
				$db_connection = \Config\Database::connect('second');
				$task_result = $db_connection->query($queryyy);
				$all_data = $task_result->getResultArray();
				$full_data_status = $all_data[0]['status_check'];
				$new_status = $all_data[0]['status'];

				$allowed_status_ids = [2];
				if ($new_status != 2 && $full_data_status == 2 && isset($status_id) && isset($update_id)) {
					$old_start_time = json_decode($old_entry[0]['end_time_task'], true);

					$formatted_start_time = ['end_time_task' => $time];

					if ($old_start_time === null) {
						$update_data50['end_time_task'] = json_encode([$formatted_start_time]);
					} else {
						$combined_start_time = array_merge($old_start_time, [$formatted_start_time]);
						$update_data50['end_time_task'] = json_encode($combined_start_time);
					}
					$update_data50['status_check'] = 0;

					$update50 = $this->MasterInformationModel->update_entry2($update_id, $update_data50, $this->username . "_" . $table_name);
				}
				$result['response'] = 1;
				$result['message'] = 'Status Updated Successfully !';
			} else {
				$result['response'] = 0;
				$result['message'] = 'Status Can Not Updated Successfully !';
			}
		} else {
			$result['response'] = 0;
			$result['message'] = 'Grant Paramission to Status..!';
		}



		return json_encode($result);
	}
	//delete
	public function delete_data()
	{
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('del_id');
			$table_name = $this->request->getPost('table');
			$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($table_name, $delete_id);
		}
		die();
	}



	public function delete_data_secound_db()
	{

		if ($this->request->getPost("action") == "delete") {

			$delete_id = $this->request->getPost('id');

			// $username = session_username($_SESSION['username']);

			$table_name = $this->request->getPost('table');

			$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($table_name, $delete_id);

			//print_r($departmentdisplaydata);

			//die();

		}

		die();
	}

	// ****************************** inquiry source show ****************************** //
	public function inquiry_source_show_list_data()
	{
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		$table1 = $this->request->getPost("table1");
		$table2 = $this->request->getPost("table2");
		$field1 = $this->request->getPost("field1");
		$field2 = $this->request->getPost("field2");
		$i = 1;
		$html = "";
		if ($table1 != "" && $table2 != "" && $field1 != "" && $field2 != "") {
			$table_join = $this->MasterInformationModel->inquiry_souece_join_entry2($table2, $table1, $field2, $field1);
			$table_join = json_decode(json_encode($table_join), true);
		} else {
			$html .= '<tr>
						<td></td>
						<td class="text-center"> Not Find Table or fields</td>
					</tr>';
			echo $html;
			die();
		}
		// pre($table_join);
		if (!empty($table_join)) {
			foreach ($table_join as $k => $value) {
				//pre($value);
				$list_id = $value[array_key_first($value)];
				$html .= '<tr>';
				$html .= '<td><input class="checkbox" type="checkbox" value="' . $value['id'] . '" / ></td>';
				$html .= '<td class="' . $table1 . '_edit ' . $table1 . '_delete" data-bs-toggle="modal" data-bs-target="#' . $table1 . '_update" data-edit_id="' . $list_id . '">
						<div class="d-flex">
							<span class="fw-medium me-2">' . $value['id'] . '</span>
							<div class="d-flex align-items-center flex-wrap word-break-all flex-fill">
								<span class="col-lg-4 col-md-4 col-sm-6 col-12">' . $value['inquiry_source_type'] . '</span>
								<span class="col-lg-4 col-md-4 col-sm-6 col-12">' . $value['source'] . '</span>
								<span class="col-lg-4 col-md-4 col-sm-6 col-12">' . $value['description'] . '</span>
							</div>
						</div>
						</td>';
				$ts = "";
				$html .= $ts;
				$html .= '</tr>';
				$i++;
			}
		} else {
			$html .= '<tr>
			<td></td>
			<td class="text-center"> Data Not fetch </td>
					</tr>';
			echo $html;
			die();
		}
		if (!empty($html)) {
			echo $html;
		} else {
			echo '<tr><td></td><td class="text-center">Data Not Found</td></tr>';
		}
		die();
	}
	//property edit update delete
	public function property_insert_data()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;
				$isduplicate = $this->duplicate_data($insert_data, $this->username . "_" . $table_name);
				if ($isduplicate == 0) {
					$response = $this->MasterInformationModel->insert_entry($insert_data, $this->username . "_" . $table_name);
					$departmentdisplaydata = $this->MasterInformationModel->display_all_records($this->username . "_" . $table_name);
					$departmentdisplaydata = json_decode($departmentdisplaydata, true);
				} else {
					return "error";
				}
			}
		}
		die();
	}

	public function food_list_data()
	{
		// print_r($_POST);

		$table_name = $_POST['table'];
		$db_connection = \Config\Database::connect('second');
		$action = $_POST['action'];
		// $username = session_username($_SESSION['username']);
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$ajaxsearch_query = '';
		$html = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			foreach ($_POST as $k => $v) {
				if (!empty($v) && $k == "f_id") {
					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%" ';
				}
				if (!empty($v) && $k == "f_food") {
					$ajaxsearch_query .= ' AND FoodName LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_unit") {
					$ajaxsearch_query .= ' AND NutritionUnit LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_type") {
					$ajaxsearch_query .= ' AND VegNonVeg LIKE "%' . $v . '%"';
				}


				if (!empty($v) && $k == "f_food_type") {
					$ajaxsearch_query .= ' AND FoodType = "' . $v . '"';
				}


				if ($ajaxsearch != '') {
					$ajaxsearch_query .= ' AND CONCAT(FoodType) LIKE "%' . $ajaxsearch . '%" ';
				}
			}
		}

		if ($ajaxsearch_query == "") {
			$sql = 'SELECT * FROM `master_food_items` ';
		} else {
			$sql = 'SELECT * FROM `master_food_items` WHERE 1 ' . $ajaxsearch_query;
		}

		$main_sql = $sql;
		$result = $db_connection->query($sql);
		$FoodDataArray = $result->getResultArray();
		$food_img = '';
		$base_url = base_url();
		foreach ($FoodDataArray as $key => $value) {
			$food_img = !empty($value['Image']) ? base_url('assets/images/food_type/') . $value['Image'] : 'assets/image/member.png';
			if ($value['Image'] != '') {
				$targetDirectory = '' . FCPATH . 'assets/images/food_type/' . $value['Image'];
				if (!file_exists($targetDirectory)) {
					$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
				}
			} else {
				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}

			$food_type = "-";
			if (!empty(isset($value['FoodType']))) {
				$name = SecoundDBIdToFieldGetData('type', "id=" . intval($value['FoodType']) . "", "master_food_type");
				if (isset($name) && !empty($name)) {
					$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				}
			}



			if ($value['VegNonVeg'] == '1') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"/>
							<circle cx="1318" cy="1317" r="611" fill="#19C82A"/>
						</svg>
				';
			}
			if ($value['VegNonVeg'] == '2') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#FF0000"/>
							<circle cx="1318" cy="1317" r="611" fill="#FF0000"/>
						</svg>
				';
			}
			if ($value['VegNonVeg'] == '3') {
				$Veghtml = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#747474"/>
							<path d="M1317.5 1960.12C1033.45 1960.12 803 1686.8 803 1402.75C803 1102.62 974.5 673.875 1317.5 673.875C1660.5 673.875 1832 1102.62 1832 1402.75C1832 1686.8 1601.55 1960.12 1317.5 1960.12ZM1217.82 990.078C1235.23 974 1236.57 946.935 1220.5 929.517C1204.42 912.099 1177.35 910.759 1159.93 926.838C1095.89 985.255 1049.8 1068.06 1019.79 1152.47C989.774 1236.88 974.5 1326.91 974.5 1402.75C974.5 1426.33 993.794 1445.62 1017.38 1445.62C1040.96 1445.62 1060.25 1426.33 1060.25 1402.75C1060.25 1337.1 1073.65 1256.97 1100.71 1180.87C1127.78 1104.5 1167.71 1035.9 1217.82 990.078Z" fill="#747474"/>
						</svg>
				';
			}
			$html .= '
			<tr>
				<td class="align-middle">
					<i class="fa-solid fa-lock text-secondary-emphasis " value="1"></i>
				</td>
				<td>
					<div>
						<div class="d-flex align-items-center flex-wrap EditFoodListData"  data-bs-toggle="modal" data-bs-target="#FoodViwwModelID" data-bs-target="#foodUpdate" FoodSubType = "' . $food_type . '" FoodName= "' . $value['FoodName'] . '" VegSVG = "" DataImageSRC = "' . $food_img . '" DataId = "' . $value['id'] . '">
							<div class="col-lg-5 col-md-5 col-sm-6 col-12">
								<div class="d-flex align-items-center flex-wrap">
									<img src="' . $food_img . '" alt="" class="profile-image">
									<h5 class="mx-2 fs-6"> <span class="fw-medium">' . $value['FoodName'] . '</span> <span class="fw-light"> - ( ' . $food_type . ' )</span></h5> <div class="VegNonVegSVG' . $value['id'] . '">' . $Veghtml . '</div>';



			$html .= '			</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-6 col-12 my-1">
								<div class="d-flex align-items-center flex-wrap">
									<h5 class="mx-2 fs-6"> <span class="fw-medium">Nutr val pr.</span> <span class="fw-light"> - ' . $value['NutritionValue'] . $value['NutritionUnit'] . ' </span></h5>
								</div>
							</div>
							<div class="col-lg-5 col-md-4 col-sm-12 col-12">
								<div class="row row-cols-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-3">
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Calories.svg" alt="Calories">
											</span> 
											<span class="fw-light"> : ' . $value['Calories'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Protein.svg" alt="Protein">
											</span> 
											<span class="fw-light"> : ' . $value['Protein'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Carbons.svg" alt="Carbons">
											</span> 
											<span class="fw-light"> : ' . $value['Carbs'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Fats.svg" alt="Fats">
											</span> 
											<span class="fw-light"> : ' . $value['Fats'] . ' </span>
										</h5>
									</div>
									<div class="col my-1">
										<h5 class="mx-2 fs-14"> 
											<span class="fw-medium">
												<img src="' . $base_url . '/assets/image/food-m/Fiber.svg" alt="Fiber">
											</span> 
											<span class="fw-light"> : ' . $value['Fiber'] . ' </span>
										</h5>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</td>
	   		</tr>';
		}
		if (!empty($html)) {
			$Rresult['html'] = $html;
		} else {
			$Rresult['html'] = '<p style="text-align:center;">Data Not Found</p>';
		}
		return json_encode($Rresult);
		die();
		$table_name = $_POST['table'];
		$db_connection = \Config\Database::connect('second');
		$action = $_POST['action'];
		$username = session_username($_SESSION['username']);
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$ajaxsearch_query = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			foreach ($_POST as $k => $v) {
				if (!empty($v) && $k == "f_id") {
					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%" ';
				}
				if (!empty($v) && $k == "f_food") {
					$ajaxsearch_query .= ' AND food LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_unit") {
					$ajaxsearch_query .= ' AND unit LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_type") {
					$ajaxsearch_query .= ' AND type LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_food_type") {
					$ajaxsearch_query .= ' AND food_type LIKE "%' . $v . '%"';
				}
			}
		}
		if ($ajaxsearch_query == "") {
			$sql = 'SELECT * FROM `master_food` ';
		} else {
			$sql = 'SELECT * FROM `master_food` WHERE 1 ' . $ajaxsearch_query;
		}

		$main_sql = $sql;
		$result = $db_connection->query($sql);
		$resultsss = $result->getResultArray();
		$result = array();
		$i = 1;
		$food_img = '';
		$html = "";
		foreach ($resultsss as $key => $value) {
			$food_type = "-";
			if (!empty(isset($value['food_type']))) {
				$name = SecoundDBIdToFieldGetData('type', "id=" . intval($value['food_type']) . "", "master_food_type");
				if (isset($name) && !empty($name)) {
					$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
				}
			}
			// if (empty($food) || preg_match("/" . preg_quote($food, '/') . "/i", $value['food'])) {
			// 	if (empty($F_unit) || $F_unit == $value['unit']) {
			// 		if (empty($F_type) || $F_type == $value['type']) {
			// print_r($value);
			// if ($value['image'] != '' && $value['image'] != 'undefined') {
			// 	$food_img = $value['image'];
			// } else {
			// 	$food_img = 'food_image.jpg';
			// }

			$food_img = !empty($value['image']) ? base_url('assets/images/food_type/') . $value['image'] : 'assets/image/member.png';



			if ($value['image'] != '') {
				$targetDirectory = '' . FCPATH . 'assets/images/food_type/' . $value['image'];
				if (!file_exists($targetDirectory)) {
					// $food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
					$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
				}
			} else {
				$food_img = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
			}





			$html .= '<tr>			
			<td style="width:0%"><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>';
			$ts = "";
			$ts .= '
			<td class="edit" data-edit_id="' . $value['id'] . '">
			<div class=" px-0 py-0 w-100 food_view" data-bs-target="#view_model" DataImageSrc = "' . $food_img . '" data-view_id="' . $value['id'] . '" data-bs-toggle="modal">
				<div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-6">
					<div class="col t-pic">
						<span class="mx-2"><b>' . $value['id'] . '</b></span>
						<span class="mx-1">
								<div class="d-flex align-items-center">
									<img width="50px" heigth="50px" src="  ' . $food_img . '" alt="" class="profile-image">
								</div
								<span class="mx-2 text-capitalize">' . strtolower($value['food']) . '</span>
						</span>									
					</div>
					<div class="col">
						<b>Unit: </b>
						<span class="mx-2">' . $value['unit'] . '</span>
					</div>
					<div class="col">
						<b>Quantity: </b>
						<span class="mx-2">' . $value['quantity'] . '</span>
					</div>
					<div class="col">
						<b>Type: </b>
						<span class="mx-2 text-capitalize">' . strtolower($value['type']) . '</span>
					</div>
					<div class="col">
						<b>Food Type: </b>
						<span class="mx-2 text-capitalize">' . strtolower($food_type) . '</span>
					</div>
					
					<div class="col">
					
					</div>
					
					<div class="col">
					<b>Small: </b>
					<span class="mx-2">' . $value['small'] . '</span>
				</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['small_protein'] . '</span>
					</div>
				
					
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['small_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['small_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['small_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['small_calories'] . '</span>
					</div>
					
						<div class="col">
							<b>Medium: </b>
							<span class="mx-2">' . $value['medium'] . '</span>
						</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['medium_protein'] . '</span>
					</div>
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['medium_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['medium_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['medium_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['medium_calories'] . '</span>
					</div>
					<div class="col">
						<b>Large: </b>
						<span class="mx-2">' . $value['large'] . '</span>
					</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['large_protein'] . '</span>
					</div>
					
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['large_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['large_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['large_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Calories: </b>
						<span class="mx-2">' . $value['large_calories'] . '</span>
					</div>
				</div>
			</div>
		</td>
					';
			$html .= $ts;
			$html .= '</tr>';
			$i++;
		}
		if (!empty($html)) {
			$result['html'] = $html;
		} else {
			$result['html'] = '<p style="text-align:center;">Data Not Found</p>';
		}
		return json_encode($result);
		die();
	}
	//food
	public function MasterFoodInsertData()
	{

		$ReturnSaveStatus = 0;
		$FoodName = $_POST['FoodName'];

		$sql = 'SELECT * FROM master_food_items WHERE LOWER(TRIM(REPLACE(FoodName," ",""))) = "' . $FoodName . '"';
		$SecondDB = \Config\Database::connect('second');
		$result = $SecondDB->query($sql);
		if ($result->getNumRows() > 0) {
			$ReturnSaveStatus = 0;
		} else {
			$files = $_FILES;
			$uploadedFile = '';
			$newName = '';
			if (!empty($files)) {
				$uploadDir = 'assets/images/food_type/';
				$string = $_SERVER['DOCUMENT_ROOT'];
				$substring = 'rudrramc';
				if (strpos($string, $substring) !== false) {
					$uploadDir = '/home/rudrramc/admin.ajasys.com/assets/FoodPhotos/';
				} else {
					$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/admin/assets/FoodPhotos/';
				}

				if (!is_dir($uploadDir)) {
					mkdir($uploadDir, 0755, true);
				}
				if (isset($_FILES["images"])) {
					$filesArr = $_FILES["images"];
					$fileNames = array_filter($filesArr['name']);
					foreach ($filesArr['name'] as $key => $val) {
						$fileName = basename($filesArr['name'][$key]);
						$newName = $fileName;
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
			}
			unset($_POST['id']);
			$insert_data = $_POST;


			if ($newName != '') {
				$insert_data['Image'] = $newName;
			}
			$response = $this->MasterInformationModel->insert_entry2($insert_data, 'master_food_items');
			$lastInsertID = $SecondDB->insertID();
			$ReturnSaveStatus = 1;
		}
		$returnresult['RStuts'] = $ReturnSaveStatus;

		return json_encode($returnresult);
	}
	public function food_list_data_old()
	{
		$table_name = $_POST['table'];
		$db_connection = \Config\Database::connect('second');
		$action = $_POST['action'];
		// $username = session_username($_SESSION['username']);
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$ajaxsearch_query = '';
		if ($action == "filter") {
			unset($_POST['action']);
			unset($_POST['datastatus']);
			unset($_POST['table']);
			foreach ($_POST as $k => $v) {
				if (!empty($v) && $k == "f_id") {
					$ajaxsearch_query .= ' AND id  LIKE "%' . $v . '%" ';
				}
				if (!empty($v) && $k == "f_food") {
					$ajaxsearch_query .= ' AND food LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_unit") {
					$ajaxsearch_query .= ' AND unit LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_type") {
					$ajaxsearch_query .= ' AND type LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k == "f_food_type") {
					$ajaxsearch_query .= ' AND food_type LIKE "%' . $v . '%"';
				}
			}
		}
		if ($ajaxsearch_query == "") {
			$sql = 'SELECT * FROM `master_food` ';
		} else {
			$sql = 'SELECT * FROM `master_food` WHERE 1 ' . $ajaxsearch_query;
		}

		$main_sql = $sql;
		$result = $db_connection->query($sql);
		$resultsss = $result->getResultArray();
		$result = array();

		$i = 1;
		$food_img = '';
		$html = "";
		foreach ($resultsss as $key => $value) {

			// 	$food_type = "";


			// 	if ($this->admin == 1) {
			// 	if (!empty(isset($value['food_type']))) {
			// 		$name = SecoundDBIdToFieldGetData('type', "id=" . intval($value['food_type']) . "", "master_food_type");
			// 		if (isset($name) && !empty($name)) {
			// 			$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
			// 		}
			// 	}
			// }
			$food_type = "";
			if (!empty($value['food_type'])) {
				$name = IdToFieldGetData('type', "id=" . $value['food_type'] . "", "master_food_type");
				$food_type = isset($name['type']) && !empty($name['type']) ? $name['type'] : '';
			}
			// if (empty($food) || preg_match("/" . preg_quote($food, '/') . "/i", $value['food'])) {
			// 	if (empty($F_unit) || $F_unit == $value['unit']) {
			// 		if (empty($F_type) || $F_type == $value['type']) {
			// print_r($value);
			if ($value['image'] != '' && $value['image'] != 'undefined') {
				$food_img = $value['image'];
			} else {
				$food_img = 'food_image.jpg';
			}
			$html .= '<tr>			
			<td style="width:0%"><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>';
			$ts = "";
			$ts .= '
			<td class="edit" data-edit_id="' . $value['id'] . '">
			<div class=" px-0 py-0 w-100 food_view" data-bs-target="#view_model" data-view_id="' . $value['id'] . '" data-bs-toggle="modal">
				<div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-5">
					<div class="col t-pic">
						<span class="mx-2"><b>' . $value['id'] . '</b></span>
						<span class="mx-1">
								<div class="d-flex align-items-center">
									<img width="50px" heigth="50px" src="' . base_url('assets/images/food_type/') . $food_img . '" alt="" class="profile-image">
								</div
								<span class="mx-2">' . $value['food'] . '</span>
						</span>									
					</div>
					<div class="col">
						<b>Unit: </b>
						<span class="mx-2">' . $value['unit'] . '</span>
					</div>
					<div class="col">
						<b>Quantity: </b>
						<span class="mx-2">' . $value['quantity'] . '</span>
					</div>
					<div class="col">
						<b>Type: </b>
						<span class="mx-2">' . $value['type'] . '</span>
					</div>
					<div class="col">
						<b>Food Type: </b>
						<span class="mx-2">' . $food_type . '</span>
					</div>
					<div class="col">
						<b>Small: </b>
						<span class="mx-2">' . $value['small'] . '</span>
					</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['small_protein'] . '</span>
					</div>
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['small_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['small_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['small_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Medium: </b>
						<span class="mx-2">' . $value['medium'] . '</span>
					</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['medium_protein'] . '</span>
					</div>
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['medium_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['medium_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['medium_fiber'] . '</span>
					</div>
					<div class="col">
						<b>Large: </b>
						<span class="mx-2">' . $value['large'] . '</span>
					</div>
					<div class="col">
						<b>Protein: </b>
						<span class="mx-2">' . $value['large_protein'] . '</span>
					</div>
					<div class="col">
						<b>Carbs: </b>
						<span class="mx-2">' . $value['large_carbs'] . '</span>
					</div>
					<div class="col">
						<b>Fats: </b>
						<span class="mx-2">' . $value['large_fats'] . '</span>
					</div>
					<div class="col">
						<b>Fiber: </b>
						<span class="mx-2">' . $value['large_fiber'] . '</span>
					</div>
				</div>
			</div>
		</td>
					';
			$html .= $ts;
			$html .= '</tr>';
			$i++;
		}
		if (!empty($html)) {
			$result['html'] = $html;
		} else {
			$result['html'] = '<p style="text-align:center;">Data Not Found</p>';
		}
		return json_encode($result);
		die();
	}

	public function food_master_update_data()
	{
		//image code
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
			$filesArr = $_FILES["image"];
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
			// print_r($_POST);
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				if ($fileName != '') {
					$update_data['image'] = $fileName;
				}
				$isduplicate = $this->duplicate_data2($update_data, $table_name);
				if ($isduplicate == 0) {
					$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
					$food_master_updatedisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$food_master_updatedisplaydata = json_decode($food_master_updatedisplaydata, true);
					$response = 1;
				} else {
					return 0;
				}
			}
		}
		echo $response;
		die();
	}
	public function task_delete_data()
	{
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('del_id');
			$table_name = $this->request->getPost('table');
			$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($this->username . "_" . $table_name, $delete_id);
			if (isset($departmentdisplaydata)) {
				$db = db_connect('second');
				$related_delete = $db->query("DELETE FROM " . $this->username . "_task_comments WHERE `task_id`=" . $delete_id);
				$relatednote_delete = $db->query("DELETE FROM " . $this->username . "_notes WHERE `task_id`=" . $delete_id);
				// $relatednoti_delete = $db->query("DELETE FROM " . $this->username . "_notification_center WHERE `inquiry_id`=" . $delete_id);
			}
		}
		die();
	}
	public function task_insert_data()
	{
		$insert_data = array();
		$type = $_POST['task_type'];
		$assignto = $_POST['assignto'];
		$filesArr = $_FILES["attachment"];
		$pText_add = $_POST['pText_add'];
		$today_date = date('Y-m-d H:i:s');
		unset($_POST['pText_add']);
		$uploadDir = 'assets/images/task_attachment/';
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}
		$fileNames = array_filter($filesArr['name']);
		$uploadedFile = '';
		if (!empty($fileNames)) {
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
		$uploadedFileStr = trim($uploadedFile, ',');
		$startdate = $_POST['start_date'];
		$enddate = $_POST['end_date'];
		$once_date = $_POST['once_date'];
		$monthly_date = $_POST['monthly_date'];
		$yearly_date = $_POST['yearly_date'];
		$daily_time = $_POST['daily_time'];
		$table_name = $this->username . '_' . $this->request->getPost("table");

		$db = db_connect();
		$notification_time = '';
		if (!empty($_POST)) {
			// unset($_POST['assignto'], $_POST['action'], $_POST['table'], $_POST['daily_time'],$_POST['once_date'], $_POST['monthly_date'], $_POST['yearly_date']);
			unset($_POST['task_type'], $_POST['assignto'], $_POST['action'], $_POST['table'], $_POST['pText_add'], $_POST['start_date'], $_POST['end_date'], $_FILES["attachment"], $_POST['once_date'], $_POST['monthly_date'], $_POST['yearly_date'], $_POST['daily_time']);
			$insert_data = $_POST;
			if (isset($_SESSION['admin']) && !empty($_SESSION['admin']) && $_SESSION['admin'] == 1) {
				$user_id = 1;
			} else {
				$user_id = $_SESSION['id'];
			}
			$insert_data['user_id'] = $user_id;
			$insert_data['type'] = $type;
			$insert_data['assignto_user'] = $assignto;
			if (isset($once_date) && $_POST['recursive_type'] == 1) {
				// $insert_data['once_date'] = ('Y-m-d H:i:s',strtotime($once_date)); //date("Y-m-d H:i:s", strtotime($once_date));
				$insert_data['once_date'] = date('Y-m-d H:i:s', strtotime($once_date));

				$notification_time = date('Y-m-d H:i:s', strtotime($once_date));
			}
			if (isset($monthly_date) && $_POST['recursive_type'] == 4) {
				$insert_data['monthly_date'] = date('Y-m-d H:i:s', strtotime($monthly_date)); //date("Y-m-d H:i:s", strtotime($monthly_date));
				$notification_time = date('Y-m-d H:i:s', strtotime($monthly_date));
			}
			if (isset($yearly_date) && $_POST['recursive_type'] == 5) {
				$insert_data['yearly_date'] = date('Y-m-d H:i:s', strtotime($yearly_date)); //date("Y-m-d H:i:s", strtotime($yearly_date));
				$notification_time = date('Y-m-d H:i:s', strtotime($yearly_date));
			}
			if (isset($daily_time) && ($_POST['recursive_type'] == 2 || $_POST['recursive_type'] == 3)) {
				$insert_data['daily_time'] = date('H:i:s', strtotime($daily_time));
				$notification_time = date('Y-m-d H:i:s', strtotime($daily_time));
			}
			if (isset($startdate)) {
				$insert_data['start_date'] = date('Y-m-d h:i A', strtotime($startdate));
			}
			if (isset($enddate)) {
				$insert_data['end_date'] = date('Y-m-d h:i A', strtotime($enddate));
			}
			if ($uploadedFileStr != '') {
				$insert_data['attachment'] = $uploadedFileStr;
			}
			$insert_data['created_at'] = date('Y-m-d H:i:s', strtotime($today_date));

			$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
			$result['response'] = 1;
			$result['message'] = 'Added Successfully !';
			// if (isset($type) && ($type == 3 || $type == 2)) {
			// 	if ($result['response'] == 1) {

			// 		$reminder_data = array();
			// 		$first_db = \Config\Database::connect();
			// 		$find_alert = "SELECT * FROM " . $this->username . "_alert_setting WHERE alert_title IN (32,33)";
			// 		$find_alert = $first_db->query($find_alert);
			// 		$all_data = $find_alert->getResultArray();
			// 		if (isset($all_data[0]['is_alert']) && $all_data[0]['is_alert'] == 1) {
			// 			$reminder_data['inquiry_id'] = $response;
			// 			$reminder_data['created_at'] = $notification_time;
			// 			$reminder_data['is_sms'] = $all_data[0]['is_sms'];
			// 			$reminder_data['sms_template_id'] = $all_data[0]['sms_template_id'];
			// 			$reminder_data['is_email'] = $all_data[0]['is_email'];
			// 			$reminder_data['email_template_id'] = $all_data[0]['email_template_id'];
			// 			$reminder_data['is_whatsapp'] = $all_data[0]['is_whatsapp'];
			// 			$reminder_data['whatsapp_template_id'] = $all_data[0]['whatsapp_template_id'];
			// 			$reminder_data['is_type'] = $type;
			// 			if ($type == 2) {
			// 				$reminder_data['alert_title'] = 33;
			// 			}
			// 			if ($type == 3) {
			// 				$reminder_data['alert_title'] = 32;
			// 			}
			// 			$response_alert = $this->MasterInformationModel->insert_entry($reminder_data, $this->username . "_notification_center");
			// 		}
			// 		// $response_reminder = $this->MasterInformationModel->insert_entry($reminder_data, $this->username . "_notification_center");
			// 		// $notification_data = any_id_to_full_data($this->username . "_notification_center", $response_reminder);
			// 		// $reminder_all_data = any_id_to_full_data($this->username . "_tasks", $notification_data['inquiry_id']);
			// 		// $sse_id = any_id_to_full_data($this->username . "_user", $reminder_all_data['assignto_user']);
			// 		// if(($reminder_all_data['is_email_automation	']==1 && $reminder_all_data['customer_email']!='') || ($reminder_all_data['is_whatsapp_automation']==1 && $reminder_all_data['customer_mobile']!=''))
			// 		// {
			// 		// 	notification_center('', $response_reminder, $reminder_all_data['customer_mobile'], $reminder_all_data['customer_email'], $sse_id['firstname'], $sse_id['phone']);
			// 		// }	
			// 	}
			// }
			return json_encode($result);
		}
	}

	public function new_status_list_data()
	{

		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}

		$dataBs = \Config\Database::connect('second');
		$forge = \Config\Database::forge();
		$tableName = 'notes';
		$columnName = 'task_id';
		if ($dataBs->fieldExists($columnName, $this->username . '_' . $tableName)) {
		} else {
			$forge->addColumn($tableName, [
				$columnName => [
					'type' => 'INT',
					'constraint' => 250,
				],
			]);
		}
		$table_name = $_POST['table'];
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$ajaxsearch_query = '';

		$username = session_username($_SESSION['username']);
		$table = $_POST['table_name'];
		// $type = $_POST['task_type'];
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		$searchId = $_POST['searchId'];
		$taskSearchval = $_POST['taskSearchval'];
		if (isset($_POST['search_date']) && !empty($_POST['search_date'])) {
			$search_date = date("d-m-Y", strtotime($_POST['search_date']));
			// Rest of your code using $search_date
		} else {
			$search_date = "";
		}


		$searchQuery = '';

		$getchild = '';
		$getchild = getChildIds($_SESSION['id']);

		$current_time = date("d-m-Y");
		if ($searchId) {
			$searchQuery .= 't.assignto_user LIKE "' . $searchId . '" ';
		}

		if ($taskSearchval) {
			if ($searchQuery) {
				$searchQuery .= ' AND ';
			}
			$searchQuery .= 't.subject LIKE "%' . $taskSearchval . '%" ';
		}
		if ($search_date) {

			if ($searchQuery) {
				$searchQuery .= ' AND ';
			}
			// $searchQuery .= ' DATE_FORMAT(t.created_at, "%d-%m-%Y") LIKE "%' . $search_date . '%" ';
			$date_convo = date("Y-m-d", strtotime($_POST['search_date']));

			$searchQuery = "t.assignto_user LIKE '$searchId'
						AND (
							(t.type = 1 AND DATE('$date_convo') BETWEEN DATE(t.start_date) AND DATE(t.end_date))
							OR (t.type = 1 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
							OR (t.type = 1 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
							OR (t.type = 1 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
							OR (t.type = 1 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
							OR (t.type = 2 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
							OR (t.type = 2 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
							OR (t.type = 2 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
							OR (t.type = 2 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
							OR (t.type = 3 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
							OR (t.type = 3 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
							OR (t.type = 3 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
							OR (t.type = 3 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
						)";
		} else {
			// if ($searchQuery) {
			// 	$searchQuery .= ' AND ';
			// }
			// $searchQuery .= ' DATE(t.`created_at`) = "' . $current_time . '" ';
		}

		$task_icon = '<div class="d-flex align-items-center"><span class="py-1 px-2 rounded-1 bg-primary"></span><span class="fs-12 text-gray ms-2 p-0">Task</span></div>';
		$meeting_icon = '<div class="d-flex align-items-center"><span class="py-1 px-2 rounded-1 bg-info"></span><span class="fs-12 text-gray ms-2 p-0">Meeting</span></div>';
		$reminder_icon = '<div class="d-flex align-items-center"><span class="py-1 px-2 rounded-1 bg-warning"></span><span class="fs-12 text-gray ms-2 p-0">Reminder</span></div>';

		if ($this->admin == 1) {
			$userCon = '';
		} else {
			if (!empty($getchild)) {
				$getchilds = "'" . implode("', '", $getchild) . "'";
			} else {
				$getchilds = "'" . $_SESSION['id'] . "'";
			}
			$userCon = "  AND (t.assignto_user=" . $_SESSION['id'] . "  OR  t.assignto_user IN (" . $getchilds . "))";
		}


		$sql_comment = "SELECT t.*, 
							(SELECT u.firstname FROM " . $this->username . "_user u WHERE u.id = t.assignto_user) AS assignname, 
							CASE
								WHEN t.type = 1 THEN ' $task_icon '
								WHEN t.type = 2 THEN ' $meeting_icon '
								WHEN t.type = 3 THEN ' $reminder_icon '
								ELSE 'Unknown'
							END AS typename 
							FROM " . $this->username . "_" . $table_name . " t 
							";


		if (!empty($searchQuery)) {
			$sql_comment .= " WHERE " . $searchQuery;
		}
		if ($ajaxsearch != '') {
			$sql_comment .= 'AND CONCAT(id) LIKE "%' . $ajaxsearch . '%" ';
		}

		$sql_comment1 = $sql_comment . $userCon;
		//  echo $sql_comment1;
		$result_comment = $dataBs->query($sql_comment1);
		$departmentdisplaydata = $result_comment->getResultArray();
		$departmentdisplaydata_labal = $this->MasterInformationModel->display_all_records2('admin_task_status');
		$departmentdisplaydata_labal = json_decode($departmentdisplaydata_labal, true);

		$i = 1;
		$html = "";
		$html123 = "";
		$dateType = '';
		$thirdDb = \Config\Database::connect('second');
		//   $date_Time = Utctodate('d-m-Y H:i', timezonedata(), $date_Time);

		foreach ($departmentdisplaydata_labal as $dep_keuy => $dep_value) {
			if (empty($search_date)) {
				$sql = "SELECT COUNT(t.id) as count1 FROM " . $this->username . "_tasks t WHERE t.status = " . $dep_value['id'] . " AND t.assignto_user LIKE '" . $searchId . "'";
			} else {
				$sql = "SELECT COUNT(t.id) as count1 FROM " . $this->username . "_tasks t WHERE t.status = " . $dep_value['id'] . " AND 
				t.assignto_user LIKE '$searchId'
				AND (
					(t.type = 1 AND DATE('$date_convo') BETWEEN DATE(t.start_date) AND DATE(t.end_date))
					OR (t.type = 1 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
					OR (t.type = 1 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
					OR (t.type = 1 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
					OR (t.type = 1 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
					OR (t.type = 2 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
					OR (t.type = 2 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
					OR (t.type = 2 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
					OR (t.type = 2 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
					OR (t.type = 3 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
					OR (t.type = 3 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
					OR (t.type = 3 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
					OR (t.type = 3 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo'))";

				if ($this->admin != 1) {
					if (!empty($getchild)) {
						$getchilds = "'" . implode("', '", $getchild) . "'";
						$sql .= " AND (t.assignto_user = " . $_SESSION['id'] . " OR t.assignto_user IN (" . $getchilds . "))";
					} else {
						$sql .= " AND t.assignto_user = " . $_SESSION['id'];
					}
				}
			}
			// pre($sql);
			// die();
			// Execute the SQL query here

			$result = $thirdDb->query($sql);
			$conversation_chat_user = $result->getResultArray();
			$count_task = $conversation_chat_user[0]['count1'];
			$totalDuration_loop = 0;
			foreach ($departmentdisplaydata as $key => $value) {
				$ts123 = '';

				$user_detail = "";
				if (!empty($value['user_id'])) {
					$title = IdToFieldGetData('firstname', "id=" . $value['user_id'] . "", $username . "_user");
					$user_detail = isset($title['firstname']) && !empty($title['firstname']) ? $title['firstname'] : '';
				}
				if ($value['status'] == $dep_value['id']) {
					$sql_comment = "SELECT COUNT(*) FROM " . $this->username . "_task_comments WHERE task_id = " . $value['id'] . ";";
					$result_comment = $thirdDb->query($sql_comment);
					$comment_count = $result_comment->getResultArray();
					foreach ($comment_count[0] as $key_comment => $value_comment) {
						$count_c = $value_comment;
					}
					if ($value['sticky_note_stuts'] == "1") {
						$sticky_note_stuts_fill = 'fill=""';
					} else {
						$sticky_note_stuts_fill = 'fill="none"';
					}
					if ($value['attachment'] != '') {
						$array_attch = explode(',', $value['attachment']);
						$length_attch = count($array_attch);
					} else {
						$length_attch = '0';
					}
					if ($value['start_date']) {
						$start_at = date('d-m-Y h:i A', strtotime($value['start_date']));
					} else {
						$start_at = '';
					}
					if ($value['end_date']) {
						$end_at = date('d-m-Y h:i A', strtotime($value['end_date']));
					} else {
						$end_at = '';
					}
					if ($value['once_date']) {
						$created_at = date('d-m-Y h:i A', strtotime($value['once_date']));
					} else {
						$created_at = '';
					}
					if ($value['monthly_date']) {
						$monthly_at = date('d-m-Y h:i A', strtotime($value['monthly_date']));
					} else {
						$monthly_at = '';
					}
					if ($value['yearly_date']) {
						$yearly_at = date('d-m-Y h:i A', strtotime($value['yearly_date']));
					} else {
						$yearly_at = '';
					}
					if ($value['daily_time']) {
						$daily_time = date('h:i A', strtotime($value['daily_time']));
					} else {
						$daily_time = '';
					}
					if ($value['is_recursive'] == 0 && $value['type'] == 1) {
						$dateType = date('d-m-Y  h:i A', strtotime($start_at)) . ' To ' . date('d-m-Y h:i A', strtotime($end_at));
					}
					if ($value['recursive_type'] == 1) {
						$dateType = 'Once (' . date('d-m-Y h:i A', strtotime($created_at)) . ')';
					} else if ($value['recursive_type'] == 2) {
						$dateType = 'Daily (' . $daily_time . ')';
					} else if ($value['recursive_type'] == 3) {
						$dateType = 'Weekly (' . $value['weekly_name'] . ', Time :' . $daily_time . ')';
					} else if ($value['recursive_type'] == 4) {
						$dateType = 'Monthly (' . date('d-m-Y h:i A', strtotime($monthly_at)) . ')';
					} else if ($value['recursive_type'] == 5) {
						$dateType = 'Yearly (' . date('d-m-Y h:i A', strtotime($yearly_at)) . ')';
					}
					$modelview = $modeledit = $modeldelete = '';
					if ($value['type'] == 1) {
						if (in_array('task_manage_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modelview = ' data-bs-toggle="modal" data-bs-target="#view-task" ';
						}
						if (in_array('task_manage_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modeledit = '<a href="javascript:void(0)" onclick="editModel(' . $value['id'] . ');">
												<div class="d-flex align-items-center cursor-pointer me-2 task_template_edit task_edit_model task_edit_model_' . $value['id'] . '" data-edit_id="' . $value['id'] . '">
													<i class="fa-solid fa-pen-to-square"></i>
												</div>
											</a>';
						}
						if (in_array('task_manage_child_delete_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modeldelete = '<div class="d-flex align-items-center cursor-pointer me-2 task_delete task_delete_' . $value['id'] . '" data-delete_id = "' . $value['id'] . '">
												<i class="fa-solid fa-trash-can"></i>
											</div>';
						}
					} elseif ($value['type'] == 2) {
						if (in_array('meeting_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modelview = 'data-bs-toggle="modal" data-bs-target="#view-task" ';
						}
						if (in_array('meeting_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modeledit = '<a href="javascript:void(0)" onclick="editModel(' . $value['id'] . ');">
												<div class="d-flex align-items-center cursor-pointer me-2 task_template_edit task_edit_model task_edit_model_' . $value['id'] . '" data-edit_id="' . $value['id'] . '">
													<i class="fa-solid fa-pen-to-square"></i>
												</div>
											</a>';
						}
						if (in_array('meeting_child_delete_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modeldelete = '<div class="d-flex align-items-center cursor-pointer me-2 task_delete task_delete_' . $value['id'] . '" data-delete_id = "' . $value['id'] . '">
												<i class="fa-solid fa-trash-can"></i>
											</div>';
						}
					} elseif ($value['type'] == 3) {
						if (in_array('reminder_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modelview = 'data-bs-toggle="modal" data-bs-target="#view-task"';
						}
						if (in_array('reminder_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modeledit = '<a href="javascript:void(0)" onclick="editModel(' . $value['id'] . ');">
											<div class="d-flex align-items-center cursor-pointer me-2 task_template_edit task_edit_model task_edit_model_' . $value['id'] . '" data-edit_id="' . $value['id'] . '">
												<i class="fa-solid fa-pen-to-square"></i>
											</div>
										</a>';
						}
						if (in_array('reminder_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
							$modeldelete = '<div class="d-flex align-items-center cursor-pointer me-2 task_delete task_delete_' . $value['id'] . '" data-delete_id = "' . $value['id'] . '">
												<i class="fa-solid fa-trash-can"></i>
											</div>';
						}
					}
					$names = explode(' ', $value['assignname']);

					// Extract the first letter of each word
					$initials = '';
					foreach ($names as $name) {
						$initials .= strtoupper(substr($name, 0, 1));
					}
					$ts123 .= '
					<div class="custm-up-class px-1 task-card-main-edit-box editable" onchange="statusUpdate(' . $value['status'] . ')">
						<div class="task-card cursor-pointer">
							<div class="task-card-header p-2 d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<div class="task-header-priority-color">
										<span class="fs-12 rounded-pill text-white" style="background-color:' . $value['priority_color'] . ';">' . $value['priority'] . '</span>
									</div>
									<h4 class="fs-14 text-gray px-2 main_task_name_width text-nowrap overflow-hidden" style="text-overflow: ellipsis;" data-tbs-toggle="tooltip" data-bs-placement="right" data-bs-title="' . $value['subject'] . '">' . $value['subject'] . '</h4>
								</div>
								<div class="d-flex align-items-center task-card-footer top-0 justify-content-center task-header-typename">
									<div class="user-small-name pe-2">
										<span class="rounded-pill fs-10 bg-primary text-white p-1 d-flex align-items-center justify-content-center">' . $initials . '</span>
									</div>
									' . $value['typename'] . '
									<span class="p-0 ms-2 task-up-down-a"><i class="bi bi-chevron-down text-primary fs-6"></i></span>
								</div>
							</div>
							<div class="task-card-body p-2 mb-3 view_model_div_controller_task view_model_div" ' . $modelview . ' data-attachment="' . $value['attachment'] . '" data-priority="' . $value['priority'] . '" data-priority-color="' . $value['priority_color'] . '" data-task-id="' . $value['id'] . '" data-task-type="' . $value['type'] . '">
								<div class="d-flex flex-wrap justify-content-between align-items-center">
									<h4 class="fs-14 text-gray mb-2">
										<span class="fw-semibold"><i class="bi bi-person-add fs-5"></i> </span>' . $user_detail . '
									</h4> 
									<h4 class="fs-14 text-gray mb-2">
										<span class="fw-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16" fill="none">
										<g clip-path="url(#clip0_1146_2)">
										<path d="M8.53659 14C8.67318 13.6102 8.76485 13.206 8.80978 12.7952H14.807C14.8058 12.5 14.6233 11.612 13.8144 10.7984C13.0366 10.016 11.5728 9.2 8.84199 9.2C8.53181 9.2 8.23754 9.21 7.95917 9.23C7.68955 8.8208 7.36744 8.45 7 8.1284C7.55673 8.0444 8.17073 8.0016 8.84199 8C14.807 8 16 11.6 16 12.8C16 14 14.807 14 14.807 14H8.53659Z" fill="#515151"/>
										<path d="M12 3.5C12 4.42826 11.6313 5.3185 10.9749 5.97487C10.3185 6.63125 9.42826 7 8.5 7C7.57174 7 6.6815 6.63125 6.02513 5.97487C5.36875 5.3185 5 4.42826 5 3.5C5 2.57174 5.36875 1.6815 6.02513 1.02513C6.6815 0.368749 7.57174 0 8.5 0C9.42826 0 10.3185 0.368749 10.9749 1.02513C11.6313 1.6815 12 2.57174 12 3.5ZM8.5 5.83333C9.11884 5.83333 9.71233 5.5875 10.1499 5.14992C10.5875 4.71233 10.8333 4.11884 10.8333 3.5C10.8333 2.88116 10.5875 2.28767 10.1499 1.85008C9.71233 1.4125 9.11884 1.16667 8.5 1.16667C7.88116 1.16667 7.28767 1.4125 6.85008 1.85008C6.4125 2.28767 6.16667 2.88116 6.16667 3.5C6.16667 4.11884 6.4125 4.71233 6.85008 5.14992C7.28767 5.5875 7.88116 5.83333 8.5 5.83333Z" fill="#515151"/>
										<path d="M-1.74846e-07 12C-2.21217e-07 10.9391 0.421427 9.92172 1.17157 9.17157C1.92172 8.42143 2.93913 8 4 8C5.06087 8 6.07828 8.42143 6.82843 9.17157C7.57857 9.92172 8 10.9391 8 12C8 13.0609 7.57857 14.0783 6.82843 14.8284C6.07828 15.5786 5.06087 16 4 16C2.93913 16 1.92172 15.5786 1.17157 14.8284C0.421428 14.0783 -1.28474e-07 13.0609 -1.74846e-07 12ZM6.69029 11.5954L4.976 9.88114C4.8687 9.77384 4.72317 9.71356 4.57143 9.71356C4.41968 9.71356 4.27416 9.77384 4.16686 9.88114C4.05956 9.98844 3.99928 10.134 3.99928 10.2857C3.99928 10.4375 4.05956 10.583 4.16686 10.6903L4.90629 11.4286L1.71429 11.4286C1.56273 11.4286 1.41739 11.4888 1.31022 11.5959C1.20306 11.7031 1.14286 11.8484 1.14286 12C1.14286 12.1516 1.20306 12.2969 1.31022 12.4041C1.41739 12.5112 1.56273 12.5714 1.71429 12.5714L4.90629 12.5714L4.16686 13.3097C4.05956 13.417 3.99928 13.5625 3.99928 13.7143C3.99928 13.866 4.05956 14.0116 4.16686 14.1189C4.27416 14.2262 4.41968 14.2864 4.57143 14.2864C4.72317 14.2864 4.8687 14.2262 4.976 14.1189L6.69029 12.4046C6.7435 12.3515 6.78572 12.2884 6.81453 12.219C6.84334 12.1496 6.85816 12.0752 6.85816 12C6.85816 11.9248 6.84334 11.8504 6.81453 11.781C6.78572 11.7116 6.7435 11.6485 6.69029 11.5954Z" fill="#515151"/>
										</g>
										<defs>
										<clipPath id="clip0_1146_2">
										<rect width="16" height="16" fill="white"/>
										</clipPath>
										</defs>
										</svg> </span>' . $value['assignname'] . '
									</h4>
								</div>
								<h4 class="fs-14 text-gray mb-2">
									<span class="fw-semibold">Date: </span>' . $dateType . '
								</h4> 
								<h4 class="fs-14 text-gray mb-2">
									<span class="fw-semibold">Description: </span>
									<div class="task-body-description">' . $value['description'] . '</div>
								</h4>
<div class="d-flex flex-wrap">';

					$start_time_fieldd = $value['start_time_task'];
					$end_time_fieldd = $value['end_time_task'];

					$decode_al_time = json_decode($start_time_fieldd, true);
					$decode_end_time = json_decode($end_time_fieldd, true);


					if (!empty($decode_al_time) && is_array($decode_al_time)) {
						$ts123 .= '
									<div class="col-5 fs-12">
										<div>Start Time:</div>';
						foreach ($decode_al_time as $val_time) {
							$ts123 .= ' <div>' . $val_time['formatted_start_time'] . '</div>';
						}
						$ts123 .= '
									</div>';
					}
					if (!empty($decode_end_time) && is_array($decode_end_time)) {
						$ts123 .= '<div class="col-5 fs-12">
										<div>End Time:</div>';
						foreach ($decode_end_time as $val_end) {
							$ts123 .= '<div>' . $val_end['end_time_task'] . '</div>';
						}
						$ts123 .= '
							</div>
';
					}
					// $arr_merge = array_merge($decode_al_time,$decode_end_time);


					$mergedArray = array();

					$ts123 .= '	<div class="col-2 fs-12">
					<div>Total Time: </div>';
					if (!empty($decode_al_time)) {
						foreach ($decode_al_time as $key => $value80) {
							// Check if the index exists in the second array
							if (isset($decode_end_time[$key])) {
								// Merge values from both arrays into a new array
								$mergedArray[] = array_merge($value80, $decode_end_time[$key]);
							}
						}

						foreach ($mergedArray as $key => $value_timing) {
							//new
							$endTimes_loop = $value_timing['end_time_task'];
							$startTimes_loop = $value_timing['formatted_start_time'];

							// foreach ($endTimes as $key => $val_end) {
							$endDateTime_loop = \DateTime::createFromFormat('d-m-Y h:i A', $endTimes_loop);
							$startDateTime_loop = \DateTime::createFromFormat('d-m-Y h:i A', $startTimes_loop);


							$duration_loop = $endDateTime_loop->getTimestamp() - $startDateTime_loop->getTimestamp();
							// $totalDuration_loop += $duration_loop;
							// }
							// $totalDurationSeconds = $totalDuration;
							// $totalDurationMinutes = $totalDuration / 60;
							// $yyy += $totalDurationMinutes;

							$totalDurationSeconds_loop = $duration_loop;
							$second_value = floatval($totalDurationSeconds_loop) % 60;
							// pre($testtt);
							$totalDurationMinutes_loop = $duration_loop / 60;
							$totalDurationMinutes_loop = number_format($totalDurationMinutes_loop, 2);

							// pre($totalDurationMinutes_loop);
							// $yyy += $totalDurationMinutes;

							// Calculate hours and remaining minutes
							if (is_numeric($totalDurationMinutes_loop)) {
								$totalDurationHours_loop = $totalDurationMinutes_loop / 60;
							} 
							// $totalDurationHours_loop = ($totalDurationMinutes_loop / 60);
							// $totalDurationHours_loop = round($totalDurationHours_loop, 2);
							// die();
							// $remainingMinutes_loop = $totalDurationMinutes_loop % 60;
							$remainingHours = "";
							if ($totalDurationMinutes_loop >= 60) {

								// Calculate days and remaining hours
								$totalDurationDays = ($totalDurationHours_loop / 24);
								$remainingHours = $totalDurationHours_loop % 24;

								$hours_final_loop = floor($totalDurationMinutes_loop / 60);
								$remainingMinutess_loop = $totalDurationMinutes_loop % 60;
								// Display the result
								if ($totalDurationDays > 0) {
									$count_loop = $totalDurationDays . " D ";
								}
								if ($remainingHours > 0) {
									// $count_loop = $remainingHours . " hour ";
									$count_loop = $hours_final_loop . " H " . $remainingMinutess_loop . " M";;
								}
								// $count_loop =  $remainingMinutes_loop . " minute";	
							} else {
								// Display the result in minutes if less than 60 minutes
								$count_loop = $totalDurationMinutes_loop . " M";
							}
							$ts123 .= '
									<div>' . $count_loop . '</div>';
						}
					}
					$ts123 .= '
					</div>
				</div>
			';
					// pre($mergedArray);
					// $test = array_merge($decode_al_time, $decode_end_time);

					// die();
					$yyy = 0;
					foreach ($mergedArray as $key => $sddfg) {
						$startTimes = $sddfg['formatted_start_time'];
						$endTimes = $sddfg['end_time_task'];
						// pre($endTimes);
						$totalDuration = 0;
						if (!empty($endTimes)) {
							// foreach ($endTimes as $key => $val_end) {
							$endDateTime = \DateTime::createFromFormat('d-m-Y h:i A', $endTimes);
							$startDateTime = \DateTime::createFromFormat('d-m-Y h:i A', $startTimes);


							$duration = $endDateTime->getTimestamp() - $startDateTime->getTimestamp();
							$totalDuration += $duration;
							// }
							// $totalDurationSeconds = $totalDuration;
							// $totalDurationMinutes = $totalDuration / 60;
							// $yyy += $totalDurationMinutes;

							$totalDurationSeconds = $totalDuration;
							$totalDurationMinutes = $totalDuration / 60;
							$yyy += $totalDurationMinutes;

							// Calculate hours and remaining minutes
							$totalDurationHours = floor($totalDurationMinutes / 60);
							$remainingMinutes = $totalDurationMinutes % 60;

							// Initialize variables for days
						}
					}
					$totalDurationDays = 0;
					$count = "";
					if ($yyy >= 60) {
						// Calculate days and remaining hours
						$totalDurationDays = floor($totalDurationHours / 24);
						$hours_final = floor($yyy / 60);
						$remainingMinutess = $yyy % 60;
						// Display the result
						if ($totalDurationDays > 0) {
							$count = $totalDurationDays . " day ";
						}
						if ($remainingHours > 0) {
							$count = $hours_final . " hour " . $remainingMinutess . " minute";;
						}
						// $count = $remainingMinutes . " minute";
					} else {
						// Display the result in minutes if less than 60 minutes
						$count = $yyy . " minute";
					}
					$ts123 .= '<p>Total Time : ' . $count . '</p>';
					$ts123 .= '</div>
							<div class="task-card-footer border-top p-2">
								<div class="d-flex mt-3 pe-3">
									' . $modeledit . $modeldelete . '
									<div class="d-flex align-items-center cursor-pointer me-2 position-relative comment_add_task_id" data-bs-toggle="modal" data-bs-target="#add-comment" task_table_id = "' . $value['id'] . '" id="model-open-add-comment">
										<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
											viewBox="0 0 512 512" fill="none">
											<path
												d="M298.666 42.667H128C116.684 42.667 105.831 47.1622 97.8298 55.1638C89.8282 63.1653 85.333 74.0178 85.333 85.3337V426.667C85.333 437.983 89.8282 448.835 97.8298 456.837C105.831 464.838 116.684 469.334 128 469.334H384C395.316 469.334 406.168 464.838 414.17 456.837C422.171 448.835 426.666 437.983 426.666 426.667V170.667L298.666 42.667Z"
												stroke="#05A605" stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
											<path d="M298.667 42.667V170.667H426.667" stroke="#05A605"
												stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
											<path d="M341.334 277.333H170.667" stroke="#05A605"
												stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
											<path d="M341.334 362.667H170.667" stroke="#05A605"
												stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
											<path d="M213.334 192H192H170.667" stroke="#05A605"
												stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>
										<span
											class="position-absolute translate-middle badge rounded-pill bg-secondary taskbadge">
											' . $count_c . '
										</span>
									</div>
									<div class="d-flex align-items-center cursor-pointer me-2 save_comment_from_task" task_id="' . $value['id'] . '" task_title="' . $value['subject'] . '" task_sticky_note_stuts="' . $value['sticky_note_stuts'] . '">
										<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
											viewBox="0 0 512 512" ' . $sticky_note_stuts_fill . '>
											<path
												d="M405.334 448L256 341.333L106.667 448V106.667C106.667 95.3508 111.162 84.4983 119.164 76.4968C127.165 68.4952 138.018 64 149.334 64H362.667C373.983 64 384.835 68.4952 392.837 76.4968C400.838 84.4983 405.334 95.3508 405.334 106.667V448Z"
												stroke="#808080" stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>
									</div>
									<div class="d-flex align-items-center cursor-pointer me-2 assign_task_div assign_task_div_' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#assign-task" data_edit_id = "' . $value['id'] . '">
										<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
											viewBox="0 0 512 512" fill="none">
											<path d="M490.666 128L288 330.667L181.333 224L21.333 384"
												stroke="#6E6B7B" stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
											<path d="M362.667 128H490.667V256" stroke="#6E6B7B"
												stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>
									</div>
									<div class="d-flex align-items-center cursor-pointer ms-auto position-relative view_model_div1" data-bs-toggle="modal" data-bs-target="#view-task" data-attachment = "' . $value['attachment'] . '" data-priority = "' . $value['priority'] . '" data-priority-color = "' . $value['priority_color'] . '"  data-task-id= "' . $value['id'] . '">
										<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
											viewBox="0 0 512 512" fill="none">
											<path
												d="M457.387 235.733L261.333 431.786C237.315 455.804 204.74 469.297 170.773 469.297C136.807 469.297 104.231 455.804 80.2133 431.786C56.1953 407.768 42.7021 375.193 42.7021 341.226C42.7021 307.26 56.1953 274.684 80.2133 250.666L276.267 54.6129C292.279 38.6009 313.996 29.6055 336.64 29.6055C359.284 29.6055 381.001 38.6009 397.013 54.6129C413.025 70.6249 422.021 92.3419 422.021 114.986C422.021 137.631 413.025 159.348 397.013 175.36L200.747 371.413C192.741 379.419 181.882 383.917 170.56 383.917C159.238 383.917 148.379 379.419 140.373 371.413C132.367 363.407 127.87 352.548 127.87 341.226C127.87 329.904 132.367 319.046 140.373 311.04L321.493 130.133"
												stroke="#6E6B7B" stroke-width="32" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>
										<span
											class="position-absolute translate-middle badge rounded-pill bg-secondary taskbadge">
											' . $length_attch . '
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>';
				} else {
				}
				$i++;
				$html123 .= $ts123;
			}
			$ts = '';
			$ts .= '
				<div class="col-xxl-3 col-sm-6 col-12 col-md-4 px-2 col-xl-3 py-3 ">
					<div class="task-board-header p-2 rounded-1" style="background-color:' . $dep_value["color"] . '; color:white;">
						<div class="d-flex justify-content-between">
							<p class="fw-medium">' . $dep_value["title"] . '</p>
							<span class="rounded-pill bg-web-primary text-white">' . $count_task . '</span>
						</div>
					</div>
					<div id="hygtfytfuytuyv">
						<div class="task-main-board">
							<div class="task-board-body task-card-main-edit p-1 mt-2 task-each-statusDiv h-100vh" data_task_status="' . $dep_value['id'] . '">
							' . $html123 . '
							</div>
						</div>
					</div>
				</div>
			';
			$html .= $ts;
			$i++;
			$html123 = "";
		}
		if (!empty($html)) {
			echo $html;
		}
	}
	public function task_template_list_data()
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}
		$table_name = $_POST['table'];
		// $table = $_POST['table_name'];
		$username = session_username($_SESSION['username']);
		$dataBs = \Config\Database::connect('second');
		$searchId = $_POST['searchId'];
		$taskSearchval = $_POST['taskSearchval'];
		$searchQuery = '';
		$getchild = '';
		$getchild = getChildIds($_SESSION['id']);
		if (isset($_POST['search_date']) && !empty($_POST['search_date'])) {
			$search_date = date('d-m-Y', (strtotime($_POST['search_date'])));
			// Rest of your code using $search_date
		} else {
			$search_date = "";
		}
		$ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
		$ajaxsearch_query = '';
		$current_time = date('d-m-Y', strtotime("d-m-Y"));
		if ($searchId) {
			$searchQuery .= ' t.assignto_user LIKE "' . $searchId . '" ';
		}
		if ($taskSearchval) {
			if ($searchQuery) {
				$searchQuery .= ' AND ';
			}
			$searchQuery .= ' t.subject LIKE "%' . $taskSearchval . '%" ';
		}
		if ($search_date) {
			if ($searchQuery) {
				$searchQuery .= ' AND ';
			}
			// $searchQuery .= ' DATE_FORMAT(t.created_at, "%d-%m-%Y") LIKE "%' . $search_date . '%" ';
			// $date_convo = date('Y-m-d',  date("Y-m-d", strtotime($_POST['search_date'])));
			$date_convo = date('Y-m-d', strtotime($_POST['search_date']));
			$searchQuery = "t.assignto_user LIKE '$searchId'
						AND (
							(t.type = 1 AND DATE('$date_convo') BETWEEN DATE(t.start_date) AND DATE(t.end_date))
							OR (t.type = 1 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
							OR (t.type = 1 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
							OR (t.type = 1 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
							OR (t.type = 1 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
							OR (t.type = 2 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
							OR (t.type = 2 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
							OR (t.type = 2 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
							OR (t.type = 2 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
							OR (t.type = 3 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
							OR (t.type = 3 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
							OR (t.type = 3 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
							OR (t.type = 3 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
						)";
		} else {
			// if ($searchQuery) {
			// 	$searchQuery .= ' AND ';
			// }
			// $searchQuery .= ' DATE(t.`created_at`) = "' . $current_time . '" ';
		}
		$task_icon = '<div class="d-flex align-items-center"><span class="py-1 px-2 rounded-1 bg-primary"></span><span class="fs-12 text-gray ms-2 p-0">Task</span></div>';
		$meeting_icon = '<div class="d-flex align-items-center"><span class="py-1 px-2 rounded-1 bg-info"></span><span class="fs-12 text-gray ms-2 p-0">Meeting</span></div>';
		$reminder_icon = '<div class="d-flex align-items-center"><span class="py-1 px-2 rounded-1 bg-warning"></span><span class="fs-12 text-gray ms-2 p-0">Reminder</span></div>';

		if ($this->admin == 1) {
			$userCon = '';
		} else {
			if (!empty($getchild)) {
				$getchilds = "'" . implode("', '", $getchild) . "'";
			} else {
				$getchilds = "'" . $_SESSION['id'] . "'";
			}
			$userCon = "  AND (t.assignto_user=" . $_SESSION['id'] . "  OR  t.assignto_user IN (" . $getchilds . "))";
		}


		$sql_comment = "SELECT t.*, 
							(SELECT u.firstname FROM " . $this->username . "_user u WHERE u.id = t.assignto_user) AS assignname, 
							CASE
								WHEN t.type = 1 THEN ' $task_icon '
								WHEN t.type = 2 THEN ' $meeting_icon '
								WHEN t.type = 3 THEN ' $reminder_icon '
								ELSE 'Unknown'
							END AS typename 
							FROM " . $this->username . "_" . $table_name . " t 
							";


		if (!empty($searchQuery)) {
			$sql_comment .= " WHERE " . $searchQuery;
		}
		if ($ajaxsearch != '') {
			$sql_comment .= 'AND CONCAT(id) LIKE "%' . $ajaxsearch . '%" ';
		}

		$sql_comment1 = $sql_comment . $userCon;
		//  echo $sql_comment1;
		$result_comment = $dataBs->query($sql_comment1);
		$departmentdisplaydata = $result_comment->getResultArray();
		$departmentdisplaydata_status = $this->MasterInformationModel->display_all_records2($this->username . "_" . 'task_status');
		$departmentdisplaydata_status = json_decode($departmentdisplaydata_status, true);
		$i = 1;
		$html = "";
		$thirdDb = \Config\Database::connect('default');

		foreach ($departmentdisplaydata as $key => $value) {
			foreach ($departmentdisplaydata_status as $key_status => $value_status) {
				if (empty($search_date)) {
					$sql = "SELECT COUNT(t.id) as count1 FROM " . $this->username . "_tasks t WHERE t.status = " . $value_status['id'];
				} else {

					$sql = "SELECT COUNT(t.id) as count1 FROM " . $this->username . "_tasks t WHERE t.status = " . $value_status['id'] . " AND 
				t.assignto_user LIKE '$searchId'
				AND (
					(t.type = 1 AND DATE('$date_convo') BETWEEN DATE(t.start_date) AND DATE(t.end_date))
					OR (t.type = 1 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
					OR (t.type = 1 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
					OR (t.type = 1 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
					OR (t.type = 1 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
					OR (t.type = 2 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
					OR (t.type = 2 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
					OR (t.type = 2 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
					OR (t.type = 2 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo')
					OR (t.type = 3 AND t.recursive_type = 1 AND DATE(t.once_date) = '$date_convo')
					OR (t.type = 3 AND t.recursive_type = 2 AND YEAR(t.created_at) = YEAR(CURRENT_DATE()) AND MONTH(t.created_at) = MONTH(CURRENT_DATE()))
					OR (t.type = 3 AND t.recursive_type = 4 AND DATE(t.monthly_date) = '$date_convo')
					OR (t.type = 3 AND t.recursive_type = 5 AND DATE(t.yearly_date) = '$date_convo'))";

					if ($this->admin != 1) {
						if (!empty($getchild)) {
							$getchilds = "'" . implode("', '", $getchild) . "'";
							$sql .= " AND (t.assignto_user = " . $_SESSION['id'] . " OR t.assignto_user IN (" . $getchilds . "))";
						} else {
							$sql .= " AND t.assignto_user = " . $_SESSION['id'];
						}
					}
				}
				// pre($search_date);
				// if (!empty($searchQuery)) {
				// 	$sql .= " AND " . $searchQuery;
				// }
				$result = $thirdDb->query($sql);
				$conversation_chat_user = $result->getResultArray();
				$count_task = $conversation_chat_user[0]['count1'];
				if ($value_status['id'] == $value['status']) {
					$task_status_name = $value_status['title'];
					$task_status_color = $value_status['color'];
				}
			}
			if ($value['sticky_note_stuts'] == "1") {
				$sticky_note_stuts_fill = '-fill';
			} else {
				$sticky_note_stuts_fill = '';
			}
			$user_detail = "";
			if (!empty($value['user_id'])) {
				$title = IdToFieldGetData('firstname', "id=" . $value['user_id'] . "", $username . "_user");
				$user_detail = isset($title['firstname']) && !empty($title['firstname']) ? $title['firstname'] : '';
			}
			$modelview = $modeledit = $modeldelete = '';
			if ($value['type'] == 1) {
				if (in_array('task_manage_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modelview = ' data-bs-toggle="modal" data-bs-target="#view-task" ';
				}
				if (in_array('task_manage_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modeledit = '<a href="javascript:void(0)" class="btn-primary-rounded mx-1 task_template_edit task_edit_model" onclick="editModel(' . $value['id'] . ');" data-bs-toggle="modal" data-edit_id="' . $value['id'] . '">
							<i class="bi bi-pencil-square fs-14"></i>
						</a>';
				}
				if (in_array('task_manage_child_delete_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modeldelete = '<a href="javascript:void(0)" class="btn-primary-rounded mx-1 task_delete" data-delete_id = "' . $value['id'] . '" data-bs-target="#add-email" data-bs-toggle="modal">
							<i class="fi fi-rr-trash d-flex fs-14"></i>
						</a>';
				}
			} elseif ($value['type'] == 2) {
				if (in_array('meeting_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modelview = 'data-bs-toggle="modal" data-bs-target="#view-task" ';
				}
				if (in_array('meeting_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modeledit = '<a href="javascript:void(0)" class="btn-primary-rounded mx-1 task_template_edit task_edit_model" onclick="editModel(' . $value['id'] . ');" data-bs-toggle="modal" data-edit_id="' . $value['id'] . '">
							<i class="bi bi-pencil-square fs-14"></i>
						</a>';
				}
				if (in_array('meeting_child_delete_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modeldelete = '<a href="javascript:void(0)" class="btn-primary-rounded mx-1 task_delete" data-delete_id = "' . $value['id'] . '" data-bs-target="#add-email" data-bs-toggle="modal">
							<i class="fi fi-rr-trash d-flex fs-14"></i>
						</a>';
				}
			} elseif ($value['type'] == 3) {
				if (in_array('reminder_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modelview = ' data-bs-toggle="modal" data-bs-target="#view-task"';
				}
				if (in_array('reminder_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modeledit = '<a href="javascript:void(0)" class="btn-primary-rounded mx-1 task_template_edit task_edit_model" onclick="editModel(' . $value['id'] . ');" data-bs-toggle="modal" data-edit_id="' . $value['id'] . '">
							<i class="bi bi-pencil-square fs-14"></i>
						</a>';
				}
				if (in_array('reminder_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
					$modeldelete = '<a href="javascript:void(0)" class="btn-primary-rounded mx-1 task_delete" data-delete_id = "' . $value['id'] . '" data-bs-target="#add-email" data-bs-toggle="modal">
							<i class="fi fi-rr-trash d-flex fs-14"></i>
						</a>';
				}
			}

			$ts = '
				<tr>
					<td>
						<input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '">
					</td>
					<td>
						<div class="px-0 py-0 w-100" data-edit_id="' . $value['id'] . '">
							<div class="row justify-content-between">
								<div class="order-xxl-5 order-sm-3 col-sm-2 col-4 d-flex align-items-center justify-content-center">
								
								' . $modeledit . $modeldelete . '
									<a href="javascript:void(0)" class="btn-primary-rounded mx-1 comment_add_task_id" task_table_id = "' . $value['id'] . '" id="model-open-add-comment" data-bs-target="#add-comment" data-bs-toggle="modal">
										<i class="bi bi-file-earmark-text fs-14"></i>
									</a>
									<a href="javascript:void(0)" class="bookmark-a btn-primary-rounded mx-1 save_comment_from_task" task_id="' . $value['id'] . '" task_title="' . $value['subject'] . '" task_sticky_note_stuts="' . $value['sticky_note_stuts'] . '">
										<i class="bi bi-bookmark' . $sticky_note_stuts_fill . ' fs-14"></i>
									</a>
								</div>
								<div class="order-xxl-2 order-sm-2 col-xxl-10 col-md-9 col-12 col-sm-8 d-flex flex-wrap justify-content-start align-items-center view_model_div1" ' . $modelview . ' data-attachment = "' . $value['attachment'] . '" data-priority = "' . $value['priority'] . '" data-priority-color = "' . $value['priority_color'] . '"  data-task-id= "' . $value['id'] . '">
									<div
										class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
										<b>' . $value['id'] . ' Title :</b>
										<span class="mx-2">' . $value['subject'] . '</span>
									</div>
									<div
										class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 d-flex">
										<b>Type: </b>
										<span class="mx-1"> ' . $value['typename'] . '</span>
									</div>
									<div
										class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
										<b> Created by : </b>
										<span class="mx-1">' . $user_detail . '</span>
									</div>
									<div
										class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
										<b> Assigned To : </b>
										<span class="mx-1">' . $value['assignname'] . '</span>
									</div>
									<div
										class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
										<b>Priority :</b>
										<span class="mx-1"> ' . $value['priority'] . '</span>
									</div>
									<div
										class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
										<b>Status : </b>
										<span class="fs-12 rounded-pill text-white" style="background-color: ' . $task_status_color . ';padding-left: 5px;padding-right: 5px;">' . $task_status_name . '</span>
									</div>
								</div>
							</div>
						</div>
					</td> ';
			$html .= $ts;
			$html .= '</tr>';
			$i++;
		}
		if (!empty($html)) {
			echo $html;
		} else {
			echo '<p style="text-align:center;">Data Not Found </p>';
		}
	}
	public function tasks_update_data()
	{
		$string = $once_date = $monthly_date = $yearly_date = $startdate = $daily_time = $enddate = "";
		$type = $_POST['task_type'];
		$startdate = $_POST['start_date'];
		$enddate = $_POST['end_date'];
		$once_date = $_POST['once_date'];
		$monthly_date = $_POST['monthly_date'];
		$yearly_date = $_POST['yearly_date'];
		$daily_time = $_POST['daily_time'];
		$assignto = $_POST['assignto'];
		$newName2 = $_POST['pText_add'];
		$filesArr = $_FILES['attachment'];
		$uploadDir = 'assets/images/task_attachment/';
		if (isset($_POST['attachment'])) {
			$uploadedFile = "";
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
		$uploadedFileStr = trim($uploadedFile, ',');
		$string = $newName2;
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$update_id = $this->request->getPost("edit_id");
		$notification_time = '';
		if ($this->request->getPost("action") == "update") {
			if (!empty($post_data)) {
				$db = db_connect();
				unset($_POST['edit_id'], $_POST['task_type'], $_POST['assignto'], $_POST['action'], $_POST['table'], $_POST['pText_add'], $_POST['start_date'], $_POST['end_date'], $_FILES["attachment"], $_POST['once_date'], $_POST['monthly_date'], $_POST['yearly_date'], $_POST['daily_time']);
				$update_data = $_POST;
				if (isset($_SESSION['admin']) && !empty($_SESSION['admin']) && $_SESSION['admin'] == 1) {
					$user_id = 1;
				} else {
					$user_id = $_SESSION['id'];
				}
				$insert_data['user_id'] = $user_id;
				$update_data['type'] = $type;
				$update_data['assignto_user'] = $assignto;

				if (isset($once_date) && $_POST['recursive_type'] == 1) {
					$insert_data['once_date'] = date('Y-m-d H:i:s', strtotime($once_date)); //date("Y-m-d H:i:s", strtotime($once_date));
					$notification_time = date('Y-m-d H:i:s', strtotime($once_date));
				}
				if (isset($monthly_date) && $_POST['recursive_type'] == 4) {
					$insert_data['monthly_date'] = date('Y-m-d H:i:s', strtotime($monthly_date)); //date("Y-m-d H:i:s", strtotime($monthly_date));
					$notification_time = date('Y-m-d H:i:s', strtotime($monthly_date));
				}
				if (isset($yearly_date) && $_POST['recursive_type'] == 5) {
					$insert_data['yearly_date'] = date('Y-m-d H:i:s', strtotime($yearly_date)); //date("Y-m-d H:i:s", strtotime($yearly_date));
					$notification_time = date('Y-m-d H:i:s', strtotime($yearly_date));
				}
				if (isset($daily_time) && ($_POST['recursive_type'] == 2 || $_POST['recursive_type'] == 3)) {
					$insert_data['daily_time'] = date('H:i:s', strtotime($daily_time));
					$notification_time = date('Y-m-d H:i:s', strtotime($daily_time));
				}
				if (isset($startdate)) {
					$update_data['start_date'] = date('Y-m-d h:i A', strtotime($startdate));
				}
				if (isset($enddate)) {
					$update_data['end_date'] = date('Y-m-d h:i A', strtotime($enddate));
				}
				if ($uploadedFileStr != '') {
					$update_data['attachment'] = $string;
				}
				$update_data['updated_at'] = date('Y-m-d H:i:s', strtotime("Y-m-d H:i:s"));
				$update = $this->MasterInformationModel->update_entry2($update_id, $update_data, $this->username . "_" . $table_name);

				//for notification update data
				// $result_comment = $db->query('SELECT id FROM '.$this->username .'_notification_center WHERE `is_type` IN (2,3) AND `inquiry_id`=' . $update_id . ' ORDER BY `id` DESC limit 1');
				// $departmentdisplaydata = $result_comment->getResultArray();
				// if ($departmentdisplaydata && $departmentdisplaydata[0]['id'] > 0) {
				// 	$notifcation_data['created_at'] = $notification_time;
				// 	$this->MasterInformationModel->update_entry2($departmentdisplaydata[0]['id'], $notifcation_data, $this->username . "_notification_center");
				// }

				$result['response'] = 1;
				$result['message'] = 'Updated Successfully !';
				return json_encode($result);
			}
		}
	}

	public function email_edit_data()
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}

		$edit_id = $_POST['edit_id'];
		$table_name = $this->username . "_" . $_POST['table'];
		$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);
		// print_r($departmentEditdata);
		foreach ($departmentEditdata as $d_key => $d_value) {
		}
		$isupdate = $isdelete = 0;
		if ($d_value->type == 1) {
			if (in_array('task_manage_child_delete_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$isdelete = 1;
			}
			if (in_array('task_manage_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$isupdate = 1;
			}
		} elseif ($d_value->type == 2) {
			if (in_array('meeting_child_delete_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$isdelete = 1;
			}
			if (in_array('meeting_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$isupdate = 1;
			}
		} elseif ($d_value->type == 3) {
			if (in_array('reminder_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$isdelete = 1;
			}
			if (in_array('reminder_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
				$isupdate = 1;
			}
		}
		if (isset($d_value->attachment)) {
			if ($d_value->attachment !== "") {
				$html = '';
				$file_array = explode(',', $d_value->attachment);
				foreach ($file_array as $key => $value) {
					$img = '';
					if ($value) {
						$img = base_url() . 'assets/images/task_attachment/' . $value;
					}
					$html .= '<div class="border-bottom px-3 py-2 d-flex align-items-center justify-content-between" id="u_btn">
					<div class="d-flex align-items-center"><div class="me-3">
					<img src="' . $img . '" alt="" width="28" height="28" class="object-fit-cover"></div>
					<div><p class="text-gray ff-second fs-14 fw-light mb-0">' . $value . '</p>
					</div></div>
					<div class="p-2 border border-danger rounded-2 ms-auto cursor-pointer" id="file_crodd_btn1">
					<i class="bi bi-x fs-14 text-danger d-flex"></i></div></div>';
					// '<div class="col-12 controller_ubtn bg-primary bg-opacity-10 text-primary d-flex m-1 px-2 rounded">
					// <p id="files" data-files="' . $value . '">' . $value . '</p>  
					// <span class="ms-auto remove_btn_files " id="file_crodd_btn">
					// <i class="fi fi-sr-cross-circle"></i></span> </div>';
				}
				$departmentEditdata['file_html'] = $html;
			}
		}
		$departmentEditdata['isdelete'] = $isdelete;
		$departmentEditdata['isupdate'] = $isupdate;
		return json_encode($departmentEditdata, true);
	}
	public function delete_all_inq()
	{
		if ($this->request->getPost('checkbox_value')) {
			$ids = $this->request->getPost('checkbox_value');
			$table_name = $this->request->getPost('table');
			$final_table_name = $this->username . '_' . $table_name;
			if ($this->admin == 1) {
				$username = $_SESSION['name'];
				$user_id = 1;
			} else {
				$username = $_SESSION['firstname'];
				$user_id = $_SESSION['id'];
			}
			if (!empty($ids)) {
				$db = \Config\Database::connect();
				$all = implode(",", $ids);
				$find_Array_all = "DELETE FROM $final_table_name WHERE id IN ($all)";
				$db->query($find_Array_all);
				if ($table_name == 'all_inquiry') {
					foreach ($ids as $key => $val) {
						$inquiry_log_data = array(
							'inquiry_id' => $val,
							'inquiry_log' => $val . ' Inquiry is Deleted By ' . $username,
							'user_id' => $user_id,
							'created_at' => Utctime('Y-m-d H:i:s', $this->timezone, date("Y-m-d H:i:s")),
						);
						$sql2 = $this->MasterInformationModel->insert_entry($inquiry_log_data, $this->username . '_inquiry_log');
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
			// $final_table_name = $this->username.$table_name;
			// print_r($ids);
			if (!empty($ids)) {
				$db = \Config\Database::connect();
				$all = implode(",", $ids);
				$find_Array_all = "DELETE FROM " . $this->table_name . "_" . $table_name . " WHERE id IN (" . $all . ")";
				$db->query($find_Array_all);
			}
		}
	}


	// public function delete_data_secound_db()

	// {

	// 	if ($this->request->getPost("action") == "delete") {

	// 		$delete_id = $this->request->getPost('id');

	// 		// $username = session_username($_SESSION['username']);

	// 		$table_name = $this->request->getPost('table');

	// 		$departmentdisplaydata = $this->MasterInformationModel->delete_entry2($table_name, $delete_id);

	// 		//print_r($departmentdisplaydata);

	// 		//die();

	// 	}

	// 	die();

	// }


	//edit data
	public function property_edit_data()
	{
		if ($this->request->getPost("action") == "edit") {
			$edit_id = $this->request->getPost('edit_id');
			$table_name = $this->request->getPost('table');
			$departmentEditdata = $this->MasterInformationModel->edit_entry($this->username . "_" . $table_name, $edit_id);
			return json_encode($departmentEditdata, true);
		}
		die();
	}

	public function update_data_2DB()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		//$table_name = $this->username.'_'.$table;
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			// print_r($_POST);
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				//$update_data['image'] = $newName;
				// print_r($update_data);
				// die(); 
				$isduplicate = $this->duplicate_data2($update_data, $table_name);
				if ($isduplicate == 0) {
					$departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
					$updatedisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$updatedisplaydata = json_decode($updatedisplaydata, true);
					$response = 1;
				} else {
					return 0;
				}
			}
		}
		echo $response;
		die();
	}

	public function insert_data_2DB()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		//  $table_name = $this->username.'_'.$table;
		$action_name = $this->request->getPost("action");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			if (!empty($_POST)) {
				$insert_data = $_POST;
				$isduplicate = $this->duplicate_data2($insert_data, $table_name);
				if ($isduplicate == 0) {
					$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
					$insert_displaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$insert_displaydata = json_decode($insert_displaydata, true);
					return 0;
				} else {
					return 1;
				}
			}
		}
	}

	public function view_data2()
	{
		if ($this->request->getPost("action") == "view") {
			$view_id = $this->request->getPost('view_id');
			$table_name = $this->request->getPost('table');
			$userEditdata = $this->MasterInformationModel->edit_entry2($table_name, $view_id);
			return json_encode($userEditdata, true);
		}
		die();
	}


	public function edit_data2()
	{
		if ($this->request->getPost("action") == "edit") {
			$edit_id = $this->request->getPost('edit_id');
			$table_name = $this->request->getPost('table');
			//$table_name = $this->username.'_'.$table;
			$departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);
			return json_encode($departmentEditdata, true);
		}
		die();
	}


	public function food_master_insert_data()
	{
		$imgfile = "";
		$data = array();
		$newName = '';
		$files = $_FILES;
		$fileName = '';
		if (!empty($files)) {
			$uploadDir = 'assets/images/food_type/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			$filesArr = $_FILES["image"];
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
			if (!empty($_POST)) {
				$insert_data = $_POST;
				if ($fileName != '') {
					$insert_data['image'] = $fileName;
				}
				$isduplicate = $this->duplicate_data2($insert_data, $table_name);
				if ($isduplicate == 0) {
					$response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
					$foodmasterdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$foodmasterdisplaydata = json_decode($foodmasterdisplaydata, true);
				} else {
					return "error";
				}
			}
		}
	}

	public function ftype_list_data()
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$get_roll_id_to_roll_duty_var = array();
		} else {
			// $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
		}
		$table_username = '';
		$table_name = $_POST['table'];
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];

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


		// $masterdisplaydata = $this->MasterInformationModel->display_all_records($table_name);
		// $masterdisplaydata = json_decode($masterdisplaydata, true);
		
		$sql = "SELECT * FROM master_food_type";
		$main_sql = $sql;
		$DataBase = \Config\Database::connect('second');
		$Getresult = $DataBase->query($sql);
		$masterdisplaydata = $Getresult->getResultArray();


		if ($Getresult->getNumRows() > 0) {
            // pre($result);
            $rowCount = $Getresult->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;

            $pagesCount = ceil($rowCount / $perPageCount);
			$lowerLimit = ($pageNumber - 1) * $perPageCount;
			$sqlQuery = $main_sql . " ORDER BY `id` LIMIT $lowerLimit , $perPageCount";
			$Getresult = $DataBase->query($sqlQuery);
			$finalresult = $Getresult->getResultArray();
			$rowCount_child = $Getresult->getNumRows();
			$start_entries = $lowerLimit + 1;
			$last_entries = $start_entries + $rowCount_child - 1;
			$row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
			// print_r($finalresult);
			$i = 1;
			$html = "";
			$ftype = "";
			$ftype .= '<select id="food_type" name="food_type"
					class="selectpicker form-control form-main place"
					data-live-search="true" tabindex="-98" required="">
					<option class="dropdown-item" data-food-id="" value=""> Food Type</option>';
		foreach ($finalresult as $key => $value) {
			// print_r($value);
			$html .= '<tr>
			<td style="width:0%"><input class="check_box table_list_check" type="checkbox" data-delete_id="' . $value['id'] . '"></td>';
			// if ($table_name == $table_username . '_food_type') {
				$html .= '
				<td class="edt" data-edit_id="' . $value['id'] . '">
					<div class=" px-0 py-0 w-100" data-bs-target="#food-type-add-modal" data-bs-toggle="modal">
						<div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
							<div class="col">
								<b> ' . $value['id'] . '</b>
								<span class="mx-1">' . $value['type'] . '</span>
							</div>
						</div>
					</div>
				</td>
			';
				$ftype .= '<option class="dropdown-item" value="' . $value["id"] . '"data-food-id="' . $value["id"] . '">' . $value["type"] . '</option>';
			// }
		}
		// if (!empty($html)) {
		// 	$result['html'] = $html;
		// } else {
		// 	$result['html'] = '<p style="text-align:center;">Data Not Found</p>';
		// }
		$result['row_count_html'] = $row_count_html;
        $result['total_page'] = $pagesCount;
			$result['html'] = $html;
		// $result['ftype'] = $ftype;
		$result['response'] = 1;
		}else{
			$result['row_count_html'] = $row_count_html;
            // $result['html'] = $html;
            $result['row_count_html'] = "Page 0 of 0";
            $result['response'] = 1;
		}
		return json_encode($result);
		die();

	}




	public function property_update_data()
	{
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$update_id = $this->request->getPost("edit_id");
		$response = 0;
		if ($this->request->getPost("action") == "update") {
			//print_r($_POST);
			unset($_POST['action']);
			unset($_POST['edit_id']);
			unset($_POST['table']);
			if (!empty($post_data)) {
				$update_data = $_POST;
				$isduplicate = $this->duplicate_data($update_data, $this->username . "_" . $table_name);
				if ($isduplicate == 0) {
					$departmentUpdatedata = $this->MasterInformationModel->update_entry($update_id, $update_data, $this->username . "_" . $table_name);
					$departmentdisplaydata = $this->MasterInformationModel->display_all_records($this->username . "_" . $table_name);
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
	//delete
	public function property_delete_data()
	{
		if ($this->request->getPost("action") == "delete") {
			$delete_id = $this->request->getPost('del_id');
			$table_name = $this->request->getPost('table');
			$departmentdisplaydata = $this->MasterInformationModel->delete_entry($this->username . "_" . $table_name, $delete_id);
		}
		die();
	}
	//property view
	public function property_view_data()
	{
		if ($this->request->getPost("action") == "view") {
			$view_id = $this->request->getPost('view_id');
			$table_name = $this->request->getPost('table');
			$userEditdata = $this->MasterInformationModel->edit_entry($this->username . "_" . $table_name, $view_id);
			return json_encode($userEditdata, true);
		}
		die();
	}
	public function property_list_data()
	{
		$table_name = $_POST['table'];
		//pre($table_name);
		$allow_data = json_decode($_POST['show_array']);
		$action = $_POST['action'];
		$query = "project_name = " . $_POST['project'] . "  ";
		$propertydisplaydata = $this->MasterInformationModel->filter_data($this->username . "_" . $table_name, $query);
		$propertydisplaydata = json_decode($propertydisplaydata, true);
		$projectdisplaydata = get_table_array_helper($this->username . '_project');
		//$builderdisplaydata = get_table_array_helper('builder');
		//$booking = get_table_array_helper($this->username.'_booking');
		$i = 1;
		$html = "";
		if (!empty($propertydisplaydata)) {
			foreach ($propertydisplaydata as $key => $value) {
				$list_id = $value[array_key_first($value)];
				$allow_user = 0;
				$bokkinf_site = 0;
				$html .= '<tr project_management_properties_show>';
				$html .= '<td><input class="checkbox mx-2 mt-2" type="checkbox"><!----></td>';
				$project_data = project_id_to_full_project_data($value['project_name']);
				$intrested_site = isset($project_data['project_name']) && !empty($project_data['project_name']) ? $project_data['project_name'] : '';
				$unit_no = isset($value['unit_no']) && !empty($value['unit_no']) ? $value['unit_no'] : '';
				$size = isset($value['property_size']) && !empty($value['property_size']) ? $value['property_size'] : '';
				$side = isset($value['property_side']) && !empty($value['property_side']) ? $value['property_side'] : '';
				$s_build_up = isset($value['build_up_area']) && !empty($value['build_up_area']) ? $value['build_up_area'] : '';
				$carpetarea = isset($value['carpet_area']) && !empty($value['carpet_area']) ? $value['carpet_area'] : '';
				$construction_size = isset($value['construction_size']) && !empty($value['construction_size']) ? $value['construction_size'] : '';
				$construction_type = isset($value['construction_type']) && !empty($value['construction_type']) ? $value['construction_type'] : '';
				$floor = isset($value['property_floor']) && !empty($value['property_floor']) ? $value['property_floor'] : '';
				$total_price = isset($value['total_price']) && !empty($value['total_price']) ? $value['total_price'] : '';
				$property_price = isset($value['property_price']) && !empty($value['property_price']) ? $value['property_price'] : '';
				$development = isset($value['property_development']) && !empty($value['property_development']) ? $value['property_development'] : '';
				$ec_charge = isset($value['connection_charg']) && !empty($value['connection_charg']) ? $value['connection_charg'] : '';
				$registry_charge = isset($value['registry_charg']) && !empty($value['registry_charg']) ? $value['registry_charg'] : '';
				$loan_expense = isset($value['loan_expences']) && !empty($value['loan_expences']) ? $value['loan_expences'] : '';
				$gst_charge = isset($value['gst_charges']) && !empty($value['gst_charges']) ? $value['gst_charges'] : '';
				$other_expnces = isset($value['other_expences']) && !empty($value['other_expences']) ? $value['other_expences'] : '';
				$maintainece = isset($value['property_maintenance']) && !empty($value['property_maintenance']) ? $value['property_maintenance'] : '';
				$white = isset($value['white']) && !empty($value['white']) ? $value['white'] : '';
				$class_name = "";
				// foreach ($booking as $key_book => $value_book) {
				// 	if($value_book['project_name'] == $value['project'] && $value_book['unitno'] == $value['unit_no']){
				// 		$class_name = 'style="background-color:#65edaf6b;"';
				// 	}
				// }
				$html .= '<td class="' . $this->username . "_" . $table_name . '_show" data-bs-toggle="modal" data-bs-target="#' . $this->username . "_" . $table_name . '_show" data-edit_id="' . $list_id . '" data-view_id="' . $list_id . '">
								<div class="d-flex mt-0 p-2 flex-wrap"> 
	                                <div class="col-lg-9 col-sm-6 col-sm-6 col-xxs-12">
	                                    <ul class="p-0 d-flex mb-0" style="flex-wrap: wrap;">
	                                        <li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>id. </b>' . $value['id'] . '</li>                    
	                                        <li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>Project Name : </b>' . $intrested_site . ' </li>                    
	                                        <li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>Unit No : </b>' . $unit_no . '</li>';
				if (!empty($s_build_up)) {
					$html .= '<li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>Super Build Up : </b>' . $s_build_up . '</li>';
				}
				if (!empty($carpetarea)) {
					$html .= '<li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>Carpet Area : </b>' . $carpetarea . '</li>';
				}
				if (!empty($construction_size)) {
					$html .= '<li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>Construction Size : </b>' . $construction_size . '</li>';
				}
				if (!empty($construction_type)) {
					$html .= '<li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>Construction Type : </b>' . $construction_type . '</li>';
				}
				if (!empty($floor)) {
					$html .= '<li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>Floor : </b>' . $floor . '</li>';
				}
				if (!empty($white)) {
					$html .= '<li class="item-column col-lg-4 col-md-6 col-sm-12 col-xxs-12 px-1"><b>White : </b>' . $white . '</li>';
				}
				$html .= '</ul>
	                                </div>';
				$html .= '<div class="col-lg-3 col-sm-6 col-sm-6 col-xxs-12">
	                            			<ul class="p-0 mb-0 price_detail" style="flex-wrap: wrap;">';
				if (!empty($property_price)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Price : </b>' . $property_price . '</li>';
				}
				if (!empty($ec_charge)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Electric Connection Charge : </b>' . $ec_charge . '</li>';
				}
				if (!empty($registry_charge)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Registry Charg : </b>' . $registry_charge . '</li>';
				}
				if (!empty($loan_expense)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Loan Expences : </b>' . $loan_expense . '</li>';
				}
				if (!empty($gst_charge)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Gst Charges : </b>' . $gst_charge . '</li>';
				}
				if (!empty($other_expnces)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Other Expences : </b>' . $other_expnces . '</li>';
				}
				if (!empty($maintainece)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Maintenance : </b>' . $maintainece . '</li>';
				}
				if (!empty($development)) {
					$html .= '<li class="item-column col-12 d-flex justify-content-between align-items-center px-1"><b>Development : </b>' . $development . '</li>';
				}
				// $totalprice = 0;
				// if(!empty($main_price)){
				// 	if(empty($ec_charge)){
				//  	$ec_charge = 0;
				//  }
				//  if(empty($registry_charge)){
				//  	$registry_charge = 0;
				//  }
				//  if(empty($loan_expense)){
				//  	$loan_expense = 0;
				//  }
				//  if(empty($gst_charge)){
				//  	$gst_charge = 0;
				//  }
				//  if(empty($other_expnces)){
				//  	$other_expnces = 0;
				//  }
				//  if(empty($maintainece)){
				//  	$maintainece = 0;
				//  }
				//  if(empty($development)){
				//  	$development = 0;
				//  }
				//  $main_price =str_replace(",","",$main_price);
				// 	$totalprice = $ec_charge+$registry_charge+$loan_expense+$gst_charge+$maintainece+$main_price+$development;
				if (!empty($total_price)) {
					$html .= '<li class="item-column total_price_pro col-12 d-flex justify-content-between px-1 align-items-center total_price_bg" ><b>Total Price : </b>' . $total_price . '</li>';
				}
				$html .= '</ul>
	                            </div>';
				$html .= '</div>
	                        </td>';
				$html .= '</tr>';
				$i++;
			}
		}
		if (!empty($html)) {
			echo $html;
		} else {
			echo '<td></td><td style="text-align:center;">Data Not Found </td>';
		}
		die();
	}

	public function get_country_data()
	{
		$thirdDb = \Config\Database::connect();
		$table_name = $this->request->getPost("table");
		$selectedValue = $this->request->getPost("selected"); // Renamed to avoid conflict with $selected in loop

		$departmentdisplaydata = $thirdDb->table($table_name)->orderBy('id', 'ASC')->get();
		$departmentdisplaydata = json_encode($departmentdisplaydata->getResult());
		$departmentdisplaydata = json_decode($departmentdisplaydata, true);

		$html = "";
		foreach ($departmentdisplaydata as $value) {
			$selected = ($value['name'] == $selectedValue) ? "selected" : ""; // Check if current option matches selected value
			$html .= '<option value="' . $value['name'] . '" ' . $selected . ' countryid="' . $value['id'] . '">' . $value['name'] . '</option>';
		}

		echo $html;
	}

	public function getStatesData()
	{
		$thirdDb = \Config\Database::connect();
		$table_name = $this->request->getPost("table");
		$selectedValue = $this->request->getPost("selected");
		$countryId = $this->request->getPost("countryId");
		$departmentdisplaydata = $thirdDb->table($table_name)->where("country_id", $countryId)->get();
		$departmentdisplaydata = json_encode($departmentdisplaydata->getResult());
		$departmentdisplaydata = json_decode($departmentdisplaydata, true);
		$html = "";
		foreach ($departmentdisplaydata as $key => $value) {
			$selected = ($value['name'] == $selectedValue) ? "selected" : "";
			$html .= '<option value="' . $value['name'] . '" ' . $selected . ' stateid="' . $value['id'] . '">' . $value['name'] . '</option>';
		}
		echo $html;
	}

	public function getCitiesData()
	{
		$thirdDb = \Config\Database::connect();
		$table_name = $this->request->getPost("table");
		$selectedValue = $this->request->getPost("selected");
		$stateId = $this->request->getPost("stateId");
		$departmentdisplaydata = $thirdDb->table($table_name)->where("state_id", $stateId)->get();
		$departmentdisplaydata = json_encode($departmentdisplaydata->getResult());
		$departmentdisplaydata = json_decode($departmentdisplaydata, true);
		$html = "";
		foreach ($departmentdisplaydata as $key => $value) {
			$selected = ($value['name'] == $selectedValue) ? "selected" : "";
			$html .= '<option value="' . $value['name'] . '" ' . $selected . ' cityid="' . $value['id'] . '">' . $value['name'] . '</option>';
		}
		echo $html;
	}
}
