<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<div class="property-main">
   <div class="container-fluid">
      <div class="row row-main">
         <div class="col-xl-12 d-flex justify-content-between">
            <div class="today-inquiry-icon d-flex align-items-center">
               <img class="lead-module  " src="../assets/images/leads.svg">
               <h5 class="ps-1 pt-1">Inquiry Report</h5>
            </div>
         </div>
      </div>
      <div class="card card-menu">
         <div class="card-main">
            <div class="row row-line">
               <div class="col-12">
                  <form class="formsize needs-validation" name="occupation_form" novalidate="">
                     <div class="row ">
                        <div class=" col-xl-4 col-md-6 col-sm-6 from-date">
                           <span for="to_date" class="form-label common">To Date To From Date:</span>
                           <div class="d-flex">
                              <input type="text" class="form-control form-controll date" id="from_date"  placeholder="dd/mm/yy">
                              <h6 class="ps-2 pe-2 pt-1">To</h6>
                              <input type="text" class="form-control form-controll  date" id="to_date"  placeholder="dd/mm/yy">
                           </div>
                        </div>
                        <div
                           class="col-xl-8 col-md-6 col-sm-6 justify-content-between align-items-end d-flex  submit-buttons">
                           <div>
                              <button class="btn-submit btn"   id="btn_submit" >submit</button>
                           </div>
                           <div class="file-up-down  add-inquery-btn-groups   d-flex">
                              <i class="bi bi-file-earmark-arrow-up-fill"></i>
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!------------user-report-start---------------->
      <div class="card card-menu">
         <div class="inquiry-analysis m-2">
            <div class="today-inquiry-icon d-flex align-items-center inquiry-report justify-content-center">
               <i class="bi bi-person-plus mb-2"></i>
               <h5>User wise Report</h5>
            </div>
            <div class="d-flex col-12 justify-content-center justify-content-md-between flex-wrap">
               <div class="budget-table col-12">
                  <nav class="scroll-inner">
                     <ul class="user_datas">
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <!-----------------------------user-report-end------------------------------------------->
      <!---------------------------------inquiry-report-start----------------->
      <div class="card card-menu my-2">
         <div class="inquiry-analysis m-3">
            <div class="d-flex col-12 justify-content-center justify-content-md-between flex-wrap">
               <!-------------------------------------inquiry-type-start------------------------------>
               <div class="budget-table col-xl-4 col-sm-12 col-xxs-12">
                  <div class="today-inquiry-icon justify-content-center d-flex align-items-center inquiry-report">
                     <h5>Inquiry Type Report</h5>
                  </div>
                  <nav class="scroll-inner">
                     <ul class="Inquiry_Type_Report">
                     </ul>
                  </nav>
               </div>

               <!---------------inquiry-type-end---------------->


               <!-------------inquiry-source-start----------------->

               <div class="budget-table col-xl-7 col-sm-12 col-xxs-12">
                  <div class="today-inquiry-icon justify-content-center d-flex align-items-center inquiry-report">
                     <h5>Inquiry source Report</h5>
                  </div>
                  <nav class="scroll-inner">
                     <ul class="inq_source_repo_html">
                     </ul>
                  </nav>
               </div>
               <!-----------------inquiry-source-end------------------->
            </div>
         </div>
      </div>
      <!-------------------inquiry-report-end----------------------->
   </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
   $(".date").bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
         });
   $(document).ready(function() {

      function inq_user_wise_report(from_date='',to_date=''){
         $('.loader').show();
         $.ajax({
            type: "post",
            url: "<?= site_url('inq_user_wise_report'); ?>",
            data: {
               from_date: from_date,
               to_date: to_date,
               // table: 'all_inquiry'
            },
            success: function(res) {
               $('.loader').hide();
               var response = JSON.parse(res);
               $('.user_datas').html(response.user_data);
               $('.Inquiry_Type_Report').html(response.Inquiry_Type_Report);
               $('.inq_source_repo_html').html(response.inq_source_repo_html);
            },
         });
      }
      inq_user_wise_report();


      $('body').on('click', '#btn_submit', function(){
         var fromdate= $("#from_date").val();
          var todate = $("#to_date").val();
          inq_user_wise_report(fromdate,todate);
          return false;
      })
  });

   

    


</script>