<?= $this->include('partials/header') ?>

<?= $this->include('partials/sidebar') ?>

<?php
$username = session_username($_SESSION['username']);
?>

<!-- inquiry start -->
<div class="main-dashbord p-2">
     <div class="container-fluid p-0">
          <div class="p-2">
               <div class="d-flex justify-content-between">
                    <div class="title-1">
                         <h2>Manage Inquiry Close Reason</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                         <?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                              <div id="deleted-all">
                                   <span class=" btn-primary-rounded elevation_add_button add-button">
                                        <i class="bi bi-trash3 fs-14"></i>
                                   </span>
                              </div>
                         <?php } ?>
                         <button class="btn-primary-rounded">
                              <i class="bi bi-plus add-panel-plus"></i>
                         </button>
                    </div>
               </div>
          </div>
          <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
               <form action="" name="inquiryclose" class="formsize needs-validation" novalidate>
                    <div class="d-flex flex-wrap justify-content-start align-items-end">
                         <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                              <label class="main-label">Inquiry Close Reason</label>
                              <input type="text" class="form-control main-control" id="inquiryclose_reason" name="inquiry_close_reason" placeholder="Inquiry Close Reason" required>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                              <label class="main-label">Description</label>
                              <input type="text" class="form-control main-control" id="inquiryclose_description" name="inquiry_close_reason_description" placeholder="Inquiry Close Reason Description">
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                              <button class="btn-primary" name="inquiryclose_add" value="occupation-add" type="submit">Inq Close Reason</button>
                         </div>
                    </div>
               </form>
          </div>
          <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
               <table id="inquiry_closing" class="table main-table w-100">
                    <thead>
                         <tr>
                              <th>
                                   <input class="check_box" type="checkbox" id="select-all" />
                              </th>
                              <th>
                                   <span>Inquiry Close Reason Details</span>
                              </th>
                         </tr>
                    </thead>
                    <tbody id="inquiry_list"></tbody>
               </table>
          </div>
     </div>
</div>

<div class="modal fade" id="admin_master_inquiry_close_view" tabindex="-1" aria-labelledby="inquiryModalLabel"
     aria-hidden="true">
     <div class="modal-dialog inquiry_close_model">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title">Edit Inquiry Close Reason</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="" id="master_inquiryclose_update_form" name="master_inquiryclose_update_form"
                         class="needs-validation" novalidate="">
                         <div class="d-flex flex-wrap align-items-center">
                              <div class="col-12 col-md-6 px-2">
                                   <div class="mb-0">
                                        <label class="main-label">Add Inq Close Reason</label>
                                        <input type="text" class="form-control main-control" id="inquiry_close_reason" name="inquiry_close_reason" placeholder="Wrong Contact Number" required>
                                   </div>
                              </div>
                              <div class="col-12 col-md-6 px-2">
                                   <div class="mb-0">
                                        <label class="main-label">Description</label>
                                        <input type="text" class="form-control main-control"
                                             id="inquiry_close_reason_description"
                                             name="inquiry_close_reason_description"
                                             placeholder="Inq Close Reason Description">
                                   </div>
                              </div>
                         </div>
                    </form>
               </div>
               <div class="modal-footer modal-footer2">
                    <div class="delete_main">
                         <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                         <div class="btn-secondary px-3" id="inquiru_close_delete" data-edit_id>Really ?</div>
                    </div>
                    <button class="btn-primary occupation_update ms-0" id="inquiru_close_update" data-edit_id=""
                         name="occupation_update" value="occupation_update">Update</button>
               </div>
          </div>
     </div>
</div>
<!-- inquiry table modal end-->

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>


