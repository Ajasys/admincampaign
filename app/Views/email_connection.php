<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$db_connection = \Config\Database::connect('second');
$table_username = session_username($_SESSION['username']);
$query90 = "SELECT * FROM " . $table_username . "_platform_integration ";
$result = $db_connection->query($query90);
$total_dataa_userr_22 = $result->getResult();
if (isset($total_dataa_userr_22[0])) {
    $settings_data = get_object_vars($total_dataa_userr_22[0]);
} else {
    $settings_data = array();
}
$platform_integration = json_decode($platform_integration, true);
?>
<div class="main-dashbord p-2">
    <form class="needs-validation" name="email_update_form" method="POST" novalidate>
        <div class="bg-white border rounded-2 p-3 general_settings_editsss general_email_settings_outer">
            <div class="row col-10 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                <div class="position-absolute" style="left: -15px; top: -7px">
                    <input type="radio" class="email_radio" value="2" id="email_radio_2" name="email_radio">
                </div>
                <?php foreach ($platform_integration as $valuee) { ?>
                    <div class="col-12 d-flex flex-wrap p-1 border my-2 rounded-3 ">
                        <div class="col-12 d-flex justify-content-end align-items-center p-1">
                            <span class="btn-primary-rounded edt" data-edit_id="<?php echo $valuee['id'] ?>" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update">
                                <i class="fas fa-pencil-alt fs-14"></i>
                            </span>
                        </div>
                        <div class="col-sm-6 col-12 input-text mt-2 p-1">
                            <label for="form-port" class="form-label main-label">SMTP Port </label>
                            <input type="text" name="smtp_port" id="smtp_port" class="form-control main-control" value="<?php echo $valuee['smtp_port'] ?>" placeholder="Enter SMTP Port" />
                        </div>
                        <div class="col-sm-6 col-12 input-text mt-2 p-1">
                            <label for="form-host" class="form-label main-label">SMTP Host </label>
                            <input type="text" name="smtp_host" id="smtp_host" class="form-control main-control" value="<?php echo $valuee['smtp_host'] ?>" placeholder="Enter SMTP Host" />
                        </div>
                        <div class="col-sm-6 col-12 input-text mt-2 p-1">
                            <label for="form-user" class="form-label main-label">SMTP User </label>
                            <input type="text" name="smtp_user" id="smtp_user" class="form-control main-control" value="<?php echo $valuee['smtp_user'] ?>" placeholder="Enter SMTP User" />
                        </div>
                        <div class="col-sm-6 col-12 input-text mt-2 p-1">
                            <label for="form-status password" class="form-label main-label">SMTP Password
                            </label>
                            <input type="password" name="smtp_password" id="smtp_password" class="form-control main-control" value="<?php echo $valuee['smtp_password'] ?>" placeholder="Enter SMTP Password" />
                        </div>
                        <div class="col-sm-6 col-12 input-text mt-2 p-1">
                            <label for="form-crypto" class="form-label main-label">SMTP Crypto </label>
                            <input type="text" name="smtp_crypto" id="smtp_crypto" class="form-control main-control" value="<?php echo $valuee['smtp_crypto'] ?>" placeholder="Enter SMTP Crypto" />
                        </div>
                    </div>

                <?php } ?>
                <br>
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

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    $('body').on('click', '.email_updatees', function() {
        $(".general_settings_editsss").show();
    });
    $('body').on('click', '.general_settings_main_email', function() {
        $(".general_settings_editsss .main-control").removeAttr("disabled");
        $(".email_updatees").show();
        $(this).hide();
    });
    if (<?php echo $settings_data['email_radio']; ?> == "1") {
        $('#email_radio_1').prop('checked', true);
        $('#email_radio_2').prop('checked', false);
    } else if (<?php echo $settings_data['email_radio']; ?> == "2") {
        $('#email_radio_2').prop('checked', true);
        $('#email_radio_1').prop('checked', false);
    }

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

    function InsertData(form) {
        var formdata = new FormData(form);
        formdata.append('table', 'platform_integration');
        formdata.append('action', 'insert');
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
                // $(".email_update").hide();

                iziToast.success({
                    title: result.msg,
                });

            },
        });
    }
</script>