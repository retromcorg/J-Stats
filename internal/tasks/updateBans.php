<?php

include_once('../backbone.php');

$users = $db->get("users");

foreach ($users as $user) {

    $data = json_decode(curlData("https://bans.johnymuffin.com/api/v1/getBanHistory?uuid=" . $user['uuid']), true);

    if(!empty($data)) {
        $bans = [];
        foreach($data['bans'] as $ban) {
            if($ban['serverName'] == 'RetroMC') {
                $data = [
                    "user" => $ban['playerName'],
                    "user_uuid" => $ban['playerUUID'],
                    "admin" => $ban['adminUsername'],
                    "admin_uuid" => $ban['adminUUID'],
                    "reason" => $ban['reason'],
                    "t" => $ban['timeIssued'],
                    "evidence" => json_encode($ban['evidence'], true),
                    "expiry" => isset($ban['expiry']) ? $ban['expiry'] : null
                ];
                $db->insert("user_bans", $data);
            }
        }
    }
}







?>