<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php $department = json_decode($department, true); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/jquery.nestable.css') ?>">
<!------------------------- Header End ------------------------------->
<!---------------------------- User Admin Role Start -------------------------------->
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="title-1">
                    <h2>User Role</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn-primary-rounded">
                        <i class="bi bi-plus add-panel-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <form id="add-item">
                <div class="d-flex flex-wrap justify-content-start align-items-end">
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                        <label class="main-label">Add User role</label>
                        <input type="text" class="form-control main-control" id="user_role" name="user_role"
                            placeholder="User Role">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                        <label class="main-label">Add User role</label>
                        <div class="main-selectpicker">
                            <select name="department" id="department" class="selectpicker form-control form-main select"
                                data-live-search="true">
                                <option class="dropdown-item" data-department_id="0" value="">Select Action</option>
                                <?php foreach ($department as $key => $value) { ?>
                                    <option class="dropdown-item" data-department_id="<?php echo $value['id'] ?>"
                                        value="<?php echo $value['id'] ?>">
                                        <?php echo $value['shortdepartmentname']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 px-2">
                        <button class="btn-primary" name="inquirystatus_add" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <div class="dd mb-2" id="nestable"></div>
            <form name="userrole">
                <input type="hidden" id="nestable-output" name="user_role_list">
                <button class="btn-primary" type="submit" name='userrole'>Save Menu</button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="Userrole_access" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
    <div class="modal-dialog user-admin-role">
        <div class="modal-content">
            <form class="needs-validation" name="master_user_role_update_form" method="POST" novalidate>
                <div class="modal-header">
                    <h1 class="modal-title">Edit User Role</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="assign_pages">
                    <div class="row g-2">
                        <div class="col-md-12  d-flex column-width-bottom">
                            <ul class="treeview mb-0 w-100">
                                <li id="li_1" class="contains-items">
                                    <div class="checkbox">
                                        <input id="dashboard_sectioncheck" type="checkbox"
                                            value="dashboard_sectioncheck" name="access[]">
                                        <label for="dashboard_sectioncheck">
                                            Dashboard
                                        </label>
                                    </div>
                                    <ul class="role_ul dashboardcheckshow row sub-check" id="dashboardcheckshow"
                                        style="display: none;">
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_today_task" type="checkbox"
                                                    value="dashbord_today_task" name="access[]">
                                                <label for="dashbord_today_task">Today Task</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_broker_details" type="checkbox"
                                                    value="dashbord_broker_details" name="access[]">
                                                <label for="dashbord_broker_details">Broker count</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_investor_details" type="checkbox"
                                                    value="dashbord_investor_details" name="access[]">
                                                <label for="dashbord_investor_details">Investor count</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_customer_details" type="checkbox"
                                                    value="dashbord_customer_details" name="access[]">
                                                <label for="dashbord_customer_details">Customer count</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_chat_table" type="checkbox"
                                                    value="dashbord_chat_table" name="access[]">
                                                <label for="dashbord_chat_table">Chart table</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_followups_section" type="checkbox"
                                                    value="dashbord_followups_section" name="access[]">
                                                <label for="dashbord_followups_section"> Follow ups Section </label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_activity_section" type="checkbox"
                                                    value="dashbord_activity_section" name="access[]">
                                                <label for="dashbord_activity_section"> Activity list </label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_status_wise_in" type="checkbox"
                                                    value="dashbord_status_wise_in" name="access[]">
                                                <label for="dashbord_status_wise_in">Status Wise Inquiry</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_pending_followup" type="checkbox"
                                                    value="dashbord_pending_followup" name="access[]">
                                                <label for="dashbord_pending_followup">Pending followup list</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_demo_list" type="checkbox"
                                                    value="dashbord_demo_list" name="access[]">
                                                <label for="dashbord_demo_list">Demo list</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_lead_quality" type="checkbox"
                                                    value="dashbord_lead_quality" name="access[]">
                                                <label for="dashbord_lead_quality">Lead Quality Report</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_lead_statistics" type="checkbox"
                                                    value="dashbord_lead_statistics" name="access[]">
                                                <label for="dashbord_lead_statistics">Lead Statistics Report</label>
                                            </div>
                                        </li>
                                        <li class="li_1 col-lg-4">
                                            <div class="checkbox">
                                                <input id="dashbord_daily_report" type="checkbox"
                                                    value="dashbord_daily_report" name="access[]">
                                                <label for="dashbord_daily_report">Daily Report</label>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="taskcheck" type="checkbox" value="taskcheck" name="access[]">
                                        <label id="task">Task Management</label>
                                    </div>
                                    <ul class="role_ul taskcheckshow row sub-check" id="taskcheckshow"
                                        style="display: none;">
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="task_manage" type="checkbox" value="task_manage"
                                                    name="access[]">
                                                <label for="task_manage"> Task</label>
                                            </div>
                                            <ul class="role_ul full_width task_manage_child_show sub-check"
                                                id="task_manage_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="task_manage_child_view_access" type="checkbox"
                                                            value="task_manage_child_view_access" name="access[]">
                                                        <label for="task_manage_child_view_access">View access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="task_manage_child_edit_access" type="checkbox"
                                                            value="task_manage_child_edit_access" name="access[]">
                                                        <label for="task_manage_child_edit_access">Edit access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="task_manage_child_delete_access" type="checkbox"
                                                            value="task_manage_child_delete_access" name="access[]">
                                                        <label for="task_manage_child_delete_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="metting" type="checkbox" value="metting" name="access[]">
                                                <label for="metting">Meeting</label>
                                            </div>
                                            <ul class="role_ul full_width meeting_child_show sub-check"
                                                id="meeting_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="meeting_child_view_access" type="checkbox"
                                                            value="meeting_child_view_access" name="access[]">
                                                        <label for="meeting_child_view_access">View access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="meeting_child_edit_access" type="checkbox"
                                                            value="meeting_child_edit_access" name="access[]">
                                                        <label for="meeting_child_edit_access">Edit access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="meeting_child_delete_access" type="checkbox"
                                                            value="meeting_child_delete_access" name="access[]">
                                                        <label for="meeting_child_delete_access">Delete access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="reminder" type="checkbox" value="reminder" name="access[]">
                                                <label for="reminder">Reminder</label>
                                            </div>
                                            <ul class="role_ul full_width reminder_child_show sub-check"
                                                id="reminder_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="reminder_child_view_access" type="checkbox"
                                                            value="reminder_child_view_access" name="access[]">
                                                        <label for="reminder_child_view_access">View access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="reminder_child_edit_access" type="checkbox"
                                                            value="reminder_child_edit_access" name="access[]">
                                                        <label for="reminder_child_edit_access">Edit access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="reminder_child_delete_child_access" type="checkbox"
                                                            value="reminder_child_delete_child_access" name="access[]">
                                                        <label for="reminder_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="notes" type="checkbox" value="notes" name="access[]">
                                                <label for="notes">Notes</label>
                                            </div>
                                            <ul class="role_ul full_width notes_child_show sub-check"
                                                id="notes_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="notes_child_view_access" type="checkbox"
                                                            value="notes_child_view_access" name="access[]">
                                                        <label for="notes_child_view_access">View access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="notes_child_edit_access" type="checkbox"
                                                            value="notes_child_edit_access" name="access[]">
                                                        <label for="notes_child_edit_access">Edit access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="notes_child_delete_child_access" type="checkbox"
                                                            value="notes_child_delete_child_access" name="access[]">
                                                        <label for="notes_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="mastercheck" type="checkbox" value="mastercheck" name="access[]">
                                        <label for="mastercheck">Master</label>
                                    </div>
                                    <ul class="role_ul mastercheckshow row sub-check" id="mastercheckshow"
                                        style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="subscription_management" type="checkbox"
                                                    value="subscription_management" name="access[]">
                                                <label for="subscription_management">Subscription Master</label>
                                            </div>
                                            <ul class="role_ul full_width subscription_management_child_show sub-check"
                                                id="subscription_management_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="subscription_management_child_view_access"
                                                            type="checkbox"
                                                            value="subscription_management_child_view_access"
                                                            name="access[]">
                                                        <label for="subscription_management_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="subscription_management_child_edit_access"
                                                            type="checkbox"
                                                            value="subscription_management_child_edit_access"
                                                            name="access[]">
                                                        <label for="subscription_management_child_edit_access">Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="subscription_management_child_delete_child_access"
                                                            type="checkbox"
                                                            value="subscription_management_child_delete_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="subscription_management_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="departmentinformation" type="checkbox"
                                                    value="departmentinformation" name="access[]">
                                                <label for="departmentinformation">Department</label>
                                            </div>
                                            <ul class="role_ul full_width departmentinformation_child_show sub-check"
                                                id="departmentinformation_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="departmentinformation_child_view_access"
                                                            type="checkbox"
                                                            value="departmentinformation_child_view_access"
                                                            name="access[]">
                                                        <label for="departmentinformation_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="departmentinformation_child_edit_access"
                                                            type="checkbox"
                                                            value="departmentinformation_child_edit_access"
                                                            name="access[]">
                                                        <label for="departmentinformation_child_edit_access">Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="departmentinformation_child_delete_child_access"
                                                            type="checkbox"
                                                            value="departmentinformation_child_delete_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="departmentinformation_child_delete_child_access">Delete
                                                            Access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="inquiry_management" type="checkbox"
                                                    value="inquiry_management" name="access[]">
                                                <label for="inquiry_management"> Inquiry management</label>
                                            </div>
                                            <ul class="role_ul full_width inquiry_management_child_show sub-check"
                                                id="inquiry_management_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="inquiry_management_child_type_access" type="checkbox"
                                                            value="inquiry_management_child_type_access"
                                                            name="access[]">
                                                        <label for="inquiry_management_child_type_access">Inquiry
                                                            Type</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="inquiry_management_child_status_access"
                                                            type="checkbox"
                                                            value="inquiry_management_child_status_access"
                                                            name="access[]">
                                                        <label for="inquiry_management_child_status_access">Inquiry
                                                            Status</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="inquiry_management_child_sourcing_child_access"
                                                            type="checkbox"
                                                            value="inquiry_management_child_sourcing_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="inquiry_management_child_sourcing_child_access">Inquiry
                                                            Source Type</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="inquiry_management_child_source_child_access"
                                                            type="checkbox"
                                                            value="inquiry_management_child_source_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="inquiry_management_child_source_child_access">Inquiry
                                                            Source </label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="inquiry_management_child_close_child_access"
                                                            type="checkbox"
                                                            value="inquiry_management_child_close_child_access"
                                                            name="access[]">
                                                        <label for="inquiry_management_child_close_child_access">Close
                                                            Reason</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="accountrole" type="checkbox" value="accountrole"
                                                    name="access[]">
                                                <label for="accountrole">Account</label>
                                            </div>
                                            <ul class="role_ul full_width accountrole_child_show sub-check"
                                                id="accountrole_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="payment_management" type="checkbox"
                                                            value="payment_management" name="access[]">
                                                        <label for="payment_management">Payment Method</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="voucher_child_access" type="checkbox"
                                                            value="voucher_child_access" name="access[]">
                                                        <label for="voucher_child_access">Voucher Type</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="usercheck" type="checkbox" value="usercheck" name="access[]">
                                        <label for="usercheck">Staff</label>
                                    </div>
                                    <ul class="role_ul usercheckshow row sub-check" id="usercheckshow"
                                        style="display: none;">
                                        <li class="li_3 col-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="userinformation" type="checkbox" value="userinformation"
                                                    name="access[]">
                                                <label for="userinformation"> Staff Information</label>
                                            </div>
                                            <ul class="role_ul full_width userinformation_child_show sub-check"
                                                id="userinformation_child_show">
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="userinformation_child_view_access" type="checkbox"
                                                            value="userinformation_child_view_access" name="access[]">
                                                        <label for="userinformation_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox ">
                                                        <input id="userinformation_child_add_access" type="checkbox"
                                                            value="userinformation_child_add_access" name="access[]">
                                                        <label for="userinformation_child_add_access">Add access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="userinformation_child_edit_access" type="checkbox"
                                                            value="userinformation_child_edit_access" name="access[]">
                                                        <label for="userinformation_child_edit_access">Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3 ">
                                                    <div class="checkbox">
                                                        <input id="userinformation_child_delete_child_access"
                                                            type="checkbox"
                                                            value="userinformation_child_delete_child_access"
                                                            name="access[]">
                                                        <label for="userinformation_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="attendancecheck" type="checkbox" value="attendancecheck" name="access[]">
                                        <label for="attendancecheck">Attendance</label>
                                    </div>
                                    <ul class="role_ul attendancecheck row sub-check" id="attendancecheckshow" style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox">
                                                <input id="edit_attendance" type="checkbox" value="edit_attendance" name="access[]">
                                                <label for="edit_attendance"> Edit attendance</label>
                                            </div>
                                        </li>
                                    </ul>
                                </li> -->
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="attendance_check" type="checkbox" value="attendance_check"
                                            name="access[]">
                                        <label for="attendance_check">Attendance</label>
                                    </div>
                                    <ul class="role_ul attendancecheck_show row sub-check" id="attendancecheck_show"
                                        style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="attendance_check" type="checkbox" value="attendance_check"
                                                    name="access[]">
                                                <label for="attendance_check">Attendance</label>
                                            </div>
                                            <ul class="role_ul full_width attendance_information_child_show sub-check"
                                                id="attendance_information_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="attendance_information_child_edit_access"
                                                            type="checkbox"
                                                            value="attendance_information_child_edit_access"
                                                            name="access[]">
                                                        <label for="attendance_information_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="subscription_check" type="checkbox" value="subscription_check"
                                            name="access[]">
                                        <label for="subscription_check">Subscription User</label>
                                    </div>
                                    <ul class="role_ul subscriptioncheck_show row sub-check" id="subscriptioncheck_show"
                                        style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="subscription_check" type="checkbox"
                                                    value="subscription_check" name="access[]">
                                                <label for="subscription_check">Subscription</label>
                                            </div>
                                            <ul class="role_ul full_width subscription_information_child_show sub-check"
                                                id="subscription_information_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="subscription_information_child_view_access"
                                                            type="checkbox"
                                                            value="subscription_information_child_view_access"
                                                            name="access[]">
                                                        <label for="subscription_information_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="subscription_information_child_edit_access"
                                                            type="checkbox"
                                                            value="subscription_information_child_edit_access"
                                                            name="access[]">
                                                        <label for="subscription_information_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="subscription_information_child_delete_child_access"
                                                            type="checkbox"
                                                            value="subscription_information_child_delete_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="subscription_information_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="signup_check" type="checkbox" value="signup_check" name="access[]">
                                        <label for="signup_check">Signup User</label>
                                    </div>
                                    <ul class="role_ul signupcheck_show row sub-check" id="signupcheck_show"
                                        style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="signup_check" type="checkbox" value="signup_check"
                                                    name="access[]">
                                                <label for="signup_check">Signup</label>
                                            </div>
                                            <ul class="role_ul full_width signup_information_child_show sub-check"
                                                id="signup_information_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="signup_information_child_view_access" type="checkbox"
                                                            value="signup_information_child_view_access"
                                                            name="access[]">
                                                        <label for="signup_information_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="signup_information_child_edit_access" type="checkbox"
                                                            value="signup_information_child_edit_access"
                                                            name="access[]">
                                                        <label for="signup_information_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="signup_information_child_delete_child_access"
                                                            type="checkbox"
                                                            value="signup_information_child_delete_child_access"
                                                            name="access[]">
                                                        <label for="signup_information_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="discount_check" type="checkbox" value="discount_check"
                                            name="access[]">
                                        <label for="discount_check">Discount</label>
                                    </div>
                                    <ul class="role_ul discountcheck_show row sub-check" id="discountcheck_show"
                                        style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="discount_check" type="checkbox" value="discount_check"
                                                    name="access[]">
                                                <label for="discount_check">Discount</label>
                                            </div>
                                            <ul class="role_ul full_width discount_information_child_show sub-check"
                                                id="discount_information_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="discount_information_child_view_access"
                                                            type="checkbox"
                                                            value="discount_information_child_view_access"
                                                            name="access[]">
                                                        <label for="discount_information_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="discount_information_child_edit_access"
                                                            type="checkbox"
                                                            value="discount_information_child_edit_access"
                                                            name="access[]">
                                                        <label for="discount_information_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="discount_information_child_delete_child_access"
                                                            type="checkbox"
                                                            value="discount_information_child_delete_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="discount_information_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="inquiry_managementcheck" type="checkbox"
                                            value="inquiry_managementcheck" name="access[]">
                                        <label for="inquiry_managementcheck">Inquiry</label>
                                    </div>
                                    <ul class="role_ul inquiry_managementcheck_show row sub-check"
                                        id="inquiry_managementcheck_show" style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="all_inquiry_information" type="checkbox"
                                                    value="all_inquiry_information" name="access[]">
                                                <label for="all_inquiry_information">All inquiry</label>
                                            </div>
                                            <ul class="role_ul full_width all_inquiry_management_information_child_show sub-check"
                                                id="all_inquiry_management_information_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="all_inquiry_information_child_view_access"
                                                            type="checkbox"
                                                            value="all_inquiry_information_child_view_access"
                                                            name="access[]">
                                                        <label for="all_inquiry_information_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="all_inquiry_information_child_edit_access"
                                                            type="checkbox"
                                                            value="all_inquiry_information_child_edit_access"
                                                            name="access[]">
                                                        <label for="all_inquiry_information_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="all_inquiry_information_child_delete_child_access"
                                                            type="checkbox"
                                                            value="all_inquiry_information_child_delete_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="all_inquiry_information_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>

                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input
                                                            id="inquiry_management_information_child_delete_all_child_access"
                                                            type="checkbox"
                                                            value="inquiry_management_information_child_delete_all_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="inquiry_management_information_child_delete_all_child_access">Delete
                                                            access all</label>
                                                    </div>
                                                </li>

                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="all_inquiry_information_child_followup_child_access"
                                                            type="checkbox"
                                                            value="all_inquiry_information_child_followup_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="all_inquiry_information_child_followup_child_access">Follow
                                                            up access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="inquiry_management_visit_information" type="checkbox"
                                                    value="inquiry_management_visit_information" name="access[]">
                                                <label for="inquiry_management_visit_information"> SSM Action </label>
                                            </div>
                                            <ul class="role_ul inquiry_managementcheck_show sub-check"
                                                id="inquiry_managementcheck_show_csv_section" style="display: none;">
                                                <li class="li_1">
                                                    <div class="checkbox">
                                                        <input id="inquiry_import_csv_permission" type="checkbox"
                                                            value="inquiry_import_csv_permission" name="access[]">
                                                        <label for="inquiry_import_csv_permission"> Import CSV
                                                            Inquiry</label>
                                                    </div>
                                                </li>
                                                <li class="li_1">
                                                    <div class="checkbox">
                                                        <input id="inquiry_export_csv_permission" type="checkbox"
                                                            value="inquiry_export_csv_permission" name="access[]">
                                                        <label for="inquiry_export_csv_permission"> Export CSV
                                                            Inquiry</label>
                                                    </div>
                                                </li>
                                                <li class="li_1">
                                                    <div class="checkbox">
                                                        <input id="inquiry_vist_inquiry" type="checkbox"
                                                            value="inquiry_vist_inquiry" name="access[]">
                                                        <label for="inquiry_vist_inquiry">Visit inquiry</label>
                                                    </div>
                                                </li>
                                                <li class="li_1">
                                                    <div class="checkbox">
                                                        <input id="inquiry_booking" type="checkbox"
                                                            value="inquiry_booking" name="access[]">
                                                        <label for="inquiry_booking">Booking inquiry</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="inquiry_register_managementcheck" type="checkbox"
                                            value="inquiry_register_managementcheck" name="access[]">
                                        <label for="inquiry_register_managementcheck">Register</label>
                                    </div>
                                    <ul class="role_ul inquiry_register_managementcheck_show row sub-check"
                                        id="inquiry_register_managementcheck_show" style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="register_appointment_inquiry_management_information"
                                                    type="checkbox"
                                                    value="register_appointment_inquiry_management_information"
                                                    name="access[]">
                                                <label for="register_appointment_inquiry_management_information">
                                                    Appointment Register</label>
                                            </div>
                                        </li>
                                        <li class="li_3 col-sm-6 col-lg-4 mt-3 mt-sm-0">
                                            <div class="checkbox ">
                                                <input id="register_dismiss_request_inquiry_management_information"
                                                    type="checkbox"
                                                    value="register_dismiss_request_inquiry_management_information"
                                                    name="access[]">
                                                <label for="register_dismiss_request_inquiry_management_information">
                                                    Dismissed Request Register</label>
                                            </div>
                                        </li>
                                        <li class="li_3 col-sm-6 col-lg-4 mt-3 mt-lg-0">
                                            <div class="checkbox ">
                                                <input id="subscription_request_register_conversion_register"
                                                    type="checkbox"
                                                    value="subscription_request_register_conversion_register"
                                                    name="access[]">
                                                <label
                                                    for="subscription_request_register_conversion_register">Subscription
                                                    Request Register</label>
                                            </div>
                                            <ul class="role_ul full_width subscription_request_register_conversion_register_child sub-check"
                                                id="subscription_request_register_conversion_register_child">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="subscription_request_view_access" type="checkbox"
                                                            value="subscription_request_view_access" name="access[]">
                                                        <label for="subscription_request_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="subscription_request_child_edit_access"
                                                            type="checkbox"
                                                            value="subscription_request_child_edit_access"
                                                            name="access[]">
                                                        <label for="subscription_request_child_edit_access">Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-sm-6 col-lg-4 mt-3 mt-lg-0">
                                            <div class="checkbox ">
                                                <input id="subscription_register_conversion_register" type="checkbox"
                                                    value="subscription_register_conversion_register" name="access[]">
                                                <label for="subscription_register_conversion_register">Subscription
                                                    Register</label>
                                            </div>
                                            <ul class="role_ul full_width subscription_register_conversion_register_child sub-check"
                                                id="subscription_register_conversion_register_child">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="subscription_register_view_access" type="checkbox"
                                                            value="subscription_register_view_access" name="access[]">
                                                        <label for="subscription_register_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="demo_register" type="checkbox" value="demo_register"
                                                    name="access[]">
                                                <label for="demo_register">Demo Register</label>
                                            </div>
                                            <ul class="role_ul full_width demo_register_child_show sub-check"
                                                id="demo_register_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="demo_register_child_view_access" type="checkbox"
                                                            value="demo_register_child_view_access" name="access[]">
                                                        <label for="demo_register_child_view_access">View access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="demo_register_child_edit_access" type="checkbox"
                                                            value="demo_register_child_edit_access" name="access[]">
                                                        <label for="demo_register_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="demo_register_child_delete_child_access"
                                                            type="checkbox"
                                                            value="demo_register_child_delete_child_access"
                                                            name="access[]">
                                                        <label for="demo_register_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="demo_inquiry_import_csv_permission" type="checkbox"
                                                            value="demo_inquiry_import_csv_permission" name="access[]">
                                                        <label for="demo_inquiry_import_csv_permission">Import Csv
                                                            Inquiry</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="demo_inquiry_export_csv_permission" type="checkbox"
                                                            value="demo_inquiry_export_csv_permission" name="access[]">
                                                        <label for="demo_inquiry_export_csv_permission">Export Csv
                                                            Inquiry</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="finance_managementcheck" type="checkbox"
                                            value="finance_managementcheck" name="access[]">
                                        <label for="finance_managementcheck">Finance</label>
                                    </div>
                                    <ul class="role_ul finance_managementcheck_show row sub-check"
                                        id="finance_managementcheck_show" style="display: none;">
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="invoice_inquiry_information" type="checkbox"
                                                    value="invoice_inquiry_information" name="access[]">
                                                <label for="invoice_inquiry_information">Invoice</label>
                                            </div>
                                            <ul class="role_ul full_width invoice_information_child_show sub-check"
                                                id="invoice_information_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="invoice_information_child_view_access"
                                                            type="checkbox"
                                                            value="invoice_information_child_view_access"
                                                            name="access[]">
                                                        <label for="invoice_information_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="invoice_information_child_edit_access"
                                                            type="checkbox"
                                                            value="invoice_information_child_edit_access"
                                                            name="access[]">
                                                        <label for="invoice_information_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="invoice_information_child_delete_child_access"
                                                            type="checkbox"
                                                            value="invoice_information_child_delete_child_access"
                                                            name="access[]">
                                                        <label
                                                            for="invoice_information_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li_3 col-sm-6 col-lg-4">
                                            <div class="checkbox ">
                                                <input id="sales_information" type="checkbox" value="sales_information"
                                                    name="access[]">
                                                <label for="sales_information">Sales register</label>
                                            </div>
                                            <ul class="role_ul full_width sales_child_show sub-check"
                                                id="sales_child_show">
                                                <li class="li_3">
                                                    <div class="checkbox ">
                                                        <input id="sales_information_child_view_access" type="checkbox"
                                                            value="sales_information_child_view_access" name="access[]">
                                                        <label for="sales_information_child_view_access">View
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="sales_information_child_edit_access" type="checkbox"
                                                            value="sales_information_child_edit_access" name="access[]">
                                                        <label for="sales_information_child_edit_access"> Edit
                                                            access</label>
                                                    </div>
                                                </li>
                                                <li class="li_3">
                                                    <div class="checkbox">
                                                        <input id="sales_information_child_delete_child_access"
                                                            type="checkbox"
                                                            value="sales_information_child_delete_child_access"
                                                            name="access[]">
                                                        <label for="sales_information_child_delete_child_access">Delete
                                                            access</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="li_3" class="contains-items">
                                    <div class="checkbox col-lg-12">
                                        <input id="client_supportcheck" type="checkbox" value="client_supportcheck"
                                            name="access[]">
                                        <label for="client_supportcheck">Client Support</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer2">
                    <button class="btn-secondary master_user_role_update" id="master_user_role_update_btn"
                        data-edit_id="" name="master_user_role_update" value="master_user_role_update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<!-- <script src="<?= base_url('assets/js/jquery.nestable.js') ?>"></script> -->
<script src="https://rudrram.com/assets/js/jquery.nestable.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function list_data() {
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('userrole_list'); ?>",
                data: {
                    'table': 'admin_userrole',
                    'action': true
                },
                success: function (res) {
                    $('.loader').hide();
                    if (res != "") {
                        $('#nestable').html(res);
                    } else {
                        $('#nestable').html('<ol class="dd-list"></ol>');
                    }
                }
            });
        }
        list_data();
        $("button[name='userrole']").click(function (e) {
            e.preventDefault();
            var save_data_value = $('#nestable-output').val();
            if (save_data_value != '[]') {
                var form = $("form[name='userrole']")[0];
                var formdata = new FormData(form);
                $('.loader').show();
                $.ajax({
                    method: "post",
                    url: "<?= site_url('userrole_insert_data'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('.loader').hide();
                        var form = $("form[name='userrole']")[0];
                        $('.loader').hide();
                        sweet_edit_sucess('Add successfully');
                        list_data();
                    },
                });
            }
            return false;
        });
        $('input[type=checkbox]').change(function () {
            // if is checked
            if (this.checked) {
                // check all children
                var lenchk = $(this).closest('ul').find(':checkbox');
                var lenchkChecked = $(this).closest('ul').find(':checkbox:checked');
                //if all siblings are checked, check its parent checkbox
                if (lenchk.length == lenchkChecked.length) {
                    $(this).closest('ul').siblings().find(':checkbox').first().prop('checked', true);
                } else {
                    $(this).closest('ul').siblings().find(':checkbox').first().prop('checked', true);
                    $(this).closest('.checkbox').siblings().find(':checkbox').first().prop('checked', true);
                }
            } else {
                var lenchk = $(this).closest('ul').find(':checkbox');
                var lenchkChecked = $(this).closest('ul').find(':checkbox:checked');
                if (lenchkChecked.length == 0) {
                    $(this).closest('ul').siblings().find(':checkbox').prop('checked', false);
                    $(this).closest('.checkbox').siblings().find(':checkbox').prop('checked', false);
                } else {
                    $(this).closest('.checkbox').siblings().find(':checkbox').prop('checked', false);
                }
            }
        });
        $("#mastercheck").click(function () {
            $(".mastercheckshow").toggle(300);
        });
        $("#dashboard_sectioncheck").click(function () {
            $(".dashboardcheckshow").toggle(300);
        });
        $("#usercheck").click(function () {
            $(".usercheckshow").toggle(300);
        });
        $("#subscription_check").click(function () {
            $(".subscriptioncheck_show").toggle(300);
        });
        $("#taskcheck").click(function () {
            $(".taskcheckshow").toggle(300);
        });
        $("#task").click(function () {
            $(".taskcheckshow").toggle(300);
        });
        $("#signup_check").click(function () {
            $(".signupcheck_show").toggle(300);
        });
        $("#discount_check").click(function () {
            $(".discountcheck_show").toggle(300);
        });
        $("#inquiry_managementcheck").click(function () {
            $(".inquiry_managementcheck_show").toggle(300);
        });
        $("#inquiry_register_managementcheck").click(function () {
            $(".inquiry_register_managementcheck_show").toggle(300);
        });
        $("#attendance_check").click(function () {
            $(".attendancecheck_show").toggle(300);
        });
        $("#finance_managementcheck").click(function () {
            $(".finance_managementcheck_show").toggle(300);
        });
        $("body").on('click', '.access-icon', function (e) {
            e.preventDefault();
            var edit_value = $(this).attr("data-edit_id");
            // console.log(edit_value);
            if (edit_value != "") {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('UserInformation_edit'); ?>",
                    data: {
                        action: 'edit',
                        edit_id: edit_value,
                        table: 'userrole'
                    },
                    success: function (res) {
                        $("form[name='master_user_role_update_form']")[0].reset();
                        if (edit_value)
                            var response = JSON.parse(res);
                        var access_page = '';
                        if (response != '') {
                            var access_page = response.access_page;
                        }
                        if (access_page != '') {
                            var nameArr = access_page.split(',');
                            $("#assign_pages").find('[value=' + nameArr.join('], [value=') + ']').prop("checked", true);
                            if (access_page.indexOf('dashboard_sectioncheck') > -1) {
                                $("#dashboardcheckshow").show();
                            } else {
                                $("#dashboardcheckshow").hide();
                            }
                            if (access_page.indexOf('mastercheck') > -1) {
                                $("#mastercheckshow").show();
                            } else {
                                $("#mastercheckshow").hide();
                            }
                            if (access_page.indexOf('usercheck') > -1) {
                                $("#usercheckshow").show();
                            } else {
                                $("#usercheckshow").hide();
                            }
                            if (access_page.indexOf('subscription_check') > -1) {
                                $(".subscriptioncheck_show").show();
                            } else {
                                $(".subscriptioncheck_show").hide();
                            }
                            if (access_page.indexOf('signup_check') > -1) {
                                $(".signupcheck_show").show();
                            } else {
                                $(".signupcheck_show").hide();
                            }
                            if (access_page.indexOf('taskcheck') > -1) {
                                $("#taskcheckshow").show();
                            } else {
                                $("#taskcheckshow").hide();
                            }

                            if (access_page.indexOf('discount_check') > -1) {
                                $(".discountcheck_show").show();
                            } else {
                                $(".discountcheck_show").hide();
                            }
                            if (access_page.indexOf('inquiry_managementcheck') > -1) {
                                $(".inquiry_managementcheck_show").show();
                            } else {
                                $(".inquiry_managementcheck_show").hide();
                            }
                            if (access_page.indexOf('inquiry_register_managementcheck') > -1) {
                                $(".inquiry_register_managementcheck_show").show();
                            } else {
                                $(".inquiry_register_managementcheck_show").hide();
                            }
                            if (access_page.indexOf('attendance_check') > -1) {
                                $(".attendancecheck_show").show();
                            } else {
                                $(".attendancecheck_show").hide();
                            }
                            if (access_page.indexOf('finance_managementcheck') > -1) {
                                $(".finance_managementcheck_show").show();
                            } else {
                                $(".finance_managementcheck_show").hide();
                            }
                        } else {
                            // alert();
                            $("#dashboardcheckshow").hide();
                            $("#mastercheckshow").hide();
                            $("#usercheckshow").hide();
                            $("#subscriptioncheck_show").hide();
                            $("#inquiry_managementcheck_show").hide();
                            $("#inquiry_register_managementcheck_show").hide();
                            $("#attendancecheck_show").hide();
                            $("#finance_managementcheck_show").hide();
                            $("#taskcheckshow").hide();
                        }
                        jQuery("#master_user_role_list .checkshow").show();
                        $('#master_user_role_update_btn').attr('data-edit_id', response.id);
                    },
                    error: function (error) {
                    }
                });
            } else {
                alert("Data Not Edit.");
            }
        });
        $("body").on('click', '.master_user_role_update', function (e) {
            e.preventDefault();
            var update_id = $('#master_user_role_update_btn').attr('data-edit_id');
            var user_role = $("#master_user_role_update input[name=user_role]").val();
            var form = $("form[name='master_user_role_update_form']")[0];
            var formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', 'userrole');
            // console.log(formdata);
            // return false;
            $.ajax({
                method: "post",
                url: "<?= site_url('user_role_update_data'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res != "error") {
                        $("form[name='master_user_role_update_form']")[0].reset();
                        $('#master_user_role_update_btn').attr('data-edit_id', '');
                        $("#Userrole_access .btn-close").trigger("click");
                        sweet_edit_sucess('Update successfully');
                    } else {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Duplicate Data Not Valid',
                            icon: 'error',
                        });
                    }
                },
                error: function (error) {
                }
            });
        });
    });
