<?php

include_once("../../internal/backbone.php");


header('Content-type: application/json; charset=utf-8');

if (!isset($_GET['user']) && !isset($_GET['activity'])) {
    echo json_encode(["status" => "error", "code" => 3, "msg" => "no uuid/method"], true);
    die();
}
else {
    $u = htmlspecialchars(strip_tags($_GET['user']));
    $m = htmlspecialchars(strip_tags($_GET['activity']));


    if(!array_key_exists($m,$stats_methods)) {
        echo json_encode(["status" => "error", "code" => 4,  "msg" => "method invalid", "methods" => array_keys($stats_methods)],true);
        die();
    }
    else {
        $u2 = searchUser($db, $u);

        if(!$u2) {
            echo json_encode(["status" => "error", "code" => 2, "msg" => "This user was not found"], true);
            die();
        }
        else {
            $db->groupBy($m);
            $db->where("user_id", $u2['id']);
	    $db->orderBy("t", "ASC");
            $stats = $db->get("user_stats",25);


            if(!$stats) {
                echo json_encode(["status" => "error", "code" => 2, "msg" => "no stats in db"], true);
                die();
            }
            else {
                $e = [];
		        $h = [];
                foreach($stats as $stat) {
                    $e[] = $stat[$m];
		            $h[] = unix($stat["t"]);
                }

                $data = [
                    "status" => "success",
                    "method" => $stats_methods[$m],
                    "method_name" => $m,
                    "username" => $u2['username'],
		            "uuid" => $u2['uuid'],
                    $m => $e,
		            "timestamps" => $h
                ];

                echo json_encode($data,true);
                die();
            }
        }  
    }

}




?>
