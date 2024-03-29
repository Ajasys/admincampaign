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

    .second-add {
        display: block !important;
    }

    .second-remove {
        display: none !important;
    }
</style>


<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Bot Chats</h2>
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
                            <div id="editor_add" class="Email_Add_Ckeditor" style="border:1px solid red">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 d-flex-flex-wrap">

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

                    <div class="tab-content col-12 edit-data-panal">
                        <div class="tab-pane active" id="basic-edit" role="tabpanel" aria-labelledby="basic-tab" tabindex="0">
                            <div class="col-12 d-flex flex-wrap p-1">

                                <!--Whatsapp-->
                                <!-- <div class="col-12 d-flex flex-wrap px-3">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center">
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Question-1" type="checkbox" id="Question-1">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Question-1">Do Not Remove Menu Message (For Whatsapp)</p>
                                        </div>
                                    </div>
                                </div> -->


                                <!--Question-->
                                <!-- <div class="col-12 d-flex flex-wrap px-2">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Question-1" type="checkbox" id="Question-1">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Question-1">Do Not Remove Menu Message (For Whatsapp)</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Question-2" type="checkbox" id="Question-2">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Question-2">Do Not Give Skip Option</p>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label class="form-check-label fw-semibold d-flex align-items-center py-2 Question-labal">Enter the error message here.</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Question_error_message" value="Please enter a valid answer" placeholder="Enter Error Message">
                                        </div>
                                    </div>
                                </div> -->

                                <!--Single Choice-->
                                <!-- <div class="col-12 d-flex flex-wrap single-choice">
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
                                                        <button type="button" class="btn btn-danger">D</button>
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
                                </div> -->

                                <!--Email-->
                                <!-- <div class="col-12 d-flex flex-wrap px-2">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Email-1" type="checkbox" id="Email-1">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Email-1">Do Not Remove Menu Message (For Whatsapp)</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Email-2" type="checkbox" id="Email-2">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Email-2">Do Not Restrict to Company Emails</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2">
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Email-3" type="checkbox" id="Email-3">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Email-3">No Strict Validation</p>
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
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Mobile-1" type="checkbox" id="Mobile-1">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Mobile-1">Do Not Remove Menu Message (For Whatsapp)</p>
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
                                </div> -->


                                <!--Number-->
                                <!-- <div class="col-12 d-flex flex-wrap px-2">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center col-12 my-2 ">
                                        <div class="d-flex align-items-center col-12 my-2">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox Number-1" type="checkbox" id="Number-1">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium Number-1">Do Not Give Skip Option</p>
                                        </div>
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
                                            <div class="d-flex align-items-center col-12 my-2">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox Location-1" type="checkbox" id="Location-1">
                                                    <span class="check_input_primary round"></span>
                                                </label>
                                                <p class="mx-2 fw-medium Location-1">Do Not Give Skip Option</p>
                                            </div>
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
                                            <div class="d-flex align-items-center col-12 my-2">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox Location-1" type="checkbox" id="Location-1">
                                                    <span class="check_input_primary round"></span>
                                                </label>
                                                <p class="mx-2 fw-medium Location-1">Do Not Give Skip Option</p>
                                            </div>
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
                                            <div class="d-flex align-items-center col-12 my-2">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox Website-1" type="checkbox" id="Website-1">
                                                    <span class="check_input_primary round"></span>
                                                </label>
                                                <p class="mx-2 fw-medium Website-1">Do Not Give Skip Option</p>
                                            </div>
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
                                            <div class="d-flex align-items-center col-12 my-2">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox Ask_Contact-1" type="checkbox" id="Ask_Contact-1">
                                                    <span class="check_input_primary round"></span>
                                                </label>
                                                <p class="mx-2 fw-medium Ask_Contact-1">Do Not Give Skip Option</p>
                                            </div>
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

                                <!--Forms-->
                                <!-- <div class="col-12 d-flex flex-wrap Forms-choice">
                                    <div class="col-12 d-flex flex-wrap">
                                        <div class="col-12 d-flex justify-content-center">
                                            <label class="form-check-label d-flex align-items-center single-choice-show-options fw-semibold">Ask users to submit a form</label>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <label class="form-check-label d-flex align-items-center  py-1 single-choice-show-options fs-12 fw-medium">Note: If specifying regex make sure it is valid. For regex example click Advance options</label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap my-3">
                                        <table class="table w-100 col-12">
                                            <thead>
                                                <tr class="form-table-head">
                                                    <th scope="col" class="fs-12 fw-medium">Select Type</th>
                                                    <th scope="col" class="fs-12 fw-medium">Questions</th>
                                                    <th scope="col" class="fs-12 fw-medium">Required</th>
                                                    <th scope="col" class="fs-12 fw-medium regex-head">Regex</th>
                                                    <th scope="col" class="fs-12 fw-medium">Description</th>
                                                    <th scope="col" class="fs-12 fw-medium"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="form-table-body">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-2">
                                            <button type="button" class="btn btn-outline-dark form-add-tabal">Add</button>
                                        </div>
                                    </div>
                                </div> -->

                                <!--Corousel-->
                                <!-- <div class="col-12 d-flex flex-wrap Corousel-choice">
                                    <div class="col-12 d-flex flex-wrap my-3">
                                        <div class="form-check form-switch d-flex flex-wrap align-items-center col-4 m-2">
                                            <div class="d-flex align-items-center col-12 my-2">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox Corousel-1" type="checkbox" id="Corousel-1">
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
                                                    <th scope="col" class="fs-12 fw-medium">Questions</th>
                                                    <th scope="col" class="fs-12 fw-medium">Required</th>
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
                                            <button type="button" class="btn btn-outline-dark Corousel-add-tabal">Add</button>
                                        </div>
                                    </div>
                                </div> -->

                                <!--Appointment Booking-->
                                <!-- <div class="col-12 d-flex flex-wrap">
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
                                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Remove</button>
                                            </div>
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
                                    <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                                        <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Disable Next (Days)</label>
                                                    <input type="number" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">End Date :</label>
                                                    <input type="number" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Enable Future (Days)</label>
                                                    <input type="number" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap align-items-center justify-content-between my-1">
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Disable Next (Days)</label>
                                                    <input type="number" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-7 p-2 d-flex flex-wrap align-items-center">
                                                <div class="d-flex align-items-center col-12 my-2">
                                                    <label class="switch_toggle_primary">
                                                        <input class="toggle-checkbox Appointment-1" type="checkbox" id="Appointment-1">
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
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label"></label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Timezone</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap align-items-center">
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Slot Interval <span class="text-denger">*</span>(Mins) :</label>
                                                    <input type="number" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Format</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Meetings per slot </label>
                                                    <input type="number" class="form-control" id="" placeholder="">
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
                                    <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                                        <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                            <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Description </label>
                                                    <input type="text" class="form-control" id="" placeholder="Description">
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Meeting Location<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="" placeholder="Meeting Location">
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Message to show when selected slot is already booked </label>
                                                    <input type="text" class="form-control" id="" placeholder="Text to show when selected slot is already booked">
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Message to show when slots are unavailable </label>
                                                    <input type="text" class="form-control" id="" placeholder="Text to show when slots are unavailable">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!--url redirec yasht-->
                                <!-- <div class="col-12 d-flex flex-warp">
                                    <div class="col-12 d-flex flex-wrap p-3 my-2 border rounded-3">
                                        <div class="col-12 d-flex flex-wrap align-items-center my-1">
                                            <div class="col-12 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Enter your URL <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="" placeholder="your URL">
                                                </div>
                                            </div>
                                            <div class="col-6 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Open In </label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Same Tab</option>
                                                        <option value="1">New Tab</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 p-2 d-flex flex-wrap align-items-center">
                                                <div class="col-12">
                                                    <label for="" class="form-label fw-medium">Delay </label>
                                                    <input type="number" class="form-control" id="" placeholder="" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- Follow us on facebook for more updates. yash -->
                                <!-- <div>
                                    <div class="updates_mandiv">

                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn mt-3 btn-outline-primary" onclick="updates_mandiv()">ADD</button>
                                    </div>
                                </div> -->

                                <!-- carousel  yash -->
                                <!-- <div class="d-flex flex-wrap col-12">
                                    <div class="col-12 d-flex flex-wrap my-3">
                                        <div class="d-flex flex-wrap align-items-center col-4 m-2" style="height: 69px;">
                                            <div class="d-flex align-items-center ">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox proudect-1" type="checkbox" id="proudect-1">
                                                    <span class="check_input_primary round"></span>
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
                                </div> -->

                                <!-- Pick an item of your choices. yash -->
                                <!-- <div class="d-flex flex-wrap col-12">
                                    <div class="col-12 d-flex flex-wrap my-3">
                                        <div class="d-flex flex-wrap align-items-center col-4 m-2" style="height: 69px;">
                                            <div class="d-flex align-items-center ">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox proudect-1" type="checkbox" id="proudect-1">
                                                    <span class="check_input_primary round"></span>
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

                                <div class="row mt-2 mb-3">
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect">
                                    </div>
                                    <div class="col-2">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="file" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect">
                                    </div>
                                    <div class="col-1">
                                        <div class="col">
                                            <button type="button" class="btn btn-outline-danger">D</button>
                                        </div>
                                    </div>
                                </div> -->

                                <!--proudect carousel-->
                                <!-- <div class="col-12 d-flex flex-wrap">
                                    <div class="col-12 d-flex flex-wrap my-3">
                                        <div class="d-flex flex-wrap align-items-center col-4 m-2">
                                            <div class="d-flex align-items-center ">
                                                <label class="switch_toggle_primary">
                                                    <input class="toggle-checkbox proudect-1" type="checkbox" id="proudect-1">
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
                                            <button type="button" class="btn btn-outline-dark proudect-add-tabal">Add</button>
                                        </div>
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

                <div class="col-12 d-flex-flex-wrap">

                    <!-- dynamic question -->
                    <!-- <div class="model_body_two">

                        <div class="row mt-2 mb-3">
                            <div class="col-3">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect">
                            </div>
                        </div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="Params-tab" data-bs-toggle="tab" data-bs-target="#Params-tab-pane" type="button" role="tab" aria-controls="Params-tab-pane" aria-selected="true">Params</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Cookies-tab" data-bs-toggle="tab" data-bs-target="#Cookies-tab-pane" type="button" role="tab" aria-controls="Cookies-tab-pane" aria-selected="false">Cookies</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Authorization-tab" data-bs-toggle="tab" data-bs-target="#Authorization-tab-pane" type="button" role="tab" aria-controls="Authorization-tab-pane" aria-selected="false">Authorization</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Headeers-tab" data-bs-toggle="tab" data-bs-target="#Headeers-tab-pane" type="button" role="tab" aria-controls="Headeers-tab-pane" aria-selected="false">Headeers</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Error-Handling-tab" data-bs-toggle="tab" data-bs-target="#Error-Handling-tab-pane" type="button" role="tab" aria-controls="Error-Handling-tab-pane" aria-selected="false">Error Handling</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="Params-tab-pane" role="tabpanel" aria-labelledby="Params-tab" tabindex="0">

                                <div class="params_div">

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <button type="button" onclick="Params_data()" class="btn mt-3 btn-outline-primary">ADD</button>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade p-3" id="Cookies-tab-pane" role="tabpanel" aria-labelledby="Cookies-tab" tabindex="0">
                                <div class="Cookies_div">

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <button type="button" onclick="Cookies_data()" class="btn mt-3 btn-outline-primary">ADD</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="Authorization-tab-pane" role="tabpanel" aria-labelledby="Authorization-tab" tabindex="0">
                                <div class="row">
                                    <div class="col">
                                        <label class="mb-2">Select Authorization Type</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="Headeers-tab-pane" role="tabpanel" aria-labelledby="Headeers-tab" tabindex="0">
                                <div class="Headeers_div">

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <button type="button" onclick="Headeers_data()" class="btn mt-3 btn-outline-primary">ADD</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade p-3" id="Error-Handling-tab-pane" role="tabpanel" aria-labelledby="Error-Handling-tab" tabindex="0">

                                <label class="mb-2">If your API returns an error or nothing Jump to</label>
                                <div class="row">
                                    <div class="col-4">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade active show d-block" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add order Items</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 order-items-body">
                </div>
                <div class="col-12 order-items-button my-3">
                    <button type="button" class="btn btn-primary add-order-items d-flex align-items-center">
                        <i class="fa-solid fa-plus px-2 "></i>
                        <p class="px-2">ADD</p>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


