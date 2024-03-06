<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;

class ProjectInformation extends BaseController
{
    protected $db;
    public function __construct()
    {
        helper('custom');
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = session_username($_SESSION['username']);
        $this->admin = 0;
        if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
            $this->admin = 1;
        }
        
    }
    public function project_sub_type()
    {
        $id = $_REQUEST['id'];
        $db = db_connect();
        $qry = "SELECT * FROM `project_management_subtype`  WHERE  `id`='" . $_REQUEST['id'] . "'";
        //   print_r($qry);
        //         die();

        $result = $db->query($qry);
        $location_result = $result->getResult();



?>
        <?php
        foreach ($location_result as $key => $data_value) {

        ?>
            <option value="<?php echo $data_value->id; ?>" data-id="<?php echo $data_value->id; ?>"><?php echo $data_value->project_sub_type; ?></option>
<?php }

        die();
    }

    // dublicate data 
    public function duplicate_data($data, $table)
    {
        $this->db = DatabaseSecondConnection();
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

        $result = $this->db->query($sql);
        if ($result->getNumRows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // insert data
    public function insert_data()
    {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $username = session_username($_SESSION['username']);
        $user_id = $_SESSION['id'];
        $assign_id = $_SESSION['id'];

        if(!empty($this->request->getFile('image'))){

            $img = $this->request->getFile('image');
            if (!empty($img->getName())) {
               $newName = $_POST['mobileno'].'_'.strtolower(trim(str_replace(' ', '', $img->getName())));
               $img->move(ROOTPATH . 'assets/images/investor/', $newName);
               $image = [
                  'image' =>  strtolower(trim(str_replace(' ', '', $img->getName()))),
                  ];
            }
         }

        $action_name = $this->request->getPost("action");
        if ($this->request->getPost("action") == "insert") {
            unset($_POST['action']);
            unset($_POST['table']);
            if (!empty($_POST)) {
                $insert_data = $_POST;
                if($table_name == 'investor' || $table_name == 'broker' || $table_name == 'builder'){
                    $insert_data['user_id'] = $user_id;
                    $insert_data['assign_id'] = $assign_id;
                }
                
                // pre($insert_data);
                // die();
                $isduplicate = $this->duplicate_data($insert_data, $username . "_" . $table_name);
                if ($isduplicate == 0) {
                    $response = $this->MasterInformationModel->insert_entry($insert_data, $username . "_" . $table_name);
                    $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
                    $departmentdisplaydata = json_decode($departmentdisplaydata, true);
                    // return 1;
                } else {
                    return "error";
                }
            }
        }
        die();
    }

    // list data 
    public function project_show_list_data()
    {

        $table_name = $_POST['table'];
        $username = session_username($_SESSION['username']);

        $allow_data = json_decode($_POST['show_array']);


        $action = $_POST['action'];
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);


        $i = 1;
        $html = "";
        foreach ($departmentdisplaydata as $key => $value) {

            $html .= '<tr>';


            $html .= '
                        <td>
                            <input class="checkbox mx-3 mt-3" type="checkbox"/>
                        </td>
                        <td  class="d-flex">
                            <div class="project-list-trf px-0 py-2 w-100 project_view" data-view_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#project_view">
                                
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-xl-5">';
            $ts = "";
            foreach ($value as $k => $v) {
                if (in_array($k, $allow_data)) {
                    $ts .= '<div class="col"><span class="mx-1">' . $v . '</span></div>';
                }
            }
            $html .= $ts;
            $html .= '</div>
                            </div>
                        </td>';
        }
        $html .= '</tr>';
        echo $html;
        die();
    }

    // view data 
    public function view_data()
    {
        if ($this->request->getPost("action") == "view") {
            $view_id = $this->request->getPost('view_id');
            $table_name = $this->request->getPost('table');
            $username = session_username($_SESSION['username']);

            $userEditdata = $this->MasterInformationModel->edit_entry($username . "_" . $table_name, $view_id);
            return json_encode($userEditdata, true);
        }
        die();
    }

    // edit data 
    public function edit_data()
    {
        if ($this->request->getPost("action") == "edit") {
            $edit_id = $this->request->getPost('edit_id');
            $username = session_username($_SESSION['username']);

            $table_name = $this->request->getPost('table');
            $userEditdata = $this->MasterInformationModel->edit_entry($username . "_" . $table_name, $edit_id);

            return json_encode($userEditdata, true);
        }
        die();
    }

    // update data 
    public function update_data()
    {
        $post_data = $this->request->getPost();
        $table_name = $this->request->getPost("table");
        $username = session_username($_SESSION['username']);
        $action_name = $this->request->getPost("action");
        $update_id = $this->request->getPost("edit_id");
        $response = 0;
        if ($this->request->getPost("action") == "update") {
            //print_r($_POST);
            unset($_POST['action']);
            unset($_POST['edit_id']);
            unset($_POST['table']);
            if (!empty($post_data)) {
                $update_data = $_POST;
                $isduplicate = $this->duplicate_data($update_data, $username . "_" . $table_name);
                if ($isduplicate == 0) {
                    $departmentUpdatedata = $this->MasterInformationModel->update_entry($update_id, $update_data, $username . "_" . $table_name);
                    $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
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

    //delete
    public function delete_data()
    {
        if ($this->request->getPost("action") == "delete") {
            $delete_id = $this->request->getPost('id');

            $table_name = $this->request->getPost('table');
            $username = session_username($_SESSION['username']);

            $departmentdisplaydata = $this->MasterInformationModel->delete_entry($username . "_" . $table_name, $delete_id);
        }
        die();
    }

    // broker LIST DATA
    public function broker_show_list_data()
    {
        $table_name = $_POST['table'];
        $username = session_username($_SESSION['username']);
        $action = $_POST['action'];
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);

        $ts = "";
        $html = "";
                $getchild = array();
                $user_id = 0;
                if (!$this->admin == 1) {
                    $user_id = $_SESSION['id'];
                }
                $getchild = getChildIds($_SESSION['id']);
                if(!empty($getchild)){
                    array_push($getchild, $user_id);
                }
                    foreach ($departmentdisplaydata as $key => $value) {
                        if ($this->admin == 1) {
                            $access = 1;
                        }else if(in_array($value['user_id'],$getchild)){
                            $access = 1;
                        }
                        if( $access == 1){
            $html .= '<tr>';

            $html .= '
        <td>
            <input class="checkbox mx-3 mt-2" type="checkbox"/>
        </td>
        <td class="d-flex">
            <div class="broker-list-trf broker_view px-0 py-0 w-100" data-view_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#broker-view">
                 <div class="broker-list-content  d-flex align-items-center justify-content-between flex-wrap">
                      <div class=" investor-list-topbar-id-name d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4">
                           <b>' . $value['id'] . '</b>
                           <h6 class="mx-2">' . $value['brokername'] . '</h6>
                      </div>
                      <div class="d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4">
                           <p>Firm Name : </p>
                           <span class="mx-1">' . $value['firm_name'] . '</span>
                      </div>
                      <div class="d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4 flex-wrap">
                           <p>Office Address : </p>
                           <span class="mx-1 text-wrap">' . $value['address'] . '</span>
                      </div>
                      <div class="d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4">
                           <p>Operation Area : </p>
                           <span class="mx-1">' . $value['operational_area'] . '</span>
                      </div>
                      <div class="d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4">
                           <p>Rera Reg. No.: </p>
                           <span class="mx-1">' . $value['rera_reg_no'] . '</span>
                      </div>
                      <div class="d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4">
                           <p>GST. No : </p>
                           <span class="mx-1">' . $value['gst_no'] . '</span>
                      </div>
                 </div>
            </div>
       </td>';
        }
        $html .= '</tr>';
    }
        echo $html;
        die();
    }

    // builder LIST DATA
    public function builder_show_list_data()
    {
        $table_name = $_POST['table'];
        $username = session_username($_SESSION['username']);

        $action = $_POST['action'];
        $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);

        $ts = "";
        $html = "";
        $getchild = array();
        $user_id = 0;
            if (!$this->admin == 1) {
                $user_id = $_SESSION['id'];
            }
            $getchild = getChildIds($_SESSION['id']);
            if(!empty($getchild)){
                array_push($getchild, $user_id);
            }
        foreach ($departmentdisplaydata as $key => $value) {
            if ($this->admin == 1) {
                $access = 1;
            }else if(in_array($value['user_id'],$getchild)){
                $access = 1;
            }
        if( $access == 1){
            $html .= '<tr>';

            $html .= '
                        <td class="align-middle">
                            <input class="checkbox mx-3 mt-2" type="checkbox" />
                        </td>
                        <td class="d-flex">
                            <div class="builder-list-trf builder_view px-0 py-1 w-100"  data-view_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#builder_view">
                                <div class="builder-list-content d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="d-flex align-items-center  col-xxs-6 col-xs-6 col-xl-3 lh-21">
                                        <b class="">' . $value['id'] . '</b>
                                        <span class="mx-1"><b>' . $value['builderName'] . '</b></span>
                                    </div>
                                    <div class="d-flex align-items-center col-xxs-6 col-xs-6 col-xl-3 lh-21">
                                        <span class="mx-1">' . $value['firm_name'] . '</span>
                                    </div>
                                    <div class="d-flex align-items-center  col-xxs-6 col-xs-6 col-xl-3 lh-21">
                                        <span class="mx-1">' . $value['con_person_name'] . '</span>
                                    </div>
                                    <div class="d-flex align-items-center  col-xxs-6 col-xs-6 col-xl-3 lh-21">
                                        <span class="mx-1">' . $value['con_person_post'] . '</span>
                                    </div>
                                </div>
                            </div>
                        </td>';


            // $html .= '<td>' . $value['id'] . '</td>';
            // $html .= '<td >' . $value['builderName'] . '</td>';
            // $html .= '<td >' . $value['firm_name'] . '</td>';
            // $html .= '<td >' . $value['con_person_name'] . '</td>';
            // $html .= '<td >' . $value['con_person_post'] . '</td>';
        }

        $html .= '</tr>';
    }   
        echo $html;
        die();
    }

    // list data 
    public function investor_show_list_data()

    {
        // print_r($_REQUEST);
        // die();

        $table_name = $_POST['table'];

        $action = $_POST['action'];
        $username = session_username($_SESSION['username']);
        // $master_user_role = get_table_array_helper($username . '_investor');

        $departmentdisplaydata = $this->MasterInformationModel->display_all_records($username . "_" . $table_name);
        $departmentdisplaydata = json_decode($departmentdisplaydata, true);

        $ts = "";
        $i = 1;

        $html = "";
        $getchild = array();
        $user_id = 0;
        if (!$this->admin == 1) {
            $user_id = $_SESSION['id'];
        }
        $getchild = getChildIds($_SESSION['id']);
        if(!empty($getchild)){
              array_push($getchild, $user_id);
        }

        foreach ($departmentdisplaydata as $key => $value) {
            if ($this->admin == 1) {
                $access = 1;
            }else if(in_array($value['user_id'],$getchild)){
                $access = 1;
            }
        if( $access == 1){
            $html .= '<tr>';
            $html .= '
                                    <td>
                                        <input class="checkbox" type="checkbox" />
                                    </td>
                                    <td class="d-flex " 
                                   id="people_list_model">
                                       
                                       <div class="people-list-trf bg-white px-3 py-2 w-100 investor_view" data-bs-toggle="modal"
                                          data-bs-target="#investor_view" id="people_list_model" data-view_id="' . $value['id'] . '">
                                          <div
                                             class="people-list-topbar d-flex align-items-center justify-content-between  flex-wrap">
                                             <div class="people-list-topbar-id-name d-flex align-items-center col-xxs-12 col-xl-4">
                                                <p>
                                                   <b>' . $value['id'] . '</b>
                                                </p>
                                                <h6 class="mx-2">' . $value['investor_name'] . '</h6>
                                             </div>
                                          </div>
                                          <div
                                             class="people-list-content d-flex align-items-center justify-content-between flex-wrap">
                                             <div class="d-flex align-items-center col-3 col-xxs-5 col-xs-6 col-xl-3">
                                                <p>
                                                   <i class="fa-solid fa-user-tie lh-28 text-black me-1"></i>
                                                   Intrested Site  :
                                                </p>
                                                <span class="mx-1">' . $value['intersted_site_name'] . '</span>
                                             </div>
                                             <div class="d-flex align-items-center col-3 col-xxs-5 col-xs-6 col-xl-3">
                                                <p>Type : </p>
                                                <span class="mx-1">' . $value['property_sub_type_name'] . '</span>
                                             </div>
                                             <div class="d-flex align-items-center col-3 col-xxs-7 col-xs-6 col-xl-3">
                                                <p>City : </p>
                                                <span class="mx-1">' . $value['cityId'] . '</span>
                                             </div>
                                             <div class="d-flex align-items-center col-3 col-xxs-7 col-xs-6 col-xl-3">
                                             <p>Area : </p>
                                             <span class="mx-1">' . $value['area'] . '</span>
                                          </div>
                                          </div>
                                       </div>
                                    </td>';
            $html .= '</tr>';
        }
    }

        // die();



        echo $html;

        die();
    }
}
