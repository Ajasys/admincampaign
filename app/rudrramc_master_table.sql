-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2023 at 11:47 PM
-- Server version: 10.5.17-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rudrramc_master_table`
--



--
-- Table structure for table `urvi_all_inquiry`
--

CREATE TABLE `urvi_all_inquiry` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `owner_id` int(15) NOT NULL DEFAULT 0,
  `assign_id` varchar(250) NOT NULL DEFAULT '0',
  `head_status` varchar(255) NOT NULL DEFAULT '0',
  `head` int(11) NOT NULL DEFAULT 0,
  `inquiry_status` varchar(50) NOT NULL DEFAULT '1' COMMENT '1 = Fresh 2 = contacted 3 = appointment 4 = visited  6 = Negotiations 7 = Dismissed  9 = feed back 10 = Re appointment 11 = Re Visited 12 = Booking 13 = Followup cnr  = 17',
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
  `isSiteVisit` int(11) NOT NULL DEFAULT 0 COMMENT '0="",1="visite",2="revisit"',
  `iscountvisit` int(255) NOT NULL DEFAULT 0,
  `visit_date` datetime NOT NULL DEFAULT current_timestamp(),
  `revisit_date` datetime NOT NULL,
  `visitedsite` varchar(255) NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp(),
  `isAppoitement` int(11) NOT NULL DEFAULT 0,
  `user_type` varchar(255) NOT NULL DEFAULT '1' COMMENT '1=people 2=broker 3=customer 4=investor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_booking`
--

CREATE TABLE `urvi_booking` (
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
  `main_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_broker`
--

CREATE TABLE `urvi_broker` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_builder`
--

CREATE TABLE `urvi_builder` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_customer`
--

CREATE TABLE `urvi_customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobileno` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `anni_date` varchar(255) NOT NULL,
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
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_followup`
--

CREATE TABLE `urvi_followup` (
  `id` int(11) NOT NULL,
  `inquiry_id` varchar(50) NOT NULL,
  `user_id` varchar(250) NOT NULL DEFAULT '0',
  `remark` text NOT NULL,
  `nxt_follow_up` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_inquiry_log`
--

CREATE TABLE `urvi_inquiry_log` (
  `id` int(11) NOT NULL,
  `inquiry_id` int(250) NOT NULL,
  `inquiry_log` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status_id` varchar(255) NOT NULL,
  `user_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_investor`
--

CREATE TABLE `urvi_investor` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_people`
--

CREATE TABLE `urvi_people` (
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_project`
--

CREATE TABLE `urvi_project` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_properties`
--

CREATE TABLE `urvi_properties` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_user`
--

CREATE TABLE `urvi_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `head` varchar(255) NOT NULL,
  `head_name` varchar(200) NOT NULL,
  `project` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `parent_id` varchar(255) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urvi_userrole`
--

CREATE TABLE `urvi_userrole` (
  `id` int(11) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `parent_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `access_page` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--


--
-- Indexes for dumped tables
--


-- Indexes for table `urvi_all_inquiry`
--
ALTER TABLE `urvi_all_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_booking`
--
ALTER TABLE `urvi_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_broker`
--
ALTER TABLE `urvi_broker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_builder`
--
ALTER TABLE `urvi_builder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_customer`
--
ALTER TABLE `urvi_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_followup`
--
ALTER TABLE `urvi_followup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_inquiry_log`
--
ALTER TABLE `urvi_inquiry_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_investor`
--
ALTER TABLE `urvi_investor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_people`
--
ALTER TABLE `urvi_people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_project`
--
ALTER TABLE `urvi_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_properties`
--
ALTER TABLE `urvi_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_user`
--
ALTER TABLE `urvi_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urvi_userrole`
--
ALTER TABLE `urvi_userrole`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT for dumped tables
--


-- AUTO_INCREMENT for table `urvi_all_inquiry`
--
ALTER TABLE `urvi_all_inquiry`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_booking`
--
ALTER TABLE `urvi_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_broker`
--
ALTER TABLE `urvi_broker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_builder`
--
ALTER TABLE `urvi_builder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_customer`
--
ALTER TABLE `urvi_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_followup`
--
ALTER TABLE `urvi_followup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_inquiry_log`
--
ALTER TABLE `urvi_inquiry_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_investor`
--
ALTER TABLE `urvi_investor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_people`
--
ALTER TABLE `urvi_people`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_project`
--
ALTER TABLE `urvi_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_properties`
--
ALTER TABLE `urvi_properties`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_user`
--
ALTER TABLE `urvi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urvi_userrole`
--
ALTER TABLE `urvi_userrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
