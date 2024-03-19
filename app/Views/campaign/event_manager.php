<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<style>
     .nav-link {
          color: black;
     }

     .nav-link:focus,
     .nav-link:hover {
          color: #b55dcd !important;
     }

     .nav-tabs {
          border: none;
     }

     .dropdown-menu .dropdown-item:hover {
          background-color: var(--first-color) !important;
          color: white !important;
     }
</style>

<div class="container p-2 " style="max-width: 1490px;">

     <div class="col-12 d-flex justify-content-between ">
          <h3>Data Source</h3>
          <div class="main-selectpicker col-3">
               <select name="" id="" class="selectpicker form-control main-control form-main">
                    <option value="">Ajasys technology(623005)</option>
               </select>
          </div>
     </div>
     <div class="col-12 d-flex">
          <div class="col-3 mx-2 rounded border me-5 p-3">
               <div class="input-group my-2">
                    <input type="text" class="form-control main-control" placeholder="Search by name or id">
                    <button class="btn btn-outline-dark" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
               </div>
               <div class="d-flex p-3 user_id">
                    <div class="m-2 d-flex justify-content-center align-items-center p-2 rounded" style=" background: lightgray;"><i class="fa-solid fa-laptop"></i></div>
                    <div>
                         <div>spiffy checkout pixel</div>
                         <div class="text-muted fs-12">ID 2456767878898980909-090</div>
                    </div>
               </div>
               <div class="d-flex p-3 user_id">
                    <div class="m-2 d-flex justify-content-center align-items-center p-2 rounded" style=" background: lightgray;"><i class="fa-solid fa-laptop"></i></div>
                    <div>
                         <div>spiffy checkout pixel</div>
                         <div class="text-muted fs-12">ID 2456767878898980909-090</div>
                    </div>
               </div>
               <div class="d-flex p-3 user_id">
                    <div class="m-2 d-flex justify-content-center align-items-center p-2 rounded" style=" background: lightgray;"><i class="fa-solid fa-laptop"></i></div>
                    <div>
                         <div>spiffy checkout pixel</div>
                         <div class="text-muted fs-12">ID 2456767878898980909-090</div>
                    </div>
               </div>

          </div>
          <div class="col-9 p-3 border rounded">
               <div class="rounded-4 col-12 my-2 p-3" style="box-shadow: 0px 2px 2px lightgray;">
                    <div class="col-12 d-flex mb-2">
                         <div class="col-12 d-flex justify-content-between">
                              <div class="d-flex col-6 align-items-center">
                                   <div class="rounded-3 d-flex p-2 justify-content-center align-items-center" style="width: 45px; background: lightgray; height: 45px;"><i class="fa-solid fa-network-wired"></i></div>
                                   <div class="fs-5 mx-2 fw-semibold">RealtoSmart Pixel &nbsp; <i class="fa-solid fa-pen"></i></div>
                              </div>
                              <div class="d-flex col-6  justify-content-end align-items-center">
                                   <!-- -->
                                   <div class="main-selectpicker col-3 mx-2">
                                        <select name="" id="" class="selectpicker form-control main-control form-main">
                                             <option value="">Last 28 day</option>
                                        </select>
                                   </div>
                                   <div class="btn btn-primary mx-2" style="height: 39px;">
                                        Create <i class="fa-solid fa-caret-down"></i>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-12">
                         <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                   <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                   <button class="nav-link" id="test-events-tab" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" role="tab" aria-controls="test-events" aria-selected="false">Test Events</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                   <button class="nav-link" id="diagnostics-tab" data-bs-toggle="tab" data-bs-target="#diagnostics" type="button" role="tab" aria-controls="diagnostics" aria-selected="false">Diagnostics</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                   <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">History</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                   <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                              </li>
                         </ul>
                    </div>
               </div>

               <div class="col-12 d-flex mt-5">
                    <div class="col-9">
                         <div class="fs-6 fw-semibold mb-2 mt-3">Event Activity</div>
                         <div>This chart displays any events from your business' website, mobile app or server that we've processed and received within the selected date range.</div>
                         <div id="chart"></div>
                    </div>
                    <div class="col-3 mx-2 px-3" style="border-left: 1px solid lightgray;">
                         <div class="d-flex col-12 m-3">
                              <div class="mx-2"><i class="fa-solid fa-chart-line"></i></div>
                              <div>
                                   <div class="fw-semibold">1 Active Integration</div>
                                   <div class="text-primary fs-12">manage Integration</div>
                              </div>
                         </div>
                         <div class="d-flex col-12 m-3">
                              <div class="mx-2"><i class="fa-solid fa-globe"></i></div>
                              <div>
                                   <div class="fw-semibold">Website</div>
                                   <div class="text-muted fs-12">realtosmart.com</div>
                                   <div class="text-primary fs-12">+3 more</div>
                              </div>
                         </div>
                         <div class="d-flex col-12 m-3">
                              <div class="mx-2"><i class="fa-solid fa-network-wired"></i></div>
                              <div>
                                   <div class="fw-semibold">Dataset ID</div>
                                   <div class="text-muted fs-12">1554952314998185</div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-12">
                    <div class="d-flex col-12 justify-content-between">
                         <div class="d-flex col-6">
                              <div class="main-selectpicker col-3">
                                   <select name="" id="" class="selectpicker form-control main-control form-main">
                                        <option value="">Add Event</option>
                                   </select>
                              </div>
                         </div>
                         <div class="d-flex col-4 justify-content-end">
                              <div class="input-group rounded-3 border mx-2">
                                   <div class="input-group-prepend">
                                        <div class="btn btn-light "><i class="fa-solid fa-magnifying-glass"></i></div>
                                   </div>
                                   <input type="text" class="form-control form-control-sm border-0">
                                   <div class="input-group-append">
                                        <div class="btn btn-light">10/50</div>
                                   </div>
                              </div>


                              <div class="main-selectpicker col-3">
                                   <select name="" id="" class="selectpicker form-control main-control form-main">
                                        <option value="">Add Event</option>
                                   </select>
                              </div>
                         </div>

                    </div>
               </div>
               <table class="col-12 my-3">
                    <tbody class="border-top border-bottom ">
                         <th class="p-2">Event</th>
                         <th><i class="fa-solid fa-arrow-up-long"></i><i class="fa-solid fa-arrow-down-long"></i></th>
                         <th>Status</th>
                         <th>Used By</th>
                         <th>Integration</th>
                         <th>Event match quality</th>
                         <th>Total event </th>
                         <th><i class="fa-solid fa-arrow-down-long"></i></th>
                    </tbody>
                    <tr>
                         <td class="p-2" style="width:300px;">
                              <div class="d-flex">
                                   <div class="d-flex justify-content-center align-items-center rounded p-2 my-1 mx-2" style="background:lightgray"><i class="fa-solid fa-folder-closed"></i></div>
                                   <div>
                                        <div class="fw-semibold">Page view</div>
                                        <div class="text-muted fs-12"><i class="fa-solid fa-circle text-warning me-1"></i>no recantly view</div>
                                   </div>
                              </div>
                         </td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>Browser</td>
                         <td></td>
                         <td>
                              <div>239</div>
                              <div class="text-muted fs-10">Last received</div>
                              <div class="text-muted fs-10">11 days ago</div>
                         </td>
                         <td></td>
                    </tr>
                    <tr>
                         <td class="p-2" style="width:300px;">
                              <div class="d-flex">
                                   <div class="d-flex justify-content-center align-items-center rounded p-2 my-1 mx-2" style="background:lightgray"><i class="fa-regular fa-eye"></i></div>
                                   <div>
                                        <div class="fw-semibold">View Content</div>
                                        <div class="text-muted fs-12"><i class="fa-solid fa-circle text-success me-1"></i>Active</div>
                                   </div>
                              </div>
                         </td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>multiple<i class="fa-solid fa-circle-info mx-1"></i></td>
                         <td><i class="fa-solid fa-circle-info"></i></td>
                         <td>
                              <div>239</div>
                              <div class="text-muted fs-10">Last received</div>
                              <div class="text-muted fs-10">5 days ago</div>
                         </td>
                         <td></td>
                    </tr>
                    <tr>
                         <td class="p-2" style="width:300px;">
                              <div class="d-flex">
                                   <div class="d-flex justify-content-center align-items-center rounded p-2 my-1 mx-2" style="background:lightgray"><i class="fa-solid fa-book"></i></div>
                                   <div>
                                        <div class="fw-semibold">Complete registration</div>
                                        <div class="text-muted fs-12"><i class="fa-solid fa-circle text-warning me-1"></i>no recantly view</div>
                                   </div>
                              </div>
                         </td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>Browser</td>
                         <td></td>
                         <td>
                              <div>22</div>
                              <div class="text-muted fs-10">Last received</div>
                              <div class="text-muted fs-10">12 days ago</div>
                         </td>
                         <td></td>
                    </tr>
                    <tr>
                         <td class="p-2" style="width:300px;">
                              <div class="d-flex">
                                   <div class="d-flex justify-content-center align-items-center rounded p-2 my-1 mx-2" style="background:lightgray"><i class="fa-solid fa-cash-register"></i></div>
                                   <div>
                                        <div class="fw-semibold">Lead</div>
                                        <div class="text-muted fs-12"><i class="fa-solid fa-circle text-warning me-1"></i>no recantly view</div>
                                   </div>
                              </div>
                         </td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>Browser</td>
                         <td></td>
                         <td>
                              <div>4</div>
                              <div class="text-muted fs-10">Last received</div>
                              <div class="text-muted fs-10">12 days ago</div>
                         </td>
                         <td></td>
                    </tr>
                    <tr>
                         <td class="p-2" style="width:300px;">
                              <div class="d-flex">
                                   <div class="d-flex justify-content-center align-items-center rounded p-2 my-1 mx-2" style="background:lightgray"><i class="fa-regular fa-message"></i></div>
                                   <div>
                                        <div class="fw-semibold">Contact</div>
                                        <div class="text-muted fs-12"><i class="fa-solid fa-circle text-warning me-1"></i>no recantly view</div>
                                   </div>
                              </div>
                         </td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>Browser</td>
                         <td></td>
                         <td>
                              <div>1</div>
                              <div class="text-muted fs-10">Last received</div>
                              <div class="text-muted fs-10">26 days ago</div>
                         </td>
                         <td></td>
                    </tr>

               </table>
          </div>
     </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payload Helper</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body" style="max-height: 450px; overflow: auto;">

                    <label for="">select Product</label>
                    <div class="main-selectpicker col-10">
                         <select class="selectpicker form-control form-main main-control">
                              <option value=""><i class="fa-solid fa-circle-dot mx-2 text-primary"></i>Website</option>
                              <option value="">Conversion lead</option>
                         </select>
                    </div>
                    <div>
                         <div class="fs-5 fw-semibold mt-3">Event Type Parameters</div>
                         <div class="fs-12"> The fields event_name, event_time, and action_source are required for all Conversion Leads CRM events. Note that action_source for CRM events must be set to system_generated.</div>
                    </div>
                    <div class="mt-3 col-10">
                         <div class="fs-6 fw-semibold">event_name</div>
                         <div class="fs-12 text-muted">Type: string</div>
                         <input type="text" class="form-control main-control ">
                    </div>
                    <div class="mt-2 col-10">
                         <div class="fs-6 fw-semibold">event_name</div>
                         <div class="fs-12 text-muted">Type: int</div>
                         <input type="number" class="form-control main-control">
                    </div>
                    <div class="mt-2 col-10">
                         <div class="fs-6 fw-semibold">action_source</div>
                         <div class="fs-12 text-muted">Type:string</div>
                         <div class="main-selectpicker">
                              <select class="selectpicker form-control form-main main-control">
                                   <option value=""><i class="fa-solid fa-circle-dot mx-2 text-primary"></i>system_generated</option>
                                   <option value="">App</option>
                                   <option value="">Chat</option>
                                   <option value="">Email</option>
                                   <option value="">Other</option>
                                   <option value="">Phone Call</option>
                                   <option value="">physical_store</option>
                                   <option value="">business_messaging</option>

                              </select>
                         </div>
                    </div>
                    <div class="append-dv"></div>
                    <div class="mt-2">
                         <div class="dropdown">
                              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                   <i class="fa-solid fa-plus mx-2"></i>Add Event Type Parameter
                              </button>
                              <ul class="dropdown-menu mic-drop-one" aria-labelledby="dropdownMenuButton1">
                                   <li class="event_id"><a class="dropdown-item" href="#">event_id</a></li>
                                   <li class="event_id"><a class="dropdown-item" href="#">opt_out</a></li>
                                   <li class="event_id"><a class="dropdown-item" href="#">data_processing_options</a></li>
                                   <li class="event_id"><a class="dropdown-item" href="#">data_processing_options_country</a></li>
                                   <li class="event_id"><a class="dropdown-item" href="#">data_processing_options_state</a></li>
                              </ul>
                         </div>
                    </div>
                    <div class="my-3  p-3 border rounded">
                         <div>
                              <div class="fs-5 fw-semibold">Customer Information Parameters</div>
                              <div class="fs-12">The customer information parameter lead_id is required for all Conversion Leads CRM events.</div>
                         </div>
                         <div class="mt-2 col-10">
                              <div class="fs-6 fw-semibold">Lead ID (lead_id)</div>
                              <div class="fs-12 text-muted">Type: int</div>
                              <input type="number" class="form-control main-control">
                         </div>
                         <div class="mt-2 col-10">
                              <div class="fs-6 fw-semibold">client_user_agent</div>
                              <div class="fs-12 text-muted">Type: string | Do not hash</div>
                              <input type="text" class="form-control main-control">
                         </div>
                         <div class="mt-2 col-10">
                              <div class="fs-6 fw-semibold">client_ip_address</div>
                              <div class="fs-12 text-muted">Type: string | Do not hasht</div>
                              <input type="text" class="form-control main-control">
                         </div>
                         <div class="adopted-con"></div>
                         <div class="mt-2">
                              <div class="dropdown">
                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-plus mx-2"></i>Add Customer Information Parameter
                                   </button>
                                   <ul class="dropdown-menu mic-drop-two" aria-labelledby="dropdownMenuButton1" style="max-height: 200px; overflow-y: auto;">
                                        <li class="event_bich"><a class="dropdown-item" href="#">Country</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">Date of Birth (db)</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">Email (em)</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">First Name (fn)</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">Last Name (fn)</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">Phone number (ph)</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">subscription_id</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">ZIP code (zp)</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">external_id</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">Click ID (fbc)</a></li>
                                        <li class="event_bich"><a class="dropdown-item" href="#">Browser ID (fbp)</a></li>

                                   </ul>
                              </div>
                         </div>

                    </div>
                    <div class="my-3  p-3 border rounded">
                         <div>
                              <div class="fs-5 fw-semibold">Custom Data Parameters</div>
                              <div class="fs-12">The custom data parameters lead_event_source and event_source are required for all Conversion Leads CRM events. Note that event_source for CRM events must be set to crm.</div>
                         </div>
                         <div class="mt-2 col-10">
                              <div class="fs-6 fw-semibold">Custom Parameter</div>
                              <div class="fs-12 text-muted">Type: String</div>
                              <div class="col-8 d-flex justify-content-center align-items-center py-2">
                                   <input type="text" class="form-control main-control" placeholder="name">
                                   <div class="mx-3">=</div>
                              </div>
                              <input type="text" class="form-control main-control" placeholder="value">
                         </div>
                         <div class="mt-2 col-10">
                              <div class="fs-6 fw-semibold">Custom Parameter</div>
                              <div class="fs-12 text-muted">Type: String</div>
                              <div class="col-8 d-flex justify-content-center align-items-center py-2">
                                   <input type="text" class="form-control main-control" placeholder="name">
                                   <div class="mx-3">=</div>
                              </div>
                              <input type="text" class="form-control main-control" placeholder="value">
                         </div>
                         <div class="for-append-div my-2"></div>
                         <div class="mt-2">
                              <div class="dropdown">
                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-plus mx-2"></i>Add Customer Information Parameter
                                   </button>
                                   <ul class="dropdown-menu mic-drop-three" aria-labelledby="dropdownMenuButton1" style="max-height: 200px; overflow-y: auto;">
                                        <li class="event_pref"><a class="dropdown-item" href="#">download ID</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">mobile advertiser id</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">description</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">level</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">max_rating_value</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">payment_info_available</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">registration_method</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">success</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">content_category</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">content_ids</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">content_type</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">contents</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">Custom Parameter</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">ccurrency</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">staus</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">search_string</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">value</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">predicted_ltv</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">order_id</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">num_items</a></li>
                                        <li class="event_pref"><a class="dropdown-item" href="#">delivery_category</a></li>
                                   </ul>
                              </div>
                         </div>

                    </div>




               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
               </div>
          </div>
     </div>
