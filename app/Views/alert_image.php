<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<!-- ------------------------------------------- Start User page --------------------------------------------->
<div class="user-main">
    <div class="container-fluid">
        <div class="row row-main">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="user-icon d-flex align-items-center">
                    <i class="fi fi-rr-envelope mx-1"></i>
                    <p>Email Template</p>
                </div>
                <div class="user-list-btn">
                    <button id="deleteButton" class="btn-primary-rounded hide"><i class="fi fi-rr-trash"></i></button>
                    <span class="btn-primary-rounded elevation_add_button add-button" data-bs-toggle="modal" data-bs-target="#add-email" data-bs-dismiss="modal" data-delete_id="">
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
                    <table id="user_table" class="table table-striped dt-responsive nowrap user-tables table-background-color" style="width: 100%;">
                        <thead class="table-heading">
                            <tr class="main">
                                <th>
                                    <input class="mx-0" type="checkbox" id="select-all" />
                                </th>
                                <th>
                                    <span>Email Details</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="user_list">
                            <tr class="odd">
                                <td class="dtr-control sorting_1" tabindex="0">
                                    <input class="mx-3 checkbox cstm-check" type="checkbox" id="select-all" data-delete_id="6" />
                                </td>
                                <td class="edt" data-edit_id="6">
                                    <div class="px-0 py-0 w-100" data-bs-toggle="modal" data-bs-target="#edit-email">
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                            <div class="col">
                                                <b>1. TITLE</b>
                                                <span class="mx-1">raj hello world</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="dtr-control sorting_1" tabindex="0">
                                    <input class="mx-3 checkbox cstm-check" type="checkbox" id="select-all" data-delete_id="6" />
                                </td>
                                <td class="edt" data-edit_id="6">
                                    <div class="px-0 py-0 w-100" data-bs-toggle="modal" data-bs-target="#edit-email">
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                            <div class="col">
                                                <b>2. TITLE</b>
                                                <span class="mx-1">raj hello world</span>
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

<div class="modal fade" id="add-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Email</h1>
                <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-rr-cross-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-6 input-text">

                            <label for="form-Occupation" class="form-label investor">Add Title :</label>
                            <input type="text" class="form-control place" id="form-food" placeholder="Enter Email Title" />
                        </div>
                        <div class="col-6 input-text">
                            <label for="select_photo" class="form-label form-labell fs-14">Attachment :</label>
                            <input class="form-control form-controll place" id="select_photo" name="" type="file" placeholder="" />
                        </div>
                        <div class="col-12 input-text">
                            <label for="form-code" class="form-label fw-medium fs-14">Message :</label>

                            <textarea placeholder="" rows="3" id="" name="" class="dataTable-filter form-control inp_editor1"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-submit" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-submit" data-edit_id="1" name="calender-r_update1" value="calender-r_update1" data-bs-dismiss="modal">Add</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="edit-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Email</h1>
                <button type="button" class="modal-close-btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-rr-cross-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-6 input-text">
                            <label for="form-Occupation" class="form-label investor">Add Title :</label>
                            <input type="text" class="form-control place" id="form-food" placeholder="Enter Email Title" />
                        </div>
                        <div class="col-6 input-text">
                            <label for="select_photo" class="form-label form-labell fs-14">Attachment :</label>
                            <input class="form-control form-controll place" id="select_photo" name="" type="file" placeholder="" />
                        </div>
                        <div class="col-12 input-text">
                            <label for="form-code" class="form-label fw-medium fs-14">Message :</label>

                            <textarea placeholder="" rows="3" id="" name="" class="dataTable-filter form-control inp_editor1"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-submit" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-submit" data-edit_id="1" name="calender-r_update1" value="calender-r_update1" data-bs-dismiss="modal">Add</button>
            </div>
            
        </div>
    </div>
</div>

    <?= $this->include('partials/footer') ?>
    <?= $this->include('partials/vendor-scripts') ?>

    <script>
        $(document).ready(function () {
            $(".user-tables").DataTable();
            $(".dob").bootstrapMaterialDatePicker({
                minDate: new Date(),
                format: "DD/MM/YYYY",
                cancelText: "cancel",
                okText: "ok",
                clearText: "clear",
                time: false,
            });
            $("#deleteButton").hide();
            $(".user-table").on("click", 'input[type="checkbox"]', function () {
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

