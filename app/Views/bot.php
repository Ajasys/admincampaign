<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    body {
        background-color: whitesmoke;
    }

    .icon-box {
        color: red !important;
    }

    .icon-box:hover {
        color: black !important;
    }

    .icon-box2:hover {
        color: darkred !important;
    }

    .modal-card {
        transition: all 0.5s;
    }

    .modal-card:hover {
        box-shadow: 0px 0px 10px #c5d1ff;
        transform: translateY(-5px);
    }

    .modal-header .close {
        border: none;
        background: white;
        font-size: 20px;
    }

    .card-border-color {
        border-color: #FAFAFA;
    }
</style>

<div class="main-dashbord p-2">
    <div class="p-1">
        <!-- <div class="container-fluid p-0 mb-3">
            <div class="px-3 py-1">
                <div class="d-flex justify-content-between align-items-center flex-wrap w-100">
                    <div class="title-1">
                        <i class="fa-brands fa-bots fs-1"></i>
                    </div>
                    <div class="title-side-icons">
                        <button class="btn-primary-rounded add" type="button" data-bs-toggle="modal" data-bs-target="#bot_crate" aria-controls="bot_crate">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="container-fluid p-4">

            <div class="col-12 bg-white px-3 p-2 d-flex flex-wrap rounded-4 shadow align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-2 d-flex flex-wrapalign-items-center">
                    <div class="col-3 d-flex justify-content-start align-items-center">
                        <div class="title-1">
                            <i class="fa-brands fa-bots fs-1"></i>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-2 d-flex flex-wrap align-items-center">
                    <div class="row col-12">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 d-flex align-items-center ps-0 pe-0">
                            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7 col-12 input-group">
                                <input type="text" class="form-control main-control" placeholder="Search">
                                <button class="btn btn-secondery main-control bg-white" type="button" id="button-addon2">Q</button>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8 col-lg-4 col-xl-4 col-xxl-4 col-8 ps-0 pe-0 d-flex justify-content-start align-items-center">
                            <div class="ms-sm-0 ms-md-0 ms-lg-3 ms-xl-3 ms-xxl-3 col-12 p-0 mt-sm-2 mt-md-2 mt-lg-0 mt-xl-0 mt-xxl-0 mt-2">
                                <div class="main-selectpicker">
                                    <select id="product_type" name="product_type" class="selectpicker form-control form-main main-control product_type" data-live-search="true" required="" tabindex="-98">
                                        <option class="dropdown-item" selected>Open this select</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-2 col-xl-2 col-xxl-2 col-4 d-flex align-items-center justify-content-end">
                            <button class="btn-primary-rounded add" type="button" data-bs-toggle="modal" data-bs-target="#bot_crate" aria-controls="bot_crate">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="bot_list bg-white-50 d-flex flex-wrap">
                <!-- card start -->
                <!--new card-->

                <div class="col-12 d-flex flex-wrap justify-content-center justify-content-xl-start justify-content-xxl-start">
                    <div class="card mb-3 rounded-4 m-3 shadow bot-card" style="width: 310px;">
                        <div class="row g-0">
                            <div class="d-flex align-items-center">
                                <div class="col-md-4 my-3 text-center bot-name-tab">
                                    <div class="p-2 my-3">
                                        <img src="<?= base_url('') ?>assets/images/bot_img/bot-1.png" class="img-fluid rounded-start mb-1" width="40px">
                                        <p class="card-text mt-2"><small class="text-body-secondary fs-6 fw-bold">Bot Name</small></p>
                                    </div>
                                </div>
                                <div class="border h-100"></div>
                                <div class="col-md-8 my-2 px-2 bot-data-tab">
                                    <div class="card-body d-flex flex-wrap py-1 px-1 my-2">
                                        <div class="border border-1 rounded-3 d-inline w-auto p-2 ms-1 me-1 ps-2 icon-box text-muted" data-toggle="tooltip" data-placement="top" title="Setup">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-screwdriver-wrench fa-lg"></i>
                                            </a>
                                        </div>
                                        <div class="border rounded-3 d-inline w-auto p-2 ms-1 me-1 ps-2 icon-box text-muted" data-toggle="tooltip" data-placement="top" title="Trigger">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-bell fa-lg"></i>
                                            </a>
                                        </div>
                                        <div class="border rounded-3 d-inline w-auto p-2 ms-1 me-1 ps-2 icon-box text-muted" data-toggle="tooltip" data-placement="top" title="Bot Chats">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-comment fa-lg"></i>
                                            </a>
                                        </div>
                                        <div class="border rounded-3 shadow-sm bg-body-tertiary d-inline w-auto p-2 ms-1 me-1 ps-2 icon-box text-muted" data-toggle="tooltip" data-placement="top" title="Setting">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-gear fa-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-wrap py-1 px-1 justify-content-between align-items-center mt-4">
                                        <div class="form-check form-switch ps-0 d-flex align-items-center">
                                            <label class="switch_toggle_primary">
                                                <input class="toggle-checkbox" type="checkbox" id="">
                                                <span class="check_input_primary round"></span>
                                            </label>
                                            <p class="mx-2 fw-medium">Active</p>
                                        </div>
                                        <div class="border rounded d-inline w-auto p-1 px-2 icon-box2 text-muted" data-toggle="tooltip" data-placement="top" data-bs-placement="right" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--new card end-->
                <!-- <div class="col-3 p-2">
                    <div class="card mb-3">
                        <div class="row g-0 p-2">
                            <div class="d-flex align-items-center">
                                <div class="col-md-4 text-center">
                                    <div class="p-2">
                                        <img src="<?= base_url('') ?>assets/images/bot_img/bot-1.png"
                                            class="img-fluid rounded-start mb-1" width="30px">
                                        <p class="card-text"><small class="text-body-secondary">Bot Name</small></p>
                                    </div>
                                </div>
                                <div class="border h-100"></div>
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-wrap py-1 px-2 justify-content-between">
                                        <div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
                                            data-toggle="tooltip" data-placement="top" title="Setup">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                            </a>
                                        </div>
                                        <div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
                                            data-toggle="tooltip" data-placement="top" title="Trigger">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-bell"></i>
                                            </a>
                                        </div>
                                        <div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
                                            data-toggle="tooltip" data-placement="top" title="Bot Chats">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-comment"></i>
                                            </a>
                                        </div>
                                        <div class="border rounded d-inline w-auto p-1 px-2 icon-box text-muted"
                                            data-toggle="tooltip" data-placement="top" title="Setting">
                                            <a href="#" class="text-muted">
                                                <i class="fa-solid fa-gear"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div
                                        class="card-body d-flex flex-wrap py-1 px-2 justify-content-between align-items-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                                checked>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                        <div class="border rounded d-inline w-auto p-1 px-2 icon-box2 text-muted"
                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- card end -->
            </div>
        </div>
    </div>



