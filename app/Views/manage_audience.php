<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
   $admin_product = json_decode($admin_product, true);
   $master_inquiry_status = json_decode($master_inquiry_status, true);
   ?>
<?php
   $username = session_username($_SESSION['username']);
   $db_connection = \Config\Database::connect('second');
   $query = $db_connection->table($username . '_audience')->get();
   if ($query->getNumRows() > 0) {
       $columnNames = $query->getFieldNames();
   } else {
       $columnNames = array();
   }
   // pre($columnNames);
   ?>
<style>
   table th,
   td {
   border: 1px solid #ebebeb;
   text-align: center !important;
   }
   #DataTables_Table_0 thead th:first-child {
   padding-right: 0px !important;
   }
   .icon-div {
   background: lightgray;
   width: 70px;
   height: 70px;
   }
   .write-div {
   margin-left: 15px;
   }
   .gray {
   background: lightgray;
   margin-left: 15px;
   }
   .mian {
   font-size: 25px;
   }
   @media screen and (max-width: 400px) {
   #active {
   font-size: 12px;
   }
   .icon-div {
   width: 50px;
   height: 50px;
   margin-top: 10px;
   }
   .mian {
   font-size: 15px;
   }
   }
   .audiance_show_data{
   transition: all 0.5s;
   }
   .audiance_show_data_active{
   background-color: #d8d7ff!important;
   }
   .audiance_show_data:hover{
   background-color: #efefef;
   }
