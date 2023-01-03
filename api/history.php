<?php

include_once("../internal/backbone.php");


header('Content-type: application/json; charset=utf-8');

if (!isset($_GET['uuid']) && !isset($_GET['q'])) {
    echo json_encode(["error" => "no uuid/method"], true);
    die();
}
else {
    $u = htmlspecialchars(strip_tags($_GET['uuid']));
    $q = htmlspecialchars(strip_tags($_GET['q']));

    $methods = ["money", "playerDeaths", "trustScore", "playersKilled", "joinCount", "metersTraveled", "blocksPlaced", "playTime", "itemsDropped", "trustLevel", "creaturesKilled", "blocksDestroyed"];

    if(!in_array($q,$methods)) {
        echo json_encode($methods,true);
        die();
    }
    else {
        $db->where("uuid", $u);

        $u2 = $db->getOne("users");

        if(!$u2) {
            echo json_encode(["error" => "no user in db"], true);
            die();   
        }
        else {
            $db->groupBy($q);
            $db->where("user_id", $u2['id']);
            $stats = $db->get("user_stats");


            if(!$stats) {
                echo json_encode(["error" => "no stats in db"], true);
                die();
            }
            else {
                $e = [];
                foreach($stats as $stat) {
                    $e[] = $stat[$q];
                }

                $data = [
                    "username" => $u2['username'],
                    $q."_history" => $e
                ];

                echo json_encode($data,true);
                die();
            }
        }  
    }

}




?>