</div>


<div class="modal fade " id="bot_crate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bot_type_modal" id="first_bot">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bot Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center flex-wrap position-relative ">
                <div class="col-12">
                    <div class="w-100 col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card" data-bot_type="1">
                        <div style="width:50px;height:50px;" class="border rounded-circle d-flex justify-content-center align-items-center">
                            <i class="bi bi-funnel fs-2"></i>
                        </div>
                        <div class="col px-3">
                            <p class="fs-6 text-dark fs-semibold">Get Lead By Chat Bots</p>
                        </div>
                    </div>
                    <div class="w-100 col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card" data-bot_type="2">
                        <div style="width:50px;height:50px;" class="border rounded-circle d-flex justify-content-center align-items-center">
                            <i class="bi bi-headset fs-2"></i>
                        </div>
                        <div class="col px-3">
                            <p class="fs-6 text-dark fs-semibold">Clint Supoort Bot</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-content bot_name_modal">
            <div class="modal-header">
                <h5 class="modal-title" id="botfirstmodal">Create New Bot</h5>
                <button type="button" class="close border-none close-modal" data-dismiss="modal" aria-label="Close" data-bs-toggle="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <label for="botNameInput" class="form-label">Bot Name :</label>
                <input type="text" id="bot_name" name="bot_name" class="form-control m-auto" placeholder="name for your bot">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary m-auto bot_create_btn" data-bot_type="0">Create</button>
            </div>
        </div>
    </div>
</div>



<!-----------------------botfirstmodal--------------------------->

<!-- <div class="modal fade firstmodal" id="bot_name_model" tabindex="-1" role="dialog" aria-labelledby="botfirstmodal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="botfirstmodal">Create New Bot</h5>
                <button type="button" class="close border-none close-modal" data-dismiss="modal" aria-label="Close"
                    data-bs-toggle="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <label for="botNameInput" class="form-label">Bot Name :</label>
                <input type="text" id="bot_name" name="bot_name" class="form-control m-auto"
                    placeholder="name for your bot">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary m-auto bot_create_btn" data-bot_type="0">Create</button>
            </div>
        </div>
    </div>
