<?php
namespace App\Controllers\Campaign;
use App\Controllers\BaseController;

use App\Models\MasterInformationModel;
use Config\Database;

class FacebookController extends BaseController
{
    //private $db;
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
    //For app connection
    function check_fb_connection()
    {
        $table_username = session_username($_SESSION['username']);
        $action = $this->request->getPost("action");
        $access_token = $this->request->getPost("access_token");
        $access_token = trim($access_token);
        $result = getSocialData(MetaUrl().'me/accounts?access_token=' . $access_token);
        $errorMsg = 'Something Went wrong..!';
        if (isset($result['error']['message'])) {
            $errorMsg = $result['error']['message'];
        }
        $result_array['response'] = 0;
        $result_array['message'] = $errorMsg;
        $fbdata = '';
        if (isset($result['data']) && is_array($result['data']) && $result['data'] != '') {
            $numberOfPages = count($result['data']);
            if ($numberOfPages > 0) {
                $appresult = getSocialData(MetaUrl().'debug_token?input_token=' . $access_token . '&access_token=' . $access_token);
                if (isset($appresult['data'])) {
                    $fbdata = $appresult['data'];
                }
                $is_facebook_connect = 1;
                $query = "SELECT * FROM " . $table_username . "_platform_integration WHERE access_token='" . $access_token . "' AND platform_status=2";
                $int_rows = $this->db->query($query);
                $int_result = $int_rows->getResult();
                if (isset($int_result[0])) {
                    $int_data = get_object_vars($int_result[0]);
                    if ($int_data['verification_status'] == 1) {
                        $result_array['response'] = 2;
                        $result_array['message'] = $int_data['fb_app_name'] . ' facebook app connection already exists..!';
                    } else {
                        $update_data['fb_app_id'] = $fbdata['app_id'];
                        $update_data['fb_app_name'] = $fbdata['application'];
                        $update_data['fb_app_type'] = $fbdata['type'];
                        $update_data['verification_status'] = $is_facebook_connect;
                        $departmentUpdatedata = $this->MasterInformationModel->update_entry2($int_data['id'], $update_data, $table_username . '_platform_integration');
                        $result_array['response'] = 1;
                        $result_array['message'] = $fbdata['application'] . ' facebook app connected successfully..!';
                    }
                } else {
                    //insert 
                    $insert_data['master_id'] = $_SESSION['master'];
                    $insert_data['access_token'] = $access_token;
                    $insert_data['fb_app_id'] = $fbdata['app_id'];
                    $insert_data['fb_app_name'] = $fbdata['application'];
                    $insert_data['fb_app_type'] = $fbdata['type'];
                    $insert_data['verification_status'] = $is_facebook_connect;
                    $insert_data['platform_status'] = 2;
                    $departmentUpdatedata = $this->MasterInformationModel->insert_entry2($insert_data, $table_username . '_platform_integration');
                    $result_array['response'] = 1;
                    $result_array['message'] = $fbdata['application'] . ' facebook app connected successfully..!';
                }
            } else {
                $is_facebook_connect = 0;
                $result_array['response'] = 0;
                $result_array['message'] = $errorMsg;
            }
        } else {
            $is_facebook_connect = 0;
            $result_array['response'] = 0;
            $result_array['message'] = $errorMsg;
        }
        echo json_encode($result_array, true);
        die();
    }
    //Delete page and forms
    public function delete_pages_fb()
    {
        $table_username = session_username($_SESSION['username']);
        $response = array();
        $table_name = array();
        if ($this->request->getPost("action") == "delete") {
            $delete_id = $this->request->getPost('delete_id');
            $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            if ($table_name == 'admin_fb_account') {
                $departmentdisplaydata = $this->MasterInformationModel->delete_entry($table_name, $delete_id);
                $find_Array_all = "DELETE FROM " . $this->username . "_fb_pages where master_id='" . $_SESSION['master'] . "'";
                $find_Array_all = $this->db->query($find_Array_all);
            } else {
                if ($this->request->getPost('is_draft') == 1) {
                    $this->MasterInformationModel->delete_entry2($table_username . '_' . $table_name, $delete_id);
                } else {
                    $this->db->query('UPDATE ' . $table_username . '_' . $table_name . ' SET `is_status`=1 WHERE id=' . $delete_id . '');
                }
            }
            $response['response'] = 0;
            echo json_encode($response);
        } else if ($this->request->getPost("action") == "discard") {
            $delete_id = $this->request->getPost('delete_id');
            $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            $departmentdisplaydata = $this->MasterInformationModel->delete_entry2($table_name, $delete_id);
            $response['response'] = 0;
            echo json_encode($response);
        }
        die();
    }
    //Listing page on connection id 
    function old_facebook_user()
    {
        $action = $this->request->getPost("action");
        $fb_access_token = $this->request->getPost("fb_access_token");
        $fb_check_conn = $this->request->getPost("fb_check_conn");
        $errorMsg = 'Something Went wrong..!';
        $resultff = array();
        $resultff['response'] = 0;
        $resultff['message'] = $errorMsg;
        $html = "";
        if ($action == "user" && $fb_access_token) {
            $html .= '<option value="0">Select Page</option>';
            if (isset($fb_access_token) && $fb_check_conn == 1) {
                $pageresult = getSocialData(MetaUrl().'me/accounts?access_token=' . $fb_access_token);
                foreach ($pageresult['data'] as $aa_key => $aa_value) {
                    $longLivedAccessToken = $aa_value['access_token'];
                    $html .= '<option value="' . $aa_value['id'] . '" data-access_token="' . $longLivedAccessToken . '" data-page_name="' . $aa_value['name'] . '">' . $aa_value['name'] . '</option>';
                }
                if (isset($result['error']['message'])) {
                    $Msg = $result['error']['message'];
                } else {
                    $Msg = 'Page list Succesfully..';
                }
                $resultff['response'] = 1;
                $resultff['message'] = $Msg;
            } else {
                $resultff['response'] = 0;
                $resultff['message'] = 'Please check your access token..!';
            }
        }
        $resultff['html'] = $html;
        $resultff['profile_pic'] = '';
        return json_encode($resultff);
        die();
    }
    //Listing page on connection id 
    function facebook_user()
    {
        $action = $this->request->getPost("action");
        $fb_access_token = $this->request->getPost("fb_access_token");
        $fb_check_conn = $this->request->getPost("fb_check_conn");
        $connection_id = $this->request->getPost("connection_id");
        $errorMsg = 'Something Went wrong..!';
        $resultff = array();
        $resultff['response'] = 0;
        $resultff['message'] = $errorMsg;
        $html = "";
        if ($action == "user" && $fb_access_token) {
            $html .= '<option value="0">Select Page</option>';
            if (isset($fb_access_token) && $fb_check_conn == 1) {

                $permission_query = "SELECT GROUP_CONCAT(DISTINCT asset_id) as asset_id FROM " . $this->username . "_platform_assetpermission WHERE FIND_IN_SET('create_scenarios', assetpermission_name) > 0 AND user_id =" . $_SESSION['id'];
                $permission_result = $this->db->query($permission_query);
                $per_result = $permission_result->getResult();
                $perasset_data = [];
                if (isset($per_result[0])) {
                    $perasset_data = explode(',', $per_result[0]->asset_id);
                }

                if ($connection_id > 0) {
                    $asset_query = "SELECT * FROM " . $this->username . "_platform_assets Where asset_type='pages' AND platform_id=" . $connection_id;
                    $asset_result = $this->db->query($asset_query);
                    $pageresult = $asset_result->getResultArray();
                    if (isset($pageresult)) {
                        foreach ($pageresult as $aa_key => $aa_value) {
                            if ((in_array($aa_value['id'], $perasset_data)) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                                $longLivedAccessToken = $aa_value['access_token'];
                                $html .= '<option value="' . $aa_value['asset_id'] . '" data-access_token="' . $longLivedAccessToken . '" data-page_name="' . $aa_value['name'] . '">' . $aa_value['name'] . '</option>';
                            }
                        }
                        $Msg = 'Page list Successfully..';
                        $resultff['response'] = 1;
                        $resultff['message'] = $Msg;
                    } else {
                        $Msg = 'Please give page asset permission ..!';
                        $resultff['response'] = 0;
                        $resultff['message'] = $Msg;
                    }
                } else {
                    $pageresult = getSocialData(MetaUrl().'me/accounts?access_token=' . $fb_access_token);
                    foreach ($pageresult['data'] as $aa_key => $aa_value) {
                        if ((in_array($aa_value['id'], $perasset_data)) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                            $longLivedAccessToken = $aa_value['access_token'];
                            $html .= '<option value="' . $aa_value['id'] . '" data-access_token="' . $longLivedAccessToken . '" data-page_name="' . $aa_value['name'] . '">' . $aa_value['name'] . '</option>';
                        }
                    }
                    if (isset($result['error']['message'])) {
                        $Msg = $result['error']['message'];
                    } else {
                        $Msg = 'Page list Succesfully..';
                    }
                }
            } else {
                $resultff['response'] = 0;
                $resultff['message'] = 'Please check your access token..!';
            }
        } else if ($action == "add_user") {
            $response = $this->request->getPost("response");
            $longLivedToken = $this->request->getPost("longLivedToken");
            $userinformation = $this->request->getPost("userinformation");
            $appresult = getSocialData(MetaUrl().'debug_token?input_token=' . $longLivedToken . '&access_token=' . $longLivedToken);
            if (isset($appresult['data'])) {
                $fbdata = $appresult['data'];
                $profile_pictures = getSocialData(MetaUrl() . $appresult['data']['user_id'] . '/picture?redirect=false&&access_token=' . $longLivedToken . '');

                $query = $this->db->query('SELECT * FROM ' . $this->username . '_platform_integration WHERE fb_app_id = "' . $fbdata['app_id'] . '" AND platform_status=2');
                $count_num = $query->getNumRows();
                if ($count_num > 0) {
                    $result_facebook_data = $query->getResultArray()[0];
                    if ($result_facebook_data['verification_status'] == 1) {
                        $query = $this->db->query("UPDATE " . $this->username . "_platform_integration  SET profile_img='" . $profile_pictures['data']['url'] . "',access_token = '" . $longLivedToken . "',fb_app_name='" . $fbdata['application'] . "',fb_app_type='" . $fbdata['type'] . "'  WHERE fb_app_id = '" . $fbdata['app_id'] . "' AND platform_status=2");
                        $resultff['response'] = 2;
                        $resultff['message'] = $result_facebook_data['fb_app_name'] . ' facebook app connection already exists..!';
                    } else {
                        $query = $this->db->query("UPDATE " . $this->username . "_platform_integration  SET profile_img='" . $profile_pictures['data']['url'] . "',access_token = '" . $longLivedToken . "',fb_app_name='" . $fbdata['application'] . "',fb_app_type='" . $fbdata['type'] . "'  WHERE fb_app_id = '" . $fbdata['app_id'] . "' AND platform_status=2");
                        $resultff['response'] = 1;
                        $resultff['message'] = $fbdata['application'] . ' facebook app connected successfully..!';
                    }

                    //store updated page assets
                    $pageresult = getSocialData(MetaUrl().'me/accounts?access_token=' . $longLivedToken);
                    $permission_query = "SELECT GROUP_CONCAT(`asset_id`)as pageasset_id FROM `admin_platform_assets` WHERE `platform_id`=" . $result_facebook_data['id'];
                    $permission_result = $this->db->query($permission_query);
                    $per_result = $permission_result->getResult();
                    $perasset_data = [];
                    if (isset($per_result[0])) {
                        $perasset_data = explode(',', $per_result[0]->pageasset_id);
                    }
                    // Delete pages that are not in the $pageresult['data'] array
                    foreach ($perasset_data as $page_id) {
                        if (!in_array($page_id, array_column($pageresult['data'], 'id'))) {
                            $delete_aasset = "DELETE FROM " . $this->username . "_platform_assets WHERE asset_type='pages' AND asset_id='" . $page_id . "'";
                            $delete_aassetresult = $this->db->query($delete_aasset);
                        }
                    }

                    // Add pages that are in the $pageresult['data'] array but not in $perasset_data
                    foreach ($pageresult['data'] as $aa_value) {
                        if (!in_array($aa_value['id'], $perasset_data)) {
                            // Add page
                            $response_pictures = getSocialData(MetaUrl() . $aa_value['id'] . '/picture?redirect=false&&access_token=' . $aa_value['access_token'] . '');
                            $asset_insert_data['platform_id'] = $result_facebook_data['id'];
                            $asset_insert_data['master_id'] = $_SESSION['master'];
                            $asset_insert_data['asset_type'] = 'pages';
                            $asset_insert_data['asset_id'] = $aa_value['id'];
                            $asset_insert_data['access_token'] = $aa_value['access_token'];
                            $asset_insert_data['asset_img'] = $response_pictures['data']['url'];
                            $asset_insert_data['name'] = $aa_value['name'];
                            $response_status_log = $this->MasterInformationModel->insert_entry2($asset_insert_data, $this->username . '_platform_assets');
                        }
                    }
                } else {
                    $insert_data['access_token'] = $longLivedToken;
                    $insert_data['master_id'] = $_SESSION['master'];
                    $insert_data['profile_img'] = $profile_pictures['data']['url'];
                    $insert_data['fb_app_id'] = $fbdata['app_id'];
                    $insert_data['fb_app_name'] = $fbdata['application'];
                    $insert_data['fb_app_type'] = $fbdata['type'];
                    $insert_data['verification_status'] = 1;
                    $insert_data['platform_status'] = 2;
                    $platform_id = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . '_platform_integration');
                    $asset_insert_data['platform_id'] = $platform_id;


                    // for advertise assets
                    $response_ads = getSocialData(MetaUrl().'/me/adaccounts?fields=account_id,name&access_token=' . $longLivedToken. '');        
                    foreach ($response_ads['data'] as $ad_account) {
                        $adAccountId = $ad_account['account_id'];
                        $ads_insert_data['platform_id'] = $platform_id;
                        $ads_insert_data['master_id'] = $_SESSION['master'];
                        $ads_insert_data['asset_type'] = 'ads';
                        $ads_insert_data['asset_id'] = $adAccountId;
                        $ads_insert_data['name'] = $ad_account['name'];
                        $response_asset = $this->MasterInformationModel->insert_entry($ads_insert_data, $this->username . '_platform_assets');
                        
                    }

                    $resultff['response'] = 1;
                    $resultff['message'] = $fbdata['application'] . ' facebook app connected successfully..!';
                }
            } else {
                if (isset($result['error']['message'])) {
                    $errorMsg = $result['error']['message'];
                }
                $resultff['response'] = 0;
                $resultff['message'] = $errorMsg;
            }
        } else if ($action == "refresh") {
            $html .= '<option value="0">Select Page</option>';
            if (isset($fb_access_token) && $fb_check_conn == 1) {
                $permission_query = "SELECT GROUP_CONCAT(DISTINCT asset_id) as asset_id FROM " . $this->username . "_platform_assetpermission WHERE FIND_IN_SET('create_scenarios', assetpermission_name) > 0 AND user_id =" . $_SESSION['id'];
                $permission_result = $this->db->query($permission_query);
                $per_result = $permission_result->getResult();
                $perasset_data = [];
                if (isset($per_result[0])) {
                    $perasset_data = explode(',', $per_result[0]->asset_id);
                }

                if ($connection_id > 0) {
                    //store updated page assets
                    $pageresult = getSocialData(MetaUrl().'me/accounts?access_token=' . $fb_access_token);
                    $asset_query = "SELECT GROUP_CONCAT(`asset_id`)as pageasset_id FROM `admin_platform_assets` WHERE `platform_id`=" . $connection_id;
                    $asset_result = $this->db->query($asset_query);
                    $assetper_result = $asset_result->getResult();
                    $asset_data = [];
                    if (isset($assetper_result[0])) {
                        $asset_data = explode(',', $assetper_result[0]->pageasset_id);
                    }
                    // Delete pages that are not in the $pageresult['data'] array
                    foreach ($asset_data as $page_id) {
                        if (!in_array($page_id, array_column($pageresult['data'], 'id'))) {
                            $delete_aasset = "DELETE FROM " . $this->username . "_platform_assets WHERE asset_type='pages' AND asset_id='" . $page_id . "'";
                            $delete_aassetresult = $this->db->query($delete_aasset);
                        }
                    }

                    // Add pages that are in the $pageresult['data'] array but not in $perasset_data
                    foreach ($pageresult['data'] as $aa_value) {
                        if (!in_array($aa_value['id'], $asset_data)) {
                            // Add page
                            $response_pictures = getSocialData(MetaUrl() . $aa_value['id'] . '/picture?redirect=false&&access_token=' . $aa_value['access_token'] . '');
                            $asset_insert_data['platform_id'] = $connection_id;
                            $asset_insert_data['master_id'] = $_SESSION['master'];
                            $asset_insert_data['asset_type'] = 'pages';
                            $asset_insert_data['asset_id'] = $aa_value['id'];
                            $asset_insert_data['access_token'] = $aa_value['access_token'];
                            $asset_insert_data['asset_img'] = $response_pictures['data']['url'];
                            $asset_insert_data['name'] = $aa_value['name'];
                            $response_status_log = $this->MasterInformationModel->insert_entry2($asset_insert_data, $this->username . '_platform_assets');
                        }
                    }

                    $asset_query = "SELECT * FROM " . $this->username . "_platform_assets Where asset_type='pages' AND platform_id=" . $connection_id;
                    $asset_result = $this->db->query($asset_query);
                    $pageresult = $asset_result->getResultArray();
                    if (isset($pageresult)) {
                        foreach ($pageresult as $aa_key => $aa_value) {
                            if ((in_array($aa_value['id'], $perasset_data)) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                                $longLivedAccessToken = $aa_value['access_token'];
                                $html .= '<option value="' . $aa_value['asset_id'] . '" data-access_token="' . $longLivedAccessToken . '" data-page_name="' . $aa_value['name'] . '">' . $aa_value['name'] . '</option>';
                            }
                        }
                        $Msg = 'Page list Successfully..';
                        $resultff['response'] = 1;
                        $resultff['message'] = $Msg;
                    } else {
                        $Msg = 'Please give page asset permission ..!';
                        $resultff['response'] = 0;
                        $resultff['message'] = $Msg;
                    }
                } else {
                    $resultff['response'] = 0;
                    $resultff['message'] = 'Please check your connection..!';
                }
            } else {
                $resultff['response'] = 0;
                $resultff['message'] = 'Please check your access token..!';
            }
        }
        $resultff['html'] = $html;
        return json_encode($resultff);
        die();
    }
    //Listing form on pages id 
    function facebook_form()
    {
        $resultff = array();
        $html = "";
        $page_id = $this->request->getPost("page_id");
        $access_token = $this->request->getPost("access_token");
        try {
            $result = getSocialData(MetaUrl() . $page_id . '/leadgen_forms?access_token=' . $access_token . '');
            $html .= '<option value="0">Select Form</option>';
            if (isset($result['data'])) {
                foreach ($result['data'] as $result_key => $result_value) {
                    // pre($result_value);
                    if ($result_value['status'] == 'ACTIVE') {
                        $html .= '<option value=' . $result_value['id'] . ' >' . $result_value['name'] . '</option>';
                    }
                }
            }
        } catch (\Exception $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
        } catch (\Exception $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $resultff['html'] = $html;
        return json_encode($resultff);
        die();
    }
    //Submit page ,form and other details.
    function facebook_page()
    {
        $this->db = DatabaseDefaultConnection();
        $action = $this->request->getPost("action");
        $connection_id = $this->request->getPost("connection_id");
        $page_id = $this->request->getPost("page_id");
        $access_token = $this->request->getPost("access_token");
        $page_name = $this->request->getPost("page_name");
        $int_product = $this->request->getPost("int_product") ? $this->request->getPost("int_product") : 0;
        $sub_type = $this->request->getPost("sub_type") ? $this->request->getPost("sub_type") : 0;
        if ($this->request->getPost("assign_to") == 1) {
            $assign_to = "'" . $this->request->getPost("staff_to") . "'";
        } else {
            $assign_to = $this->request->getPost("assign_to") ? $this->request->getPost("assign_to") : 0;
        }
        $form_id = $this->request->getPost("form_id");
        $form_name = $this->request->getPost("form_name");
        $is_status = $this->request->getPost("is_status") ? $this->request->getPost("is_status") : 0;
        $query = $this->db->query("SELECT * FROM " . $this->username . "_fb_pages where form_id=" . $form_id . "");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        $result_array = array();
        if (!empty($action) && $action == "page") {
            if ($count_num == 0) {
                $insert_data['master_id'] = $_SESSION['master'];
                $insert_data['page_access_token'] = $access_token;
                $insert_data['connection_id'] = $connection_id;
                $insert_data['page_id'] = $page_id;
                $insert_data['page_name'] = $page_name;
                $insert_data['property_sub_type'] = $sub_type;
                $insert_data['intrested_product'] = $int_product;
                $insert_data['user_id'] = $assign_to;
                $insert_data['form_id'] = $form_id;
                $insert_data['form_name'] = $form_name;
                $insert_data['is_status'] = $is_status;
                $response_pictures = getSocialData(MetaUrl() . $page_id . '/picture?redirect=false&&access_token=' . $access_token . '');
                $insert_data['page_img'] = $response_pictures['data']['url'];
                $response_status_log = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . '_fb_pages');
                $result_array['id'] = $response_status_log;
                $result_array['page_profile'] = $response_pictures['data']['url'];
                // $result_array['respoance'] = 1;
                // $result_array['msg'] = "Form Connected successfully";
            } else {
                if ($result_facebook_data[0]['is_status'] == 0) {
                    //is_status==0-for fresh to connection
                    $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ' WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $form_name . " re-connect successfully";
                } else if ($result_facebook_data[0]['is_status'] == 1) {
                    //is_status==1-for delete to connection
                    $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `is_status`=0 WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $form_name . " re-connect successfully";
                } else if ($result_facebook_data[0]['is_status'] == 3) {
                    //is_status==0-for draft to connection
                    $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `property_sub_type`=' . $sub_type . ',`intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ',`is_status`=' . $is_status . ' WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $form_name . " connection successfully";
                } else if ($this->request->getPost("edit_id") == $result_facebook_data[0]['id'] && ($form_id != $result_facebook_data[0]['form_id'] || $is_status == 3)) {
                    //is_status == 2//old to new
                    $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `is_status`=2 WHERE form_id=' . $form_id . '');
                    $insert_data['master_id'] = $_SESSION['master'];
                    $insert_data['page_access_token'] = $access_token;
                    $insert_data['connection_id'] = $connection_id;
                    $insert_data['page_id'] = $page_id;
                    $insert_data['page_name'] = $page_name;
                    $insert_data['property_sub_type'] = $sub_type;
                    $insert_data['intrested_product'] = $int_product;
                    $insert_data['user_id'] = $assign_to;
                    $insert_data['form_id'] = $form_id;
                    $insert_data['form_name'] = $form_name;
                    $insert_data['is_status'] = $is_status;
                    $response_pictures = getSocialData(MetaUrl() . $page_id . '/picture?redirect=false&&access_token=' . $access_token . '');
                    $insert_data['page_img'] = $response_pictures['data']['url'];
                    $response_status_log = $this->MasterInformationModel->insert_entry2($insert_data, $this->username . '_fb_pages');
                    $result_array['page_profile'] = $response_pictures['data']['url'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $form_name . " Connected successfully";
                } else if ($this->request->getPost("edit_id")) {
                    $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `property_sub_type`=' . $sub_type . ',`intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ' WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = $form_name . " Updated successfully";
                } else {
                    if ($result_facebook_data[0]['is_status'] == 4) {
                        $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `property_sub_type`=' . $sub_type . ',`intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ',connection_id=' . $connection_id . ',is_status=0  WHERE form_id=' . $form_id . '');
                        $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                        $result_array['respoance'] = 1;
                        $result_array['msg'] = $form_name . " Updated successfully";
                    } else {
                        $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                        $result_array['respoance'] = 0;
                        $result_array['msg'] = "Duplicate Form not Allow";
                    }
                }
            }
        } else {
            $status = $this->request->getPost("status");
            $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `status`=' . $status . ' WHERE form_id=' . $form_id . '');
            $result_array['respoance'] = 1;
        }
        echo json_encode($result_array, true);
        die();
    }
    //Listing connected pages..
    function pages_list_data()
    {
        $html = "";
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM " . $this->username . "_fb_pages AS p
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND p.is_status=0");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $get_asset_permission = array();
        } else {
            $get_asset_permission = get_asset_permission($_SESSION['id']);
        }
        if (in_array('leads', $get_asset_permission) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {

            if ($count_num > 0) {
                foreach ($result_facebook_data as $key => $value) {
                    $integrationData = $this->MasterInformationModel->edit_entry2($this->username . '_platform_integration', $value['connection_id']);
                    $integrationData = get_object_vars($integrationData[0]);
                    $platform_status = $integrationData['platform_status'];
                    if ($value['user_id'] == 0) {
                        $assign_id = 0;
                        $staff_id = '';
                    } else {
                        $assign_id = 1;
                        $staff_id = $value['user_id'];
                    }
                    if ($platform_status == 2) {
                        $queryd = $this->db->query("SELECT form_id, COUNT(*) AS form_count
                        FROM " . $this->username . "_integration
                        WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=1");
                        $count_lead = $queryd->getResultArray();
                        $count = 0;
                        if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                            $count = $count_lead[0]['form_count'];
                        }
                        $queryds = $this->db->query("SELECT form_id, COUNT(*) AS form_counts
                                FROM " . $this->username . "_integration
                                WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=2");
                        $count_leads = $queryds->getResultArray();
                        $counts = 0;
                        if (isset($count_leads[0]['form_counts']) && !empty($count_leads[0]['form_counts'])) {
                            $counts = $count_leads[0]['form_counts'];
                        }
                        $form_name = "";
                        if (isset($value['form_name']) && !empty($value['form_name'])) {
                            $form_name = $value['form_name'];
                        }
                        if (isset($value['page_img']) && !empty($value['page_img'])) {
                            $page_img = $value['page_img'];
                        } else {
                            $page_img = "https://dev.realtosmart.com/assets/images/f_intigration.svg";
                        }
                        $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                        <g>
                                            <g data-name="Layer 2">
                                                <g data-name="01.facebook">
                                                    <circle cx="88" cy="88" r="88" fill="#3a559f" opacity="1" data-original="#3a559f"></circle>
                                                    <path fill="#ffffff" d="m115.88 77.58-1.77 15.33a2.87 2.87 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.9a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.78v12.81h17.87a2.88 2.88 0 0 1 2.82 3.25z" opacity="1" data-original="#ffffff"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>';
                        $page_img_div = '<div class="mx-1">
                                            <img src="' . $page_img . '">
                                        </div>';
                        $connection_name = $value['page_name'] . '(' . $form_name . ')';
                        $leadlist_urlId = $value['form_id'];
                    } else if ($platform_status == 5) {
                        $queryd = $this->db->query("SELECT COUNT(*) AS form_count
                        FROM " . $this->username . "_integration
                        WHERE platform = 'website' AND page_id=" . $value['id']);
                        $count_lead = $queryd->getResultArray();
                        $count = 0;
                        if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                            $count = $count_lead[0]['form_count'];
                        }
                        $connection_name = $integrationData['website_name'];
                        $page_img_div = '';
                        $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                            <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                            <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                            <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                            <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                        </g>
                    </svg>';
                        $leadlist_urlId = $value['id'];
                    }
                    $html .= '
                          <div class="lead_list p-2 rounded-2 position-relative">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                <div class="mx-1">
                                ' . $logo_img . '
                               </div>
                            ' . $page_img_div . '
                                   <div class="load-icon center">
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                    </div>          
                                    <div class="mx-1">
                                       <img src="https://ajasys.com/img/favicon.png" style="width: 45px;">
                                    </div>
                                </div>
                                <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill" href="' . base_url() . 'leadlist?id=' . $leadlist_urlId . '&platform=' . $platform_status . '">
                                    <p class="d-block col-12 text-dark">' . $connection_name . '</p>
                                    <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12">
                                    <i class="bi bi-gear me-1"></i>
                                    <span class="me-2">' . $count . '</span>
                                        <i class="bi bi-person me-1"></i>
                                        <span>'  . $_SESSION['username'] .  '</span>
                                    </div>
                                </a>';

                    if ((in_array('leads', $get_asset_permission) || in_array('create_scenarios', $get_asset_permission)) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                        $html .= '<div class="lead_list_switch d-flex align-items-center flex-wrap">
                        <div class="dropdown">
                            <button class="bg-transparent border-2 rounded-2 border p-1 dropdown-toggle after-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-caret-down-fill fs-12 text-secondary-emphasis"></i>
                            </button>
                            <ul class="dropdown-menu py-2">
                                <li onclick="EditScenarios(\'' . $value['page_ids'] . '\',\'' . $platform_status . '\');"><a class="dropdown-item edit_page" data-edit_id=' . $value['page_ids'] . '><i class="fas fa-pencil-alt me-2"></i>Edit</a></li>
                                <li><a class="dropdown-item delete_page" data-delete_id=' . $value['page_ids'] . '><i class="bi bi-trash3 me-2" ></i>Delete</a></li>
                            </ul>
                        </div>
                    </div>';
                    }

                    $html .= '</div>
                        </div>';
                }
            } else {
                $html .= '<p>No Data Found</p>';
            }
        }

        $result_array = array(
            'pages_list' => $html,
        );
        echo json_encode($result_array, true);
        die();
    }
    //Listing deleted pages..
    function deleted_pages_list_data()
    {
        $html = "";
        $status = 0;
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM " . $this->username . "_fb_pages AS p
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND p.is_status IN (1)");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $status = 1;
            foreach ($result_facebook_data as $key => $value) {
                $simbol = '';
                if ($value['is_status'] == 4) {
                    $simbol = '<i class="fa-solid fa-triangle-exclamation fa-xl text-danger" title="Lost Connection"></i>';
                }
                $integrationData = $this->MasterInformationModel->edit_entry2($this->username . '_platform_integration', $value['connection_id']);
                $integrationData = get_object_vars($integrationData[0]);
                $platform_status = $integrationData['platform_status'];
                if ($value['user_id'] == 0) {
                    $assign_id = 0;
                    $staff_id = '';
                } else {
                    $assign_id = 1;
                    $staff_id = $value['user_id'];
                }
                if ($platform_status == 2) {
                    $queryd = $this->db->query("SELECT form_id, COUNT(*) AS form_count
                    FROM " . $this->username . "_integration
                    WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=1");
                    $count_lead = $queryd->getResultArray();
                    $count = 0;
                    if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                        $count = $count_lead[0]['form_count'];
                    }
                    $queryds = $this->db->query("SELECT form_id, COUNT(*) AS form_counts
                            FROM " . $this->username . "_integration
                            WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=2");
                    $count_leads = $queryds->getResultArray();
                    $counts = 0;
                    if (isset($count_leads[0]['form_counts']) && !empty($count_leads[0]['form_counts'])) {
                        $counts = $count_leads[0]['form_counts'];
                    }
                    $form_name = "";
                    if (isset($value['form_name']) && !empty($value['form_name'])) {
                        $form_name = $value['form_name'];
                    }
                    if (isset($value['page_img']) && !empty($value['page_img'])) {
                        $page_img = $value['page_img'];
                    } else {
                        $page_img = "https://dev.realtosmart.com/assets/images/f_intigration.svg";
                    }
                    $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <g data-name="Layer 2">
                                            <g data-name="01.facebook">
                                                <circle cx="88" cy="88" r="88" fill="#3a559f" opacity="1" data-original="#3a559f"></circle>
                                                <path fill="#ffffff" d="m115.88 77.58-1.77 15.33a2.87 2.87 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.9a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.78v12.81h17.87a2.88 2.88 0 0 1 2.82 3.25z" opacity="1" data-original="#ffffff"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>';
                    $page_img_div = '<div class="mx-1">
                                        <img src="' . $page_img . '">
                                    </div>';
                    $connection_name = $value['page_name'] . '(' . $form_name . ')';
                    $leadlist_urlId = $value['form_id'];
                } else if ($platform_status == 5) {
                    $queryd = $this->db->query("SELECT COUNT(*) AS form_count
                    FROM " . $this->username . "_integration
                    WHERE platform = 'website' AND page_id=" . $value['id']);
                    $count_lead = $queryd->getResultArray();
                    $count = 0;
                    if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                        $count = $count_lead[0]['form_count'];
                    }
                    $connection_name = $integrationData['website_name'];
                    $page_img_div = '';
                    $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                        <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                        <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                        <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                        <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>';
                    $leadlist_urlId = $value['id'];
                }
                $html .= '<div class="lead_list p-2 rounded-2 position-relative">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap">
                            <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                            <div class="mx-1">
                            ' . $logo_img . '
                           </div>
                        ' . $page_img_div . '
                               <div class="load-icon center">
                                	<span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                	<span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                    <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                	<span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                </div>          
                                <div class="mx-1">
                                   <img src="https://ajasys.com/img/favicon.png" style="width: 45px;">
                                </div>
                            </div>
                            <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill" href="' . base_url() . 'leadlist?id=' . $leadlist_urlId . '&platform=' . $platform_status . '">
                                <p class="d-block col-12 text-dark">' . $value['page_name'] . '(' . $form_name . ')</p>
                                <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12">
                                <i class="bi bi-gear me-1"></i>
                                <span class="me-2">' . $count . '</span>
                                    <i class="bi bi-person me-1"></i>
                                    <span>' . $_SESSION['username'] . '</span>
                                </div>
                            </a></div>
                            <div>' . $simbol . '</div>
                            </div>
                        </div>';
            }
        } else {
            $html .= '<p>No Data Found</p>';
            $status = 0;
        }
        $result_array = array(
            'pages_list' => $html,
            'pages_list_status' => $status,
        );
        echo json_encode($result_array, true);
        die();
    }
    //Listing old connection data pages..
    function updated_pages_list_data()
    {
        $html = "";
        $status = 0;
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM " . $this->username . "_fb_pages AS p
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND p.is_status IN (2)");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $status = 1;
            foreach ($result_facebook_data as $key => $value) {
                $integrationData = $this->MasterInformationModel->edit_entry2($this->username . '_platform_integration', $value['connection_id']);
                $integrationData = get_object_vars($integrationData[0]);
                $platform_status = $integrationData['platform_status'];
                if ($value['user_id'] == 0) {
                    $assign_id = 0;
                    $staff_id = '';
                } else {
                    $assign_id = 1;
                    $staff_id = $value['user_id'];
                }
                if ($platform_status == 2) {
                    $queryd = $this->db->query("SELECT form_id, COUNT(*) AS form_count
                    FROM " . $this->username . "_integration
                    WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=1");
                    $count_lead = $queryd->getResultArray();
                    $count = 0;
                    if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                        $count = $count_lead[0]['form_count'];
                    }
                    $queryds = $this->db->query("SELECT form_id, COUNT(*) AS form_counts
                            FROM " . $this->username . "_integration
                            WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=2");
                    $count_leads = $queryds->getResultArray();
                    $counts = 0;
                    if (isset($count_leads[0]['form_counts']) && !empty($count_leads[0]['form_counts'])) {
                        $counts = $count_leads[0]['form_counts'];
                    }
                    $form_name = "";
                    if (isset($value['form_name']) && !empty($value['form_name'])) {
                        $form_name = $value['form_name'];
                    }
                    if (isset($value['page_img']) && !empty($value['page_img'])) {
                        $page_img = $value['page_img'];
                    } else {
                        $page_img = "https://dev.realtosmart.com/assets/images/f_intigration.svg";
                    }
                    $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <g data-name="Layer 2">
                                            <g data-name="01.facebook">
                                                <circle cx="88" cy="88" r="88" fill="#3a559f" opacity="1" data-original="#3a559f"></circle>
                                                <path fill="#ffffff" d="m115.88 77.58-1.77 15.33a2.87 2.87 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.9a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.78v12.81h17.87a2.88 2.88 0 0 1 2.82 3.25z" opacity="1" data-original="#ffffff"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>';
                    $page_img_div = '<div class="mx-1">
                                        <img src="' . $page_img . '">
                                    </div>';
                    $connection_name = $value['page_name'] . '(' . $form_name . ')';
                    $leadlist_urlId = $value['form_id'];
                } else if ($platform_status == 5) {
                    $queryd = $this->db->query("SELECT COUNT(*) AS form_count
                    FROM " . $this->username . "_integration
                    WHERE platform = 'website' AND page_id=" . $value['id']);
                    $count_lead = $queryd->getResultArray();
                    $count = 0;
                    if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                        $count = $count_lead[0]['form_count'];
                    }
                    $connection_name = $integrationData['website_name'];
                    $page_img_div = '';
                    $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                        <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                        <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                        <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                        <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>';
                    $leadlist_urlId = $value['id'];
                }
                $html .= '
                      <div class="lead_list p-2 rounded-2 position-relative">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                            <div class="mx-1">
                            ' . $logo_img . '
                           </div>
                        ' . $page_img_div . '
                               <div class="load-icon center">
                                	<span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                	<span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                    <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                	<span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                </div>          
                                <div class="mx-1">
                                   <img src="https://ajasys.com/img/favicon.png">
                                </div>
                            </div>
                            <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill" href="' . base_url() . 'leadlist?id=' . $leadlist_urlId . '&platform=' . $platform_status . '">
                                <p class="d-block col-12 text-dark">' . $value['page_name'] . '(' . $form_name . ')</p>
                                <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12">
                                <i class="bi bi-gear me-1"></i>
                                <span class="me-2">' . $count . '</span>
                                    <i class="bi bi-person me-1"></i>
                                    <span>' . $value['username'] . '</span>
                                </div>
                            </a></div></div>';
            }
        } else {
            $html .= '<p>No Data Found</p>';
            $status = 0;
        }
        $result_array = array(
            'pages_list' => $html,
            'pages_list_status' => $status,
        );
        echo json_encode($result_array, true);
        die();
    }
    //Listing draft connection pages..
    function draft_pages_list_data()
    {
        $html = "";
        $status = 0;
        $platform_status = $this->request->getPost("platform_status");
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM " . $this->username . "_fb_pages AS p
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND p.is_status=3");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $status = 1;
            foreach ($result_facebook_data as $key => $value) {
                $integrationData = $this->MasterInformationModel->edit_entry2($this->username . '_platform_integration', $value['connection_id']);
                $integrationData = get_object_vars($integrationData[0]);
                $platform_status = $integrationData['platform_status'];
                if ($value['user_id'] == 0) {
                    $assign_id = 0;
                    $staff_id = '';
                } else {
                    $assign_id = 1;
                    $staff_id = $value['user_id'];
                }
                if ($platform_status == 2) {
                    $queryd = $this->db->query("SELECT form_id, COUNT(*) AS form_count
                    FROM " . $this->username . "_integration
                    WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=1");
                    $count_lead = $queryd->getResultArray();
                    $count = 0;
                    if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                        $count = $count_lead[0]['form_count'];
                    }
                    $queryds = $this->db->query("SELECT form_id, COUNT(*) AS form_counts
                            FROM " . $this->username . "_integration
                            WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=2");
                    $count_leads = $queryds->getResultArray();
                    $counts = 0;
                    if (isset($count_leads[0]['form_counts']) && !empty($count_leads[0]['form_counts'])) {
                        $counts = $count_leads[0]['form_counts'];
                    }
                    $form_name = "";
                    if (isset($value['form_name']) && !empty($value['form_name'])) {
                        $form_name = $value['form_name'];
                    }
                    if (isset($value['page_img']) && !empty($value['page_img'])) {
                        $page_img = $value['page_img'];
                    } else {
                        $page_img = "https://dev.realtosmart.com/assets/images/f_intigration.svg";
                    }
                    $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <g data-name="Layer 2">
                                            <g data-name="01.facebook">
                                                <circle cx="88" cy="88" r="88" fill="#3a559f" opacity="1" data-original="#3a559f"></circle>
                                                <path fill="#ffffff" d="m115.88 77.58-1.77 15.33a2.87 2.87 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.9a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.78v12.81h17.87a2.88 2.88 0 0 1 2.82 3.25z" opacity="1" data-original="#ffffff"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>';
                    $page_img_div = '<div class="mx-1">
                                        <img src="' . $page_img . '">
                                    </div>';
                } else if ($platform_status == 5) {
                    $page_img_div = '';
                    $logo_img = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                        <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                        <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                        <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                        <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>';
                }
                $html .= '<div class="lead_list p-2 rounded-2 position-relative">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                    <div class="mx-1">
                                        ' . $logo_img . '
                                       </div>
                                    ' . $page_img_div . '
                                    <div class="load-icon center">
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                        <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                    </div>  
                                    <div class="mx-1">
                                    <img src="https://ajasys.com/img/favicon.png" style="width: 45px;">
                                    </div>
                                </div>
                                <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill">
                                    <div class="d-flex align-items-center">
                                        <div class="d_saved_1">
                                            <button class="btn-primary-rounded fs-14">1</button>
                                        </div>   
                                        <div class="mx-1" style="width: 50px; border: 2px solid var(--first-color);"></div>
                                        <div class="d_unsaved_3">
                                            <button class="btn-primary-rounded fs-14 bg-secondary-subtle border-0 shadow-sm text-dark">?</button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12">
                                        <i class="bi bi-person me-1"></i>
                                        <span>' . $_SESSION['username'] . '</span>
                                    </div>
                                </a>
                                ';
                $html .= '<div class="lead_list_switch d-flex align-items-center flex-wrap">
                                <div class="dropdown">
                                    <button class="bg-transparent border-2 rounded-2 border p-1 dropdown-toggle after-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-caret-down-fill fs-12 text-secondary-emphasis"></i>
                                    </button>
                                    <ul class="dropdown-menu py-2">
                                        <li onclick="EditScenarios(\'' . $value['page_ids'] . '\',\'' . $platform_status . '\');"><a class="dropdown-item edit_page" data-edit_id=' . $value['page_ids'] . '><i class="fas fa-pencil-alt me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item delete_page" data-delete_id=' . $value['page_ids'] . ' data-draft="1"><i class="bi bi-trash3 me-2" ></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div></div></div></div>';
            }
        } else {
            $html .= '<p>No Data Found</p>';
            $status = 0;
        }
        $result_array = array(
            'pages_list' => $html,
            'pages_list_status' => $status,
        );
        echo json_encode($result_array, true);
        die();
    }
    function queue_list_add()
    {
        $db_connection = DatabaseDefaultConnection();
        $form_id = $this->request->getPost("form_id");
        $result_res = array();
        $queryd = $this->db->query("SELECT *,i.id AS inte_id
          FROM " . $this->username . "_integration AS i
          JOIN " . $this->username . "_fb_pages AS p ON i.form_id = p.form_id
          WHERE i.form_id = " . $form_id . " AND i.page_id != '' AND i.fb_update = 2");
        $count_lead = $queryd->getResultArray();
        $count_num = $queryd->getNumRows();
        if ($count_num > 0) {
            // while ($row = $result_page->fetch_assoc()) {
            foreach ($count_lead as $aa_key => $row) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => MetaUrl() . $row['lead_id'] . '?access_token=' . $row['page_access_token'] . '',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Cookie: fr=07Ds3K9rxHgvySJql..Bk0it9.VP.AAA.0.0.Bk0iu5.AWV1ZxCk_bw'
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($response, true);
                $intrested_product = $row['intrested_product'];
                // echo '<pre>';   
                $fulll_name = "";
                if (isset($result['field_data'][0])) {
                    $fulll_name = $result['field_data'][0]['values'][0];
                }
                $mobile = '';
                if (isset($result['field_data'][1]['values'][0])) {
                    $mobile = $result['field_data'][1]['values'][0];
                }
                $email = "";
                if (isset($result['field_data'][2])) {
                    $email = $result['field_data'][2]['values'][0];
                }
                if ($mobile != '') {
                    $mobile_nffo_remove = str_replace(" ", "", $mobile);
                    $mobile_nffo = substr($mobile_nffo_remove, -10);
                } else {
                    $mobile_nffo = '0000000000';
                }
                $mobile_nffo = "";
                //date_default_timezone_set('Asia/Kolkata');
                $nxt_follow_up = Utctime('Y-m-d H:i:s', $this->timezone, date('Y-m-d H:i:s'));
                if ($mobile != '') {
                    $mobile_nffo_remove = str_replace(" ", "", $mobile);
                    $mobile_nffo = substr($mobile_nffo_remove, -10);
                }
                $table_name = 'all_inquiry';
                $user_list_executive = array();
                $not_valid_status = '"4","7","9"';
                $user_child = array();
                $user_parent = array();
                $sitewisechild = "SELECT t1.id AS child_id, t1.parent_id AS parent_id FROM  " . $this->username . "_userrole t1 LEFT JOIN " . $this->username . "_userrole t2 ON t1.id = t2.parent_id WHERE t2.parent_id IS NULL";
                $cntdata = $db_connection->query($sitewisechild);
                $cntdatas = $cntdata->getResultArray();
                foreach ($cntdatas as $k => $v) {
                    if (!empty($v['child_id'])) {
                        $user_child[] = $v['child_id'];
                        $user_parent[] = $v['parent_id'];
                    }
                }
                $user_list_executive = array();
                if (isset($user_child) && !empty($user_child)) {
                    $sitewiseexecutive = "SELECT * FROM " . $this->username . "_user where switcher_active ='active' AND role IN (" . implode(",", $user_child) . ")";
                    $cntdata = $db_connection->query($sitewiseexecutive);
                    $cntdatasa = $cntdata->getResultArray();
                    foreach ($cntdatasa as $k => $v) {
                        if (!empty($v['job_location_id'])) {
                            $user_list_executive[$v['job_location_id']][] = $v['id'];
                        }
                    }
                }
                if (isset($user_parent) && !empty($user_parent)) {
                    $sitewisemanager = "SELECT * FROM " . $this->username . "_user where switcher_active ='active' AND role  IN (" . implode(",", $user_parent) . ") ";
                    $cntdata = $db_connection->query($sitewisemanager);
                    $cntdatas_manger = $cntdata->getResultArray();
                    foreach ($cntdatas_manger as $k_m => $v_m) {
                        if (!empty($v_m['job_location_id'])) {
                            $user_list_manager[$v_m['job_location_id']][] = $v_m['id'];
                        }
                    }
                }
                $deer = 'SELECT * FROM ' . $this->username . '_integration where unquie_id IN ( SELECT max(unquie_id) FROM ' . $this->username . '_integration  where `fb_update` = 1 group by form_id )';
                $result1 = $db_connection->query($deer);
                $cntdatasss = $result1->getResultArray();
                $assign_id = 0;
                foreach ($cntdatasss  as $user => $user_value) {
                    if ($user_value['form_id'] == $form_id) {
                        $assign_id = $user_value['assign_id'];
                    }
                }
                $next = 1;
                $cccd = 0;
                foreach ($user_list_executive as $k => $v) {
                    if ($intrested_product == $k) {
                        $count = count($v);
                        $values = array_values($v);
                        $search = array_search($assign_id, $values);
                        $next = $values[(1 + $search) % count($values)];
                        $cccd = 1;
                    }
                }
                if ($cccd == 0) {
                    foreach ($user_list_manager as $k_m => $v_m) {
                        if ($intrested_product == $k_m) {
                            $count = count($v_m);
                            $values = array_values($v_m);
                            $search = array_search($assign_id, $values);
                            $next = $values[(1 + $search) % count($values)];
                            $cccd = 1;
                        }
                    }
                }
                $cntdata_duplicate = "SELECT count(*) as count FROM " . $this->username . "_all_inquiry where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "'";
                $cntdata = $db_connection->query($cntdata_duplicate);
                $cntdatas = $cntdata->getResult();
                $full = $fulll_name;
                if (is_string($mobile_nffo)) {
                    $full = $mobile_nffo;
                    $mobile_nffo = $fulll_name;
                }
                $insert_data['assign_id'] = $next;
                $insert_data['owner_id'] = $next;
                $insert_data['user_id'] = $next;
                $insert_data['head'] = 2;
                $insert_data['mobileno'] = !empty($mobile_nffo) ? $mobile_nffo : '';
                $insert_data['full_name'] =  isset($full) ? $full : '';
                $insert_data['property_sub_type'] = isset($row['property_sub_type']) ? $row['property_sub_type'] : '';
                $insert_data['intrested_product'] = isset($row['intrested_product']) ? $row['intrested_product'] : '';
                $insert_data['inquiry_type'] = 1;
                $insert_data['inquiry_source_type'] = 2;
                $insert_data['nxt_follow_up'] = isset($nxt_follow_up) ? $nxt_follow_up : '';
                $insert_data['inquiry_status'] = "1";
                $insert_data['ad_id'] = $row['ad_id'];
                $insert_data['adset_id'] = $row['ad_id'];
                $insert_data['campaign_id'] = $row['ad_id'];
                $insert_data['form_id'] = $row['form_id'];
                $responce_insert = 0;
                // pre($this->username . $table_name);
                $isduplicate = $this->duplicate_data_check_mobile_number($this->username . "_" . $table_name, $mobile_nffo);
                if ($isduplicate == 0) {
                    //pre($mobile_nffo);
                    $response = $this->MasterInformationModel->insert_entry($insert_data, $this->username . "_" . $table_name);
                    $departmentdisplaydata = $this->MasterInformationModel->display_all_records($this->username . "_" . $table_name);
                    $departmentdisplaydata = json_decode($departmentdisplaydata, true);
                    $result_res['response'] = 1;
                    $result_res['message'] = 'Queue process succesfully !';
                    $update_data['full_name'] = isset($fulll_name) ? $fulll_name : '';
                    $update_data['phone_number'] = !empty($mobile_nffo) ? $mobile_nffo : '';
                    $update_data['assign_id '] = $next;
                    $update_data['created_time '] = $nxt_follow_up;
                    $update_data['fb_update '] = 1;
                    $departmentUpdatedata = $this->MasterInformationModel->update_entry($row['inte_id'], $update_data, $this->username . '_integration');
                } else {
                    $find_Array = array(
                        'mobileno' => $mobile_nffo,
                        'inquiry_status' => '7'
                    );
                    $find_Array_12 = array(
                        'mobileno' =>  $mobile_nffo,
                        'inquiry_status' => '12'
                    );
                    $find_Array_all = "SELECT * FROM " . $this->username . "_" . $table_name . " where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "'";
                    $find_Array_all = $this->db->query($find_Array_all);
                    $isduplicate_all_data = $find_Array_all->getResultArray();
                    $satusus_id = array('1', '2', '3', '4', '5', '6', '9', '10', '11', '13');
                    $repo = 0;
                    if (!empty($isduplicate_all_data)) {
                        foreach ($isduplicate_all_data as $key => $values) {
                            if (in_array($values['inquiry_status'], $satusus_id)) {
                                $repo = 1;
                            }
                        }
                    }
                    //pre("duplicate_".$mobile_nffo);
                    if ($repo == 0) {
                        $inquiry_log_data = array();
                        $response = $this->MasterInformationModel->insert_entry($insert_data, $this->username . "_" . $table_name);
                        if ($response) {
                            $inquiry_log_data['inquiry_id'] = $response;
                            $user_data =  $this->user_id_to_full_user_data($next);
                            $inquiry_log_data['inquiry_id'] = $response;
                            $inquiry_log_data['status_id'] = 1;
                            $inquiry_log_data['created_at'] = Utctime('Y-m-d H:i:s', $this->timezone,  date("Y-m-d H:i:s"));
                            $log_content = '';
                            if ($insert_data['inquiry_status'] == "1") {
                                $log_content .= 'Auto Generated  Lead by Facebook And assign By ' . $user_data['firstname'];
                            }
                            $inquiry_log_data['inquiry_log'] = $log_content;
                            $response_log = $this->MasterInformationModel->insert_entry($inquiry_log_data, $this->username . "_inquiry_log");
                            $result_res['response'] = 1;
                            $result_res['message'] = 'Queue process succesfully !';
                            $update_data['full_name'] = isset($fulll_name) ? $fulll_name : '';
                            $update_data['phone_number'] = !empty($mobile_nffo) ? $mobile_nffo : '';
                            $update_data['assign_id '] = $next;
                            $update_data['created_time '] = $nxt_follow_up;
                            $update_data['fb_update '] = 1;
                            $departmentUpdatedata = $this->MasterInformationModel->update_entry($row['inte_id'], $update_data, $this->username . '_integration');
                        } else {
                            $update_data['full_name'] = isset($fulll_name) ? $fulll_name : '';
                            $update_data['phone_number'] = !empty($mobile_nffo) ? $mobile_nffo : '';
                            $update_data['assign_id '] = $next;
                            $update_data['created_time '] = $nxt_follow_up;
                            $update_data['fb_update '] = 1;
                            $result_res['response'] = 0;
                            $result_res['message'] = 'Something Went Wrong !';
                        }
                    }
                }
            }
        } else {
            $result_res['response'] = 0;
            $result_res['message'] = 'Something Went Wrong !';
        }
        //PRE($result_res);
        echo json_encode($result_res);
        die();
    }
    public function duplicate_data_check_mobile_number($table, $mobileno, $field = "")
    {
        $this->db = DatabaseDefaultConnection();
        $i = 0;
        if (!empty($field)) {
            $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $field . ' =' . $mobileno;
        } else {
            $sql = 'SELECT * FROM ' . $table . ' WHERE mobileno =' . $mobileno . ' OR altmobileno=' . $mobileno;
        }
        $result = $this->db->query($sql);
        if ($result->getNumRows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    //view lead details..
    public function view_integrate_lead()
    {
        $this->db = DatabaseDefaultConnection();
        $id = $this->request->getPost("unquie_id");
        $result_res = array();
        $queryd = $this->db->query("SELECT * FROM " . $this->username . "_integration WHERE unquie_id = " . $id);
        $count_lead = $queryd->getResultArray();
        $count_num = $queryd->getNumRows();
        echo json_encode($count_lead);
    }
    //Listing leads..
    public function lead_list()
    {
        $this->db = DatabaseDefaultConnection();
        $platform = $_POST['platform'];
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
        if ($platform == 2) //for facebook
        {
            // Build the SQL query for data retrieval
            $find_Array_data = "SELECT * FROM " . $username . "_integration 
            WHERE form_id = " . $_POST['id'] . " AND page_id != '' ";
            // Build the SQL query for total count
            $find_Array_count = "SELECT COUNT(*) as total_count FROM " . $username . "_integration 
                                WHERE form_id = " . $_POST['id'] . " AND page_id != '' ";
        } else if ($platform == 5) //for website
        {
            $find_Array_data = "SELECT * FROM " . $username . "_integration 
                                WHERE page_id = " . $_POST['id'] . " AND platform='website'";
            $find_Array_count = "SELECT COUNT(*) as total_count FROM " . $username . "_integration 
                                WHERE page_id = " . $_POST['id'] . " AND platform='website'";
        }
        // Add search condition if ajaxsearch is provided
        if (!empty($ajaxsearch)) {
            $find_Array_data .= " AND (
                lead_id LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                full_name LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                phone_number LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                inquiry_id LIKE '%" . $_POST['ajaxsearch'] . "%'
            ) ";
        }
        $find_Array_data .= "ORDER BY unquie_id DESC 
                             LIMIT $perPageCount OFFSET $offset";
        // Execute the query for data retrieval
        $find_Array_data = $this->db->query($find_Array_data);
        $data = $find_Array_data->getResultArray();
        // Add search condition if ajaxsearch is provided
        if (!empty($ajaxsearch)) {
            $find_Array_count .= " AND (
                lead_id LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                full_name LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                phone_number LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                inquiry_id LIKE '%" . $_POST['ajaxsearch'] . "%'
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
                $html .= '<tr onclick="viewLead(' . $value['unquie_id'] . ');">
                <td class="p-2 text-nowrap">' . $value['created_time'] . '</td>';
                if ($platform == 2) //for facebook
                {
                    $html .= '<td class="p-2 text-nowrap">' . $value['lead_id'] . '</td>';
                } else if ($platform == 5) //for website
                {
                }
                $html .= '
                <td class="p-2 text-nowrap">' . $value['full_name'] . '</td>
                <td class="p-2 text-nowrap ">' . $value['phone_number'] . '</td>
                <td class="p-2 text-nowrap ">' . $value['inquiry_id'] . '</td>
                <td class="p-2 text-nowrap text-center">';
                if ($value['fb_update'] == 1) {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Success">Success</span>';
                } else if ($value['fb_update'] == 2) {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Warning">Queue</span>';
                } else if ($value['fb_update'] == 4) {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Info">Reopen</span>';
                } else if ($value['fb_update'] == 3) {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Error">Duplicated</span>';
                } else {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Error">failure</span>';
                }
                $html .=  '</td>
                <td class="p-2 text-nowrap text-center">';
                if ($value['lead_status'] == 1) {
                    $html .=  '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 520 520" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <g data-name="15-Checked">
                                    <circle cx="208.52" cy="288.5" r="176.52" fill="#b0ef8f" opacity="1" data-original="#b0ef8f"></circle>
                                    <path fill="#009045" d="m210.516 424.937-2.239-3.815c-34.2-58.27-125.082-181.928-126-183.17l-1.311-1.781 30.963-30.6 98.012 68.439c61.711-80.079 119.283-135.081 156.837-167.2C407.859 71.675 434.6 55.5 434.87 55.345l.608-.364H488l-5.017 4.468C353.954 174.375 214.1 418.639 212.707 421.093z" opacity="1" data-original="#009045">
                                    </path>
                                </g>
                            </g>
                        </svg>';
                } else if ($value['lead_status'] == 2) {
                    $html .=  '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="21" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <ellipse cx="256" cy="256" rx="256" ry="255.832" style="" fill="#e21b1b" data-original="#e21b1b" class=""></ellipse>
                                <path d="M228.021 113.143h55.991v285.669h-55.991z" style="" transform="rotate(-45.001 256.015 255.982)" fill="#ffffff" data-original="#ffffff" class=""></path>
                                <path d="M113.164 227.968h285.669v55.991H113.164z" style="" transform="rotate(-45.001 255.997 255.968)" fill="#ffffff" data-original="#ffffff" class=""></path>
                            </g>
                        </svg>';
                } else if ($value['lead_status'] == 0) {
                    $html .=  '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <g fill="#e81542" data-name="Layer 5">
                                    <path d="M51.45 21.21A19.46 19.46 0 0 0 18.5 7.94a19.31 19.31 0 0 0-6 14 1.5 1.5 0 0 0 1.5 1.5h10.6A1.5 1.5 0 0 0 26.1 22a5.89 5.89 0 0 1 5.9-5.93h.24a6 6 0 0 1 5.65 5.66A5.91 5.91 0 0 1 35 27a20.25 20.25 0 0 0-9.81 17.21 1.5 1.5 0 0 0 1.5 1.5h10.59a1.5 1.5 0 0 0 1.5-1.5A6.53 6.53 0 0 1 42 38.64a19.49 19.49 0 0 0 9.45-17.43z" fill="#e81542" opacity="1" data-original="#e81542" class=""></path>
                                    <circle cx="32" cy="54.72" r="6.78" fill="#e81542" opacity="1" data-original="#e81542" class=""></circle>
                                </g>
                            </g>
                        </svg>';
                }
                $html .=  '</td><td class="p-2 text-nowrap text-center">';
                if ($value['platform'] == 'website') {
                    $html .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                        <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                        <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                        <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                        <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>';
                } else if ($value['platform'] == 'ig') {
                    $html .= '<i class="fa-brands fa-instagram transition-5 icon1" style="font-size: 20px;background: -webkit-linear-gradient(#f32170, #ff6b08, #cf23cf, #eedd44);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>';
                } else if ($value['platform'] == 'fb') {
                    $html .= '<i class="fa-brands fa-facebook transition-5 icon2 rounded-circle fa-lg" style="color: #0b85ed;"></i>';
                } else {
                    $html .= '';
                }
                $html .= '</td></tr>';
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
    //Listing Fb connection list..
    public function fb_connection_list()
    {
        $this->db = DatabaseDefaultConnection();
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
                            WHERE platform_status=2 ";
        // Add search condition if ajaxsearch is provided
        if (!empty($ajaxsearch)) {
            $find_Array_data .= " AND (
                fb_app_name LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                fb_app_id LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                fb_app_type LIKE '%" . $_POST['ajaxsearch'] . "%'
            ) ";
        }
        $find_Array_data .= " ORDER BY id DESC 
                             LIMIT $perPageCount OFFSET $offset";
        // Execute the query for data retrieval
        $find_Array_data = $this->db->query($find_Array_data);
        $data = $find_Array_data->getResultArray();
        // Build the SQL query for total count
        $find_Array_count = "SELECT COUNT(*) as total_count FROM " . $username . "_platform_integration 
                            WHERE platform_status=2";
        // Add search condition if ajaxsearch is provided
        if (!empty($ajaxsearch)) {
            $find_Array_count .= " AND (
                fb_app_name LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                fb_app_id LIKE '%" . $_POST['ajaxsearch'] . "%' OR 
                fb_app_type LIKE '%" . $_POST['ajaxsearch'] . "%'
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
                <td class="p-2 text-nowrap">' . $value['fb_app_name'] . '</td>
                <td class="p-2 text-nowrap">' . $value['fb_app_id'] . '</td>
                <td class="p-2 text-nowrap">' . $value['fb_app_type'] . '</td>
                <td class="p-2 text-nowrap"></td>
                <td class="p-2 text-nowrap">';
                if ($value['verification_status'] == 1) {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Success">connect</span>';
                } else {
                    $html .=  '<span class="rounded-2 text-white fs-12 sm-btn Error">failure</span>';
                }
                $html .=  '</td>
                    <td class="p-2 text-nowrap text-center">
                        <button type="button" class="ms-auto btn-primary px-2 py-1 rounded-1 fs-12 get-permission" data-bs-toggle="modal" data-bs-target="#informaion_connection" data-access-token="' . $value['access_token'] . '">
                           View
                        </button>
                        <i class="fa-solid fa-trash-can text-danger px-2" onclick="deletefbconn(' . $value['id'] . ');"></i>
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
    //Listing fb permission list
    public function fb_permission_list()
    {
        if (isset($_POST['access_token'])) {
            $result = getSocialData(MetaUrl().'me/permissions?access_token=' . $_POST['access_token']);
            if (isset($result['data'])) {
                $tableHtml = '<table style="width: 100%;">';
                $tableHtml .= '<tr><th>Permission</th><th>Status</th></tr>';
                // $tableHtml .= '<td>' . htmlspecialchars($permission['status']) . '<i class="fa-solid fa-check text-success fa-lg"></i></td>';
                foreach ($result['data'] as $permission) {
                    $tableHtml .= '<tr>';
                    $tableHtml .= '<td>' . htmlspecialchars($permission['permission']) . '</td>';
                    $tableHtml .= '<td style="text-align: center;"><i class="fa-solid fa-check text-success fa-lg"></i></td>';
                    $tableHtml .= '</tr>';
                }
                $tableHtml .= '</table>';
                $return_array['tableHtml'] = $tableHtml;
                $return_array['response'] = 1;
            } else {
                $return_array['tableHtml'] = '';
                $return_array['response'] = 0;
            }
        }
        echo json_encode($return_array);
    }
    //Edit scenarious of pages and form..
    public function edit_facebook_scenarious()
    {
        $return_array['response'] = 1;
        $return_array['result'] = '';
        if (isset($_POST['id'])) {
            $query = $this->db->query("SELECT p.*,i.id as connection_id,i.access_token,i.verification_status 
            FROM " . $this->username . "_fb_pages p  
            JOIN " . $this->username . "_platform_integration as i ON i.id=p.connection_id
            WHERE p.id=" . $_POST['id']);
            $rows = $query->getResultArray();
            if ($rows) {
                $return_array['response'] = 1;
                $return_array['result'] = $rows[0];
            }
        }
        echo json_encode($return_array);
    }
   //Delete connections..
   public function delete_fb_connection()
   {
       $return_array['response'] = 0;
       if (isset($_POST['id'])) {

           // $delete_data = $this->MasterInformationModel->delete_entry2($this->username . "_platform_integration", $_POST['id']);
           $this->MasterInformationModel->delete_entry2($this->username . "_platform_assets", $_POST['id'],'platform_id');
           $delete_data = $this->MasterInformationModel->delete_entry2($this->username . "_platform_integration", $_POST['id']);

           // $delete = $this->db->query('DELETE FROM ' . $this->username . '_platform_assets WHERE `platform_id`='.$_POST['id']);
           $update_data = $this->db->query('UPDATE ' . $this->username . '_fb_pages SET `is_status`=4,connection_id=0 WHERE connection_id='.$_POST['id']);
           if ($delete_data && $update_data) {
               $return_array['response'] = 1;
           }
       }
       echo json_encode($return_array);
   }
}
