<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<style>
    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .ck-content .ck-placeholder {
        color: red;
    }

    .file-btn {
        border: 1px dashed var(--del-color) !important;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        border: 1px dashed #c3c3c3 !important;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .ck-editor__editable {
        min-height: 150px;
        max-height: 170px
    }

    .ck.ck-editor__editable>.ck-placeholder::before {
        color: #c6c6c6;
        font-family: Poppins;
    }

    .view-file-link {
        background-color: #724ebf21;
        color: #724ebf;
    }

    .btn_purple {
        border: 2px solid #724ebf;
        color: #724ebf;
    }

    .btn_purple:hover {
        background-color: #724ebf;
        color: white;
    }
</style>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Email Conversions</h2>
            </div>
        </div>
        <!-- WHATAPP EMAIL AND SMS BUTTTON NAV-BAR START ============================================================= -->
        <!-- <div class="p-2 bg-white rounded-2 mx-2 mb-2">
            <ul class="nav nav-pills navtab_primary_sm " id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn nav_btn active" id="customer_alert_tab" data-bs-toggle="pill"
                        data-bs-target="#customer_alert" data-table="emailtemplate" type="button" role="tab"
                        aria-controls="customer_alert" aria-selected="true">Email </button>
                </li>
            </ul> -->

        <!-- <div class="navigation col-12 overflow-auto my-2 product_tab">
                <ul class="d-flex navtab_primary_sm w-100 flex-xl-wrap flex-nowrap" id="status-main-tab">
                    
                            <li class="nav-item">
                                <button class="nav-link btn nav_btn active" id="customer_alert_tab" data-bs-toggle="pill"
                                data-bs-target="#customer_alert" data-table="emailtemplate" type="button" role="tab"
                                aria-controls="customer_alert" aria-selected="true">Email </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link btn nav_btn active" id="customer_alert_tab" data-bs-toggle="pill"
                                data-bs-target="#customer_alert" data-table="emailtemplate" type="button" role="tab"
                                aria-controls="customer_alert" aria-selected="true">Email Convertion</button>
                            </li>
                            
                            
                </ul>
            </div> -->
        <!-- </div> -->
        <!-- WHATAPP EMAIL AND SMS BUTTTON NAV-BAR START ============================================================= -->







        <div class="bg-white rounded-2 p-2 mb-2 border">
            <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link  active " id="inquiry_alert_tab" data-bs-toggle="pill" data-bs-target="#inquiry_alert_main" type="button" role="tab" aria-controls="inquiry_alert_main" aria-selected="false">Email Conversions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link    " id="user_alert_tab" data-bs-toggle="pill" data-bs-target="#user_alert_main" type="button" role="tab" aria-controls="user_alert_main" aria-selected="true">Email Templates</button>
                </li>
            </ul>
        </div>
        <div class="tab-content p-0 " id="pills-tabContent">
            <div class="tab-pane fade show active" id="inquiry_alert_main" role="tabpanel" aria-labelledby="inquiry_alert_tab" tabindex="0">
                <div class="">
                    <div class="bg-white rounded-2">

                        <div class="overflow-x-scroll border p-2">

                            <div class="title-2 mb-2">
                                <h2 style="background-color: #D8D7FF; font-size: 14px;" class="p-2 rounded-1"><b>Email Send List</b></h2>
                            </div>
                            <table id="myTable" class="table ">
                                <thead>

                                    <tr>
                                        <th width="25%">Email</th>
                                        <th width="40%">Subject</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Open Datetime</th>
                                        <th width="10%">See Details</th>
                                    </tr>
                                </thead>


                                <tbody id="demo_list_data">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade " id="user_alert_main" role="tabpanel" aria-labelledby="user_alert_tab" tabindex="0">
                <div class="tab-content p-0" id="pills-tabContentS">
                    <div class="tab-pane fade show active -whatapp" id="user_alert" role="tabpanel" aria-labelledby="user_alert_tab" tabindex="0">
                        <div class="container-fluid p-0 main-check-class">
                            <!-- <div class="p-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="title-1">
                                    <h2>Whatsapp Template</h2>
                                </div>
                                <div class="justify-content-end d-flex" data-delete_id="">
                                    <div class="deleted-all" data-delete_id="">
                                        <span class="btn-primary-rounded "><i class="bi bi-trash3 fs-14"></i></span>
                                    </div>
                                    <span class="btn-primary-rounded ms-2 changes_of_model changes_of_email_add cursor-pointer"
                                        data-bs-toggle="modal" data-bs-target="#add-email" data-delete_id="">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                </div>
                            </div>
                        </div> -->
                            <!-- <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
                            <table id="whatapp_table"
                                class="whatapp-tamplate comman_list_data_table table w-100 main-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input class="check_box select-all-sms" type="checkbox">
                                        </th>
                                        <th>
                                            <span class="">Whatsapp Details</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="whatapp_list" class="email_list_comman">
                                </tbody>
                            </table>
                        </div> -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="inquiry_alert" role="tabpanel" aria-labelledby="inquiry_alert_tab" tabindex="0">
                        <!-- <div class="container-fluid p-0 main-check-class">
                        <div class="p-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="title-1">
                                    <h2>SMS Template</h2>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="deleted-all delete_fafa_sms"
                                        style="display: none;">
                                        <span class="btn-primary-rounded">
                                            <i class="bi bi-trash3 fs-12"></i>
                                        </span>
                                    </div>
                                    <span class="btn-primary-rounded sms_plus_button ms-2" data-bs-toggle="modal" data-bs-target="#add-sms" data-bs-dismiss="modal" data-delete_id="">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
                            <table id="smstemplate_table"
                                class="email-tamplate comman_list_data_table w-100 table main-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input class="check_box select-all-sms sms_checkbox_query" type="checkbox"
                                                id="select-all-sms">
                                        </th>
                                        <th>
                                            <span class="">SMS Details</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="sms_sub_list" class="email_list_comman"></tbody>
                            </table>
                        </div>
                    </div> -->
                    </div>
                    <div class="" id="customer_alert" role="tabpanel" aria-labelledby="customer_alert_tab" tabindex="0">
                        <div class="container-fluid p-0 main-check-class">
                            <div class="p-2">
                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="d-flex justify-content-end">
                                        <div data-delete_id="" class="deleted-all emailDbtn" style="display: none;">
                                            <span class="btn-primary-rounded">
                                                <i class="bi bi-trash3 fs-14"></i>
                                            </span>
                                        </div>
                                        <span class="btn-primary-rounded changes_of_model changes_of_email_add ms-2" data-bs-toggle="modal" data-bs-target="#add-email" data-bs-dismiss="modal" data-delete_id="">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
                                <table id="email_table" class="email-tamplate comman_list_data_table w-100 table main-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input class="select-all-sms check_box emailQuery" type="checkbox" id="select-all-sms">
                                            </th>
                                            <th>
                                                <span class="">Email Details</span>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody id="email_list" class="email_list_comman"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="add-sms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add SMS</h1>
                <button type="button" class="btn-close close_btn close_btn_sms" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation smstemplate_form d-flex flex-wrap" name="smstemplate_form" novalidate>
                    <div class="input-text col-12 px-1">
                        <label for="form-Occupation" class="form-label main-label investor">Title <sup class="validationn">*</sup></label>
                        <input type="text" class="form-control main-control sms-title" id="title" placeholder="Enter Title" required="">
                    </div>

                    <div class="input-text mt-2 col-12">
                        <div class="d-flex justify-content-between align-items-end">
                            <label for="form-code" class="form-label main-label ">Template <sup class="validationn">*</sup></label>
                            <!-- <div class="col-md-6 col-12"> -->
                            <div class="dropdown">
                                <button class="btn-primary-rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <div class="dropdown-menu p-2 dropdown-menu-end" style="width: 300px;">
                                    <div class="main-selectpicker w-100">
                                        <select name="" id="action_name" id="bulk-action" class="selectpicker form-control form-main smstemplate_select_lable_div" data-live-search="true" required="">
                                            <option value="" class="select_sms">Select Lable</option>
                                            <option value="Enquirer Full Name" class="select_sms_diif">Enquirer Full
                                                Name
                                            </option>
                                            <option value="Enquirer Date of Birth" class="select_sms_diif">Enquirer
                                                Date of
                                                Birth</option>
                                            <option value="Enquirer Anniversary Date" class="select_sms_diif">
                                                Enquirer
                                                Anniversary Date</option>
                                            <option value="Enquirer Mobile Number" class="select_sms_diif">Enquirer
                                                Mobile
                                                Number</option>
                                            <option value="Enquirer Email" class="select_sms_diif">Enquirer Email
                                            </option>
                                            <option value="Enquirer Property Type" class="select_sms_diif">Enquirer
                                                Property
                                                Type</option>
                                            <option value="Staff Full Name" class="select_sms_diif">Staff Full
                                                Name
                                            </option>
                                            <option value="Staff Date of Birth" class="select_sms_diif">Staff
                                                Date of
                                                Birth</option>
                                            <option value="Staff Anniversary Date" class="select_sms_diif">
                                                Staff
                                                Anniversary Date</option>
                                            <option value="Staff Mobile Number" class="select_sms_diif">Staff
                                                Mobile
                                                Number</option>
                                            <option value="Customer Name" class="select_sms_diif">Customer Name
                                            </option>
                                            <option value="Customer Mobile Number" class="select_sms_diif">Customer
                                                Mobile
                                                Number</option>
                                            <option value="Customer Date of Birth" class="select_sms_diif">Customer
                                                Date of
                                                Birth</option>
                                            <option value="Customer Anniversary Date" class="select_sms_diif">
                                                Customer
                                                Anniversary Date</option>

                                            <option value="Supplier Full Name" class="select_sms_diif">Supplier Full
                                                Name
                                            </option>
                                            <option value="Supplier Date of Birth" class="select_sms_diif">Supplier
                                                Date of
                                                Birth</option>
                                            <option value="Supplier Anniversary Date" class="select_sms_diif">
                                                Supplier
                                                Anniversary Date</option>
                                            <option value="Supplier Mobile Number" class="select_sms_diif">Supplier
                                                Mobile
                                                Number</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="position-relative p-1">
                            <textarea id="template" placeholder="Enter Template" name="template" rows="4" cols="50" class="dataTable-filter form-control main-control sms-template" required="" maxlength="600"></textarea>
                            <div id="contant" class="position-absolute bottom-0 end-0 me-2 text-body-tertiary">160
                            </div>
                        </div>
                        <div class="input-text col-12 px-1">
                            <label for="form-Occupation" class="form-label main-label investor">Template Id <sup class="validationn">*</sup></label>
                            <input type="text" min="0" minlength="19" maxlength="19" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control main-control template_id" id="template_id" placeholder="Enter Template Id" name="template_id" required>
                            <p class="mt-2 text-danger">Note : The Template Id is Equal to 19 digit</p>
                        </div>
                        <div id="counter"></div>
                        <div id="count"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary smstemplate_add" data-edit_id="" id="smstemplate_add">submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sms_template_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">SMS Template</h1>
                <button type="button" class="btn-close close_btn close_btn_s" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" name="membership_update_form" novalidate>
                <div class="modal-body">
                    <div class="profile-main pb-2">
                        <h6>Title : <span class="fs-6 text-secondary-emphasis" id="title_view"></span></h6>
                    </div>
                    <div class="profile-main">
                        <h6>Template: <span class="fs-6 text-secondary-emphasis" id="temp_view"></span></h6>
                    </div>
                    <div class="profile-main pb-2">
                        <h6>Template ID: <span class="fs-6 text-secondary-emphasis" id="temp_id_view"></span></h6>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <span class="btn-primary edt sms_pencil_btn" data-edit_id="" data-bs-toggle="modal" data-bs-target="#add-sms"><i class="fas fa-pencil-alt"></i></span>
                <div class="delete_main changesofdelete_btn">
                    <div class="delete_btn_1 btn-primary w-100 text-center cursor-pointer" style="right: 0%;">Delete</div>
                    <div class="btn-secondary px-3 cursor-pointer dlt btn-del Comman_delete" id="sms_delete" data-delete_id="">Really ?</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade data_add_div" id="add-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title email_title_model_change">Add Email</h1>
                <button type="button" class="btn-close close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-secondery">
                <form class="needs-validation add_form_Email" id="add_form_Email" name="add_form_Email" novalidate>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="flex-fill  px-0 px-sm-1">
                            <h2 class="modal-body-title">Title<sup class="validationn">*</sup></h2>
                            <input type="text" class="form-control main-control email_whatapp_title add_model_title" id="title" name="title" placeholder="Enter Title" required=''>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between my-2">
                        <h2 class="modal-body-title">Template<sup class="validationn">*</sup></h2>
                        <div class="px-0 px-sm-1">
                            <div class="dropdown">
                                <button class="btn-primary-rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <div class="dropdown-menu p-2 dropdown-menu-end" style="width: 300px;">
                                    <div class="main-selectpicker">
                                        <select class="selectpicker form-control form-main template_select_lable_div" data-live-search="true" required="">
                                            <option value="" class="select_wne">Select Lable</option>
                                            <option value="Enquirer Full Name" class="select_wne_diff">Enquirer Full
                                                Name
                                            </option>
                                            <option value="Enquirer Date of Birth" class="select_wne_diff">Enquirer Date
                                                of
                                                Birth</option>
                                            <option value="Enquirer Anniversary Date" class="select_wne_diff">Enquirer
                                                Anniversary Date</option>
                                            <option value="Enquirer Mobile Number" class="select_wne_diff">Enquirer
                                                Mobile
                                                Number</option>
                                            <option value="Enquirer Email" class="select_wne_diff">Enquirer Email
                                            </option>
                                            <option value="Customer Name" class="select_wne_diff">Customer Name</option>
                                            <option value="Customer Mobile Number" class="select_wne_diff">Customer
                                                Mobile
                                                Number</option>
                                            <option value="Customer Date of Birth" class="select_wne_diff">Customer Date
                                                of
                                                Birth</option>
                                            <option value="Customer Anniversary Date" class="select_wne_diff">Customer
                                                Anniversary Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="editor_add" class="Email_Add_Ckeditor" style="border:1px solid red"></div>
                    <div class="col-12 input-text">
                        <h2 class="modal-body-title">Attachment</h2>
                        <div class="file_view_add1 file_view_add_Email  file_view_add_Email_add" id="file_view_add1">
                        </div>
                        <div class="file_view file_view_edit file_view_edit_add" id="file_view">
                        </div>
                        <div id="file_uploded" class="file_uploded file_uploded_edit file_uploded_edit_add"> </div>
                    </div>
                    <div class="upload-btn-wrapper col-12">
                        <div class="file-btn col-12">
                            <div class="col-12 justify-content-center d-flex">
                                <i class="bi bi-cloud-download"></i>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                                <h4>Drop Files here or click to upload</h4>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                                <p>Allowed IMAGES, VIDEOS, PDF, DOC, EXCEL, PPT, TEXT</p>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                                <p>Max 5 files and max size of 3 MB</p>
                            </div>
                        </div>
                        <input class="form-control main-control place attachment_email_text update_attachment_email" id="attachment" name="attachment[]" multiple type="file" placeholder="" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary email_add_model_submit" data-edit_id="" id="save_btn_email">submit</button>
                <div class="delete_main changesofdelete_btn">
                    <div class="delete_btn_1 btn-primary w-100 text-center cursor-pointer" style="right: 0%;">Delete</div>
                    <div class="btn-secondary px-3 cursor-pointer dlt Comman_delete" data-delete_id="" id="email_delete">Really ?</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <input type="text" hidden value="whatsapp_template" class="table_value_picker" id="table_value_picker"/> -->
