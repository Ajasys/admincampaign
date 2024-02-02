<!------------------------- Header Start ------------------------------->
<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<!------------------------- Header Start ------------------------------->
<!--------------------------------- Project Sub Type Start -------------------------->
<div class="main-container">
   <div class="container-fluid">
      <div class="row row-main">
         <div class="col-11">
            <h4>Project Sub Type List</h4>
         </div>
         <div class="col-1 d-flex justify-content-end">
            <a href="#" class="btn-primary-rounded"><i class="bi bi-plus-lg add-panel-plus"></i></a>
         </div>
      </div>
      <!-- page-title-end -->
      <!-- card-box-1-start -->
      <div class="card card-menu add-panel">
         <div class="card-main">
            <div class="row row-line">
               <div class="col-12">
                  <form class="formsize" name="project_subtype_form" novalidate="">
                     <div class="row justify-content-start align-items-end">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                           <label for="" class="form-label form-name">Add Project Sub
                              Type</label>
                           <input type="text" class="form-control form-controll" id="project_sub_type"
                              name="project_sub_type" placeholder="Project Sub Type Name" required="">

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                           <label for="project_type" class="form-label form-name">Project Type</label>
                           <div class="d-flex form-control main-form p-0">
                              <div class="dropdown bootstrap-select form-control" id="project_sub_type_select_table">
                                 <select name="project_type" id="project_type" class="selectpicker form-control select form-main" data-live-search="true" required=""><i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Project Type</option>
                                    <?php
                                    $project_management_type = json_decode($project_management_type, true);
                                    if (isset($project_management_type)) {
                                       foreach ($project_management_type as $type_key => $type_value) {
                                          echo '<option class="dropdown-item" value="' . $type_value["project_type"] . '">' . $type_value["project_type"] . '</option>';
                                       }
                                    }
                                    ?>
                                 </select>
                                 <div class="dropdown-menu " role="combobox">
                                    <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
                                          role="textbox" aria-label="Search"></div>
                                    <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                       <ul class="dropdown-menu inner show"></ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                           <button class="btn btn-submit" name="project_subtype_add" value="project_subtype_add"
                              type="submit" id="projectsubtype-submit success">Add Project Sub Type</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- card-box-1-end -->
      <!-- card-body-start -->
      <div class="card card-menu">
         <div class="row row-table">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
               <table class="table table-striped dt-responsive  dataTable no-footer dtr-inline collapsed tableshow project_subtype_insert table-background-color"
                  style="width: 100%;" aria-describedby="example_info" id="project_sub_type_table">
                  <thead class="table-heading">
                     <tr class="main">
                        <th> 
                           <input class="mx-2" type="checkbox" id="select-all"/>
                        </th>
                        <th>
                           <span>Project Type Details</span>
                        </th>
                     </tr>
                  </thead>
                  <tbody class="table-description" id="project_sub_type_list">
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- card-body-end -->
   </div>
</div>
<div class="modal fade" id="project_management_subtype_view" tabindex="-1" aria-labelledby="stateModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <form class="needs-validation" name="project_sub_type_update_form" method="POST" novalidate="">
            <div class="modal-header pt-2 pb-2">
               <h1 class="modal-title fs-5" id="stateModalLabel">Edit Project Sub Type</h1>
               <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                     class="bi bi-x-circle"></i></button>
            </div>
            <div class="modal-body">
               <div class="row g-2">
                  <div class="col-lg-6 col-md-6 col-sm-6">
                     <div class="mb-0">
                        <label for="occupationname" class="form-label form-labell form-name">Project Sub
                           Type</label>
                        <input type="text" class="form-control form-controll" id="project_sub_type"
                           name="project_sub_type" placeholder="Bunglows" value="" required="">
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-4 col-sm-6">
                     <label for="project_type" class="form-label form-labell">Project Type</label>
                     <div class="d-flex form-control main-form p-0">
                        <div class="dropdown bootstrap-select form-control" id="project_sub_type_select_table">
                           <select name="project_type" id="project_type"
                              class="selectpicker form-control form-main select" data-live-search="true" required=""><i
                                 class="fa-solid fa-caret-down"></i>
                              <option class="dropdown-item" value="">Select Project Type</option>
                              <?php
                              if (isset($project_management_type)) {
                                 foreach ($project_management_type as $type_key => $type_value) {
                                    echo '<option class="dropdown-item" value="' . $type_value["project_type"] . '">' . $type_value["project_type"] . '</option>';
                                 }
                              }
                              ?>
                           </select>
                           <div class="dropdown-menu " role="combobox">
                              <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
                                    role="textbox" aria-label="Search"></div>
                              <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                 <ul class="dropdown-menu inner show"></ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer modal-footer2">
               <a class="delete-tools me-0" href="javascript:void(0)">
                  <span class="delete"><i class="bi bi-trash3 me-2"></i>Delete</span>
                  <span class="really" id="project_sub_type_delete">Really ?</span>
               </a>
               <button type="button" class="btn btn-update btn-1 btn-submit"
                  id="project_subtype_update_btn" data-edit_id="2" name="project_subtype_update"
                  value="project_subtype_update">update</button>
            </div>
         </form>
      </div>
   </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>


