<?php

include_once('../backbone.php');

// step 1 curl the server stat for both of the servers

$villages = $db->get("villages");

// step 2 parse both the server information
foreach ($villages as $village) {

    $data = curlVillageInfo($village['uuid']);

    // update the server's player count
    insertVillageStats($db, $data);

}

?>