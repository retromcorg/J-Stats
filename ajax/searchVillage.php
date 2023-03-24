<?php

include_once("../internal/backbone.php");

if($_POST) {
    if(isset($_POST['search'])) {
        $s = htmlspecialchars(strip_tags($_POST['search']));

        $db->where("name", $s , "REGEXP");
        $villages = $db->get("villages");
        $builder = [];

        if($villages) {
        $builder['status'] = "success";
        foreach ($villages as $village) {
            $v = getVillageStats($db, $village['id']);

            $builder['data'][] = [
                "owner" => getUsernameUUID($db,$village['owner']),
                "owner_uuid" => $village['owner'],
                "name" => $village['name'],
                "uuid" => $village['uuid'],
                "members" => $v['memberCount'],
                "claims" => $v['claims'],
                "assistants" => $v['assistantsCount']
            ];
        }
    }
    else {
        $builder = [
            "status" => "error", "code" => 2,"msg" => "no villages in db"
        ];
    }

    echo json_encode($builder, true);
    }
}


?>