<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
     $get_roll_id_to_roll_duty_var = array();
} else {
     $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
?>
<div class="main-dashbord p-2">
     <div class="container-fluid p-0">
          <div class="p-2">
               <div class="col-xl-12 d-flex justify-content-between">
                    <div class="title-1  d-flex align-items-center">
                         <i class="fa-solid fa-phone"></i>
                         <h2>Phone Number</h2>
                    </div>
                    <div class="d-flex align-items-center col-1    ">
                         <div class="main-selectpicker col">
                              <select id="product_type" name="product_type"
                                   class="selectpicker form-control form-main main-control product_type"
                                   data-live-search="true" required="" tabindex="-98">
                                   <option value="1" class="dropdown-item">Realtoart</option>
                              </select>
                         </div>
                         <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn-primary-rounded mx-2" >
                              <i class="bi bi-plus"></i>
                         </button>
                    </div>
               </div>
          </div>
     </div>
     <div class="container-fluid p-0 mt-4 bg-white border rounded-3">
          <div class="row">
               <div class="p-2">
                    <div class="col-xl-12 d-flex p-2 px-4 d-flex flex-wrap">
                         <div class="col-3">
                              <div class="d-flex input-group">
                                   <span class="input-group-text" id="basic-addon2"><i
                                             class="fa-solid fa-magnifying-glass"></i></span>
                                   <input type="number" min="0" step="0.01" class="form-control main-control "
                                        id="coupon_value" name="coupon_value" placeholder="Coupon Value" required="">
                              </div>
                         </div>
                         <div class="col-2 mx-2">
                              <div class="d-flex input-group">
                                   <span class="input-group-text border-end-0" id="basic-addon2"><i
                                             class="fa-solid fa-magnifying-glass"></i></span>
                                   <div class="main-selectpicker col">
                                        <select id="product_type" name="product_type"
                                             class="border  border-start-0 rounded-start-0 selectpicker form-control form-main main-control product_type"
                                             data-live-search="true" required="" tabindex="-98">
                                             <option value="1" class="dropdown-item d-flex flex-wrap ">
                                                  <p>Filter</p>
                                             </option>
                                             <option value="1" class="dropdown-item">Filter</option>
                                             <option value="1" class="dropdown-item">Filter</option>
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <div class="d-flex align-items-center col-1 mx-2">

                         </div>
                         <div class="col-12 w-100  my-3">
                              <table class="table table-borderless">
                                   <thead>
                                        <tr class="border-bottom">
                                             <th scope="col"><span class="text-muted phone-header">Phone Number <span class="mx-2"><i class="bi bi-arrow-up"></i></span></span></th>
                                             <th scope="col"><span class="text-muted phone-header">Status <span class="mx-2"><i class="bi bi-arrow-down-up"></i></span></span></th>
                                             <th scope="col"><span class="text-muted phone-header">Quality rating <span class="mx-2"><i class="bi bi-arrow-down-up"></i></span></span></th>
                                             <th scope="col" style="max-width: 150px;"><span class="text-muted phone-header" >Messaging Limit <span class="mx-2"><i class="bi bi-arrow-down-up"></i></span></span></th>
                                             <th scope="col"><span class="text-muted phone-header">Country <span class="mx-2"><i class="bi bi-arrow-down-up"></i></span></span></th>
                                             <th scope="col"><span class="text-muted phone-header">Name <span class="mx-2"><i class="bi bi-arrow-down-up"></i></span></span></th>
                                             <th scope="col"><span class="text-muted phone-header">Certificate</span></th>
                                             <th scope="col"><span class="text-muted phone-header">Delete</span></th>
                                             <th scope="col"><span class="text-muted phone-header">Setting</span></th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                             <td class="align-middle" scope="col-2"><sup class="fs-12">IN</sup> +91 7600176982</td>
                                             <td class="align-middle" scope="col-1"><span class="p-1 bg-success-subtle border border-light rounded-pill fs-10 text-success fw-bold ">Connected</span></td>
                                             <td class="align-middle" scope="col-1">
                                                  <span class="d-inline-block bg-success border border-light rounded-circle" style="width:11px;height:11px"></span>
                                                  <span Class="mx-2">High</span>
                                             </td>
                                             <td class="align-middle text-truncate messeging-content" style="max-width: 150px;" scope="col-2">10 k customers/ Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga, blanditiis!</td>
                                             <td class="align-middle" scope="col-1">India</td>
                                             <td class="align-middle" scope="col-2">Realtosmart</td>
                                             <td class="align-middle" scope="col-1 text-center">
                                                  <button class="btn border rounded-3">
                                                       View
                                                  </button>
                                             </td>
                                             <td class="align-middle" scope="col-1">
                                                  <button class="btn border rounded-3">
                                                       <i class="fa-solid fa-trash-can"></i>
                                                  </button>
                                             </td>
                                             <td class="align-middle" scope="col-1">
                                                  <button class="btn border rounded-3">
                                                       <i class="fa-solid fa-gear"></i>
                                                  </button>
                                             </td>
                                        </tr>
                                   </tbody>
                                   <tfoot>
                                        <tr class="border-top">
                                             <td colspan="8" class="p-1"><span class="fs-12    ">1 Phone Number</span></td>
                                        </tr>
                                   </tfoot>
                              </table>
                         </div>
                    </div>

               </div>
          </div>
          <div class="row">

          </div>
     </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="needs-validation row" name="fb_cnt" method="POST" novalidate="">
               <div class="col-12">
                    <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                    <textarea type="text" class="form-control main-control" id="access_token" name="access_token" placeholder="Enter Access Token" required></textarea>
               </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
     $('body').on('click','.phone-header',function(){
          $(this).removeClass('text-muted');
          $(this).closest('th').siblings('th').children('span').addClass('text-muted');
          
     })
     // document.body.contentEditable = 'true';
     $('body').on('hover','.messeging-content',function(){
          alert('jdfdff');
          $(this).css('font-weight','500');
     })
</script>