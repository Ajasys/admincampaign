<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$db_connection = \Config\Database::connect('second');
$settings_data = getGeneraleData();
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
</style>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="title-1">
                <i class="bi bi-gear-fill d-flex"></i>
                <h2>General Settings</h2>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="General-Settings" role="tabpanel" aria-labelledby="pills-General-tab" tabindex="0">
                    <form class="needs-validation" name="general_settings_update" enctype="multipart/form-data" method="POST" novalidate="">
                        <div class="bg-white rounded-3 shadow border d-flex flex-wrap align-items-center mt-3">
                            <div class="col-lg-12 col-12 mb-lg-0 bg-white rounded-2">
                                <div class="p-3">
                                    <div class="d-flex flex-wrap  col-12 mt-2 align-items-end">
                                        <div class="input-text col-lg-12 col-12" style="height:65.6px">
                                            <div>
                                                <span><B>Biometric Device Configuration</B><sup class="validationn">*</sup></span>
                                            </div>
                                            <label class="switch_toggle switch_toggle mb-1">
                                                <input id="Biometric_status" name="Biometric_status" class="EmailToggle" type="checkbox" value="1" <?php if (isset($settings_data['Biometric_status']) && $settings_data['Biometric_status'] == 1) {
                                                    echo 'checked';
                                                } ?>>
                                                <span class="check_input round"></span>
                                            </label>
                                        </div>
                                        <div class="input-text HideAndShowBiometiricFields col-12 col-md-6 col-lg-2 mt-md-0 mt-1 px-2">
                                            <label for="gstNo" class="main-label investor" name="username" required pattern="[0-9a-zA-Z_.-]*">Corporate ID<sup class="validationn">*</sup></label>
                                            <input type="text" class="form-control main-control place" id="corporateid" value="<?php if (isset($settings_data['corporateid'])) {
                                                echo $settings_data['corporateid'];
                                            } ?>" placeholder="Enter Corporate ID" required>
                                            <div class="check_validation"></div>
                                        </div>
                                        <div class="input-text HideAndShowBiometiricFields col-12 col-md-6 col-lg-2 mt-md-0 mt-1 px-2">
                                            <label for="form-Occupation" class="main-label investor">Username<sup class="validationn">*</sup></label>
                                            <input type="text" class="form-control main-control place" id="biometric_username" value="<?php if (isset($settings_data['biometric_username'])) {
                                                echo $settings_data['biometric_username'];
                                            } ?>" placeholder="Enter Username" required="">
                                        </div>
                                        <div class="input-text HideAndShowBiometiricFields col-12 col-md-6 col-lg-3 mt-md-0 mt-1 px-2">
                                            <label for="form-Occupation" class="main-label investor">Password<sup class="validationn">*</sup></label>
                                            <div class="d-flex justify-content-between position-relative">
                                                <input type="password" class="form-control main-control place" id="biometric_password" placeholder="Enter Password" value="<?php if (isset($settings_data['biometric_password'])) {
                                                    echo $settings_data['biometric_password'];
                                                } ?>" required="">
                                                <i class="bi bi-eye-slash pass-icon" id="eye"></i>
                                            </div>
                                        </div>
                                        <div class="input-text HideAndShowBiometiricFields mt-2 col-10 col-md-12 col-lg-5 px-2 ">
                                            <div class="col-12 d-flex">
                                                <div class="col-11 d-flex ">
                                                    <div class="d-flex flex-wrap aling-items-center justify-content-center ">
                                                        <?php
                                                        if (isset($settings_data['biometric_connection']) && $settings_data['biometric_connection'] == 1) {
                                                            $verify_text = 'Verified';
                                                        } else {
                                                            $verify_text = 'Verify';
                                                        }
                                                        ?>
                                                        <button type="button" class="btn-primary" id="verify_connection"><?php echo $verify_text; ?></button>
                                                    </div>
                                                    <div class="align-items-center mx-1 verify-icon justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 30 30" fill="block">
                                                            <path d="M15 30C23.2843 30 30 23.2843 30 15C30 6.71573 23.2843 0 15 0C6.71573 0 0 6.71573 0 15C0 23.2843 6.71573 30 15 30Z" fill="#00BA00" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3112 22.3228L4.8427 16.4291C4.47992 16.0404 4.28614 15.5237 4.30385 14.9922C4.32156 14.4608 4.54933 13.9582 4.93719 13.5945C5.32743 13.2332 5.84507 13.0415 6.3765 13.0614C6.90793 13.0813 7.40975 13.3113 7.77184 13.7008L12.0002 18.2244L18.697 11.9645C18.7569 11.9096 18.82 11.8583 18.886 11.811L22.0277 8.87005C22.4165 8.50727 22.9332 8.31348 23.4646 8.33119C23.996 8.34891 24.4987 8.57668 24.8624 8.96454C25.2252 9.35325 25.419 9.86999 25.4012 10.4014C25.3835 10.9328 25.1558 11.4355 24.7679 11.7992L15.1419 20.7756L11.7994 23.8819L10.323 22.2992L10.3112 22.3228Z" fill="white" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="col-1 d-flex gap-3 disconnectDiv">
                                                    <div class="align-items-center mx-1 verify-icon justify-content-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="25" x="0" y="0" viewBox="0 0 2.54 2.54" style="enable-background:new 0 0 512 512" xml:space="preserve" fill-rule="evenodd" class="" onclick="disconnect('<?php echo isset($settings_data['id']); ?>');">
                                                            <title>Disconnect your device connection</title>
                                                            <g>
                                                                <circle r="2.17" fill="#ff1f1f" transform="matrix(.414 -.414 .414 .414 1.27 1.27)" opacity="1" data-original="#ff1f1f" class=""></circle>
                                                                <g fill="#fff">
                                                                    <path d="m1.17 1.61.44-.44.348-.348a.17.17 0 0 0 0-.24.17.17 0 0 0-.24 0L1.371.93l-.441.44-.348.348a.17.17 0 0 0 0 .24.17.17 0 0 0 .24 0z" fill="#ffffff" opacity="1" data-original="#ffffff" class=""></path>
                                                                    <path d="M1.61 1.37 1.17.93.821.582a.17.17 0 0 0-.24 0 .17.17 0 0 0 0 .24l.348.347.44.441.348.348a.17.17 0 0 0 .24 0 .17.17 0 0 0 0-.24z" fill="#ffffff" opacity="1" data-original="#ffffff" class=""></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<?= $this->include('partials/vendor-scripts') ?>
