<?php



namespace App\Controllers;



use App\Models\MasterInformationModel;

use Config\Database;



class DietController extends BaseController
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


    public function DietRequestList(){
        $html = '';
        $Count = 0;
        if($_POST['number'] == '1'){
            $departmentdisplaydata = $this->MasterInformationModel->display_all_records2('master_diet');
            $departmentdisplaydata = json_decode($departmentdisplaydata, true);
            // pre($departmentdisplaydata);
            foreach ($departmentdisplaydata as $key => $value) {
                $id = $value['id'];
                $DiatPlanName = $value['DiatPlanName'];
                $Duration = $value['Duration'];
                $Repetition = $value['Repetition'];
                $AvarageCalorie = $value['AvarageCalorie'];
                $DiatDayandFoodArray = $value['DiatDayandFoodArray'];
                $CreatedAt = $value['CreatedAt'];
                if($Repetition == '1'){
                    $Repetition = 'Daily';
                }
                if($Repetition == '2'){
                    $Repetition = 'Weekly';
                }
                if($Repetition == '3'){
                    $Repetition = 'Custom';
                }
                if($CreatedAt != '' && $CreatedAt != '0000-00-00 00:00:00'){
                    $CreatedAt = date('d-m-Y', strtotime($CreatedAt));
                }
                $Count++;

                $html .= '
                    <tr class="even ViewClickEventMasterDiet" DataDietID = "'.$id.'" DataDietPlanName= "'.strtolower($DiatPlanName).'"  DataDietAvarageCalorie = "'.$AvarageCalorie.'" DataDietRepetition = "'.$Repetition.'"  DataDietDuration="'.$Duration.'">
                        <td style="width:0%" hidden="" class="sorting_1"><input class="check_box table_list_check"
                                type="checkbox" data-delete_id="14"></td>
                        <td class="edt" data-edit_id="14">
                            <div class=" px-0 py-0 w-100">
                                <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-4 ViewMasterDietPlan"
                                    dietcaleries="2100" dietduration="30" dietrepetation="Daily"
                                    dietname="Monday to thursday" dataid="14">
                                    <div class="col d-flex">
                                            <b class="mx-1 ">'.$Count.'</b>
                                            <span class="mx-1 text-capitalize">'.strtolower($DiatPlanName).'</span>

                                    </div>
                                    <div class="col d-flex">
                                            <b>Repetition:</b>
                                            <span class="mx-1">'.$Repetition.'</span>
                                    </div>
                                    <div class="col">
                                            <b>Duration :</b>
                                            <span class="mx-1">'.$Duration.' Days</span>
                                    </div>
                                    <div class="col">
                                            <b>Target Calories:</b>
                                            <span class="mx-1">'.$AvarageCalorie.'</span>
                                    </div>
                                    <div class="col">
                                            <b>Created Date:</b>
                                            <span class="mx-1">'.$CreatedAt.'</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                ';
            }
        }

        if($_POST['number'] == '2'){
            $dbgym = \Config\Database::connect('gym');
            $MasterUserSQL = "SELECT * FROM `master_user`";
            $MasterUserSQL = $dbgym->query($MasterUserSQL);
            $MasterUserData = $MasterUserSQL->getResultArray();
            $ArrayBeforeMerge = array();

            $Count = 0;
        
            foreach ($MasterUserData as $MUKey => $MasterVal) {
                $MasterUserName = $MasterVal['username'];
                if (isTableExistsGym($MasterUserName . '_diet') == '1') {
                    $DTableName =  $MasterUserName . '_diet';
                    $MasterUserDietTableSQL = "SELECT * FROM `".$DTableName."`";
                    $MasterUserDietTableSQL = $dbgym->query($MasterUserDietTableSQL);
                    $MasterUserDietData = $MasterUserDietTableSQL->getResultArray();
                    if(isset($MasterUserDietData) && !empty($MasterUserDietData)){
                        foreach ($MasterUserDietData as $dietData) {
                            $ArrayBeforeMerge[] = array_merge($dietData, array(
                                'userid' => $MasterVal['id'],
                                'usernameid' => $MasterVal['username'],
                                'username' => $MasterVal['name']
                            ));
                        }
                    }
                }
            }
        
            usort($ArrayBeforeMerge, function ($a, $b) {
                return strtotime($b['CreatedAt']) - strtotime($a['CreatedAt']);
            });
        
            foreach ($ArrayBeforeMerge as $DietKey => $DietVal) {
                $id = $DietVal['id'];
                $DiatPlanName = $DietVal['DiatPlanName'];
                $Duration = $DietVal['Duration'];
                $Repetition = $DietVal['Repetition'];
                $AvarageCalorie = $DietVal['AvarageCalorie'];
                $DiatDayandFoodArray = $DietVal['DiatDayandFoodArray'];
                $CreatedAt = $DietVal['CreatedAt'];
                $userid = $DietVal['userid'];
                $usernameid = $DietVal['usernameid'];
                $username = $DietVal['username'];
                if($Repetition == '1'){
                    $Repetition = 'Daily';
                }
                if($Repetition == '2'){
                    $Repetition = 'Weekly';
                }
                if($Repetition == '3'){
                    $Repetition = 'Custom';
                }
                if($CreatedAt != '' && $CreatedAt != '0000-00-00 00:00:00'){
                    $CreatedAt = date('d-m-Y', strtotime($CreatedAt));
                }
                $Count++;
                $html .= '
                    <tr class="even ViewClickEventSuggestDiet" DataDietID = "'.$id.'" DataDietPlanName= "'.strtolower($DiatPlanName).'" Datausernameid = "'.$usernameid.'" Datauserid = "'.$userid.'" DataDietAvarageCalorie = "'.$AvarageCalorie.'" DataDietRepetition = "'.$Repetition.'"  DataDietDuration="'.$Duration.'">
                        <td style="width:0%" hidden="" class="sorting_1"><input class="check_box table_list_check"
                                type="checkbox" data-delete_id="14"></td>
                        <td class="edt" data-edit_id="14">
                            <div class=" px-0 py-0 w-100">
                                <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-4 ViewMasterDietPlan"
                                    dietcaleries="2100" dietduration="30" dietrepetation="Daily"
                                    dietname="Monday to thursday" dataid="14">
                                    <div class="col d-flex">
                                            <b class="mx-1 ">'.$Count.'</b>
                                            <span class="mx-1 text-capitalize">'.strtolower($DiatPlanName).'</span>

                                    </div>
                                    <div class="col d-flex">
                                            <b>Repetition:</b>
                                            <span class="mx-1">'.$Repetition.'</span>
                                    </div>
                                    <div class="col">
                                            <b>Duration :</b>
                                            <span class="mx-1">'.$Duration.' Days</span>
                                    </div>
                                    <div class="col">
                                            <b>Target Calories:</b>
                                            <span class="mx-1">'.$AvarageCalorie.'</span>
                                    </div>
                                    <div class="col">
                                            <b>Added By:</b>
                                            <span class="mx-1 text-capitalize">'.$usernameid.'</span>
                                    </div>
                                    <div class="col">
                                            <b>Created Date:</b>
                                            <span class="mx-1">'.$CreatedAt.'</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                ';


            }
        }
        echo $html;
    }


    public function MainMasterDietView(){
        $db = \Config\Database::connect('second');
		$sql = 'SELECT * FROM `master_food_items`';
		$result = $db->query($sql);
		$EditID = $_POST['DataDietID'];
        $dbgym = \Config\Database::connect('second');
        $MasterUserSQL = "SELECT * FROM `master_diet` WHERE id = ".$EditID."";
        $MasterUserSQL = $dbgym->query($MasterUserSQL);
        $DietData = $MasterUserSQL->getRowArray();
		$QTYUnit = '';
		if (isset($DietData) && !empty($DietData)) {

		} else {
			die();
		}

		$DietArray = $DietData['DiatDayandFoodArray'];
		$CaleryTarget = $DietData['AvarageCalorie'];
		$DietArray = json_decode($DietArray, true);
		$ReturnHtml = '';
		$DayHtml = '';
		$BaseURL = base_url();
		$DietName = $DietData['DiatPlanName'];
		$DietRepetation = $DietData['Repetition'];
		$DietDuration = $DietData['Duration'];
		$DietCaleryTarget = $DietData['AvarageCalorie'];
		// pre($DietData);

		foreach ($DietArray as $DietKey => $DietValue) {
			$DayName = $DietValue['DayName'];
			$MealsArray = $DietValue['Meals'];
			$MealCheckHtml = 0;
			$CountCount = 0;
			$MealArraySpanCount = count($MealsArray);
			$MealTotalCountCalery = 0;
			$MealTotalCountCarbs = 0;
			$MealTotalCountFiber = 0;
			$MealTotalCountFats = 0;
			$MealTotalCountProtine = 0;


			$TotalMealHtml = '';
			$TTMeal= 0;
			foreach ($MealsArray as $MealKey => $MealValue) {
				$MealName = $MealValue['MealName'];
				if(strtolower($MealName) == 'morning snacks' || strtolower($MealName) == 'evening snacks' || strtolower($MealName) == 'nutritious snacks' || strtolower($MealName) == 'morning snack' || strtolower($MealName) == 'evening snack' || strtolower($MealName) == 'nutritious snack'){
					$TTMeal = floatval($TTMeal) + 0.5;
				}else{
					$TTMeal = floatval($TTMeal) + 1;
				}
			}
			foreach ($MealsArray as $MealKey => $MealValue) {
				$CountCount++;
				$MealName = $MealValue['MealName'];

				$MealTime = $MealValue['MealTime'];


				$FoodArray = $MealValue['SubArray'];
				$ArraySpanCount = count($FoodArray) + 1;

				$TotalFiber = 0;
				$MealHtml = '';
				$TotalMealCalery = 0;
				$MealHtml .= '<tbody>';
				$TotalProtine = 0;
				$TotalCarbs = 0;
				$TotalFat = 0;
				$HtmlCount = 0;
          
				foreach ($FoodArray as $FoodKey => $FoodValue) {

                    if(isset($FoodValue['Unit']) && isset($FoodValue['FoodName'])){
                        $FoodName = $FoodValue['FoodName'];
                        $FoodUnit = $FoodValue['Unit'];
                        $QTYUnit = $FoodValue['QTYUnit'];
                        $FoodQTYUnit = $FoodValue['QTYUnit'];
                        $ItemName = '';
                        switch ($FoodUnit) {
                            case '1':
                                $ItemName = 'Glass';
                                break;
                            case '2':
                                $ItemName = 'Cup';
                                break;
                            case '3':
                                $ItemName = 'Table Spoon';
                                break;
                            case '4':
                                $ItemName = 'Plate';
                                break;
                            case '5':
                                $ItemName = 'NOS';
                                break;
                        }


                        $FoodSML = $FoodValue['SML'];
                        $FoodSMLvalue = '0';
                        $FoodGetDateArray = get_editData2('master_food_items', intval($FoodName));
                        if (isset($FoodGetDateArray) && !empty($FoodGetDateArray)) {
                            $FoodNameA = $FoodGetDateArray['FoodName'];
                            $VegNonVegA = $FoodGetDateArray['VegNonVeg'];
                            // pre($VegNonVegA);
                            $FoodTypeA = $FoodGetDateArray['FoodType'];
                            $FoodTypeNameA = '';
                            $FoodTypeNameArray = get_editData2('master_food_type', intval($FoodTypeA));
                            if (isset($FoodTypeNameArray) && !empty($FoodTypeNameArray)) {
                                $FoodTypeNameA = $FoodTypeNameArray['type'];
                            }
                            $ImageA = $FoodGetDateArray['Image'];
                            $NutritionValueA = $FoodGetDateArray['NutritionValue'];
                            $NutritionUnitA = $FoodGetDateArray['NutritionUnit'];
                            $CaloriesA = $FoodGetDateArray['Calories'];
                            $CarbsA = $FoodGetDateArray['Carbs'];
                            $ProteinA = $FoodGetDateArray['Protein'];
                            $FatsA = $FoodGetDateArray['Fats'];
                            $FiberA = $FoodGetDateArray['Fiber'];
                            $MeasurementA = $FoodGetDateArray['Measurement'];
                            $MeasurementUnitStoreArrayA = $FoodGetDateArray['MeasurementUnitStoreArray'];
                            $MeasurementUnitStoreArrayA = json_decode($MeasurementUnitStoreArrayA, true);
                            $SMLArray = null;
                            foreach ($MeasurementUnitStoreArrayA as $item) {
                                if (isset($item[strval($FoodUnit)])) {
                                    $SMLArray = [$item[strval($FoodUnit)]];
                                    break;
                                }
                            }
                            $smallsize = 0;
                            $largesize = 0;
                            $mediumsize = 0;

                            if (isset($SMLArray) && !empty($SMLArray)) {
                                $smallsize = $SMLArray[0]['small'];
                                $largesize = $SMLArray[0]['large'];
                                $mediumsize = $SMLArray[0]['medium'];
                            }

                            if ($FoodSML == 'small') {
                                $FoodSMLvalue = $smallsize;

                            }
                            if ($FoodSML == 'large') {
                                $FoodSMLvalue = $largesize;

                            }
                            if ($FoodSML == 'medium') {
                                $FoodSMLvalue = $mediumsize;

                            }

                            $CaleryCount = 0;
                            $FatsCount = 0;
                            $FiberCount = 0;
                            $CarbsCount = 0;
                            $ProtineCount = 0;


                            if($FoodQTYUnit == '' || floatval($FoodQTYUnit) == '0'){
                                $FoodQTYUnit = 1; 
                            }

                            if ($FoodSMLvalue != '' && floatval($FoodSMLvalue) > 0) {
                                if (floatval($ProteinA) > 0) {

                                    $ProtineCount = floatval($FoodSMLvalue) * floatval($ProteinA) / floatval($NutritionValueA);
                                    $ProtineCount = floatval($ProtineCount) * floatval($FoodQTYUnit) / 1 ;


                                }
                                if (floatval($CarbsA)) {

                                    $CarbsCount = floatval($FoodSMLvalue) * floatval($CarbsA) / floatval($NutritionValueA);
                                    $CarbsCount = floatval($CarbsCount) * floatval($FoodQTYUnit) / 1 ;


                                }


                                if (floatval($FiberA) > 0) {
                                    $FiberCount = floatval($FoodSMLvalue) * floatval($FiberA) / floatval($NutritionValueA);
                                    $FiberCount = floatval($FiberCount) * floatval($FoodQTYUnit) / 1 ;

                                }
                            
                                // $TotalFiber += $FiberCount;
                                if (floatval($FatsA) > 0) {

                                    $FatsCount = floatval($FoodSMLvalue) * floatval($FatsA) / floatval($NutritionValueA);
                                    $FatsCount = floatval($FatsCount) * floatval($FoodQTYUnit) / 1 ;

                                }
                                if (floatval($CaloriesA) > 0) {
                                    $CaleryCount = floatval($FoodSMLvalue) * floatval($CaloriesA) / floatval($NutritionValueA);
                                    $CaleryCount = floatval($CaleryCount) * floatval($FoodQTYUnit) / 1 ;

                                }
                            } else {
                                $CaleryCount = 0;
                                $FatsCount = 0;
                                $FiberCount = 0;
                                $CarbsCount = 0;
                                $ProtineCount = 0;
                            }

                            $FoodImageUrl = '';
                            if ($ImageA != '') {
                                $FoodImageUrl = $BaseURL . 'assets/images/food_type/' . $ImageA;
                            } else {
                                $FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
                            }
                            // $CountCount ++;
                            
                            $exercise_img = $ImageA;

                        


                            $string = $_SERVER['DOCUMENT_ROOT'];
                            $substring = 'rudrramc';
                            if (strpos($string, $substring) !== false) {
                                $FoodImageUrl = 'https://admin.ajasys.com/assets/FoodPhotos/'.$exercise_img;
                            } else {
                                $FoodImageUrl = 'http://localhost/admin/assets/FoodPhotos/'.$exercise_img;
                            }
                            if($exercise_img == ''){

                                $FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
                            }


                            $TotalMealCalery = floatval($TotalMealCalery) + floatval($CaleryCount);
                            $TotalProtine = floatval($TotalProtine) + floatval($ProtineCount);
                            $TotalCarbs = floatval($TotalCarbs) + floatval($CarbsCount);
                            $TotalFat = floatval($TotalFat) + floatval($FatsCount);
                            $TotalFiber = floatval($TotalFiber) + floatval($FiberCount);



                            $HtmlCount++;

                            if ($HtmlCount == '1') {
                                $MealCheckHtml++;
                                $MealHtml .= '
                                            <tr class="deit-plane-heading">
                                                <td rowspan="' . $ArraySpanCount . '">
                                                    <div style="max-width:150px;word-break: break-all;">' . $MealName . '</div>
                                                    <div><span><i class="bi bi-clock-history m-0 me-1"></i></span>' . $MealTime . '</div>
                                                </td>
                                                <td class="d-flex flex-wrap align-items-center border-0">
                                                    <div class="me-3" style="width:30px;height:30px">
                                                        <img src="' . $FoodImageUrl . '" alt="#" class="w-100 h-100">
                                                    </div>
                                                    <div class="col">' . $FoodNameA . '';


                                if ($VegNonVegA == '1') {
                                    $MealHtml .= '				<div class="ms-1 d-inline-block">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"></path>
                                                                                    <circle cx="1318" cy="1317" r="611" fill="#19C82A"></circle>
                                                                                </svg>
                                                                            </div>';
                                }
                                if ($VegNonVegA == '2') {
                                    $MealHtml .= '				<div class="ms-1 d-inline-block">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#FF0000"></path>
                                                                                    <circle cx="1318" cy="1317" r="611" fill="#FF0000"></circle>
                                                                                </svg>
                                                                        </div>';
                                }
                                if ($VegNonVegA == '3') {
                                    $MealHtml .= '				<div class="ms-1 d-inline-block">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#747474"></path>
                                                                                <path d="M1317.5 1960.12C1033.45 1960.12 803 1686.8 803 1402.75C803 1102.62 974.5 673.875 1317.5 673.875C1660.5 673.875 1832 1102.62 1832 1402.75C1832 1686.8 1601.55 1960.12 1317.5 1960.12ZM1217.82 990.078C1235.23 974 1236.57 946.935 1220.5 929.517C1204.42 912.099 1177.35 910.759 1159.93 926.838C1095.89 985.255 1049.8 1068.06 1019.79 1152.47C989.774 1236.88 974.5 1326.91 974.5 1402.75C974.5 1426.33 993.794 1445.62 1017.38 1445.62C1040.96 1445.62 1060.25 1426.33 1060.25 1402.75C1060.25 1337.1 1073.65 1256.97 1100.71 1180.87C1127.78 1104.5 1167.71 1035.9 1217.82 990.078Z" fill="#747474"></path>
                                                                            </svg>
                                                                        </div>';
                                }




                                $MealHtml .= '	</div>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . $QTYUnit . '</div>
                                                </td>
                                                <td>
                                                    <div class="fw-medium d-flex align-items-center justify-content-between">
                                                        <span>' . $ItemName . '</span><span>(' . $FoodSML . ')</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . intval($CaleryCount) . '</div>
                                                </td>
                                                <td hidden>
                                                    <div class=" fw-medium ">' . $FoodTypeNameA . '</div>
                                                </td> 									
                                            </tr>';
                            } else {
                                $MealHtml .=
                                    '<tr class="deit-plane-heading " >
                                                <td class="d-flex flex-wrap align-items-center border-0">
                                                    <div class="me-3" style="width:30px;height:30px">
                                                        <img src="' . $FoodImageUrl . '" alt="#" class="w-100 h-100">
                                                    </div>
                                                    <div class="col">' . $FoodNameA . '
                                                        <div class="ms-1 d-inline-block">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"></path>
                                                                <circle cx="1318" cy="1317" r="611" fill="#19C82A"></circle>
                                                            </svg>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . $QTYUnit . '</div>
                                                </td>
                                                <td>
                                                    <div class="fw-medium d-flex align-items-center justify-content-between">
                                                    <span>' . $ItemName . '</span><span>(' . $FoodSML . ')</span>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . intval($CaleryCount) . '</div>
                                                </td>
                                                <td hidden>
                                                    <div class=" fw-medium ">' . $FoodTypeNameA . '</div>
                                                </td> 
                                            </tr>';
                            }
                        }
                    }
     

				}


				if (intval($MealCheckHtml) > 0) {
					if (intval($TotalProtine) == '0' && intval($TotalCarbs) !== '0' && intval($TotalFat) == '0' && intval($TotalFiber) == '0' && intval($TotalMealCalery) == '0') {

					} else {
						$MealHtml .= '
									<tr class="deit-plane-heading">
										<td class="text-end p-0" colspan="4" style="background-color: #d8d7ff57;">
											<div class="d-flex">
												<div class="py-1 px-2 text-start">									
													<span class="fw-semibold"><span class="fw-medium"><b> Nutrition : </b></span></span>
												</div>
												<div class="py-1 px-3 ms-auto">									
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Protine : ' . intval($TotalProtine) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Protein.svg" alt=""></span>
														' . intval($TotalProtine) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Carbs : ' . intval($TotalCarbs) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Carbons.svg" alt=""></span>
														' . intval($TotalCarbs) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Fat : ' . intval($TotalFat) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Fats.svg" alt=""></span>
														' . intval($TotalFat) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Fiber : ' . intval($TotalFiber) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Fiber.svg" alt=""></span>
														' . intval($TotalFiber) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="MealCalery : ' . intval($TotalMealCalery) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Calories.svg" alt=""></span>
														' . intval($TotalMealCalery) . '
													</span>
												</div>
											</div>
										</td>
									</tr>
								</tbody>';
					}
				}
				

			$MealTotalCountCarbs = floatval($MealTotalCountCarbs) + floatval($TotalCarbs);
			$MealTotalCountFiber = floatval($MealTotalCountFiber) + floatval($TotalFiber);
			$MealTotalCountFats = floatval($MealTotalCountFats) + floatval($TotalFat);
			$MealTotalCountProtine = floatval($MealTotalCountProtine) + floatval($TotalProtine);
			$MealHtml .= '<script>$(".MealCaleryCountUniqueDiv' . $CountCount . '").text(' . intval($TotalMealCalery) . ');</script>';
			$MealTotalCountCalery = floatval($MealTotalCountCalery) + floatval($TotalMealCalery);
			$TotalMealHtml .= $MealHtml;
			}



			
			// $MealTotalCountCalery = floatval($MealTotalCountCalery) / intval($TTMeal);
			// $MealTotalCountCarbs = floatval($MealTotalCountCarbs) / intval($TTMeal);
			// $MealTotalCountFiber = floatval($MealTotalCountFiber) / intval($TTMeal);
			// $MealTotalCountFats = floatval($MealTotalCountFats) / intval($TTMeal);
			// $MealTotalCountProtine = floatval($MealTotalCountProtine) / intval($TTMeal);



			$RedGreenClass = '';
			if (intval($MealTotalCountCalery) < intval($CaleryTarget) || intval($MealTotalCountCalery) == intval($CaleryTarget)) {
				$RedGreenClass = 'text-success';
			} else {
				$RedGreenClass = 'text-danger';
			}
			$DayHtml .= '
						<div class="w-100 p-3 pb-4 border-top border-bottom main-table data-view-table">
							<div class="d-flex flex-wrap mb-2 justify-content-between" >
								<div class="col-6 d-flex ">
									<h6 Class="fw-bolder">Day Name :</h6>
									<h6 class="mx-2">' . $DayName . '</h6>
								</div>
								
								<div class="col-6 d-flex justify-content-end d-none ">
									<span class= "fw-bolder ' . $RedGreenClass . ' ">' . intval($MealTotalCountCalery) . '</span>
									<span class="mx-2">Out of </span>
									<span class="fw-bolder">' . $CaleryTarget . '</span>
								</div>
							</div>
							<div class="w-100 mt-2">
								<table class="col-12 day-diet-plane">
									<thead>
										<tr class="deit-plane-heading">
											<th class="number-head" style="width: 160px;">
												<span>Meal</span>
											</th>
											<th style="min-width:150px">
												<span>Food</span>
											</th>
											<th>
												<span>QTY</span>
											</th>
											<th>
												<span>Unit</span>
											</th>
											<th>
												<span>Calories</span>
											</th>
											<th hidden>
												<span>Type</span>
											</th>
										</tr>
									</thead>
									' . $TotalMealHtml . '
									<tfoot>
										<tr class="deit-plane-heading">
											<td class="text-end" colspan="5">
												<div class="d-flex">
													<div class="py-1 px-2 text-start">									
														<span class="fw-semibold"><span class="fw-medium"><b>Total Day Nutrition : </b></span></span>
													</div>
													<div class="py-1 px-3 ms-auto">									
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left">
															<span  class="me-2 ">Protine<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Protein.svg" alt=""></span>
															'.intval($MealTotalCountProtine).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" >
															<span class="me-2 ">Carbs<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Carbons.svg" alt=""></span>
															'.intval($MealTotalCountCarbs).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" >
															<span class="me-2">Fat<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Fats.svg" alt=""></span>
															'.intval($MealTotalCountFats).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left">
															<span class="me-2">Fiber<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Fiber.svg" alt=""></span>
															'.intval($MealTotalCountFiber).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left">
															<span class="me-2">Calories<img src="' . $BaseURL . 'assets/FoodPhotos/Calories.svg" hidden alt=""></span>
															' . intval($MealTotalCountCalery) . '
														</span>
													</div>
												</div>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					';
		}


		$Rresult['Html'] = $DayHtml;
		if ($DietRepetation == '1') {
			$DietRepetation = 'Daily';
		}
        // http://localhost/admin/assets/FoodPhotos/download%20(1).jpg
		if ($DietRepetation == '2') {
			$DietRepetation = 'Weekly';
		}
		if ($DietRepetation == '3') {
			$DietRepetation = 'Custom';
		}
		$Rresult['DiatPlanName'] = $DietName;
		$Rresult['Repetition'] = $DietRepetation;
		$Rresult['Duration'] = $DietDuration;
		$Rresult['AvarageCalorie'] = $DietCaleryTarget;
		return json_encode($Rresult);
    }

    public function MasterDietView()
	{
		$db = \Config\Database::connect('second');
		$sql = 'SELECT * FROM `master_food_items`';
		$result = $db->query($sql);
		$table_username = $_POST['Datausernameid'];
		$EditID = $_POST['DataDietID'];
        $dbgym = \Config\Database::connect('gym');
        $MasterUserSQL = "SELECT * FROM `".$_POST['Datausernameid']."_diet` WHERE id = ".$EditID."";
        $MasterUserSQL = $dbgym->query($MasterUserSQL);
        $DietData = $MasterUserSQL->getRowArray();
		$QTYUnit = '';
		if (isset($DietData) && !empty($DietData)) {

		} else {
			die();
		}

		$DietArray = $DietData['DiatDayandFoodArray'];
		$CaleryTarget = $DietData['AvarageCalorie'];
		$DietArray = json_decode($DietArray, true);
		$ReturnHtml = '';
		$DayHtml = '';
		$BaseURL = base_url();
		$DietName = $DietData['DiatPlanName'];
		$DietRepetation = $DietData['Repetition'];
		$DietDuration = $DietData['Duration'];
		$DietCaleryTarget = $DietData['AvarageCalorie'];
		// pre($DietData);

		foreach ($DietArray as $DietKey => $DietValue) {
			$DayName = $DietValue['DayName'];
			$MealsArray = $DietValue['Meals'];
			$MealCheckHtml = 0;
			$CountCount = 0;
			$MealArraySpanCount = count($MealsArray);
			$MealTotalCountCalery = 0;
			$MealTotalCountCarbs = 0;
			$MealTotalCountFiber = 0;
			$MealTotalCountFats = 0;
			$MealTotalCountProtine = 0;


			$TotalMealHtml = '';
			$TTMeal= 0;
			foreach ($MealsArray as $MealKey => $MealValue) {
				$MealName = $MealValue['MealName'];
				if(strtolower($MealName) == 'morning snacks' || strtolower($MealName) == 'evening snacks' || strtolower($MealName) == 'nutritious snacks' || strtolower($MealName) == 'morning snack' || strtolower($MealName) == 'evening snack' || strtolower($MealName) == 'nutritious snack'){
					$TTMeal = floatval($TTMeal) + 0.5;
				}else{
					$TTMeal = floatval($TTMeal) + 1;
				}
			}
			foreach ($MealsArray as $MealKey => $MealValue) {
				$CountCount++;
				$MealName = $MealValue['MealName'];

				$MealTime = $MealValue['MealTime'];


				$FoodArray = $MealValue['SubArray'];
				$ArraySpanCount = count($FoodArray) + 1;

				$TotalFiber = 0;
				$MealHtml = '';
				$TotalMealCalery = 0;
				$MealHtml .= '<tbody>';
				$TotalProtine = 0;
				$TotalCarbs = 0;
				$TotalFat = 0;
				$HtmlCount = 0;
          
				foreach ($FoodArray as $FoodKey => $FoodValue) {

                    if(isset($FoodValue['Unit']) && $FoodName = $FoodValue['FoodName']){
                        $FoodName = $FoodValue['FoodName'];
                        $FoodUnit = $FoodValue['Unit'];
                        // pre($FoodUnit);
                        $QTYUnit = $FoodValue['QTYUnit'];
                        $FoodQTYUnit = $FoodValue['QTYUnit'];
                        

                        $ItemName = '';
                        switch ($FoodUnit) {
                            case '1':
                                $ItemName = 'Glass';
                                break;
                            case '2':
                                $ItemName = 'Cup';
                                break;
                            case '3':
                                $ItemName = 'Table Spoon';
                                break;
                            case '4':
                                $ItemName = 'Plate';
                                break;
                            case '5':
                                $ItemName = 'NOS';
                                break;
                        }


                        $FoodSML = $FoodValue['SML'];
                        $FoodSMLvalue = '0';
                        $FoodGetDateArray = get_editData2('master_food_items', intval($FoodName));
                        if (isset($FoodGetDateArray) && !empty($FoodGetDateArray)) {
                            $FoodNameA = $FoodGetDateArray['FoodName'];
                            $VegNonVegA = $FoodGetDateArray['VegNonVeg'];
                            // pre($VegNonVegA);
                            $FoodTypeA = $FoodGetDateArray['FoodType'];
                            $FoodTypeNameA = '';
                            $FoodTypeNameArray = get_editData2('master_food_type', intval($FoodTypeA));
                            if (isset($FoodTypeNameArray) && !empty($FoodTypeNameArray)) {
                                $FoodTypeNameA = $FoodTypeNameArray['type'];
                            }
                            $ImageA = $FoodGetDateArray['Image'];
                            $NutritionValueA = $FoodGetDateArray['NutritionValue'];
                            $NutritionUnitA = $FoodGetDateArray['NutritionUnit'];
                            $CaloriesA = $FoodGetDateArray['Calories'];
                            $CarbsA = $FoodGetDateArray['Carbs'];
                            $ProteinA = $FoodGetDateArray['Protein'];
                            $FatsA = $FoodGetDateArray['Fats'];
                            $FiberA = $FoodGetDateArray['Fiber'];
                            $MeasurementA = $FoodGetDateArray['Measurement'];
                            $MeasurementUnitStoreArrayA = $FoodGetDateArray['MeasurementUnitStoreArray'];
                            $MeasurementUnitStoreArrayA = json_decode($MeasurementUnitStoreArrayA, true);
                            $SMLArray = null;
                            foreach ($MeasurementUnitStoreArrayA as $item) {
                                if (isset($item[strval($FoodUnit)])) {
                                    $SMLArray = [$item[strval($FoodUnit)]];
                                    break;
                                }
                            }
                            $smallsize = 0;
                            $largesize = 0;
                            $mediumsize = 0;

                            if (isset($SMLArray) && !empty($SMLArray)) {
                                $smallsize = $SMLArray[0]['small'];
                                $largesize = $SMLArray[0]['large'];
                                $mediumsize = $SMLArray[0]['medium'];
                            }

                            if ($FoodSML == 'small') {
                                $FoodSMLvalue = $smallsize;

                            }
                            if ($FoodSML == 'large') {
                                $FoodSMLvalue = $largesize;

                            }
                            if ($FoodSML == 'medium') {
                                $FoodSMLvalue = $mediumsize;

                            }

                            $CaleryCount = 0;
                            $FatsCount = 0;
                            $FiberCount = 0;
                            $CarbsCount = 0;
                            $ProtineCount = 0;


                            if($FoodQTYUnit == '' || floatval($FoodQTYUnit) == '0'){
                                $FoodQTYUnit = 1; 
                            }

                            if ($FoodSMLvalue != '' && floatval($FoodSMLvalue) > 0) {
                                if (floatval($ProteinA) > 0) {

                                    $ProtineCount = floatval($FoodSMLvalue) * floatval($ProteinA) / floatval($NutritionValueA);
                                    $ProtineCount = floatval($ProtineCount) * floatval($FoodQTYUnit) / 1 ;


                                }
                                if (floatval($CarbsA)) {

                                    $CarbsCount = floatval($FoodSMLvalue) * floatval($CarbsA) / floatval($NutritionValueA);
                                    $CarbsCount = floatval($CarbsCount) * floatval($FoodQTYUnit) / 1 ;


                                }


                                if (floatval($FiberA) > 0) {
                                    $FiberCount = floatval($FoodSMLvalue) * floatval($FiberA) / floatval($NutritionValueA);
                                    $FiberCount = floatval($FiberCount) * floatval($FoodQTYUnit) / 1 ;

                                }
                            
                                // $TotalFiber += $FiberCount;
                                if (floatval($FatsA) > 0) {

                                    $FatsCount = floatval($FoodSMLvalue) * floatval($FatsA) / floatval($NutritionValueA);
                                    $FatsCount = floatval($FatsCount) * floatval($FoodQTYUnit) / 1 ;

                                }
                                if (floatval($CaloriesA) > 0) {
                                    $CaleryCount = floatval($FoodSMLvalue) * floatval($CaloriesA) / floatval($NutritionValueA);
                                    $CaleryCount = floatval($CaleryCount) * floatval($FoodQTYUnit) / 1 ;

                                }
                            } else {
                                $CaleryCount = 0;
                                $FatsCount = 0;
                                $FiberCount = 0;
                                $CarbsCount = 0;
                                $ProtineCount = 0;
                            }

                            $FoodImageUrl = '';
                            if ($ImageA != '') {
                                $FoodImageUrl = $BaseURL . 'assets/images/food_type/' . $ImageA;
                            } else {
                                $FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
                            }
                            // $CountCount ++;
                            
                            $exercise_img = $ImageA;

                        


                            $string = $_SERVER['DOCUMENT_ROOT'];
                            $substring = 'rudrramc';
                            if (strpos($string, $substring) !== false) {
                                $FoodImageUrl = 'https://admin.ajasys.com/assets/FoodPhotos/'.$exercise_img;
                            } else {
                                $FoodImageUrl = 'http://localhost/admin/assets/FoodPhotos/'.$exercise_img;
                            }
                            if($exercise_img == ''){

                                $FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
                            }


                            $TotalMealCalery = floatval($TotalMealCalery) + floatval($CaleryCount);
                            $TotalProtine = floatval($TotalProtine) + floatval($ProtineCount);
                            $TotalCarbs = floatval($TotalCarbs) + floatval($CarbsCount);
                            $TotalFat = floatval($TotalFat) + floatval($FatsCount);
                            $TotalFiber = floatval($TotalFiber) + floatval($FiberCount);



                            $HtmlCount++;

                            if ($HtmlCount == '1') {
                                $MealCheckHtml++;
                                $MealHtml .= '
                                            <tr class="deit-plane-heading">
                                                <td rowspan="' . $ArraySpanCount . '">
                                                    <div style="max-width:150px;word-break: break-all;">' . $MealName . '</div>
                                                    <div><span><i class="bi bi-clock-history m-0 me-1"></i></span>' . $MealTime . '</div>
                                                </td>
                                                <td class="d-flex flex-wrap align-items-center border-0">
                                                    <div class="me-3" style="width:30px;height:30px">
                                                        <img src="' . $FoodImageUrl . '" alt="#" class="w-100 h-100">
                                                    </div>
                                                    <div class="col">' . $FoodNameA . '';


                                if ($VegNonVegA == '1') {
                                    $MealHtml .= '				<div class="ms-1 d-inline-block">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"></path>
                                                                                    <circle cx="1318" cy="1317" r="611" fill="#19C82A"></circle>
                                                                                </svg>
                                                                            </div>';
                                }
                                if ($VegNonVegA == '2') {
                                    $MealHtml .= '				<div class="ms-1 d-inline-block">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#FF0000"></path>
                                                                                    <circle cx="1318" cy="1317" r="611" fill="#FF0000"></circle>
                                                                                </svg>
                                                                        </div>';
                                }
                                if ($VegNonVegA == '3') {
                                    $MealHtml .= '				<div class="ms-1 d-inline-block">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#747474"></path>
                                                                                <path d="M1317.5 1960.12C1033.45 1960.12 803 1686.8 803 1402.75C803 1102.62 974.5 673.875 1317.5 673.875C1660.5 673.875 1832 1102.62 1832 1402.75C1832 1686.8 1601.55 1960.12 1317.5 1960.12ZM1217.82 990.078C1235.23 974 1236.57 946.935 1220.5 929.517C1204.42 912.099 1177.35 910.759 1159.93 926.838C1095.89 985.255 1049.8 1068.06 1019.79 1152.47C989.774 1236.88 974.5 1326.91 974.5 1402.75C974.5 1426.33 993.794 1445.62 1017.38 1445.62C1040.96 1445.62 1060.25 1426.33 1060.25 1402.75C1060.25 1337.1 1073.65 1256.97 1100.71 1180.87C1127.78 1104.5 1167.71 1035.9 1217.82 990.078Z" fill="#747474"></path>
                                                                            </svg>
                                                                        </div>';
                                }




                                $MealHtml .= '	</div>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . $QTYUnit . '</div>
                                                </td>
                                                <td>
                                                    <div class="fw-medium d-flex align-items-center justify-content-between">
                                                        <span>' . $ItemName . '</span><span>(' . $FoodSML . ')</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . intval($CaleryCount) . '</div>
                                                </td>
                                                <td hidden>
                                                    <div class=" fw-medium ">' . $FoodTypeNameA . '</div>
                                                </td> 									
                                            </tr>';
                            } else {
                                $MealHtml .=
                                    '<tr class="deit-plane-heading " >
                                                <td class="d-flex flex-wrap align-items-center border-0">
                                                    <div class="me-3" style="width:30px;height:30px">
                                                        <img src="' . $FoodImageUrl . '" alt="#" class="w-100 h-100">
                                                    </div>
                                                    <div class="col">' . $FoodNameA . '
                                                        <div class="ms-1 d-inline-block">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 2635 2635" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"></path>
                                                                <circle cx="1318" cy="1317" r="611" fill="#19C82A"></circle>
                                                            </svg>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . $QTYUnit . '</div>
                                                </td>
                                                <td>
                                                    <div class="fw-medium d-flex align-items-center justify-content-between">
                                                    <span>' . $ItemName . '</span><span>(' . $FoodSML . ')</span>
                                                </td>
                                                <td>
                                                    <div class=" fw-medium ">' . intval($CaleryCount) . '</div>
                                                </td>
                                                <td hidden>
                                                    <div class=" fw-medium ">' . $FoodTypeNameA . '</div>
                                                </td> 
                                            </tr>';
                            }
                        }
                    }
     

				}


				if (intval($MealCheckHtml) > 0) {
					if (intval($TotalProtine) == '0' && intval($TotalCarbs) !== '0' && intval($TotalFat) == '0' && intval($TotalFiber) == '0' && intval($TotalMealCalery) == '0') {

					} else {
						$MealHtml .= '
									<tr class="deit-plane-heading">
										<td class="text-end p-0" colspan="4" style="background-color: #d8d7ff57;">
											<div class="d-flex">
												<div class="py-1 px-2 text-start">									
													<span class="fw-semibold"><span class="fw-medium"><b> Nutrition : </b></span></span>
												</div>
												<div class="py-1 px-3 ms-auto">									
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Protine : ' . intval($TotalProtine) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Protein.svg" alt=""></span>
														' . intval($TotalProtine) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Carbs : ' . intval($TotalCarbs) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Carbons.svg" alt=""></span>
														' . intval($TotalCarbs) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Fat : ' . intval($TotalFat) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Fats.svg" alt=""></span>
														' . intval($TotalFat) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="Fiber : ' . intval($TotalFiber) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Fiber.svg" alt=""></span>
														' . intval($TotalFiber) . '
													</span>
												</div>
												<div class="py-1 px-3">
													<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" data-bs-title="MealCalery : ' . intval($TotalMealCalery) . '">
														<span class="me-2"><img src="' . $BaseURL . 'assets/FoodPhotos/Calories.svg" alt=""></span>
														' . intval($TotalMealCalery) . '
													</span>
												</div>
											</div>
										</td>
									</tr>
								</tbody>';
					}
				}
				

			$MealTotalCountCarbs = floatval($MealTotalCountCarbs) + floatval($TotalCarbs);
			$MealTotalCountFiber = floatval($MealTotalCountFiber) + floatval($TotalFiber);
			$MealTotalCountFats = floatval($MealTotalCountFats) + floatval($TotalFat);
			$MealTotalCountProtine = floatval($MealTotalCountProtine) + floatval($TotalProtine);
			$MealHtml .= '<script>$(".MealCaleryCountUniqueDiv' . $CountCount . '").text(' . intval($TotalMealCalery) . ');</script>';
			$MealTotalCountCalery = floatval($MealTotalCountCalery) + floatval($TotalMealCalery);
			$TotalMealHtml .= $MealHtml;
			}



			
			// $MealTotalCountCalery = floatval($MealTotalCountCalery) / intval($TTMeal);
			// $MealTotalCountCarbs = floatval($MealTotalCountCarbs) / intval($TTMeal);
			// $MealTotalCountFiber = floatval($MealTotalCountFiber) / intval($TTMeal);
			// $MealTotalCountFats = floatval($MealTotalCountFats) / intval($TTMeal);
			// $MealTotalCountProtine = floatval($MealTotalCountProtine) / intval($TTMeal);



			$RedGreenClass = '';
			if (intval($MealTotalCountCalery) < intval($CaleryTarget) || intval($MealTotalCountCalery) == intval($CaleryTarget)) {
				$RedGreenClass = 'text-success';
			} else {
				$RedGreenClass = 'text-danger';
			}
			$DayHtml .= '
						<div class="w-100 p-3 pb-4 border-top border-bottom main-table data-view-table">
							<div class="d-flex flex-wrap mb-2 justify-content-between" >
								<div class="col-6 d-flex ">
									<h6 Class="fw-bolder">Day Name :</h6>
									<h6 class="mx-2">' . $DayName . '</h6>
								</div>
								
								<div class="col-6 d-flex justify-content-end d-none ">
									<span class= "fw-bolder ' . $RedGreenClass . ' ">' . intval($MealTotalCountCalery) . '</span>
									<span class="mx-2">Out of </span>
									<span class="fw-bolder">' . $CaleryTarget . '</span>
								</div>
							</div>
							<div class="w-100 mt-2">
								<table class="col-12 day-diet-plane">
									<thead>
										<tr class="deit-plane-heading">
											<th class="number-head" style="width: 160px;">
												<span>Meal</span>
											</th>
											<th style="min-width:150px">
												<span>Food</span>
											</th>
											<th>
												<span>QTY</span>
											</th>
											<th>
												<span>Unit</span>
											</th>
											<th>
												<span>Calories</span>
											</th>
											<th hidden>
												<span>Type</span>
											</th>
										</tr>
									</thead>
									' . $TotalMealHtml . '
									<tfoot>
										<tr class="deit-plane-heading">
											<td class="text-end" colspan="5">
												<div class="d-flex">
													<div class="py-1 px-2 text-start">									
														<span class="fw-semibold"><span class="fw-medium"><b>Total Day Nutrition : </b></span></span>
													</div>
													<div class="py-1 px-3 ms-auto">									
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left">
															<span  class="me-2 ">Protine<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Protein.svg" alt=""></span>
															'.intval($MealTotalCountProtine).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" >
															<span class="me-2 ">Carbs<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Carbons.svg" alt=""></span>
															'.intval($MealTotalCountCarbs).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left" >
															<span class="me-2">Fat<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Fats.svg" alt=""></span>
															'.intval($MealTotalCountFats).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left">
															<span class="me-2">Fiber<img hidden src="' . $BaseURL . 'assets/FoodPhotos/Fiber.svg" alt=""></span>
															'.intval($MealTotalCountFiber).'
														</span>
													</div>
													<div class="py-1 px-3">
														<span class="fw-semibold d-flex align-items-center" data-tbs-toggle="tooltip" data-bs-placement="left">
															<span class="me-2">Calories<img src="' . $BaseURL . 'assets/FoodPhotos/Calories.svg" hidden alt=""></span>
															' . intval($MealTotalCountCalery) . '
														</span>
													</div>
												</div>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					';
		}


		$Rresult['Html'] = $DayHtml;
		if ($DietRepetation == '1') {
			$DietRepetation = 'Daily';
		}
        // http://localhost/admin/assets/FoodPhotos/download%20(1).jpg
		if ($DietRepetation == '2') {
			$DietRepetation = 'Weekly';
		}
		if ($DietRepetation == '3') {
			$DietRepetation = 'Custom';
		}
		$Rresult['DiatPlanName'] = $DietName;
		$Rresult['Repetition'] = $DietRepetation;
		$Rresult['Duration'] = $DietDuration;
		$Rresult['AvarageCalorie'] = $DietCaleryTarget;
		return json_encode($Rresult);
	}


    public function DietAvailable(){

        $sql = 'SELECT * FROM master_diet WHERE LOWER(TRIM(REPLACE(DiatPlanName," ",""))) = "'.$_POST['name'].'"';
        $SecondDB = \Config\Database::connect('second');
        $result = $SecondDB->query($sql);
        $ReturnSaveStatus = 0;
        if ($result->getNumRows() > 0) {
			$ReturnSaveStatus = 0;
		} else {
			$ReturnSaveStatus = 1;
        }
        $returnresult['RStuts'] = $ReturnSaveStatus;
		return json_encode($returnresult);
        // pre($_POST);
    }

    public function AddToMasterDiet(){
        $EditID = $_POST['DataDietID'];
        $dbgym = \Config\Database::connect('gym');
        $MasterUserSQL = "SELECT * FROM `".$_POST['Datausernameid']."_diet` WHERE id = ".$EditID."";
        $MasterUserSQL = $dbgym->query($MasterUserSQL);
        $DietData = $MasterUserSQL->getRowArray();
        $ReturnStatus = '';
       if(isset($DietData) && !empty($DietData)){
            unset($DietData['CreatedAt']);
            unset($DietData['id']);
            unset($DietData['DiatPlanName']);
            $InsertData = $DietData;
            $InsertData['CreatedAt'] =  gmdate('Y-m-d H:i:s');
            $InsertData['DiatPlanName'] = $_POST['DietNameInputField'];
            $InsertData['user_id'] = $_POST['Datauserid'];
            $response = $this->MasterInformationModel->insert_entry2($InsertData, 'master_diet');
            $ReturnStatus = 1;
       }
       echo $ReturnStatus;
    }

}