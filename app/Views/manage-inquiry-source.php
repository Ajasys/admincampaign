<?= $this->include('partials/header') ?>

<?= $this->include('partials/sidebar') ?>


<!-- inquiry start -->
<div class="main-dashbord p-2">
   <div class="container-fluid p-0">
      <div class="p-2">
         <div class="d-flex justify-content-between align-items-center">
            <div class="title-1">
               <h2>Manage Inquiry source</h2>
            </div>
            <div class=" d-flex justify-content-end">
               <?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                  <div id="deleted-all" class="mx-1">
                     <span class="btn-primary-rounded elevation_add_button">
                        <i class="bi bi-trash3 fs-14"></i>
                     </span>
                  </div>
               <?php } ?>
               <!-- <button class="btn-primary-rounded mx-1">
                  <i class="bi bi-plus add-panel-plus"></i>
               </button> -->
            </div>
         </div>
      </div>
      <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
         <form action="" class="formsize needs-validation" name="inquirysource" novalidate>
            <div class="d-flex justify-content-start align-items-end">
               <div class="col-lg-3 col-md-3 col-sm-6 px-2">
                  <label for="occupationname" class="form-label main-label">Source</label>
                  <div class="main-selectpicker">
                     <select name="inquiry_source_type" id="inquirysource-select"
                        class="selectpicker form-control main-control form-main" aria-label="Default select example"
                        data-live-search="true" tabindex="-98" required>
                        <option class="dropdown-item" value="">Select Source</option>
                        <?php
                        $master_inquiry_source_type = json_decode($master_inquiry_source_type, true);
                        if (isset($master_inquiry_source_type)) {
                           $i = 1;
                           foreach ($master_inquiry_source_type as $type_key => $type_value) {
                              echo '<option class="dropdown-item" value="' . $i . '">' . $type_value["inquiry_source_type"] . '</option>';
                              $i++;
                           }
                        }
                        ?>
                     </select>
                  </div>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-6 px-2">
                  <label class="main-label">Title</label>
                  <input type="text" class="form-control main-control" id="inquirytitle" name="source"
                     placeholder="Enter Title" required>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-6 px-2">
                  <label class="main-label">Description</label>
                  <input type="text" class="form-control main-control" id="inquiryDescription" name="description"
                     placeholder="Enter Description" required>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-6 px-2">
                  <button class=" btn-primary inquiry-btn" name="inquirysource_add" value="inquirysource_add"
                     type="submit">Add</button>
               </div>
            </div>
         </form>
      </div>
      <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
         <table id="master-source-type-inquiry-table" class="master-source-type-inquiry-table main-table table w-100">
            <thead>
               <tr>
                  <th>
                     <input class="check_box" type="checkbox" id="select-all" />
                  </th>
                  <th>
                     <span>Inquiry Source Details</span>
                  </th>
               </tr>
            </thead>
            <tbody id="inquiry_list">
            </tbody>
         </table>
      </div>
   </div>
</div>

<div class="modal fade" id="admin_master_inquiry_source_update" tabindex="-1" aria-labelledby="inquiryModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title">Edit Source Type</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="master_inquirysource_update_form" name="master_inquirysource_update_form" class="needs-validation"
               novalidate>
               <div class="d-flex flex-wrap align-items-center justify-content-start">
                  <div class="col-lg-6 col-md-6 col-sm-6 px-2">
                     <label for="occupationname" class="form-label main-label">Source</label>
                     <div class="main-selectpicker">
                        <select name="inquiry_source_type" id="inquirysource-select"
                           class="selectpicker form-control main-control form-main"
                           aria-label="Default select example" data-live-search="true" required="" tabindex="-98"
                           required>
                           <option class="dropdown-item" value="">Select Source</option>
                           <?php
                           if (isset($master_inquiry_source_type)) {
                              $v = 1;
                              foreach ($master_inquiry_source_type as $type_key => $type_value) {
                                 echo '<option class="dropdown-item" value="' . $v . '">' . $type_value["inquiry_source_type"] . '</option>';
                                 $v++;
                              }
                           }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 px-2">
                     <label class="main-label">Title</label>
                     <input type="text" class="form-control main-control" id="inquiry_title" name="source"
                        placeholder="Enter Title" required>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 px-2">
                     <label class="main-label">Description</label>
                     <input type="text" class="form-control main-control" id="inquiry_Description" name="description"
                        placeholder="Enter Description" required>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <div class="delete_main">
               <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
               <div class="btn-secondary px-3 " id="delete" data-edit_id>Really ?</div>
            </div>
            <button class="btn-primary occupation_update ms-0" id="inquiru_source_update" data-edit_id=""
               name="inquiru_source_update" value="occupation_update">Update</button>
         </div>
      </div>
   </div>
