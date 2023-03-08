<?php

include_once("../backbone.php");

$pages = 20;

for ($x = 1; $x <= $pages; $x++) {
    $bans = curlBans($x);
    if($bans) {

    foreach ($bans as $b) {
        $db->where("banID", $b['banID']);
        $check = $db->getOne("user_bans");
        if(!$check && $b['server'] == 'RetroMC') {
            $ban = curlBansInformation($b['banID']);

            if($b['expiry'] == 'Permanent') {
                $p = 0;
            }
            else {
                $p = strtotime($b['expiry']);
            }

            $data = [
                "banID" => $ban['banID'],
                "adminUUID" => $ban['adminUUID'],
                "adminUsername" => $ban['adminUsername'],
                "playerUUID" => $ban['playerUUID'],
                "playerUsername" => $ban['playerName'],
                "evidence" => json_encode($ban['evidence'], true),
                "pardoned" => $ban['pardoned'],
                "issued" => $ban['timeIssued'],
                "reason" => base64_encode($ban['reason']),
                "expires" => $p
            ];

            $db->insert("user_bans", $data);
        }
    }
    }

}


?>