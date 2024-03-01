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
        if ($action == "user") {
            $html .= '';
            if ($connection_id > 0) {
                $asset_query = "SELECT * FROM " . $this->username . "_platform_assets Where asset_type='pages' AND platform_id=" . $connection_id;
                $asset_result = $this->db->query($asset_query);
                $pageresult = $asset_result->getResultArray();
                if (isset($pageresult)) {
                    foreach ($pageresult as $aa_key => $aa_value) {
                        $longLivedAccessToken = $aa_value['access_token'];
                        $html .=  '<li class="cursor-pointer py-2 ps-3 account-box d-flex  flex-wrap align-items-center active-account-box select_part_checkbox">
                        <input type="checkbox" class="me-2 rounded-3 selectedId" name="page_id" value="' . $aa_value['id'] . '" style="width:18px;height:18px;">
                        <img class="rounded-circle me-1" src="' . $aa_value['asset_img'] . '" alt="" style="width:30px;height:30px">
                        <p class="col">' . $aa_value['name'] . '</p>
                    </li>';
                    }
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
            $resultff['response'] = 1;
            $resultff['message'] = $Msg;
        }
        $resultff['html'] = $html;
        return json_encode($resultff);
        die();
    }
    function assign_asset_permission()
    {
        $this->db = \Config\Database::connect('second');
        $action = $this->request->getPost("action");
        $userId = $this->request->getPost("userId");
        $page_id = $this->request->getPost("page_id");
        $asset_array = $this->request->getPost("asset_array");
        $result_array = array();
        if (isset($userId) && is_array($asset_array) && $page_id) {
            foreach ($page_id as $id) {
                $insert_data['asset_id'] = $id;
                $insert_data['master_id'] = $_SESSION['master'];
                $insert_data['user_id'] = $userId;
                $insert_data['assetpermission_name'] = $asset_array;
                $departmentUpdatedata = $this->MasterInformationModel->insert_entry2($insert_data, $table_username . '_platform_assetpermission');
                // $update_data['user_id'] = $userId;
                // $update_data['assetpermission_name'] = $asset_array;
                // $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $update_data, $this->username . '_platform_assets');
            }
            $result_array['responce'] = 1;
            $result_array['msg'] = "Assign assets permission successfully";
        } else {
            $result_array['responce'] = 0;
            $result_array['msg'] = "Please Check any asset or permission..!";
        }
        echo json_encode($result_array, true);
        die();
    }
}