</style>
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
                  <div class="col-lg-4 col-md-4 col-sm-6 px-2">
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
                  <!-- <div class="col-sm-12 col-md-2 my-1 my-md-1 d-none d-md-block">
                     <div class="d-flex justify-content-end align-items-center">
                         <button class="btn-primary-rounded" data-bs-toggle="offcanvas"
                             data-bs-target="#audience_filter" aria-controls="offcanvasRight">
                             <i class="bi bi-funnel fs-14"></i>
                         </button>
                        
                     </div>
                     </div> -->
               </div>
            </div>
            <div class="w-100 row_none">
               <table class="w-100 main-table lead_list_table">
                  <thead>
                     <tr>
                        <th><input type="checkbox" class="select-all-sms" /></th>
                        <th class="p-2 text-nowrap"><span>Name</span></th>
                        <th class="p-2 text-nowrap"><span>Type</span></th>
                        <th class="p-2 text-nowrap"><span>Estimated Audience </span></th>
                        <th class="p-2 text-nowrap"><span>Availability</span></th>
                        <th class="p-2 text-nowrap"><span>Date Created</span></th>
                        <th class="p-2 text-nowrap"><span>Audience Id</span></th>
                     </tr>
                  </thead>
                  <tbody class="audiance_list">
                  </tbody>
               </table>
            </div>
         </div>
         <div class="px-3 col-6">
            <div id="lead_list_modal"
               class=" py-2  bg-white rounded-2 col-12 border h-100 d-flex flex-column justify-content-between lead_list_modal">
               <div class="p-3 py-1 border-bottom">
                  <div class="card-header">
                     <div class="text-end">
                        <div class="modal-content">
                           <div class="modal-header broder-bottom">
                              <h5 class="modal-title">Audience View</h5>
                              <button class="close_container  border-0 bg-transparent"><i
                                 class="bi bi-x-circle"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="p-3 py-1 h-75 d-flex justify-content-between flex-column">
                  <div class="card-header my-2">
                     <div class="col-12">
                        <label for="#" class="fw-bolder">Audience Name</label>
                        <P class="name"></P>
                     </div>
                  </div>
                  <div class="card-header my-2">
                     <div class="col-12">
                        <label for="#" class="fw-bolder">Estimated Audience Size</label>
                        <P class="size"></P>
                     </div>
                  </div>
                  <div class="card-header my-2">
                     <div class="col-12">
                        <label for="#" class="fw-bolder">Type</label>
                        <P class="type"></P>
                     </div>
                  </div>
                  <div class="card-header my-2">
                     <div class="col-12">
                        <label for="#" class="fw-bolder">Created</label>
                        <P class="created_at"></P>
                     </div>
                  </div>
                  <div class="card-header my-2">
                     <div class="col-12">
                        <label for="#" class="fw-bolder">Last Updated</label>
                        <P class="last_updated"></P>
                     </div>
                  </div>
                  <div class="card-header my-2">
                     <div class="col-12">
                        <label for="#" class="fw-bolder">Source</label>
                        <P class="source"></P>
                     </div>
                  </div>
               </div>
               <div class="col-12 px-2 py-2">
                  <div class="card-header">
                     <div class="col-12">
                        <button type="button"
                           class="btn-primary me-2 Cancle_Btn close_container">Cancel</button>
                        <button type="button" class="btn-primary me-2 Cancle_Btn  edt" data-edit_id=""
                           data-bs-toggle="modal" data-bs-target="#Edit_custom">Edit</button>
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
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 px-2">
               <div class="modal-body-card col-12">
                  <div class="row col-12">
                     <div class="col-12 px-2">
                        <h6 for="fname">
                        Crm Sources </h3>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="flexRadioDefault"
                              id="flexRadioDefault" value="Customer List" checked>
                           <label class="form-label main-label" for="flexRadioDefault">
                           Customer List
                           </label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 px-2 mt-2 mt-sm-2 mt-md-0 mt-lg-0 mt-xl-0 mt-xxl-0">
               <div class="modal-body-card col-12">
                  <div class="row col-12">
                     <div class="col-12 px-2">
                        <h6 for="fname">
                        Custom Audience</h3>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="flexRadioDefault"
                              id="flexRadioDefault2" value="Custom audience">
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
            <button type="button" class="btn btn-secondary next_btn" data-bs-toggle="modal"
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
            <h4 class="modal-title fs-5" id="exampleModalToggleLabel2">
            Create a Custom Audience</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <!--==============first  -->
         <div class="modal-body " id="first_modalbody">
            <form class="col-12" name="project_type_form">
               <div class="main-selectpicker">
                  <label for="#">Product <sup class="validationn">*</sup></label>
                  <select id="intrested_product" placeholder="Enter Subject" name="task_type"
                     class="selectpicker form-control form-main main-control select_product intrested_product"
                     data-live-search="true" required="" tabindex="-98">
                     <option value="0">Select Product</option>
                     <?php
                        if (isset($admin_product)) {
                            foreach ($admin_product as $type_key => $type_value) {
                                echo '<option class="dropdown-item" Data_TypeId="' . $type_value["id"] . '" value="' . $type_value["id"] . '">' . $type_value["product_name"] . '</option>';
                            }
                        }
                        ?>
                  </select>
               </div>
               <div class="main-selectpicker">
                  <label for="#">Status<sup class="validationn">*</sup></label>
                  <select id="inquiry_status" placeholder="Enter Subject" name="inquiry_status"
                     class="selectpicker form-control form-main main-control FIStatus inquiry_status"
                     data-live-search="true" required="" tabindex="-98">
                     <option value="0">Select Status</option>
                     <?php
                        if (isset($master_inquiry_status)) {
                            foreach ($master_inquiry_status as $type_key => $type_value) {
                                echo '<option class="dropdown-item" value="' . $type_value["id"] . '">' . $type_value["inquiry_status"] . '</option>';
                            }
                        }
                        ?>
                  </select>
               </div>
               <!-- <div class="col-12 mt-3">
                  <div class="main-selectpicker">
                      <label for="#">Retention<i class="bi bi-info-circle-fill mx-2"></i></label>
                      <div class="col-12 d-flex align-items-center">
                          <input type="text" placeholder="Enter Days"
                              class="form-control form-main main-control retansion" id="retansion">
                          <span class="mx-2">Days</span>
                      </div>
                  </div>
                  </div> -->
               <div class="col-12 mt-3">
                  <div class="main-selectpicker">
                     <label for="#">Name <sup class="validationn">*</sup></label>
                     <div class="col-12 d-flex align-items-center">
                        <input type="text" placeholder="Enter name"
                           class="form-control form-main main-control name" id="name" required="">
                     </div>
                  </div>
               </div>
               <div class="col-12 mt-3">
                  <div class="main-selectpicker">
                     <label for="#">Select inquiry audience<sup class="validationn">*</sup></label>
                     <div class="col-12 d-flex align-items-center mt-1">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                           <input type="radio" id="static_data" name="option" value="1" checked>
                           <label for="static_data" style="margin-right: 10px;">Static Data</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                           <input type="radio" id="increase_data" name="option" value="2">
                           <label for="increase_data" style="margin-right: 10px;">Increase Data</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                           <input type="radio" id="live_data" name="option" value="3">
                           <label for="live_data">Live Data</label>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <!--============= second============  -->
         <div class="modal-body d-none" id="second_modalbody">
            <div class=" bg-white rounded-2  col-12">
               <form class="needs-validation" name="import_inquiry_csv" method="POST" novalidate="">
                  <div class="col-12">
                     <h6 for="" class="form-label main-label mb-1 d-flex flex-wrap align-items-center">
                        <div class="rounded-circle border text-primary align-items-center justify-content-center d-flex border-4 fs-6 me-2"
                           style="width:30px;height:30px;">1</div>
                        Name Your Audiance<sup class="validationn">*
                     </h6>
                     <div class="col-12 d-flex flex-wrap">
                        <div class="rounded-circle fs-6 me-2" style="width:30px;height:30px;"></div>
                        <div class="col">
                           <input type="text" placeholder="Enter name"
                              class="form-control form-main main-control names" id="names" required="">
                        </div>
                     </div>
                  </div>
                  <div class="col-12 mt-2 mb-3">
                     <h6 for="" class="form-label main-label mb-1 d-flex flex-wrap align-items-center">
                        <div class="rounded-circle border text-primary align-items-center justify-content-center d-flex border-4 fs-6 me-2"
                           style="width:30px;height:30px;">2</div>
                        Prepare your file Data
                     </h6>
                     <div class="col-12 d-flex flex-wrap">
                        <div class="rounded-circle fs-6 me-2" style="width:30px;height:30px;"></div>
                        <div class="col">
                           <span class="py-1 px-2 border fs-10 me-2 fw-medium">Email</span>
                           <span class="py-1 px-2 border fs-10 mx-2 fw-medium">Phone Number</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <h6 for="" class="form-label main-label mb-1 d-flex flex-wrap align-items-center">
                        <div class="rounded-circle border text-primary align-items-center justify-content-center d-flex border-4 fs-6 me-2"
                           style="width:30px;height:30px;">3</div>
                        Inq file upload <sup class="validationn">*
                     </h6>
                     <div class="col-12 d-flex flex-wrap">
                        <div class="rounded-circle fs-6 me-2" style="width:30px;height:30px;"></div>
                        <div class="col">
                           <input type="file" class="form-control main-control get_exel_file"
                              name="import_file" placeholder="Details" required="" accept=".xls,.xlsx">
                        </div>
                        <button class=" btn-primary import_btn mx-2" type="submit" id="import_inquiry_csv_btn"
                           name="import_btn" disabled>Import</button>
                     </div>
                  </div>
               </form>
               <div class="col-12 mt-4 custom_exel d-flex flex-wrap">
                  <div class="rounded-circle fs-6 me-2" style="width:30px;height:30px;"></div>
                  <div class="col">
                     <div class="d-flex justify-content-between align-items-center my-2 flex-wrap w-100 mt-2">
                        <div class="title-1">
                           <i class="fa-solid fa-table-columns"></i>
                           <label for="" class="form-label main-label">File Column Handling</label>
                        </div>
                        <div class="title-side-icons column-btn">
                           <!-- <button class="btn-primary add" type="button" data-bs-toggle="modal" data-bs-target="#column_add" aria-controls="column_add">
                              + Add Column
                              </button> -->
                        </div>
                     </div>
                     <form name="column_data_form" id="column_data_form" class="needs-validation" method="POST"
                        novalidate="">
                        <div class="mt-3 file_columns">
                           <div class="text-center">
                              <span class="fs-6">File Not Imported</span>
                           </div>
                        </div>
                        <!-- <div class="mt-3 custome_column">
                           <div class="text-start">
                               <span class="fs-6">Custome Columns</span>
                           </div>
                           
                           </div> -->
                     </form>
                     <!-- <div class="justify-content-between d-flex">
                        <button class=" btn-primary custome_col" type="submit" id="custome_col" name="custome_col">Add Custome
                            Column</button>
                        <button class=" btn-primary import_btn" type="submit" id="import_btn" name="import_btn">Import
                            Data</button>
                        </div> -->
                  </div>
               </div>
               <div class="d-flex justify-content-between align-items-center my-2 mt-4 flex-wrap w-100 mt-2">
                  <div class="title-side-icons column-btn">
                     <!-- <button class="btn-primary add" type="button" data-bs-toggle="modal" data-bs-target="#column_add" aria-controls="column_add">
                        + Add Column
                        </button> -->
                  </div>
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
            <button class="btn btn-primary create_audiences" id="create_audiences" name="create_audiences">Create
            Audiance</button>
            <button class=" btn-primary imported_btn" type="submit" id="imported_btn" name="imported_btn"
               disabled>Create
            Audiance</button>
         </div>
      </div>
   </div>
