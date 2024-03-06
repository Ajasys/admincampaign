<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class WhatAppAakashController extends BaseController
{
    public function __construct()
    {
        session();
        helper('custom');
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = '';
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }

    public function WhatAppConnectionCheck()
    {
        $GetWhatAppData = $this->MasterInformationModel->edit_entry2('admin_generale_setting', '1');
        $ReturnStatus = 0;

        if (isset($GetWhatAppData) && !empty($GetWhatAppData)) {
            if (isset($GetWhatAppData['whatapp_phone_number_id']) && isset($GetWhatAppData['whatapp_business_account_id']) && isset($GetWhatAppData['whatapp_access_token']) && isset($GetWhatAppData['whatapp_phone_number_id']) && isset($GetWhatAppData['whatapp_business_account_id']) && isset($GetWhatAppData['whatapp_access_token']) && isset($GetWhatAppData['whatapp_phone_number_id']) && isset($GetWhatAppData['whatapp_business_account_id']) && isset($GetWhatAppData['whatapp_access_token'])) {
            } else {
            }
        }
    }


    public function GetWhatAppIntegrationInformation()
    {
        $GetData = get_editData2('admin_generale_setting', 1);
        $whatapp_phone_number_id = '';
        $whatapp_business_account_id = '';
        $whatapp_access_token = '';
        $whatapp_verification_status = '';

        if (isset($GetData) && !empty($GetData)) {
            $whatapp_phone_number_id = $GetData['whatapp_phone_number_id'];
            $whatapp_business_account_id = $GetData['whatapp_business_account_id'];
            $whatapp_access_token = $GetData['whatapp_access_token'];
            $whatapp_verification_status = $GetData['whatapp_verification_status'];
        }
        $ReturnSendData['whatapp_phone_number_id'] = $whatapp_phone_number_id;
        $ReturnSendData['whatapp_business_account_id'] = $whatapp_business_account_id;
        $ReturnSendData['whatapp_access_token'] = $whatapp_access_token;
        $ReturnSendData['whatapp_verification_status'] = $whatapp_verification_status;

        return json_encode($ReturnSendData, true);
        die();
    }

    public function SubmitWhatAppIntegrationResponse()
    {
        $GetData = get_editData2('admin_generale_setting', 1);
        if (isset($GetData) && !empty($GetData)) {
            $UpdateData = $_POST;
            $response = $this->MasterInformationModel->update_entry2('1', $UpdateData, 'admin_generale_setting');
        } else {
            $InsertData = $_POST;
            // $InsertData['whatapp_created_at_account'] = date('Y-m-d H:i:s', time());
            $response = $this->MasterInformationModel->insert_entry2($InsertData, 'admin_generale_setting');
        }


        $WhatAppRedirectStatus = 0;
        $ConnectionName = '';
        $Error = '';
        $WhatsAppConnectionCheckArray = WhatsAppConnectionCheck();
        $WhatsAppConnectionCheckArray = json_decode($WhatsAppConnectionCheckArray, true);
        if (isset($WhatsAppConnectionCheckArray) && !empty($WhatsAppConnectionCheckArray)) {
            if (isset($WhatsAppConnectionCheckArray['ConnectionStatus'])) {
                $WhatAppRedirectStatus = $WhatsAppConnectionCheckArray['ConnectionStatus'];
                $ConnectionName = $WhatsAppConnectionCheckArray['ConnectionName'];
                $Error = $WhatsAppConnectionCheckArray['Error'];
                // pre($WhatsAppConnectionCheckArray);
            }
        }

        $ReturnArray['ConnectionName'] = $ConnectionName;
        $ReturnArray['ConnectionStatus'] = $WhatAppRedirectStatus;
        $ReturnArray['Error'] = $Error;
        $ReturnArray = json_encode($ReturnArray);
        return $ReturnArray;
    }

    public function master_whatsapp_list_data1()
    {
        //06-02-2024

        $table_username = getMasterUsername();
        $db_connection = DatabaseDefaultConnection();
        $query90 = "SELECT * FROM admin_generale_setting WHERE id IN(1)";
        $result = $db_connection->query($query90);
        $total_dataa_userr_22 = $result->getResult();
        if (isset($total_dataa_userr_22[0])) {
            $settings_data = get_object_vars($total_dataa_userr_22[0]);
        } else {
            $settings_data = array();
        }
        $WhatAppRedirectStatus = 0;
        $Error = '';
        $ConnectionName = '';
        $ConnectionStatus = 0;

        $Html = '';
        if (isset($settings_data) && !empty($settings_data)) {
            if (isset($settings_data['whatapp_phone_number_id']) && isset($settings_data['whatapp_business_account_id']) && isset($settings_data['whatapp_access_token']) && !empty($settings_data['whatapp_phone_number_id']) && !empty($settings_data['whatapp_business_account_id']) && !empty($settings_data['whatapp_access_token']) && $settings_data['whatapp_phone_number_id'] != '0' && $settings_data['whatapp_business_account_id'] != '0') {
                $url = 'https://graph.facebook.com/v19.0/' . $settings_data['whatapp_business_account_id'] . '/?access_token=' . $settings_data['whatapp_access_token'];
                $DataArray = getSocialData($url);
                if (isset($DataArray) && !empty($DataArray)) {
                    if (isset($DataArray['id']) && !empty($DataArray['id'])) {
                        $ConnectionStatus = 1;
                        $urllistdata = 'https://graph.facebook.com/v19.0/' . $settings_data['whatapp_business_account_id'] . '/message_templates?fields=name,status,category,language,components&access_token=' . $settings_data['whatapp_access_token'];
                        $responselistdata = getSocialData($urllistdata);

                        if (isset($responselistdata)) {
                            if (isset($responselistdata['data'])) {
                                if (!empty($responselistdata['data'])) {
                                    // pre($responselistdata['data']);
                                    foreach ($responselistdata['data'] as $key => $value) {
                                        print_r($value);

                                        $Name = $value['name'];
                                        $Category = $value['category'];
                                        $Body = '';
                                        $id = $value['id'];
                                        $language = $value['language'];
                                        if (isset($value['components']) && !empty($value['components'])) {
                                            foreach ($value['components'] as $key1 => $value1) {
                                                if ($value1['type'] == 'BODY') {
                                                    $Body = $value1['text'];
                                                }
                                            }
                                        }
                                        $Html .= '
                                        <tr class="rounded-pill">
                                                <td class="py-2 text-capitalize">' . $Name . '</td>
                                                <td class="py-2">' . $Category . '</td>
                                                <td class="py-2 ">
                                                    <div class="overflow-hidden" style="width: 400px !important;text-wrap:nowrap;text-overflow:ellipsis ">
                                                        ' . $Body . '
                                                    </div>
                                                </td>
                                                <td class="py-2">' . $language . '</td>
                                                <td class="template-creation-table-data text-center cwt-border-right p-l-25">
                                                    <span>
                                                        <i class="fa fa-eye fs-16 view_template" data-bs-toggle="modal" data-bs-target="#view_modal" data-preview_id="2" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-clone fs-16 Edit_template" data-edit_id="2" data-bs-toggle="modal" data-bs-target="#whatsapp_template_add_edit" aria-hidden="true" ng-click="editTemplate(tem)" aria-label="Duplicate Template" md-labeled-by-tooltip="md-tooltip-11" role="button" tabindex="0"></i>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-trash fs-16 Delete_template_id" name="' . $Name . '" id="' . $id . '" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                } else {
                                    $Html .= '<p>No Templates Found</p>';
                                }
                            } else {
                                if (isset($responselistdata['error']['message'])) {
                                    $Html .= '<p>' . $responselistdata['error']['message'] . '</p>';
                                }
                            }
                        }
                    } else {
                        if (isset($DataArray['error'])) {
                            if (isset($DataArray['error']['message'])) {
                                $Error = $DataArray['error']['message'];
                                $Html .= '<p>' . $DataArray['error']['message'] . '</p>';
                            }
                        }
                    }
                }
            }
        }
        $recordsCount = '';
        $return_array['records_count'] = $recordsCount;
        $return_array['html'] = $Html;
        return json_encode($return_array, true);
        die();
    }

    public function duplicate_data2($data, $table)
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
        $result = $this->db->query($sql);
        if ($result->getNumRows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }






    public function whatsapp_template_insert()
    {
        $imgfile = "";
        $data = array();
        $newName = '';
        $files = $_FILES;
        $fileName = '';
        $fileNames = '';
        if (!empty($files)) {
            $uploadDir = 'assets/images/whatsapp_template/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filesArr = $files["uploade_file"];
            $fileName = $filesArr['name'];
            $uploadedFile = '';
            $fileName = $filesArr['name'];
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif')) && $filesArr["size"] > 1048576) {
                $compressedImage = compressImage($filesArr["tmp_name"]);
                if ($compressedImage !== false) {
                    $targetFilePath = $uploadDir . $fileName;
                    if (file_put_contents($targetFilePath, $compressedImage)) {
                        $uploadedFile .= $fileName . ',';
                    } else {
                        $uploadStatus = 0;
                        $response['message'] = 'Error while saving the compressed image.';
                    }
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Error while compressing the image.';
                }
            } else {
                if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                    $uploadedFile .= $fileName . ',';
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
            }
        }

        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $action_name = $this->request->getPost("action");

        if ($this->request->getPost("action") == "insert") {
            unset($_POST['action']);
            unset($_POST['table']);

            if (!empty($_POST)) {
                $insert_data = $_POST;

                if ($fileName != '') {
                    $insert_data['uploade_file'] = $fileName;
                } else {
                    $insert_data['uploade_file'] = '';
                }

                // $isduplicate = $this->duplicate_data2($insert_data, $table_name);

                // if ($isduplicate == 0) {
                $response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
                $foodmasterdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
                $foodmasterdisplaydata = json_decode($foodmasterdisplaydata, true);
                // } else {
                //     return "error";
                // }
            }
        }
    }





    public function whatsapp_template_delete_data()
    {
        if ($this->request->getPost("action") == "delete") {
            $delete_id = $this->request->getPost('id');
            $tablename = $this->request->getPost('table');
            $delete_displaydata = $this->MasterInformationModel->delete_entry3($tablename, $delete_id);
        }
        die();
    }

    public function whatsappView()
    {
        $VIEW_id = $this->request->getPost('EditID');
        $db = DatabaseDefaultConnection();
        $sql = 'SELECT * FROM `master_whatsapp_template` WHERE id =' . $VIEW_id . '';
        $result = $db->query($sql);
        $preview_Data = $result->getRowArray();

        return json_encode($preview_Data);
    }



    public function whatsapptemplate_edit_data()
    {

        if ($this->request->getPost("action") == "edit") {
            $edit_id = $this->request->getPost('edit_id');
            $table_name = $this->request->getPost('table');
            $departmentEditdata = $this->MasterInformationModel->edit_entry2($table_name, $edit_id);


            return json_encode($departmentEditdata, true);
        }

        die();
    }
    public function CheckWhataAppConnection()
    {
    }


    public function WhatsAppRTemplateDeleteRequest()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
            $url = 'https://graph.facebook.com/v19.0/135764946295075/message_templates?hsm_id=' . $_POST['id'] . '&name=' . $_POST['name'] . '&access_token=' . $access_token;
            $Result = deleteSocialData($url);
            $DeleteStatus = 0;
            if (isset($Result)) {
                $DeleteStatus = 1;
            }
            echo $DeleteStatus;
        }
    }



    public function GetWhatAppTemplateList()
    {

        die();
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: fr=07Ds3K9rxHgvySJql..Bk0it9.VP.AAA.0.0.Bk0iu5.AWV1ZxCk_bw'
                ),
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        pre($response);
        die();
        // $RResult = CheckWhataAppConnection();
        $RRR = WhatsAppConnectionCheck();
        $RRR = json_decode($RRR, true);
        // echo $RRR;
        pre($RRR);
        die();
        // function CheckWhataAppConnection(){

        $table_username = getMasterUsername();
        $db_connection = DatabaseDefaultConnection();
        $query90 = "SELECT * FROM admin_generale_setting WHERE id IN(1)";
        $result = $db_connection->query($query90);
        $total_dataa_userr_22 = $result->getResult();
        if (isset($total_dataa_userr_22[0])) {
            $settings_data = get_object_vars($total_dataa_userr_22[0]);
        } else {
            $settings_data = array();
        }
        $WhatAppRedirectStatus = 0;
        $Error = '';
        $ConnectionName = '';
        $ConnectionStatus = 0;

        if (isset($settings_data) && !empty($settings_data)) {
            if (isset($settings_data['whatapp_phone_number_id']) && isset($settings_data['whatapp_business_account_id']) && isset($settings_data['whatapp_access_token']) && !empty($settings_data['whatapp_phone_number_id']) && !empty($settings_data['whatapp_business_account_id']) && !empty($settings_data['whatapp_access_token']) && $settings_data['whatapp_phone_number_id'] != '0' && $settings_data['whatapp_business_account_id'] != '0') {
                $url = 'https://graph.facebook.com/v19.0/' . $settings_data['whatapp_business_account_id'] . '/?access_token=' . $settings_data['whatapp_access_token'];
                $DataArray = getSocialData($url);
                if (isset($DataArray) && !empty($DataArray)) {
                    if (isset($DataArray['id']) && !empty($DataArray['id'])) {
                        if (isset($DataArray['name'])) {
                            $ConnectionName = $DataArray['name'];
                            // pre($ConnectionName);
                        }
                        $ConnectionStatus = 1;
                    } else {
                        if (isset($DataArray['error'])) {
                            if (isset($DataArray['error']['message'])) {
                                $Error = $DataArray['error']['message'];
                                $ConnectionStatus = 2;
                                // pre($Error);
                            }
                        }
                    }
                }
                // return $response;
                // '.$settings_data['whatapp_business_account_id'].'
                // pre($settings_data['whatapp_business_account_id']);
                // pre($settings_data['whatapp_access_token']);
            }
        }
        // die();

        $ReturnArray['ConnectionName'] = $ConnectionName;
        $ReturnArray['ConnectionStatus'] = $ConnectionStatus;
        $ReturnArray['Error'] = $Error;

        return json_decode($ReturnArray, true);


        // }
        // pre($RResult);
        die();


        $access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';

        $url = 'https://graph.facebook.com/v19.0/135764946295075/message_templates?access_token=' . $access_token;
        $DataSttring = '
      {
          "name": "dishant_testing_9_52",
          "language": "en_US",
          "category": "MARKETING",
          "components": [
            {
              "type": "HEADER",
              "format": "TEXT",
              "text": "Our {{1}} is on!",
              "example": {
                "header_text": [
                  "Summer Sale"
                ]
              }
            },
            {
              "type": "BODY",
              "text": "Shop now through {{1}} and use code {{2}} to get {{3}} off of all merchandise.",
              "example": {
                "body_text": [
                  [
                    "the end of August",
                    "25OFF",
                    "25%"
                  ]
                ]
              }
            },
            {
              "type": "FOOTER",
              "text": "Use the buttons below to manage your marketing subscriptions"
            },
            {
              "type": "BUTTONS",
              "buttons": [
                {
                  "type": "QUICK_REPLY",
                  "text": "Unsubscribe from Promos"
                },
                {
                  "type": "QUICK_REPLY",
                  "text": "Unsubscribe from All"
                }
              ]
            }
          ]
        }';

        $Result = postSocialData($url, $DataSttring);
        pre($Result);

        // die();


        //Get All template Api
        $url = 'https://graph.facebook.com/v19.0/135764946295075/message_templates?fields=name,status&access_token=' . $access_token;
        $response = getSocialData($url);
        pre($response);


        die();
        $access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
        $url = 'https://graph.facebook.com/v19.0/135764946295075/message_templates?access_token=' . $access_token;

        $DataSttring = '
      {
          "name": "dishant_testing_6_19",
          "language": "en_US",
          "category": "MARKETING",
          "components": [
            {
              "type": "HEADER",
              "format": "TEXT",
              "text": "Our {{1}} is on!",
              "example": {
                "header_text": [
                  "Summer Sale"
                ]
              }
            },
            {
              "type": "BODY",
              "text": "Shop now through {{1}} and use code {{2}} to get {{3}} off of all merchandise.",
              "example": {
                "body_text": [
                  [
                    "the end of August",
                    "25OFF",
                    "25%"
                  ]
                ]
              }
            },
            {
              "type": "FOOTER",
              "text": "Use the buttons below to manage your marketing subscriptions"
            },
            {
              "type": "BUTTONS",
              "buttons": [
                {
                  "type": "QUICK_REPLY",
                  "text": "Unsubscribe from Promos"
                },
                {
                  "type": "QUICK_REPLY",
                  "text": "Unsubscribe from All"
                }
              ]
            }
          ]
        }';
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $DataSttring,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        pre($response);
        die();
        // postSocialData($url, $JsonData);
        // function getFacebookData($url, $pageAccessToken)
        // {
        //     $curl = curl_init();
        //     curl_setopt_array($curl, array(
        //         CURLOPT_URL => $url,
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_ENCODING => '',
        //         CURLOPT_MAXREDIRS => 10,
        //         CURLOPT_TIMEOUT => 0,
        //         CURLOPT_FOLLOWLOCATION => true,
        //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //         CURLOPT_CUSTOMREQUEST => 'GET',
        //         CURLOPT_HTTPHEADER => array(
        //             'Cookie: fr=07Ds3K9rxHgvySJql..Bk0it9.VP.AAA.0.0.Bk0iu5.AWV1ZxCk_bw'
        //         ),
        //     ));
        //     curl_setopt($curl, CURLOPT_URL, $url . '?access_token=' . $pageAccessToken);
        //     $response = curl_exec($curl);
        //     curl_close($curl);
        //     return json_decode($response, true);
        // }

        die();

        $errormsg = '';
        $access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
        $url = 'https://graph.facebook.com/v19.0/135764946295075/message_templates?fields=name,status&access_token=' . $access_token;
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
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
            )
        );
        $response = curl_exec($curl);
        $DataTemplateListArray = '';
        curl_close($curl);
        if ($response != '' || !empty($response)) {
            $DataArray = json_decode($response, true);
            if (isset($DataArray) && !empty($DataArray)) {
                if (isset($DataArray['data'])) {
                    if (!empty($DataArray['data'])) {
                        $DataTemplateListArray = $DataArray['data'];
                    } else {
                    }
                } else {
                    if (isset($DataArray['error'])) {
                        if (!empty($DataArray['error'])) {
                            $errormsg = $DataArray['error']['message'];
                        } else {
                        }
                    }
                }
            } else {
            }
        }
    }

    //   -----------------------------------------------------------------------------------------------------------------------------------------------------------------------




    public function single_whatsapp_template_sent()
    {
        $post_data = $_POST;

        $template_name = $post_data['header'];
        $phone_no = $post_data['phone_no'];
        $language = $post_data['language'];

        $access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';

        $url = "https://graph.facebook.com/v19.0/156839030844055/messages?access_token=" . $access_token;
        $postData = json_encode([
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $phone_no,
            "type" => "template",
            "template" => [
                "name" => $template_name,
                "language" => [
                    "code" => $language
                ]
            ]
        ]);
        $Result = postSocialData($url, $postData);
        $ReturnResult = 1;
        if (isset($Result['id'])) {
            $ReturnResult = 0;
        }
        echo $ReturnResult;
    }
    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         "Content-Type: application/json",
    //         "Content-Length: " . strlen($postData),
    //     ]);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     $response = curl_exec($ch);

    //     if ($response == false) {
    //         $error = curl_error($ch);
    //         echo "cURL Error: " . $error;
    //         $msgStatus = 0;
    //     } else {
    //         $msgStatus = 1;
    //         echo $response;
    //     }

    //     curl_close($ch);
    //     return json_encode($msgStatus, true);
    // }
    public function master_whatsapp_list_data()
    {
        $table_username = getMasterUsername();
        $db_connection = DatabaseDefaultConnection();
        $query90 = "SELECT * FROM admin_generale_setting WHERE id IN(1)";
        $result = $db_connection->query($query90);
        $total_dataa_userr_22 = $result->getResult();
        if (isset($total_dataa_userr_22[0])) {
            $settings_data = get_object_vars($total_dataa_userr_22[0]);
        } else {
            $settings_data = array();
        }
        $WhatAppRedirectStatus = 0;
        $Error = '';
        $ConnectionName = '';
        $ConnectionStatus = 0;
        $Html = '';
        $header = '';
        if (isset($settings_data) && !empty($settings_data)) {
            if (isset($settings_data['whatapp_phone_number_id']) && isset($settings_data['whatapp_business_account_id']) && isset($settings_data['whatapp_access_token']) && !empty($settings_data['whatapp_phone_number_id']) && !empty($settings_data['whatapp_business_account_id']) && !empty($settings_data['whatapp_access_token']) && $settings_data['whatapp_phone_number_id'] != '0' && $settings_data['whatapp_business_account_id'] != '0') {
                $url = 'https://graph.facebook.com/v19.0/' . $settings_data['whatapp_business_account_id'] . '/?access_token=' . $settings_data['whatapp_access_token'];
                $DataArray = getSocialData($url);
                if (isset($DataArray) && !empty($DataArray)) {
                    if (isset($DataArray['id']) && !empty($DataArray['id'])) {
                        $ConnectionStatus = 1;
                        $urllistdata = 'https://graph.facebook.com/v19.0/' . $settings_data['whatapp_business_account_id'] . '/message_templates?fields=name,status,category,language,components,quality_score&access_token=' . $settings_data['whatapp_access_token'];
                        $responselistdata = getSocialData($urllistdata);
                        $templateNames = [];

                        foreach ($responselistdata['data'] as $item) {
                            if ($item['status'] == "APPROVED") {
                                $templateNames[$item['id']] = $item['name'];
                                $templatelanguage[$item['name']] = $item['language'];
                            }
                        }

                        if (isset($responselistdata)) {
                            if (isset($responselistdata['data'])) {
                                // pre($responselistdata['data']);
                                if (!empty($responselistdata['data'])) {
                                    foreach ($responselistdata['data'] as $key => $value) {
                                        // pre($value);
                                        $Name = $value['name'];
                                        $Category = $value['category'];
                                        $Body = '';
                                        $id = $value['id'];
                                        $language = $value['language'];
                                        $status = $value['status'];

                                        if ($status == "APPROVED") {
                                            if (isset($value['quality_score']['score'])) {
                                                if ($value['quality_score']['score'] == "UNKNOWN") {
                                                    $status = $status . ' -  Quality pending';
                                                } else {
                                                    $status = $status . ' - ' . $value['quality_score']['score'];
                                                }
                                            }
                                        }

                                        if (isset($value['components']) && !empty($value['components'])) {
                                            foreach ($value['components'] as $key1 => $value1) {
                                                // pre($value1);

                                                if ($value1['type'] == 'BODY') {
                                                    $Body = $value1['text'];
                                                }
                                                if ($value1['type'] == 'FOOTER') {
                                                    $footer = $value1['text'];
                                                }

                                                $buttonvalue = "";

                                                if ($value1['type'] == 'BUTTONS' && isset($value1['buttons'][0])) {
                                                    $button = $value1['buttons'][0];

                                                    if ($button['type'] == 'QUICK_REPLY' && isset($button['text']) && is_string($button['text'])) {
                                                        $buttonvalue = $button['text'];
                                                    } elseif ($button['type'] == 'URL' && isset($button['url']) && is_string($button['url'])) {
                                                        $buttonvalue = $button['url'];
                                                    } elseif ($button['type'] == 'PHONE_NUMBER' && isset($button['phone_number']) && is_string($button['phone_number'])) {
                                                        $buttonvalue = $button['phone_number'];
                                                    }
                                                }




                                                if ($value1['type'] == 'HEADER') {
                                                    if (isset($value1['format'])) {
                                                        if ($value1['format'] == 'IMAGE') {
                                                            if (isset($value1['example']['header_handle']) && is_array($value1['example']['header_handle'])) {
                                                                $header = $value1['example']['header_handle'][0];
                                                            } else {
                                                                $header = "";
                                                            }
                                                        } elseif ($value1['format'] == 'VIDEO') {
                                                            $header = "";
                                                        } elseif ($value1['format'] == 'TEXT') {
                                                            if (isset($value1['text'])) {
                                                                $header = $value1['text'];
                                                            } else {
                                                                $header = "";
                                                            }
                                                        } else {
                                                            $header = "";
                                                        }
                                                    } else {
                                                        $header = "";
                                                    }
                                                }

                                                // if ($value1['type'] == 'BUTTONS') {
                                                //     if (isset($value1['type'])) {
                                                //         if ($value1['type'] == 'QUICK_REPLY') {
                                                //             if (isset($value1['text']) && is_array($value1['text'])) {
                                                //                 $button = $value1['text'][0];
                                                //             } else {
                                                //                 $button = "";
                                                //             }
                                                //         } elseif ($value1['type'] == 'URL') {
                                                //             if (isset($value1['url']) && is_array($value1['url'])) {
                                                //                 $button = $value1['url'][0];
                                                //             } else {
                                                //                 $button = "";
                                                //             }
                                                //         } elseif ($value1['type'] == 'PHONE_NUMBER') {
                                                //             if (isset($value1['phone_number']) && is_array($value1['phone_number'])) {
                                                //                 $button = $value1['phone_number'][0];
                                                //             } else {
                                                //                 $button = "";
                                                //             }
                                                //         } else {
                                                //             $button = "";
                                                //         }
                                                //     } else {
                                                //         $button = "";
                                                //     }
                                                // }



                                            }
                                        }
                                        $Html .= '
                                        <tr class="rounded-pill WhatsAppTemplateModelViewBtn" data-bs-toggle="modal" data-bs-target="#view_modal" buttontext="' . $buttonvalue . '" headertext="' . $header . '"  Bodytext="' . $Body . '"footertext="' . $footer . '"  id="' . $id . '" >
                                                <td class="py-2 text-capitalize">' . $Name . '</td>
                                                <td class="py-2">' . $Category . '</td>
                                                <td class="py-2">' . $status . '</td>

                                                <td class="py-2 ">
                                                    <div class="overflow-hidden position-relative" style="width: 400px !important;text-wrap:nowrap;text-overflow:ellipsis " >
                                                        ' . $Body . '
                                                    </div>
                                                </td>
                                                <td class="py-2">' . $language . '</td>
                                                <td class="template-creation-table-data text-center cwt-border-right p-l-25 d-none">
                                                    <span>
                                                        <i class="fa fa-eye fs-16 view_template" data-bs-toggle="modal" data-bs-target="#view_template" data-preview_id="2" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                        <i class="fa fa-clone fs-16 Edit_template d-none" data-edit_id="2" data-bs-toggle="modal" data-bs-target="#whatsapp_template_add_edit" aria-hidden="true" ng-click="editTemplate(tem)" aria-label="Duplicate Template" md-labeled-by-tooltip="md-tooltip-11" role="button" tabindex="0"></i>
                                                        <i class="fa fa-trash fs-16 Delete_template_id d-none" name="' . $Name . '" id="' . $id . '" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                } else {
                                    $Html .= '<p>No Templates Found</p>';
                                }
                            } else {
                                if (isset($responselistdata['error']['message'])) {
                                    $Html .= '<p>' . $responselistdata['error']['message'] . '</p>';
                                }
                            }
                        }
                    } else {
                        if (isset($DataArray['error'])) {
                            if (isset($DataArray['error']['message'])) {
                                $Error = $DataArray['error']['message'];
                                $Html .= '<p>' . $DataArray['error']['message'] . '</p>';
                            }
                        }
                    }
                }
            }
        }
        $recordsCount = '';
        $return_array['records_count'] = $recordsCount;
        $return_array['template_name'] = $templateNames;
        $return_array['templatelanguage'] = $templatelanguage;
        $return_array['html'] = $Html;
        return json_encode($return_array, true);
        die();
    }






    // =================================================================Dishant===========================================================================>
    public function WhatsAppConnectionEntry()
    {
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $table_name = $username . '_platform_integration';
        if ($_POST['action'] == 'insert') {
            $whatapp_phone_number_id = $_POST['whatapp_phone_number_id'];
            $whatapp_business_account_id = $_POST['whatapp_business_account_id'];
            $whatapp_access_token = $_POST['whatapp_access_token'];
            $isduplicate = 1;
            $insertdata['phone_number_id'] = $whatapp_phone_number_id;
            $insertdata['business_account_id'] = $whatapp_business_account_id;
            $insertdata['access_token'] = $whatapp_access_token;
            $insertdata['platform_status'] = 1;
            $isduplicate = $this->duplicate_data2($insertdata, $table_name);
            if ($isduplicate == 0) {
                $response = $this->MasterInformationModel->insert_entry2($insertdata, $table_name);
                echo 1;
            } else {
                echo 0;
            }
        }
    }


}