<input type="text" hidden data-delete_id="" id="emailtemplate" />
<input type="text" hidden data-delete_id="" id="smstemplate" />
<input type="text" hidden data-delete_id="" id="whatsapp_template" />

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('.template_select_lable_div').on('change', function() {
        var selec_option = $(this).val();
        if (selec_option != "") {
            var selec_option_arr = "{{" + selec_option + "}}";
            var className = '.Email_Add_Ckeditor';
            if (editors[className]) {
                var editorContent = editors[className].getData();
                var newContent = editorContent + selec_option_arr;
                editors[className].setData(newContent);
                $('.select_wne').trigger('click');
            }
        }
    });
    $('body').on('click', '.select_sms_diif', function() {
        $('.select_wne').trigger('click');
    });


    $('.smstemplate_select_lable_div').on('change', function() {
        var selec_option = $(this).val();
        if (selec_option != "") {
            var selec_option_arr = "{{" + selec_option + "}}";
            $('.sms-template').val(function(index, currentValue) {
                return currentValue + ' ' + selec_option_arr;
                $('.select_sms').trigger('click');
            });
        }
    });

    $('body').on('click', '.select_sms_diif', function() {
        $('.select_sms').trigger('click');
    });
</script>
<!-- checkbox for sms/whatapp/email end =======================================================-->
<script>
    //<!-- SMS/WhatApp/Email Table Name Get Jquery Start =================================================================== -->
    const buttons = document.querySelectorAll(".nav-link");
    buttons.forEach(button => {
        button.addEventListener("click", function() {
            buttons.forEach(btn => {
                btn.classList.remove("active");
            });
            button.classList.add("active");
            if (button.id === "user_alert_tab") {
                var table_name = $(this).attr("data-table");
                $("#table_value_picker").val(table_name);
            } else if (button.id === "inquiry_alert_tab") {
                var table_name = $(this).attr("data-table");
                $("#table_value_picker").val(table_name);
            } else if (button.id === "customer_alert_tab") {
                var table_name = $(this).attr("data-table");
                $("#table_value_picker").val(table_name);
            }
        });
    });
    //<!-- SMS/WhatApp/Email Table Name Get Jquery End ===================================================================== -->

    // <!-- CK-Editor For WhatApp And Email Start =========================================================================== -->
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



    function checkEditorContent(editor) {
        const editorContent = editor.getData();
        const editorElement = editor.ui.getEditableElement();
        if (!editorContent.trim()) {
            editorElement.style.border = '1px solid red';
            editorElement.style.backgroundImage = `url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/></svg>")`;
            editorElement.style.backgroundPosition = 'bottom right';
            editorElement.style.backgroundRepeat = 'no-repeat';
            editorElement.style.backgroundSize = '20px 20px';
            editorElement.style.backgroundMargin = '10px';
        } else {
            editorElement.style.border = '1px solid #ccc';
            editorElement.style.backgroundImage = 'none';
        }
    }


    //<!-- CK-Editor For WhatApp And Email End ============================================================================= -->
    //<!-- SMS Template Model JQUERY Changes Start ========================================================================= -->
    $('body').on('click', '.sms_plus_button', function() {
        const $counter_contant = $('.smstemplate_add');
        $counter_contant.text(`ADD`);
        const $counter_contant1 = $('#exampleModalLabel');
        $counter_contant1.text(`Add SMS Template`);
        $(".smstemplate_form")[0].reset();
        $(".smstemplate_add").attr("data-edit_id", "");
        $('#contant').text("160");
        $('.smstemplate_select_lable_div').selectpicker('refresh');
    });
    $(document).ready(function() {
        const maxLength = 160;
        const maxLength2 = 1600;
        const $count = $('#count');
        const $smsTextarea = $('#template');
        const $counter = $('#counter');
        const $counter_contant = $('#contant');
        $smsTextarea.on('input', function() {
            const text = $smsTextarea.val();
            const textLength = text.length;
            let remainingChars = maxLength - (textLength % maxLength);
            let countchar = textLength;
            if (countchar == 0) {
                $counter_contant.text(`160`);
            } else if (countchar <= 160 && countchar >= 0) {
                $counter_contant.text(`${remainingChars}`);
            } else if (countchar >= 161 && countchar <= 320) {
                $counter_contant.text(`${remainingChars} (2)`);
            } else if (countchar >= 321 && countchar <= 480) {
                $counter_contant.text(`${remainingChars} (3)`);
            } else if (countchar >= 481 && countchar <= 640) {
                $counter_contant.text(`${remainingChars} (4)`);
            } else {
                $counter_contant.text(`Template is not add more contant`);
            }
            if (remainingChars === maxLength) {
                remainingChars = 0;
            }
        });
    });
    //<!-- SMS Template Model JQUERY Changes End =========================================================================== -->
    //<!-- Email/WhatApp Template Model JQUERY Changes Start =============================================================== -->
    $('body').on('click', '.changes_of_model', function() {
        setTimeout(function() {
            $('.template_select_lable_div').selectpicker('refresh');
        }, 100);
        var table = $(".table_value_picker").val();
        // if (table == "whatsapp_template") {
        //     const $counter_contant = $('.email_title_model_change');
        //     $counter_contant.text(`Add Whatsapp Template`);
        // } else {
        const $counter_contant = $('.email_title_model_change');
        $counter_contant.text(`Add Email Template`);
        // }
        $('.file_view_edit_add').hide();
        $('.file_uploded_edit_add').hide();
        $('.changesofdelete_btn').hide();
        $('.file_view_add_Email_add').show();
        $('.u_btn_Email').remove();
        $(".add_form_Email")[0].reset();
        $(".email_add_model_submit").attr("data-edit_id", "");
        const $counter_contant1 = $('.email_add_model_submit');
        $counter_contant1.text(`Submit`);
    });
    $('body').on('click', '.edit_email_t_changes_email', function() {
        setTimeout(function() {
            $('.template_select_lable_div').selectpicker('refresh');
        }, 500);
        var table = $(".table_value_picker").val();
        // if (table == "whatsapp_template") {
        //     const $counter_contant = $('.email_title_model_change');
        //     $counter_contant.text(`Edit Whatsapp Template`);
        // } else {
        const $counter_contant = $('.email_title_model_change');
        $counter_contant.text(`Edit Email Template`);
        // }
        $('.u_btn_Email').remove();
        $('.file_view_edit_add').show();
        $('.file_uploded_edit_add').show();
        $('.file_view_add_Email_add').hide();
        $('.changesofdelete_btn').show();
        const $counter_contant1 = $('.email_add_model_submit');
        $counter_contant1.text(`Update`);
    });
    //<!-- Email/WhatApp Template Model JQUERY Changes End ================================================================= -->

    //<!-- SMS Template AJAX Start ========================================================================================= -->
    $(document).ready(function() {
        // SMS INSERT/UPDATE Code Start =============================================>
        $('body').on('click', '#smstemplate_add', function(e) {
            var form = $("form[name='smstemplate_form']")[0];
            var title = $('.sms-title').val();
            var template = $('.sms-template').val();
            var template_id = $('.template_id').val();
            var edit_id = $('#smstemplate_add').attr("data-edit_id");
            if (title != "" && template != "" && template_id.length == 19) {
                var form = $('form[name="smstemplate_form"]')[0];
                const $counter_contant = $('#contant');
                var formdata = new FormData(form);
                formdata.append('table', 'smstemplate');
                formdata.append('title', title);
                formdata.append('action', 'insert');
                if (edit_id == '') {
                    $.ajax({
                        method: "post",
                        url: "<?= site_url('insert_data_t'); ?>",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            $counter_contant.text(`160`);
                            if (res != "error") {
                                // $("form[name='smstemplate_form']")[0].reset();
                                $(".modal-close-btn").trigger("click");
                                $("form[name='smstemplate_form']").removeClass("was-validated");
                                iziToast.success({
                                    title: 'Added Successfully'
                                });
                                $('.selectpicker').selectpicker('refresh');
                            } else {
                                $("form[name='smstemplate_form']")[0].reset();
                                iziToast.error1({
                                    title: 'Duplicate data'
                                });
                                $("form[name='smstemplate_form']").addClass("was-validated");
                            }
                            // $(".close_btn_sms").trigger("click");
                        },
                    });
                } else {
                    var formdata = new FormData(form);
                    formdata.append('action', 'update');
                    formdata.append('title', title);
                    formdata.append('edit_id', edit_id);
                    formdata.append('table', 'smstemplate');
                    $('.loader').hide();
                    $.ajax({
                        method: "post",
                        url: "<?= site_url('update_data_t'); ?>",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res != "error") {
                                $("form[name='smstemplate_form']")[0].reset();
                                $("form[name='smstemplate_form']").removeClass("was-validated");
                                $(".close_btn").trigger("click");
                                iziToast.success({
                                    title: 'update Successfully'
                                });
                            } else {
                                $("form[name='smstemplate_form']")[0].reset();
                                iziToast.error1({
                                    title: 'Duplicate data'
                                });
                            }
                            $(".close_btn_sms").trigger("click");
                        },
                    });
                }
            } else {
                $("form[name='smstemplate_form']").addClass("was-validated");
            }
        });
        // SMS INSERT/UPDATE Code End   =============================================>
        // SMS View Code Start   ====================================================>
        $('body').on('click', '.sms_template_view', function(e) {
            e.preventDefault();
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-view_id");
            var table = '<?php echo $table_username . '_smstemplate'; ?>';
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('sms_template_view'); ?>",
                    data: {
                        action: 'view',
                        view_id: edit_value,
                        table: table
                    },
                    success: function(res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        $('.edt').attr('data-edit_id', response[0].id);
                        $('.btn-del').attr('data-delete_id', response[0].id);
                        $('#sms_template_view #title_view').text(response[0].title);
                        $('#sms_template_view #temp_view').text(response[0].template);
                        $('#sms_template_view #temp_id_view').text(response[0].template_id);
                        $('.selectpicker').selectpicker('refresh');
                    },
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });
        // SMS View Code End   ======================================================>
        // SMS Edit Data Code Start   ===============================================>
        $("body").on('click', '.edit_sms_div', function(e) {
            e.preventDefault();
            //jquery change start ================>
            const $counter_contant = $('#smstemplate_add');
            $counter_contant.text(`UPDATE`);
            const $counter_contant1 = $('#exampleModalLabel');
            $counter_contant1.text(`Edit SMS Template`);
            $('#contant').text("");
            //jquery change end ==================>      
            var edit_value = $(this).attr("data_edit_id");
            if (edit_value != "") {
                $('.loader').hide();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('edit_data_t'); ?>",
                    data: {
                        action: 'edit',
                        edit_id: edit_value,
                        table: 'smstemplate'
                    },
                    success: function(res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        setTimeout(function() {
                            $(".sms-title").val(response[0].title);
                            $(".sms-template").val(response[0].template);
                            $('#smstemplate_add').attr('data-edit_id', response[0].id);
                            $(".template_id").val(response[0].template_id);
                            // $('#deleted-all').attr('data-delete_id', response[0].id);
                            $('.btn-del').attr('data-delete_id', response[0].id);
                            $('#smstemplate').attr('data-delete_id', response[0].id);
                            // $('.selectpicker').selectpicker('refresh');
                        }, 100);
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
        // SMS Edit Data Code End   =================================================>
    });
    //<!-- SMS Template AJAX End   ========================================================================================= -->
    //<!-- WhatApp/Email Template AJAX Start   ============================================================================= -->
    $(document).ready(function() {
        // Email/WhatApp JQUERY CHANGES Code Start   ========================================>
        $('.attachment_email_text').on('change', function() {
            var files = $(this).prop('files');
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;
                $('.file_view_add_Email').append('<div id="u_btn" class="col-12 u_btn_Email m-1 rounded view-file-link px-2 d-flex u_btn"><p>' + fileName + '</p><span class="ms-auto" id="file_crodd_btn_email"><i class="bi bi-x-circle"></i></span></div>')
            }
        });

        $('body').on('click', '#file_crodd_btn_email', function() {
            $(this).closest('div').remove();
        });

        $('body').on('click', '.changes_of_email_add', function() {
            var className = '.Email_Add_Ckeditor';
            if (editors[className]) {
                var editor = editors[className];
                editor.setData('');
                var editorElement = editor.ui.getEditableElement();
                editorElement.style.border = '1px solid #ccc';
                editorElement.style.backgroundImage = 'none';
            }
            $(".add_form_Email").removeClass("was-validated");
        });

        $("#image_Email").change(function() {
            for (i = 0; i < this.files.length; i++) {
                var file = this.files[i];
                var fileType = file.type;
                $("#file").val('');
            }
        });

        $('.update_attachment_email').on('change', function() {
            var files = $(this).prop('files');
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;
                $('.file_uploded_edit').append('<div id="u_btn" class="col-12 file_te m-1 rounded view-file-link px-2 d-flex u_btn"><p>' + fileName + '</p><span class="ms-auto" id="file_crodd_btn1"><i class="bi bi-x-circle"></i></span></div>')
            }
        });
        // Email/WhatApp JQUERY CHANGES Code End   ==========================================>

        // Email/WhatApp EDIT DATA Code Start   =============================================>
        $('body').on('click', '.edit_email_t', function() {
            var className = '.Email_Add_Ckeditor';
            if (editors[className]) {
                var editor = editors[className];
                var editorElement = editor.ui.getEditableElement();
                editorElement.style.border = '1px solid #ccc';
                editorElement.style.backgroundImage = 'none';
            }
            $(".add_form_Email").removeClass("was-validated");
            var edit_id = $(this).attr("data-edit_id");
            var table_name = $(this).attr("data_table");
            $('.controller_ubtn').remove();
            $('.file_te').remove();
            $.ajax({
                method: "POST",
                url: 'edit_data_t',
                data: {
                    edit_id: edit_id,
                    table: table_name,
                    action: 'edit'
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    var img_name = response[0].attachment;
                    var new_data = response[0].template;
                    if (editors[className]) {
                        editors[className].setData(new_data);
                    }
                    $("#image_Email").attr('src', img_name);
                    $("#image_Email").val(response[0].attachment);
                    $(".add_model_title").val(response[0].title);
                    $(".file_view_edit").html(response.file_html);
                    $('.email_add_model_submit').attr('data-edit_id', response[0].id);
                    $('#emailtemplate').attr('data-delete_id', response[0].id);
                    $('#whatsapp_template').attr('data-delete_id', response[0].id);
                }
            });
        });
        // Email/WhatApp EDIT DATA Code End     =============================================>

        // Email/WhatApp INSERT/UPDATE DATA Code Start   ====================================>
        $('body').on('click', '.email_add_model_submit', function(e) {
            e.preventDefault();
            var edit_id = $(this).attr("data-edit_id");
            if (edit_id == "") {
                var table = $(".table_value_picker").val();
                var form = $("form[name='add_form_Email']")[0];
                var formData = new FormData(form);
                var pText_add = "";
                var templateck = $('#add-email .ck-content').html();
                var editor = editors['.Email_Add_Ckeditor'];
                if (editor) {
                    var htmlContent = editor.getData();
                }
                $(".u_btn_Email p").each(function() {
                    pText_add += $(this).text().trim() + ",";
                });
                var title = $(".email_whatapp_title").val();
                pText_add = pText_add.slice(0, -1);
                if (title != "" && htmlContent != "") {
                    formData.append('table', 'emailtemplate');
                    formData.append('attachment', pText_add);
                    formData.append('template', htmlContent);
                    formData.append('action', 'insert');
                    $.ajax({
                        type: 'POST',
                        url: 'insert_data_t',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('.u_btn_Email').remove();
                            iziToast.success({
                                title: 'Successfully added'
                            });
                            $(".close_btn").trigger("click");
                        }
                    });
                } else {
                    checkEditorContent(editor);
                    editor.model.document.on('change:data', () => {
                        checkEditorContent(editor);
                    });
                    editor.ui.focusTracker.on('change:isFocused', (evt, name, isFocused) => {
                        if (!isFocused) {
                            checkEditorContent(editor);
                        }
                    });
                    $(".add_form_Email").addClass("was-validated");
                }
            } else {
                var pText = "";
                $(".file_view_edit_add p").each(function() {
                    pText += $(this).text().trim() + ",";
                });
                pText = pText.slice(0, -1);
                var pText_add = "";
                $(".file_uploded_edit_add p").each(function() {
                    pText_add += $(this).text().trim() + ",";
                });
                pText_add = pText_add.slice(0, -1);
                var update_id = $(this).attr("data-edit_id");
                var title = $('.add_model_title').val();
                var attachment = $('.update_attachment_email').val();
                var templateckk = $('#add-email .ck-content').html();
                var table = $(".table_value_picker").val();
                var editor = editors['.Email_Add_Ckeditor'];
                if (editor) {
                    var htmlContent = editor.getData();
                }
                var string = "";
                if (pText_add == "") {
                    string = pText;
                } else if (pText == "") {
                    string = pText_add;
                } else if (pText_add == "" && pText == "") {
                    string = "";
                } else {
                    string = pText_add + "," + pText;
                }
                if (title != "" && htmlContent != "") {
                    if (update_id != "") {
                        var form = $("#add_form_Email")[0];
                        var formdata = new FormData(form);
                        formdata.append('action', 'update');
                        formdata.append('edit_id', update_id);
                        formdata.append('title', title);
                        formdata.append('template', template);
                        formdata.append('attachment', string);
                        formdata.append('template', templateckk);
                        formdata.append('table', 'emailtemplate');
                        $.ajax({
                            method: "post",
                            url: "update_data_t",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                $('.u_btn').remove();
                                iziToast.success({
                                    title: 'Successfully Updated'
                                });
                                $(".close_btn").trigger("click");
                            }
                        });
                    }
                } else {
                    checkEditorContent(editor);
                    editor.model.document.on('change:data', () => {
                        checkEditorContent(editor);
                    });
                    editor.ui.focusTracker.on('change:isFocused', (evt, name, isFocused) => {
                        if (!isFocused) {
                            checkEditorContent(editor);
                        }
                    });
                    $(".add_form_Email").addClass("was-validated");
                }
            }
        });
        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
        $("#attachment").change(function() {
            for (i = 0; i < this.files.length; i++) {
                var file = this.files[i];
                var fileType = file.type;
                if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
                    $("#file").val('');
                    return false;
                }
            }
        });
        // Email/WhatApp INSERT/UPDATE DATA Code End   ======================================>
    });
    //<!-- WhatApp/Email Template AJAX End   =============================================================================== -->
    //<!-- WhatApp/Email/SMS listdata AJAX Start   ========================================================================= -->
    // function datatable_view_email(html) {
    //     $('.comman_list_data_table').DataTable().destroy();
    //     $('.email_list_comman').html(html);
    //     var table1 = $('.comman_list_data_table').DataTable({
    //         lengthChange: true,
    //     });
    // }
    function list_data_t() {
        $('.loader').show();
        show_val = '<?= json_encode(array('title', 'template')); ?>';
        var table = $(".table_value_picker").val();
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('template_list_data'); ?>",
            data: {
                'table': 'emailtemplate',
                'show_array': show_val,
                'action': true
            },
            success: function(res) {
                var response = JSON.parse(res);
                // datatable_view_email(response.html);
                $('#email_list').html(response.html);
                $('.loader').hide();
            }
        });
    }
    list_data_t();

    //listdata on click event start =========================>
    $('body').on("click", ".nav_btn", function() {
        $(".select-all-sms").prop("checked", false);
        list_data_t();
    });
    $('body').on("click", ".close_btn", function() {
        list_data_t();
    });
    //listdata on click event end ===========================>

    //<!-- WhatApp/Email/SMS listdata AJAX End   =========================================================================== -->
    //<!-- WhatApp/Email/SMS delete data(single record) AJAX start   ======================================================= -->
    $('body').on('click', '.Comman_delete', function() {
        var table = $("#table_value_picker").val();
        var id = $("#" + 'emailtemplate').attr("data-delete_id");
        $.ajax({
            method: "post",
            url: "<?= site_url('template_delete_data'); ?>",
            data: {
                action: 'delete',
                id: id,
                table: 'emailtemplate'
            },
            success: function(data) {
                $(".close_btn").trigger("click");
                iziToast.error({
                    title: 'Delete successfully'
                });
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    });
    //<!-- WhatApp/Email/SMS delete data(single record) AJAX end   ========================================================= -->  
    $('body').on('click', '.deleted-all', function() {
        var table = $("#table_value_picker").val();
        var checkbox = $(this).closest(".main-check-class").find('.table_list_check:checked');
        if (checkbox.length > 0) {
            var checkbox_value = [];
            $(checkbox).each(function() {
                checkbox_value.push($(this).attr("data-delete_id"));
            });

            if (checkbox.length > 0) {
                if (checkbox.length <= 1) {
                    record_text = "Do You really want to delete these records? You won't be able to revert this!";
                } else {
                    record_text = "Do You really want to delete those records? You won't be able to revert this!";
                }
                var checkbox_value = [];
                $(checkbox).each(function() {
                    checkbox_value.push($(this).attr("data-delete_id"));
                });
                Swal.fire({
                    title: 'Are you sure?',
                    text: record_text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#6e7881',
                    confirmButtonColor: '#dd3333',
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "<?= site_url('delete_all'); ?>",
                            method: "post",
                            data: {
                                action: 'delete',
                                checkbox_value: checkbox_value,
                                table: table,
                            },
                            success: function(data) {
                                $(checkbox).closest("tr").fadeOut();
                                iziToast.error({
                                    title: 'Delete Successfully'
                                });
                                $(".close_btn").trigger("click");
                            }
                        });
                    } else {
                        // $('.checkbox').prop('checked', false);
                        // $('#select-all-sms').prop('checked', false);
                        // $("#deleted-all").hide();
                    }
                });
            }
        } else {
            alert('Select atleast one records');
        }
    });
