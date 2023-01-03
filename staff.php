<?php

include_once("internal/backbone.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Staff">
<meta name="description" content="View all Staff on RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/staff">
<link id="favicon" rel="icon" href="assets/img/icon.png">
<link rel="apple-touch-icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Staff</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2>Staff</h2>
<p>Meet all the Staff on RetroMC</p>

<div class="row">
<?php

$db->where("g",["admin","helper", "moderator"] ,"IN");
$ca = $db->get("users");

foreach($ca as $c) {
?>
<div class="col-lg-4 justify-content-center">

<div class="card bg-dark" style="width:65%">
<div class="card-header">
<div class="d-flex justify-content-between">

<div class="item">
<a href="./player?u=<?php echo $c['uuid'] ?>&n=<?php echo $c['username'] ?>"><?php echo $c['username'] ?></a>
</div>
<div class="item">
<?php echo minecraftColor($groups[$c['g']]); ?>
</div>
</div>


</div>

<img class="card-img-bottom" src="https://crafatar.com/avatars/<?php echo $c['uuid'] ?>?size=250&overlay" alt="<?php echo $c['username'] ?>'s Skin" style="width:100%">
</div>
<br>
</div>
<?php
}
?>
</div>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
