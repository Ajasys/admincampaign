<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php $table_username = getMasterUsername(); ?>
<?php
$language_name = json_decode($language_name, true);
?>
<style>
    .wa-preview-main-div-cont {
        max-width: 500px;
        margin: auto;
    }

    .preview-header-paragraph .user-name-chat-header {
        font-size: 13px;
        font-family: 'poppins', sans-serif;
        color: black;
        text-align: left;
        font-weight: bold;
    }

    .preview-chat-paragraph .msg-text-chat {
        font-size: 12px;
    }

    .preview-footer-paragraph .user-name-chat-footer {
        font-size: 9px;
    }


    .preview-header-main-cont {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #095f54;
        padding: 10px;
        color: #fff;
    }

    .header-image img {
        border-radius: 50%;
        max-width: 40px;
        height: auto;
    }

    .preview-header-text {
        flex-grow: 1;
        margin-left: 10px;
    }


    .wa-phone-header {
        display: flex;
    }

    .wa-phone-header i {
        font-size: 18px;
        margin-right: 10px;
        color: #fff;
        cursor: pointer;
    }

    /* .preview-chat-section {
    background-color: #f1ede5;
    width: 100%;
    height: calc(100% - 100px) !important;
    object-fit: cover;
    object-position: center;
    padding: 10px;
    position: relative;
    overflow-y: auto;
} */

    .preview-chat-section {
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        object-fit: cover;
    }


    .preview-chat-section-chat {
        padding: 10px;
        height: calc(45vh - 10px);
        background-color: #F1EDE5;
        min-height: 503px;
        max-height: 503px;
    }

    .preview-chat-paragraph {
        margin-bottom: 10px;
        font-size: small;
        word-break: break-all;
        text-align: left;
        color: black;
        background-color: #fff;
        word-break: break-all;
        border-radius: 0px 30px 30px 30px;

    }

    .preview-chat-paragraph>p {
        word-break: break-all;
    }

    .single-t-text-chat {
        white-space: pre-line;
        font-size: 13px !important;
        padding: 6px 10px;
        color: black;
        word-break: break-word;
        font-family: 'Poppins', sans-serif;
    }

    .preview-chat-paragraph1 {
        margin-bottom: 10px;
        word-break: break-all;
        text-align: left;
        color: black;
        max-width: '100%';
        height: 'auto';

    }

    .preview-chat-paragraph1>* {
        margin-top: 10px;
    }



    .cwt-info-facebook,
    .cwt-info-whatsapp {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 199, 89, 1);
        background: rgba(255, 199, 89, 0.12);
        border-radius: 4px;
    }

    .cwt-info-whatsapp {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .cwt-info-facebook p,
    .cwt-info-whatsapp p {
        margin: 0;
        color: #212529;
        font-size: 12px;
    }


    /* .preview-call-button {
        background-color: #095f54;
        color: #fff;
        padding: 10px;
        text-align: center;
        cursor: pointer;
    } */

    .preview-whatsapp-footer {
        background-color: #F1EDE5;
        padding: 10px;
        text-align: center;
        cursor: pointer;

    }

    .whatsapp-footer {
        display: flex;
        align-items: center;
    }

    .whatsapp-footer input {
        flex-grow: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
    }

    .whatsapp-footer i {
        font-size: 18px;
        margin-right: 10px;
        color: #095f54;
        cursor: pointer;
    }

    .whatsapp-footer-1 {
        background-color: #F1EDE5;

    }


    .audio-icon-tem i {
        font-size: 18px;
        color: #095f54;
        cursor: pointer;
    }

    .template-creation-heading {
        overflow-x: hidden;


    }

    .whatsapp-footer-1 i,
    .whatsapp-footer-2 i,
    .whatsapp-footer-3 i {
        font-size: 18px;
        color: #095f54;
        cursor: pointer;
    }

    .single-button-whatsapp-template {
        width: 50%;
        border: 2px solid white;
        background-color: white;
        color: blue;
        border-radius: 6px;
        left: 20px;
        padding: 7px 7px;
        margin: 2px;
        text-overflow: ellipsis;
        overflow: hidden;
        font-size: 12px;
    }

    .single-button-whatsapp-template1 {
        width: 50%;
        border: 2px solid white;
        background-color: white;
        color: blue;
        border-radius: 6px;
        left: 20px;
        padding: 7px 7px;
        margin: 2px;
        text-overflow: ellipsis;
        overflow: hidden;
        font-size: 12px;
    }

    .single-button-whatsapp-template2 {
        width: 50%;
        border: 2px solid white;
        background-color: white;
        color: blue;
        border-radius: 6px;
        left: 20px;
        padding: 7px 7px;
        margin: 2px;
        text-overflow: ellipsis;
        overflow: hidden;
        font-size: 12px;
    }

    .single-button-whatsapp-template3 {
        width: 50%;
        border: 2px solid white;
        background-color: white;
        color: blue;
        border-radius: 6px;
        left: 20px;
        padding: 7px 7px;
        margin: 2px;
        text-overflow: ellipsis;
        overflow: hidden;
        font-size: 12px;
    }

    .single-t-user-chat {
        padding: 6px 2px 6px 9px;
        font-size: 15px;
        font-weight: 500;
        color: black;
        overflow-x: hidden;
        overflow-wrap: break-word;
        font-family: 'Poppins', sans-serif;
    }

    .single-t-text-chat {
        white-space: pre-line;
        font-size: 13px !important;
        padding: 6px 10px;
        color: black;
        word-break: break-word;
        font-family: 'Poppins', sans-serif;
    }

    .user-name-chat-footer {
        white-space: pre-line;
        font-size: 12px !important;
        padding: 6px 10px;
        color: black;
        word-break: break-word;
        font-family: 'Poppins', sans-serif;
    }

    .button {
        line-height: 1.15;
        cursor: pointer;
        font-size: 100%;

    }

    .col-12.mb-3.justify-content-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .add_user_role_css {
        padding: 10px;
    }
</style>
<style>
    .wa-preview-main-div-cont {
        max-width: 600px;
        margin: auto;
    }

    .preview-header-paragraph .user-name-chat-header {
        font-size: 13px;
        font-family: 'poppins', sans-serif;
        color: black;
        text-align: left;
        font-weight: bold;
    }

    .preview-chat-paragraph .msg-text-chat {
        font-size: 12px;
    }

    .preview-footer-paragraph .user-name-chat-footer {
        font-size: 9px;
    }

    .preview-header-main-cont {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #095f54;
        padding: 10px;
        color: #fff;
    }

    .header-image img {
        border-radius: 50%;
        max-width: 40px;
        height: auto;
    }

    .preview-header-text {
        flex-grow: 1;
        margin-left: 10px;
    }

    .wa-phone-header {
        display: flex;
    }

    .wa-phone-header i {
        font-size: 18px;
        margin-right: 10px;
        color: #fff;
        cursor: pointer;
    }

    .preview-chat-section {
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        object-fit: cover;
    }

    .preview-chat-section-chat {
        padding: 10px;
        height: auto;
        max-height: calc(38vh - 10px);
        overflow-y: auto;
        background-color: #F1EDE5;
    }

    .preview-chat-paragraph {
        margin-bottom: 10px;
        font-size: small;
        word-break: break-all;
        text-align: left;
        color: black;
        background-color: #fff;
        word-break: break-all;
        border-radius: 0px 30px 30px 30px;

    }

    .preview-chat-paragraph>p {
        word-break: break-all;


    }

    .preview-chat-paragraph1 {
        margin-bottom: 10px;
        word-break: break-all;
        text-align: left;
        color: black;
        max-width: '100%';
        height: 'auto';

    }

    .preview-chat-paragraph1>* {
        margin-top: 10px;
    }

    .cwt-info-facebook,
    .cwt-info-whatsapp {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 199, 89, 1);
        background: rgba(255, 199, 89, 0.12);
        border-radius: 4px;
    }

    .cwt-info-whatsapp {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .cwt-info-facebook p,
    .cwt-info-whatsapp p {
        margin: 0;
        color: #212529;
        font-size: 12px;
    }

    /* .preview-call-button {
        background-color: #095f54;
        color: #fff;
        padding: 10px;
        text-align: center;
        cursor: pointer;
    } */
    .preview-whatsapp-footer {
        background-color: #F1EDE5;
        padding: 10px;
        text-align: center;
        cursor: pointer;

    }

    .whatsapp-footer {
        display: flex;
        align-items: center;
    }

    .whatsapp-footer input {
        flex-grow: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
    }

    .whatsapp-footer i {
        font-size: 18px;
        margin-right: 10px;
        color: #095f54;
        cursor: pointer;
    }

    .whatsapp-footer-1 {
        background-color: #F1EDE5;

    }

    .audio-icon-tem i {
        font-size: 18px;
        color: #095f54;
        cursor: pointer;
    }

    .template-creation-heading {
        overflow-x: hidden;


    }

    .whatsapp-footer-1 i,
    .whatsapp-footer-2 i,
    .whatsapp-footer-3 i {
        font-size: 18px;
        color: #095f54;
        cursor: pointer;
    }

    /* .active-side-bar{
        background-color: red;
        color: white;
    } */
    .first-container {
        width: 102px;
    }

    .slide-toggle {
        width: 443px;
    }

    .msssege-box {
        border: 1px solid #FFC759;
        background-color: #FFF8EB;
        font-size: 12px;
    }

    .iti {
        width: 100%;
    }
</style>

<div class="main-dashbord p-2 ">
    <div class="container-fluid p-0">
        <div class="col-12 p-2 d-flex flex-wrap">
            <div class="p-1 first-container slide-toggle">
                <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex flex-wrap">
                    <div class="col-12 d-flex flex-wrap w-100 mt-5">
                        <ul class="d-flex flex-wrap nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">

                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle bg-body-secondary nav-item Tab1Class" role="presentation">
                                <div class="col-12 d-flex" DataStatus='1' data-table="exercise_type" data-bs-toggle="pill" data-bs-target="#pills-ex-single-tab" type="button" role="tab" aria-controls="#pills-ex-single-tab" aria-selected="true">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <path d="M256.064 0h-.128C114.784 0 0 114.816 0 256c0 56 18.048 107.904 48.736 150.048l-31.904 95.104 98.4-31.456C155.712 496.512 204 512 256.064 512 397.216 512 512 397.152 512 256S397.216 0 256.064 0z" style="" fill="#724ebf" data-original="#4caf50" class="" opacity="1">
                                                </path>
                                                <path d="M405.024 361.504c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.616-127.456-112.576-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016.16 8.576.288 7.52.32 11.296.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744-3.776 4.352-7.36 7.68-11.136 12.352-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z" style="" fill="#fafafa" data-original="#fafafa" class=""></path>
                                            </g>
                                        </svg>
                                    </p>
                                    <span class="ms-3 first-container-text">Send Template Messages</span>
                                </div>
                            </li>
                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle nav-item Tab2Class" role="presentation">
                                <div class="col-12 d-flex" DataStatus='1' data-table="exercise_type" data-bs-toggle="pill" data-bs-target="#pills-ex-view-tab" type="button" role="tab" aria-controls="pills-ex-view-tab" aria-selected="false">
                                    <p><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512.001" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <path fill="#b55dcd" d="M504.34 187.367v269.344c0 13.816-5.88 26.254-15.266 34.965-8.515 7.894-19.91 12.719-32.43 12.719H55.294c-12.52 0-23.914-4.825-32.418-12.711-9.39-8.72-15.27-21.157-15.27-34.973V187.367zm0 0" opacity="1" data-original="#fec970" class=""></path>
                                                <path fill="#b55dcd" d="M258 504.395H55.293c-26.336 0-47.688-21.348-47.688-47.684V185.766l52.97 45.71 3.304 2.747v135.933c0 46.246 18.66 90.078 61.207 108.223C164.34 495.12 234.18 504.395 258 504.395zm0 0" opacity="1" data-original="#fba028" class=""></path>
                                                <path fill="#b55dcd" d="M504.34 187.367 313.406 28.387C280.13.68 231.812.68 198.536 28.387L7.601 187.367h.003l56.274 46.856 134.656 112.12c33.281 27.716 81.598 27.716 114.867 0l134.668-112.12z" opacity="1" data-original="#fba028" class=""></path>
                                                <path fill="#b55dcd" d="M448.07 88.152v146.07L313.402 346.345c-33.27 27.715-81.586 27.715-114.867 0L63.88 234.223V88.153c0-30.454 24.695-55.15 55.16-55.15h273.883c30.46 0 55.148 24.696 55.148 55.15zm0 0" opacity="1" data-original="#bfdadd" class=""></path>
                                                <path fill="#b55dcd" d="M448.07 88.152V200.77L313.402 312.89c-33.27 27.715-81.586 27.715-114.867 0L63.88 200.77V88.152c0-30.453 24.695-55.148 55.16-55.148h273.883c30.46 0 55.148 24.695 55.148 55.148zm0 0" opacity="1" data-original="#e4f5f7" class=""></path>
                                                <path fill="#26bf64" d="M494.203 114.055c0 58.507-47.43 105.937-105.937 105.937s-105.938-47.43-105.938-105.937c0-58.512 47.43-105.942 105.938-105.942s105.937 47.43 105.937 105.942zm0 0" opacity="1" data-original="#26bf64" class=""></path>
                                                <path fill="#49d685" d="M494.2 114.05c0 51.485-36.716 94.388-85.395 103.95-48.684-9.55-85.41-52.465-85.41-103.95 0-51.48 36.726-94.39 85.41-103.94 48.68 9.558 85.394 52.46 85.394 103.94zm0 0" opacity="1" data-original="#49d685" class=""></path>
                                                <path d="M453.18 471.688a7.57 7.57 0 0 0 4.86 1.761c2.179 0 4.343-.933 5.847-2.742a7.599 7.599 0 0 0-.98-10.707L341.675 359.062a7.604 7.604 0 1 0-9.73 11.688zM53.906 473.445a7.575 7.575 0 0 0 4.864-1.757l121.234-100.942a7.601 7.601 0 0 0 .976-10.707 7.602 7.602 0 0 0-10.707-.977L49.043 460a7.599 7.599 0 0 0-.98 10.707 7.572 7.572 0 0 0 5.843 2.738zM144.465 225.832h160.172c4.199 0 7.601-3.406 7.601-7.605a7.6 7.6 0 0 0-7.601-7.602H144.465a7.604 7.604 0 1 0 0 15.207zM367.484 254.781h-223.02a7.603 7.603 0 1 0 0 15.207h223.02c4.204 0 7.606-3.402 7.606-7.601s-3.406-7.606-7.606-7.606zM144.465 137.516h111.512a7.604 7.604 0 0 0 0-15.207H144.465a7.606 7.606 0 0 0-7.606 7.601c0 4.2 3.407 7.606 7.606 7.606zM211.617 174.07c0 4.2 3.406 7.602 7.606 7.602h55a7.6 7.6 0 0 0 7.601-7.602c0-4.199-3.402-7.605-7.601-7.605h-55a7.607 7.607 0 0 0-7.606 7.605zM144.465 181.672h49.41a7.604 7.604 0 1 0 0-15.207h-49.41a7.604 7.604 0 1 0 0 15.207zM426.39 62.188l-40.75 95.085-36.148-43.046a7.603 7.603 0 1 0-11.64 9.78l44.09 52.505a7.603 7.603 0 0 0 6.933 2.633 7.6 7.6 0 0 0 5.875-4.528l45.617-106.441a7.603 7.603 0 1 0-13.976-5.989zm0 0" fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                                                <path d="m505.402 178.355-15.816-13.167c7.828-15.477 12.219-32.891 12.219-51.137 0-20.633-5.594-40.84-16.168-58.43a7.606 7.606 0 0 0-13.035 7.836c9.156 15.223 13.996 32.719 13.996 50.59 0 46.89-33.332 87.473-79.262 96.488a98.905 98.905 0 0 1-19.07 1.856c-54.223 0-98.336-44.118-98.336-98.344 0-54.219 44.113-98.332 98.336-98.332 6.406 0 12.82.625 19.07 1.855 17.8 3.496 34.285 11.887 47.676 24.274a7.61 7.61 0 0 0 10.746-.422c2.851-3.082 2.66-7.895-.422-10.746-15.461-14.297-34.504-23.988-55.063-28.028a114.37 114.37 0 0 0-22.007-2.14c-25.778 0-49.567 8.64-68.649 23.168l-1.347-1.125c-36.094-30.067-88.497-30.067-124.602 0l-3.418 2.851h-71.21c-34.606 0-62.763 28.149-62.763 62.75v49.305L4.836 180.285c-.152.063-.305.125-.457.2a7.596 7.596 0 0 0-4.375 6.882V396.48c0 4.2 3.402 7.602 7.601 7.602s7.606-3.402 7.606-7.602V203.594l178.46 148.593c18.052 15.032 40.177 22.551 62.302 22.547 22.125 0 44.25-7.515 62.293-22.546l178.468-148.594v253.113c0 22.106-17.98 40.086-40.086 40.086H55.293c-22.106 0-40.086-17.98-40.086-40.086v-29.812a7.604 7.604 0 0 0-15.207 0v29.812C0 487.195 24.805 512 55.293 512h401.355c30.489 0 55.293-24.805 55.293-55.293V187.563c.094-3.684-1.046-4.633-6.539-9.208zM295.582 25.402h-79.223c24.621-13.574 54.61-13.574 79.223 0zM56.277 157.242V218l-36.484-30.379zm252.258 183.262c-30.453 25.367-74.668 25.367-105.133-.004L71.484 230.66V88.152c0-26.218 21.332-47.547 47.555-47.547H301.75c-16.844 19.813-27.023 45.461-27.023 73.446 0 62.61 50.933 113.547 113.539 113.547 7.39 0 14.796-.72 22.004-2.141a112.384 112.384 0 0 0 30.195-10.578v15.777zm147.137-122.508v-12.601a114.146 114.146 0 0 0 26.062-26.957c3.325 2.765 7.348 6.117 10.727 8.93zm0 0" fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                                            </g>
                                        </svg></p>
                                    <span class="ms-3 first-container-text">View Sent Messages</span>
                                </div>
                            </li>
                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle nav-item Tab3Class" role="presentation">
                                <div class="col-12 d-flex" DataStatus='1' data-table="exercise_type" data-bs-toggle="pill" data-bs-target="#pills-ex-schedule-tab3" type="button" role="tab" aria-controls="pills-ex-schedule-tab3" aria-selected="false">
                                    <p><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <path d="M391.474 0v72.894h72.489C435.664 44.594 419.692 28.218 391.474 0z" fill="#724ebf" opacity="1" data-original="#000000" class=""></path>
                                                <path d="M361.474 102.894V0H114.613v217.584h304.119v30H251.317v33.734h167.415v30H251.317v33.734h167.415v30H251.317v33.734h167.415v30H114.613V512H464.09V102.894zm57.258 80.956H315.829v-30h102.902v30z" fill="#724ebf" opacity="1" data-original="#000000" class=""></path>
                                                <path d="M221.317 247.584H47.91v161.203h173.407zm-46.736 67.683h-24.968v58.838h-30v-58.838H94.646v-30h79.936v30z" fill="#724ebf" opacity="1" data-original="#000000" class=""></path>
                                            </g>
                                        </svg></p>
                                    <span class="ms-3 first-container-text">Templates</span>
                                </div>
                            </li>

                        </ul>

                    </div>
                    <div class="col-12 mt-2 d-flex justify-content-end">
                        <div class="col-1 p-3 Arro-pro"><i class="bi bi-arrow-left Arrowmovement"></i></div>
                    </div>
                </div>
            </div>
            <div class="col p-1">

                <div class="main-dashbord Activeclass p-2 ">
                    <div class="container p-0 ms-0">
                        <div class="px-3 py-2 bg-white rounded-2 m-2">
                            <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">

                                <li class="nav-item  " role="presentation">
                                    <button class="nav-link active" id="single" data-table="single" DataStatus='3' data-bs-toggle="pill" data-bs-target="#pills-ex-single-tab" data-bs-toggle="modal" type="button" role="tab" aria-controls="pills-ex-single-tab" aria-selected="true">Single
                                        Template</button>
                                </li>


                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="schedule" DataStatus='1' data-table="exercise_type" data-bs-toggle="pill" data-bs-target="#pills-ex-schedule-tab" type="button" role="tab" aria-controls="pills-ex-schedule-tab" aria-selected="false">schedule
                                    </button>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>


                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-ex-single-tab" role="tabpanel" aria-labelledby="pills-ex-single" tabindex="0">
                        <div class="main-dashbord p-2 main-check-class">

                            <div class="container p-0 ms-0">
                                <div class="px-3 py-2 bg-white rounded-2 mx-2">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="title-1">
                                            <h2>Template</h2>
                                        </div>
                                        <div class="title-side-icons">
                                            <div class="deleted-all" data-delete_id="">
                                                <span class="btn-primary-rounded" hidden>
                                                    <i class="bi bi-trash3 fs-14" hidden></i>
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 justify-content-center container ms-0" style="width: 100%;">
                                    <div class="col-12 hello">
                                        <div class="d-flex flex-wrap align-items-start border p-3 justify-content-center ">
                                            <div class="col-6">
                                                <form class="needs-validation membershipDiv" name="master_membership_update_form" method="POST" novalidate>
                                                    <div class="modal-content">

                                                        <div class="modal-body-secondery">
                                                            <div class="modal-body-card">
                                                                <div class="col-12 mb-3 mt-2">
                                                                    <select class="form-control main-control header_div" id="header" name="header" value="" ng-model="selectedHeader" ng-change="handleHeaderChange()" required>
                                                                        <option value="" selected disabled>Please select template</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 mb-3 mt-2">

                                                                    <input type="text" id="mobile_code" class="form-control phone_number_div" placeholder="Enter your phone number" name="name">
                                                                </div>
                                                                <div class="col-12 mb-3 mt-2">
                                                                    <select class="form-control main-control language_div" id="language" name="language" required>
                                                                        <option class="fs-12" label="Please select your language" value=""></option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="en_US" ng-repeat="lang in template_lang">English US (en_US)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="en" ng-repeat="lang in template_lang">English (en)</option>

                                                                        <option class="fs-12 ng-binding ng-scope" value="af" ng-repeat="lang in template_lang">Afrikaans</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="sq" ng-repeat="lang in template_lang">Albanian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ar" ng-repeat="lang in template_lang">Arabic</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="az" ng-repeat="lang in template_lang">Azerbaijani</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="bn" ng-repeat="lang in template_lang">Bengali</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="bg" ng-repeat="lang in template_lang">Bulgarian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ca" ng-repeat="lang in template_lang">Catalan</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="zh_CN" ng-repeat="lang in template_lang">Chinese (CHN)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="zh_HK" ng-repeat="lang in template_lang">Chinese (HKG)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="zh_TW" ng-repeat="lang in template_lang">Chinese (TAI)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="hr" ng-repeat="lang in template_lang">Croatian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="cs" ng-repeat="lang in template_lang">Czech</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="da" ng-repeat="lang in template_lang">Danish</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="nl" ng-repeat="lang in template_lang">Dutch</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="en_GB" ng-repeat="lang in template_lang">English (UK)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="et" ng-repeat="lang in template_lang">Estonian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="fil" ng-repeat="lang in template_lang">Filipino</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="fi" ng-repeat="lang in template_lang">Finnish</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="fr" ng-repeat="lang in template_lang">French</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="de" ng-repeat="lang in template_lang">German</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="el" ng-repeat="lang in template_lang">Greek</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="gu" ng-repeat="lang in template_lang">Gujarati</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ha" ng-repeat="lang in template_lang">Hausa</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="he" ng-repeat="lang in template_lang">Hebrew</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="hi" ng-repeat="lang in template_lang">Hindi</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="hu" ng-repeat="lang in template_lang">Hungarian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="id" ng-repeat="lang in template_lang">Indonesian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ga" ng-repeat="lang in template_lang">Irish</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="it" ng-repeat="lang in template_lang">Italian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ja" ng-repeat="lang in template_lang">Japanese</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="kn" ng-repeat="lang in template_lang">Kannada</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="kk" ng-repeat="lang in template_lang">Kazakh</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ko" ng-repeat="lang in template_lang">Korean</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="lo" ng-repeat="lang in template_lang">Lao</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="lv" ng-repeat="lang in template_lang">Latvian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="lt" ng-repeat="lang in template_lang">Lithuanian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="mk" ng-repeat="lang in template_lang">Macedonian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ms" ng-repeat="lang in template_lang">Malay</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ml" ng-repeat="lang in template_lang">Malayalam</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="mr" ng-repeat="lang in template_lang">Marathi</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="nb" ng-repeat="lang in template_lang">Norwegian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="fa" ng-repeat="lang in template_lang">Persian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="pl" ng-repeat="lang in template_lang">Polish</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="pt_BR" ng-repeat="lang in template_lang">Portuguese (BR)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="pt_PT" ng-repeat="lang in template_lang">Portuguese (POR)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="pa" ng-repeat="lang in template_lang">Punjabi</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ro" ng-repeat="lang in template_lang">Romanian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ru" ng-repeat="lang in template_lang">Russian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="sr" ng-repeat="lang in template_lang">Serbian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="sk" ng-repeat="lang in template_lang">Slovak</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="sl" ng-repeat="lang in template_lang">Slovenian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="es" ng-repeat="lang in template_lang">Spanish</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="es_AR" ng-repeat="lang in template_lang">Spanish (ARG)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="es_ES" ng-repeat="lang in template_lang">Spanish (SPA)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="es_MX" ng-repeat="lang in template_lang">Spanish (MEX)</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="sw" ng-repeat="lang in template_lang">Swahili</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="sv" ng-repeat="lang in template_lang">Swedish</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ta" ng-repeat="lang in template_lang">Tamil</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="te" ng-repeat="lang in template_lang">Telugu</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="th" ng-repeat="lang in template_lang">Thai</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="tr" ng-repeat="lang in template_lang">Turkish</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="uk" ng-repeat="lang in template_lang">Ukrainian</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="ur" ng-repeat="lang in template_lang">Urdu</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="uz" ng-repeat="lang in template_lang">Uzbek</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="vi" ng-repeat="lang in template_lang">Vietnamese</option>
                                                                        <option class="fs-12 ng-binding ng-scope" value="zu" ng-repeat="lang in template_lang">Zulu</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer justify-content-center mt-2">
                                                            <span class="btn-primary Template_send" id="memberships_add_btn" data-edit_id="" name="memberships_update1" value="memberships_update1">Send</span>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <!-- whatsapp   .. -->
                                                <div class="wa-preview-main-div-cont">
                                                    <div class="preview-chat-section">
                                                        <div class="preview-header-main-cont">
                                                            <div class="header-image">
                                                                <img class="profile-img ng-scope" ng-if="!company_photo || company_photo.length == 0" ng-src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png" alt="logo" src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png">
                                                            </div>
                                                            <div class="preview-header-text">
                                                                <span class="company-name user ng-binding">appo</span>
                                                            </div>
                                                            <div class="wa-phone-header">
                                                                <i class="fa fa-video-camera wa-phone-header-video-icon" aria-hidden="true"></i>
                                                                <i class="fa fa-phone wa-phone-header-call-icon" aria-hidden="true"></i>
                                                                <i class="fa fa-ellipsis-v wa-phone-header-elicpse-icon" aria-hidden="true"></i>
                                                            </div>
                                                        </div>

                                                        <div class="preview-chat-section-chat overflow-y-scroll">

                                                            <div class="preview-chat-paragraph bg-white p-3 col-7">
                                                                <p class="single-t-user-chat user msg fs-16 m-0 p-l-10 p-r-5 ">
                                                                    Message Header Section</p>
                                                                <p contenteditable="false" class="single-t-text-chat message msg m-0 p-l-10 p-r-5">
                                                                    Message Body Section</p>
                                                                <p class="user-name-chat-footer message msg fs-10 m-0 p-l-10 p-r-5" contenteditable="false">Message Footer Section
                                                                </p>
                                                            </div>
                                                            <div class="single-t-call-button">
                                                                <button class="single-button-whatsapp-template ">Ok</button>
                                                                <button class="single-button-whatsapp-template ">Cancel</button>
                                                            </div>

                                                        </div>
                                                        <div class="preview-call-button ng-scope" ng-if="!edit_template &amp;&amp; !preview_open">
                                                            <div class="preview-whatsapp-footer">
                                                                <div class="whatsapp-footer">

                                                                    <i class="fa fa-smile-o whatsapp-footer-relative" aria-hidden="true"></i>
                                                                    <input class="chat-btn-chat whatsapp-footer-1" placeholder="Type a message" ng-disabled="true" aria-disabled="true" disabled="disabled">
                                                                    <i class="fa fa-paperclip whatsapp-footer-2" aria-hidden="true"></i>
                                                                    <i class="fa fa-camera whatsapp-footer-3" aria-hidden="true"></i>
                                                                    <p class="audio-icon-tem"><i class="fa fa-microphone icon-tem-micro" aria-hidden="true"></i></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- shedual modal -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show " id="pills-ex-schedule-tab" role="tabpanel" aria-labelledby="pills-ex-schedule" tabindex="0">
                        <div class="main-dashbord p-2 main-check-class">
                            <div class="container p-0 ms-0">
                                <div class="px-3 py-2 bg-white rounded-2 mx-2">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="title-1">
                                            <h2>Template</h2>
                                        </div>
                                        <div class="title-side-icons">
                                            <div class="deleted-all" data-delete_id="">
                                                <span class="btn-primary-rounded" hidden>
                                                    <i class="bi bi-trash3 fs-14" hidden></i>
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 justify-content-center container" style="width: 100%;">
                                    <div class="col-12 hello">
                                        <div class="d-flex flex-wrap align-items-start border p-3 justify-content-center">
                                            <div class="col-6">
                                                <form class="needs-validation membershipDiv" name="master_membership_update_form" method="POST" novalidate>
                                                    <div class="modal-content">

                                                        <div class="modal-body-secondery justify-content-center">
                                                            <div class="modal-body-card justify-content-center">
                                                                <label class=" pull-left full-width text-left m-b-15"><b>Note:
                                                                    </b> follow <a href="<?php echo base_url('/assets/sample.csv'); ?>" download='sample.csv' target="_blank">csv</a>
                                                                    format for
                                                                    reference</label>


                                                                <div class="col-12 mb-3 justify-content-center mt-2">
                                                                    <a href="<?php echo base_url('/assets/sample.csv'); ?>" download='sample.csv' class="text-secondary mx-1 mb-1 add_property_js add_user_role_css add_user-role-pdf">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="28" height="28" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                                            <g>
                                                                                <path d="M496 432.011H272c-8.832 0-16-7.168-16-16v-320c0-8.832 7.168-16 16-16h224c8.832 0 16 7.168 16 16v320c0 8.832-7.168 16-16 16z" style="" fill="#eceff1" data-original="#eceff1"></path>
                                                                                <path d="M336 176.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 240.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 304.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 368.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 176.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 240.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 304.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 368.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16z" style="" fill="#388e3c" data-original="#388e3c"></path>
                                                                                <path d="M282.208 19.691c-3.648-3.04-8.544-4.352-13.152-3.392l-256 48A15.955 15.955 0 0 0 0 80.011v352c0 7.68 5.472 14.304 13.056 15.712l256 48c.96.192 1.952.288 2.944.288 3.712 0 7.328-1.28 10.208-3.68a16.006 16.006 0 0 0 5.792-12.32v-448c0-4.768-2.112-9.28-5.792-12.32z" style="" fill="#2e7d32" data-original="#2e7d32" class="">
                                                                                </path>
                                                                                <path d="m220.032 309.483-50.592-57.824 51.168-65.792c5.44-6.976 4.16-17.024-2.784-22.464-6.944-5.44-16.992-4.16-22.464 2.784l-47.392 60.928-39.936-45.632c-5.856-6.72-15.968-7.328-22.56-1.504-6.656 5.824-7.328 15.936-1.504 22.56l44 50.304-44.608 57.344c-5.44 6.976-4.16 17.024 2.784 22.464a16.104 16.104 0 0 0 9.856 3.36c4.768 0 9.472-2.112 12.64-6.176l40.8-52.48 46.528 53.152A15.874 15.874 0 0 0 208 336.011c3.744 0 7.488-1.312 10.528-3.968 6.656-5.824 7.328-15.936 1.504-22.56z" style="" fill="#fafafa" data-original="#fafafa"></path>
                                                                            </g>
                                                                        </svg>
                                                                    </a>

                                                                </div>
                                                                <div class="col-12 mb-3">
                                                                    <input type="text" class="form-control main-control campaign_name_div" id="campaign_name" placeholder="campaign name..." name="" required>
                                                                </div>
                                                                <div class=" col-6 mb-3 ">
                                                                    <input type="text" name="" id="fromDate_edit" class="date-picker form-control main-control " placeholder="DD-MM-YYYY">
                                                                </div>
                                                                <div class="col-6 mb-3">
                                                                    <input type="text" name="daily_time" id="daily_time" class="form-control main-control dailyinputfields daily-time" placeholder="Select Time" required>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer justify-content-center mt-2">
                                                            <button class="btn-primary SaveBtnDiv" id="memberships_add_btn" data-edit_id="" name="memberships_update1" value="memberships_update1">Send</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <!-- whatsapp   .. -->
                                                <div class="wa-preview-main-div-cont">
                                                    <div class="preview-chat-section">
                                                        <div class="preview-header-main-cont">
                                                            <div class="header-image">
                                                                <img class="profile-img ng-scope" ng-if="!company_photo || company_photo.length == 0" ng-src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png" alt="logo" src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png">
                                                            </div>
                                                            <div class="preview-header-text">
                                                                <span class="company-name user ng-binding">appo</span>
                                                            </div>
                                                            <div class="wa-phone-header">
                                                                <i class="fa fa-video-camera wa-phone-header-video-icon" aria-hidden="true"></i>
                                                                <i class="fa fa-phone wa-phone-header-call-icon" aria-hidden="true"></i>
                                                                <i class="fa fa-ellipsis-v wa-phone-header-elicpse-icon" aria-hidden="true"></i>
                                                            </div>
                                                        </div>

                                                        <div class="preview-chat-section-chat overflow-y-scroll">

                                                            <div class="preview-chat-paragraph bg-white p-3 col-7">
                                                                <p class="single-t-user-chat user msg fs-16 m-0 p-l-10 p-r-5 ">
                                                                    Message Header Section</p>
                                                                <p contenteditable="false" class="single-t-text-chat message msg m-0 p-l-10 p-r-5">
                                                                    Message Body Section</p>
                                                                <p class="user-name-chat-footer message msg fs-10 m-0 p-l-10 p-r-5" contenteditable="false">Message Footer Section
                                                                </p>
                                                            </div>
                                                            <div class="single-t-call-button">
                                                                <button class="single-button-whatsapp-template ">Ok</button>
                                                                <button class="single-button-whatsapp-template ">Cancel</button>
                                                            </div>

                                                        </div>
                                                        <div class="preview-call-button ng-scope" ng-if="!edit_template &amp;&amp; !preview_open">
                                                            <div class="preview-whatsapp-footer">
                                                                <div class="whatsapp-footer">

                                                                    <i class="fa fa-smile-o whatsapp-footer-relative" aria-hidden="true"></i>
                                                                    <input class="chat-btn-chat whatsapp-footer-1" placeholder="Type a message" ng-disabled="true" aria-disabled="true" disabled="disabled">
                                                                    <i class="fa fa-paperclip whatsapp-footer-2" aria-hidden="true"></i>
                                                                    <i class="fa fa-camera whatsapp-footer-3" aria-hidden="true"></i>
                                                                    <p class="audio-icon-tem"><i class="fa fa-microphone icon-tem-micro" aria-hidden="true"></i></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-content">
                    <div class="tab-pane fade " id="pills-ex-schedule-tab3" role="tabpanel" aria-labelledby="pills-ex-schedule" tabindex="0">
                        <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex flex-wrap ">
                            <div class="col-12 d-flex flex-wrap my-2">

                                <div class="col-4 d-flex align-items-center">
                                    <h6>WhatsApp Template Details</h6>
                                </div>
                                <div class="col-3 d-flex align-items-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary border" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-5 d-flex flex-wrap align-items-center justify-content-end float-end ">
                                    <div class="col-5 px-2">
                                        <button type="button" class="btn-primary CancleBtn me-2  w-100" data-bs-dismiss="modal" data-bs-toggle="modal" id="cancel" data-delete_id=""><i class="bi bi-arrow-repeat"></i> Sync with
                                            Facebook</button>
                                    </div>

                                    <div class="col-1 px-2">
                                        <button class="btn-primary-rounded" id="template_data" data-bs-toggle="modal" data-bs-target="#whatsapp_template_add_edit">
                                            <i class="bi bi-plus PlusButtonDiv" id="plus_btn"></i>
                                        </button>

                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="px-3 py-2 bg-white rounded-2 mx-2">
                                    <table id="memberships_table" class="w-100 m-memberships table table-striped dt-responsive nowrap master_memberships_insert main-table">
                                        <thead>
                                            <tr class="th-header-noborder">
                                                <th class="template-creation-heading">Name <i class="fa fa-sort p-l-10" ng-class="{'lblue' : temOrderBy == 'name' || temOrderBy == '-name'}" ng-click="setTemorder('name')" role="button" tabindex="0"></i>
                                                </th>
                                                <th class="template-creation-heading">Category</th>
                                                <th class="template-creation-heading">Status</th>
                                                <th class="template-creation-heading" style="max-width: 400px;">Preview
                                                </th>
                                                <th class="template-creation-heading ">Language</th>
                                                <th class="template-creation-heading text-center text-left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="memberships_list">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade " id="pills-ex-view-tab" role="tabpanel" aria-labelledby="pills-ex-view" tabindex="0">
                        <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex justify-content-between align-items-center mt-3">
                            <div class="input-group me-5">
                                <input type="text" name="phone" class="form-control" placeholder="Phone....">
                                <button class="btn btn-light"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            <div class="input-group me-5">
                                <input type="text" name="select-date" class="form-control" placeholder="Select Date">
                                <button class="btn btn-light"><i class="fa-regular fa-calendar-days"></i></button>
                            </div>
                            <select name="Templates" class="form-select me-5">
                                <option value="">Templates</option>
                            </select>
                            <select name="Status" class="form-select me-5">
                                <option value="">Status</option>
                            </select>

                            <button class="btn btn-primary col-2">View Data</button>
                        </div>
                        <table class="table whatsapp-table">

                            <thead>
                                <th>Receiver Number</th>
                                <th>Template Name</th>
                                <th>Whatsapp Message id</th>
                                <th>Status</th>
                                <th>WhatsApp Response</th>
                                <th>Created At</th>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="whatsapp-col">917016045</td>
                                    <td>offer1</td>
                                    <td>
                                        <div id="whatsapp-meassage">
                                            dsfddddddddddddddddddddddddddddddddddddddddddddddddjfdfgeigg</div>
                                    </td>
                                    <td>read</td>
                                    <td>success</td>
                                    <td>01 feb 2024 17:45:34</td>
                                </tr>
                            </tbody>

                            <tbody class="border rounded-5 px-4 py-3 bg-white">
                                <tr>

                                    <td class="whatsapp-col">917016045</td>
                                    <td>offer1</td>
                                    <td>
                                        <div id="whatsapp-meassage">dsfjfdfgeiojdjdjfgdijgijgg<div>
                                    </td>
                                    <td>read</td>
                                    <td>success</td>
                                    <td>01 feb 2024 17:45:34</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- add model -->
<div class="modal fade modal-lg " id="whatsapp_template_add_edit" tabindex="-1" aria-labelledby="membershipseditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-50 modal-dialog-centered">
        <form class="needs-validation membershipDiv" name="whatsapp_template_add_edit" method="POST" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title Add_editModelTitle">Create a Template Message</h1>
                    <button type="button" class="border-0 modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle fs-5"></i></button>
                </div>
                <div class="modal-body modal-body-secondery d-flex flex-wrap bg-white">
                    <div class="col-6">
                        <div class="modal-body-card justify-content-center overflow-y-scroll border-0" style="max-height:657px;">
                            <form class="needs-validation membershipDiv" name="whatsapp_template_add_edit" method="POST" novalidate>
                                <div class="col-12 mb-3 ">
                                    <input type="text" class="form-control main-control Template_name_varification Template_name" id="Template_nameId" placeholder="Template name" name="Template_name" required>
                                    <p class="CheckTemplateNameAlertPTag text-danger fs-12" style="display:none;">Name
                                        can
                                        only contain lowercase alphanumeric characters and underscores ( _ )</p>
                                </div>
                                <div class="col-12 mb-3 ">
                                    <div class="main-selectpicker">
                                        <select id="category_types" name="category_types" class="selectpicker form-control form-main TemplateCategorySelectionDiv main-control category_div" required>
                                            <option class=" dropdown-item" value="">Please select your category</option>

                                            <option value="UTILITY" ng-repeat="category in category_types" class="  dropdown-item">
                                                Utility</option>
                                            </option>
                                            <option value="AUTHENTICATION" ng-repeat="category in category_types" class="  dropdown-item">
                                                Authentication</option>
                                            </option>
                                            <option value="MARKETING" ng-repeat="category in category_types" class="  dropdown-item">
                                                Marketing</option>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3 ">
                                    <div class="main-selectpicker">
                                        <!-- <select class="selectpicker form-control main-control language_div" id="language" name="language" required> -->

                                        <select class="form-control main-control TemplateLanguageDDList language_div" id="languageid" name="language" required>
                                            <option class="fs-12" label="Please select your language" value=""></option>
                                            <option class="fs-12 ng-binding ng-scope" value="en_US" ng-repeat="lang in template_lang">English US (en_US)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="en" ng-repeat="lang in template_lang">English (en)</option>

                                            <option class="fs-12 ng-binding ng-scope" value="af" ng-repeat="lang in template_lang">Afrikaans</option>
                                            <option class="fs-12 ng-binding ng-scope" value="sq" ng-repeat="lang in template_lang">Albanian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ar" ng-repeat="lang in template_lang">Arabic</option>
                                            <option class="fs-12 ng-binding ng-scope" value="az" ng-repeat="lang in template_lang">Azerbaijani</option>
                                            <option class="fs-12 ng-binding ng-scope" value="bn" ng-repeat="lang in template_lang">Bengali</option>
                                            <option class="fs-12 ng-binding ng-scope" value="bg" ng-repeat="lang in template_lang">Bulgarian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ca" ng-repeat="lang in template_lang">Catalan</option>
                                            <option class="fs-12 ng-binding ng-scope" value="zh_CN" ng-repeat="lang in template_lang">Chinese (CHN)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="zh_HK" ng-repeat="lang in template_lang">Chinese (HKG)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="zh_TW" ng-repeat="lang in template_lang">Chinese (TAI)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="hr" ng-repeat="lang in template_lang">Croatian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="cs" ng-repeat="lang in template_lang">Czech</option>
                                            <option class="fs-12 ng-binding ng-scope" value="da" ng-repeat="lang in template_lang">Danish</option>
                                            <option class="fs-12 ng-binding ng-scope" value="nl" ng-repeat="lang in template_lang">Dutch</option>
                                            <option class="fs-12 ng-binding ng-scope" value="en_GB" ng-repeat="lang in template_lang">English (UK)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="et" ng-repeat="lang in template_lang">Estonian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="fil" ng-repeat="lang in template_lang">Filipino</option>
                                            <option class="fs-12 ng-binding ng-scope" value="fi" ng-repeat="lang in template_lang">Finnish</option>
                                            <option class="fs-12 ng-binding ng-scope" value="fr" ng-repeat="lang in template_lang">French</option>
                                            <option class="fs-12 ng-binding ng-scope" value="de" ng-repeat="lang in template_lang">German</option>
                                            <option class="fs-12 ng-binding ng-scope" value="el" ng-repeat="lang in template_lang">Greek</option>
                                            <option class="fs-12 ng-binding ng-scope" value="gu" ng-repeat="lang in template_lang">Gujarati</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ha" ng-repeat="lang in template_lang">Hausa</option>
                                            <option class="fs-12 ng-binding ng-scope" value="he" ng-repeat="lang in template_lang">Hebrew</option>
                                            <option class="fs-12 ng-binding ng-scope" value="hi" ng-repeat="lang in template_lang">Hindi</option>
                                            <option class="fs-12 ng-binding ng-scope" value="hu" ng-repeat="lang in template_lang">Hungarian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="id" ng-repeat="lang in template_lang">Indonesian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ga" ng-repeat="lang in template_lang">Irish</option>
                                            <option class="fs-12 ng-binding ng-scope" value="it" ng-repeat="lang in template_lang">Italian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ja" ng-repeat="lang in template_lang">Japanese</option>
                                            <option class="fs-12 ng-binding ng-scope" value="kn" ng-repeat="lang in template_lang">Kannada</option>
                                            <option class="fs-12 ng-binding ng-scope" value="kk" ng-repeat="lang in template_lang">Kazakh</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ko" ng-repeat="lang in template_lang">Korean</option>
                                            <option class="fs-12 ng-binding ng-scope" value="lo" ng-repeat="lang in template_lang">Lao</option>
                                            <option class="fs-12 ng-binding ng-scope" value="lv" ng-repeat="lang in template_lang">Latvian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="lt" ng-repeat="lang in template_lang">Lithuanian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="mk" ng-repeat="lang in template_lang">Macedonian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ms" ng-repeat="lang in template_lang">Malay</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ml" ng-repeat="lang in template_lang">Malayalam</option>
                                            <option class="fs-12 ng-binding ng-scope" value="mr" ng-repeat="lang in template_lang">Marathi</option>
                                            <option class="fs-12 ng-binding ng-scope" value="nb" ng-repeat="lang in template_lang">Norwegian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="fa" ng-repeat="lang in template_lang">Persian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="pl" ng-repeat="lang in template_lang">Polish</option>
                                            <option class="fs-12 ng-binding ng-scope" value="pt_BR" ng-repeat="lang in template_lang">Portuguese (BR)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="pt_PT" ng-repeat="lang in template_lang">Portuguese (POR)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="pa" ng-repeat="lang in template_lang">Punjabi</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ro" ng-repeat="lang in template_lang">Romanian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ru" ng-repeat="lang in template_lang">Russian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="sr" ng-repeat="lang in template_lang">Serbian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="sk" ng-repeat="lang in template_lang">Slovak</option>
                                            <option class="fs-12 ng-binding ng-scope" value="sl" ng-repeat="lang in template_lang">Slovenian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="es" ng-repeat="lang in template_lang">Spanish</option>
                                            <option class="fs-12 ng-binding ng-scope" value="es_AR" ng-repeat="lang in template_lang">Spanish (ARG)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="es_ES" ng-repeat="lang in template_lang">Spanish (SPA)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="es_MX" ng-repeat="lang in template_lang">Spanish (MEX)</option>
                                            <option class="fs-12 ng-binding ng-scope" value="sw" ng-repeat="lang in template_lang">Swahili</option>
                                            <option class="fs-12 ng-binding ng-scope" value="sv" ng-repeat="lang in template_lang">Swedish</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ta" ng-repeat="lang in template_lang">Tamil</option>
                                            <option class="fs-12 ng-binding ng-scope" value="te" ng-repeat="lang in template_lang">Telugu</option>
                                            <option class="fs-12 ng-binding ng-scope" value="th" ng-repeat="lang in template_lang">Thai</option>
                                            <option class="fs-12 ng-binding ng-scope" value="tr" ng-repeat="lang in template_lang">Turkish</option>
                                            <option class="fs-12 ng-binding ng-scope" value="uk" ng-repeat="lang in template_lang">Ukrainian</option>
                                            <option class="fs-12 ng-binding ng-scope" value="ur" ng-repeat="lang in template_lang">Urdu</option>
                                            <option class="fs-12 ng-binding ng-scope" value="uz" ng-repeat="lang in template_lang">Uzbek</option>
                                            <option class="fs-12 ng-binding ng-scope" value="vi" ng-repeat="lang in template_lang">Vietnamese</option>
                                            <option class="fs-12 ng-binding ng-scope" value="zu" ng-repeat="lang in template_lang">Zulu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 header-jqury">
                                    <div class="col-12 mb-3">
                                        <label for="form-memberships" class="main-label">HEADER<sup class="validationn">*</sup></label>
                                        <div class="main-selectpicker">
                                            <select class="selectpicker form-control main-control header_div HeaderSelectionDD Template_header1" id="Template_header" name="header" ng-model="selectedHeader" ng-change="handleHeaderChange()" required>
                                                <option class="dropdown-item" value="">Please select your header type
                                                </option>
                                                <option class="dropdown-item" value="TEXT">TEXT</option>
                                                <option class="dropdown-item" value="IMAGE">IMAGE</option>
                                                <option class="dropdown-item" value="VIDEO">VIDEO</option>
                                                <option class="dropdown-item" value="DOCUMENT">DOCUMENT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 file_upload d-none">
                                        <label for="" class="form-label main-label">Inq file upload <sup class="validationn">*</sup></label>
                                        <input type="file" class="form-control main-control" id="insert_image" name="uploade_file" placeholder="Details" DataStoreURL="" required="">
                                    </div>
                                    <div class="col-12 mb-3 text-comment d-none">
                                        <textarea class="form-control main-control ClassHeaderTEXT place MemberAddressClass" id="address" name="address" required="" placeholder="Type your header text here..." rows="3" cols="50" spellcheck="false"></textarea>
                                    </div>
                                    <!-- <textarea ng-if="selectedHeader === 'TEXT'"
                                class="full-width cwt-header-textarea-box font-size-12 center-textarea header_text"
                                ng-model="header_data"  minlength="0" maxlength="60"
                                ng-change="header_text_media(header_data)"
                                ></textarea> -->


                                    <!-- <div ng-if="selectedHeader === 'IMAGE' && provider === 'meta'"
                                class="cwt-header-open-box-c full-width p-relative " id="temLoaded">
                                <div class="text-center profile-btn-photo2 col-6 mt-3">
                                    <div class="upload-btn-wrapper">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <span class="upload-btn">
                                                <i class="fi fi-rr-document"></i>
                                            </span>
                                            <input type="file" name="uploade_file[]" class="form-control main-control place"
                                                id="insert_image" onchange="displayImageName()" />
                                            <input type="submit" value="Upload" />
                                        </form>
                                    </div>
                                </div>
                                <div id="selectedImageName"></div>
                            </div> -->
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="form-memberships" class="main-label fw-medium">BODY<sup class="validationn">*</sup></label>
                                    <textarea class="form-control main-control TemplateBodyClass body_div" id="body_id" placeholder="Type Your Body Text Here...{{|}}" name="" required></textarea>
                                    <p class="fs-10">Body character limit is 1024 characters</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="form-memberships" class="main-label fw-medium">FOOTER<sup class="validationn">*</sup></label>
                                    <textarea class="form-control main-control footer_div FotterTextDIvClass" id="footer" placeholder="Type Your Footer Text Here...{{|}}" name="" required></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="col-12 ">
                                        <label for="form-memberships" class="main-label">BUTTON<sup class="validationn">*</sup></label>
                                        <div class="main-selectpicker">
                                            <select class="selectpicker form-control main-control ButtonSelctionDropDown header_div" id="Button_make_picker" name="Button" ng-model="selectedHeader" ng-change="handleHeaderChange()" required>
                                                <option class="dropdown-item" DataStaticId="1" value="">Please select
                                                    button type</option>
                                                <option class="dropdown-item" DataStaticId="2" value="Quick">Quick reply
                                                </option>
                                                <option class="dropdown-item" DataStaticId="3" value="Call">Call to
                                                    action</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <!-- <span class="btn btn-primary Button_make" id=""><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Add button</span> -->
                                        <span class="btn btn-primary ButtonVariableClass" id=""><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Add button</span>

                                    </div>
                                    <!-- quck replay -->

                                    <div class="button_link1 SetButtonHTMLClass">
                                        <div class="col-12 d-flex flex-wrap my-2 link_buttons remove-data phonenobtnClass">
                                            <div class="col-12 d-flex  flex-wrap justify-content-between align-items-center">
                                                <span class="fs-10">Url
                                                    Button</span> <button class="bg-transparent border-0 mx-2 end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="col-12 border rounded-2 p-2 "> <textarea class="form-control lablCnoInputField main-control  col border-0" placeholder="Start typing button label here..." cols="1" rows="1" required=""></textarea>
                                                <div class="col-12 d-flex flex-wrap align-items-center border ">
                                                    <span class="text-primary  mx-2 text-white "><i class="fa-solid fa-phone"></i></span>
                                                    <div class="col">
                                                        <!-- <input type="text"
                                                            class="form-control CnoCnoInputField main-control border-0"
                                                            placeholder="Input URL..." required="">  -->
                                                        <input type="text" id="mobile_code" class="form-control main-control border-0" placeholder="Phone Number" name="name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12 d-flex flex-wrap align-items-center position-relative my-2 remove-data">
                                            <span class="fs-10 btn bg-primary  position-absolute ms-2 text-white ">Button</span>
                                            <textarea class="form-control main-control col button1input" data-template="1" placeholder="Start typing button label here..." cols="1" rows="1" required="" style="padding-left:74px;"></textarea>
                                            <button class="bg-transparent border-0 mx-2 position-absolute end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                        </div> -->
                                        <!-- <div class="col-12 d-flex flex-wrap align-items-center position-relative my-2 remove-data">
                                            <button class="fs-10 btn bg-primary  position-absolute ms-2 text-white ">Button</button>
                                            <textarea class="form-control main-control col button2input " data-template="2" placeholder="Start typing button label here..." cols="1" rows="1" required="" style="padding-left:74px;"></textarea>
                                            <button class="bg-transparent border-0 mx-2 position-absolute end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap align-items-center position-relative my-2 remove-data">
                                            <button class="fs-10 btn bg-primary  position-absolute ms-2 text-white ">Button</button>
                                            <textarea class="form-control main-control col button3input" data-template="3" placeholder="Start typing button label here..." cols="1" rows="1" required="" style="padding-left:74px;"></textarea>
                                            <button class="bg-transparent border-0 mx-2 position-absolute end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                        </div> -->
                                        <!-- <div class="col-12 d-flex flex-wrap remove-data">
                                            <div class="col-12 d-flex  flex-wrap justify-content-between align-items-center">
                                                <span class="fs-10">Url Button</span>
                                                <button class="bg-transparent border-0 mx-2 end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="col-12 border rounded-2 p-2">
                                                <textarea class="form-control main-control col border-0" placeholder="Start typing button label here..." cols="1" rows="1" required=""></textarea>
                                                <div class="col-12 d-flex flex-wrap align-items-center border justify-content-between">
                                                    <span class="text-primary  ms-2 text-white "><i class="fa-solid fa-link"></i></span>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control main-control border-0" placeholder="Input URL..." required="">
                                                    </div>
                                                    <button class="btn btn-primary   mx-2  end-0 me-2 fs-10"><i class="fa-solid fa-plus"></i> Variable</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex flex-wrap my-2 link_buttons remove-data">
                                            <div class="col-12 d-flex  flex-wrap justify-content-between align-items-center">
                                                <span class="fs-10">Url Button</span>
                                                <button class="bg-transparent border-0 mx-2 end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="col-12 border rounded-2 p-2 ">
                                                <textarea class="form-control main-control col border-0" placeholder="Start typing button label here..." cols="1" rows="1" required=""></textarea>
                                                <div class="col-12 d-flex flex-wrap align-items-center border ">
                                                    <span class="text-primary  ms-2 text-white "><i class="fa-solid fa-phone"></i></span>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control main-control border-0" placeholder="Input URL..." required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <!--call-replay-->
                                    <div class="col-12  button_link2 d-none">
                                        <!-- <div class="col-12 d-flex flex-wrap remove-data">
                                            <div class="col-12 d-flex  flex-wrap justify-content-between align-items-center">
                                                <span class="fs-10">Url Button</span>
                                                <button class="bg-transparent border-0 mx-2 end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="col-12 border rounded-2 p-2">
                                                <textarea class="form-control main-control col border-0" placeholder="Start typing button label here..." cols="1" rows="1" required=""></textarea>
                                                <div class="col-12 d-flex flex-wrap align-items-center border justify-content-between">
                                                    <span class="text-primary  ms-2 text-white "><i class="fa-solid fa-link"></i></span>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control main-control border-0" placeholder="Input URL..." required="">
                                                    </div>
                                                    <button class="btn btn-primary   mx-2  end-0 me-2 fs-10"><i class="fa-solid fa-plus"></i> Variable</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex flex-wrap my-2 link_buttons remove-data">
                                            <div class="col-12 d-flex  flex-wrap justify-content-between align-items-center">
                                                <span class="fs-10">Url Button</span>
                                                <button class="bg-transparent border-0 mx-2 end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="col-12 border rounded-2 p-2 ">
                                                <textarea class="form-control main-control col border-0" placeholder="Start typing button label here..." cols="1" rows="1" required=""></textarea>
                                                <div class="col-12 d-flex flex-wrap align-items-center border ">
                                                    <span class="text-primary  ms-2 text-white "><i class="fa-solid fa-phone"></i></span>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control main-control border-0" placeholder="Input URL..." required="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6 hello">
                        <div class=" justify-content-center h-100 d-flex flex-wrap p-3">
                            <!-- whatsapp   .. -->
                            <div class="wa-preview-main-div-cont">
                                <div class="preview-chat-section">
                                    <div class="preview-header-main-cont">
                                        <div class="header-image">
                                            <img class="profile-img ng-scope" ng-if="!company_photo || company_photo.length == 0" ng-src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png" alt="logo" src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png"><!-- end ngIf: !company_photo || company_photo.length == 0 -->
                                        </div>
                                        <div class="preview-header-text">
                                            <span class="company-name user ng-binding">appo</span>
                                        </div>
                                        <div class="wa-phone-header">
                                            <i class="fa fa-video-camera wa-phone-header-video-icon" aria-hidden="true"></i>
                                            <i class="fa fa-phone wa-phone-header-call-icon" aria-hidden="true"></i>
                                            <i class="fa fa-ellipsis-v wa-phone-header-elicpse-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                    <div class="preview-chat-section-chat overflow-y-scroll">
                                        <div class="preview-chat-paragraph bg-white p-3 col-10">
                                            <div class="preview-header-paragraph" ng-if="submitParamDetails" class="ng-scope" style="">
                                                <div ng-if="media_footer_text.length > 0 " class="user-name-chat-header message msg  m-0 p-l-10 p-r-5 ng-binding ng-scope" contenteditable="false" style=""></div>
                                                <!-- end ngIf: media_footer_text.length > 0 -->
                                            </div>
                                            <div ng-if="final_bodyPreviewValue.length > 0" class="msg-text-chat message msg m-0 p-l-10 p-r-5 ng-scope" id="bodychange11">
                                            </div>
                                            <div class="preview-footer-paragraph p-1" ng-if="submitParamDetails" class="ng-scope" style="">
                                                <div ng-if="media_footer_text.length > 0 " class="user-name-chat-footer message msg font-size-12 m-0 p-l-10 p-r-5 ng-binding ng-scope" contenteditable="false" style=""></div>
                                                <!-- end ngIf: media_footer_text.length > 0 -->
                                            </div>
                                            <!-- <div class="preview-footer-paragraph p-1" ng-if="submitParamDetails" class="ng-scope" style="">
                                                        <a href="#" ng-if="media_footer_text.length > 0 " class="user-name-chat-footer message msg font-size-12 m-0 p-l-10 p-r-5 ng-binding ng-scope" contenteditable="false" style=""></a>
                                                        end ngIf: media_footer_text.length > 0
                                                    </div> -->
                                        </div>
                                        <div class="single-t-call-button">
                                            <button class="single-button-whatsapp-template1"></button>
                                            <button class="single-button-whatsapp-template2" data-template="2"></button>
                                            <button class="single-button-whatsapp-template3" data-template="3"></button>

                                        </div>
                                    </div>
                                    <div class="preview-call-button ng-scope" ng-if="!edit_template &amp;&amp; !preview_open">
                                        <div class="preview-whatsapp-footer">
                                            <div class="whatsapp-footer">

                                                <i class="fa fa-smile-o whatsapp-footer-relative" aria-hidden="true"></i>
                                                <input class="chat-btn-chat whatsapp-footer-1" placeholder="Type a message" ng-disabled="true" aria-disabled="true" disabled="disabled">
                                                <i class="fa fa-paperclip whatsapp-footer-2" aria-hidden="true"></i>
                                                <i class="fa fa-camera whatsapp-footer-3" aria-hidden="true"></i>
                                                <p class="audio-icon-tem"><i class="fa fa-microphone icon-tem-micro" aria-hidden="true"></i></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary previewbutton d-none" data-bs-target="#view_modal" data-bs-toggle="modal">Preview and Submit</button>
                    <button type="button" class="btn btn-primary Add_editModelTitle">Preview and Submit</button>
                </div>
            </div>
    </div>
</div>
<!-- last-modal -->
<div class="modal fade  " id="view_modal" aria-hidden="true" aria-labelledby="view_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="view_modal" name="view_modal">Template</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-secondery d-flex flex-wrap p-0">

                <div class="col-12 hello">
                    <div class=" justify-content-center h-100">
                        <!-- whatsapp   .. -->
                        <div class="wa-preview-main-div-cont">
                            <div class="preview-chat-section rounded-0">
                                <div class="preview-header-main-cont">
                                    <div class="header-image">
                                        <img class="profile-img ng-scope" ng-if="!company_photo || company_photo.length == 0" ng-src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png" alt="logo" src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png"><!-- end ngIf: !company_photo || company_photo.length == 0 -->
                                    </div>
                                    <div class="preview-header-text">
                                        <span class="company-name user ng-binding">appo</span>
                                    </div>
                                    <div class="wa-phone-header">
                                        <i class="fa fa-video-camera wa-phone-header-video-icon" aria-hidden="true"></i>
                                        <i class="fa fa-phone wa-phone-header-call-icon" aria-hidden="true"></i>
                                        <i class="fa fa-ellipsis-v wa-phone-header-elicpse-icon" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="preview-chat-section-chat overflow-y-scroll">
                                    <div class="preview-chat-paragraph bg-white p-3 col-10">
                                        <div class="preview-header-paragraph" ng-if="submitParamDetails" class="ng-scope" style="">
                                            <div ng-if="media_footer_text.length > 0 " class="user-name-chat-header message msg  m-0 p-l-10 p-r-5 ng-binding ng-scope" contenteditable="false" style=""></div>
                                        </div>

                                        <img class="rounded-3 preview-header-paragraphVIDEO" src="" style="width:200px;height:200px;object-fit: contain;">
                                        <!-- <div class="preview-header-paragraph" ng-if="submitParamDetails"
                                            class="ng-scope" style="">
                                            <div ng-if="media_footer_text.length > 0 "
                                                class="user-name-chat-header message msg  m-0 p-l-10 p-r-5 ng-binding ng-scope"
                                                contenteditable="false" style=""></div>
                                            end ngIf: media_footer_text.length > 0
                                        </div> -->
                                        <div ng-if="final_bodyPreviewValue.length > 0" class="msg-text-chat message msg m-0 p-l-10 p-r-5 ng-scope" id="bodychange11">
                                        </div>
                                        <div class="preview-footer-paragraph p-1" ng-if="submitParamDetails" class="ng-scope" style="">
                                            <div ng-if="media_footer_text.length > 0 " class="user-name-chat-footer message msg font-size-12 m-0 p-l-10 p-r-5 ng-binding ng-scope" contenteditable="false" style=""></div>
                                            <!-- end ngIf: media_footer_text.length > 0 -->
                                        </div>
                                        <!-- <div class="preview-footer-paragraph p-1" ng-if="submitParamDetails" class="ng-scope" style="">
                                                        <a href="#" ng-if="media_footer_text.length > 0 " class="user-name-chat-footer message msg font-size-12 m-0 p-l-10 p-r-5 ng-binding ng-scope" contenteditable="false" style=""></a>
                                                        end ngIf: media_footer_text.length > 0
                                                    </div> -->
                                    </div>
                                    <div class="single-t-call-button">
                                        <button class="single-button-whatsapp-template1"></button>
                                        <button class="single-button-whatsapp-template2" data-template="2"></button>
                                        <button class="single-button-whatsapp-template3" data-template="3"></button>

                                    </div>
                                </div>
                                <div class="preview-call-button ng-scope" ng-if="!edit_template &amp;&amp; !preview_open">
                                    <div class="preview-whatsapp-footer">
                                        <div class="whatsapp-footer">

                                            <i class="fa fa-smile-o whatsapp-footer-relative" aria-hidden="true"></i>
                                            <input class="chat-btn-chat whatsapp-footer-1" placeholder="Type a message" ng-disabled="true" aria-disabled="true" disabled="disabled">
                                            <i class="fa fa-paperclip whatsapp-footer-2" aria-hidden="true"></i>
                                            <i class="fa fa-camera whatsapp-footer-3" aria-hidden="true"></i>
                                            <p class="audio-icon-tem"><i class="fa fa-microphone icon-tem-micro" aria-hidden="true"></i></p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary SaveBtnDiv" data-bs-dismiss="modal">Delete</button>
                <button class="btn  btn-primary   Elbtn" data-bs-target="#whatsapp_template_add_edit" data-bs-toggle="modal"><i class="bi bi-pencil"></i></button>
            </div>

        </div>
    </div>
</div>
<!-- view sent msg -->
<?= $this->include('partials/footer') ?>
<script>
    $('body').on('click', '.previewbutton', function() {

        var body = $('.body_div').val();
        var regex = /{{\d+}}/g;
        var matches = body.match(regex);

        if (matches) {

            $('#dynamicInputsContainer').empty();

            for (var i = 0; i < matches.length; i++) {
                var inputField = '<input type="text" id="inputbody" class="form-control main-control inputypeBody mt-2" placeholder="Body{{ ' + (i + 1) + '}}" name="body_' + (i + 1) + '" required>';
                $('#dynamicInputsContainer').append(inputField);

            }
        }


    });

    $('#dynamicInputsContainer').on('input', '.inputypeBody', function() {
        var bodyText = $(this).val();
        var index = $('.inputypeBody').index($(this)) + 1;
        var regex = new RegExp("{{" + index + "}}", "g");

        // var regex = new RegExp('{{' + index + '}}');
        if (bodyText === "") {
            $('.preview-chat-paragraph').hide();
        } else {
            $('.preview-chat-paragraph').show();

            var originalText = $('.preview-chat-paragraph .msg-text-chat').html();
            var match = originalText.match(regex);
            console.log(match);
            if (match) {
                console.log(match[0].slice(2, -2));
            }
            var newText = originalText.replace(regex, bodyText);

            $('.preview-chat-paragraph .msg-text-chat').html(newText);
        }
    });











    // ========sidebar-jqury===================
    $('body').on('click', '.menu-toggle', function() {
        $(this).addClass('bg-body-secondary');
        $(this).siblings('.menu-toggle').removeClass('bg-body-secondary');
    });
    $('body').on('click', '.Arro-pro', function() {
        $(this).closest('.first-container').toggleClass('slide-toggle');
        $('.first-container-text').toggle();
        $('.Arrowmovement').toggleClass("arrow-down");
    });
    // ==========modal-header-jqury=============
    $('body').on('change', 'select#Template_header', function() {
        var a = $(this).val();
        if (a == 'TEXT') {
            $('.file_upload').addClass('d-none');
            $('.text-comment').removeClass('d-none');
        } else if (a == 0) {
            $('.file_upload').addClass('d-none');
            $('.text-comment').addClass('d-none');
        } else {
            $(this).closest('.header-jqury').children('.file_upload').removeClass('d-none');
            $(this).closest('.header-jqury').children('.text-comment').addClass('d-none');
        }
    });

    $('.single-button-whatsapp-template1').addClass('d-none');
    $('.single-button-whatsapp-template2').addClass('d-none');
    $('.single-button-whatsapp-template3').addClass('d-none');


    $('.button1input').on('input', function() {
        var button1input = $(this).val();
        $('.single-button-whatsapp-template1').removeClass('d-none');

        if (button1input === "") {
            $('.single-t-call-button').hide();

        } else {
            $('.single-t-call-button').show();
        }

        $('.single-t-call-button .single-button-whatsapp-template1').html(button1input);
    });
    $('.button2input').on('input', function() {
        var button2input = $(this).val();
        $('.single-button-whatsapp-template2').removeClass('d-none');

        if (button2input === "") {
            $('.single-t-call-button').hide();

        } else {
            $('.single-t-call-button').show();
        }

        $('.single-t-call-button .single-button-whatsapp-template2').html(button2input);
    });
    $('.button3input').on('input', function() {
        var button3input = $(this).val();
        $('.single-button-whatsapp-template3').removeClass('d-none');

        if (button3input === "") {
            $('.single-t-call-button').hide();

        } else {
            $('.single-t-call-button').show();
        }

        $('.single-t-call-button .single-button-whatsapp-template3').html(button3input);
    });





    $('.body_div').on('input', function() {
        var bodyText = $(this).val();
        // console.log(bodyText);

        if (bodyText === "") {
            $('.c').hide();

        } else {
            $('.preview-chat-paragraph').show();
        }

        $('.preview-chat-paragraph .msg-text-chat').html(bodyText);
    });


    $('.footer_div').on('input', function() {
        var footerText = $(this).val();
        if (footerText === "") {
            c
        } else {
            $('.preview-chat-paragraph').show();
        }


        $('.preview-footer-paragraph .user-name-chat-footer').html(footerText);
    });

    $('.MemberAddressClass').on('input', function() {
        var headerText = $(this).val();
        if (headerText === "") {
            $('.preview-chat-paragraph').hide();
        } else {
            $('.preview-chat-paragraph').show();
        }


        $('.preview-header-paragraph .user-name-chat-header').html(headerText);
    });

    // =======button-link======
    $('body').on('click', '.Button_make', function() {
        var b = $('#Button_make_picker').val();
        if (b == 'Quick') {
            $('.button_link1').removeClass('d-none');
            $('.button_link2').addClass('d-none');
        } else if (b == 'Call') {
            $('.button_link2').removeClass('d-none');
            $('.button_link1').addClass('d-none');
        } else {
            $('#button_link1').addClass('d-none');
            $('#button_link2').addClass('d-none');
        }
    });
    // ======remove-data======
    $('body').on('click', '.trash_section', function() {
        $(this).closest('.remove-data').remove();
    })

    $('body').on('click', '.Tab1Class', function() {

        $('.Activeclass').removeClass('d-none');
        $('#pills-ex-schedule-tab').removeClass('d-none');
        $('#pills-ex-single-tab').removeClass('d-none');


    });
    $('body').on('click', '.Tab2Class', function() {

        $('.Activeclass').addClass('d-none');
        $('#pills-ex-schedule-tab').addClass('d-none');
        $('#pills-ex-single-tab').addClass('d-none');


    });
    $('body').on('click', '.Tab3Class', function() {

        $('.Activeclass').addClass('d-none');
        $('#pills-ex-schedule-tab').addClass('d-none');
        $('#pills-ex-single-tab').addClass('d-none');

    });
</script>

<script>
    $('body').on('click', '.previewbutton', function() {

        var body = $('.body_div').val();
        var regex = /{{\d+}}/g;
        var matches = body.match(regex);

        if (matches) {

            $('#dynamicInputsContainer').empty();

            for (var i = 0; i < matches.length; i++) {
                var inputField = '<input type="text" id="inputbody" class="form-control main-control inputypeBody mt-2" placeholder="Body{{ ' + (i + 1) + '}}" name="body_' + (i + 1) + '" required>';
                $('#dynamicInputsContainer').append(inputField);
                // $('.msg-text-chat').append(body);

            }
        }

        function getValue(match) {
            return match.replace(/[{}]/g, '');
        }




    });

    function list_data() {

        var table = 'master_whatsapp_template';
        show_val = '<?= json_encode(array('Template_name', 'category_types', 'language', 'header', 'body', 'footer')); ?>';
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('master_whatsapp_list_data'); ?>",
            data: {
                'table': table,
                'show_array': show_val,
                'action': true,

            },
            success: function(res) {
                $('.loader').hide();
                var response = JSON.parse(res);
                var template_name = response.template_name;
                var templatelanguage = response.templatelanguage;


                $('.header_div').attr('DataMNo', response.templateid);
                var selectDropdown = document.getElementById("header");
                selectDropdown.innerHTML = "";
                var defaultOption = document.createElement("option");
                defaultOption.text = "Please select template";
                defaultOption.value = "";
                defaultOption.disabled = true;
                defaultOption.selected = true;
                selectDropdown.add(defaultOption);

                for (var key in template_name) {
                    if (template_name.hasOwnProperty(key)) {
                        var option = document.createElement("option");
                        option.text = template_name[key];
                        option.value = template_name[key];
                        selectDropdown.add(option);

                    }
                }

                $('#header').change(function() {
                    var selectDropdown = $(this).val();
                    var languageDropdown = templatelanguage[selectDropdown];
                    $('.language_div').val(languageDropdown);

                });


                $('#memberships_list').html(response.html);
            }
        });
    }
    list_data();



    $('.SaveBtnDiv').on('click', function(e) {
        e.preventDefault();


        var Template_name = $('.Template_name').val();
        var category_types = $('#category_types').val();
        var language = $('#languageid').val();
        var header = $('#Template_header').val();
        var footer = $('.footer_div').val();
        var header_text = $('.MemberAddressClass').val();
        var table = 'master_whatsapp_template';
        var uploade_file = $('#insert_image').prop('files')[0];
        var body = $('.body_div').val();

        // 07-02-2024

        var form = $("form[name='master_membership_update_form']")[0];
        var formData = new FormData(form);
        formData.append('Template_name', Template_name);
        formData.append('category_types', category_types);
        formData.append('language', language);
        formData.append('header', header);
        formData.append('body', body);
        formData.append('footer', footer);
        formData.append('table', table);
        formData.append('uploade_file', uploade_file);
        formData.append('header_text', header_text);
        formData.append('action', 'insert');


        if (Template_name != "" && footer != "" && category_types != "" && language != "") {

            // if (matches) {

            //     $('#dynamicInputsContainer').empty();

            //     for (var i = 0; i < matches.length; i++) {
            //         var inputField = '<input type="text" id="inputbody" class="form-control main-control body_div mt-2" placeholder="Body{{ ' + (i + 1) + '}}" name="body_' + (i + 1) + '" required>';
            //         $('#dynamicInputsContainer').append(inputField);
            //     }
            // } 
            // function getValue(match) {
            //     return match.replace(/[{}]/g, '');
            // }


            $.ajax({
                method: "post",
                url: "<?= site_url('whatsapp_template_insert'); ?>",
                data: formData,
                processData: false,
                contentType: false,

                success: function(data) {
                    if (data == 0) {
                        list_data();
                        $(".membershipDiv")[0].reset();
                        $(".membershipDiv").removeClass("was-validated");
                        $(".close_btn").trigger("click");
                        iziToast.success({
                            title: 'Added Successfully'
                        });


                        list_data();
                    } else {
                        $('.loader').hide();
                        $(".membershipDiv")[0].reset();
                        $(".close_btn").trigger("click");
                        iziToast.error({
                            title: 'Duplicate package'
                        });
                        $(".membershipDiv").addClass("was-validated");
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        } else {
            $(".membershipDiv").addClass("was-validated");
        }

    });

    function isValidURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?' +
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' +
            '((\\d{1,3}\\.){3}\\d{1,3}))' +
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' +
            '(\\?[;&a-z\\d%_.~+=-]*)?' +
            '(\\#[-a-z\\d_]*)?$', 'i');
        return pattern.test(str);
    }

    $('body').on('click', '.WhatsAppTemplateModelViewBtn', function() {
        // $('#view_modal').modal('show');
        var Body = $(this).attr('Bodytext');
        var footer = $(this).attr('footertext');
        var header = $(this).attr('headertext');
        var button = $(this).attr('buttontext');

        

        if (isValidURL(header)) {
            $('.preview-header-paragraphVIDEO').removeClass('d-none');
            $('.preview-header-paragraph').addClass('d-none')
            $(".preview-header-paragraphVIDEO").attr('src', header).addClass("col-12 rounded-3 border border-3");

        } else {
            $('.preview-header-paragraph').text(header).css('font-weight', 'bold');
            $('.preview-header-paragraphVIDEO').addClass('d-none');
            $('.preview-header-paragraph').removeClass('d-none')


        }
        if(button == ""){
            $('.single-button-whatsapp-template1').addClass('d-none');

        }else{
            $('.single-button-whatsapp-template1').text(button);
            $('.single-button-whatsapp-template1').removeClass('d-none');

        }
        
        $('.msg-text-chat').text(Body);
        $('.preview-footer-paragraph').text(footer);


    });




    $('body').on('click', '.Edit_template', function(e) {
        e.preventDefault();
        var edit_value = $(this).attr('data-edit_id');

        $.ajax({
            type: "post",
            url: "<?= site_url('whatsapptemplate_edit_data'); ?>",
            data: {
                action: 'edit',
                edit_id: edit_value,
                table: 'master_whatsapp_template'
            },
            success: function(res) {

                var response = JSON.parse(res);
                console.log(response);
                $('.Template_name').val(response[0].template_name);
                $('.category_div').val(response[0].category_types);
                $('.language_div').val(response[0].language);
                $('.header_text').val(response[0].header_text);
                $('.body_div').val(response[0].body);
                $('.footer_div').val(response[0].footer);
                $('.header_div').val(response[0].header);




            }
        });

    });





    $('body').on('click', '.Delete_template_id', function(e) {
        e.preventDefault();
        var record_text = "Are you sure you want to Delete this?";
        var id = $(this).attr("id");
        var name = $(this).attr("name");

        if (id != '') {
            Swal.fire({
                title: 'Are you sure?',
                text: record_text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'CONFIRM',
                cancelButtonText: 'CANCEL',
                cancelButtonColor: '#6e7881',
                confirmButtonColor: '#dd3333',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    console.log(id);
                    $.ajax({
                        method: "post",
                        url: "<?= site_url('WhatsAppRTemplateDeleteRequest'); ?>",
                        data: {
                            id: id,
                            name: name,
                        },
                        success: function(data) {
                            if (data == '0') {
                                iziToast.error({
                                    title: "Can't Deleted"
                                });
                            } else {
                                iziToast.error({
                                    title: 'Deleted Successfully'
                                });
                            }
                            $(".close_btn").trigger("click");
                            list_data();
                        }
                    });
                }
            });
        }
    });





    $('body').on('click', '.ButtonVariableClass', function() {
        var DDValue = $('select.ButtonSelctionDropDown option:selected').attr('DataStaticId');
        // 1 - Empty && 2 - Quick (Only 3 Max Button) && 3 - Call To Active (Link - Phone No)
        if (DDValue == '1') {
            $('.SetButtonHTMLClass').html('');
        } else if (DDValue == '2') {
            var previous_hmml = $('.SetButtonHTMLClass').html();
            var StaticHtml = '<div class="col-12 d-flex flex-wrap align-items-center position-relative my-2 remove-data QuickSetButtonHTMLClass"> <span class="fs-10 btn bg-primary  position-absolute ms-2 text-white ">Button</span> <textarea class="form-control main-control col  button1input QuickSubButtonInput" data-template="1" placeholder="Start typing button label here..." cols="1" rows="1" required="" style="padding-left:74px;"></textarea> <button class="bg-transparent border-0 mx-2 position-absolute end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button> </div>';
            var numberOfSubElements = $(".SetButtonHTMLClass .QuickSetButtonHTMLClass").length;
            if (parseInt(numberOfSubElements) < 3) {
                $('.SetButtonHTMLClass').html(previous_hmml + StaticHtml);
            }
        } else if (DDValue == '3') {
            var SetHtml = $('.SetButtonHTMLClass').html();
            var numberOfSubElementsUrl = $(".SetButtonHTMLClass .urlbtnhtmlClass").length;
            var numberOfSubElementsCno = $(".SetButtonHTMLClass .phonenobtnClass").length;
            if (numberOfSubElementsUrl == '0') {
                var urlbtnhtml = '<div class="col-12 d-flex flex-wrap remove-data urlbtnhtmlClass"> <div class="col-12 d-flex  flex-wrap justify-content-between align-items-center"> <span class="fs-10">Url Button</span> <button class="bg-transparent border-0 mx-2 end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button> </div> <div class="col-12 border rounded-2 p-2"> <textarea class="form-control lableUrlInputField main-control col border-0" placeholder="Start typing button label here..." cols="1" rows="1" required=""></textarea> <div class="col-12 d-flex flex-wrap align-items-center border justify-content-between"> <span class="text-primary  ms-2 text-white "><i class="fa-solid fa-link"></i></span> <div class="col"> <input type="text" class="form-control main-control UrlUrlInputField border-0" placeholder="Input URL..." required=""> </div> <button class="btn btn-primary  d-none mx-2  end-0 me-2 fs-10"><i class="fa-solid fa-plus"></i> Variable</button> </div> </div> </div>';
                $('.SetButtonHTMLClass').html(SetHtml + urlbtnhtml);

            }
            if (numberOfSubElementsCno == '0') {
                var SetHtml = $('.SetButtonHTMLClass').html();
                var phonenobtn = '<div class="col-12 d-flex flex-wrap my-2 link_buttons remove-data phonenobtnClass"> <div class="col-12 d-flex  flex-wrap justify-content-between align-items-center"> <span class="fs-10">Url Button</span> <button class="bg-transparent border-0 mx-2 end-0 me-2 trash_section"><i class="fa-solid fa-trash-can"></i></button> </div> <div class="col-12 border rounded-2 p-2 "> <textarea class="form-control lablCnoInputField main-control  col border-0" placeholder="Start typing button label here..." cols="1" rows="1" required=""></textarea> <div class="col-12 d-flex flex-wrap align-items-center border "> <span class="text-primary  ms-2 text-white "><i class="fa-solid fa-phone"></i></span> <div class="col-7"> <input type="text" class="form-control CnoCnoInputField main-control border-0" placeholder="Input URL..." required=""> </div> </div> </div> </div>';
                $('.SetButtonHTMLClass').html(SetHtml + phonenobtn);
            }
        }
    });



    // $('body').on('click', '.Add_editModelTitle', function () {
    //     var name = $('.Template_name').val();
    //     var category = $('select.TemplateCategorySelectionDiv option:selected').val();
    //     var language = $('select.TemplateLanguageDDList option:selected').val();
    //     var headertype = $('select.HeaderSelectionDD option:selected').val();
    //     var headertext = $('.ClassHeaderTEXT').val();
    //     var body = $('.TemplateBodyClass').val();
    //     var footer = $('.FotterTextDIvClass').val();

    //     var templateArray = {
    //         'name': name,
    //         'category': category,
    //         'language': language,
    //         'components': []
    //     };

    //     if (headertext) {
    //         templateArray.components.push({
    //             'type': 'HEADER',
    //             'format': 'TEXT',
    //             'text': headertext
    //         });
    //     }

    //     if (body) {
    //         templateArray.components.push({
    //             'type': 'BODY',
    //             'text': body
    //         });
    //     }

    //     if (footer) {
    //         templateArray.components.push({
    //             'type': 'FOOTER',
    //             'text': footer
    //         });
    //     }

    //     var jsonString = JSON.stringify(templateArray);


    //     // $.ajax({
    //     //     method: "post",
    //     //     url: "<?= site_url('SendWhatsAppTemplate'); ?>",
    //     //     data: {
    //     //         jsonString: jsonString,
    //     //     },
    //     //     success: function (data) {
    //     //         if (data == '0') {
    //     //             iziToast.error({
    //     //                 title: "Failed to add template"
    //     //             });
    //     //         } else {
    //     //             iziToast.success({
    //     //                 title: "Added Successfully"
    //     //             });
    //     //         }
    //     //         $(".close_btn").trigger("click");
    //     //         list_data();
    //     //     }
    //     // });
    // });

    $(document).ready(function() {
        // $('#insert_image').on('change', function () {
        //     var fileInput = $(this);
        //     var fileName = fileInput.val();
        //     if (fileName) {
        //         var form = $("form[name='master_membership_update_form']")[0];
        //         var formData = new FormData(form);
        //         var uploade_file = $('#insert_image').prop('files')[0];
        //         formData.append('uploade_file', uploade_file);
        //         $.ajax({
        //             method: "post",
        //             url: "<?= site_url('WhatappFileUpload'); ?>",
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             success: function (data) {
        //                 $(this).attr('DataStoreURL', data);
        //             }
        //         });
        //     } else {
        //         $(this).attr('DataStoreURL', '');
        //     }
        // });
    });

    $('body').on('click', '.Add_editModelTitle', function() {
        var name = $('.Template_name').val();
        var category = $('select.TemplateCategorySelectionDiv option:selected').val();
        var language = $('select.TemplateLanguageDDList option:selected').val();
        var headertype = $('select.HeaderSelectionDD option:selected').val();
        var headerfile = '';


        if (headertype == 'IMAGE' || headertype == 'VIDEO' || headertype == "DOCUMENT") {
            var fileInput = $('#insert_image');
            var fileName = fileInput.val();
            if (fileName) {
                var form = $("form[name='master_membership_update_form']")[0];
                var formData = new FormData(form);
                var uploade_file = $('#insert_image').prop('files')[0];
                formData.append('uploade_file', uploade_file);
                $.ajax({
                    method: "post",
                    url: "<?= site_url('WhatappFileUpload'); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // $(this).attr('DataStoreURL', data);
                        // console.log(data);
                        headerfile = data;


                        var headertext = $('.ClassHeaderTEXT').val();
                        var body = $('.TemplateBodyClass').val();
                        var footer = $('.FotterTextDIvClass').val();


                        var buttontype = $('select.ButtonSelctionDropDown option:selected').attr('DataStaticId');
                        var QuickArray = [];

                        if (buttontype == '1') {


                        } else if (buttontype == '2') {

                            var numberOfSubElements = $(".SetButtonHTMLClass .QuickSetButtonHTMLClass").length;
                            if (numberOfSubElements > 0) {
                                var QuickArray = [];
                                $(".QuickSubButtonInput").each(function() {
                                    var QuickBtntext = $(this).val();
                                    if (QuickBtntext != '') {
                                        QuickArray.push({
                                            'type': 'QUICK_REPLY',
                                            'text': QuickBtntext
                                        });
                                    }
                                });
                                // console.log(QuickArray);
                            }
                        } else if (buttontype == '3') {
                            var QuickArray = [];
                            var numberOfSubElementsUrl = $(".SetButtonHTMLClass .urlbtnhtmlClass").length;
                            var numberOfSubElementsCno = $(".SetButtonHTMLClass .phonenobtnClass").length;
                            if (numberOfSubElementsUrl > 0) {
                                var QuickArray = [];
                                var label = $('.lableUrlInputField').val();
                                var Url = $('.UrlUrlInputField').val();
                                if (label != '' && Url != '') {
                                    QuickArray.push({
                                        'type': 'URL',
                                        'text': label,
                                        'url': Url
                                    });
                                }
                            }
                            if (numberOfSubElementsCno > 0) {
                                var label = $('.lablCnoInputField').val();
                                var Url = $('.CnoCnoInputField').val();
                                if (label != '' && Url != '') {
                                    QuickArray.push({
                                        'type': 'PHONE_NUMBER',
                                        'text': label,
                                        'phone_number': Url
                                    });
                                }
                            }
                        }




                        var templateArray = {
                            'name': name,
                            'category': category,
                            'language': language,
                            'components': []
                        };


                        if (headertype != '') {
                            if (headertype == 'TEXT') {
                                if (headertext) {
                                    templateArray.components.push({
                                        'type': 'HEADER',
                                        'format': 'TEXT',
                                        'text': headertext
                                    });
                                }
                            }
                            if (headertype == 'IMAGE' && headerfile != '') {
                                var exampleData = {
                                    "header_handle": [
                                        headerfile
                                    ]
                                };
                                templateArray.components.push({
                                    'type': 'HEADER',
                                    'format': 'IMAGE',
                                    'example': exampleData
                                });
                            }
                            if (headertype == 'VIDEO' && headerfile != '') {
                                var exampleData = {
                                    "header_handle": [
                                        headerfile
                                    ]
                                };
                                templateArray.components.push({
                                    'type': 'HEADER',
                                    'format': 'VIDEO',
                                    'example': exampleData
                                });
                            }
                            if (headertype == 'DOCUMENT' && headerfile != '') {
                                var exampleData = {
                                    "header_handle": [
                                        headerfile
                                    ]
                                };
                                templateArray.components.push({
                                    'type': 'HEADER',
                                    'format': 'DOCUMENT',
                                    'example': exampleData
                                });
                            }
                        }
                        if (body) {
                            templateArray.components.push({
                                'type': 'BODY',
                                'text': body
                            });
                        }
                        if (footer) {
                            templateArray.components.push({
                                'type': 'FOOTER',
                                'text': footer
                            });
                        }
                        if (QuickArray.length > 0) {
                            templateArray.components.push({
                                'type': 'BUTTONS',
                                'buttons': QuickArray
                            });
                        }
                        var jsonString = JSON.stringify(templateArray);
                        console.log(jsonString);
                        if (headerfile != '') {

                            $.ajax({
                                method: "post",
                                url: "<?= site_url('SendWhatsAppTemplate'); ?>",
                                data: {
                                    jsonString: jsonString,
                                },
                                success: function(data) {
                                    if (data == '0') {
                                        iziToast.error({
                                            title: "Failed to add template"
                                        });
                                    } else {
                                        iziToast.success({
                                            title: "Added Successfully"
                                        });
                                    }
                                    $(".close_btn").trigger("click");
                                    list_data();
                                }
                            });
                        }
                        // console.log(jsonString);
                    }
                });
            } else {
                $(this).attr('DataStoreURL', '');
            }
        } else {
            var headertext = $('.ClassHeaderTEXT').val();
            var body = $('.TemplateBodyClass').val();
            var footer = $('.FotterTextDIvClass').val();


            var buttontype = $('select.ButtonSelctionDropDown option:selected').attr('DataStaticId');
            var QuickArray = [];

            if (buttontype == '1') {


            } else if (buttontype == '2') {

                var numberOfSubElements = $(".SetButtonHTMLClass .QuickSetButtonHTMLClass").length;
                if (numberOfSubElements > 0) {
                    var QuickArray = [];
                    $(".QuickSubButtonInput").each(function() {
                        var QuickBtntext = $(this).val();
                        if (QuickBtntext != '') {
                            QuickArray.push({
                                'type': 'QUICK_REPLY',
                                'text': QuickBtntext
                            });
                        }
                    });
                    // console.log(QuickArray);
                }
            } else if (buttontype == '3') {
                var QuickArray = [];
                var numberOfSubElementsUrl = $(".SetButtonHTMLClass .urlbtnhtmlClass").length;
                var numberOfSubElementsCno = $(".SetButtonHTMLClass .phonenobtnClass").length;
                if (numberOfSubElementsUrl > 0) {
                    var QuickArray = [];
                    var label = $('.lableUrlInputField').val();
                    var Url = $('.UrlUrlInputField').val();
                    if (label != '' && Url != '') {
                        QuickArray.push({
                            'type': 'URL',
                            'text': label,
                            'url': Url
                        });
                    }
                }
                if (numberOfSubElementsCno > 0) {
                    var label = $('.lablCnoInputField').val();
                    var Url = $('.CnoCnoInputField').val();
                    if (label != '' && Url != '') {
                        QuickArray.push({
                            'type': 'PHONE_NUMBER',
                            'text': label,
                            'phone_number': Url
                        });
                    }
                }
            }




            var templateArray = {
                'name': name,
                'category': category,
                'language': language,
                'components': []
            };


            if (headertype != '') {
                console.log(headertype);
                if (headertype == 'TEXT') {
                    if (headertext) {
                        templateArray.components.push({
                            'type': 'HEADER',
                            'format': 'TEXT',
                            'text': headertext
                        });
                    }
                }
                console.log(headerfile);
                // console.log(headertype);
                if (headertype == 'IMAGE' && headerfile != '') {
                    var exampleData = {
                        "header_handle": [
                            headerfile
                        ]
                    };
                    templateArray.components.push({
                        'type': 'HEADER',
                        'format': 'IMAGE',
                        'example': exampleData
                    });
                }
                if (headertype == 'VIDEO' && headerfile != '') {
                    var exampleData = {
                        "header_handle": [
                            headerfile
                        ]
                    };
                    templateArray.components.push({
                        'type': 'HEADER',
                        'format': 'VIDEO',
                        'example': exampleData
                    });
                }
                if (headertype == 'DOCUMENT' && headerfile != '') {
                    var exampleData = {
                        "header_handle": [
                            headerfile
                        ]
                    };
                    templateArray.components.push({
                        'type': 'HEADER',
                        'format': 'DOCUMENT',
                        'example': exampleData
                    });
                }
            }

            if (body) {
                templateArray.components.push({
                    'type': 'BODY',
                    'text': body
                });
            }

            if (footer) {
                templateArray.components.push({
                    'type': 'FOOTER',
                    'text': footer
                });
            }

            if (QuickArray.length > 0) {
                templateArray.components.push({
                    'type': 'BUTTONS',
                    'buttons': QuickArray
                });
                // console.log(QuickArray);
            }


            var jsonString = JSON.stringify(templateArray);
            $.ajax({
                method: "post",
                url: "<?= site_url('SendWhatsAppTemplate'); ?>",
                data: {
                    jsonString: jsonString,
                },
                success: function(data) {
                    if (data == '0') {
                        iziToast.error({
                            title: "Failed to add template"
                        });
                    } else {
                        iziToast.success({
                            title: "Added Successfully"
                        });
                    }
                    $(".close_btn").trigger("click");
                    list_data();
                }
            });
            // console.log(jsonString);

        }

    });
    $('.tip').each(function() {
        $(this).tooltip({
            html: true,
            title: $('#' + $(this).data('tip')).html()
        });

        $('body').on('click', '.PlusButtonDiv', function() {
            alert();
        });

    });
    // =======country-code==
    $("#mobile_code").intlTelInput({
        initialCountry: "in",
        separateDialCode: true,
        // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });

    // --------------------------------------------------------------

    $('body').on('click', '.Template_send', function() {
        var header = $('.header_div').val();
        var phone_no = $('.phone_number_div').val();
        var language = $('.language_div').val();

        if (header !== "" && phone_no !== "" && language !== "") {
            $.ajax({
                dataType: 'json',
                method: "POST",
                url: "<?= site_url('single_whatsapp_template_sent'); ?>",
                data: {
                    'header': header,
                    'phone_no': phone_no,
                    'language': language,
                    'action': true
                },
                success: function(res) {
                    console.log(res);
                    $('.loader').hide();
                    if (res == '1') {
                        iziToast.success({
                            title: "Message sent successfully"
                        });
                    } else {
                        iziToast.error({
                            title: 'Something went wrong!'
                        });
                    }
                },

            });
        } else {
            $(".membershipDiv").addClass("was-validated");
        }
    });
</script>