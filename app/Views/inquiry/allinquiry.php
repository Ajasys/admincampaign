<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
	$get_roll_id_to_roll_duty_var = array();
} else {
	$get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
$admin_emailtemplate = json_decode($admin_emailtemplate, true);

$this->db = \Config\Database::connect('second');
?>
<style type="text/css">
	#clear {
		display: none;
	}

	.validationn {
		color: red;
	}

	.Short {
		color: red;
		font-size: 14px;
		font-weight: bold;
	}

	.Good {
		color: green;
		font-size: 14px;
		font-weight: bold;
	}

	.Strong {
		color: green;
		font-size: 14px;
		font-weight: bold;
	}

	.username_check.fa-check,
	.username_check.fa-xmark {
		position: absolute !important;
		right: 26px !important;
		top: 41% !important;
		font-size: 23px;
	}

	input[type='radio'] {
		accent-color: var(--first-color);
	}
</style>
<style>
	.task-board-body .custm-up-class .task-card-body,
	.task-board-body .custm-up-class .task-card-footer {
		display: none;
	}

	.task-board-body .custm-up-class .task-card {
		border-radius: 6px 6px 0px 0px;
	}

	.task-board-body .custm-up-class .task-card .task-card-header {
		margin-bottom: -4px;
	}

	.task-board-body .custm-up-class {
		position: relative;
		top: -4px;
	}

	.task-board-body .custm-up-class:last-child .task-card {
		border-radius: 6px;
	}

	.task-board-body .custm-up-class.task-z-index .task-card {
		border-radius: 6px 6px 6px 6px;
		margin: 10px 0px;
	}

	.task-board-body .custm-up-class.task-z-index .task-card-body,
	.task-board-body .custm-up-class.task-z-index .task-card-footer {
		display: block;
	}

	.ghost {
		opacity: .1;
		color: #000;
		background-color: #000;
	}
</style>
<?php
$userUnderEmployee = userUnderEmployee($_SESSION['id']);
// pre(userUnderEmployee($_SESSION['id']));
// die();
if (isset($_REQUEST['followup'])) {
	//echo "ddd";
	$getStatusWiseData = getStatusWiseData($_REQUEST['followup']);
	// pre($_REQUEST['followup']);
} else {
	$getStatusWiseData = getStatusWiseData();
}
// $project_management_subtype = json_decode($project_management_subtype, true);
$area = json_decode($area, true);
$master_inquiry_type = json_decode($master_inquiry_type, true);
$master_inquiry_source = json_decode($master_inquiry_source, true);
// $project_management_type = json_decode($project_management_type, true);
$master_inquiry_close = json_decode($master_inquiry_close, true);
$master_inquiry_status = json_decode($master_inquiry_status, true);
$admin_subscription_masterrrr = $admin_subscription_master;
$admin_subscription_master = json_decode($admin_subscription_master, true);
$admin_product = json_decode($admin_product, true);
$user_data = json_decode($user_data, true);
$username = session_username($_SESSION['username']);

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
	$query = "SELECT * FROM " . $username . "_user";
} else {
	if (isset($this->admin) && $this->admin == 1) {
		$user_id = 0;
	} else {
		$user_id = $_SESSION['id'];
	}
	$getchild = array();
	$getchild = getChildIds($_SESSION['id']);
	if (!empty($getchild)) {
		array_push($getchild, $user_id);
	}
	$all_gm_under_people_implode = "'" . implode("', '", $getchild) . "'";
	$query = "SELECT * FROM " . $username . "_user WHERE id IN ($all_gm_under_people_implode)";
}
$Getresult = $this->db->query($query);
$user_full_data = $Getresult->getResultArray();

// $master_inquiry_status = getStatusWiseData($which_result, $user_id);
// $project_management_properties = json_decode($project_management_properties, true);
// $project = json_decode($project, true);
$getStatusWiseData = array();
if (isset($_REQUEST['followup'])) {
	//echo "ddd";
	$getStatusWiseData = getStatusWiseData($_REQUEST['followup']);
} else {
	$getStatusWiseData = getStatusWiseData();
}
$username = session_username($_SESSION['username']);

