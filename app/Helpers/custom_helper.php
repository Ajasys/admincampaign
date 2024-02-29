<?php

if(!function_exists("customErrorHandlerCheck")) {
    function customErrorHandlerCheck($errno = "", $errstr = "", $errfile = "", $errline = "")
    {
        $dbconn = \Config\Database::connect('second');
        $error_message = "Error [$errno] $errstr in $errfile at line $errline";
      
        $userId = isset($_SESSION["id"]) ? $_SESSION["id"] : 0;
        switch ($errno) {
            case E_ERROR:
            case E_USER_ERROR:
                $error = 'Fatal Error';
                break;
            default:
                $error = 'Unknown';
                break;
        }
    
        $errorData = [
            'user_id' => $userId,
            'error_type' => $error,
            'error_message' => $error_message,
            'error_file' => $errfile,
            'error_line' => $errline,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dbconn->table('master_error_logs')->insert($errorData);
        return true;
    }

}
if (!function_exists('compressImage')) {
    function compressImage($sourcePath)
    {
        $maxSize = 1048576;
        if (!file_exists($sourcePath)) {
            return false;
        }
        $sourceImage = imagecreatefromjpeg($sourcePath);
        if (!$sourceImage) {
            return false;
        }
        list($width, $height) = getimagesize($sourcePath);
        $compression = 1.0;
        $targetSize = filesize($sourcePath);
        while ($targetSize > $maxSize && $compression > 0) {
            $compression -= 0.1;
            $newWidth = $width * $compression;
            $newHeight = $height * $compression;
            $targetImage = imagecreatetruecolor($newWidth, $newHeight);
            if (imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height)) {
                ob_start();
                imagejpeg($targetImage, null, 75);
                $compressedImageData = ob_get_clean();
                $targetSize = strlen($compressedImageData);
                imagedestroy($targetImage);
            } else {
                break;
            }
        }
        imagedestroy($sourceImage);
        if ($targetSize > $maxSize) {
            return false;
        } else {
            return $compressedImageData;
        }
    }
}
if (!function_exists('getMasterUsername')) {
    function getMasterUsername()
    {
        $db_connection = \Config\Database::connect();
        $master = 0;
        if (isset($_SESSION['master'])) {
            $master = $_SESSION['master'];
        }

        $sql = 'SELECT * FROM  master_user  WHERE id = "' . $master . '"';
        $result = $db_connection->query($sql);
        $resultsssss = $result->getResultArray();
        foreach ($resultsssss as $key => $val) {
            return $val['username'];
        }
    }
}
if (!function_exists('SendMail')) {
    function SendMail($toemail = '', $subject = '', $message = '', $attachment = '', $username = '')
    {
        $db_connection = \Config\Database::connect('second');

        // $table_username = session_username($_SESSION['username']);
        // $table_name118 = $table_username . '_email_data';
        // $columns = [
        //     'id int primary key AUTO_INCREMENT',
        //     'email_address varchar(50) NOT NULL',
        //     'email_track_code varchar(50) NOT NULL',
        //     'email_subject varchar(50) NOT NULL',
        //     'email_body text NOT NULL',
        //     'PRIMARY KEY (`email_track_code`)'
        // ];
        // $table = tableCreateAndTableUpdate2($table_name118, '', $columns);

        // $table_name1189 = $table_username . '_email_data';
        // $columns50 = [
        //     'id int primary key AUTO_INCREMENT',
        //     'email_track_code varchar(50) NOT NULL',
        //     'email_status varchar(50) DEFAULT NULL',
        //     'email_open_datetime varchar(50) DEFAULT NULL',
        // ];
        // $table50 = tableCreateAndTableUpdate2($table_name1189, '', $columns50);
        // try {
            $first_db = \Config\Database::connect('second');
            // $generalSetting = $first_db->table('admin_generale_setting')->get()->getRow();
            // $master = $_SESSION['master'];
            // $settings = $first_db->table('admin_generale_setting')
            // ->where('master_id', $master)
            // ->where('platform_status', 3)
            // ->get()
            // ->getRow();
            $db_connection = \Config\Database::connect('second');
            $query90 = "SELECT * FROM admin_platform_integration WHERE platform_status = 3 AND  master_id = '" . $_SESSION['master'] . "'";

            $result = $db_connection->query($query90);
            $total_dataa_userr_22 = $result->getResult();
            if (isset($total_dataa_userr_22[0])) {
                $settings_data = get_object_vars($total_dataa_userr_22[0]);
            } else {
                $settings_data = array();
            }
          
            // $email_from = $generalSetting->email_from;
            // cc code
            $SendMailUsing = $settings_data['email_radio'];
            $platform_status = $settings_data['platform_status'];
          

            if ( $SendMailUsing == 1 && $platform_status == 3) {
                // $username = session_username($_SESSION['username']);
                $first_db = \Config\Database::connect();
                $email = \Config\Services::email();
                $email->setto($toemail);
                $email->setfrom('info@ajasys.in', $subject);
                $email->setSubject($subject); // templete nu title 
                $email->setMailType('html');
                $email->setMessage(html_entity_decode($message));
                if (!empty($attachment)) {
                    $email->attach($attachment);
                }
                $email->send();
            } else if ( $SendMailUsing == 2 && $platform_status == 3) {
                // try {
                  
                // if ($generalSetting) {
                    // master_id
                // $senderEmail = $generalSetting->smtp_user;

                $email = \Config\Services::email();
                // $smtpConfigInfo = [
                //     'protocol' => 'smtp',
                //     'SMTPHost' => 'mail.ajasys.com',
                //     'SMTPPort' => '2525',
                //     'SMTPUser' => 'neel@ajasys.com',
                //     'SMTPPass' => 'Ti=clIJD8Yo5',
                //     'SMTPCrypto' => 'tls',
                //     'mailType' => 'html',
                //     'charset' => 'utf-8',
                //     'validate' => true,
                //     'CRLF' => "\r\n",
                //     'newline' => "\r\n"
                // ];
                $smtpConfigInfo = [
                    'protocol' => 'smtp',
                    'SMTPHost' => $settings_data['smtp_host'],
                    'SMTPPort' => $settings_data['smtp_port'],
                    'SMTPUser' => $settings_data['smtp_user'],
                    'SMTPPass' => $settings_data['smtp_password'],
                    'SMTPCrypto' => $settings_data['smtp_crypto'],
                    'mailType' => 'html',
                    'charset' => 'utf-8',
                    'validate' => true,
                    'CRLF' => "\r\n",
                    'newline' => "\r\n"
                ];
                
                $email->initialize($smtpConfigInfo);
                $email->setTo($toemail);
                $email->setFrom('neel@ajasys.com', $subject);

                if (isset($settings_data['mail_cc']) && !empty($settings_data['mail_cc'])) {
                    $email->setCC($settings_data['mail_cc']);
                }

                $email->setSubject($subject);
                $email->setMessage(base64_encode($message));
                
                if (!empty($attachment)) {
                    $email->attach($attachment);
                }
                
                $base_url = base_url('');
                $track_code = md5(rand());
                $track_code_link = md5(rand());
                $message_body = $message;
                $message_body .= '<img src="' . $base_url . 'email_track?code=' . $track_code . ' " width="1" height="1" />';
               

                $links = array();
                // Use a regular expression to find all links in the email body
                preg_match_all('/\b(?:https?:\/\/|http:\/\/)\S+\b/', $message, $matches);
                $links = $matches[0];
                // $base_url_link = base_url('');
          
                foreach ($links as $link) {
                    // $track_code_link = md5($link); // Generate a unique tracking code for each link
                    // pre($link);
                    // $tracked_link = '<a href="' . $base_url . 'email_link_track?link_track='  . $track_code_link . '">' . $link . '</a>';
                }
                if(isset($link))
                {
                    $tracked_link = '<a href="' . $base_url . 'login?link_track=' . $track_code_link . '">' . $link . '</a>'; 
                    $message_body = str_replace($link, $tracked_link, $message_body);
                }

                $from_email_address = 'neel@ajasys.com';
                $email->setMessage($message_body);
                // $email->setMessage($message_body50);
                $email->setMailType('html');
                if ($email->send()) {

                    $data = array(
                        'email_subject' => $subject,
                        'from_email_address' => $from_email_address,
                        'email_body' => $message,
                        'email_address' => $toemail,
                        'email_track_code' => $track_code,
                        'email_link_track_code'=>$track_code_link,
                    );
                    $db = \Config\Database::connect('second');
                    $builder = $db->table('admin_email_data');
                    $builder->insert($data);

                    return 0;
                    // pre($email); 
                } else {
                    $error_message = $email->printDebugger(['headers']);
                   
                    error_log("Email sending failed: " . $error_message);
                    return 1; // Failed to send email
                }
                die();
                // } else {
                //     return 1; // General settings not found
                // }
            // } catch (Exception $e) {
            //     $error_message = $e->getMessage();
            //     error_log("Email sending failed: " . $error_message);
            //     return 1; // Failed to send email due to exception
            // }
            }

            // echo "Email sent to $toemail<br>";

            return 0;
        // } catch (Exception $e) {
        //     return 1;
        // }
    }
}

