<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>


<style>
    textarea:focus {
        outline: none;
    }

    .nav-item {
        cursor: pointer;
        padding: 10px;
        border-bottom: 2px solid transparent;
    }

    .nav-item.active {
        border-color: #724ebf;
    }

    .commnet_user {
        outline: 1px solid black;
        outline-offset: 5px;
        width: 50px;
        height: 50px;
    }
</style>
<style>
    body {
        background-color: #f3f3f3;
    }

    .fs-12 {
        font-size: 12px;
    }

    .form-control:focus {
        box-shadow: 0px 0px 0px black;
    }

    .account-nav {
        cursor: pointer;
        background-color: white;
        overflow: hidden;
    }

    .account_icon {
        background-color: #f3f3f3;
        height: 40px;
        width: 40px;
        overflow: hidden;
        background-position: center;
        align-self: center;
    }

    .chat_loader {
        display: block;
        --height-of-loader: 4px;
        --loader-color: #0071e2;
        width: 130px;
        height: var(--height-of-loader);
        border-radius: 30px;
        background-color: rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .chat_loader::before {
        content: "";
        position: absolute;
        background: var(--loader-color);
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        border-radius: 30px;
        animation: moving 1s ease-in-out infinite;
    }

    .account-box {
        background-color: white;
    }

    .active-account-box {
        background-color: #aaaaaa9c;
        border-right: 1px solid #b55dcd;
    }

    @keyframes moving {
        50% {
            width: 100%;
        }

        100% {
            width: 0;
            right: 0;
            /* left: unset; */
        }
    }

    .cursor-pinter {
        cursor: pointer;
    }

    .swiper-button-next:after {
        font-size: 25px !important;
        color: #858585;
        font-weight: 900;
    }

    .swiper-button-prev:after {
        font-size: 25px !important;
        color: #858585;
        font-weight: 900;
    }
    input{
        outline: none;
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
                    <div
                        class="col-12 border rounded-3 bg-white p-3 d-flex flex-wrap flex-column justify-content-between">
                        <!--  facebook page get start -->
                        <?php
                        $token = 'EAADNF4vVgk0BO1ccPa76TE5bpAS8jV8wTZAptaYZAq4ZAqwTDR4CxGPGJgHQWnhrEl0o55JLZANbGCvxRaK02cLn7TSeh8gAylebZB0uhtFv1CMURbZCZAs7giwk5WFZClCcH9BqJdKqLQZAl6QqtRAxujedHbB5X8A7s4owW5dj17Y41VGsQASUDOnZAOAnn2PZA2L';
                        $fb_page_list = fb_insta_page_list($token);
                        $fb_page_list = get_object_vars(json_decode($fb_page_list));
                        $i = 0;
                        foreach ($fb_page_list['page_list'] as $key => $value) {
                            $pageprofile = fb_page_img($value->id, $value->access_token);
                            $img_decode = json_decode($pageprofile, true);
                            ?>

                            <div class="col-12 d-flex flex-wrap  align-items-start cursor-pointer">
                                <?php if (isset($value->access_token) && isset($value->id) && isset($value->name) && isset($img_decode['page_img'])): ?>
                                    <div class="col-12 account-box d-flex flex-wrap align-items-center my-1 p-2 border rounded-3 d-flex app_card_post <?= $i == 0 ? 'first' : ''; ?>"
                                        data-acess_token="<?php echo $value->access_token; ?>"
                                        data-pagee_id="<?php echo $value->id; ?>" data-page_name="<?php echo $value->name; ?>"
                                        data-img="<?php echo $img_decode['page_img']; ?>">
                                        <img class="rounded-circle me-2" src="<?php echo $img_decode['page_img']; ?>" alt="#"
                                            style="width:30px;height:30px;object-fit-container" />
                                        <div class="col">
                                            <?php echo $value->name ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 d-flex flex-wrap align-items-start">
                                <?php if (isset($value->instagram_business_account) && isset($value->name) && isset($img_decode['page_img']) && isset($value->access_token)): ?>
                                    <div class="col-12 d-flex flex-wrap align-items-center my-1 p-2 border rounded-3 d-flex app_card_post"
                                        data-pagee_id="<?php if (isset($value->instagram_business_account)) {
                                            echo $value->id;
                                        } ?>"
                                        data-page_name="<?php echo $value->instagram_business_account->username; ?>"
                                        data-img="<?php echo $img_decode['page_img']; ?>"
                                        data-acess_token="<?php echo $value->access_token; ?>">
                                        <?php if (isset($value->instagram_business_account->username)): ?>
                                            <?php echo $value->instagram_business_account->username; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>


                            <?php $i++;
                        } ?>
                        <!-- facebook page get end  -->



                        <!-- <div class="col-12 my-2 text-center">
                            <div class="d-flex flex-wrap justify-content-center">
                                <img src="https://cdn.publer.io/on-board-social-accounts.png" alt="#">
                                <p class="px-3 text-center col-8 fs-5 my-3">Start by adding your social accounts</p>
                                <div class="col-12 my-2">
                                    <a href="<?= base_url(); ?>add_account"
                                        class="btn bg-transperent rounded-2 border"><i
                                            class="bi bi-plus-lg me-1"></i>Add Account</a>
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
                            <div class="col-12">
                                <nav class="nav">
                                    <form class="needs-validation" id="create_form" name="create_form" method="POST"
                                        novalidate>
                                        <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                                            <li class="nav-item active" role="presentation">
                                                <a class="nav-link bg-white text-primary create-input-toggle"
                                                    id="pills-master-diet" data-bs-toggle="pill"
                                                    data-bs-target="#pills-master-diet-tab" href="#">Update</a>
                                            </li>
                                            <li class="nav-item " role="presentation">
                                                <a class="nav-link bg-white text-primary create-input-toggle"
                                                    id="pills-all-diet" data-bs-toggle="pill"
                                                    data-bs-target="#pills-master-diet-tab" href="#">Photo</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link bg-white text-primary" id="pills-all-event"
                                                    data-bs-toggle="pill" data-bs-target="#pills-master-diet-tab"
                                                    href="#">Event</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link bg-white text-primary" id="pills-all-offer"
                                                    data-bs-toggle="pill" data-bs-target="#pills-master-diet-tab"
                                                    href="#">Offer</a>
                                            </li>
                                        </ul>

                                        </form>
                                </nav>
                                <div class="col-12">
                                    <div class="tab-content active show" id="pills-tabContent">
                                        <div class="tab-pane fade active show" id="pills-master-diet-tab" role="tabpanel"
                                            aria-labelledby="update-all-tab-modal" tabindex="0">
                                            <div class="col-12  tab-compo">
                                                <div class="card-body p-2">
                                                    <div id="event-input">
                                                        <div class="col-12 my-1 p-1">
                                                            <div class="col-12">
                                                                <input type="text" class="form-control p-2"
                                                                    id="event_title" placeholder="Title">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="col-6 my-1 p-1">
                                                                <div class="col-12">
                                                                    <input type="text"
                                                                        class="form-control p-2 offer_start_date"
                                                                        id="event_start_date" placeholder="Start Date">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 my-1 p-1">
                                                                <div class="col-12">
                                                                    <input type="text"
                                                                        class="form-control p-2 event_end_date"
                                                                        id="event_end" placeholder="End Date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 border rounded  p-3">
                                                        <textarea cols="30" rows="5"
                                                            class="col-12 border-0 event_address"
                                                            placeholder="Write something or use shortcodes, spintax..... "
                                                            id="event_address"></textarea>

                                                        <span
                                                            class="border-0 col-12 mt-4 d-inline-block rounded-3 text-center px-4 py-2 fw-semibold text-muted mb-4 "
                                                            data-bs-toggle="modal" data-bs-target="#get_file"
                                                            type="file" style="background:#bdbaba;;">Click or Drag &
                                                            Drop Media</span>
                                                        <div class="row col-12" id="offer-input">
                                                            <div class="col-md-4 my-1 ">
                                                                <input type="text" placeholder="Coupon code (optional)"
                                                                    class="form-control" id="coupon_event" value="">
                                                            </div>
                                                            <div
                                                                class="col-md-8 my-1 u-padding-left-md-0-isImportant u-margin-top-0-mobile-10 u-margin-top-sm-10">
                                                                <input type="text"
                                                                    placeholder="Link to redeem offer (optional)"
                                                                    class="form-control" value="" id="link_event">
                                                            </div>
                                                            <div class="col-md-12 my-1 u-margin-bottom-10 undefined">
                                                                <textarea rows="1"
                                                                    placeholder="Terms and conditions (optional)"
                                                                    class="form-control" id="terms_event"></textarea>
                                                            </div>
                                                        </div>
                                                        <div id="select-box">
                                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                                <div class="main-selectpicker">
                                                                    <select id="approx_buy" name="approx_buy"
                                                                        class="selectpicker form-control form-main"
                                                                        data-live-search="true" required>
                                                                        <i class="fa-solid fa-caret-down"></i>
                                                                        <option class="dropdown-item" value="">
                                                                            Unspecified</option>
                                                                        <option class="dropdown-item" value="2-3 days">
                                                                            Cover</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Profile</option>
                                                                        <option class="dropdown-item" value="week">Buy
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">Logo
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Exteriro</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Interior</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Product</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            At-Work</option>
                                                                        <option class="dropdown-item" value="week">Food
                                                                            ANd Drink</option>
                                                                        <option class="dropdown-item" value="week">Menu
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Comman Area</option>
                                                                        <option class="dropdown-item" value="week">Rooms
                                                                        </option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Workspaces</option>
                                                                        <option class="dropdown-item" value="week">
                                                                            Additional</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="card-footer border-top p-2 px-4 d-flex  align-content-center flex-wrap">
                                            <div class="col-4">
                                                <button class="bg-transparent border-0 text-muted">
                                                    <i class="fa-regular fa-clone me-2 "></i>Bulk Option</button>
                                            </div>
                                            <div class="col-8 d-flex  flex-wrap justify-content-end ">
                                                
                                                <button class="btn btn-outline-secondary mx-1 draft_create"
                                                    id="draft_create">Draft</button>
                                                <button class="btn btn-primary mx-1 create_comment">Publish</button>
                                                <button
                                                    class="btn btn-secondery mx-1 Scedual_start_date">Scedual</button>
                                                <div class="btn-group dropup btn-outline-dark mx-1">
                                                    <button type="button" class="btn btn-outline-dark rounded-3"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-angle-up"></i></button>
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
</div> -->

                    </div>
                </div>
                <div class="col-9 px-3  mt-2">
                    <div class="col-12 bg-white p-3 d-flex justify-content-end mb-2 rounded-4 border">
                        <button class=" btn btn-primary-rounded " data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop"><i class="bi bi-plus"></i></button>
                    </div>
                    <div class="col-12 overflow-y-scroll  d-flex flex-wrap justify-content-center rounded-3"
                        style="max-height:700px;">
                        <div class="demo_list_data  d-flex flex-wrap col-12" id="demo_list_data"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="get_file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
            role="dialog" data-bs-backdrop="static">
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
                                    <input class="form-control main-control coupon_event attachment" id="attachment"
                                        name="attachment[]" multiple="" type="file" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button class="btn btn-primary" data-bs-target="" data-bs-toggle="modal" data-bs-dismiss="modal"></button> -->
                        <button class="btn btn-primary" data-bs-target="#staticBackdrop" data-bs-toggle="modal">Back to
                            first</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="m-auto massage_list_loader text-center position-fixed top-50 start-50">
            <span>Loading...</span>
            <div class="mx-auto chat_loader"></div>
        </div>
        <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <nav class="nav">
                            <form class="needs-validation" id="create_form" name="create_form" method="POST" novalidate>
                                <ul class="nav nav-pills navtab_primary_sm" id="pills-tab" role="tablist">
                                    <li class="nav-item active" role="presentation">
                                        <a class="nav-link bg-white text-primary create-input-toggle"
                                            id="pills-master-diet" data-bs-toggle="pill"
                                            data-bs-target="#pills-master-diet-tab" href="#">Update</a>
                                    </li>
                                    <li class="nav-item " role="presentation">
                                        <a class="nav-link bg-white text-primary create-input-toggle"
                                            id="pills-all-diet" data-bs-toggle="pill"
                                            data-bs-target="#pills-master-diet-tab" href="#">Photo</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link bg-white text-primary" id="pills-all-event"
                                            data-bs-toggle="pill" data-bs-target="#pills-master-diet-tab"
                                            href="#">Event</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link bg-white text-primary" id="pills-all-offer"
                                            data-bs-toggle="pill" data-bs-target="#pills-master-diet-tab"
                                            href="#">Offer</a>
                                    </li>
                                </ul>

                            </form>
                        </nav>
                        <div class="col-12">
                            <div class="tab-content active show" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="pills-master-diet-tab" role="tabpanel"
                                    aria-labelledby="update-all-tab-modal" tabindex="0">
                                    <div class="col-12  tab-compo">
                                        <div class="card-body p-2">
                                            <div id="event-input">
                                                <div class="col-12 my-1 p-1">
                                                    <div class="col-12">
                                                        <input type="text" class="form-control p-2" id="event_title"
                                                            placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="d-flex">
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
                                                </div>
                                            </div>
                                            <div class="col-12 border rounded  p-3">
                                                <textarea cols="30" rows="5" class="col-12 border-0 event_address"
                                                    placeholder="Write something or use shortcodes, spintax..... "
                                                    id="event_address"></textarea>
                                                <div class="img-input col-12 d-flex flex-wrap">
                                                    <div class="img-placeholder d-flex flex-wrap"></div>
                                                </div>
                                                <span
                                                    class="border-0 col-12 mt-4 d-inline-block rounded-3 text-center px-4 py-2 fw-semibold text-muted mb-4 drag-and-drop-btn"
                                                    data-bs-toggle="modal" data-bs-target="#get_file" type="file"
                                                    style="background:#bdbaba;">Click or Drag &
                                                    Drop Media</span>
                                                <div class="row col-12" id="offer-input">
                                                    <div class="col-md-4 my-1 ">
                                                        <input type="text" placeholder="Coupon code (optional)"
                                                            class="form-control" id="coupon_event" value="">
                                                    </div>
                                                    <div
                                                        class="col-md-8 my-1 u-padding-left-md-0-isImportant u-margin-top-0-mobile-10 u-margin-top-sm-10">
                                                        <input type="text" placeholder="Link to redeem offer (optional)"
                                                            class="form-control" value="" id="link_event">
                                                    </div>
                                                    <div class="col-md-12 my-1 u-margin-bottom-10 undefined">
                                                        <textarea rows="1" placeholder="Terms and conditions (optional)"
                                                            class="form-control" id="terms_event"></textarea>
                                                    </div>
                                                </div>
                                                <div id="select-box">
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <div class="main-selectpicker">
                                                            <select id="approx_buy" name="approx_buy"
                                                                class="selectpicker form-control form-main"
                                                                data-live-search="true" required>
                                                                <i class="fa-solid fa-caret-down"></i>
                                                                <option class="dropdown-item" value="">
                                                                    Unspecified</option>
                                                                <option class="dropdown-item" value="2-3 days">
                                                                    Cover</option>
                                                                <option class="dropdown-item" value="week">
                                                                    Profile</option>
                                                                <option class="dropdown-item" value="week">Buy
                                                                </option>
                                                                <option class="dropdown-item" value="week">Logo
                                                                </option>
                                                                <option class="dropdown-item" value="week">
                                                                    Exteriro</option>
                                                                <option class="dropdown-item" value="week">
                                                                    Interior</option>
                                                                <option class="dropdown-item" value="week">
                                                                    Product</option>
                                                                <option class="dropdown-item" value="week">
                                                                    At-Work</option>
                                                                <option class="dropdown-item" value="week">Food
                                                                    ANd Drink</option>
                                                                <option class="dropdown-item" value="week">Menu
                                                                </option>
                                                                <option class="dropdown-item" value="week">
                                                                    Comman Area</option>
                                                                <option class="dropdown-item" value="week">Rooms
                                                                </option>
                                                                <option class="dropdown-item" value="week">
                                                                    Workspaces</option>
                                                                <option class="dropdown-item" value="week">
                                                                    Additional</option>
                                                            </select>
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
                    <div class="modal-footer">
                        <div class="card-footer col-12 p-2 px-4 d-flex  align-content-center flex-wrap">
                            <div class="col-4">
                                <button class="bg-transparent border-0 text-muted">
                                    <i class="fa-regular fa-clone me-2 "></i>Bulk Option</button>
                            </div>
                            <div class="col-8 d-flex  flex-wrap justify-content-end ">
                                <button class="btn btn-outline-secondary mx-1 draft_create"
                                    id="draft_create">Draft</button>
                                <button class="btn btn-primary mx-1 create_comment">Publish</button>
                                <button class="btn btn-secondery mx-1 Scedual_start_date">Scedual</button>
                                <div class="btn-group dropup btn-outline-dark mx-1">
                                    <button type="button" class="btn btn-outline-dark rounded-3"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-angle-up"></i></button>
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


        <!-- post comment modal -->
        <div class="modal fade show d-block" id="comment-modal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header p-2 py-3">
                        <div class="col-11 d-flex flex-wrap ">
                            <div class="me-2" data-bs-toggle="modal" data-bs-target="#comment-modal">
                                <img class="rounded-circle"
                                    src="https://scontent.famd15-2.fna.fbcdn.net/v/t39.30808-1/420455313_122097378152192565_8221030983682159636_n.jpg?stp=c0.0.50.50a_cp0_dst-jpg_p50x50&amp;_nc_cat=105&amp;ccb=1-7&amp;_nc_sid=4da83f&amp;_nc_ohc=0TEiKYItlngAX_Ns_i1&amp;_nc_oc=AQk3YbtUJ7KyXL-g6j6xMjQuMCdaeyYB3aG9sW1OhvdtEgz__SFpYb9nEtrPSIeyfoHYbS9eMFyqg3JEXIi77ErR&amp;_nc_ht=scontent.famd15-2.fna&amp;edm=AOf6bZoEAAAA&amp;oh=00_AfCYEfsnxuyriahsInOArWDb4GVQEZTrhSXz_i5jFLkLXg&amp;oe=65D24B45"
                                    alt="#" style="width:40px;height:40px;">
                            </div>
                            <div class="col">
                                <div class="col-12 d-flex flex-wrap justify-content-between">
                                    <h5 class="col-10" data-bs-toggle="modal" data-bs-target="#comment-modal">
                                        Realtosmart
                                    </h5>
                                </div>

                                <div class="col-12" data-bs-toggle="modal" data-bs-target="#comment-modal">
                                    <span class="text-muted">
                                        <span class="fs-14">5 days ago</span>
                                    </span>
                                    <span>
                                        <i class="fa-solid fa-earth-asia fs-14 fw-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-2" style="max-height:700px;overflow-y:scroll;             ">
                        <div class="card-header mb-2 col-12" id="post_card">
                            <div class="col-12 ">
                                <div class="swiper mySwiper position-relative">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div
                                                class="d-flex justify-content-center bg-white align-items-center overflow-hidden col-12 ">
                                                <img src="https://scontent.famd15-1.fna.fbcdn.net/v/t39.30808-6/426594382_122116834508192565_6829799641563540288_n.jpg?stp=dst-jpg_p720x720&amp;_nc_cat=111&amp;ccb=1-7&amp;_nc_sid=3635dc&amp;_nc_ohc=-OTJFrPF0PUAX-dt5ot&amp;_nc_ht=scontent.famd15-1.fna&amp;edm=AKK4YLsEAAAA&amp;oh=00_AfAwGoz7nCWr8q4xNPZRtiQZQBvMVpJI1hL-XoynWfA1QQ&amp;oe=65D195E8"
                                                    alt="#" class="object-fit-content w-100">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div
                                                class="d-flex justify-content-center bg-white align-items-center overflow-hidden col-12 ">
                                                <img src="https://scontent.famd15-1.fna.fbcdn.net/v/t39.30808-6/426594382_122116834508192565_6829799641563540288_n.jpg?stp=dst-jpg_p720x720&amp;_nc_cat=111&amp;ccb=1-7&amp;_nc_sid=3635dc&amp;_nc_ohc=-OTJFrPF0PUAX-dt5ot&amp;_nc_ht=scontent.famd15-1.fna&amp;edm=AKK4YLsEAAAA&amp;oh=00_AfAwGoz7nCWr8q4xNPZRtiQZQBvMVpJI1hL-XoynWfA1QQ&amp;oe=65D195E8"
                                                    alt="#" class="object-fit-content w-100">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div
                                                class="d-flex justify-content-center bg-white align-items-center overflow-hidden col-12 ">
                                                <img src="https://scontent.famd15-1.fna.fbcdn.net/v/t39.30808-6/426594382_122116834508192565_6829799641563540288_n.jpg?stp=dst-jpg_p720x720&amp;_nc_cat=111&amp;ccb=1-7&amp;_nc_sid=3635dc&amp;_nc_ohc=-OTJFrPF0PUAX-dt5ot&amp;_nc_ht=scontent.famd15-1.fna&amp;edm=AKK4YLsEAAAA&amp;oh=00_AfAwGoz7nCWr8q4xNPZRtiQZQBvMVpJI1hL-XoynWfA1QQ&amp;oe=65D195E8"
                                                    alt="#" class="object-fit-content w-100">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div
                                                class="d-flex justify-content-center bg-white align-items-center overflow-hidden col-12 ">
                                                <img src="https://scontent.famd15-1.fna.fbcdn.net/v/t39.30808-6/426594382_122116834508192565_6829799641563540288_n.jpg?stp=dst-jpg_p720x720&amp;_nc_cat=111&amp;ccb=1-7&amp;_nc_sid=3635dc&amp;_nc_ohc=-OTJFrPF0PUAX-dt5ot&amp;_nc_ht=scontent.famd15-1.fna&amp;edm=AKK4YLsEAAAA&amp;oh=00_AfAwGoz7nCWr8q4xNPZRtiQZQBvMVpJI1hL-XoynWfA1QQ&amp;oe=65D195E8"
                                                    alt="#" class="object-fit-content w-100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <!-- <div class="swiper-pagination position-absolute end-0 bg-white"></div> -->
                                </div>
                            </div>
                            <div>
                                <div class="col-12 p-1 mt-2 d-flex post-btn-box flex-wrap align-items-center">
                                    <span class="cursor-pointer">
                                        <button class="btn p-0 w-100 like_button border-0">22<i
                                                class="fa-regular fa-thumbs-up mx-2 " id="like_icon"></i><i
                                                class="fa-solid fa-thumbs-up d-none mx-2"
                                                id="like_icon_lite"></i></button>
                                    </span>
                                    <span class="cursor-pointer">
                                        <div class="btn w-100 text-muted d-flex p-0 border-0" data-bs-toggle="modal"
                                            data-bs-target="#comment-modal" id="post_commnet_modal"><i
                                                class="fa-regular fa-comment mx-2 my-auto "></i>
                                        </div>
                                    </span>
                                </div>
                                <p class="text-muted fs-12 overflow-hidden text-wrap">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, dolor Lorem ipsum
                                    dolor sit, amet consectetur adipisicing elit. Nobis magni ea inventore
                                    exercitationem est numquam dolores ducimus ab quidem quibusdam similique fuga, in
                                    voluptatem aliquam asperiores...</p>
                                <div id="comments_list" class="col-12"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-body overflow-y-scroll" id="comments_list"  style="max-height:400px;">

                    </div> -->
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div> -->
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>





        <!-- Modal -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
        <script>

            $('body').on('click', '.account-box', function () {

                $(this).addClass('active-account-box');
                $(this).parent().siblings().children('.app_card_post').removeClass('active-account-box');

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
            $("body").on("click", ".Replay_btn", function () {
                $(this).closest('.replay-parent').find('.comment_box ').removeClass('d-none');
            })

            // $("body").on("keyup", ".comment_input", function() {
            //     $('.comment-send-btn').attr("disabled", false);
            // })

            // $("body").on("focusout", ".comment_input", function() {
            //     var comment_input = $('.comment_input').val();

            //     if (comment_input == "") {
            //         $('.comment-send-btn').attr("disabled", true);
            //     }
            // })

            $('body').on('click', '.comment_btn_close', function () {
                $(this).closest('.comment_box').addClass('d-none');
            });


            $('.nav-item').click(function () {
                $('.nav-item').removeClass('active');
                $(this).addClass('active');
            });
            // 196821650189891_122116834772192565

            // https://graph.facebook.com/v12.0/196821650189891_122116834772192565/comments?access_token=EAADNF4vVgk0BO8Hsijloc6ZB9b2iN7jZCIHD9EijVZCqRZCVM14DoHdnNyAvXZArVQzNMTEDJ8Btn443esuXvihekEZBQhJ02dbZChuHPhc4lQ6YBtu8CZAXh1DBnyZACFtD6Qvlai20igEycsl1dPXcvEDbzxqjUPUiS7ZC0VtmZAZCKWS03qVG5eZCOGyjWZBZBmh2YnxFvZA201kZD";

            $api_endpoint = "https://graph.facebook.com/v12.0/$page_id/feed?fields=comments{from,message}&access_token=$access_token";
            $('body').on('click', '.comment_send', function () {
                var data_post_id = $(this).attr('data-post_id');
                var input_comment = $("#comment-modal #input_comment").val();
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('comment_replay_send') ?>',
                    data: {
                        data_post_id: data_post_id,
                        'input_comment': input_comment,
                    },
                    success: function (res) {
                        var result = JSON.parse(res);
                        $('.loader').hide();
                        if (result.response == "1") {
                            $("#comment-modal .comment_btn_close").trigger("click");
                            iziToast.success({
                                title: 'Comment Successfully'
                            });
                        }

                    }
                });
            });
            $('body').on('click', '.delete_post_facebook', function () {
                var data_delete_id = $(this).attr('data-delete_id');

                $.ajax({
                    type: 'post',
                    url: '<?= base_url('delete_post') ?>',
                    data: {
                        data_delete_id: data_delete_id,
                    },
                    beforeSend: function () {
                        $('.delete_loader').show();
                        $('.noRecourdFound').hide();
                    },
                    success: function (res) {
                        $('.delete_loader').hide();
                        iziToast.delete({
                            title: 'Post Delete Successfully'
                        });
                    }
                });
            });
            $('.delete_loader').hide();

            $('body').on('click', '.app_card_post', function () {
                var access_tocken = $(this).attr('data-acess_token');
                var pagee_id = $(this).attr('data-pagee_id');
                var page_name = $(this).attr('data-page_name');
                var data_img = $(this).attr('data-img');

                $.ajax({
                    type: 'post',
                    url: '<?= base_url('list_post_pagewise') ?>',
                    data: {
                        access_tocken: access_tocken,
                        pagee_id: pagee_id,
                        page_name: page_name,
                        data_img: data_img,
                    },
                    beforeSend: function () {
                        $('.massage_list_loader').show();
                        $('.noRecourdFound').hide();
                    },
                    success: function (res) {
                        var result = JSON.parse(res);
                        $('.loader').hide();
                        $('.massage_list_loader').hide();
                        $('#demo_list_data').html(result.html);
                        $('#comments_list').html(result.comments_html);

                    }
                });
            });
            $('.massage_list_loader').hide();

            setTimeout(function () {
                $('.first').trigger('click');
            }, 300);

            $(".draft_create").click(function (e) {
                //  alert("dfe");
                e.preventDefault();
                var form = $("form[name='create_form']")[0];
                var event_title = $('#event_title').val();
                var event_start_date = $('#event_start_date').val();
                var event_end = $('#event_end').val();
                var event_address = $('.event_address').val();
                var attachment = $('.attachment').prop('files')[0];
                var coupon_event = $('#coupon_event').val();
                var link_event = $('#link_event').val();
                var terms_event = $('#terms_event').val();

                // var email = $('#email').val();

                var formdata = new FormData(form);
                // var edit_id = $('#reminder_btn_add').attr("data-edit_id");
                // console.log(event_address);
                // die();
                if (event_title != "" || event_address != "") {
                    var form = $('form[name="create_form"]')[0];
                    // console.log(form);
                    var formdata = new FormData(form);
                    formdata.append('event_title', event_title);
                    formdata.append('event_start_date', event_start_date);
                    formdata.append('event_end', event_end);
                    formdata.append('event_address', event_address);
                    formdata.append('attachment', attachment);
                    formdata.append('coupon_event', coupon_event);
                    formdata.append('link_event', link_event);
                    formdata.append('terms_event', terms_event);
                    formdata.append('table', 'create_post');
                    formdata.append('action', 'create_insert_data');
                    // console.log(event_address);
                    // die();
                    // if (edit_id == '') {
                    // console.log(edit_id);
                    // die();
                    $.ajax({
                        method: "post",
                        url: "<?= site_url('create_insert_data'); ?>",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res != "error") {
                                list_data();
                                $("form[name='create_form']")[0].reset();
                                $(".modal-close-btn").trigger("click");
                                $("form[name='create_form']").removeClass("was-validated");
                                iziToast.success({
                                    title: 'Draft Successfully'
                                });
                                $('.selectpicker').selectpicker('refresh');
                            } else {
                                //alert("this");
                                $("form[name='create_form']")[0].reset();
                                iziToast.error1({
                                    title: 'Duplicate data'
                                });
                                $("form[name='create_form']").addClass("was-validated");
                            }
                            // list_data();
                        },
                    });
                }
                //     } else {
                //         var formdata = new FormData(form);
                //         // console.log(formdata);
                //         formdata.append('action', 'update');
                //         formdata.append('table', 'reminders_details');
                //         formdata.append('date', date);
                //         formdata.append('time', time);
                //         formdata.append('week', week);
                //         formdata.append('user', user);
                //         formdata.append('message', message);
                //         formdata.append('email', email);
                //         formdata.append('whatsapp', whatsapp);
                //         formdata.append('type', type);
                //         formdata.append('edit_id', edit_id);

                //         // console.log(edit_id);
                //         // die();
                //         $('.loader').hide();
                //         $.ajax({
                //             method: "post",
                //             url: "<?= site_url('dataupdate_data'); ?>",
                //             data: formdata,
                //             processData: false,
                //             contentType: false,
                //             success: function (res) {
                //                 if (res != "error") {
                //                     $("form[name='create_form']")[0].reset();
                //                     $("form[name='create_form']").removeClass("was-validated");
                //                     $(".btn-cancel").trigger("click");
                //                     iziToast.success({
                //                         title: 'update Successfully'
                //                     });

                //                     list_data();
                //                     $('.selectpicker').selectpicker('refresh');
                //                 }
                //                 else {
                //                     // alert("hello");
                //                     $("form[name='create_form']")[0].reset();
                //                     iziToast.error1({
                //                         title: 'Duplicate data'
                //                     });
                //                 }
                //             },
                //         });
                //     }
                // } else {
                //     $("form[name='create_form']").addClass("was-validated");
                // }


            });

            $('body').on('click', '.create_comment', function () {
                var form = $("form[name='create_form']")[0];
                var attachment = $('.attachment').prop('files')[0];
                var event_address = $('.event_address').val();
                var formData = new FormData(form);

                // Append additional data to the formData object
                formData.append('action', 'post');
                formData.append('attachment', attachment);
                formData.append('event_address', event_address);

                $.ajax({
                    method: "post",
                    url: "<?= site_url('SendPostDataFB'); ?>",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        // Handle success
                        console.log(res);
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });

            /*  ---------------------------- modal input ----------------------------
 
             $("#pills-master-diet").click(function() {
                 $(".card-body").show();
                 $("#select-box").hide();
                 $("#event-input").hide();
                 $("#offer-input").hide();
 
             });
             $("#pills-master-diet").trigger("click");
 
             //photo
             $("#pills-all-diet").click(function() {
                 $("#select-box").show();
                 $("#event-input").hide();
                 $("#offer-input").hide();
 
             });
 
             //event
             $("#pills-all-event").click(function() {
                 $("#event-input").show();
                 $("#offer-input").hide();
                 $("#select-box").show();
             });
             //offer
             $("#pills-all-offer").click(function() {
                 $("#offer-input").show();
                 $("#select-box").hide();
             });
  */

            $("#event-option").change(function () {
                var selectedValue = $(this).val();
                if (selectedValue === "event") {
                    $("#event-input").removeClass("d-none");
                } else {
                    $("#event-input").addClass("d-none");
                }
                if (selectedValue === "offer") {
                    $("#event-input").removeClass("d-none");
                }
            });

            $(document).on("click", ".like_button", function () {
                var button = $(this);
                button.find("#like_icon").toggleClass("d-none");
                button.find("#like_icon_lite").toggleClass("d-none");
            });
            //---------------------------- modal input ----------------------------

            $("#pills-master-diet").click(function () {
                $(".card-body").show();
                $("#select-box").hide();
                $("#event-input").hide();
                $("#offer-input").hide();

            });
            $("#pills-master-diet").trigger("click");

            //photo
            $("#pills-all-diet").click(function () {
                $("#select-box").show();
                $("#event-input").hide();
                $("#offer-input").hide();

            });

            //event
            $("#pills-all-event").click(function () {
                $("#event-input").show();
                $("#offer-input").hide();
                $("#select-box").show();
            });
            //offer
            $("#pills-all-offer").click(function () {
                $("#offer-input").show();
                $("#select-box").hide();
            });
            $('body').on('change', '#attachment', function () {
                $('.drag-and-drop-btn').remove();
                var b = '<div class="mx-2 rounded-3 border overflow-hidden" style="width:150px;height:150px"><img src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" class="w-100 h-100"></div>'
                var a = $('.add-img-input').length;
                // alert(a);
                if (a == 0) {
                    var a = '<div class="mx-3 rounded-3 overflow-hidden position-relative d-flex justify-content-center  align-items-center " style="width:150px;height:150px;border:1px dashed gray"><div class="w-100 h-100 position-absolute add-img-input" data-bs-toggle="modal" data-bs-target="#get_file"></div><p class="fs-1">+</p></div>'
                    $('.img-input').append(a);
                    $('.img-placeholder').append(b);
                }
                else {
                    $('.img-placeholder').append(b);
                }
            })
            // $('body').on('click','.img-placeholder',function() {
            //     var c = '<div class="rounded-3 border overflow-hidden" style="width:150px;height:150px"><img src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" class="w-100 h-100"></div>'
            //     $('.img-placeholder').append(c);
            // })

        </script>
        <?= $this->include('partials/footer') ?>
        <?= $this->include('partials/vendor-scripts') ?>
        <script>
            var swiper = new Swiper(".mySwiper", {
                pagination: {
                    el: ".swiper-pagination",
                    type: "fraction",
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>