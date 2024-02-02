<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$broker = 0;
$investor = 0;
$customer = 0;
$username = session_username($_SESSION['username']);

$db = db_connect();
$this->db = \Config\Database::connect();
$qry = 'SELECT SUM(CASE WHEN `is_approve` = 1 AND `master_id` = 0 THEN 1  ELSE 0 END) AS isactive,
      SUM(CASE WHEN (`is_approve`) = 2 OR (`is_approve` = 0 AND `master_id` = 0) THEN 1 ELSE 0 END) AS inactive,
      SUM(CASE WHEN `is_approve` = 0 THEN 1 ELSE 0 END) AS signup FROM `paydone_data`';
$result = $this->db->query($qry);
$count_result = $result->getResultArray();

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
   $get_roll_id_to_roll_duty_var = array();
} else {
   $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}

if (isset($_REQUEST['followup'])) {
   //echo "ddd";
   $getStatusWiseData = getStatusWiseData($_REQUEST['followup']);
} else {
   $getStatusWiseData = getStatusWiseData();
}
if (isset($_REQUEST['followup'])) {
   //echo "ddd";
   $getStatusWiseData = getStatusWiseData($_REQUEST['followup']);
} else {
   $getStatusWiseData = getStatusWiseData();
}

$conversion = booking_count($username . '_booking', $_SESSION['id']);

$visit_and_revisit_count = demo_and_subscription_count($username . '_all_inquiry', $_SESSION['id']);
// $visit_and_revisit_count = 0;

if (isset($visit_and_revisit_count)) {
   $visit = $visit_and_revisit_count[0]['count'];
   if (isset($visit_and_revisit_count[0]['all_data2'])) {
      $revisit = $visit_and_revisit_count[0]['all_data2'][0]['revisit'];
   } else {
      $revisit = 0;
   }
}
?>

