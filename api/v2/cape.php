<?php

include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

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

        if($user['cape'] != "") {
        $builder = [
            "status" => "success",
            "username" => $user['username'],
            "uuid" => $user['uuid'],
            "cape" => $user['cape']
        ];
        }
        else {
        $builder = [
            "status" => "error",
            "msg" => "user does not have cape",
            "code" => 5
        ];
        }

        echo json_encode($builder, true);
    }

}