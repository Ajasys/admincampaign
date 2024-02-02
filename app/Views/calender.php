<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
// $db_connection = \Config\Database::connect();
// $querryyy = "SELECT * FROM master_user WHERE id=" . $_SESSION['master'] . " ";
// $result600 = $db_connection->query($querryyy);
// $master_data = $result600->getResultArray();
// if (isset($master_data[0]['business_type']) && !empty($master_data[0]['business_type']) && $master_data[0]['business_type'] != 0) {
// 	$business_type = $master_data[0]['business_type'];
// } else {
// 	$business_type = 0;
// }
// ?>
<style>
    .calender-task {
        background-color: #724ebf2e !important;
        color: #724ebf !important;
    }

    .calender-meeting {
        background-color: #0dcaf033 !important;
        color: #0696b3 !important;
    }

    .calender-reminder {
        background-color: #ffc1072b !important;
        color: #dba400 !important;
    }

    .calender-amount {
        background-color: #f7b3da42 !important;
        color: #ff6bc0 !important;
    }
    .calender-service {
        background-color: #e3fadb !important;
        color: #26a400  !important;
    }
    td.fc-event-container.active .main-outer-followup{
        display: block;
    }
    td.fc-event-container .main-outer-followup{
        display: none;
    }
    .followup-task{
        display: none;
    }
    .fc-row.fc-week.fc-widget-content{
        height: 100% !important;
        min-height: 164px !important;
    }
