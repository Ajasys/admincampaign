<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use PhpOffice\PhpSpreadsheet\IOFactory;
use CodeIgniter\I18n\Time;
use DateTime;
use DateTimeZone;

class AudianceController extends BaseController
{
    public function __construct()
    {
        helper("custom");
        $db = db_connect();

        $this->MasterInformationModel = new MasterInformationModel($db);

        $this->username = session_username($_SESSION["username"]);
        $this->admin = 0;
        if (isset($_SESSION["admin"]) && !empty($_SESSION["admin"])) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }
    public function duplicate_data_check_mobile_and_extra_data(
        $tablename,
        $find_Data = []
    ) {
        $this->db = \Config\Database::connect("second");
        $array["response"] = 0;
        $result = $this->db
            ->table($tablename)
            ->where($find_Data)
            ->get();
        if ($result->getNumRows() > 0) {
            $booking_count = $result->getNumRows();
            $result_array = $result->getResultArray()[0];
            $array["result_array"] = $result_array;
            $array["booking_count"] = $booking_count;
            $array["response"] = 1;
        } elseif ($result->getNumRows() == 0) {
            $array["response"] = 2;
        }
        return $array;
    }
    public function edit_data_audience()
    {
        if ($this->request->getPost("action") == "edit") {
            $edit_id = $this->request->getPost("edit_id");
            $table_name = $this->request->getPost("table");
            $username = session_username($_SESSION["username"]);
            $departmentEditdata = $this->MasterInformationModel->edit_entry2(
                $username . "_" . $table_name,
                $edit_id
            );
            return json_encode($departmentEditdata, true);
        }
        die();
    }
    public function update_data_audience()
    {
        $post_data = $this->request->getPost();
        $edit_id = $_POST["edit_id"];
        $table_name = $this->request->getPost("table");
        $username = session_username($_SESSION["username"]);
        $action_name = $this->request->getPost("action");
        $new_name = $_POST["name"];
        $inquiry_data = $_POST["inquiry_data"];
    
        $response = 0;
        if ($action_name == "update") {
            if (!empty($post_data)) {
                $update_data = [
                    "name" => $new_name,
                    "inquiry_data" => $inquiry_data
                ];
    
                $result = $this->MasterInformationModel->update_entry_by_name(
                    $edit_id,
                    $update_data,
                    $username . "_" . $table_name
                );
                $response = 1;
            }
        }
        echo $response;
        die();
    }
    public function view_integrate_lead_audience()
    {
        // Retrieve POST data
        $request = $this->request;
        $id = $request->getPost("id");
        $name = $request->getPost("name");
        $subtype = $request->getPost("subtype");
        $count_range = $request->getPost("count_range");
        $time_updated = $request->getPost("time_updated");
        $time_created = $request->getPost("time_created");
        $access_token = $request->getPost("access_token");

        // Validate and process the data as needed
        // For example, you might want to perform database operations, call other functions, etc.

        // Prepare response data
        $responseData = [
            "id" => $id,
            "name" => $name,
            "subtype" => $subtype,
            "count_range" => $count_range,
            "time_updated" => $time_updated,
            "time_created" => $time_created,
            // Add other data as needed
        ];

        // Encode response data to JSON format
        $jsonResponse = json_encode($responseData);

        // Send JSON response
        return $this->response->setJSON($jsonResponse);
    }

    // public function audience_facebook_data() {
    //     $html = "";
    //     if ($_POST['action'] == 'facebook_list') {
    //         $token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';

    //         // Fetch user data including ad accounts
    //         $url = "https://graph.facebook.com/v2.8/me?fields=id%2Cname%2Cadaccounts&access_token=$token";
    //         $response = file_get_contents($url);
    //         $data = json_decode($response, true);

    //         // Check if 'adaccounts' data exists and iterate over each ad account
    //         if (isset($data['adaccounts']['data'])) {
    //             $chat_list_html = '';
    //             foreach ($data['adaccounts']['data'] as $ad_account) {
    //                 $account_id = $ad_account['id'];

    //                 // Fetch custom audiences for each ad account
    //                 $url = "https://graph.facebook.com/v19.0/$account_id/customaudiences?fields=id,account_id,name,time_created,time_updated,subtype,approximate_count_lower_bound,approximate_count_upper_bound&access_token=$token";
    //                 $response = file_get_contents($url);
    //                 $audience_data = json_decode($response, true);

