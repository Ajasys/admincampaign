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

    .icon{
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

    .media-upload-box{
        border: 2px dotted black;
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
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center " draggable="true" >
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

<!-- <div class="modal fade data_add_div" id="add-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title email_title_model_change">Edit Question</h1>
                <button type="button" class="btn-close close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-secondery">
                <form class="needs-validation add_form_Email" id="add_form_Email" name="add_form_Email" novalidate>


                    <div id="editor_add" class="Email_Add_Ckeditor" style="border:1px solid red"></div>

            </div>
            </form>
        </div>


    </div>
</div>
</div> -->

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
                            <div class="col-12 d-flex flex-wrap p-2">
                                <div class="col-12 my-3 d-flex flex-wrap px-3">
                                    <div class="form-check form-switch d-flex flex-wrap align-items-center">
                                        <input class="form-check-input px-3 fs-4 bg-success text-emphasis-success d-flex align-items-center pb-1" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <label class="form-check-label px-3 fw-medium d-flex align-items-center pt-1" for="flexSwitchCheckDefault">Do Not Remove Menu Message (For Whatsapp)</label>
                                    </div>
                                </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<?= $this->include('partials/footer') ?>

<script>
    //draggable jquery
    $(".bot-box").on("dragstart",function(){
        $('.droppable').css("outline","2px dotted black");
        $('.droppable').css("background-color","#d5d5d5");
    });

    $(".bot-box").on("dragend", function() {
        $('.droppable').css("outline","3px dotted transparent");
        $('.droppable').css("background-color","#f4f4f6");
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
            $('.form-check-label').text('Remove Menu Message (For WhatsApp)');
            } else {
            $('.form-check-label').text('Do Not Remove Menu Message (For WhatsApp)');
            }
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
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('bot_list_data'); ?>",
            data: {
                'table': table,
                'action': true
            },
            success: function (res) {
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
                success: function (data) {
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

    function handleQuestionClick(e) {
        e.preventDefault();
        var questionId = $(this).find('.span_text').attr('data-question_id'); 
        console.log(questionId); 
        var textOfQuestion = $(this).attr('data-qu');
        handleQuestionAdd(questionId, textOfQuestion);
    }
    $('body').on('click', '.question_add', handleQuestionClick);


    //duplicate question add
    $('body').on('click', '.duplicate_question_add', function() {
        var questionId = $(this).data('question');

        $.ajax({
            method: 'post',
            url: 'duplicate_Question',
            data: { questionId: questionId },
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