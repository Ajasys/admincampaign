<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<div class="main-dashbord">
   <div class="container-fluid">
      <div class="row row-main">
         <div class="col-11">
            <h4>Manage Occupation</h4>
         </div>
         <div class="col-1 d-flex justify-content-end">
            <a href="#" class="btn-primary-rounded"><i class="bi bi-plus-lg add-panel-plus"></i></a>
         </div>
      </div>
      <div class="card card-menu add-panel">
         <div class="card-main">
            <div class="row row-line">
               <div class="col-12">
                  <form class="formsize needs-validation" name="occupation_form" novalidate="">
                     <div class="row justify-content-start align-items-end">
                        <div class="col-lg-4 col-md-4 col-sm-6">


                           <label for="occupationname" class="form-label form-labell form-name">Add Occupation</label>
                           <input type="text" class="form-control form-controll" id="occupation_details"
                              name="occupation_details" placeholder="Occupation Name" required="">


                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                           <label for="occupationname" class="form-label form-labell form-name">Occupation
                              Category</label>
                           <div class="d-flex form-control main-form p-0">
                              <div class="dropdown bootstrap-select form-control">
                                 <select name="occupation_category" id="occupation_category"
                                    class="selectpicker form-control form-main" data-live-search="true"
                                    tabindex="-98" required="">
                                    <option class="dropdown-item" value="">Select Action</option>
                                    <option class="dropdown-item" data-sourcetype_name="self_employee" value="self employee">Self employee</option>
                                    <option class="dropdown-item" data-sourcetype_name="self_employee" value="Employee"> Employee</option>
                                    <option class="dropdown-item" data-sourcetype_name="self_employee" value="Bussiness">Bussiness</option>
                                 </select>
                                 <div class="dropdown-menu " role="combobox">
                                    <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
                                          role="textbox" aria-label="Search">
                                    </div>
                                    <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                       <ul class="dropdown-menu inner show"></ul>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                           <button class="btn btn-submit" name='occupation_add' value="occupation-add" type="submit"
                              id="ocupation-submit">Add Occupation</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="card card-menu">
            <div class="row row-table">
               <div class="col-12 dataTables_wrapper" id="example_wrapper">
                  <table
                     class="table table-striped dt-responsive  dataTable no-footer dtr-inline collapsed tableshow occupation_insert table-background-color"
                     style="width: 100%;" aria-describedby="example_info" id="occupation_table">
                     <thead class="table-heading">
                        <tr class="main">
                           <th> 
                              <input class="mx-3" type="checkbox" id="select-all"/>
                           </th>
                           <th>
                                 <span>Occupation Details</span>
                           </th>
                        </tr>
                     </thead>
                     <tbody id="occupation_list">
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
   </div>
