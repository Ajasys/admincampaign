<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
?>
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1 d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <h2>Manage Department</h2>
                </div>
                <div class="d-flex">
                    <?php if (in_array('departmentinformation_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <div id="deleted-all">
                            <span class="btn-primary-rounded me-2">
                                <i class="bi bi-trash3 fs-14"></i>
                            </span>
                        </div>
                    <?php } ?>
                    <button class="btn-primary-rounded"><i class="bi bi-plus add-panel-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <form class="needs-validation" name="departmentname_val" method="POST" novalidate="">
                <div class="d-flex flex-wrap">
                    <div class="col-lg-3 col-md-4 col-sm-6 px-2">
                        <label class="main-label">Add Department</label>
                        <input type="text" class="form-control main-control" id="departmentname" name="departmentname" placeholder="Department Name" required="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 px-2">
                        <label class="main-label">Add Short Department</label>
                        <input type="text" class="form-control main-control" id="shortdepartmentname" name="shortdepartmentname" placeholder="Short Department Name" required="">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2 d-flex justify-content-start align-items-end">
                        <button class=" btn-primary" name="department_add" value="department_add" id="add_department" type="submit">Add Department</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
        <table id="management-department" class="table main-table w-100" aria-describedby="example_info">
            <thead>
                <tr>
                    <th> <input class="mx-3" type="checkbox" id="select-all" /></th>
                    <th>
                        <div class="div d-flex">

                            <span>Department details</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody id="department_list"></tbody>
        </table>
    </div>
</div>
<!-- start popup edit  -->
<div class="modal fade " id="admin_department_view" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content">
            <form class="needs-validation" name="department_update_form" method="POST" novalidate>
                <div class="modal-header pb-2 pt-2">
                    <h1 class="modal-title" id="exampleModalLabel">Edit Department</h1>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body p-2">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row g-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="main-label">Add Department</label>
                                    <input type="text" class="form-control main-control" id="departmentname"
                                        name="departmentname" placeholder="Department Name" required="">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="main-label">Add Short Department</label>
                                    <input type="text" class="form-control main-control" id="shortdepartmentname"
                                        name="shortdepartmentname" placeholder="Short Department Name" required="">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <div class="modal-footer modal-footer2">
                    <a class="delete_main">
                        <?php if (in_array('departmentinformation_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                            <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                            <div class="btn-secondary px-3   dlt">Really ?</div>
                        <?php } ?>
                    </a>
                    <button class="btn-primary  department_update" id="department_update_btn" data-edit_id=""
                        name="department_update" value="department_update">Update</button>

                </div>
            </form>

        </div>
    </div>
</div>
<!-- end popup edit  -->

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>




<script type="text/javascript">
    $(document).ready(function () {

        $('#management-department').DataTable({
            columnDefs: [{
                'targets': [0],
                /* column index [0,1,2,3]*/
                'orderable': false,
                /* true or false */
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


        $("body").on('change', '.selectall', function () {
            var deleteButton = $("#deleted-all");
            if ($(this).is(":checked")) {
                // deleteButton.removeClass("hide");
                // $('.main-select-section').show();
                deleteButton.show();
            } else {
                // $('.main-select-section').hide();
                // deleteButton.addClass("hide");
                deleteButton.hide();
            }
            checkIfAnyCheckboxChecked();
        });
        $('#add_department').on('click', function () {

            event.preventDefault();
            var departmentname = $('#departmentname').val();
            var shortdepartmentname = $('#shortdepartmentname').val();

            // insert
            if (departmentname != "" && shortdepartmentname != "") {
                $.ajax({

                    type: "post",
                    url: "<?= site_url('department_insertdata'); ?>",
                    data: {

                        departmentname: departmentname,
                        shortdepartmentname: shortdepartmentname,
                        table: "admin_department",
                        action: "insert",
                    },
                    success: function (data) {
                        if (data != "error") {
                            // console.log(data);
                            // $('.loader').hide();
                            list_data();

                            $(".btn-close").trigger("click");
                            $("form[name='departmentname_val']")[0].reset();
                            $("form[name='departmentname_val']").removeClass("was-validated");
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                        } else {
                            $('.loader').hide();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                        }
                    }
                });
            } else {
                // alert("hello");
                $("form[name='departmentname_val']").addClass("was-validated");
            }


        });

        // data list 
        function list_data() {
            show_val = '<?= json_encode(array('id', 'departmentname', 'shortdepartmentname')); ?>';
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('department_listing'); ?>",
                data: {
                    'table': 'admin_department',
                    'show_array': show_val,
                    'action': true
                },
                success: function (data) {
                    // console.log(data);
                    $('#management-department').DataTable().destroy();
                    $('#department_list').html(data);
                    var table1 = $('#management-department').DataTable({
                        lengthChange: true,
                    });
                    $('.loader').hide();

                    // datatable_view(res);
                    // $('.question').html(res);
                    // var project=$("#question").val();                       
                    //     console.log(project);
                    // $(".project_data").html(project);
                }
            });
        }

        list_data();

        // edit data 
        $(document).ready(function () {
            $('body').on('click', '.admin_department_edt', function () {



                var id = $(this).attr('data-edit_id');
                // console.log(id)
                ;

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('department_edit_data'); ?>",
                    data: {
                        id: id,
                        action: 'edit',
                        table: 'admin_department'
                    },
                    success: function (dataResult) {

                        var response = JSON.parse(dataResult);
                        // console.log(response[0].question);


                        $('#admin_department_view #departmentname').val(response[0].departmentname);
                        $('#admin_department_view #shortdepartmentname').val(response[0].shortdepartmentname);
                        // console.log(response.question);

                        $('#department_update_btn').attr('data-edit_id', response[0].id);
                        $('.dlt').attr('data-delete_id', response[0].id);


                    }
                });
            });
        });


        // new update
        $("#admin_department_view").on('click', '.department_update', function (e) {
            // alert("hello");
            event.preventDefault();

            var id = $(this).attr('data-edit_id');
            // console.log(id)

            var departmentname = $('#admin_department_view #departmentname').val();
            var shortdepartmentname = $('#admin_department_view #shortdepartmentname').val();
            // console.log(departmentname);
            $('.loader').show();
            if (departmentname != "" && shortdepartmentname != "") {

                $.ajax({
                    method: "POST",
                    url: "<?= site_url('department_updatedata'); ?>",
                    data: {
                        id: id,
                        departmentname: departmentname,
                        shortdepartmentname: shortdepartmentname,
                        table: "admin_department",
                        action: "update",
                    },

                    success: function (dataResult) {
                        if (dataResult != "error") {
                            $('.loader').hide();


                            $('.department_list').html(dataResult);
                            list_data();
                            $(".modal-close-btn").trigger("click");
                            $("form[name='department_update_form']").removeClass("was-validated");
                            iziToast.success({
                                title: 'Update Successfully'
                            });
                        } else {
                            $('.loader').hide();
                            iziToast.error({
                                title: 'Duplicate Data Not Valid'
                            });
                        }
                    }
                });
            } else {
                $('.loader').hide();
                // alert("hello");
                $("form[name='department_update_form']").addClass("was-validated");
            }
        });
        // delete data  


        $('body').on('click', '.dlt', function () {
            var id = $(this).attr('data-delete_id');


            $.ajax({
                method: "POST",
                url: "<?= site_url('department_delete'); ?>",
                data: {
                    action: 'delete',
                    id: id,
                    table: 'admin_department'
                },

                success: function (data) {
                    list_data();
                    $(".modal-close-btn").trigger("click");
                    // $(self).remove();
                    iziToast.delete({
                        title: 'Delete successfully'
                    });

                }
            });


        });





    });
</script>