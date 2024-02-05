<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<?php $table_username = getMasterUsername(); ?>

<style>
    textarea:focus {
        outline: none;
    }
    li {
        cursor: pointer;
        padding: 10px;
        border-bottom: 2px solid transparent;
        }
        
    li.active {
    border-color: #724ebf;
    }
</style>


<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1">
                <i class="bi bi-gear-fill"></i>
                <h2>Create</h2>
            </div>
            <div class="col-12 d-flex flex-wrap ">
                <div class="col-3 p-2">
                    <div class="col-12 border rounded-3 bg-white p-3 d-flex flex-wrap flex-column justify-content-between">
                        <div class="input-group mb-3 col-6">
                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <div class="d-flex flex-wrap justify-content-center">
                                <img src="https://cdn.publer.io/on-board-social-accounts.png" alt="#">
                                <p class="px-3 text-center col-8 fs-5 my-3">Start by adding your social accounts</p>
                                <div class="col-12 my-2">
                                    <a href="<?= base_url(); ?>add_account" class="btn bg-transperent rounded-2 border"><i class="bi bi-plus-lg me-1"></i>Add Account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 p-2">
                    <div class="card-header col-12 border rounded-3 bg-white d-flex flex-column flex-wrap justify-content-between h-100">
                        <div class="col-12  border-bottom ">
                            <div class="border-bottom p-3 col-12">
                                <button class="border bg-transparent px-3 py-2 rounded-2 text-muted">Add label</button>
                            </div>
                            <div class="col-12 ">
                                <nav class="nav">
                                    <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                                        <li class="nav-item active" role="presentation">
                                            <a class="nav-link bg-white text-primary " id="pills-master-diet" data-bs-toggle="pill" data-bs-target="#pills-master-diet-tab" href="#">Update</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link bg-white text-primary" id="pills-all-diet" data-bs-toggle="pill" data-bs-target="#photo-all-tab" href="#">Photo</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link bg-white text-primary" id="pills-all-event" data-bs-toggle="pill" data-bs-target="#event-all-tab" href="#">Event</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link bg-white text-primary" id="pills-all-offer" data-bs-toggle="pill" data-bs-target="#offer-all-tab" href="#">Offer</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="col-12">
                                    <div class="tab-content active show" id="pills-tabContent">
                                        <div class="tab-pane fade" id="pills-master-diet-tab" role="tabpanel" aria-labelledby="update-all-tab-modal" tabindex="0">
                                            <div class="col-12  tab-compo">
                                                <div class="card-body p-2">
                                                    <div class="col-12 border rounded  p-3">
                                                        <textarea cols="30" rows="5" class="col-12 border-0" placeholder="Write something or use shortcodes, spintax..... "></textarea>
                                                        <button class="border-0 col-12 mt-4 rounded-pill px-4 py-2 fw-semibold text-muted " data-bs-toggle="modal" data-bs-target="#get_file" type="file" style="background:#F3F3F3;">
                                                            Click or Drag & Drop Media

                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="photo-all-tab" role="tabpanel" aria-labelledby="photo-all-tab-modal" tabindex="0">
                                            <div class="col-12  tab-compo">
                                                <div class="card-body p-2">
                                                    <div class="col-12 border rounded  p-3">
                                                        <textarea cols="30" rows="5" class="col-12 border-0" placeholder="Write something or use shortcodes, spintax..... "></textarea>
                                                        <button class="border-0 col-12 mt-4 rounded-pill px-4 py-2 fw-semibold text-muted " data-bs-toggle="modal" data-bs-target="#get_file" type="file" style="background:#F3F3F3;">
                                                            Click or Drag & Drop Media

                                                        </button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <div class="main-selectpicker">
                                                            <select id="approx_buy" name="approx_buy" class="selectpicker form-control form-main" data-live-search="true" required>
                                                                <i class="fa-solid fa-caret-down"></i>
                                                                <option class="dropdown-item" value="">Unspecified</option>
                                                                <option class="dropdown-item" value="2-3 days">Cover</option>
                                                                <option class="dropdown-item" value="week">Profile</option>
                                                                <option class="dropdown-item" value="week">Buy</option>
                                                                <option class="dropdown-item" value="week">Logo</option>
                                                                <option class="dropdown-item" value="week">Exteriro</option>
                                                                <option class="dropdown-item" value="week">Interior</option>
                                                                <option class="dropdown-item" value="week">Product</option>
                                                                <option class="dropdown-item" value="week">At-Work</option>
                                                                <option class="dropdown-item" value="week">Food ANd Drink</option>
                                                                <option class="dropdown-item" value="week">Menu</option>
                                                                <option class="dropdown-item" value="week">Comman Area</option>
                                                                <option class="dropdown-item" value="week">Rooms</option>
                                                                <option class="dropdown-item" value="week">Workspaces</option>
                                                                <option class="dropdown-item" value="week">Additional</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="event-all-tab" role="tabpanel" aria-labelledby="event-all-tab-modal" tabindex="0">
                                            <div class="col-12  tab-compo">
                                                <div class="card-body p-2 d-flex flex-wrap">
                                                <div class="col-12 my-1 p-1">
                                                        <div class="col-12">
                                                            <input type="text" class="form-control p-2" id="event_title"
                                                                placeholder="Event Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 my-1 p-1">
                                                        <div class="col-12">
                                                            <input type="text" class="form-control p-2 offer_start_date"
                                                                id="event_start_date" placeholder="Start Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 my-1 p-1">
                                                        <div class="col-12">
                                                            <input type="text" class="form-control p-2 event_end_date"
                                                                id="event_end" placeholder="End Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-1 p-1">
                                                        <div class="col-12 border rounded p-3">
                                                            <textarea cols="30" rows="5" class="col-12 border-0"
                                                                placeholder="Write something or use shortcodes, spintax..... "></textarea>
                                                            <button
                                                                class="border-0 col-12 mt-4 rounded-pill px-4 py-2 fw-semibold text-muted "
                                                                data-bs-toggle="modal" data-bs-target="#get_file"
                                                                type="file" style="background:#F3F3F3;">
                                                                Click or Drag & Drop Media

                                                            </button>
                                                            <div class="col-lg-3 mx-1 my-2 col-md-4 col-sm-6">
                                                        <div class="main-selectpicker">
                                                            <select id="approx_buy" name="approx_buy" class="selectpicker form-control form-main" data-live-search="true" required>
                                                                <i class="fa-solid fa-caret-down"></i>
                                                                <option class="dropdown-item" value="">No Button</option>
                                                                <option class="dropdown-item" value="2-3 days">BOOK</option>
                                                                <option class="dropdown-item" value="week">Order Online</option>
                                                                <option class="dropdown-item" value="week">Buy</option>
                                                                <option class="dropdown-item" value="week">Learn More</option>
                                                                <option class="dropdown-item" value="week">Sign Up</option>
                                                                <option class="dropdown-item" value="week">Call Now</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="offer-all-tab" role="tabpanel"  aria-labelledby="offer-all-tab-modal" tabindex="0">
                                            <div class="col-12  tab-compo">
                                                <div class="card-body p-2 d-flex flex-wrap">
                                                <div class="col-12 my-1 p-1">
                                                        <div class="col-12">
                                                            <input type="text" class="form-control p-2" id="event_title"
                                                                placeholder="Offer Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 my-1 p-1">
                                                        <div class="col-12">
                                                            <input type="text" class="form-control p-2 offer_start_date"
                                                                id="event_title" placeholder="Start Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 my-1 p-1">
                                                        <div class="col-12">
                                                            <input type="text" class="form-control p-2 offer_end_date"
                                                                id="event_title" placeholder="End Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-1 p-1">
                                                        <div class="col-12 border rounded p-3">
                                                            <textarea cols="30" rows="5" class="col-12 border-0"
                                                                placeholder="Write something or use shortcodes, spintax..... "></textarea>
                                                            <button
                                                                class="border-0 col-12 mt-4 rounded-pill px-4 py-2 fw-semibold text-muted mb-2 "
                                                                data-bs-toggle="modal" data-bs-target="#get_file"
                                                                type="file" style="background:#F3F3F3;">
                                                                Click or Drag & Drop Media
                                                            </button>
                                                            <div class="row col-12">
                                                                <div class="col-md-4 my-1 ">
                                                                    <input type="text" placeholder="Coupon code (optional)" class="form-control" value="">
                                                                </div>
                                                                <div class="col-md-8 my-1 u-padding-left-md-0-isImportant u-margin-top-0-mobile-10 u-margin-top-sm-10">
                                                                    <input type="text" placeholder="Link to redeem offer (optional)" class="form-control" value="">
                                                                </div>
                                                                <div class="col-md-12 my-1 u-margin-bottom-10 undefined">
                                                                    <textarea rows="1" placeholder="Terms and conditions (optional)" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="pills-all-diet-tab" role="tabpanel" aria-labelledby="pills-all-diet" tabindex="0">
                                            <div class="main-dashbord p-2 main-check-class">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top p-2 px-4 d-flex  align-content-center flex-wrap">
                        <div class="col-4">
                                <button class="bg-transparent border-0 text-muted">
                                    <i class="fa-regular fa-clone me-2 "></i>Bulk Option
                                </button>
                            </div>
                            <div class="col-8 d-flex  flex-wrap justify-content-end ">
                                <button class="btn btn-outline-secondary mx-1">
                                    Draft
                                </button>
                                <button class="btn btn-primary mx-1">
                                    Publish
                                </button>
                                <button class="btn btn-secondery mx-1 Scedual_start_date">
                                    Scedual
                                </button>
                                <div class="btn-group dropup btn-outline-dark mx-1">
                                    <button type="button" class="btn btn-outline-dark rounded-3" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-angle-up"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- modal-section-->
