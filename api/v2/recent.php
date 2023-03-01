<?php


include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');


$builder = [];

$db->orderby("firstJoin", "DESC");
$added = $db->get("users", 5);

foreach($added as $k => $a) {
    $builder['recently_added'][] = [
        "username" => $a['username'],
        "uuid" => $a['uuid'],
        "date" => $a['firstJoin']
    ];
}

$db->orderby("lastJoin", "DESC");
$updated = $db->get("users", 5);

foreach($updated as $k => $u) {
    $builder['recently_updated'][] = [
        "username" => $u['username'],
        "uuid" => $u['uuid'],
        "date" => $u['lastJoin']
    ];
}


echo json_encode($builder, true);

?>