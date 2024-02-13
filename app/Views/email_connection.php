<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$db_connection = \Config\Database::connect('second');
$query90 = "SELECT * FROM admin_platform_integration WHERE master_id = '" . $_SESSION['master'] . "'";
$result = $db_connection->query($query90);
$total_dataa_userr_22 = $result->getResult();
if (isset($total_dataa_userr_22[0])) {
    $settings_data = get_object_vars($total_dataa_userr_22[0]);
} else {
    $settings_data = array();
}


?>
<style>
    .pass-icon {
        position: absolute;
        top: 60%;
        transform: translateY(-50%);
        right: 47px;
        top: 20px;
        cursor: pointer;
    }
    .avatar-edit-pen{
        right: 22%!important;
        z-index: 1!important;
        bottom: 29px!important;
    }
</style>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="title-1">
                <i class="bi bi-gear-fill d-flex"></i>
                <h2>General Settings</h2>
            </div>
            <ul class="nav nav-pills navtab_primary_sm nav_item mb-3 mt-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button id="pills-Email-tab active" class="fw-medium" data-bs-toggle="pill" data-bs-target="#Email-Settings" type="button" role="tab" aria-controls="pills-Email" aria-selected="false" >Email Settings</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="Email-Settings" role="tabpanel" aria-labelledby="pills-Email-tab" tabindex="0">
                    <form class="needs-validation" name="email_update_form" method="POST" novalidate>
                        <div class="bg-white border rounded-2 p-3 general_settings_editsss general_email_settings_outer">
                            <div class="row col-10 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                                <div class="position-absolute" style="left: -5px">
                                    <input type="radio" class="email_radio" value="2" id="email_radio_2" name="email_radio" >
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                        <label for="form-port" class="form-label main-label">SMTP Port </label>
                                    <input type="text" name="smtp_port" id="smtp_port" class="form-control main-control" value="<?php if (isset($settings_data['smtp_port']) && $settings_data['smtp_port'] != '') {
                                        echo $settings_data['smtp_port'];
                                    } ?>" placeholder="Enter SMTP Port" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-host" class="form-label main-label">SMTP Host </label>
                                    <input type="text" name="smtp_host" id="smtp_host" class="form-control main-control" value="<?php if (isset($settings_data['smtp_host']) && $settings_data['smtp_host'] != '') {
                                        echo $settings_data['smtp_host'];
                                    } ?>" placeholder="Enter SMTP Host" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-user" class="form-label main-label">SMTP User </label>
                                    <input type="text" name="smtp_user" id="smtp_user" class="form-control main-control" value="<?php if (isset($settings_data['smtp_user']) && $settings_data['smtp_user'] != '') {
                                        echo $settings_data['smtp_user'];
                                    } ?>" placeholder="Enter SMTP User" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-status password" class="form-label main-label">SMTP Password
                                    </label>
                                    <input type="password" name="smtp_password" id="smtp_password" class="form-control main-control" value="<?php if (isset($settings_data['smtp_password']) && $settings_data['smtp_password'] != '') {
                                        echo $settings_data['smtp_password'];
                                    } ?>" placeholder="Enter SMTP Password" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-crypto" class="form-label main-label">SMTP Crypto </label>
                                    <input type="text" name="smtp_crypto" id="smtp_crypto" class="form-control main-control" value="<?php if (isset($settings_data['smtp_crypto']) && $settings_data['smtp_crypto'] != '') {
                                        echo $settings_data['smtp_crypto'];
                                    } ?>" placeholder="Enter SMTP Crypto" />
                                </div>
                            </div>
                            <div class="row col-10 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                                <div class="position-absolute" style="left: -5px">
                                    <input type="radio" class="email_radio" id="email_radio_1" value="1" checked name="email_radio">
                                </div>
                                <div class="col-sm-6 col-12 input-text">
                                    <label for="form-port" class="form-label main-label">From Email</label>
                                    <input type="email" name="email_from" id="email_from" class="form-control main-control emailsss" value="<?php if (isset($settings_data['email_from']) && $settings_data['email_from'] != '') {
                                        echo $settings_data['email_from'];
                                    } ?>" required="" placeholder="Enter From Email" />
                                    <div class="email-errorsss">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-10 ps-3 m-0 py-3">
    
                                <div class="col-sm-6 col-12 input-text">
                                    <label for="form-cc" class="form-label main-label">CC</label>
                                    <input type="email" name="mail_cc" id="mail_cc" class="form-control main-control email" value="<?php if (isset($settings_data['mail_cc']) && $settings_data['mail_cc'] != '') {
                                        echo $settings_data['mail_cc'];
                                    } ?>" placeholder="Enter CC" />
                                </div>
                            </div>
                            <div class="general_settings_edit_outer px-2 mx-1">
                                <div class="title-side-icons mt-2 align-items-center justify-content-end">
                                    <div class="avatar-edit-outer m-0">
                                        <div class="btn-primary general_settings_main_email">
                                            Edit
                                        </div>
                                    </div>
                                    <button type="button" class="btn-primary email_updatees" data-edit_id="" name="notes" value="notes">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>

