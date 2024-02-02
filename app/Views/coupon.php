<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
?>
<style>
    .coupon-class {
        background-color: #ff00004f;
        border-radius: 5px;
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1 d-flex align-items-center">
                    <i class="fa-solid fa-percent fa-fw"></i>
                    <h2>Manage Coupons</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#coupon_form" class="btn-primary-rounded" id="plus_btn">
                        <i class="bi bi-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <table class="subscription_list_data table main-table w-100" aria-describedby="example_info" id="project_sub_type_table">
                <thead>
                    <tr>
                        <th>
                            <span>Coupon Details</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-description" id="subscription_list">
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
                <div class="row_count_div col-xl-6 col-xxs-12">
                    <p id="row_count"></p>
                </div>
                <div class="clearfix  col-xl-6 col-xxs-12">
                    <ul class="inq_pagination justify-content-xl-end" id="inq_pagination">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="coupon_form" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form class="formsize needs-validation" name="coupon_master_insert" method="POST" novalidate="">
                <div class="modal-header">
                    <h1 class="modal-title">Add Coupon</h1>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body modal-body-secondery">
                        <div class="modal-body-card">
                            <div class="col-md-5 col-12">
                                <h6 class="modal-body-title">Product <sup class="validationn">*</sup></h6>
                                <div class="main-selectpicker">
                                    <select id="product_type" name="product_type" class="selectpicker form-control form-main main-control product_type" data-live-search="true" required="" tabindex="-98">
                                        <?php
                                        $type = json_decode($type, true);
                                        if (isset($type)) {
                                            foreach ($type as $type_key => $type_value) {
                                                echo '<option class="dropdown-item" value="' . $type_value["id"] . '">' . $type_value["product_name"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="align-items-end d-flex col-md-7 col-12">
                                <div class="col-md-8 col-12">
                                    <h6 class="modal-body-title">Coupon Name <sup class="validationn">*</sup></h6>
                                    <input type="text" class="form-control main-control" id="coupon_name" name="coupon_name" placeholder="Coupon" required="">
                                </div>
                                <div class="col-md-4 col-12 d-flex justify-content-start ms-2">
                                    <button type="button" class="btn-primary" id="coupon_generate" name="coupon_generate">Generate</button>
                                </div>
                            </div>
                            <div class="col-md-5 col-12">
                                <h6 class="modal-body-title">Offer Name<sup class="validationn">*</sup></h6>
                                <input type="text" class="form-control main-control" id="offer_name" name="offer_name" placeholder="offer" required="">
                            </div>
                            <div class="col-md-5 col-12">
                                <h6 class="modal-body-title">No of times the user can use <sup class="validationn">*</sup></h6>
                                <div class="main-selectpicker">
                                    <select id="coupon_type" name="coupon_type" class="selectpicker form-control form-main main-control coupon_type" data-live-search="true" required="" tabindex="-98">
                                        <option value="1">once</option>
                                        <option value="2">Multiple</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12 coupon-date">
                                <h6 class="modal-body-title">start Date <sup class="validationn">*</sup></h6>
                                <input type="text" name="start_date" id="start_date" class="form-control main-control start-date" placeholder="Select Date" required>
                            </div>
                            <div class="col-md-3 col-12 coupon-date">
                                <h6 class="modal-body-title">End Date <sup class="validationn">*</sup></h6>
                                <input type="text" name="end_date" id="end_date" class="form-control main-control end-date" placeholder="Select Date" required>
                            </div>
                            <div class="col-md-5 col-12">
                                <h6 class="modal-body-title">Coupon Value <sup class="validationn">*</sup></h6>
                                <!-- <div class="d-flex input-group"><input type="number" min="0.01" step="0.01" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" class="form-control main-control " id="coupon_value" name="coupon_value" placeholder="Coupon Value" required=""><span class="input-group-text" id="basic-addon2">%</span></div> -->
                                <div class="d-flex input-group"><input type="number" min="0.01" step="0.01"   class="form-control main-control " id="coupon_value" name="coupon_value" placeholder="Coupon Value" required=""><span class="input-group-text" id="basic-addon2">%</span></div>
                            </div>
                            <div class="col-md-4 col-12 mt-4">
                                <div class="hide_active pt-3">
                                    <div class="d-flex align-items-center ">
                                        <label class="switch_toggle_primary">
                                            <input class="toggle-checkbox showactive" type="checkbox" id="isactive" name="isactive">
                                            <span class="check_input_primary round"></span>
                                        </label>
                                        <p class="mx-2 fw-medium">Is Active?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12 mt-4 Show_Offer">
                                <div class="task_switch_button pt-3">
                                    <div class="d-flex align-items-center ">
                                        <label class="switch_toggle_primary">
                                            <input class="toggle-checkbox offerisactive" type="checkbox" id="offerisactive" name="offerisactive">
                                            <span class="check_input_primary round"></span>
                                        </label>
                                        <p class="mx-2 fw-medium">Show Offer? </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer2">
                    <button type="button" class="btn-primary coupon_setting_form" id="coupon_setting_update_btn" data-edit_id="" name="coupon_setting_form" value="project_subtype_update">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="master_coupon_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
        <div class="modal-content">
            <form class="needs-validation" name="project_update_form" method="POST" action="">
                <!-- modal-heading-start -->
                <div id="modal-code" class="modal-header modal-headerr pt-2 pb-2">
                    <div class="col-lg-11 col-md-11 col-sm-11 d-flex builder1 ">
                        <h6 class="aman  pt-1">Coupon View information</h6>
                    </div>
                    <div class=" col-lg-1 col-md-1 col-sm-1 buttons">
                        <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                    </div>
                </div>
                <!-- modal-heading-end -->
                <!-- mpdal-body-start -->
                <div class="modal-body modal-body-1 p-2" id="assign-pages">
                    <div class="row row-1">
                        <div class="col-xl-12">
                            <div class="body-main1 mb-0">
                                <div class="body_body">
                                    <div class="card  ps-2">
                                        <div class="row d-flex">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label class="form-label1">Product :</label>
                                                <span class="form-inform" id="product_name"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label class="form-label1">Coupon Name :</label>
                                                <span class="form-inform" id="coupon_name"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label class="form-label1">Offer Name :</label>
                                                <span class="form-inform" id="offer_name"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label class="form-label1">Type :</label>
                                                <span class="form-inform" id="coupon_type"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 show-dates">
                                                <label class="form-label1">Start Date :</label>
                                                <span class="form-inform" id="start_date"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 show-dates">
                                                <label class="form-label1">End Date:</label>
                                                <span class="form-inform" id="end_date"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label class="form-label1">Discount :</label>
                                                <span class="form-inform" id="coupon_value"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label class="form-label1">Is Active? :</label>
                                                <span class="form-inform" id="isactive"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 Show_Offer">
                                                <label class="form-label1">Show Offer? :</label>
                                                <span class="form-inform" id="isoffer"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- project-details-end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer2">
                    <?php if (in_array('subscription_management_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <!-- <a href="#" class="btn-primary-rounded edt"><i class="fas fa-pencil-alt" data-edit_id="" data-bs-toggle="modal" data-bs-target="#coupon_form"></i></a> -->
                        <span class="btn-secondary-rounded  edt" data-edit_id="" data-bs-toggle="modal" data-bs-target="#coupon_form"><i class="fas fa-pencil-alt fs-14"></i></span>
                    <?php } ?>
                    <?php if (in_array('subscription_management_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <div class="delete_main">
                            <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                            <div class="btn-secondary px-3 dlt" data-delete_id="">Really?</div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<script>
    $(document).ready(function() {
        $(".Show_Offer").hide();
        $('.coupon-date').hide();
        $('.start-date').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY',
            time: false,
            clearButton: true
        }).on('change', function(e, date) {
            $('.end-date').bootstrapMaterialDatePicker('setMinDate', date);
        });

        $('.end-date').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY',
            time: false,
            clearButton: true
        });

        // $('#coupon_value').on('input', function() {
        //     var inputValue = $(this).val();
        //     if (inputValue.indexOf('.') !== -1) {
        //         // Check if the input contains a decimal point
        //         $('#validation-message').text('Please enter a percentage value, not a point value.');
        //         $(this).val(''); // Clear the input
        //     } else {
        //         $('#validation-message').text('');
        //     }
        // });

        $('body').on('change', '.coupon_type', function(e) {
            $('.coupon-date').hide();
            if ($('#coupon_type :selected').val() == 2) {
                $('.coupon-date').show();
            }
        });
        $('body').on('click', '#coupon_generate', function(e) {
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('generate_couponname'); ?>",
                data: {
                    table: 'master_coupon'
                },
                success: function(res) {
                    $('.loader').hide();
                    $('#coupon_name').val(res);
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
        });

        $('.modal-close-btn').click(function() {
            $('form[name="coupon_master_insert"]')[0].reset();
            $('.selectpicker').selectpicker('refresh');
            $("form[name='coupon_master_insert']").removeClass("was-validated");
        });

        list_data();

        $('body').on('click', '.master_coupon_view', function(e) {
            e.preventDefault();
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-view_id");
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('master_coupon_view'); ?>",
                    data: {
                        action: 'view',
                        view_id: edit_value,
                        table: 'master_coupon'
                    },
                    success: function(res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        $('.edt').attr('data-edit_id', response[0].id);
                        $('.dlt').attr('data-delete_id', response[0].id);
                        if (response[0].coupon_type == 1) {
                            var type = 'Once';
                            $('.show-dates').hide();
                        }
                        if (response[0].coupon_type == 2) {
                            var type = 'Multiple';
                            $('.show-dates').show();
                            $('#master_coupon_view #start_date').text(response.start_formated_date);
                            $('#master_coupon_view #end_date').text(response.end_formated_date);
                        }
                        $('#master_coupon_view #product_name').text(response['product'][0].product_name);
                        $('#master_coupon_view #coupon_name').text(response[0].coupon_name);
                        $('#master_coupon_view #coupon_type').text(type);
                        $('#master_coupon_view #coupon_value').text(response[0].coupon_value + '%');
                        $('#master_coupon_view #offer_name').text(response[0].offer_name);
                        if (response[0].isactive == 1) {
                            var isactive = 'Yes';
                        } else {
                            var isactive = 'No';
                        }
                        $('#master_coupon_view #isactive ').text(isactive);
                        if (response[0].offerisactive == 1) {
                            
                            var offerisactive = 'Yes';
                        } else {
                            var offerisactive = 'NO ';
                        }
                        $('#master_coupon_view #isoffer ').text(offerisactive);

                        console.log(edit_value);
                        if (edit_value == "11" || edit_value == "12" || edit_value == "13") //static if for realtosmart, Lead,Gym -> offer show in website
                        {
                            $(".delete_main").hide();
                            $(".Show_Offer").show();
                        }else{
                            $(".delete_main").show();
                            $(".Show_Offer").hide();
                        }

                    },
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });

        $('body').on('click', '.edt', function(e) {
            e.preventDefault();
            $('.selectpicker').selectpicker('refresh');
            $('.hide_active').show();

            var self = $(this).closest("tr");
            $('.modal-close-btn').click(function() {
                $('#coupon_form  .coupon_setting_form').attr("data-edit_id", '');
            });
            var edit_value = $(this).attr("data-edit_id");
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('master_coupon_edit'); ?>",
                    data: {
                        action: 'edit',
                        edit_id: edit_value,
                        table: 'master_coupon'
                    },
                    success: function(res) {
                        $('.loader').hide();
                        $('.selectpicker').selectpicker('refresh');
                        var response = JSON.parse(res);
                        $('.dlt').attr('data-delete_id', response.id);
                        $('#coupon_setting_update_btn').attr('data-edit_id', response[0].id);
                        $('#coupon_form #coupon_name').val(response[0].coupon_name);
                        // $('#coupon_name').prop('disabled', true);
                        $('#coupon_form #product_type').val(response[0].product_type);
                        $('#coupon_form #coupon_type').val(response[0].coupon_type);
                        $('#coupon_form #coupon_value').val(response[0].coupon_value);
                        $('#coupon_form #offer_name').val(response[0].offer_name);
                        $('#coupon_generate').hide();
                        if (response[0].coupon_type == 1) {
                            $('.coupon-date').hide();
                        } else {
                            $('.coupon-date').show();
                            dateString1 = response[0].start_date;
                            var parts1 = dateString1.split(' ');
                            var datePart1 = parts1[0];
                            var dateComponents = datePart1.split('-');
                            var year1 = dateComponents[0];
                            var month1 = dateComponents[1];
                            var day1 = dateComponents[2];
                            var monthly_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ';

                            dateString2 = response[0].end_date;
                            var parts2 = dateString2.split(' ');
                            var datePart2 = parts2[0];
                            var dateComponents = datePart2.split('-');
                            var year2 = dateComponents[0];
                            var month2 = dateComponents[1];
                            var day2 = dateComponents[2];
                            var yearly_dateFormat = day2 + '-' + month2 + '-' + year2 + ' ';
                            $('#coupon_form #start_date').val(monthly_dateFormat);
                            $('#coupon_form #end_date').val(yearly_dateFormat);
                        }

                        if (response[0].isactive == 1) {
                            $("#isactive").prop("checked", true);

                        } else {
                            $("#isactive").prop("checked", false);
                        }
                        if (response[0].offerisactive == 1) {
                            
                            $("#offerisactive").prop("checked", true);

                        } else {
                            $("#offerisactive").prop("checked", false);
                        }
                        $('.selectpicker').selectpicker('refresh');



                    },
                    error: function(error) {
                        $('.loader').hide();
                    }
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });
        // delete data 
        $('body').on('click', '.dlt', function(e) {
            e.preventDefault();
            var self = $(this).closest("tr");
            var id = $(this).attr('data-delete_id');
            console.log(id);
            if (id != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('master_subscribtion_delete'); ?>",
                    data: {
                        action: 'delete',
                        del_id: id,
                        table: 'master_coupon'
                    },
                    success: function(res) {
                        $('.loader').hide();
                        $(".modal-close-btn").trigger("click");
                        list_data();
                        iziToast.delete({
                            title: 'Delete successfully'
                        });
                    },
                    error: function(error) {
                        $('.loader').hide();
                    }
                });
            }
        });

        $('body').on('click', '#coupon_form .modal-close-btn', function(e) {
            $("#master_coupon_view .modal-close-btn").trigger("click");
        });
    });

    $('body').on('click', '#plus_btn', function(e) {
        $("form[name='coupon_master_insert']")[0].reset();
        $('.selectpicker').selectpicker('refresh');
        $('.coupon-date').hide();
        $('#coupon_generate').show();
        $('#coupon_name').prop('disabled', false);
        $('.hide_active').hide();
        $("form[name='coupon_master_insert']").removeClass("was-validated");
    });
    $('body').on('click', '.coupon_setting_form', function(e) {
        e.preventDefault();
        var coupon_name = $("#coupon_name").val();
        var coupon_type = $("#coupon_type").val();
        var coupon_value = $("#coupon_value").val();
        var offer_name = $("#offer_name").val();
        var is_active = "";
        if ($('#isactive').is(':checked')) {
            is_active = 1;
        } else {
            is_active = 0;
        }
        var offerisactive = "";
        if ($('.offerisactive').is(':checked')) {
            offerisactive = 1;

        } else {
            offerisactive = 0;

        }

        var edit_id = $('#coupon_form #coupon_setting_update_btn').attr("data-edit_id");
        if (coupon_name != "" && coupon_type != "" && coupon_value != "" && offer_name != "") {
            var form = $("form[name='coupon_master_insert']")[0];
            var formdata = new FormData(form);

            if (edit_id == '') {

                // formdata.append('is_active', is_active);
                formdata.append('offerisactive', offerisactive);
                formdata.append('table', 'master_coupon');
                formdata.append('action', 'insert');
                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('coupon_master_insert'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res != "error") {
                            $('.loader').hide();
                            list_data();
                            $("form[name='coupon_master_insert']")[0].reset();
                            $(".modal-close-btn").trigger("click");
                            $("form[name='coupon_master_insert']").removeClass("was-validated");
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                        } else {
                            $('.loader').hide();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                        }
                    },
                });
            } else {
                var formdata = new FormData(form);
                formdata.append('offerisactive', offerisactive);
                formdata.append('is_active', is_active);
                formdata.append('action', 'update');
                formdata.append('edit_id', edit_id);
                formdata.append('table', 'master_coupon');
                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('master_coupon_update'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res != "error") {
                            $('.loader').hide();
                            list_data();
                            $("form[name='coupon_master_insert']").removeClass("was-validated");
                            $('.btn-close').click(function() {
                                $('form[name="coupon_master_insert"]')[0].reset();
                            });
                            $(this).attr('data-edit_id', "");
                            $('#coupon_form #coupon_setting_update_btn').attr("data-edit_id", '');
                            $(".modal-close-btn").trigger("click");
                            iziToast.success({
                                title: 'Updated Successfully'
                            });
                        } else {
                            $('.loader').hide();
                            Swal.fire({
                                title: 'Cancelled',
                                text: 'Duplicate Data Not Valid',
                                icon: 'error',
                            })
                        }
                    },
                    error: function(error) {}
                });
            }
        } else {
            $("form[name='coupon_master_insert']").addClass("was-validated");
            var form = $("form[name='coupon_master_insert']");
            $(form).find('.selectpicker').each(function() {
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
        return false;
    });

    function list_data(table = 'master_coupon', datastatus = '', pageNumber = 1, perPageCount = 10, ajaxsearch = "", filter = "", formdata = "", action = true) {
        var perPageCount = $('#perPageCount').val();

        if ($.trim($(".filter-show").html()) == '') {
            var data = {
                'table': table,
                'pageNumber': pageNumber,
                'perPageCount': perPageCount,
                'action': action,
            };
            var processdd = true;
            var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
        } else {
            formdata.append('pageNumber', pageNumber);
            formdata.append('perPageCount', perPageCount);
            var data = formdata;
            var processdd = false;
            var contentType = false;
        }
        $.ajax({
            datatype: 'json',
            method: "POST",
            url: 'master_coupon_list',
            data: data,
            processData: processdd,
            contentType: contentType,
            success: function(res) {
                var result = JSON.parse(res);
                if (result.response == 1) {
                    if (result.total_page == 0 || result.total_page == '') {
                        total_page = 1;
                    } else {
                        total_page = result.total_page;
                    }
                    $('#row_count').html(result.row_count_html);
                    $('#subscription_list').html(result.html);
                    $('.inq_pagination').twbsPagination({
                        totalPages: total_page,
                        visiblePages: 4,
                        next: '>>',
                        prev: '<<',
                        onPageClick: function(event, page) {
                            list_data(table, datastatus, page, perPageCount, ajaxsearch);
                        }
                    });
                }
            }
        });
        <?php
        if (isset($_GET) && !empty($_GET)) { ?>
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'filter')) { ?>
                $('.inq_pagination').twbsPagination('destroy');
            <?php } ?>
        <?php
        } ?>
    }
</script>