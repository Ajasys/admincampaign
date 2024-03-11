<?php
namespace App\Controllers;
use App\Models\MasterInformationModel;
use Config\Database;
use DateTime;
class Followup extends BaseController
{
    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = session_username($_SESSION["username"]);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
    }
    public function inquiry_call()
    {
        date_default_timezone_set('Asia/Kolkata');
        $result = [];
        $inquiry_head_data = "";
        $model_header_html = "";
        $intrest_area_required_html_btn = "";
        $result_full_name = "";
        $inquiry_call_html = "";
        $model_button_action_html = "";
        $inquiry_status_progressbar_html = "";
        $inquiry_status_progressbar_html = 0;
        $model_button_html = "";
        $action = $_POST["action"];
        $inquiry_id = $_POST["inquiry_id"];
        $inquiry_data = $this->MasterInformationModel->edit_entry_all2('admin_all_inquiry', $inquiry_id, "id");
        $inquiry_call_data = $this->MasterInformationModel->edit_entry_all2($this->username . '_followup', $inquiry_id,  "inquiry_id", $oreder = "DESC");
        $inquiry_data = get_object_vars($inquiry_data[0]);
        $inquiry_data['inq_id'] = $inquiry_data['id'];
        // $leave_data_2245 = json_decode(json_encode($inquiry_data[0]), true);
        if (isset($inquiry_data) && !empty($inquiry_data) && @$inquiry_id) {
            // $project = get_table_array_helper("project");
            // $intrested_site = code_to_fullname($project, $inquiry_data, "intrested_site","project_name"  );
            // $master_project_type = get_table_array_with_code_helper( "master_project_type"  );
            // $project_type = code_to_fullname( $master_project_type, $inquiry_data, "code_property_type", "project_type_name" );
            // $final_btn = "";
            // $intrest_area_required_html_btn = "";
            // if (!empty($inquiry_data["budget"]) && !empty($inquiry_data["purpose_buy"]) && !empty($inquiry_data["approx_buy"]) ) {
            // } else {
            //     //$final_btn .= "disabled";
            //     $intrest_area_required_html_btn .='<button type="button" class="btn fill-interest-btn" id="interest_inquiry_id" data-interest_id=' .$inquiry_id .'> fill interest
            //                     </button>';
            // }
            if (!empty($inquiry_data['property_sub_type'])) {
                $project_sub_type = IdToFieldGetData('', "id=" . $inquiry_data['property_sub_type'] . "", "project_management_subtype");
                $inquiry_data['project_sub_type_name'] = isset($project_sub_type['project_sub_type']) && !empty($project_sub_type['project_sub_type']) ? $project_sub_type['project_sub_type'] : '';
                //$project_sub_type = IdToFieldGetData('project_sub_type', "id=" . $inquiry_data['property_sub_type'] . "", "project_management_subtype");
                $inquiry_data['project_type_name'] = isset($project_sub_type['project_type']) && !empty($project_sub_type['project_type']) ? $project_sub_type['project_type'] : '';
            }
            $fill_interst = 0;
            if (!empty($inquiry_data['intrested_product']) && !empty($inquiry_data['subscription']) && !empty($inquiry_data['budget']) && !empty($inquiry_data['buying_as']) && !empty($inquiry_data['approx_buy'])) {
            } else {
                if ($inquiry_data['inquiry_status'] == '12' || $inquiry_data['inquiry_status'] == '7' || $inquiry_data['inquiry_status'] == '8') {
                    $intrest_area_required_html_btn = '';
                } else {
                    if ($inquiry_data['assign_id'] == $_SESSION['id'] || isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                        $intrest_area_required_html_btn = '<button type="button" class="btn-primary fs-12 px-2 py-1 fill-interest-btn" id="interest_inquiry_id" data-interest_id=' . $inquiry_id . '>fill interest</button>';
                        $fill_interst = 1;
                    } else {
                        $intrest_area_required_html_btn = '';
                        $fill_interst = 0;
                    }
                }
            }
        }
        $getchild = getChildIds($_SESSION['id']);
        $access =  0;
        if ($this->admin == 1) {
            $access =  1;
        } elseif (in_array($inquiry_data['assign_id'], $getchild)) {
            $access =  1;
        } elseif ($inquiry_data['assign_id'] == $_SESSION['id']) {
            $access =  1;
        } else {
            // continue;
        }
        // if($access == 1){
        $model_button_html .= '
            <li class="nav-item">
                <button class="nav-link dess follow-up-active" id="follow-up-tab" data-bs-toggle="pill" data-bs-target="#pills-follow-up" type="button" role="tab" aria-controls="pills-follow-up" aria-selected="true" data-list="list_default_action" data-inq_status="2" data-inq_tag="Contacted">follow up</button>
            </li>
            <li class="nav-item">
                <button class="nav-link cc2" id="dismissed-tab" data-bs-toggle="pill" data-bs-target="#pills-dismissed" type="button" role="tab" aria-controls="pills-dismissed" aria-selected="false" data-list="list_dismissed_action" data-inq_status="8" data-inq_tag="Dismissed">dismissed</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="appoin-tab" data-bs-toggle="pill" data-bs-target="#pills-appoin" type="button" role="tab" aria-controls="pills-appoin" aria-selected="false" data-list="list_appointment_action" data-inq_status="3" data-inq_tag="Appointment" >Demo Appointment</button>
            </li>';
        if ($inquiry_data["isSiteVisit"] == 1 || $inquiry_data["isSiteVisit"] == 2) {
            $model_button_html .= '
            <li class="nav-item">                 
                <button class="nav-link" id="negotia-tab" data-bs-toggle="pill" data-bs-target="#pills-negotia" type="button" role="tab" aria-controls="pills-negotia" aria-selected="false" data-list="list_nego_action" data-inq_status="6" data-inq_tag="Negotiation">negotitation</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="feedback-tab" data-bs-toggle="pill" data-bs-target="#pills-feedback" type="button" role="tab" aria-controls="pills-feedback" aria-selected="false" data-list="list_feedback_action" data-inq_status="9" data-inq_tag="Feedback">feedback</button>
            </li>';
        }
        $model_button_html .= '
            <li class="nav-item">
                <button class="nav-link" id="cnr-tab" data-bs-toggle="pill" data-bs-target="#pills-cnr" type="button" role="tab" aria-controls="pills-cnr" aria-selected="false" data-list="list_cnr_action" data-inq_status="17" data-inq_tag="CNR">cnr</button>
            </li>
            <button class="ms-auto btn-primary px-2 py-1 rounded-1 fs-12" data-bs-toggle="modal" data-bs-target="#quotation">Quotation</button>';
        // }
        $inquiry_call_data = (array)$inquiry_call_data;
        if (isset($inquiry_call_data) && !empty($inquiry_call_data)) {
            $inquiry_log_data_count = 1;
            foreach ($inquiry_call_data as $key => $inquiry_log_data) {
                $inquiry_log_data = get_object_vars($inquiry_log_data);
                // Assuming $inquiry_log_data['inquiry_id'] is not empty and contains a valid ID
                $inquiry_id = $inquiry_log_data['inquiry_id'];
                if (!empty($inquiry_id)) {
                    $qry = "SELECT full_name FROM admin_all_inquiry WHERE id = '" . $inquiry_id . "'";
                    $secondDb = DatabaseDefaultConnection();
                    $result = $secondDb->query($qry);
                    $full_name_inq = $result->getResultArray();
                } else {
                    // Handle the case when $inquiry_log_data['inquiry_id'] is empty or invalid
                    $full_name_inq = array(); // Empty array or any other appropriate handling
                }
                // $full_name_inq= implode(",",$full_name_inq2);
                $usernamde =  user_id_to_full_user_data($inquiry_log_data['user_id']);
                $username = "";
                if ($inquiry_log_data['user_id'] == 0) {
                    if (isset($usernamde['name'])) {
                        $username = $usernamde['name'];
                    }
                } else {
                    if (isset($usernamde['firstname'])) {
                        $username = $usernamde['firstname'];
                    }
                }
                $entrydate = date('d-m-Y', strtotime($inquiry_log_data['created_at']));
                $status_label =  status_id_to_full_status_data($inquiry_log_data['status_id'], true);
                if ($inquiry_log_data['status_id'] == 7) {
                    $nxtfollowdate = '';
                } else {
                    $nxtfollowdate = followup_date_convert_indian_date($inquiry_log_data['nxt_follow_up']);
                }
                $inquiry_call_html .= '
                    <div class="pending-main-table p-2">
                        <div class="d-flex call-body-section  flex-wrap">
                            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-xxs-5">
                                <span class="me-1"><i class="bi bi-calendar"></i> :</span>
                                <span class="fw-semibold"> ' . $entrydate . '</span>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-xxs-7 d-flex flex-wrap">    
                                <span class="me-1"><i class="bi bi-person-down"></i> :</span>
                                <span><?php echo implode(",", $full_name_inq); ?></span>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-xxs-7 d-flex flex-wrap">
                                <span> ' . $username . '</span>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-8 col-sm-8 col-xxs-9 d-flex flex-wrap">
                                <span class="me-1"><i class="bi bi-chat-heart"></i> :</span>
                                <span> ' . $inquiry_log_data['remark'] . '</span>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-4 col-sm-4 fs-7 d-flex flex-wrap">
                                <span class="me-1"><i class="bi bi-calendar2-check"></i> :</span>
                                <span class="fw-semibold"> ' . $nxtfollowdate . '</span>
                            </div>
                        </div>
                    </div>';
            }
        }
        $result = [
            "result" => true,
            "inquiry_all_status_data" => $inquiry_data,
            "model_header_html" => $model_header_html,
            "intrest_area_required_html_btn" => $intrest_area_required_html_btn,
            "inquiry_call_html" => $inquiry_call_html,
            "inquiry_call_html_btn_action" => $model_button_html,
            "fill_interst" => $fill_interst,
        ];
        return json_encode($result, true);
        die();
    }
    public function product_wise_plan()
    {
        $db_connection = DatabaseDefaultConnection();
        $subscription_data = "SELECT * FROM admin_subscription_master WHERE crm=" . $_POST['product_type'];
        $result = $db_connection->query($subscription_data);
        $result = $result->getResultArray();
        $data = '';
        foreach ($result as $key => $value) {
            if ($value['plan_price'] != '0') {
                $data.= '<label class="ms-2 white_icon me-3 mb-2">
                        <input type="checkbox" name="quation_name" value="' . $value['id'] . '"
                         class="reminder-input-toggle check_clear" DataCrm = "'.$value['crm'].'">
                        ' . $value['plan_name'] . '
                    </label>';
            }
        }
        return $data;
    }
    // public function inquiry_update_status()
    // {
    //     $remark = '';
    //     if (isset($_POST['remark']) && !empty($_POST['remark'])) {
    //         $remark = $_POST['remark'];
    //     }
    //     $inquiry_id =  $_POST['inquiry_id'];
    //     $update_data = array();
    //     $status_array_log = array();
    //     $user_id = '';
    //     $response = 0;
    //     $result = array(
    //         'result' => 0,
    //         'msg' => 'Inquiry Status Not Updated!'
    //     );
    //     $session_data = get_session_data();
    //     if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    //         $user_id = 0;
    //     } else {
    //         $user_id = $_SESSION['id'];
    //     }
    //     if (isset($session_data) && !empty($session_data['id'])) {
    //         if (isset($session_data['admin']) && $session_data['admin'] == 1) {
    //             $userfullname = $session_data['name'];
    //         } else {
    //             $userfullname = $session_data['firstname'];
    //         }
    //     }
    //     if(isset($_POST['nxt_follow_up']) && !empty($_POST['nxt_follow_up'])){
    //         $nxtfollowdate = date('Y-m-d H:i:sa', strtotime($_POST['nxt_follow_up']));
    //     }else{
    //         $nxtfollowdate = date('Y-m-d H:i:sa');
    //     }
    //     $inquiry_data = inquiry_id_to_full_inquiry_data($_POST['inquiry_id']);
    //     if (isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '7') {
    //         // Dismissed inquiry (close)
    //         $master_inquiry_close_reason = get_table_array_helper('admin_master_inquiry_close');
    //         $inquiry_status_id = $_POST['status_btn_click'];
    //         $inquiry_tag = $_POST['tag_btn_click'];
    //         $close_reason = '';
    //         $close_remarks = '';
    //         if (isset($_POST['inquiry_close_reason'])) {
    //             $close_reason_id = $_POST['inquiry_close_reason'];
    //             if (isset($master_inquiry_close_reason[$close_reason_id])) {
    //                 $close_reason = $master_inquiry_close_reason[$close_reason_id]['inquiry_close_reason'];
    //             }
    //             // if ($_POST['inquiry_close_reason'] == 11) {
    //             //     if (isset($inquiry_data) && !empty($inquiry_data)) {
    //             //         // convert people to broker
    //             //         $update_data = array(
    //             //             'user_type' => '2'
    //             //         );
    //             //         // $broker_fullname = $inquiry_data['full_name'];
    //             //         // pre($broker_fullname);
    //             //         // die();
    //             //         $broker_data = array(
    //             //             'assign_id' => $user_id,
    //             //             'user_id' => $user_id,
    //             //             'mobileno' => isset($inquiry_data['mobileno']) && !empty($inquiry_data['mobileno']) ? $inquiry_data['mobileno'] : '',
    //             //             'brokername' => $broker_fullname,
    //             //         );
    //             //         // $response = $this->MasterInformationModel->insert_entry($broker_data,$this->username.'_broker');
    //             //         $convert_people_to_broker = $this->MasterInformationModel->update_entry2($_POST['inquiry_id'], $update_data, 'admin_all_inquiry');
    //             //     }
    //             // }
    //         }
    //         $close_remarks = $remark;
    //         $status_array = array(
    //             'user_id' => $user_id,
    //             'inquiry_id' => $inquiry_id,
    //             'remark' => $remark,
    //             'status_id' => $inquiry_status_id,
    //         );
    //         // admin_query_followup
    //         $response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_followup');
    //         if ($response_status_log) {
    //             $update_data = array(
    //                 'inquiry_status' => $inquiry_status_id,
    //                 'head_status' => '0',
    //                 'nxt_follow_up' => $nxtfollowdate
    //             );
    //             $update_data['inquiry_cnr'] = 0;
    //             $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id, $update_data, 'admin_all_inquiry');
    //             $status_name = status_id_to_full_status_data($inquiry_status_id, true);
    //             $inquiry_log = array(
    //                 'inquiry_id' => $inquiry_id,
    //                 'status_id' => $inquiry_status_id,
    //                 'user_id' => $user_id,
    //                 'inquiry_log' => 'Inquiry ' . $inquiry_tag . ' By ' . $userfullname . '<br> Inquiry Close Reason : ' . $close_reason . ' <br> Inquiry Close Remarks : ' . $close_remarks
    //             );
    //             $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
    //             $result['result'] = 1;
    //             // admin_query_inquiry_log
    //             $result['msg'] = 'Inquiry Status Dismissed Successfully';
    //         } else {
    //             $result['result'] = 0;
    //             $result['msg'] = 'Inquiry Status Not Dismissed';
    //         }
    //         // pre($result);
    //         // die();
    //     } else if (isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '6') {
    //         // Negotiation inquiry
    //         // $before_status_log = array();
    //         // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all($this->username . '_followup', $inquiry_id, 'inquiry_id');
    //         // if (isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)) {
    //         //     foreach ($inquiry_logEditdata as $val => $value) {
    //         //         $value = get_object_vars($value);
    //         //         $before_status_log[$value['status_id']] = $value;
    //         //     }
    //         // }
    //         // $negotiation_access = 0;
    //         // if (isset($before_status_log['4'])) {
    //         //     $negotiation_access = 1;
    //         // }
    //         // if (isset($before_status_log['11'])) {
    //         //     $negotiation_access = 1;
    //         // }
    //         // if (isset($before_status_log['9'])) {
    //         //     $negotiation_access = 1;
    //         // }
    //         $negotiation_access = $inquiry_data['isSiteVisit'];
    //         if ($negotiation_access == 1 || $negotiation_access == 2) {
    //             $inquiry_status_id = $_POST['status_btn_click'];
    //             $inquiry_tag = $_POST['tag_btn_click'];
    //             $status_array = array(
    //                 'user_id' => $user_id,
    //                 'inquiry_id' => $inquiry_id,
    //                 'remark' => $remark,
    //                 'status_id' => $inquiry_status_id,
    //                 'nxt_follow_up' => $nxtfollowdate
    //             );
    //             $response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_followup');
    //             if ($response_status_log) {
    //                 $update_data = array(
    //                     'inquiry_status' => $inquiry_status_id,
    //                     'head_status' => '1',
    //                     'nxt_follow_up' => $nxtfollowdate
    //                 );
    //                 $update_data['inquiry_cnr'] = 0;
    //                 $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id, $update_data, 'admin_all_inquiry');
    //                 $status_name = status_id_to_full_status_data($inquiry_status_id, true);
    //                 $inquiry_log = array(
    //                     'inquiry_id' => $inquiry_id,
    //                     'status_id' => $inquiry_status_id,
    //                     // 'inquiry_status' => $status_name,
    //                     'user_id' => $user_id,
    //                     // 'remark' => $remark,
    //                     // 'nxtfollowdate' => $nxtfollowdate,
    //                     'inquiry_log' => 'Inquiry ' . $inquiry_tag . ' By ' . $userfullname
    //                 );
    //                 $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
    //                 // $inquiry_status_log = array(
    //                 //     'inquiry_id' => $inquiry_id,
    //                 //     'user_id' => $user_id, 
    //                 //     'inquiry_status_id' => $inquiry_status_id,
    //                 //     'inquiry_status' => $inquiry_tag
    //                 // );
    //                 // $response_status_log = $this->MasterInformationModel->insert_entry($inquiry_status_log,'inquiry_status_log');
    //                 // $response = 1;
    //                 $result['result'] = 1;
    //                 $result['msg'] = 'Inquiry Status Negotiation changed Successfully';
    //             } else {
    //                 $result['result'] = 0;
    //                 $result['msg'] = 'Inquiry Negotiation Status not changed';
    //             }
    //         } else {
    //             $result['result'] = 0;
    //             $result['msg'] = 'Inquiry Not Follow Status Flow';
    //         }
    //     } else if (isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '9') {
    //         // Feedback inquiry
    //         // $before_status_log = array();
    //         // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all2($this->username . '_inquiry_log', $inquiry_id, 'inquiry_id');
    //         // if (isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)) {
    //         //     foreach ($inquiry_logEditdata as $val => $value) {
    //         //         $value = get_object_vars($value);
    //         //         $before_status_log[$value['inquiry_status_id']] = $value;
    //         //     }
    //         // }
    //         // $feedback_access = 0;
    //         // if (isset($before_status_log['4'])) {
    //         //     $feedback_access = 1;
    //         // }
    //         // if (isset($before_status_log['11'])) {
    //         //     $feedback_access = 1;
    //         // }
    //         $feedback_access = $inquiry_data['isSiteVisit'];
    //         if ($feedback_access == 1 || $feedback_access == 2) {
    //             $inquiry_status_id = $_POST['status_btn_click'];
    //             $inquiry_tag = $_POST['tag_btn_click'];
    //             // $feedback = (isset($_POST['feedback_remark'])) ? $_POST['feedback_remark'] : "";
    //             $feedback = $remark;
    //             $status_array = array(
    //                 'user_id' => $user_id,
    //                 'inquiry_id' => $inquiry_id,
    //                 'remark' => $remark,
    //                 'status_id' => $inquiry_status_id,
    //                 'nxt_follow_up' => $nxtfollowdate
    //             );
    //             $response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_followup');
    //             if ($response_status_log) {
    //                 $update_data = array(
    //                     'inquiry_status' => $inquiry_status_id,
    //                     'nxt_follow_up' => $nxtfollowdate,
    //                     'feedback' => $feedback
    //                 );
    //                 $update_data['inquiry_cnr'] = 0;
    //                 $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id, $update_data, 'admin_all_inquiry');
    //                 $status_name = status_id_to_full_status_data($inquiry_status_id, true);
    //                 $inquiry_log = array(
    //                     'inquiry_id' => $inquiry_id,
    //                     'status_id' => $inquiry_status_id,
    //                     // 'inquiry_status' => $status_name,
    //                     'user_id' => $user_id,
    //                     // 'remark' => $remark,
    //                     // 'nxtfollowdate' => $nxtfollowdate,
    //                     'inquiry_log' => 'Inquiry ' . $inquiry_tag . ' By ' . $userfullname . '<br> ' . $feedback
    //                 );
    //                 $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
    //                 // $inquiry_status_log = array(
    //                 //     'inquiry_id' => $inquiry_id,
    //                 //     'user_id' => $user_id, 
    //                 //     'inquiry_status_id' => $inquiry_status_id,
    //                 //     'inquiry_status' => $inquiry_tag 
    //                 // );
    //                 // $response_status_log = $this->MasterInformationModel->insert_entry($inquiry_status_log,'inquiry_status_log');
    //                 // $response = 1;
    //                 $result['result'] = 1;
    //                 $result['msg'] = 'Inquiry Status Feedback changed Successfully';
    //             } else {
    //                 $result['result'] = 0;
    //                 $result['msg'] = 'Inquiry Feedback Status not changed';
    //             }
    //         } else {
    //             $result['result'] = 0;
    //             $result['msg'] = 'Inquiry Not Follow Status Flow';
    //         }
    //     } else if (isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '3') {
    //         // Appointment inquiry
    //         // $check_appointment = array();
    //         // $before_status_log = array();
    //         // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all2($this->username . '_inquiry_log', $inquiry_id, 'inquiry_id');
    //         // if (isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)) {
    //         //     foreach ($inquiry_logEditdata as $val => $value) {
    //         //         $value = get_object_vars($value);
    //         //         $before_status_log[$value['inquiry_status_id']] = $value;
    //         //     }
    //         // }
    //         // $inquiryEditdata = $this->MasterInformationModel->edit_entry_all2($this->username . '_inquiry_log', $inquiry_id, 'inquiry_id');
    //         // if (isset($inquiryEditdata) && !empty($inquiryEditdata)) {
    //         //     foreach ($inquiryEditdata as $val => $value) {
    //         //         $value = get_object_vars($value);
    //         //         $check_appointment[$value['inquiry_status_id']] = $value;
    //         //     }
    //         // }
    //         $appointment_access = $inquiry_data['isSiteVisit'];
    //         // if ($appointment_access == 1 || $appointment_access == 2) {
    //         //     $appointment_access = 1;
    //         //     if (isset($check_appointment['4']) && is_array($check_appointment['4'])) {
    //         //         $appointment_access = 1;
    //         //     } else if (isset($check_appointment['6']) && is_array($check_appointment['6'])) {
    //         //         $appointment_access = 0;
    //         //     } else if (isset($check_appointment['9']) && is_array($check_appointment['9'])) {
    //         //         $appointment_access = 1;
    //         //     } else if (isset($check_appointment['10']) && is_array($check_appointment['10'])) {
    //         //         $appointment_access = 0;
    //         //     } else if (isset($check_appointment['11']) && is_array($check_appointment['11'])) {
    //         //         $appointment_access = 0;
    //         //     } else if (isset($check_appointment['12']) && is_array($check_appointment['12'])) {
    //         //         $appointment_access = 0;
    //         //     } else if (isset($check_appointment['2']) && is_array($check_appointment['2'])) {
    //         //         $appointment_access = 1;
    //         //     } else if (isset($check_appointment['1']) && is_array($check_appointment['1'])) {
    //         //         $appointment_access = 1;
    //         //     }
    //         //     if ($appointment_access == 1 || $appointment_access == 2) {
    //         $inquiry_tag = $_POST['tag_btn_click'];
    //         $inquiry_status_id = $_POST['status_btn_click'];
    //         // if ($inquiry_data['isSiteVisit'] == 4) {
    //         //     $inquiry_tag = 'Re Appointment';
    //         //     $inquiry_status_id = 10;
    //         // }
    //         if ($inquiry_data['isSiteVisit'] == 1 || $inquiry_data['isSiteVisit'] == 2) {
    //             $inquiry_tag = 'Re Appointment';
    //             $inquiry_status_id = 10;
    //         }
    //         // if (isset($before_status_log['9']) && is_array($check_appointment['9'])) {
    //         //     $inquiry_tag = 'Re Appointment';
    //         //     $inquiry_status_id = 10;
    //         // }
    //         // if (isset($before_status_log['11']) && is_array($check_appointment['11'])) {
    //         //     $inquiry_tag = 'Re Appointment';
    //         //     $inquiry_status_id = 10;
    //         // }
    //         // if (isset($nxtfollowdate) && !empty($nxtfollowdate)) {
    //         //     // $nxtfollowdate =  loacal_date_to_formate_date($_POST['appo_date']);
    //         //     $appointment_date =  $_POST['appoint_date'];
    //         // } else {
    //         //     $appointment_date = '';
    //         // }
    //         if (isset($_POST['appoint_date']) && !empty($_POST['appoint_date'])) {
    //             // $nxtfollowdate =  loacal_date_to_formate_date($_POST['nxtfollowdate']);
    //             $appointment_date = date('Y-m-d h:i:sa', strtotime($_POST['appoint_date']));
    //         } else {
    //             $appointment_date = '';
    //         }
    //         $status_array = array(
    //             'user_id' => $user_id,
    //             'inquiry_id' => $inquiry_id,
    //             'remark' => $remark,
    //             'status_id' => $inquiry_status_id,
    //             'nxt_follow_up' => $nxtfollowdate
    //         );
    //         $response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_followup');
    //         $intrested_product = $_POST['intrested_product'];
    //         if ($response_status_log) {
    //             $update_data = array(
    //                 'appointment_date' => $appointment_date,
    //                 'nxt_follow_up' => $nxtfollowdate,
    //                 'intrested_product' => $intrested_product,
    //             );
    //             $update_data['inquiry_status'] = $inquiry_status_id;
    //             // if(isset($_POST['int_subscription']) && !empty($_POST['int_subscription']))
    //             // {
    //             //     $update_data['int_subscription'] = $_POST['int_subscription'];
    //             //     // $project_data = project_id_to_full_project_data($_POST['int_subscription']);
    //             //     // $project_sub_type_id = "";
    //             // if (isset($project_data['project_sub_type']) && !empty($project_data['project_sub_type'])) {
    //             //     $project_sub_type = IdToFieldGetData('', "project_sub_type='" . $project_data['project_sub_type'] . "'", "project_management_subtype");
    //             //     $project_sub_type_id = isset($project_sub_type['id']) && !empty($project_sub_type['id']) ? $project_sub_type['id'] : '';
    //             // }
    //             // //pre($project_sub_type_id );
    //             //     if(isset($project_data) && !empty($project_data))
    //             //     {
    //             //         $update_data['property_type'] = $project_data['project_type'];
    //             //         $update_data['property_sub_type'] = $project_sub_type_id;
    //             //         $update_data['intrested_area_name'] = $project_data['project_location_id'];
    //             //     }
    //             // }
    //             $update_data['inquiry_cnr'] = 0;
    //             $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id, $update_data, 'admin_all_inquiry');
    //             $status_name = status_id_to_full_status_data($inquiry_status_id, true);
    //             $inquiry_log = array(
    //                 'inquiry_id' => $inquiry_id,
    //                 'status_id' => $inquiry_status_id,
    //                 // 'inquiry_status' => $status_name,
    //                 'user_id' => $user_id,
    //                 // 'remark' => $remark,
    //                 // 'nxtfollowdate' => $nxtfollowdate,
    //                 'inquiry_log' => 'Inquiry ' . $inquiry_tag . ' By ' . $userfullname
    //             );
    //             $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
    //             // $inquiry_status_log = array(
    //             //     'inquiry_id' => $inquiry_id,
    //             //     'user_id' => $user_id,
    //             //     'inquiry_status_id' => $inquiry_status_id,
    //             //     'inquiry_status' => $inquiry_tag
    //             // );
    //             // $response_status_log = $this->MasterInformationModel->insert_entry($inquiry_status_log,'inquiry_status_log');
    //             // $response = 1;
    //             $result['result'] = 1;
    //             $result['msg'] = 'Inquiry Appointment Successfully';
    //         } else {
    //             $result['result'] = 0;
    //             $result['msg'] = 'Inquiry Appointment Status not changed';
    //         }
    //         // } else {
    //         //     $result['result'] = 0;
    //         //     $result['msg'] = 'Inquiry Not Follow Status Flow';
    //         // }
    //     } else if (isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '17') {
    //         // cnr inquiry
    //         // $check_appointment = array();
    //         // $before_status_log = array();
    //         // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all('inquiry_status_log' ,$inquiry_id, 'inquiry_id');
    //         // if(isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)){
    //         //     foreach($inquiry_logEditdata as $val => $value){
    //         //         $value = get_object_vars($value);
    //         //         $before_status_log[$value['inquiry_status_id']] = $value;
    //         //     }
    //         // }
    //         // $inquiryEditdata = $this->MasterInformationModel->edit_entry_all('inquiry_status_log' ,$inquiry_id, 'inquiry_id');
    //         // if(isset($inquiryEditdata) && !empty($inquiryEditdata)){
    //         //     foreach($inquiryEditdata as $val => $value){
    //         //         $value = get_object_vars($value);
    //         //         $check_appointment[$value['inquiry_status_id']] = $value;
    //         //     }
    //         // }
    //         // $appointment_access = 1;
    //         // if(isset($check_appointment['4']) && is_array($check_appointment['4'])){
    //         //     $appointment_access = 1;
    //         // }else if(isset($check_appointment['6']) && is_array($check_appointment['6'])){
    //         //     $appointment_access = 1;    
    //         // }else if(isset($check_appointment['9']) && is_array($check_appointment['9'])){
    //         //     $appointment_access = 1;    
    //         // }else if(isset($check_appointment['10']) && is_array($check_appointment['10'])){
    //         //     $appointment_access = 1;    
    //         // }else if(isset($check_appointment['11']) && is_array($check_appointment['11'])){
    //         //     $appointment_access = 1;    
    //         // }else if(isset($check_appointment['12']) && is_array($check_appointment['12'])){
    //         //     $appointment_access = 1;
    //         // }else if(isset($check_appointment['2']) && is_array($check_appointment['2'])){
    //         //     $appointment_access = 1;
    //         // }else if(isset($check_appointment['1']) && is_array($check_appointment['1'])){
    //         //     $appointment_access = 1;
    //         // }
    //         //if($cnr_access == 1){
    //         $inquiry_tag = 'CNR';
    //         $inquiry_status_id = $_POST['status_btn_click'];
    //         $status_array = array(
    //             'user_id' => $user_id,
    //             'inquiry_id' => $inquiry_id,
    //             'remark' => 'Inquiry ' . $inquiry_tag,
    //             'status_id' => $inquiry_status_id,
    //             'nxt_follow_up' => $nxtfollowdate
    //         );
    //         $response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_followup');
    //         if ($response_status_log) {
    //             $update_data['inquiry_cnr'] = 1;
    //             // $update_data['inquiry_status'] = 17;
    //             $inquiry_tag = 'Call not received';
    //             $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id, $update_data, 'admin_all_inquiry');
    //             $status_name = 'CNR';
    //             $inquiry_log = array(
    //                 'inquiry_id' => $inquiry_id,
    //                 'status_id' => 17,
    //                 // 'inquiry_status' => 'CNR',
    //                 'user_id' => $user_id,
    //                 //'remark' => $remark,
    //                 // 'nxtfollowdate' => $nxtfollowdate,
    //                 'inquiry_log' => 'Inquiry ' . $inquiry_tag . ' By ' . $userfullname
    //             );
    //             $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
    //             $result['result'] = 1;
    //             $result['msg'] = 'Inquiry CNR Successfully';
    //         } else {
    //             $result['result'] = 0;
    //             $result['msg'] = 'Inquiry CNR not changed';
    //         }
    //         // }
    //         // else
    //         // {
    //         //     $result['result'] = 0;
    //         //     $result['msg'] = 'Inquiry Not Follow Status Flow';
    //         // }
    //     } else if (@$remark &&  @$inquiry_id && @$nxtfollowdate) {
    //         $check_appointment = array();
    //         $check_appointment12 = array();
    //         $status_array = array(
    //             'user_id' => $user_id,
    //             'inquiry_id' => $inquiry_id,
    //             'remark' => $remark,
    //             'nxt_follow_up' => $nxtfollowdate
    //         );
    //         if (isset($inquiry_data['inquiry_status']) && !empty($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] > 3) {
    //             $status_array['status_id'] = '13';
    //         } else {
    //             if (isset($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] == 2) {
    //                 $status_array['status_id'] = '13';
    //             } else {
    //                 $status_array['status_id'] = '2';
    //             }
    //         }
    //         $response_status_log = $this->MasterInformationModel->insert_entry2($status_array, $this->username . '_followup');
    //         if ($response_status_log) {
    //             $update_data = array(
    //                 'inquiry_status' => 2,
    //                 'nxt_follow_up' => $nxtfollowdate
    //             );
    //             $inquiry_log = array(
    //                 'inquiry_id' => $inquiry_id,
    //                 'user_id' => $user_id
    //             );
    //             $inquiry_status_log = array(
    //                 'inquiry_id' => $inquiry_id,
    //                 // 'user_id' => $user_id,
    //             );
    //             if (isset($inquiry_data['inquiry_status']) && !empty($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] > 3) {
    //                 $inquiry_log['status_id'] = '13';
    //                 $inquiry_log['inquiry_log'] = 'Inquiry Followup By ' . $userfullname;
    //             } else {
    //                 if (isset($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] == 2) {
    //                     $inquiry_log['status_id'] = '13';
    //                     $inquiry_log['inquiry_log'] = 'Inquiry Followup By ' . $userfullname;
    //                 } else {
    //                     $inquiry_log['status_id'] = '2';
    //                     $inquiry_log['inquiry_log'] = 'Inquiry Contacted By ' . $userfullname;
    //                 }
    //             }
    //             $update_data['inquiry_cnr'] = 0;
    //             $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id, $update_data, 'admin_all_inquiry');
    //             $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
    //             //$response_status_log = $this->MasterInformationModel->insert_entry($inquiry_status_log,'inquiry_status_log');
    //             $result['result'] = 1;
    //             $result['msg'] = 'Inquiry Status Updated Successfully';
    //             // } else {
    //             //     $result['result'] = 0;
    //             //     $result['msg'] = 'Inquiry Status Updated Failed';
    //             // }
    //         }
    //     }
    //     echo json_encode($result);
    //     die();
    // }
    public function inquiry_update_status()
    {
        date_default_timezone_set('Asia/Kolkata');
        $remark = '';
        if(isset( $_POST['remark']) && !empty($_POST['remark'])){
            $remark = $_POST['remark'];
        }
        // pre($_POST);
        $inquiry_id =  $_POST['inquiry_id'];
        $update_data = array();
        $status_array_log = array();
        $user_id = '';
        $response = 0;
        $result = array(
            'result' => 0,
            'msg' => 'Inquiry Status Not Updated!'
        );
       // date_default_timezone_set('Asia/Kolkata');
        $session_data = get_session_data();
        if(isset($_SESSION['admin']) && $_SESSION['admin'] ==1){
             $user_id =0;
        } else{
            $user_id = $_SESSION['id'];
        }
        if(isset($session_data) && !empty($session_data['id']))
        {
            if(isset($session_data['admin']) && $session_data['admin'] == 1){
                $userfullname = $session_data['name'];
            }else{
                $userfullname = $session_data['firstname'];
            }
        }
        if(isset($_POST['nxt_follow_up']) && !empty($_POST['nxt_follow_up'])){
             //$nxtfollowdate =  loacal_date_to_formate_date($_POST['nxtfollowdate']);
            $nxtfollowdate = date('Y-m-d H:i:sa', strtotime($_POST['nxt_follow_up']));
        }else{
            $nxtfollowdate = date('Y-m-d H:i:sa');
        }
        $inquiry_data = inquiry_id_to_full_inquiry_data($_POST['inquiry_id']);
        // pre($_POST['status_btn_click']);
        // die();
        if(isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '8')
        {
            // Dismissed inquiry (close)
            $master_inquiry_close_reason = get_table_array_helper('admin_master_inquiry_close');
            $inquiry_status_id = $_POST['status_btn_click'];
            $inquiry_tag = $_POST['tag_btn_click'];
            $close_reason = '';
            $close_remarks = '';
            if(isset($_POST['inquiry_close_reason'])){
                $close_reason_id = $_POST['inquiry_close_reason'];
                if(isset($master_inquiry_close_reason[$close_reason_id])){
                    $close_reason = $master_inquiry_close_reason[$close_reason_id]['inquiry_close_reason'];
                }
                // pre($close_reason_id);
                // die();
                if($_POST['inquiry_close_reason'] == 11){
                    if(isset($inquiry_data) && !empty($inquiry_data))
                    {
                        // convert people to broker
                        $update_data = array(
                            'user_type' => '2',
                        );
                        $broker_fullname = $inquiry_data['full_name'] ;
                        $broker_data = array(
                            'assign_id' => $user_id ,
                            'user_id' => $user_id ,
                            'mobileno' => isset($inquiry_data['mobileno']) && !empty($inquiry_data['mobileno']) ? $inquiry_data['mobileno'] : '',
                            'brokername' => $broker_fullname,
                        );
                        // $response = $this->MasterInformationModel->insert_entry2($broker_data,$this->username.'_broker');
                        // $convert_people_to_broker = $this->MasterInformationModel->update_entry2($_POST['inquiry_id'],$update_data,$this->username.'_all_inquiry');
                    }
                }
            }
            $username = session_username($_SESSION['username']);
            $db_connection = DatabaseDefaultConnection();
            $user_child = array();
            $user_parent = array();
            $sitewisechild = "SELECT t1.id AS child_id, t1.parent_id AS parent_id FROM " . $username . "_userrole t1 LEFT JOIN " . $username . "_userrole t2 ON t1.id = t2.parent_id WHERE t2.parent_id IS NULL";
            $cntdata = $db_connection->query($sitewisechild);
            $cntdatas = $cntdata->getResultArray();
            foreach ($cntdatas as $k => $v) {
                if (!empty($v['child_id'])) {
                    $user_child[] = $v['child_id'];
                    $user_parent[] = $v['parent_id'];
                }
            }
            $user_e_id = implode(',', $user_child);
            $sql = "SELECT id FROM ".$username."_user WHERE (role IN (".$user_e_id.")) ";
            $e_user_data = $db_connection->query($sql);
            $e_user_data = $e_user_data->getResultArray();
            $e_id = array();
            foreach($e_user_data as $e_key => $e_value){
                $e_id[] = $e_value['id'];
            }
            if(isset($_SESSION['id']) && in_array($_SESSION['id'], $e_id)){
                $close_remarks = $remark;
                $status_array = array(
                    'user_id' => $user_id,
                    'inquiry_id' => $inquiry_id,
                    'remark' => $remark,
                    'status_id' => $inquiry_status_id,
                    'created_at' => date('y-m-d H:i:s'),
                );
                $response_status_log = $this->MasterInformationModel->insert_entry2($status_array,$this->username.'_followup');
                if($response_status_log)
                {
                    $update_data = array(
                        'inquiry_status' => $inquiry_status_id,
                        'head_status' => '0',
                        'remark' => $remark,
                        'inquiry_close_reason' => $close_reason_id,
                        // 'nxt_follow_up' => $nxtfollowdate
                    );
                    $update_data['inquiry_cnr'] = 0;
                    $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id,$update_data,$this->username.'_all_inquiry');
                    $status_name = status_id_to_full_status_data($inquiry_status_id , true);
                    $inquiry_log = array(
                        'inquiry_id' => $inquiry_id,
                        'status_id' => $inquiry_status_id,
                        'user_id' => $user_id,
                        'inquiry_log' => 'Inquiry '.$inquiry_tag.' By '.$userfullname .'<br> Inquiry Close Reason : '.$close_reason.' <br> Inquiry Close Remarks : '.$close_remarks
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log,$this->username.'_inquiry_log');
                    $result['result'] = 1;
                    $result['msg'] = 'Inquiry Status Dismissed Request Successfully';
                   //increment audience table insert productwise inquiry_data=2 in 
                    $inquiry_dataa = array();
                    $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
                    $intrested_product = $inquiry_data['intrested_product'];
					$find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 8 AND intrested_product = $intrested_product";
					$db_connection = DatabaseDefaultConnection();
					$find_audience = $db_connection->query($find_audience);
					$all_data = $find_audience->getResultArray();

					if (!empty($all_data)&& isset($all_data[0]['intrested_product']) && $all_data[0]['intrested_product'] == $intrested_product && isset($all_data[0]['inquiry_data']) && $all_data[0]['inquiry_data'] == 2) {
						if ($result['result'] == 1) {
							$inquiry_dataa['inquiry_id'] = $inquiry_id;
							$inquiry_dataa['full_name'] = $inquiry_data['full_name'];
							$inquiry_dataa['mobileno'] = $inquiry_data['mobileno'];
							$inquiry_dataa['email'] = $inquiry_data['email'];
							$inquiry_dataa['inquiry_status'] = 8;
							$inquiry_dataa['intrested_product'] = $inquiry_data['intrested_product'];
							$inquiry_dataa['name'] = $all_data[0]['name'];
							$inquiry_dataa['source'] = $all_data[0]['source'];
							$inquiry_dataa['inquiry_data'] = 2;
                            $inquiry_dataa['pages_name'] = $all_data[0]['pages_name'];
                            $inquiry_dataa['facebook_syncro'] = 0;
							$response_alert = $this->MasterInformationModel->insert_entry2($inquiry_dataa, $this->username . "_audience");
						}
					}
                    // live audience auto increment code inquiry_data=3 in
                    $inquiry_data_live = array();
                    $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 8 AND intrested_product = $intrested_product";
                    $find_audience_live = $db_connection->query($find_audience_live);
                    $all_data_live = $find_audience_live->getResultArray();
    
                    if (!empty($all_data_live) && isset($all_data_live[0]['intrested_product']) && $all_data_live[0]['intrested_product'] == $intrested_product && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                        if ($result['result'] == 1) {
                        $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                        // pre($inquiry_id);

                        if (!empty($existing_entry)) {
                            $inquiry_data_live['inquiry_data'] = 3;
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                        } 
                            // Insert new entry into the audience table
                            $inquiry_data_live['inquiry_id'] = $inquiry_id;
                            $inquiry_data_live['full_name'] = $inquiry_data['full_name'];
                            $inquiry_data_live['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_data_live['email'] = $inquiry_data['email'];
                            $inquiry_data_live['inquiry_status'] = 8;
                            $inquiry_data_live['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_data_live['name'] = $all_data_live[0]['name'];
                            $inquiry_data_live['source'] = $all_data_live[0]['source'];
                            $inquiry_data_live['inquiry_data'] = 2;
                            $inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
                            
                    }
            } 
                }else{
                    $result['result'] = 0;
                    $result['msg'] = 'Inquiry Dismissed Status Not Updated';
                }
            }else{
                $inquiry_status_id = 7;
                $close_remarks = $remark;
                $status_array = array(
                    'user_id' => $user_id,
                    'inquiry_id' => $inquiry_id,
                    'remark' => $remark,
                    'status_id' => $inquiry_status_id,
                );
                $response_status_log = $this->MasterInformationModel->insert_entry2($status_array,$this->username.'_followup');
                if($response_status_log)
                {
                    $update_data = array(
                        'inquiry_status' => $inquiry_status_id,
                        'head_status' => '0',
                        'remark' => $remark,
                        'inquiry_close_reason' => $close_reason_id,
                        // 'nxt_follow_up' => $nxtfollowdate
                    );
                    $update_data['inquiry_cnr'] = 0;
                    $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id,$update_data,$this->username.'_all_inquiry');
                    $status_name = status_id_to_full_status_data($inquiry_status_id , true);
                    $inquiry_log = array(
                        'inquiry_id' => $inquiry_id,
                        'status_id' => $inquiry_status_id,
                        'user_id' => $user_id,
                        'inquiry_log' => 'Inquiry '.$inquiry_tag.' By '.$userfullname .'<br> Inquiry Close Reason : '.$close_reason.' <br> Inquiry Close Remarks : '.$close_remarks
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log,$this->username.'_inquiry_log');
                    $result['result'] = 1;
                    $result['msg'] = 'Inquiry Status Dismissed Successfully';

                    //increment audience table insert productwise inquiry_data=2 in 
                   
                    $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
                    $intrested_product = $inquiry_data['intrested_product'];
                    $audience_data = array();
                    $find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 7 AND intrested_product = $intrested_product";
                    $db_connection = DatabaseDefaultConnection();
                    $find_audience = $db_connection->query($find_audience);
                    $all_data_audience = $find_audience->getResultArray();
                    
                    if (!empty($all_data_audience) && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
                        if ($result['result'] == 1) {
                            $audience_data['inquiry_id'] = $inquiry_id;
                            $audience_data['full_name'] = $inquiry_data['full_name'];
                            $audience_data['mobileno'] = $inquiry_data['mobileno'];
                            $audience_data['email'] = $inquiry_data['email'];
                            $audience_data['inquiry_status'] = 7;
                            $audience_data['intrested_product'] = $intrested_product;
                            $audience_data['name'] = $all_data_audience[0]['name'];
                            $audience_data['source'] = $all_data_audience[0]['source'];
                            $audience_data['inquiry_data'] = 2;
                            $audience_data['pages_name'] = $all_data_audience[0]['pages_name'];
                            $audience_data['facebook_syncro'] = 0;
                            $response_audience = $this->MasterInformationModel->insert_entry2($audience_data, $this->username . "_audience");
                        }
                    }
                    // live audience auto increment code inquiry_data=3 in
                        $inquiry_data_live = array();
                        $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 7 AND intrested_product = $intrested_product";
                        $find_audience_live = $db_connection->query($find_audience_live);
                        $all_data_live = $find_audience_live->getResultArray();
                
                    if (!empty($all_data_live) && isset($all_data_live[0]['intrested_product']) && $all_data_live[0]['intrested_product'] == $intrested_product && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                        if ($result['result'] == 1) {
                        $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                        // pre($inquiry_id);

                        if (!empty($existing_entry)) {
                            $inquiry_data_live['inquiry_data'] = 3;
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                        } 
                            // Insert new entry into the audience table
                            $inquiry_data_live['inquiry_id'] = $inquiry_id;
                            $inquiry_data_live['full_name'] = $inquiry_data['full_name'];
                            $inquiry_data_live['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_data_live['email'] = $inquiry_data['email'];
                            $inquiry_data_live['inquiry_status'] = 7;
                            $inquiry_data_live['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_data_live['name'] = $all_data_live[0]['name'];
                            $inquiry_data_live['source'] = $all_data_live[0]['source'];
                            $inquiry_data_live['inquiry_data'] = 2;
                            $inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
                            
                      
                    }
                } 
                }else{
                    $result['result'] = 0;
                    $result['msg'] = 'Inquiry Status Not Dismissed';
                }
            }
        }
        else if(isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '6')
        {
            // Negotiation inquiry
            // $before_status_log = array();
            // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all($this->username.'_followup' ,$inquiry_id, 'inquiry_id');
            // if(isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)){
            //     foreach($inquiry_logEditdata as $val => $value){
            //         $value = get_object_vars($value);
            //         $before_status_log[$value['status_id']] = $value;
            //     }
            // }
            // $negotiation_access = 0;
            // if(isset($before_status_log['4'])){
            //     $negotiation_access = 1 ;
            // }
            // if(isset($before_status_log['11'])){
            //     $negotiation_access = 1 ;
            // }
            // if(isset($before_status_log['9'])){
            //     $negotiation_access = 1 ;
            // }
            $negotiation_access = $inquiry_data['isSiteVisit'];
            if($negotiation_access == 1 || $negotiation_access == 2)
            {
                $inquiry_status_id = $_POST['status_btn_click'];
                $inquiry_tag = $_POST['tag_btn_click'];
                $status_array = array(
                    'user_id' => $user_id,
                    'inquiry_id' => $inquiry_id,
                    'remark' => $remark,
                    'status_id' => $inquiry_status_id,
                    'nxt_follow_up' => $nxtfollowdate
                );
                $response_status_log = $this->MasterInformationModel->insert_entry2($status_array,$this->username.'_followup');
                if($response_status_log)
                {
                    $update_data = array(
                        'inquiry_status' => $inquiry_status_id,
                        'head_status' => '1',
                        'nxt_follow_up' => $nxtfollowdate
                    );
                    $update_data['inquiry_cnr'] = 0;
                    $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id,$update_data,$this->username.'_all_inquiry');
                    $status_name = status_id_to_full_status_data($inquiry_status_id ,true);
                    $inquiry_log = array(
                        'inquiry_id' => $inquiry_id,
                        'status_id' => $inquiry_status_id,
                        // 'inquiry_status' => $status_name,
                        'user_id' => $user_id,
                        // 'remark' => $remark,
                        // 'nxtfollowdate' => $nxtfollowdate,
                        'inquiry_log' => 'Inquiry '.$inquiry_tag.' By '.$userfullname
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log,$this->username.'_inquiry_log');
                    // $inquiry_status_log = array(
                    //     'inquiry_id' => $inquiry_id,
                    //     'user_id' => $user_id, 
                    //     'inquiry_status_id' => $inquiry_status_id,
                    //     'inquiry_status' => $inquiry_tag
                    // );
                    // $response_status_log = $this->MasterInformationModel->insert_entry($inquiry_status_log,'inquiry_status_log');
                    // $response = 1;
                    $result['result'] = 1;
                    $result['msg'] = 'Inquiry Status Negotiation changed Successfully';

                    //increment audience table insert productwise inquiry_data=2 in 
                    $inquiry_data_audience = array();
                    $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
                    $intrested_product = $inquiry_data['intrested_product'];
					$find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 6 AND intrested_product = $intrested_product";
					$db_connection = DatabaseDefaultConnection();
					$find_audience = $db_connection->query($find_audience);
					$all_data_audience = $find_audience->getResultArray();

					if (!empty($all_data_audience)&& isset($all_data_audience[0]['intrested_product']) && $all_data_audience[0]['intrested_product'] == $intrested_product && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
						if ($result['result'] == 1) {
							$inquiry_data_audience['inquiry_id'] = $inquiry_id;
							$inquiry_data_audience['full_name'] = $inquiry_data['full_name'];
							$inquiry_data_audience['mobileno'] = $inquiry_data['mobileno'];
							$inquiry_data_audience['email'] = $inquiry_data['email'];
							$inquiry_data_audience['inquiry_status'] = 6;
							$inquiry_data_audience['intrested_product'] = $inquiry_data['intrested_product'];
							$inquiry_data_audience['name'] = $all_data_audience[0]['name'];
							$inquiry_data_audience['source'] = $all_data_audience[0]['source'];
							$inquiry_data_audience['inquiry_data'] = 2;
                            $inquiry_data_audience['pages_name'] = $all_data_audience[0]['pages_name'];
                            $inquiry_data_audience['facebook_syncro'] = 0;
							$response_audience = $this->MasterInformationModel->insert_entry2($inquiry_data_audience, $this->username . "_audience");
						}
					}
                     //live audience auto increment code inquiry_data=3 in
                    $inquiry_data_live = array();
                    $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 6 AND intrested_product = $intrested_product";
                    $find_audience_live = $db_connection->query($find_audience_live);
                    $all_data_live = $find_audience_live->getResultArray();
            
            
                    if (!empty($all_data_live) && isset($all_data_live[0]['intrested_product']) && $all_data_live[0]['intrested_product'] == $intrested_product && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                        if ($result['result'] == 1) {
                        $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                        // pre($inquiry_id);

                        if (!empty($existing_entry)) {
                            $inquiry_data_live['inquiry_data'] = 3;
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                        } 
                                // pre('mital');
                            // Insert new entry into the audience table
                            $inquiry_data_live['inquiry_id'] = $inquiry_id;
                            $inquiry_data_live['full_name'] = $inquiry_data['full_name'];
                            $inquiry_data_live['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_data_live['email'] = $inquiry_data['email'];
                            $inquiry_data_live['inquiry_status'] = 6;
                            $inquiry_data_live['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_data_live['name'] = $all_data_live[0]['name'];
                            $inquiry_data_live['source'] = $all_data_live[0]['source'];
                            $inquiry_data_live['inquiry_data'] = 2;
                            $inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
                            
                        
                    }
            } 
                }else{
                    $result['result'] = 0;
                    $result['msg'] = 'Inquiry Negotiation Status not changed';
                }
            }else{
                $result['result'] = 0;
                $result['msg'] = 'Inquiry Not Follow Status Flow';
            }
        }
        else if(isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '9')
        {
            // Feedback inquiry
            // $before_status_log = array();
            // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all('inquiry_status_log' ,$inquiry_id, 'inquiry_id');
            // if(isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)){
            //     foreach($inquiry_logEditdata as $val => $value){
            //         $value = get_object_vars($value);
            //         $before_status_log[$value['inquiry_status_id']] = $value;
            //     }
            // }
            // $feedback_access = 0;
            // if(isset($before_status_log['4'])){
            //     $feedback_access = 1 ;
            // }
            // if(isset($before_status_log['11']) ){
            //     $feedback_access = 1 ;
            // }
            $feedback_access = $inquiry_data['isSiteVisit'];
            if($feedback_access == 1 || $feedback_access == 2){
                $inquiry_status_id = $_POST['status_btn_click'];
                 $inquiry_tag = $_POST['tag_btn_click'];
                // $feedback = (isset($_POST['feedback_remark'])) ? $_POST['feedback_remark'] : "";
                $feedback = $remark;
                $status_array = array(
                    'user_id' => $user_id,
                    'inquiry_id' => $inquiry_id,
                    'remark' => $remark,
                    'status_id' => $inquiry_status_id,
                    'nxt_follow_up' => $nxtfollowdate
                );
                $response_status_log = $this->MasterInformationModel->insert_entry2($status_array,$this->username.'_followup');
                if($response_status_log)
                {
                    $update_data = array(
                        'inquiry_status' => $inquiry_status_id,
                        'nxt_follow_up' => $nxtfollowdate,
                        'feedback' => $feedback
                    );
                    $update_data['inquiry_cnr'] = 0;
                    $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id,$update_data,$this->username.'_all_inquiry');
                    $status_name = status_id_to_full_status_data($inquiry_status_id , true);
                    $inquiry_log = array(
                        'inquiry_id' => $inquiry_id,
                        'status_id' => $inquiry_status_id,
                        // 'inquiry_status' => $status_name,
                        'user_id' => $user_id,
                        // 'remark' => $remark,
                        // 'nxtfollowdate' => $nxtfollowdate,
                        'inquiry_log' => 'Inquiry '.$inquiry_tag.' By '.$userfullname . '<br> '.$feedback
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log,$this->username.'_inquiry_log');
                    // $inquiry_status_log = array(
                    //     'inquiry_id' => $inquiry_id,
                    //     'user_id' => $user_id, 
                    //     'inquiry_status_id' => $inquiry_status_id,
                    //     'inquiry_status' => $inquiry_tag 
                    // );
                    // $response_status_log = $this->MasterInformationModel->insert_entry($inquiry_status_log,'inquiry_status_log');
                    // $response = 1;
                    $result['result'] = 1;
                    $result['msg'] = 'Inquiry Status Feedback changed Successfully';
                   //increment audience table insert productwise inquiry_data=2 in 
                    $inquiry_data_audience = array();
                    $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
                    $intrested_product = $inquiry_data['intrested_product'];
					$find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 9 AND intrested_product = $intrested_product";
					$db_connection = DatabaseDefaultConnection();
					$find_audience = $db_connection->query($find_audience);
					$all_data_audience = $find_audience->getResultArray();

					if (!empty($all_data_audience)&& isset($all_data_audience[0]['intrested_product']) && $all_data_audience[0]['intrested_product'] == $intrested_product && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
						if ($result['result'] == 1) {
							$inquiry_data_audience['inquiry_id'] = $inquiry_id;
							$inquiry_data_audience['full_name'] = $inquiry_data['full_name'];
							$inquiry_data_audience['mobileno'] = $inquiry_data['mobileno'];
							$inquiry_data_audience['email'] = $inquiry_data['email'];
							$inquiry_data_audience['inquiry_status'] = 9;
							$inquiry_data_audience['intrested_product'] = $inquiry_data['intrested_product'];
							$inquiry_data_audience['name'] = $all_data_audience[0]['name'];
							$inquiry_data_audience['source'] = $all_data_audience[0]['source'];
							$inquiry_data_audience['inquiry_data'] = 2;
                            $inquiry_data_audience['pages_name'] = $all_data_audience[0]['pages_name'];
                            $inquiry_data_audience['facebook_syncro'] = 0;
							$response_audience = $this->MasterInformationModel->insert_entry2($inquiry_data_audience, $this->username . "_audience");
						}
					}
                //live audience auto increment code inquiry_data=3 in
                    $inquiry_data_live = array();
                    $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 9 AND intrested_product = $intrested_product";
                    $find_audience_live = $db_connection->query($find_audience_live);
                    $all_data_live = $find_audience_live->getResultArray();
            
                        if (!empty($all_data_live) && isset($all_data_live[0]['intrested_product']) && $all_data_live[0]['intrested_product'] == $intrested_product && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                            if ($result['result'] == 1) {
                            
                            $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                            // pre($inquiry_id);

                            if (!empty($existing_entry)) {
                                $inquiry_data_live['inquiry_data'] = 3;
                                $inquiry_data_live['facebook_syncro'] = 0;
                                $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                            } 
                                    // pre('mital');
                                // Insert new entry into the audience table
                                $inquiry_data_live['inquiry_id'] = $inquiry_id;
                                $inquiry_data_live['full_name'] = $inquiry_data['full_name'];
                                $inquiry_data_live['mobileno'] = $inquiry_data['mobileno'];
                                $inquiry_data_live['email'] = $inquiry_data['email'];
                                $inquiry_data_live['inquiry_status'] = 9;
                                $inquiry_data_live['intrested_product'] = $inquiry_data['intrested_product'];
                                $inquiry_data_live['name'] = $all_data_live[0]['name'];
                                $inquiry_data_live['source'] = $all_data_live[0]['source'];
                                $inquiry_data_live['inquiry_data'] = 2;
                                $inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
                                $inquiry_data_live['facebook_syncro'] = 0;
                                $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
                                
                            
                        }
                    } 
                }else{
                    $result['result'] = 0;
                    $result['msg'] = 'Inquiry Feedback Status not changed';
                }
            }
            else
            {
                $result['result'] = 0;
                $result['msg'] = 'Inquiry Not Follow Status Flow';
            }
        }
        else if(isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '3')
        {
            // Appointment inquiry
            // $check_appointment = array();
            // $before_status_log = array();
            // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all('inquiry_status_log' ,$inquiry_id, 'inquiry_id');
            // if(isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)){
            //     foreach($inquiry_logEditdata as $val => $value){
            //         $value = get_object_vars($value);
            //         $before_status_log[$value['inquiry_status_id']] = $value;
            //     }
            // }
            // $inquiryEditdata = $this->MasterInformationModel->edit_entry_all('inquiry_status_log' ,$inquiry_id, 'inquiry_id');
            // if(isset($inquiryEditdata) && !empty($inquiryEditdata)){
            //     foreach($inquiryEditdata as $val => $value){
            //         $value = get_object_vars($value);
            //         $check_appointment[$value['inquiry_status_id']] = $value;
            //     }
            // }
             $appointment_access = $inquiry_data['isSiteVisit'];
            // if($appointment_access == 1 || $appointment_access == 2){
            // $appointment_access = 1;
            // if(isset($check_appointment['4']) && is_array($check_appointment['4'])){
            //     $appointment_access = 1;
            // }else if(isset($check_appointment['6']) && is_array($check_appointment['6'])){
            //     $appointment_access = 0;    
            // }else if(isset($check_appointment['9']) && is_array($check_appointment['9'])){
            //     $appointment_access = 1;    
            // }else if(isset($check_appointment['10']) && is_array($check_appointment['10'])){
            //     $appointment_access = 0;    
            // }else if(isset($check_appointment['11']) && is_array($check_appointment['11'])){
            //     $appointment_access = 0;    
            // }else if(isset($check_appointment['12']) && is_array($check_appointment['12'])){
            //     $appointment_access = 0;
            // }else if(isset($check_appointment['2']) && is_array($check_appointment['2'])){
            //     $appointment_access = 1;
            // }else if(isset($check_appointment['1']) && is_array($check_appointment['1'])){
            //     $appointment_access = 1;
            // }
            // if($appointment_access == 1 || $appointment_access == 2){
                $inquiry_tag = $_POST['tag_btn_click'];
                $inquiry_status_id = $_POST['status_btn_click'];
                // if($inquiry_data['isSiteVisit']==4){
                //     $inquiry_tag = 'Re Appointment';
                //     $inquiry_status_id = 10;
                // }
                if($inquiry_data['isSiteVisit']==1 || $inquiry_data['isSiteVisit']==2){
                    $inquiry_tag = 'Re Appointment';
                    $inquiry_status_id = 10;
                }
                // if(isset($before_status_log['9']) && is_array($check_appointment['9'])){
                //     $inquiry_tag = 'Re Appointment';
                //     $inquiry_status_id = 10;
                // }
                // if(isset($before_status_log['11']) && is_array($check_appointment['11'])){
                //     $inquiry_tag = 'Re Appointment';
                //     $inquiry_status_id = 10;
                // }
                // if(isset($nxtfollowdate) && !empty($nxtfollowdate))
                // {
                //     // $nxtfollowdate =  loacal_date_to_formate_date($_POST['appo_date']);
                //     $appointment_date =  $_POST['appoint_date'];
                // }else{
                //     $appointment_date = '';
                // }
                if(isset($_POST['appoint_date']) && !empty($_POST['appoint_date'])){
                    // $nxtfollowdate =  loacal_date_to_formate_date($_POST['nxtfollowdate']);
                    $appointment_date = date('Y-m-d H:i:sa', strtotime($_POST['appoint_date']));
                }else{
                    $appointment_date = '';
                }
                $status_array = array(
                    'user_id' => $user_id,
                    'inquiry_id' => $inquiry_id,
                    'remark' => $remark, 
                    'status_id' => $inquiry_status_id,
                    'nxt_follow_up' => $nxtfollowdate
                );
                $response_status_log = $this->MasterInformationModel->insert_entry2($status_array,$this->username.'_followup');
                if($response_status_log)
                {
                    $update_data = array(
                        'appointment_date' => $appointment_date,
                        'nxt_follow_up' => $nxtfollowdate
                    );
                    $update_data['inquiry_status'] = $inquiry_status_id;
                    if(isset($_POST['intrested_site']) && !empty($_POST['intrested_site']))
                    {
                        $update_data['intrested_site'] = $_POST['intrested_site'];
                        $project_data = project_id_to_full_project_data($_POST['intrested_site']);
                        $project_sub_type_id = "";
                    if (isset($project_data['project_sub_type']) && !empty($project_data['project_sub_type'])) {
                        $project_sub_type = IdToFieldGetData('', "project_sub_type='" . $project_data['project_sub_type'] . "'", "project_management_subtype");
                        $project_sub_type_id = isset($project_sub_type['id']) && !empty($project_sub_type['id']) ? $project_sub_type['id'] : '';
                    }
                    //pre($project_sub_type_id );
                        if(isset($project_data) && !empty($project_data))
                        {
                            $update_data['property_type'] = $project_data['project_type'];
                            $update_data['property_sub_type'] = $project_sub_type_id;
                            $update_data['intrested_area_name'] = $project_data['project_location_id'];
                        }
                    }
                    $update_data['inquiry_cnr'] = 0;
                    $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id,$update_data,$this->username.'_all_inquiry');
                    $status_name = status_id_to_full_status_data($inquiry_status_id , true);
                    $inquiry_log = array(
                        'inquiry_id' => $inquiry_id,
                        'status_id' => $inquiry_status_id,
                        // 'inquiry_status' => $status_name,
                        'user_id' => $user_id,
                        // 'remark' => $remark,
                        // 'nxtfollowdate' => $nxtfollowdate,
                        'inquiry_log' => 'Inquiry '.$inquiry_tag.' By '.$userfullname
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log,$this->username.'_inquiry_log');
                    
                    $result['result'] = 1;
                    $result['msg'] = 'Inquiry Appointment Successfully';
                   //increment audience table insert productwise inquiry_data=2 in 
                    $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
                    $intrested_product = $inquiry_data['intrested_product'];
                    $db_connection = DatabaseDefaultConnection();
                    
                    // Fetching data for inquiry_status = 2
                    $inquiry_data_audience = array();
                    $find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 3 AND intrested_product = $intrested_product";
                    $find_audience = $db_connection->query($find_audience);
                    $all_data_audience = $find_audience->getResultArray();
                   
                    // Fetching data for inquiry_status = 13
                    $inquiry_dataas_audience = array();
                    $find_audiences = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 10 AND intrested_product = $intrested_product";
                    $find_audiences = $db_connection->query($find_audiences);
                    $all_dataas_audience = $find_audiences->getResultArray();
                    if ($result['result'] == 1 && $inquiry_data['inquiry_status']==3 ) {
                        if (!empty($all_data_audience)&& isset($all_data_audience[0]['intrested_product']) && $all_data_audience[0]['intrested_product'] == $intrested_product && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
                            $inquiry_data_audience['inquiry_id'] = $inquiry_id;
                            $inquiry_data_audience['full_name'] = $inquiry_data['full_name'];
                            $inquiry_data_audience['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_data_audience['email'] = $inquiry_data['email'];
                            $inquiry_data_audience['inquiry_status'] =3;
                            $inquiry_data_audience['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_data_audience['name'] = $all_data_audience[0]['name'];
                            $inquiry_data_audience['source'] = $all_data_audience[0]['source'];
                            $inquiry_data_audience['inquiry_data'] = 2;
                            $inquiry_data_audience['pages_name'] = $all_data_audience[0]['pages_name'];
                            $inquiry_data_audience['facebook_syncro'] = 0;
                            $response_audience1 = $this->MasterInformationModel->insert_entry2($inquiry_data_audience, $this->username . "_audience");
                        }
                    } elseif ($result['result'] == 1) {
                        if (!empty($all_dataas_audience) && isset($all_dataas_audience[0]['intrested_product']) && $all_dataas_audience[0]['intrested_product'] == $intrested_product && isset($all_dataas_audience[0]['inquiry_data']) && $all_dataas_audience[0]['inquiry_data'] == 2) {
                            $inquiry_dataas_audience['inquiry_id'] = $inquiry_id;
                            $inquiry_dataas_audience['full_name'] = $inquiry_data['full_name'];
                            $inquiry_dataas_audience['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_dataas_audience['email'] = $inquiry_data['email'];
                            $inquiry_dataas_audience['inquiry_status'] = 10;
                            $inquiry_dataas_audience['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_dataas_audience['name'] = $all_dataas_audience[0]['name'];
                            $inquiry_dataas_audience['source'] = $all_dataas_audience[0]['source'];
                            $inquiry_dataas_audience['inquiry_data'] = 2;
                            $inquiry_dataas_audience['pages_name'] = $all_dataas_audience[0]['pages_name'];
                            $inquiry_dataas_audience['facebook_syncro'] = 0;
                            $response_audience2 = $this->MasterInformationModel->insert_entry2($inquiry_dataas_audience, $this->username . "_audience");
                        }
                    }
                  //live audience auto increment code inquiry_data=3 in
                    $inquiry_data_live = array();
                    $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 3 AND intrested_product = $intrested_product";
                    $find_audience_live = $db_connection->query($find_audience_live);
                    $all_data_live = $find_audience_live->getResultArray();
                    
                    $inquiry_dataas_live = array();
                    $find_audiences_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 10 AND intrested_product = $intrested_product";
                    $find_audiences_live = $db_connection->query($find_audiences_live);
                    $all_dataas_live = $find_audiences_live->getResultArray();
                    
                    if ($result['result'] == 1 && $inquiry_data['inquiry_status']==3) {
                        if (!empty($all_data_live) && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                            
                            $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                            // pre($inquiry_id);

                            if (!empty($existing_entry)) {
                                $inquiry_data_live['inquiry_data'] = 3;
                                $inquiry_data_live['facebook_syncro'] = 0;
                                $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                            } 
                                    // pre('mital');
                                // Insert new entry into the audience table
                                $inquiry_data_live['inquiry_id'] = $inquiry_id;
                                $inquiry_data_live['full_name'] = $inquiry_data['full_name'];
                                $inquiry_data_live['mobileno'] = $inquiry_data['mobileno'];
                                $inquiry_data_live['email'] = $inquiry_data['email'];
                                $inquiry_data_live['inquiry_status'] = 3;
                                $inquiry_data_live['intrested_product'] = $inquiry_data['intrested_product'];
                                $inquiry_data_live['name'] = $all_data_live[0]['name'];
                                $inquiry_data_live['source'] = $all_data_live[0]['source'];
                                $inquiry_data_live['inquiry_data'] = 2;
                                $inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
                                $inquiry_data_live['facebook_syncro'] = 0;
                                $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
                                
                        }
                    } elseif ($result['result'] == 1) {
                        if (!empty($all_dataas_live) && isset($all_dataas_live[0]['inquiry_data']) && $all_dataas_live[0]['inquiry_data'] == 3) {
                           
                            $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                        // pre($inquiry_id);

                        if (!empty($existing_entry)) {
                            $inquiry_dataas_live['inquiry_data'] = 3;
                            $inquiry_dataas_live['facebook_syncro'] = 0;
                            $response_alert2 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_dataas_live, $this->username . "_audience");
                        } 
                                // pre('mital');
                            // Insert new entry into the audience table
                            $inquiry_dataas_live['inquiry_id'] = $inquiry_id;
                            $inquiry_dataas_live['full_name'] = $inquiry_data['full_name'];
                            $inquiry_dataas_live['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_dataas_live['email'] = $inquiry_data['email'];
                            $inquiry_dataas_live['inquiry_status'] = 10;
                            $inquiry_dataas_live['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_dataas_live['name'] = $all_dataas_live[0]['name'];
                            $inquiry_dataas_live['source'] = $all_dataas_live[0]['source'];
                            $inquiry_dataas_live['inquiry_data'] = 2;
                            $inquiry_dataas_live['pages_name'] = $all_dataas_live[0]['pages_name'];
                            $inquiry_dataas_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_dataas_live, $this->username . "_audience");
                            
                        }
                    }

                }else{
                    $result['result'] = 0;
                    $result['msg'] = 'Inquiry Appointment Status not changed';
                }

                //for email send and calender event
                    // $inquirer_email = $this->request->getPost("email");
                    // $appointment_date = $this->request->getPost("appoint_date");
                    // pre($appointment_date);
                    // if ($inquirer_email != '') {
                    //     $email = \Config\Services::email();
                    //     $email->setFrom('sales@ajasys.in', 'Demo Invitation');
                    //     $recipients = array($inquirer_email);
                    //     $email->setTo($inquirer_email);
                    //     $email->setSubject('Live Demo Invitation');
                    //     $baseurl = base_url();
                    //     $currentDateTime = date('Y-m-d H:i:s');
                    //     $invitationMessage = 'Dear ' . $this->username . ','
                    //                         . "\n\n"
                    //                         . 'You are invited to our live demo on ' . $appointment_date . '. Join us to explore our exciting features!'
                    //                         . "\n\n"
                    //                         . 'Best regards,'
                    //                         . "\n"
                    //                         . 'Ajasys Technologies';
                    
                    //     // Set the appointment date and time
                    //     $dateTime = new DateTime($appointment_date);
                    //     $eventStartDate = $dateTime->format('d-m-Y h:i A'); 
                    //     $eventEndDate = $dateTime->modify('+1 hour')->format('d-m-Y h:i A');
                        
                        // $client = new \Google_Client();
                        // pre($client);
                        // $service = new Google_Service_Calendar($client);
                        // $event = new Google_Service_Calendar_Event(array(
                        //     'summary' => 'Live Demo Invitation',
                        //     'description' => 'You are invited to our live demo. Join us to explore our exciting features!',
                        //     'start' => array(
                        //         'dateTime' => $eventStartDate,
                        //         'timeZone' => 'UTC', 
                        //     ),
                        //     'end' => array(
                        //         'dateTime' => $eventEndDate,
                        //         'timeZone' => 'UTC',
                        //     ),
                        // ));
                      

                        // $email->setMessage($invitationMessage . "\n\n");
                        // // pre($email);
                        // if ($email->send()) {
                        //     $result['email_success'] = 'Email sent successfully! Calender Event can set';
                        // } else {
                        //     $result['email_fail'] = $email->printDebugger(['headers']);
                        // }
                    // }
                    

            // }
            // else
            // {
            //     $result['result'] = 0;
            //     $result['msg'] = 'Inquiry Not Follow Status Flow';
            // }
        }
        else if(isset($_POST['status_btn_click']) &&  $_POST['status_btn_click'] == '17')
        {
            // cnr inquiry
            // $check_appointment = array();
            // $before_status_log = array();
            // $inquiry_logEditdata = $this->MasterInformationModel->edit_entry_all('inquiry_status_log' ,$inquiry_id, 'inquiry_id');
            // if(isset($inquiry_logEditdata) && !empty($inquiry_logEditdata)){
            //     foreach($inquiry_logEditdata as $val => $value){
            //         $value = get_object_vars($value);
            //         $before_status_log[$value['inquiry_status_id']] = $value;
            //     }
            // }
            // $inquiryEditdata = $this->MasterInformationModel->edit_entry_all('inquiry_status_log' ,$inquiry_id, 'inquiry_id');
            // if(isset($inquiryEditdata) && !empty($inquiryEditdata)){
            //     foreach($inquiryEditdata as $val => $value){
            //         $value = get_object_vars($value);
            //         $check_appointment[$value['inquiry_status_id']] = $value;
            //     }
            // }
            // $appointment_access = 1;
            // if(isset($check_appointment['4']) && is_array($check_appointment['4'])){
            //     $appointment_access = 1;
            // }else if(isset($check_appointment['6']) && is_array($check_appointment['6'])){
            //     $appointment_access = 1;    
            // }else if(isset($check_appointment['9']) && is_array($check_appointment['9'])){
            //     $appointment_access = 1;    
            // }else if(isset($check_appointment['10']) && is_array($check_appointment['10'])){
            //     $appointment_access = 1;    
            // }else if(isset($check_appointment['11']) && is_array($check_appointment['11'])){
            //     $appointment_access = 1;    
            // }else if(isset($check_appointment['12']) && is_array($check_appointment['12'])){
            //     $appointment_access = 1;
            // }else if(isset($check_appointment['2']) && is_array($check_appointment['2'])){
            //     $appointment_access = 1;
            // }else if(isset($check_appointment['1']) && is_array($check_appointment['1'])){
            //     $appointment_access = 1;
            // }
            //if($cnr_access == 1){
                $inquiry_tag = 'CNR';
                $inquiry_status_id = $_POST['status_btn_click'];
                $status_array = array(
                    'user_id' => $user_id,
                    'inquiry_id' => $inquiry_id,
                    'remark' => 'Inquiry '.$inquiry_tag, 
                    'status_id' => $inquiry_status_id,
                    'nxt_follow_up' => $nxtfollowdate
                );
                $response_status_log = $this->MasterInformationModel->insert_entry2($status_array,$this->username.'_followup');
                if($response_status_log)
                {
                    $update_data['inquiry_cnr'] = 1;
                    $inquiry_tag = 'Call not received';
                    $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id,$update_data,$this->username.'_all_inquiry');
                    $status_name = 'CNR';
                    $inquiry_log = array(
                        'inquiry_id' => $inquiry_id,
                        'status_id' => 17,
                        'user_id' => $user_id,
                        //'remark' => $remark,
                       // 'nxt_follow_up' => $nxtfollowdate,
                        'inquiry_log' => 'Inquiry '.$inquiry_tag.' By '.$userfullname
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log,$this->username.'_inquiry_log');
                    $result['result'] = 1;
                    $result['msg'] = 'Inquiry CNR Successfully';
                   //increment audience table insert productwise inquiry_data=2 in 
                    $inquiry_data_audience = array();
                    $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
                    $intrested_product = $inquiry_data['intrested_product'];
					$find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 17 AND intrested_product = $intrested_product";
					$db_connection = DatabaseDefaultConnection();
					$find_audience = $db_connection->query($find_audience);
					$all_data_audience = $find_audience->getResultArray();

					if (!empty($all_data_audience)&& isset($all_data_audience[0]['intrested_product']) && $all_data_audience[0]['intrested_product'] == $intrested_product && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
						if ($result['result'] == 1) {
							$inquiry_data_audience['inquiry_id'] = $inquiry_id;
							$inquiry_data_audience['full_name'] = $inquiry_data['full_name'];
							$inquiry_data_audience['mobileno'] = $inquiry_data['mobileno'];
							$inquiry_data_audience['email'] = $inquiry_data['email'];
							$inquiry_data_audience['inquiry_status'] = 17;
							$inquiry_data_audience['intrested_product'] = $inquiry_data['intrested_product'];
							$inquiry_data_audience['name'] = $all_data_audience[0]['name'];
							$inquiry_data_audience['source'] = $all_data_audience[0]['source'];
							$inquiry_data_audience['inquiry_data'] = 2;
                            $inquiry_data_audience['pages_name'] = $all_data_audience[0]['pages_name'];
                            $inquiry_data_audience['facebook_syncro'] = 0;
							$response_audience = $this->MasterInformationModel->insert_entry2($inquiry_data_audience, $this->username . "_audience");
						}
					}
                     //live audience auto increment code inquiry_data=3 in
                        $inquiry_data_live = array();
                        $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 17 AND intrested_product = $intrested_product";
                        $find_audience_live = $db_connection->query($find_audience_live);
                        $all_data_live = $find_audience_live->getResultArray();
                
                
                    if (!empty($all_data_live) && isset($all_data_live[0]['intrested_product']) && $all_data_live[0]['intrested_product'] == $intrested_product && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                        if ($result['result'] == 1) {
                       
                        $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                        // pre($inquiry_id);
                        if (!empty($existing_entry)) {
                            $inquiry_data_live['inquiry_data'] = 3;
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                        } 
                                // pre('mital');
                            // Insert new entry into the audience table
                            $inquiry_data_live['inquiry_id'] = $inquiry_id;
                            $inquiry_data_live['full_name'] = $inquiry_data['full_name'];
                            $inquiry_data_live['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_data_live['email'] = $inquiry_data['email'];
                            $inquiry_data_live['inquiry_status'] = 17;
                            $inquiry_data_live['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_data_live['name'] = $all_data_live[0]['name'];
                            $inquiry_data_live['source'] = $all_data_live[0]['source'];
                            $inquiry_data_live['inquiry_data'] = 2;
                            $inquiry_data_live['pages_name'] = $all_data_live[0]['pages_name'];
                            $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live, $this->username . "_audience");
                            
                    }
                } 
                }
                else{
                    $result['result'] = 0;
                    $result['msg'] = 'Inquiry CNR not changed';
                }
            // }
            // else
            // {
            //     $result['result'] = 0;
            //     $result['msg'] = 'Inquiry Not Follow Status Flow';
            // }
        }
        else if(@$remark &&  @$inquiry_id && @$nxtfollowdate)
        {
            $check_appointment = array();
            $check_appointment12 = array();
            $status_array = array(
                'user_id' => $user_id,
                'inquiry_id' => $inquiry_id,
                'remark' => $remark, 
                'nxt_follow_up' => $nxtfollowdate
            );
            if(isset($inquiry_data['inquiry_status']) && !empty($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] > 3 ){
                $status_array['status_id'] = '13';
            }else{
                if(isset($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] == 2){
                    $status_array['status_id'] = '13';
                }else{
                    $status_array['status_id'] = '2';
                }
            }
            $response_status_log = $this->MasterInformationModel->insert_entry2($status_array,$this->username.'_followup');
            if($response_status_log)
            {
                if(isset($inquiry_data['inquiry_status']) && !empty($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] > 3 ){
                $status_array['status_id'] = '13';
            }else{
                if(isset($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status'] == 2){
                    $status_array['status_id'] = '13';
                }else{
                    $status_array['status_id'] = '2';
                }
            }
                $update_data = array(
                     'nxt_follow_up' => $nxtfollowdate
                );
                $inquiry_log = array(
                    'inquiry_id' => $inquiry_id,
                    'user_id' => $user_id
                );
                $inquiry_status_log = array(
                    'inquiry_id' => $inquiry_id,
                    'user_id' => $user_id,
                );
                if(isset($inquiry_data['inquiry_status']) && !empty($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status']> 3 )
                {
                    $inquiry_log['status_id'] = '13';
                    $inquiry_log['inquiry_log'] = 'Inquiry Followup By '.$userfullname;
                }else{
                    if(isset($inquiry_data['inquiry_status']) && $inquiry_data['inquiry_status']==2){
                        $inquiry_log['status_id'] = '13';
                        $inquiry_log['inquiry_log'] = 'Inquiry Followup By '.$userfullname;
                    }else{
                        $update_data['inquiry_status'] = '2';
                        $inquiry_log['status_id'] = '2';
                        $inquiry_log['inquiry_log'] = 'Inquiry Contacted By '.$userfullname;
                    }
                }
                $update_data['inquiry_cnr'] = 0;
                $inquiry_update = $this->MasterInformationModel->update_entry2($inquiry_id,$update_data,$this->username.'_all_inquiry');
                // pre($update_data);
                $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log,$this->username.'_inquiry_log');
                //$response_status_log = $this->MasterInformationModel->insert_entry($inquiry_status_log,'inquiry_status_log');
                $result['result'] = 1;
                $result['msg'] = 'Inquiry Status Updated Successfully';

               //increment audience table insert productwise inquiry_data=2 in 
                $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);
                $intrested_product = $inquiry_data['intrested_product'];
                $db_connection = DatabaseDefaultConnection();

                // Fetching data for inquiry_status = 2
                $inquiry_data_audience = array();
                $find_audience = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 2 AND intrested_product = $intrested_product";
                $find_audience = $db_connection->query($find_audience);
                $all_data_audience = $find_audience->getResultArray();
               
                // Fetching data for inquiry_status = 13
                $inquiry_dataas_audience = array();
                $find_audiences = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 13 AND intrested_product = $intrested_product";
                $find_audiences = $db_connection->query($find_audiences);
                $all_dataas_audience = $find_audiences->getResultArray();
                if ($result['result'] == 1 && $inquiry_data['inquiry_status'] == 2) {
                    if (!empty($all_data_audience)&& isset($all_data_audience[0]['intrested_product']) && $all_data_audience[0]['intrested_product'] == $intrested_product && isset($all_data_audience[0]['inquiry_data']) && $all_data_audience[0]['inquiry_data'] == 2) {
                        $inquiry_data_audience['inquiry_id'] = $inquiry_id;
                        $inquiry_data_audience['full_name'] = $inquiry_data['full_name'];
                        $inquiry_data_audience['mobileno'] = $inquiry_data['mobileno'];
                        $inquiry_data_audience['email'] = $inquiry_data['email'];
                        $inquiry_data_audience['inquiry_status'] = 2;
                        $inquiry_data_audience['intrested_product'] = $inquiry_data['intrested_product'];
                        $inquiry_data_audience['name'] = $all_data_audience[0]['name'];
                        $inquiry_data_audience['source'] = $all_data_audience[0]['source'];
                        $inquiry_data_audience['inquiry_data'] = 2;
                        $inquiry_data_audience['pages_name'] = $all_data_audience[0]['pages_name'];
                        $inquiry_data_audience['facebook_syncro'] = 0;
                        $response_alert = $this->MasterInformationModel->insert_entry2($inquiry_data_audience, $this->username . "_audience");
                    }
                } elseif ($result['result'] == 1) {
                    if (!empty($all_dataas_audience)&& isset($all_dataas_audience[0]['intrested_product']) && $all_dataas_audience[0]['intrested_product'] == $intrested_product && isset($all_dataas_audience[0]['inquiry_data']) && $all_dataas_audience[0]['inquiry_data'] == 2) {
                        $inquiry_dataas_audience['inquiry_id'] = $inquiry_id;
                        $inquiry_dataas_audience['full_name'] = $inquiry_data['full_name'];
                        $inquiry_dataas_audience['mobileno'] = $inquiry_data['mobileno'];
                        $inquiry_dataas_audience['email'] = $inquiry_data['email'];
                        $inquiry_dataas_audience['inquiry_status'] = 13;
                        $inquiry_dataas_audience['intrested_product'] = $inquiry_data['intrested_product'];
                        $inquiry_dataas_audience['name'] = $all_dataas_audience[0]['name'];
                        $inquiry_dataas_audience['source'] = $all_dataas_audience[0]['source'];
                        $inquiry_dataas_audience['inquiry_data'] = 2;
                        $inquiry_dataas_audience['pages_name'] = $all_dataas_audience[0]['pages_name'];
                        $inquiry_dataas_audience['facebook_syncro'] = 0;
                        $response_alert = $this->MasterInformationModel->insert_entry2($inquiry_dataas_audience, $this->username . "_audience");
                    }
                }
              //live audience auto increment code inquiry_data=3 in
                $inquiry_data_live = array();
                $find_audience_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 2 AND intrested_product = $intrested_product";
                $find_audience_live = $db_connection->query($find_audience_live);
                $all_data_live = $find_audience_live->getResultArray();
                
                $inquiry_dataas_live = array();
                $find_audiences_live = "SELECT * FROM " . $this->username . "_audience WHERE inquiry_status = 13 AND intrested_product = $intrested_product";
                $find_audiences_live = $db_connection->query($find_audiences_live);
                $all_dataas_live = $find_audiences_live->getResultArray();
                
                if ($result['result'] == 1 && $inquiry_data['inquiry_status'] == 2) {
                    if (!empty($all_data_live) && isset($all_data_live[0]['inquiry_data']) && $all_data_live[0]['inquiry_data'] == 3) {
                        
                        $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                        // pre($inquiry_id);
                        if (!empty($existing_entry)) {
                            $inquiry_data_live['inquiry_data'] = 3;
						    $inquiry_data_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_data_live, $this->username . "_audience");
                            } 
                        }
                        $inquiry_data_live1['inquiry_id'] = $inquiry_id;
                        $inquiry_data_live1['full_name'] = $inquiry_data['full_name'];
                        $inquiry_data_live1['mobileno'] = $inquiry_data['mobileno'];
                        $inquiry_data_live1['email'] = $inquiry_data['email'];
                        $inquiry_data_live1['inquiry_status'] = 2;
                        $inquiry_data_live1['intrested_product'] = $inquiry_data['intrested_product'];
                        $inquiry_data_live1['name'] = $all_data_live[0]['name'];
                        $inquiry_data_live1['source'] = $all_data_live[0]['source'];
                        $inquiry_data_live1['inquiry_data'] = 2;
                        $inquiry_data_live1['pages_name'] = $all_data_live[0]['pages_name'];
                        $inquiry_data_live1['facebook_syncro'] = 0;
                        $response_alert1 = $this->MasterInformationModel->insert_entry2($inquiry_data_live1, $this->username . "_audience");
                    
                } elseif ($result['result'] == 1) {
                    if (!empty($all_dataas_live) && isset($all_dataas_live[0]['inquiry_data']) && $all_dataas_live[0]['inquiry_data'] == 3) {
                       
                        // $response_alert2 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_dataas_live, $this->username . "_audience");
                        $existing_entry = $this->MasterInformationModel->get_entry_by_id($inquiry_id, $this->username . "_audience");
                        // pre($inquiry_id);

                        if (!empty($existing_entry)) {
                            $inquiry_dataas_live['inquiry_status'] = 13;
                            // $inquiry_dataas_live['name'] = $all_dataas_live[0]['name'];
                            // $inquiry_dataas_live['source'] = $all_dataas_live[0]['source'];
                            $inquiry_dataas_live['inquiry_data'] = 2;
                            // $inquiry_dataas_live['pages_name'] = $all_dataas_live[0]['pages_name'];
						    $inquiry_dataas_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->update_entry4($inquiry_id, $inquiry_dataas_live, $this->username . "_audience");
                        }
                            // Insert new entry into the audience table
                            $inquiry_dataas_live['inquiry_id'] = $inquiry_id;
                            $inquiry_dataas_live['full_name'] = $inquiry_data['full_name'];
                            $inquiry_dataas_live['mobileno'] = $inquiry_data['mobileno'];
                            $inquiry_dataas_live['email'] = $inquiry_data['email'];
                            $inquiry_dataas_live['inquiry_status'] = 13;
                            $inquiry_dataas_live['intrested_product'] = $inquiry_data['intrested_product'];
                            $inquiry_dataas_live['name'] = $all_dataas_live[0]['name'];
                            $inquiry_dataas_live['source'] = $all_dataas_live[0]['source'];
                            $inquiry_dataas_live['inquiry_data'] = 3;
                            $inquiry_dataas_live['pages_name'] = $all_dataas_live[0]['pages_name'];
						    $inquiry_dataas_live['facebook_syncro'] = 0;
                            $response_alert1 = $this->MasterInformationModel->insert_entry($inquiry_dataas_live, $this->username . "_audience");
                            
                        
                    }
                }
            }else{
                $result['result'] = 0;
                $result['msg'] = 'Inquiry Status Updated Failed';
            }
        }
        echo json_encode($result);
        die();
    }
    //assign_foloowup And transfer followup
    public function people_assign_bulk()
    {
        $this->db = DatabaseSecondConnection();
          $secondDb = DatabaseDefaultConnection();
        $session_data = get_session_data();
        $user_id = '';
        $userfullname = '';
        $table_name  = 'admin_all_inquiry';
        if (isset($session_data) && !empty($session_data['id'])) {
            $user_id = $session_data['id'];
            if ($user_id == 0) {
                if (isset($session_data['name'])) {
                    $userfullname = $session_data['name'];
                }
            } else {
                if (isset($session_data['firstname'])) {
                    $userfullname = $session_data['firstname'];
                }
            }
        }
        if (isset($_POST['inquiry_id']) && isset($_POST['action_name']) && isset($_POST['action']) && $_POST['action'] == 'assign') {
            $head_id = 1;
            $assign_user_data = user_id_to_full_user_data($_POST['assign_id']);
            $assign_user_full_name = '';
            if (isset($assign_user_data) && !empty($assign_user_data)) {
                $head_id = $assign_user_data['head'];
                $user_id = $session_data['id'];
                if ($user_id == 0) {
                    if (isset($assign_user_data['name'])) {
                        $assign_user_full_name = $assign_user_data['name'];
                    }
                } else {
                    if (isset($assign_user_data['firstname'])) {
                        $assign_user_full_name = $assign_user_data['firstname'];
                    }
                }
            }
            $inquiry_id = explode(",", $_POST['inquiry_id']);
            $assign_id = $_POST['assign_id'];
            if ($_POST['action_name'] == "assign_followups") {
                foreach ($inquiry_id as $value) {
                    $inquiry_data = inquiry_id_to_full_inquiry_data($value);
                    $sql = "UPDATE " . $table_name . " SET assign_id=" . $assign_id . " , head =" . $head_id . "  WHERE id=" . $value;
                    $result = $secondDb->query($sql);
                    $inquiry_log = array();
                    $inquiry_log = array(
                        'inquiry_id' => $value,
                        'inquiry_log' => 'Inquiry Assign Followup To ' . $assign_user_full_name . ' By ' . $userfullname,
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
                }
            } else if ($_POST['action_name'] == "transfer_ownership") {
                foreach ($inquiry_id as $value) {
                    $sql = "UPDATE  " . $table_name . " SET assign_id=" . $assign_id . " , head =" . $head_id . " , user_id =" . $assign_id . " ,owner_id =" . $assign_id . "  WHERE id=" . $value;
                    $result = $secondDb->query($sql);
                    $inquiry_data = inquiry_id_to_full_inquiry_data($value);
                    $inquiry_log = array();
                    $inquiry_log = array(
                        'inquiry_id' => $value,
                        'inquiry_log' => 'Inquiry Transfer Ownership To ' . $assign_user_full_name . ' By ' . $userfullname
                    );
                    $response_status_log = $this->MasterInformationModel->insert_entry2($inquiry_log, $this->username . '_inquiry_log');
                }
            }
        }
    }
}