if (!function_exists('getMasterUsername2')) {
    function getMasterUsername2()
    {
        $db_connection = \Config\Database::connect('second');
        $master = 0;
        if (isset($_SESSION['master'])) {
            $master = $_SESSION['master'];
        }

        $sql = 'SELECT * FROM  master_user  WHERE id = "' . $master . '"';
        $result = $db_connection->query($sql);
        $resultsssss = $result->getResultArray();
        foreach ($resultsssss as $key => $val) {
            return $val['username'];
        }
    }
}

// if (!function_exists('tableCreateAndTableUpdate')) {
//     function tableCreateAndTableUpdate($table_name = "", $duplicate_table = '', $columns = array())
//     {
//         $first_db = \Config\Database::connect();
//         if ($first_db->tableExists($table_name) && $table_name != '') {
//             foreach ($columns as $value) {
//                 $value_col_name = explode(' ', $value);
//                 if (!$first_db->fieldExists($value_col_name[0], $table_name) && !empty($value)) {
//                     $sql = "ALTER TABLE $table_name ADD $value ";
//                     $first_db->query($sql);
//                 }
//             }
//         } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
//             if (!empty($columns)) {
//                 $columnss = implode(",", $columns);
//                 $sql = "CREATE TABLE $table_name ($columnss)";
//                 echo $sql;
//                 $first_db->query($sql);
//             } else {
//                 $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
//                 $first_db->query($sql);
//             }
//         } else {
//             if (!empty($columns)) {
//                 $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
//                 $first_db->query($sql);
//             }
//         }
//         $first_db->close();
//     }
// }
if (!function_exists('tableCreateAndTableUpdate')) {
    function tableCreateAndTableUpdate($table_name = "", $duplicate_table = '', $columns = array(), $foreign_keys = array())
    {
        $first_db = \Config\Database::connect();
        if ($first_db->tableExists($table_name) && $table_name != '') {
            foreach ($columns as $value) {
                $value_col_name = explode(' ', $value);
                if (!$first_db->fieldExists($value_col_name[0], $table_name) && !empty($value)) {
                    $sql = "ALTER TABLE $table_name ADD $value "; // add column sql 
                    $first_db->query($sql);
                }
            }
            // foreach ($foreign_keys as $foreign_key) {
            //     $sql = "ALTER TABLE $table_name ADD $foreign_key";
            //     $first_db->query($sql);
            // }
        } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
            if (!empty($columns)) {
                $columnss = implode(",", $columns);
                $sql = "CREATE TABLE $table_name ($columnss)";
                echo $sql;
                $first_db->query($sql);
            } else {
                $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
                $first_db->query($sql);
            }
        } else {
            if (!empty($columns)) {
                $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
                $first_db->query($sql);
            }
            if (!empty($foreign_keys)) {
                foreach ($foreign_keys as $foreign_key) {
                    $sql = "ALTER TABLE $table_name ADD $foreign_key";
                    $first_db->query($sql);
                }
            }
        }
        $first_db->close();
    }
}

if (!function_exists('SecoundDBIdToFieldGetData')) {
    function SecoundDBIdToFieldGetData($fieldname = '', $where, $tablename)
    {
        $db = \Config\Database::connect('second');
        $result_data = array();
        if (!empty($fieldname) && !empty($where)) {
            $sql = 'SELECT ' . $fieldname . ' FROM ' . $tablename . ' WHERE ' . $where;
        } else {
            $sql = 'SELECT * FROM ' . $tablename . ' WHERE ' . $where;
        }
        $result = $db->query($sql);
        if ($result->getNumRows() > 0) {
            $result = $result->getResultArray()[0];
            if (isset($result) && !empty($result)) {
                // if($default_data == 1)
                // {
                $result_data = $result;
                //$result_user_data['fullname'] = $people_array['firstname'] .' '. $people_array['lastname'] ;
                // }
                // else
                // {
                //     $result_user_data['fullname'] = $people_array['firstname'] .' '. $people_array['lastname'] ;
                // }
            }
        }
        // $results = get_object_vars($result[0]);
        return $result_data;
    }
}

if (!function_exists('timezonedata')) {
    function timezonedata()
    {
        $db = \Config\Database::connect('second');
        if (isset($_SESSION['master'])) {
            $cat = $db->query("SELECT * FROM master_user WHERE id =" . $_SESSION['master']);
            $result = $cat->getResultArray();
        }
        if (isset($result[0]['timezone']) && !empty($result[0]['timezone'])) {
            return $result[0]['timezone'];
        } else {
            return 'Asia/Kolkata';
        }
    }
}
if (!function_exists("// pre")) {

    function pre($array)

    {

        echo "<pre>";

        print_r($array);

        echo "<pre>";

    }

}

if (!function_exists('isTableExistsGym')) {
    function isTableExistsGym($tableName)
    {
        $Database = \Config\Database::connect('gym');
        $result = $Database->query("SHOW TABLES LIKE '$tableName'");
        $result = $result->getResult();
        $result = count($result);
        return $result > 0 ? 1 : 0;
    }
}

if (!function_exists('get_session_data')) {

    function get_session_data()

    {

        $session = session();

        return $session->get();

    }

}

if (!function_exists('user_active_or_not')) {

    function user_active_or_not($user_id)

    {

        $db = db_connect();

        $secondDb = \Config\Database::connect('second');

        $query = $secondDb->query('SELECT *  FROM user WHERE id=' . $user_id);

        $get_count = $query->getResultArray();

        if (isset($get_count) && $get_count[0]['switcher_active'] == 'active') {

            return true;

        } else {

            return false;

        }

    }

}



if ( ! function_exists('RemoveSpecialChar'))

{

    function RemoveSpecialChar($str)

    {

        $res = preg_replace('/[0-9\@\.\;\"\'\❤\~\$\']+/', '', $str);

        // $res = str_replace(array("#", "'", ";",), '', $str);

        return $res;

    }

}

if (!function_exists('get_roll_id_to_full_data')) {

    function get_roll_id_to_full_data()

    {

        $user_role_data = array();



        $db = db_connect();

        

        $secondDb = \Config\Database::connect('second');

        $username = session_username($_SESSION['username']);

        $query = $secondDb->query('SELECT * FROM ' . $username . '_userrole');

        $get_user_role_table = $query->getResultArray();

        if (isset($get_user_role_table) && !empty($get_user_role_table)) {

            foreach ($get_user_role_table as $k => $v) {

                $user_role_data[$v['id']] = $v;

            }

        }

        return $user_role_data;

    }

}



// all table 

if (!function_exists('get_table_array_helper')) {

    function get_table_array_helper($table_name = '', $order = 'DESC')

    {

        $array = [];

        if ($table_name != '') {

            $db = db_connect();

            $secondDb = \Config\Database::connect('second');



            $query = $secondDb->query('SELECT * FROM ' . $table_name . ' ORDER BY id ' . $order . '');

           

            $data_array = $query->getResultArray();

            if (isset($data_array) && !empty($data_array)) {

                foreach ($data_array as $k => $v) {

                    $array[$v['id']] = $v;

                }

            }

        }

        return $array;

    }

}



// encryptPass 

if (!function_exists('encryptPass')) {

    function encryptPass($password)

    {

        $sSalt = '$2y$10$1qb2f.Xd9CVpaeozsH2CFeaXSTqxXgq/EHvtkNYoH.zyd7gsIEo7q';

        $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);

        $method = 'aes-256-cbc';

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        $encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));

        return $encrypted;

    }

}



// decryptPass 

if (!function_exists('decryptPass')) {

    function decryptPass($password)

    {

        $sSalt = '$2y$10$1qb2f.Xd9CVpaeozsH2CFeaXSTqxXgq/EHvtkNYoH.zyd7gsIEo7q';

        $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);

        $method = 'aes-256-cbc';

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        $decrypted = openssl_decrypt(base64_decode($password), $method, $sSalt, OPENSSL_RAW_DATA, $iv);

        return $decrypted;

    }

}

if (!function_exists('duplicate_data')) {

    function duplicate_data($data, $table)

    {

        $db = \Config\Database::connect();

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

        $result = $db->query($sql);

        if ($result->getNumRows() > 0) {

            return TRUE;

        } else {

            return FALSE;

        }

    }

}



if (!function_exists('duplicate_data2')) {

    function duplicate_data2($data, $table)

    {

        $db = \Config\Database::connect('second');

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

        $result = $db->query($sql);

        if ($result->getNumRows() > 0) {

            return TRUE;

        } else {

            return FALSE;

        }

    }

}

if (!function_exists('session_username')) {

    function session_username($username)

    {

        if (strpos($username, '_') !== false) {

            $usertable = explode("_", $username);

            $user_name =  $usertable[0];

        } else {

            $user_name =  $username;

        }

        return $user_name;

    }

}

if (!function_exists('IdToFieldGetData')) {

    function IdToFieldGetData($fieldname = '', $where, $tablename)

    {

        $db = \Config\Database::connect();

        $secondDb = \Config\Database::connect('second');

        $result_data = array();

        if (!empty($fieldname) && !empty($where)) {

            $sql = 'SELECT ' . $fieldname . ' FROM ' . $tablename . ' WHERE ' . $where;

        } else {

            $sql = 'SELECT * FROM ' . $tablename . ' WHERE ' . $where;

        }

        $result = $secondDb->query($sql);

        if ($result->getNumRows() > 0) {

            $result = $result->getResultArray()[0];

            if (isset($result) && !empty($result)) {

                // if($default_data == 1)

                // {

                $result_data = $result;

                //$result_user_data['fullname'] = $people_array['firstname'] .' '. $people_array['lastname'] ;

                // }

                // else

                // {

                //     $result_user_data['fullname'] = $people_array['firstname'] .' '. $people_array['lastname'] ;

                // }

            }

        }

        // $results = get_object_vars($result[0]);

        return $result_data;

    }

}



