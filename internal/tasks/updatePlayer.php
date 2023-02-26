<?php

include_once('../backbone.php');
$db->where("lastJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 1 DAY)");
// step 1 get the users from the 'users' table, filter by 24h
$users = $db->get("users");

foreach($users as $user) {    
    // step 2 curl the user data from the api
    $u = curlPlayerInfo($user['uuid']);
    // update 'users' table, and add to user_stats table
    insertUserStats($db, $user['id'], $u);
    updateUsers($db, $user['id'], $u);
    
    // step 3 try to fetch their cape, only fetch groups
    if(in_array($user['g'], ["mystic", "trial", "donator+", "donatorplusplus", "donator", "admin", "helper", "moderator"])) {
        fetchCape($db, $user['id']);
    }
}

?>
