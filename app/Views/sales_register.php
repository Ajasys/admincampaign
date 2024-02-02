<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
?>


<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="title-1 d-flex align-items-center">
                    <i class="bi bi-file-break-fill me-2"></i>
                    <h2>Sale</h2>
                </div>
                <div class="d-flex align-items-center">
                    <?php if (in_array('sales_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <div id="deleted-all" class="mx-1">
                            <span class="btn-primary-rounded elevation_add_button">
                                <i class="bi bi-trash3 fs-14"></i>
                            </span>
                        </div>
                    <?php } ?>
                    <div class="btn-primary-rounded elevation_add_button" data-bs-toggle="modal"
                        data-bs-target="#sale-add" data-bs-dismiss="modal" data-delete_id="">
                        <i class="bi bi-plus"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2">
            <table id="user_table"
                class="table main-table w-100">
                <thead>
                    <tr>
                        <th>
                            <input class="check_box" type="checkbox" id="select-all" />
                        </th>
                        <th>
                            <span>User</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd">
                        <td class="t-check dtr-control sorting_1 align-middle" tabindex="0">
                            <input class="checkbox mx-3 mt-2 cstm-check" type="checkbox">
                        </td>
                        <td class="">
                            <div class=" px-0 py-0 w-100" <?php if (in_array('sales_information_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>data-bs-toggle="modal" data-bs-target="#sale-edit" <?php } ?>>
                                <div
                                    class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">

                                    <div class="col">
                                        <b>Name :</b>
                                        <span class="mx-2">Radha</span>
                                    </div>
                                    <div class="col">
                                        <b>Date :</b>
                                        <span class="mx-2">01/01/2023</span>
                                    </div>
                                    <div class="col">
                                        <b>Mobile No. :</b>
                                        <span class="mx-2">9673097097</span>
                                    </div>
                                    <div class="col">
                                        <b>Membership :</b>
                                        <span class="mx-2">core</span>
                                    </div>

                                    <div class="col">
                                        <b>SGST 2.5% :</b>
                                        <span class="mx-2">12.98</span>
                                    </div>
                                    <div class="col">
                                        <b>CGST 2.5% :</b>
                                        <span class="mx-2">12.98</span>
                                    </div>
                                    <div class="col">
                                        <b>Amount :</b>
                                        <span class="mx-2">545.00</span>
                                    </div>
                                    <div class="col">
                                        <b>Discount :</b>
                                        <span class="mx-2">0.00</span>
                                    </div>
                                    <div class="col">
                                        <b>Net Amt :</b>
                                        <span class="mx-2">545.00</span>
                                    </div>
                                    <div class="col">
                                        <b>Pay Amt :</b>
                                        <span class="mx-2">0.00</span>
                                    </div>
                                    <div class="col">
                                        <b>Remain Amt :</b>
                                        <span class="mx-2">545.00</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="sale-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 text-bold" id="exampleModalLabel">sale register</h2>
                <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body modal-body-secondery">
                <h6 class="modal-body-title">Enter detail</h6>
                <div class="modal-body-card">
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Bill no <sup class="validationn">*</sup></label>
                            <input type="text" minlength="10" maxlength="10"
                                class="form-control main-control number_value_only" id="phone" name="phone"
                                placeholder="Bill No." value="" data-phone_id="" required="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="dob" class="">start Date :</label>
                            <div class="custom_Date_class">
                                <input type="text" id="" name=""
                                    class="dob s-date form-control main-control input_count dob" data-dtp="dtp_pj3Xv"
                                    placeholder="DD/MM/YY">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="dob" class="">End Date :</label>
                            <div class="custom_Date_class">
                                <input type="text" id="" name=""
                                    class="dob e-date form-control main-control input_count dob" data-dtp="dtp_pj3Xv"
                                    placeholder="DD/MM/YY">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Customer Name <sup class="validationn">*</sup></label>
                            <input type="text" id="firstname" name="firstname" class="form-control main-control"
                                placeholder="Name" value="" data-firstname_id="" required="">
                        </div>
                    </div>

                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Mobile No<sup class="validationn">*</sup></label>
                            <input type="text" id="firstname" name="firstname" class="form-control main-control"
                                placeholder="Mobile no" value="" data-firstname_id="" required="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">site name<sup class="validationn">*</sup></label>
                            <input type="text" id="firstname" name="firstname" class="form-control main-control"
                                placeholder="site name" value="" data-firstname_id="" required="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">SGST<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="SGST" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">CGST<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="CGST" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Amount<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="Amount" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Discoun<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="discoun" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Net Amt <sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="Net Amt " name="department"
                                placeholder="discoun" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Pay Amt <sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="pay amt " disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Remain Amt<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="remain amt" disabled="" data-department_id="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer2">
                    <div class="col-lg-12 d-flex justify-content-end mt-2 pe-2 user-btn-view">
                        <input type="hidden" id="">
                        <button data-edit_id="" type="submit" class="user-submit  btn-primary" name="add_new_user_btn"
                            id="add_new_user_btn"> submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sale-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 text-bold" id="exampleModalLabel">sale register</h2>
                <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body modal-body-secondery">
                <h6 class="modal-body-title">Enter detail</h6>
                <div class="modal-body-card">
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Bill no <sup class="validationn">*</sup></label>
                            <input type="text" minlength="10" maxlength="10"
                                class="form-control main-control number_value_only" id="phone" name="phone"
                                placeholder="Bill No." value="" data-phone_id="" required="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="dob" class="">start Date :</label>
                            <div class="custom_Date_class">
                                <input type="text" id="" name=""
                                    class="dob s-date form-control main-control input_count dob" data-dtp="dtp_pj3Xv"
                                    placeholder="DD/MM/YY">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="dob" class="">End Date :</label>
                            <div class="custom_Date_class">
                                <input type="text" id="" name=""
                                    class="dob e-date form-control main-control input_count dob" data-dtp="dtp_pj3Xv"
                                    placeholder="DD/MM/YY">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Customer Name <sup class="validationn">*</sup></label>
                            <input type="text" id="firstname" name="firstname" class="form-control main-control"
                                placeholder="Name" value="" data-firstname_id="" required="">
                        </div>
                    </div>

                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Mobile No<sup class="validationn">*</sup></label>
                            <input type="text" id="firstname" name="firstname" class="form-control main-control"
                                placeholder="Mobile no" value="" data-firstname_id="" required="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">site name<sup class="validationn">*</sup></label>
                            <input type="text" id="firstname" name="firstname" class="form-control main-control"
                                placeholder="site name" value="" data-firstname_id="" required="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">SGST<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="SGST" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">CGST<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="CGST" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Amount<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="Amount" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Discoun<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="discoun" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Net Amt <sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="Net Amt " name="department"
                                placeholder="discoun" disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Pay Amt <sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="pay amt " disabled="" data-department_id="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-12 col-md-4 col-sm-6">
                        <div class="add-user-input">
                            <label for="">Remain Amt<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control" id="department" name="department"
                                placeholder="remain amt" disabled="" data-department_id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer2">
                <button data-edit_id="" type="submit" class="user-submit btn-primary" name="add_new_user_btn"
                    id="add_new_user_btn"> update</button>
                <?php if (in_array('sales_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                    <div class="delete_main me-0" href="javascript:void(0)">
                        <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                        <div class="btn-secondary px-3 dlt" data-delete_id="2">Really ?</div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>





<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>



<script>
    $(document).ready(function () {
        $("#deleted-all").hide();
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
                                    table: '',
                                },
                                success: function (data) {
                                    //  console.log(data);
                                    $(checkbox).closest("tr").fadeOut();
                                    // $('.removeRow').fadeOut(1500);
                                    list_data('admin_user', '', '', project_length_show);
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

        $('.user-tables').DataTable();
        $(".s-date ").bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'DD/MM/YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });
        $(".e-date").bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'DD/MM/YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });
        function checkIfAnyCheckboxChecked(inputid, deletebtn) {
            if ($(inputid + ':checked').length > 0) {
                // alert();
                deletebtn.show();
            } else {
                // alert();
                deletebtn.hide();
            }
        }

        $('#deleteButton').hide();
        $(".user-table").on('click', 'input[type="checkbox"]', function () {
            var deletebtn = $("#deleteButton");
            var input = ".cstm-check";
            checkIfAnyCheckboxChecked(input, deletebtn);

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