if (!function_exists('created_at_date_convert_indian_date')) {

    function created_at_date_convert_indian_date($date, $format = 'd-m-Y h:i A')

    {

        // Ex - 08-12-2022 05:15 AM

        $formated_date = '';

        if (isset($date)) {

            date_default_timezone_set('Asia/Kolkata');

            $formated_date = date($format, strtotime('+9 hour +30 minutes', strtotime($date)));

            

        }

        return $formated_date;

    }

}

if (!function_exists('followup_date_convert_indian_date')) {

    function followup_date_convert_indian_date($date, $format = 'd-m-Y h:i A')

    {

        // Ex - 08-12-2022 05:15 AM

        $formated_date = '';

        if (isset($date)) {

            date_default_timezone_set('Asia/Kolkata');

            // $covert_second = strtotime($date);

            // $formated_date = date ($format, $covert_second);

            //$formated_date = date($format, strtotime('+12 hour', strtotime($date)));

            $formated_date = date($format, strtotime($date));

            

        }

        return $formated_date;

    }

}







if (!function_exists('inquiry_id_to_full_inquiry_data')) {

    function inquiry_id_to_full_inquiry_data($inquiry_id)

    {



        $result_inquiry_data = array();

        // $inquiry_all_status = get_table_array_helper('inquiry_all_status');

        // if(isset($inquiry_all_status[$inquiry_id]) && !empty($inquiry_all_status[$inquiry_id])){

        //     $result_inquiry_data = $inquiry_all_status[$inquiry_id];

        // }

        // return $result_inquiry_data;

        $username = session_username($_SESSION['username']);

        $db = db_connect();

        $secondDb = \Config\Database::connect('second');



        $query = $secondDb->query('SELECT * FROM ' . $username . '_all_inquiry WHERE id = "' . $inquiry_id . '"');

        $count_num = $query->getNumRows();

        if ($count_num > 0) {

            $result_inquiry_data = $query->getResultArray()[0];

        }

        return $result_inquiry_data;

    }

}



if (!function_exists('inquiry_id_to_get_inquiry_type')) {

    function inquiry_id_to_get_inquiry_type($inquiry_id)

    {

        $result_inquiry_type_data = array(

            'inquirytype'   => ''

        );

        $db = db_connect();

        $inquiry_data = inquiry_id_to_full_inquiry_data($inquiry_id);



        if (isset($inquiry_data) && !empty($inquiry_data) && isset($inquiry_data['inquiry_type']) && !empty($inquiry_data['inquiry_type'])) {

            $query = $db->query('SELECT * FROM master_inquiry_type WHERE inquiry_details = "' . $inquiry_data['inquiry_type'] . '"');



            $count_num = $query->getNumRows();



            if ($count_num > 0) {

                $result_inquiry_data = $query->getResultArray()[0];

                if (isset($result_inquiry_data) && !empty($result_inquiry_data)) {

                    $result_inquiry_type_data = $result_inquiry_data;

                }

            } else {

                $result_inquiry_type_data['inquirytype'] = $inquiry_data['inquiry_type'];

            }

        }

        return $result_inquiry_type_data;

    }

}



if (!function_exists('loacal_date_to_formate_date_type_3')) {

    function loacal_date_to_formate_date_type_3($date, $date_formate = "Y-m-d")

    {

        // Ex - 2022-11-18

        $formated_date = '';

        if (isset($date)) {

            date_default_timezone_set('Asia/Kolkata');

            $covert_second = strtotime($date);

            $formated_date = date($date_formate, $covert_second);

        }

        return $formated_date;

    }

}



if (!function_exists('user_id_to_full_user_data')) {

    function user_id_to_full_user_data($user_id)

    {

        $result_user_data = array();

        $username = session_username($_SESSION['username']);

        //// pre($user_id);



        // die();

        $db = db_connect();

        $secondDb = \Config\Database::connect('second');

        if ($user_id == 0) {

            $query = $secondDb->query('SELECT * FROM master_user WHERE username = "' . trim($username) . '"');

        } else {

            $query = $secondDb->query('SELECT * FROM ' . $username . '_user WHERE id = "' . $user_id . '"');

        }





        $count_num = $query->getNumRows();

        if ($count_num > 0) {

            $result_user_data = $query->getResultArray()[0];

        }

        //    // pre($result_user_data );



        return $result_user_data;

    }

}







if (!function_exists('get_table_array_helper')) {

    function get_table_array_helper($table_name = '', $order = 'DESC')

    {

        $array = [];

        if ($table_name != '') {

            $db = db_connect();

            $secondDb = \Config\Database::connect('second');

            $query = $secondDb->query('SELECT * FROM ' . $table_name . ' ORDER BY id ' . $order . '');

            $data_array = $query->getResultArray();

            if (isset($data_array) && !empty($data_array)) {

                foreach ($data_array as $k => $v) {

                    $array[$v['id']] = $v;

                }

            }

        }

        return $array;

    }

}



/* Note => Status ID to user status name */

if (!function_exists('status_id_to_full_status_data')) {

    function status_id_to_full_status_data($status_id, $need = false)

    {

        if ($need == true) {

            $result_project = '';

            $status = get_table_array_helper('master_inquiry_status');

            if (isset($status[$status_id]) && !empty($status[$status_id])) {

                $result_project = $status[$status_id]['inquiry_status'];

            }

        } else {

            $result_project = array();

            $status = get_table_array_helper('master_inquiry_status');

            if (isset($status[$status_id]) && !empty($status[$status_id])) {

                $result_project = $status[$status_id];

            }

        }

        return $result_project;

    }

}





/* Note => Project id to full Project Data */

if (!function_exists('project_id_to_full_project_data')) {

    function project_id_to_full_project_data($project_id)

    {

        $username = session_username($_SESSION['username']);

        $result_project = array();

        $project = get_table_array_helper($username . '_project');

        if (isset($project[$project_id]) && !empty($project[$project_id])) {

            $result_project = $project[$project_id];

        }

        return $result_project;

    }

}





if (!function_exists('loacal_date_to_formate_date')) {

    function loacal_date_to_formate_date($date)

    {

        // Ex - 05:15 AM 08-12-2022

        $formated_date = '';

        if (isset($date)) {

            date_default_timezone_set('Asia/Kolkata');

            $covert_second = strtotime($date);

            $formated_date = date("h:i A d-m-Y", $covert_second);

        }

        return $formated_date;

    }

}



if (!function_exists("getChildIds")) {

    function getChildIds($parent_id)

    {

        $db = \Config\Database::connect();

        $secondDb = \Config\Database::connect('second');

        $child_ids = array();



        $username = session_username($_SESSION['username']);

        //// pre($username);

        if (strpos($_SESSION['username'], '_') !== false) {

            //// pre($parent_id);

            

            $cat = $secondDb->query("SELECT * FROM " . $username . "_user WHERE head=$parent_id");



            $result = $cat->getResultArray();

            foreach ($result as $key => $row) {

                $child_ids[] = $row['id'];

                $child_ids = array_unique(array_merge($child_ids, getChildIds($row['id'])));

            }

        }

        return $child_ids;

    }

}







