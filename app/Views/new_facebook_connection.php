<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    .sm-btn {
        padding: 2px 4px;
    }

    .Success {
        background-color: #41b039;
    }

    .Warning {
        background-color: #dacb00;
    }

    .Error {
        background-color: #ff0000;
    }

    .Info {
        background-color: #0D6EFD;
    }

    .main-table.lead_list_table tbody tr:nth-child(even) {
        background-color: #edd9ff29;
    }

    @media(min-width:990px) {
        .responsivetable {
            overflow: visible !important;
        }
    }
</style>
<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
?>
<div class="main-dashbord p-3">
    <div class="container-fluid p-0">
        <div>
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="title-1  d-flex align-items-center">
                    <i class="fa-brands fa-facebook transition-5 icon2 rounded-circle"
                        style="font-size: 35px;color: #3a559f;"></i>
                    <h2>Facebook Connections</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end  col-1">
                    <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#fbCntModal"
                        class="btn-primary-rounded mx-2">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="p-2">
                <!-- <div class="col-xl-12 d-flex p-2 px-4 d-flex flex-wrap"> -->
                <!-- <div class="col-3">
                        <div class="d-flex input-group">
                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="number" min="0" step="0.01" class="form-control main-control " id="coupon_value" name="coupon_value" placeholder="Coupon Value" required="">
                        </div>
                    </div>
                    <div class="col-2 mx-2">
                        <div class="d-flex input-group">
                            <span class="input-group-text border-end-0" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <div class="main-selectpicker col">
                                <select id="product_type" name="product_type" class="border  border-start-0 rounded-start-0 selectpicker form-control form-main main-control product_type" data-live-search="true" required="" tabindex="-98">
                                    <option value="1" class="dropdown-item d-flex flex-wrap ">
                                        <p>

                                            Filter
                                        </p>
                                    </option>
                                    <option value="1" class="dropdown-item">Filter</option>
                                    <option value="1" class="dropdown-item">Filter</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-1 mx-2">

                    </div> -->
                <!-- <div class="col-12 w-100  my-3">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="border-bottom">
                                    <th scope="col">App Name</th>
                                    <th scope="col">App Id</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Certificate</th>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle" scope="col-2"><sup class="fs-12">IN</sup> +91 7600176982</td>
                                    <td class="align-middle" scope="col-2">45826536598565</td>
                                    <td class="align-middle" scope="col-1">
                                        <span class="d-inline-block bg-text-danger border border-light rounded-circle" style="width:11px;height:11px"></span>
                                        <span Class="mx-2">High</span>
                                    </td>
                                    <td class="align-middle" scope="col-1"><span class="p-1 bg-danger border border-light rounded-pill fs-10 text-white">Connected</span></td>

                                    <td class="align-middle" scope="col-1 text-center">
                                        <button class="btn border rounded-3">
                                            View
                                        </button>
                                    </td>
                                    <td class="align-middle" scope="col-1">
                                        <button class="btn border rounded-3">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                    <td class="align-middle" scope="col-1">
                                        <button class="btn border rounded-3">
                                            <i class="fa-solid fa-gear"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="border-top">
                                    <td colspan="8" class="p-1"><span class="fs-12">1 Phone Number</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> -->

                <div class="col-12 py-3 px-3 bg-white rounded-2">
                    <div class="w-100 overflow-x-scroll scroll-small row_none responsivetable">
                        <div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
                            <div class="dataTables_length" id="project_length">
                                <label>
                                    Show
                                    <select name="project_length" id="fb_length_show" aria-controls="project"
                                        class="table_length_select_check_2">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    Records
                                    <span class="list_count"></span>
                                </label>
                            </div>
                            <div id="people_wrapper" class="dataTables_wrapper no-footer">
                                <div id="fb_filter" class="dataTables_filter justify-content-end d-flex py-1 py-sm-0">
                                    <label>Search:<input type="search" class="" placeholder=""
                                            aria-controls="project"></label>
                                </div>
                            </div>
                        </div>
                        <table id="leadTable" class="table main-table w-100">
                            <thead>
                                <tr>
                                    <th class="p-2 text-nowrap"><span>App Name</span></th>
                                    <th class="p-2 text-nowrap"><span>App Id </span></th>
                                    <th class="p-2 text-nowrap"><span>Type</span></th>
                                    <th class="p-2 text-nowrap"><span></span></th>
                                    <th class="p-2 text-nowrap"><span>Status</span></th>
                                    <th class="p-2 text-nowrap text-center"><span></span></th>
                                </tr>
                            </thead>
                            <tbody id="fb_list_data"></tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
                            <div class="row_count_div col-xl-6 col-12">
                                <p id="row_count"></p>
                            </div>
                            <div class="clearfix  col-xl-6 col-12">
                                <ul class="fb_pagination justify-content-xl-end" id="fb_pagination"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->

            </div>
        </div>
        <div class="row">

        </div>
    </div>
