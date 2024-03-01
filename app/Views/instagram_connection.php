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
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 48 48">
                                                    <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38" cy="42.035" r="44.899" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#fd5"></stop>
                                                        <stop offset=".328" stop-color="#ff543f"></stop>
                                                        <stop offset=".348" stop-color="#fc5245"></stop>
                                                        <stop offset=".504" stop-color="#e64771"></stop>
                                                        <stop offset=".643" stop-color="#d53e91"></stop>
                                                        <stop offset=".761" stop-color="#cc39a4"></stop>
                                                        <stop offset=".841" stop-color="#c837ab"></stop>
                                                    </radialGradient>
                                                    <path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                                    </path>
                                                    <radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786" cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#4168c9"></stop>
                                                        <stop offset=".999" stop-color="#4168c9" stop-opacity="0">
                                                        </stop>
                                                    </radialGradient>
                                                    <path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                                    </path>
                                                    <path fill="#fff" d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z">
                                                    </path>
                                                    <circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle>
                                                    <path fill="#fff" d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z">
                                                    </path>
                                                </svg>
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
