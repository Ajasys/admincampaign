<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php $table_username = getMasterUsername(); ?>

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
    .first-container{
        width: 102px;
    }
    .slide-toggle{
        width: 443px;
    }
</style>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="col-12 p-2 d-flex flex-wrap">
            <div class="p-1 first-container slide-toggle">
                <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex flex-wrap">
                    <div class="col-12 d-flex flex-wrap w-100 mt-5">
                        <ul class="d-flex flex-wrap">
                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle bg-body-secondary">
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                        xml:space="preserve" class="">
                                        <g>
                                            <path
                                                d="M256.064 0h-.128C114.784 0 0 114.816 0 256c0 56 18.048 107.904 48.736 150.048l-31.904 95.104 98.4-31.456C155.712 496.512 204 512 256.064 512 397.216 512 512 397.152 512 256S397.216 0 256.064 0z"
                                                style="" fill="#724ebf" data-original="#4caf50" class="" opacity="1">
                                            </path>
                                            <path
                                                d="M405.024 361.504c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.616-127.456-112.576-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016.16 8.576.288 7.52.32 11.296.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744-3.776 4.352-7.36 7.68-11.136 12.352-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z"
                                                style="" fill="#fafafa" data-original="#fafafa" class=""></path>
                                        </g>
                                    </svg>
                                </p>
                                <span class="ms-3 first-container-text">Send Template Messages</span>
                            </li>
                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle">
                                <p><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                        viewBox="0 0 512 512.001" style="enable-background:new 0 0 512 512"
                                        xml:space="preserve" class="">
                                        <g>
                                            <path fill="#b55dcd"
                                                d="M504.34 187.367v269.344c0 13.816-5.88 26.254-15.266 34.965-8.515 7.894-19.91 12.719-32.43 12.719H55.294c-12.52 0-23.914-4.825-32.418-12.711-9.39-8.72-15.27-21.157-15.27-34.973V187.367zm0 0"
                                                opacity="1" data-original="#fec970" class=""></path>
                                            <path fill="#b55dcd"
                                                d="M258 504.395H55.293c-26.336 0-47.688-21.348-47.688-47.684V185.766l52.97 45.71 3.304 2.747v135.933c0 46.246 18.66 90.078 61.207 108.223C164.34 495.12 234.18 504.395 258 504.395zm0 0"
                                                opacity="1" data-original="#fba028" class=""></path>
                                            <path fill="#b55dcd"
                                                d="M504.34 187.367 313.406 28.387C280.13.68 231.812.68 198.536 28.387L7.601 187.367h.003l56.274 46.856 134.656 112.12c33.281 27.716 81.598 27.716 114.867 0l134.668-112.12z"
                                                opacity="1" data-original="#fba028" class=""></path>
                                            <path fill="#b55dcd"
                                                d="M448.07 88.152v146.07L313.402 346.345c-33.27 27.715-81.586 27.715-114.867 0L63.88 234.223V88.153c0-30.454 24.695-55.15 55.16-55.15h273.883c30.46 0 55.148 24.696 55.148 55.15zm0 0"
                                                opacity="1" data-original="#bfdadd" class=""></path>
                                            <path fill="#b55dcd"
                                                d="M448.07 88.152V200.77L313.402 312.89c-33.27 27.715-81.586 27.715-114.867 0L63.88 200.77V88.152c0-30.453 24.695-55.148 55.16-55.148h273.883c30.46 0 55.148 24.695 55.148 55.148zm0 0"
                                                opacity="1" data-original="#e4f5f7" class=""></path>
                                            <path fill="#26bf64"
                                                d="M494.203 114.055c0 58.507-47.43 105.937-105.937 105.937s-105.938-47.43-105.938-105.937c0-58.512 47.43-105.942 105.938-105.942s105.937 47.43 105.937 105.942zm0 0"
                                                opacity="1" data-original="#26bf64" class=""></path>
                                            <path fill="#49d685"
                                                d="M494.2 114.05c0 51.485-36.716 94.388-85.395 103.95-48.684-9.55-85.41-52.465-85.41-103.95 0-51.48 36.726-94.39 85.41-103.94 48.68 9.558 85.394 52.46 85.394 103.94zm0 0"
                                                opacity="1" data-original="#49d685" class=""></path>
                                            <path
                                                d="M453.18 471.688a7.57 7.57 0 0 0 4.86 1.761c2.179 0 4.343-.933 5.847-2.742a7.599 7.599 0 0 0-.98-10.707L341.675 359.062a7.604 7.604 0 1 0-9.73 11.688zM53.906 473.445a7.575 7.575 0 0 0 4.864-1.757l121.234-100.942a7.601 7.601 0 0 0 .976-10.707 7.602 7.602 0 0 0-10.707-.977L49.043 460a7.599 7.599 0 0 0-.98 10.707 7.572 7.572 0 0 0 5.843 2.738zM144.465 225.832h160.172c4.199 0 7.601-3.406 7.601-7.605a7.6 7.6 0 0 0-7.601-7.602H144.465a7.604 7.604 0 1 0 0 15.207zM367.484 254.781h-223.02a7.603 7.603 0 1 0 0 15.207h223.02c4.204 0 7.606-3.402 7.606-7.601s-3.406-7.606-7.606-7.606zM144.465 137.516h111.512a7.604 7.604 0 0 0 0-15.207H144.465a7.606 7.606 0 0 0-7.606 7.601c0 4.2 3.407 7.606 7.606 7.606zM211.617 174.07c0 4.2 3.406 7.602 7.606 7.602h55a7.6 7.6 0 0 0 7.601-7.602c0-4.199-3.402-7.605-7.601-7.605h-55a7.607 7.607 0 0 0-7.606 7.605zM144.465 181.672h49.41a7.604 7.604 0 1 0 0-15.207h-49.41a7.604 7.604 0 1 0 0 15.207zM426.39 62.188l-40.75 95.085-36.148-43.046a7.603 7.603 0 1 0-11.64 9.78l44.09 52.505a7.603 7.603 0 0 0 6.933 2.633 7.6 7.6 0 0 0 5.875-4.528l45.617-106.441a7.603 7.603 0 1 0-13.976-5.989zm0 0"
                                                fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                                            <path
                                                d="m505.402 178.355-15.816-13.167c7.828-15.477 12.219-32.891 12.219-51.137 0-20.633-5.594-40.84-16.168-58.43a7.606 7.606 0 0 0-13.035 7.836c9.156 15.223 13.996 32.719 13.996 50.59 0 46.89-33.332 87.473-79.262 96.488a98.905 98.905 0 0 1-19.07 1.856c-54.223 0-98.336-44.118-98.336-98.344 0-54.219 44.113-98.332 98.336-98.332 6.406 0 12.82.625 19.07 1.855 17.8 3.496 34.285 11.887 47.676 24.274a7.61 7.61 0 0 0 10.746-.422c2.851-3.082 2.66-7.895-.422-10.746-15.461-14.297-34.504-23.988-55.063-28.028a114.37 114.37 0 0 0-22.007-2.14c-25.778 0-49.567 8.64-68.649 23.168l-1.347-1.125c-36.094-30.067-88.497-30.067-124.602 0l-3.418 2.851h-71.21c-34.606 0-62.763 28.149-62.763 62.75v49.305L4.836 180.285c-.152.063-.305.125-.457.2a7.596 7.596 0 0 0-4.375 6.882V396.48c0 4.2 3.402 7.602 7.601 7.602s7.606-3.402 7.606-7.602V203.594l178.46 148.593c18.052 15.032 40.177 22.551 62.302 22.547 22.125 0 44.25-7.515 62.293-22.546l178.468-148.594v253.113c0 22.106-17.98 40.086-40.086 40.086H55.293c-22.106 0-40.086-17.98-40.086-40.086v-29.812a7.604 7.604 0 0 0-15.207 0v29.812C0 487.195 24.805 512 55.293 512h401.355c30.489 0 55.293-24.805 55.293-55.293V187.563c.094-3.684-1.046-4.633-6.539-9.208zM295.582 25.402h-79.223c24.621-13.574 54.61-13.574 79.223 0zM56.277 157.242V218l-36.484-30.379zm252.258 183.262c-30.453 25.367-74.668 25.367-105.133-.004L71.484 230.66V88.152c0-26.218 21.332-47.547 47.555-47.547H301.75c-16.844 19.813-27.023 45.461-27.023 73.446 0 62.61 50.933 113.547 113.539 113.547 7.39 0 14.796-.72 22.004-2.141a112.384 112.384 0 0 0 30.195-10.578v15.777zm147.137-122.508v-12.601a114.146 114.146 0 0 0 26.062-26.957c3.325 2.765 7.348 6.117 10.727 8.93zm0 0"
                                                fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                                        </g>
                                    </svg></p>
                                <span class="ms-3 first-container-text">View Sent Messages</span>
                            </li>
                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle">
                                <p><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                        xml:space="preserve" class="">
                                        <g>
                                            <path d="M391.474 0v72.894h72.489C435.664 44.594 419.692 28.218 391.474 0z"
                                                fill="#724ebf" opacity="1" data-original="#000000" class=""></path>
                                            <path
                                                d="M361.474 102.894V0H114.613v217.584h304.119v30H251.317v33.734h167.415v30H251.317v33.734h167.415v30H251.317v33.734h167.415v30H114.613V512H464.09V102.894zm57.258 80.956H315.829v-30h102.902v30z"
                                                fill="#724ebf" opacity="1" data-original="#000000" class=""></path>
                                            <path
                                                d="M221.317 247.584H47.91v161.203h173.407zm-46.736 67.683h-24.968v58.838h-30v-58.838H94.646v-30h79.936v30z"
                                                fill="#724ebf" opacity="1" data-original="#000000" class=""></path>
                                        </g>
                                    </svg></p>
                                <span class="ms-3 first-container-text"> Create Templates</span>
                            </li>

                        </ul>

                    </div>
                    <div class="col-12 mt-2 d-flex justify-content-end">
                        <div class="col-1 p-3 Arro-pro"><i class="bi bi-arrow-left Arrowmovement"></i></div>
                    </div>
                </div>
            </div>
            <div class="col p-1">
                <!-- <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex flex-wrap">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 border-bottom p-3">
                            <h6 class="">Single Templates</h6>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <div class="col-6 p-2">
                                <div class="col-12 my-3">
                                    <select class="form-select p-2" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 my-3">
                                    <input type="text" class="form-control p-2 main-control phone_number_div" id="phone_number" placeholder="Enter your phone number" name="max_cost" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                </div>
                                <div class="col-12 my-3">
                                    <select class="form-select p-2" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 my-4 d-flex justify-content-center">
                                <button type="button" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                            <div class="col-6 p-2 d-flex justify-content-center">
                            <div class="wa-preview-main-div-cont col-8 ">
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
                </div> -->
                <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex flex-wrap ">
                    <div class="col-12 d-flex flex-wrap my-2">

                        <div class="col-4 d-flex align-items-center">
                            <h6>WhatsApp Template Details</h6>
                        </div>
                        <div class="col-3 d-flex align-items-center">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search"
                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary border" type="button" id="button-addon2"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </div>
                        <div class="col-5 d-flex flex-wrap align-items-center justify-content-end float-end ">
                            <div class="col-5 px-2">
                                <button type="button" class="btn-primary CancleBtn me-2  w-100" data-bs-dismiss="modal"
                                    data-bs-toggle="modal" id="cancel" data-delete_id=""><i
                                        class="bi bi-arrow-repeat"></i> Sync with Facebook</button>
                            </div>

                            <div class="col-1 px-2">
                                <button class="btn-primary-rounded" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="bi bi-plus PlusButtonDiv" id="plus_btn"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="px-3 py-2 bg-white rounded-2 mx-2">
                            <table id="memberships_table"
                                class="w-100 m-memberships table table-striped dt-responsive nowrap master_memberships_insert main-table">
                                <thead>
                                    <tr class="th-header-noborder">
                                        <th class="template-creation-heading">Name <i class="fa fa-sort p-l-10"
                                                ng-class="{'lblue' : temOrderBy == 'name' || temOrderBy == '-name'}"
                                                ng-click="setTemorder('name')" role="button" tabindex="0"></i></th>
                                        <th class="template-creation-heading">Category</th>
                                        <th class="template-creation-heading" style="max-width: 400px;">Preview</th>
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
    </div>
