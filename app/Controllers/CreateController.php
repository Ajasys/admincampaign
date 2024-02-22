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
        $edit = $_POST['action'];
        // Check if the request method is POST  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $page_id = '196821650189891';
            $access_token = 'EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';
            $event_address = $_POST['event_address'];
            $attachments = $_FILES['attachment'];
            // Initialize cURL session
            $curl = curl_init();
            $curll = curl_init();
            // $videoFilePath = FCPATH . 'assets/video/test.mp4';
            // $url = 'https://rupload.facebook.com/video-upload/v19.0/1137914687106817';


            // // Set the data to be sent
            // $data = array(
            //     'access_token' => $access_token,
            //     'media_type' => 'VIDEO',
            //     'media_url' => $videoFilePath,
            //     'caption' => $event_address
            // );

            // // Initialize cURL
            // $ch = curl_init($url);

            // // Set cURL options
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            // // Execute the request
            // $response = curl_exec($ch);
            // pre($response);
            // die();
            // // Close cURL session
            // curl_close($ch);

            // // Decode the response
            // $response_data = json_decode($response, true);

            // // Check for errors
            // if (isset($response_data['error'])) {
            //     echo 'Error: ' . $response_data['error']['message'];
            // } else {
            //     echo 'Reel published successfully!';
            // }
            //end
            // $videoFilePath = FCPATH . 'assets/video/test.mp4';// Adjust the file path as needed
            // foreach ($attachments['tmp_name'] as $index => $tmp_name) {
            //     // Set the file as multipart/form-data
            //     $attachments_data["attachment"] = curl_file_create($tmp_name, $attachments['type'][$index], $attachments['name'][$index]);
            // }

            // // Define endpoint URL
            // $endpointUrl = 'https://graph.facebook.com/' . $page_id . '/videos';

            // // Initialize cURL session
            // $ch = curl_init();

            // // Set cURL options
            // curl_setopt($ch, CURLOPT_URL, $endpointUrl);
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, array_merge($attachments_data, array(
            //     'access_token' => $access_token,
            //     'caption' => $event_address // Message to be posted
            // )));

            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



            // // Execute cURL session
            // $response = curl_exec($ch);

            // // Close cURL session
            // curl_close($ch);

            // // Check if upload was successful
            // if ($response === false) {
            //     echo 'Error uploading video: ' . curl_error($ch);
            // } else {
            //     // Decode the JSON response
            //     $responseData = json_decode($response, true);

            //     // Check if there's an error in the response
            //     if (isset($responseData['error'])) {
            //         echo 'Error uploading video: ' . $responseData['error']['message'];
            //     } else {
            //         // Video uploaded successfully
            //         echo 'Video uploaded successfully! Video ID: ' . $responseData['id'];
            //     }
            // }

            // die();


            // Create an array to store the attachments
            $attachments_data = array();
            $feed_post_array = array();
            $attachments_data = [
                'published' => 'false'
            ];

            // Loop through each attachment
            foreach ($attachments['tmp_name'] as $index => $tmp_name) {
                // Set the file as multipart/form-data
                $attachments_data["attachment"] = curl_file_create($tmp_name, $attachments['type'][$index], $attachments['name'][$index]);
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
                    CURLOPT_POSTFIELDS => array_merge($attachments_data, array(
                        'access_token' => $access_token,
                        'caption' => $event_address // Message to be posted
                    )),
                ));

                // pre(json_encode($attachments_data));
                // Execute the POST request
                $response = curl_exec($curl);

                $data = json_decode($response);

                // $feed_post_array['attached_media[' . $index . ']'] = array('media_fbid' => $data->id);
                $feed_post_array['attached_media[' . $index . ']'] = '{"media_fbid":"' . $data->id . '"}';
            }

            $post_array = array_merge(
                array(
                    'access_token' => $access_token,
                    'massage' => $event_address
                ),
                $feed_post_array
            );

            curl_setopt_array($curll, array(
                CURLOPT_URL => 'https://graph.facebook.com/v19.0/' . $page_id . '/feed',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                CURLOPT_POSTFIELDS => http_build_query($post_array),

            ));
            $re = curl_exec($curll);
            // $re = postSocialData($api,$post_array);

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
        }
    }
    public function UpdatePostDataFB()
    {
        if (isset($_POST['edit_value']) && !empty($_POST['edit_value'])) {
            $edit_post_id = $_POST['edit_value'];
        } else {
            $edit_post_id = '';
        }

        // if(isset($_POST['data_access_id']) && !empty($_POST['data_access_id']))
        // {
        //     $accesss_tocken = $_POST['data_access_id'];
        // }else{
        //     $accesss_tocken = ''; 
        // }
        $attachments = $_FILES['attachment'];

        $access_token = "EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD";
        if (isset($_POST['event_address']) && !empty($_POST['event_address'])) {
            $message = $_POST['event_address'];
        } else {
            $message = '';
        }
        $response = postSocialData('https://graph.facebook.com/v19.0/' . $edit_post_id . '?message=' . $message . '&access_token=' . $access_token . '', '');

        // $attached_media = array();
        // foreach ($attachments['tmp_name'] as $index => $tmp_name) {
        //     // Create a cURL file object for each attachment
        //     $attachments_data["attachment"] = curl_file_create($tmp_name, $attachments['type'][$index], $attachments['name'][$index]);

        //     // Add the attachment data to the attached_media array
        //     // $attached_media = $attachment_data;
        // }

        // // Graph API endpoint for updating a post
        // $graph_api_url = "https://graph.facebook.com/v13.0/{$edit_post_id}";

        // // Encode attached_media as JSON string
        // // $attached_media_json = json_encode($attachments_data);

        // // Data to be sent in the request
        // // $data = array(
        // //     'message' => $message,
        // //     'attached_media' => $attached_media_json,
        // //     'access_token' => $access_token,
        // // );
        // $data = array_merge($attachments_data, array(
        //     'access_token' => $access_token,
        //     'caption' => $message // Message to be posted
        // ));


        // // Initialize cURL session
        // $ch = curl_init();

        // // Set cURL options
        // curl_setopt($ch, CURLOPT_URL, $graph_api_url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // Execute cURL session
        // $response = curl_exec($ch);

        // // Check for errors
        // if ($response === false) {
        //     echo 'Error: ' . curl_error($ch);
        // } else {
        //     echo 'Post updated successfully!';
        // }

        // // Close cURL session
        // curl_close($ch);
    }

    public function list_post_pagewise()
    {
        // 2024-02-17T10:00:00+0000

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


        //get comment
        $response = getSocialData('https://graph.facebook.com/v19.0/' . $pagee_idd . '/feed?access_token=' . $accesss_tocken . '&fields=admin_creator,message,full_picture,created_time,instagram_business_account');

        //multiple photo show


        $fb_page_list = $response;

        $html = "";

        foreach ($fb_page_list['data'] as $key => $value) {
            // pre($value);
            // $url = getSocialData('https://graph.facebook.com/v19.0/196821650189891_122121898676192565?fields=comments.limit(0).summary(true),likes.limit(0).summary(true)&access_token=EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD','');

            // // Decode JSON response
            // // $data = json_decode($url, true);

            // // Extract comment and like counts
            // $commentCount = $url['comments']['summary']['total_count'];
            // $likeCount = $url['likes']['summary']['total_count'];

            // Output comment and like counts
            // echo "Comment Count: " . $commentCount . "<br>";
            // echo "Like Count: " . $likeCount . "<br>";
            // die();
            // pre($test);
            // $comments_responce = getSocialData('https://graph.facebook.com/' . $value['id'] . '/comments??fields=from,message&access_token=' . $accesss_tocken);
            // $comments_responce = getSocialData('https://graph.facebook.com/v13.0/'.$value['id'].'/comments?fields=from,message,created_time&access_token=EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD');
            // pre($comments_responce);
            $accesss_tocken_comment = 'EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD';
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


            $html .= '<div class=" mb-2 col-12 col-sm-5 col-md-12 col-xl-5 col-xxl-4 " id="post_card" >
                <div class="border rounded-4 bg-white  p-3 shadow mx-2 card-header">

                
            <div class="col-12 d-flex flex-wrap border-bottom">
                <div class="me-2 cmt_modal_open" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">
                    <img class="rounded-circle" src="' . $data_img . '" alt="#" style="width:40px;height:40px;">
                </div>
                <div class="col">
                    <div class="col-12 d-flex flex-wrap justify-content-between">
                        <p class="col-10 cmt_modal_open " data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">' . $page_namee . '</p>
                        <div class="btn-group dropstart">
                            <div class="" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical cursor-pinter mx-2"></i>
                            </div>
                            <ul class="dropdown-menu bg-transparent text-end border-0">
                                <div class="d-flex flex-wrap bg-white border p-1 rounded-2">
                                <div class="col-12 d-flex justify-content-start">
                                    <button class="bg-transparent text-start ps-1 col-12 border-0 delete_post_facebook" data-delete_id="' . $value['id'] . '"><i class="fa-solid fa-trash-can me-2"></i>Delete</button>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                    <button class="bg-transparent text-start ps-1 col-12 border-0 edit_post_facebook" data-edit_id="' . $value['id'] . '" data-page_id="' . $pagee_idd . '" data-access_token="' . $accesss_tocken_comment . '" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-trash-can me-2"></i>Edit</button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                    </div>

                    <div class="col-12 cmt_modal_open" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '"  data-bs-toggle="modal" data-bs-target="#comment-modal">
                        <span class="text-muted">
                            <span class="fs-14">' . $facebook_upload_time . '</span>
                        </span>
                        <span>
                            <i class="fa-solid fa-earth-asia fs-14 fw-muted"></i>
                        </span>
                    </div>
                </div>
            </div>
<div class="col-12 cmt_modal_open" data-bs-toggle="modal" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-target="#comment-modal">
            <div class="col-12 my-2">
                <p class="fs-14">' . $fb_titile . '</p>
            </div>
            <div class="py-2 d-flex justify-content-center bg-white align-items-center overflow-hidden col-12 p-2" style="min-height: 209px; max-height: 209px; overflow: hidden;">
                    <img src="' . $fb_upload_img . '" class="" style="width:209px; height: auto; max-height:209px;object-fit:contain">
                </div>
            </div>
            <div class="col-12 p-1 mt-2 d-flex post-btn-box border-top">
                <div class="col-6 d-flex flex-wrap rounded-3 text-muted" >
                    <button class="btn w-100 like_button border-0"><i class="fa-regular fa-thumbs-up mx-2 " id="like_icon"></i><i class="fa-solid fa-thumbs-up d-none mx-2" id="like_icon_lite"></i>Like</button>
                </div>
                <div class="col-6 d-flex flex-wrap rounded-3 cmt_modal_open" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">
                    <div class="btn w-100 text-muted d-flex p-0 border-0 " data-bs-toggle="modal" data-bs-target="#comment-modal" id="post_commnet_modal"><i class="fa-regular fa-comment mx-2 my-auto"></i><div class="my-auto"> Comment</div></div>
                </div>
            </div>
        </div>
        </div>
        ';
        }
        $return_array['html'] = $html;

        echo json_encode($return_array, true);
        die();
    }
    public function comment_show()
    {

        if (isset($_POST['post_id']) && !empty($_POST['post_id'])) {
            $post_idd = $_POST['post_id'];
        } else {
            $post_idd = '';
        }
        if (isset($_POST['access_token']) && !empty($_POST['access_token'])) {
            $access_token = $_POST['access_token'];
        } else {
            $access_token = '';
        }
        // $gjfgh = getSocialData('https://graph.facebook.com/v19.0/'.$post_idd.'?fields=attachments&access_token='.$access_token.'
        // ');
        $data = getSocialData("https://graph.facebook.com/v19.0/$post_idd?fields=attachments&access_token=$access_token");
        // pre($data);
        // die();
        $comments_responce = getSocialData('https://graph.facebook.com/v13.0/' . $post_idd . '/comments?fields=from,message,created_time&access_token=' . $access_token . '');
        $comments_html = "";
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
            $access_token = 'EAADNF4vVgk0BOZBn1W1arQv6ZCHt2bW6CjIRMW6I6QKMtDD6AUwisR0q8QNvbMFCUI1GBwJoWWklhol2CZCDgbPkTdjH7LT8qtEaUTADn4SZBzvbkg9m8cZBTcNLvc0ZABZBDRvSmRNqtns26nd2yyZAmsGpnmgcJZA7SV2UpWZCWQ252xk6RDMQJtwuLdbEQxaYhSMTbeW7EZD';

            // replay to comment 
            $comment_id = '196821650189891_122116834772192565';
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
            // $fields = 'id,comments.summary(true),likes.summary(true)';

            // $url = "https://graph.facebook.com/v12.0/{$comment_id}?fields={$fields}&access_token={$access_token}";

            // $response = file_get_contents($url);
            // $data = json_decode($response, true);

            // if (!empty($data)) {
            //     $likes_count = $data['likes']['summary']['total_count'];
            //     $comments_count = $data['comments']['summary']['total_count'];
            // }
            //     $fields = 'id,comments.summary(true),likes.summary(true)';
            //     $url = "https://graph.facebook.com/v12.0/$post_id?fields=$fields&access_token=$access_token";
            //     $response = file_get_contents($url);
            //     $data = json_decode($response, true);

            // if (!empty($data)) {
            //     $likes_count = $data['likes']['summary']['total_count'];
            //     $comments_count = $data['comments']['summary']['total_count'];

            //     // Check if the owner of the access token has liked the post
            //     $liked_by_user = false;
            //     $me_likes_url = "https://graph.facebook.com/v12.0/me/likes/$post_id?access_token=$access_token";
            //     pre($me_likes_url);
            //     die();
            //     $me_likes_response = file_get_contents($me_likes_url);
            //     $me_likes_data = json_decode($me_likes_response, true);
            //     if (!empty($me_likes_data) && isset($me_likes_data['data']) && count($me_likes_data['data']) > 0) {
            //         $liked_by_user = true;
            //     }

            //     // Prepare the message based on whether the user has liked the post
            //     if ($liked_by_user) {
            //         echo "You and {$likes_count} other like this.<br>";
            //     } else {
            //         echo "{$likes_count} people like this.<br>";
            //     }

            //     echo "Comments: {$comments_count}<br>";
            // } else {
            //     echo "Unable to fetch data from Facebook API.";
            // }


            $comments_html .= '<div class="d-flex">
            <div class="col-12 d-flex flex-wrap  my-1 p-2  rounded-3 d-flex">
                <div>';
                if (isset($data['attachments']['data']) && !empty($data['attachments']['data'])) {
                    $attachments = $data['attachments']['data'];
                
                    // Check the number of attachments (images)
                    $num_images = count($attachments);
                
                    // Display the images
                    foreach ($attachments as $attachment) {
                        $image_url = $attachment['media']['image']['src'];
                        $comments_html .= '<img class="rounded-circle me-2"
                        src="'.$image_url.'"
                        alt="#" style="width:30px;height:30px;object-fit-container">';
                    }
                }
                    
                $comments_html .= '</div>
                <div class="col replay-parent">
                    <h6> ' . $comment_value['from']['name'] . '</h6>
                    <p class="fs-12">' . $comment_value['message'] . '</p>
                    <div class="col-12 d-flex align-content-center flex-wrap my-2">
                        <div class="d-flex flex-wrap fs-12 align-items-center" style="cursor:pointer;"><span class="mx-1 text-muted">' . $facebook_comment_time . '</span><span class="mx-2 text-muted">Like</span></div>
                        <div class="col d-flex flex-wrap"><span class="mx-2 text-muted fs-12 Replay_btn fdsfgdfg"  style="cursor:pointer;">Replay</span></div>
                    </div>
                    <div class="border rounded-3 comment_box d-none">
                        <div class="d-flex justify-content-between">
                            <div class="col">
                                <input type="text" value="" id="input_comment" class="comment_input p-2 w-100 border-0 " placeholder="Add comment...">
                            </div>
                            <button class="btn btn-link comment-send-btn comment_send" data-post_id =' . $comment_value['id'] . '><i class="bi bi-send text-primary" style="color: blue;"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        $return_array['comments_html'] = $comments_html;

        echo json_encode($return_array, true);
        die();
    }

    public function edit_post()
    {

        // $comments_responce = getSocialData('https://graph.facebook.com/' . $value['id'] . '/comments??fields=from,message&access_token=' . $accesss_tocken);
        if (isset($_POST['post_id'])) {
            $data_edit_id = ($_POST['post_id']);
        } else {
            $data_edit_id =  "";
        }

        if (isset($_POST['page_id'])) {
            $data_page_id = ($_POST['page_id']);
        } else {
            $data_page_id =  "";
        }
        if (isset($_POST['access_token'])) {
            $accesss_tocken = $_POST['access_token'];
        } else {
            $accesss_tocken = "";
        }
        $response = getSocialData('https://graph.facebook.com/v19.0/' . $data_edit_id . '?message=testing&access_token=EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD');
        if (isset($response['message']) && !empty($response['message'])) {
            $message_return = $response['message'];
        } else {
            $message_return = "";
        }
        // pre($response);
        // die();

        $return_array['message_return'] = $message_return;

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
        $access_token = 'EAADNF4vVgk0BOZBn1W1arQv6ZCHt2bW6CjIRMW6I6QKMtDD6AUwisR0q8QNvbMFCUI1GBwJoWWklhol2CZCDgbPkTdjH7LT8qtEaUTADn4SZBzvbkg9m8cZBTcNLvc0ZABZBDRvSmRNqtns26nd2yyZAmsGpnmgcJZA7SV2UpWZCWQ252xk6RDMQJtwuLdbEQxaYhSMTbeW7EZD';
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
                // $result['message'] = 'inquiry added succesfully !';
            } else {
                $answer =  "Failed to post reply: " . $response;
            }
        } else {
            echo "Failed to make request.";
        }





        return json_encode($result, true);
        die();
    }

    public function delete_post()
    {
        if (isset($_POST['data_delete_id']) && !empty($_POST['data_delete_id'])) {
            $delete_post_id = $_POST['data_delete_id'];
        } else {
            $delete_post_id = "";
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v19.0/' . $delete_post_id . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer EAADNF4vVgk0BO78lRPy6esK4KZCXdEuZB7ZCds7af8hZAXCDA5HyOfkghG4jZBAbvNa8T5YcYPweb3sZAaE23B8qeGJjDZBi2T1WZA1ZBA3IhTevK2MJMaZCRCgy0qAgou4EZAa7gAOuZCh6ZAVue31jqMnfTNJKdZA4kIMPAs3rgZA5azH5WXfIMJj5PBKKUZAlJXjyTZBMWRDEtoF0ZD',
                'Cookie: ps_l=0; ps_n=0'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
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
