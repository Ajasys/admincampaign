<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use DateTime;
use DateTimeZone;

class SocialPostController extends BaseController
{
    protected $db;
    public function __construct()
    {
        helper('custom');
        $db = db_connect();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $session = session();
        $this->username = session_username($session->get('username'));
        $this->admin = 0;
        if ($session->has('admin') && !empty($session->get('admin'))) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }

    public function ListSocialMediasAccounts()
    {
        $html = '';
        $SocialMediaPlatformStatus = $_POST['SocialMediaPlatformStatus'];
        if ($SocialMediaPlatformStatus == '2') {
            $html .= '
                <div class="main-selectpicker">
                    <select id="" name="" class="selectpicker form-control SelectionMenuSecondClass form-main  main-control ">
                        <option class="dropdown-item" id = "">Select</option>';
            $inputString = $_SESSION['username'];
            $parts = explode("_", $inputString);
            $username = $parts[0];
            $Database = \Config\Database::connect('second');
            $sql2 = 'SELECT * FROM `' . $username . '_platform_assets` WHERE platform_status = "2" AND verification_status = "1"';
            $Getresult = $Database->query($sql2);
            $predataarray = $Getresult->getResultArray();
            if(isset($predataarray) && !empty($predataarray)){
                foreach ($predataarray as $key => $value) {
                    $html .= '<option class="dropdown-item" id = "'.$value['id'].'">'.$value['fb_app_name'].'</option>';
                }
            }
            $html .= '
                    </select>
                </div>';
        }elseif($SocialMediaPlatformStatus == 'instagram'){
            $html .= '
            <div class="main-selectpicker">
                <select id="" name="" class="selectpicker form-control SelectionMenuSecondClass form-main  main-control ">
                    <option class="dropdown-item" id = "">Select</option>';
                $inputString = $_SESSION['username'];
                $parts = explode("_", $inputString);
                $username = $parts[0];
                $Database = \Config\Database::connect('second');
                $sql2 = 'SELECT * FROM `' . $username . '_platform_assets` WHERE platform_status = "2" AND verification_status = "1"';
                $Getresult = $Database->query($sql2);
                $predataarray = $Getresult->getResultArray();
                if(isset($predataarray) && !empty($predataarray)){
                    foreach ($predataarray as $key => $value) {
                        $html .= '<option class="dropdown-item" id = "'.$value['id'].'">'.$value['fb_app_name'].'</option>';
                    }
                }
                $html .= '
                </select>
            </div>';
        }

        echo $html;

    }

    public function ListSocialMediasSubAccounts(){
        // pre($_POST); 
        $SocialMediaPlatformStatus = $_POST['SocialMediaPlatformStatus'];
        $SelectionMenuSecondClass = $_POST['SelectionMenuSecondClass'];
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $Database = \Config\Database::connect('second');
        $html = '';
        if($SocialMediaPlatformStatus == '2' && $SelectionMenuSecondClass != ""){
            $sql2 = 'SELECT * FROM `' . $username . '_platform_assets` WHERE id = "'.$SelectionMenuSecondClass.'" ';
            $Getresult = $Database->query($sql2);
            $predataarray = $Getresult->getResultArray();
            $html .= '
                <div class="main-selectpicker">
                    <select id="" name="" class="selectpicker form-control form-main ThirdDropDownListForAccounts main-control "> <option class="dropdown-item" data-access_token = "" value = "">Select</option>';
                if(isset($predataarray) && !empty($predataarray)){
                    $fb_page_list = fb_insta_page_list($predataarray[0]['access_token']);
                    $fb_page_list = get_object_vars(json_decode($fb_page_list));
                    $i = 0;
                    foreach ($fb_page_list['page_list'] as $key => $value) {
                        $pageprofile = fb_page_img($value->id, $value->access_token);
                        $img_decode = json_decode($pageprofile, true);
                        $imgdetails = $img_decode['page_img'];
                        $ProfileName = $value->name;
                        $page_access_token = $value->access_token;
                        $page_id = $value->id;
                        if(isset($value->instagram_business_account)){
                        }else{
                            $html .= '<option value="' . $page_id . '" DataIMG = "'.$imgdetails.'" posttype = "'.$SocialMediaPlatformStatus.'" name="'.$ProfileName.'" id = "'.$page_id.'" access_token = "'.$page_access_token.'" data-access_token="' . $page_access_token . '" class="dropdown-item">
                            ' . $ProfileName . '</option>';
                        }
                    }
                }
            $html .= '
                    </select>
                </div>';
        }else if($SocialMediaPlatformStatus == 'instagram'){
            $sql2 = 'SELECT * FROM `' . $username . '_platform_assets` WHERE id = "'.$SelectionMenuSecondClass.'" ';
            $Getresult = $Database->query($sql2);
            $predataarray = $Getresult->getResultArray();
            $html .= '
                <div class="main-selectpicker">
                    <select id="" name="" class="selectpicker form-control form-main ThirdDropDownListForAccounts main-control "><option class="dropdown-item" data-access_token = "" posttype= "" access_token = "" DataIMG = "" name="" id = "" value = "">Select</option>';
                if(isset($predataarray) && !empty($predataarray)){
                    $fb_page_list = fb_insta_page_list($predataarray[0]['access_token']);
                    $fb_page_list = get_object_vars(json_decode($fb_page_list));
                    $i = 0;
                    foreach ($fb_page_list['page_list'] as $key => $value) {
                        $pageprofile = fb_page_img($value->id, $value->access_token);
                        $img_decode = json_decode($pageprofile, true);
                        $imgdetails = $img_decode['page_img'];
                        $ProfileName = $value->name;
                        $page_access_token = $value->access_token;
                        $page_id = $value->id;
                        if(isset($value->instagram_business_account)){
                            $html .= '<option value="' . $page_id . '" posttype = "'.$SocialMediaPlatformStatus.'"  DataIMG = "'.$imgdetails.'" name="'.$ProfileName.'" id = "'.$page_id.'" access_token = "'.$page_access_token.'"   data-access_token="' . $page_access_token . '" class="dropdown-item">
                            ' . $ProfileName . '</option>';
                        }
                    }
                }
            $html .= '
                    </select>
                </div>';
        }
        echo $html;   
    }