</div>
<div class="modal fade" id="occupation_view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <form class="needs-validation" name="occupationname_update_form" method="POST" novalidate="">
            <div class="modal-header modal-headerr pt-2 pb-2">
               <h4 class="modal-title" id="exampleModalLabel">Edit Occupation</h4>
               <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                     class="bi bi-x-circle"></i></button>
            </div>
            <div class="modal-body ">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="row g-2">
                        <div class="col-6">
                           <label for="departmentname" class="form-label form-labell">Occuption Details</label>
                           <input type="text" class="form-control form-controll" id="occupation_details"
                              name="occupation_details" placeholder="Details" required="">
                        </div>
                        <div class="col-6">
                           <label for="shortdepartmentname" class="form-label form-labell">Occuption Category</label>
                           <div class="d-flex form-control main-form p-0">
                              <div class="dropdown bootstrap-select form-control">
                                 <select name="occupation_category" id="occupation_category"
                                    class="selectpicker form-control form-main" data-live-search="true" required=""
                                    tabindex="-98">
                                    <option class="dropdown-item" value="">Select Action</option>
                                    <option class="dropdown-item" data-sourcetype_name="self_employee"
                                       value="self employee">Self employee</option>
                                    <option class="dropdown-item" data-sourcetype_name="self_employee" value="Employee">
                                       Employee</option>
                                    <option class="dropdown-item" data-sourcetype_name="self_employee"
                                       value="Bussiness">Bussiness</option>
                                 </select>
                                 <div class="dropdown-menu " role="combobox">
                                    <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
                                          role="textbox" aria-label="Search">
                                    </div>
                                    <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                       <ul class="dropdown-menu inner show"></ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <!-- end row -->
            </div>
            <div class="modal-footer modal-footer2">
               <a class="delete-tools me-0" href="javascript:void(0)">
                  <span class="delete"><i class="bi bi-trash3 me-2"></i>Delete</span>
                  <span class="really" data-delete_id="">Really ?</span>
               </a>
               <button class="btn btn-submit occupation_view ms-0" id="occupation_view_btn" data-edit_id=""
                  name="occupation_view" value="occupation_view">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>

   $(document).ready(function () {
      $('#management-department').DataTable( {
         columnDefs: [ {
            'targets': [0],
            'orderable': false,
         }],
      } );

      var selectAllItems = "#select-all";
      var checkboxItem = ".checkbox";
      
      $(selectAllItems).click(function() {
      
         if (this.checked) {
            $(checkboxItem).each(function() {
               this.checked = true;
            });
         } else {
            $(checkboxItem).each(function() {
               this.checked = false;
            });
         }
      
      });

      // list data
      function datatable_view(html) {
         $('#occupation_table').DataTable().destroy();
         $('#occupation_list').html(html);
         var table1 = $('#occupation_table').DataTable({
            lengthChange: true,
         });
      }

      function list_data() {
         show_val = '<?= json_encode(array('id','occupation_details', 'occupation_category')); ?>';
         $('.loader').show();
         $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('MasterInformation_listing'); ?>",
            data: {
               'table': 'occupation',
               'show_array': show_val,
               'action': true
            },
            success: function (res) {
               $('.loader').hide();
               datatable_view(res);
            }
         });
      }

      list_data();

      $("button[name='occupation_add']").click(function (e) {
         e.preventDefault();
         var form = $("form[name='occupation_form']")[0];
         var occupation_details = $('#occupation_details').val();
         var occupation_category = $('#occupation_category').val();
         // console.log("occupation_category : " + occupation_category);
         var formdata = new FormData(form);
         // console.log(form);
         if (occupation_details != "" && occupation_category != "") {
            var formdata = new FormData(form);
            formdata.append('action', 'insert');
            formdata.append('table', 'occupation');
            $('.loader').show();

            $.ajax({
               method: "post",
               url: "<?= site_url('insert_data'); ?>",
               data: formdata,
               processData: false,
               contentType: false,
               success: function (data) {
                  if (data != "error") {
                     $("form[name='occupation_form']")[0].reset();
                     $("form[name='occupation_form']").removeClass("was-validated");
                     $('.loader').hide();
                     // sweet_edit_sucess('Add successfully');
                     iziToast.success({
                        title: 'Added Successfully'
                     });
                     list_data();

                  } else {
                     $('.loader').hide();
                     // Swal.fire({
                     //    title: 'Cancelled',
                     //    text: 'Duplicate Data Not Valid',
                     //    icon: 'error',
                     // })
                     iziToast.error({
                        title: 'Duplicate data'
                     });
                  }
               },
            });
         }
         else{
            $("form[name='occupation_form']").addClass("was-validated");
         }
      });

      // edit
      $(".occupation_insert").on('click', '.occupation_edt', function (e) {
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
                  table: 'occupation'
               },
               success: function (res) {
                  $('.loader').hide();
                  // console.log(res);
                  var response = JSON.parse(res);
                  $("#occupation_view input[name=occupation_details]").val(response[0].occupation_details);
                  $("#occupation_view select#occupation_category").val(response[0].occupation_category);
                  $('#occupation_view_btn').attr('data-edit_id', response[0].id);
                  $('.really').attr('data-delete_id', response[0].id);
                  $('.selectpicker').selectpicker('refresh');
               },
               error: function (error) {
                  $('.loader').hide();
                  // console.log(error);
               }
            });
         } else {
            $('.loader').hide();
            alert("Data Not Edit.");

         }

         

      });

      //list update
      $("#occupation_view").on('click', '.occupation_view', function (e) { 
         e.preventDefault();;
         var update_id = $(this).attr("data-edit_id");
         var occupation_details = $('#occupation_view #occupation_details').val();
         var occupation_category = $('#occupation_view #occupation_category').val();

         if (update_id != "" && occupation_details != "" && occupation_category != "") {
            var form = $("form[name='occupationname_update_form']")[0];
            var formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', 'occupation');
            $('.loader').show();
            $.ajax({
               method: "post",
               url: "<?= site_url('MasterInformation_update'); ?>",
               data: formdata,
               processData: false,
               contentType: false,
               success: function (res) {
                  if (res == true) {
                     $('.loader').hide();
                     $("form[name='occupationname_update_form']")[0].reset();
                     $("form[name='occupationname_update_form']").removeClass("was-validated");
                     $(".modal-close-btn").trigger("click");
                     iziToast.success({
                        title: 'Update Successfully'
                     });
                     list_data();

                  } else {
                     $('.loader').hide();
                     $(".btn-close").trigger("click");
                     $("form[name='occupationname_update_form']").removeClass("was-validated");
                     iziToast.error({
                        title: 'Duplicate data'
                     });
                  }
               },
               error: function (error) {
                  $('.loader').hide();
               }
            });
         } else {
            $('.loader').hide();
            //alert("Data Not Edit.");
            $("form[name='occupationname_update_form']").addClass("was-validated");
            $("form[name='occupationname_update_form']").find('.selectpicker').each(function () {
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

      // list delete
      $("#occupation_view").on('click', '.really', function (e) {
            // alert("hello");
            e.preventDefault();
            var delete_value = $(".really").attr("data-delete_id");
            // console.log(delete_value);
            if (delete_value != "") {
               $('.loader').show();
               $.ajax({
                  type: "post",
                  url: "<?= site_url('MasterInformation_delete'); ?>",
                  data: {
                     action: 'delete',
                     del_id: delete_value,
                     table: 'occupation'
                  },
                  success: function (res) {
                     list_data();
                     $('.loader').hide();
                     $(self).remove();
                     $(".modal-close-btn").trigger("click");
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

   });
</script>