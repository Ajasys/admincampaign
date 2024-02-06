<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<!DOCTYPE html>
<html>

<head>
    <title>How to Track Email Open or not using PHP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    </style>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
    <div class="p-2 main-dashbord">
        <div class="bg-white p-2 rounded-2">
            <div class="title-2 mb-2">
                <h2>Email Send  List</h2>
            </div>
            <div class="overflow-x-scroll">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="25%">Email</th>
                            <th width="40%">Subject</th>
                            <th width="10%">Status</th>
                            <th width="15%">Open Datetime</th>
                            <th width="10%">See Details</th>
                        </tr>
                    </thead>


                    <tbody id="demo_list_data">

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</body>

</html>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    function email_send_list() {
        // $('.Lead_Quality_Report .loader').show();
        $.ajax({
            type: 'post',
            url: '<?= base_url('fetch_email_track_data') ?>',
            data: {

            },
            success: function(res) {
                var result = JSON.parse(res);
                $('.loader').hide();
                $('#demo_list_data').html(result.html);
            }
        });
    }
    email_send_list();
</script>