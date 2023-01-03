<?php

    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // error_reporting(0);

    include_once(dirname(__FILE__) . '/funcs.php');
    include_once(dirname(__FILE__) . '/db.php');
    include_once(dirname(__FILE__) . '/MinecraftColors.php');

    use \Spirit55555\Minecraft\MinecraftColors;

    // available groups
    $groups = [
        "admin" => "&4Admin",
        "moderator" => "&6Moderator",
        "helper" => "&3Helper",
        "wanderer" => "&8Wanderer",
        "donator" => "&cDonator",
        "mystic" => "&bMystic",
        "citizen" => "&aCitizen",
        "trusted" => "&6[&aCitizen&6]",
        "hero" => "&2Hero",
        "legend" => "&1Legend",
        "veteran" => "&bSen&2ior",
    ];

    // minecraft color helper
    function minecraftColor($text) {
        return MinecraftColors::convertToHTML($text);
    }

    // if a user is a staff member
    function isStaff($group) {
        if(in_array($group, ["helper", "moderator", "admin"])) {
            return true;
        }
        else {
            return false;
        }
    }

?>