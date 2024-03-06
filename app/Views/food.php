<!-- header start -->
<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<!-- header end -->
<?php $table_username = ''; ?>
<?php
$SecondDB = DatabaseDefaultConnection();

$maxAutoIDQueryRequest = 'SELECT MAX(id) AS max_auto_id FROM master_food_request';
$maxAutoIDResultRequest = $SecondDB->query($maxAutoIDQueryRequest);
$maxAutoIDRowRequest = $maxAutoIDResultRequest->getRowArray();
$maxAutoIDRequest = $maxAutoIDRowRequest['max_auto_id'];

if ($maxAutoIDRequest !== null) {
    $data['maxAutoID'] = $maxAutoIDRequest;
} else {
    $maxAutoIDQueryItems = 'SELECT MAX(id) AS max_auto_id FROM master_food_items';
    $maxAutoIDResultItems = $SecondDB->query($maxAutoIDQueryItems);
    $maxAutoIDRowItems = $maxAutoIDResultItems->getRowArray();
    $maxAutoIDItems = $maxAutoIDRowItems['max_auto_id'];

    $data['maxAutoID'] = $maxAutoIDItems;
}

$nextAutoIncrementID = $data['maxAutoID'] + 1;
?>
<div class="main-dashbord p-2">
     <div class="container-fluid p-0">
          <div class="px-3 py-2 bg-white rounded-2 mx-2 m-2">
               <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                         <button class="nav-link active" id="pills-food-type" data-bs-toggle="pill"
                              data-bs-target="#pills-food-type-tab" type="button" role="tab" data-table="food"
                              aria-controls="pills-food-type-tab" aria-selected="false">Food Master</button>
                    </li>
                    <li class="nav-item" role="presentation">
                         <button class="nav-link " id="pills-food-master" data-bs-toggle="pill"
                              data-bs-target="#pills-food-master-tab" type="button" role="tab"
                              data-table="<?php echo $table_username . '_food_type' ?>"
                              aria-controls="pills-food-master-tab" aria-selected="true">Food Type</button>
                    </li>
                    <li class="nav-item" role="presentation">
                         <button class="nav-link" id="pills-food-request" data-bs-toggle="pill"
                              data-bs-target="#pills-food-request-tab" type="button" role="tab" data-table="master_food_request"
                              aria-controls="pills-food-request-tab" aria-selected="true">Food Request</button>
                    </li>
                    
               </ul>
          </div>
          <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
               <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="title-1">
                         <i class="fi fi-rr-comment-question"></i>
                         <h2>Food </h2>
                    </div>
                    <div class="title-side-icons">
                         <div class="deleted-all">
                              <span class="btn-primary-rounded">
                                   <i class="bi bi-trash3 fs-14"></i>
                              </span>
                         </div>
                         <button class="btn-primary-rounded" id="filter-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#foodUpdate" aria-controls="offcanvasRight">
                              <i class="bi bi-funnel fs-14"></i>
                         </button>
                         <button class="btn-primary-rounded" data-bs-toggle="modal" data-bs-target="#foodUpdate">
                              <i class="bi bi-plus PlusButtonDiv" id="plus_btn"></i>
                         </button>
                         <button class="btn-primary-rounded" hidden data-bs-toggle="modal" data-bs-target="#foodUpdate">
                              <i class="bi bi-plus PlusButtonDivSecond" id="plus_btn"></i>
                         </button>
                    </div>
               </div>
               <div class="col-12 d-flex justify-content-between filter-main">
                    <div class="col-8 col-sm-9 filter-show d-flex grey-color flex-wrap align-items-center"
                         id="filter-showw cursor-pointer">
                    </div>
                    <div>
                         <button class="clear btn-del btn-primary" id="clear">Clear All</button>
                    </div>
               </div>

               <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
                    <div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
                         <div class="dataTables_length" id="project_length">
                              <label>
                                   Show
                                   <select name="project_length" id="project_length_show" aria-controls="project">
                                   <option value="10">10</option>
                                   <option value="25">25</option>
                                   <option value="50">50</option>
                                   <option value="100">100</option>
                                   </select>
                                   Records
                              </label>
                         </div>
                         <div id="people_wrapper" class="dataTables_wrapper no-footer">
                              <div id="project_filter" class="dataTables_filter justify-content-end d-flex">
                                   <label>Search:<input type="search" class="search_value" placeholder="" aria-controls="project"></label>
                              </div>
                         </div>
                    </div>

                    <table class="food-table w-100 table table-striped dt-responsive nowrap main-table comman_list_data_table">
                         <thead>
                              <tr>
                                   <th style="width:0%">
                                        <input class="check_box select-all-sms" type="checkbox">
                                   </th>
                                   <th>
                                        <span>Food</span>
                                   </th>
                              </tr>
                         </thead>
                         <tbody id="" class="food_list_comman"></tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
                         <div class="row_count_div col-xl-6 col-12">
                              <p id="row_count"></p>
                         </div>
                         <div class="clearfix  col-xl-6 col-12">
                              <ul class="member_pagination justify-content-xl-end" id="member_pagination">
                              </ul>
                         </div>
                    </div>
               </div>

          </div>
     </div>
</div>


<div class="modal fade" id="AdminViwwModelID" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg">

          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Food View</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
               </div>
               <div class="modal-body overflow-X-scroll overflow-Y-scroll modal-body-secondery">
                    <div class="col-12 modal-body-card d-flex flex-wrap p-1">
                         <div class="col-md-4 col-12 d-flex flex-wrap justify-content-center">
                              <div class="col-12 fw-semibold fs-14 mt-2">
                                   Product Image
                              </div>
                              <div class=".col-12 avatar-upload avatar-preview d-inline-block">
                                   <img src="http://localhost/GymSmart/assets/images/food_type/coconut-milk.jpg" id="im-image" alt="" class="product_image ProductFoodImg mb-2 object-fit-cover" style="width: 190px; height: 190px;">
                                  
                              </div>
                              <div class="col-12 SVGSetVegeNonVeg">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"></path>
                                        <circle cx="1318" cy="1317" r="611" fill="#19C82A"></circle>
                                   </svg>
                              </div>
                         </div>
                         <div class="col-md-8 col-12 d-flex flex-wrap">

                              <div class="col-12 d-flex flex-wrap mt-2">

                                   <div class="py-1 col-sm-6 col-12">
                                        <p class="fs-15">Name</p>
                                        <span name="update_name" class="fw-semibold fs-15 update_name FoodNameSetViewModel" id="namefood" style="text-transform: capitalize;"></span>
                                   </div>

                                   <div class="py-1 col-sm-6 col-12 mb-2">
                                        <p class="fs-15">Type </p>
                                        <span name="update_name" class="fw-semibold fs-15 FoodTypeViewModelText" id="foodType" style="text-transform: capitalize;"></span>
                                   </div>

                              </div>
                      
                              <div class="col-12 fw-semibold fs-14 mt-3 ">
                                   <span>Nutrition Value Per</span>
                                   <span class="NutiotionPerTextViewClass"></span>
                                   <span class="NutritionUnitTextViewClass"> </span>
                              </div>

                              <div class="col-12 overflow-scroll" style="max-height:300px">

                                   <div class="col-12 my-2">
                                        <table class="table">
                                             <thead class="">
                                                  <tr>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Calories 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Protein 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Carbs 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Fats 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Fiber 
                                                            </span>
                                                       </th>
                                                  </tr>
                                             </thead>
                                             <tbody class="">
                                                  <tr>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold CaloriesTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold ProteinTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold CarbsTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold FatsTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold FiberTextViewClass">0</p>
                                                       </td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>
                                   
                              </div>

                                 
                         </div>
                    </div>
               </div>
               <div class="modal-footer">

                    <button type="button" class="btn btn-secondary  DlBtn " id="food_delete1" data-food_id=""  data-bs-dismiss="modal">Delete</button>
                    <button type="button" class="btn-primary PencilBtnModel  Elbtn" FoodSubType="" FoodName = "" DataImageSRC = "" DataId=""  id="edit-modal" data-bs-target="#foodUpdate" data-bs-toggle="modal">
                                                  <i class="bi bi-pencil"></i>
                                             </button>
               </div>
          </div>
     </div>
</div>

<div class="modal fade" id="FoodViwwModelID" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg">

          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Food View</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
               </div>
               <div class="modal-body overflow-X-scroll overflow-Y-scroll modal-body-secondery">
                    <div class="col-12 modal-body-card d-flex flex-wrap p-1">
                         <div class="col-md-4 col-12 d-flex flex-wrap justify-content-center">
                              <div class="col-12 fw-semibold fs-14 mt-2">
                                   Product Image
                              </div>
                              <div class=".col-12 avatar-upload avatar-preview d-inline-block">
                                   <img src="http://localhost/GymSmart/assets/images/food_type/coconut-milk.jpg" id="im-image" alt="" class="product_image ProductFoodImg mb-2 object-fit-cover" style="width: 190px; height: 190px;">
                                  
                              </div>
                              <div class="col-12 SVGSetVegeNonVeg">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2635 2635" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2635 0H0V2635H2635V0ZM2431 204H204V2431H2431V204Z" fill="#19C82A"></path>
                                        <circle cx="1318" cy="1317" r="611" fill="#19C82A"></circle>
                                   </svg>
                              </div>
                         </div>
                         <div class="col-md-8 col-12 d-flex flex-wrap">

                              <div class="col-12 d-flex flex-wrap mt-2">

                                   <div class="py-1 col-sm-6 col-12">
                                        <p class="fs-15">Name</p>
                                        <span name="update_name" class="fw-semibold fs-15 update_name FoodNameSetViewModel" id="namefood" style="text-transform: capitalize;"></span>
                                   </div>

                                   <div class="py-1 col-sm-6 col-12 mb-2">
                                        <p class="fs-15">Type </p>
                                        <span name="update_name" class="fw-semibold fs-15 FoodTypeViewModelText " id="foodType" style="text-transform: capitalize;"></span>
                                        <div class="input-group foodtypeEdit">
                                             <input type="text" class="form-control EDITfoodtypename" placeholder=""   aria-label="Amount (to the nearest dollar)">
                                             <span class="input-group-text insertfoodtype" DataId="" data-bs-dismiss="modal" data-bs-target="#foodrequest"><i class="bi bi-check-square-fill text-success fs-6"></i></span>
                                             <span class="input-group-text"><i class="bi bi-x-square-fill text-danger fs-6"></i></span>
                                        </div>
                                   </div>

                              </div>
                      
                              <div class="col-12 fw-semibold fs-14 mt-3">
                                   <span>Nutrition Value Per</span>
                                   <span class="NutiotionPerTextViewClass"></span>
                                   <span class="NutritionUnitTextViewClass"> </span>
                              </div>

                              <div class="col-12 overflow-scroll" style="max-height:300px">

                                   <div class="col-12 my-2">
                                        <table class="table">
                                             <thead class="">
                                                  <tr>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Calories 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Protein 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Carbs 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Fats 
                                                            </span>
                                                       </th>
                                                       <th scope="col" class="text-center">
                                                            <span class="fw-medium">
                                                                 Fiber 
                                                            </span>
                                                       </th>
                                                  </tr>
                                             </thead>
                                             <tbody class="">
                                                  <tr>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold CaloriesTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold ProteinTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold CarbsTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold FatsTextViewClass">0</p>
                                                       </td>
                                                       <td class="text-center">
                                                            <p class="fs-14 fw-semibold FiberTextViewClass">0</p>
                                                       </td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>
                                   
                              </div>

                                 
                         </div>
                    </div>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary   " id="request_approve" DataId="" data-bs-dismiss="modal" data-bs-target="#foodrequest">Approve</button>

                    <button type="button" class="btn btn-secondary  DlBtn" id="food_delete" DataId=""   data-bs-dismiss="modal" data-bs-target="#foodrequest">Delete</button>
                    <button type="button" class="btn-primary PencilBtnModel1  Elbtn" FoodSubType="" FoodName = "" DataImageSRC = "" DataId=""  id="edit-modal" data-bs-target="#foodUpdate" data-bs-toggle="modal">
                                                  <i class="bi bi-pencil"></i>
                                             </button>
               </div>
          </div>
     </div>
