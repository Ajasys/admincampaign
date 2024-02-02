<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class RegisterController extends BaseController
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

    // visit list data 
    public function visit_reg_list_data()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $get_roll_id_to_roll_duty_var = array();
         } else {
            $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
         }
        // pre($_POST);
        // die();
        $user_id = $_SESSION['id'];
        $table_name = $_POST['table'];
        $action = $_POST['action'];
        $username = session_username($_SESSION['username']);
        if (isset($_POST['action1'])) {
			$action1 = $this->request->getPost('action1');
		} else {
			$action1 = '';
		}
        $ajaxsearch_query = '';
		if ($action   == "filter") {
			// pre($_POST);
			// die();
			unset($_POST['action']);
			unset($_POST['perPageCount']);
			unset($_POST['pageNumber']);
			unset($_POST['datastatus']);
			unset($_POST['follow_up_day']);
			unset($_POST['action1']);
            unset($_POST['table']);
			foreach ($_POST as $k => $v) {



				//$linkget .=  $k."=".$v."&";
				if (!empty($v) && $k  == "full_name") {
					$ajaxsearch_query .= ' AND full_name  LIKE "%' . $v . '%"';
				}
                if (!empty($v) && $k  == "f_inquiry_status") {
					$ajaxsearch_query .= ' AND inquiry_status  LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k  == "nxt_follow_up") {
					$newDate = date("Y-m-d", strtotime($v));
					$ajaxsearch_query .= ' AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d") ="' . $newDate . '" ';
				}

				if (!empty($v) && $k  == "from_date") {
					$newDate = date("Y-m-d", strtotime($v));
					// $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
					$ajaxsearch_query .= ' AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") >= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}

				if (!empty($v) && $k == "to_date") {
					$newDate = date("Y-m-d", strtotime($v));
					//$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") <= '.$newDate.'';
					$ajaxsearch_query .= '  AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") <= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}


				if (!empty($v) && $k != "full_name" && $k != "nxt_follow_up" && $k != "from_date" && $k != "to_date" && $k != 'f_inquiry_status') {
					$resStr = str_replace('f_', '', $k);
					$ajaxsearch_query .= " AND " . $resStr . "  = '" . $v . "'  ";
				}
			}
		}

        $html = "";
        $row_count_html = '';
        $return_array = array(
            'row_count_html' => '',
            'html' => '',
            'total_page' => 0,
            'response' => 0
        );

        $db_connection = \Config\Database::connect('second');
        $user_id = $_SESSION['id'];
        $status = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "";
        $perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
        $pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
        $ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
        $datastatus = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "'1','2','3','4','6','7','9','10','11','12','13'";
        $which_result = isset($_POST['follow_up_day']) && !empty($_POST['follow_up_day']) ? $_POST['follow_up_day'] : '';

        $db = $db_connection;
        // if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            // $sql = 'SELECT * FROM ' .  $username . "_all_inquiry" . ' WHERE isSiteVisit = 1 '. $ajaxsearch_query .'';
            $sql = 'SELECT * FROM ' .  $username . "_all_inquiry" . ' WHERE (inquiry_status = 4 OR isSiteVisit = 1)'. $ajaxsearch_query .'';
            // } else {
            //     $all_gm_under_people = '';
            //     $all_gm_under_people = getChildIds($_SESSION['id']);
            //     $array_push = array_push($all_gm_under_people, $user_id);
            //     $all_gm_under_people_implode = "'" . implode("', '", $all_gm_under_people) . "'";

            //     $sql = 'SELECT *
            //     FROM ' . $username . '_all_inquiry
            //     WHERE (inquiry_status = 4 OR isSiteVisit = 1)
            //       AND (assign_id = ' . $_SESSION['id'] . ' OR assign_id IN (' . $all_gm_under_people_implode . ') OR owner_id IN (' . $all_gm_under_people_implode . '))
            //       AND user_id IN (' . $all_gm_under_people_implode . ') '.$ajaxsearch_query.'
            //     ';
            //     // $sql = 'SELECT *
            //     // FROM ' . $username . '_all_inquiry
            //     // WHERE isSiteVisit = 1
            //     //   AND (assign_id = ' . $_SESSION['id'] . ' OR assign_id IN (' . $all_gm_under_people_implode . ') OR owner_id IN (' . $all_gm_under_people_implode . '))
            //     //   AND user_id IN (' . $all_gm_under_people_implode . ') '.$ajaxsearch_query.'
            //     // ';
            // }
       
        
        // pre($action1);
        // die();
        
        $main_sql = $sql;
        $result = $db->query($sql);
        $location_result = $result->getResult();
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
            $status = get_table_array_helper('master_inquiry_status');
            $today = date("d-m-Y");
            $html = "";

            foreach ($inquiry_all_data as $key => $value) {
                // pre($value);
                // die();
                $assign_name = '';
                $user_data = user_id_to_full_user_data($value['assign_id']);
                if ($value['assign_id'] == 0) {
                    if (isset($user_data['name'])) {
                        $assign_name = $user_data['name'];
                    }
                } else {
                    if (isset($user_data['firstname'])) {
                        $assign_name = $user_data['firstname'];
                    }
                }

                // $product_name = any_id_to_full_data($username.'_product',);

                $btn_class = 'status_color_' . $value['inquiry_status'];
                $btn_name = 'Default';
                if (isset($value['inquiry_status']) && !empty($value['inquiry_status'])) {
                    if (isset($status[$value['inquiry_status']])) {
                        $btn_class = 'status_color_' . $value['inquiry_status'];
                        $btn_name = $status[$value['inquiry_status']]['inquiry_status'];
                    }
                }


                $inquiry_details = "";
                if (!empty($value['inquiry_type'])) {
                    $inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $value['inquiry_type'] . "", $username."_master_inquiry_type");
                    $inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
                }
                $intrested_product = "";
                if (!empty($value['intrested_product'])) {
                    $intrested_product_name = IdToFieldGetData('product_name', "id=" . $value['intrested_product'] . "", $username."_product");
                    $intrested_product = isset($intrested_product_name['product_name']) && !empty($intrested_product_name['product_name']) ? $intrested_product_name['product_name'] : '';
                }
                $html .= '<tr>
                <td>
                    <input type="checkbox" name="inquiry_id[]" class="checkbox mt-2 inquiry_id" value="' . $value['id'] . '">
                </td>';
                    $html .= ' <td type="button" class="today-follow-tab-content-td ee-todayfollow mt-2 col-12">
                              <div class="tfp-inquiry-list pe-3 bg-white">
                                 <div class="inquiry-list-topbar d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="inquiry-list-topbar-id-name d-flex align-items-center col-12 col-xl-4">
                                       <span><b>' . $value['id'] . '</b></span>
                                       <h6 class="mx-2">' . $value['full_name'] . '</h6>';
    
                    $html .= '</div>
                         <div class="inquiry-list-topbar-icon d-flex align-items-center col-xxs-12 col-xl-4 justify-content-end">
                                       <button class="' . $btn_class . ' me-1">' . $btn_name . '</button>	';
                                       if (in_array('demo_register_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { 
                                       $html .= '  <div class="btn-primary-rounded mx-1 inquiry_all_status_update edt" type="button" data-inquiry_edit_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update">
                                       <i class="fa-solid fa-pencil fs-12"></i>
                                   </div>
                                   ';
                                };
                    $html .= ' </div>
                                 </div>
                                 <div class="inquiry-list-content d-flex justify-content-start align-items-center flex-wrap inquery_view" data-view_id="' . $value['id'] . '"';
                                if (in_array('demo_register_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { 
                                 $html .= '   data-bs-toggle="modal" data-bs-target="#view_inquery_list"';
                                };
                                $html .= ' >
                                
                                    <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                        p><i class="fa-solid fa-user-tie"></i> : </p>
                                       <span class="mx-1">' . $assign_name . '</span>
                                    </div>
                                    <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                        <p><i class="fa-solid fa-calendar-days"></i> : </p>
                                       <span class="mx-1">' . followup_date_convert_indian_date($value['created_at']) . '</span>
                                    </div>
                                    <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                        <p><i class="bi bi-person-fill-up"></i> : </p>
                                       <span class="mx-1">' . followup_date_convert_indian_date($value['nxt_follow_up']) . '</span>
                                    </div>
                                    <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                        <p><i class="bi bi-currency-rupee"></i> : </p>
                                       <span class="mx-1">' . $value['budget'] . '</span>
                                    </div>
                                    <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                        <p>Inq type : </p>
                                       <span class="mx-1">' . $inquiry_details . '</span>
                                    </div>
                                    <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                       <p>Int Product  : </p>
                                       <span class="mx-1">' . $intrested_product . '</span>
                                    </div>
                                 </div>
                              </div>
                           </td>';
                    $html .= '</tr>';
            }

            if ($result->getNumRows() > 0) {
				if ($action == 'export' || $action1 == 'export') {
					// pre($sql);
					$inquiry_all_data = $result->getResultArray();
					$lineData = array();
					foreach ($inquiry_all_data as $key => $value) {
						if (!empty($value['id']) && !empty(htmlentities($value['full_name'])) && !empty($value['mobileno'])) {
							$lineData[] = array(
								'id' => $value['id'],
								'firstname' => htmlentities($value['full_name']),
								'mobileno' => $value['mobileno']
							);
						}
					}
                    
					$return_array['export_data'] = $lineData;
					echo json_encode($return_array);
                    die();
					// exit;
				}
			}

            // die();
            $return_array['row_count_html'] = $row_count_html;
            $return_array['html'] = $html;
            $return_array['total_page'] = $pagesCount;
            $return_array['response'] = 1;
        } else {
            $return_array['row_count_html'] = "Page 0 of 0";
            $return_array['total_page'] = 0;
            $return_array['response'] = 1;
            $return_array['html'] = '<p style="text-align:center;">Data Not Found </p>';
        }

        // echo $html;
        echo json_encode($return_array);


        die();
    }


    // revisit list data 
    public function revisit_reg_list_data()
    {


        $user_id = $_SESSION['id'];
        $table_name = $_POST['table'];
        $action = $_POST['action'];
        // $user_id=$_POST['user_id'];
        $username = session_username($_SESSION['username']);
        // $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
        // $departmentdisplaydata = json_decode($departmentdisplaydata, true);

        $ajaxsearch_query = '';
		if ($action   == "filter") {
			// pre($_POST);
			// die();
			unset($_POST['action']);
			unset($_POST['perPageCount']);
			unset($_POST['pageNumber']);
			unset($_POST['datastatus']);
			unset($_POST['follow_up_day']);
			unset($_POST['action1']);
            unset($_POST['table']);
			foreach ($_POST as $k => $v) {



				//$linkget .=  $k."=".$v."&";
				if (!empty($v) && $k  == "full_name") {
					$ajaxsearch_query .= ' AND full_name  LIKE "%' . $v . '%"';
				}
				if (!empty($v) && $k  == "nxt_follow_up") {
					$newDate = date("Y-m-d", strtotime($v));
					$ajaxsearch_query .= ' AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d") ="' . $newDate . '" ';
				}

				if (!empty($v) && $k  == "from_date") {
					$newDate = date("Y-m-d", strtotime($v));
					// $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
					$ajaxsearch_query .= ' AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") >= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}

				if (!empty($v) && $k == "to_date") {
					$newDate = date("Y-m-d", strtotime($v));
					//$ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") <= '.$newDate.'';
					$ajaxsearch_query .= '  AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s") <= STR_TO_DATE("' . $newDate . '", "%Y-%m-%d") ';
				}


				if (!empty($v) && $k != "full_name" && $k != "nxt_follow_up" && $k != "from_date" && $k != "to_date" && $k != 'f_inquiry_status') {
					$resStr = str_replace('f_', '', $k);
					$ajaxsearch_query .= " AND " . $resStr . "  = '" . $v . "'  ";
				}
			}
		}

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
        $db_connection = \Config\Database::connect('second');
        $user_id = $_SESSION['id'];
        $status = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "";
        $perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
        $pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
        $ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
        $datastatus = isset($_POST['datastatus']) && !empty($_POST['datastatus']) ? $_POST['datastatus'] : "'1','2','3','4','6','7','9','10','11','12','13'";
        $which_result = isset($_POST['follow_up_day']) && !empty($_POST['follow_up_day']) ? $_POST['follow_up_day'] : '';
        $db = $db_connection;
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $sql = 'SELECT * FROM ' .  $username . "_all_inquiry" . ' WHERE   inquiry_status = 11 '.$ajaxsearch_query.' ORDER BY id DESC';
            // pre($sql);

        } else {
            $all_gm_under_people = '';
            $all_gm_under_people = getChildIds($_SESSION['id']);
            $array_push = array_push($all_gm_under_people, $user_id);
            $all_gm_under_people_implode = "'" . implode("', '", $all_gm_under_people) . "'";

            $sql = 'SELECT *
            FROM ' . $username . '_all_inquiry
            WHERE isSiteVisit = 2
              AND inquiry_status != 7
              AND inquiry_status = 11
              AND (assign_id = ' . $_SESSION['id'] . ' OR assign_id IN (' . $all_gm_under_people_implode . ') OR owner_id IN (' . $all_gm_under_people_implode . '))
              AND user_id IN (' . $all_gm_under_people_implode . ') '.$ajaxsearch_query.'
            ';
            // die();
        }
        $result = $db->query($sql);
        $location_result = $result->getResult();
        $main_sql = $sql;

        if ($result->getNumRows() > 0) {
            $rowCount = $result->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;
            $pagesCount = ceil($rowCount / $perPageCount);
            $lowerLimit = ($pageNumber - 1) * $perPageCount;

            $sqlQuery = $main_sql . " LIMIT $lowerLimit , $perPageCount";
       
            // SELECT * FROM urvi_all_inquiry WHERE isSiteVisit = 1 ORDER BY id DESC LIMIT 10


            $Getresult = $db_connection->query($sqlQuery);
            $inquiry_all_data = $Getresult->getResultArray();
        
            $rowCount_child = $Getresult->getNumRows();

            $start_entries = $lowerLimit + 1;
            $last_entries = $start_entries + $rowCount_child - 1;

            $row_count_html .= 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
            $i = 1;
            $loop_break = 0;
            $status = get_table_array_helper('master_inquiry_status');
            $today = date("d-m-Y");
            $html = "";

            $html = "";

            foreach ($inquiry_all_data as $key => $value) {
                // pre($value);
                // die();
                $assign_name = '';
                $user_data = user_id_to_full_user_data($value['assign_id']);
                if ($value['assign_id'] == 0) {
                    if (isset($user_data['name'])) {
                        $assign_name = $user_data['name'];
                    }
                } else {
                    if (isset($user_data['firstname'])) {
                        $assign_name = $user_data['firstname'];
                    }
                }

                $btn_class = 'status_color_' . $value['inquiry_status'];
                $btn_name = 'Default';
                if (isset($value['inquiry_status']) && !empty($value['inquiry_status'])) {
                    if (isset($status[$value['inquiry_status']])) {
                        $btn_class = 'status_color_' . $value['inquiry_status'];
                        $btn_name = $status[$value['inquiry_status']]['inquiry_status'];
                    }
                }


                $inquiry_details = "";
                if (!empty($value['inquiry_type'])) {
                    $inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $value['inquiry_type'] . "", $username."_master_inquiry_type");
                    $inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
                }
                $html .= '<tr>
            <td>
                <input type="checkbox" name="inquiry_id[]" class="checkbox mx-1 mt-2  inquiry_id" value="' . $value['id'] . '">
            </td>';
                $html .= ' <td type="button" class="today-follow-tab-content-td ee-todayfollow mt-2 col-xxl-12">
                          <div class="tfp-inquiry-list pe-3 bg-white">
                             <div class="inquiry-list-topbar d-flex align-items-center justify-content-between flex-wrap">
                                <div class="inquiry-list-topbar-id-name d-flex align-items-center col-xxs-12 col-xl-4">
                                   <p class="fs-xxs-7"><b>' . $value['id'] . '</b></p>
                                   <h6 class="mx-2 fs-xxs-7">' . $value['full_name'] . '</h6>';

                $html .= '</div>
                     <div class="inquiry-list-topbar-icon d-flex align-items-center col-xxs-12 col-xl-4 justify-content-end">
                                   <button class="' . $btn_class . ' me-1 fs-xxs-7">' . $btn_name . '</button>	';
                                   $html .= '  <div class="call-btn view-model-btn mx-1 inquiry_all_status_update edt" type="button" data-inquiry_edit_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update">
                                   <i class="fa-solid fa-pencil"></i>
                               </div>
                               ';

                $html .= ' </div>
                             </div>
                             <div class="inquiry-list-content d-flex justify-content-start align-items-center flex-wrap inquery_view" data-view_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#view_inquery_list">
                                <div class="d-flex align-items-center col-3 col-xxs-6 col-xs-6 col-xl-3">
                                   <p class="lh-21"><i class="fa-solid fa-user-tie lh-21 text-black me-1 fs-xxs-7"></i> : </p>
                                   <span class="mx-1 fs-xxs-7 lh-21">' . $assign_name . '</span>
                                </div>
                                <div class="d-flex align-items-center col-3 col-xxs-6 col-xs-6 col-xl-3">
                                   <p class="lh-21"><i class="fa-solid fa-calendar-days text-black me-1 fs-xxs-7 lh-21"></i> : </p>
                                   <span class="mx-1 fs-xxs-7 lh-21 text-wrap">' . followup_date_convert_indian_date($value['created_at']) . '</span>
                                </div>
                                <div class="d-flex align-items-center col-3 col-xxs-6 col-xs-6 col-xl-3">
                                   <p class="lh-21"><i class="bi bi-person-fill-up text-black me-1 fs-xxs-7 lh-21"></i> : </p>
                                   <span class="mx-1 fs-xxs-7 lh-21">' . followup_date_convert_indian_date($value['nxt_follow_up']) . '</span>
                                </div>
                                <div class="d-flex align-items-center col-3 col-xxs-6 col-xs-3 col-xl-3">
                                   <p class="lh-21"><i class="bi bi-currency-rupee text-black me-1 fs-xxs-7 lh-21"></i> : </p>
                                   <span class="mx-1 fs-xxs-7 lh-21">' . $value['budget'] . '</span>
                                </div>
                                <div class="d-flex align-items-center col-3 col-xxs-12 col-xs-6 col-xl-3">
                                   <p class="fs-xxs-7 lh-21">Inq type : </p>
                                   <span class="mx-1 fs-xxs-7 lh-21">' . $inquiry_details . '</span>
                                </div>
                                <div class="d-flex align-items-center col-3 col-xxs-12 col-xs-9 col-xl-3 flex-wrap">
                                   <p class="fs-xxs-7 lh-217">Int Product : </p>
                                   <span class="mx-1 fs-xxs-7 lh-21">' . $value['intrested_product'] . '</span>
                                </div>
                             </div>
                          </div>
                       </td>';
                $html .= '</tr>';
            }

            // die();
            $return_array['row_count_html'] = $row_count_html;
            $return_array['html'] = $html;
            $return_array['total_page'] = $pagesCount;
            $return_array['response'] = 1;
        } else {
            $return_array['row_count_html'] = "Page 0 of 0";
            $return_array['total_page'] = 0;
            $return_array['response'] = 1;
            $return_array['html'] = '<p style="text-align:center;">Data Not Found </p>';
        }

        // echo $html;
        echo json_encode($return_array);


        die();
    }

    public function project_to_get_unit(){
		$this->db = \Config\Database::connect();
		$post_data= $this->request->getPost();
		$field = $this->request->getPost("field");
		
		$field_value = $this->request->getPost("intrested_site");
		
		if($this->request->getPost("action")== "get_data"){
			// $booked_unit_value = get_booked_unit_id_depend_project_id($field_value);
			$builder = $this->db->table('urvi_properties');
			$project_data = $builder->select('*')
					 ->where($field , $field_value)
					 ->get();
			
			$project_result = $project_data->getResult();
			
			if(!empty($project_result)){
	
				?>
				<option value="">Select Unit</option>
				<?php
				foreach($project_result as $key => $value_unit) {	
					
					if(!empty($value_unit->unit_no))
					{
						if(in_array($value_unit->unit_no,$project_result))
						
						{
							
					?>
						<option value="<?php echo $value_unit->unit_no; ?>"  ><?php echo $value_unit->unit_no; ?></option>
					<?php 
						}else{
							?>
								<option value="<?php echo $value_unit->unit_no; ?>"><?php echo $value_unit->unit_no; ?></option>
							<?php
						}
					}else{ ?>
						<option value="">Not Found</option>
					<?php
					}
	
				}
	
			}
					
				
		}
		die();
	}


  
}
