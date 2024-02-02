<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php $table_username = ""; ?>
<?php
$exercise_type = json_decode($exercise_type, true);
?>
<script>
</script>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="px-3 py-2 bg-white rounded-2 m-2">
            <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="ExerciseMasterId" data-table="exercise" DataStatus='3'
                        data-bs-toggle="pill" data-bs-target="#pills-ex-mastre-tab" type="button" role="tab"
                        aria-controls="pills-ex-mastre-tab" aria-selected="true">Exercises Master</button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link ExerciseSubTypeNavClass" id="ExerciseSubTypeId" data-table="exercise_sub_type" DataStatus='2'
                        data-bs-toggle="pill" data-bs-target="#pills-ex-sub-type-tab" type="button" role="tab"
                        aria-controls="pills-ex-sub-type-tab" aria-selected="false">Exercises Sub Type</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link  ExerciseTypeClass " id="ExerciseTypeId" DataStatus='1'
                        data-table="exercise_type" data-bs-toggle="pill" data-bs-target="#pills-ex-type-tab"
                        type="button" role="tab" aria-controls="pills-ex-type-tab" aria-selected="false">Exercises
                        Type</button>
                </li>
                <li class="nav-item ExerciseRequest" role="presentation">
                    <button class="nav-link" id="ExerciseMasterId" data-table="request" DataStatus='4'
                        data-bs-toggle="pill" data-bs-target="#pills-ex-request-tab" type="button" role="tab"
                        aria-controls="pills-ex-request-tab" aria-selected="true">Exercises Request</button>
                </li>

            </ul>
        </div>
    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-ex-mastre-tab" role="tabpanel" aria-labelledby="pills-ex-master" tabindex="0">
        <div class="main-dashbord p-2 main-check-class">
            <div class="container-fluid p-0">
                <div class="px-3 py-2 bg-white rounded-2 mx-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="title-1">
                            <h2>Exercises </h2>
                        </div>
                        <div class="title-side-icons">
                            <div class="deleted-all" data-delete_id="">
                                <span class="btn-primary-rounded" hidden>
                                    <i class="bi bi-trash3 fs-14" hidden></i>
                                </span>
                            </div>
                            <button class="btn-primary-rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#exercise-filter"
                                aria-controls="offcanvasRight" id="filter_diet">
                                <i class="bi bi-funnel fs-14"></i>
                            </button>
                            <button class="btn-primary-rounded" data-bs-toggle="modal" data-bs-target="#exercises-add">
                                <i class="bi bi-plus AddModelPlusBTNExcercisesClass" id="plus_btn"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between filter-main">
                        <div class="col-8 col-sm-9 filter-show d-flex grey-color flex-wrap align-items-center"
                            id="filter-showw cursor-pointer">
                        </div>
                        <div>
                            <button class="clear btn-primary mb-2" id="clear">Clear All</button>
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

                        <table class="TableNameListData w-100 table table-striped dt-responsive nowrap main-table " id="">
                            <thead>
                                <tr style="width:0%">
                                    <th>
                                        <input class="check_box select-all-sms" type="checkbox">
                                    </th>
                                    <th>Exercises</th>
                                </tr>
                            </thead>
                            <tbody class="BodyDivCommen"></tbody>
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
    </div>
    <div class="tab-pane fade " id="pills-ex-type-tab" role="tabpanel" aria-labelledby="pills-ex-type"
        tabindex="0">
        <div class="main-dashbord p-2 main-check-class">
            <div class="container-fluid p-0">
                <div class="px-3 py-2 bg-white rounded-2 mx-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="title-1">
                            <i class="fi fi-rr-comment-question"></i>
                            <h2>Exercises Type</h2>
                        </div>
                        <div class="title-side-icons">
                            <div  class="deleted-all">
                                <span class="btn-primary-rounded ">
                                    <i class="bi bi-trash3 fs-14"></i>
                                </span>
                            </div>
                            <button class="btn-primary-rounded" id="filter-btn" type="button" hidden
                                data-bs-toggle="offcanvas" data-bs-target="#f-type" aria-controls="offcanvasRight">
                                <i class="bi bi-funnel fs-14"></i>
                            </button>
                            <button class=" btn-primary-rounded PlusBtnExcerciseType" data-bs-toggle="modal"
                                data-bs-target="#exercise_type_edit">
                                <i class="bi bi-plus"></i>
                            </button>
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
                                    <label>Search:<input type="search" class="search_value_type" placeholder="" aria-controls="project"></label>
                                </div>
                            </div>
                        </div>

                        <table class="TableNameListData w-100 table table-striped dt-responsive nowrap main-table " id=""
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:0%">
                                        <input class="check_box select-all-sms" type="checkbox">
                                    </th>
                                    <th>Exercises Type</th>
                                </tr>
                            </thead>
                            <tbody id="" class="BodyDivCommen">
                            </tbody>
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
    </div>
    <div class="tab-pane fade" id="pills-ex-sub-type-tab" role="tabpanel" aria-labelledby="pills-ex-sub-type"
        tabindex="0">
        <div class="main-dashbord p-2 main-check-class">
            <div class="container-fluid p-0">
                <div class="px-3 py-2 bg-white rounded-2 mx-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="title-1">
                            <i class="fi fi-rr-comment-question"></i>
                            <h2> Exercises Sub Type </h2>
                        </div>
                        <div class="title-side-icons">
                            <div class="deleted-all">
                                <span class="me-2 btn-primary-rounded">
                                    <i class="bi bi-trash3 fs-14"></i>
                                </span>
                            </div>
                            <button class="btn-primary-rounded" id="filter-btn" type="button" hidden
                                data-bs-toggle="offcanvas" data-bs-target="#f-exercise" aria-controls="offcanvasRight">
                                <i class="bi bi-funnel fs-14"></i>
                            </button>
                            <button class="btn-primary-rounded plus_btn AddExcerciseSubTypeClassModel"
                                data-bs-toggle="modal" data-bs-target="#exercise_sub_type_edit" id="plus_btn">
                                <i class="bi bi-plus"></i>
                            </button>
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
                                    <label>Search:<input type="search" class="search_value_sub_type" placeholder="" aria-controls="project"></label>
                                </div>
                            </div>
                        </div>

                        <table
                            class="main-table table TableNameListData  dt-responsive nowrap exercise-sub-table exercise_sub_insert"
                            id="" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <input class="check_box select-all-sms" type="checkbox">
                                    </th>
                                    <th>Exercises Sub Type</th>
                                </tr>
                            </thead>
                            <tbody class="BodyDivCommen" id="">
                            </tbody>
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
    </div>
    <div class="tab-pane fade" id="pills-ex-request-tab" role="tabpanel" aria-labelledby="pills-ex-request" tabindex="0">
        <div class="main-dashbord p-2 main-check-class">
            <div class="container-fluid p-0">
                <div class="px-3 py-2 bg-white rounded-2 mx-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="title-1">
                            <h2>Exercises Request</h2>
                        </div>
                        <div class="title-side-icons">
                            <div class="deleted-all" data-delete_id="">
                                <span class="btn-primary-rounded" hidden>
                                    <i class="bi bi-trash3 fs-14" hidden></i>
                                </span>
                            </div>
                            <button class="btn-primary-rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#exercise-filter"
                                aria-controls="offcanvasRight" id="filter_diet">
                                <i class="bi bi-funnel fs-14"></i>
                            </button>
                            <button class="btn-primary-rounded" hidden data-bs-toggle="modal" data-bs-target="#exercisesrequest-add">
                                <i class="bi bi-plus AddModelPlusBTNExcercisesClass" id="plus_btn"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between filter-main">
                        <div class="col-8 col-sm-9 filter-show d-flex grey-color flex-wrap align-items-center"
                            id="filter-showw cursor-pointer">
                        </div>
                        <div>
                            <button class="clear btn-primary mb-2" style="display:none;" id="clear">Clear All</button>
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
                                    <label>Search:<input type="search" class="search_value_exercise" placeholder="" aria-controls="project"></label>
                                </div>
                            </div>
                        </div>

                        <table class="TableNameListData w-100 table table-striped dt-responsive nowrap main-table " id="">
                            <thead>
                                <tr style="width:0%">
                                    <th>
                                        <input class="check_box select-all-sms" type="checkbox">
                                    </th>
                                    <th>Exercises</th>
                                </tr>
                            </thead>
                            <tbody class="BodyDivCommen"></tbody>
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
    </div>
