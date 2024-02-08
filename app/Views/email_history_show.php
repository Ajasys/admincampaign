<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="main-dashbord p-2">
    <table id="myTable" class="table-responsive table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center"> <span>From Email</span></th>
                <th class="text-center"> <span>To Email</span></th>
                <th class="text-center"> <span>Subject</span></th>
                <th class="text-center"> <span>Message</span></th>
            </tr>
        </thead>
        <tbody id="full_message_show">
        </tbody>
    </table>


    <table id="myTable_op" class="table-responsive table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center"> <span>Status</span></th>
                <th class="text-center"> <span>Open Datetime</span> </th>
            </tr>
        </thead>
        <tbody id="demo_list_data">
        </tbody>
    </table>

    <table id="myTable_link" class="table-responsive table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center"> <span>link</span></th>
                <th class="text-center"> <span>Open Datetime</span> </th>
            </tr>
        </thead>
        <tbody id="link_list_data">
        </tbody>
    </table>
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