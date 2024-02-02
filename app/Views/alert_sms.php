<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>


<!-- ------------------------------------------- Start User page --------------------------------------------->
<div class="user-main">
    <div class="container-fluid">
        <div class="row row-main">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="user-icon d-flex align-items-center">
                    <i class="fi fi-rr-ballot me-2"></i>
                    <p>SMS Automation Rules</p>
                </div>
                <div class="user-list-btn">
                    <button id="deleteButton" class="btn-primary-rounded hide">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                    <span class="btn-primary-rounded elevation_add_button add-button"
                        data-bs-toggle="modal" data-bs-target="#sms-add" data-bs-dismiss="modal" data-delete_id="">
                        <i class="fas fa-plus"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="user-table">
    <div class="container-fluid">
        <div class="user-color card card-menu">
            <div class="row row-table">
                <div class="col-xl-12">
                    <table id="user_table"
                        class="table table-striped dt-responsive nowrap  user-tables table-background-color"
                        style="width:100%">
                        <thead class="table-heading">
                            <tr class="main">
                                <th>
                                    <input class="mx-0" type="checkbox" id="select-all" />
                                </th>
                                <th>
                                    <span>User</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd">
                                <td class="t-check dtr-control sorting_1" tabindex="0">
                                    <input class="checkbox mx-3 mt-2 cstm-check" type="checkbox">
                                </td>
                                <td class="">
                                    <div class=" px-0 py-0 w-100" data-bs-toggle="modal"
                                        data-bs-target="#sms-edit">
                                        <div
                                            class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                            <div class="col">
                                                <b>1. Status :</b>
                                                <span class="mx-2">Processing</span>
                                            </div>

                                            <div class="col">
                                                <b>Label :</b>
                                                <span class="mx-2">Gmail</span>
                                            </div>
                                            <div class="col">
                                                <b>Template :</b>
                                                <span class="mx-2">gmail</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="t-check dtr-control sorting_1" tabindex="0">
                                    <input class="checkbox mx-3 mt-2 cstm-check" type="checkbox">
                                </td>
                                <td class="">
                                    <div class=" px-0 py-0 w-100" data-bs-toggle="modal"
                                        data-bs-target="#edit-sme-rule">
                                        <div
                                            class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                            <div class="col">
                                                <b>2. Status :</b>
                                                <span class="mx-2">Processing</span>
                                            </div>
                                            <div class="col">
                                                <b>Label :</b>
                                                <span class="mx-2">Gmail</span>
                                            </div>
                                            <div class="col">
                                                <b>Template :</b>
                                                <span class="mx-2">gmail</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- add modal -->
<div class="modal fade" id="sms-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 text-bold" id="exampleModalLabel">Add Invoice</h2>
                <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-12 ">
                            <form action="">
                                <div class="row mt-3">
                                    <div class=" col-6">
                                        <div class="input-type add-user-input my-2">
                                            <div class="dropdown bootstrap-select form-control">
                                            <label for="" class="form-label m-0">Status </label>
                                                <select class="selectpicker form-control form-main"
                                                    id="f_inquiry_status" name="f_inquiry_status"
                                                    data-live-search="true">
                                                    <option value="">select</option>
                                                    <option value="1">New</option>
                                                    <option value="2">Processing</option>
                                                    <option value="3">Close-by</option>
                                                    <option value="4">Confirm</option>
                                                    <option value="4">Cancel</option>
                                                </select>
                                                <div class="dropdown-menu " role="combobox">
                                                    <div class="bs-searchbox"><input type="text" class="form-control"
                                                            autocomplete="off" role="textbox" aria-label="Search">
                                                    </div>
                                                    <div class="inner show" role="listbox" aria-expanded="false"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <div class="input-type add-user-input my-2">
                                            <div class="dropdown bootstrap-select form-control">
                                            <label for="" class="form-label m-0">Label</label>
                                                <select class="selectpicker form-control form-main"
                                                    id="f_inquiry_status" name="f_inquiry_status"
                                                    data-live-search="true">
                                                    <option value="">select</option>
                                                    <option value="1">Text</option>
                                                    <option value="2">Voice</option>
                                                    <option value="3">Call</option>
                                                </select>
                                                <div class="dropdown-menu " role="combobox">
                                                    <div class="bs-searchbox"><input type="text" class="form-control"
                                                            autocomplete="off" role="textbox" aria-label="Search">
                                                    </div>
                                                    <div class="inner show" role="listbox" aria-expanded="false"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <div class="input-type add-user-input my-2">
                                            <div class="dropdown bootstrap-select form-control">
                                            <label for="" class="form-label m-0">Template </label>
                                                <select class="selectpicker form-control form-main"
                                                    id="f_inquiry_status" name="f_inquiry_status"
                                                    data-live-search="true">
                                                    <option value="">select</option>
                                                    <option value="1">Google</option>
                                                    <option value="2">Yahoo</option>
                                                    <option value="3">Edge</option>
                                                </select>
                                                <div class="dropdown-menu " role="combobox">
                                                    <div class="bs-searchbox"><input type="text" class="form-control"
                                                            autocomplete="off" role="textbox" aria-label="Search">
                                                    </div>
                                                    <div class="inner show" role="listbox" aria-expanded="false"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer2">
                <div class="col-lg-12 d-flex justify-content-end mt-2 pe-2 user-btn-view">
                    <input type="hidden" id="">
                    <button data-edit_id="" type="submit" class="btn-submit btn " name="add_new_user_btn"
                        id="add_new_user_btn"> submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit modal -->
