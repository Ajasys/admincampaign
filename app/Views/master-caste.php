<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<div class="container-fluid">
   <div class="ml-78">
      <div class="d-flex align-items-center justify-content-between p-2">
         <div class="d-flex align-items-center justify-content-between invester">
            <h4>Manage Cast</h4>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="ml-78">
      <div class="col-xl-12">
         <div class="justify-content-between align-items-center main-select-section">
            <div class="col-xl-10 gap-5 main-select-section align-items-center">
               <div class="bulk-action select col-md-5 col-sm-12">
                  <h6>add caste</h6>
                  <input type="email" class="form-control place" id="inputEmail4" placeholder="add caste">
               </div>
               <div class="employee-action select col-md-5 col-sm-12 ">
                  <h6>select religion</h6>
                  <select name="code_religion" id="code_religion" class="selectpicker form-control" data-live-search="true" required><i class="fa-solid fa-caret-down"></i>
                                            <option class="dropdown-item" value="">Select Religion:</option>
                                            <?php
                                            $master_religion = json_decode($master_religion, true);
                                            if (isset($master_religion)) {
                                                foreach ($master_religion as $type_key => $type_value) {
                                                    echo '<option class="dropdown-item" value="">' . $type_value["religion"] . '</option>';
                                                }
                                            }
                                            ?>
                     </select>
               </div>
               <div class="employee-action select col-md-5 col-sm-12">
                  <button class="btn Caste-btn">Add Caste</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="ml-78  d-flex align-items-center justify-content-between">
      <thead>
         <tr>
            <div class="col-4 column">
               <h6>Cast List :</h6>
            </div>
         </tr>
      </thead>
   </div>
</div>
<div class="container-fluid">
   <div class="ml-78">
      <table id="investor" class=".table-background-color table table-striped dt-responsive nowrap" style="width:100%">
         <thead>
            <tr>
               <th>ID</th>
               <th>Caste</th>
               <th>Religion</th>

            </tr>
         </thead>
         <!-- <tbody>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>9</td>
                <td>Patel</td>
                <td>Hindu</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>11</td>
                <td>Parmar</td>
                <td>Hindu</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>15</td>
                <td>Luhar</td>
                <td>Hindu</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>16</td>
                <td>Koli</td>
                <td>Hindu</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>17</td>
                <td>Suthar</td>
                <td>Hindu</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>24</td>
                <td>Prajapati</td>
                <td>Hindu</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>25</td>
                <td>Khoja</td>
                <td>Muslim</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>26</td>
                <td>Memon</td>
                <td>Muslim</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>27</td>
                <td>Saiyad</td>
                <td>Muslim</td>
                
            </tr>
            <tr id="staticpeoplelist" data-bs-toggle="modal" data-bs-target="#people">
                <td>28</td>
                <td>Vohra</td>
                <td>Muslim</td>
                
            </tr>
            
        </tbody> -->
      </table>
   </div>
</div>
<div class="modal fade" id="people" style="z-index: 9999  ;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog people">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title fs-5" id="staticBackdropLabel">Edit Caste</h6>
            <span class="btn btn-outline-1 btn-sm">
               <i class="bi bi-trash3"></i>
            </span>
            <button type="button people" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form class="row g-3">
               <div class="col-md-6">
                  <label for="inputEmail4" class="form-labe investor">
                     <h6>Castee Name</h6>
                  </label>
                  <input type="email" class="form-control place" id="inputEmail4" placeholder="patel">
               </div>
               <div class="col-md-6">
                  <label for="code_religion" class="form-labe caste">
                     <h6>Select Religion</h6>
                  </label>
              
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Update</button>
               </div>
         </div>
         </form>
         <!-- End Example Code -->
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
      $('#investor').DataTable();
   });
</script>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>