</div>



<?= $this->include('partials/footer') ?>


<script>
    function order_items_box() {
        var order_items_box = '<div class="col-12 border rounded-3 border p-2 order-item-box d-flex flex-wrap my-2"> <div class="col-3 p-1"> <label for="" class="form-label fs-12 fw-semibold ">Display Name <span class="text-danger">*</span></label> <input type="text" class="form-control" id="" placeholder="Display Name"> </div> <div class="col-2 p-1"> <label for="" class="form-label fs-12 fw-semibold ">Available Quantity</label> <input type="number" class="form-control" id="" placeholder="" value="0"> </div> <div class="col-3 p-1"> <label for="" class="form-label fs-12 fw-semibold ">Client Item Id</label> <input type="text" class="form-control" id="" placeholder="Item Id"> </div> <div class="col-4 p-1"> <div class="col-12 d-flex flex-wrap"> <label for="" class="form-label fs-12 fw-semibold col-10">Search Keywords</label> <div class="col-2 text-end"> <i class="fa-regular fa-trash-can delete-order-items"></i> </div> </div> <textarea class="form-control text-wrap" id="" rows="1" placeholder="Enter Keywords separated by comma"></textarea> </div> <div class="col-3 p-1"> <label for="" class="form-label fs-12 fw-semibold ">Currency <span class="text-danger">*</span></label> <select class="form-select" aria-label="Default select example"> <option selected>Open this select menu</option> <option value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </div> <div class="col-2 p-1"> <label for="" class="form-label fs-12 fw-semibold ">Price <span class="text-danger">*</span></label> <input type="number" class="form-control" id="" placeholder="" value="0"> </div> <div class="col-3 p-1"> <label for="" class="form-label fs-12 fw-semibold ">Image</label> <input class="form-control" type="file" id="formFile"> </div> <div class="col-4 p-1"> <label for="" class="form-label fs-12 fw-semibold ">Redirect URL</label> <input type="text" class="form-control" id="" placeholder="Redirect URL"> </div> </div>';
        $(".order-items-body").append(order_items_box);
    }

    order_items_box();

    $('body').on('click', '.add-order-items', function() {
        order_items_box();
    });

    $('body').on('click', '.delete-order-items', function() {
        $(this).closest('.order-item-box').remove();
    });
