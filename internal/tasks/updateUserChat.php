<?php

include_once("../backbone.php");

$db->orderby("t", "DESC");

$logs = $db->get("chat_logger",50);

foreach ($logs as $log) {
	
	$msg = $log['content'];

	$p = "/^[\*\*{1,2}[^A-Za-z0-9_]{1,20}[:][^*\*\*]*/";

	if(preg_match($p, $msg)) {
	$parse = explode(":", $msg);

	$author = strip($parse[0]);
	$e =  getUUIDUsername($db, $author);

	unset($parse[0]);

	$final = htmlspecialchars(implode(":", $parse));

	$t = floor($log['t'] / 1000);

    $db->where("username", $author);
    $db->where("uuid", $e);
    $db->where("msg", base64_encode($final));
    $check = $db->getOne("user_chats");
    if(!$check) {
        $data = [
            "username" => $author,
            "uuid" => $e,
            "t" => $t,
            "msg" => base64_encode($final)
        ];
	$db->insert("user_chats", $data);

    }
}
}

?>
