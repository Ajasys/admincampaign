<?php

namespace App\Controllers;

//use CodeIgniter\Database\ConnectionInterface;
use App\Models\MasterInformationModel;
use PhpImap\Exceptions\ConnectionException;
use Myth\Auth\IMAP;

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

		// $table_name = $this->request->getPost('table');

		// // $checkDuplicateData_area = $this->MasterInformationModel->checkDuplicateData($duplicate_check,$this->username .'_'. $table_name);
		// // unset($_POST['table']);
		// $return_array = array();
		// // if($checkDuplicateData_area == 1){
		// 	if ($this->request->getPost("action") == "insert") 
		//     {
		//         unset($_POST['action']);
		// 	    unset($_POST['table']);
		//         $_POST['master_id'] = $_SESSION['master'];
		//         $insert_data = $_POST;
		//         $insert_data['platform_status'] = 3;
		//         $sql2 = $this->MasterInformationModel->insert_entry2($insert_data ,$this->username .'_'. $table_name);
		//         $return_array['msg'] = 'insert successfully';
		//     }

		// // } 
		// return json_encode($return_array);
		if ($_POST['checkedTableId'] && !empty($_POST['checkedTableId'])) {
			$checkedTableId = $_POST['checkedTableId'];
		} else {
			$checkedTableId = "";
		}
		$table_name = $this->request->getPost('table');
		$insert_and_update_id_master = $_SESSION['master'];

		$query90 = "SELECT * FROM admin_platform_integration WHERE id= $checkedTableId AND  platform_status = 3 AND  master_id = '" . $insert_and_update_id_master . "'";
		$db_connection = \Config\Database::connect('second');
		$result = $db_connection->query($query90);
		$total_dataa_userr_22 = $result->getResultArray();

		if (isset($total_dataa_userr_22)) {

			$insert_and_update_id = $total_dataa_userr_22[0]['id'];
		} else {
			$insert_and_update_id = 0;
		}
		$duplicate_check = array('master_id' => $_SESSION['master']);

		$checkDuplicateData_area = $this->MasterInformationModel->checkDuplicateData2($duplicate_check, $table_name);
		unset($_POST['table']);

		if ($checkDuplicateData_area == 1) {
			unset($_POST['checkedTableId']);
			unset($_POST['action']);

			$_POST['master_id'] = $_SESSION['master'];
			$insert_data = $_POST;
			$sql2 = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
			$html = "";

			$return_array['msg'] = 'insert successfully';
			$return_array['html'] = $html;
		} else {
			unset($_POST['checkedTableId']);
			unset($_POST['action']);
			$insert_data = $_POST;

			$sql2 = $this->MasterInformationModel->update_entry2($checkedTableId, $insert_data, $table_name, 'master_id');
			// $html ="";
			// if(isset($sql2) && !empty($sql2) && $sql2!= 0)
			// {
			// 	$html .=" <i class='bi bi-pencil-fill fs-14'></i>";
			// }

			$return_array['msg'] = 'Update successfully';
			// $return_array['html'] = $html;


		}
		return json_encode($return_array);
	}
	public function mail_get()
	{
		$username = 'neel@ajasys.com';
		$password = 'Ti=clIJD8Yo5';
		$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';

        // Connect to the server
        $mailbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

        // Get emails
        $emails = imap_search($mailbox, 'ALL');

        // Process the emails
        foreach ($emails as $email) {
            // Fetch email details
            $headerInfo = imap_headerinfo($mailbox, $email);
            $subject = $headerInfo->subject;
            $from = $headerInfo->fromaddress;
            $body = imap_body($mailbox, $email);

            // Do something with the email data
            echo "Subject: $subject<br>";
            echo "From: $from<br>";
            echo "Body: $body<br>";
            echo "<hr>";
        }

        // Close the connection
        imap_close($mailbox);
	}
}
