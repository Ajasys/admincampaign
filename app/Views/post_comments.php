<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<style>
    textarea:focus {
        outline: none;
    }

    li {
        cursor: pointer;
        padding: 10px;
        border-bottom: 2px solid transparent;
    }

    li.active {
        border-color: #724ebf;
    }
</style>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Create</h2>
            </div>
            <div class="col-12 d-flex flex-wrap ">
                <div class="col-3 p-2">
                    <div
                        class="col-12 border rounded-3 bg-white p-3 d-flex flex-wrap flex-column justify-content-between h-100">
                        <div class="input-group mb-3 col-6">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <div class="d-flex flex-wrap justify-content-center">
                                <img src="https://cdn.publer.io/on-board-social-accounts.png" alt="#">
                                <p class="px-3 text-center col-8 fs-5 my-3">Start by adding your social accounts</p>
                                <div class="col-12 my-2">
                                    <a href="<?= base_url(); ?>add_account"
                                        class="btn bg-transperent rounded-2 border"><i
                                            class="bi bi-plus-lg me-1"></i>Add Account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 p-2">
                    <div class="card-header col-12 border rounded-3 bg-white d-flex flex-column flex-wrap justify-content-between h-100">
                        <div class="col-12  border-bottom ">
                            <div class="border-bottom p-3 col-12">
                                <button class="border bg-transparent px-3 py-2 rounded-2 text-muted">Add label</button>
                            </div>
                            <div class="col-12">
                                <nav class="nav">
                                    <form class="needs-validation" id="create_form" name="create_form" method="POST"
                                        novalidate>
                                        <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                                            <li class="nav-item active" role="presentation">
                                                <a class="nav-link bg-white text-primary create-input-toggle"
                                                    id="pills-master-diet" data-bs-toggle="pill"
                                                    data-bs-target="#pills-master-diet-tab" href="#">Update</a>
                                            </li>
                                            <li class="nav-item " role="presentation">
                                                <a class="nav-link bg-white text-primary create-input-toggle"
                                                    id="pills-all-diet" data-bs-toggle="pill"
                                                    data-bs-target="#pills-master-diet-tab" href="#">Photo</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link bg-white text-primary" id="pills-all-event"
                                                    data-bs-toggle="pill" data-bs-target="#pills-master-diet-tab"
                                                    href="#">Event</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link bg-white text-primary" id="pills-all-offer"
                                                    data-bs-toggle="pill" data-bs-target="#pills-master-diet-tab"
                                                    href="#">Offer</a>
                                            </li>
                                        </ul>
                                </nav>
                                <div class="col-12">
                                    <div class="tab-content active show" id="pills-tabContent">
                                        <div class="tab-pane fade" id="pills-master-diet-tab" role="tabpanel"
                                            aria-labelledby="update-all-tab-modal" tabindex="0">
                                            <div class="col-12  tab-compo">
                                                <div class="card-body p-2">
                                                    <div id="event-input">
                                                        <div class="col-12 my-1 p-1">
                                                            <div class="col-12">
                                                                <input type="text" class="form-control p-2"
                                                                    id="event_title" placeholder="Title">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="col-6 my-1 p-1">
                                                                <div class="col-12">
                                                                    <input type="text"
                                                                        class="form-control p-2 offer_start_date"
                                                                        id="event_start_date" placeholder="Start Date">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 my-1 p-1">
                                                                <div class="col-12">
                                                                    <input type="text"
                                                                        class="form-control p-2 event_end_date"
                                                                        id="event_end" placeholder="End Date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 border rounded  p-3">
                                                        <textarea cols="30" rows="5"
                                                            class="col-12 border-0 event_address"
                                                            placeholder="Write something or use shortcodes, spintax..... "
                                                            id="event_address"></textarea>

                                                        <span
                                                            class="border-0 col-12 mt-4 d-inline-block rounded-3 text-center px-4 py-2 fw-semibold text-muted mb-4 "
                                                            data-bs-toggle="modal" data-bs-target="#get_file"
                                                            type="file" style="background:#bdbaba;;">Click or Drag &
                                                            Drop Media</span>
                                                        <div class="row col-12" id="offer-input">
                                                            <div class="col-md-4 my-1 ">
                                                                <input type="text" placeholder="Coupon code (optional)"
                                                                    class="form-control" id="coupon_event" value="">
                                                            </div>
                                                            <div
                                                                class="col-md-8 my-1 u-padding-left-md-0-isImportant u-margin-top-0-mobile-10 u-margin-top-sm-10">
                                                                <input type="text"
                                                                    placeholder="Link to redeem offer (optional)"
                                                                    class="form-control" value="" id="link_event">
                                                            </div>
                                                            <div class="col-md-12 my-1 u-margin-bottom-10 undefined">
                                                                <textarea rows="1"
                                                                    placeholder="Terms and conditions (optional)"
                                                                    class="form-control" id="terms_event"></textarea>
                                                            </div>
                                                        </div>
                                                        <div id="select-box">
                                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                                <div class="main-selectpicker">
                                                                    <select id="approx_buy" name="approx_buy"
                                                                        class="selectpicker form-control form-main"
                                                                        data-live-search="true" required>
                                                                        <i class="fa-solid fa-caret-down"></i>
                                                                        <option class="dropdown-item" value="">
                                                                            Unspecified</option>
                                                                        <option class="dropdown-item" value="2-3 days">
                                                                            Cover</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Profile</option>
                                                                        <option class="dropdown-item" value="week">Buy
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">Logo
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Exteriro</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Interior</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Product</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            At-Work</option>
                                                                        <option class="dropdown-item" value="week">Food
                                                                            ANd Drink</option>
                                                                        <option class="dropdown-item" value="week">Menu
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Comman Area</option>
                                                                        <option class="dropdown-item" value="week">Rooms
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Workspaces</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Additional</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="card-footer border-top p-2 px-4 d-flex  align-content-center flex-wrap">
                                            <div class="col-4">
                                                <button class="bg-transparent border-0 text-muted">
                                                    <i class="fa-regular fa-clone me-2 "></i>Bulk Option</button>
                                            </div>
                                            <div class="col-8 d-flex  flex-wrap justify-content-end ">
                                                <button class="btn btn-outline-secondary mx-1 draft_create"
                                                    id="draft_create">Draft</button>
                                                <button class="btn btn-primary mx-1">Publish</button>
                                                <button
                                                    class="btn btn-secondery mx-1 Scedual_start_date">Scedual</button>
                                                <div class="btn-group dropup btn-outline-dark mx-1">
                                                    <button type="button" class="btn btn-outline-dark rounded-3"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-angle-up"></i></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
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


