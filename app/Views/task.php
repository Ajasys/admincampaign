<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$db_connection = \Config\Database::connect();

$query = "SELECT * FROM `master_user` WHERE id=" . $_SESSION['master'];

$find_Array_all = $db_connection->query($query);

$result_array = $find_Array_all->getResultArray();

$today = date('Y-m-d');

$str_today = strtotime($today);

$subcription_end = date('Y-m-d', strtotime($result_array[0]['subcription_end']));

$str_subcription_end = strtotime($subcription_end);
if ($str_today < $str_subcription_end) {
    $username = session_username($_SESSION['username']);
    $db_connection = \Config\Database::connect('second');


    //Task all listing data
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
        $userCon = "  WHERE (id=" . $_SESSION['id'] . "  OR  id IN (" . $getchilds . "))";
    }


    $user_query = "SELECT * FROM " . $username . "_user  " . $userCon . " ORDER BY id DESC";
    $user_result = $db_connection->query($user_query);
    $task_user = $user_result->getResultArray();

    $status_query = "SELECT * FROM " . $username . "_task_status ORDER BY id ASC";
    $status_result = $db_connection->query($status_query);
    $task_status = $status_result->getResultArray();
}


?>

<style>
    .ck-editor__editable_inline {
        min-height: 160px;
        max-height: 170px;
    }

    .file_view_add .border-bottom:last-child {
        border: 0px !important;
    }

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

    .task-card-footer svg {
        width: 20px;
        height: 20px;
    }

    .task-card-footer i {
        font-size: 16px;
    }

    .task-card-footer .fa-pen-to-square {
        font-size: 18px !important;
    }

    .task-card-footer .fa-trash-can {
        color: #c70000bf;
    }

    .task-card-footer .taskbadge {
        min-width: 18px;
        min-height: 18px;
        top: -2px;
    }

    .ghost {
        opacity: .1;
        color: #000;
        background-color: #000;
    }

    .editable {
        user-select: none;
    }
</style>

