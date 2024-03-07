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
    .big_circle_fb_inner {
        background-color: #1876ef;
        box-shadow: inset 0 0 15px 0 #24242469;
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
                    <i class="fa-brands fa-facebook transition-5 icon2 rounded-circle" style="font-size: 35px;color: #3a559f;"></i>
                    <h2>Facebook Connections</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end  col-2">
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
                <!-- <form class="needs-validation row" name="fb_cnt" method="POST" novalidate="">
                    <div class="col-12">
                        <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                        <textarea type="text" class="form-control main-control" id="access_token" name="access_token" placeholder="Enter Access Token" required></textarea>
                    </div>
                </form> -->
                <form class="needs-validation" name="pagelist" method="POST" novalidate="">
                    <div class="lead_add_main_box px-3 py-5 bg-white rounded-2 mx-2 mb-2 position-relative">
                        <div class="d-flex justify-content-center align-items-center gap-3 py-4">
                            <div class="big_list_add_outer_main big_list_add_outer_main_1 position-relative">
                                <div class="big_circle_fb_outer position-relative logo-1">
                                    <div class="big_circle_fb cursor-pointer">
                                        <div class="big_circle_fb_inner p-5 rounded-circle position-relative profile_div">
                                            <div class="z-2 position-relative fb_div_hide">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="80" height="80" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path fill-rule="evenodd" d="M255.182 7.758q69.23.79 125.086 34.03a249.734 249.734 0 0 1 88.89 89.434q33.037 56.191 33.825 125.843-1.962 95.3-60.117 162.79c-38.77 44.995-88.425 72.83-139.827 83.501V325.23h48.597l10.99-70h-73.587v-45.848a39.844 39.844 0 0 1 8.474-26.323q8.827-11.253 31.09-11.829h44.436v-61.318q-.957-.308-18.15-2.434a360.743 360.743 0 0 0-39.16-2.434q-44.433.205-70.281 25.068-25.85 24.855-26.409 71.92v53.198h-56v70h56v178.127c-63.115-10.67-112.77-38.506-151.54-83.5S8.691 320.598 7.383 257.065q.785-69.655 33.824-125.843a249.739 249.739 0 0 1 88.891-89.435q55.854-33.233 125.084-34.03z" fill="#ffffff" data-original="#000000" opacity="1" class=""></path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <!-- <img src="https://dev.realtosmart.com/assets/images/r-logo.png" class="w-100 h-100 object-fit-contain rounded-circle"> -->
                                        </div>
                                    </div>
                                    <div class="big_circle_fb_list all_circle_plus_list bg-white border-0 rounded-2 shadow position-absolute py-2 px-3 ms-3 top-50 start-100 translate-middle-y">
                                        <div class="text-end mt-2">
                                            <fb:login-button onlogin="myFacebookLogin();"></fb:login-button>
                                        </div>
                                    </div>
                                    <h6 class="position-absolute top-100 start-50 translate-middle text-nowrap mt-4">
                                        <b>Facebook Connection</b>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary" id="facebook_cnt">Submit</button> -->
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
    window.fbAsyncInit = function() {
        FB.init({
            appId: '225501013967437',
            xfbml: true,
            version: 'v19.0'
        });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    function myFacebookLogin() {
        FB.login(function(response) {
            $('.loader').show();
            if (response.authResponse) {
                // Exchange short-lived token for a long-lived token
                FB.api('/oauth/access_token', 'GET', {
                    "grant_type": "fb_exchange_token",
                    "client_id": "225501013967437",
                    "client_secret": "ce8e76fd079722356c9122f4e92bb150",
                    "fb_exchange_token": response.authResponse.accessToken
                }, function(tokenResponse) {
                    var longLivedToken = tokenResponse.access_token;
                    FB.api('/me', function(userResponse) {
                        $.ajax({
                            type: "post",
                            url: "<?= site_url('facebook_user'); ?>",
                            data: {
                                action: 'add_user',
                                response: response.authResponse,
                                userinformation: userResponse,
                                longLivedToken: longLivedToken // Include the long-lived token
                            },
                            success: function(res) {
                                $('.loader').hide();
                                var result = JSON.parse(res);
                                console.log(result.response);
                                if (result.response == 1 || result.response == 2) {
                                    $("#fbCntModal").modal('hide');
                                    if (result.response == 1) {
                                        iziToast.success({
                                            title: result.message,
                                        });
                                        location.reload();
                                        // fb_permission_list(access_token);
                                    } else {
                                        iziToast.warning({
                                            title: result.message,
                                        });
                                    }
                                    list_data();
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
                    });
                });
            }
        }, {
            scope: 'public_profile,pages_show_list,leads_retrieval,pages_manage_ads, pages_manage_engagement, pages_read_engagement, pages_manage_metadata'
        });
    }
    //facebook connection
    // $('body').on('click', '#facebook_cnt', function() {
    //     var access_token = $("#access_token").val();
    //     if (access_token != '') {
    //         $('.loader').show();
    //         $.ajax({
    //             type: "post",
    //             url: "<?= site_url('check_fb_connection'); ?>",
    //             data: {
    //                 action: 'insert',
    //                 access_token: access_token,
    //             },
    //             success: function(res) {
    //                 var result = JSON.parse(res);
    //                 if (result.response == 1 || result.response == 2) {
    //                     $("form[name='fb_cnt']")[0].reset();
    //                     $("form[name='fb_cnt']").removeClass("was-validated");
    //                     $("#fbCntModal").modal('hide');
    //                     list_data();
    //                     if (result.response == 1) {
    //                         fb_permission_list(access_token);
    //                         iziToast.success({
    //                             title: result.message,
    //                         });
    //                     } else {
    //                         iziToast.warning({
    //                             title: result.message,
    //                         });
    //                     }
    //                 } else {
    //                     iziToast.error({
    //                         title: result.message,
    //                     });
    //                 }
    //             },
    //             error: function(error) {
    //                 $('.loader').hide();
    //             }
    //         });
    //         $('.loader').hide();
    //         return false;
    //     } else {
    //         var form = $("form[name='fb_cnt']")[0];
    //         $(form).find('.selectpicker').each(function() {
    //             var selectpicker_valid = 0;
    //             if ($(this).attr('required') == 'undefined') {
    //                 var selectpicker_valid = 0;
    //             }
    //             if ($(this).attr('required') == 'required') {
    //                 var selectpicker_valid = 1;
    //             }
    //             if (selectpicker_valid == 1) {
    //                 if ($(this).val() == 0 || $(this).val() == '') {
    //                     $(this).closest("div").addClass('selectpicker-validation');
    //                 } else {
    //                     $(this).closest("div").removeClass('selectpicker-validation');
    //                 }
    //             } else {
    //                 $(this).closest("div").removeClass('selectpicker-validation');
    //             }
    //         });
    //         iziToast.error({
    //             title: 'Please fill required field..!',
    //         });
    //         return false;
    //     }
    // });
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
                                iziToast.success({
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
    $('body').on('click', '#facebook_lead_drop_1', function() {
        $(this).closest(".big_circle_plus_outer").hide();
        $(this).closest(".big_list_add_outer_main").find(".big_circle_fb_outer").show();
    });
    $('body').on('click', '.big_circle_fb', function() {
        $(this).closest(".big_circle_fb_outer").find(".big_circle_fb_list").toggle();
        $(this).closest(".big_circle_fb_outer").closest('.big_list_add_outer_main').siblings().find('.big_circle_fb_list').slideUp();
    });
</script>