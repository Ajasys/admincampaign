<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<style>
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

    .btn_purple {
        border: 2px solid #724ebf;
        color: #724ebf;
    }

    .btn_purple:hover {
        background-color: #724ebf;
        color: white;
    }

    .accordion-button:not(.collapsed) {
        background-color: #724EBF;
        color: white;
    }

    .short-email {
        transition: all 0.5s;
        cursor: pointer;
    }

    .short-email:hover {
        background-color: #ebebeb;
    }

    .menu-toggle {
        cursor: pointer;
    }

    .chat-nav-search-bar {
        cursor: pointer;
    }

    .accordion-button:not(.collapsed)::after {
        display: none;
    }
</style>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Email Conversions</h2>
            </div>
        </div>
        <!-- WHATAPP EMAIL AND SMS BUTTTON NAV-BAR START ============================================================= -->
        <!-- <div class="p-2 bg-white rounded-2 mx-2 mb-2">
            <ul class="nav nav-pills navtab_primary_sm " id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn nav_btn active" id="customer_alert_tab" data-bs-toggle="pill"
                        data-bs-target="#customer_alert" data-table="emailtemplate" type="button" role="tab"
                        aria-controls="customer_alert" aria-selected="true">Email </button>
                </li>
            </ul> -->

        <!-- <div class="navigation col-12 overflow-auto my-2 product_tab">
                <ul class="d-flex navtab_primary_sm w-100 flex-xl-wrap flex-nowrap" id="status-main-tab">
                    
                            <li class="nav-item">
                                <button class="nav-link btn nav_btn active" id="customer_alert_tab" data-bs-toggle="pill"
                                data-bs-target="#customer_alert" data-table="emailtemplate" type="button" role="tab"
                                aria-controls="customer_alert" aria-selected="true">Email </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link btn nav_btn active" id="customer_alert_tab" data-bs-toggle="pill"
                                data-bs-target="#customer_alert" data-table="emailtemplate" type="button" role="tab"
                                aria-controls="customer_alert" aria-selected="true">Email Convertion</button>
                            </li>
                            
                            
                </ul>
            </div> -->
        <!-- </div> -->
        <!-- WHATAPP EMAIL AND SMS BUTTTON NAV-BAR START ============================================================= -->
        <!-- <div class="bg-white rounded-2 p-2 mb-2 border">
            <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link  active " id="inquiry_alert_tab" data-bs-toggle="pill"
                        data-bs-target="#inquiry_alert_main" type="button" role="tab" aria-controls="inquiry_alert_main"
                        aria-selected="false">Email Conversions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link">Email Templates</button>
                </li>
            </ul>
        </div> -->
        <div class="col-12  d-flex flex-wrap justify-content-sm-center justify-content-lg-start mt-2">
            <div class="first-container slide-toggle me-2">
                <div class="accordion  border" id="accordionExample">
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-0 shadow-none fw-medium  toggle-center" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                <p><i class="fa-solid fa-user fa-xl me-2"></i></p>
                                <P class="fs-14 fw-bolder first-container-text">aayushdave2312@gmail.com</P>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show px-4 py-3"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body account_list p-0">
                                <li
                                    class="menu-toggle bg-body-secondary col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1">
                                    <div class="col-12 d-flex">
                                        <p><i class="fa-solid fa-inbox"></i></p>
                                        <span class="ms-3 first-container-text viewdata ">Inbox</span>
                                    </div>
                                </li>
                                <li
                                    class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1">
                                    <div class="col-12 d-flex">
                                        <p><i class="fa-regular fa-star"></i></p>
                                        <span class="ms-3 first-container-text viewdata ">Starred</span>
                                    </div>
                                </li>
                                <li
                                    class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1">
                                    <div class="col-12 d-flex">
                                        <p><i class="fa-regular fa-clock"></i></p>
                                        <span class="ms-3 first-container-text viewdata ">Snoozed</span>
                                    </div>
                                </li>
                                <li
                                    class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1">
                                    <div class="col-12 d-flex">
                                        <p><i class="fa-regular fa-paper-plane"></i></p>
                                        <span class="ms-3 first-container-text viewdata ">Sent</span>
                                    </div>
                                </li>
                                <li
                                    class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1">
                                    <div class="col-12 d-flex">
                                        <p><i class="fa-solid fa-file"></i></p>
                                        <span class="ms-3 first-container-text viewdata ">Draft</span>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- backend-with design -->
                <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex flex-wrap">
                    <div class="col-12 d-flex flex-wrap w-100 ">
                        <ul class=" d-flex  flex-wrap nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle bg-body-secondary nav-item Tab1Class hide-panel2"
                                role="presentation">
                                <div id="inquiry_alert_tab"
                                    class="col-12 d-flex nav-link  active p-0 bg-transparent text-dark" DataStatus='1'
                                    data-bs-toggle="pill" data-bs-target="#inquiry_alert_main" type="button" role="tab"
                                    aria-controls="inquiry_alert_main" aria-selected="false">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0"
                                            y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="M256.064 0h-.128C114.784 0 0 114.816 0 256c0 56 18.048 107.904 48.736 150.048l-31.904 95.104 98.4-31.456C155.712 496.512 204 512 256.064 512 397.216 512 512 397.152 512 256S397.216 0 256.064 0z"
                                                    style="" fill="#724ebf" data-original="#4caf50" class=""
                                                    opacity="1">
                                                </path>
                                                <path
                                                    d="M405.024 361.504c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.616-127.456-112.576-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016.16 8.576.288 7.52.32 11.296.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744-3.776 4.352-7.36 7.68-11.136 12.352-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z"
                                                    style="" fill="#fafafa" data-original="#fafafa" class=""></path>
                                            </g>
                                        </svg>
                                    </p>
                                    <span class="ms-3 first-container-text">Send Template Messages</span>
                                </div>
                            </li>
                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel2"
                                role="presentation">
                                <div class="col-12 d-flex" id="user_alert_tab" data-bs-toggle="pill"
                                    data-bs-target="#user_alert_main" type="button" role="tab"
                                    aria-controls="user_alert_main" aria-selected="true">
                                    <p><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0"
                                            y="0" viewBox="0 0 512 512.001" style="enable-background:new 0 0 512 512"
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
                                    <span class="ms-3 first-container-text viewdata ">View Sent Template</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 mt-2 d-flex justify-content-end">
                        <div class="col-1 p-3 Arro-pro " style="cursor:pointer">
                        <i class="bi bi-arrow-left Arrowmovement text-primary fw-bold fs-5"></i>
                    </div>
                    </div>
                </div>
            </div>
            <!-- old-design-whith backend -->
            <div class="col-12 col-md">
                <div class="col-12 ps-1 d-none main-panel1">
                    <div class="tab-content p-0 " id="pills-tabContent">
                        <div class="tab-pane fade show active" id="inquiry_alert_main" role="tabpanel"
                            aria-labelledby="inquiry_alert_tab" tabindex="0">
                            <div class="">
                                <div
                                    class=" p-2 main-check-class bg-white rounded-3 border col-12 col-sm-8 col-md-12  mx-auto mx-md-0">
                                    <div class="bg-white rounded-2">

                                        <div class="overflow-x-scroll">

                                            <div class="title-2 ">
                                                <h2 style="background-color: #D8D7FF; font-size: 14px;"
                                                    class="p-2 rounded-1"><b>Email
                                                        Send List</b></h2>
                                            </div>
                                            <table id="myTable" class="table ">
                                                <thead>

                                                    <tr>
                                                        <th width="25%">Email</th>
                                                        <th width="40%">Subject</th>
                                                        <th width="10%">Status</th>
                                                        <th width="15%">Open Datetime</th>
                                                        <th width="10%">See Details</th>
                                                    </tr>
                                                </thead>


                                                <tbody id="demo_list_data">

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content P-0" id="pills-tabContent">
                        <div class="tab-pane fade " id="user_alert_main" role="tabpanel"
                            aria-labelledby="user_alert_tab" tabindex="0">
                            <div
                                class=" p-2 main-check-class bg-white p-2 rounded-3 border col-12 col-sm-8 col-md-12  mx-auto mx-md-0">
                                <div class="tab-content p-0" id="pills-tabContentS">
                                    <div class="tab-pane fade show active -whatapp" id="user_alert" role="tabpanel"
                                        aria-labelledby="user_alert_tab" tabindex="0">
                                        <div class="container-fluid p-0 main-check-class"></div>
                                    </div>
                                    <div class="tab-pane fade" id="inquiry_alert" role="tabpanel"
                                        aria-labelledby="inquiry_alert_tab" tabindex="0"></div>
                                    <div class="" id="customer_alert" role="tabpanel"
                                        aria-labelledby="customer_alert_tab" tabindex="0">
                                        <div class="container-fluid p-0 main-check-class">
                                            <div class="p-2">
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <div class="d-flex justify-content-end col-12">
                                                        <div data-delete_id="" class="deleted-all emailDbtn"
                                                            style="display: none;">
                                                            <span class="btn-primary-rounded">
                                                                <i class="bi bi-trash3 fs-14"></i>
                                                            </span>
                                                        </div>
                                                        <span
                                                            class="btn-primary-rounded changes_of_model changes_of_email_add ms-2"
                                                            data-bs-toggle="modal" data-bs-target="#add-email"
                                                            data-bs-dismiss="modal" data-delete_id="">
                                                            <i class="bi bi-plus"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-white rounded-2 mx-2 mb-2">
                                                <table id="email_table"
                                                    class="email-tamplate comman_list_data_table w-100 table main-table">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input class="select-all-sms check_box emailQuery"
                                                                    type="checkbox" id="select-all-sms">
                                                            </th>
                                                            <th>
                                                                <span class="">Email Details</span>
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="email_list" class="email_list_comman"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap main-panel2">
                    <div class="col-5 col-sm-7 col-md-6 col-lg-3 col-xl-3 col-xxl-3 chat-box rounded-3 overflow-hidden"
                        style="height:80vh">
                        <div class="col-12 border  bg-white position-relative" style="height:80vh">
                            <h2 class="accordion-header">
                                <button class="accordion-button border-0 shadow-none fw-medium p-3" type="button">
                                    <i class="fa-solid fa-envelope fa-xl me-2"></i>
                                    <p>Emails</p>
                                </button>
                            </h2>
                            <div class="col-12 overflow-y-scroll scroll-sm chat_list p-1" style="max-height: 100%;">
                                <div
                                    class="menu-toggle fw-semibold fs-12 chat-nav-search-bar  col-12 chat-account-box  chat_list border rounded-3 py-2">
                                    <div class="d-flex flex justify-content-between align-items-center col-12">
                                        <div class="col-2">
                                            <svg class="w-100" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0"
                                                y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512"
                                                xml:space="preserve">
                                                <g>
                                                    <g data-name="Layer 2">
                                                        <g data-name="01.facebook">
                                                            <circle cx="88" cy="88" r="88" fill="#3a559f" opacity="1"
                                                                data-original="#3a559f"></circle>
                                                            <path fill="#ffffff"
                                                                d="m115.88 77.58-1.77 15.33a2.87 2.87 0 0 1-2.82 2.57h-16l-.08 45.45a2.05 2.05 0 0 1-2 2.07H77a2 2 0 0 1-2-2.08V95.48H63a2.87 2.87 0 0 1-2.84-2.9l-.06-15.33a2.88 2.88 0 0 1 2.84-2.92H75v-14.8C75 42.35 85.2 33 100.16 33h12.26a2.88 2.88 0 0 1 2.85 2.92v12.9a2.88 2.88 0 0 1-2.85 2.92h-7.52c-8.13 0-9.71 4-9.71 9.78v12.81h17.87a2.88 2.88 0 0 1 2.82 3.25z"
                                                                opacity="1" data-original="#ffffff"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="col-10 d-flex flex-wrap justify-content-between align-items-center">
                                            <p class="col-12 ps-2" style="font-size:16px;">Kaddy Patel</p>
                                            <p class="col-10 ps-2 d-flex fs-12 text-secondary-emphasis"><span
                                                    class="text-truncate">hi</span> <span class="col-3 ms-2">5 H</span> </p>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="m-auto  text-center">
                                <span>Loading...</span>
                                <div class="mx-auto chat_loader"></div>
                            </div> -->
                            <!-- <div class="col-12 overflow-y-scroll chat_list p-2" style="max-height: 100%;">
                                <div class="col-12 text-center">
                                    <p class="fs-5 fw-medium mt-5">No Record Found</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="ms-7 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7 col-xxl transcript_box rounded-4 overflow-hidden"
                        style="height:80vh">
                        <div class="col-12 border rounded-end-4 bg-white position-relative" style="height:80vh">
                            <div class="justify-content-center col-12 position-absolute bottom-0 start-0 mb-2 px-3">
                                <div class="d-flex bg-white rounded-pill py-1 border">
                                    <div class="d-flex col-12 align-items-center">
                                        <!-- <div class="ps-2">
                                        <button class="btn btn-primary btn_x rounded-5 border">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div> -->
                                        <div class="input-group  position-relative ">
                                            <input type="text"
                                                class="form-control border rounded-pill px-4 py-2 border-0 massage_input"
                                                placeholder="Write a message...">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button
                                                class="btn btn-primary rounded-circle me-1 SendWhatsAppMessage send_massage"
                                                data-conversion_id="" data-page_token="" data-page_id="" data-massage_id="">
                                                <i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $(".btn_x").click(function () {
                                        $(".accordion_item_div").toggle();
                                    });
                                });
                            </script>
                            <div class="col-12">
                                <div class="accordion-header d-flex flex-wrap">
                                    <div class="accordion-button border-0 shadow-none fw-medium p-3 d-flex justify-content-between"
                                        type="button">
                                        <div class="col-6 d-flex align-items-center">
                                            <i class="fa-solid fa-circle-user fs-3 me-2"></i>
                                            <span class="d-flex flex-wrap">
                                                <span class="username col-12 d-block UserChatName">User Name</span>
                                                <span class="in_chat_page_name fs-12 col-12 d-block"></span>
                                            </span>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <button class="bg-transparent border-0" id="booklist">
                                                <i class="fa-regular fa-star text-white "></i>
                                                <i class="fa-solid fa-star d-none text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class=" d-flex justify-content-between border-bottom align-items-center">
                                    <h5 class="fs-5 d-flex ps-2 pb-2 align-items-center">
                                        
                                    </h5>
                                </div> -->
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
                        <div class="m-auto massage_list_loader text-center position-absolute top-0 end-0 bottom-0 start-0"
                            style="display: none;">
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center" style="z-index:555">
                                <div>
                                    <span>Loading...</span>
                                    <div class="mx-auto chat_loader"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center col-12 overflow-y-scroll p-3 noRecourdFound">No Chats Found!</div>
                        <div class="col-12 overflow-y-scroll p-2 noRecourdFound" style="max-height: 100%;">
                            <div class="col-12 text-center">
                                <p class="fs-5 fw-medium mt-5 d-block">No Record Found</p>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
            <!-- <div class="col-4 bg-white border rounded-3 mx-2 rounded-3 overflow-hidden">
                <div class="col-12">
                    <h2 class="accordion-header">
                        <button class="accordion-button border-0 shadow-none fw-medium p-3" type="button">
                            <i class="fa-solid fa-envelope fa-xl me-2"></i>
                            <p>Emails</p>
                        </button>
                    </h2>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col bg-white border rounded-3 mx-2 rounded-3 overflow-hidden">
                <div class="col-12">
                    <h2 class="accordion-header">
                        <button class="accordion-button border-0 shadow-none fw-medium p-3" type="button">
                            <i class="fa-solid fa-envelope fa-xl me-2"></i>
                            <p>Emails</p>
                        </button>
                    </h2>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap p-1 justify-content-between border-bottom px-2 short-email">
                    <div class="col-3 d-flex align-items-center">
                        <input type="checkbox" id="scales" name="scales"/>
                        <span class="mx-2">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <span class="fs-12 col text-truncate overflow-hidden fw-bold">
                            Lorem ipsum dolor sit amet.
                        </span>

                    </div>
                    <div class="col-6 fs-12 fw-bold d-flex align-items-center">
                        <span class="text-truncate overflow-hidden ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, obcaecati.
                        </span>
                    </div>
                    <div class="col-2 fs-12 fw-bold text-muted d-flex align-items-center justify-content-end">
                        <span class="text-truncate overflow-hidden ">
                            1:58PM
                        </span>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="add-sms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add SMS</h1>
                <button type="button" class="btn-close close_btn close_btn_sms" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation smstemplate_form d-flex flex-wrap" name="smstemplate_form" novalidate>
                    <div class="input-text col-12 px-1">
                        <label for="form-Occupation" class="form-label main-label investor">Title <sup
                                class="validationn">*</sup></label>
                        <input type="text" class="form-control main-control sms-title" id="title"
                            placeholder="Enter Title" required="">
                    </div>

                    <div class="input-text mt-2 col-12">
                        <div class="d-flex justify-content-between align-items-end">
                            <label for="form-code" class="form-label main-label ">Template <sup
                                    class="validationn">*</sup></label>
                            <!-- <div class="col-md-6 col-12"> -->
                            <div class="dropdown">
                                <button class="btn-primary-rounded" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <div class="dropdown-menu p-2 dropdown-menu-end" style="width: 300px;">
                                    <div class="main-selectpicker w-100">
                                        <select name="" id="action_name" id="bulk-action"
                                            class="selectpicker form-control form-main smstemplate_select_lable_div"
                                            data-live-search="true" required="">
                                            <option value="" class="select_sms">Select Lable</option>
                                            <option value="Enquirer Full Name" class="select_sms_diif">Enquirer Full
                                                Name
                                            </option>
                                            <option value="Enquirer Date of Birth" class="select_sms_diif">Enquirer
                                                Date of
                                                Birth</option>
                                            <option value="Enquirer Anniversary Date" class="select_sms_diif">
                                                Enquirer
                                                Anniversary Date</option>
                                            <option value="Enquirer Mobile Number" class="select_sms_diif">Enquirer
                                                Mobile
                                                Number</option>
                                            <option value="Enquirer Email" class="select_sms_diif">Enquirer Email
                                            </option>
                                            <option value="Enquirer Property Type" class="select_sms_diif">Enquirer
                                                Property
                                                Type</option>
                                            <option value="Staff Full Name" class="select_sms_diif">Staff Full
                                                Name
                                            </option>
                                            <option value="Staff Date of Birth" class="select_sms_diif">Staff
                                                Date of
                                                Birth</option>
                                            <option value="Staff Anniversary Date" class="select_sms_diif">
                                                Staff
                                                Anniversary Date</option>
                                            <option value="Staff Mobile Number" class="select_sms_diif">Staff
                                                Mobile
                                                Number</option>
                                            <option value="Customer Name" class="select_sms_diif">Customer Name
                                            </option>
                                            <option value="Customer Mobile Number" class="select_sms_diif">Customer
                                                Mobile
                                                Number</option>
                                            <option value="Customer Date of Birth" class="select_sms_diif">Customer
                                                Date of
                                                Birth</option>
                                            <option value="Customer Anniversary Date" class="select_sms_diif">
                                                Customer
                                                Anniversary Date</option>

                                            <option value="Supplier Full Name" class="select_sms_diif">Supplier Full
                                                Name
                                            </option>
                                            <option value="Supplier Date of Birth" class="select_sms_diif">Supplier
                                                Date of
                                                Birth</option>
                                            <option value="Supplier Anniversary Date" class="select_sms_diif">
                                                Supplier
                                                Anniversary Date</option>
                                            <option value="Supplier Mobile Number" class="select_sms_diif">Supplier
                                                Mobile
                                                Number</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="position-relative p-1">
                            <textarea id="template" placeholder="Enter Template" name="template" rows="4" cols="50"
                                class="dataTable-filter form-control main-control sms-template" required=""
                                maxlength="600"></textarea>
                            <div id="contant" class="position-absolute bottom-0 end-0 me-2 text-body-tertiary">160
                            </div>
                        </div>
                        <div class="input-text col-12 px-1">
                            <label for="form-Occupation" class="form-label main-label investor">Template Id <sup
                                    class="validationn">*</sup></label>
                            <input type="text" min="0" minlength="19" maxlength="19"
                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                class="form-control main-control template_id" id="template_id"
                                placeholder="Enter Template Id" name="template_id" required>
                            <p class="mt-2 text-danger">Note : The Template Id is Equal to 19 digit</p>
                        </div>
                        <div id="counter"></div>
                        <div id="count"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary smstemplate_add" data-edit_id=""
                    id="smstemplate_add">submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sms_template_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">SMS Template</h1>
                <button type="button" class="btn-close close_btn close_btn_s" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form class="needs-validation" name="membership_update_form" novalidate>
                <div class="modal-body">
                    <div class="profile-main pb-2">
                        <h6>Title : <span class="fs-6 text-secondary-emphasis" id="title_view"></span></h6>
                    </div>
                    <div class="profile-main">
                        <h6>Template: <span class="fs-6 text-secondary-emphasis" id="temp_view"></span></h6>
                    </div>
                    <div class="profile-main pb-2">
                        <h6>Template ID: <span class="fs-6 text-secondary-emphasis" id="temp_id_view"></span></h6>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <span class="btn-primary edt sms_pencil_btn" data-edit_id="" data-bs-toggle="modal"
                    data-bs-target="#add-sms"><i class="fas fa-pencil-alt"></i></span>
                <div class="delete_main changesofdelete_btn">
                    <div class="delete_btn_1 btn-primary w-100 text-center cursor-pointer" style="right: 0%;">Delete
                    </div>
                    <div class="btn-secondary px-3 cursor-pointer dlt btn-del Comman_delete" id="sms_delete"
                        data-delete_id="">Really ?</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade data_add_div" id="add-email" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title email_title_model_change">Add Email</h1>
                <button type="button" class="btn-close close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-secondery">
                <form class="needs-validation add_form_Email" id="add_form_Email" name="add_form_Email" novalidate>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="flex-fill  px-0 px-sm-1">
                            <h2 class="modal-body-title">Title<sup class="validationn">*</sup></h2>
                            <input type="text" class="form-control main-control email_whatapp_title add_model_title"
                                id="title" name="title" placeholder="Enter Title" required=''>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between my-2">
                        <h2 class="modal-body-title">Template<sup class="validationn">*</sup></h2>
                        <div class="px-0 px-sm-1">
                            <div class="dropdown">
                                <button class="btn-primary-rounded" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <div class="dropdown-menu p-2 dropdown-menu-end" style="width: 300px;">
                                    <div class="main-selectpicker">
                                        <select class="selectpicker form-control form-main template_select_lable_div"
                                            data-live-search="true" required="">
                                            <option value="" class="select_wne">Select Lable</option>
                                            <option value="Enquirer Full Name" class="select_wne_diff">Enquirer Full
                                                Name
                                            </option>
                                            <option value="Enquirer Date of Birth" class="select_wne_diff">Enquirer Date
                                                of
                                                Birth</option>
                                            <option value="Enquirer Anniversary Date" class="select_wne_diff">Enquirer
                                                Anniversary Date</option>
                                            <option value="Enquirer Mobile Number" class="select_wne_diff">Enquirer
                                                Mobile
                                                Number</option>
                                            <option value="Enquirer Email" class="select_wne_diff">Enquirer Email
                                            </option>
                                            <option value="Customer Name" class="select_wne_diff">Customer Name</option>
                                            <option value="Customer Mobile Number" class="select_wne_diff">Customer
                                                Mobile
                                                Number</option>
                                            <option value="Customer Date of Birth" class="select_wne_diff">Customer Date
                                                of
                                                Birth</option>
                                            <option value="Customer Anniversary Date" class="select_wne_diff">Customer
                                                Anniversary Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="editor_add" class="Email_Add_Ckeditor" style="border:1px solid red"></div>
                    <div class="col-12 input-text">
                        <h2 class="modal-body-title">Attachment</h2>
                        <div class="file_view_add1 file_view_add_Email  file_view_add_Email_add" id="file_view_add1">
                        </div>
                        <div class="file_view file_view_edit file_view_edit_add" id="file_view">
                        </div>
                        <div id="file_uploded" class="file_uploded file_uploded_edit file_uploded_edit_add"> </div>
                    </div>
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
                            id="attachment" name="attachment[]" multiple type="file" placeholder="" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary email_add_model_submit" data-edit_id=""
                    id="save_btn_email">submit</button>
                <div class="delete_main changesofdelete_btn">
                    <div class="delete_btn_1 btn-primary w-100 text-center cursor-pointer" style="right: 0%;">Delete
                    </div>
                    <div class="btn-secondary px-3 cursor-pointer dlt Comman_delete" data-delete_id=""
                        id="email_delete">Really ?</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <input type="text" hidden value="whatsapp_template" class="table_value_picker" id="table_value_picker"/> -->