if (!function_exists("getStatusWiseData")) {

    function getStatusWiseData($which_result = "" ,$user_id ="",$ajaxsearch_query="")

    {

        

        $db = \Config\Database::connect('second');

        $username = session_username($_SESSION['username']);

        $getchild = '';

       // pre($user_id);

        //  if(empty($user_id)){

        //     // echo "irvisssss";

        //      $user_id = $user_id;

        //  }else{

             //echo "irvi";

           // $getchild = getChildIds($_SESSION['id']);

        //}

        if(!empty($user_id)){

            $user_id = $user_id;

        }else{

            $getchild = getChildIds($_SESSION['id']);

        }

        

       // pre($getchild);

        $newDate = date("Y-m-d");

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {



            if ($which_result == "today") {

                if (!empty($user_id)) {

                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id AND assign_id=" . $user_id . " AND inquiry_cnr = 0 AND i.inquiry_status <> 7 AND  i.inquiry_status <> 8  AND i.inquiry_status <> 12 AND DATE_FORMAT(i.nxt_follow_up,'%Y-%m-%d')=DATE_FORMAT(now(),'%Y-%m-%d') " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";



                } else {

                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id AND inquiry_cnr = 0 AND i.inquiry_status <> 7 AND  i.inquiry_status <> 8  AND i.inquiry_status <> 12 AND DATE_FORMAT(i.nxt_follow_up,'%Y-%m-%d')=DATE_FORMAT(now(),'%Y-%m-%d') " . $ajaxsearch_query . "  GROUP BY inquiry_status DESC";



                }

            } else if ($which_result == "pending") {

                if (!empty($user_id)) {

                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id AND assign_id=" . $user_id . " AND  i.inquiry_status <> 7 AND i.inquiry_status <> 12 AND  i.inquiry_status <> 8 AND STR_TO_DATE(nxt_follow_up, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE('" . $newDate . "', '%Y-%m-%d') " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";



                } else {

                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id AND  i.inquiry_status <> 7 AND i.inquiry_status <> 12 AND  i.inquiry_status <> 8 AND STR_TO_DATE(nxt_follow_up, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE('" . $newDate . "', '%Y-%m-%d') " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";



                }

            } else if ($which_result == "cnr") {
                // echo 'admin 3';
                if (!empty($user_id)) {
                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id AND assign_id=" . $user_id . " AND  inquiry_cnr >= 1  " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";
                } else {
                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id AND  inquiry_cnr >= 1   " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";
                }
            } else {

                if (!empty($user_id)) {

                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE  assign_id=" . $user_id . " AND NOT i.inquiry_status IN ('8','14') " . $ajaxsearch_query . " GROUP BY inquiry_status";



                } else {

                    $sql = "SELECT i.inquiry_status, m.inquiry_status AS inq_status_name,COUNT(*) AS total_inq  FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE NOT i.inquiry_status IN ('8','14') " . $ajaxsearch_query . " GROUP BY inquiry_status";





                }

            }

        } else {

            if (!empty($getchild)) {

                $getchilds = "'" . implode("', '", $getchild) . "'";

            } else {

                $getchilds = "'" . $_SESSION['id'] . "'";

            }

            if ($which_result == "today") {

                if (!empty($user_id)) {

                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id=" . $user_id . " ) AND inquiry_cnr = 0 AND i.inquiry_status <> 7 AND i.inquiry_status <> 12 AND DATE_FORMAT(i.nxt_follow_up,'%Y-%m-%d')=DATE_FORMAT(now(),'%Y-%m-%d')  " . $ajaxsearch_query . "  GROUP BY inquiry_status DESC";



                } else {

                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id=" . $_SESSION['id'] . " ) AND inquiry_cnr = 0 AND i.inquiry_status <> 7 AND i.inquiry_status <> 12 AND DATE_FORMAT(i.nxt_follow_up,'%Y-%m-%d')=DATE_FORMAT(now(),'%Y-%m-%d') " . $ajaxsearch_query . "  GROUP BY inquiry_status DESC";



                }

            } else if ($which_result == "pending") {

                if (!empty($user_id)) {

                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id=" . $user_id . "  ) AND  i.inquiry_status <> 7 AND i.inquiry_status <> 12 AND STR_TO_DATE(nxt_follow_up, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE('" . $newDate . "', '%Y-%m-%d') " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";



                } else {

                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id=" . $_SESSION['id'] . "  ) AND  i.inquiry_status <> 7 AND i.inquiry_status <> 12 AND STR_TO_DATE(nxt_follow_up, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE('" . $newDate . "', '%Y-%m-%d') " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";



                }

            } else if ($which_result == "assign_to_other") {

                $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id AND  i.inquiry_status <> 7 WHERE owner_id=" . $_SESSION['id'] . " AND  assign_id NOT  IN (" . $_SESSION['id'] . ") GROUP BY " . $ajaxsearch_query . " inquiry_status";

            }else if ($which_result == "cnr") {
                if (!empty($user_id)) {
                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id=" . $user_id . " OR assign_id IN (" . $getchilds . ") OR owner_id IN (" . $getchilds . ")  ) AND   inquiry_cnr >= 1  " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";
                } else {
                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id=" . $_SESSION['id'] . " OR assign_id IN (" . $getchilds . ") OR owner_id IN (" . $getchilds . ") ) AND   inquiry_cnr >= 1 " . $ajaxsearch_query . " GROUP BY inquiry_status DESC";
                }
            } else {

                if (!empty($user_id)) {

                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i  JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id=" . $user_id . " ) AND NOT i.inquiry_status IN ('8','14') " . $ajaxsearch_query . "  GROUP BY inquiry_status";

                } else {

                    $sql = "SELECT i.inquiry_status,m.inquiry_status AS inq_status_name, COUNT(*) AS total_inq FROM " . $username . "_all_inquiry i JOIN master_inquiry_status m ON i.inquiry_status = m.id WHERE (assign_id IN (" . $getchilds . ") OR owner_id IN (" . $getchilds . ")) AND NOT i.inquiry_status IN ('8','14') " . $ajaxsearch_query . "  GROUP BY inquiry_status";

                }

            }

        }


        $Getresult = $db->query($sql);

        $inquiry_status_count = $Getresult->getResultArray();

        // pre($inquiry_status_count);



        if (!empty($getchild)) {

            $getchilds = "'" . implode("', '", $getchild) . "'";

        } else {

            $getchilds = "'" . $_SESSION['id'] . "'";

        }

        // echo $getchilds;

        $all_gm_under_people = '';

            $all_gm_under_people = getChildIds($_SESSION['id']);

            $array_push = array_push($all_gm_under_people);

            $all_gm_under_people_implode = "'" . implode ( "', '", $all_gm_under_people) . "'";

        

  

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

            if(!empty($user_id)){

                $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE inquiry_cnr = 1 AND (assign_id=' .  $user_id  . ' )  '.$ajaxsearch_query.' ');

               

            }else{

                 $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE inquiry_cnr = 1  '.$ajaxsearch_query.' ');

            }

        }

        else{

            if(!empty($user_id)){

                $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE   inquiry_cnr = 1 AND (assign_id=' .  $user_id  . ' ) '.$ajaxsearch_query.' ');

                

            }else{

                $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE (assign_id=' . $_SESSION['id'] . ' OR assign_id IN (' . $all_gm_under_people_implode . ')) AND inquiry_cnr = 1 '.$ajaxsearch_query.' ');

            }

        }



        // today and pending cnr count 

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && $which_result  == "today") {

                if(!empty($user_id)){

                    $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE  (assign_id=' .  $user_id  . ' ) AND inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d")=DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

                

                }else{

                    $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d")=DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

                }

           }

           else if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && $which_result  == "pending") {

                if(!empty($user_id)){

                    $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE (assign_id=' .  $user_id  . ' ) AND inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d")<DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

                  

                   }else{

                     $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i WHERE inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up,"%Y-%m-%d")<DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

               

                }

           }

       } else {

           if (!empty($getchild)) {

               $getchilds = "'" . implode("', '", $getchild) . "'";

           } else {

               $getchilds = "'" . $_SESSION['id'] . "'";

           }

           if ($which_result  == "today") {

                if(!empty($user_id)){

                     $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i  WHERE (assign_id = "' . $user_id . '" )

                        AND user_id IN (' . $all_gm_under_people_implode . ') AND inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up, "%Y-%m-%d") = DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

                    }else{

                   

                        $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry as i  WHERE (assign_id = "' . $_SESSION['id'] . '" OR assign_id IN (' . $all_gm_under_people_implode . ') OR owner_id IN (' . $all_gm_under_people_implode . '))

                        AND user_id IN (' . $all_gm_under_people_implode . ') AND inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up, "%Y-%m-%d") = DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

                

                }

           } else if ($which_result  == "pending") {

                if(!empty($user_id)){

                      $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry  as i WHERE (assign_id = "' . $_SESSION['id'] . '" )

                    AND user_id IN (' . $all_gm_under_people_implode . ') AND inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up, "%Y-%m-%d") < DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

                   

                }else{

                   $sqlsss = $db->query('SELECT COUNT(*) AS cnr_inq FROM ' . $username . '_all_inquiry  as i WHERE (assign_id = "' . $_SESSION['id'] . '" OR assign_id IN (' . $all_gm_under_people_implode . ') OR owner_id IN (' . $all_gm_under_people_implode . '))

                    AND user_id IN (' . $all_gm_under_people_implode . ') AND inquiry_cnr = 1 AND DATE_FORMAT(nxt_follow_up, "%Y-%m-%d") < DATE_FORMAT(now(),"%Y-%m-%d") '.$ajaxsearch_query.' ');

                }

           } 

   

       }


       $inquiry_status_cnrtcount = $sqlsss->getResultArray();
       $inquiry_status_count['cnr_count'] = $inquiry_status_cnrtcount[0]['cnr_inq'];
       return $inquiry_status_count;

    }

}


// if (!function_exists('tableCreateAndTableUpdate')) {
//     function tableCreateAndTableUpdate($table_name = "", $duplicate_table = '', $columns = array(), $foreign_keys = array())
//     {
//         $first_db = \Config\Database::connect();
//         if ($first_db->tableExists($table_name) && $table_name != '') {
//             foreach ($columns as $value) {
//                 $value_col_name = explode(' ', $value);
//                 if (!$first_db->fieldExists($value_col_name[0], $table_name) && !empty($value)) {
//                     $sql = "ALTER TABLE $table_name ADD $value "; // add column sql 
//                     $first_db->query($sql);
//                 }
//             }
//             // foreach ($foreign_keys as $foreign_key) {
//             //     $sql = "ALTER TABLE $table_name ADD $foreign_key";
//             //     $first_db->query($sql);
//             // }
//         } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
//             if (!empty($columns)) {
//                 $columnss = implode(",", $columns);
//                 $sql = "CREATE TABLE $table_name ($columnss)";
//                 echo $sql;
//                 $first_db->query($sql);
//             } else {
//                 $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
//                 $first_db->query($sql);
//             }
//         } else {
//             if (!empty($columns)) {
//                 $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
//                 $first_db->query($sql);
//             }
//             if (!empty($foreign_keys)) {
//                 foreach ($foreign_keys as $foreign_key) {
//                     $sql = "ALTER TABLE $table_name ADD $foreign_key";
//                     $first_db->query($sql);
//                 }
//             }
//         }
//         $first_db->close();
//     }
// }