<div class="main-dashbord p-2 main-check-class">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="bg-white rounded-2 rounded-2 p-3">
                <div class="row align-items-center justify-content-start">
                    <div class="d-flex align-items-center justify-content-between col-sm-12 col-md-2 my-1 my-md-0">
                        <div class="title-1">
                            <ul class="nav nav-pills task-nav me-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active rounded-0 rounded-start lh-normal p-2" id="-tab" data-bs-toggle="pill" data-bs-target="#pills-taskcard" type="button" role="tab" aria-controls="pills-taskcard" aria-selected="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <rect x="7" y="7" width="3" height="9"></rect>
                                            <rect x="14" y="7" width="3" height="5"></rect>
                                        </svg>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-0 rounded-end lh-normal p-2" id="pills-taskrecord-tab" data-bs-toggle="pill" data-bs-target="#pills-taskrecord" type="button" role="tab" aria-controls="pills-taskrecord" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="8" y1="6" x2="21" y2="6" fill="#724ebf" data-original="#000000" opacity="1"></line>
                                            <line x1="8" y1="12" x2="21" y2="12" fill="#724ebf" data-original="#000000" opacity="1"></line>
                                            <line x1="8" y1="18" x2="21" y2="18" fill="#724ebf" data-original="#000000" opacity="1"></line>
                                            <line x1="3" y1="6" x2="3.01" y2="6" fill="#724ebf" data-original="#000000" opacity="1"></line>
                                            <line x1="3" y1="12" x2="3.01" y2="12" fill="#724ebf" data-original="#000000" opacity="1"></line>
                                            <line x1="3" y1="18" x2="3.01" y2="18" fill="#724ebf" data-original="#000000" opacity="1"></line>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                            <h2 class="text-gray">Tasks</h2>
                        </div>
                        <div class="ms-auto d-block d-md-none ">
                            <div class="d-flex align-items-center">
                                <button class="delete deleted-all fs-14 btn-primary-rounded me-2 z-1">
                                    <i class="fi fi-rr-trash d-flex"></i>
                                </button>
                                <button class="btn-primary-rounded plus_btn" data-bs-toggle="modal" id="plus_btn" data-bs-target="#task-add">
                                    <i class="fi fi-rr-plus-small d-flex"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 input-text my-1 my-md-0">
                        <div class="main-selectpicker">
                            <select name="task_user_searchId" id="task_user_searchId" class="selectpicker form-control form-main main-control" data-live-search="true" tabindex="-98" onchange="taskUserSearchID()">
                                <!-- <option value="%">All Staff</option> -->
                                <?php
                                if (isset($_SESSION['admin']) && !empty($_SESSION['admin']) &&  $_SESSION['admin'] == 1) {
                                    // Admin can select all staff
                                    echo '<option value="%">All Staff</option>';
                                }

                                if (isset($user)) {
                                    foreach ($user as $user_key1 => $user_value1) {
                                        // All users can select themselves
                                        $selected = ($user_value1["id"] == $_SESSION['id']) ? 'selected' : '';
                                        echo '<option value="' . $user_value1["id"] . '" ' . $selected . '>' . $user_value1["firstname"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 input-text my-1 my-md-0">
                        <div class="input-group">
                            <input type="text" name="search_date" id="search_date" class="form-control main-control search_date" placeholder="Select date" onchange="taskUserSearchID()">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar2-date-fill"></i></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-sm-12 col-md-4 my-1 my-md-0">
                        <div class="w-100 input-text pe-2">
                            <input type="search" name="task_Search" size="1" class="form-control main-control mb-0" id="task_Search" onkeyup="taskUserSearchID()" placeholder="Search...">
                        </div>
                        <div class="ms-2">
                            <button class="btn-primary-rounded fs-14 d-flex align-items-center justify-content-center" onclick="taskUserSearchID()">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 my-1 my-md-0 d-none d-md-block">
                        <div class="d-flex justify-content-end align-items-center">
                            <button class="delete deleted-all fs-14 btn-primary-rounded me-2 z-1">
                                <i class="fi fi-rr-trash d-flex"></i>
                            </button>
                            <button class="btn-primary-rounded plus_btn" data-bs-toggle="modal" id="plus_btn" data-bs-target="#task-add">
                                <i class="fi fi-rr-plus-small d-flex"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-taskcard" role="tabpanel" aria-labelledby="pills-taskcard-tab" tabindex="0">
                <div class="p-2 pt-0">
                    <div>
                        <div class="d-flex w-100 new_status_list_data_div overflow-x-scroll scroll-small"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-taskrecord" role="tabpanel" aria-labelledby="pills-taskrecord-tab" tabindex="0">
                <div class="bg-white rounded-2 shadow rounded-2 p-3 mt-2 mx-2">
                    <table id="task_table" class="task-tamplate w-100 table main-table">
                        <thead>
                            <tr>
                                <th>
                                    <input class="check_box select-all-sms" type="checkbox">
                                </th>
                                <th>
                                    <span>NO</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="task_list"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view-task" tabindex="-1" aria-labelledby="ModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title text-white">Task Detail</h1>
                <button type="button" class="modal-close-btn text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-rr-cross-circle d-flex fs-5"></i>
                </button>
            </div>
            <div class="modal-body px-2 py-3">
                <div class=" d-flex align-items-center justify-content-center mb-3">
                    <div class="d-flex">
                        <div class="d-flex align-items-center cursor-pointer me-3 edit_task_from_viewmodel" data_edit_id="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="none">
                                <path d="M234.667 85.333H85.3337C74.0178 85.333 63.1653 89.8282 55.1638 97.8298C47.1622 105.831 42.667 116.684 42.667 128V426.666C42.667 437.982 47.1622 448.835 55.1638 456.836C63.1653 464.838 74.0178 469.333 85.3337 469.333H384C395.316 469.333 406.169 464.838 414.17 456.836C422.172 448.835 426.667 437.982 426.667 426.666V277.333" stroke="#FFA500" stroke-width="32" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M394.667 53.333C403.154 44.846 414.665 40.0781 426.667 40.0781C438.669 40.0781 450.18 44.846 458.667 53.333C467.154 61.8199 471.922 73.3306 471.922 85.333C471.922 97.3353 467.154 108.846 458.667 117.333L256 320L170.667 341.333L192 256L394.667 53.333Z" stroke="#FFA500" stroke-width="32" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </div>
                        <div class="d-flex align-items-center cursor-pointer me-3 delete_btn_viewmodel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="none">
                                <path d="M64 128H106.667H448" stroke="#FF0000" stroke-width="32" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M405.334 128V426.667C405.334 437.983 400.838 448.835 392.837 456.837C384.835 464.838 373.983 469.334 362.667 469.334H149.334C138.018 469.334 127.165 464.838 119.164 456.837C111.162 448.835 106.667 437.983 106.667 426.667V128M170.667 128V85.3337C170.667 74.0178 175.162 63.1653 183.164 55.1638C191.165 47.1622 202.018 42.667 213.334 42.667H298.667C309.983 42.667 320.835 47.1622 328.837 55.1638C336.838 63.1653 341.334 74.0178 341.334 85.3337V128" stroke="#FF0000" stroke-width="32" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </div>
                        <div class="d-flex align-items-center cursor-pointer me-3 assign_to_viewmodel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="none">
                                <path d="M490.666 128L288 330.667L181.333 224L21.333 384" stroke="#6E6B7B" stroke-width="32" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M362.667 128H490.667V256" stroke="#6E6B7B" stroke-width="32" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-pills navtab_primary_sm mb-3 fs-14 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item px-2 mt-2" role="presentation">
                        <button class="fw-medium active task_details_btndiv" id="task-details-tab" data-bs-toggle="pill" data-bs-target="#task-details" type="button" role="tab" aria-controls="task-details" aria-selected="true">Task Details</button>
                    </li>
                    <li class="nav-item px-2 mt-2" role="presentation">
                        <button class="fw-medium" id="task-comment-tab" data-bs-toggle="pill" data-bs-target="#task-comment" type="button" role="tab" aria-controls="task-comment" aria-selected="true">Task Comments</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="task-details" role="tabpanel" aria-labelledby="task-details-tab">
                        <div class="shadow-sm rounded-2 px-3">
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Subject</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary subject_view_model">erwew</div>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Priority</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 task_priority_set_div"><span class="fs-12 rounded-pill task-Low text-white px-2">Low</span></div>
                                </div>
                            </div>
                            <div class="col-12 py-2 is-task-div">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Start Date</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary start_data_view_model"></div>
                                </div>
                            </div>
                            <div class="col-12 py-2 is-task-div">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">End Date</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary end_data_view_model"></div>
                                </div>
                            </div>
                            <div class="col-12 py-2 is-other-div">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Date Type</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 text-body-secondary otherdate-type"></div>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium mt-3 attachment_title" data_attachment=''>Attachment</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium mt-3">:</div>
                                    <div class="col-8 store_html_attch">
                                        <div class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between">
                                            <p class="ms-3">28072023063254853_search_(1).svg</p>
                                            <div class="border-start d-flex p-2 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#a7acb1" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between">
                                            <p class="ms-3">28072023063254853_search_(2).svg</p>
                                            <div class="border-start d-flex p-2 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#a7acb1" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between">
                                            <p class="ms-3">28072023063254853_search_(3).svg</p>
                                            <div class="border-start d-flex p-2 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#a7acb1" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3 text-secondary-emphasis fw-medium">Description</div>
                                    <div class="col-1 text-secondary-emphasis fw-medium">:</div>
                                    <div class="col-8 word-break-all text-body-secondary description_show_div"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show_comment_div" id="task-comment" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="shadow-sm rounded-2 p-4 text-center">No Task Comments</div>
                        <div id="task_comment_list">
                            <div class="task-comment-box shadow-sm rounded-2 my-2">
                                <div class="task-comment-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between">
                                    <p class="text-body-tertiary fw-medium">1.</p>
                                    <div class="comment-header-icons">
                                        <div class="comment-icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="task-comment-body px-3 py-2">
                                    <p class="fs-14 word-break-all text-secondary-emphasis">Lorem Ipsum is simply dummy
                                        text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was popularised in the 1960s with the
                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions of
                                        Lorem Ipsum.
                                    </p>
                                </div>
                            </div>
                            <div class="task-comment-box shadow-sm rounded-2 my-2">
                                <div class="task-comment-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between">
                                    <p class="text-body-tertiary fw-medium">2.</p>
                                    <div class="comment-header-icons">
                                        <div class="comment-icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="task-comment-body px-3 py-2">
                                    <p class="fs-14 word-break-all text-secondary-emphasis">Lorem Ipsum is simply dummy
                                        text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" data-bs-dismiss="modal" data-bs-dismiss="modal">Cancle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade add-comment" id="add-comment" tabindex="-1" aria-labelledby="ModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Comments</h1>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-rr-cross-circle fs-5"></i>
                </button>
            </div>
            <div class="modal-body modal-body-secondery">
                <label for="form-task-description" class="form-label main-label">Add Comment</label>
                <div id="comment-ckeditor-clear" class="comment-ckeditor comment-ckeditor-clear"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancle</button>
                <button type="button" class="btn-primary ms-2 comment_add_btn" id="comment_add_btn" task_table_id="" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade assign_task" id="assign-task" tabindex="-1" aria-labelledby="ModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Assign Task</h1>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-rr-cross-circle fs-5"></i>
                </button>
            </div>
            <div class="modal-body">
                <label for="form-task-assign" class="form-label main-label">Select User</label>
                <div class="main-selectpicker">
                    <select name="assignto_user" id="list_data_assign" class="selectpicker form-control form-main main-control assigned_to_edit" data-live-search="true" required="" tabindex="-98">
                        <option selected="" value="">Select User</option>
                        <?php
                        if (isset($user)) {
                            foreach ($user as $user_key => $user_value) {
                                echo '<option value="' . $user_value["id"] . '">' . $user_value["firstname"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancle</button>
                <button type="button" class="btn-primary ms-2 assign_task_update" data_edit_id="" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    function user_small_name() {
        $(".user-small-name").each(function() {
            var user_small_name_w = $(this).find("span").width();
            var user_small_name_h = $(this).find("span").height();
            if (user_small_name_w > user_small_name_h) {
                $(this).find("span").height(user_small_name_w);
            } else if (user_small_name_h > user_small_name_w) {
                $(this).find("span").width(user_small_name_h);
            }
        });
    }

    $(document).ready(function() {


        $('.search_date').bootstrapMaterialDatePicker({
            // maxDate: moment().hour(0),
            time: false,
            format: 'DD-MM-YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear'
        });
        // var currentDate = new Date();
        // var inputDate = currentDate.toLocaleDateString('en-GB');
        // var dateParts = inputDate.split('/');
        // var formattedDate = dateParts[0] + '-' + dateParts[1] + '-' + dateParts[2];
        // document.getElementById('search_date').value = formattedDate;

        list_data_s();
    });
    $("#pills-taskcard-tab").click(function() {
        list_data_s();
    });
    $("#pills-taskrecord-tab").click(function() {
        $('#task_table').DataTable();
        list_data();
    });

    function datatable_view_first(html) {
        $('.new_status_list_data_div').html(html);
        user_small_name();
        $('[data-tbs-toggle="tooltip"]').click(function() {
            $(this).tooltip('hide')
        });
        $('[data-tbs-toggle="tooltip"]').hover(function() {
            $(this).tooltip('show')
        });
    }
    var classNames = ['.comment-ckeditor'];
    var editors = {};
    classNames.forEach(function(className) {
        ClassicEditor
            .create(document.querySelector(className), {
                toolbar: {
                    items: [
                        'undo',
                        'redo',
                        '|',
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        // 'insertTable',
                        'Blockquote',
                        'outdent',
                        'indent'
                    ],
                    shouldNotGroupWhenFull: false
                },
                language: 'en'
            })
            .then(instance => {
                editors[className] = instance;
            })
            .catch(error => {
                // console.error(error);
            });
    });
    $('body').on('click', '#model-open-add-comment', function() {
        var className = '.comment-ckeditor';
        editors[className].setData('');
    });
    $('body').on('change', '#task_type', function() {
        var tasktype = $('#task_type').val();
        $('.recursive_type').selectpicker('refresh');
        if (tasktype == 1) {
            $('.task_switch_button').show();
            $(".task_switch_button").prop('checked', false);
            $('.task-time,.task-toggle2,.is-email-div').hide();
            $('.task-toggle1').show();
        } else {
            $('.task_switch_button').hide();
            $('.task-toggle2,.is-email-div').show();
            $('.task-toggle1').hide();
            if ($('#recursive_type').val() == 3 || $('#recursive_type').val() == 2) {
                $('.task-time').show();
            } else {
                $('.task-time').hide();
            }
        }
    });
    $('.task-tamplate').DataTable();

    function taskUserSearchID(searchId) {
        list_data();
        list_data_s();
    }

    function task_card_auto_width() {
        $(".task-card").each(function() {
            var main_card_width = $(this).width();
            var task_header_priority_color = $(this).find(".task-header-priority-color").width();
            var task_header_typename = $(this).find(".task-header-typename").width();

            var main_task_name_width = main_card_width - ((task_header_typename + task_header_priority_color) + (32));
            $(this).find(".main_task_name_width").width(main_task_name_width);

        });
    }
    $(document).on('click', 'body', function() {
        task_card_auto_width();

    });
    $(document).on('mousemove', 'body', function() {
        task_card_auto_width();
    });
    

    function list_data_s() {
        show_val = '<?= json_encode(array('note')); ?>';
        var searchId = $('#task_user_searchId').val();
        var search_date = $('#search_date').val();
        var taskSearchval = $('#task_Search').val();
        var ajaxsearch = <?php echo isset($_GET['filter_id']) ? json_encode($_GET['filter_id']) : 'null' ?>;


        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('new_status_list_data'); ?>",
            data: {
                'table_name': 'lead_label',
                'table': 'tasks',
                'searchId': searchId,
                'search_date': search_date,
                'taskSearchval': taskSearchval,
                'show_array': show_val,
                'ajaxsearch': ajaxsearch,
                'action': true
            },
            success: function(res) {
                $('.loader').hide();
                datatable_view_first(res);
                main_dragalble();
                task_card_auto_width();
                

            }
        });
    }
    list_data_s();

    function list_data() {
        show_val = '<?= json_encode(array('id', 'subject', 'priority', 'assignto', 'status', 'start_date', 'end_date', 'description', 'attachment')); ?>';
        var searchId = $('#task_user_searchId').val();
        var search_date = $('#search_date').val();
        var taskSearchval = $('#task_Search').val();
        var ajaxsearch = <?php echo isset($_GET['filter_id']) ? json_encode($_GET['filter_id']) : 'null' ?>;

        $.ajax({
            datatype: 'json',
            method: "post",
            url: "task_template_list_data",
            data: {
                'table': 'tasks',
                'searchId': searchId,
                'search_date': search_date,
                'taskSearchval': taskSearchval,
                'ajaxsearch': ajaxsearch,
                'show_array': show_val,
                'action': true
            },
            success: function(res) {
                $('.loader').hide();
                datatable_view_secound(res);
            }
        });
    }

    function datatable_view_secound(html) {
        $('#task_table').DataTable().destroy();
        $('#task_list').html(html);
        var table1 = $('#task_table').DataTable({
            lengthChange: true,
        });
    }

    $('body').on('click', '.plus_btn', function(e) {
        $("form[name='add_form']")[0].reset();
        $("form[name='add_form']").removeClass("was-validated");
        $('.selectpicker').closest('div').removeClass('selectpicker-validation');
        $('.selectpicker').selectpicker('refresh');
        $('#assignto').closest(".main-selectpicker").removeClass("pointer-event-none opacity-50");
        editor_add.setData('');
        $('#u_btn').remove();
        $('.task-add .ck-content').html();
        $('#file_view_add').html('');
        $('.task-toggle2,.text-email,.text3,.task-time,.is-email-div').hide();
        $('.task-toggle1').show();
        $('#task_delete,#update_button').hide();
        $('#cancle_btn,#save_btn_task').show();
        $('.task_switch_button').show();
        $('#task_switch_button').prop('checked', false);
        $('.check_input_primary, #is_email_automation, #is_whatsapp_automation').prop('checked', false);
        $('.showtitle').text("Add");

        $('#assignto option').each(function() {
            if ($(this).val() == '') {
                $(this).remove();
            }
        });
        $('#assignto').selectpicker("refresh");
        $('.assign').show();
        $('.status').show();
        $('.assignto_edit').attr('required');
        $('#status').attr('required');
        setTimeout(() => {
            $('#assignto').append('<option selected="" value="">Select User</option>');
            $('#assignto').selectpicker("refresh");
            jQuery('.recursion_type').selectpicker('refresh');
        }, 500);
        jQuery('.secound_selectpicker').selectpicker('refresh');
    });

    $('body').on('change', '#task_type', function() {
        var task_type_val = $(this).val();
        console.log(task_type_val);
        if (task_type_val == "1" || task_type_val == "2") {
            $('#assignto').html(`<?php
                                    if (isset($task_user)) {
                                        foreach ($task_user as $user_key => $user_value) {
                                            $selected = '';
                                            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && $user_value['id'] == $_SESSION['admin']) {
                                                $selected = $user_value["id"] == 1 ? 'selected' : '';
                                            } elseif (isset($_SESSION['id']) && $user_value['id'] == $_SESSION['id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo '<option value="' . $user_value["id"] . '" ' . $selected . ' >' . $user_value["firstname"] . '</option>';
                                        }
                                    }
                                    ?>`);
            $('.assign').show();
            $('.status').show();
            $('.assignto_edit').attr('required');
            $('#status').attr('required');
            $('#assignto').find("option").removeAttr("selected");
            $('#assignto').append(`<option selected="" value="">Select User</option>`);
            $('#assignto').selectpicker("refresh");
            $('#assignto').closest(".main-selectpicker").removeClass("pointer-event-none opacity-50");
        } else if (task_type_val == "3") {
            $('#assignto').html(`<?php
                                    if (isset($task_user)) {
                                        foreach ($task_user as $user_key => $user_value) {
                                            $selected = '';
                                            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && $user_value['id'] == $_SESSION['admin']) {
                                                $selected = $user_value["id"] == 1 ? 'selected' : '';
                                            } elseif (isset($_SESSION['id']) && $user_value['id'] == $_SESSION['id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo '<option value="' . $user_value["id"] . '" ' . $selected . ' >' . $user_value["firstname"] . '</option>';
                                        }
                                    }
                                    ?>`);
            $('#assignto').selectpicker("refresh");
            $('.assign').hide();
            $('.status').hide();
            $('.assignto_edit').removeAttr('required');
            $('#status').removeAttr('required');
            $('#assignto').closest(".main-selectpicker").addClass("pointer-event-none opacity-50");
        }
    });

    function editModel(ID) {
        $('#task-add').modal('show');
        event.preventDefault();
        $("form[name='add_form']")[0].reset();
        $('#cancle_btn').hide();
        $('#save_btn_task').hide();
        $('.showtitle').text("Edit");
        // $('#update_button, #task_delete').show();
        $('#task_delete').attr('data-delete_id', ID);
        $('#update_button').attr('data-edit_id', ID);
        $('.file_view').text(``);
        $('.file_uploded').text(``);
        $.ajax({
            method: "POST",
            url: 'email_edit_data',
            data: {
                edit_id: ID,
                table: 'tasks',
                action: 'edit'
            },
            success: function(data) {
                var response = JSON.parse(data);
                setTimeout(() => {
                    jQuery('.selectpicker').selectpicker('refresh');
                }, 100);
                $('.delete_btn_viewmodel,.edit_task_from_viewmodel').hide();
                if (response.isupdate == 1) {
                    $('#update_button').show();
                    $('.edit_task_from_viewmodel').show();
                }
                if (response.isdelete == 1) {
                    $('#task-add #task_delete').show();
                    $('.delete_btn_viewmodel').show();
                }
                $("#task_type").val(response[0].type);
                $("#subject").val(response[0].subject);
                $("#priority").val(response[0].priority);
                $("#assignto").val(response[0].assignto_user);
                $("#status").val(response[0].status);
                // $('.task-add .ck-content').text(response[0].description);
                var new_data = response[0].description;
                editor_add.setData(new_data);
                var attch = response[0].attachment;
                if (attch !== "") {
                    $(".file_view_add").html(response.file_html);
                }
                var img_name = response[0].attachment;
                var rcsv = response[0].is_recursive;
                var rrr = response[0].recursive_type;
                if (response[0].type == 1) {
                    $('.task-time').hide();
                    $('.task_switch_button').show();
                    if (rcsv == 1) {

                        $("#recursive_type").val(rrr);
                        $("#task_switch_button").prop("checked", true);
                        $("#recursive_type").val(response[0].recursive_type);
                        $('.task-toggle1').hide();
                        $('.task-toggle2').show();
                        setTimeout(() => {
                            if (rrr == 1) {
                                $('.donotshow').hide();
                                $('.Once').show();
                                // $("#once_date").val(response[0].once_date);
                                dateString = response[0].once_date;
                                var parts = dateString.split(' ');
                                var datePart = parts[0];
                                var timeZone = "<?php echo timezonedata(); ?>";
                                var inputDateFormat = "YYYY-MM-DD";
                                var utcDate = (datePart, inputDateFormat, timeZone);
                                var dateParts = utcDate.split('-');
                                var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                                var timePart = parts[1];
                                // var timePart = response[0].timePart;
                                var inputTimeFormat = "h:mm A";
                                var utcTime = (timePart, inputTimeFormat, timeZone);
                                // Combine the date and time values into a single string
                                var combinedDateTime = newDateFormat + ' ' + utcTime;
                                $('.Once').show();
                                // Set the combined value in the "once_date" input element
                                $("#add_form #once_date").val(combinedDateTime);
                            } else if (rrr == 2) {
                                $('.donotshow').hide();
                                $('.task-time').show();
                                // $("#daily_time").val(response[0].daily_time);
                                var daily_time = response[0].daily_time;
                                var timeZone = "<?php echo timezonedata(); ?>";
                                var inputFormat = "h:mm A";
                                var utcTime = (daily_time, inputFormat, timeZone);
                                $("#add_form #daily_time").val(utcTime);
                            } else if (rrr == 3) {
                                $('.donotshow').hide();
                                $('#weekly_name').selectpicker("refresh");
                                $('.Weekly, .task-time').show();

                                var daily_time = response[0].daily_time;
                                var timeZone = "<?php echo timezonedata(); ?>";
                                var inputFormat = "h:mm A";
                                var utcTime = (daily_time, inputFormat, timeZone);

                                // Set the value of the #weekly_name dropdown
                                $('#weekly_name').val(response[0].weekly_name);

                                // Set the value for the 'daily_time' input
                                $("#add_form #daily_time").val(utcTime);
                            } else if (rrr == 4) {
                                $('.donotshow').hide();
                                $('.Monthly').show();
                                dateString1 = response[0].monthly_date;
                                var parts1 = dateString1.split(' ');

                                var datePart1 = parts1[0];
                                var timeZone = "<?php echo timezonedata(); ?>";
                                var inputDateFormat = "YYYY-MM-DD";
                                var utcDate = (datePart1, inputDateFormat, timeZone);
                                var dateParts = utcDate.split('-');
                                var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                                var timePart1 = parts1[1];
                                var inputTimeFormat = "h:mm A";
                                var utcTime = (timePart1, inputTimeFormat, timeZone);

                                var dateComponents = datePart1.split('-');
                                var year1 = dateComponents[2];
                                var month1 = dateComponents[1];
                                var day1 = dateComponents[0];
                                var monthly_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ' + timePart1;

                                $('#monthly_date').val(monthly_dateFormat); // Set monthly_dateFormat in the "monthly_date" input

                                var combinedDateTime = newDateFormat + ' ' + utcTime;

                                $("#add_form #monthly_date").val(combinedDateTime); // Set combinedDateTime in the "add_form" input

                            } else if (rrr == 5) {
                                $('.donotshow').hide();
                                $('.year').show();
                                dateString2 = response[0].yearly_date;
                                var parts2 = dateString2.split(' ');
                                var datePart2 = parts2[0];


                                var timeZone = "<?php echo timezonedata(); ?>";
                                var inputDateFormat = "YYYY-MM-DD";
                                var utcDate = (datePart2, inputDateFormat, timeZone);
                                var dateParts = utcDate.split('-');
                                var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                                var timePart2 = parts2[1];
                                var inputTimeFormat = "h:mm A";
                                var utcTime = (timePart2, inputTimeFormat, timeZone);

                                var dateComponents = datePart2.split('-');
                                var year2 = dateComponents[0];
                                var month2 = dateComponents[1];
                                var day2 = dateComponents[2];
                                var yearly_dateFormat = day2 + '-' + month2 + '-' + year2 + ' ' + timePart2;

                                $('#yearly_date').val(yearly_dateFormat);
                                var combinedDateTime = newDateFormat + ' ' + utcTime;

                                $("#add_form #yearly_date").val(combinedDateTime);
                            } else {
                                $('.donotshow').hide();
                            }
                        }, 100);
                    } else {
                        $("#task_switch_button").prop("checked", false);
                        $('.task-toggle1').show();
                        $('.task-toggle2').hide();
                        $('.donotshow').hide();
                        dateString1 = response[0].start_date;



                        var parts1 = dateString1.split(' ');



                        var datePart1 = parts1[0];
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputDateFormat = "YYYY-MM-DD";
                        var utcDate = (datePart1, inputDateFormat, timeZone);
                        var dateParts = utcDate.split('-');
                        var formattedDate = datePart1.split('-').reverse().join('-');
                        var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                        var timePart1 = parts1[1];
                        console.log(timePart1);

                        var inputTimeFormat = "h:mm A";
                        var utcTime = (timePart1, inputTimeFormat);
                        // console.log(utcTime);
                        var dateComponents = datePart1.split('-');
                        var year1 = dateComponents[2];
                        var month1 = dateComponents[1];
                        var day1 = dateComponents[0];
                        var start_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ' + timePart1;

                        $('#start_date').val(start_dateFormat); // Set monthly_dateFormat in the "monthly_date" input

                        var combinedstartDateTime = newDateFormat + ' ' + utcTime;

                        var hdfjsdf = start_dateFormat;
                        var startDate_osd = new Date(hdfjsdf);
                        var options = {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            second: 'numeric',
                            hour12: true // Use 12-hour format with AM/PM
                        };

                        var result1 = startDate_osd.toLocaleDateString('en-GB', options).replace(/[\/,]/g, '-');
                        result1 = result1.replace(/-(\s\d+:\d+:\d+\s[APMapm]+)/, ' $1');
                        $("#add_form #start_date").val(result1);
                        // var dateParts = response[0].start_date.split('-');
                        // if (dateParts.length === 3) {
                        //     var year = dateParts[0];
                        //     var month = dateParts[1];
                        //     var day = dateParts[2];
                        //     var start_formattedDate = day + '-' + month + '-' + year;
                        // }
                        dateString12 = response[0].end_date;
                        var parts12 = dateString12.split(' ');
                        var datePart12 = parts12[0];
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputDateFormat = "YYYY-MM-DD";
                        var utcDate = (datePart12, inputDateFormat, timeZone);
                        var dateParts = utcDate.split('-');
                        var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                        var timePart1 = parts12[1];
                        var inputTimeFormat = "h:mm A";
                        var utcTime = (timePart1, inputTimeFormat, timeZone);
                        var dateComponents = datePart12.split('-');
                        var year1 = dateComponents[2];
                        var month1 = dateComponents[1];
                        var day1 = dateComponents[0];
                        var end_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ' + timePart1;
                        $('#end_date').val(end_dateFormat); // Set monthly_dateFormat in the "monthly_date" input
                        var combinedendDateTime = newDateFormat + ' ' + utcTime;


                        var end_final_date = end_dateFormat;
                        var startDate_osd80 = new Date(end_final_date);
                        var options50 = {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            second: 'numeric',
                            hour12: true // Use 12-hour format with AM/PM
                        };

                        var result120 = startDate_osd80.toLocaleDateString('en-GB', options50).replace(/[\/,]/g, '-');
                        result120 = result120.replace(/-(\s\d+:\d+:\d+\s[APMapm]+)/, ' $1');
                        $("#add_form #end_date").val(result120);
                        // var end_dateParts = response[0].end_date.split('-');
                        // if (end_dateParts.length === 3) {
                        //     var end_year = end_dateParts[0];
                        //     var end_month = end_dateParts[1];
                        //     var end_day = end_dateParts[2];
                        //     var end_formattedDate = end_day + '-' + end_month + '-' + end_year;
                        // }
                        // $("#start_date").val(start_formattedDate);
                        // $("#end_date").val(end_formattedDate);
                    }
                } else {
                    alert();

                    $("#recursive_type").val(rrr);
                    $('.task_switch_button,.task-toggle1,.task-time').hide();
                    $('.task-toggle2,.is-email-div').show();
                    if (rrr == 1) {
                        $('.donotshow').hide();
                        dateString = response[0].once_date;
                        var parts = dateString.split(' ');
                        var datePart = parts[0];
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputDateFormat = "YYYY-MM-DD";
                        var utcDate = (datePart, inputDateFormat, timeZone);
                        var dateParts = utcDate.split('-');
                        var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                        var timePart = parts[1];
                        // var timePart = response[0].timePart;
                        var inputTimeFormat = "h:mm A";
                        var utcTime = (timePart, inputTimeFormat, timeZone);
                        // Combine the date and time values into a single string
                        var combinedDateTime = newDateFormat + ' ' + utcTime;
                        $('.Once').show();
                        // Set the combined value in the "once_date" input element
                        $("#add_form #once_date").val(combinedDateTime);

                    } else if (rrr == 2) {
                        $('.donotshow').hide();
                        $('.task-time').show();
                        // $('#daily_time').val(response[0].daily_time);

                        var daily_time = response[0].daily_time;
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputFormat = "h:mm A";
                        var utcTime = (daily_time, inputFormat, timeZone);
                        $("#add_form #daily_time").val(utcTime);

                    } else if (rrr == 3) {
                        $('.donotshow').hide();
                        $('.Weekly,.task-time').show();
                        $('#weekly_name').val(response[0].weekly_name);
                        // console.log(weekly_name);
                        var daily_time = response[0].daily_time;
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputFormat = "h:mm A";
                        var utcTime = (daily_time, inputFormat, timeZone);
                        $("#add_form #daily_time").val(utcTime);
                    } else if (rrr == 4) {
                        $('.donotshow').hide();
                        $('.Monthly').show();
                        dateString1 = response[0].monthly_date;
                        var parts1 = dateString1.split(' ');

                        var datePart1 = parts1[0];
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputDateFormat = "YYYY-MM-DD";
                        var utcDate = (datePart1, inputDateFormat, timeZone);
                        var dateParts = utcDate.split('-');
                        var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                        var timePart1 = parts1[1];
                        var inputTimeFormat = "h:mm A";
                        var utcTime = (timePart1, inputTimeFormat, timeZone);

                        var dateComponents = datePart1.split('-');
                        var year1 = dateComponents[2];
                        var month1 = dateComponents[1];
                        var day1 = dateComponents[0];
                        var monthly_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ' + timePart1;

                        $('#monthly_date').val(monthly_dateFormat); // Set monthly_dateFormat in the "monthly_date" input

                        var combinedDateTime = newDateFormat + ' ' + utcTime;

                        $("#add_form #monthly_date").val(combinedDateTime); // Set combinedDateTime in the "add_form" input

                    } else if (rrr == 5) {
                        $('.donotshow').hide();
                        $('.year').show();
                        dateString2 = response[0].yearly_date;
                        var parts2 = dateString2.split(' ');
                        var datePart2 = parts2[0];


                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputDateFormat = "YYYY-MM-DD";
                        var utcDate = (datePart2, inputDateFormat, timeZone);
                        var dateParts = utcDate.split('-');
                        var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                        var timePart2 = parts2[1];
                        var inputTimeFormat = "h:mm A";
                        var utcTime = (timePart2, inputTimeFormat, timeZone);

                        var dateComponents = datePart2.split('-');
                        var year2 = dateComponents[0];
                        var month2 = dateComponents[1];
                        var day2 = dateComponents[2];
                        var yearly_dateFormat = day2 + '-' + month2 + '-' + year2 + ' ' + timePart2;

                        $('#yearly_date').val(yearly_dateFormat);
                        var combinedDateTime = newDateFormat + ' ' + utcTime;

                        $("#add_form #yearly_date").val(combinedDateTime);
                    }
                    var is_email_automation = response[0].is_email_automation;
                    if (is_email_automation == 1) {
                        $("#is_email_automation").prop("checked", true);
                        $('.text-email').show();
                        $('#customer_email').val(response[0].customer_email);
                    } else {
                        $("#is_email_automation").prop("checked", false);
                        $('.text-email').hide();
                    }
                    var is_whatsapp_automation = response[0].is_whatsapp_automation;
                    if (is_whatsapp_automation == 1) {
                        $("#is_whatsapp_automation").prop("checked", true);
                        $('#customer_mobile').val(response[0].customer_mobile);
                        $('.text3').show();
                    } else {
                        $("#is_whatsapp_automation").prop("checked", false);
                        $('.text3').hide();
                    }
                }
            }
        });
    }
    $(".deleted-all").on('click', function(e) {
        e.preventDefault();
        var checkbox = $('.table_list_check:checked');
        Swal.fire({
            title: 'Are you sure?',
            text: "Do You really want to delete these record? You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancle',
            cancelButtonColor: '#6e7881',
            confirmButtonColor: '#dd3333',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                if (checkbox.length > 0) {
                    var checkbox_value = [];
                    $(checkbox).each(function() {
                        checkbox_value.push($(this).attr("data-delete_id"));
                    });
                    $.ajax({
                        url: "delete_all",
                        method: "post",
                        data: {
                            action: 'delete',
                            checkbox_value: checkbox_value,
                            table: 'tasks',
                        },
                        success: function(data) {
                            $(checkbox).closest("tr").fadeOut();
                            // list_data();
                            $("#deleteButton").hide();
                            $("#select-all").prop("checked", false);
                            iziToast.error({
                                title: 'Deleted Successfully'
                            });
                        }
                    });
                }
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                $('.loader').hide();
            }
        });
    });
    $('body').on('click', '.task_delete', function() {
        var id = $(this).attr("data-delete_id");
        Swal.fire({
            title: 'Are you sure?',
            text: "Do You really want to delete these record? You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancle',
            cancelButtonColor: '#6e7881',
            confirmButtonColor: '#dd3333',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "post",
                    url: "<?= site_url('task_delete_data'); ?>",
                    data: {
                        action: 'delete',
                        del_id: id,
                        table: 'tasks'
                    },
                    success: function(data) {
                        list_data();
                        list_data_s();
                        iziToast.error({
                            title: 'Delete successfully'
                        });
                    }
                });
            }
        });
    });
    $("body").on('click', '#update_button', function(e) {
        e.preventDefault();
        var form = $("#add_form")[0];
        var formdata = new FormData(form);
        var pText = "";
        var pText_add = "";
        $("#file_view_add #u_btn p").each(function() {
            pText_add += $(this).text().trim() + ",";
        });
        pText = pText_add.slice(0, -1).trim();
        var description = $('.task-add .ck-content').html();
        var attachment = $('#attachment').val();
        var switch_btn = 0;
        if ($('#task_type').val() == 1) {
            var switch_btn = $('#task_switch_button').prop('checked') ? 1 : 0;
        } else {
            var is_email_automation = $('#is_email_automation').is(':checked') ? 1 : 0;
            var is_whatsapp_automation = $('#is_whatsapp_automation').is(':checked') ? 1 : 0;
            formdata.append('is_email_automation', is_email_automation);
            formdata.append('is_whatsapp_automation', is_whatsapp_automation);
        }
        var update_id = $(this).attr("data-edit_id");
        var priority_color = $('#priority').find(':selected').attr('data-color-code');
        formdata.append('is_recursive', switch_btn);
        formdata.append('priority_color', priority_color);
        formdata.append('description', description);
        formdata.append('pText_add', pText);
        formdata.append('attachment', attachment);
        if (update_id != "" && $('#subject').val() != "" && $('#priority').val() != "" && $('#assignto').val() != "" && $('#status').val() != "") {
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', 'tasks');
            $.ajax({
                method: "post",
                url: "tasks_update_data",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(res) {
                    list_data();
                    list_data_s();
                    iziToast.success({
                        title: 'Update Successfully Updated',
                        message: ''
                    });
                    $('#task-add').modal('hide');
                },
                error: function(error) {
                    alert();
                }
            });
        } else {}
        // list_data();
    });
    // ========================================== edit-model throw update data code complited =====================================
    $("body").on('click', '.view_model_div, .view_model_div1', function() {
        $(".task_details_btndiv").trigger("click");
        var tasks_id = $(this).attr("data-task-id");
        var data_attchment = $(this).attr('data-attachment');
        $('.attachment_title').attr('data-attachment', data_attchment);
        var store_val = '';
        if (data_attchment != "") {
            var outputArray = data_attchment.split(",");
            for (const value of outputArray) {
                store_val += '<div class="border-bottom px-3 py-2 d-flex align-items-center justify-content-between main_attch_div" id="main_attch_div"><div class="d-flex align-items-center"><div class="me-3"><img src="<?php echo base_url() ?>assets/images/task_attachment/' + value + '" alt="" width="28" height="28" class="object-fit-cover"></div><div><p class="text-gray ff-second fs-14 fw-light mb-0">' + value + '</p></div></div><div class="p-2 border border-danger rounded-2 ms-auto cursor-pointer delete_attach_btn" data_file = "' + value + '" data_tasks_id = "' + tasks_id + '" id="file_crodd_btn1" ><i class="bi bi-x fs-14 text-danger d-flex"></i></div></div>';
                //  store_val += '<div class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between main_attch_div"><p class="ms-3">' + value + '</p><div class="border-start d-flex p-2 cursor-pointer delete_attach_btn" data_tasks_id = "' + tasks_id + '" data_file = "' + value + '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#a7acb1" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></div></div>';
            }
        } else {
            store_val += '<div class="attachment my-2 bg-white shadow-sm rounded-2 d-flex align-items-center justify-content-between"><p class="ms-3">No Attchment</p></div>';
        }
        $('.store_html_attch').html(store_val);
        $('.edit_task_from_viewmodel').attr('data_edit_id', tasks_id);
        var priority = $(this).attr("data-priority");
        var data_priority_color = $(this).attr("data-priority-color");
        $('.task_priority_set_div').html('<span class="fs-12 rounded-pill task-Low text-white px-2" style="background-color:' + data_priority_color + '">' + priority + '</span>');
        if (tasks_id != "") {
            $('.loader').hide();
            $.ajax({
                type: "post",
                url: "<?= site_url('edit_data'); ?>",
                data: {
                    action: 'edit',
                    edit_id: tasks_id,
                    table: 'tasks'
                },
                success: function(res) {
                    var response = JSON.parse(res);
                    $('.is-task-div,.is-other-div').hide();
                    if (response[0].type == 1 && response[0].is_recursive == 0) {

                        // var dateParts = response[0].start_date.split('-');
                        // if (dateParts.length === 3) {
                        //     var year = dateParts[0];
                        //     var month = dateParts[1];
                        //     var day = dateParts[2];
                        //     var start_formattedDate = day + '-' + month + '-' + year;
                        // }
                        dateString1 = response[0].start_date;
                        var parts1 = dateString1.split(' ');

                        var datePart1 = parts1[0];
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputDateFormat = "YYYY-MM-DD";
                        var utcDate = (datePart1, inputDateFormat, timeZone);
                        var dateParts = utcDate.split('-');
                        var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                        var timePart1 = parts1[1];
                        var inputTimeFormat = "h:mm A";
                        var utcTime = (timePart1, inputTimeFormat, timeZone);

                        var dateComponents = datePart1.split('-');
                        var year1 = dateComponents[2];
                        var month1 = dateComponents[1];
                        var day1 = dateComponents[0];
                   

                        var start_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ' + timePart1;

                        $('#start_date').val(start_dateFormat); // Set monthly_dateFormat in the "monthly_date" input

                        var normal_time = start_dateFormat;
                        var startDate_osd = new Date(normal_time);
                        var options = {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            second: 'numeric',
                            hour12: true // Use 12-hour format with AM/PM
                        };

                        var result1 = startDate_osd.toLocaleDateString('en-GB', options).replace(/[\/,]/g, '-');
                        result1 = result1.replace(/-(\s\d+:\d+:\d+\s[APMapm]+)/, ' $1');

                        var combinedstartDateTime = newDateFormat + ' ' + utcTime;

                        $(".start_data_view_model").text(result1);
                        dateString12 = response[0].end_date;
                        var parts12 = dateString12.split(' ');
                        var datePart12 = parts12[0];
                        var timeZone = "<?php echo timezonedata(); ?>";
                        var inputDateFormat = "YYYY-MM-DD";
                        var utcDate = (datePart12, inputDateFormat, timeZone);
                        var dateParts = utcDate.split('-');
                        var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                        var timePart1 = parts12[1];
                        var inputTimeFormat = "h:mm A";
                        var utcTime = (timePart1, inputTimeFormat, timeZone);
                        var dateComponents = datePart12.split('-');
                        var year1 = dateComponents[2];
                        var month1 = dateComponents[1];
                        var day1 = dateComponents[0];
                        var end_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ' + timePart1;
                        $('#end_date').val(end_dateFormat); // Set monthly_dateFormat in the "monthly_date" input
                        var combinedendDateTime = newDateFormat + ' ' + utcTime;
                        var end_final_date = end_dateFormat;
                        var startDate_osd80 = new Date(end_final_date);
                        var options50 = {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            second: 'numeric',
                            hour12: true // Use 12-hour format with AM/PM
                        };

                        var result120 = startDate_osd80.toLocaleDateString('en-GB', options50).replace(/[\/,]/g, '-');
                        result120 = result120.replace(/-(\s\d+:\d+:\d+\s[APMapm]+)/, ' $1');
                        $(".end_data_view_model").text(result120);
                        // var end_dateParts = response[0].end_date.split('-');
                        // if (end_dateParts.length === 3) {
                        //     var end_year = end_dateParts[0];
                        //     var end_month = end_dateParts[1];
                        //     var end_day = end_dateParts[2];
                        //     var end_formattedDate = end_day + '-' + end_month + '-' + end_year;
                        // }
                        $('.is-task-div').show();
                        // $(".start_data_view_model").text(start_formattedDate);
                        // $('.end_data_view_model').text(end_formattedDate);
                    } else {
                        $('.is-other-div').show();
                        var recursiveType = response[0].recursive_type;
                        if (recursiveType == 1) {
                            var meetingtype = 'Once';
                            dateString = response[0].once_date;
                            var parts = dateString.split(' ');
                            var datePart = parts[0];
                            var timeZone = "<?php echo timezonedata(); ?>";
                            var inputDateFormat = "YYYY-MM-DD";
                            var utcDate = (datePart, inputDateFormat, timeZone);
                            var dateParts = utcDate.split('-');
                            var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                            var timePart = parts[1];
                            // var timePart = response[0].timePart;
                            var inputTimeFormat = "h:mm A";
                            var utcTime = (timePart, inputTimeFormat, timeZone);
                            // Combine the date and time values into a single string
                            var combinedDateTime = newDateFormat + ' ' + utcTime;
                            var typedate = combinedDateTime;
                        } else if (recursiveType == 2) {
                            var meetingtype = 'Daily';
                            var daily_time = response[0].daily_time;
                            var timeZone = "<?php echo timezonedata(); ?>";
                            var inputFormat = "h:mm A";
                            var utcTime = (daily_time, inputFormat, timeZone);
                            var typedate = utcTime;
                        } else if (recursiveType == 3) {
                            var meetingtype = 'Weekly';
                            var daily_time = response[0].daily_time;
                            var timeZone = "<?php echo timezonedata(); ?>";
                            var inputFormat = "h:mm A";
                            var utcTime = (daily_time, inputFormat, timeZone);
                            var typedate = 'Week : ' + response[0].weekly_name + ', Time :' + utcTime;
                        } else if (recursiveType == 4) {
                            var meetingtype = 'Monthly';
                            dateString1 = response[0].monthly_date;
                            var parts1 = dateString1.split(' ');
                            var datePart1 = parts1[0];
                            var timeZone = "<?php echo timezonedata(); ?>";
                            var inputDateFormat = "YYYY-MM-DD";
                            var utcDate = (datePart1, inputDateFormat, timeZone);
                            var dateParts = utcDate.split('-');
                            var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                            var timePart1 = parts1[1];
                            var inputTimeFormat = "h:mm A";
                            var utcTime = (timePart1, inputTimeFormat, timeZone);
                            var dateComponents = datePart1.split('-');
                            var year1 = dateComponents[2];
                            var month1 = dateComponents[1];
                            var day1 = dateComponents[0];
                            var monthly_dateFormat = day1 + '-' + month1 + '-' + year1 + ' ' + timePart1;
                            // $('#monthly_date').val(monthly_dateFormat); // Set monthly_dateFormat in the "monthly_date" input
                            var combinedDateTime = newDateFormat + ' ' + utcTime;
                            var typedate = combinedDateTime;
                        } else if (recursiveType == 5) {
                            var meetingtype = 'Yearly';
                            dateString2 = response[0].yearly_date;
                            var parts2 = dateString2.split(' ');
                            var datePart2 = parts2[0];
                            var timeZone = "<?php echo timezonedata(); ?>";
                            var inputDateFormat = "YYYY-MM-DD";
                            var utcDate = (datePart2, inputDateFormat, timeZone);
                            var dateParts = utcDate.split('-');
                            var newDateFormat = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                            var timePart2 = parts2[1];
                            var inputTimeFormat = "h:mm A";
                            var utcTime = (timePart2, inputTimeFormat, timeZone);
                            var dateComponents = datePart2.split('-');
                            var year2 = dateComponents[0];
                            var month2 = dateComponents[1];
                            var day2 = dateComponents[2];
                            var yearly_dateFormat = day2 + '-' + month2 + '-' + year2 + ' ' + timePart2;
                            // $('#yearly_date').val(yearly_dateFormat);
                            var combinedDateTime = newDateFormat + ' ' + utcTime;
                            var typedate = combinedDateTime;
                        }
                        $('.otherdate-type').text(meetingtype + ' - (' + typedate + ')');
                    }
                    $('.subject_view_model').text(response[0].subject);
                    var description = response[0].description;
                    if (description != '<p><br data-cke-filler="true"></p>') {
                        description = description;
                    } else {
                        description = '<p>No Description</p>';
                    }
                    $('.description_show_div').html(description);
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
            // for task comment
            $.ajax({
                type: "post",
                url: "<?= site_url('show_task_comments'); ?>",
                data: {
                    edit_id: tasks_id,
                    table: 'task_comments'
                },
                success: function(res) {
                    $('.show_comment_div').html(res);
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

    $('body').on('click', '.delete_attach_btn', function() {
        var data_file = $(this).attr('data_file');
        var all_file = $('.attachment_title').attr('data_attachment');
        var edit_id = $(this).attr('data_tasks_id');
        var file = '';
        if (all_file != "") {
            var outputArray = all_file.split(",");
            for (const value of outputArray) {
                if (value != data_file) {
                    if (file != '') {
                        file += ',' + value;
                    } else {
                        file += value;
                    }
                }
            }
        }
        if (file != '') {
            $.ajax({
                method: "post",
                url: "<?= site_url('update_data'); ?>",
                data: {
                    'table': 'tasks',
                    'edit_id': edit_id,
                    'action': 'update',
                    'attachment': file
                },
                success: function(res) {
                    list_data();
                    list_data_s();
                    iziToast.delete({
                        title: 'Attachment Successfully Deleted'
                    });
                }
            });
            $(this).closest('.main_attch_div').remove();
        }
    });
    $('body').on('click', '.edit_task_from_viewmodel', function() {
        var edit_id = $(this).attr('data_edit_id');
        $(".task_edit_model_" + edit_id).trigger("click");
    });
    $('body').on('click', '.assign_to_viewmodel', function() {
        var edit_id = $('.edit_task_from_viewmodel').attr('data_edit_id');
        $(".assign_task_div_" + edit_id).trigger("click");
    });
    $('body').on('click', '.delete_btn_viewmodel', function() {
        var edit_id = $('.edit_task_from_viewmodel').attr('data_edit_id');
        $(".task_delete_" + edit_id).trigger("click");
    });
    $('body').on('click', '.delete_comment_btn', function() {
        var id = $(this).attr("data-delete_id");
        // var comment_id = $(this).attr('comment_id');
        var tasks_id = $(this).attr('tasks_id');
        $('.slice_div_comment_' + id).remove();
        $.ajax({
            type: "post",
            url: "<?= site_url('delete_data'); ?>",
            data: {
                action: 'delete',
                del_id: id,
                table: 'task_comments'
            },
            success: function(res) {
                iziToast.error({
                    title: 'Delete successfully'
                });
                $("#pills-taskcard-tab").trigger("click");
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    });
    $("body").on('click', '.comment_add_task_id', function(e) {
        var tasks_id = $(this).attr("task_table_id");
        $('.comment_add_btn').attr('task_table_id', tasks_id);
    });
    $("body").on('click', '.comment_add_btn', function(e) {
        <?php
        $username = session_username($_SESSION['username']);
        $table_comment = $username . '_task_comments';
        $columns_comment = [
            'id int(11) primary key AUTO_INCREMENT NOT NULL',
            'task_id int(11) NOT NULL',
            'comment varchar(1000) NOT NULL',
            'date_time DATETIME NOT NULL',
        ];
        $ntable = tableCreateAndTableUpdate($table_comment, '', $columns_comment);
        ?>
        var tasks_id = $(this).attr("task_table_id");
        var comment = $('.add-comment .ck-content').html();
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        var current_date = `${day}-${month}-${year}`;
        var time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
        var date_time = current_date + " " + time;
        if (tasks_id !== "" && comment !== "") {
            $.ajax({
                method: "post",
                url: "<?= site_url('insert_data'); ?>",
                data: {
                    task_id: tasks_id,
                    comment: comment,
                    table: "task_comments",
                    action: "insert",
                    date_time: date_time
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Comment Successfully Added'
                    });
                    list_data_s();
                    list_data();
                }
            });
        }
    });
    $('body').on('click', '.assign_task_update', function() {
        var tasks_id = $(this).attr("data_edit_id");
        var assignto = $('#list_data_assign').val();
        $.ajax({
            method: "post",
            url: "<?= site_url('update_data'); ?>",
            data: {
                assignto_user: assignto,
                edit_id: tasks_id,
                table: "tasks",
                action: "update"
            },
            success: function(res) {
                iziToast.success({
                    title: 'Assign Successfully '
                });
                list_data_s();
            }
        });
    });
    $('body').on('click', '.assign_task_div', function() {
        var tasks_id = $(this).attr("data_edit_id");
        $('.assign_task_update').attr('data_edit_id', tasks_id);
        if (tasks_id != "") {
            $.ajax({
                type: "post",
                url: "<?= site_url('edit_data'); ?>",
                data: {
                    action: 'edit',
                    edit_id: tasks_id,
                    table: 'tasks'
                },
                success: function(res) {
                    var response = JSON.parse(res);
                    setTimeout(() => {
                        jQuery('.assigned_to_edit').selectpicker('refresh');
                    }, 100);
                    $(".assigned_to_edit").val(response[0].assignto);
                }
            });
        }
    });
    $("body").on('click', '.save_comment_from_task', function(e) {
        var note = $(this).attr("task_title");
        var task_id = $(this).attr("task_id");
        var sticky_note_stuts = $(this).attr("task_sticky_note_stuts");
        if (sticky_note_stuts == "0") {
            $.ajax({
                method: "post",
                url: "<?= site_url('insert_data'); ?>",
                data: {
                    note: note,
                    task_id: task_id,
                    table: "notes",
                    action: "insert"
                },
                success: function(res) {
                    if (res != "error") {
                        iziToast.success({
                            title: 'Task Note Successfully Added'
                        });
                        edit_id = task_id
                        var sticky_note_stuts = "1";
                        $.ajax({
                            method: "post",
                            url: "<?= site_url('update_data'); ?>",
                            data: {
                                sticky_note_stuts: sticky_note_stuts,
                                edit_id: edit_id,
                                table: "tasks",
                                action: "update"
                            },
                            success: function(res) {}
                        });
                    } else {
                        iziToast.error({
                            title: 'Task-Note Already Added'
                        });
                    }
                    list_data_s();
                    list_data();
                }
            });
        } else {
            iziToast.error({
                title: 'Task-Note Already Added'
            });
        }
        $("#pills-main-task-tab").click(function() {});
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    $('body').on('click', '.task-card', function() {
        $(".custm-up-class").removeClass("task-z-index");
        $(".task-up-down-a").attr("style", "transform: rotate(0deg);transition: all 0.4s;");
        $(this).closest(".custm-up-class").addClass("task-z-index");
        $(this).find(".task-up-down-a").attr("style", "transform: rotate(180deg);transition: all 0.4s;");
    });
    $('body').on('click', '.task-z-index .task-card', function() {
        $(this).closest(".custm-up-class").removeClass("task-z-index");
        $(this).find(".task-up-down-a").attr("style", "transform: rotate(0deg);transition: all 0.4s;");
    });

    function main_dragalble() {
        var main = document.querySelector('#hygtfytfuytuyv');
        var list = Sortable.create(main, {
            group: 'task-main-board',
            sort: true,
            filter: '.add-card',
            draggable: '.task-main-board',
            ghostClass: "ghost",
            dragoverBubble: true,
            onEnd: cardMoved,
        });

        function initContent() {
            var dropzones = document.querySelectorAll('.task-card-main-edit');
            for (item of dropzones) {
                Sortable.create(item, {
                    group: 'task-card-main-edit-box',
                    sort: true,
                    draggable: '.task-card-main-edit-box',
                    ghostClass: "ghost",
                    onEnd: cardMoved,
                });
            }
        }
        initContent();

        

        function cardMoved(evt) {
            var item = evt.item;
            var from = evt.from;
            var toDiv = evt.to;

            // Check if the card is moved to a different list
            if (from !== toDiv) {
                var taskType = $(item).find('.view_model_div_controller_task').attr("data-task-type");
                var taskID = $(item).find('.view_model_div_controller_task').attr("data-task-id");
                var taskStatus = $(toDiv).attr("data_task_status");
               
                $.ajax({
                    method: "post",
                    url: "<?= site_url('task_status_update_data'); ?>",
                    data: {
                        status_id: taskStatus,
                        id: taskID,
                        type: taskType,
                        table: "tasks",
                    },
                    success: function(res) {
                        var response = JSON.parse(res);
                        if (response.response == 1) {
                            iziToast.success({
                                title: response.message
                            });

                            // Update the UI after a successful response
                            list_data_s();
                            list_data();
                        } else {
                            iziToast.error({
                                title: response.message
                            });
                        }
                    }
                });
            }
        }
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
            if (el.parentElement.className === 'task-main-board initial') {
                el.parentElement.className = 'add-list';
            }
            if (el.parentElement.className === 'task-main-board pending') {
                el.parentElement.className = 'task-main-board';
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
            }
        }

        function elMouseLeaveHandler(e) {
            var del = e.target.querySelector('hdsgf');
            if (del) e.target.removeChild(del);
        }
    }
</script>