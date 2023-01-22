<?php

include_once('../backbone.php');

// step 1 curl the server stat for both of the servers
$server = curlServerInfo();

// update the server's player count
insertServerPlayerCount($db, $server);

// dont try to loop users if server has no players
if($server['onlinePlayers'] != 0) {

// step 3 log the players
foreach ($server['players'] as $player) {

    // step 3.5 insert the player information into the 'users' table

    $db->where("username", $player['username']);
    $check = $db->getOne("users");

    if(!$check) {

        // only try this if the player is not in the 'users' table
	
	$uuid = userUUID($player['username'])['uuid'];
	if($uuid) {
        $data = curlPlayerInfo($uuid);
        $data["username"] = $player['username'];
        insertUser($db, $data);    
	}
    }
    else {
        // step 4 insert the player coords into the 'user_coodinate_history' table 
        userCoordinates($db, $player);
    }        
}
}


?>