if (!function_exists("userUnderEmployee")) {

    function userUnderEmployee($user_id)

    {

        $db = \Config\Database::connect();

        $secondDb = \Config\Database::connect('second');



        $username = session_username($_SESSION['username']);

        $ids =  array();

        $ids =  implode(",", getChildIds($user_id));

        if (!empty($ids)) {

            $ids =  $ids;

        } else {

            $ids = $user_id;

        }



        // $ids = array_merge($ids,$user_id);

        // if(!empty( $ids)){

        //     $ids =  $ids;

        // }else{

        //     $ids =  $user_id;

        // }

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

            $cat = $secondDb->query("SELECT * , u.id as user_id  FROM " . $username . "_user as u join " . $username . "_userrole as r  on u.role = r.id");

        } else {

            // // pre("SELECT * , u.id as user_id FROM ".$username."_user as u join ".$username."_userrole as r  on u.role = r.id where u.id in (".$ids.")");

            // die();

            $cat = $secondDb->query("SELECT * , u.id as user_id FROM " . $username . "_user as u join " . $username . "_userrole as r  on u.role = r.id where u.id in (" . $ids . ") ");

        }



        $result = $cat->getResultArray();

        return $result;

    }

}

if (!function_exists('get_// previous_link')) {

    function get_previous_link()

    {

        $session = session();

        $link = $session->get('_ci_// previous_url');

        if (!isset($link)) {

            return false;

        } else {

            return true;

        }

    }

}

if (!function_exists('tableCreateAndTableUpdate')) {
    function tableCreateAndTableUpdate($table_name = "", $duplicate_table = '', $columns = array())
    {
        $first_db = \Config\Database::connect('second');
        if ($first_db->tableExists($table_name) && $table_name != '') {
            foreach ($columns as $value) {
                $value_col_name = explode(' ', $value);
                // pre($value_col_name);
                $col_name = str_replace('`','',$value_col_name[0]);
                if (!$first_db->fieldExists($col_name, $table_name) && !empty($value)) {
                    $sql = "ALTER TABLE $table_name ADD $value "; // add column sql 
                    // echo $sql;
                    $first_db->query($sql);
                }
            }
        } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
            if (!empty($columns)) {
                $columnss = implode(",", $columns);
                $sql = "CREATE TABLE $table_name ($columnss)";
                // echo $sql;/
                $first_db->query($sql);
            } else {
                $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
                // echo $sql;
                $first_db->query($sql);
            }
        } else {
            if (!empty($columns)) {
                $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
                // echo $sql;
                $first_db->query($sql);
            }
        }
        $first_db->close();
    }
}
if (!function_exists("getParentidUserrole")) {
    function getParentidUserrole($childId)
    {
        $db = \Config\Database::connect();
        $child_ids = array();
        $username = session_username($_SESSION['username']);
        $cat = $db->query("SELECT * FROM " . $username . "_userrole WHERE parent_id = $childId");
        $result = $cat->getResultArray();
        if (!empty($result)) {
            foreach ($result as $key => $row) {
                $child_ids[] = $row['id'];
                $child_ids = array_unique(array_merge($child_ids, getParentidUserrole($row['id'])));
            }
        }
        return $child_ids;
    }
}
// if (!function_exists('tableCreateAndTableUpdate2')) {
//     function tableCreateAndTableUpdate2($table_name = "", $duplicate_table = '', $columns = array())
//     {
//         $first_db = \Config\Database::connect("second");
//         if ($first_db->tableExists($table_name) && $table_name != '') {
//             foreach ($columns as $value) {
//                 $value_col_name = explode(' ', $value);
//                 $col_name = str_replace('`','',$value_col_name[0]);
//                 if (!$first_db->fieldExists($col_name, $table_name) && !empty($value)) {
//                     $sql = "ALTER TABLE $table_name ADD $value "; // add column sql 
//                     $first_db->query($sql);
//                 }
//             }
//         } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
//             if (!empty($columns)) {
//                 $columnss = implode(",", $columns);
//                 $sql = "CREATE TABLE $table_name ($columnss)";
//                 $first_db->query($sql);
//             } else {
//                 $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
//                 $first_db->query($sql);
//             }
//         } else {
//             if (!empty($columns)) {
//                 $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
//                 $first_db->query($sql);
//             }
//         }
//         $first_db->close();
//     }
// }


if (!function_exists('tableCreateAndTableUpdate2')) {
    function tableCreateAndTableUpdate2($table_name = "", $duplicate_table = '', $columns = array(), $foreign_keys = array())
    {
        $first_db = \Config\Database::connect("second");
        if ($first_db->tableExists($table_name) && $table_name != '') {
            foreach ($columns as $value) {
                $value_col_name = explode(' ', $value);
                if (!$first_db->fieldExists($value_col_name[0], $table_name) && !empty($value)) {
                    $sql = "ALTER TABLE $table_name ADD $value "; // add column sql 
                    $first_db->query($sql);
                }
            }
        } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
            if (!empty($columns)) {
                $columnss = implode(",", $columns);
                $sql = "CREATE TABLE $table_name ($columnss)";
                echo $sql;
                $first_db->query($sql);
            } else {
                $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
                $first_db->query($sql);
            }
        } else {
            if (!empty($columns)) {
                $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
                $first_db->query($sql);
            }
            if (!empty($foreign_keys)) {
                foreach ($foreign_keys as $foreign_key) {
                    $sql = "ALTER TABLE $table_name ADD $foreign_key";
                    $first_db->query($sql);
                }
            }
        }
        $first_db->close();
    }
}



if (!function_exists('get_roll_id_to_roll')) {

    function get_roll_id_to_roll($user_id)

    {

        $db = db_connect();

        $secondDb = \Config\Database::connect('second');

        $username = session_username($_SESSION['username']);

        $query = $secondDb->query('SELECT * FROM ' . $username . '_userrole where id =' . $user_id);

        $get_user_role_table = $query->getResultArray();

        $userroledata = $get_user_role_table[0];

        $exp_value = array();



        // // pre($get_user_role_table);

        //// pre($get_user_role_table['access_page']);

        // $session = session();

        // $role = $session->get('role');

        // $role_data = explode(",",$role);

        // $assign_duty = '';

        // if(@$get_user_role_table)

        // {

        //     $duty_array = array();

        //     foreach ($get_user_role_table as $key => $value) {

        //         if(in_array($value['id'], $role_data)){

        //             $exp_value = explode(",",$value['access_page']);

        //             $duty_array[] = $exp_value;

        //         }

        //     }

        //     if(isset($duty_array) && !empty($duty_array)){

        //         $newArray = array();

        //         foreach($duty_array as $array) {

        //             foreach($array as $k=>$v) {

        //                 $newArray[] = $v;

        //             }

        //         }

        //         $assign_duty = array_values(array_unique($newArray));

        //     }

        // }

        $assign_duty = array();

        if (isset($userroledata['access_page']) && !empty($userroledata['access_page'])) {

            $exp_value = explode(",", $userroledata['access_page']);

            // $assign_duty =  $userroledata['access_page'];



        }

        return $exp_value;

    }

}



if (!function_exists('get_booked_unit_id_depend_project_id')) {

    function get_booked_unit_id_depend_project_id($project_id = '', $table_name)

    {

        $valid_unit_id = array();

        if (isset($project_id) && !empty($project_id)) {

            $db = db_connect();

            $query = $db->query('SELECT * FROM ' . $table_name . ' WHERE project_name = "' . $project_id . '"');

            $get_booking_list = $query->getResultArray();

            if (isset($get_booking_list) && !empty($get_booking_list)) {

                foreach ($get_booking_list as $key => $value) {

                    if (isset($value['unitno']) && !empty($value['unitno'])) {

                        $valid_unit_id[] = $value['unitno'];

                    }

                }

            }

        }

        return $valid_unit_id;

    }

}



if (!function_exists('getDatesFromRange')) {

    function getDatesFromRange($start, $end, $format = 'Y-m-d')

    {



        // Declare an empty array

        $array = array();



        // Variable that store the date interval

        // of period 1 day

        $interval = new DateInterval('P1D');



        $realEnd = new DateTime($end);

        $realEnd->add($interval);



        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);



        // Use loop to store date into array

        foreach ($period as $date) {

            $array[] = $date->format($format);

        }



        // Return the array elements

        return $array;

    }

}







