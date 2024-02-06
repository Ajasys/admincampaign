<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    .rotate-arrow {
        transform: rotateY(180deg);
    }

    .transition-5 {
        transition: all 0.5s;
    }

    .o-1 {
        opacity: 0.3;
    }

    /* .comon-card::after{
        position: absolute;
        content: '';
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 2;
        background-color: red;
    } */
</style>




<div class="main-dashbord p-2 main-check-class">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="20" height="20" x="0" y="0" viewBox="0 0 409 409"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path fill="#07ba39"
                                d="M409 204.49v2.69c0 1.69-.06 3.38-.12 5.06v.39c0 .85-.07 1.7-.11 2.55A204.52 204.52 0 0 1 210.4 408.91h-.08q-2.9.09-5.82.09C91.56 409 0 317.44 0 204.5A204.51 204.51 0 0 1 204.5 0q2.92 0 5.82.09a204.51 204.51 0 0 1 198.53 196.5c.07 1.75.11 3.5.13 5.26.02.88.02 1.76.02 2.64z"
                                opacity="1" data-original="#07ba39" class=""></path>
                            <g fill-rule="evenodd">
                                <path fill="#ffffff"
                                    d="M244 198.16c5-5.92 6.75-10.81 6.75-22 0-16.48-11.72-32.77-29.69-32.77h-46.12c-5.85 0-7.6 3.37-7.6 7.68v95.08c0 6.24 3.29 8.92 9 8.92h46.4c14.84 0 30.93-13.2 30.93-33.76-.02-11.04-3.83-17.76-9.67-23.15zm-55.13-33.46h30.82a9.57 9.57 0 0 1 9.54 9.53v4.52a9.56 9.56 0 0 1-9.54 9.52h-30.82zm42.62 59.5a9.55 9.55 0 0 1-9.52 9.53h-33.1v-23.58H222a9.56 9.56 0 0 1 9.52 9.54zm12.53-26c5-5.92 6.75-10.81 6.75-22 0-16.48-11.72-32.77-29.69-32.77h-46.14c-5.85 0-7.6 3.37-7.6 7.68v95.08c0 6.24 3.29 8.92 9 8.92h46.4c14.84 0 30.93-13.2 30.93-33.76-.02-11.08-3.83-17.8-9.67-23.19zm-55.15-33.5h30.82a9.57 9.57 0 0 1 9.54 9.53v4.52a9.56 9.56 0 0 1-9.54 9.52h-30.82zm42.62 59.5a9.55 9.55 0 0 1-9.52 9.53h-33.1v-23.58H222a9.56 9.56 0 0 1 9.52 9.54zm12.53-26c5-5.92 6.75-10.81 6.75-22 0-16.48-11.72-32.77-29.69-32.77h-46.14c-5.85 0-7.6 3.37-7.6 7.68v95.08c0 6.24 3.29 8.92 9 8.92h46.4c14.84 0 30.93-13.2 30.93-33.76-.02-11.08-3.83-17.8-9.67-23.19zm-55.15-33.5h30.82a9.57 9.57 0 0 1 9.54 9.53v4.52a9.56 9.56 0 0 1-9.54 9.52h-30.82zm42.62 59.5a9.55 9.55 0 0 1-9.52 9.53h-33.1v-23.58H222a9.56 9.56 0 0 1 9.52 9.54zm12.53-26c5-5.92 6.75-10.81 6.75-22 0-16.48-11.72-32.77-29.69-32.77h-46.14c-5.85 0-7.6 3.37-7.6 7.68v95.08c0 6.24 3.29 8.92 9 8.92h46.4c14.84 0 30.93-13.2 30.93-33.76-.02-11.08-3.83-17.8-9.67-23.19zm-55.15-33.5h30.82a9.57 9.57 0 0 1 9.54 9.53v4.52a9.56 9.56 0 0 1-9.54 9.52h-30.82zm42.62 59.5a9.55 9.55 0 0 1-9.52 9.53h-33.1v-23.58H222a9.56 9.56 0 0 1 9.52 9.54zM210.32 77.52H206.56a118.86 118.86 0 0 0-101.42 180.2l-20.61 63.42 64.87-20.84a118.27 118.27 0 0 0 57.16 14.82h.35c1.14 0 2.28 0 3.41-.05a118.82 118.82 0 0 0 0-237.55zm0 218.22c-1.25.06-2.5.08-3.76.08a98.73 98.73 0 0 1-54.76-16.48l-37.38 12.14 12.22-36.09a99.2 99.2 0 0 1 79.92-158c1.26 0 2.51 0 3.76.08a99.19 99.19 0 0 1 0 198.24zM244 198.16c5-5.92 6.75-10.81 6.75-22 0-16.48-11.72-32.77-29.69-32.77h-46.12c-5.85 0-7.6 3.37-7.6 7.68v95.08c0 6.24 3.29 8.92 9 8.92h46.4c14.84 0 30.93-13.2 30.93-33.76-.02-11.04-3.83-17.76-9.67-23.15zm-55.13-33.46h30.82a9.57 9.57 0 0 1 9.54 9.53v4.52a9.56 9.56 0 0 1-9.54 9.52h-30.82zm42.62 59.5a9.55 9.55 0 0 1-9.52 9.53h-33.1v-23.58H222a9.56 9.56 0 0 1 9.52 9.54zm12.53-26c5-5.92 6.75-10.81 6.75-22 0-16.48-11.72-32.77-29.69-32.77h-46.14c-5.85 0-7.6 3.37-7.6 7.68v95.08c0 6.24 3.29 8.92 9 8.92h46.4c14.84 0 30.93-13.2 30.93-33.76-.02-11.08-3.83-17.8-9.67-23.19zm-55.15-33.5h30.82a9.57 9.57 0 0 1 9.54 9.53v4.52a9.56 9.56 0 0 1-9.54 9.52h-30.82zm42.62 59.5a9.55 9.55 0 0 1-9.52 9.53h-33.1v-23.58H222a9.56 9.56 0 0 1 9.52 9.54zm12.53-26c5-5.92 6.75-10.81 6.75-22 0-16.48-11.72-32.77-29.69-32.77h-46.14c-5.85 0-7.6 3.37-7.6 7.68v95.08c0 6.24 3.29 8.92 9 8.92h46.4c14.84 0 30.93-13.2 30.93-33.76-.02-11.08-3.83-17.8-9.67-23.19zm-55.15-33.5h30.82a9.57 9.57 0 0 1 9.54 9.53v4.52a9.56 9.56 0 0 1-9.54 9.52h-30.82zm42.62 59.5a9.55 9.55 0 0 1-9.52 9.53h-33.1v-23.58H222a9.56 9.56 0 0 1 9.52 9.54z"
                                    opacity="1" data-original="#ffffff" class=""></path>
                                <path
                                    d="M409 204.49v2.69c0 1.69-.06 3.38-.12 5.06v.39c0 .85-.07 1.7-.11 2.55A204.52 204.52 0 0 1 210.4 408.91h-.08V.09a204.51 204.51 0 0 1 198.53 196.5c.07 1.75.11 3.5.13 5.26.02.88.02 1.76.02 2.64z"
                                    opacity="1" fill="#00000017" data-original="#00000017" class=""></path>
                            </g>
                        </g>
                    </svg>
                    <h2 class="ps-2 WhatAppConnectionHeadingText">WhatApp Connection
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row justify-content-center mt-4">

            <div
                class="modal-body-card col-4 flex-column justify-content-between mx-4 second-card comon-card position-relative">
                <div class="col-12">

                    <div class="align-items-end d-flex col-12 my-2">
                        <div class="col-12">
                            <h6 class="modal-body-title">Phone Number ID<sup class="validationn">*</sup></h6>
                            <input type="number" class="form-control main-control PhoneNumberID" id="" name=""
                                placeholder="Enter Phone Number ID" required="">
                        </div>
                    </div>
                    <div class="col-12">
                        <h6 class="modal-body-title">WhatApp Business Account ID<sup class="validationn">*</sup></h6>
                        <input type="number" class="form-control main-control WhatAppBAID" id="" name=""
                            placeholder="Enter WhatApp Business Account ID" required="">
                    </div>
                    <div class="col-12">
                        <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                        <textarea type="text" class="form-control main-control AccessTokenInput" id="" name=""
                            placeholder="Enter Access Token" required=""></textarea>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end ms-2 mt-3 justify-content-center align-items-center">
                    <button type="button" class="btn-primary mx-2" id="SubmitWhatAppIntegrationData"
                        name="">Submit</button>
                        
                    <span class="whatapp_verification_status_class mx-1" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0"
                            viewBox="0 0 2.54 2.54" style="enable-background:new 0 0 512 512" xml:space="preserve"
                            fill-rule="evenodd" class="">
                            <g>
                                <circle cx="1.27" cy="1.27" r="1.27" fill="#00ba00" opacity="1" data-original="#00ba00"
                                    class=""></circle>
                                <path fill="#ffffff"
                                    d="M.873 1.89.41 1.391a.17.17 0 0 1 .008-.24.17.17 0 0 1 .24.009l.358.383.567-.53a.17.17 0 0 1 .016-.013l.266-.249a.17.17 0 0 1 .24.008.17.17 0 0 1-.008.24l-.815.76-.283.263-.125-.134z"
                                    opacity="1" data-original="#ffffff"></path>
                            </g>
                        </svg>
                    </span>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="20" height="20" x="0" y="0" viewBox="0 0 512 512"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path fill="#f44336"
                                d="M256 0C114.836 0 0 114.836 0 256s114.836 256 256 256 256-114.836 256-256S397.164 0 256 0zm0 0"
                                opacity="1" data-original="#f44336" class=""></path>
                            <path fill="#fafafa"
                                d="M350.273 320.105c8.34 8.344 8.34 21.825 0 30.168a21.275 21.275 0 0 1-15.086 6.25c-5.46 0-10.921-2.09-15.082-6.25L256 286.164l-64.105 64.11a21.273 21.273 0 0 1-15.083 6.25 21.275 21.275 0 0 1-15.085-6.25c-8.34-8.344-8.34-21.825 0-30.169L225.836 256l-64.11-64.105c-8.34-8.344-8.34-21.825 0-30.168 8.344-8.34 21.825-8.34 30.169 0L256 225.836l64.105-64.11c8.344-8.34 21.825-8.34 30.168 0 8.34 8.344 8.34 21.825 0 30.169L286.164 256zm0 0"
                                opacity="1" data-original="#fafafa" class=""></path>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>



