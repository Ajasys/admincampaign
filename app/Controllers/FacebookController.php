<?php

namespace App\Controllers;

//use CodeIgniter\Database\ConnectionInterface;
use App\Models\MasterInformationModel;
use Config\Database;
class FaceBookController extends BaseController
{
    //private $db;
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

    function check_fb_connection()
    {
        $this->db = \Config\Database::connect();
        $action = $this->request->getPost("action");
        $access_token = $this->request->getPost("access_token");
        $result = getSocialData('https://graph.facebook.com/v19.0/me/accounts?access_token=' . $access_token);

        $errorMsg = 'Something Went wrong..!';
        if (isset($result['error']['message'])) {
            $errorMsg = $result['error']['message'];
        }
        $result_array['response'] = 0;
        $result_array['message'] = $errorMsg;

        if (isset($result['data']) && is_array($result['data']) && $result['data'] != '') {
            $numberOfPages = count($result['data']);
            if ($numberOfPages > 0) {
                $is_facebook_connect = 1;
                $result_array['response'] = 1;
                $result_array['message'] = 'Facebook connected successfully..!';
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

        $update_data['facebook_access_token'] = $access_token;
        $update_data['is_facebook_connect'] = $is_facebook_connect;
        $departmentUpdatedata = $this->MasterInformationModel->update_entry2(1, $update_data, 'admin_generale_setting');

        echo json_encode($result_array, true);
        die();
    }
    //delete
    public function delete_pages_fb()
    {
        $response = array();
        $table_name = array();
        if ($this->request->getPost("action") == "delete") {
            $delete_id = $this->request->getPost('delete_id');
            $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            if ($table_name == 'admin_fb_account') {
                $departmentdisplaydata = $this->MasterInformationModel->delete_entry($table_name, $delete_id);
                $find_Array_all = "DELETE FROM admin_fb_pages where master_id='" . $_SESSION['master'] . "'";
                $find_Array_all = $this->db->query($find_Array_all);
            } else {
                $this->db->query('UPDATE ' . $table_name . ' SET `is_status`=1 WHERE id=' . $delete_id . '');
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
    function facebook_user()
    {
        $action = $this->request->getPost("action");
        $name = $this->request->getPost("name");
        $settings_data = getGeneraleData();

        $errorMsg = 'Something Went wrong..!';

        $resultff = array();
        $resultff['response'] = 0;
        $resultff['message'] = $errorMsg;

        $html = "";

        if ($action == "user") {
            $html .= '<option value="0">Select Page</option>';
            if (isset($settings_data['facebook_access_token']) && $settings_data['is_facebook_connect'] == 1) {
                $pageresult = getSocialData('https://graph.facebook.com/v19.0/me/accounts?access_token=' . $settings_data['facebook_access_token']);
                foreach ($pageresult['data'] as $aa_key => $aa_value) {
                    // print_R($aa_value);

                    // $curl = curl_init();

                    // curl_setopt_array(
                    //     $curl,
                    //     array(
                    //         CURLOPT_URL => 'https://graph.facebook.com/v19.0/oauth/access_token?grant_type=fb_exchange_token&client_id=692703766025178&client_secret=67e1dc6e799ae0ea2af3b38a0fa6face&fb_exchange_token=' . $aa_value['access_token'] . '',
                    //         CURLOPT_RETURNTRANSFER => true,
                    //         CURLOPT_ENCODING => '',
                    //         CURLOPT_MAXREDIRS => 10,
                    //         CURLOPT_TIMEOUT => 0,
                    //         CURLOPT_FOLLOWLOCATION => true,
                    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //         CURLOPT_CUSTOMREQUEST => 'POST',
                    //         CURLOPT_HTTPHEADER => array(
                    //             'Cookie: fr=07Ds3K9rxHgvySJql..Bk0it9.VP.AAA.0.0.Bk0iu5.AWV1ZxCk_bw'
                    //         ),
                    //     )
                    // );

                    // $response = curl_exec($curl);

                    // curl_close($curl);

                    // $result = json_decode($response, true);


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
                $resultff['message'] = 'Please Connect with Facebook..!';
            }
        } 

        $resultff['html'] = $html;
        $resultff['profile_pic'] = '';
        return json_encode($resultff);
        die();
    }
    function facebook_form()
    {
        $resultff = array();
        $html = "";
        $page_id = $this->request->getPost("page_id");
        $access_token = $this->request->getPost("access_token");
    
        try {
            $result = getSocialData('https://graph.facebook.com/v19.0/' . $page_id . '/leadgen_forms?access_token=' . $access_token . '');
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
    function facebook_page()
    {
        $this->db = \Config\Database::connect('second');
        $action = $this->request->getPost("action");
        $page_id = $this->request->getPost("page_id");
        $access_token = $this->request->getPost("access_token");
        $page_name = $this->request->getPost("page_name");
        $area = $this->request->getPost("area") ? $this->request->getPost("area") : 0;
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
        $query = $this->db->query("SELECT * FROM `admin_fb_pages` where form_id=" . $form_id . "");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        $result_array = array();
        if (!empty($action) && $action == "page") {
            if ($count_num == 0) {
                $insert_data['master_id'] = $_SESSION['master'];
                $insert_data['page_access_token'] = $access_token;
                $insert_data['page_id'] = $page_id;
                $insert_data['page_name'] = $page_name;
                $insert_data['intrested_area'] = $area;
                $insert_data['property_sub_type'] = $sub_type;
                $insert_data['intrested_product'] = $int_product;
                $insert_data['user_id'] = $assign_to;
                $insert_data['form_id'] = $form_id;
                $insert_data['form_name'] = $form_name;
                $insert_data['is_status'] = $is_status;
                $response_pictures = getSocialData('https://graph.facebook.com/v19.0/' . $page_id . '/picture?redirect=false&&access_token=' . $access_token . '');
                $insert_data['page_img'] = $response_pictures['data']['url'];
                $response_status_log = $this->MasterInformationModel->insert_entry2($insert_data, 'admin_fb_pages');
                $result_array['id'] = $response_status_log;
                $result_array['page_profile'] = $response_pictures['data']['url'];
                // $result_array['respoance'] = 1;
                // $result_array['msg'] = "Form Connected successfully";
            } else {
                if ($result_facebook_data[0]['is_status'] == 0) {
                    //is_status==0-for fresh to connection
                    $this->db->query('UPDATE `admin_fb_pages` SET `intrested_area`=' . $area . ',`intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ' WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = "Form Re-connect successfully";
                }
                else if ($result_facebook_data[0]['is_status'] == 1) {
                    //is_status==1-for delete to connection
                    $this->db->query('UPDATE `admin_fb_pages` SET `is_status`=0 WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];

                    $result_array['respoance'] = 1;
                    $result_array['msg'] = "Form Re-connect successfully";
                } else if ($result_facebook_data[0]['is_status'] == 3) {
                    //is_status==0-for draft to connection
                    $this->db->query('UPDATE `admin_fb_pages` SET `intrested_area`=' . $area . ',`property_sub_type`=' . $sub_type . ',`intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ',`is_status`=' . $is_status . ' WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = "Form connection successfully";
                } else if ($this->request->getPost("edit_id") == $result_facebook_data[0]['id'] && ($form_id != $result_facebook_data[0]['form_id'] || $is_status == 3)) {
                    //is_status == 2//old to new
                    $this->db->query('UPDATE `admin_fb_pages` SET `is_status`=2 WHERE form_id=' . $form_id . '');

                    $insert_data['master_id'] = $_SESSION['master'];
                    $insert_data['page_access_token'] = $access_token;
                    $insert_data['page_id'] = $page_id;
                    $insert_data['page_name'] = $page_name;
                    $insert_data['intrested_area'] = $area;
                    $insert_data['property_sub_type'] = $sub_type;
                    $insert_data['intrested_product'] = $int_product;
                    $insert_data['user_id'] = $assign_to;
                    $insert_data['form_id'] = $form_id;
                    $insert_data['form_name'] = $form_name;
                    $insert_data['is_status'] = $is_status;
                    $response_pictures = getSocialData('https://graph.facebook.com/v19.0/' . $page_id . '/picture?redirect=false&&access_token=' . $access_token . '');
                    $insert_data['page_img'] = $response_pictures['data']['url'];
                    $response_status_log = $this->MasterInformationModel->insert_entry2($insert_data, 'admin_fb_pages');
                    $result_array['page_profile'] = $response_pictures['data']['url'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = "Form Connected successfully";
                } else if ($this->request->getPost("edit_id")) {
                    $this->db->query('UPDATE `admin_fb_pages` SET `intrested_area`=' . $area . ',`property_sub_type`=' . $sub_type . ',`intrested_product`=' . $int_product . ',`user_id`=' . $assign_to . ' WHERE form_id=' . $form_id . '');
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 1;
                    $result_array['msg'] = "Form Updated successfully";
                } else {
                    $result_array['page_profile'] = $result_facebook_data[0]['page_img'];
                    $result_array['respoance'] = 0;
                    $result_array['msg'] = "Duplicate Form not Allow";
                }
            }
        } else {
            $status = $this->request->getPost("status");
            $this->db->query('UPDATE `admin_fb_pages` SET `status`=' . $status . ' WHERE form_id=' . $form_id . '');
            $result_array['respoance'] = 1;
        }
        echo json_encode($result_array, true);
        die();
    }
    function pages_list_data()
    {
        $html = "";
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM admin_fb_pages AS p
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND p.is_status=0");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            foreach ($result_facebook_data as $key => $value) {
                if ($value['user_id'] == 0) {
                    $assign_id = 0;
                    $staff_id = '';
                } else {
                    $assign_id = 1;
                    $staff_id = $value['user_id'];
                }
                $queryd = $this->db->query("SELECT form_id, COUNT(*) AS form_count
                        FROM admin_integration
                        WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=1");
                $count_lead = $queryd->getResultArray();

                $count = 0;
                if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                    $count = $count_lead[0]['form_count'];
                }
                $queryds = $this->db->query("SELECT form_id, COUNT(*) AS form_counts
                        FROM admin_integration
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

                $html .= '
                      <div class="lead_list p-2 rounded-2 position-relative">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                <div class="mx-1">
                            <img src="' . $page_img . '">
                                </div>
                               
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
                            <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill" href="'.base_url().'leadlist?id=' . $value['form_id'] . '">
                                <p class="d-block col-12 text-dark">' . $value['page_name'] . '(' . $form_name . ')</p>
                                <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12">
                                <i class="bi bi-gear me-1"></i>
                                <span class="me-2">' . $count . '</span>
                                   
                                    <i class="bi bi-person me-1"></i>
                                    <span>'  . $_SESSION['username'] .  '</span>
                                </div>
                            </a>';


                $html .= '<div class="lead_list_switch d-flex align-items-center flex-wrap">
                                <label class="switch_toggle mx-2">';
                if ($value['status'] == 1) {
                    $html .= ' <input type="checkbox" class="page_actiive" value="1" data-form_id=' . $value['form_id'] . ' checked>';
                } else {
                    $html .= ' <input type="checkbox" class="page_actiive" value="0" data-form_id=' . $value['form_id'] . ' >';
                }

                $html .= '  <span class="check_input round"></span>
                                </label>
                                <div class="dropdown">
                                    <button class="bg-transparent border-2 rounded-2 border p-1 dropdown-toggle after-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-caret-down-fill fs-12 text-secondary-emphasis"></i>
                                    </button>
                                    <ul class="dropdown-menu py-2">
                                        <li onclick="EditScenarios(\'' . $value['page_ids'] . '\',\'' . $value['page_id'] . '\',\'' . $value['form_id'] . '\',\'' . $value['intrested_area'] . '\',\'' . $value['intrested_product'] . '\',\'' . $value['property_sub_type'] . '\',\'' . $assign_id . '\',\'' . $staff_id . '\',\'' . $value['page_img'] . '\',\'' . $value['is_status'] . '\');"><a class="dropdown-item edit_page" data-edit_id=' . $value['page_ids'] . '><i class="fas fa-pencil-alt me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item delete_page" data-delete_id=' . $value['page_ids'] . '><i class="bi bi-trash3 me-2" ></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                      ';
            }
        } else {
            $html .= '<p>No Data Found</p>';
        }
        $result_array = array(
            'pages_list' => $html,
        );
        echo json_encode($result_array, true);
        die();
    }
    function deleted_pages_list_data()
    {
        $html = "";
        $status = 0;
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM admin_fb_pages AS p
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND p.is_status=1");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $status = 1;
            foreach ($result_facebook_data as $key => $value) {
                $queryd = $this->db->query("SELECT form_id, COUNT(*) AS form_count
                        FROM admin_integration
                        WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=1");
                $count_lead = $queryd->getResultArray();

                $count = 0;
                if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                    $count = $count_lead[0]['form_count'];
                }
                $queryds = $this->db->query("SELECT form_id, COUNT(*) AS form_counts
                        FROM admin_integration
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

                $html .= '
                      <div class="lead_list p-2 rounded-2 position-relative">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                <div class="mx-1">
                            <img src="' . $page_img . '">
                                </div>
                               
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
                            <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill" href="'.base_url().'leadlist?id=' . $value['form_id'] . '">
                                <p class="d-block col-12 text-dark">' . $value['page_name'] . '(' . $form_name . ')</p>
                                <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12">
                                <i class="bi bi-gear me-1"></i>
                                <span class="me-2">' . $count . '</span>
                                   
                                    <i class="bi bi-person me-1"></i>
                                    <span>' . $_SESSION['username'] . '</span>
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
    function updated_pages_list_data()
    {
        $html = "";
        $status = 0;
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM admin_fb_pages AS p
                JOIN admin_fb_account AS a ON p.master_id = a.master_id
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND is_status=2");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $status = 1;
            foreach ($result_facebook_data as $key => $value) {

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

                $html .= '
                      <div class="lead_list p-2 rounded-2 position-relative">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                <div class="mx-1">
                            <img src="' . $page_img . '">
                                </div>
                               
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
                            <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill" href="'.base_url().'leadlist?id=' . $value['form_id'] . '">
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

    function draft_pages_list_data()
    {
        $html = "";
        $status = 0;
        $query = $this->db->query("SELECT * , p.id AS page_ids
                FROM admin_fb_pages AS p
                WHERE p.master_id = '" . $_SESSION['master'] . "' AND p.is_status=3");
        $result_facebook_data = $query->getResultArray();
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $status = 1;
            foreach ($result_facebook_data as $key => $value) {
                if ($value['user_id'] == 0) {
                    $assign_id = 0;
                    $staff_id = '';
                } else {
                    $assign_id = 1;
                    $staff_id = $value['user_id'];
                }
                $queryd = $this->db->query("SELECT form_id, COUNT(*) AS form_count
                        FROM admin_integration
                        WHERE form_id = " . $value['form_id'] . "  AND page_id != '' AND fb_update=1");
                $count_lead = $queryd->getResultArray();

                $count = 0;
                if (isset($count_lead[0]['form_count']) && !empty($count_lead[0]['form_count'])) {
                    $count = $count_lead[0]['form_count'];
                }
                $queryds = $this->db->query("SELECT form_id, COUNT(*) AS form_counts
                        FROM admin_integration
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

                $html .= '<div class="lead_list p-2 rounded-2 position-relative">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                    <div class="mx-1">
                                        <img src="' . $page_img . '">
                                    </div>
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
                                        <li onclick="EditScenarios(\'' . $value['page_ids'] . '\',\'' . $value['page_id'] . '\',\'' . $value['form_id'] . '\',\'' . $value['intrested_area'] . '\',\'' . $value['intrested_product'] . '\',\'' . $value['property_sub_type'] . '\',\'' . $assign_id . '\',\'' . $staff_id . '\',\'' . $value['page_img'] . '\',\'' . $value['is_status'] . '\');"><a class="dropdown-item edit_page" data-edit_id=' . $value['page_ids'] . '><i class="fas fa-pencil-alt me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item delete_page" data-delete_id=' . $value['page_ids'] . '><i class="bi bi-trash3 me-2" ></i>Delete</a></li>
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
        $db_connection = \Config\Database::connect('second');
        $form_id = $this->request->getPost("form_id");
        $result_res = array();
        $queryd = $this->db->query("SELECT *,i.id AS inte_id
          FROM " . $this->username . "_integration AS i
          JOIN admin_fb_pages AS p ON i.form_id = p.form_id
          WHERE i.form_id = " . $form_id . " AND i.page_id != '' AND i.fb_update = 2");
        $count_lead = $queryd->getResultArray();
        $count_num = $queryd->getNumRows();


        if ($count_num > 0) {
            // while ($row = $result_page->fetch_assoc()) {
            foreach ($count_lead as $aa_key => $row) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://graph.facebook.com/v19.0/' . $row['lead_id'] . '?access_token=' . $row['page_access_token'] . '',
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
                $insert_data['intrested_area'] = $row['intrested_area'];
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
        $this->db = \Config\Database::connect('second');
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

    public function view_integrate_lead()
    {
        $this->db = \Config\Database::connect('second');
        $id = $this->request->getPost("unquie_id");
        $result_res = array();
        $queryd = $this->db->query("SELECT * FROM " . $this->username . "_integration WHERE unquie_id = " . $id);
        $count_lead = $queryd->getResultArray();
        $count_num = $queryd->getNumRows();
        echo json_encode($count_lead);
    }

    public function lead_list()
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
        $find_Array_data = "SELECT * FROM " . $username . "_integration 
                            WHERE form_id = " . $_POST['id'] . " AND page_id != '' ";

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


        // Build the SQL query for total count
        $find_Array_count = "SELECT COUNT(*) as total_count FROM " . $username . "_integration 
                         WHERE form_id = " . $_POST['id'] . " AND page_id != '' ";

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
                <td class="p-2 text-nowrap">' . $value['created_time'] . '</td>
                <td class="p-2 text-nowrap">' . $value['lead_id'] . '</td>
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
                $html .=  '</td></tr>';
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
}
