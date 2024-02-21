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

    .big_circle_fb_inner{
        width: 176px;
        height: 176px;
    }
</style>

<?php
$this->db = \Config\Database::connect('second');
$table_username = session_username($_SESSION['username']);
$product = json_decode($product, true);


$user_get = "SELECT * FROM " . $table_username . "_user WHERE switcher_active = 'active' ORDER BY id ASC";
$user_result = $this->db->query($user_get);
$user = $user_result->getResultArray();

$find_Array_all = "SELECT * FROM " . $table_username . "_fb_account  Where master_id=" . $_SESSION['master'];
$find_Array_all = $this->db->query($find_Array_all);
$data = $find_Array_all->getResultArray();
?>
<div class="main-dashbord p-2">
    <div class="container-fluid">
        <div class="p-3 bg-white rounded-2 m-2 border border-1">
            <div class="title-2">
                <h2>Integration</h2>
            </div>
            <ul class="nav nav-pills mt-3 navtab_primary_sm" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-General-tab" data-bs-toggle="pill" data-bs-target="#Connection-name" type="button" role="tab" aria-controls="pills-General" aria-selected="false" tabindex="-1">Connection Name</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-Email-tab" data-bs-toggle="pill" data-bs-target="#Scenarious" type="button" role="tab" aria-controls="pills-Email" aria-selected="true">Scenarios</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="Connection-name" role="tabpanel" aria-labelledby="pills-General-tab" tabindex="0">
                    <?php if (isset($data[0])) { ?>
                        <div class="p-2 bg-white rounded-2 mx-2 ">
                            <div class="lead_list p-2 rounded-2">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                        <div class="mx-1">
                                            <?php
                                            //pre($data);
                                            //echo $data['user_profile']; 
                                            ?>
                                            <?php if (isset($data[0]['user_profile']) && !empty($data[0]['user_profile'])) { ?>
                                                <img src="<?php echo $data[0]['user_profile'] ?>">
                                            <?php } else { ?>
                                                <img src="https://dev.realtosmart.com/assets/images/f_intigration.svg">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill">
                                        <p class="d-block col-12 text-dark">
                                            <?php echo $data[0]['username']; ?>
                                        </p>
                                        <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12">
                                            <i class="bi bi-person me-1"></i>
                                            <span>
                                                <?php echo $data[0]['username']; ?>
                                            </span>
                                        </div>
                                    </a>
                                    <div class="delete_account" data-delete_id="<?php echo $data[0]['id']; ?>"><i class="bi bi-trash3 fs-5"></i></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="tab-pane fade active show" id="Scenarious" role="tabpanel" aria-labelledby="pills-Email-tab" tabindex="0">
                    <div class="p-3">
                        <div class="p-2">
                            <div class="d-flex justify-content-between">
                                <button class="btn-primary-rounded lead_main_box_add">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <form class="needs-validation" name="pagelist" method="POST" novalidate="">
                            <div class="lead_add_main_box px-3 py-5 bg-white rounded-2 mx-2 mb-2 position-relative" style="display: none;">

                                <i class="fa-solid fa-angle-left position-absolute top-0 start-0 translate-middle m-4 fs-4 text-secondary-emphasis cursor-pointer discard-tag" data-bs-toggle="modal" data-bs-target="#discard_main_box"></i>

                                <div class="d-flex justify-content-center align-items-center gap-3 py-4">

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
                                            <div class="big_circle_plus_list all_circle_plus_list bg-white border-0 rounded-2 shadow position-absolute py-2 ms-3 top-50 start-100 translate-middle-y">
                                                <ul class="position-relative px-3">
                                                    <li class="py-1">
                                                        <a class="dropdown-item cursor-pointer" id="facebook_lead_drop_1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 1643 1643" fill="none" class="me-2">
                                                                <path d="M1643 823.999C1643 370.808 1275.19 3 822 3C368.808 3 1 370.808 1 823.999C1 1221.36 283.424 1552.22 657.8 1628.58V1070.3H493.6V823.999H657.8V618.749C657.8 460.296 786.697 331.4 945.15 331.4H1150.4V577.699H986.2C941.045 577.699 904.1 614.644 904.1 659.799V823.999H1150.4V1070.3H904.1V1640.89C1318.7 1599.84 1643 1250.1 1643 823.999Z" fill="#0D6AE2"></path>
                                                            </svg>
                                                            <span>Facebook Leads</span>
                                                        </a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a class="dropdown-item cursor-pointer">
                                                            <img src="https://dev.realtosmart.com/assets/images/r-logo.png" width="35px" alt="realtosmart" class="me-2">
                                                            <span>Website Lead Setting</span>
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

                                                    <!-- <img src="https://dev.realtosmart.com/assets/images/r-logo.png" class="w-100 h-100 object-fit-contain rounded-circle"> -->
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

                                    <div class="lead_module_devider lead_module_devider_1"></div>
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
                                                    <label class="form-label main-label fs-14 text-nowrap">Page</label><sup class="validationn">*</sup>
                                                    <div class="main-selectpicker">
                                                        <select id="facebookpages" class="selectpicker form-control form-main" data-live-search="true" required>
                                                            <option value="">select Page</option>
                                                        </select>
                                                    </div>
                                                    <label class="form-label main-label fs-14 text-nowrap mt-3">Form</label><sup class="validationn">*</sup>
                                                    <div class="main-selectpicker">
                                                        <select id="facebookform" class="selectpicker form-control form-main" data-live-search="true" required>
                                                            <option value="">select Form</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-end mt-3 page_frm_save">
                                                        <button class="btn-primary d-inline-block big_falcebook_circle_2_sbt" edit-id="" >Save</button>
                                                    </div>
                                                </div>
                                                </form>
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

                                    <div class="lead_module_devider lead_module_devider_2"></div>
                                    <div class="big_list_add_outer_main big_list_add_outer_main_3 position-relative">
                                        <div class="big_circle_fb_outer position-relative">
                                            <div class="big_circle_fb after-none cursor-pointer">
                                                <div class="big_circle_fb_inner bg-white shadow-none p-5 rounded-circle position-relative">
                                                    <div class="position-relative">
                                                        <img src="https://dev.realtosmart.com/assets/images/r-logo.png" alt="" width="80">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="big_circle_fb_list all_circle_plus_list bg-white border-0 rounded-2 shadow position-absolute py-2 px-3 ms-3 top-50 start-100 translate-middle-y">
                                              
                                                <label class="form-label main-label fs-14 text-nowrap mt-3">Select Int Site <sup class="validationn">*</sup></label>
                                                <div class="main-selectpicker">
                                                    <select id="int_site" class="selectpicker form-control form-main int_site" data-live-search="true" required>
                                                        <option value="0">Select Int Site</option>
                                                        <?php
                                                        // if (isset($project)) {
                                                        //     foreach ($project as $area_key => $type_value) {
                                                        //         if ($type_value['is_inactive'] == 0) {
                                                        //             echo '<option value="' . $type_value["id"] . '" data-intersted_site_id="' . $type_value["project_name"] . '" >' . $type_value["project_name"] . '</option>';
                                                        //         }
                                                        //     }
                                                        // }
                                                        ?>
                                                    </select>
                                                </div>
                                                

                                                <label class="form-label main-label fs-14 text-nowrap mt-3">Assign
                                                    to <sup class="validationn">*</sup></label>
                                                <div class="main-selectpicker">
                                                    <select id="assign_to" class="selectpicker form-control form-main assign_to" data-live-search="true" required>
                                                        <option class="dropdown-item" data-sourcetype_name="employee" value="0">Roll Over Staff</option>
                                                        <option class="dropdown-item" data-sourcetype_name="employee" value="1">Assign To Staff</option>
                                                    </select>
                                                </div>

                                                <label class="form-label main-label fs-14 text-nowrap mt-3 staff">Staff<sup class="validationn">*</sup></label>
                                                    <div class="main-selectpicker multiple-select staff">
                                                    <select class="selectpicker form-control form-main staff_to" multiple id="staff_to" name="staff_to" data-live-search="true" required="">
                                                        <?php
                                                            if (isset($user)) {
                                                                foreach ($user as $type_key => $user_value) {
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
                                            <!-- <h6 class="position-absolute top-100 start-50 translate-middle text-nowrap mt-4">
                                                <b>Facebook Lead Connection</b>
                                            </h6> -->
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
                        <div class="p-2 bg-white rounded-2 mx-2 pages_list">
                        </div>

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
                                <!-- <div class="lead_list p-2 rounded-2 position-relative">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="lead_list_img d-flex align-items-center justify-content-start me-3">
                                            <div class="mx-1">
                                                <img src="https://scontent-dus1-1.xx.fbcdn.net/v/t39.30808-1/294935068_455927246545151_6937570783544724723_n.jpg?stp=cp0_dst-jpg_p50x50&amp;_nc_cat=104&amp;ccb=1-7&amp;_nc_sid=4da83f&amp;_nc_ohc=2pmSwaNY8-0AX8lR-41&amp;_nc_ht=scontent-dus1-1.xx&amp;edm=AOf6bZoEAAAA&amp;oh=00_AfAxBNu5qco_6YEvMf3Z_m7sgVoRFocbu3FtJs7tnDf1ew&amp;oe=65AE3497" class="rounded-circle" width="50px" hright="50px">
                                            </div>

                                            <div class="load-icon center d-none">
                                                <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                                <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                                <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                                <span><i class="bi bi-caret-right-fill fs-10"></i></span>
                                            </div>

                                            <div class="mx-1">
                                                <img src="https://dev.realtosmart.com/assets/images/l_intigration.svg" class="rounded-circle" width="50px" hright="50px">
                                            </div>
                                        </div>
                                        <a class="lead_list_content d-flex align-items-center flex-wrap flex-fill">
                                            <div class="d-flex align-items-center">
                                                <div class="d_saved_1">
                                                    <button class="btn-primary-rounded fs-14">1</button>
                                                </div>    
                                                <div class="d_unsaved_1">
                                                    <button class="btn-primary-rounded fs-14 bg-secondary-subtle border-0 shadow-sm text-dark">?</button>
                                                </div>
                                                <div class="mx-1" style="width: 50px; border: 2px solid var(--first-color);"></div>
                                                <div class="d_saved_2">
                                                    <button class="btn-primary-rounded fs-14">2</button>
                                                </div>
                                                <div class="d_unsaved_2">
                                                    <button class="btn-primary-rounded fs-14 bg-secondary-subtle border-0 shadow-sm text-dark">?</button>
                                                </div>
                                                <div class="mx-1" style="width: 50px; border: 2px solid var(--first-color);"></div>
                                                <div class="d_saved_3">
                                                    <button class="btn-primary-rounded fs-14">3</button>
                                                </div>
                                                <div class="d_unsaved_3">
                                                    <button class="btn-primary-rounded fs-14 bg-secondary-subtle border-0 shadow-sm text-dark">?</button>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center col-12 text-secondary-emphasis fs-12 mt-2">
                                                <i class="bi bi-gear me-1"></i>
                                                <span class="me-2">0</span>
                                                <i class="bi bi-person me-1"></i>
                                                <span>Hiren Vaghasiya</span>
                                            </div>
                                        </a>
                                        <div class="lead_list_switch d-flex align-items-center flex-wrap">
                                            <label class="switch_toggle mx-2">
                                                <input type="checkbox" class="page_actiive" value="1" data-form_id="237950712661626" checked="">
                                                <span class="check_input round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
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

        $(".lead_add_main_box,.delete_div,.update_div,.draft_div,.staff").hide();

        $('body').on('click', '.discard_main_box', function() {
            $(".lead_module_devider , .big_circle_plus_outer , .all_circle_plus_list , .big_circle_fb_outer , .add_next_big_plus_outer").hide();
            $(".big_list_add_outer_main_2 .all_circle_plus_list , .big_list_add_outer_main_3 .all_circle_plus_list , .big_list_add_outer_main_1 , .big_list_add_outer_main_1 .big_circle_plus_outer").show();
            discard_page();
        });

        $('body').on('click', '.draft_main_box', function() {
            $(".lead_module_devider , .big_circle_plus_outer , .all_circle_plus_list , .big_circle_fb_outer , .add_next_big_plus_outer").hide();
            $(".big_list_add_outer_main_2 .all_circle_plus_list , .big_list_add_outer_main_3 .all_circle_plus_list , .big_list_add_outer_main_1 , .big_list_add_outer_main_1 .big_circle_plus_outer").show();
            new_draft_pages_list_data();
        });

        $('body').on('click', '.lead_main_box_add', function() {
            $(".lead_add_main_box").show();
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
        $(".add_next_big_plus_outer").hide();

        $('body').on('click', '#facebook_lead_drop_1', function() {
            $(this).closest(".big_circle_plus_outer").hide();
            $(this).closest(".big_list_add_outer_main").find(".big_circle_fb_outer").show();
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
            if ($(this).closest(".big_circle_fb_list").find("#area").val() != "" && $(this).closest(".big_circle_fb_list").find("#int_site").val() != ""  && $(this).closest(".big_circle_fb_list").find("#assign_to").val() != "") {
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
    window.fbAsyncInit = function() {
        FB.init({
            appId: '692703766025178',
            xfbml: true,
            version: 'v17.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function new_pages_list_data() {
        $.ajax({
            type: "post",
            url: "<?= site_url('new_pages_list_data'); ?>",
            data: {
                action: 'new_pages_list_data',
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

    function new_deleted_pages_list_data() {
        $.ajax({
            type: "post",
            url: "<?= site_url('new_deleted_pages_list_data'); ?>",
            data: {
                action: 'new_deleted_pages_list_data',
            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                if(result.pages_list_status==1)
                {
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

    function new_updated_pages_list_data() {
        $.ajax({
            type: "post",
            url: "<?= site_url('new_updated_pages_list_data'); ?>",
            data: {
                action: 'new_updated_pages_list_data',
            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                if(result.pages_list_status==1)
                {
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

    function new_draft_pages_list_data()
    {
        $.ajax({
            type: "post",
            url: "<?= site_url('new_draft_pages_list_data'); ?>",
            data: {
                action: 'new_draft_pages_list_data',
            },
            success: function(res) {
                $('.loader').hide();
                var result = JSON.parse(res);
                if(result.pages_list_status==1)
                {
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

    new_pages_list_data();
    new_deleted_pages_list_data();
    new_updated_pages_list_data();
    new_draft_pages_list_data();

    function myFacebookLogin() {
        FB.login(function(response) {
            $('.loader').show();
            if (response.authResponse) {
                // Exchange short-lived token for a long-lived token
                FB.api('/oauth/access_token', 'GET', {
                    "grant_type": "fb_exchange_token",
                    "client_id": "692703766025178",
                    "client_secret": "67e1dc6e799ae0ea2af3b38a0fa6face",
                    "fb_exchange_token": response.authResponse.accessToken
                }, function(tokenResponse) {
                    var longLivedToken = tokenResponse.access_token;
                    FB.api('/me', function(userResponse) {
                        $.ajax({
                            type: "post",
                            url: "<?= site_url('new_facebook_user'); ?>",
                            data: {
                                action: 'user',
                                response: response.authResponse,
                                userinformation: userResponse,
                                longLivedToken: longLivedToken // Include the long-lived token
                            },
                            success: function(res) {
                                $('.loader').hide();
                                var result = JSON.parse(res);
                                $('.big_list_add_outer_main_1 .add_next_big_plus_outer').show();
                                $('.big_list_add_outer_main_1').closest(".add_next_big_plus_outer").show();
                                $('.big_list_add_outer_main_2,.big_list_add_outer_main_3,.lead_module_devider_1,.lead_module_devider_2').hide();
                                $('.logo-1 .all_circle_plus_list').hide();
                                if(result.profile_pic)
                                {
                                    $('.fb_div_hide').hide();
                                    $('.profile_div').html('<img src="'+result.profile_pic+'" class="w-100 h-100 object-fit-contain rounded-circle">');   
                                
                                }
                                // $("#big_falcebook_circle_1 .big_list_add_drop").hide();
                                $('#facebookpages').html(result.html);
                                $('#facebookpages').selectpicker('refresh');
                            },
                            error: function(error) {
                                $('.loader').hide();
                            }
                        });
                    });
                });
            }
        }, {
            scope: 'public_profile,pages_show_list,leads_retrieval,pages_manage_ads, pages_manage_engagement, pages_read_engagement, pages_manage_metadata'
        });
    }

    $('body').on('click', '.big_falcebook_circle_sbt,.new_module_add_btn1', function() {
        $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").show();

        var master_id = $(this).attr("data-master_id");
        var access_token = $(".user_agent option:selected").val();
        var username = $(".user_agent option:selected").attr("data-username");
        var user_id = $(".user_agent option:selected").attr("data-user_id");
        //   $("#big_falcebook_circle_1 .big_list_add_drop").hide();
        $.ajax({
            type: "post",
            url: "<?= site_url('new_facebook_user'); ?>",
            data: {
                action: 'user_already',
                access_token: access_token,
                username: username,
                user_id: user_id,
                master_id: master_id,
            },
            success: function(res) {
                var result = JSON.parse(res);
                if ($("#facebookpages").val() == "0" || $("#facebookpages").val() == "") {
                    // if (<?php //echo isset($data[0]['user_profile']) ? 'true' : 'false'; ?>) {
                    //     $('.fb_div_hide').hide();
                    //     $('.profile_div').html('<img src="<?php //echo $data[0]['user_profile']; ?>" class="w-100 h-100 object-fit-contain rounded-circle">');   
                    // }

                    $('#facebookpages').html(result.html);
                    $('#facebookpages').selectpicker('refresh');
                }
                $('.loader').hide();
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
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
            url: "<?= site_url('new_facebook_page'); ?>",
            data: {
                action: 'page_update',
                form_id: form_id,
                status: status,
            },
            success: function(res) {
                var result = JSON.parse(res);
                new_pages_list_data();
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
                url: "<?= site_url('new_queue_list_add'); ?>",
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
                        new_pages_list_data();

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

    $('body').on('click', '.area .dropdown-menu.inner.show , .int_site .dropdown-menu.inner.show , .dropdown-menu.inner.show , .assign_to .dropdown-menu.inner.show', function() {
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
        $.ajax({
            type: "post",
            url: "<?= site_url('new_facebook_form'); ?>",
            data: {
                action: 'page_to_form',
                access_token: access_token,
                page_id: page_id,
                form_name: form_name,
            },
            success: function(res) {
                var result = JSON.parse(res);
                // $('.fb_div_hide1').hide();
                // $('.page-profile').html('<img src="" class="w-100 h-100 object-fit-contain rounded-circle">');
                $('#facebookform').html(result.html);
                $('#facebookform').selectpicker('refresh');
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    });

    $('body').on('change', '#assign_to', function() {
        $('.staff').hide();
        if($(this).val()==1)
        {
            $('.staff').show();
        }
    });

    //for save connection and all functionality...
    $('body').on('click', '.big_falcebook_circle_4_sbt', function() {
        var area = $(".area option:selected").val();
        var int_site = $(".int_site option:selected").val();
        var assign_to = $(".assign_to option:selected").val();
        var staff_to = $("#staff_to").val();
        var staff_to = staff_to.join(',');
        var page_id = $("#facebookpages option:selected").val();
        var access_token = $("#facebookpages").find("option:selected").attr("data-access_token");
        var page_name = $("#facebookpages").find("option:selected").attr("data-page_name");
        var form_id = $("#facebookform option:selected").val();
        var form_name = $("#facebookform option:selected").text();
        var edit_id = $(this).attr('edit_id');
        
        if (int_site > 0 && assign_to != "" && area > 0) {
            $.ajax({
                type: "post",
                url: "<?= site_url('new_facebook_page'); ?>",
                data: {
                    action: 'page',
                    page_id: page_id,
                    access_token: access_token,
                    page_name: page_name,
                    area: area,
                    int_site: int_site,
                    assign_to: assign_to,
                    staff_to:staff_to,
                    form_name: form_name,
                    form_id: form_id,
                    edit_id: edit_id,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.respoance == 1) {
                        location.reload();
                        FB.api('/' + page_id + '/subscribed_apps', 'post', {
                                access_token: access_token,
                                subscribed_fields: ['leadgen']
                            },
                            function(response) {}
                        );
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
        var area = $(".area option:selected").val();
        var int_site = $(".int_site option:selected").val();
        var assign_to = $(".assign_to option:selected").val();
        var page_id = $("#facebookpages option:selected").val();
        var access_token = $("#facebookpages").find("option:selected").attr("data-access_token");
        var page_name = $("#facebookpages").find("option:selected").attr("data-page_name");
        var form_id = $("#facebookform option:selected").val();
        var form_name = $("#facebookform option:selected").text();
        var edit_id = $(this).attr('edit_id');
        if(int_site > 0 && assign_to != ""  && area > 0 && page_id != "" && form_id != ""){
            var draft_status = 0;
        }
        else{
            var draft_status = 3;
        }
        if (page_id > 0 && form_id > 0) {
            $(this).closest(".big_list_add_outer_main").find(".add_next_big_plus_outer").show();
            $.ajax({
                type: "post",
                url: "<?= site_url('new_facebook_page'); ?>",
                data: {
                    action: 'page',
                    page_id: page_id,
                    access_token: access_token,
                    page_name: page_name,
                    area: area,
                    int_site: int_site,
                    assign_to: assign_to,
                    form_name: form_name,
                    form_id: form_id,
                    edit_id: edit_id,
                    is_status:draft_status,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    $('.discard_main_box').val(result.id);
                    $('.fb_div_hide1').hide();
                    if(result.page_profile)
                    {
                        $('.page-profile').html('<img src="'+result.page_profile+'" class="w-100 h-100 object-fit-contain rounded-circle">');
                   
                    }
                    $(".big_list_add_outer_main_2 .all_circle_plus_list").hide();
                    if (result.respoance == 1) {

                        iziToast.success({
                            title: result.msg,
                        });
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
    });

    $('body').on('click', '.delete_account', function() {
        var delete_id = $(this).attr('data-delete_id');
        iziToast.delete({
            message: 'Are You Sure ! Account Releated pages also will be deleted!',
            buttons: [
                ['<button>delete</button>', function(instance, toast) {
                    $.ajax({
                        url: "<?= site_url('new_delete_pages_fb'); ?>",
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
                }, true], // true to focus
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
                console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
            }
        });
    });

    $('body').on('click', '.delete_page', function() {
        var delete_id = $(this).attr('data-delete_id');
        var checkbox = $('.checkbox:checked');
        iziToast.delete({
            message: 'Are You Sure',
            buttons: [
                ['<button>delete</button>', function(instance, toast) {
                    $.ajax({
                        url: "<?= site_url('new_delete_pages_fb'); ?>",
                        method: "post",
                        data: {
                            action: 'delete',
                            delete_id: delete_id,
                            table: 'fb_pages',
                        },
                        success: function(data) {
                            iziToast.error({
                                title: 'Delete Successfully'
                            });
                            // new_pages_list_data();
                            location.reload();
                        }
                    });
                }, true], // true to focus
                ['<button>Close</button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                        onClosing: function(instance, toast, closedBy) {
                            console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                        }
                    }, toast, 'buttonName');
                }]
            ],
            onOpening: function(instance, toast) {
                console.info('callback abriu!');
            },
            onClosing: function(instance, toast, closedBy) {
                console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
            }
        });
    });

    function discard_page()
    {
        var delete_id = $('.discard_main_box').val();
        $.ajax({
            url: "<?= site_url('new_delete_pages_fb'); ?>",
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

    function EditScenarios(edit_id, page_id, form_id, intrested_area, intrested_site, property_sub_type, setassign_id,staff_to,page_img,status_id) {
        $('.logo-1,.big_list_add_outer_main_2,.lead_module_devider_1,.big_list_add_outer_main_3,.lead_module_devider_2').show();
        $('.big_circle_plus_outer,.add_next_big_plus_outer,.all_circle_plus_list,.lead_main_box_add,.discard-tag').hide();
        $('.big_list_add_outer_main_1,.big_circle_fb_outer,.lead_add_main_box').show();

        var master_id = $('.big_falcebook_circle_sbt,.new_module_add_btn1').attr("data-master_id");
        var access_token = $(".user_agent option:selected").val();
        var username = $(".user_agent option:selected").attr("data-username");
        var user_id = $(".user_agent option:selected").attr("data-user_id");

        $('.fb_div_hide1,.fb_div_hide').hide();
        // if('<?php // if(isset($data[0]['user_profile'])) ?>')
        // {
        //     $('.fb_div_hide').hide();
        //     $('.profile_div').html('<img src="<?php //echo $data[0]['user_profile'] ?>" class="w-100 h-100 object-fit-contain rounded-circle">');   
        
        // }
        $('.page-profile').html('<img src="'+page_img+'" class="w-100 h-100 object-fit-contain rounded-circle">');
          
        $.ajax({
            type: "post",
            url: "<?= site_url('new_facebook_user'); ?>",
            data: {
                action: 'user_already',
                access_token: access_token,
                username: username,
                user_id: user_id,
                master_id: master_id,
            },
            success: function(res) {
                var result = JSON.parse(res);
                if ($("#facebookpages").val() == "0" || $("#facebookpages").val() == "") {
                    $('#facebookpages').html(result.html);
                    $('#facebookpages').val(page_id);
                    $('#facebookpages').selectpicker('refresh');
                }
                var access_token = $('#facebookpages').find("option:selected").attr("data-access_token");
                var form_name = $('#facebookpages').find("option:selected").text();
                var page_name = $('#facebookpages').attr("data-page_name");
                $.ajax({
                    type: "post",
                    url: "<?= site_url('new_facebook_form'); ?>",
                    data: {
                        action: 'page_to_form',
                        access_token: access_token,
                        page_id: page_id,
                        form_name: form_name,
                    },
                    success: function(res) {
                        var result = JSON.parse(res);
                        $('#facebookform').html(result.html);
                        $('#facebookform').val(form_id);
                        $('#facebookform').selectpicker('refresh');
                    },
                    error: function(error) {
                        $('.loader').hide();
                    }
                });
                $('.loader').hide();
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
                 
        $('#area').val(intrested_area);
        $('#int_site').val(intrested_site);
        $('#assign_to').val(setassign_id);
        if(setassign_id==0)
        {
            $('.staff').hide();
        }
        else
        {
            $('.staff').show();
            var assignIdsArray = staff_to.split(',');
            $('#staff_to').val(assignIdsArray);
            $('#staff_to').selectpicker('refresh');
        }
        $('.selectpicker').selectpicker('refresh');
        $('.big_falcebook_circle_4_sbt').attr('edit_id', edit_id);
        if(status_id==3)
        {
            $('.big_list_add_outer_main_3 .all_circle_plus_list').show();
            $('.big_falcebook_circle_4_sbt').html('Save As');
        }
        else
        {
            $('.big_falcebook_circle_4_sbt').html('Update');
        }
        
    }
    
</script>