<input type="text" hidden data-delete_id="" id="emailtemplate" />
<input type="text" hidden data-delete_id="" id="smstemplate" />
<input type="text" hidden data-delete_id="" id="whatsapp_template" />

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('.template_select_lable_div').on('change', function () {
        var selec_option = $(this).val();
        if (selec_option != "") {
            var selec_option_arr = "{{" + selec_option + "}}";
            var className = '.Email_Add_Ckeditor';
            if (editors[className]) {
                var editorContent = editors[className].getData();
                var newContent = editorContent + selec_option_arr;
                editors[className].setData(newContent);
                $('.select_wne').trigger('click');
            }
        }
    });
    $('body').on('click', '.select_sms_diif', function () {
        $('.select_wne').trigger('click');
    });


    $('.smstemplate_select_lable_div').on('change', function () {
        var selec_option = $(this).val();
        if (selec_option != "") {
            var selec_option_arr = "{{" + selec_option + "}}";
            $('.sms-template').val(function (index, currentValue) {
                return currentValue + ' ' + selec_option_arr;
                $('.select_sms').trigger('click');
            });
        }
    });

    $('body').on('click', '.select_sms_diif', function () {
        $('.select_sms').trigger('click');
    });
</script>
<!-- checkbox for sms/whatapp/email end =======================================================-->
<script>
    //<!-- SMS/WhatApp/Email Table Name Get Jquery Start =================================================================== -->
    const buttons = document.querySelectorAll(".nav-link");
    buttons.forEach(button => {
        button.addEventListener("click", function () {
            buttons.forEach(btn => {
                btn.classList.remove("active");
            });
            button.classList.add("active");
            if (button.id === "user_alert_tab") {
                var table_name = $(this).attr("data-table");
                $("#table_value_picker").val(table_name);
            } else if (button.id === "inquiry_alert_tab") {
                var table_name = $(this).attr("data-table");
                $("#table_value_picker").val(table_name);
            } else if (button.id === "customer_alert_tab") {
                var table_name = $(this).attr("data-table");
                $("#table_value_picker").val(table_name);
            }
        });
    });
    //<!-- SMS/WhatApp/Email Table Name Get Jquery End ===================================================================== -->

    // <!-- CK-Editor For WhatApp And Email Start =========================================================================== -->
    var classNames = ['.Email_Add_Ckeditor'];
    var editors = {};

    classNames.forEach(function (className) {
        ClassicEditor
            .create(document.querySelector(className), {
                toolbar: {
                    items: [
                        'undo',
                        'redo',
                        '|',
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'Blockquote',
                        'outdent',
                        'indent',
                        '|',
                    ],
                    shouldNotGroupWhenFull: false
                },
                language: 'en',
                placeholder: 'Enter Template'
            })
            .then(instance => {
                editors[className] = instance;
            })
            .catch(error => {
                console.error(error);
            });
    });



    function checkEditorContent(editor) {
        const editorContent = editor.getData();
        const editorElement = editor.ui.getEditableElement();
        if (!editorContent.trim()) {
            editorElement.style.border = '1px solid red';
            editorElement.style.backgroundImage = `url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/></svg>")`;
            editorElement.style.backgroundPosition = 'bottom right';
            editorElement.style.backgroundRepeat = 'no-repeat';
            editorElement.style.backgroundSize = '20px 20px';
            editorElement.style.backgroundMargin = '10px';
        } else {
            editorElement.style.border = '1px solid #ccc';
            editorElement.style.backgroundImage = 'none';
        }
    }


    //<!-- CK-Editor For WhatApp And Email End ============================================================================= -->
    //<!-- SMS Template Model JQUERY Changes Start ========================================================================= -->
    $('body').on('click', '.sms_plus_button', function () {
        const $counter_contant = $('.smstemplate_add');
        $counter_contant.text(`ADD`);
        const $counter_contant1 = $('#exampleModalLabel');
        $counter_contant1.text(`Add SMS Template`);
        $(".smstemplate_form")[0].reset();
        $(".smstemplate_add").attr("data-edit_id", "");
        $('#contant').text("160");
        $('.smstemplate_select_lable_div').selectpicker('refresh');
    });
    $(document).ready(function () {
        const maxLength = 160;
        const maxLength2 = 1600;
        const $count = $('#count');
        const $smsTextarea = $('#template');
        const $counter = $('#counter');
        const $counter_contant = $('#contant');
        $smsTextarea.on('input', function () {
            const text = $smsTextarea.val();
            const textLength = text.length;
            let remainingChars = maxLength - (textLength % maxLength);
            let countchar = textLength;
            if (countchar == 0) {
                $counter_contant.text(`160`);
            } else if (countchar <= 160 && countchar >= 0) {
                $counter_contant.text(`${remainingChars}`);
            } else if (countchar >= 161 && countchar <= 320) {
                $counter_contant.text(`${remainingChars} (2)`);
            } else if (countchar >= 321 && countchar <= 480) {
                $counter_contant.text(`${remainingChars} (3)`);
            } else if (countchar >= 481 && countchar <= 640) {
                $counter_contant.text(`${remainingChars} (4)`);
            } else {
                $counter_contant.text(`Template is not add more contant`);
            }
            if (remainingChars === maxLength) {
                remainingChars = 0;
            }
        });
    });
    //<!-- SMS Template Model JQUERY Changes End =========================================================================== -->
    //<!-- Email/WhatApp Template Model JQUERY Changes Start =============================================================== -->
    $('body').on('click', '.changes_of_model', function () {
        setTimeout(function () {
            $('.template_select_lable_div').selectpicker('refresh');
        }, 100);
        var table = $(".table_value_picker").val();
        // if (table == "whatsapp_template") {
        //     const $counter_contant = $('.email_title_model_change');
        //     $counter_contant.text(`Add Whatsapp Template`);
        // } else {
        const $counter_contant = $('.email_title_model_change');
        $counter_contant.text(`Add Email Template`);
        // }
        $('.file_view_edit_add').hide();
        $('.file_uploded_edit_add').hide();
        $('.changesofdelete_btn').hide();
        $('.file_view_add_Email_add').show();
        $('.u_btn_Email').remove();
        $(".add_form_Email")[0].reset();
        $(".email_add_model_submit").attr("data-edit_id", "");
        const $counter_contant1 = $('.email_add_model_submit');
        $counter_contant1.text(`Submit`);
    });
    $('body').on('click', '.edit_email_t_changes_email', function () {
        setTimeout(function () {
            $('.template_select_lable_div').selectpicker('refresh');
        }, 500);
        var table = $(".table_value_picker").val();
        // if (table == "whatsapp_template") {
        //     const $counter_contant = $('.email_title_model_change');
        //     $counter_contant.text(`Edit Whatsapp Template`);
        // } else {
        const $counter_contant = $('.email_title_model_change');
        $counter_contant.text(`Edit Email Template`);
        // }
        $('.u_btn_Email').remove();
        $('.file_view_edit_add').show();
        $('.file_uploded_edit_add').show();
        $('.file_view_add_Email_add').hide();
        $('.changesofdelete_btn').show();
        const $counter_contant1 = $('.email_add_model_submit');
        $counter_contant1.text(`Update`);
    });
    //<!-- Email/WhatApp Template Model JQUERY Changes End ================================================================= -->

    //<!-- SMS Template AJAX Start ========================================================================================= -->
    $(document).ready(function () {
        // SMS INSERT/UPDATE Code Start =============================================>
        $('body').on('click', '#smstemplate_add', function (e) {
            var form = $("form[name='smstemplate_form']")[0];
            var title = $('.sms-title').val();
            var template = $('.sms-template').val();
            var template_id = $('.template_id').val();
            var edit_id = $('#smstemplate_add').attr("data-edit_id");
            if (title != "" && template != "" && template_id.length == 19) {
                var form = $('form[name="smstemplate_form"]')[0];
                const $counter_contant = $('#contant');
                var formdata = new FormData(form);
                formdata.append('table', 'smstemplate');
                formdata.append('title', title);
                formdata.append('action', 'insert');
                if (edit_id == '') {
                    $.ajax({
                        method: "post",
                        url: "<?= site_url('insert_data_t'); ?>",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            $counter_contant.text(`160`);
                            if (res != "error") {
                                // $("form[name='smstemplate_form']")[0].reset();
                                $(".modal-close-btn").trigger("click");
                                $("form[name='smstemplate_form']").removeClass("was-validated");
                                iziToast.success({
                                    title: 'Added Successfully'
                                });
                                $('.selectpicker').selectpicker('refresh');
                            } else {
                                $("form[name='smstemplate_form']")[0].reset();
                                iziToast.error1({
                                    title: 'Duplicate data'
                                });
                                $("form[name='smstemplate_form']").addClass("was-validated");
                            }
                            // $(".close_btn_sms").trigger("click");
                        },
                    });
                } else {
                    var formdata = new FormData(form);
                    formdata.append('action', 'update');
                    formdata.append('title', title);
                    formdata.append('edit_id', edit_id);
                    formdata.append('table', 'smstemplate');
                    $('.loader').hide();
                    $.ajax({
                        method: "post",
                        url: "<?= site_url('update_data_t'); ?>",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res != "error") {
                                $("form[name='smstemplate_form']")[0].reset();
                                $("form[name='smstemplate_form']").removeClass("was-validated");
                                $(".close_btn").trigger("click");
                                iziToast.success({
                                    title: 'update Successfully'
                                });
                            } else {
                                $("form[name='smstemplate_form']")[0].reset();
                                iziToast.error1({
                                    title: 'Duplicate data'
                                });
                            }
                            $(".close_btn_sms").trigger("click");
                        },
                    });
                }
            } else {
                $("form[name='smstemplate_form']").addClass("was-validated");
            }
        });
        // SMS INSERT/UPDATE Code End   =============================================>
        // SMS View Code Start   ====================================================>
        $('body').on('click', '.sms_template_view', function (e) {
            e.preventDefault();
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-view_id");
            var table = '<?php echo $table_username . '_smstemplate'; ?>';
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('sms_template_view'); ?>",
                    data: {
                        action: 'view',
                        view_id: edit_value,
                        table: table
                    },
                    success: function (res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        $('.edt').attr('data-edit_id', response[0].id);
                        $('.btn-del').attr('data-delete_id', response[0].id);
                        $('#sms_template_view #title_view').text(response[0].title);
                        $('#sms_template_view #temp_view').text(response[0].template);
                        $('#sms_template_view #temp_id_view').text(response[0].template_id);
                        $('.selectpicker').selectpicker('refresh');
                    },
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });
        // SMS View Code End   ======================================================>
        // SMS Edit Data Code Start   ===============================================>
        $("body").on('click', '.edit_sms_div', function (e) {
            e.preventDefault();
            //jquery change start ================>
            const $counter_contant = $('#smstemplate_add');
            $counter_contant.text(`UPDATE`);
            const $counter_contant1 = $('#exampleModalLabel');
            $counter_contant1.text(`Edit SMS Template`);
            $('#contant').text("");
            //jquery change end ==================>      
            var edit_value = $(this).attr("data_edit_id");
            if (edit_value != "") {
                $('.loader').hide();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('edit_data_t'); ?>",
                    data: {
                        action: 'edit',
                        edit_id: edit_value,
                        table: 'smstemplate'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        setTimeout(function () {
                            $(".sms-title").val(response[0].title);
                            $(".sms-template").val(response[0].template);
                            $('#smstemplate_add').attr('data-edit_id', response[0].id);
                            $(".template_id").val(response[0].template_id);
                            // $('#deleted-all').attr('data-delete_id', response[0].id);
                            $('.btn-del').attr('data-delete_id', response[0].id);
                            $('#smstemplate').attr('data-delete_id', response[0].id);
                            // $('.selectpicker').selectpicker('refresh');
                        }, 100);
                    },
                    error: function (error) {
                        $('.loader').hide();
                    }
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });
        // SMS Edit Data Code End   =================================================>
    });
    //<!-- SMS Template AJAX End   ========================================================================================= -->
    //<!-- WhatApp/Email Template AJAX Start   ============================================================================= -->
    $(document).ready(function () {
        // Email/WhatApp JQUERY CHANGES Code Start   ========================================>
        $('.attachment_email_text').on('change', function () {
            var files = $(this).prop('files');
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;
                $('.file_view_add_Email').append('<div id="u_btn" class="col-12 u_btn_Email m-1 rounded view-file-link px-2 d-flex u_btn"><p>' + fileName + '</p><span class="ms-auto" id="file_crodd_btn_email"><i class="bi bi-x-circle"></i></span></div>')
            }
        });

        $('body').on('click', '#file_crodd_btn_email', function () {
            $(this).closest('div').remove();
        });

        $('body').on('click', '.changes_of_email_add', function () {
            var className = '.Email_Add_Ckeditor';
            if (editors[className]) {
                var editor = editors[className];
                editor.setData('');
                var editorElement = editor.ui.getEditableElement();
                editorElement.style.border = '1px solid #ccc';
                editorElement.style.backgroundImage = 'none';
            }
            $(".add_form_Email").removeClass("was-validated");
        });

        $("#image_Email").change(function () {
            for (i = 0; i < this.files.length; i++) {
                var file = this.files[i];
                var fileType = file.type;
                $("#file").val('');
            }
        });

        $('.update_attachment_email').on('change', function () {
            var files = $(this).prop('files');
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;
                $('.file_uploded_edit').append('<div id="u_btn" class="col-12 file_te m-1 rounded view-file-link px-2 d-flex u_btn"><p>' + fileName + '</p><span class="ms-auto" id="file_crodd_btn1"><i class="bi bi-x-circle"></i></span></div>')
            }
        });
        // Email/WhatApp JQUERY CHANGES Code End   ==========================================>

        // Email/WhatApp EDIT DATA Code Start   =============================================>
        $('body').on('click', '.edit_email_t', function () {
            var className = '.Email_Add_Ckeditor';
            if (editors[className]) {
                var editor = editors[className];
                var editorElement = editor.ui.getEditableElement();
                editorElement.style.border = '1px solid #ccc';
                editorElement.style.backgroundImage = 'none';
            }
            $(".add_form_Email").removeClass("was-validated");
            var edit_id = $(this).attr("data-edit_id");
            var table_name = $(this).attr("data_table");
            $('.controller_ubtn').remove();
            $('.file_te').remove();
            $.ajax({
                method: "POST",
                url: 'edit_data_t',
                data: {
                    edit_id: edit_id,
                    table: table_name,
                    action: 'edit'
                },
                success: function (data) {
                    var response = JSON.parse(data);
                    var img_name = response[0].attachment;
                    var new_data = response[0].template;
                    if (editors[className]) {
                        editors[className].setData(new_data);
                    }
                    $("#image_Email").attr('src', img_name);
                    $("#image_Email").val(response[0].attachment);
                    $(".add_model_title").val(response[0].title);
                    $(".file_view_edit").html(response.file_html);
                    $('.email_add_model_submit').attr('data-edit_id', response[0].id);
                    $('#emailtemplate').attr('data-delete_id', response[0].id);
                    $('#whatsapp_template').attr('data-delete_id', response[0].id);
                }
            });
        });
        // Email/WhatApp EDIT DATA Code End     =============================================>

        // Email/WhatApp INSERT/UPDATE DATA Code Start   ====================================>
        $('body').on('click', '.email_add_model_submit', function (e) {
            e.preventDefault();
            var edit_id = $(this).attr("data-edit_id");
            if (edit_id == "") {
                var table = $(".table_value_picker").val();
                var form = $("form[name='add_form_Email']")[0];
                var formData = new FormData(form);
                var pText_add = "";
                var templateck = $('#add-email .ck-content').html();
                var editor = editors['.Email_Add_Ckeditor'];
                if (editor) {
                    var htmlContent = editor.getData();
                }
                $(".u_btn_Email p").each(function () {
                    pText_add += $(this).text().trim() + ",";
                });
                var title = $(".email_whatapp_title").val();
                pText_add = pText_add.slice(0, -1);
                if (title != "" && htmlContent != "") {
                    formData.append('table', 'emailtemplate');
                    formData.append('attachment', pText_add);
                    formData.append('template', htmlContent);
                    formData.append('action', 'insert');
                    $.ajax({
                        type: 'POST',
                        url: 'insert_data_t',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('.u_btn_Email').remove();
                            iziToast.success({
                                title: 'Successfully added'
                            });
                            $(".close_btn").trigger("click");
                        }
                    });
                } else {
                    checkEditorContent(editor);
                    editor.model.document.on('change:data', () => {
                        checkEditorContent(editor);
                    });
                    editor.ui.focusTracker.on('change:isFocused', (evt, name, isFocused) => {
                        if (!isFocused) {
                            checkEditorContent(editor);
                        }
                    });
                    $(".add_form_Email").addClass("was-validated");
                }
            } else {
                var pText = "";
                $(".file_view_edit_add p").each(function () {
                    pText += $(this).text().trim() + ",";
                });
                pText = pText.slice(0, -1);
                var pText_add = "";
                $(".file_uploded_edit_add p").each(function () {
                    pText_add += $(this).text().trim() + ",";
                });
                pText_add = pText_add.slice(0, -1);
                var update_id = $(this).attr("data-edit_id");
                var title = $('.add_model_title').val();
                var attachment = $('.update_attachment_email').val();
                var templateckk = $('#add-email .ck-content').html();
                var table = $(".table_value_picker").val();
                var editor = editors['.Email_Add_Ckeditor'];
                if (editor) {
                    var htmlContent = editor.getData();
                }
                var string = "";
                if (pText_add == "") {
                    string = pText;
                } else if (pText == "") {
                    string = pText_add;
                } else if (pText_add == "" && pText == "") {
                    string = "";
                } else {
                    string = pText_add + "," + pText;
                }
                if (title != "" && htmlContent != "") {
                    if (update_id != "") {
                        var form = $("#add_form_Email")[0];
                        var formdata = new FormData(form);
                        formdata.append('action', 'update');
                        formdata.append('edit_id', update_id);
                        formdata.append('title', title);
                        formdata.append('template', template);
                        formdata.append('attachment', string);
                        formdata.append('template', templateckk);
                        formdata.append('table', 'emailtemplate');
                        $.ajax({
                            method: "post",
                            url: "update_data_t",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (res) {
                                $('.u_btn').remove();
                                iziToast.success({
                                    title: 'Successfully Updated'
                                });
                                $(".close_btn").trigger("click");
                            }
                        });
                    }
                } else {
                    checkEditorContent(editor);
                    editor.model.document.on('change:data', () => {
                        checkEditorContent(editor);
                    });
                    editor.ui.focusTracker.on('change:isFocused', (evt, name, isFocused) => {
                        if (!isFocused) {
                            checkEditorContent(editor);
                        }
                    });
                    $(".add_form_Email").addClass("was-validated");
                }
            }
        });
        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
        $("#attachment").change(function () {
            for (i = 0; i < this.files.length; i++) {
                var file = this.files[i];
                var fileType = file.type;
                if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
                    $("#file").val('');
                    return false;
                }
            }
        });
        // Email/WhatApp INSERT/UPDATE DATA Code End   ======================================>
    });
    //<!-- WhatApp/Email Template AJAX End   =============================================================================== -->
    //<!-- WhatApp/Email/SMS listdata AJAX Start   ========================================================================= -->
    // function datatable_view_email(html) {
    //     $('.comman_list_data_table').DataTable().destroy();
    //     $('.email_list_comman').html(html);
    //     var table1 = $('.comman_list_data_table').DataTable({
    //         lengthChange: true,
    //     });
    // }
    function list_data_t() {
        $('.loader').show();
        show_val = '<?= json_encode(array('title', 'template')); ?>';
        var table = $(".table_value_picker").val();
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('template_list_data'); ?>",
            data: {
                'table': 'emailtemplate',
                'show_array': show_val,
                'action': true
            },
            success: function (res) {
                var response = JSON.parse(res);
                // datatable_view_email(response.html);
                $('#email_list').html(response.html);
                $('.loader').hide();
            }
        });
    }
    list_data_t();

    //listdata on click event start =========================>
    $('body').on("click", ".nav_btn", function () {
        $(".select-all-sms").prop("checked", false);
        list_data_t();
    });
    $('body').on("click", ".close_btn", function () {
        list_data_t();
    });
    //listdata on click event end ===========================>

    //<!-- WhatApp/Email/SMS listdata AJAX End   =========================================================================== -->
    //<!-- WhatApp/Email/SMS delete data(single record) AJAX start   ======================================================= -->
    $('body').on('click', '.Comman_delete', function () {
        var table = $("#table_value_picker").val();
        var id = $("#" + 'emailtemplate').attr("data-delete_id");
        $.ajax({
            method: "post",
            url: "<?= site_url('template_delete_data'); ?>",
            data: {
                action: 'delete',
                id: id,
                table: 'emailtemplate'
            },
            success: function (data) {
                $(".close_btn").trigger("click");
                iziToast.error({
                    title: 'Delete successfully'
                });
            },
            error: function (error) {
                $('.loader').hide();
            }
        });
    });
    //<!-- WhatApp/Email/SMS delete data(single record) AJAX end   ========================================================= -->  
    $('body').on('click', '.deleted-all', function () {
        var table = $("#table_value_picker").val();
        var checkbox = $(this).closest(".main-check-class").find('.table_list_check:checked');
        if (checkbox.length > 0) {
            var checkbox_value = [];
            $(checkbox).each(function () {
                checkbox_value.push($(this).attr("data-delete_id"));
            });

            if (checkbox.length > 0) {
                if (checkbox.length <= 1) {
                    record_text = "Do You really want to delete these records? You won't be able to revert this!";
                } else {
                    record_text = "Do You really want to delete those records? You won't be able to revert this!";
                }
                var checkbox_value = [];
                $(checkbox).each(function () {
                    checkbox_value.push($(this).attr("data-delete_id"));
                });
                Swal.fire({
                    title: 'Are you sure?',
                    text: record_text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#6e7881',
                    confirmButtonColor: '#dd3333',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: "<?= site_url('delete_all'); ?>",
                            method: "post",
                            data: {
                                action: 'delete',
                                checkbox_value: checkbox_value,
                                table: table,
                            },
                            success: function (data) {
                                $(checkbox).closest("tr").fadeOut();
                                iziToast.error({
                                    title: 'Delete Successfully'
                                });
                                $(".close_btn").trigger("click");
                            }
                        });
                    } else {
                        // $('.checkbox').prop('checked', false);
                        // $('#select-all-sms').prop('checked', false);
                        // $("#deleted-all").hide();
                    }
                });
            }
        } else {
            alert('Select atleast one records');
        }
    });
