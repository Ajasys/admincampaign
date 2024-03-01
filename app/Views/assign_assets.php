<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    .btn_dark:hover {
        background-color: #e3e4e4;
    }
</style>
<?php

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
$table_username = session_username($_SESSION['username']);
$db_connection = \Config\Database::connect('second');
$query = "SELECT * FROM " . $table_username . "_platform_integration WHERE `verification_status`=1 AND `platform_status`=2";
$rows = $db_connection->query($query);
$resultdata = $rows->getResultArray();
$user_get = "SELECT * FROM " . $table_username . "_user WHERE switcher_active = 'active' AND role NOT IN (1)  ORDER BY id ASC";
$user_result = $db_connection->query($user_get);
$user_data = $user_result->getResultArray();
?>
<div class="main-dashbord p-3">
    <div class="container-fluid p-0">
        <div class="mb-2">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="title-1  d-flex align-items-center">
                    <i class="fa-solid fa-unlock-keyhole fa-lg" style="font-size: 25px"></i>
                    <h2>Assign Assets & Permission</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button class="btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#assign_user">
                        Assign To User
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2 p-3">
        <div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
            <div class="dataTables_length" id="project_length">
                <label>
                    Show
                    <select name="project_length" id="fb_length_show" aria-controls="project" class="table_length_select_check_2">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    Records
                    <span class="list_count"></span>
                </label>
            </div>
            <div id="people_wrapper" class="dataTables_wrapper no-footer">
                <div id="fb_filter" class="dataTables_filter justify-content-end d-flex py-1 py-sm-0">
                    <label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
                </div>
            </div>
        </div>
        <table id="" class="table main-table w-100">
            <thead>
                <tr>
                    <th class="p-2 text-nowrap"><span>User Name</span></th>
                    <th class="p-2 text-nowrap"><span>User Id </span></th>
                    <th class="p-2 text-nowrap"><span>Assets Pemission</span></th>
                    <th class="p-2 text-nowrap"><span></span></th>
                    <th class="p-2 text-nowrap"><span>Status</span></th>
                    <th class="p-2 text-nowrap text-center"><span></span></th>
                </tr>
            </thead>
            <tbody id="">
            </tbody>
        </table>
    </div>
    <!-- Modal one -->
    <div class="modal fade" id="assign_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Assign Assets & Permission To User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <small>Select user to give assets and permission. Then assign their access and which accounts and tools they can use.</small>
                    <select id="user" name="user" class="selectpicker form-control form-main pt-3" data-live-search="true" required>
                        <option value="0">Select User</option>
                        <?php
                        if (isset($user_data)) {
                            foreach ($user_data as $type_key => $user_value) {
                                echo '<option class="dropdown-item" value="' . $user_value["id"] . '" >' . $user_value["firstname"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary assign_asset" data-bs-toggle="modal" data-bs-target="#assign_asset">Next</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal two-->
    <div class="modal fade" id="assign_asset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fs-5">Assign assets and Set Permission</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-0 p-0">
                    <input type="hidden" name="select_user" id="select_user">
                    <input type="hidden" name="asset_array" id="asset_array">
                    <input type="hidden" name="asset_ids" id="asset_ids">
                    <div class="p-2">
                        <div class="col-12 d-flex flex-wrap">
                            <!-- first-div -->
                            <div class="d-lg-block col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 col-xxl-3 social-accounts main-box rounded-bottom-0" style="height:80vh">
                                <div class="col-12 border rounded-3 bg-white position-lg-relative rounded-bottom-0" style="height:80vh">
                                    <div class="chat-nav-search-bar p-2 col-12  rounded-top-3 border-bottom ">
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="dropdown d-flex align-items-center ps-2 ">
                                                <h5 class="fs-5 fw-semibold ">Select assets Type</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed m-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                        <g>
                                                            <path fill="#1877f2" d="M512 256c0 127.78-93.62 233.69-216 252.89V330h59.65L367 256h-71v-48.02c0-20.25 9.92-39.98 41.72-39.98H370v-63s-29.3-5-57.31-5c-58.47 0-96.69 35.44-96.69 99.6V256h-65v74h65v178.89C93.62 489.69 0 383.78 0 256 0 114.62 114.62 0 256 0s256 114.62 256 256z" opacity="1" data-original="#1877f2" class=""></path>
                                                            <path fill="#ffffff" d="M355.65 330 367 256h-71v-48.021c0-20.245 9.918-39.979 41.719-39.979H370v-63s-29.296-5-57.305-5C254.219 100 216 135.44 216 199.6V256h-65v74h65v178.889c13.034 2.045 26.392 3.111 40 3.111s26.966-1.066 40-3.111V330z" opacity="1" data-original="#ffffff" class=""></path>
                                                        </g>
                                                    </svg>
                                                    <p class="ms-2">Facebook</p>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <?php
                                                // pre($resultdata);
                                                foreach ($resultdata as $fbdata) {
                                                ?>
                                                    <div class="accordion-body p-0">
                                                        <div class="accordion" id="accordionExample_two">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header">
                                                                    <button class="accordion-button m-0 p-2 ps-4 pe-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_in" aria-expanded="true" aria-controls="collapseOne_in">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                                            <g>
                                                                                <path fill="#1877f2" d="M512 256c0 127.78-93.62 233.69-216 252.89V330h59.65L367 256h-71v-48.02c0-20.25 9.92-39.98 41.72-39.98H370v-63s-29.3-5-57.31-5c-58.47 0-96.69 35.44-96.69 99.6V256h-65v74h65v178.89C93.62 489.69 0 383.78 0 256 0 114.62 114.62 0 256 0s256 114.62 256 256z" opacity="1" data-original="#1877f2" class=""></path>
                                                                                <path fill="#ffffff" d="M355.65 330 367 256h-71v-48.021c0-20.245 9.918-39.979 41.719-39.979H370v-63s-29.296-5-57.305-5C254.219 100 216 135.44 216 199.6V256h-65v74h65v178.889c13.034 2.045 26.392 3.111 40 3.111s26.966-1.066 40-3.111V330z" opacity="1" data-original="#ffffff" class=""></path>
                                                                            </g>
                                                                        </svg>
                                                                        <p class="ms-2"><?php echo $fbdata['fb_app_name']; ?></p>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseOne_in" class="accordion-collapse collapse" data-bs-parent="#accordionExample_two" data-id="<?php echo $fbdata['id']; ?>" data-connection-check="<?php echo $fbdata['verification_status']; ?>">
                                                                    <div class="accordion-body p-0">
                                                                        <div class="border-to pages_div btn_dark border-bottom rounded-1 p-2">
                                                                            <p class="ms-5">Pages</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed m-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                        <g>
                                                            <linearGradient id="a" x1="84.679" x2="404.429" y1="427.321" y2="107.571" gradientUnits="userSpaceOnUse">
                                                                <stop offset="0" stop-color="#fee411"></stop>
                                                                <stop offset=".052" stop-color="#fedb16"></stop>
                                                                <stop offset=".138" stop-color="#fec125"></stop>
                                                                <stop offset=".248" stop-color="#fe983d"></stop>
                                                                <stop offset=".376" stop-color="#fe5f5e"></stop>
                                                                <stop offset=".5" stop-color="#fe2181"></stop>
                                                                <stop offset="1" stop-color="#9000dc"></stop>
                                                            </linearGradient>
                                                            <circle cx="256" cy="256" r="225" fill="url(#a)" opacity="1" data-original="url(#a)" class=""></circle>
                                                            <g fill="#fff">
                                                                <path d="M303.8 131h-95.5c-42.6 0-77.2 34.6-77.2 77.2v95.5c0 42.6 34.6 77.2 77.2 77.2h95.5c42.6 0 77.2-34.6 77.2-77.2v-95.5c0-42.6-34.6-77.2-77.2-77.2zm49.3 172.8c0 27.2-22.1 49.4-49.4 49.4h-95.5c-27.2 0-49.4-22.1-49.4-49.4v-95.5c0-27.2 22.1-49.4 49.4-49.4h95.5c27.2 0 49.4 22.1 49.4 49.4z" fill="#ffffff" opacity="1" data-original="#ffffff"></path>
                                                                <path d="M256 192.1c-35.2 0-63.9 28.7-63.9 63.9s28.7 63.9 63.9 63.9 63.9-28.7 63.9-63.9-28.7-63.9-63.9-63.9zm0 102.7c-21.4 0-38.8-17.4-38.8-38.8s17.4-38.8 38.8-38.8 38.8 17.4 38.8 38.8-17.4 38.8-38.8 38.8z" fill="#ffffff" opacity="1" data-original="#ffffff"></path>
                                                                <circle cx="323.1" cy="188.4" r="10.8" transform="rotate(-9.25 323.353 188.804)" fill="#ffffff" opacity="1" data-original="#ffffff"></circle>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <p class="ms-2">Instagram</p>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body p-0">
                                                    <div class="accordion" id="accordionExample_two">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button m-0 p-2 ps-4 pe-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_in_to" aria-expanded="true" aria-controls="collapseOne_in_to">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                                        <g>
                                                                            <path fill="#1877f2" d="M512 256c0 127.78-93.62 233.69-216 252.89V330h59.65L367 256h-71v-48.02c0-20.25 9.92-39.98 41.72-39.98H370v-63s-29.3-5-57.31-5c-58.47 0-96.69 35.44-96.69 99.6V256h-65v74h65v178.89C93.62 489.69 0 383.78 0 256 0 114.62 114.62 0 256 0s256 114.62 256 256z" opacity="1" data-original="#1877f2" class=""></path>
                                                                            <path fill="#ffffff" d="M355.65 330 367 256h-71v-48.021c0-20.245 9.918-39.979 41.719-39.979H370v-63s-29.296-5-57.305-5C254.219 100 216 135.44 216 199.6V256h-65v74h65v178.889c13.034 2.045 26.392 3.111 40 3.111s26.966-1.066 40-3.111V330z" opacity="1" data-original="#ffffff" class=""></path>
                                                                        </g>
                                                                    </svg>
                                                                    <p class="ms-2">Ajasys All</p>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseOne_in_to" class="accordion-collapse collapse" data-bs-parent="#accordionExample_two">
                                                                <div class="accordion-body p-0">
                                                                    <div class="border-to instagram_div btn_dark border-bottom rounded-1 p-2">
                                                                        <p class="ms-5">instagram</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed m-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" x="0" y="0" viewBox="0 0 176 176" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                        <g>
                                                            <g data-name="Layer 2">
                                                                <g data-name="09.whatsapp">
                                                                    <circle cx="88" cy="88" r="88" fill="#29a71a" opacity="1" data-original="#29a71a" class=""></circle>
                                                                    <g fill="#fff">
                                                                        <path d="M126.8 49.2a54.57 54.57 0 0 0-87.42 63.13l-5.79 28.11a2.08 2.08 0 0 0 .33 1.63 2.11 2.11 0 0 0 2.24.87l27.55-6.53A54.56 54.56 0 0 0 126.8 49.2zm-8.59 68.56a42.74 42.74 0 0 1-49.22 8l-3.84-1.9-16.89 4 .05-.21 3.5-17-1.88-3.71a42.72 42.72 0 0 1 7.86-49.59 42.73 42.73 0 0 1 60.42 0 2.28 2.28 0 0 0 .22.22 42.72 42.72 0 0 1-.22 60.19z" fill="#ffffff" opacity="1" data-original="#ffffff" class=""></path>
                                                                        <path d="M116.71 105.29c-2.07 3.26-5.34 7.25-9.45 8.24-7.2 1.74-18.25.06-32-12.76l-.17-.15C63 89.41 59.86 80.08 60.62 72.68c.42-4.2 3.92-8 6.87-10.48a3.93 3.93 0 0 1 6.15 1.41l4.45 10a3.91 3.91 0 0 1-.49 4l-2.25 2.92a3.87 3.87 0 0 0-.35 4.32c1.26 2.21 4.28 5.46 7.63 8.47 3.76 3.4 7.93 6.51 10.57 7.57a3.82 3.82 0 0 0 4.19-.88l2.61-2.63a4 4 0 0 1 3.9-1l10.57 3a4 4 0 0 1 2.24 5.91z" fill="#ffffff" opacity="1" data-original="#ffffff" class=""></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <p class="ms-2">whatsapp</p>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="border-to pages_div btn_dark border-bottom rounded-1 p-2">
                                        <p>Pages</p>
                                    </div>
                                    <div class="border-top instagram_div btn_dark border-bottom rounded-1 p-2">
                                        <p>instagram</p>
                                    </div> -->
                                </div>
                            </div>
                            <!-- Pages_div -->
                            <!-- second-div -->
                            <div class="d-lg-block col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 col-xxl-3  social-accounts main-box rounded-bottom-0" style="height:80vh">
                                <div class="col-12 border rounded-3 bg-white position-lg-relative rounded-bottom-0" style="height:80vh">
                                    <div class="chat-nav-search-bar p-2 col-12  rounded-top-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="dropdown d-flex align-items-center ps-2">
                                                <h5 class="fs-5 fw-semibold ">Select assets</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- pades div  -->
                                    <div class="Pages_div">
                                        <div class="cursor-pointer ps-3 account-box d-flex  flex-wrap  border-bottom alihgn-items-center">
                                            <div class="d-flex align-items-center" style="height: 45px;">
                                                <input type="checkbox" id="selectall" class="me-2 rounded-3 select_all_checkbox" style="width:18px;height:18px;">
                                                <div class="col fs-6 fw-semibold">
                                                    Select all
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 overflow-x-hidden" style="height:500px;">
                                            <ul class="page_asset_list overflow-y-scroll" style="height:490px;">
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- instagram div  -->
                                    <div class="instagram_div_to d-none">
                                        <div class="d-flex justify-content-between ms-3 me-3 mt-2">
                                            <div>
                                                <p>Search & Fliter</p>
                                            </div>
                                            <div><i class="bi bi-search"></i></div>
                                        </div>
                                        <div class="cursor-pointer ps-3 account-box d-flex  flex-wrap  border-bottom alihgn-items-center">
                                            <div class="d-flex align-items-center" style="height: 45px;">
                                                <input type="checkbox" id="selectall" class="me-2 rounded-3 select_all_checkbox" style="width:18px;height:18px;">
                                                <div class="col fs-6 fw-semibold">
                                                    Select all
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-3 me-3 mt-2 d-flex align-items-center">
                                            <input type="checkbox" id="selectall" class="me-2 rounded-3 select_all_checkbox" style="width:18px;height:18px;">
                                            <img class="rounded-circle me-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAAAq1BMVEUrMUD8r0//////sk8UKD+2hEn/tFBxWkUoL0AiKTklLkAVHTEaKj9laXOkpqwhLEDfnk3m5+i7vcHppE6ZckcyNkH3rE9+YkXvp05ZXWhRR0KMa0ahd0isfklhUENPVF8zOUnJkEu/ikrQGx7PJinv8PHXmUw8QU/d3uAcIzV3e4M/M0J8LjmzHyWraG5vESGwsreVmJ7Jys1GS1gJFSu5q6/HvL80JzgAIj9vDd0LAAAEn0lEQVRogbWa22KiMBCGI+EQIBpUDhURLC1V3O3uFt3D+z/ZoqCSEENQnIuWtvD5MzNJJpkCpWHTYrJH4G5D+68ia/LA9XK2sA/5A+zScjsfFxx4sbbNh8C1mYdNwcCz8eExzQ1Dhx0F327yodBHs5PsCt+ag3jkauYmO8Oz9cDskp6c4eNBfVKZvavgs8Pw7JJenOBosDxpmrk/wmf2M9gAHIoSvhg8mpWZYwVkctFEFsFYLQ1jYsn50cxA0R1ORDDxQmMZrTRtFS2N0Ct/0f0BdgEmXcotDGL3dT7SdR2WVn4bzV/dGKlWx4P5BCzEEggOI2cE4Yiy8mcnCjERPooSIGRbOE59llzzdT+NSZd6wUerYYnmkWv+KA3VOwcJ8SJfv40+mu5Hntg3NwyHHwLVF/UfIe6NRjgQeaRB9wPc0zWIuFLoIx26EknfZFuaLPuI1yTHbK1b64gkbbrWQzuW9slZuysdVRz0ZJf0QJJOQm6ewNPkcvzCo/uhVL4jj5PfEPqOtgwMI3A1hzchwA9Pxu1q1HoU6o4bgnImLw1jELpOWz6MVCmnsM/pToDwNduQhVHgtNLJD7tnMZIyj8FR5LFjEGEvGjHi9bQzpiRmX/fF4A1vhI0Xhu7HXTHFKf0InMc3BOF4ztzaJd1iPA5fbsshMaO9y+tqxHjcEKjBBuP1SCgdAQf2uB3TUqAjXDSZcEJHPDKQR2sZCUPKzFh6PWOYHKvuD2jpwvmLvDbh0DnVqAgtxi1bVH+yKOnwVaAceXOOEHOicGxicl51LnCjFVIerFILJTy2oiQItFNXkIzEaLqwDj7aZzx2dtoOM+mlG7f9gpdNuK7V4dxN27bd1SGlFkR9eTuidN7q59jb5rqyb9+/f6svTZurRzAu1BX1jgE5K8+OYrPfn29vn7+r62mtnFDJCFe3J3WVKihg5cCrz3+8vb+//aB8XoaJekTrC79kCwWvsqUPnO+Wc57/+Xx///xD5TnrFgGcCWgdepQni8r+/vz5t75M6sMT7ErD+am4/zVr2a89LxVFcO4gAustbxBt16e3ogeRCP7w8BfBuRMXAgWPXSlnJi4RvDXlnooVtPmatOxrU83Gjjycv1ig3G5ZlSzMYtGh/MFlTgjvuUCrK7Y6E8HZ9bxfadEFf6go6oI/Us51w0nMVNBlIcrbgnMK0W54Kb1VQq+kSmgZOOv1kWzxLwO/d9siB7+94XIFGy5JOG9XVMkXbRVl4fdscuXh/bfnfeB9DxZ6wXseifSEnw5z7sDLweWPoe6BSx+gvdwFlzv6c6XLOdY1apjypqcLyk/Df4aoKBIft5I49flDspwQ0hhbRAhPHjsoFlS5aAEmXV0FS0W8I26AT3urUjm8mp424PkEFN0tC9HhvBWm2tXSZWPFtQuQybUsLm0FlWkrWGrTmqt5ngFl/MSGiCLRtLjLTq0cZfOUJhRaP7F9diie1/jL68ZfuaUcvmW5V2q4Mt0M3WwF0wtcyZJBu3/5/sS+dM93h8HEm0yD+7iBSgbBI/OQXLaWjX8q2O429mO9f9O2N7vGrrUBP/Jnu/X97P1uRu+H/wOz32TOcdH3qgAAAABJRU5ErkJggg==" alt="" style="width:30px;height:30px">
                                            <p>@ajasystechnologiies</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- third-div -->
                            <div class="d-none col-12 col-sm-12 col-md-12 col-lg-6 d-xl-block col-xxl-6 transcript_box  main-box rounded-bottom-0" style="height:80vh">
                                <div class="col-12 border rounded-end-4 bg-white position-relative SetChatBackGroundClass rounded-3 overflow-hidden rounded-bottom-0" style="height:80vh">
                                    <div class="chat-nav-search-bar p-2 col-12 rounded-top-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="dropdown d-flex align-items-center ps-2 ">
                                                <h5 class="fs-5 fw-semibold ">Assign Permission</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Pages_div -->
                                        <div class=" Pages_div col-12 overflow-y-scroll" style="height:90vh;">
                                            <div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop create_scenarios" type="checkbox" value="create_scenarios">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Create Scenarios</p>
                                                        <p class="ms-3">Create, manage or delete scenarios for lead retrieval.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop leads" type="checkbox" value="leads">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Leads</p>
                                                        <p class="ms-3">Access and view leads.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop post_comments" type="checkbox" value="post_comments">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Post & Comments</p>
                                                        <p class="ms-3">Create, view and manage post and their comments.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop messages" type="checkbox" value="messages">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Messages</p>
                                                        <p class="ms-3">Manage page messages.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- instagram -->
                                        <div class="instagram_div_to d-non col-12 overflow-y-scroll" style="height:90vh;">
                                            <div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop" type="checkbox">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Content</p>
                                                        <p class="ms-3">Create, manage or delete posts, stories and more as the Instagram account. View posts from other Instagram accounts that this account follows.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop" type="checkbox">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Messages</p>
                                                        <p class="ms-3">Send and respond to direct messages as the Instagram account.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop" type="checkbox">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Community activity</p>
                                                        <p class="ms-3">Review and respond to comments, remove unwanted content and report activity.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop" type="checkbox">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Ads</p>
                                                        <p class="ms-3">Create, manage and delete ads for the Instagram account.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop" type="checkbox">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Insights</p>
                                                        <p class="ms-3">See how the Instagram account, content and ads perform.</p>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary assign_permission" id="assign_permission">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('body').on('click', '.account-box', function() {
        $(this).addClass('active-account-box');
        $(this).siblings().removeClass('active-account-box');
    });
    $(document).ready(function() {
        $('#selectall').click(function() {
            $('.selectedId').prop('checked', this.checked);
        });

        var checkedValues = [];
        $(document).on('change', '.selectedId', function() {
            var check = $('.selectedId:checked').length === $('.selectedId').length;
            $('#selectall').prop('checked', check);
            var value = $(this).val();
            if ($(this).is(':checked')) {
                checkedValues.push(value);
            } else {
                var index = checkedValues.indexOf(value);
                if (index !== -1) {
                    checkedValues.splice(index, 1);
                }
            }
            $('#asset_ids').val(checkedValues);
        });
        $("body").on("click", ".pages_div", function() {
            $(".Pages_div").removeClass("d-none");
            $(".instagram_div_to").addClass("d-none");
        });
        $("body").on("click", ".instagram_div", function() {
            $(".Pages_div").addClass("d-none");
            $(".instagram_div_to").removeClass("d-none");
        });
        $("body").on("click", ".assign_asset", function() {
            var userid = $('#assign_user #user').find(':selected').val();
            if (userid > 0) {
                $('#select_user').val(userid);
            } else {
                $('#select_user').val(0);
            }
        });
        $("body").on("click", "#collapseOne_in", function() {
            var connection_id = $(this).attr('data-id');
            var fb_check_conn = $(this).attr('data-connection-check');
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('facebook_pageasset'); ?>",
                data: {
                    fb_check_conn: fb_check_conn,
                    connection_id: connection_id,
                    action: 'user'
                },
                success: function(res) {
                    $('.loader').hide();
                    var result = JSON.parse(res);
                    if (result.response == 1) {
                        $('.page_asset_list').html(result.html);
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
        });
        var selectedValues = [];
        $('.toggle-checkbox').on('click', function() {
            var value = $(this).val();
            if ($(this).is(':checked')) {
                selectedValues.push(value);
            } else {
                var index = selectedValues.indexOf(value);
                if (index !== -1) {
                    selectedValues.splice(index, 1);
                }
            }
            $('#asset_array').val(selectedValues);
        });
        $("body").on("click", "#assign_permission", function() {
            var userId = $('#select_user').val();
            var asset_array = $('#asset_array').val();
            var asset_ids = $('#asset_ids').val();
            if (asset_ids.length > 0) {
                if (asset_array.length > 0) {
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('assign_asset_permission'); ?>",
                        data: {
                            action: 'insert',
                            user_id: userId,
                            page_id: asset_ids,
                            asset_array: asset_array,
                        },
                        success: function(res) {
                            var result = JSON.parse(res);
                            if (result.responce == 1) {
                                iziToast.success({
                                    title: result.msg
                                });
                            }
                            else
                            {
                                iziToast.error({
                                    title: result.msg
                                });
                            }
                        },
                        error: function(error) {
                            $('.loader').hide();
                        }
                    });
                } else {
                    iziToast.error({
                        title: 'Please assign any permission..!'
                    });
                }
            } else {
                iziToast.error({
                    title: 'Please any select assets..!'
                });
            }
        });
    });
</script>