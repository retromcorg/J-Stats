<?php

include_once("../internal/backbone.php");


header('Content-type: application/json; charset=utf-8');

$db->where("g",["trusted", "citizen"] ,"IN");
$u = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["citizen"] ,"IN");
$u2 = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["trusted"] ,"IN");
$u1 = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g","veteran");
$va = $db->getOne("users", "COUNT(id) as cnt");

$db->where("g","wanderer");
$n = $db->getOne("users", "COUNT(id) as cnt");

$v = $db->getOne("villages", "COUNT(id) as cnt");


$c = $db->getOne("users", "COUNT(id) as cnt");

$db->where("g",["admin","helper", "developer", "moderator"] ,"IN");
$h = $db->getOne("users", "COUNT(id) as cnt");

$db->where("g",["admin"] ,"IN");
$h1 = $db->getOne("users", "COUNT(id) as cnt");
$db->where("g",["helper"] ,"IN");
$h2 = $db->getOne("users", "COUNT(id) as cnt");
$db->where("g",["moderator"] ,"IN");
$h3 = $db->getOne("users", "COUNT(id) as cnt");
$db->where("g",["developer"] ,"IN");
$h4 = $db->getOne("users", "COUNT(id) as cnt");

$db->where("firstJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 24 HOUR)");
$last24h = $db->getOne("users", "count(id) as cnt");

$db->where("firstJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 7 DAY)");
$w = $db->getOne("users", "count(id) as cnt");

$db->where("cape", "", "!=");
$ca = $db->getOne("users", "count(id) as cnt");

$db->where("firstJoin > UNIX_TIMESTAMP(NOW() - INTERVAL 30 DAY)");
$m = $db->getOne("users", "count(id) as cnt");

$db->where("g",["mystic","hero", "donator", "legend"] ,"IN");
$p = $db->getOne("users", "COUNT(id) as cnt");



$db->where("g",["mystic","hero", "donator", "legend"] ,"IN");
$p = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["mystic","hero", "donator", "legend"] ,"IN");
$p = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["mystic","hero", "donator", "legend"] ,"IN");
$p = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["mystic","hero", "donator", "legend"] ,"IN");
$p = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["mystic","hero", "donator", "legend"] ,"IN");
$p = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["mystic"] ,"IN");
$p4 = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["hero"] ,"IN");
$p5 = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["donator"] ,"IN");
$p6 = $db->getOne("users", "COUNT(id) as cnt");


$db->where("g",["legend"] ,"IN");
$p7 = $db->getOne("users", "COUNT(id) as cnt");



$db->where("g",["donatorplusplus"] ,"IN");
$p8 = $db->getOne("users", "COUNT(id) as cnt");

echo json_encode([
    "total_users" => $c['cnt'],
    "daily_users" => $last24h['cnt'],
    "weekly_users" => $w['cnt'], 
    "monthly_users" => $m['cnt'] , 
    "non_rank_users" => $n['cnt'],
    "veteran_users" => $va['cnt'],
    "cape_users" => $ca['cnt'],
    "playtime_rank_users" => [
        "total_count" => $u['cnt'], 
        "count_by_ranks" => [
            "trusted" => $u1['cnt'],
            "citizen" => $u2['cnt']
    ]],
    "donator_rank_users" => [
        "total_count" => $p['cnt'],
        "count_by_ranks" => [
            "mystic" => $p4['cnt'],
            "hero" => $p5['cnt'],
            "donator" => $p6['cnt'],
            "legend" => $p7['cnt'],
            "donatorplusplus" => $p8['cnt']
        ]
    ], 
    "staff" => [
        "total_count" => $h['cnt'], 
        "count_by_ranks" => [
        "admin" => $h1['cnt'],
        "moderator" => $h2['cnt'],
        "helper" => $h3['cnt'],
	"developer" => $h4['cnt']
    ]
    ]
], true);


?>
