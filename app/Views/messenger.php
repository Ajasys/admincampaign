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
                                    <h5 class="fs-5 fw-semibold">Social Accounts</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-y-scroll ms-1" style="max-height: 100%;">
                            <div class="accordion mt-2" id="accordionExample">
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button border-0 shadow-none fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa-brands fa-facebook fa-2xl me-2"></i>
                                            <P>Facebook</P>

                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body account_list p-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed border-0 shadow-none fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fa-brands fa-instagram fa-2xl me-2"></i>
                                            <P>instagram</P>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body IG_account_list p-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed border-0 shadow-none fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
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
                        <div class="m-auto acc_loader text-center text-center position-absolute top-0 end-0 bottom-0 start-0" style="">
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center" style="z-index:555">
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
                        <div class="col-12 overflow-y-scroll scroll-sm chat_list p-1 d-none" style="max-height: 100%;">
                            <div class="chat-nav-search-bar p-1 border  my-2 col-12">
                                <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <path fill="#eceff1" d="M20.52 3.449C18.24 1.245 15.24 0 12.045 0 2.875 0-2.883 9.935 1.696 17.838L0 24l6.335-1.652c2.76 1.491 5.021 1.359 5.716 1.447 10.633 0 15.926-12.864 8.454-20.307z" opacity="1" data-original="#eceff1" class=""></path>
                                                <path fill="#4caf50" d="m12.067 21.751-.006-.001h-.016c-3.182 0-5.215-1.507-5.415-1.594l-3.75.975 1.005-3.645-.239-.375a9.869 9.869 0 0 1-1.516-5.26c0-8.793 10.745-13.19 16.963-6.975 6.203 6.15 1.848 16.875-7.026 16.875z" opacity="1" data-original="#4caf50"></path>
                                                <path fill="#fafafa" d="m17.507 14.307-.009.075c-.301-.15-1.767-.867-2.04-.966-.613-.227-.44-.036-1.617 1.312-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.293-.506.32-.578.878-1.634.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.576-.05-.997-.042-1.368.344-1.614 1.774-1.207 3.604.174 5.55 2.714 3.552 4.16 4.206 6.804 5.114.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345z" opacity="1" data-original="#fafafa"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-6 fw-semibold">whatsapp user name
                                        </p>
                                        <div class="text-end">
                                            <span class="fs-12">a day ago</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="chat-nav-search-bar p-2 border border-2 my-2 col-12  rounded-3">
                                <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <g data-name="Layer 2">
                                                    <g data-name="01.facebook">
                                                        <circle cx="88" cy="88" r="88" fill="#3a559f" opacity="1" data-original="#3a559f"></circle>
                                                        <path fill="#ffffff" d="m115.88 77.58-1.77 15.33a2.87 2.87 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.9a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.78v12.81h17.87a2.88 2.88 0 0 1 2.82 3.25z" opacity="1" data-original="#ffffff"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-6 fw-semibold">Facebook user name
                                        </p>
                                        <div class="text-end">
                                            <span class="fs-12">2 day ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-nav-search-bar p-2 border border-2 my-2 col-12  rounded-3">
                                <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <div class="d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0" viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 512 512" xml:space="preserve">
                                                <g>
                                                    <circle cx="56.098" cy="56.097" r="56.098" style="" fill="#007ab9" data-original="#007ab9"></circle>
                                                    <path d="M89.616 60.611v23.128H76.207V62.161c0-5.418-1.936-9.118-6.791-9.118-3.705 0-5.906 2.491-6.878 4.903-.353.862-.444 2.059-.444 3.268v22.524h-13.41s.18-36.546 0-40.329h13.411v5.715c-.027.045-.065.089-.089.132h.089v-.132c1.782-2.742 4.96-6.662 12.085-6.662 8.822 0 15.436 5.764 15.436 18.149zm-54.96-36.642c-4.587 0-7.588 3.011-7.588 6.967 0 3.872 2.914 6.97 7.412 6.97h.087c4.677 0 7.585-3.098 7.585-6.97-.089-3.956-2.908-6.967-7.496-6.967zm-6.791 59.77H41.27v-40.33H27.865v40.33z" style="" fill="#f1f2f2" data-original="#f1f2f2"></path>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-6 fw-semibold">Linkdin user name
                                        </p>
                                        <div class="text-end">
                                            <span class="fs-12">3 day ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-nav-search-bar p-2 border border-2 my-2 col-12  rounded-3">
                                <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0" viewBox="0 0 152 152" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <linearGradient id="a" x1="47.99" x2="119.76" y1="58.55" y2="130.32" gradientUnits="userSpaceOnUse">
                                                    <stop offset="0" stop-color="#1a6610"></stop>
                                                    <stop offset=".26" stop-color="#1a6610" stop-opacity=".78"></stop>
                                                    <stop offset=".79" stop-color="#1a6610" stop-opacity=".2"></stop>
                                                    <stop offset=".97" stop-color="#1a6610" stop-opacity="0"></stop>
                                                </linearGradient>
                                                <g data-name="Layer 2">
                                                    <g data-name="08.whatsapp">
                                                        <circle cx="76" cy="76" r="76" fill="#2aa81a" opacity="1" data-original="#2aa81a"></circle>
                                                        <path fill="url(#a)" d="M149.4 95.78A76 76 0 0 1 77.26 152l-38.62-38.64L46.48 94c-13.8-73.72 56.33-44.84 56.33-44.84z" opacity="1" data-original="url(#a)"></path>
                                                        <g fill="#fff">
                                                            <path d="M102.81 49.19a37.7 37.7 0 0 0-60.4 43.62l-4 19.42a1.42 1.42 0 0 0 .23 1.13 1.45 1.45 0 0 0 1.54.6l19-4.51a37.7 37.7 0 0 0 43.6-60.26zm-5.94 47.37a29.56 29.56 0 0 1-34 5.57l-2.66-1.32-11.67 2.76v-.15L51 91.65l-1.3-2.56a29.5 29.5 0 0 1 5.43-34.27 29.53 29.53 0 0 1 41.74 0L97 55a29.52 29.52 0 0 1-.15 41.58z" fill="#ffffff" opacity="1" data-original="#ffffff">
                                                            </path>
                                                            <path d="M95.84 88c-1.43 2.25-3.7 5-6.53 5.69-5 1.2-12.61 0-22.14-8.81l-.12-.11c-8.29-7.74-10.49-14.19-10-19.3.29-2.91 2.71-5.53 4.75-7.25a2.72 2.72 0 0 1 4.25 1l3.07 6.94a2.7 2.7 0 0 1-.33 2.76l-1.56 2a2.65 2.65 0 0 0-.21 2.95 29 29 0 0 0 5.27 5.86 31.17 31.17 0 0 0 7.3 5.23 2.65 2.65 0 0 0 2.89-.61l1.79-1.82a2.71 2.71 0 0 1 2.73-.76l7.3 2.09A2.74 2.74 0 0 1 95.84 88z" fill="#ffffff" opacity="1" data-original="#ffffff">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-6 fw-semibold">whatsapp user name
                                        </p>
                                        <div class="text-end">
                                            <span class="fs-12">3 day ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="m-auto  text-center">
                            <span>Loading...</span>
                            <div class="mx-auto chat_loader"></div>
                        </div> -->
                        <div class="m-auto chat_list_loader text-center text-center position-absolute top-0 end-0 bottom-0 start-0">
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center" style="z-index:555">
                                <div>
                                    <span>Loading...</span>
                                    <div class="mx-auto chat_loader"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-y-scroll ChatListSetHTML chat_list p-2" style="max-height: 100%;">
                            <div class="col-12 text-center">
                                <p class="fs-5 fw-medium mt-5">No Record Found</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7 col-xxl-6   transcript_box" style="height:80vh">
                    <div class="col-12 border rounded-end-4 bg-white position-relative" style="height:80vh">
                        <div class="justify-content-center col-12 position-absolute bottom-0 start-0 mb-2 px-3">
                            <div class="d-flex flex-wrap bg-white rounded-pill py-1 border">
                                <div class="input-group  position-relative ">
                                    <input type="text" class="form-control rounded-pill px-4 py-2 border-0 massage_input" placeholder="Enter Your Quithions">
                                    <button class="btn btn-primary rounded-circle me-1 px-3 send_massage SendWhatsAppMessage" DataPhoneno="" DataSenderId="" data-conversion_id="" data-page_token="" data-page_id="" data-massage_id=""><i class="fa-solid fa-caret-right"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="chat-nav-search-bar p-2 mt-2 col-12">
                            <div class="d-flex justify-content-between border-bottom align-items-center">
                                <h5 class="fs-5 d-flex  align-content-center ps-2 pb-2"><i class="fa-solid fa-circle-user fs-5 me-2"></i><span class="username UserChatName">Chat Name</span></h5>
                                <button class="bg-transparent border-0"><i class="fa-regular fa-star"></i></button>
                            </div>
                        </div>

                        <div class="main-task left-main-task mt-2 p-2 overflow-y-scroll chat_bord col-12" style="max-height:80%;">
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
                        <div class="m-auto massage_list_loader text-center position-absolute top-0 end-0 bottom-0 start-0">
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center" style="z-index:555">
                                <div>
                                    <span>Loading...</span>
                                    <div class="mx-auto chat_loader"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-y-scroll p-2 noRecourdFound" style="max-height: 100%;">
                            <div class="col-12 text-center">
                                <p class="fs-5 fw-medium mt-5 d-block">No Record Found</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>







