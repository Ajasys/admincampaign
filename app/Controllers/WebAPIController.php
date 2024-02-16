<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use DateInterval;
use DateTime;
use DateTimeZone;

class WebAPIController extends BaseController
{
    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->db = \Config\Database::connect('second');
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->admin = 0;
        $this->timezone = timezonedata();
    }


    public function web_integrate()
    {
        $conn = \Config\Database::connect('second');

        // $access_token = $this->request->getPost("access_token");
        
        // $name='forammm123';
        // $mobileno='8475965261';
        // $email='for1am@gmail.com';
        // $message='fgjdfhjgf';
        // $access_token='diq3xjSsIT4BHJdcxVQf2VH5XOi94amGTBCkejyXIFWIZ5NBUYmQXAGq9YR5uPFsMFbxqH3aA1649pQqU6ZQL3YYVrVhmJW2QqziHnsOa9WPvwS41sSFpRiXAlrDlvqrxi95gTbSdW3ptWdcaclAUz';

        $access_token = isset($_GET['access_token']) ? $_GET['access_token'] : $_POST['access_token'];
        $name = isset($_GET['name']) ? $_GET['name'] : $_POST['name'];
        $mobileno = isset($_GET['mobileno']) ? $_GET['mobileno'] : $_POST['mobileno'];
        $email = isset($_GET['email']) ? $_GET['email'] : $_POST['email'];
        $message = isset($_GET['description']) ? $_GET['description'] : $_POST['description'];

        if (isset($access_token) && isset($name) && isset($mobileno)) {
            $query = "SELECT * FROM `master_user`";
            $result_page = $conn->query($query);
            $i = 0;
            if ($result_page->getNumRows() > 0) {
                $allRows = $result_page->getResultArray();
                foreach ($allRows as $key => $row) {
                    $query_mater = "SELECT * FROM " . $row['username'] . "_platform_integration where master_id=" . $row['id'] . " AND platform_status=5 AND verification_status=1";
                    $results = $conn->query($query_mater);
                    $rows_data = $results->getResultArray();
                    $rows = $rows_data[0];

                    $page_query_mater = "SELECT * FROM " . $row['username'] . "_fb_pages where connection_id=" . $rows['id'] . "";
                    $page_results = $conn->query($page_query_mater);
                    $page_rows = $page_results->getResultArray();

                    if (isset($name)) {
                        $fulll_name = $name;
                    }
                    if (isset($mobileno)) {
                        $mobile = $mobileno;
                    }
                    if (isset($email)) {
                        $email = $email;
                    }
                    if ($mobile != '') {
                        $mobile_nffo_remove = str_replace(" ", "", $mobile);
                        $mobile_nffo = substr($mobile_nffo_remove, -10);
                    } else {
                        $mobile_nffo = '0000000000';
                    }


                    date_default_timezone_set('UTC');
                    $nxt_follow_up = date('Y-m-d H:i:s');
                    $intrested_site = $page_rows[0]['intrested_product'];

                    //insert lead id first...
                    $insert_inter1['full_name'] = isset($fulll_name) ? $fulll_name : '';
                    $insert_inter1['platform'] = 'website';
                    $insert_inter1['fb_update'] = 0;
                    $insert_inter1['created_time '] = $nxt_follow_up;
                    $insert_inter1['page_id'] = $page_rows[0]['id'];

                    $response_status_log = $this->MasterInformationModel->insert_entry2($insert_inter1, $row['username'] . "_integration");
                    $lead_insertedId = $response_status_log;

                    $cntdata_duplicate_intergration = "SELECT count(*) as count FROM " . $row['username'] . "_integration where phone_number='" . $mobile_nffo . "'";
                    $cntdata_int = $conn->query($cntdata_duplicate_intergration);
                    $rowss = $cntdata_int->getResultArray();
                    
                    $mobile_nffo = "";

                    if ($mobile != '') {
                        $mobile_nffo_remove = str_replace(" ", "", $mobile);
                        $mobile_nffo = substr($mobile_nffo_remove, -10);
                    }
                    $user_list_executive = array();

                    $deer = 'SELECT * FROM ' . $row['username'] . '_integration where unquie_id IN ( SELECT max(unquie_id) FROM ' . $row['username'] . '_integration  where `fb_update` = 1 group by page_id )';
                    $result1 = $conn->query($deer);
                    $assign_id = 0;
                    $user_valuerows = $result1->getResultArray();
                    $count = 0;
                    foreach ($user_valuerows as $key => $user_value) {
                        // if ($user_value['form_id'] == $formId) {
                        $assign_id = $user_value['assign_id'];
                        // }
                    }
                    $next = 1;
                    $cccd = 0;

                    $assignIdsString = $page_rows[0]['id'];
                    $assignIds = explode(',', $assignIdsString);

                    foreach ($assignIds as $k => $v) {
                        if ($intrested_site == $v) {
                            $count = count($assignIds);
                            $search = array_search($assign_id, $assignIds);
                            $next = $assignIds[(1 + $search) % $count];
                            $cccd = 1;
                            break;
                        }
                    }
                    
                    if ($rowss[0]['count'] == 0) {
                        if ($page_rows[0]['status']==1) {
                            $cntdata_duplicate = "SELECT count(*) as count FROM " . $row['username'] . "_all_inquiry where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "'";
                            $cntdata = $conn->query($cntdata_duplicate);
                            $full = $fulll_name;
                            if (!is_numeric($mobile_nffo)) {
                                $full = $mobile_nffo;
                                $mobile_nffo = $fulll_name;
                            }
                            $cntdatas = $cntdata->getResultArray();
                            $insert_data['assign_id'] = $next;
                            $insert_data['owner_id'] = $next;
                            $insert_data['user_id'] = $next;
                            $insert_data['head'] = 2;
                            $insert_data['mobileno'] = !empty($mobile_nffo) ? $mobile_nffo : '';
                            $insert_data['full_name'] =  isset($full) ? $full : '';
                            $insert_data['email'] =  isset($email) ? $email : '';
                            $insert_data['inquiry_description'] =  isset($message) ? $message : '';
                            $insert_data['inquiry_type'] = 1;
                            $insert_data['inquiry_source_type'] = 2;
                            $insert_data['nxt_follow_up'] = isset($nxt_follow_up) ? $nxt_follow_up : '';
                            $insert_data['inquiry_status'] = "1";
                            $insert_data['created_at'] = date('Y-m-d H:i:s');
                            $responce_insert = 0;
                            if ($cntdatas[0]['count'] > 0) {
                                $find_Array_all = "SELECT * FROM " . $row['username'] . "_all_inquiry  where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "'";
                                $find_Array_all = $conn->query($find_Array_all);
                                $satusus_id = array('1', '2', '3', '4', '5', '6', '9', '10', '11', '13');
                                $repo = 0;
                                $isduplicate_all_datasrows = $find_Array_all->getResultArray();
                                foreach ($isduplicate_all_datasrows as $key => $isduplicate_all_datas) {
                                    if (in_array($isduplicate_all_datas['inquiry_status'], $satusus_id)) {
                                        $repo = 1;
                                    }
                                }
                                if ($repo == 0) {
                                    $cntdata_sql = $this->MasterInformationModel->insert_entry2($insert_data, $row['username'] . "_all_inquiry");
                                    if ($cntdata_sql) {
                                        // Get the insert ID
                                        $insertId = $cntdata_sql;
                                        $result['response'] = 1;
                                        $result['message'] = 'inquiry added succesfully !';
                                        if ($insertId) {
                                            $responce_insert = 1;
                                        } else {
                                            $responce_insert = 0;
                                        }
                                    } else {
                                        echo "Error inserting record: " . $conn->error;
                                        $responce_insert = 0;
                                    }
                                } else {
                                    $responce_insert = 0;
                                    $result['response'] = 0;
                                    $result['message'] = 'Something Went Wrong !';
                                }
                            } else {
                                
                                $cntdata_sql = $this->MasterInformationModel->insert_entry2($insert_data, $row['username'] . "_all_inquiry");
                                $insertId = $cntdata_sql;
                                $responce_insert = 1;
                            }

                            if ($responce_insert == 1) {
                                $fb_update = 1;
                                $next_assignId = $next;
                            } else {
                                $fb_update = 0;
                                $next_assignId = 0;
                            }

                            $update_sql = "UPDATE " . $row['username'] . "_integration SET 
                                    phone_number = '" . (!empty($mobile_nffo) ? $mobile_nffo : '') . "',
                                    fb_update = '" . $fb_update . "',
                                    assign_id = '" . $next_assignId . "',
                                    lead_status = 1,
                                    inquiry_id = '" . $insertId . "'
                                    WHERE unquie_id = '" . $lead_insertedId . "'";

                            $updatedata = $conn->query($update_sql);

                            $result['response'] = 1;
                            $result['message'] = 'Your data has been inserted successfully.. !';
                        } else {
                            $update_sql = "UPDATE " . $row['username'] . "_integration SET 
                                    phone_number = '" . (!empty($mobile_nffo) ? $mobile_nffo : '') . "',
                                    fb_update = 2,
                                    lead_status = 2
                                    WHERE unquie_id = '" . $lead_insertedId . "'";
                            $updatedata = $conn->query($update_sql);

                            $result['response'] = 1;
                            $result['message'] = 'Your data has been inserted successfully.. !';
                        }
                    } else {
                        $update_integrate = $conn->query("SELECT * FROM " . $row['username'] . "_all_inquiry where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "' ORDER BY id DESC limit 1");
                        $update_integrate_all = $update_integrate->getResultArray();
                        if ($update_integrate->getNumRows() != 0) {
                            //duplicated code but dismissed
                            if ($update_integrate_all[0]['inquiry_status'] == 7) {
                                //reopen inquiry
                                $fb_update = 4;
                                $next_assignId = $next;
                                $insert_data['assign_id'] = $next;
                                $insert_data['owner_id'] = $next;
                                $insert_data['user_id'] = $next;
                                $insert_data['head'] = 2;
                                $insert_data['mobileno'] = !empty($mobile_nffo) ? $mobile_nffo : '';
                                $insert_data['full_name'] =  isset($fulll_name) ? $fulll_name : '';
                                $insert_data['email'] =  isset($email) ? $email : '';
                                $insert_data['inquiry_description'] =  isset($message) ? $message : '';
                                $insert_data['inquiry_type'] = 1;
                                $insert_data['inquiry_source_type'] = 2;
                                $insert_data['nxt_follow_up'] = isset($nxt_follow_up) ? $nxt_follow_up : '';
                                $insert_data['inquiry_status'] = "1";
                                $insert_data['created_at'] = date('Y-m-d H:i:s');
                                $cntdata_sql = $this->MasterInformationModel->insert_entry2($insert_data, $row['username'] . "_all_inquiry");
                                if ($cntdata_sql) {
                                    $insertId = $cntdata_sql;
                                } else {
                                    echo "Error inserting record: " . $conn->error;
                                    $responce_insert = 0;
                                }
                            } else {
                                //duplicated for
                                $fb_update = 3;
                                $insertId = '';
                                $next_assignId = 0;
                            }

                            $update_sql = "UPDATE " . $row['username'] . "_integration SET 
                                    phone_number = '" . (!empty($mobile_nffo) ? $mobile_nffo : '') . "',
                                    fb_update = '" . $fb_update . "',
                                    assign_id = '" . $next_assignId . "',
                                    lead_status = 1,
                                    inquiry_id = '" . $insertId . "'
                                    WHERE unquie_id = '" . $lead_insertedId . "'";

                            $updatedata = $conn->query($update_sql);
                        }
                    }
                    $i++;
                }
            } else {
                echo "0 results";
            }
        }
    }
}
