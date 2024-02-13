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


        $table_username = getMasterUsername();
        $db_connection = \Config\Database::connect('second');

        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $table_name = $username . '_platform_integration';

        $query90 = "SELECT * FROM $table_name WHERE id = " . intval($_POST['connectionid']) . "";
        $result = $db_connection->query($query90);
        $total_dataa_userr_22 = $result->getResult();
        if (isset($total_dataa_userr_22[0])) {
            $settings_data = get_object_vars($total_dataa_userr_22[0]);
        } else {
            $settings_data = array();
        }

        // pre($settings_data);
        // die();
        $WhatAppRedirectStatus = 0;
        $Error = '';
        $ConnectionName = '';
        $ConnectionStatus = 0;
        $header = '';
        $footer = '';
        $Html = '';
        if (isset($settings_data) && !empty($settings_data)) {
            if (isset($settings_data['phone_number_id']) && isset($settings_data['business_account_id']) && isset($settings_data['access_token']) && !empty($settings_data['phone_number_id']) && !empty($settings_data['business_account_id']) && !empty($settings_data['access_token']) && $settings_data['phone_number_id'] != '0' && $settings_data['business_account_id'] != '0') {
                $url = 'https://graph.facebook.com/v19.0/' . $settings_data['business_account_id'] . '/?access_token=' . $settings_data['access_token'];
                $DataArray = getSocialData($url);
                if (isset($DataArray) && !empty($DataArray)) {
                    if (isset($DataArray['id']) && !empty($DataArray['id'])) {
                        $ConnectionStatus = 1;
                        $urllistdata = 'https://graph.facebook.com/v19.0/' . $settings_data['business_account_id'] . '/message_templates?limit=500&fields=name,status,category,language,components,quality_score&access_token=' . $settings_data['access_token'];
                        $responselistdata = getSocialData($urllistdata);
                        $templateNames = [];

                        foreach ($responselistdata['data'] as $item) {
                            if ($item['status'] == "APPROVED") {
                                $templateNames[$item['id']] = $item['name'];
                                $templatelanguage[$item['name']] = $item['language'];
                                // $bodyvalue[$item['name']] = $item['body'];
                                if (isset($item['components']) && !empty($item['components'])) {
                                    foreach ($item['components'] as $key2 => $value2) {
                                        if ($value2['type'] == 'BODY') {
                                            $Body1 = $value2['text'];
                                            $templatebody[$item['name']] = $Body1;
                                        }

                                        if ($value2['type'] == 'FOOTER') {
                                            $footer1 = $value2['text'];
                                            $templatefooter[$item['name']] = $footer1;
                                        }

                                        $buttonvalue = "";

                                        if ($value2['type'] == 'BUTTONS' && isset($value2['buttons'][0])) {
                                            $button = $value2['buttons'][0];
                                            $templateBUTTON[$item['name']] = $button;


                                            if ($button['type'] == 'QUICK_REPLY' && isset($button['text']) && is_string($button['text'])) {
                                                $buttonvalue = $button['text'];
                                                $templateBUTTON[$item['name']] = $buttonvalue;
                                            } elseif ($button['type'] == 'URL' && isset($button['url']) && is_string($button['url'])) {
                                                $buttonvalue = $button['url'];
                                                $templateBUTTON[$item['name']] = $buttonvalue;
                                            } elseif ($button['type'] == 'PHONE_NUMBER' && isset($button['phone_number']) && is_string($button['phone_number'])) {
                                                $buttonvalue = $button['phone_number'];
                                                $templateBUTTON[$item['name']] = $buttonvalue;
                                            }
                                        }


                                        if ($value2['type'] == 'HEADER') {
                                            if (isset($value2['format'])) {
                                                if ($value2['format'] == 'IMAGE') {
                                                    if (isset($value2['example']['header_handle']) && is_array($value2['example']['header_handle'])) {
                                                        $header1 = $value2['example']['header_handle'][0];
                                                        $templateheader[$item['name']] = $header1;
                                                    } else {
                                                        $templateheader = "";
                                                    }
                                                } elseif ($value2['format'] == 'VIDEO') {
                                                    $templateheader = "";
                                                } elseif ($value2['format'] == 'TEXT') {
                                                    if (isset($value2['text'])) {
                                                        $header1 = $value2['text'];
                                                        $templateheader[$item['name']] = $header1;
                                                    } else {
                                                        $templateheader = "";
                                                    }
                                                } else {
                                                    $templateheader = "";
                                                }
                                            } else {
                                                $templateheader = "";
                                            }
                                        }
                                    }
                                }
                            }
                        }



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


                                                // $Html .= '
                                                // <tr class="rounded-pill "  >
                                                //         <td class="py-2 text-capitalize WhatsAppTemplateModelViewBtn" name="' . $Name . '" id="' . $id . '">' . $Name . '</td>
                                                //         <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" id="' . $id . '">' . $Category . '</td>
                                                //         <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" id="' . $id . '">' . $status . '</td>

                                                //         <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" id="' . $id . '">
                                                //             <div class="overflow-hidden position-relative" style="width: 400px !important;text-wrap:nowrap;text-overflow:ellipsis " >
                                                //                 ' . $Body . '
                                                //             </div>
                                                //         </td>
                                                //         <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" id="' . $id . '">' . $language . '</td>
                                                //         <td class="template-creation-table-data text-center cwt-border-right p-l-25 ">
                                                //             <span>
                                                //                 <i class="fa fa-eye fs-16 view_template d-none" data-bs-toggle="modal" data-bs-target="#view_template" data-preview_id="2" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                //                 <i class="fa fa-clone fs-16  DuplicationTemplateClassDiv" name="' . $Name . '" id="' . $id . '"></i>
                                                //                 <i class="fa fa-trash fs-16 Delete_template_id d-none" name="' . $Name . '" id="' . $id . '" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                //             </span>
                                                //         </td>
                                                //     </tr>
                                                // ';
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
                                            }
                                        }


                                        if($_POST['searchtext'] ==  "" ||  strpos($Name, strtolower($_POST['searchtext'])) !== false){
                                            // pre('Yes');
                                            $Html .= '
                                                <tr class="rounded-pill "  >
                                                        <td class="py-2  WhatsAppTemplateModelViewBtn"   name="' . $Name . '"data-bs-toggle="modal" data-bs-target="#view_modal" buttontext="' . $buttonvalue . '" headertext="' . $header . '"  Bodytext="' . $Body . '"footertext="' . $footer . '"  id="' . $id . '" >' . $Name . '</td>
                                                        <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" data-bs-toggle="modal" data-bs-target="#view_modal" buttontext="' . $buttonvalue . '" headertext="' . $header . '"  Bodytext="' . $Body . '"footertext="' . $footer . '"  id="' . $id . '" >' . $Category . '</td>
                                                        <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" data-bs-toggle="modal" data-bs-target="#view_modal" buttontext="' . $buttonvalue . '" headertext="' . $header . '"  Bodytext="' . $Body . '"footertext="' . $footer . '"  id="' . $id . '" >' . $status . '</td>

                                                        <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" data-bs-toggle="modal" data-bs-target="#view_modal" buttontext="' . $buttonvalue . '" headertext="' . $header . '"  Bodytext="' . $Body . '"footertext="' . $footer . '"  id="' . $id . '" >
                                                            <div class="overflow-hidden position-relative" style="width: 400px !important;text-wrap:nowrap;text-overflow:ellipsis " >
                                                                ' . $Body . '
                                                            </div>
                                                        </td>
                                                        <td class="py-2 WhatsAppTemplateModelViewBtn" name="' . $Name . '" data-bs-toggle="modal" data-bs-target="#view_modal" buttontext="' . $buttonvalue . '" headertext="' . $header . '"  Bodytext="' . $Body . '"footertext="' . $footer . '"  id="' . $id . '" >' . $language . '</td>
                                                        <td class="template-creation-table-data text-center cwt-border-right p-l-25 ">
                                                            <span>
                                                                <i class="fa fa-eye fs-16 view_template d-none" data-bs-toggle="modal" data-bs-target="#view_template" data-preview_id="2" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                                <i class="fa fa-clone fs-16  DuplicationTemplateClassDiv" name="' . $Name . '" id="' . $id . '"></i>
                                                                <i class="fa fa-trash fs-16 Delete_template_id d-none" name="' . $Name . '" id="' . $id . '" aria-hidden="true" ng-click="openPreview_box(tem)" aria-label="Preview" md-labeled-by-tooltip="md-tooltip-10" role="button" tabindex="0"></i>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                ';
                                        }else{
                                            // pre('no');
                                        }



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

        $Sent_messagae_data = $this->MasterInformationModel->display_all_records2('admin_sent_message_detail');
        $sentmsgdisplaydata = json_decode($Sent_messagae_data, true);

        $html1 = '';
        $i = '';
        // foreach ($sentmsgdisplaydata as $key => $value) {
        //     // pre($value['Status']);
        //     $statusname = '';
        //     $formattedDate  = '';
        //     if ($value['Createdat'] != '0000-00-00 00:00:00') {

        //         $formattedDate = (new \DateTime($value['Createdat']))->format('d-m-Y h:i A');
        //     }

        //     if ($value['Status'] == '0') {
        //         $statusname = 'Sent';
        //     }
        //     if ($value['Status'] == '1') {
        //         $statusname = 'Delivered';
        //     }
        //     if ($value['Status'] == '3') {
        //         $statusname = 'Read';
        //     }
        //     if ($value['Status'] == '4') {
        //         $statusname = 'Failed';
        //     }
        //     $html1 .= '<tr>
		
        //     <td class="whatsapp-col">' . $value['receiver_number'] . '</td>
        //     <td>' . $value['Template_name'] . '</td>
        //     <td>
        //         <div id="whatsapp-meassage">
        //         ' . $value['Whatsapp_Message_id'] . '</div>
        //     </td>
        //     <td>' . $statusname . '</td>
        //     <td>' . $value['WhatsApp_Response'] . '</td>
        //     <td>' . $formattedDate . '</td>
					
			
		// </td>';
        //     $html1 .= '</tr>';
        //     $i++;
        // }


        $recordsCount = '';
        $return_array['templateBUTTON'] = $templateBUTTON;
        $return_array['templatefooter'] = $templatefooter;
        $return_array['templatebody'] = $templatebody;
        $return_array['templateheader'] = $templateheader;
        $return_array['records_count'] = $recordsCount;
        $return_array['template_name'] = $templateNames;
        $return_array['templatelanguage'] = $templatelanguage;
        $return_array['html'] = $Html;
        // $return_array['html1'] = $html1;


        return json_encode($return_array, true);
        die();
    }

    public function SendMessagesHistory()
    {
        $connctionid = $_POST['connectionid'];
        $sentmsgdisplaydata = array();
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $table_name = $username . '_sent_message_detail';
        $db_connection = \Config\Database::connect('second');
        $query90 = "SELECT * FROM $table_name WHERE connection_id = $connctionid ";
        $result = $db_connection->query($query90);
        $total_dataa_userr_22 = $result->getResult();
        if (isset($total_dataa_userr_22[0])) {
            $sentmsgdisplaydata = $result->getResultArray();
        } 

        $html1 = '';
        $i = '';


        
        
        
        


        $FilterPhoneNumber = $_POST['FilterPhoneNumber'];
        $FilterDate = $_POST['FilterDate'];
        $FilterTemplateStatus = $_POST['FilterTemplateStatus'];
        $FilterTemplateName = $_POST['FilterTemplateName'];


        if(isset($sentmsgdisplaydata) && !empty($sentmsgdisplaydata)){
            foreach ($sentmsgdisplaydata as $key => $value) {
                // pre($value['Status']);
                $statusname = '';
                $formattedDate  = '';
                if ($value['Createdat'] != '0000-00-00 00:00:00') {
    
                    $formattedDate = (new \DateTime($value['Createdat']))->format('d-m-Y h:i A');
                    $formattedDate = Utctodate('d-m-Y h:i A',timezonedata(),$formattedDate);
                    


                }
                if ($value['Status'] == '0') {
                    $statusname = '<i class="bi bi-check2 text-dark"></i>';
                }
                if ($value['Status'] == '1') {
                    $statusname = '<i class="bi bi-check2-all text-dark"></i>';
                }
                if ($value['Status'] == '2') {
                    $statusname = '<i class="bi bi-check2-all text-primary"></i>';
                }
                if ($value['Status'] == '3') {
                    $statusname = '<i class="bi bi-exclamation-circle-fill text-danger"></i>
                    ';
                }

                // $one = '7845468745454';
                // $two = '7845';
                // if($two == '' || $two is matched with $one in ){

                // }


               

                if (
                    ($FilterPhoneNumber == '' || strpos($value['receiver_number'], $FilterPhoneNumber)) &&
                    ($FilterDate == '' || date('d-m-Y', strtotime($formattedDate)) == $FilterDate) &&
                    ($FilterTemplateStatus == '' || $value['Status'] == $FilterTemplateStatus) &&
                    ($FilterTemplateName == '' || $value['Template_name'] == $FilterTemplateName)
                ) 
                {
                    $html1 .= '<tr>
                    <td class="whatsapp-col">+ ' . substr_replace($value['receiver_number'], ' ', -10, 0) . '</td>
                    <td>' . $value['Template_name'] . '</td>
                    <td class="d-none">
                        <div id="whatsapp-meassage">
                        ' . $value['Whatsapp_Message_id'] . '</div>
                    </td>
                    <td>' . $statusname . '</td>
                    <td class="d-none">' . $value['WhatsApp_Response'] . '</td>
                    <td>' . $formattedDate . '</td>
                    </td> </tr>';
                    $i++;
                }








            }
        }


        if($FilterPhoneNumber != '' || $FilterDate != '' ||  $FilterTemplateStatus != '' || $FilterTemplateName != ''){
            $html1 .= '<script>$(".FilterClearAll").show();</script>';
        }else{
            $html1 .= '<script>$(".FilterClearAll").hide();</script>';

        }



        $return_array['html1'] = $html1;
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
        $connectionid = $_POST['connectionid'];
        $MetaUrl = config('App')->metaurl;
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $DeleteStatus = 0;

        $table_name = $username . '_platform_integration';

        $ConnectionData = get_editData2($table_name, $connectionid);
        $access_token = '';
        $business_account_id = '';
        $phone_number_id = '';
        if (isset($ConnectionData) && !empty($ConnectionData)) {

            if (isset($ConnectionData['access_token']) && !empty($ConnectionData['access_token']) && isset($ConnectionData['phone_number_id']) && !empty($ConnectionData['phone_number_id']) && isset($ConnectionData['business_account_id']) && !empty($ConnectionData['business_account_id'])) {
                $access_token = $ConnectionData['access_token'];
                $business_account_id = $ConnectionData['business_account_id'];
                $phone_number_id = $ConnectionData['phone_number_id'];
            }
        }


        if ($phone_number_id != '' && $business_account_id != '' && $access_token != '') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $url = $MetaUrl.$business_account_id.'/message_templates?hsm_id=' . $_POST['id'] . '&name=' . $_POST['name'] . '&access_token=' . $access_token;
                $Result = deleteSocialData($url);
                if (isset($Result)) {
                    $DeleteStatus = 1;
                }
                echo $DeleteStatus;
            }
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
            if (isset($settings_data['phone_number_id']) && isset($settings_data['whatapp_business_account_id']) && isset($settings_data['whatapp_access_token']) && !empty($settings_data['phone_number_id']) && !empty($settings_data['whatapp_business_account_id']) && !empty($settings_data['whatapp_access_token']) && $settings_data['phone_number_id'] != '0' && $settings_data['whatapp_business_account_id'] != '0') {
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
        $connectionid = $_POST['connectionid'];
        $MetaUrl = config('App')->metaurl;
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $ReturnResult = 0;

        $table_name = $username . '_platform_integration';

        $ConnectionData = get_editData2($table_name, $connectionid);
        $access_token = '';
        $business_account_id = '';
        $phone_number_id = '';
        if (isset($ConnectionData) && !empty($ConnectionData)) {

            if (isset($ConnectionData['access_token']) && !empty($ConnectionData['access_token']) && isset($ConnectionData['phone_number_id']) && !empty($ConnectionData['phone_number_id']) && isset($ConnectionData['business_account_id']) && !empty($ConnectionData['business_account_id'])) {
                $access_token = $ConnectionData['access_token'];
                $business_account_id = $ConnectionData['business_account_id'];
                $phone_number_id = $ConnectionData['phone_number_id'];
            }
        }


        if ($phone_number_id != '' && $business_account_id != '' && $access_token != '') {
            if ($_POST['action'] == "insert") {
           
                $url = $MetaUrl.$business_account_id.'/message_templates?access_token=' . $access_token;
                // pre($url);
                // die();
                $Result = postSocialData($url, $_POST['jsonString']);
                if (isset($Result['id'])) {
                    $ReturnResult = 1;
                }
            } else {
    
                if ($_POST['templatename'] != '' && $_POST['templateid']) {
             
                    $url = $MetaUrl . $_POST['templateid'] . '/?access_token=' . $access_token;
                    $Result = postSocialData($url, $_POST['jsonString']);
    
                    if (isset($Result['success'])) {
                        $ReturnResult = 1;
                    }
                }
            }
        }

        echo $ReturnResult;
    }

    public function single_whatsapp_template_sent()
    {
        $post_data = $_POST;
        $template_name = $post_data['template_name'];
        $phone_no = $post_data['phone_no'];
        $language = $post_data['language'];
        $template_id = $post_data['template_id'];
        $cuurrenttime = gmdate('Y-m-d H:i:s');
        $connectionid = $_POST['connectionid'];
        $ReturnResult = 0;

        $MetaUrl = config('App')->metaurl;
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
  
        $table_name = $username . '_platform_integration';

        $ConnectionData = get_editData2($table_name, $connectionid);
        $access_token = '';
        $business_account_id = '';
        $phone_number_id = '';
        if (isset($ConnectionData) && !empty($ConnectionData)) {

            if (isset($ConnectionData['access_token']) && !empty($ConnectionData['access_token']) && isset($ConnectionData['phone_number_id']) && !empty($ConnectionData['phone_number_id']) && isset($ConnectionData['business_account_id']) && !empty($ConnectionData['business_account_id'])) {
                $access_token = $ConnectionData['access_token'];
                $business_account_id = $ConnectionData['business_account_id'];
                $phone_number_id = $ConnectionData['phone_number_id'];
            }
        }


        if ($phone_number_id != '' && $business_account_id != '' && $access_token != '') {
            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
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
            if (isset($Result['error_data'])) {
            } elseif (isset($Result['contacts'])) {
                $ReturnResult = 1;
                $db_connection = \Config\Database::connect('second');
                foreach ($Result['contacts'] as $contact) {
                    $receiver_number = $contact['wa_id'];
                    foreach ($Result['messages'] as $message) {
                        $WhatsApp_Message_id = $message['id'];
                        $WhatsApp_Response = $message['message_status'];

                        $sql = "INSERT INTO admin_sent_message_detail (receiver_number,Template_name,template_id, Whatsapp_Message_id, WhatsApp_Response, Createdat, connection_id) VALUES ('$receiver_number','$template_name','$template_id','$WhatsApp_Message_id', '$WhatsApp_Response', '$cuurrenttime', '$connectionid')";
                        $db_connection->query($sql);
                    }
                }
            }
        }
        echo $ReturnResult;
    }

    public function GetWhatsAppTemplateDetails()
    {

        $connectionid = $_POST['connectionid'];
        $MetaUrl = config('App')->metaurl;
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
  
        $table_name = $username . '_platform_integration';

        $ConnectionData = get_editData2($table_name, $connectionid);
        $access_token = '';
        $business_account_id = '';
        $phone_number_id = '';
        if (isset($ConnectionData) && !empty($ConnectionData)) {

            if (isset($ConnectionData['access_token']) && !empty($ConnectionData['access_token']) && isset($ConnectionData['phone_number_id']) && !empty($ConnectionData['phone_number_id']) && isset($ConnectionData['business_account_id']) && !empty($ConnectionData['business_account_id'])) {
                $access_token = $ConnectionData['access_token'];
                $business_account_id = $ConnectionData['business_account_id'];
                $phone_number_id = $ConnectionData['phone_number_id'];
            }
        }


        if ($phone_number_id != '' && $business_account_id != '' && $access_token != '') {
            $url = $MetaUrl.$business_account_id.'/message_templates?hsm_id=' . $_POST['id'] . '&name=' . strtolower($_POST['name']) . '&access_token=' . $access_token;
            $responselistdata = getSocialData($url);
            $resposearray = array();
            if (isset($responselistdata)) {
                if (isset($responselistdata['data'])) {
                    if (!empty($responselistdata['data'])) {
                        foreach ($responselistdata['data'] as $key => $value) {
                            $Name = $value['name'];
                            if ($Name == strtolower($_POST['name'])) {
                                $resposearray = $value;
                            }
                        }
                    }
                }
            }
            echo json_encode($resposearray);
        }

        
    }


    public function WhatsAppConnectionsList()
    {

        $MetaUrl = config('App')->metaurl;
        $html = '';
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $table_name = $username . '_platform_integration';
        $db_connection = \Config\Database::connect('second');
        $query90 = "SELECT * FROM $table_name WHERE platform_status = 1";
        $result = $db_connection->query($query90);
        $total_dataa_userr_22 = $result->getResult();
        if (isset($total_dataa_userr_22[0])) {
            $settings_data = $result->getResultArray();

        } else {
            $settings_data = array();
        }
        $count = 0;
        if (!empty($settings_data)) {
            foreach ($settings_data as $key => $value) {
                $phone_number_id = $value['phone_number_id'];
                $business_account_id = $value['business_account_id'];
                $access_token = $value['access_token'];
                $url = $MetaUrl . $business_account_id . '/phone_numbers/?access_token=' . $access_token;
                $DataArray = getSocialData($url);
                // pre($url);
                // pre($DataArray);
                // die();
                if (isset($DataArray['data'])) {
                    $display_phone_number = '';
                    $verified_name = '';
                    $qualityReating = '';
                    $qualityColor = '';
                    if (isset($DataArray['data'][0]['display_phone_number'])) {
                        $display_phone_number = $DataArray['data'][0]['display_phone_number'];
                    }
                    if (isset($DataArray['data'][0]['verified_name'])) {
                        $verified_name = $DataArray['data'][0]['verified_name'];
                    }
                    if (isset($DataArray['data'][0]['throughput']['level'])) {
                        $qualityReating = $DataArray['data'][0]['throughput']['level'];
                    }
                    if (isset($DataArray['data'][0]['quality_rating'])) {
                        $$qualityColor = $DataArray['data'][0]['quality_rating'];
                    }
                    $phoneNumber = $display_phone_number; // Replace with the actual phone number
                    $countryCode = substr($phoneNumber, 0, 3); // Extract the first three characters
                    $countryMapping = [
                        '+93' => 'Afghanistan', '+355' => 'Albania', '+213' => 'Algeria', '+376' => 'Andorra', '+244' => 'Angola', '+1-268' => 'Antigua and Barbuda', '+54' => 'Argentina', '+374' => 'Armenia', '+61' => 'Australia', '+43' => 'Austria', '+994' => 'Azerbaijan', '+1-242' => 'Bahamas', '+973' => 'Bahrain', '+880' => 'Bangladesh', '+1-246' => 'Barbados', '+375' => 'Belarus', '+32' => 'Belgium', '+501' => 'Belize', '+229' => 'Benin', '+975' => 'Bhutan', '+591' => 'Bolivia', '+387' => 'Bosnia and Herzegovina', '+267' => 'Botswana', '+55' => 'Brazil', '+673' => 'Brunei', '+359' => 'Bulgaria', '+226' => 'Burkina Faso', '+257' => 'Burundi', '+855' => 'Cambodia', '+237' => 'Cameroon', '+1' => 'Canada', '+238' => 'Cape Verde', '+236' => 'Central African Republic', '+235' => 'Chad', '+56' => 'Chile', '+86' => 'China', '+57' => 'Colombia', '+269' => 'Comoros', '+243' => 'Congo (Democratic Republic of the)', '+242' => 'Congo (Republic of the)', '+506' => 'Costa Rica', '+385' => 'Croatia', '+53' => 'Cuba', '+357' => 'Cyprus', '+420' => 'Czech Republic', '+45' => 'Denmark', '+253' => 'Djibouti', '+1-767' => 'Dominica', '+1-809' => 'Dominican Republic', '+670' => 'East Timor (Timor-Leste)', '+593' => 'Ecuador', '+20' => 'Egypt', '+503' => 'El Salvador', '+240' => 'Equatorial Guinea', '+291' => 'Eritrea', '+372' => 'Estonia', '+251' => 'Ethiopia', '+679' => 'Fiji', '+358' => 'Finland', '+33' => 'France', '+241' => 'Gabon', '+220' => 'Gambia', '+995' => 'Georgia', '+49' => 'Germany', '+233' => 'Ghana', '+30' => 'Greece', '+1-473' => 'Grenada', '+502' => 'Guatemala', '+224' => 'Guinea', '+245' => 'Guinea-Bissau', '+592' => 'Guyana', '+509' => 'Haiti', '+504' => 'Honduras', '+36' => 'Hungary', '+354' => 'Iceland', '+91' => 'India', '+62' => 'Indonesia', '+98' => 'Iran', '+964' => 'Iraq', '+353' => 'Ireland', '+972' => 'Israel', '+39' => 'Italy', '+1-876' => 'Jamaica', '+81' => 'Japan', '+962' => 'Jordan', '+7' => 'Kazakhstan', '+254' => 'Kenya', '+686' => 'Kiribati', '+82' => 'Korea, South', '+965' => 'Kuwait', '+996' => 'Kyrgyzstan', '+856' => 'Laos', '+371' => 'Latvia', '+961' => 'Lebanon', '+266' => 'Lesotho', '+231' => 'Liberia', '+218' => 'Libya', '+423' => 'Liechtenstein', '+370' => 'Lithuania', '+352' => 'Luxembourg', '+261' => 'Madagascar', '+265' => 'Malawi', '+60' => 'Malaysia', '+960' => 'Maldives', '+223' => 'Mali', '+356' => 'Malta', '+692' => 'Marshall Islands', '+222' => 'Mauritania', '+230' => 'Mauritius', '+52' => 'Mexico', '+691' => 'Micronesia', '+373' => 'Moldova', '+377' => 'Monaco', '+976' => 'Mongolia', '+382' => 'Montenegro', '+212' => 'Morocco', '+258' => 'Mozambique', '+95' => 'Myanmar (Burma)', '+264' => 'Namibia', '+674' => 'Nauru', '+977' => 'Nepal', '+31' => 'Netherlands', '+64' => 'New Zealand', '+505' => 'Nicaragua', '+227' => 'Niger', '+234' => 'Nigeria', '+47' => 'Norway', '+968' => 'Oman', '+92' => 'Pakistan', '+680' => 'Palau', '+970' => 'Palestine', '+507' => 'Panama', '+675' => 'Papua New Guinea', '+595' => 'Paraguay', '+51' => 'Peru', '+63' => 'Philippines', '+48' => 'Poland', '+351' => 'Portugal', '+974' => 'Qatar', '+40' => 'Romania', '+7' => 'Russia', '+250' => 'Rwanda', '+1-869' => 'Saint Kitts and Nevis', '+1-758' => 'Saint Lucia', '+1-784' => 'Saint Vincent and the Grenadines', '+685' => 'Samoa', '+378' => 'San Marino', '+239' => 'Sao Tome and Principe', '+966' => 'Saudi Arabia', '+221' => 'Senegal', '+381' => 'Serbia', '+248' => 'Seychelles', '+232' => 'Sierra Leone', '+65' => 'Singapore', '+421' => 'Slovakia', '+386' => 'Slovenia', '+677' => 'Solomon Islands', '+252' => 'Somalia', '+27' => 'South Africa', '+211' => 'South Sudan', '+34' => 'Spain', '+94' => 'Sri Lanka', '+249' => 'Sudan', '+597' => 'Suriname', '+46' => 'Sweden', '+41' => 'Switzerland', '+963' => 'Syria', '+886' => 'Taiwan', '+992' => 'Tajikistan', '+255' => 'Tanzania', '+66' => 'Thailand', '+228' => 'Togo', '+676' => 'Tonga', '+1-868' => 'Trinidad and Tobago', '+216' => 'Tunisia', '+90' => 'Turkey', '+993' => 'Turkmenistan', '+688' => 'Tuvalu', '+256' => 'Uganda', '+380' => 'Ukraine', '+971' => 'United Arab Emirates', '+44' => 'United Kingdom', '+1' => 'United States', '+598' => 'Uruguay', '+998' => 'Uzbekistan', '+678' => 'Vanuatu', '+379' => 'Vatican City', '+58' => 'Venezuela', '+84' => 'Vietnam', '+967' => 'Yemen', '+260' => 'Zambia', '+263' => 'Zimbabwe'  
                    ];
                    $countryName = $countryMapping[$countryCode] ?? 'Unknown';
                    $count ++;
                    $html .= '
                        <tr>
                            <td class="align-middle" scope="col-2"><sup class="fs-12"></sup> '.$display_phone_number.'
                            </td>
                            <td class="align-middle" scope="col-1"><span
                                    class="p-1 bg-success-subtle border border-light rounded-pill fs-10 text-success fw-bold ">Connected</span>
                            </td>
                            <td class="align-middle" scope="col-1">
                                <span class="d-inline-block bg-success border border-light rounded-circle"
                                    style="width:11px;height:11px"></span>
                                <span Class="mx-2">'.$qualityReating.'</span>
                            </td>
                            <td class="align-middle text-truncate messeging-content" style="max-width: 150px;"
                                scope="col-2">10 k customers</td>
                            <td class="align-middle" scope="col-1">'.$countryName.'</td>
                            <td class="align-middle" scope="col-2">'.$verified_name.'</td>
                    
                            <td class="align-middle" scope="col-1">
                                <button class="btn border rounded-3 DelectConnection"  table="'.$table_name.'" id="'.$value['id'].'">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
       
                        </tr>
                    ';
                }
            }
        }
        $html .= '<script>$(".CountedNumberT").text('.$count.');</script>';
        echo $html;
    }
}
