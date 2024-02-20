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

    .click_tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
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
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 48 48">
                        <path fill="#0078d4" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5	V37z">
                        </path>
                        <path d="M30,37V26.901c0-1.689-0.819-2.698-2.192-2.698c-0.815,0-1.414,0.459-1.779,1.364	c-0.017,0.064-0.041,0.325-0.031,1.114L26,37h-7V18h7v1.061C27.022,18.356,28.275,18,29.738,18c4.547,0,7.261,3.093,7.261,8.274	L37,37H30z M11,37V18h3.457C12.454,18,11,16.528,11,14.499C11,12.472,12.478,11,14.514,11c2.012,0,3.445,1.431,3.486,3.479	C18,16.523,16.521,18,14.485,18H18v19H11z" opacity=".05"></path>
                        <path d="M30.5,36.5v-9.599c0-1.973-1.031-3.198-2.692-3.198c-1.295,0-1.935,0.912-2.243,1.677	c-0.082,0.199-0.071,0.989-0.067,1.326L25.5,36.5h-6v-18h6v1.638c0.795-0.823,2.075-1.638,4.238-1.638	c4.233,0,6.761,2.906,6.761,7.774L36.5,36.5H30.5z M11.5,36.5v-18h6v18H11.5z M14.457,17.5c-1.713,0-2.957-1.262-2.957-3.001	c0-1.738,1.268-2.999,3.014-2.999c1.724,0,2.951,1.229,2.986,2.989c0,1.749-1.268,3.011-3.015,3.011H14.457z" opacity=".07"></path>
                        <path fill="#fff" d="M12,19h5v17h-5V19z M14.485,17h-0.028C12.965,17,12,15.888,12,14.499C12,13.08,12.995,12,14.514,12	c1.521,0,2.458,1.08,2.486,2.499C17,15.887,16.035,17,14.485,17z M36,36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698	c-1.501,0-2.313,1.012-2.707,1.99C24.957,25.543,25,26.511,25,27v9h-5V19h5v2.616C25.721,20.5,26.85,19,29.738,19	c3.578,0,6.261,2.25,6.261,7.274L36,36L36,36z">
                        </path>
                    </svg>
                    <h2 class="mx-2">LinkedIn Connections</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end  col-1">
                    <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#linkedinCntModal" class="btn-primary-rounded mx-2">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="p-2">
                <div class="col-12 py-3 px-3 bg-white rounded-2">
                    <div class="w-100 overflow-x-scroll scroll-small row_none responsivetable">
                        <div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
                            <div class="dataTables_length" id="project_length">
                                <label>
                                    Show
                                    <select name="project_length" id="fb_length_show" aria-controls="project" class="table_length_select_check_2">
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
                                    <label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
                                </div>
                            </div>
                        </div>
                        <table id="leadTable" class="table main-table w-100">
                            <thead>
                                <tr>
                                    <th class="p-2 text-nowrap"><span>App Name</span></th>
                                    <th class="p-2 text-nowrap"><span>App Id</span></th>
                                    <th class="p-2 text-nowrap"><span>Status</span></th>
                                    <th class="p-2 text-nowrap text-center"><span></span></th>
                                </tr>
                            </thead>
                            <tbody id="linkedin_list_data">

                            </tbody>
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
<div class="modal fade" id="linkedinCntModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Connection</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation row" name="web_cnt" method="POST" novalidate="">
                    <div class="col-12">
                        <h6 class="modal-body-title">Client Id<sup class="validationn">*</sup></h6>
                        <input type="text" class="form-control main-control" id="client_id" name="client_id" placeholder="Enter your client id" required>
                    </div>

                    <div class="col-12">
                        <h6 class="modal-body-title">Client Secret<sup class="validationn">*</sup></h6>
                        <input type="password" class="form-control main-control" id="client_secret" name="client_secret" placeholder="Enter your client secret" required>
                    </div>

                    <div class="col-12">
                        <h6 class="modal-body-title">Access Tokenn<sup class="validationn">*</sup></h6>
                        <input type="text" class="form-control main-control" id="access_token" name="access_token" placeholder="Enter your access token" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="linkedin_cnt">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Modal_tabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">API Documentation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body-card">
                    <div class="row col-12">
                        <div class="add-user-input">
                            <label for="relation" class="form-label main-label fw-semibold">Access Token:</label>
                            <div class="ps-3">
                                <span id="web_client_secret" style="word-wrap: break-word;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="add-user-input">
                            <label for="relation" class="form-label main-label fw-semibold mt-2">Website API Integrate:</label>
                            <div class="ms-3">
                                <span id="web_method" style="word-wrap: break-word;">
                                    <p>Method : POST</p>
                                </span>
                                <span id="web_url" style="word-wrap: break-word;">
                                    <p>URL : <?php echo base_url(); ?>web_integrate</p>
                                </span>
                            </div>
                            <div style="margin-left: 35px;">
                                <span id="form_data" class="" style="word-wrap: break-word;">
                                    <p style="margin-left: -18px;">Form Data Passing : </p>
                                    <p>name:&lt;name_value&gt;</p>
                                    <p>mobileno:&lt;mobileno_value&gt;
                                    </p>
                                    <p>email:&lt;email_value&gt;
                                    </p>
                                    <p>description:&lt;description_value&gt;
                                    </p>
                                    <p>client_secret:&lt;client_secret_value&gt;
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 mt-3">
                        <img src="<?php echo base_url(); ?>assets/images/websiteImage/webpostman.png">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $(document).ready(function() {
        list_data();
    });

    $('body').on('click', '.click_tr', function() {
        var client_id = $(this).attr('data-name');
        var client_secret = $(this).attr('data-token');
        $('#web_client_secret').text(client_secret);

    });

    //linkedin connection
    $('body').on('click', '#linkedin_cnt', function() {
        var client_id = $("#client_id").val();
        var client_secret = $("#client_secret").val();
        var access_token = $("#access_token").val();
        if (client_secret != '' && client_id != '' && access_token != '') {
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('add_linkedin_connection'); ?>",
                data: {
                    action: 'insert',
                    client_secret: client_secret,
                    client_id: client_id,
                    access_token:access_token,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    // if (result.response == 1 || result.response == 2) {
                    //     $("form[name='web_cnt']")[0].reset();
                    //     $("form[name='web_cnt']").removeClass("was-validated");
                    //     $("#linkedinCntModal").modal('hide');

                    //     list_data();
                    //     if (result.response == 1) {
                    //         iziToast.success({
                    //             title: result.message,
                    //         });
                    //     } else {
                    //         iziToast.warning({
                    //             title: result.message,
                    //         });
                    //     }
                    // } else {
                    //     iziToast.error({
                    //         title: result.message,
                    //     });
                    // }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
            $('.loader').hide();
            return false;
        } else {
            var form = $("form[name='web_cnt']")[0];
            $(form).find('.selectpicker').each(function() {
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

    function list_data(table = 'platform_integration', pageNumber = 1, perPageCount = '10', ajaxsearch = "", action = true) {
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
            url: 'linkedin_connection_list',
            data: data,
            success: function(res) {
                var result = JSON.parse(res);
                if (result.response == 1) {
                    if (result.total_page == 0 || result.total_page == '') {
                        total_page = 1;
                    } else {
                        total_page = result.total_page;
                    }
                    $('#row_count').html(result.row_count_html);
                    $('#linkedin_list_data').html(result.html);
                    $('.fb_pagination').twbsPagination({
                        totalPages: total_page,
                        visiblePages: 2,
                        next: '>>',
                        prev: '<<',
                        onPageClick: function(event, page) {
                            list_data(table, page, perPageCount, ajaxsearch);
                        }
                    });
                }
            }
        });
    }

    function deletewebsiteconn(id) {
        var record_text = "Are you sure you want to Delete this?";
        if (id != '' && id !== undefined && id !== 'undefined') {
            Swal.fire({
                title: 'Are you sure?',
                text: record_text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'CONFIRM',
                cancelButtonText: 'CANCEL',
                cancelButtonColor: '#6e7881',
                confirmButtonColor: '#dd3333',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        datatype: 'json',
                        method: "POST",
                        url: 'delete_website_connection',
                        data: {
                            id: id,
                        },
                        success: function(res) {
                            var result = JSON.parse(res);
                            if (result.response == 1) {
                                iziToast.error({
                                    title: 'Website connection has been deleted successfully..!',
                                });
                                list_data();
                            } else {
                                iziToast.error({
                                    title: 'Website connection has not been deleted successfully..!',
                                });
                            }
                        }
                    });
                }
            });

        }

    }

    $('#fb_filter input[type="search"]').on('keyup', function(e) {
        if (e.which == 13) {
            $('.fb_pagination').twbsPagination('destroy');
            var input = $(this).val().toLowerCase();
            var table = $('#today-follow-feedback');
            var rows = table.find('tbody tr');
            list_data('integration', '', '', input);
        }
    });
    $('body').on('change', '#fb_length_show', function() {
        $('.fb_pagination').twbsPagination('destroy');
        var perPageCount = $(this).val();
        list_data('integration', 1, perPageCount)
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>