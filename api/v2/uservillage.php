<?php


include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');


$u = htmlspecialchars(strip_tags($_GET['user']));

if (!isset($_GET['user'])) {
    echo json_encode(["status" => "error", "code" => 3, "msg" => "no username/uuid"], true);
    die();
}

else {
    $u = htmlspecialchars(strip_tags($_GET['user']));
    $user = searchUser($db, $u);

    if(!$user) {
        echo json_encode(["status" => "error", "code" => 2, "msg" => "This user was not found"], true);
        die();
    }
    else {

        $builder = [];

        $village = json_decode(curlData("https://api.retromc.org/api/v1/village/getPlayer?uuid=". $user['uuid']),true);

        if($village['found']) {

            $builder['status'] = "success";
            $builder['username'] = $user['username'];
            $builder['uuid'] = $user['uuid'];


            foreach($village['villages']['owner'] as $owner) {
                $builder['owner'][] = [
                    "village" => getVillageName($db, $owner), 
                    "village_uuid" => $owner
                ];
            }
            foreach($village['villages']['assistant'] as $assistant) {
                $builder['assistant'][] = [
                    "village" => getVillageName($db, $assistant),
                    "village_uuid" => $assistant
                ];
            }

            $db->orderby("t", "DESC");
            $data1 = $db->get("village_stats");

	        $data = super_unique($data1, 'village_id');

           foreach($data as $d) {
                   if(in_array($u, json_decode($d['members'], true))) {
                        $builder['member'][] = 
                        [
                            "village" => getVillageNameID($db, $d['village_id']),
                            "village_uuid" => getVillageUUID($db, $d['village_id'])
                        ];
                   }
            }

            echo json_encode($builder, true);
        }
    }
}





?>
