<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername();

$WhatsAppAccountsData = json_decode($WhatsAppAccounts, true);

?>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap");

    * {
        box-sizing: border-box;
        font-family: "Roboto", sans-serif;
    }

    .c-wa-message {
        padding: 7px 14px 6px;
        background-color: #724EBF;
        border-radius: 0px 8px 8px;

    }

   
    .chat_bordClass {
        max-height:90% !important;
    }
    .c-wa-message:before {
        position: absolute;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAmCAMAAADp2asXAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAACQUExURUxpccPDw9ra2m9vbwAAAAAAADExMf///wAAABoaGk9PT7q6uqurqwsLCycnJz4+PtDQ0JycnIyMjPf3915eXvz8/E9PT/39/RMTE4CAgAAAAJqamv////////r6+u/v7yUlJeXl5f///5ycnOXl5XNzc/Hx8f///xUVFf///+zs7P///+bm5gAAAM7Ozv///2fVensAAAAvdFJOUwCow1cBCCnqAhNAnY0WIDW2f2/hSeo99g1lBYT87vDXG8/6d8oL4sgM5szrkgl660OiZwAAAHRJREFUKM/ty7cSggAABNFVUQFzwizmjPz/39k4YuFWtm55bw7eHR6ny63+alnswT3/rIDzUSC7CrAziPYCJCsB+gbVkgDtVIDh+DsE9OTBpCtAbSBAZSEQNgWIygJ0RgJMDWYNAdYbAeKtAHODlkHIv997AkLqIVOXVU84AAAAAElFTkSuQmCC);
        background-position: 50% 50%;
        background-repeat: no-repeat;
        background-size: contain;
        content: "";
        top: 0px;
        left: -12px;
        width: 12px;
        height: 19px;
    }

    .c-wa-audio__wrapper {
        display: flex;
        align-items: center;
        width: 400px;
    }

    .c-wa-audio__photo {
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPCFET0NUWVBFIHN2ZyAgUFVCTElDICctLy9XM0MvL0RURCBTVkcgMS4xLy9FTicgICdodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQnPgo8c3ZnIHdpZHRoPSI0MDFweCIgaGVpZ2h0PSI0MDFweCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAzMTIuODA5IDAgNDAxIDQwMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIzMTIuODA5IDAgNDAxIDQwMSIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgdHJhbnNmb3JtPSJtYXRyaXgoMS4yMjMgMCAwIDEuMjIzIC00NjcuNSAtODQzLjQ0KSI+Cgk8cmVjdCB4PSI2MDEuNDUiIHk9IjY1My4wNyIgd2lkdGg9IjQwMSIgaGVpZ2h0PSI0MDEiIGZpbGw9IiNFNEU2RTciLz4KCTxwYXRoIGQ9Im04MDIuMzggOTA4LjA4Yy04NC41MTUgMC0xNTMuNTIgNDguMTg1LTE1Ny4zOCAxMDguNjJoMzE0Ljc5Yy0zLjg3LTYwLjQ0LTcyLjktMTA4LjYyLTE1Ny40MS0xMDguNjJ6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8cGF0aCBkPSJtODgxLjM3IDgxOC44NmMwIDQ2Ljc0Ni0zNS4xMDYgODQuNjQxLTc4LjQxIDg0LjY0MXMtNzguNDEtMzcuODk1LTc4LjQxLTg0LjY0MSAzNS4xMDYtODQuNjQxIDc4LjQxLTg0LjY0MWM0My4zMSAwIDc4LjQxIDM3LjkgNzguNDEgODQuNjR6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPC9zdmc+Cg==);
        background-position: center;
        background-size: cover;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 1px solid #ddd;
    }

    .c-wa-audio__photo-container {
        position: relative;
    }

    .c-wa-audio__photo-mic {
        position: absolute;
        right: 0;
        bottom: 0;
        font-size: 1.1rem;
        color: #999999;
        filter: drop-shadow(1px 1px 0 white) drop-shadow(-1px -1px 0 white);
    }

    .c-wa-audio__control-play {
        color: #999999;
        margin-left: 20px;
        cursor: pointer;
        font-size: 1.1rem;
    }

    .c-wa-audio__time-container {
        font-size: 16px;
        line-height: 18px;
        color: #55606e;
        display: flex;
        flex-grow: 1;

        align-items: center;
        margin-left: 24px;
        margin-right: 24px;
    }

    .c-wa-audio__time-slider {
        width: 155px;
        background-color: #d8d8d8;
        cursor: pointer;
        position: relative;
        margin-left: 16px;
        margin-right: 16px;
        border-radius: 2px;
        height: 4px;
    }

    .c-wa-audio__time-progress {
        background-color: #2ab5eb;
        border-radius: inherit;
        position: absolute;
        pointer-events: none;
        height: 4px;
    }

    .c-wa-audio__time-pin {
        height: 13px;
        width: 13px;
        border-radius: 50%;
        background-color: #2ab5eb;
        position: absolute;
        pointer-events: all;
        top: -4px;
        right: -10px;
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.32);
    }

    .iti {
        width: 100%;
    }

    .ChatBackGroundClass {
        background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png') !important;

    }


    .chatheadercolorclass {
        background-color: #005c4b !important;
    }


    .chatheadercolorclasswithheader {
        background-color: #005c4b !important;
        border-color: #005c4b !important;
    }

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
        --loader-color: #7a00ff;
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

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .ck-content .ck-placeholder {
        color: red;
    }

    .file-btn {
        border: 1px dashed var(--del-color) !important;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        border: 1px dashed #c3c3c3 !important;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .ck-editor__editable {
        min-height: 150px;
        max-height: 170px
    }

    .ck.ck-editor__editable>.ck-placeholder::before {
        color: #c6c6c6;
        font-family: Poppins;
    }

    .view-file-link {
        background-color: #724ebf21;
        color: #724ebf;
    }

    .emoji_div_man {
        margin-left: 50px;
        margin-bottom: 50px;
    }

    .emoji_div span {
        cursor: pointer;
    }

    /* ===========  camera css ====== */
    .video-btn-sec {
        position: absolute;
        bottom: 25px;
        left: 50%;
        right: auto;
        transform: translate(-10%, 0);
        width: 100%;
    }

    .video-btn-sec button {
        width: 35px;
        height: 35px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--first-color);
        background-color: var(--first-color);
        margin-right: 5px;
    }

    .video-btn-sec button i {
        color: #fff;
    }

    .video-btn-sec .switch-btn {
        width: fit-content;
        padding: 15px 15px;
        height: 40px;
        color: #fff;
    }

    .profile-div {
        width: 130px;
        height: 130px;
        overflow: hidden;
    }

    .profile-btn-photo2 {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .profile-btn-photo3 {
        position: absolute;
        bottom: 0;
        right: 30px;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .upload-btn {
        width: 30px;
        height: 30px;
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 5px 5px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: normal;
    }

    .upload-btn i {
        line-height: 0;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
    }

    @media (max-width:575px) {
        .title-1 h2 {
            font-size: 19px;
        }
    }

    .hover-text {
        overflow: hidden;
    }

    .hover-text:hover {
        overflow: visible;
        white-space: wrap !important;
    }

    .hover-text {
        overflow: hidden;
    }

    .hover-text:hover {
        overflow: visible;
        white-space: wrap !important;
    }

    .modal-body-1 {
        background-color: var(--white-color);
        border: 1px solid var(--all-light);
        display: flex;
        flex-wrap: wrap;
        align-items: start;
        justify-content: start;
        padding: 16px 8px;
        border-radius: 6px;
    }
    .chat-header{
        background-color: #724EBF;
    }
    .accordion-button:not(.collapsed) {
        color: black;
        background-color: #dcd4ffb8;
        box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
    }
    .account-box{
        transition: all 0.5s;
        cursor: pointer;
    }
    .account-box:hover{
        background-color: #eaeaea9c!important;
    }
    .linked-page1{
        transition: all 0.5s;
        cursor: pointer;
    }
    .linked-page1:hover{
        background-color: #eaeaea9c!important;
    }
    .scroll-none::-webkit-scrollbar {
        display: none;
    }
    
</style>


<!-- camera modal -->

<div id="camera_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close CloseButtonCamera" data-bs-toggle="modal"
                    data-bs-target="#Adduser" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 canvas">
                    <canvas id="canvas" hidden></canvas>
                    <div class="position-relative">
                        <video autoplay id="video" class="m-auto d-flex w-100 h-100"></video>
                        <div class="video-btn-sec d-flex align-items-center">
                            <button class="button is-hidden " id="btnPlay" hidden>
                                <span class="icon is-small">
                                    <i class="fas fa-play"></i>
                                </span>
                            </button>
                            <button class="button is-hidden " id="btnPause" hidden>
                                <span class="icon is-small">
                                    <i class="fas fa-pause"></i>
                                </span>
                            </button>
                            <button class="button is-success firstBtn TakePic" id="btnScreenshot">
                                <span class="icon is-small">
                                    <i class="fas fa-camera"></i>
                                </span>
                            </button>
                            <button class="button is-success firstBtn" id="btnChangeCamera">
                                <span class="icon is-small">
                                    <i class="fas fa-sync-alt"></i>
                                </span>
                            </button>
                        </div>
                        <div class="video-btn-sec d-flex align-items-center">
                            <button class="button switch-btn SecoundButton SendImage" imagebase64="" id="YesBtn">
                                <span class="icon">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </button>
                            <button class="button switch-btn SecoundButton NoBtn" id="NoBtn">
                                <span class="icon">
                                    <i class="fa-solid fa-x"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- View Contact modal  -->
<div class="modal fade" id="exampleModal_mass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">view Contact</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 m-0">
                <div class="p-2">
                    <div class="d-flex p-2 border rounded-2">
                        <div>
                            <i class="bi bi-person-circle" style="font-size: 30px;"></i>
                        </div>
                        <div class="d-flex align-items-center ms-2">
                            <p>Mobile number</p>
                        </div>
                    </div>
                </div>
                <div class="p-3">
                    <div class="d-flex justify-content-between border-bottom pb-2">
                        <div>
                            <p>+91 9499532715</p>
                            <p>TEL</p>
                        </div>
                        <div class="d-flex align-items-center ms-2">
                            <i class="bi bi-chat-left-text-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- modal box whatapp -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Contact</h5>
                <span type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            </div>
            <div class="modal-body overflow-auto" style="height:350px;">
                <div class="d-flex col-12 justify-content-center">
                    <div class="input-group mb-3 d-none">
                        <input type="text" class="form-control" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text btn btn-secondary"><i
                                    class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                    </div>
                </div>
                <div class="SetContactListHtml">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary rounded-circle me-1 SendContactNumber">
                    <i class="fa-regular fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body-secondery">
                <div class="modal-body-card pb-1">
                    <h5 class="mb-3 pb-2 border-bottom col-12">Add Contact Details</h5>
                    <div class="col-12">
                        <div class="col-12 mb-3 mt-2">
                            <input type="text" class="form-control main-control ContactNameClass " id="business_name"
                                name="business_name" placeholder="Enter Name" value="" required="">
                        </div>
                        <div class="col-12 mb-3 mt-2">
                            <input type="number" id="mobile_code"
                                class="form-control phone_number_div ContactNumberClass"
                                placeholder="Enter Contact Number" name="name">
                        </div>

                        <div class="col-12 pt-3 border-top mb-2 text-end">
                            <span class="btn btn-secondary CloseBtn" data-bs-dismiss="modal">Close</span>
                            <span class="btn-primary AddWhatsAppContactNumber" id="" data-edit_id=""
                                name="memberships_update1" value="memberships_update1">Add</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

                <div class="d-lg-block col-12 col-sm-12 col-md-12 col-lg-6 overflow-auto scroll-none col-xl-3  social-accounts main-box"
                    style="height:80vh">
                    <div class="col-12 border rounded-3 bg-white position-lg-relative " style="height:80vh">
                        <div class="chat-nav-search-bar p-2 col-12 text-white chat-header rounded-top-3">
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="dropdown d-flex align-items-center ps-2 ">
                                    <i class="fa-solid fa-user fs-5 me-2"></i>
                                    <h5 class="fs-5 fw-semibold">Social Media Accounts</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12  px-0 scroll-none" style="max-height: 100%;">
                            <div class="accordion " id="accordionExample">
                                <div class="accordion-item border-0 border-bottom ListedMessage">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button border-0 shadow-none fw-medium rounded-0 px-3 py-2" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="35px"
                                                x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#1877f2"
                                                        d="M512 256c0 127.78-93.62 233.69-216 252.89V330h59.65L367 256h-71v-48.02c0-20.25 9.92-39.98 41.72-39.98H370v-63s-29.3-5-57.31-5c-58.47 0-96.69 35.44-96.69 99.6V256h-65v74h65v178.89C93.62 489.69 0 383.78 0 256 0 114.62 114.62 0 256 0s256 114.62 256 256z"
                                                        opacity="1" data-original="#1877f2" class=""></path>
                                                    <path fill="#ffffff"
                                                        d="M355.65 330 367 256h-71v-48.021c0-20.245 9.918-39.979 41.719-39.979H370v-63s-29.296-5-57.305-5C254.219 100 216 135.44 216 199.6V256h-65v74h65v178.889c13.034 2.045 26.392 3.111 40 3.111s26.966-1.066 40-3.111V330z"
                                                        opacity="1" data-original="#ffffff"></path>
                                                </g>
                                            </svg>
                                            <P class="ms-2">Facebook</P>

                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body account_list p-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 border-bottom ListedMessage">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed border-0 shadow-none fw-medium px-3 py-2 "
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px"
                                                x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <linearGradient id="a" x1="84.679" x2="404.429" y1="427.321"
                                                        y2="107.571" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#fee411"></stop>
                                                        <stop offset=".052" stop-color="#fedb16"></stop>
                                                        <stop offset=".138" stop-color="#fec125"></stop>
                                                        <stop offset=".248" stop-color="#fe983d"></stop>
                                                        <stop offset=".376" stop-color="#fe5f5e"></stop>
                                                        <stop offset=".5" stop-color="#fe2181"></stop>
                                                        <stop offset="1" stop-color="#9000dc"></stop>
                                                    </linearGradient>
                                                    <circle cx="256" cy="256" r="225" fill="url(#a)" opacity="1"
                                                        data-original="url(#a)" class=""></circle>
                                                    <g fill="#fff">
                                                        <path
                                                            d="M303.8 131h-95.5c-42.6 0-77.2 34.6-77.2 77.2v95.5c0 42.6 34.6 77.2 77.2 77.2h95.5c42.6 0 77.2-34.6 77.2-77.2v-95.5c0-42.6-34.6-77.2-77.2-77.2zm49.3 172.8c0 27.2-22.1 49.4-49.4 49.4h-95.5c-27.2 0-49.4-22.1-49.4-49.4v-95.5c0-27.2 22.1-49.4 49.4-49.4h95.5c27.2 0 49.4 22.1 49.4 49.4z"
                                                            fill="#ffffff" opacity="1" data-original="#ffffff"></path>
                                                        <path
                                                            d="M256 192.1c-35.2 0-63.9 28.7-63.9 63.9s28.7 63.9 63.9 63.9 63.9-28.7 63.9-63.9-28.7-63.9-63.9-63.9zm0 102.7c-21.4 0-38.8-17.4-38.8-38.8s17.4-38.8 38.8-38.8 38.8 17.4 38.8 38.8-17.4 38.8-38.8 38.8z"
                                                            fill="#ffffff" opacity="1" data-original="#ffffff"></path>
                                                        <circle cx="323.1" cy="188.4" r="10.8"
                                                            transform="rotate(-9.25 323.353 188.804)" fill="#ffffff"
                                                            opacity="1" data-original="#ffffff"></circle>
                                                    </g>
                                                </g>
                                            </svg>
                                            <P class="ms-2">instagram</P>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body IG_account_list p-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 border-bottom WhatsAppListedMessage">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed border-0 shadow-none fw-medium px-3 py-2 "
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="35px"
                                                x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path
                                                        d="M256.064 0h-.128C114.784 0 0 114.816 0 256c0 56 18.048 107.904 48.736 150.048l-31.904 95.104 98.4-31.456C155.712 496.512 204 512 256.064 512 397.216 512 512 397.152 512 256S397.216 0 256.064 0z"
                                                        style="" fill="#4caf50" data-original="#4caf50" class=""></path>
                                                    <path
                                                        d="M405.024 361.504c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.616-127.456-112.576-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016.16 8.576.288 7.52.32 11.296.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744-3.776 4.352-7.36 7.68-11.136 12.352-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z"
                                                        style="" fill="#fafafa" data-original="#fafafa" class=""></path>
                                                </g>
                                            </svg>
                                            <P class="ms-2">Whatsapp</P>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse WhatsAppAccountListTab"
                                        data-bs-parent="#accordionExample">

                                        <?php

                                        if (isset($WhatsAppAccountsData) && !empty($WhatsAppAccountsData)) {
                                            foreach ($WhatsAppAccountsData as $key => $value) {
                                                $dnoneC = '';

                                                if ($value['count'] == '0') {
                                                    $dnoneC = 'd-none';

                                                }
                                                echo '<div class="accordion-body  WA_account_list  WA_account_listTab p-0 account-box" id ="' . $value['id'] . '" phoneno = "' . $value['display_phone_number'] . '" name="' . $value['verified_name'] . '"> 
                                                <div class="col-12  my-2 " data-page_id="17841457874373728" data-platform="instagram" data-page_access_token="EAADNF4vVgk0BO6ZBcyZCiZCY5FGuPPWKb7npn8YcXafmqIexQxBgMPRZAAttSOgFr6NqP2B74icpZAcvL5pJgwv4ZBdTsM4Neik41DvLdjprcNSGdIfty83qi5CkzEAyuXUeEYVQf9lNRy9GtaDhFZBYBpKKyZCkfGqAB6wcfP8cvcx8mjcXrbpYEfbq0XYucWT81gzkkywZD" data-page_name="ajasystechnologies">
                                                    <div class="col-12 d-flex flex-wrap  align-items-center  p-2 linked-page">
                                                            <img src="https://erp.gymsmart.in/assets/image/member.png" class="col-4 account_icon border border-1 rounded-circle me-2 align-self-center text-center" alt="" height="100" width="100">
                                                         <div class="ps-2">
                                                            <p class="fs-6 fw-medium col">' . $value['verified_name'] . '</p>
                                                            <span class="fs-12 text-muted">+' . $value['display_phone_number'] . '</span>
                                                         </div>   

                                                                <span class="ms-auto badge rounded-pill text-bg-success ' . $dnoneC . ' CountFinalText">' . $value['count'] . '</span>
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

                <div class="col-12 d-none rounded-3 d-lg-block d-xl-block col-sm-12 col-md-12 col-lg-6 col-xl-3 col-xxl-3 chat-box main-box overflow-auto scroll-none"
                    style="height:80vh">
                    <div class="col-12 border  bg-white position-relative rounded-3 overflow-hidden position-relative" style="height:80vh">
                        <div class="chat-nav-search-bar chat-header p-2 col-12 text-white">
                            <div class="d-flex justify-content-between  align-items-center">
                                <div class="dropdown d-flex align-items-center ChatNameHeader ps-2 ">
                                    <i class="fas fa-comment fs-5  me-2"></i>
                                    <h5 class="fs-5 w-semibold">Chats</h5>
                                </div>
                                <div class="">
                                    <p class="page_name d-flex"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-y-scroll scroll-sm chat_list p-1 px-0 scroll-none">

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
                        <div class="text-center col-12 overflow-y-scroll p-3 ChatListSetHTML chatNoData">No Chats Found!
                        </div>
                        <!-- <div class="col-12 overflow-y-scroll chat_list p-2" style="max-height: 100%;">
                            <div class="col-12 text-center">
                                <p class="fs-5 fw-medium mt-5">No Record Found</p>
                            </div>
                        </div> -->
                        <div class="d-lg-none border-top px-2 position-absolute bottom-0 start-0 w-100 py-1 bg-white ">
                            <button class="back-button text-muted border-0  bg-transparent">
                                <i class="fa-solid fa-angle-left fs-14"></i><span class="mx-1">Back</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-none col-12 col-sm-12 col-md-12 col-lg-6 d-xl-block col-xxl-6 transcript_box  main-box"
                    style="height:80vh">
                    <div class="col-12 border rounded-3bg-white position-relative SetChatBackGroundClass rounded-3 overflow-hidden "
                        style="height:80vh">
                        <div class="accordion_item_div border rounded-2 position-absolute start-0 bottom-0"
                            style="height: 200px; width: 200px; display:none;">
                            <ul class="p-1 bg-white ">
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                                x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#4086f4"
                                                        d="m451 135-105-30L316 0H106C81.147 0 61 20.147 61 45v422c0 24.853 20.147 45 45 45h300c24.853 0 45-20.147 45-45z"
                                                        opacity="1" data-original="#4086f4" class=""></path>
                                                    <path fill="#4175df"
                                                        d="M451 135v332c0 24.853-20.147 45-45 45H256V0h60l30 105z"
                                                        opacity="1" data-original="#4175df" class=""></path>
                                                    <path fill="#80aef8"
                                                        d="M451 135H346c-16.5 0-30-13.5-30-30V0c3.9 0 7.8 1.5 10.499 4.501l120 120C449.5 127.2 451 131.1 451 135z"
                                                        opacity="1" data-original="#80aef8" class=""></path>
                                                    <path fill="#fff5f5"
                                                        d="M346 241H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h180c8.291 0 15 6.709 15 15s-6.709 15-15 15zM346 301H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h180c8.291 0 15 6.709 15 15s-6.709 15-15 15zM346 361H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h180c8.291 0 15 6.709 15 15s-6.709 15-15 15zM286 421H166c-8.291 0-15-6.709-15-15s6.709-15 15-15h120c8.291 0 15 6.709 15 15s-6.709 15-15 15z"
                                                        opacity="1" data-original="#fff5f5"></path>
                                                    <path fill="#e3e7ea"
                                                        d="M256 421h30c8.291 0 15-6.709 15-15s-6.709-15-15-15h-30zM256 361h90c8.291 0 15-6.709 15-15s-6.709-15-15-15h-90zM256 301h90c8.291 0 15-6.709 15-15s-6.709-15-15-15h-90zM256 241h90c8.291 0 15-6.709 15-15s-6.709-15-15-15h-90z"
                                                        opacity="1" data-original="#e3e7ea"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2 DocumentSelectionForSendClickEventClass" data-bs-toggle="modal"
                                            data-bs-target=".PinToDocumentSelectClass">Document</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                                x="0" y="0" viewBox="0 0 510 510"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <linearGradient id="c" x1="172.48" x2="497.848" y1="110.639"
                                                        y2="436.007" gradientTransform="rotate(6.28 255.57 -277.231)"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#ffa936"></stop>
                                                        <stop offset=".411" stop-color="#ff8548"></stop>
                                                        <stop offset=".778" stop-color="#ff6c54"></stop>
                                                        <stop offset="1" stop-color="#ff6359"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="d" x1="490.487" x2="466.43" y1="159.015"
                                                        y2="164.322" gradientUnits="userSpaceOnUse">
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
                                                    <linearGradient xlink:href="#a" id="e" x1="15.52" x2="340.888"
                                                        y1="104.705" y2="430.073"
                                                        gradientTransform="rotate(-10.66 254.843 -276.812)"
                                                        gradientUnits="userSpaceOnUse"></linearGradient>
                                                    <linearGradient id="b">
                                                        <stop offset="0" stop-color="#cdec7a" stop-opacity="0"></stop>
                                                        <stop offset=".235" stop-color="#9ad57d" stop-opacity=".235">
                                                        </stop>
                                                        <stop offset=".604" stop-color="#51b482" stop-opacity=".604">
                                                        </stop>
                                                        <stop offset=".868" stop-color="#239f85" stop-opacity=".868">
                                                        </stop>
                                                        <stop offset="1" stop-color="#119786"></stop>
                                                    </linearGradient>
                                                    <linearGradient xlink:href="#b" id="f" x1="491.682" x2="450.637"
                                                        y1="256.546" y2="256.546" gradientUnits="userSpaceOnUse">
                                                    </linearGradient>
                                                    <linearGradient xlink:href="#b" id="g" x1="176.731" x2="176.731"
                                                        y1="466.917" y2="442.601" gradientUnits="userSpaceOnUse">
                                                    </linearGradient>
                                                    <linearGradient id="h" x1="88.264" x2="413.632" y1="111.753"
                                                        y2="437.121" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#f8f6fb"></stop>
                                                        <stop offset="1" stop-color="#efdcfb"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="i" x1="112.768" x2="430.112" y1="101.155"
                                                        y2="514.021" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#18cefb"></stop>
                                                        <stop offset=".297" stop-color="#2bb9f9"></stop>
                                                        <stop offset=".735" stop-color="#42a0f7"></stop>
                                                        <stop offset="1" stop-color="#4a97f6"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="j" x1="75.588" x2="214.616" y1="316.53"
                                                        y2="497.406" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#cdec7a"></stop>
                                                        <stop offset=".215" stop-color="#b0e995" stop-opacity=".784">
                                                        </stop>
                                                        <stop offset=".56" stop-color="#87e4bb" stop-opacity=".439">
                                                        </stop>
                                                        <stop offset=".833" stop-color="#6ee1d2" stop-opacity=".165">
                                                        </stop>
                                                        <stop offset=".999" stop-color="#65e0db" stop-opacity="0">
                                                        </stop>
                                                    </linearGradient>
                                                    <linearGradient xlink:href="#a" id="k" x1="198.822" x2="366.499"
                                                        y1="288.474" y2="506.622" gradientUnits="userSpaceOnUse">
                                                    </linearGradient>
                                                    <linearGradient id="l" x1="117.242" x2="171.618" y1="131.922"
                                                        y2="202.666" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#ffd945"></stop>
                                                        <stop offset=".304" stop-color="#ffcd3e"></stop>
                                                        <stop offset=".856" stop-color="#ffad2b"></stop>
                                                        <stop offset="1" stop-color="#ffa325"></stop>
                                                    </linearGradient>
                                                    <path fill="url(#c)"
                                                        d="M426.926 470.539 40.049 427.661C21.448 425.6 8.041 408.85 10.102 390.249L45.661 69.408c2.062-18.601 18.812-32.009 37.412-29.947L469.95 82.339c18.601 2.062 32.009 18.812 29.947 37.412l-35.559 320.841c-2.061 18.601-18.811 32.009-37.412 29.947z"
                                                        opacity="1" data-original="url(#c)"></path>
                                                    <path fill="url(#d)"
                                                        d="m499.897 119.752-14.02 126.534-31.162-165.634 15.241 1.688c18.595 2.058 32 18.806 29.941 37.412z"
                                                        opacity="1" data-original="url(#d)"></path>
                                                    <path fill="url(#e)"
                                                        d="M482.373 410.94 99.837 482.904c-18.392 3.46-36.107-8.645-39.567-27.037L.59 138.626c-3.46-18.392 8.645-36.107 27.037-39.567l382.536-71.964c18.392-3.46 36.107 8.645 39.567 27.037l59.68 317.241c3.46 18.393-8.645 36.108-27.037 39.567z"
                                                        opacity="1" data-original="url(#e)"></path>
                                                    <path fill="url(#f)"
                                                        d="M457.896 97.546v317.999l24.476-4.605c18.392-3.46 30.497-21.175 27.037-39.567z"
                                                        opacity="1" data-original="url(#f)"></path>
                                                    <path fill="url(#g)"
                                                        d="m58.45 446.187 1.821 9.68c3.46 18.392 21.175 30.497 39.567 27.037l195.175-36.717z"
                                                        opacity="1" data-original="url(#g)"></path>
                                                    <path fill="url(#h)"
                                                        d="M424.01 448.166H34.765C16.05 448.166.879 432.995.879 414.28V91.474c0-18.715 15.171-33.886 33.886-33.886H424.01c18.715 0 33.886 15.171 33.886 33.886V414.28c0 18.715-15.171 33.886-33.886 33.886z"
                                                        opacity="1" data-original="url(#h)"></path>
                                                    <path fill="url(#i)"
                                                        d="M392.279 416.326H66.497c-15.663 0-28.361-12.698-28.361-28.361V117.79c0-15.663 12.698-28.361 28.361-28.361h325.782c15.663 0 28.361 12.698 28.361 28.361v270.175c0 15.663-12.698 28.361-28.361 28.361z"
                                                        opacity="1" data-original="url(#i)" class=""></path>
                                                    <path fill="url(#j)"
                                                        d="M252.069 416.326H66.502c-15.666 0-28.37-12.694-28.37-28.359v-44.29l47.082-57.228c15.538-18.903 44.46-18.903 60.009 0l29.315 35.64z"
                                                        opacity="1" data-original="url(#j)" class=""></path>
                                                    <path fill="url(#k)"
                                                        d="M420.643 316.75v71.217c0 15.666-12.704 28.359-28.37 28.359H97.005l77.532-94.237 95.246-115.783c15.538-18.892 44.471-18.892 60.009 0z"
                                                        opacity="1" data-original="url(#k)" class=""></path>
                                                    <circle cx="137.225" cy="157.919" r="40.219" fill="url(#l)"
                                                        opacity="1" data-original="url(#l)"></circle>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2 SendImageAndPhotosClass" data-bs-toggle="modal"
                                            data-bs-target=".PinToDocumentSelectClass">Photos & Videos</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                                x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <circle cx="256" cy="256" r="256" fill="#2196f3" opacity="1"
                                                        data-original="#2196f3" class=""></circle>
                                                    <path fill="#ffffff" fill-rule="evenodd"
                                                        d="M256 324.817a66.12 66.12 0 1 0-66.121-66.117A66.195 66.195 0 0 0 256 324.817zm0-154.654a88.534 88.534 0 1 1-88.531 88.537A88.636 88.636 0 0 1 256 170.163zm162.5 196.308a15.421 15.421 0 0 1-15.41 15.411H108.911A15.424 15.424 0 0 1 93.5 366.471V171.286a15.424 15.424 0 0 1 15.41-15.412h74.7a5.6 5.6 0 0 0 5.232-3.6l16.045-41.92h102.225l16.048 41.92a5.585 5.585 0 0 0 5.229 3.6h74.7a15.426 15.426 0 0 1 15.41 15.412z"
                                                        opacity="1" data-original="#ffffff" class=""></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="ms-2 CameraOpenModelBtn modal_hide" id="opencemera"
                                            data-bs-toggle="modal" data-bs-target="#camera_modal">Camera</div>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border ContactModelOpen rounded-2 mt-1 mb-1 p-2">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                                x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <circle cx="256" cy="256" r="256" style="" fill="#6aaf50"
                                                        data-original="#6aaf50" class=""></circle>
                                                    <path
                                                        d="m135.693 102.206-.008.004c-29.639 15.464-42.074 51.222-28.494 81.77a454.997 454.997 0 0 0 77.468 119.423l23.939 23.939 159.073 159.073c39.82-19.335 73.863-48.69 98.876-84.783l-58.697-58.697a32.553 32.553 0 0 0-8.681-8.681L177.747 112.833c-9.294-13.695-27.382-18.283-42.054-10.627z"
                                                        style="" fill="#4d8538" data-original="#4d8538" class=""></path>
                                                    <path
                                                        d="M349.593 300.614a24.052 24.052 0 0 0-27.116.071l-11.752 8.066c-13.09 8.984-30.498 8.496-43.08-1.187a402.081 402.081 0 0 1-33.924-29.283 401.742 401.742 0 0 1-29.283-33.924c-9.684-12.581-10.171-29.989-1.187-43.08l8.066-11.752a24.054 24.054 0 0 0 .071-27.116l-33.64-49.575c-9.293-13.694-27.381-18.282-42.054-10.627l-.009.004c-29.639 15.464-42.074 51.222-28.494 81.77a454.997 454.997 0 0 0 77.468 119.423l23.939 23.939a455.055 455.055 0 0 0 119.423 77.468c30.549 13.58 66.306 1.145 81.77-28.494l.004-.009c7.655-14.672 3.068-32.761-10.627-42.054l-49.575-33.64z"
                                                        style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2" data-toggle="modal" data-target="#exampleModal">Contact</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2 d-none">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                                x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#00528c"
                                                        d="M341.3 92.8c0 33.1-26.9 60-60 60H60c-33.1 0-60-26.9-60-60s26.9-60 60-60h221.3c33.2 0 60 26.8 60 60z"
                                                        opacity="1" data-original="#00528c"></path>
                                                    <path fill="#41a5ee"
                                                        d="M512 256c0 33.1-26.9 60-60 60H60c-33.1 0-60-26.9-60-60s26.9-60 60-60h392c33.1 0 60 26.9 60 60z"
                                                        opacity="1" data-original="#41a5ee" class=""></path>
                                                    <path fill="#0077cc"
                                                        d="M170.7 419.2c0 33.1-26.9 60-60 60H60c-33.1 0-60-26.9-60-60s26.9-60 60-60h50.7c33.1 0 60 26.9 60 60z"
                                                        opacity="1" data-original="#0077cc"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">Poll</p>
                                    </div>
                                </li>
                                <li class="nav_item_ww col-12 border rounded-2 mt-1 mb-1 p-2 d-none">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                                x="0" y="0" viewBox="0 0 511.523 511.523"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#ffda2d"
                                                        d="M127.261 120.739c65.515 0 128.5 49.886 128.5 135H15.072c-8.937 0-15.885-7.733-14.996-16.625 7.55-75.442 66.73-118.375 127.185-118.375z"
                                                        opacity="1" data-original="#ffda2d" class=""></path>
                                                    <path fill="#4175df"
                                                        d="M384.261 390.739c-65.515 0-128.5-49.886-128.5-135H496.45c8.937 0 15.885 7.733 14.996 16.625-7.549 75.442-66.729 118.375-127.185 118.375z"
                                                        opacity="1" data-original="#4175df"></path>
                                                    <path fill="#59c36a"
                                                        d="M120.739 384.261c0-65.515 49.886-128.5 135-128.5V496.45c0 8.937-7.733 15.885-16.625 14.996-75.442-7.549-118.375-66.729-118.375-127.185z"
                                                        opacity="1" data-original="#59c36a"></path>
                                                    <path fill="#f03800"
                                                        d="M390.739 127.261c0 65.515-49.886 128.5-135 128.5V15.072c0-8.937 7.733-15.885 16.625-14.996 75.442 7.55 118.375 66.73 118.375 127.185z"
                                                        opacity="1" data-original="#f03800"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="ms-2">New Sticker</p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="emoji_div_man bg-white border rounded-3 p-2 position-absolute start-0 bottom-0 overflow-x-scroll"
                            style="height: 200px; width: 200px; display:none;">
                            <div class="emoji_div">
                                <span class="intercom-emoji-picker-emoji" title="thumbs_up">&#x1F44D;</span>
                                <span class="intercom-emoji-picker-emoji" title="-1">&#x1F44E;</span>
                                <span class="intercom-emoji-picker-emoji" title="sob">&#x1F62D;</span>
                                <span class="intercom-emoji-picker-emoji" title="confused">&#x1F615;</span>
                                <span class="intercom-emoji-picker-emoji" title="neutral_face">&#x1F610;</span>
                                <span class="intercom-emoji-picker-emoji" title="blush">&#x1F60A;</span>
                                <span class="intercom-emoji-picker-emoji" title="heart_eyes">&#x1F60D;</span>
                                <span class="intercom-emoji-picker-emoji" title="smile">&#x1F604;</span>
                                <span class="intercom-emoji-picker-emoji" title="smiley">&#x1F603;</span>
                                <span class="intercom-emoji-picker-emoji" title="grinning">&#x1F600;</span>
                                <span class="intercom-emoji-picker-emoji" title="blush">&#x1F60A;</span>
                                <span class="intercom-emoji-picker-emoji" title="wink">&#x1F609;</span>
                                <span class="intercom-emoji-picker-emoji" title="heart_eyes">&#x1F60D;</span>
                                <span class="intercom-emoji-picker-emoji" title="kissing_heart">&#x1F618;</span>
                                <span class="intercom-emoji-picker-emoji" title="kissing_closed_eyes">&#x1F61A;</span>
                                <span class="intercom-emoji-picker-emoji" title="kissing">&#x1F617;</span>
                                <span class="intercom-emoji-picker-emoji" title="kissing_smiling_eyes">&#x1F619;</span>
                                <span class="intercom-emoji-picker-emoji"
                                    title="stuck_out_tongue_winking_eye">&#x1F61C;</span>
                                <span class="intercom-emoji-picker-emoji"
                                    title="stuck_out_tongue_closed_eyes">&#x1F61D;</span>
                                <span class="intercom-emoji-picker-emoji" title="stuck_out_tongue">&#x1F61B;</span>
                                <span class="intercom-emoji-picker-emoji" title="flushed">&#x1F633;</span>
                                <span class="intercom-emoji-picker-emoji" title="grin">&#x1F601;</span>
                                <span class="intercom-emoji-picker-emoji" title="pensive">&#x1F614;</span>
                                <span class="intercom-emoji-picker-emoji" title="relieved">&#x1F60C;</span>
                                <span class="intercom-emoji-picker-emoji" title="unamused">&#x1F612;</span>
                                <span class="intercom-emoji-picker-emoji" title="disappointed">&#x1F61E;</span>
                                <span class="intercom-emoji-picker-emoji" title="persevere">&#x1F623;</span>
                                <span class="intercom-emoji-picker-emoji" title="cry">&#x1F622;</span>
                                <span class="intercom-emoji-picker-emoji" title="joy">&#x1F602;</span>
                                <span class="intercom-emoji-picker-emoji" title="sob">&#x1F62D;</span>
                                <span class="intercom-emoji-picker-emoji" title="sleepy">&#x1F62A;</span>
                                <span class="intercom-emoji-picker-emoji" title="disappointed_relieved">&#x1F625;</span>
                                <span class="intercom-emoji-picker-emoji" title="cold_sweat">&#x1F630;</span>
                                <span class="intercom-emoji-picker-emoji" title="sweat_smile">&#x1F605;</span>
                                <span class="intercom-emoji-picker-emoji" title="sweat">&#x1F613;</span>
                                <span class="intercom-emoji-picker-emoji" title="weary">&#x1F629;</span>
                                <span class="intercom-emoji-picker-emoji" title="tired_face">&#x1F62B;</span>
                                <span class="intercom-emoji-picker-emoji" title="fearful">&#x1F628;</span>
                                <span class="intercom-emoji-picker-emoji" title="scream">&#x1F631;</span>
                                <span class="intercom-emoji-picker-emoji" title="angry">&#x1F620;</span>
                                <span class="intercom-emoji-picker-emoji" title="rage">&#x1F621;</span>
                                <span class="intercom-emoji-picker-emoji" title="triumph">&#x1F624;</span>
                                <span class="intercom-emoji-picker-emoji" title="confounded">&#x1F616;</span>
                                <span class="intercom-emoji-picker-emoji" title="laughing">&#x1F606;</span>
                                <span class="intercom-emoji-picker-emoji" title="yum">&#x1F60B;</span>
                                <span class="intercom-emoji-picker-emoji" title="mask">&#x1F637;</span>
                                <span class="intercom-emoji-picker-emoji" title="sunglasses">&#x1F60E;</span>
                                <span class="intercom-emoji-picker-emoji" title="sleeping">&#x1F634;</span>
                                <span class="intercom-emoji-picker-emoji" title="dizzy_face">&#x1F635;</span>
                                <span class="intercom-emoji-picker-emoji" title="astonished">&#x1F632;</span>
                                <span class="intercom-emoji-picker-emoji" title="worried">&#x1F61F;</span>
                                <span class="intercom-emoji-picker-emoji" title="frowning">&#x1F626;</span>
                                <span class="intercom-emoji-picker-emoji" title="anguished">&#x1F627;</span>
                                <span class="intercom-emoji-picker-emoji" title="imp">&#x1F47F;</span>
                                <span class="intercom-emoji-picker-emoji" title="open_mouth">&#x1F62E;</span>
                                <span class="intercom-emoji-picker-emoji" title="grimacing">&#x1F62C;</span>
                                <span class="intercom-emoji-picker-emoji" title="neutral_face">&#x1F610;</span>
                            </div>
                        </div>

                        <div class="justify-content-center col-12 position-absolute bottom-0 start-0 mb-5 mb-xl-3 px-3 TextInputTastbar">
                            <div class="d-flex bg-white rounded-pill py-1 border">
                                <div class="d-flex col-12 align-items-center">
                                    <div class="ps-2">
                                        <button
                                            class="btn btn-primary  btn_x documentselectionpin rounded-5 WhatsApp24HourButton border-0  p-0 px-2 bg-transparent  text-muted">
                                            <i class="fa-solid fa-paperclip"></i>
                                        </button>

                                    </div>
                                    <div class="ps-2">
                                        <button
                                            class="btn btn-primary  documentselectionpin emoji_btn WhatsApp24HourButton rounded-5 border-0 p-0 pe-2 bg-transparent  text-muted">
                                            <i class="bi bi-emoji-smile-fill"></i>

                                        </button>
                                    </div>
                                    <div class="input-group  position-relative ">
                                        <input type="text"
                                            class="form-control border rounded-pill p-1 px-lg-4 py-lg-2 border-0 massage_input"
                                            textval="" placeholder="Write a message...">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <!-- <div class="border rounded-circle d-flex bg-primary text-white justify-content-center WhatsApp24HourButton align-items-center text-end mic "
                                            style="width:50px; height:50px; margin-left:auto;" data-toggle="modal"
                                            data-target="#audiorecorder"><i class="fa-solid fa-microphone"></i>
                                        </div> -->
                                        <button
                                            class="btn btn-primary rounded-circle me-1 documentselectionpin mic WhatsApp24HourButton p-0 ps-2 border-0 bg-transparent text-muted"
                                            data-toggle="modal" data-target="#audiorecorder">
                                            <i class="fa-solid fa-microphone"></i>
                                        </button>
                                        <button
                                            class="btn btn-primary rounded-circle me-1 SendWhatsAppMessage send_massage WhatsApp24HourButton p-0 px-2 border-0 bg-transparent text-muted"
                                            data-conversion_id="" data-page_token="" data-page_id="" data-massage_id="">
                                            <i class="fa-regular fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="chat-nav-search-bar Setchatheadercolorclass  chat-header  p-2 col-12 text-white ">
                            <div
                                class="d-flex justify-content-between RemoveHeaderBorderDiv align-items-center text-white ">
                                <h5 class="fs-5 d-flex ps-2 profilepiccolor align-items-center text-white ">
                                    <i class="fa-solid fa-circle-user fs-4 me-2"></i>
                                    <span class="d-flex flex-wrap">
                                        <span class="username col-12 d-block UserChatName fs-6">User Name</span>
                                        <span class="in_chat_page_name fs-12 col-12 d-block"></span>
                                    </span>
                                </h5>
                                <button class="bg-transparent border-0 d-none">
                                    <i class="fa-regular fa-star"></i></button>
                            </div>
                        </div>

                        <div class=" mt-2 p-2 overflow-y-scroll chat_bord col-12 pb-5 pb-xl-2" id="user_msg_send_div"
                            style="max-height:80%;">

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
                        <div class="d-xl-none">
                            <button class="back-button1 text-muted border-0  bg-white position-absolute bottom-0 start-0  py-1 border-top w-100 text-start px-2">
                                <i class="fa-solid fa-angle-left fs-14"></i><span class="mx-1">Back</span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- document-modal -->
<div class="modal fade data_add_div PinToDocumentSelectClass " id="" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title email_title_model_change">Add Document</h1>
                <button type="button" class="btn-close close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-secondery">
                <form class="needs-validation add_form_Email" id="add_form_Email" name="add_form_Email" novalidate
                    enctype="multipart/form-data">
                    <div class="upload-btn-wrapper col-12">
                        <div class="file-btn col-12">
                            <div class="col-12 justify-content-center d-flex">
                                <i class="bi bi-cloud-download"></i>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                                <h4>Drop Files here or click to upload</h4>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                                <p>Allowed IMAGES, VIDEOS, PDF, DOC, EXCEL, PPT, TEXT</p>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                                <p>Max 5 files and max size of 3 MB</p>
                            </div>
                        </div>
                        <input class="form-control main-control place attachment_email_text update_attachment_email"
                            id="attachment" name="attachment[]" multiple="multiple" type="file" placeholder="" />


                    </div>
                    <div class="col-12 input-text">
                        <div class="file_view_add1 file_view_add_Email  file_view_add_Email_add" id="file_view_add1">
                        </div>
                        <div class="file_view file_view_edit file_view_edit_add" id="file_view">
                        </div>
                        <div id="file_uploded" class="file_uploded file_uploded_edit file_uploded_edit_add"> </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary SendDocumentForWhatsApp email_add_model_submit"
                    DataFileTypeStatus="" data-edit_id="" id="save_btn_email">Send</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="audiorecorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Audio recorder</h5>
                <button type="button" class="close btn btn-transparent fs-5" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <button class="btn btn-secondary m-2 start-rec" id="startButton">start recording</button>
                    <button class="btn btn-secondary m-2 end-rec" id="stopButton" disabled>stop recording</button>
                </div>
                <div class="rounded-pill mt-2 pt-2 d-flex p-2 border">
                    <audio id="audioPlayer" controls></audio>
                    <!-- <div class="d-flex  p-1 px-2">
            <i class="fa-solid fa-play"></i>
            <i class="fa-solid fa-pause d-none"></i>
            </div>
            <div id="audioPlayer">0:00</div>
            <div class="mt-2 mx-1" style="width:250px; height:4px; background:#d3d3d378;" id="audioPlayer" controls></div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary send">send</button>
            </div>
        </div>
    </div>
</div>



<?= $this->include('partials/footer') ?>
<script>
    document.getElementById('btnPause').addEventListener('change', function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('canvas').src = e.target.result;
        };
        reader.readAsDataURL(file);
        console.log('dishant');
    });
    document.getElementById('update_image').addEventListener('change', function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('im-image').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('insert_image').addEventListener('change', function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-image').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>
<script>
    $(document).ready(function () {
        function emojiToCode(emoji) {
            let code = emoji.codePointAt(0).toString(16);
            return '&#x' + code + ';';
        }

        $(".btn_x").click(function (e) {
            e.stopPropagation();
            $(".emoji_div_man").hide();
            $(".accordion_item_div").toggle();
        });

        $(".emoji_btn").click(function (e) {
            e.stopPropagation();
            $(".accordion_item_div").hide();
            $(".emoji_div_man").toggle();
        });




        $("body").on("click", ".intercom-emoji-picker-emoji", function (e) {
            e.stopPropagation();
            let emoji = $(this).html();
            let htmlCode = emojiToCode(emoji);
            currentInput = $('.massage_input').val();
            $(".massage_input").val(currentInput + emoji);
        });


        



    });
</script>
<script>
    (function () {
        if (
            !"mediaDevices" in navigator ||
            !"getUserMedia" in navigator.mediaDevices
        ) {
            return;
        }
        const video = document.querySelector("#video");
        const btnPlay = document.querySelector("#btnPlay");
        const btnScreenshot = document.querySelector("#btnScreenshot");
        const btnChangeCamera = document.querySelector("#btnChangeCamera");
        const screenshotsContainer = document.querySelector("#screenshots");
        const canvas = document.querySelector("#canvas");
        const devicesSelect = document.querySelector("#devicesSelect");
        const constraints = {
            video: {
                width: {
                    min: 300,
                    ideal: 1080,
                    max: 750,
                },
                height: {
                    min: 300,
                    ideal: 1080,
                    max: 500,
                },
            },
        };

        let useFrontCamera = true;
        let videoStream;
        btnPlay.addEventListener("click", function () {
            video.play();
            btnPlay.classList.add("is-hidden");
            btnPause.classList.remove("is-hidden");
        });
        let imageSequenceCounter = 1;
        let capturedImageUrl;
        let imageFile;
        let uploadedFilename;
        btnPause.addEventListener("click", function () {
            video.pause();
            btnPause.classList.add("is-hidden");
            btnPlay.classList.remove("is-hidden");
            const canvas = document.querySelector("#canvas");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext("2d").drawImage(video, 0, 0);
            const uniqueFilename = "image_" + imageSequenceCounter + ".png";
            imageSequenceCounter++;
            const dataUrl = canvas.toDataURL("image/png");
            console.log(dataUrl);
            $('.SendImage').attr('imagebase64', dataUrl);
            const blob = dataURLToBlob(dataUrl);
            // console.log(blob);
            const timeZone = 'Asia/Kolkata';
            const now = new Date().toLocaleString('en-US', {
                timeZone,
                timeZoneName: 'short'
            });
            const formattedDateTime = now.replace(/[^0-9]/g, '');
            const updatedFilename = 'camera' + formattedDateTime + '.png';
            imageFile = new File([blob], updatedFilename);
            localStorage.setItem(updatedFilename, imageFile);
            btnPause.setAttribute('uniqueFilename', updatedFilename);
            uploadImageToPath(imageFile, function (uploadedFileName) {
                uploadedFilename = uploadedFileName;
            });
            $('#preview-image').attr('src', dataUrl);
            console.log(dataUrl);
            $('#preview-image').attr('ImageStatus', 1);
            $('#preview-image').attr('PhoToName', updatedFilename)
        });

        function dataURLToBlob(dataURL) {
            const byteString = atob(dataURL.split(',')[1]);
            const mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], {
                type: mimeString
            });
        }

        // function uploadImageToPath(imageFile) {}
        // let imageSequenceCounte = 1;
        // let capturedImageUr;
        // let imageFil;
        // SendWhatsAppMessage.addEventListener("click", function() {
        //     alert();
        //     video.pause();
        //     SendWhatsAppMessage.classList.add("is-hidden");
        //     btnPlay.classList.remove("is-hidden");
        //     const canvas = document.querySelector("#canvas");
        //     canvas.width = video.videoWidth;
        //     canvas.height = video.videoHeight;
        //     canvas.getContext("2d").drawImage(video, 0, 0);
        //     const uniqueFilename = "image_" + imageSequenceCounte + ".png";
        //     imageSequenceCounte++;
        //     const dataUrl = canvas.toDataURL("image/png");
        //     const blob = dataURLToBlob(dataUrl);
        //     imageFil = new File([blob], uniqueFilename);
        //     localStorage.setItem(uniqueFilename, imageFil);
        //     SendWhatsAppMessage.setAttribute('uniqueFilename', uniqueFilename);
        //     uploadImageToPath(imageFil);
        // });

        function dataURLToBlob(dataURL) {
            const byteString = atob(dataURL.split(',')[1]);
            const mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], {
                type: mimeString
            });
        }
        btnScreenshot.addEventListener("click", function () {
            const img = document.createElement("img");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext("2d").drawImage(video, 0, 0);
            img.src = canvas.toDataURL("image/png");
        });
        btnChangeCamera.addEventListener("click", function () {
            useFrontCamera = !useFrontCamera;
            initializeCamera();
        });


        function stopVideoStream() {
            if (videoStream) {
                videoStream.getTracks().forEach((track) => {
                    track.stop();
                });
            }
        }
        async function initializeCamera() {
            stopVideoStream();
            constraints.video.facingMode = useFrontCamera ? "user" : "environment";
            try {
                videoStream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = videoStream;
                $('#camera_modal').modal('show');
                const cameraButton = document.querySelector(".modal_hide");
                cameraButton.setAttribute("data-bs-target", "#camera_modal");
            } catch (err) {
                iziToast.error({
                    title: 'Could not access the camera'
                });
                setTimeout(function () {
                    $('#camera_modal').modal('hide');
                }, 500);
            }
        }
        $('body').on('click', '.documentselectionpin', function () {
            // alert();
            const cameraButton = document.querySelector(".modal_hide");
            cameraButton.setAttribute("data-bs-target", "");
            iziToast.hide({
                id: iziToast
            });
            initializeCamera();
        });
        $('body').on('click', '.CameraOpenModelBtn', function () {
            const cameraButton = document.querySelector(".modal_hide");
            cameraButton.setAttribute("data-bs-target", "#camera_modal");
            initializeCamera();
        });
        $('body').on('click', '.NoBtn', function () {
            initializeCamera();
        });
        $('body').on('click', '.SecoundButton', function () {
            stopVideoStream();
        });
        $('body').on('click', '.CloseButtonCamera', function () {
            stopVideoStream();
        });
        $('body').on('click', '.CameraOpenModelBtn', function () {

            $('.firstBtn').show();
            $('.SecoundButton').hide();
            $('#btnPlay').trigger('click');
        });
        $('body').on('click', '.TakePic', function () {
            $('#btnPause').trigger('click');
            $('.firstBtn').hide();
            $('.SecoundButton').show();
        });

        $('body').on('click', '.NoBtn', function () {
            $('#btnPlay').trigger('click');
            $('.firstBtn').show();
            $('.SecoundButton').hide();
        });

    })();