    //                 // Iterate over custom audiences data and build HTML
    //                 foreach ($audience_data['data'] as $conversion_value) {
    //                     $chat_list_html = "";
    //                     $lower_bound = $conversion_value['approximate_count_lower_bound'];
    //                     $upper_bound = $conversion_value['approximate_count_upper_bound'];
    //                     $count_range = ($lower_bound == -1 && $upper_bound == -1) ? "Not available" : "$lower_bound-$upper_bound";

    //                     $chat_list_html .= '<tr class="audiance_view audiance_show_data" onclick="ViewFbAudiances(\'' . $conversion_value['id'] . '\',\'' . $conversion_value['name'] . '\',\'' . $conversion_value['subtype'] . '\',\'' . $count_range . '\',\'' . date('d-m-Y H:i', $conversion_value['time_updated']) . '\',\'' . date('d-m-Y H:i', $conversion_value['time_created']) . '\');">';
    //                     $chat_list_html .= '     <td><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0" y="0" viewBox="0 0 408.788 408.788" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M353.701 0H55.087C24.665 0 .002 24.662.002 55.085v298.616c0 30.423 24.662 55.085 55.085 55.085h147.275l.251-146.078h-37.951a8.954 8.954 0 0 1-8.954-8.92l-.182-47.087a8.955 8.955 0 0 1 8.955-8.989h37.882v-45.498c0-52.8 32.247-81.55 79.348-81.55h38.65a8.955 8.955 0 0 1 8.955 8.955v39.704a8.955 8.955 0 0 1-8.95 8.955l-23.719.011c-25.615 0-30.575 12.172-30.575 30.035v39.389h56.285c5.363 0 9.524 4.683 8.892 10.009l-5.581 47.087a8.955 8.955 0 0 1-8.892 7.901h-50.453l-.251 146.078h87.631c30.422 0 55.084-24.662 55.084-55.084V55.085C408.786 24.662 384.124 0 353.701 0z" style="" fill="#475993" data-original="#475993" class=""></path></g></svg></td>
    //                             <td class="p-2 text-nowrap">' . $conversion_value['name'] . '</td>
    //                             <td class="p-2 text-nowrap">' . $conversion_value['subtype'] . '</td>
    //                             <td class="p-2 text-nowrap">' . $count_range . '</td>
    //                             <td class="p-2 text-nowrap fs-12"><span class="text-muted d-block">Last Edited</span>'.date('d-m-Y H:i', $conversion_value['time_updated']).'</td>
    //                             <td class="p-2 text-nowrap">'.date('d-m-Y H:i', $conversion_value['time_created']).'</td>

    //                             <td class="p-2 text-nowrap">' . $conversion_value['id'] . '</td>';
    //                             $chat_list_html .= '</tr>';
    //                             $html .= $chat_list_html;
    //                 }
    //             }
    //             // $return_result['chat_list_html'] = $chat_list_html;
    //             if (!empty($html)) {
    //                 echo $html;
    //             } else {
    //                 echo '<p style="text-align:center;">Data Not Found </p>';
    //             }
    //         } else {
    //             // No ad account data found
    //             return json_encode(['error' => 'No ad account data found']);
    //         }
    //     } else {
    //         // Invalid action
    //         return json_encode(['error' => 'Invalid action']);
    //     }
    // }

    public function audience_list_data()
    {
        $table_name = $_POST["table"];
        $username = session_username($_SESSION["username"]);
        $action = $_POST["action"];
        $i = 1;
        $html = "";
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records2(
            $username . "_" . $table_name
        );
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);
        $sql2 =
            "SELECT COUNT(*) as sub_count, name FROM " . $this->username . "_audience GROUP BY name";
        $user_db_connection = \Config\Database::connect("second");
        $sql_run = $user_db_connection->query($sql2);
        $paydone_data_get = $sql_run->getResultArray();
        $uniqueCombinations = [];
        foreach ($departmentdisplaydata as $key => $value) {
            $combination =
                $value["name"] .
                "-" .
                $value["inquiry_status"] .
                "-" .
                $value["retansion"] .
                "-" .
                $value["source"] .
                "-" .
                $value["is_status_active"];

            // Skip if the current row's combination has already been encountered
            if (in_array($combination, $uniqueCombinations)) {
                continue; // Skip this row if it's a duplicate combination
            }

            $ts = "";
            $ts .=
                '<tr class="audiance_view audiance_show_data" data-view_id="' .
                $value["id"] .
                '"data-edit_id="' .
                $value["id"] .
                '">
                    <td><img src="https://ajasys.com/img/favicon.png" style="width:15px;height:15px;"></td>
                    <td class="p-2 text-nowrap"> ' .
                $value["name"] .
                '</td>
                    <td class="p-2 text-nowrap">' .
                $value["source"] .
                "</td>";

            // Iterate through the results of the SQL query to match the inquiry_status
            foreach ($paydone_data_get as $status) {
                if ($value["name"] == $status["name"]) {
                    $ts .= "<td>" . $status["sub_count"] . "</td>";
                    break; // Once the match is found, break out of the loop
                }
            }

            $ts .=
                '<td class="p-2 text-nowrap fs-12"><span class=" text-muted d-block">Last Edited</span>' .
                date("d-m-Y H:i", strtotime($value["updated_at"])) .
                '</td>
                <td class="p-2 text-nowrap"> ' .
                date("d-m-Y H:i", strtotime($value["created_at"])) .
                '</td>
                <td class="p-2 text-nowrap"> </td>
            ';
            $ts .= "</tr>";
            $html .= $ts;

            // Add the current combination to the list of encountered combinations
            $uniqueCombinations[] = $combination;

            $i++;
        }

