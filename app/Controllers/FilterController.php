<?php



namespace App\Controllers;

use App\Models\MasterInformationModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class FilterController extends BaseController

{

    protected $db;

    public function __construct() {

		helper('custom');

        $db = db_connect();

        $this->MasterInformationModel = new MasterInformationModel($db);

        $this->username = session_username($_SESSION['username']);

        $this->admin = 0;

        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

            $this->admin = 1;

        }

    }

   

    function filter_data(){

        $full_data = $this->MasterInformationModel->display_all_records('paydone_data');
        $full_data = json_decode($full_data);
        // pre($full_data);
        foreach($full_data as $data_key => $data_value) {
            if($data_value->product_id == 1) {
                $plan = $this->MasterInformationModel->edit_entry2("admin_subscription_master", $data_value->plan_id);
                $html_pdf = $this->re_pdf_data($data_value, $plan);
                $first_data = DatabaseSecondConnection();
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $dompdf = new \Dompdf\Dompdf($options);
                $dompdf->loadHtml($html_pdf);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $dompdf->output();
                $dfkjkf = $dompdf->output();
                $outputDirectory =  '/home/rudrramc/admin.ajasys.com/assets/Bill_generate/';
                if (!is_dir($outputDirectory)) {
                    mkdir($outputDirectory, 0777, true);
                }
                file_put_contents($outputDirectory .$data_value->id . ".pdf", $dfkjkf);
                pre(file_put_contents($outputDirectory .$data_value->id . ".pdf", $dfkjkf));
                $file_name = $outputDirectory . $data_value->id . ".pdf";
            }
        }
    }


    public function re_pdf_data($paydone_data = array(), $plan = array())
    {
        if(isset($plan[0])) {

            $plan = isset($plan[0]) ? $plan[0] : $plan;
            $user_data = $this->MasterInformationModel->edit_entry("master_user", $paydone_data->master_id);
            // pre($user_data);
            $user_data = $user_data[0];
            $imageUrl = base_url() . 'assets/images/RealtoSmart Logo.png';
            $plan_price = (int)$plan->plan_price + (int)$paydone_data->user_price;
            $remainingUser =    (int)$paydone_data->user_valid- (int)$plan->user;
            $subcription_date_india = date('d/m/Y', strtotime($paydone_data->subcription_date));
            $subcription_end_india = date('d/m/Y', strtotime($paydone_data->subcription_end));
            $html = '';
            $html .= '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="description" content="">
                    <meta name="author" content="">
                    <title>Starter Template for Bootstrap</title>
                    <style type="text/css">
                        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
                        *{
                            margin: 0;
                            box-sizing: border-box;
                        }
                        body{
                            background: #fff;
                            font-family: "Roboto", sans-serif;
                            background-image: url("");
                            background-repeat: repeat-y;
                            background-size: 100%;
                        }
                        ::selection {
                            background: #f31544; color: #FFF;
                        }
                        ::moz-selection {
                            background: #f31544; color: #FFF;
                        }
                        h1{
                            font-size: 1.5em;
                            color: #222;
                        }
                        h2{
                            font-size: .9em;
                        }
                        h3{
                            font-size: 1.2em;
                            font-weight: 300;
                            line-height: 2em;
                        }
                        p{
                            font-size: .7em;
                            color: #666;
                            line-height: 1.2em;
                        }
                        .Rate h2{
                            text-align: end;
                            padding-right: 10px;
                        }
                        .tableitem p {
                            text-align: end;
                            padding-right: 10px;
                        }
                        .payment h2{
                            text-align: end;
                            padding-right: 10px;
                        }
                        #invoiceholder{
                            width:100%;
                            hieght: 100%;
                            padding-top: 50px;
                        }
                        #headerimage{
                            z-index:-1;
                            position:relative;
                            top: -50px;
                            height: 350px;
                            -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
                            -moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
                            box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
                            overflow:hidden;
                            background-attachment: fixed;
                            background-size: 1920px 80%;
                            background-position: 50% -90%;
                        }
                        #invoice{
                            background: #FFF;
                        }
                        [id*="invoice-"]{
                            border-bottom: 1px solid #EEE;
                            padding: 30px;
                        }
                        #invoice-top{
                            min-height: 120px;
                        }
                        #invoice-mid{
                            min-height: 120px;
                        }
                        #invoice-bot{
                            min-height: 250px;
                        }
                        .logo{
                            float: left;
                            height: 60px;
                            width: 60px;
                            background-size: 60px 60px;
                        }
                        .clientlogo{
                            float: left;
                            height: 60px;
                            width: 60px;
                            background-size: 60px 60px;
                            border-radius: 50px;
                        }
                        .info{
                            display: block;
                            float:left;
                            margin-left: 20px;
                        }
                        .td h2 span , .info h2 span{
                            font-size: .9em;
                            color: #666;
                            line-height: 1.2em;
                            font-weight: 400;
                        }
                        .title{
                            float: right;
                        }
                        .title p{
                            text-align: right;
                        }
                        #project{
                            margin-left: 52%;
                        }
                        table{
                            width: 100%;
                            border-collapse: collapse;
                        }
                        td{
                            padding: 5px 0 5px 15px;
                            border: 1px solid #EEE
                        }
                        .tabletitle{
                            padding: 5px;
                            background: #fff;
                        }
                        .service{
                            border: 1px solid #EEE;
                        }
                        .item{
                            width: 50%;
                        }
                        .itemtext{
                            font-size: .9em;
                        }
                        #legalcopy{
                            margin-top: 30px;
                        }
                        form{
                            float:right;
                            margin-top: 30px;
                            text-align: right;
                        }
                        .effect2{
                            position: relative;
                        }
                        .legal{
                            width:70%;
                        }
                        .term-cond-txt li {
                            font-weight:400;
                            font-size:12px;
                            color:#666;
                        }
                    </style>
                </head>
                <body>
                    <div id="invoiceholder">
                        <div id="invoice" class="effect2">
                            <div id="invoice-top">
                                <div class="info">
                                    <img src="' . $imageUrl . '" width="250" alt="logo" border="0" />
                                </div>
                                <div class="title">
                                    <h1>Invoice #1000' . $paydone_data->id . '</h1>
                                    <p>Invoice Date:  ' . date('M d,Y', strtotime($paydone_data->subcription_date)) . '</br></p>
                                </div>
                            </div>
                            <div id="invoice-mid">
                                <div>
                                    <table class="td">
                                        <td style="width: 40%; border: 0; vertical-align: baseline;">
                                            <h2 style="margin-bottom:5px;">
                                                Bill To
                                            </h2>
                                            <h2>
                                                Name :
                                                <span>' . $user_data->name . '</span>
                                            </h2>
                                            <h2>
                                                Address :
                                                <span>Shop No. 506/B C-Shapphire Business Hub, LP Savani Road, Surat.</span>
                                            </h2>
                                            <h2>
                                                GST No. :
                                                <span>24ABTFA6477D1Z6</span>
                                            </h2>
                                            <h2>
                                            PAN No. :
                                                <span>ABTFA6477D</span>
                                            </h2>
                                        </td>
                                        <td style="width: 20%; border: 0; vertical-align: baseline;"></td>
                                        <td style="width: 40%; border: 0; vertical-align: baseline;"">
                                            <h2 style="margin-bottom:5px;">Products Description : </h2>
                                            <p>RealtoSmart '. $plan->plan_name.' - Duration:'.$subcription_date_india.' To '.$subcription_end_india.'</p>
                                        </td>
                                    </table>
                                </div>
                            </div>
                            <div id="invoice-bot">
                                <div id="table">
                                    <table>
                                        <tr class="tabletitle">
                                            <td style="text-align: center;">
                                                <h2>No.</h2>
                                            </td>
                                            <td class="item" style="text-align: center;">
                                                <h2>Items & Description</h2>
                                            </td>
                                            <td style="text-align: center; padding: 0px;">
                                                <h2 style="padding: 0px; text-align: center;">HSN</h2>
                                            </td>
                                            <td style="text-align: center; padding: 0px;">
                                                <h2 style="padding: 0px; text-align: center;">Qty</h2>
                                            </td>
                                            <td class="subtotal"">
                                                <h2>Amount</h2>
                                            </td>   
                                        </tr>
                                        <tr class="service">
                                            <td class="tableitem" style="text-align: center;">
                                                <p class="itemtext" style="display: inline-block;">1.</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext" style="display: inline-block;">RealtoSmart '.$plan->plan_name.'</p>
                                            </td>
                                            <td class="tableitem" style="text-align: center; padding: 0px;>
                                                <p class="itemtext" style="color: #666;text-align: center; padding: 0px;">997331</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext">1</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.$plan->plan_price.'</p>
                                            </td>
                                        </tr>
                                        <tr class="service">
                                            <td class="tableitem" style="text-align: center;">
                                                <p class="itemtext" style="display: inline-block;">2</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext" style="display: inline-block;">Addon Staff</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext">1</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext">' . $remainingUser . '</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>' . $paydone_data->user_price . '</p>
                                            </td>
                                        </tr>
                                        <tr class="tabletitle">
                                        <td colspan="3" style="border-right:none; border-bottom: none; border-top: none;"></td>
                                            <td class="Rate">
                                                <h2 style="font-weight:400;color: #666;">SGST 9 % :   </h2>
                                            </td>
                                            <td class="payment">
                                                <h2 style="font-weight:400;color: #666;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>' . ($paydone_data->gst / 2) . '</h2>
                                            </td>
                                        </tr>
                                        <tr class="tabletitle">
                                        <td colspan="3" style="border-right:none; border-bottom: none; border-top: none;"></td>
                                            <td class="Rate">
                                                <h2 style="font-weight:400;color: #666;">CGST 9 % :</h2>
                                            </td>
                                            <td class="payment">
                                                <h2 style="font-weight:400;color: #666;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>' . ($paydone_data->gst / 2) . '</h2>
                                            </td>
                                        </tr>
                                        <tr class="tabletitle">
                                            <td colspan="3"></td>
                                            <td class="Rate">
                                                <h2>Total (Incl.Tax)</h2>
                                            </td>
                                            <td class="payment">
                                                <h2><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>' . $paydone_data->total_amount . '</h2>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="invoice-mid">
                                <div>
                                    <table class="td">
                                        <td style="width: 60%; border: 0; vertical-align: baseline;">
                                            <p style="font-weight:500; font-size:14px; color:#000; margin-bottom:5px;">Terms & Condition</p>
                                            <ol class="term-cond-txt" style="margin: 0px 15px 0px 0px; padding-left:20px;">
                                                <li>The terms may specify the user responsibilities, such as maintaining the confidentiality of login credentials, ensuring compliance with applicable laws and regulations, and using the software in a lawful and appropriate manner.
                                                </li>
                                                <li>Additional customization Services and Upgradation services will be chargeable.</li>
                                                <li>The terms should clarify the intellectual property rights related to the CRM software. It may specify that all copyrights, trademarks, and other intellectual property rights belong to the software provider.</li>
                                                <li>The subscription fees are non refundable , and the Real time Subscription fees will be applicable for the Renewals.</li>
                                            </ol>
                                        </td>
                                        <td style="width: 40%; border: 0;">
                                            <h2 style="margin-bottom: 5px;">AJASYS TECHNOLOGIES</h2>
                                            <h2 style="margin-bottom:5px;">
                                                Address :
                                                <span>
                                                FOURTH FLOOR, OFFICE NO. 406, PLATTINIUM POINT, MOTA VARACHHA, Surat, Gujarat, 394101</span>
                                            </h2>
                                            <h2 style="margin-bottom:5px;">
                                                GST No. :
                                                <span>24ACAFA9619B1ZT</span>
                                            </h2>
                                            <h2 style="margin-bottom:5px;">
                                            PAN No. :
                                                <span>ACAFA9619B</span>
                                            </h2>
                                        </td>
                                    </table>
                                </div>
                                <div id="legalcopy">
                                    <p class="legal">
                                        <strong>Thank you for your business! </strong> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>';
            return $html;
        }
    }

}

