<?php

    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // error_reporting(0);

    include_once(dirname(__FILE__) . '/funcs.php');
    include_once(dirname(__FILE__) . '/db.php');
    include_once(dirname(__FILE__) . '/MinecraftColors.php');
    include_once(dirname(__FILE__) . '/Zebra_Pagination.php');

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
    	"donatorplusplus" => "&cDonator++",
	    "developer" => "&c&oDeveloper"
    ];

    // minecraft color helper
    function minecraftColor($text) {
        return MinecraftColors::convertToHTML($text);
    }

    // if a user is a staff member
    function isStaff($group) {
        if(in_array($group, ["helper", "developer", "moderator", "admin"])) {
            return true;
        }
        else {
            return false;
        }
    }

    // top methods
    $methods = [
        "money" => "Balance", 
        "playerDeaths" => "Player Deaths",
        "trustScore" => "Trust Score",
        "playersKilled" => "Players Killed", 
        "joinCount" => "Join Count", 
        "metersTraveled" => "Blocks Traveled", 
        "blocksPlaced" => "Blocks Placed", 
        "playTime" => "Playtime", 
        "itemsDropped" => "Items Dropped",
        "trustLevel" => "Trust Level",
        "creaturesKilled" => "Mobs Killed", 
        "blocksDestroyed" => "Blocks destroyed"
    ];

?>
