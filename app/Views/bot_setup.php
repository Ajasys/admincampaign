<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<?php
if (isset($_GET['bot_id'])) {
    $botId = $_GET['bot_id'];
} else {
    $botId = "";
}

$master_bot_typeof_question = json_decode($master_bot_typeof_question, true);
$admin_bot_setup = json_decode($admin_bot_setup, true);
$admin_bot = json_decode($admin_bot, true);
?>

<style>
    .fs-12 {
        font-size: 12px;
    }

    .bot-box {
        width: 100%;
        height: 85px;
        transition: all 0.3s ease-in-out;
        background-color: #f4f4f6;
        cursor: move;
    }

    .bot-box:hover {
        box-shadow: 0 0 5px 2px #0000004d;
    }

    .bot-flow-setup {
        background-color: #f4f4f6;
        transition: all 0.5s ease-in-out;
    }

    .bot-flow-setup:hover {
        box-shadow: 0 0 5px 2px #0000004d;
    }

    .icon {
        color: #724EBF;
    }

    .bot-box:hover {
        opacity: 0.7;
    }

    .bot-box.dragged {
        opacity: .3;
        cursor: default;
    }

    .droppable {
        outline: 3px dotted transparent;
        background-color: #f4f4f6;
    }

    .media-upload-box {
        border: 2px dotted black;
    }

    .modal-card-body-main {
        background: #f0e4f6;
    }

    .form-control:focus {
        box-shadow: 0px 0px 0px black;
    }

    .input-group>.form-control:focus {
        z-index: 0;
    }

    .messege-sub {
        background-color: #724EBF;
    }

    .messege-scroll::-webkit-scrollbar {
        display: none;
    }

    .form-check-input:checked {
    background-color: var(--second-color);
    border-color: var(--all-light);
}
    .second-add {
        display: block !important;
    }

    .second-remove {
        display: none !important;
    }

    .user-table .nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
  color: var(--first-color) !important;
}

.list-group-item.active {
    z-index: 2;
    color: var(--bs-list-group-active-color);
    background-color: var(--first-color) !important;
    border-color:1px solid var(--all-light);
}

.main-task{
    font-size: 15px;
}
.user_reply{
    font-size: 15px;
}
.modal{
    font-size: 15px;
    padding: 0px !important;
}
.modal button{
    font-size: 15px;
}
.modal select{
    font-size: 15px;
}

@media  (max-width:600px){
.main-task{
    font-size: 13px;
} 
.user_reply{
    font-size: 13px;
}
.modal{
    font-size: 12px;
}
.modal button{
    font-size: 12px;
}
.modal select{
    font-size: 12px;
}

}

</style>


