<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    .bot9-chat-bubble {
        bottom: 40px;
        right: 10px;
    }

    .fix-card {
        width: 400px;
        height: 400px;
        bottom: 80px;
        right: 50px;
        z-index: 999;
    }
</style>
<div class="bot9-chat-bubble bottom-right position-fixed p-2 rounded-circle" style="background-color: #724EBF;cursor:pointer">
    <span class="icon">
        <span class="feather-icon position-relative w-100 h-100">
            <svg class="bot9-chat-bubble-open-btn bot9-chat-bubble-icon" width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M33.75 6.25H6.25C5.58696 6.25 4.95107 6.51339 4.48223 6.98223C4.01339 7.45107 3.75 8.08696 3.75 8.75V28.75C3.75 29.413 4.01339 30.0489 4.48223 30.5178C4.95107 30.9866 5.58696 31.25 6.25 31.25L15.5469 31.2594L17.8562 35.0359C18.0778 35.4056 18.3912 35.7116 18.7659 35.9244C19.1407 36.1373 19.5641 36.2496 19.995 36.2505C20.426 36.2515 20.8498 36.141 21.2255 35.9298C21.6012 35.7187 21.9159 35.414 22.1391 35.0453L24.4578 31.25H33.75C34.413 31.25 35.0489 30.9866 35.5178 30.5178C35.9866 30.0489 36.25 29.413 36.25 28.75V8.75C36.25 8.08696 35.9866 7.45107 35.5178 6.98223C35.0489 6.51339 34.413 6.25 33.75 6.25ZM13.125 20.625C12.7542 20.625 12.3916 20.515 12.0833 20.309C11.775 20.103 11.5346 19.8101 11.3927 19.4675C11.2508 19.1249 11.2137 18.7479 11.286 18.3842C11.3584 18.0205 11.537 17.6864 11.7992 17.4242C12.0614 17.162 12.3955 16.9834 12.7592 16.911C13.1229 16.8387 13.4999 16.8758 13.8425 17.0177C14.1851 17.1596 14.478 17.4 14.684 17.7083C14.89 18.0166 15 18.3792 15 18.75C15 19.2473 14.8025 19.7242 14.4508 20.0758C14.0992 20.4275 13.6223 20.625 13.125 20.625ZM20 20.625C19.6292 20.625 19.2666 20.515 18.9583 20.309C18.65 20.103 18.4096 19.8101 18.2677 19.4675C18.1258 19.1249 18.0887 18.7479 18.161 18.3842C18.2334 18.0205 18.412 17.6864 18.6742 17.4242C18.9364 17.162 19.2705 16.9834 19.6342 16.911C19.9979 16.8387 20.3749 16.8758 20.7175 17.0177C21.0601 17.1596 21.353 17.4 21.559 17.7083C21.765 18.0166 21.875 18.3792 21.875 18.75C21.875 19.2473 21.6775 19.7242 21.3258 20.0758C20.9742 20.4275 20.4973 20.625 20 20.625ZM26.875 20.625C26.5042 20.625 26.1416 20.515 25.8333 20.309C25.525 20.103 25.2846 19.8101 25.1427 19.4675C25.0008 19.1249 24.9637 18.7479 25.036 18.3842C25.1084 18.0205 25.287 17.6864 25.5492 17.4242C25.8114 17.162 26.1455 16.9834 26.5092 16.911C26.8729 16.8387 27.2499 16.8758 27.5925 17.0177C27.9351 17.1596 28.228 17.4 28.434 17.7083C28.64 18.0166 28.75 18.3792 28.75 18.75C28.75 19.2473 28.5525 19.7242 28.2008 20.0758C27.8492 20.4275 27.3723 20.625 26.875 20.625Z" fill="white"></path>
            </svg>
        </span>
    </span>
