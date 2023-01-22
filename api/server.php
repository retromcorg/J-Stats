<?php

include_once("../internal/backbone.php");

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


echo json_encode([
    "peek_total" => $c['players'],
    "daily_total" => $c2['players'] ?? 0,
    "weekly_total" => $c3['players'] ?? 0, 
    "monthly_total" => $c4['players']
], true);


?>
