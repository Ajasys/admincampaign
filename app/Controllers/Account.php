<?php 
namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class Account extends BaseController {
    public function __construct()
	{
		helper('custom');
        $this->second_db_connection = DatabaseDefaultConnection();
        $this->db_connection = DatabaseSecondConnection();
		$this->seconddb_MasterInformationModel = new MasterInformationModel($this->second_db_connection);
		$this->MasterInformationModel = new MasterInformationModel($this->db_connection);
		$this->username = session_username($_SESSION['username']);
		$this->admin = 0;
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
	}

    public function voucher_type_list_data(){
        $action = $_POST['action'];
        $table_name = $_POST['table'];

        $sql = "SELECT * FROM master_".$table_name;
        $result = $this->db_connection->query($sql);
        $result = $result->getResult();
        $html = '';

        foreach($result as $key => $value){
            $html .= '<tr>
                        <td class="align-middle">
                            <input class="checkbox mx-3" type="checkbox" data-id="'.$value->id.'" />
                        </td>
                        <td class="edt d-flex">
                            <div class="bg-white py-1 w-100">
                                <div class="d-flex align-items-center lh-21 col-xxs-12 col-xs-12 col-xl-2">
                                    <span class="me-2"><b>'.$value->id.'</b></span>
                                    <span>'.$value->voucher_type.'</span>
                                </div>
                            </div>
                        </td>
                    </tr>';
        }

        return $html;
    }

    public function group_type_list_data(){
        $action = $_POST['action'];
        $table_name = $_POST['table'];

        $sql = "SELECT * FROM master_".$table_name;
        $result = $this->db_connection->query($sql);
        $result = $result->getResult();
        $html = '';

        foreach($result as $key => $value){
            $html .= '<tr>
                        <td class="align-middle dtr-control sorting_1" tabindex="0">
                            <input class="checkbox mx-3 mt-2" type="checkbox">
                        </td>
                        <td class="d-flex">
                            <div class="project-list-trf  px-0 py-2 w-100 user_view"  data-bs-toggle="modal" data-bs-target="#addacount" data-bs-dismiss="modal" data-edit_id="'.$value->id.'">
                                <div class="project-list-content d-flex align-items-center flex-wrap gap-2">
                                    <div class="d-flex align-items-center ">
                                        <b>'.$value->id.'</b>
                                    </div>
                                    <div class="d-flex align-items-center col-xxs-8 col-xs-10 col-xl-2 lh-21">
                                        <span><b>'.$value->account_grp.'</b></span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>';
        }

        return $html;
    }

    public function group_insert_data(){
        $action = $this->request->getPost('action');
        $table_name = $this->request->getPost('table');
        $account_grp = $this->request->getPost('account_grp');
        $insert_data = array(
            'account_grp' => $account_grp,
        );
        if(isset($_POST['edit_id'])){
            $edit_id = $this->request->getPost('edit_id');
            if($account_grp != ''){
                $account_grp_insert = $this->MasterInformationModel->update_entry($edit_id,$insert_data,'master_'.$table_name);
                echo 0;
            } else {
                echo 1;
            }
        } else {
            if($account_grp != ''){
                $account_grp_insert = $this->MasterInformationModel->insert_entry($insert_data,'master_'.$table_name);
                echo 0;
            } else {
                echo 1;
            }
        }
    }

    public function group_edit_data(){
        $action = $this->request->getPost('action');
        $table_name = $this->request->getPost('table');
        $edit_id = $this->request->getPost('edit_id');

        if($action == 'edit'){
            $result = $this->MasterInformationModel->edit_entry_all('master_'.$table_name,$edit_id,'id');
        }
        $edit_data = get_object_vars($result[0]);

        return json_encode($edit_data);
    }
}