</script>

<!-- extra code start========================================================================================================= -->
<script>
    function email_send_list() {
        // $('.Lead_Quality_Report .loader').show();
        $.ajax({
            type: 'post',
            url: '<?= base_url('fetch_email_track_data') ?>',
            data: {

            },
            success: function (res) {
                var result = JSON.parse(res);
                $('.loader').hide();
                $('#demo_list_data').html(result.html);
            }
        });
    }
    email_send_list();

    var checkboxes = document.getElementsByClassName('');
    var selectedCountSpan = document.getElementById('chec_select');

    function updateSelectedCount() {
        var selectedCount = -1;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedCount++;
            }
        }
        selectedCountSpan.textContent = selectedCount;
    }
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', updateSelectedCount);
    }
    $(document).ready(function () {

    });
</script>
<!-- -----------------------------------------------------------sms js end------------------------------------------------------------------------------------- -->
<!-- -----------------------------------------------------------whatsapp js start------------------------------------------------------------------------------------- -->
<script>
    $('#attachment').on('change', function () {
        var files = $(this).prop('files');
        for (var i = 0; i < files.length; i++) {
            var fileName = files[i].name;
            $('.file_view_add').append('<div id="u_btn" class="col-12 m-1 rounded view-file-link px-2 d-flex u_btn"><p>' + fileName + '</p><span class="ms-auto" id="file_crodd_btn1"><i class="bi bi-x-circle"></i></span></div>')
        }
    });

    $('body').on('click', '#file_crodd_btn', function () {
        $(this).closest('div').remove();
    });

    $('body').on('click', '#file_crodd_btn1', function () {
        $(this).closest('div').remove();
    });
    // ========sidebar-jqury===================
    $('body').on('click', '.menu-toggle', function () {
        $(this).addClass('bg-body-secondary');
        $(this).siblings('.menu-toggle').removeClass('bg-body-secondary');
    });
    $('body').on('click', '.Arro-pro', function () {
        $(this).closest('.first-container').toggleClass('slide-toggle');
        $('.first-container-text').toggle();
        $('.Arrowmovement').toggleClass("arrow-down");
        $(this).toggleClass('rotate-arrow');
        $('.toggle-center').toggleClass('justify-content-center');
        $('.menu-toggle div').toggleClass('justify-content-center');
    });
    $('body').on('click', "#booklist", function () {
        $(this).children('i').toggleClass('d-none');
    })

    function mail_get() {
        $.ajax({
            type: 'post',
            url: '<?= base_url('mail_get') ?>',
            data: {

            },
            success: function (res) {
                var result = JSON.parse(res);
                $('.loader').hide();
                // $('#demo_list_data').html(result.html);
            }
        });
    }
    mail_get();
    $('body').on('click','.hide-panel2',function(){
        $('.main-panel1').removeClass('d-none');
        $('.main-panel2').addClass('d-none');
    })
    $('body').on('click','.hide-panel1',function(){
        $('.main-panel2').removeClass('d-none');
        $('.main-panel1').addClass('d-none');
    })
</script>