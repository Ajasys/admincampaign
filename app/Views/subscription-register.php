<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
// $project_management_subtype = json_decode($project_management_subtype, true);
$username = session_username($_SESSION['username']);
$this->db = DatabaseDefaultConnection();
?>

<style>
	.offcanvas-backdrop {
		display: none;
	}

	input[type="radio"] {
		width: 20px;
		height: 20px;
		border: 1px solid black;
	}
</style>

<div class="main-dashbord p-2">
	<div class="container-fluid p-0">
		<div class="p-2">
			<div class="d-flex justify-content-between align-items-center">
				<div class="title-1 d-flex align-items-center">
					<i class="fa-regular fa-clipboard me-1"></i>
					<h2>Subscription Register</h2>
				</div>
				<div class="d-flex align-items-center">
					<button class="btn-primary-rounded mx-1" type="button" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
						<i class="bi bi-funnel fs-14"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="px-3 py-2 bg-white rounded-2 mx-2">
			<div class="col-12 filter-show d-flex" id="filter-showw"></div>
			<div class="col-12 mb-2">
				<button class="btn bg-danger mx-1 mt-2 clear btn-sm text-white fs-7" id="clear">Clear All</button>
			</div>
			<ul class="d-flex navtab_primary_sm w-100 flex-xl-wrap flex-nowrap mb-2" id="subscription-main-tab">
				<li class="nav-item">
					<button class="nav-link text-nowrap subscription_status active" id="live"
						data-status_id="0">Live</button>
				</li>
				<li class="nav-item">
					<button class="nav-link text-nowrap subscription_status" id="cancel"
						data-status_id="1">Cancel</button>
				</li>
			</ul>
			<!-- <div class="col-xl-12 flex2 gap-30">
					<div class="d-flex mt-10 gap-3 property_tab_button ">
						<button class="today-btn-2 btn mt-10 subscription_status text-nowrap active live">Live</button>
						<button class="today-btn-2 btn mt-10 subscription_status text-nowrap cancel">Cancel</button>
					</div>
				</div> -->
			<div class="col-xl-12 attendence-search mb-1">
				<div class="dataTables_length" id="project_length">
					<label>
						Show
						<select name="project_length" id="project_length_show" aria-controls="project" class="">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
						Records
					</label>
				</div>
				<!-- <div id="people_wrapper" class="dataTables_wrapper no-footer">
					 <div id="project_filter" class="dataTables_filter justify-content-end d-flex">
						<label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
					 </div>
				  </div> -->
			</div>
			<table id="conversion_table" class="table main-table w-100">
				<thead class="table-heading">
					<tr class="main">
						<th>
							<span>Subscription List</span>
						</th>
					</tr>
				</thead>
				<tbody id="conversion_list">
				</tbody>
			</table>
			<div class="d-flex justify-content-between align-items-center row-count-main-section">
				<div class="row_count_div">
					<p id="row_count"></p>
				</div>
				<div class="clearfix">
					<ul class="pagination inq_pagination" id="inq_pagination"></ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- filter html -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
	<form method="post" class="d-flex flex-column h-100" name="filter_form">
		<div class="offcanvas-header set-bg-color bg-pink">
			<h5 class="offcanvas-title text-white" id="offcanvasRightLabel">filter</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body filter_data">
			<div class="input-type my-2">
				<input type="text" placeholder="id" class="form-control" name="f_id" id="f_id">
			</div>
			<div class="input-type my-2">
				<input type="text" placeholder="inq id" class="form-control" name="f_inquiry_id" id="f_inquiry_id">
			</div>
			<div class="input-type my-2">
				<input type="text" placeholder="enter party name" class="form-control" name="full_name"
					id="f_full_name">
			</div>
			<div class="input-type my-2">
				<input type="text" placeholder="mobile no" class="form-control" name="f_mobileno" id="f_mobileno">
			</div>
			<div class="input-type my-2">
				<div class="d-flex">
					<div class="dropdown bootstrap-select form-control">
						<select class="selectpicker form-control form-main" id="f_product_name" name="f_product_name"
							data-live-search="true">
							<option value="">Product Name</option>
							<?php
							$subscription_data = "SELECT * FROM admin_product";
							$result = $this->db->query($subscription_data);
							$result = $result->getResultArray();

							foreach ($result as $key => $value) {
								echo '<option value="' . $value['id'] . '">' . $value['product_name'] . '</option>';
							}
							?>
						</select>
						<div class="dropdown-menu " role="combobox">
							<div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
									role="textbox" aria-label="Search">
							</div>
							<div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
								<ul class="dropdown-menu inner show"></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="input-type my-2">
				<div class="d-flex">
					<div class="dropdown bootstrap-select form-control">
						<select class="selectpicker form-control form-main" id="f_product_plan" name="f_product_plan"
							data-live-search="true">
							<option value="">Product Plan </option>
							<?php
							$subscription_data = "SELECT * FROM admin_subscription_master";
							$result = $this->db->query($subscription_data);
							$result = $result->getResultArray();

							foreach ($result as $key => $value) {
								echo '<option value="' . $value['id'] . '" data-plan_price="' . $value['plan_price'] . '">' . $value['plan_name'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
			duration:
			<div class="input-type my-2">
				<input type="text" class="form-control date" id="f_from_date" name="from_date" placeholder="From date">
			</div>
			<div class="input-type my-2">
				<input type="text" class="form-control date" id="f_last_date" name="to_date" placeholder="To date">
			</div>
		</div>
	</form>
</div>

<!-- view data  -->
<div class="modal fade" id="booking_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
		<div class="modal-content">
			<form class="needs-validation" name="project_update_form" method="POST" action="">
				<div class="modal-header">
					<h6 class="modal-title">Subscription informetion</h6>
					<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
				<div class="modal-body modal-body-secondery text-capitalize fs-14" id="people-list-body">
					<div class="modal-body-card">
						<div class="col-2 p-2">
							<img src="<?= base_url('assets/images/h-user-theme-m.svg'); ?>" alt=""
								style="border-radius: 50%;" width="80px" height="80px" id="customer_photo">
						</div>
						<div class="col-10 row d-flex">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<span>name : </span>
								<span id="partyname"></span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<span>mobileno : </span>
								<span id="mobileno"></span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<span><i class="fa-solid fa-address-card"></i></span>
								<span id="address"></span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<span>inquiry id : </span>
								<span id="inquiry_id"></span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<span>assign name : </span>
								<span id="assign_id"></span>
							</div>
						</div>
					</div>
					<h6 class="modal-body-title">Product Details</h6>
					<div class="modal-body-card">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<span>Product name : </span>
							<span id="product_name"></span>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<span>Product Plan : </span>
							<span id="product_plan"></span>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<span>Total Price : </span>
							<span id="total_price"></span>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="conversion_edit_form" data-bs-backdrop="static" data-bs-keyboard="false"
	tabindex="-1" aria-labelledby="conversion_inquery" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="max-width:1100px;">
		<form method="post" id="booking_form" name="booking_form" class="needs-validation" method="post"
			enctype="multipart/form-data" novalidate>
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Subscription</h5>
					<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
				<div class="modal-body modal-body-secondery">
					<h6 class="modal-body-title">Booking Information</h6>
					<div class="modal-body-card">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Party Mobile No:</label>
							<input type="text" class="form-control main-control" id="mobileno" name="mobileno"
								placeholder="Mobile No" value="" required="" readonly>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Party Name :</label>
							<input type="text" class="form-control main-control" id="full_name" name="partyname"
								placeholder="Party Name" value="ahad pathan" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">House No :</label>
							<input type="text" class="form-control main-control" id="houseno" name="houseno"
								placeholder="House No" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Society :</label>
							<input type="text" class="form-control main-control" id="society" name="societyname"
								placeholder="Society Name" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Area :</label>
							<input type="text" class="form-control main-control" id="area" name="area"
								placeholder="area" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Land Mark :</label>
							<input type="text" class="form-control main-control" id="landmark" name="landmark"
								placeholder="Land Mark" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Country :</label>
							<input type="text" class="form-control main-control" id="countryId" name="code_country"
								placeholder="State" required="" readonly>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">State :</label>
							<input type="text" class="form-control main-control" id="stateId" name="code_state"
								placeholder="State" required="" readonly>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">City :</label>
							<input type="text" class="form-control main-control" id="cityId" name="code_city"
								placeholder="City" required="" readonly>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Pincode :</label>
							<input type="text" class="form-control main-control" id="pincode" name="pincode"
								placeholder="Pincode" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Aadhar Card Number :</label>
							<input type="text" class="form-control main-control addharno_valid_formate" minlength="14"
								maxlength="14" id="aadharno" name="aadharno" placeholder="Aadhar No." required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Pancard Number :</label>
							<input type="text" class="form-control main-control pan_number_valid_formate"
								id="pancard_no" name="pancard_no" placeholder="Pan Card Number" required="">
						</div>
					</div>
					<h6 class="modal-body-title">Product Details</h6>
					<div class="modal-body-card">
						<div class="col-12 d-flex flex-wrap align-items-end">
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label class="form-label main-label">Product Name :</label>
								<div class="main-selectpicker mx-1">
									<select class="selectpicker form-control form-main" id="product_name"
										name="product_name" data-live-search="true" required="">
										<option value="0">Select Product Name</option>
										<?php
										$subscription_data = "SELECT * FROM admin_product";
										$result = $this->db->query($subscription_data);
										$result = $result->getResultArray();

										foreach ($result as $key => $value) {
											echo '<option value="' . $value['id'] . '">' . $value['product_name'] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label class="form-label main-label">Select Product Plan :</label>
								<div class="main-selectpicker mx-1">
									<select class="selectpicker form-control form-main" id="product_plan"
										name="product_plan" data-live-search="true" required="">
										<option value="" data-plan_price="0">Select Product Plan
										</option>
										<?php
										$subscription_data = "SELECT * FROM admin_subscription_master";
										$result = $this->db->query($subscription_data);
										$result = $result->getResultArray();

										foreach ($result as $key => $value) {
											echo '<option value="' . $value['id'] . '" data-plan_price="' . $value['plan_price'] . '">' . $value['plan_name'] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-12 d-flex flex-wrap mt-3 justify-content-end">
							<div id="include_id" class="col-lg-3 col-md-4 col-sm-6">
								<label class="form-label main-label">Total Price :</label>
								<input type="text" class="form-control main-control" id="total_price" name="total_price"
									maxlength="12"
									onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
									placeholder="Total Price" value="" readonly required="required">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer modal-footer2 sub-btn-hide">
					<button type="button" class="btn-primary" id="cancle_booking" data-booking_insert_id
						data-inquiry_insert_id>cancle booking</button>
					<button type="button" class="btn-primary" id="booking_add_data"
						data-booking_insert_id>submit</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>

<script>

	function amountDate() {
		$('.m-date').bootstrapMaterialDatePicker({
			minDate: new Date(),
			okText: 'ok',
			format: 'DD-MM-YYYY',
			time: false
		});
	}

	$(document).ready(function () {

		$('.date').bootstrapMaterialDatePicker({
			format: 'DD-MM-YYYY',
			cancelText: 'ANNULER',
			nowButton: true,
			switchOnClick: true,
			time: false
		});
		$('.bookingg').bootstrapMaterialDatePicker({
			format: 'DD-MM-YYYY',
			cancelText: 'ANNULER',
			nowButton: true,
			switchOnClick: true,
			time: false
		});
		$('.min-datetime').bootstrapMaterialDatePicker({
			minDate: new Date(),
			time: true,
			format: 'MM/DD/YYYY h:mm A',
			cancelText: 'cancel',
			okText: 'ok',
			clearText: 'clear',
		});
		// $('#datetimepicker').datetimepicker({
		// 	defaultDate: new Date(),
		// 	disabledDates: [new Date(0, 0, 0)] // Disable all dates except the current date
		// });

		$('body').on('change', '#project_length_show', function () {
			var perPageCount = $(this).val();
			// console.log(perPageCount);
			list_data('<?= base_url('people_liat'); ?>', '_booking', 1, perPageCount);
		});

		list_data();

		$('body').on('click', '#subscription-main-tab .subscription_status', function () {
			$('#subscription-main-tab button').removeClass('active');
			$(this).addClass('active');
			list_data('booking_list', '_booking', 1, 10, '');
		});

		function list_data(ajax_url = '<?= base_url('booking_list'); ?>', table = '_booking', pageNumber = 1, perPageCount = 10, ajaxsearch = "", formdata = "") {
			// alert();
			show_val = '<?= json_encode(array('')); ?>';
			var table = '_booking';
			var ajaxsearch = $('.inq_search').val();
			var inquiry_status_type = $('#subscription-main-tab .active').attr('data-inquiry');
			ajax_url = '<?= site_url('booking_list_data'); ?>';
			var subscription_status = $('#subscription-main-tab .active').attr('data-status_id');

			if ($.trim($(".filter-show").html()) != '') {
				// console.log("aaaa");
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				// formdata.append('follow_up_day', follow_up_day);
			}

			// console.log(formdata);
			if ($.trim($(".filter-show").html()) == '') {
				//console.log("Ddd");
				// alert();
				var data = {
					'table': table,
					// 'datastatus':datastatus,
					'pageNumber': pageNumber,
					'perPageCount': perPageCount,
					// 'follow_up_day': follow_up_day,
					'ajaxsearch': ajaxsearch,
					'subscription_status': subscription_status,
					'booking_status': 'live',
					'action': true,
				};
				var processdd = true;
				var contentType = "application/x-www-form-urlencoded; charset=UTF-8";

			} else {
				//console.log("Dddffff");
				// formdata.append( 'datastatus', datastatus);/
				formdata.append('pageNumber', pageNumber);
				formdata.append('table', '_booking');
				formdata.append('subscription_status', subscription_status);
				formdata.append('booking_status', 'live');
				//formdata.append( 'perPageCount', perPageCount);
				//formdata.append( 'follow_up_day', follow_up_day);
				var data = formdata;
				var processdd = false;
				var contentType = false;
			}

			$('.loader').show();
			$.ajax({
				datatype: 'json',
				method: "post",
				url: "<?= site_url('booking_list_data'); ?>",
				data: data,
				processData: processdd,
				contentType: contentType,
				success: function (res) {
					var result = JSON.parse(res);
					// console.log(result.html);
					if (result.response == 1) {
						if (result.total_page == 0 || result.total_page == '') {
							total_page = 1;
						} else {
							total_page = result.total_page;
						}
						// console.log(result);
						$('#conversion_list').html(result.html);
						$('#row_count').html(result.row_count_html);
						$('.inq_pagination').twbsPagination({
							totalPages: total_page,
							visiblePages: 4,
							next: '>>',
							prev: '<<',
							onPageClick: function (event, page) {
								list_data(ajax_url, table, page, perPageCount, ajaxsearch);
							}
						});
					}
					$('.loader').hide();
					$('#conversion_list').html(result.html);
				}
			});
			$('.loader').hide();
		}

		$('body').on('click', '#filter-showw p', function () {
			$('.inq_pagination').twbsPagination('destroy');
			// var follow_up_day = '';
			if ($(".filter-show").html() != "") {
				// $data_status = $("#f_status").val();
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				formdata.append('follow_up_day', follow_up_day);
			} else {
				formdata = '';
			}
			list_data('inquiry_all_status', '_booking', 1, 10, "", 'filter', formdata);
		});

		$(".filter_data input, .filter_data select").change(function () {
			$('.inq_pagination').twbsPagination('destroy');
			var form = $("form[name='filter_form']")[0];

			var formdata = new FormData(form);
			formdata.append('action', 'filter');
			// $data_status = $("#f_status").val();
			if ($(".filter-show").html() != "") {
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
			} else {
				formdata = '';
			}
			// alert();
			list_data('inquiry_all_status', '_booking', 1, 10, "", 'filter', formdata);
		});

		$("#clear").click(function () {
			$('.inq_pagination').twbsPagination('destroy');
			 <?php if (isset($_REQUEST['followup'])) { ?>
																					var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
			<?php } else { ?>
																					var follow_up_day = '';
			<?php } ?>
		   if ($(".filter-show").html() != "") {
				formdata.append('follow_up_day', follow_up_day);
				$data_status = $("#f_status").val();
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
			} else {
				formdata = '';
			}
			list_data('inquiry_all_status', '_booking', 1, 10, "", 'filter', formdata);
		});

		$('body').on('click', '#booking_view_model', function (e) {
			var booking_id = $(this).attr('data-booking_id');
			// console.log(booking_id);
			// $('select.selectpicker').selectpicker('refresh');
			e.preventDefault();
			// var self = $(this).closest("tr");
			// var edit_value = $(this).attr("data-edit_id");
			// console.log(edit_value);
			if (booking_id != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('booking_view'); ?>",
					data: {
						action: 'view',
						edit_id: booking_id,
						table: 'booking'
					},
					success: function (res) {
						$('.loader').hide();
						var img_url = '<?= base_url('assets/images/booking/') ?>'

						var response = JSON.parse(res);
						// console.log(response);
						$.each(response[0], function (index, value) {
							$('#people-list-body #' + index).text(value);
						})
					},
					error: function (error) {
						$('.loader').hide();
					}

				});
			}
		});

		$('#exclude_id').hide();
		$('body').on('click', '#switchActive', function () {
			$('#include_id').show();
			$('#exclude_id').hide();
		});
		$('body').on('click', '#switchInactive', function () {
			$('#include_id').hide();
			$('#exclude_id').show();
		});

		// $('#loan_amount').hide();
		$('body').on('click', '#CashInactive_1', function () {
			$('#loan_amount_1').hide();
			// alert();
		});
		$('body').on('click', '#LoneActive_1', function () {
			$('#loan_amount_1').show();
		});

		// $("#project_sub_type").change(function () {
		// 	var project_type_id = $("#project_sub_type option:selected").attr('date-project_type_id');
		// 	var project_sub_type_value = $('#project_sub_type option:selected').attr('data-city');
		// 	// console.log(project_sub_type_value);
		// 	if (project_type_id != "") {
		// 		head_get(project_type_id);
		// 		project_dropdown_list(project_sub_type_value);
		// 	}
		// });

		function head_get(parent_id) {
			$("select#head").html('');

			var department = $("#Adduser #role option:selected").attr('data-department_id');
			var role_id = $("#Adduser #role option:selected").val();
			$.ajax({
				url: "<?= site_url('MasterInformation_edit'); ?>",
				type: 'post',
				data: {
					action: 'edit',
					edit_id: parent_id,
					table: 'project_management_subtype',
				},
				success: function (data) {
					var response = JSON.parse(data);
					// console.log(response[0].project_type);
					$('#conversion_inquery #project_type').val(response[0].project_type);
				}
			});
			// project_type_add(department);
		}

		$('body').on('click', '.amount_partition_remove', function () {
			$(this).parent('div').closest('.amount_partition').remove();
		});

		// function amountDate() {
		// 	$('.m-date').bootstrapMaterialDatePicker({
		// 		minDate: new Date(),
		// 		okText: 'ok',
		// 		time: false
		// 	});
		// }

		x = 1;
		var maxField = 10;
		$('body').on('click', '.amount_partition_add', function () {
			// alert();
			var html = amount_partition_add();
			// console.log(html);
			if (x < maxField) {
				x++;
				$('.amount_date_form').append(html);
			}
			amountDate();
		});

		function amount_partition_add() {
			var html = '';
			html += '<div class="amount_date amount_partition row g-2 align-items-end" >';
			html += '<div class="col-lg-3 col-md-4 col-sm-6">';
			html += '<label for="p_shortname" class="form-label main-label">Amount :</label>';
			html += '<div class="d-flex"><input type="text" class="form-control main-control amount" id="amount" name="amount[]" placeholder="Amount" value="" required=""></div>';
			html += '</div>';
			html += '<div class="col-lg-3 col-md-4 col-sm-6">';
			html += '<label for="p_shortname" class="form-label main-label">Date :</label>';
			html += '<div class="d-flex"><input type="text" class="form-control main-control m-date payment_date" onclick="amountDate()" id="payment_date" name="payment_date[]" placeholder="payment date" value="" required="" data-dtp="dtp_SPKMK"></div>';
			html += '</div>';
			html += '<div class="col-lg-3 col-md-4 col-sm-6">';
			html += '<label for="p_shortname" class="form-label main-label">Duration in days :</label>';
			html += '<div class="d-flex"><input type="text" class="form-control main-control days duration_day" id="duration_day" name="duration_day[]" placeholder="Duration in days" value="" required=""></div>';
			html += '</div>';
			html += '<div class="col-lg-3 col-md-4 col-sm-6"><div class="view-model-btn mx-auto amount_partition_remove"><i class="bi bi-dash"></i></div></div>';
			html += '</div>';

			return html;
		}

		$('body').on('change', '.payment_date', function () {
			// payment_date format is dd-mm-yyyy
			var payment_date = $(this).val();
			var dateParts = payment_date.split("-");
			var inputDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
			var today = new Date();
			var timeDiff = Math.abs(today.getTime() - inputDate.getTime());
			var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
			// console.log(inputDate);
			$(this).closest('.amount_date').find(".duration_day").val(daysDiff);
		});

		function addDays(n) {
			var t = new Date();
			t.setDate(t.getDate() + n);
			var month = "0" + (t.getMonth() + 1);
			var date = "0" + t.getDate();
			month = month.slice(-2);
			date = date.slice(-2);
			var date = t.getFullYear() + "-" + month + "-" + date;
			return date;
		}

		$('body').on('change', '.duration_day', function () {
			var after_day = $(this).val();
			if (after_day == "") {
				after_day = 0;
			}
			var showdate = addDays(parseFloat(after_day));
			// var format = $.format.date(showdate,'DD-MM-YYYY');
			var widthoutformat = new Date(showdate);
			var d = widthoutformat.getDate();
			var m = widthoutformat.getMonth();
			var y = widthoutformat.getFullYear();
			m += 1;
			var format = d + "-" + m + "-" + y;
			// console.log(d+"-"+m+"-"+y);
			// $(this).closest('.dureation-date').find('.payment_date').val(showdate);
			$(this).closest('.amount_date').find('.payment_date').val(format);
		});

		$('body').on('keyup', '#price', function () {
			var price = $(this).val().replace(/,/g, '');
			var add_comma = numberWithCommas(price);
			$(this).val(add_comma);
			var extrawork = $("#extrawork").val().replace(/,/g, '');
			if (extrawork == '') {
				extrawork = 0;
			}
			var total_price_count = total_price(price, extrawork);
			$("#total_price").val(total_price_count);
		});
		$('body').on('keyup', '#extrawork', function () {
			var extrawork = $(this).val().replace(/,/g, '');
			// console.log(extrawork);
			var add_comma = numberWithCommas(extrawork);
			$(this).val(add_comma);
			var price = $("#price").val().replace(/,/g, '');
			if (price == '') {
				price = 0;
			}
			var discount_price = $("#discount_price").val().replace(/,/g, '');
			if (discount_price == '') {
				discount_price = 0;
			}
			var total_price_count = total_price(price, extrawork);
			var total_price_countr = count_main_price_extrawork(price, extrawork, total_price_count, discount_price);
			$("#total_price").val(total_price_count);
			$("#main_price").val(total_price_countr);
			$("#total_amount").val(total_price_countr);
			var remaining_amount = $('#remaining_amount').val(total_price_countr);
			// console.log(remaining_amount[0].value);
			remaining_amount_validation(remaining_amount);
			$('#remaining_amount').val(total_price_countr);
		});

		function numberWithCommas(x) {
			return x.toString().split('.')[0].length > 3 ? x.toString().substring(0, x.toString().split('.')[0].length - 3).replace(/\B(?=(\d{2})+(?!\d))/g, ",") + "," + x.toString().substring(x.toString().split('.')[0].length - 3) : x.toString();
		}

		function total_price(price = 0, extrawork = 0, extraexpense = 0) {
			var numformate_total_price = 0;
			var total_price = 0;
			total_price = parseInt(price) + parseInt(extrawork) + parseInt(extraexpense);
			numformate_total_price = numberWithCommas(total_price);
			return numformate_total_price;
		}

		function count_main_price(price = 0, discount = 0) {
			var numformate_total_price = 0;
			var total_price = 0;
			total_price = parseFloat(price) - parseFloat(discount);
			if (total_price <= 0) {
				total_price = 0;
			}
			numformate_main_price = numberWithCommas(total_price);
			return numformate_main_price;
		}

		function count_main_price_extrawork(price = 0, extrawork = 0, total_price = 0, discount = 0) {

			var numformate_total_price = 0;
			var total_price = 0;
			total_price = parseInt(price) + parseInt(extrawork) + parseInt(total_price) - parseInt(discount);
			numformate_total_price = numberWithCommas(total_price);
			return numformate_total_price;

		}
		function count_exclude_main_price_extrawork(price = 0, extrawork = 0, extraexpense = 0, total_price = 0, discount = 0) {

			var numformate_total_price = 0;
			var total_price = 0;
			total_price = parseInt(price) + parseInt(extrawork) + parseInt(extraexpense) + parseInt(total_price) - parseInt(discount);
			numformate_total_price = numberWithCommas(total_price);
			return numformate_total_price;

		}

		$('body').on('change', '#conversion_edit_form #product_plan', function (e) {
			var val = $(this).find('option:checked').attr('data-plan_price');
			val = numberWithCommas(val);
			if (val != undefined && val != '') {
				$("#conversion_edit_form #total_price").val(val);
			} else {
				$("#conversion_edit_form #total_price").val('');
			}
		});



		$('body').on('click', '#booking_edit', function (e) {
			var booking_id = $(this).attr('data-booking_id');
			// console.log(booking_id);
			if (booking_id != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('booking_edit'); ?>",
					data: {
						action: 'edit',
						view_id: booking_id,
						table: 'booking'
					},

					success: function (res) {
						$('.loader').hide();
						var response = JSON.parse(res);
						var img_url = '<?= base_url('assets/images/booking/') ?>';
						$('#conversion_edit_form #mobileno').val(response[0].mobileno);
						$('#conversion_edit_form #full_name').val(response[0].partyname);
						$('#conversion_edit_form #houseno').val(response[0].houseno);
						$('#conversion_edit_form #society').val(response[0].societyname);
						$('#conversion_edit_form #area').val(response[0].area);
						$('#conversion_edit_form #landmark').val(response[0].landmark);
						$('#conversion_edit_form #countryId').val(response[0].code_country);
						$('#conversion_edit_form #stateId').val(response[0].code_state);
						$('#conversion_edit_form #cityId').val(response[0].code_city);
						$('#conversion_edit_form #pincode').val(response[0].pincode);
						$('#conversion_edit_form #aadharno').val(response[0].aadharno);
						$('#conversion_edit_form #pancard_no').val(response[0].pancard_no);

						$('#conversion_edit_form #product_name').val(response[0].product_name);
						$('#conversion_edit_form #product_plan').val(response[0].product_plan);
						$('#conversion_edit_form #total_price').val(response[0].total_price);

						$('#conversion_edit_form #booking_add_data').attr('data-booking_insert_id', response[0].id);
						$('#conversion_edit_form #cancle_booking').attr('data-booking_insert_id', response[0].id);
						$('#conversion_edit_form #cancle_booking').attr('data-inquiry_insert_id', response[0].inquiry_id);

						$('.selectpicker').selectpicker('refresh');


					},

				});

			} else {

				$('.loader').hide();

				alert("Data Not Edit.");

			}

		});

		$('body').on('change', '.checkbox', function () {
			checkbox_on_change();
		});

		// var booking_btn = $('#booking_form #booking_add_data');
		// var remaining_amount = $('#booking_form #remaining_amount').val();

		// $('body').on('change', remaining_amount, function () {
		// 	// alert();
		// 	// console.log('hi');
		// 	if (remaining_amount == 0 && remaining_amount > -1) {
		// 		$('#booking_form #booking_add_data').show();
		// 	}
		// 	else {
		// 		$('#booking_form #booking_add_data').hide();
		// 	}
		// });
		// $('#booking_form #booking_add_data').hide();



		$('.direct_fild , .broker , .customer').hide();

		$('input:radio[name="gridRadios"]').on('change', function () {
			var val = $(this).val();
			// console.log(val);
			if (val == 'walk in') {
				$('.direct_fild , .broker , .customer').hide();
			}
			if (val == 'direct') {
				$('.direct_fild').show();
				$('.broker , .customer').hide();
			}
			if (val == 'broker') {
				$('.broker').show();
				$('.direct_fild , .customer').hide();
			}
			if (val == 'customer') {
				$('.customer').show();
				$('.direct_fild , .broker').hide();
			}
		});


		$('body').on('click', '#booking_add_data', function (e) {
			e.preventDefault();
			var update_id = $(this).attr('data-booking_insert_id');

			if (update_id != "") {
				var inquiry_status_type = $('.today-follow-tabs li .active').attr('data-inquiry');
				var insert_id = $(this).attr('data-booking_insert_id');

				var mobileno = $('#booking_form #mobileno').val();
				var partyname = $('#booking_form #full_name').val();
				var houseno = $('#booking_form #houseno').val();
				var societyname = $('#booking_form #society').val();
				var area = $('#booking_form #area').val();
				var landmark = $('#booking_form #landmark').val();
				var country = $('#booking_form #countryId').val();
				var state = $('#booking_form #stateId').val();
				var city = $('#booking_form #cityId').val();
				var pincode = $('#booking_form #pincode').val();

				var product_name = $('#booking_form #product_name').val();
				var product_plan = $('#booking_form #product_plan').val();
				var total_price = $('#booking_form #total_price').val();
				console.log('fff');
				if (
					mobileno != '' &&
					partyname != '' &&
					houseno != '' &&
					area != '' &&
					societyname != '' &&
					landmark != '' &&
					country != '' &&
					state != '' &&
					city != '' &&
					pincode != '' &&

					product_name != '' &&
					product_plan != '' &&
					total_price != ''
				) {
					console.log('ssss');
					var success_url = '<?php echo base_url('/inquiry_conversion_req'); ?>';
					current_fs = $('.token');
					next_fs = $('.kyc');
					var price = $("#price").val();
					var extrawork = $("#extrawork").val();
					var main_price = $("#main_price").val();
					var extraexpense = $("#extraexpense_exclude").val();
					var total_price = $("#total_price").val();
					var form = $('form[name="booking_form"]')[0];
					var formdata = new FormData(form);
					formdata.append('action', 'update');
					formdata.append('table', 'booking');
					formdata.append('update_id', update_id);
					formdata.append('inquiry_id', insert_id);
					// $('.loader').show();
					$.ajax({
						method: "post",
						url: "<?= base_url('booking_update'); ?>",
						data: formdata,
						processData: false,
						contentType: false,
						success: function (res) {
							// console.log(res);
							var response = JSON.parse(res);
							if (response.not_insert == 0) {
								Swal.fire({
									title: 'Not insert',
									text: response.msg,
									icon: 'error',
								})
							} else {
								sweet_edit_sucess(response.msg);
								// console.log(response);
								$('.loading').hide();
								$('form[name="booking_form"]').removeClass('was-validated');
								$('form[name="booking_form"]')[0].reset();
								$('.modal-close-btn').trigger('click');
								list_data('booking_list', '_booking', 1, 10);
							}
							// $('modal-close-btn').click({
							// 	$('form[name="booking_form"]')[0].reset();
							// });
						},
						error: function (error) {
							$('.loader').hide();
						}
					});

				} else {
					console.log('eee');
					$('form[name="booking_form"]').addClass('was-validated');
					// checkbox_on_change();
					$(form).find('.selectpicker').each(function () {
						var selectpicker_valid = 0;
						if ($(this).attr('required') == 'undefined') {
							var selectpicker_valid = 0;
						}
						if ($(this).attr('required') == 'required') {
							var selectpicker_valid = 1;
						}
						if (selectpicker_valid == 1) {
							// console.log($(this).val());
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
			}
			// alert(update_id);
		});

		$('body').on('click', '#booking_form .modal-close-btn', function () {
			$('form[name="booking_form"]')[0].reset();
			$('form[name="booking_form"]').removeClass('was-validated');
		});

		$('body').on('click', '#cancle_booking', function (e) {
			e.preventDefault();
			var booking_id = $(this).attr('data-booking_insert_id');
			var inquiry_id = $(this).attr('data-inquiry_insert_id');
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Cancel it!'
			}).then((result) => {
				$.ajax({
					url: "<?= base_url('booking_cancle'); ?>",
					method: "post",
					data: {
						action: 'cancle',
						id: booking_id,
						inquiry_id: inquiry_id,
						table: '_booking'
					},
					// processData: false,
					// contentType: false,
					success: function (res) {
						if (res == 1) {
							sweet_edit_sucess('Booking Cenceled');
						}
						list_data('<?= base_url('people_liat'); ?>', '_booking', 1,);
						$('.modal-close-btn').trigger('click');
					}
				});
			})

		});

	});

</script>