</style>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1">
                    <i class="bi bi-credit-card"></i>
                    <p>Lead Calendar</p>
                </div>
                <div class="title-side-icons">
                    <span id="deleted-all" class="btn-primary-rounded elevation_add_button" style="display: none;">
                        <i class="bi bi-trash3"></i>
                    </span>
                </div>
            </div>
        </div>
        <!-- <div class="px-2 d-flex flex-wrap mb-2">
            <div class="d-flex align-items-center mx-2 fs-14">
                <span class="py-1 px-2 rounded-1 bg-primary me-2"></span>
                <span>Task</span>
            </div>
            <div class="d-flex align-items-center mx-2 fs-14">
                <span class="py-1 px-2 rounded-1 bg-info me-2"></span>
                <span>Metting</span>
            </div>
            <div class="d-flex align-items-center mx-2 fs-14">
                <span class="py-1 px-2 rounded-1 bg-warning me-2"></span>
                <span>Reminder</span>
            </div>
            
            <div class="d-flex align-items-center mx-2 fs-14">
                <span class="py-1 px-2 rounded-1 me-2" style="background-color: #ff6bc0;"></span>
                <span>Follow up</span>
            </div>
          
        </div>   -->
        <div class="bg-white shadow rounded-2 p-3 mx-2 payment-calender">
            <div id="calendar" class="fc fc-unthemed fc-ltr">
                <div class="fc-toolbar fc-header-toolbar">
                    <div class="fc-left">
                        <div class="fc-button-group">
                            <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" aria-label="prev">
                                <span class="fc-icon fc-icon-left-single-arrow"></span>
                            </button>
                            <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" aria-label="next">
                                <span class="fc-icon fc-icon-right-single-arrow"></span>
                            </button>
                        </div>
                        <button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled" disabled="">today</button>
                    </div>
                    <div class="fc-right"><div class="fc-button-group">
                        <button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button>
                        <button type="button" class="fc-basicWeek-button fc-button fc-state-default">week</button>
                        <button type="button" class="fc-basicDay-button fc-button fc-state-default fc-corner-right">day</button>
                    </div>
                </div>
                <div class="fc-center">
                    <h2 class="text-uppercase">January 2024</h2>
                </div>
                <div class="fc-clear">
                </div>
            </div>
            <div class="fc-view-container" style="">
            <div class="fc-view fc-month-view fc-basic-view" style="">
            <table class="">
                <thead class="fc-head">
                    <tr>
                        <td class="fc-head-container fc-widget-header">
                            <div class="fc-row fc-widget-header" >
                                <table class="">
                                    <thead>
                                        <tr>
                                            <th class="fc-day-header fc-widget-header fc-sun">
                                                <span>Sun</span>
                                            </th>
                                            <th class="fc-day-header fc-widget-header fc-mon">
                                                <span>Mon</span>
                                            </th>
                                            <th class="fc-day-header fc-widget-header fc-tue">
                                                <span>Tue</span>
                                            </th>
                                            <th class="fc-day-header fc-widget-header fc-wed">
                                                <span>Wed</span>
                                            </th>
                                            <th class="fc-day-header fc-widget-header fc-thu">
                                                <span>Thu</span>
                                            </th><th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden auto; height: auto;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content" style="height: 198px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2023-12-31"></td><td class="fc-day fc-widget-content fc-mon fc-past" id="data1" data-date="2024-01-01"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-01-02"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-01-03"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-01-04"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-01-05"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-01-06"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2023-12-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-01-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-01-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-01-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-01-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-01-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-01-06"><span class="fc-day-number">6</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 198px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-01-07"></td><td class="fc-day fc-widget-content fc-mon fc-past" id="data1" data-date="2024-01-08"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-01-09"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-01-10"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-01-11"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-01-12"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-01-13"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-01-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-01-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-01-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-01-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-01-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-01-12"><span class="fc-day-number">12</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-01-13"><span class="fc-day-number">13</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 198px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-01-14"></td><td class="fc-day fc-widget-content fc-mon fc-past" id="data1" data-date="2024-01-15"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-01-16"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-01-17"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-01-18"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-01-19"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-01-20"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-01-14"><span class="fc-day-number">14</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-01-15"><span class="fc-day-number">15</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-01-16"><span class="fc-day-number">16</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-01-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-01-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-01-19"><span class="fc-day-number">19</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-01-20"><span class="fc-day-number">20</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 198px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-01-21"></td><td class="fc-day fc-widget-content fc-mon fc-past" id="data1"  data-date="2024-01-22"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-01-23"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-01-24"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-01-25"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-01-26"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-01-27"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-01-21"><span class="fc-day-number">21</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-01-22"><span class="fc-day-number">22</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-01-23"><span class="fc-day-number">23</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-01-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-01-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-01-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-01-27"><span class="fc-day-number">27</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 198px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-01-28"></td><td class="fc-day fc-widget-content fc-mon fc-past" id="data1"  data-date="2024-01-29"></td><td class="fc-day fc-widget-content fc-tue fc-today " data-date="2024-01-30"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-01-31"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2024-02-01"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2024-02-02"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2024-02-03"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-01-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-01-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-tue fc-today " data-date="2024-01-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-wed fc-future" data-date="2024-01-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2024-02-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2024-02-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2024-02-03"><span class="fc-day-number">3</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 202px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-future" data-date="2024-02-04"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2024-02-05"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2024-02-06"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2024-02-07"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2024-02-08"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2024-02-09"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2024-02-10"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-future" data-date="2024-02-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2024-02-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2024-02-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2024-02-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2024-02-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2024-02-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2024-02-10"><span class="fc-day-number">10</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
        </div>
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
            <div class="modal-body modal-body-secondery">
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
                        <span><span class="font-adjust">Inq Type : </span><span id="inquiry_type"></span></span>
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
                <h6 class="modal-body-title">Int Site</h6>
                <div class="modal-body-card">
                    <div class="col-sm-6 col-12 view-name">
                        <span class="font-adjust">Int Product : </span><span id="int_product"></span>
                    </div>
                    <!-- <div class="col-sm-6 col-12 view-name">
                        <span class="font-adjust">Property Type : </span><span id="project_type_name"></span>
                    </div>
                    <div class="col-sm-6 col-12 view-name">
                        <span class="font-adjust">Budget : </span><span id="budget"></span>
                    </div>
                    <div class="col-sm-6 col-12 view-name">
                        <span class="font-adjust">Int Site : </span><span id="intersted_site"></span>
                    </div>
                    <div class="col-sm-6 col-12 view-name">
                        <span class="font-adjust">Purpose of Buying : </span><span id="purpose_buy"></span>
                    </div> -->
                    <div class="col-sm-6 col-12 view-name">
                        <span class="font-adjust">Approx Buying : </span><span id="approx_buy"></span>
                    </div>
                    <!-- <div class="col-sm-6 col-12 view-name">
                        <span class="font-adjust">Property Sub Type : </span><span id="property_sub_type"></span>
                    </div> -->
                </div>
                <h6 class="modal-body-title">FollowUp</h6>
                <div class="modal-body-card">
                    <div class="col-xl-12 view-name"><span><span class="font-adjust">Next Followup Date :
                            </span><span id="nxt_follow_up"></span></span>
                    </div>
                    <div class="col-xl-12 view-name"><span><span class="font-adjust">Appoitment Date :
                            </span><span id="appointment_date"></span></span>
                    </div>
                    <div class="col-xl-12 view-name"><span><span class="font-adjust">Description : </span><span
                                id="inquiry_description"></span></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row mt-2">
                    <div class=col-xl-12>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="callmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered call-model" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal fade interested_entry_form" id="interested_entry_form">
                <div class="modal-dialog modal-lg" style="max-width:1100px;">
                    <form method="post" id="interested_form" name="interested_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Inquiry ID : <span class="mx-2" id="inquiry_id">521654</span></h5>
                                <button type="button" class="modal-close-btn interested_model_close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                            <div class="modal-body modal-body-secondery">
                                <h6 class="modal-body-title">Interest</h6>
                                <div class="modal-body-card">

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                        <label for="property_sub_type" class="form-label main-label">Product <sup class="validationn">*</sup></label>
                                        <div class="main-selectpicker w-100">
                                            <select name="property_sub_type" id="property_sub_type" class="selectpicker form-control form-main" data-live-search="true" required>
                                                <i class="fa-solid fa-caret-down"></i>
                                                <option value="">Select Product</option>
                                               
                                            </select>
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                        <label for="approx_buy" class="form-label main-label">Apx Buying Time <sup class="validationn">*</sup></label>
                                        <div class="main-selectpicker w-100">
                                            <!-- set dropdown here -->
                                            <select id="approx_buy" name="approx_buy" class="selectpicker form-control form-main" data-live-search="true" required>
                                                <i class="fa-solid fa-caret-down"></i>
                                                <option value="">Select Apx Time</option>
                                                <option value="2-3 days">2-3 Days</option>
                                                <option value="week">Week</option>
                                                <option value="10-15_days">10-15 Days</option>
                                                <option value="1-month">1 Month</option>
                                                <option value="2-month">2 Month</option>
                                                <option value="3-month">3 Month</option>
                                                <option value="4-month">4 Month</option>
                                                <option value="5-month">5 Month</option>
                                                <option value="6-month">6 Month</option>
                                                <option value="7-month">7 Month</option>
                                                <option value="8-month">8 Month</option>
                                                <option value="9-month">9 Month</option>
                                                <option value="10-month">10 Month</option>
                                                <option value="11-month">11 Month</option>
                                                <option value="1-year">1 Year</option>
                                                <option value="1.5-year">1.5 Year</option>
                                                <option value="2-year">2 Year</option>
                                            </select>
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-closing btn-primary ps-2 pe-2" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn-primary" id="add_data" data-edit_id>submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-header">
                <div class="modal-title d-flex align-items-center flex-wrap flex-sm-nowrap">
                    <h6>
                        <span class="inq_id"></span>
                    </h6>
                    <h6 class="mx-2"><span class="full_name"></span></h6>
                    <h6 class="col-12 flex-sm-fill"><i class="bi bi-telephone"></i> : <span class="mobileno"></span></h6>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column-reverse">
                    <div class="my-1 my-sm-0">
                        <a class="tel_mobileno btn-secondary-rounded" href="tel:123-456-7890">
                            <i class="bi bi-telephone fs-14"></i>
                        </a>
                    </div>
                    <div class="mx-2">
                        <a class="wp_mobileno btn-secondary-rounded" href="tel:123-456-7890">
                            <i class="bi bi-whatsapp fs-14"></i>
                        </a>
                    </div>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body modal-body-secondery rounded-bottom">
                <div class="modal-body-card">
                    <!-- <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                        <span>
                            <span class="font-adjust">Inq for : </span><span class="project_sub_type_name"></span>
                        </span>
                    </div> -->
                    <!-- <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                        <span>
                            <span class="font-adjust">Int Site : </span><span class="intersted_site"></span>
                        </span>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                        <span>
                            <span class="font-adjust">Budget : </span><span class="budget"></span>
                        </span>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                        <span>
                            <span class="font-adjust">Purpose : </span><span class="purpose_buy"></span>
                        </span>
                    </div> -->
                    <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                        <span>
                            <span class="font-adjust">Product : </span><span class="int_product"></span>
                        </span>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                        <span>
                            <span class="font-adjust">Approx Buying : </span> <span class="approx_buy"></span>
                        </span>
                    </div>
                    <div class="col-xl-4 fill_interest"></div>
                </div>
                <div class="nav nav-pills call-modal-tabs mb-3 navtab_secondary_sm mt-2" id="pills-tab-4" role="tablist"></div>
                <div class="tab-content w-100" id="pills-tabContent123">
                    <div class="tab-pane fade show active" id="pills-follow-up" role="tabpanel" aria-labelledby="follow-up-tab" tabindex="0">
                        <div class="modal-body-card mb-2 d-block">
                            <form method="post" name="inquiry_update_status_form">
                                <div class="col-xl-12">
                                    <label for="" class="form-label main-label">Remark <sup class="validationn">*</sup></label>
                                    <textarea class="form-control remark form-control main-control" id="remark" rows="1" name="remark" required=""> </textarea>
                                </div>
                                <div class="col-12 mt-2 d-flex justify-content-between">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <label for="next-follow-up">next follow up <sup class="validationn">*</sup></label>
                                        <input type="text" class="next-followup form-control main-control " placeholder="DD/MM/YYYY HH:MM" name="nxt_follow_up" value="" required="" />
                                        <div class="date_valid_msg"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-dismissed" role="tabpanel" aria-labelledby="dismissed-tab" tabindex="0">
                        <div class="modal-body-card mb-2 d-block">
                            <form method="post" name="inquiry_update_status_form">
                                <div class="col-xl-12">
                                    <label for="" class="form-label main-label">Remark <sup class="validationn">*</sup></label>
                                    <textarea class="form-control remark form-control main-control" id="remark" rows="1" name="remark" required=""></textarea>
                                </div>
                                <div class="col-12 mt-2 d-flex justify-content-between flex-wrap">
                                    <div class="col-xl-6 col-sm-6 col-12 col-lg-6 col-md-6">
                                        <div class="main-selectpicker w-100">
                                            <select name="inquiry_close_reason" id="inquiry_close_reason" class="selectpicker form-control form-main" data-live-search="true" required>
                                                <i class="fa-solid fa-caret-down"></i>
                                                <option value="">Select Close reason</option>
                                         
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-appoin" role="tabpanel" aria-labelledby="appoin-tab" tabindex="0">
                        <div class="modal-body-card mb-2 d-block">
                            <form method="post" name="inquiry_update_status_form">
                                <div class="col-xl-12">
                                    <label for="" class="form-label main-label">Remark <sup class="validationn">*</sup></label>
                                    <textarea class="form-control remark form-control main-control" id="remark" rows="1" name="remark" required=""></textarea>
                                </div>
                                <div class="d-flex flex-wrap">

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label for="appoint-date">appointment date <sup class="validationn">*</sup></label>
                                        <input type="text" class="next-followup form-control main-control " placeholder="DD/MM/YYYY HH:MM" id="appoint_date" name="appoint_date" value="" required="" />
                                        <div class="date_valid_msg"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 pe-2 pe-0 pe-sm-2">
                                        <label for="next-follow-up">next follow up <sup class="validationn">*</sup></label>
                                        <input type="text" class="next-followup form-control main-control " placeholder="DD/MM/YYYY HH:MM" name="nxt_follow_up" value="" required="" />
                                        <div class="date_valid_msg"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-negotia" role="tabpanel" aria-labelledby="negotia-tab" tabindex="0">
                        <div class="modal-body-card mb-2 d-block">
                            <form method="post" name="inquiry_update_status_form">
                                <div class="col-xl-12">
                                    <label for="" class="form-label main-label">Remark <sup class="validationn">*</sup></label>
                                    <textarea class="form-control main-control remark" id="remark" rows="1" name="remark" required=""></textarea>
                                </div>
                                <div class="col-12 mt-2 d-flex justify-content-between">
                                    <div class="col-xl-6 col-lg-6 col-sm-6 col-md-6 col-6">
                                        <label for="next-follow-up">next follow up <sup class="validationn">*</sup></label>
                                        <input type="text" class="next-followup form-control main-control " placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" name="nxt_follow_up" value="" required="" />
                                        <div class="date_valid_msg"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-feedback" role="tabpanel" aria-labelledby="feedback-tab" tabindex="0">
                        <div class="modal-body-card mb-2 d-block">
                            <form method="post" name="inquiry_update_status_form">
                                <div class="col-xl-12">
                                    <label for="" class="form-label main-label">Remark <sup class="validationn">*</sup></label>
                                    <textarea class="form-control main-control remark" id="remark" rows="1" name="remark" required=""></textarea>
                                </div>
                                <div class="col-12 mt-2 d-flex justify-content-between">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <label for="next-follow-up">next follow up <sup class="validationn">*</sup></label>
                                        <input type="text" class="form-control main-control next-followup" placeholder="DD/MM/YYYY HH:MM" name="nxt_follow_up" value="" required="" />
                                        <div class="date_valid_msg"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-cnr" role="tabpanel" aria-labelledby="cnr-tab" tabindex="0"></div>
                </div>
                <div class="col-xl-12 mt-2 text-end">
                    <button class="btn-primary ms-auto inquiry_status_submit mt-2 mt-sm-0" id="inquiry_status_submit" data-inquiry_id="" name="inquiry_status_submit" value="inquiry_status_submit">Submit</button>
                </div>
                <div class="call-list">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view-task" tabindex="-1" aria-labelledby="ModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title text-white">Task Detail</h1>
                <button type="button" class="modal-close-btn text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-rr-cross-circle d-flex fs-5"></i>
                </button>
            </div>
            <div class="modal-body px-2 py-3">
                <div class=" d-flex align-items-center justify-content-center mb-3">
                    <div class="d-flex">
                        <div class="d-flex align-items-center cursor-pointer me-3 edit_task_from_viewmodel"
                            data_edit_id="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"
                                fill="none">
                                <path
                                    d="M234.667 85.333H85.3337C74.0178 85.333 63.1653 89.8282 55.1638 97.8298C47.1622 105.831 42.667 116.684 42.667 128V426.666C42.667 437.982 47.1622 448.835 55.1638 456.836C63.1653 464.838 74.0178 469.333 85.3337 469.333H384C395.316 469.333 406.169 464.838 414.17 456.836C422.172 448.835 426.667 437.982 426.667 426.666V277.333"
                                    stroke="#FFA500" stroke-width="32" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M394.667 53.333C403.154 44.846 414.665 40.0781 426.667 40.0781C438.669 40.0781 450.18 44.846 458.667 53.333C467.154 61.8199 471.922 73.3306 471.922 85.333C471.922 97.3353 467.154 108.846 458.667 117.333L256 320L170.667 341.333L192 256L394.667 53.333Z"
                                    stroke="#FFA500" stroke-width="32" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </div>
                        <div class="d-flex align-items-center cursor-pointer me-3 delete_btn_viewmodel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"
                                fill="none">
                                <path d="M64 128H106.667H448" stroke="#FF0000" stroke-width="32" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M405.334 128V426.667C405.334 437.983 400.838 448.835 392.837 456.837C384.835 464.838 373.983 469.334 362.667 469.334H149.334C138.018 469.334 127.165 464.838 119.164 456.837C111.162 448.835 106.667 437.983 106.667 426.667V128M170.667 128V85.3337C170.667 74.0178 175.162 63.1653 183.164 55.1638C191.165 47.1622 202.018 42.667 213.334 42.667H298.667C309.983 42.667 320.835 47.1622 328.837 55.1638C336.838 63.1653 341.334 74.0178 341.334 85.3337V128"
                                    stroke="#FF0000" stroke-width="32" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </div>
                        <div class="d-flex align-items-center cursor-pointer me-3 assign_to_viewmodel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"
                                fill="none">
                                <path d="M490.666 128L288 330.667L181.333 224L21.333 384" stroke="#6E6B7B"
                                    stroke-width="32" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M362.667 128H490.667V256" stroke="#6E6B7B" stroke-width="32"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-pills navtab_primary_sm mb-3 fs-14 justify-content-center" id="pills-tab"
                    role="tablist">
                    <li class="nav-item px-2 mt-2" role="presentation">
                        <button class="fw-medium active task_details_btndiv" id="task-details-tab" data-bs-toggle="pill"
                            data-bs-target="#task-details" type="button" role="tab" aria-controls="task-details"
                            aria-selected="true">Task Details</button>
                    </li>
                    <li class="nav-item px-2 mt-2" role="presentation">
                        <button class="fw-medium" id="task-comment-tab" data-bs-toggle="pill"
                            data-bs-target="#task-comment" type="button" role="tab" aria-controls="task-comment"
                            aria-selected="true">Task Comments</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="task-details" role="tabpanel"
                        aria-labelledby="task-details-tab">
                        <div class="shadow-sm rounded-2 px-3">
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Subject</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary subject_view_model">erwew</div>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Priority</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 task_priority_set_div"><span
                                            class="fs-12 rounded-pill task-Low text-white px-2">Low</span></div>
                                </div>
                            </div>
                            <div class="col-12 py-2 is-task-div">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Start Date</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary start_data_view_model"></div>
                                </div>
                            </div>
                            <div class="col-12 py-2 is-task-div">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">End Date</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary end_data_view_model"></div>
                                </div>
                            </div>
                            <div class="col-12 py-2 is-other-div">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Date Type</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary otherdate-type"></div>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium mt-3 attachment_title"
                                        data_attachment=''>Attachment</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium mt-3">:</div>
                                    <div class="col-8 store_html_attch">
                                        <div
                                            class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between">
                                            <p class="ms-3">28072023063254853_search_(1).svg</p>
                                            <div class="border-start d-flex p-2 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#a7acb1" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between">
                                            <p class="ms-3">28072023063254853_search_(2).svg</p>
                                            <div class="border-start d-flex p-2 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#a7acb1" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between">
                                            <p class="ms-3">28072023063254853_search_(3).svg</p>
                                            <div class="border-start d-flex p-2 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#a7acb1" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Description</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 word-break-all text-body-secondary description_show_div"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show_comment_div" id="task-comment" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="shadow-sm rounded-2 p-4 text-center">No Task Comments</div>
                        <div id="task_comment_list">
                            <div class="task-comment-box shadow-sm rounded-2 my-2">
                                <div
                                    class="task-comment-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between">
                                    <p class="text-body-tertiary fw-medium">1.</p>
                                    <div class="comment-header-icons">
                                        <div class="comment-icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="task-comment-body px-3 py-2">
                                    <p class="fs-14 word-break-all text-secondary-emphasis">Lorem Ipsum is simply dummy
                                        text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was popularised in the 1960s with the
                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions of
                                        Lorem Ipsum.
                                    </p>
                                </div>
                            </div>
                            <div class="task-comment-box shadow-sm rounded-2 my-2">
                                <div
                                    class="task-comment-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between">
                                    <p class="text-body-tertiary fw-medium">2.</p>
                                    <div class="comment-header-icons">
                                        <div class="comment-icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="task-comment-body px-3 py-2">
                                    <p class="fs-14 word-break-all text-secondary-emphasis">Lorem Ipsum is simply dummy
                                        text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" data-bs-dismiss="modal"
                    data-bs-dismiss="modal">Cancle</button>
            </div>
        </div>
    </div>
</div>

<p id="payment_selling"></p>
<div id="html"></div>
<?= $this->include('partials/footer') ?>
<script>

$('body').on('click', '.modal-close-btn', function() {
    $("#calendarModal #modalBody").html("");
});
   </script>