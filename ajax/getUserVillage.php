<?php

include_once("../internal/backbone.php");

if($_POST) {
    if(isset($_POST['uuid'])) {
        $u = htmlspecialchars(strip_tags($_POST['uuid']));

        $result = [];
        $village = json_decode(curlData("https://api.retromc.org/api/v1/village/getPlayer?uuid=". $u),true);

        if($village['found']) {

            foreach($village['villages']['owner'] as $owner) {
                $result['owner'][] = [$owner, getVillageName($db, $owner)];
            }
            foreach($village['villages']['assistant'] as $assistant) {
                $result['assistant'][] = [$assistant, getVillageName($db, $assistant)];
            }

            echo json_encode($result, true);
        }
    }
};





?>