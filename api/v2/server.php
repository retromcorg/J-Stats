<?php


include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

// peek
$db->orderby("players", "DESC");
$c = $db->getOne("server_history");

// daily
$db->orderby("players", "DESC");
$db->where("t > UNIX_TIMESTAMP(NOW() - INTERVAL 24 HOUR)");
$c2 = $db->getOne("server_history");

// weekly
$db->orderby("players", "DESC");
$db->where("t > UNIX_TIMESTAMP(NOW() - INTERVAL 7 DAY)");
$c3 = $db->getOne("server_history");

// monthly
$db->orderby("players", "DESC");
$db->where("t > UNIX_TIMESTAMP(NOW() - INTERVAL 30 DAY)");
$c4 = $db->getOne("server_history");


// step 2 curl the server stat for both of the servers
$server = curlServerInfo();

$final = [];
if($server['onlinePlayers'] != 0) {
    $payload['players'] = [];
    foreach ($server['players'] as $player) {
        $players = [
            $payload['players'][] = [
                "username" => $player['username'], 
                "uuid" => getUUIDUsername($db, $player['username']), 
                "coords" => [
                    "x" => $player['x'], 
                    "y" => $player['y'], 
                    "z" => $player['z'], 
                    "world" => $player['world']
                    ]
                ]
            ];
    }
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
$payload['online'] = $server['onlinePlayers'];
$final = $payload;

$final["peek_total"] = $c['players'] ?? 0;
$final["daily_total"] = $c2['players'] ?? 0;
$final["weekly_total"] = $c3['players'] ?? 0;
$final["monthly_total"] = $c4['players'] ?? 0;
$final["status"] = "success";

echo json_encode($final, true);


?>
