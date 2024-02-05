<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<style>
    .fs-12 {
        font-size: 12px;
    }

    .bot-box {
        width: 100%;
        height: 85px;
        transition: all 0.3s ease-in-out;
        background-color: #f4f4f6;
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
                        <form class="needs-validation col-12 d-flex flex-wrap" name="add_form" method="POST" novalidate>
                            <div class="col-12 d-flex flex-wrap p-3">
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Question</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-circle-dot"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Single Choice</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Email</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-check-square" ng-class="i.icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Multiple Choice</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Mobile Number</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-hashtag"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Number</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Rating</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Date Picker</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-clock"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Time Picker</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Location</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Range</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-upload"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">File Upload</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-link"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Website</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-user-plus"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Ask Contacts</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Order Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Authenticator</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-brands fa-forumbee"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Form</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Carousel with buttons</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-bullseye"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Dynamic Question</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Real Time Search</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-calendar-check"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Appointment Booking</span>
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
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Statement</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-circle-dot"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">URL Navigator</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Product Carousel</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-check-square" ng-class="i.icon"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Carousel</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Audio</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-hashtag"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Show Contacts</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Show Location</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Show File</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-regular fa-clock"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">URL Auto Redirect</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">URL Based Flow</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Country Based Flow</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 p-2">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-upload"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="text-center">Action Based Flow</span>
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
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">FAQs</span>
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
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">AI Answering</span>
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
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Human Handover</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Live Chats Redirect to</span>
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
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Template's Based Flow</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">User's Initial Respone Based Flow</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Menu List</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Cart</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Buttons</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Catalog</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Address</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Ad Based Flow</span>
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
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Generic Template</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-2 question_add">
                                    <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap align-items-center justify-content-center">
                                        <div class="col-12 d-flex flex-wrap justify-content-center">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-center fs-12">
                                            <span class="first_question text-center" value="Question">Ice Breakers</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


                <div class="col-8 p-1 ">
                    <div class="main-task col-12 border rounded-3 bg-white overflow-y-scroll left-main-task ps-3 overflow-y-scroll " style="height:80vh" style="max-height:546.8px">
                        <div class="col-12 w-100 d-flex flex-wrap p-2">
                            <div class="col-12 d-flex flex-wrap my-2 p-2 border rounded-3 bot-flow-setup">
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
                        </div>


                        

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade data_add_div" id="add-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>




<?= $this->include('partials/footer') ?>

<Script>
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


    $('body').on('click', '.question_add', function(e) {
        e.preventDefault();
        // alert();
        var form = $("form[name='add_form']")[0];
        var type_of_question = $(".first_question").text();
        var formdata = new FormData(form);
        // console.log(type_of_question);
        if (type_of_question != "") {
            formdata.append('action', 'insert');
            formdata.append('table', 'admin_bot_setup');

            formdata.append('type_of_question', type_of_question);
            formdata.append('question', 'What is your full name?');

            $.ajax({
                method: "post",
                url: "<?= site_url('bot_insert_data'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data != "error") {
                        $("form[name='add_form']")[0].reset();
                        $("form[name='add_form']").removeClass("was-validated");
                        $(".btn-cancel").trigger("click");

                        iziToast.success({
                            title: 'Added Successfully'
                        });

                    } else {
                        $('.loader').hide();
                        $("form[name='add_form']")[0].reset();
                        $("form[name='add_form']").removeClass("was-validated");
                        iziToast.error({
                            title: 'Duplicate data'
                        });
                        $("form[name='add_form']").addClass("was-validated");
                    }
                },
            });
        } else {
            $("form[name='add_form']").addClass("was-validated");
        }
    });
</Script>