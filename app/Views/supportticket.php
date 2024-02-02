<?= $this->include('partials/header') ?>

<?= $this->include('partials/sidebar') ?>

<style>

     .cursor-pointer {

          cursor: pointer;

     }



     .active_chat_user {

          background-color: #f2f3f4;

     }



     .chat-main-user img {

          width: 30px;

          height: 30px;

          object-fit: cover;

     }



     .chat-nav-search input,

     .main-chat-input input {

          outline: none;

          font-size: 14px;

          padding-left: 40px;

     }



     .chat-nav-search input:focus,

     .main-chat-input input:focus {

          box-shadow: none;

          border: 1px solid #949494 !important;

     }



     .chat-nav-search input::placeholder,

     .main-chat-input input::placeholder {

          font: 12px;

     }



     .chat-nav-search .bi-search {

          left: 25px;

          font-size: 12px;

     }



     .chat-nav-user-img img {

          width: 30px;

          height: 30px;

          object-fit: cover;

     }



     .chat-nav-users .nav .nav-link {

          color: #696969;

     }



     .chat-nav-users .nav .nav-link:hover {

          background-color: #f2f3f4;

     }



     .chat-nav-users .nav .nav-link.active {

          background-color: transparent;

     }



     .chat-nav-users::-webkit-scrollbar {

          width: 1px;

     }



     .chat-inner-box-img {

          background-repeat: repeat;

          background-size: 200px;

     }



     .chat-icon {

          width: 80px;

          height: 80px;

     }



     .main-chat-input i,

     .go_btn_class {

          background-color: #b55dcd;

          cursor: pointer;

     }



     .user-right-chat .user-chat::before {

          border-top-right-radius: 0 !important;

     }



     .user-left-chat .user-chat::before {

          border-top-left-radius: 0px !important;

     }



     .user-chat-box .user-chat {

          max-width: 65%;

          line-height: 18px;

          font-size: 15px;

     }



     .user-chat-time {

          font-size: 11px;

          float: right;

          position: relative;

          bottom: -4px;

          padding-left: 7px;

          line-height: 18px;

     }



     #main_chat_inner_box {

          transition: all 0.5s;

     }



     .scroll-none::-webkit-scrollbar,

     .scroll-none::-webkit-scrollbar-track,

     .scroll-none::-webkit-scrollbar-thumb,

     .scroll-none::-webkit-scrollbar-thumb:hover {

          width: 0px !important;

          background-color: transparent;

     }



     .user-right-chat div {

          border-radius: 6px;

     }

</style>