?>
<!-- <div class="main-dashbord p-2">
	<div class="container-fluid p-0">
		<div class="p-2">
			<div class="bg-color-white d-flex flex-wrap p-3 rounded">
				<div class="d-flex justify-content-between align-items-center my-2 flex-wrap w-100">
					<div class="title-1 d-flex align-items-center">
						<i class="bi bi-people me-2"></i>
						<h2>
							<?php if (isset($_REQUEST['followup'])) {
								if ($_REQUEST['followup'] == 'assign_to_other') {
									$filterd_name = str_replace('_', ' ', $_REQUEST['followup']);
									echo $filterd_name . " Inquiry";
								} else if ($_REQUEST['followup'] == 'closerequest') {
									echo 'Close Request Inquiry';
								} else if ($_REQUEST['followup'] == 'cnr') {
									echo 'CNR Inquirys';
								} else {
									echo $_REQUEST['followup'] . " all inquiry";
								}
							} else {
								echo "Manage all inquiry";
							} ?>
						</h2>
					</div>
					<div class="d-flex align-items-center">
						<button class="btn-primary-rounded mx-1 click_plus" type="button" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update" aria-controls="inquiry_all_status_update">
							<i class="bi bi-plus"></i>
						</button>
						<button class="btn-primary-rounded mx-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
							<i class="bi bi-funnel fs-14"></i>
						</button>
					</div>
				</div>
				<div class="col-12 filter-show d-flex" id="filter-showw"></div>
				<div class="col-12">
					<button class="btn bg-danger mx-1 mt-2 clear btn-sm text-white fs-7" id="clear">Clear All</button>
				</div>
				<div class="col-12">
					<div class="d-flex justify-content-between flex-wrap">
						<div class="main-select-section align-items-end col-xl-6 col-12 col-sm-12 col-md-10 col-lg-10 col-md-10 col-sm-12">
							<form class="needs-validation" name="assign_form" method="POST" novalidate>
								<div class="main-selection-toggle d-flex align-items-end align-items-center flex-wrap">
									<div class="bulk-action select col-lg-6 col-xl-5 px-1 mt-lg-0 col-12 col-sm-5 col-md-6 col-sm-6 mb-1">
										<label for="areaname" class="form-label main-label">Select Action</label>
										<div class="main-selectpicker">
											<select name="action_name" id="action_name" id="bulk-action" class="selectpicker form-control form-main" data-live-search="true" required="">
												<option value="">Select Action</option>
												<option value="assign_followups">Assign Followups</option>
												<option value="transfer_ownership">Transfer Inq</option>
											</select>
										</div>
									</div>
									<div class="employee-action select col-lg-6 col-xl-5 px-1 mt-lg-0 col-12 col-sm-5 col-md-6 col-sm-6 mb-1">
										<label for="areaname" class="form-label main-label">Select Employee</label>
										<div class="main-selectpicker">
											<select id="assign_id" name="assign_id" class="selectpicker form-control form-main" data-live-search="true" required="">
												<option value="">Select employee</option>
												<?php if (!empty($user_data)) {
													foreach ($user_data as $key => $user_valuess) {

														$table_name = 'admin_userrole';
														$role_id = $user_valuess['role'];
														$sql = "SELECT user_role FROM $table_name WHERE id = $role_id;";
														$db_connection = \Config\Database::connect('second');
														$result = $db_connection->query($sql);
														$total_dataa_userr_2245 = $result->getResultArray(); ?>
															<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo (isset($total_dataa_userr_2245[0]['user_role']) ? $total_dataa_userr_2245[0]['user_role'] : ''); ?>)</option>
												<?php

													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-xl-2 px-1 mb-1 mt-auto">
										<button class="btn-primary inquiry_assign" id="inquiry_assign_btn" data-edit_id="" name="inquiry_assign" value="inquiry_assign">submit</button>
									</div>
								</div>
							</form>
						</div>
						<?php if (isset($_REQUEST['followup']) && ($_REQUEST['followup'] == 'closerequest' || $_REQUEST['followup'] == 'appointment' || $_REQUEST['followup'] == 'dismissed')) {
							echo '<div class="navigation col-xl-10 overflow-auto mt-2"></div>';
						} else { ?>
							<div class="navigation col-xl-10 overflow-auto mt-2">
								<?php if (isset($_GET['mobileno'])) {
								} else { ?>
									<ul class="nav nav-pills navtab_primary_sm w-100 flex-xl-wrap flex-nowrap" id="pills-tab" role="tablist">
										<?php
										$total_inq_count = 0;
										$cnr_status_value = '17';
										$cnr_count = 0; // Initialize $cnr_count here
										if (!empty($getStatusWiseData)) {
											foreach ($getStatusWiseData as $inq_status_key => $inq_status_value) {
												if (!empty($inq_status_value['inq_status_name'])) {
													$total_inq_count += $inq_status_value['total_inq'];
													if (isset($inq_status_value['cnr_count'])) {
														$cnr_count += $inq_status_value['cnr_count']; // Increment $cnr_count
													}
										?>
													<li class="nav-item" role="presentation">
														<button class="nav-link text-nowrap" data-inquiry="<?php echo $inq_status_value['inquiry_status']; ?>">
															<?php echo $inq_status_value['inq_status_name']; ?> (<?php echo $inq_status_value['total_inq']; ?>)
														</button>
													</li>
										<?php
												}
											}
										}
										?>
										<li class="nav-item" role="presentation">
											<button class="nav-link text-nowrap fresh active" data-inquiry="">
												All
											</button>
										</li>
									</ul>
								<?php } ?>
							</div>
						<?php } ?>
						<div class="file-up-down d-flex justify-content-xl-end justify-content-lg-start col-lg-10 col-md-10 col-sm-12 col-12 col-xl-2">
							<div class="add-inquery-btn-group d-flex  align-items-center">
								<?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
									<div id="deleted-all">
										<span class="btn-primary-rounded elevation_add_button">
											<i class="bi bi-trash3 fs-14"></i>
										</span>
									</div>
								<?php } ?>
								<?php if (in_array('inquiry_import_csv_permission', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
									<i class="bi bi-file-earmark-arrow-up-fill me-2" data-bs-toggle="modal" data-bs-target="#import_csv"></i>
								<?php } ?>
								<?php if (in_array('inquiry_export_csv_permission', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
									<a class="cursor-pointer export-inq">
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="28" height="28" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
											<g>
												<path d="M496 432.011H272c-8.832 0-16-7.168-16-16v-320c0-8.832 7.168-16 16-16h224c8.832 0 16 7.168 16 16v320c0 8.832-7.168 16-16 16z" style="" fill="#eceff1" data-original="#eceff1"></path>
												<path d="M336 176.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 240.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 304.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 368.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 176.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 240.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 304.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 368.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16z" style="" fill="#388e3c" data-original="#388e3c" class=""></path>
												<path d="M282.208 19.691c-3.648-3.04-8.544-4.352-13.152-3.392l-256 48A15.955 15.955 0 0 0 0 80.011v352c0 7.68 5.472 14.304 13.056 15.712l256 48c.96.192 1.952.288 2.944.288 3.712 0 7.328-1.28 10.208-3.68a16.006 16.006 0 0 0 5.792-12.32v-448c0-4.768-2.112-9.28-5.792-12.32z" style="" fill="#2e7d32" data-original="#2e7d32" class=""></path>
												<path d="m220.032 309.483-50.592-57.824 51.168-65.792c5.44-6.976 4.16-17.024-2.784-22.464-6.944-5.44-16.992-4.16-22.464 2.784l-47.392 60.928-39.936-45.632c-5.856-6.72-15.968-7.328-22.56-1.504-6.656 5.824-7.328 15.936-1.504 22.56l44 50.304-44.608 57.344c-5.44 6.976-4.16 17.024 2.784 22.464a16.104 16.104 0 0 0 9.856 3.36c4.768 0 9.472-2.112 12.64-6.176l40.8-52.48 46.528 53.152A15.874 15.874 0 0 0 208 336.011c3.744 0 7.488-1.312 10.528-3.968 6.656-5.824 7.328-15.936 1.504-22.56z" style="" fill="#fafafa" data-original="#fafafa"></path>
											</g>
										</svg>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="px-3 py-2 bg-white rounded-2 mx-2 mt-2">
			<div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
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
				<div id="people_wrapper" class="dataTables_wrapper no-footer">
					<div id="project_filter" class="dataTables_filter justify-content-end d-flex">
						<label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
					</div>
				</div>
			</div>
			<table id="today-follow-feedback" class="table main-table w-100 inquiry_all_status_insert">
				<thead>
					<tr>
						<th>
							<input type="checkbox" class="selectall" id="select_all">
						</th>
						<th>Inquiry Detail</th>
					</tr>
				</thead>
				<tbody id="inqr_show_data_list" class="inqr_show_data_list"></tbody>
			</table>
			<div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
				<div class="row_count_div col-xl-6 col-12">
					<p id="row_count"></p>
				</div>
				<div class="clearfix  col-xl-6 col-12">
					<ul class="inq_pagination justify-content-xl-end" id="inq_pagination">
					</ul>
				</div>
			</div>
		</div>
	</div>
</div> -->

<div class="main-dashbord p-2 main-check-class">
	<div class="container-fluid p-0">
		<div class="p-2">
			<div class="bg-white d-flex flex-wrap p-3 rounded">
				<div class="d-flex justify-content-between align-items-center my-2 flex-wrap w-100">
					<div class="title-1">
						<i class="bi bi-people"></i>
						<h2>
							<?php if (isset($_REQUEST['followup'])) {
								if ($_REQUEST['followup'] == 'today') {
									echo 'Today Followups';
								} else if ($_REQUEST['followup'] == 'pending') {
									echo 'Pending Followups';
								} else if ($_REQUEST['followup'] == 'cnr') {
									echo 'CNR Inquirys';
								} else if ($_REQUEST['followup'] == 'assign_to_other') {
									// $filterd_name = str_replace('_', ' ', $_REQUEST['followup']);
									// echo ucwords($filterd_name) . " Inquiry";
									echo "Inquirys Assign To Others";
								} else if ($_REQUEST['followup'] == 'closerequest') {
									echo 'Close Requests';
								} else {
									// echo ucwords($_REQUEST['followup']) . " All Followup";
									echo "All Inquiry";
								}
							} else {
								// echo "Manage All Followup";
								echo "All Inquiry";
							} ?>
						</h2>
					</div>
					<div class="title-side-icons">
						<?php
						if (isset($_REQUEST['followup']) && ($_REQUEST['followup'] == 'today' || $_REQUEST['followup'] == 'pending')) {
						?>
							<ul class="nav nav-pills task-nav" id="pills-tab-1" role="tablist">
								<?php if ($_REQUEST['followup'] != 'pending') { ?>
									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-0 rounded-start lh-normal p-2 presentation-btn" data-presentation_name="clockview" id="pills-clockview-tab" data-bs-toggle="pill" data-bs-target="#pills-clockview" type="button" role="tab" aria-controls="pills-clockview" aria-selected="true">
											<i class="bi bi-alarm text-primary d-flex fs-5"></i>
										</button>
									</li>
								<?php } ?>
								<li class="nav-item" role="presentation">
									<button class="nav-link <?php if ($_REQUEST['followup'] != 'pending') {
															} else {
																echo "rounded-start";
															} ?> rounded-0 lh-normal p-2 presentation-btn" id="pills-cardview-tab" data-bs-toggle="pill" data-presentation_name="cardview" data-bs-target="#pills-cardview" type="button" role="tab" aria-controls="pills-cardview" aria-selected="false" tabindex="-1">
										<i class="bi bi-view-list text-primary d-flex fs-5"></i>
									</button>
								</li>
								<li class="nav-item" role="presentation">
									<button class="nav-link rounded-0 rounded-end lh-normal p-2 presentation-btn active" id="pills-listview-tab" data-bs-toggle="pill" data-presentation_name="listview" data-bs-target="#pills-listview" type="button" role="tab" aria-controls="pills-listview" aria-selected="false" tabindex="-1">
										<i class="bi bi-list-ul text-primary d-flex fs-5"></i>
									</button>
								</li>
							</ul>
						<?php
						}
						?>
						<?php if (in_array('inquiry_import_csv_permission', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
							<i class="bi bi-file-earmark-arrow-up-fill text-secondary fs-3 cursor-pointer" data-bs-toggle="modal" data-bs-target="#import_csv"></i>
						<?php } ?>
						<?php if (in_array('inquiry_export_csv_permission', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
							<a href="#" class="add_property_js add_user_role_css add_user-role-pdf export-inq">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 2462 2462" fill="none">
									<path d="M1724.37 1682.33H945.625C914.92 1682.33 890 1657.41 890 1626.7V514.204C890 483.499 914.92 458.579 945.625 458.579H1724.37C1755.08 458.579 1780 483.499 1780 514.204V1626.7C1780 1657.41 1755.08 1682.33 1724.37 1682.33Z" fill="#ECEFF1" />
									<path d="M1168.12 792.328H945.625C914.92 792.328 890 767.408 890 736.703C890 705.998 914.92 681.078 945.625 681.078H1168.12C1198.83 681.078 1223.75 705.998 1223.75 736.703C1223.75 767.408 1198.83 792.328 1168.12 792.328ZM1168.12 1014.83H945.625C914.92 1014.83 890 989.908 890 959.203C890 928.498 914.92 903.578 945.625 903.578H1168.12C1198.83 903.578 1223.75 928.498 1223.75 959.203C1223.75 989.908 1198.83 1014.83 1168.12 1014.83ZM1168.12 1237.33H945.625C914.92 1237.33 890 1212.41 890 1181.7C890 1151 914.92 1126.08 945.625 1126.08H1168.12C1198.83 1126.08 1223.75 1151 1223.75 1181.7C1223.75 1212.41 1198.83 1237.33 1168.12 1237.33ZM1168.12 1459.83H945.625C914.92 1459.83 890 1434.91 890 1404.2C890 1373.5 914.92 1348.58 945.625 1348.58H1168.12C1198.83 1348.58 1223.75 1373.5 1223.75 1404.2C1223.75 1434.91 1198.83 1459.83 1168.12 1459.83ZM1501.87 792.328H1390.62C1359.92 792.328 1335 767.408 1335 736.703C1335 705.998 1359.92 681.078 1390.62 681.078H1501.87C1532.58 681.078 1557.5 705.998 1557.5 736.703C1557.5 767.408 1532.58 792.328 1501.87 792.328ZM1501.87 1014.83H1390.62C1359.92 1014.83 1335 989.908 1335 959.203C1335 928.498 1359.92 903.578 1390.62 903.578H1501.87C1532.58 903.578 1557.5 928.498 1557.5 959.203C1557.5 989.908 1532.58 1014.83 1501.87 1014.83ZM1501.87 1237.33H1390.62C1359.92 1237.33 1335 1212.41 1335 1181.7C1335 1151 1359.92 1126.08 1390.62 1126.08H1501.87C1532.58 1126.08 1557.5 1151 1557.5 1181.7C1557.5 1212.41 1532.58 1237.33 1501.87 1237.33ZM1501.87 1459.83H1390.62C1359.92 1459.83 1335 1434.91 1335 1404.2C1335 1373.5 1359.92 1348.58 1390.62 1348.58H1501.87C1532.58 1348.58 1557.5 1373.5 1557.5 1404.2C1557.5 1434.91 1532.58 1459.83 1501.87 1459.83Z" fill="#388E3C" />
									<path d="M981.114 248.869C968.431 238.3 951.41 233.739 935.39 237.076L45.39 403.951C32.6297 406.309 21.0999 413.066 12.8066 423.046C4.51337 433.027 -0.0183085 445.599 5.55947e-05 458.575V1682.32C5.55947e-05 1709.02 19.0238 1732.05 45.39 1736.95L935.39 1903.82C938.727 1904.49 942.176 1904.82 945.625 1904.82C958.53 1904.82 971.101 1900.37 981.114 1892.03C987.412 1886.81 992.482 1880.27 995.962 1872.86C999.443 1865.46 1001.25 1857.38 1001.25 1849.2V291.7C1001.25 275.124 993.907 259.437 981.114 248.869Z" fill="#2E7D32" />
									<path d="M764.951 1256.35L589.065 1055.32L766.954 826.588C785.866 802.335 781.416 767.403 757.275 748.49C733.134 729.578 698.201 734.028 679.178 758.169L514.417 969.989L375.577 811.347C355.218 787.984 320.063 785.87 297.145 806.118C274.005 826.365 271.669 861.52 291.917 884.549L444.885 1059.43L289.803 1258.79C270.89 1283.05 275.34 1317.98 299.482 1336.89C309.295 1344.47 321.347 1348.58 333.747 1348.57C350.323 1348.57 366.677 1341.23 377.69 1327.1L519.534 1144.65L681.291 1329.44C686.477 1335.45 692.899 1340.27 700.118 1343.57C707.337 1346.87 715.183 1348.58 723.121 1348.57C736.138 1348.57 749.154 1344.01 759.723 1334.78C782.863 1314.53 785.199 1279.38 764.951 1256.35Z" fill="#FAFAFA" />
									<circle cx="1876" cy="1639.88" r="586" fill="#2E7D32" />
									<path d="M2218 1868.24V1754.06C2218 1746.49 2215 1739.23 2209.65 1733.88C2204.31 1728.52 2197.06 1725.52 2189.5 1725.52C2181.94 1725.52 2174.69 1728.52 2169.35 1733.88C2164 1739.23 2161 1746.49 2161 1754.06V1868.24C2161 1875.81 2158 1883.07 2152.65 1888.43C2147.31 1893.78 2140.06 1896.79 2132.5 1896.79H1619.5C1611.94 1896.79 1604.69 1893.78 1599.35 1888.43C1594 1883.07 1591 1875.81 1591 1868.24V1754.06C1591 1746.49 1588 1739.23 1582.65 1733.88C1577.31 1728.52 1570.06 1725.52 1562.5 1725.52C1554.94 1725.52 1547.69 1728.52 1542.35 1733.88C1537 1739.23 1534 1746.49 1534 1754.06V1868.24C1534 1890.95 1543.01 1912.74 1559.04 1928.8C1575.08 1944.86 1596.82 1953.88 1619.5 1953.88H2132.5C2155.18 1953.88 2176.92 1944.86 2192.96 1928.8C2208.99 1912.74 2218 1890.95 2218 1868.24ZM2036.17 1719.24L1893.67 1833.42C1888.64 1837.4 1882.41 1839.57 1876 1839.57C1869.59 1839.57 1863.36 1837.4 1858.33 1833.42L1715.83 1719.24C1710.64 1714.33 1707.47 1707.64 1706.97 1700.51C1706.46 1693.38 1708.64 1686.31 1713.08 1680.71C1717.53 1675.12 1723.9 1671.39 1730.96 1670.28C1738.01 1669.17 1745.22 1670.75 1751.17 1674.7L1847.5 1751.78V1354.42C1847.5 1346.85 1850.5 1339.59 1855.85 1334.24C1861.19 1328.89 1868.44 1325.88 1876 1325.88C1883.56 1325.88 1890.81 1328.89 1896.15 1334.24C1901.5 1339.59 1904.5 1346.85 1904.5 1354.42V1751.78L2000.83 1674.7C2003.7 1671.99 2007.1 1669.9 2010.82 1668.58C2014.54 1667.25 2018.49 1666.71 2022.42 1666.99C2026.36 1667.27 2030.2 1668.37 2033.69 1670.21C2037.18 1672.06 2040.25 1674.61 2042.7 1677.7C2045.16 1680.79 2046.95 1684.37 2047.95 1688.19C2048.96 1692.01 2049.16 1696 2048.55 1699.91C2047.93 1703.81 2046.51 1707.54 2044.38 1710.87C2042.25 1714.2 2039.46 1717.05 2036.17 1719.24Z" fill="white" />
								</svg>
							</a>
						<?php } ?>
						<?php if (in_array('inquiry_management_information_child_delete_all_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
							<div class="deleted-all">
								<span class="btn-primary-rounded">
									<i class="bi bi-trash3 fs-14"></i>
								</span>

							</div>
							<div class="deleted-all2">
								<button class="btn-primary-rounded" data-bs-toggle="modal" data-bs-target="#sms_send">
									<i class="bi bi-chat-right-dots d-flex fs-14"></i>
								</button>
							</div>
						<?php } ?>
						<?php if (!isset($_REQUEST['followup'])) { ?>
							<button class="btn-primary-rounded add" type="button" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update" aria-controls="inquiry_all_status_update">
								<i class="bi bi-plus"></i>
							</button>
						<?php } ?>
						<button class="btn-primary-rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
							<i class="bi bi-funnel fs-14"></i>
						</button>
					</div>
				</div>
				<div class="col-12">
					<div class="d-flex justify-content-between flex-wrap">
						<div class="main-select-section align-items-end col-xl-6 col-12 col-sm-12 col-md-10 col-lg-10 col-md-10 col-sm-12">
							<form class="needs-validation" name="assign_form" method="POST" novalidate>
								<div class="main-selection-toggle d-flex align-items-end align-items-center flex-wrap">
									<div class="bulk-action select col-lg-6 col-xl-5 px-1 mt-lg-0 col-12 col-sm-5 col-md-6 col-sm-6 mb-1">
										<label for="areaname" class="form-label main-label">Select Action</label>
										<div class="main-selectpicker">
											<select name="action_name" id="action_name" id="bulk-action" class="selectpicker form-control form-main" data-live-search="true" required="">
												<option value="">Select Action</option>
												<option value="assign_followups">Assign Followups</option>
												<option value="transfer_ownership">Transfer Inq</option>
											</select>
										</div>
									</div>
									<div class="employee-action select col-lg-6 col-xl-5 px-1 mt-lg-0 col-12 col-sm-5 col-md-6 col-sm-6 mb-1">
										<label for="areaname" class="form-label main-label">Select Employee</label>
										<div class="main-selectpicker">
											<select id="assign_id" name="assign_id" class="selectpicker form-control form-main" data-live-search="true" required="">
												<option value="">Select employee</option>
												<?php if (!empty($user_data)) {
													foreach ($user_data as $key => $user_valuess) {
												?>
														<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['id']; ?>"><?php echo $user_valuess['firstname']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-xl-2 px-1 mb-1 mt-auto">
										<button class="btn-primary inquiry_assign" id="inquiry_assign_btn" data-edit_id="" name="inquiry_assign" value="inquiry_assign">submit</button>
									</div>
								</div>
							</form>
						</div>
						<div class="col-12 filter-show d-flex" id="filter-showw">
						</div>
						<div class="col-12">
							<button class="btn bg-danger mx-1 mt-2 clear btn-sm text-white fs-7" id="clear">Clear All</button>
						</div>
						<div class="file-up-down d-flex justify-content-xl-end justify-content-lg-start col-lg-10 col-md-10 col-sm-12 col-12 col-xl-2 ms-auto">
							<div class="text-secondary d-flex align-items-center">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-content" id="pills-tabContent-1">
		<?php if (isset($_REQUEST['followup']) && ($_REQUEST['followup'] == 'today' || $_REQUEST['followup'] == 'pending')) { ?>
			<div class="tab-pane fade" id="pills-clockview" role="tabpanel" aria-labelledby="pills-clockview-tab" tabindex="0">
				<div class="p-2">
					<div class="overflow-x-scroll scroll-small" style="height: 100vh;">
						<div class="d-flex w-100 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 flex-nowrap clockDiv_main">
							<!-- clock view  -->
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="pills-cardview" role="tabpanel" aria-labelledby="pills-cardview-tab" tabindex="0">
				<div class="p-2">
					<div class="overflow-x-scroll scroll-small" style="height: 100vh;">
						<div class="d-flex w-100 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 flex-wrap flex-sm-nowrap card_data">
							<!-- card view  -->
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="tab-pane fade show active" id="pills-listview" role="tabpanel" aria-labelledby="pills-listview-tab" tabindex="0">
			<div class="container-fluid p-0">
				<div class="px-3 py-2 bg-white rounded-2 mx-2 mt-2">

					<?php if (isset($_REQUEST['followup']) && ($_REQUEST['followup'] == 'closerequest' || $_REQUEST['followup'] == 'appointment' || $_REQUEST['followup'] == 'dismissed')) {
						echo '<div class="navigation col-xl-10 overflow-auto mt-2"></div>';
					} else { ?>
						<div class="navigation col-xl-10 overflow-auto mt-2">
							<?php if (isset($_GET['mobileno'])) {
							} else { ?>
								<ul class="nav nav-pills navtab_primary_sm w-100 flex-xl-wrap flex-nowrap" id="status-main-tab" role="tablist">
									<?php
									$total_inq_count = 0;
									$cnr_status_value = '17';
									$cnr_count = 0; // Initialize $cnr_count here
									if (!empty($getStatusWiseData)) {
										foreach ($getStatusWiseData as $inq_status_key => $inq_status_value) {
											if (!empty($inq_status_value['inq_status_name'])) {
												$total_inq_count += $inq_status_value['total_inq'];
												if (isset($inq_status_value['cnr_count'])) {
													$cnr_count += $inq_status_value['cnr_count']; // Increment $cnr_count
												}
									?>
												<li class="nav-item" role="presentation">
													<button class="nav-link text-nowrap" data-inquiry="<?php echo $inq_status_value['inquiry_status']; ?>">
														<?php echo $inq_status_value['inq_status_name']; ?> (<?php echo $inq_status_value['total_inq']; ?>)
													</button>
												</li>
									<?php
											}
										}
									}
									?>
									<li class="nav-item" role="presentation">
										<button class="nav-link text-nowrap fresh active" data-inquiry="">
											All
										</button>
									</li>
									<?php if (isset($_GET['followup']) && $_GET['followup'] == 'cnr') { ?>
										<li class="nav-item">
											<button class="nav-link " data-inquiry="17">Cnr(<?php echo ($getStatusWiseData['cnr_count']);
																							?>)</button>
										</li>
									<?php } ?>
								</ul>
							<?php } ?>
						</div>
					<?php } ?>
					<div class="px-3 py-2 bg-white rounded-2 mx-2 mt-2">
						<div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
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
									<span class="list_count text-success"></span>
								</label>
							</div>
							<div id="people_wrapper" class="dataTables_wrapper no-footer">
								<div id="project_filter" class="dataTables_filter justify-content-end d-flex">
									<label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
								</div>
							</div>
						</div>
						<table id="today-follow-feedback" class="table main-table w-100 inquiry_all_status_insert">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="select-all-sms " id="select_all">
									</th>
									<th>Inquiry Detail</th>
								</tr>
							</thead>
							<tbody id="inqr_show_data_list" class="inqr_show_data_list"></tbody>
						</table>
						<div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
							<div class="row_count_div col-xl-6 col-12">
								<p id="row_count"></p>
							</div>
							<div class="clearfix  col-xl-6 col-12">
								<ul class="inq_pagination justify-content-xl-end" id="inq_pagination">
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="modal fade" id="import_csv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" style="max-width: 900px;">
		<div class="modal-content">
			<form class="needs-validation" name="import_inquiry_csv" method="POST" novalidate="">
				<div class="modal-header">
					<h4 class="modal-title">Add Inquiry</h4>
					<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
				<div class="modal-body modal-body-secondery">
					<div class="modal-body-card justify-content-between align-items-end">
						<div class="col-12 col-sm-4">
							<label for="" class="form-label main-label">Inq CSV upload :</label>
							<input type="file" class="form-control form-controll" id="import_file" name="import_file" placeholder="Details" required="">
						</div>
						<div class="col-12 d-flex align-items-end justify-content-end">
							<a class="cursor-pointer add_property_js add_user_role_css add_user-role-pdf" href="<?php echo base_url('/assets/import_inq.csv'); ?>" download='import_inq.csv'>
								<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="28" height="28" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
									<g>
										<path d="M496 432.011H272c-8.832 0-16-7.168-16-16v-320c0-8.832 7.168-16 16-16h224c8.832 0 16 7.168 16 16v320c0 8.832-7.168 16-16 16z" style="" fill="#eceff1" data-original="#eceff1"></path>
										<path d="M336 176.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 240.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 304.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM336 368.011h-64c-8.832 0-16-7.168-16-16s7.168-16 16-16h64c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 176.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 240.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 304.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16zM432 368.011h-32c-8.832 0-16-7.168-16-16s7.168-16 16-16h32c8.832 0 16 7.168 16 16s-7.168 16-16 16z" style="" fill="#388e3c" data-original="#388e3c" class=""></path>
										<path d="M282.208 19.691c-3.648-3.04-8.544-4.352-13.152-3.392l-256 48A15.955 15.955 0 0 0 0 80.011v352c0 7.68 5.472 14.304 13.056 15.712l256 48c.96.192 1.952.288 2.944.288 3.712 0 7.328-1.28 10.208-3.68a16.006 16.006 0 0 0 5.792-12.32v-448c0-4.768-2.112-9.28-5.792-12.32z" style="" fill="#2e7d32" data-original="#2e7d32" class=""></path>
										<path d="m220.032 309.483-50.592-57.824 51.168-65.792c5.44-6.976 4.16-17.024-2.784-22.464-6.944-5.44-16.992-4.16-22.464 2.784l-47.392 60.928-39.936-45.632c-5.856-6.72-15.968-7.328-22.56-1.504-6.656 5.824-7.328 15.936-1.504 22.56l44 50.304-44.608 57.344c-5.44 6.976-4.16 17.024 2.784 22.464a16.104 16.104 0 0 0 9.856 3.36c4.768 0 9.472-2.112 12.64-6.176l40.8-52.48 46.528 53.152A15.874 15.874 0 0 0 208 336.011c3.744 0 7.488-1.312 10.528-3.968 6.656-5.824 7.328-15.936 1.504-22.56z" style="" fill="#fafafa" data-original="#fafafa"></path>
									</g>
								</svg>
							</a>
						</div>
					</div>
					<h6 class="modal-body-title">CST Interest</h6>
					<div class="modal-body-card">
						<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<label for="intrested_area" class="form-label main-label">Int Area</label>
							<div class="main-selectpicker">
								<!-- <select name="intrested_area" id="intrested_area" class="selectpicker form-control form-main" data-live-search="true" required>
									<i class="fa-solid fa-caret-down "></i>
									<option class="dropdown-item" value="">Select Area</option>
									<?php
									if (isset($area)) {
										foreach ($area as $area_key => $area_value) {
											echo '<option class="dropdown-item" value="' . $area_value["id"] . '" data-area_id="' . $area_value["area"] . '">' . $area_value["area"] . '</option>';
										}
									}
									?>
								</select> -->
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<!-- <div class="col-lg-4 col-md-4 col-sm-6">
							<label for="property_sub_type" class="form-label main-label">Property Sub
								Type</label>
							<div class="main-selectpicker">
								<select name="property_sub_type" id="property_sub_type" class="selectpicker form-control form-main" data-live-search="true" required>
									<i class="fa-solid fa-caret-down"></i>
									<option class="dropdown-item" value="">Select Property Type</option>
									<?php
									// if (isset($project_management_subtype)) {
									// 	foreach ($project_management_subtype as $type_key => $type_value) {
									// 		echo '<option class="dropdown-item" value="' . $type_value["id"] . '" data-property_type="' . $type_value["project_type"] . '" >' . $type_value["project_sub_type"] . '</option>';
									// 	}
									// }
									?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div> -->
						<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<label for="intrested_site" class="form-label main-label">Int Product</label>
							<div class="main-selectpicker">
								<select name="intrested_site" id="intrested_site" class="selectpicker form-control form-main" data-live-search="true" required>
									<i class="fa-solid fa-caret-down"></i>
									<option class="dropdown-item" value="">Select Int Product</option>
									<?php
									if (isset($admin_product)) {
										foreach ($admin_product as $area_key => $type_value) {
											echo '<option class="dropdown-item" value="' . $type_value["id"] . '" data-intersted_site_id="' . $type_value["product_name"] . '" >' . $type_value["product_name"] . '</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<label for="assign_id" class="form-label main-label">Assign Id</label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main" id="assign_id" name="assign_id" data-live-search="true" required="">
									<option class="dropdown-item" value="">Assign To</option>
									<?php if (!empty($user_full_data)) {
										foreach ($user_full_data as $key => $user_valuess) {
											if ($user_valuess['switcher_active'] == 'active') { ?>
												<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['id']; ?>"><?php echo $user_valuess['firstname']; ?></option>

									<?php }
										}
									} ?>

								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<label for="owner_id" class="form-label main-label">Owner Id</label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main" id="owner_id" name="owner_id" data-live-search="true" required="">
									<option class="dropdown-item" value="">owner To</option>
									<?php if (!empty($userUnderEmployee)) {
										foreach ($userUnderEmployee as $key => $user_valuess) {
											if ($user_valuess['switcher_active'] == 'active') { ?>
												<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['user_id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo $user_valuess['user_role']; ?>)</option>
									<?php
											}
										}
									}
									?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
					</div>
					<h6 class="modal-body-title">Inquiry Information</h6>
					<div class="modal-body-card">
						<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<label for="inquiry_type" class="form-label main-label">Inquiry
								Type</label>
							<div class="main-selectpicker">
								<select name="inquiry_type" id="inquiry_type" class="selectpicker form-control form-main" data-live-search="true" required>
									<i class="fa-solid fa-caret-down"></i>
									<option class="dropdown-item" value="">Select Inq Type</option>
									<?php
									if (isset($master_inquiry_type)) {
										foreach ($master_inquiry_type as $type_key => $type_value) { ?>
											<option class="dropdown-item" value="<?php echo $type_value["id"]; ?>"><?php echo $type_value["inquiry_details"]; ?></option>
									<?php }
									} ?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<label for="inquiry_source_type" class="form-label main-label">Inquiry
								Source</label>
							<div class="main-selectpicker">
								<select name="inquiry_source_type" id="inquiry_source_type" class="selectpicker form-control form-main" data-live-search="true" required>
									<i class="fa-solid fa-caret-down"></i>
									<option class="dropdown-item" value="">Select Source Type</option>
									<?php
									if (isset($master_inquiry_source)) {
										foreach ($master_inquiry_source as $source_key => $source_cvalu) { ?>
											<option class="dropdown-item" value="<?php echo $source_cvalu["id"]; ?>"><?php echo $source_cvalu["source"]; ?></option>
									<?php }
									} ?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<div class="custom_Date_class">
								<label for="nxt_follow_up" class="form-label main-label">Next Follow up</label>
								<input type="text" class="nxt_follow_up min-datetime form-control main-control input-main " placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" name="nxt_follow_up" value="" required="" />
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class=" btn-primary import_inquiry_csv_btn" type="submit" id="import_inquiry_csv_btn" name="import_inquiry_csv_btn">Import</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade inquiry_all_status_update " id="inquiry_all_status_update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inquiry_all_status_update" aria-hidden="true">
	<div class="modal-dialog" style="max-width:1000px;">
		<form class="needs-validation" name="inquiry_all_status_update_form" id="inquiry_all_status_update_form" method="POST" novalidate>
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title 	tag_name" id="exampleModalLabel">Add Inquiry <span id="inquiry_unique_id"></span></h4>
					<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
				<div class="modal-body modal-body-secondery">
					<form>
						<h6 class="modal-body-title">Personal Details</h6>

						<div class="modal-body-card mt-2">
							<div class="col-12">
								<div class="col-lg-6 col-md-4 col-sm-6 d-flex align-items-center">
									<label for="mobileno" class="form-label main-label">Business Name :</label>
									<div class="d-flex">
										<input type="text" class="form-control main-control business_name" id="business_name" name="business_name" placeholder="Enter Business Name" value="" required>
									</div>
								</div>
							</div>
							<div class="modal-body-card my-2 w-100 px-4">
								<div class="col-12 row p-0">
									<label for="mobileno" class="row p-0 form-label main-label"><span class="p-0">Contect Person</span></label>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-6">
									<label for="full_name" class="form-label main-label">Full name <sup class="validationn">*</sup> </label>
									<div class="d-flex">
										<input type="text" class="form-control main-control" id="full_name" name="full_name" placeholder="Enter Firstname" value="" required>
									</div>
									<div class="valid-feedback">
										Looks good!
									</div>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-6">
									<label for="Designation" class="form-label main-label">Designation<sup class="validationn">*</sup></label>
									<div class="d-flex">
										<input type="text" class="form-control main-control designation" id="designation" name="designation" placeholder="Enter Designation" value="" required>
									</div>

								</div>
								<div class="col-lg-3 col-md-4 col-sm-6">
									<label for="mobileno" class="form-label main-label">Mobile No <sup class="validationn">*</sup></label>
									<input type="text" minlength="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control mobileno main-control" id="mobileno" name="mobileno" placeholder="Mobile No." value="" data-phone_id="" required>
									<div class="number-error">
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="altmobileno" class="form-label main-label">Alt. Mobile No :</label>
								<div class="d-flex">
									<input type="text" minlength="10" maxlength="10" class="form-control main-control altmobileno" id="altmobileno" name="altmobileno" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Alt. Mobile No." value="">
								</div>
								<div class="number-error">
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="email" class="form-label main-label">Email</label>
								<div class="d-flex">
									<input type="text" class="form-control main-control email" id="email" name="email" placeholder="Enter Email Address" value="">
								</div>
								<div class="email-error">
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="houseno" class="form-label main-label">House</label>
								<div class="d-flex">
									<input type="text" class="form-control main-control" id="houseno" name="houseno" placeholder="House" value="">
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="society" class="form-label main-label">Society</label>
								<div class="d-flex">
									<input type="text" class="form-control main-control" id="society" name="society" placeholder="Society" value="">
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="code_area" class="form-label main-label">Area<sup class="validationn">*</sup></label>
								<div class="d-flex">
									<input autocomplete="off" list="cities" role="combobox" class="form-control main-control" name="area" id="area" data-area_id="" placeholder="Select Area" required="" />
									<datalist id="cities" style="margin-top:45px;">
										<?php
										if (isset($area)) {
											foreach ($area as $area_key => $area_value) {
												echo '<option data-area_option_id="' . $area_value["id"] . '" value="' . $area_value["area"] . '" data-city="' . $area_value["city"] . '">' . $area_value["area"] . '</option>';
											}
										}
										?>
									</datalist>
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="city" class="form-label main-label">City<sup class="validationn">*</sup></label>
								<div class="d-flex">
									<input autocomplete="off" list="select_people_area" role="combobox" class="form-control main-control" name="city" id="city" placeholder="Select City" required="" />
									<datalist id="select_people_area" style="margin-top:45px;">
										<?php
										if (isset($area)) {
											foreach ($area as $area_key => $area_value) {
												echo '<option data-area_option_id="' . $area_value["city"] . '" value="' . $area_value["city"] . '" >' . $area_value["city"] . '</option>';
											}
										}
										?>
									</datalist>
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6">
								<div class="custom_Date_class">
									<label for="dob" class="form-label main-label">Date of Birth</label>
									<input type="text" class="max-date form-control main-control input-main " placeholder="DD/MM/YYYY" id="dob" name="dob" value="" />
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6">
								<div class="custom_Date_class">
									<label for="anni_date" class="form-label main-label">Anniversary Date</label>
									<input type="text" class="max-date form-control main-control input-main " placeholder="DD/MM/YYYY" id="anni_date" name="anni_date" value="" />
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
						</div>
						<h6 class="modal-body-title">CST Interest</h6>
						<div class="modal-body-card">
							<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
								<label for="project_type" class="form-label main-label">Int Product <sup class="validationn">*</sup></label>
								<div class="main-selectpicker">
									<select class="selectpicker form-control form-main" id="intrested_product" name="intrested_product" data-live-search="true" required="">
										<option class="dropdown-item" value="">Select Int Product</option>
										<?php
										if (isset($admin_product)) {
											foreach ($admin_product as $pr_key => $pr_value) {
										?>
												<option class="dropdown-item" value="<?php echo $pr_value['id']; ?>"><?php echo $pr_value['product_name']; ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
								<label for="" class="form-label main-label">Subscription <sup class="validationn">*</sup></label>
								<div class="main-selectpicker">
									<select class="selectpicker form-control form-main" id="subscription" name="subscription" data-live-search="true" required="">
										<option value="" data-plan_price="0">Select Product Plan</option>
										<?php
										$subscription_data = "SELECT * FROM admin_subscription_master";
										$result = $this->db->query($subscription_data);
										$result = $result->getResultArray();
										foreach ($result as $key => $value) {
											echo '<option value="' . $value['id'] . '" data-plan_price="' . $value['plan_price'] . '" data-add_on_user="' . $value['user'] . '">' . $value['plan_name'] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="budget" class="form-label main-label">Budget<sup class="validationn">*</sup></label>
								<div class="main-selectpicker">
									<select id="budget" name="budget" class="selectpicker form-control form-main" data-live-search="true" required>
										<i class="fa-solid fa-caret-down"></i>
										<option class="dropdown-item" value="">Select budget</option>
										<?php
										for ($i = 1; $i <= 100; $i++) {
											echo '<option class="dropdown-item" value="' . $i . '">' . $i . '</option>';
										}
										?>
									</select>
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="purpose_buy" class="form-label main-label">Inquier As<sup class="validationn">*</sup></label>
								<div class="main-selectpicker">
									<select name="buying_as" id="buying_as" class="selectpicker form-control form-main" data-live-search="true" required>
										<i class="fa-solid fa-caret-down"></i>
										<option class="dropdown-item" value="">Select Inquier of Type</option>
										<option class="dropdown-item" value="Agency">Agency</option>
										<option class="dropdown-item" value="Builder">Builder</option>
									</select>
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<label for="approx_buy" class="form-label main-label">Apx Buying Time<sup class="validationn">*</sup></label>
								<div class="main-selectpicker">
									<select id="approx_buy" name="approx_buy" class="selectpicker form-control form form-main" data-live-search="true" required>
										<i class="fa-solid fa-caret-down"></i>
										<option class="dropdown-item" value="">Select Apx Time</option>
										<option class="dropdown-item" value="2-3 days">2-3 Days</option>
										<option class="dropdown-item" value="week">Week</option>
										<option class="dropdown-item" value="10-15_days">10-15 Days</option>
										<option class="dropdown-item" value="1-month">1 Month</option>
										<option class="dropdown-item" value="2-month">2 Month</option>
										<option class="dropdown-item" value="3-month">3 Month</option>
										<option class="dropdown-item" value="4-month">4 Month</option>
										<option class="dropdown-item" value="5-month">5 Month</option>
										<option class="dropdown-item" value="6-month">6 Month</option>
										<option class="dropdown-item" value="7-month">7 Month</option>
										<option class="dropdown-item" value="8-month">8 Month</option>
										<option class="dropdown-item" value="9-month">9 Month</option>
										<option class="dropdown-item" value="10-month">10 Month</option>
										<option class="dropdown-item" value="11-month">11 Month</option>
										<option class="dropdown-item" value="1-year">1 Year</option>
										<option class="dropdown-item" value="1.5-year">1.5 Year</option>
										<option class="dropdown-item" value="2-year">2 Year</option>
									</select>
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
						</div>
						<h6 class="modal-body-title">Inq Information</h6>
						<div class="modal-body-card">
							<div class="col-lg-4 col-md-4 col-sm-6">
								<label for="inquiry_type" class="form-label main-label">Inq Type<sup class="validationn">*</sup></label>
								<div class="main-selectpicker">
									<select name="inquiry_type" id="inquiry_type" class="selectpicker form-control form-main" data-live-search="true" required>
										<i class="fa-solid fa-caret-down"></i>
										<option class="dropdown-item" value="">Select Inq Type</option>
										<?php
										if (isset($master_inquiry_type)) {
											foreach ($master_inquiry_type as $type_key => $type_value) { ?>
												<option class="dropdown-item" value="<?php echo $type_value["id"]; ?>"><?php echo $type_value["inquiry_details"]; ?></option>
										<?php }
										} ?>
									</select>
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6">
								<label for="inquiry_source_type" class="form-label main-label">Inq Source<sup class="validationn">*</sup></label>
								<div class="main-selectpicker">
									<select name="inquiry_source_type" id="inquiry_source_type" class="selectpicker form-control form-main" data-live-search="true" required>
										<i class="fa-solid fa-caret-down"></i>
										<option class="dropdown-item" value="">Select Source Type</option>
										<?php
										if (isset($master_inquiry_source)) {
											foreach ($master_inquiry_source as $source_key => $source_cvalu) { ?>
												<option class="dropdown-item" value="<?php echo $source_cvalu["id"]; ?>"><?php echo $source_cvalu["source"]; ?></option>
										<?php }
										} ?>
									</select>
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 nxtiii">
								<div class="custom_Date_class">
									<label for="nxt_follow_up" class="form-label main-label">Next Follow up <sup class="validationn">*</sup></label>
									<input type="text" class="nxt_follow_up min-datetime form-control main-control input-main " placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" name="nxt_follow_up" value="" required="" />
								</div>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
						</div>
						<h6 class="modal-body-title">Follow Up</h6>
						<div class="modal-body-card">
							<div class="col-lg-12 col-md-12 col-sm-12 mt-0">
								<label for="inquiry_description" class="form-label main-label">Description</label>
								<textarea id="inquiry_description" class="form-control main-control" placeholder="Inquiry Desc." name="inquiry_description" maxlength="500"></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn-primary inquiry_all_status_update inquiry_all_status_update_btn" id="inquiry_all_status_update_btn" data-edit_id="" data-people_id="" data-assign_id="" name="inquiry_all_status_update" value="inquiry_all_status_update">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="visit_entry_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visit_entry_form" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="max-width:1100px;">
		<form class="needs-validation" method="POST" novalidate="" name="allinquiry_update_form">
			<div class="modal-content">
				<div id="modal-code" class="modal-header">
					<h5 class="modal-title">Visit Entry:<span id="iscountvisit" class="text-gray"></span></h5>
					<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
				<div class="modal-body modal-body-secondery">
					<h6 class="modal-body-title">Customer Information</h6>
					<div class="modal-body-card">
						<input type="hidden" id="isSiteVisit" name="isSiteVisit">
						<input type="hidden" id="iscountvisit" name="iscountvisit">
						<input type="hidden" id="inquiry_status" name="inquiry_status">
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="" class="form-label main-label">Mobile No :</label>
							<input type="text" class="form-control main-control" placeholder="Enter mobile no" name="mobilenoo" id="mobilenoo" value="" disabled="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="project_tagline" class="form-label main-label">Name <sup class="validationn">*</sup></label>
							<input type="text" class="form-control main-control" id="full_name" name="full_name" placeholder="Name" value="" required="" readonly>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="p_shortname" class="form-label main-label">Address<sup class="validationn">*</sup></label>
							<input type="text" class="form-control main-control" id="address" name="address" placeholder="Address" value="," required="" readonly>
						</div>
					</div>
					<h6 class="modal-body-title">Interest</h6>
					<div class="modal-body-card">
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="project_type" class="form-label main-label">Int Product <sup class="validationn">*</sup></label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main" id="intrested_product" name="intrested_product" data-live-search="true" required="">
									<option class="dropdown-item" value="">Select Int Product</option>
									<?php
									if (isset($admin_product)) {
										foreach ($admin_product as $pr_key => $pr_value) {
									?>
											<option class="dropdown-item" value="<?php echo $pr_value['id']; ?>"><?php echo $pr_value['product_name']; ?></option>
									<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="" class="form-label main-label">Subscription <sup class="validationn">*</sup></label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main subscription" id="subscription" name="subscription" data-live-search="true" required="">
									<option value="" data-plan_price="0">Select Product Plan</option>
									<?php
									$subscription_data = "SELECT * FROM admin_subscription_master";
									$result = $this->db->query($subscription_data);
									$result = $result->getResultArray();
									foreach ($result as $key => $value) {
										echo '<option value="' . $value['id'] . '" data-plan_price="' . $value['plan_price'] . '" data-add_on_user="' . $value['user'] . '">' . $value['plan_name'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="p_shortname" class="form-label main-label">Budget</label>
							<input type="text" class="form-control main-control" id="budget" name="budget" placeholder="Budget" maxlength="12" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="" class="form-label main-label">Buying As<sup class="validationn">*</sup></label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control" id="buying_as" name="buying_as" data-live-search="true" required="">
									<option value="">Select Buying As</option>
									<option value="Builder">Builder</option>
									<option value="Agency">Agency</option>
									<option value="Broker">Broker</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="" class="form-label main-label">Apx Buying Time <sup class="validationn">*</sup></label>
							<div class="main-selectpicker">
								<select id="approx_buy" name="approx_buy" class="selectpicker form-control form form-main" data-live-search="true" required>
									<i class="fa-solid fa-caret-down"></i>
									<option class="dropdown-item" value="">Select Apx Time</option>
									<option class="dropdown-item" value="2-3 days">2-3 Days</option>
									<option class="dropdown-item" value="week">Week</option>
									<option class="dropdown-item" value="10-15_days">10-15 Days</option>
									<option class="dropdown-item" value="1-month">1 Month</option>
									<option class="dropdown-item" value="2-month">2 Month</option>
									<option class="dropdown-item" value="3-month">3 Month</option>
									<option class="dropdown-item" value="4-month">4 Month</option>
									<option class="dropdown-item" value="5-month">5 Month</option>
									<option class="dropdown-item" value="6-month">6 Month</option>
									<option class="dropdown-item" value="7-month">7 Month</option>
									<option class="dropdown-item" value="8-month">8 Month</option>
									<option class="dropdown-item" value="9-month">9 Month</option>
									<option class="dropdown-item" value="10-month">10 Month</option>
									<option class="dropdown-item" value="11-month">11 Month</option>
									<option class="dropdown-item" value="1-year">1 Year</option>
									<option class="dropdown-item" value="1.5-year">1.5 Year</option>
									<option class="dropdown-item" value="2-year">2 Year</option>
								</select>
							</div>
						</div>
					</div>
					<h6 class="modal-body-title">Suggestion</h6>
					<div class="modal-body-card">
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label for="" class="form-label main-label">Int Subscription <sup class="validationn">*</sup></label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main" id="int_subscription" name="int_subscription" data-live-search="true" required="">
									<option class="dropdown-item" value="">Select Subscription</option>
									<option class="dropdown-item" value="Core">Core</option>
									<option class="dropdown-item" value="Advance">Advance</option>
									<option class="dropdown-item" value="Enterprise">Enterprise</option>
								</select>
							</div>
						</div>
					</div>
					<h6 class="modal-body-title">Buying information</h6>
					<div class="modal-body-card">
						<div class="col-lg-3 col-md-4 col-sm-6 col-md-4 col-sm-6">
							<label class="form-label main-label">Remark<sup class="validationn">*</sup></label>
							<textarea class="form-control main-control remark" id="remark" name="remark" rows="1" cols="50" required=""></textarea>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<label class="form-label main-label">Next FollowupDate <sup class="validationn">*</sup> </label>
							<div class="custom_Date_class">
								<input type="text" placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" class="form-control main-control next-followup">
								<div class="date_valid_msg"></div>
								<div class="custom_Date_class">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" name="submit" value="allinquiry_submit" class="btn-primary inquiry_visited_submit edit_value" id="inquiry_visited_submit" data-edit_id="" id="add_data">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="view_inquery_list" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">id : <span id="id"></span></h1>
				<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
					<i class="bi bi-x-circle"></i>
				</button>
			</div>
			<div class="modal-body modal-body-secondery fs-14 text-capitalize">
				<div class="modal-body-card">
					<div class="col-xl-6 col-sm-6">
						<span><span class="font-adjust">Name : </span><span id="full_name"></span></span>
					</div>
					<div class="col-xl-6 col-sm-6">
						<span><span class="font-adjust">Mobile No : </span><span id="mobileno"></span></span>
					</div>
					<div class="col-xl-6 col-sm-6">
						<span><span class="font-adjust">Source : </span><span id="inquiry_source_type"></span></span>
					</div>
					<div class="col-xl-6 col-sm-6">
						<span><span class="font-adjust">Inquiry Type : </span><span id="inquiry_type"></span></span>
					</div>
					<div class="col-xl-6 col-sm-6">
						<span><span class="font-adjust">Business Name : </span><span id="business_name"></span></span>
					</div>
					<div class="col-xl-6 col-sm-6">
						<span><span class="font-adjust">Designation : </span><span id="designation"></span></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">
							<i class="fa-solid fa-envelope"></i> :
						</span>
						<span class="ms-1" id="email"></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">
							<i class="fa-solid fa-location-dot"></i> :
						</span>
						<span class="ms-1" id="houseno"></span>,<span id="society"></span>
					</div>
				</div>
				<h4 class="modal-body-title">Int Product Details</h4>
				<div class="modal-body-card">
					<div class="col-sm-6 col-12">
						<span class="font-adjust">int product : </span><span id="intrested_product"></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">Budget : </span><span id="budget"></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">Inquier As : </span><span id="purpose_buy"></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">Approx Buying : </span><span id="approx_buy"></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">subscription : </span><span id="subscription"></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">int Area : </span><span id="int_area"></span>
					</div>
					<div class="col-sm-6 col-12">
						<span class="font-adjust">int City : </span><span id="int_city"></span>
					</div>
				</div>
				<h4 class="modal-body-title">FollowUp</h4>
				<div class="modal-body-card">
					<div class="col-xl-12">
						<span class="font-adjust">Next Followup Date : </span>
						<span id="nxt_follow_up"></span>
					</div>
					<div class="col-xl-12">
						<span class="font-adjust">Appoitment Date : </span>
						<span id="appointment_date"></span>
					</div>
					<div class="col-xl-12">
						<span class="font-adjust">Description : </span>
						<span id="inquiry_description"></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?php if (in_array('all_inquiry_information_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
					<span class="btn-primary-rounded edt" data-edit_id="" data-bs-toggle="modal" data-bs-target="#inquiry_all_status_update">
						<i class="fas fa-pencil-alt fs-14"></i>
					</span>
				<?php } ?>
				<div class="log-btn mx-2 btn-secondary-rounded log_button" data-log_id="" id="log-btn" data-bs-toggle="modal" data-bs-target="#logmodal">
					<i class="bi bi-clock fs-14"></i>
				</div>
				<?php if (in_array('all_inquiry_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
					<div class="delete_main" href="javascript:void(0)">
						<div class="delete_btn_1 btn-primary w-100 text-center cursor-pointer">Delete</div>
						<div class="really dlt btn-secondary px-3 cursor-pointer" data-delete_id="">Really?</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade callmodal" id="callmodal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered call-model" style="max-width: 800px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title d-flex align-items-center flex-wrap flex-sm-nowrap">
					<h6><span class="id">3242342</span></h6>
					<h6 class="mx-2 text-wrap"><span class="full_name">Devam Virani</span></h6>
					<h6 class="col-12 flex-sm-fill"><i class="bi bi-telephone"></i> : <span class="mobileno">32165 49878</span></h6>
				</div>
				<div class="d-flex align-items-center justify-content-between flex-sm-row flex-column-reverse">
					<div class="my-1 my-sm-0">
						<a class="btn-secondary-rounded tel_mobileno" href="tel:123-456-7890">
							<i class="bi bi-telephone fs-14"></i>
						</a>
					</div>
					<div class="mx-2">
						<a class="btn-secondary-rounded wp_mobileno mx-1" href="tel:123-456-7890">
							<i class="bi bi-whatsapp fs-14"></i>
						</a>
					</div>
					<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
			</div>
			<div class="modal-body modal-body-secondery rounded-bottom fs-14">
				<div class="modal-body-card">
					<div class="col-xl-4 col-md-6 col-sm-6 col-12">
						<span>
							<span class="font-adjust">Intrested Product : </span><span class="intrested_product"></span>
						</span>
					</div>
					<div class="col-xl-4 col-md-6 col-sm-6 col-12">
						<span>
							<span class="font-adjust">Subscription : </span><span class="subscription"></span>
						</span>
					</div>
					<div class="col-xl-4 col-md-6 col-sm-6 col-12">
						<span>
							<span class="font-adjust">Budget : </span><span class="budget"></span>
						</span>
					</div>
					<div class="col-xl-4 col-md-6 col-sm-6 col-12">
						<span>
							<span class="font-adjust">Buying As : </span><span class="buying_as"></span>
						</span>
					</div>
					<div class="col-xl-4 col-md-6 col-sm-6 col-12">
						<span>
							<span class="font-adjust">Approx Buy : </span><span class="approx_buy"></span>
						</span>
					</div>
					<div class="col-xl-4 fill_interest"></div>
				</div>
				<div class="nav nav-pills navtab_secondary_sm call-modal-tabs mb-3 tab-reset mt-2" id="pills-tab" role="tablist"></div>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-follow-up" role="tabpanel" aria-labelledby="follow-up-tab" tabindex="0">
						<div class="modal-body-card mb-2 d-block">
							<form method="post" name="inquiry_update_status_form">
								<div class="col-xl-12">
									<label class="form-label main-label">Remark</label>
									<textarea class="form-control main-control remark" id="remark" rows="1" name="remark" required=""></textarea>
								</div>
								<div class="col-12 mt-2 d-flex justify-content-between">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
										<label class="main-label">next follow up</label>
										<input type="text" class="next-followup form-control input-main" placeholder="DD/MM/YYYY HH:MM" name="nxt_follow_up" value="" required="">
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-dismissed" role="tabpanel" aria-labelledby="dismissed-tab" tabindex="0">
						<div class="modal-body-card mb-2 d-block">
							<form method="post" name="inquiry_update_status_form">
								<div class="col-xl-12">
									<label for="" class="form-label main-label">Remark</label>
									<textarea class="form-control main-control remark" id="remark" rows="1" name="remark" required=""></textarea>
								</div>
								<div class="col-12 mt-2 d-flex justify-content-between flex-wrap">
									<div class="col-xl-6 col-sm-6 col-12 col-lg-6 col-md-6">
										<div class="main-selectpicker">
											<select name="inquiry_close_reason" id="inquiry_close_reason" class="selectpicker form-control form-main" data-live-search="true" required>
												<option value="">Select Close reason</option>
												<?php
												if (isset($master_inquiry_close)) {
													foreach ($master_inquiry_close as $inq_close_key => $inq_close_value) {
														echo '<option value="' . $inq_close_value["id"] . '" >' . $inq_close_value["inquiry_close_reason"] . '</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-appoin" role="tabpanel" aria-labelledby="appoin-tab" tabindex="0">
						<div class="modal-body-card mb-2 d-block">
							<form method="post" name="inquiry_update_status_form">
								<div class="col-xl-12">
									<label for="" class="form-label main-label">Remark</label>
									<textarea class="form-control main-control remark" id="remark" rows="1" name="remark" required=""></textarea>
								</div>
								<div class="d-flex flex-wrap">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 pe-2">
										<label class="main-label">Int Product</label>
										<div class="main-selectpicker">
											<select class="selectpicker form-control form-main" id="intrested_product" name="intrested_product" data-live-search="true" required="">
												<option class="dropdown-item" value="">Select Int Product</option>
												<?php
												if (isset($admin_product)) {
													foreach ($admin_product as $pr_key => $pr_value) {
												?>
														<option class="dropdown-item" value="<?php echo $pr_value['id']; ?>"><?php echo $pr_value['product_name']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<label class="main-label">appointment date</label>
										<input type="text" class="next-followup form-control main-control input-main " placeholder="DD/MM/YYYY HH:MM" id="appoint_date" name="appoint_date" value="" required="" />
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 pe-sm-2 p-0">
										<label class="main-label">next follow up</label>
										<input type="text" class="next-followup form-control main-control input-main " placeholder="DD/MM/YYYY HH:MM" name="nxt_follow_up" value="" required="" />
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-negotia" role="tabpanel" aria-labelledby="negotia-tab" tabindex="0">
						<div class="modal-body-card mb-2 d-block">
							<form method="post" name="inquiry_update_status_form">
								<div class="col-xl-12">
									<label class="form-label main-label">Remark</label>
									<textarea class="form-control main-control remark" id="remark" rows="1" name="remark" required=""></textarea>
								</div>
								<div class="col-12 mt-2 d-flex justify-content-between">
									<div class="col-xl-6 col-lg-6 col-sm-6 col-md-6 col-6">
										<label class="main-label">next follow up</label>
										<input type="text" class="next-followup form-control main-control input-main" placeholder="DD/MM/YYYY HH:MM" id="nxt_follow_up" name="nxt_follow_up" value="" required="" />
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-feedback" role="tabpanel" aria-labelledby="feedback-tab" tabindex="0">
						<div class="modal-body-card mb-2 d-block">
							<form method="post" name="inquiry_update_status_form">
								<div class="col-xl-12">
									<label for="" class="form-label main-control">Remark</label>
									<textarea class="form-control remark" id="remark" rows="1" name="remark" required=""></textarea>
								</div>
								<div class="col-12 mt-2 d-flex justify-content-between">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
										<label for="next-follow-up">next follow up</label>
										<input type="text" class="form-control main-control input-main next-followup" placeholder="DD/MM/YYYY HH:MM" name="nxt_follow_up" value="" required="" />
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-cnr" role="tabpanel" aria-labelledby="cnr-tab" tabindex="0"></div>
				</div>
				<div class="col-xl-12 text-end">
					<button class="btn-primary ms-auto inquiry_status_submit" id="inquiry_status_submit" data-email="" data-inquiry_id="" name="inquiry_status_submit" value="inquiry_status_submit">Submit</button>
				</div>
				<div class="call-list"></div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="logmodal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog" style="max-width:585px;">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title" id="log_idd"></h1>
				<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="log-model">
					<div class="log-box-main">
					</div>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
	<form method="post" class="d-flex flex-column h-100" name="filter_form">
		<div class="offcanvas-header set-bg-color bg-pink">
			<h5 class="offcanvas-title text-white" id="offcanvasRightLabel">filter</h5>
			
			<button type="button" class="modal-close-btn text-light d-block d-sm-none" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
		</div>
		<div class="offcanvas-body filter_data">
			<div class="input-type my-2">
				<input type="text" placeholder="id" class="form-control main-control" name="f_id" id="f_id">
			</div>
			<div class="input-type my-2">
				<input type="text" placeholder="enter name" class="form-control main-control" name="full_name" id="f_full_name">
			</div>
			<div class="input-type my-2">
				<input type="text" placeholder="mobile no" class="form-control main-control" name="f_mobileno" id="f_mobileno">
			</div>
			<?php if (isset($_REQUEST['followup']) && $_REQUEST['followup'] == 'appointment') { ?>
				<div class="input-type my-2">
					<input type="text" class="date form-control main-control input-main  " placeholder="Appointment Date" id="f_appointment_date" name="f_appointment_date" value="" required="" />
					<div class="date_valid_msg"></div>
				</div>
			<?php } ?>
			<div class="input-type my-2">
				<input type="text" class="date form-control main-control input-main nxt_follow_up" placeholder="next follow up" id="f_nxt_follow_up" name="nxt_follow_up" value="" required="" />
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_inquiry_status" name="f_inquiry_status" data-live-search="true">
						<option value="">Inquiry Status</option>
						<?php foreach ($master_inquiry_status as $inquiry_status_key => $inquiry_status_value) { ?>
							<option value="<?php echo $inquiry_status_value['id'] ?>"><?php echo $inquiry_status_value['inquiry_status'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_assign_id" name="f_assign_id" data-live-search="true">
						<option class="dropdown-item" value="">Assign To</option>
						<?php if (!empty($userUnderEmployee)) {
							foreach ($userUnderEmployee as $key => $user_valuess) {
								if ($user_valuess['switcher_active'] == 'active') { ?>
									<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['user_id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo $user_valuess['user_role']; ?>)</option>
						<?php
								}
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_owner_id" name="f_owner_id" data-live-search="true">
						<option class="dropdown-item" value="">owner To</option>
						<?php if (!empty($userUnderEmployee)) {
							foreach ($userUnderEmployee as $key => $user_valuess) {
								if ($user_valuess['switcher_active'] == 'active') { ?>
									<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['user_id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo $user_valuess['user_role']; ?>)</option>
						<?php
								}
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_inquiry_source_type" name="f_inquiry_source_type" data-live-search="true">
						<option class="dropdown-item" value="">Inq Source To</option>
						<?php if (!empty($master_inquiry_source)) {
							foreach ($master_inquiry_source as $key => $user_valuess) { ?>
								<option class="dropdown-item" data-sourcetype_name="employee" value="<?php echo $user_valuess['id']; ?>"><?php echo $user_valuess['source']; ?></option>
						<?php
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_intrested_product" name="f_intrested_product" data-live-search="true">
						<option value="">int product</option>
						<?php


						foreach ($admin_product as $key => $value) {
							echo '<option value="' . $value['id'] . '">' . $value['product_name'] . '</option>';
						}
						?>
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
			<div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_inquiry_type" name="f_inquiry_type" data-live-search="true">
						<option value="">Inq Type</option>
						<?php foreach ($master_inquiry_type as $master_inquiry_typekey => $master_inquiry_typevalue) { ?>
							<option value="<?php echo $master_inquiry_typevalue['id']; ?>"><?php echo $master_inquiry_typevalue['inquiry_details']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<!-- <div class="input-type my-2">
				<div class="main-selectpicker">
					<select class="selectpicker form-control form-main" id="f_intrested_area_name" name="f_intrested_area_name" data-live-search="true">
						<option value="">Int Area</option>
						<?php foreach ($area as $area_key => $area_value) { ?>
											<option value="<?php echo $area_value['area']; ?>"><?php echo $area_value['area']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div> -->
			<h6 class="modal-body-title">duration:</h6>
			<div class="input-type my-2">
				<input type="text" class="form-control main-control date" id="f_from_date" name="from_date" placeholder="From date">
			</div>
			<div class="input-type my-2">
				<input type="text" class="form-control main-control date" id="f_last_date" name="to_date" placeholder="To date">
			</div>
		</div>
	</form>
</div>
<div class="modal fade interested_entry_form" id="interested_entry_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="interested_entry_form" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="max-width:1100px;">
		<form method="post" id="interested_form" name="interested_form">
			<div class="modal-content">
				<div class="modal-header">
					<div class="d-flex justify-content-start">
						<h5 class="modal-title">Edit Inquiry ID :
							<span id="inquiry_id"></span>
						</h5>
					</div>
					<button type="button" class="modal-close-btn interested_model_close" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
				<div class="modal-body modal-body-secondery">
					<h6 class="modal-body-title">Interest</h6>
					<div class="modal-body-card">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label for="intrested_product" class="form-label main-label">Int Product</label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main" id="intrested_product" name="intrested_product" data-live-search="true" required="">
									<option class="dropdown-item" value="">Select Int Product</option>
									<?php
									if (isset($admin_product)) {
										foreach ($admin_product as $pr_key => $pr_value) {
									?>
											<option class="dropdown-item" value="<?php echo $pr_value['id']; ?>"><?php echo $pr_value['product_name']; ?></option>
									<?php
										}
									}
									?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label for="intrested_site" class="form-label main-label">Subscription</label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main subscription" id="subscription" name="subscription" data-live-search="true" required="">
									<option value="" data-plan_price="0">Select Product Plan</option>
									<?php
									$subscription_data = "SELECT * FROM admin_subscription_master";
									$result = $this->db->query($subscription_data);
									$result = $result->getResultArray();
									foreach ($result as $key => $value) {
										echo '<option value="' . $value['id'] . '" data-plan_price="' . $value['plan_price'] . '" data-add_on_user="' . $value['user'] . '">' . $value['plan_name'] . '</option>';
									}
									?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label for="budget" class="form-label main-label">Budget</label>
							<div class="main-selectpicker">
								<select id="budget" name="budget" class="selectpicker form-control form-main" data-live-search="true" required="">
									<option value="">Select budget</option>
									<?php
									for ($i = 1; $i <= 100; $i++) {
										echo '<option class="dropdown-item" value="' . $i . '">' . $i . '</option>';
									}
									?>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label for="purpose_buy" class="form-label main-label">Buying As</label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control" id="buying_as" name="buying_as" data-live-search="true" required="">
									<option value="">Select Buying As</option>
									<option value="Builder">Builder</option>
									<option value="Agency">Agency</option>
									<option value="Broker">Broker</option>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label for="approx_buy" class="form-label main-label">Apx Buying Time</label>
							<div class="main-selectpicker">
								<!-- set dropdown here -->
								<select id="approx_buy" name="approx_buy" class="selectpicker form-control form-main" data-live-search="true" required>
									<i class="fa-solid fa-caret-down"></i>
									<option class="dropdown-item" value="">Select Apx Time</option>
									<option class="dropdown-item" value="2-3 days">2-3 Days</option>
									<option class="dropdown-item" value="week">Week</option>
									<option class="dropdown-item" value="10-15_days">10-15 Days</option>
									<option class="dropdown-item" value="1-month">1 Month</option>
									<option class="dropdown-item" value="2-month">2 Month</option>
									<option class="dropdown-item" value="3-month">3 Month</option>
									<option class="dropdown-item" value="4-month">4 Month</option>
									<option class="dropdown-item" value="5-month">5 Month</option>
									<option class="dropdown-item" value="6-month">6 Month</option>
									<option class="dropdown-item" value="7-month">7 Month</option>
									<option class="dropdown-item" value="8-month">8 Month</option>
									<option class="dropdown-item" value="9-month">9 Month</option>
									<option class="dropdown-item" value="10-month">10 Month</option>
									<option class="dropdown-item" value="11-month">11 Month</option>
									<option class="dropdown-item" value="1-year">1 Year</option>
									<option class="dropdown-item" value="1.5-year">1.5 Year</option>
									<option class="dropdown-item" value="2-year">2 Year</option>
								</select>
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn-primary" id="add_data" data-edit_id>Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="conversion_inquery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="conversion_inquery" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="max-width:1100px;">
		<form method="post" id="booking_form" name="booking_form" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Booking</h5>
					<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
						<i class="bi bi-x-circle"></i>
					</button>
				</div>
				<div class="modal-body modal-body-secondery">
					<h6 class="modal-body-title">Booking Information</h6>
					<div class="modal-body-card">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Party Mobile No:</label>
							<input type="text" class="form-control main-control" id="mobileno" name="mobileno" placeholder="Mobile No" value="" required="" readonly>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Party Name :</label>
							<input type="text" class="form-control main-control" id="partyname" name="partyname" placeholder="Party Name" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Email :</label>
							<input type="text" class="form-control main-control" id="email" name="email" placeholder="Email " value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">House No :</label>
							<input type="text" class="form-control main-control" id="houseno" name="houseno" placeholder="House No" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Society :</label>
							<input type="text" class="form-control main-control" id="society" name="societyname" placeholder="Society Name" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label for="" class="form-label main-label">Area :</label>
							<input type="text" class="form-control main-control" id="area" name="area" placeholder="area" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Land Mark :</label>
							<input type="text" class="form-control main-control" id="landmark" name="landmark" placeholder="Land Mark" value="" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Country :</label>
							<div class="d-flex">
								<select name="code_country" class="countries form-control main-control" id="countryId" data-code_country="">
									<option value="">Select Country</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">State :</label>
							<div class="d-flex">
								<select name="code_state" class="states form-control main-control" id="stateId">
									<option value="">Select State</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">City :</label>
							<div class="d-flex">
								<select name="code_city" class="cities form-control main-control" id="cityId">
									<option value="">Select City</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Pincode :</label>
							<input type="text" class="form-control main-control" id="pincode" name="pincode" placeholder="Pincode" required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Aadhar Card Number :</label>
							<input type="text" class="form-control main-control addharno_valid_formate" minlength="14" maxlength="14" id="aadharno" name="aadharno" placeholder="Aadhar No." required="">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Pancard Number :</label>
							<input type="text" class="form-control main-control pan_number_valid_formate" id="pancard_no" name="pancard_no" placeholder="Pan Card Number" required="">
						</div>
					</div>
					<h6 class="modal-body-title">Product Details</h6>
					<div class="modal-body-card">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="form-label main-label">Product Name :</label>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main" id="product_name" name="product_name" data-live-search="true" required="">
									<option value="">Select Product Name</option>
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
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main" id="product_plan" name="product_plan" data-live-search="true" required="">
									<option value="" data-plan_price="0">Select Product Plan</option>
									<?php
									$subscription_data = "SELECT * FROM admin_subscription_master";
									$result = $this->db->query($subscription_data);
									$result = $result->getResultArray();
									foreach ($result as $key => $value) {
										echo '<option value="' . $value['id'] . '" data-plan_price="' . $value['plan_price'] . '" data-add_on_user="' . $value['user'] . '">' . $value['plan_name'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 position-relative">
							<label class="main-label">username</label>
							<input type="text" class="form-control main-control pan_number_valid_formate" id="username" name="username" required="">
							<span id="msga"></span>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label class="main-label">Password</label>
							<div class="position-relative">
								<input type="password" class="form-control main-control" name="password" id="password" required="">
							</div>
							<div id="strengthMessage"></div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<label for="confirmpassword" class="main-label">Confirm
								Password</label>
							<div class="position-relative">
								<input type="password" class="form-control main-control" id="confirmpassword" name="password" required="">
							</div>
							<span class="divDoPasswordsMatch"></span>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="position-relative">
								<input type="hidden" class="form-control main-control" name="price" id="price" value="" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="position-relative">
								<input type="hidden" class="form-control main-control" name="gst" id="gst" value="" required="">
							</div>
						</div>
						<div class="col-12 d-flex flex-wrap mt-3 justify-content-end">
							<div id="include_id" class="col-lg-3 col-md-4 col-sm-6 col-12">
								<label for="p_shortname" class="form-label main-label">Total Price :</label>
								<input type="text" class="form-control main-control" id="total_price" name="total_price" maxlength="12" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Total Price" value="" readonly required="required">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer sub-btn-hide">
					<button type="button" class="btn-secondary booking_add_data" name="booking_add_data" id="booking_add_data" data-booking_insert_id data-booking_owner_id>submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="qry_model_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Edit Query</h1>
				<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="qry_insert" method="POST" name="qry_insert" action="#" id="qry_insert2">
					<div class="mb-3">
						<input type="text" class="form-control main-control" required id="full_name" placeholder="Name*">
					</div>
					<div class="mb-3">
						<input type="number" class="form-control main-control" required id="mobileno" minlength="9" maxlength="10" placeholder="Mobile Number*">
					</div>
					<div class="mb-3">
						<input type="email" class="form-control main-control" required id="email" placeholder="Email">
					</div>
					<div class="mb-3">
						<textarea class="form-control main-control" id="message" required rows="3" placeholder="Message*"></textarea>
					</div>
				</form>
				<div class="col-12 text-center mt-3">
					<button type="button" class="btn-primary Update_qry" data-edit_id="">Update</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="quotation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5 TargetGymQuatation" id="exampleModalLabel">Quotation</h1>
				<button type="button" class="modal-close-btn" id="modal-close-btn-quatation" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?php
			// if (isset($admin_subscription_master)) {
			// 	foreach ($admin_subscription_master as $type_key => $type_value) {
			// 		echo '';
			// 	}
			// }
			?>
			<div class="modal-body">
				<div class="d-flex core_detail flex-wrap" id="addPaln">

				</div>
				<div class="quotation_advance_main" style="display: none;">
					<div class="modal-body-card mb-3 p-2">
						<div class="col-12 p-0 p-2 border-bottom">
							<div class="d-flex justify-content-between align-items-center p-1 dataaa">
								<h6 class="text-nowrap">Addon Staff:</h6>
								<div class="value-button decrease bg-primary rounded-2 cursor-pointer d-flex align-items-center justify-content-center bg-main-gradiant shadow p-2 shadow" id="decrease" value="Decrease Value">
									<i class="bi bi-dash text-white d-flex"></i>
								</div>
								<input type="number" id="ad_number" value="0" class="text-center border numbers rounded-2 shadow border-0 py-2 bg-white" min="0" readonly>
								<div class="value-button increase bg-primary rounded-2 cursor-pointer d-flex align-items-center justify-content-center bg-main-gradiant shadow p-2 shadow" id="increase" value="Increase Value">
									<i class="bi bi-plus text-white d-flex"></i>
								</div>
							</div>
							<div class="d-flex justify-content-between align-items-center p-1">
								<h6>Addon staff Price :</h6>
								<p class="user_price_total"></p>
								<p class="addon_staff">₹ 365</p>
							</div>
						</div>
						<div class="col-12 p-0 p-2 border-bottom">
							<div class="d-flex justify-content-between align-items-center p-1">
								<h6>Sub total :</h6>
								<p class="subtotal"></p>
							</div>
							<div class="d-flex justify-content-between align-items-center p-1">
								<h6>GST (18%) :</h6>
								<p class="gst_price" data-gst=""></p>
							</div>
						</div>
						<div class="col-12 p-0 p-2">
							<div class="d-flex justify-content-between align-items-center p-1">
								<h6>Total Payment :</h6>
								<p class="grant_total text-success fw-semibold"></p>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-between flex-wrap">
					<div class="col-12 px-2 col-md-5">
						<label class="main-label">User Name</label>
						<div class="d-flex input-group">
							<input type="text" class="form-control main-control user_name_q" id="" name="" value="" placeholder="User Name">
						</div>
						<label class="main-label">Discount Amount</label>
						<div class="d-flex input-group">
							<input type="number" step="0.0000000001" class="form-control main-control discount_quatation" id="" name="" value="0" placeholder="Discount Amount"><span class="input-group-text" id="basic-addon2">₹</span>
						</div>
					</div>
					<div class="col-12 px-2 col-md-5">
						<label class="main-label">Email</label>
						<div class="d-flex input-group">
							<input type="email" class="form-control main-control user_email_q" inquiry_email="" id="" name="" value="" placeholder="Enter Email">
						</div>
						<label class="main-label">WhatApp</label>
						<div class="d-flex input-group">
							<input type="number" step="0.0000000001" class="form-control main-control inquiry_pno_div" id="" name="" value="" placeholder="Enter WhatApp Number">
						</div>
					</div>
					<div class="col-12 px-2 col-md-5">
						<div class="custom_Date_class">
							<label for="offer_name" class="form-label main-label">Offer Name </label>
							<input type="text" class="offer_name  form-control main-control " placeholder="Offer Name" id="offer_name" name="offer_name" value="" />
						</div>
						<div class="valid-feedback">
							Looks good!
						</div>
					</div>
					<div class="col-12 px-2 col-md-5">
						<div class="custom_Date_class">
							<label for="quotation_validity" class="form-label main-label">Quotation Validity </label>
							<input type="text" class="quotation_validity  form-control main-control " placeholder="DD/MM/YYYY " id="quotation_validity" name="quotation_validity" value="" />
						</div>
						<div class="valid-feedback">
							Looks good!
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn-primary" data-bs-dismiss="modal">Close</button> -->
				<button type="button" class="btn-primary generate_pdf_button" DataConfirmationId="" data_user_table="" data_table_id="" data_table_user_name="">Generate Quotation</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade hidemodal " id="sms_send" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form action="post" class="w-100 hidemodal" name="sms_send_form">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title">Templates</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="d-flex">
						<div>
							<ul class="nav nav-pills navtab_primary_sm mb-2" id="pills-tab" role="tablist">
								<li class="nav-item " role="presentation">
									<button class="nav-link btn nav_btn active" data-sms_check_id="3" id="customer_alert_tab" data-bs-toggle="pill" data-bs-target="#customer_alert" data-table="emailtemplate" type="button" role="tab" aria-controls="customer_alert" aria-selected="false" tabindex="-1">Email </button>
								</li>
								<li class="nav-item" role="presentation">
									<button class="nav-link btn nav_btn" data-sms_check_id="3" id="whatsapp_template_tab" data-bs-toggle="pill" data-bs-target="#whatsapp_template" data-table="emailtemplate" type="button" role="tab" aria-controls="customer_alert" aria-selected="false" tabindex="-1">Whatsapp </button>
								</li>
							</ul>
						</div>

						<!-- <div>
							<ul class="nav nav-pills navtab_primary_sm mb-2" id="pills-tab" role="tablist">
								
							</ul>
						</div> -->
					</div>

					<div class="tab-content p-0 active show" id="pills-tabContentS">
						<!-- <div class="tab-pane fade show active -whatapp" id="user_alert" role="tabpanel" aria-labelledby="user_alert_tab" tabindex="0">
							<h6 class="mt-3 mb-2 fs-6">Whatsapp Template</h6>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main main-control" name="whatsapp_template" id="whatsapp_template" data-live-search="true" tabindex="-98">
									<option value="">Select Tamplete</option>
									<?php
									if (isset($leadmgt_whatsapp_template)) {
										foreach ($leadmgt_whatsapp_template as $area_key => $type_value) {
											echo '<option value="' . $type_value["id"] . '">' . '  ' . $type_value["title"] . '</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="tab-pane fade" id="inquiry_alert" role="tabpanel" aria-labelledby="inquiry_alert_tab" tabindex="0">
							<h6 class="mt-3 mb-2 fs-6">SMS Template</h6>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main main-control" name="sms_template" id="sms_template" data-live-search="true" tabindex="-98">
									<option value="">Select Tamplete</option>
									<?php
									if (isset($leadmgt_smstemplate)) {
										foreach ($leadmgt_smstemplate as $area_key => $type_value) {
											echo '<option value="' . $type_value["id"] . '">' . '  ' . $type_value["title"] . '</option>';
										}
									}
									?>
								</select>
							</div>
						</div> -->
						<div class="tab-pane fade show active" id="customer_alert" role="tabpanel" aria-labelledby="customer_alert_tab" tabindex="0">
							<h6 class="mt-3 mb-2 fs-6">Email Template</h6>
							<div class="main-selectpicker">
								<select class="selectpicker form-control form-main main-control" name="email_template" id="email_template" data-live-search="true" tabindex="-98">
									<option value="">Select Tamplete</option>
									<?php
									if (isset($admin_emailtemplate)) {
										foreach ($admin_emailtemplate as $area_key => $type_value) {
											echo '<option value="' . $type_value["id"] . '">' . '  ' . $type_value["title"] . '</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary message_send_customer">Send</button>
							</div>
						</div>

						<div class="tab-pane fade show" id="whatsapp_template" role="tabpanel" aria-labelledby="whatsapp_template_tab" tabindex="0">
							<h6 class="mt-3 mb-2 fs-6">Whatsapp Template</h6>
							<div class="main-selectpicker">

								<select class="form-control main-control header_div" id="header" name="header" value="" ng-model="selectedHeader" ng-change="handleHeaderChange()" required>
									<option value="" selected disabled>Please select template</option>
								</select>

							</div>
							<div class="col-12 mb-3 mt-2">
								<select class="form-control form-main main-controll language_div" disabled id="language" name="language" required>
									<option class="fs-12" label="Please select your language" value="" ></option>
									<option class="fs-12 ng-binding ng-scope" value="en_US" ng-repeat="lang in template_lang">English US (en_US)</option>
									<option class="fs-12 ng-binding ng-scope" value="en" ng-repeat="lang in template_lang">English (en)</option>

									<option class="fs-12 ng-binding ng-scope" value="af" ng-repeat="lang in template_lang">Afrikaans</option>
									<option class="fs-12 ng-binding ng-scope" value="sq" ng-repeat="lang in template_lang">Albanian</option>
									<option class="fs-12 ng-binding ng-scope" value="ar" ng-repeat="lang in template_lang">Arabic</option>
									<option class="fs-12 ng-binding ng-scope" value="az" ng-repeat="lang in template_lang">Azerbaijani</option>
									<option class="fs-12 ng-binding ng-scope" value="bn" ng-repeat="lang in template_lang">Bengali</option>
									<option class="fs-12 ng-binding ng-scope" value="bg" ng-repeat="lang in template_lang">Bulgarian</option>
									<option class="fs-12 ng-binding ng-scope" value="ca" ng-repeat="lang in template_lang">Catalan</option>
									<option class="fs-12 ng-binding ng-scope" value="zh_CN" ng-repeat="lang in template_lang">Chinese (CHN)</option>
									<option class="fs-12 ng-binding ng-scope" value="zh_HK" ng-repeat="lang in template_lang">Chinese (HKG)</option>
									<option class="fs-12 ng-binding ng-scope" value="zh_TW" ng-repeat="lang in template_lang">Chinese (TAI)</option>
									<option class="fs-12 ng-binding ng-scope" value="hr" ng-repeat="lang in template_lang">Croatian</option>
									<option class="fs-12 ng-binding ng-scope" value="cs" ng-repeat="lang in template_lang">Czech</option>
									<option class="fs-12 ng-binding ng-scope" value="da" ng-repeat="lang in template_lang">Danish</option>
									<option class="fs-12 ng-binding ng-scope" value="nl" ng-repeat="lang in template_lang">Dutch</option>
									<option class="fs-12 ng-binding ng-scope" value="en_GB" ng-repeat="lang in template_lang">English (UK)</option>
									<option class="fs-12 ng-binding ng-scope" value="et" ng-repeat="lang in template_lang">Estonian</option>
									<option class="fs-12 ng-binding ng-scope" value="fil" ng-repeat="lang in template_lang">Filipino</option>
									<option class="fs-12 ng-binding ng-scope" value="fi" ng-repeat="lang in template_lang">Finnish</option>
									<option class="fs-12 ng-binding ng-scope" value="fr" ng-repeat="lang in template_lang">French</option>
									<option class="fs-12 ng-binding ng-scope" value="de" ng-repeat="lang in template_lang">German</option>
									<option class="fs-12 ng-binding ng-scope" value="el" ng-repeat="lang in template_lang">Greek</option>
									<option class="fs-12 ng-binding ng-scope" value="gu" ng-repeat="lang in template_lang">Gujarati</option>
									<option class="fs-12 ng-binding ng-scope" value="ha" ng-repeat="lang in template_lang">Hausa</option>
									<option class="fs-12 ng-binding ng-scope" value="he" ng-repeat="lang in template_lang">Hebrew</option>
									<option class="fs-12 ng-binding ng-scope" value="hi" ng-repeat="lang in template_lang">Hindi</option>
									<option class="fs-12 ng-binding ng-scope" value="hu" ng-repeat="lang in template_lang">Hungarian</option>
									<option class="fs-12 ng-binding ng-scope" value="id" ng-repeat="lang in template_lang">Indonesian</option>
									<option class="fs-12 ng-binding ng-scope" value="ga" ng-repeat="lang in template_lang">Irish</option>
									<option class="fs-12 ng-binding ng-scope" value="it" ng-repeat="lang in template_lang">Italian</option>
									<option class="fs-12 ng-binding ng-scope" value="ja" ng-repeat="lang in template_lang">Japanese</option>
									<option class="fs-12 ng-binding ng-scope" value="kn" ng-repeat="lang in template_lang">Kannada</option>
									<option class="fs-12 ng-binding ng-scope" value="kk" ng-repeat="lang in template_lang">Kazakh</option>
									<option class="fs-12 ng-binding ng-scope" value="ko" ng-repeat="lang in template_lang">Korean</option>
									<option class="fs-12 ng-binding ng-scope" value="lo" ng-repeat="lang in template_lang">Lao</option>
									<option class="fs-12 ng-binding ng-scope" value="lv" ng-repeat="lang in template_lang">Latvian</option>
									<option class="fs-12 ng-binding ng-scope" value="lt" ng-repeat="lang in template_lang">Lithuanian</option>
									<option class="fs-12 ng-binding ng-scope" value="mk" ng-repeat="lang in template_lang">Macedonian</option>
									<option class="fs-12 ng-binding ng-scope" value="ms" ng-repeat="lang in template_lang">Malay</option>
									<option class="fs-12 ng-binding ng-scope" value="ml" ng-repeat="lang in template_lang">Malayalam</option>
									<option class="fs-12 ng-binding ng-scope" value="mr" ng-repeat="lang in template_lang">Marathi</option>
									<option class="fs-12 ng-binding ng-scope" value="nb" ng-repeat="lang in template_lang">Norwegian</option>
									<option class="fs-12 ng-binding ng-scope" value="fa" ng-repeat="lang in template_lang">Persian</option>
									<option class="fs-12 ng-binding ng-scope" value="pl" ng-repeat="lang in template_lang">Polish</option>
									<option class="fs-12 ng-binding ng-scope" value="pt_BR" ng-repeat="lang in template_lang">Portuguese (BR)</option>
									<option class="fs-12 ng-binding ng-scope" value="pt_PT" ng-repeat="lang in template_lang">Portuguese (POR)</option>
									<option class="fs-12 ng-binding ng-scope" value="pa" ng-repeat="lang in template_lang">Punjabi</option>
									<option class="fs-12 ng-binding ng-scope" value="ro" ng-repeat="lang in template_lang">Romanian</option>
									<option class="fs-12 ng-binding ng-scope" value="ru" ng-repeat="lang in template_lang">Russian</option>
									<option class="fs-12 ng-binding ng-scope" value="sr" ng-repeat="lang in template_lang">Serbian</option>
									<option class="fs-12 ng-binding ng-scope" value="sk" ng-repeat="lang in template_lang">Slovak</option>
									<option class="fs-12 ng-binding ng-scope" value="sl" ng-repeat="lang in template_lang">Slovenian</option>
									<option class="fs-12 ng-binding ng-scope" value="es" ng-repeat="lang in template_lang">Spanish</option>
									<option class="fs-12 ng-binding ng-scope" value="es_AR" ng-repeat="lang in template_lang">Spanish (ARG)</option>
									<option class="fs-12 ng-binding ng-scope" value="es_ES" ng-repeat="lang in template_lang">Spanish (SPA)</option>
									<option class="fs-12 ng-binding ng-scope" value="es_MX" ng-repeat="lang in template_lang">Spanish (MEX)</option>
									<option class="fs-12 ng-binding ng-scope" value="sw" ng-repeat="lang in template_lang">Swahili</option>
									<option class="fs-12 ng-binding ng-scope" value="sv" ng-repeat="lang in template_lang">Swedish</option>
									<option class="fs-12 ng-binding ng-scope" value="ta" ng-repeat="lang in template_lang">Tamil</option>
									<option class="fs-12 ng-binding ng-scope" value="te" ng-repeat="lang in template_lang">Telugu</option>
									<option class="fs-12 ng-binding ng-scope" value="th" ng-repeat="lang in template_lang">Thai</option>
									<option class="fs-12 ng-binding ng-scope" value="tr" ng-repeat="lang in template_lang">Turkish</option>
									<option class="fs-12 ng-binding ng-scope" value="uk" ng-repeat="lang in template_lang">Ukrainian</option>
									<option class="fs-12 ng-binding ng-scope" value="ur" ng-repeat="lang in template_lang">Urdu</option>
									<option class="fs-12 ng-binding ng-scope" value="uz" ng-repeat="lang in template_lang">Uzbek</option>
									<option class="fs-12 ng-binding ng-scope" value="vi" ng-repeat="lang in template_lang">Vietnamese</option>
									<option class="fs-12 ng-binding ng-scope" value="zu" ng-repeat="lang in template_lang">Zulu</option>
								</select>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary template_send">Send</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<!-- <style>
	.nadkjgshkjdfh {
	display: none;
}
</style> -->
<script>
	function card_data_task_card() {
		$(".card_data .task-card").each(function() {
			var main_card_width = $(this).width();
			var task_header_dot = $(this).find(".task-header-dot").width();
			var task_header_id = $(this).find(".task-header-id").width();
			var task_header_main_call = $(this).find(".task-header-main-call").width();
			var main_task_name_width = main_card_width - (task_header_main_call - task_header_id - task_header_dot) - (20 - 16);
			$(this).find(".main_task_name_width").width(main_task_name_width);
		});
	}

	function clock_view_task_card() {
		$(".clockDiv_main .task-card").each(function() {
			var main_card_width = $(this).width();
			var task_header_dot = $(this).find(".task-header-dot-outer").width();
			var task_header_id = $(this).find(".task-header-id").width();
			var main_task_time_width = $(this).find(".main_task_time_width").width();
			var task_header_main_call = $(this).find(".task-header-main-call").width();
			var main_task_name_width_ps = parseInt($(this).find(".main_task_name_width").css("padding-left"));
			var main_task_name_width_pe = parseInt($(this).find(".main_task_name_width").css("padding-right"));
			var task_card_header_ps = parseInt($(this).find(".task-card-header").css("padding-left"));
			var task_card_header_pe = parseInt($(this).find(".task-card-header").css("padding-right"));
			var task_header_id_ps = parseInt($(this).find(".task-header-id").css("padding-left"));
			var task_header_id_pe = parseInt($(this).find(".task-header-id").css("padding-right"));
			var main_task_time_width_ps = parseInt($(this).find(".main_task_time_width").css("padding-left"));
			var main_task_time_width_pe = parseInt($(this).find(".main_task_time_width").css("padding-right"));

			var main_task_name_width = main_card_width - ((task_header_main_call + main_task_time_width + task_header_id + task_header_dot) + (main_task_name_width_ps + main_task_name_width_pe + task_card_header_ps + task_card_header_pe + task_header_id_ps + task_header_id_pe + main_task_time_width_ps + main_task_time_width_pe));
			$(this).find(".main_task_name_width").width(main_task_name_width);
		});
	}
	<?php if (isset($_REQUEST['followup']) && $_REQUEST['followup'] == 'today') { ?>
		$('#pills-clockview-tab').trigger('click');
	<?php } ?>

	function quotation_advance_main_check() {
		if ($("#addPaln input").is(":checked")) {
			$(".quotation_advance_main").show();
		} else {
			$(".quotation_advance_main").hide();
		}
	}

	$('body').on('click', '#addPaln label', function() {
		var datacrm = parseInt($(this).find("input").attr("datacrm"));
		console.log(datacrm);
		quotation_advance_main_check();
		if (datacrm == 1) {
			$(".addon_staff").text("₹ 1000");
		} else if (datacrm == 2) {
			$(".addon_staff").text("");
			$(".quotation_advance_main").hide();
		} else if (datacrm == 3) {
			$(".addon_staff").text("₹ 365");
		}
	});

	$('body').on('click', '#inquiry_all_status_update .modal-close-btn', function() {
		$(".intrest-card-show").hide();
	});
	$('body').on('click', '#increase', function() {
		var input_value = $("#ad_number").val();
		var value_ad = $(".addon_staff").text();
		var value_without_currency = value_ad.replace('₹', '');

		$("#ad_number").val((parseInt(input_value) + 1));
		var value = $("#ad_number").val();
		var vall = value;

		increse_dicre(vall, value_without_currency);
	});
	$('body').on('click', '#decrease', function() {
		var input_value_2 = $("#ad_number").val();
		var value_ad = $(".addon_staff").text();
		var value_without_currency = value_ad.replace('₹', '');


		if (input_value_2 > "0") {
			$("#ad_number").val((parseInt(input_value_2) - 1));
		}
		var value = $("#ad_number").val();
		var vall = value;

		increse_dicre(vall, value_without_currency);
	});

	function increse_dicre(staff, price) {
		$subTotal = staff * price;
		$gstamount = ($subTotal * 18) / 100;
		$finalTotal = $subTotal + $gstamount;
		$('.subtotal').html('₹ ' + $subTotal);
		$('.gst_price').html('₹ ' + $gstamount);
		$('.grant_total').html('₹ ' + $finalTotal);
		$('#sub_total').val($subTotal);
		$('#gst_total').val($gstamount);
		$('#final_total').val($finalTotal);
	}

	$('.quatation_set_html').hide();

	function myFunction() {
		$('.next-followup').bootstrapMaterialDatePicker({
			minDate: new Date(),
			format: 'DD-MM-YYYY h:mm A',
			cancelText: 'cancel',
			okText: 'ok',
			clearText: 'clear',
		});
	}
	$("body").on('click', '.template_send', function(e) {
		event.preventDefault();
		var checkbox = $('.table_list_check:checked');
		var checkbox_value = [];
		$(checkbox).each(function() {
			checkbox_value.push($(this).attr("value"));
		});

		console.log(checkbox_value);
		var header = $('.header_div').val();
        var language = $('.language_div').val();
		var form = $("form[name='sms_send_form']")[0];

		var formdata = new FormData(form);
		formdata.append('customer_id', checkbox_value);
		formdata.append('language', language);
		formdata.append('header', header);

		
		if(header != "" && language !=""){
		$.ajax({
			method: "post",
			url: "<?= site_url('bulkwhatsapp_template_sent'); ?>",
			data: formdata,
			processData: false,
			contentType: false,
			success: function(res) {
				var response = JSON.parse(res);
				$('.loader').hide();
				if (res == '1') {
				iziToast.success({
					title: "Message sent successfully"
				});
				$('.hidemodal').modal('hide');

			} else {
				iziToast.error({
					title: 'Something went wrong!'
				});
				$('.hidemodal').modal('hide');

			}

				
			},
		});
	}else{
		$("#sms_send").addClass("was-validated");

		
	}

	});


	$("body").on('click', '.message_send_customer', function(e) {
		event.preventDefault();
		var checkbox = $('.table_list_check:checked');
		var checkbox_value = [];
		$(checkbox).each(function() {
			checkbox_value.push($(this).attr("data-sms_id"));
		});
		console.log(checkbox_value);
		// var tab_sms_id = $("#sms_send #pills-tab .nav-link.active").attr("data-sms_check_id");
		var sms_template = $("#sms_send #sms_template").val();
		var email_template = $("#sms_send #email_template").val();
		var whatsapp_template = $("#sms_send #whatsapp_template").val();

		var form = $("form[name='sms_send_form']")[0];
		var formdata = new FormData(form);
		formdata.append('customer_id', checkbox_value);
		// formdata.append('tab_sms_id', tab_sms_id);




		$.ajax({
			method: "post",
			url: "<?= site_url('allinqsmssend'); ?>",
			data: formdata,
			processData: false,
			contentType: false,
			success: function(res) {
				var response = JSON.parse(res);

				// alert("sucess");
				$('.loader').hide();
				//   $('.selectpicker').selectpicker('refresh');
				//   $('form[name="product_purchase_form"]')[0].reset();
				//   $("form[name='product_purchase_form']").removeClass("was-validated");
				//   $(".modal-close-btn").trigger("click");
				//   list_data();
				//   $('.selectpicker').selectpicker('refresh');
				//   iziToast.success({
				//      title: response.message
				//   });
				//   var pdfUrl = $(this).attr('href');

				//   var pathWithQuotes = '' + response.file_name + '';
				//   var path = pathWithQuotes.replace(/"/g, '');


				//   setTimeout(() => {
				//      window.open(path, '_blank');
				//   }, 1500);
				// var pdfUrl = $(this).attr('href');
				// setTimeout(() => {
				//     window.open(response.file_name, '_blank');
				// }, 1500);


			},
		});
	});
	$('body').on('click', '.generate_pdf_button', function() {
		var edit_id = $(this).attr('data_table_id');
		var discount_amount = $('.discount_quatation').val();
		var url = 'convertToPdf';
		var crm = '';
		if ($('input[name="quation_name"]:checked').length > 0) {
			var checkbox_val = $('input[name="quation_name"]:checked').val();
		} else {
			var checkbox_val = '';
		}
		var arr = [];
		$.each($("input[name='quation_name']:checked"), function() {
			arr.push($(this).val());

			crm = $(this).attr('DataCrm');
		});

		if (crm == "2") {
			url = 'GymQuatationCard';
		}
		if (crm == "3") {
			url = 'leadmgtCard';
		}

		// console.log(crm);
		var user_email_q = $('.user_email_q').val();
		var user_name = $('.user_name_q').val();
		var addon_staff = $('.addon_staff').text();
		var offer_name = $('.offer_name').val();
		var subtotal = $('.subtotal').text();
		var gst_price = $('.gst_price').text();
		var grant_total = $('.grant_total ').text();
		var grant_total = $('.grant_total ').text();
		var ad_number = $('#ad_number ').val();
		var quotation_validity = $('#quotation_validity').val();
		var check_count0 = $('input[name="quation_name"]:checked').length;
		var check_count = check_count0 + 1;
		if (checkbox_val != '') {
			$('.loader').show();
			$.ajax({
				method: "post",
				url: url,
				data: {
					'table': 'admin_subscription_master',
					'edit_id': edit_id,
					'checkbox_val': checkbox_val,
					'data_user_table': 'all_inquiry',
					'all_ckeck': arr,
					user_name: user_name,
					check_count: check_count,
					discount_amount: discount_amount,
					user_email_q: user_email_q,
					offer_name: offer_name,
					addon_staff: addon_staff,
					subtotal: subtotal,
					gst_price: gst_price,
					grant_total: grant_total,
					ad_number: ad_number,
					quotation_validity: quotation_validity,
				},
				success: function(res) {
					var response = JSON.parse(res);
					$("#modal-close-btn-quatation").trigger("click");
					$('.loader').hide();
					var pdfUrl = $(this).attr('href');
					setTimeout(() => {
						window.open(response.file_name, '_blank');
					}, 1500);
					$("#quotation #ad_number").val(0);
					$("#quotation .subtotal").text("");
					$("#quotation .gst_price").text("");
					$("#quotation .grant_total").text("");
				}
			});
		}

		if (checkbox_val != '') {
			$('.loader').show();
			$.ajax({
				method: "post",
				url: url,
				data: {
					'table': 'admin_subscription_master',
					'edit_id': edit_id,
					'checkbox_val': checkbox_val,
					'data_user_table': 'all_inquiry',
					'all_ckeck': arr,
					user_name: user_name,
					check_count: check_count,
					discount_amount: discount_amount,
					user_email_q: user_email_q
				},
				success: function(res) {
					var response = JSON.parse(res);
					$("#modal-close-btn-quatation").trigger("click");
					$('.loader').hide();
					var pdfUrl = $(this).attr('href');
					setTimeout(() => {
						window.open(response.file_name, '_blank');
					}, 1500);
				}
			});
		}
	});

	$(document).ready(function() {
		$('body').on('change', '.mobileno , .altmobileno ', function() {
			var val = $(this).val();
			if (val.length >= 10 && val.length <= 12) {
				$('.number-error').html('');
				$(this).closest(".col-lg-3").find('.number-error').html('');
				// $('.number-error').css('color','green');  
			} else {
				// $('.number-error').html('');
				$('.number-error').css('color', 'red');
				$(this).closest(".col-lg-3").find('.number-error').html('<p>Pleade Enter Valid Number</p>');
			}
		});
		$('body').on('change', '.email', function() {
			var val = $(this).val();
			var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
			if (emailRegex.test(val)) {
				$('.email-error').html('');
				// $('.number-error').css('color','green');  
			} else {
				$('.email-error').html('<p>Enter Valid Email</p>');
				$('.email-error').css('color', 'red');
			}
		});
		//0883
		function increse_dicre() {
			var number_2 = $('#number').val();
			var plan_price = $('input[name=plan]:checked').attr("data-price");
			var plan_name = $('input[name=plan]:checked').attr("data-plan-name");
			var user_price = $('input[name=plan]:checked').attr("data-user");
			var staff_price = number_2 * 1000;
			var formatted_price = staff_price.toFixed(2);
			$('.staff-price').text(formatted_price);
			var price_total = $(".price_total").text(plan_price);
			var user_price_total = $(".user_price_total").text(formatted_price);
			var user_val = (parseInt(user_price) + parseInt(number_2));
			var user_valss = $(".user_valid").attr("data-user_valid", user_val);
			var planval = $('input[name=plan]:checked').val();
			var plan_name = $(".plan_name").text(plan_name);
			var price = plan_price;
			var percentage = 18;
			var Gst_result = (parseInt(price) + parseInt(formatted_price)) * (percentage / 100);
			var user_price_total = $(".gst_price").text(Gst_result);
			var total_price = parseInt(plan_price) + parseInt(formatted_price) + parseInt(Gst_result);
			$(".grant_total").text(total_price);
		}
		$(".max-date").bootstrapMaterialDatePicker({
			maxDate: new Date(),
			format: 'MM/DD/YYYY',
			cancelText: 'cancel',
			okText: 'ok',
			clearText: 'clear',
			time: false,
		});
		$('.min-datetime').bootstrapMaterialDatePicker({
			minDate: new Date(),
			time: true,
			format: 'MM/DD/YYYY h:mm A',
			cancelText: 'cancel',
			okText: 'ok',
			clearText: 'clear',
		});
		$(".quotation_validity").bootstrapMaterialDatePicker({
			format: 'DD/MM/YYYY',
			cancelText: 'cancel',
			okText: 'ok',
			clearText: 'clear',
			time: false,
		});
		$("body").on('change', '.select-all-sms', function() {
			checkIfAnyCheckboxChecked();
		});

		function checkIfAnyCheckboxChecked() {
			if ($('.checkbox:checked').length > 0) {
				$('.main-select-section').show();
			} else {
				// alert();
				$('.main-select-section').hide();
			}
		}
		$(".main-select-section").hide();
		var selectAllItems = "#select_all";
		var checkboxItem = ".checkbox";
		$(selectAllItems).click(function() {
			if (this.checked) {
				$(".main-select-section").show();
				$(".main-select-section").toggleClass("order-xl-1");
				$(".file-up-down").toggleClass("order-xl-2");
				$(".navigation").toggleClass("order-xl-3");
				$(checkboxItem).each(function() {
					this.checked = true;
				});
			} else {
				$(".main-select-section").hide();
				$(".main-select-section").removeClass("order-xl-1");
				$(".file-up-down").removeClass("order-xl-2");
				$(".navigation").removeClass("order-xl-3");
				$(checkboxItem).each(function() {
					this.checked = false;
				});
			}
		});

		//set current hour to clock view
		var now = new Date();
		var currentHour = now.getHours();
		var picker = $('#picker');
		var cells = picker.find('.cell');
		cells.removeClass('active');
		cells.each(function() {
			var dataTime = parseInt($(this).find('.cell-content').attr('data-time'));
			if (dataTime === currentHour) {
				$(this).addClass('active');
				return false; // Stop iteration once found
			}
		});

		clockList();

		if ($('.intrest-btn-show').length > 0) {
			$(".intrest-card-show").hide();
			$(".intrest-card-show input").prop('required', false);
			$(".intrest-card-show select").prop('required', false);
		} else {
			$(".intrest-card-show").show();
			$(".intrest-card-show input").prop('required', true);
			$(".intrest-card-show select").prop('required', true);
		}
		$(".intrest-btn-show").click(function(e) {
			e.preventDefault();
			$(".intrest-card-show").slideToggle(100, function() {
				if ($(".intrest-card-show input").prop('required')) {
					$(".intrest-card-show input").prop('required', false);
				} else {
					$(".intrest-card-show input").prop('required', true);
				}
				if ($(".intrest-card-show select").prop('required')) {
					$(".intrest-card-show select").prop('required', false);
				} else {
					$(".intrest-card-show select").prop('required', true);
				}
			});
		});
		$('.add').on('click', function() {
			if ($('.intrest-btn-show').length > 0) {
				$(".intrest-card-show").hide();
				$(".intrest-card-show input").prop('required', false);
				$(".intrest-card-show select").prop('required', false);
			} else {
				$(".intrest-card-show").show();
				$(".intrest-card-show input").prop('required', true);
				$(".intrest-card-show select").prop('required', true);
			}
		});

		function remove_space_add_underscore(string) {
			var trim_value = $.trim(string);
			var undoerscore_value = trim_value.replace(/\s+/g, '_');
			return undoerscore_value;
		}
		$('body').on('change', '.checkbox', function() {
			// alert();
			var deleteButton = $("#deleted-all");
			// if($(this).is(":checked")){
			checkIfAnyCheckboxChecked();
		});
		checkIfAnyCheckboxChecked();
		$('body').on('change', '#project_length_show', function() {
			var perPageCount = $(this).val();
			// console.log(perPageCount);
			list_data('all_inquiry', '', 1, perPageCount)
		});
		$('body').on('click', '.deleted-all', function() {
			//   alert("hello");
			var project_length_show = $('#project_length_show').val();
			var checkbox = $('.table_list_check:checked');
			if (checkbox.length > 0) {
				var checkbox_value = [];
				$(checkbox).each(function() {
					checkbox_value.push($(this).val());
				});
				// console.log(checkbox_value);
				// die();
				// return 1;
				iziToast.delete({
					message: 'Are You Sure',
					buttons: [
						['<button>delete</button>', function(instance, toast) {
							$.ajax({
								url: "<?= site_url('delete_all_inq'); ?>",
								method: "post",
								data: {
									action: 'delete',
									checkbox_value: checkbox_value,
									table: 'all_inquiry',
								},
								success: function(data) {
									//  console.log(data);
									$(checkbox).closest("tr").fadeOut();
									// $('.removeRow').fadeOut(1500);
									$('.list_count').text('');
									list_data('all_inquiry', '', '', project_length_show);
									iziToast.error({
										title: 'Delete Successfully'
									});
								}
							});
						}, true], // true to focus
						['<button>Close</button>', function(instance, toast) {
							instance.hide({
								transitionOut: 'fadeOutUp',
								onClosing: function(instance, toast, closedBy) {
									console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
								}
							}, toast, 'buttonName');
						}]
					],
					onOpening: function(instance, toast) {
						console.info('callback abriu!');
					},
					onClosing: function(instance, toast, closedBy) {
						console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
					}
				});
			} else {
				alert('Select atleast one records');
			}
		});
		$(".date").bootstrapMaterialDatePicker({
			format: 'MM/DD/YYYY',
			cancelText: 'cancel',
			okText: 'ok',
			clearText: 'clear',
			time: false,
		});
		$('.next-followup').bootstrapMaterialDatePicker({
			minDate: moment().hour(0),
			format: 'DD-MM-YYYY h:mm A',
			cancelText: 'cancel',
			okText: 'ok',
			clearText: 'clear',
		});
		$('body').on('click', '.nav-item button', function(e) {
			var perPageCount = $('#perPageCount').val();
			$(".nav-item button").removeClass("active");
			$(this).addClass("active");
			///console.log("f545845445");
			//alert("hello");
			var inquiry_status_type = $(this).attr('data-inquiry');
			// 	//console.log(inquiry_status_type);
			$('.inq_pagination').twbsPagination('destroy');
			list_data('all_inquiry', inquiry_status_type, 1, perPageCount);
		});
		$(function() {
			$('#eye').click(function() {
				if ($(this).hasClass('fi-rr-eye-crossed')) {
					$(this).removeClass('fi-rr-eye-crossed');
					$(this).addClass('fi-rr-eye');
					$('#password').attr('type', 'text');
				} else {
					$(this).removeClass('fi-rr-eye');
					$(this).addClass('fi-rr-eye-crossed');
					$('#password').attr('type', 'password');
				}
			});
			$('#eye-2').click(function() {
				if ($(this).hasClass('fi-rr-eye-crossed')) {
					$(this).removeClass('fi-rr-eye-crossed');
					$(this).addClass('fi-rr-eye');
					$('#confirmpassword').attr('type', 'text');
				} else {
					$(this).removeClass('fi-rr-eye');
					$(this).addClass('fi-rr-eye-crossed');
					$('#confirmpassword').attr('type', 'password');
				}
			});
		});
		$(function() {
			$('#username').keydown(function(e) {
				if (e.shiftKey || e.ctrlKey || e.altKey) {
					e.preventDefault();
				} else {
					var key = e.keyCode;
					if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90) || (key >= 48 && key <= 57))) {
						e.preventDefault();
					}
				}
			});
		});
		$("#confirmpassword").blur(function() {
			comparePassword($("#password").val(), $("#confirmpassword").val());
		});
		$("#password").blur(function() {
			var password = $(this).val();
			var strength = checkStrength(password);
		});

		function comparePassword(password1, password2) {
			if (password1 != password2) {
				$(".divDoPasswordsMatch").html("Passwords do not match!");
				$(".divDoPasswordsMatch").css("color", "red");
			} else {
				$(".divDoPasswordsMatch").html("");
			}
		}

		function checkStrength(password) {
			var strength = 0
			if (password.length < 6) {
				$('#strengthMessage').removeClass()
				$('#strengthMessage').addClass('Short')
				$('#strengthMessage').text('Too Short')
				$("#confirmpassword").prop('disabled', true)
				$("#repassword").prop('disabled', true)
				return false;
			}
			if (password.length > 7) strength += 1
			// If password contains both lower and uppercase characters, increase strength value.  
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
			// If it has numbers and characters, increase strength value.  
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
			// If it has one special character, increase strength value.  
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
			// If it has two special characters, increase strength value.  
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
			// Calculated strength value, we can return messages  
			// If value is less than 2  
			if (strength < 2) {
				$('#strengthMessage').removeClass()
				$('#strengthMessage').addClass('Weak')
				$('#strengthMessage').text('Please Enter Strong Password')
				$("#confirmpassword").prop('disabled', true)
				return false;
			} else if (strength == 2) {
				$('#strengthMessage').removeClass()
				$('#strengthMessage').addClass('Good')
				$('#strengthMessage').text('Good!!!')
				$("#confirmpassword").removeAttr("disabled")
			} else {
				$('#strengthMessage').removeClass()
				$('#strengthMessage').addClass('Strong')
				$('#strengthMessage').text('Strong!!')
				$("#confirmpassword").removeAttr("disabled")
			}
		}
		$(".interested_entry_form").on('click', '.modal-close-btn', function() {
			$('form[name="interested_form"]')[0].reset();
			$('.selectpicker').selectpicker('refresh');
			$("form[name='interested_form']").removeClass("was-validated");
		});
		$(".inquiry_all_status_update").on('click', '.modal-close-btn', function() {
			$('form[name="inquiry_all_status_update_form"]')[0].reset();
			$('.selectpicker').selectpicker('refresh');
			$("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
			$(".bootstrap-select").removeClass("selectpicker-validation");

			// $(".inquiry_all_status_update").find(".nxtiii").css("display", "block");
			$("form[name='inquiry_all_status_update_form']").removeClass("tag_name");
			$('.number-error').html('');
			$('.email-error').html('');
		});
		$("#username").on("input", function(e) {
			//var userr = $('#Adduser .usernam').attr("data-usernm");
			var username = $(this).val();
			$('#msg').hide();
			if ($('#username').val() == null || $('#username').val() == "") {
				$('#msg').show();
				$("#msg").html("Username is a required field.").css("color", "red");
			} else {
				$.ajax({
					type: 'post',
					url: "<?= site_url('check_username_availabilitys'); ?>",
					data: {
						username: $('#username').val()
					},
					// contentType: 'application/json; charset=utf-8',
					// dataType: 'html',
					// cache: false,
					beforeSend: function(f) {
						$('#msga').show();
						$('#msga').html('Checking...');
					},
					success: function(msg) {
						$('#msga').show();
						$("#msga").html(msg);
					},
					// error: function(jqXHR, textStatus, errorThrown) {
					//      $('#msga').show();
					//      $("#msga").html(textStatus + " " + errorThrown);
					// }
				});
			}
			return false;
		});
		$('body').on('click', '.click_plus', function() {
			$("#inquiry_all_status_update .tag_name").html('Add Inquiry');
		});
		//insert data
		$("button[name='inquiry_all_status_update']").click(function(e) {
			e.preventDefault();
			var mobileno = $("#inquiry_all_status_update_form #mobileno").val();
			var full_name = $("#inquiry_all_status_update_form #full_name").val();
			var altmobileno = $("#inquiry_all_status_update_form #altmobileno").val();
			var area = $("#inquiry_all_status_update_form #area").val();
			var dob = $("#inquiry_all_status_update_form #dob").val();
			var anni_date = $("#inquiry_all_status_update_form #anni_date").val();
			var city = $("#inquiry_all_status_update_form #city").val();
			var email = $("#inquiry_all_status_update_form #email").val();
			var house = $("#inquiry_all_status_update_form #houseno").val();
			var society = $("#inquiry_all_status_update_form #society").val();
			var intrested_product = $("#inquiry_all_status_update_form #intrested_product").val();
			var budget = $("#inquiry_all_status_update_form #budget").val();
			var buying_as = $("#inquiry_all_status_update_form #buying_as").val();
			var subscription = $("#inquiry_all_status_update_form #subscription").val();
			var inquiry_type = $("#inquiry_all_status_update_form #inquiry_type").val();
			var inquiry_source_type = $("#inquiry_all_status_update_form #inquiry_source_type").val();
			var nxt_follow_up = $("#inquiry_all_status_update_form #nxt_follow_up").val();
			var nxt_follow_up_tag = $("#inquiry_all_status_update_form #nxt_follow_up");
			var next_follow_up = timeValidation(nxt_follow_up, nxt_follow_up_tag);
			var approx_buy = $("#inquiry_all_status_update_form #approx_buy");
			var designation = $("#inquiry_all_status_update_form #designation").val();
			var business_name = $("#inquiry_all_status_update_form #business_name").val();


			// var visit_date = $("#inquiry_all_status_update_form #visit_date").val();
			// console.log(visit_date);
			var inquiry_description = $("#inquiry_all_status_update_form #inquiry_description").val();
			var property_type = $("#inquiry_all_status_update_form #property_sub_type").find(':selected').attr("data-property_type");
			var edit_id = $('#inquiry_all_status_update_form #inquiry_all_status_update_btn').attr("data-edit_id");
			var edit_page = $(".inq_pagination").find(".page-item.active .page-link").text();
			// var nxtiii = $('#inquiry_all_status_update .nxtiii').show();
			if (mobileno != "" && designation != "" && business_name != "" && full_name != "" && area != "" && city != "" && intrested_site != "" && budget != "" && inquiry_type != "" && inquiry_source_type != "") {
				var form = $("form[name='inquiry_all_status_update_form']")[0];
				var formdata = new FormData(form);
				formdata.append('table', 'all_inquiry');
				// formdata.append('intrested_area_name', intrested_area_name);
				// formdata.append('intersted_site_name', intersted_site_name);
				// formdata.append('property_type', property_type);
				// formdata.append('visit_date', visit_date);
				var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
				var page_number = $(".inq_pagination").find(".page-item.active .page-link").text();
				var perPageCount = $('#perPageCount').val();
				if (edit_id == '') {
					formdata.append('action', 'insert');
					$('.loader').show();
					$.ajax({
						method: "post",
						url: "<?= site_url('inquiry_insert_data'); ?>",
						data: formdata,
						processData: false,
						contentType: false,
						success: function(res) {
							var response = JSON.parse(res);
							<?php if (isset($_REQUEST["modalopen"]) && $_REQUEST["modalopen"] == 1) { ?>
								$('$inquiry_all_status_update .modal-close-btn').trigger('click');
								<?php } ?>
							if (response.response != "0") {
								
								$('.loader').hide();
								// $("form[name='inquiry_all_status_update_form']")[0].reset();
								$('.modal-close-btn').click(function() {
									$('.selectpicker').selectpicker('refresh');
									$('form[name="inquiry_all_status_update_form"]')[0].reset();
								});
								$("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
								$(".modal-close-btn").trigger("click");
								sweet_edit_sucess(response.message);
								//$('.inq_pagination').twbsPagination('destroy');
								list_data('inquiry_all_status', inquiry_status_type, page_number, perPageCount);
							} else {
								// $("form[name='inquiry_all_status_update_form']")[0].reset();
								$("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
								// $(".modal-close-btn").trigger("click");
								if (response.message == '') {
									response.message = 'Inquiry Not Created Please check It.';
								}
								Swal.fire({
									title: 'Cancelled',
									text: response.message,
									icon: 'error',
								})
								$('.loader').hide();
							}
						},
					});
				} else {
					var formdata = new FormData(form);
					formdata.append('action', 'update');
					formdata.append('edit_id', edit_id);
					formdata.append('table', 'all_inquiry');
					// formdata.append('intrested_area_name', intrested_area_name);
					// formdata.append('intersted_site_name', intersted_site_name);
					// formdata.append('property_type', property_type);
					// formdata.append('visit_date', visit_date);
					var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
					var perPageCount = $('#perPageCount').val();
					$('.loader').show();
					$.ajax({
						method: "post",
						url: "<?= site_url('inquiry_list_updatedata'); ?>",
						data: formdata,
						processData: false,
						contentType: false,
						success: function(res) {
							if (res != "error") {
								$('.loader').hide();
								$("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
								$('.modal-close-btn').click(function() {
									$('form[name="inquiry_all_status_update_form"]')[0].reset();
								});
								$('#inquiry_all_status_update  .inquiry_all_status_update_btn').attr("data-edit_id", '');
								list_data('inquiry_all_status', inquiry_status_type, edit_page, perPageCount);
								$(".modal-close-btn").trigger("click");
								sweet_edit_sucess('Update successfully');
							} else {
								$('.loader').hide();
								Swal.fire({
									title: 'Cancelled',
									text: 'Duplicate Data Not Valid',
									icon: 'error',
								})
							}
						},
						error: function(error) {}
					});
				}
			} else {
				$("form[name='inquiry_all_status_update_form']").addClass("was-validated");
				var form = $("form[name='inquiry_all_status_update_form']");
				$(form).find('.selectpicker').each(function() {
					var selectpicker_valid = 0;
					if ($(this).attr('required') == 'undefined') {
						var selectpicker_valid = 0;
					}
					if ($(this).attr('required') == 'required') {
						var selectpicker_valid = 1;
					}
					if (selectpicker_valid == 1) {
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
			return false;
		});

		function generateCSV(data) {
			// Convert data to CSV format
			// console.log(data);
			// var csvContent = "data:text/csv;charset=utf-8,";
			csvContent = "id, firstname, mobileno\n"; // Replace with your column names
			data.forEach(function(row) {
				var rowData = [row.id, row.firstname, row.mobileno]; // Adjust based on your data structure
				// console.log(row);
				csvContent += rowData.join(",") + "\n";
			});
			var today_date = new Date();
			var year = today_date.getFullYear();
			var month = today_date.getMonth() + 1;
			var day = today_date.getDate();
			var username = '<?= $_SESSION['username'] ?>';
			var file_name = username + "-all-inquery " + day + "-" + month + "-" + year + ".csv";
			var downloadLink = document.createElement("a");
			var fileData = ['\ufeff' + csvContent];
			var blobObject = new Blob(fileData, {
				type: "text/csv;charset=utf-8;"
			});
			var url = URL.createObjectURL(blobObject);
			downloadLink.href = url;
			downloadLink.download = file_name;
			document.body.appendChild(downloadLink);
			downloadLink.click();
			document.body.removeChild(downloadLink);
			// Create a temporary link and initiate the download
			// var encodedUri = encodeURI(csvContent);
			// var link = document.createElement("a");
			// link.setAttribute("href", encodedUri);
			// link.setAttribute("download", file_name);
			// document.body.appendChild(link);
			// link.click();
		}

		$('body').on('click', '#status-main-tab .nav-item button', function(e) {
			var perPageCount = $('#project_length_show').val();
			$("#status-main-tab .nav-item button").removeClass("active");
			$(this).addClass("active");
			var inquiry_status_type = $(this).attr('data-inquiry');
			//console.log(inquiry_status_type);
			$('.inq_pagination').twbsPagination('destroy');
			list_data('all_inquiry', inquiry_status_type, 1, perPageCount);
		});
		<?php if (isset($_REQUEST['followup']) && $_REQUEST['followup'] == "dismissed") { ?>
			//var inquiry_status_type = $(".nav-item button").attr('data-inquiry');
			$('#status-main-tab .nav-item button[data-inquiry = ""]').removeClass('active').hide();
			$('#status-main-tab .nav-item').hide();
			//$('.nav-item button').removeClass('active');
			$('#status-main-tab .nav-item button[data-inquiry = 7]').addClass('active').show();
			$('#status-main-tab .nav-item .active').parent().show();
			list_data(table = 'all_inquiry', datastatus = '7');
		<?php } elseif (isset($_REQUEST['followup']) && $_REQUEST['followup'] == "appointment") { ?>
			// $('.nav-item button').removeClass('active');
			$('#status-main-tab .nav-item').hide();
			$('#status-main-tab .nav-item button[data-inquiry = ""]').removeClass('active').hide();
			$('#status-main-tab .nav-item button[data-inquiry = 3]').addClass('active').show();
			$('#status-main-tab .nav-item .active').parent().show();
			list_data(table = 'all_inquiry', datastatus = '3');
		<?php } elseif (isset($_REQUEST['followup']) && $_REQUEST['followup'] == "cnr") { ?>
			// $('.nav-item button').removeClass('active');
			$('#status-main-tab .nav-item').hide();
			$('#status-main-tab .nav-item button[data-inquiry = ""]').removeClass('active').hide();
			$('#status-main-tab .nav-item button[data-inquiry = 17]').addClass('active').show();
			$('#status-main-tab .nav-item .active').parent().show();
			list_data(table = 'all_inquiry', datastatus = '17');
		<?php } elseif (isset($_REQUEST['followup']) && $_REQUEST['followup'] == "pending") { ?>
			// $('.nav-item button').removeClass('active');
			// var datastatuss = $('#status-main-tab li:first button').attr('data-inquiry');
			// list_data(table = 'all_inquiry', datastatus = datastatuss);
		<?php } elseif (isset($_REQUEST['followup']) && $_REQUEST['followup'] == "today") { ?>
			// var datastatuss = $('#status-main-tab li:first button').attr('data-inquiry');
			// list_data(table = 'all_inquiry', datastatus = datastatuss);
		<?php } else { ?>
			list_data();
		<?php } ?>

		function list_data(table = 'all_inquiry', datastatus = '', pageNumber = 1, perPageCount = 10, ajaxsearch = "", filter = "", formdata = "", action = true) {
			var view_data = 'listview';
			if ($('.presentation-btn').hasClass('active')) {
				view_data = $('.presentation-btn.active').attr('data-presentation_name');
			}
			if (view_data == 'clockview') {
				var followupTime = $('#picker .cell.active .cell-content').attr('data-time');
			}
			if (view_data != 'cardview') {
				perPageCount = $('#project_length_show').val();
			}
			//var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
			var ajaxsearch = $('.inq_search').val();
			//var inquiry_status_type = $('.tab_button button.btn.active').attr('data-inquiry');
			// var perPageCount = $('#perPageCount').val();
			<?php if (isset($_GET['mobileno'])) { ?>
				var mobileno = '<?php echo $_GET['mobileno']; ?>';
			<?php } ?>
			<?php if (isset($_GET['filter_id'])) { ?>
				var filter_id = '<?php echo $_GET['filter_id']; ?>';
			<?php } ?>
			<?php if (isset($_REQUEST['followup'])) { ?>
				var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
			<?php } else { ?>
				var follow_up_day = '';
			<?php } ?>
			if ($.trim($(".filter-show").html()) != '') {
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				formdata.append('follow_up_day', follow_up_day);
				if (action == 'export') {
					formdata.append('action1', 'export');
				}
			}
			if ($.trim($(".filter-show").html()) == '') {
				var data = {
					'table': table,
					'datastatus': datastatus,
					'pageNumber': pageNumber,
					'perPageCount': perPageCount,
					'follow_up_day': follow_up_day,
					'view': view_data,
					<?php if (isset($_GET['mobileno'])) { ?> 'global_search_val': mobileno,
					<?php } ?> 'action': action,
				};
				var processdd = true;
				var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
			} else {
				data_status = $("#f_inquiry_status").val();
				formdata.append('datastatus', data_status);
				formdata.append('datastatus', datastatus);
				formdata.append('pageNumber', pageNumber);
				formdata.append('perPageCount', perPageCount);
				formdata.append('view', view_data);
				//formdata.append( 'follow_up_day', follow_up_day);
				var data = formdata;
				var processdd = false;
				var contentType = false;
			}
			var totalData = [];
			$.ajax({
				datatype: 'json',
				method: "POST",
				url: 'inqr_show_data',
				data: data,
				processData: processdd,
				contentType: contentType,
				success: function(res) {
					var result = JSON.parse(res);
					var template_name = result.Template_name;
					var templatelanguage = result.templatelanguage;


					var selectDropdown = document.getElementById("header");
					selectDropdown.innerHTML = "";
					var defaultOption = document.createElement("option");
					defaultOption.text = "Please select template";
					defaultOption.value = "";
					defaultOption.disabled = true;
					defaultOption.selected = true;
					selectDropdown.add(defaultOption);

					for (var key in template_name) {
						if (template_name.hasOwnProperty(key)) {
							var option = document.createElement("option");
							option.text = template_name[key];
							option.value = template_name[key];
							selectDropdown.add(option);

						}
					}

					$('#header').change(function() {
						var selectDropdown = $(this).val();
						var languageDropdown = templatelanguage[selectDropdown];
						$('.language_div').val(languageDropdown);

					});

					if (result.export_data) {
						totalData = totalData.concat(result.export_data);
						generateCSV(totalData);
					}
					if (result.response == 1) {
						if (result.total_page == 0 || result.total_page == '') {
							total_page = 1;
						} else {
							total_page = result.total_page;
						}
						$('#row_count').html(result.row_count_html);
						if (view_data == 'listview') {
							$('#inqr_show_data_list').html(result.html);
						} else if (view_data == 'cardview') {
							console.log(result.html);
							$('.card_data').html(result.html);
							$(".task-card").each(function() {
								var main_card_width = $(this).width();
								var task_header_dot = $(this).find(".task-header-dot").width();
								var task_header_id = $(this).find(".task-header-id").width();
								var task_header_main_call = $(this).find(".task-header-main-call").width();
								var main_task_name_width = main_card_width - (task_header_main_call - task_header_id - task_header_dot) - (20 - 16);
								$(this).find(".main_task_name_width").width(main_task_name_width);
							});
						} else if (view_data == 'clockview') {
							$(".clockDiv_main").html("");
							$(".clockDiv_main_js").html("");

							$(".clockDiv_main").html(result.html);
							$(".clockDiv_main_js").html(result.html2);
							// active_tab
							var modal = $('#pills-clockview');
							var content = $('#pills-clockview .overflow-x-scroll');
							var targetElement = $('#active_tab');
							var scrollPosition = targetElement.offset().left + targetElement.outerWidth() / 2 - modal.outerWidth() / 2;
							content.scrollLeft(scrollPosition);

							setActiveMenuItem();
							clock_view_task_card();
							// clock_owlCarousel();

						}
						if (result.stutus_data_allow == 1) {
							$("#status-main-tab").html(result.stutus_data_html);
						}
						if (datastatus != "") {

							// console.log(datastatus);
							$('#status-main-tab button').removeClass('active');
							if (Array.isArray(datastatus)) {
								$.each(datastatus, function(index, value) {
									$('#status-main-tab button[data-inquiry = ' + value + ']').addClass('active');
								});
							} else {
								$('#status-main-tab button[data-inquiry = ' + datastatus + ']').addClass('active');
							}
						} else {
							$('#status-main-tab .all').addClass('active');
						}
						if (datastatus != "") {
							$('.nav-item button').removeClass('active');
							$('.nav-item button[data-inquiry = ' + datastatus + ']').addClass('active');
						}
						$('.inq_pagination').twbsPagination({
							totalPages: total_page,
							visiblePages: 4,
							next: '>>',
							prev: '<<',
							onPageClick: function(event, page) {
								list_data(table, datastatus, page, perPageCount, ajaxsearch);
							}
						});
					}
				}
			});
			<?php
			if (isset($_GET) && !empty($_GET)) { ?>
				<?php
				if (isset($_GET['action']) && ($_GET['action'] == 'filter')) { ?>
					$('.inq_pagination').twbsPagination('destroy');
				<?php } ?>
			<?php
			} ?>
		}
		// list_data();

		$('body').on('click', '.export-inq', function() {
			var inquiry_status_type = $('.today-follow-tabs li .active').attr('data-inquiry');
			// console.log(inquiry_status_type);
			list_data("all_inquiry", inquiry_status_type, "", "", "", "", "", "export");
		});
		$("body").on('click', '.import_inquiry_csv_btn', function(e) {
			// alert();
			e.preventDefault();
			var import_file = $('#import_csv #import_file').val();
			var intrested_area = $('#import_csv #intrested_area').val();
			// var property_sub_type = $('#import_csv #property_sub_type').val();
			var intrested_site = $('#import_csv #intrested_site').val();
			var assign_id = $('#import_csv #assign_id').val();
			var owner_id = $('#import_csv #owner_id').val();
			var inquiry_type = $('#import_csv #inquiry_type').val();
			var inquiry_source_type = $('#import_csv #inquiry_source_type').val();
			var datalist = $('#import_csv .citiess option');
			// var intrested_area_name = $("#import_csv #intrested_area option:selected").attr("data-area_id");
			// var intersted_site_name = $("#import_csv #intrested_site option:selected").attr("data-intersted_site_id");
			var form = $("form[name='import_inquiry_csv']")[0];
			if (import_file != "" && intrested_area != "" && intrested_site != "" && assign_id != "" && owner_id != "" && inquiry_type != "" && inquiry_source_type != "") {
				$('.loader').show();
				var formdata = new FormData(form);
				// formdata.append('table', 'inquiry_all_status');
				formdata.append('table', 'all_inquiry');
				formdata.append('action', 'import');
				// $.each(datalist,function(index,value){ 
				// 	var datalist_text = $(value).val(); 
				// 	if(datalist_text == intrested_area.trim()){ 
				// 		var val = $(value).attr('data-area_option_id'); 
				// 		formdata.append('intrested_area', val); 
				// 	} 
				// });
				// formdata.append('intrested_area_name', intrested_area_name);
				// formdata.append('intersted_site_name', intersted_site_name);
				$.ajax({
					method: "post",
					url: "<?= site_url('inquiry_insert_data'); ?>",
					data: formdata,
					processData: false,
					contentType: false,
					success: function(res) {
						var response = JSON.parse(res);
						if (response.csv_data == 0) {
							Swal.fire({
								html: "<p style='color:green;margin:0px;'><b>" + response.import_data + "</b> Data successfully  Imported</p>",
								icon: 'success',
								confirmButtonText: 'OK',
								confirmButtonClass: 'btn btn-success mt-2',
								buttonsStyling: false,
							}).then(function(result) {
								if (result.value) {
									$(".modal-close-btn").trigger("click");
								}
							});
						} else {
							Swal.fire({
								title: 'Are you Duplicate Data Export csv File?',
								html: "<p style='color:green;margin:0px;'><b>" + response.import_data + "</b>Data successfully Imported</p><p style='color:green;margin:0px;'><b>" + response.reopen_data + "</b> Reopen Inquiry</p> <p style='color:red;margin:0px;'>" + response.csv_data + "</b> Duplicate Data</p>",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonText: 'Export File!',
								cancelButtonText: 'No, cancel!',
								confirmButtonClass: 'btn btn-success mt-2',
								cancelButtonClass: 'btn btn-danger ms-2 mt-2',
								buttonsStyling: false,
							}).then(function(result) {
								if (result.value) {
									$.ajax({
										type: "post",
										url: "<?= site_url('Inquirymanagement_export_inquiry_csv'); ?>",
										data: {
											action: 'export',
											data: response.duplicate_dat_store,
										},
										success: function(res) {
											var downloadLink = document.createElement("a");
											var fileData = ['\ufeff' + res];
											var blobObject = new Blob(fileData, {
												type: "text/csv;charset=utf-8;"
											});
											var url = URL.createObjectURL(blobObject);
											downloadLink.href = url;
											downloadLink.download = "rudrram_inq_export.csv";
											document.body.appendChild(downloadLink);
											downloadLink.click();
											document.body.removeChild(downloadLink);
										},
										error: function(error) {
											$('.loader').hide();
										}
									});
								} else if (
									result.dismiss === Swal.DismissReason.cancel
								) {
									Swal.fire({
										title: 'Cancelled',
										text: 'Your Argument Cancle:)',
										icon: 'error',
									});
									list_data();
									$(".modal-close-btn").trigger("click");
								}
							});
						}
						$('.loader').hide();
					},
				});
			} else {
				$("form[name='import_inquiry_csv']").addClass("was-validated");
				$(form).find('.selectpicker').each(function() {
					var selectpicker_valid = 0;
					if ($(this).attr('required') == 'undefined') {
						var selectpicker_valid = 0;
					}
					if ($(this).attr('required') == 'required') {
						var selectpicker_valid = 1;
					}
					if (selectpicker_valid == 1) {
						if ($(this).val() == 0 || $(this).val() == '') {
							$(this).closest("div").addClass('selectpicker-validation');
						} else {
							$(this).closest("div").removeClass('selectpicker-validation');
						}
					} else {
						$(this).closest("div").removeClass('selectpicker-validation');
					}
				});
				$('.loader').hide();
			}
		});
		$('#project_filter input[type="search"]').on('input', function() {
			var input = $(this).val().toLowerCase();
			var table = $('#today-follow-feedback');
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
		var fileter = true;
		$(".filter_data input, .filter_data select").change(function() {
			// alert();
			var form = $("form[name='filter_form']")[0];
			$('.inq_pagination').twbsPagination('destroy');
			var formdata = new FormData(form);
			formdata.append('action', 'filter');
			$data_status = $("#f_inquiry_status").val();
			<?php if (isset($_REQUEST['followup'])) { ?>
				var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
			<?php } else { ?>
				var follow_up_day = '';
			<?php } ?>
			if ($(".filter-show").html() != "") {
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				formdata.append('follow_up_day', follow_up_day);
			} else {
				formdata = '';
			}
			list_data(table = 'all_inquiry', $data_status, 1, 10, "", 'filter', formdata);
		});
		$('body').on('click', '#filter-showw p', function() {
			$('.inq_pagination').twbsPagination('destroy');
			<?php if (isset($_REQUEST['followup'])) { ?>
				var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
			<?php } else { ?>
				var follow_up_day = '';
			<?php } ?>
			if ($(".filter-show").html() != "") {
				$data_status = $("#f_inquiry_status").val();
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				formdata.append('follow_up_day', follow_up_day);
			} else {
				formdata = '';
			}
			list_data(table = 'all_inquiry', $data_status, 1, 10, "", 'filter', formdata);
		});
		$("#clear").click(function() {
			// location.reload(); 
			// $('.inq_pagination').twbsPagination('destroy');
			// <?php if (isset($_REQUEST['followup'])) { ?>
			// 	var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
			// <?php } else { ?>
			// 	var follow_up_day = '';
			// <?php } ?>
			// if ($(".filter-show").html() != "") {
			// 	formdata.append('follow_up_day', follow_up_day);
			// 	$data_status = $("#f_inquiry_status").val();
			// 	var form = $("form[name='filter_form']")[0];
			// 	var formdata = new FormData(form);
			// 	formdata.append('action', 'filter');
			// } else {
			// 	formdata = '';
			// }
			// list_data(table = 'all_inquiry', $data_status, 1, 10, "", 'filter', formdata);
			$('.today-follow-tabs li button[data-inquiry=""]').trigger('click');
			list_data();
		});
		$('body').on('click', '.load_more_data', function(e) {
			e.preventDefault();
			var datastatus = $(this).attr('data-inquiry_status');
			var row_count = $(this).attr('data-row_count');
			var htmltag = $(this);
			card_list_data("all_inquiry", datastatus, "", row_count, true, htmltag);
		});

		function card_list_data(table = 'all_inquiry', datastatus = '', pageNumber = 1, perPageCount = '10', action = true, htmltag = '') {
			var data = {
				'table': table,
				'datastatus': datastatus,
				'pageNumber': pageNumber,
				'perPageCount': perPageCount,
				// 'view' : view_data,
				'action': action,
			};
			var processdd = true;
			var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
			var totalData = [];
			$.ajax({
				datatype: 'json',
				method: "POST",
				url: 'card_inquiry_list_data',
				data: data,
				processData: processdd,
				contentType: contentType,
				success: function(res) {
					$('.loader').hide();
					var result = JSON.parse(res);
					var data_load_location = htmltag.closest('.task-board-body').find('.card_html_load').append(result.html);
					htmltag.attr('data-row_count', result.row_count);
					htmltag.closest('.task-main-board').find('.r_count').html(result.row_count);
					$(".task-card").each(function() {
						var main_card_width = $(this).width();
						var task_header_dot = $(this).find(".task-header-dot").width();
						var task_header_id = $(this).find(".task-header-id").width();
						var task_header_main_call = $(this).find(".task-header-main-call").width();
						var main_task_name_width = main_card_width - (task_header_main_call - task_header_id - task_header_dot) - (20 - 16);
						$(this).find(".main_task_name_width").width(main_task_name_width);
					});
					if (result.btn_remove == 0) {
						htmltag.remove();
					}
				}
			});
		}
		// followup tab change 
		// $('body').on('click', '.call-reset-tab', function() {
		// 	// alert();
		// 	$('.follow-up-active').trigger('click');
		// });

		function clockList() {
			list_data();
		}

		function setActiveMenuItem(index) {
			// Remove the active class from all navigation items
			$('.owl-nav button').removeClass('active');

			// Add the active class to the navigation item corresponding to the current slide
			// $('.owl-nav button').eq(index).addClass('active');
			// console.log("awdwd");
			$('#active_tab').closest('.owl-item').addClass('active');
		}
		$("body").on('click', '.inquiry_all_status_call', function(e) {
			e.preventDefault();
			var inquiry_email = $(this).attr('inquiry_email');
			var inquiry_pno = $(this).attr('inquiry_pno');
			var product_type = $(this).attr('product_type');

			$('.remark').val('');
			$('.loader').show();
			$('.selectpicker').selectpicker('refresh');

			// Set Value In Quatation Model User NAme 
			setTimeout(() => {
				$('.check_clear').prop('checked', false);
				$('.discount_quatation').val('0');
				var user_name = $('.full_name').text();
				$('.user_name_q').val(user_name);
				$('.user_email_q').val(inquiry_email);
				$('.inquiry_pno_div').val(inquiry_pno);
				if (product_type) {
					$.ajax({
						type: "post",
						url: "<?= site_url('product_wise_plan'); ?>",
						data: {
							product_type: product_type,
						},
						success: function(res) {
							// var response = JSON.parse(res);
							$('#addPaln').html(res);
						},
					});
				}
			}, 400);
			var edit_call_id = $(this).attr("data-call_id");
			$('.generate_pdf_button').attr('data_table_id', edit_call_id)
			// Set Value In Quatation Model User NAme 
			if (edit_call_id != "") {
				follow_up(edit_call_id);
			} else {
				$('.loader').hide();
				alert("Data Not Edit.");
			}
		});
		$('body').on('click', '.inquery_view', function(e) {
			e.preventDefault();
			var self = $(this).closest("tr");
			var edit_value = $(this).attr("data-view_id");
			if (edit_value != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('all_inquiry_data_view'); ?>",
					data: {
						action: 'view',
						view_id: edit_value,
						table: 'all_inquiry'
					},
					success: function(res) {
						$('.loader').hide();
						$('.pass_field').hide();
						var response = JSON.parse(res);
						$('#view_inquery_list #id').text(response.id);
						$('.edt').attr('data-edit_id', response.id);
						$('.dlt').attr('data-delete_id', response.id);
						$('.log_button').attr('data-log_id', response.id);
						$('#view_inquery_list #full_name').text(response.full_name);
						$('#view_inquery_list #email').text(response.email);
						$('#view_inquery_list #inquiry_status').text(response.inquiry_status);
						$('#view_inquery_list #message').text(response.message);
						$("#view_inquery_list #mobileno").text(response.mobileno);
						$('#view_inquery_list #altmobileno').text(response.altmobileno);
						$('#view_inquery_list #email').text(response.email);
						$("#view_inquery_list #houseno").text(response.houseno);
						$('#view_inquery_list #society').text(response.society);
						$('#view_inquery_list #area').text(response.area_name);
						$("#view_inquery_list #countryId").text(response.countryId);
						$("#view_inquery_list #stateId").text(response.stateId);
						$("#view_inquery_list #cityId").text(response.cityId);
						$("#view_inquery_list #intrested_area_name").text(response.intrested_area_name);
						$("#view_inquery_list #intersted_site_name").text(response.intersted_site_name);
						$("#view_inquery_list #project_type_name").text(response.project_type_name);
						$("#view_inquery_list #intrested_product").text(response.int_product_details);
						$("#view_inquery_list #property_sub_type").text(response.project_sub_type_name);
						// $("#view_inquery_list #intersted_site").text(response.intersted_site);
						$("#view_inquery_list #budget").text(response.budget);
						$("#view_inquery_list #purpose_buy").text(response.buying_as);
						$("#view_inquery_list #approx_buy").text(response.approx_buy);
						$("#view_inquery_list #inquiry_type").text(response.inquiry_type_name);
						$("#view_inquery_list #inquiry_source_type").text(response.inquiry_source_type_name);
						$("#view_inquery_list #nxt_follow_up").text(response.nxt_follow_up);
						$("#view_inquery_list #inquiry_description").text(response.inquiry_description);
						$("#view_inquery_list #appointment_date").text(response.appointment_date);
						$("#view_inquery_list #subscription").text(response.subs_name);
						$("#view_inquery_list #business_name").text(response.business_name);
						$("#view_inquery_list #designation").text(response.designation);

						$("#view_inquery_list #int_area").text(response.area);
						$("#view_inquery_list #int_city").text(response.city);

					},
				});
			} else {
				$('.loader').hide();
				alert("Data Not Edit.");
			}
		});
		// edit data 
		$('body').on('click', '.edt', function(e) {
			$("#inquiry_all_status_update .tag_name").html('Edit Inquiry');
			//$('.project_drop').hide();
			// alert("hl");
			e.preventDefault();
			// $('.selectpicker').selectpicker('refresh');
			var self = $(this).closest("tr");
			var edit_value = $(this).attr("data-edit_id");
			// console.log(edit_value);
			if (edit_value != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('inquiry_list_data_edit'); ?>",
					data: {
						action: 'edit',
						edit_id: edit_value,
						table: 'all_inquiry'
					},
					success: function(res) {
						$('.loader').hide();
						// $('.selectpicker').selectpicker('refresh');
						var response = JSON.parse(res);
						// $('.dlt').attr('data-delete_id', response.id);
						$('.inquiry_all_status_update').attr('data-edit_id', response[0].id);
						$('#inquiry_all_status_update #full_name').val(response[0].full_name);
						$('#inquiry_all_status_update #mobileno').val(response[0].mobileno);
						$('#inquiry_all_status_update #email').val(response[0].email);
						$('#inquiry_all_status_update #message').val(response[0].message);
						$("#inquiry_all_status_update #altmobileno").val(response[0].altmobileno);
						$("#inquiry_all_status_update #area").val(response[0].area);
						$("#inquiry_all_status_update #city").val(response[0].city);
						$("#inquiry_all_status_update #houseno").val(response[0].houseno);
						$("#inquiry_all_status_update #society").val(response[0].society);
						$("#inquiry_all_status_update #intrested_product").val(response[0].intrested_product);
						$("#inquiry_all_status_update #budget").val(response[0].budget);
						$("#inquiry_all_status_update #buying_as").val(response[0].buying_as);
						$("#inquiry_all_status_update #subscription").val(response[0].subscription);
						$("#inquiry_all_status_update #inquiry_type").val(response[0].inquiry_type);
						$("#inquiry_all_status_update #inquiry_source_type").val(response[0].inquiry_source_type);
						$("#inquiry_all_status_update #inquiry_description").val(response[0].inquiry_description);
						$("#inquiry_all_status_update #approx_buy").val(response[0].approx_buy);
						$("#inquiry_all_status_update #dob").val(response[0].dob);
						$("#inquiry_all_status_update #anni_date").val(response[0].anni_date);
						$("#inquiry_all_status_update #nxt_follow_up").val(response[0].nxt_follow_up);
						$("#inquiry_all_status_update #designation").val(response[0].designation);
						$("#inquiry_all_status_update #business_name").val(response[0].business_name);

						$('#inquiry_all_status_update .nxtiii').hide();
						// if (edit_value != "") {
						// } else {
						// 	$("#inquiry_all_status_update .tag_name").html('Add Inquiry');
						// }
						$('.modal-close-btn').click(function() {
							$('#inquiry_all_status_update  .inquiry_all_status_update_btn').attr("data-edit_id", '');
						});
						// $("#inquiry_all_status_update #nxt_follow_up").val();
						// $("#inquiry_all_status_update #nxt_follow_up");
						// var next_follow_up = timeValidation(nxt_follow_up, nxt_follow_up_tag);
						// var inabsent_who_work = $("#in_absemnt").val();
						// $('.modal-close-btn').click(function() {
						// 	$('form[name="leave_insert"]')[0].reset();
						// 	// $('.selectpicker').selectpicker('refresh');
						// });
						$('.selectpicker').selectpicker('refresh');
					},
					error: function(error) {
						$('.loader').hide();
					}
				});
			} else {
				$('.loader').hide();
				alert("Data Not Edit.");
			}
		});
		// delete data 
		$('body').on('click', '.dlt', function(e) {
			// alert("hello");
			e.preventDefault();
			var self = $(this).closest("tr");
			var id = $(this).attr('data-delete_id');
			// console.log(id);
			if (id != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('inquiry_list_deletedata'); ?>",
					data: {
						action: 'delete',
						id: id,
						table: 'all_inquiry',
					},
					success: function(res) {
						$('.loader').hide();
						$(".modal-close-btn").trigger("click");
						list_data();
						iziToast.delete({
							title: 'Delete successfully'
						});
					},
					error: function(error) {
						$('.loader').hide();
					}
				});
			}
		});
		// $("body").on('click', '.booking_add_data', function(e) {
		// 	alert();
		// 	// myFunction();
		// 	e.preventDefault();
		// 	var update_id = $(this).attr("data-edit_id");
		// 	var mobile = $('#conversion_inquery #mobile').val();
		// 	var name = $('#conversion_inquery #name').val();
		// 	var email = $('#conversion_inquery #email').val();
		// 	var houseno = $('#conversion_inquery #houseno').val();
		// 	var society = $('#conversion_inquery #society').val();
		// 	var area = $('#conversion_inquery #area').val();
		// 	var landmark = $('#conversion_inquery #landmark').val();
		// 	var countryId = $('#conversion_inquery #countryId').val();
		// 	var stateId = $('#conversion_inquery #stateId').val();
		// 	var cityId = $('#conversion_inquery #cityId').val();
		// 	var pincode = $('#conversion_inquery #pincode').val();
		// 	var aadharno = $('#conversion_inquery #aadharno').val();
		// 	var pancard_no = $('#conversion_inquery #pancard_no').val();
		// 	var product_name = $('#conversion_inquery #product_name').val();
		// 	// var visit_date = $('#visit_entry_form #visit_date').val();
		// 	var plan_name = $('#conversion_inquery #plan_name').val();
		// 	var username = $('#conversion_inquery #username').val();
		// 	var password = $('#conversion_inquery #password');
		// 	var confirmpassword = $('#conversion_inquery #confirmpassword').val();
		// 	// var iscountvisit = $('#conversion_inquery #iscountvisit').val();
		// 	// var cash_pay = $('#conversion_inquery #cash_pay').val();
		// 	// var inquiry_status = $('#conversion_inquery #inquiry_status').val();
		// 	// var remark = $('#conversion_inquery #remark').val();
		// 	// change 
		// 	var inquiry_id = $(this).attr("data-edit_id");
		// 	// console.log(inquiry_id);
		// 	var remark = $('#conversion_inquery #remark').val();
		// 	var inquiry_status = $('#conversion_inquery #inquiry_status').val();
		// 	// end 
		// 	var form = $("form[name='booking_form']")[0];
		// 	var formdata = new FormData(form);
		// 	// formdata.append('action', 'update');
		// 	formdata.append('edit_id', update_id);
		// 	// formdata.append('table', 'all_inquiry');
		// 	// formdata.append('visit_date', visit_date);
		// 	// formdata.append('revisit_date', revisit_date);
		// 	// formdata.append('remark', remark);
		// 	// formdata.append('nxt_follow_up', nxt_follow_up);
		// 	// formdata.append('inquiry_status', inquiry_status);
		// 	formdata.append('inquiry_id', inquiry_id);
		// 	// console.log(mobilenoo+','+full_name+','+address+','+intrested_area+','+property_sub_type+','+property_type+','+budget+','+purpose_buy+','+approx_buy+','+visit_date+','+intrested_site+','+unit_no+','+paymentref+','+dp_amount+','+loan_amount+','+cash_pay+','+remark+','+nxt_follow_up);
		// 	$('.loader').show();
		// 	// if (mobilenoo != "" && full_name != "" && address != "" && intrested_area != "" && property_sub_type != "" && budget != "" && purpose_buy != "" && approx_buy != "" && intrested_site != "" && unit_no != "" && paymentref != "" && dp_amount != "" && loan_amount != "" && cash_pay != "" && remark != "" && next_follow_up == 1) {
		// 		// $.ajax({
		// 		// 	method: "post",
		// 		// 	url: "<?= site_url('subscribtion_inserttt'); ?>",
		// 		// 	data: formdata,
		// 		// 	processData: false,
		// 		// 	contentType: false,
		// 		// 	success: function(res) {
		// 		// 		if (res != "error") {
		// 		// 			$('.loader').hide();
		// 		// 			list_data();
		// 		// 			$(".modal-close-btn").trigger("click");
		// 		// 			sweet_edit_sucess('Update successfully');
		// 		// 		} else {
		// 		// 			$('.loader').hide();
		// 		// 			Swal.fire({
		// 		// 				title: 'Cancelled',
		// 		// 				text: 'Duplicate Data Not Valid',
		// 		// 				icon: 'error',
		// 		// 			})
		// 		// 		}
		// 		// 	},
		// 		// 	error: function(error) {}
		// 		// });
		// 	// } else {
		// 	// 	$('.loader').hide();
		// 	// 	$("form[name='allinquiry_update_form']").addClass("was-validated");
		// 	// 	timeValidation(nxt_follow_up, nxt_follow_up_tag);
		// 	// 	$("form[name='allinquiry_update_form']").find('.selectpicker').each(function() {
		// 	// 		var selectpicker_valid = 0;
		// 	// 		if ($(this).attr('required') == 'undefined') {
		// 	// 			var selectpicker_valid = 0;
		// 	// 		}
		// 	// 		if ($(this).attr('required') == 'required') {
		// 	// 			var selectpicker_valid = 1;
		// 	// 		}
		// 	// 		if (selectpicker_valid == 1) {
		// 	// 			if ($(this).val() == 0 || $(this).val() == '') {
		// 	// 				$(this).closest("div").addClass('selectpicker-validation');
		// 	// 			} else {
		// 	// 				$(this).closest("div").removeClass('selectpicker-validation');
		// 	// 			}
		// 	// 		} else {
		// 	// 			$(this).closest("div").removeClass('selectpicker-validation');
		// 	// 		}
		// 	// 	});
		// 	// }
		// });
		function follow_up(edit_call_id) {
			$.ajax({
				datatype: 'json',
				type: "post",
				url: "<?= site_url('inquiry_follow_up'); ?>",
				data: {
					action: 'edit',
					inquiry_id: edit_call_id
				},
				success: function(res) {
					var response = JSON.parse(res);
					if (response.result == 1) {
						$.each(response.inquiry_all_status_data, function(key, value) {
							$('#callmodal .' + key).text(value);
						});
						if (response.fill_interst == 0) {
							$('.inquiry_status_submit').prop('disabled', false);
						} else {
							$('.inquiry_status_submit').prop('disabled', true);
						}
						$('.tel_mobileno').attr("href", "tel:" + response.inquiry_all_status_data.mobileno);
						$('.wp_mobileno').attr("href", "https://wa.me/91" + response.inquiry_all_status_data.mobileno);
						$('.call-modal-tabs').html(response.inquiry_call_html_btn_action);
						$('#inquiry_status_submit').attr("data-inquiry_id", response.inquiry_all_status_data.id);
						$('#inquiry_status_submit').attr("data-email", response.inquiry_all_status_data.email);
						$("#callmodal #follow-up-tab").addClass("active");
						$('.fill_interest').html(response.intrest_area_required_html_btn);
						// $('#inquiry_all_status_call .modal-header').html(response.model_header_html);
						// $('#inquiry_all_status_call #model-project-data').html(response.model_project_data_html);
						$('.call-list').html(response.inquiry_call_html);
						$('.selectpicker').selectpicker('refresh');
						$('#dateconfirmationbtn').hide();
						$('.default_btn_trigger').trigger("click");
						$('.loader').hide();
					} else {
						$('.loader').hide();
					}
				},
				error: function(error) {
					$('.loader').hide();
				}
			});
		}
		$("body").on('click', '.inquiry_assign', function(e) {
			//alert();
			e.preventDefault();
			var val = [];
			$('.inquiry_id:checked').each(function(i) {
				val[i] = $(this).val();
			});
			if ($('#assign_id').val() == '' || $('#assign_id').val() == '0' || $('#action_name').val() == '' || $('#action_name').val() == '0' || val == '') {
				Swal.fire({
					title: 'Cancelled',
					text: 'Please Select Data.',
					icon: 'error',
				});
				return false;
			}
			Swal.fire({
				title: 'Are you sure?',
				text: "You want to be Assign this Inquiry!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, Assign it!',
				cancelButtonText: 'No, cancel!',
				confirmButtonClass: 'btn btn-success mt-2',
				cancelButtonClass: 'btn btn-danger ms-2 mt-2',
				buttonsStyling: false,
			}).then(function(result) {
				if (result.value) {
					if (val != '') {
						var form = $("form[name='assign_form']")[0];
						var formdata = new FormData(form);
						formdata.append('inquiry_id', val);
						formdata.append('action', 'assign');
						//formdata.append('table', 'inquiry_all_status');
						$('.loader').show();
						$.ajax({
							method: "post",
							url: "<?= site_url('Inquirymanagement_assign_bulk'); ?>",
							data: formdata,
							processData: false,
							contentType: false,
							success: function(res) {
								if (res != "error") {
									var form = $("form[name='assign_form']")[0].reset();
									$("#action_name").val('');
									$("#assign_id").val('');
									$("#select_all").prop("checked", false);
									$('.selectpicker').selectpicker('refresh');
									$('.inq_pagination').twbsPagination('destroy');
									list_data();
									$(".main-select-section").hide();
									// sweet_edit_sucess('Assign successfully');
									iziToast.success({
										title: 'Assign successfully',
									});
									$('.loader').hide();
								}
							},
						});
					} else {
						$('.loader').hide();
						// Swal.fire({
						// 	title: 'Cancelled',
						// 	text: 'Please Select People.',
						// 	icon: 'error',
						// });
						iziToast.error({
							title: 'Please Select People',
						});
					}
				} else if (
					// Read more about handling dismissals
					result.dismiss === Swal.DismissReason.cancel
				) {
					// Swal.fire({
					// 	title: 'Cancelled',
					// 	text: 'Your Argument Cancle:)',
					// 	icon: 'error',
					// });
					iziToast.error({
						title: 'Your Argument Cancle:)',
					});
				}
			});
			$('.loader').hide();
		});
		$("#callmodal").on('click', '.inquiry_status_submit', function(e) {
			// alert("hello");
			e.preventDefault();
			var call_page = $(".inq_pagination").find(".page-item.active .page-link").text();
			var selected = $('.call-modal-tabs button.active');
			// Get the value attribute of the selected li element
			var inquiry_id = $(this).attr("data-inquiry_id");
			// var remark = $('#inquiry_all_status_call .remark').val();
			var btn_action = selected.attr('data-list');
			var btn_target = selected.attr('data-bs-target');
			var inq_status = selected.attr('data-inq_status');
			var inq_tag_btn_click = selected.attr('data-inq_tag');
			// var inq_email = selected.attr('data-email');
			var inquiry_email = $(this).attr('data-email');
			// console.log(inquiry_email);
			var nxt_follow_up = $(btn_target + ' .next-followup').val();
			var nxt_follow_up_teg = $('.next-followup');
			var next_follow_up = timeValidation(nxt_follow_up, nxt_follow_up_teg);
			// console.log(nxt_follow_up);
			var remark = $(btn_target + ' .remark').val();
			if (btn_action == 'list_dismissed_action') {
				var comman_var = $(btn_target + ' #inquiry_close_reason').val();
			} else if (btn_action == 'list_appointment_action') {
				var comman_var = $(btn_target + ' #appoint_date').val();
				var comman_var_tag = $(btn_target + ' #appoint_date');
				// console.log(comman_var);
				var next_follow_up = timeValidation(comman_var, comman_var_tag);
			} else if (btn_action == 'list_cnr_action') {
				var comman_var = "cnr";
			} else {
				var comman_var = $(btn_target + ' .next-followup').val();
				var comman_var_date = timeValidation(comman_var, nxt_follow_up_teg);
			}
			if (comman_var == "cnr") {
				if (inquiry_id != "" && comman_var != '') {
					var form = $(btn_target + " form[name='inquiry_update_status_form']")[0];
					var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
					var follow_page = $(".inq_pagination").find(".page-item.active .page-link").text();
					var perPageCount = $('#perPageCount').val();
					var formdata = new FormData(form);
					formdata.append('inquiry_id', inquiry_id);
					formdata.append('status_btn_click', inq_status);
					formdata.append('tag_btn_click', inq_tag_btn_click);
					formdata.append('tag_btn_click', inq_tag_btn_click);
					$('.loader').show();
					$.ajax({
						method: "post",
						url: "<?= site_url('Inquirymanagement_inquiry_update_status'); ?>",
						data: formdata,
						processData: false,
						contentType: false,
						success: function(res) {
							var response = JSON.parse(res);
							var message = "Status Not Updated";
							if (response.msg) {
								message = response.msg;
							}
							if (response.result == 1) {
								//$(btn_target + " form[name='inquiry_update_status_form']")[0].reset();
								//$(btn_target + " form[name='inquiry_update_status_form']").removeClass("was-validated");
								// $('.modal-close-btn').click(function() {
								// 	alert("he");
								// });
								$('.inq_pagination').twbsPagination('destroy');
								list_data('all_inquiry', inquiry_status_type, follow_page, perPageCount);
								$(".modal-close-btn").trigger("click");
								$('.loader').hide();
								sweet_edit_sucess(message);
							} else {
								$('.loader').hide();
								Swal.fire({
									title: 'Cancelled',
									text: message,
									icon: 'error',
								});
							}
						},
						error: function(error) {
							$('.loader').hide();
						}
					});
				} else {
					$('.loader').hide();
					$(btn_target + " form[name='inquiry_update_status_form']").addClass("was-validated");
				}
			} else {
				if (inquiry_id != "" && comman_var != '' && remark != '') {
					var btn_action = selected.attr('data-list');
					var btn_target = selected.attr('data-bs-target');
					var inq_status = selected.attr('data-inq_status');
					var inq_tag_btn_click = selected.attr('data-inq_tag');
					var form = $(btn_target + " form[name='inquiry_update_status_form']")[0];
					var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
					var follow_page = $(".inq_pagination").find(".page-item.active .page-link").text();
					var perPageCount = $('#perPageCount').val();
					var formdata = new FormData(form);
					formdata.append('inquiry_id', inquiry_id);
					formdata.append('status_btn_click', inq_status);
					formdata.append('tag_btn_click', inq_tag_btn_click);
					formdata.append('email', inquiry_email);
					// console.log(formdata);
					$('.loader').show();
					$.ajax({
						method: "post",
						url: "<?= site_url('Inquirymanagement_inquiry_update_status'); ?>",
						data: formdata,
						processData: false,
						contentType: false,
						success: function(res) {
							var response = JSON.parse(res);
							// console.log(res);
							var message = "Status Not Updated";
							if (response.msg) {
								message = response.msg;
							}
							if (response.result == 1) {
								$(btn_target + " form[name='inquiry_update_status_form']")[0].reset();
								$(btn_target + " form[name='inquiry_update_status_form']").removeClass("was-validated");
								//$('.inq_pagination').twbsPagination('destroy');
								list_data('all_inquiry', inquiry_status_type, follow_page, perPageCount);
								$(".modal-close-btn").trigger("click");
								$('.loader').hide();
								sweet_edit_sucess(message);
							} else {
								$('.loader').hide();
								Swal.fire({
									title: 'Cancelled',
									text: message,
									icon: 'error',
								});
							}
						},
						error: function(error) {
							$('.loader').hide();
						}
					});
				} else {
					$('.loader').hide();
					$(btn_target + " form[name='inquiry_update_status_form']").addClass("was-validated");
				}
			}
		});
		// edit data all inquiry
		$('body').on('click', '.visit_entry_form', function(e) {
			// alert("hl");	
			e.preventDefault();
			// $('select.selectpicker').selectpicker('refresh');
			var self = $(this).closest("tr");
			var edit_value = $(this).attr("data-inquiry_edit_id");
			if (edit_value != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('inquiry_list_editallinquiry'); ?>",
					data: {
						action: 'edit',
						edit_id: edit_value,
						table: 'all_inquiry'
					},
					success: function(res) {
						$('.loader').hide();
						var response = JSON.parse(res);
						$('.inquiry_visited_submit').attr('data-edit_id', response[0].id);
						$('#visit_entry_form #mobilenoo').val(response[0].mobileno);
						$('#visit_entry_form #full_name').attr('value', response[0].full_name);
						$('#visit_entry_form #address').attr('value', response[0].houseno + ', ' + response[0].society);
						$('#visit_entry_form #intrested_product').val(response[0].intrested_product);
						$('#visit_entry_form #subscription').val(response[0].subscription);
						$('#visit_entry_form #budget').val(response[0].budget);
						$('#visit_entry_form #buying_as').val(response[0].buying_as);
						$('#visit_entry_form #approx_buy').val(response[0].approx_buy);
						$('#visit_entry_form #remark').val(response[0].remark);
						$('#visit_entry_form #int_subscription').val(response[0].int_subscription);
						// $('#visit_entry_form #intrested_area').val(response[0].intrested_area);
						// $('#visit_entry_form #property_type').val(response[0].property_type);
						// $('#visit_entry_form #dp_amount').val(response[0].dp_amount);
						// $('#visit_entry_form #loan_amount').val(response[0].loan_amount);
						// $('#visit_entry_form #purpose_buy').val(response[0].purpose_buy);
						// $('#visit_entry_form #intrested_site').val(response[0].intrested_site);
						// $('#visit_entry_form #isSiteVisit').val(response[0].isSiteVisit);
						// $('#visit_entry_form #iscountvisit').val(response[0].iscountvisit);
						// $('#visit_entry_form #iscountvisit').text(response[0].iscountvisit);
						// $('#visit_entry_form #cash_pay').val(response[0].cash_pay);
						// $('#visit_entry_form #inquiry_status').val(response[0].inquiry_status);
						// $('#visit_entry_form #revisit_date').val(response[0].revisit_date);
						$('.modal-close-btn').click(function() {
							$('form[name="allinquiry_update_form"]')[0].reset();
						});
						// $('#visit_entry_form #nxt_follow_up').val(response[0].nxt_follow_up);
						// $('#visit_entry_form #visit_date').val(response[0].visit_date);
						// $('#visit_entry_form #visit_date').attr("placeholder", response[0].visit_date);
						$('.selectpicker').selectpicker('refresh');
						// myFunction();
					},
					error: function(error) {
						$('.loader').hide();
					}
				});
			} else {
				$('.loader').hide();
				alert("Data Not Edit.");
			}
		});
		// update all inquiry 
		$("body").on('click', '.inquiry_visited_submit', function(e) {
			// alert("hello");
			// myFunction();
			e.preventDefault();
			var update_id = $(this).attr("data-edit_id");
			var mobilenoo = $('#visit_entry_form #mobilenoo').val();
			var full_name = $('#visit_entry_form #full_name').val();
			var address = $('#visit_entry_form #address').val();
			var intrested_product = $('#visit_entry_form #intrested_product').val();
			var subscription = $('#visit_entry_form #subscription').val();
			var budget = $('#visit_entry_form #budget').val();
			var buying_as = $('#visit_entry_form #buying_as').val();
			var approx_buy = $('#visit_entry_form #approx_buy').val();
			var remark = $('#visit_entry_form #remark').val();
			var isSiteVisit = $('#visit_entry_form #isSiteVisit').val();
			var nxt_follow_up = $('#visit_entry_form #nxt_follow_up').val();
			var int_subscription = $('#visit_entry_form #int_subscription').val();
			// var next_follow_up = timeValidation(nxt_follow_up, nxt_follow_up_tag);
			// var intrested_area = $('#visit_entry_form #intrested_area').val();
			// var property_sub_type = $('#visit_entry_form #property_sub_type').val();
			// var property_type = $('#visit_entry_form #property_type').val();
			// var budget = $('#visit_entry_form #budget').val();
			// var purpose_buy = $('#visit_entry_form #purpose_buy').val();
			// var approx_buy = $('#visit_entry_form #approx_buy').val();
			// var intrested_site = $('#visit_entry_form #intersted_site_name').val();
			// var unit_no = $('#visit_entry_form #unit_no').val();
			// var paymentref = $('#visit_entry_form #paymentref').val();
			// var dp_amount = $('#visit_entry_form #dp_amount').val();
			// var loan_amount = $('#visit_entry_form #loan_amount').val();
			// // var visit_date = $('#visit_entry_form #visit_date').val();
			// var revisit_date = $('#visit_entry_form #revisit_date').val();
			// var nxt_follow_up_tag = $('#visit_entry_form #nxt_follow_up');
			// var next_follow_up = timeValidation(nxt_follow_up, nxt_follow_up_tag);
			// var iscountvisit = $('#visit_entry_form #iscountvisit').val();
			// var cash_pay = $('#visit_entry_form #cash_pay').val();
			// var inquiry_status = $('#visit_entry_form #inquiry_status').val();
			// var remark = $('#visit_entry_form #remark').val();
			// change 
			var inquiry_id = $(this).attr("data-edit_id");
			// console.log(inquiry_id);
			var remark = $('#visit_entry_form #remark').val();
			// var inquiry_status = $('#visit_entry_form #inquiry_status').val();
			// end 
			var form = $("form[name='allinquiry_update_form']")[0];
			var formdata = new FormData(form);
			// formdata.append('action', 'update');
			formdata.append('edit_id', update_id);
			// formdata.append('table', 'all_inquiry');
			// formdata.append('visit_date', visit_date);
			// formdata.append('revisit_date', revisit_date);
			formdata.append('remark', remark);
			formdata.append('nxt_follow_up', nxt_follow_up);
			// formdata.append('inquiry_status', inquiry_status);
			formdata.append('inquiry_id', inquiry_id);
			// console.log(mobilenoo+','+full_name+','+address+','+intrested_area+','+property_sub_type+','+property_type+','+budget+','+purpose_buy+','+approx_buy+','+visit_date+','+intrested_site+','+unit_no+','+paymentref+','+dp_amount+','+loan_amount+','+cash_pay+','+remark+','+nxt_follow_up);
			$('.loader').show();
			if (mobilenoo != "" && full_name != "" && address != "" && intrested_product != "" && subscription != "" && buying_as != "" && approx_buy != "" && approx_buy != "" && remark != "") {
				$.ajax({
					method: "post",
					url: "<?= site_url('inquiry_update_form'); ?>",
					data: formdata,
					processData: false,
					contentType: false,
					success: function(res) {
						if (res != "error") {
							$('.loader').hide();
							list_data();
							$(".modal-close-btn").trigger("click");
							sweet_edit_sucess('Update successfully');
						} else {
							$('.loader').hide();
							Swal.fire({
								title: 'Cancelled',
								text: 'Duplicate Data Not Valid',
								icon: 'error',
							})
						}
					},
					error: function(error) {}
				});
			} else {
				$('.loader').hide();
				$("form[name='allinquiry_update_form']").addClass("was-validated");
				timeValidation(nxt_follow_up, nxt_follow_up_tag);
				$("form[name='allinquiry_update_form']").find('.selectpicker').each(function() {
					var selectpicker_valid = 0;
					if ($(this).attr('required') == 'undefined') {
						var selectpicker_valid = 0;
					}
					if ($(this).attr('required') == 'required') {
						var selectpicker_valid = 1;
					}
					if (selectpicker_valid == 1) {
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
		});
		$("body").on('click', '.edit_value', function(e) {
			var edit_value = $(this).attr("data-edit_id");
			var isSiteVisit = $('#isSiteVisit').val();
			var iscountvisit = $('#iscountvisit').val();
			// console.log(isSiteVisit+iscountvisit);
			// console.log(iscountvisit);
			// var new_value = parseInt(current_value) + 1;
			$.ajax({
				method: 'POST',
				url: "<?= site_url('inquiry_change_value'); ?>",
				data: {
					edit_value: edit_value,
					isSiteVisit: isSiteVisit,
					iscountvisit: iscountvisit,
					'table': 'all_inquiry'
				},
				success: function(response) {
					if (response.success) {
						$('#isSiteVisit').text(isSiteVisit);
						$('#iscountvisit').text(iscountvisit);
					}
				},
				error: function() {}
			});
		});
		$('body').on('change', '#intrested_product', function(e) {
			e.preventDefault();
			var product_id = $(this).val();
			if (product_id == 1) {
				$('#interested_entry_form #buying_as').closest('.col-sm-6').show();
				$('#inquiry_all_status_update #buying_as').closest('.col-sm-6').show();
			} else {
				$('#interested_entry_form #buying_as').closest('.col-sm-6').hide();
				$('#inquiry_all_status_update #buying_as').closest('.col-sm-6').hide();
			}
			$.ajax({
				type: "post",
				url: "<?= site_url('product_data'); ?>",
				data: {
					action: true,
					product_id: product_id,
				},
				beforeSend: function(res) {
					$('.loader').show();
				},
				success: function(res) {
					$('.loader').hide();
					var ress = JSON.parse(res);
					$('#inquiry_all_status_update #subscription').html(ress.subscription);
					$('#interested_entry_form #subscription').html(ress.subscription);
					$('.selectpicker').selectpicker('refresh');
				}
			});
		});
		// edit fill interest 
		$('body').on('click', '.fill-interest-btn', function() {
			var interest_id = $(this).attr('data-interest_id');
			// console.log(interest_id);
			$('.loader').show();
			if (interest_id != "") {
				$.ajax({
					type: "post",
					url: "<?= site_url('all_inquiry_data_view'); ?>",
					data: {
						action: 'view',
						view_id: interest_id,
						table: 'all_inquiry'
					},
					success: function(res) {
						$(".interested_entry_form").addClass("d-block show");
						var response = JSON.parse(res);
						$('#interested_form #inquiry_id').text(response.id);
						$("#interested_form #intrested_product").val(response.intrested_product);
						$("#interested_form #subscription").val(response.subscription);
						$("#interested_form #budget").val(response.budget);
						// $("#interested_form #budget").val(response.budget);
						$("#interested_form #buying_as").val(response.buying_as);
						$("#interested_form #approx_buy").val(response.approx_buy);
						$('#interested_form #add_data').attr('data-edit_id', response.id);
						$('.selectpicker').selectpicker('refresh');
						$('.loader').hide();
					}
				});
			}
		});
		$(".interested_entry_form .modal-close-btn, .btn-closing").click(function() {
			$(".interested_entry_form").removeClass("d-block show");
		});
		// update data fill interst
		$('body').on('click', '#add_data', function(e) {
			e.preventDefault();
			var update_id = $(this).attr('data-edit_id');
			var intrested_product = $("#interested_form #intrested_product").val();
			var subscription = $("#interested_form #subscription").val();
			var budget = $("#interested_form #budget").val();
			var buying_as = $("#interested_form #buying_as").val();
			var approx_buy = $("#interested_form #approx_buy").val();
			if (update_id != "" && intrested_product != "" && subscription != "" && budget != "" && approx_buy != "") {
				var form = $("form[name='interested_form'")[0];
				// console.log(form);
				var formdata = new FormData(form);
				formdata.append('action', 'update');
				formdata.append('edit_id', update_id);
				formdata.append('table', 'all_inquiry');
				$.ajax({
					method: "post",
					url: "<?= site_url('inquiry_list_updatedata'); ?>",
					data: formdata,
					processData: false,
					contentType: false,
					success: function(res) {
						if (res != "error") {
							$('.loader').hide();
							$("form[name='interested_form']").removeClass("was-validated");
							$(".interested_model_close").trigger("click");
							sweet_edit_sucess('Update successfully');
							$('.inquiry_status_submit').prop('disabled', false);
							// alert();
							follow_up(update_id);
						} else {
							$('.loader').hide();
							Swal.fire({
								title: 'Cancelled',
								text: 'Duplicate Data Not Valid',
								icon: 'error',
							})
						}
					}
				});
			} else {
				$("form[name='interested_form']").addClass("was-validated");
			}
		});
		$('body').on('click', '.log_button', function(e) {
			// alert("hl");
			$('select.selectpicker').selectpicker('refresh');
			e.preventDefault();
			var inquiry_status_type = $('.today-follow-tabs li .active').attr('data-inquiry');
			var self = $(this).closest("tr");
			var log_value = $(this).attr("data-log_id");
			var edit_page = $(".inq_pagination").find(".page-item.active .page-link").text();
			var perPageCount = $('#perPageCount').val();
			// console.log(edit_value);
			if (log_value != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('inquiry_log_show'); ?>",
					data: {
						action: 'log',
						log_id: log_value,
						table: 'inquiry_log'
					},
					success: function(res) {
						$('.loader').hide();
						if (res != "") {
							var response = JSON.parse(res);
							if (response.result == 1) {
								$('#logmodal #log_idd').html("Id : " + response.inquiry_id);
								$('#logmodal .log-box-main').html(response.inquiry_html);
							}
						}
						$('.loader').hide();
						// $('.dlt').attr('data-delete_id', response[0].id);
					},
					error: function(error) {
						$('.loader').hide();
					}
				});
			} else {
				$('.loader').hide();
				alert("Data Not Edit.");
			}
		});
		$('body').on('click', '.call-modal-tabs .nav-link', function(e) {
			var selected = $('.call-modal-tabs button.active');
			var btn_action = selected.attr('data-list');
			// console.log(btn_action);
			if (btn_action == 'list_dismissed_action') {
				$('.inquiry_status_submit').prop('disabled', false);
			} else if (btn_action == 'list_cnr_action') {
				$('.inquiry_status_submit').prop('disabled', false);
			} else if (btn_action == 'list_appointment_action') {
				// console.log("aaaa");
				if ($('.fill-interest-btn').hasClass("fill-interest-btn")) {
					// console.log("ggg");
					$('.inquiry_status_submit').prop('disabled', true);
				} else {
					// console.log("bb");
					$('.inquiry_status_submit').prop('disabled', false);
				}
			} else if (btn_action == 'list_default_action') {
				// console.log("aaaa");
				if ($('.fill-interest-btn').hasClass("fill-interest-btn")) {
					// console.log("ggg");
					$('.inquiry_status_submit').prop('disabled', true);
				} else {
					// console.log("bb");
					$('.inquiry_status_submit').prop('disabled', false);
				}
			} else {
				$('.inquiry_status_submit').prop('disabled', false);
			}
		});
		// $("button[name='booking_add_data']").click(function(e) {
		// 	// alert();
		// 	e.preventDefault();
		// 	var mobileno = $("#inquiry_all_status_update_form #mobileno").val();
		// 	var full_name = $("#inquiry_all_status_update_form #full_name").val();
		// 	var altmobileno = $("#inquiry_all_status_update_form #altmobileno").val();
		// 	var area = $("#inquiry_all_status_update_form #area").val();
		// 	var dob = $("#inquiry_all_status_update_form #dob").val();
		// 	var anni_date = $("#inquiry_all_status_update_form #anni_date").val();
		// 	var city = $("#inquiry_all_status_update_form #city").val();
		// 	var email = $("#inquiry_all_status_update_form #email").val();
		// 	var house = $("#inquiry_all_status_update_form #houseno").val();
		// 	var society = $("#inquiry_all_status_update_form #society").val();
		// 	var intrested_product = $("#inquiry_all_status_update_form #intrested_product").val();
		// 	var budget = $("#inquiry_all_status_update_form #budget").val();
		// 	var buying_as = $("#inquiry_all_status_update_form #buying_as").val();
		// 	var subscription = $("#inquiry_all_status_update_form #subscription").val();
		// 	var inquiry_type = $("#inquiry_all_status_update_form #inquiry_type").val();
		// 	var inquiry_source_type = $("#inquiry_all_status_update_form #inquiry_source_type").val();
		// 	var nxt_follow_up = $("#inquiry_all_status_update_form #nxt_follow_up").val();
		// 	var nxt_follow_up_tag = $("#inquiry_all_status_update_form #nxt_follow_up");
		// 	var next_follow_up = timeValidation(nxt_follow_up, nxt_follow_up_tag);
		// 	var approx_buy = $("#inquiry_all_status_update_form #approx_buy");
		// 	// var visit_date = $("#inquiry_all_status_update_form #visit_date").val();
		// 	// console.log(visit_date);
		// 	var inquiry_description = $("#inquiry_all_status_update_form #inquiry_description").val();
		// 	var property_type = $("#inquiry_all_status_update_form #property_sub_type").find(':selected').attr("data-property_type");
		// 	var edit_id = $('#inquiry_all_status_update_form #inquiry_all_status_update_btn').attr("data-edit_id");
		// 	var edit_page = $(".inq_pagination").find(".page-item.active .page-link").text();
		// 	// var nxtiii = $('#inquiry_all_status_update .nxtiii').show();
		// 	// if (mobileno != "" && full_name != "" && area != "" && city != "" && intrested_site != "" && budget != "" && intrested_area != "" && inquiry_type != "" && inquiry_source_type != "") {
		// 	var form = $("form[name='inquiry_all_status_update_form']")[0];
		// 	var formdata = new FormData(form);
		// 	formdata.append('table', 'all_inquiry');
		// 	// formdata.append('intrested_area_name', intrested_area_name);
		// 	// formdata.append('intersted_site_name', intersted_site_name);
		// 	// formdata.append('property_type', property_type);
		// 	// formdata.append('visit_date', visit_date);
		// 	var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
		// 	var page_number = $(".inq_pagination").find(".page-item.active .page-link").text();
		// 	var perPageCount = $('#perPageCount').val();
		// 	if (edit_id == '') {
		// 		formdata.append('action', 'insert');
		// 		$('.loader').show();
		// 		$.ajax({
		// 			method: "post",
		// 			url: "<?= site_url('inquiry_insert_data'); ?>",
		// 			data: formdata,
		// 			processData: false,
		// 			contentType: false,
		// 			success: function(res) {
		// 				var response = JSON.parse(res);
		// 				if (response.response != "0") {
		// 					$('.loader').hide();
		// 					// $("form[name='inquiry_all_status_update_form']")[0].reset();
		// 					$('.modal-close-btn').click(function() {
		// 						$('.selectpicker').selectpicker('refresh');
		// 						$('form[name="inquiry_all_status_update_form"]')[0].reset();
		// 					});
		// 					$("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
		// 					$(".modal-close-btn").trigger("click");
		// 					sweet_edit_sucess(response.message);
		// 					//$('.inq_pagination').twbsPagination('destroy');
		// 					list_data('inquiry_all_status', inquiry_status_type, page_number, perPageCount);
		// 				} else {
		// 					// $("form[name='inquiry_all_status_update_form']")[0].reset();
		// 					$("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
		// 					$(".modal-close-btn").trigger("click");
		// 					if (response.message == '') {
		// 						response.message = 'Inquiry Not Created Please check It.';
		// 					}
		// 					Swal.fire({
		// 						title: 'Cancelled',
		// 						text: response.message,
		// 						icon: 'error',
		// 					})
		// 					$('.loader').hide();
		// 				}
		// 			},
		// 		});
		// 	}
		// 	// else {
		// 	// 	var formdata = new FormData(form);
		// 	// 	formdata.append('action', 'update');
		// 	// 	formdata.append('edit_id', edit_id);
		// 	// 	formdata.append('table', 'all_inquiry');
		// 	// 	// formdata.append('intrested_area_name', intrested_area_name);
		// 	// 	// formdata.append('intersted_site_name', intersted_site_name);
		// 	// 	// formdata.append('property_type', property_type);
		// 	// 	// formdata.append('visit_date', visit_date);
		// 	// 	var inquiry_status_type = $('.today-follow-tabs li .nav-link .active').attr('data-inquiry');
		// 	// 	var perPageCount = $('#perPageCount').val();
		// 	// 	$('.loader').show();
		// 	// 	$.ajax({
		// 	// 		method: "post",
		// 	// 		url: "<?= site_url('inquiry_list_updatedata'); ?>",
		// 	// 		data: formdata,
		// 	// 		processData: false,
		// 	// 		contentType: false,
		// 	// 		success: function(res) {
		// 	// 			if (res != "error") {
		// 	// 				$('.loader').hide();
		// 	// 				$("form[name='inquiry_all_status_update_form']").removeClass("was-validated");
		// 	// 				$('.modal-close-btn').click(function() {
		// 	// 					$('form[name="inquiry_all_status_update_form"]')[0].reset();
		// 	// 				});
		// 	// 				$('#inquiry_all_status_update  .inquiry_all_status_update_btn').attr("data-edit_id", '');
		// 	// 				list_data('inquiry_all_status', inquiry_status_type, edit_page, perPageCount);
		// 	// 				$(".modal-close-btn").trigger("click");
		// 	// 				sweet_edit_sucess('Update successfully');
		// 	// 			} else {
		// 	// 				$('.loader').hide();
		// 	// 				Swal.fire({
		// 	// 					title: 'Cancelled',
		// 	// 					text: 'Duplicate Data Not Valid',
		// 	// 					icon: 'error',
		// 	// 				})
		// 	// 			}
		// 	// 		},
		// 	// 		error: function(error) {}
		// 	// 	});
		// 	// }
		// 	// } else {
		// 	// 	$("form[name='inquiry_all_status_update_form']").addClass("was-validated");
		// 	// 	var form = $("form[name='inquiry_all_status_update_form']");
		// 	// 	$(form).find('.selectpicker').each(function() {
		// 	// 		var selectpicker_valid = 0;
		// 	// 		if ($(this).attr('required') == 'undefined') {
		// 	// 			var selectpicker_valid = 0;
		// 	// 		}
		// 	// 		if ($(this).attr('required') == 'required') {
		// 	// 			var selectpicker_valid = 1;
		// 	// 		}
		// 	// 		if (selectpicker_valid == 1) {
		// 	// 			if ($(this).val() == 0 || $(this).val() == '') {
		// 	// 				$(this).closest("div").addClass('selectpicker-validation');
		// 	// 			} else {
		// 	// 				$(this).closest("div").removeClass('selectpicker-validation');
		// 	// 			}
		// 	// 		} else {
		// 	// 			$(this).closest("div").removeClass('selectpicker-validation');
		// 	// 		}
		// 	// 	});
		// 	// }
		// 	return false;
		// });
	});
	$(document).ready(function() {
		function updateCount() {
			// var count = $("input.inquiry_id[type=checkbox]:checked").length;
			// var count_all = $("input.inquiry_id[type=checkbox]").length;
			// if (count != 0) {
			// 	$(".main-select-section").show();
			// }
		}
		updateCount();
		$("#select_all").change(function() {
			$('.inquiry_id').prop('checked', this.checked);
			updateCount();
		});
		$("body").on('click', '.inquiry_id', function(e) {
			if ($(this).length == $(".inquiry_id:checked").length) {
				$("#select_all").attr("checked", "checked");
			} else {
				$("#select_all").removeAttr("checked");
			}
			updateCount();
		});
		// $(".interested_entry_form .modal-close-btn, .btn-closing").click(function() {
		// 	$(".interested_entry_form").removeClass("d-block show");
		// });
	});
	// $(".main-select-section").hide();
</script>
<!-- demo script -->
<script>
	$(document).ready(function() {
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
		$('body').on('change', '#product_plan', function(e) {
			var val = $(this).find('option:checked').attr('data-plan_price');
			var val2 = val;
			val = numberWithCommas(val);
			var price = val2;
			var percentage = 18;
			var Gst_result = parseInt(price) * (percentage / 100);
			var total_price = parseInt(price) + parseInt(Gst_result);
			if (total_price != undefined && total_price != '') {
				$("#total_price").val(total_price);
			} else {
				$("#total_price").val('');
			}
			if (price != undefined && price != '') {
				$("#price").val(price);
			} else {
				$("#price").val('');
			}
			if (Gst_result != undefined && Gst_result != '') {
				$("#gst").val(Gst_result);
			} else {
				$("#gst").val('');
			}
			// console.log(Gst_result);
		});
		// booking form
		$('body').on('click', '#booking-btn', function() {
			var booking_id = $(this).attr('data-booking_id');
			if (booking_id != "") {
				$('.loader').show();
				$.ajax({
					type: "post",
					url: "<?= site_url('all_inquiry_data_view'); ?>",
					data: {
						action: 'view',
						view_id: booking_id,
						table: 'all_inquiry'
					},
					success: function(res) {
						$('.loader').hide();
						var response = JSON.parse(res);
						// $('#view_inquery_list #id').text(response.id);
						// console.log(response);
						$('#conversion_inquery #mobileno').val(response.mobileno);
						$('#conversion_inquery #partyname').val(response.full_name);
						$('#conversion_inquery #area').val(response.area);
						$('#conversion_inquery #houseno').val(response.houseno);
						$('#conversion_inquery #society').val(response.society);
						$('.selectpicker').selectpicker('refresh');
						$('#booking_add_data').attr('data-booking_insert_id', response.id);
						$('#booking_add_data').attr('data-booking_owner_id', response.assign_id);
					},
				});
			} else {
				$('.loader').hide();
				alert("Data Not Edit.");
			}
		});
		$('body').on('click', '#booking_add_data', function() {
			// alert();
			var inquiry_status_type = $('.today-follow-tabs li .active').attr('data-inquiry');
			var insert_id = $(this).attr('data-booking_insert_id');
			var owner_id = $(this).attr('data-booking_owner_id');
			var mobileno = $('#booking_form #mobileno').val();
			var email = $('#booking_form #email').val();
			var partyname = $('#booking_form #partyname').val();
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
			var plan_price = $('#booking_form #price').val();
			var gst = $('#booking_form #gst').val();
			var total_price = $('#booking_form #total_price').val();
			var user_valid = $('#booking_form #product_plan option:selected').attr('data-add_on_user');
			// console.log(mobileno+partyname+','+houseno+','+area+','+landmark+','+country+','+state+','+city+','+pincode+','+pancard_photo+','+pancard_no+','+aadhar_card_front+','+aadhar_card_back+','+aadharno+','+customer_photo+','+project_sub_type+','+project_type+','+project_name+','+unit_number+','+unit_size+','+construction+','+amount+','+payment_date+','+remaining_amount+','+token_amount+','+token_amount_date+','+token_by+','+apx_date);
			if (
				mobileno != '' &&
				partyname != '' &&
				houseno != '' &&
				area != '' &&
				landmark != '' &&
				country != '' &&
				state != '' &&
				city != '' &&
				pincode != '' &&
				product_name != '' &&
				product_plan != '' &&
				plan_price != '' &&
				total_price != ''
			) {
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
				formdata.append('action', 'insert');
				formdata.append('table', 'booking');
				formdata.append('price', plan_price);
				formdata.append('total_price', total_price);
				formdata.append('inquiry_id', insert_id);
				formdata.append('owner_id', owner_id);
				formdata.append('email', email);
				formdata.append('mobileno', mobileno);
				formdata.append('partyname', partyname);
				formdata.append('product_plan', product_plan);
				formdata.append('user_valid', user_valid);
				formdata.append('gst', gst);
				// $('.loader').show();
				$.ajax({
					method: "post",
					url: "<?= base_url('Booking_insert'); ?>",
					data: formdata,
					processData: false,
					contentType: false,
					success: function(res) {
						var response = JSON.parse(res);
						if (response.duplicate == 0) {
							Swal.fire({
								title: 'Cancelled',
								text: response.msg,
								icon: 'error',
							})
						} else {
							if (response.not_insert == 0) {
								Swal.fire({
									title: 'Not insert',
									text: response.msg,
									icon: 'error',
								})
							} else {
								// sweet_edit_sucess(response.msg);
								iziToast.success({
									title: response.msg,
								});
								// console.log(response);
								$('.loading').hide();
								$('form[name="booking_form"]').removeClass('was-validated');
								$('form[name="booking_form"]')[0].reset();
								$('.modal-close-btn').trigger('click');
							}
						}
						list_data('all_inquiry', inquiry_status_type, 1, perPageCount);
					},
					error: function(error) {
						$('.loader').hide();
					}
				});
			} else {
				$('form[name="booking_form"]').addClass('was-validated');
				checkbox_on_change();
				var r_amount = $('#booking_form #remaining_amount').val();
				if (r_amount == 0) {
					$('.remaining_amount').html('<span style="color : green; ">amount is equal to 0</span>');
				} else {
					$('.remaining_amount').html('<span style="color : red; ">amount is not equal to 0</span>');
				}
			}
		});
		$("#conversion_inquery").on('click', '.modal-close-btn', function() {
			$('form[name="booking_form"]')[0].reset();
			$('.selectpicker').selectpicker('refresh');
			$("form[name='booking_form']").removeClass("was-validated");
			$("input[name='username']").find(".username_check").css("display", "block");
			// $("input[name='username']").removeClass("username_check");
			// $('.number-error').html('');
			// $('.email-error').html('');
		});
	});
	// $('body').on('click', '.call-reset-tab', function() {
	// 	// alert();
	// 	// $('.follow-up-active').trigger('click');
	// 	$('.callmodal #pills-tabContent').find('.tab-pane.active').removeClass('active');
	// 	$('.callmodal #pills-tabContent').find('.tab-pane.active').removeClass('show');
	// 	$('.callmodal #pills-tabContent').find('#pills-follow-up').addClass('active');
	// 	$('.callmodal #pills-tabContent').find('#pills-follow-up').addClass('show');
	// });

	// $('body').on('click', '.TargetGymQuatation', function(){
	// 	// alert();
	// 	var edit_id = $('.generate_pdf_button').attr('data_table_id');
	// 	var discount_amount = $('.discount_quatation').val();
	// 	if ($('input[name="quation_name"]:checked').length > 0) {
	// 		var checkbox_val = $('input[name="quation_name"]:checked').val();
	// 	} else {
	// 		var checkbox_val = '';
	// 	}
	// 	var arr = [];
	// 	$.each($("input[name='quation_name']:checked"), function () {
	// 		arr.push($(this).val());
	// 	});

	// 	// console.log(arr);
	// 	var user_email_q = $('.user_email_q').val();
	// 	var user_name = $('.user_name_q').val();
	// 	var check_count0 = $('input[name="quation_name"]:checked').length;
	// 	var check_count = check_count0 + 1;
	// 	$.ajax({
	// 		method: "post",
	// 		url: "<?= site_url('GymQuatationCard'); ?>",
	// 		data: {
	// 			'table': 'admin_subscription_master',
	// 			'edit_id': edit_id,
	// 			'checkbox_val': checkbox_val,
	// 			'data_user_table' : 'all_inquiry',
	// 			'all_ckeck' : arr,
	// 			user_name : user_name,
	// 			check_count : check_count,
	// 			discount_amount : discount_amount,
	// 			user_email_q : user_email_q
	// 		},
	// 		success: function (res) {
	// 			var response = JSON.parse(res);
	// 			$("#modal-close-btn-quatation").trigger("click");
	// 			$('.loader').hide();
	// 			var pdfUrl = $(this).attr('href');
	// 			setTimeout(() => {
	// 				window.open(response.file_name, '_blank'); 
	// 			}, 400);				
	// 		}
	// 	});	
	// })
	$('body').on('click', '.call-reset-tab', function() {
		// alert();
		$('.follow-up-active').trigger('click');
	});
</script>

<script>
	$('body').on('click', '.custm-up-class', function() {
		$(".custm-up-class").removeClass("task-z-index");
		$(this).addClass("task-z-index");
	});
	$('body').on('click', '.custm-up-class.task-z-index', function() {
		$(this).removeClass("task-z-index");
	});
	var main = document.querySelector('#hygtfytfuytuyv');
	var list = Sortable.create(main, {
		group: 'task-main-index',
		sort: true,
		filter: '.add-card',
		draggable: '.task-main-index',
		ghostClass: "ghost",
		dragoverBubble: true,
	});

	function initContent() {
		var dropzones = document.querySelectorAll('.task-card-main-edit');
		for (item of dropzones) {
			Sortable.create(item, {
				group: 'task-card-main-edit-box',
				sort: true,
				draggable: '.task-card-main-edit-box',
				ghostClass: "ghost",
			});
		}
	}
	initContent();
	var inputs = document.querySelectorAll('textaread');
	for (item of inputs) {
		item.addEventListener('blur', inputBlurHandler);
	}

	function inputBlurHandler(e) {
		this.classList.add('inactive');
		this.disabled = true;
		this.classList.remove('active');
		list.options.disabled = false;
	}
	var body = document.querySelector('body');
	body.addEventListener('click', bodyClickHandler);

	function bodyClickHandler(e) {
		elMouseLeaveHandler(e);
		var el = e.target;
		var isCard = el.classList.contains('task-card-main-edit-box');
		var isTitle = el.classList.contains('title');
		var isInactive = el.classList.contains('inactive');
		var isEditable = el.classList.contains('editable');
		var editing = el.classList.contains('editing');
		if (isCard && isInactive) {
			list.options.disabled = true;
			el.disabled = false;
			el.classList.remove('inactive');
			el.classList.add('active');
			el.select();
		}
		if (isTitle && isInactive) {
			list.options.disabled = true;
			el.disabled = false;
			el.classList.remove('inactive');
			el.classList.add('active');
			el.select();
		}
		if (isEditable && !editing) {
			el.contentEditable = true;
			el.focus();
			document.execCommand('selectAll', false, null);
			el.addEventListener('blur', elBlurHandler);
			el.addEventListener('keypress', elKeypressHandler);
			el.classList.add('editing');
			if (el.parentElement.className === 'add-list') {
				el.parentElement.className = 'list initial';
			}
		}
	}

	function elKeypressHandler(e) {
		if (e.keyCode === 13) {
			e.preventDefault();
			e.target.blur();
		}
		var el = e.target;
		if (el.classList.contains('add-card')) {
			el.classList.add('pending');
		}
		if (el.parentElement.className === 'list initial') {
			el.parentElement.className = 'list pending';
		}
		// el.removeEventListener('keypress', elKeypressHandler);
	}

	function elBlurHandler(e) {
		var el = e.target;
		el.contentEditable = false;
		el.classList.remove('editing');
		if (el.classList.contains('pending')) {
			el.className = 'card removable editable';
			var newEl = document.createElement('div');
			newEl.className = 'add-card editable';
			var text = document.createTextNode('Add another card');
			newEl.appendChild(text);
			el.parentNode.appendChild(newEl);
			el.parentNode.querySelector('.task-card-main-edit').appendChild(el);
		}
		if (el.parentElement.className === 'task-main-index initial') {
			el.parentElement.className = 'add-list';
		}
		if (el.parentElement.className === 'task-main-index pending') {
			el.parentElement.className = 'task-main-index';
			el.className = 'title removable editable';
			var newContent = document.createElement('div');
			newContent.className = 'content';
			el.parentElement.appendChild(newContent);
			var newEl = document.createElement('div');
			newEl.className = 'add-card editable';
			var text = document.createTextNode('Add another card');
			newEl.appendChild(text);
			el.parentNode.appendChild(newEl);
			document.querySelector('#hygtfytfuytuyv').appendChild(el.parentElement);
			initContent();
			var addList = document.createElement('div');
			addList.className = 'add-list';
			var title = document.createElement('div');
			title.className = 'title editable';
			var text = document.createTextNode('Add another list');
			title.appendChild(text);
			addList.appendChild(title);
			document.querySelector('body').appendChild(addList);
		}
		initDelete();
	}

	function initDelete() {
		var editables = document.querySelectorAll('.editable');
		for (item of editables) {
			item.addEventListener('mouseenter', elMouseEnterHandler);
			item.addEventListener('mouseleave', elMouseLeaveHandler);
		}
	}
	initDelete();

	function elMouseEnterHandler(e) {
		var el = e.target;
		var isRemovable = el.classList.contains('removable');
		if (isRemovable) {
			var del = document.createElement('hdsgf');
			del.className = 'del';
			del.innerHTML = '&times;';
			el.appendChild(del);
			el.addEventListener('click', deleteHandler);
		}
	}

	function elMouseLeaveHandler(e) {
		var del = e.target.querySelector('hdsgf');
		if (del) e.target.removeChild(del);
	}

	function deleteHandler(e) {
		var parent = e.target.parentElement;
		if (parent.classList.contains('task-card-main-edit-box')) {
			parent.parentElement.removeChild(parent);
		}
		if (parent.classList.contains('title')) {
			parent.parentElement.parentElement.removeChild(parent.parentElement);
		}
	}


	function getCountry() {
		var cntHtml = '<option value="">Select country</option>';
		fetch("https://www.universal-tutorial.com/api/getaccesstoken", {
				method: "GET",
				headers: {
					"Accept": "application/json",
					"api-token": "2aypO0PaCgLrhfrVlKCjxYchDBCqVdgWo3mLxZiAKxFogT0ihKkJwis_Vxv_BZBxROE",
					"user-email": "foramsavaliya98@gmail.com"
				}
			})
			.then(response => {
				if (!response.ok) {
					throw new Error('Network response was not ok');
				}
				return response.json();
			})
			.then(data => {
				var authToken = data.auth_token;
				// console.log(authToken);

				fetch("https://www.universal-tutorial.com/api/countries/", {
						method: "GET",
						headers: {
							"Authorization": "Bearer " + authToken,
							"Accept": "application/json"
						}
					})
					.then(response => {
						if (!response.ok) {
							throw new Error('Network response was not ok');
						}
						return response.json();
					})
					.then(data => {
						data.forEach(country => {
							cntHtml += '<option value="' + country.country_name + '">' + country.country_name + '</option>';
							// console.log('Country Name:', country.country_name);
						});
						$('#countryId').html(cntHtml);
					})
					.catch(error => {
						console.error('There was a problem with the fetch operation:', error);
					});
			})
			.catch(error => {
				console.error('There was a problem with the fetch operation:', error);
			});
	}

	// $('body').on('change', '#booking_add_data .countries', function() {
	// 	alert('hiiiii');
	// 	var cntHtml = ''; 

	// });
</script>