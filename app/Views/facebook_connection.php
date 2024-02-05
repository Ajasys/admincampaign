<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php $table_username = getMasterUsername(); ?>
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
                <form class="needs-validation" name="fb_cnt" method="POST" novalidate="">
                    <div class="row">
                        <div class="align-items-end d-flex col-12 my-2">
                            <div class="col-12">
                                <h6 class="modal-body-title">Phone Number Id<sup class="validationn">*</sup></h6>
                                <input type="number" class="form-control main-control" id="phone_number_id" name="phone_number_id" placeholder="Enter Phone Number Id" required="">
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="modal-body-title">Facebook Business Account ID<sup class="validationn">*</sup></h6>
                            <input type="number" class="form-control main-control" id="" name="" placeholder="Enter Facebook Business Account ID" required="">
                        </div>
                        <div class="col-12">
                            <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                            <textarea type="text" class="form-control main-control" id="" name="" placeholder="Enter Access Token" required=""></textarea>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end ms-2 mt-3 justify-content-right align-items-center">
                        <a href="<?= base_url('integration') ?>"><button type="button" class="btn-secondary mx-0" id="cancel" name="">Cancel</button></a>
                        <button type="button facebook_cnt" class="btn-primary mx-2" id="facebook_cnt" name="">Submit</button>
                        <!-- <span class="whatapp_verification_status_class mx-1" id="basic-addon2">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 2.54 2.54" style="enable-background:new 0 0 512 512" xml:space="preserve" fill-rule="evenodd" class="">
                                <g>
                                    <circle cx="1.27" cy="1.27" r="1.27" fill="#00ba00" opacity="1" data-original="#00ba00" class=""></circle>
                                    <path fill="#ffffff" d="M.873 1.89.41 1.391a.17.17 0 0 1 .008-.24.17.17 0 0 1 .24.009l.358.383.567-.53a.17.17 0 0 1 .016-.013l.266-.249a.17.17 0 0 1 .24.008.17.17 0 0 1-.008.24l-.815.76-.283.263-.125-.134z" opacity="1" data-original="#ffffff"></path>
                                </g>
                            </svg>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path fill="#f44336" d="M256 0C114.836 0 0 114.836 0 256s114.836 256 256 256 256-114.836 256-256S397.164 0 256 0zm0 0" opacity="1" data-original="#f44336" class=""></path>
                                <path fill="#fafafa" d="M350.273 320.105c8.34 8.344 8.34 21.825 0 30.168a21.275 21.275 0 0 1-15.086 6.25c-5.46 0-10.921-2.09-15.082-6.25L256 286.164l-64.105 64.11a21.273 21.273 0 0 1-15.083 6.25 21.275 21.275 0 0 1-15.085-6.25c-8.34-8.344-8.34-21.825 0-30.169L225.836 256l-64.11-64.105c-8.34-8.344-8.34-21.825 0-30.168 8.344-8.34 21.825-8.34 30.169 0L256 225.836l64.105-64.11c8.344-8.34 21.825-8.34 30.168 0 8.34 8.344 8.34 21.825 0 30.169L286.164 256zm0 0" opacity="1" data-original="#fafafa" class=""></path>
                            </g>
                        </svg> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('body').on('click', '.facebook_cnt', function() {
        var area = $(".area option:selected").val();
        var int_site = $(".int_site option:selected").val();
        var sub_type = $(".sub_type option:selected").val();
        var assign_to = $(".assign_to option:selected").val();
        var staff_to = $("#staff_to").val();
        var staff_to = staff_to.join(',');
        var page_id = $("#facebookpages option:selected").val();
        var access_token = $("#facebookpages").find("option:selected").attr("data-access_token");
        var page_name = $("#facebookpages").find("option:selected").attr("data-page_name");
        var form_id = $("#facebookform option:selected").val();
        var form_name = $("#facebookform option:selected").text();
        var edit_id = $(this).attr('edit_id');
        
        if (int_site > 0 && assign_to != "" && sub_type > 0 && area > 0) {
            $.ajax({
                type: "post",
                url: "<?= site_url('facebook_page'); ?>",
                data: {
                    action: 'page',
                    page_id: page_id,
                    access_token: access_token,
                    page_name: page_name,
                    area: area,
                    int_site: int_site,
                    sub_type: sub_type,
                    assign_to: assign_to,
                    staff_to:staff_to,
                    form_name: form_name,
                    form_id: form_id,
                    edit_id: edit_id,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.respoance == 1) {
                        location.reload();
                        FB.api('/' + page_id + '/subscribed_apps', 'post', {
                                access_token: access_token,
                                subscribed_fields: ['leadgen']
                            },
                            function(response) {}
                        );
                        iziToast.success({
                            title: result.msg,
                        });
                    } else {
                        location.reload();
                        iziToast.error({
                            title: result.msg,
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
            return false;
        }
    });
</script>