<script>

   $(document).ready(function () {
      setTimeout(function () {
         $(".loader").fadeOut(500);
      }, 2000)
   });

   $(document).ready(function () {
      
      $('#project_sub_type_table').DataTable( {
         columnDefs: [ {
            'targets': [0], /* column index [0,1,2,3]*/
            'orderable': false, /* true or false */
         }],
      });
   
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
      $('#project_sub_type_table').DataTable().destroy();
      $('#project_sub_type_list').html(html);
      var table1 = $('#project_sub_type_table').DataTable({
         lengthChange: true,
      });
   }

   function list_data() {
      show_val = '<?= json_encode(array('id','project_sub_type', 'project_type')); ?>';
      $('.loader').show();
      $.ajax({
         datatype: 'json',
         method: "post", 
         url: "<?= site_url('MasterInformation_listing'); ?>",
         data: {
            'table': 'project_management_subtype',
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

      

      $("button[name='project_subtype_add']").click(function (e) {
         e.preventDefault();
         var form = $("form[name='project_subtype_form']")[0];
         var project_sub_type = $('#project_sub_type').val();
         var project_type = $('#project_type').val();
         var formdata = new FormData(form);
         // console.log(form);
         if (project_sub_type != "" && project_type != "") {
            var formdata = new FormData(form);
            formdata.append('action', 'insert');
            formdata.append('table', 'project_management_subtype');
            $('.loader').show();

            $.ajax({
               method: "post",
               url: "<?= site_url('insert_data'); ?>",
               data: formdata,
               processData: false,
               contentType: false,
               success: function (data) {
                  if (data != "error") {
                     $("form[name='project_subtype_form']")[0].reset();
                     $("form[name='project_subtype_form']").removeClass("was-validated");
                     $('.loader').hide();
                     // sweet_edit_sucess('Add successfully');
                     iziToast.success({
                        title: 'Added Successfully'
                     });
                     list_data();
                     $('.selectpicker').selectpicker('refresh');
                  } else {
                     $('.loader').hide();
                     iziToast.error({
                        title: 'Duplicate data'
                     });
                  }
               },
            });
         }
         else{
            $("form[name='project_subtype_form']").addClass("was-validated");
         }
      });

      // edit data
      $(".project_subtype_insert").on('click', '.project_management_subtype_edt', function (e) {
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
                  table: 'project_management_subtype'
               },
               success: function (res) {
                  $('.loader').hide();
                  var response = JSON.parse(res);
                  $("#project_management_subtype_view input[name=project_sub_type]").val(response[0].project_sub_type);
                  $("#project_management_subtype_view select[name='project_type']").val(response[0].project_type);
                  $('#project_subtype_update_btn').attr('data-edit_id', response[0].id);
                  $('#project_sub_type_delete').attr('data-delete_id', response[0].id);
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
      $("#project_management_subtype_view").on('click', '#project_subtype_update_btn', function (e) {
         // alert("hii");
         // exit;
         e.preventDefault();;
         var update_id = $(this).attr("data-edit_id");
         var project_sub_type = $('#project_management_subtype_view #project_sub_type').val();
         var project_type = $('#project_management_subtype_view #project_type').val();
         
         if (update_id != "" && project_sub_type != "" && project_type != "") {
            var form = $("form[name='project_sub_type_update_form']")[0];
            var formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', 'project_management_subtype');
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
                     $("form[name='project_sub_type_update_form']")[0].reset();
                     $("form[name='project_sub_type_update_form']").removeClass("was-validated");
                     $(".modal-close-btn").trigger("click");
                     $('.selectpicker').selectpicker('refresh');
                     iziToast.success({
                        title: 'Update Successfully'
                     });
                     list_data();

                  } else {
                     $('.loader').hide();
                     $(".btn-close").trigger("click");
                     $("form[name='project_sub_type_update_form']").removeClass("was-validated");
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
            $("form[name='project_sub_type_update_form']").addClass("was-validated");
            $("form[name='project_sub_type_update_form']").find('.selectpicker').each(function () {
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
      $("#project_management_subtype_view").on('click', '#project_sub_type_delete', function (e) {
         // alert("hii");
         e.preventDefault();
         var delete_value = $("#project_sub_type_delete").attr("data-delete_id");
         // var delete_value = self.find(".department_id").val();
         if (delete_value != "") {
            // $('.loader').show();
            $.ajax({
               type: "post",
               url: "<?= site_url('MasterInformation_delete'); ?>",
               data: {
                  action: 'delete',
                  del_id: delete_value,
                  table: 'project_management_subtype'
               },
               success: function (res) {
                  $('.loader').hide();
                  $(self).remove();
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

   });
</script>