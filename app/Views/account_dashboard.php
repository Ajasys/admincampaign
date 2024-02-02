<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="main-dashbord p-2">
    <div class="container-fluid">
        <div class="bg-white shadow rounded-2 p-2">
            <div class="row m-0">
                <div class="col-xl-12 d-flex justify-content-between p-0">
                    <div class="user-icon d-flex align-items-center">
                        <i class="fa-solid fa-chart-pie me-2"></i>
                        <p>Account Dashbord</p>
                    </div>
                    <div class="user-list-btn">
                        <!-- <span id="deleted-all" class=" btn-primary-rounded elevation_add_button add-button"
                            style="display: none;">
                            <i class="bi bi-trash3"></i>
                        </span> -->
                        <span class="btn-primary-rounded add_voucher m-0">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="col-xl-3 input-type my-2" id="select_voucher">
                    <div class="d-flex">
                        <div class="dropdown bootstrap-select form-control">
                        <label for="form-category" class="form-label  ">select voucher Type :</label>
                            <select class="selectpicker form-control form-main" id="f_inquiry_status"
                                name="f_inquiry_status" data-live-search="true">
                                <option value="payment">Payment</option>
                                <option value="receipt">Receipt</option>
                                <option value="contra">Contra</option>
                                <option value="journal">Journal</option>
                                <option value="salse">Salse</option>
                                <option value="purches">Purches</option>
                            </select>
                            <div class="dropdown-menu " role="combobox">
                                <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
                                        role="textbox" aria-label="Search">
                                </div>
                                <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                    <ul class="dropdown-menu inner show"></ul>
                                </div>
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
<script>
    $("#select_voucher").hide();
    $(".add_voucher").click(function(){
        $("#select_voucher").slideToggle();
    });
</script>