<script>
    var checkbox1 = document.getElementById("Biometric_status");
    checkbox1.addEventListener("change", function() {
        if (checkbox1.checked) {
            $(".HideAndShowBiometiricFields").show();
            var value1 = checkbox1.value1;
        } else {
            $(".HideAndShowBiometiricFields").hide();
        }
    });
    $(document).ready(function() {
        $(".HideAndShowBiometiricFields").hide();
        $('.verify-icon').hide();
        $('.disconnectDiv').hide();
        var Biometric_status = '<?php echo isset($settings_data['Biometric_status']) ?>';
        var biometric_connection = '<?php echo isset($settings_data['biometric_connection']) ?>';
        if (Biometric_status == 1) {
            $(".HideAndShowBiometiricFields").show();
        }
        if (biometric_connection == 1) {
            $('.verify-icon').show();
            $('.disconnectDiv').show();
        }
        $("#verify_connection").on('click', function(e) {
            e.preventDefault();
            var update_id = '<?php echo isset($settings_data['id']) ?>';
            var Biometric_status = $("#Biometric_status").is(":checked") ? "1" : "0";
            if (Biometric_status == 1) {
                var corporateid = $('#corporateid').val();
                var biometric_username = $('#biometric_username').val();
                var biometric_password = $('#biometric_password').val();
                if (corporateid != '' && biometric_username != '' && biometric_password != '') {
                    $('.loader').show();
                    $.ajax({
                        method: "post",
                        url: "<?= site_url('general_setting_verify_connection'); ?>",
                        data: {
                            Biometric_status: Biometric_status,
                            corporateid: corporateid,
                            biometric_username: biometric_username,
                            biometric_password: biometric_password,
                            update_id: update_id,
                            username: 'admin_generale_setting',
                        },
                        success: function(res) {
                            $('.loader').hide();
                            if (res == 0) {
                                $('.verify-icon').show();
                                $('#verify_connection').html('Verified');
                                $('.disconnectDiv').show();
                                iziToast.success({
                                    title: 'Biometric device connection successfully..!'
                                });
                            } else {
                                iziToast.error({
                                    title: 'Unathorized Login or Password..!'
                                });
                                $('.verify-icon').hide();
                            }
                        }
                    });
                } else {
                    iziToast.error({
                        title: 'Please fill all biometric field..!'
                    });
                    $('.verify-icon').hide();
                }
            }
        });
        $(function() {
            $('#eye').click(function() {
                if ($(this).hasClass('bi bi-eye-slash')) {
                    $(this).removeClass('bi bi-eye-slash');
                    $(this).addClass('bi bi-eye');
                    $('#biometric_password').attr('type', 'text');
                } else {
                    $(this).removeClass('bi bi-eye');
                    $(this).addClass('bi bi-eye-slash');
                    $('#biometric_password').attr('type', 'password');
                }
            });
        });
    });
    function disconnect(id) {
        $('.loader').show();
        $.ajax({
            method: "post",
            url: "<?= site_url('biometric_setting_disconnect'); ?>",
            data: {
                update_id: id,
            },
            success: function(res) {
                $('.loader').hide();
                if (res == 0) {
                    $('.verify-icon').hide();
                    $('#verify_connection').html('Verify');
                    $('.disconnectDiv').hide();
                    $("#Biometric_status").prop("checked", false);
                    $('corporateid').val('');
                    $('biometric_username').val('');
                    $('biometric_password').val('');
                    $(".HideAndShowBiometiricFields").hide();
                    iziToast.success({
                        title: 'Biometric device disconnect successfully..!'
                    });
                } else {
                    iziToast.error({
                        title: 'Biometric device can not disconnect successfully..!'
                    });
                }
            }
        });
    }
</script>