<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1 flex-wrap justify-content-between">
                <div class="col d-flex flex-wrap align-items-center">
                    <i class="bi bi-gear-fill mx-2"></i>
                    <h2>Bot Setup</h2>
                </div>
                <button type="button" class="btn-primary bot_preview" data-bs-toggle="modal" data-bs-target="#chat_withbot">Preview</button>
            </div>


            <div class="col-12 d-flex flex-wrap ">
                <div class="col-12 col-lg-4 p-1 ">
                    <div class="col-12 border rounded-3 bg-white p-3 overflow-y-scroll d-flex flex-wrap" style="height:80vh">
                        <div class="col-12  d-flex justify-content-between my-3">
                            <div class="col-6">
                                <div class="main-selectpicker">
                                    <select class="form-control main-control from-main selectpicker" aria-label="Default select example">
                                        <option selected>Main Flow</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-1 d-none">
                                <button class="btn-primary-rounded mx-1 All_memberPlusBtn" id="plus_btn" data-bs-toggle="modal" datamno="" data-bs-target="#add-member">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>Ask User</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="bot_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                            <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="What is Your Name?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Question') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="What is Your Gender?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-circle-dot icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Single Choice') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Enter Your Email.">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-envelope icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Email') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="What type of food do you eat?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-check-square icon" ng-class="i.icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Multiple Choice') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Enter your mobile number">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-mobile-screen-button icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Mobile Number') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="How many bots do you want?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-hashtag icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Number') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="How would you rate our company?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-star icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Rating') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="When is your birthday?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-calendar-days icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Date Picker') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="In which slot would you like to book the appointment?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-clock icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Time Picker') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Where do you live?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-location-dot icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Location') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="What is your age?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-expand icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Range') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Can you upload a file?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-upload icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'File Upload') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Can you give us your website?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-link icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Website') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Please share your contact details">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-user-plus icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Ask Contacts') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Choose item(s)">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-shopping-cart icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Order Items') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Please authenticate">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-key icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Authenticator') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Please share your full address">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-brands fa-forumbee icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Form') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="Pick an item of your choices">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-list icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Carousel with buttons') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="This will call your api and show the response to the user">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-bullseye icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Dynamic Question') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="This will call your api and show the search result in real time to the user">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-search icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Real Time Search') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3  p-2 question_add" data-qu="When would you like to book your appointment?">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-calendar-check icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Appointment Booking') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>Show User</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Hello">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-quote-left icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Statement') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Follow us on facebook for more updates.">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-compass icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'URL Navigator') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Here are recommended products for you">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-sharp fa-solid fa-sliders icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Product Carousel') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="These are product samples">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-image icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Carousel') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Listen to this">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-file-audio icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Audio') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Our contact(s)">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-sharp fa-solid fa-address-book icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">

                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Show Contacts') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Our Location">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-sharp fa-solid fa-paper-plane icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Show Location') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Our Logo">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-file icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Show File') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="URL Auto Redirect">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-arrow-up-right-from-square icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'URL Auto Redirect') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="URL Based Flow">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-scissors icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'URL Based Flow') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Country Based Flow">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-earth-americas icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Country Based Flow') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Action Based Flow">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-signs-post icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Action Based Flow') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" class="btn-primary">Setup Menu Options</button>
                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>FAQs Setup</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-circle-question icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'FAQs') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>AI Enabled</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-brands fa-wpexplorer icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'AI Answering') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" class="btn-primary">Map Intents</button>
                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>Live Agent</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Talk to out live agent">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-headphones icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Human Handover') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-diamond-turn-right icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Live Chats Redirect to whatsapp') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>Only For Whatsapp</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Choose one template">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-comment-dots icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Templates Based Flow') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Whatsapp Message Based Flow">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-users icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Users Initial Respone Based Flow') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Choose From the below list">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-list-ol icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Menu List') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="======Cart Summery======">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-cart-shopping icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Cart') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Adding the whatsapp button.">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-brands fa-whatsapp icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Buttons') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Adding the whatsapp catalog">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-cart-arrow-down icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Catalog') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="Provide Address">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-map-pin icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Address') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add" data-qu="WhatsApp Ad Based Flow">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-rectangle-ad icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Ad Based Flow') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>Only For Instagram</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-brands fa-instagram icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Generic Template') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 col-sm-4 col-md-3 col-lg-5 col-xl-4 col-xxl-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center" draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-brands fa-instagram icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <?php
                                            if (isset($master_bot_typeof_question)) {
                                                foreach ($master_bot_typeof_question as $type_key => $type_value) {
                                                    if ($type_value['question_type'] == 'Ice Breakers') {
                                                        echo '<span class="span_text text-center" data-question_id=' . $type_value["id"] . '>' . $type_value["question_type"] . '</span>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


                <div class="col-8 p-1 ">
                    <div class="main-task col-12 border rounded-3 bg-white overflow-y-scroll left-main-task ps-3 overflow-y-scroll bot_list" style="height:80vh" style="max-height:546.8px">
                        <!-- <div class="col-12 w-100 d-flex flex-wrap p-2">
                            <div class="col-12 droppable d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
                                <div class="col-10 d-flex flex-wrap align-items-center">
                                    <label class="text-wrap px-2" for="">
                                        <p class="fw-semibold">? What is your name</p>
                                    </label>
                                </div>
                                <div class="col-2 d-flex flex-wrap align-items-center">
                                    <div class="col-3 p-1">
                                        <i class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#add-email"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">User's Replay</button>
                            </div>
                        </div> -->


                        <!-- <div class="col-12 w-100 d-flex flex-wrap p-2">
                            <div class="col-12 d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
                                <div class="col-10 d-flex flex-wrap align-items-center">
                                    <label class="text-wrap px-2" for="">
                                        <p class="fw-semibold">? Great Enter Your email</p>
                                    </label>
                                </div>
                                <div class="col-2 d-flex flex-wrap align-items-center">
                                    <div class="col-3 p-1">
                                        <i class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#add-email"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">User's Replay</button>
                            </div>
                        </div>

                        <div class="col-12 w-100 d-flex flex-wrap p-2">
                            <div class="col-12 d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
                                <div class="col-10 d-flex flex-wrap align-items-center">
                                    <label class="text-wrap px-2" for="">
                                        <p class="fw-semibold">? Select Time</p>
                                    </label>
                                </div>
                                <div class="col-2 d-flex flex-wrap align-items-center">
                                    <div class="col-3 p-1">
                                        <i class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#add-email"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">User's Replay</button>
                            </div>
                        </div>

                        <div class="col-12 w-100 d-flex flex-wrap p-2">
                            <div class="col-12 d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
                                <div class="col-10 d-flex flex-wrap align-items-center">
                                    <label class="text-wrap px-2" for="">
                                        <p class="fw-semibold">? What is your gender</p>
                                    </label>
                                </div>
                                <div class="col-2 d-flex flex-wrap align-items-center">
                                    <div class="col-3 p-1">
                                        <i class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#add-email"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">User's Replay</button>
                            </div>
                        </div>

                        <div class="col-12 w-100 d-flex flex-wrap p-2">
                            <div class="col-12 d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
                                <div class="col-10 d-flex flex-wrap align-items-center">
                                    <label class="text-wrap px-2" for="">
                                        <p class="fw-semibold">? What is your age</p>
                                    </label>
                                </div>
                                <div class="col-2 d-flex flex-wrap align-items-center">
                                    <div class="col-3 p-1">
                                        <i class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#add-email"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">User's Replay</button>
                            </div>
                        </div>

                        <div class="col-12 w-100 d-flex flex-wrap p-2">
                            <div class="col-12 d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
                                <div class="col-10 d-flex flex-wrap align-items-center">
                                    <label class="text-wrap px-2" for="">
                                        <p class="fw-semibold">? Great Enter Your email</p>
                                    </label>
                                </div>
                                <div class="col-2 d-flex flex-wrap align-items-center">
                                    <div class="col-3 p-1">
                                        <i class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#add-email"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                    <div class="col-3 p-1">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">User's Replay</button>
                            </div>
                        </div> -->

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Question</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 d-flex flex-wrap">
                    <div class="col-10 d-flex align-items-center">
                        <span>
                            <p>Note : Please press "Enter" for Paragraph break</p>
                        </span>

                    </div>
                    <div class="col-2 d-flex justify-content-end align-items-center px-2">
                        <i class="fa-regular fa-face-smile fa-lg"></i>
                    </div>
                    <div class="col-12 p-2 border my-3">
                        <form class="needs-validation add_form_Email col-12" id="add_form_Email" name="add_form_Email" novalidate>
                            <div id="editor_add" class="Email_Add_Ckeditor" style="border:1px solid red"></div>
                        </form>
                    </div>
                </div>

                <div class="col-12 d-flex flex-wrap">
                    <ul class="nav nav-tabs col-12 " id="myTab" role="tablist">
                        <li class="nav-item col-4 d-flex justify-content-center" role="presentation">
                            <button class="nav-link active w-100 fw-medium text-secondary" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-edit" type="button" role="tab" aria-controls="basic" aria-selected="true">Basic</button>
                        </li>
                        <li class="nav-item col-4 d-flex justify-content-center" role="presentation">
                            <button class="nav-link w-100 fw-medium text-secondary" id="media-tab" data-bs-toggle="tab" data-bs-target="#media-edit" type="button" role="tab" aria-controls="media" aria-selected="false">Media</button>
                        </li>
                        <li class="nav-item col-4 d-flex justify-content-center" role="presentation">
                            <button class="nav-link w-100 fw-medium text-secondary" id="advanced-tab" data-bs-toggle="tab" data-bs-target="#advanced-edit" type="button" role="tab" aria-controls="advanced" aria-selected="false">Advanced</button>
                        </li>
                    </ul>
                </div>

                <div class="col-12 d-flex flex-wrap p-2 my-3">

                    <div class="tab-content col-12 edit-data-panal">
                        <div class="tab-pane active" id="basic-edit" role="tabpanel" aria-labelledby="basic-tab" tabindex="0">
                            <div class="col-12 d-flex flex-wrap p-1">
                                <!--Whatsapp-->
                                <!-- <div class="col-12 d-flex flex-wrap px-3">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1" for="flexSwitchCheckDefault">Do Not Remove Menu Message (For Whatsapp)</label>
                                    </div>
                                </div> -->

                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="firstquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="secondquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="thirdquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="fourthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="fifthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="sixthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="eighthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="tenthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="twelthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="senenthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="fifteenquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="sixteenquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="seventeenquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="eighteenquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="twentyonequestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="twentythreequestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="twentyfourquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="twentysevenquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="twentyeightquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="thirtyethquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="fourythreequestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="fouryfourquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="twentyfivequestion"></div>
                                <div class="col-12 d-flex flex-wrap px-1 px-md-3" id="fourtyonequestion"></div>
                                <!--Question-->
                                <!-- <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                                    <div class="col-12 d-flex flex-wrap px-2">
                                    
                                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 menu_message" value="1" type="checkbox" role="switch" id="Question-1">
                                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Question-1" for="Question-1">Do Not Remove Menu Message (For Whatsapp)</label>
                                        </div>
                                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Question-2 skip_question" type="checkbox" role="switch" id="Question-2">
                                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Question-2" for="Question-2">Do Not Give Skip Option</label>
                                        </div>
                                        <div class="col-12 my-2">
                                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal" >Enter the error message here.</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid answer" placeholder="Enter Error Message">
                                            </div>
                                        </div>
                                    </div>
                                </form> -->

                                <!--Single Choice-->
                                <!-- <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                                    <div class="col-12 d-flex flex-wrap single-choice">
                                        <div class="col-12 d-flex flex-wrap">
                                            <div class="col p-1">
                                                <label class="form-check-label fw-semibold d-flex align-items-center py-2 single-choice-show-options">Show Options</label>
                                            </div>
                                            <div class="col p-1">
                                                <button type="button" class="btn btn-outline-primary w-100">Vertically</button>
                                            </div>
                                            <div class="col p-1">
                                                <button type="button" class="btn btn-outline-primary w-100">Horizontally</button>
                                            </div>
                                            <div class="col p-1">
                                                <button type="button" class="btn btn-outline-primary w-100">Dropdown</button>
                                            </div>
                                            <div class="col p-1">
                                                <button type="button" class="btn btn-outline-primary w-100">Do not show</button>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap my-3">
                                            <table class="table w-100 col-12">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Options</th>
                                                        <th scope="col">Sub-Flow</th>
                                                        <th scope="col">Jump To</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody">

                                                    <tr class="col-12">
                                                        <td class="col-3">
                                                            <input type="text" class="form-control" id="" placeholder="" value="option1">
                                                        </td>
                                                        <td class="col-3">
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option value="1">Main-flow</option>
                                                            </select>
                                                        </td>
                                                        <td class="col-4">
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>No Jump</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </td>
                                                        <td class="col-2">
                                                            <button type="button" class="btn btn-danger">
                                                                <i class="fa fa-trash  cursor-pointer"></i>
                                                            </button>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <div class="col-2">
                                                <button type="button" class="btn btn-outline-dark single-choice-add-tabal">add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> -->
                                <!--Email-->
                                <!-- <div class="col-12 d-flex flex-wrap px-2">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Email-1" type="checkbox" role="switch" id="Email-1">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-1" for="Email-1">Do Not Remove Menu Message (For Whatsapp)</label>
                                    </div>
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Email-2" type="checkbox" role="switch" id="Email-2">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-2" for="Email-2">Do Not Restrict to Company Emails</label>
                                    </div>
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Email-3" type="checkbox" role="switch" id="Email-3">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-3" for="Email-3">No Strict Validation</label>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Email Address" placeholder="Enter Error Message">
                                        </div>
                                    </div>
                                </div> -->

                                <!--Multiple Choice-->
                                <!-- <div class="col-12 d-flex flex-wrap single-choice">
                                    <div class="col-12 d-flex flex-wrap">
                                        <div class="col-3 p-1">
                                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 single-choice-show-options">Show Options</label>
                                        </div>
                                        <div class="col-3 p-1">
                                            <button type="button" class="btn btn-outline-primary w-100">Vertically</button>
                                        </div>
                                        <div class="col-3 p-1">
                                            <button type="button" class="btn btn-outline-primary w-100">Dropdown</button>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap my-3">
                                        <table class="table w-100 col-12">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Options</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="multiple-table-body">



                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-2">
                                            <button type="button" class="btn btn-outline-dark multiple-choice-add-tabal">add</button>
                                        </div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <div class="col-8 d-flex flex-wrap align-items-center">
                                            <span>Maximum number of options user can select</span>
                                            <span class="col-1 mx-2"><input type="number" class="form-control" id="" value="1"></span>
                                        </div>
                                    </div>
                                </div> -->

                                <!--Mobile Number-->
                                <!-- <div class="col-12 d-flex flex-wrap px-2">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Mobile-1" type="checkbox" role="switch" id="Mobile-1">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Mobile-1" for="Mobile-1">Do Not Remove Menu Message (For Whatsapp)</label>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Phone Number" placeholder="Enter valid Phone Number">
                                        </div>
                                    </div>
                                </div> -->


                                <!--Number-->
                                <!-- <div class="col-12 d-flex flex-wrap px-2">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Number-1" type="checkbox" role="switch" id="Number-1">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Number-1" for="Number-1">Do Not Give Skip Option</label>
                                    </div>
                                    <div class="col-12 my-2">
                                        <form class="col-12 d-flex flex-wrap">
                                            <div class="col-6 px-2">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Minimum Value</label>
                                                    <input type="number" class="form-control" id="" aria-describedby="" placeholder="Enter Minimum Value">
                                                </div>
                                            </div>
                                            <div class="col-6 px-2">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Maximum Value</label>
                                                    <input type="number" class="form-control" id="" placeholder="Enter Maximum Value">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->

                                <!--rating-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 d-flex flex-wrap my-3">
                                        <table class="table w-100 col-12">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Options</th>
                                                    <th scope="col">Sub-Flow</th>
                                                    <th scope="col">Jump To</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">

                                                <tr class="col-12">
                                                    <td class="col-4">
                                                        <input type="text" class="form-control" id="" placeholder="" value="Terrible">
                                                    </td>
                                                    <td class="col-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="1">Main-flow</option>
                                                        </select>
                                                    </td>
                                                    <td class="col-4">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>No Jump</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr class="col-12">
                                                    <td class="col-4">
                                                        <input type="text" class="form-control" id="" placeholder="" value="Bad">
                                                    </td>
                                                    <td class="col-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="1">Main-flow</option>
                                                        </select>
                                                    </td>
                                                    <td class="col-4">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>No Jump</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr class="col-12">
                                                    <td class="col-4">
                                                        <input type="text" class="form-control" id="" placeholder="" value="Okay">
                                                    </td>
                                                    <td class="col-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="1">Main-flow</option>
                                                        </select>
                                                    </td>
                                                    <td class="col-4">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>No Jump</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr class="col-12">
                                                    <td class="col-4">
                                                        <input type="text" class="form-control" id="" placeholder="" value="Good">
                                                    </td>
                                                    <td class="col-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="1">Main-flow</option>
                                                        </select>
                                                    </td>
                                                    <td class="col-4">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>No Jump</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr class="col-12">
                                                    <td class="col-4">
                                                        <input type="text" class="form-control" id="" placeholder="" value="Great">
                                                    </td>
                                                    <td class="col-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="1">Main-flow</option>
                                                        </select>
                                                    </td>
                                                    <td class="col-4">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>No Jump</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 my-2 d-flex">
                                        <div class="col-4 d-flex flex-wrap align-items-center justify-content-center">
                                            <span>Rating Type</span>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="list-group" id="list-tab" role="tablist">
                                                    <a class="list-group-item list-group-item-action active" id="list-Smilies-list" data-bs-toggle="list" href="#list-Smilies" role="tab" aria-controls="list-Smilies">Smilies</a>
                                                    <a class="list-group-item list-group-item-action" id="list-Stars-list" data-bs-toggle="list" href="#list-Stars" role="tab" aria-controls="list-Stars">Stars</a>
                                                    <a class="list-group-item list-group-item-action" id="list-Numbers-list" data-bs-toggle="list" href="#list-Numbers" role="tab" aria-controls="list-Numbers">Numbers</a>
                                                    <a class="list-group-item list-group-item-action" id="list-Options-list" data-bs-toggle="list" href="#list-Options" role="tab" aria-controls="list-Options">Options</a>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="list-Smilies" role="tabpanel" aria-labelledby="list-Smilies-list">
                                                        <div class="col-12 text-center">
                                                            <img src="<?= site_url('assets/images/rating_smilies.png') ?>" alt="#" height="280px" width="350px">
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="list-Stars" role="tabpanel" aria-labelledby="list-Stars-list">
                                                        <div class="col-12 text-center">
                                                            <img src="<?= site_url('assets/images/rating_stars.png') ?>" alt="#" height="280px" width="330px">
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="list-Numbers" role="tabpanel" aria-labelledby="list-Numbers-list">
                                                    <div class="col-12 text-center">
                                                            <img src="<?= site_url('assets/images/rating_numbers.png') ?>" alt="#" height="280px" width="350px">
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="list-Options" role="tabpanel" aria-labelledby="list-Options-list">
                                                    <div class="col-12 text-center">
                                                            <img src="<?= site_url('assets/images/rating_options.png') ?>" alt="#" height="280px" width="300px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!--Date Picker-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                                        <div class="col-1">
                                            <span><b>NOTE:</b></span>
                                        </div>
                                        <div class="col-11">
                                            <span>Please note that the below conditions are an intersection of each other.</span>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap p-3 px-5 my-2 border rounded-3">
                                        <div class="form-check form-check-inline col">
                                            <input class="form-check-input fw-bold" type="checkbox" id="" value="MON" checked>
                                            <label class="form-check-label fw-semibold" for="">MON</label>
                                        </div>
                                        <div class="form-check form-check-inline col">
                                            <input class="form-check-input fw-bold" type="checkbox" id="" value="TUE" checked>
                                            <label class="form-check-label fw-semibold" for="">TUE</label>
                                        </div>
                                        <div class="form-check form-check-inline col">
                                            <input class="form-check-input fw-bold" type="checkbox" id="" value="WED" checked>
                                            <label class="form-check-label fw-semibold" for="">WED</label>
                                        </div>
                                        <div class="form-check form-check-inline col">
                                            <input class="form-check-input fw-bold" type="checkbox" id="" value="THU" checked>
                                            <label class="form-check-label fw-semibold" for="">THU</label>
                                        </div>
                                        <div class="form-check form-check-inline col">
                                            <input class="form-check-input fw-bold" type="checkbox" id="" value="FRI" checked>
                                            <label class="form-check-label fw-semibold" for="">FRI</label>
                                        </div>
                                        <div class="form-check form-check-inline col">
                                            <input class="form-check-input fw-bold" type="checkbox" id="" value="SAT" checked>
                                            <label class="form-check-label fw-semibold" for="">SAT</label>
                                        </div>
                                        <div class="form-check form-check-inline col">
                                            <input class="form-check-input fw-bold" type="checkbox" id="" value="SUN" checked>
                                            <label class="form-check-label fw-semibold" for="">SUN</label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap p-3 px-5 my-2 border rounded-3">
                                        <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <span class="fw-medium">Select Date Range</span>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <span class="fw-medium">Enable Future Days</span>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <input type="number" class="form-control" id="" value="" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <span class="fw-medium">Enable Past (Days)</span>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <input type="number" class="form-control" id="" value="" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap p-3 px-5 my-2 border rounded-3">
                                        <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <span class="fw-medium">Output Format</span>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <input type="text" class="form-control" id="" value="dd-mm-yyyy" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!--Location-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 mx-3 px-5 ">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Location-1" type="checkbox" role="switch" id="Location-1">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Location-1" for="Location-1">Do Not Give Skip Option</label>
                                    </div>
                                    </div>
                                </div> -->

                                <!--Range-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 my-2">
                                        <form class="col-12 d-flex flex-wrap">
                                            <div class="col-6 px-2">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Minimum Value</label>
                                                    <input type="number" class="form-control" id="" aria-describedby="" placeholder="Enter Minimum Value">
                                                </div>
                                            </div>
                                            <div class="col-6 px-2">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Maximum Value</label>
                                                    <input type="number" class="form-control" id="" placeholder="Enter Maximum Value">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->

                                <!--File Upload-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 mx-3 px-5 ">
                                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Location-1" type="checkbox" role="switch" id="Location-1">
                                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Location-1" for="Location-1">Do Not Give Skip Option</label>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Image" placeholder="Enter Error Message">
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Upload File</label>
                                    </div>
                                    <div class="col-12 my-2">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="image-database" data-bs-toggle="tab" data-bs-target="#image_database" type="button" role="tab" aria-controls="image_database" aria-selected="true">S3</button>
                                                <button class="nav-link" id="image-email" data-bs-toggle="tab" data-bs-target="#image_email" type="button" role="tab" aria-controls="image-email" aria-selected="false">Google Drive</button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="image_database" role="tabpanel" aria-labelledby="image-database" tabindex="0"></div>
                                            <div class="tab-pane fade" id="image_email" role="tabpanel" aria-labelledby="image-email" tabindex="0">
                                                <div class="col-12 p-2">
                                                    <div class="input-group col-6">
                                                        <input type="email" class="form-control" placeholder="Enter Email Address" aria-label="Enter Email Address" aria-describedby="button-email">
                                                        <button class="btn btn-outline-secondary" type="button" id="button-email">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div> -->

                                <!--Website-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 mx-3 px-5 ">
                                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Website-1" type="checkbox" role="switch" id="Website-1">
                                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Website-1" for="Website-1">Do Not Give Skip Option</label>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Website URL " placeholder="Enter Error Message">
                                        </div>
                                    </div>
                                </div> -->

                                <!--Ask Contact-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 mx-3 px-5 ">
                                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Ask_Contact-1" type="checkbox" role="switch" id="Ask_Contact-1">
                                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Ask_Contact-1" for="Ask_Contact-1">Do Not Give Skip Option</label>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Website URL " placeholder="Enter Error Message">
                                        </div>
                                    </div>
                                </div> -->

                                <!--Authenticator-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 my-2">
                                        <form class="col-12 d-flex flex-wrap">
                                            <div class="col-6 px-2">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Button Text :</label>
                                                    <input type="text" class="form-control" id="" aria-describedby="" value="Authenticator" placeholder="Set Button Text">
                                                </div>
                                            </div>
                                            <div class="col-6 px-2">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Button URL :</label>
                                                    <input type="text" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->


                            </div>
                        </div>
                        <div class="tab-pane" id="media-edit" role="tabpanel" aria-labelledby="media-tab" tabindex="0">
                            <div class="col-12 d-flex flex-wrap px-3">
                                <div class="col-12 my-2 d-flex flex-wrap justify-content-center p-2 media-upload-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                        <g>
                                            <defs>
                                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                    <path d="M0 512h512V0H0Z" fill="#000000" opacity="1" data-original="#000000"></path>
                                                </clipPath>
                                            </defs>
                                            <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                <path d="M0 0h-189.325c-18.299 0-33.133 14.834-33.133 33.132v33.134H31.824Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(246.509 90.334)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0v-231.933h-397.633c-18.299 0-33.133 14.834-33.133 33.133V0l231.95 82.834z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(454.816 355.4)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(281.128 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(347.384 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(413.65 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0v24.85a8.282 8.282 0 0 1-8.283 8.283H-24.85a8.282 8.282 0 0 1-8.283-8.283V8.283A8.282 8.282 0 0 1-24.85 0Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(289.128 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(413.65 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(347.384 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(281.128 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 256)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 256)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 256)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0v25.133a8 8 0 0 1-8 8h-17.133a7.961 7.961 0 0 1-2.933-.562C-25.102 31.4-23 28.515-23 25.133V8c0-3.382-2.102-6.267-5.066-7.438A7.982 7.982 0 0 1-25.133 0Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(289.128 222.867)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0v-241.522h23.016V-9.589z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(431.8 364.99)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0v82.834c0 18.299-14.834 33.133-33.132 33.133h-364.501c-18.299 0-33.133-14.834-33.133-33.133V0z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(454.816 355.4)" fill="#ff4155" data-original="#ff4155"></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.438 0-20.709 9.271-20.709 20.708v41.417c0 11.437 9.271 20.708 20.709 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(164.867 442.375)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.437 0-20.708 9.271-20.708 20.708v41.417c0 11.437 9.271 20.708 20.708 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(355.394 442.375)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0a20.604 20.604 0 0 1-11.488-3.482C-5.932-7.196-2.27-13.523-2.27-20.708v-41.417c0-7.186-3.662-13.513-9.218-17.226A20.604 20.604 0 0 1 0-82.833c11.437 0 20.708 9.271 20.708 20.708v41.417C20.708-9.271 11.437 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(334.687 504.5)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0a20.607 20.607 0 0 1-11.489-3.482C-5.932-7.196-2.27-13.523-2.27-20.708v-41.417c0-7.186-3.662-13.513-9.219-17.226A20.607 20.607 0 0 1 0-82.833c11.437 0 20.708 9.271 20.708 20.708v41.417C20.708-9.271 11.437 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(144.16 504.5)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0h-23.009C-4.71 0 10.124-14.833 10.124-33.132v-82.835h23.008v82.835C33.132-14.833 18.298 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(421.685 471.367)" fill="#e80054" data-original="#e80054"></path>
                                                <path d="M0 0c0 68.622 55.629 124.25 124.25 124.25C192.871 124.25 248.5 68.622 248.5 0s-55.629-124.25-124.25-124.25C55.629-124.25 0-68.622 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(239.434 131.75)" fill="#4fabf7" data-original="#4fabf7"></path>
                                                <path d="M0 0c0 50.322 40.794 91.117 91.116 91.117S182.233 50.322 182.233 0s-40.795-91.117-91.117-91.117S0-50.322 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(272.567 131.75)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0c-3.878 0-7.712-.187-11.5-.535C51.729-6.339 101.25-59.507 101.25-124.25S51.729-242.161-11.5-247.965A125.64 125.64 0 0 1 0-248.5c68.621 0 124.25 55.629 124.25 124.25C124.25-55.629 68.621 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(363.684 256)" fill="#1886ea" data-original="#1886ea"></path>
                                                <path d="M0 0c-3.893 0-7.728-.246-11.492-.719C33.405-6.37 68.133-44.687 68.133-91.117c0-46.429-34.728-84.747-79.625-90.397A91.942 91.942 0 0 1 0-182.233c50.322 0 91.117 40.794 91.117 91.116C91.117-40.794 50.322 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(363.684 222.867)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0c0-9.149-7.417-16.567-16.566-16.567-9.15 0-16.567 7.418-16.567 16.567 0 9.149 7.417 16.567 16.567 16.567C-7.417 16.567 0 9.149 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(380.25 131.75)" fill="#ffdd40" data-original="#ffdd40"></path>
                                                <path d="M0 0v222.032c0 18.298-14.834 33.132-33.133 33.132h-66.266" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(454.816 216.203)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0v-134.1c0-18.298 14.834-33.132 33.133-33.132h182.595" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 290.7)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-66.267c-18.298 0-33.132-14.834-33.132-33.132v-117.535" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(123.45 471.367)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-149.111" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(313.978 471.367)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-18.145c-18.298 0-33.132 14.834-33.132 33.132v33.134" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(75.328 90.334)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-141.181" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(246.509 90.334)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.438 0-20.709 9.271-20.709 20.708v41.417c0 11.437 9.271 20.708 20.709 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(164.867 442.375)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-16.566" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(123.45 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h16.566" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(164.867 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h430.766" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 355.4)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h430.766" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 388.533)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.437 0-20.708 9.271-20.708 20.708v41.417c0 11.437 9.271 20.708 20.708 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(355.394 442.375)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-16.567" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(313.978 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h16.567" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(355.394 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(281.128 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(347.384 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(413.65 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-14.931a8.282 8.282 0 0 0-8.283 8.283V24.85a8.282 8.282 0 0 0 8.283 8.283H1.636a8.282 8.282 0 0 0 8.283-8.283V8.283" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(279.209 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0 68.622 55.629 124.25 124.25 124.25C192.871 124.25 248.5 68.622 248.5 0s-55.629-124.25-124.25-124.25C55.629-124.25 0-68.622 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(239.434 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0 50.322 40.794 91.117 91.116 91.117S182.233 50.322 182.233 0s-40.795-91.117-91.117-91.117S0-50.322 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(272.567 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0-9.149-7.417-16.567-16.566-16.567-9.15 0-16.567 7.418-16.567 16.567 0 9.149 7.417 16.567 16.567 16.567C-7.417 16.567 0 9.149 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(380.25 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0v41.417" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(363.684 148.317)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h24.851" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(380.25 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="advanced-edit" role="tabpanel" aria-labelledby="advanced-tab" tabindex="0">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: #d8d7ff;">
                                            Data Referencing
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="col-12 d-flex flex-wrap my-2">
                                                <div class="col-5 p-2">
                                                    <div class="main-selectpicker">
                                                        <select class="selectpicker form-control form-main main-control" aria-label="Default select example" data-live-search="true" required="" tabindex="-98">
                                                            <option selected class="dropdown-item">Open this select menu</option>
                                                            <option value="1" class="dropdown-item">One</option>
                                                            <option value="2" class="dropdown-item">Two</option>
                                                            <option value="3" class="dropdown-item">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6 p-2">
                                                <div class="main-selectpicker">
                                                    <select class="selectpicker form-control form-main main-control" aria-label="Default select example" data-live-search="true" required="" tabindex="-98">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-wrap my-2 px-2 fw-medium">
                                                <span>Select data from SDK Object / Whatsapp User Info</span>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="col-5 p-2">
                                                    <div class="main-selectpicker">
                                                        <select class="selectpicker form-control form-main main-control" aria-label="Default select example" data-live-search="true" required="" tabindex="-98">
                                                            <option selected>Open this select menu</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Time Based Greeting
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="col-12 d-flex flex-wrap">
                                                <div class="col-8">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Coppy Text Hear" aria-label="Recipient's username" aria-describedby="button-addon2" disabled>
                                                        <button class="btn-primary" type="button" id="button-addon2">Coppy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">

                <div class="tab-content col-12 edit-data-panal">
                    <div class="tab-pane" id="media-edit" role="tabpanel" aria-labelledby="media-tab" tabindex="0">
                        <div class="col-12 d-flex flex-wrap px-3">
                            <div class="col-12 my-2 d-flex flex-wrap justify-content-center p-2 media-upload-box">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <defs>
                                            <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                <path d="M0 512h512V0H0Z" fill="#000000" opacity="1" data-original="#000000"></path>
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                            <path d="M0 0h-189.325c-18.299 0-33.133 14.834-33.133 33.132v33.134H31.824Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(246.509 90.334)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                            <path d="M0 0v-231.933h-397.633c-18.299 0-33.133 14.834-33.133 33.133V0l231.95 82.834z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(454.816 355.4)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                            <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(281.128 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(347.384 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(413.65 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0v24.85a8.282 8.282 0 0 1-8.283 8.283H-24.85a8.282 8.282 0 0 1-8.283-8.283V8.283A8.282 8.282 0 0 1-24.85 0Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(289.128 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(413.65 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(347.384 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(281.128 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 256)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 256)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 256)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0v25.133a8 8 0 0 1-8 8h-17.133a7.961 7.961 0 0 1-2.933-.562C-25.102 31.4-23 28.515-23 25.133V8c0-3.382-2.102-6.267-5.066-7.438A7.982 7.982 0 0 1-25.133 0Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(289.128 222.867)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                            <path d="M0 0v-241.522h23.016V-9.589z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(431.8 364.99)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                            <path d="M0 0v82.834c0 18.299-14.834 33.133-33.132 33.133h-364.501c-18.299 0-33.133-14.834-33.133-33.133V0z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(454.816 355.4)" fill="#ff4155" data-original="#ff4155"></path>
                                            <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.438 0-20.709 9.271-20.709 20.708v41.417c0 11.437 9.271 20.708 20.709 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(164.867 442.375)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                            <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.437 0-20.708 9.271-20.708 20.708v41.417c0 11.437 9.271 20.708 20.708 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(355.394 442.375)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                            <path d="M0 0a20.604 20.604 0 0 1-11.488-3.482C-5.932-7.196-2.27-13.523-2.27-20.708v-41.417c0-7.186-3.662-13.513-9.218-17.226A20.604 20.604 0 0 1 0-82.833c11.437 0 20.708 9.271 20.708 20.708v41.417C20.708-9.271 11.437 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(334.687 504.5)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                            <path d="M0 0a20.607 20.607 0 0 1-11.489-3.482C-5.932-7.196-2.27-13.523-2.27-20.708v-41.417c0-7.186-3.662-13.513-9.219-17.226A20.607 20.607 0 0 1 0-82.833c11.437 0 20.708 9.271 20.708 20.708v41.417C20.708-9.271 11.437 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(144.16 504.5)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                            <path d="M0 0h-23.009C-4.71 0 10.124-14.833 10.124-33.132v-82.835h23.008v82.835C33.132-14.833 18.298 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(421.685 471.367)" fill="#e80054" data-original="#e80054"></path>
                                            <path d="M0 0c0 68.622 55.629 124.25 124.25 124.25C192.871 124.25 248.5 68.622 248.5 0s-55.629-124.25-124.25-124.25C55.629-124.25 0-68.622 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(239.434 131.75)" fill="#4fabf7" data-original="#4fabf7"></path>
                                            <path d="M0 0c0 50.322 40.794 91.117 91.116 91.117S182.233 50.322 182.233 0s-40.795-91.117-91.117-91.117S0-50.322 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(272.567 131.75)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                            <path d="M0 0c-3.878 0-7.712-.187-11.5-.535C51.729-6.339 101.25-59.507 101.25-124.25S51.729-242.161-11.5-247.965A125.64 125.64 0 0 1 0-248.5c68.621 0 124.25 55.629 124.25 124.25C124.25-55.629 68.621 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(363.684 256)" fill="#1886ea" data-original="#1886ea"></path>
                                            <path d="M0 0c-3.893 0-7.728-.246-11.492-.719C33.405-6.37 68.133-44.687 68.133-91.117c0-46.429-34.728-84.747-79.625-90.397A91.942 91.942 0 0 1 0-182.233c50.322 0 91.117 40.794 91.117 91.116C91.117-40.794 50.322 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(363.684 222.867)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                            <path d="M0 0c0-9.149-7.417-16.567-16.566-16.567-9.15 0-16.567 7.418-16.567 16.567 0 9.149 7.417 16.567 16.567 16.567C-7.417 16.567 0 9.149 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(380.25 131.75)" fill="#ffdd40" data-original="#ffdd40"></path>
                                            <path d="M0 0v222.032c0 18.298-14.834 33.132-33.133 33.132h-66.266" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(454.816 216.203)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0v-134.1c0-18.298 14.834-33.132 33.133-33.132h182.595" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 290.7)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-66.267c-18.298 0-33.132-14.834-33.132-33.132v-117.535" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(123.45 471.367)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-149.111" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(313.978 471.367)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-18.145c-18.298 0-33.132 14.834-33.132 33.132v33.134" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(75.328 90.334)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-141.181" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(246.509 90.334)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.438 0-20.709 9.271-20.709 20.708v41.417c0 11.437 9.271 20.708 20.709 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(164.867 442.375)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-16.566" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(123.45 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h16.566" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(164.867 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h430.766" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 355.4)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h430.766" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 388.533)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.437 0-20.708 9.271-20.708 20.708v41.417c0 11.437 9.271 20.708 20.708 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(355.394 442.375)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-16.567" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(313.978 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h16.567" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(355.394 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(281.128 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(347.384 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(413.65 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-14.931a8.282 8.282 0 0 0-8.283 8.283V24.85a8.282 8.282 0 0 0 8.283 8.283H1.636a8.282 8.282 0 0 0 8.283-8.283V8.283" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(279.209 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0c0 68.622 55.629 124.25 124.25 124.25C192.871 124.25 248.5 68.622 248.5 0s-55.629-124.25-124.25-124.25C55.629-124.25 0-68.622 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(239.434 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0c0 50.322 40.794 91.117 91.116 91.117S182.233 50.322 182.233 0s-40.795-91.117-91.117-91.117S0-50.322 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(272.567 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0c0-9.149-7.417-16.567-16.566-16.567-9.15 0-16.567 7.418-16.567 16.567 0 9.149 7.417 16.567 16.567 16.567C-7.417 16.567 0 9.149 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(380.25 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0v41.417" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(363.684 148.317)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            <path d="M0 0h24.851" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(380.25 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="advanced-edit" role="tabpanel" aria-labelledby="advanced-tab" tabindex="0">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Data Referencing
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-12 d-flex flex-wrap my-2">
                                            <div class="col-5 p-2">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="col-6 p-2">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap my-2 px-2 fw-medium">
                                            <span>Select data from SDK Object / Whatsapp User Info</span>
                                        </div>
                                        <div class="col-12 my-2">
                                            <div class="col-5 p-2">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Time Based Greeting
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-12 d-flex flex-wrap">
                                            <div class="col-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Coppy Text Hear" aria-label="Recipient's username" aria-describedby="button-addon2" disabled>
                                                    <button class="btn-primary" type="button" id="button-addon2">Coppy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-primary update_question">Update</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Conditional Flow</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body1 p-3">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Question</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect" disabled>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="formGroupExampleInput" class="form-label">Subflows</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Main Flow</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <label for="formGroupExampleInput" class="form-label">Next Question jump</label>
                        <select class="form-select question_select" aria-label="Default select example">

                            <option value="No Jump">No Jump</option>

                            <?php
                            if (isset($admin_bot_setup)) {
                                foreach ($admin_bot_setup as $type_key => $type_value) {
                                    // pre($type_value);

                                    if ($type_value['bot_id'] == $botId) {

                                        echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Conditional Flow -->
            <!-- <div class="model-body2 p-3">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Question</label>
                        <input type="text" class="form-control" id="formGroupExampleInput"
                            placeholder="URL Auto Redirect">
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="formGroupExampleInput" class="form-label">Question</label>
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <label for="formGroupExampleInput" class="form-label">Question</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="formGroupExampleInput" class="form-label">Question</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this </option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>   -->

            <!-- How would you rate our company? -->
            <!-- <div class="model-body3 p-3">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Question</label>
                        <input type="text" class="form-control" id="formGroupExampleInput"
                            placeholder="URL Auto Redirect">
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <label for="formGroupExampleInput" class="form-label">Subflows</label>
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <label for="formGroupExampleInput" class="form-label">Question</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="formGroupExampleInput" class="form-label">Next Question jump</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div> -->

            <!-- <div class="model-body4 p-3">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Question</label>
                        <input type="text" class="form-control" id="formGroupExampleInput"
                            placeholder="URL Auto Redirect">
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <label for="formGroupExampleInput" class="form-label">Subflows</label>
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <label for="formGroupExampleInput" class="form-label">Question</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="formGroupExampleInput" class="form-label">Next Question jump</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="URL Auto Redirect" disabled>
                        </div>
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle w-100 text-start" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown button
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle w-100 text-start" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown button
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->

            <!-- This will call your api and show the response to the user -->
            <!-- <div class="modal-body4 p-3">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Question</label>
                        <input type="text" class="form-control" id="formGroupExampleInput"
                            placeholder="URL Auto Redirect">
                    </div>
                    <h6 class="mt-2 mb-3">If your response for dynamic question is a radio type Please set options and
                        their respective
                        jumps here</h6>


                    <div class="man_div">

                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="button" id="addButton" class="btn btn-outline-primary">ADD</button>
                        </div>
                    </div>

                    <h6 class="mt-2 mb-3">If your response for dynamic question is not a radio type Next question to
                        jump to</h6>
                    <div class="row">
                        <div class="col-4">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-8">

                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div> -->

            <div class="modal-footer">
                <button type="button" class="btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-primary conditional_flow_update">Save</button>
            </div>
        </div>
    </div>
</div>



<!-- chat-bot modal -->
<div class="modal fade modal-lg" id="chat_withbot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Bot Preview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3 pt-1">
                <div class="col-12 border rounded-3">
                    <div class="moda-card-header d-flex flex-wrap justify-content-center py-3 border-bottom">
                        <div class="col-8 d-flex flex-wrap align-items-center justify-content-between ">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="border  rounded-circle overflow-hidden" style="width:35px;height:35px">
                                    <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
                                </div>
                                <h6 class="mx-2">
                                    <?php
                                        if (isset($admin_bot)) {                                                      
                                            foreach ($admin_bot as $type_key => $type_value) {
                                                if ($type_value['id'] == $botId) {
                                                    echo '' . $type_value["name"] . '';
                                                }
                                            }
                                        }
                                    ?>
                                </h6>
                           </div>
                            <div class="d-flex flex-wrap">
                                <button class="btn bg-primary mx-2 px-3 text-white" id="sound-icon">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <button class="btn bg-primary text-white">
                                    <i class="fa-solid fa-rotate-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class=" p-3 d-none border rounded sound-icon-lite" style="width:fit-content; background:white; position:absolute; left:470px; top:60px; ">muted <i class="fa-solid fa-volume-high"></i></div>
                    </div>
                    <div class="modal-card-body-main d-flex flex-wrap  flex-column align-items-center justify-content-between ">
                        <div class="overflow-y-scroll col-8 py-3 messege-scroll" style="min-height:400px; max-height:400px">
                                        <div class="col-12 d-flex flex-wrap align-items-end">
                                            <div class="border  rounded-circle overflow-hidden" style="width:35px;height:35px">
                                                <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
                                            </div>
                                            <div class="d-inline-block px-3 py-2 col-6 bg-primary text-white rounded-3 mx-2">
                                                <p>Hey! This is not the first time you are here. What would you like to do?</p>
                                                <div class="col-12 text-center mt-2">
                                                    <button class=" btn btn-secondary col-12 chat_start_again">Start Again</button>
                                                </div>
                                                <div class="col-12 text-center mt-2">
                                                    <button class=" btn btn-secondary col-12 chat_continue">Continue</button>
                                                </div>
                                            </div>
                                        </div>

                            <div class="bot_preview_html"></div>
                            <!-- <div class="messege1 d-flex flex-wrap  ">
                            <div class="border  rounded-circle overflow-hidden " style="width:40px;height:40px">
                                <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
                            </div>
                            <div class="col px-2">
                                <div class="col-12 mb-2">
                                    <span class="p-2 rounded-pill  d-inline-block   bg-white  px-3">
                                        Hello May i Help you
                                    </span>
                                </div>
                                <div class="col-12 mb-2">
                                    <button class="btn bg-primary rounded-pill text-white">
                                            Skip
                                    </button>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="col-12 text-start">
                                        <span class="rounded-pill text-white d-inline-block  bg-secondary-subtle " style="padding:1px 19px;">
                                            <i class="fa-solid fa-ellipsis fa-beat-fade text-dark"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="messege2 d-flex flex-wrap  ">
                            <div class="col px-2">
                                <div class="col-12 mb-2 text-end ">
                                    <span class="p-2 rounded-pill text-white d-inline-block  bg-secondary  px-3  ">
                                        Hello
                                    </span>
                                </div>
                                
                            </div>
                            <div class="border  rounded-circle overflow-hidden " style="width:40px;height:40px">
                                <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
                            </div>
                        </div> -->
                        </div>
                        <div class="col-12 d-flex flex-wrap justify-content-center ">
                            <div class="d-flex flex-wrap col-8  bg-white mb-3 rounded-pill py-1">
                                <div class="input-group  position-relative ">
                                    <input type="text" class="form-control rounded-pill px-4 py-2 border-0 answer_chat" placeholder="Type Your Answer">
                                    <button class="btn-primary rounded-circle me-1 px-3 chatting_data" questionId=""><i class="fa-solid fa-caret-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>

<script>
   //bot chat list into preview
   function bot_preview_data(sequence) {
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';
        var bot_id = '<?php echo $botId; ?>';
        var conversion_id = $(".conversion_id").attr('data-conversation-id'); 
        var chatting_conversion_id = $(".chatting_data").attr('data-conversation-id',conversion_id); 
        var chatting_sequence = $(".chatting_data").attr('data-sequence',sequence); 
        // console.log(chatting_sequence);
        $.ajax({
            method: "post",
            url: "<?= site_url('bot_preview_data'); ?>",
            data: {
                action: 'init_chat',
                table: table,
                bot_id: bot_id,
                sequence: sequence
            },
            success: function(data) {
                var response = JSON.parse(data);
                $('.skip_question').hide();
                $('.loader').hide();
                $(".bot_preview_html").html(response.html);
            }
        });
        
    }
    // bot_preview_data(1);

    // $('body').on('click', '.bot_preview', function (e) {
    //     bot_preview_data(1);
    // });

    //insert chat answer
    var sequence = 1;
    $('body').on('click', '.chatting_data', function (e) {
        e.preventDefault();
        var chatting = $('.answer_chat').val();
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';
        var bot_id = '<?php echo $botId; ?>';
        var last_conversation_id = $(".bot_preview_html .messege1:last").attr('data-conversation-id'); 
        
        if (chatting !== "") {
            $.ajax({
                method: "post",
                url: "<?= site_url('insert_chat_answer'); ?>",
                data: {
                    table: table,
                    action: "chat_answer",
                    answer: chatting,
                    bot_id: bot_id,
                    question_id: last_conversation_id, 
                    sequence: sequence
                },
                success: function (res) {
                    $('.skip_question').hide();
                    sequence++;
                    $('.answer_chat').val('');
                    bot_preview_data(sequence); 
                }
            });
        }
    });


    //skip question next question can set
    var sequence = 1;
    $('body').on('click', '.skip_questioned', function(e) {
        // alert();
        e.preventDefault();
        $('.skip_question').hide();
        sequence++;
        bot_preview_data(sequence);
    });

    //enter chat answer insert
    // var input = document.getElementById("answer_chat");
    // input.addEventListener("keypress", function (event) {
    //     if (event.key === "Enter") {
    //         event.preventDefault();
    //         document.getElementById("chatting_data").click();
    //     }
    // });

    //page js for drag and drop
    $(".question_add").on("dragstart", function(e) {
        $(this).addClass('dragging');
        e.originalEvent.dataTransfer.setData("text/plain", event.target.id);

        var questionId = $(this).find('.span_text').attr('data-question_id');
        var textOfQuestion = $(this).attr('data-qu');

        e.originalEvent.dataTransfer.setData("questionId", questionId);
        var textOfQuestion = $('.droppable').attr('data-qu', textOfQuestion);

        $('.droppable').css("outline", "2px dotted black");
        $('.droppable').css("background-color", "#d5d5d5");
    });
    $(".question_add").on("dragend", function() {
        $(this).removeClass('dragging');
        $('.droppable').css("outline", "3px dotted transparent");
        $('.droppable').css("background-color", "#f4f4f6");
    });
    $('body').on('dragover', '.droppable', function(e) {
        e.preventDefault();
    });


    //drag and drop controller question js
    var targetSequence;
    var targetQuestionId;
    $('body').on('dragstart', '.drag_question', function(e) {
        $(this).addClass('dragging');
        e.originalEvent.dataTransfer.setData("text/plain", event.target.id);
        $('.droppable').css("outline", "2px dotted black");
        $('.droppable').css("background-color", "#d5d5d5");

        targetSequence = parseInt($(this).find('.sequence').data('sequence'));
        targetQuestionId = $(this).find('.question_delete').data('question');
    });
    $('body').on('dragend', '.drag_question', function(e) {
        $(this).removeClass('dragging');
        $('.droppable').css("outline", "3px dotted transparent");
        $('.droppable').css("background-color", "#f4f4f6");
    });
    $('body').on('dragover', '.drag_question', function(e) {
        e.preventDefault();
    });
</script>

<script>
    $('.edit-qa-menu').click(function() {
        $('.edit-qa-menu').removeClass('active');
        $(this).addClass('active');
    });
    $(document).ready(function() {
        $('#flexSwitchCheckDefault').change(function() {
            if ($(this).prop('checked')) {
                $('.form-check-label').text('kam kar ne magic ghare jy ne joje');
            } else {
                $('.form-check-label').text('Click Here and saw magic');
            }
        });
    });


    $(document).ready(function() {

        //Question-1
        $('#Question-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Question-1').text('Remove Menu Message (For Whatsapp)');
            } else {
                $('.Question-1').text('Do Not Remove Menu Message (For Whatsapp)');
            }
        });

        //Question-2
        $('#Question-2').change(function() {
            if ($(this).prop('checked')) {
                $('.Question-2').text('Give Skip OptionEnter');
            } else {
                $('.Question-2').text('Do Not Give Skip Option');
            }
        });

        //Email-1
        $('#Email-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Email-1').text('Remove Menu Message (For Whatsapp)');
            } else {
                $('.Email-1').text('Do Not Remove Menu Message (For Whatsapp)');
            }
        });

        //Email-2
        $('#Email-2').change(function() {
            if ($(this).prop('checked')) {
                $('.Email-2').text('Restrict to Company Emails');
            } else {
                $('.Email-2').text('Do Not Restrict to Company Emails');
            }
        });

        //Email-3
        $('#Email-3').change(function() {
            if ($(this).prop('checked')) {
                $('.Email-3').text('Strict Validation');
            } else {
                $('.Email-3').text('No Strict Validation');
            }
        });

        //Mobile-3
        $('#Mobile-3').change(function() {
            if ($(this).prop('checked')) {
                $('.Mobile-3').text('Remove Menu Message (For WhatsApp)');
            } else {
                $('.Mobile-3').text('Do Not Remove Menu Message (For WhatsApp)');
            }
        });

        //Number-1
        $('#Number-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Number-1').text('Give Skip Option');
            } else {
                $('.Number-1').text('Do Not Give Skip Option');
            }
        });


        //Location-1
        $('#Location-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Location-1').text('Give Skip Option');
            } else {
                $('.Location-1').text('Do Not Give Skip Option');
            }
        });

        //Website-1
        $('#Website-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Website-1').text('Give Skip Option');
            } else {
                $('.Website-1').text('Do Not Give Skip Option');
            }
        });

        //Ask_Contact-1
        $('#Ask_Contact-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Ask_Contact-1').text('Give Skip Option');
            } else {
                $('.Ask_Contact-1').text('Do Not Give Skip Option');
            }
        });

        //Appointment
        $('#Appointment-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Appointment-1').text('Enable Timezone Selection');
            } else {
                $('.Appointment-1').text('Enable Timezone Selection');
            }
        });

        //proudect
        $('#proudect-1').change(function() {
            if ($(this).prop('checked')) {
                $('.proudect-1').text('Auto Slide');
                $('.proudect-corousel-sec-input').removeClass('second-remove');
                $('.proudect-corousel-sec-input').addClass('second-add');
            } else {
                $('.proudect-1').text('Do Not Auto Slide');
                $('.proudect-corousel-sec-input').removeClass('second-add');
                $('.proudect-corousel-sec-input').addClass('second-remove');
            }
        });


        $('#send_params').change(function() {
            if ($(this).prop('checked')) {
                $('.send_params').text('Send in Params');
            } else {
                $('.send_params').text('Do not Send in Params');
            }
        });



        <?php
        $options = [];
        if (isset($admin_bot_setup)) {
            foreach ($admin_bot_setup as $type_key => $type_value) {
                if ($type_value['bot_id'] == $botId) {
                    $options[] = [
                        'id' => $type_value["id"],
                        'question' => $type_value["question"]
                    ];
                }
            }
        }
        $encoded_options = json_encode($options);
        ?>

        //Single Choile Table Row Add
        function table_html() {
            var row_numbers = $('.main-plan').length;
            var main_table_html = '<tr class="col-12 main-plan"><td class="col-3"><input type="text" class="form-control row-option-value single_choice_options_' + row_numbers + '" placeholder="Enter the option" value=""></td><td class="col-3"><select class="form-select question_select" aria-label="Default select example"><option selected>No Jump</option>';

            var options = <?php echo $encoded_options; ?>;

            options.forEach(function(option) {
                main_table_html += '<option value="' + option.id + '">' + option.question + '</option>';
            });
            main_table_html += '<td class="col-3"><select class="form-select" aria-label="Default select example"><option value="1">Main-flow</option></select></td></select></td><td class="col-2"><button type="button" class="btn btn-danger remove-btn"><i class="fa fa-trash cursor-pointer"></i></button></td></tr>';
            $(".tbody").append(main_table_html);
        }
        table_html();

        $('body').on('click', '.single-choice-add-tabal', function() {
            table_html();
            update_row_numbers();
        });

        $('body').on('click', '.remove-btn', function() {

            $(this).closest('tr').remove();

            update_row_numbers();

        });

        function update_row_numbers() {

            var index = 1;

            if (index == "" || index == NaN || index == "NaN") {
                index = 0;

                alert(index);



                $('.row-option-value').each(function(index) {


                    alert(index);
                    // $(this).val("option".index + 1);

                    // $(this).attr("value",index + 1);

                });

            }

        }

        //multiple coise

        let option = 1;

        function multiple_table_html(index) {
            var row_numbers = $('.multiple_main-plan').length;
            var multiple_table_row = '<tr class="col-12 multiple_main-plan"><td class="col-3"><input type="text" class="form-control multiple-row-option-value multiple_choice_options_' + row_numbers + '" id="" placeholder="Enter the option" value=""></td><td class="col-2"><button type="button" class="btn btn-danger multiple-remove-btn"><i class="fa fa-trash  cursor-pointer"></i></button></td></tr>';
            $(".multiple-table-body").append(multiple_table_row);
        }
        multiple_table_html();

        $('body').on('click', '.multiple-choice-add-tabal', function() {
            option++;
            multiple_table_html();
        });

        $('body').on('click', '.multiple-remove-btn', function() {
            $(this).closest('tr').remove();
        });



        //forms
        function form_table_row() {
            var form_table_row = '<tr class="col-12"> '
            '<td class="col">   '
            '<select class="form-select form-select-sm form-select-picker" aria-label="Default select example">  '
            '<option value="Question" selected>Question</option>  '
            '<option value="Dropdown">Dropdown</option>  '
            '</select>   '
            '</td>   '
            '<td class="col">'
            '<input type="text" class="form-control form-control-sm fw-medium form-qa-text" id="" placeholder="Question Text" value=""> '
            '</td>  '
            '<td class="col">   '
            ' <div class="form-check form-switch mx-2 form-required"> '
            '<input class="form-check-input " type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>'
            '</div> '
            '</td> '
            '<td class="col"> '
            '<input type="text" class="form-control form-control-sm fw-medium form-regex" id="" placeholder="Regex" value=""> '
            ' </td>'
            '<td class="col">   '
            '<div class="form-floating">  '
            '<textarea class="form-control fs-12 fw-medium form-detail" placeholder="Description form-detail" id=""></textarea>  '
            '</div>'
            '</td>'
            '<td class="col">  '
            '<button type="button" class="btn btn-danger form-remove-btn"><i class="fa fa-trash cursor-pointer"></i></button>'
            '</td>'
            '</tr>';
            $(".form-table-body").append(form_table_row);
        }

        form_table_row();

        $('body').on('click', '.form-add-tabal', function() {
            form_table_row();
        });

        $('body').on('click', '.form-remove-btn', function() {
            $(this).closest('tr').hide();
        });

        $('body').on('change', '.form-select-picker', function() {
            form_value_change($(this).closest('tr'));
        });

        function form_value_change(row) {
            var form_value = row.find(".form-select-picker").val();
            if (form_value == "Dropdown") {
                row.find('.form-regex').closest('td').children('input').attr('disabled', true);

            } else if (form_value == "Question") {
                row.find('.form-regex').closest('td').children('input').attr('disabled', false);
            }
        }

        //Corousel
        function Corousel_table_row() {
            var Corousel_table_row = '<tr class="col-12 corousel_table"><td class="col"><input type="text" class="form-control form-control-sm fw-medium Corousel-qa-text carousel_question_text" id="" placeholder="Question Text" value=""></td><td class="col"><select class="form-select form-select-sm Corousel-select-picker" aria-label="Default select example"></select></td><td class="col"><select class="form-select form-select-sm Corousel-select-picker carousel_jump" aria-label="Default select example"><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            if (isset($admin_bot_setup)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                foreach ($admin_bot_setup as $type_key => $type_value) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    // pre($type_value);

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($type_value['bot_id'] == $botId) {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ?></select></td><td class="col-2"><div class="col"> <input type="file" name="images[]" class="form-control main-control place" required="" id="insert_image"></div></td><td class="col"><button type="button" class="btn btn-danger btn-sm Corousel-remove-btn"><i class="fa fa-trash cursor-pointer"></i></button></td></tr>';
            $(".Corousel-table-body").append(Corousel_table_row);
        }

        Corousel_table_row();

        $('body').on('click', '.Corousel-add-tabal', function() {
            Corousel_table_row();
        });

        $('body').on('click', '.Corousel-remove-btn', function() {
            $(this).closest('tr').hide();
        });

        // $('body').on('change', '.Corousel-select-picker', function() {
        //     Corousel_value_change($(this).closest('tr'));
        // });

        // function Corousel_value_change(row) {

        //     var Corousel_value = row.find(".Corousel-select-picker").val();
        //     if (form_value == "Dropdown") {
        //         row.find('.form-regex').closest('td').children('input').attr('disabled', true);

        //     } else if (form_value == "Question") {
        //         row.find('.form-regex').closest('td').children('input').attr('disabled', false);
        //     }
        // }


        //Corousel-1
        $('#Corousel-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Corousel-1').text('Auto Slide');
                $('.corousel-sec-input').attr('class', 'd-block');
            } else {
                $('.Corousel-1').text('Do Not Auto Slide');
            }
        });

        function forms_div_fun() {
            var forms_div = `<div class="Forms_in_div">
                            <div class="d-flex flex-wrap p-2 row_add">
                                <div class="ms-2 me-2">
                                    <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Select Type</label>
                                    <select class="form-select form-select-picker question_type" aria-label="Default select example">
                                        <option value="Question" selected>Question</option>
                                        <option value="Dropdown">Dropdown</option>
                                    </select>
                                </div>

                                <div class="ms-2 me-2">
                                    <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Questions</label>
                                    <input type="text" class="form-control fw-medium form-qa-text form_question_text" id="" placeholder="Question Text" value="">
                                </div>

                                <div class="ms-2 me-2">
                                    <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Required</label>
                                    <div class="form-check form-switch mx-2 m-2 form-required">
                                        <input class="form-check-input is_required" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                </div>

                                <div class="ms-2 me-2 Regex_div">
                                    <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Regex</label>
                                    <input type="text" class="form-control fw-medium form-qa-text form_regex" id="" placeholder="Regex" value="">
                                </div>
                            </div>
                            <div class="d-flex flex-wrap p-2 row_add">
                                <div class="ms-2 me-2 form_description second-add">
                                    <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Description</label>
                                    <input type="text" class="main-input1 form-control fw-medium form-qa-text form_description" id="" placeholder="Enter Description" value="">
                                    <textarea class="text-area form-control fs-12 fw-medium form-detail form_dropdown" placeholder="Options(comma seperated)" id=""></textarea>
                                </div>
                                <div class="ms-2 me-2">
                                    <button type="button" id="updates_div_d" class="form_delete_b mt-4 btn-outline-danger"><i class="fa fa-trash cursor-pointer"></i></button>
                                </div>
                            </div>
                        </div>
                `;

            $(".forms_div").append(forms_div);
            $('.text-area').hide();
        }

        forms_div_fun();

        $('body').on('click', '.form_question', function() {
            forms_div_fun();
        });
        $('body').on('click', '.form_delete_b', function() {
            $(this).closest('.Forms_in_div').remove();
        });

        $('body').on('change', '.form-select-picker', function() {
            // let data = $(".form-select-picker").val();
            let data = $(this).val();

            if (data == "Dropdown") {
                // $(".Regex_div").hide();
                $(this).closest('.row_add').find('.Regex_div').hide();
                $(this).closest('.Forms_in_div').find('.text-area').show();
                $(this).closest('.Forms_in_div').find('.main-input1').hide();
            }
            if (data == "Question") {
                // $(".Regex_div").show();
                $(this).closest('.row_add').find('.Regex_div').show();
                $(this).closest('.Forms_in_div').find('.text-area').hide();
                $(this).closest('.Forms_in_div').find('.main-input1').show();
            }

        });
    });


    function updates_mandiv() {
        const html = ` <div class="row mt-2 mb-2 d-flex align-items-center updates_divin">
                            <div class="col-3">
                                <label for="" class="mb-2 mt-2">Type</label>
                                <select class="form-select url_navigator_select" aria-label="Default select example">
                                    <option selected>Select</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Linkedin">Linkedin</option>
                                    <option value="Youtube">Youtube</option>
                                    <option value="Messenger">Messenger</option>
                                    <option value="Google_Plus">Google Plus</option>
                                    <option value="Call">Call</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="URL">URL</option>
                                    <option value="Refresh_chat">Refresh chat</option>
                                    <option value="close_Chat">close Chat</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="" class="mb-2 mt-2">Text</label>
                                <input type="text" class="form-control url_text" aria-describedby="" value="" placeholder="Set Button Text">
                            </div>
                            <div class="col-5">
                                <label for="" class="mb-2 mt-2">Link</label>
                                <input type="text" class="form-control url_link" aria-describedby="" value="" placeholder="Set Button Text">
                            </div>
                            <div class="col-1 mt-3">
                                <button type="button" id="updates_div_d" class="facebook_updates_d mt-4 btn-outline-danger"><i class="fa fa-trash cursor-pointer"></i></button>
                            </div>
                        </div>`;

        $(".updates_mandiv").append(html);
    }
    updates_mandiv();
    $('body').on('click', '.updates_mandivc', function() {
        updates_mandiv();
    });


    function proudect_table_row() {
        var proudect_table_row = '<div class="d-flex flex-wrap col-12 w-100 proudect-table-row product_table"> <div class="proudect-table-1 col-12 w-100 "> <table class="table w-100 col-12 proudect-table-upper table-borderless"> <tbody class="proudect-table-upper-body"> <tr> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Type<span class="text-danger">*</span></label> <select class="form-select proudect-select-picker product_type" aria-label="Default select example"> <option value="1">Image</option> <option value="2">Video</option> </select> </div> </div> </td> <td class="proudect-table-1 col"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Image URL <span class="text-danger">*</span></label> <input type="text" class="form-control product_url" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Title<span class="text-danger">*</span></label> <input type="text" class="form-control product_title" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center proudect-selecter"> <div class="col-12 proudect-image second-add"> <label for="" class="form-label fw-medium">Upload<span class="text-danger">*</span></label> <input class="form-control proudect-file" type="file" id="formFile"> </div> <div class="col-12 proudect-video second-remove"> <label for="" class="form-label fw-medium">URL<span class="text-danger">*</span></label> <input type="text" class="form-control" id="" placeholder="your URL"> </div> </div> </td> </tr> </tbody> </table> </div> <div class="proudect-table-1 col-12 w-100"> <table class="table w-100 col-12 table-borderless proudect-table-lower"> <tbody class="proudect-table-lower-body"> <tr> <td class="proudect-table-1 col-4"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Description</label> <input type="text" class="form-control product_description" id="" placeholder="Description"> </div> </div> </div> </td> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Button Text<span class="text-danger">*</span></label> <input type="text" class="form-control product_button_text" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Button Url <span class="text-danger">*</span></label> <input type="text" class="form-control product_button_url" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium col-12">Remove</label> <button type="button" class="btn btn-danger proudect-remove-btn "><i class="fa fa-trash cursor-pointer"></i></button> </div> </div> </td> </tr> </tbody> </table> </div> </div>';
        $(".proudect-table-body").append(proudect_table_row);
    }
    proudect_table_row();

    $('body').on('click', '.proudect-add-tabal', function() {
        proudect_table_row();
    });

    $('body').on('click', '.proudect-remove-btn', function() {
        $(this).closest('.proudect-table-row').remove();
    });


    $('body').on('change', '.proudect-select-picker', function() {
        var proudect_value = $(this).closest('td').find(".proudect-select-picker").val();
        if (proudect_value == "2") {
            console.log($(this).closest('td').html());
            $(this).closest('tr').find('.proudect-image').removeClass('second-add');
            $(this).closest('tr').find('.proudect-image').addClass('second-remove');
            $(this).closest('tr').find('.proudect-video').removeClass('second-remove');
            $(this).closest('tr').find('.proudect-video').addClass('second-add');

        } else if (proudect_value == "1") {
            $(this).closest('tr').find('.proudect-video').removeClass('second-add');
            $(this).closest('tr').find('.proudect-video').addClass('second-remove');
            $(this).closest('tr').find('.proudect-image').removeClass('second-remove');
            $(this).closest('tr').find('.proudect-image').addClass('second-add');
        }

    });

    function proudect_value_change(row) {
        var proudect_value = row.find(".proudect-select-picker").val();
        if (proudect_value == "2") {
            $('.proudect-image').removeClass('second-add');
            $('.proudect-image').addClass('second-remove');
            $('.proudect-video').removeClass('second-remove');
            $('.proudect-video').addClass('second-add');


        } else if (proudect_value == "1") {
            $('.proudect-video').removeClass('second-add');
            $('.proudect-video').addClass('second-remove');
            $('.proudect-image').removeClass('second-remove');
            $('.proudect-image').addClass('second-add');

        }
    }


    function contact_fun_add() {
        let html = `
                <div class="row col-12 mt-1 contact_div_in">
                    <div class="col-5">
                        <label for="" class="form-label">name</label>
                        <input type="text" class="form-control contact_name" id="" placeholder="Enter Contact Name">
                    </div>
                    <div class="col-5">
                        <label for="" class="form-label">contact</label>
                        <input type="text" class="form-control contact_number" id="" placeholder="Enter contact">
                    </div>
                    <div class="col-2 mt-1">
                    <button type="button" class="contact_div_d mt-4 btn-outline-danger"><i class="fa fa-trash cursor-pointer"></i></button>
                    </div>
                </div>`;

        $(".contact_div").append(html)
    }
    contact_fun_add();

    $("body").on("click", ".contact_div_add", function() {
        contact_fun_add();
    })

    $('body').on('click', '.contact_div_d', function() {
        $(this).closest('.contact_div_in').remove();
    });


    $("body").on("change", ".carousel_img_input", function() {
        let carousel_img_input = this.files[0];
        
        if (carousel_img_input) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('.img_carousel img').attr('src', e.target.result);
            }
            reader.readAsDataURL(carousel_img_input);

            $(this).closest('.input-change').siblings('.img_carousel').removeClass('d-none');
            $(this).closest('.input-change').addClass('d-none');
        } else {
            $(this).closest('.input-change').siblings('.img_carousel').addClass('d-none');
        }
    });

    $("body").on("click", ".img_carousel_clo_btn", function() {
        $(".img_carousel").addClass("d-none");
    });