</div>
<div class="fix-card bg-white shadow-lg position-fixed d-none  rounded-4 overflow-hidden">
    <div class="mo-header d-flex flex-wrap px-4 pt-4 pb-2 align-items-center" style="background-color: #724EBF;">
        <div class="col-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center border position-relative" style="width:60px;height:60px;">
                <img src="http://localhost/admincampaign//assets/images/profile.png" alt="#" class="w-100 h-100">
                <div class="position-absolute bg-success end-0 bottom-0 rounded-circle" style="width:5px; height:5px;"></div>
            </div>
        </div>
        <div class="col-9">
            <h4 class="text-white">Client Chat</h4>
            <span class="text-white">online</span>
        </div>
    </div>

    <div class="mo-body p-4 overflow-y-scroll registrarion_bot_hide" style="max-height:250px;">
        <form class="formsize needs-validation" name="registration_form" novalidate="">
            <div class="add-user-input">
                <label class="main-label">Enter Your name <sup class="text-danger fs-6">*</sup></label>
                <input type="text" id="client_name" name="" class="form-control main-control" placeholder="Enter Fullname" value="" data-firstname_id="" required="">
            </div>

            <div class="add-user-input">
                <label class="main-label">Enter Your Email<sup class="text-danger fs-6">*</sup></label>
                <input type="email" class="form-control main-control email" id="client_email" name="" placeholder="Enter Email Address" value="" data-email_id="" required="">
            </div>

            <div class="add-user-input">
                <label class="main-label">Enter Your Phone No.<sup class="text-danger fs-6">*</sup></label>
                <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="10" maxlength="10" class="form-control main-control number_value_only phoneno" id="client_phone" name="" placeholder="Mobile No." value="" data-phone_id="" required="">
            </div>
        </form>
    </div>

    <div class="add-user-input py-4 text-end me-4 registrarion_bot_hide pt-3 pe-2" style="margin-top:-10px">
        <button class="border-0 bg-transparent registarion_chat" data_insertedData="">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <linearGradient id="a" x1="256" x2="256" y1="512" y2="0" gradientUnits="userSpaceOnUse">
                        <stop stop-opacity="1" stop-color="#724ebf" offset="0"></stop>
                        <stop stop-opacity="1" stop-color="#724ebf" offset="0.14322468159612217"></stop>
                        <stop stop-opacity="1" stop-color="#724ebf" offset="0.3863636149494621"></stop>
                        <stop stop-opacity="1" stop-color="#724ebf" offset="0.44811318532491345"></stop>
                        <stop stop-opacity="1" stop-color="#724ebf" offset="0.6642366816389934"></stop>
                        <stop stop-opacity="1" stop-color="#724ebf" offset="0.9614064890708532"></stop>
                    </linearGradient>
                    <path fill="url(#a)" d="M15 271h92c8.284 0 15-6.716 15-15s-6.716-15-15-15H15c-8.284 0-15 6.716-15 15s6.716 15 15 15zm0-60h62c8.284 0 15-6.716 15-15s-6.716-15-15-15H15c-8.284 0-15 6.716-15 15s6.716 15 15 15zm62 90H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h62c8.284 0 15-6.716 15-15s-6.716-15-15-15zm427.885-57.76-390-241a15 15 0 0 0-21.937 18.008l86.961 232.862a14.834 14.834 0 0 0 0 5.78L92.948 491.752a15.001 15.001 0 0 0 21.937 18.008l390-241a15 15 0 0 0 0-25.52zM136.376 461.214 207.41 271H377c8.284 0 15-6.716 15-15s-6.716-15-15-15H207.41L136.376 50.786 468.466 256z" opacity="1" data-original="url(#a)" class=""></path>
                </g>
            </svg>
        </button>
    </div>


    <div class="mo-body p-4 overflow-y-scroll rounded-2 registrarion_bot_show" style="max-height:250px;">
        <div class="bot-msg-bg-color-bg p-4" style="background-color: #82a7de3d;">
            <div class="msg-content">
                <p>Hi there! 👋, <br><br>Welcome to live chat support. <br><br>How can we help you today?</p>
            </div>
        </div>
        <span class="chat-time d-inline-block text-muted" style="font-size:14px; " id="current-time">
        </span>

        <script>
            var currentTime = new Date();
            var formattedTime = currentTime.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('current-time').innerText = formattedTime;
        </script>
    </div>


    <div class="mo-footer border-top ask_question">
            <div class="input-group position-relative" style="overflow: auto;">
            <div class="col-12">
                <textarea rows="1" type="text" id="standalone_chat_popup" name="send-msg" class="p-3 input-msg-send form-control border-0 shadow-none" placeholder="ask a question..."></textarea>
            </div>
                <div class="bg-transparent input-group-text overflow-show border-0 position-absolute top-50 end-0 col-2" style="z-index: 10;transform: translateY(-43%);">
                  
                    <button class="border-0 bg-transparent chatting_data" id="chatting_data" data_insertedData="">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <linearGradient id="a" x1="256" x2="256" y1="512" y2="0" gradientUnits="userSpaceOnUse">
                                    <stop stop-opacity="1" stop-color="#724ebf" offset="0"></stop>
                                    <stop stop-opacity="1" stop-color="#724ebf" offset="0.14322468159612217"></stop>
                                    <stop stop-opacity="1" stop-color="#724ebf" offset="0.3863636149494621"></stop>
                                    <stop stop-opacity="1" stop-color="#724ebf" offset="0.44811318532491345"></stop>
                                    <stop stop-opacity="1" stop-color="#724ebf" offset="0.6642366816389934"></stop>
                                    <stop stop-opacity="1" stop-color="#724ebf" offset="0.9614064890708532"></stop>
                                </linearGradient>
                                <path fill="#724EBF" d="M15 271h92c8.284 0 15-6.716 15-15s-6.716-15-15-15H15c-8.284 0-15 6.716-15 15s6.716 15 15 15zm0-60h62c8.284 0 15-6.716 15-15s-6.716-15-15-15H15c-8.284 0-15 6.716-15 15s6.716 15 15 15zm62 90H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h62c8.284 0 15-6.716 15-15s-6.716-15-15-15zm427.885-57.76-390-241a15 15 0 0 0-21.937 18.008l86.961 232.862a14.834 14.834 0 0 0 0 5.78L92.948 491.752a15.001 15.001 0 0 0 21.937 18.008l390-241a15 15 0 0 0 0-25.52zM136.376 461.214 207.41 271H377c8.284 0 15-6.716 15-15s-6.716-15-15-15H207.41L136.376 50.786 468.466 256z" opacity="1" data-original="url(#a)" class=""></path>
                            </g>
                        </svg>
                    
                    </button>

                </div>
            </div>
            <input type="text" hidden value="" class="store_conversiton_div" />
    </div>

