<?php

include_once("../internal/backbone.php");


header('Content-type: application/json; charset=utf-8');

if (!isset($_GET['uuid']) && !isset($_GET['method'])) {
    echo json_encode(["error" => "no uuid/method"], true);
    die();
}
else {
    $u = htmlspecialchars(strip_tags($_GET['uuid']));
    $m = htmlspecialchars(strip_tags($_GET['method']));


    if(!array_key_exists($m,$stats_methods)) {
        echo json_encode(["methods" => array_keys($stats_methods)],true);
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
            $db->groupBy($m);
            $db->where("user_id", $u2['id']);
	    $db->orderBy("t", "ASC");
            $stats = $db->get("user_stats");


            if(!$stats) {
                echo json_encode(["error" => "no stats in db"], true);
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
                    "method" => $stats_methods[$m],
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
