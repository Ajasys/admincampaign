<?php

namespace App\Controllers;

//use CodeIgniter\Database\ConnectionInterface;
use App\Models\MasterInformationModel;
use Config\Database;
class EmailController extends BaseController
{
    //private $db;
    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->db = \Config\Database::connect('second');
        $this->MasterInformationModel = new MasterInformationModel($db);
        session();
        $this->username = session_username($_SESSION["username"]);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }

    function check_email_connection()
    {
        
		$table_name = $this->request->getPost('table');
		
		// $checkDuplicateData_area = $this->MasterInformationModel->checkDuplicateData($duplicate_check,$this->username .'_'. $table_name);
		// unset($_POST['table']);

		// if($checkDuplicateData_area == 1){
			if ($this->request->getPost("action") == "insert") 
            {
                unset($_POST['action']);
			    unset($_POST['table']);
                $_POST['master_id'] = $_SESSION['master'];
                $insert_data = $_POST;
                $sql2 = $this->MasterInformationModel->insert_entry2($insert_data ,$this->username .'_'. $table_name);
                $return_array['msg'] = 'insert successfully';
            }

		// } 
		return json_encode($return_array);
    }

}




