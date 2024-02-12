<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use DateTime;
use DateTimeZone;

class CreateController extends BaseController
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

    public function SendPostDataFB()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the message and attachment from the form data
            $event_address = $_POST['event_address'];
            $attachment = $_FILES['attachment'];

            // Construct the URL for the Facebook Graph API endpoint
            $page_id = '196821650189891';
            $access_token = 'EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';

            // Initialize cURL session
            $curl = curl_init();

            // Set the file as multipart/form-data
            $file_data = array(
                'attachment' => curl_file_create($attachment['tmp_name'], $attachment['type'], $attachment['name'])
            );

            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v19.0/' . $page_id . '/photos',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array_merge($file_data, array(
                    'access_token' => $access_token,
                    'caption' => $event_address // Message to be posted
                )),
            ));

            // Execute the POST request
            $response = curl_exec($curl);

            // Check for errors
            if ($response === false) {
                // Handle cURL error
                $error = curl_error($curl);
                echo "cURL Error: " . $error;
            } else {
                // Post successful
                echo "Post sent successfully.";
            }

            // Close cURL session
            curl_close($curl);
        } else {
            // Handle non-POST requests
            // You might want to return an error response or handle it according to your application's logic
        }
    }

    public function list_post_pagewise()
    {

        if (isset($_POST['access_tocken'])) {
            $accesss_tocken = $_POST['access_tocken'];
        } else {
            $accesss_tocken = "";
        }
        if (isset($_POST['pagee_id'])) {
            $pagee_idd = $_POST['pagee_id'];
        } else {
            $pagee_idd = "";
        }
        if (isset($_POST['page_name'])) {
            $page_namee = $_POST['page_name'];
        } else {
            $page_namee = "";
        }
        if (isset($_POST['data_img'])) {
            $data_img = $_POST['data_img'];
        } else {
            $data_img = "";
        }
        // pre('https://graph.facebook.com/v19.0/'.$pagee_idd.'/feed?access_token='.$accesss_tocken.'&fields=admin_creator%2Cmessage%2Cfull_picture%2Ccreated_time');
        // die;
        pre('https://graph.facebook.com/v19.0/' . $pagee_idd . '/feed?access_token=' . $accesss_tocken . '&fields=admin_creator%2Cmessage%2Cfull_picture%2Ccreated_time');
        die;
        
        $response = getSocialData('https://graph.facebook.com/v19.0/' . $pagee_idd . '/feed?access_token=' . $accesss_tocken . '&fields=admin_creator%2Cmessage%2Cfull_picture%2Ccreated_time');
        // pre($response);

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://graph.facebook.com/v19.0/196821650189891/feed?access_token=EAADNF4vVgk0BO8PzWEgke2AElvmkVwnN4AS5O55B9UnOjGk6iIZAmgbtjqWkM4ZB4mrqjmyjWnijAAGoccVk3xkwu9FC9jqHgFxc0SqO1ILuk7YCIrAU660mrX9Pu3fWj7o8fMa5HuGRPZCfNym8ScxR8ZAXdLBzA6ZBJpoGInPfela3vRjGs8gLsKaZCMqDZCvNbZCCjq0ZD&fields=admin_creator%2Cmessage%2Cfull_picture%2Ccreated_time',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'Cookie: ps_l=0; ps_n=0; sb=FbnFZTqFrR9iliVS0omTj1D5'
        //     ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        $fb_page_list = $response;
        $html = "";
        $comments_html = "";
        // $comments_responce = getSocialData('https://graph.facebook.com/196821650189891_122116834772192565/comments?fields=from,message&access_token='.$accesss_tocken);

        foreach ($fb_page_list['data'] as $key => $value) {
            // pre($value);
            $comments_responce = getSocialData('https://graph.facebook.com/' . $value['id'] . '/comments??fields=from,message&access_token=' . $accesss_tocken);
            if (isset($value['full_picture'])) {
                $fb_upload_img = ($value['full_picture']);
            } else {
                $fb_upload_img =  "";
            }
            if (isset($value->message)) {
                $fb_titile = ($value->message);
            } else {
                $fb_titile =  "";
            }

            $timestamp = $value['created_time'];
            $date = new DateTime($timestamp, new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
            $facebook_upload_time = $date->format('Y-m-d h:i:s A');
            $timestamp = strtotime($value['created_time']);
            $current_time = time();
            $time_diff = $current_time - $timestamp;

            if ($time_diff < 60) {
                $facebook_upload_time = "Just now";
            } elseif ($time_diff < 3600) {
                $minutes = floor($time_diff / 60);
                $facebook_upload_time = "$minutes minute" . ($minutes == 1 ? '' : 's') . " ago";
            } elseif ($time_diff < 86400) {
                $hours = floor($time_diff / 3600);
                $facebook_upload_time = "$hours hour" . ($hours == 1 ? '' : 's') . " ago";
            } elseif ($time_diff < 604800) {
                $days = floor($time_diff / 86400);
                $facebook_upload_time = "$days day" . ($days == 1 ? '' : 's') . " ago";
            } else {
                $date = new DateTime('@' . $timestamp, new DateTimeZone('UTC'));
                $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
                $facebook_upload_time = $date->format('F d \a\t h:i A');
            }


            $html .= '<div class="card-header mb-2 col-3 border rounded-4 bg-white p-3 shadow mx-2">
            <div class="col-12 d-flex flex-wrap border-bottom ">
                <div class="me-2">
                    <img class="rounded-circle"
                        src="' . $data_img . '"
                        alt="#" style="width:40px;height:40px;object-fit-container">
                </div>
                <div class="col">
                    <h5>' . $page_namee . '</h5>
                    <div class="col-12">
                        <span class="text-muted">
                            <span class="fs-14">' . $facebook_upload_time . '</span>
                        </span>
                        <span>
                            <i class="fa-solid fa-earth-asia fs-14 fw-muted"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 my-2">
                <p class="fs-14">' . $fb_titile . '</p>
            </div>
            <div class="col-12">
                <div style="width:100%;">
                    <img src="' . $fb_upload_img . '" alt="#" class="w-100 h-100 rounded-3">
                </div>
            </div>
            <hr>
            <div class="col-12 d-flex p-1 mt-2">
                <div class="col-6 d-flex flex-wrap rounded-3 text-muted ">
                    <button class="btn w-100"><i class="fa-regular fa-thumbs-up mx-2"></i>Like</button>
                </div>
                <div class="col-6 d-flex flex-wrap rounded-3">
                    <button class="btn w-100 text-muted d-flex p-0" data-bs-toggle="modal" data-bs-target="#comment-modal" id="post_commnet_modal"><i class="fa-regular fa-comment mx-2 my-auto"></i><div class="my-auto"> Comment</div></button>
                </div>
            </div>
        </div>';
            foreach ($comments_responce['data'] as $key => $comment_value) {
                $timestamp_comment = $comment_value['created_time'];
                $date_comment = new DateTime($timestamp_comment, new DateTimeZone('UTC'));
                $date_comment->setTimezone(new DateTimeZone('Asia/Kolkata'));
                $facebook_comment_time = $date_comment->format('Y-m-d h:i:s A');
                $timestamp_comment = strtotime($comment_value['created_time']);
                $current_time = time();
                $time_diff_comment = $current_time - $timestamp_comment;

                if ($time_diff_comment < 60) {
                    $facebook_comment_time = "Just now";
                } elseif ($time_diff_comment < 3600) {
                    $minutes = floor($time_diff_comment / 60);
                    $facebook_comment_time = "$minutes minute" . ($minutes == 1 ? '' : 's') . " ago";
                } elseif ($time_diff_comment < 86400) {
                    $hours = floor($time_diff_comment / 3600);
                    $facebook_comment_time = "$hours hour" . ($hours == 1 ? '' : 's') . " ago";
                } elseif ($time_diff_comment < 604800) {
                    $days = floor($time_diff_comment / 86400);
                    $facebook_comment_time = "$days day" . ($days == 1 ? '' : 's') . " ago";
                } else {
                    $date_comment = new DateTime('@' . $timestamp_comment, new DateTimeZone('UTC'));
                    $date_comment->setTimezone(new DateTimeZone('Asia/Kolkata'));
                    $facebook_comment_time = $date_comment->format('F d \a\t h:i A');
                }
                // pre($comment_value);
                $access_token='EAADNF4vVgk0BOZBn1W1arQv6ZCHt2bW6CjIRMW6I6QKMtDD6AUwisR0q8QNvbMFCUI1GBwJoWWklhol2CZCDgbPkTdjH7LT8qtEaUTADn4SZBzvbkg9m8cZBTcNLvc0ZABZBDRvSmRNqtns26nd2yyZAmsGpnmgcJZA7SV2UpWZCWQ252xk6RDMQJtwuLdbEQxaYhSMTbeW7EZD';
                
                // replay to comment 
                // $comment_id = '122116834772192565_359791573621931';
                // $reply_message = 'how are you.';
                // $url = "https://graph.facebook.com/v13.0/{$comment_id}/comments";
                // $data = array(
                //     'message' => $reply_message,
                //     'access_token' => $access_token
                // );
                // $ch = curl_init($url);
                // curl_setopt($ch, CURLOPT_POST, 1);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // $response = curl_exec($ch);
                // curl_close($ch);
                // if ($response !== false) {
                //     $response_data = json_decode($response, true);
                //     if (isset($response_data['id'])) {
                //         $answer =  "Reply posted successfully.";
                //     } else {
                //         $answer =  "Failed to post reply: " . $response;
                //     }
                // } else {
                //     echo "Failed to make request.";
                // }
                // end replay comment 
                // $post_id = '196821650189891_122116834772192565';

                // // $url = "https://graph.facebook.com/v12.0/{$post_id}/comments?fields=from,message&access_token={$access_token}";


                // $url = "https://graph.facebook.com/v12.0/$post_id/comments?fields=from{name}&access_token=$access_token";
                // // Send a GET request to the Graph API
                // $response = file_get_contents($url);

                // $data = json_decode($response, true);
                // // Check if the request was successful
                // if (isset($data['data'])) {
                //     $comments = $data['data'];
                //     foreach ($comments as $comment) {
                //         // Check if the 'from' key exists
                //         if (isset($comment['from'])) {
                //             // Extract user name and comment message
                //             $user_name = $comment['from']['name'];
                //             $message = $comment['message'];
                //             echo "User: $user_name, Comment: $message" . PHP_EOL;
                //         }
                //     }
                // } else {
                //     echo "Error fetching comments: " . $data['error']['message'] . PHP_EOL;
                // }

                $comments_html .= '<div class="d-flex">
                <div class="col-12 d-flex flex-wrap  my-1 p-2 border rounded-3 d-flex">
                    <div>
                        <img class="rounded-circle me-2"
                            src="https://scontent.famd15-2.fna.fbcdn.net/v/t39.30808-1/420455313_122097378152192565_8221030983682159636_n.jpg?stp=c0.0.50.50a_cp0_dst-jpg_p50x50&amp;_nc_cat=105&amp;ccb=1-7&amp;_nc_sid=4da83f&amp;_nc_ohc=9qjkhS9gmdUAX-2J9y7&amp;_nc_oc=AQky_tG-iOP3AdkBy_o83i2Tvjg_ZDX9zQZMqzlphf-YR-RgBPwqmtoOKuvTx333A6A-JJgTtVCMgUkU5ifXr1Hj&amp;_nc_ht=scontent.famd15-2.fna&amp;edm=AOf6bZoEAAAA&amp;oh=00_AfCo_kgqoIaCT6fQk2AqiNCtydAZFeqWYfMuAZkX91nyvg&amp;oe=65CE56C5"
                            alt="#" style="width:30px;height:30px;object-fit-container">
                    </div>
                    <div class="col replay-parent">
                        <h6> Realtosmart</h6>
                        <p class="fs-12">' . $comment_value['message'] . '</p>
                        <div class="col-12 d-flex align-content-center flex-wrap my-2">
                            <div class="d-flex flex-wrap fs-12 align-items-center" style="cursor:pointer;"><span class="mx-1 text-muted">' . $facebook_comment_time . '</span><span class="mx-2 text-muted">Like</span></div>
                            <div class="col d-flex flex-wrap"><span class="mx-2 text-muted fs-12 Replay_btn fdsfgdfg"  style="cursor:pointer;">Replay</span></div>
                        </div>
                        <div class="border p-2 bg-dark-subtle rounded-3 comment_box d-none">
                        <div class="d-flex justify-content-between">
                            <div class="col">
                                <input type="text" value="" id="input_comment" class="bg-dark-subtle comment_input p-2 w-100 border-0 " placeholder="Example input placeholder">
                            </div>
                            <div>
                                <button type="button" class="comment_btn_close btn-close justify-content-end "></button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>

                            </div>
                            <div>
                                <button class="btn btn-link comment-send-btn comment_send" data-post_id =' . $comment_value['id'] . '><i class="bi bi-send" style="color: blue;"></i></button>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
            </div>';
            }
        }
        $return_array['html'] = $html;
        $return_array['comments_html'] = $comments_html;

        echo json_encode($return_array, true);
        die();
    }
  
    public function comment_replay_send()
    {
        if (isset($_POST['data_post_id'])) {
            $comment_id = ($_POST['data_post_id']);
        } else {
            $comment_id =  "";
        }
		$result = array();

        if (isset($_POST['input_comment'])) {
            $input_comment = ($_POST['input_comment']);
        } else {
            $input_comment =  "";
        }
        $access_token='EAADNF4vVgk0BOZBn1W1arQv6ZCHt2bW6CjIRMW6I6QKMtDD6AUwisR0q8QNvbMFCUI1GBwJoWWklhol2CZCDgbPkTdjH7LT8qtEaUTADn4SZBzvbkg9m8cZBTcNLvc0ZABZBDRvSmRNqtns26nd2yyZAmsGpnmgcJZA7SV2UpWZCWQ252xk6RDMQJtwuLdbEQxaYhSMTbeW7EZD';
        //  $comment_id = '122116834772192565_934718831708235';
                $reply_message = $input_comment;
                $url = "https://graph.facebook.com/v13.0/{$comment_id}/comments";
                $data = array(
                    'message' => $reply_message,
                    'access_token' => $access_token
                );
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                if ($response !== false) {
                    $response_data = json_decode($response, true);
                    if (isset($response_data['id'])) {
                        $result['response'] = 1;
						$result['message'] = 'inquiry added succesfully !';
                    } else {
                        $answer =  "Failed to post reply: " . $response;
                    }
                } else {
                    echo "Failed to make request.";
                }
 
        
                return json_encode($result, true);
                die();

    }

    // public function SendPostDataFB(){
    //     // pre('Dishant');
    //     $url = 'https://graph.facebook.com/v19.0/196821650189891/photos/?access_token=EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';
    //     $json = '{



    //     }';
    //     $res = postSocialData($url, $json);
    //     // pre($res);
    // }


    public function create_insert_data()
    {
        $session = session();

        $post_data = $this->request->getPost();
        $table_name = $post_data["table"];
        $action_name = $post_data["action"];

        if ($action_name == "create_insert") {
            unset($post_data['action']);
            unset($post_data['table']);

            if (!empty($post_data)) {
                $insert_data = $post_data;
                $isduplicate = $this->duplicate_data($insert_data, $table_name);

                if ($isduplicate == 0) {
                    $response = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
                    $insert_displaydata = $this->MasterInformationModel->display_all_records2($table_name);
                    $insert_displaydata = json_decode($insert_displaydata, true);
                    return 0;
                } else {
                    return 1;
                }
            }
        }
    }

    public function duplicate_data($data, $table_name)
    {
        // Your duplicate data checking logic here
    }
}
