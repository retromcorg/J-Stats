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
        
        $u2 = fetchUser($db, $user);

        if(!$u2) {
            echo json_encode(["status" => "error", "code" => 2, "msg" => "Could not get stats"], true);
            die();
        
        } else {

            $builder = $u2;
            $builder['status'] = "success";

            echo json_encode($builder, true);
            die();
        }
        
    }
} 

?>