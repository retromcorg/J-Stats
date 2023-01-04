<?php

include_once("internal/backbone.php");

$u = htmlspecialchars(strip_tags($_GET['u']));
$n = htmlspecialchars(strip_tags($_GET['n']));

// check if get parameters is met 
if(!isset($u) || !isset($n)) {
header("Location: ./?msg=0");
}
else {

$user = curlPlayerInfo($u);

if(!$user) {
header("Location: ./?msg=1");
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | <?php echo $n ?>">
<meta name="description" content="<?php echo $n ?>'s Profile on RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/player?u=<?php echo $u ?>&n=<?php echo $n ?>">
<link rel="icon" href="https://crafatar.com/avatars/<?php echo $user['uuid'] ?>?size=128&overlay">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | <?php echo $n ?></title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">


<div class="d-flex justify-content-between">
<div class="item">
<h2>

<?php
// only cool people get rainbow colors
if($user['uuid'] == '3e613ca1-2636-4bd4-bb0b-d47086269030' || $user['uuid'] == 'db7db941-6923-4855-a879-1ae655c16122'|| isStaff(group($user['groups']))) {
?>
<span data-toggle="tooltip" data-placement="left" title="This user has a rainbow name because they're either a staff member, or someone that helped with the site."  class="rainbow rainbow_text_animated"><?php echo $n ?> </span>
<?php
}
else {
echo '<span class="banned" data-toggle="banned" data-placement="left" title="This user has this color because they have been banned from the server.">' . $n . '</span>';
} ?>
<span id="status" class="status-result"></span></h2>
</div>
<div class="item">
<?php
// only cool people get their github listed
if($user['uuid'] == '3e613ca1-2636-4bd4-bb0b-d47086269030' || $user['uuid'] == 'de552446-fd94-49a4-9dfc-ca2c515aa334') {
echo '<h2><a href="https://github.com/codenamesui" data-toggle="tooltip" data-placement="left" title="codenamesui" class="text-danger"><span class="fa fa-github"></span></a></h2>';
}

elseif($user['uuid'] == '2cfc6452-a6b4-4c49-982e-492eaa3a14ec') {
echo '<h2><a href="https://github.com/RhysB" data-toggle="tooltip" data-placement="left" title="RhysB" class="text-danger"><span class="fa fa-github"></span></a></h2>';
}
?>

<input type="hidden" id="q_username" name="username" value="<?php echo $n; ?>">
<input type="hidden" id="q_uuid" value="<?php echo $u;?>">

</div>
</div>
<div class="d-flex justify-content-between">

<div class="item">
<?php echo $user['uuid'] ?> <span class="fa fa-clipboard copybtn text-primary" data-clipboard-text="<?php echo $user['uuid'] ?>"></span>
</div>
<div class="item">
<span class="coords">x: <strong id="x"></strong>, y: <strong id="y"></strong>, z: <strong id="z"></strong></span>
</div>
</div>

<hr>

<div class="row">

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">
<strong>Information</strong>
</div>
<div class="card-body"> 

<div class="card-title">
<label class='col-6 col-md-6' style='font-weight: bold;'>Rank</label>
<?php echo minecraftColor($groups[group($user['groups'])]); ?>
</div>

<div class="card-title">
<label class='col-6 col-md-6' style='font-weight: bold;'>Playtime</label>
<span data-toggle="tooltip" data-placement="right" title="<?php  echo secondsToWords($user['playTime']); ?>"><?php  echo secondsToWordsMini($user['playTime']); ?> hours</span>
</div>

<div class="card-title">
<label class='col-6 col-md-6' style='font-weight: bold;'>Money</label>
<?php echo floor($user['money']) ?>
</div>

<div class="card-title">
<label class='col-6 col-md-6' style='font-weight: bold;'>Level</label>
<?php echo $user['trustLevel'] ?>
</div>

<div class="card-title">
<label class='col-6 col-md-6' style='font-weight: bold;'>Score</label>
<?php echo floor($user['trustScore']) ?>
</div>

<div class="card-title">
<label class='col-6 col-md-6' style='font-weight: bold;'>First Join</label>
<span data-toggle="tooltip" data-placement="right" title="<?php  echo unix($user['firstJoin']); ?>"><?php echo to_time_ago($user['firstJoin']) ?> ago</span>
</div>

<div class="card-title">
<label class='col-6 col-md-6' style='font-weight: bold;'>Last Join</label>
<span data-toggle="tooltip" data-placement="right" title="<?php  echo unix($user['lastJoin']); ?>"><?php echo to_time_ago($user['lastJoin']) ?> ago</span>
</div>
</div>
</div>
<br>

<div class="card bg-dark villages">
<div class="card-header">
<strong>Village Info</strong>
</div>
<div class="card-body">
<div class="card-title own"style="display: none;">
<label class='col-6 col-md-6' style='font-weight: bold;'>Owns</label>
<span id="owned"><span>
</div>
<div class="card-title mem" style="display: none;">
<label class='col-6 col-md-6' style='font-weight: bold;'>Member In</label>
<span id="member"><span>
</div>
<div class="card-title asst" style="display: none;">
<label class='col-6 col-md-6' style='font-weight: bold;'>Assistant In</label>
<span id="assistant"><span>
</div>
</div>
</div>

</div>

<div class="col-lg-4 justify-content-center">
<canvas id="skin_container"></canvas>
<br>

</div>

<div class="col-lg-4">

<div class="card bg-dark">
<div class="card-header">
<strong>Actions</strong>
</div>
<div class="card-body">
<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Kills</label>
<?php  echo $user['playersKilled']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Mobs killed</label>
<?php  echo $user['creaturesKilled']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Deaths</label>
<?php  echo $user['playerDeaths']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Blocks Traveled</label>
<?php  echo $user['metersTraveled']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Blocks Placed</label>
<?php  echo $user['blocksPlaced']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Blocks broken</label>
<?php  echo $user['blocksDestroyed']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Items Dropped</label>
<?php  echo $user['itemsDropped']; ?>
</div>

</div>
</div>


<br>


<div class="card bg-dark bans">
<div class="card-header">
<strong>Ban Info</strong>
</div>
<div class="card-body">
<div class="card-title own"style="display: none;">
<label class='col-6 col-md-6' style='font-weight: bold;'>Total Bans</label>
<span id="total-bans"></span>
</div>
<div class="card-title ban-list" style="display: none;">
<label class='col-6 col-md-6' style='font-weight: bold;'>Bans</label>
<button type="button" id="view" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">View bans</button>

</div>
</div>
</div>


  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content bg-dark">
        <div class="modal-header bg-dark">
          <h4 class="modal-title bg-dark"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body bg-dark"></div>
        <div class="modal-footer bg-dark">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


</div>

</div>



</div>
</div>
</div>

<script src="assets/js/skinview3d.bundle.js"></script>
<script src="assets/js/player.js"></script>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
