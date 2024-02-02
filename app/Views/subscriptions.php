<!------------------------- Header Start ------------------------------->
<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<!------------------------- Header Start ------------------------------->


<style>
   .inner-box.active {
      transform: scale(1.05);
   }

   .heading h5 {
      color: #fff;
   }

   .m-heading {
      background: #f8f0ff;
   }

   .pricing-block .inner-box {
      /* border: 1px solid #7367f0; */
      border-radius: 40px;
   }

   .heading_m1 h5 {
      color: black;
   }

   .inner-box1,
   .inner-box3 {
      background-color: #b55dcd;
   }

   .inner-box2 {
      background-color: #724ebf;
   }

   .pricing-block .features li {

      margin: 0px 25px 0px 25px;
      font-size: 15px;
      color: #fff;
      padding: 5px 0;
      list-style: none;
      border-bottom: 1px dashed #dddddd;
   }

   .inner-box ul li::before {
      content: "+";
      color: var(--white);
      left: 9px;
      font-weight: 600;
      position: absolute;
   }

   .features {
      position: relative;
   }

   .pricing-block .price-box {
      position: relative;

      padding: 2px 2px;

   }

   .text_color {
      color: #7367f0;
   }

   .inner-box:hover {
      box-shadow: 0 20px 40px #c4b7f18a;
   }

   .py-100 {
      padding-top: 100px;
      padding-bottom: 100px;
   }

   .pricing-block.col-lg-4.col-md-6.col-sm-12.frizz_class {
      opacity: 0.5;
      pointer-events: none;
   }
</style>
<section class="pricing-section py-5">
   <div class="container">
      <div class="outer-box">
         <div class="row nav nav-pills justify-content-center" role="tablist">

            <div class="pricing-block  col-lg-3 col-md-6 col-sm-12 frizz_class">
               <div class="inner-box inner-box1 " data-bs-toggle="pill" data-bs-target="#pills-home" role="tab"
                  aria-controls="pills-home" aria-selected="false" tabindex="-1">

                  <div class="heading1 heading mx-auto border-bottom p-3 ">
                     <h5 class="heading_h5 text-center fw-bold">Core</h5>


                  </div>

                  <div class="icon-box p-4">
                     <div class="icon-outer mx-auto ">

                        <p class="price-1 text-center fw-semibold fs-2 mb-4">
                           <span class=" text-white">₹ 2,083/</span>
                           <sub class="text-white-50">Month</sub>
                        </p>
                     </div>
                  </div>

                  <ul class="features ">
                     <li>
                        <span class="fw-bold">
                           Price
                           ₹ 2,083 /-
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Call list
                        </span>
                     </li>

                     <li>
                        <span class="fw-bold">
                           User 10
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           3 Type of followups
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           4 Stages of inquiry
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           User Roll Management
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Inquiry Master
                        </span>
                     </li>
                     <li class="d-flex">
                        <span class="fw-bold">
                           Standerd Analytics and Report
                        </span>
                     </li>
                     <li class="d-flex ">

                        <span class="fw-bold ">
                           Site Visit, Booking, Appointment Registers
                        </span>
                     </li>

                  </ul>

                  <div class="d-flex justify-content-between p-4">

                     <div>
                        <button type="button" class="btn- submit bg-white btn submit_setting rounded-2" name="" id=""
                           data-bs-toggle="modal" data-value="25000" data-bs-target="#subscribe">Subscribe</button>
                     </div>

                     <div class="pr-2">
                        <button class="btn btn- maxii bg-white  _add" id="_add" name="_add" value="add"
                           data-bs-toggle="modal" data-bs-target="#core">view
                           Details</button>
                     </div>

                  </div>
               </div>
            </div>

            <div class="pricing-block col-lg-3 col-md-6 col-sm-12  frizz_class">
               <div class="inner-box middle inner-box2 " data-bs-toggle="pill" data-bs-target="#pills-home" role="tab"
                  aria-controls="pills-home" aria-selected="false" tabindex="-1">

                  <div class="heading_m1 mx-auto border-bottom ">
                     <h5 class=" text-light fw-bold text-center p-3  "> Advance </h5>
                  </div>

                  <div class="icon-box p-4">
                     <div class="icon-outer mx-auto m-outer">
                        <p class="price-2 text-center fw-semibold fs-2 mb-4">
                           <span class="text-white">₹ 4,166/</span>
                           <sub class="text-white-50">Month</sub>
                        </p>
                     </div>
                  </div>


                  <ul class="features ">
                     <li>
                        <span class="fw-bold">
                           Price
                           ₹ 4,166 /-
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">

                           Call list
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           User
                           25
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Project Master
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Address Master
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Unlimited Project Listing
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Unlimited Property Listing
                        </span>
                     </li>
                     <li class="d-flex">
                        <span class="fw-bold">
                           Advanced Analytics and Report
                        </span>
                     </li>
                     <li class="d-flex ">

                        <span class="fw-bold">
                           Site Visit, Booking, Appointment Registers
                        </span>
                     </li>

                  </ul>

                  <div class="d-flex justify-content-between p-4">

                     <div>

                        <button type="button" class="btn- submit  bg-white submit_setting rounded-2 btn" name="" id=""
                           data-bs-toggle="modal" data-value="50000" data-bs-target="#Advence">Upgrade Plan </button>
                     </div>

                     <div class="pr-2">
                        <button class="btn btn -maxii bg-white  _add" id="_add" name="_add" value="add"
                           data-bs-toggle="modal" data-bs-target="#advence">view Details</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="pricing-block col-lg-3 col-md-6 col-sm-12 ">
               <div class="inner-box inner-box3  " data-bs-toggle="pill" data-bs-target="#pills-home" role="tab"
                  aria-controls="pills-home" aria-selected="true" tabindex="-1">

                  <div class="heading3 heading mx-auto  border-bottom  heading_m ">
                     <h5 class="fw-bold text-center p-3 
                                    ?> "> Enterprise (Current plan)</h5>
                  </div>

                  <div class="icon-box p-4">
                     <div class="icon-outer mx-auto ">
                        <p class="price-2 text-center  fw-semibold fs-2 mb-4">
                           <span class=" text-white">₹ 8,333/</span>
                           <sub class="text-white-50">Month</sub>
                        </p>
                     </div>
                  </div>

                  <ul class="features ">
                     <li>
                        <span class="fw-bold">
                           Price
                           ₹ 8,333 /-
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Call list
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           User
                           40
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Project Master
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Address Master
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Unlimited Project Listing
                        </span>
                     </li>
                     <li>
                        <span class="fw-bold">
                           Unlimited Property Listing
                        </span>
                     </li>
                     <li class="d-flex">
                        <span class="fw-bold">
                           Advanced Analytics and Report
                        </span>
                     </li>
                     <li class="d-flex ">

                        <span class="fw-bold">
                           Site Visit, Booking, Appointment Registers
                        </span>
                     </li>

                  </ul>
                  <div class="d-flex justify-content-between p-4">

                     <div>
                        <button type="button" class="btn- submit bg-white submit_setting rounded-2 btn " name=""
                           data-bs-toggle="modal" data-value="100000" data-bs-target="#Enterprise" id="">
                           Upgrade Plan
                        </button>
                     </div>
                     <div class="pr-2">
                        <button class="btn btn- maxii _add bg-white" id="_add" name="_add" value="add"
                           data-bs-toggle="modal" data-bs-target="#enterprise">view
                           Details</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>