</script>
<!-- <script>
  $(document).ready(function() {
    var timerInterval;
    var totalSeconds = 0;
    var audioPlayer = $('#audioPlayer');

    function startTimer() {
      timerInterval = setInterval(function () {
        totalSeconds++;
        var minutes = Math.floor(totalSeconds / 60);
        var remainingSeconds = totalSeconds % 60;
        var formattedTime = pad(minutes) + ":" + pad(remainingSeconds);
        audioPlayer.text(formattedTime);
      }, 1000);
    }

    function stopTimer() {
      clearInterval(timerInterval);
    }

    function pad(val) {
      var valString = val + "";
      if (valString.length < 2) {
        return "0" + valString;
      } else {
        return valString;
      }
    }

    $('.start-rec').click(function () {
      startTimer();
    });

    $('.end-rec').click(function () {
      stopTimer();
    });
  });
</script> -->
<script src="script.js"></script>

<script>
    $('body').on('click', '.account-box', function () {

        $(this).addClass('active-account-box');
        $(this).siblings().removeClass('active-account-box');

    });
    $('body').on('click', '.chat-account-box', function () {

        $(this).addClass('chat-account-active');
        $(this).siblings().removeClass('chat-account-active');

    });

    function scrollToBottom() {
        const fileViewDiv = document.getElementById('user_msg_send_div');
        fileViewDiv.scrollTop = fileViewDiv.scrollHeight;
    }

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
                    // ====kjhsdhj==
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

                    // if ($('.chat-box').css('display') !== 'none') {
                    //     $('.common-options').removeClass('linked-page');
                    // }
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
            $('.username').text('User Name');
            $('.in_chat_page_name').text('');
            $('.chat_bord').html('');
            list_data(false, 'chat_list', page_id, page_access_token, platform);
        });

        $('body').on('click', '.chat_list', function () {
            var conversion_id = $(this).data('conversion_id');
            var page_access_token = $(this).data('page_token');
            var page_id = $(this).data('page_id');
            var user_name = $(this).data('user_name');
            var platform = $(this).data('platform');
            var page_name = $('.page_name').text();
            var sender_id = $(this).data('sender_id');
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
                    beforeSend: function () {
                        $('.massage_list_loader').show();
                        $('.noRecourdFound').hide();
                    },
                    success: function (data) {
                        var obj = JSON.parse(data);
                        $('.massage_list_loader').hide();
                        $('.chat_bord').show();
                        $('.chat_bord').html(obj.html);
                        scrollToBottom();
                        $('.noRecourdFound').hide();
                        $('.username').text(user_name);
                        $('.in_chat_page_name').text(page_name + '(' + platform + ')');
                        $('.send_massage').attr("data-conversion_id", conversion_id);
                        $('.send_massage').attr("data-page_token", page_access_token);
                        $('.send_massage').attr("data-page_id", page_id);
                        $('.send_massage').attr("data-sender_id", sender_id);
                        // $('.send_massage').attr("data-massage_id", massage_id);
                    }
                });
                return false;
            }
        });

        $('.massage_list_loader').hide();

        $('body').on('click', '.send_massage', function () {
            var massage_input = $('.massage_input').val();
            var conversion_id = $(this).data("conversion_id");
            var page_access_token = $(this).data("page_token");
            var page_id = $(this).data("page_id");
            var sender_id = $(this).data("sender_id");
            // var massage_id = $(this).attr("data-massage_id");
            if(massage_input != '' && conversion_id != '' && page_access_token != '' && page_id != '') {
            $.ajax({
                method: "post",
                url: "<?= site_url('send_massage'); ?>",
                data: {
                    action: 'chat_massage_list',
                    conversion_id: conversion_id,
                    page_access_token: page_access_token,
                    sender_id: sender_id,
                    page_id: page_id,
                    massage: massage_input,
                },
                success: function (data) {
                    var obj = JSON.parse(data);
                    if(obj.status == 0){
                            iziToast.error({
                                title: obj.msg,
                            });
                        } else {
                            $('.chat_bord').append(obj.html);
                            scrollToBottom();
                            $('.massage_input').val('');
                        }
                    }
            });
            } 
        });
    });

    $('body').on('click', '.WA_account_listTab', function () {
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
        $('.page_name').html('<p class="">' + name + '</p><button class="btn-primary-rounded add AddModelContactNO  ms-2" phoneno="' + phoneno + '" conversation_id = "' + id + '"  data-tbs-toggle="tooltip" data-bs-placement="right" data-bs-title="Add Contact" type="button" data-bs-toggle="modal" data-bs-target="#modal_view" aria-describedby="tooltip576329" aria-controls="inquiry_all_status_update"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M28 22.5h-3.5V19a1 1 0 0 0-2 0v3.5H19a1 1 0 0 0 0 2h3.5V28a1 1 0 0 0 2 0v-3.5H28a1 1 0 0 0 0-2z" fill="#f3f3f3" opacity="1" data-original="#f3f3f3" class=""></path><path d="M16 29H6a1 1 0 0 1-1-1 11.013 11.013 0 0 1 11-11 8.025 8.025 0 1 0-4.289-1.258A13.012 13.012 0 0 0 3 28a3 3 0 0 0 3 3h10a1 1 0 0 0 0-2zM10 9a6 6 0 1 1 6 6 6.006 6.006 0 0 1-6-6z" fill="#f3f3f3" opacity="1" data-original="#f3f3f3" class=""></path></g></svg></button>');
        $.ajax({
            method: "post",
            url: "WhatsAppAccountsContactList",
            data: {
                id: id,
                phoneno: phoneno,
                name: name
            },
            success: function (data) {
                var data = JSON.parse(data);
                $('.chat_list').html(data.html);
                $('.SetContactListHtml').html(data.htmlcontactlist);
            }
        });
    });

    $('body').on('click', '.ChatClickOpenHtml', function () {
        $('.chat_bord').html('');
        $('.UserChatName').text('User Name');
        $('.in_chat_page_name').text('');
        var contact_no = $(this).attr('contact_no');
        var conversation_account_id = $(this).attr('conversation_account_id');
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
                conversation_account_id: conversation_account_id,
            },
            success: function (data) {
                $('.massage_list_loader').hide();
                $('.chat_bord').html(data);
            }
        });
    });

    $('body').on('click', '.SendWhatsAppMessage', function () {
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
                success: function (data) {
                    $('.chat_list .active-account-box').trigger('click');
                }
            });
            $('.massage_input').val('');
        }
    });

    $('body').on('keydown', '.massage_input', function (event) {
        var text = $(this).val();
        // console.log(text);
        $(this).attr('textval', text);

        if (event.which === 13) {
            $('.SendWhatsAppMessage').trigger('click');
            $('.send_massage').trigger('click');
        }
    });

    $('body').on('click', '.accordion-header', function () {
        $('.SendWhatsAppMessage').attr('datasenderid', '');
        $('.SendWhatsAppMessage').attr('dataphoneno', '');

    });

    $('body').on('click', '.SendContactNumber', function () {
        var contactList = [];
        var count = 0;
        var DataSenderId = $('.SendWhatsAppMessage').attr('DataSenderId');
        var DataPhoneno = $('.SendWhatsAppMessage').attr('DataPhoneno');

        $('.ContactNoSelectionCheckbox:checked').each(function () {
            var name = $(this).attr('name');
            var phoneno = $(this).attr('phoneno');
            count = count + 1;
            contactList.push({
                name: name,
                phoneno: phoneno
            });
        });
        var jsonString = JSON.stringify(contactList);
        if (count > 0) {
            if (DataSenderId != '' && DataPhoneno != "") {
                $.ajax({
                    method: "post",
                    url: "SendWhatsAppContactNumber",
                    data: {
                        DataSenderId: DataSenderId,
                        DataPhoneno: DataPhoneno,
                        contactstring: jsonString
                    },
                    success: function (data) {
                        $('.close').trigger('click');
                    }
                });
            }
        }
    });


    $('body').on('click', '.DirecttoMsg', function () {
        var phoneno = $(this).attr('phoneno');
        $('.' + phoneno).trigger('click');


    });

    $('body').on('click', '.AddWhatsAppContactNO', function () {
        var connection_id = $(this).attr('connection_id');
        var name = $(this).attr('name');
        var phone_no = $(this).attr('phone_no');
        var account_phone_no = '';
        account_phone_no = $('.chat_list .active-account-box').attr('account_phone_no');
        var activeno = $(this).attr('activeno');
        $.ajax({
            method: "post",
            url: "WhatsAppInsertData",
            data: {
                action: 'contactadd',
                connection_id: connection_id,
                name: name,
                phone_no: phone_no,
                account_phone_no: account_phone_no,
            },
            success: function (data) {
                $('.WhatsAppAccountListTab .active-account-box').trigger('click');
                setTimeout(function () {
                    $('.' + activeno).trigger('click');
                }, 500);
            }
        });
    });
    $("#mobile_code").intlTelInput({
        initialCountry: "in",
        separateDialCode: true,
        // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });


    $('body').on('click', '.AddWhatsAppContactNumber', function () {
        var ContactNameClass = $('.ContactNameClass').val();
        var ContactNumberClass = $('.ContactNumberClass').val();
        var countrey_code = $('.iti__selected-dial-code').text();
        var phoneNumber1 = ContactNumberClass.toString();
        var connection_id = $('.AddModelContactNO').attr('conversation_id');
        var account_phone_no = $('.AddModelContactNO').attr('phoneno');
        var finalname = countrey_code + ContactNumberClass;
        var phoneNumber = finalname;
        var cleanedPhoneNumber = phoneNumber.replace(/[\s\+\-\(\)]/g, '');

        account_phone_no = account_phone_no.replace(/[\s\+\-\(\)]/g, '');
        var activeno = $('.chat_list .active-account-box').attr('contact_no');
        if (activeno != '' && activeno !== undefined && activeno !== 'undefined') {
            activeno = activeno.replace(/[\s\+\-\(\)]/g, '');

        }

        if (ContactNameClass != '' && ContactNumberClass != '' && countrey_code != '' && phoneNumber1.length == "10" && connection_id != '' && account_phone_no != '') {
            $.ajax({
                method: "post",
                url: "WhatsAppInsertData",
                data: {
                    action: 'manualcontactadd',
                    connection_id: connection_id,
                    name: ContactNameClass,
                    phone_no: cleanedPhoneNumber,
                    account_phone_no: account_phone_no,
                },
                success: function (data) {

                    if (data == '1') {
                        $('.WhatsAppAccountListTab .active-account-box').trigger('click');
                        $('.CloseBtn').trigger('click');
                        setTimeout(function () {
                            $('.' + activeno).trigger('click');
                            iziToast.success({
                                title: "Added Successfully"
                            });
                        }, 500);
                    } else {
                        iziToast.error({
                            title: "Duplicate Number"
                        });
                    }

                }
            });
        }
    });


    $('body').on('click', '.AddModelContactNO', function () {
        $('.ContactNameClass').val('');
        $('.ContactNumberClass').val('');
    });


    $('body').on('click', '.ListedMessage', function () {
        $('.Setchatheadercolorclass').removeClass('chatheadercolorclass');
        $('.SetChatBackGroundClass').removeClass('ChatBackGroundClass');
        $('.documentselectionpin').removeClass('chatheadercolorclass');
        $('.SendWhatsAppMessage').removeClass('chatheadercolorclass');
        // $('.RemoveHeaderBorderDiv').addClass('border-bottom');
        // $('.UserChatName').removeClass('text-white');
        // $('.profilepiccolor').removeClass('text-white');
        $('.chat_bord').html('');
        setTimeout(function () {
            // $('.UserChatName').addClass('text-dark');
            // $('.profilepiccolor').addClass('text-dark');

        }, 500);

        $(".WhatsApp24HourButton").prop("disabled", false);
        $('.AddModelContactNO').removeClass('chatheadercolorclasswithheader');
        $(".TextInputTastbar").removeClass("d-none"); 
        $(".chat_bord").removeClass("chat_bordClass");
    });

    $('body').on('click', '.WhatsAppListedMessage', function () {
        $('.Setchatheadercolorclass').addClass('chatheadercolorclass');
        $('.SetChatBackGroundClass').addClass('ChatBackGroundClass');
        // $('.documentselectionpin').addClass('chatheadercolorclass');
        // $('.SendWhatsAppMessage').addClass('chatheadercolorclass');
        $('.RemoveHeaderBorderDiv').removeClass('border-bottom');
        $('.UserChatName').removeClass('text-dark');
        $('.profilepiccolor').removeClass('text-dark');
        $('.UserChatName').addClass('text-white');
        $('.profilepiccolor').addClass('text-white');
        $('.massage_input').val('');
        $('.chat_bord').html('');
        $('.AddModelContactNO').addClass('chatheadercolorclasswithheader');
    });


    $('body').on('click', '.ContactModelOpen', function () {
        $('.ContactNoSelectionCheckbox').prop('checked', false);
    })




    // =====mobile-jqury=======
    $('body').on('click', '.linked-page', function () {
        $(this).closest('.main-box').addClass('d-none');
        $('.chat-box').removeClass('d-none');
    })
    $('.file_view_add_Email').on('click', '#file_crodd_btn_email', function () {
        $(this).closest('div').remove();
    });

    $('.attachment_email_text').on('change', function () {
        var files = $(this).prop('files');
        for (var i = 0; i < files.length; i++) {
            var fileName = files[i].name;
            $('.file_view_add_Email').append('<div id="u_btn" class="col-12 u_btn_Email m-1 rounded view-file-link px-2 d-flex u_btn"><p>' + fileName + '</p><span class="ms-auto" id="file_crodd_btn_email"><i class="bi bi-x-circle"></i></span></div>')
        }
    }); $('body').on('click', '.linked-page1', function () {
        $(this).closest('.main-box').addClass('d-lg-none');
        $(this).closest('.main-box').addClass('d-none');
        $('.transcript_box').removeClass('d-none');
        // alert('hhsd');
    })
    $('body').on('click', '.back-button', function () {
        $(this).closest('.main-box').addClass('d-none');
        $('.social-accounts').removeClass('d-none');
    })
    $('body').on('click', '.back-button1', function () {
        $(this).closest('.main-box').addClass('d-none');
        $('.chat-box').removeClass('d-none');
        $('.chat-box').removeClass('d-lg-none');
    })
    // ======tabalate-jqury======
    // $(document).ready(function() {


    // })
    // $(window).on('load',function(){
    //     if ($('.chat-box').css('display') !== 'none') {
    //         // alert()
    //         var a = $('.common-options').html();
    //         alert(a);
    //         $('.common-options').removeClass('linked-page');
    //     }
    // })
    $('body').on('click', '.SendDocumentForWhatsApp', function () {
        // alert();
        //  1 For Document
        // 2 For Image 
        var DataFileTypeStatus = $(this).attr('DataFileTypeStatus');
        var doctype = '';
        var doccorrection = 0;
        if (DataFileTypeStatus == '1') {
            doctype = 'document';
            doccorrection = 1;
        }


        var pText_add = "";
        var form = $("form[name='add_form_Email']")[0];
        var DataSenderId = $('.SendWhatsAppMessage').attr('DataSenderId');
        var DataPhoneno = $('.SendWhatsAppMessage').attr('DataPhoneno');
        var formData = new FormData(form);
        $(".u_btn_Email p").each(function () {
            pText_add += $(this).text().trim() + ",";
        });
        var title = $(".email_whatapp_title").val();
        pText_add = pText_add.slice(0, -1);
        // console.log(pText_add);
        if (DataFileTypeStatus == '2') {
            doctype = 'image';
            var checkimgsatus = 0;
            var filenamesArray = pText_add.split(',');
            for (var i = 0; i < filenamesArray.length; i++) {
                var fileName = filenamesArray[i].trim();
                var fileExtension = fileName.split('.').pop().toLowerCase();
                var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'mp4', 'avi', 'mkv', 'mov', 'wmv'];
                if (imageExtensions.indexOf(fileExtension) !== -1) {
                } else {
                    checkimgsatus = parseInt(checkimgsatus) + 1;
                }
            }
            if (parseInt(checkimgsatus) > 0) {
                doccorrection = 0;
            } else {
                doccorrection = 1;
            }
        }

        // console.log(doccorrection);

        formData.append('attachment', pText_add);
        formData.append('DataSenderId', DataSenderId);
        formData.append('DataPhoneno', DataPhoneno);
        formData.append('doctype', doctype);

        if (doccorrection == '1' && DataSenderId !== undefined && DataSenderId !== "undefined" && DataSenderId != '' && DataPhoneno !== undefined && DataPhoneno !== "undefined" && DataPhoneno != '') {
            $.ajax({
                type: 'POST',
                url: 'WhatsAppSendDocumentData',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $(".close_btn").trigger("click");
                    $('.chat_list .active-account-box').trigger('click');

                }
            });
        }
    });


    $('body').on('click', '.SendImageAndPhotosClass', function () {
        $('.SendDocumentForWhatsApp').attr('DataFileTypeStatus', 2);
        $('.u_btn_Email').html('');

    });
    $('body').on('click', '.DocumentSelectionForSendClickEventClass', function () {
        $('.SendDocumentForWhatsApp').attr('DataFileTypeStatus', 1);
        $('.u_btn_Email').html('');
    });



    $('body').on('click', '.SendImage', function () {
        // alert();
        var imagebase64 = $(this).attr('imagebase64');
        var DataSenderId = $('.SendWhatsAppMessage').attr('DataSenderId');
        var DataPhoneno = $('.SendWhatsAppMessage').attr('DataPhoneno');
        if (imagebase64 != '' && DataSenderId != '' && DataPhoneno != '') {
            $.ajax({
                type: 'POST',
                url: 'sendwhatsappcamera',
                data: {
                    'SendUrl': imagebase64,
                    DataSenderId: DataSenderId,
                    DataPhoneno: DataPhoneno,
                },

                success: function (data) {

                }
            });
        }
        // console.log(imagebase64);  
    })


    $(document).ready(function () {
        const audioWrapper = $(".c-wa-audio");
        const playPause = $(".c-wa-audio__control-play");
        const playpauseBtn = $(".c-wa-audio__control-play");
        const progress = $(".c-wa-audio__time-progress");
        const sliders = $(".c-wa-audio__time-slider");
        const player = $("audio");
        const currentTime = $(".c-wa-audio__time-current");
        const totalTime = $(".c-wa-audio__time-total");

        //     let draggableClasses = ["c-wa-audio__time-pin"];
        //     let currentlyDragged = null;

        //     $(document).on("mousedown", function (event) {
        //         if (!isDraggable($(event.target))) return false;

        //         currentlyDragged = event.target;
        //         let handleMethod = $(currentlyDragged).data("method");

        //         $(document).on("mousemove", window[handleMethod]);

        //         $(document).on("mouseup", function () {
        //             currentlyDragged = false;
        //             $(document).off("mousemove", window[handleMethod]);
        //         });
        //     });

        //     playpauseBtn.on("click", togglePlay);
        //     player.on("timeupdate", updateProgress);
        //     player.on("loadedmetadata", function () {
        //         totalTime.text(formatTime(player.duration));
        //     });
        //     player.on("canplay", makePlay);
        //     player.on("ended", function () {
        //         changePlayPauseIcon(true);
        //         player.currentTime = 0;
        //     });

        //     sliders.each(function () {
        //         let pin = $(this).find(".c-wa-audio__time-pin");
        //         $(this).on("click", window[pin.data("method")]);
        //     });

        //     function isDraggable(el) {
        //         let canDrag = false;
        //         let classes = Array.from($(el).attr("class").split(" "));
        //         draggableClasses.forEach(function (draggable) {
        //             if (classes.indexOf(draggable) !== -1) canDrag = true;
        //         });

        //         return canDrag;
        //     }

        //     function inRange(event) {
        //         let rangeBox = getRangeBox(event);
        //         let rect = rangeBox.getBoundingClientRect();
        //         let direction = $(rangeBox).data("direction");

        //         if (direction == "horizontal") {
        //             const min = 0;
        //             const max = rect.width;
        //             const clientX = event.clientX - rect.left;

        //             if (clientX < min || clientX > max) return false;
        //         } else {
        //             var min = rect.top;
        //             var max = min + rangeBox.offsetHeight;
        //             if (event.clientY < min || event.clientY > max) return false;
        //         }
        //         return true;
        //     }

        //     function updateProgress() {
        //         const current = player.currentTime;
        //         const percent = (current / player.duration) * 100;
        //         progress.css("width", percent + "%");

        //         currentTime.text(formatTime(current));
        //     }

        //     function getRangeBox(event) {
        //         let rangeBox = event.target;
        //         let el = currentlyDragged;
        //         if (event.type == "click" && isDraggable(event.target)) {
        //             rangeBox = $(event.target).parent().parent();
        //         }
        //         if (event.type == "mousemove") {
        //             rangeBox = $(el).parent().parent();
        //         }
        //         return rangeBox;
        //     }

        //     function getCoefficient(event) {
        //         let slider = getRangeBox(event);
        //         let rect = slider.getBoundingClientRect();
        //         let K = 0;
        //         if ($(slider).data("direction") == "horizontal") {
        //             const offsetX = event.clientX - rect.left;
        //             let width = slider.clientWidth;
        //             K = offsetX / width;
        //         } else if ($(slider).data("direction") == "vertical") {
        //             let height = slider.clientHeight;
        //             var offsetY = event.clientY - rect.top;
        //             K = 1 - offsetY / height;
        //         }

        //         return K;
        //     }

        //     function rewind(event) {
        //         console.warn("a");
        //         if (inRange(event)) {
        //             player.currentTime = player.duration * getCoefficient(event);
        //         }
        //     }

        //     function formatTime(time) {
        //         var min = Math.floor(time / 60);
        //         var sec = Math.floor(time % 60);
        //         return min + ":" + (sec < 10 ? "0" + sec : sec);
        //     }

        //     function togglePlay() {
        //         if (player.paused) {
        //             changePlayPauseIcon(false);
        //             player.play();
        //         } else {
        //             changePlayPauseIcon(true);
        //             player.pause();
        //         }
        //     }

        //     function makePlay() {
        //         playpauseBtn.css("display", "block");
        //     }

        //     function changePlayPauseIcon(play = false) {
        //         if (play) {
        //             playPause.removeClass("fa-pause").addClass("fa-play");
        //         } else {
        //             playPause.removeClass("fa-play").addClass("fa-pause");
        //         }
        //     }
        // });

        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const audioPlayer = document.getElementById('audioPlayer');

        let mediaRecorder;
        let audioChunks = [];

        startButton.addEventListener('click', startRecording);
        stopButton.addEventListener('click', stopRecording);

        async function startRecording() {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.addEventListener('dataavailable', event => {
                audioChunks.push(event.data);
            });

            mediaRecorder.addEventListener('stop', () => {
                const audioBlob = new Blob(audioChunks, { 'type': 'audio/mp3' });
                const audioUrl = URL.createObjectURL(audioBlob);
                audioPlayer.src = audioUrl;

                // Send the audio data to the server
                saveAudio(audioBlob);
            });

            startButton.disabled = true;
            stopButton.disabled = false;

            mediaRecorder.start();
        }

        function stopRecording() {
            mediaRecorder.stop();
            startButton.disabled = false;
            stopButton.disabled = true;
        }

        function saveAudio(audioBlob) {
            const formData = new FormData();
            formData.append('audio', audioBlob);
            $.ajax({
                method: "POST",
                url: "<?= site_url('audio_file'); ?>",
                data: formData,
                processData: false, // Set processData to false to prevent jQuery from automatically processing the data
                contentType: false, // Set contentType to false to prevent jQuery from automatically setting the Content-Type header
                success: function (res) {
                    // Handle success response here
                    console.log('Audio uploaded successfully:', res);
                    $('.loader').hide();
                },
                error: function (xhr, status, error) {
                    // Handle error response here
                    console.error('Error:', error);
                    $('.loader').hide();
                }
            });
        }
        $('.send').click(function () {
            if (audioChunks.length > 0) {
                const audioBlob = new Blob(audioChunks, { type: 'audio/mp3' });
                saveAudio(audioBlob);
            } else {
                console.error('No audio recorded.');
            }
        });
    });

    $('body').on('click','.hide-panel',function(){
        $('.social-accounts').addClass('d-none');
        $('.chat-box').removeClass('d-none');
    })

    if (!("Notification" in window)) {
        alert("This browser does not support desktop notifications.");
    }






    // handleDataAvailable();
    // $(document).ready(function () {
        //     // setInterval(function () {
    //     //     handleDataAvailable();
    //     // }, 3000);
                    // });
                
    // function handleDataAvailable(event) {
    //     $.ajax({
    //         method: "POST",
    //         url: "<?= site_url('check_new_data_Available'); ?>",
    //         data: {
    //             table: 'admin_notify_message'
    //         },
    //         success: function (res) {
    //             var res_data = JSON.parse(res);
    //             // console.log(res_data.msg);
    //             if (res_data.status == 1 && res_data.msg != '') {
    //                 Notification.requestPermission().then(function (permission) {
    //                     if (permission === 'granted') {
    //                         // console.log(Notification);
    //                         var msg = { msg: res_data.msg };
    //                         var notification = new Notification(msg);
    //                     }
    //                 });
    //             }
    //         }
    //     });
    // }

</script>