<div class="main-dashbord p-2">

     <div class="container-fluid">

          <!-- <div class="col-xl-12 p-2">

               <div class="user-icon d-flex align-items-center">

                    <i class="bi bi-people me-2"></i>

                    <p>Clint Support</p>

               </div>

          </div> -->

          <div class="col-12 p-2" style="height: calc(100vh - 187.5px);">

               <div class="chat-outer-main bg-white rounded-2 border overflow-hidden h-100">

                    <div class="row flex-nowrap m-0 overflow-hidden h-100">

                         <div class="col-12 col-lg-4 border-end px-3" id="chat_nav_search_bar">

                              <div class="chat-nav-search-bar p-3 border-bottom">

                                   <div class="d-flex justify-content-between align-items-center">

                                        <div class="d-flex align-items-center">

                                             <div class="dropdown">

                                                  <div class="chat-main-user d-flex justify-content-center align-items-center bg-opacity-75 bg-dark    rounded-circle cursor-pointer"

                                                       data-bs-toggle="dropdown" aria-expanded="false">

                                                       <img src="https://admin.realtosmart.com/assets/images/chat-user.svg"

                                                            alt="" class="">

                                                  </div>

                                             </div>

                                             <div class="chat-nav-search position-relative ms-3">

                                                       <input type="search" name="" id="searchbar"

                                                            class="form-control border rounded-pill py-1 pe-1 lh-lg text-body-secondary serchbar_div"

                                                            placeholder="Search a member" aria-controls="DataTables_Table_0" >

                                                       <i class="bi bi-search position-absolute top-50 translate-middle"></i>

                                                  </div>

                                        </div>

                                        <div class="dropdown d-flex align-items-center">

                                        </div>

                                        <div class="col-4">

                                             <div class="main-selectpicker w-100">

                                                  <select name="" id=""

                                                       class="selectpicker form-control form-main ticket_status_div1"

                                                       required="" tabindex="-98">

                                                       <option value="" class="ticket_status_div" selected>All Ticket

                                                            Status</option>

                                                       <option value="New" class="ticket_status_div">New</option>

                                                       <option value="In Progress" class="ticket_status_div">In Progress

                                                       </option>

                                                       <option value="Closed" class="ticket_status_div">Closed</option>

                                                  </select>

                                             </div>

                                        </div>

                                   </div>

                              </div>

                              <div class="chat-users-box p-3">

                                   <h5 class="fs-5 mb-2">Chats</h5>

                                   <div class="chat-nav-users overflow-y-scroll" style="max-height: 368px;">

                                        <div class="nav clint_chat_div" id="clint_chat_id"></div>

                                   </div>

                              </div>

                         </div>

                         <div class="col-12 col-lg-8 chat-inner-box-img p-0 overflow-hidden" id="main_chat_inner_box">

                              <div class="main-chat-inner-box d-flex justify-content-between flex-column h-100">

                                   <div class="col-12 main-chat-header p-3 bg-white shadow-sm header_of_chat_div"

                                        style="display:none">

                                        <div class="d-flex justify-content-star align-items-center">

                                             <i class="bi bi-arrow-left me-2 fs-6 cursor-pointer d-lg-none d-block"

                                                  id="back_to_user_chat"></i>

                                             <div class="dropdown">

                                                  <div class="chat-main-user d-flex justify-content-center align-items-center bg-opacity-75 bg-secondary rounded-circle  cursor-pointer"

                                                       data-bs-toggle="dropdown" aria-expanded="false">

                                                       <img src="http://localhost/RealtoSmartDev/assets/images/user_profile_pic/noprofile.jpg"

                                                            alt="" class="chatbox_profile_div rounded-circle">

                                                  </div>

                                                  <div class="dropdown-menu p-2">

                                                       <img src="http://localhost/RealtoSmartDev/assets/images/user_profile_pic/noprofile.jpg"

                                                            alt="" class="w-100 chatbox_profile_div">

                                                  </div>

                                             </div>

                                             <b>

                                                  <p class="ms-3  change_name_chat_wise" data_user_id=""></p>

                                             </b>

                                             <p class="ms-3  change_title_chat_wise" data_user_id=""></p>

                                             <div class="dropdown ms-auto file-drop">

                                                  <button class="btn-primary me-2 go_status_change_btn" chat_id=""

                                                       data_status="">Ticket-Closed</button>

                                                  <a href="#" role="button" data-bs-toggle="dropdown"

                                                       data-bs-auto-close="outside" aria-expanded="false">

                                                       <i class="bi bi-link-45deg text-dark"></i>

                                                  </a>

                                                  <ul class="dropdown-menu py-2 px-3 attachment_display_div"

                                                       style="width: 300px;">

                                                       <li class="m-2">

                                                            <div

                                                                 class="pgf-attach-main bg-light rounded-2 px-3 py-2 cursor-pointer">

                                                                 <p class="fw-medium text-nowrap" href=""

                                                                      data-file-name=""> No Any Attchment</p>

                                                            </div>

                                                       </li>

                                                  </ul>

                                             </div>

                                        </div>

                                   </div>

                                   <div class="col-12 flex-fill py-3 px-4  bg-opacity-10 overflow-y-scroll scroll-none chat_main_wrapper_div"

                                        id="chat_main_wrapper">

                                   </div>

                                   <div class="col-12 main-chat-input p-3 bg-white shadow-sm chat_input_div"

                                        id="#chat_form" style="display:none">

                                        <div class="d-flex justify-content-star align-items-center ">

                                             <input type="text"

                                                  class="form-control chat_box_input_div px-3 me-3 chat_sender_dic_backend"

                                                  id="chat_sender_id" placeholder="Type Your Message...">

                                             <i class="fa-solid fa-location-arrow px-3 py-2 fs-6 rounded text-white cursor-pointer chat_send_btn_div"

                                                  chat_id="" user_id="" id="chat_submit_id"></i>

                                             <i class="fa-solid bi bi-paperclip px-3 py-2 fs-6 m-2 rounded text-white cursor-pointer send_attachment_div"

                                                  id="" message_user_id="" data-bs-target="#exampleModal"

                                                  data-bs-toggle="modal"

                                                  style="background-color:#724ebf !important"></i>

                                        </div>

                                   </div>

                              </div>

                         </div>

                    </div>

               </div>

          </div>

     </div>

