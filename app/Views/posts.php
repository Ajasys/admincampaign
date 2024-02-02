<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Posts</h2>
            </div>
            <div class="col-12 d-flex flex-wrap ">
                <div class="col-3 border rounded-3 bg-white p-3 d-flex flex-wrap flex-column justify-content-between" style="height:80vh">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                    <div class="col-12 my-2 text-center">
                        <div class="d-flex flex-wrap justify-content-center">
                            <img src="https://cdn.publer.io/on-board-social-accounts.png" alt="#">
                            <p class="px-3 text-center col-8 fs-5 my-3">Start by adding your social accounts</p>
                            <div class="col-12 my-2">
                                <button type="button" class="btn bg-transperent rounded-2 border"><i class="bi bi-plus-lg me-1"></i>Add Account</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 ">
                    <div class="col-12 d-flex flex-wrap mx-4"> 
                        <div class="col-3 px-2">
                        <input type="text" class="form-control"  aria-describedby="basic-addon2">

                        </div>
                        <div class="col-3 px-2">
                        <select  name="status" id="status" class="border selectpicker form-control main-control " data-live-search="true" required="" tabindex="-98">
                            <option value="">Scheduled</option>
                            <option value="1">Posted</option>
                            <option value="2">Failed</option>
                            <option value="3">Drafts</option>
                            <option value="4">Recycling</option>
                            <option value="5">Recurring</option>
                            </select> 
                        </div>
                        <div class="col-3 px-2">      
                            <select name="status" id="status" class="border selectpicker form-control main-control " data-live-search="true" required="" tabindex="-98">
                                <option value="">All</option>
                                <option value="1">Approved</option>
                                <option value="2">Pending Approval</option>
                                <option value="3">Declined</option>
                                <option value="4">Reauth Required</option>
                                <option value="5">Locked</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<?= $this->include('partials/footer') ?>
