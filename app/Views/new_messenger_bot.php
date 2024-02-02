<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<style>
    .fs-12{
        font-size: 12px;
    }
</style>


<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Bot Chats</h2>
            </div>
            <div class="col-12 d-flex flex-wrap ">
                <div class="col-3 border rounded-3 bg-white p-3 " style="height:80vh">
                    <div class="chat-nav-search-bar p-3 border-bottom col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="dropdown d-flex align-items-center">
                                <i class="fas fa-comment fs-5  me-2"></i>
                                <h5 class="fs-5 ">Chats</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 overflow-y-scroll " style="max-height: 100%;">
                        <div class="chat-nav-search-bar p-2  border my-2 col-12  rounded-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0" viewBox="0 0 152 152" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><linearGradient id="a" x1="47.99" x2="119.76" y1="58.55" y2="130.32" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1a6610"></stop><stop offset=".26" stop-color="#1a6610" stop-opacity=".78"></stop><stop offset=".79" stop-color="#1a6610" stop-opacity=".2"></stop><stop offset=".97" stop-color="#1a6610" stop-opacity="0"></stop></linearGradient><g data-name="Layer 2"><g data-name="08.whatsapp"><circle cx="76" cy="76" r="76" fill="#2aa81a" opacity="1" data-original="#2aa81a"></circle><path fill="url(#a)" d="M149.4 95.78A76 76 0 0 1 77.26 152l-38.62-38.64L46.48 94c-13.8-73.72 56.33-44.84 56.33-44.84z" opacity="1" data-original="url(#a)"></path><g fill="#fff"><path d="M102.81 49.19a37.7 37.7 0 0 0-60.4 43.62l-4 19.42a1.42 1.42 0 0 0 .23 1.13 1.45 1.45 0 0 0 1.54.6l19-4.51a37.7 37.7 0 0 0 43.6-60.26zm-5.94 47.37a29.56 29.56 0 0 1-34 5.57l-2.66-1.32-11.67 2.76v-.15L51 91.65l-1.3-2.56a29.5 29.5 0 0 1 5.43-34.27 29.53 29.53 0 0 1 41.74 0L97 55a29.52 29.52 0 0 1-.15 41.58z" fill="#ffffff" opacity="1" data-original="#ffffff"></path><path d="M95.84 88c-1.43 2.25-3.7 5-6.53 5.69-5 1.2-12.61 0-22.14-8.81l-.12-.11c-8.29-7.74-10.49-14.19-10-19.3.29-2.91 2.71-5.53 4.75-7.25a2.72 2.72 0 0 1 4.25 1l3.07 6.94a2.7 2.7 0 0 1-.33 2.76l-1.56 2a2.65 2.65 0 0 0-.21 2.95 29 29 0 0 0 5.27 5.86 31.17 31.17 0 0 0 7.3 5.23 2.65 2.65 0 0 0 2.89-.61l1.79-1.82a2.71 2.71 0 0 1 2.73-.76l7.3 2.09A2.74 2.74 0 0 1 95.84 88z" fill="#ffffff" opacity="1" data-original="#ffffff"></path></g></g></g></g></svg>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-12 ">{{question_1707428}}, Your appointment🕒 has been booked on {{date_338050}} at {{radio_338049}}</p>
                                        <div class="text-end">
                                            <span class="fs-12">a day ago</span>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                        <div class="chat-nav-search-bar p-2  my-2 col-12  rounded-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0" viewBox="0 0 152 152" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><linearGradient id="a" x1="47.99" x2="119.76" y1="58.55" y2="130.32" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1a6610"></stop><stop offset=".26" stop-color="#1a6610" stop-opacity=".78"></stop><stop offset=".79" stop-color="#1a6610" stop-opacity=".2"></stop><stop offset=".97" stop-color="#1a6610" stop-opacity="0"></stop></linearGradient><g data-name="Layer 2"><g data-name="08.whatsapp"><circle cx="76" cy="76" r="76" fill="#2aa81a" opacity="1" data-original="#2aa81a"></circle><path fill="url(#a)" d="M149.4 95.78A76 76 0 0 1 77.26 152l-38.62-38.64L46.48 94c-13.8-73.72 56.33-44.84 56.33-44.84z" opacity="1" data-original="url(#a)"></path><g fill="#fff"><path d="M102.81 49.19a37.7 37.7 0 0 0-60.4 43.62l-4 19.42a1.42 1.42 0 0 0 .23 1.13 1.45 1.45 0 0 0 1.54.6l19-4.51a37.7 37.7 0 0 0 43.6-60.26zm-5.94 47.37a29.56 29.56 0 0 1-34 5.57l-2.66-1.32-11.67 2.76v-.15L51 91.65l-1.3-2.56a29.5 29.5 0 0 1 5.43-34.27 29.53 29.53 0 0 1 41.74 0L97 55a29.52 29.52 0 0 1-.15 41.58z" fill="#ffffff" opacity="1" data-original="#ffffff"></path><path d="M95.84 88c-1.43 2.25-3.7 5-6.53 5.69-5 1.2-12.61 0-22.14-8.81l-.12-.11c-8.29-7.74-10.49-14.19-10-19.3.29-2.91 2.71-5.53 4.75-7.25a2.72 2.72 0 0 1 4.25 1l3.07 6.94a2.7 2.7 0 0 1-.33 2.76l-1.56 2a2.65 2.65 0 0 0-.21 2.95 29 29 0 0 0 5.27 5.86 31.17 31.17 0 0 0 7.3 5.23 2.65 2.65 0 0 0 2.89-.61l1.79-1.82a2.71 2.71 0 0 1 2.73-.76l7.3 2.09A2.74 2.74 0 0 1 95.84 88z" fill="#ffffff" opacity="1" data-original="#ffffff"></path></g></g></g></g></svg>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-12 ">{{question_1707428}}, Your appointment🕒 has been booked on {{date_338050}} at {{radio_338049}}</p>
                                        <div class="text-end">
                                            <span class="fs-12">2 day ago</span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="chat-nav-search-bar p-2  my-2 col-12  rounded-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0" viewBox="0 0 152 152" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><linearGradient id="a" x1="47.99" x2="119.76" y1="58.55" y2="130.32" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1a6610"></stop><stop offset=".26" stop-color="#1a6610" stop-opacity=".78"></stop><stop offset=".79" stop-color="#1a6610" stop-opacity=".2"></stop><stop offset=".97" stop-color="#1a6610" stop-opacity="0"></stop></linearGradient><g data-name="Layer 2"><g data-name="08.whatsapp"><circle cx="76" cy="76" r="76" fill="#2aa81a" opacity="1" data-original="#2aa81a"></circle><path fill="url(#a)" d="M149.4 95.78A76 76 0 0 1 77.26 152l-38.62-38.64L46.48 94c-13.8-73.72 56.33-44.84 56.33-44.84z" opacity="1" data-original="url(#a)"></path><g fill="#fff"><path d="M102.81 49.19a37.7 37.7 0 0 0-60.4 43.62l-4 19.42a1.42 1.42 0 0 0 .23 1.13 1.45 1.45 0 0 0 1.54.6l19-4.51a37.7 37.7 0 0 0 43.6-60.26zm-5.94 47.37a29.56 29.56 0 0 1-34 5.57l-2.66-1.32-11.67 2.76v-.15L51 91.65l-1.3-2.56a29.5 29.5 0 0 1 5.43-34.27 29.53 29.53 0 0 1 41.74 0L97 55a29.52 29.52 0 0 1-.15 41.58z" fill="#ffffff" opacity="1" data-original="#ffffff"></path><path d="M95.84 88c-1.43 2.25-3.7 5-6.53 5.69-5 1.2-12.61 0-22.14-8.81l-.12-.11c-8.29-7.74-10.49-14.19-10-19.3.29-2.91 2.71-5.53 4.75-7.25a2.72 2.72 0 0 1 4.25 1l3.07 6.94a2.7 2.7 0 0 1-.33 2.76l-1.56 2a2.65 2.65 0 0 0-.21 2.95 29 29 0 0 0 5.27 5.86 31.17 31.17 0 0 0 7.3 5.23 2.65 2.65 0 0 0 2.89-.61l1.79-1.82a2.71 2.71 0 0 1 2.73-.76l7.3 2.09A2.74 2.74 0 0 1 95.84 88z" fill="#ffffff" opacity="1" data-original="#ffffff"></path></g></g></g></g></svg>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-12 ">{{question_1707428}}, Your appointment🕒 has been booked on {{date_338050}} at {{radio_338049}}</p>
                                        <div class="text-end">
                                            <span class="fs-12">3 day ago</span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="chat-nav-search-bar p-2  my-2 col-12  rounded-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0" viewBox="0 0 152 152" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><linearGradient id="a" x1="47.99" x2="119.76" y1="58.55" y2="130.32" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1a6610"></stop><stop offset=".26" stop-color="#1a6610" stop-opacity=".78"></stop><stop offset=".79" stop-color="#1a6610" stop-opacity=".2"></stop><stop offset=".97" stop-color="#1a6610" stop-opacity="0"></stop></linearGradient><g data-name="Layer 2"><g data-name="08.whatsapp"><circle cx="76" cy="76" r="76" fill="#2aa81a" opacity="1" data-original="#2aa81a"></circle><path fill="url(#a)" d="M149.4 95.78A76 76 0 0 1 77.26 152l-38.62-38.64L46.48 94c-13.8-73.72 56.33-44.84 56.33-44.84z" opacity="1" data-original="url(#a)"></path><g fill="#fff"><path d="M102.81 49.19a37.7 37.7 0 0 0-60.4 43.62l-4 19.42a1.42 1.42 0 0 0 .23 1.13 1.45 1.45 0 0 0 1.54.6l19-4.51a37.7 37.7 0 0 0 43.6-60.26zm-5.94 47.37a29.56 29.56 0 0 1-34 5.57l-2.66-1.32-11.67 2.76v-.15L51 91.65l-1.3-2.56a29.5 29.5 0 0 1 5.43-34.27 29.53 29.53 0 0 1 41.74 0L97 55a29.52 29.52 0 0 1-.15 41.58z" fill="#ffffff" opacity="1" data-original="#ffffff"></path><path d="M95.84 88c-1.43 2.25-3.7 5-6.53 5.69-5 1.2-12.61 0-22.14-8.81l-.12-.11c-8.29-7.74-10.49-14.19-10-19.3.29-2.91 2.71-5.53 4.75-7.25a2.72 2.72 0 0 1 4.25 1l3.07 6.94a2.7 2.7 0 0 1-.33 2.76l-1.56 2a2.65 2.65 0 0 0-.21 2.95 29 29 0 0 0 5.27 5.86 31.17 31.17 0 0 0 7.3 5.23 2.65 2.65 0 0 0 2.89-.61l1.79-1.82a2.71 2.71 0 0 1 2.73-.76l7.3 2.09A2.74 2.74 0 0 1 95.84 88z" fill="#ffffff" opacity="1" data-original="#ffffff"></path></g></g></g></g></svg>
                                    </div>
                                    <div class="col-10">
                                        <p class="fs-12 ">{{question_1707428}}, Your appointment🕒 has been booked on {{date_338050}} at {{radio_338049}}</p>
                                        <div class="text-end">
                                            <span class="fs-12">3 day ago</span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

        
                <div class="col-8 border rounded-3 bg-white p-3 mx-4 " style="height:80vh">
                    <div class="chat-nav-search-bar p-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fs-5 mb-2 d-flex  align-content-center "><i class="fa-solid fa-user-pen me-2"></i>Transcript</h5>
                                <button class="bg-transparent border-0"><i class="fa-regular fa-star"></i></button>
                        </div>
                    </div>

                    <div class="main-task left-main-task mt-2 ps-3 overflow-y-scroll " style="max-height:546.8px">
                        <div class="d-flex  mb-1 col-3">
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
                        <!-- <div class=" text-end">
                            <span class="btn-primary ronded-5">menu</span>
                        </div> -->
                        <div class="mt-4">
                            <div class="d-flex mb-4 justify-content-end">
                                <div class="col-6 text-end">
                                    <span class="px-3 py-2 rounded-3 text-white" style="background:#724EBF;">Hello</span>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-4">
                                <div class="col-6 text-start">
                                    <span class="px-3 py-2 rounded-3 " style="background:#f3f3f3;">undefined, This is an <b>appointment booking</b> demo bot🙂.</span>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="col-6 text-start">
                                    <span class="px-3 py-2 rounded-3 " style="background:#f3f3f3;">What is your full name ?</span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>







<?= $this->include('partials/footer') ?>
