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
                         <i class="bi bi-people me-2"></i>
                         <h2>Manage Invoice</h2>
                    </div>
                    <div class="d-flex align-items-center">
                         <?php if (in_array('invoice_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                              <div id="deleted-all" class="mx-1">
                                   <span class="btn-primary-rounded elevation_add_button add-button">
                                        <i class="bi bi-trash3 fs-14"></i>
                                   </span>
                              </div>
                         <?php } ?>
                         <span class="btn-primary-rounded elevation_add_button add-button" data-bs-toggle="modal" data-bs-target="#invoice-add" data-bs-dismiss="modal" data-delete_id="">
                              <i class="bi bi-plus"></i>
                         </span>
                    </div>
               </div>
          </div>

          <div class="px-3 py-2 bg-white rounded-2 mx-2">
               <table id="user_table" class="table main-table w-100">
                    <thead class="table-heading">
                         <tr class="main">
                              <th>
                                   <input class="check_box" type="checkbox" id="select-all" />
                              </th>
                              <th>
                                   <span>User</span>
                              </th>
                         </tr>
                    </thead>
                    <tbody id="user_list">
                         <tr class="odd">
                              <td class="dtr-control sorting_1" tabindex="0">
                                   <input class="checkbox" type="checkbox" value="6">
                              </td>
                              <td class="edt" data-edit_id="6">
                                   <div class=" px-0 py-0 w-100" data-bs-toggle="modal" data-bs-target="#invoice-edit">
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                             <div class="col">
                                                  <b>6</b>
                                                  <span class="mx-1">Rahul</span>
                                             </div>
                                             <div class="col">
                                                  <b>TXN :</b>
                                                  <span class="mx-1">2023-06-18</span>
                                             </div>
                                             <div class="col">
                                                  <b>MEMBERSHIP :</b>
                                                  <span class="mx-1">Golden Package L2</span>
                                             </div>
                                             <div class="col">
                                                  <b>DURATION :</b>
                                                  <span class="mx-1">2023-04-02 to 2023-04-02</span>
                                             </div>
                                             <div class="col">
                                                  <b>AMOUNT :</b>
                                                  <span class="mx-1">30000</span>
                                             </div>
                                             <div class="col">
                                                  <b>By :</b>
                                                  <span class="mx-1">Mili Patel</span>
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

<div class="modal fade" id="invoice-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h2 class="modal-title fs-5 text-bold" id="exampleModalLabel">Add Invoice</h2>
                    <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                         <i class="bi bi-x-circle"></i>
                    </button>
               </div>
               <div class="modal-body">
                    <form class="needs-validation" novalidate>
                         <span class="">Membership</span>
                         <span class="fw-bold ">standard package</span>
                         <div class="main_date d-flex w-100 justify-content-around">
                              <div class="start_date w-100">
                                   <p>Start date</p>
                                   <p class="fw-bold">13-Feb-2023</p>
                              </div>
                              <div class="end_date w-100">
                                   <p>end date</p>
                                   <p class="fw-bold">12-Feb-2024</p>
                              </div>
                         </div>
                         <div class="amount">
                              <span>amount</span>
                              <p class=" fw-bold text-success-emphasis">₹7,000</p>
                         </div>
                         <div class="txn">
                              <span>Txn</span>
                              <p class="fw-bold">02-May-2023 01:38 AM</p>
                         </div>
                         <div class="row mt-3">
                              <div class="single_form pe-2 col-lg-6 col-md-12 input-text">
                                   <label for="" class="mb-1">Payment mode</label>
                                   <div class="main-selectpicker">
                                        <select name="" id="occupationname"
                                             class="selectpicker form-control form-main select"
                                             data-live-search="true" required="" tabindex="-98">
                                             <option selected=""><img
                                                       src="../assets/image/amazon_pay.png" alt="">
                                                  Amazon Pay </option>
                                             <option> <img src="../assets/image/bank_transfer.png"
                                                       alt="">
                                                  Bank Transfer</option>
                                             <option> <img src="../assets/image/card.png" alt=""> Card
                                             </option>
                                             <option> <img src="../assets/image/cash.png" alt=""> Cash
                                             </option>
                                             <option> <img src="../assets/image/gpay.png" alt=""> Google
                                                  Pay
                                             </option>
                                             <option> <img src="../assets/image/paytm.png" alt=""> Paytm
                                             </option>
                                             <option> <img src="../assets/image/phonepe.png" alt="">
                                                  PhonePe
                                             </option>
                                             <option> <img src="../assets/image/upi.png" alt=""> UPI
                                             </option>
                                        </select>
                                   </div>
                              </div>
                              <div class="single_form col-lg-6 col-md-12 input-text">
                                   <label for="" class="mb-1">Collected by</label>
                                   <div class="main-selectpicker">
                                        <select name="" id="occupationname"
                                             class="selectpicker form-control form-main"
                                             data-live-search="true" required="" tabindex="-98">
                                             <option selected=""> ADMIN</option>
                                             <option> Mili Patel</option>
                                             <option> Urvi</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="mat_date col-12 mt- input-text">
                                   <label for="" class="col-12 mb-1">Date</label>
                                   <input type="text" id="dob" name="dob"
                                        class="dob  input_count dob p-2 form-control main-control"
                                        data-dtp="dtp_Ivnrs" placeholder="DD-MM-YYYY">
                              </div>
                              <div class="col-12 mt-4 input-text">
                                   <textarea name="" placeholder="Remark" class="rounded-1 mat_textarea form-control main-control w-100 p-2" style="" id="" cols="30" rows="5"></textarea>
                              </div>
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn-secondary" id="cancel" data-bs-dismiss="modal" data-bs-toggle="modal"
                         data-bs-target="#subscription_delete" data-delete_id="1">Cancel</button>
                    <button class="btn-primary btn-update" id="add" data-edit_id="1" name="subscription_update"
                         data-bs-dismiss="modal" value="subscription_update">Add</button>
               </div>
          </div>
     </div>
</div>


<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>



<script>
     $(document).ready(function () {
          $("#deleted-all").hide();
          $("body").on('change', '#select-all', function () {
               var deleteButton = $("#deleted-all");
               if ($(this).is(":checked")) {
                    // deleteButton.removeClass("hide");
                    deleteButton.show();
               } else {
                    // deleteButton.addClass("hide");
                    deleteButton.hide();
               }
               checkIfAnyCheckboxChecked();
          });
          function checkIfAnyCheckboxChecked() {
               if ($('.checkbox:checked').length > 0) {
                    // alert();
                    $("#deleted-all").show();
               } else {
                    // alert();
                    $("#deleted-all").hide();
               }
          }

          $('body').on('change', '.checkbox', function () {
               // alert();
               var deleteButton = $("#deleted-all");
               // if($(this).is(":checked")){
               checkIfAnyCheckboxChecked();
          });
          checkIfAnyCheckboxChecked();

          $('body').on('click', '#deleted-all', function () {
               //   alert("hello");
               var project_length_show = $('#project_length_show').val();
               var checkbox = $('.checkbox:checked');

               if (checkbox.length > 0) {
                    var checkbox_value = [];
                    $(checkbox).each(function () {
                         checkbox_value.push($(this).val());
                    });
                    // console.log(checkbox_value);
                    // return 1;
                    iziToast.delete({
                         message: 'Are You Sure',
                         buttons: [
                              ['<button>delete</button>', function (instance, toast) {
                                   $.ajax({
                                        url: "<?= site_url('delete_all'); ?>",
                                        method: "post",
                                        data: {
                                             action: 'delete',
                                             checkbox_value: checkbox_value,
                                             table: '',
                                        },
                                        success: function (data) {
                                             //  console.log(data);
                                             $(checkbox).closest("tr").fadeOut();
                                             // $('.removeRow').fadeOut(1500);
                                             list_data('admin_user', '', '', project_length_show);
                                             iziToast.success({
                                                  title: 'Delete Successfully'
                                             });
                                        }
                                   });
                              }, true], // true to focus
                              ['<button>Close</button>', function (instance, toast) {
                                   instance.hide({
                                        transitionOut: 'fadeOutUp',
                                        onClosing: function (instance, toast, closedBy) {
                                             console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                                        }
                                   }, toast, 'buttonName');
                              }]
                         ],
                         onOpening: function (instance, toast) {
                              console.info('callback abriu!');
                         },
                         onClosing: function (instance, toast, closedBy) {
                              console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                         }
                    });

               }
               else {
                    alert('Select atleast one records');
               }
          });


          $('.user-tables').DataTable();
          $(".dob").bootstrapMaterialDatePicker({
               minDate: new Date(),
               format: 'DD/MM/YYYY',
               cancelText: 'cancel',
               okText: 'ok',
               clearText: 'clear',
               time: false,
          });
          //   $('#deleteButton').hide();
          //   $(".user-table").on('click', 'input[type="checkbox"]', function () {
          //       var deleteButton = $("#deleteButton");
          //       if ($(this).is(":checked")) {
          //           deleteButton.show();
          //       } else {
          //           deleteButton.hide();
          //       }
          //   });

          function checkIfAnyCheckboxChecked(inputid, deletebtn) {
               if ($(inputid + ':checked').length > 0) {
                    // alert();
                    deletebtn.show();
               } else {
                    // alert();
                    deletebtn.hide();
               }
          }


          $('#deleteButton').hide();
          $(".user-table").on('click', 'input[type="checkbox"]', function () {
               var deletebtn = $("#deleteButton");
               var input = ".cstm-check";
               checkIfAnyCheckboxChecked(input, deletebtn);

          });


          var selectAllItems = "#select-all";
          var checkboxItem = ".checkbox";

          $(selectAllItems).click(function () {

               if (this.checked) {
                    $(checkboxItem).each(function () {
                         this.checked = true;
                    });
               } else {
                    $(checkboxItem).each(function () {
                         this.checked = false;
                    });
               }

          });
     });
</script>