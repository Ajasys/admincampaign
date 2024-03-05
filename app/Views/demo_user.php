<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    .approve {
        background-color: #f2b600;
    }
</style>
<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
$product = json_decode($product, true);
?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between">
                <div class="title-1 d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <h2>Subscriptions</h2>
                </div>
                <div class="user-list-btn">
                    <?php if (in_array('subscription_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <button id="deleteButton" class="btn-primary-rounded hide" style="display: none;"><i
                                class="fi fi-rr-trash"></i></button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="px-0 px-sm-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <!-- data -->
            <div class="navigation col-12 overflow-auto my-2 product_tab">
                <ul class="d-flex navtab_primary_sm w-100 flex-xl-wrap flex-nowrap" id="status-main-tab">
                    <?php
                    if (!empty($product)) {
                        $inqriment = 1;
                        foreach ($product as $inq_status_key => $inq_status_value) {
                            ?>
                            <li class="nav-item">
                                <button class="nav-link text-nowrap product_id pr_<?php echo $inqriment ?>"
                                    data-id="<?php echo $inq_status_value['id']; ?>">
                                    <?php echo $inq_status_value['product_name']; ?>
                                </button>
                            </li>
                            <?php
                            $inqriment++;
                        }
                    }
                    ?>
                </ul>
            </div>
            <table id="leave_data" class="table main-table w-100">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all" />
                        </th>
                        <th>
                            <span>Subscriptions</span>
                        </th>
                    </tr>
                </thead>
                <tbody id="all_user_list" class="all_user_list"></tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
                <div class="row_count_div col-xl-6 col-xxs-12">
                    <p id="row_count"></p>
                </div>
                <div class="clearfix  col-xl-6 col-xxs-12">
                    <ul class="inq_pagination justify-content-xl-end" id="inq_pagination">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Add_all_user" tabindex="-1" aria-labelledby="exampleModalToggleLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">User Management</h1>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body modal-body-secondery">
                <form name="subscribtion_updatee_formm" class="col-12  needs-validation" novalidate>
                    <div class="modal-body-card">
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="name" class="form-label main-label">Name</label>
                            <input type="text" class="form-control main-control" name="name" id="name" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="username" class="form-label main-label">username</label>
                            <input type="text" class="form-control main-control pan_number_valid_formate" id="username"
                                name="username" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="mobile" class="form-label main-label">Mobile</label>
                            <input type="text" class="form-control main-control" minlength="9" maxlength="10"
                                id="mobile" name="mobile" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="email" class="form-label main-label">Email</label>
                            <input type="email" class="form-control main-control" name="email" id="email" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="text" class="form-label main-label">Plan Name</label>
                            <div class="main-selectpicker">
                                <select class="selectpicker form-control main-control form-main" id="plan_name"
                                    name="plan_name" data-live-search="true" required="">
                                    <option value="" data-plan_price="0">Select Product Plan</option>
                                    <?php
                                    $subscription_data = "SELECT * FROM admin_subscription_master";
                                    $dataBs = \Config\Database::connect('second');
                                    $result = $dataBs->query($subscription_data);
                                    $result = $result->getResultArray();
                                    foreach ($result as $key => $value) {
                                        if($value['crm'] == 1)
                                        {
                                            $productname = 'RealToSmart';
                                        }
                                        if($value['crm'] == 2)
                                        {
                                            $productname = 'GymSmart';
                                        }
                                        if($value['crm'] == 3)
                                        {
                                            $productname = 'Leadmgtcrm';
                                        }
                                        echo '<option value="' . $value['id'] . '" data-plan_price="' . $value['plan_price'] . '" data-add_on_user="' . $value['user'] . '">' . $value['plan_name'] .'('.$productname.')'. '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="total_amount" class="form-label main-label">Total Amount</label>
                            <input type="text" class="form-control main-control" name="total_amount" id="total_amount"
                                required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="subcription_date" class="form-label main-label">Subcription Date</label>
                            <input type="text" class="form-control main-control subcription_date"
                                name="subcription_date" id="subcription_date" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="subcription_date" class="form-label main-label">Subcription End Date</label>
                            <input type="text" class="form-control main-control subcription_end_date"
                                name="subcription_end" id="subcription_end" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="staff" class="form-label main-label"> Staff</label>
                            <input type="text" class="form-control main-control user_valid" name="user_valid"
                                id="user_valid" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="addon_user" class="form-label main-label">Addon Staff</label>
                            <input type="text" class="form-control main-control addon_user" name="addon_user"
                                id="addon_user" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="addon_staff_price" class="form-label main-label">Addon Staff Price</label>
                            <input type="text" class="form-control main-control " name="user_price" id="user_price"
                                required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="plan_price" class="form-label main-label">Plan Price</label>
                            <input type="text" class="form-control main-control " name="price" id="price" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="gst" class="form-label main-label">Gst</label>
                            <input type="text" class="form-control main-control " name="gst" id="gst" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="invoice_id" class="form-label main-label">Invoice Id</label>
                            <input type="text" class="form-control main-control " name="invoice_id" id="invoice_id">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 d-flex justify-content-end mt-2 pe-2 user-btn-view">
                    <input type="hidden" id="">
                    <button data-edit_id="" type="submit" class="btn-primary subscribtion_update" data-edit_id=""
                        data-master_id="" name="subscribtion_update" id="subscribtion_update"> submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="all_user_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
        <div class="modal-content">
            <form class="needs-validation" name="project_update_form" method="POST" action="">
                <div id="modal-code" class="modal-header">
                    <h1 class="modal-title">Subcription information</h1>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-secondery" id="assign-pages">
                    <div class="modal-body-card">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Full name :</label>
                            <span class="form-inform" id="name"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Username :</label>
                            <span class="form-inform" id="username"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Mobile No :</label>
                            <span class="form-inform" id="mobile"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Email :</label>
                            <span class="form-inform" id="email"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Plan Name :</label>
                            <span class="form-inform" id="plan_name"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Payment Status :</label>
                            <span class="form-inform" id="payment_status"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Subcription Date :</label>
                            <span class="form-inform" id="subcription_date"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                            <label class="form-label1">Subcription End :</label>
                            <span class="form-inform" id="subcription_end"></span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="password" class="form-label">Password :</label>
                            <div class="custom_daaa d-flex flex-wrap">
                                <div class="pass_field col-5 col-xxs-12 col-md-7 col-lg-9">
                                    <div class="d-flex flex-wrap">
                                        <input type="text"
                                            class="form-control main-control  password m-1 col-xxs-12 col-lg-8 col-xl-9 col-xxl-8`"
                                            value="" placeholder="Password" id="password">
                                        <button class=" btn-primary padding-size m-1 w-lg-50 col-xxs-12"
                                            id="set_passsword" data-edit_id="">Set
                                            Password</button>
                                    </div>
                                </div>
                                <div class="view-password-right ps-2">
                                    <button class=" btn-primary padding-size m-1 col-xxs-12" id="cre_passsword"
                                        data-user_id="">Create
                                        Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="modal-body-title">Pricing Detail</h6>
                    <div class="modal-body-card ">
                        <div class="row d-flex p-2 m-0 ">
                            <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                                <label class="form-label1">Addon Staff :</label>
                                <span class="form-inform" id="addon_user"></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                                <label class="form-label1">Staff :</label>
                                <span class="form-inform" id="user_valid"></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                                <label class="form-label1">Addon Staff Price :</label>
                                <span class="form-inform" id="user_price"></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                                <label class="form-label1">Plan Price :</label>
                                <span class="form-inform" id="price"></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                                <label class="form-label1">Gst(18%) :</label>
                                <span class="form-inform" id="gst"></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-1">
                                <label class="form-label1">Total Amount :</label>
                                <span class="form-inform" id="total_amount"></span>
                            </div>
                        </div>
                    </div>
                    <div class="upgrade_plan">
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if (in_array('subscription_information_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <a href="#" class="btn-primary-rounded edt">
                            <i class="fas fa-pencil-alt" data-edit_id="" data-bs-toggle="modal"
                                data-bs-target="#Add_all_user"></i>
                        </a>
                    <?php } ?>
                    <?php if (in_array('subscription_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <div class="delete_main">
                            <div class="delete_btn_1 btn-primary w-100 text-center">Delete</div>
                            <div class="btn-secondary px-3 dlt" data-delete_id="">Really?</div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
<!--<div class="modal fade" id="master_subscribtion_pdf_view" tabindex="-1" aria-labelledby="exampleModalLabel"-->
<!--   aria-hidden="true">-->
<!--   <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">-->
<!--      <div class="modal-content">-->
<!--         <form class="needs-validation" name="project_update_form" method="POST" action="">-->
<!-- modal-heading-start -->
<!--            <div id="modal-code" class="modal-header modal-headerr pt-2 pb-2">-->
<!--               <div class="col-lg-11 col-md-11 col-sm-11 d-flex builder1 ">-->
<!--                  <h6 class="aman  pt-1">Master View information</h6>-->
<!--               </div>-->
<!--               <div class=" col-lg-1 col-md-1 col-sm-1 buttons">-->
<!--                  <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i-->
<!--                        class="bi bi-x-circle"></i></button>-->
<!--               </div>-->
<!--            </div>-->
<!-- modal-heading-end -->
<!-- mpdal-body-start -->
<!--            <div class="modal-body modal-body-1 p-2" id="assign-pages">-->
<!--               <embed src="" type="" class="w-100" height="600">-->
<!--            </div>-->
<!--         </form>-->
<!--      </div>-->
<!--   </div>-->
<!--</div>-->
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    function myFunction() {
        //   var  date = new Date();
        //     date.setDate(date.getDate() + 1);
        $(".subcription_date").bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        }).on('change', function (e, date) {
            var nextDay = new Date(date);
            nextDay.setDate(nextDay.getDate() + 1);
            $('.subcription_end_date').bootstrapMaterialDatePicker('setMinDate', nextDay);
        });
        $('.subcription_end_date').bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY ',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });
    }
    $(document).ready(function () {
        // var  date = new Date();
        // date.setDate(date.getDate() + 1);
        $(".subcription_date").bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        }).on('change', function (e, date) {
            var nextDay = new Date(date);
            nextDay.setDate(nextDay.getDate() + 1);
            $('.subcription_end_date').bootstrapMaterialDatePicker('setMinDate', nextDay);
        });
        $('.subcription_end_date').bootstrapMaterialDatePicker({
            minDate: new Date(),
            format: 'DD-MM-YYYY',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: false,
        });
        function list_data(product_id = 1) {
            $('.loader').show();
            $.ajax({
                datatype: 'json',
                method: "post",
                url: "<?= site_url('user_data'); ?>",
                data: {
                    table: 'paydone_data',
                    'action': true,
                    'product_id': product_id,
                },
                success: function (res) {
                    $('.loader').hide();
                    $('#all_user_list').html(res);
                }
            });
            $('.loader').hide();
        }
        list_data();
        $(".pass_field").hide();
        $("body").on('click', '#set_passsword', function (password) {
            var update_id = $(this).attr("data-edit_id");
            var password = $(".password").val();
            // console.log(password);
            $.ajax({
                url: "<?= site_url('subscribtion_set_password'); ?>",
                type: 'post',
                data: {
                    update_id: update_id,
                    table: 'paydone_data',
                    password: password,
                },
                success: function (data) {
                    sweet_edit_sucess('Update successfully');
                    $('.pass_field').hide();
                    $('.modal-close-btn').trigger('click');
                    // location.reload(true);
                }
            });
            return false;
        });
        $('.pr_1').trigger('click');
        $('.product_id').on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            list_data(id);
        })
        $("body").on('click', '#cre_passsword', function (e) {
            $(".pass_field").toggle();
            if ($(".pass_field").css('display') != 'none') {
                var user_id = $(this).attr("data-user_id");
                var password = $("#all_user_view #password").val();
                //$('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('subscribtion_get_password'); ?>",
                    data: {
                        action: 'get_password',
                        user_id: user_id,
                        password: password,
                        table: 'paydone_data'
                    },
                    success: function (res) {
                        var result = JSON.parse(res);
                        if (result.response == 1) {
                            $('#all_user_view #password').val(result.password);
                        } else {
                            $('#all_user_view #password').val('');
                        }
                        $('.loader').hide();
                    },
                });
                return false;
            }
        });
        // view data 
        $('body').on('click', '.all_user_view', function (e) {
            // alert();
            $('.pass_field').hide();
            e.preventDefault();
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-view_id");
            var master_id = $(this).attr("data-master_id");
            // console.log(edit_value);
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('user_data_view'); ?>",
                    data: {
                        action: 'view',
                        view_id: edit_value,
                        master_id: master_id,
                        table: 'paydone_data'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        var response = JSON.parse(res);
                        // $('.edt').attr('data-edit_id', response[0].id);
                        $('.dlt').attr('data-delete_id', response[0].id);
                        $('#all_user_view #name').text(response[0].name);
                        $('#all_user_view #username').text(response[0].username);
                        $('#all_user_view #mobile').text(response[0].mobile);
                        $('#all_user_view #email').text(response[0].email);
                        $('#all_user_view #plan_name').text(response.plan_name);
                        $('#all_user_view #total_amount').text(response[0].total_amount);
                        $('#all_user_view #price').text(response[0].price);
                        $('#all_user_view #user_price').text(response[0].user_price);
                        $('#all_user_view #gst').text(response[0].gst);
                        $('#all_user_view #subcription_date').text(response.subcription_date_india);
                        $('#all_user_view #subcription_end').text(response.subcription_end_india);
                        $('#all_user_view #addon_user').text(response[0].addon_user);
                        $('#all_user_view #user_valid').text(response[0].user_valid);

                        if (response[0].resutlll != "") {
                            $('.upgrade_plan').html(response.resutlll);
                        } else {
                            $('.upgrade_plan').html("");
                        }
                        if (response[0].password != "") {
                            $("#set_passsword").text("Reset password");
                            $("#cre_passsword").text("View Password");
                        } else {
                            $("#cre_passsword").text("create Password");
                        }
                        $('#all_user_view .edt').attr('data-edit_id', response.view_idd);
                        if (response[0].status == 1) {
                            $('#all_user_view #payment_status').text("Paid");
                        } else {
                            $('#all_user_view #payment_status').text("Pending");
                        }
                        $('#set_passsword').attr('data-edit_id', response[0].id);
                        $('#cre_passsword').attr('data-user_id', response[0].id);
                        // $('.appoorve_data').html(response.ssss);
                    },
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });
        $(".pass_field").hide();
        // edit data 
        $('.pr_1').addClass('active');
        $('.product_tab .nav-link').on('click', function () {
            $('.product_tab').find('.active').removeClass('active');
            $(this).addClass('active');
        });
        $('body').on('click', '.edt', function (e) {
            //$('.project_drop').hide();
            // alert("hl");
            e.preventDefault();
            $('.selectpicker').selectpicker('refresh');
            var self = $(this).closest("tr");
            var edit_value = $(this).attr("data-edit_id");
            // console.log(edit_value);
            if (edit_value != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('subscription_edit'); ?>",
                    data: {
                        action: 'edit',
                        edit_id: edit_value,
                        table: 'paydone_data'
                    },
                    success: function (res) {
                        $('.loader').hide();
                        $('.selectpicker').selectpicker('refresh');
                        var response = JSON.parse(res);
                        // $('.dlt').attr('data-delete_id', response.id);
                        $('.subscribtion_update').attr('data-edit_id', response.id);
                        $('.subscribtion_update').attr('data-master_id', response.master_id);
                        $('#Add_all_user #name').val(response.name);
                        $('#Add_all_user #username').val(response.username);
                        $('#Add_all_user #email').val(response.email);
                        $('#Add_all_user #plan_name').val(response.plann_namee);
                        $('#Add_all_user #mobile').val(response.mobile);
                        $('#Add_all_user #total_amount').val(response.total_amount);
                        // $('#Add_all_user #plan_name').val(response.plan_name);
                        // if (response.status == 1) {
                        //     $('#Add_all_user #payment_status').val("Paid");
                        // } else {
                        //     $('#Add_all_user #payment_status').val("Pending");
                        // }
                        // $('#Add_all_user #leave_reason').val(response.leave_reason);
                        $('#Add_all_user #subcription_date').val(response.subcription_date_india);
                        $('#Add_all_user #subcription_end').val(response.subcription_end_india);
                        $('#Add_all_user #addon_user').val(response.addon_user);
                        $('#Add_all_user #user_price').val(response.user_price);
                        $('#Add_all_user #price').val(response.price);
                        $('#Add_all_user #gst').val(response.gst);
                        $('#Add_all_user #user_valid').val(response.user_valid);
                        $('#Add_all_user #invoice_id').val(response.invoice_id);
                        // $('#Add_all_user #in_absemnt').val(response.in_absemnt);
                        // // var inabsent_who_work = $("#in_absemnt").val();
                        // $('.btn-close').click(function() {
                        //     $('form[name="leave_insert"]')[0].reset();
                        //     $('.selectpicker').selectpicker('refresh');
                        // });
                        $('.selectpicker').selectpicker('refresh');
                    },
                    error: function (error) {
                        $('.loader').hide();
                    }
                });
            } else {
                $('.loader').hide();
                alert("Data Not Edit.");
            }
        });
        // new update
        $("#Add_all_user").on('click', '.subscribtion_update', function (e) {
            // alert("hello");
            event.preventDefault();
            var id = $(this).attr('data-edit_id');
            // console.log(id)
            var name = $('#Add_all_user #name').val();
            var username = $('#Add_all_user #username').val();
            var email = $('#Add_all_user #email').val();
            var plan_name = $('#Add_all_user #plan_name').val();
            var mobile = $('#Add_all_user #mobile').val();
            var total_amount = $('#Add_all_user #total_amount').val();
            // var payment_status = $('#Add_all_user #payment_status').val();
            var leave_reason = $('#Add_all_user #leave_reason').val();
            var subcription_date = $('#Add_all_user #subcription_date').val();
            var subcription_end_date = $('#Add_all_user #subcription_end_date').val();
            var addon_user = $('#Add_all_user #addon_user').val();
            var addon_staff_price = $('#Add_all_user #addon_staff_price').val();
            var plan_price = $('#Add_all_user #plan_price').val();
            var gst = $('#Add_all_user #gst').val();
            var invoice_id = $('#Add_all_user #invoice_id').val();
            var user_valid = $('#Add_all_user #user_valid').val();
            var form = $('form[name="subscribtion_updatee_formm"]')[0];
            var formdata = new FormData(form);
            // console.log(formdata);
            formdata.append('table', 'paydone_data');
            formdata.append('action', 'update');
            formdata.append('id', id);
            $('.loader').show();
            if (name != "" && username != "" && email != "" && plan_name != "" && mobile != "" && total_amount != "" && leave_reason != "" && subcription_date != "" && subcription_end_date != "" && addon_user != "" && addon_staff_price != "" && plan_price != "" && gst != "") {
                $.ajax({
                    method: "POST",
                    url: "<?= site_url('subscription_update'); ?>",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (dataResult) {
                        if (dataResult != "error") {
                            $('.loader').hide();
                            // $('.department_list').html(dataResult);
                            list_data();
                            $(".modal-close-btn").trigger("click");
                            $("form[name='subscribtion_updatee_formm']").removeClass("was-validated");
                            iziToast.success({
                                title: 'Update Successfully'
                            });
                        } else {
                            $('.loader').hide();
                            iziToast.error({
                                title: 'Duplicate Data Not Valid'
                            });
                        }
                    }
                });
            } else {
                $('.loader').hide();
                // alert("hello");
                $("form[name='subscribtion_updatee_formm']").addClass("was-validated");
            }
        });

        $('body').on('click', '.approve', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var master_id = $(this).attr("data-master_id");
            if (master_id == "" || master_id == 0) {
                action = "edit"
            } else {
                action = "update"
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Decline!',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ms-2 mt-2',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    if (id != "") {
                        $('.loader').show();
                        $.ajax({
                            type: "post",
                            url: "<?= site_url('updatedata_approve'); ?>",
                            data: {
                                action: action,
                                id: id,
                                master_id: master_id,
                                table: 'paydone_data',
                            },
                            success: function (res) {
                                $('.loader').hide();
                                list_data();
                                if (res == 1) {
                                    iziToast.success({
                                        title: 'Approve  Successfully'
                                    });
                                }
                            },
                            error: function (error) {
                                $('.loader').hide();
                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    if (id != "") {
                        $('.loader').show();
                        $.ajax({
                            type: "post",
                            url: "<?= site_url('updatedata_approve'); ?>",
                            data: {
                                action: "Decline",
                                id: id,
                                master_id: master_id,
                                table: 'paydone_data',
                            },
                            success: function (res) {
                                $('.loader').hide();
                                list_data();
                                if (res == 1) {
                                    iziToast.success({
                                        title: 'Decline  Successfully'
                                    });
                                }
                            },
                            error: function (error) {
                                $('.loader').hide();
                            }
                        });
                    }
                }
            });
        });

        $('body').on('click', '.suspened', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var master_id = $(this).attr("data-master_id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, suspend it!',
                cancelButtonText: 'Decline!',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ms-2 mt-2',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    if (id != "") {
                        $('.loader').show();
                        $.ajax({
                            type: "post",
                            url: "<?= site_url('updatedata_suspend'); ?>",
                            data: {
                                action: "edit",
                                id: id,
                                master_id: master_id,
                                table: 'paydone_data',
                            },
                            success: function (res) {
                                $('.loader').hide();
                                list_data();
                                if (res == 1) {
                                    iziToast.success({
                                        title: 'Suspend  Successfully'
                                    });
                                }
                            },
                            error: function (error) {
                                $('.loader').hide();
                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    if (id != "") {
                        $('.loader').show();
                        $.ajax({
                            type: "post",
                            url: "<?= site_url('updatedata_suspend'); ?>",
                            data: {
                                action: "Decline",
                                id: id,
                                master_id: master_id,
                                table: 'paydone_data',
                            },
                            success: function (res) {
                                $('.loader').hide();
                                list_data();
                                if (res == 1) {
                                    iziToast.success({
                                        title: 'Decline  Successfully'
                                    });
                                }
                            },
                            error: function (error) {
                                $('.loader').hide();
                            }
                        });
                    }
                }
            });
        });

        $('body').on('click', '.dlt', function (e) {
            // alert("hello");
            e.preventDefault();
            var self = $(this).closest("tr");
            var id = $(this).attr('data-delete_id');
            if (id != "") {
                $('.loader').show();
                $.ajax({
                    type: "post",
                    url: "<?= site_url('userdemo_delete'); ?>",
                    data: {
                        action: 'delete',
                        id: id,
                        table: 'paydone_data',
                    },
                    success: function (res) {
                        $('.loader').hide();
                        $(".modal-close-btn").trigger("click");
                        list_data();
                        iziToast.delete({
                            title: 'Delete successfully'
                        });
                    },
                    error: function (error) {
                        $('.loader').hide();
                    }
                });
            }
        });
    });
    $(document).ready(function () {
        // $('#leave_data').DataTable();
        function checkIfAnyCheckboxChecked(inputid, deletebtn) {
            if ($(inputid + ':checked').length > 0) {
                // alert();
                deletebtn.show();
            } else {
                // alert();
                deletebtn.hide();
            }
        }
        $('#deleteButton').hide();
        $(".user-table").on('click', 'input[type="checkbox"]', function () {
            var deletebtn = $("#deleteButton");
            var input = ".cstm-check";
            checkIfAnyCheckboxChecked(input, deletebtn);
        });

        
            $('body').on('click', '.invoice-pdf', function (e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= site_url('gym_pdf'); ?>",
                data: {
                    
                },
                
            });
        });
    });
</script>