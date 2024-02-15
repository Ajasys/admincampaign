<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use DateInterval;
use DateTime;
use DateTimeZone;

class WebController extends BaseController
{
    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->db = \Config\Database::connect('second');
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = session_username($_SESSION["username"]);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }


    public function web_integrate()
    {
        $conn = \Config\Database::connect('second');

        $access_token = $this->request->getPost("access_token");
        $name = $this->request->getPost("name");
        $mobileno = $this->request->getPost("mobileno");
        $email = $this->request->getPost("email");
        $message = $this->request->getPost("message");

        echo $access_token;
        if (isset($access_token) && isset($name) && isset($mobileno)) {
            $query = "SELECT * FROM `master_user`";
            $result_page = $conn->query($query);
            $i = 0;
            if ($result_page->getNumRows() > 0) {
                $allRows = $result_page->getResultArray();
                foreach ($allRows as $key => $row) {

                    echo $query_mater = "SELECT * FROM " . $row['username'] . "_platform_integration where master_id=" . $row['id'] . " AND platform_status=5 AND verification_status=1";
                    $results = $conn->query($query_mater);
                    $rows = $results->getResultArray();

                    $fulll_name = "";
                    if (isset($name)) {
                        $fulll_name = $name;
                    }
                    $mobile = '';
                    if (isset($mobileno)) {
                        $mobile = $mobileno;
                    }
                    $email = "";
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
                    $intrested_site = $row['intrested_site'];

                    //insert lead id first...
                    $insert_inter1['full_name'] = isset($fulll_name) ? $fulll_name : '';
                    $insert_inter1['phone_number'] = !empty($mobile_nffo) ? $mobile_nffo : '';
                    $insert_inter1['platform'] = 'website';
                    $insert_inter1['fb_update'] = 0;
                    $insert_inter1['created_time '] = $nxt_follow_up;
                    $insert_inter1['page_id'] = $row['id'];

                    $response_status_log = $this->MasterInformationModel->insert_entry($insert_inter1, $row['username'] . "_integration");
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

                    if ($row['user_id'] == 0) {
                        $user_child = array();
                        $user_parent = array();
                        $sitewisechild = "SELECT t1.id AS child_id, t1.parent_id AS parent_id FROM  " . $row['username'] . "_userrole t1 LEFT JOIN " . $row['username'] . "_userrole t2 ON t1.id = t2.parent_id WHERE t2.parent_id IS NULL";
                        $cntdatas = $conn->query($sitewisechild);
                        $vChild = $cntdatas->getResultArray();
                        foreach ($vChild as $key => $v) {
                            $user_child[] = $v['child_id'];
                            $user_parent[] = $v['parent_id'];
                        }
                        $user_list_executive = array();
                        if (isset($user_child) && !empty($user_child)) {
                            $sitewiseexecutive = "SELECT * FROM " . $row['username'] . "_user where switcher_active ='active' AND role IN (" . implode(",", $user_child) . ")";
                            $cntdata_exe = $conn->query($sitewiseexecutive);
                            $v_edata = $cntdata_exe->getResultArray();
                            foreach ($vChild as $key => $v_e) {
                                if (!empty($v_e['job_location_id'])) {
                                    $user_list_executive[$v_e['job_location_id']][] = $v_e['id'];
                                }
                            }
                        }
                        if (isset($user_parent) && !empty($user_parent)) {
                            $sitewisemanager = "SELECT * FROM " . $row['username'] . "_user where switcher_active ='active' AND role  IN (" . implode(",", $user_parent) . ") ";
                            $cntdatas_manger = $conn->query($sitewisemanager);
                            $v_mdata = $cntdatas_manger->getResultArray();
                            foreach ($v_mdata as $key => $v_m) {
                                if (!empty($v_m['job_location_id'])) {
                                    $user_list_manager[$v_m['job_location_id']][] = $v_m['id'];
                                }
                            }
                        }
                        $deer = 'SELECT * FROM ' . $row['username'] . '_integration where unquie_id IN ( SELECT max(unquie_id) FROM ' . $row['username'] . '_integration  where `fb_update` = 1 group by form_id )';
                        $result1 = $conn->query($deer);
                        $assign_id = 0;
                        $user_valuedata = $result1->getResultArray();
                        foreach ($user_valuedata as $key => $user_value) {
                            // if ($user_value['form_id'] == $formId) {
                            $assign_id = $user_value['assign_id'];
                            // }
                        }
                        $next = 1;
                        $cccd = 0;
                        foreach ($user_list_executive as $k => $v) {
                            if ($intrested_site == $k) {
                                $count = count($v);
                                $values = array_values($v);
                                $search = array_search($assign_id, $values);
                                $next = $values[(1 + $search) % count($values)];
                                $cccd = 1;
                            }
                        }
                        if ($cccd == 0) {
                            foreach ($user_list_manager as $k_m => $v_m) {
                                if ($intrested_site == $k_m) {
                                    $count = count($v_m);
                                    $values = array_values($v_m);
                                    $search = array_search($assign_id, $values);
                                    $next = $values[(1 + $search) % count($values)];
                                    $cccd = 1;
                                }
                            }
                        }
                    } else {
                        $deer = 'SELECT * FROM ' . $row['username'] . '_integration where unquie_id IN ( SELECT max(unquie_id) FROM ' . $row['username'] . '_integration  where `fb_update` = 1 group by form_id )';
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

                        $assignIdsString = $row['user_id'];
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
                    }

                    if ($rowss['count']  == 0) {
                        if ($row['status'] == 1) {
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
                            if ($cntdatas['count'] > 0) {
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
                                    $cntdata_sql = $this->MasterInformationModel->insert_entry($insert_data, $row['username'] . "_all_inquiry");
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
                                $cntdata_sql = $this->MasterInformationModel->insert_entry($insert_data, $row['username'] . "_all_inquiry");
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
                                    fb_update = '" . $fb_update . "',
                                    assign_id = '" . $next_assignId . "',
                                    lead_status = 1,
                                    inquiry_id = '" . $insertId . "'
                                    WHERE unquie_id = '" . $lead_insertedId . "'";

                            $updatedata = $conn->query($update_sql);
                        } else {
                            $update_sql = "UPDATE " . $row['username'] . "_integration SET 
                                    fb_update = 2,
                                    lead_status = 2
                                    WHERE unquie_id = '" . $lead_insertedId . "'";
                            $updatedata = $conn->query($update_sql);
                        }
                    } else {
                        $update_integrate = $conn->query("SELECT * FROM " . $row['username'] . "_all_inquiry where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "' ORDER BY id DESC limit 1");
                        $update_integrate_all = $update_integrate->getResultArray();
                        if ($update_integrate->getNumRows() != 0) {
                            //duplicated code but dismissed
                            if ($update_integrate_all['inquiry_status'] == 7) {
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
                                $cntdata_sql = $this->MasterInformationModel->insert_entry($insert_data, $row['username'] . "_all_inquiry");
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

    public function add_website_connection()
    {
        $action = $this->request->getPost("action");
        $access_token = $this->request->getPost("access_token");
        $website_name = $this->request->getPost("website_name");

        $result_array = array(); // Initialize $result_array here

        if (isset($website_name) && isset($access_token)) {
            $query = "SELECT * FROM " . $this->username . "_platform_integration WHERE website_name='" . $website_name . "' AND platform_status=5";
            $int_rows = $this->db->query($query);
            $int_result = $int_rows->getResult();
            if (isset($int_result[0])) {
                $int_data = get_object_vars($int_result[0]);
                if ($int_data['verification_status'] == 1) {
                    $result_array['response'] = 2;
                    $result_array['message'] = $int_data['website_name'] . ' website connection already exists..!';
                }
            } else {
                $insert_data['master_id'] = $_SESSION['master'];
                $insert_data['access_token'] = $access_token;
                $insert_data['website_name'] = $website_name;
                $insert_data['verification_status'] = 1;
                $insert_data['platform_status'] = 5;
                $departmentUpdatedata = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . '_platform_integration');
                $result_array['response'] = 1;
                $result_array['message'] = $website_name . ' website connected successfully..!';
            }
        } else {
            $result_array['response'] = 1;
            $result_array['message'] = 'Please add all required field..!';
        }

        echo json_encode($result_array, true);
        die();
    }

    //Listing website connection list..
    public function website_connection_list()
    {
        $this->db = \Config\Database::connect('second');
        $username = session_username($_SESSION['username']);
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
        $ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';

        // Calculate the offset based on pagination parameters
        $offset = ($pageNumber - 1) * $perPageCount;

        // Build the SQL query for data retrieval
        $find_Array_data = "SELECT * FROM " . $username . "_platform_integration 
                            WHERE platform_status=5 ";

        // Add search condition if ajaxsearch is provided
        if (!empty($ajaxsearch)) {
            $find_Array_data .= " AND (
                website_name LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                access_token LIKE '%" . $_POST['ajaxsearch'] . "%'
            ) ";
        }


        $find_Array_data .= " ORDER BY id DESC 
                             LIMIT $perPageCount OFFSET $offset";

        // Execute the query for data retrieval
        $find_Array_data = $this->db->query($find_Array_data);
        $data = $find_Array_data->getResultArray();


        // Build the SQL query for total count
        $find_Array_count = "SELECT COUNT(*) as total_count FROM " . $username . "_platform_integration 
                            WHERE platform_status=5";

        // Add search condition if ajaxsearch is provided
        if (!empty($ajaxsearch)) {
            $find_Array_count .= " AND (
                website_name LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                access_token LIKE '%" . $_POST['ajaxsearch'] . "%' 
            ) ";
        }

        // Execute the query for total count
        $count_result = $this->db->query($find_Array_count);
        $rowCount = $count_result->getRow()->total_count;

        // Calculate pagination details
        $start_entries = $offset + 1;
        $last_entries = min($offset + $perPageCount, $rowCount);

        // Calculate total pages
        $pagesCount = ceil($rowCount / $perPageCount);

        // Generate HTML for data
        if ($find_Array_data->getNumRows() > 0) {
            foreach ($data as $key => $value) {
                $html .= '<tr>
                <td class="p-2 text-nowrap">' . $value['website_name'] . '</td>
                <td class="p-2 text-nowrap"><p style="width: 300px;overflow: hidden;text-overflow: ellipsis;">' . $value['access_token'] . '</p></td>
                <td class="p-2 text-nowrap">';
                if ($value['verification_status'] == 1) {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Success">connect</span>';
                } else {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Error">Disconnect</span>';
                }
                $html .=  '</td>
                    <td class="p-2 text-nowrap text-center">
                        <i class="fa-solid fa-trash-can text-danger px-2" onclick="deletewebsiteconn(' . $value['id'] . ');"></i>
                    </td>
                </tr>';
            }
        }

        // Set response values
        $return_array['row_count_html'] = 'Showing ' . $start_entries . ' to ' . $last_entries . ' of ' . $rowCount . ' entries';
        $return_array['rowCount'] = $rowCount;
        $return_array['html'] = $html;
        $return_array['total_page'] = $pagesCount;
        $return_array['response'] = 1;

        echo json_encode($return_array);
    }

    //Delete connections..
    public function delete_website_connection()
    {
        $return_array['response'] = 0;
        if (isset($_POST['id'])) {
            $delete_data = $this->MasterInformationModel->delete_entry2($this->username . "_platform_integration", $_POST['id']);
            $update_data = $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `is_status`=4 WHERE connection_id=' . $_POST['id']);

            if ($delete_data && $update_data) {
                $return_array['response'] = 1;
            }
        }
        echo json_encode($return_array);
    }

    //Submit page ,form and other details.
    function website_connectionpage()
    {
        $this->db = \Config\Database::connect('second');
        $action = $this->request->getPost("action");
        $connection_id = $this->request->getPost("connection_id");
        $connection_name = $this->request->getPost("connection_name");
        $int_product = $this->request->getPost("int_product") ? $this->request->getPost("int_product") : 0;
        $sub_type = $this->request->getPost("sub_type") ? $this->request->getPost("sub_type") : 0;
        if ($this->request->getPost("assign_to") == 1) {
            $assign_to = "'" . $this->request->getPost("staff_to") . "'";
        } else {
            $assign_to = $this->request->getPost("assign_to") ? $this->request->getPost("assign_to") : 0;
        }

        $is_status = $this->request->getPost("is_status") ? $this->request->getPost("is_status") : 0;
        $query = $this->db->query("SELECT * FROM ".$this->username."_fb_pages where connection_id=" . $connection_id . "");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        $result_array = array();
        if (!empty($action) && $action == "page") {
            if ($count_num == 0) {
                $insert_data['master_id'] = $_SESSION['master'];
                $insert_data['connection_id'] = $connection_id;
                $insert_data['property_sub_type'] = $sub_type;
                $insert_data['intrested_product'] = $int_product;
                $insert_data['user_id'] = $assign_to;
                $insert_data['is_status'] = $is_status;
                $response_status_log = $this->MasterInformationModel->insert_entry2($insert_data, $this->username.'_fb_pages');
                $result_array['id'] = $response_status_log;
               
            } else {
                if ($result_facebook_data[0]['is_status'] == 0) {
                    //is_status==0-for fresh to connection
                    $this->db->query('UPDATE '.$this->username.'_fb_pages SET `intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ' WHERE connection_id=' . $connection_id . '');
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $connection_name . " re-connect successfully";
                } else if ($result_facebook_data[0]['is_status'] == 1) {
                    //is_status==1-for delete to connection
                    $this->db->query('UPDATE '.$this->username.'_fb_pages SET `is_status`=0 WHERE connection_id=' . $connection_id . '');
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $connection_name . " re-connect successfully";
                } else if ($result_facebook_data[0]['is_status'] == 3) {
                    //is_status==0-for draft to connection
                    $this->db->query('UPDATE '.$this->username.'_fb_pages SET `intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ',`is_status`=' . $is_status . ' WHERE connection_id=' . $connection_id . '');
                
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $connection_name . " connection successfully";
                } else if ($this->request->getPost("edit_id") == $result_facebook_data[0]['id'] && ($is_status == 3)) {
                    //is_status == 2//old to new
                    $this->db->query('UPDATE '.$this->username.'_fb_pages SET `is_status`=2 WHERE connection_id=' . $connection_id . '');
                    $insert_data['master_id'] = $_SESSION['master'];
                    $insert_data['connection_id'] = $connection_id;
                    $insert_data['property_sub_type'] = $sub_type;
                    $insert_data['intrested_product'] = $int_product;
                    $insert_data['user_id'] = $assign_to;
                    $insert_data['is_status'] = $is_status;
                   
                    $response_status_log = $this->MasterInformationModel->insert_entry2($insert_data, $this->username.'_fb_pages');
           
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $connection_name . " Connected successfully";
                } else if ($this->request->getPost("edit_id")) {
                    $this->db->query('UPDATE '.$this->username.'_fb_pages SET `property_sub_type`=' . $sub_type . ',`intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ' WHERE connection_id=' . $connection_id . '');
             
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $connection_name . " Updated successfully";
                } else {
                    $result_array['respoance'] = 0;
                    $result_array['msg'] = "Duplicate Form not Allow";
                }
            }
        } else {
            $status = $this->request->getPost("status");
            $this->db->query('UPDATE '.$this->username.'_fb_pages SET `status`=' . $status . ' WHERE connection_id=' . $connection_id . '');
            $result_array['respoance'] = 1;
        }
        echo json_encode($result_array, true);
        die();
    }
}
