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
function generateAccessToken($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $accessToken = '';
    // Generate random token string
    for ($i = 0; $i < $length; $i++) {
        
        $accessToken .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $accessToken;
}

?>
<div class="main-dashbord p-3">
    <div class="container-fluid p-0">
        <div>
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="title-1  d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 508 508" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M254 0C146.7 0 0 81.1 0 254c0 168.5 141.1 254 254 254 193.7 0 254-169.7 254-254C508 129.6 412.8 0 254 0zm-58.9 23.9c-26.5 22.6-48.5 60-62.7 106.4-18.4-10.9-35.3-24.4-50.3-40.1 31-32.5 70.2-55.3 113-66.3zM71.2 102.4c16.8 17.5 35.9 32.4 56.7 44.2-7.8 30.3-12.4 63.9-13 99.2H16.6c1.8-52.7 21-103 54.6-143.4zm0 303.2c-33.7-40.4-52.8-90.7-54.6-143.4h98.3c.6 35.4 5.2 68.9 13 99.2-20.7 11.9-39.8 26.7-56.7 44.2zm10.9 12.3c15-15.7 31.9-29.2 50.3-40.1 14.2 46.3 36.2 83.8 62.7 106.4-42.8-11.1-82-33.9-113-66.3zM245.8 491c-42.6-5.4-79.3-53-99.1-121.2 30.6-15.5 64.4-24.2 99.1-25.5V491zm0-163c-36.2 1.2-71.4 10.1-103.3 25.7-6.7-28-10.7-58.9-11.3-91.5h114.6V328zm0-82.2H131.2c.6-32.6 4.6-63.5 11.3-91.5 32 15.6 67.2 24.5 103.3 25.7v65.8zm0-82.1c-34.8-1.2-68.5-10-99.1-25.5C166.5 69.9 203.2 22.4 245.8 17v146.7zm191-61.3c33.6 40.4 52.8 90.7 54.6 143.4h-98.2c-.6-35.4-5.2-68.9-13-99.2 20.7-11.9 39.8-26.7 56.6-44.2zm-10.9-12.3c-15 15.7-31.9 29.2-50.3 40.1-14.2-46.3-36.2-83.7-62.7-106.4 42.8 11.1 82 33.9 113 66.3zM262.2 17c42.6 5.4 79.3 53 99.1 121.2-30.6 15.5-64.3 24.2-99.1 25.5V17zm0 163c36.2-1.2 71.4-10.1 103.3-25.7 6.7 28 10.7 58.9 11.3 91.5H262.2V180zm0 82.2h114.6c-.6 32.6-4.6 63.5-11.3 91.5A251.24 251.24 0 0 0 262.2 328v-65.8zm0 228.8V344.3c34.8 1.2 68.5 10 99.1 25.5-19.8 68.3-56.5 115.8-99.1 121.2zm50.7-6.9c26.5-22.6 48.5-60 62.7-106.4 18.4 10.9 35.3 24.4 50.3 40.1-31 32.5-70.2 55.3-113 66.3zm123.9-78.5c-16.8-17.5-35.9-32.3-56.6-44.2 7.8-30.3 12.4-63.9 13-99.2h98.2c-1.8 52.7-21 103-54.6 143.4z" fill="#000000" opacity="1" data-original="#000000" class=""></path></g></svg>                        
                    <h2 class="mx-2">Website Connections</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end  col-1">
                    <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#fbCntModal" class="btn-primary-rounded mx-2">
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
                        <h6 class="modal-body-title">Website Name<sup class="validationn">*</sup></h6>
                        <input type="text" class="form-control main-control" id="website_name" name="website_name" placeholder="Enter your website name" required>
                    </div>

                    <div class="col-12">
                        <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                        <textarea type="text" class="form-control main-control" id="access_token" name="access_token" readonly required><?php echo generateAccessToken(150);?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-bs-dismiss="modal">Close</button>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
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

    //facebook connection
    $('body').on('click', '#facebook_cnt', function() {
        var access_token = $("#access_token").val();
        if (access_token != '') {
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('check_fb_connection'); ?>",
                data: {
                    action: 'insert',
                    access_token: access_token,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.response == 1 || result.response == 2) {
                        $("form[name='fb_cnt']")[0].reset();
                        $("form[name='fb_cnt']").removeClass("was-validated");
                        $("#fbCntModal").modal('hide');

                        list_data();
                        if (result.response == 1) {
                            fb_permission_list(access_token);
                            iziToast.success({
                                title: result.message,
                            });
                        } else {
                            iziToast.warning({
                                title: result.message,
                            });
                        }
                    } else {
                        iziToast.error({
                            title: result.message,
                        });
                    }
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
            $('.loader').hide();
            return false;
        } else {
            var form = $("form[name='fb_cnt']")[0];
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
            success: function(res) {
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
                        onPageClick: function(event, page) {
                            list_data(table, page, perPageCount, ajaxsearch);
                        }
                    });
                }
            }
        });
    }

    function deletefbconn(id) {
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
                        url: 'delete_fb_connection',
                        data: {
                            id: id,
                        },
                        success: function(res) {
                            var result = JSON.parse(res);
                            if (result.response == 1) {
                                iziToast.error({
                                    title: 'Facebook app connection has been deleted successfully..!',
                                });
                                list_data();
                            } else {
                                iziToast.error({
                                    title: 'Facebook app connection has not been deleted successfully..!',
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
    $('body').on('click', '.get-permission', function() {
        var access_token = $(this).attr('data-access-token');
        fb_permission_list(access_token);
    });

    function fb_permission_list(access_token) {
        $('#informaion_connection').modal('show');
        var data = {
            'access_token': access_token,
        };
        $('.loader').show();
        $.ajax({
            datatype: 'json',
            method: "POST",
            url: 'fb_permission_list',
            data: data,
            success: function(res) {
                var result = JSON.parse(res);
                if (result.response == 1) {
                    $('.set-permission').html(result.tableHtml);
                }
                $('.loader').hide();
            }
        });
    }
</script>