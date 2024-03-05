<!------------------------- Header Start ------------------------------->

<?= $this->include('partials/header') ?>

<?= $this->include('partials/sidebar') ?>

<!------------------------- Header Start ------------------------------->

<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

   $get_roll_id_to_roll_duty_var = array();

} else {

   $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);

}

?>

<style>

   .select-placeholder {

      position: absolute;

      pointer-events: none;

      padding: 6px;

      color: #888;

   }
   .form-check-input:checked {
    background-color: var(--first-color) !important;
    border-color: #000000;
}
.form-check-input:focus {
 
    box-shadow: 0 0 0 2.2px rgb(153 96 255 / 25%);
}


   #integration_type {

      position: relative;

      z-index: 1;

   }

</style>

<div class="main-dashbord p-2">

   <div class="container-fluid p-0">

      <div class="p-2">

         <div class="d-flex justify-content-between align-items-center">

            <div class="title-1 d-flex align-items-center">

               <i class="fa-brands fa-whmcs me-2"></i>

               <h2>Subscription Setting</h2>

            </div>

            <div class="d-flex justify-content-end">

               <a href="#" data-bs-toggle="modal" data-bs-target="#subscription_setting_add"

                  class="btn-primary-rounded">

                  <i class="bi bi-plus"></i>

               </a>

            </div>

         </div>

      </div>



      <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">

         <table class="subscription_list_data table main-table w-100" aria-describedby="example_info"

            id="project_sub_type_table">

            <thead>

               <tr>

                  <th>

                     <input class="check_box" type="checkbox" id="select-all" />

                  </th>

                  <th>

                     <span>Subscription Details</span>

                  </th>

               </tr>

            </thead>

            <tbody class="table-description" id="subscription_list">



            </tbody>

         </table>

         <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">

            <div class="row_count_div col-xl-6 col-xxs-12">

               <p id="row_count"></p>

            </div>

            <div class="clearfix  col-xl-6 col-xxs-12">

               <ul class="inq_pagination justify-content-xl-end" id="inq_pagination">

               </ul>

            </div>

         </div>

      </div>

   </div>

   <!-- card-body-end -->

</div>

