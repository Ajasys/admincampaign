<?php
namespace App\Controllers;
use App\Models\MasterInformationModel;
use Config\Database;
use DateTime;
use DateTimeZone;
class CreateController extends BaseController
{
    protected $db;
    public function __construct()
    {
        helper('custom');
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $session = session();
        $this->username = session_username($session->get('username'));
        $this->admin = 0;
        if ($session->has('admin') && !empty($session->get('admin'))) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }

    public function SendPostDataFB() {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the message and attachment from the form data
            $event_address = $_POST['event_address'];
            $attachment = $_FILES['attachment'];
    
            // Construct the URL for the Facebook Graph API endpoint
            $page_id = '196821650189891';
            $access_token='EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';

            // Initialize cURL session
            $curl = curl_init();
    
            // Set the file as multipart/form-data
            $file_data = array(
                'attachment' => curl_file_create($attachment['tmp_name'], $attachment['type'], $attachment['name'])
            );
    
            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v19.0/' . $page_id . '/photos',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array_merge($file_data, array(
                    'access_token' => $access_token,
                    'caption' => $event_address // Message to be posted
                )),
            ));
    
            // Execute the POST request
            $response = curl_exec($curl);
    
            // Check for errors
            if ($response === false) {
                // Handle cURL error
                $error = curl_error($curl);
                echo "cURL Error: " . $error;
            } else {
                // Post successful
                echo "Post sent successfully.";
            }
    
            // Close cURL session
            curl_close($curl);
        } else {
            // Handle non-POST requests
            // You might want to return an error response or handle it according to your application's logic
        }
    }

    
    
    // public function SendPostDataFB(){
    //     // pre('Dishant');
    //     $url = 'https://graph.facebook.com/v19.0/196821650189891/photos/?access_token=EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';
    //     $json = '{
         

                  
    //     }';
    //     $res = postSocialData($url, $json);
    //     // pre($res);
    // }
    
    
    public function create_insert_data()
    {
        $session = session();
        
        $post_data = $this->request->getPost();
        $table_name = $post_data["table"];
        $action_name = $post_data["action"];
    
        if ($action_name == "create_insert") {
            unset($post_data['action']);
            unset($post_data['table']);
    
            if (!empty($post_data)) {
                $insert_data = $post_data;
                $isduplicate = $this->duplicate_data($insert_data, $table_name);
                
                if ($isduplicate == 0) {
                    $response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
                    $insert_displaydata = $this->MasterInformationModel->display_all_records2($table_name);
                    $insert_displaydata = json_decode($insert_displaydata, true);
                    return 0;
                } else {
                    return 1;
                }
            }
        }
    }

    public function duplicate_data($data, $table_name)
    {
        // Your duplicate data checking logic here
    }
}
