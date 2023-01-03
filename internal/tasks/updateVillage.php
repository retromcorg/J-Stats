<?php

include_once('../backbone.php');

// step 1 curl villages

$villages = curlAllVillages();

// step 2 loop through the villages and add them to the 'villages' table

foreach($villages['villages'] as $village) {

    // step 2.5 only insert if doesnt exist
    $db->where("uuid", $village['uuid']);
    $v = $db->getOne("villages");

    if(!$v) {
        // step 3
        insertVillage($db, $village);
    }
}



?>