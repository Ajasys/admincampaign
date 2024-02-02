<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2 position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-1">
                    <i class="bi bi-people"></i>
                    <h2> Manage Audiences</h2>
                </div>
                <div class="title-side-icons">
                    <button class="btn-primary-rounded" data-bs-toggle="offcanvas" data-bs-target="#audience_filter"
                        aria-controls="offcanvasRight">
                        <i class="bi bi-funnel fs-14"></i>
                    </button>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="px-3 py-2 mx-2 bg-white rounded-2 col-4 border">
				<div class="w-100 overflow-x-auto scroll-small row_none">
					<table class="w-100 main-table lead_list_table">
						<thead>
							<tr>
								<th class="p-2 text-nowrap"><span>Created Date </span></th>
								<th class="p-2 text-nowrap"><span>Lead Id </span></th>
								<th class="p-2 text-nowrap"><span>Name </span></th>
								
							</tr>
						</thead>
						<tbody class="audiance_list">
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-7 d-flex justify-content-center align-items-center">
				<div class="d-flex flex-wrap align-items-center">
					<button class=" fs-6 btn-primary add me-2 rounded-circle" id="save_btn_task" data-edit_id="" style="width:150px; height:150px">
						<i class="fa-solid fa-users fs-1 mb-2"></i>
						<p>Create Audiance </p>
					</button>
					<!-- <div class="col-3">
						<div class="main-selectpicker">
							<select id="task_type" placeholder="Enter Subject" name="task_type"
								class="selectpicker form-control form-main main-control" data-live-search="true"
								required="" tabindex="-98">
								<option value="1">Task</option>
								<option value="2">Meeting</option>
								<option value="3">Reminder</option>
							</select>
						</div>
					</div> -->
				</div>
				<div class="p-4 rounded-2 border col-4">
					<div class="col-12">
						<div class="main-selectpicker">
							<label for="#">Select Product</label>
							<select id="select_user" placeholder="Enter Subject" name="task_type"
								class="selectpicker form-control form-main main-control" data-live-search="true"
								required="" tabindex="-98">
								<option value="1">Task</option>
								<option value="2">Meeting</option>
								<option value="3">Reminder</option>
							</select>
						</div>
					</div>
					<div class="col-12 mt-3 d-none">
						<div class="main-selectpicker">
							<label for="#">Select Product</label>
							<select id="selscr_user2" placeholder="Enter Subject" name="task_type"
								class="selectpicker form-control form-main main-control" data-live-search="true"
								required="" tabindex="-98">
								<option value="1">Task</option>
								<option value="2">Meeting</option>
								<option value="3">Reminder</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="modal fade " id="lead_list_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Lead View</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" modal-body modal-body-secondery">
                <div class="modal-body-card">
                    <div class="row col-12">
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="add-user-input">
                                <label for="relation" class="form-label main-label fw-semibold">Inquiry Id
                                    :</label>
                                <span id="inquiry_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="name" class="form-label main-label fw-semibold">Name :</label>
                                <span id="full_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="form_id" class="form-label main-label fw-semibold">Form Id:</label>
                                <span id="form_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="campaign_id" class="form-label main-label fw-semibold">Campaign Id :</label>
                                <span id="campaign_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="adset_id" class="form-label main-label fw-semibold">Adset Id :</label>
                                <span id="adset_id"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="ad_id" class="form-label main-label fw-semibold">Ad Id :</label>
                                <span id="ad_id"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="add-user-input">
                                <label for="relation" class="form-label main-label fw-semibold">Platform
                                    :</label>
                                <span id="platform"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="em_mobile" class="form-label main-label fw-semibold">Mobile
                                    Number :</label>
                                <span id="mobile"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="form_name" class="form-label main-label fw-semibold">Form Name
                                    :</label>
                                <span id="form_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="campaign_name" class="form-label main-label fw-semibold">Campaign Name :</label>
                                <span id="campaign_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="adset_name" class="form-label main-label fw-semibold">Adset Name :</label>
                                <span id="adset_name"></span>
                            </div>
                            <div class="add-user-input">
                                <label for="ad_name" class="form-label main-label fw-semibold">Ad Name :</label>
                                <span id="ad_name"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="audience_filter" aria-labelledby="offcanvasRightLabel">
    <form method="post" class="d-flex flex-column h-100" name="filter_form">
        <div class="offcanvas-header FilterTitleDiv">
            <h5 id="offcanvas-title " class="filtersTitle" style="color: #fff">Filter</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body filter_data">
            <div class="row">
                <div class="col-lg-12 mb-3 ">
                    <input type="text" class="form-control main-control place Filtername" name="party_name"
                        id="party_name" placeholder="Name">
                </div>

                <div class="col-lg-12 mb-3 ">
                    <input type="text" class="form-control main-control place FilterSellingAmount " name="date_purchase"
                        id="date_purchase" placeholder="Date">
                </div>
                <div class="col-lg-12 mb-3 ">
                    <input type="text" class="form-control main-control place " id="bill_amount" name="bill_amount"
                        placeholder="Mobile No">
                </div>

            </div>
        </div>
    </form>
