<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<!-- inquiry start -->
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1">
                    <h2>Manage Inquiry Status</h2>
                </div>
                <div class="d-flex align-items-center">
                    <?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <div id="deleted-all">
                            <span class="btn-primary-rounded elevation_add_button me-2">
                                <i class="bi bi-trash3 fs-14"></i>
                            </span>
                        </div>
                    <?php } ?>
                    <!-- <button class="btn-primary-rounded">
                        <i class="bi bi-plus add-panel-plus"></i>
                    </button> -->
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <form action="" class="formsize needs-validation" name="inquirystatus" novalidate>
                <div class="d-flex flex-wrap justify-content-start align-items-end">
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                        <label class="main-label text-nowrap">Add Inquiry Status</label>
                        <input type="text" class="form-control main-control" id="inquiryname" name="inquiry_status"
                            placeholder="Inquiry Status" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2 ">
                        <button class="btn-primary mt-2 text-nowrap" name="inquirystatus_add" value="inquirystatus_add" type="submit" >Add
                            Inquiry Status</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <table id="statusinquiry" class="table main-table w-100" aria-describedby="example_info">
                <thead>
                    <tr>
                        <th>
                            <input class="check_box" type="checkbox" id="select-all" />
                        </th>
                        <th>
                            <span>Inquiry Status</span>
                        </th>
                    </tr>
                </thead>
                <tbody id="inquirystatus_list"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="master_inquiry_status_view" tabindex="-1" aria-labelledby="inquiryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Edit Inquiry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="need-validation" id="master_inquirystatus_update_form" name="master_inquirystatus_update_form" novalidate>
                    <div class="col-md-6 col-12">
                        <label class="main-label">Inquiry Status</label>
                        <input type="text" class="form-control main-control" id="inquirystatus" name="inquiry_status" placeholder="Fresh" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer2">
                <div class="delete_main">
                    <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                    <div class="btn-secondary px-3" id="inquirystatus_delete_btn" data-delete_id>Really ?</div>
                </div>
                <button class="btn-primary" id="inquirystatus_update_btn" data-edit_id>Update</button>
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
                                    table: 'master_inquiry_status',
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

        $('#statusinquiry').DataTable({
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

        // alert('hi');
        list_data();

        function datatable_view(html) {
            $('#statusinquiry').DataTable().destroy();
            $('#inquirystatus_list').html(html);
            var table1 = $('#statusinquiry').DataTable({
                lengthChange: true,
            });
        }

        function remove_space_add_underscore(string) {
            var trim_value = $.trim(string);

            var undoerscore_value = trim_value.replace(/\s+/g, '_');

            return undoerscore_value;
        }

        function list_data() {
            show_val = '<?= json_encode(array('id', 'inquiry_status')); ?>';
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('MasterInformation_listing'); ?>",
                data: {
                    'table': 'master_inquiry_status',
                    'show_array': show_val,
                    'action': true
                },
                success: function (res) {
                    $('.loader').hide();
                    datatable_view(res);
                    // $('#inquirytype_list').html(res);
                }
            });
            $('.loader').hide();
        }

        // insert data 
        $("button[name='inquirystatus_add']").click(function (e) {
            e.preventDefault();
            // alert('hi');
            var form = $("form[name='inquirystatus']")[0];
            var inquirytype = $('#inquiryname').val();
            // console.log(form);
            // console.log(inquirytype);

            if (inquirytype != "") {
                var formdata = new FormData(form);
                var new_val = remove_space_add_underscore(inquirytype);
                formdata.append('action', 'insert');
                formdata.append('table', 'master_inquiry_status');
                // formdata.append('code', new_val);
                // console.log(formdata);
                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('insert_data'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res != "error") {
                            $('.loader').hide();
                            $("form[name='inquirystatus']").removeClass("needs-validation");
                            $("form[name='inquirystatus']").removeClass("was-validated");
                            $("form[name='inquirystatus']")[0].reset();
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                            list_data();
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
                $("form[name='inquirystatus']").addClass("was-validated");
            }
        });

        //edit inquiry data
        $("#statusinquiry").on('click', '.master_inquiry_status_edt', function (e) {
            e.preventDefault();
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-edit_id");
            // alert("hi");
            // console.log(self);
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('MasterInformation_edit'); ?>",
                    data: {
                        action: 'edit',
                        edit_id: edit_value,
                        table: 'master_inquiry_status'
                    },
                    success: function (res) {
                        // console.log(res);
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        $("#master_inquiry_status_view input[name='inquiry_status']").val(response[0].inquiry_status);
                        $('#inquirystatus_update_btn').attr('data-edit_id', response[0].id);
                        $('#inquirystatus_delete_btn').attr('data-delete_id', response[0].id);
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
        $("#master_inquiry_status_view").on('click', '#inquirystatus_delete_btn', function (e) {
            e.preventDefault();
            // alert('hello');
            var id = $(this).attr("data-delete_id");
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
                        table: 'master_inquiry_status'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        $('.modal-close-btn').trigger('click');
                        // $(self).remove();
                        list_data();
                        iziToast.delete({
                            title: 'Delete successfully'
                        });
                    },
                    error: function (error) {
                        $('.loader').hide();
                    }
                });
            } else {
                alert('cant Find id');
            }
        });

        // update inquiry data
        $("#master_inquiry_status_view").on('click', '#inquirystatus_update_btn', function (e) {
            e.preventDefault();
            var update_id = $(this).attr("data-edit_id");
            var inquirytype_update = $('#master_inquirystatus_update_form #inquirystatus').val();
            if (update_id != "" && inquirytype_update != "") {
                var form = $("form[name='master_inquirystatus_update_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'update');
                formdata.append('edit_id', update_id);
                formdata.append('table', 'master_inquiry_status');
                // console.log(form);
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
                            $("form[name='master_inquirystatus_update_form']").removeClass("needs-validation");
                            $("form[name='master_inquirystatus_update_form']").removeClass("was-validated");
                            $('.btn-close').trigger('click');
                            list_data();

                            iziToast.success({
                                title: 'Update Successfully'
                            });
                        } else {
                            $('.loader').hide();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                        }
                        // $('.loader').hide();
                        // list_data();
                    },
                    error: function (error) {
                        $('.loader').hide();
                    }
                });
            } else {
                $('.loader').hide();
                $("form[name='master_inquirystatus_update_form']").addClass("was-validated");
                $("form[name='master_inquirystatus_update_form']").find('.selectpicker').each(function () {
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