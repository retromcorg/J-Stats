<?php

include_once("internal/backbone.php");

$u = htmlspecialchars(strip_tags($_GET['u']));

// check if get parameters is met 
if(!isset($u)) {
    header("Location: ./?msg=2");
}

$db->where("uuid", $u);
$v = $db->getOne("villages");

if(!$v) {
    header("Location: ./?msg=3");
}
else {

$v2 = getVillageStats($db, $v['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Village <?php echo $v['name'] ?>">
<meta name="description" content="View Village <?php echo $v['name'] ?> using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/village?u=<?php echo $v['uuid'] ?>">
<link id="favicon" rel="icon" href="assets/img/icon.png">
<link rel="apple-touch-icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Village <?php echo $v['name'] ?></title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2><?php echo $v['name'] ?></h2>
<?php
$e = getUsernameUUID($db,$v['owner']);
?>
<p>Village <?php echo $v['name'] ?>'s Information owned by <strong><a href="./player?u=<?php echo $v['owner'] ?>&n=<?php echo $e; ?>"><?php echo $e; ?></a></strong></p>
<div class="row">
    <div class="col-lg-4">
    
    <div class="card bg-dark">
    <div class="card-header">Location</div>
    <div class="card-body">
    <?php
    
    $spawn = json_decode($v2['spawn'], true);

    ?>
    <div class="card-title">
    <label class='col-6 col-md-6' style='font-weight: bold;'>x</label>
    <?php echo $spawn['x'] ?>
    </div>

    <div class="card-title">
    <label class='col-6 col-md-6' style='font-weight: bold;'>y</label>
    <?php echo $spawn['y'] ?>
    </div>
    <div class="card-title">
    <label class='col-6 col-md-6' style='font-weight: bold;'>z</label>
    <?php echo $spawn['z'] ?>
    </div>
    </div>
    </div>
    <br>    
    </div>
    <div class="col-lg-4">

    <div class="card bg-dark">
    <div class="card-header">Flags</div>
    <div class="card-body">
    <?php
    $rule = json_decode($v2['flags'], true);
    ?>
    <div class="card-title">
    <label class='col-6 col-md-8' style='font-weight: bold;'>Invite enabled?</label>
    <?php echo ft($rule['MEMBERS_CAN_INVITE']) ?>
    </div>
    <div class="card-title">
    <label class='col-6 col-md-8' style='font-weight: bold;'>Mob Spawn Enabled?</label>
    <?php echo ft($rule['MOBS_CAN_SPAWN']) ?>
    </div>

    <div class="card-title">
    <label class='col-6 col-md-8' style='font-weight: bold;'>Outside Altering?</label>
    <?php echo ft($rule['RANDOM_CAN_ALTER']) ?>
    </div>
    </div>
    </div>
    <br>    
    </div>
    <div class="col-lg-4">
    <div class="card bg-dark">
    <div class="card-header">Statistic</div>
    <div class="card-body">
    <?php
    $rule = json_decode($v2['flags'], true);
    ?>
    <div class="card-title">
    <label class='col-6 col-md-6' style='font-weight: bold;'>Assistants</label>
    <?php echo $v2['assistantsCount'] ?>
    </div>
    <div class="card-title">
    <label class='col-6 col-md-6' style='font-weight: bold;'>Members</label>
    <?php echo $v2['memberCount'] ?>
    </div>

    <div class="card-title">
    <label class='col-6 col-md-6' style='font-weight: bold;'>Claimes</label>
    <?php echo $v2['claims'] ?>
    </div>
    </div>
    </div>
    <br>    
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
    <div class="card bg-dark">
    <div class="card-header">Assistants</div>
    <div class="card-body" style="max-height: 200px; overflow: scroll;">
    <ul>
    <?php

    $a = json_decode($v2['assistants'], true);

    if(empty($a)) {
        echo "<li>No Assistants in this Village.</li>";
    }
    foreach ($a as $b) {
        $n = getUsernameUUID($db,$b);
        echo '<li><a href="./player?u='. $b . '&n='. $n .'">'. $n .'</a></li>';
    }

    ?>

    </ul>
    </div>
</div>
<br>
</div>
    <div class="col-lg-6">
    <div class="card bg-dark">
    <div class="card-header">Members</div>
    <div class="card-body" style="max-height: 200px; overflow: scroll;">
    <ul>
    <?php


    $b = json_decode($v2['members'], true);

    if(empty($b)) {
        echo "<li>No others in this Village.</li>";
    }
    foreach ($b as $c) {
        $n = getUsernameUUID($db,$c);
        echo '<li><a href="./player?u='. $c . '&n='. $n .'">'. $n .'</a></li>';
    }

    ?>

    </ul>
    </div>
</div>  
    </div>
</div>

</div>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
<?php
}
?>