<div class="modal fade " id="get_file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 ">
                <div class="col-12 p-3">
                    <div class="col-12 border rounded-2 p-2 my-2">
                        <div class="upload-btn-wrapper col-12">
                            <div class="file-btn col-12  p-3">
                                <div class="col-12 justify-content-center d-flex">
                                    <i class="bi bi-images"></i>
                                </div>
                                <div class="col-12 justify-content-center d-flex">
                                    <h5>Drag &amp; drop or select a file<p></p>
                                    </h5>
                                </div>

                            </div>
                            <input class="form-control main-control" id="attachment" name="attachment[]" multiple="" type="file" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-wrap ">
                <button class="btn btn-secondary btn-lg" type="button">
                    Large split
                </button>
            </div>
        </div>
    </div>
</div>

<script>
  
        $('.offer_start_date').bootstrapMaterialDatePicker({
               format:  'DD-MM-YYYY h:m A',
               cancelText: 'cancel',
               okText: 'ok',
               clearText: 'clear',
               time: true,
               date: true,
          }).on('change', function (e, date) {
            var startDate = moment(date, 'DD-MM-YYYY ');
            var endDate = startDate.clone().add(7, 'days');
            $('.offer_end_date').val(endDate.format('DD-MM-YYYY h:m A'));
        });


          $('.offer_end_date').bootstrapMaterialDatePicker({
               format: 'DD-MM-YYYY h:m A',
               cancelText: 'cancel',
               okText: 'ok',
               clearText: 'clear',
               time: true,
               date: true,
          });
    
          $('#event_end').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY h:m A',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: true,
            date: true,
          
        });
        $('#event_start_date').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY h:m A',
            cancelText: 'cancel',
            okText: 'ok',
            clearText: 'clear',
            time: true,
            date: true,
        }).on('change', function (e, date) {
            var startDate = moment(date, 'DD-MM-YYYY ');
            var endDate = startDate.clone().add(7, 'days');
            $('#event_end').val(endDate.format('DD-MM-YYYY h:m A'));
        });


            $('.nav-item').click(function() {
            $('.nav-item').removeClass('active');
            $(this).addClass('active');
  });
  
</script>


<?= $this->include('partials/footer') ?>