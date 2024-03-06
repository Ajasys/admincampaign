<?php

namespace App\Controllers;
use App\Models\MasterInformationModel;
class ReportController extends BaseController
{
    protected $db;
    public function __construct() {
    helper('custom');
        $db = db_connect();
        
       $this->MasterInformationModel = new MasterInformationModel($db);
       $this->username = session_username($_SESSION['username']);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
    }

    public function inq_user_wise_report(){
        $date = '' ;
        $this->db = DatabaseSecondConnection();
        $from_date = $this->request->getPost("from_date");
        $to_date = $this->request->getPost("to_date");

        // pre($from_date);
         $from_dates = '';
         $to_dates = '';
        if(!empty($from_date) && !empty($to_date)){
            $from_dates = date('Ymd',strtotime($from_date));
            $to_dates= date('Ymd',strtotime($to_date));
        }
          
        // pre($to_dates);
        // die();

             //condtion access
            $getchild = array();
            $user_id = 0;
            if (!$this->admin == 1) {
                $user_id = $_SESSION['id'];
            }
            $getchild = getChildIds($_SESSION['id']);
            if(!empty($getchild)){
                  array_push($getchild, $user_id);
            }
            $all_gm_under_people_implode = "'" . implode("', '", $getchild) . "'";
            if($this->admin == 1){
              if(!empty($from_dates)&& !empty($to_dates)){
                 $query =  'WHERE STR_TO_DATE(i.nxt_follow_up, "%Y-%m-%d %H:%i:%s")   BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d")';
              }else{
                  $query =  'WHERE MONTH(i.nxt_follow_up) = MONTH(CURRENT_DATE())';   
              }
            }else{
              if(!empty($from_dates)&& !empty($to_dates)){
                  $query =  'WHERE assign_id IN (' . $all_gm_under_people_implode . ') AND STR_TO_DATE(i.nxt_follow_up, "%Y-%m-%d %H:%i:%s")   BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d")'; 
              }else{
                  $query =  'WHERE assign_id IN (' . $all_gm_under_people_implode . ') AND MONTH(i.nxt_follow_up) = MONTH(CURRENT_DATE())'; 
              }  
            }



            //user_wise_inq
            $sql_query= 'SELECT
                IFNULL(i.assign_id, 0) AS assign_id,
                u.firstname,
                    COUNT(CASE WHEN i.inquiry_status = 1 THEN 1 END) AS fresh,
                    COUNT(CASE WHEN i.inquiry_status = 2  THEN 1 END) AS contacted,
                    COUNT(CASE WHEN i.inquiry_status = 3  THEN 1 END) AS appointment,
                    COUNT(CASE WHEN i.inquiry_status = 4  THEN 1 END) AS visited,
                    COUNT(CASE WHEN i.inquiry_status = 6  THEN 1 END) AS Negotiations,
                    COUNT(CASE WHEN i.inquiry_status = 7  THEN 1 END) AS Dismissed,
                    COUNT(CASE WHEN i.inquiry_status = 9  THEN 1 END) AS  feedback,
                    COUNT(CASE WHEN i.inquiry_status = 10  THEN 1 END) AS Reappointment,
                    COUNT(CASE WHEN i.inquiry_status = 11  THEN 1 END) AS ReVisited,
                    COUNT(CASE WHEN i.inquiry_status = 12  THEN 1 END) AS Booking ,
                    COUNT(*) AS total
            FROM '. $this->username.'_all_inquiry as i
            LEFT JOIN '.$this->username.'_user as u ON u.id = i.assign_id OR (u.id = 0 AND i.assign_id IS NULL)
            '.$query.'
            GROUP BY i.assign_id, u.firstname';

            $sql_query = $this->db->query($sql_query);
            $user_data_array = $sql_query->getResultArray();
            $user_data = "";
            $user_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                           <div class="px-3 py-1 col-2 flex-xxl-fill col-xxl-2 col-sm-4 col-xxs-6 col-md-3">
                              <p class="fs-7 text-white"><b>User name</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>Fresh</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>contacted</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>appointment</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>visited</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>Negotiations</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>Dismissed</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>Re app.</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>Revisit</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>Booking</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7 text-white"><b>Total</b></p>
                           </div>
                        </li>';
            $fresh = 0;
            $contacted = 0;
            $appointment = 0;
            $visited = 0;
            $Negotiations = 0;
            $Dismissed =0;
            $feedback = 0;
            $Reappointment = 0;
            $Booking = 0;
            $maintotal = 0;
            foreach ($user_data_array as $key => $value) {
                $user_data .= ' <li class="d-flex align-items-center justify-content-between flex-nowrap">
                   <div class="px-3 py-1 col-2 bg-white flex-xxl-fill col-xxl-2 col-sm-4 col-xxs-6 col-md-3">
                      <p class="fs-7">'.$value['firstname'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['fresh'].'</p>

                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['contacted'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['appointment'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['visited'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['Negotiations'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['Dismissed'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['feedback'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['Reappointment'].'</p>
                   </div>
                   <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['Booking'].'</p>
                   </div>
                    <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                      <p class="fs-7">'.$value['total'].'</p>
                   </div>
                </li> ';
                $fresh += $value['fresh'];
                $contacted += $value['contacted'];
                $appointment += $value['appointment'];
                $visited += $value['visited'];
                $Negotiations += $value['Negotiations'];
                $Dismissed += $value['Dismissed'];
                $feedback += $value['feedback'];
                $Reappointment += $value['Reappointment'];
                $Booking += $value['Booking'];
                $maintotal += $value['total'];
                
            }

            $user_data .= ' <li class="d-flex align-items-center justify-content-between flex-nowrap">
                           <div class="px-3 py-1 col-2 bg-white flex-xxl-fill col-xxl-2 col-sm-4 col-xxs-6 col-md-3">
                              <p class="fs-7"><b>Total</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$fresh.'</b></p>
                              
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$contacted.'</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$appointment .'</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$visited.'</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$Negotiations.'</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$Dismissed.'</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$feedback.'</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$Reappointment.'</b></p>
                           </div>
                           <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$Booking.'</b></p>
                           </div>
                            <div class="px-3 py-1 col-1 bg-white flex-xxl-fill col-xxl-1 col-sm-3 col-xxs-6 col-md-2">
                              <p class="fs-7"><b>'.$maintotal.'</b></p>
                           </div>
                        </li> ';

        // Inquiry Type Report
            $not_valid_status = '"7","12"';
            $valid_status = '"7","12"';
            $sql_query= 'SELECT
                IFNULL(i.inquiry_type, 0) AS inquiry_type,
                u.inquiry_details,
                    COUNT(CASE WHEN  i.inquiry_status NOT IN ('.$not_valid_status.') THEN 1 END) AS live,
                    COUNT(CASE WHEN i.inquiry_status  IN ('.$valid_status.')  THEN 1 END) AS Close,
                    COUNT(*) AS total
            FROM '.$this->username.'_all_inquiry as i
            LEFT JOIN master_inquiry_type as u ON u.id = i.inquiry_type OR (u.id = 0 AND i.inquiry_type IS NULL)
            '.$query.'
            GROUP BY i.inquiry_type, u.inquiry_details';
           // pre( $sql_query);

            $sql_query = $this->db->query($sql_query);
            $live = 0;
            $close = 0;
            $inq_repo_main_total = 0;
            $Inquiry_Type_Report_array = $sql_query->getResultArray();
            $Inquiry_Type_Report = '';
            $Inquiry_Type_Report .= '<li class="d-flex align-items-center justify-content-between rounded">
               <div class="col-6 col-xxs-6 px-3 py-1">
                  <p class="fs-7 text-white"><b>Inquiry Type</b></p>
               </div>
               <div class="col-2 col-xxs-6 px-3 py-1">
                  <p class="fs-7 text-white"><b>Live</b></p>
               </div>
               <div class="col-2 col-xxs-6 px-3 py-1">
                  <p class="fs-7 text-white"><b>Close</b></p>
               </div>
               <div class="col-2 col-xxs-6  px-3 py-1">
                  <p class="fs-7 text-white"><b>Total </b></p>
               </div>
            </li>';
            foreach ($Inquiry_Type_Report_array as $key => $value) {
                $Inquiry_Type_Report .= '<li class="d-flex align-items-center justify-content-between">
                           <div class="col-6 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['inquiry_details'].'</p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['live'].'</p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['Close'].'</p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['total'].'</p>
                           </div>
                        </li>';

                        $live += $value['live'];
                        $close += $value['Close'];
                        $inq_repo_main_total += $value['total'];
            }
            $Inquiry_Type_Report .= '<li class="d-flex align-items-center justify-content-between">
                   <div class="col-6 col-xxs-6 px-3 py-1 bg-white">
                      <p class="fs-7"><b>Total</b></p>
                   </div>
                   <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                      <p class="fs-7"><b>'.$live.'</b></p>
                   </div>
                   <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                      <p class="fs-7"><b>'.$close.'</b></p>
                   </div>
                   <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                      <p class="fs-7"><b>'.$inq_repo_main_total.'</b></p>
                   </div>
                </li>';

          //inq source
          $sql_inq_source = 'SELECT
              IFNULL(i.inquiry_source_type, 0) AS inquiry_source_type,
              u.source,
              a.inquiry_source_type,
              COUNT(CASE WHEN i.inquiry_status NOT IN ('.$not_valid_status.') THEN 1 END) AS live,
              COUNT(CASE WHEN i.inquiry_status IN ('.$valid_status.') THEN 1 END) AS Close,
              COUNT(*) AS total
          FROM '.$this->username.'_all_inquiry AS i
          LEFT JOIN master_inquiry_source AS u ON u.id = i.inquiry_source_type OR (u.id = 0 AND i.inquiry_source_type IS NULL)
          LEFT JOIN master_inquiry_source_type AS a ON a.id = u.inquiry_source_type 
          '.$query.'
          GROUP BY i.inquiry_source_type, u.source,a.inquiry_source_type';
          $sql_query = $this->db->query($sql_inq_source);
          $live_inq_source_repo_main_total = 0;
          $close_inq_source_repo_main_total = 0;
          $inq_source_repo_main_total = 0;
          $Inquiry_Type_source_array = $sql_query->getResultArray();
          $inq_source_repo_html = '';
           $inq_source_repo_html .= ' <li class="d-flex align-items-center justify-content-between rounded">
                           <div class="col-3 col-xxs-6 px-3 py-1">
                              <p class="fs-7 text-white"><b>Source Type</b></p>
                           </div>
                           <div class="col-3 col-xxs-6 px-3 py-1">
                              <p class="fs-7 text-white"><b>Inquiry source </b></p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1">
                              <p class="fs-7 text-white"><b>Live</b></p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1">
                              <p class="fs-7 text-white"><b>Close</b></p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1">
                              <p class="fs-7 text-white"><b>Total </b></p>
                           </div>
                        </li>';
          foreach ($Inquiry_Type_source_array as $key => $value) {
             $inq_source_repo_html .= ' <li class="d-flex align-items-center justify-content-between">
                           <div class="col-3 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['source'].'</p>
                              
                           </div>
                           <div class="col-3 col-xxs-6 px-3 py-1 bg-white">
                             <p class="fs-7">'.$value['inquiry_source_type'].'</p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['live'].'</p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['Close'].'</p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1 bg-white">
                              <p class="fs-7">'.$value['total'].'</p>
                           </div>
                        </li>';
                        $inq_source_repo_main_total +=$value['total'];
                        $live_inq_source_repo_main_total +=$value['total'];
                        $close_inq_source_repo_main_total +=$value['total'];
          }

          $inq_source_repo_html .= ' <li class="d-flex align-items-center justify-content-between">
                          <div class="col-3 col-xxs-6 px-3 py-1">
                              <p class="fs-7 "><b>Total </b></p>
                           </div>
                           <div class="col-3 col-xxs-6 px-3 py-1">
                              <p class="fs-7 "><b></b></p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1">
                              <p class="fs-7 "><b>'.$live_inq_source_repo_main_total.'</b></p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1">
                              <p class="fs-7 "><b>'.$close_inq_source_repo_main_total.'</b></p>
                           </div>
                           <div class="col-2 col-xxs-6 px-3 py-1">
                              <p class="fs-7 "><b>'. $inq_source_repo_main_total.' </b></p>
                           </div>
                           </li>';

                           
         
          $return_array['Inquiry_Type_Report'] = $Inquiry_Type_Report;
          $return_array['inq_source_repo_html'] = $inq_source_repo_html;
          $return_array['user_data'] = $user_data;
          echo json_encode($return_array);
          die();


    }


    public function inq_site_report(){

        $this->db = DatabaseSecondConnection();
        $from_date = $this->request->getPost("from_date");
        $to_date = $this->request->getPost("to_date");
        $project = $this->request->getPost("project");

        // pre($from_date);
        $from_dates = '';
        $to_dates = '';
        if(!empty($from_date) && !empty($to_date)){
            $from_dates = date('Ymd',strtotime($from_date));
            $to_dates= date('Ymd',strtotime($to_date));
        }
        $getchild = array();
        $user_id = 0;
        if (!$this->admin == 1) {
            $user_id = $_SESSION['id'];
        }
        $getchild = getChildIds($_SESSION['id']);
        if(!empty($getchild)){
              array_push($getchild, $user_id);
        }
        $all_gm_under_people_implode = "'" . implode("', '", $getchild) . "'";
        if($this->admin == 1){
          if(!empty($from_dates)&& !empty($to_dates) && !empty($project)){
             $query =  'where  STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s")  BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d") AND intrested_site='.$project.'';
          }else{
              $query =  'where MONTH(created_at) = MONTH(CURRENT_DATE()) AND intrested_site='.$project.'';   
          }
        }else{
          if(!empty($from_dates)&& !empty($to_dates) && !empty($project)){
              $query =  'where assign_id IN (' . $all_gm_under_people_implode . ') AND STR_TO_DATE(created_at, "%Y-%m-%d %H:%i:%s")   BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d") AND intrested_site='.$project.''; 
          }else{
              $query =  'where assign_id IN (' . $all_gm_under_people_implode . ') AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND intrested_site='.$project.''; 
          }  
        }


        $sql_query ='
          SELECT
              CONCAT(budget_range_start, "-", budget_range_end) AS budget_range,
              COUNT(*) AS inquiry_count,
              COUNT(*) / total_count * 100 AS percentage
            FROM (
              SELECT
                FLOOR((budget - 10) / 5) * 5 + 10 AS budget_range_start,
                FLOOR((budget - 10) / 5) * 5 + 14 AS budget_range_end
              FROM '.$this->username.'_all_inquiry
              '.$query.'
            ) AS ranges
            CROSS JOIN (
              SELECT COUNT(*) AS total_count
              FROM '.$this->username.'_all_inquiry
              '.$query.'
            ) AS total
            GROUP BY budget_range
            ORDER BY budget_range_start';
            $sql_query = $this->db->query($sql_query);
            $budget_inq_html = $sql_query->getResultArray();
            $budget_html ='';
            $budget_total_count = 0;
            $budget_html .= '<li class="d-flex align-items-center justify-content-between rounded">
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Budget</b></p>
                                    </div>
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Total</b></p>
                                    </div>
                                </li>';
                                $budget_range=array();
                                $budget_percentage = array();
                                $budget_inquiry_count = array();
        foreach ($budget_inq_html as $key => $value) {
               $budget_html .= '<li class="d-flex align-items-center justify-content-between">
                  <div class="col-6 px-3 py-1 bg-white">
                      <p class="fs-7">'.$value['budget_range'].'</p>
                  </div>
                  <div class="col-6 px-3 py-1 bg-white">
                      <p class="fs-7">'.$value['inquiry_count'].'('.round(number_format($value['percentage'],2,".","."),1).')%</p>
                  </div>
               </li>';
               $budget_range[] = $value['budget_range'];
               $budget_percentage[] = $value['percentage'];
               $budget_inquiry_count[] = $value['inquiry_count'];
               $budget_total_count += $value['inquiry_count'];           
          
        }
        $budget_html .= '<li class="d-flex align-items-center justify-content-between">
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7"><b>Total</b></p>
                           </div>
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7">'.$budget_total_count.'</p>
                           </div>
                        </li>';

        $return_array['budget_html'] = $budget_html;
        $return_array['budget_inquiry_count'] = array_map('intval',$budget_inquiry_count);
        $return_array['budget_percentage'] = $budget_percentage;
        $return_array['budget_range'] = $budget_range;
        //$total_purpose_buy =array();
        $sql_pourpose = "SELECT IFNULL(a.purpose_buy, 'undefined') AS purpose_buy, COUNT(*) AS Total, (COUNT(*) / t.total_count) * 100 AS Percentage
          FROM (
              SELECT DISTINCT purpose_buy
              FROM " . $this->username . "_all_inquiry
          ) a
          LEFT JOIN " . $this->username . "_all_inquiry ON a.purpose_buy = " . $this->username . "_all_inquiry.purpose_buy
            CROSS JOIN (
              SELECT COUNT(*) AS total_count
              FROM " . $this->username . "_all_inquiry
              " . $query . "
          ) t
            " . $query . "
          GROUP BY a.purpose_buy";
                $sql_pourpose = $this->db->query($sql_pourpose);
                $sql_pourpose_array = $sql_pourpose->getResultArray();
                $purpose_wise_data = '';
                $purpose_total_count=0;
                $purpose_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Purpose for Buying</b></p>
                                    </div>
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Total</b></p>
                                    </div>
                                </li>';
                                 $purpose_buy = array();
                $purpose_inquiry_count = array();
                foreach ($sql_pourpose_array as $key => $value) {
                  $purpose_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                                <div class="col-6 px-3 py-1">
                                    <p class="fs-7 "><b>'.$value['purpose_buy'].'</b></p>
                                </div>
                                <div class="col-6 px-3 py-1">
                                    <p class="fs-7 "><b>'.$value['Total'].'('.round(number_format($value['Percentage'],2,".","."),1).')%</b></p>
                                </div>
                            </li>';
                    $purpose_buy[] = $value['purpose_buy'];
                    $purpose_inquiry_count[] = $value['Total'];
                    $purpose_total_count += $value['Total'];    
                }
               $purpose_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7"><b>Total</b></p>
                           </div>
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7">'.$purpose_total_count.'</p>
                           </div>
                        </li>';
        $return_array['purpose_buy'] = $purpose_buy;
        $return_array['purpose_total_count'] = $purpose_total_count;
        $return_array['purpose_inquiry_count'] = array_map('intval',$purpose_inquiry_count);
        $return_array['purpose_wise_data'] = $purpose_wise_data;

        //visit analysys


        //budget

        if($this->admin == 1){
          if(!empty($from_dates)&& !empty($to_dates) && !empty($project)){
             $visit_query =  'where  STR_TO_DATE(visit_date, "%Y-%m-%d %H:%i:%s")  BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d") AND intrested_site='.$project.' AND (isSiteVisit = 1 OR isSiteVisit = 2)';
          }else{
              $visit_query =  'where MONTH(visit_date) = MONTH(CURRENT_DATE()) AND intrested_site='.$project.' AND (isSiteVisit = 1 OR isSiteVisit = 2)';   
          }
        }else{
          if(!empty($from_dates)&& !empty($to_dates) && !empty($project)){
              $visit_query =  'where assign_id IN (' . $all_gm_under_people_implode . ') AND STR_TO_DATE(visit_date, "%Y-%m-%d %H:%i:%s")   BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d") AND intrested_site='.$project.' AND (isSiteVisit = 1 OR isSiteVisit = 2) '; 
          }else{
              $visit_query =  'where assign_id IN (' . $all_gm_under_people_implode . ') AND MONTH(visit_date) = MONTH(CURRENT_DATE()) AND intrested_site='.$project.' AND (isSiteVisit = 1 OR isSiteVisit = 2)'; 
          }  
        }

        $sql_query ='
        SELECT
              CONCAT(budget_range_start, "-", budget_range_end) AS budget_range,
              COUNT(*) AS inquiry_count,
              COUNT(*) / total_count * 100 AS percentage
            FROM (
              SELECT
                FLOOR((budget - 10) / 5) * 5 + 10 AS budget_range_start,
                FLOOR((budget - 10) / 5) * 5 + 14 AS budget_range_end
              FROM '.$this->username.'_all_inquiry
              '.$visit_query.' 
            ) AS ranges
            CROSS JOIN (
              SELECT COUNT(*) AS total_count
              FROM '.$this->username.'_all_inquiry
              '.$visit_query.'  
            ) AS total
            GROUP BY budget_range
            ORDER BY budget_range_start';


            $sql_query = $this->db->query($sql_query);
            $visit_budget_inq_html = $sql_query->getResultArray();
            $visit_budget_html ='';
            $visit_budget_total_count = 0;
            $visit_budget_html .= '<li class="d-flex align-items-center justify-content-between rounded">
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Budget</b></p>
                                    </div>
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Total</b></p>
                                    </div>
                                </li>';
                                $visit_budget_range=array();
                                $visit_budget_percentage = array();
                                $visit_budget_inquiry_count = array();
        foreach ($visit_budget_inq_html as $key => $value) {
               $visit_budget_html .= '<li class="d-flex align-items-center justify-content-between">
                  <div class="col-6 px-3 py-1 bg-white">
                      <p class="fs-7">'.$value['budget_range'].'</p>
                  </div>
                  <div class="col-6 px-3 py-1 bg-white">
                      <p class="fs-7">'.$value['inquiry_count'].'('.round(number_format($value['percentage'],2,".","."),1).')%</p>
                  </div>
               </li>';
               $visit_budget_range[] = $value['budget_range'];
               $visit_budget_percentage[] = $value['percentage'];
               $visit_budget_inquiry_count[] = $value['inquiry_count'];
               $visit_budget_total_count += $value['inquiry_count'];           
          
        }
        $visit_budget_html .= '<li class="d-flex align-items-center justify-content-between">
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7"><b>Total</b></p>
                           </div>
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7">'.$visit_budget_total_count.'</p>
                           </div>
                        </li>';

        $return_array['visit_budget_html'] = $visit_budget_html;
        $return_array['visit_budget_inquiry_count'] = array_map('intval',$visit_budget_inquiry_count);
        $return_array['visit_budget_percentage'] = $visit_budget_percentage;
        $return_array['visit_budget_range'] = $visit_budget_range;


        //pupose
        $visit_sql_pourpose = "SELECT IFNULL(a.purpose_buy, 'undefined') AS purpose_buy, COUNT(*) AS Total, (COUNT(*) / t.total_count) * 100 AS Percentage
          FROM (
              SELECT DISTINCT purpose_buy
              FROM " . $this->username . "_all_inquiry
          ) a
          LEFT JOIN " . $this->username . "_all_inquiry ON a.purpose_buy = " . $this->username . "_all_inquiry.purpose_buy
            CROSS JOIN (
              SELECT COUNT(*) AS total_count
              FROM " . $this->username . "_all_inquiry
              " . $visit_query . "
          ) t
            " . $visit_query . "
          GROUP BY a.purpose_buy";


                $visit_sql_pourpose = $this->db->query($visit_sql_pourpose);
                $visit_sql_pourpose_array = $visit_sql_pourpose->getResultArray();
                $visit_purpose_wise_data = '';
                $visit_purpose_total_count=0;
                $visit_purpose_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Purpose for Buying</b></p>
                                    </div>
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Total</b></p>
                                    </div>
                                </li>';
                                 $visit_purpose_buy = array();
                $visit_purpose_inquiry_count = array();
                foreach ($visit_sql_pourpose_array as $key => $value) {
                  $visit_purpose_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                                <div class="col-6 px-3 py-1">
                                    <p class="fs-7 "><b>'.$value['purpose_buy'].'</b></p>
                                </div>
                                <div class="col-6 px-3 py-1">
                                    <p class="fs-7 "><b>'.$value['Total'].'('.round(number_format($value['Percentage'],2,".","."),1).')%</b></p>
                                </div>
                            </li>';
                    $visit_purpose_buy[] = $value['purpose_buy'];
                    $visit_purpose_inquiry_count[] = $value['Total'];
                    $visit_purpose_total_count += $value['Total'];    
                }
               $visit_purpose_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7"><b>Total</b></p>
                           </div>
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7">'.$visit_purpose_total_count.'</p>
                           </div>
                        </li>';
        $return_array['visit_purpose_buy'] = $visit_purpose_buy;
        $return_array['visit_purpose_total_count'] = $visit_purpose_total_count;
        $return_array['visit_purpose_inquiry_count'] = array_map('intval',$visit_purpose_inquiry_count);
        $return_array['visit_purpose_wise_data'] = $visit_purpose_wise_data;

        $sql_inq_source = 'SELECT  IFNULL(i.inquiry_source_type, 0) AS inquiry_source_type,
            u.source,
            a.inquiry_source_type,
            COUNT(*) AS total,
            (COUNT(*) / t.total_count) * 100 AS Percentage
              FROM '.$this->username.'_all_inquiry AS i
              LEFT JOIN master_inquiry_source AS u ON u.id = i.inquiry_source_type OR (u.id = 0 AND i.inquiry_source_type IS NULL)
              LEFT JOIN master_inquiry_source_type AS a ON a.id = u.inquiry_source_type
              LEFT JOIN (
                  SELECT COUNT(*) AS total_count
                  FROM '.$this->username.'_all_inquiry AS i
                  LEFT JOIN master_inquiry_source AS u ON u.id = i.inquiry_source_type OR (u.id = 0 AND i.inquiry_source_type IS NULL)
                  LEFT JOIN master_inquiry_source_type AS a ON a.id = u.inquiry_source_type
                  '.$visit_query.'
              ) t ON 1 = 1
              '.$visit_query.'
              GROUP BY i.inquiry_source_type, u.source, a.inquiry_source_type';

              $visit_sql_source = $this->db->query($sql_inq_source);
              $visit_sql_source_array = $visit_sql_source->getResultArray();
              $visit_source_wise_data = '';
              $visit_source_total_count=0;
              $visit_source_inquiry_count = array();
              $visit_source= array();
              $visit_source_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Source</b></p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Total</b></p>
                              </div>
                          </li>';
                      foreach ($visit_sql_source_array as $key => $value) { 
                          $visit_source_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7">'.$value['source'].'</p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7"><b>'.$value['total'].'('.round(number_format($value['Percentage'],2,".","."),1).')%</b></p>
                              </div>
                          </li>';
                          $visit_source[] = $value['source'];
                          $visit_source_inquiry_count[] = $value['total'];
                          $visit_source_total_count += $value['total']; 
                      }
                      $visit_source_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"></b>Total</b></p>
                          </div>
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"><b>'.$visit_source_total_count.'</b></p>
                          </div>
                      </li>';
                $return_array['visit_source'] = $visit_source;
                $return_array['visit_source_total_count'] = $visit_source_total_count;
                $return_array['visit_source_inquiry_count'] = array_map('intval',$visit_source_inquiry_count);
                $return_array['visit_source_wise_data'] = $visit_source_wise_data;
             
              //visit unit type
              $sql_visit_size = 'SELECT p.property_size, COUNT(*) AS total, (COUNT(*) / t.total_count) * 100 AS Percentage FROM '.$this->username.'_properties AS p INNER JOIN '.$this->username.'_all_inquiry AS i ON p.project_name = i.intrested_site CROSS JOIN ( SELECT COUNT(*) AS total_count FROM '.$this->username.'_properties AS p INNER JOIN '.$this->username.'_all_inquiry AS i ON p.project_name = i.intrested_site '.$visit_query.' AND p.unit_no = i.unit_no ) t '.$visit_query.' AND p.unit_no = i.unit_no GROUP BY p.property_size';
              $visit_sql_size = $this->db->query($sql_visit_size);
              $visit_sql_size_array = $visit_sql_size->getResultArray();
              $visit_size_wise_data = '';
              $visit_size_total_count=0;
              $visit_size_inquiry_count = array();
              $visit_size= array();
              $visit_size_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Unit TYpe</b></p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Total</b></p>
                              </div>
                          </li>';
                      foreach ($visit_sql_size_array as $key => $value) { 
                          $visit_size_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7">'.$value['property_size'].'</p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7"><b>'.$value['total'].'('.round(number_format($value['Percentage'],2,".","."),1).')%</b></p>
                              </div>
                          </li>';
                          $visit_size[] = $value['property_size'];
                          $visit_size_inquiry_count[] = $value['total'];
                          $visit_size_total_count += $value['total']; 
                      }
                      $visit_size_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"></b>Total</b></p>
                          </div>
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"><b>'.$visit_size_total_count.'</b></p>
                          </div>
                      </li>';
                $return_array['visit_size'] = $visit_size;
                $return_array['visit_size_total_count'] = $visit_size_total_count;
                $return_array['visit_size_inquiry_count'] = array_map('intval',$visit_size_inquiry_count);
                $return_array['visit_size_wise_data'] = $visit_size_wise_data;

        //convertation

        if($this->admin == 1){
          if(!empty($from_dates)&& !empty($to_dates) && !empty($project)){
             $booking_query =  'where  STR_TO_DATE(booking_date, "%Y-%m-%d %H:%i:%s")  BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d") AND intrested_site='.$project.' AND inquiry_status = 12';
          }else{
              $booking_query =  'where MONTH(booking_date) = MONTH(CURRENT_DATE()) AND intrested_site='.$project.' AND inquiry_status = 12';   
          }
        }else{
          if(!empty($from_dates)&& !empty($to_dates) && !empty($project)){
              $booking_query =  'where assign_id IN (' . $all_gm_under_people_implode . ') AND STR_TO_DATE(booking_date, "%Y-%m-%d %H:%i:%s")   BETWEEN STR_TO_DATE("'.$from_dates.'", "%Y%c%d") AND STR_TO_DATE("'.$to_dates.'", "%Y%c%d") AND intrested_site='.$project.' AND inquiry_status = 12 '; 
          }else{
              $booking_query =  'where assign_id IN (' . $all_gm_under_people_implode . ') AND MONTH(booking_date) = MONTH(CURRENT_DATE()) AND intrested_site='.$project.' AND inquiry_status = 12'; 
          }  
        }

        $sql_query ='
        SELECT
              CONCAT(budget_range_start, "-", budget_range_end) AS budget_range,
              COUNT(*) AS inquiry_count,
              COUNT(*) / total_count * 100 AS percentage
            FROM (
              SELECT
                FLOOR((budget - 10) / 5) * 5 + 10 AS budget_range_start,
                FLOOR((budget - 10) / 5) * 5 + 14 AS budget_range_end
              FROM '.$this->username.'_all_inquiry
              '.$booking_query.' 
            ) AS ranges
            CROSS JOIN (
              SELECT COUNT(*) AS total_count
              FROM '.$this->username.'_all_inquiry
              '.$booking_query.'  
            ) AS total
            GROUP BY budget_range
            ORDER BY budget_range_start';
            $sql_query = $this->db->query($sql_query);
            $booking_budget_inq_html = $sql_query->getResultArray();
            $booking_budget_html ='';
            $booking_budget_total_count = 0;
            $booking_budget_html .= '<li class="d-flex align-items-center justify-content-between rounded">
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Budget</b></p>
                                    </div>
                                    <div class="col-6 px-3 py-1">
                                        <p class="fs-7 text-white"><b>Total</b></p>
                                    </div>
                                </li>';
                                $booking_budget_range=array();
                                $booking_budget_percentage = array();
                                $booking_budget_inquiry_count = array();
        foreach ($booking_budget_inq_html as $key => $value) {
               $booking_budget_html .= '<li class="d-flex align-items-center justify-content-between">
                  <div class="col-6 px-3 py-1 bg-white">
                      <p class="fs-7">'.$value['budget_range'].'</p>
                  </div>
                  <div class="col-6 px-3 py-1 bg-white">
                      <p class="fs-7">'.$value['inquiry_count'].'('.round(number_format($value['percentage'],2,".","."),1).')%</p>
                  </div>
               </li>';
               $booking_budget_range[] = $value['budget_range'];
               $booking_budget_percentage[] = $value['percentage'];
               $booking_budget_inquiry_count[] = $value['inquiry_count'];
               $booking_budget_total_count += $value['inquiry_count'];           
          
        }
        $booking_budget_html .= '<li class="d-flex align-items-center justify-content-between">
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7"><b>Total</b></p>
                           </div>
                           <div class="col-6 px-3 py-1 bg-white">
                               <p class="fs-7">'.$booking_budget_total_count.'</p>
                           </div>
                        </li>';
                         $return_array['booking_budget_html'] = $booking_budget_html;
        $return_array['booking_budget_inquiry_count'] = array_map('intval',$booking_budget_inquiry_count);
        $return_array['booking_budget_percentage'] = $booking_budget_percentage;
        $return_array['booking_budget_range'] = $booking_budget_range;


         $sql_inq_source = 'SELECT  IFNULL(i.inquiry_source_type, 0) AS inquiry_source_type,
            u.source,
            a.inquiry_source_type,
            COUNT(*) AS total,
            (COUNT(*) / t.total_count) * 100 AS Percentage
              FROM '.$this->username.'_all_inquiry AS i
              LEFT JOIN master_inquiry_source AS u ON u.id = i.inquiry_source_type OR (u.id = 0 AND i.inquiry_source_type IS NULL)
              LEFT JOIN master_inquiry_source_type AS a ON a.id = u.inquiry_source_type
              LEFT JOIN (
                  SELECT COUNT(*) AS total_count
                  FROM '.$this->username.'_all_inquiry AS i
                  LEFT JOIN master_inquiry_source AS u ON u.id = i.inquiry_source_type OR (u.id = 0 AND i.inquiry_source_type IS NULL)
                  LEFT JOIN master_inquiry_source_type AS a ON a.id = u.inquiry_source_type
                  '.$booking_query.'
              ) t ON 1 = 1
              '.$booking_query.'
              GROUP BY i.inquiry_source_type, u.source, a.inquiry_source_type';

              $booking_sql_source = $this->db->query($sql_inq_source);
              $booking_sql_source_array = $booking_sql_source->getResultArray();
              $booking_source_wise_data = '';
              $booking_source_total_count=0;
              $booking_source_inquiry_count = array();
              $booking_source= array();
              $booking_source_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Source</b></p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Total</b></p>
                              </div>
                          </li>';
                      foreach ($booking_sql_source_array as $key => $value) { 
                          $booking_source_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7">'.$value['source'].'</p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7"><b>'.$value['total'].'('.round(number_format($value['Percentage'],2,".","."),1).')%</b></p>
                              </div>
                          </li>';
                          $booking_source[] = $value['source'];
                          $booking_source_inquiry_count[] = $value['total'];
                          $booking_source_total_count += $value['total']; 
                      }
                      $booking_source_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"></b>Total</b></p>
                          </div>
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"><b>'.$booking_source_total_count.'</b></p>
                          </div>
                      </li>';
                $return_array['booking_source'] = $booking_source;
                $return_array['booking_source_total_count'] = $booking_source_total_count;
                $return_array['booking_source_inquiry_count'] = array_map('intval',$booking_source_inquiry_count);
                $return_array['booking_source_wise_data'] = $booking_source_wise_data;

           

              $sql_booking_size = 'SELECT p.property_size, COUNT(*) AS total, (COUNT(*) / t.total_count) * 100 AS Percentage FROM '.$this->username.'_properties AS p INNER JOIN '.$this->username.'_all_inquiry AS i ON p.project_name = i.intrested_site CROSS JOIN ( SELECT COUNT(*) AS total_count FROM '.$this->username.'_properties AS p INNER JOIN '.$this->username.'_all_inquiry AS i ON p.project_name = i.intrested_site '.$booking_query.' AND p.unit_no = i.unit_no ) t '.$booking_query.' AND p.unit_no = i.unit_no GROUP BY p.property_size';

             // pre($sql_booking_size);

              $booking_sql_size = $this->db->query($sql_booking_size);
              $booking_sql_size_array = $booking_sql_size->getResultArray();
              $booking_size_wise_data = '';
              $booking_size_total_count=0;
              $booking_size_inquiry_count = array();
              $booking_size= array();
              $booking_size_wise_data .= '<li class="d-flex align-items-center justify-content-between rounded">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Unit TYpe</b></p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7 text-white"><b>Total</b></p>
                              </div>
                          </li>';
                      foreach ($booking_sql_size_array as $key => $value) { 
                          $booking_size_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7">'.$value['property_size'].'</p>
                              </div>
                              <div class="col-6 px-3 py-1">
                                  <p class="fs-7"><b>'.$value['total'].'('.round(number_format($value['Percentage'],2,".","."),1).')%</b></p>
                              </div>
                          </li>';
                          $booking_size[] = $value['property_size'];
                          $booking_size_inquiry_count[] = $value['total'];
                          $booking_size_total_count += $value['total']; 
                      }
                      $booking_size_wise_data .= '<li class="d-flex align-items-center justify-content-between">
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"></b>Total</b></p>
                          </div>
                          <div class="col-6 px-3 py-1">
                              <p class="fs-7"><b>'.$booking_size_total_count.'</b></p>
                          </div>
                      </li>';
                $return_array['booking_size'] = $booking_size;
                $return_array['booking_size_total_count'] = $booking_size_total_count;
                $return_array['booking_size_inquiry_count'] = array_map('intval',$booking_size_inquiry_count);
                $return_array['booking_size_wise_data'] = $booking_size_wise_data;

                    

        echo json_encode($return_array);
        die();
    }

}
