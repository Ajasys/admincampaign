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
        $this->db = \Config\Database::connect('second');
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
        $connection_id = $this->request->getPost("connection_id");
        $errorMsg = 'Something Went wrong..!';
        $resultff = array();
        $resultff['response'] = 0;
        $resultff['message'] = $errorMsg;
        $html = "";
        $permission_html = '';
        if ($action == "user") {
            $html .= '<div class="cursor-pointer ps-3 account-box d-flex  flex-wrap  border-bottom alihgn-items-center">
                        <div class="d-flex align-items-center" style="height: 45px;">
                            <input type="checkbox" id="selectall" class="me-2 rounded-3 select_all_checkbox" style="width:18px;height:18px;">
                            <div class="col fs-6 fw-semibold">
                                Select all
                            </div>
                        </div>
                    </div><div class="col-12 overflow-x-hidden" style="height:500px;">
                    <ul class="overflow-y-scroll" style="height:490px;">';
            if ($connection_id > 0) {
                $asset_query = "SELECT * FROM " . $this->username . "_platform_assets Where asset_type='pages' AND platform_id=" . $connection_id;
                $asset_result = $this->db->query($asset_query);
                $pageresult = $asset_result->getResultArray();
                if (isset($pageresult)) {
                    $assetpermission_query = "SELECT GROUP_CONCAT(`asset_id`)as asset_id,GROUP_CONCAT(`assetpermission_name`)as assetpermission_name FROM " . $this->username . "_platform_assetpermission WHERE `user_id`=" . $_POST['user_id'];
                    $assetpermission_result = $this->db->query($assetpermission_query);
                    $per_result = $assetpermission_result->getResult();
                    $perassetid_data = [];
                    $perassetname_data = [];
                    if (isset($per_result[0])) {
                        $perassetid_data = explode(',', $per_result[0]->asset_id);
                    }
                    if (isset($per_result[0])) {
                        $perassetname_data = explode(',', $per_result[0]->assetpermission_name);
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
                    $post_comments = '';
                    $messages = '';
                    if (in_array('create_scenarios', $perassetname_data)) {
                        $create_scenarios = 'checked';
                    }
                    if (in_array('leads', $perassetname_data)) {
                        $leads = 'checked';
                    }
                    if (in_array('post_comments', $perassetname_data)) {
                        $post_comments = 'checked';
                    }
                    if (in_array('messages', $perassetname_data)) {
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
                                                        class="toggle-checkbox fs-3 on_off_btn_Desktop post_comments"
                                                        type="checkbox" value="post_comments"  ' . $post_comments . '>
                                                    <span class="check_input_primary round"></span>
                                                </label>
                                            </div>
                                            <div class="col-11">
                                                <p class="col ms-3 fw-bold fs-14">Post & Comments</p>
                                                <p class="ms-3">Create, view and manage post and their comments.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 p-2 d-flex align-items-center">
                                            <div class="col-1">
                                                <label class="switch_toggle_primary">
                                                    <input
                                                        class="toggle-checkbox fs-3 on_off_btn_Desktop messages"
                                                        type="checkbox" value="messages"  ' . $messages . '>
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
            } else {
                $pageresult = getSocialData('https://graph.facebook.com/v19.0/me/accounts?access_token=' . $fb_access_token);
                foreach ($pageresult['data'] as $aa_key => $aa_value) {
                    $longLivedAccessToken = $aa_value['access_token'];
                    $html .= '<option value="' . $aa_value['id'] . '" data-access_token="' . $longLivedAccessToken . '" data-page_name="' . $aa_value['name'] . '">' . $aa_value['name'] . '</option>';
                }
                if (isset($result['error']['message'])) {
                    $Msg = $result['error']['message'];
                } else {
                    $Msg = 'Page list Succesfully..';
                }
            }
            $html .= '</ul>
            </div>';

            $resultff['response'] = 1;
            $resultff['message'] = $Msg;
        }
        $resultff['html'] = $html;
        $resultff['permission_html'] = $permission_html;
        return json_encode($resultff);
        die();
    }
    function assign_asset_permission()
    {
        $this->db = \Config\Database::connect('second');
        $action = $this->request->getPost("action");
        $userId = $this->request->getPost("user_id");
        $page_ids = explode(",", $this->request->getPost("page_id"));
        $asset_array = $this->request->getPost("asset_array");
        $result_array = array();

        if ($action == "insert" && $userId && is_array($page_ids) && $asset_array) {
            foreach ($page_ids as $index => $page_id) {

                $query = $this->db->query("SELECT * FROM " . $this->username . "_platform_assetpermission where user_id=" . $userId . " AND asset_id=" . $page_id);
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
