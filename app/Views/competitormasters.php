<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<div class="user-main">
   <div class="container-fluid">
      <div class="row row-main">
         <div class="col-xl-12 d-flex justify-content-between">
            <div class="user-icon d-flex align-items-center">
               <i class="bi bi-people me-2"></i>
               <p>Master competitor</p>
            </div>
            <div class="user-list-btn">
               <a href="#" data-bs-toggle="modal" data-bs-target="#competitormodel" class="btn-primary-rounded"><i class="bi bi-plus-lg add-panel-plus"></i></a>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="user-table ">
<div class="container-fluid">
   <div class="user-color card card-menu">
      <div class="row row-table">
         <div class="col-xl-12">
            <table id="competitor-table" class="table table-striped dt-responsive nowrap table-background-color " style="width:100%">
               <thead>
                  <tr>
                  <th> 
                     <input class="mx-2" type="checkbox" id="select-all"/>
                  </th>
                  <th>
                     <span>Master Details</span>
                  </th>
               </thead>
               <tbody>
                 <tr class="odd" >
                     <td  class="align-middle"><input class="checkbox mx-3 mt-2" type="checkbox"/> </td>
                     <td  class="d-flex">
                        <div class="builder-list-trf  px-0 py-2 w-100"  data-bs-toggle="modal" data-bs-target="#competitormodel">
                           <div class="builder-list-content d-flex align-items-center justify-content-between flex-wrap">
                                 <div class="d-flex align-items-center  col-xxs-12 col-xs-12 col-xl-4 lh-21">
                                    <b class=""> 1</b>
                                    <span class="mx-1"><b>AMAN PARK</b></span>
                                 </div>
                                 <div class="d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4 lh-21">
                                    <p>Builder :</p>
                                    <span class="mx-1">Rakesh Vekriya</span>
                                 </div>
                                 <div class="d-flex align-items-center  col-xxs-12 col-xs-12 col-xl-4 lh-21">
                                    <p>Location : </p>
                                    <span class="mx-1">Vesu</span>
                                 </div>
                                 <div class="d-flex align-items-center col-xxs-12 col-xs-12 col-xl-4 lh-21">
                                    <p>Price : </p>
                                    <span class="mx-1">---</span>
                                 </div>
                                 <div class="d-flex align-items-center  col-xxs-12 col-xs-12 col-xl-4 lh-21">
                                    <p> Type : </p>
                                    <span class="mx-1">Bunglows</span>
                                 </div>
                                 <div class="d-flex align-items-center  col-xxs-12 col-xs-12 col-xl-4 lh-21">
                                    <p>Sub Type : </p>
                                    <span class="mx-1">Residential</span>
                                 </div>
                           </div>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="competitormodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" style=" max-width:1100px">
      <div class="modal-content">
         <div class="modal-header competitor-header pt-2 pb-2">
            <h1 class="modal-title competitor-title" id="exampleModalLabel">Edit Project Type</h1>
            <div class="close_button">
               <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></button>
            </div>
         </div>
         <div class="modal-body modal-body-2 pt-1">
            <div class="row">
               <form action="" class="">
                  <div class="col-xl-12">
                     <h6>Project Information</h6>
                     <div class="card card-main3 pb-2 ">
                        <div class="row g-2 d-flex">
                           <!-- project-name-start -->
                           <div class="col-lg-3 ">
                              <div class="add-user-input">
                                 <label for="">Project Name :</label>
                                 <input type="text" placeholder=" Enter Project Name" value="" required="">
                              </div>
                           </div>
                           <!-- project-name-end -->
                           <div class="col-lg-3">
                              <div class="add-user-input">
                                 <label for="">builder name :</label>
                                 <input type="text" placeholder="Enter Builder Name" required>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="add-user-input">
                                 <label for="">project location :</label>
                                 <div class="d-flex main-form main-controll p-0">
                              <div class="dropdown bootstrap-select form-control form-controling">
                              <select  name="occupationname" id="occupationname"class="selectpicker form-control"data-live-search="true" required="" tabindex="-98">
                                    <option value="">select location</option>
                                    <option value="">kamrej</option>
                                    <option value="">laskana</option>
                                    <option value="">jakatnaka</option>
                                    <option value="">varachha</option>
                                    <option value="">yogi chock</option>
                                    <option value="">rachna</option>
                                    <option value="">hirabagr</option>
                                    <option value="">mini bazar</option>
                                    <option value="">katargam</option>
                                    <option value="">pal</option>
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
                           </div>
                           <div class="col-lg-3">
                              <div class="add-user-input">
                                 <label for="">size :</label>
                                 <input type="text" placeholder="Enter size" required>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="add-user-input">
                                 <label for="">construcion :</label>
                                 <input type="text" placeholder="construction">
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="add-user-input">
                                 <label for="">BHK :</label>
                                 <input type="text" placeholder="BHK" required>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="add-user-input">
                                 <label for="">yard :</label>
                                 <input type="text" placeholder="yard" required>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="add-user-input">
                                 <label for="">per yard price :</label>
                                 <input type="text" placeholder="peryard" required>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="add-user-input">
                                 <label for="">price :</label>
                                 <input type="text" placeholder="Enter Price">
                              </div>
                           </div>
                           <div class="col-lg-8">
                              <div class="add-user-input">
                                 <label for="">address :</label>
                                 <input type="text" placeholder="Enter Address" required>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <h6>Project Details</h6>
                  <div class="card card-main3 pb-2 ">
                     <div class="row g-2 d-flex">
                        <div class="col-lg-3">
                           <label for="">project Type :</label>
                           <div class="d-flex main-form  main-controll p-0">
                              <div class="dropdown bootstrap-select form-control form-controling">
                                 <select  name="occupationname" id="occupationname"class="selectpicker form-control"data-live-search="true" required="" tabindex="-98">
                                    <option value="">Select type</option>
                                    <option value="">Commercial</option>
                                    <option value="">industrial</option>
                                    <option value="">residential</option>
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
                        <div class="col-lg-3">
                              <label for="">project Sub Type :</label>
                              <div class="d-flex main-form  main-controll p-0">
                              <div class="dropdown bootstrap-select form-control form-controling">
                                 <select  name="occupationname" id="occupationname"class="selectpicker form-control"data-live-search="true" required="" tabindex="-98">
                                 <option value="">select location</option>
                              </select>
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
                        <div class="col-lg-3">
                              <label for="">project Status :</label>
                              <div class="d-flex main-form  main-controll p-0">
                              <div class="dropdown bootstrap-select form-control form-controling">
                                 <select  name="occupationname" id="occupationname"class="selectpicker form-control"data-live-search="true" required="" tabindex="-98">
                                 <option value="">select project status</option>
                                 <option value="">completed</option>
                                 <option value="">ongoing</option>
                                 <option value="">under construction</option>
                                 <option value="">on possession</option>
                              </select>
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
                        <div class="col-lg-3">
                           <div class="add-user-input">
                              <label for="">total unit :</label>
                              <input type="text" placeholder="Enter Total unit" required>
                           </div>
                        </div>
                        <div class="col-lg-8">
                           <div class="add-user-input">
                              <label for="">Possession Time :</label>
                              <input type="text" placeholder="Suggestion Time">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="add-user-input">
                              <label for="">pdf :</label>
                              <input type="file" placeholder="BHK" class="form-control pdf-control">
                           </div>
                        </div>
                        <div class="col-lg-8">
                           <div class="add-user-input">
                              <label for="">note :</label>
                              <input type="text" placeholder="note">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="add-user-input">
                              <label for="">amenities :</label>
                              <input type="text" placeholder="amenities">
                           </div>
                        </div>
                     </div>
               </form>
               </div>
            </div>
         </div>
         <div class="modal-footer modal-footer2">
            <a class="delete-tools me-0" href="javascript:void(0)">
            <span class="delete"><i class="bi bi-trash3 me-2"></i>Delete</span>
            <span class="really">Really ?</span>
            </a>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {

        $('#competitor-table').DataTable( {
      columnDefs: [ {
           'targets': [0], /* column index [0,1,2,3]*/
           'orderable': false, /* true or false */
       }],
   } );
   
   var selectAllItems = "#select-all";
   var checkboxItem = ".checkbox";
   
   $(selectAllItems).click(function() {
     
     if (this.checked) {
       $(checkboxItem).each(function() {
         this.checked = true;
       });
     } else {
       $(checkboxItem).each(function() {
         this.checked = false;
       });
     }
     
   });
   } );

 
</script>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>