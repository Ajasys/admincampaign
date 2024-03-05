<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1">
                    <h2>Manage Inquiry Type</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <div id="deleted-all">
                            <span class=" btn-primary-rounded me-2  elevation_add_button add-button">
                                <i class="bi bi-trash3 fs-14"></i>
                            </span>
                        </div>
                    <?php } ?>
                    <a href="#" class="btn-primary-rounded "><i class="bi bi-plus add-panel-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <form class="formsize needs-validation" name="inquirytype" novalidate>
                <div class="d-flex flex-wrap justify-content-start align-items-end">
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                        <label class="mian-label text-nowrap">Add Inquiry Type</label>
                        <input type="text" class="form-control main-control" id="inquiryname" name="inquiry_details" placeholder="Inquiry Name" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                        <button class="btn-primary text-nowrap mt-2" name="inquirytype_add" value="inquiry_add" id="inquiry_add" type="submit">Add Inquiry</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <table id="master-inquiry-table" class="table main-table w-100">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all" />
                        </th>
                        <th>
                            <span>Inquiry Details</span>
                        </th>
                    </tr>
                </thead>
                <tbody id="inquirytype_list"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="admin_master_inquiry_type_view" tabindex="-1" aria-labelledby="inquiryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="inquiryModalLabel">Edit Inquiry Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="" name="master_inquirytype_update_form"
                    id="master_inquirytype_update_form" novalidate>
                    <div class="col-md-6 col-12">
                        <div class="mb-0">
                            <label class="form-label main-label">inquiry Type update</label>
                            <input type="text" class="form-control main-control" id="inquirytype_name" name="inquiry_details" placeholder="inquiry update" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="delete_main">
                    <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                    <div class="btn-secondary px-3 really" id="inquirytype_delete_btn" data-delete_id>Really ?</div>
                </div>
                <button class="btn-primary" id="inquirytype_update_btn" data-edit_id="" name="occupation_update" value="occupation_update">Update</button>
            </div>
        </div>
    </div>
</div>

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
                                    table: ' admin_master_inquiry_type',
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

        $('#master-inquiry-table').DataTable({
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
        list_data();

        function datatable_view(html) {
            $('#master-inquiry-table').DataTable().destroy();
            $('#inquirytype_list').html(html);
            var table1 = $('#master-inquiry-table').DataTable({
                "columnDefs": [
                    // Hide second, third and fourth columns
                    {
                        "visible": false
                    }
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
            show_val = '<?= json_encode(array('id', 'inquiry_details')); ?>';
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('MasterInformation_listing'); ?>",
                data: {
                    'table': 'admin_master_inquiry_type',
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

        $("button[name='inquirytype_add']").click(function (e) {
            e.preventDefault();
            var form = $("form[name='inquirytype']")[0];
            var inquirytype = $('#inquiryname').val();
            // console.log(form);
            // console.log(inquirytype);

            if (inquirytype != "") {
                var formdata = new FormData(form);


                var new_val = remove_space_add_underscore(inquirytype);
                formdata.append('action', 'insert');
                formdata.append('table', 'admin_master_inquiry_type');
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
                            $("form[name='inquirytype']").removeClass("was-validated");
                            $("form[name='inquirytype']")[0].reset();
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
                        // list_data();
                    },
                });
            } else {
                $('.loader').hide();
                $("form[name='inquirytype']").addClass("was-validated");
            }
        });

        //edit inquiry data
        $("#master-inquiry-table").on('click', '.admin_master_inquiry_type_edt', function (e) {
            e.preventDefault();
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-edit_id");
            // alert("hi");
            // console.log(self);
            // console.log(edit_value);
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('MasterInformation_edit'); ?>",
                    data: {
                        action: 'edit',
                        edit_id: edit_value,
                        table: 'admin_master_inquiry_type'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        $("#admin_master_inquiry_type_view input[name=inquiry_details]").val(response[0].inquiry_details);
                        $('#inquirytype_update_btn').attr('data-edit_id', response[0].id);
                        $('#inquirytype_delete_btn').attr('data-delete_id', response[0].id);
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
        $("#admin_master_inquiry_type_view").on('click', '#inquirytype_delete_btn', function (e) {
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
                        table: 'admin_master_inquiry_type'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        // $(self).remove();
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

        // update inquiry data
        $("#admin_master_inquiry_type_view").on('click', '#inquirytype_update_btn', function (e) {
            e.preventDefault();
            var update_id = $(this).attr("data-edit_id");
            var inquirytype_update = $('#master_inquirytype_update_form #inquirytype_name').val();
            // console.log(inquirytype_update);
            if (update_id != "" && inquirytype_update != "") {
                var form = $("form[name='master_inquirytype_update_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'update');
                formdata.append('edit_id', update_id);
                formdata.append('table', 'admin_master_inquiry_type');
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
                            $("form[name='master_inquirytype_update_form']").removeClass("was-validated");
                            list_data();
                            $('.modal-close-btn').trigger('click');
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
                $("form[name='master_inquirytype_update_form']").addClass("was-validated");
                $("form[name='master_inquirytype_update_form']").find('.selectpicker').each(function () {
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