<div class="modal fade" id="sms-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 text-bold" id="exampleModalLabel">Add Invoice</h2>
                <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-12 ">
                            <form action="">
                                <div class="row mt-3">
                                    <div class=" col-6">
                                        <div class="input-type add-user-input my-2">
                                            <div class="dropdown bootstrap-select form-control">
                                            <label for="" class="form-label m-0">Status </label>
                                                <select class="selectpicker form-control form-main"
                                                    id="f_inquiry_status" name="f_inquiry_status"
                                                    data-live-search="true">
                                                    <option value="">select</option>
                                                    <option value="1">New</option>
                                                    <option value="2">Processing</option>
                                                    <option value="3">Close-by</option>
                                                    <option value="4">Confirm</option>
                                                    <option value="4">Cancel</option>
                                                </select>
                                                <div class="dropdown-menu " role="combobox">
                                                    <div class="bs-searchbox"><input type="text" class="form-control"
                                                            autocomplete="off" role="textbox" aria-label="Search">
                                                    </div>
                                                    <div class="inner show" role="listbox" aria-expanded="false"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <div class="input-type add-user-input my-2">
                                            <div class="dropdown bootstrap-select form-control">
                                            <label for="" class="form-label m-0">Label</label>
                                                <select class="selectpicker form-control form-main"
                                                    id="f_inquiry_status" name="f_inquiry_status"
                                                    data-live-search="true">
                                                    <option value="">select</option>
                                                    <option value="1">Text</option>
                                                    <option value="2">Voice</option>
                                                    <option value="3">Call</option>
                                                </select>
                                                <div class="dropdown-menu " role="combobox">
                                                    <div class="bs-searchbox"><input type="text" class="form-control"
                                                            autocomplete="off" role="textbox" aria-label="Search">
                                                    </div>
                                                    <div class="inner show" role="listbox" aria-expanded="false"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <div class="input-type add-user-input my-2">
                                            <div class="dropdown bootstrap-select form-control">
                                            <label for="" class="form-label m-0">Template </label>
                                                <select class="selectpicker form-control form-main"
                                                    id="f_inquiry_status" name="f_inquiry_status"
                                                    data-live-search="true">
                                                    <option value="">select</option>
                                                    <option value="1">Google</option>
                                                    <option value="2">Yahoo</option>
                                                    <option value="3">Edge</option>
                                                </select>
                                                <div class="dropdown-menu " role="combobox">
                                                    <div class="bs-searchbox"><input type="text" class="form-control"
                                                            autocomplete="off" role="textbox" aria-label="Search">
                                                    </div>
                                                    <div class="inner show" role="listbox" aria-expanded="false"
                                                        tabindex="-1">
                                                        <ul class="dropdown-menu inner show"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer2">
                <span class="btn-primary-rounded  btn-sm edt" data-edit_id="2" data-bs-toggle="modal"
                    data-bs-target="#Adduser"><i class="fas fa-pencil-alt"></i></span>
                <a class="delete-tools me-0" href="javascript:void(0)">
                    <span class="delete"><i class="bi bi-trash3 me-2"></i>Delete</span>
                    <span class="really dlt" data-delete_id="2">Really ?</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>



<script>
    $(document).ready(function () {
        $('.user-tables').DataTable();
        $(".dob").bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'DD/MM/YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });
        $('#deleteButton').hide();
        $(".user-table").on('click', 'input[type="checkbox"]', function () {
            var deleteButton = $("#deleteButton");
            if ($(this).is(":checked")) {
                deleteButton.show();
            } else {
                deleteButton.hide();
            }
        });
        var selectAllItems = "#select-all";
        var checkboxItem = ".checkbox";

        $(selectAllItems).click(function () {

            if (this.checked) {
                $(checkboxItem).each(function () {
                    this.checked = true;
                });
            } else {
                $(checkboxItem).each(function () {
                    this.checked = false;
                });
            }

        });
    });
</script>