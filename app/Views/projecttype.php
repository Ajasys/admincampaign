<!------------------------- Header Start ------------------------------->
<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<!------------------------- Header Start ------------------------------->

<!------------------------- Project Type Start ------------------------------->

<div class="projectt">
    <div class=" container-fluid">
        <div class="row row-main">
            <div class="col-11">
                <h4>Manage Project Type</h4>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <a href="#" class="btn-primary-rounded"><i class="bi bi-plus-lg add-panel-plus"></i></a>
            </div>
        </div>
        <div class="card card-menu add-panel">
            <div class="card-main">
                <div class="row row-line">
                    <div class="col-12">
                        <form class="formsize" name="project_type_form" novalidate="">
                            <div class="row justify-content-start align-items-end">
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <label for="project_type" class="form-label form-name">Add Project
                                        type</label>
                                    <input type="text"
                                        onkeypress="return ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 8 || event.charCode == 32 || (event.charCode >= 48 && event.charCode <= 57));"
                                        data-validation="alphanumeric" data-validation-allowing="_"
                                        class="form-control form-controll" id="project_type" name="project_type"
                                        placeholder="Project Type" required="">
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <button class="btn btn-submit button-add btn-add" id="project_type_add"
                                        name="project_type_add" value="project_type_add" type="submit">Add Project
                                        Type</button>
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
                    <table id="project_type_table"
                        class="table table-striped dt-responsive nowrap dataTable table-background-color no-footer dtr-inline collapsed project_type_insert"
                        style="width: 100%;" aria-describedby="example_info">
                        <thead class=" table-heading">
                            <tr class="main">
                                <th> 
                                    <input class="mx-2" type="checkbox" id="select-all"/>
                                </th>
                                <th>
                                    <span>Project Type Details</span>
                                </th>
                            </tr>
                        </thead>
                      <tbody class="table-description" id="project_type_list">   <!--  -->
                        <!-- <tr>
                            <td class="align-middle">
                                <input class="checkbox mx-3 " type="checkbox"/>
                            </td>
                            <td class="edt d-flex">
                                <div class="project-type-list-trf w-100"  data-edit_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#project_management_type_update" >
                                    <div class="project-type-list-content d-flex align-items-center justify-content-between flex-wrap py-1">
                                        <div class="d-flex align-items-center  lh-21 col-xxs-2 col-xs-2 col-xl-2">
                                            <p>ID : </p>
                                            <span><b class="mx-1"> 1</b></span>
                                        </div>
                                        <div class="d-flex align-items-center lh-21  col-xxs-10 col-xs-10 col-xl-10">
                                            <p>Project Type : </p>
                                            <span class="mx-1">Commercial</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!---------------------------- Modal Strat ------------------------------>

<div class="modal fade" id="project_management_type_view" tabindex="-1" aria-labelledby="inquiryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="needs-validation" name="project_type_update_form" method="POST" novalidate="">
                <div class="modal-header pb-2 pt-2">
                    <h1 class="modal-title fs-5" id="inquiryModalLabel">Edit Project Type</h1>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="mb-0">
                                <label for="departmentname" class="form-label" style="font-size:0.8rem;">Project
                                    Type</label>
                                <input type="text" class="form-control" id="project_type" name="project_type"
                                    placeholder="Type" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer2">
                    <a class="delete-tools me-0" href="javascript:void(0)">
                        <span class="delete"><i class="bi bi-trash3 me-2"></i>Delete</span>
                        <span class="really project_type_delete" data-delete_id="">Really ?</span>
                    </a>
                    <button class="btn btn-submit project_type_update" id="project_management_type_view_btn"
                        data-edit_id="" name="project_management_type_view"
                        value="project_management_type_view">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<!------------------------- Footer Start --------------------------->
<script>

    $(document).ready(function () {
        setTimeout(function () {
            $(".loader").fadeOut(500);
        }, 2000)
    });

    $(document).ready(function () {

        $('#project_type_table').DataTable( {
      columnDefs: [ {
           'targets': [0], /* column index [0,1,2,3]*/
           'orderable': false, /* true or false */
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
            $('#project_type_table').DataTable().destroy();
            $('#project_type_list').html(html);
            var table1 = $('#project_type_table').DataTable({
                lengthChange: true,
            });
        }

        function list_data() {
            show_val = '<?= json_encode(array('id','project_type')); ?>';
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('MasterInformation_listing'); ?>",
                data: {
                    'table': 'project_management_type',
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

        $("button[name='project_type_add']").click(function (e) {
            e.preventDefault();
            var form = $("form[name='project_type_form']")[0];
            var project_type = $('#project_type').val();
            var formdata = new FormData(form);

            if (project_type != "") {
                console.log(project_type);

                var formdata = new FormData(form);

                formdata.append('action', 'insert');
                formdata.append('table', 'project_management_type');
                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('insert_data'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data != "error") {
                            $("form[name='project_type_form']")[0].reset();
                            $("form[name='project_type_form']").removeClass("was-validated");
                            $('.loader').hide();
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                            list_data();
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
                $("form[name='project_type_form']").addClass("was-validated");
            }
        });

        // edit
        $(".project_type_insert").on('click', '.project_management_type_edt', function (e) {
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
                        table: 'project_management_type'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        // console.log(res);
                        var response = JSON.parse(res);
                        $("#project_management_type_view input[name=project_type]").val(response[0].project_type);
                        $('#project_management_type_view_btn').attr('data-edit_id', response[0].id);
                        $('.project_type_delete').attr('data-delete_id', response[0].id);
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

            
            // });
        });

        //list update
        $("#project_management_type_view").on('click', '.project_type_update', function (e) {
            e.preventDefault();;
            var update_id = $(this).attr("data-edit_id");
            var project_type = $('#project_management_type_view #project_type').val();
            if (update_id != "" && project_type != "") {
                var form = $("form[name='project_type_update_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'update');
                formdata.append('edit_id', update_id);
                formdata.append('table', 'project_management_type');
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
                            $("form[name='project_type_update_form']")[0].reset();
                            $("form[name='project_type_update_form']").removeClass("was-validated");
                            $(".modal-close-btn").trigger("click");
                            iziToast.success({
                                title: 'Update Successfully'
                            });
                            list_data();

                        } else {
                            $('.loader').hide();
                            $(".btn-close").trigger("click");
                            $("form[name='project_type_update_form']").removeClass("was-validated");
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
                $("form[name='project_type_update_form']").addClass("was-validated");
            }
        });

        // list delete
        $("#project_management_type_view").on('click', '.project_type_delete', function (e) {
            e.preventDefault();
            var delete_value = $(".project_type_delete").attr("data-delete_id");
            // var delete_value = self.find(".department_id").val();

            if (delete_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('MasterInformation_delete'); ?>",
                    data: {
                        action: 'delete',
                        del_id: delete_value,
                        table: 'project_management_type'
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