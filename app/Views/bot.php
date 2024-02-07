<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
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
</style>

<div class="main-dashbord p-2 main-check-class">
    <div class="container-fluid p-0 mb-3">
        <div class="bg-white px-3 py-1">
            <div class="d-flex justify-content-between align-items-center flex-wrap w-100">
                <div class="title-1">
                    <i class="fa-brands fa-bots fs-1"></i>
                </div>
                <div class="title-side-icons">
                    <button class="btn-primary-rounded add" type="button" data-bs-toggle="modal"
                        data-bs-target="#bot_crate" aria-controls="bot_crate">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="bot_list bg-white px-3 py-3 d-flex flex-wrap">
            <!-- card start -->
            <div class="col-3 p-2">
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
            </div>
            <!-- card end -->
        </div>
    </div>

</div>


<div class="modal fade " id="bot_crate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="first_bot">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bot Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center flex-wrap position-relative ">
                <div class="col-12">
                    <div class="w-100 col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card"
                        data-toggle="modal" data-bs-dismiss="modal" data-target="#bot_name_model" data-bot_type="1">
                        <div style="width:50px;height:50px;"
                            class="border rounded-circle d-flex justify-content-center align-items-center">
                            <i class="bi bi-funnel fs-2"></i>
                        </div>
                        <div class="col px-3">
                            <p class="fs-6 text-dark fs-semibold">Get Lead By Chat Bots</p>
                        </div>
                    </div>
                    <div class="w-100 col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card"
                        data-toggle="modal" data-bs-dismiss="modal" data-target="#bot_name_model" data-bot_type="2">
                        <div style="width:50px;height:50px;"
                            class="border rounded-circle d-flex justify-content-center align-items-center">
                            <i class="bi bi-headset fs-2"></i>
                        </div>
                        <div class="col px-3">
                            <p class="fs-6 text-dark fs-semibold">Clint Supoort Bot</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-----------------------botfirstmodal--------------------------->

<div class="modal fade firstmodal" id="bot_name_model" tabindex="-1" role="dialog" aria-labelledby="botfirstmodal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="botfirstmodal">Create New Bot</h5>
                <button type="button" class="close border-none " data-dismiss="modal" aria-label="Close"
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
</div>




<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    // $('.next-card').slideUp();


    //-------------------modal-card---------
    // $('.modal-card').click(function () {
    //     //  $('#first_bot').slideUp(1000);
    //     // $('#first_bot').hide();
    //     // $(".firstmodal").attr("id", "bot_name").slideDown();

    // });

    $('.modal-header .close ').click(function () {
        $('#first_bot').modal('show').slideDown(1000);
    });

    $('body').on('click', '.modal-card', function () {
        $('.next-card').slideUp(300);
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
            beforeSend: function (f) {
                $('.loader').show();
            },
            success: function (res) {
                $('.loader').hide();
                if (res != '') {
                    $('.bot_list').html(res);

                }
            },
        });
    }

    list_data();

    $('body').on('click', '.bot_create_btn', function (e) {
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
                beforeSend: function (f) {
                    $('.loader').show();
                },
                success: function (res) {
                    $('.loader').hide();
                    list_data();
                    $('#bot_name_model').modal('hide');
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

</script>