</div>
<!-- inquiry table modal end-->

<script>

   $(document).ready(function () {
      // $('.master-source-type-inquiry-table').DataTable();
      $('.master-source-type-inquiry-table').DataTable({
         columnDefs: [{
            'targets': [0], /* column index [0,1,2,3]*/
            'orderable': false, /* true or false */
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
   });
</script>

<?= $this->include('partials/footer') ?>

<?= $this->include('partials/vendor-scripts') ?>

<script>
   $(document).ready(function () {
      list_data();

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
                           table: 'admin_master_inquiry_source',
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

      // join();

      function datatable_view(html) {
         $('.master-source-type-inquiry-table').DataTable().destroy();
         $('#inquiry_list').html(html);
         var table1 = $('.master-source-type-inquiry-table').DataTable({
            "columnDefs": [
               // Hide second, third and fourth columns
               { "visible": false }
            ],
            lengthChange: true,
         });
         // console.log(table1);
         // table1.buttons().container().appendTo('#master_inquirytype_table_wrapper .col-md-6:eq(0)');
         table1.page(0).draw('page');
      }
      function remove_space_add_underscore(string) {
         var trim_value = $.trim(string);

         var undoerscore_value = trim_value.replace(/\s+/g, '_');

         return undoerscore_value;
      }
      function list_data() {
         show_val = '<?= json_encode(array('show_array')); ?>';
         $('.loader').show();
         // console.log(show_val);
         // join_data = join();
         $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('inquiry_source_list_data'); ?>",
            data: {
               // 'table': 'master_inquiry_source',
               'show_array': show_val,
               'action': 'join',
               // main table is table1 
               'table1': 'admin_master_inquiry_source',
               'table2': 'admin_master_inquiry_source_type',
               'field1': 'inquiry_source_type',
               'field2': 'id'
            },
            success: function (res) {
               $('.loader').hide();
               datatable_view(res);
               // console.log(res);
               // join();
            }
         });
         $('.loader').hide();
      }

      function join() {
         show_val = '<?= json_encode(array('show_array')); ?>';
         // console.log(show_val);
         $.ajax({
            type: 'post',
            url: "<?= site_url('join'); ?>",
            data: {
               'action': 'join',
               'table1': 'admin_master_inquiry_source',
               'table2': 'admin_master_inquiry_source_type',
               'fild1': 'inquiry_source_type',
               'fild2': 'id'
            },
            success: function (res) {
               // console.log(res);
            }
         });
      }


      // insert data
      $("button[name='inquirysource_add']").click(function (e) {
         e.preventDefault();
         var form = $("form[name='inquirysource']")[0];
         var source = $('#inquirysource-select').val();
         var sourcetitle = $('#inquirytitle').val();
         var sourcedescription = $('#inquiryDescription').val();

         if (sourcetitle != "" && sourcedescription != "" && source != "") {
            var formdata = new FormData(form);
            // var new_val = remove_space_add_underscore(inquirytype);
            formdata.append('action', 'insert');
            formdata.append('table', 'admin_master_inquiry_source');
            // console.log(formdata);
            $('.loader').show();
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
                     $("form[name='inquirysource']").removeClass("was-validated");
                     $("form[name='inquirysource']")[0].reset();
                     iziToast.success({
                        title: 'Added Successfully'
                     });
                     list_data();
                     $('.selectpicker').selectpicker('refresh');
                  }
                  else {
                     $('.loader').hide();
                     iziToast.error({
                        title: 'Duplicate data'
                     });
                  }
                  // list_data();
               },
            });
         } else {
            $('.loader').hide();
            $("form[name='inquirysource']").addClass("was-validated");
            // $("form[name='inquirysource'] select").addClass("is-invalid");
            $("form[name='inquirysource']").find('.selectpicker').each(function () {
               var selectpicker_valid = 0;
               if ($(this).attr('required') == 'undefined') {
                  var selectpicker_valid = 0;
               }
               if ($(this).attr('required') == 'required') {
                  var selectpicker_valid = 1;
               }

               if (selectpicker_valid == 1) {
                  if ($(this).val() == 0 || $(this).val() == '') {
                     $(this).addClass('selectpicker-validation');
                  } else {
                     $(this).removeClass('selectpicker-validation');
                  }
               } else {
                  $(this).closest("div").removeClass('selectpicker-validation');
               }
            });
         }
      });

      // edit data
      $(".master-source-type-inquiry-table").on('click', '.admin_master_inquiry_source_edit', function (e) {
         e.preventDefault();
         var self = $(this).closest("tr");
         var edit_value = $(this).attr("data-edit_id");
         if (edit_value != "") {
            $('.loader').show();
            $.ajax({
               type: "post",
               url: "<?= site_url('MasterInformation_edit'); ?>",
               data: {
                  action: 'edit',
                  edit_id: edit_value,
                  table: 'admin_master_inquiry_source'
               },
               success: function (res) {
                  $('.loader').hide();
                  var response = JSON.parse(res);
                  $("#admin_master_inquiry_source_update select[name='inquiry_source_type']").val(response[0].inquiry_source_type);
                  $("#admin_master_inquiry_source_update input[name='source']").val(response[0].source);
                  $("#admin_master_inquiry_source_update input[name='description']").val(response[0].description);
                  $('#inquiru_source_update').attr('data-edit_id', response[0].id);
                  $('#delete').attr('data-edit_id', response[0].id);
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
      $("#admin_master_inquiry_source_update").on('click', '#delete', function (e) {
         e.preventDefault();
         // alert('hello');
         var id = $(this).attr("data-edit_id");
         // var delete_value = self.find(".department_id").val();
         // console.log(id);
         if (id != "") {
            $('.loader').show();
            $.ajax({
               type: "post",
               url: "<?= site_url('MasterInformation_delete'); ?>",
               data: {
                  action: 'delete',
                  del_id: id,
                  table: 'admin_master_inquiry_source'
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
      $("#admin_master_inquiry_source_update").on('click', '#inquiru_source_update', function (e) {
         e.preventDefault();
         // alert('hi');
         var update_id = $(this).attr("data-edit_id");
         var source_update = $('#master_inquirysource_update_form #inquirysource-select').val();
         var sourcetitle_update = $('#master_inquirysource_update_form #inquiry_title').val();
         var sourcedescription_update = $('#master_inquirysource_update_form #inquiry_Description').val();
         if (update_id != "" && sourcetitle_update != "" && sourcedescription_update != "" && source_update != "") {
            var form = $("form[name='master_inquirysource_update_form']")[0];
            // console.log(form);
            var formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', 'master_inquiry_source');
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
                     // $("form[name='master_inquirysource_update_form'] input").removeClass("is-invalid");
                     $("form[name='master_inquirysource_update_form']").removeClass("was-validated");
                     list_data();
                     $(".modal-close-btn").trigger("click");
                     $("form[name='master_inquirysource_update_form']")[0].reset();
                     iziToast.success({
                        title: 'Update Successfully'
                     });

                  } else {
                     $('.loader').hide();
                     iziToast.error({
                        title: 'Duplicate data'
                     });
                  }
                  $('.loader').hide();
                  list_data();
               },
               error: function (error) {
                  $('.loader').hide();
               }
            });
         } else {
            $('.loader').hide();
            $("form[name='master_inquirysource_update_form']").addClass("was-validated");
            $("form[name='master_inquirysource_update_form']").addClass("needs-validation");
            //   $("form[name='master_inquirysource_update_form'] input").addClass("is-invalid");
            $("form[name='master_inquirysource_update_form']").find('.selectpicker').each(function () {
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
      });

   });
</script>