if (!function_exists('get_user_count_inquiry_dataa')) {

    function get_user_count_inquiry_dataa($user_id = '', $countwise = '', $table_name = '')

    {



        

        if ($user_id != '') {

            $username = session_username($_SESSION['username']);



            $table_name = $username . '_all_inquiry';

            $user_id = $_SESSION['id'];

            $countwise = $_POST['countwise'];

            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

                $sql = "SELECT * FROM $table_name WHERE user_id  ORDER BY id DESC";

            } else {

                $all_gm_under_people = '';

                $all_gm_under_people = getChildIds($_SESSION['id']);

                $array_push = array_push($all_gm_under_people, $user_id);

                $all_gm_under_people_implode = "'" . implode("', '", $all_gm_under_people) . "'";



                $sql = 'SELECT * FROM ' . $table_name . ' WHERE user_id IN (' . $all_gm_under_people_implode . ') ORDER BY id DESC';

            }



            $date = date("Y-m-d");

            $result_array = array();

            $db_connection = \Config\Database::connect('second');

            $result = $db_connection->query($sql);

            $followup_data = $result->getResultArray();

            $getchild = array();

            $getchild = getChildIds($_SESSION['id']);

            if (!empty($getchild)) {

                array_push($getchild, $_SESSION['id']);

            } else {

                $getchild[] = $_SESSION['id'];

            }

            $getchild = implode(",", $getchild);



            $username = session_username($_SESSION['username']);

            $getQuery = '';

            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

                $getQuery = '';

            } else {

                $getQuery = ' AND (all_inquiry.assign_id=' . $_SESSION['id'] . '  OR  all_inquiry.assign_id IN (' . $getchild . ') OR all_inquiry.owner_id IN (' . $getchild . ') ) ';

            }

            $full_name = $username . '_all_inquiry';

            $full_name_book =$username . '_booking';

            if (isset($countwise) && !empty($countwise)) {



                if ($countwise == "year") {

                    $year = "SELECT IFNULL(inquiry_count1.count, 0) AS appoiment, IFNULL(inquiry_count2.count, 0) AS booking,IFNULL(inquiry_count5.count, 0) AS cancle_booking,IFNULL(inquiry_count3.count, 0) AS visit,IFNULL(inquiry_count4.count, 0) AS inquiry, calendar.year

                    FROM (

                        SELECT YEAR(DATE_SUB(CURDATE(), INTERVAL 6 YEAR)) + year_number AS year

                        FROM (

                            SELECT 0 AS year_number UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6

                        ) AS years

                    ) AS calendar

                    LEFT JOIN (

                        SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y') AS year

                        FROM $full_name AS all_inquiry

                        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 YEAR) $getQuery

                          AND isAppoitement = 3

                        GROUP BY year

                    ) AS inquiry_count1 ON calendar.year = inquiry_count1.year

                    LEFT JOIN (

                        SELECT COUNT(booking.id) AS count, DATE_FORMAT(all_inquiry.created_at, '%Y') AS year

                        FROM $full_name AS all_inquiry

                         INNER JOIN $full_name_book AS booking  ON all_inquiry.id = booking.inquiry_id

                       WHERE all_inquiry.created_at >= DATE_SUB(CURDATE(), INTERVAL 6 YEAR) $getQuery

                             AND all_inquiry.inquiry_status = 12 AND booking.cancle_booking=0

                        GROUP BY year

                    ) AS inquiry_count2 ON calendar.year = inquiry_count2.year

                     LEFT JOIN (

                        SELECT COUNT(booking.id) AS count, DATE_FORMAT(booking.booking_date, '%Y') AS year

                        FROM $full_name AS all_inquiry

                         INNER JOIN $full_name_book AS booking  ON all_inquiry.id = booking.inquiry_id

                       WHERE booking.booking_date >= DATE_SUB(CURDATE(), INTERVAL 6 YEAR) $getQuery

                             AND all_inquiry.inquiry_status = 12 AND booking.cancle_booking=1

                        GROUP BY year

                    ) AS inquiry_count5 ON calendar.year = inquiry_count5.year

                     

                    LEFT JOIN (

                        SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y') AS year

                        FROM $full_name AS all_inquiry

                        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 YEAR) $getQuery

                          AND isSiteVisit = 1 OR isSiteVisit = 2

                        GROUP BY year

                    ) AS inquiry_count3 ON calendar.year = inquiry_count3.year

                    LEFT JOIN (

                        SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y') AS year

                        FROM $full_name AS all_inquiry

                        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 YEAR) $getQuery

                          

                        GROUP BY year

                    ) AS inquiry_count4 ON calendar.year = inquiry_count4.year

                   

                    ORDER BY calendar.year DESC";





                    $db = \Config\Database::connect('second');

                    $Getresult = $db->query($year);

                    $result_array1 = $Getresult->getResultArray();

                    $result_array = array_reverse($result_array1);



                    // pre($year);

                }



                if ($countwise == "week") {

                    $week = "

                    SELECT

                    IFNULL(inquiry_count1.count, 0) AS appointment,

                    IFNULL(inquiry_count2.count, 0) AS booking,

                    IFNULL(inquiry_count5.count, 0) AS cancle_booking,

                    IFNULL(inquiry_count3.count, 0) AS visit,

                    IFNULL(inquiry_count4.count, 0) AS inquiry,

                    calendar.day

                    FROM

                        (

                            SELECT DATE_SUB(CURDATE(), INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY) AS day

                            FROM

                                (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) AS a

                                CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) AS b

                                CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) AS c

                        ) AS calendar

                    LEFT JOIN (

                        SELECT

                            COUNT(id) AS count,

                            DATE(created_at) AS day

                        FROM

                            $full_name AS all_inquiry

                        WHERE

                            created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) $getQuery

                            AND isAppoitement = 1

                        GROUP BY

                            day

                    ) AS inquiry_count1 ON calendar.day = inquiry_count1.day

                    LEFT JOIN (

                        SELECT

                            COUNT(booking.id) AS count,

                            DATE(booking.booking_date) AS day

                        FROM $full_name AS all_inquiry

                        INNER JOIN $full_name_book AS booking  ON all_inquiry.id = booking.inquiry_id

                        WHERE

                            all_inquiry.created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) $getQuery

                            AND all_inquiry.inquiry_status = 12 AND booking.cancle_booking=0

                        GROUP BY

                            day

                    ) AS inquiry_count2 ON calendar.day = inquiry_count2.day

                    LEFT JOIN (

                        SELECT

                            COUNT(booking.id) AS count,

                            DATE(booking.booking_date) AS day

                        FROM $full_name AS all_inquiry

                        INNER JOIN $full_name_book AS booking  ON all_inquiry.id = booking.inquiry_id

                        WHERE

                            all_inquiry.created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) $getQuery

                            AND all_inquiry.inquiry_status = 12 AND booking.cancle_booking=1

                        GROUP BY

                            day

                    ) AS inquiry_count5 ON calendar.day = inquiry_count5.day

                   

                    LEFT JOIN (

                        SELECT

                            COUNT(id) AS count,

                            DATE(created_at) AS day

                        FROM

                            $full_name AS all_inquiry

                        WHERE

                            created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) $getQuery

                            AND isSiteVisit = 1 OR isSiteVisit = 2

                        GROUP BY

                            day

                    ) AS inquiry_count3 ON calendar.day = inquiry_count3.day

                    LEFT JOIN (

                        SELECT

                            COUNT(id) AS count,

                            DATE(created_at) AS day

                        FROM

                            $full_name AS all_inquiry

                        WHERE

                            created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) $getQuery

                        GROUP BY

                            day

                    ) AS inquiry_count4 ON calendar.day = inquiry_count4.day

                    WHERE

                        calendar.day >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 

                    ORDER BY

                        calendar.day DESC;

                    ";



                        $db = \Config\Database::connect('second');

                        $Getresult = $db->query($week);

                        $result_array1 = $Getresult->getResultArray();

                        $result_array = array_reverse($result_array1);

                }



                if ($countwise == "month") {

                    $month = "SELECT IFNULL(inquiry_count1.count, 0) AS appoiment,

                             IFNULL(inquiry_count2.count, 0) AS booking,

                             IFNULL(inquiry_count5.count, 0) AS cancle_booking,

                             IFNULL(inquiry_count3.count, 0) AS visit,

                             IFNULL(inquiry_count4.count, 0) AS inquiry,

                             calendar.month

                             FROM (

                                 SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 5  - month_number  MONTH),'%Y-%m') AS month

                                 FROM (

                                     SELECT 0 AS month_number UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5

                                 ) AS months

                             ) AS calendar

                             LEFT JOIN (

                                 SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y-%m') AS month

                                 FROM $full_name AS all_inquiry

                                 WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)$getQuery

                                     AND isAppoitement = 1

                                 GROUP BY month

                             ) AS inquiry_count1 ON calendar.month = inquiry_count1.month

                             LEFT JOIN (

                                 SELECT COUNT(booking.id) AS count, DATE_FORMAT(booking.booking_date, '%Y-%m') AS month

                                 FROM $full_name AS all_inquiry

                                 INNER JOIN $full_name_book AS booking  ON all_inquiry.id = booking.inquiry_id

                                 WHERE booking.booking_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) $getQuery

                                     AND booking.cancle_booking=0

                                 GROUP BY month

                             ) AS inquiry_count2 ON calendar.month = inquiry_count2.month

                             LEFT JOIN (

                                 SELECT COUNT(booking.id) AS count, DATE_FORMAT(booking.booking_date, '%Y-%m') AS month

                                 FROM $full_name AS all_inquiry

                                 INNER JOIN $full_name_book AS booking  ON all_inquiry.id = booking.inquiry_id

                                 WHERE booking.booking_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) $getQuery

                                     AND booking.cancle_booking=1

                                 GROUP BY month

                             ) AS inquiry_count5 ON calendar.month = inquiry_count5.month

                             LEFT JOIN (

                                 SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y-%m') AS month

                                 FROM $full_name AS all_inquiry

                                 WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)$getQuery

                                     AND isSiteVisit = 1 OR isSiteVisit = 2

                                 GROUP BY month

                             ) AS inquiry_count3 ON calendar.month = inquiry_count3.month

                             LEFT JOIN (

                                 SELECT COUNT(id) AS count, DATE_FORMAT(created_at, '%Y-%m') AS month

                                 FROM $full_name AS all_inquiry

                                 WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)$getQuery

                                 GROUP BY month

                             ) AS inquiry_count4 ON calendar.month = inquiry_count4.month

                             ORDER BY calendar.month DESC";

                        $db = \Config\Database::connect('second');

                        $Getresult = $db->query($month);

                        $result_array1 = $Getresult->getResultArray();

                        $result_array = array_reverse($result_array1);

                }

            } else {

                $countwise = "";

            }

            return $result_array;

        }

    }

    
