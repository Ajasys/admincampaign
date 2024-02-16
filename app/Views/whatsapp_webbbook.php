<?php
    error_reporting(-1);
    $verifyToken = 'AWA1235454406';
    $access_token = 'your_page_access_token';

    function writeToFile($data)
    {
        $filename = 'whatsappwebhook_process_info.txt';
        $currentDateTime = date('Y-m-d H:i:s');
        $content = $currentDateTime . ': ' . $data . PHP_EOL;
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
    writeToFile(json_encode($data));
    writeToFile($input);

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
    if (isset($response['entry'][0])) {
    $WhatsAppID = '';
    $WhatsAppStatus = '';
    if (isset($response['entry'][0]['changes'][0]['value']['statuses'][0]['id'])) {
        $WhatsAppID = $response['entry'][0]['changes'][0]['value']['statuses'][0]['id'];
    }
    if (isset($response['entry'][0]['changes'][0]['value']['statuses'][0]['status'])) {
        $WhatsAppStatus = $response['entry'][0]['changes'][0]['value']['statuses'][0]['status'];
    }

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
                                            if (isset($checkphonnoidresultarray['id'])) {
                                                $conversation_account_id = $checkphonnoidresultarray['id'];
                                                $checksenderinfo_result = $db_connection->query("SELECT * FROM " . $result_value['username'] . "_social_accounts WHERE contact_no = '" . $sendercontact . "'");
                                                $checkcounts = $checksenderinfo_result->num_rows;
                                                $checkphonostatus = 0;
                                                if ($checkcounts == '0') {
                                                    $insertdata = $db_connection->query("INSERT INTO `" . $result_value['username'] . "_social_accounts`(`platform_status`, `conversation_account_id`, `whatsapp_name`, `contact_no`, `phone_number_id`, `account_phone_no`) VALUES ('1','" . $conversation_account_id . "','" . $name . "','" . $sendercontact . "','" . $phone_number_id . "','" . $display_phone_number . "')");
                                                    $checkphonostatus = 1;
                                                } else {
                                                    $updatedataid = $checksenderinfo_result->fetch_assoc();
                                                    if (isset($updatedataid) && !empty($updatedataid)) {
                                                        $updateid = $updatedataid['id'];
                                                        $updatedata = $db_connection->query("UPDATE `" . $result_value['username'] . "_social_accounts` SET `whatsapp_name`='" . $name . "' WHERE id = " . $updatedataid['id'] . "");
                                                        $checkphonostatus = 1;
                                                    }
                                                }
                                                if ($checkphonostatus == '1') {
                                                    if (isset($RecievedMessageArray['messages'][0]['type'])) {
                                                        $message_type = $RecievedMessageArray['messages'][0]['type'];
                                                        if ($message_type == 'text') {

                                                            if (isset($RecievedMessageArray['messages'][0]['context'])) {
                                                                $db_connection->query("INSERT INTO `admin_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `replay_message_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '2','2', '" . $RecievedMessageArray['messages'][0]['text']['body'] . "', '" . $RecievedMessageArray['messages'][0]['context']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            } else {
                                                                $db_connection->query("INSERT INTO `admin_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `message_contant`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '1','2', '" . $RecievedMessageArray['messages'][0]['text']['body'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                            }
                                                        } elseif ($message_type == 'image') {
                                                            $db_connection->query("INSERT INTO `admin_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '3','2', '" . $RecievedMessageArray['messages'][0]['image']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['image']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['image']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                        } elseif ($message_type == 'document') {
                                                            $db_connection->query("INSERT INTO `admin_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `asset_file_name`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '4','2', '" . $RecievedMessageArray['messages'][0]['document']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['document']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['document']['id'] . "', '" . $RecievedMessageArray['messages'][0]['document']['filename'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                        } elseif ($message_type == 'contacts') {
                                                            $db_connection->query("INSERT INTO `admin_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assest_id`, `asset_file_name`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '5','2', '" . $RecievedMessageArray['messages'][0]['contacts'][0]['phones'][0]['phone'] . "', '" . $RecievedMessageArray['messages'][0]['contacts'][0]['name']['formatted_name'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                        } elseif ($message_type == 'audio') {
                                                            $db_connection->query("INSERT INTO `admin_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `assets_type`, `sha_id`, `assest_id`, `timestamp`) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '6','2', '" . $RecievedMessageArray['messages'][0]['audio']['mime_type'] . "', '" . $RecievedMessageArray['messages'][0]['audio']['sha256'] . "', '" . $RecievedMessageArray['messages'][0]['audio']['id'] . "', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "')");
                                                        } elseif ($message_type == 'location') {
                                                            $db_connection->query("INSERT INTO `admin_messages`(`contact_no`, `platform_account_id`, `message_status`, `created_at`,`conversation_id`, `platform_status`, `sent_date_time`, `message_type`, `sent_recieved_status`, `timestamp`, latitude, longitude) VALUES ('" . $sendercontact . "', '" . $conversation_account_id . "','0', '" . gmdate('Y-m-d H:i:s') . "', '" . $RecievedMessageArray['messages'][0]['id'] . "', '1', '" . gmdate('Y-m-d H:i:s') . "', '7','2', '" . $RecievedMessageArray['messages'][0]['timestamp'] . "', '" . $RecievedMessageArray['messages'][0]['location']['latitude'] . "', '" . $RecievedMessageArray['messages'][0]['location']['longitude'] . "')");
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
                            if ($WhatsAppStatus == "delivered") {
                                $status = 1;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='1', delivertimedate = '" . gmdate('Y-m-d H:i:s') . " WHERE Whatsapp_Message_id = '" . $WhatsAppID . "''";
                            }
                            if ($WhatsAppStatus == "sent") {
                                $status = 0;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='0' WHERE Whatsapp_Message_id = '" . $WhatsAppID . "'";
                            }
                            if ($WhatsAppStatus == "failed") {
                                $status = 3;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='3' WHERE Whatsapp_Message_id = '" . $WhatsAppID . "'";
                            }
                            if ($WhatsAppStatus == "read") {
                                $status = 2;
                                $subsqls = "UPDATE `" . $tablename . "` SET `Status`='2', readtimedate = '" . gmdate('Y-m-d H:i:s') . "' WHERE Whatsapp_Message_id = '" . $WhatsAppID . "' ";
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

                                    $json_data = json_encode(array(
                                        'msg_type' => $message_type,
                                        'message' => $message,
                                        'phone_number_id' => $phone_number_id,
                                        'created_at' => $timestamp
                                    ));


                                    $sql_check = "SELECT * FROM admin_messenge WHERE conversion_id = '$wa_id'";
                                    $result = $db_connection->query($sql_check);

                                    if ($result->num_rows > 0) {
                                        $existing_data = $result->fetch_assoc();
                                        $existing_messages = json_decode($existing_data['massages'], true);
                                        $existing_messages[] = json_decode($json_data, true);
                                        $updated_json_data = json_encode($existing_messages);
                                        $sql_update = "UPDATE admin_messenge SET massages = '$updated_json_data' WHERE conversion_id = '$wa_id'";
                                        $db_connection->query($sql_update);
                                    } else {
                                        $sql_insert = "INSERT INTO admin_messenge (platform, conversion_id, massages) VALUES ('$messaging_product', '$wa_id', '[$json_data]')";
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
}
