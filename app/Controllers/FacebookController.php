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

        $result = getFacebookData('https://graph.facebook.com/v19.0/me/accounts', $access_token);
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