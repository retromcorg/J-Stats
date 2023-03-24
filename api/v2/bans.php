<?php

include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');


$builder = [];

$db->orderby("issued", "DESC");
$users = $db->get("user_bans");

if($users) {
    $builder['status'] = 'success';

    foreach ($users as $user) {
        $builder['data'][] = [
		"banID" => $user['banID'],
		"adminUUID" => $user['adminUUID'],
		"adminUsername" => $user['adminUsername'],
		"playerUUID" => $user['playerUUID'],
		"playerUsername" => $user['playerUsername'],
		"pardoned" => $user['pardoned'],
		"issued" => $user['issued'],
		"evidence" => json_decode($user['evidence'], true),
		"reason" => $user['reason'],
		"expires" => $user['expires']
        ];
    
    }
}
else {
    $builder = [
        "status" => "error",
        "msg" => "couldnt fetch staff members",
        "code" => 1
    ];
}

echo json_encode($builder, true);

?>
