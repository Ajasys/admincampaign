<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<!-- header end -->
<?php $table_username = ''; ?>
<?php
$SecondDB = \Config\Database::connect('second');


?>
<style>
     .modal-p-history {
    max-width: 800px !important;
}

.day-diet-plane{
     font-size: 14px;
}

.deit-plane-heading {
     border: 1px solid #dee2e6;
}
.deit-plane-heading th , .deit-plane-heading td{
     padding: 05px 10px;
     border: 1px solid #dee2e6;   
}

.data-view-table{
     border-top: 0px !important;
     width: 1133px;
}
.data-view-table:first-child{
     border-top: 1px solid #dee2e6 !important;
}
.food-table tr:last-child{
     /* border-bottom: 0px !important; */
}
/* .food-table td{
     border: none;
} */
.food-table thead th{
     background-color: #d4c7f1;
}
.food-img{
     width: 20px;
     height: 20px;
}
.main-food-body{
     max-height: 500px;
}

.main-food-body::-webkit-scrollbar {
  width: 5px;
  height: 5px;
}
</style>
<div class="main-dashbord p-2 main-check-class">
     <div class="px-3 py-2 bg-white rounded-2 mx-2 m-2">
          <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
               <li class="nav-item Tab1Class" role="presentation">
                    <button class="nav-link active " id="pills-food-type" data-bs-toggle="pill"
                         data-bs-target="#pills-food-type-tab" type="button" role="tab" data-table="food"
                         aria-controls="pills-food-type-tab" aria-selected="false">Diet</button>
               </li>
               <li class="nav-item Tab2Class" role="presentation">
                    <button class="nav-link " id="pills-food-master" data-bs-toggle="pill"
                         data-bs-target="#pills-food-master-tab" type="button" role="tab"
                         data-table="<?php echo $table_username . '_food_type' ?>" aria-controls="pills-food-master-tab"
                         aria-selected="true">Diet Suggestions</button>
               </li>
          </ul>
     </div>
     <div class="container-fluid p-0">
          <div class="px-3 py-2 bg-white rounded-2 mx-2">
               <div class="col-12 d-flex justify-content-between align-items-center mb-2">
                    <div class="title-1 GeneratePDFSClass">
                         <i class="fa-solid fa-utensils"></i>
                         <h2>Diet</h2>
                    </div>
                    <div class="title-side-icons">
                         <div class="deleted-all">
                              <button class="btn-primary-rounded d-none" data-delete_id="">
                                   <i class="bi bi-trash3 fs-12"></i>
                              </button>
                         </div>
                         <button class="btn-primary-rounded d-none" type="button" data-bs-toggle="offcanvas"
                              data-bs-target="#f_dite" aria-controls="offcanvasRight" id="filter_diet">
                              <i class="bi bi-funnel fs-14"></i>
                         </button>
                         <button data-bs-toggle="modal" data-bs-target="#add-diet-plan" id="plus_btn"
                              class="btn-primary-rounded">
                              <i class="bi bi-plus"></i>
                         </button>
                    </div>
               </div>
               <div class="col-12 d-flex justify-content-between filter-main">
                    <div class="col-8 col-sm-9 filter-show d-flex grey-color flex-wrap align-items-center"
                         id="filter-showw" style="cursor: pointer;">
                    </div>
                    <div>
                         <button class="clear btn-del btn-primary" style="display:none" id="clear">Clear
                              All</button>
                    </div>
               </div>
               <table id="diet_plan_table"
                    class="w-100 master-diet-table main-table table comman_list_data_table no-footer dataTable"
                    aria-describedby="diet_plan_table_info" style="width: 1768px;">
                    <thead>
                         <tr>
                              <th style="width: 0%;" hidden="" class="sorting sorting_asc" tabindex="0"
                                   aria-controls="diet_plan_table" rowspan="1" colspan="1"
                                   aria-label="
                                             
                                        : activate to sort column descending: activate to sort column descending: activate to sort column descending" aria-sort="ascending">
                                   <input class="check_box select-all-sms" type="checkbox">
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="diet_plan_table" rowspan="1" colspan="1"
                                   aria-label="
                                             Master Diet Plan
                                        : activate to sort column ascending: activate to sort column ascending: activate to sort column ascending"
                                   style="width: 1756px;">
                                   <span>Master Diet Plan</span>
                              </th>
                         </tr>
                    </thead>
                    <tbody id="" class="SetHTMLDiv">
                         
                    </tbody>
               </table>
          </div>
     </div>
</div>
<p class="MasterViewDataClickClass" hidden data-bs-target="#Masterview_data" data-bs-toggle="modal"></p>

