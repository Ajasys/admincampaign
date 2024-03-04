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

        $access_token = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : (isset($_POST['access_token']) ? $_POST['access_token'] : null);
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : (isset($_POST['name']) ? $_POST['name'] : null);
        $mobileno = isset($_REQUEST['mobileno']) ? $_REQUEST['mobileno'] : (isset($_POST['mobileno']) ? $_POST['mobileno'] : null);
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : (isset($_POST['email']) ? $_POST['email'] : null);
        $message = isset($_REQUEST['description']) ? $_REQUEST['description'] : (isset($_POST['description']) ? $_POST['description'] : null);

        if ($access_token === null) {
            $response = 0;
            $message = 'Please enter your authorization token..!';
        } else {
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
                                        // break;
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
                $message = 'Please enter all required field..!';
            }
        }

        $result = [];
        if ($response == 1) {
            $result['success'] = ['status' => true, 'message' => $message];
        } else {
            $result['error'] = ['status' => false, 'message' => $message];
        }
        return json_encode($result);
    }


    public function web_bot_integrate()
	{
		$conn = \Config\Database::connect('second');
        // $access_token = '023jWOaMvvq5JFRPidv1lFHxorrv8ew4c93oca3ha1TR5sj67DI4zKnVdybsGqydhRtHVhA5pejpiCbxE05knjpKJNVzAad1AH07gB4ncWAHJGhQ4nEbm8IHJch2KVGZhoN9KlqO4wnCGfrFW0yfOE';
		
		$access_token = isset($_REQUEST['access_token']) ? $_REQUEST['access_token'] : (isset($_POST['access_token']) ? $_POST['access_token'] : null);
      
		$html= '';
	
        if ($access_token === null) {
			
            $response = 0;
            $message = 'Please enter your authorization token..!';
        } else {
            if (isset($access_token)) {
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
                        // if (!empty($rows_data)) {
                        //     $rows = (object) $rows_data[0];

							
						// 	$table = $_POST['table'];
						// 	$bot_id = $_POST['bot_id'];
						// 	$sequence = $_POST['sequence'];
						// 	$html = '';
							
						// 	if(isset($_POST['answer'])){
						// 		$answer = $_POST['answer'];
						// 	}
							
						// 	if (isset($_POST['nextQuestion']) && $_POST['nextQuestion'] != "true") {
						// 		$nextQuestion = $_POST['nextQuestion'];
						// 		// pre($nextQuestion);
						// 	}
	
							
						// 	if (isset($_POST['next_question_id'])) {
						// 		$next_questions = $_POST['next_questions'];
						// 	}
	
						// 	if (isset($_POST['next_question_id'])) {
						// 		$next_question_id = $_POST['next_question_id'];
						// 	}
						// 	if ($sequence == 1 || isset($_POST['fetch_first_record'])) {
								
						// 		$sql = 'SELECT * FROM admin_bot_setup WHERE bot_id = ' . $bot_id . ' ORDER BY sequence LIMIT 1';
						
						// 		$sequence = 1;
						// 		// pre($sql);
						// 		$result = $conn->query($sql);
						// 		$bot_chat_data = $result->getResultArray();
						// 	} else {
						// 		$sequence = isset($result) ? 1 : $sequence - 1;
								
						// 		if (isset($_POST['next_questions']) && $_POST['next_questions'] != "undefined" && $_POST['next_questions'] != "" && $_POST['next_questions'] != "0" && $_POST['next_questions'] != "0,0") {
						// 			$sql = 'SELECT * FROM ' . $table . ' WHERE  id = ' . $_POST['next_questions'] . ' ORDER BY sequence';
						// 			// pre($sql);
						// 			// $nextQuestionsStr = implode(',', $_POST['next_questions']);
						// 			// $sql = 'SELECT * FROM ' . $table . ' WHERE bot_id = ' . $bot_id . ' AND sequence = ' . $sequence . ' OR type_of_question IN (' . $_POST['next_questions'] . ') ORDER BY sequence';
						// 			// pre($sql);
						// 		}else {
						// 			$sql = 'SELECT * FROM ' . $table . ' WHERE  bot_id = ' . $bot_id . ' AND sequence = ' . $sequence . ' ORDER BY sequence';
						// 		}
	
								
						// 		// Execute query
						// 		$result = $conn->query($sql);
						// 		$bot_chat_data = $result->getResultArray();
							
						// 		// Retrieve parent-child data
						// 		$sql_parent_child = 'SELECT parent.id AS parent_id, child.id AS child_id, child.question, parent.answer
						// 			FROM admin_bot_setup AS child
						// 			JOIN admin_bot_setup AS parent ON child.type_of_question = parent.next_question_id
						// 			WHERE parent.bot_id = ' . $bot_id . '
						// 			ORDER BY parent.sequence LIMIT 1;';
						// 		// pre($sql_parent_child);
						// 		$resultss_ss = $conn->query($sql_parent_child);
						// 		$bot_chat_data_ss = $resultss_ss->getResultArray();
						// 	}
	
						// 	$bot_chat_data_ss = !empty($bot_chat_data_ss) ? $bot_chat_data_ss : '';
						// 	$html = '';
						// 	$last_que_id = 0;
						// 	$bot_chat_data_ss_index = 0;
							
							
						// 	if (!empty($bot_chat_data)) {
								
						// 		foreach ($bot_chat_data as $value) {									
	
						// 			if(isset($_POST['answer'])){
						// 				$value['answer'] = $_POST['answer'];
						// 				// pre($value['answer']);
						// 			}
						// 			// pre($value['answer']);
						// 			if (isset($bot_chat_data_ss[$bot_chat_data_ss_index]['parent_id']) && $last_que_id == $bot_chat_data_ss[$bot_chat_data_ss_index]['parent_id']) {
						// 				$sql_child = 'SELECT * FROM ' . $table . ' WHERE id = ' . $bot_chat_data_ss[$bot_chat_data_ss_index]['child_id'] . ' ';
						// 				$fss = $conn->query($sql_child);
						// 				$asasasf = $fss->getResultArray();
						// 				$test_pr_que = $asasasf[0]['question'];
						// 				$test = $value['question'];
						// 				$bot_chat_data_ss_index++;
						// 			} else {
						// 				$test_pr_que = '';
						// 				$test = $value['question'];
						// 			}
						// 			// pre($test);
						// 			$last_que_id = $value['id'];
						// 			// continue;
						// 			if (isset($test_pr_que) && !empty($test_pr_que)) {
						// 				$html .= '<div class="messege1 d-flex flex-wrap conversion_id" data-next_bot_id="'.$value['next_bot_id'].'" data-next_questions="'.$value['next_questions'].'" data-next_question_id="'.$value['next_question_id'].'" data-conversation-id="' . $asasasf[0]['id'] . '" data-sequence="' . $asasasf[0]['sequence'] . '">
						// 							<div class="me-2 border rounded-circle overflow-hidden" style="width:35px;height:35px">
						// 								<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
						// 							</div>';
	
						// 				$html .= '<div class="col">
						// 								<div class="col-12 mb-2">
						// 									<span class="p-1 rounded-3 d-inline-block bg-white px-3 conversion_id" data-sequence="'.$asasasf[0]['sequence'].'" data-conversation-id="' . $asasasf[0]['id'] . '">
						// 										' . $test_pr_que . '
						// 									</span>';
						// 				if ($asasasf[0]['type_of_question'] == 1 && $asasasf[0]['skip_question'] == 1) {
						// 					$html .= '<div class="col-12 mb-2 mt-1">
						// 													<button class="btn bg-primary rounded-3 text-white skip_questioned">
						// 														Skip
						// 													</button>
						// 												</div>';
						// 				} else {
						// 					$html .= '<div class="col-12 mb-2 mt-1" hidden>
						// 													<button class="btn bg-primary rounded-3 text-white skip_questioned">
						// 														Skip
						// 													</button>
						// 												</div>';
						// 				}
						// 				$html .= '</div>				
						// 				</div>
						// 				';
						// 			}
	
						// 			if ($sequence == 1 || isset($_POST['fetch_first_record'])) {
						// 				$html .= '
						// 				<div class="messege2 d-flex flex-wrap mt-2 ds">
						// 					<div class="col ">';
	
										
						// 					if ($value['answer'] != '' ) {
						// 						// pre($value['answer']);
						// 						$html .= '<div class="col-12 mb-2 text-end">
						// 													<span class="p-2 rounded-3 text-white d-inline-block bg-secondary px-3">
						// 													' . $_POST['answer'] . '
						// 													</span>
						// 												</div>
						// 											</div>
						// 											<div class="border  rounded-circle overflow-hidden ms-2" style="width:35px;height:35px">
						// 												<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
						// 											</div>
						// 										</div>';
						// 							// pre($html);			
						// 					}
						// 				$html .= '<div class="messege1 d-flex flex-wrap conversion_id" data-next_bot_id="'.$value['next_bot_id'].'" data-next_questions="'.$value['next_questions'].'" data-next_question_id="'.$value['next_question_id'].'" data-conversation-id="' . $value['id'] . '" data-sequence="' . $value['sequence'] . '">
						// 							<div class="me-2 border rounded-circle overflow-hidden" style="width:35px;height:35px">
						// 								<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
						// 							</div>';
										
						// 				$html .= '<div class="col">
						// 								<div class="col-12 mb-2">
						// 									<span class="p-1 rounded-3 d-inline-block bg-white px-3 conversion_id" data-sequence="'.$value['sequence'].'" data-conversation-id="' . $value['id'] . '">
						// 										' . $value['question'] . '
						// 									</span>';
	
						// 									if (!empty($value['menu_message']) && $value['type_of_question'] == 2) {
						// 										$menuOptions = json_decode($value['menu_message'], true);
										
						// 										if (isset($menuOptions['options_value']['options'])) {
						// 											$options = explode(';', $menuOptions['options_value']['options']);
						// 											$nextQuestionsArray = explode(',', $value['next_questions']);
										
						// 											foreach ($options as $index => $option) {
						// 												$nextQuestion = isset($nextQuestionsArray[$index]) ? $nextQuestionsArray[$index] : '';
						// 												// pre($nextQuestion);
						// 												$html .= '<div class="col-12 mb-2 mt-2 option-wrapper">
						// 															<button class="btn bg-primary rounded-3 text-white option-button" data-next_questions="' . $nextQuestion . '" onclick="selectOption(this, \'' . $option . '\')">' . $option . '</button>
						// 														</div>';
						// 											}
						// 										}
						// 									}
	
						// 				if ($value['type_of_question'] == 1 && $value['skip_question'] == 1) {
						// 					$html .= '<div class="col-12 mb-2 mt-1">
						// 													<button class="btn bg-primary rounded-3 text-white skip_questioned">
						// 														Skip
						// 													</button>
						// 												</div>';
						// 				}
						// 				else{
						// 					$html .= '<div class="col-12 mb-2 mt-1" hidden>
						// 													<button class="btn bg-primary rounded-3 text-white skip_questioned">
						// 														Skip
						// 													</button>
						// 												</div>';
						// 				}
						// 				$html .= '</div>				
						// 				</div>
						// 				';
	
	
						// 				if($value['type_of_question'] == "40" || $value['type_of_question'] == "42"){
						// 						$menu_list_Data = json_decode($value['menu_message'], true);
						// 						if(isset($menu_list_Data['options_value']['options'])){
						// 							$optionsArray = explode(';', $menu_list_Data['options_value']['options']);
						// 							foreach ($optionsArray as $option) {
						// 								$html .= '
						// 								<div class="col-12">
						// 									<button class="btn bg-primary rounded-3 text-white col-6 my-1" onclick="selectOption(this, \'' . $option . '\')">
						// 									'.$option.'
						// 									</button>
						// 								</div>';
						// 							}
						// 						}
						// 				}
	
						// 				$html .= '<script>
													
						// 							function selectOption(button, value) {
						// 								$(".answer_chat").val(value); 
						// 								var nextQuestion = $(button).data("next_questions");
						// 								console.log("Next Question:", nextQuestion); 
														
						// 								insertAnswer(nextQuestion);
						// 							}
	
						// 						</script>';
						// 			} else {
	
						// 				$html .= '
						// 				<div class="messege2 d-flex flex-wrap mt-2 ds">
						// 					<div class="col ">';
	
										
						// 					if ($value['answer'] != '' ) {
						// 						// pre($value['answer']);
						// 						$html .= '<div class="col-12 mb-2 text-end">
						// 													<span class="p-2 rounded-3 text-white d-inline-block bg-secondary px-3">
						// 													' . $_POST['answer'] . '
						// 													</span>
						// 												</div>
						// 											</div>
						// 											<div class="border  rounded-circle overflow-hidden ms-2" style="width:35px;height:35px">
						// 												<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
						// 											</div>
						// 										</div>';
						// 							// pre($html);			
						// 					}
	
						// 				$html .= '<div class="messege1 d-flex flex-wrap conversion_id" data-next_bot_id="'.$value['next_bot_id'].'" data-next_questions="'.$value['next_questions'].'" data-next_question_id="'.$value['next_question_id'].'" data-conversation-id="' . $value['id'] . '" data-sequence="' . $value['sequence'] . '">
						// 							<div class="me-2 border rounded-circle overflow-hidden" style="width:35px;height:35px">
						// 								<img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
						// 							</div>';
	
	
						// 				if ($value['type_of_question'] == "16") {
						// 					$buttonData = json_decode($value['menu_message'], true);
	
						// 					if (isset($buttonData['button_text']) && isset($buttonData['button_url'])) {
						// 						$buttonText = $buttonData['button_text'];
						// 						$buttonUrl = $buttonData['button_url'];
	
						// 						$html .= '<div class="col ">
						// 												<div class="col-12 mb-2">
						// 													<span class="p-2 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 														' . $value['question'] . '
						// 														<div class="col-12 text-center my-1">
						// 															<a href="' . $buttonUrl . '" type="button" class="btn-primary" data-id="59" data-type_of_question="1">' . $buttonText . '</a>
						// 														</div>
						// 													</span>
						// 												</div>';
						// 					}
											
						// 				} else if ($value['type_of_question'] == "17") {
						// 					// pre($value['type_of_question']);
						// 					$formData = json_decode($value['menu_message'], true);
											
						// 					$html .= '<div class="col">
						// 								<div class="col-12 mb-2">
						// 									<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 										' . $value['question'] . '
						// 									</span>
						// 								</div>
						// 								<div class="col-10 px-2 form_fill">
						// 									<form action="" class="col-12 text-center shadow-lg border bg-white p-2 rounded-3">';
	
						// 					if (isset($formData['questions'])) {
						// 						// pre($formData['questions']);
						// 						foreach ($formData['questions'] as $question) {
						// 							if ($question['type'] == 'Question') {
						// 								$html .= '<div class="col-10 my-2 mx-auto">
						// 											<textarea class="form-control main-control text_value" cols="3" rows="3" placeholder="' . $question['text'] . '"></textarea>
						// 										</div>';
						// 							} elseif ($question['type'] == 'Dropdown') {
						// 								$html .= '<div class="col-10 my-2 mx-auto">
						// 											<select class="form-select form-select-sm mt-2 address_value" aria-label="Small select example">';
						// 								if (!empty($question['options'])) {
						// 									$options = explode(',', $question['options']);
						// 									foreach ($options as $option) {
						// 										$html .= '<option value="' . $option . '">' . $option . '</option>';
						// 									}
						// 								}
						// 								$html .= '</select></div>';
						// 							}
						// 						}
						// 					}
										
						// 					$html .= '<button class="btn bg-primary rounded-3 text-white skip_questioned hide_skip_btn my-2" onclick="formvalue()">Submit</button>
						// 							</form>
						// 						</div>';
	
						// 				} else if ($value['type_of_question'] == "18") {
						// 					$formData = json_decode($value['menu_message'], true);
						// 					$imageSrc = isset($formData[0]['fileInput']) ? base_url('') . '/assets/bot_image/' . $formData[0]['fileInput'] : 'https://custpostimages.s3.ap-south-1.amazonaws.com/18280/1708079256055.png';
						// 					$questionText = isset($formData[0]['questionText']) ? $formData[0]['questionText'] : '';
						// 					$html .= '<div class="col">
						// 								<div class="col-12 mb-2">
						// 									<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 										' . $value['question'] . '
						// 									</span>
						// 								</div>
						// 								<div class="col-12 text-center">
						// 									<div class="position-relative bg-white border rounded-3 overflow-hidden" style="width:200px;height:200px">
						// 										<img src="' . $imageSrc . '" alt="" class="w-100 h-100 opacity-50">
						// 										<div class="position-absolute bottom-0 start-50 translate-middle mb-2 col-12 px-3">
						// 											<button class="btn-primary col-12" onclick="choose_item(this, \'' . $questionText . '\')">' . $questionText . '</button>
						// 										</div>
						// 									</div>
						// 								</div>
						// 							</div>';
	
						// 						}  else if ($value['type_of_question'] == "8") {
						// 							$datepickerData = json_decode($value['menu_message'], true);
						// 							// pre($value['type_of_question'] == "8");
													
						// 							$html .= '<div class="col">
						// 										<div class="col-12 mb-2">
						// 											<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 												' . $value['question'] . '
						// 											</span>
						// 										</div>';
							
						// 										if (
						// 											isset($datepickerData['date_range']) &&
						// 											isset($datepickerData['period']) &&
						// 											isset($datepickerData['weekdays']) &&
						// 											isset($datepickerData['date_output_format'])
						// 										) {
						// 											$dateRange = $datepickerData['date_range'];
						// 											$period = $datepickerData['period'];
						// 											$weekdays = json_encode($datepickerData['weekdays']);
						// 											list($start_date_str, $end_date_str) = $dateRange;
																
						// 											// Check if period is empty
						// 											if (empty($period)) {
						// 												// Set future_days and past_days to 0
						// 												$future_days = 0;
						// 												$past_days = 0;
						// 											} else {
						// 												$future_days = $period[0];
						// 												$past_days = $period[1];
						// 											}
																	
																	
						// 											$start_date = \DateTime::createFromFormat('Y-m-d', $start_date_str);
						// 											$end_date = \DateTime::createFromFormat('Y-m-d', $end_date_str);
						// 											// pre($start_date);
						// 											if ($start_date === false || $end_date === false) {
						// 												echo "Error: Unable to parse date strings.";
						// 											} else {
						// 												$start_date->modify("-$future_days days");
						// 												$end_date->modify("+$past_days days");
																
						// 												$start_date_iso = $start_date->format('Y-m-d');
						// 												$end_date_iso = $end_date->format('Y-m-d');
																
						// 												$interval = $start_date->diff($end_date);
						// 												$num_days = $interval->days;
							
						// 							$html .= ' <div class="container">
						// 										<div class="row d-flex justify-content" style="position: relative; box-shadow:rgba(70, 93, 239, 0.34) 0px 3px 15px; width:400px" >
						// 										<div class="col-12 d-flex overflow-hidden" id="calender-month" style="padding:0px !important">
						// 											<div class="col-12 month-content active" id="january-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">January <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="january"></ul>
						// 											</div>
						// 											<div class="col-12 month-content" id="february-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">February<div class="month-cal" id="year-date"> &nbsp;2024	</div></h4>
						// 											<ul class="days" id="february"></ul>
						// 											</div>
																							
						// 											<div class="col-12 month-content" id="march-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">March <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="march"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="april-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">April<div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="april"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="may-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">May <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="may"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="june-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">June <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="june"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="july-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">July <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="july"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="august-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">August <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="august"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="september-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">September<div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="september"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="october-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">October <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="october"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="november-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">November<div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="november"></ul>
						// 											</div>
															
						// 											<div class="col-12 month-content" id="december-content">
						// 											<h4 class="d-flex justify-content-center" style="margin-bottom:10px;">December <div class="month-cal" id="year-date"> &nbsp;2024</div></h4>
						// 											<ul class="days" id="december"></ul>
						// 											</div>
						// 											</div>
																	
						// 											<div class="col-12" style="margin-top:30px;">
						// 												<ul id="yearSelect" style="display:none;">
						// 												</ul>
						// 											</div>
																	
																
						// 											<button class="btn btn-primary d-flex justify-content-center align-items-center prev-btn" style="position:absolute; top:0px; left0px; width:33px; height:33px;"><</button>
						// 											<button class="btn btn-primary d-flex justify-content-center align-items-center next-btn" style="position:absolute; top:0px; right:0px; width:33px; height:33px;">></button>
						// 											</div>
						// 											</div>';
							
																	
																	
									
						// 									$html .= '<script>
						// 									$(document).ready(function() {
							
						// 										function daysInMonth(month, year) {
						// 											return new Date(year, month + 1, 0).getDate();
						// 										}
															
						// 										var weekdays = '.$weekdays.';
														
						// 										function generateDays(monthId, month, year) {
						// 											const daysCount = daysInMonth(month, year);
						// 											const firstDay = new Date(year, month, 1).getDay();
						// 											const ul = $("#" + monthId);
						// 											ul.empty();
														
						// 											const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
						// 											daysOfWeek.forEach(function(day) {
						// 												ul.append("<li>" + day + "</li>");
						// 											});
														
						// 											for (let i = 0; i < firstDay; i++) {
						// 												ul.append("<li></li>");
						// 											}
														
						// 											const startDate = new Date("'. $start_date_iso .'");
						// 											const endDate = new Date("'. $end_date_iso .'");
														
						// 											for (let i = 1; i <= daysCount; i++) {
						// 												const currentDate = new Date(year, month, i);
						// 												const currentDay = currentDate.toLocaleDateString("en-US", { weekday: "short" }).toUpperCase();
														
						// 												// Check if period is empty
						// 												if (' . (empty($period) ? "true" : "false") . ') {
						// 													// Only consider dates within the range of start_date and end_date
						// 													if (currentDate >= startDate && currentDate <= endDate) {
						// 														ul.append("<li class=\"day-time\">" + i + "</li>");
						// 													} else {
						// 														ul.append("<li class=\"disabled\">" + i + "</li>");
						// 													}
						// 												} else {
						// 													// Consider weekdays and the range of start_date and end_date
						// 													if (weekdays.includes(currentDay)) {
						// 														if (currentDate >= startDate && currentDate <= endDate) {
						// 															ul.append("<li class=\"day-time\">" + i + "</li>");
						// 														} else {
						// 															ul.append("<li class=\"disabled\">" + i + "</li>");
						// 														}
						// 													} else {
						// 														ul.append("<li class=\"disabled\">" + i + "</li>");
						// 													}
						// 												}
	
						// 											}
						// 										}
																
						// 										function generateCalendar(year) {
						// 											for (let i = 0; i < 12; i++) {
						// 												generateDays(getMonthId(i), i, year);
						// 											}
						// 										}
															
						// 										function getMonthId(monthIndex) {
						// 											const months = ["january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"];
						// 											return months[monthIndex];
						// 										}
															
						// 										function populateYearSelect() {
						// 											const startYear = 2001;
						// 											const endYear = 2090;
						// 											const select = $("#yearSelect");
																
						// 											for (let year = startYear; year <= endYear; year++) {
						// 												select.append("<li>" + year + "</li>");
						// 											}
						// 										}
															
						// 										populateYearSelect();
						// 										generateCalendar(new Date().getFullYear());
															
						// 										$(".month-content").not("#january-content").hide();
															
						// 										$(".month-cal").click(function() {
						// 											$(".month-content").addClass("d-none");
						// 											$("#yearSelect").show();
						// 										});
															
						// 										$(".prev-btn").click(function() {
						// 											const currentMonth = $(".month-content:visible");
						// 											currentMonth.hide();
						// 											const prevMonth = currentMonth.prev().length ? currentMonth.prev() : $(".month-content").last();
						// 											prevMonth.show();
						// 										});
															
						// 										$(".next-btn").click(function() {
						// 											const currentMonth = $(".month-content:visible");
						// 											currentMonth.hide();
						// 											const nextMonth = currentMonth.next().length ? currentMonth.next() : $(".month-content").first();
						// 											nextMonth.show();
						// 										});
															
						// 										$(document).on("click", "#yearSelect li", function() {
						// 											const selectedYear = $(this).text();
						// 											generateCalendar(selectedYear);
						// 											$("#yearSelect").hide();
						// 											$(".month-cal").text(selectedYear);
						// 											$(".month-content").removeClass("d-none");
						// 										});
															
						// 										$(document).on("click", ".days li", function() {
						// 											$(this).addClass("color");
						// 											$(this).siblings("li").removeClass("color");
						// 										});
																
						// 										$(document).on("click", ".day-time", function () {
						// 											var day = $(this).text();
						// 											var month = $(this).closest(".month-content").attr("id").split("-")[0];
						// 											var year = $("#year-date").text();
							
						// 											$(".answer_chat").val(day + " " + month + year);
						// 										});
															
						// 										$(document).on("click", "#yearSelect li", function() {
						// 											const selectedYear = $(this).text();
						// 											generateCalendar(selectedYear);
						// 											$("#yearSelect").hide();
						// 											$(".month").text($(".month").text().replace(/\d{4}/, ""));
						// 											$(".month-content").removeClass("d-none");
						// 										});
						// 									});
							
							
															
						// 									</script>';
						// 								}
						// 							}
						// 						} else if($value['type_of_question'] == "23"){
	
						// 					$html .= '<div class="col">
															
						// 									<div class="shadow-lg rounded-4 border p-4 bg-white d-flex justify-content-center">
						// 										<div class="col-10">
						// 											<div>
						// 												<span>' . $value['question'] . '</span>
						// 											</div>';
												
						// 											$urlnavigatroData = json_decode($value['menu_message'], true);
	
						// 											if (isset($urlnavigatroData[0]['url_navigator_select'])) {									
																	
						// 												$html .= '<div class="d-flex flex-wrap mt-2">';
						// 												foreach ($urlnavigatroData as $data) {
						// 													$imageName = $data['url_navigator_select'];
						// 													if($imageName == "Facebook"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/facebook-b1c48260.svg";
						// 													}else if($imageName == "Instagram"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/instagram-b79de51b.svg";
						// 													}else if($imageName == "Twitter"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/twiter-5c5e8b47.svg";
						// 													}else if($imageName == "Linkedin"){
																			
						// 													}else if($imageName == "Youtube"){
																			
						// 													}else if($imageName == "Messenger"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/messanger-a053b50d.svg";
						// 													}else if($imageName == "Google_Plus"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/twiter-5c5e8b47.svg";
						// 													}else if($imageName == "Call"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/call-cb6467cb.svg";
						// 													}else if($imageName == "Whatsapp"){
																				
						// 													}else if($imageName == "URL"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/link-4ffb5844.svg";
						// 													}else if($imageName == "Refresh_chat"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/reload-ec94a148.svg";
						// 													}else if($imageName == "close_Chat"){
						// 														$imageSrc = "https://www.page.smatbot.com/assets/delete-0612a90c.svg";
						// 													}
																			
						// 													$html .= '<div class="me-2 text-center">
						// 																<a href="' . $data['url_link'] . '" class="d-block">
						// 																	<img src="' . $imageSrc . '" alt="#" style="width:30px;height:30px" class="rounded-circle">
						// 																	<p class="text-dark">' . $data['url_text'] . '</p>
						// 																</a>
						// 															</div>';
						// 												}
																	
						// 												$html .= '</div></div></div>';
						// 											}												
	
						// 						$html .= '<div class="shadow-lg"></div>';
												
						// 					// }
						// 				} else if($value['type_of_question'] == "24"){
						// 					$formData = json_decode($value['menu_message'], true);
						// 					$html .= '<div class="col">
						// 								<div class="col-12 mb-2">
						// 									<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 										' . $value['question'] . '
						// 									</span>
						// 								</div>';
											
						// 					$product_image = isset($formData[0]['product_image']) ? base_url('') . '/assets/bot_image/' . $formData[0]['product_image'] : 'https://custpostimages.s3.ap-south-1.amazonaws.com/18280/1708079256055.png';
						// 					$product_title = isset($formData[0]['product_title']) ? $formData[0]['product_title'] : '';
						// 					$product_button_text = isset($formData[0]['product_button_text']) ? $formData[0]['product_button_text'] : '';
						// 					$product_description = isset($formData[0]['product_description']) ? $formData[0]['product_description'] : '';
						// 					$product_button_url = isset($formData[0]['product_button_url']) ? $formData[0]['product_button_url'] : '';
						// 					$product_url = isset($formData[0]['product_url']) ? $formData[0]['product_url'] : '';
	
						// 					if(isset($formData[0]['product_image']) || isset($formData[0]['product_button_text'])){
						// 						$html .= '
						// 									<div class="col-12 text-center">
						// 										<div class="position-relative bg-white border rounded-3 overflow-hidden" style="width:200px;height:200px">
						// 											<img src="' . $product_image . '" alt="" class="w-100 h-100 opacity-50">
						// 											<div class="position-absolute bottom-0 start-50 translate-middle  col-12 px-3">
						// 												<a href="'.$product_url.'" class="d-block text-start ms-4 text-dark">' . $product_title . '</a>
						// 												<a href="'.$product_url.'" class="d-block mb-2 text-start ms-4 text-dark">' . $product_description . '</a>
						// 												<a href="'.$product_button_url.'" class="btn-primary col-12">' . $product_button_text . '</a>
						// 											</div>
						// 										</div>
						// 									</div>
						// 								</div>';
						// 					}
						// 				}else if($value['type_of_question'] == "25"){
						// 					$html .= '<div class="col">
						// 								<div class="col-12 mb-2">
						// 									<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 										' . $value['question'] . '
						// 									</span>
						// 								</div>';
	
						// 					$carouselData = json_decode($value['menu_message'], true);
						// 					$carousel_image = isset($carouselData[0]['carousel_image']) ? base_url('') . '/assets/bot_image/' . $carouselData[0]['carousel_image'] : 'https://custpostimages.s3.ap-south-1.amazonaws.com/18280/1708079256055.png';
						// 					if(isset($carouselData[0]['carousel_image'])){
						// 						$html .= '<div class="col-12 text-center">
						// 										<div class="position-relative bg-white border rounded-3 overflow-hidden" style="width:200px;height:200px">
						// 											<img src="' . $carousel_image . '" alt="" class="w-100 h-100 opacity-50 skip_questioned">
						// 										</div>
						// 									</div>
						// 								</div>';
						// 					}	
						// 				}else if ($value['type_of_question'] == "27") {
						// 					$contactsData = json_decode($value['menu_message'], true);
						// 					$html .= '<div class="bg-white p-2 position-absolute tabel_div top-0 bottom-0 start-0 end-0 m-auto rounded-2 overflow-x-scroll d-none" style="width: max-content; height: 200px;">
						// 								<div class="d-flex justify-content-end close_btn">
						// 									<i class="bi bi-x fs-3 m-0 p-0" style="cursor: pointer;"></i>
						// 								</div>
						// 								<table class="w-100">
						// 									<tr class="border p-2 rounded-2">
						// 										<th class="border p-2">Name</th>
						// 										<th class="border p-2">Contact(s)</th>
						// 									</tr>';
										
						// 					foreach ($contactsData as $contact) {
						// 						$html .= '<tr class="border p-2 rounded-2">
						// 									<td class="border p-2">' . $contact['contact_name'] . '</td>
						// 									<td class="border p-2">' . $contact['contact_number'] . '</td>
						// 								</tr>';
						// 					}
												
						// 					$html .= '</table>
						// 							</div> 
						// 							<div class="col ">
						// 								<div class="col-12 mb-2">
						// 									<span class="p-2 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 										' . $value['question'] . '
						// 										<div class="col-12 text-center my-1">
						// 										<button type="button" class="btn btn-primary enter_show" >
						// 											Show Contacts
						// 										</button>
						// 										</div>
						// 									</span>
						// 								</div>';
	
						// 				}else if ($value['type_of_question'] == "29") {
						// 					$html .= '<div class="col">
						// 									<div class="col-12 mb-2">
						// 										<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 											' . $value['question'] . '
						// 										</span>
						// 									';
						// 						$fileData = json_decode($value['menu_message'], true);
						// 						if(isset($fileData['file_upload'])){
						// 							$html .= '<a href="'.$fileData['file_upload'].'">' . $fileData['file_upload'] . '</a>
						// 							</div>';
						// 						}
						// 				}
						// 				else if($value['type_of_question'] == "30"){
						// 					$url_redirect_Data = json_decode($value['menu_message'], true);
						// 					$url_reditrect = isset($url_redirect_Data['redirect_url']) ? $url_redirect_Data['redirect_url'] : '';
										
						// 					$html .= '<div class="col">
						// 											<div class="col-12 mb-2">
						// 												<a href="'.$url_reditrect.'" class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id text-dark" data-conversation-id="' . $value['id'] . '">
						// 													' . $value['question'] . '
						// 												</a>
						// 											</div>';
																	
						// 				}else if($value['type_of_question'] == "40" || $value['type_of_question'] == "42"){
						// 					$html .= '<div class="col">
						// 									<div class="col-12 mb-2">
						// 										<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 											' . $value['question'] . '
						// 										</span>
						// 									';
	
						// 						$menu_list_Data = json_decode($value['menu_message'], true);
												
						// 						if(isset($menu_list_Data['options_value']['options'])){
						// 							$optionsArray = explode(';', $menu_list_Data['options_value']['options']);
						// 							foreach ($optionsArray as $option) {
						// 								$html .= '
						// 								<div class="col-12">
						// 									<button class="btn bg-primary rounded-3 text-white col-6 my-1" onclick="selectOption(this, \'' . $option . '\')">
						// 									'.$option.'
						// 									</button>
						// 								</div>';
						// 							}
						// 						}
						// 				}
										
						// 				else {
										
						// 					$html .= '<div class="col">
						// 											<div class="col-12 mb-2">
						// 												<span class="p-1 rounded-3 ghg d-inline-block bg-white px-3 conversion_id" data-conversation-id="' . $value['id'] . '">
						// 													' . $value['question'] . '
						// 												</span>
						// 											</div>';
																	
						// 				}
	
						// 				if (($value['type_of_question'] == 6 && $value['skip_question'] == 1) || ($value['type_of_question'] == 10 && $value['skip_question'] == 1) || ($value['type_of_question'] == 11 && $value['skip_question'] == 1) || ($value['type_of_question'] == 12 && $value['skip_question'] == 1) || ($value['type_of_question'] == 13 && $value['skip_question'] == 1) || ($value['type_of_question'] == 14 && $value['skip_question'] == 1)) {
						// 					$html .= '<div class="col-12 mb-2">
						// 												<button class="btn bg-primary rounded-3 text-white skip_questioned hide_skip_btn">
						// 													Skip
						// 												</button>
						// 											</div>';
						// 				}
	
	
						// 				$menuOptions = json_decode($value['menu_message'], true);
						// 				if (isset($menuOptions['rating_type']) && $menuOptions['rating_type'] === "smilies") {
						// 					// Output the HTML snippet for smilies
						// 					$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
						// 									<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
						// 										<div class="text-center pt-4">Please rate</div>
						// 											<div class="d-flex text-center justify-content-center mt-2 pb-3 px-2">
															
						// 												<div class="col-2 mb-2 option-wrapper">
						// 													<button class="bg-transparent fs-14" onclick="rating(this, \'Great\')" style="border:none !important; font-size:25px !important">😍</button>
						// 												</div>
						// 												<div class="col-2 mb-2 option-wrapper">
						// 													<button class="bg-transparent fs-14" onclick="rating(this, \'Good\')" style="border:none !important; font-size:25px !important">😃</button>
						// 												</div>
						// 												<div class="col-2 mb-2 option-wrapper">
						// 													<button class="bg-transparent fs-14" onclick="rating(this, \'Okay\')" style="border:none !important; font-size:25px !important">😊</button>
						// 												</div>
						// 												<div class="col-2 mb-2 option-wrapper">
						// 													<button class="bg-transparent fs-14" onclick="rating(this, \'Sad\')" style="border:none !important; font-size:25px !important">😞</button>
						// 												</div>
						// 												<div class="col-2 mb-2 option-wrapper">
						// 													<button class="bg-transparent fs-14" onclick="rating(this, \'Bad\')" style="border:none !important; font-size:25px !important">😪</button>
						// 												</div>
						// 											</div>
						// 										</div>
						// 									</div>
						// 								</div>';
						// 				} else if (isset($menuOptions['rating_type']) == "stars") {
						// 					$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
						// 										<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
						// 											<div class="text-center pt-4">Please rate</div>
						// 												<div class="d-flex text-center justify-content-center mt-2 pb-3 px-2">
						// 													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Great\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star "></i></button>
						// 													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Good\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star "></i></button>
						// 													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Okay\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star "></i></button>
						// 													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Sad\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star"></i></button>
						// 													<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'Bad\')" style="border:none !important; font-size:25px !important"><i class="fa-regular fa-star"></i></button>
						// 												</div>
																	
						// 											</div>';
						// 				} else if (isset($menuOptions['rating_type']) == "numbers") {
						// 					$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
						// 									<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
						// 										<div class="text-center pt-4">Please rate</div>
						// 											<div class="d-flex text-center justify-content-center mt-2 pb-3 px-2">
						// 												<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'1\')" style="border:none !important; font-size:25px !important">1</button>
						// 												<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'2\')" style="border:none !important; font-size:25px !important">2</button>
						// 												<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'3\')" style="border:none !important; font-size:25px !important">3</button>
						// 												<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'4\')" style="border:none !important; font-size:25px !important">4</button>
						// 												<button class="bg-transparent px-2 fs-3" onclick="rating(this, \'5\')" style="border:none !important; font-size:25px !important">5</button>
						// 											</div>  
						// 										</div>';
						// 				} else if (isset($menuOptions['rating_type']) == "options") {
						// 					$html .= '<div class="col-7 mx-5 mt-5 rounded-3" style="box-shadow: 0 0 5px 2px lightgray; position: relative;">
						// 									<div class="bg-secondary p-2 rounded-circle" style="width:35px; height:35px; position: absolute; left: 45%; top:-18px;"><i class="fa-regular fa-star text-light"></i></div>
						// 										<div class="text-center pt-4">Please rate</div>
						// 										<div class=" mt-2 pb-3 px-2">
						// 											<div class="px-2 "><i class="fa-regular fa-circle"></i> Terrible (1 Star)</div>
						// 											<div class="px-2 "><i class="fa-regular fa-circle"></i> Bad (1 Star)</div>
						// 											<div class="px-2 "><i class="fa-regular fa-circle"></i> Okay (1 Star)</div>
						// 											<div class="px-2 "><i class="fa-regular fa-circle"></i> Good (1 Star)</div>
						// 											<div class="px-2"><i class="fa-regular fa-circle"></i> Great (1 Star)</div>
						// 										</div>  
						// 									</div>';
						// 				} else {
						// 				}
	
						// 				if (!empty($value['menu_message']) && $value['type_of_question'] == 2) {
						// 					$menuOptions = json_decode($value['menu_message'], true);
											
											
						// 					if (isset($menuOptions['options_value']['options'])) {
						// 						$options = explode(';', $menuOptions['options_value']['options']);
						// 						$nextQuestionsArray = explode(',', $value['next_questions']);
	
						// 						foreach ($options as $index => $option) {
						// 							$nextQuestion = isset($nextQuestionsArray[$index]) ? $nextQuestionsArray[$index] : '';
						// 							// pre($nextQuestion);
						// 							$html .= '<div class="col-12 mb-2 mt-2 option-wrapper">
						// 										<button class="btn bg-primary rounded-3 text-white option-button" data-next_questions="' . $nextQuestion . '" onclick="selectOption(this, \'' . $option . '\')">' . $option . '</button>
						// 									</div>';
						// 						}
						// 					}
						// 				}
										
										
						// 				if (!empty($value['menu_message']) && $value['type_of_question'] == 4) {
						// 					$menuOptions = json_decode($value['menu_message'], true);
	
						// 					if (isset($menuOptions['options'])) {
						// 						$options = explode(';', $menuOptions['options']);
						// 						$html .= '<div class="col-12 mb-2 option-wrapper">';
						// 						foreach ($options as $option) {
						// 							$html .= '<div class="col-12 d-flex flex-wrap align-items-end chat_again_continue my-1">
						// 													<div class="d-inline-block px-3 py-2 col-6 btn-secondary rounded-3 mx-2">
						// 														<div class="col-12">
						// 															<input type="checkbox" class="me-2 main-form option-check rounded-circle" value="' . $option . '">' . $option . '
						// 														</div>
						// 													</div>
						// 												</div>';
						// 						}
						// 						$html .= '<div class="col-6 text-center mt-2 mx-2">
						// 												<button class="text-white btn bg-primary col-12" onclick="submitOptions()">Submit</button>
						// 											</div>
						// 										</div>';
						// 					}
						// 				}
	
						// 				$html .= '</div>';
						// 				$html .= '<script>
													
						// 							function selectOption(button, value) {
						// 								$(".answer_chat").val(value); 
						// 								var nextQuestion = $(button).data("next_questions");
						// 								console.log("Next Question:", nextQuestion); 
														
						// 								insertAnswer(nextQuestion);
						// 							}
	
						// 							function submitOptions() {
						// 								var selectedOptions = [];
						// 								$(".option-check:checked").each(function() {
						// 									selectedOptions.push($(this).val());
						// 								});
						// 								var selectedOptionsString = selectedOptions.join(" , "); 
						// 								$(".answer_chat").val(selectedOptionsString);
						// 								insertAnswer();
						// 							}
						// 							function rating(button, value) {
						// 								$(".answer_chat").val(value);
						// 								insertAnswer();
						// 							}
						// 							function formvalue() {
						// 								var textareaValue = $(".text_value").val();
						// 								var selectedOption = $(".address_value").val();
						// 								$(".answer_chat").val(textareaValue);
						// 								insertAnswer();
						// 								$(".answer_chat").val(selectedOption);
						// 								insertAnswer();
						// 							}
						// 							function choose_item(button, value){
						// 								$(".answer_chat").val(value); 
						// 								insertAnswer();
						// 							}
						// 						</script>';
												
													
						// 			}
						// 		}
								
						// 	}
							
						// }

                        if (!empty($rows_data)) {
                            $sql = 'SELECT * FROM admin_bot_setup';
                            $result = $conn->query($sql);
							$bot_chat_data = $result->getResultArray();
                            // pre($bot_chat_data);
                            foreach ($bot_chat_data as $value) {
                                $response = 1;
                                $message = 'Question Send sussefully !';
                            }
                        }

					}
				
				}
			}
		}


        $result = [];
        if ($response == 1) {
            $result['success'] = ['status' => true, 'message' => $message,'question' => $value['question']];
        } else {
            $result['error'] = ['status' => false, 'message' => $message];
        }
        return json_encode($result);

	}
}
