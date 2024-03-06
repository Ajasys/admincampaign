<?php
namespace App\Controllers;
use App\Models\MasterInformationModel;
use Config\Database;
class Globalsearch extends BaseController
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
    }
    public function global_search(){
        $this->db = DatabaseDefaultConnection();
        $search_value = $this->request->getPost('search');
        //$username = $_SESSION['username'];
        $table_name =  $this->username.'_all_inquiry';
        $quiry = $this->db->query('SELECT * FROM '.$table_name.' WHERE `mobileno` LIKE '.$search_value);
        $result = $quiry->getResultArray();
        // pre($result);
        // die();
        echo $search_value;
        // return redirect()->to(base_url("allinquiry"));
    }
    // public function inquriry_time_come(){


    //     $this->db = DatabaseDefaultConnection();
    //     $table_name = $this->username.'_all_inquiry';
    //     $delete_status = '0';
    //     $html = "";
    //     $row_count_html = '';
    //     $return_array = array(
    //         'row_count_html' => '',
    //         'html' => '',
    //         'total_page' => 0,
    //         'response' => 0
    //     );
    //     $not_valid_status = '"0","7","8","12"';
    //     $status = get_table_array_helper('master_inquiry_status');
    
    //     $getchild = '';
    //     $getchild = getChildIds($_SESSION['id']);
    
    //     if(!empty($getchild)){
    //         $getchilda = getChildIds($_SESSION['id']);
    //         $getchilda = "'" . implode("', '", $getchilda) . "'";
    //     }else{
    //         $getchilda = $_SESSION['id'];
    //     }
        
        
    //     if ($this->admin == 1) {
            
    //         $sql = 'SELECT * FROM '.$table_name.' WHERE inquiry_status NOT IN ('.$not_valid_status.') AND DATE_FORMAT(nxt_follow_up,"%d-%m-%Y")=DATE_FORMAT(now(),"%d-%m-%Y") ORDER BY nxt_follow_up DESC';
            
    //     }else{
    //         $sql = 'SELECT * FROM '.$table_name.' WHERE inquiry_status NOT IN ('.$not_valid_status.') AND DATE_FORMAT(nxt_follow_up,"%d-%m-%Y")=DATE_FORMAT(now(),"%d-%m-%Y") AND  (assign_id="' . $_SESSION['id'] . '"  OR  assign_id IN (' . $getchilda . ')  ) ORDER BY nxt_follow_up DESC';
    //     }
    //     $main_sql = $sql;
    //     $Getresult = $this->db->query($main_sql);
    //     $inquiry_all_data = $Getresult->getResultArray();
    //     if($Getresult->getNumRows() > 0)
    //     {
    //         $i = 1;
    //         $today = date("Y-m-d");
    //         date_default_timezone_set('Asia/Kolkata');
    //         $current_time = date("H:i");
    //         $t = '';
    //         $count_row = 0;
    //         $htmlssssss = array();
    //         foreach ($inquiry_all_data as $key => $value)
    //         {
    //             $allow_user = 1;
    //             if($allow_user == 1){
    //                 if(isset($value['nxt_follow_up']) && !empty($value['nxt_follow_up'])){
    //                     $second = strtotime($value['nxt_follow_up']);
    //                     $t = date('Y-m-d', $second);
    //                     $time = date('H:i', $second);
    //                 }
    //                 $btn_class = 'status_color_' . $value['inquiry_status'];
    //                 $btn_name = 'Default';
    //                 if (isset($value['inquiry_status']) && !empty($value['inquiry_status'])) {
    //                     if (isset($status[$value['inquiry_status']])) {
    //                         $btn_class = 'status_color_' . $value['inquiry_status'];
    //                         $btn_name = $status[$value['inquiry_status']]['inquiry_status'];
    //                     }
    //                 }
    //                 if(strtotime($current_time.'+ 5 minute') >= strtotime($time) ){
    //                     $inquiry_unique_id = isset($value['id']) && !empty($value['id']) ? $value['id'] : '';
    //                     $full_name = isset($value['full_name']) && !empty($value['full_name']) ? $value['full_name'] :  "";
    //                     $assign_name = '';
    //                     $user_data = user_id_to_full_user_data($value['assign_id']);
    //                     if ($value['assign_id'] == 0) {
    //                         if (isset($user_data['name'])) {
    //                             $assign_name = $user_data['name'];
    //                         }
    //                     } else {
    //                         if (isset($user_data['firstname'])) {
    //                             $assign_name = $user_data['firstname'];
    //                         }
    //                     }
    //                     $nxt_follow_up = isset($value['nxt_follow_up']) && !empty($value['nxt_follow_up']) ? $value['nxt_follow_up'] : '';
    //                     $date = date('d-m-Y',strtotime($nxt_follow_up));
    //                         $time = date('h:i A',strtotime($nxt_follow_up));
                       
                     
    //                     $inquiry_details = "";
    //                         if (isset($value['inquiry_type']) && !empty($value['inquiry_type'])) {
    //                             $inquiry_type_name = IdToFieldGetData('inquiry_details', "id=" . $value['inquiry_type'] . "", "admin_master_inquiry_type");
    //                             $inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
    //                         }
    //                     $html  .='<li>
    //                             <a class="dropdown-item" href="/allinquiry?action=filter&filter_id=' . $value['id'] . '">
    //                                <div class="notification d-flex">
    //                                   <div class="notification_left">
    //                                      <i class="bi bi-telephone me-3"></i>
    //                                   </div>
    //                                   <div class="notification_right w-100">
    //                                      <div class="data_noti d-flex align-items-center justify-content-between">
    //                                         <h6>'.$value['id'].'</h6>
    //                                         <label for="">'.$btn_name.'</label>
    //                                      </div>
    //                                      <div class="user_data">
    //                                         <ul>
    //                                            <li>
    //                                               <b>name:</b>
    //                                               '.$full_name.'
    //                                            </li>
    //                                            <li>
    //                                               <b>next follow up:</b>
    //                                               '.followup_date_convert_indian_date($nxt_follow_up).'
    //                                            </li>
    //                                            <li>
    //                                               <b>inquiry type:</b>
    //                                              '.$inquiry_details.'
    //                                            </li>
    //                                         </ul>
    //                                      </div>
    //                                   </div>
    //                                </div>
    //                             </a>
    //                          </li>';
    //                     $count_row++;
    //                 }

    //                 if(strtotime($current_time.'+ 5 minute') == strtotime($time)){
    //                     $htmlssssss['inq_id'] = $value['id'];
    //                     $htmlssssss['inq_type'] = $btn_name;
    //                     $htmlssssss['full_name'] = $full_name ;
    //                 }
    //             }
    //         }
    //         $return_array['htmlssssss'] = $htmlssssss;
    //         $return_array['count_row'] = $count_row;
    //         $return_array['html'] = $html;
    //     }else{
    //         $return_array['html'] = '<p style="text-align:center;">Data Not Found </p>';
    //     }
    //     echo json_encode($return_array);
    //     die();
    // }

    public function today_task()
    {
        $all_inq_count = 0;
        $today_inq_count = 0;
        $pending_inq_count = 0;
        $appointment_inq_count = 0;
        $negotiation_inq_count = 0;
        $dismissed_inq_count = 0;
        $visit_inq_count = 0;
        $booking_inq_count = 0;
        $all_inquery_get = 0;
        $user_id = array();
        $session_array_get= array();
           

        $today_inq_counts = getStatusWiseData("today");

        $today_inq_count = 0; // Initialize the count variable
        
        if (!empty($today_inq_counts)) {
            foreach ($today_inq_counts as $value) {
                if (isset($value['total_inq'])) {
                    $today_inq_count += $value['total_inq'];
                }
            }
        }
         
          
           $pending_inq_counts = getStatusWiseData("pending");
           $pending_inq_count = 0;
          if(!empty($today_inq_counts)){
               foreach ($pending_inq_counts as $key => $value) {
                if (isset($value['total_inq'])) {
                   $pending_inq_count += $value['total_inq'];
                }

            }
        }
        // $allinq_count_array = get_user_count_inquiry_data($_SESSION['user_id'] , $_SESSION['role_number']);
       //  $allinq_count_array = getStatusWiseData($_SESSION['user_id'] , $_SESSION['role_number']);
        // if(isset($allinq_count_array) && !empty($allinq_count_array)){
        //     $all_inq_count = $allinq_count_array['all_inquiry'];
        //     $pending_inq_count = $allinq_count_array['pending_inquiry'];
        //     $appointment_inq_count = $allinq_count_array['appointment_inquiry'];
        //     $negotiation_inq_count = $allinq_count_array['negotiation_inquiry'];
        //     $dismissed_inq_count = $allinq_count_array['dismissed_inquiry'];
        //     $visit_inq_count = $allinq_count_array['visit_inquiry'];
        //     $booking_inq_count = $allinq_count_array['booking_inquiry'];
        // }
        // $allinq_count_array_today = get_user_count_inquiry_data_today($_SESSION['user_id'] , $_SESSION['role_number']);
        // if(isset($allinq_count_array_today) && !empty($allinq_count_array_today)){
        //     $today_inq_count = $allinq_count_array_today['today_inquiry'];
        // }
        // $allinq_count_array_tpending= get_user_count_inquiry_data_pending($_SESSION['user_id'] , $_SESSION['role_number']);
        // if(isset($allinq_count_array_tpending) && !empty($allinq_count_array_tpending)){
        //     $pending_inq_count = $allinq_count_array_tpending['all_inquiry'];
        // }

         $result =array();
         $all_inquery_get = $today_inq_count+$pending_inq_count;
         //$today_task = get_table_array_helper('today_task');
         //$all_inq_data_data = json_decode($today_task[1]['all_inq'],true);
        // $total_inq_dqata ='';
        // if(!empty($all_inq_data_data[$_SESSION['user_id']])){
        //     if($_SESSION['user_id'] == 1 || $_SESSION['user_id'] == 2){
        //         $total_inq_dqata =  $all_inq_data_data[1]['get_all_inq'];
        //     }else{
        //         $total_inq_dqata =  $all_inq_data_data[$_SESSION['user_id']]['get_all_inq'];
        //     }
            
        // }
        // if(!empty($total_inq_dqata)){
        //     $data = $total_inq_dqata-$all_inquery_get;
        //     $result['total_inquiry'] = $total_inq_dqata;
        //     $calc = cal_percentage($data,$result['total_inquiry']);
        //     $result['calc'] = $calc;
        // }else{
        //     $result['total_inquiry'] =0;
        //     $result['calc'] = 0;

        // }

        $result['all_inquiry'] = $all_inquery_get;
        $result['today_inq_count'] = $today_inq_count;
        $result['pending_inq_count'] = $pending_inq_count;
        return json_encode($result,true);
        die();
    }
}