</div>

<!-- add model -->
<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create a Template Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-secondery d-flex flex-wrap">
                <div class="col-6">
                    <div class="modal-body-card justify-content-center">
                        <div class="col-12 mb-3 ">
                            <input type="text"
                                class="form-control main-control Template_name_varification Template_name"
                                id="Template_nameId" placeholder="Template name" name="Template_name" required>
                            <p class="CheckTemplateNameAlertPTag text-danger fs-12" style="display:none;">Name can
                                only contain lowercase alphanumeric characters and underscores ( _ )</p>
                        </div>

                        <div class="col-12 mb-3 ">
                            <select class="form-control main-control category_div" id="category" name="category_types"
                                required>
                                <option class="fs-12" label="Please select your category" value=""></option>

                                <option value="Utility" ng-repeat="category in category_types"
                                    class="fs-12 ng-binding ng-scope">
                                    Utility</option>
                                </option>
                                <option value="Authentication" ng-repeat="category in category_types"
                                    class="fs-12 ng-binding ng-scope">
                                    Authentication</option>
                                </option>
                                <option value="MARKETING" ng-repeat="category in category_types"
                                    class="fs-12 ng-binding ng-scope">
                                    Marketing</option>
                                </option>

                            </select>
                        </div>
                        <div class="col-12 mb-3 ">

                            <select class="form-control main-control language_div" id="language" name="language"
                                required>
                                <option class="fs-12" label="Please select your language" value=""></option>
                                <option class="fs-12 ng-binding ng-scope" value="en_US"
                                    ng-repeat="lang in template_lang">English US (en_US)</option>
                                <option class="fs-12 ng-binding ng-scope" value="en" ng-repeat="lang in template_lang">
                                    English (en)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="af" ng-repeat="lang in template_lang">
                                    Afrikaans</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="sq" ng-repeat="lang in template_lang">
                                    Albanian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ar" ng-repeat="lang in template_lang">
                                    Arabic</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="az" ng-repeat="lang in template_lang">
                                    Azerbaijani</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="bn" ng-repeat="lang in template_lang">
                                    Bengali</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="bg" ng-repeat="lang in template_lang">
                                    Bulgarian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ca" ng-repeat="lang in template_lang">
                                    Catalan</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="zh_CN"
                                    ng-repeat="lang in template_lang">Chinese (CHN)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="zh_HK"
                                    ng-repeat="lang in template_lang">Chinese (HKG)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="zh_TW"
                                    ng-repeat="lang in template_lang">Chinese (TAI)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="hr" ng-repeat="lang in template_lang">
                                    Croatian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="cs" ng-repeat="lang in template_lang">
                                    Czech</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="da" ng-repeat="lang in template_lang">
                                    Danish</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="nl" ng-repeat="lang in template_lang">
                                    Dutch</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="en_GB"
                                    ng-repeat="lang in template_lang">English (UK)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="et" ng-repeat="lang in template_lang">
                                    Estonian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="fil" ng-repeat="lang in template_lang">
                                    Filipino</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="fi" ng-repeat="lang in template_lang">
                                    Finnish</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="fr" ng-repeat="lang in template_lang">
                                    French</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="de" ng-repeat="lang in template_lang">
                                    German</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="el" ng-repeat="lang in template_lang">
                                    Greek</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="gu" ng-repeat="lang in template_lang">
                                    Gujarati</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ha" ng-repeat="lang in template_lang">
                                    Hausa</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="he" ng-repeat="lang in template_lang">
                                    Hebrew</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="hi" ng-repeat="lang in template_lang">
                                    Hindi</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="hu" ng-repeat="lang in template_lang">
                                    Hungarian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="id" ng-repeat="lang in template_lang">
                                    Indonesian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ga" ng-repeat="lang in template_lang">
                                    Irish</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="it" ng-repeat="lang in template_lang">
                                    Italian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ja" ng-repeat="lang in template_lang">
                                    Japanese</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="kn" ng-repeat="lang in template_lang">
                                    Kannada</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="kk" ng-repeat="lang in template_lang">
                                    Kazakh</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ko" ng-repeat="lang in template_lang">
                                    Korean</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="lo" ng-repeat="lang in template_lang">
                                    Lao</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="lv" ng-repeat="lang in template_lang">
                                    Latvian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="lt" ng-repeat="lang in template_lang">
                                    Lithuanian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="mk" ng-repeat="lang in template_lang">
                                    Macedonian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ms" ng-repeat="lang in template_lang">
                                    Malay</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ml" ng-repeat="lang in template_lang">
                                    Malayalam</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="mr" ng-repeat="lang in template_lang">
                                    Marathi</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="nb" ng-repeat="lang in template_lang">
                                    Norwegian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="fa" ng-repeat="lang in template_lang">
                                    Persian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="pl" ng-repeat="lang in template_lang">
                                    Polish</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="pt_BR"
                                    ng-repeat="lang in template_lang">Portuguese (BR)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="pt_PT"
                                    ng-repeat="lang in template_lang">Portuguese (POR)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="pa" ng-repeat="lang in template_lang">
                                    Punjabi</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ro" ng-repeat="lang in template_lang">
                                    Romanian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ru" ng-repeat="lang in template_lang">
                                    Russian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="sr" ng-repeat="lang in template_lang">
                                    Serbian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="sk" ng-repeat="lang in template_lang">
                                    Slovak</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="sl" ng-repeat="lang in template_lang">
                                    Slovenian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="es" ng-repeat="lang in template_lang">
                                    Spanish</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="es_AR"
                                    ng-repeat="lang in template_lang">Spanish (ARG)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="es_ES"
                                    ng-repeat="lang in template_lang">Spanish (SPA)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="es_MX"
                                    ng-repeat="lang in template_lang">Spanish (MEX)</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="sw" ng-repeat="lang in template_lang">
                                    Swahili</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="sv" ng-repeat="lang in template_lang">
                                    Swedish</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ta" ng-repeat="lang in template_lang">
                                    Tamil</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="te" ng-repeat="lang in template_lang">
                                    Telugu</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="th" ng-repeat="lang in template_lang">
                                    Thai</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="tr" ng-repeat="lang in template_lang">
                                    Turkish</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="uk" ng-repeat="lang in template_lang">
                                    Ukrainian</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="ur" ng-repeat="lang in template_lang">
                                    Urdu</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="uz" ng-repeat="lang in template_lang">
                                    Uzbek</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="vi" ng-repeat="lang in template_lang">
                                    Vietnamese</option>
                                <!-- end ngRepeat: lang in template_lang -->
                                <option class="fs-12 ng-binding ng-scope" value="zu" ng-repeat="lang in template_lang">
                                    Zulu</option>
                                <!-- end ngRepeat: lang in template_lang -->
                            </select>
                        </div>





                        <div class="col-12 mb-3">
                            <label for="form-memberships" class="main-label fw-medium">HEADER<sup
                                    class="validationn">*</sup></label>

                            <select class="form-control main-control header_div" id="header" name="header"
                                ng-model="selectedHeader" ng-change="handleHeaderChange()" required>
                                <option label="Please select your header type" value=""></option>
                                <option value="TEXT">TEXT</option>
                                <option value="IMAGE">IMAGE</option>
                                <option value="VIDEO">VIDEO</option>
                                <option value="DOCUMENT">DOCUMENT</option>
                            </select>
                        </div>

                        <textarea ng-if="selectedHeader === 'TEXT'"
                            class="full-width cwt-header-textarea-box font-size-12 center-textarea header_text"
                            ng-model="header_data" rows="3" cols="50" minlength="0" maxlength="60"
                            ng-change="header_text_media(header_data)"
                            placeholder="Type your header text here..."></textarea>


                        <div ng-if="selectedHeader === 'IMAGE' && provider === 'meta'"
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
                        </div>


                        <div class="col-12 mb-3">
                            <label for="form-memberships" class="main-label fw-medium">BODY<sup
                                    class="validationn">*</sup></label>
                            <textarea class="form-control main-control body_div" id="body_id"
                                placeholder="Type Your Body Text Here...{{|}}" name="" required></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="form-memberships" class="main-label fw-medium">FOOTER<sup
                                    class="validationn">*</sup></label>
                            <textarea class="form-control main-control footer_div" id="footer"
                                placeholder="Type Your Footer Text Here...{{|}}" name="" required></textarea>
                        </div>

                    </div>
                </div>
                <div class="col-6 hello">
                    <div class="modal-body-card justify-content-center">
                        <!-- whatsapp   .. -->
                        <div class="wa-preview-main-div-cont">
                            <div class="preview-chat-section">
                                <div class="preview-header-main-cont">
                                    <div class="header-image">
                                        <img class="profile-img ng-scope"
                                            ng-if="!company_photo || company_photo.length == 0"
                                            ng-src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png"
                                            alt="logo"
                                            src="https://custpostimages.s3.ap-south-1.amazonaws.com/885/206875.png"><!-- end ngIf: !company_photo || company_photo.length == 0 -->
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
                                        <div class="preview-header-paragraph" ng-if="submitParamDetails"
                                            class="ng-scope" style="">
                                            <div ng-if="media_footer_text.length > 0 "
                                                class="user-name-chat-header message msg  m-0 p-l-10 p-r-5 ng-binding ng-scope"
                                                contenteditable="false" style=""></div>
                                            <!-- end ngIf: media_footer_text.length > 0 -->

                                        </div>

                                        <div ng-if="final_bodyPreviewValue.length > 0"
                                            class="msg-text-chat message msg m-0 p-l-10 p-r-5 ng-scope"
                                            id="bodychange11">


                                        </div>

                                        <div class="preview-footer-paragraph p-1" ng-if="submitParamDetails"
                                            class="ng-scope" style="">
                                            <div ng-if="media_footer_text.length > 0 "
                                                class="user-name-chat-footer message msg font-size-12 m-0 p-l-10 p-r-5 ng-binding ng-scope"
                                                contenteditable="false" style=""></div>
                                            <!-- end ngIf: media_footer_text.length > 0 -->

                                        </div>


                                    </div>



                                </div>
                                <div class="preview-call-button ng-scope"
                                    ng-if="!edit_template &amp;&amp; !preview_open">
                                    <div class="preview-whatsapp-footer">
                                        <div class="whatsapp-footer">

                                            <i class="fa fa-smile-o whatsapp-footer-relative" aria-hidden="true"></i>
                                            <input class="chat-btn-chat whatsapp-footer-1" placeholder="Type a message"
                                                ng-disabled="true" aria-disabled="true" disabled="disabled">
                                            <i class="fa fa-paperclip whatsapp-footer-2" aria-hidden="true"></i>
                                            <i class="fa fa-camera whatsapp-footer-3" aria-hidden="true"></i>
                                            <p class="audio-icon-tem"><i class="fa fa-microphone icon-tem-micro"
                                                    aria-hidden="true"></i></p>
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
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('click','.menu-toggle',function() {
        $(this).addClass('bg-body-secondary');
        $(this).siblings('.menu-toggle').removeClass('bg-body-secondary');
    });
    $('body').on('click', '.Arro-pro', function() {
        $(this).closest('.first-container').toggleClass('slide-toggle');
        $('.first-container-text').toggle();
        $('.Arrowmovement').toggleClass("arrow-down");
    });    
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<?= $this->include('partials/footer') ?>