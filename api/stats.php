<?php

include_once("../internal/backbone.php");

header('Content-type: application/json; charset=utf-8');

// users
$c = $db->getOne("users", "COUNT(id) as cnt");

// daily
$db->where("firstJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 24 HOUR)");
$c2 = $db->getOne("users", "count(id) as cnt");

// weekly
$db->where("firstJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 7 DAY)");
$c3 = $db->getOne("users", "count(id) as cnt");

// monthly
$db->where("firstJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 30 DAY)");
$c4 = $db->getOne("users", "count(id) as cnt");

// cape users
$db->where("cape", "", "!=");
$ca = $db->getOne("users", "count(id) as cnt");

// staff
$db->where("g",$staff ,"IN");
$h = $db->getOne("users", "COUNT(id) as cnt");

// villages
$v = $db->getOne("villages", "COUNT(id) as cnt");

echo json_encode([
    "total_users" => $c['cnt'],
    "daily_users" => $c2['cnt'],
    "weekly_users" => $c3['cnt'], 
    "monthly_users" => $c4['cnt'] , 
    "cape_users" => $ca['cnt'],
    "staff_users" => $h['cnt'],
    "total_villages" => $v['cnt']
], true);


?>