</div>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

     <div class="modal-dialog">

          <div class="modal-content">

               <div class="modal-header">

                    <h1 class="modal-title">Choose Attachment</h1>

                    <button type="button" class="btn-close btn-close-attch" data-bs-dismiss="modal"

                         aria-label="Close"></button>

               </div>

               <div class="modal-body">

                    <form class="attachment_form">

                         <input class="form-control main-control mt-2 attachment_div_again" type="file" placeholder=""

                              name="attachment[]" multiple>

                    </form>

                    <input type="text" class="attachment_conversation_div" hidden value="" />

               </div>

               <div class="modal-footer">

                    <button type="button" class="btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>

                    <button type="button" class="btn-primary add_attchment_div" chat_id="" chat_id="">Send</button>

               </div>

          </div>

     </div>

</div>

<input type="text" hidden class="action_listdata" value="list_data">

<?= $this->include('partials/footer') ?>

<?= $this->include('partials/vendor-scripts') ?>

<script>

     $('body').on('click', '.clear_all_filter', function () {

          $(".filter_form_div")[0].reset();

          $(".filter_save_btn").trigger("click");

     });

     $(".ticket_status_ul").hide();

     $('body').on('click', '.ticket_status_check', function () {

          var ticket_status_check = $(this).attr('value_id');

          $(".ticket_status_ul").hide();

     });

     var input = document.getElementById("chat_sender_id");

     input.addEventListener("keypress", function (event) {

          if (event.key === "Enter") {

               event.preventDefault();

               document.getElementById("chat_submit_id").click();

          }

     });

     function scrollToBottom() {

          const fileViewDiv = document.getElementById('chat_main_wrapper');

          fileViewDiv.scrollTop = fileViewDiv.scrollHeight;

     }

     $('.attachment_div_again').on('change', function () {

          var files = $(this).prop('files');

          var fileNames = [];

          for (var i = 0; i < files.length; i++) {

               fileNames.push(files[i].name);

          }

          var storage = fileNames.join(',');

          $('.attachment_conversation_div').val(storage);

     });

</script>