<div class="main-dashbord p-2">
   <div class="container-fluid p-0" id="container-fluid">
      <div class="d-flex flex-wrap">
         <?php if (in_array('dashbord_today_task', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
            <div class="col-xl-4 col-lg-12 col-12 d-flex flex-wrap wel-come-flex p-0">
               <div class="col-6 col-sm-6 col-12 p-2">
                  <div class="p-3 bg-white rounded-2 h-100">
                     <div class="title-1">
                        <h2>Today task</h2>
                     </div>
                     <div class="main-task left-main-task mt-2">
                        <div class="d-flex justify-content-between mb-1">
                           <p class="fs-12 text-lg-gray fw-medium">today followup</p>
                           <span class="today_fol fs-12 text-lg-gray fw-medium"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                           <p class="fs-12 text-lg-gray fw-medium">pending followup</p>
                           <span class="pend_fol fs-12 text-lg-gray fw-medium"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                           <p class="fs-12 text-lg-gray fw-medium">total</p>
                           <span class="today_task fs-12 text-lg-gray fw-medium"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-6 col-sm-6 col-12 p-2">
                  <div class="bg-white rounded-2 d-flex justify-content-center align-items-center flex-wrap h-100">
                     <a class="col-12 text-center p-2" href="/site_visit">
                        <p class="btn-primary rounded-2 px-3 mb-2">My Demo</p>
                        <h5 class="text-dark">
                           <?php echo $visit ?>
                        </h5>
                     </a>
                     <div class="col-12 border-bottom border-2"></div>
                     <a class="col-12 text-center p-2" href="/conversion_register">
                        <p class="btn-primary rounded-2 px-3 mb-2">My Subscription</p>
                        <h5 class="text-dark">
                           <?php echo $conversion[0]['booking'] ?>
                        </h5>
                     </a>
                  </div>
               </div>
               <div class="col-12 p-2">
                  <div class="h-100">
                     <table class="main-secondary-normal-table w-100 h-100 perfomance shadow overflow-hidden">
                     </table>
                  </div>
               </div>
            </div>
         <?php } ?>
         <div class="col-xl-8 col-lg-12 col-12 p-0">
            <div class="d-flex flex-wrap">
               <a class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 p-2" href="<?= base_url('subscription') ?>">
                  <div class="bg-white rounded-2 d-flex flex-wrap justify-content-between justify-content-sm-between align-items-center p-3">
                     <div class="box-content">
                        <span class="text-success text-opacity-75 text-capitalize">Active Subscription</span>
                        <p class="text-center text-sm-start text-dark fs-6 fw-medium">
                           <?php echo $count_result[0]['isactive']; ?>
                        </p>
                     </div>
                     <div class="box-icon">
                        <i class="bi bi-clipboard-data"></i>
                     </div>
                  </div>
               </a>
               <a class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 p-2" href="<?= base_url('subscription') ?>">
                  <div class="bg-white rounded-2 d-flex flex-wrap justify-content-between justify-content-sm-between align-items-center p-3">
                     <div class="box-content">
                        <span class="text-success text-opacity-75 text-capitalize">Expired Subscription</span>
                        <p class="text-center text-sm-start text-dark fs-6 fw-medium">
                           <?php echo $count_result[0]['inactive']; ?>
                        </p>
                     </div>
                     <div class="box-icon">
                        <i class="bi bi-arrow-down-up"></i>
                     </div>
                  </div>
               </a>
               <a class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 p-2" href="<?= base_url('subscription') ?>">
                  <div class="bg-white rounded-2 d-flex flex-wrap justify-content-between justify-content-sm-between align-items-center p-3">
                     <div class="box-content">
                        <span class="text-success text-opacity-75 text-capitalize">Sign Up</span>
                        <p class="text-center text-sm-start text-dark fs-6 fw-medium">
                           <?php echo $count_result[0]['signup']; ?>
                        </p>
                     </div>
                     <div class="box-icon">
                        <i class="bi bi-tags"></i>
                     </div>
                  </div>
               </a>
            </div>
            <?php if (in_array('dashbord_chat_table', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <div class="col-12 p-2 chart">
                  <div class="char_color">
                     <div class="px-3 py-2">
                        <div class="d-sm-flex flex-wrap">
                           <div class="ms-auto">
                              <ul class="normal-primary-navtab nav">
                                 <li class="nav-item">
                                    <a class="d-block week">Week</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="d-block active month">Month</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="d-block year">Year</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="column_chartt_week">
                           <div id="column_chartt_week" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="column_chartt_month">
                           <div id="column_chartt_month" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="column_chartt_year">
                           <div id="column_chartt_year" class="apex-charts" dir="ltr"></div>
                        </div>
                     </div>

                  </div>
               </div>
            <?php } ?>
         </div>
         <div class="col-12 d-flex flex-wrap p-0">
            <?php if (in_array('dashbord_followups_section', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <div class="col-xl-4 col-lg-6 col-md-6 col-12 p-2">
                  <div class="bg-white p-2 rounded-2">
                     <div class="title-2 d-flex justify-content-between align-items-center mb-3">
                        <h2>follow ups(<span id="followup_row_count">0</span>)</h2>
                        <a class="btn-secondary btn-sm fs-12 px-2 py-1" href="<?= base_url('user-activity') ?>">more follow ups</a>
                     </div>
                     <ul class="follow-p overflow-auto" id="followup_content" style="height: 476px;">
                     </ul>
                  </div>
               </div>
            <?php } ?>
            <?php if (in_array('dashbord_activity_section', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <div class="col-xl-4 col-lg-6 col-md-6 col-12 p-2">
                  <div class="bg-white p-2 rounded-2">
                     <div class="title-2 d-flex justify-content-between align-items-center mb-3">
                        <h2>activity logs(<span id="activity_row_count">0</span>)</h2>
                        <a class="btn-secondary btn-sm fs-12 px-2 py-1" href="<?= base_url('user-activity') ?>">more activity ups</a>
                     </div>
                     <ul class="activity-ul overflow-auto" id="activity_content" style="height:476px;">
                     </ul>
                  </div>
               </div>
            <?php } ?>
            <?php if (in_array('dashbord_status_wise_in', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <div class="col-xl-4 col-lg-6 col-md-6 col-12 p-2">
                  <div class="bg-white p-2 rounded-2">
                     <div class="title-2">
                        <h2>status wise inq</h2>
                     </div>
                     <?php $getStatusWiseData = getStatusWiseData(); ?>
                     <table class="status-table w-100">
                        <?php
                        foreach ($getStatusWiseData as $inq_status_key => $inq_status_value) {
                           if (is_array($inq_status_value)) {
                        ?>
                              <tr>
                                 <td class="w-50">
                                    <p class="fs-12 text-capitalize">
                                       <?php echo $inq_status_value['inq_status_name']; ?>
                                    </p>
                                 </td>
                                 <td>
                                    <div class="progress-bar rounded-2 w-100 status_color_<?php echo $inq_status_value['inquiry_status']; ?>">
                                       <h5 class="my-1 fs-14 text-white">
                                          <?php echo $inq_status_value['total_inq']; ?>
                                       </h5>
                                    </div>
                                 </td>
                              </tr>
                        <?php
                           }
                        }
                        ?>
                     </table>
                  </div>
               </div>
            <?php } ?>

            <div class="col-xl-6 col-lg-6 col-md-12 col-12 p-2 position-relative dismiss_inq_Report">
               <div class="loader">
                  <div class="ring"></div>
                  <span class="loader-span">loading...</span>
               </div>
               <div class="bg-white p-2 rounded-2 h-100">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <div class="title-2 mb-2">
                        <h2>Dismiss inq Report</h2>
                     </div>
                     <div class="col-6 col-md-5">
                        <div class="main-selectpicker">
                           <select name="dismiss_inq_date" id="dismiss_inq_date" class="selectpicker form-control main-control form-main" data-live-search="true" required="" tabindex="-98">
                              <?php
                              $today = date('Y-m-d');
                              $currentWeekStartDate = date('Y-m-d', strtotime('-7 days'));
                              $currentWeekEndDate = date('Y-m-d');
                              $currentMonthStartDate = date('Y-m-01');
                              $currentMonthEndDate = date('Y-m-t');
                              ?>
                              <option value="<?php echo $today; ?>">Today</option>
                              <option value="<?php echo $currentWeekStartDate . ' to ' . $currentWeekEndDate; ?>">Last
                                 Week
                              </option>
                              <option value="<?php echo $currentMonthStartDate . ' to ' . $currentMonthEndDate; ?>">This
                                 Month
                              </option>
                              <option value="date">Custom Date</option>
                           </select>
                        </div>
                        <input type="text" class="form-control main-control daterange" id="f_di_duration_date" name="duration_date" placeholder="From Date to To Date">
                     </div>
                  </div>
                  <div class="overflow-x-scroll">
                     <table class="pending-main-tables w-100" id="dismiss_inq_report">
                     </table>
                  </div>
               </div>
            </div>

            <?php if (in_array('dashbord_demo_list', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
            <div class="p-2">
               <div class="bg-white p-2 rounded-2">
                  <div class="title-2 mb-2">
                     <h2>Demo List</h2>
                  </div>
                  <div class="overflow-x-scroll">
                     <table class="pending-main-tables">
                        <tr>
                           <th>Product Name</th>
                           <th>Total Inq</th>
                           <th>Total Appoitment</th>
                           <th>Total Demo</th>
                           <th>Total Subscribtiton</th>
                        </tr>
   
   
                        <tbody id="demo_list_data">
   
                        </tbody>
   
                     </table>
                  </div>
               </div>
            </div>
            <?php } ?>

            <?php if (in_array('dashbord_lead_quality', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
            <div class="col-xl-6 col-lg-6 col-md-12 col-12 p-2 position-relative overflow-hidden Lead_Quality_Report">
               <div class="loader">
                  <div class="ring"></div>
                  <span class="loader-span">loading...</span>
               </div>
               <div class="bg-white p-2 rounded-2 h-100">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <div class="title-2 mb-2">
                        <h2>lead Quality Report</h2>
                     </div>
                     <div class="col-6 col-md-5">
                        <div class="main-selectpicker">
                           <select name="lead_quality_date" id="lead_quality_date"
                              class="selectpicker form-control main-control form-main" data-live-search="true" required=""
                              tabindex="-98">
                              <?php
                              $today = date('Y-m-d');
                              $currentWeekStartDate = date('Y-m-d', strtotime('-7 days'));
                              $currentWeekEndDate = date('Y-m-d');
                              $currentMonthStartDate = date('Y-m-01');
                              $currentMonthEndDate = date('Y-m-t');
                              ?>
                              <option value="<?php echo $today; ?>">Today</option>
                              <option selected value="<?php echo $currentWeekStartDate . ' to ' . $currentWeekEndDate; ?>">Last
                                 Week
                              </option>
                              <option value="<?php echo $currentMonthStartDate . ' to ' . $currentMonthEndDate; ?>">This
                                 Month
                              </option>
                              <option value="date">Custom Date</option>
                           </select>
                        </div>
                        <input type="text" class="form-control main-control daterange" id="f_duration_date"
                           name="duration_date" placeholder="From Date to To Date">
                     </div>
                  </div>
                  <div class="overflow-x-scroll">
                     <table class="pending-main-tables w-100" id="lead_quality_report">
                     </table>
                  </div>
               </div>
            </div>
         <?php } ?>
         <?php if (in_array('dashbord_lead_statistics', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
            <div class="col-xl-6 col-lg-6 col-md-12 col-12 p-2">
               <div class="bg-white p-2 rounded-2">
                  <div class="title-2 mb-2">
                     <h2>Lead Statistics Report</h2>
                  </div>
                  <div class="overflow-x-scroll h-100">
                     <table class="pending-main-tables w-100" id="lead_statistics_module_table">
                     </table>
                  </div>
               </div>
            </div>
         <?php } ?>
         <?php if (in_array('dashbord_daily_report', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
            <div class="col-12 p-2">
               <div class="bg-white p-2 rounded-2">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <div class="title-2">
                        <h2>Daily Report</h2>
                     </div>
                     <div class="col-6 col-md-3">
                        <div class="main-selectpicker">
                           <select name="all_status_month" id="all_status_month"
                              class="selectpicker form-control main-control form-main" data-live-search="true"
                              tabindex="-98">
                              <!-- <option value="last_30day">Last 30 Days</option> -->
                              <?php
                              for ($i = 0; $i < 12; $i++) {
                                 $monthValue = date('n', strtotime("-$i months"));
                                 $monthName = date('F-Y', strtotime("-$i months"));
                                 $monthnumwithyear = date('Y-m-t', strtotime("-$i months"));
                                 echo "<option value=\"$monthnumwithyear\">$monthName</option>";
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="pending-main-table">
                     <table class="pending-main-tables w-100" id="all_status">
                     </table>
                  </div>
               </div>
            </div>
         <?php } ?>
         </div>
      </div>
   </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/11.0.1/highcharts.js"></script>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts.php') ?>

<script>
   $(document).ready(function() {
      // function Dashboard_dismiss_inq_report(fromdate, todate) {
      //    // $('.Lead_Quality_Report .loader').show();
      //    $.ajax({
      //       type: 'post',
      //       url: '<?= base_url('Dashboard_dismiss_inq_report') ?>',
      //       data: {
      //          fromdate: fromdate,
      //          todate: todate
      //       },
      //       success: function (res) {
      //          // $('.Lead_Quality_Report .loader').hide();
      //          $('.loader').hide();
      //          $('#dismiss_inq_report').html(res);
      //       }
      //    });
      // }
      // Dashboard_dismiss_inq_report();
      $('#f_duration_date').hide();
      $('#f_di_duration_date').hide();
      $('body').on('change', '#lead_quality_date', function () {
         var select_value = $(this).val();
         if (select_value != '' && select_value != 'date') {
            var split_val = select_value.split(' to ');
            // console.log(split_val);
            $('#f_duration_date').hide();
            Dashboard_get_lead_quality_report(split_val[0], split_val[1]);
         }
         if (select_value == 'date') {
            $('#f_duration_date').show();
         }
      });
      var select_value1 = $("#dismiss_inq_date").val();
      if (select_value1 != '' && select_value1 != 'date') {
         var split_val = select_value1.split(' to ');
         // console.log(split_val);
         $('#f_di_duration_date').hide();
         Dashboard_dismiss_inq_report(split_val[0], split_val[1]);
      }
      if (select_value1 == 'date') {
         $('#f_di_duration_date').show();
      }
      $('body').on('change', '#dismiss_inq_date', function () {
         var select_value = $(this).val();
         if (select_value != '' && select_value != 'date') {
            var split_val = select_value.split(' to ');
            // console.log(split_val);
            $('#f_di_duration_date').hide();
            Dashboard_dismiss_inq_report(split_val[0], split_val[1]);
         }
         if (select_value == 'date') {
            $('#f_di_duration_date').show();
         }
      });
      $('.Lead_Quality_Report .daterange').on('apply.daterangepicker', function (ev, picker) {
         $(this).val(picker.startDate.format('DD-MM-YYYY') + ' to ' + picker.endDate.format('DD-MM-YYYY')).trigger('change');
         Dashboard_get_lead_quality_report(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
      });
      $('.dismiss_inq_Report .daterange').on('apply.daterangepicker', function (ev, picker) {
         $(this).val(picker.startDate.format('DD-MM-YYYY') + ' to ' + picker.endDate.format('DD-MM-YYYY')).trigger('change');
         Dashboard_dismiss_inq_report(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
      });
      // function Dashboard_get_all_status_data(as_month) {
      //    if (as_month) {
      //    } else {
      //       as_month = $('#all_status_month').val();
      //    }
      //    $.ajax({
      //       type: 'post',
      //       url: '<?= base_url('Dashboard_get_all_status_data') ?>',
      //       data: {
      //          month: as_month
      //       },
      //       success: function (res) {
      //          $('.loader').hide();
      //          $('#all_status').html(res);
      //       }
      //    });
      // }
      Dashboard_get_all_status_data();
      $('body').on('change', '#all_status_month', function () {
         var thisval = $(this).val();
         // console.log(thisval);
         if (thisval == 'last_30day') {
            Dashboard_get_all_status_data();
         } else {
            Dashboard_get_all_status_data(thisval);
         }
      });

      //   function Dashboard_get_lead_quality_report(fromdate, todate) {
      //    // $('.Lead_Quality_Report .loader').show();
      //    $.ajax({
      //       type: 'post',
      //       url: '<?= base_url('Dashboard_get_lead_quality_report') ?>',
      //       data: {
      //          fromdate: fromdate,
      //          todate: todate
      //       },
      //       success: function (res) {
      //          // $('.Lead_Quality_Report .loader').hide();
      //          $('.loader').hide();
      //          $('#lead_quality_report').html(res);
      //       }
      //    });
      // }
      Dashboard_get_lead_quality_report();

      // function Dashboard_get_lead_statistics_data() {
      //    $.ajax({
      //       type: 'post',
      //       url: '<?= base_url('Dashboard_get_lead_statistics_data') ?>',
      //       data: {
      //          // month : as_month
      //       },
      //       success: function (res) {
      //          $('.loader').hide();
      //          $('#lead_statistics_module_table').html(res);
      //       }
      //    });
      // }
      Dashboard_get_lead_statistics_data();
      
      // function onScrollCallFunction(pageScrollnum = 1) {
      //    // console.log(pageScrollnum);
      //    if (pageScrollnum === 1) {
      //       today_taskkk();
      //       get_month_data();
      //       Performance_task();
      //       setTimeout(function() {
      //          Dashboard_target_data();
      //          Dashboard_get_user_wise_pendingdata();
      //          Dashboard_get_site_wise_conversion_report_table_data();
      //          // onScrollCallFunction(2);
      //       }, 1000);
      //       // if () {
      //          //    onScrollCallFunction(2);
      //          // }
      //       } else if (pageScrollnum === 2) {
      //          Dashboard_get_user_wise_conversion_report_table_data();
      //          Dashboard_get_lead_statistics_data();
      //          Dashboard_get_user_wise_visit_report_table_data();

      //       var date_for_lead_quality_report = $('#lead_quality_date').val();
      //       if (date_for_lead_quality_report !== '' && date_for_lead_quality_report !== 'date') {
      //          var split_val = date_for_lead_quality_report.split(' to ');
      //          $('#f_di_duration_date').hide();
      //          Dashboard_get_lead_quality_report(split_val[0], split_val[1]);
      //       } else if (date_for_lead_quality_report === 'date') {
      //          $('#f_di_duration_date').show();
      //       }
      //       // setTimeout(function() {
      //       //    onScrollCallFunction(3);
      //       // }, 3000);
      //    } else if (pageScrollnum === 3) {
      //       Dashboard_dismiss_inq_report();
      //       Dashboard_get_inquiry_source_data();
      //       get_activity_data();
      //       Dashboard_get_all_status_data();
      //    }
      // }
 
   });

   $(document).ready(function() {
      $('.daterange').daterangepicker({
         autoApply: true,
         // parentEl : 'body',
         drops: 'up',
         autoUpdateInput: false,
         opens: 'left',
         parentEl: 'auto',
         endDate: new Date(),
         locale: {
            cancelLabel: 'Clear'
         },
      });

      function date_wise_data() {
         $('.loader').show();
         $.ajax({
            method: "post",
            url: "<?= site_url('Dashboard_date_wise_data'); ?>",
            data: {
               'action': true,
               countwise: 'week'

            },
            success: function(res) {
               var response = JSON.parse(res);
               // console.log(response);
               var week_day = [];
               var week_appo = [];
               var week_booking = [];
               var week_visite = [];
               var week_visiteaa = [];
               var week_inquiry = [];
               var week_inquiryaaa = [];
               var week_can_booking = [];
               $.each(response, function(idx2, val2) {
                  week_day.push(val2.day);
                  week_appo.push(parseInt(val2.appoiment));
                  week_booking.push(parseInt(val2.booking));
                  week_visite.push(parseInt(val2.visit / 10));
                  week_can_booking.push(parseInt(val2.cancel_booking));
                  week_visiteaa.push(parseInt(val2.visit));
                  week_inquiryaaa.push(parseInt(val2.inquiry));
                  week_inquiry.push(parseInt(val2.inquiry / 100));
               });

               // console.log(week_day);

               Highcharts.chart('column_chartt_week', {
                  title: {
                     text: 'Weekly Average Inquiry'
                  },

                  chart: {
                     type: 'column',
                     height: 300,

                  },
                  xAxis: {
                     categories: week_day
                  },

                  plotOptions: {
                     column: {
                        stacking: 'normal'
                     }
                  },
                  colors: ["#E384FF", "#865DFF", "#b55dcd", "#556ee6"],


                  tooltip: {
                     formatter: function() {
                        //console.log(this);
                        var seriesName = this.series.name;
                        var xValue = this.point.x;
                        var yValue = this.point.y;
                        var customValue = this.point.customValue;
                        var inqValue = this.series.userOptions.inq[this.point.index];

                        return '<b>' + seriesName + ':</b> ' + inqValue;
                     }
                  },
                  series: [{
                        name: "Inquiry",
                        data: week_inquiry,
                        inq: week_inquiryaaa,
                        stack: 0
                     }, {
                        name: "Appointment",
                        data: week_appo,
                        inq: week_appo,
                        stack: 1
                     }, {
                        name: "Demo",
                        data: week_visite,
                        inq: week_visiteaa,
                        stack: 2
                     }, {
                        name: "Subscription",
                        data: week_booking,
                        inq: week_booking,
                        stack: 3

                     },

                  ]
               });
               // var options = {
               //    series: [{
               //       name: "Inquiry",
               //       data: week_inquiry,
               //        inq:week_inquiryaaa,
               //        stack: 0
               //    },
               //    {
               //       name: "Appointment",
               //       data: week_appo,
               //        inq:week_appo,
               //        stack: 1
               //    },
               //    {
               //       name: "Visit",
               //       data: week_visite,
               //       inq:week_visiteaa,
               //       stack: 2
               //    },
               //    {
               //       name: "Cancle Booking",
               //       data: week_can_booking,
               //       inq: week_can_booking,
               //       stack: 3

               //    },
               //    {
               //       name: "Conversion",
               //       data: week_booking,
               //        inq:week_booking,
               //        stack: 3
               //    },
               //    ],
               //    chart: {
               //       type: "bar",
               //       height: 200,
               //    },
               //    plotOptions: {
               //       bar: {
               //          horizontal: false,
               //          columnWidth: "55%",
               //          endingShape: "rounded",
               //       },
               //    },
               //    dataLabels: {
               //       enabled: false,
               //    },
               //    stroke: {
               //       show: true,
               //       width: 2,
               //       colors: ["transparent"],
               //    },
               //    colors: ["#E384FF", "#865DFF", "#b55dcd", "#556ee6"],
               //    xaxis: {
               //       categories: week_day,
               //    },
               //    yaxis: {
               //       title: {
               //          text: "Inquiry",
               //       },
               //    },
               //    fill: {
               //       opacity: 1,
               //    },
               //   tooltip: {
               //       custom: function({series, seriesIndex, dataPointIndex, w}) {
               //            var data = w.globals.initialSeries[seriesIndex].inq[dataPointIndex];
               //              return '<span>'+w.globals.initialSeries[seriesIndex].name+':'+ data + '</span>';
               //           }
               //   },
               // };

               // var chart = new ApexCharts(document.querySelector("#column_chartt_week"), options);
               // chart.render();

               $('.loader').hide();
            },
            error: function(error) {
               $('.loader').hide();
            }
         });
      }


      // function today_taskkk() {

      //    $.ajax({
      //       // datatype: 'json',
      //       method: "post",

      //       url: "<?= site_url('Front_today_task'); ?>",
      //       data: {
      //          'table': 'all_inquiry',
      //          'action': true
      //       },
      //       success: function(res) {
      //          var response = JSON.parse(res);
      //          $(".today_task").text(response.all_inquiry);
      //          $(".today_fol").text(response.today_inq_count);
      //          $(".pend_fol").text(response.pending_inq_count);
      //       },
      //       error: function(error) {
      //          $('.loader').hide();
      //       }
      //    });
      // }
      today_taskkk();

      // function demo_list_data() {

      //    $.ajax({
      //       // datatype: 'json',
      //       method: "post",

      //       url: "<?= site_url('demo_list_data'); ?>",
      //       data: {
      //          'table': 'all_inquiry',
      //          'action': true
      //       },
      //       success: function(res) {
      //          var response = JSON.parse(res);
      //          $('#demo_list_data').html(response.html)
      //       },
      //       error: function(error) {
      //          $('.loader').hide();
      //       }
      //    });
      // }
      demo_list_data();

      // function Performance_task() {
      //    $.ajax({
      //       method: "post",
      //       url: "<?= site_url('Performance_task'); ?>",
      //       data: {
      //          'table': 'all_inquiry',
      //          'action': true
      //       },
      //       success: function(res) {

      //          var response = JSON.parse(res);
      //          $(".perfomance").html(response);
      //          // $(".today_fol").text(response.today_inq_count);
      //          // $(".pend_fol").text(response.pending_inq_count);
      //       },
      //       error: function(error) {
      //          $('.loader').hide();
      //       }
      //    });
      // }
      Performance_task();

      $("body").on('click', '.week', function(e) {
         // alert("hello");
         $(this).addClass('active');
         $(".month").removeClass('active');
         $(".year").removeClass('active');
         $(".column_chartt_month").hide();
         $(".column_chartt_year").hide();
         $(".column_chartt_week").show();
         date_wise_data();
      });

      if ($(".month").hasClass("month")) {
         get_month_data();
      }

      // function get_month_data() {
      //    $('.loader').show();
      //    $.ajax({
      //       method: "post",
      //       url: "<?= site_url('Dashboard_date_wise_data'); ?>",
      //       data: {
      //          'action': true,
      //          countwise: 'month'
      //       },
      //       success: function(res) {
      //          $('.loader').hide();

      //          var response = JSON.parse(res);

      //          var month = [];
      //          var month_appo = [];
      //          var month_booking = [];
      //          var month_visite = [];
      //          var month_visiteaa = [];
      //          var month_inquiry = [];
      //          var month_inquiryaaa = [];
      //          var month_appoaa = [];
      //          var month_can_booking = [];

      //          $.each(response, function(idx3, val3) {

      //             month.push(val3.month);
      //             month_appoaa.push(parseInt(val3.appoiment));
      //             month_appo.push(parseInt(val3.appoiment / 10));
      //             month_booking.push(parseInt(val3.booking));
      //             month_can_booking.push(parseInt(val3.cancle_booking));
      //             month_visite.push(parseInt(val3.visit / 10));
      //             month_visiteaa.push(parseInt(val3.visit));
      //             month_inquiryaaa.push(parseInt(val3.inquiry));
      //             month_inquiry.push(val3.inquiry / 100);
      //          });
      //          // console.log(month_appo);
      //          // console.log(month_visite);
      //          //  console.log(month_inquiry);
      //          //  console.log(month_booking);
      //          Highcharts.chart('column_chartt_month', {
      //             title: {
      //                text: 'Monthly Average Inquiry'
      //             },
      //             chart: {
      //                type: 'column',
      //                height: 300,
      //             },

      //             xAxis: {
      //                categories: month
      //             },

      //             plotOptions: {
      //                column: {
      //                   stacking: 'normal'
      //                }
      //             },
      //             colors: ["#E384FF", "#865DFF", "#b55dcd", "#556ee6"],


      //             tooltip: {
      //                formatter: function() {
      //                   //console.log(this);
      //                   var seriesName = this.series.name;
      //                   var xValue = this.point.x;
      //                   var yValue = this.point.y;
      //                   var customValue = this.point.customValue;
      //                   var inqValue = this.series.userOptions.inq[this.point.index];

      //                   return '<b>' + seriesName + ':</b> ' + inqValue;
      //                }
      //             },

      //             series: [{
      //                   name: "Inquiry",
      //                   data: month_inquiry,
      //                   inq: month_inquiryaaa,
      //                   stack: 0
      //                }, {
      //                   name: "Appointment",
      //                   data: month_appo,
      //                   inq: month_appoaa,
      //                   stack: 1
      //                }, {
      //                   name: "Demo",
      //                   data: month_visite,
      //                   inq: month_visiteaa,
      //                   stack: 2
      //                }, {
      //                   name: "Subscription",
      //                   data: month_booking,
      //                   inq: month_booking,
      //                   stack: 3

      //                },

      //             ]
      //          });

      //          $('.loader').hide();
      //       },
      //       error: function(error) {
      //          $('.loader').hide();
      //       }
      //    });
      // }

      // function datatable_view(html) {
      //    $('#investor_data').DataTable().destroy();
      //    $('#investor_list').html(html);
      //    var table1 = $('#investor_data').DataTable({
      //       "columnDefs": [{
      //          "visible": false,
      //       }],
      //       lengthChange: true,
      //       // buttons: ['copy', 'excel', 'pdf', 'colvis']
      //    });
      //    //  table1.buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');
      //    //  table1.page( 0 ).draw('page');
      // }


      $("body").on('click', '.month', function(e) {
         //  alert("hello");
         $(this).addClass('active');
         $(".week").removeClass('active');
         $(".year").removeClass('active');
         $(".column_chartt_week").hide();
         $(".column_chartt_year").hide();
         $(".column_chartt_month").show();
         get_month_data();
      });


      // function get_year_data() {
      //    $('.loader').show();
      //    $.ajax({
      //       method: "post",
      //       url: "<?= site_url('Dashboard_date_wise_data'); ?>",
      //       data: {
      //          'action': true,
      //          countwise: 'year'
      //       },
      //       success: function(res) {

      //          var response = JSON.parse(res);
      //          // console.log(response);
      //          // week inquiry
      //          // var value = response.week_inquiry;
      //          //  console.log(response);

      //          var year = [];
      //          var year_appo = [];
      //          var year_booking = [];
      //          var year_visite = [];
      //          var year_visiteaa = [];
      //          var year_inquiry = [];
      //          var year_inquiryaa = [];
      //          var year_can_booking = [];


      //          $.each(response, function(idx5, val5) {

      //             // console.log(idx5);
      //             // console.log(val5.inquiry);
      //             // var str = idx2;
      //             year.push(val5.year);
      //             year_appo.push(parseInt(val5.appoiment));
      //             year_booking.push(parseInt(val5.booking));
      //             year_can_booking.push(parseInt(val5.cancle_booking));
      //             year_visiteaa.push(parseInt(val5.visit));
      //             year_visite.push(parseInt(val5.visit / 10));
      //             year_inquiryaa.push(parseInt(val5.inquiry));
      //             year_inquiry.push(parseInt(val5.inquiry / 100));

      //             // var str_val = val2;
      //             // week_val.push(str_val);
      //          });
      //          //  console.log( year_visite);
      //          Highcharts.chart('column_chartt_year', {
      //             title: {
      //                text: 'Yearly Average Inquiry'
      //             },
      //             chart: {
      //                type: 'column',
      //                height: 300,
      //             },

      //             xAxis: {
      //                categories: year,
      //             },

      //             plotOptions: {
      //                column: {
      //                   stacking: 'normal'
      //                }
      //             },
      //             colors: ["#E384FF", "#865DFF", "#b55dcd", "#556ee6"],


      //             tooltip: {
      //                formatter: function() {
      //                   //console.log(this);
      //                   var seriesName = this.series.name;
      //                   var xValue = this.point.x;
      //                   var yValue = this.point.y;
      //                   var customValue = this.point.customValue;
      //                   var inqValue = this.series.userOptions.inq[this.point.index];

      //                   return '<b>' + seriesName + ':</b> ' + inqValue;
      //                }
      //             },
      //             series: [{
      //                   name: "Inquiry",
      //                   data: year_inquiry,
      //                   inq: year_inquiryaa,
      //                   stack: 0
      //                }, {
      //                   name: "Appointment",
      //                   data: year_appo,
      //                   inq: year_appo,
      //                   stack: 1
      //                }, {
      //                   name: "Demo",
      //                   data: year_visite,
      //                   inq: year_visiteaa,
      //                   stack: 2
      //                }, {
      //                   name: "Subscription",
      //                   data: year_booking,
      //                   inq: year_booking,
      //                   stack: 3

      //                },

      //             ]
      //          });

      //          // var options = {
      //          //    series: [{
      //          //       name: "Inquiry",
      //          //       data: year_inquiry,
      //          //       inq: year_inquiryaa,
      //          //       stack: 0
      //          //    },
      //          //    {
      //          //       name: "Appointment",
      //          //       data: year_appo,
      //          //        inq: year_appo,
      //          //        stack: 1
      //          //    },
      //          //    {
      //          //       name: "Visit",
      //          //       data: year_visite,
      //          //       inq: year_visiteaa,
      //          //       stack: 2
      //          //    },
      //          //    {
      //          //       name: "Cancle Booking",
      //          //       data: year_can_booking,
      //          //       inq: year_can_booking,
      //          //       stack: 3

      //          //    },
      //          //    {
      //          //       name: "Conversion",
      //          //       data: year_booking,
      //          //        inq: year_booking,
      //          //        stack: 3
      //          //    },
      //          //    ],
      //          //    chart: {
      //          //       type: "bar",
      //          //       height: 200,
      //          //    },
      //          //    plotOptions: {
      //          //       bar: {
      //          //          horizontal: false,
      //          //          columnWidth: "55%",
      //          //          endingShape: "rounded",
      //          //       },
      //          //    },
      //          //    dataLabels: {
      //          //       enabled: false,
      //          //    },
      //          //    stroke: {
      //          //       show: true,
      //          //       width: 2,
      //          //       colors: ["transparent"],
      //          //    },
      //          //    colors: ["#E384FF", "#865DFF", "#b55dcd", "#556ee6"],
      //          //    xaxis: {
      //          //       categories: year,
      //          //    },
      //          //    yaxis: {
      //          //       title: {
      //          //          text: "Inquiry",
      //          //       },
      //          //    },
      //          //    fill: {
      //          //       opacity: 1,
      //          //    },
      //          //   tooltip: {
      //          //       custom: function({series, seriesIndex, dataPointIndex, w}) {
      //          //            var data = w.globals.initialSeries[seriesIndex].inq[dataPointIndex];
      //          //              return '<span>'+w.globals.initialSeries[seriesIndex].name+':'+ data + '</span>';
      //          //           }
      //          //   },
      //          // };

      //          // var chart = new ApexCharts(document.querySelector("#column_chartt_year"), options);
      //          // chart.render();



      //          $('.loader').hide();
      //       },
      //       error: function(error) {
      //          $('.loader').hide();
      //       }
      //    });

      // }


      $("body").on('click', '.year', function(e) {
         $(this).addClass('active');
         $(".week").removeClass('active');
         $(".month").removeClass('active');
         $(".column_chartt_week").hide();
         $(".column_chartt_month").hide();
         $(".column_chartt_year").show();
         get_year_data();
      });


      // function get_followup_data() {
      //    var date_dashboard = '';
      //    var followup_user_list = 0;
      //    // $('.loader').show();
      //    $.ajax({
      //       // datatype: 'json',
      //       method: "post",
      //       url: "<?= site_url('get_data_followup_tab_fresh'); ?>",
      //       data: {
      //          'date_dashboard': date_dashboard,
      //          'followup_user_list': followup_user_list,
      //          'action': true
      //       },
      //       success: function(res) {
      //          var response = JSON.parse(res);
      //          if (response.result == 1) {
      //             // console.log(response);
      //             $('#followup_row_count').html(response.row_count);
      //             $('#followup_content').html(response.followup_data_html);

      //          } else {
      //             $('#followup_row_count').html(response.row_count);
      //             $('#followup_content').html(response.followup_data_html);
      //          }
      //          $('.loader').hide();
      //       },
      //       error: function(error) {
      //          $('.loader').hide();
      //       }
      //    });
      // }

      get_followup_data();

      setInterval(function() {
         get_followup_data();
      }, 10000);


      // function get_activity_data() {
      //    var date_activity_dashboard = '';
      //    var activity_user_list = 0;

      //    $.ajax({
      //       method: "post",
      //       url: "<?= site_url('get_data_activity_tab_fresh'); ?>",
      //       data: {
      //          'date_activity_dashboard': date_activity_dashboard,
      //          'activity_user_list': activity_user_list,
      //          'action': true
      //       },
      //       success: function(res) {
      //          var response = JSON.parse(res);
      //          if (response.result == 1) {

      //             $('#activity_row_count').html(response.row_count);
      //             $('#activity_content').html(response.activity_data_html);
      //          } else {
      //             $('#activity_row_count').html(response.row_count);
      //             $('#activity_content').html(response.activity_data_html);
      //          }
      //          $('.loader').hide();
      //       },
      //       error: function(error) {
      //          $('.loader').hide();
      //       }
      //    });
      // }

      get_activity_data();

      setInterval(function() {
         get_activity_data();
      }, 10000);
   });
</script>