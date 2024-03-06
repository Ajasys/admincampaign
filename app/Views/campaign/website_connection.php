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
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <circle cx="256" cy="256" r="225.229" fill="#a3defe" opacity="1" data-original="#a3defe" class=""></circle>
                                                        <path fill="#7acefa" d="M178.809 44.35C92.438 75.858 30.771 158.727 30.771 256c0 124.39 100.838 225.229 225.229 225.229 57.256 0 109.512-21.377 149.251-56.569C139.58 395.298 125.639 142.906 178.809 44.35z" opacity="1" data-original="#7acefa" class=""></path>
                                                        <path fill="#f7ef87" d="M476.093 194.583H35.907c-15.689 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407h440.186c15.689 0 28.407-12.718 28.407-28.407v-66.02c0-15.689-12.718-28.407-28.407-28.407z" opacity="1" data-original="#f7ef87" class=""></path>
                                                        <path fill="#efd176" d="M35.907 194.583c-15.688 0-28.407 12.718-28.407 28.407v66.02c0 15.689 12.718 28.407 28.407 28.407H275.1c-30.164-19.995-42.899-74.938-30.332-122.834z" opacity="1" data-original="#efd176"></path>
                                                        <path d="M478.365 187.162c-7.871-25.404-20.202-49.361-36.162-70.662a7.54 7.54 0 0 0-1.274-1.69c-12.438-16.293-27.011-30.994-43.35-43.536-40.914-31.404-89.87-48.003-141.576-48.004H256c-37.727 0-75.195 9.237-108.352 26.712a7.501 7.501 0 0 0 6.993 13.27c25.118-13.237 52.887-21.417 81.291-24.048-20.694 20.712-39.721 45.999-55.546 73.422H92.203a217.914 217.914 0 0 1 32.761-30.524 7.5 7.5 0 0 0-9.037-11.973C98.942 82.95 83.84 98.072 71.012 114.886c-.424.434-.792.92-1.101 1.446-16.016 21.332-28.38 45.339-36.276 70.83C14.891 188.339 0 203.954 0 222.989v66.02c0 19.036 14.891 34.651 33.635 35.828 7.87 25.402 20.201 49.359 36.16 70.659a7.515 7.515 0 0 0 1.277 1.694c12.438 16.293 27.01 30.993 43.35 43.534 40.915 31.404 89.871 48.004 141.578 48.004 41.421 0 82.096-11.021 117.626-31.872a7.502 7.502 0 0 0 2.673-10.265 7.502 7.502 0 0 0-10.265-2.673c-27.467 16.12-58.229 25.95-89.957 28.878 20.689-20.713 39.715-46.003 55.539-73.424h88.276a220.539 220.539 0 0 1-25.259 24.523 7.5 7.5 0 0 0 4.782 13.281 7.47 7.47 0 0 0 4.775-1.72c35.239-29.132 60.797-67.287 74.178-110.619C497.11 323.659 512 308.045 512 289.01v-66.02c0-19.036-14.892-34.651-33.635-35.828zm-46.581-59.535c13.235 18.111 23.688 38.206 30.796 59.456h-98.057c-6.252-20.083-14.64-40.166-24.673-59.456zm-43.34-44.452a217.733 217.733 0 0 1 31.348 29.452h-88.177c-15.831-27.434-34.867-52.729-55.57-73.445 40.938 3.694 79.458 18.708 112.399 43.993zM256 40.77c21.52 19.485 41.514 44.384 58.222 71.857H197.777C214.485 85.154 234.479 60.255 256 40.77zm-66.878 86.857h133.756c10.472 19.162 19.286 39.271 25.896 59.456H163.226c6.61-20.185 15.424-40.294 25.896-59.456zm-108.911 0h91.938c-10.033 19.29-18.421 39.372-24.673 59.456H49.419c7.111-21.266 17.56-41.352 30.792-59.456zm.005 256.746c-13.235-18.111-23.688-38.207-30.796-59.456h98.058c6.252 20.083 14.639 40.166 24.672 59.456zm43.34 44.452c-11.42-8.765-21.915-18.657-31.348-29.452h88.177c15.829 27.43 34.862 52.728 55.558 73.444-40.933-3.696-79.449-18.709-112.387-43.992zM256 471.23c-21.521-19.485-41.515-44.384-58.223-71.858h116.445C297.514 426.846 277.52 451.745 256 471.23zm66.878-86.857H189.122c-10.472-19.162-19.288-39.272-25.9-59.456h185.556c-6.612 20.184-15.428 40.294-25.9 59.456zm109.049 0H339.85c10.033-19.29 18.42-39.372 24.672-59.456h98.067a216.097 216.097 0 0 1-30.662 59.456zM497 289.01c0 11.528-9.379 20.907-20.907 20.907H35.906C24.379 309.917 15 300.538 15 289.01v-66.02c0-11.527 9.379-20.906 20.907-20.906h3.319l.028.002.024-.002h319.653l.024.002.028-.002h113.74l.024.002.028-.002h3.318c11.528 0 20.907 9.379 20.907 20.906zm-308.316-68.473a7.502 7.502 0 0 0-9.613 4.482l-13.636 37.467-13.637-37.467a7.5 7.5 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.684-56.83a7.501 7.501 0 0 0-4.483-9.613zm222.501 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.637-37.467a7.5 7.5 0 0 0-14.095 5.131l20.685 56.83a7.5 7.5 0 0 0 14.096 0l13.637-37.467 13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.504 7.504 0 0 0-4.484-9.613zm-111.25 0a7.496 7.496 0 0 0-9.613 4.482l-13.637 37.467-13.637-37.467a7.499 7.499 0 0 0-14.096 0l-13.637 37.467-13.636-37.467a7.5 7.5 0 0 0-14.096 5.131l20.684 56.83a7.5 7.5 0 0 0 14.096 0L256 249.514l13.637 37.467a7.5 7.5 0 0 0 14.096 0l20.685-56.83a7.503 7.503 0 0 0-4.483-9.614z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>                        
                    <h2 class="mx-2">Website Connections</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end  col-1">
                    <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#webSntModal" class="btn-primary-rounded mx-2">
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
                                    <th class="p-2 text-nowrap"><span>Website Name</span></th>
                                    <th class="p-2 text-nowrap"><span>Access Token</span></th>
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
<div class="modal fade" id="webSntModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Connection</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation row" name="web_cnt" method="POST" novalidate="">
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
                <button type="button" class="btn btn-primary" id="website_cnt">Submit</button>
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
                                <span id="web_access_token" style="word-wrap: break-word;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="add-user-input">
                            <label for="relation" class="form-label main-label fw-semibold">Website API Integrate:</label>
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
                                    <p>access_token:&lt;access_token_value&gt;
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
        var website_name = $(this).attr('data-name');
        var access_token = $(this).attr('data-token');
        $('#web_access_token').text(access_token);

    });


    //website connection
    $('body').on('click', '#website_cnt', function() {
        var website_name = $("#website_name").val();
        var access_token = $("#access_token").val();
        if (access_token != '' && website_name !='') {
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('add_website_connection'); ?>",
                data: {
                    action: 'insert',
                    access_token:access_token,
                    website_name:website_name,
                },
                success: function(res) {
                    var result = JSON.parse(res);
                    if (result.response == 1 || result.response == 2) {
                        $("form[name='web_cnt']")[0].reset();
                        $("form[name='web_cnt']").removeClass("was-validated");
                        $("#webSntModal").modal('hide');

                        list_data();
                        if (result.response == 1) {
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
            url: 'website_connection_list',
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
  
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>