</div>


<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>


<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>

<script>
     $(document).ready(function() {
          $('body').on('click', '.user_id', function() {
    $(this).css("background", "#d8d7ff");
    $(this).siblings('.user_id').css("background", "");
});

          $('body').on('click', '.event_bich', function() {
               var listItem = $(this);
               var text = $(this).text();
               var newDiv = $('<div class="d-flex align-items-center nri_pri">' +
                    '<div class="rounded border p-2 d-flex justify-content-center align-items-center me-3" style="background:lightgray; height:30px; width:30px;"><i class="fa-solid fa-xmark closeoo_btn"></i></div>' +
                    '<div class="mt-2 col-9">' +
                    '<div class="fs-6 fw-semibold main-texto">' + text + '</div>' +
                    '<div class="fs-12 text-muted">Type: string</div>' +
                    '<input type="text" class="form-control main-control">' +
                    '</div>' +
                    '</div>');

               $('.adopted-con').append(newDiv);
               listItem.hide();
          });

          $('body').on('click', '.closeoo_btn', function() {
               var listItem = $(this).closest('.nri_pri').find('.main-texto').html();
               var text = $(this).closest('.nri_pri').find('.main-texto');
               var add = $('.mic-drop-two');
               var drop = $('<li class="event_bich"><a class="dropdown-item" href="#">' + listItem + '</a></li>');
               add.append(drop);
               text.closest('.nri_pri').remove();
          });

          $('body').on('click', '.event_id', function() {
               var listItem = $(this);
               var text = $(this).text();
               var newDiv = $('<div class="d-flex align-items-center nri_pri">' +
                    '<div class="rounded border p-2 d-flex justify-content-center align-items-center me-3" style="background:lightgray; height:30px; width:30px;"><i class="fa-solid fa-xmark close_btnoo"></i></div>' +
                    '<div class="mt-2 col-9">' +
                    '<div class="fs-6 fw-semibold main-texto">' + text + '</div>' +
                    '<div class="fs-12 text-muted">Type: string</div>' +
                    '<input type="text" class="form-control main-control">' +
                    '</div>' +
                    '</div>');

               $('.append-dv').append(newDiv);
               listItem.hide();
          });

          $('body').on('click', '.close_btnoo', function() {
               var listItem = $(this).closest('.nri_pri').find('.main-texto').html();
               var text = $(this).closest('.nri_pri').find('.main-texto');
               var add = $('.mic-drop-one');
               var drop = $('<li class="event_id"><a class="dropdown-item" href="#">' + listItem + '</a></li>');
               add.append(drop);
               text.closest('.nri_pri').remove();
          });

          $('body').on('click', '.event_pref', function() {
               var listItem = $(this);
               var text = $(this).text();
               var newDiv = $('<div class="d-flex align-items-center nri_pri">' +
                    '<div class="rounded border p-2 d-flex justify-content-center align-items-center me-3" style="background:lightgray; height:30px; width:30px;"><i class="fa-solid fa-xmark close_btn"></i></div>' +
                    '<div class="mt-2 col-9">' +
                    '<div class="fs-6 fw-semibold main-texto">' + text + '</div>' +
                    '<div class="fs-12 text-muted">Type: string</div>' +
                    '<input type="text" class="form-control main-control">' +
                    '</div>' +
                    '</div>');

               $('.for-append-div').append(newDiv);
               listItem.hide();
          });

          $('body').on('click', '.close_btn', function() {
               var listItem = $(this).closest('.nri_pri').find('.main-texto').html();
               //     alert(listItem);
               //     console.log(listItem);
               var text = $(this).closest('.nri_pri').find('.main-texto');
               var add = $('.mic-drop-three');
               var drop = $('<li class="event_pref"><a class="dropdown-item" href="#">' + listItem + '</a></li>');
               add.append(drop);
               text.closest('.nri_pri').remove();
          });




          // Data for the chart
          var options = {
               chart: {
                    type: 'line',
                    height: 350,
                    animations: {
                         enabled: false // Disable animations for sliding effect
                    }
               },

               series: [{
                    name: 'Sales',
                    data: [{
                              x: 'Feb 20',
                              y: 0
                         },
                         {
                              x: 'Feb 22',
                              y: 18
                         },
                         {
                              x: 'Feb 24',
                              y: 0
                         },
                         {
                              x: 'Feb 27',
                              y: 22
                         },
                         {
                              x: 'Feb 29',
                              y: 40
                         },
                         {
                              x: 'Mar 2',
                              y: 20
                         },
                         {
                              x: 'Mar 4',
                              y: 40
                         },
                         {
                              x: 'Mar 6',
                              y: 50
                         },
                         {
                              x: 'Mar 14',
                              y: 0
                         }
                    ]
               }],
               xaxis: {
                    type: 'category'
               },
               yaxis: {
                    title: {
                         text: ''
                    },
                    min: 0, // Set minimum value of y-axis
                    max: 60, // Set maximum value of y-axis
                    tickAmount: 6 // Number of ticks to display
               },

          };

          // Initialize the chart
          var chart = new ApexCharts(document.querySelector("#chart"), options);

          // Render the chart
          chart.render();
     });
</script>