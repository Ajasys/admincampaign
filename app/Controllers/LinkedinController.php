<?php

namespace App\Controllers;

use App\Models\MasterInformationModel;
use Config\Database;
use DateInterval;
use DateTime;
use DateTimeZone;

class LinkedinController extends BaseController
{
    public function __construct()
    {
        helper("custom");
        $db = db_connect();
        $this->db = \Config\Database::connect('second');
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
        
    }
}