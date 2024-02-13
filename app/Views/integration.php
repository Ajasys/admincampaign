<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<?php
$table_username = getMasterUsername();
$db_connection = \Config\Database::connect('second');
$query90 = "SELECT * FROM admin_generale_setting WHERE id IN(1)";
$result = $db_connection->query($query90);
$total_dataa_userr_22 = $result->getResult();
if (isset($total_dataa_userr_22[0])) {
    $settings_data = get_object_vars($total_dataa_userr_22[0]);
} else {
    $settings_data = array();
}
$WhatAppRedirectStatus = 0;

// if(isset($settings_data) && !empty($settings_data)){
//     if (isset($settings_data['whatapp_phone_number_id']) && isset($settings_data['whatapp_business_account_id']) && isset($settings_data['whatapp_access_token']) && !empty($settings_data['whatapp_phone_number_id']) && !empty($settings_data['whatapp_business_account_id']) && !empty($settings_data['whatapp_access_token']) && $settings_data['whatapp_phone_number_id'] != '0' && $settings_data['whatapp_business_account_id'] != '0') {
//         $WhatAppRedirectStatus = 1;
//     } 
// }


$WhatsAppConnectionCheckArray = WhatsAppConnectionCheck();
$WhatsAppConnectionCheckArray = json_decode($WhatsAppConnectionCheckArray, true);
if (isset($WhatsAppConnectionCheckArray) && !empty($WhatsAppConnectionCheckArray)) {
    if (isset($WhatsAppConnectionCheckArray['ConnectionStatus'])) {
        $WhatAppRedirectStatus = $WhatsAppConnectionCheckArray['ConnectionStatus'];
    }
}

?>
<style>
    .inti-card {
        transition: all 0.5s;
    }

    .inti-card:hover {
        background-color: #E6E7EC !important;
    }
    @media(max-width:575px) {

    }