</script>

<!-- extra code start========================================================================================================= -->
<script>
    function email_send_list() {
        // $('.Lead_Quality_Report .loader').show();
        $.ajax({
            type: 'post',
            url: '<?= base_url('fetch_email_track_data') ?>',
            data: {

            },
            success: function(res) {
                var result = JSON.parse(res);
                $('.loader').hide();
                $('#demo_list_data').html(result.html);
            }
        });
    }
    email_send_list();

    var checkboxes = document.getElementsByClassName('');
    var selectedCountSpan = document.getElementById('chec_select');

    function updateSelectedCount() {
        var selectedCount = -1;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedCount++;
            }
        }
        selectedCountSpan.textContent = selectedCount;
    }
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', updateSelectedCount);
    }
    $(document).ready(function() {

    });
</script>
<!-- -----------------------------------------------------------sms js end------------------------------------------------------------------------------------- -->
<!-- -----------------------------------------------------------whatsapp js start------------------------------------------------------------------------------------- -->
<script>
    $('#attachment').on('change', function() {
        var files = $(this).prop('files');
        for (var i = 0; i < files.length; i++) {
            var fileName = files[i].name;
            $('.file_view_add').append('<div id="u_btn" class="col-12 m-1 rounded view-file-link px-2 d-flex u_btn"><p>' + fileName + '</p><span class="ms-auto" id="file_crodd_btn1"><i class="bi bi-x-circle"></i></span></div>')
        }
    });

    $('body').on('click', '#file_crodd_btn', function() {
        $(this).closest('div').remove();
    });

    $('body').on('click', '#file_crodd_btn1', function() {
        $(this).closest('div').remove();
    });
</script>