<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<div class="main-dashbord p-2">
	<div class="container-fluid p-0">
		<div class="p-2">
			<div class="title-1">
				<i class="bi bi-people"></i>
				<h2>Attendance</h2>
			</div>
		</div>
		<div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
			<form class="needs-validation" name="departmentname_val" method="POST" novalidate="">
				<div class="d-flex align-items-center flex-wrap gap-0 row-gap-3">
					<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12 d-flex align-items-center">
						<label class="form-label main-label">Month</label>
						<div class="main-selectpicker w-100" id="investor_list_select_table">
							<?php
							$currentMonth = date('n'); // Get the current month as a numeric value (1-12)
							function isSelected($optionValue, $currentMonth)
							{
								if ($optionValue == $currentMonth) {
									return 'selected';
								}
								return '';
							}
							?>
							<select name="month" id="attendance_month" class="selectpicker form-control select form-main" data-live-search="true" required>
								<option class="     -item" disabled>--Select Month--</option>
								<?php
								for ($i = 1; $i <= 12; $i++) {
									$formattedMonth = str_pad($i, 2, '0', STR_PAD_LEFT);
									echo '<option value="' . $formattedMonth . '" ' . isSelected($i, $currentMonth) . '>' . date('F', mktime(0, 0, 0, $i, 1)) . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12 d-flex align-items-center">
						<label class="form-label main-label ms-0 ms-sm-3">Year</label>
						<div class="main-selectpicker w-100" id="investor_list_select_table">
							<?php
							$currentYear = date('Y'); // Get the current year
							echo '<select name="investor_list" id="attendance_year" class="selectpicker form-control select form-main" data-live-search="true" required>';
							echo '<i class="fa-solid fa-caret-down"></i>';
							echo '<option value="">--Select Year--</option>';
							for ($year = 2009; $year <= 2025; $year++) {
								$selected = ($year == $currentYear) ? 'selected' : ''; // Check if the year matches the current year
								echo "<option $selected>$year</option>";
							}
							echo '</select>';
							?>
						</div>
					</div>
					<div class="col-xl-8 col-lg-6 col-md-6 col-sm-6 col-12 d-flex align-items-end checkbox-clue justify-content-end">
						<p>Presant </p>
						<i class="fa-solid fa-square-check pb-1 ps-2 " style="color: #008000;"></i>
						<p class="ps-3">Absent </p>
						<i class="fa-solid fa-square-xmark pb-1 ps-2 " style="color: #ff0000;"></i>
						<!-- <p class="ps-3">Leave </p>
							<i class="fa-solid fa-square-check pb-1 ps-2 " style="color: #FFFF00;"></i>
							<p class="ps-3">Week off </p>
							<i class="fa-solid fa-square-minus pb-1 ps-2" style="color: #0000ff;"></i> -->
					</div>
					<!-- <div id="people_wrapper" class="dataTables_wrapper no-footer">
							<div id="project_filter" class="dataTables_filter justify-content-end d-flex">
								<label>Search:<input type="search" placeholder="" aria-controls="project"></label>
							</div>
						</div> -->
				</div>
			</form>
		</div>
		<!-- site-sale-attendance-start -->
		<div class="px-3 py-2 bg-white rounded-2 mx-2">
			<div class="overflow-x-scroll">
				<table class="attendance-table table main-table w-100 " aria-describedby="example_info">
					<thead class="attendence_header">
						<tr>
							<th>Name</th>
							<?php
							$datesss = getAllDatesInCurrentMonth();
							$startDate = new DateTime('first day of this month');
							$endDate = new DateTime('last day of this month');
							// pre($startDate->format('Y-m-d'));
							foreach ($datesss as $key => $values) {
								echo '<th>' . $values . '</th>';
							}
							$db_connection = \Config\Database::connect('second');
							$username = session_username($_SESSION['username']);
							$dates = array();
							$database_exdate = array();
							$qury = "SELECT `id`, `user_id`, `entry_date_time`, `exit_date_time`, `hour_count`, `created_at`, `status` FROM " . $username . "_attendance";
						
							$result = $db_connection->query($qury);
							$attendence_check = $result->getResultArray();
							while ($startDate <= $endDate) {
								$dates[] = $startDate->format('Y-m-d');
								$startDate->modify('+1 day');
								$count = count($dates);
							}
							?>
							<?php implode('', $dates); ?>
							<th>Present</th>
							<th>Absent</th>
						</tr>
					</thead>
					<tbody id="attandance_show_data">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="attendance_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Attendance</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="d-flex justify-content-center flex-wrap align-items-center add_fild show-st-data">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn submit-btn btn-primary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn submit-btn btn-primary update_attendence" data-user_id="" data-entry_date="" data-id="">Submit</button>
			</div>
		</div>
	</div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
	$(document).ready(function() {
		$("body").on('click', '.edti', function(e) {
			var id = $(this).attr("data-id");
			var user_id = $(this).attr("data-user_id");
			var entry_date = $(this).attr("attendancedate");
			$(".update_attendence").attr("data-id", id);
			$(".update_attendence").attr("data-user_id", user_id);
			$(".update_attendence").attr("data-entry_date", entry_date);
			$.ajax({
				method: "post",
				url: "<?= site_url('attandance_showdata'); ?>",
				data: {
					'user_id': user_id,
					'attendance_date': entry_date,
				},
				success: function(res) {
					$('.show-st-data').html(res);
				},
				error: function(error) {
					$('.loader').hide();
				}
			});
		});
		$('body').on('click', '.update_attendence', function() {
			var is_status = 0;
			var AttendanceDate = $(this).attr('data-entry_date');
			var DataMemberId = $(this).attr("data-user_id");
			var punchTimeInputs = document.querySelectorAll('input[name="punch_time_array[]"]');
			var punch_time_array = [];
			punchTimeInputs.forEach(input => {
				if (input.value != '') {
					var timeZone = "<?php echo timezonedata(); ?>";
					var inputFormat = "HH:mm:ss";
					var PunchDate = convertTimeToUTC(moment(input.value, 'hh:mm A').format('HH:mm:ss'), inputFormat, timeZone);
					punch_time_array.push(PunchDate);
				}
			});
			var formattedPunchTimeArray = JSON.stringify(punch_time_array).replace(/",,"/g, ',').replace(/,""/g, '').replace(/^\[/, '[').replace(/\]$/, ']');
			var DataAttendanceId = $(this).attr("data-id");
			<?php
			date_default_timezone_set('Asia/Kolkata');
			$currentDateTime = date('Y-m-d H:i:s');
			$currentDate = date('Y-m-d');
			?>
			var table = '<?php echo $username . '_attendance'; ?>';
			var CreatedDate11 = '<?php echo $currentDateTime; ?>';
			var timeZone = "<?php echo timezonedata(); ?>";
			var inputFormat = "YYYY-MM-DD HH:mm:ss";
			var CreatedDate = convertTimeToUTC(CreatedDate11, inputFormat, timeZone);
			var currentDate = '<?php echo $currentDate; ?>';
			var status = 1;
			if (DataAttendanceId != '') {
				var formdata = new FormData();
				formdata.append('action', 'update');
				formdata.append('edit_id', DataAttendanceId);
				formdata.append('table', table);
				formdata.append('is_status', is_status);
				formdata.append('status', status);
				formdata.append('punch_time_array', formattedPunchTimeArray);
				$.ajax({
					method: "post",
					url: "<?= site_url('attandance_update_data'); ?>",
					data: formdata,
					processData: false,
					contentType: false,
					success: function(res) {
						iziToast.success({
							title: 'Update Successfully'
						});
						attandance_data();
						$('.btn-close').trigger('click');
					}
				});
			} else {
				if (formattedPunchTimeArray != '') {
					punch_date = AttendanceDate;
					var timeZone = "<?php echo timezonedata(); ?>";
					var inputFormat = "YYYY-MM-DD";
					var punch_date = convertTimeToUTC(punch_date, inputFormat, timeZone);
					$.ajax({
						method: "post",
						url: 'attandance_insert_data',
						data: {
							'action': 'insert',
							'table': table,
							'user_id': DataMemberId,
							'is_status': is_status,
							'punch_date': punch_date,
							'punch_time_array': formattedPunchTimeArray,
							'status': 1,
							'created_at': CreatedDate,
						},
						success: function(res) {
							iziToast.success({
								title: 'Added Successfully'
							});
							attandance_data();
							$('.btn-close').trigger('click');
						}
					});
				}
			}
		});
		$('#project_filter input[type="search"]').on('keyup', function(e) {
			if (e.which == 13) {
				var input = $(this).val().toLowerCase();
				attandance_data('<?= base_url('get_data_attandance'); ?>', 'attendance', 1, input);
			}
		});
		function attandance_data(ajax_url = '<?= base_url('get_data_attandance'); ?>', table = 'attendance', pageNumber = 1, ajaxsearch = "") {
			var attendance_month = $('#attendance_month').prop("value");
			var attendance_year = $('#attendance_year').val();
			var temp = attendance_year + "-" + attendance_month;
			console.log(temp);
			$('.loader').show();
			$.ajax({
				method: "post",
				url: "<?= site_url('get_data_attandance'); ?>",
				data: {
					'attendance_month': attendance_month,
					'ajaxsearch': ajaxsearch,
					'temp': temp,
					'action': true
				},
				success: function(res) {
					var response = JSON.parse(res);
					if (response.response == 1) {
						$('#attandance_show_data').html(response.html);
						if (response.atte_header != '') {
							$('.attendence_header').html(response.atte_header);
						}
					}
					$('.loader').hide();
				},
				error: function(error) {
					$('.loader').hide();
				}
			});
		}
		attandance_data();
	});
	$(document).ready(function() {
		$('body').on('click', '.add-fild-btn', function() {
			$(this).closest(".add_fild_outer_main").find(".add_fild").removeClass("d-none");
			$(this).hide();
			$(this).closest(".add_fild_outer_main").find(".at_time").val("");
		});
		$('body').on('click', '.remove_fild', function() {
			$(this).closest(".add_fild").addClass("d-none");
			$(this).closest(".add_fild_outer_main").find(".add-fild-btn").show();
			$(this).closest(".add_fild_outer_main").find(".at_time").val("");
		});
	});
</script>