</div>
<!-- edit-modal -->
<div class="modal  modal-lg" id="Edit_custom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="fw-bold mb-2 mian fs-5">Update your customer list custom audience</h5>
            <button type="button" class="btn-close close_container" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p id="active" class="fs-14">Changing your customer list custom audience will also update any ad sets or
               lookalike audiences that use it. This won't reset your campaign learning phase.
            </p>
            <div class="border rounded border-2 p-lg-3 p-2 d-flex m-0 mt-2 m-lg-3">
               <div class="icon-div rounded p-lg-3 p-2 text-center justify-content-center"><i
                  class="fa-regular fa-circle-user fs-1"></i></div>
               <div class="mt-2 write-div">
                  <div class="fw-bold" id="active">Replace customers</div>
                  <div id="active" class="fs-14">Upload a new list that will replace the users in your existing audience.
                  </div>
               </div>
            </div>
            <!-----------------add customer--------------->
            <div class="border rounded border-2 p-lg-3 p-2 d-flex m-0 mt-2 m-lg-3">
               <div class="icon-div rounded p-lg-3 p-2 text-center justify-content-center"><i
                  class="fa-solid fa-circle-plus fs-1"></i></div>
               <div class="mt-2 write-div">
                  <div class="fw-bold" id="active">Add Customer</div>
                  <div id="active" class="fs-14">Upload a new list that will replace the users in your existing audience.
                  </div>
               </div>
            </div>
            <!-------------------remove customer----------------------------->
            <div class="border rounded border-2 p-lg-3 p-2 d-flex m-0 mt-2 m-lg-3">
               <div class="icon-div rounded p-lg-3 p-2 text-center justify-content-center"><i
                  class="fa-solid fa-circle-minus fs-1"></i></div>
               <div class="mt-2 write-div">
                  <div class="fw-bold" id="active">Remove Customer</div>
                  <div id="active" class="fs-14">Upload a new list that will replace the users in your existing audience.
                  </div>
               </div>
            </div>
            <!---------------------- edit audience name----------------------------->
            <form class="needs-validation" name="audience_edit" method="POST" novalidate="">
               <div class="fw-bold mt-4">Edit audience name</div>
               <div class="d-flex m-0 mt-2 m-lg-3">
                  <div class="input-group">
                     <input type="text" class="form-control w-50 w-lg-75 p-2 name_audience" id="new_name" placeholder="ANB visit.sv">
                     <span class="input-group-text bg-transparent">13/50</span>
                  </div>
               </div>
               <div class="col-12 mt-3">
                  <div class="main-selectpicker">
                  <div class="fw-bold mt-4">Edit inquiry audience<sup class="validationn">*</sup></div>
                     <div class="col-12 d-flex align-items-center">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                           <input type="radio" id="static_data" name="option1" value="1" checked>
                           <label for="static_data" style="margin-right: 10px;">Static Data</label>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                           <input type="radio" id="increase_data" name="option1" value="2">
                           <label for="increase_data" style="margin-right: 10px;">Increase Data</label>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                           <input type="radio" id="live_data" name="option1" value="3">
                           <label for="live_data">Live Data</label>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_container" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary update_btn page_reload" data-edit_id>Update</button>
         </div>
      </div>
   </div>
