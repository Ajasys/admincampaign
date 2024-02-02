<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex justify-content-between">
                <div class="title-1 d-flex align-items-center">
                    <i class="fa-regular fa-credit-card me-2"></i>
                    <h2>Voucher Type</h2>
                </div>
                <div class="user-list-btn">
                    <span class="btn-primary-rounded elevation_add_button add-button" data-bs-toggle="modal"
                        data-bs-target="#add_voucher" data-bs-dismiss="modal" data-delete_id="">
                        <i class="bi bi-plus"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 bg-white rounded-2 mx-2 mb-2">
            <table id="management-department" class="table main-table w-100">
                <thead>
                    <tr>
                        <th>
                            <input class="mx-3" type="checkbox" id="select-all"/>
                        </th>
                        <th>
                            <span>Voucher Type</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="voucher_type_data"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="add_voucher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add Voucher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="main-label">Email address</label>
                <input type="text" class="form-control main-control" id="voucher_type" placeholder="Voucher">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary voucher_sbt">Submit</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script>
    $(document).ready(function () {
        function list_data() {
            $.ajax({
                datatype: 'json',
                method: 'post',
                url: '<?= site_url('voucher_type_list_data'); ?>',
                data: {
                    action: true,
                    table: 'voucher_type',
                },
                success: function (res) {
                    $('.voucher_type_data').html(res);
                }
            });
        }
        list_data();
    });
</script>