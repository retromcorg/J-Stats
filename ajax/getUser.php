<?php

include_once("../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

if($_POST) {
    if(isset($_POST['search'])) {

        $u = htmlspecialchars(strip_tags($_POST['search']));

        $data = userUUID($u);

        if(!$data) {
            echo '{"title": "User not found", "type":"error","message": "Please enter a valid Mojang Account."}';
            die(); 
        }
        else {
            echo '{"type":"success","uuid": "'.  $data['uuid'] .'", "name":"'. $data['username'] .'"}';
            die();   
        }        
    }
}

?>