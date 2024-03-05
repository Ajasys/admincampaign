<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<style>
    .load-icon {
        display: none;
    }

    .lead_list_img img {
        border-radius: 100%;
    }

    .load-icon span i {
        animation-name: loading;
        animation-duration: 1.5s;
        animation-iteration-count: infinite;
        animation-fill-mode: both;
    }

    .load-icon span:nth-of-type(2) i {
        animation-delay: .2s;
    }

    .load-icon span:nth-of-type(3) i {
        animation-delay: .4s;
    }

    .lead_list .shadow {
        display: none;
    }

    .load-icon span:nth-of-type(4) i {
        animation-delay: .6s;
    }

    @keyframes loading {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .all_circle_plus_list {
        width: 250px;
        z-index: 3;
    }

    .big_circle_plus_outer {
        z-index: 2;
    }

    .big_list_add_outer_main::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0%;
        left: 0%;
        border-radius: 50%;
        background-color: var(--all-white);
        transform: scale(1.1);
        z-index: 1;
    }

    .big_circle_plus::before,
    .big_circle_fb::before {
        content: "";
        position: absolute;
        bottom: -4px;
        background: rgb(43, 42, 42);
        width: 90%;
        height: 11px;
        left: 3%;
        border-radius: 50%;
        filter: blur(19px);
        z-index: 1;
    }

    .big_circle_plus::after,
    .big_circle_fb::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0%;
        top: 0%;
        border-radius: 50%;
        background-color: var(--first-color);
        opacity: 0.5;
        z-index: 0;
        transition: 0.2s;
    }

    .big_circle_plus:hover::after,
    .big_circle_plus:focus::after,
    .big_circle_fb:hover::after,
    .big_circle_fb:focus::after {
        transform: scale(1.1);
    }

    .all_circle_plus_list::after {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        transform: rotate(45deg)translateY(-50%);
        top: 50%;
        right: 99%;
        background-color: var(--all-white);
    }

    

    .big_circle_fb::after {
        background-color: #1876ef;
    }

    .big_circle_fb_inner {
        background-color: #1876ef;
        box-shadow: inset 0 0 15px 0 #24242469;
    }

    .big_circle_fb::after {
        z-index: 1;
    }

    .big_circle_fb_inner {
        z-index: 2;
    }

    .big_circle_fb_inner {
        width: 176px;
        height: 176px;
    }
    .svg-plus{
        top:50%; left:100%;
    }

@media (max-width:576px){
    .svg-plus{
        top: 140%;
    left: -36%;
    }
    .all_circle_plus_list::after {
        top: 0%;
        right: 50%;
        
    }
}
</style>

<?php
// pre($_COOKIE);
$table_username = session_username($_SESSION['username']);
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_asset_permission = array();
} else {
    $get_asset_permission = get_asset_permission($_SESSION['id']);
    if (!in_array('create_scenarios', $get_asset_permission) || !in_array('leads', $get_asset_permission)) {
        header('Location:' . base_url('logout') . '');
    }
}
$product = json_decode($product, true);
$this->db = \Config\Database::connect('second');
$conn_query = "SELECT * FROM " . $table_username . "_platform_integration Where master_id=" . $_SESSION['master'] . " AND platform_status=2 AND verification_status=1";
$conn_result = $this->db->query($conn_query);
$conn_rows = $conn_result->getResultArray();

$webconn_query = "SELECT * FROM " . $table_username . "_platform_integration Where master_id=" . $_SESSION['master'] . " AND platform_status=5  AND verification_status=1";
$webconn_result = $this->db->query($webconn_query);
$webconn_rows = $webconn_result->getResultArray();

