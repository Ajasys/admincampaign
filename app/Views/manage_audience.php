<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$admin_product = json_decode($admin_product, true);
$master_inquiry_status = json_decode($master_inquiry_status, true);
?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2 position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1">
                    <i class="bi bi-people"></i>
                    <h2> Manage Audiences</h2>
                </div>
            </div>

        </div>
        <div class="row starting-page ps-3 flex-nowrap">
            <div class="px-3 py-2  bg-white rounded-2 col-12 border first-container">
                <div class="bg-white rounded-2 rounded-2 p-3">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-4 col-md-1 col-sm-6 px-2">
                            <button class=" btn-primary btn-primary button-add" data-bs-toggle="modal"
                                data-bs-target="#create_audience_list" name="inquirysource_add" value="occupation-add"
                                type="submit">Create Audience +</button>
                        </div>
                        <!-- <div class="d-flex align-items-center col-sm-12 col-md-2 my-1 my-md-0">
                            <div class="w-100 input-text pe-2">
                                <input type="search" name="task_Search" size="1" class="form-control main-control mb-0"
                                    id="task_Search" onkeyup="taskUserSearchID()" placeholder="Search...">
                            </div>
                            <div class="ms-2">
                                <button class="btn-primary-rounded fs-14 d-flex align-items-center justify-content-center"
                                    onclick="taskUserSearchID()">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div> -->
                        <div class="col-sm-12 col-md-2 my-1 my-md-1 d-none d-md-block">
                            <div class="d-flex justify-content-end align-items-center">
                                <button class="btn-primary-rounded" data-bs-toggle="offcanvas"
                                    data-bs-target="#audience_filter" aria-controls="offcanvasRight">
                                    <i class="bi bi-funnel fs-14"></i>
                                </button>
                                <!-- <button class="btn-primary-rounded plus_btn" data-bs-toggle="modal" id="plus_btn"
                                    data-bs-target="#task-add">
                                    <i class="fi fi-rr-plus-small d-flex"></i>
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 overflow-x-auto scroll-small row_none">
                    <table class="w-100 main-table lead_list_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="select-all-sms" /></th>
                                <th class="p-2 text-nowrap"><span>Name</span></th>
                                <th class="p-2 text-nowrap"><span>Type</span></th>
                                <th class="p-2 text-nowrap"><span>Estimated Audience </span></th>
                                <th class="p-2 text-nowrap"><span>Availability</span></th>
                                <th class="p-2 text-nowrap"><span>Date Created</span></th>
                            </tr>
                        </thead>
                        <tbody class="audiance_list">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-3 col-6">
                <div class=" py-2  bg-white rounded-2 col-12 border h-100 d-flex flex-column justify-content-between">
                    <div class="p-3 py-1 border-bottom">
                        <div class="card-header">
                            <div class="text-end">
                                <div class="modal-content">
                                    <div class="modal-header broder-bottom">
                                        <h5 class="modal-title">Custom Audience -Leadmgt CRM Demo data .csv</h5>
                                        <button class="close_container  border-0 bg-transparent"><i
                                                class="bi bi-x-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 py-1">
                        <div class="card-header my-2">
                            <div class="col-12">
                                <label for="#" class="fw-bolder">Audience Name</label>
                                <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, in!</P>
                            </div>
                        </div>
                        <div class="card-header my-2">
                            <div class="col-12">
                                <label for="#" class="fw-bolder">Estimated Audience Size</label>
                                <P>22000-55000</P>
                            </div>
                        </div>
                        <div class="card-header my-2">
                            <div class="col-12">
                                <label for="#" class="fw-bolder">Type</label>
                                <P>Lorem ipsum dolor</P>
                            </div>
                        </div>
                        <div class="card-header my-2">
                            <div class="col-12">
                                <label for="#" class="fw-bolder">Created</label>
                                <P>1/23/24 6:30pm</P>
                            </div>
                        </div>
                        <div class="card-header my-2">
                            <div class="col-12">
                                <label for="#" class="fw-bolder">Last Updated</label>
                                <P>--</P>
                            </div>
                        </div>
                        <div class="card-header my-2">
                            <div class="col-12">
                                <label for="#" class="fw-bolder">Country</label>
                                <P>Surat</P>
                            </div>
                        </div>
                        <div class="card-header my-2">
                            <div class="col-12">
                                <label for="#" class="fw-bolder">Source</label>
                                <P>Leadmgt CRM Demo data .csv</P>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-2">
                        <div class="card-header">
                            <div class="col-12">
                               <button type="button" class="btn-primary me-2 Cancle_Btn close_container" >Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row second-page px-3 justify-content-end">
            <div class="col-12 border bg-white rounded-2 d-flex flex-wrap justify-content-end">
                <div class="col-12 px-3 py-2 ">
                    <div class="title-1 justify-content-center align-items-center">
                        <i class="bi bi-people"></i>
                        <h2>Audiences</h2>
                    </div>
                    <div class="w-100 overflow-x-auto scroll-small row_none">
                        <table class="w-100 main-table audience_list_table">
                            <thead>
                                <tr>
                                    <th class="p-2 text-nowrap"><span>Created Date </span></th>
                                    <th class="p-2 text-nowrap"><span>Lead Id </span></th>
                                    <th class="p-2 text-nowrap"><span>Name </span></th>
                                    <th class="p-2 text-nowrap"><span>Mobile no </span></th>
                                    <th class="p-2 text-nowrap"><span>Plateform </span></th>
                                    <th class="p-2 text-nowrap"><span>Inquiry Id </span></th>
                                </tr>
                            </thead>
                            <tbody class="audiance_product_wise">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-2 text-end mt-1 mb-2">
                    <button id="audiunse_back_btn" type="button" class="btn-primary"><i
                            class="bi bi-arrow-90deg-left fs-6"></i> Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="lead_list_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Lead View</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" modal-body modal-body-secondery">
                <div class="modal-body-card">
                    <div class="row col-12">
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="add-user-input">
                                <label for="relation" class="form-label main-label fw-semibold">Inquiry Id
                                    :</label>
                                <span id="inquiry_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="name" class="form-label main-label fw-semibold">Name :</label>
                                <span id="full_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="form_id" class="form-label main-label fw-semibold">Form Id:</label>
                                <span id="form_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="campaign_id" class="form-label main-label fw-semibold">Campaign Id :</label>
                                <span id="campaign_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="adset_id" class="form-label main-label fw-semibold">Adset Id :</label>
                                <span id="adset_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="ad_id" class="form-label main-label fw-semibold">Ad Id :</label>
                                <span id="ad_id"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="add-user-input">
                                <label for="relation" class="form-label main-label fw-semibold">Platform
                                    :</label>
                                <span id="platform"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="em_mobile" class="form-label main-label fw-semibold">Mobile
                                    Number :</label>
                                <span id="mobile"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="form_name" class="form-label main-label fw-semibold">Form Name
                                    :</label>
                                <span id="form_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="campaign_name" class="form-label main-label fw-semibold">Campaign Name
                                    :</label>
                                <span id="campaign_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="adset_name" class="form-label main-label fw-semibold">Adset Name :</label>
                                <span id="adset_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="ad_name" class="form-label main-label fw-semibold">Ad Name :</label>
                                <span id="ad_name"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="audience_filter" aria-labelledby="offcanvasRightLabel">
    <form method="post" class="d-flex flex-column h-100" name="filter_form">
        <div class="offcanvas-header FilterTitleDiv">
            <h5 id="offcanvas-title " class="filtersTitle" style="color: #fff">Filter</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body filter_data">
            <div class="row">
                <div class="col-lg-12 mb-3 ">
                    <input type="text" class="form-control main-control place Filtername" name="party_name"
                        id="party_name" placeholder="Name">
                </div>

                <div class="col-lg-12 mb-3 ">
                    <input type="text" class="form-control main-control place FilterSellingAmount " name="date_purchase"
                        id="date_purchase" placeholder="Date">
                </div>
                <div class="col-lg-12 mb-3 ">
                    <input type="text" class="form-control main-control place " id="bill_amount" name="bill_amount"
                        placeholder="Mobile No">
                </div>

            </div>
        </div>
    </form>