</div>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script>
    $(".lead_list_table").DataTable({

        "ordering": false

    });
    function datatable_view(html) {
        $('.lead_list_table').DataTable().destroy();
        $('.audiance_list').html(html);
        var table1 = $('.lead_list_table').DataTable({
            "columnDefs": [{
                "visible": false,
                "ordering": false,
            }],
            lengthChange: true,
            
            // buttons: ['copy', 'excel', 'pdf', 'colvis']
        });
        //  table1.buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');
        //  table1.page( 0 ).draw('page');
    }
    function list_data() {
        show_val = '<?= json_encode(array('created_time', 'ad_id')); ?>';

        $.ajax({
            datatype: 'json',
            method: "post",
            url: "<?= site_url('audience_list_data'); ?>",
            data: {
                'table': 'all_inquiry',
                'show_array': show_val,
                'action': true
            },
            success: function (res) {
                $('.loader').hide();
                datatable_view(res);
                //alert("hello");
            }
        });
    }
    list_data();
    // view data 
    $('body').on('click', '.audiance_view', function (e) {
        // alert("fd");
        var edit_value = $(this).attr("data-view_id");
        if (edit_value != "") {
            $.ajax({
                type: "post",
                url: "<?= site_url('audience_view_data'); ?>",
                data: {
                    action: 'view',
                    view_id: edit_value,
                    table: 'all_inquiry',
                },
                success: function (res) {
                    $('.loader').hide();
                    var response = JSON.parse(res);
                    // console.log();

                    $('#lead_list_modal #user_id').text(response[0].user_id);
                    $('#lead_list_modal #full_name').text(response[0].full_name);
                    $('#lead_list_modal #mobile').text(response[0].mobileno);
                    $('#lead_list_modal #form_id').text(response[0].id);
                    if(response[0]['platform']=='ig')
                    {
                        $platform = '<i class="fa-brands fa-instagram transition-5 icon1" style="background: -webkit-linear-gradient(#f32170, #ff6b08, #cf23cf, #eedd44);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>';
                    }
                    else
                    {
                        $platform = '<i class="fa-brands fa-facebook transition-5 icon2 rounded-circle" style="color: #0b85ed;"></i>';
                    }
                    $('#platform').text($platform);
                    $('#lead_list_modal #form_name').text(response[0].inquiry_status);
                    $('#lead_list_modal #ad_id').text(response[0].intrested_product);
                    $('#lead_list_modal #campaign_id').text(response[0].user_id);
                    $('.selectpicker').selectpicker('refresh');
                },
            });
        } else {
            $('.loader').hide();
            alert("Data Not Edit.");
        }
    });
	$('body').on('change','#select_user',function(){
		var a = $('#selscr_user2').closest('.col-12').addClass('d-none');
		// console.log(a);
		// alert(a);
		
	})
</script>