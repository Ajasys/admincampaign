<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class AssetPermissionController extends BaseController
{
    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->db = DatabaseDefaultConnection();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = session_username($_SESSION["username"]);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }
    function facebook_pageasset()
    {
        $action = $this->request->getPost("action");
        $type = $this->request->getPost("type");
        $connection_id = $this->request->getPost("connection_id");
        $errorMsg = 'Something Went wrong..!';
        $resultff = array();
        $resultff['response'] = 0;
        $resultff['message'] = $errorMsg;
        $html = "";
        $permission_html = '';
        if ($action == "user") {

            if ($type == "facebook") {
                $html .= '<div class="cursor-pointer ps-3 account-box d-flex  flex-wrap  border-bottom align-items-center  overflow-hidden">
                            <div class="d-flex align-items-center" style="height: 45px;">
                                <input type="checkbox" id="selectall" class="me-2 rounded-3 select_all_checkbox selectall" style="width:18px;height:18px;">
                                <div class="col fs-6 fw-semibold">
                                    Select all
                                </div>
                            </div>
                        </div><div class="col-12 " >
                        <ul class="">';

                $asset_query = "SELECT * FROM " . $this->username . "_platform_assets Where asset_type='pages'";
                $asset_result = $this->db->query($asset_query);
                $pageresult = $asset_result->getResultArray();
                if (isset($pageresult)) {
                    $assetpermission_query = "SELECT GROUP_CONCAT(`asset_id`) AS asset_ids, GROUP_CONCAT(`assetpermission_name`) AS asset_permissions 
                          FROM " . $this->username . "_platform_assetpermission 
                          WHERE `user_id` = " . $_POST['user_id'] . " 
                          AND platform_type = 'facebook'";
                    $assetpermission_result = $this->db->query($assetpermission_query);
                    $per_result = $assetpermission_result->getResult();
                    $perassetid_data = [];
                    $perassetname_data = [];

                    if (isset($per_result[0]) ) {
                        if ($per_result[0]->asset_ids!='NULL') {
                            $perassetid_data = explode(',', $per_result[0]->asset_ids);
                        }
                    
                        if ($per_result[0]->asset_permissions!='NULL') {
                            $perassetname_data = explode(',', $per_result[0]->asset_permissions);
                        } 
                    }

                    foreach ($pageresult as $aa_key => $aa_value) {
                        $cheked = '';
                        if (in_array($aa_value['id'], $perassetid_data)) {
                            $cheked = 'checked';
                        }

                        $longLivedAccessToken = $aa_value['access_token'];
                        $html .=  '<li class="cursor-pointer py-2 ps-3 account-box d-flex  flex-wrap align-items-center active-account-box select_part_checkbox">
                                        <input type="checkbox" class="me-2 rounded-3 selectedId" name="page_id" value="' . $aa_value['id'] . '" style="width:18px;height:18px;"  ' . $cheked . '>
                                        <img class="rounded-circle me-1" src="' . $aa_value['asset_img'] . '" alt="" style="width:30px;height:30px">
                                        <p class="col">' . $aa_value['name'] . '</p>
                                    </li>';
                    }

                    // for assign permission
                    $create_scenarios = '';
                    $leads = '';
                    $post = '';
                    $comments = '';
                    $messages = '';
                    if (in_array('create_scenarios', $perassetname_data)) {
                        $create_scenarios = 'checked';
                    }
                    if (in_array('leads', $perassetname_data)) {
                        $leads = 'checked';
                    }
                    if (in_array('fbpost', $perassetname_data)) {
                        $post = 'checked';
                    }
                    if (in_array('fbcomments', $perassetname_data)) {
                        $comments = 'checked';
                    }
                    if (in_array('fbmessages', $perassetname_data)) {
                        $messages = 'checked';
                    }


                    $permission_html = '<div class="col-12 p-2 d-flex align-items-center">
                                                <div class="col-1">
                                                    <label class="switch_toggle_primary">
                                                        <input
                                                            class="toggle-checkbox fs-3 on_off_btn_Desktop create_scenarios"
                                                            type="checkbox" value="create_scenarios" ' . $create_scenarios . '>
                                                        <span class="check_input_primary round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-11">
                                                    <p class="col ms-3 fw-bold fs-14">Create Scenarios</p>
                                                    <p class="ms-3">Create, manage or delete scenarios for lead
                                                        retrieval.</p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex align-items-center">
                                                <div class="col-1">
                                                    <label class="switch_toggle_primary">
                                                        <input class="toggle-checkbox fs-3 on_off_btn_Desktop leads"
                                                            type="checkbox" value="leads"  ' . $leads . '>
                                                        <span class="check_input_primary round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-11">
                                                    <p class="col ms-3 fw-bold fs-14">Leads</p>
                                                    <p class="ms-3">Access and view leads.</p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex align-items-center">
                                                <div class="col-1">
                                                    <label class="switch_toggle_primary">
                                                        <input
                                                            class="toggle-checkbox fs-3 on_off_btn_Desktop fbpost"
                                                            type="checkbox" value="fbpost"  ' . $post . '>
                                                        <span class="check_input_primary round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-11">
                                                    <p class="col ms-3 fw-bold fs-14">Post</p>
                                                    <p class="ms-3">Create, view and manage their post.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex align-items-center">
                                                <div class="col-1">
                                                    <label class="switch_toggle_primary">
                                                        <input
                                                            class="toggle-checkbox fs-3 on_off_btn_Desktop fbcomments"
                                                            type="checkbox" value="fbcomments"  ' . $comments . '>
                                                        <span class="check_input_primary round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-11">
                                                    <p class="col ms-3 fw-bold fs-14">Comments</p>
                                                    <p class="ms-3">Create, view and manage their comments.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex align-items-center">
                                                <div class="col-1">
                                                    <label class="switch_toggle_primary">
                                                        <input
                                                            class="toggle-checkbox fs-3 on_off_btn_Desktop fbmessages"
                                                            type="checkbox" value="fbmessages"  ' . $messages . '>
                                                        <span class="check_input_primary round"></span>
                                                    </label>
                                                </div>
                                                <div class="col-11">
                                                    <p class="col ms-3 fw-bold fs-14">Messages</p>
                                                    <p class="ms-3">Manage facebook page messages.</p>
                                                </div>
                                            </div>';
                    $Msg = 'Page list Successfully..';
                } else {
                    $Msg = 'Page does not exist..!';
                }


                $html .= '</ul>
                </div>';
            } else if ($type == "whatsapp") {
                $assetpermission_query = "SELECT GROUP_CONCAT(`asset_id`) AS asset_ids, GROUP_CONCAT(`assetpermission_name`) AS asset_permissions 
                FROM " . $this->username . "_platform_assetpermission 
                WHERE `user_id` = " . $_POST['user_id'] . " 
                AND platform_type = 'whatsapp'";
                $assetpermission_result = $this->db->query($assetpermission_query);
                $per_result = $assetpermission_result->getResult();

                $perassetid_data = [];
                $perassetname_data = [];
                if (isset($per_result[0])) {
                    $perassetid_data = explode(',', $per_result[0]->asset_ids);
                }
                if (isset($per_result[0])) {
                    $perassetname_data = explode(',', $per_result[0]->asset_permissions);
                }

                $asset_query = "SELECT * FROM " . $this->username . "_platform_integration Where platform_status=1";
                $asset_result = $this->db->query($asset_query);
                $pageresult = $asset_result->getResultArray();
                if (isset($pageresult)) {
                    foreach ($pageresult as $aa_key => $aa_value) {

                        $isasset_checked = '';
                        if (in_array($aa_value['id'], $perassetid_data)) {
                            $isasset_checked = 'checked';
                        }

                        $html = '<div class="ms-3 me-3 mt-2">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="selectall" value="'.$aa_value['id'].'"  '.$isasset_checked.' class="me-2 rounded-3 select_all_checkbox selectedId" style="width:18px;height:18px;">
                            <img class="rounded-circle me-1" src="https://erp.gymsmart.in/assets/image/member.png" alt="" style="width:40px;height:40px">
                            <div class="d-flex flex-wrap col">
                                <p class="col-12">'.$aa_value['whatsapp_name'].'</p>
                                <p class="fs-14 text-muted ">'.$aa_value['whatsapp_number'].'</p>
                            </div>
                        </div>
                    </div>';
                    }
                }

        
                // for assign permission
                $wh_message = '';
                $wh_template = '';
                if (in_array('wh_message', $perassetname_data)) {
                    $wh_message = 'checked';
                }
                if (in_array('wh_template', $perassetname_data)) {
                    $wh_template = 'checked';
                }

                $permission_html = '<div class="col-12 p-2 d-flex align-items-center">
                        <div class="col-1">
                            <label class="switch_toggle_primary">
                                <input class="toggle-checkbox fs-3 on_off_btn_Desktop" value="wh_message" type="checkbox" ' . $wh_message . '>
                                <span class="check_input_primary round"></span>
                            </label>
                        </div>
                        <div class="col-11">
                            <p class="col ms-3 fw-bold fs-14">Messages</p>
                            <p class="ms-3">Send and respond to direct messages as the
                                Whatsapp account.</p>
                        </div>
                    </div>
                    <div class="col-12 p-2 d-flex align-items-center">
                        <div class="col-1">
                            <label class="switch_toggle_primary">
                                <input class="toggle-checkbox fs-3 on_off_btn_Desktop" value="wh_template" type="checkbox" ' . $wh_template . '>
                                <span class="check_input_primary round"></span>
                            </label>
                        </div>
                        <div class="col-11">
                            <p class="col ms-3 fw-bold fs-14">Templates</p>
                            <p class="ms-3">Create and manage as the Whatsapp account</p>
                        </div>
                    </div>';

                    $Msg='Permisiion list succesafully...!';
            }

            $resultff['response'] = 1;
            $resultff['message'] = $Msg;
        }
        $resultff['html'] = $html;
        $resultff['permission_html'] = $permission_html;
        if (isset($per_result[0]) && ($per_result[0]->asset_permissions!='' || $per_result[0]->asset_ids!='')) {
            $asset_permissions_array = explode(',', $per_result[0]->asset_permissions);
            $unique_asset_permissions = array_unique($asset_permissions_array);
            $asset_permissions_string = implode(',', $unique_asset_permissions);
            $resultff['permission_name'] = $asset_permissions_string;
            $resultff['asset_id'] = $per_result[0]->asset_ids;
        }

        return json_encode($resultff);
        die();
    }
    function assign_asset_permission()
    {
        $this->db = DatabaseDefaultConnection();
        $action = $this->request->getPost("action");
        $userId = $this->request->getPost("user_id");
        $asset_type = $this->request->getPost("asset_type");
        $page_ids = explode(",", $this->request->getPost("page_id"));
        $asset_array = $this->request->getPost("asset_array");
        $result_array = array();

        if ($action == "insert" && $userId && is_array($page_ids) && $asset_array) {
                foreach ($page_ids as $index => $page_id) {
                    $query = $this->db->query("SELECT * FROM " . $this->username . "_platform_assetpermission where user_id=" . $userId . " AND asset_id=" . $page_id . " AND platform_type='" . $asset_type . "'");
                    $result_data = $query->getResult();

                    if ((!empty($result_data))) {
                        $update_data['assetpermission_name'] = $asset_array;
                        $departmentUpdatedata = $this->MasterInformationModel->update_entry2($result_data[0]->id, $update_data, $this->username . '_platform_assetpermission');

                        if ($departmentUpdatedata) {
                            $result_array['responce'] = 1;
                            $result_array['msg'] = "Assign assets permission successfully";
                        } else {
                            $result_array['responce'] = 0;
                            $result_array['msg'] = "Error while assigning assets permission";
                        }
                    } else {
                        $insert_data['platform_type'] = $asset_type;
                        $insert_data['asset_id'] = $page_id;
                        $insert_data['master_id'] = $_SESSION['master'];
                        $insert_data['user_id'] = $userId;
                        $insert_data['assetpermission_name'] = $asset_array;
                        $departmentUpdatedata = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . '_platform_assetpermission');

                        if ($departmentUpdatedata) {
                            $result_array['responce'] = 1;
                            $result_array['msg'] = "Assign assets permission successfully";
                        } else {
                            $result_array['responce'] = 0;
                            $result_array['msg'] = "Error while assigning assets permission";
                        }
                    }
                }
           
        } else {
            $result_array['responce'] = 0;
            $result_array['msg'] = "Please Check any asset or permission..!";
        }
        echo json_encode($result_array, true);
        die();
    }
    public function show_list_data()
    {
        $table_name = $_POST['table'];
        $query = $this->db->query('SELECT (SELECT firstname FROM admin_user where id=p.user_id) as username,GROUP_CONCAT(DISTINCT p.assetpermission_name) AS asset_permissions 
        FROM ' . $this->username . '_platform_assetpermission p GROUP BY p.user_id');
        $departmentdisplaydata = $query->getResultArray();
        $i = 1;
        $html = "";
        foreach ($departmentdisplaydata as $key => $value) {
            $asset_permissions_array = explode(',', $value['asset_permissions']);
            $unique_asset_permissions = array_unique($asset_permissions_array);
            $asset_permissions_string = implode(',', $unique_asset_permissions);
            $html .= '<tr>';
            $html .= '
					<td class="align-middle">
                    ' . $value['username'] . '
					</td>
					<td>' . $asset_permissions_string . '
					</td>';
            $html .= '</tr>';
            $i++;
        }
        if (!empty($html)) {
            echo $html;
        } else {
            echo '<td></td><td style="text-align:center;">Data Not Found </td>';
        }
        die();
    }
}