</div>
<!-- =====customart-modal==== -->
<div class="modal fade" id="create_audience_list" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Choose A Custom Audience Source</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" modal-body modal-body-secondery d-flex flex-wrap">
                <div class="col-6 px-2">
                    <div class="modal-body-card col-12">
                        <div class="row col-12">
                            <div class="col-12 px-2">
                                <h6 for="fname">Crm Sources </h3>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault" checked>
                                        <label class="form-label main-label" for="flexRadioDefault2">
                                            Customer List
                                        </label>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 px-2">
                    <div class="modal-body-card col-12">
                        <div class="row col-12">
                            <div class="col-12 px-2">
                                <h6 for="fname">Custom Audience</h3>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2" >
                                        <label class="form-label main-label" for="flexRadioDefault2">
                                            Data
                                        </label>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#customart_data2">Next</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="customart_data2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!--==============first  -->
            <div class="modal-header" id="first_modalheader">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Create a Customer Custom Audience</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<!--============= second============  -->
            <div class="modal-header d-none" id="second_modalheader">
                <h4 class="modal-title fs-5" id="exampleModalToggleLabel2">Create a Custom Audience</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<!--==============first  -->
            <div class="modal-body " id="first_modalbody">
                <form class="col-12" name="project_type_form">
                    <div class="main-selectpicker">
                        <label for="#">Product <sup class="validationn">*</sup></label>
                        <select id="product_name" placeholder="Enter Subject" name="task_type"
                            class="selectpicker form-control form-main main-control select_product product_name"
                            data-live-search="true" required="" tabindex="-98">
                            <option value="0">Select Product</option>
                            <?php

                            if (isset($admin_product)) {
                                foreach ($admin_product as $type_key => $type_value) {
                                    echo '<option class="dropdown-item" Data_TypeId="' . $type_value["id"] . '" value="' . $type_value["product_name"] . '">' . $type_value["product_name"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="main-selectpicker">
                        <label for="#">Status<sup class="validationn">*</sup></label>
                        <select id="inquiry_status" placeholder="Enter Subject" name="inquiry_status"
                            class="selectpicker form-control form-main main-control FIStatus inquiry_status" data-live-search="true"
                            required="" tabindex="-98">
                            <option value="0">Select Status</option>
                            <?php
                            if (isset($master_inquiry_status)) {
                                foreach ($master_inquiry_status as $type_key => $type_value) {
                                    echo '<option class="dropdown-item" value="' . $type_value["inquiry_status"] . '">' . $type_value["inquiry_status"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                <div class="col-12 mt-3">
                    <div class="main-selectpicker">
                        <label for="#">Retention<i class="bi bi-info-circle-fill mx-2"></i></label>
                        <div class="col-12 d-flex align-items-center">
                            <input type="text" placeholder="Enter Days" class="form-control form-main main-control">
                            <span class="mx-2">Days</span>
                        </div>
                    </div>
                </div>
                </form>

            </div>
<!--============= second============  -->
            <div class="modal-body d-none" id="second_modalbody">
                <div class=" bg-white rounded-2  col-12">
                    <div class="col-12">
                        <label for="" class="form-label main-label">Inq file upload <sup class="validationn">*</sup></label>
                        <input type="file" class="form-control main-control get_exel_file"   name="import_file" placeholder="Details" required="" accept=".xls,.xlsx">
                    </div>
                    <div class="col-12 mt-4 custom_exel d-none">
                        <div class="d-flex justify-content-between align-items-center my-2 flex-wrap w-100 mt-2">
                            <div class="title-1">
                                <i class="fa-solid fa-table-columns"></i>
                                <h6>File Column Handling</h2>
                            </div>
                            <div class="title-side-icons column-btn">
                                <!-- <button class="btn-primary add" type="button" data-bs-toggle="modal" data-bs-target="#column_add" aria-controls="column_add">
                            + Add Column
                        </button> -->
                            </div>
                        </div>
                        <form name="column_data_form" id="column_data_form" class="needs-validation" method="POST"
                            novalidate="">
                            <div class="mt-1 file_columns">
                                <div class="col-12 d-sm-flex d-none flex-wrap">
                                    <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 text-center">
                                        <span class="fs-6">From</span>
                                    </div>
                                    <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 text-center">
                                        <span class="fs-6">to</span>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-wrap mb-2">
                                    <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1">
                                        <input type="text" class="form-control main-control" id="id_file" name=""
                                            placeholder="File Column name" value="id" readonly="" required="">
                                    </div>
                                    <div
                                        class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">
                                        <span class="mx-auto col-1">to</span>
                                        <div class="main-selectpicker col-11 dropdown">
                                            <input type="text" id="list"
                                                class="form-control list main-control dropdown-toggle file_columns_input"
                                                data-bs-toggle="dropdown" aria-expanded="false" name="0" placeholder="id">
                                            <ul class="dropdown-menu dropdown-menu-end w-100 column_list" id="column_list">
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>full_name</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>address</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>dob</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>mobileno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>altmobileno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>email</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>houseno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>society</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>area</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>city</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>state</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>country</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>subscription</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>int_subscription</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>budget</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>intrested_product</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>feedback</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>remark</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>broker</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>message</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>quatation</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>qualified</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>prospect</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>contacted</span></button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-wrap mb-2">
                                    <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1">
                                        <input type="text" class="form-control main-control" id="firstname_file" name=""
                                            placeholder="File Column name" value="firstname" readonly="" required="">
                                    </div>
                                    <div
                                        class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center column_name_list">
                                        <span class="mx-auto col-1">to</span>
                                        <div class="main-selectpicker col-11 dropdown">
                                            <input type="text" id="list"
                                                class="form-control list main-control dropdown-toggle file_columns_input"
                                                data-bs-toggle="dropdown" aria-expanded="false" name="1"
                                                placeholder="firstname">
                                            <ul class="dropdown-menu dropdown-menu-end w-100 column_list" id="column_list">
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>full_name</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>address</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>dob</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>mobileno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>altmobileno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>email</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>houseno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>society</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>area</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>city</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>state</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>country</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>subscription</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>int_subscription</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>budget</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>intrested_product</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>feedback</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>remark</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>broker</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>message</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>quatation</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>qualified</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>prospect</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>contacted</span></button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-wrap mb-2">
                                    <div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1">
                                        <input type="text" class="form-control main-control" id="mobileno_file" name=""
                                            placeholder="File Column name" value="mobileno" readonly="" required="">
                                    </div>
                                    <div
                                        class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">
                                        <span class="mx-auto col-1">to</span>
                                        <div class="main-selectpicker col-11 dropdown">
                                            <input type="text" id="list"
                                                class="form-control list main-control dropdown-toggle file_columns_input"
                                                data-bs-toggle="dropdown" aria-expanded="false" name="2"
                                                placeholder="mobileno">
                                            <ul class="dropdown-menu dropdown-menu-end w-100 column_list" id="column_list">
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>full_name</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>address</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>dob</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>mobileno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>altmobileno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>email</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>houseno</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>society</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>area</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>city</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>state</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>country</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>subscription</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>int_subscription</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>budget</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>intrested_product</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>feedback</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>remark</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>broker</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>message</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>quatation</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>qualified</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>prospect</span></button></li>
                                                <li><button class="dropdown-item list_item"
                                                        type="button"><span>contacted</span></button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 custome_column" style="display: none;">
                                <div class="text-start">
                                    <span class="fs-6">Custome Columns</span>
                                </div>
                                <!-- <div class="col-12 d-flex">
                            <div class="bulk-action select col-lg-6 col-12 px-1 mt-lg-0 mb-1">
                                <input type="text" class="form-control main-control" id="import_file" name="import_file" placeholder="Details" required="">
                            </div>
                            <div class="bulk-action select col-lg-6 col-12 px-1 mt-lg-0 mb-1">
                                <div class="main-selectpicker">
                                    <select name="action_name" id="action_name" id="bulk-action" class="selectpicker form-control form-main" data-live-search="true" required="">
                                        <option value="">Select Action</option>
                                        <option value="assign_followups">Assign Followups</option>
                                        <option value="transfer_ownership">Transfer Inq</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                            </div>
                        </form>
                    </div>
                    <!-- <div class="justify-content-between d-flex">
                        <button class=" btn-primary custome_col" type="submit" id="custome_col" name="custome_col">Add
                            Custome
                            Column</button>
                        <button class=" btn-primary import_btn" type="submit" id="import_btn" name="import_btn">Import
                            Data</button>
                    </div> -->

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#create_audience_list" data-bs-toggle="modal">Back to
                    first</button>
                <button class="btn btn-primary create_audiences" name="create_audiences" data-bs-dismiss="modal">Create Audiance</button>
            </div>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $(".lead_list_table").DataTable({

        "ordering": false

    });
    function datatable_view(html) {
        $('.lead_list_table').DataTable().destroy();
        $('.audiance_list').html(html);
        var table1 = $('.lead_list_table').DataTable({
            "columnDefs": [{
                "visible": false,
                "ordering": false,
            }],
            lengthChange: true,
        });

    }
    function datatables_view(html) {
        $('.audience_list_table').DataTable().destroy();
        $('.audiance_product_wise').html(html);
        var table1 = $('.audience_list_table').DataTable({
            "columnDefs": [{
                "visible": false,
                "ordering": false,
            }],
            lengthChange: true,
        });

    }
    function list_data() {
        show_val = '<?= json_encode(array('created_time', 'ad_id')); ?>';

        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('audience_list_data'); ?>",
            data: {
                'table': 'all_inquiry',
                'show_array': show_val,
                'action': true
            },
            success: function (res) {
                $('.loader').hide();
                datatable_view(res);
                //alert("hello");
            }
        });
    }
    list_data();

    // Event listener for the "View" button
    $("#audiunse_btn").on("click", function () {
        var FilterStock = '';
        $('#product_name :selected').each(function () {
            if (FilterStock !== "") {
                FilterStock += ",";
            }
            FilterStock += $(this).val(); // Use val() instead of attr('Data_TypeId')
        });
        // var FIStatus = '';
        //  $('.FIStatus :selected').each(function() {
        //     if (FIStatus !== "") {
        //        FIStatus += ",";
        //     }
        //     FIStatus += $(this).val();
        //  });
        var selectedAudienceType = $("#inquiry_status").val();
        $.ajax({
            type: "POST",
            url: "audience_show_data",
            data: {
                'table': 'all_inquiry',
                'show_array': selectedAudienceType,
                'action': true,
                'FilterStock': FilterStock, // Corrected variable name
            },
            success: function (res) {
                $('.loader').hide();
                datatables_view(res);
            },
            error: function () {
                alert("Error fetching data");
            }
        });
    });

    // view data 
    $('body').on('click', '.audiance_view', function (e) {
        // alert("fd");
        var edit_value = $(this).attr("data-view_id");
        if (edit_value != "") {
            $.ajax({
                type: "post",
                url: "<?= site_url('audience_view_data'); ?>",
                data: {
                    action: 'view',
                    view_id: edit_value,
                    table: 'all_inquiry',
                },
                success: function (res) {
                    $('.loader').hide();
                    var response = JSON.parse(res);
                    // console.log();

                    $('#lead_list_modal #user_id').text(response[0].user_id);
                    $('#lead_list_modal #full_name').text(response[0].full_name);
                    $('#lead_list_modal #mobile').text(response[0].mobileno);
                    $('#lead_list_modal #form_id').text(response[0].id);
                    if (response[0]['platform'] == 'ig') {
                        $platform = '<i class="fa-brands fa-instagram transition-5 icon1" style="background: -webkit-linear-gradient(#f32170, #ff6b08, #cf23cf, #eedd44);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>';
                    }
                    else {
                        $platform = '<i class="fa-brands fa-facebook transition-5 icon2 rounded-circle" style="color: #0b85ed;"></i>';
                    }
                    $('#platform').text($platform);
                    $('#lead_list_modal #form_name').text(response[0].inquiry_status);
                    $('#lead_list_modal #ad_id').text(response[0].intrested_product);
                    $('#lead_list_modal #campaign_id').text(response[0].user_id);
                    $('.selectpicker').selectpicker('refresh');
                },
            });
        } else {
            $('.loader').hide();
            alert("Data Not Edit.");
        }
    });

    $("button[name='create_audiences']").click(function (e) {
        alert('');
    e.preventDefault();
    var form = $("form[name='project_type_form']")[0];
    console.log(form);
    // Get selected product, status, and retention value
    var product_name = $("#product_name").val();
    console.log(product_name);
    var inquiry_status = $("#inquiry_status").val();
    var retansion = $(".main-selectpicker input[type='text']").val();

    if (product_name != 0 && inquiry_status != 0 && retansion != "") {
        // Calculate date 90 days ago
        var retentionDate = new Date();
        retentionDate.setDate(retentionDate.getDate() - parseInt(retentionDays, 10));
        var retentionDateFormatted = retentionDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD

        // Create data to be sent to the server
        var formData = new FormData();
        formData.append('action', 'insert');
        formData.append('table', 'audiences');
        formData.append('product_name', product_name);
        formData.append('inquiry_status', inquiry_status);
        formData.append('retansion', retansion);
        formData.append('retention_date', retentionDateFormatted);

        $('.loader').show();

        // Perform AJAX request
        $.ajax({
            method: "post",
            url: "<?= site_url('audience_insert_data'); ?>",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data != "error") {
                    $("form[name='project_type_form']")[0].reset();
                    $("form[name='project_type_form']").removeClass("was-validated");
                    $('.loader').hide();
                    iziToast.success({
                        title: 'Added Successfully'
                    });
                    list_data();
                } else {
                    $('.loader').hide();
                    iziToast.error({
                        title: 'Duplicate data'
                    });
                }
            },
        });
    } else {
        // Handle validation error
        $("form[name='project_type_form']").addClass("was-validated");
    }
});
</script>
<script>
    $('#audiunse_btn').attr('disabled', true);
    $('.second-page').hide();
    $('body').on('change', '#product_name', function () {
        // $('#selscr_user2').closest('.col-12').addClass('d-none');
        var a = $(this).val();
        // console.log(a);
        // alert(a);
        if (a != 0) {
            $('#inquiry_status').closest('.col-12').removeClass('d-none');
            // $('#audiunse_btn').attr('disabled',false);
        }
        else {
            $('#inquiry_status').closest('.col-12').addClass('d-none');
            // $('#audiunse_btn').attr('disabled',true);
        }

    })
    // $('.audi-card').slideUp();
    $('.create-btn').click(function () {
        $('.audi-card').toggleClass('d-none');
        // $('.audi-card').slideToggle();
    })

    $('body').on('click', '#audiunse_btn', function () {
        $('.starting-page').hide();
        $('.second-page').show();
    })
    $('body').on('click', '#audiunse_back_btn', function () {
        $('.starting-page').show();
        $('.second-page').hide();
    })
    $('body').on('click', '.audiance_show_data', function () {
        $('.first-container').addClass('col-6');
        $('.first-container').removeClass('col-12');
    })
    $('body').on('click', '.close_container', function () {
        $('.first-container').addClass('col-12');
        $('.first-container').removeClass('col-6');
    })
    $('body').on('change','.get_exel_file', function () {
        $('.custom_exel').removeClass('d-none');
        // alert('dfhslkfhsfh');
    });
    $('body').on('change','#flexRadioDefault2',function(){
        // if($(this).is('::checked')){
        //     alert('jksdfgh');
        // }
        if ($(this).is(":checked")) {
            $('#second_modalbody').removeClass('d-none');
            $('#second_modalheader').removeClass('d-none');
            $('#first_modalbody').addClass('d-none');
            $('#first_modalheader').addClass('d-none');
        }
    })
    $('body').on('change','#flexRadioDefault',function(){
        // if($(this).is('::checked')){
        //     alert('jksdfgh');
        // }
        if ($(this).is(":checked")) {
            // alert("first Is checked!");
            $('#second_modalbody').addClass('d-none');
            $('#second_modalheader').addClass('d-none');
            $('#first_modalbody').removeClass('d-none');
            $('#first_modalheader').removeClass('d-none');
        }
        // else{
        //     $('#second_modalbody').removeClass('d-none');
        //     $('#second_modalheader').removeClass('d-none');
        //     $('#first_modalbody').addClass('d-none');
        //     $('#first_modalheader').addClass('d-none');
        // }
    })
</script>
<script>
    $('body').on('change', '#inquiry_status', function () {
        var b = $(this).val();
        // alert('lksdfsl');
        if (b != 0) {
            $('#audiunse_btn').attr('disabled', false);
        }
        else {
            $('#audiunse_btn').attr('disabled', true);
        }
    })
</script>