if (!function_exists('tableCreateAndTableUpdate')) {
    function tableCreateAndTableUpdate($table_name = "", $duplicate_table = '', $columns = array(), $foreign_keys = array())
    {
        $first_db = \Config\Database::connect('second');
        if ($first_db->tableExists($table_name) && $table_name != '') {
            foreach ($columns as $value) {
                $value_col_name = explode(' ', $value);
                if (!$first_db->fieldExists($value_col_name[0], $table_name) && !empty($value)) {
                    $sql = "ALTER TABLE $table_name ADD $value "; // add column sql 
                    $first_db->query($sql);
                }
            }
            // foreach ($foreign_keys as $foreign_key) {
            //     $sql = "ALTER TABLE $table_name ADD $foreign_key";
            //     $first_db->query($sql);
            // }
        } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
            if (!empty($columns)) {
                $columnss = implode(",", $columns);
                $sql = "CREATE TABLE $table_name ($columnss)";
                echo $sql;
                $first_db->query($sql);
            } else {
                $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
                $first_db->query($sql);
            }
        } else {
            if (!empty($columns)) {
                $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
                $first_db->query($sql);
            }
            if (!empty($foreign_keys)) {
                foreach ($foreign_keys as $foreign_key) {
                    $sql = "ALTER TABLE $table_name ADD $foreign_key";
                    $first_db->query($sql);
                }
            }
        }
        $first_db->close();
    }
}

if (!function_exists('countdata_userwise_any_table'))

{

    function countdata_userwise_any_table($table_name = '' , $user_id='')

    {



        $all_data = array(

            "broker" => 0,

            "investor" => 0,

            "customer" => 0,



        );

     



        if($user_id != '' ){

            // $tableName = 'urvi_broker';

            $table_name = $table_name;

            $username = session_username($_SESSION['username']);

            // $full_table_name = $table_name+$username; 

            $broker = 0;

		    $db_connection = \Config\Database::connect();

            $secondDb = \Config\Database::connect('second');



        //    $departmentdisplaydata = get_table_array_helper($table_name);

        //     $broker = get_table_array_helper('urvi_broker');

        //     $investor = get_table_array_helper('builder');

            // pre($_SESSION);

            // die();



            if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){

               $qry= "SELECT COUNT(id) AS count FROM ". $table_name;

              }

              else{

               

                $all_gm_under_people = '';

                $all_gm_under_people = getChildIds($_SESSION['id']);      

                $all_gm_under_people_implode = "'" . implode ( "', '", $all_gm_under_people ) . "'";

               $qry= "SELECT COUNT(id) AS count  FROM $table_name WHERE user_id IN ($all_gm_under_people_implode)";

                // pre($qry);

              }

              $result = $secondDb->query($qry);

              

              if($result->getNumRows() > 0)

              {

                $rowCount = $result->getNumRows();

			    $all_data = $result->getResultArray();

                // pre($all_data);

      

              }

            return $all_data;



     

        }

            

            

    }

}

}







if (!function_exists('demo_and_subscription_count'))

{

    function demo_and_subscription_count($table_name = '' , $user_id='')

    {



        $all_data = array(

            "visit" => 0,

            "revisit" => 0,

            // "customer" => 0,



        );

            // $username = session_username($_SESSION['username']);

     



        if($user_id != '' ){

          

            $username = session_username($_SESSION['username']);

         

            $broker = 0;

		    $db_connection = \Config\Database::connect('second');







            if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){

               $qry = 'SELECT COUNT(id) AS count FROM ' . $username . '_all_inquiry WHERE  inquiry_status = 4';

               $qry2= 'SELECT COUNT(id) AS revisit FROM  '.$username .'_all_inquiry WHERE  inquiry_status != 7

               AND inquiry_status = 11';



            } else {

                $all_gm_under_people = '';

                $all_gm_under_people = getChildIds($_SESSION['id']);

                $array_push = array_push($all_gm_under_people, $user_id);

                $all_gm_under_people_implode = "'" . implode("', '", $all_gm_under_people) . "'";



               $qry = "SELECT COUNT(id) AS count

                FROM " . $username . "_all_inquiry

                WHERE inquiry_status = 4

                

                  

                  AND (assign_id = " . $_SESSION['id'] . " OR assign_id IN (" . $all_gm_under_people_implode . ") OR owner_id IN (" . $all_gm_under_people_implode . "))

                  AND user_id IN (" . $all_gm_under_people_implode . ")";

        

                  $qry2 = "SELECT COUNT(id) AS revisit 

                  FROM " . $username . "_all_inquiry

                  WHERE isSiteVisit = 2

                    AND inquiry_status != 7

                    AND inquiry_status = 11

                    AND (assign_id = " . $_SESSION['id'] . " OR assign_id IN (" . $all_gm_under_people_implode . ") OR owner_id IN (" . $all_gm_under_people_implode . "))

                    AND user_id IN (" . $all_gm_under_people_implode . ")";



                // pre($qry);

              }

              $result = $db_connection->query($qry);

              

              if($result->getNumRows() > 0)

              {

                $rowCount = $result->getNumRows();

			    $all_data = $result->getResultArray();

                // pre($all_data);

      

              }



              $result2 = $db_connection->query($qry2);

              if($result2->getNumRows() > 0)

              {

                $rowCount = $result2->getNumRows();

			    $all_data2 = $result2->getResultArray();

                $all_data[0]['all_data2']=$all_data2; 

                // pre($all_data);

      

              }



            return $all_data;

            



     

        }

            

            

    }

}



if (!function_exists('booking_count')) {

    function booking_count($table_name = '', $user_id = '')

    {



        $all_data = array(

            "by_sse_count" => 0,

            "by_ssm_count" => 0,

            // "customer" => 0,



        );

        // $username = session_username($_SESSION['username']);





        if ($user_id != '') {



            $username = session_username($_SESSION['username']);



            $broker = 0;

            $db_connection = \Config\Database::connect('second');

            $user_id = $_SESSION['id'];





            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

                $qry = "SELECT COUNT(id) AS booking FROM " . $username . "_booking WHERE cancle_booking = 0";



            }

            //    die();

            else {

                //    pre($_SESSION);



                $all_gm_under_people = '';

                $all_gm_under_people = getChildIds($_SESSION['id']);

                $array_push = array_push($all_gm_under_people, $user_id);

                $all_gm_under_people_implode = "'" . implode("', '", $all_gm_under_people) . "'";

                // pre($all_gm_under_people_implode);

                // $qry = "SELECT COUNT(id) AS booking_count

                // FROM ".$username."_booking

                // WHERE user_id IN (" . $all_gm_under_people_implode . ") AND by_ssm = '".$_SESSION['id']."'";

                $qry = "SELECT

                (

                    SELECT COUNT(id) FROM " . $username . "_booking 

                    WHERE cancle_booking = 0 AND  (assign_id = " . $_SESSION['id'] . " OR assign_id IN (" . $all_gm_under_people_implode . ") OR owner_id IN (" . $all_gm_under_people_implode . "))

                    AND user_id IN (" . $all_gm_under_people_implode . ")

                ) AS booking";



            }

            //   pre($qry);

            $result = $db_connection->query($qry);



            if ($result->getNumRows() > 0) {

                $rowCount = $result->getNumRows();

                $all_data = $result->getResultArray();

                // pre($all_data);



            }



            return $all_data;

        }

    }

}

if (!function_exists('get_editData2')) {
    function get_editData2($table, $edit_id)
    {
        $db = \Config\Database::connect('second');
        $query = "SELECT * from  $table WHERE id = $edit_id";
        $cat = $db->query($query);
        $result = $cat->getRowArray();
        return $result;
    }
}



if (!function_exists('timezone')) {
    function timezone($formate = "Y-m-d")
    {
        if (isset($_SESSION['timezone']) && !empty($_SESSION['timezone'])) {
            $timezone = $_SESSION['timezone'];
        } else {
            $timezone = "Asia/Kolkata";
        }
        $timezones = array();
        $db_connection = \Config\Database::connect();
        $timezone = new \DateTimeZone($timezone);
        // $db_connection->query("SET time_zone='" . $timezone->getName() . "'");
        // Get the current date in Asia/Kolkata time zone
        $currentDate = new \DateTime('now', $timezone);
        $currentDateFormatted = $currentDate->format($formate);
        $timezones['zone'] = $timezone->getName();
        $timezones['formate'] = $currentDateFormatted;
        return $timezones;
    }
}