</style>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Connection </h2>
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

                                                <!-- <span class="fw-bold  text-success  px-2 py-1 rounded-pill " style="font-size:10px">connected</span>
                                                  
                                                    <span class="fw-bold  text-danger  px-2 py-1 rounded-pill " style="font-size:10px">Disconnected</span>
                                                    
                                             -->
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

                                <!-- <div class="col-3 d-flex justify-content-center">
                                    <a href="#"
                                        class="col-9 bg-white border rounded-3 p-3 d-inline-flex justify-content-center flex-wrap">
                                        <div class="d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" x="0" y="0"
                                                viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 512 512"
                                                xml:space="preserve">
                                                <g>
                                                    <circle cx="56.098" cy="56.097" r="56.098" style="" fill="#007ab9"
                                                        data-original="#007ab9"></circle>
                                                    <path
                                                        d="M89.616 60.611v23.128H76.207V62.161c0-5.418-1.936-9.118-6.791-9.118-3.705 0-5.906 2.491-6.878 4.903-.353.862-.444 2.059-.444 3.268v22.524h-13.41s.18-36.546 0-40.329h13.411v5.715c-.027.045-.065.089-.089.132h.089v-.132c1.782-2.742 4.96-6.662 12.085-6.662 8.822 0 15.436 5.764 15.436 18.149zm-54.96-36.642c-4.587 0-7.588 3.011-7.588 6.967 0 3.872 2.914 6.97 7.412 6.97h.087c4.677 0 7.585-3.098 7.585-6.97-.089-3.956-2.908-6.967-7.496-6.967zm-6.791 59.77H41.27v-40.33H27.865v40.33z"
                                                        style="" fill="#f1f2f2" data-original="#f1f2f2"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <h5 class="text-center col-12 text-dark my-3 mb-2 d-flex align-items-center">
                                            Linkedin
                                            <span class="mx-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    viewBox="0 0 30 30" fill="none">
                                                    <path
                                                        d="M27.0934 12.1419C28.3859 17.9904 24.8826 24.0441 19.1746 25.8273C13.9402 27.4648 8.0976 25.143 5.43656 20.3356C2.78721 15.5399 3.88672 9.38145 8.03912 5.80162C12.1623 2.23992 18.3967 2.0592 22.7363 5.34544L20.8531 6.87189C16.2328 3.80145 9.7878 5.52674 7.30221 10.4804C4.82247 15.4282 7.31391 21.6158 12.519 23.4815C15.5362 24.5634 18.9991 23.9839 21.5017 21.9895C24.5317 19.5741 25.771 15.41 24.5551 11.7319L26.3266 9.8429C26.6604 10.5809 26.9173 11.3513 27.0934 12.1419Z"
                                                        fill="#9B9B9B" />
                                                    <path
                                                        d="M16.6031 11.2062L15.5 12.3093L12.2062 9L10 11.2062L13.3093 14.5L10 17.7938L12.2062 20L15.5 16.6907L18.7938 20L21 17.7938L17.6907 14.5L18.7938 13.3969L21 11.2062L18.7938 9L16.6031 11.2062Z"
                                                        fill="#FF0000" />
                                                </svg>
                                            </span>
                                        </h5>
                                        <p class="text-center text-dark">Lorem ipsum dolor, sit amet consectetur adipisicing
                                            elit. Pariatur, unde.</p>
                                    </a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <a href="#"
                                        class="col-9 bg-white border rounded-3 p-3 d-inline-flex justify-content-center flex-wrap">
                                        <div class="d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" x="0" y="0"
                                                viewBox="0 0 24 24" style="enable-background:new 0 0 512 512"
                                                xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#eceff1"
                                                        d="M20.52 3.449C18.24 1.245 15.24 0 12.045 0 2.875 0-2.883 9.935 1.696 17.838L0 24l6.335-1.652c2.76 1.491 5.021 1.359 5.716 1.447 10.633 0 15.926-12.864 8.454-20.307z"
                                                        opacity="1" data-original="#eceff1" class=""></path>
                                                    <path fill="#4caf50"
                                                        d="m12.067 21.751-.006-.001h-.016c-3.182 0-5.215-1.507-5.415-1.594l-3.75.975 1.005-3.645-.239-.375a9.869 9.869 0 0 1-1.516-5.26c0-8.793 10.745-13.19 16.963-6.975 6.203 6.15 1.848 16.875-7.026 16.875z"
                                                        opacity="1" data-original="#4caf50"></path>
                                                    <path fill="#fafafa"
                                                        d="m17.507 14.307-.009.075c-.301-.15-1.767-.867-2.04-.966-.613-.227-.44-.036-1.617 1.312-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.293-.506.32-.578.878-1.634.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.576-.05-.997-.042-1.368.344-1.614 1.774-1.207 3.604.174 5.55 2.714 3.552 4.16 4.206 6.804 5.114.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345z"
                                                        opacity="1" data-original="#fafafa"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <h5 class="text-center col-12 text-dark my-3 mb-2 d-flex align-items-center">
                                            Whatsapp
                                            <span class="mx-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M23.0934 9.14192C24.3859 14.9904 20.8826 21.0441 15.1746 22.8273C9.9402 24.4648 4.0976 22.143 1.43656 17.3356C-1.21279 12.5399 -0.113278 6.38145 4.03912 2.80162C8.16227 -0.760083 14.3967 -0.940799 18.7363 2.34544L16.8531 3.87189C12.2328 0.801453 5.7878 2.52674 3.30221 7.48038C0.822473 12.4282 3.31391 18.6158 8.51903 20.4815C11.5362 21.5634 14.9991 20.9839 17.5017 18.9895C20.5317 16.5741 21.771 12.41 20.5551 8.73195L22.3266 6.8429C22.6604 7.58091 22.9173 8.35131 23.0934 9.14192Z"
                                                        fill="#9B9B9B" />
                                                    <path
                                                        d="M13.169 15.4245H10.5627C10.447 15.4245 10.3456 15.4682 10.2587 15.5549C10.1718 15.6419 10.1284 15.7431 10.1284 15.859V18.4654C10.1284 18.5812 10.1719 18.6826 10.2587 18.7694C10.3456 18.8561 10.4469 18.8997 10.5627 18.8997H13.169C13.2847 18.8997 13.3863 18.8562 13.4729 18.7694C13.56 18.6826 13.6035 18.5812 13.6035 18.4654V15.859C13.6035 15.7431 13.5601 15.6419 13.4729 15.5549C13.3863 15.468 13.2847 15.4245 13.169 15.4245ZM16.5899 7.62258C16.293 7.07571 15.9094 6.61441 15.4387 6.23786C14.9684 5.86146 14.4395 5.56087 13.8532 5.33654C13.2668 5.11228 12.6841 5 12.1048 5C9.90413 5 8.2246 5.96287 7.06619 7.88864C7.00834 7.9827 6.98837 8.08402 7.00644 8.19265C7.02462 8.30113 7.08072 8.39165 7.17482 8.46404L8.95579 9.82156C9.04989 9.87937 9.14041 9.90832 9.22733 9.90832C9.35767 9.90832 9.4698 9.85031 9.56401 9.73449C10.0852 9.08302 10.4726 8.66676 10.7259 8.48568C11.0373 8.2758 11.4281 8.1709 11.8987 8.1709C12.3403 8.1709 12.7293 8.28675 13.066 8.51824C13.4027 8.74995 13.5708 9.01783 13.5708 9.32189C13.5708 9.662 13.4805 9.93722 13.2994 10.1472C13.1185 10.3571 12.8143 10.5597 12.3871 10.7552C11.8226 11.0086 11.3047 11.4014 10.8344 11.9335C10.3637 12.4656 10.1285 13.0321 10.1285 13.633V14.1216C10.1285 14.2593 10.1663 14.395 10.2425 14.5289C10.3186 14.6629 10.4108 14.7298 10.5195 14.7298H13.1257C13.2415 14.7298 13.3428 14.6738 13.4297 14.5613C13.5164 14.4494 13.5601 14.3317 13.5601 14.2088C13.5601 14.0279 13.6596 13.7851 13.8585 13.4812C14.0576 13.1771 14.3055 12.9416 14.6026 12.775C14.8847 12.6158 15.1054 12.4875 15.2648 12.3896C15.4244 12.292 15.6324 12.1342 15.8895 11.9172C16.1464 11.6999 16.3455 11.4845 16.4865 11.271C16.6278 11.0575 16.7545 10.7805 16.8667 10.4402C16.9792 10.1 17.0352 9.73434 17.0352 9.34345C17.0351 8.74257 16.8866 8.16888 16.5899 7.62258Z"
                                                        fill="#0038FF" fill-opacity="0.84" />
                                                </svg>
                                            </span>
                                        </h5>
                                        <p class="text-center text-dark">Lorem ipsum dolor, sit amet consectetur adipisicing
                                            elit. Pariatur, unde.</p>
                                    </a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <a href="#"
                                        class="col-9 bg-white border rounded-3 p-3 d-inline-flex justify-content-center flex-wrap">
                                        <div class="d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" x="0" y="0"
                                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                                xml:space="preserve" class="">
                                                <g>
                                                    <circle cx="256" cy="256" r="256" style="" fill="#5f98d1"
                                                        data-original="#5f98d1" class=""></circle>
                                                    <path
                                                        d="M415.813 147.466H95.558l116.019 120.806 33.48 33.9c-18.216-4.164-19.343-6.759-27.415-13.349-4.234-3.457-12.414-12.852-24.838-25.54L88.217 156.484v198.822l8.265 8.265-.925.963L242.68 511.657c4.412.226 8.852.343 13.32.343 141.385 0 256-114.615 256-256 0-4.246-.11-8.466-.313-12.661l-95.874-95.873z"
                                                        style="" fill="#3a6da1" data-original="#3a6da1"></path>
                                                    <path
                                                        d="M88.217 156.484v198.822l96.958-99.813zM423.783 156.484v198.822l-96.476-99.411zM95.558 147.466h320.255L289.948 278.524a47.506 47.506 0 0 1-68.524 0L95.558 147.466z"
                                                        style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                                                    <path
                                                        d="M297.209 285.496c-10.799 11.244-25.933 17.694-41.523 17.694-15.589 0-30.724-6.448-41.522-17.693l-21.349-22.23-97.257 101.267h320.255l-97.256-101.267-21.348 22.229z"
                                                        style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <h5 class="text-center col-12 text-dark my-3 mb-2">Email intigration</h5>
                                        <p class="text-center text-dark">Lorem ipsum dolor, sit amet consectetur adipisicing
                                            elit. Pariatur, unde.</p>
                                    </a>
                                </div>
                                <div class="col-3 d-flex justify-content-center mt-4">
                                    <a href="#"
                                        class="col-9 bg-white border rounded-3 p-3 d-inline-flex justify-content-center flex-wrap">
                                        <div class="d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" x="0" y="0"
                                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                                xml:space="preserve" class="">
                                                <g>
                                                    <linearGradient id="a" x1="256" x2="256" y1="0" y2="512"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#01f1fe"></stop>
                                                        <stop offset="1" stop-color="#4fadfe"></stop>
                                                    </linearGradient>
                                                    <path fill="url(#a)" fill-rule="evenodd"
                                                        d="M256 512C114.841 512 0 397.159 0 256S114.841 0 256 0s256 114.841 256 256-114.841 256-256 256zm47.063-119.906c36.385-12.618 66.194-39.433 82.751-73.794H327.18c-3.288 19.767-8.155 37.995-14.443 53.716-2.964 7.409-6.202 14.107-9.674 20.078zm-176.876-73.793c16.557 34.359 46.365 61.175 82.75 73.794-3.471-5.972-6.71-12.67-9.674-20.078-6.289-15.721-11.155-33.949-14.443-53.716zm82.75-198.395c-36.385 12.618-66.193 39.434-82.75 73.794h58.633c3.288-19.767 8.154-37.995 14.443-53.716 2.964-7.409 6.202-14.107 9.674-20.078zM256 112c-10.498 0-22.817 14.493-32.148 37.82-5.148 12.871-9.229 27.726-12.16 43.88h88.617c-2.931-16.153-7.011-31.009-12.16-43.88C278.817 126.493 266.498 112 256 112zM112 256c0 12.361 1.567 24.362 4.51 35.818h64.957c-1.052-11.65-1.61-23.636-1.61-35.818s.558-24.168 1.61-35.818H116.51A143.783 143.783 0 0 0 112 256zm96.042 35.818h95.917c1.118-11.576 1.702-23.577 1.702-35.818s-.583-24.242-1.702-35.818h-95.917c-1.118 11.576-1.702 23.577-1.702 35.818s.583 24.242 1.702 35.818zM256 400c10.498 0 22.817-14.493 32.148-37.82 5.149-12.871 9.229-27.726 12.16-43.88h-88.617c2.931 16.153 7.012 31.009 12.16 43.88C233.183 385.507 245.502 400 256 400zm144-144c0-12.361-1.567-24.362-4.51-35.818h-64.958c1.052 11.65 1.61 23.636 1.61 35.818s-.558 24.168-1.61 35.818h64.958A143.783 143.783 0 0 0 400 256zm-14.187-62.301c-16.556-34.36-46.365-61.176-82.751-73.794 3.471 5.972 6.71 12.67 9.674 20.079 6.289 15.721 11.155 33.948 14.443 53.716h58.634zM426.483 256c0 94.004-76.479 170.483-170.483 170.483-94.005 0-170.483-76.479-170.483-170.483S161.995 85.517 256 85.517c94.005 0 170.483 76.479 170.483 170.483z"
                                                        clip-rule="evenodd" opacity="1" data-original="url(#a)" class=""></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <h5 class="text-center col-12 text-dark my-3 mb-2">Web intigration</h5>
                                        <p class="text-center text-dark">Lorem ipsum dolor, sit amet consectetur adipisicing
                                            elit. Pariatur, unde.</p>
                                    </a>
                                </div>
                                <div class="col-3 d-flex justify-content-center mt-4">
                                    <a href="#"
                                        class="col-9 bg-white border rounded-3 p-3 d-inline-flex justify-content-center flex-wrap">
                                        <div class="d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" x="0" y="0"
                                                viewBox="0 0 64 64" style="enable-background:new 0 0 512 512"
                                                xml:space="preserve" class="">
                                                <g>
                                                    <g fill-rule="evenodd">
                                                        <path fill="#deebf5"
                                                            d="M48 64H16A16 16 0 0 1 0 48V16A16 16 0 0 1 16 0h32a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16"
                                                            opacity="1" data-original="#deebf5"></path>
                                                        <path fill="#f0faff"
                                                            d="M30 18h18A9 9 0 0 0 48.92.046C48.614.029 48.311 0 48 0H16A16 16 0 0 0 0 16v32a30 30 0 0 1 30-30"
                                                            opacity="1" data-original="#f0faff"></path>
                                                        <path fill="#cddceb" d="M48 32a16 16 0 1 0 16 16V16a16 16 0 0 1-16 16"
                                                            opacity="1" data-original="#cddceb"></path>
                                                    </g>
                                                    <path fill="#1e78ff"
                                                        d="M52 32.469c0-.779-.036-1.561-.109-2.338a1.996 1.996 0 0 0-1.988-1.804c-3.575-.004-11.718-.004-15.5-.004a2 2 0 0 0-2 2v3.857a2 2 0 0 0 2 2h9.02a9.44 9.44 0 0 1-4.078 6.2v.002a5.096 5.096 0 0 0 5.096 5.096h1.479C49.781 43.925 52 38.677 52 32.469z"
                                                        opacity="1" data-original="#1e78ff"></path>
                                                    <path fill="#00b450"
                                                        d="M32.403 52.404a19.528 19.528 0 0 0 13.524-4.926l-6.574-5.098a12.375 12.375 0 0 1-18.398-6.47h-1.531a5.255 5.255 0 0 0-5.254 5.254v.002a20.409 20.409 0 0 0 18.233 11.238z"
                                                        opacity="1" data-original="#00b450"></path>
                                                    <path fill="#ffb400"
                                                        d="M20.948 35.91a12.214 12.214 0 0 1 0-7.811v-.002a5.255 5.255 0 0 0-5.254-5.254H14.17a20.427 20.427 0 0 0 0 18.323z"
                                                        opacity="1" data-original="#ffb400"></path>
                                                    <path fill="#e60014"
                                                        d="M32.403 19.672a11.106 11.106 0 0 1 6.509 1.982 1.966 1.966 0 0 0 2.548-.2c.915-.868 2.118-2.071 3.066-3.019a2 2 0 0 0-.192-2.998 19.794 19.794 0 0 0-11.931-3.839A20.4 20.4 0 0 0 14.17 22.843l6.778 5.256a12.202 12.202 0 0 1 11.455-8.427z"
                                                        opacity="1" data-original="#e60014"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <h5 class="text-center col-12 text-dark my-3 mb-2">Google intigration</h5>
                                        <p class="text-center text-dark">Lorem ipsum dolor, sit amet consectetur adipisicing
                                            elit. Pariatur, unde.</p>
                                    </a>
                                </div>
                                <div class="col-3 d-flex justify-content-center mt-4">
                                    <a href="#"
                                        class="col-9 bg-white border rounded-3 p-3 d-inline-flex justify-content-center flex-wrap">
                                        <div class="d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" x="0" y="0"
                                                viewBox="0 0 255994 255988" style="enable-background:new 0 0 512 512"
                                                xml:space="preserve" fill-rule="evenodd" class="">
                                                <g>
                                                    <path fill="#e42b26"
                                                        d="M241016 50026c-5171-4694-11718-7772-18879-8563-15565-1742-31271-2619-47030-3059-15656-437-31380-437-47069-427-15687-10-31409-10-47069 427-15760 440-31470 1317-47043 3059-7155 791-13699 3870-18865 8566-5132 4665-8903 10931-10553 18133-2227 9654-3353 19726-3922 29862C14 108201 0 118250 0 128006c0 9742 0 19779 557 29962 556 10131 1669 20203 3897 29859 1659 7205 5433 13473 10564 18137 5163 4693 11701 7770 18853 8562 15576 1742 31286 2619 47046 3058 15659 437 31382 437 47071 427 15696 10 31419 10 47076-427 15757-439 31463-1316 47036-3058 7152-792 13689-3869 18853-8560 5134-4664 8913-10932 10583-18139 2219-9656 3331-19728 3889-29859 550-9989 554-20124 554-29962h10v-494h-10c0-19549 0-40252-4389-59350-1659-7206-5436-13472-10574-18136z"
                                                        opacity="1" data-original="#e42b26" class=""></path>
                                                    <path fill="#fffffe"
                                                        d="M176566 123187c-14585-7616-29070-15175-43539-22724-12028-6277-24044-12547-36096-18839l-3978-2078v91799l3968-2055c13310-6895 26564-13764 39816-20636l39818-20648 4635-2404z"
                                                        opacity="1" data-original="#fffffe"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <h5 class="text-center col-12 text-dark my-3 mb-2">Youtube intigration</h5>
                                        <p class="text-center text-dark">Lorem ipsum dolor, sit amet consectetur adipisicing
                                            elit. Pariatur, unde.</p>
                                    </a>
                                </div> -->
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