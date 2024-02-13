<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

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
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="title-1  d-flex align-items-center">
                    <i class="fa-solid fa-phone"></i>
                    <h2>Phone Number</h2>
                </div>
                <div class="d-flex align-items-center col-1    ">
                    <div class="main-selectpicker col">
                        <select id="product_type" name="product_type"
                            class="selectpicker form-control form-main main-control d-none product_type"
                            data-live-search="true" required="" tabindex="-98">
                            <option value="1" class="dropdown-item">Realtoart</option>
                        </select>
                    </div>
                    <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn-primary-rounded mx-2 PlusButtonClass">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mt-4 bg-white border rounded-3">
        <div class="row">
            <div class="p-2">
                <div class="col-xl-12 d-flex p-2 px-4 d-flex flex-wrap">
                    <div class="col-3">
                        <div class="d-flex input-group d-none">
                            <span class="input-group-text" id="basic-addon2"><i
                                    class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="number" min="0" step="0.01" class="form-control main-control "
                                id="coupon_value" name="coupon_value" placeholder="Coupon Value" required="">
                        </div>
                    </div>
                    <div class="col-2 mx-2 d-none">
                        <div class="d-flex input-group">
                            <span class="input-group-text border-end-0" id="basic-addon2"><i
                                    class="fa-solid fa-magnifying-glass"></i></span>
                            <div class="main-selectpicker col">
                                <select id="product_type" name="product_type"
                                    class="border  border-start-0 rounded-start-0 selectpicker form-control form-main main-control product_type"
                                    data-live-search="true" required="" tabindex="-98">
                                    <option value="1" class="dropdown-item d-flex flex-wrap ">
                                        <p>Filter</p>
                                    </option>
                                    <option value="1" class="dropdown-item">Filter</option>
                                    <option value="1" class="dropdown-item">Filter</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-1 mx-2">

                    </div>
                    <div class="col-12 w-100  my-3">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="border-bottom">
                                    <th scope="col"><span class="text-muted phone-header">Phone Number <span
                                                class="mx-2"><i class="bi bi-arrow-up"></i></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Status <span class="mx-2"><i
                                                    class="bi bi-arrow-down-up"></i></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Quality rating <span
                                                class="mx-2"><i class="bi bi-arrow-down-up"></i></span></span></th>
                                    <th scope="col" style="max-width: 150px;"><span
                                            class="text-muted phone-header">Messaging Limit <span class="mx-2"><i
                                                    class="bi bi-arrow-down-up"></i></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Country <span class="mx-2"><i
                                                    class="bi bi-arrow-down-up"></i></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Name <span class="mx-2"><i
                                                    class="bi bi-arrow-down-up"></i></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Delete</span></th>
                                </tr>
                            </thead>
                            <tbody class="SetHtmlListData">
                                <!-- <tr>
                                    <td class="align-middle" scope="col-2"><sup class="fs-12">IN</sup> +91 7600176982
                                    </td>
                                    <td class="align-middle" scope="col-1"><span
                                            class="p-1 bg-success-subtle border border-light rounded-pill fs-10 text-success fw-bold ">Connected</span>
                                    </td>
                                    <td class="align-middle" scope="col-1">
                                        <span class="d-inline-block bg-success border border-light rounded-circle"
                                            style="width:11px;height:11px"></span>
                                        <span Class="mx-2">High</span>
                                    </td>
                                    <td class="align-middle text-truncate messeging-content" style="max-width: 150px;"
                                        scope="col-2">10 k customers/ Lorem, ipsum dolor sit amet consectetur
                                        adipisicing elit. Fuga, blanditiis!</td>
                                    <td class="align-middle" scope="col-1">India</td>
                                    <td class="align-middle" scope="col-2">Realtosmart</td>
                                    <td class="align-middle" scope="col-1 text-center">
                                        <button class="btn border rounded-3">
                                            View
                                        </button>
                                    </td>
                                    <td class="align-middle" scope="col-1">
                                        <button class="btn border rounded-3">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                    <td class="align-middle" scope="col-1">
                                        <button class="btn border rounded-3">
                                            <i class="fa-solid fa-gear"></i>
                                        </button>
                                    </td>
                                </tr> -->
                            </tbody>
                            <tfoot>
                                <tr class="border-top">
                                    <td colspan="8" class="p-1"><span class="fs-12    "><span class="CountedNumberT">0</span> Phone Number</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">

        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">WhatsApp Bussiness Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation row ConnectionAddFormList" name="fb_cnt" method="POST" novalidate="">

                <div class="align-items-end d-flex col-12 my-2">
                        <div class="col-12">
                            <h6 class="modal-body-title">Phone Number ID<sup class="validationn">*</sup></h6>
                            <input type="number" class="form-control main-control PhoneNumberID" id="" name=""
                                placeholder="Enter Phone Number ID" required="">
                        </div>
                    </div>
                    <div class="col-12">
                        <h6 class="modal-body-title">WhatApp Business Account ID<sup class="validationn">*</sup></h6>
                        <input type="number" class="form-control main-control WhatAppBAID" id="" name=""
                            placeholder="Enter WhatApp Business Account ID" required="">
                    </div>
                    <div class="col-12">
                        <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                        <textarea type="text" class="form-control main-control AccessTokenInput" id="" name=""
                            placeholder="Enter Access Token" required=""></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('integration') ?>">
                    <button type="button" class="btn-secondary mx-0" id="cancel" name="">Back</button>
                </a>
                <button type="button" class="btn btn-primary SubmitWhatAppIntegrationData" action = "insert" EditId="" id="SubmitWhatAppIntegrationData">Submit</button>
            </div>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('body').on('click', '.phone-header', function () {
        $(this).removeClass('text-muted');
        $(this).closest('th').siblings('th').children('span').addClass('text-muted');

    })
    $('body').on('hover', '.messeging-content', function () {
        alert('jdfdff');
        $(this).css('font-weight', '500');
    })


    $('body').on('click', '.PlusButtonClass', function(){
        $('.PhoneNumberID').val('');
        $('.WhatAppBAID').val('');
        $('.AccessTokenInput').val('');
        $('.SubmitWhatAppIntegrationData').val('');
        $('.SubmitWhatAppIntegrationData').attr('action', 'insert');
        $('.ConnectionAddFormList').removeClass('was-validated');

        
    });




    function ListData(){
        $.ajax({
            method: "post",
            url: "WhatsAppConnectionsList",
            data: {
                'action':'list',
            },
            success: function (res) {
                $('.SetHtmlListData').html(res);
            },
        });
    }
    ListData();

    $('body').on('click', '.DelectConnection', function(){
        var id = $(this).attr('id');
        var table = $(this).attr('table');
        var record_text = "Are you sure you want to Delete this?";

        if (id != '' && table != '') {
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
                        method: "post",
                        url: "<?= site_url('delete_data_secound_db'); ?>",
                        data: {
                            'action': 'delete',
                            'id': id,
                            "table" : table,
                        },
                        success: function(data) {
                            iziToast.error({
                                title: 'Deleted Successfully'
                            });
                            ListData();
                            $(".btn-close").trigger("click");
                        }
                    });
                }
            });
        }
    });



    $('body').on('click', '#SubmitWhatAppIntegrationData', function(){
        var PhoneNumberID = $('.PhoneNumberID').val();
        var WhatAppBAID = $('.WhatAppBAID').val();
        var AccessTokenInput = $('.AccessTokenInput').val();
        var id = $(this).attr('EditId');
        var action = $(this).attr('action');
        if (PhoneNumberID != '' || WhatAppBAID != '' || AccessTokenInput != "") {
            $.ajax({
                method: "post",
                url: "WhatsAppConnectionEntry",
                data: {
                    'whatapp_phone_number_id': PhoneNumberID,
                    'whatapp_business_account_id': WhatAppBAID,
                    'whatapp_access_token': AccessTokenInput,
                    id:id,
                    action:action,
                },
                success: function (res) {
                    if(res == 1){
                        iziToast.success({
                            title: 'Added Successfully',
                        });
                        ListData();

                    }else{
                        iziToast.error({
                            title: 'Duplicate Data',
                        });
                    }
                    $('.btn-close').trigger('click');
                    
                },
            });
        }else{
            $('.ConnectionAddFormList').addClass('was-validated');
        }
    });



   
</script>