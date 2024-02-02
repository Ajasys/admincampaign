<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>


<!-- ------------------------------------------- Start User page --------------------------------------------->
<div class="user-main">
    <div class="container-fluid">
        <div class="row row-main">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="user-icon d-flex align-items-center">
                    <i class="fi fi-rr-template me-2"></i>
                    <p>Whatsapp Template</p>
                </div>
                <div class="user-list-btn">
                    <button id="deleteButton" class="btn-primary-rounded hide">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                    <span class="btn-primary-rounded elevation_add_button add-button"
                        data-bs-toggle="modal" data-bs-target="#w-add" data-bs-dismiss="modal" data-delete_id="">
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
                                    <div class=" px-0 py-0 w-100" data-bs-toggle="modal" data-bs-target="#w-edit">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <b>1. Title :</b>
                                                <span class="mx-2"> raj hello world.</span>
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
                                        data-bs-target="#w-edit">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <b>2. Title :</b>
                                                <span class="mx-2"> raj hello world.</span>
                                            </div>
                                            <!-- <div class="col">
                                                        <b></b>
                                                        <span class="mx-2"></span>
                                                    </div> -->
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
<!-- add user popup  -->


<!-- add modal -->
<div class="modal fade" id="w-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 text-bold" id="exampleModalLabel">Add Whatsapp</h2>
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
                                    <div class=" col-12">
                                        <div class=" add-user-input my-2">
                                            <div class="add-user-input">
                                                <label for="">Add Title<sup class="validationn">*</sup></label>
                                                <input type="text" minlength="10" maxlength="10"
                                                    class="form-control number_value_only" id="phone" name="phone"
                                                    placeholder="Add Title :" value="" data-phone_id="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 add-user-input ">
                                        <label for="">Template<sup class="validationn">*</sup></label>
                                        <textarea name="" placeholder="Enter Message"
                                            class="rounded-1 mat_textarea w-100 p-2" style="" id="" cols="30"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="col-12 add-user-input">
                                        <label for="select_photo"
                                            class="form-label form-labell fs-14">Attachment</label>
                                        <input class="form-control form-controll place" id="select_photo" name=""
                                            type="file" placeholder="">
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
                    <button data-edit_id="" type="submit" class="btn-submit btn" name="add_new_user_btn"
                        id="add_new_user_btn"> submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit modal -->

<div class="modal fade" id="w-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 text-bold" id="exampleModalLabel">Edit Whatsapp</h2>
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
                                    <div class=" col-12">
                                        <div class=" add-user-input my-2">
                                            <div class="add-user-input">
                                                <label for="">Add Title<sup class="validationn">*</sup></label>
                                                <input type="text" minlength="10" maxlength="10"
                                                    class="form-control number_value_only" id="phone" name="phone"
                                                    placeholder="Add Title :" value="" data-phone_id="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 add-user-input ">
                                        <label for="">Template<sup class="validationn">*</sup></label>
                                        <textarea name="" placeholder="Enter Message"
                                            class="rounded-1 mat_textarea w-100 p-2" style="" id="" cols="30"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="col-12 add-user-input">
                                        <label for="select_photo"
                                            class="form-label form-labell fs-14">Attachment</label>
                                        <input class="form-control form-controll place" id="select_photo" name=""
                                            type="file" placeholder="">
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
<!-- edit modal -->

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