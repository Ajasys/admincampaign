<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<!-- <div class="loader">
    <div class="ring"></div>
    <span class="loader-span">loading...</span>
 </div> -->
<div class="projectt">
    <div class=" container-fluid">
        <div class="row row-main">
            <div class="col-11">
                <h4>Manage Project Status</h4>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <a href="#" class="btn-primary-rounded"><i class="bi bi-plus-lg add-panel-plus"></i></a>
            </div>
        </div>
        <div class="card card-menu add-panel">
            <div class="card-main">
                <div class="row row-line">
                    <div class="col-12">
                        <form class="formsize" name="project_status_form" novalidate="">
                            <div class="row justify-content-start align-items-end">
                                <div class="col-lg-4 col-md-4 col-sm-6">


                                    <label for="occupationname" class="form-label form-name">Add Project Status</label>
                                    <input type="text" class="form-control form-controll" id="project_status"
                                        name="project_status" placeholder="Project Status" required="">


                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <button class="btn btn-submit" name='project_status_add' value="project_status_add"
                                        type="submit" id="project_status_add">Add Status</button>
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
                    <table class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline collapsed tableshow project_status_insert table-background-color"
                        style="width: 100%;" aria-describedby="example_info" id="project_status_table">
                        <thead class=" table-heading">
                            <tr class="main">
                                <th><input class="mx-3" type="checkbox" id="select-all"/></th>
                                <th>Project Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-description" id="project_status_list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="project_management_status_view" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="needs-validation" name="project_status_update_form" method="POST" novalidate>
                    <div class="modal-header pt-2 pb-2">
                        <h4 class="modal-title" id="exampleModalLabel">Edit Project Status</h4>
                        <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bi bi-x-circle"></i></button>
                    </div>
                    <div class="modal-body p-2">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label for="departmentname" class="form-label form-labell"
                                            style="font-size:0.8rem;">Project
                                            Status</label>
                                        <input type="text" class="form-control form-controll" id="project_status"
                                            name="project_status" placeholder="Type" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="modal-footer modal-footer2">
                        <a class="delete-tools" href="javascript:void(0)">
                            <span class="delete"><i class="bi bi-trash3 me-2"></i>Delete</span>
                            <span class="really project_status_delete" data-delete_id="">Really ?</span>
                        </a>
                        <button class="btn btn-submit project_status_update" id="project_management_status_view_btn"
                            data-edit_id="" name="project_management_status_view"
                            value="project_management_status_view">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
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
    $(document).ready(function () {
        setTimeout(function () {
            $(".loader").fadeOut(500);
        }, 2000)
    });

    $(document).ready(function () {

        // list data
        function datatable_view(html) {
            $('#project_status_table').DataTable().destroy();
            $('#project_status_list').html(html);
            var table1 = $('#project_status_table').DataTable({
                lengthChange: true,
            });
        }

        function list_data() {
            show_val = '<?= json_encode(array('id','project_status')); ?>';
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('MasterInformation_listing'); ?>",
                data: {
                    'table': 'project_management_status',
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

        $("button[name='project_status_add']").click(function (e) {
            e.preventDefault();
            var form = $("form[name='project_status_form']")[0];
            var project_status = $('#project_status').val();
            var formdata = new FormData(form);
            console.log(form);
            if (project_status != "") {
                var formdata = new FormData(form);

                formdata.append('action', 'insert');
                formdata.append('table', 'project_management_status');
                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('insert_data'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data != "error") {
                            $("form[name='project_status_form']")[0].reset();
                            $("form[name='project_status_form']").removeClass("was-validated");
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
            else{
                $("form[name='project_status_form']").addClass("was-validated");
            }
        });

        // edit
        $(".project_status_insert").on('click', '.project_management_status_edt', function (e) {
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
                        table: 'project_management_status'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        // console.log(res);
                        var response = JSON.parse(res);
                        $("#project_management_status_view input[name=project_status]").val(response[0].project_status);
                        $('#project_management_status_view_btn').attr('data-edit_id', response[0].id);
                        $('.project_status_delete').attr('data-delete_id', response[0].id);
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
        $("#project_management_status_view").on('click', '.project_status_update', function (e) {
            e.preventDefault();;
            var update_id = $(this).attr("data-edit_id");
            var project_status = $('#project_management_status_view #project_status').val();
            if (update_id != "" && project_status != "") {
                var form = $("form[name='project_status_update_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'update');
                formdata.append('edit_id', update_id);
                formdata.append('table', 'project_management_status');
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
                            $("form[name='project_status_update_form']")[0].reset();
                            $("form[name='project_status_update_form']").removeClass("was-validated");
                            $(".modal-close-btn").trigger("click");
                            iziToast.success({
                                title: 'Update Successfully'
                            });
                            list_data();

                        } else {
                            $('.loader').hide();
                            $("form[name='project_status_update_form']").removeClass("was-validated");
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
                $("form[name='project_status_update_form']").addClass("was-validated");
            }
        });

        // list delete
        $("#project_management_status_view").on('click', '.project_status_delete', function (e) {
            e.preventDefault();
            var delete_value = $(".project_status_delete").attr("data-delete_id");
            // var delete_value = self.find(".department_id").val();

            if (delete_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('MasterInformation_delete'); ?>",
                    data: {
                        action: 'delete',
                        del_id: delete_value,
                        table: 'project_management_status'
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