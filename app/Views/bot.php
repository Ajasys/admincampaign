<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    .icon-box:hover {
        color: black !important;
    }

    .icon-box2:hover {
        color: darkred !important;
    }
    .modal-card{
        transition: all 0.5s;
    }
    .modal-card:hover{
        box-shadow: 0px 0px 10px #c5d1ff;
        transform: translateY(-5px);
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
        <div class="bg-white px-3 py-3 d-flex flex-wrap">
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


<div class="modal fade show d-block" id="bot_crate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bot Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center flex-wrap position-relative ">
                <div class="col-12">
                    <div class="col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card">
                        <div style="width:80px;height:80px;" class="border rounded-circle d-flex justify-content-center align-items-center">
                            <i class="bi bi-funnel fs-2"></i>
                        </div>
                        <div class="col px-3">
                            <p class="fs-6 text-dark fs-semibold">Lead Generation Bot <span class="text-muted fs-6">(or)</span>Any Data Collection Bot</p>
                        </div>
                    </div>
                    <div class="col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card">
                        <div style="width:80px;height:80px;" class="border rounded-circle d-flex justify-content-center align-items-center">
                            <i class="bi bi-headset fs-2"></i>
                        </div>
                        <div class="col px-3">
                            <p class="fs-6 text-dark fs-semibold">Lead Generation Bot <span class="text-muted fs-6">(or)</span>Any Data Collection Bot</p>
                        </div>
                    </div>
                </div>
                <div class="next-card">
                    <div class="col-12">
                        <div class="col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card">
                            <div style="width:80px;height:80px;" class="border rounded-circle d-flex justify-content-center align-items-center">
                                <i class="bi bi-funnel fs-2"></i>
                            </div>
                            <div class="col px-3">
                                <p class="fs-6 text-dark fs-semibold">Lead Generation Bot <span class="text-muted fs-6">(or)</span>Any Data Collection Bot</p>
                            </div>
                        </div>
                        <div class="col-11 p-3 d-flex flex-wrap align-items-center my-2 border rounded-3 modal-card">
                            <div style="width:80px;height:80px;" class="border rounded-circle d-flex justify-content-center align-items-center">
                                <i class="bi bi-headset fs-2"></i>
                            </div>
                            <div class="col px-3">
                                <p class="fs-6 text-dark fs-semibold">Lead Generation Bot <span class="text-muted fs-6">(or)</span>Any Data Collection Bot</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
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
    $('body').on('click','.modal-card',function(){
        $('.next-card').slideUp(3000);
        // alert('jklns');
    })
</script>