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
        "admin" => "&4&lAdmin",
        "moderator" => "&6&lModerator",
        "helper" => "&3&lHelper",
        "wanderer" => "&8Wanderer",
        "donator" => "&cDonator",
        "mystic" => "&bMystic",
        "citizen" => "&aCitizen",
        "trusted" => "&6[&aCitizen&6]",
        "hero" => "&2Hero",
        "legend" => "&1Legend",
        "veteran" => "&aSen&1ior",
    	"donatorplusplus" => "&cDonator++",
        "donator+" => "&cDonator+",
        "trial" => "&aTrial Helper",
        "undercovermod"=> "&bUndercover Mod",
        "developer" => "&c&lDeveloper"
    ];

    $staff = ["helper", "undercovermod", "trial", "developer", "moderator", "admin"];

    // minecraft color helper
    function minecraftColor($text) {
        return MinecraftColors::convertToHTML($text);
    }

    // if a user is a staff member
    function isStaff($group) {
        if(in_array($group, ["helper", "undercovermod", "trial", "developer", "moderator", "admin"])) {
            return true;
        }
        else {
            return false;
        }
    }

    // leaderboard methods
    $lb_methods = [
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
        "blocksDestroyed" => "Blocks destroyed",
        "memberCount" => "Village Members",
        "assistantsCount" => "Village Assistants",
        "claims" => "Village Claims",
        "mostChatMessages"  => "Most Messages"
    ];

    // stats methods
    $stats_methods = [
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
