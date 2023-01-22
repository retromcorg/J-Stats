<?php

include_once("internal/backbone.php");

$u = htmlspecialchars(strip_tags($_GET['u']));
$n = getUsernameUUID($db,$u);

// check if get parameters is met 
if(!isset($u)) {
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
<meta name="description" content="View <?php echo $n ?>'s Profile on RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <meta content="https://crafatar.com/avatars/<?php echo $user['uuid'] ?>?size=128&overlay" property="og:image" />
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
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
if(isStaff(group($user['groups']))) {
?>
<span data-toggle="tooltip" data-placement="left" title="This user has a rainbow name because they're a staff member."  class="rainbow rainbow_text_animated"><?php echo $n ?> </span>
<?php
}
else {
echo '<span class="banned">' . $n . '</span>';
} ?>
<span id="status" class="status-result"></span></h2>
</div>
<div class="item">
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
<label class='col-6 col-md-6' style='font-weight: bold;'><a data-toggle="tooltip" data-placement="right" title="Click to view user's money activity"  href="./activity?u=<?php echo $u; ?>&a=money">Money</a></label>
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
<div class="card-title own" style="display: none;">
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
<label class='col-6 col-md-8' style='font-weight: bold;'><a data-toggle="tooltip" data-placement="right" title="Click to view user's Mob kill activity"  href="./activity?u=<?php echo $u; ?>&a=creaturesKilled">Mob Kills</a></label>
<?php  echo $user['creaturesKilled']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Deaths</label>
<?php  echo $user['playerDeaths']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'><a data-toggle="tooltip" data-placement="right" title="Click to view user's Block Travel activity"  href="./activity?u=<?php echo $u; ?>&a=metersTraveled">Blocks Traveled</a></label>
<?php  echo $user['metersTraveled']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'>Blocks Placed</label>
<?php  echo $user['blocksPlaced']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'><a data-toggle="tooltip" data-placement="right" title="Click to view user's break block activity"  href="./activity?u=<?php echo $u; ?>&a=blocksDestroyed">Blocks Broken</a></label>
<?php  echo $user['blocksDestroyed']; ?>
</div>

<div class="card-title">
<label class='col-6 col-md-8' style='font-weight: bold;'><a data-toggle="tooltip" data-placement="right" title="Click to view user's item drop activity"  href="./activity?u=<?php echo $u; ?>&a=itemsDropped">Items Dropped</a></label>
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