</div>
<div class="modal fade" id="fbCntModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Connection</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation row" name="fb_cnt" method="POST" novalidate="">
                    <div class="col-12">
                        <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                        <textarea type="text" class="form-control main-control" id="access_token" name="access_token"
                            placeholder="Enter Access Token" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="facebook_cnt">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- informaion-modal -->
<div class="modal fade" id="informaion_connection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permission List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-y-scroll set-permission" style="height:400px">
                
            </div>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $(document).ready(function () {
        list_data();
    });
    $('body').on('click', '#facebook_cnt', function () {
        var access_token = $("#access_token").val();
        if (access_token != '') {
            $.ajax({
                type: "post",
                url: "<?= site_url('check_fb_connection'); ?>",
                data: {
                    action: 'insert',
                    access_token: access_token,
                },
                success: function (res) {
                    var result = JSON.parse(res);
                    if (result.response == 1) {
                        $("form[name='fb_cnt']")[0].reset();
                        $("form[name='fb_cnt']").removeClass("was-validated");
                        $(".modal-close-btn").trigger("click");
                        list_data();
                        iziToast.success({
                            title: result.message,
                        });
                    } else {
                        iziToast.error({
                            title: result.message,
                        });
                    }
                },
                error: function (error) {
                    $('.loader').hide();
                }
            });
            return false;
        } else {
            var form = $("form[name='fb_cnt']")[0];
            $(form).find('.selectpicker').each(function () {
                var selectpicker_valid = 0;
                if ($(this).attr('required') == 'undefined') {
                    var selectpicker_valid = 0;
                }
                if ($(this).attr('required') == 'required') {
                    var selectpicker_valid = 1;
                }
                if (selectpicker_valid == 1) {
                    if ($(this).val() == 0 || $(this).val() == '') {
                        $(this).closest("div").addClass('selectpicker-validation');
                    } else {
                        $(this).closest("div").removeClass('selectpicker-validation');
                    }
                } else {
                    $(this).closest("div").removeClass('selectpicker-validation');
                }
            });
            iziToast.error({
                title: 'Please fill required field..!',
            });
            return false;
        }
    });

    function list_data(table = 'integration', pageNumber = 1, perPageCount = '10', ajaxsearch = "", action = true) {
        var followupTime = '';
        perPageCount = $('#fb_length_show').val();
        var data = {
            'table': table,
            'pageNumber': pageNumber,
            'perPageCount': perPageCount,
            'ajaxsearch': ajaxsearch,
            'action': action,
        };
        var processdd = true;
        var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
        var totalData = [];
        $.ajax({
            datatype: 'json',
            method: "POST",
            url: 'fb_connection_list',
            data: data,
            processData: processdd,
            contentType: contentType,
            success: function (res) {
                var result = JSON.parse(res);
                if (result.response == 1) {
                    if (result.total_page == 0 || result.total_page == '') {
                        total_page = 1;
                    } else {
                        total_page = result.total_page;
                    }
                    $('#row_count').html(result.row_count_html);
                    $('#fb_list_data').html(result.html);
                    $('.fb_pagination').twbsPagination({
                        totalPages: total_page,
                        visiblePages: 2,
                        next: '>>',
                        prev: '<<',
                        onPageClick: function (event, page) {
                            list_data(table, page, perPageCount, ajaxsearch);
                        }
                    });
                }
            }
        });
    }

    function deletefbconn($id)
    {
        $.ajax({
            datatype: 'json',
            method: "POST",
            url: 'delete_fb_connection',
            data: {
                id: id,
            },
            success: function (res) {
                var result = JSON.parse(res);
                if (result.response == 1) {
                    iziToast.error({
                        title: 'Your connection has been deleted successfully..!',
                    });
                }
                else
                {
                    iziToast.error({
                        title: 'Your connection has not been deleted successfully..!',
                    });
                }
            }
        });
    }
    $('#fb_filter input[type="search"]').on('keyup', function (e) {
        if (e.which == 13) {
            $('.fb_pagination').twbsPagination('destroy');
            var input = $(this).val().toLowerCase();
            var table = $('#today-follow-feedback');
            var rows = table.find('tbody tr');
            list_data('integration', '', '', input);
        }
    });
    $('body').on('change', '#fb_length_show', function () {
        $('.fb_pagination').twbsPagination('destroy');
        var perPageCount = $(this).val();
        list_data('integration', 1, perPageCount)
    });
    $('body').on('click', '.get-permission', function () {
        var access_token = $(this).attr('data-access-token');
        var data = {
            'access_token': access_token,
        };
        $('.loader').show();
        $.ajax({
            datatype: 'json',
            method: "POST",
            url: 'fb_permission_list',
            data: data,
            success: function (res) {
                var result = JSON.parse(res);
                if (result.response == 1) {
                    $('.set-permission').html(result.tableHtml);
                }
                $('.loader').hide();
            }
        });
    });

</script>