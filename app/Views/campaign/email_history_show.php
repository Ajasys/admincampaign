<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<style>
    /* .message_show_td p:last-child {
        color: black;
        text-wrap: nowrap;
        width: 200px;
        height: 50px;
        margin-top: -20px;
        text-overflow: ellipsis;
        overflow: hidden;
        transition: 0.5s;
    }

    #full_message_show tr .message_show_td p:hover {
        width: auto;
        height: auto;
        text-overflow: clip;
        overflow-y: scroll;
    } */
</style>

<div class="main-dashbord p-2">

    <div class="d-flex align-items-center title-1 mb-2">
        <i class="bi bi-gear-fill"></i>
        <h2>Email Conversions Details</h2>
    </div>

    <div class="container-fluid rounded-1">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 overflow-x-scroll scroll-sm bg-white rounded-1 border p-2">
                <div class=" border-1">
                    <div class="table">
                        <tr>
                            <h2 style="background-color: #D8D7FF; font-size: 14px; " class="p-2 rounded-1"><b>Email Send List</b></h2>
                        </tr>

                    </div>
                    <table id="myTable" class="table-responsive table ">
                        <thead>
                            <tr>
                                <th class="w-20"> <span>From Email</span></th>
                                <th class="w-20"> <span>To Email</span></th>
                                <th class="w-20"> <span>Subject</span></th>
                                <th class="w-40"> <span>Message</span></th>
                            </tr>
                        </thead>

                        <tbody id="full_message_show">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-0 mt-xxl-0">
                <div class="row">
                    <div class="rounded-1">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 bg-white rounded-1 border">
                            <div class="rounded-1">
                                <div class="p-2">
                                    <div class="title-2">
                                        <h2 style="background-color: #D8D7FF; font-size: 14px;" class="p-2 rounded-1"><b>Email Tracking</b></h2>
                                    </div>
                                    <table id="myTable_op" class="table-responsive table ">
                                        <thead>
                                            <tr>
                                                <th class=""> <span>Status</span></th>
                                                <th class=""> <span>Open Datetime</span> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="demo_list_data">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 bg-white rounded-1 border mt-2">
                            <div class="rounded-1">
                                <div class="p-2">
                                    <div class="title-2">
                                        <h2 style="background-color: #D8D7FF; font-size: 14px;" class="p-2 rounded-1"><b>Link Tracking</b></h2>
                                    </div>
                                    <table id="myTable_link" class="table-responsive table">
                                        <thead>
                                            <tr>
                                                <th class=""> <span>Link</span></th>
                                                <th class=""> <span>Open Datetime</span> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="link_list_data">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




</div>



<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    function show_data_email() {
        // $('.Lead_Quality_Report .loader').show();
        $.ajax({
            type: 'post',
            url: '<?= base_url('show_data_email') ?>',
            data: {
                email_trac_id: '<?php echo $_GET['email_track_id']; ?>',
                email_track_link: '<?php echo $_GET['email_track_link']; ?>',

            },
            success: function(res) {
                var result = JSON.parse(res);
                $('.loader').hide();
                $('#demo_list_data').html(result.html);
                $('#link_list_data').html(result.html_link);
                $('#full_message_show').html(result.full_message_show);
            }
        });
    }
    show_data_email();
</script>

<!-- <script>
    $(document).ready(function() {
        $('.message_show_td p').children('br').addClass('d-none');
    })
</script> -->