<?= $this->include('partials/footer') ?>


<script>
    $('body').on('click', '.account-box', function() {

        $(this).addClass('active-account-box');
        $(this).siblings().removeClass('active-account-box');

    });
    $('body').on('click', '.chat-account-box', function() {

        $(this).addClass('chat-account-active');
        $(this).siblings().removeClass('chat-account-active');

    });
</script>
<script>
    $(document).ready(function() {
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
                beforeSend: function() {
                    if (action == 'account_list') {
                        $('.acc_loader').show();
                    } else if (action == 'chat_list') {
                        $('.chat_list').html('');
                        $('.chat_list_loader').show();
                    }
                },
                success: function(data) {
                    $('.acc_loader').hide();
                    var obj = JSON.parse(data);
                    if (action == 'account_list') {
                        $('.account_list').html(obj.chat_list_html);
                        $('.IG_account_list').html(obj.IG_chat_list_html);
                    } else if (action == 'chat_list') {
                        $('.chat_list').html(obj.chat_list_html);
                        $('.chat_list_loader').hide();
                    }
                }
            });
        }
        list_data();

        $('.chat_list_loader').hide();

        $('body').on('click', '.account-nav', function() {
            var page_id = $(this).attr("data-page_id");
            var page_access_token = $(this).attr("data-page_access_token");
            var platform = $(this).attr("data-platform");
            var page_name = $('.page_name').text($(this).attr('data-page_name'));
            list_data(false, 'chat_list', page_id, page_access_token, platform);
        });

        $('body').on('click', '.chat_list', function() {
            var conversion_id = $(this).data('conversion_id');
            var page_access_token = $(this).data('page_token');
            var page_id = $(this).data('page_id');
            var user_name = $(this).data('user_name');
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
                beforeSend: function() {
                    $('.massage_list_loader').show();
                    $('.noRecourdFound').hide();
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    $('.massage_list_loader').hide();
                    $('.chat_bord').show();
                    $('.chat_bord').html(obj.html);
                    $('.noRecourdFound').hide();
                    $('.send_massage').attr("data-conversion_id", conversion_id);
                    $('.send_massage').attr("data-page_token", page_access_token);
                    $('.send_massage').attr("data-page_id", page_id);
                    $('.send_massage').attr("data-massage_id", massage_id);
                }
            });

            return false;
        });

        $('.massage_list_loader').hide();

        $('body').on('click', '.send_massage', function() {
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
                success: function(data) {
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
                $('.ChatListSetHTML').html(data);
            }
        });
    });

    $('body').on('click', '.ChatClickOpenHtml', function() {
        $('.chat_bord').html('');

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
                    $('.ChatListSetHTML .active-account-box').trigger('click');
                }
            });
        }
        $('.massage_input').val('');
    });
</script>