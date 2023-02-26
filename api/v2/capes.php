<?php

include_once("../../internal/backbone.php");


header('Content-type: application/json; charset=utf-8');


$builder = [];

$db->where("cape", "", "!=");

$users = $db->get("users");


if($users) {
    $builder['status'] = 'success';

    foreach ($users as $user) {
        $builder['data'][] = [
            "username" => $user['username'],
            "uuid" => $user['uuid'],
            "cape" => $user['cape']
        ];
    
    }
}
else {
    $builder = [
        "status" => "error",
        "msg" => "couldnt fetch capes",
        "code" => 1
    ];
}


echo json_encode($builder, true);

?>