</div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
   // function list_data() {
   //     $.ajax({
   //         method: "post",
   //         url: "<?= site_url('audience_facebook_data'); ?>",
   //         data: {
   //             action: 'facebook_list',
   //         },
   //         success: function (res) {
   //             $('.loader').hide();
   //             datatable_view(res);
   //         }
   //     });
   // }
   
   function list_dataa() {
       show_val = '<?= json_encode(array('created_time', 'ad_id')); ?>';
   
       $.ajax({
           datatype: 'json',
           method: "post",
           url: "<?= site_url('audience_list_data'); ?>",
           data: {
               'table': 'audience',
               'show_array': show_val,
               'action': true
           },
           success: function (res) {
               $('.loader').hide();
               datatable_view(res);
               list_data();
           }
       });
   }
   
   function datatable_view(html) {
       $('.lead_list_table').DataTable().destroy();
       $('.audiance_list').append(html);
       var table1 = $('.lead_list_table').DataTable({
           "columnDefs": [{
               "visible": false,
               "ordering": false,
           }],
           lengthChange: true,
       });
   
   }
   
   // Call both functions when the page loads
   list_dataa();
   
   
   
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
                   table: 'audience',
               },
               success: function (res) {
                   $('.loader').hide();
                   var response = JSON.parse(res);
                   $('.lead_list_modal .name').text(response.name);
                   
                  
                   $('.lead_list_modal .type').text(response.source);
                   $('.lead_list_modal .size').text(response.sub_count);
                  
                   // $('.lead_list_modal .created_at').text(response.created_at);
                   dateString = response.created_at;
                   var parts = dateString.split(' ');
                   var datePart = parts[0];
                   var timePart = parts[1];
                   var dateComponents = datePart.split('-');
                   var year = dateComponents[0];
                   var month = dateComponents[1];
                   var day = dateComponents[2];
                   var newDateFormat = day + '-' + month + '-' + year + ' ' + timePart;
                   $('.lead_list_modal .created_at').text(newDateFormat);
                   dateStrings = response.updated_at;
                   var parts = dateStrings.split(' ');
                   var datePart = parts[0];
                   var timePart = parts[1];
                   var dateComponents = datePart.split('-');
                   var year = dateComponents[0];
                   var month = dateComponents[1];
                   var day = dateComponents[2];
                   var newDateFormatupdate = day + '-' + month + '-' + year + ' ' + timePart;
                   $('.lead_list_modal .last_updated').text(newDateFormatupdate);
                   $('.lead_list_modal .source').text(response.inquiry_type_name); // Update the element with class 'source' with the inquiry_type_name value
                  
                   $('.edt').attr('data-edit_id', response.id);
                   $('.selectpicker').selectpicker('refresh');
                   $('.edt').attr('disabled',false)
               },
           });
       } else {
           $('.loader').hide();
           alert("Data Not Edit.");
       }
   });
   $(document).ready(function () {
       // Listen for change event on radio buttons
       $("input[name='flexRadioDefault']").change(function () {
           // Get the selected value
           var selectedValue = $("input[name='flexRadioDefault']:checked").val();
   
           // Log the selected value to the console (you can use it as needed)
           console.log("Selected Value: " + selectedValue);
       });
   });
   $("button[id='create_audiences']").click(function (e) {
       e.preventDefault();
   
       // Get form and selected values
       var form = $("form[name='project_type_form']")[0];
       var intrested_product = $("#intrested_product").val();
       var inquiry_status = $("#inquiry_status").val();
       var retansion = $("#retansion").val();
       var name = $("#name").val();
       var source = $("input[name='flexRadioDefault']:checked").val();
       var inquiry_data = $("input[name='option']:checked").val();
   
       // Validate form fields
       if (intrested_product != "" && inquiry_status != "" && name != "") {
           var formData = new FormData();
           formData.append('action', 'insert');
           formData.append('table', 'audience');
           formData.append('intrested_product', intrested_product);
           formData.append('inquiry_status', inquiry_status);
           formData.append('retansion', retansion);
           formData.append('name', name);
           formData.append('source', source);
           formData.append('inquiry_data', inquiry_data);
   
           // Show loader
           $('.loader').show();
   
           // Perform AJAX request
           $.ajax({
               method: "post",
               url: "<?= site_url('audience_insert_data'); ?>",
               data: formData,
               processData: false,
               contentType: false,
               success: function (data) {
                   // Check response and handle accordingly
                   if (data != "error") {
                       $("form[name='project_type_form']")[0].reset();
                       $('.btn-close').trigger('click');
                       $("form[name='project_type_form']").removeClass("was-validated");
                       $('.loader').hide();
   
                       iziToast.success({
                           title: 'Added Successfully'
                       });
                       
                       location.reload(true);
                       list_data();
                   }
                   else {
                       $('.loader').hide();
                       iziToast.error({
                           title: 'Data not available'
                       });
                   }
                   list_data();
               },
           });
       } else {
           // If form fields are not valid, add validation classes
           $("form[name='project_type_form']").addClass("was-validated");
           $(form).find('.selectpicker').each(function () {
               // Check if the selectpicker has the required attribute
               var selectpicker_valid = $(this).prop('required') ? 1 : 0;
               if (selectpicker_valid) {
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
   });
   $('body').on('click', '.edt', function(e) {
       e.preventDefault();
       var edit_value = $(this).attr("data-edit_id");
       $('.loader').show();
       $.ajax({
           type: "post",
           url: "<?= site_url('edit_data_audience'); ?>",
           data: {
               action: 'edit',
               edit_id: edit_value,
               table: 'audience'
           },
           success: function(res) {
               $('.loader').hide();
               $('.selectpicker').selectpicker('refresh');
               var response = JSON.parse(res);
               console.log(response);
               $('.update_btn').attr('data-edit_id', response[0].name);
               $('.edt').attr('data-name', response.name); // Update data-name attribute
               // Optionally, you can update other attributes as needed
   
               // Update other elements with the received data
               $('.name_audience').val(response[0].name);
               $('input[name="option1"][value="' + response[0].inquiry_data + '"]').prop('checked', true);
               // Update other elements as needed
           },
           error: function(error) {
               $('.loader').hide();
           }
       });
   });
   $('body').on('click', '.update_btn', function(e) {
       e.preventDefault();
       var update_id = $(this).attr("data-edit_id");
       var new_name = $("#new_name").val(); // Get the new name from the input field
       var inquiry_data = $("input[name='option1']:checked").val();
       var formdata = new FormData();
       formdata.append('action', 'update');
       formdata.append('edit_id', update_id);
       formdata.append('table', 'audience');
       formdata.append('name', new_name); // Append the new name to the form data
       formdata.append('inquiry_data', inquiry_data); // Append the radio button value to the form data
       $('.loader').show();
       $.ajax({
           method: "post",
           url: "<?= site_url('update_data_audience'); ?>",
           data: formdata,
           processData: false,
           contentType: false,
           success: function(res) {
               if (res != "error") {
                   $('.loader').hide();
                   $('.btn-close').trigger('click');
                   iziToast.success({
                       title: 'Update Successfully'
                   });
                   location.reload(true);
                   list_data();
               } else {
                   $('.loader').hide();
                   iziToast.error({
                       title: 'Duplicate data'
                   });
               }
           },
           error: function(error) {
               $('.loader').hide();
           }
       });
   });
   
   
</script>
<script>
   $('#imported_btn').hide();
   $('#audiunse_btn').attr('disabled', true);
   $('.second-page').hide();
   $('body').on('change', '#intrested_product', function () {
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
   $('body').on('change', '.get_exel_file', function () {
       // alert('LKJC');
       $('.import_btn').attr('disabled', false);
       // alert('mital');
   
   });
   $('body').on('click', '#import_inquiry_csv_btn', function (e) {
       e.preventDefault();
       var form = $('form[name="import_inquiry_csv"]')[0];
       var formdata = new FormData(form);
       var file = $('#import_file').val();
       if (file != '') {
           $.ajax({
               method: "post",
               url: "<?= site_url('get_data_header_by_file_audience'); ?>",
               data: formdata,
               processData: false,
               contentType: false,
               success: function (res) {
                   var responce = JSON.parse(res);
                   $('.loader').hide();
                   $('.file_columns').html(responce.html);
                   $('.selectpicker').selectpicker('refresh');
                   $('#imported_btn').attr('disabled', false);
                   $('.import_btn').prop('disabled', false);
                   $('.custome_col').prop('disabled', false);
               },
           });
       }
   });
   $('body').on('change', '#flexRadioDefault2', function () {
       // if($(this).is('::checked')){
       //     alert('jksdfgh');
       // }
       if ($(this).is(":checked")) {
           $('#second_modalbody').removeClass('d-none');
           $('#second_modalheader').removeClass('d-none');
           $('#first_modalbody').addClass('d-none');
           $('#first_modalheader').addClass('d-none');
           // $('.create_audiences').addClass('d-none');
           $('#import_data').removeClass('d-none');
           $('.create_audiences').hide();
           $('#imported_btn').show();
       }
   })
   $('body').on('change', '#flexRadioDefault', function () {
   
       if ($(this).is(":checked")) {
           // alert("first Is checked!");
           $('#second_modalbody').addClass('d-none');
           $('#second_modalheader').addClass('d-none');
           $('#first_modalbody').removeClass('d-none');
           $('#first_modalheader').removeClass('d-none');
           $('.create_audiences').show();
           $('#imported_btn').hide();
   
       }
   
   })
   $('body').on('click', '.button-add', function () {
       $('form[name="project_type_form"]')[0].reset();
       $('.selectpicker').selectpicker('refresh');
       $('form[name="import_inquiry_csv"]')[0].reset();
       $('.selectpicker').selectpicker('refresh');
       $('#flexRadioDefault').prop('checked');
   
   });
   $('body').on('click', '.next_btn', function () {
       $("form[name='project_type_form']").removeClass("was-validated");
       $("form[name='import_inquiry_csv']").removeClass("was-validated");
       $('.selectpicker').closest('div').removeClass('selectpicker-validation');
   });
   $('body').on('click', '.list_item', function (e) {
       e.preventDefault();
       var text = $(this).text();
       console.log(text);
       text = text.replace('+ add', '');
       $(this).closest('.main-selectpicker').find('input').val(text);
   });
   
   $('body').on('keyup', '#list', function (event) {
       var input, filter, ul, li, i, txtValue;
       input = $(this);
       input_val = input.val().trim();
       filter = input_val.toUpperCase();
       ul = input.closest('.main-selectpicker').find("ul");
       li = ul.find("li");
   
       if (event.key === ' ') {
           input_val = input_val.replace(/ /g, '_');
           input.val(input_val);
       }
   
       var found = false;
   
       for (i = 0; i < li.length; i++) {
           txtValue = li.eq(i).text();
           if (txtValue.toUpperCase().indexOf(filter) > -1) {
               li.eq(i).css("display", "block");
               found = true;
           } else {
               li.eq(i).css("display", "none");
           }
       }
   
       if (!found) {
           ul.append('<li><button class="dropdown-item list_item d-flex" type="button"><span>' + input_val + '</span>');
       }
   });
   $('.custome_column').hide();
   $('body').on('click', '#custome_col', function (e) {
       e.preventDefault();
       var col_incriment_val = $('.custome_column').find('.custome_column_input');
       if (col_incriment_val.length == 0) {
           var i = 0;
       } else {
           var i = parseInt($('.custome_column').find('.custome_column_input:last').attr('data-check_id')) + 1;
       }
       $('.custome_column').show();
       var inputs = $('.file_columns').find('.file_columns_input');
       var html = '';
       var input_fileds = '';
       input_fileds += '<div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">'
           + '<div class="main-selectpicker col-12 dropdown">'
           + '<input type="text" id="list" class="form-control list main-control dropdown-toggle custome_column_input" data-bs-toggle="dropdown" aria-expanded="false" data-check_id="' + i + '" name="' + i + '_col" id="' + i + '_col" placeholder="Custome Column">'
           + '<ul class="dropdown-menu dropdown-menu-end w-100 column_list" id="column_list">';
                                   <?php foreach ($columnNames as $columnName) {
      if (!preg_match("/id/", $columnName) && !preg_match("/date/", $columnName) && !preg_match("/status/", $columnName) && !preg_match("/type/", $columnName) && !preg_match("/amount/", $columnName) && !preg_match("/inquiry/", $columnName) && !preg_match("/buy/", $columnName) && !preg_match("/pay/", $columnName) && !preg_match("/created/", $columnName) && !preg_match("/head/", $columnName) && !preg_match("/unit/", $columnName) && !preg_match("/follow/", $columnName) && !preg_match("/is/", $columnName) && !preg_match("/tooltip/", $columnName) && !preg_match("/site_/", $columnName) && !preg_match("/area_/", $columnName)) { ?>
                                       var allValuesAreSame = 0;
               inputs.each(function () {
                   console.log($(this).val());
                   console.log('<?php echo $columnName; ?>');
                   if ($(this).val() == '<?php echo $columnName; ?>') {
                       allValuesAreSame = 1;
                       // return false; // Break out of the loop
                   }
               });
               if (allValuesAreSame != 1) {
                   input_fileds += '<li><button class="dropdown-item list_item" type="button"><span><?php echo $columnName; ?></span></button></li>';
               }
                                       <?php }
      } ?>
           input_fileds += '</ul>'
               + '</div>'
               + '</div>'
               + '<div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">'
               + '<div class="main-selectpicker col-12 dropdown">'
               + '<div class="bulk-action select col-12 px-1 mt-lg-0 mb-1">'
               + '<input type="text" class="form-control main-control" id="' + i + '_value" name="' + i + '_value" placeholder="to Column Value" value="" required>'
               + '</div>'
               + '</div>'
               + '</div>';
       html += '<div class="col-12 d-flex flex-wrap mb-2">' + input_fileds + '</div>';
   
       $('.custome_column').append(html);
   });
   
   $('body').on('click', '#imported_btn', function (e) {
       e.preventDefault();
       var import_form = $('form[name="import_inquiry_csv"]')[0];
       var col_data_form = $('form[name="column_data_form"]')[0];
       var import_formdata = new FormData(import_form);
       var col_data_formdata = new FormData(col_data_form);
   
       // Iterate over the FormData object and append its data to import_formdata
       col_data_formdata.forEach(function (value, key) {
           import_formdata.append(key, value);
       });
   
       // Get the product_name from the form
       var name = $("#names").val();
       import_formdata.append('name', name);
   
       // Get the value of the checked radio button
       var source = $("input[id='flexRadioDefault2']:checked").val();
       import_formdata.append('source', source);
       if (name != "") {
           // Send the AJAX request
           $.ajax({
               method: "post",
               url: "<?= site_url('import_file_data_audience'); ?>",
               data: import_formdata,
               processData: false,
               contentType: false,
               beforeSend: function (f) {
                   $('.loader').show();
               },
               success: function (res) {
                   $('.loader').hide();
                   $('.btn-close').trigger('click');
                   $('.selectpicker').selectpicker('refresh');
                   iziToast.success({
                       title: 'data imported successfully'
                   });
                   
                   location.reload(true);
                   list_data();
                   data_module_list_data();
                   
               },
           });
       } else {
           $('.loader').hide();
           $("form[name='import_inquiry_csv']").addClass("was-validated");
       }
   });
   
   function ViewFbAudiances(id, name, subtype, count_range, time_updated, time_created) {
       $.ajax({
           method: "post",
           url: "<?= site_url('view_integrate_lead_audience'); ?>",
           data: {
               'id': id,
               'name': name,
               'subtype': subtype,
               'count_range': count_range,
               'time_updated': time_updated,
               'time_created': time_created,
           },
           success: function (res) {
               var leadData = {
                   id: res.id,
                   name: res.name,
                   subtype: res.subtype,
                   count_range: res.count_range,
                   time_updated: res.time_updated,
                   time_created: res.time_created
               };
   
               // Update DOM elements with the received data
               $('#lead_list_modal .name').text(leadData.name);
               $('#lead_list_modal .type').text(leadData.subtype);
               $('#lead_list_modal .size').text(leadData.count_range);
               $('#lead_list_modal .created_at').text(leadData.time_created);
               $('#lead_list_modal .last_updated').text(leadData.time_updated);
               $('#lead_list_modal .source').text(leadData.name);
               $('.edt').attr('disabled',true)
   
           },
           error: function (error) {
               $('.loader').hide();
               console.error("Error occurred: ", error);
           }
       });
   }
   $('body').on('click','.audiance_show_data',function(){
       $(this).addClass('audiance_show_data_active');
       $(this).siblings('.audiance_show_data').removeClass('audiance_show_data_active');
   
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
   $('body').on('click', '#import_inquiry_csv_btn', function () {
   
   })
   // $('body').on('click','.page_reload',function(){
   //     $(window).re
   // })
</script>