<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    @media (max-width:575px) {
        .heading {
            order: -1;
        }

        .btn-pluse {
            order: -1;
        }

        .title-1 h2 {
            font-size: 15px;
        }

        /* .list-table{
            overflow-x: scroll;
            min-width: 332px;
        } */
    }

    .list-table {
        overflow-x: scroll;
        /* min-width: 632px; */
    }
    /* Style for thin scrollbar */
::-webkit-scrollbar {
    height: 5px;
}


</style>

<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $get_roll_id_to_roll_duty_var = array();
} else {
    $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
$admin_bot = json_decode($admin_bot, true);
?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="col-xl-12 d-flex justify-content-between flex-wrap">
                <div class="title-1  d-flex align-items-center col-6 col-sm-4  col-lg-3 heading mb-1">
                    <i class="fa-solid fa-phone"></i>
                    <h2>Phone Number</h2>
                </div>
                <div class="col-12 col-sm-6  col-lg-3">
                    <div class="input-group">
                        <input type="text" class="form-control MasterListDataSearchBar" placeholder="Search Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary border MasterListDataSearchBarButton" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <div class="d-flex align-items-center col-6 col-sm-2 col-lg-2 btn-pluse mb-1">
                    <div class="main-selectpicker col">
                        <select id="product_type" name="product_type" class="selectpicker form-control form-main main-control d-none product_type" data-live-search="true" required="" tabindex="-98">
                            <option value="1" class="dropdown-item">Realtoart</option>
                        </select>
                    </div>
                    <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn-primary-rounded mx-2 PlusButtonClass bot-hider">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="p-0  bg-white border rounded-3 list-table">
        <div class="row col-12">
            <div class="p-2">
                <div class="col-xl-12 d-flex  px-3 d-flex flex-wrap">
                    <div class="col-3">
                        <div class="d-flex input-group d-none">
                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="number" min="0" step="0.01" class="form-control main-control " id="coupon_value" name="coupon_value" placeholder="Coupon Value" required="">
                        </div>
                    </div>
                    <div class="col-2 mx-2 d-none">
                        <div class="d-flex input-group">
                            <span class="input-group-text border-end-0" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <div class="main-selectpicker col">
                                <select id="product_type" name="product_type" class="border  border-start-0 rounded-start-0 selectpicker form-control form-main main-control product_type" data-live-search="true" required="" tabindex="-98">
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
                    <div class="col-12 w-100 ">
                        <table class="table table-borderless mb-0 " style="min-width:700px">
                            <thead>
                                <tr class="border-bottom">
                                    <th scope="col"><span class="text-muted phone-header">Phone Number <span class="mx-2"></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Status <span class="mx-2"></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Quality rating <span class="mx-2"></span></span></th>
                                    <!-- <th scope="col" style="max-width: 150px;"><span
                                            class="text-muted phone-header">Messaging Limit <span class="mx-2"></span></span></th> -->
                                    <th scope="col"><span class="text-muted phone-header">Country <span class="mx-2"></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Name <span class="mx-2"></span></span></th>
                                    <th scope="col"><span class="text-muted phone-header">Chat-bot</span></th>
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
                                    <td colspan="8" class="p-1"><span class="fs-12    "><span class="CountedNumberT" total="0">0</span> Phone Number</span></td>
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
                    <div class="hide-menu">
                        <div class="align-items-end d-flex col-12 my-2">
                            <div class="col-12">
                                <h6 class="modal-body-title">Phone Number ID<sup class="validationn">*</sup></h6>
                                <input type="number" class="form-control main-control PhoneNumberID" id="" name="" placeholder="Enter Phone Number ID" required="">
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="modal-body-title">WhatApp Business Account ID<sup class="validationn">*</sup></h6>
                            <input type="number" class="form-control main-control WhatAppBAID" id="" name="" placeholder="Enter WhatApp Business Account ID" required="">
                        </div>
                        <div class="col-12">
                            <h6 class="modal-body-title">Access Token<sup class="validationn">*</sup></h6>
                            <textarea type="text" class="form-control main-control AccessTokenInput" id="" name="" placeholder="Enter Access Token" required=""></textarea>
                        </div>
                    </div>
                    <div class="col-12 bot-selecter">
                        <h6 class="modal-body-title">Select bot</h6>
                        <div class="main-selectpicker w-100" id="investor_list_select_table">
                            <select name="bot_iid" id="bot_iid" name="bot_id" class="selectpicker form-control select form-main" data-live-search="true" required>
                                <option class="dropdown-item" value="0">Select bot</option>
                                <?php
                                if (isset($admin_bot)) {
                                    foreach ($admin_bot as $key_bot => $value_bot) {
                                        echo '<option value="' . $value_bot["id"] . '">' . $value_bot["name"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('integration') ?>">
                    <button type="button" class="btn-secondary mx-0" id="cancel" name="">Back</button>
                </a>
                <button type="button" class="btn btn-primary SubmitWhatAppIntegrationData" action="insert" EditId="" id="SubmitWhatAppIntegrationData">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- chat-bot -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">WhatsApp Bussiness Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation row ConnectionAddFormList" name="fb_cnt" method="POST" novalidate="">
                    <div class="col-12 bot-selecter">
                        <h6 class="modal-body-title">Select bot</h6>
                        <div class="main-selectpicker w-100" id="investor_list_select_table">
                            <select name="update_bot_iid" id="update_bot_iid" class="selectpicker form-control select form-main" data-live-search="true" required>
                                <option class="dropdown-item" value="0">Select bot</option>
                                <?php
                                // if (isset($admin_bot)) {
                                //     foreach ($admin_bot as $key_bot => $value_bot) {
                                //         echo '<option value="' . $value_bot["id"] . '">' . $value_bot["name"] . '</option>';
                                //     }
                                // }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <a href="<?= base_url('integration') ?>"> -->
                <button type="button" class="btn-secondary mx-0" id="cancel" name="">Back</button>
                <!-- </a> -->
                <button type="button" class="btn btn-primary bot_id_get_update" data-bot_id="" id="bot_id_get_update">Submit</button>
            </div>
        </div>
    </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $('body').on('click', '.phone-header', function() {
        $(this).removeClass('text-muted');
        $(this).closest('th').siblings('th').children('span').addClass('text-muted');

    })
    $('body').on('hover', '.messeging-content', function() {
        alert('jdfdff');
        $(this).css('font-weight', '500');
    })


    $('body').on('click', '.PlusButtonClass', function() {
        $('.PhoneNumberID').val('');
        $('.WhatAppBAID').val('');
        $('.AccessTokenInput').val('');
        $('.SubmitWhatAppIntegrationData').val('');
        $('.SubmitWhatAppIntegrationData').attr('action', 'insert');
        $('.ConnectionAddFormList').removeClass('was-validated');


    });





    function ListData() {
        $.ajax({
            method: "post",
            url: "WhatsAppConnectionsList",
            data: {
                'action': 'list',
            },
            success: function(res) {
                $('.SetHtmlListData').html(res);
                filter();
                
            },
        });
    }
    ListData();

    function bot_disabled_data() {
        $('.loader').show();
        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('dropdown_bot_disabled'); ?>",
            data: {},
            success: function(res) {
                $('#update_bot_iid').html(res);
                $('#bot_iid').html(res);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
    bot_disabled_data();

    function filter() {
        var masterListDataSearchBar = $('.MasterListDataSearchBar').val();
        var totalcount = $('.CountedNumberT').attr('total');
        if (masterListDataSearchBar !== '') {
            // var countscript = 
            var subtotalcount = totalcount;
            $('.ContactNumberClassSearch').each(function(index) {
                var currentElementText = $(this).text();
                var count = $(this).attr('count');
                // console.log(masterListDataSearchBar + "    " + currentElementText);
                var hideAndShowElement = $('.HideandShow' + count);
                // console.log(hideAndShowElement);

                if (currentElementText.includes(masterListDataSearchBar)) {
                    hideAndShowElement.removeClass('d-none');

                } else {
                    hideAndShowElement.addClass('d-none');
                    subtotalcount = parseInt(subtotalcount) - 1;
                }

            });
            $('.CountedNumberT').text(subtotalcount);
        } else {
            $('.CountedNumberT').text(totalcount);
            $('.HideandShowAllTr').removeClass('d-none');
        }
    }


    $('body').on('click', '.bot_id_get_update', function() {
        // var bot_main_id = $('#chat_bot').attr('data-bot_editid');
        var bot_main_id = $(this).attr("data-bot_id");
        var bot_type_id = $('#update_bot_iid').val();
        $.ajax({
            method: "post",
            url: "<?= site_url('whatsapp_bot_id_update'); ?>",
            data: {
                'bot_main_id': bot_main_id,
                'bot_type_id': bot_type_id,
                "table": 'platform_integration',
            },
            success: function(data) {
                $(".btn-close").trigger("click");
                iziToast.success({
                    title: 'Bot Added Successfully'
                });
                ListData();
            }
        });
    });

    $('body').on('input', '.MasterListDataSearchBar', function() {
        filter();
    });

    $('body').on('click', '.DelectConnection', function() {
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
                            "table": table,
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

    // edit data 
    $('body').on('click', '.chat_bot', function(e) {
        e.preventDefault();
        // $('.selectpicker').selectpicker('refresh');
        var self = $(this).closest("tr");
        var edit_value = $(this).attr("data-bot_editid");
        if (edit_value != "") {
            $('.loader').show();
            $.ajax({
                type: "post",
                url: "<?= site_url('wa_connextion_edit_data'); ?>",
                data: {
                    action: 'edit',
                    edit_id: edit_value,
                    table: 'platform_integration'
                },
                success: function(res) {
                    $('.loader').hide();
                    // $('.selectpicker').selectpicker('refresh');
                    var response = JSON.parse(res);
                    $('.bot_id_get_update').attr('data-bot_id', edit_value);
                    if (response[0].id != "") {
                        $("#exampleModal2 #update_bot_iid").val(response[0].id);
                    }
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

    $('body').on('click', '#SubmitWhatAppIntegrationData', function() {
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
                    id: id,
                    action: action,
                },
                success: function(res) {
                    if (res == 1) {
                        iziToast.success({
                            title: 'Added Successfully',
                        });
                        ListData();

                    } else {
                        iziToast.error({
                            title: 'Duplicate Data',
                        });
                    }
                    $('.btn-close').trigger('click');

                },
            });
        } else {
            $('.ConnectionAddFormList').addClass('was-validated');
        }
    });

    // // $('.bot-selecter').hide();
    // $('body').on('click', '.bot-hider', function() {
    //     // $('.bot-selecter').hide();
    //     $('.hide-menu').show();
    // })
    // $('body').on('click', '.chat_bot', function() {
    //     $('.hide-menu').hide();
    //     $('.bot-selecter').show();
    // })
</script>