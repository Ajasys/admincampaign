<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<style>
    textarea:focus{
        outline: none;
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
                <div class="col-2 border rounded-3 bg-white p-3 d-flex flex-wrap flex-column justify-content-between" style="height:80vh">
                    <div class="input-group mb-3 col-6">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                    </div>
                    <div class="col-12 my-2 text-center">
                        <div class="d-flex flex-wrap justify-content-center">
                            <img src="https://cdn.publer.io/on-board-social-accounts.png" alt="#">
                            <p class="px-3 text-center col-8 fs-5 my-3">Start by adding your social accounts</p>
                            <div class="col-12 my-2">
                            <a href="<?= base_url(); ?>add_account" class="btn bg-transperent rounded-2 border"><i class="bi bi-plus-lg me-1"></i>Add Account</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 border rounded-3 bg-white  mx-4 d-flex flex-wrap flex-column  justify-content-between ">
                    <div class="card-header border-bottom p-3">
                        <button class="border bg-transparent px-3 py-2 rounded-2 text-muted">Add lable</button>
                    </div>
                    <div class="card-body p-2">
                        <div class="col-12 border rounded mt-2 p-3">
                            <textarea  cols="30" rows="5" class="col-12 border-0" placeholder="Write something or use shortcodes, spintax..... "></textarea>
                            <button class="border-0 col-12 mt-4 rounded-pill px-4 py-2 fw-semibold text-muted " data-bs-toggle="modal" data-bs-target="#get_file" type="file" style="background:#F3F3F3;">
                                Click or Drag & Drop Media
    
                            </button>
                        </div>
                    </div>
                    <div class="card-footer border-top p-2 px-4 d-flex  align-content-center flex-wrap">
                        <div class="col-6">
                            <button class="bg-transparent border-0 text-muted">
                            <i class="fa-regular fa-clone me-2 "></i>Bulk Option
                            </button>
                        </div>
                        <div class="col-6 d-flex  flex-wrap justify-content-end ">
                            <button class="btn bg-transparent border text-muted mx-1">
                                Draft
                            </button>
                            <button class="btn bg-transparent border border-primary text-primary mx-1">
                                Publish
                            </button>
                            <button class="btn bg-transparent border text-info mx-1 border-info">
                                Scedual
                            </button>
                            <div class="btn-group dropup">
                                <button type="button" class="btn bg-transparent border rounded-3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-angle-up"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Action two</a></li>
                                    <li><a class="dropdown-item" href="#">Action three</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- modal-section-->
<div class="modal fade " id="get_file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                                </h5></div>      
                                
                            </div>
                            <input class="form-control main-control" id="attachment" name="attachment[]" multiple="" type="file" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-wrap ">
                <button class="btn btn-secondary btn-lg" type="button">
                    Large split
                </button>
            </div>
        </div>
    </div>
</div>




<?= $this->include('partials/footer') ?>
