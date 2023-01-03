<?php

include_once("../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

if($_POST) {
    if(isset($_POST['username'])) {
        $username = htmlspecialchars(strip_tags($_POST['username']));

        echo isPlayerOnline($db, $username);
    }
}


?>