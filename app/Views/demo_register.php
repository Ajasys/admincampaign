<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
// pre($_SESSION['role']);
// pre( $get_roll_id_to_roll_duty_var);
?>
<style type="text/css">
    #clear {
        display: none;
    }
</style>
<?php
$userUnderEmployee = userUnderEmployee($_SESSION['id']);
$master_inquiry_type = json_decode($master_inquiry_type, true);
$master_inquiry_source = json_decode($master_inquiry_source, true);
$master_inquiry_close = json_decode($master_inquiry_close, true);
$master_inquiry_status = json_decode($master_inquiry_status, true);
$admin_product = json_decode($admin_product, true);
$getStatusWiseData = array();
$username = session_username($_SESSION['username']);
$this->db = DatabaseDefaultConnection();

$visit_and_revisit_count = demo_and_subscription_count($username . '_all_inquiry', $_SESSION['id']);

if (isset($visit_and_revisit_count)) {
    $visit = $visit_and_revisit_count[0]['count'];
    if (isset($visit_and_revisit_count[0]['all_data2'])) {
        $revisit = $visit_and_revisit_count[0]['all_data2'][0]['revisit'];
    } else {
        $revisit = 0;
    }
    // $full_total = $visit + $revisit;
    // echo $full_total;
}

?>
<!-- -------------------------------------------------------------today follow main content start----------------------------------------- -->
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="bg-color-white p-3 rounded">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="title-1 d-flex justify-content-center align-items-center">
                        <i class="bi bi-people me-2"></i>
                        <h2>Demo Register</h2>
                    </div>
                    <div class="d-flex align-items-center">
                    <?php if (in_array('demo_inquiry_import_csv_permission', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <i class="bi bi-file-earmark-arrow-up-fill text-secondary fs-3" data-bs-toggle="modal" data-bs-target="#import_csv"></i>
                        <?php } ?>
                        <!-- <i class="bi bi-file-earmark-arrow-down-fill export-inq text-secondary fs-3"></i> -->
                        <?php if (in_array('demo_inquiry_export_csv_permission', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
							<a href="#" class="add_property_js add_user_role_css add_user-role-pdf export-inq">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 2462 2462" fill="none">
									<path d="M1724.37 1682.33H945.625C914.92 1682.33 890 1657.41 890 1626.7V514.204C890 483.499 914.92 458.579 945.625 458.579H1724.37C1755.08 458.579 1780 483.499 1780 514.204V1626.7C1780 1657.41 1755.08 1682.33 1724.37 1682.33Z" fill="#ECEFF1" />
									<path d="M1168.12 792.328H945.625C914.92 792.328 890 767.408 890 736.703C890 705.998 914.92 681.078 945.625 681.078H1168.12C1198.83 681.078 1223.75 705.998 1223.75 736.703C1223.75 767.408 1198.83 792.328 1168.12 792.328ZM1168.12 1014.83H945.625C914.92 1014.83 890 989.908 890 959.203C890 928.498 914.92 903.578 945.625 903.578H1168.12C1198.83 903.578 1223.75 928.498 1223.75 959.203C1223.75 989.908 1198.83 1014.83 1168.12 1014.83ZM1168.12 1237.33H945.625C914.92 1237.33 890 1212.41 890 1181.7C890 1151 914.92 1126.08 945.625 1126.08H1168.12C1198.83 1126.08 1223.75 1151 1223.75 1181.7C1223.75 1212.41 1198.83 1237.33 1168.12 1237.33ZM1168.12 1459.83H945.625C914.92 1459.83 890 1434.91 890 1404.2C890 1373.5 914.92 1348.58 945.625 1348.58H1168.12C1198.83 1348.58 1223.75 1373.5 1223.75 1404.2C1223.75 1434.91 1198.83 1459.83 1168.12 1459.83ZM1501.87 792.328H1390.62C1359.92 792.328 1335 767.408 1335 736.703C1335 705.998 1359.92 681.078 1390.62 681.078H1501.87C1532.58 681.078 1557.5 705.998 1557.5 736.703C1557.5 767.408 1532.58 792.328 1501.87 792.328ZM1501.87 1014.83H1390.62C1359.92 1014.83 1335 989.908 1335 959.203C1335 928.498 1359.92 903.578 1390.62 903.578H1501.87C1532.58 903.578 1557.5 928.498 1557.5 959.203C1557.5 989.908 1532.58 1014.83 1501.87 1014.83ZM1501.87 1237.33H1390.62C1359.92 1237.33 1335 1212.41 1335 1181.7C1335 1151 1359.92 1126.08 1390.62 1126.08H1501.87C1532.58 1126.08 1557.5 1151 1557.5 1181.7C1557.5 1212.41 1532.58 1237.33 1501.87 1237.33ZM1501.87 1459.83H1390.62C1359.92 1459.83 1335 1434.91 1335 1404.2C1335 1373.5 1359.92 1348.58 1390.62 1348.58H1501.87C1532.58 1348.58 1557.5 1373.5 1557.5 1404.2C1557.5 1434.91 1532.58 1459.83 1501.87 1459.83Z" fill="#388E3C" />
									<path d="M981.114 248.869C968.431 238.3 951.41 233.739 935.39 237.076L45.39 403.951C32.6297 406.309 21.0999 413.066 12.8066 423.046C4.51337 433.027 -0.0183085 445.599 5.55947e-05 458.575V1682.32C5.55947e-05 1709.02 19.0238 1732.05 45.39 1736.95L935.39 1903.82C938.727 1904.49 942.176 1904.82 945.625 1904.82C958.53 1904.82 971.101 1900.37 981.114 1892.03C987.412 1886.81 992.482 1880.27 995.962 1872.86C999.443 1865.46 1001.25 1857.38 1001.25 1849.2V291.7C1001.25 275.124 993.907 259.437 981.114 248.869Z" fill="#2E7D32" />
									<path d="M764.951 1256.35L589.065 1055.32L766.954 826.588C785.866 802.335 781.416 767.403 757.275 748.49C733.134 729.578 698.201 734.028 679.178 758.169L514.417 969.989L375.577 811.347C355.218 787.984 320.063 785.87 297.145 806.118C274.005 826.365 271.669 861.52 291.917 884.549L444.885 1059.43L289.803 1258.79C270.89 1283.05 275.34 1317.98 299.482 1336.89C309.295 1344.47 321.347 1348.58 333.747 1348.57C350.323 1348.57 366.677 1341.23 377.69 1327.1L519.534 1144.65L681.291 1329.44C686.477 1335.45 692.899 1340.27 700.118 1343.57C707.337 1346.87 715.183 1348.58 723.121 1348.57C736.138 1348.57 749.154 1344.01 759.723 1334.78C782.863 1314.53 785.199 1279.38 764.951 1256.35Z" fill="#FAFAFA" />
									<circle cx="1876" cy="1639.88" r="586" fill="#2E7D32" />
									<path d="M2218 1868.24V1754.06C2218 1746.49 2215 1739.23 2209.65 1733.88C2204.31 1728.52 2197.06 1725.52 2189.5 1725.52C2181.94 1725.52 2174.69 1728.52 2169.35 1733.88C2164 1739.23 2161 1746.49 2161 1754.06V1868.24C2161 1875.81 2158 1883.07 2152.65 1888.43C2147.31 1893.78 2140.06 1896.79 2132.5 1896.79H1619.5C1611.94 1896.79 1604.69 1893.78 1599.35 1888.43C1594 1883.07 1591 1875.81 1591 1868.24V1754.06C1591 1746.49 1588 1739.23 1582.65 1733.88C1577.31 1728.52 1570.06 1725.52 1562.5 1725.52C1554.94 1725.52 1547.69 1728.52 1542.35 1733.88C1537 1739.23 1534 1746.49 1534 1754.06V1868.24C1534 1890.95 1543.01 1912.74 1559.04 1928.8C1575.08 1944.86 1596.82 1953.88 1619.5 1953.88H2132.5C2155.18 1953.88 2176.92 1944.86 2192.96 1928.8C2208.99 1912.74 2218 1890.95 2218 1868.24ZM2036.17 1719.24L1893.67 1833.42C1888.64 1837.4 1882.41 1839.57 1876 1839.57C1869.59 1839.57 1863.36 1837.4 1858.33 1833.42L1715.83 1719.24C1710.64 1714.33 1707.47 1707.64 1706.97 1700.51C1706.46 1693.38 1708.64 1686.31 1713.08 1680.71C1717.53 1675.12 1723.9 1671.39 1730.96 1670.28C1738.01 1669.17 1745.22 1670.75 1751.17 1674.7L1847.5 1751.78V1354.42C1847.5 1346.85 1850.5 1339.59 1855.85 1334.24C1861.19 1328.89 1868.44 1325.88 1876 1325.88C1883.56 1325.88 1890.81 1328.89 1896.15 1334.24C1901.5 1339.59 1904.5 1346.85 1904.5 1354.42V1751.78L2000.83 1674.7C2003.7 1671.99 2007.1 1669.9 2010.82 1668.58C2014.54 1667.25 2018.49 1666.71 2022.42 1666.99C2026.36 1667.27 2030.2 1668.37 2033.69 1670.21C2037.18 1672.06 2040.25 1674.61 2042.7 1677.7C2045.16 1680.79 2046.95 1684.37 2047.95 1688.19C2048.96 1692.01 2049.16 1696 2048.55 1699.91C2047.93 1703.81 2046.51 1707.54 2044.38 1710.87C2042.25 1714.2 2039.46 1717.05 2036.17 1719.24Z" fill="white" />
								</svg>
							</a>
						<?php } ?>
                        <button class="btn-primary-rounded mx-1" type="button" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update" aria-controls="inquiry_all_status_update">
                            <i class="bi bi-plus"></i>
                        </button>
                        <button class="btn-primary-rounded mx-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <i class="bi bi-funnel fs-14"></i>
                        </button>
                    </div>
                </div>
                <div class="main-select-section  col-xl-12">
                    <form class="needs-validation" name="assign_form" method="POST" novalidate>
                        <div class="d-flex justify-content-start flex-wrap align-items-end col-xl-6 col-12 col-sm-12 col-md-10 col-lg-10 mb-2">
                            <!-- <div class="main-selection-toggle d-flex align-items-end flex-wrap"> -->
                                <div class="bulk-action select col-lg-6 col-xl-5 px-1 mt-lg-0 col-12 col-md-6 col-sm-6 mb-1">
                                    <label class="form-label main-label">Select Action</label>
                                    <div class="main-selectpicker">
                                        <select name="action_name" id="action_name" id="bulk-action" class="selectpicker form-control form-main" data-live-search="true" required="">
                                            <option value="">Select Action</option>
                                            <option value="assign_followups">Assign Followups</option>
                                            <option value="transfer_ownership">Transfer Inq</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="employee-action select col-lg-6 col-xl-5 px-1 mt-lg-0 col-12 col-md-6 col-sm-6 mb-1">
                                    <label class="form-label main-label">Select Employee</label>
                                    <div class="main-selectpicker">
                                        <select id="assign_id" name="assign_id" class="selectpicker form-control form-main" data-live-search="true" required="">
                                            <option value="">Select employee</option>
                                            <option value="1">1</option>
                                            <option value="1">1</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="submit-btn-width col-xl-2 px-1 mb-1">
                                    <label for="areaname" class="form-label"></label>
                                    <button class="btn-primary inquiry_assign" id="inquiry_assign_btn" data-edit_id="" name="inquiry_assign" value="inquiry_assign">submit</button>
                                </div>
                            <!-- </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="px-3 py-2 bg-white rounded-2 mx-2">
            <div class="row row-table">
                <div class="col-12 filter-show d-flex" id="filter-showw"></div>
                <div class="col-12">
                    <button class="btn bg-danger mx-1 mt-2 clear btn-sm text-white fs-7" id="clear">Clear All</button>
                </div>
                <table id="today-follow-feedback" class="table w-100 main-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="selectall" id="select_all">
                            </th>
                            <th><span>Inquiry Detail</span></th>
                        </tr>
                    </thead>
                    <tbody id="inquiry_all_status_list" class="inquiry_all_status_list"></tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
                    <div class="row_count_div col-xl-6 col-xxs-12">
                        <p id="row_count"></p>
                    </div>
                    <div class="clearfix  col-xl-6 col-xxs-12">
                        <ul class="inq_pagination justify-content-xl-end" id="inq_pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="import_csv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;">
        <div class="modal-content">
            <form class="needs-validation" name="import_inquiry_csv" method="POST" novalidate="">
                <div class="modal-header">
                    <h4 class="modal-title">Add Inquiry</h4>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery">
                    <div class="modal-body-card align-items-end justify-content-between">
                        <div class="col-12 col-sm-6 col-xl-4">
                            <label for="" class="form-label main-label">Inq CSV upload :</label>
                            <input type="file" class="form-control form-controll" id="import_file" name="import_file" placeholder="Details" required="">
                        </div>
                        <a href="<?php echo base_url('/assets/import_inq.csv'); ?>" download='import_inq.csv' class="add_property_js add_user_role_css add_user-role-pdf">
                            <i class="bi bi-file-earmark-arrow-down-fill fs-3" style="color: var(--second-color);"></i>
                        </a>
                    </div>
                    <h6 class="modal-body-title">CST Interest</h6>
                    <div class="modal-body-card">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label class="form-label main-label">Interested Area</label>
                            <div class="main-selectpicker">
                                <select name="intrested_area" id="intrested_area" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Area</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label class="form-label main-label">Property Sub
                                Type</label>
                            <div class="main-selectpicker">

                                <select name="property_sub_type" id="property_sub_type" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Property Type</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label class="form-label main-label">Interested Site</label>
                            <div class="main-selectpicker">
                                <select name="intrested_site" id="intrested_site" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Interested Site</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label class="form-label main-label">Assign Id</label>
                            <div class="main-selectpicker">
                                <select class="selectpicker form-control form-main" id="assign_id" name="assign_id" data-live-search="true" required="">
                                    <option class="dropdown-item" value="">Assign To</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label class="form-label main-label">Owner Id</label>
                            <div class="main-selectpicker">
                                <select class="selectpicker form-control form-main" id="owner_id" name="owner_id" data-live-search="true" required="">
                                    <option class="dropdown-item" value="">owner To</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <h6 class="modal-body-title">Inquiry Information</h6>
                    <div class="modal-body-card">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label for="inquiry_type" class="form-label form-labell">Inquiry
                                Type</label>
                            <div class="main-selectpicker">
                                <select name="inquiry_type" id="inquiry_type" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Inquiry Type</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label for="inquiry_source_type" class="form-label form-labell">Inquiry
                                Source</label>
                            <div class="main-selectpicker">
                                <select name="inquiry_source_type" id="inquiry_source_type" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Source Type</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="custom_Date_class">
                                <label for="nxt_follow_up" class="form-label form-labell">Next Follow up</label>
                                <input type="text" class="nxt_follow_up min-datetime form-control main-control input-main" placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" name="nxt_follow_up" value="" required="" />
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer2">
                    <button class="btn btn-primary import_inquiry_csv_btn" type="submit" id="import_inquiry_csv_btn" name="import_inquiry_csv_btn">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade inquiry_all_status_update" id="inquiry_all_status_update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inquiry_all_status_update" aria-hidden="true">
    <div class="modal-dialog" style="max-width:1000px;">
        <form class="needs-validation" name="inquiry_all_status_update_form" id="inquiry_all_status_update_form" method="POST" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title tag_name">Add Inquiry <span id="inquiry_unique_id"></span></h4>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery">
                    <h6 class="modal-body-title">Personal Inq</h6>  
                    <div class="modal-body-card">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">Mobile No. <sup class="validationn">*</sup></label>
                            <input type="text" minlength="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control main-control mobileno" id="mobileno" name="mobileno" placeholder="Mobile No." value="" data-phone_id="" required>
                            <div class="number-error">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">Full name <sup class="validationn">*</sup> </label>
                            <input type="text" class="form-control main-control" id="full_name" name="full_name" placeholder="Enter Firstname" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">Alt. Mobile No. :</label>
                            <input type="text" minlength="10" maxlength="10" class="form-control main-control altmobileno" id="altmobileno" name="altmobileno" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Alt. Mobile No." value="">
                            <div class="number-error2"></div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">Email</label>
                                <input type="text" class="form-control main-control" id="email" name="email" placeholder="Enter Email Address" value="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">House</label>
                                <input type="text" class="form-control main-control" id="houseno" name="houseno" placeholder="House" value="">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">Society</label>
                                <input type="text" class="form-control main-control" id="society" name="society" placeholder="Society" value="">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">Area<sup class="validationn">*</sup></label>
                                <input autocomplete="off" list="cities" role="combobox" class="form-control main-control" name="area" id="area" data-area_id="" placeholder="Select Area" required="" />
                                <datalist id="cities" style="margin-top:45px;">
                                    <?php
                                    if (isset($area)) {
                                        foreach ($area as $area_key => $area_value) {
                                            echo '<option data-area_option_id="' . $area_value["id"] . '" value="' . $area_value["area"] . '" data-city="' . $area_value["city"] . '">' . $area_value["area"] . '</option>';
                                        }
                                    }
                                    ?>
                                </datalist>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label class="form-label main-label">City<sup class="validationn">*</sup></label>
                                <input autocomplete="off" list="select_people_area" role="combobox" class="form-control main-control" name="city" id="city" placeholder="Select City" required="" />
                                <datalist id="select_people_area" style="margin-top:45px;">
                                    <?php
                                    if (isset($area)) {
                                        foreach ($area as $area_key => $area_value) {
                                            echo '<option data-area_option_id="' . $area_value["city"] . '" value="' . $area_value["city"] . '" >' . $area_value["city"] . '</option>';
                                        }
                                    }
                                    ?>
                                </datalist>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="custom_Date_class">
                                <label class="form-label main-label">Date of Birth</label>
                                <input type="text" class="max-date form-control main-control input-main " placeholder="DD/MM/YYYY" id="dob" name="dob" value="" />
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="custom_Date_class">
                                <label class="form-label main-label">Anniversary Date</label>
                                <input type="text" class="max-date form-control main-control input-main " placeholder="DD/MM/YYYY" id="anni_date" name="anni_date" value="" />
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <h6 class="modal-body-title">CST Interest</h6>
                    <div class="modal-body-card">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
                            <label for="project_type" class="form-label main-label">Int Product <sup class="validationn">*</sup></label>
                            <div class="main-selectpicker">
                                <select class="selectpicker form-control form-main" id="intrested_product" name="intrested_product" data-live-search="true" required="">
                                    <option class="dropdown-item" value="">Select Int Product</option>
                                    <option class="dropdown-item" value="Realtosmaert">Realtosmaert</option>
                                    <option class="dropdown-item" value="Gym Smart">Gymsmart</option>
                                    <option class="dropdown-item" value="Lead MGT Crm">Leadmgtcrm</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
                            <label for="" class="form-label main-label">Subscription <sup class="validationn">*</sup></label>
                                <div class="main-selectpicker">
                                <select class="selectpicker form-control form-main" id="subscription" name="subscription" data-live-search="true" required="">
                                    <option class="dropdown-item" value="">Select Subscription</option>
                                    <option class="dropdown-item" value="Core">Core</option>
                                    <option class="dropdown-item" value="Advance">Advance</option>
                                    <option class="dropdown-item" value="Enterprise">Enterprise</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="budget" class="form-label main-label">Budget<sup class="validationn">*</sup></label>
                            <select id="budget" name="budget" class="form-control main-control" required>
                                <i class="fa-solid fa-caret-down"></i>
                                <option class="dropdown-item" value="">Select budget</option>
                                <?php for ($i = 1; $i <= 100; $i++) {
                                    echo '<option class="dropdown-item" value="' . $i . '">' . $i . '</option>';
                                } ?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="purpose_buy" class="form-label main-label">Inquier As<sup class="validationn">*</sup></label>
                            <div class="main-selectpicker">
                                <select name="buying_as" id="buying_as" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Inquier of Type</option>
                                    <option class="dropdown-item" value="Agency">Agency</option>
                                    <option class="dropdown-item" value="Builder">Builder</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="approx_buy" class="form-label main-label">Apx Buying Time<sup class="validationn">*</sup></label>
                            <div class="main-selectpicker">
                                <!-- set dropdown here -->
                                <select id="approx_buy" name="approx_buy" class="selectpicker form-control form form-main" data-live-search="true" required>
                                    <i class="fa-solid fa-caret-down"></i>
                                    <option class="dropdown-item" value="">Select Apx Time</option>
                                    <option class="dropdown-item" value="2-3 days">2-3 Days</option>
                                    <option class="dropdown-item" value="week">Week</option>
                                    <option class="dropdown-item" value="10-15_days">10-15 Days</option>
                                    <option class="dropdown-item" value="1-month">1 Month</option>
                                    <option class="dropdown-item" value="2-month">2 Month</option>
                                    <option class="dropdown-item" value="3-month">3 Month</option>
                                    <option class="dropdown-item" value="4-month">4 Month</option>
                                    <option class="dropdown-item" value="5-month">5 Month</option>
                                    <option class="dropdown-item" value="6-month">6 Month</option>
                                    <option class="dropdown-item" value="7-month">7 Month</option>
                                    <option class="dropdown-item" value="8-month">8 Month</option>
                                    <option class="dropdown-item" value="9-month">9 Month</option>
                                    <option class="dropdown-item" value="10-month">10 Month</option>
                                    <option class="dropdown-item" value="11-month">11 Month</option>
                                    <option class="dropdown-item" value="1-year">1 Year</option>
                                    <option class="dropdown-item" value="1.5-year">1.5 Year</option>
                                    <option class="dropdown-item" value="2-year">2 Year</option>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <h6 class="modal-body-title">Inq Information</h6>
                    <div class="modal-body-card">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label class="form-label main-label">Inq Type<sup class="validationn">*</sup></label>
                            <div class="main-selectpicker">
                                <select name="inquiry_type" id="inquiry_type" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <option class="dropdown-item" value="">Select Inq Type</option>
                                    <?php
                                    if (isset($master_inquiry_type)) {
                                        foreach ($master_inquiry_type as $type_key => $type_value) { ?>
                                                        <option class="dropdown-item" value="<?php echo $type_value["id"]; ?>"><?php echo $type_value["inquiry_details"]; ?></option>
                                                <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label class="form-label main-label">Inq Source<sup class="validationn">*</sup></label>
                            <div class="main-selectpicker">
                                <select name="inquiry_source_type" id="inquiry_source_type" class="selectpicker form-control form-main" data-live-search="true" required>
                                    <option class="dropdown-item" value="">Select Source Type</option>
                                    <?php
                                    if (isset($master_inquiry_source)) {
                                        foreach ($master_inquiry_source as $source_key => $source_cvalu) { ?>
                                                            <option class="dropdown-item" value="<?php echo $source_cvalu["id"]; ?>"><?php echo $source_cvalu["source"]; ?></option>
                                            <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 nxtiii">
                            <div class="custom_Date_class">
                                <label class="form-label main-label">Next Follow up <sup class="validationn">*</sup></label>
                                <input type="text" class="nxt_follow_up min-datetime form-control main-control" placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" name="nxt_follow_up" value="" required="" />
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <h6 class="modal-body-title">Follow Up</h6>
                    <div class="modal-body-card">
                        <div class="col-12">
                            <label class="form-label main-label">Description</label>
                            <div class="d-flex">
                                <textarea id="inquiry_description" class="form-control main-control" placeholder="Inquiry Desc." name="inquiry_description" maxlength="500"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer2">
                    <button class="btn-secondary inquiry_all_status_update inquiry_all_status_update_btn" id="inquiry_all_status_update_btn" data-edit_id="" data-people_id="" data-assign_id="" name="inquiry_all_status_update" value="inquiry_all_status_update">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="view_inquery_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">id : <span id="id"></span></h1>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body modal-body-secondery fs-14 text-capitalize">
                <div class="modal-body-card">
                    <div class="col-xl-6 col-sm-6">
                        <span><span class="font-adjust">Name : </span><span id="full_name"></span></span>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <span><span class="font-adjust">Mobile No : </span><span id="mobileno"></span></span>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <span><span class="font-adjust">Source : </span><span id="inquiry_source_type"></span></span>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <span><span class="font-adjust">Inquiry Type : </span><span id="inquiry_type"></span></span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <span class="font-adjust">
                            <i class="fa-solid fa-envelope"></i> :
                        </span>
                        <span class="ms-1" id="email"></span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <span class="font-adjust">
                            <i class="fa-solid fa-location-dot"></i> :
                        </span>
                        <span class="ms-1" id="houseno"></span>,<span id="society"></span>
                    </div>
                </div>
                <h4 class="modal-body-title">Int Product Details</h4>
                <div class="modal-body-card">
                    <div class="col-sm-6 col-12">
                        <span class="font-adjust">int product : </span><span id="intrested_product"></span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <span class="font-adjust">Budget : </span><span id="budget"></span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <span class="font-adjust">Inquier As : </span><span id="purpose_buy"></span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <span class="font-adjust">Approx Buying : </span><span id="approx_buy"></span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <span class="font-adjust">subscription : </span><span id="subscription"></span>
                    </div>
                </div>
                <h4 class="modal-body-title">FollowUp</h4>
                <div class="modal-body-card">
                    <div class="col-xl-12">
                        <span class="font-adjust">Next Followup Date : </span>
                        <span id="nxt_follow_up"></span>
                    </div>
                    <div class="col-xl-12">
                        <span class="font-adjust">Appoitment Date : </span>
                        <span id="appointment_date"></span>
                    </div>
                    <div class="col-xl-12">
                        <span class="font-adjust">Description : </span>
                        <span id="inquiry_description"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="log-btn btn-primary-rounded log_button" data-log_id="" id="log-btn" data-bs-toggle="modal" data-bs-target="#logmodal">
                    <i class="bi bi-clock fs-14"></i>
                </div>
                <?php if (in_array('demo_register_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                    <div class="delete_main">
                        <button class="delete_btn_1 btn-primary w-100">Delete</button>
                        <button class="btn-secondary px-3 dlt">Really?</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:585px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="log_idd"></h1>
                <!-- <div class=call-name style=display:inline-flex>
                    <h6>inquiy log</h6>
                </div> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="log-model">
                    <div class="log-box-main">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
	<form method="post" class="d-flex flex-column h-100" name="filter_form">
		<div class="offcanvas-header set-bg-color bg-pink">
			<h5 class="offcanvas-title text-white" id="offcanvasRightLabel">filter</h5>
			<button type="button" class="modal-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body filter_data">
			<div class="input-type my-2">
				<input type="text" placeholder="id" class="form-control main-control" name="f_id" id="f_id">
			</div>
			<div class="input-type my-2">
				<input type="text" placeholder="enter name" class="form-control main-control" name="full_name" id="f_full_name">
			</div>
			<div class="input-type my-2">
				<input type="text" placeholder="mobile no" class="form-control main-control" name="f_mobileno" id="f_mobileno">
			</div>
			<div class="input-type my-2">
				<input type="text" class="date form-control main-control input-main nxt_follow_up" placeholder="next follow up" id="f_nxt_follow_up" name="nxt_follow_up" value="" required="" />
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_inquiry_status" name="f_inquiry_status" data-live-search="true">
						<option value="">Inquiry Status</option>
						<?php foreach ($master_inquiry_status as $inquiry_status_key => $inquiry_status_value) { ?>
							<option value="<?php echo $inquiry_status_value['id'] ?>"><?php echo $inquiry_status_value['inquiry_status'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_assign_id" name="f_assign_id" data-live-search="true">
						<option class="dropdown-item" value="">Assign To</option>
						<?php if (!empty($userUnderEmployee)) {
							foreach ($userUnderEmployee as $key => $user_valuess) {
								if ($user_valuess['switcher_active'] == 'active') { ?>
									<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['user_id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo $user_valuess['user_role']; ?>)</option>
						<?php
								}
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_owner_id" name="f_owner_id" data-live-search="true">
						<option class="dropdown-item" value="">owner To</option>
						<?php if (!empty($userUnderEmployee)) {
							foreach ($userUnderEmployee as $key => $user_valuess) {
								if ($user_valuess['switcher_active'] == 'active') { ?>
									<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['user_id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo $user_valuess['user_role']; ?>)</option>
						<?php
								}
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="input-type my-2">
                <div class="d-flex">
                    <div class="dropdown bootstrap-select form-control">
                        <select class="selectpicker form-control form-main" id="f_intrested_product" name="f_intrested_product" data-live-search="true">
                            <option value="">int product</option>
                            <?php
                          

                            foreach ($admin_product as $key => $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['product_name'] . '</option>';
                            }
                            ?>
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
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_inquiry_type" name="f_inquiry_type" data-live-search="true">
						<option value="">Inq Type</option>
						<?php foreach ($master_inquiry_type as $master_inquiry_typekey => $master_inquiry_typevalue) { ?>
							<option value="<?php echo $master_inquiry_typevalue['id']; ?>"><?php echo $master_inquiry_typevalue['inquiry_details']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			
			<h6 class="modal-body-title">duration:</h6>
			<div class="input-type my-2">
				<input type="text" class="form-control main-control date" id="f_from_date" name="from_date" placeholder="From date">
			</div>
			<div class="input-type my-2">
				<input type="text" class="form-control main-control date" id="f_last_date" name="to_date" placeholder="To date">
			</div>
		</div>
	</form>
</div>


<!-- <div class="modal-backdrop fade show"></div> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>


<script>
    function updateCount() {
        var count = $("input.inquiry_id[type=checkbox]:checked").length;
        var count_all = $("input.inquiry_id[type=checkbox]").length;
        if (count != 0) {
            $(".main-select-section").show();
        }

    }
    updateCount();
    $("#select_all").change(function() {
        $('.inquiry_id').prop('checked', this.checked);
        updateCount();
    });

    $("body").on('click', '.inquiry_id', function(e) {
        if ($(this).length == $(".inquiry_id:checked").length) {
            $("#select_all").attr("checked", "checked");
        } else {
            $("#select_all").removeAttr("checked");
        }
        updateCount();
    });


    $(document).ready(function() {
        $(".interested_entry_form .modal-close-btn, .btn-closing").click(function() {
            $(".interested_entry_form").removeClass("d-block show");
        });

        // function datatable_view(html) {
        //     $('#today-follow-feedback').DataTable().destroy();
        //     $('.inquiry_all_status_list').html(html);
        //     var table1 = $('#today-follow-feedback').DataTable({
        //         "columnDefs": [{
        //             "visible": false,
        //         }],
        //         lengthChange: true,
        //         // buttons: ['copy', 'excel', 'pdf', 'colvis']
        //     });
        //     table1.buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');
        //     table1.page(0).draw('page');
        // }

        // date time picker
        $(".date").bootstrapMaterialDatePicker({
            format: 'MM/DD/YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });

        $(".max-date").bootstrapMaterialDatePicker({
            maxDate: new Date(),
            format: 'MM/DD/YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });

        $('.min-date').bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'MM/DD/YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });

        $('.min-datendate').bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'MM/DD/YYYY h:mm A',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',

        });

        $('.min-datetime').bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'MM/DD/YYYY h:mm A',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
        });

        $('.next-followup').bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'MM/DD/YYYY h:mm A',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
        });

        $('.end-date').bootstrapMaterialDatePicker({
            weekStart: 0,
            format: 'YYYY-MM-DD',
            time: false
        });

        $('.starting-date').bootstrapMaterialDatePicker({
            weekStart: 0,
            format: 'YYYY-MM-DD',
            shortTime: true,
            time: false
        }).on('change', function(e, date) {
            $('.end-date').bootstrapMaterialDatePicker('setMinDate', date);
        });

        // $('#today-follow-feedback').DataTable({"paging": false});
        $('#today-follow-revisit').DataTable({
            "paging": false
        });
        $('#today-follow-reappo').DataTable({
            "paging": false
        });
        $('#today-follow-sitevisit').DataTable({
            "paging": false
        });
        $('#today-follow-appo').DataTable({
            "paging": false
        });
        $('#today-follow-contact').DataTable({
            "paging": false
        });
        $('#today-follow-fresh').DataTable({
            "paging": false
        });
        $('#today-follow-all').DataTable({
            "paging": false
        });
        $('#today-follow-cnr').DataTable({
            "paging": false
        });
        $('body').on('click', '#visit_entry_form .modal-close-btn , #visit_entry_form .btn-closing', function(e) {
            $("#visit_inquery .btn-close , #conversion_inquery .btn-close").trigger("click");
        });

        $('body').on('click', '#editmodal .modal-close-btn , #logmodal .btn-close', function(e) {
            $("#view_inquery_list .btn-close").trigger("click");
        });

        $('body').on('click', '.filter-icon .btn', function(e) {
            $(".offcanvas-backdrop").addClass("d-none");
        });
        $(".main-select-section").hide();
        var selectAllItems = "#select_all";
        var checkboxItem = ".checkbox";

        $(selectAllItems).click(function() {

            if (this.checked) {
                $(".main-select-section").show();
                $(".main-select-section").toggleClass("order-xl-1");
                $(".file-up-down").toggleClass("order-xl-2");
                $(".navigation").toggleClass("order-xl-3");
                $(checkboxItem).each(function() {
                    this.checked = true;
                });
            } else {
                $(".main-select-section").hide();
                $(".main-select-section").removeClass("order-xl-1");
                $(".file-up-down").removeClass("order-xl-2");
                $(".navigation").removeClass("order-xl-3");
                $(checkboxItem).each(function() {
                    this.checked = false;
                });
            }

        });

        $('body').on('click', '.export-inq', function(e) {
            e.preventDefault;
        });
        $('body').on('click', '.export-inq', function(e) {
            e.preventDefault;
			var inquiry_status_type = $('.today-follow-tabs li .active').attr('data-inquiry');
			// list_data("all_inquiry", inquiry_status_type, "", "", "", "", "", "export","");
            list_data(table = 'all_inquiry', inquiry_status_type , "", "", "", "","", action = "export",url="visit_reg_list_data")
		});
        function generateCSV(data) {
		// Convert data to CSV format
		// console.log(data);
		// var csvContent = "data:text/csv;charset=utf-8,";
		csvContent = "id, firstname, mobileno\n"; // Replace with your column names
		data.forEach(function(row) {
			var rowData = [row.id, row.firstname, row.mobileno]; // Adjust based on your data structure
			// console.log(row);
			csvContent += rowData.join(",") + "\n";
		});
		var today_date = new Date();
		var year = today_date.getFullYear();
		var month = today_date.getMonth() + 1;
		var day = today_date.getDate();
		var username = '<?= $_SESSION['username'] ?>';
		var file_name = username + "-all-inquery " + day + "-" + month + "-" + year + ".csv";
		var downloadLink = document.createElement("a");
		var fileData = ['\ufeff' + csvContent];
		var blobObject = new Blob(fileData, {
			type: "text/csv;charset=utf-8;"
		});
		var url = URL.createObjectURL(blobObject);
		downloadLink.href = url;
		downloadLink.download = file_name;
		document.body.appendChild(downloadLink);
		downloadLink.click();
		document.body.removeChild(downloadLink);
		// Create a temporary link and initiate the download
		// var encodedUri = encodeURI(csvContent);
		// var link = document.createElement("a");
		// link.setAttribute("href", encodedUri);
		// link.setAttribute("download", file_name);
		// document.body.appendChild(link);
		// link.click();
	}

        // list data 


        function list_data(table = 'all_inquiry', datastatus = '', pageNumber = 1, perPageCount = 10, ajaxsearch = "", filter = "", formdata = "", action = true,url="visit_reg_list_data") {
           

            //var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
            var ajaxsearch = $('.inq_search').val();
            //var inquiry_status_type = $('.tab_button button.btn.active').attr('data-inquiry');
            // var perPageCount = $('#perPageCount').val();
            <?php if (isset($_GET['mobileno'])) { ?>
                                                                        var mobileno = '<?php echo $_GET['mobileno']; ?>';
            <?php } ?>
            <?php if (isset($_GET['filter_id'])) { ?>
                                                                        var filter_id = '<?php echo $_GET['filter_id']; ?>';
            <?php } ?>
            <?php if (isset($_REQUEST['followup'])) { ?>
                                                                        var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
            <?php } else { ?>
                                                                        var follow_up_day = '';
            <?php } ?>

            if ($.trim($(".filter-show").html()) != '') {
                var form = $("form[name='filter_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'filter');
                formdata.append('follow_up_day', follow_up_day);
                if (action == 'export') {
					formdata.append('action1', 'export');
				}
            }

            if ($.trim($(".filter-show").html()) == '') {
                var data = {
                    'table': table,
                    'datastatus': datastatus,
                    'pageNumber': pageNumber,
                    'perPageCount': perPageCount,
                    'follow_up_day': follow_up_day,
                    <?php if (isset($_GET['mobileno'])) { ?> 'global_search_val': mobileno,
                    <?php } ?>
                    <?php if (isset($_GET['filter_id'])) { ?> 'filter_id': filter_id,

                    <?php } ?> 'ajaxsearch': ajaxsearch,
                    'action': action,
                };
                var processdd = true;
                var contentType = "application/x-www-form-urlencoded; charset=UTF-8";

            } else {
                formdata.append('datastatus', datastatus);
                formdata.append('pageNumber', pageNumber);
                formdata.append('perPageCount', perPageCount);
                formdata.append('table', table);
                //formdata.append( 'follow_up_day', follow_up_day);
                var data = formdata;
                var processdd = false;
                var contentType = false;
            }
            var totalData = [];
            $.ajax({
                datatype: 'json',
                method: "POST",
                url: url,
                data: data,
                processData: processdd,
                contentType: contentType,
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.export_data) {
                        totalData = totalData.concat(result.export_data);
					generateCSV(totalData);
				}
                    if (result.response == 1) {
                        if (result.total_page == 0 || result.total_page == '') {
                            total_page = 1;
                        } else {
                            total_page = result.total_page;
                        }
                        $('#row_count').html(result.row_count_html);
                        $('.inquiry_all_status_list').html(result.html);
                        $('.inq_pagination').twbsPagination({
                            totalPages: total_page,
                            visiblePages: 4,
                            next: '>>',
                            prev: '<<',
                            onPageClick: function(event, page) {
                                list_data(table, datastatus, page, perPageCount, ajaxsearch,'','',true,url);
                            }
                        });
                    }
                }
            });
            <?php
            if (isset($_GET) && !empty($_GET)) { ?>
                                                                        <?php
                                                                        if (isset($_GET['action']) && ($_GET['action'] == 'filter')) { ?>
                                                                                                                                    $('.inq_pagination').twbsPagination('destroy');
                                                                        <?php } ?>
                                                                    <?php
            } ?>
        }

        $(".filter_data input,.filter_data select").change(function() {

            var form = $("form[name='filter_form']")[0];
            $('.inq_pagination').twbsPagination('destroy');

            var perPageCount = $('#project_length_show').val();

            var formdata = new FormData(form);
            formdata.append('action', 'filter');
            data_status = $("#f_inquiry_status").val();
            // console.log(data_status);
            <?php if (isset($_REQUEST['followup'])) { ?>
                                                                        var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
            <?php } else { ?>
                                                                        var follow_up_day = '';
            <?php } ?>
            if ($(".filter-show").html() != "") {
                var form = $("form[name='filter_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'filter');
                formdata.append('follow_up_day', follow_up_day);
            } else {
                formdata = '';
            }

            var tabselect = $('.property_tab_button .active').attr('id');
            // if(tabselect == 'reg_visit'){
                list_data(table = 'all_inquiry', data_status, 1, perPageCount, "", 'filter', formdata, 'filter','visit_reg_list_data');
            // } else if(tabselect == 'reg_revisit'){
            //     list_data(table = 'all_inquiry', data_status, 1, perPageCount, "", 'filter', formdata, 'filter','revisit_reg_list_data');
            // }
            
        });

        $('body').on('click', '#filter-showw p', function() {
            $('.inq_pagination').twbsPagination('destroy');
            var perPageCount = $('#project_length_show').val();
            <?php if (isset($_REQUEST['followup'])) { ?>
                                                                        var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
            <?php } else { ?>
                                                                        var follow_up_day = '';
            <?php } ?>
            if ($(".filter-show").html() != "") {
                data_status = $("#f_inquiry_status").val();
                var form = $("form[name='filter_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'filter');
                formdata.append('follow_up_day', follow_up_day);
            } else {
                formdata = '';
            }
            var tabselect = $('.property_tab_button .active').attr('id');
            // if(tabselect == 'reg_visit'){
                list_data(table = 'all_inquiry', data_status, 1, perPageCount, "", 'filter', formdata, 'filter','visit_reg_list_data');
            // } else if(tabselect == 'reg_revisit'){
            //     list_data(table = 'all_inquiry', data_status, 1, perPageCount, "", 'filter', formdata, 'filter','revisit_reg_list_data');
            // }
        });

        $("#clear").click(function() {
            $('.inq_pagination').twbsPagination('destroy');
            <?php if (isset($_REQUEST['followup'])) { ?>
                                                                        var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
            <?php } else { ?>
                                                                        var follow_up_day = '';
            <?php } ?>
            if ($(".filter-show").html() != "") {
                formdata.append('follow_up_day', follow_up_day);
                $data_status = $("#f_inquiry_status").val();
                var form = $("form[name='filter_form']")[0];
                var formdata = new FormData(form);
                formdata.append('action', 'filter');
            } else {
                formdata = '';
                $data_status = '';
            }
            $('.multiple-select .filter-option-inner-inner').html('Iquiry Status');
            $('.today-follow-tabs li button[data-inquiry=""]').trigger('click');

            var tabselect = $('.property_tab_button .active').attr('id');
            // if(tabselect == 'reg_visit'){
                list_data(table = 'all_inquiry', data_status, 1, 10, "", 'filter', formdata, 'filter','visit_reg_list_data');
            // } else if(tabselect == 'reg_revisit'){
            //     list_data(table = 'all_inquiry', data_status, 1, 10, "", 'filter', formdata, 'filter', 'revisit_reg_list_data');
            // }
        });

        list_data();

        $('body').on('click', '.reg_visit', function() {
            $('.inq_pagination').twbsPagination('destroy');
            $('.property_tab_button button').removeClass('active');
            $(this).addClass('active');
            list_data('all_inquiry','',1,10,'','','',true,'visit_reg_list_data');
        });

        $(".reg_visit").trigger("click");

        $('body').on('click', '.reg_revisit', function(e) {
            $('.inq_pagination').twbsPagination('destroy');
            $('.property_tab_button button').removeClass('active');
            $(this).addClass('active');
            list_data('all_inquiry','',1,10,'','','',true,'revisit_reg_list_data');
        });

   






        // view data 
        $('body').on('click', '.inquery_view', function(e) {
            e.preventDefault();
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-view_id");
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('all_inquiry_data_view'); ?>",
                    data: {
                        action: 'view',
                        view_id: edit_value,
                        table: 'all_inquiry'
                    },

                    success: function(res) {
                        $('.loader').hide();
                        $('.pass_field').hide();
                        var response = JSON.parse(res);
                        $('#view_inquery_list #id').text(response.id);
                        $('.edt').attr('data-edit_id', response.id);
                        $('.dlt').attr('data-delete_id', response.id);
                        $('.log_button').attr('data-log_id', response.id);
                        $('#view_inquery_list #full_name').text(response.full_name);
                        $('#view_inquery_list #mobileno').text(response.mobileno);
                        $('#view_inquery_list #altmobileno').text(response.altmobileno);
                        $('#view_inquery_list #email').text(response.email);
                        $("#view_inquery_list #houseno").text(response.houseno);
                        $('#view_inquery_list #society').text(response.society);
                        $('#view_inquery_list #area').text(response.area);
                        $("#view_inquery_list #countryId").text(response.countryId);
                        $("#view_inquery_list #stateId").text(response.stateId);
                        $("#view_inquery_list #cityId").text(response.cityId);
                        $("#view_inquery_list #intrested_product").text(response.intrested_product);
                        $("#view_inquery_list #subscription").text(response.int_subscription);
                        $("#view_inquery_list #purpose_buy").text(response.buying_as);
                        $("#view_inquery_list #property_sub_type").text(response.project_sub_type_name);
                        $("#view_inquery_list #intersted_site").text(response.intersted_site);
                        $("#view_inquery_list #budget").text(response.budget);
                        $("#view_inquery_list #purpose_buy").text(response.purpose_buy);
                        $("#view_inquery_list #approx_buy").text(response.approx_buy);
                        $("#view_inquery_list #inquiry_type").text(response.inquiry_type_name);
                        $("#view_inquery_list #inquiry_source_type").text(response.inquiry_source_type_name);
                        $("#view_inquery_list #nxt_follow_up").text(response.nxt_follow_up);
                        $("#view_inquery_list #inquiry_description").text(response.inquiry_description);
                        $("#view_inquery_list #appointment_date").text(response.appointment_date);

                    },

                });

            } else {

                $('.loader').hide();

                alert("Data Not Edit.");

            }
        });
    
        $(".reg_visit").trigger("click");
       

       $('.broker_customer_div').hide();

   $("#inquiry_all_status_update_form #inquiry_source_type").on("change",function(){
       $('#broker_customer_div').html('');
       var source_tyyp = $(this).val();
       if(source_tyyp == "7" || source_tyyp == "4"){
           $('.broker_customer_div').show();
           $.ajax({
               method: "post", 
               url: "<?= site_url('Inquirymanagement_select_data'); ?>",
               data: {
                   'source_tyyp': source_tyyp,
                 
               },

               success: function(res) {
                   

               $('#broker_customer_div').append(res);
               $('.selectpicker').selectpicker('refresh');

                  //$("#broker_customer_div").html(res);

               },
               error: function (error) {

                   $('.loader').hide();

               }

           });

       }
   });
   
    $("button[name='inquiry_all_status_update']").click(function(e) {
        e.preventDefault();
        var mobileno = $("#inquiry_all_status_update_form #mobileno").val();
        var full_name = $("#inquiry_all_status_update_form #full_name").val();
        var altmobileno = $("#inquiry_all_status_update_form #altmobileno").val();
        var area = $("#inquiry_all_status_update_form #area").val();
        var city = $("#inquiry_all_status_update_form #city").val();
        var email = $("#inquiry_all_status_update_form #email").val();
        var house = $("#inquiry_all_status_update_form #house").val();
        var society = $("#inquiry_all_status_update_form #society").val();
        var intrested_site = $("#inquiry_all_status_update_form #intrested_site").val();
        var intersted_site_name = $("#inquiry_all_status_update_form #intrested_site option:selected").attr("data-intersted_site_id");
        // console.log(intersted_site_name);
        var budget = $("#inquiry_all_status_update_form #budget").val();
        var intrested_area = $("#inquiry_all_status_update_form #intrested_area").val();
        var intrested_area_name = $("#inquiry_all_status_update_form #intrested_area option:selected").attr("data-area_id");
        var inquiry_type = $("#inquiry_all_status_update_form #inquiry_type").val();
        var inquiry_source_type = $("#inquiry_all_status_update_form #inquiry_source_type").val();
        var nxt_follow_up = $("#inquiry_all_status_update_form #nxt_follow_up").val();
        var nxt_follow_up_tag = $("#inquiry_all_status_update_form #nxt_follow_up");
        var next_follow_up = timeValidation(nxt_follow_up,nxt_follow_up_tag);
        // var visit_date = $("#inquiry_all_status_update_form #visit_date").val();
        // console.log(visit_date);
        var inquiry_description = $("#inquiry_all_status_update_form #inquiry_description").val();
        var property_type = $("#inquiry_all_status_update_form #property_sub_type").find(':selected').attr("data-property_type");
        var edit_id = $('#inquiry_all_status_update_form #inquiry_all_status_update_btn').attr("data-edit_id");
        var edit_page = $(".inq_pagination").find(".page-item.active .page-link").text();
        if (mobileno != "" && full_name != "" && area != "" && city != "" && intrested_site != "" && budget != "" && intrested_area != "" && inquiry_type != "" && inquiry_source_type != "" && nxt_follow_up!="") {
            var form = $("form[name='inquiry_all_status_update_form']")[0];
            var formdata = new FormData(form);
            formdata.append('table', 'all_inquiry');
            formdata.append('intrested_area_name', intrested_area_name);
            formdata.append('intersted_site_name', intersted_site_name);
            formdata.append('property_type', property_type);
            // formdata.append('visit_date', visit_date);

            var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
            var page_number = $(".inq_pagination").find(".page-item.active .page-link").text();
            var perPageCount = $('#perPageCount').val();


            if (edit_id == '') {
                formdata.append('action', 'insert');
                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('inquiry_insert_data'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        var response = JSON.parse(res);
                        if (response.response != "0") {
                            $('.loader').hide();
                            // $("form[name='inquiry_all_status_update_form']")[0].reset();
                            $('.btn-close').click(function () {
                                $('.selectpicker').selectpicker('refresh');
                                $('form[name="inquiry_all_status_update_form"]')[0].reset();
                            });
                            $("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
                            $(".btn-close").trigger("click");
                            sweet_edit_sucess(response.message);
                            //$('.inq_pagination').twbsPagination('destroy');

                            list_data('inquiry_all_status', inquiry_status_type, page_number, perPageCount);
                        } else {

                            // $("form[name='inquiry_all_status_update_form']")[0].reset();
                            $("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
                            $(".btn-close").trigger("click");
                            if (response.message == '') {
                                response.message = 'Inquiry Not Created Please check It.';
                            }
                            Swal.fire({
                                title: 'Cancelled',
                                text: response.message,
                                icon: 'error',
                            })

                            $('.loader').hide();

                        }

                    },

                });

            } else {

                var formdata = new FormData(form);
                formdata.append('action', 'update');
                formdata.append('edit_id', edit_id);
                formdata.append('table', 'all_inquiry');
                // formdata.append('visit_date', visit_date);


                var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
                var perPageCount = $('#perPageCount').val();

                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('inquiry_list_updatedata'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res != "error") {
                            $('.loader').hide();

                            $("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
                            $('.btn-close').click(function () {
                                $('form[name="inquiry_all_status_update_form"]')[0].reset();
                            });
                            list_data('inquiry_all_status', inquiry_status_type, edit_page, perPageCount);
                            $(".btn-close").trigger("click");
                            sweet_edit_sucess('Update successfully');
                        } else {
                            $('.loader').hide();
                            Swal.fire({
                                title: 'Cancelled',
                                text: 'Duplicate Data Not Valid',
                                icon: 'error',
                            })
                        }
                    },
                    error: function (error) { }
                });
            }
        } else {
            $("form[name='inquiry_all_status_update_form']").addClass("was-validated");
            var form = $("form[name='inquiry_all_status_update_form']");
            $(form).find('.selectpicker').each(function () {
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
        }
        return false;
    });


   $('body').on('click', '.edt', function(e) {

       // alert("hl");
       $('select.selectpicker').selectpicker('refresh');
       e.preventDefault();
       var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
       var self = $(this).closest("tr");
       var edit_value = $(this).attr("data-inquiry_edit_id");
       var edit_page = $(".inq_pagination").find(".page-item.active .page-link").text();
       var perPageCount = $('#perPageCount').val();

       // console.log(edit_value);
       if (edit_value != "") {
           $('.loader').show();
           $.ajax({
               type: "post",
               url: "<?= site_url('inquiry_list_data_edit'); ?>",
               data: {
                   action: 'edit',
                   edit_id: edit_value,
                   table: 'all_inquiry'
               },
               success: function(res) {
                   $('.loader').hide();

                   var response = JSON.parse(res);
                   // console.log(response);

                   // $('.dlt').attr('data-delete_id', response[0].id);
                   $('#inquiry_all_status_update_btn').attr('data-edit_id', response[0].id);
                   $('#inquiry_all_status_update #full_name').val(response[0].full_name);
                   $('#inquiry_all_status_update #mobileno').val(response[0].mobileno);
                   $('#inquiry_all_status_update #altmobileno').val(response[0].altmobileno);
                   $('#inquiry_all_status_update #email ').val(response[0].email);
                   $('#inquiry_all_status_update #houseno').val(response[0].houseno);
                   $('#inquiry_all_status_update #society').val(response[0].society);
                   $('#inquiry_all_status_update #area').val(response[0].area);
                   $('#inquiry_all_status_update #countryId').val(response[0].countryId);
                   $('#inquiry_all_status_update #stateId').val(response[0].stateId);
                   $('#inquiry_all_status_update #city').val(response[0].city);
                   $('#inquiry_all_status_update #intrested_product').val(response[0].intrested_product);
                   $('#inquiry_all_status_update #subscription').val(response[0].subscription);
                   $('#inquiry_all_status_update #buying_as').val(response[0].buying_as);
                   $('#inquiry_all_status_update #approx_buy').val(response[0].approx_buy);

                   $('#inquiry_all_status_update #budget').val(response[0].budget);
                   $('#inquiry_all_status_update #purpose_buy').val(response[0].purpose_buy);
                   $('#inquiry_all_status_update #approx_buy').val(response[0].approx_buy);
                   $('#inquiry_all_status_update #inquiry_type').val(response[0].inquiry_type);
                   $('#inquiry_all_status_update #inquiry_source_type').val(response[0].inquiry_source_type);
                   $('#inquiry_all_status_update #nxt_follow_up').val(response[0].nxt_follow_up);
                   $('#inquiry_all_status_update .nxtiii').hide();
                   //inquiry_all_status_update_form

                   $('#inquiry_all_status_update #inquiry_description').val(response[0].inquiry_description);
                   $('.selectpicker').selectpicker('refresh');
                   list_data('inquiry_all_status', inquiry_status_type, edit_page, perPageCount);
                   setTimeout(function() {
                       $('#inquiry_all_status_update #intrested_site').val(response[0].intrested_site);
                       //    $('.selectpicker').selectpicker('refresh');
                       $('.selectpicker').selectpicker('refresh');

                   }, 1000);
                   $('.btn-close').click(function() {
                       $('.selectpicker').selectpicker('refresh');

                       $('form[name="inquiry_all_status_update_form"]')[0].reset();
                   });
               },
               error: function(error) {
                   $('.loader').hide();
               }

           });

       } else {
           $('.loader').hide();
           alert("Data Not Edit.");
       }

   });
        // delete data 
        $('body').on('click', '.dlt', function(e) {
            var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
            e.preventDefault();
            var self = $(this).closest("tr");
            var id = $(this).attr('data-delete_id');
            var delet_page = $(".inq_pagination").find(".page-item.active .page-link").text();
            var perPageCount = $('#perPageCount').val();


            if (id != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('inquiry_list_deletedata'); ?>",
                    data: {
                        action: 'delete',
                        id: id,
                        table: 'all_inquiry'
                    },
                    success: function(res) {
                        $('.loader').hide();
                        $(".btn-close").trigger("click");

                        list_data();
                    },
                    error: function(error) {
                        $('.loader').hide();
                    }
                });
            }
        });


        function intrested_site_to_unit_no(intrested_site = '') {
            $('#unit_no').html('');
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('Inquirymanagement_project_to_get_unit'); ?>",
                data: {
                    'table': 'properties',
                    'intrested_site': intrested_site,
                    'action': 'get_data',
                    'field': 'project_name'
                },
                success: function(res) {

                    // var response = JSON.parse(res);
                    $('#unit_no').append(res);
                    // console.log(response);
                    // $('.inquiry_all_status_visit').attr('data-inquryid',response[0].id);
                    // $('#de_name').attr('value' , response[0].firstname+' '+response[0].middlename+' '+response[0].lastname);
                    $('.loader').hide();
                    $('.selectpicker').selectpicker('refresh');

                }
            });
        }

        $('body').on('change', '#intrested_site', function() {
            // alert("hello");
            var intrested_site = $(this).val();
            intrested_site_to_unit_no(intrested_site);

            // get_id_to_inquery_data(inquryid,'id');
        });

    });


    // cash 
    var data = $('input:radio[name=paymentref]:checked').val();
    var loan_html = '';
    loan_html = '<div class="row g-2 modal-section-heading-text loan"> <div class="col-lg-6 col-md-6 col-sm-6"><label class="form-label">DP Amount</label><input type="text" class="form-control amount_validation input-main" placeholder="Enter DP Amount" name="dp_amount" id="dp_amount" required=""></div><div class="col-lg-6 col-md-6 col-sm-6"> <label class="form-label">Loan Amount</label><input type="text" class="form-control amount_validation" placeholder="Enter Loan Amount" name="loan_amount" id="loan_amount" required=""></div> <div class="col-lg-6 col-md-6 col-sm-6"><label class="form-label">After Visit Status</label>';

    loan_html += '<div class="d-flex">';
    loan_html += '<textarea class="modal-textarea form-control remark" id="remark" name="remark" rows="1" cols="50" required=""></textarea>';
    loan_html += '</div>';
    loan_html += '</div>';

    loan_html += '<div class="col-lg-6 col-md-6 col-sm-6"> <label class="form-label">Next FollowupDate</label> <div class="custom_Date_class"><input type="text" placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" class="dateinput2 form-control next-followup" data-dtp="dtp_MnWjb" onclick="myFunction()"><input type="text" id="nxt_follow_up" name="nxt_follow_up" class="datetimepicker2 form-control" Required style="display: none;" /><input type="button" class="btn btn-primary mb-4 dateconfirmationbtn2" id="dateconfirmationbtn" value="Confirm" style="display:none;"/></div></div> </div>';

    var cash_html = '';
    cash_html += '<div class="row g-2 modal-section-heading-text cash"> <div class="col-lg-6 col-md-6 col-sm-6"><label class="form-label">DP Amount</label><input type="text" class="form-control amount_validation input-main" placeholder="Enter DP Amount" name="dp_amount" id="dp_amount" required=""></div><div class="col-lg-6 col-md-6 col-sm-6"> <label class="form-label">Cash Payment Condition</label>';
    cash_html += '<div class="main-selectpicker">';
    cash_html += '<select id="cash_pay" name="cash_pay" class="selectpicker form-main form-control cash_pay" data-live-search="true" required><i class="fa-solid fa-caret-down"></i>';
    cash_html += '<option value="">Select Apx Time</option>';
    cash_html += '<option value="2-3 days">2-3 Days</option>';
    cash_html += '<option value="week">Week</option>';
    cash_html += '<option value="10-15 days">10-15 Days</option>';
    cash_html += '<option value="1-month">1 Month</option>';
    cash_html += '<option value="2-month">2 Month</option>';
    cash_html += '<option value="3-month">3 Month</option>';
    cash_html += '<option value="4-month">4 Month</option>';
    cash_html += '<option value="5-month">5 Month</option>';
    cash_html += '<option value="6-month">6 Month</option>';
    cash_html += '<option value="7-month">7 Month</option>';
    cash_html += '<option value="8-month">8 Month</option>';
    cash_html += '<option value="9-month">9 Month</option>';
    cash_html += '<option value="10-month">10 Month</option>';
    cash_html += '<option value="11-month">11 Month</option>';
    cash_html += '<option value="1-year">1 Year</option>';
    cash_html += '<option value="1.5-year">1.5 Year</option>';
    cash_html += '<option value="2-year">2 Year</option>';
    cash_html += '</select>';
    cash_html += '</div>';
    cash_html += '</div> <div class="col-lg-6 col-md-6 col-sm-6"><label class="form-label">After Visit Status</label>';
    cash_html += '<div class="d-flex">';
    cash_html += '<textarea class="modal-textarea form-control  remark" id="remark" name="remark" rows="1" cols="50" required=""></textarea>';
    cash_html += '</div>';
    cash_html += '</div>';

    cash_html += '<div class="col-lg-6 col-md-6 col-sm-6"> <label class="form-label ">Next FollowupDate</label>  <div class="custom_Date_class"><input type="text" placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" class=" form-control next-followup" onclick="myFunction()" data-dtp="dtp_cG9Sd"></div></div> </div>';


    if (data == "loan") {
        $(".loan_cash").html(loan_html);
        $('.selectpicker').selectpicker('refresh');
    }

    $(".paymentref").change(function() {
        // alert("hello");
        var val = $(".paymentref:checked").val();
        if (val == "loan") {
            $(".loan_cash").html(loan_html);
            myFunction();
        } else {
            $(".loan_cash").html(cash_html);
            myFunction();
        }
        $('.selectpicker').selectpicker('refresh');
        // alert(val);
    });
</script>