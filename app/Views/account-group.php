<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="user-main">
    <div class="container-fluid">
        <div class="row row-main">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="user-icon d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <p>Account Group</p>
                </div>
                <div class="user-list-btn">
                    <span id="deleted-all" class=" btn-primary-rounded elevation_add_button add-button"><i
                            class="bi bi-trash3"></i></span>
                    <span class="btn-primary-rounded elevation_add_button add-button dataa-error"
                        data-bs-toggle="modal" data-bs-target="#addacount" data-bs-dismiss="modal" data-delete_id="">
                        <i class="fas fa-plus"></i>
                    </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="user-table">
    <div class="container-fluid">
        <div class="user-color card card-menu">
            <div class="row row-table">
                <div class="col-xl-12">
                    <table id="user_table"
                        class="table table-striped dt-responsive nowrap  user-tables table-background-color"
                        style="width:100%">
                        <thead class="table-heading">
                            <tr class="main">
                                <th>
                                    <input class="mx-0" type="checkbox" id="select-all" />
                                </th>
                                <th>
                                    <span>Account Group</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="user_list" class="account_grp_data">
                            <!-- <tr class="odd">
                                <td class="align-middle dtr-control sorting_1" tabindex="0">
                                    <input class="checkbox mx-3 mt-2" type="checkbox">
                                </td>
                                <td class="d-flex">
                                    <div class="project-list-trf  px-0 py-2 w-100 user_view" data-view_id="43"
                                        data-bs-toggle="modal" data-bs-target="#user_view">
                                        <div class="project-list-content d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex align-items-center ">
                                                <b>1</b>
                                            </div>
                                            <div class="d-flex align-items-center col-xxs-8 col-xs-10 col-xl-2 lh-21">
                                                <span><b>chintan</b></span>
                                            </div>

                                            <div class="d-flex align-items-center col-xxs-6 col-xs-6 col-xl-2 lh-21">
                                                <p>Acct Group : </p>
                                                <span class="mx-1">chat</span>
                                            </div>
                                            <div class="d-flex align-items-center col-xxs-6 col-xs-6 col-xl-2 lh-21">
                                                <p>From Account : </p>
                                                <span class="mx-1">1500</span>
                                            </div>
                                            <div class="d-flex align-items-center col-xxs-6 col-xs-6 col-xl-2 lh-21">
                                                <p>To Account : </p>
                                                <span class="mx-1">1548</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade Adduser " id="addacount" tabindex="-1" aria-labelledby="exampleModalToggleLabel1" aria-hidden="true">
     <div class="modal-dialog ">
          <div class="modal-content">
               <div class="modal-header pt-2 pb-2">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Account </h1>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></button>
               </div>
               <div class="modal-body modal-body-2 pt-1">
                    <div class="row">
                         <form action="" class="" name="account_grp">
                              <div class="col-xl-12">
                                   <div class="card card-main3 pb-2">
                                        <div class="row g-2 d-flex">
                                             <div class="col-12">
                                                  <div class="add-user-input">
                                                       <label for="">Account Group :<sup class="validationn">*</sup></label>
                                                       <input type="text" class="form-control number_value_only mob_allocation account_grp" name="account_grp" id="account_grp" placeholder="Name" required>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
               <div class="modal-footer modal-footer2">
                    <div class="col-lg-12 d-flex justify-content-end mt-2 pe-2 user-btn-view">
                         <input type="hidden" id="">
                         <button data-edit_id="" type="submit" class="btn btn-submit add_account_grp" name="add_new_user_btn" id="add_new_user_btn"> submit</button>
                    </div>
               </div>
          </div>
     </div>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>


<script>
    $(document).ready(function () {
        $('.user-tables').DataTable();

        function list_data(){
            $.ajax({
                datatype : 'json',
                method : 'post',
                url : '<?= site_url('group_type_list_data'); ?>',
                data : {
                    action : true,
                    table : 'account_grp',
                },
                success : function(res) {
                    $('.account_grp_data').html(res);
                }
            });
        }
        list_data();

        $('body').on('click','.add_account_grp', function () {
            var account_grp_name = $('.account_grp').val();
            var edit_id = $(this).attr('data-edit_id');

            if(edit_id == ''){
                if(account_grp_name != ''){
                    $.ajax({
                        datatype : 'json',
                        method : 'post',
                        url : '<?= site_url('group_insert_data'); ?>',
                        data : {
                            action : true,
                            table : 'account_grp',
                            account_grp : account_grp_name,
                        },
                        success : function(res) {
                            if(res == 0){
                                list_data();
                                $("form[name='account_grp']").removeClass("was-validated");
                                $("form[name='account_grp']")[0].reset();
                                $('.modal-close-btn').trigger('click');
                                $('.add_account_grp').attr('data-edit_id','');
                                iziToast.success({
                                    title: 'Added Successfully'
                                });
                            } else {
                                iziToast.error({
                                    title: 'Data Not Inserted'
                                });
                            }
                        }
                    });
                } else {
                    $("form[name='account_grp']").addClass("was-validated");
                }
            } else {
                if(account_grp_name != ''){
                    $.ajax({
                        datatype : 'json',
                        method : 'post',
                        url : '<?= site_url('group_insert_data'); ?>',
                        data : {
                            action : 'update',
                            table : 'account_grp',
                            edit_id : edit_id,
                            account_grp : account_grp_name,
                        },
                        success : function(res) {
                            if(res == 0){
                                list_data();
                                $("form[name='account_grp']").removeClass("was-validated");
                                $("form[name='account_grp']")[0].reset();
                                $('.modal-close-btn').trigger('click');
                                $('.add_account_grp').attr('data-edit_id','');
                                iziToast.success({
                                    title: 'Added Successfully'
                                });
                            } else {
                                iziToast.error({
                                    title: 'Data Not Inserted'
                                });
                            }
                        }
                    });
                } else {
                    $("form[name='account_grp']").addClass("was-validated");
                }
            }
        });

        $('body').on('click','.user_view', function(){
            var edit_id = $(this).attr('data-edit_id');
            if(edit_id != ''){
                $.ajax({
                    datatype : 'json',
                    method : 'post',
                    url : '<?= site_url('group_edit_data'); ?>',
                    data : {
                        action : 'edit',
                        table : 'account_grp',
                        edit_id : edit_id,
                    },
                    success : function(res) {
                        var responce = JSON.parse(res);
                        $("form[name='account_grp']").removeClass("was-validated");
                        $("form[name='account_grp']")[0].reset();
                        $('#account_grp').val(responce.account_grp);
                        $('.add_account_grp').attr('data-edit_id',responce.id);
                    }
                });
            } else {
                $("form[name='account_grp']").addClass("was-validated");
            }
        });

        $('.modal-close-btn').on('click',function(){
            $("form[name='account_grp']").removeClass("was-validated");
            $("form[name='account_grp']")[0].reset();
            $('.add_account_grp').attr('data-edit_id','');
        });

        $('#addacount').on('hidden.bs.modal', function(){
            $("form[name='account_grp']").removeClass("was-validated");
            $("form[name='account_grp']")[0].reset();
            $('.add_account_grp').attr('data-edit_id','');
        });
    });
</script>