</div>
<!-- <div class="modal fade" id="foodUpdate5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-xl modal-xl-1">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title FoodModelTitle">Add Food</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" data-bs-target="#foodUpdate1" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
               </div>
               <div class="modal-body modal-body-secondery">
                    <div class="modal-body-card">
                         <div class="col-lg-2 col-md-4 col-12">
                              <form class="FoodModelProductImageForm w-100" enctype="multipart/form-data" method="post">
                                   <label for="form-stock" class="main-label d-block">Product Image</label>
                                   <div class="avatar-upload avatar-preview d-inline-block">
                                        <img src="https://hinacreates.com/wp-content/uploads/2021/06/dummy2-450x341.png" id="im-image" alt="" class="product_image ProductFoodImg mb-2 object-fit-cover" style="width: 130px; height: 130px;">
                                        <div class="avatar-edit">
                                             <input class="product_img UploadFoodImageClass position-absolute d-block opacity-0 w-100 h-100 cursor-pointer" id="product_image" name="images[]" type="file" placeholder="" style="z-index: 3;">
                                             <label for="imageUpload" style="z-index: 1;" class="position-relative"></label>
                                        </div>
                                   </div>
                              </form>
                         </div>
                         <div class="col-lg-3 col-md-4 col-12">
                              <form class="needs-validation novalidate food_add_form w-100" id="member_group" method="post" name="member_group" enctype="multipart/form-data" novalidate>
                                   <div class="row p-0 m-0">
                                        <div class="col-12 mb-4 mb-md-0">
                                             <label for="form-Occupation" class="main-label investor">Food Name
                                                  <sup class="validationn">*</sup>
                                             </label>
                                             <input type="text" class="form-control main-control FFoodNameClass" placeholder="Enter Food" required>
                                        </div>
                                        <div class="col-12 mb-4 mb-md-0">
                                             <label for="form-category" class="main-label investor">Veg/Non-Veg
                                                  <sup class="validationn">*</sup>
                                             </label>
                                             <div class="main-selectpicker w-100">
                                                  <select id="unit" name="unit" class="selectpicker form-control form-main VegDropDownClass" data-live-search="true" tabindex="-98" required="">
                                                       <option value="">Select Unit</option>
                                                       <option value="1">Veg</option>
                                                       <option value="2">Non-Veg</option>
                                                       <option value="3">Eggiterian</option>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="col-12 mb-4 mb-md-0">
                                             <label for="form-category" class="main-label investor">Type
                                                  <sup class="validationn">*</sup>
                                             </label>
                                             <div class="main-selectpicker w-100">
                                                  <select id="" name="" class="selectpicker form-control FoodSubTypeSelcectDiv form-main" data-live-search="true" tabindex="-98" required="">
                                                       <?php
                                                   $food_type = json_decode($food_type, true);

                                                       if (isset($food_type)) {
                                                            foreach ($food_type as $type_key => $type_value) {
                                                                 echo '<option value="' . $type_value["id"] . '" data-food-id="' . $type_value["id"] . '">' . $type_value["type"] . '</option>';
                                                            }
                                                       }
                                                       ?>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                         <div class="col-lg-7 col-md-4 col-12 border-start">
                              <div class="row m-0 p-0">
                                   <h6 class="col-12 mb-2">Nutrition Value</h6>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-category" class="main-label investor">Nutrition value per
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <div class="d-flex align-items-center">
                                             <div class="ps-1 w-100 pe-1">
                                                  <input type="number" class="form-control main-control DefaultQuantityInput" id="quantity" placeholder="Enter" min="1" max="1000" required>
                                             </div>
                                             <div>
                                                  <div class="main-selectpicker w-100">
                                                       <select id="unit" name="unit" data-width="fit" class="selectpicker MeasarmentMainSelectDropDown form-control form-main" data-live-search="true" tabindex="-98" required="">
                                                            <option class="GMClassDiv" value="GM">GM</option>
                                                            <option value="ML">ML</option>
                                                       </select>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Calories
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control CaloriesInputClass" placeholder="Enter Calories" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Protein
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control ProteinInputClass" placeholder="Enter Protein" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Carbs
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control CarbsInputClass" placeholder="Enter Carbs" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Fats
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control FatsInputClass" placeholder="Enter Fats" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Fiber
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control FiberInputClass" placeholder="Enter Fiber" required>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-body-card m-2">
                         <label for="form-category" class="main-label investor">Measarment Units
                              <sup class="validationn">*</sup>
                         </label>
                         <div class="col-12">
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="1">
                                        <span class="mx-2">Glass</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" main-control rounded-end-0 w-100 FFLargeInput1 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput1 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput1 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="2">
                                        <span class="mx-2">Cup</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput2 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput2 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>

                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput2 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="3">
                                        <span class="mx-2">Table Spoon</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput3 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput3 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput3 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="4">
                                        <span class="mx-2">Plate</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput4 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput4 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput4 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="5">
                                        <span class="mx-2">NOS</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput5 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput5 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput5 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="6">
                                        <span class="mx-2">Scoop</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput6 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput6 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput6 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="7">
                                        <span class="mx-2">Bottle</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput7 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput7 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput7 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="8">
                                        <span class="mx-2">Katori</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput8 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput8 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput8 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="9">
                                        <span class="mx-2">Bowl</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput9 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput9 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput9 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="10">
                                        <span class="mx-2">Mug</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput10 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput10 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput10 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="11">
                                        <span class="mx-2">Chinese Bowl</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput11 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput11 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput11 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn-primary   btn-cancel" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#subscription_delete" data-delete_id="1">Cancel</button>
                    <button class="btn-primary NewButtonFoodModelAddUpdate ButtonFoodModelAddUpdate btn-update"  DataMNo="<?php echo $nextAutoIncrementID; ?>" data-edit_id="" DataInsertUpdate="insert" id="save_btn" data-edit_id="" name="subscription_update" value="subscription_update">Submit</button>
               </div>
          </div>
     </div>
</div> -->



<div class="modal fade" id="foodUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-xl modal-xl-1">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title FoodModelTitle">Add Food</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" data-bs-target="#foodUpdate" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
               </div>
               <div class="modal-body modal-body-secondery">
                    <div class="modal-body-card">
                         <div class="col-lg-2 col-md-4 col-12">
                              <form class="FoodModelProductImageForm w-100" enctype="multipart/form-data" method="post">
                                   <label for="form-stock" class="main-label d-block">Product Image</label>
                                   <div class="avatar-upload avatar-preview d-inline-block">
                                        <img src="https://hinacreates.com/wp-content/uploads/2021/06/dummy2-450x341.png" id="im-image" alt="" class="product_image ProductFoodImgMain ProductFoodImg mb-2 object-fit-cover" style="width: 130px; height: 130px;">
                                        <div class="avatar-edit">
                                             <input class="product_img UploadFoodImageClass position-absolute d-block opacity-0 w-100 h-100 cursor-pointer" id="product_image" name="images[]" type="file" placeholder="" style="z-index: 3;">
                                             <label for="imageUpload" style="z-index: 1;" class="position-relative"></label>
                                        </div>
                                   </div>
                              </form>
                         </div>
                         <div class="col-lg-3 col-md-4 col-12">
                              <form class="needs-validation novalidate food_add_form w-100" id="member_group" method="post" name="member_group" enctype="multipart/form-data" novalidate>
                                   <div class="row p-0 m-0">
                                        <div class="col-12 mb-4 mb-md-0">
                                             <label for="form-Occupation" class="main-label investor">Food Name
                                                  <sup class="validationn">*</sup>
                                             </label>
                                             <input type="text" class="form-control main-control FFoodNameClass" placeholder="Enter Food" required>
                                        </div>
                                        <div class="col-12 mb-4 mb-md-0">
                                             <label for="form-category" class="main-label investor">Veg/Non-Veg
                                                  <sup class="validationn">*</sup>
                                             </label>
                                             <div class="main-selectpicker w-100">
                                                  <select id="unit" name="unit" class="selectpicker form-control form-main VegDropDownClass" data-live-search="true" tabindex="-98" required="">
                                                       <option value="">Select Unit</option>
                                                       <option value="1">Veg</option>
                                                       <option value="2">Non-Veg</option>
                                                       <option value="3">Eggiterian</option>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="col-12 mb-4 mb-md-0">
                                             <label for="form-category" class="main-label investor">Type
                                                  <sup class="validationn">*</sup>
                                             </label>
                                             <div class="main-selectpicker w-100 option_add_select">
                                                  <select id="FoodSubTypeSelcectDiv" name="" class="selectpicker form-control FoodSubTypeSelcectDiv form-main" data-live-search="true" tabindex="-98" required="">
                                                       <?php
                                                  // $food_type = json_decode($food_type, true);

                                                       if (isset($food_type)) {
                                                            foreach ($food_type as $type_key => $type_value) {
                                                                 echo '<option value="' . $type_value["id"] . '" data-food-id="' . $type_value["id"] . '">' . $type_value["type"] . '</option>';
                                                            }
                                                       }
                                                       ?>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                         <div class="col-lg-7 col-md-4 col-12 border-start">
                              <div class="row m-0 p-0">
                                   <h6 class="col-12 mb-2">Nutrition Value</h6>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-category" class="main-label investor">Nutrition value per
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <div class="d-flex align-items-center">
                                             <div class="ps-1 w-100 pe-1">
                                                  <input type="number" class="form-control main-control DefaultQuantityInput" id="quantity" placeholder="Enter" min="1" max="1000" required>
                                             </div>
                                             <div>
                                                  <div class="main-selectpicker w-100">
                                                       <select id="unit" name="unit" data-width="fit" class="selectpicker MeasarmentMainSelectDropDown form-control form-main" data-live-search="true" tabindex="-98" required="">
                                                            <option class="GMClassDiv" value="GM">GM</option>
                                                            <option value="ML">ML</option>
                                                       </select>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Calories
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control CaloriesInputClass" placeholder="Enter Calories" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Protein
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control ProteinInputClass" placeholder="Enter Protein" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Carbs
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control CarbsInputClass" placeholder="Enter Carbs" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Fats
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control FatsInputClass" placeholder="Enter Fats" required>
                                   </div>
                                   <div class="col-lg-4 my-2 col-md-4 col-sm-6 col-12 mb-3 mt-0 mb-md-0 px-2">
                                        <label for="form-Occupation" class="main-label">Fiber
                                             <sup class="validationn">*</sup>
                                        </label>
                                        <input type="text" class="form-control main-control FiberInputClass" placeholder="Enter Fiber" required>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-body-card m-2">
                         <label for="form-category" class="main-label investor">Measarment Units
                              <sup class="validationn">*</sup>
                         </label>
                         <div class="col-12">
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="1">
                                        <span class="mx-2">Glass</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" main-control rounded-end-0 w-100 FFLargeInput1 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput1 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput1 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="2">
                                        <span class="mx-2">Cup</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput2 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput2 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>

                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput2 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="3">
                                        <span class="mx-2">Table Spoon</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput3 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput3 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput3 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="4">
                                        <span class="mx-2">Plate</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput4 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput4 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput4 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="5">
                                        <span class="mx-2">NOS</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput5 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput5 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput5 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="6">
                                        <span class="mx-2">Scoop</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput6 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput6 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput6 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="7">
                                        <span class="mx-2">Bottle</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput7 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput7 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput7 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="8">
                                        <span class="mx-2">Katori</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput8 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput8 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput8 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="9">
                                        <span class="mx-2">Bowl</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput9 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput9 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput9 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="10">
                                        <span class="mx-2">Mug</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput10 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput10 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput10 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap align-items-center py-2 check-list-js">
                                   <div class="col-md-2 d-flex flex-wrap">
                                        <input type="checkbox" class="glass-head CommenClassForMeasurement" DataId="11">
                                        <span class="mx-2">Chinese Bowl</span>
                                   </div>
                                   <div class="col-md-10 col-12 glass-menu d-none">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFLargeInput11 CommenClassSML" placeholder="Large" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFMediumInput11 CommenClassSML" placeholder="Medium" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                             <div class="col-md-4 col-12 d-flex p-1">
                                                  <input type="text" class=" w-100  main-control rounded-end-0 FFSmallInput11 CommenClassSML" placeholder="Small" required="">
                                                  <span class="input-group-text rounded-start-0 select-group d-inline-block GMandMLText" id="basic-addon2">GM</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn-primary   btn-cancel" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#subscription_delete" data-delete_id="1">Cancel</button>
                    <button class="btn-primary NewButtonFoodModelAddUpdate ButtonFoodModelAddUpdate btn-update" DataAction = "" DataMNo="<?php echo $nextAutoIncrementID; ?>" data-edit_id="" DataInsertUpdate="insert" id="save_btn" data-edit_id="" name="subscription_update" value="subscription_update">Submit</button>
               </div>
          </div>
     </div>
</div>


