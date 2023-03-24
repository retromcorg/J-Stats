<?php


include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');


$u = htmlspecialchars(strip_tags($_GET['q']));

// check if get parameters is met 
if(!isset($u)) {
    echo json_encode(["status" => "error", "code" => 3, "msg" => "query parameter empty"]);
    die();
}

$v = searchVillage($db, $u);

if(!$v) {
    echo json_encode(["status" => "error", "code" => 2, "msg" => "no village information for this query"]);
    die();
}
else {

    $v2 = getVillageStats($db, $v['id']);
    $spawn = json_decode($v2['spawn'], true);
    $flags = json_decode($v2['flags'], true);
    $a = json_decode($v2['assistants'], true);
    $b1 = json_decode($v2['members'], true);


    $asst = [];
    foreach ($a as $b) {
        $n = getUsernameUUID($db,$b);
        $asst[] = $n;
    }

    $mem = [];
    foreach ($b1 as $c) {
        $n = getUsernameUUID($db,$c);
        $mem[] = $n;
    }

    $builder = [
        "status" => "success",
        "owner" => getUsernameUUID($db,$v['owner']),
        "owner_uuid" => $v['owner'],
        "name" => $v['name'],
	"uuid" => $v['uuid'],
        "assistants" => $v2['assistantsCount'],
        "assistantsList" => $asst,
        "members" => $v2['memberCount'],
        "membersList" => $mem,
        "claims" => $v2['claims'],
        "spawn" => [
            "x" => $spawn['x'],
            "y" => $spawn['y'],
            "z" => $spawn['z']
        ],
        "flags" => [
            "mob_spawning" => ft($flags['MOBS_CAN_SPAWN']),
            "can_invite" => ft($flags['MEMBERS_CAN_INVITE']),
            "can_alter" => ft($flags['RANDOM_CAN_ALTER'])           
        ]
    ];

    echo json_encode($builder, true);

}


?>
