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
                    <h2>Assign Assets Permission</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button class="btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal_to">
                        Assign assets
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
    <div class="modal fade" id="exampleModal_to" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select id="facebookpages" class="selectpicker form-control form-main" data-live-search="true" required>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_one">Assign assets</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal two-->
    <div class="modal fade" id="exampleModal_one" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fs-5">Assign assets and Set Permission</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-0 p-0">
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

                                    <div class="border-to pages_div btn_dark border-bottom rounded-1 p-2">
                                        <p>Pages</p>
                                    </div>
                                    <div class="border-top instagram_div btn_dark border-bottom rounded-1 p-2">
                                        <p>instagram</p>
                                    </div>

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
                                        <ul class="">
                                            <?php

                                            foreach ($resultdata as $key => $page_data) {
                                                $pagesList = get_object_vars(json_decode(fb_page_list($page_data['access_token'])));
                                                foreach ($pagesList['page_list'] as $key => $pagelist_data) {
                                                    $page_imgdata = fb_page_img($pagelist_data->id, $pagelist_data->access_token);
                                                    // pre($page_imgdata);
                                                    $page_imgdata = json_decode($page_imgdata);
                                            ?>
                                                    <li class="cursor-pointer py-2 ps-3 account-box d-flex  flex-wrap align-items-center active-account-box select_part_checkbox">
                                                        <input type="checkbox" class="me-2 rounded-3 selectedId" name="selectedId" style="width:18px;height:18px;">
                                                        <img class="rounded-circle me-1" src="<?php echo $page_imgdata->page_img; ?>" alt="" style="width:30px;height:30px">
                                                        <p class="col"><?php echo $pagelist_data->name; ?></p>
                                                    </li>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </ul>
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

                                    <div class="card-body ">

                                        <!-- Pages_div -->
                                        <div class=" Pages_div col-12 overflow-y-scroll" style="height:90vh;">
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
                                                        <p class="ms-3">Create, manage or delete posts, stories and more as the Page.
                                                            Protect your copyrighted content.</p>
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
                                                        <p class="ms-3">Review and respond to comments, remove unwanted content and report
                                                            activity.</p>
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
                                                        <p class="col ms-3 fw-bold fs-14">Messages and calls</p>
                                                        <p class="ms-3">Send and respond to messages and calls as the Page.</p>
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
                                                        <p class="ms-3">Create, manage and delete ads for the Page.</p>
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
                                                        <p class="ms-3">See how the Page, content and ads perform.</p>
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
                                                        <p class="col ms-3 fw-bold fs-14">Revenue</p>
                                                        <p class="ms-3">View and export Page Monetization and earnings data within Creator
                                                            Studio only.
                                                        </p>
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
                                                        <p class="col ms-3 fw-bold fs-14">Leads</p>
                                                        <p class="ms-3">
                                                            Access and manage leads, including downloading leads, creating lead ads and
                                                            more.
                                                            Partial access (business tools and Facebook)
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-12 p-2 d-flex align-items-center border-bottom">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop" type="checkbox">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Content, Messages, Community activity, Ads,
                                                            Insights</p>
                                                        <p class="ms-3">
                                                            Access and manage leads, including downloading leads, creating lead ads and
                                                            more.
                                                            Partial access (business tools and Facebook)
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-2 d-flex align-items-center border-bottom" style="margin-bottom: 200px;">
                                                    <div class="col-1">
                                                        <label class="switch_toggle_primary">
                                                            <input class="toggle-checkbox fs-3 on_off_btn_Desktop" type="checkbox">
                                                            <span class="check_input_primary round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="col ms-3 fw-bold fs-14">Everything</p>
                                                        <p class="ms-3">
                                                            Access and manage leads, including downloading leads, creating lead ads and
                                                            more.
                                                            Partial access (business tools and Facebook)
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- instagram -->
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
                    <button type="button" class="btn btn-primary">Save changes</button>
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

        $('.selectedId').change(function() {
            var check = ($('.selectedId').filter(":checked").length == $('.selectedId').length);
            $('#selectall').prop("checked", check);
        });

        $("body").on("click", ".pages_div", function() {
            $(".Pages_div").removeClass("d-none")
            $(".instagram_div_to").addClass("d-none");
        })
        $("body").on("click", ".instagram_div", function() {
            $(".Pages_div").addClass("d-none");
            $(".instagram_div_to").removeClass("d-none");
        })
    });
</script>