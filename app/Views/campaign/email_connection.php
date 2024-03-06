<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$db_connection = DatabaseDefaultConnection();
$table_username = session_username($_SESSION['username']);
$query90 = "SELECT * FROM admin_platform_integration WHERE platform_status = 3 AND  master_id = '" . $_SESSION['master'] . "'";
$result = $db_connection->query($query90);
$email_platform_data = $result->getResultArray();

?>
<div class="main-dashbord p-2">
    <form class="needs-validation" name="email_update_form" method="POST" novalidate>
        <div class="bg-white border rounded-2 p-3 general_settings_editsss position-relative general_email_settings_outer">
            <span class="btn-primary-rounded add_div_btn ms-2 position-absolute top-0 end-0 " style="cursor: pointer;">
                <i class="bi bi-plus"></i>
            </span>
            <?php $i = 0;
            $count = 0; ?>
            <?php foreach ($email_platform_data as $valuee) {
                $count++; ?>
                <div class="row col-12 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                    <div class="position-absolute" style="left: -5px">
                        <input type="radio" data-count="<?php echo $count; ?>" class="email_radio" value="2" data-table_id="<?php echo $valuee['id'] ?>" id="email_radio_2" name="email_radio">
                    </div>
                    <div class="col-sm-6 col-12 input-text mt-2">
                        <label for="form-port" class="form-label main-label">SMTP Port </label>
                        <input type="text" name="smtp_port" id="smtp_port" class="form-control main-control smtp_port_<?php echo $count; ?>" value="<?php echo $valuee['smtp_port'] ?>" placeholder="Enter SMTP Port" />
                    </div>
                    <div class="col-sm-6 col-12 input-text mt-2">
                        <label for="form-host" class="form-label main-label">SMTP Host </label>
                        <input type="text" name="smtp_host" id="smtp_host" class="form-control main-control smtp_host_<?php echo $count; ?>" value="<?php echo $valuee['smtp_host'] ?>" placeholder="Enter SMTP Host" />
                    </div>
                    <div class="col-sm-6 col-12 input-text mt-2">
                        <label for="form-user" class="form-label main-label">SMTP User </label>
                        <input type="text" name="smtp_user" id="smtp_user" class="form-control main-control smtp_user_<?php echo $count; ?>" value="<?php echo $valuee['smtp_user'] ?>" placeholder="Enter SMTP User" />
                    </div>
                    <div class="col-sm-6 col-12 input-text mt-2">
                        <label for="form-status password" class="form-label main-label">SMTP Password
                        </label>
                        <input type="password" name="smtp_password" id="smtp_password" class="form-control main-control smtp_password_<?php echo $count; ?>" value="<?php echo $valuee['smtp_password'] ?>" placeholder="Enter SMTP Password" />
                    </div>
                    <div class="col-sm-6 col-12 input-text mt-2">
                        <label for="form-crypto" class="form-label main-label">SMTP Crypto </label>
                        <input type="text" name="smtp_crypto" id="smtp_crypto" class="form-control main-control smtp_crypto_<?php echo $count; ?>" value="<?php echo $valuee['smtp_crypto'] ?>" placeholder="Enter SMTP Crypto" />
                    </div>


                </div>
            <?php } ?>
            <div class="appdiv">

            </div>
            <div class="row col-12 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                <div class="position-absolute" style="left: -5px">
                    <input type="radio" class="email_radio" id="email_radio_1" value="1" checked name="email_radio">
                </div>
                <div class="col-sm-6 col-12 input-text">
                    <label for="form-port" class="form-label main-label">From Email</label>
                    <input type="email" name="email_from" id="email_from" class="form-control main-control email_formm emailsss" value="<?php if (isset($settings_data['email_from']) && $settings_data['email_from'] != '') {
                                                                                                                                echo $settings_data['email_from'];
                                                                                                                            } ?>" required="" placeholder="Enter From Email" />
                    <div class="email-errorsss">
                    </div>
                </div>
            </div>
            <div class="row col-12 ps-3 m-0 py-3">

                <div class="col-sm-6 col-12 input-text">
                    <label for="form-cc" class="form-label main-label">CC</label>

                    <input type="email" name="mail_cc" id="mail_cc" class="form-control main-control mail_cc email" value="<?php if (isset($settings_data['mail_cc']) && $settings_data['mail_cc'] != '') {
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
                    <button type="button" class="btn-primary email_insert" name="" value="">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    function add_divnew() {
        html = ` <div class="row col-12 ps-3 m-0 py-3 border-bottom position-relative addclass_dnone general_email_settings_inner">
                                <div class="position-absolute" style="left: -5px">
                                    <input type="radio" class="email_radio" value="" id="email_radio_2" name="email_radio" >
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                        <label for="form-port" class="form-label main-label">SMTP Port </label>
                                    <input type="text" name="smtp_port" id="smtp_port" class="form-control main-control smtp_port" value="" placeholder="Enter SMTP Port" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-host" class="form-label main-label">SMTP Host </label>
                                    <input type="text" name="smtp_host" id="smtp_host" class="form-control main-control smtp_host" value="" placeholder="Enter SMTP Host" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-user" class="form-label main-label">SMTP User </label>
                                    <input type="text" name="smtp_user" id="smtp_user" class="form-control main-control smtp_user" value="" placeholder="Enter SMTP User" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-status password" class="form-label main-label">SMTP Password
                                    </label>
                                    <input type="password" name="smtp_password" id="smtp_password" class="form-control main-control smtp_password" value="" placeholder="Enter SMTP Password" />
                                </div>
                                <div class="col-sm-6 col-12 input-text mt-2">
                                    <label for="form-crypto" class="form-label main-label">SMTP Crypto </label>
                                    <input type="text" name="smtp_crypto" id="smtp_crypto" class="form-control main-control smtp_crypto" value="" placeholder="Enter SMTP Crypto" />
                                </div>
                                <span class="btn-primary-rounded close_div_btn ms-2 position-absolute top-0 mt-3 end-0" style="cursor: pointer;">
                                    <i class="bi bi-x"></i>
                                </span>
                            </div>
                            `
        $(".appdiv").append(html);
    }


    $(document).on("click", ".add_div_btn", function() {
        add_divnew()
    })

    $(document).on("click", ".close_div_btn", function() {
        $(this).closest('.addclass_dnone').remove();
    })
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

    $('body').on('click', '.email_updatees', function() {
        $(".general_settings_editsss").show();
    });
    $('body').on('click', '.general_settings_main_email', function() {
        $(".general_settings_editsss .main-control").removeAttr("disabled");
        $(".email_updatees").show();
        $(this).hide();
    });

    <?php if (empty($valuee['smtp_port']) && empty($valuee['smtp_host']) && empty($valuee['smtp_user']) && empty($valuee['smtp_password']) && empty($valuee['smtp_crypto']) && empty($valuee['from_email'])) { ?>
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

    $('body').on('click', '.email_updatees', function(e) {
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
    $('body').on('click', '.email_insert', function(e) {
        e.preventDefault();
        var smtp_host = $('.smtp_host').val();
        var smtp_port = $('.smtp_port').val();
        var smtp_user = $('.smtp_user').val();
        var smtp_password = $('.smtp_password').val();
        var smtp_crypto = $('.smtp_crypto').val();
        var email_formm = $('.email_formm').val();
        var mail_cc = $('.mail_cc').val();

        
        
        var formdata = new FormData();
        formdata.append('table', 'admin_platform_integration');
        formdata.append('smtp_host', smtp_host);
        formdata.append('smtp_port', smtp_port);
        formdata.append('smtp_user', smtp_user);
        formdata.append('smtp_password', smtp_password);
        formdata.append('smtp_crypto', smtp_crypto);
        formdata.append('from_email', email_formm);
        formdata.append('mail_cc', mail_cc);

        formdata.append('action', 'insert');
        formdata.append('table', 'admin_platform_integration');

        $.ajax({
            method: "post",
            url: "<?= site_url('email_account_insert'); ?>",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(res) {
                var result = JSON.parse(res);
                // $(".email_update").hide();

                iziToast.success({
                    title: result.msg,
                });

            },
        });
    });

    function InsertData(form) {
        var checkedTableId;
        $(".email_radio").each(function() {
            if ($(this).is(":checked")) {
                checkedTableId = $(this).attr('data-table_id');
                data_count_id = $(this).attr('data-count');

            }
        });
        var smtp_hostt = $('.smtp_host_' + data_count_id).val();
        var smtp_portt = $('.smtp_port_' + data_count_id).val();
        var smtp_userr = $('.smtp_user_' + data_count_id).val();
        var smtp_passwordd = $('.smtp_password_' + data_count_id).val();
        var smtp_cryptoo = $('.smtp_crypto_' + data_count_id).val();

        var formdata = new FormData();
        formdata.append('table', 'admin_platform_integration');
        formdata.append('smtp_host', smtp_hostt);
        formdata.append('smtp_port', smtp_portt);
        formdata.append('smtp_user', smtp_userr);
        formdata.append('smtp_password', smtp_passwordd);
        formdata.append('smtp_crypto', smtp_cryptoo);
        formdata.append('action', 'insert');
        formdata.append('table', 'admin_platform_integration');
        formdata.append('checkedTableId', checkedTableId);
        // $("input[type='checkbox']").each(function() {
        //     if ($(this).val() === "0") {
        //         formdata.set($(this).attr('name'), '0');
        //     }
        // });
        $.ajax({
            method: "post",
            url: "<?= site_url('check_email_connection'); ?>",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(res) {
                var result = JSON.parse(res);
                // $(".email_update").hide();

                iziToast.success({
                    title: result.msg,
                });

            },
        });
    }
</script>