<?php

namespace App\Controllers\Campaign;
use App\Controllers\BaseController;
use App\Models\MasterInformationModel;
use App\Models\CampaignModel;
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
        $this->CampaignModel = new CampaignModel($db);

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
        $this->db = DatabaseDefaultConnection();
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
    public function duplicate_data($data, $table)
	{
		$this->db = DatabaseDefaultConnection();
		$i = 0;
		$data_duplicat_Query = "";
		$numItems = count($data);
		foreach ($data as $datakey => $data_value) {
			if ($i == $numItems - 1) {
				$data_duplicat_Query .= 'LOWER(TRIM(REPLACE(' . $datakey . ', " ",""))) = "' . strtolower(trim(str_replace(' ', '', $data_value))) . '"';
			} else {
				$data_duplicat_Query .= 'LOWER(TRIM(REPLACE(' . $datakey . '," ",""))) = "' . strtolower(trim(str_replace(' ', '', $data_value))) . '" AND ';
			}
			$i++;
		}
		$sql = 'SELECT * FROM ' . $table . ' WHERE ' . $data_duplicat_Query;
		$secondDb = DatabaseDefaultConnection();
		$result = $secondDb->query($sql);
		if ($result->getNumRows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
    public function audio_file() {
        // Check if an audio file was received
        if(isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
            // Specify the directory where you want to save the audio files
            $uploadDirectory = './assets/audio/'; // Adjust the path as needed
    
            // Make sure the directory exists; create it if it doesn't
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }
    
            // Get the temporary location of the uploaded audio file
            $audioTmpFile = $_FILES['audio']['tmp_name'];
    
            // Generate a unique filename for the audio file
            $audioFileName = uniqid('audio_') . '.mp3'; // or '.aac'
    
            // Move the uploaded audio file to the specified directory
            if (move_uploaded_file($audioTmpFile, $uploadDirectory . $audioFileName)) {
                // Send a response indicating the success of the operation
                echo 'Audio recorded successfully. File saved as: ' . $audioFileName;
            } else {
                // Send an error response if the file move operation failed
                echo 'Error: Failed to save audio file.';
            }
        } else {
            // Send an error response if no audio file was received or if there was an upload error
            echo 'Error: No audio file received or upload error occurred.';
        }
    }

    // public function edit_data_audience()
    // {
    //     if ($this->request->getPost("action") == "edit") {
    //         $edit_id = $this->request->getPost("edit_id");
    //         $table_name = $this->request->getPost("table");
    //         $username = session_username($_SESSION["username"]);
    //         $departmentEditdata = $this->MasterInformationModel->edit_entry2(
    //             $username . "_" . $table_name,
    //             $edit_id
    //         );
    //         return json_encode($departmentEditdata, true);
    //     }
    //     die();
    // }

    
    // public function update_data_audience()
    // {
    //     $post_data = $this->request->getPost();
    //     $edit_id = $_POST["edit_id"];
    //     $table_name = $this->request->getPost("table");
    //     $username = session_username($_SESSION["username"]);
    //     $action_name = $this->request->getPost("action");
    //     $new_name = $_POST["name"];
    //     $inquiry_data = $_POST["inquiry_data"];
    //     $pages_name = $_POST["pages_name"];

    //     $response = 0;
    //     if ($action_name == "update") {
    //         if (!empty($post_data)) {
    //             $update_data = [
    //                 "name" => $new_name,
    //                 "inquiry_data" => $inquiry_data,
    //                 "pages_name" => $pages_name
    //             ];
    
    //             $result = $this->CampaignModel->update_entry_by_name(
    //                 $edit_id,
    //                 $update_data,
    //                 $username . "_" . $table_name
    //             );
    //             $response = 1;
    //         }
    //     }
    //     echo $response;
    //     die();
    // }
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
    //     // $i = 1;
    //     $html = "";
    //     if ($_POST['action'] == 'facebook_list') {
            
    //         $this->db = DatabaseDefaultConnection();
    //         $first_db = DatabaseDefaultConnection();
    //         $username = session_username($_SESSION['username']);
    //         $query = "SELECT name FROM " . $username . "_audience WHERE facebook_syncro = 1";
    //         $result = $first_db->query($query);
    //         $departmentdisplaydata = $result->getResultArray();
    //         $departmentNames = array_column($departmentdisplaydata, 'name');
	// 		$get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
	// 		$get_access_token_array = $this->db->query($get_token);
	// 		$data_count = $get_access_token_array->getNumRows();
    //         $fb_account_data = $get_access_token_array->getResultArray()[0];
	// 		$token = $fb_account_data['access_token'];
    //                $selectedAccountId = $_POST['selected_account_id'];
    //                 // Fetch custom audiences for each ad account
    //                 $url = MetaUrl()."$selectedAccountId/customaudiences?fields=id,account_id,name,time_created,time_updated,subtype,approximate_count_lower_bound,approximate_count_upper_bound&access_token=$token";
    //                 $response = file_get_contents($url);
    //                 // pre($response);
    //                 $audience_data = json_decode($response, true);
    //                 foreach ($audience_data['data'] as $conversion_value) {
    //                     // pre($audience_data);
    //                     $chat_list_html = "";
    //                     $lower_bound = $conversion_value['approximate_count_lower_bound'];
    //                     $upper_bound = $conversion_value['approximate_count_upper_bound'];
    //                     $count_range = ($lower_bound == -1 && $upper_bound == -1) ? "Not available" : "$lower_bound-$upper_bound";

    //                     $chat_list_html .= '<tr class="audiance_view audiance_show_data" onclick="ViewFbAudiances(\'' . $conversion_value['id'] . '\',\'' . $conversion_value['name'] . '\',\'' . $conversion_value['subtype'] . '\',\'' . $count_range . '\',\'' . date('d-m-Y H:i', $conversion_value['time_updated']) . '\',\'' . date('d-m-Y H:i', $conversion_value['time_created']) . '\');">';
    //                     if (in_array($conversion_value['name'], $departmentNames)) {
    //                         // pre('mital');
    //                         $chat_list_html .= '<td>
    //                             <div class="d-flex flex-wrap align-items-center justify-content-between col-12" style="width:70px;">
    //                                 <img src="https://ajasys.com/img/favicon.png" class="mx-1" style="width:15px;height:15px;">
    //                                 <span class="mx-1">
    //                                     <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0" y="0" viewBox="0 0 64.019 64.019" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><linearGradient id="a" x1="17.091" x2="49.122" y1="35.929" y2="3.898" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1a6fb0"></stop><stop offset="1" stop-color="#3d9ae2"></stop></linearGradient><linearGradient id="b" x1="14.883" x2="46.914" y1="60.126" y2="28.096" gradientUnits="userSpaceOnUse"><stop stop-opacity="1" stop-color="#00b6bd" offset="0"></stop><stop stop-opacity="1" stop-color="#fcaf4f" offset="0.005791505791505791"></stop></linearGradient><path fill="url(#a)" d="M63.999 31.717C63.841 14.207 49.547.01 32 .01a31.707 31.707 0 0 0-21.149 8.023L7.414 4.596A1.998 1.998 0 0 0 4 6.01v16a2 2 0 0 0 2 2h16a2 2 0 0 0 1.414-3.414l-4.062-4.062A19.821 19.821 0 0 1 32 12.01c11.028 0 20 8.972 20 20a2 2 0 0 0 2 2h8a2 2 0 0 0 1.999-2.293z" opacity="1" data-original="url(#a)" class=""></path><path fill="url(#b)" d="M58 40.01H42a2 2 0 0 0-1.414 3.414l4.062 4.061A19.826 19.826 0 0 1 32 52.01c-11.028 0-20-8.972-20-20a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2c0 17.645 14.355 32 32 32a31.711 31.711 0 0 0 21.149-8.022l3.437 3.437a2.003 2.003 0 0 0 2.18.434A2.004 2.004 0 0 0 60 58.01v-16a2 2 0 0 0-2-2z" opacity="1" data-original="url(#b)" class=""></path></g></svg>
    //                                 </span>
    //                                 <span class="mx-1">
    //                                     <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0" y="0" viewBox="0 0 408.788 408.788" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M353.701 0H55.087C24.665 0 .002 24.662.002 55.085v298.616c0 30.423 24.662 55.085 55.085 55.085h147.275l.251-146.078h-37.951a8.954 8.954 0 0 1-8.954-8.92l-.182-47.087a8.955 8.955 0 0 1 8.955-8.989h37.882v-45.498c0-52.8 32.247-81.55 79.348-81.55h38.65a8.955 8.955 0 0 1 8.955 8.955v39.704a8.955 8.955 0 0 1-8.95 8.955l-23.719.011c-25.615 0-30.575 12.172-30.575 30.035v39.389h56.285c5.363 0 9.524 4.683 8.892 10.009l-5.581 47.087a8.955 8.955 0 0 1-8.892 7.901h-50.453l-.251 146.078h87.631c30.422 0 55.084-24.662 55.084-55.084V55.085C408.786 24.662 384.124 0 353.701 0z" style="" fill="#475993" data-original="#475993" class=""></path></g></svg>
    //                                 </span>
    //                             </div>
    //                         </td>';
    //                     } else {
    //                         // pre('test');
    //                         $chat_list_html .= '<td>
    //                             <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0" y="0" viewBox="0 0 408.788 408.788" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M353.701 0H55.087C24.665 0 .002 24.662.002 55.085v298.616c0 30.423 24.662 55.085 55.085 55.085h147.275l.251-146.078h-37.951a8.954 8.954 0 0 1-8.954-8.92l-.182-47.087a8.955 8.955 0 0 1 8.955-8.989h37.882v-45.498c0-52.8 32.247-81.55 79.348-81.55h38.65a8.955 8.955 0 0 1 8.955 8.955v39.704a8.955 8.955 0 0 1-8.95 8.955l-23.719.011c-25.615 0-30.575 12.172-30.575 30.035v39.389h56.285c5.363 0 9.524 4.683 8.892 10.009l-5.581 47.087a8.955 8.955 0 0 1-8.892 7.901h-50.453l-.251 146.078h87.631c30.422 0 55.084-24.662 55.084-55.084V55.085C408.786 24.662 384.124 0 353.701 0z" style="" fill="#475993" data-original="#475993" class=""></path></g></svg>
    //                         </td>';
    //                     }
    //                     $chat_list_html .= '  <td class="p-2 text-nowrap">' . $conversion_value['name'] . '<button class="btn btn-primary p-1 px-2 border border-primary mx-2 fs-10 fw-semibold" onclick="increaseAudienceData()"><i class="fa-solid fa-plus"></i></button></td>
    //                             <td class="p-2 text-nowrap">' . $conversion_value['subtype'] . '</td>
    //                             <td class="p-2 text-nowrap">' . $count_range . '</td>
    //                             <td class="p-2 text-nowrap fs-12"><span class="text-muted d-block">Last Edited</span>'.date('d-m-Y H:i', $conversion_value['time_updated']).'</td>
    //                             <td class="p-2 text-nowrap">'.date('d-m-Y H:i', $conversion_value['time_created']).'</td>

    //                             <td class="p-2 text-nowrap">' . $conversion_value['id'] . '</td>';
    //                             $chat_list_html .= '</tr>';
    //                             $html .= $chat_list_html;
    //                 }
                

    //             // $return_result['chat_list_html'] = $chat_list_html;
    //             if (!empty($html)) {
    //                 echo $html;
    //             } else {
    //                 echo '<p style="text-align:center;">Data Not Found </p>';
    //             }
    //             // $i++;
                    
           
    //     } else {
    //         // Invalid action
    //         return json_encode(['error' => 'Invalid action']);
    //     }
    // }

    public function audience_facebook_data() {
        $html = "";
        if ($_POST['action'] == 'facebook_list') {
            $this->db = DatabaseDefaultConnection(); // Assuming you have a function to establish a database connection
            $username = session_username($_SESSION['username']); // Assuming you have a function to get the session username
            $query = "SELECT name, inquiry_data FROM " . $username . "_audience WHERE facebook_syncro = 1";
            $result = $this->db->query($query); // Assuming $this->db is a valid database connection object
            $departmentdisplaydata = $result->getResultArray();
            // pre($departmentdisplaydata);
            // die();
            $departmentNames = array_column($departmentdisplaydata, 'name');
            $get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
            $get_access_token_array = $this->db->query($get_token);
            $data_count = $get_access_token_array->getNumRows();
            $fb_account_data = $get_access_token_array->getResultArray()[0];
            $access_api = isset($_POST['api']) ? $_POST['api'] : false;
            // pre($fb_account_data);
               $token = $fb_account_data['access_token'];
               if ($access_api === 'true' || $access_api === true || $access_api === 1) {
                $asset_table_name = $this->username . '_platform_assets';
                $url = MetaUrl().'/me/adaccounts?fields=account_id,name&access_token=' . $token;
                $fb_page_list_api = getSocialData($url);
                $api_page_data = isset($fb_page_list_api['data']) ? $fb_page_list_api['data'] : array();
                foreach ($api_page_data as $pages_key => $pages_value) {
                    // pre($pages_value);
                    $insert_data = array();
                    $insert_data['asset_id'] = $pages_value['id'];
                    $insert_data['platform_id'] = $fb_account_data['id'];
                    $isduplicate = $this->duplicate_data($insert_data, $asset_table_name);
                    if (!$isduplicate) {
                        $insert_data['platform_id'] = $fb_account_data['id'];
                        $insert_data['master_id'] = $_SESSION['master'];
                        $insert_data['asset_type'] = 'ads';
                        $insert_data['asset_id'] = $pages_value['id'];
                        $insert_data['name'] = $pages_value['name'];
                        $insert_new_pages = $this->MasterInformationModel->insert_entry2($insert_data, $asset_table_name);
                    } else {
                        $update_data = array();
                        $update_data['name'] = isset($pages_value['name']) ? $pages_value['name'] : '';
                        $update_data_ads = $update_data['name'];
                        if (!empty($update_data_ads)) {
                            $isduplicate = $this->duplicate_data($update_data, $asset_table_name);
                            if (!$isduplicate) {
                                $update_id = $pages_value['id'];
                                $update_sql = "UPDATE `$asset_table_name` SET `name`= '$update_data_ads' WHERE `asset_id`= $update_id";
                                $update_sql_fire = $this->db->query($update_sql);
                            }
                        }
                    }
                }
            }
            $selectedAccountId = $_POST['selected_account_id'];
            $url = MetaUrl()."$selectedAccountId/customaudiences?fields=id,account_id,name,time_created,time_updated,subtype,approximate_count_lower_bound,approximate_count_upper_bound&access_token=$token";
            $response = file_get_contents($url);
            $audience_data = json_decode($response, true);
            foreach ($audience_data['data'] as $conversion_value) {
                $chat_list_html = "";
                        $lower_bound = $conversion_value['approximate_count_lower_bound'];
                        $upper_bound = $conversion_value['approximate_count_upper_bound'];
                        $count_range = ($lower_bound == -1 && $upper_bound == -1) ? "Not available" : "$lower_bound-$upper_bound";

                        $chat_list_html .= '<tr class="audiance_view audiance_show_data" onclick="ViewFbAudiances(\'' . $conversion_value['id'] . '\',\'' . $conversion_value['name'] . '\',\'' . $conversion_value['subtype'] . '\',\'' . $count_range . '\',\'' . date('d-m-Y H:i', $conversion_value['time_updated']) . '\',\'' . date('d-m-Y H:i', $conversion_value['time_created']) . '\');">';
                        if (in_array($conversion_value['name'], $departmentNames)) {
                            // pre('mital');
                            $chat_list_html .= '<td>
                                <div class="d-flex flex-wrap align-items-center justify-content-between col-12" style="width:70px;">
                                    <img src="https://ajasys.com/img/favicon.png" class="mx-1" style="width:15px;height:15px;">
                                    <span class="mx-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0" y="0" viewBox="0 0 64.019 64.019" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><linearGradient id="a" x1="17.091" x2="49.122" y1="35.929" y2="3.898" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1a6fb0"></stop><stop offset="1" stop-color="#3d9ae2"></stop></linearGradient><linearGradient id="b" x1="14.883" x2="46.914" y1="60.126" y2="28.096" gradientUnits="userSpaceOnUse"><stop stop-opacity="1" stop-color="#00b6bd" offset="0"></stop><stop stop-opacity="1" stop-color="#fcaf4f" offset="0.005791505791505791"></stop></linearGradient><path fill="url(#a)" d="M63.999 31.717C63.841 14.207 49.547.01 32 .01a31.707 31.707 0 0 0-21.149 8.023L7.414 4.596A1.998 1.998 0 0 0 4 6.01v16a2 2 0 0 0 2 2h16a2 2 0 0 0 1.414-3.414l-4.062-4.062A19.821 19.821 0 0 1 32 12.01c11.028 0 20 8.972 20 20a2 2 0 0 0 2 2h8a2 2 0 0 0 1.999-2.293z" opacity="1" data-original="url(#a)" class=""></path><path fill="url(#b)" d="M58 40.01H42a2 2 0 0 0-1.414 3.414l4.062 4.061A19.826 19.826 0 0 1 32 52.01c-11.028 0-20-8.972-20-20a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2c0 17.645 14.355 32 32 32a31.711 31.711 0 0 0 21.149-8.022l3.437 3.437a2.003 2.003 0 0 0 2.18.434A2.004 2.004 0 0 0 60 58.01v-16a2 2 0 0 0-2-2z" opacity="1" data-original="url(#b)" class=""></path></g></svg>
                                    </span>
                                    <span class="mx-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0" y="0" viewBox="0 0 408.788 408.788" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M353.701 0H55.087C24.665 0 .002 24.662.002 55.085v298.616c0 30.423 24.662 55.085 55.085 55.085h147.275l.251-146.078h-37.951a8.954 8.954 0 0 1-8.954-8.92l-.182-47.087a8.955 8.955 0 0 1 8.955-8.989h37.882v-45.498c0-52.8 32.247-81.55 79.348-81.55h38.65a8.955 8.955 0 0 1 8.955 8.955v39.704a8.955 8.955 0 0 1-8.95 8.955l-23.719.011c-25.615 0-30.575 12.172-30.575 30.035v39.389h56.285c5.363 0 9.524 4.683 8.892 10.009l-5.581 47.087a8.955 8.955 0 0 1-8.892 7.901h-50.453l-.251 146.078h87.631c30.422 0 55.084-24.662 55.084-55.084V55.085C408.786 24.662 384.124 0 353.701 0z" style="" fill="#475993" data-original="#475993" class=""></path></g></svg>
                                    </span>
                                </div>
                            </td>';
                        } else {
                            // pre('test');
                            $chat_list_html .= '<td>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0" y="0" viewBox="0 0 408.788 408.788" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M353.701 0H55.087C24.665 0 .002 24.662.002 55.085v298.616c0 30.423 24.662 55.085 55.085 55.085h147.275l.251-146.078h-37.951a8.954 8.954 0 0 1-8.954-8.92l-.182-47.087a8.955 8.955 0 0 1 8.955-8.989h37.882v-45.498c0-52.8 32.247-81.55 79.348-81.55h38.65a8.955 8.955 0 0 1 8.955 8.955v39.704a8.955 8.955 0 0 1-8.95 8.955l-23.719.011c-25.615 0-30.575 12.172-30.575 30.035v39.389h56.285c5.363 0 9.524 4.683 8.892 10.009l-5.581 47.087a8.955 8.955 0 0 1-8.892 7.901h-50.453l-.251 146.078h87.631c30.422 0 55.084-24.662 55.084-55.084V55.085C408.786 24.662 384.124 0 353.701 0z" style="" fill="#475993" data-original="#475993" class=""></path></g></svg>
                            </td>';
                        }
                        $chat_list_html .= '  <td class="p-2 text-nowrap">' . $conversion_value['name'] . '<button class="btn btn-primary p-1 px-2 border border-primary mx-2 fs-10 fw-semibold" onclick="increaseAudienceData()"><i class="fa-solid fa-plus"></i></button></td>
                                <td class="p-2 text-nowrap">' . $conversion_value['subtype'] . '</td>
                                <td class="p-2 text-nowrap">' . $count_range . '</td>
                                <td class="p-2 text-nowrap fs-12"><span class="text-muted d-block">Last Edited</span>'.date('d-m-Y H:i', $conversion_value['time_updated']).'</td>
                                <td class="p-2 text-nowrap">'.date('d-m-Y H:i', $conversion_value['time_created']).'</td>

                                <td class="p-2 text-nowrap">' . $conversion_value['id'] . '</td>';
                                $chat_list_html .= '</tr>';
                                $html .= $chat_list_html;
            }
            if (!empty($html)) {
                echo $html;
            } else {
                echo '<p style="text-align:center;">Data Not Found </p>';
            }
        } else {
            // Invalid action
            return json_encode(['error' => 'Invalid action']);
        }
    }

    // public function audience_list_data()
    // {
    //     $table_name = $_POST["table"];
    //     $username = session_username($_SESSION["username"]);
    //     $action = $_POST["action"];
    //     $i = 1;
    //     $html = "";
    //     $departmentdisplaydata = $this->MasterInformationModel->display_all_records2(
    //         $username . "_" . $table_name
    //     );
    //     $departmentdisplaydata = json_decode($departmentdisplaydata, true);
    //     $sql2 =
    //         "SELECT COUNT(*) as sub_count, name FROM " . $this->username . "_audience GROUP BY name";
    //     $user_db_connection = DatabaseDefaultConnection();
    //     $sql_run = $user_db_connection->query($sql2);
    //     $paydone_data_get = $sql_run->getResultArray();
    //     $uniqueCombinations = [];
    //     foreach ($departmentdisplaydata as $key => $value) {
    //         $combination =
    //             $value["name"] .
    //             "-" .
    //             $value["inquiry_status"] .
    //             "-" .
    //             $value["retansion"] .
    //             "-" .
    //             $value["source"] .
    //             "-" .
    //             $value["is_status_active"];

    //         // Skip if the current row's combination has already been encountered
    //         if (in_array($combination, $uniqueCombinations)) {
    //             continue; // Skip this row if it's a duplicate combination
    //         }

    //         // Check if the value of facebook_syncro is 0
    //         if ($value["facebook_syncro"] == 0) {
    //             $ts = "";
    //             $ts .=
    //                 '<tr class="audiance_view audiance_show_data cursor-pinter" data-view_id="' .
    //                 $value["id"] .
    //                 '"data-edit_id="' .
    //                 $value["id"] .
    //                 '">
    //                 <td><img src="https://ajasys.com/img/favicon.png" style="width:15px;height:15px;"></td>
    //                     <td class="p-1 text-nowrap"> ' .
    //                 $value["name"] .
    //                 '</td>
    //                     <td class="p-1 text-nowrap">' .
    //                 $value["source"] .
    //                 "</td>";

    //             // Iterate through the results of the SQL query to match the inquiry_status
    //             foreach ($paydone_data_get as $status) {
    //                 if ($value["name"] == $status["name"]) {
    //                     $ts .= "<td>" . $status["sub_count"] . "</td>";
    //                     break; // Once the match is found, break out of the loop
    //                 }
    //             }

    //             $ts .=
    //                 '<td class="p-1 text-nowrap fs-12"><span class=" text-muted d-block">Last Edited</span>' .
    //                 date("d-m-Y H:i", strtotime($value["updated_at"])) .
    //                 '</td>
    //                 <td class="p-1 text-nowrap"> ' .
    //                 date("d-m-Y H:i", strtotime($value["created_at"])) .
    //                 '</td>
    //                 <td class="p-1 text-nowrap"> </td>
    //             ';
    //             $ts .= "</tr>";
    //             $html .= $ts;
    //         }

    //         // Add the current combination to the list of encountered combinations
    //         $uniqueCombinations[] = $combination;

    //         $i++;
    //     }

    //     if (!empty($html)) {
    //         echo $html;
    //     } else {
    //         echo '<p style="text-align:center;">Data Not Found </p>';
    //     }
    // }

    public function updateSyncStatus($audience_name)
    {
        $db = DatabaseDefaultConnection();
        $result = $db
            ->table($this->username . '_audience')
            ->where('name', $audience_name)
            ->set('facebook_syncro', 1)
            ->update();

        return $result;
    }

    public function fetchAudienceData($master_username)
    {
        $first_db = DatabaseDefaultConnection();
        $query = "SELECT name, email, mobileno,country_code FROM " . $master_username . "_audience WHERE facebook_syncro = 0 AND inquiry_data = 2";
        $result = $first_db->query($query);
        return $result->getResultArray();
    }

    public function livefetchAudienceData($master_username)
    {
        $first_db = DatabaseDefaultConnection();
        $query = "SELECT name, email, mobileno,country_code FROM " . $master_username . "_audience WHERE facebook_syncro = 0 AND inquiry_data = 3";
        $result = $first_db->query($query);
        return $result->getResultArray();
    }
    public function deleteSyncStatus($audience_name)
    {
        $db = DatabaseDefaultConnection();
        $result = $db
            ->table($this->username . '_audience')
            ->where('name', $audience_name)
            ->where('facebook_syncro', 0) // Add condition for facebook = 0
            ->where('inquiry_data', 3) // Add condition for inquiry_data = 3
            ->delete();
    
        return $result;
    }
     public function audience_add_data($departmentdisplaydata)
    {

        // Check if there are records to process
        if (!empty($departmentdisplaydata)) {
            // Initialize an array to store processed audience names
            $processedAudiences = [];
            $username = session_username($_SESSION['username']);
            $this->db = DatabaseDefaultConnection();
			$get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
			$get_access_token_array = $this->db->query($get_token);
			$data_count = $get_access_token_array->getNumRows();
            $fb_account_data = $get_access_token_array->getResultArray()[0];
			$token = $fb_account_data['access_token'];
            // Fetch user data including ad accounts
            $url = "https://graph.facebook.com/v2.8/me?fields=id%2Cname%2Cadaccounts&access_token=$token";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['adaccounts']['data'])) {
                // Initialize an array to store URLs for each audience ID
                $usersUrls = [];
                $ii = 0;
                foreach ($departmentdisplaydata as $record) {
                    $audience_name = $record['name']; // Adjust this based on your database field

                    // Check if this audience name has already been processed
                    if (in_array($audience_name, $processedAudiences)) {
                        continue; // Skip this iteration
                    }
                    // Reset matching audience ID for each record
                    $matching_audience_ids = [];
                    $matching_audience_names = [];

                    // Check if 'adaccounts' data exists and iterate over each ad account
                    foreach ($data['adaccounts']['data'] as $ad_account) {
                        $account_id = $ad_account['id'];
                        // Fetch custom audiences for each ad account
                        $url = MetaUrl()."$account_id/customaudiences?fields=id,account_id,name,time_created,time_updated,subtype,approximate_count_lower_bound,approximate_count_upper_bound&access_token=$token";
                        $response = file_get_contents($url);
                        $audience_datas = json_decode($response, true);
                        // pre($audience_datas);
                        // Iterate over fetched custom audiences to find a match
                        foreach ($audience_datas['data'] as $api_audience) {
                            if ($api_audience['name'] == $audience_name) {
                                // Matching audience found, retrieve the ID
                                $matching_audience_ids[] = $api_audience['id'];
                                $matching_audience_names[] = $api_audience['name'];
                                // Add the processed audience name to the array
                                $processedAudiences[] = $audience_name;
                            }
                        }
                    }

                    foreach ($matching_audience_ids as $key => $audience_id) {
                        $usersUrls[$ii]['url'] = MetaUrl()."$audience_id/users?access_token=$token";
                        $usersUrls[$ii]['audience_id'] = $audience_id;
                        $usersUrls[$ii]['name'] = $matching_audience_names[$key];
                        $ii++;
                    }
                }

                $responses = [];

                foreach ($usersUrls as $usersUrl) {
                    $estimated_total = 0;
                    $allUsersData = [];
                
                    foreach ($departmentdisplaydata as $record) {
                        $full_name = $record['name']; // Assuming 'name' is the correct key
                        if ($usersUrl['name'] == $full_name) {
                            // Access other data using correct keys
                            $first_name = $record['name']; // Assuming 'name' is the correct key for first_name
                            $email = $record['email'];
                            $mobileno = $record['mobileno'];
                            $country_code = $record['country_code'];

                            $phone_number = preg_replace("/[^0-9]/", "", $mobileno); // Remove symbols, letters, and leading zeroes

                            if (!empty($country_code)) {
                                $phone_number = "+" . $country_code . $phone_number;
                            }
                            // Hash the values
                            $hashed_first_name = hash('sha256', $first_name);
                            $hashed_email = hash('sha256', $email);
                            $hashed_mobileno = hash('sha256', $phone_number);
                
                            // Construct payload data for the current user
                            $userPayloadData = [
                                $hashed_first_name, // Hashed first name
                                $hashed_email, // Hashed email address
                                $hashed_mobileno, // Hashed mobile number
                                ["LDU"] // Specify LDU flag for this entry
                            ];
                
                            // Add the payload data for the current user to the array
                            $allUsersData[] = $userPayloadData;
                
                            // Increment the estimated total count
                            $estimated_total++;
                        }
                    }
                    // Define the schema
                    $schema = ["FN", "EMAIL", "PHONE", "DATA_PROCESSING_OPTIONS"];
                
                    // Define the payload data
                    $usersPostData = [
                        "schema" => $schema,
                        "is_raw" => "true",
                        "page_ids" => [110707855263314], // Add the page ID(s) here as an array
                        "data" => $allUsersData // Add all users' data
                    ];
                
                    // Convert payload data to JSON format
                    $usersPostDataJson = json_encode($usersPostData);
                
                    // Initialize cURL session for adding users to the custom audience
                    $curl_users = curl_init();
                
                    // Set cURL options for adding users to the custom audience
                    curl_setopt_array($curl_users, [
                        CURLOPT_URL => $usersUrl['url'],
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => http_build_query(['payload' => $usersPostDataJson]), // Pass the JSON string here as 'payload'
                        CURLOPT_TIMEOUT => 60 // Set a timeout of 60 seconds for the request
                    ]);
                
                    // Execute cURL request to add users to the custom audience
                    $users_response = curl_exec($curl_users);
                
                    // Store the response for this URL
                    $responses[] = $users_response;
                    // pre($responses);
                
                    // Check for errors in cURL request for adding users
                    if (curl_errno($curl_users)) {
                        $error = curl_error($curl_users);
                        curl_close($curl_users);
                        // Handle the error gracefully, you can log it or display a message
                        $responses[] = "cURL Error adding users: $error\n";
                    } else {
                        // Check for Facebook API errors
                        $response_data = json_decode($users_response, true);
                        if (isset($response_data['error'])) {
                            // Handle Facebook API error
                            $error_message = $response_data['error']['message'];
                            $responses[] = "Facebook API Error: $error_message";
                        } else {
                            // Update the database to mark the audience as synced with Facebook
                            $audience_name = $usersUrl['name'];
                            $this->updateSyncStatus($audience_name);
                        }
                    }
                
                    curl_close($curl_users);
                }
                pre($responses);
                return $responses;
                
            } else {
                return "No ad accounts found for the user.";
            }
        } else {
            return "No records found to process";
        }
    }
    public function audience_live_data($livedisplaydata)
    {
        if (!empty($livedisplaydata)) {
            // Initialize an array to store processed audience names
            $processedAudiences = [];
            $username = session_username($_SESSION['username']);
            $this->db = DatabaseDefaultConnection();
			$get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
			$get_access_token_array = $this->db->query($get_token);
			$data_count = $get_access_token_array->getNumRows();
            $fb_account_data = $get_access_token_array->getResultArray()[0];
			$token = $fb_account_data['access_token'];
            // $token = ''; // Replace with your Facebook access token
            // Fetch user data including ad accounts
            $url = "https://graph.facebook.com/v2.8/me?fields=id%2Cname%2Cadaccounts&access_token=$token";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['adaccounts']['data'])) {
                // Initialize an array to store URLs for each audience ID
                $usersUrls = [];
                $ii = 0;
                foreach ($livedisplaydata as $record) {
                    $audience_name = $record['name']; // Adjust this based on your database field

                    // Check if this audience name has already been processed
                    if (in_array($audience_name, $processedAudiences)) {
                        continue; // Skip this iteration
                    }
                    // Reset matching audience ID for each record
                    $matching_audience_ids = [];
                    $matching_audience_names = [];

                    // Check if 'adaccounts' data exists and iterate over each ad account
                    foreach ($data['adaccounts']['data'] as $ad_account) {
                        $account_id = $ad_account['id'];
                        // Fetch custom audiences for each ad account
                        $url = MetaUrl()."$account_id/customaudiences?fields=id,account_id,name,time_created,time_updated,subtype,approximate_count_lower_bound,approximate_count_upper_bound&access_token=$token";
                        $response = file_get_contents($url);
                        $audience_datas = json_decode($response, true);
                        // pre($audience_datas);
                        // Iterate over fetched custom audiences to find a match
                        foreach ($audience_datas['data'] as $api_audience) {
                            if ($api_audience['name'] == $audience_name) {
                                // Matching audience found, retrieve the ID
                                $matching_audience_ids[] = $api_audience['id'];
                                $matching_audience_names[] = $api_audience['name'];
                                // Add the processed audience name to the array
                                $processedAudiences[] = $audience_name;
                            }
                        }
                    }

                    foreach ($matching_audience_ids as $key => $audience_id) {
                        $replaceUrls[$ii]['url'] = MetaUrl()."$audience_id/users?access_token=$token";
                        $replaceUrls[$ii]['audience_id'] = $audience_id;
                        $replaceUrls[$ii]['name'] = $matching_audience_names[$key];
                        $ii++;
                    }
                }

                $responses = [];

                foreach ($replaceUrls as $usersUrl) {
                    $estimated_total = 0;
                    $allUsersData = [];
                
                    foreach ($livedisplaydata as $record) {
                        $full_name = $record['name']; // Assuming 'name' is the correct key
                        if ($usersUrl['name'] == $full_name) {
                            // Access other data using correct keys
                            $email = $record['email'];
                            $mobileno = $record['mobileno'];
                            $country_code = $record['country_code'];

                            $phone_number = preg_replace("/[^0-9]/", "", $mobileno); // Remove symbols, letters, and leading zeroes

                            if (!empty($country_code)) {
                                $phone_number = "+" . $country_code . $phone_number;
                            }
                            // Hash the values
                            $hashed_email = hash('sha256', $email);
                            $hashed_mobileno = hash('sha256', $phone_number);
                
                            // Construct payload data for the current user
                            $userPayloadData = [
                                $hashed_email, // Hashed email address
                                $hashed_mobileno, // Hashed mobile number
                            ];
                
                            // Add the payload data for the current user to the array
                            $allUsersData[] = $userPayloadData;
                
                            // Increment the estimated total count
                            $estimated_total++;
                        }
                    }
                    $sessions_id = hexdec(substr(uniqid(), 0, 16));
                    // Construct the payload
                    $payload = [
                        "session" => [
                            "session_id" => $sessions_id,
                            "batch_seq" => 1, // Adjust this as necessary
                            "last_batch_flag" => true,
                            "estimated_num_total" => count($allUsersData) // Use the count of processed users
                        ],
                        "payload" => [
                            "schema" => ["EMAIL_SHA256", "PHONE_SHA256"],
                            "data" => $allUsersData
                        ]
                    ];
            
                    // Convert payload data to JSON format
                    $payloadJson = json_encode($payload);
                    // pre($payloadJson);
                    // continue;
                
                    // Initialize cURL session for adding users to the custom audience
                    $curl_users = curl_init();
                
                    // Set cURL options for adding users to the custom audience
                    curl_setopt_array($curl_users, [
                        CURLOPT_URL => $usersUrl['url'],
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST => "DELETE", // Specify the request method as DELETE
                        CURLOPT_POSTFIELDS => $payloadJson, // Pass the JSON string here as 'payload'
                        CURLOPT_HTTPHEADER => [
                            'Content-Type: application/json',
                        ],
                    ]);
                    // Execute cURL request to add users to the custom audience
                    $users_response = curl_exec($curl_users);
                    // pre($users_response);
                    // continue;
                
                    // Store the response for this URL
                    $responses[] = $users_response;
                    // pre($responses);
                
                    // Check for errors in cURL request for adding users
                    if (curl_errno($curl_users)) {
                        $error = curl_error($curl_users);
                        curl_close($curl_users);
                        // Handle the error gracefully, you can log it or display a message
                        $responses[] = "cURL Error adding users: $error\n";
                    } else {
                        // Check for Facebook API errors
                        $response_data = json_decode($users_response, true);
                        if (isset($response_data['error'])) {
                            // Handle Facebook API error
                            $error_message = $response_data['error']['message'];
                            $responses[] = "Facebook API Error: $error_message";
                        } else {
                            // Update the database to mark the audience as synced with Facebook
                            $audience_name = $usersUrl['name'];
                            $this->deleteSyncStatus($audience_name);
                        }
                    }
                
                    curl_close($curl_users);
                }
                pre($responses);
                return $responses;
                
            } else {
                return "No ad accounts found for the user.";
            }
        } else {
            return "No records found to process";
        }
    }
    public function audience_increase_data()
    {
        $master_data = $this->MasterInformationModel->display_all_records2('master_user');
        $master_data = json_decode($master_data, true);
    
        foreach ($master_data as $key => $value) {
            $master_username = $value['username'];
            // Fetch audience data
            $departmentdisplaydata = $this->fetchAudienceData($master_username);
            if (!empty($departmentdisplaydata)) {
                $this->audience_add_data($departmentdisplaydata);
            } else {
                echo "No records found to process";
            }
    
            $livedisplaydata = $this->livefetchAudienceData($master_username);
            if (!empty($livedisplaydata)) {
                $this->audience_live_data($livedisplaydata);
            } else {
                echo "No records found to process";
            }
        }
    }
    // function startsWith($haystack, $needle) {
    //     return $needle === "" || strpos($haystack, $needle) === 0;
    // }
    public function audience_insert_data()
    {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $username = session_username($_SESSION["username"]);
        $action_name = $this->request->getPost("action");
        $pages_name = $this->request->getPost("pages_name");
        $facebook_syncro = $this->request->getPost("facebook_syncro");
        $ad_account_id = $this->request->getPost("ad_account_id");

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
                $pages_name = $_POST["pages_name"];
                $facebook_syncro = $_POST["facebook_syncro"];
                $ad_account_id = $_POST["ad_account_id"];

                // Set a default retention value if not provided
                $retention_days = isset($_POST["retansion"])
                    ? $_POST["retansion"]
                    : 0;

                $retention_date = date(
                    "Y-m-d H:i:s",
                    strtotime("-$retention_days days")
                );

                // Connect to the 'second' database
                $secondDb = DatabaseDefaultConnection();

                // Query to retrieve data from admin_all_inquiry with a retention period
                $qry =
                $qry = "SELECT id, full_name, inquiry_status, mobileno, email, address FROM " . $this->username . "_all_inquiry WHERE intrested_product = ? AND inquiry_status = ? AND created_at >= ?";
                // Pass placeholders as an associative array
                $result = $secondDb->query($qry, [
                    $intrested_product,
                    $inquiry_status,
                    $retention_date,
                ]);

                // Check if there are results
                if ($result->getNumRows() > 0) {
                    $departmentdisplaydata = $result->getResultArray();
                    $audiancedisplaydata = $result->getResultArray();

                    // Insert the retrieved data along with the insert_data into the audience table
                    $audience_table_name = $username . "_audience";

                    // Define an array to store the merged records
                    $merged_records = [];

                    // Merge $insert_data with each row in $departmentdisplaydata
                    foreach ($departmentdisplaydata as &$row) {
                        // Extract the 'id' value
                        $inquiry_id = $row["id"];
                        // $merged_mobile = $row["country_code"] . $row["mobileno"];
                        // Remove the 'id' from the row
                        unset($row["id"]);
                        // unset($row["country_code"]);
                        // unset($row["mobileno"]);

                        // Merge the data
                        $merged_data = array_merge($row, $insert_data, [
                            "retansion" => $retention_days,
                            "source" => $source,
                            "intrested_product" => $intrested_product,
                            "name" => $name,
                            "pages_name" => $pages_name, // Add selected page value here
                            "facebook_syncro" => $facebook_syncro, // Add selected facebook value here
                            "created_at" => $currentDateTime,
                            "updated_at" => $currentDateTime,
                            "ad_account_id" => $ad_account_id
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
                    if ($facebook_syncro == 1) {
                        $this->db = DatabaseDefaultConnection();
                        $get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
                        $get_access_token_array = $this->db->query($get_token);
                        $data_count = $get_access_token_array->getNumRows();
                        $fb_account_data = $get_access_token_array->getResultArray()[0];
                        $accessToken = $fb_account_data['access_token'];
                        // $url = "https://graph.facebook.com/v2.8/me?fields=id%2Cname%2Cadaccounts&access_token=$accessToken";
                        // $response = file_get_contents($url);
                        // $data = json_decode($response, true);
            
                        // // Check if 'adaccounts' data exists and iterate over each ad account
                        // if (isset($data['adaccounts']['data'])) {
                        //     $chat_list_html = '';
                        //     foreach ($data['adaccounts']['data'] as $ad_account) {
                        //         pre($ad_account);
                        //         $adAccountId = $ad_account['id'];
                        //     }
                        // }
                        // pre($adAccountId);
                        // die();
                        $adAccountId = $ad_account_id;
                        $url = MetaUrl()."$adAccountId/customaudiences";
                        $postData = [
                            'name' => $name, // Change here to use name from POST data
                            'subtype' => 'CUSTOM',
                            'description' => 'People who purchased on my website',
                            'customer_file_source' => 'USER_PROVIDED_ONLY',
                            'access_token' => $accessToken
                        ];
                        
                        // Initialize cURL session for creating custom audience
                        $curl = curl_init();
                        
                        // Set cURL options for creating custom audience
                        curl_setopt_array($curl, [
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                        ]);
                        
                        // Execute cURL request to create custom audience
                        $response = curl_exec($curl);
                        
                        // Check for errors in cURL request
                        if (curl_errno($curl)) {
                            $error = curl_error($curl);
                            curl_close($curl);
                            return "cURL Error: $error";
                        }
                        
                        // Close cURL session for creating custom audience
                        curl_close($curl);
                        
                        // Decode the JSON response to extract the audience ID
                        $response_data = json_decode($response, true);
                        if (!empty($response_data) && isset($response_data['id'])) {
                            $audience_id = $response_data['id'];
                          // Update all rows in admin_audience with the retrieved audience_id
                            // $updateQuery = "UPDATE admin_audience SET audience_id = ?";
                            // $secondDb->query($updateQuery, [$audience_id]);
                            // Construct the correct URL for adding users to the custom audience
                            $usersUrl = MetaUrl()."$audience_id/users?access_token=$accessToken";
                        
                            // Reset the estimated total count
                            $estimated_total = 0;
                        
                            $allUsersData = [];

                            foreach ($audiancedisplaydata as $record) {
                                // pre($audiancedisplaydata);
                                // continue;
                                // Extract full name, email, and mobile number from the current record
                                $full_name = $record['full_name'];
                                $email = $record['email'];
                                $mobileno = $record['mobileno'];
                                $country_code = $record['country_code'];

                                $phone_number = preg_replace("/[^0-9]/", "", $mobileno); // Remove symbols, letters, and leading zeroes

                                if (!empty($country_code)) {
                                    $phone_number = "+" . $country_code . $phone_number;
                                }
                                // Hash the values
                                $hashed_first_name = hash('sha256', $full_name);
                                $hashed_email = hash('sha256', $email);
                                $hashed_mobileno = hash('sha256', $phone_number);
                                
                                // Construct payload data for the current user
                                $userPayloadData = [
                                    $hashed_first_name, // Hashed first name
                                    $hashed_email, // Hashed email address
                                    $hashed_mobileno, // Hashed mobile number
                                    ["LDU"] // Specify LDU flag for this entry
                                ];
                                
                                // Add the payload data for the current user to the array
                                $allUsersData[] = $userPayloadData;
                            }
                            $selected_page_id = $_POST['pages_name'];
                            // Define the schema
                            $schema = ["FN", "EMAIL", "PHONE", "DATA_PROCESSING_OPTIONS"];
                            
                            // Define the payload data
                            $usersPostData = [
                                "schema" => $schema,
                                "is_raw" => "true",
                                "page_ids" => [$selected_page_id], // Add the page ID(s) here as an array
                                "data" => $allUsersData // Add all users' data
                            ];
                            // pre($usersPostData);
                            
                            // Convert payload data to JSON format
                            $usersPostDataJson = json_encode($usersPostData);
                            
                            // Initialize cURL session for adding users to the custom audience
                            $curl_users = curl_init();
                            
                            // Set cURL options for adding users to the custom audience
                            curl_setopt_array($curl_users, [
                                CURLOPT_URL => $usersUrl,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_POST => true,
                                CURLOPT_POSTFIELDS => http_build_query(['payload' => $usersPostDataJson]), // Pass the JSON string here as 'payload'
                                CURLOPT_TIMEOUT => 60 // Set a timeout of 60 seconds for the request
                            ]);
                            
                            // Execute cURL request to add users to the custom audience
                            $users_response = curl_exec($curl_users);
                            // pre($users_response);
                            
                            // Check for errors in cURL request for adding users
                            if (curl_errno($curl_users)) {
                                $error = curl_error($curl_users);
                                curl_close($curl_users);
                                // Handle the error gracefully, you can log it or display a message
                                echo "cURL Error adding users: $error\n";
                            } else {
                                // Output the response
                                echo $users_response;
                            }
                            
                            // Close cURL session for adding users to the custom audience
                            curl_close($curl_users);
                            pre($users_response);
                            // Return a message with the total estimated users added
                            return "All records processed successfully. Total estimated users: $estimated_total";

                        } else {
                            // Handle the case when $response_data is empty or does not contain 'id'
                            return "Custom audience ID not available.";
                        }
                       
                } else {
                    // For example, you can return a message indicating that the custom audience was not created
                    return "Custom audience not created because pages_name is equal to 0.";
                }
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
            $secondDb = DatabaseDefaultConnection();
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
                    "name",
                    "id=" . $userEditdata["intrested_site"],
                    $username . "_audience"
                );
                $inquiry_details =
                    isset($inquiry_type_name["name"]) &&
                    !empty($inquiry_type_name["name"])
                        ? $inquiry_type_name["name"]
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
                $db_connection = DatabaseDefaultConnection();
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
                                        // Check if column name should be excluded
                                        if (
                                            strpos($columnName, "id") === false &&
                                            strpos($columnName, "date") === false &&
                                            strpos($columnName, "status") === false &&
                                            strpos($columnName, "type") === false &&
                                            strpos($columnName, "amount") === false &&
                                            strpos($columnName, "inquiry") === false &&
                                            strpos($columnName, "buy") === false &&
                                            strpos($columnName, "pay") === false &&
                                            strpos($columnName, "created") === false &&
                                            strpos($columnName, "head") === false &&
                                            strpos($columnName, "unit") === false &&
                                            strpos($columnName, "follow") === false &&
                                            strpos($columnName, "is") === false &&
                                            strpos($columnName, "tooltip") === false &&
                                            strpos($columnName, "site_") === false &&
                                            strpos($columnName, "area_") === false &&
                                            $columnName !== "name" // Exclude "name" field
                                        ) {
                                            // Add column name to dropdown list
                                            $html .= '<li><button class="dropdown-item list_item" type="button"><span>' . $columnName . '</span></button></li>';
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
        $facebook_syncro = $_POST["facebook_syncro"];
        $pages_name = $_POST["pages_name"];
        $ad_account_id = $_POST["ad_account_id"];
        // pre($pages_name);
        // die();
        $currentDateTime = date("Y-m-d H:i:s");
        if (isset($_FILES["import_file"])) {
            if ($_FILES["import_file"]["error"] === UPLOAD_ERR_OK) {
                $db_connection = DatabaseDefaultConnection();
                $tmpFilePath = $_FILES["import_file"]["tmp_name"];
                $spreadsheet = IOFactory::load($tmpFilePath); // Load the uploaded Excel file
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                $rowsss = array_map('str_getcsv', file($tmpFilePath));
                // foreach ($rows as $row) {
                $new_column = [];
                unset($_POST["name"]);
                unset($_POST["source"]);
                unset($_POST["facebook_syncro"]);
                unset($_POST["pages_name"]);
                unset($_POST["ad_account_id"]);
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
                                            $insert_data["facebook_syncro"] = $facebook_syncro;
                                            $insert_data["pages_name"] = $pages_name;
                                            $insert_data["ad_account_id"] = $ad_account_id;
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
                $username = session_username($_SESSION['username']);
                $this->db = DatabaseDefaultConnection();
                $get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
                $get_access_token_array = $this->db->query($get_token);
                $data_count = $get_access_token_array->getNumRows();
                $fb_account_data = $get_access_token_array->getResultArray()[0];
                $accessToken = $fb_account_data['access_token'];
                $adAccountId = $ad_account_id;
                $url = "https://graph.facebook.com/v12.0/$adAccountId/customaudiences";
                $postData = [
                    'name' => $name, // Change here to use name from POST data
                    'subtype' => 'CUSTOM',
                    'description' => 'Custom audience from CSV file',
                    'customer_file_source' => 'USER_PROVIDED_ONLY',
                    'access_token' => $accessToken
                ];
    
                // Initialize cURL session
                $curl = curl_init();
            
                // Set cURL options
                curl_setopt_array($curl, [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData
                ]);
            
                // Execute cURL request
                $response = curl_exec($curl);
                // Check for errors
                if(curl_errno($curl)) {
                    $error = curl_error($curl);
                    curl_close($curl);
                    return "cURL Error: $error";
                }
            
                // Close cURL session
                curl_close($curl);
                
                // Decode the JSON response to extract the audience ID
                $response_data = json_decode($response, true);
                $audience_id = $response_data['id'];
    
                // Now, add users to the custom audience
                $usersUrl = "https://graph.facebook.com/v12.0/$audience_id/users?access_token=$accessToken";

                $allUsersData = [];

                foreach ($rowsss as $key => $row) {
                    if ($key != 0) { // Skip the first row which contains headers
                        // Extract email from the current record
                        // $email = $row[0]; // Assuming the first column contains email addresses
                        $mobileno_or_email = $row[1]; // Assuming the second column contains mobile numbers or email addresses
        
                        // Check if the value looks like an email address
                        if (filter_var($mobileno_or_email, FILTER_VALIDATE_EMAIL)) {
                            // If it's an email address, hash it
                            $hashed_value = hash('sha256', $mobileno_or_email);
                        } else {
                            // If it's not an email address, it's considered a mobile number
                            // Remove symbols, letters, and leading zeroes from the mobile number
                            $phone_number = preg_replace("/[^0-9]/", "", $mobileno_or_email);
                            
                            // If the country code is specified, add it to the phone number
                            if (!empty($country_code)) {
                                $phone_number = "+" . $country_code . $phone_number;
                            }
                            
                            // Hash the mobile number
                            $hashed_value = hash('sha256', $phone_number);
                        }
                
                        // Construct payload data for the current user
                        $userPayloadData = [
                            $hashed_value, // Hashed mobile number or email address
                            ["LDU"]        // Specify LDU flag for this entry
                        ];
                
                        // Add the payload data for the current user to the array
                        $allUsersData[] = $userPayloadData;
                    }
                }
                
                // Define the schema
                $schema = ["EMAIL", "DATA_PROCESSING_OPTIONS"];
                $selected_page_id = $pages_name;
                // Define the payload data
                $usersPostData = [
                    "schema" => $schema,
                    "is_raw" => "true",
                    "page_ids" => [$selected_page_id], // Add the page ID(s) here as an array
                    "data" => $allUsersData // Add all users' data
                ];
    
                // Convert data to JSON
                $usersPostDataJson = json_encode($usersPostData);
                // pre($usersPostDataJson);
    
                // Initialize cURL session for adding users
                $curl_users = curl_init();
                curl_setopt_array($curl_users, [
                    CURLOPT_URL => $usersUrl,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query(['payload' => $usersPostDataJson]), // Pass the JSON string here as 'payload'
                    CURLOPT_TIMEOUT => 60 // Set a timeout of 60 seconds for the request
                ]);

                $users_response = curl_exec($curl_users);
                
                // Check for errors in cURL request for adding users
                if (curl_errno($curl_users)) {
                    $error = curl_error($curl_users);
                    curl_close($curl_users);
                    // Handle the error gracefully, you can log it or display a message
                    echo "cURL Error adding users: $error\n";
                } else {
                    // Output the response
                    echo $users_response;
                }
                
                // Close cURL session for adding users to the custom audience
                curl_close($curl_users);
                
                // Return a message with the total estimated users added
                return "All records processed successfully.";
                return json_encode($result);
            }
        }
    }
    public function edit_data_audience()
    {
        if ($this->request->getPost("action") == "edit") {
            $ad_account_id = $this->request->getPost("ad_account_id");
            // pre($_POST);
            // die();
            // Assuming you're using CodeIgniter and retrieving data via $_POST
            $username = session_username($_SESSION['username']);
            $this->db = DatabaseDefaultConnection();
            $get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
            $get_access_token_array = $this->db->query($get_token);
            $data_count = $get_access_token_array->getNumRows();
            $fb_account_data = $get_access_token_array->getResultArray()[0];
            $token = $fb_account_data['access_token'];
            $edit_id = $this->request->getPost('edit_id'); // Retrieve edit_id from POST data
            $account_id = $ad_account_id;
            $url = MetaUrl()."$account_id/customaudiences?fields=id,account_id,name,time_created,time_updated,subtype,approximate_count_lower_bound,approximate_count_upper_bound&access_token=$token";
            $response = file_get_contents($url);
            $audience_datas = json_decode($response, true);

            // Initialize variables to hold audience name and ID
            $audience_name = '';
            $audience_id = '';

            // Iterate through audience data to find the matching ID
            foreach ($audience_datas['data'] as $audience_data) {
                if ($audience_data['id'] == $edit_id) {
                    $audience_name = $audience_data['name'];
                    $audience_id = $audience_data['id'];
                    break; // Stop iterating once the matching ID is found
                }
            }

            // Return both audience name and ID in JSON format
            echo json_encode(['audience_name' => $audience_name, 'audience_id' => $audience_id]);
        }
    }
        public function updateSyncname($audience_name,$new_name)
        {
            $db = DatabaseDefaultConnection();
            $result = $db
                ->table($this->username . '_audience')
                ->where('name', $audience_name)
                ->set('name', $new_name)
                ->update();

            return $result;
        }
        public function update_data_audience()
        {
            // Retrieve necessary data from POST request
            // pre($_POST);
            // die();
            $edit_id = $this->request->getPost('edit_id'); // Retrieve edit_id from POST data
            $ad_account_id = $this->request->getPost("ad_account_id");
            $new_name = $this->request->getPost("new_name");
            $username = session_username($_SESSION['username']);
            $this->db = DatabaseDefaultConnection();
            $get_token = "SELECT * FROM " . $this->username . "_platform_integration WHERE platform_status = 2 AND verification_status = 1";
            $get_access_token_array = $this->db->query($get_token);
            $data_count = $get_access_token_array->getNumRows();
            $fb_account_data = $get_access_token_array->getResultArray()[0];
            $token = $fb_account_data['access_token'];
            $account_id = $ad_account_id;
            $url = MetaUrl()."$account_id/customaudiences?fields=id,account_id,name,time_created,time_updated,subtype,approximate_count_lower_bound,approximate_count_upper_bound&access_token=$token";
            $response = file_get_contents($url);
            $audience_datas = json_decode($response, true);

            // Initialize variables to hold audience name and ID
            $audience_name = '';
            $audience_id = '';

            // Iterate through audience data to find the matching ID
            foreach ($audience_datas['data'] as $audience_data) {
                if ($audience_data['id'] == $edit_id) {
                    $audience_name = $audience_data['name'];
                    break; 
                }
            }
            // Construct the URL to update the audience name via Facebook Graph API
            $url = "https://graph.facebook.com/v19.0/$edit_id";
            // pre($url);
            // die();
            // Data to be sent in the cURL request
            $data = array(
                'name' => $new_name,
                'access_token' => $token
            );

            // Initialize cURL session
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute cURL request
            $response = curl_exec($ch);

            // Check for errors
            if($response === false) {
                $error_message = curl_error($ch);
                // Handle error
                echo json_encode(['error' => $error_message]);
            } else {
                // Decode the JSON response
                $decoded_response = json_decode($response, true);
                // Check if the update was successful
                if (isset($decoded_response['success'])) {
                    // Return success response
                    echo json_encode(['success' => true]);
                    $this->updateSyncname($audience_name,$new_name);
                } else {
                    // Handle unsuccessful update
                    echo json_encode(['error' => 'Failed to update audience name']);
                }
            }

            // Close cURL session
            curl_close($ch);
        }
}
?>