<div class="modal fade" id="view_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-xl">
          <form class="needs-validation" name="view_from" novalidate>
               <div class="modal-content">
                    <div class="modal-header">
                         <h1 class="modal-title">Food</h1>
                         <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal"
                              aria-label="Close">
                              <i class="bi bi-x-circle"></i>
                         </button>
                    </div>
                    <div class="modal-body modal-body-secondery">
                         <div class="modal-body-card align-items-center">
                              <div class="col-lg-2 col-12 d-flex justify-content-start">
                                   <div class="profile-photo2">
                                        <img id="img_ft" Class="ViewModelClassImaegh" src="../assets/image/sample-profile.png" width="180" alt="">
                                   </div>
                              </div>
                              <div class="col-lg-10 d-flex flex-wrap text-center col-6">
                                   <div class="profile-main col-2">
                                        <p class="fs-14">food</p>
                                        <h5 class="fw-semibold fs-14" id="view_food"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">unit</p>
                                        <h5 name="update_gender" class="fw-semibold fs-14" id="view_unit"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">quantity</p>
                                        <h5 name="update_phone_no" class="fw-semibold fs-14" id="view_quantity"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">type</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_type"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14"> food type</p>
                                        <h5 name="update_select_group" class="fw-semibold fs-14" id="view_food_type">
                                        </h5>
                                   </div>
                                   <div class="profile-main col-2">
                                  
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14"><b>small</b></p>
                                        <h5 class="fw-semibold fs-14" id="view_small"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">protein</p>
                                        <h5 class="fw-semibold fs-14" id="view_small_protein"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">carbs</p>
                                        <h5 class="fw-semibold fs-14" id="view_small_carbs"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">Fats</p>
                                        <h5 class="fw-semibold fs-14" id="view_small_fats"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">fiber</p>
                                        <h5 class="fw-semibold fs-14" id="view_small_fiber"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">Calories</p>
                                        <h5 class="fw-semibold fs-14" id="view_small_calories"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14"><b>medium</b></p>
                                        <h5 class="fw-semibold fs-14" id="view_medium"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">protein </p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_medium_protein">
                                        </h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">carbs</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_medium_carbs"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">fats</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_medium_fats"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">fiber</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_medium_fiber"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">Calories</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_medium_calories"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14"><b>large</b></p>
                                        <h5 name="update_dob" class="fw-semibold fs-14" id="view_large"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">protein</p>
                                        <h5 class="fw-semibold fs-14" id="view_large_protein"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">carbs</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_large_carbs"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">fats</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_large_fats"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">fiber</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_large_fiber"></h5>
                                   </div>
                                   <div class="profile-main col-2">
                                        <p class="fs-14">Calories</p>
                                        <h5 name="update_address" class="fw-semibold fs-14" id="view_large_calories"></h5>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <!-- <button type="button" class="btn-primary  " id="follow_up_box_btn"><i
                                   class="bi bi-person-plus"></i></button> -->
                         <div class="delete_main">
                              <button type="button" class="delete_btn_1 btn-primary w-100">Delete</button>
                              <button type="button" id="update_delete" class="btn-secondary px-3 really dlt"
                                   data-bs-dismiss="modal" data-edit_id="1">Really?</button>
                         </div>
                         <button type="button" class="btn-primary food_pencil" data-bs-toggle="modal"
                              data-bs-target="#food-1"><i class="bi bi-pencil"></i></button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div class="modal fade" id="food-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-xl modal-xl-1">
          <form class="needs-validation novalidate food_add_form" id="member_group" method="post" name="member_group"
               enctype="multipart/form-data" novalidate>
               <div class="modal-content">
                    <div class="modal-header">
                         <h1 class="modal-title FoodModelTitle">Add Food </h1>
                         <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal"
                              aria-label="Close">
                              <i class="bi bi-x-circle"></i>
                         </button>
                    </div>
                    <div class="modal-body modal-body-secondery">
                         <div class="modal-body-card">
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text">
                                   <label for="form-Occupation" class="main-label investor">Food <sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="food"
                                        placeholder="Enter Food" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text">
                                   <label for="form-category" class="main-label investor">Unit<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <div class="add-user-input">
                                        <div class="d-flex main-form main-controll p-0">
                                             <div class="main-selectpicker w-100">
                                                  <select id="unit" name="unit"
                                                       class="selectpicker form-control form-main place"
                                                       data-live-search="true" tabindex="-98" required="">
                                                       <option class="dropdown-item" value="">Select Unit</option>
                                                       <option class="dropdown-item">GM </option>
                                                       <option class="dropdown-item">ML </option>
                                                       <option class="dropdown-item">NOS </option>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text">
                                   <label for="form-category" class="main-label investor">Quantity<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="number" class="form-control main-control place" id="quantity"
                                        placeholder="Enter Quantity" min="1" max="1000" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text">
                                   <label for="form-category" class="main-label investor">Type<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <div class="add-user-input">
                                        <div class="d-flex main-form main-controll p-0">
                                             <div class="main-selectpicker w-100">
                                                  <select id="type" name="type"
                                                       class="selectpicker form-control form-main place"
                                                       data-live-search="true" tabindex="-98" required="">
                                                       <option class="dropdown-item" value=""> Type</option>
                                                       <option class="dropdown-item">Veg</option>
                                                       <option class="dropdown-item">Non-Veg</option>
                                                       <option class="dropdown-item">Eggiterian</option>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text">
                                   <label for="form-category" class="main-label investor"> Food Type<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <div class="add-user-input">
                                        <div class="d-flex main-form main-controll p-0">
                                             <div class="main-selectpicker w-100">
                                                  <div class="DoupDownMenuExercisetypeClass">
                                                       <select id="food_type" name="food_type"
                                                            class="selectpicker FoodTypeInputClass form-control form-main place"
                                                            data-live-search="true" tabindex="-98" required="">
                                                            <option class="dropdown-item" data-food-id="" value=""
                                                                 selected="">Food Type</option>
                                                            <?php
                                                            // $food_type = json_decode($food_type, true);
                                                            if (isset($food_type)) {
                                                                 foreach ($food_type as $type_key => $type_value) {
                                                                      echo '<option class="dropdown-item" value="' . $type_value["id"] . '"data-food-id="' . $type_value["id"] . '">' . $type_value["type"] . '</option>';

                                                                 }
                                                            }
                                                            ?>
                                                       </select>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0"></div>
                              <!-- small -->
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Small<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="small"
                                        placeholder="Enter Small Quantity Gm" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Protein<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="small_protein"
                                        placeholder="Enter Protein Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Carbs<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="small_carbs"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Fats<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="small_fats"
                                        placeholder="Enter Fats Quantity" required>
                              </div>
                              
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Fiber<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="small_fiber"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>

                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Calories<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="small_calories"
                                        placeholder="Enter Fats Quantity" required>
                              </div>
                              
                              <!-- Medium -->
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Medium<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="medium"
                                        placeholder="Enter Medium Quantity Gm" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Protein<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="medium_protein"
                                        placeholder="Enter Protein Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Carbs<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="medium_carbs"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Fats<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="medium_fats"
                                        placeholder="Enter Fats Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Fiber<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="medium_fiber"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Calories<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="medium_calories"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>
                              <!-- Large -->
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Large<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="large"
                                        placeholder="Enter Large Quantity Gm" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Protein<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="large_protein"
                                        placeholder="Enter Protein Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Carbs<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="large_carbs"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Fats<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="large_fats"
                                        placeholder="Enter Fats Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Fiber<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="large_fiber"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>
                              <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text mt-2">
                                   <label for="form-category" class="main-label investor">Calories<sup
                                             class="validationn">*</sup>
                                   </label>
                                   <input type="text" class="form-control main-control place" id="large_calories"
                                        placeholder="Enter Carbs Quantity" required>
                              </div>
                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4 mb-md-0 input-text">
                                   <label for="form-category" class="main-label investor">Image
                                   </label>
                                   <input type="file" name="image[]"  class="form-control main-control place" id="image">
                                   <img src="" alt="" id="img_food" name="" width="100px" required=""
                                        class=".food_viewImage">
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn-primary   btn-cancel" data-bs-dismiss="modal"
                              data-bs-toggle="modal" data-bs-target="#subscription_delete"
                              data-delete_id="1">Cancel</button>
                         <button class="btn-primary  ButtonFoodModelAddUpdate btn-update" id="save_btn" data-edit_id=""
                              name="subscription_update" value="subscription_update">Submit</button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="f_food" aria-labelledby="offcanvasRightLabel">
     <form method="post" class="d-flex flex-column h-100" name="filter_form">
          <div class="offcanvas-header">
               <h5 id="offcanvas-title" class="filtersTitle" style="color: #fff">Filter</h5>
               <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
          </div>
          <div class="offcanvas-body filter_data">
               <div class="col-lg-12 mb-3 ">
                    <input type="number" class="form-control main-control place" id="f_id" name="f_id"
                         placeholder="Enter id ">
               </div>
               <div class="col-lg-12 mb-3 ">
                    <input type="text" class="form-control main-control place f_food" id="f_food" name="f_food"
                         placeholder="Enter Food Name">
               </div>
               <div class="col-lg-12 mb-3 ">
                    <div class="main-selectpicker">
                         <select name="f_unit" id="f_unit" multiple
                              class="multiple-select selectpicker  form-control main-control funit"
                              data-live-search="true" required="" tabindex="-98">
                              <option class="dropdown-item" disabled value="" style="display:none" selected>Select Unit
                              </option>
                              <option class="dropdown-item" value='GM'>GM</option>
                              <option class="dropdown-item" value='ML'>ML</option>
                              <option class="dropdown-item" value='NOS'>NOS</option>
                         </select>
                    </div>
               </div>
               <div class="col-lg-12 mb-3 ">
                    <div class="main-selectpicker">
                         <select name="f_type" id="f_type" multiple
                              class="multiple-select selectpicker  form-control main-control F_type"
                              data-live-search="true" required="" tabindex="-98">
                              <option class="dropdown-item" disabled value="" style="display:none" selected>Select type
                              </option>
                              <option class="dropdown-item" value='Veg'>Veg</option>
                              <option class="dropdown-item" value='Non-Veg'>Non-Veg</option>
                              <option class="dropdown-item" value='Eggiterian'>Eggiterian</option>
                         </select>
                    </div>
               </div>
               <div class="col-lg-12 mb-3 ">
                    <div class="add-user-input">
                         <div class="d-flex main-form main-controll p-0">
                              <div class="main-selectpicker w-100">
                                   <select id="f_food_type" name="f_food_type"
                                        class="selectpicker form-control form-main place" data-live-search="true"
                                        tabindex="-98" required="">
                                        <option class="dropdown-item" data-food-id="" value=""> Food Type</option>
                                        <?php
                                        if (isset($food_type)) {
                                             foreach ($food_type as $type_key => $type_value) {

                                                  echo '<option class="dropdown-item" value="' . $type_value["type"] . '"data-food-id="' . $type_value["id"] . '">' . $type_value["type"] . '</option>';
                                             }


                                        }
                                        ?>
                                   </select>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </form>
</div>

<div class="modal fade  " id="food-type-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <form class="needs-validation inquirytypeDiv" name="occupation_form" method="POST" novalidate>
                    <div class="modal-header">
                         <h1 class="modal-title ">Add Food</h1>
                         <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal"
                              aria-label="Close">
                              <i class="bi bi-x-circle"></i>
                         </button>
                    </div>
                    <div class="modal-body modal-body-secondery">
                         <div class="modal-body-card">
                              <div class="col-sm-6 col-12 mb-4 ">
                                   <label for="form-Occupation" class="main-label investor">Type<sup
                                             class="validationn">*</sup></label>
                                   <input type="text" id="type" class="form-control main-control place"
                                        placeholder="Enter Food Type" required="">
                              </div>
                         </div>
                    </div>

                    <div class="modal-footer">
                         <div class="delete_main">
                              <button type="button" class="delete_btn_1 btn-primary w-100">Delete</button>
                              <button type="button" data-delete_id="" id="inquiry_delete_btn"
                                   class="btn-secondary px-3 really dlt" data-bs-dismiss="modal">Really?</button>
                         </div>
                         <button type="button" id="inquiry_update_btn" class="btn-primary UpdateBtnDiv">Update</button>

                         <button type="button" id="cancel" class="btn-primary CancleBtn" data-bs-dismiss="modal"
                              data-bs-toggle="modal" data-bs-target="#subscription_delete"
                              data-delete_id="1">cancel</button>

                         <button class="btn-primary SaveBtnDiv " id="inquiry_add_btn" data-edit_id=""
                              name="subscription_Submit" value="subscription_Submit">Add</button>

                    </div>
               </form>
          </div>
     </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="f_food" aria-labelledby="offcanvasRightLabel">
     <form method="post" class="d-flex flex-column h-100">
          <div class="offcanvas-header bg-pink">
               <h5 id="offcanvas-title" style="color: #fff">Filter</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body filter_data">
               <div class="input-text col-lg-12 mb-3 mb-md-0 ">
                    <input type="text" class="form-control main-control place" id="f_name"
                         placeholder="Enter id,Name or contact">
               </div>

          </div>
     </form>
