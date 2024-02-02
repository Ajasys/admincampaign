<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php
$userUnderEmployee = userUnderEmployee($_SESSION['id']);

?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="title-1 mb-3">
                <h2>User Activity</h2>
            </div>
        </div>
        <div class="row px-2">
            <div class="col-xl-6 col-lg-6 col-md-6 mb-2">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>follow ups(<span id="followup_row_count">1</span>)</h6>
                </div>
                <div class="col-12 mb-2">
                    <div class="d-flex">
                        <div class="col-lg-6 col-md-6 col-sm-6 px-1">
                            <input type="text" class="max-date form-control main-control input-main date_dashboard "
                                placeholder="DD/MM/YYYY" id="date_dashboard" name="date_dashboard" value="" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 px-1">
                            <div class="main-selectpicker">
                                <select id="followup_user_list" name="followup_user_list"
                                    class="selectpicker form-control form-main followup_user_list"
                                    data-live-search="true" required="">
                                    <option class="dropdown-item" value="0">Select employee</option>
                                    <?php if (!empty($userUnderEmployee)) {
                                        foreach ($userUnderEmployee as $key => $user_valuess) { ?>
                                            <option class="dropdown-item" data-sourcetype_name="employee"
                                                value="<?php echo $user_valuess['user_id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo $user_valuess['user_role']; ?>)
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="follow-p overflow-auto" id="followup_content" style="height: 476px;"></ul>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 mb-2 ps-2">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>activity logs(<span id="activity_row_count">2</span>)</h6>
                </div>
                <div class="col-12 mb-2">
                    <div class="d-flex">
                        <div class="col-lg-6 col-md-6 col-sm-6 px-1">
                            <input type="text"
                                class="max-date form-control main-control input-main date_activity_dashboard"
                                placeholder="DD/MM/YYYY" id="date_activity_dashboard" name="date_activity_dashboard"
                                value="" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 px-1">
                            <div class="main-selectpicker">
                                <select id="activity_user_list" name="activity_user_list"
                                    class="selectpicker form-control form-main activity_user_list"
                                    data-live-search="true" required="">
                                    <option class="dropdown-item" value="0">Select employee</option>
                                    <?php if (!empty($userUnderEmployee)) {
                                        foreach ($userUnderEmployee as $key => $user_valuess) { ?>
                                            <option class="dropdown-item" data-sourcetype_name="employee"
                                                value="<?php echo $user_valuess['user_id']; ?>"><?php echo $user_valuess['firstname']; ?>(<?php echo $user_valuess['user_role']; ?>)
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="activity-ul overflow-auto" id="activity_content" style="height:476px;">
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $(".max-date").bootstrapMaterialDatePicker({
        maxDate: new Date(),
        format: 'DD-MM-YYYY',
        cancelText: 'cancel',
        okText: 'ok',
        clearText: 'clear',
        time: false,
    });

    $(document).ready(function () {

        $("body").on('change', '#activity_user_list', function (e) {
            get_activity_data();
        });
        $("body").on('change', '#date_activity_dashboard', function (e) {
            get_activity_data();
        });

        function get_activity_data() {
            var date_activity_dashboard = $('#date_activity_dashboard').val();
            var activity_user_list = $('#activity_user_list').val();
            $('.loader').show();
            $.ajax({
                // datatype: 'json',
                method: "post",
                url: "<?= site_url('get_data_activity_tab_fresh'); ?>",
                data: {
                    'date_activity_dashboard': date_activity_dashboard,
                    'activity_user_list': activity_user_list,
                    'action': true
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    console.log(response);
                    if (response.result == 1) {
                        $('#activity_row_count').html(response.row_count);
                        $('#activity_content').html(response.activity_data_html);
                        $('.loader').hide();
                    } else {
                        $('#activity_row_count').html(response.row_count);
                        $('#activity_content').html(response.activity_data_html);
                        $('.loader').hide();
                    }
                },
                error: function (error) {
                    $('.loader').hide();
                }
            });
        }
        get_activity_data();

        $("body").on('change', '#date_dashboard', function (e) {
            get_followup_data();
        });

        $("body").on('change', '#followup_user_list', function (e) {
            get_followup_data();
        });

        function get_followup_data() {
            var date_dashboard = $('#date_dashboard').val();
            var followup_user_list = $('#followup_user_list').val();
            $('.loader').show();
            $.ajax({
                // datatype: 'json',
                method: "post",
                url: "<?= site_url('get_data_followup_tab_fresh'); ?>",
                data: {
                    'date_dashboard': date_dashboard,
                    'followup_user_list': followup_user_list,
                    'action': true
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.result == 1) {
                        $('#followup_row_count').html(response.row_count);
                        $('#followup_content').html(response.followup_data_html);
                        $('.loader').hide();
                    } else {
                        $('#followup_row_count').html(response.row_count);
                        $('#followup_content').html(response.followup_data_html);
                        $('.loader').hide();
                    }

                },
                error: function (error) {
                    $('.loader').hide();
                }
            });
        }

        get_followup_data();


    });
</script>