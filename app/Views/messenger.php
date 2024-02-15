<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername();

$WhatsAppAccountsData = json_decode($WhatsAppAccounts, true);

?>

<style>
    body {
        background-color: #f3f3f3;
    }

    .fs-12 {
        font-size: 12px;
    }

    .form-control:focus {
        box-shadow: 0px 0px 0px black;
    }

    .account-nav {
        cursor: pointer;
        background-color: white;
        overflow: hidden;
    }

    .account_icon {
        background-color: #f3f3f3;
        height: 40px;
        width: 40px;
        overflow: hidden;
        background-position: center;
        align-self: center;
    }

    .chat_loader {
        display: block;
        --height-of-loader: 4px;
        --loader-color: #0071e2;
        width: 130px;
        height: var(--height-of-loader);
        border-radius: 30px;
        background-color: rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .chat_loader::before {
        content: "";
        position: absolute;
        background: var(--loader-color);
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        border-radius: 30px;
        animation: moving 1s ease-in-out infinite;
    }

    .active-tab {
        background-color: #007145;
    }

    @keyframes moving {
        50% {
            width: 100%;
        }

        100% {
            width: 0;
            right: 0;
            /* left: unset; */
        }
    }

    .account-box {
        background-color: white;
    }

    .active-account-box {
        background-color: #eaeaea9c;
        border-right: 1px solid #b55dcd;
    }

    .chat-account-box {
        background-color: white;
    }

    .chat-account-active {
        background-color: #eaeaea9c;
        border-right: 2px solid #724ebf;
    }
</style>


<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="fa-solid fa-message"></i>
                <h2>Messenger</h2>
            </div>

            <div class="col-12 d-flex flex-wrap mt-2">

                <!-- <div class="col-12 border bg-white p-3">
                    <nav class="nav">
                        <a class="nav-link bg-dark-subtle text-emphasis-dark" aria-current="page" href="#">All Messanger</a>
                        <a class="nav-link" href="#">Messanger</a>
                        <a class="nav-link" href="#">Instragram</a>
                        <a class="nav-link" href="#">Whatsapp</a>
                        <a class="nav-link" href="#">facebook</a>
                    </nav>
                </div> -->

                <div class="col-4 col-sm-5 col-md-6 col-lg-3 col-xl-2 col-xxl-3" style="height:80vh">
                    <div class="col-12 border rounded-start-4 bg-white position-lg-relative" style="height:80vh">
                        <div class="chat-nav-search-bar p-2 col-12 mt-2">
                            <div class="d-flex justify-content-between align-items-center border-bottom">
                                <div class="dropdown d-flex align-items-center ps-2 pb-2">
                                    <i class="fa-solid fa-user fs-5 me-2"></i>
                                    <h5 class="fs-5 fw-semibold">Social Media Accounts</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-y-scroll ms-1" style="max-height: 100%;">
                            <div class="accordion mt-2" id="accordionExample">
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button border-0 shadow-none fw-medium" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa-brands fa-facebook fa-2xl me-2"></i>
                                            <P>Facebook</P>

                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body account_list p-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed border-0 shadow-none fw-medium"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fa-brands fa-instagram fa-2xl me-2"></i>
                                            <P>instagram</P>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body IG_account_list p-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed border-0 shadow-none fw-medium"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <i class="fa-brands fa-whatsapp fa-2xl me-2"></i>
                                            <P>Whatsapp</P>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        
                                        <?php

                                        if (isset($WhatsAppAccountsData) && !empty($WhatsAppAccountsData)) {
                                            foreach ($WhatsAppAccountsData as $key => $value) {
                                                echo '<div class="accordion-body  WA_account_list  WA_account_listTab p-0 account-box" id ="' . $value['id'] . '" phoneno = "' . $value['display_phone_number'] . '" name="' . $value['verified_name'] . '"> 
                                                <div class="col-12  my-2 " data-page_id="17841457874373728" data-platform="instagram" data-page_access_token="EAADNF4vVgk0BO6ZBcyZCiZCY5FGuPPWKb7npn8YcXafmqIexQxBgMPRZAAttSOgFr6NqP2B74icpZAcvL5pJgwv4ZBdTsM4Neik41DvLdjprcNSGdIfty83qi5CkzEAyuXUeEYVQf9lNRy9GtaDhFZBYBpKKyZCkfGqAB6wcfP8cvcx8mjcXrbpYEfbq0XYucWT81gzkkywZD" data-page_name="ajasystechnologies">
                                                    <div class="col-12 d-flex flex-wrap  align-items-center  p-2">
                                                            <img src="https://erp.gymsmart.in/assets/image/member.png" class="col-4 account_icon border border-1 rounded-circle me-2 align-self-center text-center" alt="" height="100" width="100">
                                                         <div class="ps-2">
                                                            <p class="fs-6 fw-medium col">' . $value['verified_name'] . '</p>
                                                            <span class="fs-12 text-muted">+ 91 990234523</span>
                                                         </div>   
                                                    </div>
                                        </div>
</div>';
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-auto acc_loader text-center text-center position-absolute top-0 end-0 bottom-0 start-0"
                            style="">
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center"
                                style="z-index:555">
                                <div>
                                    <span>Loading...</span>
                                    <div class="mx-auto chat_loader"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center d-none">
                            <p class="fw-semibold fs-5">No Any Record Found</p>
                        </div>
                    </div>
                </div>

                <div class="col-8 col-sm-7 col-md-6 col-lg-3 col-xl-3 col-xxl-3 chat-box" style="height:80vh">
                    <div class="col-12 border  bg-white position-relative" style="height:80vh">
                        <div class="chat-nav-search-bar p-2 col-12 mt-2">
                            <div class="d-flex justify-content-between border-bottom align-items-center">
                                <div class="dropdown d-flex align-items-center ps-2 pb-2">
                                    <i class="fas fa-comment fs-5  me-2"></i>
                                    <h5 class="fs-5 w-semibold">Chats</h5>
                                </div>
                                <div class="">
                                    <p class="page_name p-1 "></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-y-scroll scroll-sm chat_list p-1" style="max-height: 100%;">
                            
                        </div>
                        <!-- <div class="m-auto  text-center">
                            <span>Loading...</span>
                            <div class="mx-auto chat_loader"></div>
                        </div> -->
                        <div
                            class="m-auto chat_list_loader text-center text-center position-absolute top-0 end-0 bottom-0 start-0">
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center"
                                style="z-index:555">
                                <div>
                                    <span>Loading...</span>
                                    <div class="mx-auto chat_loader"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center col-12 overflow-y-scroll p-3 ChatListSetHTML chatNoData">No Chats Found!</div>
                        <!-- <div class="col-12 overflow-y-scroll chat_list p-2" style="max-height: 100%;">
                            <div class="col-12 text-center">
                                <p class="fs-5 fw-medium mt-5">No Record Found</p>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7 col-xxl-6   transcript_box"
                    style="height:80vh">
                    <div class="col-12 border rounded-end-4 bg-white position-relative" style="height:80vh">
                        <div class="justify-content-center col-12 position-absolute bottom-0 start-0 mb-2 px-3">
                            <div class="d-flex flex-wrap bg-white rounded-pill py-1 border">
                                <div class="input-group  position-relative ">
                                    <input type="text"
                                        class="form-control rounded-pill px-4 py-2 border-0 massage_input"
                                        placeholder="Write a message...">
                                    <button class="btn btn-primary rounded-circle me-1 px-3 SendWhatsAppMessage send_massage"
                                        data-conversion_id="" data-page_token="" data-page_id="" data-massage_id="">
                                        <i class="fa-regular fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="chat-nav-search-bar p-2 mt-2 col-12">
                            <div class="d-flex justify-content-between border-bottom align-items-center">
                                <h5 class="fs-5 d-flex ps-2 pb-2 align-items-center">
                                    <i class="fa-solid fa-circle-user fs-3 me-2"></i>
                                    <span class="d-flex flex-wrap">
                                        <span class="username col-12 d-block UserChatName">User Name</span>
                                        <span class="in_chat_page_name fs-12 col-12 d-block"></span>
                                    </span>
                                </h5>
                                <button class="bg-transparent border-0">
                                <i class="fa-regular fa-star"></i></button>
                            </div>
                        </div>

                        <div class="main-task left-main-task mt-2 p-2 overflow-y-scroll chat_bord col-12"
                            style="max-height:80%;">
                            <!-- <div class="d-flex  mb-1 col-3">
                                <i class="me-2 bi bi-people-fill"></i>
                                <a href="" class="ms-3">https://www.facebook.com/</a>
                            </div>
                            <div class="d-flex  mb-1 col-3">
                                <i class="me-2 bi bi-telephone-fill"></i>
                                <p class="ms-3">9780567980</p>
                            </div>
                            <div class="d-flex  mb-1 col-3">
                                <i class="me-2 bi bi-whatsapp"></i>
                                <p class="ms-3">urvi Test</p>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex mb-4 justify-content-end">
                                    <div class="col-6 text-end">
                                        <span class="px-3 py-2 rounded-3 text-white" style="background:#724EBF;">Hello</span>
                                    </div>
                                </div>

                                <div class="d-flex mb-4">
                                    <div class="col-6 text-start">
                                        <span class="px-3 py-2 rounded-3 " style="background:#f3f3f3;">undefined, This is an
                                            <b>appointment booking</b> demo bot🙂.</span>
                                    </div>
                                </div>

                                <div class="d-flex mb-4">
                                    <div class="col-6 text-start">
                                        <span class="px-3 py-2 rounded-3 " style="background:#f3f3f3;">What is your full
                                            name ?</span>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                        <div
                            class="m-auto massage_list_loader text-center position-absolute top-0 end-0 bottom-0 start-0">
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center"
                                style="z-index:555">
                                <div>
                                    <span>Loading...</span>
                                    <div class="mx-auto chat_loader"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center col-12 overflow-y-scroll p-3 noRecourdFound">No Chats Found!</div>
                        <!-- <div class="col-12 overflow-y-scroll p-2 noRecourdFound" style="max-height: 100%;">
                            <div class="col-12 text-center">
                                <p class="fs-5 fw-medium mt-5 d-block">No Record Found</p>
                            </div>
                        </div> -->

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>







<?= $this->include('partials/footer') ?>


<script>

    $('body').on('click', '.account-box', function () {

        $(this).addClass('active-account-box');
        $(this).siblings().removeClass('active-account-box');

    });
    $('body').on('click', '.chat-account-box', function () {

        $(this).addClass('chat-account-active');
        $(this).siblings().removeClass('chat-account-active');

    });

</script>
<script>
    $(document).ready(function () {
        // massage list data
        function list_data(api = false, action = 'account_list', page_id = '', page_access_token = '', platform) {
            $.ajax({
                method: "post",
                url: "<?= site_url('get_chat_data'); ?>",
                data: {
                    action: action,
                    api: api,
                    page_id: page_id,
                    page_access_token: page_access_token,
                    platform: platform,
                },
                beforeSend: function () {
                    if (action == 'account_list') {
                        $('.acc_loader').show();
                    } else if (action == 'chat_list') {
                        $('.chat_list').html('');
                        $('.chat_list_loader').show();
                    }
                },
                success: function (data) {
                    $('.acc_loader').hide();
                    var obj = JSON.parse(data);
                    if (action == 'account_list') {
                        $('.account_list').html(obj.chat_list_html);
                        $('.IG_account_list').html(obj.IG_chat_list_html);
                    } else if (action == 'chat_list') {
                        $('.chat_list').html(obj.chat_list_html);
                        $('.chat_list_loader').hide();
                        $('.chatNoData').hide();
                    }
                }
            });
        }
        list_data();

        $('.chat_list_loader').hide();

        $('body').on('click', '.account-nav', function () {
            var page_id = $(this).attr("data-page_id");
            var page_access_token = $(this).attr("data-page_access_token");
            var platform = $(this).attr("data-platform");
            var page_name = $('.page_name').text($(this).attr('data-page_name'));

            list_data(false, 'chat_list', page_id, page_access_token, platform);
        });

        $('body').on('click', '.chat_list', function () {
            var conversion_id = $(this).data('conversion_id');
            var page_access_token = $(this).data('page_token');
            var page_id = $(this).data('page_id');
            var user_name = $(this).data('user_name');
            var platform = $(this).data('platform');
            var page_name = $('.page_name').text();
            // var massage_id = $(this).data('massage_id');

            $.ajax({
                method: "post",
                url: "<?= site_url('get_chat_data'); ?>",
                data: {
                    action: 'chat_massage_list',
                    conversion_id: conversion_id,
                    page_access_token: page_access_token,
                    page_id: page_id,
                    // id: massage_id,
                },
                beforeSend: function () {
                    $('.massage_list_loader').show();
                    $('.noRecourdFound').hide();
                },
                success: function (data) {
                    var obj = JSON.parse(data);
                    $('.massage_list_loader').hide();
                    $('.chat_bord').show();
                    $('.chat_bord').html(obj.html);
                    $('.noRecourdFound').hide();
                    $('.username').text(user_name);
                    $('.in_chat_page_name').text(page_name + '(' + platform + ')');
                    $('.send_massage').attr("data-conversion_id", conversion_id);
                    $('.send_massage').attr("data-page_token", page_access_token);
                    $('.send_massage').attr("data-page_id", page_id);
                    $('.send_massage').attr("data-massage_id", massage_id);
                }
            });

            return false;
        });

        $('.massage_list_loader').hide();

        $('body').on('click', '.send_massage', function () {
            var massage_input = $('.massage_input').val();
            var conversion_id = $(this).attr("data-conversion_id", conversion_id);
            var page_access_token = $(this).attr("data-page_token", page_access_token);
            var page_id = $(this).attr("data-page_id", page_id);
            // var massage_id = $(this).attr("data-massage_id",massage_id);
            // if(massage_input != '' && conversion_id != '' &&  page_access_token != '' &&  page_id != '' &&  massage_id != '') {
            $.ajax({
                method: "post",
                url: "<?= site_url('send_massage'); ?>",
                data: {
                    // action: 'chat_massage_list',
                    // conversion_id: conversion_id,
                    // page_access_token: page_access_token,
                    // page_id: page_id,
                    // id: massage_id,
                },
                success: function (data) {
                    // var obj = JSON.parse(data);
                    // $('.chat_bord').html(obj.html);
                    // $('.send_massage').attr("data-conversion_id",conversion_id);
                    // $('.send_massage').attr("data-page_token",page_access_token);
                    // $('.send_massage').attr("data-page_id",page_id);
                    // $('.send_massage').attr("data-massage_id",massage_id);
                }
            });
            // } 
        });
    });

    $('body').on('click', '.WA_account_listTab', function() {
        $('.chat_bord').html('');
        $('.in_chat_page_name').text('');
        $('.UserChatName').text('User Name');
        $('.chat_list_loader').hide();
        $('.ChatListSetHTML').html('');
        var id = $(this).attr('id');
        $('.SendWhatsAppMessage').attr('DataSenderId', id);
        var phoneno = $(this).attr('phoneno');
        var name = $(this).attr('name');
        $('.page_name').text(name);
        $.ajax({
            method: "post",
            url: "WhatsAppAccountsContactList",
            data: {
                id: id,
                phoneno: phoneno,
                name: name
            },
            success: function(data) {
                $('.chat_list').html(data);
            }
        });
    });

    $('body').on('click', '.ChatClickOpenHtml', function() {
        $('.chat_bord').html('');
        $('.UserChatName').text('User Name');
        $('.in_chat_page_name').text('');

        var contact_no = $(this).attr('contact_no');
        $('.SendWhatsAppMessage').attr('DataPhoneno', contact_no);
        var whatsapp_name = $(this).attr('whatsapp_name');
        var account_phone_no = $(this).attr('account_phone_no');
        var fcontact_no = $(this).attr('fcontact_no');
        $('.massage_list_loader').hide();
        $('.massage_list_loader').hide();
        var fullnameDetail = '';
        if (whatsapp_name != '') {
            fullnameDetail = whatsapp_name + ' (' + fcontact_no + ')';
        } else {
            fullnameDetail = fcontact_no;
        }
        $('.UserChatName').text(fullnameDetail);
        $.ajax({
            method: "post",
            url: "WhatsAppListConverstion",
            data: {
                contact_no: contact_no,
            },
            success: function(data) {
                $('.chat_bord').html(data);
                
            }
        });
    });


    // SendWhatsAppMessage" data-conversion_id="" data-page_token="" data-page_id="" data-massage_id="" DataSenderId
    $('body').on('click', '.SendWhatsAppMessage', function() {
        var DataSenderId = $(this).attr('DataSenderId');
        var DataPhoneno = $(this).attr('DataPhoneno');
        var massage_input = $('.massage_input').val();
        if (DataSenderId !== undefined && DataSenderId !== 'undefined' && DataSenderId != '' && DataPhoneno !== undefined && DataPhoneno !== 'undefined' && DataPhoneno != '' && massage_input != '') {
            $.ajax({
                method: "post",
                url: "SendWhatsAppChatMessage",
                data: {
                    DataSenderId: DataSenderId,
                    DataPhoneno: DataPhoneno,
                    massage_input: massage_input
                },
                success: function(data) {
                    $('.chat_list .active-account-box').trigger('click');
                }
            });
        }
        $('.massage_input').val('');
    });
</script>