<div class="modal fade" id="subscription_setting_add" tabindex="-1" aria-labelledby="stateModalLabel"

   aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered modal-lg">

      <div class="modal-content">

         <form class="formsize needs-validation" name="subscription_master_insert" method="POST" novalidate="">

            <div class="modal-header">

               <h1 class="modal-title">Subscription Setting</h1>

               <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i

                     class="bi bi-x-circle"></i></button>

            </div>

            <div class="modal-body">

               <div class="d-flex flex-wrap mb-2 ">

                  <div class="col-lg-6 col-md-12 col-sm-12 col-12 p-0 pe-3">

                     <label class="main-label">Plan Name :</label>

                     <input type="text" class="form-control main-control" name="plan_name" id="plan_name" value=""

                        required>

                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12 col-12  p-0 pe-3" id="">

                     <label class="main-label">User :</label>

                     <input type="text" class="form-control main-control"

                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" min="0"

                        name="user" id="user" value="" required>

                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12 col-12  p-0 pe-3">

                     <label class="main-label">Project :</label>

                     <div class="main-selectpicker" id="project_select">

                        <select name="project" id="project" class="selectpicker form-control form-main  select"

                           data-live-search="true" required="">

                           <i class="fa-solid fa-caret-down"></i>

                           <option class="dropdown-item" value="">Select Project</option>

                           <option value="1">1</option>

                           <option value="2">2</option>

                           <option value="3">3</option>

                           <option value="4">4</option>

                           <option value="5">5</option>

                           <option value="6">6</option>

                           <option value="7">7</option>

                           <option value="8">8</option>

                           <option value="9">9</option>

                           <option value="10">10</option>

                           <option value="Unlimited">Unlimited</option>

                        </select>

                        <!-- <input type="number" class="form-control main-control " name="project" min="0" id="project" value="" required> -->

                     </div>

                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12 col-12  p-0 pe-3">

                     <label class="main-label">Property listing :</label>

                     <input type="text" min="0"

                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"

                        class="form-control main-control " name="property_type" id="property_type" value="" required>

                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12 col-12  p-0 pe-3">

                     <label class="main-label">Plan In Rupees (₹):</label>

                     <input type="text" class="form-control main-control "

                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"

                        name="plan_price" min="0" id="plan_price" value="" required>

                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-12 p-0 pe-3">

                     <label class="main-label">Price in Dollar ($) :</label>

                     <input type="text" class="form-control main-control "

                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"

                        name="plan_dollar" min="0" id="plan_dollar" value="" required>

                  </div>

                  <div class="col-lg-6 col-md-12 col-sm-12 col-12  p-0 pe-3">

                     <label class="main-label">Validity :</label>

                     <input type="text" class="form-control  main-control "

                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="validity"

                        min="0" id="validity" value="" required>

                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-12  p-0 pe-3">

                     <label class="main-label"> Crm :</label>

                     <div class="main-selectpicker" id="project_select">

                        <select name="crm" id="crm" class="selectpicker form-control form-main  select"

                           data-live-search="true" required="">

                           <i class="fa-solid fa-caret-down"></i>

                           <option class="dropdown-item" value="">Select Project</option>
                           <option class="dropdown-item" value="1">RealToSmart</option>
                           <option class="dropdown-item" value="2">Gymsmart</option>


                        </select>

                        <!-- <input type="number" class="form-control main-control " name="project" min="0" id="project" value="" required> -->

                     </div>

                  </div>

               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-wrap flex-sm-nowrap p-0 align-items-center ">

                  <div class="col-lg-3 col-md-4 col-sm-5 col-12 d-flex hr_form p-0 align-items-center">

                     <h6 for="HR" class="form-label form-labell pe-3">HR Management:</h6>

                  </div>

                  <div class="col-lg-9 col-md-8 col-sm-7 col-12 d-flex hr_form p-0 align-items-center">

                     <input type="checkbox" class="ms-2 form-check-input bb" id="hr_yes" name="hr_form" value=1>

                  </div>

                  <!--<input type="radio" class="hr2 form-check-input" id="hr_yes" name="hr_form" value="yes" required>

                        <label for="hr_yes" class="pt-1 ps-2">YES</label>

                        <input type="radio" id="hr_no" class="ms-4 hr2 form-check-input " name="hr_form" value="no" required>

                        <label for="hr_no" class="pt-1 ps-2">NO</label> -->



               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-wrap flex-sm-nowrap  hr_form p-0 align-items-center">

                  <div class="col-lg-3 col-md-4 col-sm-5 col-12 d-flex hr_form p-0 align-items-center">

                     <h6 for="HR" class="form-label form-labell pe-2">Account module :</h6>

                  </div>

                  <div class="col-lg-9 col-md-8 col-sm-7 col-12 d-flex hr_form p-0 align-items-center">

                     <input type="checkbox" class="ms-2 form-check-input bb" id="acount_module_yes"

                        name="account_module" value=1>

                  </div>

                  <!-- <input type="checkbox" id="acount_module_yes" name="whatsapp" value="1" required>

                        <input type="radio" class=" acount_module_yes acount_module form-check-input" id="acount_module_yes" name="account_module" value="yes" required>

                        <label for="a/c_yes" class="pt-1 ps-2  ">YES</label>

                        <input type="radio" class="ms-4 acount_module_no acount_module form-check-input" id="acount_module_no" name="account_module" value="no" required>

                        <label for="a/c_no" class="pt-1 ps-2">NO</label> -->



               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 p-0 d-flex flex-wrap flex-sm-nowrap align-items-center">

                  <div class="col-lg-3 col-md-4 col-sm-5 col-12 d-flex hr_form p-0 align-items-center">

                     <h6 for="project_type" class="form-label form-labell pe-3">Leads Integration:</h6>

                  </div>

                  <div class="col-lg-9 col-md-8 col-sm-7 col-12 d-flex hr_form p-0 align-items-center">

                     <input type="checkbox" class="ms-2 form-check-input bb" id="annual" name="integration_type[]"

                        value="Facebook">

                     <label for="facebook" class="pt-1 ps-2"> Facebook </label><br>

                     <input type="checkbox" id="annual" class="ms-2 form-check-input bb" name="integration_type[]"

                        value="Website">

                     <label for="website" class="pt-1 ps-2"> Website </label><br>

                  </div>



               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-wrap flex-sm-nowrap p-0 align-items-center ">

                  <div class="col-lg-3 col-md-4 col-sm-5 col-12 d-flex hr_form p-0 align-items-center">

                     <h6 for="Email" class="form-label form-labell pe-3">Intregration Setting :</h6>

                  </div>

                  <div class="col-lg-9 col-md-8 col-sm-7 col-12 d-flex hr_form p-0 align-items-center">

                     <input type="checkbox" class="ms-2 form-check-input bb" id="email_yes" name="email" value=1>

                     <label for="email_yes" class="pt-1 ps-2"> Email </label><br>

                     <input type="checkbox" class="ms-2 form-check-input bb" id="sms_yes" name="sms" value=1>

                     <label for="sms_yes" class="pt-1 ps-2"> SMS </label><br>

                     <input type="checkbox" class="ms-2 form-check-input bb" id="Whatsapp_yes" name="whatsapp" value=1>

                     <label for="Whatsapp_yes" class="pt-1 ps-2"> Whatsapp </label><br>

                  </div>

               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-wrap flex-sm-nowrap pt-2 hr_form p-0 align-items-center">

                  <div class="col-lg-3 col-md-4 col-sm-5 col-12 d-flex hr_form p-0 align-items-center">

                     <h6 for="HR" class="form-label form-labell pe-1">Reports :</h6>

                  </div>

                  <div class="col-lg-9 col-md-8 col-sm-7 col-12 d-flex flex-wrap hr_form p-0 align-items-center">

                     <div class="d-flex"><input type="checkbox" id="annual" class="ms-2 form-check-input bb" name="reports_name[]"

                        value="inq report">

                     <label for="" class="pt-1 ps-2">Inqury </label></div><br>

                     <div class="d-flex"><input type="checkbox" id="annual" class="ms-2 form-check-input bb" name="reports_name[]"

                        value="site report">

                     <label for="" class="pt-1 ps-2">Site </label></div><br>

                     <div class="d-flex"><input type="checkbox" id="annual" class="ms-2 form-check-input bb" name="reports_name[]"

                        value="perfomance report">

                     <label for="" class="pt-1 ps-2">Performance </label></div><br>

                     <div class="d-flex"><input type="checkbox" id="annual" class="ms-2 form-check-input bb" name="reports_name[]"

                        value="site conversation">

                     <label for="" class="pt-1 ps-2 text-nowrap"> Site Conversation </label></div><br>

                     <div class="d-flex"><input type="checkbox" id="annual" class="ms-2 form-check-input bb" name="reports_name[]"

                        value="user conversation">

                     <label for="" class="pt-1 ps-2 text-nowrap"> User Conversation </label></div><br>

                  </div>

               </div>

            </div>

            <div class="modal-footer modal-footer2">

               <button type="button" class=" btn-primary subscription_setting_form" id="subscription_setting_update_btn" data-edit_id=""

                  name="subscription_setting_form" value="project_subtype_update">Submit</button>

            </div>

         </form>

      </div>

   </div>