    public function SetPostDataAccountList(){
    
        





        $htmlfb = '';
        $htmlinsta = '';

        
        $htmlfb .= '<div class="accordion-body">
        <div class="col-12   bg-white  d-flex flex-wrap flex-column justify-content-between">';

        $htmlinsta .= '<div class="accordion-body">
        <div class="col-12   bg-white  d-flex flex-wrap flex-column justify-content-between">';
        // pre($_POST);
        $inputString = $_SESSION['username'];
        $parts = explode("_", $inputString);
        $username = $parts[0];
        $id = $_POST['id'];
        $Database = \Config\Database::connect('second');
        $sql2 = 'SELECT * FROM `' . $username . '_platform_assets` WHERE  id = "'.$id.'"';
        $Getresult = $Database->query($sql2);
        $predataarray = $Getresult->getResultArray();
        if(isset($predataarray[0]['id'])){
            $access_token = $predataarray[0]['access_token'];
            $fb_page_list = fb_insta_page_list($access_token);
            $fb_page_list = get_object_vars(json_decode($fb_page_list));
            foreach ($fb_page_list['page_list'] as $key => $value) {
                $pro_img = '';
                $pageprofile = fb_page_img($value->id, $value->access_token);
                $img_decode = json_decode($pageprofile, true);
                $pro_img = $img_decode['page_img'];
                if(isset($value->instagram_business_account)){
                    
                    $htmlinsta .= '
                        <div class="col-12 d-flex flex-wrap  align-items-start cursor-pointer">
                            <div class="col-12 account-box d-flex flex-wrap align-items-center my-1 p-2 border rounded-3 d-flex app_card_post" data-acess_token="'.$value->access_token.'" data-pagee_id="'.$value->id.'" data-page_name="'.$value->name.'" data-img="'.$pro_img.'">
                                <img class="rounded-circle me-2" src="'.$pro_img.'" alt="#" style="width:30px;height:30px;object-fit-container">
                                <div class="col">
                                '.$value->name.'                                                                        
                                </div>
                            </div>
                        </div>
                    ';
                }else{
                    $htmlfb .= '
                        <div class="col-12 d-flex flex-wrap  align-items-start cursor-pointer">
                            <div class="col-12 account-box d-flex flex-wrap align-items-center my-1 p-2 border rounded-3 d-flex app_card_post" data-acess_token="'.$value->access_token.'" data-pagee_id="'.$value->id.'" data-page_name="'.$value->name.'" data-img="'.$pro_img.'">
                                <img class="rounded-circle me-2" src="'.$pro_img.'" alt="#" style="width:30px;height:30px;object-fit-container">
                                <div class="col">
                                '.$value->name.'                                                                        
                                </div>
                            </div>
                        </div>
                    ';
                }

            }
        }
        $htmlfb .= '    </div>
        </div>';

        $htmlinsta .= '    </div>
        </div>';

        $rdata['htmlfb'] = $htmlfb;
        $rdata['htmlinsta'] = $htmlinsta;
        return json_encode($rdata, true);

    }
}

