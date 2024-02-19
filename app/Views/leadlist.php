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
</style>

<?php
    $username = session_username($_SESSION['username']);
    $this->db = \Config\Database::connect('second');
    if (isset($_GET['id'])) {
        $get_pagename =  "SELECT * FROM admin_fb_pages  Where page_id=" . $_GET['id'] . "  ORDER BY id  ASC";
        $get_page = $this->db->query($get_pagename);
        $page = $get_page->getResultArray();
    }
?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="title-1">
                <?php if (isset($page[0]['page_name'])) { ?>
                    <h2><?php echo $page[0]['page_name']; ?></h2>
                <?php }
                else
                {
                    echo '<h2>Lead List</h2>';
                } ?>
            </div>
        </div>
        <div class="px-3 py-2 mx-2 bg-white rounded-2">
            <div class="w-100 overflow-x-auto scroll-small row_none">
                <div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
                    <div class="dataTables_length" id="project_length">
                        <label>
                            Show
                            <select name="project_length" id="project_length_show" aria-controls="project" class="table_length_select_check_2">
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
                        <div id="lead_filter" class="dataTables_filter justify-content-end d-flex py-1 py-sm-0">
                            <label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
                        </div>
                    </div>
                </div>
                <table id="leadTable" class="table main-table w-100">
                    <thead>
                        <tr>
                            <th class="p-2 text-nowrap"><span>Created Date </span></th>
                            <?php
                            if($_GET['platform']==5)//for website
                            {
                                    
                            } 
                            else
                            {
                                ?>
                                    <th class="p-2 text-nowrap"><span>Lead Id </span></th>
                                <?php
                            }
                            ?>
                            
                            <th class="p-2 text-nowrap"><span>Name </span></th>
                            <th class="p-2 text-nowrap "><span>Mobile Number </span></th>
                            <th class="p-2 text-nowrap "><span>Inquiry Id </span></th>
                            <th class="p-2 text-nowrap text-center"><span>Inquiry<br>Status </span></th>
                            <th class="p-2 text-nowrap text-center"><span>Lead<br>Status </span></th>
                            <th class="p-2 text-nowrap text-center"><span>Platform</span></th>
                        </tr>
                    </thead>
                    <tbody id="lead_list_data"></tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
                    <div class="row_count_div col-xl-6 col-12">
                        <p id="row_count"></p>
                    </div>
                    <div class="clearfix  col-xl-6 col-12">
                        <ul class="inq_pagination justify-content-xl-end" id="inq_pagination"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="lead_list_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Lead View</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" modal-body modal-body-secondery">
                <div class="modal-body-card">
                    <div class="row col-12">
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="add-user-input">
                                <label for="relation" class="form-label main-label fw-semibold">Inquiry Id
                                    :</label>
                                <span id="inquiry_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="name" class="form-label main-label fw-semibold">Name :</label>
                                <span id="full_name"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="form_id" class="form-label main-label fw-semibold">Form Id:</label>
                                <span id="form_id"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="campaign_id" class="form-label main-label fw-semibold">Campaign Id :</label>
                                <span id="campaign_id"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="adset_id" class="form-label main-label fw-semibold">Adset Id :</label>
                                <span id="adset_id"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="ad_id" class="form-label main-label fw-semibold">Ad Id :</label>
                                <span id="ad_id"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="add-user-input">
                                <label for="relation" class="form-label main-label fw-semibold">Platform
                                    :</label>
                                <span id="platform"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="em_mobile" class="form-label main-label fw-semibold">Mobile
                                    Number :</label>
                                <span id="mobile"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="form_name" class="form-label main-label fw-semibold">Form Name
                                    :</label>
                                <span id="form_name"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="campaign_name" class="form-label main-label fw-semibold">Campaign Name :</label>
                                <span id="campaign_name"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="adset_name" class="form-label main-label fw-semibold">Adset Name :</label>
                                <span id="adset_name"></span>
                            </div>
                            <div class="add-user-input detailDiv">
                                <label for="ad_name" class="form-label main-label fw-semibold">Ad Name :</label>
                                <span id="ad_name"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $(document).ready(function() {
        list_data();
    });
    $(".lead_list_table").DataTable({
        "ordering": false
    });
    $(".row_none").find(".row").addClass("d-flex flex-wrap w-100");
    $(".row_none").find(".row").removeClass("row");
    function list_data(table = 'integration', pageNumber = 1, perPageCount = '10', ajaxsearch = "", action = true) {
        var followupTime = '';
        perPageCount = $('#project_length_show').val();
        var data = {
            'table': table,
            'pageNumber': pageNumber,
            'perPageCount': perPageCount,
            'ajaxsearch': ajaxsearch,
            'action': action,
            'id':'<?php echo $_GET['id']?>',
            'platform':'<?php echo $_GET['platform']?>',
        };
        var processdd = true;
        var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
        var totalData = [];
        $.ajax({
            datatype: 'json',
            method: "POST",
            url: 'lead_list',
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
                    $('#lead_list_data').html(result.html);
                    $('.inq_pagination').twbsPagination({
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
    $('#lead_filter input[type="search"]').on('keyup', function(e) {
        if (e.which == 13) {
            $('.inq_pagination').twbsPagination('destroy');
            var input = $(this).val().toLowerCase();
            var table = $('#today-follow-feedback');
            var rows = table.find('tbody tr');
            list_data('integration', '', '', input);
        }
    });
    $('body').on('change', '#project_length_show', function() {
        $('.inq_pagination').twbsPagination('destroy');
        var perPageCount = $(this).val();
        list_data('integration', 1, perPageCount)
    });
    function viewLead(unquie_id) {
        $('.loader').show();
        $('#lead_list_modal').modal('show');
        $.ajax({
            method: "post",
            url: "<?= site_url('view_integrate_lead'); ?>",
            data: {
                'unquie_id': unquie_id,
            },
            success: function(res) {
                console.log(res);
                var response = JSON.parse(res);
                $('#exampleModalLabel').html('Lead Id : ' + response[0]['lead_id']);
                $('#full_name').html(response[0]['full_name']);
                $('#mobile').html(response[0]['phone_number']);
                $('#inquiry_id').html(response[0]['inquiry_id']);
                if(response[0]['platform']=='website')
                {
                    $('.detailDiv').hide();
                    $platform = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 508 508" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M254 0C146.7 0 0 81.1 0 254c0 168.5 141.1 254 254 254 193.7 0 254-169.7 254-254C508 129.6 412.8 0 254 0zm-58.9 23.9c-26.5 22.6-48.5 60-62.7 106.4-18.4-10.9-35.3-24.4-50.3-40.1 31-32.5 70.2-55.3 113-66.3zM71.2 102.4c16.8 17.5 35.9 32.4 56.7 44.2-7.8 30.3-12.4 63.9-13 99.2H16.6c1.8-52.7 21-103 54.6-143.4zm0 303.2c-33.7-40.4-52.8-90.7-54.6-143.4h98.3c.6 35.4 5.2 68.9 13 99.2-20.7 11.9-39.8 26.7-56.7 44.2zm10.9 12.3c15-15.7 31.9-29.2 50.3-40.1 14.2 46.3 36.2 83.8 62.7 106.4-42.8-11.1-82-33.9-113-66.3zM245.8 491c-42.6-5.4-79.3-53-99.1-121.2 30.6-15.5 64.4-24.2 99.1-25.5V491zm0-163c-36.2 1.2-71.4 10.1-103.3 25.7-6.7-28-10.7-58.9-11.3-91.5h114.6V328zm0-82.2H131.2c.6-32.6 4.6-63.5 11.3-91.5 32 15.6 67.2 24.5 103.3 25.7v65.8zm0-82.1c-34.8-1.2-68.5-10-99.1-25.5C166.5 69.9 203.2 22.4 245.8 17v146.7zm191-61.3c33.6 40.4 52.8 90.7 54.6 143.4h-98.2c-.6-35.4-5.2-68.9-13-99.2 20.7-11.9 39.8-26.7 56.6-44.2zm-10.9-12.3c-15 15.7-31.9 29.2-50.3 40.1-14.2-46.3-36.2-83.7-62.7-106.4 42.8 11.1 82 33.9 113 66.3zM262.2 17c42.6 5.4 79.3 53 99.1 121.2-30.6 15.5-64.3 24.2-99.1 25.5V17zm0 163c36.2-1.2 71.4-10.1 103.3-25.7 6.7 28 10.7 58.9 11.3 91.5H262.2V180zm0 82.2h114.6c-.6 32.6-4.6 63.5-11.3 91.5A251.24 251.24 0 0 0 262.2 328v-65.8zm0 228.8V344.3c34.8 1.2 68.5 10 99.1 25.5-19.8 68.3-56.5 115.8-99.1 121.2zm50.7-6.9c26.5-22.6 48.5-60 62.7-106.4 18.4 10.9 35.3 24.4 50.3 40.1-31 32.5-70.2 55.3-113 66.3zm123.9-78.5c-16.8-17.5-35.9-32.3-56.6-44.2 7.8-30.3 12.4-63.9 13-99.2h98.2c-1.8 52.7-21 103-54.6 143.4z" fill="#000000" opacity="1" data-original="#000000" class=""></path></g></svg>';
                }
                else if(response[0]['platform']=='ig')
                {
                    $('.detailDiv').show();
                    $platform = '<i class="fa-brands fa-instagram transition-5 icon1" style="background: -webkit-linear-gradient(#f32170, #ff6b08, #cf23cf, #eedd44);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>';
                }
                else
                {
                    $('.detailDiv').show();
                    $platform = '<i class="fa-brands fa-facebook transition-5 icon2 rounded-circle" style="color: #0b85ed;"></i>';
                }
                $('#platform').html($platform);

                $('#campaign_name').html(response[0]['campaign_name']);
                $('#form_id').html(response[0]['form_id']);
                $('#form_name').html(response[0]['form_name']);
                $('#ad_id').html(response[0]['ad_id']);
                $('#campaign_id').html(response[0]['campaign_id']);
                $('#ad_name').html(response[0]['ad_name']);
                $('#adset_id').html(response[0]['adset_id']);
                $('#adset_name').html(response[0]['adset_name']);

                $('.loader').hide();
            },
            error: function(error) {
                $('.loader').hide();
            }
        });
    }
</script>