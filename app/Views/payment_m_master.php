<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>


<style>
    .p-img img {
        width: unset !important;
    }
</style>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1 d-flex align-items-center">
                    <i class="fi fi-rr-hands-usd me-2"></i>
                    <h2>Payment Mathod Master</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <button id="deleted-all" class="btn-primary-roundedelevation_add_button add-button"
                        style="display: none;">
                        <i class="bi bi-trash3"></i>
                    </button>
                    <button class="btn-primary-rounded elevation_add_button add-button" data-bs-toggle="modal"
                        data-bs-target="#payment-mode" data-bs-dismiss="modal" data-delete_id="">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <ul>
                <li>
                    <div class="col p-img m-2 ">
                        <img src="https://admin.realtosmart.com/assets/images/phonepay.png" alt="Paytm">
                        <span class="mx-2">phonepay</span>
                    </div>
                </li>
                <li>
                    <div class="col p-img m-2">
                        <img src="https://admin.realtosmart.com/assets/images/cash.png" alt="Paytm">
                        <span class="mx-2">Cash</span>
                    </div>
                </li>
                <li>
                    <div class="col p-img m-2">
                        <img src="https://admin.realtosmart.com/assets/images/paytm.png" alt="Paytm">
                        <span class="mx-2">Paytm</span>
                    </div>
                </li>
                <li>
                    <div class="col p-img m-2">
                        <img src="https://admin.realtosmart.com/assets/images/gpay.png" alt="Paytm">
                        <span class="mx-2">Googlepay</span>
                    </div>
                </li>
                <li>
                    <div class="col p-img m-2">
                        <img src="https://admin.realtosmart.com/assets/images/card.png" alt="Paytm">
                        <span class="mx-2">Card</span>
                    </div>
                </li>
                <li>
                    <div class="col p-img m-2">
                        <img src="https://admin.realtosmart.com/assets/images/neft.png" alt="Paytm">
                        <span class="mx-2">NEFT</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="payment-mode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add Payment Mode</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" name="payment_mode_add_form" novalidate="">
                    <div class="row">
                        <div class="col-12 mb-4 mb-md-0 input-text">
                            <label class="main-label">Payment mode name* </label>
                            <input type="text" class="form-control main-control place" id="paymentModeName" placeholder="Bank Transfer" required="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-primary" id="payment_add_btn" data-edit_id="1" name="exercise_update"
                    value="exercise_update">Add</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    $(document).ready(function () {
        $('.payment-master').DataTable(
            "searching": false;
        );
    });
</script>

<script>
    $(document).ready(function () {
        $("#deleted-all").hide();
        $("body").on('change', '#select-all', function () {
            var deleteButton = $("#deleted-all");
            if ($(this).is(":checked")) {
                // deleteButton.removeClass("hide");
                deleteButton.show();
            } else {
                // deleteButton.addClass("hide");
                deleteButton.hide();
            }
            checkIfAnyCheckboxChecked();
        });
        function checkIfAnyCheckboxChecked() {
            if ($('.checkbox:checked').length > 0) {
                // alert();
                $("#deleted-all").show();
            } else {
                // alert();
                $("#deleted-all").hide();
            }
        }

        $('body').on('change', '.checkbox', function () {
            // alert();
            var deleteButton = $("#deleted-all");
            // if($(this).is(":checked")){
            checkIfAnyCheckboxChecked();
        });
        checkIfAnyCheckboxChecked();
    });
</script>