if (!function_exists('UtcTime')) {
    function UtcTime($formate = "", $timezone = "", $date = "")
    {
        // This Function is Use For The Date Insert In to tha database
        // This Function is Convert The Date Curunt Timezone to UTC
        $targetTimeZone = new \DateTimeZone($timezone);
        $currentTime = date('H:i:s');
        if(!preg_match("/H/", $formate) && !preg_match("/i/", $formate) && !preg_match("/s/", $formate)){
            $dateTime = new \DateTime($date.' '.$currentTime, $targetTimeZone);
        } else {
            $dateTime = new \DateTime($date, $targetTimeZone);
        }
        $utcTimeZone = new \DateTimeZone('UTC');
        $dateTime->setTimezone($utcTimeZone);
        // This Function Is Return The The date UTC Wise
        if (!empty($formate)) {
            return $dateTime->format($formate);
        } else {
            return $dateTime->format('Y-m-d H:i');
        }
    }
}

if (!function_exists('Utctodate')) {
    function Utctodate($formate = "", $timezone = "", $date = "")
    {
        // This Function is Use For The Get Date From database
        // This Function is Convert The Date UTC To Curunt Timezone
        $utcTimeZone = new \DateTimeZone('UTC');
        $dateTime = new \DateTime($date, $utcTimeZone);
        $targetTimeZone = new \DateTimeZone($timezone);
        $dateTime->setTimezone($targetTimeZone);
        // This Function Is Return The The date Curunt Timezone Wise
        if (!empty($formate)) { 
            return $dateTime->format($formate);
        } else {
            return $dateTime->format('Y-m-d H:i');
        }

    }
}

if (!function_exists('any_id_to_full_data')) {

    function any_id_to_full_data($table,$user_id)

    {

        $result_user_data = array();

        $username = session_username($_SESSION['username']);

        //// pre($user_id);



        // die();

        $db = \Config\Database::connect('second');

        if ($user_id == 0) {

            $query = $db->query('SELECT * FROM master_user WHERE username = "' . trim($username) . '"');

        } else {

            $query = $db->query('SELECT * FROM ' . $table . ' WHERE id = "' . $user_id . '"');

        }





        $count_num = $query->getNumRows();

        if ($count_num > 0) {

            $result_user_data = $query->getResultArray()[0];

        }

        //    // pre($result_user_data );



        return $result_user_data;

    }

}

if(!function_exists('getTimeDifference')) {
    function getTimeDifference($targetTime) {
        // Create DateTime objects for current time and target time
        $currentTime = new DateTime();
        $targetDateTime = new DateTime($targetTime);
    
        // Calculate the difference
        $interval = $currentTime->diff($targetDateTime);
    
        // Get the difference in hours, minutes, and days
        $hours = $interval->h + $interval->d * 24;
        $minutes = $interval->i;
        $days = $interval->days;
    
        // // If minutes exceed 60, adjust hours and minutes
        // if ($minutes >= 60) {
        //     $hours += floor($minutes / 60);
        //     $minutes %= 60;
        // }
    
        // // If hours exceed 24, adjust days and hours
        // if ($hours >= 24) {
        //     $days += floor($hours / 24);
        //     $hours %= 24;
        // }
    
        return array('hours' => $hours, 'minutes' => $minutes, 'days' => $days);
    }
}


function getAllDatesInCurrentMonth()
{
    $currentMonth = date('m');
    $currentYear = date('Y');
    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    $dates = [];
    for ($day = 1; $day <= $numberOfDays; $day++) {
        $formattedDate = sprintf("%02d", $day); // Format the day as two digits (e.g., 01, 02, 03)
        $dates[] = $formattedDate;
    }
    return $dates;
}

if (!function_exists('getCustomMonthDays')) {
    function getCustomMonthDays($year, $month, $format = 'Y-m-d')
    {
        if (!empty($year) && !empty($month) && $month != 'undefined' && $year != 'undefined') {
            $days = array();
            $date = new DateTime();
            $date->setDate($year, $month, 1);
            $lastDay = (int) $date->format('t');
            for ($day = 1; $day <= $lastDay; $day++) {
                $date->setDate($year, $month, $day);
                $days[] = $date->format($format);
            }
            return $days;
        }
    }
}

function getGeneraleData()
{
    $db_connection = \Config\Database::connect('second');
    $query = "SELECT * FROM admin_generale_setting WHERE id IN(1)";
    $rows = $db_connection->query($query);
    $result = $rows->getResult();
    if (isset($result[0])) {
        $settings_data = get_object_vars($result[0]);
    } else {
        $settings_data = array();
    }
    return $settings_data;
}

function getConnectionData($id)
{ 
    $table_username = session_username($_SESSION['username']);
    $db_connection = \Config\Database::connect('second');
    $query = "SELECT * FROM ".$table_username."_platform_integration WHERE id=".$id;
    $rows = $db_connection->query($query);
    $result = $rows->getResult();
    if (isset($result[0])) {
        $settings_data = get_object_vars($result[0]);
    } else {
        $settings_data = array();
    }
    return $settings_data;
}

function getSocialData($url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
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
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}


function postSocialData($url, $JsonData){
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


function WhatsAppConnectionCheck(){
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
    if(isset($settings_data) && !empty($settings_data)){
        if (isset($settings_data['whatapp_phone_number_id']) && isset($settings_data['whatapp_business_account_id']) && isset($settings_data['whatapp_access_token']) && !empty($settings_data['whatapp_phone_number_id']) && !empty($settings_data['whatapp_business_account_id']) && !empty($settings_data['whatapp_access_token']) && $settings_data['whatapp_phone_number_id'] != '0' && $settings_data['whatapp_business_account_id'] != '0') {
            $url = 'https://graph.facebook.com/v19.0/'.$settings_data['whatapp_business_account_id'].'/?access_token='.$settings_data['whatapp_access_token'];
            $DataArray =  getSocialData($url);
            if(isset($DataArray) && !empty($DataArray)){
                if(isset($DataArray['id']) && !empty($DataArray['id'])){
                    if(isset($DataArray['name'])){
                        $ConnectionName = $DataArray['name'];
                    }   
                    $ConnectionStatus = 1;
                }else{
                    if(isset($DataArray['error'])){
                        if(isset($DataArray['error']['message'])){
                            $Error = $DataArray['error']['message'];
                            $ConnectionStatus = 2;
                        }
                    }
                }
            }
        }
    }
    $ReturnArray['ConnectionName'] = $ConnectionName;
    $ReturnArray['ConnectionStatus'] = $ConnectionStatus;
    $ReturnArray['Error'] = $Error;
    $ReturnArray = json_encode($ReturnArray);
    return $ReturnArray;
}


function deleteSocialData($url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',  // Set the request method to DELETE
        CURLOPT_HTTPHEADER => array(
            'Cookie: fr=07Ds3K9rxHgvySJql..Bk0it9.VP.AAA.0.0.Bk0iu5.AWV1ZxCk_bw'
            // Add any other headers if needed
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

function fb_page_list($access_token)
{
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
            $result_array['response'] = 1;
            $result_array['message'] = 'Facebook connected successfully..!';
        } else {
            $result_array['response'] = 0;
            $result_array['message'] = $errorMsg;
        }

        $result_array['page_list'] = $result['data'];
    } else {
        $is_facebook_connect = 0;
        $result_array['response'] = 0;
        $result_array['message'] = $errorMsg;
        $result_array['page_list'] = '';
    }
    

    return json_encode($result_array, true);
}
function fb_insta_page_list($access_token)
{
    $result = getSocialData('https://graph.facebook.com/v19.0/me/accounts?access_token=' . $access_token.'&field=ccess_token&field=access_token&field=,access_token&fields=instagram_business_account{id,username},access_token,name,id');
   
    $errorMsg = 'Something Went wrong..!';
    if (isset($result['error']['message'])) {
        $errorMsg = $result['error']['message'];
    }
    $result_array['response'] = 0;
    $result_array['message'] = $errorMsg;

    if (isset($result['data']) && is_array($result['data']) && $result['data'] != '') {
        $numberOfPages = count($result['data']);
        if ($numberOfPages > 0) {
            $result_array['response'] = 1;
            $result_array['message'] = 'Facebook connected successfully..!';
        } else {
            $result_array['response'] = 0;
            $result_array['message'] = $errorMsg;
        }

        $result_array['page_list'] = $result['data'];
    } else {
        $is_facebook_connect = 0;
        $result_array['response'] = 0;
        $result_array['message'] = $errorMsg;
        $result_array['page_list'] = '';
    }
    

    return json_encode($result_array, true);
}



function fb_page_img($page_id,$access_token)
{
    if($page_id && $access_token)
    {
        $response_pictures = getSocialData('https://graph.facebook.com/v19.0/' . $page_id . '/picture?redirect=false&&access_token=' . $access_token . '');
        $result_array['page_img'] = $response_pictures['data']['url'];
    }
    else
    {
        $result_array['page_img'] = '';
    }

    return json_encode($result_array, true);
}
