<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
    .sm-btn {
        padding: 2px 4px;
    }
    .Success {
        background-color: #41b039;
    }
    .Warning {
        background-color: #dacb00;
    }
    .Error {
        background-color: #ff0000;
    }
    .Info {
        background-color: #0D6EFD;
    }
    .main-table.lead_list_table tbody tr:nth-child(even) {
        background-color: #edd9ff29;
    }
    @media(min-width:990px) {
        .responsivetable {
            overflow: visible !important;
        }
    }
    .big_circle_fb_inner {
        background-color: #1876ef;
        box-shadow: inset 0 0 15px 0 #24242469;
    }
</style>

<div class="main-dashbord p-3">
    <div class="container-fluid p-0">
        <div>
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="title-1  d-flex align-items-center">
                    <i class="fa-brands fa-instagram transition-5 icon2 rounded-circle" style="font-size: 35px;color: #8601d5;"></i>
                    <h2>Instagram Connections</h2>
                </div>
                <div class="d-flex align-items-center justify-content-end  col-1">
                    <button data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#fbCntModal" class="btn-primary-rounded mx-2">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="p-2">
                <div class="col-12 py-3 px-3 bg-white rounded-2">
                    <div class="w-100 overflow-x-scroll scroll-small row_none responsivetable">
                        <div class="attendence-search mb-1 d-flex align-items-center flex-wrap justify-content-between">
                            <div class="dataTables_length" id="project_length">
                                <label>
                                    Show
                                    <select name="project_length" id="fb_length_show" aria-controls="project" class="table_length_select_check_2">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    Records
                                    <span class="list_count"></span>
                                </label>
                            </div>
                            <div id="people_wrapper" class="dataTables_wrapper no-footer">
                                <div id="fb_filter" class="dataTables_filter justify-content-end d-flex py-1 py-sm-0">
                                    <label>Search:<input type="search" class="" placeholder="" aria-controls="project"></label>
                                </div>
                            </div>
                        </div>
                        <table id="leadTable" class="table main-table w-100">
                            <thead>
                                <tr>
                                    <th class="p-2 text-nowrap"><span>App Name</span></th>
                                    <th class="p-2 text-nowrap"><span>App Id </span></th>
                                    <th class="p-2 text-nowrap"><span>Type</span></th>
                                    <th class="p-2 text-nowrap"><span></span></th>
                                    <th class="p-2 text-nowrap"><span>Status</span></th>
                                    <th class="p-2 text-nowrap text-center"><span></span></th>
                                </tr>
                            </thead>
                            <tbody id="instagram_list_data">
                                <tr>
                                        <th class="p-2 text-nowrap"><span>App Name.....</span></th>
                                        <th class="p-2 text-nowrap"><span>App Id.... </span></th>
                                        <th class="p-2 text-nowrap"><span>Type....</span></th>
                                        <th class="p-2 text-nowrap"><span></span></th>
                                        <th class="p-2 text-nowrap"><span>Status.....</span></th>
                                        <th class="p-2 text-nowrap text-center"><span></span></th>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="fbCntModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Connection</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="col-6">
                                <div class="main-selectpicker">
                                    <select class="form-control main-control from-main selectpicker border-dark border text-dark" aria-label="Default select example">
                                        <option value="" >Main Flow</option>
                                        <option value="">Main Flow</option>
                                        <option value="">Main Flow</option>
                                        <option value="">Main Flow</option>
                                        <option value="">Main Flow</option>
                                        <option value="">Main Flow</option>
                                        <option value="">Main Flow</option>

                                    </select>
                                </div>
                            </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" >Save</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
