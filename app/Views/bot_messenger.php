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

          <div class="col-xl-12 p-2">

               <div class="user-icon d-flex align-items-center">

                    <i class="bi bi-people me-2"></i>

                    <p>Bot Chats</p>

               </div>

          </div>

          <div class="col-12 p-2" style="height: calc(100vh - 150.5px);">

               <div class="chat-outer-main bg-white rounded-2 border overflow-hidden h-100">

                    <div class="row flex-nowrap m-0 overflow-hidden h-100">

                         <div class="col-12 col-lg-4 border-end px-3" id="chat_nav_search_bar">

                              <div class="chat-nav-search-bar p-3 border-bottom">

                                   <div class="d-flex justify-content-between align-items-center">

                                        <div class="d-flex align-items-center">

                                             <div class="dropdown">

                                                  <div class="chat-main-user d-flex justify-content-center align-items-center bg-opacity-75 bg-dark    rounded-circle cursor-pointer"

                                                       data-bs-toggle="dropdown" aria-expanded="false">

                                                       <img src="<?= base_url(); ?>/assets/images/chat-user.svg"

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

                                   <!-- <h5 class="fs-5 mb-2">Chats</h5> -->

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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script> -->

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

