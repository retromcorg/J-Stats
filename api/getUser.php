<?php

include_once("../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

if (!isset($_GET['user'])) {
echo json_encode(["status" => "error", "code" => 3, "msg" => "no username/uuid"], true);
die();
}
else {
$u = htmlspecialchars(strip_tags($_GET['user']));
$user = searchUser($db, $u);

if($user) {

echo json_encode(["status" => "success", "username" => $user['username'], "uuid" => $user['uuid']], true);
}
else {

echo json_encode(["status" => "error", "code" => 2, "msg" => "This user was not found"], true);
die();
}
}

?>
