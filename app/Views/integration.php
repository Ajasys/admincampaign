<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<?php
$table_username = getMasterUsername();
$db_connection = \Config\Database::connect('second');

?>
<style>
    .inti-card {
        transition: all 0.5s;
    }

    .inti-card:hover {
        background-color: #E6E7EC !important;
    }

    @media(max-width:575px) {}
</style>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Social Media Accounts</h2>
            </div>
            <div class="container-fluid p-0 mt-5">
                <h4 class="text-gray-900 text-center">Add your social accounts</h4>
                <p class="text-center mb-3">Connect your Facebook, Instagram, Twitter, LinkedIn, and so on</p>
                <div class="row justify-content-center ">
                    <div class="col-12 col-md-10 col-lg-12 col-xl-11 col-xxl-9 px-lg-0">
                        <div class="px-3 py-2 bg-white rounded-2 mx-2 mt-2 col-12">
                            <div class="px-3 py-4 bg-white rounded-2 mx-2 mt-2 d-flex flex-wrap">
                                <!-- facebook -->
                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('facebook_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center ">
                                            </div>
                                            <div class="col-12 d-inline-flex justify-content-center flex-wrap mt-3">

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
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Facebook</h5>

                                                <!-- <a href="<?= base_url('facebook_connection') ?>" class="btn btn-primary fs-10 fw-semibold mt-3">Connect</a> -->


                                            </div>
                                            <div class="d-flex justify-content-end p-2" style="height: 40px;">


                                                <!-- <a href="<?= base_url('facebook_connection') ?>"><button class="border-0 bg-transparent "><i class="fa-solid fa-pencil"></i></button></a> -->


                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('whatsapp_connections') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center ">
                                            </div>
                                            <div class="col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths">
                                                    <g>
                                                        <g data-name="Layer 2">
                                                            <g data-name="09.whatsapp">
                                                                <circle cx="88" cy="88" r="88" fill="#29a71a" opacity="1" data-original="#29a71a" class=""></circle>
                                                                <g fill="#fff">
                                                                    <path d="M126.8 49.2a54.57 54.57 0 0 0-87.42 63.13l-5.79 28.11a2.08 2.08 0 0 0 .33 1.63 2.11 2.11 0 0 0 2.24.87l27.55-6.53A54.56 54.56 0 0 0 126.8 49.2zm-8.59 68.56a42.74 42.74 0 0 1-49.22 8l-3.84-1.9-16.89 4 .05-.21 3.5-17-1.88-3.71a42.72 42.72 0 0 1 7.86-49.59 42.73 42.73 0 0 1 60.42 0 2.28 2.28 0 0 0 .22.22 42.72 42.72 0 0 1-.22 60.19z" fill="#ffffff" opacity="1" data-original="#ffffff" class="hovered-path"></path>
                                                                    <path d="M116.71 105.29c-2.07 3.26-5.34 7.25-9.45 8.24-7.2 1.74-18.25.06-32-12.76l-.17-.15C63 89.41 59.86 80.08 60.62 72.68c.42-4.2 3.92-8 6.87-10.48a3.93 3.93 0 0 1 6.15 1.41l4.45 10a3.91 3.91 0 0 1-.49 4l-2.25 2.92a3.87 3.87 0 0 0-.35 4.32c1.26 2.21 4.28 5.46 7.63 8.47 3.76 3.4 7.93 6.51 10.57 7.57a3.82 3.82 0 0 0 4.19-.88l2.61-2.63a4 4 0 0 1 3.9-1l10.57 3a4 4 0 0 1 2.24 5.91z" fill="#ffffff" opacity="1" data-original="#ffffff" class="hovered-path"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">WhatsApp</h5>
                                            </div>
                                            <div class="d-flex justify-content-end p-2" style="height: 40px;">
                                            </div>
                                        </div>
                                    </a>
                                </div>


                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <!-- email  -->
                                    <a href="<?= base_url('email_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center ">
                                            </div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="M64 64h384v384H64z" style="" fill="#eceff1" data-original="#eceff1" class=""></path>
                                                        <path d="M256 296.384 448 448V148.672z" style="" fill="#cfd8dc" data-original="#cfd8dc"></path>
                                                        <path d="M464 64h-16L256 215.616 64 64H48C21.504 64 0 85.504 0 112v288c0 26.496 21.504 48 48 48h16V148.672l192 147.68L448 148.64V448h16c26.496 0 48-21.504 48-48V112c0-26.496-21.504-48-48-48z" style="" fill="#f44336" data-original="#f44336" class=""></path>
                                                    </g>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Email</h5>

                                            </div>
                                            <div class="d-flex justify-content-end p-2  " style="height: 40px;">

                                            </div>
                                        </div>
                                    </a>
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
<?= $this->include('partials/vendor-scripts') ?>
<script>
</script>