</div>

<input type="text" hidden value="food" class="table_value_picker"
     id="table_value_picker" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>



<script>
     // $(document).ready(function () {
     //      $('.food-table').DataTable();
     // });
</script>
<script>
     $(".FoodSubTypeSelcectDiv .item_name_modal_ul li").addClass("");
     $(document).ready(function () {

          if ($("#filter-showw").html() == "") {
               $('#clear').hide();
          }
          $('#clear').hide();
          $('#filter-btn').click(function () {
               $('#clear').hide();
          });


          var fileter = true;
          $(".filter_data input,.filter_data select").change(function () {
               $('#clear').show();
               $(".filtersTitle").trigger("click");
          });
          $('#clear').hide();
          $("#clear").click(function () {
               $(".filter-show").html("");
               $('#clear').hide();
               $('.filter_data input').val("");
               $('.filter_data select').val("");
               $('.filter-main').css('margin', '0px');
               $('.selectpicker').selectpicker('refresh');
               $(".filtersTitle").trigger("click");
               return false;
          });
          $("#filter-showw").click(function () {
               $(".filter-show").html("");
               $('#clear').hide();
               $('.filter_data input').val("");
               $('.filter_data select').val("");
               $('.filter-main').css('margin', '0px');
               $('.selectpicker').selectpicker('refresh');
               $(".filtersTitle").trigger("click");
               return false;
          });
          
          $("#clear").on('click', function () {
               list_data("<?= site_url('food_list_data_new'); ?>");
          });
          $("#filter-showw").on('click', function () {
               $('#clear').hide();
               list_data("<?= site_url('food_list_data_new'); ?>");
          });

          $('body').on('click', '#filter-showw p', function () {
               if ($(".filter-show").html() != "") {
                    var form = $("form[name='filter_form']")[0];
                    var formdata = new FormData(form);
                    formdata.append('action', 'filter');
                    formdata.append('table', 'food');
               } else {
                    formdata = '';
               }
               list_data("<?= site_url('food_list_data_new'); ?>");
          });
          $(".filter_data input, .filter_data select").change(function () {
               var form = $("form[name='filter_form']")[0];
               var formdata = new FormData(form);
               formdata.append('action', 'filter');
               if ($(".filter-show").html() != "") {
                    var form = $("form[name='filter_form']")[0];
                    var formdata = new FormData(form);
                    formdata.append('action', 'filter');
                    formdata.append('table', 'food');
               } else {
                    formdata = '';
               }
               // console.log(formdata);
               list_data("<?= site_url('food_list_data_new'); ?>");
          });


          function applyFilter() {
               var form = $("form[name='filter_form']")[0];
               var formdata = new FormData(form);
               formdata.append('action', 'filter');
               formdata.append('table', 'food');
               var show_val = '<?= json_encode(
                    array(
                         'food',
                         'unit',
                         'quantity',
                         'type',
                         'small',
                         'small_protein',
                         'small_carbs',
                         'small_fats',
                         'small_fiber',
                         'medium',
                         'medium_protein',
                         'medium_carbs',
                         'medium_fats',
                         'medium_fiber',
                         'large',
                         'large_protein',
                         'large_carbs',
                         'large_fats',
                         'large_fiber',
                         'food_type',
                         'image'
                    )
               ); ?>';

               $.ajax({
                    datatype: 'json',
                    method: "post",
                    url: "<?= site_url('food_list_data_new'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                         $('.loader').hide();
                         datatable_view(res)
                    }
               });
          }

          function applyFilter() {
               var form = $("form[name='filter_form']")[0];
               var formdata = new FormData(form);
               formdata.append('action', 'filter');
               formdata.append('table', 'food');
               var show_val = '<?= json_encode(
                    array(
                         'food',
                         'unit',
                         'quantity',
                         'type',
                         'small',
                         'small_protein',
                         'small_carbs',
                         'small_fats',
                         'small_fiber',
                         'medium',
                         'medium_protein',
                         'medium_carbs',
                         'medium_fats',
                         'medium_fiber',
                         'large',
                         'large_protein',
                         'large_carbs',
                         'large_fats',
                         'large_fiber',
                         'food_type',
                         'image'
                    )
               ); ?>';

               $.ajax({
                    datatype: 'json',
                    method: "post",
                    url: "<?= site_url('food_list_request'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                         $('.loader').hide();
                         datatable_view(res)
                    }
               });
          }

          $('body').on("click", "#filter_diet", function () {
               $('.loader').show();
               applyFilter();
          });

          $(".filter_data input, .filter_data select").change(function () {
               $('.loader').show();
               applyFilter();
          });
     });
