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

    .modal-card-body-main{
        background: #f0e4f6;
    }
    .form-control:focus {
        box-shadow: 0px 0px 0px black;
    }
    .input-group>.form-control:focus{
        z-index: 0;
    }
    .messege-sub{
        background-color: #724EBF;
    }
    .messege-scroll::-webkit-scrollbar {
        display: none;
    }

</style>


<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1 flex-wrap justify-content-between">
                <div class="col d-flex flex-wrap align-items-center">
                    <i class="bi bi-gear-fill mx-2"></i>
                    <h2>Bot Chats</h2>
                </div>
                <button type="button" class="btn btn-primary bot_preview" data-bs-toggle="modal" data-bs-target="#chat_withbot">Preview</button>
            </div>


            <div class="col-12 d-flex flex-wrap ">
                <div class="col-4 p-1 ">
                    <div class="col-12 border rounded-3 bg-white p-3 overflow-y-scroll d-flex flex-wrap" style="height:80vh">
                        <div class="col-12  d-flex justify-content-between my-3">
                            <div class="col-6">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Main Flow</option>

                                </select>
                            </div>
                            <div class="col-1">
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
                                <div class="col-3 p-2 question_add" data-qu="What is Your Name?">
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
                                <div class="col-3 p-2 question_add" data-qu="What is Your Gender?">
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
                                <div class="col-3 p-2 question_add" data-qu="Enter Your Email.">
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

                                <div class="col-3 p-2 question_add" data-qu="What type of food do you eat?">
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


                                <div class="col-3 p-2 question_add" data-qu="Enter your mobile number">
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

                                <div class="col-3 p-2 question_add" data-qu="How many bots do you want?">
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

                                <div class="col-3 p-2 question_add" data-qu="How would you rate our company?">
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

                                <div class="col-3 p-2 question_add" data-qu="When is your birthday?">
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

                                <div class="col-3 p-2 question_add" data-qu="In which slot would you like to book the appointment?">
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

                                <div class="col-3 p-2 question_add" data-qu="Where do you live?">
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

                                <div class="col-3 p-2 question_add" data-qu="What is your age?">
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

                                <div class="col-3 p-2 question_add" data-qu="Can you upload a file?">
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

                                <div class="col-3 p-2 question_add" data-qu="Can you give us your website?">
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

                                <div class="col-3 p-2 question_add" data-qu="Please share your contact details">
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

                                <div class="col-3 p-2 question_add" data-qu="Choose item(s)">
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

                                <div class="col-3 p-2 question_add" data-qu="Please authenticate">
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

                                <div class="col-3 p-2 question_add" data-qu="Please share your full address">
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

                                <div class="col-3 p-2 question_add" data-qu="Pick an item of your choices">
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

                                <div class="col-3 p-2 question_add" data-qu="This will call your api and show the response to the user">
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

                                <div class="col-3 p-2 question_add" data-qu="This will call your api and show the search result in real time to the user">
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

                                <div class="col-3 p-2 question_add" data-qu="When would you like to book your appointment?">
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
                                <div class="col-3 p-2 question_add" data-qu="Hello">
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
                                <div class="col-3 p-2 question_add" data-qu="Follow us on facebook for more updates.">
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
                                <div class="col-3 p-2 question_add" data-qu="Here are recommended products for you">
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

                                <div class="col-3 p-2 question_add" data-qu="These are product samples">
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


                                <div class="col-3 p-2 question_add" data-qu="Listen to this">
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

                                <div class="col-3 p-2 question_add" data-qu="Our contact(s)">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-sharp fa-solid fa-address-book icon"></i>
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

                                <div class="col-3 p-2 question_add" data-qu="Our Location">
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

                                <div class="col-3 p-2 question_add" data-qu="Our Logo">
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

                                <div class="col-3 p-2 question_add" data-qu="URL Auto Redirect">
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

                                <div class="col-3 p-2 question_add" data-qu="URL Based Flow">
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

                                <div class="col-3 p-2 question_add" data-qu="Country Based Flow">
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

                                <div class="col-3 p-2 question_add" data-qu="Action Based Flow">
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
                                <button type="button" class="btn btn-primary">Setup Menu Options</button>
                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>FAQs Setup</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-3 p-2 question_add">
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
                                <div class="col-3 p-2 question_add">
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
                                <button type="button" class="btn btn-primary">Map Intents</button>
                            </div>
                        </form>

                        <div class="col-12 my-3 d-flex justify-content-center">
                            <span><b>Live Agent</b></span>
                        </div>
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-3 p-2 question_add" data-qu="Talh to out live agent">
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
                                <div class="col-3 p-2 question_add" data-qu="Choose one template">
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
                                <div class="col-3 p-2 question_add" data-qu="Whatsapp Message Based Flow">
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
                                <div class="col-3 p-2 question_add" data-qu="Choose From the below list">
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
                                <div class="col-3 p-2 question_add" data-qu="======Cart Summery======">
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
                                <div class="col-3 p-2 question_add" data-qu="Adding the whatsapp button.">
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
                                <div class="col-3 p-2 question_add" data-qu="Adding the whatsapp catalog">
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
                                <div class="col-3 p-2 question_add" data-qu="Provide Address">
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
                                <div class="col-3 p-2 question_add" data-qu="">
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
                                <div class="col-3 p-2 question_add">
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
                                <div class="col-3 p-2 question_add">
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
                    <ul class="nav nav-tabs col-12" id="myTab" role="tablist">
                        <li class="nav-item col-4 d-flex justify-content-center" role="presentation">
                            <button class="nav-link active w-100 fw-medium" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-edit" type="button" role="tab" aria-controls="basic" aria-selected="true">Basic</button>
                        </li>
                        <li class="nav-item col-4 d-flex justify-content-center" role="presentation">
                            <button class="nav-link w-100 fw-medium" id="media-tab" data-bs-toggle="tab" data-bs-target="#media-edit" type="button" role="tab" aria-controls="media" aria-selected="false">Media</button>
                        </li>
                        <li class="nav-item col-4 d-flex justify-content-center" role="presentation">
                            <button class="nav-link w-100 fw-medium" id="advanced-tab" data-bs-toggle="tab" data-bs-target="#advanced-edit" type="button" role="tab" aria-controls="advanced" aria-selected="false">Advanced</button>
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
                                
                                <div class="col-12 d-flex flex-wrap px-3" id="firstquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-3" id="secondquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-3" id="thirdquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-3" id="fourthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-3" id="fifthquestion"></div> 
                                <div class="col-12 d-flex flex-wrap px-3" id="sixthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-3" id="tenthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-3" id="twelthquestion"></div>
                                <div class="col-12 d-flex flex-wrap px-3" id="senenthquestion"></div>
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
                                                        <button class="btn btn-primary" type="button" id="button-addon2">Coppy</button>
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
            <div class="col-12 d-flex flex-wrap p-1 my-3">

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
                                                    <button class="btn btn-primary" type="button" id="button-addon2">Coppy</button>
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
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary update_question">Update</button>
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
                        <input type="text" class="form-control" id="formGroupExampleInput"
                            placeholder="URL Auto Redirect" disabled>
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
                                           
                                            if ($type_value['bot_id'] == $botId ) {
                                               
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary conditional_flow_update">Save</button>
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
      <div class="modal-body ">
        <div class="col-12 border rounded-3">
            <div class="moda-card-header d-flex flex-wrap justify-content-center py-3 border-bottom bg-primary">
                <div class="col-8 d-flex flex-wrap align-items-center justify-content-between ">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="border  rounded-circle overflow-hidden" style="width:40px;height:40px">
                            <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="#" class="w-100 h-100 img-circle">
                        </div>
                        <h6 class="mx-2 text-white">Oppo</h6>
                    </div>
                    <div class="d-flex flex-wrap">
                        <button class="btn bg-primary mx-2 text-white">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <button class="btn bg-primary text-white">
                            <i class="fa-solid fa-rotate-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-card-body-main d-flex flex-wrap  flex-column align-items-center justify-content-between ">
                    <div class="overflow-y-scroll col-8 py-3 messege-scroll"  style="min-height:400px; max-height:400px">

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
                                <input type="text" class="form-control rounded-pill px-4 py-2 border-0" placeholder="Type Your Answer" >
                                <button class="btn btn-primary rounded-circle me-1 px-3 chatting_data"><i class="fa-solid fa-caret-right"></i></button>
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
    $('body').on('click', '.bot_preview', function(e) {
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';
        $.ajax({
            method: "post",
            url: "<?= site_url('bot_preview'); ?>",
            data: {
                action: 'init_chat',
                table: table,
            },
            success: function(data) {
                var response = JSON.parse(data);
                $('.loader').hide();
                $(".bot_preview_html").html(response.html);
            }
        });
    });


    var insertedData;
    var chatArray = [];
    $('body').on('click', '.chatting_data', function (e) {
        e.preventDefault();
        var insertedData = $(this).data('insertedData');
        var chatting = $('#standalone_chat_popup').val();
        var table = '<?php echo getMasterUsername2(); ?>_bot_setup';
        if (chatting !== "") {
            chatArray.push(chatting);
            $.ajax({
                method: "post",
                url: "<?= site_url('update_data'); ?>",
                data: {
                    edit_id: insertedData,
                    table: table,
                    action: "update",
                    // chat: chatting,
                },
                success: function (res) {
                
                    // $('.store_conversiton_div').val(res);
                    // $('#standalone_chat_popup').val("");
                    list_data_s();
                    // setTimeout(() => {
                    //     scrollToBottom();
                    // }, 400);
                }
            });
        }
    });
    //draggable jquery
    // $(".bot-box").on("dragstart",function(){
    //     $('.droppable').css("outline","2px dotted black");
    //     $('.droppable').css("background-color","#d5d5d5");
    // });

    // $(".bot-box").on("dragend", function() {
    //     $('.droppable').css("outline","3px dotted transparent");
    //     $('.droppable').css("background-color","#f4f4f6");
    // });

    // $('.bot-box').on('dragover', function(event) {
    //     event.preventDefault();
    // });

    // $('.droppable').on('drop', function(event) {
    //     event.preventDefault();
    //     var draggedElement = $('.dragging');
    //     $(this).append(draggedElement);
    //     draggedElement.removeClass('dragging');

    //     // Alert when dropped
    //     alert('Item dropped!');
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
                $('.Question-2').text('Give Skip Option');
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
                    
                    var default_options = response[0].default_options;
                    
                    if(default_options != ''){
                        var default_options = JSON.parse(response[0].default_options);
                        $(".minimum_value").val(default_options.min);
                        $(".maximum_value").val(default_options.max);

                        if (default_options.remove_menu === "true") {
                            $(".menu_message").prop("checked", true);
                            $(".remove_menu").prop("checked", true);
                        } else {
                            $(".menu_message").prop("checked", false);
                            $(".remove_menu").prop("checked", false);
                        }
                        if (default_options.company_emails_only === "true") {
                            $(".company_emails_only").prop("checked", true);
                        } else {
                            $(".company_emails_only").prop("checked", false);
                        }
                        if (default_options.is_strict_validation === "true") {
                            $(".is_strict_validation").prop("checked", true);
                        } else {
                            $(".is_strict_validation").prop("checked", false);
                        }


                        if(type_of_question == 2){
                            if (default_options.options != "") {
                                var optionsArray = default_options.options.split(';'); 
                                $(".main-plan").remove();
                                optionsArray.forEach(function(option, index) {
                                    var row_numbers = index === 0 ? '' : $('.main-plan').length;
                                    // if (type_of_question == "2") {
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
                            }else {
                                $(".is_strict_validation").prop("checked", false);
                            }
                        } 


                        if(type_of_question == 4){
                            if (default_options.options != "") {
                                var optionsArray = default_options.options.split(';'); 
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
                        
                    }

                    var skip_question = response[0].skip_question;
                    if (skip_question == 1) {
                        $(".skip_question").prop("checked", true);
                    } else {
                        $(".skip_question").prop("checked", false);
                    }
                    $(".update_question").attr('data-id',response[0].id);
                    $(".update_question").attr('data-type_of_question',response[0].type_of_question);
                   
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
            var valuesJson = JSON.stringify(remove_menuArray);
            if (valuesJson === 'undefined') {
                valuesJson = ''; 
            }
            var error_text = $('#Question_error_message').val();
        }
        
        if (type_of_question == "2") {
            var comined = {}; 
            var options = $('.single_choice_options').val();
            comined.options = options; 
            for (var i = 1; i <= 3; i++) { 
                var options_i = $('.single_choice_options_' + i).val();
                if (options_i) {
                    if (comined.options !== "") {
                        comined.options += ";"; 
                    }
                    comined.options += options_i;
                }
            }
            var valuesJson = JSON.stringify(comined);
            if (valuesJson === 'undefined') {
                valuesJson = ''; 
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
            var valuesJson = JSON.stringify(valuesArray);
            if (valuesJson === 'undefined') {
                valuesJson = ''; 
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
            var valuesJson = JSON.stringify(comined);
            if (valuesJson === 'undefined') {
                valuesJson = ''; 
            }
        }

        if (type_of_question == "6" || type_of_question == "11") {
            var minimum_value = $('.minimum_value').val();
            var maximum_value = $('.maximum_value').val();
            var valuesArray = {
                min: minimum_value,
                max: maximum_value,      
            };
            var valuesJson = JSON.stringify(valuesArray);
            if (valuesJson === 'undefined') {
                valuesJson = ''; 
            }
        }

        if (type_of_question == "7") {
            var Terrible = $('.terrible').val();
            var Bad = $('.bad').val();
            var Okay = $('.okay').val();
            var Good = $('.good').val();
            var Great = $('.great').val();

            var reactionArray = [Terrible, Bad, Okay, Good, Great];
            var valuesArray = {
                reaction: reactionArray
            };

            var valuesJson = JSON.stringify(valuesArray);
            if (valuesJson === 'undefined') {
                valuesJson = ''; 
            }
        }



        if (update_id != "") {
            var form = $("form[name='question_update_form']")[0];
            var formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('edit_id', update_id);
            formdata.append('table', table);
            formdata.append('question', htmlContent);

            if (typeof valuesJson === 'undefined') {
                formdata.append('default_options', '');
            } else {
                formdata.append('default_options', valuesJson);
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
                success: function (res) {
                    if (res == true) {
                        $('.loader').hide();
                        $("form[name='question_update_form']")[0].reset();
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
                error: function (error) {
                    $('.loader').hide();
                }
            });
        } 
        else {
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
                    $(".conditional_flow_update").attr('data-id',response[0].id);
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
                success: function (res) {
                    if (res == true) {
                        $('.loader').hide();
                        $("form[name='question_update_form']")[0].reset();
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
                error: function (error) {
                    $('.loader').hide();
                }
            });
        } 
        else {
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
            2: "#secondquestion",
            3: "#thirdquestion",
            4: "#fourthquestion",
            5: "#fifthquestion",
            6: "#sixthquestion",
            11: "#sixthquestion",
            7: "#senenthquestion",
            10: "#tenthquestion",
            14: "#tenthquestion",
            12: "#twelthquestion"
        };
        var htmlContent = getQuestionHTML(type_of_question);
        $(questionContainers[type_of_question]).html(htmlContent);
    });

    function clearQuestions() {
        $("#firstquestion, #secondquestion, #thirdquestion, #fourthquestion, #fifthquestion, #sixthquestion, #senenthquestion, #twelthquestion, #tenthquestion").html("");
    }

    function getQuestionHTML(type_of_question) {
        switch (type_of_question) {
            case "1":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
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
                                                        
                                                            if ($type_value['bot_id'] == $botId ) {
                                                            
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
                                <button type="button" class="btn btn-primary single-choice-add-tabal">add</button>
                            </div>
                        </div>
                    </div>
                </form>
                `;
            case "3":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Email-1 remove_menu" type="checkbox" role="switch" id="Email-1">
                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-1" for="Email-1">Do Not Remove Menu Message (For Whatsapp)</label>
                        </div>
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Email-2 company_emails_only" type="checkbox" role="switch" id="Email-2">
                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Email-2" for="Email-2">Do Not Restrict to Company Emails</label>
                        </div>
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Email-3 is_strict_validation" type="checkbox" role="switch" id="Email-3">
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
                                <button type="button" class="btn btn-primary multiple-choice-add-tabal">add</button>
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
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Mobile-1 menu_message" type="checkbox" role="switch" id="Mobile-1">
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
                    </div> 
                </form>
                `;
            case "6":
            case "11":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Number-1 skip_question" type="checkbox" role="switch" id="Number-1">
                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 Number-1" for="Number-1">Do Not Give Skip Option</label>
                        </div>
                        <div class="col-12 my-2">
                            <form class="col-12 d-flex flex-wrap">
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
                                            <select class="form-select question_select" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                    if (isset($admin_bot_setup)) {
                                                        foreach ($admin_bot_setup as $type_key => $type_value) {
                                                            // pre($type_value);
                                                        
                                                            if ($type_value['bot_id'] == $botId ) {
                                                            
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
                                            <select class="form-select question_select" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                    if (isset($admin_bot_setup)) {
                                                        foreach ($admin_bot_setup as $type_key => $type_value) {
                                                            // pre($type_value);
                                                        
                                                            if ($type_value['bot_id'] == $botId ) {
                                                            
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
                                            <select class="form-select question_select" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                    if (isset($admin_bot_setup)) {
                                                        foreach ($admin_bot_setup as $type_key => $type_value) {
                                                            // pre($type_value);
                                                        
                                                            if ($type_value['bot_id'] == $botId ) {
                                                            
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
                                            <select class="form-select question_select" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                    if (isset($admin_bot_setup)) {
                                                        foreach ($admin_bot_setup as $type_key => $type_value) {
                                                            // pre($type_value);
                                                        
                                                            if ($type_value['bot_id'] == $botId ) {
                                                            
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
                                            <select class="form-select question_select" aria-label="Default select example">
                                                <option selected>No Jump</option>
                    
                                                <?php
                                                    if (isset($admin_bot_setup)) {
                                                        foreach ($admin_bot_setup as $type_key => $type_value) {
                                                            // pre($type_value);
                                                        
                                                            if ($type_value['bot_id'] == $botId ) {
                                                            
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

            case "10":
            case "14":
                return `
                <form class="needs-validation" name="question_update_form" enctype="multipart/form-data" method="POST" novalidate="">
                    <div class="col-12 d-flex flex-wrap px-2">
                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                            <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Number-1 skip_question" type="checkbox" role="switch" id="Number-1">
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
                            <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 mx-3 px-5 ">
                                <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 Location-1 skip_question" type="checkbox" role="switch" id="Location-1">
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
                    </div>
                </form>
                `;
            default:
            return ""; 
        }
    }

</script>