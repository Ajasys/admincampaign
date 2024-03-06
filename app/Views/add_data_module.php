<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<?php
$username = session_username($_SESSION['username']);
$db_connection = DatabaseDefaultConnection();
$query = $db_connection->table($username . '_all_inquiry')->get();
if ($query->getNumRows() > 0) {
    $columnNames = $query->getFieldNames();
} else {
    $columnNames = array();
}

if($db_connection->tableExists($this->username . '_Data')) {
    $query_data = $db_connection->table($this->username . '_Data')->get();
    if ($query_data->getNumRows() > 0) {
        $columnNames_data = $query->getFieldNames();
    } else {
        $columnNames_data = array();
    }

    $columnNames = array_merge($columnNames, $columnNames_data);
}
// pre($columnNames);
?>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center my-2 flex-wrap w-100">
            <div class="title-1">
                <i class="fa-solid fa-database"></i>
                <h2>Data Handling</h2>
            </div>
            <div class="title-side-icons">
                <button class="btn-primary add" type="button" data-bs-toggle="modal" data-bs-target="#import_csv"
                    aria-controls="import_csv">
                    Import File
                </button>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mt-2 col-lg-6 col-12">
            <div class="d-flex justify-content-between align-items-center my-2 flex-wrap w-100">
                <div class="title-1">
                    <i class="fa-solid fa-table-columns"></i>
                    <h2>File Column Handling</h2>
                </div>
                <div class="title-side-icons column-btn">
                    <!-- <button class="btn-primary add" type="button" data-bs-toggle="modal" data-bs-target="#column_add" aria-controls="column_add">
                        + Add Column
                    </button> -->
                </div>
            </div>
            <form name="column_data_form" id="column_data_form" class="needs-validation" method="POST" novalidate="">
                <div class="mt-3 file_columns">
                    <div class="text-center">
                        <span class="fs-6">File Not Imported</span>
                    </div>
                    <!-- <div class="col-12 d-flex">
                        <div class="bulk-action select col-lg-6 col-12 px-1 mt-lg-0 mb-1">
                            <input type="text" class="form-control main-control" id="import_file" name="import_file" placeholder="Details" required="">
                        </div>
                        <div class="bulk-action select col-lg-6 col-12 px-1 mt-lg-0 mb-1">
                            <div class="main-selectpicker">
                                <select name="action_name" id="action_name" id="bulk-action" class="selectpicker form-control form-main" data-live-search="true" required="">
                                    <option value="">Select Action</option>
                                    <option value="assign_followups">Assign Followups</option>
                                    <option value="transfer_ownership">Transfer Inq</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="mt-3 custome_column">
                    <div class="text-start">
                        <span class="fs-6">Custome Columns</span>
                    </div>
                    <!-- <div class="col-12 d-flex">
                        <div class="bulk-action select col-lg-6 col-12 px-1 mt-lg-0 mb-1">
                            <input type="text" class="form-control main-control" id="import_file" name="import_file" placeholder="Details" required="">
                        </div>
                        <div class="bulk-action select col-lg-6 col-12 px-1 mt-lg-0 mb-1">
                            <div class="main-selectpicker">
                                <select name="action_name" id="action_name" id="bulk-action" class="selectpicker form-control form-main" data-live-search="true" required="">
                                    <option value="">Select Action</option>
                                    <option value="assign_followups">Assign Followups</option>
                                    <option value="transfer_ownership">Transfer Inq</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                </div>
            </form>
            <div class="justify-content-between d-flex">
                <button class=" btn-primary custome_col" type="submit" id="custome_col" name="custome_col">Add Custome
                    Column</button>
                <button class=" btn-primary import_btn" type="submit" id="import_btn" name="import_btn">Import
                    Data</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="import_csv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;">
        <div class="modal-content">
            <form class="needs-validation" name="import_inquiry_csv" method="POST" novalidate="">
                <div class="modal-header">
                    <h4 class="modal-title">Import File</h4>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery">
                    <div class="modal-body-card align-items-end">
                        <div class="col-sm-6 col-12">
                            <label for="" class="form-label main-label">Inq file upload <sup
                                    class="validationn">*</sup></label>
                            <input type="file" class="form-control main-control" onkeypress="replace(/ /g," _");"
                                id="import_file" name="import_file" placeholder="Details" required=""
                                accept=".xls,.xlsx">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start d-flex">
                    <button class=" btn-primary import_inquiry_csv_btn" type="submit" id="import_inquiry_csv_btn"
                        name="import_inquiry_csv_btn">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    $(document).ready(function () {
        $('.add').trigger('click');
        $('.custome_col').prop('disabled', true);
        $('.import_btn').prop('disabled', true);
        $('.import_inquiry_csv_btn').prop('disabled', true);

        $('body').on('change', '#import_file', function () {
            $('.import_inquiry_csv_btn').prop('disabled', false);
        });

        $('body').on('click', '.list_item', function (e) {
            e.preventDefault();
            var text = $(this).text();
            console.log(text);
            text = text.replace('+ add', '');
            $(this).closest('.main-selectpicker').find('input').val(text);
        });

        $('body').on('keyup', '#list', function (event) {
            var input, filter, ul, li, i, txtValue;
            input = $(this);
            input_val = input.val().trim();
            filter = input_val.toUpperCase();
            ul = input.closest('.main-selectpicker').find("ul");
            li = ul.find("li");

            if (event.key === ' ') {
                input_val = input_val.replace(/ /g, '_');
                input.val(input_val);
            }

            var found = false;

            for (i = 0; i < li.length; i++) {
                txtValue = li.eq(i).text();
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li.eq(i).css("display", "block");
                    found = true;
                } else {
                    li.eq(i).css("display", "none");
                }
            }

            if (!found) {
                ul.append('<li><button class="dropdown-item list_item d-flex" type="button"><span>' + input_val + '</span><span class="text-success ms-auto">+ add</span></button></li>');
            }
        });
        $('.custome_column').hide();

        $('body').on('click', '#custome_col', function (e) {
            e.preventDefault();
            var col_incriment_val = $('.custome_column').find('.custome_column_input');
            if (col_incriment_val.length == 0) {
                var i = 0;
            } else {
                var i = parseInt($('.custome_column').find('.custome_column_input:last').attr('data-check_id')) + 1;
            }
            $('.custome_column').show();
            var inputs = $('.file_columns').find('.file_columns_input');
            var html = '';
            var input_fileds = '';
            input_fileds += '<div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">'
                                + '<div class="main-selectpicker col-12 dropdown">'
                                    + '<input type="text" id="list" class="form-control list main-control dropdown-toggle custome_column_input" data-bs-toggle="dropdown" aria-expanded="false" data-check_id="' + i + '" name="' + i + '_col" id="' + i + '_col" placeholder="Custome Column">'
                                    + '<ul class="dropdown-menu dropdown-menu-end w-100 column_list" id="column_list">';
                                    <?php foreach ($columnNames as $columnName) {
                                        if (!preg_match("/id/", $columnName) && !preg_match("/date/", $columnName) && !preg_match("/status/", $columnName) && !preg_match("/type/", $columnName) && !preg_match("/amount/", $columnName) && !preg_match("/inquiry/", $columnName) && !preg_match("/buy/", $columnName) && !preg_match("/pay/", $columnName) && !preg_match("/created/", $columnName) && !preg_match("/head/", $columnName) && !preg_match("/unit/", $columnName) && !preg_match("/follow/", $columnName) && !preg_match("/is/", $columnName) && !preg_match("/tooltip/", $columnName) && !preg_match("/site_/", $columnName) && !preg_match("/area_/", $columnName)) { ?>
                                        var allValuesAreSame = 0;
                                        inputs.each(function() {
                                            console.log($(this).val());
                                            console.log('<?php echo $columnName; ?>');
                                            if ($(this).val() == '<?php echo $columnName; ?>') {
                                                allValuesAreSame = 1;
                                                // return false; // Break out of the loop
                                            } 
                                        });
                                        if(allValuesAreSame != 1) {
                                            input_fileds += '<li><button class="dropdown-item list_item" type="button"><span><?php echo $columnName; ?></span></button></li>';
                                        }
                                        <?php }
                                    } ?>
            input_fileds += '</ul>'
                                + '</div>'
                            + '</div>'
                            + '<div class="bulk-action select col-sm-6 col-12 px-1 mt-lg-0 mb-1 d-flex align-items-center">'
                                + '<div class="main-selectpicker col-12 dropdown">'
                                    + '<div class="bulk-action select col-12 px-1 mt-lg-0 mb-1">'
                                        + '<input type="text" class="form-control main-control" id="' + i + '_value" name="' + i + '_value" placeholder="to Column Value" value="" required>'
                                    + '</div>'
                                + '</div>'  
                            + '</div>';
            html += '<div class="col-12 d-flex flex-wrap mb-2">' + input_fileds + '</div>';

            $('.custome_column').append(html);
        });

        $('body').on('click', '#import_inquiry_csv_btn', function (e) {
            e.preventDefault();
            var form = $('form[name="import_inquiry_csv"]')[0];
            var formdata = new FormData(form);
            var file = $('#import_file').val();
            if (file != '') {
                $.ajax({
                    method: "post",
                    url: "<?= site_url('get_data_header_by_file'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        var responce = JSON.parse(res);
                        $('.loader').hide();
                        $('.modal-close-btn').trigger('click');
                        $('.file_columns').html(responce.html);
                        $('.selectpicker').selectpicker('refresh');
                        $('.import_btn').prop('disabled', false);
                        $('.custome_col').prop('disabled', false);
                    },
                });
            }
        });

        $('body').on('click', '#import_btn', function (e) {
            e.preventDefault();
            var import_form = $('form[name="import_inquiry_csv"]')[0];
            var col_data_form = $('form[name="column_data_form"]')[0];
            var import_formdata = new FormData(import_form);
            var col_data_formdata = new FormData(col_data_form);
            col_data_formdata.forEach(function (value, key) {
                import_formdata.append(key, value);
            });
            var totalData = [];
            var header_name = [];
            // if(file != ''){
            $.ajax({
                method: "post",
                url: "<?= site_url('import_file_data'); ?>",
                data: import_formdata,
                processData: false,
                contentType: false,
                beforeSend: function (f) {
                    $('.loader').show();
                },
                success: function (res) {
                    var responce = JSON.parse(res);
                    $('.loader').hide();
                    $('.modal-close-btn').trigger('click');
                    $('.selectpicker').selectpicker('refresh');
                    if (responce.export_data) {
                        Swal.fire({
                            title: 'Are you Duplicate Data Export csv File?',
                            html: "<p style='color:green;margin:0px;'><b>" + responce.import_data + "</b>Data successfully Imported</p><p style='color:red;margin:0px;'>" + responce.csv_data + "</b> Duplicate Data</p>",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Export File!',
                            cancelButtonText: 'No, cancel!',
                            confirmButtonClass: 'btn btn-success mt-2',
                            cancelButtonClass: 'btn btn-danger ms-2 mt-2',
                            buttonsStyling: false,
                        }).then(function (result) {
                            if (result.value) {
                                if (responce.export_data) {
                                    totalData = totalData.concat(responce.export_data);
                                    generateCSV(totalData);
                                    window.location.href = '<?= base_url('data_module') ?>';
                                }
                                iziToast.success({
                                    title: responce.msg,
                                });
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                iziToast.error({
                                    title: 'Your Argument Cancle :)',
                                });
                            }
                            window.location.href = '<?= base_url('data_module') ?>';
                        });
                    } else {
                        iziToast.success({
                            title: responce.msg,
                        });
                        window.location.href = '<?= base_url('data_module') ?>';
                    }
                    // if (responce.export_data) {
                    //     totalData = totalData.concat(responce.export_data);
                    //     // console.log(totalData);
                    //     generateCSV(totalData);
                    //     // window.location.href = '<?= base_url('data_module') ?>';
                    // }
                    // if(responce.response == 1){
                    // iziToast.success({
                    //     title: responce.msg,
                    // });
                    // } else {
                    // iziToast.success({
                    //     title: responce.msg,
                    // });
                    // }
                },
            });
            // }
        });

        function generateCSV(data) {
            var csvContent = "";

            data.forEach(function (row, index) {
                var rowData = [];

                // Iterate through the properties of each object
                for (var property in row) {
                    if (row.hasOwnProperty(property)) {
                        rowData.push(row[property]);
                    }
                }

                csvContent += rowData.join(",");

                // Add a new line character after each row except the last one
                if (index < data.length - 1) {
                    csvContent += "\n";
                }
            });

            var today_date = new Date();
            var year = today_date.getFullYear();
            var month = today_date.getMonth() + 1;
            var day = today_date.getDate();
            var username = '<?= $_SESSION['username'] ?>';
            var file_name = username + "-duplicate_data " + day + "-" + month + "-" + year + ".csv";
            var downloadLink = document.createElement("a");
            var fileData = ['\ufeff' + csvContent];
            var blobObject = new Blob(fileData, {
                type: "text/csv;charset=utf-8;"
            });
            var url = URL.createObjectURL(blobObject);
            downloadLink.href = url;
            downloadLink.download = file_name;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }



    });
</script>