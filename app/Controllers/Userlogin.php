<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;

class Userlogin extends BaseController
{
	public function __construct()
	{
		helper('custom');
			$db = db_connect();
		$this->dbforge = \Config\Database::forge();
		$this->MasterInformationModel = new MasterInformationModel($db);
	}

	// occ type
	public function insert_data()
	{
		$duplicate_data = array();
		$post_data = $this->request->getPost();
		$table_name = $this->request->getPost("table");
		$action_name = $this->request->getPost("action");
		$password = $this->request->getPost("password");
		if ($this->request->getPost("action") == "insert") {
			unset($_POST['action']);
			unset($_POST['table']);
			unset($_POST['password']);
			if (!empty($_POST)) {
				$insert_data['password'] = encryptPass($password);
				$insert_data = $_POST;
				$duplicate_data['email'] = $_POST['email'];
				$duplicate_data['username'] = $_POST['username'];
				$isduplicate = duplicate_data($duplicate_data,$table_name);
				if ($isduplicate == 0) {
					$response = $this->MasterInformationModel->insert_entry2($insert_data,$table_name);
					$departmentdisplaydata = $this->MasterInformationModel->display_all_records2($table_name);
					$departmentdisplaydata = json_decode($departmentdisplaydata, true);

					 $this->db = \Config\Database::connect();
                     $this->db->query ("CREATE TABLE `".$_POST['username']."_all_inquiry` (
                          `id` int(10) NOT NULL,
                          `user_id` int(10) NOT NULL,
                          `owner_id` int(15) NOT NULL DEFAULT 0,
                          `assign_id` varchar(250) NOT NULL DEFAULT '0',
                          `head_status` varchar(255) NOT NULL DEFAULT '0',
                          `head` int(11) NOT NULL DEFAULT 0,
                          `inquiry_status` int(11) NOT NULL DEFAULT 1,
                          `full_name` varchar(250) NOT NULL,
                          `address` varchar(255) NOT NULL,
                          `dob` varchar(200) NOT NULL,
                          `anni_date` varchar(200) NOT NULL,
                          `mobileno` varchar(250) NOT NULL,
                          `altmobileno` varchar(250) NOT NULL,
                          `email` varchar(250) NOT NULL,
                          `houseno` varchar(250) NOT NULL,
                          `society` varchar(250) NOT NULL,
                          `area` varchar(250) NOT NULL,
                          `city` varchar(250) NOT NULL,
                          `state` varchar(255) NOT NULL,
                          `country` varchar(255) NOT NULL,
                          `property_type` varchar(250) NOT NULL,
                          `property_sub_type` varchar(250) NOT NULL,
                          `intrested_site` varchar(250) NOT NULL,
                          `intersted_site_name` varchar(200) NOT NULL,
                          `budget` varchar(250) NOT NULL,
                          `purpose_buy` varchar(250) NOT NULL,
                          `approx_buy` varchar(250) NOT NULL,
                          `intrested_area` varchar(250) NOT NULL,
                          `intrested_area_name` varchar(255) NOT NULL,
                          `inquiry_type` varchar(250) NOT NULL,
                          `inquiry_source_type` varchar(250) NOT NULL,
                          `appointment_date` datetime NOT NULL,
                          `nxt_follow_up` datetime NOT NULL,
                          `feedback` text NOT NULL,
                          `unit_no` varchar(200) NOT NULL,
                          `paymentref` varchar(200) NOT NULL,
                          `cash_pay` varchar(100) NOT NULL,
                          `dp_amount` varchar(100) NOT NULL,
                          `loan_amount` varchar(100) NOT NULL,
                          `remark` varchar(255) NOT NULL,
                          `inquiry_description` text NOT NULL,
                          `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                          `inquiry_cnr` int(11) NOT NULL DEFAULT 0,
                          `broker` varchar(255) NOT NULL,
                          `inquiry_close_reason` varchar(255) NOT NULL,
                          `isSiteVisit` int(11) NOT NULL DEFAULT 0,
                          `iscountvisit` int(255) NOT NULL DEFAULT 0,
                          `visit_date` datetime NOT NULL,
                          `revisit_date` datetime NOT NULL,
                          `visitedsite` varchar(255) NOT NULL,
                          `booking_date` datetime NOT NULL,
                          `isAppoitement` int(11) NOT NULL DEFAULT 0,
                          `user_type` varchar(255) NOT NULL DEFAULT '1',
                          `ad_id` varchar(255) NOT NULL,
                          `adset_id` varchar(255) NOT NULL,
                          `campaign_id` varchar(255) NOT NULL,
                          `campaign_name` varchar(255) NOT NULL,
                          `form_id` varchar(255) NOT NULL,
                          `form_name` varchar(255) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
                        
                        $this->db->query("CREATE TABLE `".$_POST['username']."_attendance` (
                              `id` int(11) NOT NULL,
                              `user_id` int(255) NOT NULL,
                              `entry_date_time` datetime NOT NULL,
                              `exit_date_time` datetime NOT NULL,
                              `hour_count` int(11) NOT NULL,
                              `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                              `status` int(100) NOT NULL DEFAULT 0,
                              `is_exit_day` int(11) NOT NULL DEFAULT 0,
                              `is_status` int(255) DEFAULT NULL COMMENT '0=absent , 1=present,2=leave,3=weekof'
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
                        $this->db->query("CREATE TABLE `".$_POST['username']."_booking` (
                              `id` int(11) NOT NULL,
                              `assign_id` varchar(200) NOT NULL DEFAULT '0',
                              `inquiry_id` int(11) NOT NULL,
                              `user_id` int(11) NOT NULL,
                              `owner_id` varchar(250) NOT NULL DEFAULT '0',
                              `mobileno` varchar(250) NOT NULL,
                              `partyname` varchar(250) NOT NULL,
                              `houseno` varchar(250) NOT NULL,
                              `societyname` text NOT NULL,
                              `area` varchar(250) NOT NULL,
                              `landmark` varchar(250) NOT NULL,
                              `code_city` varchar(250) NOT NULL,
                              `code_state` varchar(250) NOT NULL,
                              `code_country` varchar(250) NOT NULL,
                              `pincode` varchar(250) NOT NULL,
                              `pancard_no` varchar(250) NOT NULL,
                              `pancard_photo` varchar(250) NOT NULL,
                              `aadharno` varchar(250) NOT NULL,
                              `aadhar_card_front` varchar(250) NOT NULL,
                              `aadhar_card_back` varchar(250) NOT NULL,
                              `customer_Photo` varchar(250) NOT NULL,
                              `property_sub_type` varchar(250) NOT NULL,
                              `property_type` varchar(250) NOT NULL,
                              `project_name` varchar(250) NOT NULL,
                              `unitno` varchar(250) NOT NULL,
                              `unitsize` varchar(250) NOT NULL,
                              `construction` varchar(250) NOT NULL,
                              `btn_radio` varchar(250) NOT NULL,
                              `price` varchar(250) NOT NULL,
                              `extrawork` varchar(250) NOT NULL,
                              `total_price` varchar(250) NOT NULL,
                              `discount_price` varchar(250) NOT NULL,
                              `extraexpense` varchar(250) NOT NULL,
                              `switcher_amount` varchar(250) NOT NULL,
                              `amount` varchar(250) NOT NULL,
                              `payment_date` varchar(250) NOT NULL,
                              `duration_day` varchar(250) NOT NULL,
                              `loan_amount` varchar(250) NOT NULL,
                              `tokenamount` varchar(250) NOT NULL,
                              `tokenamountword` varchar(250) NOT NULL,
                              `token_amount_date` varchar(250) NOT NULL,
                              `token_by` varchar(250) NOT NULL,
                              `cheque_date` varchar(250) NOT NULL,
                              `cheque_no` varchar(250) NOT NULL,
                              `bank_name` varchar(250) NOT NULL,
                              `transaction_id` varchar(250) NOT NULL,
                              `kyc_check` text NOT NULL,
                              `it_check` text NOT NULL,
                              `res_check` text NOT NULL,
                              `bank_check` text NOT NULL,
                              `income_check` text NOT NULL,
                              `aaprox_document_submit_date` varchar(250) NOT NULL,
                              `cancle_booking` int(11) NOT NULL DEFAULT 0,
                              `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                              `main_price` varchar(255) NOT NULL,
                              `booking_by` varchar(255) NOT NULL,
                              `by_sse` varchar(255) NOT NULL,
                              `by_ssm` varchar(255) NOT NULL,
                              `by_broker` varchar(255) NOT NULL,
                              `by_customer` varchar(255) NOT NULL,
                              `booking_date` date NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
                            
                            $this->db->query("CREATE TABLE `".$_POST['username']."_broker` (
                              `id` int(11) NOT NULL,
                              `people_id` int(20) NOT NULL,
                              `assign_id` varchar(250) NOT NULL DEFAULT '0',
                              `user_id` int(11) NOT NULL,
                              `mobileno` varchar(20) NOT NULL,
                              `brokername` varchar(255) NOT NULL,
                              `firm_name` varchar(255) NOT NULL,
                              `address` varchar(255) NOT NULL,
                              `operational_area` varchar(255) NOT NULL,
                              `rera_reg_no` varchar(255) NOT NULL,
                              `gst_no` varchar(255) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");


                            $this->db->query ("CREATE TABLE `".$_POST['username']."_builder` (
                              `id` int(11) NOT NULL,
                              `assign_id` int(11) NOT NULL,
                              `people_id` int(11) NOT NULL,
                              `builderName` varchar(255) NOT NULL,
                              `user_id` varchar(255) NOT NULL,
                              `firm_name` varchar(255) NOT NULL,
                              `mobileno` varchar(255) NOT NULL,
                              `builderAddress` varchar(255) NOT NULL,
                              `builderPincode` varchar(255) NOT NULL,
                              `con_person_name` varchar(255) NOT NULL,
                              `con_person_no` varchar(255) NOT NULL,
                              `con_person_post` varchar(255) NOT NULL,
                              `p_shortname` varchar(255) NOT NULL,
                              `project_id` varchar(255) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                            $this->db->query ("CREATE TABLE `".$_POST['username']."_customer` (
                              `id` int(11) NOT NULL,
                              `user_id` int(11) NOT NULL,
                              `assign_id` int(11) NOT NULL,
                              `inquiry_id` int(11) NOT NULL,
                              `name` varchar(255) NOT NULL,
                              `mobileno` varchar(255) NOT NULL,
                              `dob` date NOT NULL,
                              `anni_date` date NOT NULL,
                              `houseno` varchar(255) NOT NULL,
                              `socity` varchar(255) NOT NULL,
                              `area` varchar(255) NOT NULL,
                              `city` varchar(255) NOT NULL,
                              `state` varchar(255) NOT NULL,
                              `country` varchar(255) NOT NULL,
                              `project_name` varchar(255) NOT NULL,
                              `project_type` varchar(255) NOT NULL,
                              `unit_no` varchar(255) NOT NULL,
                              `intrested_area` varchar(255) NOT NULL,
                              `created_at` datetime NOT NULL DEFAULT current_timestamp()
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
                            $this->db->query ("CREATE TABLE `".$_POST['username']."_followup` (
                              `id` int(11) NOT NULL,
                              `inquiry_id` varchar(50) NOT NULL,
                              `user_id` varchar(250) NOT NULL DEFAULT '0',
                              `remark` text NOT NULL,
                              `nxt_follow_up` datetime NOT NULL,
                              `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                              `status_id` varchar(255) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                            $this->db->query ("CREATE TABLE `".$_POST['username']."_inquiry_log` (
                                  `id` int(11) NOT NULL,
                                  `inquiry_id` int(250) NOT NULL,
                                  `inquiry_log` text NOT NULL,
                                  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                                  `status_id` varchar(255) NOT NULL DEFAULT '0',
                                  `user_id` varchar(11) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                            $this->db->query ("CREATE TABLE `".$_POST['username']."_investor` (
                              `id` int(11) NOT NULL,
                              `people_id` int(20) NOT NULL,
                              `assign_id` varchar(250) NOT NULL DEFAULT '0',
                              `user_id` int(11) NOT NULL,
                              `investor_name` varchar(255) NOT NULL,
                              `mobileno` varchar(255) NOT NULL,
                              `altmobileno` varchar(255) NOT NULL,
                              `dob` varchar(255) NOT NULL,
                              `email` varchar(255) NOT NULL,
                              `occupation` varchar(255) NOT NULL,
                              `houseno` varchar(255) NOT NULL,
                              `society` varchar(255) NOT NULL,
                              `landmark` varchar(255) NOT NULL,
                              `pincode` varchar(255) NOT NULL,
                              `area` varchar(255) NOT NULL,
                              `countryId` varchar(255) NOT NULL,
                              `stateId` varchar(255) NOT NULL,
                              `cityId` varchar(255) NOT NULL,
                              `intrested_site` varchar(255) NOT NULL,
                              `intersted_site_name` varchar(255) NOT NULL,
                              `property_sub_type` varchar(255) NOT NULL,
                              `property_sub_type_name` varchar(255) NOT NULL,
                              `image` varchar(255) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                            
                            $this->db->query ("CREATE TABLE `".$_POST['username']."_leave` (
                              `id` int(11) NOT NULL,
                              `user_id` int(11) NOT NULL,
                              `head` int(11) NOT NULL,
                              `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `under_team` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `date` datetime NOT NULL,
                              `reporting_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `leave_apply_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `leave_from_date` datetime NOT NULL,
                              `leave_to_date` datetime NOT NULL,
                              `leave_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `type_of_leave` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `status` int(11) NOT NULL DEFAULT 0,
                              `in_absemnt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `is_absemnt` int(11) NOT NULL DEFAULT 0,
                              `check_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'under_process'
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

                            
                            $this->db->query ("CREATE TABLE `".$_POST['username']."_master_inquiry_close` (
                              `id` int(11) NOT NULL,
                              `inquiry_close_reason` varchar(60) NOT NULL,
                              `inquiry_close_reason_description` varchar(200) NOT NULL,
                              `created_date` date NOT NULL DEFAULT current_timestamp()
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                            $this->db->query ("CREATE TABLE `".$_POST['username']."_master_inquiry_source` (
                              `id` int(11) NOT NULL,
                              `inquiry_source_type` varchar(200) NOT NULL,
                              `source` varchar(200) NOT NULL,
                              `description` varchar(200) NOT NULL,
                              `created_date` datetime NOT NULL DEFAULT current_timestamp()
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                            
                            $this->db->query ("CREATE TABLE `".$_POST['username']."_master_inquiry_source_type` (
                              `id` int(11) NOT NULL,
                              `inquiry_source_type` varchar(200) NOT NULL,
                              `created_date` datetime NOT NULL DEFAULT current_timestamp()
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                            $this->db->query ("CREATE TABLE `".$_POST['username']."_project` (
                                  `id` int(11) NOT NULL,
                                  `project_name` varchar(255) NOT NULL,
                                  `p_shortname` varchar(255) NOT NULL,
                                  `project_tagline` varchar(255) NOT NULL,
                                  `builder_name` varchar(255) NOT NULL,
                                  `landmark` varchar(255) NOT NULL,
                                  `address` varchar(255) NOT NULL,
                                  `project_location` varchar(255) NOT NULL,
                                  `cityId` varchar(255) NOT NULL,
                                  `stateId` varchar(255) NOT NULL,
                                  `countryId` varchar(255) NOT NULL,
                                  `pincode` varchar(255) NOT NULL,
                                  `logitude` varchar(255) NOT NULL,
                                  `latitude` varchar(255) NOT NULL,
                                  `gmap_link` varchar(255) NOT NULL,
                                  `reraid` varchar(255) NOT NULL,
                                  `project_type` varchar(255) NOT NULL,
                                  `project_sub_type` varchar(255) NOT NULL,
                                  `project_status` varchar(255) NOT NULL,
                                  `project_status_name` varchar(255) NOT NULL,
                                  `total_unit` varchar(255) NOT NULL,
                                  `unit_avail_sale` varchar(255) NOT NULL,
                                  `possession_time` varchar(255) NOT NULL,
                                  `launch_date` varchar(250) NOT NULL,
                                  `project_description` varchar(255) NOT NULL,
                                  `google_business_link` varchar(255) NOT NULL,
                                  `fb_link` varchar(255) NOT NULL,
                                  `insta_link` varchar(255) NOT NULL,
                                  `contact_person` varchar(255) NOT NULL,
                                  `contact_no` varchar(255) NOT NULL,
                                  `office_no` varchar(255) NOT NULL,
                                  `email` varchar(255) NOT NULL,
                                  `post` varchar(255) NOT NULL,
                                  `whatsapp_text` varchar(255) NOT NULL,
                                  `sms_txt` varchar(255) NOT NULL,
                                  `email_txt` varchar(255) NOT NULL,
                                  `switcher_bokrage` varchar(255) NOT NULL,
                                  `inward` varchar(255) NOT NULL,
                                  `broker` varchar(255) NOT NULL,
                                  `c2c` varchar(255) NOT NULL,
                                  `staff` varchar(255) NOT NULL,
                                  `tl` varchar(255) NOT NULL,
                                  `nameofplace` varchar(255) NOT NULL,
                                  `distance` varchar(255) NOT NULL,
                                  `near_place_photo` varchar(255) NOT NULL,
                                  `description` varchar(255) NOT NULL,
                                  `photos_label` text NOT NULL,
                                  `pdf` varchar(255) NOT NULL,
                                  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                                  `project_location_id` varchar(255) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                                $this->db->query ("CREATE TABLE `".$_POST['username']."_properties` (
                                  `id` int(10) NOT NULL,
                                  `project_name` varchar(225) NOT NULL,
                                  `owner_name` varchar(225) NOT NULL,
                                  `unit_no` varchar(225) NOT NULL,
                                  `property_side` varchar(225) NOT NULL,
                                  `property_size` varchar(225) NOT NULL,
                                  `construction_size` varchar(225) NOT NULL,
                                  `construction_type` varchar(225) NOT NULL,
                                  `build_up_area` varchar(225) NOT NULL,
                                  `carpet_area` varchar(225) NOT NULL,
                                  `property_floor` varchar(225) NOT NULL,
                                  `white` varchar(225) NOT NULL,
                                  `connection_charge` varchar(225) NOT NULL,
                                  `registry_charg` varchar(225) NOT NULL,
                                  `loan_expences` varchar(225) NOT NULL,
                                  `gst_charges` varchar(225) NOT NULL,
                                  `other_expences` varchar(225) NOT NULL,
                                  `property_maintenance` varchar(225) NOT NULL,
                                  `property_development` varchar(225) NOT NULL,
                                  `property_price` varchar(225) NOT NULL,
                                  `total_price` varchar(225) NOT NULL,
                                  `created_date` date NOT NULL DEFAULT current_timestamp()
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                        
                                $this->db->query ("CREATE TABLE `".$_POST['username']."_setting` (
                                  `id` int(11) NOT NULL,
                                  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `project` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


                                $this->db->query ("CREATE TABLE `".$_POST['username']."_user` (
                                  `id` int(11) NOT NULL,
                                  `username` varchar(255) NOT NULL,
                                  `firstname` varchar(255) NOT NULL,
                                  `profile_pic` varchar(255) NOT NULL,
                                  `role` varchar(255) NOT NULL,
                                  `head` varchar(255) NOT NULL,
                                  `parent_id` varchar(255) NOT NULL DEFAULT '0',
                                  `head_name` varchar(200) NOT NULL,
                                  `project` varchar(255) NOT NULL,
                                  `department` varchar(255) NOT NULL,
                                  `phone` varchar(250) NOT NULL,
                                  `email` varchar(255) NOT NULL,
                                  `password` varchar(255) NOT NULL,
                                  `altmobileno` varchar(255) NOT NULL,
                                  `dob` varchar(255) NOT NULL,
                                  `address` varchar(255) NOT NULL,
                                  `em_name` varchar(255) NOT NULL,
                                  `relation` varchar(255) NOT NULL,
                                  `em_mobile` varchar(255) NOT NULL,
                                  `bloodgroup` varchar(255) NOT NULL,
                                  `mob_allocation` varchar(255) NOT NULL,
                                  `join_date` varchar(255) NOT NULL,
                                  `job_location` varchar(255) NOT NULL,
                                  `pan_number` varchar(255) NOT NULL,
                                  `bank_name` varchar(255) NOT NULL,
                                  `ac_no` varchar(255) NOT NULL,
                                  `ifsc` varchar(255) NOT NULL,
                                  `branch_name` varchar(255) NOT NULL,
                                  `salary` varchar(255) NOT NULL,
                                  `allowance` varchar(255) NOT NULL,
                                  `total_pay` varchar(255) NOT NULL,
                                  `switcher_active` varchar(255) NOT NULL DEFAULT 'active',
                                  `active_form_time` varchar(255) NOT NULL,
                                  `active_to_time` varchar(255) NOT NULL,
                                  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                                  `week_of_day` varchar(255) NOT NULL DEFAULT 'sunday',
                                  `job_location_id` varchar(255) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                                $this->db->query ("CREATE TABLE `".$_POST['username']."_userrole` (
                                  `id` int(11) NOT NULL,
                                  `user_role` varchar(255) NOT NULL,
                                  `parent_id` varchar(255) NOT NULL,
                                  `department` varchar(255) NOT NULL,
                                  `access_page` text NOT NULL,
                                  `created_at` datetime NOT NULL DEFAULT current_timestamp()
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_all_inquiry`
                                    ADD PRIMARY KEY (`id`)");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_attendance`
                                ADD PRIMARY KEY (`id`)");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_booking`
                                ADD PRIMARY KEY (`id`)");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_broker`
                                ADD PRIMARY KEY (`id`)");

                                
                                $this->db->query ("ALTER TABLE ".$_POST['username']."_builder`
                                ADD PRIMARY KEY (`id`)");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_customer`
                                    ADD PRIMARY KEY (`id`)");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_leave`
                                    ADD PRIMARY KEY (`id`)");
                                $this->db->query ("ALTER TABLE `".$_POST['username']."_setting`
                                    ADD PRIMARY KEY (`id`)");
                                $this->db->query ("ALTER TABLE `".$_POST['username']."_followup`
                                ADD PRIMARY KEY (`id`)");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_master_inquiry_close`
                                ADD PRIMARY KEY (`id`)");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_master_inquiry_source`
                                ADD PRIMARY KEY (`id`)");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_master_inquiry_source_type`
                                ADD PRIMARY KEY (`id`)");
                                


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_inquiry_log`
                                    ADD PRIMARY KEY (`id`)");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_investor`
                                ADD PRIMARY KEY (`id`)");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_project`
                                    ADD PRIMARY KEY (`id`)");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_properties`
                                    ADD PRIMARY KEY (`id`)");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_user`
                                    ADD PRIMARY KEY (`id`)");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_userrole`
                                    ADD PRIMARY KEY (`id`)");
                                $this->db->query ("ALTER TABLE `".$_POST['username']."_master_inquiry_source_type`
                                     MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_master_inquiry_source`
                                     MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_master_inquiry_close`
                                     MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_attendance`
                                     MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_leave`
                                     MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_setting`
                                     MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");

                                $this->db->query ("ALTER TABLE `".$_POST['username']."_all_inquiry`
                                     MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_booking`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_broker`
                                 MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                $this->db->query ("ALTER TABLE `".$_POST['username']."_builder`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_customer`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_followup`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_inquiry_log`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_investor`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_project`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_properties`
                                    MODIFY `id` int(10) NOT NULL AUTO_INCREMENT");


                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_user`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


                                  $this->db->query ("ALTER TABLE `".$_POST['username']."_userrole`
                                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");


				
						
					$user_data['email'] = $_POST['email'];
					$user_data['username'] = $_POST['username'];
					$user_data['phone'] = $_POST['mobile'];
					$user_data['password'] = $password;
					$response = $this->MasterInformationModel->insert_entry2($user_data,$_POST['username']."_user");
					$result['response'] = 1;
					$result['msg'] = 'Sign up Sucessfully';

				} else {
					$result['response'] = 0;
					$result['msg'] = 'Duplicate username';
				}

			}else{
				$result['response'] = 0;
				$result['msg'] = 'Enter valid Data';
			}
			return json_encode($result);
		}
		die();
	}


	// public function user_login(){
	// 	$this->db = \Config\Database::connect();
  //   $secondDb = \Config\Database::connect('second');
	// 	$session = session();
	// 	date_default_timezone_set('Asia/Kolkata');
  //       $action_name = $this->request->getPost("action");
	// 	if($this->request->getPost("action")== "insert"){
	// 		unset($_POST['action']);
	// 		$result = array(
	// 			'result' => 0,
	// 			'message' => 'Login Failed !',
	// 		);
	// 		if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']))
	// 		{ 
	// 			$data ="";
	// 			if(strpos($_POST['username'], '_') !== false){
	// 				$usertable = explode("_",$_POST['username']);
	// 				if($secondDb->tableExists($usertable[0]."_user")){
	// 			    	$data =  $secondDb->table($usertable[0]."_user")->where('username', $_POST['username'])->get()->getRow();
	// 				}else{
	// 					$result = array(
	// 						'result' => 0,
	// 						'message' => 'Username not Exist !',
	// 					);
	// 				}
	// 			} else{
	// 			    $data =  $secondDb->table("master_user")->where('username', $_POST['username'])->get()->getRow();
	// 			}

	// 			// pre($data);
			
	// 			if(!empty($data)){
	// 				$pass = $data->password;
  //           		$authenticatePassword = encryptPass($_POST['password']);
  //           		$ses_data = array();
  //           		if($authenticatePassword == $pass){
  //           			foreach ($data as $key => $value) {
  //           					$ses_data[$key] = $value;
  //           			}
  //           			$ses_data['isLoggedIn'] = TRUE;
            			
	// 	                $session->set($ses_data);
	// 	                $result = array(
	// 						'result' => 1,
	// 						'message' => 'Login successfully!',
	// 					);
  //           		}else{
  //           			$result = array(
	// 						'result' => 0,
	// 						'message' => 'Password id incorrect!',
	// 					);
  //           		}
	// 			}else{
	// 				$result = array(
	// 					'result' => 0,
	// 					'message' => 'Username not Exist !',
	// 				);

	// 			}	



				
	 
	// 		}else{
			
  //                  $result = array(
	// 					'result' => 'error',
	// 					'message' => 'Your Login Detail Invalid!',
  //                  );
	  
	// 		}
	// 		return json_encode($result);
	// 	}
	// 	die();
	// }

  public function user_login()
  {
    
      $this->db = \Config\Database::connect();
    $secondDb = \Config\Database::connect('second');

      $session = session();
      date_default_timezone_set('Asia/Kolkata');
      $action_name = $this->request->getPost("action");
      // $username = session_username($_SESSION['username']);
      // $leave_from_to_date_get = leave_from_to_date_get();
      // pre($leave_from_to_date_get);
      // die();
      if ($this->request->getPost("action") == "insert") {
          unset($_POST['action']);
          $result = array(
              'result' => 0,
              'message' => 'Login Failed !',
          );
          if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
              $data = "";
              $datassss = "";
              if (strpos($_POST['username'], '_') !== false) {
                  $usertable = explode("_", $_POST['username']);
                  if ($secondDb->tableExists($usertable[0] . "_user")) {
                      $ses_data['user_name'] = $usertable[0];
                      $user_name = $usertable[0];
                      $data = $secondDb->table($usertable[0] . "_user")->where('username', $_POST['username'])->get()->getRow();
                      $datassss =  $secondDb->table("master_user")->where('username', $usertable[0])->get()->getRow();
                  } else {
                      $result = array(
                          'result' => 0,
                          'message' => 'Username not Exist !',
                      );
                  }
              } else {
                  $ses_data['user_name'] = $_POST['username'];
                  $user_name = $_POST['username'];
                  $data =  $secondDb->table("master_user")->where('username', $_POST['username'])->get()->getRow();
                  $datassss =  $secondDb->table("master_user")->where('username', $_POST['username'])->get()->getRow();
              }



              if (!empty($data)) {
                  $pass = $data->password;

                  $authenticatePassword = encryptPass(trim(str_replace(' ', '', $_POST['password'])));
                  $ses_data = array();


                  if ($authenticatePassword == $pass) {
                      foreach ($data as $key => $value) {
                          $ses_data[$key] = $value;
                      }
                      $ses_data['master'] = $datassss->id;
                      $ses_data['plan_exe'] = $datassss->plan_exe;
                      $ses_data['plan'] = $datassss->plan;
                      $ses_data['merchant_amount'] = $datassss->merchant_amount;
                      $ses_data['subcription_date'] = $datassss->subcription_date;
                      $ses_data['subcription_end'] = $datassss->subcription_end;
                      $ses_data['isLoggedIn'] = TRUE;

                      $session->set($ses_data);

                      $dayname = date('l');

                      if (isset($data->admin) && $data->admin == 1) {
                          $result = array(
                              'result' => 1,
                              'message' => 'Login successfully!',
                          );
                      }
                        else {

                           if (isset($data->switcher_active) && $data->switcher_active == "active") {

                               $login_Day = $data->week_of_day;
                               //pre();
                               if (strtolower($dayname) == $login_Day) {

                                   $result = array(
                                       'result' => 0,
                                       'message' => 'Today is Your week off day.',
                                   );
                               } else {

                                   $start_time = $data->active_form_time;
                                   $end_time = $data->active_to_time;
                                   $current_time = date('H:i');
                                   if ($start_time < $current_time && $current_time < $end_time) {
                                       if (isset($data->admin) && $data->admin == 1) {
                                           $userid = 0;
                                       } else {
                                           $userid = $data->id;
                                       }
                                    //   $qkry = "SELECT * FROM " . $user_name . "_attendance WHERE user_id = " . $userid . " AND DATE(entry_date_time) = CURDATE(); ";
                                    //   $result2 =  $secondDb->query($qkry);
                                    //   $qkry_data = $result2->getResultArray();
                                    //   //pre($qkry_data);
                                    //   $qery = "SELECT * FROM " . $user_name . "_leave WHERE status =1 AND user_id = " . $userid . "  ";
                                    //   $result2 = $secondDb->query($qery);
                                    //   $qery_data = $result2->getResultArray();

                                    //   $currentDate44 = date('Y-m-d');
                                    //   if (!empty($qery_data[0])) {
                                    //       if (isset($qery_data[0])) {
                                    //           $leave_from_date = $qery_data[0]['leave_from_date'];
                                    //           $leave_to_date = $qery_data[0]['leave_to_date'];
                                    //           // $user_id334 = $leave_data_get[0]['user_id'];
                                    //           // $status90 = $leave_data_get[0]['status'];
                                    //           $startDate_leave = new \DateTime($leave_from_date);
                                    //           $endDate_leave = new \DateTime($leave_to_date);
                                    //           $interval = new \DateInterval('P1D');
                                    //           $datePeriod_leave = new \DatePeriod($startDate_leave, $interval, $endDate_leave);
                                    //           $dates_leave = [];
                                    //           $dateArray = array();
                                    //           $dateArray[0] = date('Y-m-d');  
                                    //           foreach ($datePeriod_leave as $date_leave) {
                                    //               $dates_leave[] = $date_leave->format('Y-m-d');
                                    //           }
                                    //           // Adding the end date manually
                                    //           $dates_leave[] = $endDate_leave->format('Y-m-d');

                                    //           // Printing the dates
                                    //           foreach ($dates_leave as $date) {
                                    //               // echo $date . "\n";
                                    //               // pre($date);

                                    //           }
                                    //       }
                                    //   }
                                       // pre($dates_leave);
                                       // pre($dateArray);
                                       // pre($qery_data[0]['status']);

                                       // die();
                                       if (isset($qkry_data[0]['is_exit_day']) && ($qkry_data[0]['is_exit_day'] == 1)) {
                                           $result = array(
                                               'result' => 0,
                                               'message' => 'You Did already day off.',
                                           );
                                       } 
                                       // else if(in_array($dateArray[0],$dates_leave) && $qery_data[0]['status']==1){
                                       //     $result = array(
                                       //         'result' => 2,
                                       //         'message' => 'today your leave!',
                                       //     );
                                       // }
                                    
                                       else {
                                           $result = array(
                                               'result' => 1,
                                               'message' => 'Login successfully!',
                                           );
                                           $username = session_username($_POST['username']);
                                           // date_default_timezone_set('Asia/Kolkata');
                                           // $today_date = date('Y-m-d h:i:sa');
                                           $inquiry_log_data = array(
                                               // 'remark' =>$userfullname['fullname'].' Login',
                                               // 'created_at' => $today_date,

                                               'user_id' => $userid,
                                               'inquiry_log' => $_POST['username'] . ' Login',
                                           );
                                           $response_log = $this->MasterInformationModel->insert_entry2($inquiry_log_data, $username . "_inquiry_log");
                                       }
                                   } else {
                                       $result = array(
                                           'result' => 0,
                                           'message' => 'Your Login Time Out.',
                                       );
                                   }
                               }
                           } else {
                               $result = array(
                                   'result' => 0,
                                   'message' => 'You are Deactive user!',
                               );
                           }
                       }
                  } else {
                      $result = array(
                          'result' => 0,
                          'message' => 'Invalid Username and Password',
                      );
                  }
              } else {
                  $result = array(
                      'result' => 0,
                       'message' => 'Invalid Username and Password',
                  );
              }
          } else {

              $result = array(
                  'result' => 0,
                  'message' => 'Your Login Detail Invalid!',
              );
          }
          return json_encode($result);
      }
      die();
  }

	public function logout()
    {
        $session = session();
		
		// if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
		// 	$id = $_SESSION['id'];
		// 	if(isset($id) && !empty($id) && $id != 0){
		// 		$user_data = array(
		//         	'logout_time' => date('d-m-Y H:i:s')
		//         );
		//         $user_update_log = $this->update_user_log($user_log_id ,$user_data);
		// 	}
		// }
		
        $session->destroy();
        return redirect()->to(base_url('login'));
    }




}
