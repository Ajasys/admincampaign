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
        height: 70px;
        transition: all 0.3s ease-in-out;
    }

    .bot-box:hover {
        box-shadow: 0 0 5px 2px #0000004d;
    }

    .bot-flow-setup {
        background-color: gainsboro;
        transition: all 0.5s ease-in-out;
    }

    .bot-flow-setup:hover {
        box-shadow: 0 0 5px 2px #0000004d;
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
                <div class="col-3 border rounded-3 bg-white p-3 " style="height:80vh">
                    <div class="col-12 d-flex justify-content-between my-3">
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
                    <div class="col-12 d-flex flex-wrap m-3">
                        <div class="col-3 p-2">
                            <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap justify-content-center question_add">
                                <div class="col-12 d-flex flex-wrap justify-content-center">
                                    <i class="fa fa-question"></i>
                                </div>
                                <div class="col-12 d-flex flex-wrap justify-content-center">
                                    <span>Question</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 p-2">
                            <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap justify-content-center">
                                <div class="col-12 d-flex flex-wrap justify-content-center">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <div class="col-12 d-flex flex-wrap justify-content-center">
                                    <span>Number</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 p-2">
                            <div class="col-12 bot-box p-2 border rounded-3 d-flex flex-wrap justify-content-center">
                                <div class="col-12 d-flex flex-wrap justify-content-center">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="col-12 d-flex flex-wrap justify-content-center">
                                    <span>Email</span>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


                <div class="col-8 border rounded-3 bg-white p-3 mx-4 " style="height:80vh">
                    <div class="main-task left-main-task mt-2 ps-3 overflow-y-scroll " style="max-height:546.8px">
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


    $('body').on('click', '.question_add', function() {
        // alert();
        $.ajax({
            method: "post",
            url: "<?= site_url('insert_data'); ?>",
            table: "admin_messeging_bot",
            // data: formdata,
            processData: false,
            contentType: false,

            success: function(res) {
                iziToast.success({
                    title: 'Added Successfully'
                });
                $('.selectpicker').selectpicker('refresh');
            },
        });
    });
</Script>