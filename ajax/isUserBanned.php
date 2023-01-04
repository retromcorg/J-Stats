<?php

include_once("../internal/backbone.php");

if($_POST) {
    $u = htmlspecialchars(strip_tags($_POST['uuid']));
    if(isset($u)) {
        $data = json_decode(curlData("https://bans.johnymuffin.com/api/v1/getBanHistory?uuid=" . $u), true);
        
        if(!empty($data)) {
            $bans = [];
            $banCount = 0;
            $activeBans = 0;
            foreach($data['bans'] as $ban) {
                if($ban['serverName'] == 'RetroMC') {
                    $banCount++;
                    $bans['bans'][] = [
                        "admin" => [$ban['adminUsername'], $ban['adminUUID']],
                        "player" => [$ban['playerName'], $ban['playerUUID']],
                        "reason" => $ban['reason'],
                        "pardoned" => $ban['pardoned'],
                        "evidence" => $ban['evidence'],
			"dates" => [to_time_ago($ban['timeIssued']), unix($ban['timeIssued'])]
                    ];
                }
            }
	    $bans['isBanned'] = $data['isBanned'];
            $bans['total'] = $banCount;
            echo json_encode($bans);
        }
    }
}

?>
