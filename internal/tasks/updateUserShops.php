<?php

include_once("../backbone.php");

$d = $db->get("user_signs");

foreach($d as $d2) {
    $e = explode(PHP_EOL, $d2['msg']);

    $pattern = "/^(B|S){1}[0-9]( ?)[0-9]*/";

    if(isset($e[2])) {
        if(preg_match($pattern, $e[2])) {

            $db->where("username", $e[0]);
            $db->where("amount", $e[1]);
            $db->where("price", $e[2]);
            $db->where("item", $e[3]);
            $db->where("sign_id", $d2['id']);

            $check = $db->getOne("user_shops");
            if(!$check) {
            $data = [
                "sign_id" => $d2['id'],
                "username" => $e[0],
                "amount" => $e[1],
                "price" => $e[2],
                "item" => $e[3]
            ];
            $db->insert("user_shops", $data);
        }
    }
}
}

?>