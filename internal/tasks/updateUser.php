<?php

include_once("../backbone.php");

// step 1 loop through the users with multiple UUIDS
$db->groupby("uuid");
$db->having("count(*)>=2");
$users = $db->get("users");

if($users) {
foreach ($users as $user) {

    // step 2 get all the data for the dupes
    $db->where("uuid", $user['uuid']);
    $u2 = $db->get ("users");

    // if the user for the uuid is greater than 1 than it's a duplicate
        foreach ($u2 as $u) {
        $db->groupby("user_id");
        $db->where("user_id", $u['id']);
        $check = $db->getOne("user_stats");

        // if the user id isn't in the user_stats table then it doesn't need to be in 'users'
        if(!$check) {
            $db->where("id", $u['id']);
            $db->delete("users");
        }
        else {
            // now, update the dupe
            $d = userUUID($u['uuid']);
            $d2 = curlPlayerInfo($u['uuid']);

            $db->where("id", $check['user_id']);
            $data = [
                "username" => $d['username'],
                "lastJoin" => $u['lastJoin'],
                "g" => $u['g'],
                "cape" => $u['cape']
            ];

            $db->update("users", $data);
        }
    }
}
}
else {
echo "Nothing to update";
}

?>
