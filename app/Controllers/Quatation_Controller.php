<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

class Quatation_Controller extends BaseController
{
   public function __construct()
   {
      helper('custom');
      $db = db_connect();
      $this->MasterInformationModel = new MasterInformationModel($db);
      // $this->admin = 0;
      // $this->username = session_username($_SESSION['username']);
      // if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
      // $this->admin = 1;
      // }
   }

   public function GymQuatationCard()
   {
      // pre($_POST);
      $array1 = array(
         "id" => "0",
         "user" => "Staff Management",
         "project" => "Membership Management",
         "integration_type" => "",
         "property_type" => "Member Management",
         "sms" => "SMS",
         "whatsapp" => "WhatApp",
         "email" => "Email",
         "hr_form" => "HR Management",
         "account_module" => "Account Management",
         "reports_name" => "inq_report",
         "plan_name" => "Plan Information",
         "plan_price" => "44",
         "validity" => ""
      );
      $array = array($array1);
      // $array1444 = array('Facebook','Website');
      $integration_string = 'Facebook,Website';
      $integration_array_check = explode(',', $integration_string);
      // print_r($integration_array);  
      $all_ckeck = $this->request->getPost('all_ckeck');
      $data_subscription = $this->MasterInformationModel->display_all_records2('admin_subscription_master');

      if($_POST['offer_name'] && !empty($_POST['offer_name']))
      {
         $offer_name = $_POST['offer_name'];
      }else{
         $offer_name = "";
      }


      $data_admin_inquiry = $this->MasterInformationModel->edit_entry2('admin_all_inquiry', $_POST['edit_id']);
      $data_admin_inquiry = get_object_vars($data_admin_inquiry[0]);
      // print_r($data_admin_inquiry['quatation']);
      // die();
      $data_subscription = json_decode($data_subscription, true);

      $db_connection = DatabaseDefaultConnection();
      $sql = "SELECT * FROM `admin_subscription_master` WHERE crm = '2'";
      $result11 = $db_connection->query($sql);
      $data_subscription = $result11->getResultArray();
      // pre($resultsss);
      $new_array = array_merge($array, $data_subscription);

      if ($_POST['quotation_validity'] && !empty($_POST['quotation_validity'])) {
         $quotation_validity = $_POST['quotation_validity'];
      } else {
         $quotation_validity = "";
      }
      //   pre($new_array);
      //   pre($all_ckeck);

      $StoreManagement = '';
      $InventoryManagement = '';
      $WorkoutPlaning = '';
      $DietPlanning = '';
      $heading = '';
      $User = '';
      $project = '';
      $HR = '';
      $Account = '';
      $Property = '';
      $Email = '';
      $Whatsapp = '';
      $sms = '';
      $Facebook = '';
      $Website = '';
      $plan_name_all = '';
      $user_name = $_POST['user_name'];
      $check_count = $_POST['check_count'];
      $discount_amount = $_POST['discount_amount'];
      $savefile_name = '';
      $plan_details_table = '';

      $plan_details_table .= '  <table  style="width:750px; margin-left:-12px;">
                <tr>';
      foreach ($new_array as $key => $value) {
         if ($value['plan_price'] != '0') {
            if ($value['id'] != '0' && in_array($value['id'], $all_ckeck)) {
               if ($plan_name_all == '') {
                  $plan_name_all .= '' . $value['plan_name'] . '';
                  $savefile_name .= '' . $value['plan_name'] . '';
               } else {
                  $plan_name_all .= '/' . $value['plan_name'] . '';
                  $savefile_name .= '_' . $value['plan_name'] . '';
               }
               $total = $value['plan_price'] - $discount_amount;
               $netamount = ($total * 18) / 100;
               $total = $total + $netamount;
               $plan_details_table .= '
               <td style="width:33%; padding:10px;">
               <div> 
                                 <table class="c-table"  style=" width:100%;">
                                    <tr>
                                       <th style=" text-align: center;" colspan="2">' . $value['plan_name'] . '</th>
                                       </tr>
                                       <tr>
                                       <td>Fee ₹</td>
                                       <td style=" text-align: center;">' . $value['plan_price'] . '</td>
                                    </tr>';
               if ($discount_amount != '0' && $discount_amount != '') {
                  $plan_details_table .= '
										<tr>
                                 <td>Discount</td>
                                 <td style=" text-align: center;">' . $discount_amount . '</td>
										</tr>
                              <tr>
                                 <td><b>Offer Name</b></td>
                                 <td style=" text-align: center;"><b>' . $offer_name . '</b></td>
                              </tr>
                              <tr>
                                 <td><b>Offer Validity</b></td>
                                 <td style=" text-align: center;"><b>' . $quotation_validity . '</b></td>
                              </tr>
                              ';
               }
               $plan_details_table .= '
                                 <tr>
                                    <td>GST 18%</td>
                                    <td style=" text-align: center;">' . $netamount . '</td>
                                 </tr>
				                    <tr>
                                       <td>Total Amount</td>
                                       <td style=" text-align: center;">' . $total . '</td>
                                    </tr>
                                 </table>
                                 </div>
                       </td>
                              ';
               $heading .= '<th style=" text-align: center; width:80px;">' . $value['plan_name'] . '</th>';
               // $User .= '<td style=" text-align: center;">' . $value['user'] . '</td>';
               if ($value['user'] > 0) {
                  $User .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $User .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $DietPlanning .= '<td class="check" style=" text-align: center;" >✔️</td>';
               $project .= '<td class="check" style=" text-align: center;" >✔️</td>';
               if ($value['hr_form'] != '0') {
                  $HR .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $HR .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['account_module'] != '0') {
                  $Account .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Account .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $Property .= '<td class="check" style=" text-align: center;" >✔️</td>';
               $InventoryManagement .= '<td class="check" style=" text-align: center;" >✔️</td>';
               $WorkoutPlaning .= '<td class="check" style=" text-align: center;" >✔️</td>';

               $StoreManagement .= '<td class="check" style=" text-align: center;" >✔️</td>';
               if ($value['email'] != '0') {
                  $Email .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Email .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['whatsapp'] != '0') {
                  $Whatsapp .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Whatsapp .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['sms'] != '0') {
                  $sms .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $sms .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $integration_array = explode(',', $value['integration_type']);
               if (in_array('Facebook', $integration_array)) {
                  $Facebook .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Facebook .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if (in_array('Website', $integration_array)) {
                  $Website .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Website .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
            } else if ($value['id'] == '0') {
               $heading .= '<th>' . $value['plan_name'] . '</th>';
               $User .= '<td>' . $value['user'] . '</td>';
               $project .= '<td>' . $value['project'] . '</td>';
               $HR .= '<td>' . $value['hr_form'] . '</td>';
               $Account .= '<td>' . $value['account_module'] . '</td>';
               $Property .= '<td>' . $value['property_type'] . '</td>';
               $Email .= '<td>' . $value['email'] . '</td>';
               $Whatsapp .= '<td>' . $value['whatsapp'] . '</td>';
               $sms .= '<td>' . $value['sms'] . '</td>';
               $WorkoutPlaning .= '<td>Workout Planning</td>';
               $DietPlanning .= '<td>Diet Planning</td>';
               $StoreManagement .= '<td>Store Management</td>';
               $InventoryManagement .= '<td>Inventory Management</td>';
            }
         }
      }
      $plan_details_table .=  ' </tr>
      </table> ';
      date_default_timezone_set('Asia/Kolkata');
      $date = date('d-m-Y');
      $htmlContent = '';
      $htmlContent .= ' 
                     <html>
                           <head>
                              <style>
                                 @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
                                 *{
                                    font-size: 13px;
                                 }
                                 body {
                                    font-family:Dejavu Sans,sans-serif;
                                 }
                                 table {
                                    font-family:Dejavu Sans,sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                 }
                                 .c-table td, th {
                                    border: 1px solid #000;
                                    text-align: left;
                                    padding: 8px;
                                 }
                                 tr:nth-child(even) {
                                 background-color: #dddddd;
                                 }
                              .cross{
                                 color:#f44336;
                              }
                              .check{
                                 color:#04AA6D;
                              }
                               p {
                                 text-align: justify;
                              }
                              .pdf-hader{
                                 border-bottom: 3px solid #724ebf;
                              }
                           .hading-name{
                              font-size: 1.2rem;
                           }
                           @page {margin-top:150px; 
                           margin-bottom:30px;
                        }
                           header { position: fixed; top: -130px; left: 0px; right: 0px; height: 150px;}
                           footer { position: fixed; bottom:-20px; left: 0px; right: 0px; height: 50px;}
                              </style>
                           </head>
                           <body>          
                           <header> <table border="0" style="margin-top: -20px; ">
                           <tr border="0">
                           <td border="0"> 
                               <img src="https://dev.gymsmart.in/assets/image/gym-logo1.png" style=";margin-bottom: auto;" width="250" alt="logo" border="0">  
                            </td>
                           <td border="0">
                            <div class="co-name" style=" margin-left:auto; width:300px;">
                                 <h5 class="hading-name" style="margin-bottom:-10px;" >Ajasys Technologies </h5>
                                 <p style=" ">
                                    <small> 
                                       406, platinum point, Mota Varachha Main Rd, near sudama Chowk, Hans Society, Mota Varachha, Surat, Gujarat 394101
                                    </small> </p>
                              </div>
                            </td>
                        </tr>
                        </table>   
                        <div class="pdf-hader" style="width :800px; margin-left: -40px;"></div>       
                        </header>
                        <main> 
                           <section>
                                 <p style=" text-align:start;  margin:5; margin-top:50px;"> 
                                    Date: <strong>' . $date . '</strong>
                                 </p>
                                 <p style=" text-align:start;  margin:5;"> 
                                 Quotation Validity: <strong>' . $quotation_validity . '</strong>
                                 </p>
                                 
                                 <p style=" text-align:start; margin:5;">
                                    Subject: <strong>GymSmart ERP Quotation</strong>
                                 </p>
                                 <p style="margin:5px; margin-top:30px;">
                                    Dear : <strong>' . $user_name . ',</strong>
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We would like to introduce <strong> 	Ajasys Technologies </strong>  is an innovative company in the field of software research & Development for Enterprise Productivity since 2019. 
                                    In our last meeting with you we had provided an overview of the ERP software modules which will cater to most of your business requirements and improve profitability of your Organization.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We would like to submit this proposal for Gym Management ERP which includes commercial terms and conditions as per the company policy for ERP license, implementation and support fees.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; The Product owes its cutting edge to its technology developed by the team of IITians, & its user interface is completely Web & Mobile based, and is a Web application.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We are confident that your management will approve this ERP Implementation & give a go ahead to build business relations with <strong>GYMSMART ERP - ' . $plan_name_all . '.</strong>  
                                    We assure you the best of our support to make this project successful, and Returns on Investment (ROI).
                                 </p>
                                 <p style="margin:5px;">
                                    Please feel free to call if you need any more clarification .
                                 </p>
                                 <footer>
                                             <div class="pdf-hader" style="width : 800px; margin-left: -40px;"></div>
                                    <h5 style="text-align:center; margin-top:15px;"><small>© Copyright 2023 Ajasys Technologies All Rights Reserved.</small></h5>
                                 </footer>
                                 <div style="page-break-before:always">
                                 <h5 style="text-align:center; font-size:1.2rem;">Project Details </h5>
                                 <table class="c-table">
                                    <tr>
                                       ' . $heading . '
                                    </tr>

                                    <tr>
                                       ' . $User . '
                                    </tr>
                                   
                                    <tr>
                                       ' . $HR . '
                                    </tr>

                                    <tr>
                                       ' . $Account . '
                                    </tr>

                                    <tr>
                                       ' . $Property . '
                                    </tr>

                                    <tr>
                                       ' . $project . '
                                    </tr>

                                    <tr>
                                       ' . $DietPlanning . '
                                    </tr>

                                    <tr>
                                       ' . $WorkoutPlaning . '
                                    </tr>
                                    <tr>
                                       ' . $InventoryManagement . '
                                    </tr>
                                    <tr>
                                       ' . $StoreManagement . '
                                    </tr>
                                    <tr>
                                       ' . $Email . '
                                    </tr>
                                    <tr>
                                       ' . $Whatsapp . '
                                    </tr>
                                    <tr>
                                       ' . $sms . '
                                    </tr>
                                    <tr>
                                       <td colspan="' . $check_count . '">Lead Management</td>
                                    </tr>
                                    <tr>
                                       <td style="padding-left:30px;align-items: center;">Facebook</td>
                                       ' . $Facebook . '
                                    </tr>
                                    <tr>
                                       <td style="padding-left:30px;">Website</td>
                                       ' . $Website . '
                                    </tr>

                                 </table>
                                 <h5 style="text-align:center; font-size:1.2rem; margin-top:200px;">Package</h5>
                                 ' . $plan_details_table . '
                                 </div>
                                 <div style="page-break-before:always">
                                    <h4>Quotation Details:</h4>
                                    <p style="margin:5px;" >- Payment Schedule: Full payment at the time of order</p>
                                    <p  style="margin:5px;">- Payment Method: </p>
                                    <b  style="margin:5px; margin-left:50px;">(1) Bank Transfer : </b>
                                    <p  style="margin:5px; margin-left:73px;">Name: Ajasys Technologies </p>
                                    <p  style="margin:5px; margin-left:73px;">Bank: ICICI Bank</p>
                                    <p  style="margin:5px; margin-left:73px;">A/C No: 428105500891 </p>
                                    <p  style="margin:5px; margin-left:73px;">IFSC: ICIC0004281 </p>
                                    <b style="margin:5px; margin-left:50px;">(2) UPI Transfer </b>
                                 <div style="margin:5px; margin-left:100px;">
                                       <img src="https://dev.realtosmart.com/assets/images/ajasys_qr_code.jpg"
                                          width="250" alt="logo" border="0" />
                                    </div>
                                    <h4 style=""> Terms and Conditions: </h4>
                                    <p style="margin:5px;">• Purchase Order and all Payments should be made in the name of “Ajasys Technologies”</p>
                                    <p style="margin:5px;">• Account will be activated after 24 hours of receiving payment</p>
                                    <p style="margin:5px;">• Any customization (if agreed to at the time of finalization) should be done and tested before Go Live date as mutually agreed. This may revise the standard project plan submitted before finalization.</p>
                                    <p style="margin:5px;">• Customization may lead to deviation from the standard functionality of Gymsmart ERP Software. Customization may also result in no standard update and upgrade being available for the area related to customization being done. </p>
                                    <p style="margin:5px;">• Customers need to arrange for the latest computer system and high-speed Internet during the installation process.</p>
                                    </div>
                                    <p style="margin:5px;">• The Customer will make all efforts to make use of the standard forms and reports provided in the system with no modifications. In case there is any requirement for new forms or reports, the same shall be provided at additional charges as per the estimation given and duly approved by the customer.</p>
                                    <div style="page-break-before:always">
                                    <p style="margin:5px;">• The training on the proposed software would be provided only once at the head office of the customer or via video conference whichever is possible.</p>
                                 <p style="margin:5px;">• Payments made towards the ERP Licence and Implementation are non-refundable.</p>
                                 <p style="margin:5px;">• Particular Offer will be valid upto the offer date mentioned on website, the quotation will be changed if the offer is already closed as per the Offer Validity.</p>
                                 <p style="margin:5px;">• Expenses towards Travelling, Lodging, boarding, and any other incidental costs shall be borne by the client at locations where local Implementation teams of Gymsmart are not positioned. In cases where Implementation teams of gymsmart are positioned, Boarding shall be arranged during work hours by the customer, or expenses for the same shall be reimbursed.</p>
                                 <p style="margin:5px;"> An additional License Fee will be levied if it is found that the Gymsmart Software is being used for any company other than the companies in the Group to whom the license for usage is given (regardless of the total number of licenses sold to the customer).</p>
                                 <p style="margin:5px;">• Clients can not hire any employee from Gymsmart without written approval from the management within 3 years of separation. In case there is a need, the client can do so by paying 20 Lacs to Ajasys Technologies. The same is applicable from both sides.</p>
                                 <p style="margin:5px;">• Source code (in any form) is the property of Ajasys Technologies and it can not be shared.</p>
                                 <p style="margin:5px;">• Any changes or modifications to the scope of work may result in adjustments to the project timeline and cost.</p>
                                 <p style="margin:5px;">• Ajasys Technologies will provide regular updates on the project`s progress and involve the client in the testing and feedback stages.</p>
                                 <p style="margin:5px;">• Ajasys Technologies will ensure the confidentiality and security of all project-related information.</p>
                                 <p style="margin:5px; margin-top:30px;"> Please feel free to reach out to us with any questions or concerns you may have regarding this quotation. We are excited about the opportunity to work with you and deliver a software solution that exceeds your expectations.</p>
                                 <p style="margin:5px; "> Thank you for considering Ajasys Technologies for your software development needs. We look forward to the possibility of collaborating with you.</p>
                              <h5 style="margin:5px; font-size:1.1rem; margin-top:30px;">Sincerely,</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Hiren Vaghasiya</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Mobile Number: + 91 83479 77000</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Email: info@ajasys.com</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Ajasys Technologies</h5>
                              </div>
                              </section>
                              </main>
                              <footer>
                              <div class="pdf-hader" style="width : 800px; margin-left: -40px;"></div>
                              <h5 style="text-align:center; margin-top:15px;"><small>© Copyright 2023 Ajasys Technologies All Rights Reserved.</small></h5>
                              </footer>
                           </body>
                        </html>
                     ';
      $inquire_email = $_POST['user_email_q'];
      try {
         if (empty($htmlContent)) {
            throw new \Exception("HTML content is empty or invalid.");
         }
         $outputDirectory = 'assets/Quatation_Folder/';
         if (!is_dir($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
         }
         $outputFilename = 'GYM_' . $_POST['edit_id'] . '_' . $savefile_name . '.pdf';
         $options = new Options();
         $options->set('isRemoteEnabled', true);
         $options->set('isHtml5ParserEnabled', true);
         $options->set('isPhpEnabled', true);
         $dompdf = new Dompdf($options);
         $dompdf->loadHtml($htmlContent);
         $dompdf->render();
         $pdfOutput = $dompdf->output();
         file_put_contents($outputDirectory . $outputFilename, $pdfOutput);
         if ($inquire_email != '') {
            $email = \Config\Services::email();
            $email->setFrom('hiren@ajasys.in', 'Confirm Registration');
            $email->setTo($inquire_email);
            $email->setSubject('RealtoSmart ERP Quotation');
            $baseurl = base_url();
            $email->setMessage('Dear ' . $user_name . ',');
            $file_path = 'assets/Quatation_Folder/' . $outputFilename . '';
            $old_qutation_pdf = $data_admin_inquiry['quatation'];
            if ($old_qutation_pdf != '') {
               $new_pdf_q = $old_qutation_pdf . ',' . $outputFilename;
            } else {
               $new_pdf_q = $outputFilename;
            }
            $update_data['quatation'] = $new_pdf_q;
            $departmentUpdatedata = $this->MasterInformationModel->update_entry2($_POST['edit_id'], $update_data, "admin_all_inquiry");
            $email->attach($file_path);
            if ($email->send()) {
               $result['email_success'] = 'Email sent successfully!';
            } else {
               $result['email_fail'] = $email->printDebugger(['headers']);
            }
         }
      } catch (\Exception $e) {
         $result['pdf_fail'] = "Error: " . $e->getMessage();
      }
      $baseurl = base_url();
      $result['file_name'] = $baseurl . "assets/Quatation_Folder/" . $outputFilename;
      return json_encode($result);
      // echo $outputFilename;
      die();
   }

   public function leadmgtCard()
   {

      $array1 = array(
         "id" => "0",
         "user" => "Staff Management",
         "project" => "Membership Management",
         "integration_type" => "",
         "property_type" => "Member Management",
         "sms" => "SMS",
         "whatsapp" => "WhatApp",
         "email" => "Email",
         "hr_form" => "HR Management",
         "account_module" => "Account Management",
         "reports_name" => "inq_report",
         "plan_name" => "Plan Information",
         "plan_price" => "44",
         "validity" => ""
      );
      $array = array($array1);
      // $array1444 = array('Facebook','Website');
      $integration_string = 'Facebook,Website';
      $integration_array_check = explode(',', $integration_string);
      // print_r($integration_array);  
      $all_ckeck = $this->request->getPost('all_ckeck');
      $data_subscription = $this->MasterInformationModel->display_all_records2('admin_subscription_master');

      if ($_POST['addon_staff'] && !empty($_POST['addon_staff'])) {
         $addon_staff = $_POST['addon_staff'];
      } else {
         $addon_staff = 0;
      }

      if ($_POST['gst_price'] && !empty($_POST['gst_price'])) {
         $gst_price = $_POST['gst_price'];
      } else {
         $gst_price = 0;
      }
      if ($_POST['offer_name'] && !empty($_POST['offer_name'])) {
         $offer_name = $_POST['offer_name'];
      } else {
         $offer_name = "";
      }
      if ($_POST['subtotal'] && !empty($_POST['subtotal'])) {
         $subtotal = $_POST['subtotal'];
      } else {
         $subtotal = 0;
      }
      if ($_POST['grant_total'] && !empty($_POST['grant_total'])) {
         $grant_total = $_POST['grant_total'];
      } else {
         $grant_total = 0;
      }
      if ($_POST['ad_number'] && !empty($_POST['ad_number'])) {
         $ad_number = $_POST['ad_number'];
      } else {
         $ad_number = 0;
      }
      if ($_POST['quotation_validity'] && !empty($_POST['quotation_validity'])) {
         $quotation_validity = $_POST['quotation_validity'];
      } else {
         $quotation_validity = "";
      }

      $data_admin_inquiry = $this->MasterInformationModel->edit_entry2('admin_all_inquiry', $_POST['edit_id']);
      $data_admin_inquiry = get_object_vars($data_admin_inquiry[0]);
      // print_r($data_admin_inquiry['quatation']);
      // die();
      $data_subscription = json_decode($data_subscription, true);

      $db_connection = DatabaseDefaultConnection();
      $sql = "SELECT * FROM `admin_subscription_master` WHERE crm = '3'";
      $result11 = $db_connection->query($sql);
      $data_subscription = $result11->getResultArray();
      // pre($resultsss);
      $new_array = array_merge($array, $data_subscription);


      //   pre($new_array);
      //   pre($all_ckeck);

      $StoreManagement = '';
      $InventoryManagement = '';
      $WorkoutPlaning = '';
      $DietPlanning = '';
      $heading = '';
      $User = '';
      $project = '';
      $HR = '';
      $Account = '';
      $Property = '';
      $Email = '';
      $Whatsapp = '';
      $sms = '';
      $Facebook = '';
      $Website = '';
      $plan_name_all = '';
      $user_name = $_POST['user_name'];
      $check_count = $_POST['check_count'];
      $discount_amount = $_POST['discount_amount'];
      $savefile_name = '';
      $plan_details_table = '';

      $plan_details_table .= '  <table  style="width:750px; margin-left:-12px;">
                <tr>';
      foreach ($new_array as $key => $value) {
         if ($value['plan_price'] != '0') {
            if ($value['id'] != '0' && in_array($value['id'], $all_ckeck)) {
               if ($plan_name_all == '') {
                  $plan_name_all .= '' . $value['plan_name'] . '';
                  $savefile_name .= '' . $value['plan_name'] . '';
               } else {
                  $plan_name_all .= '/' . $value['plan_name'] . '';
                  $savefile_name .= '_' . $value['plan_name'] . '';
               }
               $total = $value['plan_price'] - $discount_amount;
               $netamount = ($total * 18) / 100;
               $total = $total + $netamount;
               $plan_details_table .= '
               <td style="width:33%; padding:10px;">
               <div> 
                                 <table class="c-table"  style=" width:100%;">
                                    <tr>
                                       <th style=" text-align: center;" colspan="2">' . $value['plan_name'] . '</th>
                                       </tr>
                                       <tr>
                                       <td>Fee ₹</td>
                                       <td style=" text-align: center;">' . $value['plan_price'] . '</td>
                                    </tr>';
               $amountWithoutSymbol = str_replace('₹', '', $subtotal);
               $addon_staff90 = str_replace('₹', '', $addon_staff);

               $grandd_totall = intval($value['plan_price']) + intval($amountWithoutSymbol) - $discount_amount;
               $addnstaff_multiple  = intval($addon_staff90) * intval($ad_number);
               $plan_details_table .= '
               <tr>
                  <td>Addon Staff</td>
                  <td style=" text-align: center;">' . '₹' .  intval($addon_staff90) . "*" . intval($ad_number) . "=" . '₹' . $addnstaff_multiple . '</td>
               </tr>
               ';
               if ($discount_amount != '0' && $discount_amount != '') {
                  $plan_details_table .= '
										<tr>
                                 <td>Discount</td>
                                 <td style=" text-align: center;">₹' . $discount_amount . '</td>
										</tr>
                              <tr>
                                 <td><b>Offer Name</b></td>
                                 <td style=" text-align: center;"><b>' . $offer_name . '</b></td>
										</tr>
                              <tr>
                                 <td><b>Offer Validity</b></td>
                                 <td style=" text-align: center;"><b>' . $quotation_validity . '</b></td>
                              </tr>';
               }
               $plan_details_table .= '   <tr>
               <td>Sub Total</td>
               <td style=" text-align: center;">₹' .  $grandd_totall   . '</td>
            </tr>';
               $gst_amt_total = intval($grandd_totall * 18) / 100;
               $finall_total = $grandd_totall + $gst_amt_total;
               $plan_details_table .= '
                                 <tr>
                                    <td>GST 18%</td>
                                    <td style=" text-align: center;">₹' .  $gst_amt_total . '</td>
                                 </tr>
				                    <tr>
                                       <td>Total Amount</td>
                                       <td style=" text-align: center;">₹' . $finall_total . '</td>
                                    </tr>
                                 </table>
                                 </div>
                       </td>
                              ';
               $heading .= '<th style=" text-align: center; width:80px;">' . $value['plan_name'] . '</th>';
               // $User .= '<td style=" text-align: center;">' . $value['user'] . '</td>';
               if ($value['user'] > 0) {
                  $User .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $User .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $DietPlanning .= '<td class="check" style=" text-align: center;" >✔️</td>';
               $project .= '<td class="check" style=" text-align: center;" >✔️</td>';
               if ($value['hr_form'] != '0') {
                  $HR .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $HR .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['account_module'] != '0') {
                  $Account .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Account .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $Property .= '<td class="check" style=" text-align: center;" >✔️</td>';
               $InventoryManagement .= '<td class="check" style=" text-align: center;" >✔️</td>';
               $WorkoutPlaning .= '<td class="check" style=" text-align: center;" >✔️</td>';

               $StoreManagement .= '<td class="check" style=" text-align: center;" >✔️</td>';
               if ($value['email'] != '0') {
                  $Email .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Email .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['whatsapp'] != '0') {
                  $Whatsapp .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Whatsapp .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['sms'] != '0') {
                  $sms .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $sms .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $integration_array = explode(',', $value['integration_type']);
               if (in_array('Facebook', $integration_array)) {
                  $Facebook .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Facebook .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if (in_array('Website', $integration_array)) {
                  $Website .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Website .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
            } else if ($value['id'] == '0') {
               $heading .= '<th>' . $value['plan_name'] . '</th>';
               $User .= '<td>' . $value['user'] . '</td>';
               $project .= '<td>' . $value['project'] . '</td>';
               $HR .= '<td>' . $value['hr_form'] . '</td>';
               $Account .= '<td>' . $value['account_module'] . '</td>';
               $Property .= '<td>' . $value['property_type'] . '</td>';
               $Email .= '<td>' . $value['email'] . '</td>';
               $Whatsapp .= '<td>' . $value['whatsapp'] . '</td>';
               $sms .= '<td>' . $value['sms'] . '</td>';
               $WorkoutPlaning .= '<td>Workout Planning</td>';
               $DietPlanning .= '<td>Diet Planning</td>';
               $StoreManagement .= '<td>Store Management</td>';
               $InventoryManagement .= '<td>Inventory Management</td>';
            }
         }
      }
      $plan_details_table .=  ' </tr>
      </table> ';
      date_default_timezone_set('Asia/Kolkata');
      $date = date('d-m-Y');
      $htmlContent = '';
      $htmlContent .= ' 
                     <html>
                           <head>
                              <style>
                                 @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
                                 *{
                                    font-size: 13px;
                                 }
                                 body {
                                    font-family:Dejavu Sans,sans-serif;
                                 }
                                 table {
                                    font-family:Dejavu Sans,sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                 }
                                 .c-table td, th {
                                    border: 1px solid #000;
                                    text-align: left;
                                    padding: 8px;
                                 }
                                 tr:nth-child(even) {
                                 background-color: #dddddd;
                                 }
                              .cross{
                                 color:#f44336;
                              }
                              .check{
                                 color:#04AA6D;
                              }
                               p {
                                 text-align: justify;
                              }
                              .pdf-hader{
                                 border-bottom: 3px solid #724ebf;
                              }
                           .hading-name{
                              font-size: 1.2rem;
                           }
                           @page {margin-top:150px; 
                           margin-bottom:30px;
                        }
                           header { position: fixed; top: -130px; left: 0px; right: 0px; height: 150px;}
                           footer { position: fixed; bottom:-20px; left: 0px; right: 0px; height: 50px;}
                              </style>
                           </head>
                           <body>          
                           <header> <table border="0" style="margin-top: -20px; ">
                           <tr border="0">
                           <td border="0"> 
                               <img src="https://dev.leadmgtcrm.com//assets/image/logo-dark.png" style=";margin-bottom: auto;" width="250" alt="logo" border="0">  
                            </td>
                           <td border="0">
                            <div class="co-name" style=" margin-left:auto; width:300px;">
                                 <h5 class="hading-name" style="margin-bottom:-10px;" >Ajasys Technologies </h5>
                                 <p style=" ">
                                    <small> 
                                       406, platinum point, Mota Varachha Main Rd, near sudama Chowk, Hans Society, Mota Varachha, Surat, Gujarat 394101
                                    </small> </p>
                              </div>
                            </td>
                        </tr>
                        </table>   
                        <div class="pdf-hader" style="width :800px; margin-left: -40px;"></div>       
                        </header>
                        <main> 
                           <section>
                                 <p style=" text-align:start;  margin:5; margin-top:50px;"> 
                                    Date: <strong>' . $date . '</strong>
                                 </p>
                                 <p style=" text-align:start;  margin:5; "> 
                                 Quotation Validity: <strong>' . $quotation_validity . '</strong>
                              </p>
                                 <p style=" text-align:start; margin:5;">
                                    Subject: <strong>Leadmgt ERP Quotation</strong>
                                 </p>
                                 <p style="margin:5px; margin-top:30px;">
                                    Dear : <strong>' . $user_name . ',</strong>
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We would like to introduce <strong> 	Ajasys Technologies </strong>  is an innovative company in the field of software research & Development for Enterprise Productivity since 2019. 
                                    In our last meeting with you we had provided an overview of the ERP software modules which will cater to most of your business requirements and improve profitability of your Organization.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We would like to submit this proposal for Real Estate ERP which includes commercial terms and conditions as per the company policy for ERP license, implementation and support fees.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; The Product owes its cutting edge to its technology developed by the team of IITians, & its user interface is completely Web & Mobile based, and is a Web application.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We are confident that your management will approve this ERP Implementation & give a go ahead to build business relations with <strong>LEADMGT ERP - ' . $plan_name_all . '.</strong>  
                                    We assure you the best of our support to make this project successful, and Returns on Investment (ROI).
                                 </p>
                                 <p style="margin:5px;">
                                    Please feel free to call if you need any more clarification .
                                 </p>
                                 <footer>
                                             <div class="pdf-hader" style="width : 800px; margin-left: -40px;"></div>
                                    <h5 style="text-align:center; margin-top:15px;"><small>© Copyright 2023 Ajasys Technologies All Rights Reserved.</small></h5>
                                 </footer>
                                 <div style="page-break-before:always">
                                 <h5 style="text-align:center; font-size:1.2rem;">Project Details </h5>
                                 <table class="c-table">
                                    <tr>
                                       ' . $heading . '
                                    </tr>

                                    <tr>
                                       ' . $User . '
                                    </tr>
                                   
                                    <tr>
                                       ' . $HR . '
                                    </tr>

                                    <tr>
                                       ' . $Account . '
                                    </tr>

                                    <tr>
                                       ' . $Property . '
                                    </tr>

                                   

                              

                                  
                                    <tr>
                                       ' . $InventoryManagement . '
                                    </tr>
                                    <tr>
                                       ' . $StoreManagement . '
                                    </tr>
                                    <tr>
                                       ' . $Email . '
                                    </tr>
                                    <tr>
                                       ' . $Whatsapp . '
                                    </tr>
                                    <tr>
                                       ' . $sms . '
                                    </tr>
                                    <tr>
                                       <td colspan="' . $check_count . '">Lead Management</td>
                                    </tr>
                                    <tr>
                                       <td style="padding-left:30px;align-items: center;">Facebook</td>
                                       ' . $Facebook . '
                                    </tr>
                                    <tr>
                                       <td style="padding-left:30px;">Website</td>
                                       ' . $Website . '
                                    </tr>

                                 </table>
                                 <h5 style="text-align:center; font-size:1.2rem; margin-top:200px;">Package</h5>
                                 ' . $plan_details_table . '
                                 </div>
                                 <div style="page-break-before:always">
                                    <h4>Quotation Details:</h4>
                                    <p style="margin:5px;" >- Payment Schedule: Full payment at the time of order</p>
                                    <p  style="margin:5px;">- Payment Method: </p>
                                    <b  style="margin:5px; margin-left:50px;">(1) Bank Transfer : </b>
                                    <p  style="margin:5px; margin-left:73px;">Name: Ajasys Technologies </p>
                                    <p  style="margin:5px; margin-left:73px;">Bank: ICICI Bank</p>
                                    <p  style="margin:5px; margin-left:73px;">A/C No: 428105500891 </p>
                                    <p  style="margin:5px; margin-left:73px;">IFSC: ICIC0004281 </p>
                                    <b style="margin:5px; margin-left:50px;">(2) UPI Transfer </b>
                                 <div style="margin:5px; margin-left:100px;">
                                       <img src="https://dev.realtosmart.com/assets/images/ajasys_qr_code.jpg"
                                          width="250" alt="logo" border="0" />
                                    </div>
                                    <h4 style=""> Terms and Conditions: </h4>
                                    <p style="margin:5px;">• Purchase Order and all Payments should be made in the name of “Ajasys Technologies”</p>
                                    <p style="margin:5px;">• Account will be activated after 24 hours of receiving payment</p>
                                    <p style="margin:5px;">• Any customization (if agreed to at the time of finalization) should be done and tested before Go Live date as mutually agreed. This may revise the standard project plan submitted before finalization.</p>
                                    <p style="margin:5px;">• Customization may lead to deviation from the standard functionality of realtosmart ERP Software. Customization may also result in no standard update and upgrade being available for the area related to customization being done. </p>
                                    <p style="margin:5px;">• Customers need to arrange for the latest computer system and high-speed Internet during the installation process.</p>
                                    </div>
                                    <p style="margin:5px;">• The Customer will make all efforts to make use of the standard forms and reports provided in the system with no modifications. In case there is any requirement for new forms or reports, the same shall be provided at additional charges as per the estimation given and duly approved by the customer.</p>
                                    <div style="page-break-before:always">
                                    <p style="margin:5px;">• The training on the proposed software would be provided only once at the head office of the customer or via video conference whichever is possible.</p>
                                 <p style="margin:5px;">• Payments made towards the ERP Licence and Implementation are non-refundable.</p>
                                 <p style="margin:5px;">• Particular Offer will be valid upto the offer date mentioned on website, the quotation will be changed if the offer is already closed as per the Offer Validity.</p>
                                 <p style="margin:5px;">• Expenses towards Travelling, Lodging, boarding, and any other incidental costs shall be borne by the client at locations where local Implementation teams of realtosmart are not positioned. In cases where Implementation teams of realtosmart are positioned, Boarding shall be arranged during work hours by the customer, or expenses for the same shall be reimbursed.</p>
                                 <p style="margin:5px;"> An additional License Fee will be levied if it is found that the realtosmart Software is being used for any company other than the companies in the Group to whom the license for usage is given (regardless of the total number of licenses sold to the customer).</p>
                                 <p style="margin:5px;">• Clients can not hire any employee from realtosmart without written approval from the management within 3 years of separation. In case there is a need, the client can do so by paying 20 Lacs to Ajasys Technologies. The same is applicable from both sides.</p>
                                 <p style="margin:5px;">• Source code (in any form) is the property of Ajasys Technologies and it can not be shared.</p>
                                 <p style="margin:5px;">• Any changes or modifications to the scope of work may result in adjustments to the project timeline and cost.</p>
                                 <p style="margin:5px;">• Ajasys Technologies will provide regular updates on the project`s progress and involve the client in the testing and feedback stages.</p>
                                 <p style="margin:5px;">• Ajasys Technologies will ensure the confidentiality and security of all project-related information.</p>
                                 <p style="margin:5px; margin-top:30px;"> Please feel free to reach out to us with any questions or concerns you may have regarding this quotation. We are excited about the opportunity to work with you and deliver a software solution that exceeds your expectations.</p>
                                 <p style="margin:5px; "> Thank you for considering Ajasys Technologies for your software development needs. We look forward to the possibility of collaborating with you.</p>
                              <h5 style="margin:5px; font-size:1.1rem; margin-top:30px;">Sincerely,</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Hiren Vaghasiya</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Mobile Number: + 91 83479 77000</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Email: info@ajasys.com</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Ajasys Technologies</h5>
                              </div>
                              </section>
                              </main>
                              <footer>
                              <div class="pdf-hader" style="width : 800px; margin-left: -40px;"></div>
                              <h5 style="text-align:center; margin-top:15px;"><small>© Copyright 2023 Ajasys Technologies All Rights Reserved.</small></h5>
                              </footer>
                           </body>
                        </html>
                     ';
      $inquire_email = $_POST['user_email_q'];
      try {
         if (empty($htmlContent)) {
            throw new \Exception("HTML content is empty or invalid.");
         }
         $outputDirectory = 'assets/Quatation_Folder/';
         if (!is_dir($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
         }
         $timestamp = time();
         $outputFilename = 'lead_' . $_POST['edit_id'] . '_' . $timestamp . '.pdf';
         $options = new Options();
         $options->set('isRemoteEnabled', true);
         $options->set('isHtml5ParserEnabled', true);
         $options->set('isPhpEnabled', true);
         $dompdf = new Dompdf($options);
         $dompdf->loadHtml($htmlContent);
         $dompdf->render();
         $pdfOutput = $dompdf->output();
         file_put_contents($outputDirectory . $outputFilename, $pdfOutput);
         if ($inquire_email != '') {
            $email = \Config\Services::email();
            $email->setFrom('hiren@ajasys.in', 'Confirm Registration');
            $email->setTo($inquire_email);
            $email->setSubject('RealtoSmart ERP Quotation');
            $baseurl = base_url();
            $email->setMessage('Dear ' . $user_name . ',');
            $file_path = 'assets/Quatation_Folder/' . $outputFilename . '';
            $old_qutation_pdf = $data_admin_inquiry['quatation'];
            if ($old_qutation_pdf != '') {
               $new_pdf_q = $old_qutation_pdf . ',' . $outputFilename;
            } else {
               $new_pdf_q = $outputFilename;
            }
            $update_data['quatation'] = $new_pdf_q;
            $departmentUpdatedata = $this->MasterInformationModel->update_entry2($_POST['edit_id'], $update_data, "admin_all_inquiry");
            $email->attach($file_path);
            if ($email->send()) {
               $result['email_success'] = 'Email sent successfully!';
            } else {
               $result['email_fail'] = $email->printDebugger(['headers']);
            }
         }
      } catch (\Exception $e) {
         $result['pdf_fail'] = "Error: " . $e->getMessage();
      }
      $baseurl = base_url();
      $result['file_name'] = $baseurl . "assets/Quatation_Folder/" . $outputFilename;
      return json_encode($result);
      // echo $outputFilename;
      die();
   }
   public function convertToPdf()
   {
      $array1 = array(
         "id" => "0",
         "user" => "User",
         "project" => "Project Listing",
         "integration_type" => "",
         "property_type" => "Property Listing",
         "sms" => "SMS",
         "whatsapp" => "WhatApp",
         "email" => "Email",
         "hr_form" => "HR Management",
         "account_module" => "Account Management",
         "reports_name" => "inq_report",
         "plan_name" => "Plan Information",
         "plan_price" => "44",
         "validity" => ""
      );
      $array = array($array1);
      // $array1444 = array('Facebook','Website');
      $integration_string = 'Facebook,Website';
      $integration_array_check = explode(',', $integration_string);
      // print_r($integration_array);  
      $all_ckeck = $this->request->getPost('all_ckeck');
      $data_subscription = $this->MasterInformationModel->display_all_records2('admin_subscription_master');

      if ($_POST['addon_staff'] && !empty($_POST['addon_staff'])) {
         $addon_staff = 1000;
      } else {
         $addon_staff = 0;
      }

      if ($_POST['gst_price'] && !empty($_POST['gst_price'])) {
         $gst_price = $_POST['gst_price'];
      } else {
         $gst_price = 0;
      }
      if ($_POST['subtotal'] && !empty($_POST['subtotal'])) {
         $subtotal = $_POST['subtotal'];
      } else {
         $subtotal = 0;
      }
      if ($_POST['grant_total'] && !empty($_POST['grant_total'])) {
         $grant_total = $_POST['grant_total'];
      } else {
         $grant_total = 0;
      }
      if ($_POST['ad_number'] && !empty($_POST['ad_number'])) {
         $ad_number = $_POST['ad_number'];
      } else {
         $ad_number = 0;
      }
      if ($_POST['offer_name'] && !empty($_POST['offer_name'])) {
         $offer_name = $_POST['offer_name'];
      } else {
         $offer_name = "";
      }

      if ($_POST['quotation_validity'] && !empty($_POST['quotation_validity'])) {
         $quotation_validity = $_POST['quotation_validity'];
      } else {
         $quotation_validity = "";
      }


      $data_admin_inquiry = $this->MasterInformationModel->edit_entry2('admin_all_inquiry', $_POST['edit_id']);
      $data_admin_inquiry = get_object_vars($data_admin_inquiry[0]);
      // print_r($data_admin_inquiry['quatation']);
      // die();
      $data_subscription = json_decode($data_subscription, true);

      $db_connection = DatabaseDefaultConnection();
      $sql = "SELECT * FROM `admin_subscription_master` WHERE crm = '1'";
      $result11 = $db_connection->query($sql);
      $data_subscription = $result11->getResultArray();
      // pre($resultsss);
      $new_array = array_merge($array, $data_subscription);



      // die();

      $heading = '';
      $User = '';
      $project = '';
      $HR = '';
      $Account = '';
      $Property = '';
      $Email = '';
      $Whatsapp = '';
      $sms = '';
      $Facebook = '';
      $Website = '';
      $plan_name_all = '';
      $user_name = $_POST['user_name'];
      $check_count = $_POST['check_count'];
      $discount_amount = $_POST['discount_amount'];
      $savefile_name = '';
      $plan_details_table = '';
      $plan_details_table .= '  <table  style="width:750px; margin-left:-12px;">
                <tr>';
      foreach ($new_array as $key => $value) {
         if ($value['plan_price'] != '0') {
            if ($value['id'] != '0' && in_array($value['id'], $all_ckeck)) {
               if ($plan_name_all == '') {
                  $plan_name_all .= '' . $value['plan_name'] . '';
                  $savefile_name .= '' . $value['plan_name'] . '';
               } else {
                  $plan_name_all .= '/' . $value['plan_name'] . '';
                  $savefile_name .= '_' . $value['plan_name'] . '';
               }
               $total = $value['plan_price'] - $discount_amount;
               $netamount = ($total * 18) / 100;
               $total = $total + $netamount;
               $plan_details_table .= '
               <td style="width:33%; padding:10px;">
               <div> 
                                 <table class="c-table"  style=" width:100%;">
                                    <tr>
                                       <th style=" text-align: center;" colspan="2">' . $value['plan_name'] . '</th>
                                       </tr>
                                       <tr>
                                       <td>Fee ₹</td>
                                       <td style=" text-align: center;">' . $value['plan_price'] . '</td>
                                    </tr>';
               $amountWithoutSymbol = str_replace('₹', '', $subtotal);
               $addon_staff90 = str_replace('₹', '', $addon_staff);

               $grandd_totall = intval($value['plan_price']) + intval($amountWithoutSymbol) - $discount_amount;
               $addnstaff_multiple  = intval($addon_staff90) * intval($ad_number);
               $plan_details_table .= '
               <tr>
                  <td>Addon Staff</td>
                  <td style=" text-align: center;">' . '₹' .  intval($addon_staff90) . "*" . intval($ad_number) . "=" . '₹' . $addnstaff_multiple . '</td>
               </tr>
               ';
               if ($discount_amount != '0' && $discount_amount != '') {
                  $plan_details_table .= '
										<tr>
										<td>Discount</td>
										<td style=" text-align: center;">₹' . $discount_amount . '</td>
										</tr>
                              <tr>
                                 <td><b>Offer Name</b></td>
                                 <td style=" text-align: center;"><b>' . $offer_name . '</b></td>
                              </tr>
                              <tr>
                              <td><b>Offer Validity</b></td>
                              <td style=" text-align: center;"><b>' . $quotation_validity . '</b></td>
                           </tr>';
               }
               $plan_details_table .= '   <tr>
               <td>Sub Total</td>
               <td style=" text-align: center;">₹' .  $grandd_totall   . '</td>
            </tr>';
               $gst_amt_total = intval($grandd_totall * 18) / 100;
               $finall_total = $grandd_totall + $gst_amt_total;
               $plan_details_table .= '
                                 <tr>
                                    <td>GST 18%</td>
                                    <td style=" text-align: center;">₹' .  $gst_amt_total . '</td>
                                 </tr>
				                    <tr>
                                       <td>Total Amount</td>
                                       <td style=" text-align: center;">₹' . $finall_total . '</td>
                                    </tr>
                                 </table>
                                 </div>
                       </td>
                              ';
               $heading .= '<th style=" text-align: center; width:80px;">' . $value['plan_name'] . '</th>';
               $User .= '<td style=" text-align: center;">' . $value['user'] . '</td>';
               $project .= '<td style=" text-align: center;">' . $value['project'] . '</td>';
               if ($value['hr_form'] != '0') {
                  $HR .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $HR .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['account_module'] != '0') {
                  $Account .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Account .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $Property .= '<td style=" text-align: center;">' . $value['property_type'] . '</td>';
               if ($value['email'] != '0') {
                  $Email .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Email .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['whatsapp'] != '0') {
                  $Whatsapp .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Whatsapp .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if ($value['sms'] != '0') {
                  $sms .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $sms .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               $integration_array = explode(',', $value['integration_type']);
               if (in_array('Facebook', $integration_array)) {
                  $Facebook .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Facebook .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
               if (in_array('Website', $integration_array)) {
                  $Website .= '<td class="check" style=" text-align: center;" >✔️</td>';
               } else {
                  $Website .= '<td  class="cross"style=" text-align: center;"> <b>x</b></td>';
               }
            } else if ($value['id'] == '0') {
               $heading .= '<th>' . $value['plan_name'] . '</th>';
               $User .= '<td>' . $value['user'] . '</td>';
               $project .= '<td>' . $value['project'] . '</td>';
               $HR .= '<td>' . $value['hr_form'] . '</td>';
               $Account .= '<td>' . $value['account_module'] . '</td>';
               $Property .= '<td>' . $value['property_type'] . '</td>';
               $Email .= '<td>' . $value['email'] . '</td>';
               $Whatsapp .= '<td>' . $value['whatsapp'] . '</td>';
               $sms .= '<td>' . $value['sms'] . '</td>';
            }
         }
      }
      $plan_details_table .=  ' </tr>
      </table> ';
      date_default_timezone_set('Asia/Kolkata');
      $date = date('d-m-Y');
      $htmlContent = '';
      $htmlContent .= ' 
                     <html>
                           <head>
                              <style>
                                 @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
                                 *{
                                    font-size: 13px;
                                 }
                                 body {
                                    font-family:Dejavu Sans,sans-serif;
                                 }
                                 table {
                                    font-family:Dejavu Sans,sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                 }
                                 .c-table td, th {
                                    border: 1px solid #000;
                                    text-align: left;
                                    padding: 8px;
                                 }
                                 tr:nth-child(even) {
                                 background-color: #dddddd;
                                 }
                              .cross{
                                 color:#f44336;
                              }
                              .check{
                                 color:#04AA6D;
                              }
                               p {
                                 text-align: justify;
                              }
                              .pdf-hader{
                                 border-bottom: 3px solid #724ebf;
                              }
                           .hading-name{
                              font-size: 1.2rem;
                           }
                           @page {margin-top:150px; 
                           margin-bottom:30px;
                        }
                           header { position: fixed; top: -130px; left: 0px; right: 0px; height: 150px;}
                           footer { position: fixed; bottom:-20px; left: 0px; right: 0px; height: 50px;}
                              </style>
                           </head>
                           <body>          
                           <header> <table border="0" style="margin-top: -20px; ">
                           <tr border="0">
                           <td border="0"> 
                               <img src="' . base_url() . 'assets/images/RealtoSmart Logo.png" style=";margin-bottom: auto;" width="250" alt="logo" border="0">  
                            </td>
                           <td border="0">
                            <div class="co-name" style=" margin-left:auto; width:300px;">
                                 <h5 class="hading-name" style="margin-bottom:-10px;" >Ajasys Technologies </h5>
                                 <p style=" ">
                                    <small> 
                                       406, platinum point, Mota Varachha Main Rd, near sudama Chowk, Hans Society, Mota Varachha, Surat, Gujarat 394101
                                    </small> </p>
                              </div>
                            </td>
                        </tr>
                        </table>   
                        <div class="pdf-hader" style="width :800px; margin-left: -40px;"></div>       
                        </header>
                        <main> 
                           <section>
                                 <p style=" text-align:start;  margin:5; margin-top:50px;"> 
                                    Date: <strong>' . $date . '</strong>
                                 </p>
                                 <p style=" text-align:start;  margin:5;"> 
                                 Quotation Validity  : <strong>' . $quotation_validity . '</strong>
                                 </p>
                                 <p style=" text-align:start; margin:5;">
                                    Subject: <strong>RealtoSmart ERP Quotation</strong>
                                 </p>
                                 <p style="margin:5px; margin-top:30px;">
                                    Dear : <strong>' . $user_name . ',</strong>
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We would like to introduce <strong> 	Ajasys Technologies </strong>  is an innovative company in the field of software research & Development for Enterprise Productivity since 2019. 
                                    In our last meeting with you we had provided an overview of the ERP software modules which will cater to most of your business requirements and improve profitability of your Organization.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We would like to submit this proposal for Real Estate ERP which includes commercial terms and conditions as per the company policy for ERP license, implementation and support fees.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; The Product owes its cutting edge to its technology developed by the team of IITians, & its user interface is completely Web & Mobile based, and is a Web application.
                                 </p>
                                 <p style="margin:5px;">
                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; We are confident that your management will approve this ERP Implementation & give a go ahead to build business relations with <strong>REALTOSMART ERP - ' . $plan_name_all . '.</strong>  
                                    We assure you the best of our support to make this project successful, and Returns on Investment (ROI).
                                 </p>
                                 <p style="margin:5px;">
                                    Please feel free to call if you need any more clarification .
                                 </p>
                                 <footer>
                                             <div class="pdf-hader" style="width : 800px; margin-left: -40px;"></div>
                                    <h5 style="text-align:center; margin-top:15px;"><small>© Copyright 2023 Ajasys Technologies All Rights Reserved.</small></h5>
                                 </footer>
                                 <div style="page-break-before:always">
                                 <h5 style="text-align:center; font-size:1.2rem;">Project Details </h5>
                                 <table class="c-table">
                                    <tr>
                                       ' . $heading . '
                                    </tr>
                                    <tr>
                                       ' . $User . '
                                    </tr>
                                    <tr>
                                       ' . $project . '
                                    </tr>
                                    <tr>
                                       ' . $HR . '
                                    </tr>
                                    <tr>
                                       ' . $Account . '
                                    </tr>
                                    <tr>
                                       ' . $Property . '
                                    </tr>
                                    <tr>
                                       ' . $Email . '
                                    </tr>
                                    <tr>
                                       ' . $Whatsapp . '
                                    </tr>
                                    <tr>
                                       ' . $sms . '
                                    </tr>
                                    <tr>
                                       <td colspan="' . $check_count . '">Lead Management</td>
                                    </tr>
                                    <tr>
                                       <td style="padding-left:30px;align-items: center;">Facebook</td>
                                       ' . $Facebook . '
                                    </tr>
                                    <tr>
                                       <td style="padding-left:30px;">Website</td>
                                       ' . $Website . '
                                    </tr>
                                 </table>
                                 <h5 style="text-align:center; font-size:1.2rem;">Package</h5>
                                 ' . $plan_details_table . '
                                 </div>
                                 <div style="page-break-before:always">
                                    <h4>Quotation Details:</h4>
                                    <p style="margin:5px;" >- Payment Schedule: Full payment at the time of order</p>
                                    <p  style="margin:5px;">- Payment Method: </p>
                                    <b  style="margin:5px; margin-left:50px;">(1) Bank Transfer : </b>
                                    <p  style="margin:5px; margin-left:73px;">Name: Ajasys Technologies </p>
                                    <p  style="margin:5px; margin-left:73px;">Bank: ICICI Bank</p>
                                    <p  style="margin:5px; margin-left:73px;">A/C No: 428105500891 </p>
                                    <p  style="margin:5px; margin-left:73px;">IFSC: ICIC0004281 </p>
                                    <b style="margin:5px; margin-left:50px;">(2) UPI Transfer </b>
                                 <div style="margin:5px; margin-left:100px;">
                                       <img src="https://dev.realtosmart.com/assets/images/ajasys_qr_code.jpg"
                                          width="250" alt="logo" border="0" />
                                    </div>
                                    <h4 style=""> Terms and Conditions: </h4>
                                    <p style="margin:5px;">• Purchase Order and all Payments should be made in the name of “Ajasys Technologies”</p>
                                    <p style="margin:5px;">• Account will be activated after 24 hours of receiving payment</p>
                                    <p style="margin:5px;">• Any customization (if agreed to at the time of finalization) should be done and tested before Go Live date as mutually agreed. This may revise the standard project plan submitted before finalization.</p>
                                    <p style="margin:5px;">• Customization may lead to deviation from the standard functionality of realtosmart ERP Software. Customization may also result in no standard update and upgrade being available for the area related to customization being done. </p>
                                    <p style="margin:5px;">• Customers need to arrange for the latest computer system and high-speed Internet during the installation process.</p>
                                    </div>
                                    <p style="margin:5px;">• The Customer will make all efforts to make use of the standard forms and reports provided in the system with no modifications. In case there is any requirement for new forms or reports, the same shall be provided at additional charges as per the estimation given and duly approved by the customer.</p>
                                    <div style="page-break-before:always">
                                    <p style="margin:5px;">• The training on the proposed software would be provided only once at the head office of the customer or via video conference whichever is possible.</p>
                                 <p style="margin:5px;">• Payments made towards the ERP Licence and Implementation are non-refundable.</p>
                                 <p style="margin:5px;">• Particular Offer will be valid upto the offer date mentioned on website, the quotation will be changed if the offer is already closed as per the Offer Validity.</p>
                                 <p style="margin:5px;">• Expenses towards Travelling, Lodging, boarding, and any other incidental costs shall be borne by the client at locations where local Implementation teams of realtosmart are not positioned. In cases where Implementation teams of realtosmart are positioned, Boarding shall be arranged during work hours by the customer, or expenses for the same shall be reimbursed.</p>
                                 <p style="margin:5px;"> An additional License Fee will be levied if it is found that the realtosmart Software is being used for any company other than the companies in the Group to whom the license for usage is given (regardless of the total number of licenses sold to the customer).</p>
                                 <p style="margin:5px;">• Clients can not hire any employee from realtosmart without written approval from the management within 3 years of separation. In case there is a need, the client can do so by paying 20 Lacs to Ajasys Technologies. The same is applicable from both sides.</p>
                                 <p style="margin:5px;">• Source code (in any form) is the property of Ajasys Technologies and it can not be shared.</p>
                                 <p style="margin:5px;">• Any changes or modifications to the scope of work may result in adjustments to the project timeline and cost.</p>
                                 <p style="margin:5px;">• Ajasys Technologies will provide regular updates on the project`s progress and involve the client in the testing and feedback stages.</p>
                                 <p style="margin:5px;">• Ajasys Technologies will ensure the confidentiality and security of all project-related information.</p>
                                 <p style="margin:5px; margin-top:30px;"> Please feel free to reach out to us with any questions or concerns you may have regarding this quotation. We are excited about the opportunity to work with you and deliver a software solution that exceeds your expectations.</p>
                                 <p style="margin:5px; "> Thank you for considering Ajasys Technologies for your software development needs. We look forward to the possibility of collaborating with you.</p>
                              <h5 style="margin:5px; font-size:1.1rem; margin-top:30px;">Sincerely,</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Hiren Vaghasiya</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Mobile Number: + 91 83479 77000</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Email: info@ajasys.com</h5>
                              <h5 style="margin:5px; font-size:1.1rem;">Ajasys Technologies</h5>
                              </div>
                              </section>
                              </main>
                              <footer>
                              <div class="pdf-hader" style="width : 800px; margin-left: -40px;"></div>
                              <h5 style="text-align:center; margin-top:15px;"><small>© Copyright 2023 Ajasys Technologies All Rights Reserved.</small></h5>
                              </footer>
                           </body>
                        </html>
                     ';
      $inquire_email = $_POST['user_email_q'];
      try {
         if (empty($htmlContent)) {
            throw new \Exception("HTML content is empty or invalid.");
         }
         $outputDirectory = 'assets/Quatation_Folder/';
         if (!is_dir($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
         }
         $outputFilename = '' . $_POST['edit_id'] . '_' . $savefile_name . '.pdf';
         $options = new Options();
         $options->set('isRemoteEnabled', true);
         $options->set('isHtml5ParserEnabled', true);
         $options->set('isPhpEnabled', true);
         $dompdf = new Dompdf($options);
         $dompdf->loadHtml($htmlContent);
         $dompdf->render();
         $pdfOutput = $dompdf->output();
         file_put_contents($outputDirectory . $outputFilename, $pdfOutput);
         if ($inquire_email != '') {
            $email = \Config\Services::email();
            $email->setFrom('hiren@ajasys.in', 'Confirm Registration');
            $email->setTo($inquire_email);
            $email->setSubject('RealtoSmart ERP Quotation');
            $baseurl = base_url();
            $email->setMessage('Dear ' . $user_name . ',');
            $file_path = 'assets/Quatation_Folder/' . $outputFilename . '';
            $old_qutation_pdf = $data_admin_inquiry['quatation'];
            if ($old_qutation_pdf != '') {
               $new_pdf_q = $old_qutation_pdf . ',' . $outputFilename;
            } else {
               $new_pdf_q = $outputFilename;
            }
            $update_data['quatation'] = $new_pdf_q;
            $departmentUpdatedata = $this->MasterInformationModel->update_entry2($_POST['edit_id'], $update_data, "admin_all_inquiry");
            $email->attach($file_path);
            if ($email->send()) {
               $result['email_success'] = 'Email sent successfully!';
            } else {
               $result['email_fail'] = $email->printDebugger(['headers']);
            }
         }
      } catch (\Exception $e) {
         $result['pdf_fail'] = "Error: " . $e->getMessage();
      }
      $baseurl = base_url();
      $result['file_name'] = $baseurl . "assets/Quatation_Folder/" . $outputFilename;
      return json_encode($result);
      // echo $outputFilename;
      die();
   }
}
