<?php
error_reporting(-1);
$verifyToken = 'AWA1235454406';
$access_token = 'your_page_access_token';

function writeToFile($data)
{

    $filename = 'whatsappwebhook_process_info.html';
    // file_put_contents($filename,'', FILE_TEXT);
    $currentDateTime = date('Y-m-d H:i:s');
    $content = '<b>' . $currentDateTime . ': <b> ' . $data . '<br><br><br>' . PHP_EOL;
    // $content = $currentDateTime . ': ' . json_encode($data) . PHP_EOL; // Encode the data before writing
    file_put_contents($filename, $content, FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['hub_mode']) && $_GET['hub_mode'] === 'subscribe') {
    if ($_GET['hub_verify_token'] === $verifyToken) {
        echo $_GET['hub_challenge'];
    } else {
        header('HTTP/1.1 403 Forbidden');
    }
    exit;
}




$servername = "rudrram.com";
$username = "rudrramc_campaign";
$password = "mMzAx-ftZ^!%";
$databasename = "rudrramc_campaign";
// Create connection
$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $databasename
);
$check = 'not connected..';

if ($conn) {
    $check = "connection successfully..";
}


$input = file_get_contents('php://input');
$data = json_decode($input, true);


$response = json_decode(json_encode($data), true);
$servername = "rudrram.com";
$username = "rudrramc_campaign";
$password = "mMzAx-ftZ^!%";
$databasename = "rudrramc_campaign";
$db_connection = mysqli_connect(
    $servername,
    $username,
    $password,
    $databasename
);
$messaging_product = '';
$recipient_id = '';
$id = '';
writeToFile(json_encode($data));
if (isset($response['entry'][0])) {
    $WhatsAppID = '';
    $WhatsAppStatus = '';
    if (isset($response['entry'][0]['changes'][0]['value']['statuses'][0]['id'])) {
        $WhatsAppID = $response['entry'][0]['changes'][0]['value']['statuses'][0]['id'];
    }
    if (isset($response['entry'][0]['changes'][0]['value']['statuses'][0]['status'])) {
        $WhatsAppStatus = $response['entry'][0]['changes'][0]['value']['statuses'][0]['status'];
    }

    if (isset($response['entry'][0]['changes'][0]['value']['statuses'])) {
        if ($WhatsAppID != '' && $WhatsAppStatus != '') {
            $sql = "SELECT * FROM master_user";
            $result = $db_connection->query($sql);
            $num_rows = $result->num_rows;
            $rows = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            $resultsssss = $rows;
            if (isset($resultsssss) && !empty($resultsssss)) {
                foreach ($resultsssss as $key => $result_value) {
                    if (isset($result_value['username']) && !empty($result_value['username'])) {
                        $tablename = $result_value['username'] . '_sent_message_detail';
                        $result = $db_connection->query("SHOW TABLES LIKE '$tablename'");
                        $result = $result->fetch_assoc();
                        $tablestatus = 1;
                        if ($tablestatus == '1') {
                            $subsqls = '';
                            $subsqls2 = '';

                            if ($WhatsAppStatus == "delivered") {
                                $status = 1;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='1', delivertimedate = '" . gmdate('Y-m-d H:i:s') . "' WHERE Whatsapp_Message_id = '" . $WhatsAppID . "' ";
                                $subsqls2 = "UPDATE `" . $result_value['username'] . "_messages` SET `message_status`='1', delivered_date_time = '" . gmdate('Y-m-d H:i:s') . "' WHERE conversation_id = '" . $WhatsAppID . "' ";
                            }
                            if ($WhatsAppStatus == "sent") {
                                $status = 0;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='0' WHERE Whatsapp_Message_id = '" . $WhatsAppID . "'";
                                $subsqls2 = "UPDATE `" . $result_value['username'] . "_messages` SET `message_status`='0', sent_date_time		 = '" . gmdate('Y-m-d H:i:s') . "	 WHERE conversation_id	 = '" . $WhatsAppID . "'";

                            }
                            if ($WhatsAppStatus == "failed") {
                                $status = 3;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='3' WHERE Whatsapp_Message_id = '" . $WhatsAppID . "'";
                                $subsqls2 = "UPDATE `" . $result_value['username'] . "_messages` SET `message_status`='3', failed_date_time	 = '" . gmdate('Y-m-d H:i:s') . "	 WHERE conversation_id	 = '" . $WhatsAppID . "'";

                            }
                            if ($WhatsAppStatus == "read") {
                                $status = 2;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='2', readtimedate = '" . gmdate('Y-m-d H:i:s') . "' WHERE Whatsapp_Message_id = '" . $WhatsAppID . "' ";
                                $subsqls2 = "UPDATE `" . $result_value['username'] . "_messages` SET `message_status`='2', read_date_time = '" . gmdate('Y-m-d H:i:s') . "' WHERE conversation_id = '" . $WhatsAppID . "' ";
                            }

                            if ($subsqls2 != '') {
                                $db_connection->query($subsqls2);
                            }

                            if ($subsqls != '') {
                                $updatedata = $db_connection->query($subsqls);
                            }
                            // if ($status == 2) {
                            foreach ($response['entry'] as $entry) {
                                foreach ($entry['changes'] as $change) {

                                    $value = $change['value'];
                                    $messaging_product = $value['messaging_product'];
                                    $message_type = isset($value['contacts']) ? 'user' : 'sender';
                                    $phone_number_id = $value['metadata']['phone_number_id'];
                                    $wa_id = isset($value['contacts']) ? $value['contacts'][0]['wa_id'] : $value['statuses'][0]['recipient_id'];
                                    $message = $value['messages'][0]['text']['body'];
                                    $timestamp = date('Y-m-d H:i:s', $value['messages'][0]['timestamp']);
                                    // $value = $change['value'];
                                    // $messaging_product = $value['messaging_product'];
                                    // $recipient_id = $value['statuses'][0]['recipient_id'];
                                    // $id = $value['statuses'][0]['id'];
                                    // $phone_number_id = $value['metadata']['phone_number_id'];
                                    $json_data = json_encode(
                                        array(
                                            'msg_type' => $message_type,
                                            'message' => $message,
                                            'phone_number_id' => $phone_number_id,
                                            'created_at' => $timestamp
                                        )
                                    );


                                    $sql_check = "SELECT * FROM ".$result_value['username']."_messenge WHERE conversion_id = '$wa_id'";
                                    $result = $db_connection->query($sql_check);

                                    if ($result->num_rows > 0) {
                                        $existing_data = $result->fetch_assoc();
                                        $existing_messages = json_decode($existing_data['massages'], true);
                                        $existing_messages[] = json_decode($json_data, true);
                                        $updated_json_data = json_encode($existing_messages);
                                        $sql_update = "UPDATE ".$result_value['username']."_messenge SET massages = '$updated_json_data' WHERE conversion_id = '$wa_id'";
                                        $db_connection->query($sql_update);
                                    } else {
                                        $sql_insert = "INSERT INTO ".$result_value['username']."_messenge (platform, conversion_id, massages) VALUES ('$messaging_product', '$wa_id', '[$json_data]')";
                                        $db_connection->query($sql_insert);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }



    function postSocialData($url, $JsonData)
    {
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
                CURLOPT_POSTFIELDS => $JsonData,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
    $MetaUrl = 'https://graph.facebook.com/v19.0/';
    if (isset($response['entry'][0]['changes'][0]['value'])) {
        $RecievedMessageArray = $response['entry'][0]['changes'][0]['value'];
        if (isset($response['entry'][0]['changes'][0]['value']['metadata'])) {
            $metadataArray = $response['entry'][0]['changes'][0]['value']['metadata'];
            if (isset($metadataArray['display_phone_number']) && !empty($metadataArray['display_phone_number']) && isset($metadataArray['phone_number_id']) && !empty($metadataArray['phone_number_id'])) {
                $display_phone_number = $metadataArray['display_phone_number'];
                $phone_number_id = $metadataArray['phone_number_id'];
                if (isset($RecievedMessageArray['contacts'][0]['profile']['name'])) {
                    $name = $RecievedMessageArray['contacts'][0]['profile']['name'];
                    $sendercontact = "";
                    if (isset($RecievedMessageArray['contacts'][0]['wa_id'])) {
                        $sendercontact = $RecievedMessageArray['contacts'][0]['wa_id'];
                    }
                    if ($name != '' && $sendercontact != '') {
                        $sql = "SELECT * FROM master_user";
                        $result = $db_connection->query($sql);
                        $num_rows = $result->num_rows;
                        $rows = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $rows[] = $row;
                            }
                        }
                        $resultsssss = $rows;
                        if (isset($resultsssss) && !empty($resultsssss)) {
                            foreach ($resultsssss as $key => $result_value) {
                                if (isset($result_value['username']) && !empty($result_value['username'])) {
                                    $tablename = $result_value['username'] . '_platform_integration';
                                    $result = $db_connection->query("SHOW TABLES LIKE '$tablename'");
                                    $tebleexecute = $result->num_rows;
                                    if ($tebleexecute > 0) {
                                        $checkphonnoidresult = $db_connection->query("SELECT * FROM  " . $result_value['username'] . "_platform_integration WHERE phone_number_id = $phone_number_id");
                                        $checkphonnoidresultcount = $checkphonnoidresult->num_rows;
                                        if ($checkphonnoidresultcount > 0) {
                                            $checkphonnoidresultarray = $checkphonnoidresult->fetch_assoc();
                                            $conversation_account_id = $checkphonnoidresultarray['id'];
                                            $phone_number_id = $checkphonnoidresultarray['phone_number_id'];
                                            $business_account_id = $checkphonnoidresultarray['business_account_id'];
                                            $access_token = $checkphonnoidresultarray['access_token'];
                                            $BotActiveInactiveStatus = 0; // 0 - Inactive And 1 - Active
                                            $SocialAccountRecordStatus = 0; // 0-No Social Accounts And  1- Already Social Account
                                            if (isset($checkphonnoidresultarray['bot_status']) && $checkphonnoidresultarray['bot_status'] == '1' && isset($checkphonnoidresultarray['bot_id']) && intval($checkphonnoidresultarray['bot_id']) > 0) {
                                                $MainBotData = $db_connection->query("SELECT * FROM `".$result_value['username']."_bot` WHERE id = ".$checkphonnoidresultarray['bot_id']." AND active = 1 ;");
                                                $MainBotDataRow = $MainBotData->num_rows;
                                                if(isset($MainBotDataRow) && intval($MainBotDataRow) > 0){
                                                    $BotData = $db_connection->query("SELECT * FROM `" . $result_value['username'] . "_bot_setup` WHERE bot_id = " . $checkphonnoidresultarray['bot_id'] . ";");
                                                    $BotDataRow = $BotData->num_rows;
                                                    if (isset($BotDataRow) && intval($BotDataRow) > 0) {
                                                        $SocialAccountData = $db_connection->query("SELECT * FROM " . $result_value['username'] . "_platform_assets WHERE contact_no = '" . $sendercontact . "' AND conversation_account_id = '" . $conversation_account_id . "'");
                                                        if (isset($SocialAccountData) && !empty($SocialAccountData)) {
                                                            $SocialAccountDataCount = $SocialAccountData->num_rows;
                                                            $SocialAccountDataCountArray = $SocialAccountData->fetch_assoc();
                                                            if (intval($SocialAccountDataCount) > 0 && isset($SocialAccountDataCountArray) && !empty($SocialAccountDataCountArray)) {
                                                                $SocialAccountRecordStatus = 1;
                                                                if (isset($SocialAccountDataCountArray['boatstatus']) && $SocialAccountDataCountArray['boatstatus'] == '1') {
                                                                    $BotActiveInactiveStatus = 1;
                                                                }
                                                            } else {
                                                                $BotActiveInactiveStatus = 1;
                                                            }
                                                        } else {
                                                            $BotActiveInactiveStatus = 1;
                                                        }
                                                    }
                                                }
                                            }
                                            if ($BotActiveInactiveStatus == '1') { //  1 - Active
                                                $QuestionAstSequence = 1; // 1 - First Bot Question AnD 2- Continue Bot Questions with validation
                                                $QuestionValidation = 0; // 0 - Next Msg Fire AND 1 - Validation Msg Fire
                                                $QuestionType = '';
                                                $QuestionName = '';
                                                $NextQuestionId = '';
                                                $menu_message = '';
                                                $error_text = '';
                                                writeToFile('Dishant Testinf 1');

                                                if (isset($RecievedMessageArray['messages'][0]['type'])) {
                                                    $responsemessage_type = $RecievedMessageArray['messages'][0]['type'];
                                                    if ($responsemessage_type == 'text') {
                                                            if (isset($RecievedMessageArray['messages'][0]['context'])) {
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `replay_message_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '2','2', '" . json_encode($RecievedMessageArray['messages'][0]['text']) . "', '" . $RecievedMessageArray['messages'][0]['context']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            } else {
                                                                $jsonString = json_encode($RecievedMessageArray['messages'][0]['text']);
                                                                $escapedJsonString = addslashes($jsonString);
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','2', '" . $escapedJsonString . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_notify_message`(`message`,`status`) VALUES ('" . $RecievedMessageArray['messages'][0]['text']['body'] . "','1')");
                                                            }
                                                    } elseif ($responsemessage_type == 'interactive') {
                                                        if($RecievedMessageArray['messages'][0]['interactive']['list_reply']){
                                                            if (isset($RecievedMessageArray['messages'][0]['context']) && isset($RecievedMessageArray['messages'][0]['interactive']['list_reply']['title']) && isset($RecievedMessageArray['messages'][0]['interactive']['type']) && $RecievedMessageArray['messages'][0]['interactive']['type'] == "list_reply") {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `replay_message_id`, `timestamp`, `assest_id`, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '11','2', '" . json_encode($RecievedMessageArray['messages'][0]['interactive']['list_reply']['title']) . "', '" . $RecievedMessageArray['messages'][0]['context']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '" . $RecievedMessageArray['messages'][0]['interactive']['list_reply']['id'] . "', '1')");
                                                            }
                                                        }
                                                        if($RecievedMessageArray['messages'][0]['interactive']['button_reply']){
                                                            if (isset($RecievedMessageArray['messages'][0]['context']) && isset($RecievedMessageArray['messages'][0]['interactive']['button_reply']['title']) && isset($RecievedMessageArray['messages'][0]['interactive']['type']) && $RecievedMessageArray['messages'][0]['interactive']['type'] == "button_reply") {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `replay_message_id`, `timestamp`, `assest_id`, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '11','2', '" . json_encode($RecievedMessageArray['messages'][0]['interactive']['button_reply']['title']) . "', '" . $RecievedMessageArray['messages'][0]['context']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '" . $RecievedMessageArray['messages'][0]['interactive']['button_reply']['id'] . "', '1')");
                                                            }
                                                        }
                                                    } elseif ($responsemessage_type == 'image') {
                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '3','2', '" . $RecievedMessageArray['messages'][0]['image']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['image']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['image']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '1')");
                                                    } elseif ($responsemessage_type == 'video') {
                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '3','2', '" . $RecievedMessageArray['messages'][0]['video']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['video']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['video']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '1')");
                                                    } elseif ($responsemessage_type == 'document') {
                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `asset_file_name`, `timestamp`, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '4','2', '" . $RecievedMessageArray['messages'][0]['document']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['document']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['document']['id'] . "', '" . $RecievedMessageArray['messages'][0]['document']['filename'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '1')");
                                                    } elseif ($responsemessage_type == 'contacts') {
                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assest_id`, `asset_file_name`, `timestamp`, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '5','2', '" . $RecievedMessageArray['messages'][0]['contacts'][0]['phones'][0]['phone'] . "', '" . $RecievedMessageArray['messages'][0]['contacts'][0]['name']['formatted_name'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '1')");
                                                    } elseif ($responsemessage_type == 'audio') {
                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '6','2', '" . $RecievedMessageArray['messages'][0]['audio']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['audio']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['audio']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '1')");
                                                    } elseif ($responsemessage_type == 'location') {
                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `timestamp`, latitude, longitude, `msg_read_status`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '7','2', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '" . $RecievedMessageArray['messages'][0]['location']['latitude'] . "', '" . $RecievedMessageArray['messages'][0]['location']['longitude'] . "', '1')");
                                                    }
                                                }
                                                if ($SocialAccountRecordStatus == '0') { // 1- New Social Account Create || No social account
                                                    $FirstRecordBotData = $db_connection->query("SELECT * FROM `" . $result_value['username'] . "_bot_setup` WHERE bot_id = " . $checkphonnoidresultarray['bot_id'] . " AND sequence = 1;");
                                                    $FirstRecordBotDataRow = $FirstRecordBotData->num_rows;
                                                    $FirstRecordBotDataRowArray = $FirstRecordBotData->fetch_assoc();
                                                    if (intval($FirstRecordBotDataRow) > 0 && isset($FirstRecordBotDataRowArray) && !empty($FirstRecordBotDataRowArray)) {
                                                        $QuestionType = $FirstRecordBotDataRowArray['type_of_question'];
                                                        $QuestionName = $FirstRecordBotDataRowArray['question'];
                                                        $NextQuestionId = $FirstRecordBotDataRowArray['next_questions'];
                                                        $menu_message = $FirstRecordBotDataRowArray['menu_message'];
                                                        $error_text = $FirstRecordBotDataRowArray['error_text'];
                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_platform_assets`(`platform_status`, `conversation_account_id`, `whatsapp_name`, `contact_no`, `phone_number_id`, `account_phone_no`, `boat_question_id`, `boatstatus`, `platform_id`, `master_id`, `asset_type`) VALUES ('1','" . $conversation_account_id . "','" . $name . "','" . $sendercontact . "','" . $phone_number_id . "','" . $display_phone_number . "', '" . $FirstRecordBotDataRowArray['id'] . "', '1', '".$conversation_account_id."', '1', 'contact')");
                                                        $QuestionAstSequence = 1;
                                                    }
                                                } elseif ($SocialAccountRecordStatus == '1') { // 1- Already Social Account
                                                    if (isset($SocialAccountDataCountArray['boat_question_id'])) {
                                                        $BotQuestionData = $db_connection->query("SELECT * FROM `" . $result_value['username'] . "_bot_setup` WHERE id = " . $SocialAccountDataCountArray['boat_question_id'] . ";");
                                                        $BotQuestionDataRow = $BotQuestionData->num_rows;
                                                        $BotQuestionDataArray = $BotQuestionData->fetch_assoc();
                                                        if (intval($BotQuestionDataRow) > 0 && isset($BotQuestionDataArray) && !empty($BotQuestionDataArray)) {
                                                            $QuestionAstSequence = 2;
                                                            $QuestionType = $BotQuestionDataArray['type_of_question'];
                                                            $QuestionName = $BotQuestionDataArray['question'];
                                                            $NextQuestionId = $BotQuestionDataArray['next_questions'];
                                                            $menu_message = $BotQuestionDataArray['menu_message'];
                                                            $error_text = $BotQuestionDataArray['error_text'];
                                                        }
                                                    }
                                                }
                                                if ($QuestionType != '' && $QuestionName != '') { //  1 - Means Same Question AND 0 - Means Next Question
                                                    if (isset($RecievedMessageArray['messages'][0]['id'])) {
                                                        $url1 = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                        $JsonDataString1 = '
                                                            {
                                                            "messaging_product": "whatsapp",
                                                            "status": "read",
                                                            "message_id": "' . $RecievedMessageArray['messages'][0]['id'] . '"
                                                        }
                                                        ';
                                                        postSocialData($url1, $JsonDataString1);
                                                    }
                                                    if ($QuestionAstSequence == '1') {
                                                        $QuestionValidation = 1; // Same Question
                                                    } else {
                                                        if ($QuestionType == '1' || $QuestionType == '10' || $QuestionType == '22' || $QuestionType == '23' || $QuestionType == '4' ||  $QuestionType == '44' ) {
                                                            $QuestionValidation = 0;
                                                        } elseif ($QuestionType == '5') {
                                                            if (isset($RecievedMessageArray['messages'][0]['text']['body'])) {
                                                                $phoneNumber = preg_replace('/[^0-9]/', '', $RecievedMessageArray['messages'][0]['text']['body']);
                                                            } else {
                                                                $phoneNumber = '';
                                                            }
                                                            if (is_numeric($phoneNumber) && (strlen($phoneNumber) >= 10 && strlen($phoneNumber) <= 15)) {
                                                                $QuestionValidation = 0;
                                                            } else {
                                                                $QuestionValidation = 1;
                                                            }
                                                        } elseif ($QuestionType == '3') {
                                                            if (filter_var($RecievedMessageArray['messages'][0]['text']['body'], FILTER_VALIDATE_EMAIL)) {
                                                                $QuestionValidation = 0;
                                                            } else {
                                                                $QuestionValidation = 1;
                                                            }
                                                        } elseif ($QuestionType == '2' || $QuestionType == '40') {
                                                            $SingleChoiseMsgID = 0;
                                                            if($RecievedMessageArray['messages'][0]['interactive']['list_reply']['title']){
                                                                $jsonDDSelectionData = json_decode($menu_message, true);
                                                                foreach ($jsonDDSelectionData['single_choice_option_value'] as $item) {
                                                                    $optionValue = $item['option'];
                                                                    $subFlowValue = $item['sub_flow'];
                                                                    $jumpQuestionValue = $item['jump_question'];
                                                                    if($optionValue == $RecievedMessageArray['messages'][0]['interactive']['list_reply']['title']){
                                                                        $QuestionValidation = 0;
                                                                        $SingleChoiseMsgID = $item['jump_question'];
                                                                    }
                                                                }
                                                            }
                                                        } elseif ($QuestionType == '6') {
                                                            if (is_numeric($RecievedMessageArray['messages'][0]['text']['body'])) {
                                                                $QuestionValidation = 0;
                                                            } else {
                                                                $QuestionValidation = 1;
                                                            }
                                                        } elseif ($QuestionType == '8') {
                                                            $QuestionValidation = 1;
                                                            $datadates = json_decode($menu_message, true);
                                                            $dateRangeValues = $datadates['date_range'];
                                                            $dateFormate = strtoupper($datadates['date_output_format']);
                                                            $dcount = 0;
                                                            $startdate = '';
                                                            $enddate = '';
                                                            foreach ($dateRangeValues as $date) {
                                                                $dcount++;
                                                                if ($dcount == '1') {
                                                                    $startdate = $date;
                                                                    $startdate = (new \DateTime($startdate))->format('d-m-Y');
                                                                } elseif ($dcount == '2') {
                                                                    $enddate = $date;
                                                                    $enddate = (new \DateTime($enddate))->format('d-m-Y');
                                                                }
                                                            }
                                                            $validformate = 0;
                                                            try {
                                                                $dateObject = new \DateTime($RecievedMessageArray['messages'][0]['text']['body']);
                                                                $validformate = 1;
                                                            }catch (\Exception $e) {
                                                                echo "Error: " . $e->getMessage();
                                                            }
                                                            if($validformate == '1' && $startdate !== ''){
                                                                $dateToCheck = new \DateTime($RecievedMessageArray['messages'][0]['text']['body']);
                                                                $startDate = new \DateTime($startdate);
                                                                if($enddate != ''){
                                                                    $endDate = new \DateTime($enddate);
                                                                    if ($dateToCheck >= $startDate && $dateToCheck <= $endDate) {
                                                                        $QuestionValidation = 0;
                                                                    } 
                                                                }else{
                                                                    if ($dateToCheck >= $startDate) {
                                                                        $QuestionValidation = 0;
                                                                    }
                                                                }
                                                            }
                                                        }elseif ($QuestionType == '11'){
                                                            $QuestionValidation = 1;
                                                            if (is_numeric($RecievedMessageArray['messages'][0]['text']['body'])) {
                                                                $minmaxdata = json_decode($menu_message, true);
                                                                $maxval = $minmaxdata['max'];
                                                                $minval = $minmaxdata['min'];
                                                                if (intval($maxval) >= intval($RecievedMessageArray['messages'][0]['text']['body']) && intval($minval) <= intval($RecievedMessageArray['messages'][0]['text']['body'])) {
                                                                    $QuestionValidation = 0;
                                                                } elseif (intval($maxval) >= intval($RecievedMessageArray['messages'][0]['text']['body'])) {
                                                                    $QuestionValidation = 0;
                                                                }elseif(intval($minval) <= intval($RecievedMessageArray['messages'][0]['text']['body'])){
                                                                    $QuestionValidation = 0;
                                                                }
                                                            }
                                                        }elseif($QuestionType == '13'){
                                                            $QuestionValidation = 1;
                                                            if (filter_var($RecievedMessageArray['messages'][0]['text']['body'], FILTER_VALIDATE_URL)) {
                                                                $QuestionValidation = 0;
                                                            }
                                                        }elseif($QuestionType == '42'){
                                                            $QuestionValidation = 1;
                                                            $ButtonChoiseMsgID = 0;
                                                            if($RecievedMessageArray['messages'][0]['interactive']['button_reply']['title']){
                                                                $jsonButtonData = json_decode($menu_message, true);
                                                                foreach ($jsonButtonData['single_choice_option_value'] as $item) {
                                                                    $optionValue = $item['option'];
                                                                    $subFlowValue = $item['sub_flow'];
                                                                    $jumpQuestionValue = $item['jump_question'];
                                                                    if($optionValue == $RecievedMessageArray['messages'][0]['interactive']['button_reply']['title']){
                                                                        $QuestionValidation = 0;
                                                                        $ButtonChoiseMsgID = $item['jump_question'];

                                                                    }
                                                                }
                                                            }
                                                        }elseif($QuestionType == '9'){
                                                            $QuestionValidation = 1;
                                                            $parsed_data = json_decode($menu_message, true);
                                                            $options_str = $parsed_data["options"];
                                                            $time_values = explode(';', $options_str);
                                                            $count  = 0;
                                                            foreach ($time_values as $time_value) {
                                                                $count ++ ;
                                                                if($count == $RecievedMessageArray['messages'][0]['text']['body']){
                                                                    $QuestionValidation = 0;
                                                                }
                                                            }
                                                        }
                                                    } 

                                                    if ($QuestionValidation == '0') {
                                                        if (intval($NextQuestionId) > 0) {
                                                            if (isset($RecievedMessageArray['messages'][0]['interactive']['list_reply']['id']) && isset($SingleChoiseMsgID)) {
                                                                $NextQuestionId = $SingleChoiseMsgID;
                                                            }
                                                            if (isset($RecievedMessageArray['messages'][0]['interactive']['button_reply']['id']) && isset($ButtonChoiseMsgID)) {
                                                                $NextQuestionId = $ButtonChoiseMsgID;
                                                            }
                                                            $BotNextQuestionData = $db_connection->query("SELECT * FROM `" . $result_value['username'] . "_bot_setup` WHERE id = " . $NextQuestionId . ";");
                                                            $BotNextQuestionDataRow = $BotNextQuestionData->num_rows;
                                                            $BotNextQuestionDataArray = $BotNextQuestionData->fetch_assoc();
                                                            if (intval($BotNextQuestionDataRow) > 0 && isset($BotNextQuestionDataArray) && !empty($BotNextQuestionDataArray)) {
                                                                $NextQuestionType = $BotNextQuestionDataArray['type_of_question'];
                                                                if ($NextQuestionType == '1' || $NextQuestionType == '5' || $NextQuestionType == '3' || $NextQuestionType == '10' || $NextQuestionType == '22' || $NextQuestionType == '6' || $NextQuestionType == '13' || $NextQuestionType == '44') {
                                                                    $textOfbody = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $JsonDataStringBoat = '{
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "' . $sendercontact . '",
                                                                        "type": "text",
                                                                        "text": { 
                                                                        "preview_url": false,
                                                                        "body": "' . strip_tags($BotNextQuestionDataArray['question']) . '"
                                                                        }
                                                                    }';
                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    $jsonmsg = '{"body":' . json_encode($textOfbody) . '}';
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                                    }


                                                                    

                                                                }elseif ( $NextQuestionType == '2' || $NextQuestionType == '40') {
                                                                    $jsonDDSelectionData = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    $arraydatas = '';
                                                                    foreach ($jsonDDSelectionData['single_choice_option_value'] as $item) {
                                                                        $alphabets = 'abcdefghijklmnopqrstuvwxyz';
                                                                        $shuffledAlphabets = str_shuffle($alphabets);
                                                                        $randomString = substr($shuffledAlphabets, 0, 4);
                                                                        $optionValue = $item['option'];
                                                                        $subFlowValue = $item['sub_flow'];
                                                                        $jumpQuestionValue = $item['jump_question'];
                                                                        $arraydatas .= '
                                                                                        {
                                                                                            "id": "' . $randomString . '",
                                                                                            "title": "' . $optionValue . '",
                                                                                            "description": ""
                                                                                        },
                                                                        ';
                                                                    }
                                                                    $jsoneString = '
                                                                        {
                                                                            "messaging_product": "whatsapp",
                                                                            "recipient_type": "individual",
                                                                            "to": "' . $sendercontact . '",
                                                                            "type": "interactive",
                                                                            "interactive": {
                                                                            "type": "list",
                                                                            "body": {
                                                                                "text": "' . strip_tags($BotNextQuestionDataArray['question']) . '"
                                                                            },
                                                                            "action": {
                                                                                "button": "Select",
                                                                                "sections": [
                                                                                    {
                                                                                        "title": "Select Product",
                                                                                        "rows": [
                                                                                                    ' . $arraydatas . '
                                                                                        ]
                                                                                    },
                                                                                ]
                                                                            }
                                                                            }
                                                                        }
                                                                    ';
                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $jsoneString);
                                                                    $ReturnResult = $Result;
                                                                    $jsonmsg = '{"body":' . json_encode(strip_tags($BotNextQuestionDataArray['question'])) . '}';
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `assest_id`, `asset_file_name`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '8','1', '" . $jsonmsg . "', '" . $BotNextQuestionDataArray['menu_message'] . "', '".$jsoneString."')");
                                                                    }
                                                                } elseif ($NextQuestionType == '8') {
                                                                    $textOfbody = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $textOfbody2 = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $datadates = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    $dateRangeValues = $datadates['date_range'];
                                                                    $dcount = 0;
                                                                    $startdate = '';
                                                                    $enddate = 'to till';
                                                                    foreach ($dateRangeValues as $date) {
                                                                        $dcount++;
                                                                        if ($dcount == '1') {
                                                                            $startdate = $date;
                                                                        } elseif ($dcount == '2') {
                                                                            $enddate = $date;
                                                                        }
                                                                    } 
                                                                    if ($enddate != '') {
                                                                        $textOfbody .= 'Please Enter the date between ' . (new \DateTime($startdate))->format('d-m-Y') . ' and ' . (new \DateTime($enddate))->format('d-m-Y') . ' in *' . strtoupper($datadates['date_output_format']) . '* formate.';
                                                                        $textOfbody2 .= 'Please Enter the date between ' . (new \DateTime($startdate))->format('d-m-Y') . ' and ' . (new \DateTime($enddate))->format('d-m-Y') . ' in ' . strtoupper($datadates['date_output_format']) . ' formate.';
                                                                    } elseif ($startdate) {
                                                                        $textOfbody .= 'Please enter a date on or after ' . (new \DateTime($startdate))->format('d-m-Y') . ' in *' . strtoupper($datadates['date_output_format']) . '* formate.';
                                                                        $textOfbody2 .= 'Please enter a date on or after ' . (new \DateTime($startdate))->format('d-m-Y') . ' in ' . strtoupper($datadates['date_output_format']) . ' formate.';
                                                                    }
                                                                    $JsonDataStringBoat = '{
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "' . $sendercontact . '",
                                                                        "type": "text",
                                                                        "text": { 
                                                                        "preview_url": false,
                                                                        "body": "' . $textOfbody . '"
                                                                        }
                                                                    }';
                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    $jsonmsg = '{"body":' . json_encode($textOfbody2) . '}';
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                                    }
                                                                }elseif ($NextQuestionType == '11') {
                                                                    $textOfbody = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $textOfbody2 = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $minmaxdata = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    $maxval = $minmaxdata['max'];
                                                                    $minval = $minmaxdata['min'];
                                                                    if ($maxval != '' && $minval != '') {
                                                                        $textOfbody .= 'Please select a range between *'.$minval.' and '.$maxval.'*';
                                                                        $textOfbody2 .= 'Please select a range between '.$minval.' and '.$maxval.'';
                                                                    } elseif ($maxval != '') {
                                                                        $textOfbody .= 'Please exclude values within the range up to *'.$maxval.'*.';
                                                                        $textOfbody .= 'Please exclude values within the range up to '.$maxval.'.';
                                                                    }elseif($minval != ''){
                                                                        $textOfbody .= 'Please select a range up to *'.$minval.'*.';
                                                                        $textOfbody2 .= 'Please select a range up to '.$minval.'.';
                                                                    }
                                                                    $JsonDataStringBoat = '{
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "' . $sendercontact . '",
                                                                        "type": "text",
                                                                        "text": { 
                                                                        "preview_url": false,
                                                                        "body": "' . $textOfbody . '"
                                                                        }
                                                                    }';
                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    $jsonmsg = '{"body":' . json_encode($textOfbody2) . '}';
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                                    }
                                                                }elseif($NextQuestionType == '23'){
                                                                    $dataArray = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    $textOfbody = strip_tags($BotNextQuestionDataArray['question']);
                                                                    if (!empty($dataArray)) {
                                                                        foreach ($dataArray as $item) {
                                                                            $urlNavigatorSelect = $item['url_navigator_select'];
                                                                            $urlText = $item['url_text'];
                                                                            $urlLink = $item['url_link'];
                                                                            $textOfbody .= ''.$item["url_text"].' : '.$item["url_link"].'';
                                                                        }
                                                                    }
                                                                    $JsonDataStringBoat = '{
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "' . $sendercontact . '",
                                                                        "type": "text",
                                                                        "text": { 
                                                                        "preview_url": false,
                                                                        "body": "' . $textOfbody . '"
                                                                        }
                                                                    }';
                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    $jsonmsg = '{"body":' . json_encode($textOfbody) . '}';
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                                    }
                                                                }elseif($NextQuestionType == '26'){
                                                                    $dataArray = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    if ($dataArray && !empty($dataArray['audioFileName'])) {
                                                                        $audioFileName = $dataArray['audioFileName'];
                                                                        $baseaudiopath = base_url().'assets/bot_audio/'.$dataArray['audioFileName'];
                                                                        $jsoneString = '
                                                                        {
                                                                            "messaging_product": "whatsapp",
                                                                            "recipient_type": "individual",
                                                                            "to": "'.$sendercontact.'",
                                                                            "type": "audio",
                                                                            "audio": {
                                                                                "link": "'.$baseaudiopath.'"
                                                                            }
                                                                        }
                                                                        ';
                                                                        $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                        $Result = postSocialData($url, $JsonDataStringBoat);
                                                                        $ReturnResult = $Result;
                                                                        if (isset($ReturnResult['messages'][0]['id'])) {
                                                                            $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `asset_file_name` ) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '6','1', '".$dataArray['audioFileName']."')");
                                                                        }
                                                                    }
                                                                }elseif ($NextQuestionType == '42') {
                                                                    $buttondata = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    $textOfbody = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $JsonDataStringBoat = '
                                                                    {
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "'.$sendercontact.'",
                                                                        "type": "interactive",
                                                                        "interactive": {
                                                                            "type": "button",
                                                                            "body": {
                                                                            "text": "'.$textOfbody.'"
                                                                            },
                                                                            "action": {
                                                                            "buttons": [';
                                                                    foreach ($buttondata['single_choice_option_value'] as $item) {
                                                                        $alphabets = 'abcdefghijklmnopqrstuvwxyz';
                                                                        $shuffledAlphabets = str_shuffle($alphabets);
                                                                        $randomString = substr($shuffledAlphabets, 0, 4);
                                                                        $JsonDataStringBoat .= '{
                                                                                            "type": "reply",
                                                                                            "reply": {
                                                                                            "id": "' . $randomString . '",
                                                                                            "title": "' . $item['option'] . '"
                                                                                            }
                                                                                        },';
                                                                    }
                                                                    $JsonDataStringBoat .= '
                                                                                    ]
                                                                                }
                                                                                }
                                                                            }';

                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `asset_file_name`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '9','1', '".$textOfbody."', '".$JsonDataStringBoat."')");
                                                                    }
                                                                }elseif($NextQuestionType == '9'){
                                                                    $textOfbody = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $textOfbody1 = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $parsed_data = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    $options_str = $parsed_data["options"];
                                                                    $time_values = explode(';', $options_str);
                                                                    $count  = 0;
                                                                    foreach ($time_values as $time_value) {
                                                                        $count ++ ;
                                                                        $textOfbody .= '*'.$count.'.* '.$time_value.' ';
                                                                        $textOfbody1 .= ''.$count.'. '.$time_value.' ';
                                                                    }

                                                                    $JsonDataStringBoat = '{
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "' . $sendercontact . '",
                                                                        "type": "text",
                                                                        "text": { 
                                                                        "preview_url": false,
                                                                        "body": "' . $textOfbody . '"
                                                                        }
                                                                    }';
                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    $jsonmsg = '{"body":' . json_encode($textOfbody1) . '}';
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                                    }
                                                                }elseif($NextQuestionType == '4'){
                                                                    $textOfbody = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $textOfbody1 = strip_tags($BotNextQuestionDataArray['question']);
                                                                    $jsonDDSelectionData = json_decode($BotNextQuestionDataArray['menu_message'], true);
                                                                    $optionsArray = explode(';', $jsonDDSelectionData['options']);
                                                                    $CountsMultipleSelection = 0;
                                                                    foreach ($optionsArray as $option) {
                                                                        $CountsMultipleSelection ++ ;
                                                                        $textOfbody .= ' *'.$CountsMultipleSelection.'.* '.$option.'  ';
                                                                        $textOfbody1 .= ' '.$CountsMultipleSelection.'. '.$option.' ';
                                                                    }
                                                                    $textOfbody .= 'Just let me know the number corresponding to your choice! ';
                                                                    $textOfbody1 .= 'Just let me know the number corresponding to your choice! ';
                                                                    $JsonDataStringBoat = '{
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "' . $sendercontact . '",
                                                                        "type": "text",
                                                                        "text": { 
                                                                        "preview_url": false,
                                                                        "body": "' . $textOfbody . '"
                                                                        }
                                                                    }';
                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    $jsonmsg = '{"body":' . json_encode($textOfbody1) . '}';
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                                    }
                                                                } 
                                                                
                                                                // else if ($QuestionType == '42') {
                                                                //     // here 
                                                                //     if (isset($RecievedMessageArray['messages'][0]['id'])) {
                                                                //         $jsonData = json_decode($menu_message, true);
                                                                //         $test = $jsonData['options_value']['options'];
                                                                //         $parts = explode(";", $test);
                                                                //         // pre($parts);
                                                                //         $JsonDataStringBoat = '
                                                                //             {
                                                                //                 "messaging_product": "whatsapp",
                                                                //                 "recipient_type": "individual",
                                                                //                 "to": "' . $sendercontact . '",
                                                                //                 "type": "interactive",
                                                                //                 "interactive": {
                                                                //                   "type": "button",
                                                                //                   "body": {
                                                                //                     "text": "BUTTON_TEXT"
                                                                //                   },
                                                                //                   "action": {
                                                                //                     "buttons": [';
                                                                //         foreach ($parts as $key => $part) {
                                                                //             $JsonDataStringBoat .= '{
                                                                //                       "type": "reply",
                                                                //                       "reply": {
                                                                //                         "id": "' . $key . '",
                                                                //                         "title": "' . $part . '"
                                                                //                       }
                                                                //                     },';
                                                                //         }
                                                                //         $JsonDataStringBoat .= '
                                                                //                   ]
                                                                //                 }
                                                                //               }
                                                                //             }';
                                                                //         $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                //         $Result = postSocialData($url, $JsonDataStringBoat);
                                                                //         // new
                                                                //         if (isset($response['entry'][0]['changes'][0]['value']['messages'][0]['interactive']['button_reply'])) {
                                                                //             $QuestionValidation = 0;
                                                                //         } else {
                                                                //             $QuestionValidation = 1;
                                                                //         }
                                                                //         // pre($QuestionValidation);
                                                                //         // pre($Result);
                                                                //         // pre(filter_var($RecievedMessageArray));
                                                                //     }
                                                                //     // die();
                                                                // }
                                                                $db_connection->query("UPDATE `" . $result_value['username'] . "_platform_assets` SET `whatsapp_name`='" . $name . "', `boat_question_id` = '" . $BotNextQuestionDataArray['id'] . "' WHERE id = " . $SocialAccountDataCountArray['id'] . "");

                                                                if($NextQuestionType == '22'){

                                                                    $QuestionValidation = 1;
                                                                    $QuestionAstSequence = 1;
                                                                    $QuestionType = '';
                                                                    $QuestionName = '';
                                                                    $NextQuestionId = '';
                                                                    $menu_message = ''; 
                                                                    $error_text = '';
                                                                    if (isset($BotNextQuestionDataArray['next_questions'])) {
                                                                        $BotQuestionData = $db_connection->query("SELECT * FROM `" . $result_value['username'] . "_bot_setup` WHERE id = " . $BotNextQuestionDataArray['next_questions'] . ";");
                                                                        $BotQuestionDataRow = $BotQuestionData->num_rows;
                                                                        $BotQuestionDataArray = $BotQuestionData->fetch_assoc();
                                                                        if (intval($BotQuestionDataRow) > 0 && isset($BotQuestionDataArray) && !empty($BotQuestionDataArray)) {
                                                                            $QuestionAstSequence = 1;
                                                                            $QuestionType = $BotQuestionDataArray['type_of_question'];
                                                                            $QuestionName = $BotQuestionDataArray['question'];
                                                                            $NextQuestionId = $BotQuestionDataArray['next_questions'];
                                                                            $menu_message = $BotQuestionDataArray['menu_message'];
                                                                            $error_text = $BotQuestionDataArray['error_text'];
                                                                            $db_connection->query("UPDATE `" . $result_value['username'] . "_platform_assets` SET `whatsapp_name`='" . $name . "', `boat_question_id` = '" . $BotQuestionDataArray['id'] . "' WHERE id = " . $SocialAccountDataCountArray['id'] . "");
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }


                                                    if ($QuestionValidation == '1') {
                                                        $final_error_text = $error_text;
                                                        if ($QuestionAstSequence == '1') {
                                                            $final_error_text = $QuestionName;
                                                        }

                                                        if($QuestionType == '22'){
                                                            $JsonDataStringBoat = '{
                                                                "messaging_product": "whatsapp",
                                                                "recipient_type": "individual",
                                                                "to": "' . $sendercontact . '",
                                                                "type": "text",
                                                                "text": { 
                                                                "preview_url": false,
                                                                "body": "' . strip_tags($final_error_text) . '"
                                                                }
                                                            }';
                                                            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                            $Result = postSocialData($url, $JsonDataStringBoat);
                                                            $ReturnResult = $Result;
                                                            $jsonmsg = '{"body":' . json_encode(strip_tags($final_error_text)) . '}';
                                                            if (isset($ReturnResult['messages'][0]['id'])) {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                            }
                                                            
                                                            if (isset($NextQuestionId) && $NextQuestionId != '') {
                                                                $QuestionType = '';
                                                            $QuestionName = '';
                                                            $NextQuestionId = '';
                                                            $menu_message = ''; 
                                                            $error_text = '';
                                                                $BotQuestionData = $db_connection->query("SELECT * FROM `" . $result_value['username'] . "_bot_setup` WHERE id = " . $NextQuestionId . ";");
                                                                $BotQuestionDataRow = $BotQuestionData->num_rows;
                                                                $BotQuestionDataArray = $BotQuestionData->fetch_assoc();

                                                                if (intval($BotQuestionDataRow) > 0 && isset($BotQuestionDataArray) && !empty($BotQuestionDataArray)) {
                                                                    $QuestionAstSequence = 1;
                                                                    $QuestionType = $BotQuestionDataArray['type_of_question'];
                                                                    $QuestionName = $BotQuestionDataArray['question'];
                                                                    $NextQuestionId = $BotQuestionDataArray['next_questions'];
                                                                    $menu_message = $BotQuestionDataArray['menu_message'];
                                                                    $error_text = $BotQuestionDataArray['error_text'];
                                                                    $db_connection->query("UPDATE `" . $result_value['username'] . "_platform_assets` SET `whatsapp_name`='" . $name . "', `boat_question_id` = '" . $BotQuestionDataArray['id'] . "' WHERE id = " . $SocialAccountDataCountArray['id'] . "");
                                                                }
                                                            }
                                                        }

                                                        if ($QuestionType == '1' || $QuestionType == '5' || $QuestionType == '3' || $QuestionType == '10' || $QuestionType == '22' || $QuestionType == '6' ||$QuestionType == '13' || $QuestionType == '44' ) {
                                                            $JsonDataStringBoat = '{
                                                                "messaging_product": "whatsapp",
                                                                "recipient_type": "individual",
                                                                "to": "' . $sendercontact . '",
                                                                "type": "text",
                                                                "text": { 
                                                                "preview_url": false,
                                                                "body": "' . strip_tags($final_error_text) . '"
                                                                }
                                                            }';
                                                            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                            $Result = postSocialData($url, $JsonDataStringBoat);
                                                            $ReturnResult = $Result;
                                                            $jsonmsg = '{"body":' . json_encode(strip_tags($final_error_text)) . '}';
                                                            if (isset($ReturnResult['messages'][0]['id'])) {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                            }
                                                        } elseif ( $QuestionType == '2' || $QuestionType == '40' ) {
                                                            $arraydatas = '';
                                                            $jsonDDSelectionData = json_decode($menu_message, true);
                                                            foreach ($jsonDDSelectionData['single_choice_option_value'] as $item) {
                                                                $alphabets = 'abcdefghijklmnopqrstuvwxyz';
                                                                $shuffledAlphabets = str_shuffle($alphabets);
                                                                $randomString = substr($shuffledAlphabets, 0, 4);
                                                                $optionValue = $item['option'];
                                                                $subFlowValue = $item['sub_flow'];
                                                                $jumpQuestionValue = $item['jump_question'];
                                                                $arraydatas .= '
                                                                                {
                                                                                    "id": "' . $randomString . '",
                                                                                    "title": "' . $optionValue . '",
                                                                                    "description": ""
                                                                                },
                                                                ';
                                                            }
                                                            $jsoneString = '
                                                                {
                                                                    "messaging_product": "whatsapp",
                                                                    "recipient_type": "individual",
                                                                    "to": "' . $sendercontact . '",
                                                                    "type": "interactive",
                                                                    "interactive": {
                                                                    "type": "list",
                                                                    "body": {
                                                                        "text": "' . strip_tags($final_error_text) . '"
                                                                    },
                                                                    "action": {
                                                                        "button": "Select",
                                                                        "sections": [
                                                                            {
                                                                                "title": "Select Product",
                                                                                "rows": [
                                                                                            ' . $arraydatas . '
                                                                                ]
                                                                            },
                                                                        ]
                                                                    }
                                                                    }
                                                                }
                                                            ';
                                                            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                            $Result = postSocialData($url, $jsoneString);
                                                            $ReturnResult = $Result;
                                                            $jsonmsg = '{"body":' . json_encode(strip_tags($final_error_text)) . '}';
                                                            if (isset($ReturnResult['messages'][0]['id'])) {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `assest_id`, `asset_file_name`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '8','1', '" . $jsonmsg . "', '" . $BotNextQuestionDataArray['menu_message'] . "', '".$jsoneString."' )");
                                                            }
                                                        } elseif ($QuestionType == '8') {
                                                            $textOfbody = strip_tags($final_error_text);
                                                            $textOfbody2 = strip_tags($final_error_text);
                                                            $datadates = json_decode($menu_message, true);
                                                            $dateRangeValues = $datadates['date_range'];
                                                            $dcount = 0;
                                                            $startdate = '';
                                                            $enddate = 'to till';
                                                            foreach ($dateRangeValues as $date) {
                                                                $dcount++;
                                                                if ($dcount == '1') {
                                                                    $startdate = $date;
                                                                } elseif ($dcount == '2') {
                                                                    $enddate = $date;
                                                                }
                                                            } 
                                                            if ($enddate != '') {
                                                                $textOfbody .= 'Please Enter the date between ' . (new \DateTime($startdate))->format('d-m-Y') . ' and ' . (new \DateTime($enddate))->format('d-m-Y') . ' in *' . strtoupper($datadates['date_output_format']) . '* formate.';
                                                                $textOfbody2 .= 'Please Enter the date between ' . (new \DateTime($startdate))->format('d-m-Y') . ' and ' . (new \DateTime($enddate))->format('d-m-Y') . ' in ' . strtoupper($datadates['date_output_format']) . ' formate.';
                                                            } elseif ($startdate) {
                                                                $textOfbody .= 'Please enter a date on or after ' . (new \DateTime($startdate))->format('d-m-Y') . ' in *' . strtoupper($datadates['date_output_format']) . '* formate.';
                                                                $textOfbody2 .= 'Please enter a date on or after ' . (new \DateTime($startdate))->format('d-m-Y') . ' in ' . strtoupper($datadates['date_output_format']) . ' formate.';
                                                            }
                                                            $JsonDataStringBoat = '{
                                                                "messaging_product": "whatsapp",
                                                                "recipient_type": "individual",
                                                                "to": "' . $sendercontact . '",
                                                                "type": "text",
                                                                "text": { 
                                                                "preview_url": false,
                                                                "body": "' . $textOfbody . '"
                                                                }
                                                            }';
                                                            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                            $Result = postSocialData($url, $JsonDataStringBoat);
                                                            $ReturnResult = $Result;
                                                            $jsonmsg = '{"body":' . json_encode($textOfbody2) . '}';
                                                            if (isset($ReturnResult['messages'][0]['id'])) {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                            }
                                                        } elseif ($QuestionType == '11') {
                                                            $textOfbody = strip_tags($final_error_text);
                                                            $textOfbody2 = strip_tags($final_error_text);
                                                            $minmaxdata = json_decode($menu_message, true);
                                                            $maxval = $minmaxdata['max'];
                                                            $minval = $minmaxdata['min'];
                                                            if ($maxval != '' && $minval != '') {
                                                                $textOfbody .= 'Please select a range between *'.$minval.' and '.$maxval.'*';
                                                                $textOfbody2 .= 'Please select a range between '.$minval.' and '.$maxval.'';
                                                            } elseif ($maxval != '') {
                                                                $textOfbody .= 'Please exclude values within the range up to *'.$maxval.'*.';
                                                                $textOfbody .= 'Please exclude values within the range up to '.$maxval.'.';
                                                            }elseif($minval != ''){
                                                                $textOfbody .= 'Please select a range up to *'.$minval.'*.';
                                                                $textOfbody2 .= 'Please select a range up to '.$minval.'.';
                                                            }
                                                            $JsonDataStringBoat = '{
                                                                "messaging_product": "whatsapp",
                                                                "recipient_type": "individual",
                                                                "to": "' . $sendercontact . '",
                                                                "type": "text",
                                                                "text": { 
                                                                "preview_url": false,
                                                                "body": "' . $textOfbody . '"
                                                                }
                                                            }';
                                                            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                            $Result = postSocialData($url, $JsonDataStringBoat);
                                                            $ReturnResult = $Result;
                                                            $jsonmsg = '{"body":' . json_encode($textOfbody2) . '}';
                                                            if (isset($ReturnResult['messages'][0]['id'])) {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                            }
                                                        }elseif($QuestionType == '26'){
                                                            $dataArray = json_decode($menu_message, true);
                                                            if ($dataArray && !empty($dataArray['audioFileName'])) {
                                                                $audioFileName = $dataArray['audioFileName'];
                                                                $baseaudiopath = base_url().'assets/bot_audio/'.$dataArray['audioFileName'];
                                                                $jsoneString = '
                                                                {
                                                                    "messaging_product": "whatsapp",
                                                                    "recipient_type": "individual",
                                                                    "to": "'.$sendercontact.'",
                                                                    "type": "audio",
                                                                    "audio": {
                                                                        "link": "'.$baseaudiopath.'"
                                                                    }
                                                                }
                                                                ';
                                                                $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                $Result = postSocialData($url, $JsonDataStringBoat);
                                                                $ReturnResult = $Result;
                                                                if (isset($ReturnResult['messages'][0]['id'])) {
                                                                    $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `asset_file_name` ) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '6','1', '".$dataArray['audioFileName']."')");
                                                                }
                                                            }
                                                        }elseif($QuestionType == '42'){
                                                                    $buttondata = json_decode($menu_message, true);
                                                                    $textOfbody = strip_tags($final_error_text);
                                                                    $JsonDataStringBoat = '
                                                                    {
                                                                        "messaging_product": "whatsapp",
                                                                        "recipient_type": "individual",
                                                                        "to": "'.$sendercontact.'",
                                                                        "type": "interactive",
                                                                        "interactive": {
                                                                            "type": "button",
                                                                            "body": {
                                                                            "text": "'.$textOfbody.'"
                                                                            },
                                                                            "action": {
                                                                            "buttons": [';
                                                    
                                                                    foreach ($buttondata['single_choice_option_value'] as $item) {
                                                                        $alphabets = 'abcdefghijklmnopqrstuvwxyz';
                                                                        $shuffledAlphabets = str_shuffle($alphabets);
                                                                        $randomString = substr($shuffledAlphabets, 0, 4);
                                                                        $JsonDataStringBoat .= '{
                                                                                            "type": "reply",
                                                                                            "reply": {
                                                                                            "id": "' . $randomString . '",
                                                                                            "title": "' . $item['option'] . '"
                                                                                            }
                                                                                        },';
                                                                    }
                                                                    $JsonDataStringBoat .= '
                                                                                    ]
                                                                                }
                                                                                }
                                                                            }';

                                                                    $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                                    $Result = postSocialData($url, $JsonDataStringBoat);
                                                                    $ReturnResult = $Result;
                                                                    if (isset($ReturnResult['messages'][0]['id'])) {
                                                                        $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `asset_file_name`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '9','1', '".$textOfbody."', '".$JsonDataStringBoat."')");
                                                                    }
                                                        }elseif($QuestionType == '9'){
                                                            $textOfbody = strip_tags($final_error_text);
                                                            $textOfbody1 = strip_tags($final_error_text);
                                                            $parsed_data = json_decode($menu_message, true);
                                                            $options_str = $parsed_data["options"];
                                                            $time_values = explode(';', $options_str);
                                                            $count  = 0;
                                                            foreach ($time_values as $time_value) {
                                                                $count ++ ;
                                                                $textOfbody .= '*'.$count.'.* '.$time_value.' ';
                                                                $textOfbody1 .= ''.$count.'. '.$time_value.' ';
                                                            }
                                                            $JsonDataStringBoat = '{
                                                                "messaging_product": "whatsapp",
                                                                "recipient_type": "individual",
                                                                "to": "' . $sendercontact . '",
                                                                "type": "text",
                                                                "text": { 
                                                                "preview_url": false,
                                                                "body": "' . $textOfbody . '"
                                                                }
                                                            }';
                                                            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                            $Result = postSocialData($url, $JsonDataStringBoat);
                                                            $ReturnResult = $Result;
                                                            $jsonmsg = '{"body":' . json_encode($textOfbody1) . '}';
                                                            if (isset($ReturnResult['messages'][0]['id'])) {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                            }
                                                        }elseif($QuestionType == '4'){
                                                            $textOfbody = strip_tags($final_error_text) .'
                                                            ';
                                                            $textOfbody1 = strip_tags($final_error_text);
                                                            $jsonDDSelectionData = json_decode($menu_message, true);
                                                            $optionsArray = explode(';', $jsonDDSelectionData['options']);
                                                            $CountsMultipleSelection = 0;
                                                            foreach ($optionsArray as $option) {
                                                                $CountsMultipleSelection ++ ;
                                                                $textOfbody .= '*'.$CountsMultipleSelection.'.* '.$option.'   ';
                                                                $textOfbody1 .= ' '.$CountsMultipleSelection.'. '.$option.' ';
                                                            }
                                                            $textOfbody .= ' Just let me know the number corresponding to your choice!';
                                                            $textOfbody1 .= 'Just let me know the number corresponding to your choice!';
                                                            $JsonDataStringBoat = '{
                                                                "messaging_product": "whatsapp",
                                                                "recipient_type": "individual",
                                                                "to": "' . $sendercontact . '",
                                                                "type": "text",
                                                                "text": { 
                                                                "preview_url": false,
                                                                "body": "' . $textOfbody . '"
                                                                }
                                                            }';
                                                            $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                            $Result = postSocialData($url, $JsonDataStringBoat);
                                                            $ReturnResult = $Result;
                                                            $jsonmsg = '{"body":' . json_encode($textOfbody1) . '}';
                                                            if (isset($ReturnResult['messages'][0]['id'])) {
                                                                $db_connection->query("INSERT INTO `" . $result_value['username'] . "_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $ReturnResult['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','1', '" . $jsonmsg . "')");
                                                            }
                                                        }


                                                        


                                                        //  else if ($QuestionType == '42') {
                                                        //     if (isset($RecievedMessageArray['messages'][0]['id'])) {
                                                        //         $jsonData = json_decode($menu_message, true);
                                                        //         $test = $jsonData['options_value']['options'];
                                                        //         $parts = explode(";", $test);
                                                        //         // pre($parts);
                                                        //         $JsonDataStringBoat = '
                                                        //             {
                                                        //                 "messaging_product": "whatsapp",
                                                        //                 "recipient_type": "individual",
                                                        //                 "to": "' . $sendercontact . '",
                                                        //                 "type": "text",
                                                        //                 "text": { 
                                                        //                 "preview_url": false,
                                                        //                 "body": "' . strip_tags($final_error_text) . '"
                                                        //                 }
                                                        //             }';

                                                        //         $url = $MetaUrl . $phone_number_id . "/messages?access_token=" . $access_token;
                                                        //         $Result = postSocialData($url, $JsonDataStringBoat);

                                                        //     }
                                                        // }
                                                    }
                                                }
                                            }
                                            if ($BotActiveInactiveStatus == '0') { // 0 - Inactive 
                                                if (isset($checkphonnoidresultarray['id'])) {
                                                    $conversation_account_id = $checkphonnoidresultarray['id'];
                                                    $checksenderinfo_result = $db_connection->query("SELECT * FROM " . $result_value['username'] . "_platform_assets WHERE contact_no = '" . $sendercontact . "' AND conversation_account_id = '" . $conversation_account_id . "'");
                                                    $checkcounts = $checksenderinfo_result->num_rows;
                                                    $checkphonostatus = 0;
                                                    if ($checkcounts == '0') {
                                                        $insertdata = $db_connection->query("INSERT INTO `" . $result_value['username'] . "_platform_assets`(`platform_status`, `conversation_account_id`, `whatsapp_name`, `contact_no`, `phone_number_id`, `account_phone_no`, `platform_id`, `master_id`, `asset_type`) VALUES ('1','" . $conversation_account_id . "','" . $name . "','" . $sendercontact . "','" . $phone_number_id . "','" . $display_phone_number . "', '".$conversation_account_id."', '1', 'contact')");
                                                        $checkphonostatus = 1;
                                                    } else {
                                                        $updatedataid = $checksenderinfo_result->fetch_assoc();
                                                        if (isset($updatedataid) && !empty($updatedataid)) {
                                                            $updateid = $updatedataid['id'];
                                                            $updatedata = $db_connection->query("UPDATE `" . $result_value['username'] . "_platform_assets` SET `whatsapp_name`='" . $name . "' `boatstatus` = '0' WHERE id = " . $updatedataid['id'] . "");
                                                            $checkphonostatus = 1;
                                                        }
                                                    }

                                                    if ($checkphonostatus == '1') {
                                                        if (isset($RecievedMessageArray['messages'][0]['type'])) {
                                                            $message_type = $RecievedMessageArray['messages'][0]['type'];
                                                            if ($message_type == 'text') {
                                                                if (isset($RecievedMessageArray['messages'][0]['context'])) {
                                                                    $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `replay_message_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '2','2', '" . json_encode($RecievedMessageArray['messages'][0]['text']) . "', '" . $RecievedMessageArray['messages'][0]['context']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                                } else {
                                                                    $jsonString = json_encode($RecievedMessageArray['messages'][0]['text']);
                                                                    $escapedJsonString = addslashes($jsonString);
                                                                    $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','2', '" . $escapedJsonString . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                                    $db_connection->query("INSERT INTO `".$result_value['username']."_notify_message`(`message`,`status`) VALUES ('" . $RecievedMessageArray['messages'][0]['text']['body'] . "','1')");
                                                                }
                                                            } elseif ($message_type == 'image') {
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '3','2', '" . $RecievedMessageArray['messages'][0]['image']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['image']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['image']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            } elseif ($message_type == 'video') {
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '3','2', '" . $RecievedMessageArray['messages'][0]['video']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['video']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['video']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            } elseif ($message_type == 'document') {
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `asset_file_name`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '4','2', '" . $RecievedMessageArray['messages'][0]['document']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['document']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['document']['id'] . "', '" . $RecievedMessageArray['messages'][0]['document']['filename'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            } elseif ($message_type == 'contacts') {
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assest_id`, `asset_file_name`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '5','2', '" . $RecievedMessageArray['messages'][0]['contacts'][0]['phones'][0]['phone'] . "', '" . $RecievedMessageArray['messages'][0]['contacts'][0]['name']['formatted_name'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            } elseif ($message_type == 'audio') {
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '6','2', '" . $RecievedMessageArray['messages'][0]['audio']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['audio']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['audio']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            } elseif ($message_type == 'location') {
                                                                $db_connection->query("INSERT INTO `".$result_value['username']."_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `timestamp`, latitude, longitude) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '7','2', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '" . $RecievedMessageArray['messages'][0]['location']['latitude'] . "', '" . $RecievedMessageArray['messages'][0]['location']['longitude'] . "')");
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    die();
}