<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    function GetWhatAppIntegrationInformation() {
            $.ajax({
                method: "post",
                url: "GetWhatAppIntegrationInformation",
                data: {
                    id : "",
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if(response.whatapp_phone_number_id != '0' && response.whatapp_phone_number_id != ''){
                        $('.PhoneNumberID').val(response.whatapp_phone_number_id);
                    }
                    if(response.whatapp_business_account_id != '0' && response.whatapp_business_account_id != ''){
                        $('.WhatAppBAID').val(response.whatapp_business_account_id);
                    }
                    if(response.whatapp_access_token != ''){
                        $('.AccessTokenInput').val(response.whatapp_access_token);
                    }
                    $('.whatapp_verification_status_class').html('');
                    if(response.whatapp_verification_status != ''){
                        if(response.whatapp_verification_status == '0'){
                            var setsubhtml  = '';

                        }
                        if(response.whatapp_verification_status == '1'){

                        }
                        if(response.whatapp_verification_status == '2'){

                        }
                    }
                    // whatapp_verification_status
                },
            });
    }
    GetWhatAppIntegrationInformation();
    $('body').on('click', '#SubmitWhatAppIntegrationData', function(){
        var PhoneNumberID = $('.PhoneNumberID').val();
        var WhatAppBAID = $('.WhatAppBAID').val();
        var AccessTokenInput = $('.AccessTokenInput').val();
        if (PhoneNumberID != '' || WhatAppBAID != '' || AccessTokenInput != "") {
            $.ajax({
                method: "post",
                url: "SubmitWhatAppIntegrationResponse",
                data: {
                    'whatapp_phone_number_id': PhoneNumberID,
                    'whatapp_business_account_id': WhatAppBAID,
                    'whatapp_access_token': AccessTokenInput,
                },
                success: function (res) {
               
                },
            });
        }
    });


    $('body').on('click', '.WhatAppConnectionHeadingText', function(){
        $.ajax({
                method: "post",
                url: "GetWhatAppTemplateList",
                data: {
                    'action' : 'list',
                },
                success: function (res) {
               
                },
            });
        // alert();
    });


</script>