<script>

     $(document).ready(function () {

          $("body").on('click', '#chat_submit', function () {

               if ($('#chat_sender').val() < 1) {

                    $('#chat_sender').addClass('');

               }

               else {

                    var message = $('#chat_sender').val();

                    $('#chat_sender').val('');

                    var chat_time = new Date();

                    var chat_full_time = chat_time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

                    $('#chat_wrapper').append('<div class="user-chat-box col-12 user-right-chat w-100 text-end mb-2"><div class="user-chat bg-white rounded-2 p-2 shadow-sm d-inline-block position-relative text-start">' + message + '<div class="user-chat-time text-body-tertiary d-inline-block text-lowercase">' + chat_full_time + '</div>')

               }

          });

          if (window.matchMedia('(min-width: 767px)').matches) {

               $("#chat_nav_search_bar").show();

               $("#main_chat_inner_box").show();

          };

          if (window.matchMedia('(max-width: 767px)').matches) {

               $("#main_chat_inner_box").hide();

               $(".chat-nav-users .nav-link").click(function () {

                    $("#chat_nav_search_bar").hide();

                    $("#main_chat_inner_box").show();

               });

               $("#back_to_user_chat").click(function () {

                    $("#chat_nav_search_bar").show();

                    $("#main_chat_inner_box").hide();

               });

          };

     });

     function datatable_view_first(html) {

          $('.clint_chat_div').html(html);

     }

     $('body').on('click', '.filter_save_btn', function () {

          list_data_s();

          $(".btn-close-filter").trigger("click");

     });

     function list_data_s() {

          var status = $('.ticket_status_div1 :selected').val();

          var searchText = $('.serchbar_div').val();

          console.log(searchText);

          console.log(status);

          $.ajax({

               type: "POST",

               url: "clint_list_data",

               data: {

                    search_text: searchText,

                    action: "search_bar",

                    status: status

               },

               success: function (response) {

                    $('.clint_chat_div').html(response);

               }

          });

     }

     list_data_s();

     $('body').on('click', '.click_event_div_list', function () {

          $('.header_of_chat_div').show();

          $('.chat_input_div').show();

          $(".remove_class_active_div").removeClass('active_chat_user');

          var chat_id_table = $(this).attr("chat_id_table");

          var user_name = $(this).attr("user_name");

          var user_id = $(this).attr("user_id");

          var user_profile_src = $(this).attr("user_profile_src");

          var support_ticket_status = $(this).attr("support_ticket_status");

          if (support_ticket_status !== "") {

               $('.value_div[value="' + support_ticket_status + '"]').prop("checked", true);

          } else {

               $('.value_div').prop("checked", false);

          }

          if (user_profile_src !== "") {

               $('.chatbox_profile_div').attr('src', user_profile_src);

          } else {

               $('.chatbox_profile_div').attr('src', "https://admin.realtosmart.com/assets/images/chat-user.svg");

          }

          var issue_title = $(this).attr("issue_title");

          var issue_description = $(this).attr("issue_description");

          var issue_attchment = $(this).attr("issue_attchment");

          var filenames = issue_attchment;

          var filenameArray = $.trim(filenames).split(',');

          var html = "";

          if (issue_attchment !== "") {

               var filenames = issue_attchment;

               var filenameArray = $.trim(filenames).split(',');

               var href = "http://localhost/RealtoSmartDev/assets/support_ticket_store/";

               var html = '';

               $.each(filenameArray, function (index, filename) {

                    html += '<li class="m-2"> <div class="pgf-attach-main bg-light rounded-2 px-3 py-2 cursor-pointer"> <p class="fw-medium text-nowrap file_attachment_div" href="' + href + filename + '" data-file-name="">' + filename + '</p> </div> </li>';

               });

               $('.attachment_display_div').html(html);

          } else {

               html = '<li class="m-2"> <div class="pgf-attach-main bg-light rounded-2 px-3 py-2 cursor-pointer"> <p class="fw-medium text-nowrap"  data-file-name="">No Attachment Found</p> </div> </li>';

               $('.attachment_display_div').html(html);

          }

          $('.chat_send_btn_div').attr('user_id', user_id);

          $('.chat_send_btn_div').attr('chat_id', chat_id_table);

          $('.go_status_change_btn').attr('chat_id', chat_id_table);

          $('.go_status_change_btn').attr('data_status', support_ticket_status);

          $(".change_title_chat_wise").text(issue_title);

          $(".change_name_chat_wise").text(user_name);

          $('.change_name_chat_wise').attr('data_user_id', chat_id_table);

          $('.add_attchment_div').attr('chat_id', chat_id_table)

          $('.Description_text_div').text(issue_description);

          $(this).addClass('active_chat_user');

          list_data();

          setTimeout(() => {

               scrollToBottom();

          }, 300);

     });

     $('body').on('click', '.file_attachment_open_div', function (event) {

          var pdfUrl = $(this).attr('href');

          if (pdfUrl !== "") {

               window.open(pdfUrl, '_blank');

          }

     });

     $('body').on('click', '.file_attachment_div', function (event) {

          var pdfUrl = $(this).attr('href');

          if (pdfUrl !== "") {

               window.open(pdfUrl, '_blank');

          }

     });

     $('body').on('click', '.go_status_change_btn', function () {

          var data_status = $(this).attr('data_status');

          console.log(data_status);

          var ticket_status = 'Closed';

          var chat_id = $(this).attr('chat_id');

          if (data_status != ticket_status) {

               $.ajax({

                    type: "POST",

                    url: "update_ticket_status",

                    data: {

                         ticket_status: ticket_status,

                         chat_id: chat_id

                    },

                    success: function (response) {

                         $(".three-dot").trigger("click");

                         list_data_s();

                         iziToast.success({

                              title: 'Successfully Ticket Closed!',

                         });

                    }

               });

          } else {

               iziToast.error({

                    title: 'Ticket Already Closed!'

               });

          }

     });

     $('#searchbar').on('input', function (event) {

          var searchText = $(this).val();

          if (searchText === '') {

               var enterKeyEvent = $.Event('keydown', { keyCode: 13, which: 13 });

               $(this).trigger(enterKeyEvent);

          }

     });

     $(".serchbar_div").keydown(function (e) {

          var searchText = $(this).val();

          var status = '';

          if (e.keyCode == 13) {

               list_data_s();

          }

     });

     $('.ticket_status_div1').on('change', function () {

          list_data_s();

     });

     $('body').on('click', '.chat_send_btn_div', function () {

          var edit_id = $(this).attr("chat_id");

          var user_id = $(this).attr("user_id");

          var chat = $('.chat_box_input_div').val();

          const now = new Date();

          const year = now.getFullYear();

          const month = String(now.getMonth() + 1).padStart(2, '0');

          const day = String(now.getDate()).padStart(2, '0');

          var current_date = `${day}-${month}-${year}`;

          var time = now.getHours() + ":" + now.getMinutes();

          var date = current_date;

          var time = time;

          if (chat !== "") {

               $.ajax({

                    method: "post",

                    url: "send_message_data_conversion",

                    data: {

                         edit_id: edit_id,

                         table: "master_support_ticket",

                         action: "update",

                         chat: chat,

                         date: date,

                         user_id: user_id,

                         time: time

                    },

                    success: function (res) {

                         $('.chat_box_input_div').val("");

                         list_data();

                         setTimeout(() => {

                              scrollToBottom();

                         }, 400);

                    }

               });

          }

     });

     function datatable_view_secound(html) {

          $('.chat_main_wrapper_div').html(html);

     }

     function list_data() {

          show_val = '<?= json_encode(array('note')); ?>';

          var user_id = $('.change_name_chat_wise').attr('data_user_id');

          $.ajax({

               datatype: 'json',

               method: "post",

               url: "support_chat_list_data_admin",

               data: {

                    'table': 'master_support_ticket',

                    'show_array': show_val,

                    'action': true,

                    user_id: user_id

               },

               success: function (res) {

                    $('.loader').hide();

                    datatable_view_secound(res);

               }

          });

     }

     $('body').on('click', '.send_attachment_div', function () {

          $(".attachment_form")[0].reset();

     });

     $('body').on('click', '.add_attchment_div', function () {

          const now = new Date();

          const year = now.getFullYear();

          const month = String(now.getMonth() + 1).padStart(2, '0');

          const day = String(now.getDate()).padStart(2, '0');

          var current_date = `${day}-${month}-${year}`;

          var time = now.getHours() + ":" + now.getMinutes();

          var date = current_date;

          var time = time;

          var attachment_files = $('.attachment_conversation_div').val();

          var chat_id = $(this).attr('chat_id');

          var form = $(".attachment_form")[0];

          var formData = new FormData(form);

          formData.append('edit_id', chat_id);

          formData.append('action', 'update');

          formData.append('chat', '');

          formData.append('attachment_files', attachment_files);

          formData.append('time', time);

          formData.append('date', date);

          formData.append('table', 'master_support_ticket');

          $.ajax({

               type: 'POST',

               url: 'send_message_data_conversion',

               data: formData,

               contentType: false,

               processData: false,

               success: function (data) {

                    $(".attachment_form")[0].reset();

                    list_data();

                    setTimeout(() => {

                         scrollToBottom();

                    }, 500);

                    $(".btn-close-attch").trigger("click");

               }

          });

     });
	setInterval(function () {
		list_data();
	}, 60000);
</script>