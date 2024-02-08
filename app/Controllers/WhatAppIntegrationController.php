<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class WhatAppIntegrationController extends BaseController
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

    public function master_whatsapp_list_data()
    {
        //06-02-2024

        $table_username = getMasterUsername();
        $db_connection = \Config\Database::connect('second');
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
                        $urllistdata = 'https://graph.facebook.com/v19.0/' . $settings_data['whatapp_business_account_id'] . '/message_templates?fields=name,status,category,language,components,quality_score&access_token=' . $settings_data['whatapp_access_token'];
                        $responselistdata = getSocialData($urllistdata);
                        if (isset($responselistdata)) {
                            if (isset($responselistdata['data'])) {
                                // pre($responselistdata['data']);
                                if (!empty($responselistdata['data'])) {
                                    foreach ($responselistdata['data'] as $key => $value) {
                                        $Name = $value['name'];
                                        $Category = $value['category'];
                                        $Body = '';
                                        $id = $value['id'];
                                        $language = $value['language'];
                                        $status = $value['status'];

                                        if($status == "APPROVED"){
                                            if(isset($value['quality_score']['score'])){
                                                if($value['quality_score']['score'] == "UNKNOWN"){
                                                    $status = $status.' -  Quality pending';
                                                }else{
                                                    $status = $status.' - '.$value['quality_score']['score'];

                                                }
                                            }
                                        }

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
                                                <td class="py-2">' . $status . '</td>

                                                <td class="py-2 ">
                                                    <div class="overflow-hidden position-relative" style="width: 400px !important;text-wrap:nowrap;text-overflow:ellipsis " >
                                                        ' . $Body . '
                                                    </div>
                                                </td>
                                                <td class="py-2">' . $language . '</td>
                                                <td class="template-creation-table-data text-center cwt-border-right p-l-25">
                                                    <span>
                                                        <i class="fa fa-eye fs-16 view_template" data-bs-toggle="modal" data-bs-target="#view_template" data-preview_id="2" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
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
        $this->db = \Config\Database::connect('second');
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
        $uploadStatus = 1;
        $response = array();

        if (!empty($files)) {
            $uploadDir = 'assets/Master_Social_Media_Folder/WhatApp_Media/';
            $serverDomain = base_url() . 'whatsapp';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filesArr = $files["uploade_file"];
            $fileName = $filesArr['name'];
            $fileName = str_replace(' ', '', $fileName);

            $uploadedFile = '';
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif'))) {
                $uploadSubDir = 'images/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                if ($filesArr["size"] > 1048576) {
                } else {
                    $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                    if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                        $uploadedFile .= $fileName . ',';
                        $photoUrl = $serverDomain . $uploadSubDir . $fileName;
                        $response['photoUrl'] = $photoUrl;
                    } else {
                        $uploadStatus = 0;
                        $response['message'] = 'Sorry, there was an error uploading your file.';
                    }
                }
            } elseif (in_array(strtolower($fileType), array('mp4', 'mov', 'avi', 'mkv'))) {
                $uploadSubDir = 'videos/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                    $uploadedFile .= $fileName . ',';
                    $videoUrl = $serverDomain . $uploadSubDir . $fileName;
                    $response['videoUrl'] = $videoUrl;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
                // if (command_exists('ffmpeg')) {
                //     $compressedVideoPath = compressVideo($filesArr["tmp_name"], $uploadDir . $uploadSubDir);

                //     if ($compressedVideoPath !== false) {
                //         $uploadedFile .= $compressedVideoPath;
                //     } else {
                //         $uploadStatus = 0;
                //         $response['message'] = 'Error while compressing the video.';
                //     }
                // } else {
                //     $uploadStatus = 0;
                //     $response['message'] = 'FFmpeg is not installed on the server.';
                // }
            } elseif (in_array(strtolower($fileType), array('pdf', 'doc', 'docx', 'txt'))) {
                $uploadSubDir = 'documents/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                    $uploadedFile .= $fileName . ',';
                    $documentsurl = $serverDomain . $uploadSubDir . $fileName;
                    $response['documentsurl'] = $documentsurl;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
            } else {
                $uploadSubDir = 'other/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                    $uploadedFile .= $fileName . ',';
                    $otherurl = $serverDomain . $uploadSubDir . $fileName;
                    $response['otherurl'] = $otherurl;
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
                $outputURL = '';
                if (!empty($response['photoUrl'])) {
                    $insert_data['media_url'] = $response['photoUrl'];
                    $outputURL = $response['photoUrl'];

                } elseif (!empty($response['videoUrl'])) {
                    $insert_data['media_url'] = $response['videoUrl'];
                    $outputURL = $response['videoUrl'];

                } elseif (!empty($response['documentsurl'])) {
                    $insert_data['media_url'] = $response['documentsurl'];
                    $outputURL = $response['documentsurl'];

                } elseif (!empty($response['otherurl'])) {
                    $insert_data['media_url'] = $response['otherurl'];
                    $outputURL = $response['otherurl'];

                } else {
                    $insert_data['media_url'] = '';
                }

                pre($outputURL);

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


    public function WhatappFileUpload()
    {
        $imgfile = "";
        $data = array();
        $newName = '';
        $files = $_FILES;
        $fileName = '';
        $fileNames = '';
        $uploadStatus = 1;
        $response = array();
        if (!empty($files)) {
            $uploadDir = 'assets/Master_Social_Media_Folder/WhatApp_Media/';
            $serverDomain = base_url() . 'assets/Master_Social_Media_Folder/WhatApp_Media/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filesArr = $files["uploade_file"];
            $fileName = $filesArr['name'];
            $fileName = str_replace(' ', '', $fileName);
            $uploadedFile = '';
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif'))) {
                $uploadSubDir = 'images/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                if ($filesArr["size"] > 1048576) {
                } else {
                    $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                    if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                        $uploadedFile .= $fileName . ',';
                        $photoUrl = $serverDomain . $uploadSubDir . $fileName;
                        $response['photoUrl'] = $photoUrl;
                    } else {
                        $uploadStatus = 0;
                        $response['message'] = 'Sorry, there was an error uploading your file.';
                    }
                }
            } elseif (in_array(strtolower($fileType), array('mp4', 'mov', 'avi', 'mkv'))) {
                $uploadSubDir = 'videos/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                    $uploadedFile .= $fileName . ',';
                    $videoUrl = $serverDomain . $uploadSubDir . $fileName;
                    $response['videoUrl'] = $videoUrl;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }

            } elseif (in_array(strtolower($fileType), array('pdf', 'doc', 'docx', 'txt'))) {
                $uploadSubDir = 'documents/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                    $uploadedFile .= $fileName . ',';
                    $documentsurl = $serverDomain . $uploadSubDir . $fileName;
                    $response['documentsurl'] = $documentsurl;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
            } else {
                $uploadSubDir = 'other/';
                if (!is_dir($uploadDir . $uploadSubDir)) {
                    mkdir($uploadDir . $uploadSubDir, 0755, true);
                }
                $targetFilePath = $uploadDir . $uploadSubDir . $fileName;
                if (move_uploaded_file($filesArr["tmp_name"], $targetFilePath)) {
                    $uploadedFile .= $fileName . ',';
                    $otherurl = $serverDomain . $uploadSubDir . $fileName;
                    $response['otherurl'] = $otherurl;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
            }
        }
        $outputURL = '';
        if (!empty($response['photoUrl'])) {
            $outputURL = $response['photoUrl'];
        } elseif (!empty($response['videoUrl'])) {
            $outputURL = $response['videoUrl'];
        } elseif (!empty($response['documentsurl'])) {
            $outputURL = $response['documentsurl'];
        } elseif (!empty($response['otherurl'])) {
            $outputURL = $response['otherurl'];
        }
        echo $outputURL;
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
        $db = \Config\Database::connect('second');
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
        $access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
        $DataSttring = '{"name":"inquirytemp121","category":"MARKETING","language":"en_US","components":[{"type":"HEADER","format":"TEXT","text":"GymSmart CRM"},{"type":"BODY","text":"Hello Mr.Kanani, Your Inquiry is now Successfully recieved by us."},{"type":"FOOTER","text":"thank you"},{"type": "BUTTONS","buttons": [{"type": "QUICK_REPLY","text": "Reply"}]}]}';
        $url = 'https://graph.facebook.com/v19.0/135764946295075/message_templates?access_token=' . $access_token;


        // pre($url);
        // pre($DataSttring);
        // die();
        $Result = postSocialData($url, $DataSttring);

        pre($Result);
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
        $db_connection = \Config\Database::connect('second');
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

    

    public function SendWhatsAppTemplate()
    {

        // die();
        $njkgcnb = '{
            "name": "inquiry2024",
            "category": "MARKETING",
            "language": "en_US",
            "components": [
                {
                    "type": "HEADER",
                    "format": "TEXT",
                    "text": "GymSmart",
                  },
                    {
                        "type": "BODY",
                        "text": "Hello Aakash,\nYour Inquiry For GymSmart CRM is now successfully received by us."
                    },
                    {
                        "type": "FOOTER",
                        "text": "Thank You"
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


          $dsnkj = '{
            "name": "helloinquir3y1",
            "category": "MARKETING",
            "language": "en",
            "components": [

                {
                    "type": "header",
                    "parameters": [
                      {
                        "type": "IMAGE",
                        "image": {
                          "link": "https://ajasys.in/assets/Master_Social_Media_Folder/WhatApp_Media/images/threemilk.jpg"
                        }
                      }
                    ]
                  }
             ,
              {
                "type": "BODY",
                "text": "Hello Dishant"
              },
              {
                "type": "FOOTER",
                "text": "thanks"
              },
              {
                "type": "BUTTONS",
                "buttons": [
                  {
                    "type": "QUICK_REPLY",
                    "text": "Ok"
                  }
                ]
              }
            ]
          }';
          $dsnkj = '
          {
            "name": "helloinquir23y1",
            "category": "MARKETING",
            "language": "en",
            "components": [
                {
                    "type": "HEADER",
                    "format": "IMAGE",
                    "example": {
                        "header_handle": [
                        "https://scontent.whatsapp.net/v/t61.29466-34/363553397_885728123129440_4429821753050397803_n.jpg?ccb=1-7&_nc_sid=8b1bef&_nc_ohc=sG8NavH4SQ8AX-LFT49&_nc_ht=scontent.whatsapp.net&edm=AH51TzQEAAAA&oh=01_AdT5LU4g6kx9vRPJ7hKOBwuH6SoBtH84M-VOSqanrSb4Fg&oe=65EBBBCE"
                        ]
                    }
                },
              {
                "type": "BODY",
                "text": "Hello Dishant"
              },
              {
                "type": "FOOTER",
                "text": "thanks"
              },
              {
                "type": "BUTTONS",
                "buttons": [
                  {
                    "type": "QUICK_REPLY",
                    "text": "Ok"
                  }
                ]
              }
            ]
          }
          ';


          $dfghjgjg = '{"name":"gymsmartinquiryaakash","category":"MARKETING","language":"en_US","components":[{"type":"HEADER","format":"IMAGE","example":{"header_handle":["https://scontent.whatsapp.net/v/t61.29466-34/363553397_885728123129440_4429821753050397803_n.jpg?ccb=1-7&_nc_sid=8b1bef&_nc_ohc=sG8NavH4SQ8AX-LFT49&_nc_ht=scontent.whatsapp.net&edm=AH51TzQEAAAA&oh=01_AdT3_pnQBEB2RftsunyBeoTkW9PbUo0xKcz24_BYwqZtaA&oe=65EBF40E"]}},{"type":"BODY","text":"Hello Mr.Kanani, \nYour Inquiry is now successfully received  by us. "},{"type":"FOOTER","text":"Thank You For inquiry."},{"type":"BUTTONS","buttons":[{"type":"PHONE_NUMBER","text":"Contact No","phone_number":"+919512180355"}]}]}
            ';
         
          $dfjbj = '{"name":"templateimage11","category":"MARKETING","language":"en","components":[{"type":"HEADER","format":"VIDEO","example":{"header_handle":["https://erp.gymsmart.in/assets/image/gym-logo1.png"]}},{"type":"BODY","text":"Hello Dishant"},{"type":"FOOTER","text":"thank you"}]}';

        $access_token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
        $url = 'https://graph.facebook.com/v19.0/135764946295075/message_templates?access_token=' . $access_token;


        $dfghjgjg = '{"name":"realtosmart_dipawaliaayushi","category":"MARKETING","language":"en","components":[{"type":"HEADER","format":"IMAGE","example":{"header_handle":["https://scontent.whatsapp.net/v/t61.29466-34/416823717_1388979608658934_4459431388717114482_n.png?ccb=1-7&_nc_sid=8b1bef&_nc_ohc=B_VTrYI6jbMAX8hgVga&_nc_ht=scontent.whatsapp.net&edm=AH51TzQEAAAA&oh=01_AdQAs5Mm8vikjHb-h4oretBNmtfFDwPH2wFOZ-6Ya5-bJA&oe=65EBF1A3"]}},{"type":"BODY","text":"Hello Mr.Kanani, \nYour Inquiry is now successfully received  by us. "},{"type":"FOOTER","text":"Thank You For inquiry."},{"type":"BUTTONS","buttons":[{"type":"PHONE_NUMBER","text":"Contact No","phone_number":"+919512180355"}]}]}
            ';

            $fdhgjgfyjgfhkuh = '
            {
                "name": "realtosmart_dipawaliaayushiiii",
                "category": "MARKETING",
                "language": "en",
                "components": [
                  {
                    "type": "HEADER",
                    "format": "IMAGE",
                    "example": {
                      "header_handle": [
                        "https://scontent.whatsapp.net/v/t61.29466-34/416823717_1388979608658934_4459431388717114482_n.png?ccb=1-7&_nc_sid=8b1bef&_nc_ohc=B_VTrYI6jbMAX8hgVga&_nc_ht=scontent.whatsapp.net&edm=AH51TzQEAAAA&oh=01_AdQAs5Mm8vikjHb-h4oretBNmtfFDwPH2wFOZ-6Ya5-bJA&oe=65EBF1A3"
                      ]
                    }
                  },
                  {
                    "type": "BODY",
                    "text": "Hello Mr. Kanani,\nYour inquiry is now successfully received by us."
                  },
                  {
                    "type": "FOOTER",
                    "text": "Thank you for your inquiry."
                  },
                  {
                    "type": "BUTTONS",
                    "buttons": [
                      {
                        "type": "PHONE_NUMBER",
                        "text": "Contact No",
                        "phone_number": "+919512180355"
                      }
                    ]
                  }
                ]
              }
              
            ';





        $fghjfgjb = '
        {
           
            "language": "en",
            "status": "APPROVED",
            "category": "MARKETING",
            "id": "885728119796107"
        },
        {
            "name": "hello_world",
            "components": [
                {
                    "type": "HEADER",
                    "format": "TEXT",
                    "text": "Hello World"
                },
                {
                    "type": "BODY",
                    "text": "Welcome and congratulations!! This message demonstrates your ability to send a WhatsApp message notification from the Cloud API, hosted by Meta. Thank you for taking the time to test with us."
                },
                {
                    "type": "FOOTER",
                    "text": "WhatsApp Business Platform sample message"
                }
            ],
            "language": "en_US",
            "status": "APPROVED",
            "category": "UTILITY",
            "id": "271315509226381"
        }
        ';
        $Result = postSocialData($url, $_POST['jsonString']);
        // $Result = postSocialData($url, $fdhgjgfyjgfhkuh);

        $ReturnResult = 0;
        if (isset($Result['id'])) {
            $ReturnResult = 1;
        }
        // pre($Result);
        echo $ReturnResult;
    }
}
