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
?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between">
                <div class="title-1 d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <h2>Sign Up</h2>
                </div>
                <div class="user-list-btn">
                    <?php if (in_array('signup_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <button id="deleteButton" class="btn-primary-rounded hide" style="display: none;"><i class="fi fi-rr-trash"></i></button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <table id="leave_data" class="table main-table w-100">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all" />
                        </th>
                        <th>
                            <span>Sign Up List</span>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 p-1">
                            <label for="password" class="form-label">Password :</label>
                            <div class="custom_daaa d-flex flex-wrap">
                                <div class="pass_field col-5 col-xxs-12 col-md-7 col-lg-9">
                                    <div class="d-flex flex-wrap">
                                        <input type="text" class="form-control main-control  password m-1 col-xxs-12 col-lg-8 col-xl-9 col-xxl-8`" value="" placeholder="Password" id="password">
                                        <button class=" btn-primary padding-size m-1 w-lg-50 col-xxs-12" id="set_passsword" data-edit_id="">Set
                                            Password</button>
                                    </div>
                                </div>
                                <div class="view-password-right ps-2">
                                    <button class=" btn-primary padding-size m-1 col-xxs-12" id="cre_passsword" data-user_id="">Create
                                        Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if (in_array('signup_information_child_edit_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                        <a href="#" class="btn-primary-rounded edt">
                            <i class="fas fa-pencil-alt" data-edit_id="" data-bs-toggle="modal" data-bs-target="#Add_all_user"></i>
                        </a>
                    <?php } ?>
                    <?php if (in_array('signup_information_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
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
                            <input type="text" class="form-control main-control pan_number_valid_formate" id="username" name="username" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="mobile" class="form-label main-label">Mobile</label>
                            <input type="text" class="form-control main-control" minlength="9" maxlength="10" id="mobile" name="mobile" required="">
                        </div>
                        <div class="mb-2 col-12 col-sm-4 px-2">
                            <label for="email" class="form-label main-label">Email</label>
                            <input type="email" class="form-control main-control" name="email" id="email" required="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 d-flex justify-content-end mt-2 pe-2 user-btn-view">
                    <input type="hidden" id="">
                    <button data-edit_id="" type="submit" class="btn-primary subscribtion_update" data-edit_id="" data-master_id="" name="subscribtion_update" id="subscribtion_update"> submit</button>
                </div>
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
    function list_data() {
        $('.loader').show();
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('signup_data'); ?>",
            data: {
                table: 'paydone_data',
                'action': true
            },
            success: function(res) {
                $('.loader').hide();
                $('#all_user_list').html(res);
            }
        });
        $('.loader').hide();
    }
    $("body").on('click', '#set_passsword', function(password) {
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
            success: function(data) {
                sweet_edit_sucess('Update successfully');
                $('.pass_field').hide();
                location.reload(true);
            }
        });
        return false;
    });
    $("body").on('click', '#cre_passsword', function(e) {
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
                success: function(res) {
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
    $('body').on('click', '.all_user_view', function(e) {
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
                success: function(res) {
                    $('.loader').hide();
                    var response = JSON.parse(res);
                    $('.dlt').attr('data-delete_id', response[0].id);
                    $('#all_user_view #name').text(response[0].name);
                    $('#all_user_view #username').text(response[0].username);
                    $('#all_user_view #mobile').text(response[0].mobile);
                    $('#all_user_view #email').text(response[0].email);
                    if (response[0].password != "") {
                        $("#set_passsword").text("Reset password");
                        $("#cre_passsword").text("View Password");
                    } else {
                        $("#cre_passsword").text("create Password");
                    }
                    $('#all_user_view .edt').attr('data-edit_id', response[0].id);
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
    $('body').on('click', '.edt', function(e) {
        e.preventDefault();
        $('.selectpicker').selectpicker('refresh');
        var self = $(this).closest("tr");
        var edit_value = $(this).attr("data-edit_id");
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
                success: function(res) {
                    $('.loader').hide();
                    $('.selectpicker').selectpicker('refresh');
                    var response = JSON.parse(res);
                    $('.subscribtion_update').attr('data-edit_id', response.id);
                    $('.subscribtion_update').attr('data-master_id', response.master_id);
                    $('#Add_all_user #name').val(response.name);
                    $('#Add_all_user #username').val(response.username);
                    $('#Add_all_user #email').val(response.email);
                    $('#Add_all_user #mobile').val(response.mobile);
                    $('#Add_all_user #user_valid').val(response.user_valid);
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
        } else {
            $('.loader').hide();
            alert("Data Not Edit.");
        }
    });
    // new update
    $("#Add_all_user").on('click', '.subscribtion_update', function(e) {
        // alert("hello");
        event.preventDefault();
        var id = $(this).attr('data-edit_id');
        // console.log(id)
        var name = $('#Add_all_user #name').val();
        var username = $('#Add_all_user #username').val();
        var email = $('#Add_all_user #email').val();
        var mobile = $('#Add_all_user #mobile').val();
        var form = $('form[name="subscribtion_updatee_formm"]')[0];
        var formdata = new FormData(form);
        // console.log(formdata);
        formdata.append('table', 'paydone_data');
        formdata.append('action', 'update');
        formdata.append('id', id);
        $('.loader').show();
        if (name != "" && username != "" && email != "" && mobile != "") {
            $.ajax({
                method: "POST",
                url: "<?= site_url('subscription_update'); ?>",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(dataResult) {
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
    $('body').on('click', '.dlt', function(e) {
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
                success: function(res) {
                    $('.loader').hide();
                    $(".modal-close-btn").trigger("click");
                    list_data();
                    iziToast.delete({
                        title: 'Delete successfully'
                    });
                },
                error: function(error) {
                    $('.loader').hide();
                }
            });
        }
    });
</script>