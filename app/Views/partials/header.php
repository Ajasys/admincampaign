<!DOCTYPE html>

<html lang="en">

<head>
   <?= $this->include('partials/head-css') ?>
</head>

<?php 
$getchild = '';
$getchild = getChildIds($_SESSION['id']);

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
	$userCon = '';
} else {
	if (!empty($getchild)) {
		$getchilds = "'" . implode("', '", $getchild) . "'";
	} else {
		$getchilds = "'" . $_SESSION['id'] . "'";
	}
	$userCon = "  AND (id=" . $_SESSION['id'] . "  OR  id IN (" . $getchilds . "))";
}
	$username = session_username($_SESSION['username']);
    $db_connection = \Config\Database::connect('second');
	

	$user_query = "SELECT * FROM " . $username . "_user WHERE switcher_active = 'active' " . $userCon . " ORDER BY id DESC";
	$user_result = $db_connection->query($user_query);
	$task_user = $user_result->getResultArray();

	$status_query = "SELECT * FROM " . $username . "_task_status ORDER BY id ASC";
	$status_result = $db_connection->query($status_query);
	$task_status = $status_result->getResultArray();
?>


<body class="verticalmenu">



   <div class="loader">

      <div class="ring"></div>

      <span class="loader-span">loading...</span>

   </div>



   <header class="header main-dashbord shadow-sm">

      <ul class="position-absolute model-bell p-0 p-3 rounded-2 d-none">

         <div class="content-bell mb-3">

            <h6>notification</h6>

         </div>

         <div class="data_html_notification">

         </div>

      </ul>

      <div class="nav-header d-flex justify-content-between">

         <div class="col-xl-6 left_side d-flex align-items-center">

            <i class="bx bx-menu fs-5 pe-3 cursor-pointer list_btn sidebarToggle"></i>

            <div class="col-12 bg-white search-box position-absolute top-100 start-0 d-none d-lg-block position-lg-relative">

               <div class="position-relative my-2 my-lg-0">

                  <input type="number" pattern="/^-?\d+\.?\d*$/" id="global_search_input" placeholder="search..."

                     class="search-boxs" onkeypress="if(this.value.length==10) return false;">

                  <i class="bi bi-search search_icon"></i>

               </div>

            </div>

         </div>

         <div class="col-xl-6 right_side d-flex align-items-center justify-content-end">

            <div class="search_bar d-block d-lg-none">

               <button class="max-btn bell-icon mx-3"><i class="bi bi-search"></i></button>

            </div>

            <div class="ton_btn text-center">

               <button type="button" class="position-relative max-btn bell-icon remider" id="btn" role="button">

                  <i class="bi bi-bell"></i>

                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill inqq_cunt bg-danger">

                     0

                  </span>

               </button>

            </div>

            <div class="right_side_username mx-3">

               <?php

               $username = '';

               if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

                  if (isset($_SESSION['name'])) {

                     $username = $_SESSION['name'];

                     $user_data = user_id_to_full_user_data(0);

                  }

               } else {

                  if (isset($_SESSION['firstname'])) {

                     $username = $_SESSION['firstname'];

                     $user_data = user_id_to_full_user_data($_SESSION['id']);

                  }

               }

               ?>



               <h6 class="fs-7">

                  <?php echo $username; ?>

               </h6>

            </div>

            <div class="person_img d-flex align-items-center me-3">

               <div class="btn-group text-capitalize">

                  <button class="max-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                     <img src="<?php if (isset($user_data['profile_pic']) && !empty($user_data['profile_pic'])) { ?><?= base_url('assets/images/user_profile_pic/' . $user_data['profile_pic']) ?> <?php } else { ?><?= base_url('assets/images/h-user-theme-m.svg') ?><?php } ?>"

                        id="profile_img" class="rounded-circle" alt="">

                  </button>

                  <ul class="dropdown-menu login_btn">

                     <li class="dropdown-item">

                        <a href="#" class="person_a">

                           <i class="bi bi-lock me-3"></i>

                           lock screen

                        </a>

                     </li>

                     <li class="dropdown-item">

                        <a href="<?= base_url(); ?>profile" class="person_a">

                           <button type="button" class="btn outline-0 border-0 p-0">

                              <i class="bi bi-person-add me-3"></i>

                              <span>User Profile</span>

                           </button>

                        </a>

                     </li>

                     <li class="dropdown-item border-top color">

                        <a href="/logout" class="text-danger" class="person_a">

                           <i class="bi bi-power me-3 "></i>

                           logout

                        </a>

                     </li>

                     <li class="dropdown-item border-top color">

                        <form method="POST" action="" id="dayEndForm">

                           <a href="javascript:void(0)" class="text-danger text-center" class="person_a">

                              <button type="submit" class="border-0 bg-transparent" name="attendance"

                                 id="attendance">Day End</button>

                           </a>

                        </form>

                     </li>

                  </ul>

               </div>

            </div>

         </div>

      </div>

   </header>

   <div class="offcanvas off-canva offcanvas-end profile_view" tabindex="1" id="user"

      aria-labelledby="offcanvasRightLabel">

      <div class="offcanvas-header">

         <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>

         <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

      </div>

      <div class="offcanvas-body">

         <div class="view_photo-icon d-flex justify-content-center">

            <i class="bi bi-person-circle"></i>

         </div>

         <div class="view-booking-content-main">

            <div class="view-profile-booking-content d-flex justify-content-between align-items-center mb-2">

               <h5>206</h5>

               <p>my booking</p>

            </div>

            <div class="view-profile-booking-content d-flex justify-content-between align-items-center">

               <h5>22566</h5>

               <p>my visit</p>

            </div>

         </div>

      </div>

   </div>

   <div class="modal fade task-add" id="task-add" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<input type="hidden" id="isheader" name="isheader">
			<form class="needs-validation w-100" novalidate name='add_form' id="add_form" method="post">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title showtitle"></h1>
						<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
							<i class="fi fi-rr-cross-circle fs-5"></i>
						</button>
					</div>
					<div class="modal-body modal-body-secondery">
						<h6 class="modal-body-title main_title"></h6>
						<div class="modal-body-card">
							<div class="col-md-4 col-12">
								<h6 class="modal-body-title">Type <sup class="validationn">*</sup></h6>
								<div class="main-selectpicker">
									<select id="task_type" placeholder="Enter Subject" name="task_type"
										class="selectpicker form-control form-main main-control" data-live-search="true"
										required="" tabindex="-98">
										<option value="1">Task</option>
										<option value="2">Meeting</option>
										<option value="3">Reminder</option>
									</select>
								</div>
							</div>
							<div class="col-md-8 col-12">
								<h6 class="modal-body-title">Subject <sup class="validationn">*</sup></h6>
								<input type="text" class="form-control main-control main-controlmy_subject" id="subject"
									name="subject" placeholder="Enter Subject" required>
							</div>
							<div class="col-md-6 col-lg-4 col-12 px-2">
								<h6 class="modal-body-title">Priority <sup class="validationn">*</sup></h6>
								<div class="main-selectpicker">
									<select id="priority" placeholder="Enter Subject" name="priority"
										class="selectpicker form-control form-main main-control" data-live-search="true"
										required="" tabindex="-98" required>
										<option value="">Select Priority</option>
										<option value="High" data-color-code="#eb5a46">High</option>
										<option value="Low" data-color-code="#00c2e0">Low</option>
										<option value="Medium" data-color-code="#61bd4f">Medium</option>
										<option value="Urgent" data-color-code="#c377e0">Urgent</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-lg-4 col-12 px-2">
								<h6 class="modal-body-title">Assign To <sup class="validationn assign">*</sup></h6>
								<div class="main-selectpicker">
									<select name="assignto" id="assignto" placeholder="Enter Subject"
										class=" selectpicker secound_selectpicker form-control form-main main-control assignto_edit"
										data-live-search="true" required="" tabindex="-98" required>
										<?php

										if (isset($task_user)) {
											foreach ($task_user as $user_key => $user_value) {
												$selected = '';
												if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && $user_value['id'] == $_SESSION['admin']) {
													$selected = $user_value["id"] == 1 ? 'selected' : ''; // If user ID is 1, set selected
												} elseif (isset($_SESSION['id']) && $user_value['id'] == $_SESSION['id']) {
													$selected = 'selected'; // Logged-in user is selected
												} else {
													$selected = ''; // Default, not selected
												}
												echo '<option value="' . $user_value["id"] . '" ' . $selected . ' >' . $user_value["firstname"] . '</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-lg-4 col-12 px-2">
								<h6 class="modal-body-title">Status <sup class="validationn status ">*</sup></h6>
								<div class="main-selectpicker">
									<select id="status" placeholder="Enter Subject" name="status"
										class=" selectpicker secound_selectpicker form-control form-main main-control edit_stuts"
										data-live-search="true" required="" tabindex="-98" required>
										<?php
										if (isset($task_status)) {
											foreach ($task_status as $type_key => $type_value) {
												echo '<option value="' . $type_value["id"] . '">' . $type_value["title"] . '</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-12 px-2 my-2 task_switch_button">
								<div class="d-flex align-items-center ">
									<label class="switch_toggle_primary">
										<input class="toggle-checkbox" type="checkbox" id="task_switch_button">
										<span class="check_input_primary round"></span>
									</label>
									<p class="mx-2 fw-medium">Recursive</p>
								</div>
							</div>
							<div class="col-md-6 col-12 task-toggle1 px-2">
								<h6 class="modal-body-title">Start Date <sup class="validationn">*</sup></h6>
								<input type="text" name="start_date" id="start_date"
									class="form-control main-control r1-startdate start-task" placeholder="Start date"
									required>
							</div>
							<div class="col-md-6 col-12 task-toggle1 px-2">
								<h6 class="modal-body-title">End Date <sup class="validationn">*</sup></h6>
								<input type="text" name="end_date" id="end_date"
									class="form-control main-control r2-enddate end-start-task" placeholder="End date"
									required>
							</div>
							<div class="col-md-4 task-toggle2 col-12 px-2">
								<h6 class="modal-body-title">Recursion Type <sup class="validationn">*</sup></h6>
								<div class="main-selectpicker">
									<select id="recursive_type" name="recursive_type" placeholder="Enter Subject"
										class="selectpicker form-control form-main main-control recursion_type task_model_drop_down"
										data-live-search="true" required="" tabindex="-98" required>
										<option selected="" value="">Select RecursiveType</option>
										<option value="1">Once</option>
										<option value="2">Daily</option>
										<option value="3">Weekly</option>
										<option value="4">Monthly</option>
										<option value="5">Yearly</option>
									</select>
								</div>
							</div>
							<div class="task-toggle2 toggle_3 col-md-4 px-2">
								<div class="col-md-12 col-12 Once donotshow input-text input-text_1 input-text_2"
									id="once_date_default">
									<h6 class="modal-body-title">Date <sup class="validationn">*</sup></h6>
									<input type="text" name="once_date" id="once_date"
										class="form-control main-control e-start-task" placeholder="Select date"
										required>
								</div>
								<div class="col-md-12 col-12 Weekly week donotshow input-text input-text_3">
									<h6 class="modal-body-title">Selected weekly <sup class="validationn">*</sup></h6>
									<div class="main-selectpicker">
										<select name="weekly_name" id="weekly_name" placeholder="Enter Subject"
											class="selectpicker form-control main-control form-main weekly_name"
											data-live-search="true" required="" tabindex="-98" required>
											<option  value="">Please select week..</option>
											<option value="Monday">Monday</option>
											<option value="Tuesday">Tuesday</option>
											<option value="Wednesday">Wednesday</option>
											<option value="Thursday">Thursday</option>
											<option value="Friday">Friday</option>
											<option value="Saturday">Saturday</option>
											<option value="Sunday">Sunday</option>
										</select>
									</div>
								</div>
								<div class="col-md-12 col-12 Monthly donotshow input-text input-text_4">
									<h6 class="modal-body-title">Date <sup class="validationn">*</sup></h6>
									<input type="text" name="monthly_date" id="monthly_date"
										class="form-control main-control e-start-task" placeholder="Select Date"
										required>
								</div>
								<div class="col-md-12 col-12 year donotshow input-text input-text_5">
									<h6 class="modal-body-title">Date <sup class="validationn">*</sup></h6>
									<input type="text" name="yearly_date" id="yearly_date"
										class="form-control main-control e-start-task" placeholder="Select Date"
										required>
								</div>
							</div>
							<div class="task-time col-md-4 px-2">
								<div class="col-md-12 col-12 input-text input-text_5">
									<h6 class="modal-body-title">Time <sup class="validationn">*</sup></h6>
									<input type="text" name="daily_time" id="daily_time"
										class="form-control main-control daily-time" placeholder="Select Time" required>
								</div>
							</div>
							<div class="col-12 px-2">
								<h6 for="form-task-description" class="modal-body-title">Description</h6>
								<div id="editor_add"></div>
							</div>
							<div class="file_view_add w-100 bg-white" id="file_view_add">
							</div>
							<div id="file_uploded" class="file_uploded px-2"> </div>
							<div class="col-12 px-2">
								<h6 for="select_photo" class="modal-body-title fs-14">Attachment (optional)</h6>
								<div class="upload-btn-wrapper col-12">
									<div class="file-btn col-12  ">
										<div class="col-12 justify-content-center d-flex">
											<i class="bi bi-cloud-download"></i>
										</div>
										<div class="col-12 justify-content-center d-flex">
											<h4>Drop Files here or click to upload</h4>
										</div>
										<div class="col-12 justify-content-center d-flex">
											<p>Allowed IMAGES, VIDEOS, PDF, DOC, EXCEL, PPT, TEXT</p>
										</div>
										<div class="col-12 justify-content-center d-flex">
											<p>Max 5 files and max size of 3 MB</p>
										</div>
									</div>
									<input class="form-control main-control" id="attachment" name="attachment[]"
										multiple type="file" placeholder="" />
								</div>
							</div>
							<div class="col-12 is-email-div">
								<div class="row mt-2">
									<div class="col-12 col-sm-5 input-text d-flex align-items-center">
										<label class="switch_toggle_primary mb-1 me-2">
											<input class="toggle-checkbox is_email_automation" type="checkbox" value="1"
												name="is_email_automation" id="is_email_automation">
											<div class="check_input_primary round" id="toggle-switch1"></div>
										</label>
										<span>Email Automation</span>
									</div>
									<div class="col-12 col-sm-7 input-text">
										<div class="text-email">
											<label for="meeting_customer_email"
												class="form-label main-label fw-medium">Email <sup
													class="validationn">*</sup></label>
											<input type="text" class="form-control mb-0" id="customer_email"
												name="customer_email" placeholder="Enter Email" required>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 mt-3 is-email-div">
								<div class="row">
									<div class="col-12 col-sm-5 input-text d-flex align-items-center">
										<label class="switch_toggle_primary mb-1 me-2">
											<input class="toggle-checkbox is_whatsapp_automation" type="checkbox"
												value="1" name="is_whatsapp_automation" id="is_whatsapp_automation">
											<div class="check_input_primary round" id="toggle-switch3"></div>
										</label>
										<span>Whatsapp Automation</span>
									</div>
									<div class="col-12 col-sm-7 input-text">
										<div class="text3">
											<label for="meeting_customer_mobile"
												class="form-label main-label fw-medium">
												Mobile No.<sup class="validationn">*</sup></label>
											<input type="text" class="form-control mb-0" id="customer_mobile"
												name="customer_mobile" placeholder="Enter Mobile">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn-secondary cancle" id="cancle_btn" data-bs-dismiss="modal"
							data-delete_id="">Cancel</button>
						<button class="btn-primary add" id="save_btn_task" data-edit_id="">Add</button>
						<button type="button" id="task_delete" class="btn-primary task_delete"
							data-bs-dismiss="modal">Delete</button>
						<button type="button" class="btn-primary" id="update_button" data-edit_id="">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>

   <main>



      <script>

		$(document).ready(function () {
			// $('#task_table').DataTable();

			$('.start-task').bootstrapMaterialDatePicker({
				format: 'DD-MM-YYYY h:mm A', // Include time in 24-hour format
				cancelText: 'cancel',
				okText: 'ok',
				clearText: 'clear',
			})

			$('.end-start-task').bootstrapMaterialDatePicker({
				format: 'DD-MM-YYYY h:mm A', // Include time in 24-hour format
				cancelText: 'cancel',
				okText: 'ok',
				clearText: 'clear',
			});

		});

         // document.getElementById("dayEndForm").addEventListener("submit", function(event) {



         // });

         document.getElementById("dayEndForm").addEventListener("submit", function (event) {

            // alert("hello")

            event.preventDefault(); // Prevent the default form submission behavior

            var id = <?= isset($_SESSION['id']) ?>;

            Swal.fire({

               title: 'Are you sure?',

               text: "You won't be able to revert this!",

               icon: 'warning',

               showCancelButton: true,

               confirmButtonText: 'Yes, Day Off it!',

               cancelButtonText: 'No, cancel!',

               confirmButtonClass: 'btn btn-success mt-2',

               cancelButtonClass: 'btn btn-danger ms-2 mt-2',

               buttonsStyling: false,

            }).then((result) => {
               $.ajax({
                  url: "<?= base_url('day_end_update'); ?>",
                  method: "post",
                  data: {
                     action: 'cancle',
                     id: id,
                     table: 'attandance'
                  },
                  // processData: false,

                  // contentType: false,

                  success: function (res) {
                     var response = JSON.parse(res);
                     if (response.response == 1) {
                        $('.loader').hide();
                        iziToast.success({
                           title: response.msg
                        });
                        var url = "<?= base_url('/logout'); ?>";
                        ///$(location).attr('href', url);
                        setTimeout(() => {
                           $(location).attr('href', url);
                        }, 1000);
                     } else {
                        iziToast.error({
                           title: response.msg
                        });
                     }
                  }
               });
            });
         });

		 $('body').on('click', '#plus_btn', function () {
			taskType();
		 });
		 
         function taskType(taskTypeId) {
			// Reset form and refresh selectpicker
			$("form[name='add_form']")[0].reset();
			$('.selectpicker').selectpicker('refresh');

			// Remove validation classes and reset visibility
			$("form[name='add_form']").removeClass("was-validated");
			$('.selectpicker').closest('div').removeClass('selectpicker-validation');
			$('.task-toggle2,.text-email,.text3,.task-time,.is-email-div').hide();

			// Enable task_type dropdown and uncheck checkboxes
			// $('#task_type').prop('disabled', false);
			$('.check_input_primary, #is_email_automation, #is_whatsapp_automation').prop('checked', false);

			// Remove elements and reset content
			$('#u_btn').remove();
			$('.task-add .ck-content').html('');
			$('#file_view_add').html('');
			$('#task_delete,#update_button,.donotshow').hide();
			$('#task_switch_button').prop('checked', false);

			// Set task_type value, refresh selectpicker, and disable task_type
			$('select[name=task_type]').val(taskTypeId);
			$('.selectpicker').selectpicker('refresh');
			// $('#task_type').prop('disabled', true);
			$('#isheader').val(1);

			// Handle visibility based on taskTypeId
			if (taskTypeId == 1) {
				$('.task_switch_button').show();
				$(".task_switch_button").prop('checked', false);
				$('.task-time,.task-toggle2,.is-email-div').hide();
				$('.task-toggle1').show();
			} else {
				$('.task_switch_button').hide();
				$('.task-toggle2,.is-email-div').show();
				$('.task-toggle1,.task-time').hide();
			}

			// // Handle validation based on taskTypeId
			// if (taskTypeId == 3) {
			//     $('#assignToSup').hide(); // Hide the validation sup element
			//     $('#assignto').removeAttr('required'); // Remove the required attribute
			// } else {
			//     $('#assignToSup').show(); // Show the validation sup element
			//     $('#assignto').attr('required', 'required'); // Add the required attribute
			// }
		}
			// });

		$(".toggle_3 .input-text").hide();
		$(".recursion_type").change(function () {
			var text = $(this).val();
			$(".toggle_3 .input-text").hide();
			$(".toggle_3 .input-text_" + text + "").show();
			if (text == "2") {
				$("#once_date_default").closest(".task-toggle2.toggle_3").hide();
				$('.task-time').show();
				$('.Once').hide();
			}
			else if (text == "3") {
				$("#once_date_default").closest(".task-toggle2.toggle_3").show();
				$('.task-time').show();
				$('.Once').hide();
			}
			else {
				$("#once_date_default").closest(".task-toggle2.toggle_3").show();
				$('.task-time').hide();
			}
		});

		$(".switch_toggle_primary").click(function () {
			var ytfdcgyh = this;
			var taskType = $('#task_type').val();
			if ($(ytfdcgyh).find("#task_switch_button").prop('checked')) {
				$('.task-toggle2').show();
				$('.task-toggle1').hide();
				$('.task-time').hide();
			} else {
				if (taskType == 1) {
					$('.task-toggle1').show();
					$('.task-time,.task-toggle2').hide();
				} else {
					$('.task-toggle2').show();
				}
			}
		});

		var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
		$("#attachment").change(function () {
			for (i = 0; i < this.files.length; i++) {
				var file = this.files[i];
				var fileType = file.type;
				if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
					$("#file").val('');
					return false;
				}
			}
		});

		$('#attachment').on('change', function () {
			var files = $(this).prop('files');
			$(this).closest(".modal").find("#file_view_add").addClass("border rounded-2 shadow mx-2 my-2")
			for (var i = 0; i < files.length; i++) {
				var fileName = files[i].name;
				$(this).closest(".modal").find('#file_view_add').append('<div class="border-bottom px-3 py-2 d-flex align-items-center justify-content-between" id="u_btn"><div class="d-flex align-items-center"><div class="me-3"><img src="<?php echo base_url() ?>assets/images/task_attachment/' + fileName + '" alt="" width="28" height="28" class="object-fit-cover"></div><div><p class="text-gray ff-second fs-14 fw-light mb-0">' + fileName + '</p></div></div><div class="p-2 border border-danger rounded-2 ms-auto cursor-pointer" id="file_crodd_btn1"><i class="bi bi-x fs-14 text-danger d-flex"></i></div></div>')
			}
		});

		function isEmpty(el) {
			return !$.trim(el.html())
		}

		$('body').on('click', '#file_crodd_btn1', function () {
			$(this).closest('#u_btn').remove();
			if (isEmpty($('#file_view_add'))) {
				$("#file_view_add").removeClass("border rounded-2 shadow mx-2 my-2");
			}
		});

        //task  add to header
		$('#save_btn_task').on('click', function (e) {
			e.preventDefault();
			$('#task_type').prop('disabled', false);
			var form = $("form[name='add_form']")[0];
			var formData = new FormData(form);
			if ($('#task_type').val() == 1) {
				var is_recursive = "";
				if ($('#task_switch_button').is(':checked')) {
					is_recursive = 1;
				} else {
					is_recursive = 0;
				}
				formData.append('is_recursive', is_recursive);
			} else {
				var is_email_automation = "";
				if ($('#is_email_automation').is(':checked')) {
					is_email_automation = 1;
				} else {
					is_email_automation = 0;
				}
				var is_whatsapp_automation = "";
				if ($('#is_whatsapp_automation').is(':checked')) {
					is_whatsapp_automation = 1;
				} else {
					is_whatsapp_automation = 0;
				}
				formData.append('is_email_automation', is_email_automation);
				formData.append('is_whatsapp_automation', is_whatsapp_automation);
			}
			var attachment = $('#attachment').prop('files')[0];
			var description = $('.task-add .ck-content').html();
			var pText_add = "";
			$("#u_btn p").each(function () {
				pText_add += $(this).text().trim() + ",";
			});
			pText_add = pText_add.slice(0, -1);
			var priority_color = $('#priority').find(':selected').attr('data-color-code');
			formData.append('priority_color', priority_color);
			formData.append('pText_add', pText_add);
			formData.append('description', description);

			if (($('#subject').val() != "" && $('#priority').val() != "" && $('#assignto').val() != "" && $('#status').val() != "")) {
				formData.append('table', 'tasks');
				formData.append('action', 'insert');
				$.ajax({
					method: "POST",
					url: 'task_insert_data',
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {
						// if ($('#isheader').val() == 1) {
						// 	window.location.href = '<?= site_url('task'); ?>';
						// } else {
							list_data_s();
						// }
						iziToast.success({
							title: 'Add Successfully added',
							message: ''
						});
						$('.task-add').modal('hide');
					}
				});
				$('#task-add').modal('hide');
			} else {
				$("form[name='add_form']").addClass("was-validated");
				$("form[name='add_form']").find('.selectpicker').each(function () {
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

      </script>