</div> -->




<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>


<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    // $('.next-card').slideUp();


    //-------------------modal-card---------
    // $('.modal-card').click(function () {
    //     //  $('#first_bot').slideUp(1000);
    //     // $('#first_bot').hide();
    //     // $(".firstmodal").attr("id", "bot_name").slideDown();

    // });

    // $('.modal-header .close').click(function () {
    //     $('#first_bot').modal('show').slideDown(1000);
    // });

    $('.add').on('click', function() {
        $('.bot_name_modal').hide();
        $('.bot_type_modal').show();
    });
    $('.bot_name_modal').hide();
    $('body').on('click', '.modal-card', function() {
        $('.bot_type_modal').slideUp(300);
        $('.bot_type_modal').hide();
        $('.bot_name_modal').slideDown(600);
        var bot_type = $(this).attr('data-bot_type');
        $('.bot_create_btn').attr('data-bot_type', bot_type);
    });

    function list_data() {
        $.ajax({
            method: "post",
            url: "<?= site_url('main_bot_list_data'); ?>",
            data: {
                'table': '<?= getMasterUsername2() ?>_bot',
            },
            beforeSend: function(f) {
                $('.loader').show();
            },
            success: function(res) {
                $('.loader').hide();
                if (res != '') {
                    $('.bot_list').html(res);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            },
        });
    }

    list_data();

    $('body').on('click', '.bot_create_btn', function(e) {
        e.preventDefault();
        var bot_type = $(this).attr('data-bot_type');
        var bot_name = $('#bot_name').val();

        if (bot_type != '' && bot_name != '') {
            $.ajax({
                method: "post",
                url: "<?= site_url('bot_insert_data'); ?>",
                data: {
                    'bot_type': bot_type,
                    'name': bot_name,
                    'action': 'bot_insert',
                    'table': '<?= getMasterUsername2() ?>_bot',
                },
                beforeSend: function(f) {
                    $('.loader').show();
                },
                success: function(res) {
                    $('.loader').hide();
                    list_data();
                    $('#bot_name_model').modal('hide');
                    $('#bot_crate').modal('hide');
                    // $('#bot_name_model .close-modal').trigger('click');
                    iziToast.success({
                        title: 'Bot Created Successfully!',
                    });
                },
            });
        } else {
            iziToast.error({
                title: 'Bot Name or Bot Type is not Found!',
            });
        }
    });

    $('body').on('click', '.bot_delete', function() {
        var delete_id = $(this).data('delete_id');
        var record_text = "Are you sure you want to delete this Bot?";
        var table = '<?php echo getMasterUsername2(); ?>_bot';
        Swal.fire({
            title: 'Delete Bot?',
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
                        id: delete_id,
                        table: table,
                        bot: '',
                    },
                    success: function(data) {
                        iziToast.error({
                            title: 'Deleted Successfully'
                        });
                        // $(".close_btn").trigger("click");
                        list_data();
                    }
                });
            }
        });

    });

    $('body').on('change', '.bot_active', function() {
        var update_id = $(this).data('update_id');
        if ($(this).is(':checked')) {
            var status = 1;
            var massage = 'Bot activated!';
        } else {
            var status = 0;
            var massage = 'Now Bot is inactivate';
        }

        if (update_id != '') {
            var table = '<?php echo getMasterUsername2(); ?>_bot';
            var second_table = '<?php echo getMasterUsername2(); ?>_bot_setup';
            $.ajax({
                method: "post",
                url: "<?= site_url('bot_update'); ?>",
                data: {
                    action: 'update',
                    type: 'activation',
                    id: update_id,
                    table: table,
                    active: status,
                    second_table: second_table,
                },
                success: function(data) {
                    if (data == 'empty') {
                        iziToast.error({
                            title: 'Please add bot setup first for this bot!',
                        });

                        setTimeout(function() {
                            window.location.href = "<?= base_url(); ?>bot_setup?bot_id=" + update_id;
                        }, 2000);
                    } else {
                        iziToast.success({
                            title: massage,
                        });
                    }
                    list_data();
                }
            });
        }
    });
</script>