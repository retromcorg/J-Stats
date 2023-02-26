<?php


include_once("../../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');


if($_GET) {
    if($_GET['category']) {
    $c = htmlspecialchars(strip_tags($_GET['category']));
    if(!array_key_exists($c,$lb_methods)) {
        echo json_encode(["status" => "error", "code" => 4, "msg" => "category does not exist", "categories" => array_keys($lb_methods)],true);
        die();

    }
    else {

        $builder = [];
        $builder['type'] = 'player';
    
        if(in_array($c, ['assistantsCount', 'memberCount', 'claims'])) {
            $db->orderby("$c", "DESC");
            $db->groupby("village_id");
            $d = $db->get("village_stats", 25, "MAX($c) as $c,village_id");
            $builder['type'] = 'village';
            }
            
            elseif($c == 'mostChatMessages') {
            $db->groupBy("username");
            $db->orderBy("cnt", "DESC");
            $d = $db->get("user_chats", 25, "COUNT(username) as cnt,uuid,username");
            }
            else {
            $db->orderBy("$c", "DESC");
            $db->groupBy("user_id");
            $d = $db->get("user_stats", 25, "max($c) as $c, user_id");
            }
            

            $builder['category_name'] = $lb_methods[$c];
            $builder['category'] = $c;
            $builder['data'] = [];
            $builder['status'] = "success";

            foreach ($d as $k => $row) {
                if(!in_array($c, ['mostChatMessages', 'assistantsCount', 'memberCount', 'claims'])) {
                    $builder['data'][] = [
                        "key" => getUsername($db, $row['user_id']),
                        "uuid" => getUUID($db, $row['user_id']),
                        "value" => $row[$c]
                    ];
                }
                
                if(in_array($c, ['assistantsCount', 'memberCount', 'claims'])) {
                    $builder['data'][] = [
                        "key" => getVillageNameID($db, $row['village_id']),
                        "uuid" => getVillageUUID($db, $row['village_id']),
                        "value" => $row[$c]
                    ];
                }
                if($c == 'mostChatMessages') {
                    $builder['data'][] = [
                        "key" => $row['username'],
                        "uuid" => $row['uuid'],
                        "value" => $row['cnt']
                    ];
                }
            }

            echo json_encode($builder, true);
    }
}else {
    echo json_encode(["status" => "error", "code" => 3, "msg" => "category parameter needed"],true);
    die();
}

}
else {
    echo json_encode(["status" => "error", "code" => 3, "msg" => "category parameter needed"],true);
    die();
}



?>