</script>
<script>
     const buttons = document.querySelectorAll(".nav-link");
     buttons.forEach(button => {
          button.addEventListener("click", function () {
               buttons.forEach(btn => {
                    btn.classList.remove("active");
               });
               button.classList.add("active");
               if (button.id === "pills-food-master") {
                    var table_name = $(this).attr("data-table");
                    $("#table_value_picker").val(table_name);
               } else if (button.id === "pills-food-type") {
                    var table_name = $(this).attr("data-table");
                    $("#table_value_picker").val(table_name);
               }else if (button.id === "pills-food-request") {
                    var table_name = $(this).attr("data-table");
                    $("#table_value_picker").val(table_name);
               }
          });
     });


     // function datatable_view(html) {
     //      var response = JSON.parse(html);
     //      // $('.comman_list_data_table').DataTable().destroy();
     //      $('.food_list_comman').html(response.html);
     //      // var table1 = $('.comman_list_data_table').DataTable({
     //      //      lengthChange: true,
     //      // });
     // }


     var defaultTable = $(".table_value_picker").val();
     // console.log(url);
     function list_data(url, table = defaultTable, pageNumber = 1, perPageCount = 10, formdata = "", action = true) {
          // console.log(url);
          $('.loader').show();
          show_val = '<?= json_encode(
               array(
                    'food',
                    'unit',
                    'quantity',
                    'type',
                    'small',
                    'small_protein',
                    'small_carbs',
                    'small_fats',
                    'small_fiber',
                    'medium',
                    'medium_protein',
                    'medium_carbs',
                    'medium_fats',
                    'medium_fiber',
                    'large',
                    'large_protein',
                    'large_carbs',
                    'large_fats',
                    'large_fiber',
                    'food_type',
                    'image'
               )
          ); ?>';
          var table = $(".table_value_picker").val();
          perPageCount = $('#project_length_show').val();

          if ($.trim($(".filter-show").html()) == '') {
          var data = {
               'table': table,
               'pageNumber': pageNumber,
               'perPageCount': perPageCount,
               'show_array': show_val,       
               'action': action,
          }
         
          var processdd = true;
          var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
          } else {
               var formdata = new FormData();
               formdata.append('action', action);
               formdata.append('table', table);
               formdata.append('ListDataStatus', DataStatus);

               var data = formdata;
               var processdd = false;
               var contentType = false;
          }
        
          $.ajax({
               datatype: 'json',
               method: "post",
               url: url,
               data: data,
               processData: processdd,
               contentType: contentType,
               success: function (res) {
                    $('.loader').hide();
                    var response = JSON.parse(res);
                    // console.log(response);
                    if (response.response == 1) {
                         $('.food_list_comman').html(response.html);

                         if (response.total_page == 0 || response.total_page == '') {
                              total_page = 1;
                         } else {
                              total_page = response.total_page;
                         }
                         $('.row_count_div').html(response.row_count_html);

                         if (response.ftype != '') {
                              $('.DoupDownMenuExercisetypeClass').html(response.ftype);
                         }

                         $('.member_pagination').twbsPagination({
                              totalPages: total_page,
                              visiblePages: 2,
                              next: '>>',
                              prev: '<<',
                              onPageClick: function(event, page) {
                                   list_data(url,table, page, perPageCount);
                                   // console.log(perPageCount);
                              }
                         });

                    }
               }
          });
          <?php if (isset($_GET) && !empty($_GET)) { ?>
               <?php if (isset($_GET['action']) && ($_GET['action'] == 'filter')) { ?>
                    $('.member_pagination').twbsPagination('destroy');
               <?php } ?>
          <?php } ?>
     }


     list_data("<?= site_url('food_list_data_new'); ?>");
     $('body').on("click", "#pills-food-master", function () {
          $('.member_pagination').twbsPagination('destroy');
          list_data("<?= site_url('ftype_list_data'); ?>");
     });

     $('body').on("click", "#pills-food-type", function () {
          $('.member_pagination').twbsPagination('destroy');
          list_data("<?= site_url('food_list_data_new'); ?>");
     });

     $('body').on("click", "#pills-food-request", function () {
          $('.member_pagination').twbsPagination('destroy');
          list_data("<?= site_url('food_list_request'); ?>");
     });


     //pagination show records
     $('body').on('change', '#project_length_show', function() {
          var perPageCount = $(this).val();

          var DataStatus = $(".table_value_picker").val();
          $('.member_pagination').twbsPagination('destroy');
          
          if (DataStatus == "food") {
               url = "<?= site_url('food_list_data_new'); ?>";
          } else if (DataStatus == "_food_type") {
               url = "<?= site_url('ftype_list_data'); ?>";
          } else {
               url = "<?= site_url('food_list_request'); ?>";
          }

          list_data(url, DataStatus, 1, perPageCount);
     });


     //pagination search
     $('#project_filter input[type="search"]').on('input', function() {
          var input = $(this).val().toLowerCase();
          var table = $('.comman_list_data_table');
          var rows = table.find('tbody tr');
          rows.each(function() {
               var cells = $(this).find('td');
               var match = false;
               cells.each(function() {
                    var cellText = $(this).text().toLowerCase();
                    if (cellText.indexOf(input) > -1) {
                         match = true;
                         return false; // Exit the inner loop
                    }
               });
               $(this).toggle(match);
          });
     });


     // function datatable_view(html) {
     //      //table id
     //      $('#table').DataTable().destroy();
     //      $('#show_list').html(html);
     //      var table1 = $('#table').DataTable({
     //           lengthChange: true,
     //      });
     // }
     // function list_data() {
     //      //table fild name------------------ aaya niche
     //      var food = $('.f_food').val();
     //      var F_unit = '';
     //      $('#f_unit :selected').each(function () {
     //           if (F_unit !== "") {
     //                F_unit += ",";
     //           }
     //           F_unit += $(this).val();
     //      });
     //      var F_type = '';
     //      $('.F_type :selected').each(function () {
     //           if (F_type !== "") {
     //                F_type += ",";
     //           }
     //           F_type += $(this).val();
     //      });
     //      show_val ='
     //           array(
     //                'food',
     //                'unit',
     //                'quantity',
     //                'type',
     //                'small',
     //                'small_protein',
     //                'small_carbs',
     //                'small_fats',
     //                'small_fiber',
     //                'medium',
     //                'medium_protein',
     //                'medium_carbs',
     //                'medium_fats',
     //                'medium_fiber',
     //                'large',
     //                'large_protein',
     //                'large_carbs',
     //                'large_fats',
     //                'large_fiber',
     //                'food_type',
     //                'image',
     //           )
     //      ); ?>';
     //      $('.loader').hide();
     //      var table = '';
     //      $.ajax({
     //           datatype: 'json',
     //           method: "post",
     //           url: "",
     //           data: {
     //                'table': table,
     //                'show_array': show_val,
     //                'action': true,
     //                food: food,
     //                F_unit: F_unit,
     //                F_type: F_type,
     //           },
     //           success: function (res) {
     //                $('.loader').hide();
     //                datatable_view(res);
     //                //$('#table').html(res);
     //           }
     //      });
     // }
     // list_data();
     // $('body').on('click', '.filtersTitle', function () {
     //      list_data();
     // });
     $('#plus_btn').click(function (e) {
          // alert("d");
          $("form[name='member_group']")[0].reset();
          $('.selectpicker').selectpicker('refresh');
          $(".selectpicker-validation").removeClass("selectpicker-validation");
          $("form[name='member_group']").removeClass("was-validated");
          $("button#save_btn").attr("data-edit_id", "");
          $('.FoodModelTitle').text('Add Food');
          $('.ButtonFoodModelAddUpdate').text('Add');
          $('#img_food').hide();
          
     });
     $('body').on('click', '.edt', function (e) {
          $('#img_food').show();
     });

     //insert
     $("#save_btn").click(function (e) {
          e.preventDefault();
          var form = $("form[name='member_group']")[0];
          var food = $('#food').val();
          var table = 'master_food';
          var image = $('#image').prop('files')[0];
          var unit = $('#unit').val();
          var quantity = $('#quantity').val();
          var type = $('#type').val();

          var small = $('#small').val();
          var small_protein = $('#small_protein').val();
          var small_carbs = $('#small_carbs').val();
          var small_fats = $('#small_fats').val();
          var small_fiber = $('#small_fiber').val();
          var small_calories = $('#small_calories').val();
          var medium = $('#medium').val();
          var medium_protein = $('#medium_protein').val();
          var medium_carbs = $('#medium_carbs').val();
          var medium_fats = $('#medium_fats').val();
          var medium_fiber = $('#medium_fiber').val();
          var medium_calories = $('#medium_calories').val();
          var large = $('#large').val();
          var large_protein = $('#large_protein').val()
          var large_carbs = $('#large_carbs').val();
          var large_fats = $('#large_fats').val();
          var large_fiber = $('#large_fiber').val();
          var large_calories = $('#large_calories').val();
          // var food_type = $('#food_type').val();
          var Ftype_id = $('#food_type option:selected').attr('data-food-id');

          var formdata = new FormData(form);
          var edit_id = $('#save_btn').attr("data-edit_id");
          // console.log(Ftype_id);
          if (food != "" && unit != "" && quantity != "" && type != "" && small != "" && small_protein != "" && small_carbs != "" &&
               small_fats != "" && small_fiber != "" && small_calories != "" && medium != "" && medium_protein != "" && medium_carbs != "" && medium_fats != "" &&
               medium_fiber != "" && medium_calories != "" && large != "" && large_protein != "" && large_carbs != "" && large_fats != "" && large_fiber != "" &&
               large_calories != "" && Ftype_id != "" && type != "") {
               var formdata = new FormData(form);
               formdata.append('action', 'insert');
               formdata.append('food', food,);
               formdata.append('unit', unit,);
               formdata.append('quantity', quantity,);
               formdata.append('type', type,);
               formdata.append('small', small,);
               formdata.append('small_protein', small_protein,);
               formdata.append('small_carbs', small_carbs,);
               formdata.append('small_fats', small_fats,);
               formdata.append('small_fiber', small_fiber,);
               formdata.append('small_calories', small_calories,);
               formdata.append('medium', medium,);
               formdata.append('medium_protein', medium_protein,);
               formdata.append('medium_carbs', medium_carbs,);
               formdata.append('medium_fats', medium_fats,);
               formdata.append('medium_fiber', medium_fiber,);
               formdata.append('medium_calories', medium_calories,);
               formdata.append('large', large,);
               formdata.append('large_protein', large_protein,);
               formdata.append('large_carbs', large_carbs,);
               formdata.append('large_fats', large_fats,);
               formdata.append('large_fiber', large_fiber,);
               formdata.append('large_calories', large_calories,);
               formdata.append('food_type', Ftype_id,);
               formdata.append('type', type,);
               formdata.append('table', table);
               if (edit_id == '') {
                    $('.loader').show();
                    $.ajax({
                         method: "post",
                         url: "<?= site_url('food_master_insert_data'); ?>",
                         data: formdata,
                         processData: false,
                         contentType: false,
                         success: function (data) {
                              console.log(data);
                              if (data != "error") {
                                   $("form[name='member_group']")[0].reset();
                                   $(".btn-cancel").trigger("click");
                                   $("form[name='member_group']").removeClass("was-validated");
                                  
                                   list_data("<?= site_url('food_list_data_new'); ?>");
                                   iziToast.success({
                                        title: 'Added Successfully'
                                   });
                                   $('.loader').hide();
                              } else {
                                   $('.loader').hide();
                                   $("form[name='member_group']")[0].reset();
                                   iziToast.error({
                                        title: 'Duplicate data'
                                   });
                                   $("form[name='member_group']").addClass("was-validated");
                              }
                         },
                    });
               } else {
                    var formdata = new FormData(form);
                    formdata.append('action', 'update');
                    formdata.append('edit_id', edit_id);
                    formdata.append('table', table);
                    formdata.append('food', food,);
                    formdata.append('unit', unit,);
                    formdata.append('quantity', quantity,);
                    formdata.append('type', type,);
                    formdata.append('small', small,);
                    formdata.append('small_protein', small_protein,);
                    formdata.append('small_carbs', small_carbs,);
                    formdata.append('small_fats', small_fats,);
                    formdata.append('small_fiber', small_fiber,);
                    formdata.append('small_calories', small_calories,);
                    formdata.append('medium', medium,);
                    formdata.append('medium_protein', medium_protein,);
                    formdata.append('medium_carbs', medium_carbs,);
                    formdata.append('medium_fats', medium_fats,);
                    formdata.append('medium_fiber', medium_fiber,);
                    formdata.append('medium_calories', medium_calories,);
                    formdata.append('large', large,);
                    formdata.append('large_protein', large_protein,);
                    formdata.append('large_carbs', large_carbs,);
                    formdata.append('large_fats', large_fats,);
                    formdata.append('large_fiber', large_fiber,);
                    formdata.append('large_calories', large_calories,);
                    formdata.append('food_type', Ftype_id,);
                    $('.loader').show();
                    $.ajax({
                         method: "POST",
                         url: "<?= site_url('food_master_update_data'); ?>",
                         data: formdata,
                         processData: false,
                         contentType: false,
                         success: function (data) {
                              if (data != "error") {
                                   $("form[name='member_group']")[0].reset();
                                   $("form[name='member_group']").removeClass("was-validated");
                                   $(".btn-cancel").trigger("click");
                                   iziToast.success({
                                        title: 'update Successfully'
                                   });
                                   list_data("<?= site_url('food_list_data_new'); ?>");
                                   $('.loader').hide();
                              }
                              else {
                                   // alert("hello");
                                   $('.loader').hide();
                                   $("form[name='member_group']")[0].reset();
                                   iziToast.error({
                                        title: 'Duplicate data'
                                   });
                              }
                         }
                    });
               }
               } else {
                    $("form[name='member_group']").addClass("was-validated");
                    $("form[name='member_group']").find('.selectpicker').each(function () {
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
     });


     //edit
     $('body').on('click', '.edit', function (e) {
          // alert("hello i m  edit");
          e.preventDefault();
          var table = 'master_food';
          var self = $(this).closest("tr");
          var edit_value = $(this).attr("data-edit_id");
          // console.log(edit_value);
          if (edit_value != "") {
               $('.loader').hide();
               $.ajax({
                    type: "post",
                    url: "<?= site_url('edit_data2'); ?>",
                    data: {
                         action: 'edit',
                         edit_id: edit_value,
                         table: table
                    },
                    success: function (res) {
                         $('.loader').hide();
                         var response = JSON.parse(res);
                         // console.log(response);
                         var img_name = response[0].image;
                         if (img_name != '' && img_name != 'undefined') {
                              var img_name1 = response[0].image;
                         } else {
                              var img_name1 = 'food_image.jpg';
                         }
                         var img_path = '<?= site_url('assets/images/food_type/'); ?>';
                         // console.log(img_path);
                         $("form[name='member_group'] #food").val(response[0].food);
                         $("form[name='member_group'] #unit").val(response[0].unit);
                         $("form[name='member_group'] #quantity").val(response[0].quantity);
                         $("form[name='member_group'] #type").val(response[0].type);
                         $("form[name='member_group'] #small").val(response[0].small);
                         $("form[name='member_group'] #small_protein").val(response[0].small_protein);
                         $("form[name='member_group'] #small_carbs").val(response[0].small_carbs);
                         $("form[name='member_group'] #small_fats").val(response[0].small_fats);
                         $("form[name='member_group'] #small_fiber").val(response[0].small_fiber);
                         $("form[name='member_group'] #small_calories").val(response[0].small_calories);
                         $("form[name='member_group'] #medium").val(response[0].medium);
                         $("form[name='member_group'] #medium_protein").val(response[0].medium_protein);
                         $("form[name='member_group'] #medium_carbs").val(response[0].medium_carbs);
                         $("form[name='member_group'] #medium_fats").val(response[0].medium_fats);
                         $("form[name='member_group'] #medium_fiber").val(response[0].medium_fiber);
                         $("form[name='member_group'] #medium_calories").val(response[0].medium_calories);
                         $("form[name='member_group'] #large").val(response[0].large);
                         $("form[name='member_group'] #large_protein").val(response[0].large_protein);
                         $("form[name='member_group'] #large_carbs").val(response[0].large_carbs);
                         $("form[name='member_group'] #large_fats").val(response[0].large_fats);
                         $("form[name='member_group'] #large_fiber").val(response[0].large_fiber);
                         $("form[name='member_group'] #food_type").val(response[0].food_type);
                         $("form[name='member_group'] #large_calories").val(response[0].large_calories);
                         $('.selectpicker').selectpicker('refresh');
                         //image edit
                         $("form[name='member_group'] .food_viewImage").attr('src', img_path + img_name1);
                         //image edit
                         $("form[name='member_group'] #save_btn").attr('data-edit_id', response[0].id);
                         $("#update_delete").attr('data-edit_id', response[0].id);
                    },
                    error: function (error) {
                         $('.loader').hide();
                    }
               });
          }
     });

     // view edit code 
     $('body').on('click', '.food_view', function (e) {
          // alert("hello i m  edit");
          // $('.FoodTypeInputClass').selectpicker('refresh');
          // $('#food_type').val('');
          var DataImageSrc = $(this).attr('DataImageSrc');
          $(".ViewModelClassImaegh").attr('src', DataImageSrc);

          e.preventDefault();
          var table = 'master_food';
          var self = $(this).closest("tr");
          var edit_value = $(this).attr("data-view_id");
          //  console.log(edit_value);
          if (edit_value != "") {
               $('.loader').hide();
               $.ajax({
                    type: "post",
                    url: "<?= site_url('food_view'); ?>",
                    data: {
                         action: 'view',
                         view_id: edit_value,
                         table: table
                    },
                    success: function (res) {
                         $('.loader').hide();
                         var response = JSON.parse(res);
                         var img_name = response[0].image;
                         if (img_name != '' && img_name != 'undefined') {
                              var img_name = response[0].image;
                         } else {
                              var img_name = 'food_image.jpg';
                         }
                         var img_path = '<?= site_url('assets/images/food_type/'); ?>';

                         $("form[name='view_from'] #view_food").text(response[0].food);
                         $("form[name='view_from'] #view_unit").text(response[0].unit);
                         $("form[name='view_from'] #view_quantity").text(response[0].quantity);
                         $("form[name='view_from'] #view_type").text(response[0].type);
                         $("form[name='view_from'] #view_small").text(response[0].small);
                         $("form[name='view_from'] #view_small_protein").text(response[0].small_protein);
                         $("form[name='view_from'] #view_small_carbs").text(response[0].small_carbs);
                         $("form[name='view_from'] #view_small_fats").text(response[0].small_fats);
                         $("form[name='view_from'] #view_small_fiber").text(response[0].small_fiber);
                         $("form[name='view_from'] #view_small_calories").text(response[0].small_calories);
                         $("form[name='view_from'] #view_medium").text(response[0].medium);
                         $("form[name='view_from'] #view_medium_protein").text(response[0].medium_protein);
                         $("form[name='view_from'] #view_medium_carbs").text(response[0].medium_carbs);
                         $("form[name='view_from'] #view_medium_fats").text(response[0].medium_fats);
                         $("form[name='view_from'] #view_medium_fiber").text(response[0].medium_fiber);
                         $("form[name='view_from'] #view_medium_calories").text(response[0].medium_calories);
                         $("form[name='view_from'] #view_large").text(response[0].large);
                         $("form[name='view_from'] #view_large_protein").text(response[0].large_protein);
                         $("form[name='view_from'] #view_large_carbs").text(response[0].large_carbs);
                         $("form[name='view_from'] #view_large_fats").text(response[0].large_fats);
                         $("form[name='view_from'] #view_large_fiber").text(response[0].large_fiber);
                         $("form[name='view_from'] #view_large_calories").text(response[0].large_calories);
                         $("form[name='view_from'] #view_food_type").text(response[0].food_type);
                         $('.FoodTypeInputClass').val(response[0].food_type);

                         console.log(response[0].food_type);
                         $("form[name='view_from'] #img_ft").attr('src', img_path + img_name);
                         $("form[name='view_from'] #dlt_main").attr('data-delete_id', response[0].id);
                         // $('.FoodTypeInputClass').selectpicker('refresh');

                    },
                    error: function (error) {
                         $('.loader').hide();
                    }
               });
          }
     });


    
               
    





     // delete code
     $('body').on('click', '#update_delete', function () {
          var id = $(this).attr("data-edit_id");
          console.log(id);
          var table = 'master_food';
          $.ajax({
               method: "post",
               url: "<?= site_url('delete_data_secound_db'); ?>",
               data: {
                    action: 'delete',
                    id: id,
                    table: table
               },
               success: function (data) {
                    $(".btn-cancel").trigger("click");
                    list_data("<?= site_url('food_list_data_new'); ?>");
                    // iziToast.error({
                    //      title: 'Deleted Successfully'
                    // });
               }
          });
     });

</script>

<script>
     // var checkboxes = document.querySelectorAll('.checkbox');
     // var count = 0;
     // document.getElementById('tb-check').onclick = function () {
     //      for (var checkbox of checkboxes) {
     //           checkbox.checked = this.checked;
     //           if (checkbox.checked == true) {
     //                count++;
     //                document.getElementById('#chec_select').innerHTML = count;
     //           } else {

     //           }
     //      }
     // }

</script>
<script>
     var checkboxes = document.getElementsByClassName('cstm-check');
     var selectedCountSpan = document.getElementById('chec_select');

     function updateSelectedCount() {
          var selectedCount = 0;

          for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].checked) {
                    selectedCount++;
               }
          }

          selectedCountSpan.textContent = selectedCount;
     }

     for (var i = 0; i < checkboxes.length; i++) {
          checkboxes[i].addEventListener('change', updateSelectedCount);
     }

