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

        // $name = 'Foram123';
        // $mobileno = '9977995586';
        // $email = 'foram@gmail.com';
        // $message = 'fgjdfhjgf';
        // $access_token = 'diq3xjSsIT4BHJdcxVQf2VH5XOi94amGTBCkejyXIFWIZ5NBUYmQXAGq9YR5uPFsMFbxqH3aA1649pQqU6ZQL3YYVrVhmJW2QqziHnsOa9WPvwS41sSFpRiXAlrDlvqrxi95gTbSdW3ptWdcaclAUz';
        $access_token='';
        $name = '';
        $mobileno = '';
        $email = '';
        $message = '';
        if(isset($_GET['access_token']))
        {
            $access_token = $_GET['access_token'];
        }
        else if(isset($_POST['access_token']))
        {
            $access_token = $_POST['access_token'];
        }
        else if(isset($_REQUEST['access_token']))
        {
            $access_token = $_REQUEST['access_token'];
        }

        if(isset($_GET['name']))
        {
            $name = $_GET['name'];
        }
        else if(isset($_POST['name']))
        {
            $name = $_POST['name'];
        }
        else if(isset($_REQUEST['name']))
        {
            $name = $_REQUEST['name'];
        }

        if(isset($_GET['mobileno']))
        {
            $mobileno = $_GET['mobileno'];
        }
        else if(isset($_POST['mobileno']))
        {
            $mobileno = $_POST['mobileno'];
        }
        else if(isset($_REQUEST['mobileno']))
        {
            $mobileno = $_REQUEST['mobileno'];
        }

        if(isset($_GET['email']))
        {
            $email = $_GET['email'];
        }
        else if(isset($_POST['email']))
        {
            $email = $_POST['email'];
        }
        else if(isset($_REQUEST['email']))
        {
            $email = $_REQUEST['email'];
        }

        if(isset($_GET['description']))
        {
            $message = $_GET['description'];
        }
        else if(isset($_POST['description']))
        {
            $message = $_POST['description'];
        }
        else if(isset($_REQUEST['description']))
        {
            $message = $_REQUEST['description'];
        }
        // $access_token = isset($_GET['access_token']) ? $_GET['access_token'] : $_POST['access_token'];
        // $name = isset($_GET['name']) ? $_GET['name'] : $_POST['name'];
        // $mobileno = isset($_GET['mobileno']) ? $_GET['mobileno'] : $_POST['mobileno'];
        // $email = isset($_GET['email']) ? $_GET['email'] : $_POST['email'];
        // $message = isset($_GET['description']) ? $_GET['description'] : $_POST['description'];


        // $access_token = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : '';
        // $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        // $mobileno = isset($_REQUEST['mobileno']) ? $_REQUEST['mobileno'] : '';
        // $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        // $message = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';

        if (isset($access_token)) {
            if (isset($access_token) && isset($name) && isset($mobileno)) {
                $query = "SELECT * FROM `master_user`";
                $result_page = $conn->query($query);
                $i = 0;
                if ($result_page->getNumRows() > 0) {
                    $allRows = $result_page->getResultArray();
                    $response = 0;
                    $message = 'Something went wrong..!';
                    foreach ($allRows as $key => $row) {
                        if ($conn->tableExists($row['username'] . "_platform_integration")) {
                        } else {
                            $table_name3 = $row['username'] . '_platform_integration';
                            $columns3 = [
                                'id int primary key AUTO_INCREMENT',
                                'master_id int(11) NOT NULL',
                                "phone_number_id varchar(400) NOT NULL",
                                "business_account_id varchar(400) NOT NULL",
                                "access_token longtext NOT NULL",
                                "whatsapp_name longtext NOT NULL",
                                "whatsapp_number varchar(400)",
                                "fb_app_id text NOT NULL",
                                'fb_app_name varchar(200)',
                                'fb_app_type varchar(200)',
                                'from_email varchar(200)',
                                'smtp_port int(11)',
                                'smtp_host varchar(200)',
                                'smtp_user varchar(200)',
                                'smtp_password varchar(200)',
                                'smtp_crypto varchar(200)',
                                'mail_cc varchar(200)',
                                'email_radio int(11)',
                                'email_from varchar(200)',
                                'website_name varchar(255)',
                                "verification_status int(10) NOT NULL DEFAULT 0 COMMENT '0-Pending & 1-Approved & 3-Rejected'",
                                "platform_status int NOT NULL DEFAULT 0 COMMENT '0-nothing & 1-whatsapp & 2-facebook & 3-Email & 4-Linkedin & 5-website'",
                            ];
                            $table3 = tableCreateAndTableUpdate2($table_name3, '', $columns3);
                        }
                        $query_mater = "SELECT * FROM " . $row['username'] . "_platform_integration where master_id=" . $row['id'] . " AND platform_status=5 AND verification_status=1";
                        $results = $conn->query($query_mater);
                        $rows_data = $results->getResultArray();
                        if (!empty($rows_data)) {
                            $rows = (object) $rows_data[0];
                            if ($conn->tableExists($row['username'] . "_fb_pages")) {
                            } else {
                                $fb_table = $row['username'] . '_fb_pages';
                                $fb_column = [
                                    'id int(11) primary key AUTO_INCREMENT NOT NULL',
                                    'connection_id int(11) NOT NULL',
                                    'page_id varchar(250)  NOT NULL',
                                    'page_name varchar(250)  NOT NULL',
                                    'page_access_token longtext  NOT NULL',
                                    'master_id int(11) NOT NULL',
                                    'intrested_area varchar(11)  NOT NULL',
                                    'property_sub_type varchar(11)  NOT NULL',
                                    'intrested_product varchar(11)  NOT NULL',
                                    'user_id varchar(11)  NOT NULL',
                                    'status int(255) NOT NULL DEFAULT 1',
                                    'form_id varchar(255)  NOT NULL',
                                    'form_name varchar(255)  NOT NULL',
                                    'page_img longtext  NOT NULL',
                                    'is_status smallint(1) NOT NULL DEFAULT 0  COMMENT \'0-fresh connection,1-deleted,2-old connection,3-draft connection,4-lost connection\''
                                ];
                                $fbtable = tableCreateAndTableUpdate2($fb_table, '', $fb_column);
                            }
                            $page_query_mater = "SELECT * FROM " . $row['username'] . "_fb_pages where connection_id=" . $rows->id . "";
                            $page_results = $conn->query($page_query_mater);
                            $page_rows = $page_results->getResultArray();
                            if (!empty($page_rows)) {
                                $page_rows = (object) $page_rows[0];
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
                                $intrested_site = $page_rows->intrested_product;
                                //insert lead id first...
                                $insert_inter1['full_name'] = isset($fulll_name) ? $fulll_name : '';
                                $insert_inter1['platform'] = 'website';
                                $insert_inter1['fb_update'] = 0;
                                $insert_inter1['created_time '] = $nxt_follow_up;
                                $insert_inter1['page_id'] = $page_rows->id;
                                if ($conn->tableExists($row['username'] . "_integration")) {
                                } else {
                                    $integration_table = $row['username'] . '_integration';
                                    $integration_columns = [
                                        'unquie_id int(11) primary key AUTO_INCREMENT NOT NULL',
                                        'lead_id varchar(255)   NOT NULL',
                                        'inquiry_id varchar(255)   NOT NULL',
                                        'campaign_id varchar(255)   NOT NULL',
                                        'campaign_name varchar(255)   NOT NULL',
                                        'adset_id varchar(255)   NOT NULL',
                                        'adset_name varchar(255)   NOT NULL',
                                        'ad_id varchar(255)   NOT NULL',
                                        'ad_name varchar(255)   NOT NULL',
                                        'form_id varchar(255)   NOT NULL',
                                        'form_name varchar(255)   NOT NULL',
                                        'platform varchar(255)   NOT NULL',
                                        'full_name varchar(255)   NOT NULL',
                                        'phone_number varchar(255)   NOT NULL',
                                        'page_id varchar(255)   NOT NULL',
                                        'id int(11) NOT NULL',
                                        'fb_update int(11) NOT NULL DEFAULT 0',
                                        'assign_id int(11) NOT NULL DEFAULT 0',
                                        'lead_status int(11) NOT NULL DEFAULT 0',
                                        'created_time varchar(255)   NOT NULL',
                                        'lead_details text   NOT NULL',
                                    ];
                                    $inttable = tableCreateAndTableUpdate2($integration_table, '', $integration_columns);
                                }
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
                                if ($page_rows->user_id == 0) {
                                    $user_child = []; // Initialize the array
                                    $user_parent = []; // Initialize the array
                                    $sitewisechild = "SELECT t1.id AS child_id, t1.parent_id AS parent_id FROM  " . $row['username'] . "_userrole t1 LEFT JOIN " . $row['username'] . "_userrole t2 ON t1.id = t2.parent_id WHERE t2.parent_id IS NULL";
                                    $cntdatas = $conn->query($sitewisechild);
                                    foreach ($cntdatas->getResultArray() as $v) {
                                        $user_child[] = $v['child_id'];
                                        $user_parent[] = $v['parent_id'];
                                    }
                                    $user_list_executive = array();
                                    if (isset($user_child) && !empty($user_child)) {
                                        $sitewiseexecutive = "SELECT * FROM " . $row['username'] . "_user where switcher_active ='active' AND role IN (" . implode(",", $user_child) . ")";
                                        $cntdata_exe = $conn->query($sitewiseexecutive);
                                        foreach ($cntdata_exe->getResultArray() as $v_e) {
                                            // if (!empty($v_e['job_location_id'])) {
                                            $user_list_executive[$v_e['job_location_id']][] = $v_e['id'];
                                            // }
                                        }
                                    }
                                    $user_list_manager = []; // Initialize the array
                                    if (isset($user_parent) && !empty($user_parent)) {
                                        $sitewisemanager = "SELECT * FROM " . $row['username'] . "_user where switcher_active ='active' AND role IN (" . implode(",", $user_parent) . ") ";
                                        $cntdatas_manger = $conn->query($sitewisemanager);
                                        foreach ($cntdatas_manger->getResultArray() as $v_m) {
                                            // if (!empty($v_m['job_location_id'])) {
                                            $user_list_manager[$v_m['job_location_id']][] = $v_m['id'];
                                            // }
                                        }
                                    }
                                    $deer = 'SELECT * FROM ' . $row['username'] . '_integration where unquie_id IN ( SELECT max(unquie_id) FROM ' . $row['username'] . '_integration  where `fb_update` = 1 group by page_id )';
                                    $result1 = $conn->query($deer);
                                    $assign_id = 0;
                                    $user_valuerows = $result1->getResultArray();
                                    foreach ($user_valuerows as $key => $user_value) {
                                        // if ($user_value['form_id'] == $formId) {
                                        $assign_id = $user_value['assign_id'];
                                        // }
                                    }
                                    $next = 1;
                                    $cccd = 0;
                                    foreach ($user_list_executive as $k => $v) {
                                        // if ($intrested_site == $k) {
                                        $count = count($v);
                                        $values = array_values($v);
                                        $search = array_search($assign_id, $values);
                                        $next = $values[(1 + $search) % count($values)];
                                        $cccd = 1;
                                        // }
                                    }
                                    if ($cccd == 0) {
                                        foreach ($user_list_manager as $k_m => $v_m) {
                                            // if ($intrested_site == $k_m) {
                                            $count = count($v_m);
                                            $values = array_values($v_m);
                                            $search = array_search($assign_id, $values);
                                            $next = $values[(1 + $search) % count($values)];
                                            $cccd = 1;
                                            // }
                                        }
                                    }
                                    // pre($values);
                                    // pre($next);
                                } else {
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
                                    $assignIdsString = $page_rows->id;
                                    $assignIds = explode(',', $assignIdsString);
                                    foreach ($assignIds as $k => $v) {
                                        // if ($intrested_site == $v) {
                                        $count = count($assignIds);
                                        $search = array_search($assign_id, $assignIds);
                                        $next = $assignIds[(1 + $search) % $count];
                                        $cccd = 1;
                                        break;
                                        // }
                                    }
                                }
                                if ($rowss[0]['count'] == 0) {
                                    if ($page_rows->status == 1) {
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
                                        $insert_data['inquiry_source_type'] = 3;
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
                                                    $response = 1;
                                                    $message = 'inquiry added succesfully !';
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
                                                $response = 0;
                                                $message = 'Something Went Wrong !';
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
                                        $response = 1;
                                        $message = 'Your data has been inserted successfully.. !';
                                        break;
                                    } else {
                                        $update_sql = "UPDATE " . $row['username'] . "_integration SET 
                                            phone_number = '" . (!empty($mobile_nffo) ? $mobile_nffo : '') . "',
                                            fb_update = 2,
                                            lead_status = 2
                                            WHERE unquie_id = '" . $lead_insertedId . "'";
                                        $updatedata = $conn->query($update_sql);
                                        $response = 1;
                                        $message = 'Your data has been inserted successfully.. !';
                                        break;
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
                                            $insert_data['inquiry_source_type'] = 3;
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
                                        $response = 1;
                                        $message = 'Your data has been inserted successfully.. !';
                                        break;
                                    }
                                }
                            } else {
                                $response = 0;
                                $message = 'Please connet your website with crm..!';
                            }
                        } else {
                            $response = 0;
                            $message = 'Please connet your website with crm..!';
                        }
                        $i++;
                    }
                } else {
                    $response = 0;
                    $message = 'Something went wrong..!';
                }
            } else {
                $response = 0;
                $message = 'Please enter required field..!';
            }
        } else {
            $response = 0;
            $message = 'Please enter your authorization token..!';
        }
        $result = [];
        if ($response == 1) {
            $result['success'] = ['status' => true, 'message' => $message];
        } else {
            $result['error'] = ['status' => false, 'message' => $message];
        }
        return json_encode($result);
    }
}