</div>


<div class="main-dashbord">
    <div class="container-fluid">
        <div class="row row-main">
            <div class="col-11">
                <h4>Messenger & Bot</h4>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <a href="#" class="btn-primary-rounded"><i class="bi bi-plus-lg add-panel-plus"></i></a>
            </div>
        </div>
        <div class="card card-menu add-panel">
            <div class="card-main">
                <div class="row row-line">
                    <div class="col-12">
                        <form class="formsize needs-validation" name="occupation_form" novalidate="">
                            <div class="row justify-content-start align-items-end">
                                <div class="col-lg-4 col-md-4 col-sm-6">


                                    <label for="occupationname" class="form-label form-labell form-name">Add Occupation</label>
                                    <input type="text" class="form-control form-controll" id="occupation_details" name="occupation_details" placeholder="Occupation Name" required="">


                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <label for="occupationname" class="form-label form-labell form-name">Occupation
                                        Category</label>
                                    <div class="d-flex form-control main-form p-0">
                                        <div class="dropdown bootstrap-select form-control">
                                            <select name="occupation_category" id="occupation_category" class="selectpicker form-control form-main" data-live-search="true" tabindex="-98" required="">
                                                <option class="dropdown-item" value="">Select Action</option>
                                                <option class="dropdown-item" data-sourcetype_name="self_employee" value="self employee">Self employee</option>
                                                <option class="dropdown-item" data-sourcetype_name="self_employee" value="Employee"> Employee</option>
                                                <option class="dropdown-item" data-sourcetype_name="self_employee" value="Bussiness">Bussiness</option>
                                            </select>
                                            <div class="dropdown-menu " role="combobox">
                                                <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search">
                                                </div>
                                                <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                                    <ul class="dropdown-menu inner show"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <button class="btn btn-submit" name='occupation_add' value="occupation-add" type="submit" id="ocupation-submit">Add Occupation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="occupation_view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="needs-validation" name="occupationname_update_form" method="POST" novalidate="">
                <div class="modal-header modal-headerr pt-2 pb-2">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Occupation</h4>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row g-2">
                                <div class="col-6">
                                    <label for="departmentname" class="form-label form-labell">Occuption Details</label>
                                    <input type="text" class="form-control form-controll" id="occupation_details" name="occupation_details" placeholder="Details" required="">
                                </div>
                                <div class="col-6">
                                    <label for="shortdepartmentname" class="form-label form-labell">Occuption Category</label>
                                    <div class="d-flex form-control main-form p-0">
                                        <div class="dropdown bootstrap-select form-control">
                                            <select name="occupation_category" id="occupation_category" class="selectpicker form-control form-main" data-live-search="true" required="" tabindex="-98">
                                                <option class="dropdown-item" value="">Select Action</option>
                                                <option class="dropdown-item" data-sourcetype_name="self_employee" value="self employee">Self employee</option>
                                                <option class="dropdown-item" data-sourcetype_name="self_employee" value="Employee">
                                                    Employee</option>
                                                <option class="dropdown-item" data-sourcetype_name="self_employee" value="Bussiness">Bussiness</option>
                                            </select>
                                            <div class="dropdown-menu " role="combobox">
                                                <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search">
                                                </div>
                                                <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                                    <ul class="dropdown-menu inner show"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <div class="modal-footer modal-footer2">
                    <a class="delete-tools me-0" href="javascript:void(0)">
                        <span class="delete"><i class="bi bi-trash3 me-2"></i>Delete</span>
                        <span class="really" data-delete_id="">Really ?</span>
                    </a>
                    <button class="btn btn-submit occupation_view ms-0" id="occupation_view_btn" data-edit_id="" name="occupation_view" value="occupation_view">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('body').on('click', '.bot9-chat-bubble', function() {
        $('.fix-card').slideToggle();
        $('.fix-card').toggleClass('d-none');
        // $('.fix-card').slideUp('d-none');
    })
