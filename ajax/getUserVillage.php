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

            $db->groupby("village_id");
            $db->orderby("t", "DESC");
            $data = $db->get("village_stats");

           foreach($data as $d) {
                   if(in_array($u, json_decode($d['members'], true))) {
                        $result['member'][] = [getVillageUUID($db, $d['village_id']), getVillageNameID($db, $d['village_id'])];
                   }
           }

            echo json_encode($result, true);
        }
    }
};





?>