</script>
<script>


     $('body').on('click', '.plus_btn', function () {
          $('.modal-title').text('Add Food');
          $('.delete_main').hide();
          $('.CancleBtn').show();
          $('.UpdateBtnDiv').hide();
          $('.SaveBtnDiv').show();
          $("form[name='occupation_form']")[0].reset();
          $("form[name='occupation_form']").removeClass("was-validated");

     });

     $('body').on('click', '.food_pencil', function () {
          $('.modal-title ').text('Edit Food');
          $('#save_btn').text('Update');
     });

     $('body').on('click', '.edt', function () {
          $('.modal-title ').text('Edit Food');
          $('.delete_main').show();
          $('.CancleBtn').hide();
          $('.UpdateBtnDiv').show();
          $('.SaveBtnDiv').hide();
     });

</script>
<script>
     // $(document).ready(function () {
     //      $('.food-type-table').DataTable();
     // });


     $(document).ready(function () {

          $('#plus_btn').click(function (e) {
               // alert("d");
               $("form[name='occupation_form']")[0].reset();
               $('.selectpicker').selectpicker('refresh');
               $("form[name='occupation_form']").removeClass("was-validated");
               <?php
               // $table_name = $table_username . '_food_type';
               // $columns = [
               //      'id int primary key AUTO_INCREMENT',
               //      'type varchar(500) NOT NULL',
               // ];
               // $table = tableCreateAndTableUpdate($table_name, '', $columns);
               ?>
          });


          //insert 
          $("#inquiry_add_btn").click(function (e) {
               // alert("dfe");
               e.preventDefault();
               var form = $("form[name='occupation_form']")[0];
               var type = $('form[name="occupation_form"] #type').val();
               var edit_id = $('#inquiry_add_btn').attr("data-edit_id");
               var table = 'master_food_type';
               // console.log(type);
               if (type != "") {
                    var form = $('form[name="occupation_form"]')[0];
                    var formdata = new FormData(form);
                    formdata.append('table', table);
                    formdata.append('type', type);
                    formdata.append('action', 'insert');
                    if (edit_id == '') {
                         $.ajax({
                              method: "post",
                              url: "<?= site_url('insert_data_2DB'); ?>",
                              data: formdata,
                              processData: false,
                              contentType: false,
                              success: function (res) {
                                   if (res == 0) {
                                        list_data("<?= site_url('ftype_list_data'); ?>");
                                        $("form[name='occupation_form']")[0].reset();
                                        $(".modal-close-btn").trigger("click");
                                        $("form[name='occupation_form']").removeClass("was-validated");
                                        iziToast.success({
                                             title: 'Added Successfully'
                                        });
                                        $('.selectpicker').selectpicker('refresh');
                                   } else {
                                        //alert("this");
                                        $("form[name='occupation_form']")[0].reset();
                                        $(".modal-close-btn").trigger("click");
                                        iziToast.error({
                                             title: 'Duplicate data'
                                        });
                                        $("form[name='occupation_form']").addClass("was-validated");
                                   }
                              },
                         });
                    }
               } else {
                    $("form[name='occupation_form']").addClass("was-validated");
               }
          });


          //edit 
          $("body").on('click', '.edt', function (e) {
               //alert("hello i m  edit");   
               e.preventDefault();
               var self = $(this).closest("tr");
               var edit_value = $(this).attr("data-edit_id");
               // console.log(edit_value);

               var table = 'master_food_type';

               if (edit_value != "") {
                    $('.loader').hide();
                    $.ajax({
                         type: "post",
                         url: "<?= site_url('edit_data2'); ?>",
                         data: {
                              action: 'edit',
                              edit_id: edit_value,
                              table: table
                         },
                         success: function (res) {
                              $('.loader').hide();
                              // console.log(res);
                              var response = JSON.parse(res);

                              $("form[name='occupation_form'] #type").val(response[0].type);
                              $('#inquiry_update_btn').attr('data-edit_id', response[0].id);
                              $('#insert_btn').attr('data-edit_id', response[0].id);
                              $('#inquiry_delete_btn').attr('data-delete_id', response[0].id);
                              $('.dlt').attr('data-delete_id', response[0].id);

                              $('.deleted-all').attr('data-delete_id', response[0].id);
                         },
                         error: function (error) {
                              $('.loader').hide();

                         }
                    });
               } else {
                    $('.loader').hide();
                    alert("Data Not Edit.");
               }

          });


          //update
          $("#food-type-add-modal").on('click', '#inquiry_update_btn', function (e) {
               //   alert("helo");
               e.preventDefault();
               var update_id = $(this).attr("data-edit_id");
               var type = $('form[name="occupation_form"] #type').val();
               var table = 'master_food_type';
               //   console.log(inquiry_details);

               if (update_id != "" && type != "") {
                    var form = $("form[name='occupation_form']")[0];
                    var formdata = new FormData(form);
                    formdata.append('action', 'update');
                    formdata.append('type', type);

                    formdata.append('edit_id', update_id);
                    formdata.append('table', table);
                    // console.log(form);

                    $.ajax({
                         method: "post",
                         url: "<?= site_url('update_data_2DB'); ?>",
                         data: formdata,
                         processData: false,
                         contentType: false,
                         success: function (res) {
                              if (res == true) {
                                   $(".inquirytypeDiv")[0].reset();
                                   $(".close_btn").trigger("click");
                               
                                   list_data("<?= site_url('ftype_list_data'); ?>");
                                
                                     iziToast.success({

                                        title: 'Update Successfully'

                                        });
                              } else {
                                   $('.loader').hide();
                                   $(".close_btn").trigger("click");
                                   $(".inquirytypeDiv").addClass("was-validated");
                                   iziToast.error({
                                        title: 'Duplicate data'
                                   });
                              }
                         },
                         error: function (error) {
                              $('.loader').hide();
                         }
                    });
               } else {
                    $(".inquirytypeDiv").addClass("was-validated");
               }
          });

     
          //delete
          $(document).ready(function () {
               $('body').on('click', '.dlt', function () {
                    //  alert("hello");
                    var id = $(this).attr("data-delete_id");
                    // alert(id);
                    var table = 'master_food_type';
                    $.ajax({
                         method: "post",
                         url: "<?= site_url('delete_data_secound_db'); ?>",
                         data: {
                              action: 'delete',
                              id: id,
                              table: table
                         },
                         success: function (data) {
                              list_data("<?= site_url('ftype_list_data'); ?>");
                              $(".close_btn").trigger("click");
                              // $('.loader').hide();

                              iziToast.error({
                                   title: 'Deleted Successfully'
                              });

                         }
                    });

               });
          });

          $('body').on('click', '.deleted-all', function () {
               var checkbox = $(this).closest(".main-check-class").find('.table_list_check:checked');
               if (checkbox.length > 0) {
                    if (checkbox.length <= 1) {
                         record_text = "Do You really want to delete these records? You won't be able to revert this!";
                    } else {
                         record_text = "Do You really want to delete those records? You won't be able to revert this!";
                    }
                    var checkbox_value = [];
                    $(checkbox).each(function () {
                         checkbox_value.push($(this).attr("data-delete_id"));
                    });
                    var table = 'food_type';
                    Swal.fire({
                         title: 'Are you sure?',
                         text: record_text,
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonText: 'Delete',
                         cancelButtonText: 'Cancel',
                         cancelButtonColor: '#6e7881',
                         confirmButtonColor: '#dd3333',
                         reverseButtons: true
                    }).then(function (result) {
                         if (result.value) {
                              $.ajax({
                                   url: "<?= site_url('delete_all'); ?>",
                                   method: "post",
                                   data: {
                                        action: 'delete',
                                        checkbox_value: checkbox_value,
                                        table: table,
                                   },
                                   success: function (data) {

                                        $(checkbox).closest("tr").fadeOut();
                                        iziToast.error({
                                             title: 'Delete Successfully'
                                        });
                                        list_data("<?= site_url('ftype_list_data'); ?>");
                                   }
                              });
                         } else {
                              $('.checkbox').prop('checked', false);
                              $('.select-all-sms').prop('checked', false);
                              $(".deleted-all").hide();
                         }
                    });
               } else {
                    alert('Select atleast one records');
               }
          });

     });

</script> 