</script>

<script>
    var classNames = ['.Email_Add_Ckeditor'];
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
                        'Blockquote',
                        'outdent',
                        'indent',
                        '|',
                    ],
                    shouldNotGroupWhenFull: false
                },
                language: 'en',
                placeholder: 'Enter Template'
            })
            .then(instance => {
                editors[className] = instance;
            })
            .catch(error => {
                console.error(error);
            });
    });


    function bot_list_data() {
        $('.loader').show();
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';
        var bot_id = '<?php echo $botId; ?>';
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('bot_list_data'); ?>",
            data: {
                'table': table,
                bot_id: bot_id,
                'action': true
            },
            success: function(res) {
                var result = JSON.parse(res);
                $('.loader').hide();
                $(".bot_list").html(result.html);
                // $('#subscription_list').html(res.html);
            }
        });
    }
    bot_list_data();


    // Function to question add
    function handleQuestionAdd(typeOfQuestion, questionText) {
        var form = $("form[name='bot_form']")[0];
        var bot_id = '<?php echo $botId; ?>';
        var formdata = new FormData(form);
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';

        if (typeOfQuestion !== "") {
            formdata.append('action', 'insert');
            formdata.append('table', table);
            formdata.append('type_of_question', typeOfQuestion);
            formdata.append('question', questionText);
            // formdata.append('sequence', sequence);
            formdata.append('bot_id', bot_id);
            $.ajax({
                method: "post",
                url: "<?= site_url('bot_insert_data'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data !== "error") {
                        $("form[name='bot_form']")[0].reset();
                        $("form[name='bot_form']").removeClass("was-validated");
                        $(".btn-cancel").trigger("click");

                        iziToast.success({
                            title: 'Added Successfully'
                        });
                        bot_list_data();
                    }
                },
            });
        } else {
            $("form[name='bot_form']").addClass("was-validated");
        }
    }


    //function for get value
    function handleQuestionClick(e) {
        e.preventDefault();
        var questionId = $(this).find('.span_text').attr('data-question_id');
        // console.log(questionId); 
        var textOfQuestion = $(this).attr('data-qu');
        handleQuestionAdd(questionId, textOfQuestion);
    }
    $('body').on('click', '.question_add', handleQuestionClick);


    //when drop than record add
    $('body').on('drop', '.droppable', function(e) {
        e.preventDefault();
        var questionId = e.originalEvent.dataTransfer.getData("questionId");
        $(this).attr('data-question_id', questionId);
        var textOfQuestion = $(this).attr('data-qu');
        handleQuestionAdd(questionId, textOfQuestion);
    });



    // drag question sequence changed
    $('body').on('drop', '.drag_question', function(e) {
        e.preventDefault();
        var targetContainer = $(e.target).closest('.droppable');
        var droppedQuestionId = $(this).find('.question_delete').data('question');
        var droppedSequence = parseInt($(this).find('.sequence').data('sequence'));

        $(this).find('.sequence').data('sequence', targetSequence);
        targetContainer.find('.sequence').data('sequence', droppedSequence);
        $.ajax({
            method: "post",
            url: "update_sequence",
            data: {
                droppedQuestionId: droppedQuestionId,
                targetQuestionId: targetQuestionId,
                droppedSequence: targetSequence,
                targetSequence: droppedSequence
            },
            success: function(data) {
                iziToast.success({
                    title: 'Update Successfully'
                });
                bot_list_data();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });


    // question edit
    $("body").on('click', '.question_edit', function(e) {
        e.preventDefault();
        var edit_value = $(this).attr("data-id");
        var type_of_question = $(this).attr("data-type_of_question");

        var className = '.Email_Add_Ckeditor';
        if (editors[className]) {
            var editor = editors[className];
            var editorElement = editor.ui.getEditableElement();
            editorElement.style.border = '1px solid #ccc';
            editorElement.style.backgroundImage = 'none';
        }

        if (edit_value != "") {
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('bot_question_edit_data'); ?>",
                data: {
                    action: 'edit',
                    edit_id: edit_value,
                    table: 'bot_setup'
                },
                success: function(res) {
                    $('.loader').hide();
                    // console.log(res);
                    var response = JSON.parse(res);

                    var new_data = response[0].question;
                    if (editors[className]) {
                        editors[className].setData(new_data);
                    }

                    $("#Question_error_message").val(response[0].error_text);

                    var menu_message = response[0].menu_message;

                    if (menu_message != '') {
                        var menu_message = JSON.parse(response[0].menu_message);

                        var reactions = menu_message.reaction;
                        if (reactions && reactions.length >= 5) {
                            var firstReaction = reactions[0];
                            var secondReaction = reactions[1];
                            var thirdReaction = reactions[2];
                            var fourthReaction = reactions[3];
                            var fifthReaction = reactions[4];

                            $(".terrible").val(firstReaction.reaction);
                            $(".bad").val(secondReaction.reaction);
                            $(".okay").val(thirdReaction.reaction);
                            $(".good").val(fourthReaction.reaction);
                            $(".great").val(fifthReaction.reaction);
                        } else {

                        }

                        $(".button_text").val(menu_message.button_text);
                        $(".button_url").val(menu_message.button_url);

                        $(".minimum_value").val(menu_message.min);
                        $(".maximum_value").val(menu_message.max);

                        $(".min_order_amount").val(menu_message.min_order_amount);
                        $(".discount_percentage").val(menu_message.discount_percentage);
                        $(".tax_percentage").val(menu_message.tax_percentage);
                        $(".delivery_charges").val(menu_message.delivery_charges);
                        $(".currency").val(menu_message.currency);
                        $(".size").val(menu_message.size);

                        if (menu_message.date_range && typeof menu_message.date_range === 'string') {
                            var parts = menu_message.date_range.split('-');
                            var formattedDate = '' + parts[0] + '-' + parts[1] + '-' + parts[2];
                            $(".appointment_date_range").val(formattedDate);
                        }

                        var date_range = menu_message.date_range;
                        if (date_range) {
                            $(".date_range1").val(menu_message.date_range[0]);
                            $(".date_range2").val(menu_message.date_range[1]);
                        }

                        var period = menu_message.period;
                        if (period) {
                            $(".enableFutureDays").val(menu_message.period[0]);
                            $(".enablePasteDays").val(menu_message.period[1]);
                        }
                        $(".date_output_format").val(menu_message.date_output_format);


                        $(".appointment_next_days").val(menu_message.next_days);
                        $(".appointment_next_days").val(menu_message.next_days);
                        $(".appointment_next_days").val(menu_message.next_days);


                        $(".appointment_next_days").val(menu_message.next_days);
                        $(".from_timing").val(menu_message.from_timing);
                        $(".to_timing").val(menu_message.to_timing);
                        $(".timezone").val(menu_message.timezone);
                        $(".interval").val(menu_message.next_days);
                        $(".format").val(menu_message.format);
                        $(".bookings_per_slot").val(menu_message.bookings_per_slot);
                        $(".title").val(menu_message.title);
                        $(".description").val(menu_message.description);
                        $(".meeting_url").val(menu_message.meeting_url);
                        $(".already_booked_message").val(menu_message.already_booked_message);
                        $(".no_slots_message").val(menu_message.no_slots_message);

                        $(".location_place").val(menu_message.location_place);

                        $(".redirect_url").val(menu_message.redirect_url);
                        $(".open_tab").val(menu_message.open_tab);
                        $(".delay_url").val(menu_message.delay_url);

                        $(".header_text").val(menu_message.header_text);
                        $(".footer_text").val(menu_message.footer_text);

                        $(".add_more_button_jump").val(menu_message.add_more_button_jump);
                        $(".quantity_button_jump").val(menu_message.quantity_button_jump);

                        if (menu_message.appointment_period && menu_message.appointment_period.length === 2) {
                            var appointment_period = menu_message.appointment_period;
                            $(".appointment_period:eq(0)").val(appointment_period[0]);
                            $(".appointment_period:eq(1)").val(appointment_period[1]);
                        }

                        if(type_of_question == "18" || type_of_question == "24"){
                            if (menu_message[0].auto_slide_carousel === "1") {
                                $(".auto_slide_carousel").prop("checked", true);
                            } else {
                                $(".auto_slide_carousel").prop("checked", false);
                            }
                        }
                    

                        if (menu_message.remove_question === "true") {
                            $(".remove_question").prop("checked", true);
                        } else {
                            $(".remove_question").prop("checked", false);
                        }
                        if (menu_message.previous_address === "true") {
                            $(".previous_address").prop("checked", true);
                        } else {
                            $(".previous_address").prop("checked", false);
                        }

                        if (menu_message.enable_timezone_selection === "1") {
                            $(".enable_timezone_selection").prop("checked", true);
                        } else {
                            $(".enable_timezone_selection").prop("checked", false);
                        }

                        if (menu_message.remove_menu === "true") {
                            $(".menu_message").prop("checked", true);
                            $(".remove_menu").prop("checked", true);
                        } else {
                            $(".menu_message").prop("checked", false);
                            $(".remove_menu").prop("checked", false);
                        }
                        if (menu_message.company_emails_only === "true") {
                            $(".company_emails_only").prop("checked", true);
                        } else {
                            $(".company_emails_only").prop("checked", false);
                        }
                        if (menu_message.is_strict_validation === "true") {
                            $(".is_strict_validation").prop("checked", true);
                        } else {
                            $(".is_strict_validation").prop("checked", false);
                        }

                        if (type_of_question == 2 || type_of_question == 40 || type_of_question == 42) {
                            if (menu_message && menu_message.options != "") {
                                var optionsArray = menu_message.options.split(';');
                                $(".main-plan").remove();
                                optionsArray.forEach(function(option, index) {
                                    var row_numbers = index === 0 ? '' : $('.main-plan').length;
                                    var main_table_html =
                                        '<tr class="col-12 main-plan">' +
                                        '<td class="col-3">' +
                                        '<input type="text" class="form-control single_choice_options' + (row_numbers ? '_' + row_numbers : '') + '" placeholder="Enter the option" value="' + option + '">' +
                                        '</td>' +
                                        '<td class="col-3">' +
                                        '<select class="form-select" aria-label="Default select example">' +
                                        '<option value="1">Main-flow</option>' +
                                        '</select>' +
                                        '</td>' +
                                        '<td class="col-4">' +
                                        '<select class="form-select question_select" aria-label="Default select example">' +
                                        '<option selected="">No Jump</option>' +
                                        '<option value="1">What is Your Name?</option>' +
                                        '<option value="2">What is Your Gender?</option>' +
                                        '<option value="5">Enter Your Email.</option>' +
                                        '<option value="6">What type of food do you eat?</option>' +
                                        '</select>' +
                                        '</td>' +
                                        '<td class="col-2">' +
                                        '<button type="button" class="btn btn-danger multiple-remove-btn">' +
                                        '<i class="fa fa-trash cursor-pointer"></i>' +
                                        '</button>' +
                                        '</td>' +
                                        '</tr>';
                                    $(".tbody").append(main_table_html);
                                });
                            } else {
                                $(".is_strict_validation").prop("checked", false);
                            }
                        }

                        if (type_of_question == 4) {
                            if (menu_message.options != "") {
                                var optionsArray = menu_message.options.split(';');
                                $(".multiple_main-plan").remove();
                                optionsArray.forEach(function(option, index) {
                                    var row_numbers = index === 0 ? '' : $('.multiple_main-plan').length;
                                    var main_table_html =
                                        '<tr class="col-12 multiple_main-plan">' +
                                        '<td class="col-3">' +
                                        '<input type="text" class="form-control multiple_choice_options' + (row_numbers ? '_' + row_numbers : '') + '" placeholder="Enter the option" value="' + option + '">' +
                                        '</td>' +
                                        '<td class="col-2">' +
                                        '<button type="button" class="btn btn-danger multiple-remove-btn">' +
                                        '<i class="fa fa-trash cursor-pointer"></i>' +
                                        '</button>' +
                                        '</td>' +
                                        '</tr>';
                                    $(".tbody_multiple").append(main_table_html);
                                });
                            } else {
                                $(".is_strict_validation").prop("checked", false);
                            }

                        }

                        // console.log(menu_message.questions);
                        if (type_of_question == 17) {
                            menu_message.questions.forEach(function(question) {
                                var customHtml = `
                                    <div class="Forms_in_div">
                                        <div class="d-flex flex-wrap p-2 row_add">
                                            <div class="ms-2 me-2">
                                                <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Select Type</label>
                                                <select class="form-select form-select-picker question_type" aria-label="Default select example">
                                                    <option value="Question" ${question.type === 'Question' ? 'selected' : ''}>Question</option>
                                                    <option value="Dropdown" ${question.type === 'Dropdown' ? 'selected' : ''}>Dropdown</option>
                                                </select>
                                            </div>

                                            <div class="ms-2 me-2">
                                                <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Questions</label>
                                                <input type="text" class="form-control fw-medium form-qa-text form_question_text" id="" placeholder="Question Text" value="${question.text}">
                                            </div>

                                            <div class="ms-2 me-2">
                                                <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Required</label>
                                                <div class="form-check form-switch mx-2 m-2 form-required">
                                                    <input class="form-check-input is_required" type="checkbox" role="switch" id="flexSwitchCheckChecked" ${question.is_req === 'on' ? 'checked' : ''}>
                                                </div>
                                            </div>

                                            <div class="ms-2 me-2 Regex_div">
                                                <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Regex</label>
                                                <input type="text" class="form-control fw-medium form-qa-text form_regex" id="" placeholder="Regex" value="${question.regex}">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap p-2 row_add">
                                            <div class="ms-2 me-2 form_description second-add">
                                                <label class="form-check-label mb-1 d-flex single-choice-show-options fw-semibold" style="font-size: 14px;">Description</label>
                                                <input type="text" class="main-input1 form-control fw-medium form-qa-text form_description" id="" placeholder="Enter Description" value="${question.desc}">
                                                <textarea class="text-area form-control fs-12 fw-medium form-detail form_dropdown" placeholder="Options(comma seperated)" id="">${question.options}</textarea>
                                            </div>
                                            <div class="ms-2 me-2">
                                                <button type="button" id="updates_div_d" class="form_delete_b mt-4 btn-outline-danger"><i class="fa fa-trash cursor-pointer"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                $(".forms_div").append(customHtml);
                                $('.text-area').hide();
                            });
                        }


                        if (type_of_question == 18 && menu_message && menu_message.length > 0) {
                            $(".corousel_table").remove();

                            menu_message.forEach(function(item) {
                                var corousel_table_html =
                                    '<tr class="col-12 corousel_table">' +
                                    '<td class="col">' +
                                    '<input type="text" class="form-control form-control-sm fw-medium Corousel-qa-text carousel_question_text" placeholder="Enter the option" value="' + item.questionText + '">' +
                                    '</td>' +
                                    '<td class="col">' +
                                    '<select class="form-select form-select-sm Corousel-select-picker" aria-label="Default select example"></select>' +
                                    '</td>' +
                                    '<td class="col">' +
                                    '<select class="form-select form-select-sm Corousel-select-picker carousel_jump" aria-label="Default select example">' +
                                    '<?php if (isset($admin_bot_setup)) {
                                            foreach ($admin_bot_setup as $type_key => $type_value) {
                                                if ($type_value['bot_id'] == $botId) {
                                                    echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                }
                                            }
                                        } ?>' +
                                    '</select>' +
                                    '</td>' +
                                    '<td class="col-2">' +
                                    '<div class="col">' +
                                    '<input type="file" name="images[]" class="form-control main-control place" required="" id="insert_image">' +
                                    '</div>' +
                                    '</td>' +
                                    '<td class="col">' +
                                    '<button type="button" class="btn btn-danger btn-sm Corousel-remove-btn">' +
                                    '<i class="fa fa-trash cursor-pointer"></i>' +
                                    '</button>' +
                                    '</td>' +
                                    '</tr>';
                                $(".Corousel-table-body").append(corousel_table_html);
                            });
                        } else {
                            $(".is_strict_validation").prop("checked", false);
                        }

                        if (type_of_question == 23) {
                            var corousel_table_html = '';
                            // Iterate over the array elements
                            menu_message.forEach(function(rowData, index) {
                                // Build the HTML for each row
                                corousel_table_html += `<div class="row mt-2 mb-2 d-flex align-items-center updates_divin">
                                        <div class="col-3">
                                            <label for="" class="mb-2 mt-2">Type</label>
                                            <select class="form-select url_navigator_select" aria-label="Default select example">
                                                <option ${rowData.url_navigator_select === 'Select' ? 'selected' : ''}>Select</option>
                                                <option ${rowData.url_navigator_select === 'Facebook' ? 'selected' : ''}>Facebook</option>
                                                <option ${rowData.url_navigator_select === 'Twitter' ? 'selected' : ''}>Twitter</option>
                                                <option ${rowData.url_navigator_select === 'Instagram' ? 'selected' : ''}>Instagram</option>
                                                <option ${rowData.url_navigator_select === 'Linkedin' ? 'selected' : ''}>Linkedin</option>
                                                <option ${rowData.url_navigator_select === 'Youtube' ? 'selected' : ''}>Youtube</option>
                                                <option ${rowData.url_navigator_select === 'Messenger' ? 'selected' : ''}>Messenger</option>
                                                <option ${rowData.url_navigator_select === 'Google_Plus' ? 'selected' : ''}>Google Plus</option>
                                                <option ${rowData.url_navigator_select === 'Call' ? 'selected' : ''}>Call</option>
                                                <option ${rowData.url_navigator_select === 'Whatsapp' ? 'selected' : ''}>Whatsapp</option>
                                                <option ${rowData.url_navigator_select === 'URL' ? 'selected' : ''}>URL</option>
                                                <option ${rowData.url_navigator_select === 'Refresh_chat' ? 'selected' : ''}>Refresh chat</option>
                                                <option ${rowData.url_navigator_select === 'close_Chat' ? 'selected' : ''}>close Chat</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="" class="mb-2 mt-2">Text</label>
                                            <input type="text" class="form-control url_text" aria-describedby="" value="${rowData.url_text}" placeholder="Set Button Text">
                                        </div>
                                        <div class="col-5">
                                            <label for="" class="mb-2 mt-2">Link</label>
                                            <input type="text" class="form-control url_link" aria-describedby="" value="${rowData.url_link}" placeholder="Set Button Text">
                                        </div>
                                        <div class="col-1 mt-3">
                                            <button type="button" id="updates_div_d" class="facebook_updates_d mt-4 btn-outline-danger"><i class="fa fa-trash cursor-pointer"></i></button>
                                        </div>
                                    </div>`;
                            });
                            // Insert the generated HTML into the DOM
                            $(".updates_mandiv").html(corousel_table_html);
                        }

                        // console.log(menu_message);
                      
                        if (type_of_question == 24) {
                            let corousel_table_html = '';

                            for (let i = 0; i < menu_message.length; i++) {
                                const data = menu_message[i];

                                corousel_table_html += `<div class="col-12 d-flex flex-wrap">
                                <div class="col-12 d-flex flex-wrap my-3">
                                    <div class="d-flex flex-wrap align-items-center col-4 m-2">
                                       
                                    </div>
                                    <div class="col-4 d-flex flex-wrap  align-items-center proudect-corousel-sec-input second-remove">
                                        <span class="col">Delay (sec)</span>
                                        <span class="col mx-2"><input type="number" class="form-control" id="" value="1"></span>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-wrap my-3">
                                    <div class="proudect-table-body">
                                        <div class="d-flex flex-wrap col-12 w-100 proudect-table-row product_table"> 
                                            <div class="proudect-table-1 col-12 w-100 "> 
                                                <table class="table w-100 col-12 proudect-table-upper table-borderless"> 
                                                    <tbody class="proudect-table-upper-body"> 
                                                        <tr> 
                                                            <td class="proudect-table-1 col-2"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                    <div class="col-12"> 
                                                                        <label for="" class="form-label fw-medium">Type<span class="text-danger">*</span></label> 
                                                                        <select class="form-select proudect-select-picker product_type" aria-label="Default select example"> 
                                                                            <option value="1" ${data.product_type === '1' ? 'selected' : ''}>Image</option> 
                                                                            <option value="2" ${data.product_type === '2' ? 'selected' : ''}>Video</option> 
                                                                        </select> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                            <td class="proudect-table-1 col"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                    <div class="col-12"> 
                                                                        <label for="" class="form-label fw-medium">Image URL <span class="text-danger">*</span></label> 
                                                                        <input type="text" class="form-control product_url" id="" placeholder="your URL" value="${data.product_url}"> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                            <td class="proudect-table-1 col"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                    <div class="col-12"> 
                                                                        <label for="" class="form-label fw-medium">Title<span class="text-danger">*</span></label> 
                                                                        <input type="text" class="form-control product_title" id="" placeholder="your URL" value="${data.product_title}"> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                            <td class="proudect-table-1 col-2"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center proudect-selecter"> 
                                                                    <div class="col-12 proudect-image second-add"> 
                                                                        <label for="" class="form-label fw-medium">Upload<span class="text-danger">*</span></label> 
                                                                        <input class="form-control proudect-file" type="file" id="formFile"> 
                                                                    </div> 
                                                                    <div class="col-12 proudect-video second-remove"> 
                                                                        <label for="" class="form-label fw-medium">URL<span class="text-danger">*</span></label> 
                                                                        <input type="text" class="form-control" id="" placeholder="your URL" value="${data.product_button_url}"> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                        </tr> 
                                                    </tbody> 
                                                </table> 
                                            </div> 
                                            <div class="proudect-table-1 col-12 w-100"> 
                                                <table class="table w-100 col-12 table-borderless proudect-table-lower"> 
                                                    <tbody class="proudect-table-lower-body"> 
                                                        <tr> 
                                                            <td class="proudect-table-1 col-4"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                    <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                        <div class="col-12"> 
                                                                            <label for="" class="form-label fw-medium">Description</label> 
                                                                            <input type="text" class="form-control product_description" id="" placeholder="Description" value="${data.product_description}"> 
                                                                        </div> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                            <td class="proudect-table-1 col-2"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                    <div class="col-12"> 
                                                                        <label for="" class="form-label fw-medium">Button Text<span class="text-danger">*</span></label> 
                                                                        <input type="text" class="form-control product_button_text" id="" placeholder="your URL" value="${data.product_button_text}"> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                            <td class="proudect-table-1 col"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                    <div class="col-12"> 
                                                                        <label for="" class="form-label fw-medium">Button Url <span class="text-danger">*</span></label> 
                                                                        <input type="text" class="form-control product_button_url" id="" placeholder="your URL" value="${data.product_button_url}"> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                            <td class="proudect-table-1 col-2"> 
                                                                <div class="col-12 d-flex flex-wrap align-items-center"> 
                                                                    <div class="col-12"> 
                                                                        <label for="" class="form-label fw-medium col-12">Remove</label> 
                                                                        <button type="button" class="btn btn-danger proudect-remove-btn "><i class="fa fa-trash cursor-pointer"></i></button> 
                                                                    </div> 
                                                                </div> 
                                                            </td> 
                                                        </tr> 
                                                    </tbody> 
                                                </table> 
                                            </div> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>`;
                            }
                            $(".proudect-table-body").append(corousel_table_html);
                        }
                       

                        if (type_of_question == 27) {
                            var contact_table_html = '';
                            menu_message.forEach(function(rowData, index) {
                                // console.log(menu_message);
                                contact_table_html += `<div class="row col-12 mt-1 contact_div_in">
                                    <div class="col-5">
                                        <label for="" class="form-label">name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Contact Name" value="${rowData.contact_name}">
                                    </div>
                                    <div class="col-5">
                                        <label for="" class="form-label">contact</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter contact" value="${rowData.contact_number}">
                                    </div>
                                    <div class="col-2 mt-1">
                                        <button type="button" class="contact_div_d mt-4 btn-outline-danger"><i class="fa fa-trash cursor-pointer"></i></button>
                                    </div>
                                </div>`;
                            });
                            $(".contact_div").append(contact_table_html);
                        }
                    }

                    var skip_question = response[0].skip_question;
                    if (skip_question == 1) {
                        $(".skip_question").prop("checked", true);
                    } else {
                        $(".skip_question").prop("checked", false);
                    }
                    $(".update_question").attr('data-id', response[0].id);
                    $(".update_question").attr('data-type_of_question', response[0].type_of_question);

                },
                error: function(error) {
                    $('.loader').hide();
                    // console.log(error);
                }
            });
        } else {
            $('.loader').hide();
            alert("Data Not Edit.");
        }
    });


    //question update
    $("body").on('click', '.update_question', function(e) {
        e.preventDefault();
        var update_id = $(this).attr("data-id");
        var type_of_question = $(this).attr("data-type_of_question");
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';

        var editor = editors['.Email_Add_Ckeditor'];
        if (editor) {
            var htmlContent = editor.getData();
        }

        var skip_question = $(".skip_question").is(":checked") ? "1" : "0";
        var next_question_id = $('.question_select').val();
        var error_text = $('#Question_error_message').val();

        if (type_of_question == "1" || type_of_question == "5" || type_of_question == "13") {
            var remove_menuArray = [];
            var remove_menu = $(".menu_message").is(":checked") ? "true" : "false";
            var remove_menuArray = {
                remove_menu: remove_menu,
            };
            var options_value = JSON.stringify(remove_menuArray);
            if (options_value === 'undefined') {
                options_value = '';
            }
            var error_text = $('#Question_error_message').val();
        }

        if (type_of_question == "2" || type_of_question == "40" || type_of_question == "42") {
            var comined = {};
            var options = $('.single_choice_options').val();
            comined.options = options;
            for (var i = 1; i <= 3; i++) {
                var options_i = $('.single_choice_options_' + i).val();
                var question_select = $('.question_select').val();
                if (options_i) {
                    if (comined.options !== "") {
                        comined.options += ";";
                    }
                    comined.options += options_i;
                }
            }
            var options_value = JSON.stringify(comined);
            if (options_value === 'undefined') {
                options_value = '';
            }
        }

        if (type_of_question == "3") {
            var remove_menu = $(".remove_menu").is(":checked") ? "true" : "false";
            var company_emails_only = $(".company_emails_only").is(":checked") ? "true" : "false";
            var is_strict_validation = $(".is_strict_validation").is(":checked") ? "true" : "false";

            var valuesArray = {
                remove_menu: remove_menu,
                company_emails_only: company_emails_only,
                is_strict_validation: is_strict_validation,
            };
            var options_value = JSON.stringify(valuesArray);
            if (options_value === 'undefined') {
                options_value = '';
            }
            var error_text = $('#Question_error_message').val();
        }

        if (type_of_question == "4") {
            var comined = {};
            var options = $('.multiple_choice_options').val();
            comined.options = options;
            for (var i = 1; i <= 3; i++) {
                var options_i = $('.multiple_choice_options_' + i).val();
                if (options_i) {
                    if (comined.options !== "") {
                        comined.options += ";";
                    }
                    comined.options += options_i;
                }
            }
            var options_value = JSON.stringify(comined);
            if (options_value === 'undefined') {
                options_value = '';
            }
        }

        if (type_of_question == "6" || type_of_question == "11") {
            var minimum_value = $('.minimum_value').val();
            var maximum_value = $('.maximum_value').val();
            var valuesArray = {
                min: minimum_value,
                max: maximum_value,
            };
            var options_value = JSON.stringify(valuesArray);
            if (options_value === 'undefined') {
                options_value = '';
            }
        }

        if (type_of_question == "7") {
            var Terrible = {
                reaction: $('.terrible').val(),
                question_select: $('.question_select_1').val()
            };
            var Bad = {
                reaction: $('.bad').val(),
                question_select: $('.question_select_2').val()
            };
            var Okay = {
                reaction: $('.okay').val(),
                question_select: $('.question_select_3').val()
            };
            var Good = {
                reaction: $('.good').val(),
                question_select: $('.question_select_4').val()
            };
            var Great = {
                reaction: $('.great').val(),
                question_select: $('.question_select_5').val()
            };

            var reactionArray = [Terrible, Bad, Okay, Good, Great];

            var valuesArray = {
                reaction: reactionArray
            };

            var options_value = JSON.stringify(valuesArray);
            if (options_value === 'undefined') {
                options_value = '';
            }
        }

        if (type_of_question == "8") {
            var checkedDays = $('.days_val:checked').map(function() {
                return $(this).val();
            }).get();

            var formattedDate = function(dateString) {
                var parts = dateString.split("-");
                return parts[2] + "-" + parts[1] + "-" + parts[0];
            };

            var dateRangeArray = [];
            var dateRange1 = $('.date_range1').val();
            var dateRange2 = $('.date_range2').val();
            if (dateRange1 && dateRange2) {
                dateRangeArray = [
                    formattedDate(dateRange1),
                    formattedDate(dateRange2)
                ];
            }

            var periodArray = [];
            var enableFutureDays = $('.enableFutureDays').val();
            var enablePasteDays = $('.enablePasteDays').val();
            if (enableFutureDays !== "" && enablePasteDays !== "") {
                periodArray = [
                    parseInt(enableFutureDays),
                    parseInt(enablePasteDays)
                ];
            }

            var date_output_format = $('.date_output_format').val();

            var dateRangeObject = {
                date_range: dateRangeArray,
                period: periodArray,
                weekdays: checkedDays,
                date_output_format: date_output_format
            };

            var options_value = JSON.stringify(dateRangeObject);
        }

        if (type_of_question == "15") {
            var minOrderAmount = $('.min_order_amount').val() || 0;
            var discountPercentage = $('.discount_percentage').val() || 0;
            var taxPercentage = $('.tax_percentage').val() || 0;
            var deliveryCharges = $('.delivery_charges').val() || 0;
            var currency = $('.currency').val() || "";
            var size = $('.size').val() || "";

            var defaultOptions = {
                min_order_amount: parseFloat(minOrderAmount),
                discount_percentage: parseFloat(discountPercentage),
                tax_percentage: parseFloat(taxPercentage),
                delivery_charges: parseFloat(deliveryCharges),
                currency: currency,
                size: size
            };

            var options_value = JSON.stringify(defaultOptions);
        }

        if (type_of_question == "16") {
            var buttonText = $('.button_text').val();
            var buttonUrl = $('.button_url').val();

            var buttonObject = {
                button_text: buttonText,
                button_url: buttonUrl
            };
            var options_value = JSON.stringify(buttonObject);
            // console.log(options_value);
        }

        if (type_of_question == "17") {
            function createFormDataArray() {
                var formDataArray = [];
                var formContainers = document.querySelectorAll('.Forms_in_div');
                formContainers.forEach(function(container) {
                    var formData = {};


                    var questionType = $('.question_type').val();
                    var questionText = $('.form_question_text').val();
                    var isRequired = $('.is_required').val();
                    var regex = $('.form_regex').val();
                    var options = $('.text-area').val();
                    var description = $('.main-input1').val();

                    formData.type = questionType;
                    formData.text = questionText;
                    formData.is_req = isRequired;
                    formData.regex = regex;
                    formData.options = options;
                    formData.desc = description;

                    formDataArray.push(formData);
                });

                return JSON.stringify({
                    questions: formDataArray
                });
            }
            var options_value = createFormDataArray();
        }

        if (type_of_question == "18") {
            var carouselData = [];
            $('.Corousel-table-body').find('tr').each(function() {
                var $row = $(this);

                var auto_slide_carousel = $(".auto_slide_carousel").is(":checked") ? "1" : "0";
                var questionTextInput = $row.find('.carousel_question_text').val();
                var carousel_jump = $row.find('.carousel_jump').val();
                var fileInput = $row.find('#insert_image').prop('files')[0];
                var fileName = fileInput ? fileInput.name : '';

                var rowData = {
                    auto_slide_carousel: auto_slide_carousel,
                    questionText: questionTextInput,
                    carousel_jump: carousel_jump,
                    fileInput: fileName
                };

                carouselData.push(rowData);
            });
            var options_value = JSON.stringify(carouselData);
        }


        if (type_of_question == "21") {
            var date_range = $(".appointment_date_range").val();
            var futureDays = $(".appointment_period:eq(0)").val();
            var nextDays = $(".appointment_period:eq(1)").val();

            var appointment_period = [futureDays, nextDays];
            var weekdays = $('.appointment_weekdays:checked').map(function() {
                return $(this).val();
            }).get();

            var from_timing = $(".from_timing").val();
            var to_timing = $(".to_timing").val();
            var timezone = $(".timezone").val();
            var interval = $(".interval").val();
            var format = $(".format").val();
            var bookings_per_slot = $(".bookings_per_slot").val();
            var title = $(".title").val();
            var description = $(".description").val();
            var meeting_url = $(".meeting_url").val();
            var already_booked_message = $(".already_booked_message").val();
            var no_slots_message = $(".no_slots_message").val();
            var next_days = $(".appointment_next_days").val();
            var channel = $(".channel").val();
            var enable_timezone_selection = $(".enable_timezone_selection").is(":checked") ? "1" : "0";

            var data = {
                date_range: date_range,
                appointment_period: appointment_period,
                weekdays: weekdays,
                from_timing: from_timing,
                to_timing: to_timing,
                timezone: timezone,
                interval: interval,
                format: format,
                bookings_per_slot: bookings_per_slot,
                title: title,
                description: description,
                meeting_url: meeting_url,
                already_booked_message: already_booked_message,
                no_slots_message: no_slots_message,
                next_days: next_days,
                channel: channel,
                enable_timezone_selection: enable_timezone_selection
            };
            var options_value = JSON.stringify(data);
        }

        if (type_of_question == "23") {
            var rowData = [];
            $(".updates_divin").each(function(index) {
                var type = $(this).find(".url_navigator_select").val();
                var text = $(this).find(".url_text").val();
                var link = $(this).find(".url_link").val();
                var row = {
                    url_navigator_select: type,
                    url_text: text,
                    url_link: link
                };
                rowData.push(row);
            });
            var options_value = JSON.stringify(rowData);
        }


        if (type_of_question == "24") {
            var rowData = [];
            $(".product_table").each(function(index) {
                var auto_slide_carousel = $(".auto_slide_carousel").is(":checked") ? "1" : "0";
                var product_type = $(this).find(".product_type").val();
                var product_url = $(this).find(".product_url").val();
                var product_title = $(this).find(".product_title").val();
                var product_description = $(this).find(".product_description").val();
                var product_button_text = $(this).find(".product_button_text").val();
                var product_button_url = $(this).find(".product_button_url").val();
                var row = {
                    auto_slide_carousel: auto_slide_carousel,
                    product_type: product_type,
                    product_url: product_url,
                    product_title: product_title,
                    product_description: product_description,
                    product_button_text: product_button_text,
                    product_button_url: product_button_url
                };
                rowData.push(row);
            });
            var options_value = JSON.stringify(rowData);
        }

        // if (type_of_question == "25") {
        //     var rowData = [];
        //     var carousel_image = $('.carousel_img_input').prop('files')[0];
        //     var carousel_imaged = carousel_image ? carousel_image.name : '';
        //     var row = {
        //         carousel_image: carousel_imaged
        //     };
        //     var options_value = JSON.stringify(row);
        //     console.log(options_value);
        // }


        if (type_of_question == "25") {
            
            var options_value = $('.carousel_img_input').prop('files')[0];
        }

        if (type_of_question == "27") {
            var rowData = [];
            $(".contact_div_in").each(function(index) {
                var contact_name = $(".contact_name").val();
                var contact_number = $(".contact_number").val();
                var row = {
                    contact_name: contact_name,
                    contact_number: contact_number
                };
                rowData.push(row);
            });
            var options_value = JSON.stringify(rowData);
        }

        if (type_of_question == "28" || type_of_question == "43") {
            var rowData = [];
            var location_place = $(".location_place").val();
            var row = {
                location_place: location_place
            };
            var options_value = JSON.stringify(row);
        }

        if (type_of_question == "30") {
            var rowData = [];
            var redirect_url = $(".redirect_url").val();
            var open_tab = $(".open_tab").val();
            var delay_url = $(".delay_url").val();
            var row = {
                redirect_url: redirect_url,
                open_tab: open_tab,
                delay_url: delay_url
            };
            var options_value = JSON.stringify(row);
        }

        if (type_of_question == "41") {
            var rowData = [];
            var add_more_button = $(".add_more_button").val();
            var add_more_button_jump = $(".add_more_button_jump").val();

            var submit_button = $(".submit_button").val();
            var quantity_button_jump = $(".quantity_button_jump").val();

            var edit_quantity_button = $(".edit_quantity_button").val();
            var row = {
                add_more_button: add_more_button,
                add_more_button_jump:add_more_button_jump,
                submit_button: submit_button,
                quantity_button_jump: quantity_button_jump,
                edit_quantity_button: edit_quantity_button
            };
            var options_value = JSON.stringify(row);
        }


        if (type_of_question == "44") {
            var rowData = [];
            var remove_question = $(".remove_question").is(":checked") ? "true" : "false";
            var previous_address = $(".previous_address").is(":checked") ? "true" : "false";
            var header_text = $(".header_text").val();
            var footer_text = $(".footer_text").val();
            var row = {
                remove_question: remove_question,
                previous_address: previous_address,
                header_text: header_text,
                footer_text: footer_text
            };
            var options_value = JSON.stringify(row);
        }

        if (update_id != "") {
            var form = $("form[name='question_update_form']")[0];
            var formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', table);
            formdata.append('question', htmlContent);
            if (typeof options_value === 'undefined') {
                formdata.append('menu_message', '');
            } else {
                formdata.append('menu_message', options_value);
            }
            formdata.append('skip_question', skip_question);
            formdata.append('error_text', error_text);
            formdata.append('next_question_id', next_question_id);

            $('.loader').show();
            $.ajax({
                method: "post",
                url: "<?= site_url('bot_question_update'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(res) {
                    // if (res == true) {
                        $('.loader').hide();
                        // $("form[name='question_update_form']")[0].reset();
                        $("form[name='question_update_form']").removeClass("was-validated");
                        $(".btn-close").trigger("click");
                        iziToast.success({
                            title: 'Update Successfully'
                        });
                        bot_list_data();
                    // } else {
                    //     $('.loader').hide();
                    //     $(".btn-close").trigger("click");
                    //     $("form[name='question_update_form']").removeClass("was-validated");
                    //     iziToast.error({
                    //         title: 'Duplicate data'
                    //     });
                    // }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
        } else {
            $('.loader').hide();
        }
    });


    //question condition flow edit
    $("body").on('click', '.question_flow_edit', function(e) {

        e.preventDefault();
        var edit_value = $(this).attr("data-id");
        var className = '.Email_Add_Ckeditor';
        if (editors[className]) {
            var editor = editors[className];
            var editorElement = editor.ui.getEditableElement();
            editorElement.style.border = '1px solid #ccc';
            editorElement.style.backgroundImage = 'none';
        }

        if (edit_value != "") {
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('bot_question_edit_data'); ?>",
                data: {
                    action: 'edit',
                    edit_id: edit_value,
                    table: 'bot_setup'
                },
                success: function(res) {
                    $('.loader').hide();
                    // console.log(res);
                    var response = JSON.parse(res);

                    $("#formGroupExampleInput").val(response[0].question);
                    $(".conditional_flow_update").attr('data-id', response[0].id);
                },
                error: function(error) {
                    $('.loader').hide();
                    // console.log(error);
                }
            });
        } else {
            $('.loader').hide();
            alert("Data Not Edit.");
        }
    });


    //question condition flow update
    $("body").on('click', '.conditional_flow_update', function(e) {
        e.preventDefault();
        var update_id = $(this).attr("data-id");
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';

        var next_question_id = $('.question_select').val();
        if (update_id != "") {
            var form = $("form[name='question_update_form']")[0];
            var formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', table);
            formdata.append('next_question_id', next_question_id);

            $('.loader').show();
            $.ajax({
                method: "post",
                url: "<?= site_url('bot_question_update'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res == true) {
                        $('.loader').hide();
                        // $("form[name='question_update_form']")[0].reset();
                        $("form[name='question_update_form']").removeClass("was-validated");
                        $(".btn-close").trigger("click");
                        iziToast.success({
                            title: 'Update Successfully'
                        });
                        bot_list_data();
                    } else {
                        $('.loader').hide();
                        $(".btn-close").trigger("click");
                        $("form[name='question_update_form']").removeClass("was-validated");
                        iziToast.error({
                            title: 'Duplicate data'
                        });
                    }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
        } else {
            $('.loader').hide();
        }
    });


    //duplicate question add
    $('body').on('click', '.duplicate_question_add', function() {
        var questionId = $(this).data('question');
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';
        $.ajax({
            method: 'post',
            url: 'duplicate_Question',
            data: {
                questionId: questionId,
                table: table,
            },
            success: function(response) {
                var duplicatedQuestionId = response.duplicatedQuestionId;
                iziToast.success({
                    title: 'Added Successfully'
                });
                bot_list_data();
            },
        });
    });


    //delete question
    $('body').on('click', '.question_delete', function() {
        var questionId = $(this).data('question');
        var record_text = "Are you sure you want to delete this question?";
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';
        Swal.fire({
            title: 'Delete Question?',
            text: record_text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'CONFIRM',
            cancelButtonText: 'CANCEL',
            cancelButtonColor: '#6e7881',
            confirmButtonColor: '#dd3333',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    method: "post",
                    url: "<?= site_url('bot_delete_data'); ?>",
                    data: {
                        action: 'delete',
                        id: questionId,
                        table: table
                    },
                    success: function(data) {
                        iziToast.error({
                            title: 'Deleted Successfully'
                        });
                        $(".close_btn").trigger("click");
                        bot_list_data();
                    }
                });
            }
        });

    });

    // $('body').on('click', '.user_reply', function(e) {
    //     var question = $(this).attr('data-question');
    //     var skip_question = $(this).attr('data-skip_question');
    //     var menu_message = $(this).attr('data-menu_message');
    //     // console.log(skip_question);
    //     $.ajax({
    //         method: "post",
    //         url: "<?= site_url('send_chat'); ?>",
    //         data: {
    //             action: 'send_chat',
    //             question: question,
    //             skip_question: skip_question,
    //             menu_message: menu_message,
    //         },
    //         success: function(data) {
    //             var obj = JSON.parse(data);
    //             // $('.chat_list').html(obj.chat_list_html);
    //         }
    //     });
    // });

    $("body").on('click', '.question_edit', function(e) {
        e.preventDefault();
        var type_of_question = $(this).attr("data-type_of_question");
        clearQuestions();
        var questionContainers = {
            1: "#firstquestion",
            13: "#firstquestion",
            2: "#secondquestion",
            40: "#secondquestion",
            42: "#secondquestion",
            3: "#thirdquestion",
            4: "#fourthquestion",
            5: "#fifthquestion",
            6: "#sixthquestion",
            11: "#sixthquestion",
            7: "#senenthquestion",
            8: "#eighthquestion",
            10: "#tenthquestion",
            14: "#tenthquestion",
            12: "#twelthquestion",
            15: "#fifteenquestion",
            16: "#sixteenquestion",
            17: "#seventeenquestion",
            18: "#eighteenquestion",
            21: "#twentyonequestion",
            23: "#twentythreequestion",
            24: "#twentyfourquestion",
            25: "#twentyfivequestion",
            27: "#twentysevenquestion",
            28: "#twentyeightquestion",
            30: "#thirtyethquestion",
            43: "#fourythreequestion",
            44: "#fouryfourquestion",
            41: "#fourtyonequestion",
        };
        var htmlContent = getQuestionHTML(type_of_question);
        $(questionContainers[type_of_question]).html(htmlContent);
    });

    function clearQuestions() {
        $("#firstquestion, #secondquestion, #thirdquestion, #fourthquestion, #fifthquestion, #sixthquestion, #senenthquestion, #eighthquestion, #twelthquestion, #tenthquestion ,#sixteenquestion, #seventeenquestion, #fifteenquestion, #eighteenquestion, #twentyonequestion, #twentythreequestion, #twentyfourquestion ,#twentysevenquestion, #twentyeightquestion, #thirtyethquestion, #fourythreequestion, #fouryfourquestion, #twentyfivequestion, #fourtyonequestion").html("");
    }

    function getQuestionHTML(type_of_question) {
        switch (type_of_question) {
            case "1":
            case "13":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                        <div class="col-12">
                            <div class="ps-0 form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                <label class="switch_toggle_primary">
                                    <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 menu_message opacity-0" value="1" type="checkbox" id="Question-1">
                                    <div class="check_input_primary round" ></div>
                                </label>
                                    
                                <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Question-1" for="Question-1">Do Not Remove Menu Message (For Whatsapp)</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="ps-0 form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                <label class="switch_toggle_primary">
                                    <input class="px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Question-2 skip_question opacity-0" type="checkbox" role="switch" id="Question-2">
                                    <div class="check_input_primary round" ></div>
                                </label>
                                    
                                <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Question-2" for="Question-2">Do Not Give Skip Option</label>
                            </div>
                        </div>
                        
                        <div class="col-12 my-2">
                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal" >Enter the error message here.</label>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid answer" placeholder="Enter Error Message">
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "2":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap single-choice">
                        <div class="col-12 d-flex flex-wrap">
                            <div class="col p-1">
                                <label class="form-check-label fw-semibold d-flex align-items-center py-2 single-choice-show-options">Show Options</label>
                            </div>
                            <div class="col p-1">
                                <button type="button" class="btn-primary w-100">Vertically</button>
                            </div>
                            <div class="col p-1">
                                <button type="button" class="btn-primary w-100">Horizontally</button>
                            </div>
                            <div class="col p-1">
                                <button type="button" class="btn-primary w-100">Dropdown</button>
                            </div>
                            <div class="col p-1">
                                <button type="button" class="btn-primary w-100">Do not show</button>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap my-3">
                            <table class="table w-100 col-12">
                                <thead>
                                    <tr>
                                        <th scope="col">Options</th>
                                        <th scope="col">Sub-Flow</th>
                                        <th scope="col">Jump To</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">

                                    <tr class="col-12 main-plan">
                                        <td class="col-3">
                                            <input type="text" class="form-control single_choice_options" placeholder="Enter the option" value="">
                                        </td>
                                        <td class="col-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Main-flow</option>
                                            </select>
                                        </td>
                                        <td class="col-4">
                                            <select class="form-select question_select" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                if (isset($admin_bot_setup)) {
                                                    foreach ($admin_bot_setup as $type_key => $type_value) {
                                                        // pre($type_value);

                                                        if ($type_value['bot_id'] == $botId) {

                                                            echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td class="col-2">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fa fa-trash  cursor-pointer"></i>
                                            </button>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="col-2">
                                <button type="button" class="btn-primary single-choice-add-tabal">add</button>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "40":
            case "42":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap single-choice">
                        <div class="col-12 d-flex flex-wrap my-3">
                            <table class="table w-100 col-12">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Sub-Flow</th>
                                        <th scope="col">Jump To</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">

                                    <tr class="col-12 main-plan">
                                        <td class="col-3">
                                            <input type="text" class="form-control single_choice_options" placeholder="Enter the option" value="">
                                        </td>
                                        <td class="col-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Main-flow</option>
                                            </select>
                                        </td>
                                        <td class="col-4">
                                            <select class="form-select question_select" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                if (isset($admin_bot_setup)) {
                                                    foreach ($admin_bot_setup as $type_key => $type_value) {
                                                        // pre($type_value);

                                                        if ($type_value['bot_id'] == $botId) {

                                                            echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td class="col-2">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fa fa-trash  cursor-pointer"></i>
                                            </button>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="col-2">
                                <button type="button" class="btn-primary single-choice-add-tabal">add</button>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "3":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap ">
                       <div class="col-12">
                            <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0">
                                <label class="switch_toggle_primary">
                                    <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Email-1 remove_menu opacity-0" value="1" type="checkbox" id="Email-1">
                                    <div class="check_input_primary round" ></div>
                                </label>
                                <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-1" for="Email-1">Do Not Remove Menu Message (For Whatsapp)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0">
                                <label class="switch_toggle_primary">
                                    <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Email-2 company_emails_only opacity-0" value="1" type="checkbox" id="Email-2">
                                    <div class="check_input_primary round" ></div>
                                </label>
                                <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-2" for="Email-2">Do Not Restrict to Company Emails</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0">
                                <label class="switch_toggle_primary">
                                    <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Email-3 is_strict_validation opacity-0" value="1" type="checkbox" id="Email-3">
                                    <div class="check_input_primary round" ></div>
                                </label>
                                <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-3" for="Email-3">No Strict Validation</label>
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Email Address" placeholder="Enter Error Message">
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "4":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap single-choice">
                        <div class="col-12 d-flex flex-wrap">
                            <div class="col-3 p-1">
                                <label class="form-check-label fw-semibold d-flex align-items-center py-2 single-choice-show-options">Show Options</label>
                            </div>
                            <div class="col-3 p-1">
                                <button type="button" class="btn-primary w-100">Vertically</button>
                            </div>
                            <div class="col-3 p-1">
                                <button type="button" class="btn-primary w-100">Dropdown</button>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap my-3">
                            <table class="table w-100 col-12">
                                <thead>
                                    <tr>
                                        <th scope="col">Options</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="multiple-table-body tbody_multiple">

                                    <tr class="col-12 multiple_main-plan">
                                        <td class="col-3">
                                            <input type="text" class="form-control multiple_choice_options" placeholder="Enter the option" value="">
                                        </td>
                                        <td class="col-2">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fa fa-trash  cursor-pointer"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="col-2">
                                <button type="button" class="btn-primary multiple-choice-add-tabal">add</button>
                            </div>
                        </div>
                        <div class="col-12 my-3">
                            <div class="col-8 d-flex flex-wrap align-items-center">
                                <span>Maximum number of options user can select</span>
                                <span class="col-1 mx-2"><input type="number" class="form-control" id="" value="1"></span>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "5":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0 ">
                            <div class="col-12">
                                <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0">
                                    <label class="switch_toggle_primary">
                                        <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Mobile-1 menu_message opacity-0" value="1" type="checkbox" id="Mobile-1">
                                        <div class="check_input_primary round" ></div>
                                    </label>
                                    <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Mobile-1" for="Mobile-1">Do Not Remove Menu Message (For Whatsapp)</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Phone Number" placeholder="Enter valid Phone Number">
                            </div>
                        </div>
                    </div> 
                </form>
                `;
            case "6":
            case "11":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                               <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0">
                                    <label class="switch_toggle_primary">
                                        <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Number-1 skip_question opacity-0" value="1" type="checkbox" id="Number-1">
                                        <div class="check_input_primary round" ></div>
                                    </label>
                                    <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Number-1" for="Number-1">Do Not Give Skip Option</label>
                                </div>
                        <div class="col-12 my-2 d-flex flex-wrap">
                            <form class="col-12">
                                <div class="col-6 px-2">
                                    <div class="col-12">
                                        <label for="" class="form-label">Minimum Value</label>
                                        <input type="number" class="form-control minimum_value" id="" aria-describedby="" placeholder="Enter Minimum Value">
                                    </div>
                                </div>
                                <div class="col-6 px-2">
                                    <div class="col-12">
                                        <label for="" class="form-label">Maximum Value</label>
                                        <input type="number" class="form-control maximum_value" id="" placeholder="Enter Maximum Value">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
                `;
            case "7":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 d-flex flex-wrap my-3">
                            <table class="table w-100 col-12">
                                <thead>
                                    <tr>
                                        <th scope="col">Options</th>
                                        <th scope="col">Sub-Flow</th>
                                        <th scope="col">Jump To</th>
                                    </tr>
                                </thead>
                                <tbody class="">

                                    <tr class="col-12">
                                        <td class="col-4">
                                            <input type="text" class="form-control terrible" id="" placeholder="" value="Terrible">
                                        </td>
                                        <td class="col-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Main-flow</option>
                                            </select>
                                        </td>
                                        <td class="col-4">
                                            <select class="form-select question_select_1" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                if (isset($admin_bot_setup)) {
                                                    foreach ($admin_bot_setup as $type_key => $type_value) {
                                                        // pre($type_value);

                                                        if ($type_value['bot_id'] == $botId) {

                                                            echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="col-12">
                                        <td class="col-4">
                                            <input type="text" class="form-control bad" id="" placeholder="" value="Bad">
                                        </td>
                                        <td class="col-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Main-flow</option>
                                            </select>
                                        </td>
                                        <td class="col-4">
                                            <select class="form-select question_select_2" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                if (isset($admin_bot_setup)) {
                                                    foreach ($admin_bot_setup as $type_key => $type_value) {
                                                        // pre($type_value);

                                                        if ($type_value['bot_id'] == $botId) {

                                                            echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="col-12">
                                        <td class="col-4">
                                            <input type="text" class="form-control okay" id="" placeholder="" value="Okay">
                                        </td>
                                        <td class="col-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Main-flow</option>
                                            </select>
                                        </td>
                                        <td class="col-4">
                                            <select class="form-select question_select_3" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                if (isset($admin_bot_setup)) {
                                                    foreach ($admin_bot_setup as $type_key => $type_value) {
                                                        // pre($type_value);

                                                        if ($type_value['bot_id'] == $botId) {

                                                            echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="col-12">
                                        <td class="col-4">
                                            <input type="text" class="form-control good" id="" placeholder="" value="Good">
                                        </td>
                                        <td class="col-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Main-flow</option>
                                            </select>
                                        </td>
                                        <td class="col-4">
                                            <select class="form-select question_select_4" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                if (isset($admin_bot_setup)) {
                                                    foreach ($admin_bot_setup as $type_key => $type_value) {
                                                        // pre($type_value);

                                                        if ($type_value['bot_id'] == $botId) {

                                                            echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="col-12">
                                        <td class="col-4">
                                            <input type="text" class="form-control great" id="" placeholder="" value="Great">
                                        </td>
                                        <td class="col-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">Main-flow</option>
                                            </select>
                                        </td>
                                        <td class="col-4">
                                            <select class="form-select question_select_5" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                if (isset($admin_bot_setup)) {
                                                    foreach ($admin_bot_setup as $type_key => $type_value) {
                                                        // pre($type_value);

                                                        if ($type_value['bot_id'] == $botId) {

                                                            echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 my-2 d-flex">
                            <div class="col-4 d-flex flex-wrap align-items-center justify-content-center">
                                <span>Rating Type</span>
                            </div>
                        </div>
                        <div class="col-12 my-2">

                            <div class="row">
                                <div class="col-4">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-Smilies-list" data-bs-toggle="list" href="#list-Smilies" role="tab" aria-controls="list-Smilies">Smilies</a>
                                        <a class="list-group-item list-group-item-action" id="list-Stars-list" data-bs-toggle="list" href="#list-Stars" role="tab" aria-controls="list-Stars">Stars</a>
                                        <a class="list-group-item list-group-item-action" id="list-Numbers-list" data-bs-toggle="list" href="#list-Numbers" role="tab" aria-controls="list-Numbers">Numbers</a>
                                        <a class="list-group-item list-group-item-action" id="list-Options-list" data-bs-toggle="list" href="#list-Options" role="tab" aria-controls="list-Options">Options</a>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="list-Smilies" role="tabpanel" aria-labelledby="list-Smilies-list">
                                            <div class="col-12 text-center">
                                                <img src="<?= site_url('assets/images/rating_smilies.png') ?>" alt="#" height="280px" width="350px">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="list-Stars" role="tabpanel" aria-labelledby="list-Stars-list">
                                            <div class="col-12 text-center">
                                                <img src="<?= site_url('assets/images/rating_stars.png') ?>" alt="#" height="280px" width="330px">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="list-Numbers" role="tabpanel" aria-labelledby="list-Numbers-list">
                                        <div class="col-12 text-center">
                                                <img src="<?= site_url('assets/images/rating_numbers.png') ?>" alt="#" height="280px" width="350px">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="list-Options" role="tabpanel" aria-labelledby="list-Options-list">
                                        <div class="col-12 text-center">
                                                <img src="<?= site_url('assets/images/rating_options.png') ?>" alt="#" height="280px" width="300px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "8":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                            <div class="col-1">
                                <span><b>NOTE:</b></span>
                            </div>
                            <div class="col-11">
                                <span>Please note that the below conditions are an intersection of each other.</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 px-5 my-2 border rounded-3">
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input days_val fw-bold mon_val" type="checkbox" id="" value="MON" checked>
                                <label class="form-check-label fw-semibold" for="">MON</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input days_val fw-bold tue_val" type="checkbox" id="" value="TUE" checked>
                                <label class="form-check-label fw-semibold" for="">TUE</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input days_val fw-bold wed_val" type="checkbox" id="" value="WED" checked>
                                <label class="form-check-label fw-semibold" for="">WED</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input days_val fw-bold thu_val" type="checkbox" id="" value="THU" checked>
                                <label class="form-check-label fw-semibold" for="">THU</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input days_val fw-bold fri_val" type="checkbox" id="" value="FRI" checked>
                                <label class="form-check-label fw-semibold" for="">FRI</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input days_val fw-bold sat_val" type="checkbox" id="" value="SAT" checked>
                                <label class="form-check-label fw-semibold" for="">SAT</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input days_val fw-bold sun_val" type="checkbox" id="" value="SUN" checked>
                                <label class="form-check-label fw-semibold" for="">SUN</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 px-5 my-2 border rounded-3">
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <span class="fw-medium">Select Date Range</span>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <input type="text" class="form-control date_range1" id="" value="" placeholder="DD-MM-YYYY">
                                    </div>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <input type="text" class="form-control date_range2" id="" value="" placeholder="DD-MM-YYYY">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <span class="fw-medium">Enable Future Days</span>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <input type="number" class="form-control enableFutureDays" id="" value="" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <span class="fw-medium">Enable Past (Days)</span>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <input type="number" class="form-control enablePasteDays" id="" value="" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 px-5 my-2 border rounded-3">
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <span class="fw-medium">Output Format</span>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <input type="text" class="form-control date_output_format" id="" value="dd-mm-yyyy" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "10":
            case "14":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0">
                                    <label class="switch_toggle_primary">
                                        <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Number-1 skip_question opacity-0" value="1" type="checkbox" id="Number-1">
                                        <div class="check_input_primary round" ></div>
                                    </label>
                                    <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Number-1" for="Number-1">Do Not Give Skip Option</label>
                                </div>
                    </div>
                </form>
                `;
            case "12":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                            <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ps-0">
                                <label class="switch_toggle_primary">
                                    <input class="toggle-checkbox px-3 fs-4 text-emphasis-success d-flex align-items-center pb-1 Location-1 skip_question opacity-0" value="1" type="checkbox" id="Location-1">
                                    <div class="check_input_primary round" ></div>
                                </label>
                                <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Location-1" for="Location-1">Do Not Give Skip Option</label>
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid Image" placeholder="Enter Error Message">
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Upload File</label>
                        </div>
                        <div class="col-12 my-2">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="image-database" data-bs-toggle="tab" data-bs-target="#image_database" type="button" role="tab" aria-controls="image_database" aria-selected="true">S3</button>
                                    <button class="nav-link" id="image-email" data-bs-toggle="tab" data-bs-target="#image_email" type="button" role="tab" aria-controls="image-email" aria-selected="false">Google Drive</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="image_database" role="tabpanel" aria-labelledby="image-database" tabindex="0"></div>
                                <div class="tab-pane fade" id="image_email" role="tabpanel" aria-labelledby="image-email" tabindex="0">
                                    <div class="col-12 p-2">
                                        <div class="input-group col-6">
                                            <input type="email" class="form-control" placeholder="Enter Email Address" aria-label="Enter Email Address" aria-describedby="button-email">
                                            <button class="btn-primary" type="button" id="button-email">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "15":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 my-2">
                        <div class="col-12 d-flex flex-wrap">
                            <div class="col-6 px-2">
                                <div class="col-12">
                                    <label for="" class="form-label">Currency </label>
                                    <select class="form-select w-100 currency" aria-label="Default select example">
                                        <option value="">Select</option>
                                        <option value="USD">USD(Dollars)</option> 
                                        <option value="INR">INR(Rupees)</option>
                                        <option value="AED">AED(United Arab Emirates)</option>
                                        <option value="ALL">ALL(Albanian lek)</option>
                                        <option value="AMD">AMD(Armenian dram)</option>
                                        <option value="ARS">ARS(Argentine peso)</option>
                                        <option value="AUD">AUD(Australian dollar)</option>
                                        <option value="AWG">AWG(Aruban florin)</option><option ng-repeat="currency in actualCurrencies" value="BBD" class="ng-binding ng-scope">BBD(Barbadian dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="BDT" class="ng-binding ng-scope">BDT(Bangladeshi taka)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="BMD" class="ng-binding ng-scope">BMD(Bermudian dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="BND" class="ng-binding ng-scope">BND(Brunei dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="BOB" class="ng-binding ng-scope">BOB(Bolivian boliviano)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="BSD" class="ng-binding ng-scope">BSD(Bahamian dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="BWP" class="ng-binding ng-scope">BWP(Botswana pula)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="BZD" class="ng-binding ng-scope">BZD(Belize dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="CAD" class="ng-binding ng-scope">CAD(Canadian dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="CHF" class="ng-binding ng-scope">CHF(Swiss franc)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="CNY" class="ng-binding ng-scope">CNY(Chinese Yuan Renminbi)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="COP" class="ng-binding ng-scope">COP(Colombian peso)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="CRC" class="ng-binding ng-scope">CRC(Costa Rican colon)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="CUP" class="ng-binding ng-scope">CUP(Cuban peso)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="CZK" class="ng-binding ng-scope">CZK(Czech koruna)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="DKK" class="ng-binding ng-scope">DKK(Danish krone)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="DOP" class="ng-binding ng-scope">DOP(Dominican peso)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="DZD" class="ng-binding ng-scope">DZD(Algerian dinar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="EGP" class="ng-binding ng-scope">EGP(Egyptian pound)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="ETB" class="ng-binding ng-scope">ETB(Ethiopian birr)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="EUR" class="ng-binding ng-scope">EUR(European euro)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="FJD" class="ng-binding ng-scope">FJD(Fijian dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="GBP" class="ng-binding ng-scope">GBP(Pound sterling)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="GIP" class="ng-binding ng-scope">GIP(Gibraltar pound)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="GMD" class="ng-binding ng-scope">GMD(Gambian dalasi)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="GTQ" class="ng-binding ng-scope">GTQ(Guatemalan quetzal)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="GYD" class="ng-binding ng-scope">GYD(Guyanese dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="HKD" class="ng-binding ng-scope">HKD(Hong Kong dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="HNL" class="ng-binding ng-scope">HNL(Honduran lempira)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="HRK" class="ng-binding ng-scope">HRK(Croatian kuna)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="HTG" class="ng-binding ng-scope">HTG(Haitian gourde)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="HUF" class="ng-binding ng-scope">HUF(Hungarian forint)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="IDR" class="ng-binding ng-scope">IDR(Indonesian rupiah)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="ILS" class="ng-binding ng-scope">ILS(Israeli new shekel)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="JMD" class="ng-binding ng-scope">JMD(Jamaican dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="KES" class="ng-binding ng-scope">KES(Kenyan shilling)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="KGS" class="ng-binding ng-scope">KGS(Kyrgyzstani som)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="KHR" class="ng-binding ng-scope">KHR(Cambodian riel)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="KYD" class="ng-binding ng-scope">KYD(Cayman Islands dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="KZT" class="ng-binding ng-scope">KZT(Kazakhstani tenge)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="LAK" class="ng-binding ng-scope">LAK(Lao kip)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="LBP" class="ng-binding ng-scope">LBP(Lebanese pound)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="LKR" class="ng-binding ng-scope">LKR(Sri Lankan rupee)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="LRD" class="ng-binding ng-scope">LRD(Liberian dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="LSL" class="ng-binding ng-scope">LSL(Lesotho loti)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MAD" class="ng-binding ng-scope">MAD(Moroccan dirham)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MDL" class="ng-binding ng-scope">MDL(Moldovan leu)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MKD" class="ng-binding ng-scope">MKD(Macedonian denar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MMK" class="ng-binding ng-scope">MMK(Myanmar kyat)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MNT" class="ng-binding ng-scope">MNT(Mongolian tugrik)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MOP" class="ng-binding ng-scope">MOP(Macanese pataca)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MUR" class="ng-binding ng-scope">MUR(Mauritian rupee)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MVR" class="ng-binding ng-scope">MVR(Maldivian rufiyaa)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MWK" class="ng-binding ng-scope">MWK(Malawian kwacha)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MXN" class="ng-binding ng-scope">MXN(Mexican peso)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="MYR" class="ng-binding ng-scope">MYR(Malaysian ringgit)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="NAD" class="ng-binding ng-scope">NAD(Namibian dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="NGN" class="ng-binding ng-scope">NGN(Nigerian naira)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="NIO" class="ng-binding ng-scope">NIO(Nicaraguan cordoba)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="NOK" class="ng-binding ng-scope">NOK(Norwegian krone)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="NPR" class="ng-binding ng-scope">NPR(Nepalese rupee)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="NZD" class="ng-binding ng-scope">NZD(New Zealand dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="PEN" class="ng-binding ng-scope">PEN(Peruvian sol)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="PGK" class="ng-binding ng-scope">PGK(Papua New Guinean kina)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="PHP" class="ng-binding ng-scope">PHP(Philippine peso)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="PKR" class="ng-binding ng-scope">PKR(Pakistani rupee)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="QAR" class="ng-binding ng-scope">QAR(Qatari riyal)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="RUB" class="ng-binding ng-scope">RUB(Russian ruble)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SAR" class="ng-binding ng-scope">SAR(Saudi Arabian riyal)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SCR" class="ng-binding ng-scope">SCR(Seychellois rupee)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SEK" class="ng-binding ng-scope">SEK(Swedish krona)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SGD" class="ng-binding ng-scope">SGD(Singapore dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SLL" class="ng-binding ng-scope">SLL(Sierra Leonean leone)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SOS" class="ng-binding ng-scope">SOS(Somali shilling)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SSP" class="ng-binding ng-scope">SSP(South Sudanese pound)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SVC" class="ng-binding ng-scope">SVC(Salvadoran colón)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="SZL" class="ng-binding ng-scope">SZL(Swazi lilangeni)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="THB" class="ng-binding ng-scope">THB(Thai baht)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="TTD" class="ng-binding ng-scope">TTD(Trinidad and Tobago dollar)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="TZS" class="ng-binding ng-scope">TZS(Tanzanian shilling)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="UYU" class="ng-binding ng-scope">UYU(Uruguayan peso)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="UZS" class="ng-binding ng-scope">UZS(Uzbekistani som)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="YER" class="ng-binding ng-scope">YER(Yemeni rial)</option><!-- end ngRepeat: currency in actualCurrencies --><option ng-repeat="currency in actualCurrencies" value="ZAR" class="ng-binding ng-scope">ZAR(South African rand)</option><!-- end ngRepeat: currency in actualCurrencies -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 px-2">
                                <div class="col-12">
                                    <label for="" class="form-label">Minimum Order Amount</label>
                                    <input type="number" class="form-control min_order_amount" id="" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2 d-flex flex-wrap">
                            <div class="col-6 px-2">
                                <div class="col-12">
                                    <label for="" class="form-label">Discount Percentage</label>
                                    <input type="number" class="form-control discount_percentage" id="" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-6 px-2">
                                <div class="col-12">
                                    <label for="" class="form-label">Tax Percentage</label>
                                    <input type="number" class="form-control tax_percentage" id="" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2 d-flex flex-wrap">
                            <div class="col-6 px-2">
                                <div class="col-12">
                                    <label for="" class="form-label">Delivery Charges</label>
                                    <input type="number" class="form-control delivery_charges" id="" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-6 px-2">
                                <div class="col-12">
                                    <label for="" class="form-label">Size</label>
                                    <input type="text" class="form-control size" id="" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2 d-flex flex-wrap">
                            <div class="col-6 px-2">

                            </div>
                            <div class="col-6 px-2">
                                <div class="col-12">
                                    <label for="" class="form-label">Note: Separate different string by comma(,). E.g. M,S,L Note: Size is Only for Instagram</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "16":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 my-2">
                            <form class="col-12 d-flex flex-wrap">
                                <div class="col-6 px-2">
                                    <div class="col-12">
                                        <label for="" class="form-label">Button Text :</label>
                                        <input type="text" class="form-control button_text" id="" aria-describedby="" value="Authenticator" placeholder="Set Button Text">
                                    </div>
                                </div>
                                <div class="col-6 px-2">
                                    <div class="col-12">
                                        <label for="" class="form-label">Button URL :</label>
                                        <input type="text" class="form-control button_url" id="" placeholder="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
            `;
            case "17":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="forms_div">

                    </div>

                    <div class="col-12 p-3">
                        <div class="col-2">
                            <button type="button" class="btn-primary form_question">Add</button>
                        </div>
                    </div>
                </form>
            `;
            case "18":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap Corousel-choice">
                        <div class="col-12 d-flex flex-wrap my-3">
                            <div class="form-check form-switch d-flex flex-wrap align-items-center col-4 m-2">
                                <div class="d-flex align-items-center col-12 my-2">
                                    <label class="switch_toggle_primary">
                                        <input class="toggle-checkbox Corousel-1 auto_slide_carousel" type="checkbox" id="Corousel-1">
                                        <span class="check_input_primary round"></span>
                                    </label>
                                    <p class="mx-2 fw-medium Corousel-1">Do Not Auto Slide</p>
                                </div>
                            </div>
                            <div class="col-4 d-flex flex-wrap align-items-center corousel-sec-input d-none">
                                <span>Delay (sec)</span>
                                <span class="col-3 mx-2"><input type="number" class="form-control" id="" value="1"></span>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-wrap my-3">
                            <table class="table w-100 col-12">
                                <thead>
                                    <tr class="Corousel-table-head">
                                        <th scope="col" class="fs-12 fw-medium">Options</th>
                                        <th scope="col" class="fs-12 fw-medium">Sub-flow</th>
                                        <th scope="col" class="fs-12 fw-medium">Jump To</th>
                                        <th scope="col" class="fs-12 fw-medium">File</th>
                                        <th scope="col" class="fs-12 fw-medium"></th>
                                    </tr>
                                </thead>
                                <tbody class="Corousel-table-body">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="col-2">
                                <button type="button" class="btn-primary Corousel-add-tabal">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            `;
            case "21":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 d-flex flex-wrap border rounded-3 p-2">
                            <div class="col-1">
                                <span><b>NOTE:</b></span>
                            </div>
                            <div class="col-11">
                                <span>Please note that the below conditions are an intersection of each other.</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap border justify-content-center rounded-3 my-2 p-2">
                            <div class="col-12 text-center my-1">
                                <span><b>Google Calendar</b></span>
                            </div>
                            <div class="col-6 d-flex flex-wrap justify-content-center">
                                <div class="input-group col-4">
                                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" disabled>
                                    <button class="btn-primary" type="button" id="button-addon2">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 px-5 my-2 border rounded-3">
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input fw-bold appointment_weekdays" type="checkbox" id="" value="MON" checked>
                                <label class="form-check-label fw-semibold" for="">MON</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input fw-bold appointment_weekdays" type="checkbox" id="" value="TUE" checked>
                                <label class="form-check-label fw-semibold" for="">TUE</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input fw-bold appointment_weekdays" type="checkbox" id="" value="WED" checked>
                                <label class="form-check-label fw-semibold" for="">WED</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input fw-bold appointment_weekdays" type="checkbox" id="" value="THU" checked>
                                <label class="form-check-label fw-semibold" for="">THU</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input fw-bold appointment_weekdays" type="checkbox" id="" value="FRI" checked>
                                <label class="form-check-label fw-semibold" for="">FRI</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input fw-bold appointment_weekdays" type="checkbox" id="" value="SAT" checked>
                                <label class="form-check-label fw-semibold" for="">SAT</label>
                            </div>
                            <div class="form-check form-check-inline col">
                                <input class="form-check-input fw-bold appointment_weekdays" type="checkbox" id="" value="SUN" checked>
                                <label class="form-check-label fw-semibold" for="">SUN</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label ">Disable Next (Days)</label>
                                        <input type="number" class="form-control appointment_next_days" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">End Date :</label>
                                        <input type="text" class="form-control appointment_date_range" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">Enable Future (Days)</label>
                                        <input type="number" class="form-control appointment_period" id="" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-wrap align-items-center justify-content-between my-1">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">Enable Next (Days)</label>
                                        <input type="number" class="form-control appointment_period" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-7 p-2 d-flex flex-wrap align-items-center">
                                    <div class="d-flex align-items-center col-12 my-2">
                                        <label class="switch_toggle_primary">
                                            <input class="toggle-checkbox Appointment-1 enable_timezone_selection" type="checkbox" id="Appointment-1">
                                            <span class="check_input_primary round"></span>
                                        </label>
                                        <p class="mx-2 fw-medium Appointment-1">Enable Timezone Selection</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                            <div class="col-12 d-flex flex-wrap align-items-center">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">Slot Timings :</label>
                                        <select class="form-select from_timing" aria-label="Default select example">
                                           <option value="12:00 AM">12:00 AM</option>
                                           <option value="12:30 AM">12:30 AM</option>
                                           <option value="01:00 AM">01:00 AM</option>
                                           <option value="01:30 AM">01:30 AM</option>
                                           <option value="02:00 AM">02:00 AM</option><option ng-repeat="timing in available_timings" value="02:30 AM" class="ng-binding ng-scope">02:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="03:00 AM" class="ng-binding ng-scope">03:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="03:30 AM" class="ng-binding ng-scope">03:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:00 AM" class="ng-binding ng-scope">04:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:30 AM" class="ng-binding ng-scope">04:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:00 AM" class="ng-binding ng-scope">05:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:30 AM" class="ng-binding ng-scope">05:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:00 AM" class="ng-binding ng-scope">06:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:30 AM" class="ng-binding ng-scope">06:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:00 AM" class="ng-binding ng-scope">07:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:30 AM" class="ng-binding ng-scope">07:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:00 AM" class="ng-binding ng-scope">08:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:30 AM" class="ng-binding ng-scope">08:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:00 AM" class="ng-binding ng-scope">09:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:30 AM" class="ng-binding ng-scope">09:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:00 AM" class="ng-binding ng-scope">10:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:30 AM" class="ng-binding ng-scope">10:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:00 AM" class="ng-binding ng-scope">11:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:30 AM" class="ng-binding ng-scope">11:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="12:00 PM" class="ng-binding ng-scope">12:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="12:30 PM" class="ng-binding ng-scope">12:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="01:00 PM" class="ng-binding ng-scope">01:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="01:30 PM" class="ng-binding ng-scope">01:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="02:00 PM" class="ng-binding ng-scope">02:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="02:30 PM" class="ng-binding ng-scope">02:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="03:00 PM" class="ng-binding ng-scope">03:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="03:30 PM" class="ng-binding ng-scope">03:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:00 PM" class="ng-binding ng-scope">04:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:30 PM" class="ng-binding ng-scope">04:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:00 PM" class="ng-binding ng-scope">05:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:30 PM" class="ng-binding ng-scope">05:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:00 PM" class="ng-binding ng-scope">06:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:30 PM" class="ng-binding ng-scope">06:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:00 PM" class="ng-binding ng-scope">07:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:30 PM" class="ng-binding ng-scope">07:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:00 PM" class="ng-binding ng-scope">08:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:30 PM" class="ng-binding ng-scope">08:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:00 PM" class="ng-binding ng-scope">09:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:30 PM" class="ng-binding ng-scope">09:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:00 PM" class="ng-binding ng-scope">10:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:30 PM" class="ng-binding ng-scope">10:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:00 PM" class="ng-binding ng-scope">11:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:30 PM" class="ng-binding ng-scope">11:30 PM</option><!-- end ngRepeat: timing in available_timings -->
                                        </select>

                                    </div>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label"></label>
                                        <select class="form-select to_timing" aria-label="Default select example">
                                            <option value="12:00 AM">12:00 AM</option>
                                            <option value="12:30 AM">12:30 AM</option>
                                            <option value="01:00 AM">01:00 AM</option>
                                            <option value="01:30 AM">01:30 AM</option>
                                            <option value="02:00 AM">02:00 AM</option>
                                            <option value="02:30 AM">02:30 AM</option>
                                            <option value="03:00 AM">03:00 AM</option><option ng-repeat="timing in available_timings" value="03:30 AM" class="ng-binding ng-scope">03:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:00 AM" class="ng-binding ng-scope">04:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:30 AM" class="ng-binding ng-scope">04:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:00 AM" class="ng-binding ng-scope">05:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:30 AM" class="ng-binding ng-scope">05:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:00 AM" class="ng-binding ng-scope">06:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:30 AM" class="ng-binding ng-scope">06:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:00 AM" class="ng-binding ng-scope">07:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:30 AM" class="ng-binding ng-scope">07:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:00 AM" class="ng-binding ng-scope">08:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:30 AM" class="ng-binding ng-scope">08:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:00 AM" class="ng-binding ng-scope">09:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:30 AM" class="ng-binding ng-scope">09:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:00 AM" class="ng-binding ng-scope">10:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:30 AM" class="ng-binding ng-scope">10:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:00 AM" class="ng-binding ng-scope">11:00 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:30 AM" class="ng-binding ng-scope">11:30 AM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="12:00 PM" class="ng-binding ng-scope">12:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="12:30 PM" class="ng-binding ng-scope">12:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="01:00 PM" class="ng-binding ng-scope">01:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="01:30 PM" class="ng-binding ng-scope">01:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="02:00 PM" class="ng-binding ng-scope">02:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="02:30 PM" class="ng-binding ng-scope">02:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="03:00 PM" class="ng-binding ng-scope">03:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="03:30 PM" class="ng-binding ng-scope">03:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:00 PM" class="ng-binding ng-scope">04:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="04:30 PM" class="ng-binding ng-scope">04:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:00 PM" class="ng-binding ng-scope">05:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="05:30 PM" class="ng-binding ng-scope">05:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:00 PM" class="ng-binding ng-scope">06:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="06:30 PM" class="ng-binding ng-scope">06:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:00 PM" class="ng-binding ng-scope">07:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="07:30 PM" class="ng-binding ng-scope">07:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:00 PM" class="ng-binding ng-scope">08:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="08:30 PM" class="ng-binding ng-scope">08:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:00 PM" class="ng-binding ng-scope">09:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="09:30 PM" class="ng-binding ng-scope">09:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:00 PM" class="ng-binding ng-scope">10:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="10:30 PM" class="ng-binding ng-scope">10:30 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:00 PM" class="ng-binding ng-scope">11:00 PM</option><!-- end ngRepeat: timing in available_timings --><option ng-repeat="timing in available_timings" value="11:30 PM" class="ng-binding ng-scope">11:30 PM</option><!-- end ngRepeat: timing in available_timings -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">Timezone</label>
                                        <select class="form-select timezone" aria-label="Default select example">
                                            <option value="+14:00">GMT+14:00(Samoa and Christmas Island / Kiribati, LINT, Kiritimati)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+13:45" class="ng-binding ng-scope">GMT+13:45(Chatham Islands / New Zealand, CHADT, Chatham Islands)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+13:00" class="ng-binding ng-scope">GMT+13:00(New Zealand with exceptions and 4 more, NZDT, Auckland)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+12:00" class="ng-binding ng-scope">GMT+12:00(Fiji, small region of Russia, ANAT, Anadyr)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+11:00" class="ng-binding ng-scope">GMT+11:00(much of Australia and 7 more, AEDT, Melbourne)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+10:30" class="ng-binding ng-scope">GMT+10:30(small region of Australia, ACDT, Adelaide)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+10:00" class="ng-binding ng-scope">GMT+10:00(Queensland / Australia and 6 more, AEST, Brisbane)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+09:30" class="ng-binding ng-scope">GMT+09:30(Northern Territory / Australia, ACST, Darwin)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+9" class="ng-binding ng-scope">GMT+9(Japan, South Korea and , JST, Tokyo)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+08:45" class="ng-binding ng-scope">GMT+08:45(Western Australia / Australia, ACWST, Eucla)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+08:00" class="ng-binding ng-scope">GMT+08:00(China, Philippines, CST, Beijing)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+07:00" class="ng-binding ng-scope">GMT+07:00(much of Indonesia, Thailand, WIB, Jakarta)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+06:30" class="ng-binding ng-scope">GMT+06:30(Myanmar and Cocos Islands, MMT, Yangon)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+06:00" class="ng-binding ng-scope">GMT+06:00(Bangladesh and 6 more, BST, Dhaka)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+05:45" class="ng-binding ng-scope">GMT+05:45(Nepal, NPT, Kathmandu)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+05:30" class="ng-binding ng-scope">GMT+05:30(India and Sri Lanka, IST, New Delhi)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+05:00" class="ng-binding ng-scope">GMT+05:00(Pakistan and 8 more, UZT, Tashkent)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+04:30" class="ng-binding ng-scope">GMT+04:30(Afghanistan, AFT, Kabul)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+04:00" class="ng-binding ng-scope">GMT+04:00(Azerbaijan and 8 more, GST, Dubai)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+03:30" class="ng-binding ng-scope">GMT+03:30(Iran, IRST, Tehran)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+03:00" class="ng-binding ng-scope">GMT+03:00(Moscow / Russia and 22 more, MSK, Moscow)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+02:00" class="ng-binding ng-scope">GMT+02:00(Greece and 31 more, EET, Cairo)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+01:00" class="ng-binding ng-scope">GMT+01:00(Germany and 45 more, CET, Brussels)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="+00:00" class="ng-binding ng-scope">GMT+00:00(United Kingdom and 24 more, GMT, London)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-01:00" class="ng-binding ng-scope">GMT-01:00(Cabo Verde and 2 more, CVT, Praia)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-02:00" class="ng-binding ng-scope">GMT-02:00(Pernambuco / Brazil and South Georgia / Sandwich Is., GST, King Edward Point)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-03:00" class="ng-binding ng-scope">GMT-03:00(most of Brazil, Argentina and 9 more, ART, Buenos Aires)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-03:30" class="ng-binding ng-scope">GMT-03:30(Newfoundland and Labrador / Canada, NST, St.John 's)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-04:00" class="ng-binding ng-scope">GMT-04:00(some regions of Canada and 28 more, VET, Caracas)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-05:00" class="ng-binding ng-scope">GMT-05:00(regions of USA and 14 more, EST, New York)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-06:00" class="ng-binding ng-scope">GMT-06:00(regions of USA and 9 more, CST, Mexico City)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-07:00" class="ng-binding ng-scope">GMT-07:00(some regions of USA and 2 more, MST, Calgary)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-08:00" class="ng-binding ng-scope">GMT-08:00(regions of USA and 4 more, PST, Los Angeles)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-09:00" class="ng-binding ng-scope">GMT-09:00(Alaska / USA and regions of French Polynesia, AKST, Anchorage)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-09:30" class="ng-binding ng-scope">GMT-09:30(Marquesas Islands / French Polynesia, MART, Taiohae)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-10:00" class="ng-binding ng-scope">GMT-10:00(small region of USA and 2 more, HST, Honolulu)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-11:00" class="ng-binding ng-scope">GMT-11:00(American Samoa and 2 more, NUT, Alofi)</option><!-- end ngRepeat: timezone in available_timezones --><option ng-repeat="timezone in available_timezones" value="-12:00" class="ng-binding ng-scope">GMT-12:00(much of US Minor Outlying Islands, AoE, Baker Island)</option><!-- end ngRepeat: timezone in available_timezones -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-wrap align-items-center">
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">Slot Interval <span class="text-denger">*</span>(Mins) :</label>
                                        <input type="number" class="form-control interval" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">Format</label>
                                        <select class="form-select format" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="12">12 Hours</option>
                                            <option value="24">24 Hours</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label">Meetings per slot </label>
                                        <input type="number" class="form-control bookings_per_slot" id="" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-12">
                                    <label for="" class="form-label">Data Referencing (You can use it only for Title) </label>
                                </div>
                                <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Main Flow</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <select class="form-select appointment_jump_question" aria-label="Default select example">
                                            <?php
                                            if (isset($admin_bot_setup)) {
                                                foreach ($admin_bot_setup as $type_key => $type_value) {
                                                    // pre($type_value);

                                                    if ($type_value['bot_id'] == $botId) {

                                                        echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control title" id="" placeholder="Title">
                                    </div>
                                </div>
                                <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Description </label>
                                        <input type="text" class="form-control description" id="" placeholder="Description">
                                    </div>
                                </div>
                                <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Meeting Location<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control meeting_url" id="" placeholder="Meeting Location">
                                    </div>
                                </div>
                                <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Message to show when selected slot is already booked </label>
                                        <input type="text" class="form-control already_booked_message" id="" placeholder="Text to show when selected slot is already booked">
                                    </div>
                                </div>
                                <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Message to show when slots are unavailable </label>
                                        <input type="text" class="form-control no_slots_message" id="" placeholder="Text to show when slots are unavailable">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            `;
            case "23":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div>
                        <div class="updates_mandiv">

                        </div>
                        <div class="col-1">
                            <button type="button" class="mt-3 btn-primary updates_mandivc">ADD</button>
                        </div>
                    </div>
                </form>
            `;
            case "24":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 d-flex flex-wrap my-3">
                            <div class="d-flex flex-wrap align-items-center col-4 m-2">
                                <div class="d-flex align-items-center ">
                                    <label class="switch_toggle_primary">
                                        <input class="toggle-checkbox proudect-1 auto_slide_carousel" type="checkbox" id="proudect-1">
                                        <span class="check_input_primary round"></span>
                                    </label>
                                    <p class="mx-2 fw-medium proudect-1">Do Not Auto Slide</p>
                                </div>
                            </div>
                            <div class="col-4 d-flex flex-wrap  align-items-center proudect-corousel-sec-input second-remove">
                                <span class="col">Delay (sec)</span>
                                <span class="col mx-2"><input type="number" class="form-control" id="" value="1"></span>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-wrap my-3">
                            <div class="proudect-table-body">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-2">
                                <button type="button" class="btn-primary proudect-add-tabal">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            `;
            case "25":
                return `
               
                    <div class="d-flex flex-wrap col-12">
                        <div class="col-12 d-flex flex-wrap my-3">
                            <div class="d-flex flex-wrap align-items-center col-4 m-2" style="height: 69px;">
                                <div class="d-flex align-items-center ">
                                    <label class="switch_toggle_primary">
                                        <input class="toggle-checkbox proudect-1" type="checkbox" id="proudect-1">
                                        <span class="check_input_primary round auto_slide_carousel"></span>
                                    </label>
                                    <p class="mx-2 fw-medium proudect-1">Do Not Auto Slide</p>
                                </div>
                            </div>

                            <div class="col-4 d-flex flex-wrap  align-items-center proudect-corousel-sec-input second-remove">
                                <span class="col">Delay (sec)</span>
                                <span class="col mx-2">
                                    <input type="number" class="form-control" id="" value="1">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="img_carousel mt-3 d-none">
                        <div class="position-relative">
                            <img src="https://th.bing.com/th/id/OIP.IhiqRWFamp-enjV2csKdzwHaE8?rs=1&pid=ImgDetMain" height="200px" width="200px" class="position-relative" alt="">

                            <button class="border-0 position-absolute bg-white rounded-5 img_carousel_clo_btn top-0 end-0" style="height: 20px; width: 20px;  "><i class="bi bi-x"></i></button>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-wrap px-3 input-change">
                        <div class="col-12 my-2 d-flex flex-wrap justify-content-center p-2 media-upload-box">
                            <input type="file" class="position-absolute carousel_img_input col-12" style="height: 200px; opacity: 0;" name="" id="">

                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                        <g>
                                            <defs>
                                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                    <path d="M0 512h512V0H0Z" fill="#000000" opacity="1" data-original="#000000"></path>
                                                </clipPath>
                                            </defs>
                                            <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                <path d="M0 0h-189.325c-18.299 0-33.133 14.834-33.133 33.132v33.134H31.824Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(246.509 90.334)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0v-231.933h-397.633c-18.299 0-33.133 14.834-33.133 33.133V0l231.95 82.834z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(454.816 355.4)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(281.128 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(347.384 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(413.65 289.133)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0v24.85a8.282 8.282 0 0 1-8.283 8.283H-24.85a8.282 8.282 0 0 1-8.283-8.283V8.283A8.282 8.282 0 0 1-24.85 0Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(289.128 222.867)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 156.6)" fill="#3c58a0" data-original="#3c58a0"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(413.65 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(347.384 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(281.128 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 322.267)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 256)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(82.328 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 256)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(148.595 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.618-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 256)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0v25.133a8 8 0 0 1-8 8h-17.133a7.961 7.961 0 0 1-2.933-.562C-25.102 31.4-23 28.515-23 25.133V8c0-3.382-2.102-6.267-5.066-7.438A7.982 7.982 0 0 1-25.133 0Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(289.128 222.867)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0h-17.133a7.982 7.982 0 0 1-2.933-.562C-17.102-1.733-15-4.619-15-8v-17.133c0-3.382-2.102-6.267-5.066-7.438a7.961 7.961 0 0 1 2.933-.562H0a8 8 0 0 1 8 8V-8a8 8 0 0 1-8 8" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(214.861 189.733)" fill="#2a428c" data-original="#2a428c"></path>
                                                <path d="M0 0v-241.522h23.016V-9.589z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(431.8 364.99)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0v82.834c0 18.299-14.834 33.133-33.132 33.133h-364.501c-18.299 0-33.133-14.834-33.133-33.133V0z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(454.816 355.4)" fill="#ff4155" data-original="#ff4155"></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.438 0-20.709 9.271-20.709 20.708v41.417c0 11.437 9.271 20.708 20.709 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(164.867 442.375)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.437 0-20.708 9.271-20.708 20.708v41.417c0 11.437 9.271 20.708 20.708 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(355.394 442.375)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0a20.604 20.604 0 0 1-11.488-3.482C-5.932-7.196-2.27-13.523-2.27-20.708v-41.417c0-7.186-3.662-13.513-9.218-17.226A20.604 20.604 0 0 1 0-82.833c11.437 0 20.708 9.271 20.708 20.708v41.417C20.708-9.271 11.437 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(334.687 504.5)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0a20.607 20.607 0 0 1-11.489-3.482C-5.932-7.196-2.27-13.523-2.27-20.708v-41.417c0-7.186-3.662-13.513-9.219-17.226A20.607 20.607 0 0 1 0-82.833c11.437 0 20.708 9.271 20.708 20.708v41.417C20.708-9.271 11.437 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(144.16 504.5)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0h-23.009C-4.71 0 10.124-14.833 10.124-33.132v-82.835h23.008v82.835C33.132-14.833 18.298 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(421.685 471.367)" fill="#e80054" data-original="#e80054"></path>
                                                <path d="M0 0c0 68.622 55.629 124.25 124.25 124.25C192.871 124.25 248.5 68.622 248.5 0s-55.629-124.25-124.25-124.25C55.629-124.25 0-68.622 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(239.434 131.75)" fill="#4fabf7" data-original="#4fabf7"></path>
                                                <path d="M0 0c0 50.322 40.794 91.117 91.116 91.117S182.233 50.322 182.233 0s-40.795-91.117-91.117-91.117S0-50.322 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(272.567 131.75)" fill="#ebf5fc" data-original="#ebf5fc" class=""></path>
                                                <path d="M0 0c-3.878 0-7.712-.187-11.5-.535C51.729-6.339 101.25-59.507 101.25-124.25S51.729-242.161-11.5-247.965A125.64 125.64 0 0 1 0-248.5c68.621 0 124.25 55.629 124.25 124.25C124.25-55.629 68.621 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(363.684 256)" fill="#1886ea" data-original="#1886ea"></path>
                                                <path d="M0 0c-3.893 0-7.728-.246-11.492-.719C33.405-6.37 68.133-44.687 68.133-91.117c0-46.429-34.728-84.747-79.625-90.397A91.942 91.942 0 0 1 0-182.233c50.322 0 91.117 40.794 91.117 91.116C91.117-40.794 50.322 0 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(363.684 222.867)" fill="#d3dcfb" data-original="#d3dcfb" class=""></path>
                                                <path d="M0 0c0-9.149-7.417-16.567-16.566-16.567-9.15 0-16.567 7.418-16.567 16.567 0 9.149 7.417 16.567 16.567 16.567C-7.417 16.567 0 9.149 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(380.25 131.75)" fill="#ffdd40" data-original="#ffdd40"></path>
                                                <path d="M0 0v222.032c0 18.298-14.834 33.132-33.133 33.132h-66.266" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(454.816 216.203)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0v-134.1c0-18.298 14.834-33.132 33.133-33.132h182.595" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 290.7)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-66.267c-18.298 0-33.132-14.834-33.132-33.132v-117.535" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(123.45 471.367)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-149.111" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(313.978 471.367)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-18.145c-18.298 0-33.132 14.834-33.132 33.132v33.134" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(75.328 90.334)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-141.181" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(246.509 90.334)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.438 0-20.709 9.271-20.709 20.708v41.417c0 11.437 9.271 20.708 20.709 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(164.867 442.375)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-16.566" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(123.45 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h16.566" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(164.867 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h430.766" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 355.4)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h430.766" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(24.05 388.533)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0-11.437-9.271-20.708-20.708-20.708-11.437 0-20.708 9.271-20.708 20.708v41.417c0 11.437 9.271 20.708 20.708 20.708C-9.271 62.125 0 52.854 0 41.417Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(355.394 442.375)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-16.567" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(313.978 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h16.567" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(355.394 438.233)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(281.128 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(347.384 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(413.65 289.133)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-14.931a8.282 8.282 0 0 0-8.283 8.283V24.85a8.282 8.282 0 0 0 8.283 8.283H1.636a8.282 8.282 0 0 0 8.283-8.283V8.283" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(279.209 222.867)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.134a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(82.328 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(148.595 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h-17.133a8 8 0 0 0-8 8v17.133a8 8 0 0 0 8 8H0a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.861 156.6)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0 68.622 55.629 124.25 124.25 124.25C192.871 124.25 248.5 68.622 248.5 0s-55.629-124.25-124.25-124.25C55.629-124.25 0-68.622 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(239.434 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0 50.322 40.794 91.117 91.116 91.117S182.233 50.322 182.233 0s-40.795-91.117-91.117-91.117S0-50.322 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(272.567 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0c0-9.149-7.417-16.567-16.566-16.567-9.15 0-16.567 7.418-16.567 16.567 0 9.149 7.417 16.567 16.567 16.567C-7.417 16.567 0 9.149 0 0Z" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(380.25 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0v41.417" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(363.684 148.317)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                                <path d="M0 0h24.851" style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(380.25 131.75)" fill="none" stroke="#000000" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path>
                                            </g>
                                        </g>
                                    </svg>
                        
                        </div>
                    </div>

                    
            `;
            case "27":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12">
                        <div class="contact_div">

                        </div>
                        <div class="col-1">
                            <button type="button" class="mt-3 btn-primary contact_div_add">ADD</button>
                        </div>
                    </div>
                </form>
            `;
            case "28":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 my-2">
                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Choose your location</label>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control location_place" id="" value="" placeholder="Enter a place">
                            </div>
                        </div>
                    </div>
                </form>
            `;
            case "30":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-warp">
                        <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                            <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Enter your URL <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control redirect_url" id="" placeholder="your URL">
                                    </div>
                                </div>
                                <div class="col-6 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Open In </label>
                                        <select class="form-select open_tab" aria-label="Default select example">
                                            <option selected>Same Tab</option>
                                            <option value="1">New Tab</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 p-2 d-flex flex-wrap align-items-center">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-medium">Delay </label>
                                        <input type="number" class="form-control delay_url" id="" placeholder="" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            `;
            case "43":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-12 my-2">
                            <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Cateory Id</label>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control location_place" id="" value="" placeholder="Enter Cateory Id">
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="button" class="mt-3 btn-primary contact_div_add">Fetch</button>
                        </div>
                    </div>
                </form>
            `;
            case "44":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Number-1 remove_question" type="checkbox" role="switch" id="Number-1">
                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Number-1" for="Number-1">Do Not Remove Message(For Whatsaapp)</label>
                        </div>
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Number-1 previous_address" type="checkbox" role="switch" id="Number-1">
                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Number-1" for="Number-1">show previous address</label>
                        </div>
                        <div class="col-12 my-2 d-flex flex-wrap">
                                <div class="col-6 px-2">
                                    <div class="col-12">
                                        <label for="" class="form-label">Header Text</label>
                                        <input type="text" class="form-control header_text" id="" aria-describedby="" placeholder="Enter Header Text">
                                    </div>
                                </div>
                                <div class="col-6 px-2">
                                    <div class="col-12">
                                        <label for="" class="form-label">Footer Text</label>
                                        <input type="text" class="form-control footer_text" id="" placeholder="Enter Footer Text">
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </form>
            `;
            case "41":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div>
                        <div class="row col-12 text-center">
                            <div class="col-4"><label for="formGroupExampleInput" class="form-label">Options</label></div>
                            <div class="col-3"><label for="formGroupExampleInput" class="form-label">Sub-Flow</label></div>
                            <div class="col-5"><label for="formGroupExampleInput" class="form-label">Jump To</label></div>
                        </div>
                        <label for="formGroupExampleInput" class="form-label">Add More Button</label>
                        <div class="row mt-1 mb-3">
                            <div class="col-4">
                                <input type="text" class="form-control add_more_button" id="formGroupExampleInput" value="Add More" placeholder="Add More" disabled>
                            </div>
                            <div class="col-3">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Main Flow</option>
                                </select>
                            </div>

                            <div class="col-5">
                                <select class="form-select add_more_button_jump" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                    <?php
                                        if (isset($admin_bot_setup)) {
                                            foreach ($admin_bot_setup as $type_key => $type_value) {
                                                // pre($type_value);

                                                if ($type_value['bot_id'] == $botId) {

                                                    echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <label for="formGroupExampleInput" class="form-label">Submit Button</label>
                        <div class="row mt-1 mb-3">
                            <div class="col-4">
                                <input type="text" class="form-control submit_button" id="formGroupExampleInput" value="Submit" placeholder="Submit" disabled>
                            </div>
                            <div class="col-3">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Main Flow</option> 
                                </select>
                            </div>

                            <div class="col-5">
                                <select class="form-select quantity_button_jump" aria-label="Default select example">
                                    <?php
                                        if (isset($admin_bot_setup)) {
                                            foreach ($admin_bot_setup as $type_key => $type_value) {
                                                // pre($type_value);

                                                if ($type_value['bot_id'] == $botId) {

                                                    echo '<option value="' . $type_value["id"] . '">' . $type_value["question"] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <label for="formGroupExampleInput" class="form-label col-12">Remove Items text</label>
                        <div>
                            <input type="text" class="form-control w-25 edit_quantity_button" id="formGroupExampleInput" value="Edit Quantity" placeholder="Edit Quantity" disabled>
                        </div>
                    </div>
                </form>
            `;
            default:
            return "";
        }
    }
</script>

<script>
    // $('#date_range1').bootstrapMaterialDatePicker({
    //     format: 'DD-MM-YYYY',
    //     time: false,
    //     clearButton: true
    // });
    // $('.date_range2').bootstrapMaterialDatePicker({
    //     format: 'DD-MM-YYYY',
    //     time: false,
    //     clearButton: true
    // });
</script>
<script>
    $(document).ready(function() {
        $(document).on("click","#sound-icon",function(){
            $(".sound-icon-lite").toggleClass("d-none");
        })
        
    })
    // $('#date_range1').bootstrapMaterialDatePicker({
    //     format: 'DD-MM-YYYY',
    //     time: false,
    //     clearButton: true
    // });
    // $('.date_range2').bootstrapMaterialDatePicker({
    //     format: 'DD-MM-YYYY',
    //     time: false,
    //     clearButton: true
    // });
</script>