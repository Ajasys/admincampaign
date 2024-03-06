<?php

namespace App\Controllers\Campaign;
use App\Controllers\BaseController;
use App\Models\MasterInformationModel;
use Config\Database;
use DateTime;
use DateTimeZone;

class PostCommentController extends BaseController
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
        //     $this->db = DatabaseDefaultConnection();
        //     $get_token = "SELECT * FROM admin_platform_integration WHERE platform_status = 2 AND verification_status = 1";
        //     $get_access_token_array = $this->db->query($get_token);
        //     $data_count = $get_access_token_array->getNumRows();
        //     $fb_account_data = $get_access_token_array->getResultArray()[0];
        //     $token = $fb_account_data['access_token'];
        //     // pre( $token);
        //     $asset_table_name = $this->username . '_platform_assets';
    
        //     $platform_id = $fb_account_data['id'];
        //     $master_id = $_SESSION['master'];
        //     $get_page_data = "SELECT * FROM $asset_table_name WHERE platform_id = $platform_id AND master_id = $master_id";
        //     // pre($platform_id);
        //     $get_page_data = $this->db->query($get_page_data);
        //     $get_page_data = $get_page_data->getResultArray();
            
         
// pre($get_page_data);

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
            // foreach ($get_page_data as $page_data) {
                // pre($page_data);
    
                // $data = $page_data['asset_id'];
                // $access_token = $page_data['access_token'];


            // Loop through each attachment
            foreach ($attachments['tmp_name'] as $index => $tmp_name) {
                // Set the file as multipart/form-data
                $attachments_data["attachment"] = curl_file_create($tmp_name, $attachments['type'][$index], $attachments['name'][$index]);
                // Set cURL options
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://graph.facebook.com/v19.0/' .   $page_id  . '/photos',
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
                    )
                    ),
                )
                );

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
                CURLOPT_URL => 'https://graph.facebook.com/v19.0/' .  $data . '/feed',
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

            )
            );
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
        
        $fb_page_list = $response;

        $html = "";

        foreach ($fb_page_list['data'] as $key => $value) {
            $url = 'https://graph.facebook.com/v19.0/' . $value['id'] . '?fields=attachments&access_token=' . $accesss_tocken . '';
            $data = getSocialData($url);
            // $time = strtotime($data[0]['created_time']);    
            // $accesss_tocken_comment = 'EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD';
            if (isset($value['full_picture'])) {
                $fb_upload_img = ($value['full_picture']);
            } else {
                $fb_upload_img = "";
            }
            if (isset($value->message)) {
                $fb_titile = ($value->message);
            } else {
                $fb_titile = "";
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


            $html .= '<div class=" mb-2 col-12 col-sm-12 col-md-12 col-xl-5 col-xxl-4 " id="post_card" >
                <div class="border rounded-4 bg-white  p-3 shadow mx-2 card-header">

                
            <div class="col-12 d-flex flex-wrap border-bottom">
                <div class="me-2 cmt_modal_open" data-access_token="' . $accesss_tocken . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">
                    <img class="rounded-circle" src="' . $data_img . '" alt="#" style="width:40px;height:40px;">
                </div>
                <div class="col">
                    <div class="col-12 d-flex flex-wrap justify-content-between">
                        <p class="col-10 cmt_modal_open " data-access_token="' . $accesss_tocken . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">' . $page_namee . '</p>
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
                                    <button class="bg-transparent text-start ps-1 col-12 border-0 edit_post_facebook" data-edit_id="' . $value['id'] . '" data-page_id="' . $pagee_idd . '" data-access_token="' . $accesss_tocken . '" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-trash-can me-2"></i>Edit</button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                    </div>

                    <div class="col-12 cmt_modal_open" data-access_token="' . $accesss_tocken . '" data-post_id="' . $value['id'] . '"  data-bs-toggle="modal" data-bs-target="#comment-modal">
                        <span class="text-muted">
                            <span class="fs-14">' . $facebook_upload_time . '</span>
                        </span>
                        <span>
                            <i class="fa-solid fa-earth-asia fs-14 fw-muted"></i>
                        </span>
                    </div>
                </div>
            </div>
                <div class="col-12 cmt_modal_open" data-bs-toggle="modal" data-access_token="' . $accesss_tocken . '" data-post_id="' . $value['id'] . '" data-bs-target="#comment-modal">
            <div class="col-12 my-2">
                <p class="fs-14">' . $fb_titile . '</p>
            </div>
            <div class="py-2 d-flex justify-content-center bg-white align-items-center overflow-hidden col-12 p-2" style="min-height: 209px; max-height: 209px; overflow: hidden;">';
            if (isset($data['attachments']['data']) && !empty($data['attachments']['data'])) {
                $attachments = $data['attachments']['data'];
                // Display all images
                foreach ($attachments as $attachment) {
                    // pre($attachment);
                    // Check for subattachments
                    if (isset($attachment['subattachments']['data']) && !empty($attachment['subattachments']['data'])) {
                        $subattachments = $attachment['subattachments']['data'];
                        foreach ($subattachments as $subattachment) {
                            $image_url = $subattachment['media']['image']['src'];
                            $html .= "<img src='$image_url' alt='Image' style='width:100%;height:300px;'>";
                        }
                    } else {
                        // No subattachments, display the main attachment image
                        if (isset($attachment['media']['image']['src']) && !empty($attachment['media']['image']['src'])) {
                            $image_url = $attachment['media']['image']['src'];
                            $html .= "<img src='$image_url' alt='Image' style='width:100%;height:300px;'>";
                        }
                    }
                }
            }
            $html .= '
            
            </div>
            </div>
            <div class="col-12 p-1 mt-2 border-top pt-3">
            <div class="row align-items-center justify-content-center">
                <div class=" mb-2 mb-md-0 p-0 px-1" style="width:fit-content;">
                    <button class="btn like_button d-flex p-0 border-0">
                        <i class="fa-regular fa-thumbs-up mx-1 my-auto" id="like_icon"></i>
                        <i class="fa-solid fa-thumbs-up d-none mx-1 my-auto" id="like_icon_lite"></i>
                        <div class="my-auto btn-text comment_like_count">Like</div>
                    </button>
                </div>
        
                <div class=" mb-2 mb-md-0 p-0 px-1" style="width:fit-content;">
                    <button class="btn d-flex p-0 border-0 cmt_modal_open" data-access_token="' . $accesss_tocken . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">
                        <i class="fa-regular fa-comment mx-1 my-auto"></i>
                        <div class="my-auto btn-text">Comment</div>
                    </button>
                </div>
            <div class=" mb-2 mb-md-0 p-0 px-1" style="width:fit-content;data-toggle="modal" data-target="#sharemodal" >
            <div class="btn w-100 text-muted d-flex p-0 border-0" data-toggle="modal"  data-attachment_post="' . $fb_upload_img . '" data-target="#sharemodal"  id="post_commnet_modal"><i class="fa-solid fa-share mx-2 my-auto"></i><div class="my-auto">share</div></div>
        </div>
            
            
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
        $url = 'https://graph.facebook.com/v19.0/' . $post_idd . '?fields=attachments&access_token=' . $access_token . '';

        $data = getSocialData($url);
        $comments_responce = getSocialData('https://graph.facebook.com/v13.0/' . $post_idd . '/comments?fields=from,message,created_time&access_token=' . $access_token . '');
        $like_comment_count = "";
        $comments_html = "";
        $img_show_comment = "";
        $like_comment = getSocialData('https://graph.facebook.com/v19.0/' . $post_idd . '?fields=comments.limit(0).summary(true),likes.limit(0).summary(true)&access_token=EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD', '');

        // Decode JSON response
        // $data = json_decode($url, true);

        // Extract comment and like counts
        // if(isset)
        if (isset($like_comment['comments']['summary']['total_count']) && !empty($like_comment['comments']['summary']['total_count'])) {
            $commentCount = $like_comment['comments']['summary']['total_count'];
        } else {
            $commentCount = '';
        }
        if (isset($like_comment['likes']['summary']['total_count']) && !empty($like_comment['likes']['summary']['total_count'])) {
            $likeCount = $like_comment['likes']['summary']['total_count'];
        } else {
            $likeCount = '';
        }
        $like_comment_count .=
            '<div class="col-12 d-flex justify-content-between align-items-center">
    <div class="col d-flex justify-content-start align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
            <g>
                <path fill="#2196f3" fill-rule="evenodd" d="M256 512c140.997 0 256-115.003 256-256S396.997 0 256 0 0 115.003 0 256s115.003 256 256 256z" clip-rule="evenodd" opacity="1" data-original="#2196f3" class=""></path>
                <path fill="#ffffff" d="M126.318 206.456h56.704v163.048c-1.604 7.982-8.984 13.959-17.324 13.959h-39.38c-9.549 0-17.318-7.775-17.318-17.324V223.774c0-9.548 7.769-17.318 17.318-17.318zm269.641 18.977c-8.856-11.353-24.777-18.976-39.617-18.976h-83.529a4.248 4.248 0 0 1-3.383-1.683 4.245 4.245 0 0 1-.711-3.718l10.557-37.862c10.162-36.434-3.25-46.603-34.089-59.723-2.885-1.227-5.692-1.245-8.589-.061-2.897 1.178-4.884 3.153-6.087 6.044l-38.985 93.594v164.045l39.283 16.37h104.03c30.767 0 42.284-32.674 45.807-46.718l21.509-85.649c2.782-11.085-1.834-20.075-6.196-25.663z" opacity="1" data-original="#ffffff" class=""></path>
            </g>
        </svg>
        <span class="ms-2 text-secondary-emphasis">You and ' . $likeCount . ' other </span>
    </div>
    <div class="col d-flex justify-content-end align-items-center">
        <span class="me-1 text-secondary-emphasis">' . $commentCount . '</span>
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0" y="0" viewBox="0 0 22 22" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
            <g>
                <path d="m21.08 15.4.91 5.43a1.022 1.022 0 0 1-.28.88A1.007 1.007 0 0 1 21 22a1.028 1.028 0 0 1-.17-.01l-5.43-.91A10.812 10.812 0 0 1 11 22a11 11 0 1 1 11-11 10.812 10.812 0 0 1-.92 4.4z" fill="#8b8b8b" opacity="1" data-original="#000000" class=""></path>
            </g>
        </svg>
    </div>
</div>
<div class="col-12 p-1 d-flex post-btn-box flex-wrap align-items-center border-top border-bottom">
    <span class="cursor-pointer col-6">
        <button type="button" class="btn btn-light w-100 d-flex modal-like-btn align-items-center justify-content-center fw-medium text-secondary-emphasis">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0" y="0" viewBox="0 0 478.2 478.2" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <path d="M457.575 325.1c9.8-12.5 14.5-25.9 13.9-39.7-.6-15.2-7.4-27.1-13-34.4 6.5-16.2 9-41.7-12.7-61.5-15.9-14.5-42.9-21-80.3-19.2-26.3 1.2-48.3 6.1-49.2 6.3h-.1c-5 .9-10.3 2-15.7 3.2-.4-6.4.7-22.3 12.5-58.1 14-42.6 13.2-75.2-2.6-97-16.6-22.9-43.1-24.7-50.9-24.7-7.5 0-14.4 3.1-19.3 8.8-11.1 12.9-9.8 36.7-8.4 47.7-13.2 35.4-50.2 122.2-81.5 146.3-.6.4-1.1.9-1.6 1.4-9.2 9.7-15.4 20.2-19.6 29.4-5.9-3.2-12.6-5-19.8-5h-61c-23 0-41.6 18.7-41.6 41.6v162.5c0 23 18.7 41.6 41.6 41.6h61c8.9 0 17.2-2.8 24-7.6l23.5 2.8c3.6.5 67.6 8.6 133.3 7.3 11.9.9 23.1 1.4 33.5 1.4 17.9 0 33.5-1.4 46.5-4.2 30.6-6.5 51.5-19.5 62.1-38.6 8.1-14.6 8.1-29.1 6.8-38.3 19.9-18 23.4-37.9 22.7-51.9-.4-8.1-2.2-15-4.1-20.1zm-409.3 122.2c-8.1 0-14.6-6.6-14.6-14.6V270.1c0-8.1 6.6-14.6 14.6-14.6h61c8.1 0 14.6 6.6 14.6 14.6v162.5c0 8.1-6.6 14.6-14.6 14.6h-61v.1zm383.7-133.9c-4.2 4.4-5 11.1-1.8 16.3 0 .1 4.1 7.1 4.6 16.7.7 13.1-5.6 24.7-18.8 34.6-4.7 3.6-6.6 9.8-4.6 15.4 0 .1 4.3 13.3-2.7 25.8-6.7 12-21.6 20.6-44.2 25.4-18.1 3.9-42.7 4.6-72.9 2.2h-1.4c-64.3 1.4-129.3-7-130-7.1h-.1l-10.1-1.2c.6-2.8.9-5.8.9-8.8V270.1c0-4.3-.7-8.5-1.9-12.4 1.8-6.7 6.8-21.6 18.6-34.3 44.9-35.6 88.8-155.7 90.7-160.9.8-2.1 1-4.4.6-6.7-1.7-11.2-1.1-24.9 1.3-29 5.3.1 19.6 1.6 28.2 13.5 10.2 14.1 9.8 39.3-1.2 72.7-16.8 50.9-18.2 77.7-4.9 89.5 6.6 5.9 15.4 6.2 21.8 3.9 6.1-1.4 11.9-2.6 17.4-3.5.4-.1.9-.2 1.3-.3 30.7-6.7 85.7-10.8 104.8 6.6 16.2 14.8 4.7 34.4 3.4 36.5-3.7 5.6-2.6 12.9 2.4 17.4.1.1 10.6 10 11.1 23.3.4 8.9-3.8 18-12.5 27z" fill="#6c757d" opacity="1" data-original="#6c757d" class=""></path>
                </g>
            </svg>
            <span class="ms-2 mt-1 modal-like-text">Like</span>
        </button>
    </span>
    <span class="cursor-pointer col-6">
        <button type="button" class="btn btn-light w-100 d-flex align-items-center justify-content-center fw-medium text-secondary-emphasis">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <path d="M12 1a10.984 10.984 0 0 0-9.632 16.293l-1.326 4.42A1 1 0 0 0 2 23a1.019 1.019 0 0 0 .288-.042l4.42-1.326A11 11 0 1 0 12 1zm0 20a8.966 8.966 0 0 1-4.648-1.306 1.008 1.008 0 0 0-.519-.144.973.973 0 0 0-.287.042l-3.054.917.916-3.055a1 1 0 0 0-.1-.8A8.992 8.992 0 1 1 12 21z" data-name="Layer 2" fill="#000000" opacity="1" data-original="#000000"></path>
                </g>
            </svg>
            <span class="ms-2 mt-1">Comment</span>
        </button>
    </span>
</div>';

        if(isset($comments_responce['data'])){

        
        foreach ($comments_responce['data'] as $key => $comment_value) {
            // pre($comment_value);
            // die();
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

            $comments_html .= '<div class="d-flex flex-wrap">
            <div class="col-12 d-flex flex-wrap justify-content-start my-1 p-2rounded-3 d-flex">
                <div class="me-2" style="width:max-content;">
                                            <img class="rounded-circle" src="https://scontent.famd15-2.fna.fbcdn.net/v/t39.30808-1/420455313_122097378152192565_8221030983682159636_n.jpg?stp=c0.0.50.50a_cp0_dst-jpg_p50x50&amp;_nc_cat=105&amp;ccb=1-7&amp;_nc_sid=4da83f&amp;_nc_ohc=5mIr9vvPKjoAX-zrvYj&amp;_nc_oc=AQl6mR6y2pjIoGKmOR7fdu7zLgCBmH2vprbxILHxch3EcDKIw2dNoMlXRjIbv8rITPVDcwSSDac73ClROnRdBptx&amp;_nc_ht=scontent.famd15-2.fna&amp;edm=AOf6bZoEAAAA&amp;oh=00_AfD6iLdF10SSWXxBASqUk3ZYhyyYKA-_1rv919_YAYlj3g&amp;oe=65DC2E85" alt="#" style="width:35px;height:35px;">
                                        </div>
                                        <div class="replay-parent col-10">
                                            <div class="p-2 rounded-3" style = "width:max-content;background-color:#ededed;">
                                                <span class="fw-semibold fs-12"> ' . $comment_value['from']['name'] . '</span>
                    <p class="fs-12 fw-normal">' . $comment_value['message'] . '</p>
</div>
                    <div class="col-12 d-flex align-items-center-center flex-wrap my-2">
                        <div class="d-flex flex-wrap fs-12 align-items-center" style="cursor:pointer;"><span class="mx-1 text-muted fw-normal">' . $facebook_comment_time . '</span><span class="mx-2 text-muted fw-bold like_show">Like</span></div>
                        <div class="col d-flex flex-wrap justify-content-between">
                            <span class="mx-2 text-muted fs-12 Replay_btn fdsfgdfg fw-bold"  style="cursor:pointer;">Reply</span>
                            <span class="mx-2 text-muted fs-12 Replay_btn fdsfgdfg fw-bold like_count"  style="cursor:pointer;">
                              <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 48 48" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><linearGradient id="a" x1="24" x2="24" y1="42" y2="6" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#0064e1"></stop><stop offset=".994" stop-color="#26b7ff"></stop></linearGradient><circle cx="24" cy="24" r="18" fill="url(#a)" opacity="1" data-original="url(#a)" class=""></circle><g fill="#fff"><rect width="5.781" height="11.647" x="13.219" y="22.315" rx="1.839" fill="#ffffff" opacity="1" data-original="#ffffff"></rect><path d="M35 24.556c0-.749-.332-1.411-.843-1.862.385-.388.624-.921.624-1.51a2.148 2.148 0 0 0-2.146-2.145h-3.678v-2.452c0-1.138-.316-2.085-.94-2.815a2.202 2.202 0 0 0-2.462-.629 2.27 2.27 0 0 0-1.502 2.143v3.14c0 1.694-2.41 3.276-3.34 3.743-.302.151-.49.858-.338 1.16v6.13l1.914 2.168a3.044 3.044 0 0 0 2.167.898h6.954a2.148 2.148 0 0 0 2.145-2.146c0-.166-.025-.328-.062-.487a2.138 2.138 0 0 0 .664-3.475c.511-.45.843-1.113.843-1.861z" fill="#ffffff" opacity="1" data-original="#ffffff"></path></g></g></svg>
                              <span class="mx-1"> '. $likeCount .'</span>
                                </span>
                        </div>
                    </div>
                    <div class="col-10 d-flex d-none">
                        <div class="me-2" style="width:max-content;">
                            <img class="rounded-circle" src="https://scontent.famd15-2.fna.fbcdn.net/v/t39.30808-1/420455313_122097378152192565_8221030983682159636_n.jpg?stp=c0.0.50.50a_cp0_dst-jpg_p50x50&amp;_nc_cat=105&amp;ccb=1-7&amp;_nc_sid=4da83f&amp;_nc_ohc=5mIr9vvPKjoAX-zrvYj&amp;_nc_oc=AQl6mR6y2pjIoGKmOR7fdu7zLgCBmH2vprbxILHxch3EcDKIw2dNoMlXRjIbv8rITPVDcwSSDac73ClROnRdBptx&amp;_nc_ht=scontent.famd15-2.fna&amp;edm=AOf6bZoEAAAA&amp;oh=00_AfD6iLdF10SSWXxBASqUk3ZYhyyYKA-_1rv919_YAYlj3g&amp;oe=65DC2E85" alt="#" style="width:28px;height:28px;">
                            </div>
                            <div class="replay-parent col-10">
                                                    <div class="p-2 rounded-3" style = "width:max-content;background-color:#ededed;">
                                                        <span class="fw-semibold fs-12"> ' . $comment_value['from']['name'] . '</span>
                                                        <p class="fs-12 fw-normal">' . $comment_value['message'] . '</p>
                                                    </div>
                                                    <div class="col-12 d-flex align-content-center flex-wrap my-2">
                                                        <div class="d-flex flex-wrap fs-12 align-items-center" style="cursor:pointer;"><span class="mx-1 text-muted fw-normal">' . $facebook_comment_time . '</span><span class="mx-2 text-muted fw-bold">Like</span></div>
                                                        <div class="col d-flex flex-wrap"><span class="mx-2 text-muted fs-12 Replay_btn fdsfgdfg fw-bold"  style="cursor:pointer;">Reply</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-10 comment_box d-none mt-1 mb-2 w-100">
                                                <div class="d-flex justify-content-start align-content-center w-100">
                                                <div class="me-1 mt-1" style="width:max-content;">
                                                        <img class="rounded-circle" src="https://scontent.famd15-2.fna.fbcdn.net/v/t39.30808-1/420455313_122097378152192565_8221030983682159636_n.jpg?stp=c0.0.50.50a_cp0_dst-jpg_p50x50&amp;_nc_cat=105&amp;ccb=1-7&amp;_nc_sid=4da83f&amp;_nc_ohc=5mIr9vvPKjoAX-zrvYj&amp;_nc_oc=AQl6mR6y2pjIoGKmOR7fdu7zLgCBmH2vprbxILHxch3EcDKIw2dNoMlXRjIbv8rITPVDcwSSDac73ClROnRdBptx&amp;_nc_ht=scontent.famd15-2.fna&amp;edm=AOf6bZoEAAAA&amp;oh=00_AfD6iLdF10SSWXxBASqUk3ZYhyyYKA-_1rv919_YAYlj3g&amp;oe=65DC2E85" alt="#" style="width:28px;height:28px;">
                                                    </div>
                                                    <div class="border rounded-3 input-group-sm col-11 d-flex" style = "background-color:#ededed;">
                                                        <input style = "background-color:#ededed;" type="text" value="" id="input_comment" class="comment_input form-control-sm p-2 w-100 border-0 " placeholder="Add comment...">
                                                        <button class="btn btn-sm btn-link comment-send-btn comment_send d-flex align-items-center" data-post_id =' . $comment_value['id'] . '>
                                                        <div class="spinner-border text-primary mx-2 comment_loader" style=" width: 20px; height: 20px;" role="status">
                                                        <span class="visually-hidden" >Loading...</span>
                                                        </div><i class="bi bi-send text-primary send_comment" data-bs-dismiss="modal" style="color: blue;"></i></button>
                        </div>
                                                   
                                                    
                        </div>
                    </div>
</div>
                                        </div>

                                    </div>
                                    <div class="d-flex col-12 justify-content-start align-content-center">
                                        
            </div>
        </div>';
        }
    }

        if (isset($data['attachments']['data']) && !empty($data['attachments']['data'])) {
            $attachments = $data['attachments']['data'];

            // Display all images
            foreach ($attachments as $attachment) {
                // Check for subattachments
                if (isset($attachment['subattachments']['data']) && !empty($attachment['subattachments']['data'])) {
                    $subattachments = $attachment['subattachments']['data'];

                    foreach ($subattachments as $subattachment) {
                        $image_url = $subattachment['media']['image']['src'];
                        $img_show_comment .= "<div class='swiper-slide'><div class='slide'><img src='$image_url' class='img_clear' alt='Image' style='width:100%;height:300px;'></div></div>";
                    }
                } else {
                    // No subattachments, display the main attachment image
                    $image_url = $attachment['media']['image']['src'];
                    $img_show_comment .= "<div class='swiper-slide'><div class='slide'><img src='$image_url' alt='Image' class='img_clear' style='width:100%;height:300px;'></div></div>";
                }
            }
        }

        $return_array['comments_html'] = $comments_html;
        $return_array['img_show_comment'] = $img_show_comment;
        $return_array['like_comment_count'] = $like_comment_count;


        echo json_encode($return_array, true);
        die();
    }

    public function edit_post()
    {

        // $comments_responce = getSocialData('https://graph.facebook.com/' . $value['id'] . '/comments??fields=from,message&access_token=' . $accesss_tocken);
        if (isset($_POST['post_id'])) {
            $data_edit_id = ($_POST['post_id']);
        } else {
            $data_edit_id = "";
        }

        if (isset($_POST['page_id'])) {
            $data_page_id = ($_POST['page_id']);
        } else {
            $data_page_id = "";
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
    // public function comment_replay_send()
    // {
    //     if (isset($_POST['data_post_id'])) {
    //         $comment_id = ($_POST['data_post_id']);
    //     } else {
    //         $comment_id =  "";
    //     }
    //     $result = array();

    //     if (isset($_POST['input_comment'])) {
    //         $input_comment = ($_POST['input_comment']);
    //     } else {
    //         $input_comment =  "";
    //     }
    //     $access_token = 'EAADNF4vVgk0BOZBn1W1arQv6ZCHt2bW6CjIRMW6I6QKMtDD6AUwisR0q8QNvbMFCUI1GBwJoWWklhol2CZCDgbPkTdjH7LT8qtEaUTADn4SZBzvbkg9m8cZBTcNLvc0ZABZBDRvSmRNqtns26nd2yyZAmsGpnmgcJZA7SV2UpWZCWQ252xk6RDMQJtwuLdbEQxaYhSMTbeW7EZD';
    //     //  $comment_id = '122116834772192565_934718831708235';
    //     $reply_message = $input_comment;
    //     $url = "https://graph.facebook.com/v13.0/{$comment_id}/comments";
    //     $data = array(
    //         'message' => $reply_message,
    //         'access_token' => $access_token
    //     );
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     if ($response !== false) {
    //         $response_data = json_decode($response, true);
    //         if (isset($response_data['id'])) {
    //             $result['response'] = 1;
    //             // $result['message'] = 'inquiry added succesfully !';
    //         } else {
    //             $answer =  "Failed to post reply: " . $response;
    //         }
    //     } else {
    //         echo "Failed to make request.";
    //     }





    //     return json_encode($result, true);
    //     die();
    // }

    public function comment_replay_send()
    {
        // Initialize an empty response array
        $result = array();

        // Check if data_post_id and input_comment are set in the POST request
        if (isset($_POST['data_post_id'], $_POST['input_comment'])) {
            $comment_id = $_POST['data_post_id'];
            $input_comment = $_POST['input_comment'];

            // Access token for posting comments
            $access_token = 'EAADNF4vVgk0BOZBn1W1arQv6ZCHt2bW6CjIRMW6I6QKMtDD6AUwisR0q8QNvbMFCUI1GBwJoWWklhol2CZCDgbPkTdjH7LT8qtEaUTADn4SZBzvbkg9m8cZBTcNLvc0ZABZBDRvSmRNqtns26nd2yyZAmsGpnmgcJZA7SV2UpWZCWQ252xk6RDMQJtwuLdbEQxaYhSMTbeW7EZD';
            // URL for posting the comment reply
            $url = "https://graph.facebook.com/v13.0/{$comment_id}/comments";

            // Data to be sent in the POST request
            $data = array(
                'message' => $input_comment,
                'access_token' => $access_token
            );

            // Initialize cURL session
            $ch = curl_init($url);

            // Set cURL options
            curl_setopt_array($ch, array(
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_RETURNTRANSFER => true
            )
            );

            // Execute the POST request
            $response = curl_exec($ch);

            // Check for errors
            if ($response !== false) {
                $response_data = json_decode($response, true);
                if (isset($response_data['id'])) {
                    // If the comment was posted successfully
                    $result['response'] = 1;
                } else {
                    // If there was an error posting the comment
                    $result['response'] = 0;
                    $result['error'] = "Failed to post reply: " . $response;
                }
            } else {
                // If cURL request failed
                $result['response'] = 0;
                $result['error'] = "Failed to make request.";
            }

            // Close cURL session
            curl_close($ch);
        } else {
            // If data_post_id or input_comment is not set in the POST request
            $result['response'] = 0;
            $result['error'] = "Missing parameters.";
        }

        // Return the result as JSON
        return json_encode($result);
    }


    public function ShareOfPost()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the attachment from the form data
            $attachment = $_FILES['attachment'];

            // Construct the URL for the Facebook Graph API endpoint
            $page_id = '196821650189891';
            $access_token = 'EAADNF4vVgk0BOZBn1W1arQv6ZCHt2bW6CjIRMW6I6QKMtDD6AUwisR0q8QNvbMFCUI1GBwJoWWklhol2CZCDgbPkTdjH7LT8qtEaUTADn4SZBzvbkg9m8cZBTcNLvc0ZABZBDRvSmRNqtns26nd2yyZAmsGpnmgcJZA7SV2UpWZCWQ252xk6RDMQJtwuLdbEQxaYhSMTbeW7EZD';


            // Initialize cURL session
            $curl = curl_init();

            // Set the file as multipart/form-data
            $file_data = array(
                'source' => curl_file_create($attachment['tmp_name'], $attachment['type'], $attachment['name']),
                'message' => 'Your message here' // Optional: Add a message to the post
            );

            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://developers.facebook.com/docs/graph-api/reference/v2.2/' . $page_id . '/feed',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array_merge($file_data, array(
                    'access_token' => $access_token
                )
                ),
            )
            );

            // Execute the POST request
            $response = curl_exec($curl);

            // Check for errors
            if ($response === false) {
                $error = curl_error($curl);
                echo "cURL Error: " . $error;
            } else {
                echo "Post sent successfully.";
            }

            // Close cURL session
            curl_close($curl);
        } else {
            // Handle the case when the request method is not POST
        }
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
        )
        );

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


    public function schedule_insert_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from the POST request
            $attachments = $_FILES['attachment']; 
            $event_address = $_POST['event_address'];
            // Set your page ID and access token
            $page_id = '196821650189891';
            $access_token='EAADNF4vVgk0BO9zvep9aAEl9lvfRQUuPLHDS1S42aVomuXuwiictibNEvU4Ni7uaAcuZB2oZC1Y9rFUSgcpOWtecoYtJXrpLipby9bfxokFR1cOsXN1ZBuFIDbeIl53XJpl1mjhCZA2C6H5wQwzQGPDqtWOoc8gCOkIZBidwoT3G2n7I6KUuahJHypU50NzSAPjlVKXgZD';
    
    
            if (isset($attachments['name']) && $attachments['error'] === UPLOAD_ERR_OK) { 
                $utc_date_string = date('d-m-Y H:i', strtotime($_POST['scheduled_time']));
                $date = DateTime::createFromFormat('d-m-Y H:i:s', $utc_date_string . ':00');
                $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
                $formatted_date = $date->format('c');
    
                echo "Scheduled Time: $utc_date_string\n"; // Echo the scheduled time
    
                // Check if the file has been uploaded
                if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                   
                    $uploadDirectory = 'assets/facebook_image/'; 
    
                    if (!is_dir($uploadDirectory)) {
                        mkdir($uploadDirectory, 0777, true);
                    }
    
                    // Move the uploaded image file to the specified directory
                    $sourceFilePath = $_FILES['attachment']['tmp_name'];
                    $fileName = $_FILES['attachment']['name'];
                    $targetFilePath = $uploadDirectory . $fileName;
                    
                    if (move_uploaded_file($sourceFilePath, $targetFilePath)) {
                    
                        echo "Image file uploaded successfully.";
                        $imageURL = 'https://yourdomain.com/' . $targetFilePath;
                        // pre($imageURL);
                      
                        $post_data = array(
                            "message" =>$event_address,
                            "link" => $imageURL, 
                            "published" => "false",
                            "scheduled_publish_time" => $formatted_date, // Append Indian Standard Time offset
                        );
                        // pre($post_data);
                        // Convert post data to JSON
                        $post_data_json = json_encode($post_data);
                        
                        // Set cURL options for the request
                        $url = "https://graph.facebook.com/v19.0/$page_id/feed/?access_token=$access_token";
                        $Result = postSocialData($url, $post_data_json);
                        pre($Result);
    
                        echo "Facebook API Response: ";
    
                        if ($Result === false) {
                            echo "Error: Failed to make the request.";
                        } else {
                            echo "Successfully scheduled the post.";
                        }
                    } else {
                        // Error handling if file copy operation failed
                        echo "Error: Failed to upload image file.";
                    }
                } else {
                    echo "No attachment file uploaded."; // Handle case when no attachment file is uploaded
                }
            }
        }
    }
    

    // public function get_post_data()
	// {
	// 	$cache = \Config\Services::cache();
	// 	$this->db = DatabaseDefaultConnection();
	// 	if ($_POST['action'] == 'account_list') {

	// 		$integration_table_name = $this->username . '_platform_integration';
	// 		$get_token = "SELECT * FROM $integration_table_name WHERE platform_status = 2 AND verification_status = 1";
	// 		$get_access_token_array = $this->db->query($get_token);
	// 		$data_count = $get_access_token_array->getNumRows();
	// 		$access_api = isset($_POST['api']) ? $_POST['api'] : false;
	// 		if ($data_count > 0) {
	// 			$unread_msg_data = array();
	// 			$fb_account_data = $get_access_token_array->getResultArray();
	// 			foreach ($fb_account_data as $account_key => $account_value) {
	// 				// pre($account_value);
	// 				// continue;
	// 				$token = $account_value['access_token'];
	// 				// pre($token);
	// 				// $fb_page_list = get_object_vars(json_decode($fb_page_list));
	// 				// pre($url);
	// 				$asset_table_name = $this->username . '_platform_assets';

	// 				if ($access_api === 'true' || $access_api === true || $access_api === 1) {
	// 					$fileds = 'instagram_business_account{id,username,profile_picture_url},picture,access_token,name,id';
	// 					$url = 'https://graph.facebook.com/v19.0/me/accounts?access_token=' . $token . '&fields=' . $fileds;
	// 					$fb_page_list_api = getSocialData($url);
	// 					$api_page_data = isset($fb_page_list_api['data']) ? $fb_page_list_api['data'] : array();
	// 					foreach ($api_page_data as $pages_key => $pages_value) {
	// 						$insert_data = array();
	// 						$insert_data['asset_id'] = $pages_value['id'];
	// 						$insert_data['platform_id'] = $account_value['id'];
	// 						$isduplicate = $this->duplicate_data($insert_data, $asset_table_name);
	// 						if (!$isduplicate) {
	// 							$insert_data['platform_id'] = $account_value['id'];
	// 							$insert_data['master_id'] = $_SESSION['master'];
	// 							$insert_data['asset_type'] = 'pages';
	// 							$insert_data['access_token'] = $pages_value['access_token'];
	// 							$insert_data['name'] = $pages_value['name'];
	// 							$insert_data['asset_img'] = isset($pages_value['picture']['data']['url']) ? $pages_value['picture']['data']['url'] : '';
	// 							$insert_new_pages = $this->MasterInformationModel->insert_entry2($insert_data, $asset_table_name);
	// 						} else {
	// 							$update_data = array();
	// 							$update_data['asset_img'] = isset($pages_value['picture']['data']['url']) ? $pages_value['picture']['data']['url'] : '';
	// 							$update_data_img = $update_data['asset_img'];
	// 							if (!empty($update_data_img)) {
	// 								$isduplicate = $this->duplicate_data($update_data, $asset_table_name);
	// 								if (!$isduplicate) {
	// 									$update_id = $pages_value['id'];
	// 									$update_sql = "UPDATE `$asset_table_name` SET `asset_img`= '$update_data_img' WHERE `asset_id`= $update_id";
	// 									$update_sql_fire = $this->db->query($update_sql);
	// 								}
	// 							}
	// 						}
	// 					}
	// 				}


	// 				$platform_id = $account_value['id'];
	// 				$master_id = $_SESSION['master'];
	// 				$get_page_data = "SELECT * FROM $asset_table_name WHERE platform_id = $platform_id AND master_id = $master_id";
	// 				$get_page_data = $this->db->query($get_page_data);
	// 				$get_page_data = $get_page_data->getResultArray();
	// 				// pre($get_page_data);
	// 				$cache_data = $cache->get($_SESSION['id'] . '_fb_data');
	// 				// pre($cache_data);
	// 				// if (!empty($cache_data) && $access_api == false) {
	// 				// 	$fb_page_list = $cache_data;
	// 				// 	// echo 'yes';
	// 				// } else {
	// 				// $fb_page_list = getSocialData($url);
	// 				$fb_page_list['data'] = $get_page_data;
	// 				// echo 'no';
	// 				// }
	// 				$fb_chat_list_html = '';
	// 				$IG_chat_list_html = '';
	// 				$return_result = array();
	// 				$IG_data = array();

	// 				$permission_query = "SELECT GROUP_CONCAT(DISTINCT asset_id) as asset_id FROM " . $this->username . "_platform_assetpermission WHERE (FIND_IN_SET('fbpost', assetpermission_name) > 0 || FIND_IN_SET('fbcomments', assetpermission_name) > 0) AND user_id =" . $_SESSION['id'] . " AND platform_type='facebook'";
	// 				$permission_result = $this->db->query($permission_query);
	// 				$per_result = $permission_result->getResult();
	// 				$perasset_data = [];
	// 				if (isset($per_result[0])) {
	// 					$perasset_data = explode(',', $per_result[0]->asset_id);
	// 				}

	// 				// pre($fb_page_list);
	// 				foreach ($fb_page_list['data'] as $key => $value) {
	// 					if (in_array($value['id'], $perasset_data) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
	// 						$unread_msg = 0;
	// 						// pre($con_data);
	// 						// if (!empty($cache_data) && $access_api == false) {
	// 						// 	$unread_msg = $value['unread_count'];
	// 						// 	$page_img = $value['page_img'];
	// 						// } else {
	// 						// echo $access_api.'<br>';
	// 						if ($access_api === 'true' || $access_api === true || $access_api === 1) {
	// 							$url = 'https://graph.facebook.com/' . $value['asset_id'] . '/conversations?fields=unread_count&pretty=0&access_token=' . $value['access_token'];
	// 							$con_data = getSocialData($url);
	// 							if (isset($con_data['data'])) {
	// 								foreach ($con_data['data'] as $con_key => $con_value) {
	// 									// pre($value);
	// 									$unread_msg += $con_value['unread_count'] != 0 ? 1 : 0;
	// 								}
	// 							}
	// 							$unread_msg_data[$value['asset_id']] = $unread_msg;
	// 							// echo $unread_msg.'<br>';
	// 						} else {
	// 							$unread_msg = isset($cache_data[$value['asset_id']]) ? $cache_data[$value['asset_id']] : 0;
	// 							$unread_msg_data[$value['asset_id']] = $unread_msg;
	// 						}
	// 						// $page_data = fb_page_img($value['id'], $value['access_token']);
	// 						// $page_data = json_decode($page_data);
	// 						// $page_img = $page_data->page_img;
	// 						$page_img = $value['asset_img'];
	// 						// }

	// 						$fb_chat_list_html .= '<div class="col-12 account-nav account-box linked-page" data-page_id="' . $value['asset_id'] . '" data-platform="messenger" data-page_access_token="' . $value['access_token'] . '" data-page_name="' . $value['name'] . '">
	// 									<div class=" d-flex flex-wrap justify-content-between align-items-center p-2 ms-4">
	// 										<a href="" class="col-4 account_icon border border-1 rounded-circle me-2 align-self-center text-center">
	// 											<img src="' . $page_img . '" alt="" width="45">
	// 										</a>
	// 										<p class="fs-6 fw-medium col ps-2">' . $value['name'] . '
	// 										</p>';
	// 						if ($unread_msg  != 0) {
	// 							$fb_chat_list_html .= '<span class="ms-auto badge rounded-pill text-bg-success">' . $unread_msg . '</span>';
	// 						}
	// 						$fb_chat_list_html .= '</div>
	// 								</div>';
	// 						if (isset($value['instagram_business_account'])) {
	// 							$value['instagram_business_account']['access_token'] = $value['access_token'];
	// 							$value['instagram_business_account']['fb_page_id'] = $value['asset_id'];
	// 							$IG_data[] = $value['instagram_business_account'];
	// 						}

	// 						// if (empty($cache_data) && $access_api == false) {
	// 						// 	$fb_page_list['data'][$key]['unread_count'] = $unread_msg;
	// 						// 	$fb_page_list['data'][$key]['page_img'] = $page_data->page_img;
	// 						// }
	// 					}
	// 				}
	// 			}

	// 			foreach ($IG_data as $IG_key => $IG_value) {
	// 				$IG_chat_list_html .= '
	// 							<div class="col-12 account-nav account-box linked-page" data-page_id="' . $IG_value['fb_page_id'] . '" data-platform="instagram" data-page_access_token="' . $IG_value['access_token'] . '" data-page_name="' . $IG_value['username'] . '">
	// 								<div class=" d-flex flex-wrap justify-content-between align-items-center  p-2 ms-4">
	// 									<a href="" class="col-4 account_icon border border-1 rounded-circle me-2 align-self-center text-center">
	// 										<img src="' . $IG_value['profile_picture_url'] . '" alt="" width="45">
	// 									</a>
	// 									<p class="fs-6 fw-medium col ps-2">' . $IG_value['username'] . '
	// 									</p>
	// 								</div>
	// 							</div>
	// 								';
	// 			}
	// 			// pre($unread_msg_data);
	// 			if (!empty($unread_msg_data)) {
	// 				$cache->save($_SESSION['id'] . '_fb_data', $unread_msg_data, 3600);
	// 			}

	// 			// pre($IG_data);
	// 		} else {
	// 			$fb_chat_list_html = '';
	// 			$fb_chat_list_html .= '<div class="text-center col-12 overflow-y-scroll p-3">No Chats Found!</div>';
	// 			$IG_chat_list_html = '';
	// 			$IG_chat_list_html .= '<div class="text-center col-12 overflow-y-scroll p-3">No Chats Found!</div>';
	// 		}
	// 		$return_result['chat_list_html'] = $fb_chat_list_html;
	// 		$return_result['IG_chat_list_html'] = $IG_chat_list_html;
	// 		return json_encode($return_result);
	// 	}

    //     if ($_POST['action'] == 'img_load') {
	// 		$page_access_token = $_POST['page_access_token'];
	// 		$page_id = $_POST['page_id'];
    //         // pre($page_id);
		

	// 		// if ($_POST['api'] === true) {
    //             $response = getSocialData('https://graph.facebook.com/v19.0/' . $page_id . '/feed?access_token=' . $page_access_token . '&fields=admin_creator,message,full_picture,created_time,instagram_business_account');
        
    //             $fb_page_list = $response;
        
    //             $html = "";
        
    //             foreach ($fb_page_list['data'] as $key => $value) {
    //                 $url = 'https://graph.facebook.com/v19.0/' . $value['id'] . '?fields=attachments&access_token=' . $page_access_token . '';
    //                 $data = getSocialData($url);
    //                 // $time = strtotime($data[0]['created_time']);    
    //                 $accesss_tocken_comment = 'EAADNF4vVgk0BOxhE65gYKna00bR9EF9KFNJZCYhHaFUATLZBIBlKEvCWZBdvfj5HLx3Pu4tFcpuciQRHZCZCxuySq7VBDdzmifCb7M16wr2X1DGSZCjiSZAwhLMvq6zS9BgB6A92JxzZAZBEVo9SWr2JUXhvEZCTEc9qzZAPbjGdBZBVtjnJuZARm5r7S40aNTKVauqjiqYZCwCekZD';
    //                 if (isset($value['full_picture'])) {
    //                     $fb_upload_img = ($value['full_picture']);
    //                 } else {
    //                     $fb_upload_img = "";
    //                 }
    //                 if (isset($value->message)) {
    //                     $fb_titile = ($value->message);
    //                 } else {
    //                     $fb_titile = "";
    //                 }
        
    //                 $timestamp = $value['created_time'];
    //                 $date = new DateTime($timestamp, new DateTimeZone('UTC'));
    //                 $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
    //                 $facebook_upload_time = $date->format('Y-m-d h:i:s A');
    //                 $timestamp = strtotime($value['created_time']);
    //                 $current_time = time();
    //                 $time_diff = $current_time - $timestamp;
        
    //                 if ($time_diff < 60) {
    //                     $facebook_upload_time = "Just now";
    //                 } elseif ($time_diff < 3600) {
    //                     $minutes = floor($time_diff / 60);
    //                     $facebook_upload_time = "$minutes minute" . ($minutes == 1 ? '' : 's') . " ago";
    //                 } elseif ($time_diff < 86400) {
    //                     $hours = floor($time_diff / 3600);
    //                     $facebook_upload_time = "$hours hour" . ($hours == 1 ? '' : 's') . " ago";
    //                 } elseif ($time_diff < 604800) {
    //                     $days = floor($time_diff / 86400);
    //                     $facebook_upload_time = "$days day" . ($days == 1 ? '' : 's') . " ago";
    //                 } else {
    //                     $date = new DateTime('@' . $timestamp, new DateTimeZone('UTC'));
    //                     $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
    //                     $facebook_upload_time = $date->format('F d \a\t h:i A');
    //                 }
        
        
    //                 $html .= '<div class=" mb-2 col-12 col-sm-12 col-md-12 col-xl-5 col-xxl-4 " id="post_card" >
    //                     <div class="border rounded-4 bg-white  p-3 shadow mx-2 card-header">
        
                        
    //                 <div class="col-12 d-flex flex-wrap border-bottom">
    //                     <div class="me-2 cmt_modal_open" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">
    //                         <img class="rounded-circle" src="' . $data_img . '" alt="#" style="width:40px;height:40px;">
    //                     </div>
    //                     <div class="col">
    //                         <div class="col-12 d-flex flex-wrap justify-content-between">
    //                             <p class="col-10 cmt_modal_open " data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">' . $page_namee . '</p>
    //                             <div class="btn-group dropstart">
    //                                 <div class="" data-bs-toggle="dropdown" aria-expanded="false">
    //                                     <i class="fa-solid fa-ellipsis-vertical cursor-pinter mx-2"></i>
    //                                 </div>
    //                                 <ul class="dropdown-menu bg-transparent text-end border-0">
    //                                     <div class="d-flex flex-wrap bg-white border p-1 rounded-2">
    //                                     <div class="col-12 d-flex justify-content-start">
    //                                         <button class="bg-transparent text-start ps-1 col-12 border-0 delete_post_facebook" data-delete_id="' . $value['id'] . '"><i class="fa-solid fa-trash-can me-2"></i>Delete</button>
    //                                         </div>
    //                                         <div class="col-12 d-flex justify-content-start">
    //                                         <button class="bg-transparent text-start ps-1 col-12 border-0 edit_post_facebook" data-edit_id="' . $value['id'] . '" data-page_id="' . $pagee_idd . '" data-access_token="' . $accesss_tocken_comment . '" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-trash-can me-2"></i>Edit</button>
    //                                         </div>
    //                                     </div>
    //                                 </ul>
    //                             </div>
        
    //                         </div>
        
    //                         <div class="col-12 cmt_modal_open" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '"  data-bs-toggle="modal" data-bs-target="#comment-modal">
    //                             <span class="text-muted">
    //                                 <span class="fs-14">' . $facebook_upload_time . '</span>
    //                             </span>
    //                             <span>
    //                                 <i class="fa-solid fa-earth-asia fs-14 fw-muted"></i>
    //                             </span>
    //                         </div>
    //                     </div>
    //                 </div>
    //                     <div class="col-12 cmt_modal_open" data-bs-toggle="modal" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-target="#comment-modal">
    //                 <div class="col-12 my-2">
    //                     <p class="fs-14">' . $fb_titile . '</p>
    //                 </div>
    //                 <div class="py-2 d-flex justify-content-center bg-white align-items-center overflow-hidden col-12 p-2" style="min-height: 209px; max-height: 209px; overflow: hidden;">';
    //                 if (isset($data['attachments']['data']) && !empty($data['attachments']['data'])) {
    //                     $attachments = $data['attachments']['data'];
    //                     // Display all images
    //                     foreach ($attachments as $attachment) {
    //                         // pre($attachment);
    //                         // Check for subattachments
    //                         if (isset($attachment['subattachments']['data']) && !empty($attachment['subattachments']['data'])) {
    //                             $subattachments = $attachment['subattachments']['data'];
    //                             foreach ($subattachments as $subattachment) {
    //                                 $image_url = $subattachment['media']['image']['src'];
    //                                 $html .= "<img src='$image_url' alt='Image' style='width:100%;height:300px;'>";
    //                             }
    //                         } else {
    //                             // No subattachments, display the main attachment image
    //                             if (isset($attachment['media']['image']['src']) && !empty($attachment['media']['image']['src'])) {
    //                                 $image_url = $attachment['media']['image']['src'];
    //                                 $html .= "<img src='$image_url' alt='Image' style='width:100%;height:300px;'>";
    //                             }
    //                         }
    //                     }
    //                 }
    //                 $html .= '
                    
    //                 </div>
    //                 </div>
    //                 <div class="col-12 p-1 mt-2 border-top pt-3">
    //                 <div class="row align-items-center justify-content-center">
    //                     <div class=" mb-2 mb-md-0 p-0 px-1" style="width:fit-content;">
    //                         <button class="btn like_button d-flex p-0 border-0">
    //                             <i class="fa-regular fa-thumbs-up mx-1 my-auto" id="like_icon"></i>
    //                             <i class="fa-solid fa-thumbs-up d-none mx-1 my-auto" id="like_icon_lite"></i>
    //                             <div class="my-auto btn-text comment_like_count">Like</div>
    //                         </button>
    //                     </div>
                
    //                     <div class=" mb-2 mb-md-0 p-0 px-1" style="width:fit-content;">
    //                         <button class="btn d-flex p-0 border-0 cmt_modal_open" data-access_token="' . $accesss_tocken_comment . '" data-post_id="' . $value['id'] . '" data-bs-toggle="modal" data-bs-target="#comment-modal">
    //                             <i class="fa-regular fa-comment mx-1 my-auto"></i>
    //                             <div class="my-auto btn-text">Comment</div>
    //                         </button>
    //                     </div>
    //                 <div class=" mb-2 mb-md-0 p-0 px-1" style="width:fit-content;data-toggle="modal" data-target="#sharemodal" >
    //                 <div class="btn w-100 text-muted d-flex p-0 border-0" data-toggle="modal"  data-attachment_post="' . $fb_upload_img . '" data-target="#sharemodal"  id="post_commnet_modal"><i class="fa-solid fa-share mx-2 my-auto"></i><div class="my-auto">share</div></div>
    //             </div>
                    
                    
    //                 </div>
        
        
        
    //             </div>
    //             </div>
    //             </div>
        
    //             ';
    //             }
    //             $return_array['html'] = $html;
        
    //             echo json_encode($return_array, true);
	// 	}
	// }

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
        $Database = DatabaseDefaultConnection();
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
    public function duplicate_data($data, $table_name)
    {
        // Your duplicate data checking logic here
    }
}

