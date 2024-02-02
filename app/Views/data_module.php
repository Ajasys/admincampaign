<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center my-2 flex-wrap w-100">
            <div class="title-1">
                <i class="fa-solid fa-database"></i>
                <h2>Data Handling</h2>
            </div>
            <div class="title-side-icons">
                <a class="btn-primary add" href="<?= base_url('add_data_module'); ?>" type="button">
                    + add Data
                </a>
				<button class="btn-primary-rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
					<i class="bi bi-funnel fs-14"></i>
				</button>
            </div>
        </div>
        <div class="col-12 filter-show d-flex" id="filter-showw"></div>
		<div class="col-12">
			<button class="btn bg-danger mx-1 mt-2 clear btn-sm text-white fs-7" id="clear">Clear All</button>
		</div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mt-2">
            <div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
				<div class="dataTables_length" id="project_length">
					<label>
						Show
						<select name="project_length" id="project_length_show" aria-controls="project" class="">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
						Records
					</label>
				</div>
				<div id="people_wrapper" class="dataTables_wrapper no-footer">
					<div id="project_filter" class="dataTables_filter justify-content-end d-flex py-1 py-sm-0">
						<label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
					</div>
				</div>
			</div>
            <table id="today-follow-feedback" class="table main-table list_data w-100">
				<thead>
					<th>Columns</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="text-center">
								<span>Not Imported File</span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
            <div class="d-flex justify-content-between align-items-center row-count-main-section flex-wrap">
				<div class="row_count_div col-xl-6 col-12">
					<p id="row_count"></p>
				</div>
				<div class="clearfix  col-xl-6 col-12">
					<ul class="inq_pagination justify-content-xl-end" id="inq_pagination">
					</ul>
				</div>
			</div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
	<form method="post" class="d-flex flex-column h-100" name="filter_form">
		<div class="offcanvas-header set-bg-color bg-pink">
			<h5 class="offcanvas-title text-white" id="offcanvasRightLabel">filter</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body filter_data">
			<?php 
				$db_connection = \Config\Database::connect();
				$username = session_username($_SESSION['username']);
				if($db_connection->tableExists($username . '_data')){
					$query = $db_connection->table($username . '_data')->get();
					if ($query->getNumRows() > 0) {
						$columnNames = $query->getFieldNames();
					} else {
						$columnNames = array();
					}
					$return_data = array();
					$html = '';
					if(!empty($columnNames)) {
						foreach ($columnNames as $columnName) {
							echo '<div class="input-type my-2">
										<input type="text" placeholder="'.$columnName.'" class="form-control main-control" name="f_'.$columnName.'" id="f_'.$columnName.'">
									</div>';
						}
					}
				}
			?>
		</div>
	</form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    function replaceSpacesWithUnderscores(event) {
        const inputField = document.getElementById('column_name');	
        const currentValue = inputField.value;
		// var input = $("#search");

        // Check if the pressed key is a space
        if (event.key === ' ') {
            // Replace space with underscore
            inputField.value = currentValue + '_';

            // Prevent the default space character input
            event.preventDefault();
        }
    }
	function filterList() {
        var input, filter, ul, li, i, txtValue;
        input = document.getElementById("list");
        filter = input.value.toUpperCase();
        ul = document.getElementById("column_list");
        li = ul.getElementsByTagName("li");
		// console.log(li.length);
        for (i = 0; i < li.length; i++) {
            txtValue = li[i].textContent || li[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "block";
            } else {
                li[i].style.display = "none";
				var value = input.value;
				ul.html('<li><button class="dropdown-item list_item d-flex" type="button"><span>'+value+'</span><span class="text-success ms-auto">+ add</span></button></li>');
            }
        }
    }

    
    $(document).ready(function () {

		$('body').on('click','#import_csv',function() {
			window.location.href = '<?= base_url('add_data_module'); ?>';
		});	

		$('body').on('click','.list_item',function(e){
			e.preventDefault();
			var text = $(this).text();
			console.log(text);
			text = text.replace('+ add','');
			$(this).closest('.main-selectpicker').find('input').val(text);
		});
		
		var ii = 1;
		$('body').on('keyup', '#list', function (event) {
			var input, filter, ul, li, i, txtValue;
			input = $(this);
			input_val = input.val().trim();
			filter = input_val.toUpperCase();
			ul = input.closest('.main-selectpicker').find("ul");
			li = ul.find("li");
			
			if (event.key === ' ') {
				input_val = input_val.replace(/ /g, '_');
				input.val(input_val);
			}

			var found = false;

			for (i = 0; i < li.length; i++) {
				txtValue = li.eq(i).text();
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					li.eq(i).css("display", "block");
					found = true;
				} else {
					li.eq(i).css("display", "none");
				}
			}

			if (!found) {
				ul.append('<li><button class="dropdown-item list_item d-flex" type="button"><span>' + input_val + '</span><span class="text-success ms-auto">+ add</span></button></li>');
			}
		});



        $('body').on('click','#column_add',function(e){
            e.preventDefault();
            var column_name = $('#column_name').val();
            var formselect = $('form[name="column_data_form"] select');
    
            formselect.append('<option value="'+column_name+'">'+column_name+'</option>');
            $('.selectpicker').selectpicker('refresh');
            $('#column_add_form .modal-close-btn').trigger('click');
            $('#column_name').val('');
    
            return false;
        });


        $('body').on('click','#import_inquiry_csv_btn',function(e) {
            e.preventDefault();
            var form = $('form[name="import_inquiry_csv"]')[0];
            var formdata = new FormData(form);
            var file = $('#import_file').val();
            if(file != ''){
                $.ajax({
					method: "post",
					url: "<?= site_url('get_data_header_by_file'); ?>",
					data: formdata,
					processData: false,
					contentType: false,
					success: function(res) {
						var responce = JSON.parse(res);
						$('.loader').hide();
                        $('.modal-close-btn').trigger('click');
                        $('.file_columns').html(responce.html);
                        $('.column-btn').html(responce.btn_html);
                        $('.selectpicker').selectpicker('refresh');
					},
                });
            }
        });

        $('body').on('click','#import_btn',function (e) {
            e.preventDefault();
            var import_form = $('form[name="import_inquiry_csv"]')[0];
            var col_data_form = $('form[name="column_data_form"]')[0];
            var import_formdata = new FormData(import_form);
            var col_data_formdata = new FormData(col_data_form);
            col_data_formdata.forEach(function(value, key) {
                import_formdata.append(key, value);
            });
            // if(file != ''){
                $.ajax({
					method: "post",
					url: "<?= site_url('import_file_data'); ?>",
					data: import_formdata,
					processData: false,
					contentType: false,
					beforeSend: function (f) {
                        $('.loader').show();
                    },
					success: function(res) {
						$('.loader').hide();
						$('.modal-close-btn').trigger('click');
                        $('.selectpicker').selectpicker('refresh');
						iziToast.success({
							title: 'data imported successfully'
						});
                        data_module_list_data();
					},
                });
            // }
        });

		$('body').on('change','#project_length_show',function() {
			data_module_list_data();
		});

		$('#project_filter input[type="search"]').on('keyup', function(e) {
			if (e.which == 13) {
				$('.inq_pagination').twbsPagination('destroy');
				var input = $(this).val().toLowerCase();
				var table = $('#today-follow-feedback');
				var rows = table.find('tbody tr');
				data_module_list_data('',input);
			}
		});

        function data_module_list_data(pageNumber = 1,input){
            perPageCount = $('#project_length_show').val();
			length = $('#project_length_show').val();
			// console.log(perPageCount);
			if ($(".filter-show").html() != "") {
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				formdata.append('pageNumber', pageNumber);
				formdata.append('ajaxsearch', input);
				formdata.append('perPageCount', perPageCount);
				formdata.append('length', length);

				var data = formdata;
				var processdd = false;
				var contentType = false;
			} else {
				var data = {
					'pageNumber': pageNumber,
					'perPageCount': perPageCount,
					'action' : true,
					'perPageCount' : length,
				};
				var processdd = true;
				var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
			}
			var totalData = [];
			$.ajax({
				datatype: 'json',
				method: "POST",
				url: 'data_module_list_data',
				data: data,
				processData: processdd,
				contentType: contentType,
				success: function(res) {
					var result = JSON.parse(res);
					// console.log(result);
					if (result.export_data) {
						totalData = totalData.concat(result.export_data);
						generateCSV(totalData);
					}
					if (result.response == 1) {
						if (result.total_page == 0 || result.total_page == '') {
							total_page = 1;
						} else {
							total_page = result.total_page;
						}
						$('#row_count').html(result.row_count_html);
						$('.list_data').html(result.html);

						$('.inq_pagination').twbsPagination({
							totalPages: total_page,
							visiblePages: 2,
							next: '>>',
							prev: '<<',
							onPageClick: function(event, page) {
								data_module_list_data(page, perPageCount);
							}
						});
					}
				}
			});
        }
        data_module_list_data();

		function fillter_list(){
			$.ajax({
				datatype: 'json',
				method: "POST",
				url: 'fillter_list',
				success: function(res) {
					var result = JSON.parse(res);
					$('.filter_data').html(result.html);
				}
			});
		}
		// fillter_list();


		$(".filter_data input,.filter_data select").change(function() {
			console.log($(this).val());
			var form = $("form[name='filter_form']")[0];
			$('.inq_pagination').twbsPagination('destroy');
			var perPageCount = $('#project_length_show').val();
			var formdata = new FormData(form);
			formdata.append('action', 'filter');
			data_status = $("#f_inquiry_status").val();
			// console.log(data_status);
			<?php if (isset($_REQUEST['followup'])) { ?>
												var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
			<?php } else { ?>
												var follow_up_day = '';
			<?php } ?>
			if ($(".filter-show").html() != "") {
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				formdata.append('follow_up_day', follow_up_day);
			} else {
				formdata = '';
			}
			data_module_list_data();
		});
		$('body').on('click', '#filter-showw p', function() {
			$('.inq_pagination').twbsPagination('destroy');
			var perPageCount = $('#project_length_show').val();
			if ($(".filter-show").html() != "") {
				data_status = $("#f_inquiry_status").val();
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
				formdata.append('follow_up_day', follow_up_day);
			} else {
				formdata = '';
			}
			data_module_list_data();
		});
		$("#clear").click(function() {
			$('.inq_pagination').twbsPagination('destroy');
			<?php if (isset($_REQUEST['followup'])) { ?>
													var follow_up_day = '<?php echo $_REQUEST['followup']; ?>';
			<?php } else { ?>
													var follow_up_day = '';
			<?php } ?>
			if ($(".filter-show").html() != "") {
				formdata.append('follow_up_day', follow_up_day);
				$data_status = $("#f_inquiry_status").val();
				var form = $("form[name='filter_form']")[0];
				var formdata = new FormData(form);
				formdata.append('action', 'filter');
			} else {
				formdata = '';
				$data_status = '';
			}
			$('.multiple-select .filter-option-inner-inner').html('Iquiry Status');
			$('.today-follow-tabs li button[data-inquiry=""]').trigger('click');
			data_module_list_data();
		});
    });
</script>