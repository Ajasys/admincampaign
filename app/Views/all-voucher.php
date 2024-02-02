<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="user-main">
    <div class="container-fluid">
        <div class="row row-main">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="user-icon d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <p>Voucher</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="user-table">
    <div class="container-fluid">
        <div class="user-color card card-menu">
            <div class="row row-table">
                <div class="col-12 d-flex justify-content-end">
                    <div class="col-lg-2 col-md-4 col-sm-6 pe-2">
                        <div class="input-type my-2">
                            <div class="d-flex">
                                <div class="dropdown bootstrap-select form-control w-100">
                                    <select class="selectpicker form-control form-main" id="f_inquiry_status"
                                        name="f_inquiry_status" data-live-search="true">
                                        <option value="">Inquiry Status</option>
                                        <option value="1">Fresh</option>
                                        <option value="2">Contacted</option>
                                        <option value="3">Demo Appo</option>
                                        <option value="4">Demo</option>
                                        <option value="6">Negotiations</option>
                                        <option value="7">Dismissed</option>
                                     
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 ">
                        <div class="input-type my-2">
                            <input type="text" placeholder="DD/MM/YY" class="form-control" name="f_mobileno"
                                id="v-date">
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 mt-3">
                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="border th-sm">Vch No
                                </th>
                                <th class="border">Date
                                </th>
                                <th class="border w-75">Particulars
                                </th>
                                <th class="border th-sm">Vch Type
                                </th>
                                <th class="border th-sm">Debit
                                </th>
                                <th class="border th-sm">Credit
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2011/04/25</td>
                                <td>Chintan</td>
                                <td>Contra</td>
                                <td>₹15461</td>
                                <td>₹15461</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2011/04/25</td>
                                <td>Chintan</td>
                                <td>Contra</td>
                                <td>₹15461</td>
                                <td>₹15461</td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th></th>
                                <th>30922</th>
                                <th>30922</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>


<script>
    $('#v-date').bootstrapMaterialDatePicker({
        minDate: new Date(),
        format: 'DD-MM-YYYY h:mm A',
        cancelText: 'cancel',
        okText: 'ok',
        clearText: 'clear',
    });
</script>