<div class="modal fade" id="Masterview_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header flex-wrap">
                    <h5 class="PlanNameViewText text-capitalize">Diet Plan</h5>
                    <div class="d-lg-block d-none ms-auto">
                         <div class="d-flex align-items-center flex-wrap ms-auto">
                              <div class="mx-3 my-1">
                                   <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#eae8e8" d="M455.667 53.932h-48.039V32.48c0-10.923-11.5-19.48-26.17-19.48-14.691 0-26.2 8.557-26.2 19.48v21.452H282.2V32.48C282.2 21.557 270.69 13 256 13s-26.2 8.557-26.2 19.48v21.452h-73.032V32.48c0-10.923-11.507-19.48-26.2-19.48s-26.2 8.557-26.2 19.48v21.452H56.361a31.817 31.817 0 0 0-31.782 31.781v381.505A31.819 31.819 0 0 0 56.361 499h399.306a31.8 31.8 0 0 0 31.754-31.782V85.713a31.8 31.8 0 0 0-31.754-31.781zM371.26 32.6c.49-1.05 4.17-3.6 10.2-3.6 6.012 0 9.682 2.554 10.17 3.6v21.332h-20.37zm-125.46.009C246.3 31.556 249.984 29 256 29s9.7 2.556 10.2 3.609v21.323h-20.4zm-125.43 0c.5-1.053 4.183-3.609 10.2-3.609s9.7 2.556 10.2 3.609v21.323h-20.4z" opacity="1" data-original="#eae8e8"></path><path fill="#484868" d="M238.12 205.162v35.914a8 8 0 0 1-8 8h-40.7a8 8 0 0 1-8-8v-35.914a8 8 0 0 1 8-8h40.7a8 8 0 0 1 8 8zm84.464-8h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm-184.9 87.871H96.952a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.733a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm92.435 0h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-7.999-8zm92.464 0h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-7.999-8zm-184.9 87.9H96.952a8 8 0 0 0-8 8v35.885a8 8 0 0 0 8 8h40.733a8 8 0 0 0 8-8v-35.884a8 8 0 0 0-8-8zm92.435 0h-40.7a8 8 0 0 0-8 8v35.885a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.884a8 8 0 0 0-7.998-8zm-92.433-175.771H96.952a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.733a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm277.363 87.871h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm-92.464 87.9h-40.7a8 8 0 0 0-8 8v35.885a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.884a8 8 0 0 0-8-8z" opacity="1" data-original="#484868"></path><g fill="#3d3d54"><path d="M137.685 197.162h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM230.12 372.934h-10a8 8 0 0 1 8 8v35.885a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.885a8 8 0 0 0-8-8zM230.12 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM137.685 372.934h-10a8 8 0 0 1 8 8v35.885a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.885a8 8 0 0 0-8-8zM137.685 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM322.584 372.934h-10a8 8 0 0 1 8 8v35.885a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.885a8 8 0 0 0-8-8zM322.584 197.162h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM230.12 197.162h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM415.048 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM322.584 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8z" fill="#3d3d54" opacity="1" data-original="#3d3d54"></path></g><path fill="#d22e2e" d="M389.649 246.78a8 8 0 0 1-5.632-2.318l-16.44-16.3a8 8 0 0 1 11.265-11.362l10.3 10.208 20.939-24.721a8 8 0 0 1 12.209 10.342l-26.532 31.322a8 8 0 0 1-5.758 2.821 8.334 8.334 0 0 1-.351.008z" opacity="1" data-original="#d22e2e" class=""></path><path fill="#d1c9c9" d="M417.446 473.242a8 8 0 0 1-5.658 2.345H56.361a31.819 31.819 0 0 1-31.782-31.782v23.413A31.819 31.819 0 0 0 56.361 499h399.306a31.8 31.8 0 0 0 31.754-31.782v-67.293a8 8 0 0 1-2.342 5.655z" opacity="1" data-original="#d1c9c9"></path><path fill="#bcb3b3" d="M487.421 399.925v-1.049h-60.48a16 16 0 0 0-16 16v60.711h.847a8 8 0 0 0 5.658-2.345l67.633-67.662a8 8 0 0 0 2.342-5.655z" opacity="1" data-original="#bcb3b3"></path><path fill="#d22e2e" d="M455.667 53.932H371.26v30.282c.47 1.05 4.138 3.619 10.2 3.619a8 8 0 0 1 0 16c-14.691 0-26.2-8.569-26.2-19.509V53.932H245.8v30.276c.478 1.054 4.151 3.625 10.2 3.625a8 8 0 0 1 0 16c-14.691 0-26.2-8.569-26.2-19.509V53.932H120.372v30.276c.478 1.054 4.151 3.625 10.2 3.625a8 8 0 0 1 0 16c-14.69 0-26.2-8.569-26.2-19.509V53.932H56.361a31.817 31.817 0 0 0-31.782 31.781v68.207h462.842V85.713a31.8 31.8 0 0 0-31.754-31.781z" opacity="1" data-original="#d22e2e" class=""></path><path fill="#d1c9c9" d="M24.579 153.92h462.842v12.492H24.579z" opacity="1" data-original="#d1c9c9"></path><path fill="#484868" d="M264 95.833a8 8 0 0 1-8 8c-14.691 0-26.2-8.569-26.2-19.509V32.48C229.8 21.557 241.309 13 256 13s26.2 8.557 26.2 19.48v21.452h-16V32.609C265.7 31.556 262.015 29 256 29s-9.7 2.556-10.2 3.609v51.6c.478 1.054 4.151 3.625 10.2 3.625a8 8 0 0 1 8 7.999zm-133.43-8c-6.047 0-9.72-2.571-10.2-3.625v-51.6c.5-1.053 4.183-3.609 10.2-3.609s9.7 2.556 10.2 3.609v21.324h16V32.48c0-10.923-11.507-19.48-26.2-19.48s-26.2 8.557-26.2 19.48v51.844c0 10.94 11.508 19.509 26.2 19.509a8 8 0 0 0 0-16zm250.888 0c-6.06 0-9.728-2.569-10.2-3.619V32.6c.49-1.05 4.17-3.6 10.2-3.6 6.012 0 9.682 2.554 10.17 3.6v21.332h16V32.48c0-10.923-11.5-19.48-26.17-19.48-14.691 0-26.2 8.557-26.2 19.48v51.844c0 10.94 11.507 19.509 26.2 19.509a8 8 0 0 0 0-16z" opacity="1" data-original="#484868"></path><path fill="#ad1e1e" d="M130.62 80.834a14.926 14.926 0 0 0-9.949 3.8c1.068 1.194 4.553 3.2 9.9 3.2a8 8 0 0 1 0 16 33.375 33.375 0 0 1-14.062-2.966 14.992 14.992 0 1 0 14.111-20.034zM256 80.834a14.925 14.925 0 0 0-9.921 3.771c1.039 1.191 4.535 3.228 9.921 3.228a8 8 0 0 1 0 16 33.362 33.362 0 0 1-14.123-2.994 14.992 14.992 0 1 0 14.123-20zM381.444 80.834a14.921 14.921 0 0 0-9.916 3.767c1.023 1.186 4.519 3.232 9.93 3.232a8 8 0 0 1 0 16 33.357 33.357 0 0 1-14.14-3 14.992 14.992 0 1 0 14.126-20z" opacity="1" data-original="#ad1e1e"></path></g></svg>
                                        <h6 class="mx-2 "><span class="PlanDurationViewText"></span> Days</h6>
                                   </div>
                              </div>
                              <div class="mx-3 my-1">
                                   <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#8164e1" d="m470.3 184.2-46.5-183-35.698 35.398C348.5 12.598 302.5 0 256 0 119.2 0 6.598 108.102.602 244.602L0 257.199l90.3 19.5-.3-18.597C89.098 165.398 164.8 90 256 90c22.5 0 45.098 4.5 65.8 13.2l-34.5 34.5zM422 237.398V256c0 91.8-76.3 166-166 166-22.2 0-44.098-4.5-64.5-13.2l33.3-33-184-47.1 47.098 183 36-36C163.5 499.397 209.801 512 256 512c136.5 0 249.102-107.5 255.398-243.7l.602-12.6c-6-1.2-87-17.7-90-18.302zm0 0" opacity="1" data-original="#64e1dc" class=""></path><g fill="#00c8c8"><path d="M321.8 103.2C301.099 94.5 278.5 90 256 90V0c46.5 0 92.5 12.598 132.102 36.598L423.8 1.199l46.5 183-183-46.5zM512 255.7l-.602 12.6C505.102 404.5 392.5 512 256 512v-90c89.7 0 166-74.2 166-166v-18.602c3 .602 84 17.102 90 18.301zm0 0" fill="#7927ff" opacity="1" data-original="#00c8c8" class=""></path></g></g></svg>
                                        <h6 class="mx-2 PlanRepetationViewText"></h6>
                                   </div>
                              </div>
                              <div class="mx-3 my-1">
                                   <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32" fill="none"><g clip-path="url(#clip0_1117_2)"><path d="M15.719 31.9995C8.94913 31.9995 3.44141 26.4784 3.44141 19.6921C3.44141 14.4142 5.84 9.70809 9.36168 5.84309C12.2581 2.66423 15.1248 0.913781 15.2454 0.840876C15.8808 0.45649 16.7336 0.980208 16.7336 1.68848V10.1196L21.0471 6.0937C21.4215 5.74421 22.0143 5.76841 22.3575 6.15652C23.9969 8.0097 25.302 9.96665 26.2363 11.9731C31.4474 23.1639 24.2638 31.9995 15.719 31.9995Z" fill="#FE4E33"></path><path d="M26.2368 11.9725C25.3025 9.96608 23.9974 8.00914 22.358 6.15596C22.0148 5.76778 21.422 5.74364 21.0476 6.09313L16.7341 10.119V1.68791C16.7341 1.15466 16.2508 0.726215 15.7407 0.710938V31.9988C24.2762 31.9842 31.4436 23.1541 26.2368 11.9725Z" fill="#FE1600"></path><path d="M15.719 31.9978C13.1463 31.9978 11.0532 29.8997 11.0532 27.3207C11.0532 23.1534 15.0992 20.6859 15.2714 20.5829C15.4193 20.4945 15.589 20.4496 15.7612 20.4533C15.9334 20.4571 16.1011 20.5094 16.2449 20.6042C16.4139 20.7157 20.3848 23.3791 20.3848 27.3207C20.3848 29.8997 18.2918 31.9978 15.719 31.9978Z" fill="#FEC356"></path><path d="M20.3853 27.3203C20.3853 23.3787 16.4143 20.7153 16.2454 20.6038C16.0956 20.5052 15.9201 20.4528 15.7407 20.4531V31.9969C18.3036 31.9853 20.3853 29.8921 20.3853 27.3203Z" fill="#FEB020"></path><path d="M24 16C28.4183 16 32 12.4183 32 8C32 3.58172 28.4183 0 24 0C19.5817 0 16 3.58172 16 8C16 12.4183 19.5817 16 24 16Z" fill="url(#paint0_linear_1117_2)"></path><path d="M23.9999 0C23.7886 0 23.5793 0.0083451 23.3721 0.0244078C25.2085 0.166965 26.8706 0.929977 28.1501 2.10353L27.8692 2.38438C27.7464 2.5072 27.6574 2.65965 27.6107 2.82697C27.564 2.99429 27.5613 3.17082 27.6028 3.33948L27.8569 4.37107L23.8375 8.39053L23.4509 8.00392V9.01177H23.4512C23.4528 9.15486 23.5104 9.29164 23.6117 9.39275C23.7189 9.49995 23.8594 9.55354 23.9999 9.55354C24.1404 9.55354 24.281 9.49995 24.3882 9.39275L28.329 5.45189L29.3606 5.70591C29.5293 5.74744 29.7058 5.74474 29.8731 5.69807C30.0404 5.65141 30.1929 5.56236 30.3157 5.43953L30.3228 5.43241C30.5958 6.23837 30.7443 7.1018 30.7443 8C30.7443 12.207 27.4969 15.6553 23.3721 15.9756C23.5793 15.9917 23.7886 16 23.9999 16C28.4182 16 31.9999 12.4183 31.9999 8C31.9999 3.58171 28.4182 0 23.9999 0Z" fill="url(#paint1_linear_1117_2)"></path><path d="M24.0003 8.94095C24.5201 8.94095 24.9414 8.51957 24.9414 7.99977C24.9414 7.47997 24.5201 7.05859 24.0003 7.05859C23.4805 7.05859 23.0591 7.47997 23.0591 7.99977C23.0591 8.51957 23.4805 8.94095 24.0003 8.94095Z" fill="black"></path><path d="M24.0001 2.35156C20.8813 2.35156 18.353 4.87984 18.353 7.99862C18.353 11.1174 20.8813 13.6457 24.0001 13.6457C27.1189 13.6457 29.6471 11.1174 29.6471 7.99862C29.6471 4.87984 27.1189 2.35156 24.0001 2.35156ZM24.0001 11.2927C22.1808 11.2927 20.706 9.81792 20.706 7.99862C20.706 6.17933 22.1808 4.7045 24.0001 4.7045C25.8194 4.7045 27.2942 6.17933 27.2942 7.99862C27.2942 9.81792 25.8194 11.2927 24.0001 11.2927Z" fill="white"></path><path d="M23.8377 8.38911L23.4512 8.00229V8.76276C23.611 8.8781 23.8031 8.94003 24.0002 8.9397C24.52 8.9397 24.9414 8.51836 24.9414 7.99852C24.9414 7.79711 24.878 7.61013 24.7698 7.45703L23.8377 8.38911Z" fill="url(#paint2_linear_1117_2)"></path><path d="M27.6999 3.73438L27.8571 4.37187L26.4409 5.78802C26.6925 6.06567 26.8977 6.38661 27.0436 6.7383L28.3292 5.45265L29.1368 5.65155C28.7986 4.91304 28.3057 4.26018 27.6999 3.73438Z" fill="url(#paint3_linear_1117_2)"></path><path d="M31.6671 2.14524L30.213 1.78719L29.855 0.333099C29.7735 0.00233822 29.3619 -0.112485 29.121 0.128393L27.5652 1.68422C27.4424 1.80705 27.3533 1.95949 27.3066 2.12681C27.26 2.29413 27.2573 2.47066 27.2988 2.63933L27.7062 4.29395L29.3609 4.70138C29.5295 4.74291 29.7061 4.74021 29.8734 4.69354C30.0407 4.64688 30.1931 4.55782 30.316 4.435L31.8718 2.87917C32.1127 2.63829 31.9979 2.22668 31.6671 2.14524Z" fill="url(#paint4_linear_1117_2)"></path><path d="M31.6671 2.14524L30.213 1.78719L29.855 0.333099C29.7735 0.00233822 29.3619 -0.112485 29.121 0.128393L27.5652 1.68422C27.4424 1.80705 27.3533 1.95949 27.3066 2.12681C27.26 2.29413 27.2573 2.47066 27.2988 2.63933L27.7062 4.29395L29.3609 4.70138C29.5295 4.74291 29.7061 4.74021 29.8734 4.69354C30.0407 4.64688 30.1931 4.55782 30.316 4.435L31.8718 2.87917C32.1127 2.63829 31.9979 2.22668 31.6671 2.14524Z" fill="url(#paint5_linear_1117_2)"></path><path d="M31.667 2.14523L30.2129 1.78718L29.8549 0.333093C29.7734 0.00233241 29.3619 -0.11246 29.121 0.128356L28.2449 1.00447C28.122 1.1273 28.033 1.27974 27.9863 1.44706C27.9397 1.61438 27.937 1.7909 27.9785 1.95957L28.3859 3.61419L30.0405 4.02163C30.2092 4.06315 30.3857 4.06045 30.5531 4.01379C30.7204 3.96712 30.8728 3.87807 30.9956 3.75524L31.8717 2.87916C32.1126 2.63829 31.9978 2.22668 31.667 2.14523Z" fill="url(#paint6_linear_1117_2)"></path><path d="M31.667 2.14523L30.2129 1.78718L29.8549 0.333093C29.7734 0.00236389 29.3619 -0.11246 29.121 0.128325L28.9246 0.324748C28.8017 0.447576 28.7127 0.600021 28.666 0.767339C28.6194 0.934658 28.6166 1.11119 28.6582 1.27985L29.0656 2.93447L30.7202 3.34191C30.8889 3.38344 31.0654 3.38074 31.2327 3.33407C31.4001 3.2874 31.5525 3.19835 31.6753 3.07552L31.8717 2.8792C32.1125 2.63829 31.9978 2.22668 31.667 2.14523Z" fill="url(#paint7_linear_1117_2)"></path><path d="M24.0002 8.5501C23.9281 8.55019 23.8567 8.53604 23.79 8.50845C23.7234 8.48085 23.6629 8.44037 23.612 8.38931C23.3976 8.17491 23.3976 7.82727 23.612 7.61287L29.7906 1.43424C30.005 1.21984 30.3526 1.21984 30.567 1.43424C30.7814 1.64864 30.7814 1.99628 30.567 2.21068L24.3884 8.38931C24.3375 8.44037 24.277 8.48085 24.2104 8.50845C24.1437 8.53604 24.0723 8.55019 24.0002 8.5501Z" fill="url(#paint8_linear_1117_2)"></path></g><defs><linearGradient id="paint0_linear_1117_2" x1="15.6235" y1="8" x2="31.8162" y2="8" gradientUnits="userSpaceOnUse"><stop stop-color="#FE99A0"></stop><stop offset="0.593" stop-color="#FE646F"></stop><stop offset="1" stop-color="#E41F2D"></stop></linearGradient><linearGradient id="paint1_linear_1117_2" x1="24.082" y1="8" x2="32.8346" y2="8" gradientUnits="userSpaceOnUse"><stop stop-color="#FE646F"></stop><stop offset="0.704" stop-color="#E41F2D"></stop><stop offset="1" stop-color="#C41926"></stop></linearGradient><linearGradient id="paint2_linear_1117_2" x1="22.4943" y1="8.19836" x2="29.5266" y2="8.19836" gradientUnits="userSpaceOnUse"><stop stop-color="#F3EAE6"></stop><stop offset="1" stop-color="#CDBFBA"></stop></linearGradient><linearGradient id="paint3_linear_1117_2" x1="22.4943" y1="5.23634" x2="29.5265" y2="5.23634" gradientUnits="userSpaceOnUse"><stop stop-color="#F3EAE6"></stop><stop offset="1" stop-color="#CDBFBA"></stop></linearGradient><linearGradient id="paint4_linear_1117_2" x1="27.2002" y1="2.36532" x2="32.0325" y2="2.36532" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint5_linear_1117_2" x1="26.8342" y1="2.36532" x2="32.1576" y2="2.36532" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint6_linear_1117_2" x1="26.8341" y1="2.02545" x2="31.0589" y2="2.02545" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint7_linear_1117_2" x1="26.8341" y1="1.6856" x2="30.1805" y2="1.6856" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint8_linear_1117_2" x1="23.4512" y1="4.91176" x2="30.7278" y2="4.91176" gradientUnits="userSpaceOnUse"><stop stop-color="#01D0FB"></stop><stop offset="0.608" stop-color="#26A6FE"></stop><stop offset="1" stop-color="#0182FC"></stop></linearGradient><clipPath id="clip0_1117_2"><rect width="32" height="32" fill="white"></rect></clipPath></defs></svg>
                                        <h6 class="mx-2 PlanCalaeriesViewText"></h6>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
                    <div class="d-lg-none d-block col-12">
                         <div class="d-flex align-items-center flex-wrap ms-auto">
                              <div class="mx-2 my-1">
                                   <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#eae8e8" d="M455.667 53.932h-48.039V32.48c0-10.923-11.5-19.48-26.17-19.48-14.691 0-26.2 8.557-26.2 19.48v21.452H282.2V32.48C282.2 21.557 270.69 13 256 13s-26.2 8.557-26.2 19.48v21.452h-73.032V32.48c0-10.923-11.507-19.48-26.2-19.48s-26.2 8.557-26.2 19.48v21.452H56.361a31.817 31.817 0 0 0-31.782 31.781v381.505A31.819 31.819 0 0 0 56.361 499h399.306a31.8 31.8 0 0 0 31.754-31.782V85.713a31.8 31.8 0 0 0-31.754-31.781zM371.26 32.6c.49-1.05 4.17-3.6 10.2-3.6 6.012 0 9.682 2.554 10.17 3.6v21.332h-20.37zm-125.46.009C246.3 31.556 249.984 29 256 29s9.7 2.556 10.2 3.609v21.323h-20.4zm-125.43 0c.5-1.053 4.183-3.609 10.2-3.609s9.7 2.556 10.2 3.609v21.323h-20.4z" opacity="1" data-original="#eae8e8"></path><path fill="#484868" d="M238.12 205.162v35.914a8 8 0 0 1-8 8h-40.7a8 8 0 0 1-8-8v-35.914a8 8 0 0 1 8-8h40.7a8 8 0 0 1 8 8zm84.464-8h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm-184.9 87.871H96.952a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.733a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm92.435 0h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-7.999-8zm92.464 0h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-7.999-8zm-184.9 87.9H96.952a8 8 0 0 0-8 8v35.885a8 8 0 0 0 8 8h40.733a8 8 0 0 0 8-8v-35.884a8 8 0 0 0-8-8zm92.435 0h-40.7a8 8 0 0 0-8 8v35.885a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.884a8 8 0 0 0-7.998-8zm-92.433-175.771H96.952a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.733a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm277.363 87.871h-40.7a8 8 0 0 0-8 8v35.914a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zm-92.464 87.9h-40.7a8 8 0 0 0-8 8v35.885a8 8 0 0 0 8 8h40.7a8 8 0 0 0 8-8v-35.884a8 8 0 0 0-8-8z" opacity="1" data-original="#484868"></path><g fill="#3d3d54"><path d="M137.685 197.162h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM230.12 372.934h-10a8 8 0 0 1 8 8v35.885a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.885a8 8 0 0 0-8-8zM230.12 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM137.685 372.934h-10a8 8 0 0 1 8 8v35.885a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.885a8 8 0 0 0-8-8zM137.685 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM322.584 372.934h-10a8 8 0 0 1 8 8v35.885a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.885a8 8 0 0 0-8-8zM322.584 197.162h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM230.12 197.162h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM415.048 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8zM322.584 285.033h-10a8 8 0 0 1 8 8v35.914a8 8 0 0 1-8 8h10a8 8 0 0 0 8-8v-35.914a8 8 0 0 0-8-8z" fill="#3d3d54" opacity="1" data-original="#3d3d54"></path></g><path fill="#d22e2e" d="M389.649 246.78a8 8 0 0 1-5.632-2.318l-16.44-16.3a8 8 0 0 1 11.265-11.362l10.3 10.208 20.939-24.721a8 8 0 0 1 12.209 10.342l-26.532 31.322a8 8 0 0 1-5.758 2.821 8.334 8.334 0 0 1-.351.008z" opacity="1" data-original="#d22e2e" class=""></path><path fill="#d1c9c9" d="M417.446 473.242a8 8 0 0 1-5.658 2.345H56.361a31.819 31.819 0 0 1-31.782-31.782v23.413A31.819 31.819 0 0 0 56.361 499h399.306a31.8 31.8 0 0 0 31.754-31.782v-67.293a8 8 0 0 1-2.342 5.655z" opacity="1" data-original="#d1c9c9"></path><path fill="#bcb3b3" d="M487.421 399.925v-1.049h-60.48a16 16 0 0 0-16 16v60.711h.847a8 8 0 0 0 5.658-2.345l67.633-67.662a8 8 0 0 0 2.342-5.655z" opacity="1" data-original="#bcb3b3"></path><path fill="#d22e2e" d="M455.667 53.932H371.26v30.282c.47 1.05 4.138 3.619 10.2 3.619a8 8 0 0 1 0 16c-14.691 0-26.2-8.569-26.2-19.509V53.932H245.8v30.276c.478 1.054 4.151 3.625 10.2 3.625a8 8 0 0 1 0 16c-14.691 0-26.2-8.569-26.2-19.509V53.932H120.372v30.276c.478 1.054 4.151 3.625 10.2 3.625a8 8 0 0 1 0 16c-14.69 0-26.2-8.569-26.2-19.509V53.932H56.361a31.817 31.817 0 0 0-31.782 31.781v68.207h462.842V85.713a31.8 31.8 0 0 0-31.754-31.781z" opacity="1" data-original="#d22e2e" class=""></path><path fill="#d1c9c9" d="M24.579 153.92h462.842v12.492H24.579z" opacity="1" data-original="#d1c9c9"></path><path fill="#484868" d="M264 95.833a8 8 0 0 1-8 8c-14.691 0-26.2-8.569-26.2-19.509V32.48C229.8 21.557 241.309 13 256 13s26.2 8.557 26.2 19.48v21.452h-16V32.609C265.7 31.556 262.015 29 256 29s-9.7 2.556-10.2 3.609v51.6c.478 1.054 4.151 3.625 10.2 3.625a8 8 0 0 1 8 7.999zm-133.43-8c-6.047 0-9.72-2.571-10.2-3.625v-51.6c.5-1.053 4.183-3.609 10.2-3.609s9.7 2.556 10.2 3.609v21.324h16V32.48c0-10.923-11.507-19.48-26.2-19.48s-26.2 8.557-26.2 19.48v51.844c0 10.94 11.508 19.509 26.2 19.509a8 8 0 0 0 0-16zm250.888 0c-6.06 0-9.728-2.569-10.2-3.619V32.6c.49-1.05 4.17-3.6 10.2-3.6 6.012 0 9.682 2.554 10.17 3.6v21.332h16V32.48c0-10.923-11.5-19.48-26.17-19.48-14.691 0-26.2 8.557-26.2 19.48v51.844c0 10.94 11.507 19.509 26.2 19.509a8 8 0 0 0 0-16z" opacity="1" data-original="#484868"></path><path fill="#ad1e1e" d="M130.62 80.834a14.926 14.926 0 0 0-9.949 3.8c1.068 1.194 4.553 3.2 9.9 3.2a8 8 0 0 1 0 16 33.375 33.375 0 0 1-14.062-2.966 14.992 14.992 0 1 0 14.111-20.034zM256 80.834a14.925 14.925 0 0 0-9.921 3.771c1.039 1.191 4.535 3.228 9.921 3.228a8 8 0 0 1 0 16 33.362 33.362 0 0 1-14.123-2.994 14.992 14.992 0 1 0 14.123-20zM381.444 80.834a14.921 14.921 0 0 0-9.916 3.767c1.023 1.186 4.519 3.232 9.93 3.232a8 8 0 0 1 0 16 33.357 33.357 0 0 1-14.14-3 14.992 14.992 0 1 0 14.126-20z" opacity="1" data-original="#ad1e1e"></path></g></svg>
                                        <h6 class="mx-2 PlanDurationViewText"></h6>
                                   </div>
                              </div>
                              <div class="mx-2 my-1">
                                   <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#8164e1" d="m470.3 184.2-46.5-183-35.698 35.398C348.5 12.598 302.5 0 256 0 119.2 0 6.598 108.102.602 244.602L0 257.199l90.3 19.5-.3-18.597C89.098 165.398 164.8 90 256 90c22.5 0 45.098 4.5 65.8 13.2l-34.5 34.5zM422 237.398V256c0 91.8-76.3 166-166 166-22.2 0-44.098-4.5-64.5-13.2l33.3-33-184-47.1 47.098 183 36-36C163.5 499.397 209.801 512 256 512c136.5 0 249.102-107.5 255.398-243.7l.602-12.6c-6-1.2-87-17.7-90-18.302zm0 0" opacity="1" data-original="#64e1dc" class=""></path><g fill="#00c8c8"><path d="M321.8 103.2C301.099 94.5 278.5 90 256 90V0c46.5 0 92.5 12.598 132.102 36.598L423.8 1.199l46.5 183-183-46.5zM512 255.7l-.602 12.6C505.102 404.5 392.5 512 256 512v-90c89.7 0 166-74.2 166-166v-18.602c3 .602 84 17.102 90 18.301zm0 0" fill="#7927ff" opacity="1" data-original="#00c8c8" class=""></path></g></g></svg>
                                        <h6 class="mx-2 PlanRepetationViewText"></h6>
                                   </div>
                              </div>
                              <div class="mx-2 my-1">
                                   <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32" fill="none"><g clip-path="url(#clip0_1117_2)"><path d="M15.719 31.9995C8.94913 31.9995 3.44141 26.4784 3.44141 19.6921C3.44141 14.4142 5.84 9.70809 9.36168 5.84309C12.2581 2.66423 15.1248 0.913781 15.2454 0.840876C15.8808 0.45649 16.7336 0.980208 16.7336 1.68848V10.1196L21.0471 6.0937C21.4215 5.74421 22.0143 5.76841 22.3575 6.15652C23.9969 8.0097 25.302 9.96665 26.2363 11.9731C31.4474 23.1639 24.2638 31.9995 15.719 31.9995Z" fill="#FE4E33"></path><path d="M26.2368 11.9725C25.3025 9.96608 23.9974 8.00914 22.358 6.15596C22.0148 5.76778 21.422 5.74364 21.0476 6.09313L16.7341 10.119V1.68791C16.7341 1.15466 16.2508 0.726215 15.7407 0.710938V31.9988C24.2762 31.9842 31.4436 23.1541 26.2368 11.9725Z" fill="#FE1600"></path><path d="M15.719 31.9978C13.1463 31.9978 11.0532 29.8997 11.0532 27.3207C11.0532 23.1534 15.0992 20.6859 15.2714 20.5829C15.4193 20.4945 15.589 20.4496 15.7612 20.4533C15.9334 20.4571 16.1011 20.5094 16.2449 20.6042C16.4139 20.7157 20.3848 23.3791 20.3848 27.3207C20.3848 29.8997 18.2918 31.9978 15.719 31.9978Z" fill="#FEC356"></path><path d="M20.3853 27.3203C20.3853 23.3787 16.4143 20.7153 16.2454 20.6038C16.0956 20.5052 15.9201 20.4528 15.7407 20.4531V31.9969C18.3036 31.9853 20.3853 29.8921 20.3853 27.3203Z" fill="#FEB020"></path><path d="M24 16C28.4183 16 32 12.4183 32 8C32 3.58172 28.4183 0 24 0C19.5817 0 16 3.58172 16 8C16 12.4183 19.5817 16 24 16Z" fill="url(#paint0_linear_1117_2)"></path><path d="M23.9999 0C23.7886 0 23.5793 0.0083451 23.3721 0.0244078C25.2085 0.166965 26.8706 0.929977 28.1501 2.10353L27.8692 2.38438C27.7464 2.5072 27.6574 2.65965 27.6107 2.82697C27.564 2.99429 27.5613 3.17082 27.6028 3.33948L27.8569 4.37107L23.8375 8.39053L23.4509 8.00392V9.01177H23.4512C23.4528 9.15486 23.5104 9.29164 23.6117 9.39275C23.7189 9.49995 23.8594 9.55354 23.9999 9.55354C24.1404 9.55354 24.281 9.49995 24.3882 9.39275L28.329 5.45189L29.3606 5.70591C29.5293 5.74744 29.7058 5.74474 29.8731 5.69807C30.0404 5.65141 30.1929 5.56236 30.3157 5.43953L30.3228 5.43241C30.5958 6.23837 30.7443 7.1018 30.7443 8C30.7443 12.207 27.4969 15.6553 23.3721 15.9756C23.5793 15.9917 23.7886 16 23.9999 16C28.4182 16 31.9999 12.4183 31.9999 8C31.9999 3.58171 28.4182 0 23.9999 0Z" fill="url(#paint1_linear_1117_2)"></path><path d="M24.0003 8.94095C24.5201 8.94095 24.9414 8.51957 24.9414 7.99977C24.9414 7.47997 24.5201 7.05859 24.0003 7.05859C23.4805 7.05859 23.0591 7.47997 23.0591 7.99977C23.0591 8.51957 23.4805 8.94095 24.0003 8.94095Z" fill="black"></path><path d="M24.0001 2.35156C20.8813 2.35156 18.353 4.87984 18.353 7.99862C18.353 11.1174 20.8813 13.6457 24.0001 13.6457C27.1189 13.6457 29.6471 11.1174 29.6471 7.99862C29.6471 4.87984 27.1189 2.35156 24.0001 2.35156ZM24.0001 11.2927C22.1808 11.2927 20.706 9.81792 20.706 7.99862C20.706 6.17933 22.1808 4.7045 24.0001 4.7045C25.8194 4.7045 27.2942 6.17933 27.2942 7.99862C27.2942 9.81792 25.8194 11.2927 24.0001 11.2927Z" fill="white"></path><path d="M23.8377 8.38911L23.4512 8.00229V8.76276C23.611 8.8781 23.8031 8.94003 24.0002 8.9397C24.52 8.9397 24.9414 8.51836 24.9414 7.99852C24.9414 7.79711 24.878 7.61013 24.7698 7.45703L23.8377 8.38911Z" fill="url(#paint2_linear_1117_2)"></path><path d="M27.6999 3.73438L27.8571 4.37187L26.4409 5.78802C26.6925 6.06567 26.8977 6.38661 27.0436 6.7383L28.3292 5.45265L29.1368 5.65155C28.7986 4.91304 28.3057 4.26018 27.6999 3.73438Z" fill="url(#paint3_linear_1117_2)"></path><path d="M31.6671 2.14524L30.213 1.78719L29.855 0.333099C29.7735 0.00233822 29.3619 -0.112485 29.121 0.128393L27.5652 1.68422C27.4424 1.80705 27.3533 1.95949 27.3066 2.12681C27.26 2.29413 27.2573 2.47066 27.2988 2.63933L27.7062 4.29395L29.3609 4.70138C29.5295 4.74291 29.7061 4.74021 29.8734 4.69354C30.0407 4.64688 30.1931 4.55782 30.316 4.435L31.8718 2.87917C32.1127 2.63829 31.9979 2.22668 31.6671 2.14524Z" fill="url(#paint4_linear_1117_2)"></path><path d="M31.6671 2.14524L30.213 1.78719L29.855 0.333099C29.7735 0.00233822 29.3619 -0.112485 29.121 0.128393L27.5652 1.68422C27.4424 1.80705 27.3533 1.95949 27.3066 2.12681C27.26 2.29413 27.2573 2.47066 27.2988 2.63933L27.7062 4.29395L29.3609 4.70138C29.5295 4.74291 29.7061 4.74021 29.8734 4.69354C30.0407 4.64688 30.1931 4.55782 30.316 4.435L31.8718 2.87917C32.1127 2.63829 31.9979 2.22668 31.6671 2.14524Z" fill="url(#paint5_linear_1117_2)"></path><path d="M31.667 2.14523L30.2129 1.78718L29.8549 0.333093C29.7734 0.00233241 29.3619 -0.11246 29.121 0.128356L28.2449 1.00447C28.122 1.1273 28.033 1.27974 27.9863 1.44706C27.9397 1.61438 27.937 1.7909 27.9785 1.95957L28.3859 3.61419L30.0405 4.02163C30.2092 4.06315 30.3857 4.06045 30.5531 4.01379C30.7204 3.96712 30.8728 3.87807 30.9956 3.75524L31.8717 2.87916C32.1126 2.63829 31.9978 2.22668 31.667 2.14523Z" fill="url(#paint6_linear_1117_2)"></path><path d="M31.667 2.14523L30.2129 1.78718L29.8549 0.333093C29.7734 0.00236389 29.3619 -0.11246 29.121 0.128325L28.9246 0.324748C28.8017 0.447576 28.7127 0.600021 28.666 0.767339C28.6194 0.934658 28.6166 1.11119 28.6582 1.27985L29.0656 2.93447L30.7202 3.34191C30.8889 3.38344 31.0654 3.38074 31.2327 3.33407C31.4001 3.2874 31.5525 3.19835 31.6753 3.07552L31.8717 2.8792C32.1125 2.63829 31.9978 2.22668 31.667 2.14523Z" fill="url(#paint7_linear_1117_2)"></path><path d="M24.0002 8.5501C23.9281 8.55019 23.8567 8.53604 23.79 8.50845C23.7234 8.48085 23.6629 8.44037 23.612 8.38931C23.3976 8.17491 23.3976 7.82727 23.612 7.61287L29.7906 1.43424C30.005 1.21984 30.3526 1.21984 30.567 1.43424C30.7814 1.64864 30.7814 1.99628 30.567 2.21068L24.3884 8.38931C24.3375 8.44037 24.277 8.48085 24.2104 8.50845C24.1437 8.53604 24.0723 8.55019 24.0002 8.5501Z" fill="url(#paint8_linear_1117_2)"></path></g><defs><linearGradient id="paint0_linear_1117_2" x1="15.6235" y1="8" x2="31.8162" y2="8" gradientUnits="userSpaceOnUse"><stop stop-color="#FE99A0"></stop><stop offset="0.593" stop-color="#FE646F"></stop><stop offset="1" stop-color="#E41F2D"></stop></linearGradient><linearGradient id="paint1_linear_1117_2" x1="24.082" y1="8" x2="32.8346" y2="8" gradientUnits="userSpaceOnUse"><stop stop-color="#FE646F"></stop><stop offset="0.704" stop-color="#E41F2D"></stop><stop offset="1" stop-color="#C41926"></stop></linearGradient><linearGradient id="paint2_linear_1117_2" x1="22.4943" y1="8.19836" x2="29.5266" y2="8.19836" gradientUnits="userSpaceOnUse"><stop stop-color="#F3EAE6"></stop><stop offset="1" stop-color="#CDBFBA"></stop></linearGradient><linearGradient id="paint3_linear_1117_2" x1="22.4943" y1="5.23634" x2="29.5265" y2="5.23634" gradientUnits="userSpaceOnUse"><stop stop-color="#F3EAE6"></stop><stop offset="1" stop-color="#CDBFBA"></stop></linearGradient><linearGradient id="paint4_linear_1117_2" x1="27.2002" y1="2.36532" x2="32.0325" y2="2.36532" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint5_linear_1117_2" x1="26.8342" y1="2.36532" x2="32.1576" y2="2.36532" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint6_linear_1117_2" x1="26.8341" y1="2.02545" x2="31.0589" y2="2.02545" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint7_linear_1117_2" x1="26.8341" y1="1.6856" x2="30.1805" y2="1.6856" gradientUnits="userSpaceOnUse"><stop stop-color="#FFF9DF"></stop><stop offset="0.593" stop-color="#FFE177"></stop><stop offset="1" stop-color="#FEB137"></stop></linearGradient><linearGradient id="paint8_linear_1117_2" x1="23.4512" y1="4.91176" x2="30.7278" y2="4.91176" gradientUnits="userSpaceOnUse"><stop stop-color="#01D0FB"></stop><stop offset="0.608" stop-color="#26A6FE"></stop><stop offset="1" stop-color="#0182FC"></stop></linearGradient><clipPath id="clip0_1117_2"><rect width="32" height="32" fill="white"></rect></clipPath></defs></svg>
                                        <h6 class="mx-2 PlanCalaeriesViewText"></h6>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-body p-0">
                    <div class="main-food-body overflow-scroll SetMasterDietViewHtml"></div>
               </div>
               <div class="modal-footer border-top-0">
                    <button type="button" class=" btn-primary DownloadDietPlanPDF delete-btn d-none" EditID= "">Download</button>
                    <button type="button" class=" btn-secondary ApproveDietRequestBtn" style="display:none;" DataDietID="" DataDietPlanName="" Datausernameid=""  Datauserid="" EditID= "" data-bs-toggle="modal" data-bs-target="#Update_dayname">Approve</button>    
                    <button type="button" class=" btn-primary MasterDietPlanDeleteButton delete-btn" style="display:none;"  EditID= "">Delete</button>
                    <button type="button" class="btn-primary MasterDietPlanEditClass" hidden EditID= "">
                    <i class="bi bi-pencil"></i>
               </button>
               </div>
          </div>
     </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Update_dayname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Diet Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="col-lg-12 col-md-4 mb-1">
               <label class="form-label main-label">Name<sup class="validationn">*</sup></label>
               <input type="text" class="form-control main-control DietNameInputField"  placeholder="Enter Workout Diet" required="">

               <p class="text-danger DietNameInputFieldAlert"  style="font-size:14px; display:none;">Diet Name Already Taken</p>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary AddToDietBtm" ApproveStatus = "0" DataDietID="" DataDietPlanName="" Datausernameid="" Datauserid="">Add to Master Diet</button>
      </div>
    </div>
  </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
     function DietList(Number) {
          var url = 'DietRequestList';
          if (Number != '') {
               $.ajax({
                    datatype: 'json',
                    method: "post",
                    url: url,
                    data: {
                         action: 'list',
                         number: Number,
                    },
                    success: function (res) {
                         $('.SetHTMLDiv').html(res);
                    }
               });
          }
     }

     DietList(1);
     
     $('body').on('click', '.Tab1Class', function () {
          DietList(1);
     });
     $('body').on('click', '.Tab2Class', function () {
          DietList(2);
     });


     $('body').on('click', '.ViewClickEventSuggestDiet', function () {
          var DataDietID = $(this).attr('DataDietID');
          var DataDietPlanName = $(this).attr('DataDietPlanName');
          var Datausernameid = $(this).attr('Datausernameid');
          var Datauserid = $(this).attr('Datauserid');
          var DataDietAvarageCalorie = $(this).attr('DataDietAvarageCalorie');
          var DataDietRepetition = $(this).attr('DataDietRepetition');
          var DataDietDuration = $(this).attr('DataDietDuration');

          $('.ApproveDietRequestBtn').attr('DataDietID', DataDietID);
          $('.ApproveDietRequestBtn').attr('Datausernameid', Datausernameid);
          $('.ApproveDietRequestBtn').attr('Datauserid', Datauserid);
          $('.ApproveDietRequestBtn').attr('DataDietPlanName', DataDietPlanName);
          $('.ApproveDietRequestBtn').show();
          $('.MasterDietPlanDeleteButton').hide();

          
          $('.PlanDurationViewText').text(DataDietDuration);
          $('.PlanRepetationViewText').text(DataDietRepetition);
          $('.PlanCalaeriesViewText').text(DataDietAvarageCalorie);
          $('.PlanNameViewText').text(DataDietPlanName);

          if(DataDietID != '' && Datausernameid != '' && Datauserid != ''){
               $.ajax({
                    method: "post",
                    url: "MasterDietView",
                    data: {
                         DataDietID : DataDietID,
                         Datausernameid : Datausernameid,
                         Datauserid :Datauserid,
                    },
                    success: function (res) {
                         var response = JSON.parse(res);
                         $('.SetMasterDietViewHtml').html(response.Html);  
                         $('.MasterViewDataClickClass').trigger('click');

                    }
               });
          }
     });

     $('body').on('click', '.ApproveDietRequestBtn', function(){
          var DataDietID = $(this).attr('DataDietID');
          var Datausernameid = $(this).attr('Datausernameid');
          var Datauserid = $(this).attr('Datauserid');
          var DataDietPlanName = $(this).attr('DataDietPlanName');
          $('.AddToDietBtm').attr('DataDietID', DataDietID);
          $('.AddToDietBtm').attr('Datausernameid', Datausernameid);
          $('.AddToDietBtm').attr('Datauserid', Datauserid);
          $('.AddToDietBtm').attr('DataDietPlanName', DataDietPlanName);

          $('.DietNameInputField').val(DataDietPlanName);
          checkdietname();

     });

     $('body').on('click', '.AddToDietBtm', function(){
          var DataDietID = $(this).attr('DataDietID');
          var Datausernameid = $(this).attr('Datausernameid');
          var Datauserid = $(this).attr('Datauserid');
          var DataDietPlanName = $(this).attr('DataDietPlanName');
          var ApproveStatus = $(this).attr('ApproveStatus');
          var DietNameInputField = $('.DietNameInputField').val();
          if(DietNameInputField != '' && DietNameInputField !== undefined && DietNameInputField !== 'undefined' && ApproveStatus == '1'){
               $.ajax({
                    method: "post",
                    url: "AddToMasterDiet",
                    data: {
                         DataDietID : DataDietID,
                         Datausernameid:Datausernameid,
                         Datauserid :Datauserid,
                         DietNameInputField:DietNameInputField,
                    },
                    success: function (res) {
                         if(res != ''){
                              iziToast.success({
                                   title: 'Added Successfully'
                              });
                              $('.btn-close').trigger('click');

                         }
                    }
               });
          }
     });



     function checkdietname(){
          var DietNameInputField = $('.DietNameInputField').val();
          if(DietNameInputField != ''){
               $.ajax({
                    method: "post",
                    url: "DietAvailable",
                    data: {
                         name : DietNameInputField
                    },
                    success: function (res) {
                         var response = JSON.parse(res);
                         if(response.RStuts == '1'){
                              $('.AddToDietBtm').attr('ApproveStatus', '1');
                              $('.DietNameInputFieldAlert').hide();
                         }else{
                              $('.AddToDietBtm').attr('ApproveStatus', '0');
                              $('.DietNameInputFieldAlert').show();
                         }
                    }
               });
          }else{
               $('.AddToDietBtm').attr('ApproveStatus', '0');
          }
     }

     $("body").on("input", ".DietNameInputField", function() {
          checkdietname();
     });


     $('body').on('click', '.ViewClickEventMasterDiet', function (){
          // alert();
          var DataDietID = $(this).attr('DataDietID');
          var DataDietPlanName = $(this).attr('DataDietPlanName');
          var DataDietAvarageCalorie = $(this).attr('DataDietAvarageCalorie');
          var DataDietRepetition = $(this).attr('DataDietRepetition');
          var DataDietDuration = $(this).attr('DataDietDuration');
          $('.ApproveDietRequestBtn').hide();
          $('.MasterDietPlanDeleteButton').show();

          $('.MasterDietPlanDeleteButton').attr('EditID', DataDietID);
          $('.PlanDurationViewText').text(DataDietDuration);
          $('.PlanRepetationViewText').text(DataDietRepetition);
          $('.PlanCalaeriesViewText').text(DataDietAvarageCalorie);
          $('.PlanNameViewText').text(DataDietPlanName);
          if(DataDietID != ''){
               $.ajax({
                    method: "post",
                    url: "MainMasterDietView",
                    data: {
                         DataDietID : DataDietID,
                    },
                    success: function (res) {
                         var response = JSON.parse(res);
                         $('.SetMasterDietViewHtml').html(response.Html);  
                         $('.MasterViewDataClickClass').trigger('click');
                         
                    }
               });
          }
     });

     $('body').on('click', '.MasterDietPlanDeleteButton', function(){
          var EditID = $(this).attr('EditID');
          var record_text = "Are you sure you want to Delete this?";

          if(EditID != '' && EditID !== undefined && EditID !== 'undefined'){
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
                                   url: "delete_data",
                                   data: {
                                        'action':'delete',
                                        'del_id':EditID,
                                        'table': 'master_diet',
                                   },
                                   success: function (res) {
                                        iziToast.error({
                                             title: 'Delete Successfully'
                                        });
                                        DietList(1);
                                   }
                              });
                         }
               });

          }
     });

</script>