<!-- pre($user_table); -->
<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<?php
$user_data = $_SESSION;
?>
<div class="main-dashbord p-3">
    <div class="container-fluid mt-2">
        <div class="modal-header pt-2 pb-2">
            <div class="title-1 d-flex">
                <i class="fa-solid fa-user me-2"></i>
                <h2>User Profile</h2>
            </div>
            <button type="button" class="btn-primary" id="change_pass" data-bs-toggle="modal"
                data-bs-target="#profile_edit" data-edit_id="<?= $_SESSION['id'] ?>">Change
                Password</button>
        </div>
        <div class="container profile_body pt-1">
            <div class="row">
                <!-- <form action="" class=""> -->
                <div class="row">
                    <!-- <div class="col-7 px-3"> -->
                    <div class="col-12 mt-3">
                        <div class="card p-3 border-0 card-main3 shadow-lg">
                            <div class="row modal-header g-2 d-flex p-1">
                                <div class="">
                                    <h5 class="mb-3">Detail</h5>
                                </div>
                            </div>
                            <div class="row g-2 d-flex p-1">
                                <div class="col-12 col-md-9 d-flex flex-wrap order-1 order-md-0">
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="firstname" class="main-label">Name :</label>
                                            <span class="filds" id="firstname">
                                                <?php
                                                // $username = '';
                                                // if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                                                //     if (isset($_SESSION['name'])) {
                                                //         $username = $user_data['name'];
                                                //     }
                                                // } else {
                                                //     if (isset($_SESSION['firstname'])) {
                                                //         $username = $user_data['firstname'];
                                                //     }
                                                
                                                // }
                                                // echo $username;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="phone" class="main-label">User Name :</label>
                                            <span class="filds" id="user_name">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="phone" class="main-label">Mobile No :</label>
                                            <span class="filds" id="mobile">
                                                <?php
                                                // $mobile = '';
                                                // if (isset($user_data['admin']) && $user_data['admin'] == 1) {
                                                //     if (isset($user_data['name'])) {
                                                //         $mobile = $user_data['mobile'];
                                                //     }
                                                // } else {
                                                //     if (isset($user_data['phone'])) {
                                                //         $mobile = $user_data['phone'];
                                                //     }
                                                
                                                // }
                                                // echo $mobile;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="email" class="main-label">E-mail :</label>
                                            <span class="filds" id="email">
                                            </span>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($user_data['admin']) && $user_data['admin'] == 1) {

                                    } else {
                                        ?>
                                        <div class="col-lg-6 col-12">
                                            <div class="add-user-input">
                                                <label for="head" class="main-label">Head :</label>
                                                <span class="filds" id="head">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="add-user-input">
                                                <label for="address" class="main-label">Address :</label>
                                                <span class="filds" id="address">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="add-user-input">
                                                <label for="dob" class="main-label">Dob :</label>
                                                <span class="filds" id="dob">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="add-user-input">
                                                <label for="dob" class="main-label">Join Date :</label>
                                                <span class="filds" id="join_date">
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-12 col-md-3 d-flex order-0 order-md-1 flex-wrap">
                                    <form action="" name="profile_pic" method="post" enctype="multipart/form-data">
                                        <div class="avatar-upload avatar-preview mx-auto">
                                            <img src="<?= base_url('assets/images/h-user-theme-m.svg') ?>" alt=""
                                                class="rounded-pill profile-pic" id="imagePreview">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="profile_pic"
                                                    accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload"></label>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-2">
                                            <button class="btn-primary" data-user_id="<?php echo $_SESSION['id'] ?>"
                                                id="file_upload" name="file_upload" value="file_upload"
                                                style="pointer-events: none" disabled>submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($user_data['admin']) && $user_data['admin'] == 1) {

                    } else {
                        ?>
                        <div class="col-12 mt-3">
                            <div class="card card-main3 p-3 border-0 shadow-lg">
                                <h5 class="mb-3">Emergency contact</h5>
                                <div class="row g-2 d-flex">
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="em_name" class="main-label">Name :</label>
                                            <span class="filds" id="em_name">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="relation" class="main-label">Relation :</label>
                                            <span class="filds" id="relation">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="em_mobile" class="main-label">Mobile Number :</label>
                                            <span class="filds" id="em_mobile">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="bloodgroup" class="main-label">BloodGroup :</label>
                                            <span class="filds" id="bloodgroup">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <!-- <div class="col-5 px-3"> -->
                        <div class="col-12 mt-3">
                            <div class="card card-main3 p-3 border-0 shadow-lg h-100">
                                <div class="modal-header align-items-center">
                                    <h5 class="mb-3">Financial details</h5>
                                    <button type="button" class="btn-primary" id="financial_ditails_edit"
                                        data-bs-toggle="modal" data-bs-target="#profile_financial_details"
                                        data-edit_id="<?= $_SESSION['id'] ?>">Update</button>
                                </div>
                                <div class="row g-2 d-flex">
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="pan_number" class="main-label">Pan Number :</label>
                                            <span class="filds" id="pan_number">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="bank_name" class="main-label">Bank Name :</label>
                                            <span class="filds" id="bank_name">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="ac_no" class="main-label">A/C Number :</label>
                                            <span class="filds" id="ac_no">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="ifsc" class="main-label">IFSC Code :</label>
                                            <span class="filds" id="ifsc">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="branch_name" class="main-label">Branch Name:</label>
                                            <span class="filds" id="branch_name">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="salary" class="main-label">Salary:</label>
                                            <span class="filds" id="salary">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="allowance" class="main-label">Allowance:</label>
                                            <span class="filds" id="allowance">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="add-user-input">
                                            <label for="total_pay" class="main-label">Total Pay:</label>
                                            <span class="filds" id="total_pay">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- </div> -->
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="profile_financial_details" style="z-index: 9999999999;" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Financial Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="financial_details_edit" id="financial_details_edit" method="post" action=""
                        enctype="multipart/form-data">
                        <div class="view-model">
                            <div class="view-model-heading w-100 d-flex flex-wrap g-2 row">
                                <!-- <div class="col-12"> -->
                                <div class="col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="pan_number" name="pan_number" placeholder="pan number">
                                </div>
                                <div class="col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="bank_name" name="bank_name" placeholder="Bank name">
                                </div>
                                <div class="col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="ac_number" name="ac_no" placeholder="A/C Number">
                                </div>
                                <div class="col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="ifsc_code" name="ifsc" placeholder="IFSC Code">
                                </div>
                                <div class="col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="branch_name" name="branch_name" placeholder="Branch Name">
                                </div>
                                <div class="col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="salary" name="salary" placeholder="Salary"
                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"">
                                </div>
                                <div class=" col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="allowance" name="allowance" placeholder="Allowance"
                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                </div>
                                <div class="col-md-4 col-12 mb-1">
                                    <input type="text" class="form-control main-control px-3 py-1 text-black-50"
                                        id="total_pay" name="total_pay" placeholder="Total Pay" disabled>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row mt-2">
                        <div class=col-xl-12>
                            <button class="btn-primary" data-user_id="<?php echo $_SESSION['id'] ?>"
                                id="edit_financial" name="edit_financial">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profile_edit" style="z-index: 9999999999;" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="password_reset_form" id="password_reset_form" method="post" action=""
                        enctype="multipart/form-data">
                        <div class=view-model>
                            <div class="view-model-heading w-100 d-flex flex-wrap">
                                <!-- <div class="col-lg-4 col-8 mx-auto mb-3">
                                    <div class="w-75 mx-auto avatar-upload avatar-preview">
                                        <img src="<?= base_url('assets/images/h-user-theme-m.svg') ?>" id="imagePreview"
                                            alt="" width="200px" height="200px">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="profile_pic"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="col-12 mb-1">
                                        <label for="">Enter Old Password</label>
                                        <input type="password" class="form-control main-control px-3 py-1 text-black-50"
                                            id="old_pass" placeholder="Old Password">
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label for="">New Password</label>
                                        <input type="pass" class="form-control main-control px-3 py-1 text-black-50"
                                            id="new_pass" placeholder="New Password" disabled>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label for="">Re-Enter New Password</label>
                                        <input type="pass" class="form-control main-control px-3 py-1 text-black-50"
                                            id="repassword" placeholder="Re-Enter New Password" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row mt-2">
                        <div class=col-xl-12>
                            <!-- <button class="btn btn-primary" data-user_id="<?php echo $_SESSION['id'] ?>"
                                id="file_upload" name="file_upload" value="file_upload" style="pointer-events: none"
                                disabled>File Upload</button> -->
                            <button class="btn btn-primary" data-user_id="<?php echo $_SESSION['id'] ?>"
                                id="reset_password" name="reset_password" value="reset_password"
                                style="pointer-events: none" disabled>Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').attr('src', "");
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    view_profile();

    function view_profile() {
        var view_id = '<?= $_SESSION['id'] ?>';
        var img_user_url = '<?= base_url('assets/images/user_profile_pic/') ?>';
        // console.log(view_id);
        if (view_id != '') {
            $.ajax({
                method: 'post',
                url: 'profile_view_data',
                data: {
                    'view_id': view_id,
                    'action': 'view',
                    'table': 'user'
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    // console.log(response);
                    if (response.profile_pic != '' && response.profile_pic != undefined) {
                        $('.profile_body .profile-pic').attr('src', img_user_url + response.profile_pic);
                        $('header #profile_img').attr('src', img_user_url + response.profile_pic);
                    }

                    $('.profile_body #firstname').html(response.fullname);
                    $('.profile_body #user_name').html(response.username);
                    $('.profile_body #mobile').html(response.mobilee);
                    $('.profile_body #email').html(response.email);
                    $('.profile_body #head').html(response.head_name);
                    $('.profile_body #address').html(response.address);
                    $('.profile_body #dob').html(response.dob);
                    $('.profile_body #join_date').html(response.join_date);

                    $('.profile_body #em_name').html(response.em_name);
                    $('.profile_body #relation').html(response.relation);
                    $('.profile_body #em_mobile').html(response.em_mobile);
                    $('.profile_body #bloodgroup').html(response.bloodgroup);

                    $('.profile_body #pan_number').html(response.pan_number);
                    $('.profile_body #bank_name').html(response.bank_name);
                    $('.profile_body #ac_no').html(response.ac_no);
                    $('.profile_body #ifsc').html(response.ifsc);
                    $('.profile_body #branch_name').html(response.branch_name);
                    $('.profile_body #salary').html(response.salary);
                    $('.profile_body #allowance').html(response.allowance);
                    $('.profile_body #total_pay').html(response.total_pay);
                }
            });
        }
    }

    $('body').on('click', '#change_pass', function (e) {
        e.preventDefault();
        var edit_id = $(this).attr('data-edit_id');
        var img_user_url = '<?= base_url('assets/images/user_profile_pic/') ?>'
        if (edit_id != '') {
            $.ajax({
                method: 'post',
                url: 'profile_view_data',
                data: {
                    'view_id': edit_id,
                    'action': 'view',
                    'table': 'user'
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    // console.log(response);
                    if (response.profile_pic != '' && response.profile_pic != undefined) {
                        $('#profile_edit #imagePreview').attr('src', img_user_url + response.profile_pic);
                    }
                }
            });
        }
    });

    setTimeout(function () {
        financial_details_validation_btn()
    }, 2000);

    function financial_details_validation_btn() {
        var financial_number = $('.profile_body #pan_number').html();
        var financial_name = $('.profile_body #bank_name').html();
        var financial_ac_no = $('.profile_body #ac_no').html();
        var financial_ifsc = $('.profile_body #ifsc').html();
        var financial_branch_name = $('.profile_body #branch_name').html();
        var financial_salary = $('.profile_body #salary').html();
        var financial_allowance = $('.profile_body #allowance').html();
        var financial_total_pay = $('.profile_body #total_pay').html();

        if (financial_number != '' && financial_name != '' && financial_ac_no != '' && financial_ifsc != '' && financial_branch_name != '' && financial_salary != '' && financial_allowance != '' && financial_total_pay != '') {
            $('#financial_ditails_edit').hide();
        } else {
            $('#financial_ditails_edit').show();
        }
    }


    $('#file_upload').hide();
    $("#imageUpload").change(function () {
        readURL(this);
        $('#file_upload').show();
    });
    $(document).ready(function () {
        $("#old_pass").blur(function () {
            var old_password = $(this).val();
            var user_id = <?= json_encode($_SESSION['id']) ?>;
            // console.log(user_id);
            $.ajax({

                method: "post",
                url: "<?= base_url('UserInformation_password_check'); ?>",
                data: {
                    'old_pass': old_password,
                    'id': user_id,
                },
                success: function (res) {
                    var msg = "Please Enter Valid Old Password!";
                    var response = JSON.parse(res);
                    msg = response.message;
                    if (response.result != "error") {
                        $("#new_pass").removeAttr("disabled");
                        // $("#repassword").removeAttr("disabled");
                    } else {
                        // Swal.fire({
                        //     title: 'Cancelled',
                        //     text: msg,
                        //     icon: 'error',
                        // })
                    }

                }
            });
            return false;
        });
        $('.btn-close').click(function() {
            $('form[name="password_reset_form"]')[0].reset();
            $('.selectpicker').selectpicker('refresh');
            // $("form[name='leave_insert']").removeClass("was-validated");
           
        });
        $("#new_pass").blur(function () {
            // alert("hello");
            var new_pass = $(this).val();
            var strength = checkStrength(new_pass);
        });

        function checkStrength(password) {
            var strength = 0
            if (password.length < 6) {
                $('#strengthMessage').removeClass()
                $('#strengthMessage').addClass('Short')
                $('#strengthMessage').text('Too Short')
                $("#reset_password").prop('disabled', true)
                $("#repassword").prop('disabled', true)
                return false;
            }
            if (password.length > 7) strength += 1
            // If password contains both lower and uppercase characters, increase strength value.  
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
            // If it has numbers and characters, increase strength value.  
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
            // If it has one special character, increase strength value.  
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
            // If it has two special characters, increase strength value.  
            if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
            // Calculated strength value, we can return messages  
            // If value is less than 2  
            if (strength < 2) {
                $('#strengthMessage').removeClass()
                $('#strengthMessage').addClass('Weak')
                $('#strengthMessage').text('Please Enter Strong Password')
                $("#reset_password").prop('disabled', true)
                $("#repassword").prop('disabled', true)
                return false;
            } else if (strength == 2) {
                $('#strengthMessage').removeClass()
                $('#strengthMessage').addClass('Good')
                $('#strengthMessage').text('Good!!!')
                $("#repassword").removeAttr("disabled")

            } else {
                $('#strengthMessage').removeClass()
                $('#strengthMessage').addClass('Strong')
                $('#strengthMessage').text('Strong!!')
                $("#repassword").removeAttr("disabled")

            }
        }

        $("#repassword").blur(function () {
            comparePassword($("#new_pass").val(), $("#repassword").val());
        });

        function comparePassword(password1, password2) {
            if (password1 != password2) {
                $(".divDoPasswordsMatch").html("Passwords do not match!");
                $(".divDoPasswordsMatch").css("color", "red");
                $("#reset_password").prop('disabled', true);
            }
            else {
                $(".divDoPasswordsMatch").html('');
                $("#reset_password").removeAttr("style");
                $("#reset_password").removeAttr("disabled");

                $("#reset_password").click(function (e) {
                    var user_id = $(this).attr('data-user_id');
                    // console.log(user_id);
                    // console.log(password2);
                    // var profile_info = $('#imageUpload').file();
                    var form = $('form[name="password_reset_form"]')[0];
                    var formdata = new FormData(form);
                    formdata.append('password', password2);
                    formdata.append('user_id', user_id);
                    formdata.append('action', 'passupdate');
                    // console.log(formdata);

                    if (password1 != '' && password2 != '') {
                        $.ajax({
                            method: "post",
                            url: "<?= site_url('UserInformation_password_update'); ?>",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (res) {
                                var msg = "Please Enter Valid data!";
                                var response = JSON.parse(res);
                                // console.log(response);
                                msg = response.message;
                                if (response.result != "error") {
                                    $("form[name='password_reset_form']")[0].reset();
                                    // sweet_edit_sucess(msg);
                                    iziToast.success({
                                        title: msg,
                                    });
                                    $(".btn-close").trigger("click");
                                } else {
                                    Swal.fire({
                                        title: 'Cancelled',
                                        text: msg,
                                        icon: 'error',
                                    })
                                }

                            }
                        });
                        return false;
                    } else {
                        $("form[name='password_reset_form']").addClass("was-validated");
                        return false;
                    }
                });

            }
        }


        $('#imageUpload').change(function () {
            var val = $(this).prop('files')[0];
            // console.log(val);
            filevalidation(val);
        });

        // filevalidation($('#imageUpload').prop('files')[0])

        function filevalidation(hasfile) {
            // console.log(hasfilr);
            var submitbtn = $('#file_upload');
            if (hasfile) {
                submitbtn.prop('disabled', false);
                submitbtn.prop('style', false);

                submitbtn.click(function () {
                    var form = $('form[name="profile_pic"]')[0];
                    var formdata = new FormData(form);
                    var user_id = $(this).attr('data-user_id');
                    formdata.append('user_id', user_id);
                    formdata.append('action', 'fileupdate');

                    if (hasfile != '') {
                        $.ajax({
                            method: "post",
                            url: "<?= site_url('UserInformation_password_update'); ?>",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (res) {
                                var msg = "Please Enter Valid file!";
                                var response = JSON.parse(res);
                                // console.log(response);
                                msg = response.message;
                                if (response.result != "error") {
                                    $("form[name='password_reset_form']")[0].reset();
                                    // sweet_edit_sucess(msg);
                                    iziToast.success({
                                        title: msg,
                                    });
                                    view_profile();
                                    $(".btn-close").trigger("click");
                                    $('#file_upload').hide();
                                    // $('.profile-pic').reset();
                                } else {
                                    Swal.fire({
                                        title: 'Cancelled',
                                        text: msg,
                                        icon: 'error',
                                    })
                                }

                            }
                        });
                        return false;
                    } else {
                        $("form[name='password_reset_form']").addClass("was-validated");
                        return false;
                    }
                });
            } else {
                submitbtn.prop('disabled', true);
                submitbtn.prop('style', true);
            }
        }

        function numberWithCommas(x) {
            return x.toString().split('.')[0].length > 3 ? x.toString().substring(0, x.toString().split('.')[0].length - 3).replace(/\B(?=(\d{2})+(?!\d))/g, ",") + "," + x.toString().substring(x.toString().split('.')[0].length - 3) : x.toString();
        }

        function total_price(price = 0, extrawork = 0, extraexpense = 0) {
            var numformate_total_price = 0;
            var total_price = 0;
            total_price = parseInt(price) + parseInt(extrawork) + parseInt(extraexpense);
            numformate_total_price = numberWithCommas(total_price);
            return numformate_total_price;
        }
        $('body').on('keyup', '#financial_details_edit #salary', function () {
            // alert();
            var price = $(this).val().replace(/,/g, '');
            var add_comma = numberWithCommas(price);
            $(this).val(add_comma);
            var extrawork = $("#financial_details_edit #allowance").val().replace(/,/g, '');
            if (extrawork == '') {
                extrawork = 0;
            }
            var total_price_count = total_price(price, extrawork);
            $("#financial_details_edit #total_pay").val(total_price_count);
        });
        $('body').on('keyup', '#financial_details_edit #allowance', function () {
            var extrawork = $(this).val().replace(/,/g, '');
            var add_comma = numberWithCommas(extrawork);
            $(this).val(add_comma);
            var price = $("#financial_details_edit #salary").val().replace(/,/g, '');
            if (price == '') {
                price = 0;
            }
            var total_price_count = total_price(price, extrawork);
            $("#financial_details_edit #total_pay").val(total_price_count);
        });

        $('body').on('click', '#financial_ditails_edit', function (e) {
            e.preventDefault();
            var edit_id = $(this).attr('data-edit_id');
            if (edit_id != '') {
                $.ajax({
                    method: 'post',
                    url: 'profile_view_data',
                    data: {
                        'view_id': edit_id,
                        'action': 'view',
                        'table': 'user'
                    },
                    success: function (res) {
                        var response = JSON.parse(res);

                        $('#financial_details_edit #pan_number').val(response.pan_number);
                        $('#financial_details_edit #bank_name').val(response.bank_name);
                        $('#financial_details_edit #ac_number').val(response.ac_no);
                        $('#financial_details_edit #ifsc_code').val(response.ifsc);
                        $('#financial_details_edit #branch_name').val(response.branch_name);
                        $('#financial_details_edit #salary').val(response.salary);
                        $('#financial_details_edit #allowance').val(response.allowance);
                        $('#financial_details_edit #total_pay').val(response.total_pay);
                    }
                });
            }
        });

        $('body').on('click', '#edit_financial', function (e) {
            // alert();
            e.preventDefault();
            var edit_id = $(this).attr('data-user_id');
            var financial_number = $('#financial_details_edit #pan_number').val();
            var financial_name = $('#financial_details_edit #bank_name').val();
            var financial_ac_no = $('#financial_details_edit #ac_number').val();
            var financial_ifsc = $('#financial_details_edit #ifsc_code').val();
            var financial_branch_name = $('#financial_details_edit #branch_name').val();
            var financial_salary = $('#financial_details_edit #salary').val();
            var financial_allowance = $('#financial_details_edit #allowance').val();
            var financial_total_pay = $('#financial_details_edit #total_pay').val();

            var form = $('form[name="financial_details_edit"]')[0];
            // console.log(form);
            var formdata = new FormData(form);
            formdata.append('total_pay', financial_total_pay);
            formdata.append('action', 'update');
            formdata.append('edit_id', edit_id);
            formdata.append('table', 'user');

            if (edit_id != '' && financial_number != '' && financial_name != '' && financial_ac_no != '' && financial_ifsc != '' && financial_branch_name != '' && financial_salary != '' && financial_allowance != '' && financial_total_pay != '') {
                $.ajax({
                    method: 'post',
                    url: 'user_update',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res != 'error') {
                            $('.loader').hide();
                            view_profile();
                            financial_details_validation_btn();
                            $('.btn-close').click(function () {
                                $('form[name="financial_details_edit"]')[0].reset();
                            });
                            $('.btn-close').trigger('click');
                            $("form[name='financial_details_edit']").removeClass("was-validated");
                            // sweet_edit_sucess('Update successfully');
                            iziToast.success({
                                title: 'Update successfully',
                            });
                        } else {
                            $('.loader').hide();
                            Swal.fire({
                                title: 'Cancelled',
                                text: 'Duplicate Data Not Valid',
                                icon: 'error',
                            })
                        }
                    }
                });
            } else {
                $('.loader').hide();
                $("form[name='financial_details_edit']").addClass("was-validated");
            }
        });

    });
</script>