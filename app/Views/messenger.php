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

    .accordion_item_div {
        margin: 30px;
        margin-bottom: 55px;
    }

    .nav_item_ww:hover {
        cursor: pointer;
        background-color: azure;
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
                        <div class="col-12 overflow-y-scroll scroll-sm chat_list p-1" style="max-height: 100%;">

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
                        <div class="text-center col-12 overflow-y-scroll p-3 ChatListSetHTML chatNoData">No Chats Found!</div>
                        <!-- <div class="col-12 overflow-y-scroll chat_list p-2" style="max-height: 100%;">
                            <div class="col-12 text-center">
                                <p class="fs-5 fw-medium mt-5">No Record Found</p>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7 col-xxl-6 transcript_box" style="height:80vh">
                    <div class="col-12 border rounded-end-4 bg-white position-relative" style="height:80vh">

                        <div class="accordion_item_div border rounded-2 position-absolute start-0 bottom-0" style="height: 280px; width: 200px;">
                            <ul class="p-1 bg-white ">
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#4086f4" d="m451 135-105-30L316 0H106C81.147 0 61 20.147 61 45v422c0 24.853 20.147 45 45 45h300c24.853 0 45-20.147 45-45z" opacity="1" data-original="#4086f4" class=""></path>
                                                    <path fill="#4175df" d="M451 135v332c0 24.853-20.147 45-45 45H256V0h60l30 105z" opacity="1" data-original="#4175df" class=""></path>
                                                    <path fill="#80aef8" d="M451 135H346c-16.5 0-30-13.5-30-30V0c3.9 0 7.8 1.5 10.499 4.501l120 120C449.5 127.2 451 131.1 451 135z" opacity="1" data-original="#80aef8" class=""></path>
                                                    <path fill="#fff5f5" d="M346 241H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h180c8.291 0 15 6.709 15 15s-6.709 15-15 15zM346 301H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h180c8.291 0 15 6.709 15 15s-6.709 15-15 15zM346 361H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h180c8.291 0 15 6.709 15 15s-6.709 15-15 15zM286 421H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h120c8.291 0 15 6.709 15 15s-6.709 15-15 15z" opacity="1" data-original="#fff5f5"></path>
                                                    <path fill="#e3e7ea" d="M256 421h30c8.291 0 15-6.709 15-15s-6.709-15-15-15h-30zM256 361h90c8.291 0 15-6.709 15-15s-6.709-15-15-15h-90zM256 301h90c8.291 0 15-6.709 15-15s-6.709-15-15-15h-90zM256 241h90c8.291 0 15-6.709 15-15s-6.709-15-15-15h-90z" opacity="1" data-original="#e3e7ea"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">Document</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <linearGradient id="c" x1="172.48" x2="497.848" y1="110.639" y2="436.007" gradientTransform="rotate(6.28 255.57 -277.231)" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#ffa936"></stop>
                                                        <stop offset=".411" stop-color="#ff8548"></stop>
                                                        <stop offset=".778" stop-color="#ff6c54"></stop>
                                                        <stop offset="1" stop-color="#ff6359"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="d" x1="490.487" x2="466.43" y1="159.015" y2="164.322" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#f82814" stop-opacity="0"></stop>
                                                        <stop offset="1" stop-color="#c0272d"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="a">
                                                        <stop offset="0" stop-color="#cdec7a"></stop>
                                                        <stop offset=".216" stop-color="#b0e995"></stop>
                                                        <stop offset=".561" stop-color="#87e4bb"></stop>
                                                        <stop offset=".835" stop-color="#6ee1d2"></stop>
                                                        <stop offset="1" stop-color="#65e0db"></stop>
                                                    </linearGradient>
                                                    <linearGradient xlink:href="#a" id="e" x1="15.52" x2="340.888" y1="104.705" y2="430.073" gradientTransform="rotate(-10.66 254.843 -276.812)" gradientUnits="userSpaceOnUse"></linearGradient>
                                                    <linearGradient id="b">
                                                        <stop offset="0" stop-color="#cdec7a" stop-opacity="0"></stop>
                                                        <stop offset=".235" stop-color="#9ad57d" stop-opacity=".235"></stop>
                                                        <stop offset=".604" stop-color="#51b482" stop-opacity=".604"></stop>
                                                        <stop offset=".868" stop-color="#239f85" stop-opacity=".868"></stop>
                                                        <stop offset="1" stop-color="#119786"></stop>
                                                    </linearGradient>
                                                    <linearGradient xlink:href="#b" id="f" x1="491.682" x2="450.637" y1="256.546" y2="256.546" gradientUnits="userSpaceOnUse"></linearGradient>
                                                    <linearGradient xlink:href="#b" id="g" x1="176.731" x2="176.731" y1="466.917" y2="442.601" gradientUnits="userSpaceOnUse"></linearGradient>
                                                    <linearGradient id="h" x1="88.264" x2="413.632" y1="111.753" y2="437.121" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#f8f6fb"></stop>
                                                        <stop offset="1" stop-color="#efdcfb"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="i" x1="112.768" x2="430.112" y1="101.155" y2="514.021" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#18cefb"></stop>
                                                        <stop offset=".297" stop-color="#2bb9f9"></stop>
                                                        <stop offset=".735" stop-color="#42a0f7"></stop>
                                                        <stop offset="1" stop-color="#4a97f6"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="j" x1="75.588" x2="214.616" y1="316.53" y2="497.406" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#cdec7a"></stop>
                                                        <stop offset=".215" stop-color="#b0e995" stop-opacity=".784"></stop>
                                                        <stop offset=".56" stop-color="#87e4bb" stop-opacity=".439"></stop>
                                                        <stop offset=".833" stop-color="#6ee1d2" stop-opacity=".165"></stop>
                                                        <stop offset=".999" stop-color="#65e0db" stop-opacity="0"></stop>
                                                    </linearGradient>
                                                    <linearGradient xlink:href="#a" id="k" x1="198.822" x2="366.499" y1="288.474" y2="506.622" gradientUnits="userSpaceOnUse"></linearGradient>
                                                    <linearGradient id="l" x1="117.242" x2="171.618" y1="131.922" y2="202.666" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#ffd945"></stop>
                                                        <stop offset=".304" stop-color="#ffcd3e"></stop>
                                                        <stop offset=".856" stop-color="#ffad2b"></stop>
                                                        <stop offset="1" stop-color="#ffa325"></stop>
                                                    </linearGradient>
                                                    <path fill="url(#c)" d="M426.926 470.539 40.049 427.661C21.448 425.6 8.041 408.85 10.102 390.249L45.661 69.408c2.062-18.601 18.812-32.009 37.412-29.947L469.95 82.339c18.601 2.062 32.009 18.812 29.947 37.412l-35.559 320.841c-2.061 18.601-18.811 32.009-37.412 29.947z" opacity="1" data-original="url(#c)"></path>
                                                    <path fill="url(#d)" d="m499.897 119.752-14.02 126.534-31.162-165.634 15.241 1.688c18.595 2.058 32 18.806 29.941 37.412z" opacity="1" data-original="url(#d)"></path>
                                                    <path fill="url(#e)" d="M482.373 410.94 99.837 482.904c-18.392 3.46-36.107-8.645-39.567-27.037L.59 138.626c-3.46-18.392 8.645-36.107 27.037-39.567l382.536-71.964c18.392-3.46 36.107 8.645 39.567 27.037l59.68 317.241c3.46 18.393-8.645 36.108-27.037 39.567z" opacity="1" data-original="url(#e)"></path>
                                                    <path fill="url(#f)" d="M457.896 97.546v317.999l24.476-4.605c18.392-3.46 30.497-21.175 27.037-39.567z" opacity="1" data-original="url(#f)"></path>
                                                    <path fill="url(#g)" d="m58.45 446.187 1.821 9.68c3.46 18.392 21.175 30.497 39.567 27.037l195.175-36.717z" opacity="1" data-original="url(#g)"></path>
                                                    <path fill="url(#h)" d="M424.01 448.166H34.765C16.05 448.166.879 432.995.879 414.28V91.474c0-18.715 15.171-33.886 33.886-33.886H424.01c18.715 0 33.886 15.171 33.886 33.886V414.28c0 18.715-15.171 33.886-33.886 33.886z" opacity="1" data-original="url(#h)"></path>
                                                    <path fill="url(#i)" d="M392.279 416.326H66.497c-15.663 0-28.361-12.698-28.361-28.361V117.79c0-15.663 12.698-28.361 28.361-28.361h325.782c15.663 0 28.361 12.698 28.361 28.361v270.175c0 15.663-12.698 28.361-28.361 28.361z" opacity="1" data-original="url(#i)" class=""></path>
                                                    <path fill="url(#j)" d="M252.069 416.326H66.502c-15.666 0-28.37-12.694-28.37-28.359v-44.29l47.082-57.228c15.538-18.903 44.46-18.903 60.009 0l29.315 35.64z" opacity="1" data-original="url(#j)" class=""></path>
                                                    <path fill="url(#k)" d="M420.643 316.75v71.217c0 15.666-12.704 28.359-28.37 28.359H97.005l77.532-94.237 95.246-115.783c15.538-18.892 44.471-18.892 60.009 0z" opacity="1" data-original="url(#k)" class=""></path>
                                                    <circle cx="137.225" cy="157.919" r="40.219" fill="url(#l)" opacity="1" data-original="url(#l)"></circle>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">Photos & Videos</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <circle cx="256" cy="256" r="256" fill="#2196f3" opacity="1" data-original="#2196f3" class=""></circle>
                                                    <path fill="#ffffff" fill-rule="evenodd" d="M256 324.817a66.12 66.12 0 1 0-66.121-66.117A66.195 66.195 0 0 0 256 324.817zm0-154.654a88.534 88.534 0 1 1-88.531 88.537A88.636 88.636 0 0 1 256 170.163zm162.5 196.308a15.421 15.421 0 0 1-15.41 15.411H108.911A15.424 15.424 0 0 1 93.5 366.471V171.286a15.424 15.424 0 0 1 15.41-15.412h74.7a5.6 5.6 0 0 0 5.232-3.6l16.045-41.92h102.225l16.048 41.92a5.585 5.585 0 0 0 5.229 3.6h74.7a15.426 15.426 0 0 1 15.41 15.412z" opacity="1" data-original="#ffffff" class=""></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">Camera</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <circle cx="256" cy="256" r="256" style="" fill="#6aaf50" data-original="#6aaf50" class=""></circle>
                                                    <path d="m135.693 102.206-.008.004c-29.639 15.464-42.074 51.222-28.494 81.77a454.997 454.997 0 0 0 77.468 119.423l23.939 23.939 159.073 159.073c39.82-19.335 73.863-48.69 98.876-84.783l-58.697-58.697a32.553 32.553 0 0 0-8.681-8.681L177.747 112.833c-9.294-13.695-27.382-18.283-42.054-10.627z" style="" fill="#4d8538" data-original="#4d8538" class=""></path>
                                                    <path d="M349.593 300.614a24.052 24.052 0 0 0-27.116.071l-11.752 8.066c-13.09 8.984-30.498 8.496-43.08-1.187a402.081 402.081 0 0 1-33.924-29.283 401.742 401.742 0 0 1-29.283-33.924c-9.684-12.581-10.171-29.989-1.187-43.08l8.066-11.752a24.054 24.054 0 0 0 .071-27.116l-33.64-49.575c-9.293-13.694-27.381-18.282-42.054-10.627l-.009.004c-29.639 15.464-42.074 51.222-28.494 81.77a454.997 454.997 0 0 0 77.468 119.423l23.939 23.939a455.055 455.055 0 0 0 119.423 77.468c30.549 13.58 66.306 1.145 81.77-28.494l.004-.009c7.655-14.672 3.068-32.761-10.627-42.054l-49.575-33.64z" style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">Contact</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#00528c" d="M341.3 92.8c0 33.1-26.9 60-60 60H60c-33.1 0-60-26.9-60-60s26.9-60 60-60h221.3c33.2 0 60 26.8 60 60z" opacity="1" data-original="#00528c"></path>
                                                    <path fill="#41a5ee" d="M512 256c0 33.1-26.9 60-60 60H60c-33.1 0-60-26.9-60-60s26.9-60 60-60h392c33.1 0 60 26.9 60 60z" opacity="1" data-original="#41a5ee" class=""></path>
                                                    <path fill="#0077cc" d="M170.7 419.2c0 33.1-26.9 60-60 60H60c-33.1 0-60-26.9-60-60s26.9-60 60-60h50.7c33.1 0 60 26.9 60 60z" opacity="1" data-original="#0077cc"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">Poll</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" x="0" y="0" viewBox="0 0 511.523 511.523" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#ffda2d" d="M127.261 120.739c65.515 0 128.5 49.886 128.5 135H15.072c-8.937 0-15.885-7.733-14.996-16.625 7.55-75.442 66.73-118.375 127.185-118.375z" opacity="1" data-original="#ffda2d" class=""></path>
                                                    <path fill="#4175df" d="M384.261 390.739c-65.515 0-128.5-49.886-128.5-135H496.45c8.937 0 15.885 7.733 14.996 16.625-7.549 75.442-66.729 118.375-127.185 118.375z" opacity="1" data-original="#4175df"></path>
                                                    <path fill="#59c36a" d="M120.739 384.261c0-65.515 49.886-128.5 135-128.5V496.45c0 8.937-7.733 15.885-16.625 14.996-75.442-7.549-118.375-66.729-118.375-127.185z" opacity="1" data-original="#59c36a"></path>
                                                    <path fill="#f03800" d="M390.739 127.261c0 65.515-49.886 128.5-135 128.5V15.072c0-8.937 7.733-15.885 16.625-14.996 75.442 7.55 118.375 66.73 118.375 127.185z" opacity="1" data-original="#f03800"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">New Sticker</p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="justify-content-center col-12 position-absolute bottom-0 start-0 mb-2 px-3">
                            <div class="d-flex bg-white rounded-pill py-1 border">
                                <div class="d-flex col-12 align-items-center">
                                    <div class="ps-2">
                                        <button class="btn btn-primary btn_x rounded-5">
                                            x
                                        </button>
                                    </div>
                                    <div class="input-group  position-relative ">
                                        <input type="text" class="form-control border rounded-pill px-4 py-2 border-0 massage_input" placeholder="Write a message...">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary rounded-circle me-1 SendWhatsAppMessage send_massage" data-conversion_id="" data-page_token="" data-page_id="" data-massage_id="">
                                            <i class="fa-regular fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $(".btn_x").click(function() {
                                    $(".accordion_item_div").toggle();
                                });
                            });
                        </script>
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
                        $('.chatNoData').hide();
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
            var platform = $(this).data('platform');
            var page_name = $('.page_name').text();
            // var massage_id = $(this).data('massage_id');
            if (conversion_id !== undefined && conversion_id !== 'undefined' && conversion_id != '') {
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
                        $('.username').text(user_name);
                        $('.in_chat_page_name').text(page_name + '(' + platform + ')');
                        $('.send_massage').attr("data-conversion_id", conversion_id);
                        $('.send_massage').attr("data-page_token", page_access_token);
                        $('.send_massage').attr("data-page_id", page_id);
                        $('.send_massage').attr("data-massage_id", massage_id);
                    }
                });
                return false;
            }
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
        $('.in_chat_page_name').text('');
        $('.UserChatName').text('User Name');
        $('.chat_list_loader').hide();
        $('.ChatListSetHTML').html('');
        $('.SendWhatsAppMessage').attr('data-conversion_id', '');
        $('.SendWhatsAppMessage').attr('data-page_token', '');
        $('.SendWhatsAppMessage').attr('data-page_id', '');
        $('.SendWhatsAppMessage').attr('data-massage_id', '');
        $('.SendWhatsAppMessage').attr('datasenderid', '');
        $('.SendWhatsAppMessage').attr('dataphoneno', '');
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
                $('.massage_list_loader').hide();

                $('.chat_bord').html(data);

            }
        });
    });

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

    $('body').on('keydown', '.massage_input', function(event) {
        if (event.which === 13) {
            $('.SendWhatsAppMessage').trigger('click');
            console.log('wroking');
        }
    });

    $('body').on('click', '.accordion-header', function() {
        $('.SendWhatsAppMessage').attr('datasenderid', '');
        $('.SendWhatsAppMessage').attr('dataphoneno', '');

    })
</script>