<script>


    $('body').on('click', '.email_radio', function() {
        $(".general_email_settings_inner .input-text").addClass("opacity-50 pointer-event-none");
        $(this).closest(".general_email_settings_inner").find(".input-text").removeClass("opacity-50 pointer-event-none");
    });
    
    $(".email_radio").each(function () {
        if ($(this).is(":checked")) {
            $(".general_email_settings_inner .input-text").addClass("opacity-50 pointer-event-none");
            $(this).closest(".general_email_settings_inner").find(".input-text").removeClass("opacity-50 pointer-event-none");
        };
    });

  
  

    
  

    
    
    $('body').on('click', '.update900', function() {
        $(".general_settings_main").show();
    });
    $('body').on('click', '.general_settings_main_edit', function() {
        $(".general_settings_main .main-control").removeAttr("disabled");
        $(".update900").show();
        $(this).hide();
    });


    <?php if (isset($settings_data['master_id'])) { ?>
            $(".general_settings_main .avatar-edit-outer").show();
            $(".update900").hide();
            $(".update900").text("update");
            $(".general_settings_main .main-control").attr("disabled", "");
    <?php } else { ?>
            $(".update900").hide();
            $(".update900").show();
    <?php } ?>



    // $('body').on('click', '.email_update', function() {
    //     $(".general_settings_editsss").show();
    // });
    // $('body').on('click', '.general_settings_main_emails', function() {
    //     $(".general_settings_editsss .main-control").removeAttr("disabled");
    //     $(".email_update").show();
    //     $(this).hide();
    // });

    // <?php if (empty($settings_data['smtp_port']) && empty($settings_data['smtp_host']) && empty($settings_data['smtp_user']) && empty($settings_data['smtp_password']) && empty($settings_data['smtp_crypto']) && empty($settings_data['from_email']) ) { ?>
    //         $('.check').prop('checked', false);
    //         $(".general_settings_editsss .avatar-edit-outer").hide();
    //         $(".email_update").show();
    // <?php } else { ?>
    //     $('.check').prop('checked', true);
    //     $(".general_settings_editsss .avatar-edit-outer").show();
    //     $(".email_update").hide();
    //     $(".email_update").text("update");
    //     $(".general_settings_editsss .main-control").attr("disabled", "");
    // <?php } ?>


    $('body').on('click', '.email_updatees', function() {
        $(".general_settings_editsss").show();
    });
    $('body').on('click', '.general_settings_main_email', function() {
        $(".general_settings_editsss .main-control").removeAttr("disabled");
        $(".email_updatees").show();
        $(this).hide();
    });

    <?php if (empty($settings_data['email_from']) || empty($settings_data['smtp_port']) && empty($settings_data['smtp_host']) && empty($settings_data['smtp_user']) && empty($settings_data['smtp_password']) && empty($settings_data['smtp_crypto']) && empty($settings_data['from_email'])) { ?>
            // $('.checking').prop('checked', false);
            $(".general_settings_editsss .avatar-edit-outer").hide();
            $(".email_updatees ").show();
    <?php } else { ?>
            // $('.checking').prop('checked', true);
            $(".general_settings_editsss .avatar-edit-outer").show();
            $(".email_updatees ").hide();
            $(".email_updatees ").text("update");
            $(".general_settings_editsss .main-control").attr("disabled", "");
    <?php } ?>



    $('body').on('click', '.sms-update', function() {
        $(".general_settings_sms").show();
    });
    $('body').on('click', '.general_settings_main_sms', function() {
        $(".general_settings_sms .main-control").removeAttr("disabled");
        $(".sms-update").show();
        $(this).hide();
    });
    <?php
    // Check if any of the fields is empty or undefined
    if (
        empty($settings_data['sms_api']) &&
        empty($settings_data['sms_phone']) &&
        empty($settings_data['sms_sender'])
    ) { ?>
            $(".general_settings_main_sms").hide();
            $(".sms-update ").show();
    <?php } else { ?>
            $(".general_settings_main_sms").show();
            $(".sms-update").hide();
            $(".sms-update").text("update");
            $(".general_settings_sms .main-control").attr("disabled", "");
    <?php } ?>


    $('body').on('click', '.whatsapp_api_btn', function() {
        $(".general_settings_whatsapp").show();
    });
    $('body').on('click', '.general_settings_main_whatsapp', function() {
        $(".general_settings_whatsapp .main-control").removeAttr("disabled");
        $(".whatsapp_api_btn").show();
        $(this).hide();
    });
    <?php
    if (empty($settings_data12['api']) && empty($settings_data['whatsapp_access_token'])) { ?>
            $(".general_settings_whatsapp .avatar-edit-outer").hide();
            $(".whatsapp_api_btn ").show();
    <?php } else { ?>
            $(".general_settings_whatsapp .avatar-edit-outer").show();
            $(".whatsapp_api_btn").hide();
            $(".whatsapp_api_btn").text("update");
            $(".general_settings_whatsapp .main-control").attr("disabled", "");
    <?php } ?>

    $('body').on('click', '.invoice-add', function() {
        $(".general_settings_invoices").show();
    });
    $('body').on('click', '.general_settings_main_invoices', function() {
        $(".general_settings_invoices .main-control").removeAttr("disabled");
        $(".invoice-add").show();
        $(this).hide();
    });
    <?php
    if (
        empty($settings_data['invoice_prefix']) &&
        empty($settings_data['bank_name']) &&
        empty($settings_data['account_no']) &&
        empty($settings_data['terms']) &&
        empty($settings_data['ifsc_code']) &&
        empty($settings_data['invoice_signature'])
    ) { ?>
            $(".general_settings_invoices .avatar-edit-outer").hide();
            $(".invoice-add").show();
    <?php } else { ?>
            $(".general_settings_invoices .avatar-edit-outer").show();
            $(".invoice-add").hide();
            $(".invoice-add").text("update");
            $(".general_settings_invoices .main-control").attr("disabled", "");
    <?php } ?>


    $('body').on('click', '.quotation_editor', function() {
        $(".general_settings_quotation").show();
    });
    $('body').on('click', '.general_settings_main_quotation', function() {
        $(".general_settings_quotation .quot_details , .general_settings_quotation .paymentt_details , .general_settings_quotation .tearms_details").removeClass("opacity-50 pointer-event-none");
        $(".quotation_editor").show();
        $(this).hide();
    });
    <?php
    if (
        empty($settings_data['quotation_detail']) &&
        empty($settings_data['payment_detail']) &&
        empty($settings_data['terms_condition'])
    ) { ?>

            $(".general_settings_quotation .avatar-edit-outer").hide();
            $(".quotation_editor").show();
    <?php } else { ?>
            $(".general_settings_quotation .avatar-edit-outer").show();
            $(".quotation_editor").hide();
            $(".quotation_editor").text("update");
            $(".general_settings_quotation .quot_details , .general_settings_quotation .paymentt_details , .general_settings_quotation .tearms_details").addClass("opacity-50 pointer-event-none");

    <?php } ?>

    


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#im-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readInvoiceURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#invoice_sig_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#company_logo").change(function() {
        readURL(this);
    });
    $("#invoice_signature").change(function() {
        readInvoiceURL(this);
    });
    $('input[type="checkbox"]').on('change', function() {
        if (this.checked) {
            $(this).val(1);
            $(this).attr('data-id', 1);
        } else {
            $(this).val(0);
            $(this).attr('data-id', 0);
        }
    });
    $('body').on('click', '.update900', function(e) {
        var form = $('form[name="general_settings_update"]')[0];
        // alert();
        e.preventDefault();

        InsertData(form);

        $(".update900").hide();
        $(".update900").text("update");
        $(".general_settings_main .main-control").attr("disabled", "");
        $(".general_settings_main_edit").show();

    });
    $('body').on('click', '.updatesss', function(e) {
        // alert('mital');
        e.preventDefault();
        var form = $('form[name="general_settings_update"]')[0];

        InsertData(form);

    });
    // $('body').on('click', '.email_update', function(e) {
    //     // alert('mital');
    //     e.preventDefault();
    //     var email_radio = $(".email_radio:checked").val();
    //     $(".email_update").val();
    //     var form = $('form[name="email_update_form"]')[0];
    //     InsertData(form);
    //     $(".general_settings_main_emails").show();
    //     $('.check').prop('checked', true);
    //     $(".email_update").hide();
    //     $(".email_update").text("update");
    //     $(".general_settings_editsss .main-control").attr("disabled", "");
    // });

    $('body').on('click', '.email_updatees', function(e) {
        alert('dfsdf');
        e.preventDefault();
        var email_radio = $(".email_radio:checked").val();
        var form = $('form[name="email_update_form"]')[0];
        InsertData(form);
        $('.checking').prop('checked', true);
        $(".general_settings_main_email").show();
        $(".email_updatees").hide();
        $(".email_updatees").text("update");
        $(".general_settings_editsss .main-control").attr("disabled", "");
    });

    $('body').on('click', '.email_update', function(e) {
        // alert('mital');
        e.preventDefault();
        var form = $('form[name="email_update_form"]')[0];
        InsertData(form);
        $('.checking').prop('checked', true);
        $(".general_settings_editsss .avatar-edit-outer").show();
        $(".email_update").hide();
        $(".email_update").text("update");
        $(".general_settings_editsss .main-control").attr("disabled", "");
    });


    $('body').on('click', '.sms-update', function(e) {
        e.preventDefault();
        var form = $('form[name="SMS_update_form"]')[0];
        InsertData(form);
        $(".general_settings_main_sms").show();
        $(".sms-update").hide();
        $(".sms-update").text("update");
        $(".general_settings_sms .main-control").attr("disabled", "");
    });



    $('body').on('click', '.invoice-add', function(e) {
        e.preventDefault();
        var form = $('form[name="invoice_from"]')[0];
        InsertData(form);
        $(".general_settings_invoices .avatar-edit-outer").show();
        $(".invoice-add").hide();
        $(".invoice-add").text("update");
        $(".general_settings_invoices .main-control").attr("disabled", "");
    });

    $('body').on('change', '.email', function() {
        var val = $(this).val();
        var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
        if (emailRegex.test(val)) {
            $('.email-error').html('');
        } else {
            $('.email-error').html('<p>Enter Valid Email</p>');
            $('.email-error').css('color', 'red');
        }
    });
    $('body').on('change', '.emailsss', function() {
        var val = $(this).val();
        var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
        if (emailRegex.test(val)) {
            $('.email-errorsss').html('');
        } else {
            $('.email-errorsss').html('<p>Enter Valid Email</p>');
            $('.email-errorsss').css('color', 'red');
        }
    });
    $('body').on('change', '.email_company', function() {
        var val = $(this).val();
        var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
        if (emailRegex.test(val)) {
            $('.email-error').html('');
        } else {
            $('.email-errors').html('<p>Enter Valid Email</p>');
            $('.email-errors').css('color', 'red');
        }
    });

    // function editModel() {
    //     var update_id = <?php echo $_SESSION['master']; ?>;

    //     $.ajax({
    //         method: "POST",
    //         url: 'edit_genralsetting_quotation',
    //         data: {
    //             table: 'master_general_settings',
    //             action: 'edit',
    //             update_id: update_id,

    //         },
    //         success: function(data) {
    //             var response = JSON.parse(data);
    //             // console.log(response[0].quotation_detail);
    //             // var ckeditorInstance = CKEDITOR.quotation_detail;
    //             // ckeditorInstance.setData(response[0].quotation_detail);.
    //             quotation_detail.setData(response[0].quotation_detail);
    //             payment_detail.setData(response[0].payment_detail);
    //             terms_detail.setData(response[0].terms_condition);



    //         },
    //     });
    // }
    // editModel();
    $('body').on('click', '.quotation_editor', function() {
        var description = $('.quot_details .ck-content').html();
        var update_id = <?php echo $_SESSION['master']; ?>;

        const editorContent = quotation_detail.getData();
        if (editorContent == '') {
            quotation_detail.ui.view.editable.element.style.border = '2px solid red';
        } else {
            quotation_detail.ui.view.editable.element.style.border = 'none';
        }
        var paymentt_details = $('.paymentt_details .ck-content').html();
        var tearms_details = $('.tearms_details .ck-content').html();
        var form = $('form[name="quetionn_from"]')[0];
        var formdata = new FormData(form);
        if (editorContent != "") {
            formdata.append('quotation_detail', description);
            formdata.append('payment_detail', paymentt_details);
            formdata.append('terms_condition', tearms_details);
            formdata.append('update_id', update_id);
            formdata.append('action', 'insert');
            formdata.append('table', 'master_general_settings');
            // alert();
            $.ajax({
                method: "post",
                url: "<?= site_url('quotion_setting'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(res) {
                    var response = JSON.parse(res);
                    console.log(response);
                    if (response.response == 1) {
                        // alert('1');
                        $('.loader').hide();
                        $(".general_settings_main_quotation").show();
                        $(".quotation_editor").hide();
                        $(".general_settings_quotation .quot_details , .general_settings_quotation .paymentt_details , .general_settings_quotation .tearms_details").addClass("opacity-50 pointer-event-none");
                        $(".quotation_editor").text("update");
                        // $(".general_settings_invoices .main-control").attr("disabled", "");
                        iziToast.success({
                            title: response.message,
                        });
                    } else {
                        $('.loader').hide();
                        iziToast.error({
                            title: response.message
                        });
                    }
                },
            });
        } else {
            $("form[name='quetionn_from']").addClass("was-validated");
            var form = $("form[name='quetionn_from']");
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
    });
    if(<?php echo $settings_data['email_radio']; ?> == "1")
    {
        $('#email_radio_1').prop('checked', true);
        $('#email_radio_2').prop('checked', false);
    }else if(<?php echo $settings_data['email_radio']; ?>== "2"){
        $('#email_radio_2').prop('checked', true);
        $('#email_radio_1').prop('checked', false);
    }

    function InsertData(form) {
        var formdata = new FormData(form);
        formdata.append('table', 'admin_platform_integration');

        $("input[type='checkbox']").each(function() {
            if ($(this).val() === "0") {
                formdata.set($(this).attr('name'), '0');
            }
        });
        $.ajax({
            method: "post",
            url: "<?= site_url('check_email_connection'); ?>",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(res) {
                var result = JSON.parse(res);
                console.log(res);
                // $(".email_update").hide();

                iziToast.success({
                    title: result.msg,
                });

            },
        });
    }
    $('body').on('click', '#pills-WhatsApp-tab', function() {
        var id = <?= $_SESSION['master'] ?>;
        $.ajax({
            type: 'post',
            url: 'whatsapp_api_add_and_update',
            data: {
                'master_user_id': id,
                'action': 'view',
                'table': 'master_integration_api',
            },
            success: function(res) {
                var response = JSON.parse(res);
                if (response == '') {
                    $('#whatsapp_api').val('');
                    $('#whatsapp_access_token').val('');
                    $('.whatsapp_api_btn').attr('data-update_status', 0);
                } else {
                    $('#whatsapp_api').val(response[0].api);
                    $('#whatsapp_access_token').val(response[0].whatsapp_access_token);
                    $('.whatsapp_api_btn').attr('data-update_status', response[0].id);
                }
            }
        });
    });
    $('body').on('click', '.whatsapp_api_btn', function(e) {
        e.preventDefault();
        var api_key = $('#whatsapp_api').val();
        var whatsapp_access_token = $('#whatsapp_access_token').val();
        if (api_key != '') {
            $.ajax({
                type: 'post',
                url: 'whatsapp_api_add_and_update',
                data: {
                    'api_key': api_key,
                    'whatsapp_access_token': whatsapp_access_token,
                    'action': 'insert',
                    'table': 'master_integration_api',
                },
                success: function(res) {
                    var response = JSON.parse(res);
                    $(".whatsapp_api_btn").hide();
                    $(".general_settings_main_whatsapp").show();
                    iziToast.success({
                        title: response.msg,
                    });
                }
            });
        }
    });
</script>