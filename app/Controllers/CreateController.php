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
    
    public function create_insert_data()
    {
        // pre($_POST);

        $session = session();
        
        $post_data = $this->request->getPost();
        $table_name = $post_data["table"];
        $action_name = $post_data["action"];
    
    
        if ($action_name == "create_insert") {
            unset($post_data['action']);
            unset($post_data['table']);
    
            if (!empty($post_data)) {
                $insert_data = $post_data;
                $isduplicate = $this->duplicate_data2($insert_data, $table_name);
                
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
}
