<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
// $master_alert_setting = json_decode($master_alert_setting, true);
$smstemplate = json_decode($smstemplate, true);
$emailtemplate = json_decode($emailtemplate, true);
$whatsapp_template = json_decode($whatsapp_template, true);
$alert_setting = json_decode($alert_setting, true);
// pre($alert_setting);
$username = session_username($_SESSION['username']);
// $sql = "SELECT * FROM `" . $username . "_alert_setting`";
// $db_connection = \Config\Database::connect();
// $result = $db_connection->query($sql);
?>

<!-- sms settings start -->
<div class="main-dashbord p-2">
   <div class="container-fluid p-0">
      <div class="p-2">
         <div class="title-1">
            <i class="bi bi-gear-fill"></i>
            <h2>Alert Settings</h2>
         </div>
      </div>
      <div class="bg-white rounded-2 p-2 mb-2">
         <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
               <button class="nav-link  active  " id="user_alert_tab" data-bs-toggle="pill"
                  data-bs-target="#user_alert_main" type="button" role="tab" aria-controls="user_alert_main"
                  aria-selected="true">Staff Alert</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link   " id="inquiry_alert_tab" data-bs-toggle="pill"
                  data-bs-target="#inquiry_alert_main" type="button" role="tab" aria-controls="inquiry_alert_main"
                  aria-selected="false">Lead Alert</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link  " id="customer_alert_tab" data-bs-toggle="pill"
                  data-bs-target="#customer_alert_main" type="button" role="tab" aria-controls="customer_alert_main"
                  aria-selected="false">Customer Alert</button>
            </li>
         </ul>
      </div>
      <div class="tab-content p-0 " id="pills-tabContent">
         <div class="tab-pane fade show active" id="user_alert_main" role="tabpanel" aria-labelledby="user_alert_tab"
            tabindex="0">
            <div class="col-lg-12 col-12 mb-lg-0 bg-white p-3 rounded-2">
               <form action="" id="" name="">
                  <div class="col-12 px-2 mb-3">
                     <h5 class="fw-semibold">In App Notification</h5>
                  </div>
                  <?php
                  //   pre($master_alert_setting);
                  // foreach ($alert_setting as $key => $value) {
                  //  pre($value);
                  foreach ($master_alert_setting as $type_key => $type_value) {
                     $db_connection = \Config\Database::connect('second');
                     $query90 = "SELECT * FROM `" . $username . "_alert_setting` WHERE  alert_title= '" . $type_value['id'] . "'";

                     $result = $db_connection->query($query90);

                     $total_dataa_userr_2245 = $result->getResultArray();
                     if ($type_value['alert_name'] == 1 && $type_value['notification'] == 1) {
                        echo ' <div class="col-lg-12 col-12 mb-lg-0 d-flex alert_settings">';
                        echo '<div class="d-flex">';
                        echo '<label class="switch_toggle mb-1">';
                        if (isset($total_dataa_userr_2245[0]['is_alert']) && $total_dataa_userr_2245[0]['is_alert'] == "1") {
                           // pre($value);
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" checked >';
                        } else {
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" >';
                        }
                        echo '<span class="check_input round"></span>';
                        echo ' </label>';
                        echo '  <span class="fs-14 ms-1 fw-medium toggle_main" id="alert_title" data-id="' . $type_value["id"] . '">';
                        echo $type_value["alert_title"];
                        echo '  </span>';
                        echo ' </div>';
                        echo ' </div>';
                     }
                  }
                  ?>
                  <!-- </div> -->
               </form>
            </div>
            <div class="col-lg-12 col-12 mb-lg-0 bg-white p-3 rounded-2 mt-4 overflow-x-scroll">
               <form action="" id="user_form" name="user_form">
                  <div class="d-flex align-items-center">
                     <div class="col-lg-3 col-md-4 col-sm-6 px-2 pb-3 border-end col-12">
                        <h6 class="fw-semibold" id="alert_noti">External Notification</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 px-2 border-end">
                        <h6 class="" style="text-align:center;" name="sms[]">SMS</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 px-2 border-end">
                        <h6 class="" style="text-align:center;" name="email[]">Email</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 px-2 ]">
                        <h6 class="" style="text-align:center;" name="whatsapp[]">Whats app</h6>
                     </div>
                  </div>
                  <?php
                  //pre($alert_setting);
                  foreach ($master_alert_setting as $type_key => $type_value) {
                     // pre($type_key);
                     //pre($type_value);
                     $db_connection = \Config\Database::connect('second');
                     $query90 = "SELECT * FROM `" . $username . "_alert_setting` WHERE  alert_title= '" . $type_value['id'] . "'";

                     $result = $db_connection->query($query90);

                     $total_dataa_userr_22 = $result->getResultArray();
                     // $smsTemplateId = $total_dataa_userr_2245[0]['sms_template_id'] ?? '';
                     // pre($total_dataa_userr_22);
                  
                     if ($type_value['alert_name'] == 1 && $type_value['notification'] == 2) {
                        //  foreach ($alert_setting as $key => $value) {
                  
                        echo ' <div class="col-lg-12 col-12 mb-lg-0 d-flex alert_settings">';
                        echo '<div class="col-lg-3 col-md-4 col-sm-6 fs-14 px-2 border-end col-12">';
                        echo ' <div class="d-flex">';
                        echo '<label class="switch_toggle mb-1">';

                        if (isset($total_dataa_userr_22[0]['is_alert']) && $total_dataa_userr_22[0]['is_alert'] == "1") {
                           // pre($value);
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" checked >';
                        } else {
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" >';
                        }

                        //  echo '<input id="alert" name="alert_title" type="checkbox" value="'.$type_value["alert_title"].'" data-id="' . $type_value["id"] . '" ';
                        //  if( $total_dataa_userr_2245['is_alert'] == "1"){
                        //    "checked"
                        //  }
                        //  '>';
                  
                        echo '<span class="check_input round"></span>';
                        echo ' </label>';
                        echo '  <span class="fs-14 ms-1 fw-medium toggle_main" id="alert_title" data-id="' . $type_value["id"] . '" >';
                        echo $type_value["alert_title"];
                        echo '  </span>';
                        echo ' </div>';
                        echo ' </div>';

                        echo '<div class="col-12 col-lg-3 col-md-6 col-sm-6 px-2 d-flex alert_main justify-content-center 1 border-end">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox col-1 p-2">';
                        if (isset($total_dataa_userr_22[0]['is_sms']) && $total_dataa_userr_22[0]['is_sms'] == "0" || !isset($total_dataa_userr_22[0]['is_sms'])) {
                           // pre($value);
                           echo '<input class="alert_check" id="sms" name="alert_title" type="checkbox" value="0" data-id="' . $type_value["id"] . '"  >';
                        } else {
                           echo '<input class="alert_check" id="sms" name="alert_title" type="checkbox" value="" data-id="' . $type_value["id"] . '" checked >';

                        }

                        echo '</div>';
                        echo ' 
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker  mx-1 w-100">
                              <select class="selectpicker form-control main-control" id="is_sms" name="is_sms" data-id="' . $type_value["id"] . '" data-live-search="true">                          
                                 <option >select</option>  
                                 <option  value="1" ' . (isset($total_dataa_userr_22[0]['is_sms']) && $total_dataa_userr_22[0]['is_sms'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2" ' . (isset($total_dataa_userr_22[0]['is_sms']) && $total_dataa_userr_22[0]['is_sms'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3" ' . (isset($total_dataa_userr_22[0]['is_sms']) && $total_dataa_userr_22[0]['is_sms'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="sms_template_id" name="sms_template_id"  data-id="' . $type_value["id"] . '" >';
                        echo '<option  value="">Select Message</option>';
                        // pre($smstemplate);
                  
                        if (isset($smstemplate)) {
                           foreach ($smstemplate as $type_key => $type_valuee) {

                              if (isset($total_dataa_userr_22[0]['sms_template_id']) && $total_dataa_userr_22[0]['sms_template_id'] == $type_valuee["id"]) {
                                 // pre($value);
                                 echo '<option selected  disabled style="opacity: 1; color: black;" value="' . $type_valuee["id"] . '" data-sms_template_id="' . $type_valuee["id"] . '">' . $type_valuee["title"] . '</option>';
                              } else {
                                 echo '<option  value="' . $type_valuee["id"] . '" data-sms_template_id="' . $type_valuee["id"] . '">' . $type_valuee["title"] . '</option>';
                              }


                           }

                        }
                        //   pre($smstemplate);
                        echo ' </select>';

                        echo ' </div>';
                        echo '</div>';

                        echo '<div class="col-lg-3 col-md-6 col-sm-6 px-2 d-flex alert_main justify-content-center 2 border-end col-12">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox  p-2 col-1">';
                        if (isset($total_dataa_userr_22[0]['is_email']) && $total_dataa_userr_22[0]['is_email'] == "0" || !isset($total_dataa_userr_22[0]['is_email'])) {
                           // pre($value);
                           echo '<input class="alert_check"  id="email" name="alert_title" type="checkbox" value="0"  data-id="' . $type_value["id"] . '"  >';
                        } else {
                           echo '<input class="alert_check"  id="email" name="alert_title" type="checkbox" value=""  data-id="' . $type_value["id"] . '" checked >';

                        }

                        echo '</div>';
                        echo '
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker col-4 w-100 mx-1">
                              <select class="selectpicker form-control main-control" name="is_email" id="is_email" data-id="' . $type_value["id"] . '" data-live-search="true">
                                 <option  >select</option>                                    
                                 <option  value="1"  ' . (isset($total_dataa_userr_22[0]['is_email']) && $total_dataa_userr_22[0]['is_email'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2"  ' . (isset($total_dataa_userr_22[0]['is_email']) && $total_dataa_userr_22[0]['is_email'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3"  ' . (isset($total_dataa_userr_22[0]['is_email']) && $total_dataa_userr_22[0]['is_email'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>
                        ';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="email_template_id" name="email_template_id" data-id="' . $type_value["id"] . '"  >';
                        echo '<option  value="">Select Message</option>';
                        //   pre($type_value);
                        if (isset($emailtemplate)) {

                           foreach ($emailtemplate as $type_key => $type_values) {
                              if (isset($total_dataa_userr_22[0]['email_template_id']) && $total_dataa_userr_22[0]['email_template_id'] == $type_values["id"]) {
                                 // pre($value);
                                 echo '<option selected value="' . $type_values["id"] . '"  disabled style="opacity: 1; color: black;" data-email_template_id="' . $type_values["id"] . '">' . $type_values["title"] . '</option>';
                              } else {
                                 echo '<option value="' . $type_values["id"] . '" data-email_template_id="' . $type_values["id"] . '">' . $type_values["title"] . '</option>';
                              }

                           }
                        }
                        // pre($emailtemplate);
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';

                        echo '<div class="col-lg-3 col-md-6 col-sm-6 px-2 d-flex alert_main justify-content-center 3 col-12">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox col-1 p-2">';
                        if (isset($total_dataa_userr_22[0]['is_whatsapp']) && $total_dataa_userr_22[0]['is_whatsapp'] == "0" || !isset($total_dataa_userr_22[0]['is_whatsapp'])) {
                           // pre($value);
                           echo '<input class="alert_check"  id="whatsapp"    name="alert_title" type="checkbox" value="0" data-id="' . $type_value["id"] . '"  >';

                        } else {
                           echo '<input class="alert_check"  id="whatsapp"    name="alert_title" type="checkbox" value="" data-id="' . $type_value["id"] . '" checked  >';
                        }

                        echo '</div>';
                        echo '
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker w-100 col-3 mx-1">
                              <select class="selectpicker form-control main-control" id="is_whatsapp" data-id="' . $type_value["id"] . '" data-live-search="true">
                                 <option  >select</option>                                    
                                 <option  value="1" ' . (isset($total_dataa_userr_22[0]['is_whatsapp']) && $total_dataa_userr_22[0]['is_whatsapp'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2" ' . (isset($total_dataa_userr_22[0]['is_whatsapp']) && $total_dataa_userr_22[0]['is_whatsapp'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3" ' . (isset($total_dataa_userr_22[0]['is_whatsapp']) && $total_dataa_userr_22[0]['is_whatsapp'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>
                        ';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="whatsapp_template_id" name="whatsapp_template_id"  data-id="' . $type_value["id"] . '"  >';
                        echo '<option  value="">Select Message</option>';
                        // pre($smstemplate);
                  
                        if (isset($whatsapp_template)) {
                           foreach ($whatsapp_template as $type_key => $type_value1) {
                              if (isset($total_dataa_userr_22[0]['whatsapp_template_id']) && $total_dataa_userr_22[0]['whatsapp_template_id'] == $type_value1["id"]) {
                                 // pre($value);
                                 echo '<option selected value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                                 //  if (isset($total_dataa_userr_22[0]['whatsapp_template_id']) &&  $total_dataa_userr_22[0]     ['whatsapp_template_id'] ==  $type_value1["id"]) {
                                 //       echo '<option  disabled style="opacity: 1; color: black;" value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                                 //   } else {
                                 //       echo '<option value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                                 //   }
                              } else {
                                 echo '<option value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                              }

                           }
                        }
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';

                        echo '</div>';

                     }
                  }
                  // }
                  ?>
               </form>
            </div>
         </div>
         <div class="tab-pane fade" id="inquiry_alert_main" role="tabpanel" aria-labelledby="inquiry_alert_tab"
            tabindex="0">
            <div class="col-lg-12 col-12 bg-white p-3 rounded-2 overflow-x-scroll">
               <form action="" id="user_form" name="user_form">
                  <div class="d-flex align-items-center">
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 px-2 border-end col-3">
                        <h6 class="fw-semibold">Inquiry Notification</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 px-2 border-end col-3">
                        <h6 class="" style="text-align:center;">SMS</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 px-2 border-end col-3">
                        <h6 class="" style="text-align:center;">Email</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 px-2">
                        <h6 class="" style="text-align:center;">Whats app</h6>
                     </div>
                  </div>
                  <?php
                  foreach ($master_alert_setting as $type_key => $type_value) {
                     $db_connection = \Config\Database::connect('second');
                     $query90 = "SELECT * FROM `" . $username . "_alert_setting` WHERE  alert_title= '" . $type_value['id'] . "'";

                     $result = $db_connection->query($query90);

                     $total_dataa_userr_2245 = $result->getResultArray();

                     if ($type_value['alert_name'] == 2) {
                        echo ' <div class="col-lg-12 col-12 mb-lg-0 d-flex alert_settings">';
                        echo '<div class="col-12 col-lg-3 col-md-6 col-sm-6  fs-14 px-2 1 border-end">';
                        echo ' <div class="d-flex">';
                        echo '<label class="switch_toggle mb-1">';
                        if (isset($total_dataa_userr_2245[0]['is_alert']) && $total_dataa_userr_2245[0]['is_alert'] == "1") {
                           // pre($value);
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" checked >';
                        } else {
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" >';
                        }
                        echo '<span class="check_input round"></span>';
                        echo ' </label>';
                        echo '  <span class="fs-14 ms-1 fw-medium toggle_main">';
                        echo $type_value["alert_title"];
                        echo '  </span>';
                        echo ' </div>';
                        echo ' </div>';

                        echo '<div class="col-12 col-lg-3 col-md-6 col-sm-6 px-2  d-flex alert_main justify-content-center 8 border-end">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox col-1 p-2">';
                        if (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "0" || !isset($total_dataa_userr_2245[0]['is_sms'])) {
                           // pre($value);
                           echo '<input class="alert_check" id="sms" name="alert_title" type="checkbox" value="0" data-id="' . $type_value["id"] . '"  >';
                        } else {
                           echo '<input class="alert_check" id="sms" name="alert_title" type="checkbox" value="" data-id="' . $type_value["id"] . '" checked >';

                        }

                        echo '</div>';
                        echo ' 
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker mx-1 w-100">
                              <select class="selectpicker form-control main-control" id="is_sms" name="is_sms" data-id="' . $type_value["id"] . '" data-live-search="true">                          
                                 <option >select</option>  
                                 <option  value="1" ' . (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2" ' . (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3" ' . (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="sms_template_id" name="sms_template_id" data-id="' . $type_value["id"] . '" >';
                        echo '<option  value="">Select Message</option>';
                        // pre($smstemplate);
                  
                        if (isset($smstemplate)) {
                           foreach ($smstemplate as $type_key => $type_valuee) {

                              if (isset($total_dataa_userr_2245[0]['sms_template_id']) && $total_dataa_userr_2245[0]['sms_template_id'] == $type_valuee["id"]) {
                                 // pre($value);
                                 echo '<option selected  value="' . $type_valuee["id"] . '" data-sms_template_id="' . $type_valuee["id"] . '">' . $type_valuee["title"] . '</option>';
                              } else {
                                 echo '<option  value="' . $type_valuee["id"] . '" data-sms_template_id="' . $type_valuee["id"] . '">' . $type_valuee["title"] . '</option>';
                              }


                           }

                        }
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';

                        echo '<div class="col-12 col-lg-3 col-md-6 col-sm-6 px-2 d-flex alert_main justify-content-center 4 border-end">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox  p-2 col-1">';
                        if (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "0" || !isset($total_dataa_userr_2245[0]['is_email'])) {
                           // pre($value);
                           echo '<input class="alert_check"  id="email" name="alert_title" type="checkbox" value="0"  data-id="' . $type_value["id"] . '"  >';
                        } else {
                           echo '<input class="alert_check"  id="email" name="alert_title" type="checkbox" value=""  data-id="' . $type_value["id"] . '" checked >';

                        }

                        echo '</div>';
                        echo '
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker col-4 w-100 mx-1">
                              <select class="selectpicker form-control main-control" name="is_email" id="is_email" data-id="' . $type_value["id"] . '" data-live-search="true">
                                 <option  >select</option>                                    
                                 <option  value="1"  ' . (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2"  ' . (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3"  ' . (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>
                        ';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="email_template_id" name="email_template_id"  data-id="' . $type_value["id"] . '"  >';
                        echo '<option  value="">Select Message</option>';
                        if (isset($emailtemplate)) {

                           foreach ($emailtemplate as $type_key => $type_values) {
                              if (isset($total_dataa_userr_2245[0]['email_template_id']) && $total_dataa_userr_2245[0]['email_template_id'] == $type_values["id"]) {
                                 // pre($value);
                                 echo '<option selected value="' . $type_values["id"] . '" data-email_template_id="' . $type_values["id"] . '">' . $type_values["title"] . '</option>';
                              } else {
                                 echo '<option value="' . $type_values["id"] . '" data-email_template_id="' . $type_values["id"] . '">' . $type_values["title"] . '</option>';
                              }

                           }
                        }
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';

                        echo '<div class="col-lg-3 col-12 col-md-6 col-sm-6 px-2 d-flex alert_main justify-content-center 5">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox col-1 p-2">';
                        if (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "0" || !isset($total_dataa_userr_2245[0]['is_whatsapp'])) {
                           // pre($value);
                           echo '<input class="alert_check"  id="whatsapp"    name="alert_title" type="checkbox" value="0" data-id="' . $type_value["id"] . '"  >';

                        } else {
                           echo '<input class="alert_check"  id="whatsapp"    name="alert_title" type="checkbox" value="" data-id="' . $type_value["id"] . '" checked  >';
                        }

                        echo '</div>';
                        echo '
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker w-100 col-3 mx-1">
                              <select class="selectpicker form-control main-control" id="is_whatsapp" name="is_whatsapp" data-id="' . $type_value["id"] . '" data-live-search="true">
                                 <option  >select</option>                                    
                                 <option  value="1" ' . (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2" ' . (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3" ' . (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>
                        ';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="whatsapp_template_id" name="whatsapp_template_id"  data-id="' . $type_value["id"] . '" >';
                        echo '<option  value="">Select Message</option>';

                        if (isset($whatsapp_template)) {
                           foreach ($whatsapp_template as $type_key => $type_value1) {
                              if (isset($total_dataa_userr_2245[0]['whatsapp_template_id']) && $total_dataa_userr_2245[0]['whatsapp_template_id'] == $type_value1["id"]) {
                                 // pre($value);
                                 echo '<option selected value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                              } else {
                                 echo '<option value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                              }

                           }
                        }
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';
                        echo '</div>';
                     }
                  }
                  ?>
                  <!-- </div> -->
               </form>
            </div>
         </div>
         <div class="tab-pane fade " id="customer_alert_main" role="tabpanel" aria-labelledby="customer_alert_tab"
            tabindex="0">
            <div class="col-lg-12 col-12 bg-white p-3 rounded-2 overflow-x-scroll">
               <form action="" id="" name="">
                  <div class="d-flex align-items-center">
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 border-end">
                        <h6 class="fw-semibold">Customer Notification</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 border-end">
                        <h6 class="" style="text-align:center;">SMS</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3 border-end">
                        <h6 class="" style="text-align:center;">Email</h6>
                     </div>
                     <div class="col-12 col-lg-3 col-md-6 col-sm-6 pb-3">
                        <h6 class="" style="text-align:center;">Whats app</h6>
                     </div>
                  </div>
                  <?php
                  foreach ($master_alert_setting as $type_key => $type_value) {
                     $db_connection = \Config\Database::connect('second');
                     $query90 = "SELECT * FROM `" . $username . "_alert_setting` WHERE  alert_title= '" . $type_value['id'] . "'";

                     $result = $db_connection->query($query90);

                     $total_dataa_userr_2245 = $result->getResultArray();

                     if ($type_value['alert_name'] == 3) {
                        echo ' <div class="col-lg-12 col-12 mb-lg-0 d-flex alert_settings">';
                        echo '<div class="col-12 col-lg-3 col-md-6 col-sm-6 fs-14 px-2 9 border-end">';
                        echo ' <div class="d-flex">';
                        echo '<label class="switch_toggle mb-1">';
                        if (isset($total_dataa_userr_2245[0]['is_alert']) && $total_dataa_userr_2245[0]['is_alert'] == "1") {
                           // pre($value);
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" checked >';
                        } else {
                           echo '<input id="alert" name="alert_title" type="checkbox" value="' . $type_value["alert_title"] . '" data-id="' . $type_value["id"] . '" >';
                        }
                        echo '<span class="check_input round"></span>';
                        echo ' </label>';
                        echo '  <span class="fs-14 ms-1 fw-medium toggle_main">';
                        echo $type_value["alert_title"];
                        echo '  </span>';
                        echo ' </div>';
                        echo ' </div>';

                        echo '<div class="col-lg-3 col-12 col-md-6 col-sm-6 px-2 d-flex alert_main justify-content-center border-end 10">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox col-1 p-2">';
                        if (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "0" || !isset($total_dataa_userr_2245[0]['is_sms'])) {
                           // pre($value);
                           echo '<input class="alert_check" id="sms" name="alert_title" type="checkbox" value="0" data-id="' . $type_value["id"] . '"  >';
                        } else {
                           echo '<input class="alert_check" id="sms" name="alert_title" type="checkbox" value="" data-id="' . $type_value["id"] . '" checked >';

                        }

                        echo '</div>';
                        echo ' 
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker  mx-1 w-100">
                              <select class="selectpicker form-control main-control" id="is_sms" name="is_sms" data-id="' . $type_value["id"] . '" data-live-search="true">                          
                                 <option >select</option>  
                                 <option  value="1" ' . (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2" ' . (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3" ' . (isset($total_dataa_userr_2245[0]['is_sms']) && $total_dataa_userr_2245[0]['is_sms'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="sms_template_id" name="sms_template_id"  data-id="' . $type_value["id"] . '" >';
                        echo '<option value="">Select Message</option>';
                        // pre($smstemplate);
                  
                        if (isset($smstemplate)) {
                           foreach ($smstemplate as $type_key => $type_valuee) {
                              if (isset($total_dataa_userr_2245[0]['sms_template_id']) && $total_dataa_userr_2245[0]['sms_template_id'] == $type_valuee["id"]) {
                                 // pre($value);
                                 echo '<option selected  value="' . $type_valuee["id"] . '" data-sms_template_id="' . $type_valuee["id"] . '">' . $type_valuee["title"] . '</option>';


                              } else {
                                 echo '<option  value="' . $type_valuee["id"] . '" data-sms_template_id="' . $type_valuee["id"] . '">' . $type_valuee["title"] . '</option>';
                              }


                           }

                        }
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';

                        echo '<div class="col-lg-3 col-md-6 col-12 col-sm-6 px-2 d-flex alert_main justify-content-center 6 border-end">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox  p-2 col-1">';
                        if (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "0" || !isset($total_dataa_userr_2245[0]['is_email'])) {
                           // pre($value);
                           echo '<input class="alert_check"  id="email" name="alert_title" type="checkbox" value="0"  data-id="' . $type_value["id"] . '"  >';
                        } else {
                           echo '<input class="alert_check"  id="email" name="alert_title" type="checkbox" value=""  data-id="' . $type_value["id"] . '" checked >';

                        }

                        echo '</div>';
                        echo '
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker col-4 w-100 mx-1">
                              <select class="selectpicker form-control main-control" name="is_email" id="is_email" data-id="' . $type_value["id"] . '" data-live-search="true">
                                 <option  >select</option>                                    
                                 <option  value="1"  ' . (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2"  ' . (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3"  ' . (isset($total_dataa_userr_2245[0]['is_email']) && $total_dataa_userr_2245[0]['is_email'] == "3" ? 'selected' : '') . '>3</option>
                              </select>   
                           </div>
                        </div>
                        ';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="email_template_id" name="email_template_id" data-id="' . $type_value["id"] . '"  >';
                        echo '<option  value="">Select Message</option>';

                        if (isset($emailtemplate)) {

                           foreach ($emailtemplate as $type_key => $type_values) {
                              if (isset($total_dataa_userr_2245[0]['email_template_id']) && $total_dataa_userr_2245[0]['email_template_id'] == $type_values["id"]) {
                                 // pre($value);
                                 echo '<option selected value="' . $type_values["id"] . '" data-email_template_id="' . $type_values["id"] . '">' . $type_values["title"] . '</option>';
                              } else {
                                 echo '<option value="' . $type_values["id"] . '" data-email_template_id="' . $type_values["id"] . '">' . $type_values["title"] . '</option>';
                              }

                           }
                        }
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';

                        echo '<div class="col-12 col-lg-3 col-md-6 col-sm-6 px-2 d-flex alert_main justify-content-center 7">';
                        echo '<div class="d-flex justify-content-between ">';
                        echo '<div class="checkbox col-1 p-2">';
                        if (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "0" || !isset($total_dataa_userr_2245[0]['is_whatsapp'])) {
                           // pre($value);
                           echo '<input class="alert_check"  id="whatsapp"    name="alert_title" type="checkbox" value="0" data-id="' . $type_value["id"] . '"  >';

                        } else {
                           echo '<input class="alert_check"  id="whatsapp"    name="alert_title" type="checkbox" value="" data-id="' . $type_value["id"] . '" checked  >';
                        }

                        echo '</div>';
                        echo '
                        <div class="col-4 w-100 px-4 alert_sm_selectpicker">
                           <div class="main-selectpicker w-100 col-3 mx-1">
                              <select class="selectpicker form-control main-control" id="is_whatsapp" data-id="' . $type_value["id"] . '" data-live-search="true">
                                 <option  >select</option>                                    
                                 <option  value="1" ' . (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "1" ? 'selected' : '') . '>1</option>
                                 <option  value="2" ' . (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "2" ? 'selected' : '') . '>2</option>
                                 <option  value="3" ' . (isset($total_dataa_userr_2245[0]['is_whatsapp']) && $total_dataa_userr_2245[0]['is_whatsapp'] == "3" ? 'selected' : '') . '>3</option>
                              </select>
                           </div>
                        </div>
                        ';
                        echo '</div>';
                        echo '<div class="main-selectpicker col-7 mx-1" id="month">';
                        echo '<select class="selectpicker form-control main-control main-control" data-live-search="true" id="whatsapp_template_id" name="whatsapp_template_id"  data-id="' . $type_value["id"] . '">';
                        echo '<option  value="">Select Message</option>';

                        if (isset($whatsapp_template)) {
                           foreach ($whatsapp_template as $type_key => $type_value1) {
                              if (isset($total_dataa_userr_2245[0]['whatsapp_template_id']) && $total_dataa_userr_2245[0]['whatsapp_template_id'] == $type_value1["id"]) {
                                 // pre($value);
                                 echo '<option selected value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                              } else {
                                 echo '<option value="' . $type_value1["id"] . '" data-whatsapp_template_id="' . $type_value1["id"] . '">' . $type_value1["title"] . '</option>';
                              }

                           }
                        }
                        echo ' </select>';
                        echo ' </div>';
                        echo '</div>';

                        echo '</div>';
                     }
                  }
                  ?>
                  <!-- </div> -->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- sms settings end -->
<?= $this->include('partials/footer') ?>

<?= $this->include('partials/vendor-scripts') ?>
<script>

   function alert_main_hs() {
      $(".alert_main").each(function () {
         if ($(this).find(".alert_check").is(":checked")) {
            $(this).find(".alert_sm_selectpicker").show();
         }
         else {
            $(this).find(".alert_sm_selectpicker").hide();
         }
      });
   }
   setTimeout(alert_main_hs, 1000);
   
   $(".alert_check").change(function () {
      if (this.checked) {
         $(this).closest(".alert_main").find(".alert_sm_selectpicker").show();
      }
      else {
         $(this).closest(".alert_main").find(".alert_sm_selectpicker").hide();
      }
   });


   function Update_data(alert_title, is_alert, is_sms, is_email, is_whatsapp, sms_template_id, email_template_id, whatsapp_template_id) {
      // console.log(alert);

      $('.loader').hide();
      $.ajax({
         method: "post",
         url: "<?= site_url('alert_update_data'); ?>",
         data: {
            alert_title: alert_title,
            is_alert: is_alert,
            is_sms: is_sms,
            sms_template_id: sms_template_id,// Updated variable name
            is_email: is_email,
            email_template_id: email_template_id, // Updated variable name
            is_whatsapp: is_whatsapp,
            whatsapp_template_id: whatsapp_template_id,// Updated variable name

            table: "alert_setting",
            action: "update",
         },

         success: function (res) {
            // console.log(res);
            //   list_data();
         },
      });

   }


   $(".alert_settings input, .alert_settings select").each(function (index) {
      $(this).on("change", function () {
         var alert_title = $(this).attr('data-id');
         // console.log(alert_title);
         var is_alert = $(this).closest(".alert_settings").find("#alert").prop('checked') ? 1 : 0;

         var is_sms = $(this).closest(".alert_settings").find("#sms").prop('checked') ? $(this).closest(".alert_settings").find('#is_sms').val() : 0;
         var is_email = $(this).closest(".alert_settings").find("#email").prop('checked') ? $(this).closest(".alert_settings").find('#is_email').val() : 0;
         var is_whatsapp = $(this).closest(".alert_settings").find("#whatsapp").prop('checked') ? $(this).closest(".alert_settings").find('#is_whatsapp').val() : 0;

         var sms_template_id = $(this).closest(".alert_settings").find('#sms_template_id option:selected').attr('data-sms_template_id');
         var email_template_id = $(this).closest(".alert_settings").find('#email_template_id option:selected').attr('data-email_template_id');
         var whatsapp_template_id = $(this).closest(".alert_settings").find('#whatsapp_template_id option:selected').attr('data-whatsapp_template_id');

         // Check if the element is an input or a select
         if ($(this).is('input')) {
            Update_data(alert_title, is_alert, is_sms, is_email, is_whatsapp, sms_template_id, email_template_id, whatsapp_template_id);
         } else if ($(this).is('select')) {
            Update_data(alert_title, is_alert, is_sms, is_email, is_whatsapp, sms_template_id, email_template_id, whatsapp_template_id);
         }
      });
   });


</script>