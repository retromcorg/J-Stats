<?php

include_once("../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

// step 1 curl the server stat for both of the servers
$server = curlServerInfo();

$final = [];
$payload['server'] = $server['serverName'];
if($server['onlinePlayers'] != 0) {
    $payload['players'] = [];
    foreach ($server['players'] as $player) {
        $players = [
            $payload['players'][] = [$player['username'], getUUIDUsername($db, $player['username'])]
        ];
    }

    $db->orderby("t", "DESC");
    $pl = $db->get("server_history", 30);
    $players = array_reverse($pl);
    $h = [];
    $d = [];

    foreach ($players as $player) {
        $h[] = $player['players'];
        $e[] = unix2($player['t']);
    }
    $payload['player_history'] = $h;
    $payload['player_date'] = $e;
    $payload['average'] = $server['average'];
    $payload['online'] = $server['onlinePlayers'];

    $final[] = $payload;
}

echo json_encode($final, true);




?>