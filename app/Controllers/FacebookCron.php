<?php 
namespace App\Controllers;
use App\Models\MasterInformationModel;
use Config\Database;

class FacebookCron extends BaseController
{	
	public function __construct() {
		helper('custom','form','url');
		
		$db = db_connect();
		$this->MasterInformationModel = new MasterInformationModel($db);
		// $this->username = session_username($_SESSION['username']);
		// $this->admin = 0;
		// if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
		// 	$this->admin = 1;
		// }	
	}
	public function duplicate_data_check_mobile_number($table,$mobileno, $field="")
	{
		$this->db = DatabaseDefaultConnection();
		$i =0 ;
		if(!empty($field)){
			$sql = 'SELECT * FROM '.$table.' WHERE '.$field.' ='.$mobileno;
		}else{
			$sql = 'SELECT * FROM '.$table.' WHERE mobileno ='.$mobileno.' OR altmobileno='.$mobileno;
		}
		
		$result = $this->db->query($sql);
		if($result->getNumRows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	function validate_string_spaces_only($string) {
	    if(preg_match("/^[\w ]+$]/", $string)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	   function user_id_to_full_user_data($user_id)
    {
        $result_user_data = array();
        $this->db = DatabaseDefaultConnection();
        //$username = session_username($_SESSION['username']);
        //// pre($user_id);

        // die();
     
            $query =  $this->db->query('SELECT * FROM admin_user WHERE id = "' . $user_id . '"');
       


        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $result_user_data = $query->getResultArray()[0];
        }
        //    // pre($result_user_data );

        return $result_user_data;
    }


	public function facebook_cron_job()
	{

		$db_connection = DatabaseDefaultConnection();

		// $sql = 'SELECT * FROM booking';
		// $result = $db_connection->query($sql);
		// $rowCount = $result->getNumRows();
		//pre($rowCount );

		//$db_connection2 = \Config\Database::connect('leaddb');

		$sql = 'SELECT * FROM admin_realtosmart_integration';
		$result1 = $db_connection->query($sql);
		$rowCount1 = $result1->getNumRows();

		if($result1->getNumRows() > 0)
		{
			$inquiry_all_data = $result1->getResultArray();
			$table_name = 'all_inquiry';
			$user_list_executive = array();
			$not_valid_status = '"4","7","9"';
					//$sitewiseexecutive = "SELECT * FROM rudrram_user where switcher_active ='active' AND role_number  IN (".$not_valid_status.") ";
					$user_child = array();
					$user_parent = array();
					$sitewisechild = "SELECT t1.id AS child_id, t1.parent_id AS parent_id FROM admin_userrole t1 LEFT JOIN admin_userrole t2 ON t1.id = t2.parent_id WHERE t2.parent_id IS NULL";
					$cntdata =$db_connection->query($sitewisechild);
					$cntdatas = $cntdata->getResultArray();
					foreach ($cntdatas as $k => $v) {
							if(!empty($v['child_id'])){
								$user_child[] = $v['child_id'];
								$user_parent[] = $v['parent_id'];
							}
						
						}

						$exicutive_id = array();
						$manager_id = array();

						$exicutive_ids = 'SELECT id FROM admin_user WHERE switcher_active = "active" AND `role` IN ("'.implode('","',$user_child).'")';
						//$exicutive_data = mysqli_query($conn, $exicutive_ids);

							$exicutive_data =$db_connection->query($exicutive_ids);
							$exicutive_data = $exicutive_data->getResultArray();
							foreach ($exicutive_data as $k => $e_row) {
								$exicutive_id[] = $e_row['id'];
							
							}

						

						$manager_ids = "SELECT id FROM admin_user WHERE switcher_active = 'active' AND `role` IN (".implode(',',$user_parent).")";
						//$exicutive_dataa = mysqli_query($conn, $manager_ids);

						
						$exicutive_dataa =$db_connection->query($manager_ids);
							$exicutive_dataa =$exicutive_dataa->getResultArray();
							foreach ($exicutive_dataa as $k => $m_row) {
								$manager_id[] = $m_row['id'];
							
							}
						// while($m_row = mysqli_fetch_assoc($exicutive_dataa)){
						//     $manager_id[] = $m_row['id'];
						// }

						//$user_list_executive =array();
					
					// if(isset($user_child) && !empty($user_child)){
					// 	$sitewiseexecutive = "SELECT * FROM rudrram_user where switcher_active ='active' AND role IN (".implode(",",$user_child).")";
						
					// 	$cntdata =$db_connection->query($sitewiseexecutive);
					// 	$cntdatasa = $cntdata->getResultArray();

					// 	foreach ($cntdatasa as $k => $v) {

					// 	//if($v['job_location']  == $intrested_site){

					// 		if(!empty($v['job_location_id'])){
					// 			$user_list_executive[$v['job_location_id']][] = $v['id'];
					// 		}
					// 	//}
					// 	}
					// }
					
					// //pre($user_list_executive);
				
					


					// // $not_valid_status = '"3","6","8"';
					// if(isset($user_parent) && !empty($user_parent)){
					// 	$sitewisemanager = "SELECT * FROM rudrram_user where switcher_active ='active' AND role  IN (".implode(",",$user_parent).") ";
					// 	$cntdata =$db_connection->query($sitewisemanager);
					// 	$cntdatas_manger = $cntdata->getResultArray();
					
					// 	foreach ($cntdatas_manger as $k_m => $v_m) {

					// 		if(!empty($v_m['job_location_id'])){
					// 				$user_list_manager[$v_m['job_location_id']][] = $v_m['id'];
					// 		}
					// 	}
					// }




				// pre($user_list_manager);
				// pre($user_list_executive);

				// 	die();
			
			foreach ($inquiry_all_data as $key => $value) {

               // if($this->validate_string_spaces_only($value['full_name']) == true){

				if($value['fb_update'] == 0){
				    $intrested_site = "";

					if (ctype_alpha(str_replace(' ', '',$value['full_name'])) === false) {
								
					}else{

						if($value['form_id'] == 319057090659209 || $value['form_id'] ==982983173026580){

							$intrested_product = 'Realtosmart';
							//$code_property_sub_type = '11';
							//$code_property_type = 'Residential';
							//$intrested_site = 4;
							//$intrested_site_name = 'Anando Green Velly';
							$code_inquiry_type = '1';
							$code_inquiry_source_type = '2';

						}
					
						
						//if(!empty($intrested_site) ){
						
    						$form_id = $value['form_id'];
    						$deer = 'SELECT * FROM admin_realtosmart_integration where unquie_id IN ( SELECT max(unquie_id) FROM `admin_realtosmart_integration`  where `fb_update` = 1 group by form_id 
    									);';
    									//pre($deer);
    						$result1 = $db_connection->query($deer);
    						$cntdatasss = $result1->getResultArray();
    						$assign_id = 0;
    						foreach ($cntdatasss  as $user => $user_value) {
    							if($user_value['form_id'] == $form_id){
    								$assign_id = $user_value['assign_id']; 
    							}
    						}
    						$next = 0;
    						$cccd = 0;
    						if(isset($exicutive_id) && !empty($exicutive_id)){
							    $count = count($exicutive_id);
							    $values = array_values($exicutive_id);
							    $search= array_search($assign_id,$exicutive_id);
							    $next=$values[(1+$search)%count($values)];
							    $cccd = 1;
							} else if(isset($manager_id) && !empty($manager_id)){
							    $count = count($manager_id);
							    $values = array_values($manager_id);
							    $search= array_search($assign_id,$manager_id);
							    $next=$values[(1+$search)%count($values)];
							    $cccd = 1;
							}
    						date_default_timezone_set('Asia/Kolkata');
    						$nxt_follow_up = date('Y-m-d h:i:sa');						
    
    						$mobile_nffo_remove = str_replace(" ","",$value['phone_number']);
    
    						$mobile_nffo= substr($mobile_nffo_remove, -10);
    					    $cntdata_duplicate = "SELECT count(*) as count FROM admin_all_inquiry where mobileno='".$mobile_nffo."' OR altmobileno='".$mobile_nffo."'";
    					    $full = RemoveSpecialChar($value['full_name']);
    
    					    $cntdata =$db_connection->query($cntdata_duplicate);
    						$cntdatas = $cntdata->getResult();
    
    							$insert_data['assign_id'] =$next;
    							$insert_data['owner_id'] = $next;
    							$insert_data['user_id'] = $next;
    							$insert_data['head'] = 2;
    							$insert_data['mobileno'] = !empty($mobile_nffo) ? $mobile_nffo : '';
    							$insert_data['full_name'] =  isset($full) ? $full : '';
    							//$insert_data['subscription'] = isset($code_property_sub_type) ? $code_property_sub_type : '';
    							//$insert_data['intrested_area_name'] = $intrested_area;
    							//$insert_data['property_type' ]= isset($code_property_type) ? $code_property_type : '';
    							//$insert_data['intrested_site'] = isset($intrested_site) ? $intrested_site : '';
    							//$insert_data['intersted_site_name'] = isset($intrested_site_name) ? $intrested_site_name : '';
    							$insert_data['inquiry_type'] = isset($code_inquiry_type) ? $code_inquiry_type : '';
    							$insert_data['inquiry_source_type'] = isset($code_inquiry_source_type) ? $code_inquiry_source_type : ''; 
    							$insert_data['nxt_follow_up'] =isset($nxt_follow_up) ? $nxt_follow_up : ''; 
    							$insert_data['inquiry_status'] = "1";
    							$isduplicate = $this->duplicate_data_check_mobile_number("admin_" . $table_name, $mobile_nffo);
    							
    							if ($isduplicate == 0) {
    								//pre($mobile_nffo);
    								$response = $this->MasterInformationModel->insert_entry2($insert_data, "admin_" . $table_name);
    								$departmentdisplaydata = $this->MasterInformationModel->display_all_records2("admin_" . $table_name);
    								$departmentdisplaydata = json_decode($departmentdisplaydata, true);
    								$result['response'] = 1;
    								
    							} else {
    
    								$find_Array = array(
    									'mobileno' => $mobile_nffo,
    									'inquiry_status' => '7'
    								);
    								$find_Array_12 = array(
    									'mobileno' =>  $mobile_nffo,
    									'inquiry_status' => '12'
    								);
    								$find_Array_all = "SELECT * FROM admin_" . $table_name . " where mobileno='" . $mobile_nffo . "' OR altmobileno='" . $mobile_nffo . "'";
    
    								$find_Array_all = $this->db->query($find_Array_all);
    								$isduplicate_all_data = $find_Array_all->getResultArray();
    								$satusus_id = array('1', '2', '3', '4', '5', '6', '9', '10', '11', '13');
    								$repo = 0;
    								if (!empty($isduplicate_all_data)) {
    									foreach ($isduplicate_all_data as $key => $values) {
    										if (in_array($values['inquiry_status'], $satusus_id)) {
    											$repo = 1;
    										}
    									}
    								}
    
    								//pre("duplicate_".$mobile_nffo);
    
    
    								if ($repo == 0) {
    
    									$inquiry_log_data = array();
    									$response = $this->MasterInformationModel->insert_entry2($insert_data, "admin_" . $table_name);
    									if ($response) {
    										$inquiry_log_data['inquiry_id'] = $response;
    										$user_data =  $this->user_id_to_full_user_data($next);
    										$inquiry_log_data['inquiry_id'] = $response;
    										$inquiry_log_data['status_id'] = 1;
    									
    										$log_content = '';
    										if($insert_data['inquiry_status'] == "1"){
    												$log_content .= 'Auto Generated  Lead by Facebook And assign By '.$user_data['firstname'];
    										}
    										$inquiry_log_data['inquiry_log'] = $log_content;
    										$response_log = $this->MasterInformationModel->insert_entry2($inquiry_log_data, "admin_inquiry_log");
    										$result['response'] = 1;
    										$result['message'] = 'inquiry added succesfully !';
    									} else {
    										$result['response'] = 0;
    										$result['message'] = 'Something Went Wrong !';
    									}
    								}
    							}
    
    							
    					
    					
    						$sqls_user = 'UPDATE `admin_realtosmart_integration` SET `assign_id`="'.$next.'" WHERE `assign_id`="'.$value['assign_id'].'" AND `unquie_id` = '.$value['unquie_id'].'';
    						$user_update = $db_connection->query($sqls_user);
    						
    						$sqls = 'UPDATE `admin_realtosmart_integration` SET `fb_update`="1" WHERE `fb_update` ="0" AND `unquie_id` = '.$value['unquie_id'].'';
    					
    						$result1 = $db_connection->query($sqls);
						//}

						
					}
				}
               				
			}

		}
	}
	
}