</script>

<script>
    // function list_data() {
    //     $.ajax({
    //         datatype: 'json',
    //         method: "post",
    //         url: "<?= site_url('messeging_bot_list'); ?>",
    //         data: {
    //             'table': 'messeging_bot',
    //             'action': true
    //         },
    //         success: function (response) {
    //             $(".registrarion_bot_show").show();
    //         }
    //     });
    // }
    // list_data();


    // $(".registrarion_bot_show").hide();
    // $(".registarion_chat").on('click', function(e) {
    //     // alert();
    //     e.preventDefault();
    //     var form = $("form[name='registration_form']")[0];
    //     var client_name = $('#client_name').val();
    //     var client_email = $('#client_email').val();
    //     var client_phone = $('#client_phone').val();
    //     var formdata = new FormData(form);
    //     // console.log(client_phone);

    //     if (client_name != "" && client_email != "" && client_phone != "") {
    //         var formdata = new FormData(form);
    //         formdata.append('action', 'insert');
    //         formdata.append('table', 'messeging_bot');
    //         formdata.append('client_name', client_name);
    //         formdata.append('client_email', client_email);
    //         formdata.append('client_phone_no', client_phone);
    //         // formdata.append('details_add', '1');

    //         $('.loader').show();

    //         $.ajax({
    //             method: "post",
    //             url: "<?= site_url('messenging_bot_insert_data'); ?>",
    //             data: formdata,
    //             processData: false,
    //             contentType: false,
    //             success: function(data) {
    //                 // console.log(data);
    //                 var response = JSON.parse(data);
    //                 if (response.status === "success") {
    //                     $("form[name='registration_form']")[0].reset();
    //                     $("form[name='registration_form']").removeClass("was-validated");
    //                     $('.loader').hide();
    //                     iziToast.success({
    //                         title: 'Added Successfully'
    //                     });
    //                     $(".registrarion_bot_hide").hide();
    //                     $(".registrarion_bot_show").show();
    //                 } else {
    //                     $('.loader').hide();
    //                     iziToast.error({
    //                         title: 'Duplicate data'
    //                     });
    //                 }
    //             },
    //         });
    //     } else {
    //         $("form[name='registration_form']").addClass("was-validated");
    //     }
    // });


    $(".registarion_chat").on('click', function(e) {
        e.preventDefault();
        var form = $("form[name='registration_form']")[0];
        var client_name = $('#client_name').val();
        var client_email = $('#client_email').val();
        var client_phone = $('#client_phone').val();

        var table = '<?php echo getMasterUsername2(); ?>_messeging_bot';
        var formdata = new FormData(form);

        if (client_name != "" && client_email != "" && client_phone != "") {
            var formdata = new FormData(form);
            formdata.append('action', 'insert');
            formdata.append('table', table);
            formdata.append('client_name', client_name);
            formdata.append('client_email', client_email);
            formdata.append('client_phone_no', client_phone);

            $('.loader').show();

            $.ajax({
                method: "post",
                url: "<?= site_url('messenging_bot_insert_data'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status === "success") {
                        insertedData = response.insertedData;
                        $('.chatting_data').data('insertedData', insertedData);
                        $('.registarion_chat').attr('data_insertedData', insertedData);
                        // console.log(insertedData);
                        formdata.append('status', response.userStatus);

                        $("form[name='registration_form']")[0].reset();
                        $("form[name='registration_form']").removeClass("was-validated");
                        $('.loader').hide();
                        iziToast.success({
                            title: 'Added Successfully'
                        });
                        list_data_s();
                    }else if (response.status === "duplicate") {
                        // existingUserData = response.existingUserData;
                        
                        // var insertedData = existingUserData[0].id;
                        // $('.chatting_data').data('insertedData', insertedData);
                        
                        $('.loader').hide();
                        iziToast.success({
                            title: 'Register Successfully'
                        });
                        $(".registrarion_bot_hide").hide();
                        $(".registrarion_bot_show").show();
                        // list_data_s();
                    } else {
                        $('.loader').hide();
                        iziToast.error({
                            title: 'Error'
                        });
                    }
                },
            });
        } else {
            $("form[name='registration_form']").addClass("was-validated");
        }
    });


    function list_data_s() {
        var user_id = $('.store_listdata_id').attr('user_id');
        var insertedData = $('.chatting_data').data('insertedData');
        var table = '<?php echo getMasterUsername2(); ?>_messeging_bot';
        // console.log(insertedData);
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('messeging_bot_list_data'); ?>",
            data: {
                'table': table,
                'action': true,
                user_id: insertedData
            },
            success: function(res) {
                // console.log(res);
                $('.loader').hide();
                $(".registrarion_bot_hide").hide();
                $('.registrarion_bot_show').html(res);
                $('#standalone_chat_popup').val("");
                // datatable_view_first(res);
            }
        });
    }

    var insertedData;
    var chatArray = [];
    $('body').on('click', '.chatting_data', function (e) {
        e.preventDefault();
        var insertedData = $(this).data('insertedData');
        var chatting = $('#standalone_chat_popup').val();
        var table = '<?php echo getMasterUsername2(); ?>_messeging_bot';
        if (chatting !== "") {
            chatArray.push(chatting);
            $.ajax({
                method: "post",
                url: "<?= site_url('update_data_conversion'); ?>",
                data: {
                    edit_id: insertedData,
                    table: table,
                    action: "update",
                    chat: chatting,
                },
                success: function (res) {
                
                    $('.store_conversiton_div').val(res);
                    $('#standalone_chat_popup').val("");
                    list_data_s();
                    // setTimeout(() => {
                    //     scrollToBottom();
                    // }, 400);
                }
            });
        }
    });


    var input = document.getElementById("standalone_chat_popup");
    input.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("chatting_data").click();
        }
    });

    // function scrollToBottom() {
    //     const fileViewDiv = document.getElementById('registrarion_bot_show');
    //     fileViewDiv.scrollTop = fileViewDiv.scrollHeight;
    // }

    // function datatable_view_first(html) {
    //     $('.registrarion_bot_show .ask_question').html(html);
    // }

   

</script>