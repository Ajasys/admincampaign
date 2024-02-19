<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use App\Curl;

class Home extends BaseController
{
    protected $db;
    public function __construct()
    {
        helper('custom');
        $db = db_connect();
        $session = \Config\Services::session();
        $this->MasterInformationModel = new MasterInformationModel($db);
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $this->get_roll_id_to_roll_duty_var = array();
        } else {
            if (isset($_SESSION['role'])) {
                $this->get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
            } else {
                $this->get_roll_id_to_roll_duty_var = array();
            }
        }
    }
    public function whatapp()
    {
        $responseArray = array();
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
                    $phoneNumber = $display_phone_number;
                    if ($display_phone_number != '' && $value['id'] != '' && $verified_name != '') {
                        $responseArray[] = array(
                            'display_phone_number' => $display_phone_number,
                            'id' => $value['id'],
                            'verified_name' => $verified_name,
                        );
                    }
                }
            }
        }


        $responseArray = json_encode($responseArray);

        $data['connections'] = $responseArray;
        $data['language_name'] = $this->MasterInformationModel->display_all_records2('master_languages');
        return view('whatapp', $data);
    }
    // ======phone-number-page======
    public function phone_number()
    {
        return view('phone_number');
    }
    public function emailsend()
    {
        return view('emailsend');
    }
    public function post_comments()
    {
        $table_username = getMasterUsername2();
        $columns_mesures = [
            'id int primary key AUTO_INCREMENT',
            'event_title varchar(500) NOT NULL',
            'event_start_date datetime',
            'event_end datetime',
            'event_address longtext',
            'attachment longtext NOT NULL',
            'coupon_event varchar(50) NOT NULL',
            'link_event varchar(50) NOT NULL',
            'terms_event varchar(50) NOT NULL',
        ];
        tableCreateAndTableUpdate2($table_username . '_create_post', '', $columns_mesures);
        return view('post_comments');
    }
    public function posts()
    {
        return view('posts');
    }

    public function whatappaakash()
    {
        $data['language_name'] = $this->MasterInformationModel->display_all_records2('master_languages');

        return view('whatappaakash', $data);
    }

    public function email_fetch()
    {
        return view('details_email_send');
    }
    public function email_track()
    {
        return view('email_track');
    }
    public function email_history_show()
    {
        return view('email_history_show');
    }
    public function add_account()
    {
        return view('add_accounts');
    }
    public function facebook_connection()
    {
        return view('facebook_connection');
    }

    public function whatapp_connection()
    {
        return view('whatapp_connection');
    }
    public function website_connection()
    {
        return view('website_connection');
    }
    public function whatsapp_connections()
    {
        return view('whatsapp_connections');
    }

    public function redirect_link()
    {
        if (get_previous_link() != 0) {
            if (isset($_SESSION['_ci_previous_url'])) {
                if ($_SESSION['_ci_previous_url'] == site_url()) {
                    $url = '/';
                } else {
                    $url = substr(strrchr(rtrim($_SESSION['_ci_previous_url'], '/'), '/'), 1);
                }
                return $url;
            } else {
                return base_url('/');
            }
        } else {
            return base_url('/');
        }
    }
    public function index()
    {
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=242859072209767&ext=1708344446&hash=ATuYTw808H-Y73jaYnFrKDyRbCEUaMzY-53AvxlYlaWMGw',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        pre($response);
        die();
        $mediaUrl = "https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=242859072209767&ext=1708344099&hash=ATsUY5JrU9NwfHaAc1UKcWiCQllOZlkKzTjosIWoUcd_6w";
        $accessToken = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
        $filePath = 'C:\xampp\htdocs\admincampaign\assets\admin_folder\whatsapp_media89.png';

        $ch = curl_init($mediaUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Set the Authorization header with the bearer token
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);

        // Execute cURL session and get the content
        $fileContent = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Save the media file to your desired folder using file_put_contents
            if (file_put_contents($filePath, $fileContent) !== false) {
                echo 'Media file saved successfully: ' . $filePath;
            } else {
                echo 'Error: Unable to save media file.';
            }
        }

        // Close cURL session
        curl_close($ch);

        die();
        $access_token = 'EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';
        $headers = [
            'Authorization: Bearer EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD'
        ];
        $ch = curl_init('https://graph.facebook.com/v19.0/751272773615493');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        pre($response);
        die();
















        $jkdshjikf = shell_exec("curl  \ 'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=1708339648&hash=ATuB0FI32qe0DV7FaCeb_0eRGX4FXTxYRbHCmkY3-aIkbQ' \ -H 'Authorization: Bearer EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiisdfsdvsvctibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD' > media_file");

        pre($jkdshjikf);
        // die();
        $contants = file_get_contents('C:\xampp\htdocs\admincampaign\assets\admin_folder\media_file.text');
        $base64 = base64_encode($contants);
        pre($base64);






        die();
        // $encoded_string = ('data' )
        die();
        // require 'vendor/autoload.php';


        $curl = curl_init();

        $url = 'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=170833281s2&hash=ATtCCHlLgYLp0PuMwYT--SX-_BkB6v_1y3ysE31gqmuJQQ&access_token=EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiisdfsdvsvctibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD>media_file';  // Replace 'URL' with your actual URL media_file
        $accessToken = 'EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiisdfsdvsvctibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';  // Replace 'ACCESS_TOKEN' with your actual access token


        $sdfgdfgh = file_get_contents($url);
        pre($sdfgdfgh);

        // $headers = [
        //     'Authorization: Bearer ' . $accessToken,
        // ];

        // $response = $curl->get($url, [], $headers);

        // if ($curl->error) {
        //     echo 'Error: ' . $curl->error_code . ': ' . $curl->error_message;
        // } else {
        //     // Save the response to a local file
        //     file_put_contents('C:/xampp/htdocs/admincampaign/assets/admin_folder/media_file', $curl->response);
        //     echo 'File downloaded successfully.';
        // }

        // $curl->close();

        die();

        $curlCommand = "curl \'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=170833281s2&hash=ATtCCHlLgYLp0PuMwYT--SX-_BkB6v_1y3ysE31gqmuJQQ' \ -H 'Authorization: Bearer EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiisdfsdvsvctibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD' > media_file";
        shell_exec($curlCommand);
        $filePath = 'C:/xampp/htdocs/admincampaign/assets/admin_folder/media_file.mp4';
        if (file_exists($filePath)) {
        } else {
        }

        die();

        $curlCommand = "curl 'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=170833281s2&hash=ATtCCHlLgYLp0PuMwYT--SX-_BkB6v_1y3ysE31gqmuJQQ' -H 'Authorization: Bearer EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiisdfsdvsvctibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD' > C:/xampp/htdocs/admincampaign/assets/admin_folder/media_file.mp4";

        shell_exec($curlCommand);

        // Make sure the path is correct
        $filePath = 'C:/xampp/htdocs/admincampaign/assets/admin_folder/media_file.mp4';

        // Check if the file exists before attempting to read its content
        if (file_exists($filePath)) {
            // Read the contents directly or use it as needed
            echo "File content: " . file_get_contents($filePath);
        } else {
            echo "File does not exist or there was an issue downloading it.";
        }

        die();
        $curlCommand = "curl 'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=170833281s2&hash=ATtCCHlLgYLp0PuMwYT--SX-_BkB6v_1y3ysE31gqmuJQQ' -H 'Authorization: Bearer EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiisdfsdvsvctibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD' > media_file";
        shell_exec($curlCommand);

        // Make sure the path is correct
        $filePath = 'C:/xampp/htdocs/admincampaign/assets/admin_folder/media_file.php';
        $contents = file_get_contents($filePath);

        // Now you can use $contents as needed

        // Display the contents
        echo $contents;

        // For debugging purposes, you can output the HTTP response headers and body from the cURL command
        // $curlCommand = "curl -i 'your_url_here'";
        // echo shell_exec($curlCommand);
        die();
        shell_exec("curl 'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=170833281s2&hash=ATtCCHlLgYLp0PuMwYT--SX-_BkB6v_1y3ysE31gqmuJQQ' -H 'Authorization: Bearer EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiisdfsdvsvctibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD' > media_file");

        $contants = file_get_contents('C:/xampp/htdocs/admincampaign/assets/admin_folder/dishant.mp4');

        die();






        $url = 'https://graph.facebook.com/v19.0/751272773615493/?access_token=EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';
        $DataArray = getSocialData($url);

        pre($DataArray);

        $DataArray1 = getSocialData('https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=1708332812&hash=ATtCCHlLgYLp0PuMwYT--SX-_BkB6v_1y3ysE31gqmuJQQ&access_token=EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD');
        var_dump($DataArray1);

        die();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://lookaside.fbsbx.com/whatsapp_business/attachments/?mid=751272773615493&ext=1708330807&hash=ATuP0M8BJvIddh1danMIOwqxH1A2MpOnqVKw_E-61LExGw',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        die();
        $table_username = session_username($_SESSION['username']);
        $social_accounts = [
            'id int(255) primary key AUTO_INCREMENT',
            'name longtext',
            'platform_status int(10) NOT NULL DEFAULT 0 COMMENT "1-WhatsApp & 2-Facebook"',
            'platform_account int(255) NOT NULL',
            'profilepath longtext',
            'whatsapp_name longtext',
            'contact_no varchar(255) NOT NULL',
            'account_phone_no varchar(255) NOT NULL',
            'phone_number_id longtext',
            'conversation_account_id int(255) NOT NULL',

        ];
        $table = tableCreateAndTableUpdate2($table_username . '_social_accounts', '', $social_accounts);

        $messages = [
            'id int(255) primary key AUTO_INCREMENT',
            'contact_no varchar(255) NOT NULL',
            'platform_account_id int(255) NOT NULL',
            'platform_status int(10) NOT NULL DEFAULT 0 COMMENT "1-WhatsApp & 2-Facebook"',
            'message_status int(255) NOT NULL DEFAULT 0 COMMENT "0-sent & 1-delivered & 2-read & 3-failed"',
            'created_at datetime NOT NULL',
            'delivered_date_time datetime NOT NULL',
            'sent_date_time datetime NOT NULL',
            'failed_date_time datetime NOT NULL',
            'read_date_time datetime NOT NULL',
            'conversation_id longtext',
            'message_type int(255) NOT NULL DEFAULT 0 COMMENT "0-nofound & 1-text msg & 2-replay on msg & 3-send image and video & 4-document & 5-contact no & 6-audio & 7-location"',
            'sent_recieved_status int(255) DEFAULT 0 COMMENT "1-sent & 2-recieve"',
            'message_contant longtext',
            'replay_message_id longtext',
            'assets_type longtext',
            'assest_id longtext',
            'sha_id longtext',
            'asset_file_name longtext',
            'timestamp varchar(400)',
            'latitude longtext',
            'longitude longtext',
        ];
        $table = tableCreateAndTableUpdate2($table_username . '_messages', '', $messages);

        $table_username = session_username($_SESSION['username']);
        $admin_sent_message_detail = [
            'id int primary key AUTO_INCREMENT',
            'receiver_number int(255) NOT NULL',
            'Template_name varchar(400)',
            'template_id varchar(400)',
            'Whatsapp_Message_id varchar(400)',
            'Status varchar(400)',
            'WhatsApp_Response varchar(400)',
            'Createdat datetime',
            'delivertimedate datetime',
            'readtimedate datetime',
            'templatearray longtext ',
            'connection_id int(255) NOT NULL'
        ];

        $table = tableCreateAndTableUpdate2($table_username . '_sent_message_detail', '', $admin_sent_message_detail);
        // $table_username = getMasterUsername();
        $table_name100 = $table_username . '_email_track';
        $columns100 = [
            'id int primary key AUTO_INCREMENT',
            'email_track_code varchar(400)',
            'email_status varchar(400)',
            'email_open_datetime varchar(400)',
            'email_link_track_code varchar(400)',
        ];

        $table = tableCreateAndTableUpdate2($table_name100, '', $columns100);

        $table_name89 = $table_username . '_emailtemplate';
        $columns50 = [
            'id int primary key AUTO_INCREMENT',
            'title varchar(400)',
            'attachment longtext NOT NULL',
            'template longtext NOT NULL',

        ];

        $table = tableCreateAndTableUpdate2($table_name89, '', $columns50);
        $table_username = session_username($_SESSION['username']);
        $table_name3 = 'admin_generale_setting';
        $columns3 = [
            'id int primary key AUTO_INCREMENT',
            'Biometric_status int NOT NULL',
            'biometric_username varchar(200)',
            'biometric_password text',
            'biometric_connection int NOT NULL',
            'corporateid varchar(200)',
        ];
        $table3 = tableCreateAndTableUpdate2($table_name3, '', $columns3);

        $table_name3 = $table_username . '_platform_integration';
        $columns3 = [
            'id int primary key AUTO_INCREMENT',
            'master_id int(11) NOT NULL',
            "phone_number_id varchar(400) NOT NULL",
            "business_account_id varchar(400) NOT NULL",
            "access_token longtext NOT NULL",
            "whatsapp_name longtext NOT NULL",
            "whatsapp_number varchar(400)",
            "fb_app_id text NOT NULL",
            'fb_app_name varchar(200)',
            'fb_app_type varchar(200)',
            'from_email varchar(200)',
            'smtp_port int(11)',
            'smtp_host varchar(200)',
            'smtp_user varchar(200)',
            'smtp_password varchar(200)',
            'smtp_crypto varchar(200)',
            'mail_cc varchar(200)',
            'email_radio int(11)',
            'email_from varchar(200)',
            'website_name varchar(255)',
            "verification_status int(10) NOT NULL DEFAULT 0 COMMENT '0-Pending & 1-Approved & 3-Rejected'",
            "platform_status int NOT NULL DEFAULT 0 COMMENT '0-nothing & 1-whatsapp & 2-facebook & 3-Email & 4-Linkedin & 5-website'",
        ];
        $table3 = tableCreateAndTableUpdate2($table_name3, '', $columns3);


        $table_name11 = $table_username . '_task_status';
        $columns = [
            'id int primary key AUTO_INCREMENT',
            'title varchar(30) NOT NULL',
            'color varchar(30) NOT NULL',
            'user_id int(255) NULL DEFAULT NULL',
        ];
        $tables = tableCreateAndTableUpdate2($table_name11, '', $columns);

        $table_name118 = $table_username . '_task_comments';
        $columns = [
            'id int primary key AUTO_INCREMENT',
            'task_id int(12) NOT NULL',
            'comment varchar(265) NOT NULL',
            'date_time datetime NOT NULL',
        ];
        $table = tableCreateAndTableUpdate2($table_name118, '', $columns);

        $table_name120 = 'master_whatsapp_template';
        $columns = [
            'id int(255) primary key AUTO_INCREMENT',
            'template_name varchar(255) NOT NULL',
            'category_types varchar(265) NOT NULL',
            'language varchar(265) NOT NULL',
            'header varchar(265) NOT NULL',
            'body longtext NOT NULL',
            'footer varchar(265) NOT NULL',
            'uploade_file longtext NOT NULL ',
            'header_text varchar(265) NOT NULL',

        ];
        $table = tableCreateAndTableUpdate2($table_name120, '', $columns);

        $table_name119 = 'master_languages';
        $columns = [
            'id int(255) primary key AUTO_INCREMENT',
            'language_name varchar(250) NOT NULL',
            'language_short_name varchar(265) NOT NULL',
        ];
        $table = tableCreateAndTableUpdate2($table_name119, '', $columns);



        $table_name10 = $table_username . '_tasks';
        $columns = [
            'id int(11) primary key AUTO_INCREMENT NOT NULL',
            'user_id int(11)',
            'type int(11) NOT NULL COMMENT "1-task,2-meeting,3-reminder"',
            'subject varchar(500) DEFAULT NULL',
            'priority varchar(30) DEFAULT NULL',
            'priority_color varchar(30) DEFAULT NULL',
            'assignto_user int(11) DEFAULT NULL',
            'status int(11) DEFAULT NULL',
            'start_date date DEFAULT NULL',
            'end_date date DEFAULT NULL',
            'is_recursive int(11) NOT NULL DEFAULT 0',
            'recursive_type int(11) NOT NULL DEFAULT 0',
            'once_date DATETIME DEFAULT NULL',
            'daily_time time DEFAULT NULL',
            'weekly_name varchar(30) DEFAULT NULL',
            'monthly_date DATETIME DEFAULT NULL',
            'yearly_date DATETIME DEFAULT NULL',
            'description varchar(500) DEFAULT NULL',
            'attachment varchar(500) DEFAULT NULL',
            'is_note_status tinyint(4) DEFAULT NULL',
            'is_email_automation tinyint(1) NOT NULL DEFAULT 0',
            'customer_email varchar(500) DEFAULT NULL',
            'is_whatsapp_automation tinyint(1) NOT NULL DEFAULT 0',
            'customer_mobile varchar(20) DEFAULT NULL',
            'sticky_note_stuts int(11) NOT NULL DEFAULT 0 COMMENT "For sticky note button fill or not"',
            'created_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
            'updated_at timestamp NULL DEFAULT NULL',
        ];

        $tasktable = tableCreateAndTableUpdate2($table_name10, '', $columns);
        $table_notes = $table_username . '_notes';
        $columns_notes = [
            'id int(11) primary key AUTO_INCREMENT NOT NULL',
            'task_id int(11) NOT NULL',
            'note varchar(500) NOT NULL',
        ];
        $notestable = tableCreateAndTableUpdate2($table_notes, '', $columns_notes);

        $fb_table = $table_username . '_fb_pages';
        $fb_column = [
            'id int(11) primary key AUTO_INCREMENT NOT NULL',
            'connection_id int(11) NOT NULL',
            'page_id varchar(250)  NOT NULL',
            'page_name varchar(250)  NOT NULL',
            'page_access_token longtext  NOT NULL',
            'master_id int(11) NOT NULL',
            'intrested_area varchar(11)  NOT NULL',
            'property_sub_type varchar(11)  NOT NULL',
            'intrested_product varchar(11)  NOT NULL',
            'user_id varchar(11)  NOT NULL',
            'status int(255) NOT NULL DEFAULT 1',
            'form_id varchar(255)  NOT NULL',
            'form_name varchar(255)  NOT NULL',
            'page_img longtext  NOT NULL',
            'is_status smallint(1) NOT NULL DEFAULT 0  COMMENT \'0-fresh connection,1-deleted,2-old connection,3-draft connection,4-lost connection\''
        ];
        $fbtable = tableCreateAndTableUpdate2($fb_table, '', $fb_column);


        $integration_table = $table_username . '_integration';
        $integration_columns = [
            'unquie_id int(11) primary key AUTO_INCREMENT NOT NULL',
            'lead_id varchar(255)   NOT NULL',
            'inquiry_id varchar(255)   NOT NULL',
            'campaign_id varchar(255)   NOT NULL',
            'campaign_name varchar(255)   NOT NULL',
            'adset_id varchar(255)   NOT NULL',
            'adset_name varchar(255)   NOT NULL',
            'ad_id varchar(255)   NOT NULL',
            'ad_name varchar(255)   NOT NULL',
            'form_id varchar(255)   NOT NULL',
            'form_name varchar(255)   NOT NULL',
            'platform varchar(255)   NOT NULL',
            'full_name varchar(255)   NOT NULL',
            'phone_number varchar(255)   NOT NULL',
            'page_id varchar(255)   NOT NULL',
            'id int(11) NOT NULL',
            'fb_update int(11) NOT NULL DEFAULT 0',
            'assign_id int(11) NOT NULL DEFAULT 0',
            'lead_status int(11) NOT NULL DEFAULT 0',
            'created_time varchar(255)   NOT NULL',
            'lead_details text   NOT NULL',
        ];
        $inttable = tableCreateAndTableUpdate2($integration_table, '', $integration_columns);


        return view('index');
    }
    public function occupation()
    {
        if (in_array('mastercheck', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('occupation');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function attendance()
    {
        $table_name3 = 'admin_attendance';
        $columns3 = [
            'id int primary key AUTO_INCREMENT',
            'user_id int NOT NULL',
            'entry_date_time datetime NOT NULL',
            'exit_date_time datetime NOT NULL',
            'punch_date date NOT NULL DEFAULT current_timestamp()',
            'punch_time_array text',
            'hour_count int(11) NOT NULL',
            'created_at datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
            'status int(100) NOT NULL DEFAULT 0',
            'is_exit_day int(11) NOT NULL DEFAULT 0',
            'is_status int(255) DEFAULT 0 COMMENT \'0=absent, 1=present, 2=leave, 3=weekof\'',
        ];
        $table3 = tableCreateAndTableUpdate2($table_name3, '', $columns3);
        $AddOtherColumnInStaffTable = [
            'is_attendance int(11) DEFAULT 0',
            'emp_id varchar(255) NULL',
        ];
        tableCreateAndTableUpdate2('admin_user', '', $AddOtherColumnInStaffTable);
        if (in_array('attendance_check', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('attendance');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function subscriptions()
    {
        return view('subscriptions');
    }
    public function accountgroup()
    {
        return view('account-group');
    }
    public function allvoucher()
    {
        return view('all-voucher');
    }

    public function messenger_bot()
    {
        $table_username = getMasterUsername2();
        $columns_bot = [
            'id int primary key AUTO_INCREMENT',
            'client_name varchar(500) NOT NULL',
            'client_email varchar(500) NOT NULL',
            'client_phone_no varchar(500) NOT NULL',
            'chatting longtext',
            'status varchar(500) NOT NULL',
        ];
        tableCreateAndTableUpdate2($table_username . '_messeging_bot', '', $columns_bot);



        return view('messenger_bot');
    }

    public function bot()
    {
        $table_name = getMasterUsername2() . '_bot';
        $columns = [
            'id int primary key AUTO_INCREMENT',
            'name varchar(255)',
            'bot_img varchar(255)',
            'bot_type int DEFAULT 0 NOT NULL',
            'active int DEFAULT 0 NOT NULL',
        ];
        tableCreateAndTableUpdate2($table_name, '', $columns);
        return view('bot');
    }

    public function messenger()
    {
        $table_username = getMasterUsername2();
        $db_connection = \Config\Database::connect('second');
        $responseArray = array();
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
                    $phoneNumber = $display_phone_number;
                    if ($display_phone_number != '' && $value['id'] != '' && $verified_name != '') {
                        $responseArray[] = array(
                            'display_phone_number' => $display_phone_number,
                            'id' => $value['id'],
                            'verified_name' => $verified_name,
                        );
                    }
                }
            }
        }


        $responseArray = json_encode($responseArray);
        $data['WhatsAppAccounts'] = $responseArray;

        return view('messenger', $data);
    }

    public function bot_installer()
    {
        return view('bot_installer');
    }

    public function bot_setup()
    {
        $table_username = getMasterUsername2();
        $columns_bot = [
            'id int primary key AUTO_INCREMENT',
            'type_of_question varchar(500) NOT NULL',
            'question longtext NOT NULL',
            'sequence int(11) NOT NULL',
            'bot_id int(11) NOT NULL',
            'next_question_id int(11) NOT NULL',
            'menu_message longtext NOT NULL',
            'skip_question int(11) NOT NULL',
            'error_text varchar(500) NOT NULL',
        ];
        tableCreateAndTableUpdate2($table_username . '_bot_setup', '', $columns_bot);


        $db_connection = \Config\Database::connect('second');
        $sql = 'ALTER TABLE ' . $table_username . '_bot_setup MODIFY COLUMN menu_message longtext NOT NULL';
        $db_connection->query($sql);

        $column_check_sql = "SELECT COUNT(*) AS column_exists FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $table_username . "_bot_setup' AND COLUMN_NAME = 'answer'";
        $query = $db_connection->query($column_check_sql);
        $result = $query->getRow();

        if ($result->column_exists == 0) {
            $sql = 'ALTER TABLE ' . $table_username . '_bot_setup ADD COLUMN answer varchar(1000) NOT NULL';
            $db_connection->query($sql);
        }

        $table_username = getMasterUsername2();
        $columns_bot = [
            'id int primary key AUTO_INCREMENT',
            'question_type varchar(500) NOT NULL',
        ];
        tableCreateAndTableUpdate2('master_bot_typeof_question', '', $columns_bot);

        $db_connection = \Config\Database::connect('second');
        $sql_1 = "SELECT COUNT(*) as count FROM master_bot_typeof_question";
        $Getresult = $db_connection->query($sql_1);
        $inquiry_status_afcount = $Getresult->getResultArray();
        if ($inquiry_status_afcount[0]['count'] == '0') {
            $sql_insert = "INSERT INTO master_bot_typeof_question(`id`, `question_type`) VALUES ('1', 'Question'),('2', 'Single Choice'),('3', 'Email'),('4', 'Multiple Choice'),('5', 'Mobile Number'),('6', 'Number'),('7', 'Rating'),('8', 'Date Picker'),('9', 'Time Picker'),('10', 'Location'),('11', 'Range'),('12', 'File Upload'),('13', 'Website'),('14', 'Ask Contacts'),('15', 'Order Items'),
            ('16', 'Authenticator'),('17', 'Form'),('18', 'Carousel with buttons'),('19', 'Dynamic Question'),('20', 'Real Time Search'),('21', 'Appointment Booking'),('22', 'Statement'),('23', 'URL Navigator'),('24', 'Product Carousel'),('25', 'Carousel'),('26', 'Audio'),('27', 'Show Contacts'),('28', 'Show Location'),
            ('29', 'Show File'),('30', 'URL Auto Redirect'),('31', 'URL Based Flow'),('32', 'Country Based Flow'),('33', 'Action Based Flow'),('34', 'FAQs'),('35', 'AI Answering'),('36', 'Human Handover'),('37', 'Live Chats Redirect to whatsapp'),('38', 'Templates Based Flow'),('39', 'Users Initial Respone Based Flow'),('40', 'Menu List'),('41', 'Cart'),('42', 'Buttons'),('43', 'Catalog'),('44', 'Address'),('45', 'Ad Based Flow'),('46', 'Generic Template'),('47', 'Ice Breakers');";
            $res = $db_connection->query($sql_insert);
        }

        $data['master_bot_typeof_question'] = $this->MasterInformationModel->display_all_records2('master_bot_typeof_question');
        $data['admin_bot_setup'] = $this->MasterInformationModel->display_all_records2($table_username . '_bot_setup');
        $data['admin_bot'] = $this->MasterInformationModel->display_all_records2($table_username . '_bot');
        return view('bot_setup', $data);
    }

    public function bot_setup_designer()
    {
        $table_username = getMasterUsername2();
        $columns_bot = [
            'id int primary key AUTO_INCREMENT',
            'type_of_question varchar(500) NOT NULL',
            'question longtext NOT NULL',
            'sequence int(11) NOT NULL',
            'bot_id int(11) NOT NULL',
        ];
        tableCreateAndTableUpdate2($table_username . '_bot_setup', '', $columns_bot);

        $table_username = getMasterUsername2();
        $columns_bot = [
            'id int primary key AUTO_INCREMENT',
            'question_type varchar(500) NOT NULL',
        ];
        tableCreateAndTableUpdate2('master_bot_typeof_question', '', $columns_bot);

        $db_connection = \Config\Database::connect('second');
        $sql_1 = "SELECT COUNT(*) as count FROM master_bot_typeof_question";
        $Getresult = $db_connection->query($sql_1);
        $inquiry_status_afcount = $Getresult->getResultArray();
        if ($inquiry_status_afcount[0]['count'] == '0') {
            $sql_insert = "INSERT INTO master_bot_typeof_question(`id`, `question_type`) VALUES ('1', 'Question'),('2', 'Single Choice'),('3', 'Email'),('4', 'Multiple Choice'),('5', 'Mobile Number'),('6', 'Number'),('7', 'Rating'),('8', 'Date Picker'),('9', 'Time Picker'),('10', 'Location'),('11', 'Range'),('12', 'File Upload'),('13', 'Website'),('14', 'Ask Contacts'),('15', 'Order Items'),
            ('16', 'Authenticator'),('17', 'Form'),('18', 'Carousel with buttons'),('19', 'Dynamic Question'),('20', 'Real Time Search'),('21', 'Appointment Booking'),('22', 'Statement'),('23', 'URL Navigator'),('24', 'Product Carousel'),('25', 'Carousel'),('26', 'Audio'),('27', 'Show Contacts'),('28', 'Show Location'),
            ('29', 'Show File'),('30', 'URL Auto Redirect'),('31', 'URL Based Flow'),('32', 'Country Based Flow'),('33', 'Action Based Flow'),('34', 'FAQs'),('35', 'AI Answering'),('36', 'Human Handover'),('37', 'Live Chats Redirect to whatsapp'),('38', 'Templates Based Flow'),('39', 'Users Initial Respone Based Flow'),('40', 'Menu List'),('41', 'Cart'),('42', 'Buttons'),('43', 'Catalog'),('44', 'Address'),('45', 'Ad Based Flow'),('46', 'Generic Template'),('47', 'Ice Breakers');";
            $res = $db_connection->query($sql_insert);
        }

        $data['master_bot_typeof_question'] = $this->MasterInformationModel->display_all_records2('master_bot_typeof_question');
        return view('bot_setup_designer', $data);
    }
    public function manage_audience()
    {
        $table_username = getMasterUsername2();
        $columns_audience = [
            'id int primary key AUTO_INCREMENT',
            'inquiry_id int(11) NOT NULL',
            'inquiry_status int(11) NOT NULL',
            'full_name varchar(500) NOT NULL',
            'intrested_product int(11) NOT NULL',
            'name varchar(255) NOT NULL',
            'retansion int(11) NOT NULL',
            'created_at datetime NOT NULL DEFAULT current_timestamp()',
            'updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
            'mobileno varchar(11) NOT NULL',
            'email varchar(255) NOT NULL',
            'address varchar(255) NOT NULL',
            'source varchar(255) NOT NULL',
            'inquiry_data int(11) NOT NULL',
        ];
        tableCreateAndTableUpdate2($table_username . '_audience', '', $columns_audience);
        $data['master_inquiry_type'] = $this->MasterInformationModel->display_all_records2('admin_master_inquiry_type');
        $data['master_inquiry_source'] = $this->MasterInformationModel->display_all_records2('admin_master_inquiry_source');
        // $data['project_management_subtype'] = $this->MasterInformationModel->display_all_records('project_management_subtype');
        $data['area'] = $this->MasterInformationModel->display_all_records('master_area');
        $data['admin_user'] = $this->MasterInformationModel->display_all_records2('admin_user');
        // $data['project'] = $this->MasterInformationModel->display_all_records($username."_".'project'); 
        // $data['project_management_type'] = $this->MasterInformationModel->display_all_records('project_management_type');
        $data['admin_subscription_master'] = $this->MasterInformationModel->display_all_records2('admin_subscription_master');
        $data['admin_product'] = $this->MasterInformationModel->display_all_records2('admin_product');
        $data['master_inquiry_close'] = $this->MasterInformationModel->display_all_records2('admin_master_inquiry_close');
        $data['master_inquiry_status'] = $this->MasterInformationModel->display_all_records2('master_inquiry_status');
        $data['user_data'] = $this->MasterInformationModel->display_all_records2('admin_user');
        return view('manage_audience', $data);
    }
    public function integration()
    {
        return view('integration');
    }
    public function subscription_master()
    {
        if (in_array('subscription_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('subscription_master');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function payment_method()
    {
        return view('payment_method');
    }
    public function user_demo()
    {
        if (in_array('subscription_check', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $data['product'] = $this->MasterInformationModel->display_all_records2('admin_product', 'ASC');
            return view('demo_user', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function add_data_module()
    {
        return view('add_data_module');
    }
    public function data_module()
    {
        return view('data_module');
    }
    public function sign_up()
    {
        if (in_array('signup_check', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('signup');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function discount()
    {
        if (in_array('discount_check', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $data['type'] = $this->MasterInformationModel->display_all_records2('admin_product', 'ASC');
            return view('coupon', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function configuration()
    {
        if (in_array('configuration_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('configuration');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function food()
    {
        session();
        $data['food_type'] = $this->MasterInformationModel->display_all_records2('master_food_type', 'ASC');
        return view('food', $data);
    }

    public function alldiet()
    {
        session();
        // $data['food_type'] = $this->MasterInformationModel->display_all_records2('master_food_type', 'ASC');
        return view('alldiet');
    }

    public function allworkout()
    {
        session();
        // $data['food_type'] = $this->MasterInformationModel->display_all_records2('master_food_type', 'ASC');
        return view('allworkout');
    }

    public function food_type()
    {
        return view('food-type');
    }
    public function exercise_sub_type()
    {
        $data['exercise_type'] = $this->MasterInformationModel->display_all_records2('master_exercise_type', 'ASC');
        return view('exercise-sub-type', $data);
    }

    public function alert_setting()
    {
        $username = session_username($_SESSION['username']);
        $table_username = getMasterUsername();
        $table_name = $table_username . '_alert_setting';
        $columns = [
            'id int primary key AUTO_INCREMENT',
            'is_alert int',
            'alert_title int',
            'is_sms int',
            'sms_template_id int(244)',
            'is_email int',
            'email_template_id int(244)',
            'is_whatsapp int',
            'whatsapp_template_id int(244)'
        ];
        $foreign_keys = [
            'FOREIGN KEY (alert_title) REFERENCES master_alert_setting(id)',
        ];
        $table = tableCreateAndTableUpdate($table_name, '', $columns, $foreign_keys);
        $db_connection = \Config\Database::connect();
        $alert_sql = 'SELECT * FROM master_alert_setting WHERE id NOT IN (12)';
        $alert_result = $db_connection->query($alert_sql);
        $master_alert_setting = $alert_result->getResultArray();
        $data['master_alert_setting'] = $master_alert_setting;
        // $data['master_alert_setting'] = $this->MasterInformationModel->display_all_records('master_alert_setting');
        $username = session_username($_SESSION['username']);
        $data['smstemplate'] = $this->MasterInformationModel->display_all_records2($username . "_" . 'smstemplate');
        $data['emailtemplate'] = $this->MasterInformationModel->display_all_records2($username . "_" . 'emailtemplate');
        $data['whatsapp_template'] = $this->MasterInformationModel->display_all_records2($username . "_" . 'whatsapp_template');
        $data['alert_setting'] = $this->MasterInformationModel->display_all_records2($username . "_" . 'alert_setting');
        return view('alert_setting', $data);
    }
    public function exercises()
    {
        session();
        // $table_name = $table_username . '_exercise';
        // $columns = [
        //     'id int primary key AUTO_INCREMENT',
        //     'e_name varchar(500) NOT NULL',
        //     'e_type varchar(500) NOT NULL',
        //     'e_subtype varchar(500) NOT NULL',
        //     'e_rep varchar(255) NOT NULL',
        //     'e_calories float NOT NULL',
        //     'e_image varchar(700) NOT NULL',
        //     'duration varchar(400) NOT NULL',
        //     'selected_id varchar(500) NOT NULL',
        //     // "FOREIGN KEY (project_id) REFERENCES {$username}_project(id)" 
        // ];
        // $table = tableCreateAndTableUpdate($table_name, '', $columns);
        // $table_name1 = $table_username . '_exercise_type';
        // $columns1 = [
        //     'id int primary key AUTO_INCREMENT',
        //     'e_type varchar(500) NOT NULL',
        //     // "FOREIGN KEY (project_id) REFERENCES {$username}_project(id)" 
        // ];
        // $table1 = tableCreateAndTableUpdate($table_name1, '', $columns1);
        // $table_name2 = $table_username . '_exercise_sub_type';
        // $columns2 = [
        //     'id int primary key AUTO_INCREMENT',
        //     'e_subtype varchar(500) NOT NULL',
        //     'e_type varchar(500) NOT NULL',
        //     // "FOREIGN KEY (project_id) REFERENCES {$username}_project(id)" 
        // ];
        // $table2 = tableCreateAndTableUpdate($table_name2, '', $columns2);
        $data['exercise_type'] = $this->MasterInformationModel->display_all_records2('master_exercise_type', 'ASC');
        $data['exercise_sub_type'] = $this->MasterInformationModel->display_all_records2('master_exercise_sub_type', 'ASC');
        return view('exercises', $data);
    }
    public function e_subtype()
    {
        $data['exercise_type'] = $this->MasterInformationModel->display_all_records2('master_exercise_type', 'ASC');
        return view('exercise-sub-type', $data);
    }
    public function exercise_type()
    {
        return view('exercise-type');
    }
    public function alert_sms()
    {
        return view('alert_sms');
    }
    public function alert_whatsapp()
    {
        return view('alert_whatsapp');
    }
    public function alert_image()
    {
        return view('alert_image');
    }
    public function account_dashboard()
    {
        return view('account_dashboard');
    }
    public function payment_m_master()
    {
        if (in_array('payment_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('payment_m_master');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function payment_receivable()
    {
        return view('payment_receivable');
    }
    public function voucher_type()
    {
        if (in_array('voucher_child_access', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('voucher_type');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function invoice()
    {
        if (in_array('invoice_inquiry_information', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('invoice');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function sales_register()
    {
        if (in_array('sales_information', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('sales_register');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function user_activity()
    {
        return view('user-activity');
    }
    public function supportticket()
    {
        if (in_array('client_supportcheck', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('supportticket');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function task()
    {
        // if (((isset($_SESSION['admin']) && $_SESSION['admin'] == 1) || $status_value === 1)) {
        //     if (in_array('task_manage', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
        // food type table data fetch
        $username = session_username($_SESSION['username']);
        $data['task_status'] = $this->MasterInformationModel->display_all_records2('admin_task_status', 'ASC');
        $data1['task_status_one'] = $this->MasterInformationModel->display_all_records2('admin_task_status', 'ASC');
        // $data2['task_status_two'] = $this->MasterInformationModel->display_all_records($table_username . "_" .'task_priority','ASC');
        // $data3['task_status_three'] = $this->MasterInformationModel->display_all_records($table_username . "_" .'task_priority','ASC');
        $dataBs = \Config\Database::connect('second');
        $getchild = '';
        $getchild = getChildIds($_SESSION['id']);
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $userCon = '';
        } else {
            if (!empty($getchild)) {
                $getchilds = "'" . implode("', '", $getchild) . "'";
            } else {
                $getchilds = "'" . $_SESSION['id'] . "'";
            }
            $userCon = "  AND (id=" . $_SESSION['id'] . "  OR  id IN (" . $getchilds . "))";
        }
        $sql_comment = "SELECT * FROM " . $username . "_user WHERE head != 0 " . $userCon . " ORDER BY id DESC";
        $result_comment = $dataBs->query($sql_comment);
        $departmentdisplaydata = $result_comment->getResultArray();
        $data4['user'] = $departmentdisplaydata;
        return view('task', $data + $data1 + $data4);
        // } else {
        //     return redirect()->to($this->redirect_link());
        // }
        // } else {
        //     return view('attendance');
        // }
    }
    public function site_visit()
    {
        if (in_array('demo_register', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $username = session_username($_SESSION['username']);
            $data['master_inquiry_type'] = $this->MasterInformationModel->display_all_records2($username . '_master_inquiry_type');
            $data['master_inquiry_source'] = $this->MasterInformationModel->display_all_records2($username . '_master_inquiry_source');
            $data['master_inquiry_close'] = $this->MasterInformationModel->display_all_records2($username . '_master_inquiry_close');
            $data['master_inquiry_status'] = $this->MasterInformationModel->display_all_records2('master_inquiry_status');
            $data['admin_product'] = $this->MasterInformationModel->display_all_records2('admin_product');
            return view('demo_register', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function attendance_2()
    {
        return view('attendance_2');
    }
    public function profile()
    {
        // $status_value = attendance_page();
        // if (((isset($_SESSION['admin']) && $_SESSION['admin'] == 1) || $status_value === 1)) {
        $username = session_username($_SESSION['username']);
        $data['user_table'] = $this->MasterInformationModel->display_all_records2($username . '_user');
        return view('profile', $data);
        // } else {
        //     return redirect()->to($this->redirect_link());
        // }
    }
    public function inquiry_report()
    {
        return view('inquiry-report');
    }
    public function site_report()
    {
        $username = session_username($_SESSION['username']);
        $data['project'] = $this->MasterInformationModel->display_all_records($username . "_project");
        return view('site-report', $data);
    }
    public function performance_report()
    {
        return view('performance-report');
    }
    public function lead_module()
    {
        $username = session_username($_SESSION['username']);
        $this->db = \Config\Database::connect('second');
        $data['product'] = $this->MasterInformationModel->display_all_records2($username . "_product");
        return view('lead_module', $data);
    }
    public function leadlist()
    {
        return view('leadlist');
    }
    public function projecttype()
    {
        return view('projecttype');
    }
    public function projectsubtype()
    {
        $data['project_management_type'] = $this->MasterInformationModel->display_all_records('project_management_type', 'ASC');
        return view('project-sub-type', $data);
    }
    public function projectstatus()
    {
        return view('project-status');
    }
    public function competitormasters()
    {
        return view('competitormasters');
    }
    public function email_link_track()
    {
        return view('email_link_track');
    }
    public function email_connection()
    {
        $username = session_username($_SESSION['username']);
        $data['platform_integration'] = $this->MasterInformationModel->display_all_records2($username . '_platform_integration');
        return view('email_connection', $data);
    }
    public function peoplelist()
    {
        if (in_array('peopleinformation', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('PeopleList');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function user()
    {
        $AddOtherColumnInStaffTable = [
            'is_attendance int(11) DEFAULT 0',
            'emp_id varchar(255) NULL',
        ];
        tableCreateAndTableUpdate2('admin_user', '', $AddOtherColumnInStaffTable);
        if (in_array('userinformation', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $username = session_username($_SESSION['username']);
            $data['department'] = $this->MasterInformationModel->display_all_records2('admin_department');
            $data['user_role'] = $this->MasterInformationModel->display_all_records2('admin_userrole');
            // $data['project'] = $this->MasterInformationModel->display_all_records('urvi_project');
            // $data['project'] = json_encode(array());
            $data['product'] = $this->MasterInformationModel->display_all_records2('admin_product', 'ASC');
            return view('user', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function web_settings()
    {
        $table_name3 = 'admin_generale_setting';
        $columns3 = [
            'id int primary key AUTO_INCREMENT',
            'Biometric_status int NOT NULL',
            'biometric_username varchar(200)',
            'biometric_password text',
            'biometric_connection int NOT NULL',
            'corporateid varchar(200)',
        ];
        $table3 = tableCreateAndTableUpdate2($table_name3, '', $columns3);
        return view('web-settings');
    }
    public function allinquiry()
    {
        // pre($this->page_access());
        // die();
        if (in_array('all_inquiry_information', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $username = session_username($_SESSION['username']);
            $data['master_inquiry_type'] = $this->MasterInformationModel->display_all_records2('admin_master_inquiry_type');
            $data['master_inquiry_source'] = $this->MasterInformationModel->display_all_records2('admin_master_inquiry_source');
            // $data['project_management_subtype'] = $this->MasterInformationModel->display_all_records('project_management_subtype');
            $data['area'] = $this->MasterInformationModel->display_all_records('master_area');
            $data['admin_user'] = $this->MasterInformationModel->display_all_records2('admin_user');
            $data['admin_emailtemplate'] = $this->MasterInformationModel->display_all_records2($username . '_emailtemplate');
            // $data['project'] = $this->MasterInformationModel->display_all_records($username."_".'project'); 
            // $data['project_management_type'] = $this->MasterInformationModel->display_all_records('project_management_type');
            $data['admin_subscription_master'] = $this->MasterInformationModel->display_all_records2('admin_subscription_master');
            $data['admin_product'] = $this->MasterInformationModel->display_all_records2('admin_product');
            $data['master_inquiry_close'] = $this->MasterInformationModel->display_all_records2('admin_master_inquiry_close');
            $data['master_inquiry_status'] = $this->MasterInformationModel->display_all_records2('master_inquiry_status');
            $data['user_data'] = $this->MasterInformationModel->display_all_records2('admin_user');
            // $data['project_management_properties'] = $this->MasterInformationModel->display_all_records($username."_".'properties');
            return view('inquiry/allinquiry', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function todayfollowup()
    {
        return view('todaysfollow');
    }
    public function pendingfollow()
    {
        return view('pendingfollow');
    }
    public function show_master_departmentlisting()
    {
        return view('master-departmentlisting');
    }
    public function project()
    {
        if (in_array('project_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $data['master_area'] = $this->MasterInformationModel->display_all_records('master_area');
            $data['project_management_type'] = $this->MasterInformationModel->display_all_records('project_management_type');
            $data['project_management_subtype'] = $this->MasterInformationModel->display_all_records('project_management_subtype');
            $data['project_management_status'] = $this->MasterInformationModel->display_all_records('project_management_status');
            return view('project', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function brokerlist()
    {
        if (in_array('broker_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('BrokerList');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function builderlist()
    {
        if (in_array('builder_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('builder-list');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function investorlist()
    {
        if (in_array('investor_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $username = session_username($_SESSION['username']);
            $data['project'] = $this->MasterInformationModel->display_all_records($username . "_" . 'project');
            $data['project_management_subtype'] = $this->MasterInformationModel->display_all_records('project_management_subtype');
            $data['master_area'] = $this->MasterInformationModel->display_all_records('master_area');
            $data['occupation'] = $this->MasterInformationModel->display_all_records('occupation');
            return view('investorlist', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function country_list()
    {
        return view('countrylist');
    }
    public function project_type()
    {
        return view('projecttype');
    }
    public function managermasterinquiry()
    {
        return view('inquiry-type');
    }
    public function customer()
    {
        if (in_array('customer_management', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            return view('customer');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function manageinquirystatus()
    {
        return view('manageinquirystatus');
    }
    public function property()
    {
        $data['urvi_project'] = $this->MasterInformationModel->display_all_records('urvi_project', 'ASC');
        // $data['project'] = $this->MasterInformationModel->display_all_records('project','ASC');
        // print_r($data);
        return view('property', $data);
    }
    public function project_sub_type()
    {
        return view('project-sub-type');
    }
    public function user_admin_role()
    {
        if (in_array('useradminrole', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $data['department'] = $this->MasterInformationModel->display_all_records2('admin_department');
            return view('user-admin-role', $data);
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function manage_inquiry_source()
    {
        $data['master_inquiry_source_type'] = $this->MasterInformationModel->display_all_records('master_inquiry_source_type', 'ASC');
        return view('manage-inquiry-source', $data);
    }
    public function inquiry_source_type()
    {
        return view('inquiry-source-type');
    }
    public function project_status()
    {
        return view('project-status');
    }
    //      public function caste()
    // {
    //     return view('master-caste');
    // }
    public function statelist()
    {
        return view('statelist');
    }
    public function citylist()
    {
        return view('citylist');
    }
    public function manage_inquiry_close()
    {
        return view('manage-inquiry-close');
    }
    public function area_location()
    {
        return view('area-location');
    }
    public function surname()
    {
        return view('surname');
    }
    public function sub_caste()
    {
        return view('sub-caste');
    }
    public function addnew_user()
    {
        return view('addnew_user');
    }
    public function login()
    {

        return view('auth-login/login');
    }
    public function signup()
    { //key id wordpress order user name in creat with md5
        $key = $this->request->getGet("key");
        $username = md5(trim($this->request->getGet("user")));
        if ($key == $username) {
            return view('auth-login/sign-up');
        } else {
            return redirect()->to("https://ajasys.com/");
        }
    }
    public function competitor_analysis()
    {
        return view('competitor-analysis');
    }
    public function projectdetails()
    {
        return view('project-detail');
    }
    public function que_ans()
    {
        return view('Q&A');
    }
    public function conversion()
    {
        if (in_array('subscription_register_conversion_register', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $username = session_username($_SESSION['username']);
            // $data['area'] = $this->MasterInformationModel->display_all_records('master_area');
            // $data['project_management_subtype'] = $this->MasterInformationModel->display_all_records('project_management_subtype');
            // $data['project_name'] = $this->MasterInformationModel->display_all_records($username . '_project');
            return view('subscription-register');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
    public function conversion_request()
    {
        if (in_array('subscription_request_register_conversion_register', $this->get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            // $status_value = attendance_page();
            // if (((isset($_SESSION['admin']) && $_SESSION['admin'] == 1) || $status_value === 1)) {
            // $username = session_username($_SESSION['username']);
            // $data['area'] = $this->MasterInformationModel->display_all_records('master_area');
            // $data['project_management_subtype'] = $this->MasterInformationModel->display_all_records('project_management_subtype');
            // $data['project_name'] = $this->MasterInformationModel->display_all_records($username . '_project');
            return view('subscription-request');
        } else {
            return redirect()->to($this->redirect_link());
        }
    }
}