$user_get = "SELECT * FROM " . $table_username . "_user WHERE switcher_active = 'active' ORDER BY id ASC";
$user_result = $this->db->query($user_get);
$user_data = $user_result->getResultArray();
?>
<div class="main-dashbord p-2">
    <div class="container-fluid">
        <div class="p-3 bg-white rounded-2 m-2 border border-1">
            <div class="title-2">
                <h2>Integration Scenarios</h2>
            </div>

            <div class="col-12">
                <div class="p-3">
                    <?php
                    if ((in_array('create_scenarios', $get_asset_permission)) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                    ?>
                        <div class="p-2">
                            <div class="d-flex justify-content-between">
                                <button class="btn-primary-rounded lead_main_box_add ">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <form class="needs-validation" name="pagelist" method="POST" novalidate="">
                            <input type="hidden" id="platform_status" name="platform_status" value="">
                            <div class="lead_add_main_box px-3 py-5 bg-white rounded-2 mx-2 mb-2 position-relative" style="display: none;">

                                <i class="fa-solid fa-angle-left position-absolute top-0 start-0 translate-middle m-4 fs-4 text-secondary-emphasis cursor-pointer discard-tag" data-bs-toggle="modal" data-bs-target="#discard_main_box"></i>

                                <!--updated ka code  -->
                                <div class="d-flex justify-content-md-center justify-content-start align-items-center gap-3 py-4">

                                    <div class="big_list_add_outer_main big_list_add_outer_main_1 position-relative">

                                        <div class="big_circle_plus_outer position-relative">
                                            <div class="big_circle_plus cursor-pointer">
                                                <div class="big_circle_plus_inner bg-primary p-5 rounded-circle position-relative">
                                                    <div class="z-2 position-relative">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="80" height="80" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="z-2">
                                                            <g>
                                                                <path d="M492 236H276V20c0-11.046-8.954-20-20-20s-20 8.954-20 20v216H20c-11.046 0-20 8.954-20 20s8.954 20 20 20h216v216c0 11.046 8.954 20 20 20s20-8.954 20-20V276h216c11.046 0 20-8.954 20-20s-8.954-20-20-20z" fill="#ffffff" data-original="#000000" class="" opacity="1"></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="big_circle_plus_list all_circle_plus_list bg-white border-0 rounded-2 shadow position-absolute py-2 ms-3 translate-middle-y svg-plus" >
                                                <ul class="position-relative px-3">
                                                    <li class="py-1">
                                                        <a class="dropdown-item cursor-pointer" id="facebook_lead_drop_1" data-type="2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 1643 1643" fill="none" class="me-2">
                                                                <path d="M1643 823.999C1643 370.808 1275.19 3 822 3C368.808 3 1 370.808 1 823.999C1 1221.36 283.424 1552.22 657.8 1628.58V1070.3H493.6V823.999H657.8V618.749C657.8 460.296 786.697 331.4 945.15 331.4H1150.4V577.699H986.2C941.045 577.699 904.1 614.644 904.1 659.799V823.999H1150.4V1070.3H904.1V1640.89C1318.7 1599.84 1643 1250.1 1643 823.999Z" fill="#0D6AE2"></path>
                                                            </svg>
                                                            <span>Facebook Leads</span>
                                                        </a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a class="dropdown-item cursor-pointer" id="website_lead" data-type="5">
                                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                                <g>
                                                                    <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                                                                    <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                                                                    <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                                                                    <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                                                                    <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                                                </g>
                                                            </svg>
                                                            <span> Website Lead Setting</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="big_circle_fb_outer position-relative logo-1">
                                            <div class="big_circle_fb cursor-pointer">
                                                <div class="big_circle_fb_inner p-5 rounded-circle position-relative profile_div">

                                                    <div class="z-2 position-relative fb_div_hide">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="80" height="80" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                            <g>
                                                                <path fill-rule="evenodd" d="M255.182 7.758q69.23.79 125.086 34.03a249.734 249.734 0 0 1 88.89 89.434q33.037 56.191 33.825 125.843-1.962 95.3-60.117 162.79c-38.77 44.995-88.425 72.83-139.827 83.501V325.23h48.597l10.99-70h-73.587v-45.848a39.844 39.844 0 0 1 8.474-26.323q8.827-11.253 31.09-11.829h44.436v-61.318q-.957-.308-18.15-2.434a360.743 360.743 0 0 0-39.16-2.434q-44.433.205-70.281 25.068-25.85 24.855-26.409 71.92v53.198h-56v70h56v178.127c-63.115-10.67-112.77-38.506-151.54-83.5S8.691 320.598 7.383 257.065q.785-69.655 33.824-125.843a249.739 249.739 0 0 1 88.891-89.435q55.854-33.233 125.084-34.03z" fill="#ffffff" data-original="#000000" opacity="1" class=""></path>
                                                            </g>
                                                        </svg>
                                                    </div>

                                                    <!-- <img src="https://ajasys.com/img/favicon.png" class="w-100 h-100 object-fit-contain rounded-circle"> -->
                                                </div>
                                            </div>
                                            <div class="big_circle_fb_list all_circle_plus_list bg-white border-0 rounded-2 shadow position-absolute py-2 px-3 ms-3 top-50 start-100 translate-middle-y">
                                                <?php if (isset($fb_account) && !empty($fb_account)) { ?>
                                                    <label class="form-label main-label fs-14 text-nowrap mb-2">Connection
                                                        Name</label>
                                                    <div class="main-selectpicker">
                                                        <select id="user_agent" class="selectpicker form-control form-main user_agent" data-live-search="true">
                                                            <?php foreach ($fb_account as $key => $value) {
                                                                echo "<option value=" . $value['accessToken'] . " data-user_id=" . $value['userid'] . " data-username='" . $value['username'] . "'>" . $value['username'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="text-end mt-3 fb_user_next">
                                                        <button class="btn-primary big_falcebook_circle_sbt" data-master_id=<?php if (isset($fb_account[0]['master_id'])) {
                                                                                                                                echo $fb_account[0]['master_id'];
                                                                                                                            } ?>>Next</button>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="text-end mt-2">
                                                        <fb:login-button onlogin="myFacebookLogin();"></fb:login-button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <h6 class="position-absolute top-100 start-50 translate-middle text-nowrap mt-4">
                                                <b>Facebook Lead Connection</b>
                                            </h6>
                                        </div>

                                        <div class="add_next_big_plus_outer position-absolute ms-3 top-50 start-100 translate-middle-y">
                                            <div class="btn-primary-rounded add_next_big_plus_1">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- ===========facebook-way======= -->
                                    <div class="big_list_add_outer_main big_list_add_outer_main_2 position-relative">
                                        <div class="big_circle_fb_outer position-relative">
                                            <div class="big_circle_fb cursor-pointer">
                                                <div class="big_circle_fb_inner p-5 rounded-circle position-relative page-profile">
                                                    <div class="z-2 position-relative fb_div_hide1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="80" height="80" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                            <g>
                                                                <path fill-rule="evenodd" d="M255.182 7.758q69.23.79 125.086 34.03a249.734 249.734 0 0 1 88.89 89.434q33.037 56.191 33.825 125.843-1.962 95.3-60.117 162.79c-38.77 44.995-88.425 72.83-139.827 83.501V325.23h48.597l10.99-70h-73.587v-45.848a39.844 39.844 0 0 1 8.474-26.323q8.827-11.253 31.09-11.829h44.436v-61.318q-.957-.308-18.15-2.434a360.743 360.743 0 0 0-39.16-2.434q-44.433.205-70.281 25.068-25.85 24.855-26.409 71.92v53.198h-56v70h56v178.127c-63.115-10.67-112.77-38.506-151.54-83.5S8.691 320.598 7.383 257.065q.785-69.655 33.824-125.843a249.739 249.739 0 0 1 88.891-89.435q55.854-33.233 125.084-34.03z" fill="#ffffff" data-original="#000000" opacity="1" class=""></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="big_circle_fb_list all_circle_plus_list bg-white border-0 rounded-2 shadow position-absolute py-2 px-3 ms-3 top-50 start-100 translate-middle-y">
                                                <form>
                                                    <label class="form-label main-label fs-14 text-nowrap mb-2">Connection
                                                        Name</label>
                                                    <div class="main-selectpicker">
                                                        <select id="fb_conn_id" class="selectpicker form-control form-main fb_conn_id" required>
                                                            <option value="">select Connection</option>
                                                            <?php foreach ($conn_rows as $key => $value) {
                                                                echo "<option value=" . $value['id'] . "  data-access-token=" . $value['access_token'] . " data-connection-check=" . $value['verification_status'] . ">" . $value['fb_app_name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="d-flex mt-2 justify-content-between">
                                                        <div>
                                                            <label class="form-label main-label fs-14 text-nowrap">Page</label><sup class="validationn">*</sup>
                                                        </div>
                                                        <div>
                                                            <i class="fa fa-refresh text-success page-referesh" aria-hidden="true"></i>
                                                        </div>
                                                    </div>



                                                    <div class="main-selectpicker">
                                                        <select id="facebookpages" class="selectpicker form-control form-main" data-live-search="true" required>
                                                            <option value="">select Page</option>
                                                        </select>
                                                    </div>

                                                    <label class="form-label main-label fs-14 text-nowrap">Form</label><sup class="validationn">*</sup>
                                                    <div class="main-selectpicker">
                                                        <select id="facebookform" class="selectpicker form-control form-main" data-live-search="true" required>
                                                            <option value="">select Form</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-end mt-3 page_frm_save">
                                                        <button class="btn-primary d-inline-block big_falcebook_circle_2_sbt" edit-id="">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <h6 class="position-absolute top-100 start-50 translate-middle text-nowrap mt-4">
                                                <b>Facebook Pages & Forms</b>
                                            </h6>
                                        </div>
                                        <div class="add_next_big_plus_outer position-absolute ms-3 top-50 start-100 translate-middle-y">
                                            <div class="btn-primary-rounded add_next_big_plus_2">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ===========website-way======== -->
                                    <div class="big_list_add_outer_main big_list_add_outer_main_4 position-relative">
                                        <div class="big_circle_fb_outer position-relative">
                                            <div class="big_circle_fb cursor-pointer">
                                                <div class="big_circle_fb_inner p-5 rounded-circle position-relative page-profile d-flex align-items-center justify-content-center p-0">
                                                    <div class="z-2 position-relative fb_div_hide1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="85" height="85" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                            <g>
                                                                <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                                                                <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                                                                <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                                                                <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                                                                <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="big_circle_fb_list all_circle_plus_list all_circle_plus_list1 bg-white border-0 rounded-2 shadow position-absolute py-2 px-3 ms-3 top-50 start-100 translate-middle-y">
                                                <form>
                                                    <!-- <div class="col-12">
                                                    <label class="form-label main-label fs-14 text-nowrap mt-3">Website URL <sup class="validationn">*</sup></label>
                                                    <input type="url" class="form-control main-control" name="website_url" placeholder="Enter your website URL" id="website_url" required>
                                                </div> -->
                                                    <label class="form-label main-label fs-14 text-nowrap mb-2">Connection
                                                        Name</label>
                                                    <div class="main-selectpicker">
                                                        <select id="web_conn_id" class="selectpicker form-control form-main web_conn_id" required>
                                                            <option value="">select Connection</option>
                                                            <?php foreach ($webconn_rows as $key => $value) {
                                                                echo "<option value=" . $value['id'] . "  data-access-token=" . $value['access_token'] . " data-connection-check=" . $value['verification_status'] . ">" . $value['website_name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 webDiv">
                                                        <label class="form-label main-label fs-14 text-nowrap d-flex justify-content-between"><span>API</span>
                                                            <!-- <a class="btn-primary rounded-circle border border-secondary fs-10 p-1 px-2" data-toggle="tooltip" data-placement="top" title="API Document" href="<?php echo base_url(); ?>assets/document/WebsiteAPIDocument.pdf" download><i class="fa-solid fa-arrow-down"></i></a> -->
                                                        </label>
                                                        <textarea id="web_api" rows="3" class="form-control form-main" placeholder="" readonly>curl -X POST -d  "<?php echo base_url(); ?>web_integrate?name=<name_value>&mobileno=<mobileno_value>&email=<email_value>&description=<description_value>&access_token=<access_token_value>"</textarea>
                                                    </div>
                                                    <div class="col-12 webDiv">
                                                        <label class="form-label main-label fs-14 text-nowrap">Access Token</label>
                                                        <textarea id="web_token" rows="3" class="form-control form-main" placeholder="" readonly></textarea>
                                                    </div>

                                                    <div class="text-end mt-3 page_frm_save">
                                                        <button class="btn-primary d-inline-block big_falcebook_circle_2_sbt" edit-id="">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <h6 class="position-absolute top-100 start-50 translate-middle text-nowrap mt-4">
                                                <b>Website Connection</b>
                                            </h6>
                                        </div>
                                        <div class="add_next_big_plus_outer position-absolute ms-3 top-50 start-100 translate-middle-y">
                                            <div class="btn-primary-rounded add_next_big_plus_2">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lead_module_devider lead_module_devider_2"></div>
                                    <div class="big_list_add_outer_main big_list_add_outer_main_3 position-relative">
                                        <div class="big_circle_fb_outer position-relative">
                                            <div class="big_circle_fb after-none cursor-pointer">
                                                <div class="big_circle_fb_inner bg-white shadow-none p-5 rounded-circle position-relative">
                                                    <div class="position-relative">
                                                        <img src="https://ajasys.com/img/favicon.png" alt="" width="80">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="big_circle_fb_list all_circle_plus_list bg-white border-0 rounded-2 shadow position-absolute py-2 px-3 ms-3 top-50 start-100 translate-middle-y">

                                                <label class="form-label main-label fs-14 text-nowrap mt-2">Interested Product</label> <sup class="validationn">*</sup>
                                                <div class="main-selectpicker">
                                                    <select id="product" class="selectpicker form-control form-main product" data-live-search="true" required>
                                                        <option value="0">Select Interested Product</option>
                                                        <?php
                                                        if (isset($product)) {
                                                            foreach ($product as $product_key => $product_value) {
                                                                echo '<option data-product_option_id="' . $product_value["id"] . '" value="' . $product_value["id"] . '">' . $product_value["product_name"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <label class="form-label main-label fs-14 text-nowrap mt-2">Assign
                                                    to <sup class="validationn">*</sup></label>
                                                <div class="main-selectpicker">
                                                    <select id="assign_to" class="selectpicker form-control form-main assign_to" data-live-search="true" required>
                                                        <option class="dropdown-item" data-sourcetype_name="employee" value="0">Roll Over Staff
                                                        </option>
                                                        <option class="dropdown-item" data-sourcetype_name="employee" value="1">Assign To Staff
                                                        </option>
                                                    </select>
                                                </div>

                                                <label class="form-label main-label fs-14 text-nowrap mt-2 staff">Staff<sup class="validationn">*</sup></label>
                                                <div class="main-selectpicker multiple-select staff">
                                                    <select class="selectpicker form-control form-main staff_to" multiple id="staff_to" name="staff_to" data-live-search="true" required>
                                                        <?php
                                                        if (isset($user_data)) {
                                                            foreach ($user_data as $type_key => $user_value) {
                                                                echo '<option class="dropdown-item" value="' . $user_value["id"] . '" >' . $user_value["firstname"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="text-end mt-3">
                                                    <button class="btn-primary big_falcebook_circle_4_sbt">Save</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="add_next_big_plus_outer position-absolute ms-3 top-50 start-100 translate-middle-y">
                                            <div class="btn-primary-rounded add_next_big_plus_2">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>

                    <?php
                    if ((in_array('leads', $get_asset_permission)) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                    ?>
                        <div class="p-2 bg-white rounded-2 mx-2 pages_list">
                        </div>
                    <?php
                    }
                    if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
                    ?>
                        <div class="delete_div">
                            <div class="border-bottom m-3"></div>
                            <div class="p-2 bg-white rounded-2 mx-2">
                                <div class="mb-2">
                                    <h2 class="fs-14 text-gray">Recently deleted</h2>
                                </div>
                                <div class="deleted_pages_list"></div>
                            </div>
                        </div>

                        <div class="update_div">
                            <div class="border-bottom m-3"></div>
                            <div class="p-2 bg-white rounded-2 mx-2">
                                <div class="mb-2">
                                    <h2 class="fs-14 text-gray">Before updated Form</h2>
                                </div>
                                <div class="updated_pages_list"></div>
                            </div>
                        </div>

                        <div class="draft_div">
                            <div class="border-bottom m-3"></div>
                            <div class="p-2 bg-white rounded-2 mx-2">
                                <div class="mb-2">
                                    <h2 class="fs-14 text-gray">Saved Drafts</h2>
                                </div>
                                <div class="draft_pages_list"></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="discard_main_box" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 300px;">
        <div class="modal-content">
            <div class="modal-footer justify-content-evenly border-0">
                <button type="button" class="btn-secondary bg-danger border-0 text-white discard_main_box" data-bs-dismiss="modal">Discard</button>
                <button type="button" class="btn-secondary bg-primary border-0 text-white draft_main_box" data-bs-dismiss="modal">Draft</button>
                <button type="button" class="btn-secondary bg-success" data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    $(document).ready(function() {

        // $.ajax({
        //     type: "post",
        //     url: "<?= site_url('web_integrate'); ?>",
        //     data: '',
        //     success: function (res) {

        //     },
        //     error: function (error) {
        //         $('.loader').hide();
        //     }
        // });

        $(".lead_add_main_box,.delete_div,.update_div,.draft_div,.staff,.webDiv").hide();

        $('body').on('click', '.discard_main_box', function() {
            $(".lead_module_devider , .big_circle_plus_outer , .all_circle_plus_list , .big_circle_fb_outer , .add_next_big_plus_outer").hide();
            $(".big_list_add_outer_main_2 .all_circle_plus_list , .big_list_add_outer_main_3 .all_circle_plus_list , .big_list_add_outer_main_1 , .big_list_add_outer_main_1 .big_circle_plus_outer").show();
            discard_page();
        });

        $('body').on('click', '.draft_main_box', function() {
            $(".lead_module_devider , .big_circle_plus_outer , .all_circle_plus_list , .big_circle_fb_outer , .add_next_big_plus_outer").hide();
            $(".big_list_add_outer_main_2 .all_circle_plus_list , .big_list_add_outer_main_3 .all_circle_plus_list , .big_list_add_outer_main_1 , .big_list_add_outer_main_1 .big_circle_plus_outer").show();
            draft_pages_list_data();
        });

        // $('body').on('click', '.lead_main_box_add', function() {
        //     $(".lead_add_main_box").show();
        //     $(".add_next_big_plus_outer").hide();
        // });

        $('body').on('click', '.lead_main_box_add', function() {
            $(".lead_module_devider , .big_circle_plus_outer , .all_circle_plus_list , .big_circle_fb_outer , .add_next_big_plus_outer").hide();
            $(".lead_add_main_box,.big_list_add_outer_main_2 .all_circle_plus_list , .big_list_add_outer_main_3 .all_circle_plus_list , .big_list_add_outer_main_1 , .big_list_add_outer_main_1 .big_circle_plus_outer").show();
            $('.discard-tag').show();

        });

        $(".big_list_add_outer_main").hide();
        $(".big_list_add_outer_main_1").show();

        $(".big_circle_plus_list").hide();

        $('body').on('click', '.big_circle_plus', function() {
            $(this).closest(".big_circle_plus_outer").find(".big_circle_plus_list").toggle();
        });

        $('body').on('click', '.big_circle_fb', function() {
            $(this).closest(".big_circle_fb_outer").find(".big_circle_fb_list").toggle();
            $(this).closest(".big_circle_fb_outer").closest('.big_list_add_outer_main').siblings().find('.big_circle_fb_list').slideUp();
        });

        $(".big_circle_fb_outer").hide();
        // $(".add_next_big_plus_outer").hide();

        $('body').on('click', '#facebook_lead_drop_1', function() {
            $(this).closest(".big_circle_plus_outer").hide();
            $(".big_list_add_outer_main_2").show();
            $(".big_list_add_outer_main_2 .big_circle_fb_outer").show();
            $('#platform_status').val(2);
        });
        // =========websiet============
        $('body').on('click', '#website_lead', function() {
            $(this).closest(".big_circle_plus_outer").hide();
            $(".big_list_add_outer_main_4").show();
            $(".big_list_add_outer_main_4 .big_circle_fb_outer").show();
            $(".all_circle_plus_list1").show();
            $('#platform_status').val(5);
        });

        $('body').on('change', '#fb_conn_id', function() {
            var fb_access_token = $(this).find(':selected').data('access-token');
            var fb_check_conn = $(this).find(':selected').data('connection-check');
            var connection_id = $(this).find(':selected').val();
            if (fb_access_token != '') {
                getPagesList(fb_access_token, fb_check_conn, connection_id);
            } else {
                iziToast.error({
                    title: 'Please select your connection..!'
                });
            }
        });

        $('body').on('click', '.fb_user_next .btn-primary', function() {
            if ($(this).closest(".big_circle_fb_list").find("#user_agent").val() != "") {
                // $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").show();
                $(this).closest(".big_circle_fb_outer").find(".big_circle_fb_list").hide();
                $(".lead_module_devider , .big_list_add_outer_main_2 , .big_list_add_outer_main_3").hide();
                $(".big_list_add_outer_main_2 .all_circle_plus_list , .big_list_add_outer_main_3 .all_circle_plus_list").show();
            } else {
                $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").hide();
            }
        });

        $(".lead_module_devider").hide();

        $('body').on('click', '.add_next_big_plus_1', function() {
            $(this).closest(".add_next_big_plus_outer").hide();
            $(".lead_module_devider_1").show();
            $(".big_list_add_outer_main_2").show();
            $(".big_list_add_outer_main_2 .big_circle_fb_outer").show();
        });

        $('body').on('click', '.page_frm_save .btn-primary', function() {
            if ($(this).closest(".big_circle_fb_list").find("#facebookpages").val() != "" && $(this).closest(".big_circle_fb_list").find("#facebookform").val() != "") {
                // $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").show();
                // $(this).closest(".big_circle_fb_outer").find(".big_circle_fb_list").hide();
                $(".lead_module_devider_2 , .big_list_add_outer_main_3 , .big_list_add_outer_main_3 .all_circle_plus_list").hide();
                $(".big_list_add_outer_main_3 .all_circle_plus_list").show();
            } else {
                $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").hide();
            }
        });

        $('body').on('click', '.add_next_big_plus_2', function() {
            $(this).closest(".add_next_big_plus_outer").hide();
            $(".lead_module_devider_2").show();
            $(".big_list_add_outer_main_3").show();
            $(".big_list_add_outer_main_3 .big_circle_fb_outer").show();
        });


        $('body').on('click', '.big_falcebook_circle_4_sbt .btn-primary', function() {
            if ($(this).closest(".big_circle_fb_list").find("#product").val() != "" && $(this).closest(".big_circle_fb_list").find("#sub_type").val() != "" && $(this).closest(".big_circle_fb_list").find("#assign_to").val() != "") {
                $(this).closest(".big_circle_fb_outer").find(".big_circle_fb_list").hide();
            } else {
                $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").hide();
            }
        });

    });

    $(".date").bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        cancelText: 'cancel',
        okText: 'ok',
        clearText: 'clear',
        time: false,
    });
</script>

<script>
    function pages_list_data() {
        $.ajax({
            type: "post",
            url: "<?= site_url('pages_list_data'); ?>",
            data: {
                action: 'pages_list_data',
            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                $('.pages_list').html(result.pages_list);
                $('.selectpicker').selectpicker('refresh');
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }

    function deleted_pages_list_data() {
        $.ajax({
            type: "post",
            url: "<?= site_url('deleted_pages_list_data'); ?>",
            data: {
                action: 'deleted_pages_list_data',
            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                if (result.pages_list_status == 1) {
                    $('.delete_div').show();
                    $('.deleted_pages_list').html(result.pages_list);
                    $('.selectpicker').selectpicker('refresh');
                }
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }

    function updated_pages_list_data() {
        $.ajax({
            type: "post",
            url: "<?= site_url('updated_pages_list_data'); ?>",
            data: {
                action: 'updated_pages_list_data',
            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                if (result.pages_list_status == 1) {
                    $('.update_div').show();
                    $('.updated_pages_list').html(result.pages_list);
                    $('.selectpicker').selectpicker('refresh');
                }
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }

    function draft_pages_list_data() {
        $.ajax({
            type: "post",
            url: "<?= site_url('draft_pages_list_data'); ?>",
            data: {
                action: 'draft_pages_list_data',

            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                if (result.pages_list_status == 1) {
                    $('.draft_div').show();
                    $('.draft_pages_list').html(result.pages_list);
                    $('.selectpicker').selectpicker('refresh');
                }
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }

    pages_list_data();
    deleted_pages_list_data();
    updated_pages_list_data();
    draft_pages_list_data();


    $('body').on('click', '.big_falcebook_circle_sbt,.new_module_add_btn1', function() {
        $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").show();
        return false;
    });

    $('body').on('click', '.page_actiive', function() {
        $(".shadow").hide();
        if ($(this).is(':checked')) {
            var status = 1;
            $(this).closest(".lead_list_switch ").find(".shadow").show();
        } else {
            var status = 0;
        }
        var form_id = $(this).attr('data-form_id');
        $.ajax({
            type: "post",
            url: "<?= site_url('facebook_page'); ?>",
            data: {
                action: 'page_update',
                form_id: form_id,
                status: status,
            },
            success: function(res) {
                var result = JSON.parse(res);
                pages_list_data();
                iziToast.success({
                    title: result.msg,
                });
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    });

    $('body').on('click', '.queue_list', function() {
        $(this).closest(".lead_list").find(".load-icon").show();

        var form_id = $(this).attr("data-form_id");
        if (form_id != '') {
            $.ajax({
                type: "post",
                url: "<?= site_url('queue_list_add'); ?>",
                data: {
                    action: 'list_add',
                    form_id: form_id,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.response == 1) {
                        iziToast.success({
                            title: result.message,
                        });
                        pages_list_data();

                        $(this).closest(".lead_list").find(".load-icon").show();
                    } else {
                        iziToast.error({
                            title: result.message,
                        });
                        $(this).closest(".lead_list").find(".load-icon").hide();
                    }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
        }
    });

    $('body').on('click', '.cancle', function() {
        $(this).closest(".lead_list ").find(".shadow").hide();
    });

    $('body').on('click', '.facebookpages .dropdown-menu.inner.show , .facebookform .dropdown-menu.inner.show', function() {
        function hgdfchduchdshcha() {
            $("#big_falcebook_circle_2").click();
        }
        setTimeout(hgdfchduchdshcha, 1);
    });

    $('body').on('click', '.area .dropdown-menu.inner.show , .int_site .dropdown-menu.inner.show , .sub_type .dropdown-menu.inner.show , .assign_to .dropdown-menu.inner.show', function() {
        function hgdfchduchdshcha() {
            $("#big_falcebook_circle_4").click();
        }
        setTimeout(hgdfchduchdshcha, 1);
    });

    $('body').on('change', '#facebookpages', function() {
        var page_id = $(this).val();
        var access_token = $(this).find("option:selected").attr("data-access_token");
        var form_name = $(this).find("option:selected").text();
        var page_name = $(this).attr("data-page_name");
        getFormsList(access_token, page_id);
    });

    $('body').on('change', '#assign_to', function() {
        $('.staff').hide();
        if ($(this).val() == 1) {
            $('.staff').show();
        }
    });

    //for save connection and all functionality...
    $('body').on('click', '.big_falcebook_circle_4_sbt', function() {
        var platform_status = $('#platform_status').val();
        if (platform_status == 2) {
            var connection_id = $("#fb_conn_id option:selected").val();
            var site_url = '<?= site_url('facebook_page'); ?>';
        } else if (platform_status == 5) {
            var connection_id = $("#web_conn_id option:selected").val();
            var site_url = '<?= site_url('website_connectionpage'); ?>';
        }
        var int_product = $(".product option:selected").val();
        var sub_type = $(".sub_type option:selected").val();
        var assign_to = $(".assign_to option:selected").val();
        var staff_to = $("#staff_to").val();
        var staff_to = staff_to.join(',');
        if (assign_to == 1) {
            var chk = staff_to;
        } else {
            var chk = assign_to;
        }

        var page_id = $("#facebookpages option:selected").val();
        var access_token = $("#facebookpages").find("option:selected").attr("data-access_token");
        var page_name = $("#facebookpages").find("option:selected").attr("data-page_name");
        var form_id = $("#facebookform option:selected").val();
        var form_name = $("#facebookform option:selected").text();
        var edit_id = $(this).attr('edit_id');

        if (assign_to != "" && int_product > 0 && chk != '') {
            $.ajax({
                type: "post",
                url: site_url,
                data: {
                    action: 'page',
                    platform_status: platform_status,
                    connection_id: connection_id,
                    page_id: page_id,
                    access_token: access_token,
                    page_name: page_name,
                    int_product: int_product,
                    sub_type: sub_type,
                    assign_to: assign_to,
                    staff_to: staff_to,
                    form_name: form_name,
                    form_id: form_id,
                    edit_id: edit_id,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.respoance == 1) {
                        location.reload();
                        iziToast.success({
                            title: result.msg,
                        });
                    } else {
                        location.reload();
                        iziToast.error({
                            title: result.msg,
                        });
                    }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
            return false;
        } else {
            var form = $("form[name='pagelist']")[0];
            $(form).find('.selectpicker').each(function() {
                var selectpicker_valid = 0;
                if ($(this).attr('required') == 'undefined') {
                    var selectpicker_valid = 0;
                }
                if ($(this).attr('required') == 'required') {
                    var selectpicker_valid = 1;
                }
                if (selectpicker_valid == 1) {
                    if ($(this).val() == 0 || $(this).val() == '') {
                        $(this).closest("div").addClass('selectpicker-validation');
                    } else {
                        $(this).closest("div").removeClass('selectpicker-validation');
                    }
                } else {
                    $(this).closest("div").removeClass('selectpicker-validation');
                }
            });
            return false;
        }

    });

    //save as draft and all save also
    $('body').on('click', '.big_falcebook_circle_2_sbt', function() {
        $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").hide();
        var platform_status = $('#platform_status').val();
        if (platform_status == 2) {
            var connection_id = $("#fb_conn_id option:selected").val();
            var int_product = $(".product option:selected").val();
            var sub_type = $(".sub_type option:selected").val();
            var assign_to = $(".assign_to option:selected").val();
            var page_id = $("#facebookpages option:selected").val();
            var access_token = $("#facebookpages").find("option:selected").attr("data-access_token");
            var page_name = $("#facebookpages").find("option:selected").attr("data-page_name");
            var form_id = $("#facebookform option:selected").val();
            var form_name = $("#facebookform option:selected").text();
            var edit_id = $(this).attr('edit_id');
            if (int_product > 0 && assign_to != "" && page_id != "" && form_id != "") {
                var draft_status = 0;
            } else {
                var draft_status = 3;
            }
            if (connection_id > 0 && page_id > 0 && form_id > 0) {
                $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('facebook_page'); ?>",
                    data: {
                        action: 'page',
                        platform_status: platform_status,
                        connection_id: connection_id,
                        page_id: page_id,
                        access_token: access_token,
                        page_name: page_name,
                        int_product: int_product,
                        sub_type: sub_type,
                        assign_to: assign_to,
                        form_name: form_name,
                        form_id: form_id,
                        edit_id: edit_id,
                        is_status: draft_status,
                    },
                    success: function(res) {
                        var result = JSON.parse(res);
                        $('.discard_main_box').val(result.id);
                        $('.fb_div_hide1').hide();
                        if (result.page_profile) {
                            $('.page-profile').html('<img src="' + result.page_profile + '" class="w-100 h-100 object-fit-contain rounded-circle">');
                        }
                        $(".big_list_add_outer_main_2 .all_circle_plus_list").hide();
                        if (result.respoance == 1) {
                            // iziToast.success({
                            //     title: result.msg,
                            // });
                        } else {
                            iziToast.error({
                                title: result.msg,
                            });
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();
                    }
                });
                return false;
            } else {
                var form = $("form[name='pagelist']")[0];
                $(form).find('.selectpicker').each(function() {
                    var selectpicker_valid = 0;
                    if ($(this).attr('required') == 'undefined') {
                        var selectpicker_valid = 0;
                    }
                    if ($(this).attr('required') == 'required') {
                        var selectpicker_valid = 1;
                    }
                    if (selectpicker_valid == 1) {
                        if ($(this).val() == 0 || $(this).val() == '') {
                            $(this).closest("div").addClass('selectpicker-validation');
                        } else {
                            $(this).closest("div").removeClass('selectpicker-validation');
                        }
                    } else {
                        $(this).closest("div").removeClass('selectpicker-validation');
                    }
                });
                return false;
            }
        } else if (platform_status == 5) {
            var connection_id = $("#web_conn_id option:selected").val();
            var connection_name = $("#web_conn_id option:selected").text();
            var int_product = $(".product option:selected").val();
            var sub_type = $(".sub_type option:selected").val();
            var assign_to = $(".assign_to option:selected").val();

            var edit_id = $(this).attr('edit_id');
            if (int_product > 0 && assign_to != "") {
                var draft_status = 0;
            } else {
                var draft_status = 3;
            }
            if (connection_id > 0) {
                $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('website_connectionpage'); ?>",
                    data: {
                        action: 'page',
                        platform_status: platform_status,
                        connection_id: connection_id,
                        connection_name: connection_name,
                        int_product: int_product,
                        sub_type: sub_type,
                        assign_to: assign_to,
                        edit_id: edit_id,
                        is_status: draft_status,
                    },
                    success: function(res) {
                        var result = JSON.parse(res);
                        $('.discard_main_box').val(result.id);

                        $(".big_list_add_outer_main_4 .all_circle_plus_list").hide();
                        if (result.respoance == 1) {

                        } else {
                            iziToast.error({
                                title: result.msg,
                            });
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();
                    }
                });
                return false;
            } else {
                var form = $("form[name='pagelist']")[0];
                $(form).find('.selectpicker').each(function() {
                    var selectpicker_valid = 0;
                    if ($(this).attr('required') == 'undefined') {
                        var selectpicker_valid = 0;
                    }
                    if ($(this).attr('required') == 'required') {
                        var selectpicker_valid = 1;
                    }
                    if (selectpicker_valid == 1) {
                        if ($(this).val() == 0 || $(this).val() == '') {
                            $(this).closest("div").addClass('selectpicker-validation');
                        } else {
                            $(this).closest("div").removeClass('selectpicker-validation');
                        }
                    } else {
                        $(this).closest("div").removeClass('selectpicker-validation');
                    }
                });
                return false;
            }
        }
    });

    $('body').on('click', '.delete_account', function() {
        var delete_id = $(this).attr('data-delete_id');
        iziToast.delete({
            message: 'Are You Sure ! Account Releated pages also will be deleted!',
            buttons: [
                ['<button>delete</button>', function(instance, toast) {
                    $.ajax({
                        url: "<?= site_url('delete_pages_fb'); ?>",
                        method: "post",
                        data: {
                            action: 'delete',
                            delete_id: delete_id,
                            table: 'fb_account',
                        },
                        success: function(data) {
                            iziToast.error({
                                title: 'Delete Successfully'
                            });
                            location.reload();
                        }
                    });
                }, true],
                ['<button>Close</button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                        onClosing: function(instance, toast, closedBy) {}
                    }, toast, 'buttonName');
                }]
            ],
            onOpening: function(instance, toast) {
                console.info('callback abriu!');
            },
            onClosing: function(instance, toast, closedBy) {
                console.info('closedBy: ' + closedBy);
            }
        });
    });

    $('body').on('click', '.delete_page', function() {
        var delete_id = $(this).attr('data-delete_id');
        var is_draft = $(this).attr('data-draft');

        var record_text = "Are you sure you want to Delete this?";
        if (delete_id != '' && delete_id !== undefined && delete_id !== 'undefined') {
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
                    $.ajax({
                        url: "<?= site_url('delete_pages_fb'); ?>",
                        method: "post",
                        data: {
                            action: 'delete',
                            delete_id: delete_id,
                            is_draft: is_draft,
                            table: 'fb_pages',
                        },
                        success: function(data) {
                            iziToast.error({
                                title: 'Form Deleted Successfully..!'
                            });
                            location.reload();
                        }
                    });
                }
            });

        }

        // var checkbox = $('.checkbox:checked');
        // iziToast.delete({
        //     message: 'Are You Sure',
        //     buttons: [
        //         ['<button>delete</button>', function(instance, toast) {
        //             $.ajax({
        //                 url: "<?= site_url('delete_pages_fb'); ?>",
        //                 method: "post",
        //                 data: {
        //                     action: 'delete',
        //                     delete_id: delete_id,
        //                     is_draft:is_draft,
        //                     table: 'fb_pages',
        //                 },
        //                 success: function(data) {
        //                     iziToast.error({
        //                         title: 'Delete Successfully'
        //                     });
        //                     location.reload();
        //                 }
        //             });
        //         }, true], 
        //         ['<button>Close</button>', function(instance, toast) {
        //             instance.hide({
        //                 transitionOut: 'fadeOutUp',
        //                 onClosing: function(instance, toast, closedBy) {
        //                     console.info('closedBy: ' + closedBy); 
        //                 }
        //             }, toast, 'buttonName');
        //         }]
        //     ],
        //     onOpening: function(instance, toast) {
        //         console.info('callback abriu!');
        //     },
        //     onClosing: function(instance, toast, closedBy) {
        //         console.info('closedBy: ' + closedBy);
        //     }
        // });
    });

    function discard_page() {
        var delete_id = $('.discard_main_box').val();
        $.ajax({
            url: "<?= site_url('delete_pages_fb'); ?>",
            method: "post",
            data: {
                action: 'discard',
                delete_id: delete_id,
                table: 'fb_pages',
            },
            success: function(data) {
                iziToast.error({
                    title: 'Discard Successfully'
                });
                location.reload();
            }
        });
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    var tabstatuss = getCookie('tabstatus');
    $(".nav-link").removeClass("active");
    $(".tab-pane.fade").removeClass("active");
    $(".tab-pane.fade").removeClass("show");
    if (tabstatuss != '' && tabstatuss != 'undefined') {
        $("#" + tabstatuss).trigger("click");
    } else {
        $("#pills-General-tab").trigger("click");
    }
    $('body').on('click', '.nav-link', function() {
        var tab_val = $(this).attr("id");
        setCookie('tabstatus', tab_val);
    });

    // $('body').on('click', '#pills-General-tab', function() {
    //     location.reload();
    // });

    function EditScenarios(edit_id, paltform_status) {
        $('#platform_status').val(paltform_status);
        $('.lead_module_devider_1,.big_list_add_outer_main_3,.lead_module_devider_2').show();
        $('.big_list_add_outer_main_1,.big_circle_plus_outer,.add_next_big_plus_outer,.all_circle_plus_list,.discard-tag').hide();
        $('.big_circle_fb_outer,.lead_add_main_box,.lead_main_box_add').show();

        $.ajax({
            type: "post",
            url: "<?= site_url('edit_facebook_scenarious'); ?>",
            data: {
                id: edit_id,
            },
            success: function(res) {
                var editresult = JSON.parse(res);
                if (editresult.response == 1) {
                    if (paltform_status == 2) {
                        $('#fb_conn_id').val(editresult.result['connection_id']);
                        $('.big_list_add_outer_main_2').show();
                        $('.fb_div_hide1,.fb_div_hide').hide();

                        $('.page-profile').html('<img src="' + editresult.result['page_img'] + '" class="w-100 h-100 object-fit-contain rounded-circle">');
                        $.ajax({
                            type: "post",
                            url: "<?= site_url('facebook_user'); ?>",
                            data: {
                                fb_access_token: editresult.result['access_token'],
                                fb_check_conn: editresult.result['verification_status'],
                                connection_id: editresult.result['connection_id'],
                                action: 'user'
                            },
                            success: function(res) {
                                $('.loader').hide();
                                var result = JSON.parse(res);
                                if (result.response == 1) {
                                    $('#facebookpages').html(result.html);
                                    $('#facebookpages').val(editresult.result['page_id']);
                                    $('#facebookpages').selectpicker('refresh');

                                    var page_access_token = $('#facebookpages').find("option:selected").attr("data-access_token");
                                    $.ajax({
                                        type: "post",
                                        url: "<?= site_url('facebook_form'); ?>",
                                        data: {
                                            action: 'page_to_form',
                                            access_token: page_access_token,
                                            page_id: editresult.result['page_id'],
                                        },
                                        success: function(res) {
                                            var result = JSON.parse(res);
                                            $('#facebookform').html(result.html);
                                            $('#facebookform').val(editresult.result['form_id']);
                                            $('#facebookform').selectpicker('refresh');
                                        },
                                        error: function(error) {
                                            $('.loader').hide();
                                        }
                                    });
                                } else {
                                    $(this).closest(".big_circle_plus_outer").show();
                                    $(".big_list_add_outer_main_2").hide();
                                    $(".big_list_add_outer_main_2 .big_circle_fb_outer").hide();
                                    iziToast.error({
                                        title: result.message
                                    });
                                }
                            },
                            error: function(error) {
                                $('.loader').hide();
                            }
                        });
                    } else if (paltform_status == 5) {
                        $('.big_list_add_outer_main_4').show();
                        $('#web_conn_id').val(editresult.result['connection_id']);
                    }


                    $('#product').val(editresult.result['intrested_product']);
                    if (editresult.result['user_id'] == 0) {
                        $('#assign_to').val(0);
                        $('.staff').hide();
                    } else {
                        $('#assign_to').val(1);
                        $('.staff').show();
                        var assignIdsArray = editresult.result['user_id'].split(',');
                        $('#staff_to').val(assignIdsArray);
                        $('#staff_to').selectpicker('refresh');
                    }
                    $('.selectpicker').selectpicker('refresh');
                    $('.big_falcebook_circle_4_sbt').attr('edit_id', edit_id);
                    if (editresult.result['is_status'] == 3) {
                        $('.big_list_add_outer_main_3 .all_circle_plus_list').show();
                        $('.big_falcebook_circle_4_sbt').html('Save As');
                    } else {
                        $('.big_falcebook_circle_4_sbt').html('Update');
                    }
                }
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }

    $('body').on('change', '#web_conn_id', function() {
        var web_access_token = $(this).find(':selected').data('access-token');
        var web_check_conn = $(this).find(':selected').data('connection-check');
        if (web_access_token != '' && web_check_conn == 1) {
            $('.webDiv').show();
            $('#web_token').html(web_access_token);
        } else {
            $('.webDiv').hide();
            $('#web_token').html('');
            iziToast.error({
                title: 'Please select your connection..!'
            });
        }
    });

    $('body').on('click', '.page-referesh', function() {
        var fb_access_token = $('#fb_conn_id').find(':selected').data('access-token');
        var fb_check_conn = $('#fb_conn_id').find(':selected').data('connection-check');
        var connection_id = $("#fb_conn_id option:selected").val();
        if (fb_access_token != '') {
            // getPagesList(fb_access_token, fb_check_conn);

            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('facebook_user'); ?>",
                data: {
                    fb_access_token: fb_access_token,
                    fb_check_conn: fb_check_conn,
                    connection_id: connection_id,
                    action: 'refresh'
                },
                success: function(res) {
                    $('.loader').hide();
                    var result = JSON.parse(res);
                    if (result.response == 1) {
                        iziToast.success({
                            title: 'Page List Referesh Successfully..!'
                        });
                        $('#facebookpages').html(result.html);
                        $('#facebookpages').selectpicker('refresh');
                    } else {
                        iziToast.error({
                            title: result.message
                        });
                    }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });

        } else {
            iziToast.error({
                title: 'Please select your connection..!'
            });
        }

    });



    function getPagesList(fb_access_token, fb_check_conn, connection_id) {
        $('.loader').show();
        $.ajax({
            type: "post",
            url: "<?= site_url('facebook_user'); ?>",
            data: {
                fb_access_token: fb_access_token,
                fb_check_conn: fb_check_conn,
                connection_id: connection_id,
                action: 'user'
            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                if (result.response == 1) {
                    $('#facebookpages').html(result.html);
                    $('#facebookpages').selectpicker('refresh');
                } else {
                    $(this).closest(".big_circle_plus_outer").show();
                    $(".big_list_add_outer_main_2").hide();
                    $(".big_list_add_outer_main_2 .big_circle_fb_outer").hide();
                    iziToast.error({
                        title: result.message
                    });
                }
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }

    function getFormsList(access_token, page_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('facebook_form'); ?>",
            data: {
                action: 'page_to_form',
                access_token: access_token,
                page_id: page_id,
            },
            success: function(res) {
                var result = JSON.parse(res);
                $('#facebookform').html(result.html);
                $('#facebookform').selectpicker('refresh');
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }
</script>