<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Exception;
use League\OAuth2\Client\Provider\LinkedIn;


class LinkedinController extends BaseController
{
    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->db = DatabaseDefaultConnection();
        $this->MasterInformationModel = new MasterInformationModel($db);
        $this->username = session_username($_SESSION["username"]);
        $this->admin = 0;
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $this->admin = 1;
        }
        $this->timezone = timezonedata();
    }

    public function add_linkedin_connection()
    {
        $client_secret = $this->request->getPost("client_secret");
        $client_id = $this->request->getPost("client_id");
        $access_token = $this->request->getPost("access_token");
        $provider = new LinkedIn([
            'clientId' => $client_id,
            'clientSecret' => $client_secret,
        ]);

        $provider->setAccessToken(['access_token' => $access_token]);

        // Make a request to LinkedIn's API
        try {
            // Replace 'me' with the endpoint you want to access
            $response = $provider->get('me');

            // Output the response
            var_dump($response);
        } catch (Exception $e) {
            // Handle any errors
            echo 'Error: ' . $e->getMessage();
        }

        // if (!isset($_GET['code'])) {
        //     // If we don't have an authorization code, then get one
        //     $authUrl = $provider->getAuthorizationUrl();
        //     $_SESSION['oauth2state'] = $provider->getState();
        //     header('Location: ' . $authUrl);
        //     exit;
        // } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        //     // Check given state against previously stored one to mitigate CSRF attack
        //     unset($_SESSION['oauth2state']);
        //     exit('Invalid state');
        // } else {
        //     // Try to get an access token using the authorization code grant
        //     $token = $provider->getAccessToken('authorization_code', [
        //         'code' => $_GET['code'],
        //     ]);

        //     // Optional: Use the token to fetch user information
        //     try {
        //         $user = $provider->getResourceOwner($token);
        //         print_r($user->toArray());
        //     } catch (Exception $e) {
        //         exit('Failed to get user details: ' . $e->getMessage());
        //     }
        // }
    }
}
