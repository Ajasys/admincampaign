<?php
namespace App\Controllers;

//use CodeIgniter\Database\ConnectionInterface;
use App\Models\MasterInformationModel;
use Config\Database;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;


class FaceBookController extends BaseController
{
    //private $db;

    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->db = \Config\Database::connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = session_username($_SESSION["username"]);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }

    function check_fb_connection()
    {
        // pre($_POST);
        $this->db = \Config\Database::connect();
        $action = $this->request->getPost("action");
        $access_token = $this->request->getPost("access_token");

        // $result = getFacebookData('https://graph.facebook.com/v19.0/me/accounts', $access_token);
        $url = 'https://graph.facebook.com/v19.0/me/accounts?access_token=' . $access_token;

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
        $result = json_decode($response, true);
        print_r($result);
        $result_array['response'] = 0;
        $result_array['message'] = isset($result['error']['message']);

        if(isset($result['data']) && is_array($result['data']) && $result['data']!='')
        {
            // print_r($result['data']);
            $numberOfPages = count($result['data']);
            // print_r($numberOfPages);
            if($numberOfPages>0)
            {
                $ColumnSocialMediaIntegrationData = [
                    "facebook_access_token longtext COLLATE utf8mb4_unicode_ci NOT NULL",
                ];
                tableCreateAndTableUpdate2('admin_generale_setting', '', $ColumnSocialMediaIntegrationData);
                
                $update_data['facebook_access_token'] = $access_token;
                $departmentUpdatedata = $this->MasterInformationModel->update_entry2(1, $update_data, 'admin_generale_setting');
                
                $result_array['response'] = 1;
                $result_array['message'] = 'Facebook connected successfully..!';
        
            }
        
        }

        echo json_encode($result_array, true);
        die();
    }
}
