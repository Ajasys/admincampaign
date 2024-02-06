<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php 
$table_username = getMasterUsername();
$settings_data = getGeneraleData();

?>
<style>
    .inti-card {
        transition: all 0.5s;
    }

    .inti-card:hover {
        background-color: #E6E7EC !important;
    }
</style>
<div class="main-dashbord p-2 main-check-class">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1">
                    <i class="fa-brands fa-facebook transition-5 icon2 rounded-circle" style="color: #3a559f;"></i>
                    <h2 class="ps-2">Facebook Connection
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="modal-body-card col-4 flex-column justify-content-between mx-4 second-card comon-card position-relative">
                <form class="needs-validation row" name="fb_cnt" method="POST" novalidate="">
                    <div class="col-12">
                        <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                        <textarea type="text" class="form-control main-control" id="access_token" name="access_token" placeholder="Enter Access Token" required><?php if(isset($settings_data['facebook_access_token']))
                        {
                            echo $settings_data['facebook_access_token'];
                        }?></textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-end ms-2 mt-3 justify-content-right align-items-center">
                        <a href="<?= base_url('integration') ?>">
                            <button type="button" class="btn-secondary mx-0" id="cancel" name="">Back</button>
                        </a>
                        <div type="button facebook_cnt" class="btn-primary mx-2" id="facebook_cnt">Submit</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('body').on('click', '#facebook_cnt', function() {
        // alert('hiii');
        var access_token = $("#access_token").val();
        // alert(access_token + '-----------');

        if (access_token != '') {
            $.ajax({
                type: "post",
                url: "<?= site_url('check_fb_connection'); ?>",
                data: {
                    action: 'insert',
                    access_token: access_token,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.response == 1) {
                        iziToast.success({
                            title: result.message,
                        });
                    } else {
                        iziToast.error({
                            title: result.message,
                        });
                    }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
            return false;
        } else {
            var form = $("form[name='fb_cnt']")[0];
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
            iziToast.error({
                title: 'Please fill required field..!',
            });
            return false;
        }
    });
</script>