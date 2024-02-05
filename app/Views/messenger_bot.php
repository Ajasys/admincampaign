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
    .first-container {
        width: 102px;
    }

    .slide-toggle {
        width: 443px;
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


<div class="main-dashbord p-3">
    <div class="container-fluid">
        <div class="row row-main p-1">
            <div class="col-11">
                <h4>Messenger & Bot</h4>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <a href="#" class="btn-primary-rounded"><i class="bi bi-plus-lg add-panel-plus"></i></a>
            </div>
        </div>
        <!-- <div class="card card-menu add-panel">
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
        </div> -->

        <div class="col-12 p-2 d-flex flex-wrap">
            <div class="p-1 first-container slide-toggle">
                <div class="col-12 bg-white border rounded-3 px-4 py-3 d-flex flex-wrap">
                    <div class="col-12 d-flex flex-wrap w-100 mt-5">
                        <ul class="d-flex flex-wrap nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">

                            <li class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 border border-light-subtle menu-toggle bg-body-secondary nav-item Tab1Class" role="presentation">
                                <div class="col-12 d-flex" DataStatus='1' data-table="exercise_type" data-bs-toggle="pill" data-bs-target="#pills-ex-single-tab" type="button" role="tab" aria-controls="#pills-ex-single-tab" aria-selected="false">
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
                                    <span class="ms-3 first-container-text"> Create Templates</span>
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