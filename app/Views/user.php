<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$product = json_decode($product, true);
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
     $get_roll_id_to_roll_duty_var = array();
} else {
     $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
?>
<style>
     sup {
          top: unset !important;
     }
</style>
<div class="main-dashbord p-2">
     <div class="container-fluid p-0">
          <div class="p-2">
               <div class="d-flex justify-content-between align-items-center">
                    <div class="title-1 d-flex align-items-center">
                         <i class="bi bi-people me-2"></i>
                         <h2>Active User List</h2>
                    </div>
                    <div class="user-list-btn d-flex">
                         <?php if (in_array('userinformation_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                              <div id="deleted-all">
                                   <span class="me-2 btn-primary-rounded elevation_add_button add-button">
                                        <i class="bi bi-trash3 fs-14"></i>
                                   </span>
                              </div>
                         <?php } ?>
                         <?php if (in_array('userinformation_child_add_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                              <span class="btn-primary-rounded elevation_add_button add-button dataa-error"
                                   data-bs-toggle="modal" data-bs-target="#Adduser" data-bs-dismiss="modal"
                                   data-delete_id="">
                                   <i class="bi bi-plus"></i>
                              </span>
                         <?php } ?>
                    </div>
               </div>
          </div>
          <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
               <table id="user_table" class="table main-table w-100">
                    <thead>
                         <tr>
                              <th>
                                   <input class="checkbox" type="checkbox" id="select-all" />
                              </th>
                              <th>
                                   <span>Staff</span>
                              </th>
                         </tr>
                    </thead>
                    <tbody id="user_list" class="user_list"></tbody>
               </table>
          </div>
     </div>
     <div class="p-2">
          <div class="d-flex justify-content-between align-items-center">
               <div class="title-1 d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <h2>Inactive User List</h2>
               </div>
          </div>
     </div>
     <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
          <table id="user_table_inactive" class="table main-table w-100">
               <thead>
                    <tr>
                         <th>
                              <input class="check_box check_box_inactive_user" type="checkbox" id="select-all" />
                         </th>
                         <th>
                              <span>Staff</span>
                         </th>
                    </tr>
               </thead>
               <tbody id="user_list_inactive"></tbody>
               <tbody id="leave_list" class="leave_list"></tbody>
          </table>
     </div>
</div>
<div class="modal fade Adduser" id="Adduser" tabindex="-1" aria-labelledby="exampleModalToggleLabel1"
     aria-hidden="true">
     <div class="modal-dialog modal-xl">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title">Staff Management</h1>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
               </div>
               <div class="modal-body modal-body-secondery">
                    <form action="" class="" name="user_form">
                         <h6 class="modal-body-title">Enter Staff detail</h6>
                         <div class="modal-body-card">
                              <div class="col-lg-3">
                                   <label for="basic-url" class="form-label main-label">Username <sup
                                             class="text-danger fs-6">*</sup></label>
                                   <div class="input-group">
                                        <?php $username = session_username($_SESSION['username']); ?>
                                        <span class="input-group-text usernam" style="font-weight: bold;"
                                             data-usernm="<?php echo $username; ?>_">
                                             <?php echo $username; ?>_
                                        </span>
                                        <input type="text" class="form-control main-control" id="username"
                                             name="username" placeholder="Username" value="" required
                                             aria-describedby="basic-addon3 basic-addon4">
                                   </div>
                                   <div id="msg"></div>
                              </div>
                              <div class="col-lg-3  col-md-4 col-sm-6 col-12">
                                   <label class="form-label main-label main-label">Attendance :</label>
                                   <div class="switches-container">
                                        <input type="radio" class="is_attendance" id="attandance_on" name="is_attendance" value="0" checked>
                                        <input type="radio" class="is_attendance" id="attandance_off" name="is_attendance" value="1">
                                        <label for="attandance_on">
                                             <i>On</i>
                                        </label>
                                        <label for="attandance_off">
                                             <i>Off</i>
                                        </label>
                                        <div class="switch-wrapper">
                                             <div class="switche">
                                                  <div><label>On</label></div>
                                                  <div><label>Off</label></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-body-card mt-2">
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">mobile no <sup
                                                  class="text-danger fs-6">*</sup></label>
                                        <input type="text"
                                             onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                             minlength="10" maxlength="10"
                                             class="form-control main-control number_value_only phoneno" id="phone"
                                             name="phone" placeholder="Mobile No." value="" data-phone_id="" required>
                                   </div>
                                   <div class="number-error"></div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">Full name <sup
                                                  class="text-danger fs-6">*</sup></label>
                                        <input type="text" id="firstname" name="firstname"
                                             class="form-control main-control" placeholder="Enter Fullname" value=""
                                             data-firstname_id="" required>
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">E-mail address <sup
                                                  class="text-danger fs-6">*</sup></label>
                                        <input type="email" class="form-control main-control email" id="email"
                                             name="email" placeholder="Enter Email Address" value="" data-email_id=""
                                             required>
                                   </div>
                                   <div class="email-error">
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <label class="main-label">user type <sup class="text-danger fs-6">*</sup></label>
                                   <div class="main-selectpicker">
                                        <select id="role" name="role"
                                             class="selectpicker form-control main-control form-main user-foucs"
                                             data-live-search="true" required>
                                             <option value="">Select User Type</option>
                                             <?php $user_role = json_decode($user_role);
                                             foreach ($user_role as $value) { ?>
                                                  <option value="<?php echo $value->id; ?>"
                                                       data-parent_id="<?php echo $value->parent_id; ?>"
                                                       data-department_id="<?php echo $value->department; ?>"
                                                       data-id="<?php echo $value->id; ?>">
                                                       <?php echo $value->user_role; ?>
                                                  </option>
                                             <?php } ?>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <label class="main-label">head <sup class="text-danger fs-6">*</sup></label>
                                   <div class="main-selectpicker">
                                        <select class="selectpicker form-control main-control form-main" name="head"
                                             id="head" data-live-search="true" required>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <label class="main-label">Department :</label>
                                   <input type="text" class="form-control main-control" id="department"
                                        name="department" placeholder="" disabled="" data-department_id="">
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">Alt Mobile :</label>
                                        <input type="text" minlength="10" maxlength="10"
                                             class="form-control main-control number_value_only altmobileno"
                                             onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                             id="altmobileno" name="altmobileno" placeholder="Mobile No." value=""
                                             data-phone_id="">
                                   </div>
                                   <div class="number-error"></div>
                              </div>
                              <div class="col-lg-3">
                                   <label for="dob" class="">Dob :</label>
                                   <div class="custom_Date_class">
                                        <input type="text" id="dob" name="dob"
                                             class="dob form-control main-control input_count dob">
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <label class="main-label">address :</label>
                                   <input type="text" class="form-control main-control" id="address" name="address"
                                        placeholder="Enter Address" value="">
                              </div>
                              <div class="col-lg-3">
                                   <label class="main-label">user active time :</label>
                                   <div class="user-time d-flex">
                                        <input type="time" class="form-control main-control me-1" id="active_form_time"
                                             required name="active_form_time" placeholder="From" value="09:00">
                                        <input type="time" class="form-control main-control ms-1" id="active_to_time"
                                             required name="active_to_time" placeholder="To" value="20:00">
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input d-flex flex-column">
                                        <label class="main-label">user active :</label>
                                        <!-- <input type="checkbox" placeholder="Enter address"> -->
                                        <div class="switches-container1">
                                             <input type="radio" id="switchActive" name="switcher_active" value="active"
                                                  checked="checked">
                                             <input type="radio" id="switchInactive" name="switcher_active"
                                                  value="inactive">
                                             <label for="switchActive">Active</label>
                                             <label for="switchInactive">Inactive</label>
                                             <div class="switch-wrappers">
                                                  <div class="switchh">
                                                       <div>Active</div>
                                                       <div>Inactive</div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                                   <div class="add-user-input">
                                        <label class="main-label main-label">Biometric device ID :</label>
                                        <input type="text" minlength="1" maxlength="6" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control main-control main-control  number_value_only BiometricDiv " id="emp_id" name="emp_id" placeholder="Biometric device ID." value="">
                                        <p class="Biometricvalidationclass1" style="color:red !important"></p>
                                   </div>
                                   <div class="number-error">
                                   </div>
                              </div>
                         </div>
                         <h6 class="modal-body-title">Office use</h6>
                         <div class="modal-body-card">
                              <div class="col-lg-3">
                                   <label class="main-label">Assign Product <sup class="text-danger fs-6"></sup></label>
                                   <div class="main-selectpicker">
                                        <select class="selectpicker form-control main-control form-main" name="product_id"
                                             id="product_id" data-live-search="true" required>
                                             <option value="">Select product</option>
                                             <?php if(isset($product)) {
                                                  foreach($product as $pr_key => $pr_value) {
                                                  ?>
                                                       <option value="<?php echo $pr_value['id']; ?>"><?php echo $pr_value['product_name'] ?></option>
                                                  <?php
                                                  }
                                             } ?>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <label class="main-label">sim allocation <sup
                                             class="text-danger fs-6">*</sup></label>
                                   <input type="text" minlength="10"
                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                        maxlength="10"
                                        class="form-control main-control number_value_only mob_allocation"
                                        id="mob_allocation" name="mob_allocation" placeholder="Sim Number" value=""
                                        data-password_id="" required>
                                   <div class="number-error"></div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">join date. :</label>
                                        <input class="form-control main-control form-control-solid join_date"
                                             placeholder="Pick date rage" id="join_date" />
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="week_of_day">
                                        <label class="main-label">Week Of Day <sup
                                                  class="text-danger fs-6">*</sup></label>
                                        <div class="main-selectpicker">
                                             <select class="selectpicker form-control main-control form-main user-foucs"
                                                  data-live-search="true" name="week_of_day" id="week_of_day" required>
                                                  <option value="">Select Week Of Day</option>
                                                  <option value="none">none</option>
                                                  <option value="sunday">sunday</option>
                                                  <option value="monday">monday</option>
                                                  <option value="tuesday">tuesday</option>
                                                  <option value="wednesday">wednesday</option>
                                                  <option value="thursday">thursday</option>
                                                  <option value="friday">friday</option>
                                                  <option value="saturday">saturday</option>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <h6 class="modal-body-title">Emergency contact</h6>
                         <div class="modal-body-card">
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">name :</label>
                                        <input type="text" class="form-control main-control" id="em_name" name="em_name"
                                             placeholder="Name" value="" data-password_id="">
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">relation :</label>
                                        <input type="text" class="form-control main-control" id="relation"
                                             name="relation" placeholder="Relation" value="">
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">mobile number :</label>
                                        <input type="text" class="form-control main-control number_value_only em_mobile"
                                             id="em_mobile" minlength="10"
                                             onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                             maxlength="10" name="em_mobile" placeholder="Mobile Number" value="">
                                   </div>
                                   <div class="number-error">
                                   </div>
                              </div>
                              <div class="col-lg-3">
                                   <div class="add-user-input">
                                        <label class="main-label">bloodgroup :</label>
                                        <div class="main-selectpicker">
                                             <select data-live-search="true" name="bloodgroup" id="bloodgroup"
                                                  class="selectpicker form-control main-control form-main user-foucs">
                                                  <option value="">select blood group</option>
                                                  <option value="A+">A+</option>
                                                  <option value="A-">A-</option>
                                                  <option value="B+">B+</option>
                                                  <option value="B-">B-</option>
                                                  <option value="O+">O+</option>
                                                  <option value="O-">O-</option>
                                                  <option value="AB+">AB+</option>
                                                  <option value="AB-">AB-</option>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="moretext">
                              <h6 class="modal-body-title">Finacial details</h6>
                              <div class="modal-body-card">
                                   <div class="col-lg-3">
                                        <label class="main-label">pan number :</label>
                                        <input type="text" class="form-control main-control pan_number_valid_formate"
                                             id="pan_number" name="pan_number" placeholder="Pan Number" value=""
                                             data-password_id="">
                                   </div>
                                   <div class="col-lg-3">
                                        <label class="main-label">bank number. :</label>
                                        <input type="text" class="form-control main-control" id="bank_name"
                                             name="bank_name" placeholder="Bank Name" value="">
                                   </div>
                                   <div class="col-lg-3">
                                        <label class="main-label">accounut number :</label>
                                        <input type="text" class="form-control main-control number_value_only"
                                             id="ac_no" name="ac_no" placeholder="Account Number :" value="">
                                   </div>
                                   <div class="col-lg-3">
                                        <label class="main-label">IFSC code :</label>
                                        <input type="text" class="form-control main-control ifsc_valid_formate"
                                             id="ifsc" name="ifsc" placeholder="IFSC Code" value="">
                                   </div>
                                   <div class="col-lg-3">
                                        <label class="main-label">branch name :</label>
                                        <input type="text" class="form-control main-control" id="branch_name"
                                             name="branch_name" placeholder="Branch Name" value="">
                                   </div>
                                   <div class="col-lg-3">
                                        <label class="main-label">salary :</label>
                                        <input type="text" class="form-control main-control" id="salary" name="salary"
                                             placeholder="Salary" value=""
                                             onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                   </div>
                                   <div class="col-lg-3">
                                        <label class="main-label">allowance :</label>
                                        <input type="text" class="form-control main-control" id="allowance"
                                             name="allowance" placeholder="Allowance" value=""
                                             onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                   </div>
                                   <div class="col-lg-3">
                                        <label class="main-label">total pay :</label>
                                        <input type="text" class="form-control main-control" id="total_pay"
                                             name="total_pay" placeholder="Total Pay" value="" disabled="">
                                   </div>
                              </div>
                         </div>
                    </form>
                    <div class="col-12 mt-3">
                         <a class="mt-4 moreless-button btn-primary btn-sm ps-2 pe-2" href="#">Fianancial Details</a>
                    </div>
               </div>
               <div class="modal-footer modal-footer2">
                    <div class="col-lg-12 d-flex justify-content-end mt-2 pe-2 user-btn-view">
                         <input type="hidden" id="">
                         <button data-edit_id="" type="submit" class="btn-primary" name="add_new_user_btn"
                              id="add_new_user_btn"> submit</button>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="modal fade" id="user_view" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title">User Management</h1>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
               </div>
               <div class="modal-body modal-body-secondery fs-14">
                    <form action="" class="">
                         <h6 class="modal-body-title">Enter user detail</h6>
                         <div class="modal-body-card">
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="firstname" class="form-label">Name :</label>
                                        <span id="firstname"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="phone" class="form-label">Mobile No. :</label>
                                        <span id="phone"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="email" class="form-label">E-mail :</label>
                                        <span id="email"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="role" class="form-label">User Type :</label>
                                        <span id="role"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="head" class="form-label">Head :</label>
                                        <span id="head"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="department" class="form-label">Department:</label>
                                        <span id="department"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="altmobileno" class="form-label">Alt Mobile :</label>
                                        <span id="altmobileno"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="dob" class="form-label">Dob :</label>
                                        <span id="dob"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="address" class="form-label">Address :</label>
                                        <span id="address"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="active_form_time" class="form-label">Active Time
                                             :</label>
                                        <span id="active_form_time"></span> <strong>To</strong> <span
                                             id="active_to_time"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input ">
                                        <label for="active_form_time" class="form-label">User Active /
                                             Inactive:</label>
                                        <span id="switcher_active"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="add-user-input">
                                        <label for="active_form_time" class="form-label">User
                                             Name:</label>
                                        <span id="username"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-12">
                                   <div class="add-user-input">
                                        <label for="phone" class="form-label main-label main-label">Attandance
                                             :</label>
                                        <span id="is_attendance"></span>
                                   </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-12 emp_id">
                                   <div class="add-user-input">
                                        <label for="phone" class="form-label main-label">Biometric device ID :</label>
                                        <span id="emp_id"></span>
                                   </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                   <label for="password" class="form-label">Password :</label>
                                   <div class="custom_daaa">
                                        <div class="pass_field">
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                  <div class="flex-fill">
                                                       <input type="text" class="form-control main-control password"
                                                            value="" placeholder="Password" id="password">
                                                  </div>
                                                  <button class="btn-primary padding-size mx-0 mx-sm-1 my-1"
                                                       id="set_passsword" data-edit_id="">Set Password</button>
                                             </div>
                                        </div>
                                        <div class="view-password-right">
                                             <button class="btn-primary padding-size" id="cre_passsword"
                                                  data-user_id="">Create Password</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <h6 class="modal-body-title">Office use</h6>
                         <div class="modal-body-card">
                              <div class="col-lg-6">
                                   <label for="product_id" class="form-label">Assign Product
                                        :</label>
                                   <span id="product_name"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="mob_allocation" class="form-label">Sim Allocation
                                        :</label>
                                   <span id="mob_allocation"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="join_date" class="form-label">Join Date :</label>
                                   <span id="join_date"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="week_of_day" class="form-label">week of day :</label>
                                   <span id="week_of_day"></span>
                              </div>
                         </div>
                         <h6 class="modal-body-title">Emergency contact</h6>
                         <div class="modal-body-card">
                              <div class="col-lg-6">
                                   <label for="em_name" class="form-label">Name :</label>
                                   <span id="em_name"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="relation" class="form-label">Relation :</label>
                                   <span id="relation"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="em_mobile" class="form-label">Mobile Number :</label>
                                   <span id="em_mobile"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="bloodgroup" class="form-label">BloodGroup :</label>
                                   <span id="bloodgroup"></span>
                              </div>
                         </div>
                         <h6 class="modal-body-title">Financial details</h6>
                         <div class="modal-body-card">
                              <div class="col-lg-6">
                                   <label for="pan_number" class="form-label">Pan Number :</label>
                                   <span id="pan_number"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="bank_name" class="form-label">Bank Name :</label>
                                   <span id="bank_name"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="ac_no" class="form-label">A/C Number :</label>
                                   <span id="ac_no"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="ifsc" class="form-label">IFSC Code :</label>
                                   <span id="ifsc"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="branch_name" class="form-label">Branch Name:</label>
                                   <span id="branch_name"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="salary" class="form-label">Salary:</label>
                                   <span id="salary"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="allowance" class="form-label">Allowance:</label>
                                   <span id="allowance"></span>
                              </div>
                              <div class="col-lg-6">
                                   <label for="total_pay" class="form-label">Total Pay:</label>
                                   <span id="total_pay"></span>
                              </div>
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <?php if (in_array('userinformation_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                         <span class="btn-primary-rounded edt" data-edit_id="" data-bs-toggle="modal"
                              data-bs-target="#Adduser"><i class="fas fa-pencil-alt fs-14"></i></span>
                    <?php } ?>
                    <?php if (in_array('userinformation_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                         <div class="delete_main" href="javascript:void(0)">
                              <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                              <div class="btn-secondary px-3 dlt" data-delete_id="">Really ?</div>
                         </div>
                    <?php } ?>
               </div>
          </div>
     </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script>
     $(document).ready(function () {
          $('.user-tables').DataTable();
     });
     $('.moreless-button').click(function () {
          $('.moretext').slideToggle();
          if ($(this).text() == "Fianancial Details") {
               $(this).text("Less Details")
          } else {
               $(this).text("Fianancial Details")
          }
     });
</script>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script type="text/javascript">
     $(document).ready(function () {
          $('body').on('change', '.phoneno , .altmobileno , .em_mobile , .mob_allocation', function () {
               var val = $(this).val();
               if (val.length >= 10 && val.length <= 12) {
                    $('.number-error').html('');
                    $(this).closest(".col-lg-3").find('.number-error').html('');
                    // $('.number-error').css('color','green');  
               } else {
                    // $('.number-error').html('');
                    $('.number-error').css('color', 'red');
                    $(this).closest(".col-lg-3").find('.number-error').html('<p>Pleade Enter Valid Number</p>');
               }
          });
          $('body').on('change', '.email', function () {
               var val = $(this).val();
               var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
               if (emailRegex.test(val)) {
                    $('.email-error').html('');
                    // $('.number-error').css('color','green');  
               } else {
                    $('.email-error').html('<p>Enter Valid Email</p>');
                    $('.email-error').css('color', 'red');
               }
          });
          $(".Adduser").on('click', '.modal-close-btn', function () {
               $('form[name="user_form"]')[0].reset();
               $('.selectpicker').selectpicker('refresh');
               $("form[name='user_form']").removeClass("was-validated");
               $('.number-error').html('');
               $('.email-error').html('');
               $(this).closest(".col-lg-3").find('.number-error').html('');
               $('#msg').html('');
               $(this).closest(".col-lg-3").find('#msg').html('');
          });
          $("body").on('change', '#select-all', function () {
               var deleteButton = $("#deleted-all");
               if ($(this).is(":checked")) {
                    // deleteButton.removeClass("hide");
                    deleteButton.show();
               } else {
                    // deleteButton.addClass("hide");
                    deleteButton.hide();
               }
               checkIfAnyCheckboxChecked();
          });
          function checkIfAnyCheckboxChecked() {
               if ($('.checkbox:checked').length > 0) {
                    // alert();
                    $("#deleted-all").show();
               } else {
                    // alert();
                    $("#deleted-all").hide();
               }
          }
          $('body').on('change', '.checkbox', function () {
               // alert();
               var deleteButton = $("#deleted-all");
               // if($(this).is(":checked")){
               checkIfAnyCheckboxChecked();
          });
          checkIfAnyCheckboxChecked();
          $('body').on('click', '#deleted-all', function () {
               //   alert("hello");
               var project_length_show = $('#project_length_show').val();
               var checkbox = $('.checkbox:checked');
               if (checkbox.length > 0) {
                    var checkbox_value = [];
                    $(checkbox).each(function () {
                         checkbox_value.push($(this).val());
                    });
                    // console.log(checkbox_value);
                    // return 1;
                    iziToast.delete({
                         message: 'Are You Sure',
                         buttons: [
                              ['<button>delete</button>', function (instance, toast) {
                                   $.ajax({
                                        url: "<?= site_url('delete_all'); ?>",
                                        method: "post",
                                        data: {
                                             action: 'delete',
                                             checkbox_value: checkbox_value,
                                             table: 'user',
                                        },
                                        success: function (data) {
                                             //  console.log(data);
                                             $(checkbox).closest("tr").fadeOut();
                                             // $('.removeRow').fadeOut(1500);
                                             list_data('user', '', '', project_length_show);
                                             iziToast.success({
                                                  title: 'Delete Successfully'
                                             });
                                        }
                                   });
                              }, true], // true to focus
                              ['<button>Close</button>', function (instance, toast) {
                                   instance.hide({
                                        transitionOut: 'fadeOutUp',
                                        onClosing: function (instance, toast, closedBy) {
                                             console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                                        }
                                   }, toast, 'buttonName');
                              }]
                         ],
                         onOpening: function (instance, toast) {
                              console.info('callback abriu!');
                         },
                         onClosing: function (instance, toast, closedBy) {
                              console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                         }
                    });
               } else {
                    alert('Select atleast one records');
               }
          });
          $("#username").on("input", function (e) {
               var userr = $('#Adduser .usernam').attr("data-usernm");
               var userrname = $('#Adduser #username').val();
               var username = userr + userrname;
               $('#msg').hide();
               if ($('#username').val() == null || $('#username').val() == "") {
                    $('#msg').show();
                    $("#msg").html("Username is a required field.").css("color", "red");
               } else {
                    $.ajax({
                         type: 'post',
                         url: "<?= site_url('check-username-availability'); ?>",
                         data: JSON.stringify({
                              username: $('#username').val()
                         }),
                         contentType: 'application/json; charset=utf-8',
                         dataType: 'html',
                         cache: false,
                         beforeSend: function (f) {
                              $('#msg').show();
                              $('#msg').html('Checking...');
                         },
                         success: function (msg) {
                              $('#msg').show();
                              $("#msg").html(msg);
                         },
                         error: function (jqXHR, textStatus, errorThrown) {
                              $('#msg').show();
                              $("#msg").html(textStatus + " " + errorThrown);
                         }
                    });
               }
               return false;
          });
          $(".dob").bootstrapMaterialDatePicker({
               maxDate: new Date(),
               format: 'DD/MM/YYYY',
               cancelText: 'cancel',
               okText: 'ok',
               clearText: 'clear',
               time: false,
          });
          $(".join_date").bootstrapMaterialDatePicker({
               format: 'DD/MM/YYYY',
               cancelText: 'cancel',
               okText: 'ok',
               clearText: 'clear',
               time: false,
          });
          function numberWithCommas(x) {
               return x.toString().split('.')[0].length > 3 ? x.toString().substring(0, x.toString().split('.')[0].length - 3).replace(/\B(?=(\d{2})+(?!\d))/g, ",") + "," + x.toString().substring(x.toString().split('.')[0].length - 3) : x.toString();
          }
          function total_price(price = 0, extrawork = 0, extraexpense = 0) {
               var numformate_total_price = 0;
               var total_price = 0;
               total_price = parseInt(price) + parseInt(extrawork) + parseInt(extraexpense);
               numformate_total_price = numberWithCommas(total_price);
               return numformate_total_price;
          }
          $('body').on('keyup', '#salary', function () {
               var price = $(this).val().replace(/,/g, '');
               var add_comma = numberWithCommas(price);
               $(this).val(add_comma);
               var extrawork = $("#allowance").val().replace(/,/g, '');
               if (extrawork == '') {
                    extrawork = 0;
               }
               var total_price_count = total_price(price, extrawork);
               $("#total_pay").val(total_price_count);
          });
          $('body').on('keyup', '#allowance', function () {
               var extrawork = $(this).val().replace(/,/g, '');
               var add_comma = numberWithCommas(extrawork);
               $(this).val(add_comma);
               var price = $("#salary").val().replace(/,/g, '');
               if (price == '') {
                    price = 0;
               }
               var total_price_count = total_price(price, extrawork);
               $("#total_pay").val(total_price_count);
          });
          function datatable_view(html) {
               $('#user_table').DataTable().destroy();
               $('#user_list').html(html);
               var table1 = $('#user_table').DataTable({
                    "columnDefs": [{
                         "visible": false,
                    }],
                    lengthChange: true,
                    // buttons: ['copy', 'excel', 'pdf', 'colvis']
               });
               //  table1.buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');
               //  table1.page( 0 ).draw('page');
          }
          $("#role").change(function () {
               var parent_id = $("#role option:selected").attr('data-parent_id');
               if (parent_id != "") {
                    head_get(parent_id);
               }
          });
          function head_get(parent_id) {
               $("select#head").html('');
               // console.log(parent_id)
               var department = $("#Adduser #role option:selected").attr('data-department_id');
               var role_id = $("#Adduser #role option:selected").val();
               $.ajax({
                    url: "<?= site_url('UserInformation_display_data_role_user'); ?>",
                    type: 'post',
                    data: {
                         search: parent_id,
                         table: 'admin_user',
                    },
                    success: function (data) {
                         $("select#head").append(data);
                         $("select#head").selectpicker("refresh");
                    }
               });
               deparment_name_add(department);
          }
          function datatable_views(html) {
               $('#user_table_inactive').DataTable().destroy();
               $('#user_list_inactive').html(html);
               var table1 = $('#user_table_inactive').DataTable({
                    "columnDefs": [{
                         "visible": false,
                    }],
                    "language": {
                         "lengthMenu": "Show _MENU_ Records"
                    },
                    lengthChange: true,
               });
          }
          // $('body').on('click', '.dataa-error', function() {
          // 	$(".Adduser .number-error").show('');
          // });
          // insert data 
          $('body').on('click', '#add_new_user_btn', function (event) {
               //$("form[name='user_form']")[0].reset();
               // alert("hello");
               event.preventDefault();
               var editid = $(this).attr("data-edit_id");
               var phone = $('#Adduser  #phone').val();
               var userr = $('#Adduser .usernam').attr("data-usernm");
               var userrname = $('#Adduser #username').val();
               var username = userr + userrname;
               var firstname = $('#Adduser #firstname').val();
               var emp_id = $('#Adduser #emp_id').val();
               var email = $('#Adduser #email').val();
               var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
               var role = $('#Adduser #role').val();
               var parent_id = $("#role option:selected").attr('data-parent_id');
               var head = $('#Adduser #head').val();
               var head_name = $("#head option:selected").attr('data-name');
               var department = $("#department").val();
               var altmobileno = $('#Adduser #altmobileno').val();
               var dob = $('#Adduser #dob').val();
               var address = $('#Adduser #address').val();
               var active_form_time = $('#Adduser #active_form_time').val();
               var active_to_time = $('#Adduser #active_to_time').val();
               var switcher_active = $("input[name='switcher_active']:checked").val();
               var mob_allocation = $('#Adduser #mob_allocation').val();
               var join_date = $('#Adduser #join_date').val();
               var week_of_day = $('#Adduser #week_of_day').val();
               var em_name = $('#Adduser #em_name').val();
               var relation = $('#Adduser #relation').val();
               var em_mobile = $('#Adduser #em_mobile').val();
               var bloodgroup = $('#Adduser #bloodgroup').val();
               var pan_number = $('#Adduser #pan_number').val();
               var bank_name = $('#Adduser #bank_name').val();
               var ac_no = $('#Adduser #ac_no').val();
               var ifsc = $('#Adduser #ifsc').val();
               var branch_name = $('#Adduser #branch_name').val();
               var salary = $('#Adduser #salary').val();
               var allowance = $('#Adduser #allowance').val();
               var total_pay = $('#Adduser #total_pay').val();
               var product_id = $('#Adduser #product_id').val();
               var is_attendance = $("#Adduser input[name='is_attendance']:checked").prop('value');
               if (username != "" && phone != "" && firstname != "" && email != "" && emailRegex.test(email) && role != "" && department != "" && active_form_time != "" && active_to_time != "" && mob_allocation != "") {
                    if (editid == '' || editid == 'undefined') {
                         $('.loader').show();
                         $.ajax({
                              method: "post",
                              url: "<?= site_url('check_user_biometric_data'); ?>",
                              data: {
                                   "table": 'user',
                                   "emp_id": emp_id,
                              },
                              success: function(data) {
                                   if (data == 0) {
                                        $.ajax({
                                             method: "post",
                                             url: "<?= site_url('user_insert_data'); ?>",
                                             data: {
                                                  // job_location_id: job_location_id,
                                                  phone: phone,
                                                  firstname: firstname,
                                                  username: username,
                                                  email: email,
                                                  role: role,
                                                  parent_id: parent_id,
                                                  head_name: head_name,
                                                  head: head,
                                                  department: department,
                                                  altmobileno: altmobileno,
                                                  dob: dob,
                                                  address: address,
                                                  active_form_time: active_form_time,
                                                  active_to_time: active_to_time,
                                                  switcher_active: switcher_active,
                                                  mob_allocation: mob_allocation,
                                                  join_date: join_date,
                                                  week_of_day: week_of_day,
                                                  em_name: em_name,
                                                  relation: relation,
                                                  em_mobile: em_mobile,
                                                  bloodgroup: bloodgroup,
                                                  pan_number: pan_number,
                                                  bank_name: bank_name,
                                                  ac_no: ac_no,
                                                  ifsc: ifsc,
                                                  branch_name: branch_name,
                                                  salary: salary,
                                                  allowance: allowance,
                                                  total_pay: total_pay,
                                                  product_id: product_id,
                                                  is_attendance: is_attendance,
                                                  emp_id:emp_id,
                                                  table: 'user',
                                                  action: "insert",
                                             },
                                             success: function (data) {
                                                  if (data != "error") {
                                                       $('.loader').hide();
                                                       list_data();
                                                       $(".modal-close-btn").trigger("click");
                                                       $("form[name='user_form']").removeClass("was-validated");
                                                       $('.modal-close-btn').click(function () {
                                                            $('form[name="user_form"]')[0].reset();
                                                       });
                                                       sweet_edit_sucess('Add successfully');
                                                  } else {
                                                       $('.loader').hide();
                                                       Swal.fire({
                                                            title: 'Cancelled',
                                                            text: 'Duplicate Data Not Valid',
                                                            icon: 'error',
                                                       })
                                                  }
                                             }
                                        });
                                   }
                                   else
                                   {
                                        $('.loader').hide();
                                        iziToast.error({
                                             title: 'Biometric ID already exists!'
                                        });

                                   }
                              }
                         });
                    } else {
                         var form = $("form[name='user_form']")[0];
                         var formdata = new FormData(form);
                         // formdata.append('job_location_id', job_location_id);
                         formdata.append('head_name', head_name);
                         formdata.append('username', username);
                         formdata.append('department', department);
                         formdata.append('action', 'update');
                         formdata.append('edit_id', editid);
                         formdata.append('table', 'user');
                         formdata.append('parent_id', parent_id);
                         formdata.append('product_id', product_id);
                         formdata.append('is_attendance', is_attendance);
                         formdata.append('emp_id', emp_id);
                         $('.loader').show();
                         $.ajax({
                              method: "post",
                              url: "<?= site_url('check_user_biometric_data'); ?>",
                              data: {
                                   "table": 'user',
                                   "emp_id": emp_id,
                                   "edit_id": editid,
                              },
                              success: function(data) {
                                   if (data == 0) {
                                        $.ajax({
                                             method: "post",
                                             url: "<?= site_url('user_update'); ?>",
                                             data: formdata,
                                             processData: false,
                                             contentType: false,
                                             success: function (res) {
                                                  if (res != "error") {
                                                       $('.loader').hide();
                                                       list_data();
                                                       $('.modal-close-btn').click(function () {
                                                            $('form[name="user_form"]')[0].reset();
                                                       });
                                                       $("form[name='user_form']").removeClass("was-validated");
                                                       $(".modal-close-btn").trigger("click");
                                                       sweet_edit_sucess('Update successfully');
                                                  } else {
                                                       $('.loader').hide();
                                                       Swal.fire({
                                                            title: 'Cancelled',
                                                            text: 'Duplicate Data Not Valid',
                                                            icon: 'error',
                                                       })
                                                  }
                                             },
                                             error: function (error) { }
                                        });
                                   }
                                   else {
                                        $('.loader').hide();
                                        iziToast.error({
                                             title: 'Biometric ID already exists'
                                        });
                                   }

                              }
                         });
                       
                    }
               } else {
                    $('.loader').hide();
                    $("form[name='user_form']").addClass("was-validated");
               }
          });
          function deparment_name_add(department) {
               $.ajax({
                    url: "<?= site_url('UserInformation_add_department'); ?>",
                    type: 'post',
                    data: {
                         department: department,
                         table: 'user',
                    },
                    success: function (data) {
                         var response = JSON.parse(data);
                         $("#Adduser #department").val(response.department);
                    }
               });
          }
          // list data 
          function list_data() {
               $('.loader').show();
               $.ajax({
                    datatype: 'json',
                    method: "post",
                    url: "<?= site_url('user_show_list_data'); ?>",
                    data: {
                         table: 'user',
                         'action': true
                    },
                    success: function (res) {
                         $('.loader').hide();
                         var response = JSON.parse(res);
                         datatable_view(response.html);
                         datatable_views(response.inactive_html);
                    }
               });
               $('.loader').hide();
          }
          list_data();
          // view data 
          $("#user_list,#user_list_inactive").on('click', '.user_view', function (e) {
               // alert("hello");
               $('.project_drop').hide();
               e.preventDefault();
               var self = $(this).closest("tr");
               var edit_value = $(this).attr("data-view_id");
               // console.log(edit_value);
               if (edit_value != "") {
                    $('.loader').show();
                    $.ajax({
                         type: "post",
                         url: "<?= site_url('user_view'); ?>",
                         data: {
                              action: 'view',
                              view_id: edit_value,
                              table: 'user'
                         },
                         success: function (res) {
                              $('.loader').hide();
                              $('.pass_field').hide();
                              var response = JSON.parse(res);
                              $('.edt').attr('data-edit_id', response.id);
                              $('.dlt').attr('data-delete_id', response.id);
                              $('#user_view #role ').text(response.user_role_name);
                              $('#user_view #head').text(response.head_name);
                              $('#user_view #department').text(response.department);
                              $('#user_view #username').text(response.username);
                              $('#user_view #altmobileno').text(response.altmobileno);
                              $("#user_view #phone").text(response.phone);
                              $('#user_view #address').text(response.address);
                              $('#user_view #dob').text(response.dob);
                              $("#user_view #firstname").text(response.firstname);
                              $("#user_view #email").text(response.email);
                              $("#user_view #week_of_day").text(response.week_of_day);
                              if (response.password != "") {
                                   // $("#user_view #password").attr("value",response[0].password);
                                   $("#set_passsword").text("Reset password");
                                   $("#cre_passsword").text("View Password");
                              } else {
                                   $("#cre_passsword").text("create Password");
                              }
                              if(response.emp_id > 0){
                                   $("#user_view .emp_id").show();
                                   $("#user_view #emp_id").text(response.emp_id);
                              }else{
                                   $("#user_view .emp_id").hide();
                              }
                              if (response.is_attendance == "0") {
                                   $("#user_view #is_attendance").text("On");
                              } else if (response.is_attendance == "1") {
                                   $("#user_view #is_attendance").text("Off");
                              }
                              $("#user_view #em_name").text(response.em_name);
                              $("#user_view #relation").text(response.relation);
                              $("#user_view #em_mobile").text(response.em_mobile);
                              $("#user_view #bloodgroup").text(response.bloodgroup);
                              $("#user_view #pan_number").text(response.pan_number);
                              $("#user_view #bank_name").text(response.bank_name);
                              $("#user_view #ac_no").text(response.ac_no);
                              $("#user_view #ifsc").text(response.ifsc);
                              $("#user_view #branch_name").text(response.branch_name);
                              $("#user_view #salary").text(response.salary);
                              $("#user_view #allowance").text(response.allowance);
                              $("#user_view #total_pay").text(response.total_pay);
                              $("#user_view #mob_allocation").text(response.mob_allocation);
                              $("#user_view #join_date").text(response.join_date);
                              $("#user_view #active_to_time").text(response.active_to_time);
                              $("#user_view #active_form_time").text(response.active_form_time);
                              $("#user_view #switcher_active").text(response.switcher_active);
                              $("#user_view #product_name").text(response.product_id);
                              // mobileno_to_name(response[0].phone, 'view');
                              // deparment_name_add(parseInt(response[0].role), 'view');
                              // get_data_to_id(parseInt(response[0].role), 'user_role', 'master_user_role');
                              // get_data_to_ida(parseInt(response[0].head), 'firstname', 'user');
                              // get_id_to_project(parseInt(response[0].job_location), 'project_name', 'project');
                              $('#set_passsword').attr('data-edit_id', response.id);
                              $('#cre_passsword').attr('data-user_id', response.id);
                         },
                    });
               } else {
                    $('.loader').hide();
                    alert("Data Not Edit.");
               }
          });
          $(".pass_field").hide();
          // edit data 
          $('body').on('click', '.edt', function (e) {
               //$('.project_drop').hide();
               // alert("hl");
               e.preventDefault();
               $('.selectpicker').selectpicker('refresh');
               var self = $(this).closest("tr");
               var edit_value = $(this).attr("data-edit_id");
               // var userr = $('#Adduser .usernam').attr("data-usernm");
               // var userrname = $('#Adduser #username').val();
               // var username = userr + userrname;
               // console.log(userrname);
               // var nameParts = username.split("_");
               // var lastName = nameParts[2];
               // console.log(lastName);
               // var name = 'john_doe';
               if (edit_value != "") {
                    $('.loader').show();
                    $.ajax({
                         type: "post",
                         url: "<?= site_url('user_edit'); ?>",
                         data: {
                              action: 'edit',
                              edit_id: edit_value,
                              table: 'user'
                         },
                         success: function (res) {
                              $('.loader').hide();
                              $('.selectpicker').selectpicker('refresh');
                              var response = JSON.parse(res);
                              $('.dlt').attr('data-delete_id', response.id);
                              $('#add_new_user_btn').attr('data-edit_id', response.id);
                              $('#Adduser #emp_id').val(response.emp_id);
                              $('#Adduser #username').val(response.user_name);
                              $('#Adduser #phone').val(response.phone);
                              $('#Adduser #firstname').val(response.firstname);
                              $('#Adduser #email').val(response.email);
                              $('#Adduser #role ').val(response.role);
                              if (response.switcher_active == "active") {
                                   $('#switchActive').prop('checked', true);
                              } else {
                                   $('#switchInactive').prop('checked', true);
                              }
                              head_get(response.parent_id);
                              //$('#Adduser #head').val(response.head);
                              setTimeout(function () {
                                   $('#Adduser #week_of_day').val(response.week_of_day);
                                   $('#Adduser #week_of_day').selectpicker('refresh');
                                   $('#Adduser #head').val(response.head);
                                   $('#Adduser #head').selectpicker('refresh');
                              }, 1000);
                              //  $('#Adduser #department').val(response.department);
                              $("#Adduser #password").val(response.password);
                              $('#Adduser #dob').val(response.dob);
                              $('#Adduser #address').val(response.address);
                              $('#Adduser #active_form_time').val(response.active_form_time);
                              $('#Adduser #active_to_time').val(response.active_to_time);
                              // $('#Adduser #switcher_active').val(response.switcher_active);
                              $('#Adduser #mob_allocation').val(response.mob_allocation);
                              $('#Adduser #join_date').val(response.join_date);
                              //$('#Adduser #week_of_day').val(response.week_of_day);
                              $('#Adduser #em_name').val(response.em_name);
                              $('#Adduser #relation').val(response.relation);
                              $('#Adduser #em_mobile').val(response.em_mobile);
                              $('#Adduser #bloodgroup').val(response.bloodgroup);
                              $('#Adduser #pan_number').val(response.pan_number);
                              $('#Adduser #bank_name').val(response.bank_name);
                              $('#Adduser #ac_no').val(response.ac_no);
                              $('#Adduser #ifsc').val(response.ifsc);
                              $('#Adduser #branch_name').val(response.branch_name);
                              $('#Adduser #salary').val(response.salary);
                              $('#Adduser #allowance').val(response.allowance);
                              $('#Adduser #total_pay').val(response.total_pay);
                              $('#Adduser #product_id').val(response.product_id);
                              $('#Adduser .is_attendance').prop('checked', false);
                              $('#Adduser input[value="' + response.is_attendance + '"]').prop('checked', true);
                              $('.selectpicker').selectpicker('refresh');
                              $('.modal-close-btn').click(function () {
                                   $('.selectpicker').selectpicker('refresh');
                                   $('form[name="user_form"]')[0].reset();
                              });
                         },
                         error: function (error) {
                              $('.loader').hide();
                         }
                    });
               } else {
                    $('.loader').hide();
                    alert("Data Not Edit.");
               }
          });
          $(".pass_field").hide();
          $("body").on('click', '#set_passsword', function (password) {
               var update_id = $(this).attr("data-edit_id");
               var password = $(".password").val();
               console.log(password);
               $.ajax({
                    url: "<?= site_url('UserInformation_set_password'); ?>",
                    type: 'post',
                    data: {
                         update_id: update_id,
                         table: 'user',
                         password: password,
                    },
                    success: function (data) {
                         sweet_edit_sucess('Update successfully');
                         $('.pass_field').hide();
                         location.reload(true);
                    }
               });
               return false;
          });
          $("body").on('click', '#cre_passsword', function (e) {
               $(".pass_field").toggle();
               if ($(".pass_field").css('display') != 'none') {
                    var user_id = $(this).attr("data-user_id");
                    var password = $("#user_view #password").val();
                    //$('.loader').show();
                    $.ajax({
                         type: "post",
                         url: "<?= site_url('UserInformation_get_password'); ?>",
                         data: {
                              action: 'get_password',
                              user_id: user_id,
                              password: password,
                              table: 'user'
                         },
                         success: function (res) {
                              var result = JSON.parse(res);
                              if (result.response == 1) {
                                   $('#user_view #password').val(result.password);
                              } else {
                                   $('#user_view #password').val('');
                              }
                              $('.loader').hide();
                         },
                    });
                    return false;
               }
          });
          // delete data 
          $('body').on('click', '.dlt', function (e) {
               e.preventDefault();
               var self = $(this).closest("tr");
               var id = $(this).attr('data-delete_id');
               if (id != "") {
                    $('.loader').show();
                    $.ajax({
                         type: "post",
                         url: "<?= site_url('user_delete'); ?>",
                         data: {
                              action: 'delete',
                              id: id,
                              table: 'user'
                         },
                         success: function (res) {
                              $('.loader').hide();
                              $(".modal-close-btn").trigger("click");
                              list_data();
                         },
                         error: function (error) {
                              $('.loader').hide();
                         }
                    });
               }
          });

          
     });
</script>