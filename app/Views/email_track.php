<?php


// $code = $this->request->getGet('code');
$code = $_REQUEST['code'];
$emailStatus = 'yes';
$emailOpenDatetime = date('Y-m-d H:i:s', strtotime(date('h:i:sa')));

$data = [
    'email_track_code' => $code,
    'email_status' => $emailStatus,
    'email_open_datetime' => $emailOpenDatetime
];
// $data = [
//     'email_track_code' => 1,
//     'email_status' => 'Yes',
//     'email_open_datetime' => '2023-04-25 08:45'
// ];
$db = DatabaseDefaultConnection();
$builder = $db->table('admin_email_track');
$builder->insert($data);

// If you want to get the last inserted ID, you can use:
// $lastInsertID = $db->insertID();


?>
