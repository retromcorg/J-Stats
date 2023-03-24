<?php

include_once("../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

$key = "lgfio4jr3gjitg983g99853hgh34g893ghu";


if(!isset($_GET['key']) || $_GET['key'] != $key) {
	echo json_encode(["status" => "error", "code" => 1, "msg" => "no access"], true);
	die();
}
elseif (!isset($_GET['user'])) {
	echo json_encode(["status" => "error", "code" => 3, "msg" => "no username/uuid"], true);
	die();
}
else {
	$u = htmlspecialchars(strip_tags($_GET['user']));
	$user = searchUser($db, $u);

	if($user) {
		$us = curlPlayerInfo($user['uuid']);
		insertUserStats($db, $user['id'], $us);
		updateUsers($db, $user['id'], $us);

		echo json_encode(["status" => "success","msg" => "forcefully updated user"], true);
		die();
	}
	else {
		echo json_encode(["status" => "error", "code" => 2,"msg" => "no user in db"], true);
		die();
	}
}

?>