</div>

<div class="modal fade" id="master_subscribtion_view" tabindex="-1" aria-labelledby="exampleModalLabel"

   aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">

      <div class="modal-content">

         <form class="needs-validation" name="project_update_form" method="POST" action="">

            <!-- modal-heading-start -->

            <div id="modal-code" class="modal-header modal-headerr pt-2 pb-2">

               <div class="col-lg-11 col-md-11 col-sm-11 d-flex builder1 ">

                  <h6 class="aman  pt-1">Master View information</h6>

               </div>

               <div class=" col-lg-1 col-md-1 col-sm-1 buttons">

                  <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i

                        class="bi bi-x-circle"></i></button>

               </div>

            </div>

            <!-- modal-heading-end -->

            <!-- mpdal-body-start -->

            <div class="modal-body modal-body-1 p-2" id="assign-pages">

               <div class="row row-1">

                  <div class="col-xl-12">

                     <div class="body-main1 mb-0">

                        <div class="body_body">

                           <div class="card  ps-2">

                              <div class="row d-flex">

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Plan Name :</label>

                                    <span class="form-inform" id="plan_name"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">User :</label>

                                    <span class="form-inform" id="user"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Project :</label>

                                    <span class="form-inform" id="project"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Validity:</label>

                                    <span class="form-inform" id="validity"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Integration type :</label>

                                    <span class="form-inform" id="integration_type"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Property listing :</label>

                                    <span class="form-inform" id="property_type"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Reports name :</label>

                                    <span class="form-inform" id="reports_name"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Hr intregration :</label>

                                    <span class="form-inform" id="hr_form"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Sms intregration:</label>

                                    <span class="form-inform" id="sms"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Whatsapp intregration:</label>

                                    <span class="form-inform" id="whatsapp"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Email intregration:</label>

                                    <span class="form-inform" id="email"></span>

                                 </div>

                                 <div class="col-lg-6 col-md-6 col-sm-6">

                                    <label class="form-label1">Account module:</label>

                                    <span class="form-inform" class="account_module" id="account_module"></span>

                                 </div>



                              </div>

                           </div>

                           <!-- project-details-end -->

                        </div>

                     </div>

                  </div>

               </div>

            </div>

            <div class="modal-footer modal-footer2">

               <?php if (in_array('subscription_management_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                  <!-- <a href="#" class="btn-primary-rounded edt"><i class="fas fa-pencil-alt" data-edit_id="" data-bs-toggle="modal" data-bs-target="#subscription_setting_add"></i></a> -->



                  <span class="btn-secondary-rounded  edt" data-edit_id="" data-bs-toggle="modal"

                     data-bs-target="#subscription_setting_add"><i class="fas fa-pencil-alt fs-14"></i></span>

               <?php } ?>

               <?php if (in_array('subscription_management_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                  <div class="delete_main">

                     <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>

                     <div class="btn-secondary px-3 dlt" data-delete_id="">Really?</div>

                  </div>

               <?php } ?>



            </div>

         </form>

      </div>

   </div>

</div>

<?= $this->include('partials/footer') ?>

<?= $this->include('partials/vendor-scripts') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>



<script>

   $(document).ready(function () {





      // $('.integration_type').select2({

      //    placeholder: 'Enter your data',

      // });

      // insert data 



      $('body').on('click', '.subscription_setting_form', function (e) {

         e.preventDefault();

         // alert("hello");



         $("#subscription_setting_add .bb").addClass("form-check-input");

         var user = $("#subscription_setting_add #user").val();

         var plan_name = $("#subscription_setting_add #plan_name").val();

         var price = $("#subscription_setting_add #price").val();

         var project = $("#subscription_setting_add #project").val();

         var validity = $("#subscription_setting_add #validity").val();



         //var integration_type = $("#subscription_setting_add #integration_type").val();

         var property_type = $("#subscription_setting_add #property_type").val();

         var hr_form = $('input[name="hr_form"]:checked').prop('value');

         var sms = $('input[name="sms"]:checked').prop('value');

         var whatsapp = $('input[name="whatsapp"]:checked').prop('value');

         var email = $('input[name="email"]:checked').prop('value');

         var account_module = $('input[name="account_module"]:checked').prop('value');

         var integration_type = $(' input[name="integration_type[]"]:checked').val();

         var reports_name = $(' input[name="reports_name[]"]:checked').val();

         var plan_price = $("#subscription_setting_add #plan_price").val();

         var plan_dollar = $("#subscription_setting_add #plan_dollar").val();

         var edit_id = $('#subscription_setting_add #subscription_setting_update_btn').attr("data-edit_id");



         // console.log(mobileno);

         if (user != "" && project != "" && property_type != "") {

            var form = $("form[name='subscription_master_insert']")[0];

            var formdata = new FormData(form);

            formdata.append('table', 'admin_subscription_master');

            formdata.append('account_module', account_module);



            formdata.append('sms', sms);

            formdata.append('email', email);

            formdata.append('whatsapp', whatsapp);

            // formdata.append('integration_type', integration_type.join(','));





            // formdata.append('action', 'insert');



            // var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');

            // var page_number = $(".inq_pagination").find(".page-item.active .page-link").text();

            // var perPageCount = $('#perPageCount').val();





            if (edit_id == '') {

               formdata.append('action', 'insert');

               $('.loader').show();

               $.ajax({

                  method: "post",

                  url: "<?= site_url('subscription_master_insert'); ?>",

                  data: formdata,

                  processData: false,

                  contentType: false,



                  success: function (res) {



                     if (res != "error") {

                        $('.loader').hide();

                        list_data();

                        $("form[name='subscription_master_insert']")[0].reset();

                        $(".modal-close-btn").trigger("click");

                        $("form[name='subscription_master_insert']").removeClass("was-validated");

                        iziToast.success({

                           title: 'Added Successfully'

                        });

                     } else {

                        $('.loader').hide();

                        iziToast.error({

                           title: 'Duplicate data'

                        });

                     }



                  },



               });



            }

            else {

               var formdata = new FormData(form);

               formdata.append('action', 'update');

               formdata.append('edit_id', edit_id);

               formdata.append('table', 'admin_subscription_master');

               formdata.append('account_module', account_module);

               formdata.append('hr_form', hr_form);

               // formdata.append('integration_type', integration_type.join(','));

               formdata.append('sms', sms);

               formdata.append('email', email);

               formdata.append('whatsapp', whatsapp);

               // formdata.append('whatsapp', whatsapp);



               $('.loader').show();

               $.ajax({

                  method: "post",

                  url: "<?= site_url('master_subscribtion_update'); ?>",

                  data: formdata,

                  processData: false,

                  contentType: false,

                  success: function (res) {

                     if (res != "error") {

                        $('.loader').hide();

                        list_data();

                        $("form[name='subscription_master_insert']").removeClass("was-validated");

                        $('.btn-close').click(function () {

                           $('form[name="subscription_master_insert"]')[0].reset();

                        });

                        $(this).attr('data-edit_id', "");

                        // list_data('inquiry_all_status', inquiry_status_type, edit_page, perPageCount);

                        $('#subscription_setting_add #subscription_setting_update_btn').attr("data-edit_id", '');

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

         } else {

            $("form[name='subscription_master_insert']").addClass("was-validated");

            // $("input[name='hr_form']").addClass("was-validated");







            var form = $("form[name='subscription_master_insert']");

            $(form).find('.selectpicker').each(function () {

               var selectpicker_valid = 0;

               if ($(this).attr('required') == 'undefined') {

                  var selectpicker_valid = 0;

               }

               if ($(this).attr('required') == 'required') {

                  var selectpicker_valid = 1;

               }

               if (selectpicker_valid == 1) {

                  if ($(this).val() == 0 || $(this).val() == '') {

                     $(this).closest("div").addClass('selectpicker-validation');

                  } else {

                     $(this).closest("div").removeClass('selectpicker-validation');

                  }

               } else {

                  $(this).closest("div").removeClass('selectpicker-validation');

               }

            });

         }

         return false;

      });



      $('.modal-close-btn').click(function () {

         $('form[name="subscription_master_insert"]')[0].reset();

         $('.selectpicker').selectpicker('refresh');

         $("form[name='subscription_master_insert']").removeClass("was-validated");

         $('input[name="account_module"]:checked').prop("checked", false);

         $('input[name="sms"]:checked').prop("checked", false);

         $('input[name="whatsapp"]:checked').prop("checked", false);

         $('input[name="email"]:checked').prop("checked", false);



         $(this).closest(".hr_form").find(".bb").css("border", "0");

      });





      function list_data(table = 'admin_subscription_master', datastatus = '', pageNumber = 1, perPageCount = 10, ajaxsearch = "", filter = "", formdata = "", action = true) {



         // var ajaxsearch = $('.inq_search').val();



         var perPageCount = $('#perPageCount').val();





         // if ($.trim($(".filter-show").html()) != '') {

         //    var form = $("form[name='filter_form']")[0];

         //    var formdata = new FormData(form);

         //    formdata.append('action', 'filter');



         // }



         if ($.trim($(".filter-show").html()) == '') {

            var data = {

               'table': table,

               'pageNumber': pageNumber,

               'perPageCount': perPageCount,

               //   'ajaxsearch': ajaxsearch,

               'action': action,

            };

            var processdd = true;

            var contentType = "application/x-www-form-urlencoded; charset=UTF-8";



         } else {



            formdata.append('pageNumber', pageNumber);

            formdata.append('perPageCount', perPageCount);



            var data = formdata;

            var processdd = false;

            var contentType = false;

         }



         $.ajax({

            datatype: 'json',

            method: "POST",

            url: 'master_subscribtion_list',

            data: data,

            processData: processdd,

            contentType: contentType,

            success: function (res) {

               var result = JSON.parse(res);

               if (result.response == 1) {

                  if (result.total_page == 0 || result.total_page == '') {

                     total_page = 1;

                  } else {

                     total_page = result.total_page;

                  }



                  $('#row_count').html(result.row_count_html);

                  $('#subscription_list').html(result.html);

                  $('.inq_pagination').twbsPagination({

                     totalPages: total_page,

                     visiblePages: 4,

                     next: '>>',

                     prev: '<<',

                     onPageClick: function (event, page) {

                        list_data(table, datastatus, page, perPageCount, ajaxsearch);

                     }

                  });

               }



            }

         });

         //  });

         <?php

         if (isset($_GET) && !empty($_GET)) { ?>

                                             <?php

                                             if (isset($_GET['action']) && ($_GET['action'] == 'filter')) { ?>

                     $('.inq_pagination').twbsPagination('destroy');

                                             <?php } ?>

                                          <?php

         } ?>



      }

      list_data();



      // view data 

      $('body').on('click', '.master_subscribtion_view', function (e) {



         e.preventDefault();

         var self = $(this).closest("tr");

         var edit_value = $(this).attr("data-view_id");

         // console.log(view_id);

         if (edit_value != "") {

            $('.loader').show();

            $.ajax({

               type: "post",

               url: "<?= site_url('master_subscribtion_view'); ?>",

               data: {

                  action: 'view',

                  view_id: edit_value,

                  table: 'admin_subscription_master'

               },

               success: function (res) {

                  $('.loader').hide();

                  var response = JSON.parse(res);

                  // console.log(response);

                  $('.edt').attr('data-edit_id', response[0].id);

                  $('.dlt').attr('data-delete_id', response[0].id);

                  $('#master_subscribtion_view #user').text(response[0].user);

                  $('#master_subscribtion_view #project').text(response[0].project);

                  $('#master_subscribtion_view #property_type').text(response[0].property_type);

                  $('#master_subscribtion_view #integration_type').text(response[0].integration_type);

                  $('#master_subscribtion_view #reports_name').text(response[0].reports_name);

                  $('#master_subscribtion_view #plan_price ').text(response[0].plan_price);
                  $('#master_subscribtion_view #plan_dollar ').text(response[0].plan_dollar);

                  $('#master_subscribtion_view #plan_name').text(response[0].plan_name);

                  $('#master_subscribtion_view #validity').text(response[0].validity);



                  if (response[0].sms == 1) {

                     $('#master_subscribtion_view #sms').text("Yes");

                  } else {

                     $('#master_subscribtion_view #sms').text("No");

                  }

                  if (response[0].email == 1) {

                     $('#master_subscribtion_view #email').text("Yes");

                  } else {

                     $('#master_subscribtion_view #email').text("No");

                  }

                  if (response[0].whatsapp == 1) {

                     $('#master_subscribtion_view #whatsapp').text("Yes");

                  } else {

                     $('#master_subscribtion_view #whatsapp').text("No");

                  }

                  if (response[0].hr_form == 1) {

                     $('#master_subscribtion_view #hr_form').text("Yes");

                  } else {

                     $('#master_subscribtion_view #hr_form').text("No");

                  }

                  if (response[0].account_module == 1) {

                     $('#master_subscribtion_view #account_module').text("Yes");

                  } else {

                     $('#master_subscribtion_view #account_module').text("No");

                  }

               },

            });

         } else {

            $('.loader').hide();

            alert("Data Not Edit.");

         }

      });



      // edit data 

      $('body').on('click', '.edt', function (e) {

         //$('.project_drop').hide();

         // alert("hl");

         e.preventDefault();

         $('.selectpicker').selectpicker('refresh');

         var self = $(this).closest("tr");

         $('.modal-close-btn').click(function () {

            $('#subscription_setting_add  .subscription_setting_form').attr("data-edit_id", '');

            $("#subscription_setting_add .bb").removeClass("form-check-input");

         });

         var edit_value = $(this).attr("data-edit_id");

         // console.log(edit_value);

         if (edit_value != "") {

            $('.loader').show();

            $.ajax({

               type: "post",

               url: "<?= site_url('master_subscribtion_edit'); ?>",

               data: {

                  action: 'edit',

                  edit_id: edit_value,

                  table: 'admin_subscription_master'

               },

               success: function (res) {

                  $('.loader').hide();



                  $('.selectpicker').selectpicker('refresh');

                  var response = JSON.parse(res);





                  $('.dlt').attr('data-delete_id', response.id);

                  $('#subscription_setting_update_btn').attr('data-edit_id', response[0].id);

                  $('#subscription_setting_add #user').val(response[0].user);

                  $('#subscription_setting_add #plan_name').val(response[0].plan_name);

                  $('#subscription_setting_add #plan_price').val(response[0].plan_price);
                  
                  $('#subscription_setting_add #plan_dollar').val(response[0].plan_dollar);

                  $('#subscription_setting_add #project').val(response[0].project);
                   $('#subscription_setting_add #crm').val(response[0].crm);

                  $('#subscription_setting_add #validity').val(response[0].validity);



                  $('#subscription_setting_add #property_type').val(response[0].property_type);

                  // $('#subscription_setting_add #user').val(response[0].hr_form);

                  // $("#subscription_setting_add .account_module:checked").val(response[0].account_module);

                  // $('#subscription_setting_add #investor_name').val(response[0].reports);

                  $('#subscription_setting_add input[name="reports_name[]:checked"]').val(response[0].reports_name);

                  $('#subscription_setting_add input[name="integration_type[]:checked"]').val(response[0].integration_type);

                  // $('#subscription_setting_add #plan_name"]').val(response[0].plan_name);







                  // setTimeout(function() {

                  //    $('#subscription_setting_add #integration_type:checked').val(response[0].integration_type);



                  //    $('#Adduser #head').selectpicker('refresh');

                  // }, 1000);



                  // Assume response contains the integration_type values like ['Facebook', 'Email']

                  // if (response[0].integration_type !== '') {

                  //    var integration_type = response[0].integration_type.split(',');

                  //    $("#subscription_setting_add #integration_type").val([]);

                  //    $.each(integration_type, function(index2, value2) {

                  //       $("#subscription_setting_add #integration_type option[value='" + value2.trim() + "']").prop("selected", true);

                  //    });

                  //    $("#subscription_setting_add #integration_type").selectpicker('refresh');

                  // }

                  if (response[0].sms == 1) {

                     $("#sms_yes").prop("checked", true);

                  }

                  if (response[0].email == 1) {

                     $("#email_yes").prop("checked", true);

                  }

                  if (response[0].whatsapp == 1) {

                     $("#Whatsapp_yes").prop("checked", true);

                  }

                  if (response[0].hr_form == 1) {

                     $("#hr_yes").prop("checked", true);

                  }

                  if (response[0].account_module == 1) {

                     $("#acount_module_yes").prop("checked", true);

                  }



                  if (response[0].reports_name !== '') {

                     var reports_name = response[0].reports_name.split(',');

                     // console.log(reports_name);



                     $.each(reports_name, function (index, value) {

                        $("#subscription_setting_add input[value='" + value + "']").prop("checked", true);



                     });

                  }

                  if (response[0].integration_type !== '') {

                     var integration_type = response[0].integration_type.split(',');

                     // console.log(reports_name);



                     $.each(integration_type, function (index, value) {

                        $("#subscription_setting_add input[value='" + value + "']").prop("checked", true);



                     });

                  }





                  $('.selectpicker').selectpicker('refresh');

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

      // delete data 

      $('body').on('click', '.dlt', function (e) {

         // alert("hello");

         e.preventDefault();

         var self = $(this).closest("tr");

         var id = $(this).attr('data-delete_id');

         console.log(id);

         if (id != "") {

            $('.loader').show();

            $.ajax({

               type: "post",

               url: "<?= site_url('master_subscribtion_delete'); ?>",

               data: {

                  action: 'delete',

                  del_id: id,

                  table: 'admin_subscription_master'

               },

               success: function (res) {

                  $('.loader').hide();

                  $(".modal-close-btn").trigger("click");

                  list_data();

                  iziToast.delete({

                     title: 'Delete successfully'

                  });

               },

               error: function (error) {

                  $('.loader').hide();

               }

            });

         }

      });



      $(".bb").change(function () {



         if ($(".bb").is(":checked")) {

            $(this).closest(".hr_form").find(".bb").css("border", "1px solid #280378")

         } else {

            $(this).closest(".hr_form").find(".bb").css("border", "1px solid red")

         }

      });

      $('body').on('click', '#subscription_setting_add .modal-close-btn', function (e) {

         $("#master_subscribtion_view .modal-close-btn").trigger("click");

      });

   });

</script>