<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>


<div class="main-dashbord p-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="col-xl-12 d-flex justify-content-between">
                    <div class="user-icon d-flex align-items-center">
                        <i class="fi fi-rr-chart-network me-2"></i>
                        <p>Configuration</p>
                    </div>
                    <div class="user-list-btn">
                        <span class="btn-primary-rounded elevation_add_button add-button"
                            data-bs-toggle="modal" data-bs-target="#Adduser" data-bs-dismiss="modal" data-delete_id="">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="p-2 bg-white shadow rounded-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Membership Expiry Days</label>
                                <input type="number" class="form-control" id="" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Membership Overdue Days</label>
                                <input type="number" class="form-control" id="" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Pending Balance Reminder Days</label>
                                <input type="number" class="form-control" id="" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Pending Balance Overdue Reminder Days</label>
                                <input type="number" class="form-control" id="" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Store Pending Balance Upcoming Reminder Days</label>
                                <input type="number" class="form-control" id="" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Store Pending Balance Overdue Reminder Days</label>
                                <input type="number" class="form-control" id="" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Member Birthday Days</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Member Anniversary Days</label>
                                <input type="number" class="form-control" id="" placeholder="0">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Member Birthday Days</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Member Anniversary Days</label>
                                <input type="number" class="form-control" id="" placeholder="0">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">member Record Search Limit</label>
                                <input type="number" class="form-control" id="" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Member Absent Days Limit</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Member Referral Points</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Contact Number Visibility Digits</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Registration Fees</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Members Absent Days</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard Member Reminder Days</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Dashboard General Reminder Days</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Center name</label>
                                <input type="number" class="form-control" id="" placeholder="1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">invoice Terms And Conditions</label>
                                <textarea class="form-control" id="" rows="2" placeholder></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>