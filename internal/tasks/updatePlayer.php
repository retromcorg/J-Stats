<?php

include_once('../backbone.php');

// step 1 get the users from the 'users' table, filter by 24h
$db->where("lastJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 24 HOUR)");
$users = $db->get("users");

foreach($users as $user) {    
    // step 2 curl the user data from the api
    $u = curlPlayerInfo($user['uuid']);
    // update 'users' table, and add to user_stats table
    insertUserStats($db, $u);
    updateUsers($db, $user['id'], $u);
    
    // step 3 try to fetch their cape, only fetch groups
    if(in_array($user['g'], ["mystic", "donator", "admin", "helper", "moderator"])) {
        fetchCape($db, $user['id']);
    }
}

?>
