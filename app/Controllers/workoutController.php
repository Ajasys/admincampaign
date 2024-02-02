<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class workoutController extends BaseController
{
	public function __construct()
	{
		session();
		helper('custom');
		$db = db_connect();
		$this->MasterInformationModel = new MasterInformationModel($db);
		$this->username = '';
		$this->admin = 0;
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
		$this->timezone = timezonedata();
	}

	public function masterworkout_list_data()
	{

		$html = '';
		$Count = 0;
		if ($_POST['number'] == '1') {
			$ArrayBeforeMerge = $this->MasterInformationModel->display_all_records2('master_workout');
			$ArrayBeforeMerge = json_decode($ArrayBeforeMerge, true);
			// pre($departmentdisplaydata);
			foreach ($ArrayBeforeMerge as $workoutKey => $workoutVal) {
				// pre($workoutVal);
				$id = $workoutVal['id'];
				$WorkoutPlanName = $workoutVal['WorkoutPlanName'];
				$Duration = $workoutVal['Duration'];
				$Repetition = $workoutVal['Repetition'];
				$AvarageCalorie = $workoutVal['Calories'];
				$workoutDayandFoodArray = $workoutVal['WorkoutArray'];
				$CreatedAt = $workoutVal['CreatedAt'];
				$userid = $workoutVal['user_id'];

				if ($Repetition == '1') {
					$Repetition = 'Daily';
				}
				if ($Repetition == '2') {
					$Repetition = 'Weekly';
				}
				if ($Repetition == '3') {
					$Repetition = 'Custom';
				}
				if ($CreatedAt != '' && $CreatedAt != '0000-00-00 00:00:00') {
					$CreatedAt = date('d-m-Y', strtotime($CreatedAt));
				}
				$Count++;
				$html .= '
                    <tr class="even ViewClickEventMasterworkout" DataworkoutID = "' . $id . '" DataworkoutPlanName= "' . strtolower($WorkoutPlanName) . '" Datauserid = "' . $userid . '" DataworkoutAvarageCalorie = "' . $AvarageCalorie . '" DataworkoutRepetition = "' . $Repetition . '"  DataworkoutDuration="' . $Duration . '">
                        <td style="width:0%" hidden="" class="sorting_1"><input class="check_box table_list_check"
                                type="checkbox" data-delete_id="14"></td>
                        <td class="edt" data-edit_id="14">
                            <div class=" px-0 py-0 w-100">
                                <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-4 "
                                    workoutcaleries="2100" workoutduration="30" workoutrepetation="Daily"
                                    workoutname="Monday to thursday" dataid=' . $id . '>
                                    <div class="col d-flex">
                                            <b class="mx-1 ">' . $Count . '</b>
                                            <span class="mx-1 text-capitalize">' . strtolower($WorkoutPlanName) . '</span>
                                    </div>
                                    <div class="col d-flex">
                                            <b>Repetition:</b>
                                            <span class="mx-1">' . $Repetition . '</span>
                                    </div>
                                    <div class="col">
                                            <b>Duration :</b>
                                            <span class="mx-1">' . $Duration . ' Days</span>
                                    </div>
                                    <div class="col">
                                            <b>Target Calories:</b>
                                            <span class="mx-1">' . $AvarageCalorie . '</span>
                                    </div>
                                 
                                    <div class="col">
                                            <b>Created Date:</b>
                                            <span class="mx-1">' . $CreatedAt . '</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                ';
			}
		}

		if ($_POST['number'] == '2') {
			$dbgym = \Config\Database::connect('gym');
			$MasterUserSQL = "SELECT * FROM `master_user`";
			$MasterUserSQL = $dbgym->query($MasterUserSQL);
			$MasterUserData = $MasterUserSQL->getResultArray();
			$ArrayBeforeMerge = array();
			$Count = 0;
			foreach ($MasterUserData as $MUKey => $MasterVal) {
				$MasterUserName = $MasterVal['username'];
				if (isTableExistsGym($MasterUserName . '_workoutplan') == '1') {
					$DTableName =  $MasterUserName . '_workoutplan';
					$MasterUserworkoutTableSQL = "SELECT * FROM `" . $DTableName . "`";
					$MasterUserworkoutTableSQL = $dbgym->query($MasterUserworkoutTableSQL);
					$MasterUserworkoutData = $MasterUserworkoutTableSQL->getResultArray();
					if (isset($MasterUserworkoutData) && !empty($MasterUserworkoutData)) {
						foreach ($MasterUserworkoutData as $workoutData) {
							$ArrayBeforeMerge[] = array_merge($workoutData, array(
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
			foreach ($ArrayBeforeMerge as $workoutKey => $workoutVal) {
				// pre($workoutVal);
				$id = $workoutVal['id'];
				$WorkoutPlanName = $workoutVal['WorkoutPlanName'];
				$Duration = $workoutVal['Duration'];
				$Repetition = $workoutVal['Repetition'];
				$AvarageCalorie = $workoutVal['Calories'];
				$workoutDayandFoodArray = $workoutVal['WorkoutArray'];
				$CreatedAt = $workoutVal['CreatedAt'];
				$userid = $workoutVal['userid'];
				$usernameid = $workoutVal['usernameid'];
				$username = $workoutVal['username'];
				if ($Repetition == '1') {
					$Repetition = 'Daily';
				}
				if ($Repetition == '2') {
					$Repetition = 'Weekly';
				}
				if ($Repetition == '3') {
					$Repetition = 'Custom';
				}
				if ($CreatedAt != '' && $CreatedAt != '0000-00-00 00:00:00') {
					$CreatedAt = date('d-m-Y', strtotime($CreatedAt));
				}
				$Count++;
				$html .= '
                    <tr class="even ViewMasterworkoutPlan" DataworkoutID = "' . $id . '" DataworkoutPlanName= "' . strtolower($WorkoutPlanName) . '" Datausernameid = "' . $usernameid . '" Datauserid = "' . $userid . '" DataworkoutAvarageCalorie = "' . $AvarageCalorie . '" DataworkoutRepetition = "' . $Repetition . '"  DataworkoutDuration="' . $Duration . '">
                        <td style="width:0%" hidden="" class="sorting_1"><input class="check_box table_list_check"
                                type="checkbox" data-delete_id="14"></td>
                        <td class="edt" data-edit_id="14">
                            <div class=" px-0 py-0 w-100">
                                <div class="row row-cols-1 row-cols-sm-2  row-cols-md-1 row-cols-lg-3 row-cols-xl-4 "
                                    workoutcaleries="2100" workoutduration="30" workoutrepetation="Daily"
                                    workoutname="Monday to thursday" dataid=' . $id . '>
                                    <div class="col d-flex">
                                            <b class="mx-1 ">' . $Count . '</b>
                                            <span class="mx-1 text-capitalize">' . strtolower($WorkoutPlanName) . '</span>
                                    </div>
                                    <div class="col d-flex">
                                            <b>Repetition:</b>
                                            <span class="mx-1">' . $Repetition . '</span>
                                    </div>
                                    <div class="col">
                                            <b>Duration :</b>
                                            <span class="mx-1">' . $Duration . ' Days</span>
                                    </div>
                                    <div class="col">
                                            <b>Target Calories:</b>
                                            <span class="mx-1">' . $AvarageCalorie . '</span>
                                    </div>
									<div class="col">
									<b>Added By:</b>
									<span class="mx-1 text-capitalize">' . $usernameid . '</span>
									</div>
                                    <div class="col">
                                            <b>Created Date:</b>
                                            <span class="mx-1">' . $CreatedAt . '</span>
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



	public function MasterWorkoutView()
	{
		$db = \Config\Database::connect('second');
		$sql = 'SELECT * FROM `master_exercise`';
		$result = $db->query($sql);
		$EditID = $_POST['DataworkoutID'];
		$table_username = getMasterUsername();
		$base_url = base_url();
		// $workoutData = get_editData($table_username . '_workoutplan', intval($EditID));
		// $CountSql = 'SELECT COUNT(*) AS DeleteRC FROM '.$table_username.'_all_workout WHERE workout_id = "'.$EditID.'" ;';
		// $Database = \Config\Database::connect('default');
		// $resultCount = $Database->query($CountSql);
		// $resultCount = $resultCount->getRow();
		// $resultCount = $resultCount->DeleteRC;
		$resultCount = 0;

		$dbgym = \Config\Database::connect('gym');
		$MasterUserSQL = "SELECT * FROM `" . $_POST['Datausernameid'] . "_workoutplan` WHERE id = " . $EditID . "";
		$MasterUserSQL = $dbgym->query($MasterUserSQL);
		$workoutData = $MasterUserSQL->getRowArray();


		$QTYUnit = '';
		if (isset($workoutData) && !empty($workoutData)) {
		} else {
			die();
		}
		$CaleryTarget = '';
		$workoutArray = $workoutData['WorkoutArray'];
		$workoutArray = json_decode($workoutArray, true);
		if (isset($workoutArray) && !empty($workoutArray)) {
		} else {
			die();
		}
		$TotolSet = 0;
		if (isset($workoutArray) && !empty($workoutArray)) {

			foreach ($workoutArray as $workoutKey => $workoutValue) {
				$MealsArray = $workoutValue['Excercise'];
				foreach ($MealsArray as $MealKey => $MealValue) {
					$FoodArray = $MealValue['SubArray'];
					foreach ($FoodArray as $FoodKey => $ExcerciseValue) {
						$RDArray = $ExcerciseValue['RDArray'];
						if (!empty($RDArray)) {
							$FRDArray = explode(',', $RDArray);
							$frdArrayLength = count($FRDArray);
							if (intval($frdArrayLength) > $TotolSet) {
								$TotolSet = $frdArrayLength;
							}
						}
					}
				}
			}
		}

		if (intval($TotolSet) < 4) {
			$TotolSet = 3;
		}
		$ReturnHtml = '';
		$DayHtml = '';
		$BaseURL = base_url();
		$workoutName = $workoutData['WorkoutPlanName'];
		$workoutRepetation = $workoutData['Repetition'];
		$workoutDuration = $workoutData['Duration'];
		$workoutCaleryTarget = $workoutData['Calories'];

		foreach ($workoutArray as $workoutKey => $workoutValue) {
			$DayTotalCalll = 0;
			$DayName = $workoutValue['DayName'];
			$MealsArray = $workoutValue['Excercise'];
			$MealCheckHtml  = 0;
			$CountCount = 0;
			$MealArraySpanCount = count($MealsArray);
			$MealTotalCountCalery = 0;
			$TotalMealHtml = '';
			foreach ($MealsArray as $MealKey => $MealValue) {
				$CountCount++;
				$MealName = $MealValue['Excercise_Tiltle'];
				$FoodArray = $MealValue['SubArray'];
				$FooterCountUseArry = $MealValue['SubArray'];
				$ArraySpanCount = count($FoodArray);
				$MealHtml = '';
				$MealHtml .= '<tbody>';
				$HtmlCount = 0;
				foreach ($FoodArray as $FoodKey => $ExcerciseValue) {
					// pre($FoodArray);
					$HtmlCount++;
					$FoodName =  $ExcerciseValue['ExcerciseName'];
					$FoodUnit = '';
					if (isset($ExcerciseValue['Reps_duration'])) {
						$FoodUnit = $ExcerciseValue['Reps_duration'];
					}
					if ($FoodUnit == 1) {
						$food = 'Reps: ';
					} elseif ($FoodUnit == 2) {
						$food = 'Duration: ';
					} else {
						$food = '';
					}
					$SMRDArray = $ExcerciseValue['RDArray'];
					$FoodTypeNameA = '';
					if (isset($ExcerciseValue['ExcerciseName']) && !empty($ExcerciseValue['ExcerciseName'])) {
						$FExcerciseName = $ExcerciseValue['ExcerciseName'];
					}
					if (!empty($FExcerciseName)) {
						// pre($FExcerciseName);
						$ExerciseDatas = get_editData2('master_exercise', intval($FExcerciseName));
						$Excercise = $ExerciseDatas['e_name'];
						$ImageA =  $ExerciseDatas['e_image'];
						$FRDArray = $SMRDArray;
						$EECal = $ExerciseDatas['e_calories'];
						$EEe_rep = $ExerciseDatas['e_rep'];
						$EEduration = $ExerciseDatas['duration'];
						$EEExcal = '';
						// pre($ExerciseDatas);
						// die();

						$DurRepStatus = $ExerciseDatas['DurRepStatus'];

						if ($DurRepStatus != '' && intval($DurRepStatus) == '1') {
							$EEExcal = floatval($EEduration);
						}
						if ($DurRepStatus != '' && intval($DurRepStatus) == '0') {
							$EEExcal = floatval($EEe_rep);
						}
						$SCount = 0;
						if ($FRDArray != '' && !empty($FRDArray)) {
							$FRDArray = explode(',', $FRDArray);
						} else {
							$FRDArray = '';
						}
						$SubCalExCount = 0;
						$OriginalRDArray = $ExcerciseValue['RDArray'];
						if (!empty($OriginalRDArray)) {
							$FRDArray = explode(',', $OriginalRDArray);
						} else {
							$FRDArray = '';
						}
						if ($FRDArray != '') {
							foreach ($FRDArray as $value111) {
								if ($value111 != '') {
									$SCount++;
									$SubCalExCount = floatval($SubCalExCount) + floatval($value111);
								}
								if (floatval($EEExcal) > 0 && floatval($EECal) > 0 && floatval($SubCalExCount) > 0) {
									$CalExCount = floatval($EECal) * floatval($SubCalExCount) / floatval($EEExcal);
									$DayTotalCalll = floatval($DayTotalCalll) + floatval($CalExCount);
								}
							}
						}
						$DurRepStatus = $ExerciseDatas['DurRepStatus'];
						$RepDurtext = '';
						if ($SMRDArray != '') {
							if ($DurRepStatus == '1') {
								$RepDurtext = str_replace(",", " Minit X ", $SMRDArray);
								if (strpos($SMRDArray, ',') === false) {
									$RepDurtext .= " Minit";
								}
							} else {
								$RepDurtext = str_replace(",", " X ", $SMRDArray);
							}
						} else {
							$RepDurtext = '';
						}
						if ($RepDurtext == '') {
							$RepDurtext = '1';
						}
						if (!empty($SMRDArray)) {
							$smrdArrayItems = explode(",", $SMRDArray);
							$maxSets = max($smrdArrayItems);
						} else {
							$smrdArrayItems = '';
							$maxSets = 0;
						}
						$exercise_img = '';
						$food_img = $base_url . 'assets/image/exercise/fitness.png';
						if ($ImageA != '' && $ImageA != "undefined") {
							$food_img = $base_url . 'assets/images/food_type/' . $ImageA;
							$exercise_img = $ImageA;
						}
						$string = $_SERVER['DOCUMENT_ROOT'];
						$substring = 'rudrramc';
						if (strpos($string, $substring) !== false) {
							$food_img = 'https://admin.ajasys.com/assets/ExercisePhotos/' . $exercise_img;
						} else {
							$food_img = 'http://localhost/admin/assets/ExercisePhotos/' . $exercise_img;
						}
						if ($exercise_img == '') {
							$food_img = $base_url . 'assets/image/exercise/fitness.png';
						}
						$Reps_duration = '';
						if (isset($ExcerciseValue['Reps_duration'])) {
							$Reps_duration = $ExcerciseValue['Reps_duration'];
						}
						$RDArray = $ExcerciseValue['RDArray'];
						if (!empty($RDArray)) {
							$values = explode(',', $RDArray);
							$modifiedRDArray = str_replace(',', '', $RDArray);
							$value1 = isset($values[0]) ? trim($values[0]) : '';
							$value2 = isset($values[1]) ? trim($values[1]) : '';
							$value3 = isset($values[2]) ? trim($values[2]) : '';
						}
						if ($FoodUnit == 1) {
							$food = 'Reps: ';
						} elseif ($FoodUnit == 2) {
							$food = 'Duration: ';
						} else {
							$food = '';
						}
					}
					$FoodImageUrl = '';
					if ($ImageA != '') {
						$FoodImageUrl = $BaseURL . 'assets/images/food_type/' . $ImageA;
					} else {
						$FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
					}
					$exercise_img = $ImageA;

					$string = $_SERVER['DOCUMENT_ROOT'];
					$substring = 'rudrramc';
					if (strpos($string, $substring) !== false) {
						$FoodImageUrl = 'https://admin.ajasys.com/assets/FoodPhotos/' . $exercise_img;
					} else {
						$FoodImageUrl = 'http://localhost/admin/assets/FoodPhotos/' . $exercise_img;
					}
					if ($exercise_img == '') {
						$FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
					}
					if ($HtmlCount == '1') {
						$sql = 'SELECT * FROM `master_exercise`';
						$result = $db->query($sql);
						$gymsmart_excrcise = $result->getResultArray();
						$MealCheckHtml++;
						$MealHtml .= '
											<tr class="deit-plane-heading">
												<td rowspan="' . $ArraySpanCount . '">
													<div>' . $MealName . '</div>
												</td>
												<td class="d-flex flex-wrap align-items-center border-0">';
						$MealHtml .= '
													<div class="me-3" style="width:30px;height:30px">
														<img src="' . $food_img . '" alt="#" class="w-100 h-100">
													</div>';
						if (isset($gymsmart_excrcise)) {
							$MealHtml .= '<div class="col">' . $Excercise . '</div>';
						}
						$MealHtml .= '
												</td>';
						$SubArraySetHtml = 0;
						if ($smrdArrayItems != '') {
							$SubArraySetHtml = count($smrdArrayItems);
						} else {
							$SubArraySetHtml = 0;
						}
						if ($smrdArrayItems != '') {
							foreach ($smrdArrayItems as $repDurtextItem) {
								$MealHtml .= '<td>' . $repDurtextItem . '</td>';
							}
						}
						$MTotolSet = intval($TotolSet) - intval($SubArraySetHtml);
						if (intval($MTotolSet) > 0) {
							for ($i = 1; $i <= $MTotolSet; $i++) {
								$MealHtml .= '<td>-</td>';
							}
						}
						$MealHtml .= '
												</tr>';
					} else {
						$sql = 'SELECT * FROM `master_exercise`';
						$result = $db->query($sql);
						$gymsmart_excrcise = $result->getResultArray();
						$MealHtml .= '
											<tr class="deit-plane-heading">
												<td class="d-flex flex-wrap align-items-center border-0">';
						$MealHtml .= '
													<div class="me-3" style="width:30px;height:30px">
														<img src="' . $food_img . '" alt="#" class="w-100 h-100">
													</div>';
						if (isset($gymsmart_excrcise)) {
							$MealHtml .= '<div class="col">' . $Excercise . '</div>';
						}
						$MealHtml .= '
												</td>';
						$SubArraySetHtml = 0;
						if ($smrdArrayItems != '') {
							$SubArraySetHtml = count($smrdArrayItems);
						} else {
							$SubArraySetHtml = 0;
						}
						if ($smrdArrayItems != '') {
							foreach ($smrdArrayItems as $repDurtextItem) {
								$MealHtml .= '<td>' . $repDurtextItem . '</td>';
							}
						}
						$MTotolSet = intval($TotolSet) - intval($SubArraySetHtml);
						if (intval($MTotolSet) > 0) {
							for ($i = 1; $i <= $MTotolSet; $i++) {
								$MealHtml .= '<td>-</td>';
							}
						}
						$MealHtml .= '</tr>';
					}
				}
				$TotalMealHtml .= $MealHtml;
			}
			$MealTotalCountCalery = floatval($MealTotalCountCalery) / intval($MealArraySpanCount);
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
									<div class="col-6 d-flex justify-content-end d-none">
										<span class= "fw-bolder ' . $RedGreenClass . ' ">' . intval($MealTotalCountCalery) . '</span>
										<span class="mx-2">Out of </span>
										<span class="fw-bolder">' . $CaleryTarget . '</span>
									</div>
								</div>
								<div class="w-100 mt-2">
									<table class="col-12 day-workout-plane">
										<thead>
											<tr class="deit-plane-heading ">
												<th class="number-head" style="width:200px;">
													<span>Exercise</span>
												</th>
												<th style="min-width:150px; width:600px;">
													<span>Exercise Name</span>
												</th>';
			for ($i = 1; $i <= $TotolSet; $i++) {
				$DayHtml .= '<th>Set ' . $i . '</th>';
			}
			$DayHtml .= '</tr>
										</thead>
										' . $TotalMealHtml . '';
			if (!empty($DayTotalCalll)) {
				$DayHtml .= '
											<tfoot>
													<tr class="deit-plane-heading">
														<td class="text-end" colspan="2">
															<div class="fw-bolder">Total Day Calories</div>
														</td>
														<td colspan="' . $TotolSet . '" >
															<span class="fw-bolder text-success ">' . intval($DayTotalCalll) . '</span>
														</td>
													</tr>
											</tfoot>';
			}
			$DayHtml .= '
									</table>
								</div>
							</div>
						';
		}


		$DayHtml = $DayHtml . '<script>$(".MasterworkoutPlanDeleteButton").attr("DeleteAssignStatus", "' . $resultCount . '");</script>';
		$Rresult['Html'] = $DayHtml;
		if ($workoutRepetation == '1') {
			$workoutRepetation = 'Daily';
		}
		if ($workoutRepetation == '2') {
			$workoutRepetation = 'Weekly';
		}
		if ($workoutRepetation == '3') {
			$workoutRepetation = 'Custom';
		}
		$Rresult['WorkoutPlanName'] = $workoutName;
		$Rresult['Repetition'] = $workoutRepetation;
		$Rresult['Duration'] = $workoutDuration;
		$Rresult['Calories'] = $workoutCaleryTarget;
		return json_encode($Rresult);
	}

	public function MainMasterworkoutView()
	{
		$db = \Config\Database::connect('second');
		$sql = 'SELECT * FROM `master_exercise`';
		$result = $db->query($sql);
		$EditID = $_POST['DataworkoutID'];
		$table_username = getMasterUsername();
		$base_url = base_url();
		// $workoutData = get_editData($table_username . '_workoutplan', intval($EditID));
		// $CountSql = 'SELECT COUNT(*) AS DeleteRC FROM '.$table_username.'_all_workout WHERE workout_id = "'.$EditID.'" ;';
		// $Database = \Config\Database::connect('default');
		// $resultCount = $Database->query($CountSql);
		// $resultCount = $resultCount->getRow();
		// $resultCount = $resultCount->DeleteRC;
		$resultCount = 0;

		$dbgym = \Config\Database::connect('second');
		$MasterUserSQL = "SELECT * FROM master_workout WHERE id = " . $EditID . "";
		$MasterUserSQL = $dbgym->query($MasterUserSQL);
		$workoutData = $MasterUserSQL->getRowArray();


		$QTYUnit = '';
		if (isset($workoutData) && !empty($workoutData)) {
		} else {
			die();
		}
		$CaleryTarget = '';
		$workoutArray = $workoutData['WorkoutArray'];
		$workoutArray = json_decode($workoutArray, true);
		if (isset($workoutArray) && !empty($workoutArray)) {
		} else {
			die();
		}
		$TotolSet = 0;
		if (isset($workoutArray) && !empty($workoutArray)) {

			foreach ($workoutArray as $workoutKey => $workoutValue) {
				$MealsArray = $workoutValue['Excercise'];
				foreach ($MealsArray as $MealKey => $MealValue) {
					$FoodArray = $MealValue['SubArray'];
					foreach ($FoodArray as $FoodKey => $ExcerciseValue) {
						$RDArray = $ExcerciseValue['RDArray'];
						if (!empty($RDArray)) {
							$FRDArray = explode(',', $RDArray);
							$frdArrayLength = count($FRDArray);
							if (intval($frdArrayLength) > $TotolSet) {
								$TotolSet = $frdArrayLength;
							}
						}
					}
				}
			}
		}

		if (intval($TotolSet) < 4) {
			$TotolSet = 3;
		}
		$ReturnHtml = '';
		$DayHtml = '';
		$BaseURL = base_url();
		$workoutName = $workoutData['WorkoutPlanName'];
		$workoutRepetation = $workoutData['Repetition'];
		$workoutDuration = $workoutData['Duration'];
		$workoutCaleryTarget = $workoutData['Calories'];

		foreach ($workoutArray as $workoutKey => $workoutValue) {
			$DayTotalCalll = 0;
			$DayName = $workoutValue['DayName'];
			$MealsArray = $workoutValue['Excercise'];
			$MealCheckHtml  = 0;
			$CountCount = 0;
			$MealArraySpanCount = count($MealsArray);
			$MealTotalCountCalery = 0;
			$TotalMealHtml = '';
			foreach ($MealsArray as $MealKey => $MealValue) {
				$CountCount++;
				$MealName = $MealValue['Excercise_Tiltle'];
				$FoodArray = $MealValue['SubArray'];
				$FooterCountUseArry = $MealValue['SubArray'];
				$ArraySpanCount = count($FoodArray);
				$MealHtml = '';
				$MealHtml .= '<tbody>';
				$HtmlCount = 0;
				foreach ($FoodArray as $FoodKey => $ExcerciseValue) {
					// pre($FoodArray);
					$HtmlCount++;
					$FoodName =  $ExcerciseValue['ExcerciseName'];
					$FoodUnit = '';
					if (isset($ExcerciseValue['Reps_duration'])) {
						$FoodUnit = $ExcerciseValue['Reps_duration'];
					}
					if ($FoodUnit == 1) {
						$food = 'Reps: ';
					} elseif ($FoodUnit == 2) {
						$food = 'Duration: ';
					} else {
						$food = '';
					}
					$SMRDArray = $ExcerciseValue['RDArray'];
					$FoodTypeNameA = '';
					if (isset($ExcerciseValue['ExcerciseName']) && !empty($ExcerciseValue['ExcerciseName'])) {
						$FExcerciseName = $ExcerciseValue['ExcerciseName'];
					}
					if (!empty($FExcerciseName)) {
						// pre($FExcerciseName);
						$ExerciseDatas = get_editData2('master_exercise', intval($FExcerciseName));
						$Excercise = $ExerciseDatas['e_name'];
						$ImageA =  $ExerciseDatas['e_image'];
						$FRDArray = $SMRDArray;
						$EECal = $ExerciseDatas['e_calories'];
						$EEe_rep = $ExerciseDatas['e_rep'];
						$EEduration = $ExerciseDatas['duration'];
						$EEExcal = '';
						// pre($ExerciseDatas);
						// die();

						$DurRepStatus = $ExerciseDatas['DurRepStatus'];

						if ($DurRepStatus != '' && intval($DurRepStatus) == '1') {
							$EEExcal = floatval($EEduration);
						}
						if ($DurRepStatus != '' && intval($DurRepStatus) == '0') {
							$EEExcal = floatval($EEe_rep);
						}
						$SCount = 0;
						if ($FRDArray != '' && !empty($FRDArray)) {
							$FRDArray = explode(',', $FRDArray);
						} else {
							$FRDArray = '';
						}
						$SubCalExCount = 0;
						$OriginalRDArray = $ExcerciseValue['RDArray'];
						if (!empty($OriginalRDArray)) {
							$FRDArray = explode(',', $OriginalRDArray);
						} else {
							$FRDArray = '';
						}
						if ($FRDArray != '') {
							foreach ($FRDArray as $value111) {
								if ($value111 != '') {
									$SCount++;
									$SubCalExCount = floatval($SubCalExCount) + floatval($value111);
								}
								if (floatval($EEExcal) > 0 && floatval($EECal) > 0 && floatval($SubCalExCount) > 0) {
									$CalExCount = floatval($EECal) * floatval($SubCalExCount) / floatval($EEExcal);
									$DayTotalCalll = floatval($DayTotalCalll) + floatval($CalExCount);
								}
							}
						}
						$DurRepStatus = $ExerciseDatas['DurRepStatus'];
						$RepDurtext = '';
						if ($SMRDArray != '') {
							if ($DurRepStatus == '1') {
								$RepDurtext = str_replace(",", " Minit X ", $SMRDArray);
								if (strpos($SMRDArray, ',') === false) {
									$RepDurtext .= " Minit";
								}
							} else {
								$RepDurtext = str_replace(",", " X ", $SMRDArray);
							}
						} else {
							$RepDurtext = '';
						}
						if ($RepDurtext == '') {
							$RepDurtext = '1';
						}
						if (!empty($SMRDArray)) {
							$smrdArrayItems = explode(",", $SMRDArray);
							$maxSets = max($smrdArrayItems);
						} else {
							$smrdArrayItems = '';
							$maxSets = 0;
						}
						$exercise_img = '';
						$food_img = $base_url . 'assets/image/exercise/fitness.png';
						if ($ImageA != '' && $ImageA != "undefined") {
							$food_img = $base_url . 'assets/images/food_type/' . $ImageA;
							$exercise_img = $ImageA;
						}
						$string = $_SERVER['DOCUMENT_ROOT'];
						$substring = 'rudrramc';
						if (strpos($string, $substring) !== false) {
							$food_img = 'https://admin.ajasys.com/assets/ExercisePhotos/' . $exercise_img;
						} else {
							$food_img = 'http://localhost/admin/assets/ExercisePhotos/' . $exercise_img;
						}
						if ($exercise_img == '') {
							$food_img = $base_url . 'assets/image/exercise/fitness.png';
						}
						$Reps_duration = '';
						if (isset($ExcerciseValue['Reps_duration'])) {
							$Reps_duration = $ExcerciseValue['Reps_duration'];
						}
						$RDArray = $ExcerciseValue['RDArray'];
						if (!empty($RDArray)) {
							$values = explode(',', $RDArray);
							$modifiedRDArray = str_replace(',', '', $RDArray);
							$value1 = isset($values[0]) ? trim($values[0]) : '';
							$value2 = isset($values[1]) ? trim($values[1]) : '';
							$value3 = isset($values[2]) ? trim($values[2]) : '';
						}
						if ($FoodUnit == 1) {
							$food = 'Reps: ';
						} elseif ($FoodUnit == 2) {
							$food = 'Duration: ';
						} else {
							$food = '';
						}
					}
					$FoodImageUrl = '';
					if ($ImageA != '') {
						$FoodImageUrl = $BaseURL . 'assets/images/food_type/' . $ImageA;
					} else {
						$FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
					}
					$exercise_img = $ImageA;

					$string = $_SERVER['DOCUMENT_ROOT'];
					$substring = 'rudrramc';
					if (strpos($string, $substring) !== false) {
						$FoodImageUrl = 'https://admin.ajasys.com/assets/FoodPhotos/' . $exercise_img;
					} else {
						$FoodImageUrl = 'http://localhost/admin/assets/FoodPhotos/' . $exercise_img;
					}
					if ($exercise_img == '') {
						$FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
					}
					if ($HtmlCount == '1') {
						$sql = 'SELECT * FROM `master_exercise`';
						$result = $db->query($sql);
						$gymsmart_excrcise = $result->getResultArray();
						$MealCheckHtml++;
						$MealHtml .= '
											<tr class="deit-plane-heading">
												<td rowspan="' . $ArraySpanCount . '">
													<div>' . $MealName . '</div>
												</td>
												<td class="d-flex flex-wrap align-items-center border-0">';
						$MealHtml .= '
													<div class="me-3" style="width:30px;height:30px">
														<img src="' . $food_img . '" alt="#" class="w-100 h-100">
													</div>';
						if (isset($gymsmart_excrcise)) {
							$MealHtml .= '<div class="col">' . $Excercise . '</div>';
						}
						$MealHtml .= '
												</td>';
						$SubArraySetHtml = 0;
						if ($smrdArrayItems != '') {
							$SubArraySetHtml = count($smrdArrayItems);
						} else {
							$SubArraySetHtml = 0;
						}
						if ($smrdArrayItems != '') {
							foreach ($smrdArrayItems as $repDurtextItem) {
								$MealHtml .= '<td>' . $repDurtextItem . '</td>';
							}
						}
						$MTotolSet = intval($TotolSet) - intval($SubArraySetHtml);
						if (intval($MTotolSet) > 0) {
							for ($i = 1; $i <= $MTotolSet; $i++) {
								$MealHtml .= '<td>-</td>';
							}
						}
						$MealHtml .= '
												</tr>';
					} else {
						$sql = 'SELECT * FROM `master_exercise`';
						$result = $db->query($sql);
						$gymsmart_excrcise = $result->getResultArray();
						$MealHtml .= '
											<tr class="deit-plane-heading">
												<td class="d-flex flex-wrap align-items-center border-0">';
						$MealHtml .= '
													<div class="me-3" style="width:30px;height:30px">
														<img src="' . $food_img . '" alt="#" class="w-100 h-100">
													</div>';
						if (isset($gymsmart_excrcise)) {
							$MealHtml .= '<div class="col">' . $Excercise . '</div>';
						}
						$MealHtml .= '
												</td>';
						$SubArraySetHtml = 0;
						if ($smrdArrayItems != '') {
							$SubArraySetHtml = count($smrdArrayItems);
						} else {
							$SubArraySetHtml = 0;
						}
						if ($smrdArrayItems != '') {
							foreach ($smrdArrayItems as $repDurtextItem) {
								$MealHtml .= '<td>' . $repDurtextItem . '</td>';
							}
						}
						$MTotolSet = intval($TotolSet) - intval($SubArraySetHtml);
						if (intval($MTotolSet) > 0) {
							for ($i = 1; $i <= $MTotolSet; $i++) {
								$MealHtml .= '<td>-</td>';
							}
						}
						$MealHtml .= '</tr>';
					}
				}
				$TotalMealHtml .= $MealHtml;
			}
			$MealTotalCountCalery = floatval($MealTotalCountCalery) / intval($MealArraySpanCount);
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
									<div class="col-6 d-flex justify-content-end d-none">
										<span class= "fw-bolder ' . $RedGreenClass . ' ">' . intval($MealTotalCountCalery) . '</span>
										<span class="mx-2">Out of </span>
										<span class="fw-bolder">' . $CaleryTarget . '</span>
									</div>
								</div>
								<div class="w-100 mt-2">
									<table class="col-12 day-workout-plane">
										<thead>
											<tr class="deit-plane-heading ">
												<th class="number-head" style="width:200px;">
													<span>Exercise</span>
												</th>
												<th style="min-width:150px; width:600px;">
													<span>Exercise Name</span>
												</th>';
			for ($i = 1; $i <= $TotolSet; $i++) {
				$DayHtml .= '<th>Set ' . $i . '</th>';
			}
			$DayHtml .= '</tr>
										</thead>
										' . $TotalMealHtml . '';
			if (!empty($DayTotalCalll)) {
				$DayHtml .= '
											<tfoot>
													<tr class="deit-plane-heading">
														<td class="text-end" colspan="2">
															<div class="fw-bolder">Total Day Calories</div>
														</td>
														<td colspan="' . $TotolSet . '" >
															<span class="fw-bolder text-success ">' . intval($DayTotalCalll) . '</span>
														</td>
													</tr>
											</tfoot>';
			}
			$DayHtml .= '
									</table>
								</div>
							</div>
						';
		}


		$DayHtml = $DayHtml . '<script>$(".MasterworkoutPlanDeleteButton").attr("DeleteAssignStatus", "' . $resultCount . '");</script>';
		$Rresult['Html'] = $DayHtml;
		if ($workoutRepetation == '1') {
			$workoutRepetation = 'Daily';
		}
		if ($workoutRepetation == '2') {
			$workoutRepetation = 'Weekly';
		}
		if ($workoutRepetation == '3') {
			$workoutRepetation = 'Custom';
		}
		$Rresult['WorkoutPlanName'] = $workoutName;
		$Rresult['Repetition'] = $workoutRepetation;
		$Rresult['Duration'] = $workoutDuration;
		$Rresult['Calories'] = $workoutCaleryTarget;
		return json_encode($Rresult);
	}


	public function MasterworkoutView1()
	{ {
			$db = \Config\Database::connect('second');
			$sql = 'SELECT * FROM `master_exercise`';
			$result = $db->query($sql);
			$EditID = $_POST['DataworkoutID'];
			$table_username = getMasterUsername();
			$base_url = base_url();
			$dbgym = \Config\Database::connect('gym');
			$MasterUserSQL = "SELECT * FROM `" . $_POST['Datausernameid'] . "_workoutplan` WHERE id = " . $EditID . "";
			$MasterUserSQL = $dbgym->query($MasterUserSQL);
			$workoutData = $MasterUserSQL->getRowArray();
			$QTYUnit = '';
			if (isset($workoutData) && !empty($workoutData)) {
			} else {
				die();
			}
			$CaleryTarget = '';
			$workoutArray = $workoutData['WorkoutArray'];
			$workoutArray = json_decode($workoutArray, true);
			$TotolSet = 0;
			foreach ($workoutArray as $workoutKey => $workoutValue) {
				$MealsArray = $workoutValue['Excercise'];
				foreach ($MealsArray as $MealKey => $MealValue) {
					$FoodArray = $MealValue['SubArray'];
					foreach ($FoodArray as $FoodKey => $ExcerciseValue) {
						$RDArray = $ExcerciseValue['RDArray'];
						if ($RDArray != '') {
							$FRDArray = explode(',', $RDArray);
							$frdArrayLength = count($FRDArray);
							if (intval($frdArrayLength) > $TotolSet) {
								$TotolSet = $frdArrayLength;
							}
						}
					}
				}
			}
			// pre($TotolSet);
			if (intval($TotolSet) < 4) {
				$TotolSet = 3;
			}
			$ReturnHtml = '';
			$DayHtml = '';
			$BaseURL = base_url();
			$workoutName = $workoutData['WorkoutPlanName'];
			$workoutRepetation = $workoutData['Repetition'];
			$workoutDuration = $workoutData['Duration'];
			$workoutCaleryTarget = $workoutData['Calories'];
			foreach ($workoutArray as $workoutKey => $workoutValue) {
				$DayTotalCalll = 0;
				$DayName = $workoutValue['DayName'];
				$MealsArray = $workoutValue['Excercise'];
				$MealCheckHtml  = 0;
				$CountCount = 0;
				$MealArraySpanCount = count($MealsArray);
				$MealTotalCountCalery = 0;
				$TotalMealHtml = '';
				foreach ($MealsArray as $MealKey => $MealValue) {
					$CountCount++;
					$MealName = $MealValue['Excercise_Tiltle'];
					$FoodArray = $MealValue['SubArray'];
					$FooterCountUseArry = $MealValue['SubArray'];
					$ArraySpanCount = count($FoodArray);
					$MealHtml = '';
					$MealHtml .= '<tbody>';
					$HtmlCount = 0;
					foreach ($FoodArray as $FoodKey => $ExcerciseValue) {
						$HtmlCount++;
						$FoodName =  $ExcerciseValue['ExcerciseName'];
						$FoodUnit = 0;
						if (isset($ExcerciseValue['Reps_duration'])) {
							$FoodUnit = $ExcerciseValue['Reps_duration'];
						}
						if ($FoodUnit == 1) {
							$food = 'Reps: ';
						} elseif ($FoodUnit == 2) {
							$food = 'Duration: ';
						} else {
							$food = 'Unknown unit: ';
						}
						$SMRDArray = $ExcerciseValue['RDArray'];
						$FoodTypeNameA = '';
						if (isset($ExcerciseValue['ExcerciseName']) && !empty($ExcerciseValue['ExcerciseName'])) {
							$FExcerciseName = $ExcerciseValue['ExcerciseName'];
						}
						if (isset($FExcerciseName) && !empty($FExcerciseName)) {
							$ExerciseDatas = get_editData2('master_exercise', intval($FExcerciseName));
							$Excercise = $ExerciseDatas['e_name'];
							$ImageA =  $ExerciseDatas['e_image'];
							$FRDArray = $SMRDArray;
							$EECal = $ExerciseDatas['e_calories'];
							$EEe_rep = $ExerciseDatas['e_rep'];
							$EEduration = $ExerciseDatas['duration'];
							$EEExcal = '';
							$DurRepStatus = 0;
							if (isset($ExerciseDatas['DurRepStatus'])) {
								$DurRepStatus = $ExerciseDatas['DurRepStatus'];
							}
							if ($DurRepStatus != '' && intval($DurRepStatus) == '1') {
								$EEExcal = floatval($EEduration);
							}
							if ($DurRepStatus != '' && intval($DurRepStatus) == '0') {
								$EEExcal = floatval($EEe_rep);
							}
							$SCount = 0;
							$FRDArray = explode(',', $FRDArray);
							$SubCalExCount = 0;
							$OriginalRDArray = $ExcerciseValue['RDArray'];
							$FRDArray = explode(',', $OriginalRDArray);
							foreach ($FRDArray as $value111) {
								if ($value111 != '') {
									$SCount++;
									$SubCalExCount = floatval($SubCalExCount) + floatval($value111);
								}
								if (floatval($EEExcal) > 0 && floatval($EECal) > 0 && floatval($SubCalExCount) > 0) {
									$CalExCount = floatval($EECal) * floatval($SubCalExCount) / floatval($EEExcal);
									$DayTotalCalll = floatval($DayTotalCalll) + floatval($CalExCount);
								}
							}
							$DurRepStatus = 0;
							if (isset($ExerciseDatas['DurRepStatus'])) {
								$DurRepStatus = $ExerciseDatas['DurRepStatus'];
							}
							$RepDurtext = '';
							if ($DurRepStatus == '1') {
								$RepDurtext = str_replace(",", " Minit X ", $SMRDArray);
								if (strpos($SMRDArray, ',') === false) {
									$RepDurtext .= " Minit";
								}
							} else {
								$RepDurtext = str_replace(",", " X ", $SMRDArray);
							}
							if ($RepDurtext == '') {
								$RepDurtext = '1';
							}
							$smrdArrayItems = explode(",", $SMRDArray);
							$maxSets = max($smrdArrayItems);
							$exercise_img = '';
							$food_img = $base_url . 'assets/image/exercise/fitness.png';
							if ($ImageA != '' && $ImageA != "undefined") {
								$food_img = $base_url . 'assets/images/food_type/' . $ImageA;
								$exercise_img = $ImageA;
							}
							$string = $_SERVER['DOCUMENT_ROOT'];
							$substring = 'rudrramc';
							if (strpos($string, $substring) !== false) {
								$food_img = 'https://admin.ajasys.com/assets/ExercisePhotos/' . $exercise_img;
							} else {
								$food_img = 'http://localhost/admin/assets/ExercisePhotos/' . $exercise_img;
							}
							if ($exercise_img == '') {
								$food_img = $base_url . 'assets/image/exercise/fitness.png';
							}
							$Reps_duration = $ExcerciseValue['Reps_duration'];
							$RDArray = $ExcerciseValue['RDArray'];
							$values = explode(',', $RDArray);
							$modifiedRDArray = str_replace(',', '', $RDArray);
							$value1 = isset($values[0]) ? trim($values[0]) : '';
							$value2 = isset($values[1]) ? trim($values[1]) : '';
							$value3 = isset($values[2]) ? trim($values[2]) : '';
							if ($FoodUnit == 1 && $value1 !== '') {
								$food = 'Reps: ';
							} elseif ($FoodUnit == 2 && $value1 !== '') {
								$food = 'Duration: ';
							} else {
								$food = '';
							}
							if ($value1 !== '' || $value2 !== '' || $value3 !== '' && $food !== 'Reps: ') {
								$food .= $value1 . ', ' . $value2 . ', ' . $value3;
							}
						}
						$FoodImageUrl = '';
						if ($ImageA != '') {
							$FoodImageUrl = $BaseURL . 'assets/images/food_type/' . $ImageA;
						} else {
							$FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
						}
						$exercise_img = $ImageA;
						$string = $_SERVER['DOCUMENT_ROOT'];
						$substring = 'rudrramc';
						if (strpos($string, $substring) !== false) {
							$FoodImageUrl = 'https://admin.ajasys.com/assets/FoodPhotos/' . $exercise_img;
						} else {
							$FoodImageUrl = 'http://localhost/admin/assets/FoodPhotos/' . $exercise_img;
						}
						if ($exercise_img == '') {
							$FoodImageUrl = 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg';
						}
						if ($HtmlCount == '1') {
							$sql = 'SELECT * FROM `master_exercise`';
							$result = $db->query($sql);
							$gymsmart_excrcise = $result->getResultArray();
							$MealCheckHtml++;
							$MealHtml .= '
											<tr class="deit-plane-heading">
												<td rowspan="' . $ArraySpanCount . '">
													<div>' . $MealName . '</div>
												</td>
												<td class="d-flex flex-wrap align-items-center border-0">';
							$MealHtml .= '
													<div class="me-3" style="width:30px;height:30px">
														<img src="' . $food_img . '" alt="#" class="w-100 h-100">
													</div>';
							if (isset($gymsmart_excrcise)) {
								$MealHtml .= '<div class="col">' . $Excercise . '</div>';
							}
							$MealHtml .= '
												</td>';
							$SubArraySetHtml = 0;
							if ($smrdArrayItems != '') {
								$SubArraySetHtml = count($smrdArrayItems);
							} else {
								$SubArraySetHtml = 0;
							}
							foreach ($smrdArrayItems as $repDurtextItem) {
								$MealHtml .= '<td>' . $repDurtextItem . '</td>';
							}
							$MTotolSet = intval($TotolSet) - intval($SubArraySetHtml);
							if (intval($MTotolSet) > 0) {
								for ($i = 1; $i <= $MTotolSet; $i++) {
									$MealHtml .= '<td>-</td>';
								}
							}
							$MealHtml .= '
												</tr>';
						} else {
							$sql = 'SELECT * FROM `master_exercise`';
							$result = $db->query($sql);
							$gymsmart_excrcise = $result->getResultArray();
							$MealHtml .= '
											<tr class="deit-plane-heading">
												<td class="d-flex flex-wrap align-items-center border-0">';
							$MealHtml .= '
													<div class="me-3" style="width:30px;height:30px">
														<img src="' . $food_img . '" alt="#" class="w-100 h-100">
													</div>';
							if (isset($gymsmart_excrcise)) {
								$MealHtml .= '<div class="col">' . $Excercise . '</div>';
							}
							$MealHtml .= '
												</td>';
							$SubArraySetHtml = 0;
							if ($smrdArrayItems != '') {
								$SubArraySetHtml = count($smrdArrayItems);
							} else {
								$SubArraySetHtml = 0;
							}
							foreach ($smrdArrayItems as $repDurtextItem) {
								$MealHtml .= '<td>' . $repDurtextItem . '</td>';
							}
							$MTotolSet = intval($TotolSet) - intval($SubArraySetHtml);
							if (intval($MTotolSet) > 0) {
								for ($i = 1; $i <= $MTotolSet; $i++) {
									$MealHtml .= '<td>-</td>';
								}
							}
							$MealHtml .= '</tr>';
						}
					}
					$TotalMealHtml .= $MealHtml;
				}
				$MealTotalCountCalery = floatval($MealTotalCountCalery) / intval($MealArraySpanCount);
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
									<div class="col-6 d-flex justify-content-end d-none">
										<span class= "fw-bolder ' . $RedGreenClass . ' ">' . intval($MealTotalCountCalery) . '</span>
										<span class="mx-2">Out of </span>
										<span class="fw-bolder">' . $CaleryTarget . '</span>
									</div>
								</div>
								<div class="w-100 mt-2">
									<table class="col-12 day-workout-plane">
										<thead>
											<tr class="deit-plane-heading ">
												<th class="number-head" style="width:200px;">
													<span>Exercise</span>
												</th>
												<th style="min-width:150px; width:600px;">
													<span>Exercise Name</span>
												</th>';
				for ($i = 1; $i <= $TotolSet; $i++) {
					$DayHtml .= '<th>Set ' . $i . '</th>';
				}
				$DayHtml .= '</tr>
										</thead>
										' . $TotalMealHtml . '';
				if (!empty($DayTotalCalll)) {
					$DayHtml .= '
											<tfoot>
													<tr class="deit-plane-heading">
														<td class="text-end" colspan="2">
															<div class="fw-bolder">Total Day Calories</div>
														</td>
														<td colspan="' . $TotolSet . '" >
															<span class="fw-bolder text-success ">' . intval($DayTotalCalll) . '</span>
														</td>
													</tr>
											</tfoot>';
				}
				$DayHtml .= '
									</table>
								</div>
							</div>
						';
			}
			$DayHtml = $DayHtml;
			$Rresult['Html'] = $DayHtml;
			if ($workoutRepetation == '1') {
				$workoutRepetation = 'Daily';
			}
			if ($workoutRepetation == '2') {
				$workoutRepetation = 'Weekly';
			}
			if ($workoutRepetation == '3') {
				$workoutRepetation = 'Custom';
			}
			$Rresult['WorkoutPlanName'] = $workoutName;
			$Rresult['Repetition'] = $workoutRepetation;
			$Rresult['Duration'] = $workoutDuration;
			$Rresult['Calories'] = $workoutCaleryTarget;
			return json_encode($Rresult);
		}
	}




	public function workoutAvailable()
	{

		$sql = 'SELECT * FROM master_workout WHERE LOWER(TRIM(REPLACE(WorkoutPlanName," ",""))) = "' . $_POST['name'] . '"';
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
	}

	public function AddToMasterworkout()
	{
		$EditID = $_POST['DataworkoutID'];
		$dbgym = \Config\Database::connect('gym');
		$MasterUserSQL = "SELECT * FROM `" . $_POST['Datausernameid'] . "_workoutplan` WHERE id = " . $EditID . "";
		$MasterUserSQL = $dbgym->query($MasterUserSQL);
		$workoutData = $MasterUserSQL->getRowArray();
		$ReturnStatus = '';
		if (isset($workoutData) && !empty($workoutData)) {
			unset($workoutData['CreatedAt']);
			unset($workoutData['id']);
			unset($workoutData['WorkoutPlanName']);
			$InsertData = $workoutData;
			$InsertData['CreatedAt'] =  gmdate('Y-m-d H:i:s');
			$InsertData['WorkoutPlanName'] = $_POST['workoutNameInputField'];
			$InsertData['user_id'] = $_POST['Datauserid'];
			$response = $this->MasterInformationModel->insert_entry2($InsertData, 'master_workout');
			$ReturnStatus = 1;
		}
		echo $ReturnStatus;
	}
}
