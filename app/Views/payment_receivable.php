<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>


<style>

</style>

<div class="main-dashbord p-2">
    <div class="container-fluid">
        <div class="row m-0">
            <div class="col-xl-12 d-flex justify-content-between">
                <div class="user-icon d-flex align-items-center">
                    <i class="bi bi-credit-card me-2"></i>
                    <p>Post Upload</p>
                </div>
                <div class="user-list-btn">
                    <span id="deleted-all" class=" btn-primary-rounded elevation_add_button add-button"
                        style="display: none;"><i class="bi bi-trash3"></i></span>
                    <!-- <button id="deleteButton" class="btn-primary-rounded hide" style=""><i class="fi fi-rr-trash"></i></button> -->
                    <span class="btn-primary-rounded elevation_add_button add-button" data-bs-toggle="modal"
                        data-bs-target="#Adduser" data-bs-dismiss="modal" data-delete_id="">
                        <i class="fas fa-plus"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded-2 p-3 mt-3 payment-calender">
            <div id="calendar"></div>
        </div>
    </div>
</div>
Explain
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="stecelender" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 ">

                <div class="col-3 border rounded-2 p-2 my-2">
                    <div class="upload-btn-wrapper col-12">
                        <div class="file-btn col-12  ">
                            <div class="col-12 justify-content-center d-flex">
                            <i class="bi bi-images"></i>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                          <h5>Drag & drop or select a file</p>
                            </div>      
                            
                        </div>
                        <input class="form-control main-control" id="attachment" name="attachment[]" multiple=""
                            type="file" placeholder="">
                    </div>
                </div>
                <div class="modal-footer flex-wrap justify-content-between">
                    <div class="col-6 d-flex m-0 align-items-center">
                        <div>
                            <span>Schedule date:</span>
                            <span class="fw-bolder"></span>
                        </div>
                        <button class="border rounded-3 py-1 px-3 mx-2" id="date2">Edit</button>
                    </div>
                    <div class="col-6 m-0 d-flex justify-content-end flex-wrap">
                        <div class="btn-group mx-2">
                            <button class="btn btn-secondary btn-lg" type="button">
                                Large split
                            </button>
                            <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <!-- <ul class="dropdown-menu">
                                ...
                            </ul> -->
                        </div>
                        <div class="btn-group mx-2">
                            <button class="btn btn-secondary btn-lg" type="button">
                                Large split
                            </button>
                            <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                                                                                                                                                                                                                                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek'
                },
                defaultDate: new Date(), // Set default date to the current date
                navLinks: true,
                editable: true,
                eventLimit: true,
                events: [
                    // Your events go here
                ]
            });
        });

        $(document).ready(function () {
            $('.fc-day').attr('data-bs-toggle', 'modal');
            $('.fc-day').attr('data-bs-target', '#stecelender');
        });

        $('.fc-month-button').click(function () {
            $('.fc-day').attr('data-bs-toggle', 'modal');
            $('.fc-day').attr('data-bs-target', '#stecelender');

        });

        $(document).on('click', '.fc-basicWeek-button', function () {
            $('.fc-day').attr('data-bs-toggle', 'modal');
            $('.fc-day').attr('data-bs-target', '#stecelender');
        });
        
        $('#date2').bootstrapMaterialDatePicker({
                format: 'DD-MM-YYYY',
                time: true,
                clearButton: true
        });


    </script>
    <?= $this->include('partials/footer') ?>
    <?= $this->include('partials/vendor-scripts') ?>