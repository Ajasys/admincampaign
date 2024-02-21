<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$db_connection = \Config\Database::connect('second');
$table_username = session_username($_SESSION['username']);
$query90 = "SELECT * FROM admin_platform_integration WHERE platform_status = 3 AND  master_id = '" . $_SESSION['master'] . "'";
$result = $db_connection->query($query90);
$email_platform_data = $result->getResultArray();

?>
<div class="main-dashbord p-2">
    <form class="needs-validation" name="email_update_form" method="POST" novalidate>
        <div class="bg-white border rounded-2 p-3 general_settings_editsss general_email_settings_outer">
            <div class="row col-10 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                <?php foreach ($email_platform_data as $valuee) { ?>
                    <div class="col-12 d-flex flex-wrap p-1 border my-2 rounded-3 ">
                        <div class="" style="left: -15px; top: -7px">
                            <input type="radio" class="email_radio" value="2" data-table_id="<?php echo $valuee['id'] ?>" id="email_radio_2" name="email_radio">
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-center p-1">
                            <!-- <span class="btn-primary-rounded edt" data-edit_id="<?php echo $valuee['id'] ?>" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update">
                                <i class="fas fa-pencil-alt fs-14"></i>
                            </span> -->
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
                    <input type="radio" class="email_radio" id="email_radio_1" value="1"  name="email_radio">
                </div>
                <div class="col-sm-6 col-12 input-text">
                    <label for="form-port" class="form-label main-label">From Email</label>
                    <input type="email" name="email_from" id="email_from" class="form-control main-control emailsss" value="<?php if (isset($valuee['email_from']) && $valuee['email_from'] != '') {
                                                                                                                                echo $valuee['email_from'];
                                                                                                                            } ?>" required="" placeholder="Enter From Email" />
                    <div class="email-errorsss">
                    </div>
                </div>
            </div>
            <div class="row col-10 ps-3 m-0 py-3">

                <div class="col-sm-6 col-12 input-text">
                    <label for="form-cc" class="form-label main-label">CC</label>
                    <input type="email" name="mail_cc" id="mail_cc" class="form-control main-control email" value="<?php if (isset($valuee['mail_cc']) && $valuee['mail_cc'] != '') {
                                                                                                                        echo $valuee['mail_cc'];
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

    <?php if (empty($valuee['email_from']) || empty($valuee['smtp_port']) && empty($valuee['smtp_host']) && empty($valuee['smtp_user']) && empty($valuee['smtp_password']) && empty($valuee['smtp_crypto']) && empty($valuee['from_email'])) { ?>
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
        var checkedTableId;
            $(".email_radio").each(function() {
                if ($(this).is(":checked")) {
                    checkedTableId = $(this).attr('data-table_id');
                }
            });
        var formdata = new FormData(form);
        formdata.append('table', 'admin_platform_integration');
        formdata.append('checkedTableId', checkedTableId);
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