<?php


if (!function_exists("// pre")) {
    function pre($array)
    {
        echo "<pre>";
        print_r($array);
        echo "<pre>";
    }
}

if (!function_exists('timezone')) {
    function timezone($formate = "Y-m-d")
    {
        if (isset($_SESSION['timezone']) && !empty($_SESSION['timezone'])) {
            $timezone = $_SESSION['timezone'];
        } else {
            $timezone = "Asia/Kolkata";
        }
        $timezones = array();
        $db_connection = \Config\Database::connect();
        $timezone = new \DateTimeZone($timezone);
        // $db_connection->query("SET time_zone='" . $timezone->getName() . "'");
        // Get the current date in Asia/Kolkata time zone
        $currentDate = new \DateTime('now', $timezone);
        $currentDateFormatted = $currentDate->format($formate);
        $timezones['zone'] = $timezone->getName();
        $timezones['formate'] = $currentDateFormatted;
        return $timezones;
    }
}


if (!function_exists('UtcTime')) {
    function UtcTime($formate = "", $timezone = "", $date = "")
    {
        $targetTimeZone = new \DateTimeZone($timezone);
        $currentTime = date('H:i:s');
        if(!preg_match("/H/", $formate) && !preg_match("/i/", $formate) && !preg_match("/s/", $formate)){
            $dateTime = new \DateTime($date.' '.$currentTime, $targetTimeZone);
        } else {
            $dateTime = new \DateTime($date, $targetTimeZone);
        }
        $utcTimeZone = new \DateTimeZone('UTC');
        $dateTime->setTimezone($utcTimeZone);
        // This Function Is Return The The date UTC Wise
        if (!empty($formate)) {
            return $dateTime->format($formate);
        } else {
            return $dateTime->format('Y-m-d H:i');
        }
    }
}

if (!function_exists('Utctodate')) {
    function Utctodate($formate = "", $timezone = "", $date = "")
    {
        // This Function is Use For The Get Date From database
        // This Function is Convert The Date UTC To Curunt Timezone
        $utcTimeZone = new \DateTimeZone('UTC');
        $dateTime = new \DateTime($date, $utcTimeZone);
        $targetTimeZone = new \DateTimeZone($timezone);
        $dateTime->setTimezone($targetTimeZone);
        // This Function Is Return The The date Curunt Timezone Wise
        if (!empty($formate)) { 
            return $dateTime->format($formate);
        } else {
            return $dateTime->format('Y-m-d H:i');
        }

    }
}

if (!function_exists('tableCreateAndTableUpdate')) {
    function tableCreateAndTableUpdate($table_name = "", $duplicate_table = '', $columns = array())
    {
        $first_db = \Config\Database::connect();
        if ($first_db->tableExists($table_name) && $table_name != '') {
            foreach ($columns as $value) {
                $value_col_name = explode(' ', $value);
                if (!$first_db->fieldExists($value_col_name[0], $table_name) && !empty($value)) {
                    $sql = "ALTER TABLE $table_name ADD $value ";

                    $first_db->query($sql);

                }
            }
        } else if (!$first_db->tableExists($table_name) && $duplicate_table != '' && $table_name != '') {
            if (!empty($columns)) {
                $columnss = implode(",", $columns);
                $sql = "CREATE TABLE $table_name ($columnss)";
                echo $sql;
                $first_db->query($sql);
            } else {
                $sql = "CREATE TABLE $table_name LIKE $duplicate_table";
                $first_db->query($sql);
            }
        } else {
            if (!empty($columns)) {
                $sql = "CREATE TABLE $table_name (" . implode(',', $columns) . ")"; // Your Other table Columns
                $first_db->query($sql);
            }
        }
        $first_db->close();
    }
}

if (!function_exists('any_id_to_full_data')) {
    function any_id_to_full_data($table,$user_id)
    {
        $result_user_data = array();

        $db = db_connect();
        $query = $db->query('SELECT * FROM ' . $table . ' WHERE id = "' . $user_id . '"');
        $count_num = $query->getNumRows();
        if ($count_num > 0) {
            $result_user_data = $query->getResultArray()[0];
        }

        return $result_user_data;
    }
}