<?php
namespace App\Controllers;

define("DOMPDF_ENABLE_REMOTE", false);
use Dompdf\Options;
use App\Models\MasterInformationModel;
use CodeIgniter\I18n\Time;

class UserInformation extends BaseController {
    protected $db;
    public function __construct() {
        helper('custom');
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = session_username($_SESSION['username']);
        $this->admin = 0;
        if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        // if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
        //     $this->$get_roll_id_to_roll_duty_var = array();
        // }else{
        //     $this->$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
        // }
    }
    // username check 
    public function check_username_availability() {
        $requestBody = json_decode($this->request->getBody());
        $username = $requestBody->username;
        if('post' === $this->request->getMethod() && $username) {
            $result = $this->MasterInformationModel->get_username2($this->username."_user", $this->username."_".$username);
            if($result === true) {
                echo '<span style="color:red;"> <i class="fa-solid fa-xmark"></i> Username already taken</span>';
            } else {
                echo '<span style="color:green;"><i class="fa-solid fa-check"></i>Username Available</span>';
            }
        } else {
            echo '<span style="color:red;">You must enter username</span>';
        }
        die();
    }
    // display data userrole 
    public function display_data_user_role() {
        $this->db = DatabaseSecondConnection();
        $username = session_username($_SESSION['username']);
        $table_name = isset($_POST['table']) ? $_POST['table'] : $table_name;
        $code = isset($_POST['search']) ? $_POST['search'] : $code;
        // $users = get_table_array_helper('admin_user');
        // $user_role_data = get_roll_id_to_full_data();
        $query = "SELECT * FROM $table_name WHERE role = $code";
        $secondDb = DatabaseDefaultConnection();
        $result = $secondDb->query($query);
        $response = array();
        $data = $result->getResult();
        ?>
                <option value="0"> Select Head</option><?php
                foreach($data as $key => $data_value) { ?>
                                                <option value="<?php echo $data_value->id; ?>" data-name="<?php echo $data_value->firstname; ?>"><?php echo $data_value->firstname.' '; ?></option>
                                        <?php
                }
                die();
    }
    // insert data
    public function insert_data() {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $action_name = $this->request->getPost("action");
        $username = session_username($_SESSION['username']);
        if($this->request->getPost("action") == "insert") {
            unset($_POST['action']);
            unset($_POST['table']);
            if(!empty($_POST)) {
                $insert_data = $_POST;
                $isduplicate = $this->duplicate_data($insert_data, $this->username."_".$table_name);
                if($isduplicate == 0) {
                    $response = $this->MasterInformationModel->insert_entry2($insert_data, $this->username."_".$table_name);
                    $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($this->username."_".$table_name);
                    $departmentdisplaydata = json_decode($departmentdisplaydata, true);
                } else {
                    return "error";
                }
            }
        }
        die();
    }
    // dublicate data 
    public function duplicate_data($data, $table) {
        $this->db = DatabaseSecondConnection();
        $i = 0;
        $data_duplicat_Query = "";
        $numItems = count($data);
        foreach($data as $datakey => $data_value) {
            if($i == $numItems - 1) {
                $data_duplicat_Query .= 'LOWER(TRIM(REPLACE('.$datakey.', " ",""))) = "'.strtolower(trim(str_replace(' ', '', $data_value))).'"';
            } else {
                $data_duplicat_Query .= 'LOWER(TRIM(REPLACE('.$datakey.'," ",""))) = "'.strtolower(trim(str_replace(' ', '', $data_value))).'" AND ';
            }
            $i++;
        }
        $sql = 'SELECT * FROM '.$table.' WHERE '.$data_duplicat_Query;
        $secondDb = DatabaseDefaultConnection();
        $result = $secondDb->query($sql);
        if($result->getNumRows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    // list data 
    public function user_show_list_data() {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $get_roll_id_to_roll_duty_var = array();
        } else {
            $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
        }
        // print_r($_REQUEST);
        // die();
        $table_name = $_POST['table'];
        $action = $_POST['action'];
        $username = session_username($_SESSION['username']);
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($this->username."_".$table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);
        $master_user_role = get_table_array_helper('admin_userrole');
        $ts = "";
        $html = "";
        $inactive_html = "";
        //condtion access
        $getchild = array();
        $user_id = 0;
        if(!$this->admin == 1) {
            $user_id = $_SESSION['id'];
        }
        $getchild = getChildIds($_SESSION['id']);
        if(!empty($getchild)) {
            array_push($getchild, $user_id);
        }
        //condtion access close
        foreach($departmentdisplaydata as $key => $value) {
            $role = "";
            if(isset($master_user_role[$value['role']])) {
                $role = $master_user_role[$value['role']]['user_role'];
            }
            $access = 0;
            $secondDb = DatabaseDefaultConnection();
            $db = db_connect();
            $qry = " SELECT * FROM `admin_userrole` WHERE `id` =".$value['role']." ";
            $result = $secondDb->query($qry);
            $location_result = $result->getResult();
            //condtion access
            if($value['switcher_active'] == 'active') {
                if($this->admin == 1) {
                    $access = 1;
                } else if(in_array($value['id'], $getchild)) {
                    $access = 1;
                }
                //condtion access close
                if($access == 1) {
                    $html .= '<tr>';
                    $html .= '
                            <td>
                                <input class="checkbox mt-2" type="checkbox"/>
                            </td>
                            <td>
                                <div class="project-list-trf px-0 py-2 w-100 user_view" data-view_id="'.$value['id'].'"';
                    if(in_array('userinformation_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                        $html .= '     data-bs-toggle="modal" data-bs-target="#user_view"';
                    }
                    ;
                    $html .= '>    
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <b>'.$value['id'].'</b>
                                        </div>
                                         <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <span><b>'.$value['firstname'].'</b></span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Head : </p>
                                            <span class="mx-1">'.$value['head_name'].'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Role : </p>
                                            <span class="mx-1">'.$role.'</span>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Department : </p>
                                            <span class="mx-1">'.$value['department'].'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Join Date : </p>
                                            <span class="mx-1">'.$value['join_date'].'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">';
                    foreach($value as $k => $v) {
                        // pre($v);
                        if($k == 'switcher_active') {
                            // echo "ikkk";
                            if($v == 'active' || empty($v)) {
                                $html .= '<i class="bi bi-check-circle-fill text-success fs-4"></i>';
                            } else if($v == 'inactive') {
                                $html .= '<i class="bi bi-x-circle-fill text-danger fs-4"></i>';
                            } else {
                                $html .= '';
                            }
                        }
                    }
                    $html .= '</div>
                                            </div>
                                        </div>
                                    </td>';
                    $html .= '</tr>';
                }
            }
            if($value['switcher_active'] == 'inactive') {
                if($this->admin == 1) {
                    $access = 1;
                } else if(in_array($value['id'], $getchild)) {
                    $access = 1;
                }
                //condtion access close
                if($access == 1) {
                    $inactive_html .= '<tr>';
                    $inactive_html .= '
                            <td>
                                <input class="checkbox mt-2" type="checkbox"/>
                            </td>
                            <td>
                                <div class="project-list-trf  px-0 py-2 w-100 user_view" data-view_id="'.$value['id'].'"';
                    if(in_array('userinformation_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                        $inactive_html .= '     data-bs-toggle="modal" data-bs-target="#user_view"';
                    }
                    ;
                    $inactive_html .= '>    
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <b>'.$value['id'].'</b>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <span><b>'.$value['firstname'].'</b></span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Head : </p>
                                            <span class="mx-1">'.$value['head_name'].'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Role : </p>
                                            <span class="mx-1">'.$role.'</span>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Department : </p>
                                            <span class="mx-1">'.$value['department'].'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">
                                            <p>Join Date : </p>
                                            <span class="mx-1">'.$value['join_date'].'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4 col-lg-3  col-sm-6 col-12">';
                    //    <p class="green mx-1 fs-0">on</p>
                    foreach($value as $k => $v) {
                        // pre($v);
                        if($k == 'switcher_active') {
                            // echo "ikkk";
                            if($v == 'active' || empty($v)) {
                                $inactive_html .= '<i class="bi bi-check-circle-fill text-success fs-4"></i>';
                            } else if($v == 'inactive') {
                                $inactive_html .= '<i class="bi bi-x-circle-fill text-danger fs-4"></i>';
                            } else {
                                $inactive_html .= '';
                            }
                        }
                    }
                    $inactive_html .= '</div>
                                            </div>
                                        </div>
                                    </td>';
                    $inactive_html .= '</tr>';
                }
            }
        }
        $return_array = array(
            'html' => $html,
            'inactive_html' => $inactive_html,
        );
        return json_encode($return_array, true);
        die();
    }
    // view data 
    public function view_data() {
        if($this->request->getPost("action") == "view") {
            $view_id = $this->request->getPost('view_id');
            $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            $userEditdata = $this->MasterInformationModel->edit_entry2($this->username."_".$table_name, $view_id);
            $userEditdata = get_object_vars($userEditdata[0]);
            if(isset($userEditdata['start_date'] ) && !empty($userEditdata['start_date']))
            {
                $start_format_date = date('d-m-Y',strtotime($userEditdata['start_date']));
            }else{
                $start_format_date = "";
            }
            if(isset($userEditdata['end_date'] ) && !empty($userEditdata['end_date']))
            {
                $end_format_date = date('d-m-Y',strtotime($userEditdata['end_date']));

            }else{
                $end_format_date = "";
            }
            if(isset($userEditdata['product_id']) && !empty($userEditdata['product_id'])) {
                $secondDb = DatabaseDefaultConnection();
                $product_id = $userEditdata['product_id'];
                $find_Data = array(
                    'id' => $product_id
                );
                $result = $secondDb->table($username."_product")->where($find_Data)->get();
                $result_array = $result->getResultArray();
                $userEditdata['product_id'] = isset($result_array[0]) ? $result_array[0]['product_name'] : $result_array['product_name'];
            }
            $userEditdata['start_formated_date'] = $start_format_date;
            $userEditdata['end_formated_date'] = $end_format_date;
           
            return json_encode($userEditdata, true);
        }
        die();
    }
    // get pass 
    public function get_password() {
        $this->db = DatabaseSecondConnection();
        $secondDb = DatabaseDefaultConnection();
        $username = session_username($_SESSION['username']);
        $table_name = $_POST['table'];
        $password = $_POST['password'];
        $return_array = array(
            'response' => false
        );
        $find_Data = array(
            'id' => $_POST['user_id']
        );
        $result = $secondDb->table($username."_".$table_name)->where($find_Data)->get();
        // pre($result);
        //  die();
        if($result->getNumRows() > 0) {
            $result_array = $result->getResultArray()[0];
            $de_password = '';
            if(isset($result_array['password']) && $result_array['password'] != false) {
                $de_password = decryptPass($result_array['password']);
            } else if($result_array['password'] == false) {
                $de_password = "";
            }
            $return_array = array(
                'password' => $de_password,
                'response' => true
            );
            // print_r($return_array);
            // die();
        }
        return json_encode($return_array, true);
        die();
    }
    // set pass 
    public function set_password() {
        $username = session_username($_SESSION['username']);
        $table_name = $_POST['table'];
        $id = $_POST['update_id'];
        if(isset($_POST['password']) && !empty($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $password = '';
        }
        $encrypt_password = encryptPass($password);
        $this->db = DatabaseSecondConnection();
        $data = [
            'password' => $encrypt_password,
        ];
        $departmentUpdatedata = $this->MasterInformationModel->update_entry2($id, $data, $username."_".$table_name);
        //  print_r($departmentUpdatedata);
        //  die();
        return false;
        die();
    }
    public function edit_data_subscribtion() {
        if($this->request->getPost("action") == "edit") {
            $edit_id = $this->request->getPost('edit_id');
            $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            $userEditdata = $this->MasterInformationModel->edit_entry_all($table_name, $edit_id, 'master_id');
            // $userEditdata = get_object_vars($userEditdata[0]);
            $user_db_connection = \Config\Database::connect('realtosmart');
            $paydone_query = "SELECT * FROM paydone_data WHERE id =" .$edit_id; 
            $sql_run_paydone = $user_db_connection->query($paydone_query);
            $paydone_result = $sql_run_paydone->getResult();
            $userEditdata = get_object_vars($paydone_result[0]);

            if($userEditdata['product_id'] == 1) {
                $productname = 'RealToSmart';
                $user_db_connection = \Config\Database::connect('realtosmart');
                $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$userEditdata['username']."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();

                if($user_data_result != array()) { 
                    $user_data_result = get_object_vars($user_data_result[0]);
                }
            }
            if($userEditdata['product_id'] == 2) {
                $productname = 'GymSmart';
                $user_db_connection = \Config\Database::connect('gymsmart');
                $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$userEditdata['username']."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();
                if($user_data_result != array()) {
                    $user_data_result = get_object_vars($user_data_result[0]);
                }
            }
            if($userEditdata['product_id'] == 3) {
                $productname = 'Leadmgtcrm';
                $user_db_connection = \Config\Database::connect('leadmgtcrm');
                $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$userEditdata['username']."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();
                if($user_data_result != array()) {
                    $user_data_result = get_object_vars($user_data_result[0]);
                }
            }
            $subcription_date = $user_data_result['subcription_date'];
            $subcription_end = $user_data_result['subcription_end'];
            $plan_detailss = $user_data_result['plan'];

            $subcription_date_india = date('d-m-Y', strtotime($subcription_date));
            $subcription_end_india = date('d-m-Y', strtotime($subcription_end));
            $userEditdata['subcription_date_india'] = $subcription_date_india;
            $userEditdata['subcription_end_india'] = $subcription_end_india;
            if($userEditdata['product_id'] == 1) {
                $productname = 'RealToSmart';
                $user_db_connection = \Config\Database::connect('realtosmart');
            }
            if($userEditdata['product_id'] == 2) {
                $productname = 'GymSmart';
                $user_db_connection = \Config\Database::connect('gymsmart');
            }
            if($userEditdata['product_id'] == 3) {
                $productname = 'Leadmgtcrm';
                $user_db_connection = \Config\Database::connect('leadmgtcrm');
            }
            $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$userEditdata['username']."'";
            $sql_run = $user_db_connection->query($master_user_data_sql);
            $user_data_result = $sql_run->getResult();
            $user_data_result = get_object_vars($user_data_result[0]);
            if(isset($user_data_result['invoice_id']) && !empty($user_data_result['invoice_id']) )
            {
                $invoice_idd = $user_data_result['invoice_id'];
            }else{
                $invoice_idd = "";
            }
            $userEditdata = array_merge($userEditdata, $user_data_result);
            $userEditdata['plann_namee'] =$plan_detailss;
            $userEditdata['invoice_idd'] =$invoice_idd;

            //  pre($subcription_end_india);
            //  pre($subcription_date_india);                
            //  die();
            return json_encode($userEditdata, true);
        }
        die();
    }
    // edit data 
    public function edit_data() {
        if($this->request->getPost("action") == "edit") {
            $edit_id = $this->request->getPost('edit_id');
            $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            $userEditdata = $this->MasterInformationModel->edit_entry2($username."_".$table_name, $edit_id);
            $userEditdata = get_object_vars($userEditdata[0]);
            if(isset($userEditdata['username'])) {
                if(strpos($userEditdata['username'], '_') !== false) {
                    //$usertable = explode("_",$userEditdata['username']);
                    $string = $userEditdata['username'];
                    $char = "_";
                    // Find the position of the specified character
                    $pos = strpos($string, $char);
                    // Get all characters after the specified character
                    $userEditdata['user_name'] = substr($string, $pos + 1);
                }
            }
            return json_encode($userEditdata, true);
        }
        die();
    }
    // update data 
    public function update_data() {
        $post_data = $this->request->getPost();
        $username = session_username($_SESSION['username']);
        $table_name = $this->request->getPost("table");
        $action_name = $this->request->getPost("action");
        $update_id = $this->request->getPost("edit_id");
        $response = 0;
        if($this->request->getPost("action") == "update") {
            //print_r($_POST);
            unset($_POST['action']);
            unset($_POST['edit_id']);
            unset($_POST['table']);
            if(!empty($post_data)) {
                $update_data = $_POST;
                $isduplicate = $this->duplicate_data($update_data, $this->username."_".$table_name);
                if($isduplicate == 0) {
                    $departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $this->username."_".$table_name);
                    $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($this->username."_".$table_name);
                    $departmentdisplaydata = json_decode($departmentdisplaydata, true);
                    $response = 1;
                } else {
                    return "error";
                }
            }
        }
        echo $response;
        die();
    }
    public function duplicate_data2($data, $table) {
        $this->db = DatabaseSecondConnection();
        $i = 0;
        $data_duplicat_Query = "";
        $numItems = count($data);
        foreach($data as $datakey => $data_value) {
            if($i == $numItems - 1) {
                $data_duplicat_Query .= 'LOWER(TRIM(REPLACE('.$datakey.', " ",""))) = "'.strtolower(trim(str_replace(' ', '', $data_value))).'"';
            } else {
                $data_duplicat_Query .= 'LOWER(TRIM(REPLACE('.$datakey.'," ",""))) = "'.strtolower(trim(str_replace(' ', '', $data_value))).'" AND ';
            }
            $i++;
        }
        $sql = 'SELECT * FROM '.$table.' WHERE '.$data_duplicat_Query;
        $result = $this->db->query($sql);
        if($result->getNumRows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function update_data_subscribtion() {
        $this->db = DatabaseSecondConnection();
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $action_name = $this->request->getPost("action");
        $update_id = $this->request->getPost("id");
        $subcription_date = $this->request->getPost("subcription_date");
        $subcription_end = $this->request->getPost("subcription_end");
        $username = $this->request->getPost("username");
        $response = 0;
        if($this->request->getPost("action") == "update") {
            //print_r($_POST);
            unset($_POST['action']);
            unset($_POST['id']);
            unset($_POST['table']);
            if(!empty($post_data)) {
                $update_data = $_POST;
                $today = date("Y-m-d H:i:s");
                $userEditdata = $this->MasterInformationModel->edit_entry_all($table_name, $update_id, 'master_id');
                $userEditdata = get_object_vars($userEditdata[0]);
                if($userEditdata['product_id'] == 1) {
                    $productname = 'RealToSmart';
                    $user_db_connection = \Config\Database::connect('realtosmart');
                }
                if($userEditdata['product_id'] == 2) {
                    $productname = 'GymSmart';
                    $user_db_connection = \Config\Database::connect('gymsmart');
                }
                if($userEditdata['product_id'] == 3) {
                    $productname = 'Leadmgtcrm';
                    $user_db_connection = \Config\Database::connect('leadmgtcrm');
                }
                if(isset($subcription_date) && !empty($subcription_date)) {
                    $update_data['subcription_date'] = date("Y-m-d H:i:s", strtotime($_POST['subcription_date']));
                    $data['subcription_date'] = date("Y-m-d H:i:s", strtotime($_POST['subcription_date']));
                } else {
                    $update_data['subcription_date'] = $today;
                    $data['subcription_date'] = $today;
                }
                if(isset($subcription_end) && !empty($subcription_end)) {
                    $update_data['subcription_end'] = date("Y-m-d H:i:s", strtotime($_POST['subcription_end']));
                    $data['subcription_end'] = date("Y-m-d H:i:s", strtotime($_POST['subcription_end']));
                } else {
                    $update_data['subcription_end'] = date("Y-m-d H:i:s", strtotime("+1 year"));
                    $data['subcription_end'] = date("Y-m-d H:i:s", strtotime("+1 year"));
                }
                $update_data_paydone = array('username' => $username);
                if(isset($update_data['plan_name'])) {
                    $update_data_paydone['plan_name'] = $update_data['plan_name'];
                    unset($update_data['plan_name']);
                }
                if(isset($update_data['user_valid'])) {
                    $update_data_paydone['user_valid'] = $update_data['user_valid'];
                    unset($update_data['user_valid']);
                }
                if(isset($update_data['total_amount'])) {
                    $update_data_paydone['total_amount'] = $update_data['total_amount'];
                    unset($update_data['total_amount']);
                }
                if(isset($update_data['addon_user'])) {
                    $update_data_paydone['addon_user'] = $update_data['addon_user'];
                    unset($update_data['addon_user']);
                }
                if(isset($update_data['user_price'])) {
                    $update_data_paydone['user_price'] = $update_data['user_price'];
                    unset($update_data['user_price']);
                }
                if(isset($update_data['price'])) {
                    $update_data_paydone['price'] = $update_data['price'];
                    unset($update_data['price']);
                }
                // $isduplicate = $this->duplicate_data2($update_data_paydone, $table_name);
                // if($isduplicate == 0) {

                    $result2 = $this->db
                        ->table($table_name)
                        ->where(["master_id" => $update_id])
                        ->set($update_data_paydone)
                        ->update();
                    $result = $user_db_connection
                        ->table("master_user")
                        ->where(["username" => $username])
                        ->set($update_data)
                        ->update();
                    // $departmentUpdatedata = $this->MasterInformationModel->update_entry($update_id, $update_data_paydone, $table_name);
                    $departmentdisplaydata = $this->MasterInformationModel->display_all_records($table_name);
                    $departmentdisplaydata = json_decode($departmentdisplaydata, true);
                    if($result && $result2) {
                        $response = 1;
                    }else {
                        $response = 'error';
                    }
                // } else {
                //     return "error";
                // }
            }
        }
        echo $response;
        die();
    }
    // product data 
    public function product_data() {
        $action = $this->request->getPost('action');
        $product_id = $this->request->getPost('product_id');
        $secondDb = DatabaseDefaultConnection();
        if($action == true) {
            $find_Data = array(
                'crm'=> $product_id,
            );
            $result = $secondDb->table("admin_subscription_master")->where($find_Data)->get();
            $result_data = $result->getResultArray();
            // pre($result_data);
            $html = '';
            foreach($result_data as $key => $value) {
                $html .= '<option value="'.$value['id'].'" data-plan_price="'.$value['plan_price'].'" data-add_on_user="'.$value['user'].'">'.$value['plan_name'].'</option>';
            }
        }

        $return_array = array();
        $return_array['subscription'] = $html;

        return json_encode($return_array);
    }
    //delete
    public function delete_data() {
        if($this->request->getPost("action") == "delete") {
            $delete_id = $this->request->getPost('id');
            // $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            $departmentdisplaydata = $this->MasterInformationModel->delete_entry2($this->username."_".$table_name, $delete_id);
        }
        die();
    }
    public function delete_datas() {
        if($this->request->getPost("action") == "delete") {
            $delete_id = $this->request->getPost('id');
            // $username = session_username($_SESSION['username']);
            $table_name = $this->request->getPost('table');
            $db_connection = \Config\Database::connect('realtosmart');
            $query = "SELECT * FROM `paydone_data` WHERE master_id = $delete_id";
            $result = $db_connection->query($query);
            $paydone_data = $result->getResultArray();
            $paydone_id = $paydone_data[0]['id'];
            $delete_paydone = "DELETE FROM `paydone_data` WHERE id =".$paydone_id;
            $result50 = $db_connection->query($delete_paydone);

            $paydone_data_username = $paydone_data[0]['username'];
            // $insert_master_user_query = "SELECT *  FROM `master_user` WHERE username = '$paydone_data_username'";
            // $result = $db_connection->query($insert_master_user_query);
            // $masterr_data = $result->getResultArray();
            // // if (isset($masterr_data[0]['id'])) {
            // //     $master_user_id = $masterr_data[0]['id'];
            // //     $delete_master_user_query = "DELETE FROM `master_support_ticket` WHERE user_id = $master_user_id";
            // //     $db_connection->query($delete_master_user_query);
            // // }
            $productname = "";
            if($paydone_data[0]['product_id'] == 1) {
                $productname = 'RealToSmart';
                $user_db_connection = \Config\Database::connect('realtosmart');
                // $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$paydone_data[0]['username']."'";
                // $sql_run = $user_db_connection->query($master_user_data_sql);
                // $user_data_result = $sql_run->getResult();
                // $user_data_result = get_object_vars($user_data_result[0]);
                $delete_master_user_query = "DELETE FROM `master_user` WHERE id = '$delete_id'";
                $user_db_connection->query($delete_master_user_query);
            }
            if($paydone_data[0]['product_id'] == 2) {
                $productname = 'GymSmart';
                $user_db_connection = \Config\Database::connect('gymsmart');
                // $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$paydone_data[0]['username']."'";
                // $sql_run = $user_db_connection->query($master_user_data_sql);
                // $user_data_result = $sql_run->getResult();
                // $user_data_result = get_object_vars($user_data_result[0]);
                $delete_master_user_query = "DELETE FROM `master_user` WHERE id = '$delete_id'";
                $user_db_connection->query($delete_master_user_query);
            }
            if($paydone_data[0]['product_id'] == 3) {
                $productname = 'Leadmgtcrm';
                $user_db_connection = \Config\Database::connect('leadmgtcrm');
                // $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$paydone_data[0]['username']."'";
                // $sql_run = $user_db_connection->query($master_user_data_sql);
                // $user_data_result = $sql_run->getResult();
                // $user_data_result = get_object_vars($user_data_result[0]);
                $delete_master_user_query = "DELETE FROM `master_user` WHERE id = '$delete_id'";
                $user_db_connection->query($delete_master_user_query);
            }
            // $dbs = "SELECT CONCAT('ALTER TABLE ', TABLE_NAME, ' DROP FOREIGN KEY ', CONSTRAINT_NAME, ';') AS query
            //         FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            //         WHERE TABLE_NAME LIKE '$paydone_data_username\_%'
            //           AND REFERENCED_TABLE_NAME IS NOT NULL
            //         UNION
            //         SELECT CONCAT('ALTER TABLE ', TABLE_NAME, ' DROP INDEX ', INDEX_NAME, ';') AS query
            //         FROM INFORMATION_SCHEMA.STATISTICS
            //         WHERE TABLE_NAME LIKE '$paydone_data_username\_%'
            //           AND NON_UNIQUE = 1
            //         UNION
            //         SELECT CONCAT('DROP TABLE ', TABLE_NAME, ';') AS query
            //         FROM INFORMATION_SCHEMA.TABLES
            //         WHERE TABLE_NAME LIKE '$paydone_data_username\_%'";
            // $result = $db_connection->query($dbs);
            // $row = $result->getResult();
            // foreach ($row as $value) {
            //     // pre($value);
            //     $alterQuery = $value->query;
            //     $db_connection->query($alterQuery);
            // }
            $departmentdisplaydata = $this->MasterInformationModel->delete_entry($table_name, $delete_id);

        }
        die();
    }
    // GET DEPARTMENT NAME 
    public function user_role_to_get_departmet() {
        $this->db = DatabaseSecondConnection();
        $response = array();
        $table_name = $_POST['table'];
        $department = $_POST['department'];
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records2('admin_department');
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);
        foreach($departmentdisplaydata as $department_key => $department_value) {
            if($department_value['id'] == $department) {
                $response['department'] = $department_value['departmentname'];
                //    print_r($response);
                //    die();
            }
        }
        return json_encode($response);
        die();
    }
    /* Insert User Role  data */
    public function userrole_insert_data()
    {
        
        $result = array();
        $this->db = DatabaseSecondConnection();
        $secondDb = DatabaseDefaultConnection();
        $username = session_username($_SESSION['username']);
        	$tooltip = $this->request->getPost("tooltip");
     
        if ($this->request->getPost("action") == "insert") {
            unset($_POST['action']);
            unset($_POST['table']);
            unset($_POST['tooltip']);
            $insert_data = $_POST;
            $insert_data['parent_id'] = 0;
            $insert_data['position'] = 1;
      
            $isduplicate = $this->duplicate_data2($insert_data, $username . "_userrole");
            if ($isduplicate == 0) {
                
                  $insert_data['created_at'] =  Utctime('Y-m-d h:i:s',$this->timezone, date('Y-m-d h:i:s'));
                $responses = $this->MasterInformationModel->insert_entry2($insert_data, $username . "_userrole");
                  if(isset($tooltip) &&  !empty($tooltip)){
                      //echo "dddd";
                      $insert_datad['tooltip'] = 1;  
                    //   pre($_SESSION['master']);
                    //   pre($insert_datad);
                      $responses = $this->MasterInformationModel->update_entry2($_SESSION['master'],$insert_datad, "master_user");
                }
                $result = array(
                    'msg' => "Userrole Added Successfully",
                    'response' => 1,
                );
                
            
           
            } else {
                // return "error";
                $result['response'] = 0;
                $result['message'] = 'already created !';
            }
              
           
        } else {
        $user_role_list = $this->request->getPost("user_role_list");
        $array_menu = json_decode($user_role_list, true);
        $updateuser = $this->updateuUserRole($array_menu);
        if($updateuser == 1) {
                $result = array(
                    'msg' => "Userrole Updated Successfully",
                    'response' => 1,
                );
        } else {
                $result = array(
                    'msg' => "Userrole Not Updated",
                    'response' => 0,
                );
        }
        }
        
        
        return json_encode($result);
        die();
    }
    public function updateuUserRole($menu, $parent = 0, $i = 0)
    {
        $insert_data = array();
        if(!empty($menu)) {
            $username = session_username($_SESSION['username']);
            $insert_column = array('user_role varchar', 'parent_id varchar', 'department varchar', 'access_page text', 'position INT');
            $check_table_and_column = tableCreateAndTableUpdate2($username . "_userrole", 'urvi_userrole', $insert_column);
            foreach($menu as $k => $value) {
                if (!empty($value['id'])) {
                $insert_data['user_role'] = $value['label'];
                $insert_data['parent_id'] = $parent;
                $insert_data['department'] = $value['department'];
                if(isset($value['access_page']) && !empty($value['access_page'])) {
                    $insert_data['access_page'] = $value['access_page'];
                }
                    $insert_data['position'] = $i;
                    // pre($insert_data);
                    $response = $this->MasterInformationModel->update_entry2($value['id'], $insert_data, $username . "_userrole");
                    $id = $value['id'];
                if(array_key_exists('children', $value)) {
                        $this->updateuUserRole($value['children'], $id, 1);
                }
                } else {
                    $username = session_username($_SESSION['username']);
                    $insert_data['user_role'] = $value['label'];
                    $insert_data['parent_id'] = $parent;
                    $insert_data['department'] = $value['department'];
                    $insert_data['position'] = $i;
                    if (isset($value['access_page']) && !empty($value['access_page'])) {
                        $insert_data['access_page'] = $value['access_page'];
                    }
                    $response = $this->MasterInformationModel->insert_entry2($insert_data, $username . "_userrole");
                }
                $i++;
            }
            return 1;
        } else {
            return 0;
        }
    }
    // userrole_list
    function renderMenuItem($id, $label, $department, $access_page) {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $get_roll_id_to_roll_duty_var = array();
        } else {
            $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
        }
        $departmentname = $this->MasterInformationModel->display_all_records2('admin_department');
        $departmentss = json_decode($departmentname, true);
        $html = '';
        $html .= '
            <li class="dd-item dd3-item" data-id="'.$id.'" data-label="'.$label.'"  data-department="'.$department.'" data-access_page="'.$access_page.'">
            <div class="">
                <img class="dd-handle dd3-handle " src="https://dev.realtosmart.com/assets/images/drag-and-drop.jpg">
            </div>
            <div class="dd3-content">
                <span data-edit_id="'.$id.'" data-department="'.$department.'" data-access_page="'.$access_page.'">'.$label.'</span>
                <div class="item-edit">
                    <img class="access-icons mx-2 opacity-75"  src="https://dev.realtosmart.com/assets/images/edit2.png">
                </div>
                <div data-tbs-toggle="tooltip" data-bs-placement="right" data-bs-title="access">';
        if(in_array('useradminrole_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            $html .= '   <img class="access-icon" data-bs-toggle="modal" data-edit_id="'.$id.'" data-bs-target="#Userrole_access" src="https://dev.realtosmart.com/assets/images/access1.png"';
        }
        ;
        $html .= '>  </div>
            </div>
            <div class="item-settings d-none w-100">
                <div class="d-flex align-items-center justify-content-between col-12 px-1 mb-1">
                    <lable>User Role</lable>
                    <a class="item-close" href="javascript:;">    
                        <button type="button" class="modal-close-btn"style="float:right" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </a>
                </div>
                <div class="user-admin-form-submit d-flex mb-2">
                    <input class="mx-1 px-1" type="text" name="navigation_label" value="'.$label.'">
                    <select name="department" class="department mx-1"  data-live-search="true">
                        <option class="dropdown-item" data-department_id="0" value="0">Select Action</option>';
        foreach($departmentss as $key => $value) {
            if($department == $value['id']) {
                $html .= '<option class="selected active" selected data-department_id="'.$value['id'].'" value="'.$value['id'].'">'.$value['departmentname'].'</option>';
            } else {
                $html .= '<option data-department_id="'.$value['id'].'" value="'.$value['id'].'">'.$value['departmentname'].'</option>';
            }
        }
        $html .= '
                    </select>
                </div>
                <div>
                    <a class="item-delete mx-1" href="javascript:;">Remove</a>
                </div>
            </div>';
        return $html;
    }
    function userrole_list_tree($parent_id = 0) {
        $this->db = DatabaseSecondConnection();
        $table_name = $this->request->getPost('table');
        //pre($_SESSION['username']);
        $username = session_username($_SESSION['username']);
        $items = '';
        $secondDb = DatabaseDefaultConnection();
        $query = $secondDb->query("SELECT * FROM  $table_name   WHERE parent_id = ? ORDER BY position ASC", $parent_id);
        if($query->getNumRows() > 0) {
            $items .= '<ol class="dd-list ms-5">';
            $result = $query->getResultArray();
            foreach($result as $row) {
                $items .= $this->renderMenuItem($row['id'], $row['user_role'], $row['department'], $row['access_page']);
                $items .= $this->userrole_list_tree($row['id']);
                $items .= '</li>';
            }
            $items .= '</ol>';
        }
        return $items;
    }
    public function user_role_update_data() {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $action_name = $this->request->getPost("action");
        $username = session_username($_SESSION['username']);
        $update_id = $this->request->getPost("edit_id");
        if($this->request->getPost("action") == "update") {
            unset($_POST['action']);
            unset($_POST['table']);
            unset($_POST['edit_id']);
            if(!empty($_POST)) {
                $update_data = array();
                $implode_value = '';
                if(@$_POST['access']) {
                    $implode_value = implode(",", $_POST['access']);
                    unset($_POST['access']);
                }
                $update_data = $_POST;
                $update_data['access_page'] = $implode_value;
                // pre($update_data);
                // die();
                if($update_id != '' && $update_id != '0') {
                    $departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $username.'_'.$table_name);
                    if($departmentUpdatedata == true) {
                        return true;
                    } else {
                        return "error";
                    }
                } else {
                    return "error";
                }
            }
        }
        die();
    }
    public function people_list() {
        $table_name = 'all_inquiry';
        $action = $_POST['action'];
        $delete_status = '0';
        $html = "";
        $row_count_html = '';
        $return_array = array(
            'row_count_html' => '',
            'html' => '',
            'total_page' => 0,
            'response' => 0
        );
        //$allow_data = json_decode($_POST['show_array']);
        //$status = get_table_array_helper('master_inquiry_status');
        // $get_roll_id_to_roll_duty_var = get_roll_id_to_roll_duty();
        $db_connection = DatabaseSecondConnection();
        $user_id = $_SESSION['id'];
        $perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
        $pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;
        $ajaxsearch = isset($_POST['ajaxsearch']) && !empty($_POST['ajaxsearch']) ? $_POST['ajaxsearch'] : '';
        $ajaxsearch_query = '';
        $getchild = '';
        $getchild = getChildIds($_SESSION['id']);
        $ajaxsearch_query = '';
        // pre($_POST);
        if($action == "filter") {
            unset($_POST['action']);
            unset($_POST['perPageCount']);
            unset($_POST['pageNumber']);
            unset($_POST['datastatus']);
            unset($_POST['table']);
            foreach($_POST as $k => $v) {
                if(!empty($v) && $k == "f_id") {
                    $ajaxsearch_query .= ' AND id  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "f_full_name") {
                    $ajaxsearch_query .= ' AND 	full_name  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "f_inquiry_id") {
                    $ajaxsearch_query .= ' AND inquiry_id  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "f_mobileno") {
                    $ajaxsearch_query .= ' AND 	mobileno  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "f_people_status") {
                    $ajaxsearch_query .= ' AND user_type  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "f_switcher_amount") {
                    $ajaxsearch_query .= ' AND switcher_amount  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "f_project_name") {
                    $ajaxsearch_query .= ' AND project_name  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "f_city") {
                    $ajaxsearch_query .= ' AND unitno  LIKE "%'.$v.'%"';
                }
                if(!empty($v) && $k == "starting_date") {
                    $newDate = date("Y-m-d", strtotime($v));
                    // $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
                    $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%Y-%m-%d") = "'.$newDate.'" ';
                }
                if(!empty($v) && $k == "ending_date") {
                    $newDate = date("Y-m-d", strtotime($v));
                    // $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%m/%d/%Y") >= '.$newDate.'';
                    $ajaxsearch_query .= ' AND DATE_FORMAT(created_at,"%Y-%m-%d") >= "'.$newDate.'" ';
                }
            }
        }
        if($this->admin == 1) {
            if($ajaxsearch_query == "") {
                $sql = 'SELECT * FROM '.$this->username."_".$table_name.' ';
            } else {
                $sql = 'SELECT * FROM '.$this->username."_".$table_name.' WHERE 1 '.$ajaxsearch_query;
            }
        } else {
            if(!empty($getchild)) {
                $getchilds = "'".implode("', '", $getchild)."'";
            } else {
                $getchilds = "'".$_SESSION['id']."'";
            }
            if($ajaxsearch_query == "") {
                $sql = 'SELECT * FROM '.$this->username."_".$table_name.' WHERE (assign_id ="'.$_SESSION['id'].'"  OR  assign_id IN ('.$getchilds.') OR owner_id IN ('.$getchilds.') ) ';
            } else {
                $sql = 'SELECT * FROM '.$this->username."_".$table_name.' WHERE (assign_id ="'.$_SESSION['id'].'"  OR  assign_id IN ('.$getchilds.') OR owner_id IN ('.$getchilds.') )  '.$ajaxsearch_query;
            }
        }
        $main_sql = $sql;
        $result = $db_connection->query($sql);
        if($result->getNumRows() > 0) {
            $rowCount = $result->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;
            $pagesCount = ceil($rowCount / $perPageCount);
            $lowerLimit = ($pageNumber - 1) * $perPageCount;
            $sqlQuery = $main_sql." ORDER BY `id` DESC LIMIT $lowerLimit , $perPageCount";
            $Getresult = $db_connection->query($sqlQuery);
            $inquiry_all_data = $Getresult->getResultArray();
            $rowCount_child = $Getresult->getNumRows();
            $start_entries = $lowerLimit + 1;
            $last_entries = $start_entries + $rowCount_child - 1;
            $row_count_html .= 'Showing '.$start_entries.' to '.$last_entries.' of '.$rowCount.' entries';
            $i = 1;
            $loop_break = 0;
            foreach($inquiry_all_data as $key => $value) {
                $inquiry_details = "";
                if(!empty($value['inquiry_type'])) {
                    $inquiry_type_name = IdToFieldGetData('inquiry_details', "id=".$value['inquiry_type']."", "master_inquiry_type");
                    $inquiry_details = isset($inquiry_type_name['inquiry_details']) && !empty($inquiry_type_name['inquiry_details']) ? $inquiry_type_name['inquiry_details'] : '';
                }
                $assign_name = '';
                $user_data = user_id_to_full_user_data($value['assign_id']);
                if($value['assign_id'] == 0) {
                    $assign_name = $user_data['name'];
                } else {
                    $assign_name = $user_data['firstname'];
                }
                $user_type = '';
                if($value['user_type'] == 1) {
                    $user_type = 'people';
                } else if($value['user_type'] == 2) {
                    $user_type = 'broker';
                } else if($value['user_type'] == 3) {
                    $user_type = 'customer';
                } else if($value['user_type'] == 4) {
                    $user_type = 'investor';
                }
                $html .= '<tr>';
                $html .= '
                        <td class="d-flex">
                           <div class="ps-2 pt-2 bg-white">
                              <input class="checkbox" type="checkbox" />
                           </div>
                           <div class="people-list-trf bg-white px-3 py-2 w-100" data-bs-toggle="modal"
                              data-bs-target="#peoModel" id="people_list_model" data-edit_id="'.$value['id'].'">
                              <div
                                 class="people-list-topbar d-flex align-items-center justify-content-between flex-wrap">
                                 <div class="people-list-topbar-id-name d-flex align-items-center col-12 col-xl-4">
                                    <p>
                                       <b>'.$value['id'].'</b>
                                    </p>
                                    <h6 class="mx-2">'.$value['full_name'].'</h6>
                                 </div>
                              </div>
                              <div
                                 class="people-list-content d-flex align-items-center justify-content-between flex-wrap">
                                 <div class="d-flex align-items-center col-3 col-xxs-5 col-sm-6 col-xl-3">
                                    <p>
                                       <i class="fa-solid fa-user-tie lh-28 text-black me-1"></i>
                                       Type :
                                    </p>
                                    <span class="mx-1">'.$user_type.'</span>
                                 </div>
                                 <div class="d-flex align-items-center col-3 col-xxs-5 col-sm-6 col-xl-3">
                                    <p>email : </p>
                                    <span class="mx-1">'.$value['email'].'</span>
                                 </div>
                                 <div class="d-flex align-items-center col-3 col-xxs-7 col-sm-6 col-xl-3">
                                    <p>Area : </p>
                                    <span class="mx-1">'.$value['area'].'</span>
                                 </div>
                              </div>
                           </div>
                        </td>';
                $html .= '</tr>';
            }
            // pre($html);
            $return_array['row_count_html'] = $row_count_html;
            $return_array['html'] = $html;
            $return_array['total_page'] = $pagesCount;
            $return_array['response'] = 1;
        } else {
            $return_array['row_count_html'] = "Page 0 of 0";
            $return_array['total_page'] = 0;
            $return_array['response'] = 1;
            $return_array['html'] = '<p style="text-align:center;">Data Not Found </p>';
        }
        echo json_encode($return_array);
        die();
    }
    public function demo_user_show_data() {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $get_roll_id_to_roll_duty_var = array();
        } else {
            $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
        }
        $table_name = $_POST['table'];
        $action = $_POST['action'];
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
        $username = session_username($_SESSION['username']);
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records($table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);
        // $master_user_role = get_table_array_helper($username . '_userrole');
        $ts = "";
        $html = $productname = "";
        foreach($departmentdisplaydata as $key => $value) {
            // if($value['master_id'] == 75)
                // pre($value);

            if($value['is_approve'] != 0 && $value['product_id'] == $product_id) {
                $master_idd = $value['master_id'];
                $productname = "";
                if($value['product_id'] == 1) {
                    $productname = 'RealToSmart';
                    $user_db_connection = \Config\Database::connect('realtosmart');
                    $master_user_data_sql = "SELECT * FROM master_user WHERE id = '".$master_idd."'";
                    $sql_run = $user_db_connection->query($master_user_data_sql);
                    $user_data_result = $sql_run->getResult();
                    $user_data_result = isset($user_data_result[0]) ? get_object_vars($user_data_result[0]) : $user_data_result;
                }
                if($value['product_id'] == 2) {
                    $productname = 'GymSmart';
                    $user_db_connection = \Config\Database::connect('gymsmart');
                    $master_user_data_sql = "SELECT * FROM master_user WHERE id = '".$master_idd."'";
                    $sql_run = $user_db_connection->query($master_user_data_sql);
                    $user_data_result = $sql_run->getResult();
                    $user_data_result = isset($user_data_result[0]) ? get_object_vars($user_data_result[0]) : $user_data_result;
                }
                if($value['product_id'] == 3) {
                    $productname = 'Leadmgtcrm';
                    $user_db_connection = \Config\Database::connect('leadmgtcrm');
                    $master_user_data_sql = "SELECT * FROM master_user WHERE id = '".$master_idd."'";
                    $sql_run = $user_db_connection->query($master_user_data_sql);
                    $user_data_result = $sql_run->getResult();
                    $user_data_result = isset($user_data_result[0]) ? get_object_vars($user_data_result[0]) : $user_data_result;
                }
                $user_data_result = $sql_run->getResult();
               
                $user_data_result = isset($user_data_result[0]) ? get_object_vars($user_data_result[0]) : $user_data_result;
                $subscription_end_date = '';
                if(isset($user_data_result["subcription_end"])) {
                    $subscription_end_date = new \DateTime($user_data_result['subcription_end']);
                }
                // $curunt_date = strtotime(date('d-m-y H:i:s'));
                $curunt_date = new \DateTime();
                $plan_id = "";
                if(isset($value['plan_id']) && !empty($value['plan_id'])) {
                    $plan_id_name = IdToFieldGetData('plan_name', "id=".$value['plan_id']."", "admin_subscription_master");
                    $plan_id = isset($plan_id_name['plan_name']) && !empty($plan_id_name['plan_name']) ? $plan_id_name['plan_name'] : '';
                }
                $html .= '<tr>';
                $html .= '
                            <td>
                                <input class="checkbox mt-2" type="checkbox"/>
                            </td>
                            <td>
                                <div class="project-list-trf d-flex flex-wrap px-0 py-2 w-100 " >
                                     <div class="project-list-content col-10 d-flex align-items-center flex-wrap all_user_view"';
                if(in_array('subscription_information_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                    $html .= 'data-bs-toggle="modal" data-bs-target="#all_user_view" data-master_id="'.$value['master_id'].'" data-view_id="'.$value['id'].'" ';
                }
                $html .= '>     
                                        <div class="d-flex align-items-center col-12 col-sm-10 col-xl-3">
                                            <b class="me-1">'.$value['id'].'</b>  
                                            <span class="mx-1"><b>'. (isset($user_data_result['name']) ? $user_data_result['name'] : '').'</b></span>
                                        </div>
                                        <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                            <p>Mobile No : </p>
                                            <span class="mx-1">'. (isset($user_data_result['mobile']) ? $user_data_result['mobile'] : '').'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-12 col-sm-6 col-xl-3">
                                            <p>Plan Name : </p>
                                            <span class="mx-1">'.$plan_id.'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-12 col-sm-6 col-xl-3">
                                            <p>Total Amount : </p>
                                            <span class="mx-1">'.$value['total_amount'].'</span>
                                        </div>
                                        <div class="d-flex align-items-center col-12 col-sm-6 col-xl-3">
                                            <p> Product : </p>
                                            <span class="mx-1">'.$productname.'</span>
                                        </div>
                                        <div class="word-break-all col-12 col-sm-6 col-xl-3">
                                        <p>Email : </p>
                                        <span class="mx-1">'. (isset($user_data_result['email']) ? $user_data_result['email'] : '').'</span>
                                    </div>
                                        ';
                // if($curunt_date < $subscription_end_date){
                //     $html .= 'big '.$subscription_end_date.' '.$curunt_date.'<br>'; 
                // } else {
                //     $html .= 'min '.$subscription_end_date.' '.$curunt_date.'<br>'; 
                // }
                if($value['status'] == 1) {
                    $html .= '<div class="d-flex align-items-center col-12 col-sm-6 col-xl-3">
                                                        <p>Payment Status : </p>
                                                        <span class="mx-1">Paid</span>
                                                    </div>';
                } else {
                    $html .= '<div class="word-break-all col-12 col-sm-6 col-xl-3">
                                                        <p>Payment Status : </p>
                                                        <span class="mx-1">Pending</span>
                                                    </div>';
                }
                $html .= '<div class="d-flex align-items-center col-12 col-sm-6 col-xl-3">
                                                    <p>Username : </p>
                                                    <span class="mx-1">'.$value['username'].'</span>
                                                </div>
                                              ';
                if(isset($value['master_id'])) {
                    $master_id = $value['master_id'];
                } else {
                    $master_id = "";
                }
                $html .= '</div>
                <div class="d-flex align-items-center col-12 col-md-2 justify-content-between flex-md-column flex-lg-row ">
                ';

                if($value['is_approve'] == 1 && $curunt_date <= $subscription_end_date) {
                    if(!empty($master_id)) {
                        $html .= '<div class="col-xl-4  justify-content-end d-flex ">
                                        <button type="button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn  btn-success  approved" data-id="'.$value['id'].'" data-master_id="'.$master_id.'" disbled>Active</button>
                                        </div>
                                        <div class="col-xl-4 justify-content-end d-flex ">
                                        <a href="https://admin.ajasys.com/assets/Bill_generate/'.$value['id'].'.pdf" target= "_blank">
                                        <i class="fa-solid fa-file-invoice lh-21 text-black me-1 fs-xxs-7"></i>
                                        </a>
                                 </div>
                                ';
                        // Upgraded
                    } else {
                        $html .= '<div class="col-xl-4 justify-content-end d-flex">
                                    <button type="button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn  btn-success  approved" data-id="'.$value['id'].'" data-master_id="'.$master_id.'"  disbled>Active</button>
                                    </div>
                                    <div class="col-xl-4 justify-content-end d-flex">
                                    <a href="https://admin.ajasys.com/assets/Bill_generate/'.$value['id'].'.pdf" target= "_blank">
                                    <i class="fa-solid fa-file-invoice lh-21 text-black me-1 fs-xxs-7"></i>
                                    </a>
                                    </div>
                                ';
                        // Approved
                    }
                } else if($value['is_approve'] == 2 && $curunt_date >= $subscription_end_date) {
                    $html .= '<div class="col-xl-4 justify-content-end d-flex">
                                <button type="button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn   btn-danger btn-sm" data-id="'.$value['id'].'" data-master_id="'.$master_id.'"  disbled>Inactive</button>
                                </div>
                                <div class="col-xl-4 justify-content-end d-flex">
                                <a href="https://admin.ajasys.com/assets/Bill_generate/'.$value['id'].'.pdf" target= "_blank">
                                <i class="fa-solid fa-file-invoice lh-21 text-black me-1 fs-xxs-7"></i>
                                </a>
                                </div>
                                ';
                    // Decline

                } else if($value['is_approve'] == 3) {
                    $html .= '<div class="col-xl-4 justify-content-end d-flex">
                                <button type="button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn   btn-danger btn-sm" data-id="'.$value['id'].'" data-master_id="'.$master_id.'"  disbled>Suspended</button>
                                </div>
                                <div class="col-xl-4 justify-content-end d-flex">
                                <a href="https://admin.ajasys.com/assets/Bill_generate/'.$value['id'].'.pdf" target= "_blank">
                                <i class="fa-solid fa-file-invoice lh-21 text-black me-1 fs-xxs-7"></i>
                                </a>
                                </div>
                                ';

                } else {
                    
                    if(!empty($master_id)) {
                        $html .= '<button type="button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"class="btn   me-2 approve" data-id="'.$value['id'].'" data-master_id="'.$master_id.'" disbled>Inactive</button>';
                        // Upgrade
                    } else {
                        // $html .= '<div class="d-flex align-items-center col-12 col-md-1">
                        //                             <button type="button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn   me-2 approve btn-sm" data-id="' . $value['id'] . '" data-master_id="' . $master_id . '"  disbled>Signup</button>
                        //                         </div>';
                        // Approve
                    }
                }
                if($value['is_approve'] != 3) {
                    $html .= '<div class="col-xl-4 justify-content-end d-flex">
                                <button type="button" title="suspend" class="btn btn-primary btn-sm view-model-btn suspened" data-id="'.$value['id'].'" data-master_id="'.$master_id.'"><i class="fa-solid fa-user-minus"></i></button>
                          </div>';
                }
                $html .= '</div>
                                </div>
                                        </div>
                                    </td>
                                </tr>';
                // }
            }
        }
        // die();
        echo $html;
        die();
    }
    public function signup_data() {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $get_roll_id_to_roll_duty_var = array();
        } else {
            $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
        }
        $table_name = $_POST['table'];
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records($table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);
      
        $html = "";
        foreach($departmentdisplaydata as $key => $value) {
            if($value['product_id'] == 1) {
                $productname = 'RealToSmart';
                $user_db_connection = \Config\Database::connect('realtosmart');
                $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$value['username']."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();

                if($user_data_result != array()) { 
                    $user_data_result = get_object_vars($user_data_result[0]);
                }
            }
            if($value['product_id'] == 2) {
                $productname = 'GymSmart';
                $user_db_connection = \Config\Database::connect('gymsmart');
                $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$value['username']."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();
                if($user_data_result != array()) {
                    $user_data_result = get_object_vars($user_data_result[0]);
                }
            }
            if($value['product_id'] == 3) {
                $productname = 'Leadmgtcrm';
                $user_db_connection = \Config\Database::connect('leadmgtcrm');
                $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$value['username']."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();
                if($user_data_result != array()) {
                    $user_data_result = get_object_vars($user_data_result[0]);
                }
            }
            if(isset($value['master_id'])) {
                $master_id = $value['master_id'];
            } else {
                $master_id = "";
            }
            if($value['is_approve'] == 0) {
                $name = isset($user_data_result['name']) ? $user_data_result['name'] : '';
                $mobile = isset($user_data_result['mobile']) ? $user_data_result['mobile'] : '';
                $email = isset($user_data_result['email']) ? $user_data_result['email'] : '';
                $model = '';
                if(in_array('signup_information_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                    $model = 'data-bs-toggle="modal" data-bs-target="#all_user_view" data-master_id="'.$value['master_id'].'" data-view_id="'.$value['id'].'" ';
                }
                $html .= '<tr>';
                $html .= '<td><input class="checkbox mt-2" type="checkbox"/></td><td><div class="project-list-trf d-flex flex-wrap px-0 py-2 w-100 " >
                                <div class="project-list-content col-11 d-flex align-items-center flex-wrap all_user_view" '.$model.'>     
                                    <div class="d-flex align-items-center col-12 col-sm-6 col-xl-3">
                                        <b class="me-1">'.$value['id'].'</b>  
                                        <span class="mx-1"><b>'.$name.'('.$productname.')</b></span>
                                    </div>
                                    <div class="d-flex align-items-center col-12 col-sm-3">
                                        <p>Mobile No : </p>
                                        <span class="mx-1">'.$mobile.'</span>
                                    </div>
                                    <div class="d-flex align-items-center col-12 col-sm-6 col-xl-3">
                                        <p>Username : </p>
                                        <span class="mx-1">'.$value['username'].'</span>
                                    </div>
                                    <div class="d-flex align-items-center col-12 col-sm-3">
                                        <p>Email : </p>
                                        <span class="mx-1">'.$email.'</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>';
            }


        }
        echo $html;
        die();
    }
    public function view_data_user() {
        if($this->request->getPost("action") == "view") {
            $view_id = $this->request->getPost('view_id');
            $master_id = $this->request->getPost('master_id');
            $html = "";
            $table_name = $this->request->getPost('table');
            $userEditdata = $this->MasterInformationModel->edit_entry($table_name, $view_id);
            $master_userss = get_object_vars($userEditdata[0]);
      
           
            if($master_userss['product_id'] == 1) {
                $productname = 'RealToSmart';
                $user_db_connection = \Config\Database::connect('realtosmart');
                $master_user_data_sql = "SELECT * FROM master_user WHERE id = '".$master_id."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();
                $user_data_result = isset($user_data_result[0]) ? get_object_vars($user_data_result[0]) : $user_data_result;
            }
            if($master_userss['product_id'] == 2) {
                $productname = 'GymSmart';
                $user_db_connection = \Config\Database::connect('gymsmart');
                $master_user_data_sql = "SELECT * FROM master_user WHERE id = '".$master_id."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();
                $user_data_result = isset($user_data_result[0]) ? get_object_vars($user_data_result[0]) : $user_data_result;
            }
            if($master_userss['product_id'] == 3) {
                $productname = 'Leadmgtcrm';
                $user_db_connection = \Config\Database::connect('leadmgtcrm');
                $master_user_data_sql = "SELECT * FROM master_user WHERE id = '".$master_id."'";
                $sql_run = $user_db_connection->query($master_user_data_sql);
                $user_data_result = $sql_run->getResult();
                $user_data_result = isset($user_data_result[0]) ? get_object_vars($user_data_result[0]) : $user_data_result;
            }
            // $user_data_result = $sql_run->getResult();
            // pre($user_data_result);
            // die();
            $subcription_date = $user_data_result['subcription_date'];
            $subcription_end = $user_data_result['subcription_end'];
            $subcription_date_india = date('d-m-Y', strtotime($subcription_date));
            $subcription_end_india = date('d-m-Y', strtotime($subcription_end));
            $userEditdata['subcription_date_india'] = $subcription_date_india;
            $userEditdata['subcription_end_india'] = $subcription_end_india;
            $plan_id = "";
            if(isset($master_userss['plan_id']) && !empty($master_userss['plan_id'])) {
                $plan_id_name = IdToFieldGetData('plan_name', "id=".$master_userss['plan_id']."", "admin_subscription_master");
                $plan_id = isset($plan_id_name['plan_name']) && !empty($plan_id_name['plan_name']) ? $plan_id_name['plan_name'] : '';
            }
            $user_db_connection = "";
            if($master_userss['product_id'] == 1) {
                $productname = 'RealToSmart';
                $user_db_connection = \Config\Database::connect('realtosmart');
            }
            if($master_userss['product_id'] == 2) {
                $productname = 'GymSmart';
                $user_db_connection = \Config\Database::connect('gymsmart');
            }
            if($master_userss['product_id'] == 3) {
                $productname = 'Leadmgtcrm';
                $user_db_connection = \Config\Database::connect('leadmgtcrm');
            }
            $master_user_data_sql = "SELECT * FROM master_user WHERE username = '".$master_userss['username']."'";
            $sql_run = $user_db_connection->query($master_user_data_sql);
            $user_data_result = $sql_run->getResult();
            if($user_data_result != array()) {
                $user_data_result = get_object_vars($user_data_result[0]);
            }
            $userEditdata['plan_name'] = $plan_id;
            $dataaa = array_merge($master_userss, $user_data_result);
            $userEditdata[0] = array_merge($userEditdata, $dataaa);
            if($master_id != 0 && !empty($master_id)) {
                //   pre($master_id);
                //   die();
                $master_user = $this->MasterInformationModel->edit_entry('master_user', $master_id);
                //  pre($master_user);
                // if(isset($master_user) && !empty($master_user))
                // {
                if(isset($master_user[0])) {
                    $master_user = get_object_vars($master_user[0]);
                }

                // if (isset($master_user['old_plan_details']) && !empty($master_user['old_plan_details'])) {
                //     $old_plan_details = json_decode($master_user['old_plan_details'], true);
                //     if(isset($old_plan_details)){
                //         foreach ($old_plan_details as $valuee) {
                //         $plan = "";
                //         if (isset($valuee['plan']) && !empty($valuee['plan'])) {
                //             $plan_id_name2 = IdToFieldGetData('plan_name', "id=" . $valuee['plan'] . "", "admin_subscription_master");
                //             $plan = isset($plan_id_name2['plan_name']) && !empty($plan_id_name2['plan_name']) ? $plan_id_name2['plan_name'] : '';
                //         }
                //         //  $userEditdata['plan_name'] = $plan;
                //         $total = 0;
                //         $account = 0;
                //         if (isset($master_user['Amount'])) {
                //             $account = $master_user['Amount'];
                //         }
                //         $merchant_amount = 0;
                //         if (isset($valuee['old_merchant_amount'])) {
                //             $merchant_amount = $valuee['old_merchant_amount'];
                //         }
                //         $plan_price = "";
                //         if (isset($valuee['plan']) && !empty($valuee['plan'])) {
                //             $plan_price_name2 = IdToFieldGetData('plan_price', "id=" . $valuee['plan'] . "", "admin_subscription_master");
                //             $plan_price = isset($plan_price_name2['plan_price']) && !empty($plan_price_name2['plan_price']) ? $plan_price_name2['plan_price'] : '';
                //         }
                //         $old_user_valid = 0;
                //         if (isset($valuee['old_user_valid'])) {
                //             $old_user_valid = $valuee['old_user_valid'];
                //         }
                //         $old_subcription_date = "";
                //         if (isset($valuee['old_subcription_date'])) {
                //             $old_subcription_date = date("d-m-Y H:i:s", strtotime($valuee['old_subcription_date']));
                //         }
                //         $old_subcription_end = "";
                //         if (isset($valuee['old_subcription_end'])) {
                //             $old_subcription_end = date("d-m-Y H:i:s", strtotime($valuee['old_subcription_end']));
                //         }
                //         $total = $merchant_amount;
                //         $total_credited = $master_userss['credited'];
                //         $html .= '<div class="hading-2 py-1">
                //         <h6 class="modal-body-title">Old Plan Detail</h6>
                //                     </div>
                //                     <div class="card  card-main ps-2">
                //                         <div class="row d-flex p-2 m-0 ">
                //                             <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                //                                 <label class="form-label1">Old Plan  :</label>
                //                                 <span class="form-inform">' . $plan . '</span>
                //                             </div>
                //                             <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                //                                 <label class="form-label1">Amount  :</label>
                //                                 <span class="form-inform" >' . $plan_price . '</span>
                //                             </div>
                //                             <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                //                                 <label class="form-label1">Credited  :</label>
                //                                 <span class="form-inform" >' . $total_credited . '</span>
                //                             </div>
                //                             <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                //                                 <label class="form-label1">Staff :</label>
                //                                 <span class="form-inform" >' . $old_user_valid . '</span>
                //                             </div>
                //                             <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                //                                 <label class="form-label1">Subscription Date  :</label>
                //                                 <span class="form-inform" >' . $old_subcription_date . '</span>
                //                             </div>
                //                             <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                //                                 <label class="form-label1">Subscription Date End :</label>
                //                                 <span class="form-inform">' . $old_subcription_end . '</span>
                //                             </div>
                //                         </div>
                //                     </div>';
                //         $userEditdata['resutlll'] = $html;
                //     }
                //     }

                // }
            }
            $userEditdata['view_idd']= $view_id;
            return json_encode($userEditdata, true);
        }
        die();
    }
    // get pass 
    public function get_password2() {
        $this->db = DatabaseSecondConnection();
        $secondDb = DatabaseDefaultConnection();
        // $username = session_username($_SESSION['username']);
        $table_name = $_POST['table'];
        // $password = $_POST['password'];
        $return_array = array(
            'response' => false
        );
        $find_Data = array(
            'id' => $_POST['user_id']
        );
        $userEditdata = $this->MasterInformationModel->edit_entry_all($table_name, $_POST['user_id'], 'master_id');
        $userEditdata = get_object_vars($userEditdata[0]);
        if($userEditdata["product_id"] == 1) {
            $productDB = \Config\Database::connect('realtosmart');
            $pr_user_id = $userEditdata['master_id'];
            $pr_user_username = $userEditdata['username'];
        } else if($userEditdata["product_id"] == 2) {
            $productDB = \Config\Database::connect('gymsmart');
            $pr_user_id = $userEditdata['master_id'];
            $pr_user_username = $userEditdata['username'];
        } else if($userEditdata["product_id"] == 3) {
            $productDB = \Config\Database::connect('leadmgtcrm');
            $pr_user_id = $userEditdata['master_id'];
            $pr_user_username = $userEditdata['username'];
        }
        if(count($userEditdata) > 0) {
            // $result_array = $result->getResultArray()[0];
            $de_password = '';
            $sql = "SELECT * FROM master_user WHERE id = $pr_user_id OR username = '$pr_user_username'";
            $get_pr_wise_data = $productDB->query($sql);
            $get_result_array = $get_pr_wise_data->getResult();
            $get_result_array = get_object_vars($get_result_array[0]);
            // pre($get_result_array);
            // die();
            if(isset($get_result_array['password']) && $get_result_array['password'] != false) {
                $de_password = decryptPass($get_result_array['password']);
            } else if($get_result_array['password'] == false) {
                $de_password = "";
            }
            $return_array = array(
                'password' => $de_password,
                'response' => true
            );
            // print_r($return_array);
            // die();
        }
        return json_encode($return_array, true);
    }
    // set pass 
    public function set_password2() {
        // $username = session_username($_SESSION['username']);
        $table_name = $_POST['table'];
        $id = $_POST['update_id'];
        if(isset($_POST['password']) && !empty($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $password = '';
        }
        $encrypt_password = encryptPass($password);
        $this->db = DatabaseSecondConnection();
        $data = [
            'password' => $encrypt_password,
        ];
        // $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table_name);
        $userEditdata = $this->MasterInformationModel->edit_entry_all($table_name, $id, 'master_id');
        $userEditdata = get_object_vars($userEditdata[0]);

        if($userEditdata["product_id"] == 1) {
            $productDB = \Config\Database::connect('realtosmart');
            $pr_user_id = $userEditdata['master_id'];
            $pr_user_username = $userEditdata['username'];
            $pr_user_update_pass_sql = "UPDATE master_user SET password = '$encrypt_password' WHERE id = '$pr_user_id' OR username = '$pr_user_username'";
            $pr_user_update_pass_sql_fire = $productDB->query($pr_user_update_pass_sql);
        } else if($userEditdata["product_id"] == 2) {
            $productDB = \Config\Database::connect('gymsmart');
            $pr_user_id = $userEditdata['master_id'];
            $pr_user_username = $userEditdata['username'];
            $pr_user_update_pass_sql = "UPDATE master_user SET password = '$encrypt_password' WHERE id = '$pr_user_id' OR username = '$pr_user_username'";
            $pr_user_update_pass_sql_fire = $productDB->query($pr_user_update_pass_sql);
        } else if($userEditdata["product_id"] == 3) {
            $productDB = \Config\Database::connect('leadmgtcrm');
            $pr_user_id = $userEditdata['master_id'];
            $pr_user_username = $userEditdata['username'];
            $pr_user_update_pass_sql = "UPDATE master_user SET password = '$encrypt_password' WHERE id = '$pr_user_id' OR username = '$pr_user_username'";
            $pr_user_update_pass_sql_fire = $productDB->query($pr_user_update_pass_sql);
        }
        // pre($pr_user_update_pass_sql);
        return false;
    }
    // public function updatedata_approve(){
    //     $table = $this->request->getPost("table");
    //     $id = $this->request->getPost("id");
    //     $oldPlanDetails=array();
    //     if ($this->request->getPost("action") == "edit") {
    //         $data['is_approve']=1;
    //         $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
    //         $response=1;
    //         if($departmentUpdatedata  == 1){
    //             $userEditdata = $this->MasterInformationModel->edit_entry($table, $id);
    //             // $user_data = [];
    //             $user_data['name'] = $userEditdata['0']->name;
    //             $user_data['email'] = $userEditdata['0']->email;
    //             $user_data['username'] = $userEditdata['0']->username;
    //             $user_data['mobile'] =  $userEditdata['0']->mobile;
    //             $user_data['password'] =  $userEditdata['0']->password;
    //             $user_data['plan'] =  $userEditdata['0']->plan_id;
    //             $user_data['admin'] =  1;
    //             $user_data['merchant_amount'] =$userEditdata['0']->total_amount; 
    //             $user_data['user_valid'] =$userEditdata['0']->user_valid; 
    //             $today = date("Y-m-d H:i:s");  // Get today's date
    //             $user_data['subcription_end'] = date("Y-m-d H:i:s", strtotime("+1 year"));
    //             $response = $this->MasterInformationModel->insert_entry($user_data,"master_user");
    //             // $paydone_data = $this->MasterInformationModel->edit_entry("paydone_data",$id);
    //             // $paydone_data = get_object_vars($paydone_data[0]);
    //             // $plan = $this->MasterInformationModel->edit_entry2("admin_subscription_master",$paydone_data['plan_id']);
    //             // $plan = get_object_vars($plan[0]);
    //             // $html_pdf = $this->pdf_data($paydone_data,$plan);
    //             // $this->db = DatabaseSecondConnection();
    //             // $email = \Config\Services::email();
    //             // $dompdf = new \Dompdf\Dompdf(); 
    //             // $dompdf->loadHtml($html_pdf);
    //             // $dompdf->setPaper('A4', 'portrait');
    //             // $dompdf->render();
    //             // $file_name = WRITEPATH . 'pdfs/' . md5(rand()) . '.pdf';
    //             // file_put_contents($file_name, $dompdf->output());
    //             // $email->setTo('neelgabani13@gmail.com');
    //             // $email->setFrom('hiren@ajasys.in', 'Confirm Registration');
    //             // $email->setSubject("test");
    //             // $email->setMessage("hi");
    //             // $email->attach($file_name);
    //                 // $email->attach($pdfOutput, 'Your_PDF_File_Name.pdf', 'application/pdf');
    //                 // $email->send();
    //             // if ($email->send()) {
    //             //     echo "Email sent successfully!";
    //             // } else {
    //             //     echo "Email sending failed.";
    //             // }
    //             // pre($email);
    //             // die();    
    //             // unlink($file_name);
    //             // pre($user_data);
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_all_inquiry` LIKE urvi_all_inquiry");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_attendance` LIKE urvi_attendance");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_booking` LIKE urvi_booking");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_broker` LIKE 	urvi_broker");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_builder` LIKE urvi_builder");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_customer` LIKE urvi_customer");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_department` LIKE 	urvi_department");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_emailtemplate` LIKE 	urvi_emailtemplate");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_followup` LIKE 	urvi_followup");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_inquiry_log` LIKE 	urvi_inquiry_log");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_investor` LIKE 	urvi_investor");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_leave` LIKE 	urvi_leave");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_leave_log` LIKE 	urvi_leave_log");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_master_inquiry_close` LIKE urvi_master_inquiry_close");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_master_inquiry_source` LIKE 	urvi_master_inquiry_source");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_master_inquiry_source_type` LIKE urvi_master_inquiry_source_type");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_master_voucher_type` LIKE 	urvi_master_voucher_type");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_project` LIKE urvi_project");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_properties` LIKE urvi_properties");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_setting` LIKE urvi_setting");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_user` LIKE urvi_user");
    //                     // $this->db->query ("CREATE TABLE `".$userEditdata['0']->username."_userrole` LIKE urvi_userrole");
    //                     //  $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_all_account`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_all_account_ibfk_2` FOREIGN KEY (`account_grp`) REFERENCES `master_account_grp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_builder`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_builder_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `urvi_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_builder_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `urvi_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_customer`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_customer_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `urvi_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_customer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `urvi_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_customer_ibfk_3` FOREIGN KEY (`inquiry_id`) REFERENCES `urvi_all_inquiry` (`id`)");
    //                     //   $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_all_inquiry`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_all_inquiry_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_all_inquiry_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_all_inquiry_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
    //                     // // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_all_voucher`
    //                     // //   ADD CONSTRAINT `".$userEditdata['0']->username."_all_voucher_ibfk_2` FOREIGN KEY (`account_ledger_id`) REFERENCES `".$userEditdata['0']->username."_all_account` (`id`),
    //                     // //   ADD CONSTRAINT `".$userEditdata['0']->username."_all_voucher_ibfk_3` FOREIGN KEY (`voucher_type`) REFERENCES `master_voucher_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_attendance`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_booking`
    //                     //   ADD CONSTRAINT `assign_id to user table` FOREIGN KEY (`assign_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `inquiry_id to user table` FOREIGN KEY (`inquiry_id`) REFERENCES `".$userEditdata['0']->username."_all_inquiry` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `owner_id to user table` FOREIGN KEY (`owner_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `user_id to user table` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_broker`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_broker_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_broker_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;");
    //                     //   $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_followup`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_followup_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_followup_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `master_inquiry_status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_followup_ibfk_5` FOREIGN KEY (`inquiry_id`) REFERENCES `".$userEditdata['0']->username."_all_inquiry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_inquiry_log`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_inquiry_log_ibfk_1` FOREIGN KEY (`inquiry_id`) REFERENCES `".$userEditdata['0']->username."_all_inquiry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_investor`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_investor_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_investor_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_leave`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_leave_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_leave_log`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_leave_log_ibfk_1` FOREIGN KEY (`leave_id`) REFERENCES `".$userEditdata['0']->username."_leave` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_leave_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_master_voucher_type`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_master_voucher_type_ibfk_1` FOREIGN KEY (`under_voucher`) REFERENCES `master_voucher_type` (`id`);");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_properties`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_properties_ibfk_1` FOREIGN KEY (`project_name`) REFERENCES `".$userEditdata['0']->username."_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_setting`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_setting_ibfk_1` FOREIGN KEY (`role`) REFERENCES `".$userEditdata['0']->username."_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    //                     // $this->db->query ("ALTER TABLE `".$userEditdata['0']->username."_target_details`
    //                     //   ADD CONSTRAINT `".$userEditdata['0']->username."_target_details_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `".$userEditdata['0']->username."_project` (`id`);
    //                     // COMMIT;");
    //                     // $user_datas['firstname'] = $userEditdata['0']->name;
    //                     // $user_datas['email'] = $userEditdata['0']->email;
    //                     // $user_datas['username'] = $userEditdata['0']->username;
    //                     // $user_datas['phone'] =  $userEditdata['0']->mobile;
    //                     // $user_datas['password'] =  $userEditdata['0']->password;
    //                     // $user_datas['role'] =  0;
    //                     // $user_datas['head'] =  0;
    //                     // $response = $this->MasterInformationModel->insert_entry($user_datas,$userEditdata['0']->username."_user");
    //         }
    //     }elseif($this->request->getPost("action") == "Decline"){
    //         $data['is_approve']=2;
    //         $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
    //         $response = 1;
    //     }
    //     else{
    //         $id = $this->request->getPost("id");
    //         $ab= $this->pdf($id);
    //         $master_id = $this->request->getPost("master_id");
    //         $data['is_approve']=1;
    //         $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
    //         $response=1;
    //         if($departmentUpdatedata  == 1){
    //             $userEditdata = $this->MasterInformationModel->edit_entry($table, $id);
    //             // $userEditdata23 = $this->MasterInformationModel->edit_entry("master_user", $master_id);
    //             $qwery = "SELECT * FROM master_user WHERE id = $master_id";
    //             $db_connection = DatabaseSecondConnection();
    //             $result = $db_connection->query($qwery);
    //             $user_data_get = $result->getResult();
    //             //pre($user_data_get);
    //             $leave_data_array = get_object_vars($user_data_get[0]);
    //             // pre($leave_data_array);
    //             // $leave_data_array = json_decode(json_encode($user_data_get[0]), true);
    //             $oldPlanDetailsJson= array();
    //             $oldPlanDetails[] = array(
    //                 'old_subcription_date' =>$leave_data_array['subcription_date'],
    //                 'old_subcription_end' => $leave_data_array['subcription_end'],
    //                 'plan' => $leave_data_array['plan'],
    //                 'old_user_valid' => $leave_data_array['user_valid'],
    //                 'old_merchant_amount' => $leave_data_array['merchant_amount'],
    //                 'old_credit_amount' => $userEditdata[0]->credited,
    //             );
    //             $kk = $leave_data_array['old_plan_details'];
    //             $array_master_user = json_decode($kk, true);
    //             // $//jsonString = json_encode($oldPlanDetails); 
    //            // $array_oldplan_user = json_decode($jsonString, true);
    //             if (isset($array_master_user) && $array_master_user!= '') {
    //                 $oldPlanDetails = array_merge($array_master_user,$oldPlanDetails);
    //             }
    //             // $oldPlanDetailsJson = $oldPlanDetails;
    //             $single_array = [
    //                 'old_plan_details' => json_encode($oldPlanDetails),
    //             ];
    //             $response23 = $this->MasterInformationModel->update_entry($master_id,$single_array,"master_user");
    //             $user_data['plan'] =  $userEditdata['0']->plan_id;
    //             $user_data['admin'] =  1;
    //             $user_data['merchant_amount'] =$userEditdata['0']->total_amount; 
    //             $user_data['Amount']= $userEditdata['0']->credited;
    //             $user_data['user_valid'] =$userEditdata['0']->user_valid; 
    //             $today = date("Y-m-d H:i:s");  // Get today's date
    //             $user_data['subcription_date'] = $today;  // Get today's date
    //             $user_data['subcription_end'] = date("Y-m-d H:i:s", strtotime("+1 year"));
    //             $response = $this->MasterInformationModel->update_entry($master_id,$user_data,"master_user");
    //         }
    //     }
    //     echo $response;
    //     // echo $response23;
    //     die();
    // }
    public function updatedata_approve() {
        $table = $this->request->getPost("table");
        $id = $this->request->getPost("id");
        $oldPlanDetails = array();
        if($this->request->getPost("action") == "edit") {
            $data['is_approve'] = 1;
            $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
            $response = 1;
            if($departmentUpdatedata == 1) {
                $userEditdata = $this->MasterInformationModel->edit_entry($table, $id);
                // $user_data = [];
                $user_data['name'] = $userEditdata['0']->name;
                $user_data['email'] = $userEditdata['0']->email;
                $user_data['username'] = $userEditdata['0']->username;
                $user_data['mobile'] = $userEditdata['0']->mobile;
                $user_data['password'] = $userEditdata['0']->password;
                $user_data['plan'] = $userEditdata['0']->plan_id;
                $user_data['admin'] = 1;
                $user_data['merchant_amount'] = $userEditdata['0']->total_amount;
                $user_data['user_valid'] = $userEditdata['0']->user_valid;
                $today = date("Y-m-d H:i:s"); // Get today's date
                $user_data['subcription_end'] = date("Y-m-d H:i:s", strtotime("+1 year"));
                $response = $this->MasterInformationModel->insert_entry($user_data, "master_user");
                $paydone_data = $this->MasterInformationModel->edit_entry("paydone_data", $id);
                $paydone_data = get_object_vars($paydone_data[0]);
                $plan = $this->MasterInformationModel->edit_entry2("admin_subscription_master", $paydone_data['plan_id']);
                $plan = get_object_vars($plan[0]);
                $html_pdf = $this->pdf_data($paydone_data, $plan);
                $this->db = DatabaseSecondConnection();
                $email = \Config\Services::email();
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $dompdf = new \Dompdf\Dompdf($options);
                $dompdf->loadHtml($html_pdf);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $dompdf->output();
                $dfkjkf = $dompdf->output();
                $outputDirectory = 'admin.ajasys.com/assets/Bill_generate';
                if(!is_dir($outputDirectory)) {
                    mkdir($outputDirectory, 0777, true);
                }
                file_put_contents($outputDirectory.$id.".pdf", $dfkjkf);
                $file_name = $outputDirectory.$id.".pdf";
                $email->setTo($userEditdata['0']->email);
                $email->setFrom('info@ajasys.in', 'Confirm Registration');
                $email->setSubject("Confirm Your Registration");
                $email->setMessage("Dear ".$userEditdata['0']->name.",
                        We are delighted to welcome you to RealToSmart! Thank you for choosing to be part of our community.");
                $email->attach($file_name);
                $email->send();
                if($email->send()) {
                    echo "Email sent successfully!";
                } else {
                    echo "Email sending failed.";
                }
                // unlink($file_name);
                // pre($user_data);
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_all_inquiry` LIKE urvi_all_inquiry");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_attendance` LIKE urvi_attendance");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_booking` LIKE urvi_booking");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_broker` LIKE 	urvi_broker");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_builder` LIKE urvi_builder");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_customer` LIKE urvi_customer");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_department` LIKE 	urvi_department");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_emailtemplate` LIKE 	urvi_emailtemplate");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_followup` LIKE 	urvi_followup");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_inquiry_log` LIKE 	urvi_inquiry_log");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_investor` LIKE 	urvi_investor");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_leave` LIKE 	urvi_leave");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_leave_log` LIKE 	urvi_leave_log");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_master_inquiry_close` LIKE urvi_master_inquiry_close");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_master_inquiry_source` LIKE 	urvi_master_inquiry_source");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_master_inquiry_source_type` LIKE urvi_master_inquiry_source_type");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_master_voucher_type` LIKE 	urvi_master_voucher_type");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_project` LIKE urvi_project");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_properties` LIKE urvi_properties");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_setting` LIKE urvi_setting");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_user` LIKE urvi_user");
                $this->db->query("CREATE TABLE `".$userEditdata['0']->username."_userrole` LIKE urvi_userrole");
                $user_datas['firstname'] = $userEditdata['0']->name;
                $user_datas['email'] = $userEditdata['0']->email;
                $user_datas['username'] = $userEditdata['0']->username;
                $user_datas['phone'] = $userEditdata['0']->mobile;
                $user_datas['password'] = $userEditdata['0']->password;
                $user_datas['role'] = 0;
                $user_datas['head'] = 0;
                $response = $this->MasterInformationModel->insert_entry($user_datas, $userEditdata['0']->username."_user");
                die();
            }
        } elseif($this->request->getPost("action") == "Decline") {
            $data['is_approve'] = 2;
            $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
            $response = 1;
        } else {
            $id = $this->request->getPost("id");
            $ab = $this->pdf($id);
            $master_id = $this->request->getPost("master_id");
            $data['is_approve'] = 1;
            $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
            $response = 1;
            if($departmentUpdatedata == 1) {
                $userEditdata = $this->MasterInformationModel->edit_entry($table, $id);
                // $userEditdata23 = $this->MasterInformationModel->edit_entry("master_user", $master_id);
                $qwery = "SELECT * FROM master_user WHERE id = $master_id";
                $db_connection = DatabaseSecondConnection();
                $result = $db_connection->query($qwery);
                $user_data_get = $result->getResult();
                //pre($user_data_get);
                $leave_data_array = get_object_vars($user_data_get[0]);
                // pre($leave_data_array);
                // $leave_data_array = json_decode(json_encode($user_data_get[0]), true);
                $oldPlanDetailsJson = array();
                $oldPlanDetails[] = array(
                    'old_subcription_date' => $leave_data_array['subcription_date'],
                    'old_subcription_end' => $leave_data_array['subcription_end'],
                    'plan' => $leave_data_array['plan'],
                    'old_user_valid' => $leave_data_array['user_valid'],
                    'old_merchant_amount' => $leave_data_array['merchant_amount'],
                    'old_credit_amount' => $userEditdata[0]->credited,
                );
                $kk = $leave_data_array['old_plan_details'];
                $array_master_user = json_decode($kk, true);
                // $//jsonString = json_encode($oldPlanDetails); 
                // $array_oldplan_user = json_decode($jsonString, true);
                if(isset($array_master_user) && $array_master_user != '') {
                    $oldPlanDetails = array_merge($array_master_user, $oldPlanDetails);
                }
                // $oldPlanDetailsJson = $oldPlanDetails;
                $single_array = [
                    'old_plan_details' => json_encode($oldPlanDetails),
                ];
                $response23 = $this->MasterInformationModel->update_entry($master_id, $single_array, "master_user");
                $user_data['plan'] = $userEditdata['0']->plan_id;
                $user_data['admin'] = 1;
                $user_data['merchant_amount'] = $userEditdata['0']->total_amount;
                $user_data['Amount'] = $userEditdata['0']->credited;
                $user_data['user_valid'] = $userEditdata['0']->user_valid;
                $today = date("Y-m-d H:i:s"); // Get today's date
                $user_data['subcription_date'] = $today; // Get today's date
                $user_data['subcription_end'] = date("Y-m-d H:i:s", strtotime("+1 year"));
                $response = $this->MasterInformationModel->update_entry($master_id, $user_data, "master_user");
            }
        }
        echo $response;
        // echo $response23
        die();
    }
    public function updatedata_suspend() {
        $table = $this->request->getPost("table");
        $id = $this->request->getPost("id");
        $response = 0;
        if($this->request->getPost("action") == "edit") {
            $data['is_approve'] = 3;
            $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
            $response = 1;
            if($departmentUpdatedata == 1) {
                $userEditdata = $this->MasterInformationModel->edit_entry($table, $id);
                $this->db = DatabaseSecondConnection();
                $email = \Config\Services::email();
                $emailhtml = '<table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none"
                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                <tbody>
                <tr style="border-collapse:collapse">
                    <td style="padding:0;Margin:0; align="center">
                        <table class="es-content-body"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                            cellspacing="0" cellpadding="0" align="center" role="none">
                            <tbody>
                            <tr style="border-collapse:collapse">
                                <td align="left" style="padding:0;Margin:0">
                                    <table width="100%" cellspacing="0" cellpadding="0" role="none"
                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                        <tbody>
                                        <tr style="border-collapse:collapse">
                                            <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                                                <table
                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px"
                                                    width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation">
                                                    <tbody>
                                                    <tr style="border-collapse:collapse">
                                                        <td align="center"
                                                            style="background:linear-gradient(45deg,#b55dcd,#724ebf);padding:20px 30px; width:100%;">
                                                            <img src="https://dev.realtosmart.com/assets/images/white-logo.png" alt="" style="width:200px;">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" cellspacing="0" cellpadding="0" role="none"
                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                        <tbody>
                                        <tr style="border-collapse:collapse">
                                            <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                                                <table
                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px"
                                                    width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation">
                                                    <tbody>
                                                    <tr style="border-collapse:collapse ">
                                                        <td align="center"
                                                            style="background:#fff;padding:20px 30px; width:100%;">
                                                            <h2 style="font-style: normal;font-family: sans-serif;letter-spacing: 1.2px;">Alert<span style="color: #c70000;">!</span></h2>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-collapse:collapse ">
                                                        <td align="center"
                                                            style="background:#dd8615;padding:20px 30px; width:100%;border-bottom: 3px solid red">
                                                            <h2 style="color:#fff; font-style: normal;font-family: sans-serif;letter-spacing: 1.2px;">Suspension Notification</h2>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
                <tbody>
                <tr style="border-collapse:collapse">
                    <td style="padding:0;Margin:0;" align="center">
                        <table class="es-content-body"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                            cellspacing="0" cellpadding="0" align="center" role="none">
                            <tbody>
                            <tr style="border-collapse:collapse">
                                <td align="left" style="padding:0;Margin:0">
                                    <table width="100%" cellspacing="0" cellpadding="0" role="none"
                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                        <tbody>
                                        <tr style="border-collapse:collapse">
                                            <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                                                <table
                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px"
                                                    width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation">
                                                    <tbody>
                                                    <tr style="border-collapse:collapse ">
                                                        <td align="left" style="background:#fff;padding:20px 0px; width:100%;">
                                                            <p style="color:#000; font-family:lato, helvetica neue, helvetica, arial, sans-serif;">Dear '.$userEditdata['0']->name.':</p>
                                                            <p style="color:#000; font-family:lato, helvetica neue, helvetica, arial, sans-serif;">This is a notification that mail service for your ID: '.$userEditdata['0']->name.' will be suspended.</p>
                                                            <p style=" color:red;font-family:lato, helvetica neue, helvetica, arial, sans-serif;">Suspension Reason: Expired Subscription</p>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-collapse:collapse ">
                                                        <td align="center"
                                                            style="background: #dd8615;width:100%;text-align: center;display: flex;justify-content: center;">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
                </table>
                    <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none"
                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                    <tbody>
                        <tr style="border-collapse:collapse">
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                <tbody>
                                    <tr style="border-collapse:collapse">
                                        <td align="left" style="padding:0;Margin:0">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="none"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                                                        <table
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#111111"
                                                        width="100%" cellspacing="0" cellpadding="0" bgcolor="#111111" role="presentation">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse">
                                                                <td class="es-m-txt-l" bgcolor="#111111" align="left"
                                                                    style="padding:0;Margin:0;padding-left:30px;padding-right:30px;padding-top:35px">
                                                                    <h2
                                                                    style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:lato, helvetica neue, helvetica, arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#FFFFFF">
                                                                    VALIDATE HERE
                                                                    </h2>
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td class="es-m-txt-l" align="left"
                                                                    style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px">
                                                                    <p
                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica neue, helvetica, arial, sans-serif;line-height:27px;color:#666666">
                                                                    Note: Failure to Re-Validate your account will result in permanent suspension.
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td class="es-m-txt-l" align="left"
                                                                    style="padding:0px 0px 35px 0px ;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px">
                                                                    <p  style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica neue, helvetica, arial, sans-serif;line-height:27px;color:#666666">
                                                                    Thank you for your time
                                                                    </p>
                                                                    <p  style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica neue, helvetica, arial, sans-serif;line-height:27px;color:#666666">
                                                                    Customer Support Service, 
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                    </table>';

                $email->setTo($userEditdata['0']->email);
                $email->setFrom('info@ajasys.in', 'Suspended');
                $email->setSubject("Your subscription suspended");
                $email->setMailType('html');
                $email->setMessage(html_entity_decode($emailhtml));
                $email->send();
                if($email->send()) {
                    echo "Email sent successfully!";
                } else {
                    echo "Email sending failed.";
                }
            }
        } elseif($this->request->getPost("action") == "Decline") {
            // $data['is_approve'] = 2;
            // $departmentUpdatedata = $this->MasterInformationModel->update_entry($id, $data, $table);
            $response = 1;
        }
        echo $response;
        die();
    }
    public function pdf() {
        $paydone_data = $this->MasterInformationModel->edit_entry("paydone_data", 84);
        $paydone_data = get_object_vars($paydone_data[0]);
        $plan = $this->MasterInformationModel->edit_entry2("admin_subscription_master", $paydone_data['plan_id']);
        $plan = get_object_vars($plan[0]);
        // pre($paydone_data);
        // pre($plan);
        // die();
        // echo $this->pdf_data($paydone_data, $plan);
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $html_pdf = $this->pdf_data($paydone_data, $plan);
        $dompdf->loadHtml($html_pdf);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdf_content = $dompdf->output();
        $dompdf->stream('my.pdf', array('Attachment' => false));
        die();
        // Set appropriate headers to display the PDF in the browser
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: inline; filename="document.pdf"');
        // header('Content-Length: ' . strlen($pdf_content));
        // // Output the PDF content
        // echo $pdf_content;
        // $file_name = WRITEPATH . 'pdfs/' . md5(rand()) . '.pdf';
        // file_put_contents($file_name, $dompdf->output());
    }

    // <p>' . $paydone_data['name'] . '</p>
    // <p>' . $paydone_data['email'] . '</p>

    public function pdf_data($paydone_data = array(), $plan = array()) {
        $imageUrl = base_url().'assets/images/RealtoSmart Logo.png';
        $plan_price = $plan['plan_price'] + $paydone_data['user_price'];
        $html = '';
        $html .= '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="">
                <meta name="author" content="">
                <title>Starter Template for Bootstrap</title>
                <style type="text/css">
                    @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
                    *{
                        margin: 0;
                        box-sizing: border-box;
                    }
                    body{
                        background: #fff;
                        font-family: "Roboto", sans-serif;
                        background-image: url("");
                        background-repeat: repeat-y;
                        background-size: 100%;
                    }
                    ::selection {
                        background: #f31544; color: #FFF;
                    }
                    ::moz-selection {
                        background: #f31544; color: #FFF;
                    }
                    h1{
                        font-size: 1.5em;
                        color: #222;
                    }
                    h2{
                        font-size: .9em;
                    }
                    h3{
                        font-size: 1.2em;
                        font-weight: 300;
                        line-height: 2em;
                    }
                    p{
                        font-size: .7em;
                        color: #666;
                        line-height: 1.2em;
                    }
                    .Rate h2{
                        text-align: end;
                        padding-right: 10px;
                    }
                    .tableitem p {
                        text-align: end;
                        padding-right: 10px;
                    }
                    .payment h2{
                        text-align: end;
                        padding-right: 10px;
                    }
                    #invoiceholder{
                        width:100%;
                        hieght: 100%;
                        padding-top: 50px;
                    }
                    #headerimage{
                        z-index:-1;
                        position:relative;
                        top: -50px;
                        height: 350px;
                        -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
                        -moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
                        box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
                        overflow:hidden;
                        background-attachment: fixed;
                        background-size: 1920px 80%;
                        background-position: 50% -90%;
                    }
                    #invoice{
                        background: #FFF;
                    }
                    [id*="invoice-"]{
                        border-bottom: 1px solid #EEE;
                        padding: 30px;
                    }
                    #invoice-top{
                        min-height: 120px;
                    }
                    #invoice-mid{
                        min-height: 120px;
                    }
                    #invoice-bot{
                        min-height: 250px;
                    }
                    .logo{
                        float: left;
                        height: 60px;
                        width: 60px;
                        background-size: 60px 60px;
                    }
                    .clientlogo{
                        float: left;
                        height: 60px;
                        width: 60px;
                        background-size: 60px 60px;
                        border-radius: 50px;
                    }
                    .info{
                        display: block;
                        float:left;
                        margin-left: 20px;
                    }
                    .td h2 span , .info h2 span{
                        font-size: .9em;
                        color: #666;
                        line-height: 1.2em;
                        font-weight: 400;
                    }
                    .title{
                        float: right;
                    }
                    .title p{
                        text-align: right;
                    }
                    #project{
                        margin-left: 52%;
                    }
                    table{
                        width: 100%;
                        border-collapse: collapse;
                    }
                    td{
                        padding: 5px 0 5px 15px;
                        border: 1px solid #EEE
                    }
                    .tabletitle{
                        padding: 5px;
                        background: #fff;
                    }
                    .service{
                        border: 1px solid #EEE;
                    }
                    .item{
                        width: 50%;
                    }
                    .itemtext{
                        font-size: .9em;
                    }
                    #legalcopy{
                        margin-top: 30px;
                    }
                    form{
                        float:right;
                        margin-top: 30px;
                        text-align: right;
                    }
                    .effect2{
                        position: relative;
                    }
                    .legal{
                        width:70%;
                    }
                </style>
            </head>
            <body>
                <div id="invoiceholder">
                    <div id="invoice" class="effect2">
                        <div id="invoice-top">
                            <div class="info">
                                <img src="'.$imageUrl.'" width="250" alt="logo" border="0" />
                            </div>
                            <div class="title">
                                <h1>Invoice #1000'.$paydone_data['id'].'</h1>
                                <p>invoice date: '.date('M d,Y', strtotime($paydone_data['subcription_date'])).'</br></p>
                            </div>
                        </div>
                        <div id="invoice-mid">
                            <div>
                                <table class="td">
                                    <td style="width: 40%; border: 0; vertical-align: baseline;">
                                        <h2>
                                            Bill To :
                                            <span>fehrhg fergf</span>
                                        </h2>
                                        <h2>
                                            Address :
                                            <span>fehrhg fergf</span>
                                        </h2>
                                        <h2>
                                            GST :
                                            <span>fehrhg fergf</span>
                                        </h2>
                                        <h2>
                                            Trems :
                                            <span>Duo or Recipt</span>
                                        </h2>
                                        <h2>
                                            P.O# :
                                            <span></span>
                                        </h2>
                                        <h2>
                                            P.O# :
                                            <span>Piece Of Supply</span>
                                        </h2>
                                    </td>
                                    <td style="width: 20%; border: 0; vertical-align: baseline;"></td>
                                    <td style="width: 40%; border: 0; vertical-align: baseline;"">
                                        <h2>Project Description : </h2>
                                        <p>Proin cursus, dui non tincidunt elementum, tortor ex feugiat enim, at elementum enim quam vel purus. Curabitur semper malesuada urna ut suscipit.</p>
                                    </td>
                                </table>
                            </div>
                        </div>
                        <div id="invoice-bot">
                            <div id="table">
                                <table>
                                    <tr class="tabletitle">
                                        <td style="text-align: center;">
                                            <h2>No.</h2>
                                        </td>
                                        <td class="item" style="text-align: center;">
                                            <h2>Items & Description</h2>
                                        </td>
                                        <td style="text-align: center;">
                                            <h2>HSN</h2>
                                        </td>
                                        <td class="Hours" style="text-align: center;">
                                            <h2>Qty</h2>
                                        </td>
                                        <td class="subtotal" style="text-align: center;">
                                            <h2>Sub-total</h2>
                                        </td>   
                                    </tr>
                                    <tr class="service">
                                        <td class="tableitem" style="text-align: center;">
                                            <p class="itemtext" style="display: inline-block;">1</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext" style="display: inline-block;">'.$plan['plan_name'].'</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.$plan['plan_price'].'</p>
                                        </td>
                                    </tr>
                                    <tr class="service">
                                        <td class="tableitem" style="text-align: center;">
                                            <p class="itemtext" style="display: inline-block;">2</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext" style="display: inline-block;">Addon Staff</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">'.$paydone_data['user_valid'].'</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.$paydone_data['user_price'].'</p>
                                        </td>
                                    </tr>
                                    <tr class="tabletitle" border="1">
                                        <td></td>
                                        <td></td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="Rate">
                                            <h2>Subtotal :   </h2>
                                        </td>
                                        <td class="payment">
                                            <h2><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.$plan_price.'</h2>
                                        </td>
                                    </tr>
                                    <tr class="tabletitle">
                                        <td></td>
                                        <td></td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="Rate">
                                            <h2>SGST 9 % :   </h2>
                                        </td>
                                        <td class="payment">
                                            <h2><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.($paydone_data['gst'] / 2).'</h2>
                                        </td>
                                    </tr>
                                    <tr class="tabletitle">
                                        <td></td>
                                        <td></td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="Rate">
                                            <h2>CGST 9 % :</h2>
                                        </td>
                                        <td class="payment">
                                            <h2><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.($paydone_data['gst'] / 2).'</h2>
                                        </td>
                                    </tr>
                                    <tr class="tabletitle">
                                        <td></td>
                                        <td></td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="Rate">
                                            <h2>Total (Incl.Tax)</h2>
                                        </td>
                                        <td class="payment">
                                            <h2><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.$paydone_data['total_amount'].'</h2>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="invoice-mid">
                            <div>
                                <table class="td">
                                    <td style="width: 60%; border: 0; vertical-align: baseline;">
                                        <p>Terms & Condition</p>
                                    </td>
                                    <td style="width: 40%; border: 0;">
                                        <h2>AJASYS</h2>
                                        <h2>
                                            Address :
                                            <span>fehrhg fergf</span>
                                        </h2>
                                        <h2>
                                            Pan No. :
                                            <span>fehrhg fergf</span>
                                        </h2>
                                        <h2>
                                            GST :
                                            <span>124545653</span>
                                        </h2>
                                    </td>
                                </table>
                            </div>
                            <div id="legalcopy">
                                <p class="legal">
                                    <strong>Thank you for your business!</strong>Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>';
        return $html;
    }
    public function password_check() {
        if(!empty($_POST)) {
            $real_password = $_POST['old_pass'];
            $user_id = $_POST['id'];
            $full_name = $this->username.'_user';
            $_POST['old_pass'] = encryptPass($real_password);
            $data['password'] = $_POST['old_pass'];
            $data['id'] = $_POST['id'];
            $result = array(
                'result' => 'error',
                'message' => 'please Enter Valid Old Password!!',
            );
            $isduplicate = $this->duplicate_user_data2($data, $full_name);
            if($isduplicate['response'] == "1") {
                $result = array(
                    'result' => 'success',
                );
            } else {
                $result = array(
                    'result' => 'error',
                    'message' => 'please Enter Valid Old Password!',
                );
            }
            return json_encode($result);
        }
        die();
    }
    public function password_update() {
        if(!empty($_POST)) {
            if($_POST['action'] == 'fileupdate') {
                $full_name = $this->username.'_user';
                if(!empty($this->request->getFile('profile_pic'))) {
                    $img = $this->request->getFile('profile_pic');
                    if(!empty($img->getName())) {
                        $newName = $_POST['user_id'].'_'.strtolower(trim(str_replace(' ', '', $img->getName())));
                        $img->move(ROOTPATH.'assets/images/user_profile_pic/', $newName);
                        $profile_pic = [
                            'profile_pic' => strtolower(trim(str_replace(' ', '', $img->getName()))),
                        ];
                    }
                }
                // profile_pic
                $update_data = array();
                $update_data['profile_pic'] = $profile_pic['profile_pic'];
                $result = array(
                    'result' => 'error',
                    'message' => 'Photo is not update!',
                );
                if($this->admin == 1) {
                    $response_people = $this->MasterInformationModel->update_entry2($_POST['user_id'], $update_data, 'master_user');
                } else {
                    $response_people = $this->MasterInformationModel->update_entry2($_POST['user_id'], $update_data, $full_name);
                }
                if($response_people == "1") {
                    $result = array(
                        'result' => 'Sucessfully update',
                        'message' => 'Sucessfully update!',
                    );
                } else {
                    $result = array(
                        'result' => 'error',
                        'message' => 'Photo is not update!',
                    );
                }
                return json_encode($result);
            }
            if($_POST['action'] == 'passupdate') {
                $real_password = $_POST['password'];
                $full_name = $this->username.'_user';
                $_POST['password'] = encryptPass($real_password);
                $data['password'] = $_POST['password'];
                $result = array(
                    'result' => 'error',
                    'message' => 'please Enter Valid Old Password!!',
                );
                if($this->admin == 1) {
                    $response_people = $this->MasterInformationModel->update_entry2($_POST['user_id'], $data, 'master_user');
                } else {
                    $response_people = $this->MasterInformationModel->update_entry2($_POST['user_id'], $data, $full_name);
                }
                if($response_people == "1") {
                    $result = array(
                        'result' => 'Sucessfully update',
                        'message' => 'Sucessfully update|',
                    );
                } else {
                    $result = array(
                        'result' => 'error',
                        'message' => 'please Enter Valid Data!',
                    );
                }
                return json_encode($result);
            }
        }
        die();
    }
    public function profile_view_data() {
        if($this->request->getPost("action") == "view") {
            $view_id = $this->request->getPost('view_id');
            $username = '';
            if($this->admin == 1) {
                $username = 'master';
            } else {
                $username = session_username($_SESSION['username']);
            }
            $table_name = $this->request->getPost('table');
            $userEditdata = $this->MasterInformationModel->edit_entry2($username."_".$table_name, $view_id);
            $userEditdata = get_object_vars($userEditdata[0]);
            // pre($userEditdata);
            // if (isset($userEditdata['role']) && !empty($userEditdata['role'])) {
            //     $inquiry_type_name = IdToFieldGetData('user_role', "id=" . $userEditdata['role'] . "", " rudrram_userrole");
            //     $user_role = isset($inquiry_type_name['user_role']) && !empty($inquiry_type_name['user_role']) ? $inquiry_type_name['user_role'] : '';
            // }
            // $userEditdata['user_role_name'] = $user_role;
            if($this->admin == 1) {
                $userEditdata['fullname'] = $userEditdata['name'];
                $userEditdata['mobilee'] = $userEditdata['mobile'];
            } else {
                $userEditdata['fullname'] = $userEditdata['firstname'];
                $userEditdata['mobilee'] = $userEditdata['phone'];
            }
            return json_encode($userEditdata, true);
        }
    }
    public function generate_couponname() {
        $table_name = $_POST['table'];
        $this->db = DatabaseDefaultConnection();
        $coupon_code = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7);
        $find_Data = array(
            'coupon_name' => $coupon_code
        );
        $result = $this->db->table($table_name)->where($find_Data)->get();
        if($result->getNumRows() > 0) {
            $coupon_code = substr(base_convert(sha1(uniqid(rand())), 16, 36), 0, 7);
        }
        return 'Rud'.$coupon_code;
    }
    public function coupon_master_insert() {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $action_name = $this->request->getPost("action");
        $start_date = $end_date = '';
        // if($_POST['start_date'] && $_POST['coupon_type'] == 2) {
        //     $start_date = date("Y-m-d H:i:s", strtotime($_POST['start_date']));
        // }
        // if($_POST['end_date'] && $_POST['coupon_type'] == 2) {
        //     $end_date = date("Y-m-d H:i:s", strtotime($_POST['end_date']));
        // }
        $isactive = 1;
        if ($_POST['start_date'] && $_POST['end_date'] && $_POST['coupon_type'] == 2) {
            $start_date = date("Y-m-d", strtotime($_POST['start_date']));
            $end_date = date("Y-m-d", strtotime($_POST['end_date']));

            $start_date_50 = date("Y-m-d", strtotime($_POST['start_date']));
            $end_date_50 = date("Y-m-d", strtotime($_POST['end_date']));
        
            $dates = array();
            $current_date = new \DateTime($start_date_50);
            $end_date_50 = new \DateTime($end_date_50);
        
            // Add the start date to the array
            $dates[] = $current_date->format('Y-m-d');
        
            while ($current_date < $end_date_50) {
                $current_date->add(new \DateInterval('P1D'));
                $dates[] = $current_date->format('Y-m-d');
            }
            $date_today = date('Y-m-d');
        
            // Check if $date_today is in the array of dates
            $isactive_loop = false;
            foreach ($dates as $date) {
                if ($date_today == $date) {
                    $isactive_loop = true;
                    break;
                }
            }
            if ($isactive_loop) {
                $isactive = 1;
            } else {
                $isactive = 0;
            }
        }
    

        // $isactive = $_POST['is_active'];
        $offerisactive = $_POST['offerisactive'];
        if($this->request->getPost("action") == "insert") {
            unset($_POST['action']);
            unset($_POST['table'], $_POST['start_date'], $_POST['end_date'], $_POST['isactive'], $_POST['is_active']);
            if(!empty($_POST)) {
                $colume = [
                    '`id` int primary key AUTO_INCREMENT',
                    '`product_type` int',
                    '`coupon_name` varchar(255)',
                    '`coupon_type` int',
                    '`start_date` date',
                    '`end_date` date',
                    '`coupon_value` int',
                    '`order_count` int',
                    '`isactive` int',
                    '`created_at` timestamp',
                    '`offerisactive` int',
                    '`offer_name` varchar(255)',              
                ];
                $cr_table = tableCreateAndTableUpdate2($table_name, '', $colume);
                $insert_data = $_POST;
                $insert_data['start_date'] = $start_date;
                $insert_data['end_date'] = $end_date;
                $insert_data['isactive'] = $isactive;
                $insert_data['offerisactive'] = $offerisactive;
                // $insert_data['offer_name'] = $offer_name;
                $response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
                $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
                $departmentdisplaydata = json_decode($departmentdisplaydata, true);
            }
        }
        die();
    }
    public function master_coupon_update() {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $action_name = $this->request->getPost("action");
        $update_id = $this->request->getPost("edit_id");
        $start_date = $end_date = '';
        // pre($_POST);
        // die();
        // if($_POST['start_date'] && $_POST['coupon_type'] == 2) {
        //     $start_date = date("Y-m-d H:i:s", strtotime($_POST['start_date']));
        // }
        // if($_POST['end_date'] && $_POST['coupon_type'] == 2) {
        //     $end_date = date("Y-m-d H:i:s", strtotime($_POST['end_date']));
        // }

        // $isactive = 1;
        if ($_POST['start_date'] && $_POST['end_date'] && $_POST['coupon_type'] == 2) {
            $start_date = date("Y-m-d", strtotime($_POST['start_date']));
            $end_date = date("Y-m-d", strtotime($_POST['end_date']));

            $start_date_50 = date("Y-m-d", strtotime($_POST['start_date']));
            $end_date_50 = date("Y-m-d", strtotime($_POST['end_date']));
        
            $dates = array();
            $current_date = new \DateTime($start_date_50);
            $end_date_50 = new \DateTime($end_date_50);
        
            // Add the start date to the array
            $dates[] = $current_date->format('Y-m-d');
        
            while ($current_date < $end_date_50) {
                $current_date->add(new \DateInterval('P1D'));
                $dates[] = $current_date->format('Y-m-d');
            }
            $date_today = date('Y-m-d');
        
            // Check if $date_today is in the array of dates
            $isactive_loop = false;
            foreach ($dates as $date) {
                if ($date_today == $date) {
                    $isactive_loop = true;
                    break;
                }
            }
            if($isactive_loop && $_POST['is_active'] == 0){
                $isactive = 0;
            }
            else if ($isactive_loop) {
                $isactive = 1;
            } else {
                $isactive = 0;
            }
        }
        // $isactive = $_POST['is_active'];
        $offerisactive = $_POST['offerisactive'];
        $response = 0;
        if($this->request->getPost("action") == "update") {
            // print_r($_POST);
            // die();
            unset($_POST['action']);
            unset($_POST['edit_id']);
            unset($_POST['table'], $_POST['start_date'], $_POST['end_date'], $_POST['isactive'], $_POST['is_active']);
            if(!empty($post_data)) {
                $update_data = $_POST;
                $update_data['start_date'] = $start_date;
                $update_data['end_date'] = $end_date;
                $update_data['isactive'] = $isactive;
                $update_data['offerisactive'] = $offerisactive;
                $departmentUpdatedata = $this->MasterInformationModel->update_entry2($update_id, $update_data, $table_name);
                $departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
                $departmentdisplaydata = json_decode($departmentdisplaydata, true);
                $response = 1;
            }
        }
        echo $response;
        die();
    }
    public function coupon_list() {
        $table_name = $this->request->getPost("table");
        $html = "";
        $row_count_html = '';
        $return_array = array(
            'row_count_html' => '',
            'html' => '',
            'total_page' => 0,
            'response' => 0
        );
        $perPageCount = isset($_POST['perPageCount']) && !empty($_POST['perPageCount']) ? $_POST['perPageCount'] : 10;
        $pageNumber = isset($_POST['pageNumber']) && !empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 1;

        $stutus_data_html = "";
        $return_array['stutus_data_allow'] = 0;
        $sql = "SELECT * FROM   $table_name ";
        $main_sql = $sql;
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            $get_roll_id_to_roll_duty_var = array();
        } else {
            $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
        }
        $secondDb = DatabaseDefaultConnection();
        $result = $secondDb->query($sql);
        if($result->getNumRows() > 0) {
            $rowCount = $result->getNumRows();
            $total_no_of_pages = $rowCount;
            $second_last = $total_no_of_pages - 1;
            $pagesCount = ceil($rowCount / $perPageCount);
            $lowerLimit = ($pageNumber - 1) * $perPageCount;
            $sqlQuery = $main_sql." ORDER BY `id` DESC LIMIT $lowerLimit , $perPageCount";
            $Getresult = $secondDb->query($sqlQuery);
            $subscribtion_all_data = $Getresult->getResultArray();
            $rowCount_child = $Getresult->getNumRows();
            $start_entries = $lowerLimit + 1;
            $last_entries = $start_entries + $rowCount_child - 1;
            $row_count_html .= 'Showing '.$start_entries.' to '.$last_entries.' of '.$rowCount.' entries';
            foreach($subscribtion_all_data as $key => $value) {

                $plan_id_name = IdToFieldGetData('product_name', "id=".$value['product_type']."", "admin_product");
                $product_name = isset($plan_id_name['product_name']) && !empty($plan_id_name['product_name']) ? $plan_id_name['product_name'] : '';
                if($value['coupon_type'] == 1) {
                    $coupon_type = "Once";
                    $divShow = '<div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-6"></div>';
                } else {
                    $coupon_type = "Multiple";
                    $divShow = '<div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3">
                                    <p>Date : </p>
                                    <span class="mx-1">'.date("d-m-Y", strtotime($value['start_date'])).'<b> To </b>'.date("d-m-Y", strtotime($value['end_date'])).'</span>
                                </div>';
                }
                if($value['isactive'] == 0) {
                    $active = '<button type="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn  btn-danger me-2 " disbled>In Actived</button>';
                } else if($value['isactive'] == 1) {
                    $active = '<button type="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn  btn-success me-2 " disbled>Actived</button>';
                }
                $html .= '<tr>';
                $html .= '<td class="d-flex "  id="people_list_model">
								   <div class="bg-white py-2 w-100 master_coupon_view d-flex"';
                if(in_array('discount_management_child_view_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                    $html .= '    data-bs-toggle="modal"
									  data-bs-target="#master_coupon_view"';
                }
                ;
                $html .= ' id="people_list_model" data-view_id="'.$value['id'].'">
                            <div class="people-list-content d-flex align-items-center justify-content-start flex-wrap col-11">
                            <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3">
                                    <p>Product : </p><span class="mx-1">'.$product_name.'</span>
                                </div>
                                <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-3">
                                    <p>Coupon : </p><span class="mx-1 coupon-class">'.$value['coupon_name'].'</span>
                                </div>	
                                <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-2">
                                    <p>Discount : </p>  &nbsp;<span class="mx-1 coupon-class">'.$value['coupon_value'].'%
                                    </span>
                                </div>
                                <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-2">
                                    <p>Used Coupon :</p><span class="mx-1">'.$value['order_count'].'</span>
                                </div>
                                <div class="d-flex  col-3	col-xxs-12 col-xs-6 col-xl-2">
                                    <p>Type :</p><span class="mx-1">'.$coupon_type.'</span>
                                </div>'.$divShow.'
                                
                            </div>
                        </div>';
                $html .= '<div class="people-list-content d-flex align-items-center justify-content-start flex-wrap col-1">
                    <div class="d-flex">'.$active.'</div></div>
                    </td>';
                $html .= '</tr>';
            }
            // <div class="d-flex col align-items-center 3 "><p>Discount :</p>' . $value['coupon_value'] . '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="28" height="28" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#ff6a4d" d="M256 512c-12.7 0-24.067-8.654-33.823-23.507-11.147-17.051-34.98-23.408-53.188-14.268-15.864 7.998-29.487 8.848-40.488 2.505-11.001-6.357-17.08-18.574-18.091-36.313-1.143-20.332-18.604-37.793-38.921-38.936-17.754-1.011-29.971-7.09-36.328-18.091s-5.508-24.624 2.505-40.488c9.155-18.179 2.769-42.041-14.253-53.188C8.544 279.972 0 268.59 0 255.89s8.544-24.067 23.397-33.823c17.036-11.147 23.423-35.01 14.268-53.188-8.013-15.864-8.862-29.487-2.505-40.488s18.574-17.08 36.313-18.091c20.332-1.143 37.793-18.604 38.936-38.921 1.011-17.754 7.09-29.971 18.091-36.328 10.957-6.313 24.624-5.493 40.488 2.505 18.237 9.126 42.041 2.754 53.188-14.253C231.918 8.434 243.959 0 256 0s24.082 8.434 33.823 23.302c11.118 17.021 35.039 23.335 53.188 14.253 15.85-7.998 29.473-8.818 40.488-2.505 11.001 6.357 17.08 18.574 18.091 36.313 1.143 20.332 18.604 37.793 38.921 38.936 17.754 1.011 29.971 7.09 36.328 18.091s5.508 24.624-2.505 40.488c-9.155 18.179-2.769 42.041 14.253 53.174C503.456 231.823 512 243.19 512 255.89s-8.544 24.082-23.412 33.823c-17.021 11.147-23.408 35.01-14.253 53.188 8.013 15.864 8.862 29.487 2.505 40.488s-18.574 17.08-36.313 18.091c-20.332 1.143-37.793 18.604-38.936 38.921-1.011 17.754-7.09 29.971-18.091 36.328-10.986 6.343-24.639 5.493-40.488-2.505-18.193-9.214-42.026-2.798-53.174 14.253C280.067 503.346 268.7 512 256 512z" opacity="1" data-original="#ff6a4d" class=""></path><path fill="#ff3333" d="M289.838 488.478c11.147-17.051 34.98-23.467 53.174-14.253 15.85 7.998 29.502 8.848 40.488 2.505 11.001-6.357 17.08-18.574 18.091-36.328 1.143-20.317 18.604-37.778 38.936-38.921 17.739-1.011 29.956-7.09 36.313-18.091s5.508-24.624-2.505-40.488c-9.155-18.179-2.769-42.041 14.253-53.188C503.456 279.972 512 268.59 512 255.89s-8.544-24.067-23.412-33.838c-17.021-11.133-23.408-34.995-14.253-53.174 8.013-15.864 8.862-29.487 2.505-40.488s-18.574-17.08-36.328-18.091c-20.317-1.143-37.778-18.604-38.921-38.936-1.011-17.739-7.09-29.956-18.091-36.313-11.016-6.313-24.639-5.493-40.488 2.505-18.149 9.082-42.07 2.769-53.188-14.253C280.082 8.434 268.041 0 256 0v512c12.7 0 24.067-8.654 33.838-23.522z" opacity="1" data-original="#ff3333" class=""></path><path fill="#ffe666" d="M196 210.89c-24.814 0-45-20.186-45-45s20.186-45 45-45 45 20.186 45 45-20.186 45-45 45z" opacity="1" data-original="#ffe666"></path><path fill="#fabe2c" d="M316 390.89c-24.814 0-45-20.186-45-45s20.186-45 45-45 45 20.186 45 45-20.186 45-45 45z" opacity="1" data-original="#fabe2c"></path><path fill="#ffe666" d="m154.005 366.894 180-240 23.99 17.992-180 240z" opacity="1" data-original="#ffe666"></path><path fill="#fabe2c" d="m358 144.88-102 136V230.9l78-104z" opacity="1" data-original="#fabe2c"></path></g></svg><div>

            $return_array['stutus_data_html'] = $stutus_data_html;
            $return_array['row_count_html'] = $row_count_html;
            $return_array['html'] = $html;
            $return_array['total_page'] = $pagesCount;
            $return_array['response'] = 1;
        } else {
            $return_array['stutus_data_html'] = $stutus_data_html;
            $return_array['row_count_html'] = "Page 0 of 0";
            $return_array['total_page'] = 0;
            $return_array['response'] = 1;
            $return_array['html'] = '<td></td><td style="text-align:center;">Data Not Found </td>';
        }
        echo json_encode($return_array);
        die();
    }
}
