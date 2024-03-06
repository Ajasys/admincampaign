<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<?php
$table_username = session_username($_SESSION['username']);
$db_connection = DatabaseDefaultConnection();

$query = "SELECT 
(select count(id) from " . $table_username . "_platform_integration where `platform_status`=1) as whatsappcount,
(select count(id) from " . $table_username . "_platform_integration where `platform_status`=2) as fbcount,
(select count(id) from " . $table_username . "_platform_integration where `platform_status`=3) as emailcount,
(select count(id) from " . $table_username . "_platform_integration where `platform_status`=5) as websitecount 
FROM " . $table_username . "_platform_integration
WHERE `verification_status`=1";
$rows = $db_connection->query($query);
$resultdata = $rows->getResult();
$result = $resultdata;
if (isset($resultdata[0])) {
    $result = get_object_vars($resultdata[0]);
}

?>
<style>
    .inti-card {
        transition: all 0.5s;
    }

    .inti-card:hover {
        background-color: #fff !important;
        box-shadow: inset 5px 5px 30px 2px #E6E7EC, 5px 5px 20px 4px #E6E7EC;
    }

    @media(max-width:575px) {}
</style>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2 class="modal_view">Social Media Accounts</h2>
            </div>
            <div class="container-fluid p-0 mt-5">
                <h4 class="text-gray-900 text-center">Add your social accounts</h4>
                <p class="text-center mb-3">Connect your Facebook,whatsapp,Instagram and so on</p>
                <div class="row justify-content-center ">
                    <div class="col-12 col-md-10 col-lg-12 col-xl-11 col-xxl-9 px-lg-0">
                        <div class="px-3 py-2 bg-white rounded-2 mx-2 mt-2 col-12">
                            <div class="px-3 py-4 bg-white rounded-2 mx-2 mt-2 d-flex flex-wrap">
                                <!-- facebook -->
                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('facebook_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
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
                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">
                                                <!-- 
                                                <div class=" text-success d-flex flex-wrap align-items-end"><span class="fs-10 badge rounded-pill inqq_cunt bg-success mx-1">2</span>
                                                    <div class="align-baseline fs-12">connections</div>
                                                </div> -->
                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['fbcount'])) {
                                                                echo $result['fbcount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('whatsapp_connections') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class="col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths">
                                                    <g>
                                                        <g data-name="Layer 2">
                                                            <g data-name="09.whatsapp">
                                                                <circle cx="88" cy="88" r="88" fill="#29a71a" opacity="1" data-original="#29a71a" class="">
                                                                </circle>
                                                                <g fill="#fff">
                                                                    <path d="M126.8 49.2a54.57 54.57 0 0 0-87.42 63.13l-5.79 28.11a2.08 2.08 0 0 0 .33 1.63 2.11 2.11 0 0 0 2.24.87l27.55-6.53A54.56 54.56 0 0 0 126.8 49.2zm-8.59 68.56a42.74 42.74 0 0 1-49.22 8l-3.84-1.9-16.89 4 .05-.21 3.5-17-1.88-3.71a42.72 42.72 0 0 1 7.86-49.59 42.73 42.73 0 0 1 60.42 0 2.28 2.28 0 0 0 .22.22 42.72 42.72 0 0 1-.22 60.19z" fill="#ffffff" opacity="1" data-original="#ffffff" class="hovered-path">
                                                                    </path>
                                                                    <path d="M116.71 105.29c-2.07 3.26-5.34 7.25-9.45 8.24-7.2 1.74-18.25.06-32-12.76l-.17-.15C63 89.41 59.86 80.08 60.62 72.68c.42-4.2 3.92-8 6.87-10.48a3.93 3.93 0 0 1 6.15 1.41l4.45 10a3.91 3.91 0 0 1-.49 4l-2.25 2.92a3.87 3.87 0 0 0-.35 4.32c1.26 2.21 4.28 5.46 7.63 8.47 3.76 3.4 7.93 6.51 10.57 7.57a3.82 3.82 0 0 0 4.19-.88l2.61-2.63a4 4 0 0 1 3.9-1l10.57 3a4 4 0 0 1 2.24 5.91z" fill="#ffffff" opacity="1" data-original="#ffffff" class="hovered-path">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">WhatsApp</h5>
                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">
                                                <!-- <div class=" text-success d-flex flex-wrap align-items-end"><span class="fs-10 badge rounded-pill inqq_cunt bg-success mx-1">0</span>
                                                    <div class="align-baseline fs-12">connections</div>
                                                </div> -->
                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['whatsappcount'])) {
                                                                echo $result['whatsappcount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                <a href="<?= base_url('instagram_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class="col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                                                    <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38" cy="42.035" r="44.899" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#fd5"></stop>
                                                        <stop offset=".328" stop-color="#ff543f"></stop>
                                                        <stop offset=".348" stop-color="#fc5245"></stop>
                                                        <stop offset=".504" stop-color="#e64771"></stop>
                                                        <stop offset=".643" stop-color="#d53e91"></stop>
                                                        <stop offset=".761" stop-color="#cc39a4"></stop>
                                                        <stop offset=".841" stop-color="#c837ab"></stop>
                                                    </radialGradient>
                                                    <path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                                    </path>
                                                    <radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786" cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#4168c9"></stop>
                                                        <stop offset=".999" stop-color="#4168c9" stop-opacity="0">
                                                        </stop>
                                                    </radialGradient>
                                                    <path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                                    </path>
                                                    <path fill="#fff" d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z">
                                                    </path>
                                                    <circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle>
                                                    <path fill="#fff" d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z">
                                                    </path>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Instagram</h5>
                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">
                                                <!-- 
                                                <div class=" text-success d-flex flex-wrap align-items-end"><span class="fs-10 badge rounded-pill inqq_cunt bg-success mx-1">0</span>
                                                    <div class="align-baseline fs-12">connections</div>
                                                </div> -->
                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            0
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('email_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="M64 64h384v384H64z" style="" fill="#eceff1" data-original="#eceff1" class=""></path>
                                                        <path d="M256 296.384 448 448V148.672z" style="" fill="#cfd8dc" data-original="#cfd8dc"></path>
                                                        <path d="M464 64h-16L256 215.616 64 64H48C21.504 64 0 85.504 0 112v288c0 26.496 21.504 48 48 48h16V148.672l192 147.68L448 148.64V448h16c26.496 0 48-21.504 48-48V112c0-26.496-21.504-48-48-48z" style="" fill="#f44336" data-original="#f44336" class="">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Email</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">
                                                <!-- 
                                                <div class=" text-success d-flex flex-wrap align-items-end"><span class="fs-10 badge rounded-pill inqq_cunt bg-success mx-1">0</span>
                                                    <div class="align-baseline fs-12">connections</div>
                                                </div> -->
                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['emailcount'])) {
                                                                echo $result['emailcount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('linkedin_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                                                    <path fill="#0078d4" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5	V37z">
                                                    </path>
                                                    <path d="M30,37V26.901c0-1.689-0.819-2.698-2.192-2.698c-0.815,0-1.414,0.459-1.779,1.364	c-0.017,0.064-0.041,0.325-0.031,1.114L26,37h-7V18h7v1.061C27.022,18.356,28.275,18,29.738,18c4.547,0,7.261,3.093,7.261,8.274	L37,37H30z M11,37V18h3.457C12.454,18,11,16.528,11,14.499C11,12.472,12.478,11,14.514,11c2.012,0,3.445,1.431,3.486,3.479	C18,16.523,16.521,18,14.485,18H18v19H11z" opacity=".05"></path>
                                                    <path d="M30.5,36.5v-9.599c0-1.973-1.031-3.198-2.692-3.198c-1.295,0-1.935,0.912-2.243,1.677	c-0.082,0.199-0.071,0.989-0.067,1.326L25.5,36.5h-6v-18h6v1.638c0.795-0.823,2.075-1.638,4.238-1.638	c4.233,0,6.761,2.906,6.761,7.774L36.5,36.5H30.5z M11.5,36.5v-18h6v18H11.5z M14.457,17.5c-1.713,0-2.957-1.262-2.957-3.001	c0-1.738,1.268-2.999,3.014-2.999c1.724,0,2.951,1.229,2.986,2.989c0,1.749-1.268,3.011-3.015,3.011H14.457z" opacity=".07"></path>
                                                    <path fill="#fff" d="M12,19h5v17h-5V19z M14.485,17h-0.028C12.965,17,12,15.888,12,14.499C12,13.08,12.995,12,14.514,12	c1.521,0,2.458,1.08,2.486,2.499C17,15.887,16.035,17,14.485,17z M36,36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698	c-1.501,0-2.313,1.012-2.707,1.99C24.957,25.543,25,26.511,25,27v9h-5V19h5v2.616C25.721,20.5,26.85,19,29.738,19	c3.578,0,6.261,2.25,6.261,7.274L36,36L36,36z">
                                                    </path>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">LinkedIn</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">
                                                <!-- 
                                                <div class=" text-success d-flex flex-wrap align-items-end"><span class="fs-10 badge rounded-pill inqq_cunt bg-success mx-1">0</span>
                                                    <div class="align-baseline fs-12">connections</div>
                                                </div> -->
                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            0
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>


                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="45" height="45" viewBox="0 0 48 48">
                                                    <linearGradient id="PgB_UHa29h0TpFV_moJI9a_9a46bTk3awwI_gr1" x1="9.816" x2="41.246" y1="9.871" y2="41.301" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#f44f5a"></stop>
                                                        <stop offset=".443" stop-color="#ee3d4a"></stop>
                                                        <stop offset="1" stop-color="#e52030"></stop>
                                                    </linearGradient>
                                                    <path fill="url(#PgB_UHa29h0TpFV_moJI9a_9a46bTk3awwI_gr1)" d="M45.012,34.56c-0.439,2.24-2.304,3.947-4.608,4.267C36.783,39.36,30.748,40,23.945,40	c-6.693,0-12.728-0.64-16.459-1.173c-2.304-0.32-4.17-2.027-4.608-4.267C2.439,32.107,2,28.48,2,24s0.439-8.107,0.878-10.56	c0.439-2.24,2.304-3.947,4.608-4.267C11.107,8.64,17.142,8,23.945,8s12.728,0.64,16.459,1.173c2.304,0.32,4.17,2.027,4.608,4.267	C45.451,15.893,46,19.52,46,24C45.89,28.48,45.451,32.107,45.012,34.56z">
                                                    </path>
                                                    <path d="M32.352,22.44l-11.436-7.624c-0.577-0.385-1.314-0.421-1.925-0.093C18.38,15.05,18,15.683,18,16.376	v15.248c0,0.693,0.38,1.327,0.991,1.654c0.278,0.149,0.581,0.222,0.884,0.222c0.364,0,0.726-0.106,1.04-0.315l11.436-7.624	c0.523-0.349,0.835-0.932,0.835-1.56C33.187,23.372,32.874,22.789,32.352,22.44z" opacity=".05"></path>
                                                    <path d="M20.681,15.237l10.79,7.194c0.689,0.495,1.153,0.938,1.153,1.513c0,0.575-0.224,0.976-0.715,1.334	c-0.371,0.27-11.045,7.364-11.045,7.364c-0.901,0.604-2.364,0.476-2.364-1.499V16.744C18.5,14.739,20.084,14.839,20.681,15.237z" opacity=".07"></path>
                                                    <path fill="#fff" d="M19,31.568V16.433c0-0.743,0.828-1.187,1.447-0.774l11.352,7.568c0.553,0.368,0.553,1.18,0,1.549	l-11.352,7.568C19.828,32.755,19,32.312,19,31.568z">
                                                    </path>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">YouTube</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">
                                                <!-- 
                                                <div class=" text-success d-flex flex-wrap align-items-end"><span class="fs-10 badge rounded-pill inqq_cunt bg-success mx-1">0</span>
                                                    <div class="align-baseline fs-12">connections</div>
                                                </div> -->
                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            0
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                                                    <path fill="#2196f3" d="M8,38c0,1.657,1.343,3,3,3h13.975L8,24.025V38z"></path>
                                                    <path fill="#1e88e5" d="M8,16v8.025L24.975,41H38c1.657,0,3-1.343,3-3V16H8z"></path>
                                                    <path fill="#81acea" d="M14.75,19.12c0,2.7-2.18,4.88-4.88,4.88C7.18,24,5,21.82,5,19.12V19h9.74 C14.75,19.04,14.75,19.08,14.75,19.12z">
                                                    </path>
                                                    <path fill="#3f51b5" d="M24.5,19v0.12c0,2.7-2.18,4.88-4.88,4.88c-2.69,0-4.87-2.18-4.87-4.88c0-0.04,0-0.08,0.01-0.12H24.5 z">
                                                    </path>
                                                    <path fill="#81acea" d="M34.25,19.12c0,2.7-2.18,4.88-4.88,4.88c-2.69,0-4.87-2.18-4.87-4.88V19h9.74 C34.25,19.04,34.25,19.08,34.25,19.12z">
                                                    </path>
                                                    <path fill="#3f51b5" d="M44,19v0.12c0,2.7-2.18,4.88-4.88,4.88c-2.69,0-4.87-2.18-4.87-4.88c0-0.04,0-0.08,0.01-0.12H44z">
                                                    </path>
                                                    <path fill="#82b1ff" d="M9.562,7c-0.918,0-1.718,0.625-1.94,1.516L5.01,18.98C5,18.99,5,18.99,5,19h9.766l1.5-12H9.562z">
                                                    </path>
                                                    <polygon fill="#5c6bc0" points="16.266,7 14.766,19 24.5,19 24.5,7">
                                                    </polygon>
                                                    <path fill="#5c6bc0" d="M44,19c0-0.01,0-0.01-0.01-0.02L41.378,8.516C41.156,7.625,40.356,7,39.438,7h-6.703l1.5,12H44z">
                                                    </path>
                                                    <polygon fill="#82b1ff" points="32.735,7 24.5,7 24.5,19 34.235,19">
                                                    </polygon>
                                                    <path fill="#ededed" d="M33.649,38.299c-2.563,0-4.649-2.086-4.649-4.649S31.086,29,33.649,29 c1.072,0,2.119,0.374,2.947,1.054l-1.269,1.547C34.85,31.207,34.269,31,33.649,31C32.188,31,31,32.188,31,33.649 s1.188,2.649,2.649,2.649c1.107,0,2.058-0.683,2.453-1.649h-2.1v-2h4.296v1C38.298,36.213,36.213,38.299,33.649,38.299z">
                                                    </path>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Google My
                                                    Business</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">
                                                <!-- 
                                                <div class=" text-success d-flex flex-wrap align-items-end"><span class="fs-10 badge rounded-pill inqq_cunt bg-success mx-1">0</span>
                                                    <div class="align-baseline fs-12">connections</div>
                                                </div> -->
                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            0
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>


                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50">
                                                    <path d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z">
                                                    </path>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Twitter</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            0
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('website_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                                                        <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                                                        <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                                                        <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                                                        <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Website</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['websitecount'])) {
                                                                echo $result['websitecount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('justdail_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 588 154" style="height: 20px;width: 80px;" xml:space="preserve">
                                                    <style type="text/css">
                                                        .st0 {
                                                            fill: #1274C0;
                                                        }

                                                        .st1 {
                                                            fill: #FF6C00;
                                                        }
                                                    </style>
                                                    <g id="Guides_For_Artboard">
                                                    </g>
                                                    <g id="Layer_1">
                                                        <path class="st0" d="M267.4,136c0,9.1,5.8,15.2,14,15.2c8.2,0,14-6.1,14-15.2V59.1h8c7.2,0,13.4-3.4,13.4-12c0-8.7-6.2-12-13.4-12   h-8V18.8c0-9.1-5.8-15.2-14-15.2c-8.2,0-14,6.1-14,15.2v16.3h-6.2c-7,0-12.3,5.1-12.3,12c0,7.4,4.7,12,12.3,12h6.2V136L267.4,136z    M77.1,18.5c0-9.5-6.2-14.8-14.6-14.8c-8.4,0-14.6,5.3-14.6,14.8v91.7c0,6.1,0,16-10.9,16c-8.8,0-15.6-7-23.4-7   c-6.4,0-10.9,6.5-10.9,11.6c0,16.5,22.4,21.7,35.9,21.7c17.7,0,38.6-8.4,38.6-40.3V18.5L77.1,18.5z M84.9,112.4   c0,24.3,16.6,39.9,46.2,39.9c29.6,0,46.2-15.6,46.2-39.9V63c0-9.1-5.8-15.2-14-15.2c-8.2,0-14,6.1-14,15.2v48.8   c0,11.4-8.8,17.7-18.1,17.7c-9.4,0-18.1-6.3-18.1-17.7V63c0-9.1-5.8-15.2-14-15.2c-8.2,0-14,6.1-14,15.2V112.4L84.9,112.4z    M255.9,66.5c0,6.3-4.9,12.2-11.5,12.2c-5.3,0-16-8-25.1-8c-5.1,0-9.5,2.3-9.5,7.6c0,12.7,48.7,10.8,48.7,42   c0,18.2-15.8,32.2-39.9,32.2c-15.8,0-39.2-8.8-39.2-21.1c0-4.2,4.3-12.2,12.1-12.2c10.9,0,15.8,9.3,29,9.3c8.6,0,11.1-2.7,11.1-7.8   c0-12.5-48.7-10.6-48.7-42c0-19,15.8-31.9,38-31.9C234.7,46.7,255.9,53,255.9,66.5z"></path>
                                                        <path class="st1" d="M558.7,134.9c0,9.1,5.9,15.2,14.2,15.2c8.3,0,14.2-6.1,14.2-15.2V17.8c0-9.1-5.9-15.2-14.2-15.2   c-8.3,0-14.2,6.1-14.2,15.2V134.9L558.7,134.9z M409.9,17.8c0-9.1-5.9-15.2-14.2-15.2c-8.3,0-14.2,6.1-14.2,15.2V55   c-7.5-6.3-17.1-9.5-27-9.5c-30.5,0-45.7,27.6-45.7,54.2c0,25.8,18.1,51.5,46.7,51.5c9.7,0,20.7-4.2,26-12.6   c1.8,7.2,6.3,11.4,14.2,11.4c8.3,0,14.2-6.1,14.2-15.2V17.8L409.9,17.8z M381.5,97.6c0,13.3-6.7,28.5-22.3,28.5   c-14.8,0-22.1-14.8-22.1-27.6c0-12.9,7.3-27.9,22.1-27.9C374.4,70.6,381.5,84.3,381.5,97.6L381.5,97.6z M417.7,134.9   c0,9.1,5.9,15.2,14.2,15.2c8.3,0,14.2-6.1,14.2-15.2v-73c0-9.1-5.9-15.2-14.2-15.2c-8.3,0-14.2,6.1-14.2,15.2V134.9L417.7,134.9z    M431.9,5.6c-8.5,0-16,7.2-16,15c0,8.4,7.5,15.8,16,15.8c8.9,0,16-7.2,16-15.8C447.9,12.7,440.4,5.6,431.9,5.6L431.9,5.6z    M550.9,64.5c0-7,0-17.9-13.6-17.9c-6.9,0-12.8,4.8-13.6,11.4c-6.3-8.6-16.6-12.5-27-12.5c-26,0-46.9,23-46.9,53   c0,30.8,20.3,52.7,46.9,52.7c10.8,0,19.7-4.4,27-12.8c2,7.2,5.3,11.6,13.6,11.6c13.6,0,13.6-10.9,13.6-17.9V64.5L550.9,64.5z    M478.2,98.6c0-13.1,6.9-27.9,22.5-27.9c15,0,21.9,14.8,21.9,27.9s-7.1,27.6-21.9,27.6C485.3,126.1,478.2,111.7,478.2,98.6z"></path>
                                                    </g>
                                                </svg>
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Justdail</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['justdailcount'])) {
                                                                echo $result['justdailcount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('indiamart_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                            </div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                            <img src="<?= base_url(); ?>assets/images/websiteImage/indiamart.png" alt="" style="height: 50; width:50px;">
                                                <h5 class="text-center col-12 text-dark text-center mt-2">IndiaMart</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['indiamartcount'])) {
                                                                echo $result['indiamartcount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('magicbrick_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                            <img src="<?= base_url(); ?>assets/images/websiteImage/magicbrics.png" alt="" style="height: 45; width:100px;">
                                                <h5 class="text-center col-12 text-dark text-center mt-2">MagicBricks</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['magicbrickcount'])) {
                                                                echo $result['magicbrickcount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('softwaresuggest_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                            <img class="ms-4 ps-1" src="<?= base_url(); ?>assets/images/websiteImage/softwaresuggest.png" alt="" style="height: 35; width:110px;">
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Software Suggest</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['softwaresuggestcount'])) {
                                                                echo $result['softwaresuggestcount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('99acres_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <img src="<?= base_url(); ?>assets/images/websiteImage/99acress.png" alt="" style="height: 35; width:35px;">
                                                <h5 class="text-center col-12 text-dark text-center mt-2">99 acres</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['99acrescount'])) {
                                                                echo $result['99acrescount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('wordpress_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <img src="<?= base_url(); ?>assets/images/websiteImage/wordpress.png" alt="" style="height: 45; width:100px;">
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Wordpress</h5>
                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['wordpresscount'])) {
                                                                echo $result['wordpresscount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('tradeindia_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                            <img src="<?= base_url(); ?>assets/images/websiteImage/tradeindia.png" alt="" style="height: 45; width:100px;">
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Trade India.</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['tradeindiacount'])) {
                                                                echo $result['tradeindiacount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class=" d-flex justify-content-center col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                    <a href="<?= base_url('googleads_connection') ?>">
                                        <div class="col-9 bg-white border rounded-3 d-flex flex-wrap flex-column justify-content-between inti-card" style="width:200px;height:200px;">
                                            <div class="d-flex justify-content-end align-items-center" style="font-size:10px"></div>
                                            <div class=" col-12 d-inline-flex justify-content-center flex-wrap mt-3">
                                                <img src="<?= base_url(); ?>assets/images/websiteImage/googleads.png" alt="" style="height: 45; width:40px;">
                                                <h5 class="text-center col-12 text-dark text-center mt-2">Google Ads</h5>

                                            </div>
                                            <div class="d-flex  p-2 align-items-end justify-content-end" style="height: 40px;">

                                                <div class="d-flex justify-content-end align-items-center" style="font-size:10px">
                                                    <span class="fw-bold  text-success  rounded-pill">
                                                        <span class="badge rounded-pill inqq_cunt bg-success mx-1">
                                                            <?php
                                                            if (isset($result['googleadscount'])) {
                                                                echo $result['googleadscount'];
                                                            } else {
                                                                echo 0;
                                                            } ?>
                                                        </span>
                                                        connections
                                                    </span>
                                                </div>
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