<script>
     $(document).ready(function () {

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
                    // die();
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
                                             table: 'admin_master_inquiry_close',
                                        },
                                        success: function (data) {
                                             //  console.log(data);
                                             $(checkbox).closest("tr").fadeOut();
                                             // $('.removeRow').fadeOut(1500);
                                             list_data('admin_all_inquiry', '', '', project_length_show);
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

               }
               else {
                    alert('Select atleast one records');
               }
          });


          $('#inquiry_closing').DataTable({
               columnDefs: [{
                    'targets': [0],
                    'orderable': false,
               }],
          });

          var selectAllItems = "#select-all";
          var checkboxItem = ".checkbox";

          $(selectAllItems).click(function () {

               if (this.checked) {
                    $(checkboxItem).each(function () {
                         this.checked = true;
                    });
               } else {
                    $(checkboxItem).each(function () {
                         this.checked = false;
                    });
               }

          });

          function datatable_view(html) {
               $('#inquiry_closing').DataTable().destroy();
               $('#inquiry_list').html(html);
               var table1 = $('#inquiry_closing').DataTable({
                    lengthChange: true,
               });
          }

          list_data();
          // pagination_location();

          function remove_space_add_underscore(string) {
               var trim_value = $.trim(string);

               var undoerscore_value = trim_value.replace(/\s+/g, '_');

               return undoerscore_value;
          }

          function list_data() {
               show_val = '<?= json_encode(array('id', 'inquiry_close_reason', 'inquiry_close_reason_description')); ?>';
               // console.log(show_val);
               $('.loader').show();
               var page_id = 1;
               $.ajax({
                    datatype: 'json',
                    method: 'post',
                    url: "<?= site_url('MasterInformation_listing'); ?>",
                    data: {
                         'show_array': show_val,
                         'table': 'admin_master_inquiry_close',
                         'action': true,
                         'pagenumber': page_id
                    },
                    success: function (res) {
                         $('.loader').hide();
                         datatable_view(res);
                    }
               });
               $('.loader').hide();
          }
          function autoRefresh() {
               window.location.reload();
          }
          function trAutoRefresh() {
               window.location.reload();
          }


          // insert data
          $("button[name='inquiryclose_add']").click(function (e) {
               e.preventDefault();
               var form = $("form[name='inquiryclose']")[0];
               var source = $('#inquiryclose_reason').val();
               var sourcetitle = $('#inquiryclose_description').val();

               if (source != "") {
                    var formdata = new FormData(form);
                    formdata.append('action', 'insert');
                    formdata.append('table', 'admin_master_inquiry_close');
                    $('.loader').show();
                    // console.log(formdata);
                    $.ajax({
                         method: "post",
                         url: "<?= site_url('insert_data'); ?>",
                         data: formdata,
                         processData: false,
                         contentType: false,
                         success: function (res) {
                              // console.log(res);
                              if (res != "error") {
                                   $('.loader').hide();
                                   // $("form[name='inquiryclose']").removeClass("needs-validation");
                                   // $("form[name='inquiryclose'] input[name='inquiry_close_reason']").removeClass("is-invalid");
                                   $("form[name='inquiryclose']").removeClass("was-validated");
                                   $("form[name='inquiryclose']")[0].reset();
                                   // sweet_edit_sucess('Add successfully');
                                   iziToast.success({
                                        title: 'Added Successfully'
                                   });
                                   list_data();
                              }
                              else {
                                   $('.loader').hide();
                                   // Swal.fire({
                                   //      title: 'Cancelled',
                                   //      text: 'Duplicate Data Not Valid',
                                   //      icon: 'error',
                                   // })
                                   iziToast.error({
                                        title: 'Duplicate data'
                                   });
                              }
                              // list_data();
                         },
                    });
               } else {
                    $('.loader').hide();
                    // $("form[name='inquiryclose']").addClass("needs-validation");
                    $("form[name='inquiryclose']").addClass("was-validated");
                    // $("form[name='inquiryclose'] input[name='inquiry_close_reason']").addClass("is-invalid");
                    $("form[name='master_inquiryclose_update_form']").find('.selectpicker').each(function () {
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
          });

          // edit data
          $("#inquiry_closing").on('click', '.admin_master_inquiry_close_edt', function (e) {
               e.preventDefault();
               var self = $(this).closest("tr").attr('tr-id');
               var self_delete = $(this).closest("tr");
               var edit_value = $(this).attr("data-edit_id");
               // console.log(self);
               // return 0;
               if (edit_value != "") {
                    $('.loader').show();
                    $.ajax({
                         type: "post",
                         url: "<?= site_url('MasterInformation_edit'); ?>",
                         data: {
                              action: 'edit',
                              edit_id: edit_value,
                              table: 'admin_master_inquiry_close'
                         },
                         success: function (res) {
                              $('.loader').hide();
                              var response = JSON.parse(res);
                              // console.log(response);
                              $("#admin_master_inquiry_close_view input[name='inquiry_close_reason']").val(response[0].inquiry_close_reason);
                              $("#admin_master_inquiry_close_view input[name='inquiry_close_reason_description']").val(response[0].inquiry_close_reason_description);
                              $('#inquiru_close_update').attr('data-edit_id', response[0].id);
                              $('#inquiru_close_delete').attr('data-edit_id', response[0].id);
                         },
                         error: function (error) {
                              $('.loader').hide();
                         }
                    });
               } else {
                    $('.loader').hide();
                    alert("Data Not Edit.");
               }

               console.log(self);
          });
          // delete data
          $("#admin_master_inquiry_close_view").on('click', '#inquiru_close_delete', function (e) {
               e.preventDefault();
               var id = $(this).attr("data-edit_id");
               // console.log($(self_delete).remove('tr'));
               if (id != "") {
                    $('.loader').show();
                    $.ajax({
                         type: "post",
                         url: "<?= site_url('MasterInformation_delete'); ?>",
                         data: {
                              action: 'delete',
                              del_id: id,
                              table: 'admin_master_inquiry_close'
                         },
                         success: function (res) {
                              $('.loader').hide();
                              $('.modal-close-btn').trigger('click');
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

          // update data
          $("#admin_master_inquiry_close_view").on('click', '#inquiru_close_update', function (e) {
               e.preventDefault();
               var update_id = $(this).attr("data-edit_id");
               var close_reason = $('#master_inquiryclose_update_form #inquiry_close_reason').val();
               var close_reason_description = $('#master_inquiryclose_update_form #inquiry_close_reason_description').val();
               if (update_id != "" && close_reason != "") {
                    var form = $("form[name='master_inquiryclose_update_form']")[0];
                    var table_name = 'master_inquiry_close';
                    var formdata = new FormData(form);
                    formdata.append('action', 'update');
                    formdata.append('edit_id', update_id);
                    formdata.append('table', 'admin_master_inquiry_close');
                    $('.loader').show();
                    $.ajax({
                         method: "post",
                         url: "<?= site_url('MasterInformation_update'); ?>",
                         data: formdata,
                         processData: false,
                         contentType: false,
                         success: function (res) {
                              // console.log(res);
                              if (res != "error") {
                                   $('.loader').hide();
                                   $("form[name='master_inquiryclose_update_form']").removeClass("was-validated");
                                   $(".modal-close-btn").trigger("click");
                                   iziToast.success({
                                        title: 'Update Successfully'
                                   });
                                   list_data();
                              } else {
                                   $('.loader').hide();
                                   iziToast.error({
                                        title: 'Duplicate data'
                                   });
                              }
                              $('.loader').hide();
                         },
                         error: function (error) {
                              $('.loader').hide();
                         }
                    });
               } else {
                    $('.loader').hide();
                    $("form[name='master_inquiryclose_update_form']").addClass("was-validated");
                    $("form[name='master_inquiryclose_update_form']").find('.selectpicker').each(function () {
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
               };
               return 0;
          });
     });

</script>