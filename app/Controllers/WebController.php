<?php

namespace App\Controllers\Campaign;
use App\Controllers\BaseController;
use App\Models\MasterInformationModel;

class WebController extends BaseController
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
                $html .= '<tr class="click_tr" data-bs-toggle="modal" data-bs-target="#Modal_tabel" data-name="' . $value['website_name'] . '" data-token="' . $value['access_token'] . '">
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
        $this->db = DatabaseDefaultConnection();
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