</script>
<script>
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
</script>


<!--Modal Jquery-->
<script>
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
                                            <input type="text" class="form-control" aria-describedby="" value="Authenticator" placeholder="Set Button Text">
                                        </div>
                                        <div class="col-5">
                                            <label for="" class="mb-2 mt-2">Link</label>
                                            <input type="text" class="form-control" aria-describedby="" value="Authenticator" placeholder="Set Button Text">
                                        </div>
                                        <div class="col-1 mt-3">
                                            <button type="button" id="updates_div_d" class="btn facebook_updates_d mt-4 btn-outline-danger">D</button>
                                        </div>
                                    </div>`;

        $(".updates_mandiv").append(html);
    }

    updates_mandiv();

    // $(".updates_divin").on("change", ".url_navigator_select", function() {

    //     let url_navigator_select = $(".url_navigator_select").val();

    //     console.log(url_navigator_select);

    // });

    function Params_data() {

        const html = `<div class="row Params_data mt-2 mb-2">
                        <div class="col-3">
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect">
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected >Open this</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this </option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-1">
                        <div class="col">
                               <button type="button" id="delete_btn_Params" class="btn btn-outline-danger">D</button>
                        </div>
                        </div>
                    </div>`;


        $(".params_div").append(html);
    }

    function Cookies_data() {

        const html = ` <div class="row Cookies_div_in mt-2 mb-2 d-flex align-items-center">
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect">
                                    </div>

                                    <div class="col-8 border rounded-2">
                                        <div class="form-check form-switch ps-0 d-flex flex-wrap align-items-center col-12 my-2 ">
                                            <input class="form-check-input ms-0 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1 send_params" type="checkbox" role="switch" id="send_params">
                                            <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1 send_params" for="send_params">Do not Send in Params</label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-1">
                                         <button type="button" id="Cookies_delete_btn" class="btn btn-outline-danger">D</button>
                                    </div>
                                </div>
                                `;

        $(".Cookies_div").append(html);
    }

    function Headeers_data() {

        const html = `<div class="row Headeers_div_in mt-2 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect">
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL Auto Redirect">
                                </div>
                                <div class="col-1">
                                  <button type="button" id="Headeers_delete_btn" class="btn btn-outline-danger">D</button>
                                </div>
                               
                            </div>
                                `;


        $(".Headeers_div").append(html);
    }

    Params_data();
    Cookies_data();
    Headeers_data();

    $('body').on('click', '#delete_btn_Params', function() {
        $(this).closest('.Params_data').remove();
    });

    $('body').on('click', '#Cookies_delete_btn', function() {
        $(this).closest('.Cookies_div_in').remove();
    });

    $('body').on('click', '#Headeers_delete_btn', function() {
        $(this).closest('.Headeers_div_in').remove();
    });

    $('body').on('click', '#updates_div_d', function() {
        $(this).closest('.updates_divin').remove();
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



        //Single Choile Table Row Add

        function table_html() {
            var main_table_html = '<tr class="d-flex flex-wrap col-12 w-100><td class="col-3"><input type="text" class="form-control row-option-value" id="" placeholder="" value="option1"></td><td class="col-3">    <select class="form-select" aria-label="Default select example">        <option value="1">Main-flow</option>    </select></td><td class="col-4">    <select class="form-select" aria-label="Default select example">        <option selected>No Jump</option>        <option value="1">One</option>        <option value="2">Two</option>        <option value="3">Three</option>    </select></td><td class="col-2"><button type="button" class="btn btn-danger remove-btn">D</button></td></tr>';
            $(".tbody").append(main_table_html);
        }

        table_html();

        $('body').on('click', '.single-choice-add-tabal', function() {

            var row_numbers = $('.single-choice-add-tabal').length++;

            table_html(row_numbers);

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

        function multiple_table_html() {
            var multiple_table_row = '<tr class="col-12"><td class="col-3"><input type="text" class="form-control multiple-row-option-value" id="" placeholder="" value="option' + option + '"></td><td class="col-2"><button type="button" class="btn btn-danger multiple-remove-btn">D</button></td></tr>';
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
            var form_table_row = '<tr class="col-12">   <td class="col">       <select class="form-select form-select-sm form-select-picker" aria-label="Default select example">           <option value="Question" selected>Question</option>           <option value="Dropdown">Dropdown</option>       </select>   </td>   <td class="col">       <input type="text" class="form-control form-control-sm fw-medium form-qa-text" id="" placeholder="Question Text" value=""> </td>  <td class="col">      <div class="form-check form-switch mx-2 form-required">         <input class="form-check-input " type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>     </div> </td>  <td class="col">      <input type="text" class="form-control form-control-sm fw-medium form-regex" id="" placeholder="Regex" value="">  </td>  <td class="col">       <div class="form-floating">          <textarea class="form-control fs-12 fw-medium form-detail" placeholder="Description form-detail" id=""></textarea>      </div>   </td>   <td class="col">       <button type="button" class="btn btn-danger form-remove-btn">D</button>   </td></tr>';
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
            var Corousel_table_row = '<tr class="col-12 "><td class="col"><input type="text" class="form-control form-control-sm fw-medium Corousel-qa-text" id="" placeholder="Question Text" value=""></td><td class="col"><select class="form-select form-select-sm Corousel-select-picker" aria-label="Default select example"><option value="Main_Flow" selected>Main Flow</option></select></td><td class="col"><select class="form-select form-select-sm Corousel-select-picker" aria-label="Default select example"><option value="" selected>No Jumpe</option><option value="">one</option><option value="">two</option><option value="">three</option></select></td><td class="col-2"><div class="col"><input class="form-control form-control-sm Corousel-file" type="file" id="formFile"></div></td><td class="col"><button type="button" class="btn btn-danger btn-sm Corousel-remove-btn">D</button></td></tr>';
            $(".Corousel-table-body").append(Corousel_table_row);
        }

        Corousel_table_row();

        $('body').on('click', '.Corousel-add-tabal', function() {
            Corousel_table_row();
        });

        $('body').on('click', '.Corousel-remove-btn', function() {
            $(this).closest('tr').hide();
        });

        $('body').on('change', '.Corousel-select-picker', function() {
            Corousel_value_change($(this).closest('tr'));
        });

        function Corousel_value_change(row) {

            var Corousel_value = row.find(".Corousel-select-picker").val();
            if (form_value == "Dropdown") {
                row.find('.form-regex').closest('td').children('input').attr('disabled', true);

            } else if (form_value == "Question") {
                row.find('.form-regex').closest('td').children('input').attr('disabled', false);
            }
        }


        //Corousel-1
        $('#Corousel-1').change(function() {
            if ($(this).prop('checked')) {
                $('.Corousel-1').text('Auto Slide');
                $('.corousel-sec-input').attr('class', 'd-block');
            } else {
                $('.Corousel-1').text('Do Not Auto Slide');
            }
        });


        //proudect 

        function proudect_table_row() {
            var proudect_table_row = '<div class="d-flex flex-wrap col-12 w-100 proudect-table-row"> <div class="proudect-table-1 col-12 w-100 "> <table class="table w-100 col-12 proudect-table-upper table-borderless"> <tbody class="proudect-table-upper-body"> <tr> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Type<span class="text-danger">*</span></label> <select class="form-select proudect-select-picker" aria-label="Default select example"> <option value="1">Image</option> <option value="2">Video</option> </select> </div> </div> </td> <td class="proudect-table-1 col"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Image URL <span class="text-danger">*</span></label> <input type="text" class="form-control" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Title<span class="text-danger">*</span></label> <input type="text" class="form-control" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center proudect-selecter"> <div class="col-12 proudect-image second-add"> <label for="" class="form-label fw-medium">Upload<span class="text-danger">*</span></label> <input class="form-control proudect-file" type="file" id="formFile"> </div> <div class="col-12 proudect-video second-remove"> <label for="" class="form-label fw-medium">URL<span class="text-danger">*</span></label> <input type="text" class="form-control" id="" placeholder="your URL"> </div> </div> </td> </tr> </tbody> </table> </div> <div class="proudect-table-1 col-12 w-100"> <table class="table w-100 col-12 table-borderless proudect-table-lower"> <tbody class="proudect-table-lower-body"> <tr> <td class="proudect-table-1 col-4"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Description</label> <input type="text" class="form-control" id="" placeholder="Description"> </div> </div> </div> </td> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Button Text<span class="text-danger">*</span></label> <input type="text" class="form-control" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium">Button Url <span class="text-danger">*</span></label> <input type="text" class="form-control" id="" placeholder="your URL"> </div> </div> </td> <td class="proudect-table-1 col-2"> <div class="col-12 d-flex flex-wrap align-items-center"> <div class="col-12"> <label for="" class="form-label fw-medium col-12">Remove</label> <button type="button" class="btn btn-danger proudect-remove-btn ">D</button> </div> </div> </td> </tr> </tbody> </table> </div> </div>';
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
            // proudect_value_change($(this).closest('td'));

            var proudect_value = $(this).closest('td').find(".proudect-select-picker").val();

            if (proudect_value == "2") {

                console.log($(this).closest('td').html());
                // $(this).closest('td').hide();


                $(this).closest('tr').find('.proudect-image').removeClass('second-add');
                $(this).closest('tr').find('.proudect-image').addClass('second-remove');
                $(this).closest('tr').find('.proudect-video').removeClass('second-remove');
                $(this).closest('tr').find('.proudect-video').addClass('second-add');
                // alert(proudect_value);


            } else if (proudect_value == "1") {

                console.log("jenish nhai");

                $(this).closest('tr').find('.proudect-video').removeClass('second-add');
                $(this).closest('tr').find('.proudect-video').addClass('second-remove');
                $(this).closest('tr').find('.proudect-image').removeClass('second-remove');
                $(this).closest('tr').find('.proudect-image').addClass('second-add');

            }

        });

        function proudect_value_change(row) {

            var proudect_value = row.find(".proudect-select-picker").val();
            alert(proudect_value);

            if (proudect_value == "2") {

                console.log("helllo");


                $('.proudect-image').removeClass('second-add');
                $('.proudect-image').addClass('second-remove');
                $('.proudect-video').removeClass('second-remove');
                $('.proudect-video').addClass('second-add');


            } else if (proudect_value == "1") {

                console.log("jenish nhai");

                $('.proudect-video').removeClass('second-add');
                $('.proudect-video').addClass('second-remove');
                $('.proudect-image').removeClass('second-remove');
                $('.proudect-image').addClass('second-add');

            }

        }



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
</script>