<!-- modal-section-->
<div class="modal fade" id="get_file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 ">
                <div class="col-12 p-3">
                    <div class="col-12 border rounded-2 p-2 my-2">
                        <div class="upload-btn-wrapper col-12">
                            <div class="file-btn col-12  p-3">
                                <div class="col-12 justify-content-center d-flex">
                                    <i class="bi bi-images"></i>
                                </div>
                                <div class="col-12 justify-content-center d-flex">
                                    <h5>Drag &amp; drop or select a file<p></p>
                                    </h5>
                                </div>

                            </div>
                            <input class="form-control main-control #coupon_event attachment" id="attachment"
                                name="attachment[]" multiple="" type="file" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>


    $('#event_end').bootstrapMaterialDatePicker({
        format: 'DD-MM-YYYY h:m A',
        cancelText: 'cancel',
        okText: 'ok',
        clearText: 'clear',
        time: true,
        date: true,
    });
    $('#event_start_date').bootstrapMaterialDatePicker({
        format: 'DD-MM-YYYY h:m A',
        cancelText: 'cancel',
        okText: 'ok',
        clearText: 'clear',
        time: true,
        date: true,
    }).on('change', function (e, date) {
        var startDate = moment(date, 'DD-MM-YYYY ');
        var endDate = startDate.clone().add(7, 'days');
        $('#event_end').val(endDate.format('DD-MM-YYYY h:m A'));
    });


    $('.nav-item').click(function () {
        $('.nav-item').removeClass('active');
        $(this).addClass('active');
    });


    $(".draft_create").click(function (e) {
        //  alert("dfe");
        e.preventDefault();
        var form = $("form[name='create_form']")[0];
        var event_title = $('#event_title').val();
        var event_start_date = $('#event_start_date').val();
        var event_end = $('#event_end').val();
        var event_address = $('.event_address').val();
        var attachment = $('.attachment').prop('files')[0];
        var coupon_event = $('#coupon_event').val();
        var link_event = $('#link_event').val();
        var terms_event = $('#terms_event').val();

        // var email = $('#email').val();

        var formdata = new FormData(form);
        // var edit_id = $('#reminder_btn_add').attr("data-edit_id");
        // console.log(event_address);
        // die();
        if (event_title != "" || event_address != "") {
            var form = $('form[name="create_form"]')[0];
            // console.log(form);
            var formdata = new FormData(form);
            formdata.append('event_title', event_title);
            formdata.append('event_start_date', event_start_date);
            formdata.append('event_end', event_end);
            formdata.append('event_address', event_address);
            formdata.append('attachment', attachment);
            formdata.append('coupon_event', coupon_event);
            formdata.append('link_event', link_event);
            formdata.append('terms_event', terms_event);
            formdata.append('table', 'create_post');
            formdata.append('action', 'create_insert_data');
            // console.log(event_address);
            // die();
            // if (edit_id == '') {
            // console.log(edit_id);
            // die();
            $.ajax({
                method: "post",
                url: "<?= site_url('create_insert_data'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res != "error") {
                        list_data();
                        $("form[name='create_form']")[0].reset();
                        $(".modal-close-btn").trigger("click");
                        $("form[name='create_form']").removeClass("was-validated");
                        iziToast.success({
                            title: 'Draft Successfully'
                        });
                        $('.selectpicker').selectpicker('refresh');
                    } else {
                        //alert("this");
                        $("form[name='create_form']")[0].reset();
                        iziToast.error1({
                            title: 'Duplicate data'
                        });
                        $("form[name='create_form']").addClass("was-validated");
                    }
                    // list_data();
                },
            });
        }
        //     } else {
        //         var formdata = new FormData(form);
        //         // console.log(formdata);
        //         formdata.append('action', 'update');
        //         formdata.append('table', 'reminders_details');
        //         formdata.append('date', date);
        //         formdata.append('time', time);
        //         formdata.append('week', week);
        //         formdata.append('user', user);
        //         formdata.append('message', message);
        //         formdata.append('email', email);
        //         formdata.append('whatsapp', whatsapp);
        //         formdata.append('type', type);
        //         formdata.append('edit_id', edit_id);

        //         // console.log(edit_id);
        //         // die();
        //         $('.loader').hide();
        //         $.ajax({
        //             method: "post",
        //             url: "<?= site_url('dataupdate_data'); ?>",
        //             data: formdata,
        //             processData: false,
        //             contentType: false,
        //             success: function (res) {
        //                 if (res != "error") {
        //                     $("form[name='create_form']")[0].reset();
        //                     $("form[name='create_form']").removeClass("was-validated");
        //                     $(".btn-cancel").trigger("click");
        //                     iziToast.success({
        //                         title: 'update Successfully'
        //                     });

        //                     list_data();
        //                     $('.selectpicker').selectpicker('refresh');
        //                 }
        //                 else {
        //                     // alert("hello");
        //                     $("form[name='create_form']")[0].reset();
        //                     iziToast.error1({
        //                         title: 'Duplicate data'
        //                     });
        //                 }
        //             },
        //         });
        //     }
        // } else {
        //     $("form[name='create_form']").addClass("was-validated");
        // }


    });


    //---------------------------- modal input ----------------------------

    $("#pills-master-diet").click(function () {
        $(".card-body").show();
        $("#select-box").hide();
        $("#event-input").hide();
        $("#offer-input").hide();

    });
    $("#pills-master-diet").trigger("click");

    //photo
    $("#pills-all-diet").click(function () {
        $("#select-box").show();
        $("#event-input").hide();
        $("#offer-input").hide();

    });

    //event
    $("#pills-all-event").click(function () {
        $("#event-input").show();
        $("#offer-input").hide();
        $("#select-box").show();
    });
    //offer
    $("#pills-all-offer").click(function () {
        $("#offer-input").show();
        $("#select-box").hide();
    });
</script>


<?= $this->include('partials/footer') ?>