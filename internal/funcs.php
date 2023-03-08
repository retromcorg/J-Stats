<?php


    // use for APIs
    function curlData($url) {
        $db = $GLOBALS['db'];
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_NOSIGNAL, 1);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT_MS, 2500);
        curl_setopt($curl_handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($curl_handle, CURLOPT_ENCODING,  '');

        $curl_data = curl_exec($curl_handle);
        $curl_err = curl_errno($curl_handle);
        $curl_httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

        curl_close($curl_handle);   

        if ($curl_err > 0) {
            return false;
        } 
        else {
            if($curl_httpcode != 200) {
                return false;
            }
            else {
                return $curl_data;
            }
        }       
    }

function strip($msg) {
	return str_replace('**', '', $msg);
}

    function super_unique($array,$key)
    {
    $temp_array = [];
    foreach ($array as &$v) {
            if (!isset($temp_array[$v[$key]]))
                $temp_array[$v[$key]] =& $v;
        }
    $array = array_values($temp_array);
    return $array;

    }

    // search array for value then return data
    function searchArray($array, $k, $v) {
        foreach ($array as $key => $value) {
            if ($value[$k] === $v) {
                return $array[$key];
            }
        }
        return false;
    }


    // return 0,1 into false,true
    function ft($s) {
        if($s == true) {
            return "true";
        }
        else {
            return "false";
        }
    }

    // unix time
    function unix(&$string) {
        $time =date("Y-m-d h:i:sa", $string);
        return $time;
    };
    // unix time 2
    function unix2(&$string) {
        $time =date("h:i:sa", $string);
        return $time;
    };

    // seconds to words
    function secondsToWords($seconds) {
        $ret = "";

        $days = intval(intval($seconds) / (3600*24));
        if($days> 0)
        {
            $ret .= "$days days ";
        }

        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0)
        {
            $ret .= "$hours hours ";
        }

        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0)
        {
            $ret .= "$minutes minutes ";
        }

        $seconds = intval($seconds) % 60;
        if ($seconds > 0) {
            $ret .= "$seconds seconds";
        }

        return $ret;
    }

    // pretty playtime thing

    function secondsToWordsMini($seconds) {
            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds / 60) % 60);
            return "$hours.$minutes";
    }

    // calculate time ago
    function to_time_ago($time) {
        $diff = time() - $time;
        if($diff < 1) {
            return 'less than 1 second';
        }

        $time_rules = [
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        ];
        foreach($time_rules as $secs => $str) {

            $div = $diff / $secs;

            if($div >= 1) {
                $t = round($div);
                return $t . ' ' . $str .
                    ($t > 1 ? 's' : '');
            }
        }
    }


    // get username from id
    function getUsername($db, $user_id) {
        $db->where("id", $user_id);
        $user = $db->getOne("users", ["username"]);
        return $user['username'];
    }

    // get username from uuid
    function getUsernameUUID($db, $uuid) {
        $db->where("uuid", $uuid);
        $user = $db->getOne("users", ["username"]);

        if(!$user) {
            return userUUID($uuid)['username'];
        }
        else {
            return $user['username'];
        }

    }

    // get uuid from username
    function getUUIDUsername($db, $username) {
        $db->where("username", $username);
        $user = $db->getOne("users", ["uuid"]);

        if(!$user) {
            return userUUID($username)['uuid'];
        }
        else {
            return $user['uuid'];
        }

    }

    // get uuid from id
    function getUUID($db, $user_id) {
        $db->where("id", $user_id);
        $user = $db->getOne("users", ["uuid"]);
        return $user['uuid'];  
    }

    // get ID from username
    function getUsernameID($db, $username) {
        $db->where("username", $username);
        $user = $db->getOne("users", ["id"]);
        return $user['id'];
    }
    
    // get id from user uuid
    function getUserID($db, $uuid) {
        $db->where("uuid", $uuid);
        $user = $db->getOne("users", ["id"]);
        return $user['id'];  
    }

    // get id from village uuid
    function getVillageID($db, $uuid) {
        $db->where("uuid", $uuid);
        $user = $db->getOne("villages", ["id"]);
        return $user['id'];  
    }


    // get village name from uuid
    function getVillageName($db, $uuid) {
        $db->where("uuid", $uuid);
        $user = $db->getOne("villages", ["name"]);
        return $user['name'];  
    }

    // get village name from id
    function getVillageNameID($db, $id) {
        $db->where("id", $id);
        $user = $db->getOne("villages", ["name"]);
        return $user['name'];  
    }

    // get village uuid from id
    function getVillageUUID($db, $id) {
        $db->where("id", $id);
        $user = $db->getOne("villages", ["uuid"]);
        return $user['uuid'];  
    }

    // insert coordinates
    function userCoordinates($db, $payload) {
        $data = [
            "x" => $payload['x'], 
            "y" => $payload['y'], 
            "z" => $payload['z'], 
            "world" => $payload['world'], 
	    "uuid" => getUUIDUsername($db, $payload['username']),
            "user_id" => getUsernameID($db, $payload['username']), 
            "t" => time()
        ];
        $insert = $db->insert("user_coordinate_history", $data);
        if(!$insert) {
            logError($db, "Error inserting user coordinates : " . $db->getLastError());
        }
    }

        // insert village
    function insertVillage($db, $payload) {
        $data = [
            "uuid" => $payload['uuid'], 
            "name" => $payload['name'], 
            "owner" => $payload['owner']
        ];
        $insert = $db->insert("villages", $data);
        if(!$insert) {
            logError($db, "Error inserting villages : " . $db->getLastError());
        }
    }
    

    function fetchUser($db, $user) {
        $db->orderby("t", "DESC");
        $db->where("uuid", $user['uuid']);

        $stats = $db->getOne("user_stats");

        if(!$stats) {
            return false;
        }
        else {
            $data = [
                "username" => $user['username'],
                "uuid" => $user['uuid'],
                "lastJoin" => $user['lastJoin'],
                "cape" => $user['cape'],
                "firstJoin" => $user['firstJoin'],
                "group" => $user['g'],
                "money" => $stats['money'],
                "playerDeaths" => $stats['playerDeaths'],
                "playersKilled" => $stats['playersKilled'],
                "joinCount" => $stats['joinCount'],
                "metersTraveled" => $stats['metersTraveled'],
                "trustScore" => $stats['trustScore'],
                "blocksPlaced"  => $stats['blocksPlaced'],
                "playTime" => $stats['playTime'],
                "itemsDropped" => $stats['itemsDropped'],
                "trustLevel" => $stats['trustLevel'],
                "creaturesKilled" => $stats['creaturesKilled'],
                "blocksDestroyed" => $stats['blocksDestroyed']
            ];

            return $data;

        }
    }

    // insert village stats
    function insertVillageStats($db, $id, $payload) {

        $db->where("village_id", $id);
        $db->where("claims", $payload['claims']);
        $db->where("members", json_encode($payload['members'], true));
        $db->where("memberCount", count($payload['members']));
        $db->where("flags", json_encode($payload['flags']));
        $db->where("spawn", json_encode($payload['spawn'], true));
        $db->where("assistants", json_encode($payload['assistants'], true));
        $db->where("assistantsCount", count($payload['assistants']));
        
        $check = $db->getOne("village_stats");

        if(!$check) {            
            $data = [
                "village_id" => $id,
                "claims" => $payload['claims'], 
                "t" => time(),
                "members" => json_encode($payload['members'], true),
                "memberCount" => count($payload['members']),
                "flags" => json_encode($payload['flags']),
                "spawn" => json_encode($payload['spawn'], true),
                "assistants" => json_encode($payload['assistants'], true),
                "assistantsCount" => count($payload['assistants'])
            ];
            $insert = $db->insert("village_stats", $data);
            if(!$insert) {
                logError($db, "Error inserting village stats : " . $db->getLastError());
            }
        }
    }

    // get village stats by newest time
    function getVillageStats($db, $id) {
        $db->where("village_id", $id);
        $db->orderBy("t", "DESC");
        $stats = $db->getOne("village_stats");
        return $stats;
    }

    // insert server player count
    function insertServerPlayerCount($db, $payload) {
        $data = [
            "players" => $payload['onlinePlayers'], 
            "t" => time()
        ];
        $insert = $db->insert("server_history", $data);
        if(!$insert) {
            logError($db, "Error inserting server history : " . $db->getLastError());
        }
    }


    function searchUser($db, $q) {
	$db->orderby("lastJoin", "DESC");

        if(preg_match("/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i", $q)) {
        $db->where("uuid", $q);
        }
        else {

        $db->where("username", $q);

        }

        return $db->getOne("users");

        }

    function searchVillage($db, $q) {
        if(preg_match("/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i", $q)) {
            $db->where("uuid", $q);
        }
        else {
        $db->where("name", $q);
        }

        return $db->getOne("villages");

        }

    // insert users
    function insertUser($db, $payload) {
        // check if user exists
        $db->where("username", $payload['username']);
        $q = $db->getOne("users", ["username"]);
        // only insert if user does not exist
        if(!$q) {
            $data = [
                "username" => $payload['username'], 
                "uuid" => $payload['uuid'], 
                "lastUsername" => $payload['lastUsername'],
                "firstJoin" => $payload['firstJoin'],
                "lastJoin" => $payload['lastJoin'], 
                "g" => group($payload['groups'])
            ];
            $insert = $db->insert("users", $data);
            if(!$insert) {
                logError($db, "Error inserting user : " . $db->getLastError());
            }
        }
    }

    // update users table
    function updateUsers($db, $user_id, $payload) {
        $data = [
            "g" => group($payload['groups']),
            "lastJoin" => $payload['lastJoin'], 
            "lastUsername" => $payload['lastUsername']
        ];
        $db->where("id", $user_id);
        $update = $db->update("users", $data);
        if(!$update) {
            logError($db, "Error updating user : " . $db->getLastError());
        }
    }

    // insert user into stats table
    function insertUserStats($db, $id, $payload) {
        // yeah yeah yeah it works...
        $db->where("user_id", $id);
        $db->where("uuid", $payload['uuid']);
        $db->where("playerDeaths", $payload['playerDeaths']);
        $db->where("playersKilled",$payload['playersKilled']);
        $db->where("joinCount", $payload['joinCount']);
        $db->where("itemDropDetails", json_encode($payload['itemDropDetails'], true));
        $db->where("metersTraveled",$payload['metersTraveled']);
        $db->where("trustScore",$payload['trustScore']);
        $db->where("blockDetailsPlaced",json_encode($payload['blockDetailsPlaced'], true));
        $db->where("blocksPlaced",$payload['blocksPlaced']);
        $db->where("itemsDropped", $payload['itemsDropped']);
        $db->where("blockDetailsDestroyed", json_encode($payload['blockDetailsDestroyed'], true));
        $db->where( "trustLevel", $payload['trustLevel']);
        $db->where("creaturesKilled",$payload['creaturesKilled']);
        $db->where("money", $payload["money"]);
        $db->where("blocksDestroyed", $payload['blocksDestroyed']);
        $db->where("playTime", $payload['playTime']);

        $check = $db->getOne("user_stats");
        if(!$check) {
            $data = [
                "user_id" => getUserID($db, $payload['uuid']),
		"uuid" => $payload['uuid'],
                "playerDeaths" => $payload['playerDeaths'],
                "playersKilled" => $payload['playersKilled'],
                "joinCount" => $payload['joinCount'],
                "itemDropDetails" =>  json_encode($payload['itemDropDetails'], true),
                "metersTraveled" =>	$payload['metersTraveled'],
                "trustScore" =>	$payload['trustScore'],
                "blockDetailsPlaced" =>	json_encode($payload['blockDetailsPlaced'], true),
                "blocksPlaced" => $payload['blocksPlaced'],
                "itemsDropped" => $payload['itemsDropped'],
                "blockDetailsDestroyed" => json_encode($payload['blockDetailsDestroyed'], true),
                "trustLevel" =>	$payload['trustLevel'],
                "creaturesKilled" => $payload['creaturesKilled'],
                "money" =>	$payload["money"],
                "blocksDestroyed" => $payload['blocksDestroyed'],
                "t" => time(),
                "playTime" => $payload['playTime'],
            ];
            $insert = $db->insert("user_stats", $data);
            if(!$insert) {
                logError($db, "Error inserting user stats : " . $db->getLastError());
            }
        }
    }

    // curl server information
    function curlServerInfo() {
        $pl = json_decode(curlData("https://servers.api.legacyminecraft.com/api/v1/getServer?serverip=mc.retromc.org&port=25565"), true);
        if(!$pl) {
            return false;
        }
        else {
            return $pl;
        }        
    }

        // curl bans information by pages, only if there is data in page
        function curlBans($page) {
            $bans = json_decode(curlData("https://bans.johnymuffin.com/api/v1/getBans?page=" . $page), true);
            if(!$bans) {
                return false;
            }
            else {
                if(!empty($bans['bans'])) {
                    return $bans['bans'];
                }
                else {
                    return false;
                }
            }        
        }

        // curl the ban info by id
        function curlBansInformation($id) {
            $ban = json_decode(curlData("https://bans.johnymuffin.com/api/v1/getBanInfo?banID=" . $id), true);
            if(!$ban) {
                return false;
            }
            else {
                return $ban;
            }        
        }

    

    // check if a player is online
    function isPlayerOnline($db, $username) {
        $s = curlServerInfo();
        $check = searchArray($s['players'],'username',$username);
        if($check) {
            return json_encode(["status" => "online", "z" => floor($check['z']), "x" => floor($check['x']), "y" => floor($check['y'])], true);
        }
        else {
            return json_encode(["status" => "offline"], true);
        }
    }

    // curl player information
    function curlPlayerInfo($uuid) {
        $data = json_decode(curlData("https://statistics.johnymuffin.com/api/v1/getUser?serverID=0&uuid=" . $uuid), true);
        if($data['found'] == true) {
            return $data;
        }
        else {
            return false;
        }
    }

    // curl village information
    function curlVillageInfo($uuid) {
        $data = json_decode(curlData("https://api.retromc.org/api/v1/village/getVillage?uuid=". $uuid), true);
        if($data['found']) {
            return $data;
        }
        else {
            return false;
        }
    }

    // curl all villages
    function curlAllVillages() {
        $data = json_decode(curlData("https://api.retromc.org/api/v1/village/getVillageList"), true);
        if($data) {
            return $data;
        }
        else {
            return false;
        }
    }

    // curl village player village 
    function curlVillagePlayerVillage($uuid) {
        $data = json_decode(curlData("https://api.retromc.org/api/v1/village/getPlayerVillage?uuid=". $uuid), true);
        if($data['found']) {
            return $data;
        }
        else {
            return false;
        }
    }

    // parse group
    function group($data) {
        return $data[0];
    }

    // insert into logs if there an some error
    function logError($db, $payload) {
        $db->insert("logs", ["msg" => $payload, "t" => time()]);
    }

    // get username/uuid because johny didn't store it in valid, just uuids for server data uuids :(
    function userUUID($u) {
        $data = json_decode(curlData("https://api.ashcon.app/mojang/v2/user/". $u), true);
        if($data) {
            return $data;
        }
        else {
            return false;
        }
    }
    
    // try to fetch the user's cape
    function fetchCape($db, $id) {
        $db->where("id", $id);
        $user = $db->getOne("users", ["uuid", "id"]);
        $cape = curlData("https://capes.johnymuffin.com/storage/" . $user['uuid'] . '.png');
        // only do stuff if the cape is found
        if($cape) {
            $capeURL = 'data:image/png;base64,' . base64_encode($cape);
            $db->where("id", $user['id']);
            $update = $db->update("users", ["cape" => $capeURL]);
            if(!$update) {
                logError($db, "Error updating cape  : " . $db->getLastError());
        }
    }
   }

?>
