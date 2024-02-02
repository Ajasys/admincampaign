<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
   $get_roll_id_to_roll_duty_var = array();
} else {
   $get_roll_id_to_roll_duty_var = get_roll_id_to_roll($_SESSION['role']);
}
?>
<style>
	.col img{
		width: 13%;
	}
	.col span{
		font-size: 16px;
		font-weight: 400;
	}
	.form-control{
		width: 200%;
	}
</style>

<div class="user-main">
    <div class="container-fluid">
        <div class="row row-main">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="user-icon d-flex align-items-center">
				<i class="fi fi-rr-hands-usd"></i>                    
				<p>Manage Payment Mode</p>
                </div>
                <div class="user-list-btn">
                <?php if (in_array('payment_management_child_delete_child_access', $get_roll_id_to_roll_duty_var) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) { ?>
                <button id="deleteButton" class="btn-primary-rounded hide" style=""><i class="fi fi-rr-trash"></i></button>
                <?php } ?>
                    <span class="btn-primary-rounded elevation_add_button add-button" data-bs-toggle="modal" data-bs-target="#cust-m-add" >
                        <i class="fas fa-plus"></i>
                    </span>
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
                    <div id="user_table_wrapper" class="dataTables_wrapper no-footer">
                        <div class="dataTables_length" id="user_table_length">
                            <label>
                                Show
                                <select name="user_table_length" aria-controls="user_table" class="">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                entries
                            </label>
                        </div>
                        <div id="user_table_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="" placeholder="" aria-controls="user_table" /></label>
                        </div>
                        <table id="user_table" class="table table-striped dt-responsive nowrap user-tables table-background-color no-footer dtr-inline dataTable" style="width: 100%;" aria-describedby="user_table_info">
                            <thead class="table-heading">
                                <tr class="main">
                                    <th
                                        class="sorting sorting_asc"
                                        tabindex="0"
                                        aria-controls="user_table"
                                        rowspan="1"
                                        colspan="1"
                                        style="width: 45px;"
                                        aria-label="
                                             
                                        : activate to sort column descending"
                                        aria-sort="ascending"
                                    >
                                        <input class="mx-0" type="checkbox" id="select-all" />
                                    </th>
                                    <th
                                        class="sorting"
                                        tabindex="0"
                                        aria-controls="user_table"
                                        rowspan="1"
                                        colspan="1"
                                        style="width: 1711px;"
                                        aria-label="
                                             User
                                        : activate to sort column ascending"
                                    >
                                        <span>User</span>
                                    </th>
                                </tr>
                            </thead>
                            <!-- <tbody id="payment_mode_list">
                                <tr class="odd">
                                    <td class="t-check dtr-control sorting_1" tabindex="0">
                                        <input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="1" />
                                    </td>
                                    <td class="edt" data-edit_id="1">
                                        <div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                                <div class="col">
                                                    <img src="https://gymsmart.in/assets/image/paytm.png" alt="Paytm" />
                                                    <span class="mx-2">Paytm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="t-check dtr-control sorting_1" tabindex="0">
                                        <input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="2" />
                                    </td>
                                    <td class="edt" data-edit_id="2">
                                        <div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                                <div class="col">
                                                    <img src="https://gymsmart.in/assets/image/cash.png" alt="cash" />
                                                    <span class="mx-2">cash</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="t-check dtr-control sorting_1" tabindex="0">
                                        <input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="3" />
                                    </td>
                                    <td class="edt" data-edit_id="3">
                                        <div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                                <div class="col">
                                                    <img src="https://gymsmart.in/assets/image/gpay.png" alt="Google Pay" />
                                                    <span class="mx-2">Google Pay</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="t-check dtr-control sorting_1" tabindex="0">
                                        <input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="12" />
                                    </td>
                                    <td class="edt" data-edit_id="12">
                                        <div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                                <div class="col">
                                                    <img src="https://gymsmart.in/assets/image/phonepay.png" alt="PhonePay" />
                                                    <span class="mx-2">PhonePay</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody> -->
							<tbody id="payment_mode_list">
								<tr class="even">
									<td class="t-check dtr-control sorting_1" tabindex="0">
									<input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="1">
									</td>
									<td class="edt">
									<div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
										<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
											<div class="col">
												<img src="https://gymsmart.in/assets/image/paytm.png" alt="Paytm">
												<span class="mx-2">Paytm</span>
											</div>
										</div>
									</div>
								</td>
								</tr>
								<tr class="even">
									<td class="t-check dtr-control sorting_1" tabindex="0">
									<input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="1">
									</td>
									<td class="edt">
									<div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
										<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
											<div class="col">
											<img src="https://gymsmart.in/assets/image/cash.png" alt="cash" />
                                            <span class="mx-2">cash</span>
											</div>
										</div>
									</div>
								</td>
								</tr>
								<tr class="even">
									<td class="t-check dtr-control sorting_1" tabindex="0">
									<input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="1">
									</td>
									<td class="edt">
									<div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
										<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
											<div class="col">
											<img src="https://gymsmart.in/assets/image/gpay.png" alt="Google Pay" />
                                            <span class="mx-2">Google Pay</span>
											</div>
										</div>
									</div>
								</td>
								</tr>
								<tr class="cust">
									<td class="t-check dtr-control sorting_1" tabindex="0">
									<input class="checkbox mx-3 mt-2 cstm-check" type="checkbox" id="select-all" data-delete_id="1">
									</td>
									<td class="edt">
									<div class="px-0 py-0 w-100" data-bs-target="#payment_mode_edit" data-bs-toggle="modal">
										<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
											<div class="col">
											<img src="https://gymsmart.in/assets/image/phonepay.png" alt="PhonePay" />
                                            <span class="mx-2">PhonePay</span>
											</div>
										</div>
									</div>
								</td>
								</tr>
								
							</tbody>
                        </table>
                        <div class="dataTables_info" id="user_table_info" role="status" aria-live="polite">Showing 1 to 10 of 26 entries</div>
                        <div class="dataTables_paginate paging_simple_numbers" id="user_table_paginate">
                            <a class="paginate_button previous disabled" aria-controls="user_table" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="-1" id="user_table_previous">Previous</a>
                            <span>
                                <a class="paginate_button current" aria-controls="user_table" aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0">1</a>
                                <a class="paginate_button" aria-controls="user_table" aria-role="link" data-dt-idx="1" tabindex="0">2</a>
                                <a class="paginate_button" aria-controls="user_table" aria-role="link" data-dt-idx="2" tabindex="0">3</a>
                            </span>
                            <a class="paginate_button next" aria-controls="user_table" aria-role="link" data-dt-idx="next" tabindex="0" id="user_table_next">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cust-m-add" tabindex="-1" aria-labelledby="add_notesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="add_notesModalLabel">Add Payment Mode</h5>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fi fi-rr-cross-circle fs-5"></i></button>
            </div>
            <form class="needs-validation" name="notes_update_form" method="POST" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 input-text">
                            <label for="form-Occupation" class="form-label investor">Payment mode name*</label>
                            <input type="text" class="form-control place" id="form-food" placeholder="Bank Transfer">
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-submit" id="cancel" data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-delete_id="1">Cancel</button>
                            <button type="button" class="btn btn-submit" id="add" data-edit_id="1" data-bs-dismiss="modal"
                                name="add_notes_submit" value="add_notes_submit">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