        if (!empty($html)) {
            echo $html;
        } else {
            echo '<p style="text-align:center;">Data Not Found </p>';
        }
    }

    public function audience_show_data()
    {
        $table_name = $_POST["table"];
        $username = session_username($_SESSION["username"]);
        $action = $_POST["action"];
        $FilterStock = $_POST["FilterStock"];
        $selectedAudienceType = $_POST["show_array"];
        $i = 1;
        $html = "";

        $secondDb = \Config\Database::connect("second");
        $builder = $secondDb->table($this->username . '_all_inquiry');

        $FilterStockArray = explode(",", $FilterStock);
        $builder->whereIn("intrested_product", $FilterStockArray);

        if ($selectedAudienceType == "1") {
            $builder->where("lead_list", 1);
        } elseif ($selectedAudienceType == "2") {
            $builder->where("qualified", 1);
        } elseif ($selectedAudienceType == "3") {
            $builder->where("prospect", 1);
        } elseif ($selectedAudienceType == "4") {
            $builder->where("contacted", 1);
        } elseif ($selectedAudienceType == "5") {
            $builder->where("block_list", 1);
        }

        $result = $builder->get();
        $departmentdisplaydata = $result->getResultArray();

        foreach ($departmentdisplaydata as $key => $value) {
            $ts =
                '<tr class="audiance_view" data-view_id="' .
                $value["id"] .
                '" data-bs-toggle="modal" data-bs-target="#lead_list_modal">
					<td class="p-2 text-nowrap">' .
                $value["created_at"] .
                '</td>
					<td class="p-2 text-nowrap">' .
                $value["user_id"] .
                '</td>
					<td class="p-2 text-nowrap">' .
                $value["full_name"] .
                '</td>
					<td class="p-2 text-nowrap">' .
                $value["mobileno"] .
                '</td>
					<td class="p-2 text-nowrap">' .
                $value["intrested_product"] .
                '</td>
					<td class="p-2 text-nowrap">' .
                $value["inquiry_type"] .
                '</td>
				</tr>';
            $html .= $ts;
            $i++;
        }

        if (!empty($html)) {
            echo $html;
        } else {
            echo '<p style="text-align:center;">Data Not Found </p>';
        }
    }

    public function audience_insert_data()
    {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $username = session_username($_SESSION["username"]);
        $action_name = $this->request->getPost("action");

        $currentDateTime = date("Y-m-d H:i:s");
        if ($action_name == "insert") {
            unset($_POST["action"]);
            unset($_POST["table"]);

            if (!empty($_POST)) {
                $insert_data = $_POST;
                $intrested_product = $_POST["intrested_product"];
                $inquiry_status = $_POST["inquiry_status"];
                $name = $_POST["name"];
                $source = $_POST["source"];

                // Set a default retention value if not provided
                $retention_days = isset($_POST["retansion"])
                    ? $_POST["retansion"]
                    : 0;

                $retention_date = date(
                    "Y-m-d H:i:s",
                    strtotime("-$retention_days days")
                );

                // Connect to the 'second' database
                $secondDb = \Config\Database::connect("second");

                // Query to retrieve data from admin_all_inquiry with a retention period
                $qry =
                $qry = "SELECT id, full_name, inquiry_status, intrested_product, mobileno, email, address FROM " . $this->username . "_all_inquiry WHERE intrested_product = ? AND inquiry_status = ? AND created_at >= ?";
                // Pass placeholders as an associative array
                $result = $secondDb->query($qry, [
                    $intrested_product,
                    $inquiry_status,
                    $retention_date,
                ]);

                // Check if there are results
                if ($result->getNumRows() > 0) {
                    $departmentdisplaydata = $result->getResultArray();

                    // Insert the retrieved data along with the insert_data into the audience table
                    $audience_table_name = $username . "_audience";

                    // Define an array to store the merged records
                    $merged_records = [];

                    // Merge $insert_data with each row in $departmentdisplaydata
                    foreach ($departmentdisplaydata as &$row) {
                        // Extract the 'id' value
                        $inquiry_id = $row["id"];

                        // Remove the 'id' from the row
                        unset($row["id"]);

                        // Merge the data
                        $merged_data = array_merge($row, $insert_data, [
                            "retansion" => $retention_days,
                            "source" => $source,
                            "name" => $name,
                            "created_at" => $currentDateTime,
                            "updated_at" => $currentDateTime,
                        ]);

                        // Set the 'inquiry_id' field
                        $merged_data["inquiry_id"] = $inquiry_id;

                        // Push the merged data into the array
                        $merged_records[] = $merged_data;
                    }

                    // Insert merged data into the audience table
                    $this->MasterInformationModel->insert_entry3(
                        $merged_records,
                        $audience_table_name
                    );

                    // Retrieve and display all records from the original table
                    $departmentdisplaydata = $this->MasterInformationModel->display_all_records2(
                        $username . "_" . $table_name
                    );
                    $departmentdisplaydata = json_decode(
                        $departmentdisplaydata,
                        true
                    );
                } else {
                    // Data not available, return error
                    return "error";
                }
            }
        }
    }

    // View Data Code Start  ===========================================================================>
    public function audience_view_data()
    {
        if ($this->request->getPost("action") == "view") {
            $view_id = $this->request->getPost("view_id");
            $username = session_username($_SESSION["username"]);
            $table = $_POST["table"];
            $table_name = $this->username . "_" . $table;
            $secondDb = \Config\Database::connect("second");
            $userEditdata = $this->MasterInformationModel->edit_entry2(
                $table_name,
                $view_id
            );
            $userEditdata = get_object_vars($userEditdata[0]);
            // Get product name and add it to the userEditdata array
            $inquiry_details = "Csv File";
            if (
                isset($userEditdata["intrested_product"]) &&
                !empty($userEditdata["intrested_product"])
            ) {
                $inquiry_type_name = IdToFieldGetData(
                    "product_name",
                    "id=" . $userEditdata["intrested_product"] . "",
                    "admin_product"
                );
                $inquiry_details =
                    isset($inquiry_type_name["product_name"]) &&
                    !empty($inquiry_type_name["product_name"])
                        ? $inquiry_type_name["product_name"]
                        : "";
            }
            $userEditdata["inquiry_type_name"] = $inquiry_details;
            // Count the number of rows with the same name
            $count_sql = "SELECT COUNT(*) as sub_count FROM $table_name WHERE name = ?";
            $query = $secondDb->query($count_sql, [$userEditdata["name"]]);
            $count_result = $query->getRowArray();
            $sub_count = isset($count_result["sub_count"])
                ? $count_result["sub_count"]
                : 0;

            // Add the sub_count to the userEditdata array
            $userEditdata["sub_count"] = $sub_count;
            // Return the JSON-encoded data
            return json_encode($userEditdata, true);
        }
        die();
    }

    public function get_data_header_by_file_audience()
    {
        $return_array = [];
        $html = "";
        $btn_html = "";

        if (isset($_FILES["import_file"])) {
            if ($_FILES["import_file"]["error"] === UPLOAD_ERR_OK) {
                $db_connection = \Config\Database::connect("second");
                $tmpFilePath = $_FILES["import_file"]["tmp_name"];
                $spreadsheet = IOFactory::load($tmpFilePath); // Load the uploaded Excel file
                $worksheet = $spreadsheet->getActiveSheet();
                $highestColumn = $worksheet->getHighestColumn();
                $headerRow = $worksheet->rangeToArray(
                    "A1:" . $highestColumn . "1",
                    null,
                    true,
                    false
                );
                // pre($headerRow);
                $query = $db_connection
                    ->table($this->username . "_audience")
                    ->get();
                // if ($query->getNumRows() > 0) {
                $columnNames = $query->getFieldNames();
                // } else {
                //     $columnNames = array();
                // }
                $btn_html .= '<button class="btn-primary add" type="button" data-bs-toggle="modal" data-bs-target="#column_add_form" aria-controls="column_add_form">
                                + Add Column
                            </button>';
                // pre($columnNames);
                $html .= '<div class="col-12 d-sm-flex d-none flex-wrap mb-2">
                                <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 text-center">
                                    <span class="fs-6">From</span>
                                </div>
                                <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 text-center">
                                    <span class="fs-6">to</span>
                                </div>
                            </div>';
                $i = 0;
                foreach ($headerRow[0] as $value) {
                    if ($value != "") {
                        $noSpaces_value = preg_replace("/\s+/", "", $value);
                        $html .=
                            '<div class="col-12 d-flex flex-wrap mb-2">
                            <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1">
                                <input type="text" class="form-control main-control" id="' .
                            $noSpaces_value .
                            '_file" name="" placeholder="File Column name" value="' .
                            $noSpaces_value .
                            '" readonly required>
                            </div>
                            <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">
                                <span class="mx-auto col-1">to</span>
                                <div class="main-selectpicker col-11 dropdown">
                                    <input type="text" id="list" class="form-control list main-control dropdown-toggle file_columns_input" data-bs-toggle="dropdown" aria-expanded="false"  name="' .
                            $i .
                            '" id="' .
                            $noSpaces_value .
                            '" placeholder="' .
                            $noSpaces_value .
                            '">
                                    <ul class="dropdown-menu dropdown-menu-end w-100 column_list" id="column_list">';
                        foreach ($columnNames as $columnName) {
                            if (
                                !preg_match("/id/", $columnName) &&
                                !preg_match("/date/", $columnName) &&
                                !preg_match("/status/", $columnName) &&
                                !preg_match("/type/", $columnName) &&
                                !preg_match("/amount/", $columnName) &&
                                !preg_match("/inquiry/", $columnName) &&
                                !preg_match("/buy/", $columnName) &&
                                !preg_match("/pay/", $columnName) &&
                                !preg_match("/created/", $columnName) &&
                                !preg_match("/head/", $columnName) &&
                                !preg_match("/unit/", $columnName) &&
                                !preg_match("/follow/", $columnName) &&
                                !preg_match("/is/", $columnName) &&
                                !preg_match("/tooltip/", $columnName) &&
                                !preg_match("/site_/", $columnName) &&
                                !preg_match("/area_/", $columnName)
                            ) {
                                $html .=
                                    '<li><button class="dropdown-item list_item" type="button"><span>' .
                                    $columnName .
                                    "</span></button></li>";
                            }
                        }
                        $html .= '</ul>
                                </div>
                            </div>
                        </div>';
                        $i++;
                    }
                }
            } else {
                $html =
                    "File upload error. Error code: " .
                    $_FILES["import_file"]["error"];
            }
        }

        $return_array["html"] = $html;
        $return_array["btn_html"] = $btn_html;
        return json_encode($return_array, JSON_FORCE_OBJECT);
    }

    public function import_file_data_audience()
    {
        // pre($_POST);
        $name = $_POST["name"];
        $source = $_POST["source"];
        $currentDateTime = date("Y-m-d H:i:s");
        if (isset($_FILES["import_file"])) {
            if ($_FILES["import_file"]["error"] === UPLOAD_ERR_OK) {
                $db_connection = \Config\Database::connect("second");
                $tmpFilePath = $_FILES["import_file"]["tmp_name"];
                $spreadsheet = IOFactory::load($tmpFilePath); // Load the uploaded Excel file
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                // foreach ($rows as $row) {
                $new_column = [];
                unset($_POST["name"]);
                unset($_POST["source"]);
                $post_data = $_POST;
                $num_col = 1;
                $export_data = [];
                $header_export_data = [];
                $custome_column = "";
                $custome_column_value = [];
                $new_column[0] = "id int primary key AUTO_INCREMENT";
                foreach ($post_data as $key => $value) {
                    if (!empty($value) && !preg_match("/_value/", $key)) {
                        $new_column[$num_col] = $value . " varchar(255)";
                        $num_col++;
                        $header_export_data[] = $value;
                        if (preg_match("/_col/", $key)) {
                            $custome_column = $value;
                        }
                    }
                    if (preg_match("/_value/", $key)) {
                        $custome_column_value[$custome_column] = $value;
                    }
                }
                // pre($custome_column);
                // pre($new_column);
                // die();
                $export_data[] = $header_export_data;
                $result = [];
                $duplicate_data_count = 0;
                $none_duplicate_data_count = 0;
                $duplicate_data = 0;
                $table_names = $this->username . "_audience";
                $table_check = tableCreateAndTableUpdate2(
                    $table_names,
                    "",
                    $new_column
                );
                // pre($table_check);

                if (isset($rows) && !empty($rows)) {
                    foreach ($rows as $row_key => $row_value) {
                        $row_value = preg_replace("/\s+/", "", $row_value);
                        if ($row_key != 0) {
                            $insert_data = [];
                            $final_insert_data = [];
                            $num_col = 0; // Initialize the column count for each row
                            $duplicate_check = 0; // Initialize duplicate check for each row

                            foreach ($row_value as $value_key => $value_value) {
                                $value_key += 1;

                                foreach ($post_data as $key => $value) {
                                    if (
                                        !empty($value) &&
                                        !preg_match("/_value/", $key) &&
                                        !preg_match("/_col/", $key)
                                    ) {
                                        $key += 1;
                                        if ($key == $value_key) {
                                            $checkduplicate = 0;

                                            if (
                                                preg_match(
                                                    "/mobile/",
                                                    $value
                                                ) ||
                                                preg_match("/phone/", $value)
                                            ) {
                                                $duplicate_data_cols = [];
                                                $check_mobile = 1;
                                                $mobile_nffo_remove = str_replace(
                                                    " ",
                                                    "",
                                                    $value_value
                                                );
                                                $mobile_nffo = substr(
                                                    $mobile_nffo_remove,
                                                    -10
                                                );

                                                $duplicate_data_cols[
                                                    $value
                                                ] = $mobile_nffo;
                                                $checkduplicate = $this->duplicate_data_check_mobile_and_extra_data(
                                                    $this->username .
                                                        "_audience",
                                                    $duplicate_data_cols
                                                );
                                                if (
                                                    $checkduplicate[
                                                        "response"
                                                    ] == 1
                                                ) {
                                                    $duplicate_data = 1;
                                                    $duplicate_data_count++;
                                                } else {
                                                    $duplicate_data = 0;
                                                }
                                                // Use $last_10_digits in place of $value_value
                                                if (
                                                    $checkduplicate != 1 &&
                                                    preg_match(
                                                        '/^\d{10}$/',
                                                        $mobile_nffo
                                                    )
                                                ) {
                                                    $insert_data[
                                                        $value
                                                    ] = $mobile_nffo;
                                                } else {
                                                    $insert_data[
                                                        $value
                                                    ] = $value_value;
                                                }
                                                // pre($value_value);
                                            } else {
                                                $insert_data[
                                                    $value
                                                ] = $value_value;
                                            }
                                            $insert_data["name"] = $name;
                                            $insert_data["source"] = $source;
                                            $insert_data[
                                                "updated_at"
                                            ] = $currentDateTime;
                                            $num_col++;
                                            $duplicate_check = 1;
                                            // }
                                        }
                                    }
                                }
                            }
                            // return $insert_data;
                            if ($duplicate_data != 1) {
                                // Insert the data only if it's not a duplicate
                                $final_insert_data = array_merge(
                                    $insert_data,
                                    $custome_column_value
                                );
                                // pre($final_insert_data);
                                $insert = $this->MasterInformationModel->insert_entry2(
                                    $final_insert_data,
                                    $table_names
                                );
                                $none_duplicate_data_count++;
                            } else {
                                $export_data[] = $insert_data;
                            }
                        }
                    }
                }
                // die();

                if (
                    $none_duplicate_data_count > 0 &&
                    $duplicate_data_count > 0
                ) {
                    $result["import_data"] = $none_duplicate_data_count;
                    $result["csv_data"] = $duplicate_data_count;
                    $result["export_data"] = $export_data;
                    $result["response"] = 1;
                    $result["msg"] =
                        "Data Inserted and " .
                        $duplicate_data_count .
                        " Duplicate Data Found";
                }
                if ($duplicate_data_count > 0) {
                    $result["import_data"] = $none_duplicate_data_count;
                    $result["csv_data"] = $duplicate_data_count;
                    $result["export_data"] = $export_data;
                    $result["response"] = 0;
                    $result["msg"] =
                        "" . $duplicate_data_count . " Duplicate Data Found";
                } else {
                    $result["response"] = 1;
                    $result["msg"] = "Data Inserted Success";
                }

                return json_encode($result);
            }
        }
    }
}
?>