</script>
<!-- drag-drop-js -->
<script>
    $(document).ready(function () {
        var updateOutput = function () {
            $('#nestable-output').val(JSON.stringify($('#nestable').nestable('serialize')));
        };
        $('#nestable').nestable().on('change', updateOutput);
        updateOutput();
        $("#add-item").submit(function (e) {
            e.preventDefault();
            id = Date.now();
            var label = $("#add-item #user_role").val();
            var department = $("#add-item #department").val();
            console.log(id);
            if ((label == "")) return;
            var item = "";
            item +=
                '<li class="dd-item dd3-item" data-id="' + id + '" data-label="' + label + '" data-department="' + department + '" >' +
                '<div class="">' +
                '<img class="dd-handle dd3-handle " src="https://dev.realtosmart.com/assets/images/drag-and-drop.jpg">' +
                '</div>' +
                '<div class="dd3-content"  data-edit_id="' + id + '">' +
                '<span>' + label + '</span>' +
                '<div class="item-edit">' +
                '<img class="access-icons mt-1 ms-2 opacity-75"  src="https://dev.realtosmart.com/assets/images/edit2.png">' +
                '</div>' +
                '<div data-tbs-toggle="tooltip" data-bs-placement="right" data-bs-title="access">' +
                '<img class="access-icon" data-bs-toggle="modal" data-edit_id="' + id + '" data-bs-target="#Userrole_access" src="https://dev.realtosmart.com/assets/images/access1.png">' +
                '</div>' +
                '</div>' +
                '<div class="item-settings d-none">' +
                '<div class="d-flex align-items-center justify-content-between col-12 px-1 mb-1">' +
                '<lable>User Role</lable>' +
                '<a class="item-close" href="javascript:void(0)">' +
                '<button type="button" class="modal-close-btn" style="float:right" aria-label="Close">' +
                '<i class="bi bi-x-circle"></i>' +
                '</button>' +
                '</a>' +
                '</div>' +
                '<div class="user-admin-form-submit d-flex mb-2">' +
                '<input class="mx-1 px-1" type="text" name="navigation_label" value="' + label + '">' +
                '<select name="department" class="department mx-1"   data-live-search="true">' +
                '<option class="dropdown-item" data-department_id="0" value="0">Select Action</option>';
            <?php if ($department) { ?>
                <?php foreach ($department as $key => $value) { ?>
                    item += '<option class="dropdown-item" data-department_id="<?php echo $value['id'] ?>" value="<?php echo $value['id']; ?>" ';
                    if (department == '<?php echo $value['id'] ?>') {
                        item += "selected";
                    }
                    item += '> <?php echo $value['departmentname'] ?></option>';
                <?php } ?>
            <?php } ?>
            item += '</select>' +
                '</div>' +
                '<div>' +
                '<a class="item-delete mx-1" href="javascript:void(0)">Remove</a> ' +
                '</div>' +
                '</div>' +
                '</li>';
            $("#nestable > .dd-list").append(item);
            $("#nestable").find('.dd-empty').remove();
            $("#add-item > [name='user_role']").val('');
            $("#add-item > [name='department']").val('');
            updateOutput();
        });
        // $("body").on(".item-settings .department", "change", function (e) {
        //     updateOutput();
        // });
        $("body").delegate(".item-delete", "click", function (e) {
            $(this).closest(".dd-item").remove();
            updateOutput();
        });
        $("body").delegate(".item-edit", "click", function (e) {
            var item_setting = $(this).closest(".dd-item").find(".item-settings");
            var cl_item_setting = $(this).closest(".dd-item").find(".dd-list .item-settings");
            if (item_setting.hasClass("d-none")) {
                item_setting.removeClass("d-none");
            } else {
                item_setting.addClass("d-none");
            }
            if (cl_item_setting.hasClass("d-none")) {
                cl_item_setting.addClass("d-none");
            } else {
                cl_item_setting.addClass("d-none");
            }
        });
        $("body").delegate(".item-close", "click", function (e) {
            var item_close = $(this).closest(".item-settings");
            if (item_close.hasClass("d-none")) {
                item_close.removeClass("d-none");
            } else {
                item_close.addClass("d-none");
            }
        });
        // $("body").delegate("input[name='navigation_label']", "change paste keyup", function (e) {
        //     $(this).closest(".dd-item").data("label", $(this).val());
        //     $(this).closest(".dd-item").find(".dd3-content span").text($(this).val());
        // });
        // $("body").delegate(".department", "change", function (e) {
        //     $(this).closest(".dd-item").attr("data-department", $(this).val());
        // });
        $("body").click(function (e) {
            if ($(e.target).closest('.item-settings').length == 0)
                $(".item-settings.d-block .item-close").trigger('click');
        })

        $("body").delegate("input[name='navigation_label']", "change paste keyup", function (e) {
            $(this).closest(".dd-item").data("label", $(this).val());
            $(this).closest(".dd-item").find(".dd3-content span").first().text($(this).val());
        });

        $("body").delegate(".department", "change", function (e) {
            $(this).closest(".dd-item").attr("data-department", $(this).val());
        });
    });
</script>