<script>
         $(".glass-head").click(function() {
          if ($(this).is(":checked")) {
               $(this).closest(".check-list-js").find(".glass-menu").removeClass("d-none");
               $(this).closest(".check-list-js").find(".glass-head-main").removeClass("d-none");
          } else {
               $(this).closest(".check-list-js").find(".glass-menu").addClass("d-none");
               $(this).closest(".check-list-js").find(".glass-head-main").addClass("d-none");
               // $(this).closest(".check-list-js").find(".glass-menu1").addClass("d-none");
               $(this).closest(".check-list-js").find('.glass-head1:checkbox').prop('checked', false);

          }
     });
     // $(".glass-head1").click(function () {
     //      if ($(this).is(":checked")) {
     //           $(this).closest(".check-list-js").find(".glass-menu1").removeClass("d-none");
     //           $(this).closest(".check-list-js").find(".glass-menu").addClass("d-none");

     //      } else {
     //           $(this).closest(".check-list-js").find(".glass-menu1").addClass("d-none");
     //           $(this).closest(".check-list-js").find(".glass-menu").removeClass("d-none");

     //      }
     // });
     $(".filter-option-inner-inner").attr('id', 'text_value');
     var a = document.getElementById("unit").value;
     // alert(a);

     $(".UploadFoodImageClass").change(function() {
          readURL(this);
     });

     function readURL(input) {
          if (input.files && input.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                    if (e.target.result != '') {
                         $('.product_image').attr('src', e.target.result);
                    }
               }
               reader.readAsDataURL(input.files[0]);
          }
     }

     $('.MeasarmentMainSelectDropDown').change(function() {
          var selectedValue = $(this).val();
          $('.GMandMLText').text(selectedValue);
     });

     $('body').on('click', '.PlusButtonDiv', function() {
          $('.NewButtonFoodModelAddUpdate').attr('DataInsertUpdate', '0');
          $('.GMClassDiv').trigger('click');
          $(".glass-menu").addClass("d-none");
          $('.GMandMLText').text("GM");

          $('.NewButtonFoodModelAddUpdate').text('Add');
          $('.CommenClassForMeasurement').prop('checked', false);
          $(".glass-menu").addClass("d-none");
          $('.CommenClassSML').val('');
          $('.CaloriesInputClass').val('');
          $('.CarbsInputClass').val('');
          $('.ProteinInputClass').val('');
          $('.FatsInputClass').val('');
          $('.FiberInputClass').val('');
          $('.DefaultQuantityInput').val('');
          $('.MeasarmentMainSelectDropDown').val('GM');
          $('.MeasarmentMainSelectDropDown').selectpicker('refresh');
          // $(".foodrequest")[0].reset();
          $(".FoodModelProductImageForm")[0].reset();
          $('.ProductFoodImgMain').attr('src', 'https://dev.gymsmart.in/assets/images/food_type/food_image.jpg');



          $('.FFoodNameClass').val('');
          $('.VegDropDownClass').val('');
          $('.FoodModelProductImageForm').selectpicker('refresh');
          $(".FoodModelProductImageForm")[0].reset();

          $('.VegDropDownClass').selectpicker('refresh');
          $('.FoodSubTypeSelcectDiv').val('');
          $('.FoodSubTypeSelcectDiv').selectpicker('refresh');
          $('.ButtonFoodModelAddUpdate').attr('datainsertupdate','0');
          $('.ButtonFoodModelAddUpdate').attr('data-edit_id','');
     });

     $('body').on('click', '.NewButtonFoodModelAddUpdate', function() {
          var id="<?php echo $nextAutoIncrementID; ?>" 
          var FoodName = $('.FFoodNameClass').val();
          var VegNonVeg = $('select.VegDropDownClass option:selected').val();
          var FoodType = $('select.FoodSubTypeSelcectDiv option:selected').val();
          var NutritionValue = $('.DefaultQuantityInput').val();
          var NutritionUnit = $('select.MeasarmentMainSelectDropDown option:selected').val();
          var Calories = $('.CaloriesInputClass').val();
          var Carbs = $('.CarbsInputClass').val();
          var Protein = $('.ProteinInputClass').val();
          var Fats = $('.FatsInputClass').val();
          var Fiber = $('.FiberInputClass').val();
          var dataArray = [];
          var checkedCheckboxes = $('.CommenClassForMeasurement:checked');

          checkedCheckboxes.each(function() {
               var DataId = $(this).attr('DataId');
               var Large = $('.FFLargeInput' + DataId).val();
               var Medium = $('.FFMediumInput' + DataId).val();
               var Small = $('.FFSmallInput' + DataId).val();

               var entry = {
                    [DataId]: {
                         large: Large,
                         medium: Medium,
                         small: Small
                    }
               };
               dataArray.push(entry);
          });
          var MeasurementUnitStoreArray = JSON.stringify(dataArray);
          var checkedCheckboxes = $('.CommenClassForMeasurement:checked');
          var checkedValues = checkedCheckboxes.map(function() {
               return $(this).attr('DataId');
          }).get();
          var Measurement = checkedValues.join(',');
          <?php
          date_default_timezone_set('UTC');
          $currentDateTime = (new \DateTime())->format('Y-m-d H:i:s');
          ?>
          var CreatedAt = '<?php echo $currentDateTime; ?>';
          var edit_id = $('.NewButtonFoodModelAddUpdate').attr("data-edit_id");
              


              



          // console.log(edit_id);
          if (edit_id == '') {
               var form = $(".FoodModelProductImageForm")[0];
               var formdata = new FormData(form);
               formdata.append('CreatedAt', CreatedAt);
               formdata.append('Measurement', Measurement);
               formdata.append('MeasurementUnitStoreArray', MeasurementUnitStoreArray);
               formdata.append('Fiber', Fiber);
               formdata.append('Fats', Fats);
               formdata.append('Protein', Protein);
               formdata.append('Carbs', Carbs);
               formdata.append('Calories', Calories);
               formdata.append('NutritionUnit', NutritionUnit);
               formdata.append('NutritionValue', NutritionValue);
               formdata.append('VegNonVeg', VegNonVeg);
               formdata.append('FoodName', FoodName);
               formdata.append('FoodType', FoodType);
               // formdata.append('admin_id', admin_id);
               formdata.append('id', id);





               if (FoodName != '' && FoodType != '' && VegNonVeg != '' && NutritionValue != '' && NutritionUnit != '' && Calories != '' && Carbs != '' && Protein != '' && Fats != '' && Fiber != '' && MeasurementUnitStoreArray != '' && Measurement != '' && CreatedAt != '') {
                    $.ajax({
                         method: "post",
                         url: "MasterFoodInsertData",
                         data: formdata,
                         processData: false,
                         contentType: false,
                         success: function(data) {
                              var response = JSON.parse(data);

                              var CheckInsert = response.RStuts;
                              if (CheckInsert == '1') {
                                   iziToast.success({
                                        title: 'Added Successfully'
                                   });
                              }
                              $('.close_btn').trigger('click');
                              if (CheckInsert == '0') {
                                   iziToast.error({
                                        title: 'Duplicate data'
                                   });
                              }
                              list_data("<?= site_url('food_list_request'); ?>");
                         },
                    });
               }
          } else {
               var form = $(".FoodModelProductImageForm")[0];
               var formdata = new FormData(form);
               formdata.append('CreatedAt', CreatedAt);
               formdata.append('Measurement', Measurement);
               formdata.append('edit_id', edit_id);
               formdata.append('MeasurementUnitStoreArray', MeasurementUnitStoreArray);
               formdata.append('Fiber', Fiber);
               formdata.append('Fats', Fats);
               formdata.append('Protein', Protein);
               formdata.append('Carbs', Carbs);
               formdata.append('Calories', Calories);
               formdata.append('NutritionUnit', NutritionUnit);
               formdata.append('NutritionValue', NutritionValue);
               formdata.append('VegNonVeg', VegNonVeg);
               formdata.append('FoodName', FoodName);
               formdata.append('FoodType', FoodType);
               var URLAction = $('.NewButtonFoodModelAddUpdate').attr('DataAction');
               var URLUpdate = "MasterFoodUpdateData";
               if(URLAction == '1'){
                    var URLUpdate = "MasterFoodUpdateDataMain";
               }else{
                    var URLUpdate = "MasterFoodUpdateData";

               }

               if (FoodName != '' && FoodType != '' && VegNonVeg != '' && NutritionValue != '' && NutritionUnit != '' && Calories != '' && Carbs != '' && Protein != '' && Fats != '' && Fiber != '' && MeasurementUnitStoreArray != '' && Measurement != '' && CreatedAt != '') {
                    $.ajax({
                         method: "post",
                         url: URLUpdate,
                         data: formdata,
                         processData: false,
                         contentType: false,
                         success: function(data) {
                              var response = JSON.parse(data);
                              var CheckInsert = response.RStuts;
                              if (CheckInsert == '1') {
                                   iziToast.success({
                                        title: 'Updated Successfully'
                                   });
                              }
                              $('.close_btn').trigger('click');
                              if (CheckInsert == '0') {
                                   iziToast.error({
                                        title: 'Duplicate data'
                                   });
                              }
                              list_data("<?= site_url('food_list_request'); ?>");
                         },
                    });
               }
          }
     });

     


  

     $('body').on('click', '.PencilBtnModel', function() {
               $('.CommenClassForMeasurement').prop('checked', false);
               $(".glass-menu").addClass("d-none");
               $('.CommenClassSML').val('');
               var FoodSubType = $(this).attr('FoodSubType');
               var DataId = $(this).attr('DataId');
               console.log(DataId);
               var FoodName = $(this).attr('FoodName');
               var VegSVG = $('.VegNonVegSVG' + DataId).attr('VegSVG');
               var DataImageSRC = $(this).attr('DataImageSRC');
               $('.ProductFoodImg').attr('src', DataImageSRC);
               $('.SVGSetVegeNonVeg').html(VegSVG);
               $('.FoodNameSetViewModel').text(FoodName);
               $('.FoodTypeViewModelText').text(FoodSubType);
               $.ajax({
                         type: "post",
                         url: "<?= site_url('edit_data2'); ?>",
                         data: {
                              action: 'edit',
                              edit_id: DataId,
                              table: 'master_food_items',
                         },
                         success: function (res) {
                              $('.loader').hide();
                              var response = JSON.parse(res);
                              $('#food_delete1').attr('data-food_id', response[0].id);

                              $('.NutiotionPerTextViewClass').text(' ' +response[0].NutritionValue);
                              $('.NutritionUnitTextViewClass').text(' ' +response[0].NutritionUnit);
                              $('.CaloriesTextViewClass').text(response[0].Calories);
                              $('.ProteinTextViewClass').text(response[0].Protein);
                              $('.CarbsTextViewClass').text(response[0].Carbs);
                              $('.FatsTextViewClass').text(response[0].Fats);
                              $('.FiberTextViewClass').text(response[0].Fiber);
                              $('.FFoodNameClass').val(response[0].FoodName);
                              $('.DefaultQuantityInput').val(response[0].NutritionValue);
                              $('.CaloriesInputClass').val(response[0].Calories);
                              $('.CarbsInputClass').val(response[0].Carbs);
                              $('.ProteinInputClass').val(response[0].Protein);
                              $('.FatsInputClass').val(response[0].Fats);
                              $('.FiberInputClass').val(response[0].Fiber);
                              $('.VegDropDownClass').val(response[0].VegNonVeg);
                              $('.VegDropDownClass').selectpicker('refresh');
                              $('.MeasarmentMainSelectDropDown').val(response[0].NutritionUnit);
                              $('.MeasarmentMainSelectDropDown').selectpicker('refresh');
                              $(".NewButtonFoodModelAddUpdate ").attr('data-edit_id', response[0].id);
                              $('.DlBtn').attr('DataId', response[0].id);

                              $('.GMandMLText').text(response[0].NutritionUnit);
                              var ChechBoxArray = response[0].MeasurementUnitStoreArray;
                              ChechBoxArray = JSON.parse(ChechBoxArray);
                              $.each(ChechBoxArray, function(index, item) {
                                   var key = Object.keys(item)[0];
                                   var sizes = item[key];
                                   var checkbox = $('.CommenClassForMeasurement[DataId="' + key + '"]');
                                   if (!checkbox.is(':checked')) {
                                        checkbox.trigger('click');
                                   }
                                   $('.FFLargeInput' + key).val(sizes.large);
                                   $('.FFMediumInput' + key).val(sizes.medium);
                                   $('.FFSmallInput' + key).val(sizes.small);
                              });
                         },
                         error: function (error) {
                              $('.loader').hide();
                         }
                    });
               });



               $('body').on('click', '.EditFoodListData', function() {

               var FoodSubType = $(this).attr('FoodSubType');
               var DataId = $(this).attr('DataId');
               console.log(DataId);               var FoodName = $(this).attr('FoodName');
               var VegSVG = $('.VegNonVegSVG' + DataId).attr('VegSVG');
               var DataImageSRC = $(this).attr('DataImageSRC');
               // var DataTable = $(this).attr('DataTable');
               // if(DataTable == 'Master'){
               //      $('.DlBtn').addClass('d-none');
               //      $('.Elbtn').addClass('d-none');
               // }else{
               //      $('.DlBtn').removeClass('d-none');
               //      $('.Elbtn').removeClass('d-none');
               // }

               $('.PencilBtnModel').attr('FoodSubType', FoodSubType);
               $('.PencilBtnModel').attr('DataId', DataId);
               $('.PencilBtnModel').attr('FoodName', FoodName);
               $('.PencilBtnModel').attr('DataImageSRC', DataImageSRC);
               $('.ButtonFoodModelAddUpdate').text('Update');






               $('.ProductFoodImg').attr('src', DataImageSRC);
               $('.SVGSetVegeNonVeg').html(VegSVG);
               $('.FoodNameSetViewModel').text(FoodName);
               $('.FoodTypeViewModelText').text(FoodSubType);
               $.ajax({
                    type: "post",
                    url: "<?= site_url('edit_data2'); ?>",
                    data: {
                         action: 'edit',
                         edit_id: DataId,
                         table: 'master_food_items',
                    },
                    success: function (res) {
                         $('.loader').hide();
                         var response = JSON.parse(res);    
                         console.log(response);  
                         $('#request_approve').attr('DataId', response[0].id);
                         $('.insertfoodtype').attr('DataId', response[0].id);
                         $('#food_delete1').attr('data-food_id', response[0].id);



                         $('.DlBtn').attr('DataId', response[0].id);

                          $('.NutiotionPerTextViewClass').text(' ' +response[0].NutritionValue);
                         $('.NutritionUnitTextViewClass').text(' ' +response[0].NutritionUnit);
                         $('.CaloriesTextViewClass').text(response[0].Calories);
                         $('.ProteinTextViewClass').text(response[0].Protein);
                         $('.CarbsTextViewClass').text(response[0].Carbs);
                         $('.FatsTextViewClass').text(response[0].Fats);
                         $('.FiberTextViewClass').text(response[0].Fiber);
                         $('.FFoodNameClass').val(response[0].FoodName);
                         $('.DefaultQuantityInput').val(response[0].NutritionValue);
                         $('.CaloriesInputClass').val(response[0].Calories);
                         $('.CarbsInputClass').val(response[0].Carbs);
                         $('.ProteinInputClass').val(response[0].Protein);
                         $('.FatsInputClass').val(response[0].Fats);
                         $('.FiberInputClass').val(response[0].Fiber);
                         $('.VegDropDownClass').val(response[0].VegNonVeg);
                         $('.VegDropDownClass').selectpicker('refresh');
                         $('.MeasarmentMainSelectDropDown').val(response[0].NutritionUnit);
                         $('.MeasarmentMainSelectDropDown').selectpicker('refresh');
                         $(".NewButtonFoodModelAddUpdate ").attr('data-edit_id', response[0].id);

                         var ChechBoxArray = response[0].MeasurementUnitStoreArray;
                         ChechBoxArray = JSON.parse(ChechBoxArray);
                         $.each(ChechBoxArray, function(index, item) {
                              var key = Object.keys(item)[0];
                              var sizes = item[key];
                              var checkbox = $('.CommenClassForMeasurement[DataId="' + key + '"]');
                              if (!checkbox.is(':checked')) {
                                   checkbox.trigger('click');
                              }
                              $('.FFLargeInput' + key).val(sizes.large);
                              $('.FFMediumInput' + key).val(sizes.medium);
                              $('.FFSmallInput' + key).val(sizes.small);
                         });
                    },
                    error: function (error) {
                         $('.loader').hide();
                    }
               });
               });

     


     // $('body').on('click', '.PlusButtonDivSecond', function() {

     //      $('.NewButtonFoodModelAddUpdate').text('Update');
     // });
     $('body').on('click', '.PencilBtnModel1', function() {
               $('.CommenClassForMeasurement').prop('checked', false);
               $(".glass-menu").addClass("d-none");
               $('.CommenClassSML').val('');
               var FoodSubType = $(this).attr('FoodSubType');
               var DataId = $(this).attr('DataId');
               console.log(DataId);
               var FoodName = $(this).attr('FoodName');
               var VegSVG = $('.VegNonVegSVG' + DataId).attr('VegSVG');
               var DataImageSRC = $(this).attr('DataImageSRC');
               $('.ProductFoodImg').attr('src', DataImageSRC);
               $('.SVGSetVegeNonVeg').html(VegSVG);
               $('.FoodNameSetViewModel').text(FoodName);
               $('.FoodTypeViewModelText').text(FoodSubType);
               $.ajax({
                         type: "post",
                         url: "<?= site_url('edit_data2'); ?>",
                         data: {
                              action: 'edit',
                              edit_id: DataId,
                              table: 'master_food_request',
                         },
                         success: function (res) {

                              $('.loader').hide();
                              var response = JSON.parse(res);
                              console.log(response);
                              $('.NutiotionPerTextViewClass').text(' ' +response[0].NutritionValue);
                              $('.NutritionUnitTextViewClass').text(' ' +response[0].NutritionUnit);
                              $('.CaloriesTextViewClass').text(response[0].Calories);
                              $('.ProteinTextViewClass').text(response[0].Protein);
                              $('.CarbsTextViewClass').text(response[0].Carbs);
                              $('.FatsTextViewClass').text(response[0].Fats);
                              $('.FiberTextViewClass').text(response[0].Fiber);
                              $('.FFoodNameClass').val(response[0].FoodName);
                              $('.DefaultQuantityInput').val(response[0].NutritionValue);
                              $('.CaloriesInputClass').val(response[0].Calories);
                              $('.CarbsInputClass').val(response[0].Carbs);
                              $('.ProteinInputClass').val(response[0].Protein);
                              $('.FatsInputClass').val(response[0].Fats);
                              $('.FiberInputClass').val(response[0].Fiber);
                              $('.VegDropDownClass').val(response[0].VegNonVeg);
                              $('.VegDropDownClass').selectpicker('refresh');
                              $('.MeasarmentMainSelectDropDown').val(response[0].NutritionUnit);
                              $('.FoodSubTypeSelcectDiv').val(response[0].FoodType);
                              $('.FoodSubTypeSelcectDiv').selectpicker('refresh');


                                
                              $('.MeasarmentMainSelectDropDown').selectpicker('refresh');
                              $(".NewButtonFoodModelAddUpdate ").attr('data-edit_id', response[0].id);
                              $('.DlBtn').attr('DataId', response[0].id);

                              $('.GMandMLText').text(response[0].NutritionUnit);
                              var ChechBoxArray = response[0].MeasurementUnitStoreArray;
                              ChechBoxArray = JSON.parse(ChechBoxArray);
                              $.each(ChechBoxArray, function(index, item) {
                                   var key = Object.keys(item)[0];
                                   var sizes = item[key];
                                   var checkbox = $('.CommenClassForMeasurement[DataId="' + key + '"]');
                                   if (!checkbox.is(':checked')) {
                                        checkbox.trigger('click');
                                   }
                                   $('.FFLargeInput' + key).val(sizes.large);
                                   $('.FFMediumInput' + key).val(sizes.medium);
                                   $('.FFSmallInput' + key).val(sizes.small);
                              });
                         },
                         error: function (error) {
                              $('.loader').hide();
                         }
                    });
               });



               $('body').on('click', '.EditFoodListDatarequest', function() {

               var FoodSubType = $(this).attr('FoodSubType');
               var DataId = $(this).attr('DataId');
               console.log(DataId);               
               var FoodName = $(this).attr('FoodName');
               var VegSVG = $('.VegNonVegSVG' + DataId).attr('VegSVG');
               var DataImageSRC = $(this).attr('DataImageSRC');
               // var DataTable = $(this).attr('DataTable');
               // if(DataTable == 'Master'){
               //      $('.DlBtn').addClass('d-none');
               //      $('.Elbtn').addClass('d-none');
               // }else{
               //      $('.DlBtn').removeClass('d-none');
               //      $('.Elbtn').removeClass('d-none');
               // }

               $('.PencilBtnModel1').attr('FoodSubType', FoodSubType);
               $('.PencilBtnModel1').attr('DataId', DataId);
               $('.PencilBtnModel1').attr('FoodName', FoodName);
               $('.PencilBtnModel1').attr('DataImageSRC', DataImageSRC);

               $('.ButtonFoodModelAddUpdate').text('Update');





               $('.ProductFoodImg').attr('src', DataImageSRC);
               $('.SVGSetVegeNonVeg').html(VegSVG);
               $('.FoodNameSetViewModel').text(FoodName);
               $('.FoodTypeViewModelText').text(FoodSubType);
               $.ajax({
                    type: "post",
                    url: "<?= site_url('edit_data2'); ?>",
                    data: {
                         action: 'edit',
                         edit_id: DataId,
                         table: 'master_food_request',
                    },
                    success: function (res) {
                         $('.loader').hide();
                         var response = JSON.parse(res);    
                         console.log(response);  
                         $('#request_approve').attr('DataId', response[0].id);
                         $('.insertfoodtype').attr('DataId', response[0].id);
                         $('.DlBtn').attr('DataId', response[0].id);

                      
                          $('.NutiotionPerTextViewClass').text(' ' +response[0].NutritionValue);
                         $('.NutritionUnitTextViewClass').text(' ' +response[0].NutritionUnit);
                         $('.CaloriesTextViewClass').text(response[0].Calories);
                         $('.ProteinTextViewClass').text(response[0].Protein);
                         $('.CarbsTextViewClass').text(response[0].Carbs);
                         $('.FatsTextViewClass').text(response[0].Fats);
                         $('.FiberTextViewClass').text(response[0].Fiber);
                         $('.FFoodNameClass').val(response[0].FoodName);
                         $('.EDITfoodtypename').val(response[0].requestype);

                         var requestType = response[0].requestype;

                         if (isNaN(requestType)) {
                         $('.FoodTypeViewModelText').text(requestType);
                         $('.foodtypeEdit').show();
                         $('#request_approve').hide();
                         } else {
                         $('.foodtypeEdit').hide();
                         $('#request_approve').show();

                         $('.EDITfoodtypename').val(requestType);
                         
                         }


                         
                         $('.DefaultQuantityInput').val(response[0].NutritionValue);
                         $('.CaloriesInputClass').val(response[0].Calories);
                         $('.CarbsInputClass').val(response[0].Carbs);
                         $('.ProteinInputClass').val(response[0].Protein);
                         $('.FatsInputClass').val(response[0].Fats);
                         $('.FiberInputClass').val(response[0].Fiber);
                         $('.VegDropDownClass').val(response[0].VegNonVeg);
                         $('.VegDropDownClass').selectpicker('refresh');
                         $('.MeasarmentMainSelectDropDown').val(response[0].NutritionUnit);
                         $('.MeasarmentMainSelectDropDown').selectpicker('refresh');
                         $(".NewButtonFoodModelAddUpdate ").attr('data-edit_id', response[0].id);

                         var ChechBoxArray = response[0].MeasurementUnitStoreArray;
                         ChechBoxArray = JSON.parse(ChechBoxArray);
                         $.each(ChechBoxArray, function(index, item) {
                              var key = Object.keys(item)[0];
                              var sizes = item[key];
                              var checkbox = $('.CommenClassForMeasurement[DataId="' + key + '"]');
                              if (!checkbox.is(':checked')) {
                                   checkbox.trigger('click');
                              }
                              $('.FFLargeInput' + key).val(sizes.large);
                              $('.FFMediumInput' + key).val(sizes.medium);
                              $('.FFSmallInput' + key).val(sizes.small);
                         });
                    },
                    error: function (error) {
                         $('.loader').hide();
                    }
               });
               });

             
                  $('body').on('click', '.insertfoodtype', function () {
                     var DataId = $(this).attr('DataId');

                              $.ajax({
                                   method: "post",
                                   url: "<?= site_url('master_foodtype_update'); ?>",
                                   data: {
                                        action: 'update',
                                        id: DataId,
                                        FoodTypeRequest: 1,
                                        table: 'master_food_request'
                                   },
                                   success: function(data) {
                                        $.ajax({
                                             method: "post",
                                             url: "<?= site_url('master_foodtype_update_insert'); ?>",
                                             data: {
                                                  action: 'update',
                                                  id: DataId,
                                                  FoodTypeRequest: 1,
                                                  table: 'master_food_request'
                                             },
                                             success: function(res) {
                                                  $.ajax({
                                                  method: "post",
                                                  url: "<?= site_url('Foodtype_delete_data'); ?>",
                                                  data: {
                                                       action: 'delete',
                                                       id: DataId,
                                                       setvalue:res,
                                                       table: 'master_food_request'
                                                  },
                                                  success: function(data) {

                                                       console.log('Third AJAX request success:', data);

                                                  }, 
                                                 
                                                  });
                                             },
                                             
                                        });
                                        
                                   },

                              });
                          });


                          $('body').on('click', '#food_delete1', function() {
                          var DataId = $(this).attr('datadeleteid');


                  
                              $.ajax({
                                   method: "post",
                                   url: "<?= site_url('Food_delete_data'); ?>",
                                   data: {
                                        action: 'delete',
                                        id: DataId,
                                        table: 'master_food_items'
                                   },
                                   success: function(data) {
                                     
                                        list_data();

                                        $(".close_btn").trigger("click");

                                   }
                              });
                         });
                    

               $('body').on('click', '#request_approve', function() {
               var DataId = $(this).attr('DataId');
               console.log(DataId);

               $.ajax({
                    method: "post",
                    url: "<?= site_url('master_food_update'); ?>",
                    data: {
                         action: 'update',
                         id: DataId,
                         request_status: 1,
                         table: 'master_food_request'
                    },
                    success: function(data) {
                         $.ajax({
                              method: "post",
                              url: "<?= site_url('master_food_update_insert'); ?>",
                              data: {
                                   action: 'update',
                                   id: DataId,
                                   request_status: 1,
                                   table: 'master_food_request'
                              },
                              success: function(data) {
                                   console.log(data);

                                   $.ajax({
                                   method: "post",
                                   url: "<?= site_url('Food_delete_data'); ?>",
                                   data: {
                                        action: 'delete',
                                        id: DataId,
                                        table: 'master_food_request'
                                   },
                                   success: function(data) {
                                        iziToast.success({
                                             title: 'food request approved successfully'
                                        });
                                        list_data("<?= site_url('food_list_request'); ?>");
                                        $(".close_btn").trigger("click");
                                   },
                                   error: function(error) {
                                        console.error("Error deleting data:", error);
                                   }
                                   });
                              },
                              error: function(error) {
                                   console.error("Error updating request status and inserting data:", error);
                              }
                         });
                    },
                    error: function(error) {
                         console.error("Error updating request status:", error);
                    }
               });
               });




          $(document).ready(function() {
               $('body').on('click', '.DlBtn', function() {
                    var DataId = $(this).attr('DataId');
                    console.log(DataId);
                    var record_text = "Are you sure you want to Delete this?";

                    // console.log(id);
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
                                   method: "post",
                                   url: "<?= site_url('Food_delete_data'); ?>",
                                   data: {
                                        action: 'delete',
                                        id: DataId,
                                        table: 'master_food_request'
                                   },
                                   success: function(data) {
                                        iziToast.error({
                                             title: 'Deleted Successfully'
                                        });
                                        list_data("<?= site_url('food_list_data_new'); ?>");

                                        $(".close_btn").trigger("click");

                                   }
                              });
                         }
                    });

               });
          });

          $('body').on('click', '.List1Food', function(){
               $('.NewButtonFoodModelAddUpdate').attr('DataAction', '1');
          });

          $('body').on('click', '.List2Food', function(){
               $('.NewButtonFoodModelAddUpdate').attr('DataAction', '2');
          });

</script>