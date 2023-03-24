<?php

include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');


$money = 0;
$playerDeaths = 0;
$playerKills = 0;
$joinCount = 0;
$metersTraveled = 0;
$blocksPlaced = 0;
$blocksDestroyed = 0;
$playTime = 0;
$mobsKilled = 0;


$db->orderby('t', "DESC");
$db->groupBy('user_id');
$stats = $db->get("user_stats");

foreach ($stats as $s) {
    $money += $s['money'];
    $playerDeaths += $s['playerDeaths'];
    $playerKills += $s['playersKilled'];
    $playTime += $s['playTime'];
    $metersTraveled += $s['metersTraveled'];
    $playTime += $s['playTime'];
    $mobsKilled += $s['creaturesKilled'];
    $joinCount += $s['joinCount'];
    $blocksDestroyed += $s['blocksDestroyed'];
    $blocksPlaced += $s['blocksPlaced'];
}

$data = [
    "success" => true,
    "money" => $money,
    "playerDeaths" => $playerDeaths,
    "playerKills" => $playerKills,
    "playTime" => $playTime,
    "metersTraveled" => $metersTraveled,
    "mobsKilled" => $mobsKilled,
    "joinCount" => $joinCount,
    "blocksDestroyed" => $blocksDestroyed,
    "blocksPlaced" => $blocksPlaced
];

echo json_encode($data, true);

?>