</div>
<div class="modal fade " id="gymsmart_exercise_view" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="needs-validation" name="membership_update_form" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title ">Excercise</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery">
                    <div div class="modal-body-card d-flex align-items-center">
                        <div class="col-lg-4 col-12 d-flex justify-content-start">
                            <div class="profile-photo2">
                                <img id="img_foody" src="../assets/image/sample-profile.png" alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex flex-wrap  ">
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Name</p>
                                <h5 name="" id="e_name_view" class="fw-semibold fs-14">Rutvik</h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Type</p>
                                <h5 name="" id="e_type_view" class="fw-semibold fs-14 EXerciseevieww">Male</h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Sub type</p>
                                <h5 name="" id="e_subtype_view" class="fw-semibold fs-14">9099274485</h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Reps </p>
                                <h5 name="" id="e_rep_view" class="fw-semibold fs-14">Simada Naka</h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Calories</p>
                                <h5 name="" id="e_calories_view" class="fw-semibold fs-14">morning</h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Duration</p>
                                <h5 name="" id="view__duration" class="fw-semibold fs-14"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="delete_main">
                        <button type="button"   class="delete_btn_1 btn-primary w-100 delete-btn DeleteBtnClassExercise CommenBtnDeleteClass">Delete</button>
                        <button type="button" data-delete_id="" id="exercie_delete" class="btn-secondary DeleteBtnClassExercise CommenBtnDeleteClass px-3 really "
                            data-bs-dismiss="modal" DataDeleteId="" DataTableName='master_exercise'>Really?</button>
                    </div>
                    <button type="button" class="btn-primary edt EditModelExcercisesClass" DataEditId = "" data-bs-toggle="modal"
                        data-bs-target="#exercises-add">
                        <i class="bi bi-pencil"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade " id="exercises-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <form name="exercises_submit" class="needs-validation" enctype="multipart/form-data" method="post" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title ExcerciseModelTitleClass">Add Exercise</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery ">
                    <div class="modal-body-card align-items-center">
                        <div class="col-3">
                            <div class=" col-12  d-flex flex-wrap justify-content-center">
                                    <img  src="https://cdn1.vectorstock.com/i/1000x1000/34/75/default-placeholder-fitness-trainer-in-a-t-shirt-vector-20773475.jpg" id="exercise_Img" alt="" class="rounded-4 EImageExerciseInputImg border border-5" width="121px" height="144px" style="object-fit: cover;" >
                          
                                    <div class="text-center profile-btn-photo2 col-12 my-2">
                                    <div class="upload-btn-wrapper">
                                        <span class="upload-btn">
                                            <i class="fi fi-rr-document"></i>
                                        </span>
                                        <input type="file" name="images[]" class="form-control main-control place EImageExerciseInput" required="" id="e_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 d-flex flex-wrap modal-body-card">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12  my-2">
                                <label for="" class="main-label investor">Name<sup class="validationn">*</sup></label>
                                <input type="text" class="form-control main-control place ExcerciseNameInputClass" name="e_name" id="e_name"
                                    placeholder="Enter Exercise" required="">
                            </div>
              
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12  my-2">
                                <label for="form-category" class="main-label investor">Sub Type<sup
                                        class="validationn">*</sup></label>
                                <div class="main-selectpicker option_add_select ">
                                    <div class="ExerciseSubTypeDropDownHtmlSet">
                                        <select id="ExcercisesDropDownClass" name="e_subtype" data-live-search="true" class="selectpicker form-control ExcercisesDropDownClass  form-main">
                                            <?php
                                            $exercise_sub_type = json_decode($exercise_sub_type, true);
                                            if (isset($exercise_sub_type)) {
                                                foreach ($exercise_sub_type as $type_key => $type_value) {
                                                    echo '<option value="' . $type_value["id"] . '" data-id="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex flex-wrap my-2">
                                <div class="col-4 ">
                                    <div class="input-text  col-12" >
                                        <div>
                                            <span>Dur/Rep</span>
                                        </div>
                                        <label class="switch_toggle checkbox-apple mt-2">
                                            <input id="" name="" class="RepNdDurStatus" data-gst_status="" type="checkbox" data-id="5" value="1" required="">
                                            <span class="check_input round switch_toggle1"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-6 col-12  Reps-input">
                                    <label for="" class="main-label investor">Reps</label>
                                    <input type="text" class="form-control main-control place RepetationInputClass" id="e_rep"
                                        placeholder="Reps Number" max="25" min="" required="">
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-6 col-12  dur-input d-none">
                                    <label for="" class="main-label investor">Duration</label>
                                    <input type="text" class="form-control main-control place DurationInputClass" name="" id="duration"
                                        placeholder="Enter Duration">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <label for="" class="main-label investor">Calories Burn</label>
                                <input type="number" class="form-control CaleriesInputClass main-control place" id="e_calories"
                                    placeholder="Calories Number" min="0" required="">
                            </div>
                            
                           
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn-cancel btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#exercise_delete" data-delete_id="1">Cancel</button>
                    <button class="btn-primary" id="exercise_submit_btn" data-edit_id=""><span class="excerciseBtnTextClass">Submit</span></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade " id="Request_exercise_view" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="needs-validation" name="membership_update_form" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title ">Excercise</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery">
                    <div div class="modal-body-card d-flex align-items-center">
                        <div class="col-lg-4 col-12 d-flex justify-content-start">
                            <div class="profile-photo2">
                                <img id="img_foody" class="Request_exercise_viewImg" src="../assets/image/sample-profile.png" alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex flex-wrap  ">
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Name</p>
                                <h5 name="" id="e_name_view" class="fw-semibold fs-14"></h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4 px-1">
                                <p class="fs-14">Exercise Type</p>
                                <h5 name="" id="e_type_view" class="fw-semibold fs-14 EXerciseevieww"></h5>
                                <!-- <div class="input-group foodtypeEdit1">
                                             <input type="text" class="form-control EDITfoodtypename1" value=""   aria-label="Amount (to the nearest dollar)">
                                             <span class="input-group-text insertfoodtype" DataId="" data-bs-dismiss="modal" data-bs-target="#Request_exercise_view"><i class="bi bi-check-square-fill text-success fs-6"></i></span>
                                        </div> -->
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4 px-1">
                                <p class="fs-14">Exercise Sub type</p>
                                <h5 name="" id="e_subtype_view" class="fw-semibold fs-14 FoodTypeViewModelText"></h5>
                                <!-- <div class="input-group foodtypeEdit">
                                             <input type="text" class="form-control EDITfoodtypename" placeholder=""   aria-label="Amount (to the nearest dollar)">
                                             <span class="input-group-text insertfoodtype1" DataId="" data-bs-dismiss="modal" data-bs-target="#Request_exercise_view"><i class="bi bi-check-square-fill text-success fs-6"></i></span>
                                        </div> -->
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Reps </p>
                                <h5 name="" id="e_rep_view" class="fw-semibold fs-14"></h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Exercise Calories</p>
                                <h5 name="" id="e_calories_view" class="fw-semibold fs-14"></h5>
                            </div>
                            <div class="py-1 col-lg-4 col-12 col-sm-4 col-md-4">
                                <p class="fs-14">Duration</p>
                                <h5 name="" id="view__duration" class="fw-semibold fs-14"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
               
                <button type="button" class="btn btn-secondary  request_approveBTN " id="request_approve" DataId="" data-bs-dismiss="modal" data-bs-target="#foodrequest">Approve</button>

                    <div class="delete_main">
                        <div type="button" class="delete_btn_1 btn-primary w-100 ">Delete</div>
                        <div type="button"  id="delete" class="btn-secondary px-3 really delete-btn1" DataId="" data-bs-dismiss="modal"  datatablename="master_exercise_type">Really?</div>
                    </div>
                    <button type="button" class="btn-primary edt EditModelExcerciseserequest" DataEditId = "" data-bs-toggle="modal"
                        data-bs-target="#exercisesrequest-add">
                        <i class="bi bi-pencil"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade " id="exercisesrequest-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <!-- <form name="exercises_submit" class="needs-validation" enctype="multipart/form-data" method="post" novalidate> -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title ExcerciseModelTitleClass">Add Exercise</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery ">
                    <div class="modal-body-card align-items-center">
                        <div class="col-3">
                            <div class=" col-12  d-flex flex-wrap justify-content-center">
                                    <img  src="https://cdn1.vectorstock.com/i/1000x1000/34/75/default-placeholder-fitness-trainer-in-a-t-shirt-vector-20773475.jpg" id="exercise_Img" alt="" class="GetEditImageFormFileInputIMG rounded-4 border border-5  EditImagePathE" width="121px" height="144px" style="object-fit: cover;" >
                                 
                                    <div class="text-center profile-btn-photo2 col-12 my-2">
                                    <div class="upload-btn-wrapper">
                                        <span class="upload-btn">
                                            <i class="fi fi-rr-document"></i>
                                        </span>
                                        <form name="GetEditImageForm" class="needs-validation GetEditImageForm" enctype="multipart/form-data" method="post" novalidate>

                                            <input type="file" name="images[]" class="form-control main-control place GetEditImageFormFileInput" required="" id="e_image">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 d-flex flex-wrap modal-body-card">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12  my-2">
                                <label for="" class="main-label investor">Name<sup class="validationn">*</sup></label>
                                <input type="text" class="form-control main-control place RExcerciseNameInputClass " name="" id="e_name"
                                    placeholder="Enter Exercise" required="">
                            </div>
           
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12  my-2">
                                <label for="form-category" class="main-label investor">Sub Type<sup class="validationn">*</sup></label>
                                    <div class="main-selectpicker option_add_select SubTypeHtmlDDSet">
                                    <div class="ExerciseSubTypeDropDownHtmlSet">
                                        <select id="ExcercisesDropDownClass" name="" data-live-search="true" class="selectpicker form-control ExcercisesDropDownClass form-main">
                                            <?php
                                            if (isset($exercise_sub_type)) {
                                                foreach ($exercise_sub_type as $type_key => $type_value) {
                                                    echo '<option value="' . $type_value["id"] . '" data-id="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12  my-2 foodtypeEdit foodtypeEditClassWise">
                                <label for="form-category" class="main-label investor">Type<sup
                                        class="validationn">*</sup></label>
                             <div class="main-selectpicker option_add_select SUSUSTypeClass">
                             <div class="ExerciseSubTypeDropDownHtmlSet">

                                    <select name="" id="ex_type"
                                        class="selectpicker ExerciseTypeClassDropdown ExerciseTypeClassDropdownEdit form-control form-main ev_type "
                                        data-live-search="true"><i class="fa-solid fa-caret-down"></i>
                                        <option value="">Select Type</option>
                                        <?php
                                        if (isset($exercise_type)) {
                                            foreach ($exercise_type as $type_key => $type_value) {
                                                echo '<option value="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                            </div>
                            </div>
                            </div>

                            <div class="col-6 d-flex flex-wrap my-2">
                                <div class="col-4 ">
                                    <div class="input-text  col-12" >
                                        <div>
                                            <span>Dur/Rep</span>
                                        </div>
                                        <label class="switch_toggle checkbox-apple mt-2">
                                            <input id="" name="" class="RepNdDurStatus" data-gst_status="" type="checkbox" data-id="5" value="1" required="">
                                            <span class="check_input round switch_toggle1"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-6 col-12  Reps-input">
                                    <label for="" class="main-label investor">Reps</label>
                                    <input type="text" class="form-control main-control place RepetationInputClass TRepClass REPsdiv" id="e_rep"
                                        placeholder="Reps Number" max="25" min="" required="">
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-6 col-12  dur-input d-none">
                                    <label for="" class="main-label investor">Duration</label>
                                    <input type="text" class="form-control main-control place DurationInputClass TDurClass Duretionclass" name="" id="duration"
                                        placeholder="Enter Duration">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <label for="" class="main-label investor">Calories Burn</label>
                                <input type="number" class="form-control CaleriesInputClass main-control place TCALAREIESdiv" id="e_calories"
                                    placeholder="Calories Number" min="0" required="">
                            </div>
                            
                           
                        </div>

                        <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-4 ">
                            <label for="" class="main-label investor">Repetation</label>
                            <input type="text" class="form-control main-control place" name="" id="repetation"
                                placeholder="Enter Repetation">
                        </div> -->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn-cancel btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#exercise_delete" data-delete_id="1">Cancel</button>
                    <button class="btn-primary" id="exercise_submit_btn1" data-edit_id=""><span class="excerciseBtnTextClass1">Submit</span></button>
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>

<!-- <div class="modal fade " id="exercise_sub_type_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="needs-validation subtypeDiv ExcerciseSubTypeClassForm" name="exercise_sub_update_form"
            method="POST" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title Add_editModelTitle">Edit Exercise Sub Type</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery ">
                    <div class="modal-body-card">
                        <div class="row">
                        <div class="col-12 mb-3">
                            <label for="e_type" class="main-label form-name">Add Type<sup
                                    class="validationn">*</sup></label>
                            <div class="main-selectpicker"  id="project_sub_type_select_table">
                                <div class="DoupDownMenuExercisetypeClass">
                                    <select name="e_type" id="ex_type"
                                        class="selectpicker ExerciseTypeClassDropdown form-control form-main ev_type "
                                        data-live-search="true"><i class="fa-solid fa-caret-down"></i>
                                        <?php
                                        if (isset($exercise_type)) {
                                            foreach ($exercise_type as $type_key => $type_value) {
                                                echo '<option class="dropdown-item" value="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="dropdown-menu " role="combobox">
                                    <div class="bs-searchbox"><input type="text" class="form-control main-control"
                                            autocomplete="off" role="textbox" aria-label="Search"></div>
                                    <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                        <ul class="dropdown-menu inner show"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-12 mb-3 ">
                            <label for="" class="main-label investor">Add Sub Type<sup
                                    class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control place ei_type ExerciseSubTypeInput"
                                name="e_type" id="e_subtype" placeholder="Enter Type" required="">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="delete_main">
                        <button type="button" id="deleterecord" class="delete_btn_1 btn-primary w-100  delete-btn ">Delete</button>
                        <button type="button" data-delete_id="" id="delete"
                            class="btn-secondary delete_really px-3 really dlt CommenBtnDeleteClass DeleteBtnDiv" data-bs-dismiss="modal"
                            data-delete_id="" DataDeleteId="" DataTableName="master_exercise_sub_type">Really?</button>
                    </div>
                    <button class="btn-primary ExerciseSubtypeUpdateClass CommenUpdateBtnUpdate" id="exercise_sub_update_btn" data-edit_id=""
                        name="exercise_update" dataupdatestatus="2" DataTableName="master_exercise_sub_type">Update</button>
                    <button type="button" class="btn-primary CancleBtn" id="cancel" data-bs-dismiss="modal"
                        data-bs-toggle="modal" data-bs-target="#exercise_delete" data-delete_id="1">Cancel</button>
                    <button type="button" class="btn-primary CommenSaveBtnInsert" DataInsertStatus="2"
                        DataTableName="master_exercise_sub_type" id="">Add</button>
                </div>
            </div>
        </form>
    </div>
</div> -->

<div class="modal fade " id="exercise_sub_type_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="needs-validation subtypeDiv ExcerciseSubTypeClassForm" name="exercise_sub_update_form"
            method="POST" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title Add_editModelTitle">Edit Exercise Sub Type</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery ">
                    <div class="modal-body-card">
                        <div class="row">
                        <div class="col-12 mb-3">
                            <label for="e_type" class="main-label form-name">Add Type<sup
                                    class="validationn">*</sup></label>
                            <div class="main-selectpicker"  id="project_sub_type_select_table">
                                <div class="DoupDownMenuExercisetypeClass">
                                    <select name="e_type" id="ex_type"
                                        class="selectpicker ExerciseTypeClassDropdown form-control form-main ev_type "
                                        data-live-search="true"><i class="fa-solid fa-caret-down"></i>
                                        <option value="">Select Type</option>
                                        <?php
                                        if (isset($exercise_type)) {
                                            foreach ($exercise_type as $type_key => $type_value) {
                                                echo '<option value="' . $type_value["id"] . '">' . $type_value["e_type"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="dropdown-menu " role="combobox">
                                    <div class="bs-searchbox"><input type="text" class="form-control main-control"
                                            autocomplete="off" role="textbox" aria-label="Search"></div>
                                    <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                        <ul class="dropdown-menu inner show"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    <div class="col-12 mb-3 ">
                            <label for="" class="main-label investor">Add Sub Type<sup
                                    class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control place ei_type ExerciseSubTypeInput"
                                name="e_type" id="e_subtype" placeholder="Enter Type" required="">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="delete_main">
                        <button type="button" class="delete_btn_1 btn-primary w-100  delete-btn">Delete</button>
                        <button type="button" data-delete_id="" id="delete"
                            class="btn-secondary delete_really px-3 really dlt CommenBtnDeleteClass DeleteBtnDiv" data-bs-dismiss="modal"
                            data-delete_id="" DataDeleteId="" DataTableName="master_exercise_sub_type">Really?</button>
                    </div>
                    <button class="btn-primary ExerciseSubtypeUpdateClass CommenUpdateBtnUpdate" id="exercise_sub_update_btn" data-edit_id=""
                        name="exercise_update" dataupdatestatus="2" DataTableName="master_exercise_sub_type">Update</button>
                    <button type="button" class="btn-primary CancleBtn" id="cancel" data-bs-dismiss="modal"
                        data-bs-toggle="modal" data-bs-target="#exercise_delete" data-delete_id="1">Cancel</button>
                    <button type="button" class="btn-primary CommenSaveBtnInsert" DataInsertStatus="2"
                        DataTableName="master_exercise_sub_type" id="">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade " id="exercise_type_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="needs-validation ExerciseAddFormClass" name="exercise_update_form" novalidate>
                <div class="modal-header">
                    <h1 class="modal-title EditTitleExerciseTypeClass">Edit Exercise Type</h1>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery">
                    <div class="modal-body-card">
                        <div class="col-12 mb-3">
                            <label for="" class="main-label">Type<sup class="validationn">*</sup></label>
                            <input type="text" class="form-control main-control ExerciseTypeInputClass "
                                 id="" placeholder="Enter Type" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="DeleteDivExcerciseType delete_main">
                        <div type="button" class="delete_btn_1 btn-primary w-100 " >Delete</div>
                        <div type="button" data-delete_id="" id="delete" class="btn-secondary DeleteBtnExcerciseTypeClass CommenBtnDeleteClass px-3 really"
                            data-bs-dismiss="modal" DataDeleteId="" DataTableName='master_exercise_type'>Really?</div>
                    </div>
                    <button class="btn-primary UpdateBtnExerciseType CommenUpdateBtnUpdate" id="f" data-edit_id="" DataUpdateStatus="1" DataTableName="master_exercise_type">Update</button>
                    <button type="button" class="btn-primary CancleBtn" id="cancel" data-bs-dismiss="modal"
                        data-bs-toggle="modal" data-bs-target="#exercise_delete" data-delete_id="1">Cancel</button>
                    <button type="button" class="btn-primary SaveBtnClassExcerciseType CommenSaveBtnInsert"
                        DataInsertStatus="1" DataTableName="master_exercise_type"
                        id="">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="offcanvas offcanvas-end" tabindex="-1" id="exercise-filter" aria-labelledby="offcanvasRightLabel">
    <form method="post" class="d-flex flex-column h-100" name="filter_form">
        <div class="offcanvas-header">
            <h5 id="offcanvas-title" class="filtersTitle" style="color: #fff">Filter</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body filter_data">
            <div class="col-lg-12 mb-3 ">
                <input type="text" class="form-control main-control place ID ExerciseMasterFilterIdClass" id="f_id" placeholder="Enter id">
            </div>
            <div class="col-lg-12 mb-3 ">
                <input type="text" class="form-control main-control place Name ExerciseMasterFilterNameClass" id="f_name" placeholder="Enter Excercise Name">
            </div>
            <div class="col-lg-12 mb-3 ">
                <div class="ExerciseMasterFilterDroupDownClassSubType">
                    <div class="main-selectpicker">
                    
                        <select name="" id="F_subtype" multiple
                            class="multiple-select selectpicker FinventoryType form-control ExerciseMasterFilterSubTypeClass main-control f_subtype selectpicker-validation"
                            data-live-search="true" required="" tabindex="-98">
                            <option class="dropdown-item" value="" dataTypeId="" disabled style="display:none" selected> ExerciseType</option>
                            <?php
                            //    $exercise_sub_type = json_decode($exercise_sub_type, true);
                            
                            if (isset($exercise_sub_type)) {

                                foreach ($exercise_sub_type as $type_key => $type_value) {
                                    echo '<option class="dropdown-item " dataTypeId = "' . $type_value["id"] . '" value="' . $type_value["e_type"] . '">' . $type_value["e_type"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



<input type="text" hidden value="exercise" DataStatus="3" class="table_value_picker" id="table_value_picker" />
<input type="text" hidden value="exercise_type" DataStatus="3" class="ListDataStatus" id="ListDataStatus" />

<script>
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<?= $this->include('partials/footer') ?>

<?= $this->include('partials/vendor-scripts') ?>


<script>
        //  $(".FoodSubTypeSelcectDiv .item_name_modal_ul li").addClass("");

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
        </script>
<script>

    
    function validateImage(input) {
        var file = input.files[0];
        var imageType = /^image\//;
        if (!file || !imageType.test(file.type)) {
            input.value = "";
            document.getElementById("img_food").src = "";
            alert("Please select an image file.");
        } else {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("img_food").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    $(document).ready(function () {
        function datatable_view_exercise(html) {
            $('#exercise_table').DataTable().destroy();
            $('#exercise_list').html(html);
            var table1 = $('#exercise_table').DataTable({
                lengthChange: true,
            });
        }
        // view data 
        $('body').on('click', '.exercise_view', function (e) {
            // alert("fd");
            e.preventDefault();
            $('.excerciseBtnTextClass').text('Update');
            $('.exercise_submit_btn').text('Update');



            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-view_id");
            var table = 'master_exercise';
            if (edit_value != "") {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('exercise_view'); ?>",
                    data: {
                        action: 'view',
                        view_id: edit_value,
                        table: table
                    },
                    success: function (res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        // console.log();
                        var img_name = response[0].e_image;

                        var duration = response[0].duration;
                        // var timeZone = "<?php echo ""; ?>";
                        // var inputFormat = "HH:mm:ss"; 
                        // var utcTime = GetCurrentTimezoneTime(duration, inputFormat, timeZone);
                        // console.log(utcTime);

                        if (img_name != '' && img_name != 'undefined') {
                            var img_name = response[0].e_image;
                        } else {
                            var img_name = 'nofoodphotoimage-removebg-preview.png';
                        }
                        var img_path = '<?= site_url('assets/images/food_type/'); ?>';
                        $('.delete-btn').attr('data-delete_id', response[0].id);
                        $('.EditModelExcercisesClass').attr('DataEditId', response[0].id);
                        $('.DeleteBtnClassExercise').attr('DataDeleteId', response[0].id);
                        $('#gymsmart_exercise_view #e_name_view').text(response[0].e_name);
                        $('#gymsmart_exercise_view #e_type_view').text(response[0].e_type);
                        $('#gymsmart_exercise_view #e_subtype_view').text(response[0].e_subtype);
                        $('#gymsmart_exercise_view #e_rep_view').text(response[0].e_rep);
                        $('#gymsmart_exercise_view #e_calories_view').text(response[0].e_calories);
                        $('#exercise_submit_btn').attr('data-edit_id', response[0].id);
                        $("#gymsmart_exercise_view #img_foody").attr('src', img_path + img_name);

                        $('#gymsmart_exercise_view #view__duration').text(duration);

                        $('.selectpicker').selectpicker('refresh');
                    },
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });

        $('body').on('click', '.exerciseRequest_view', function (e) {
            // alert("fd");
            e.preventDefault();
            $('.excerciseBtnTextClass1').text('Update');
            $('.exercise_submit_btn1').text('Update');
            var ESubType = $(this).attr('ESubType');
            $('.EditModelExcerciseserequest').attr('ESubType', ESubType);
            $('#Request_exercise_view #e_subtype_view').text(ESubType);

            var ExcerciseType = $(this).attr('ExcerciseType');
            // $('.FoodTypeViewModelText').attr('ExcerciseType', ExcerciseType);

            $('#Request_exercise_view #e_type_view').text(ExcerciseType);

            var DataType = $(this).attr('DataType');
            var DayaSubType = $(this).attr('DayaSubType');
            var DataImg = $(this).attr('image');
            var DataApprovedStatus = $(this).attr('DataApprovedStatus');
            if(DataApprovedStatus == '1'){
                $(".request_approveBTN").prop("disabled", false);
            }else{
                $(".request_approveBTN").prop("disabled", true);
            }
            $('.EXerciseevieww').text(DataType);
            $('.FoodTypeViewModelText').text(DayaSubType);
            $('.Request_exercise_viewImg').attr('src', DataImg);
            $('.EditImagePathE').attr('src', DataImg);

            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-view_id");
            var table = 'master_exercise_request';
            if (edit_value != "") {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('exercise_view'); ?>",
                    data: {
                        action: 'view',
                        view_id: edit_value,
                        table: table
                    },
                    success: function (res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        console.log(response);
                        $('.EDITfoodtypename').val(response[0].requestsubtype);
                        $('.EDITfoodtypename1').val(response[0].requesttype);

                        $('.insertfoodtype').attr('DataId', response[0].id);
                        $('.insertfoodtype1').attr('DataId', response[0].id);

                
                        var img_name = response[0].e_image;

                        var duration = response[0].duration;
                        if (img_name != '' && img_name != 'undefined') {
                            var img_name = response[0].e_image;
                        } else {
                            var img_name = 'nofoodphotoimage-removebg-preview.png';
                        }
                        var img_path = '<?= site_url('assets/images/food_type/'); ?>';
                        $('#request_approve').attr('DataId', response[0].id);

                        $('.delete-btn1').attr('DataId', response[0].id);
                        $('.EditModelExcerciseserequest').attr('DataEditId', response[0].id);

                        $('.DeleteBtnClassExercise').attr('DataDeleteId', response[0].id);
                        $('#Request_exercise_view #e_name_view').text(response[0].e_name);
                        $('#Request_exercise_view #e_rep_view').text(response[0].e_rep);
                        $('#Request_exercise_view #e_calories_view').text(response[0].e_calories);
                        $('#exercise_submit_btn').attr('data-edit_id', response[0].id);
                        $('#Request_exercise_view #view__duration').text(duration);
                        var requestsubtype = response[0].requestsubtype;
                            if (isNaN(requestsubtype)) {
                            // $('#Request_exercise_view #e_subtype_view').text(requestsubtype);
                            $('.foodtypeEdit').show();
                            } else {
                            $('.foodtypeEdit').hide();
                            $('.EDITfoodtypename').val(requestsubtype);
                            // $('#Request_exercise_view #e_subtype_view').text(requestsubtype);
                            }
                            var requesttype = response[0].requesttype;
                            if (isNaN(requesttype)) {
                            $('.foodtypeEdit1').show();
                            } else {
                            $('.foodtypeEdit1').hide();
                            $('.EDITfoodtypename1').val(requesttype);
                            }
                        $('.selectpicker').selectpicker('refresh');
                    },
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });

        $('body').on('click', '.EditExerciseSubTypeClass', function () {
        var EditId = $(this).attr('data-edit_id');
        $('.DeleteBtnDiv').attr('DataDeleteId', EditId);
        $('.ExerciseSubtypeUpdateClass').attr('data-edit_id', EditId);
        $('.Add_editModelTitle').text('Edit Exercise Sub Type');
        $('.delete_main').show();
        $('.ExerciseSubtypeUpdateClass').show();
        $('.CommenSaveBtnInsert').hide();
        $('.CancleBtn').hide();
        var DataExerciseType = $(this).attr('DataExerciseType');
        var DataExerciseSubType = $(this).attr('DataExerciseSubType');
        $('.ExerciseSubTypeInput').val(DataExerciseSubType);
        $('.ExerciseTypeClassDropdown').val(DataExerciseType);
        $('.selectpicker').selectpicker('refresh');
    })
    $('body').on('click', '.AddExcerciseSubTypeClassModel', function () {
        $('.ExerciseSubTypeInput').val('');
        $('.ExerciseTypeClassDropdown').val('');
        $('.ExerciseTypeClassDropdown').selectpicker('refresh');
        $('.subtypeDiv').removeClass('was-validated');
        $('.delete_main').hide();
        $('.ExerciseSubtypeUpdateClass').hide();
        $('.CommenSaveBtnInsert').show();
        $('.CancleBtn').show();
    });
    //excercise add
    $('body').on('click', '#exercise_submit_btn1', function(e){
        e.preventDefault();
        var form = $("form[name='exercises_submit1']")[0];
        var table = 'master_exercise_request';
        var name = $('#e_name').val();
        // var subtype = $('.ExcercisesDropDownClass').val();
        var rep = $('.REPsdiv').val();

        var subtype = $('select.ExcercisesDropDownClass option:selected').val();
        var selectedId = $('.ExcercisesDropDownClass option:selected').data('id');

        var calories = $('.CALAREIESdiv').val();


        var duration = $('.Duretionclass').val();
        var e_type = $('.ExerciseTypeInputClass').val();
      
        
        var DurRepStatus = 0;

        if($(".RepNdDurStatus").prop('checked') == false){
            DurRepStatus = 0;
        }
        else
        { 
            DurRepStatus = 1;
        }

        var image = $('#e_image').prop('files')[0];
        var edit_id = $('#exercise_submit_btn').attr("data-edit_id");

        if (rep != ""  ) {
            var form = $('form[name="exercises_submit1"]')[0];
            // console.log(form);
            var formdata = new FormData(form);
            formdata.append('table', table);
            formdata.append('e_name', name);
            formdata.append('id', selectedId);
            formdata.append('e_subtype', subtype);
            formdata.append('e_rep', rep);
            formdata.append('duration', duration);
            formdata.append('e_calories', calories);
            formdata.append('e_image', image);
            formdata.append('action', 'insert');
            formdata.append('DurRepStatus', DurRepStatus);
            formdata.append('e_type', e_type);


            if (edit_id == '') {
                $.ajax({
                    method: "post",
                    url: "<?= site_url('excercise_insert_data'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res != "error") {
                            ExerciseAllListData();
                            $("form[name='exercises_submit']")[0].reset();
                            $(".modal-close-btn").trigger("click");
                            $("form[name='exercises_submit']").removeClass("was-validated");
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                            $('.selectpicker').selectpicker('refresh');
                        } else {
                            $("form[name='exercises_submit']")[0].reset();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                            $("form[name='exercises_submit']").addClass("was-validated");
                        }
                        ExerciseAllListData();
                    },
                });
            } else {


                var form1 = $('.GetEditImageForm')[0];
                var formdata1 = new FormData(form1);


                var formdata = new FormData(form);
                var table = 'master_exercise_request';
                var duration = $('#duration').val();
                var name = $('.ExcerciseNameInputClass').val();
                formdata.append('action', 'update');
                formdata.append('edit_id', edit_id);
                formdata.append('table', table);
                // formdata.append('e_subtype', subtype);
                // formdata.append('e_rep', rep);
                // formdata.append('e_calories', calories);
                // formdata.append('duration', duration);
                // formdata.append('DurRepStatus', DurRepStatus);
                // formdata.append('e_type', e_type);
                name = $('.RExcerciseNameInputClass').val();
                subtype = $('select.MainSubTypeClassDD option:selected').val();
                e_type = $('select.MainTypeClassDD option:selected').val();
                e_rep = $('.TRepClass').val();
                duration = $('.TDurClass').val();
                e_calories = $('.TCALAREIESdiv').val();

                var ExerciseTypeClassDropdownEdit = e_type;
                var subtypetest = /^[0-9]+$/.test(subtype) ? 1 : 0;
                var resultB = /^[0-9]+$/.test(ExerciseTypeClassDropdownEdit) ? 1 : 0;
                var FNoESub = '';
                var FAlpaSub = '';
                var FSubTypeD =  '';
                var Fname = name;
                var FDurRepStatus = DurRepStatus;
                var Fduration = duration;
                var Fcal = e_calories;
                var Frep = e_rep;

                if(subtypetest == '1' ){
                     FNoESub = subtype;
                     FAlpaSub = '';

                     FSubTypeD = '';
                }else{
                     FNoESub = '';
                     FAlpaSub = subtype;
                     FSubTypeD =  ExerciseTypeClassDropdownEdit;
                }    

                formdata.append('e_subtype', FNoESub);
                formdata.append('e_type', FNoESub);
                formdata.append('e_name', Fname);
                formdata.append('e_rep', Frep);
                formdata.append('e_calories', Fcal);
                formdata.append('duration', Fduration);
                formdata.append('DurRepStatus', FDurRepStatus);
                formdata.append('requestsubtype', FAlpaSub);
                formdata.append('requesttype', FSubTypeD);
                
                //22012024


                
                formdata1.append('action', 'update');
                formdata1.append('edit_id', edit_id);
                formdata1.append('table', table);
                formdata1.append('e_subtype', FNoESub);
                formdata1.append('e_type', FNoESub);
                formdata1.append('e_name', Fname);
                formdata1.append('e_rep', Frep);
                formdata1.append('e_calories', Fcal);
                formdata1.append('duration', Fduration);
                formdata1.append('DurRepStatus', FDurRepStatus);
                formdata1.append('requestsubtype', FAlpaSub);
                formdata1.append('requesttype', FSubTypeD);


                $('.loader').hide();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('excercise_update_data'); ?>",
                    data: formdata1,
                    processData: false,
                    contentType: false,
                    // data: {
                    //     'action':'update',
                    //     'edit_id': edit_id,
                    //     'table':table,
                    //     'e_subtype':FNoESub,
                    //     'e_type':FNoESub,
                    //     'e_name':Fname,
                    //     'e_rep':Frep,
                    //     'e_calories':Fcal,
                    //     'duration':Fduration,
                    //     'DurRepStatus':FDurRepStatus,
                    //     'requestsubtype':FAlpaSub,
                    //     'requesttype':FSubTypeD
                    // },
                    success: function (res) {
                        if (res != "error") {
                            $("form[name='exercises_submit']")[0].reset();
                            $("form[name='exercises_submit']").removeClass("was-validated");
                            $(".btn-cancel").trigger("click");
                            iziToast.success({
                                title: 'update Successfully'
                            });
                            ExerciseAllListData();
                        }
                        else {
                            $("form[name='exercises_submit']")[0].reset();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                        }
                    },
                });
            }
        } else {
            $("form[name='exercises_submit']").addClass("was-validated");
        }
        return false;
    });
    

    


    
    $('body').on('click', '#exercise_submit_btn', function(e){
        e.preventDefault();
        var form = $("form[name='exercises_submit']")[0];
        var table = 'master_exercise';
        var name = $('.ExcerciseNameInputClass').val();
        var subtype = $('select.ExcercisesDropDownClass option:selected').val();
        var rep = $('#e_rep').val();

        var selectedId = $('.ExcercisesDropDownClass option:selected').data('id');
        var calories = $('#e_calories').val();
        var duration = $('#duration').val();

        

        var image = $('#e_image').prop('files')[0];
        var edit_id = $('#exercise_submit_btn').attr("data-edit_id");
        if (name != ""  && subtype != '' ) {
            var form = $('form[name="exercises_submit"]')[0];
            var formdata = new FormData(form);
            formdata.append('table', table);
            formdata.append('e_name', name);
            formdata.append('id', selectedId);
            formdata.append('e_subtype', subtype);
            formdata.append('e_rep', rep);
            formdata.append('duration', duration);
            formdata.append('e_calories', calories);
            formdata.append('e_image', image);
            formdata.append('action', 'insert');
            if (edit_id == '') {
                $.ajax({
                    method: "post",
                    url: "<?= site_url('excercise_insert_data_master'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res != "error") {
                            ExerciseAllListData();
                            $("form[name='exercises_submit']")[0].reset();
                            $(".modal-close-btn").trigger("click");
                            $("form[name='exercises_submit']").removeClass("was-validated");
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                            $('.selectpicker').selectpicker('refresh');
                        } else {
                            $("form[name='exercises_submit']")[0].reset();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                            $("form[name='exercises_submit']").addClass("was-validated");
                        }
                        ExerciseAllListData();
                    },
                });
            } else {
                var formdata = new FormData(form);
                var table = 'master_exercise';
                var duration = $('#duration').val();
      
      
    
                formdata.append('action', 'update');
                formdata.append('edit_id', edit_id);
                formdata.append('table', table);
                formdata.append('e_name', name);
                // formdata.append('id', selectedId);
                formdata.append('e_subtype', subtype);
                formdata.append('e_rep', rep);
                formdata.append('e_calories', calories);
                formdata.append('duration', duration);
                $('.loader').hide();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('excercise_update_data_master'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res != "error") {
                            $("form[name='exercises_submit']")[0].reset();
                            $("form[name='exercises_submit']").removeClass("was-validated");
                            $(".btn-cancel").trigger("click");
                            iziToast.success({
                                title: 'update Successfully'
                            });
                            ExerciseAllListData();
                        }
                        else {
                            $("form[name='exercises_submit']")[0].reset();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                        }
                    },
                });
            }
        } else {
            $("form[name='exercises_submit']").addClass("was-validated");
        }
        return false;
    });
        // delete data
        $(document).ready(function () {
            // $(".delete-btn").click(function (e) {
            //     // alert("hello");
            //     var table = '<?php echo $table_username . '_exercise'; ?>';
            //     e.preventDefault();
            //     //var self = $(this).closest("tr");
            //     var id = $(this).attr("data-delete_id");
            //     // console.log(id);
            //     // die();
            //     $.ajax({
            //         method: "post",
            //         url: "<?= site_url('delete_data'); ?>",
            //         data: {
            //             action: 'delete',
            //             id: id,
            //             table: table
            //         },
            //         success: function (data) {
            //             ExerciseAllListData(); iziToast.error({
            //                 title: 'Delete successfully'
            //             });
            //         }
            //     });
            // });
        });
        // checkbox delete  2023
        $('body').on('click', '.deleted-all', function () {
            var checkbox = $(this).closest(".main-check-class").find('.checkbox:checked');
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
                var table = $(".table_value_picker").val();
                table = '<?php echo $table_username; ?>_' + table;
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
                            url: "<?= site_url('delete_all_WithoutUsername'); ?>",
                            method: "post",
                            data: {
                                action: 'delete',
                                checkbox_value: checkbox_value,
                                table: table,
                            },
                            success: function (data) {
                                console.log(data);
                                $(checkbox).closest("tr").fadeOut();
                                iziToast.error({
                                    title: 'Delete Successfully'
                                });
                                ExerciseAllListData();
                            }
                        });
                    } else {
                        $('.table_list_check').prop('checked', false);
                        $('.select-all-sms').prop('checked', false);
                        $(".deleted-all").hide();
                    }
                });
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        //list data
        // function datatable_view(html) {
        //         $('#exercise_sub_list').html(html);
        // }



    $(document).ready(function () {
        if ($("#filter-showw").html() == "") {
            $('#clear').hide();
        }
        $('#clear').hide();
        $('#filter-btn').click(function () {
            $('#clear').hide();
        })
        var fileter = true;
        $(".filter_data input,.filter_data select").change(function () {// 
            $('#clear').show();
            var selectedid = $(this).attr("id");
            if ($("." + selectedid).length > 0) {
                fileter = false;
            } else {
                fileter = true;
            }
            var selectedOption1 = $(this).val();
            if (fileter == true) {
                $("#filter-showw").append('<p class="f_btn ' + selectedid + '" data-id="' + selectedid + '" style="padding: 4px 8px; margin: 0px 4px;">\u2716 ' + selectedOption1 + '</p>');
                var f_btn = $('.f_btn');
                if (f_btn !== '') {
                    $('.filter-main').css('margin', '5px 0px 8px 0');
                }
            } else {
                $("#filter-showw ." + selectedid).text('\u2716 ' + selectedOption1);
            }
        });
        $('body').on('click', '#filter-showw p', function () {
            var selectedid = $(this).attr("data-id");
            $("#" + selectedid).val("");
            $('.filter-main').css('margin', '10px 0');
            $(this).text("").css("padding", "0px 0px").css("margin", "0px 0px");
            $(this).remove();
            $('.selectpicker').selectpicker('refresh');
            if ($("#filter-showw").html() == "") {
                $('#clear').hide();
            }
        });
        $("#clear").click(function () {
            $(".filter-show").html("");
            $('#clear').hide();
            $('.filter_data input').val("");
            $('.filter_data select').val("");
            $('.filter-main').css('margin', '0px');
            $('.selectpicker').selectpicker('refresh');
            return false;
        });
    });
        function datatable_view(html) {
            //table id
            $('#exercise_sub_table').DataTable().destroy();
            $('#exercise_sub_list').html(html);
            var table1 = $('#exercise_sub_table').DataTable({
                lengthChange: true,
            });
        }
        $('.PlusBtnExcerciseType').click(function (e) {
            $('.EditTitleExerciseTypeClass').text('Add Exercise Type');
            $('.DeleteDivExcerciseType').hide();
            $('.CancleBtn').show();
            $('.UpdateBtnExerciseType').hide();
            $('.SaveBtnClassExcerciseType').show();
            $('.ExerciseTypeInputClass').val('');
            $(".ExerciseAddFormClass").removeClass("was-validated");
        });
        $('body').on('click', '.EditRecordExerciseType', function () {
            var DataType = $(this).attr('DataType');
            var EditId = $(this).attr('data-edit_id');
            $('.DeleteBtnExcerciseTypeClass').attr('DataDeleteId', EditId);
            $('.ExerciseTypeInputClass').val(DataType);
            $('.UpdateBtnExerciseType').attr('data-edit_id', EditId);
            $('.SaveBtnClassExcerciseType').hide();
            $('.UpdateBtnExerciseType').show();
            $('.CancleBtn').hide();
            $('.DeleteDivExcerciseType').show();
            $('.EditTitleExerciseTypeClass').text('Edit Exercise Type');
        });
        //excercise add
        // $('.SaveBtnDiv').on('click', function (e) {
        //     // alert("hello");
        //     event.preventDefault();
        //     var e_subtype = $('.ei_type').val();
        //     var e_type = $('#ex_type').val();
        //     // alert(e_type);
        //     var table = '<?php
        //  echo $table_username . '_exercise_sub_type'; 
        ?>';
        //     // console.log(e_subtype);
        //     // console.log(e_type);
        //     // die();
        //     // insert
        //     if (e_subtype != "" && e_type != "") {
        //         $.ajax({
        //             method: "post",
        //             url: "insert_data",
        //             data: {
        //                 e_type: e_type,
        //                 e_subtype: e_subtype,
        //                 table: table,
        //                 action: "insert",
        //             },
        //             success: function (res) {
        //                 // console.log(data);
        //                 if (res == 0) {
        //                     ExerciseAllListData(); $(".subtypeDiv")[0].reset();
        //                     $(".modal-close-btn").trigger("click");
        //                     $(".subtypeDiv").removeClass("was-validated");
        //                     iziToast.success({
        //                         title: 'Added Successfully'
        //                     });
        //                     $('.selectpicker').selectpicker('refresh');
        //                 }
        //                 else {
        //                     $('.loader').hide();
        //                     $(".modal-close-btn").trigger("click");
        //                     $(".subtypeDiv")[0].reset();
        //                     iziToast.error({
        //                         title: 'Duplicate data'
        //                     });
        //                     $(".subtypeDiv").addClass("was-validated");
        //                     ExerciseAllListData();                            // window.location.reload();
        //                 }
        //             }
        //         });
        //     } else {
        //         $(".subtypeDiv").addClass("was-validated");
        //     }
        // });
        //edit
        //update
        //delete
        $(document).ready(function () {
            $('body').on('click', '.CommenBtnDeleteClass', function () {
                DataDeleteId = $(this).attr('DataDeleteId');
                DataTableName = $(this).attr('DataTableName');
                if(DataDeleteId != '' && DataTableName != ''){
                    $.ajax({
                        method: "post",
                        url: "delete_data_secound_db",
                        data: {
                            action: 'delete',
                            id: DataDeleteId,
                            table: DataTableName,
                        },
                        success: function (data) {
                            ExerciseAllListData();
                            iziToast.error({
                                title: 'Delete successfully'
                            });
                        },
                        error: function (error) {
                            $('.loader').hide();
                        }
                    });
                }
            });
        });
        //checkbox delete
    });
</script>
<script>

    // 9997
    //<!-- SMS/WhatApp/Email Table Name Get Jquery Start =================================================================== -->
    const buttons = document.querySelectorAll(".nav-link");
    buttons.forEach(button => {
        button.addEventListener("click", function () {
            buttons.forEach(btn => {
                btn.classList.remove("active");
            });
            button.classList.add("active");
            if (button.id === "ExerciseTypeId") {
                var table_name = $(this).attr("data-table");
                var DataStatus = $(this).attr('DataStatus');
                // console.log(table_name);
                $("#table_value_picker").val(table_name);
                $("#table_value_picker").attr('DataStatus', DataStatus);
            } else if (button.id === "ExerciseSubTypeId") {
                var table_name = $(this).attr("data-table");
                // console.log(table_name);
                var DataStatus = $(this).attr('DataStatus');
                $("#table_value_picker").val(table_name);
                $("#table_value_picker").attr('DataStatus', DataStatus);
            } else if (button.id === "ExerciseMasterId") {
                var table_name = $(this).attr("data-table");
                // console.log(table_name);
                var DataStatus = $(this).attr('DataStatus');
                $("#table_value_picker").val(table_name);
                $("#table_value_picker").attr('DataStatus', DataStatus);
            }
        });
    });
    //<!-- SMS/WhatApp/Email Table Name Get Jquery End ===================================================================== -->
    function datatable_view_email(html) {
        $('.BodyDivCommen').html('');
        // $('.TableNameListData').DataTable().destroy();
        $('.BodyDivCommen').html(html);
        // var table1 = $('.TableNameListData').DataTable({
        //     lengthChange: true,
        // });
    }


    


    //5555
    var defaultTable = $(".table_value_picker").val();
    var defaultTable = 'master_' + defaultTable;
    // console.log(table);
    function ExerciseAllListData(table = defaultTable, pageNumber = 1, perPageCount = 10, formdata = "", action = true) {

        $('.loader').show();
        var table = $(".table_value_picker").val();
        var table = 'master_' + table;

        if(table == "master_request"){
            var table = $(".table_value_picker").val();
            var table = 'master_exercise_' + table; 
        }


        var DataStatus = $('.table_value_picker').attr('DataStatus');
        var ExcerciseMasterId = $('.ExerciseMasterFilterIdClass').val();
        var ExerciseMasterName = $('.ExerciseMasterFilterNameClass').val();
        var ExerciseMasterSubType = '';
        $('.ExerciseMasterFilterSubTypeClass :selected').each(function () {
            if (ExerciseMasterSubType !== "") {
                ExerciseMasterSubType += ",";
            }
            ExerciseMasterSubType += $(this).attr('dataTypeId');
        });

        perPageCount = $('#project_length_show').val();
        // var ajaxsearch = $('.search_value').val();
        // var formdata = new FormData();


        if ($.trim($(".filter-show").html()) == '') {
            var data = {
                'table': table,
                'pageNumber': pageNumber,
                'perPageCount': perPageCount,
                'ListDataStatus': DataStatus,             
                'action': action,
            }
            if (DataStatus == '3') {
                data['ExcerciseMasterId'] = ExcerciseMasterId;
                data['ExerciseMasterName'] = ExerciseMasterName;
                data['ExerciseMasterSubType'] = ExerciseMasterSubType;
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
            url: "<?= site_url('ExerciseListData'); ?>",
            data: data,  
            processData: processdd,
            contentType: contentType,
            success: function (res) {
                $('.loader').hide();
                var response = JSON.parse(res);

                if (response.response == 1) {
                    datatable_view_email(response.html);

                    // $('.row_count_div').html(response.row_count_html);
                    if (response.total_page == 0 || response.total_page == '') {
                        total_page = 1;
                    } else {
                        total_page = response.total_page;
                    }
                    $('.row_count_div').html(response.row_count_html);
                    if(response.ExerciseType != ''){
                        $('.DoupDownMenuExercisetypeClass').html(response.ExerciseType);
                    }
                    if(response.ExerciseSubType != ''){
                        $('.ExerciseSubTypeDropDownHtmlSet').html(response.ExerciseSubType);
                    }

                    $('.member_pagination').twbsPagination({
                        totalPages: total_page,
                        visiblePages: 2,
                        next: '>>',
                        prev: '<<',
                        onPageClick: function(event, page) {
                            ExerciseAllListData(table, page, perPageCount);
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
    ExerciseAllListData();
    
    // $('body').on('click', '.nav-link', function () {
    //     ExerciseAllListData();
    // });

    $('body').on('click', '.filtersTitle', function(){
        ExerciseAllListData();
    });


    //tab wise list
    $('body').on('click', '.nav-item button', function(e) {
        var perPageCount = $('#project_length_show').val();
        // console.log(perPageCount);
        var defaultTable = $(".table_value_picker").val();
        var defaultTable = 'master_' + defaultTable;

        $(".nav-item button").removeClass("active");
        $(this).addClass("active");
        var DataStatus = $('.table_value_picker').attr('DataStatus');
        $('.member_pagination').twbsPagination('destroy');
        ExerciseAllListData(defaultTable, '', 1, perPageCount);
    });

    //pagination show records
    $('body').on('change', '#project_length_show', function() {
        var perPageCount = $(this).val();
        var defaultTable = $(".table_value_picker").val();
        var defaultTabled = 'master_' + defaultTable;
        // console.log(defaultTable);
        $('.member_pagination').twbsPagination('destroy');

        ExerciseAllListData(defaultTable, '', 1, perPageCount)
    });


    //pagination search
    $('#project_filter input[type="search"]').on('input', function() {
        var input = $(this).val().toLowerCase();
        var table = $('.TableNameListData');
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


    $('body').on('click', '.CommenSaveBtnInsert', function () {
        // alert();
        var DataInsertStatus = $(this).attr('DataInsertStatus');
        var table = $(this).attr('DataTableName');
        var formdata = new FormData();
        formdata.append('action', 'insert');
        formdata.append('table', table);
        var InsertAjaxCondition = 0;
        if (DataInsertStatus != '') {
            if (DataInsertStatus == '1') {
                var e_type = $('.ExerciseTypeInputClass').val();
                if (e_type != '') {
                    InsertAjaxCondition = 1;
                    formdata.append('e_type', e_type);
                } else {
                    $(".ExerciseAddFormClass").addClass("was-validated");
                }
            }
            if (DataInsertStatus == '2') {
                var e_type = $('.ExerciseSubTypeInput').val();
                var e_subtype = $('select.ExerciseTypeClassDropdown option:selected').val();
                if (e_type != '' && e_subtype != '') {
                    InsertAjaxCondition = 1;
                    formdata.append('e_type', e_type);
                    formdata.append('e_subtype', e_subtype);
                } else {
                    $(".ExcerciseSubTypeClassForm").addClass("was-validated");
                }
            }
            if (DataInsertStatus == '3') {
            }
            if (InsertAjaxCondition != '0') {
                $.ajax({
                    method: "post",
                    url: 'insert_data_2DB',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res == 0) {
                            ExerciseAllListData();
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                            if (DataInsertStatus == '1') {
                                $('.ExerciseTypeInputClass').val('');
                                $('.close_btn').trigger('click');
                            }
                            $('.close_btn').trigger('click');
                        }
                        else {
                            $('.loader').hide();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                            ExerciseAllListData();
                            if (DataInsertStatus == '1') {
                                $('.ExerciseTypeInputClass').val('');
                                $('.close_btn').trigger('click');
                            }
                            $('.close_btn').trigger('click');
                        }
                    }
                });
            }
        }
    });
    // $('body').on('click', '.CommenUpdateBtnUpdate', function(e){
    //     e.preventDefault();
    //     // alert();
    // });
    $('body').on('click', '.CommenUpdateBtnUpdate', function (e) {
        e.preventDefault();
        // alert(); 6666
        var DataUpdateStatus = $(this).attr('DataUpdateStatus');
        var table = $(this).attr('DataTableName');
        var DataEditId = $(this).attr('data-edit_id');
        var formdata = new FormData();
        formdata.append('action', 'update');
        formdata.append('table', table);
        var UpdateAjaxCondition = 0;
        if (DataUpdateStatus != '' && DataEditId != '') {
            formdata.append('edit_id', DataEditId);
            if (DataUpdateStatus == '1') {
                var e_type = $('.ExerciseTypeInputClass').val();
                if (e_type != '') {
                    UpdateAjaxCondition = 1;
                    formdata.append('e_type', e_type);
                } else {
                    $(".ExerciseAddFormClass").addClass("was-validated");
                }
            }
            if (DataUpdateStatus == '2') {
                var e_type = $('.ExerciseSubTypeInput').val();
                var e_subtype = $('select.ExerciseTypeClassDropdown option:selected').val();
                if (e_type != '' && e_subtype != '') {
                    UpdateAjaxCondition = 1;
                    formdata.append('e_type', e_type);
                    formdata.append('e_subtype', e_subtype);
                } else {
                    $(".ExcerciseSubTypeClassForm").addClass("was-validated");
                }
            }
            if (DataUpdateStatus == '3') {
            }
            if (UpdateAjaxCondition != '0') {
                $.ajax({
                    method: "post",
                    url: "update_data_2DB",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        // if (res != "error") {
                            // $(".subtypeDiv")[0].reset();
                            // console.log(res);
                            ExerciseAllListData();
                            iziToast.success({
                                title: 'Update Successfully'
                            });
                            $('.close_btn').trigger('click');
                            // ExerciseAllListData();
                        // } else {
                        //     $('.loader').hide();
                        //     $(".modal-close-btn").trigger("click");
                        //     iziToast.error({
                        //         title: 'Duplicate data'
                        //     });
                        // }
                        $('.loader').hide();
                    },
                    error: function (error) {
                        $('.loader').hide();
                    }
                });
            }
        }
    }); 


    $('body').on('click', '.insertfoodtype', function () {
                     var DataId = $(this).attr('DataId');

                              $.ajax({
                                   method: "post",
                                   url: "<?= site_url('master_foodtype_update'); ?>",
                                   data: {
                                        action: 'update',
                                        id: DataId,
                                        request_status: 1,
                                        table: 'master_exercise_request'
                                   },
                                   success: function(data) {
                                        $.ajax({
                                             method: "post",
                                             url: "<?= site_url('master_exercisetype_update_insert'); ?>",
                                             data: {
                                                  action: 'update',
                                                  id: DataId,
                                                  request_status: 1,
                                                  table: 'master_exercise_request'
                                             },
                                             success: function(res) {

                                                
                                                  $.ajax({
                                                  method: "post",
                                                  url: "<?= site_url('exercisetype_delete_data'); ?>",
                                                  data: {
                                                       action: 'delete',
                                                       id: DataId,
                                                       setdata:res,
                                                       table: 'master_exercise_request'
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


                 $('body').on('click', '.insertfoodtype1', function () {
                     var DataId = $(this).attr('DataId');

                              $.ajax({
                                   method: "post",
                                   url: "<?= site_url('master_foodtype_update'); ?>",
                                   data: {
                                        action: 'update',
                                        id: DataId,
                                        request_status: 1,
                                        table: 'master_exercise_request'
                                   },
                                   success: function(data) {
                                        $.ajax({
                                             method: "post",
                                             url: "<?= site_url('master_exercisesubtype_update_insert'); ?>",
                                             data: {
                                                  action: 'update',
                                                  id: DataId,
                                                  request_status: 1,
                                                  table: 'master_exercise_request'
                                             },
                                             success: function(res) {

                                                  $.ajax({
                                                  method: "post",
                                                  url: "<?= site_url('subtypetype_delete_data'); ?>",
                                                  data: {
                                                       action: 'delete',
                                                       id: DataId,
                                                       setdata:res,

                                                       table: 'master_exercise_request'
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


   
    $('body').on('click', '.EditModelExcercisesClass', function (e) {
        e.preventDefault();
        $('.ExcerciseModelTitleClass').text('Edit Exercise');

        var table = 'master_exercise';
        var edit_value = $(this).attr("DataEditId");
       
       
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
                    console.log(response);
                    var img_name = response[0].e_image;
                    var img_path = '<?= site_url('assets/images/food_type/'); ?>';

                    var duration = response[0].duration;
                    // var timeZone = "<?php echo ""; ?>";
                    // var inputFormat = "HH:mm:ss"; 
                    // var utcTime = GetCurrentTimezoneTime(duration, inputFormat, timeZone);

                    $(".ExcerciseNameInputClass").val(response[0].e_name);
                    $("#exercises-add #e_type").val(response[0].e_type);
                    $("#exercises-add #e_subtype").val(response[0].e_subtype);
                    // var requestType = response[0].requestype;

                        // if (isNaN(requestType)) {
                        // $('.FoodTypeViewModelText').text(requestType);
                        // $('.foodtypeEdit').show();
                        // } else {
                        // $('.foodtypeEdit').hide();
                        // $('.EDITfoodtypename').val(requestType);

                        // }

                    setTimeout(function() {
                        $('.ExcercisesDropDownClass').selectpicker('refresh');
                    }, 500);
                    $("#exercises-add #e_rep").val(response[0].e_rep);
                    $("#exercises-add #e_calories").val(response[0].e_calories);


                    $("#exercises-add #duration").val(duration);

                    $("#exercises-add #img_food").attr('src', img_path + img_name);
                    $("#exercises-add #e_image").val(response[0].e_image);
                    $('#exercise_submit_btn').attr('data-edit_id', response[0].id);
                    $('#deleterecord').attr('data-delete_id', response[0].id);
                    $('.deleted-all').attr('data-delete_id', response[0].id);
                    $('#exercie_delete').attr('DataDeleteId', response[0].id);
                },
                error: function (error) {
                    $('.loader').hide();
                }
            });
        }
    });

    $('body').on('click', '.EditModelExcerciseserequest', function (e) {
        e.preventDefault();

        $('.ExcerciseModelTitleClass').text('Edit Exercise');

        var table = 'master_exercise_request';
        var edit_value = $(this).attr("DataEditId");

       
        if (edit_value != "") {
            $('.loader').hide();
            $.ajax({
                type: "post",
                url: "<?= site_url('ExerciseViewData'); ?>",
                data: {
                    action: 'edit',
                    edit_id: edit_value,
                    table: table
                },
                success: function (res) {
                    $('.loader').hide();
                    var response = JSON.parse(res);

                    $(".RExcerciseNameInputClass").val(response[0].e_name);

                    if(response[0].SubTypeDDHtml != ''){
                        $('.SubTypeHtmlDDSet').html(response[0].SubTypeDDHtml);
                        $('.selectpicker').selectpicker('refresh');
                    }


                    if(response[0].ETypeDDHtml != ''){
                        $('.SUSUSTypeClass').html(response[0].ETypeDDHtml);
                        $('.selectpicker').selectpicker('refresh');
                        $('.MainTypeClassDD').val(response[0].requesttype);
                        $('.MainTypeClassDD').selectpicker('refresh');

                    }

                    var DurRepStatus = response[0].DurRepStatus;
                     if(DurRepStatus == '1'){
                         $( ".RepNdDurStatus").prop('checked', true);
                     }else{
                         $( ".RepNdDurStatus").prop('checked', false);
                     }
                     $('.insertfoodtype').attr('DataId', response[0].id);

                    var img_name = response[0].e_image;
                    var img_path = '<?= site_url('assets/images/food_type/'); ?>';

                    var duration = response[0].duration;
                    $('#request_approve').attr('DataId', response[0].id);
                    $('#delete').attr('DataId', response[0].id);
                    // $("#exercisesrequest-add .EXerciseevieww").text(response[0].requesttype);

                    // $("#exercisesrequest-add .EXerciseevieww").val(response[0].requesttype);
                    $("#exercisesrequest-add .ExcercisesDropDownClass").val(response[0].requestsubtype);


                    setTimeout(function() {
                        $('.ExcercisesDropDownClass').selectpicker('refresh');
                    }, 500);
                    $("#exercisesrequest-add #e_rep").val(response[0].e_rep);
                    $("#exercisesrequest-add #e_calories").val(response[0].e_calories);
                    

                    $("#exercisesrequest-add #duration").val(duration);

                    // $("#exercisesrequest-add #img_food").attr('src', img_path + img_name);
                    // $("#exercisesrequest-add #e_image").val(response[0].e_image);
                    $('#exercise_submit_btn1').attr('data-edit_id', response[0].id);
                    $('.deleted-all').attr('data-delete_id', response[0].id);
                    $('#exercie_delete').attr('DataDeleteId', response[0].id);
                    // console.log('Dishant');
                    if(response[0].e_subtype != ''){
                        // console.log(response[0].e_subtype);
                        $('.MainSubTypeClassDD').val(response[0].e_subtype);
                    }else{
                        if(response[0].requestsubtype != ''){
                            // console.log(response[0].requestsubtype);
                            $('.MainSubTypeClassDD').val(response[0].requestsubtype);
                        }
                    }
                    $('.MainSubTypeClassDD').selectpicker('refresh');
                },
                error: function (error) {
                    $('.loader').hide();
                }
            });
        }
    });

                $('body').on('click', '#exercie_delete', function() {
                    var DataId = $(this).attr('data-delete_id');

                  
                              $.ajax({
                                   method: "post",
                                   url: "<?= site_url('Food_delete_data'); ?>",
                                   data: {
                                        action: 'delete',
                                        id: DataId,
                                        table: 'master_exercise'
                                   },
                                   success: function(data) {
                                     
                                        ExerciseAllListData();

                                        $(".close_btn").trigger("click");

                                   }
                              });
                         });
                    

                         $('body').on('click', '.delete-btn1', function() {
                          var DataId = $(this).attr('DataId');

                  
                              $.ajax({
                                   method: "post",
                                   url: "<?= site_url('Food_delete_data'); ?>",
                                   data: {
                                        action: 'delete',
                                        id: DataId,
                                        table: 'master_exercise_request'
                                   },
                                   success: function(data) {
                                     
                                        ExerciseAllListData();

                                        $(".close_btn").trigger("click");

                                   }
                              });
                         });


    $('body').on('click', '#request_approve', function() {
        var DataId = $(this).attr('DataId');
            $.ajax({
                method: "post",
                url: "<?= site_url('master_exercise_update_insert'); ?>",
                data: {
                    action: 'update',
                    id: DataId,
                    request_status: 1,
                    table: 'master_exercise_request'
                },
                success: function(data) {
                    iziToast.success({
                            title: 'Approved Successfully'
                    });
                    ExerciseAllListData();
                },
                error: function(error) {
                    console.error("Error updating request status and inserting data:", error);
                }
            });
    });

    $('body').on('click', '.AddModelPlusBTNExcercisesClass', function (e) {
        $('.excerciseBtnTextClass').text('Add');
        $("form[name='exercises_submit']")[0].reset();
        $('.selectpicker').selectpicker('refresh');
        $("form[name='exercises_submit']").removeClass("was-validated");
        $("button#exercise_submit_btn").attr("data-edit_id", "");
        $("#img_food").hide();
    });
    $('body').on('click', '.item_name_modal_ul', function () {
        $('.foodtypeEditClassWise').show();
            $('.foodtypeEdit').removeClass('d-none');
    });

    $('.checkbox-apple input').click(function(){
        if($(this).is(':checked')){
            $('.Reps-input').addClass('d-none');
            $('.dur-input').removeClass('d-none');
        }
        else{
            $('.dur-input').addClass('d-none');
            $('.Reps-input').removeClass('d-none');
        }
    })

    $('body').on('click', '.option_add_select .item_name_modal_ul', function () {
        // alert(1);
        var add_option_id = $(this).closest(".option_add_select").find("select").attr("id");
        var add_option_search = $(this).closest(".option_add_select").find(".bs-searchbox input").val();

        var add_option_array = $("#" + add_option_id + " option").map(function () {
            console.log();
            return $(this).text();
        }).get();

        if (jQuery.inArray("" + add_option_search + "", add_option_array) == -1) {
            $("#" + add_option_id + "").append('<option value="' + add_option_search + '" selected>' + add_option_search + '</option>');
            $(".selectpicker").selectpicker("refresh");
        }

    });
    
    $('body').on('click', '.option_add_select', function () {
        $(this).find(".inner.show .item_name_modal_ul").remove();
        $(this).find(".inner.show").append('<ul class="item_name_modal_ul"><li ><a role="option" class="dropdown-item" aria-disabled="true" tabindex="-1" aria-selected="false" style="opacity: 1;"><span class="text" style="color: #000;">+ Add New</span></a></li></ul>');
        $(this).find(".dropdown-menu.inner.show .item_name_modal_ul").remove();
    });


    $("body").on('change', '.MainSubTypeClassDD', function() {
        var ESDropDown =  $('select.MainSubTypeClassDD option:selected').val();
        // 0 means alpha word
        // 1 means numeric 
        if(ESDropDown != ''){
            var subtypetest = /^[0-9]+$/.test(ESDropDown) ? 1 : 0;
            if(subtypetest == '1'){
                $('.foodtypeEditClassWise').hide();
            }else{
                $('.foodtypeEditClassWise').show();
            }
        }else{
            $('.foodtypeEditClassWise').hide();
        }
    });
    document.getElementsByClassName('EImageExerciseInput')[0].addEventListener('change', function(e) {
    var file = e.target.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementsByClassName('EImageExerciseInputImg')[0].src = e.target.result;
    };
    reader.readAsDataURL(file);  
});
document.getElementsByClassName('GetEditImageFormFileInput')[0].addEventListener('change', function(e) {
    var file = e.target.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementsByClassName('GetEditImageFormFileInputIMG')[0].src = e.target.result;
    };
    reader.readAsDataURL(file);
});
</script>