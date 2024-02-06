<?php
// print_r($_SESSION);
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

   $get_roll_id_to_roll_duty_var = array();

} else {

   $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);

}

?>



<div class="sidebar sidebarClose d-flex justify-content-between h-100 flex-column bg-white">

   <div class="main-bg-white-blur"></div>

   <div class="small-logo w-100 p-2">

      <a href="<?= base_url(); ?>">

         <img src="https://ajasys.com/img/favicon.png" class="w-100">

      </a>

   </div>

   <div class="big-logo w-100 p-4 d-flex justify-content-center">

      <a href="<?= base_url(); ?>" class="px-3">

         <img src="https://ajasys.com/img/logo.png" alt="" class="w-100">

      </a>

   </div>

   <nav class="navbar navbar-expand-lg bg-light py-0">

      <div class="container-fluid p-0 h-100">

         <ul class="navbar-nav w-100 h-100 justify-content-start flex-column overflow-y-scroll scroll-none">

            <?php if (in_array('mastercheck', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="javascript:void(0)" data-tbs-toggle="tooltip"

                     data-bs-placement="right" data-bs-title="Master">

                     <span class="drop_icon_main">

                        <i class="bi bi-grid-fill lh-28"></i>

                     </span>

                     <span class="link_name">Master</span>

                     <i class="bx bxs-chevron-down arrow ms-auto"></i>

                  </a>

                  <div class="drop_down">

                     <ul>

                        <p class="text-white dp-title">Master</p>
                        <li> <a class="dropdown-item" href="<?= base_url(); ?>alert_setting" ?>Alert Setting</a> </li>
                        <li> <a class="dropdown-item" href="<?= base_url(); ?>template" ?>Email Tools</a> </li>
                        <?php if (in_array('subscription_management', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>subscription_master" class="dropdown-item">Subscription master</a>

                           </li>

                        <?php } ?>

                        <li class="submenu">

                           <p class="dropdown-item submenu-item">User Side Settings</p>

                           <ul class="submenu-dropdown">

                              <?php if (in_array('departmentinformation', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                 <li>

                                    <a href="<?= base_url(); ?>department" class="dropdown-item">department</a>

                                 </li>

                              <?php } ?>

                              <?php if (in_array('inquiry_management', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                 <li class="submenu">

                                    <p class="dropdown-item submenu-item">inquiry Management</p>

                                    <ul class="submenu-dropdown">

                                       <?php if (in_array('inquiry_management_child_type_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                          <li>

                                             <a href="<?= base_url(); ?>managermasterinquiry" class="dropdown-item">inquiry

                                                type</a>

                                          </li>

                                       <?php } ?>

                                       <?php if (in_array('inquiry_management_child_status_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                          <li>

                                             <a href="<?= base_url(); ?>manageinquirystatus" class="dropdown-item">inquiry

                                                status</a>

                                          </li>

                                       <?php } ?>

                                       <?php if (in_array('inquiry_management_child_sourcing_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                          <li>

                                             <a href="<?= base_url(); ?>inquiry-source-type" class="dropdown-item">inquiry source

                                                type</a>

                                          </li>

                                       <?php } ?>

                                       <?php if (in_array('inquiry_management_child_source_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                          <li>

                                             <a href="<?= base_url(); ?>manage-inquiry-source" class="dropdown-item">inquiry

                                                source</a>

                                          </li>

                                       <?php } ?>

                                       <?php if (in_array('inquiry_management_child_close_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                          <li>

                                             <a href="<?= base_url(); ?>manage_inquiry_close " class="dropdown-item">close

                                                reasons</a>

                                          </li>

                                       <?php } ?>

                                    </ul>

                                 </li>

                              <?php } ?>

                              <?php if (in_array('accountrole', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                 <li class="submenu">

                                    <p class="dropdown-item submenu-item">Account</p>

                                    <ul class="submenu-dropdown">

                                       <?php if (in_array('payment_management', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                          <li>

                                             <a href="<?= base_url(); ?>payment_m_master" class="dropdown-item">Payment Method

                                                Master</a>

                                          </li>

                                       <?php } ?>

                                       <?php if (in_array('voucher_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                                          <li>

                                             <a href="<?= base_url(); ?>voucher_type" class="dropdown-item">Voucher Type</a>

                                          </li>

                                       <?php } ?>

                                    </ul>

                                 </li>

                              <?php } ?>

                           </ul>

                        </li>

                        <?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li class="submenu">

                              <p class="dropdown-item submenu-item">Admin Side Settings</p>

                              <ul class="submenu-dropdown">

                                 <li>

                                    <a href="<?= base_url(); ?>web_settings" class="dropdown-item">General Setting</a>

                                 </li>

                                 <li>

                                    <a href="<?= base_url(); ?>department" class="dropdown-item">department</a>

                                 </li>

                                 <li>

                                    <a href="<?= base_url(); ?>user-admin-role" class="dropdown-item">User admin role</a>

                                 </li>

                                 <li class="submenu">

                                    <p class="dropdown-item submenu-item">inquiry Management</p>

                                    <ul class="submenu-dropdown">

                                       <li>

                                          <a href="<?= base_url(); ?>managermasterinquiry" class="dropdown-item">inquiry

                                             type</a>

                                       </li>

                                       <li>

                                          <a href="<?= base_url(); ?>department" class="dropdown-item">inquiry type</a>

                                       </li>

                                       <li>

                                          <a href="<?= base_url(); ?>manageinquirystatus" class="dropdown-item">inquiry

                                             status</a>

                                       </li>

                                       <li>

                                          <a href="<?= base_url(); ?>inquiry-source-type" class="dropdown-item">inquiry source

                                             type</a>

                                       </li>

                                       <li>

                                          <a href="<?= base_url(); ?>manage-inquiry-source" class="dropdown-item">inquiry

                                             source</a>

                                       </li>

                                       <li>

                                          <a href="<?= base_url(); ?>manage_inquiry_close " class="dropdown-item">close

                                             reasons</a>

                                       </li>

                                    </ul>

                                 </li>

                              </ul>

                           </li>

                        <?php } ?>


                        <li class="submenu">

                           <p class="dropdown-item submenu-item">GymSmart Master</p>

                           <ul class="submenu-dropdown">

                              <li>

                                 <a href="<?= base_url(); ?>food" class="dropdown-item">Food Master</a>


                              </li>

                              <li>

                                 <a href="<?= base_url(); ?>exercises" class="dropdown-item">Exercise Master</a>

                              </li>
                              <li>

                                 <a href="<?= base_url(); ?>alldiet" class="dropdown-item">all Diet</a>

                              </li>

                              <li>

                                 <a href="<?= base_url(); ?>allworkout" class="dropdown-item">all workout</a>

                              </li>


                           </ul>

                        </li>


                     </ul>

                  </div>

               </li>

            <?php } ?>

            <?php if (in_array('usercheck', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>user"

                     data-tbs-toggle="tooltip" data-bs-title="Staff">

                     <span class="drop_icon_main">

                        <i class="fa-solid fa-people-roof lh-28"></i>

                     </span>

                     <span class="link_name">Staff</span>

                  </a>

               </li>

            <?php } ?>
            <?php if (in_array('attendance_check', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>attendance"
                     data-tbs-toggle="tooltip" data-bs-title="Attendacne">

                     <span class="drop_icon_main">
                        <i class="fa-solid fa-clipboard-user lh-28"></i>
                        <!-- <i class="fa-solid fa-people-roof lh-28"></i> -->

                     </span>

                     <span class="link_name">Attendance</span>

                  </a>

               </li>

            <?php } ?>

            <?php if (in_array('signup_check', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>signuplist"
                     data-tbs-toggle="tooltip" data-bs-title="Signup">

                     <span class="drop_icon_main">

                        <i class="fa-solid fa-user"></i>

                     </span>

                     <span class="link_name">Sign Up</span>

                  </a>

               </li>

            <?php } ?>
            <!-- <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>template"

                     data-tbs-toggle="tooltip" data-bs-title="template">

                     <span class="drop_icon_main">

                        <i class="fa-brands fa-sellcast lh-28"></i>

                     </span>

                     <span class="link_name">Email Tools</span>

                  </a>

               </li> -->
            <li class="main-drop ">

               <a class="drop_icon d-flex align-items-center py-2 justify-content-center" href="javascript:void(0)"
                  data-tbs-toggle="tooltip" data-bs-placement="right" data-bs-title="Social Campaign">

                  <span class="drop_icon_main  ">

                     <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30" height="30" x="0" y="0" viewBox="0 0 70 70" style="enable-background:new 0 0 512 512"
                        xml:space="preserve" class="">
                        <g>
                           <path
                              d="m15.198 52.567 7.37 13.01a3.355 3.355 0 0 0 4.24 1.43l4.44-1.89a3.365 3.365 0 0 0 1.6-4.75l-7.1-12.53c5.532-2.53 10.919-3.854 16.72-2.19l.09.19c.96 2.01 3.165 2.724 5.01 1.9 1.9-.87 2.73-3.11 1.86-5l-4.04-8.86a6.732 6.732 0 0 0 1.08-7.29 6.73 6.73 0 0 0-6.21-3.96h-.01l-4.04-8.86a3.772 3.772 0 0 0-5.01-1.86c-1.773.82-2.787 2.937-1.8 5.13l.04.08v.01c-1.707 3.71-4.46 6.559-7.99 8.74 0 0-.01 0-.02.01-2.801 1.85-3.826 2.045-14.13 6.82-3.56 1.62-5.12 5.83-3.51 9.39l3.03 6.6c1.494 3.294 5.16 4.812 8.38 3.88zm29.48-25.17c.67 1.46.55 3.11-.23 4.43l-3.26-7.15a4.74 4.74 0 0 1 3.49 2.72zm-14.19-7.98 10.93 23.94c-5.05-1.03-9.47 0-13.52 1.42l-7.33-16.07c3.71-2.13 7.38-4.8 9.92-9.29zm-6.57 29.26 7.19 12.68c.388.659.145 1.566-.65 1.92l-4.44 1.89c-.63.27-1.37.02-1.71-.58l-7.24-12.78zM44.308 17.147l4.16-1.86 5.78 1.26c1.21.27 2.41-.5 2.68-1.72l1.52-6.98c.26-1.21-.51-2.41-1.72-2.68l-10.99-2.39c-1.22-.27-2.43.5-2.69 1.71l-1.52 6.98c-.26 1.22.51 2.42 1.73 2.69l.84.18-.49 2.25c-.083.393.299.742.7.56zm3.5-10.29c.84-.61 2-.39 2.57.46.03.04.05.09.07.13.04-.03.08-.06.13-.09.85-.56 2.01-.31 2.54.58.51.85.17 1.95-.65 2.5l-2.59 1.71a.54.54 0 0 1-.74-.15l-1.71-2.59c-.54-.82-.42-1.97.38-2.55zM52.188 40.537l.74.26-.7 1.99a.46.46 0 0 0 .57.59l4-1.23 5.13 1.8c1.07.38 2.26-.19 2.64-1.27l2.16-6.19c.38-1.07-.19-2.25-1.26-2.63l-9.75-3.41c-1.08-.38-2.26.18-2.64 1.26l-2.17 6.18c-.37 1.09.19 2.27 1.28 2.65zm4.37-2.26 1.06-3.02c.16-.45.75-.54 1.04-.16l1.7 2.29c.25.34.08.83-.33.93l-2.76.73a.592.592 0 0 1-.71-.77zM58.128 27.667l2.57-1.88 4.14.01c.86 0 1.57-.7 1.57-1.57l.02-4.99c0-.87-.71-1.58-1.57-1.58l-7.86-.02c-.88 0-1.59.7-1.59 1.57l-.01 4.99c0 .87.7 1.58 1.58 1.58h.6l-.01 1.61c0 .309.361.446.56.28zm1.1-7.13h3.79c.55 0 1 .45 1 1s-.45 1-1 1h-3.79c-.56 0-1-.45-1-1s.44-1 1-1z"
                              fill="#000000" opacity="1" data-original="#000000" class=""></path>
                        </g>
                     </svg>

                  </span>

                  <span class="link_name">Social Campaign</span>

                  <i class="bx bxs-chevron-down arrow ms-auto"></i>

               </a>

               <div class="drop_down " style="">

                  <ul>
                     <p class="text-white dp-title"></p>

                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>bot">Messenger & Bots</a>
                     </li>

                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>manage_audience">Manage Audience</a>
                     </li>

                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>post_comments">Manage Post & Comments</a>
                     </li>

                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>">Email Integration</a>
                     </li>

                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>">WhatsApp Integration</a>
                     </li>

                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>">Lead Integration</a>
                     </li>

                     <li> <a class="dropdown-item" href="<?= base_url(); ?>integration" ?>Integration</a> </li>



                  </ul>

               </div>

            </li>

            <?php if (in_array('subscription_check', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>subscription"
                     data-tbs-toggle="tooltip" data-bs-title="Subscriptions">

                     <span class="drop_icon_main">

                        <i class="fa-brands fa-sellcast lh-28"></i>

                     </span>

                     <span class="link_name">Subscriptions</span>

                  </a>

               </li>

            <?php } ?>

            <?php if (in_array('discount_check', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>coupon"

                     data-tbs-toggle="tooltip" data-bs-title="Coupons">

                     <span class="drop_icon_main">

                        <i class="fa-solid fa-percent fa-fw"></i>

                     </span>

                     <span class="link_name">Coupons</span>

                  </a>

               </li>

            <?php } ?>

            <?php if (in_array('inquiry_managementcheck', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="javascript:void(0)" data-tbs-toggle="tooltip"

                     data-bs-placement="right" data-bs-title="Inquiries">

                     <span class="drop_icon_main">

                        <i class="fa-solid fa-list-check lh-28"></i>

                     </span>

                     <span class="link_name">Inquiries</span>

                     <i class="bx bxs-chevron-down arrow ms-auto"></i>

                  </a>

                  <div class="drop_down">

                     <ul>

                        <p class="text-white dp-title">Inquiries</p>

                        <li>

                           <a href="<?= base_url(); ?>allinquiry?followup=today" class="dropdown-item">Today inq</a>

                        </li>

                        <li>

                           <a href="<?= base_url(); ?>allinquiry?followup=pending" class="dropdown-item">Pending inq</a>

                        </li>
                        <li><a class="dropdown-item" href="<?= base_url(); ?>allinquiry?followup=cnr"
                              data-menu="allinquiry?followup=cnr">Cnr</a>
                        </li>

                        <li>

                           <a href="<?= base_url(); ?>allinquiry?followup=closerequest" class="dropdown-item">Close

                              Requests</a>

                        </li>

                        <?php if (in_array('all_inquiry_information', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>allinquiry" class="dropdown-item">All inq</a>

                           </li>

                        <?php } ?>

                     </ul>

                  </div>

               </li>

            <?php } ?>
            <?php if (in_array('taskcheck', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <li class="main-drop">
                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>task"
                     data-tbs-toggle="tooltip" data-bs-placement="right" data-bs-title="Task">
                     <span class="drop_icon_main">
                        <i class="bi bi-calendar2-check-fill"></i>
                     </span>
                     <span class="link_name">Task Management</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (in_array('inquiry_register_managementcheck', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="javascript:void(0)" data-tbs-toggle="tooltip"

                     data-bs-placement="right" data-bs-title="Register">

                     <span class="drop_icon_main">

                        <i class="fa-solid fa-book-open lh-28"></i>

                     </span>

                     <span class="link_name">Register</span>

                     <i class="bx bxs-chevron-down arrow ms-auto"></i>

                  </a>

                  <div class="drop_down">

                     <ul>

                        <p class="text-white dp-title">Register</p>

                        <li>

                           <?php if (in_array('register_appointment_inquiry_management_information', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                              <a href="<?= base_url(); ?>allinquiry?followup=appointment" class="dropdown-item">Appointment

                                 Register</a>

                           </li>

                        <?php } ?>

                        <?php if (in_array('register_dismiss_request_inquiry_management_information', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>allinquiry?followup=dismissed" class="dropdown-item">Dismissed Inq

                                 Register</a>

                           </li>

                        <?php } ?>

                        <!-- <?php if (in_array('subscription_request_register_conversion_register', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>subscription_request" class="dropdown-item">Subscription Request

                                 Register</a>

                           </li>

                        <?php } ?> -->

                        <!-- <?php if (in_array('subscription_register_conversion_register', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>subscription_register" class="dropdown-item">Subscription

                                 Register</a>

                           </li>

                        <?php } ?> -->

                        <?php if (in_array('demo_register', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>demo_register" class="dropdown-item">Demo Register</a>

                           </li>

                        <?php } ?>

                     </ul>

                  </div>

               </li>

            <?php } ?>

            <?php if (in_array('finance_managementcheck', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

               <li class="main-drop">

                  <a class="drop_icon d-flex align-items-center py-2" href="javascript:void(0)" data-tbs-toggle="tooltip"

                     data-bs-placement="right" data-bs-title="Finance">

                     <span class="drop_icon_main">

                        <i class="fa-solid fa-indian-rupee-sign lh-28"></i>

                     </span>

                     <span class="link_name">Finance</span>

                     <i class="bx bxs-chevron-down arrow ms-auto"></i>

                  </a>

                  <div class="drop_down">

                     <ul>

                        <p class="text-white dp-title">Finance</p>

                        <?php if (in_array('invoice_inquiry_information', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>invoice" class="dropdown-item">Invoice</a>

                           </li>

                        <?php } ?>

                        <?php if (in_array('sales_information', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>

                           <li>

                              <a href="<?= base_url(); ?>sales_register" class="dropdown-item">Sales register</a>

                           </li>

                        <?php } ?>

                     </ul>

                  </div>

               </li>

            <?php } ?>

            <?php if (in_array('data_module', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <li class="main-drop">
                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>data_module"
                     data-tbs-toggle="tooltip" data-bs-placement="right" data-bs-title="Data Module">
                     <span class="drop_icon_main">
                        <i class="fa-solid fa-database"></i>
                     </span>
                     <span class="link_name">Data module</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (in_array('client_supportcheck', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <li class="main-drop">
                  <a class="drop_icon d-flex align-items-center py-2" href="<?= base_url(); ?>supportticket"
                     data-tbs-toggle="tooltip" data-bs-title="Client Support">
                     <span class="drop_icon_main">
                        <i class="bi bi-ticket-detailed lh-28"></i>
                     </span>
                     <span class="link_name">Client Support</span>
                  </a>
               </li>
            <?php } ?>

         <?php if (in_array('main_create', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <li class="main-drop">
                     <a class="drop_icon d-flex align-items-center py-2"
                        href="<?= base_url('create'); ?>" data-tbs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Create">
                        <span class="drop_icon_main">
                           <i class="fa-solid fa-plus"></i>
                        </span>
                        <span class="link_name">create</span>
                     </a>
               </li>
         <?php } ?>
         <?php if (in_array('main_post', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <li class="main-drop">
                     <a class="drop_icon d-flex align-items-center py-2"
                        href="<?= base_url('posts'); ?>" data-tbs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Post">
                        <span class="drop_icon_main">
                        <i class="fa-regular fa-clone"></i>
                        </span>
                        <span class="link_name">post</span>
                     </a>
               </li>
         <?php } ?>
         <?php if (in_array('main_calender', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
               <li class="main-drop">
                     <a class="drop_icon d-flex align-items-center py-2"
                        href="<?= base_url('payment_receivable'); ?>" data-tbs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Calender">
                        <span class="drop_icon_main">
                              <i class="bi bi-calendar2-date-fill"></i>
                        </span>
                        <span class="link_name">Calender</span>
                     </a>
               </li>
         <?php } ?>


         </ul>

      </div>

   </nav>

</div>
<?= $this->include('partials/vendor-scripts') ?>