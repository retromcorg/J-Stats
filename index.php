<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Home Page">
<meta name="description" content="Get Statistics and information from RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz">
<link rel="icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<div class="fetchServers"></div>

<div class="card bg-dark">
<div class="card-header">
<strong>Introduction</strong>
</div>
<div class="card-body">    
<p>J-Stats is a website that provides information about players on <strong>RetroMC</strong>.</p>

<p>Some of the data that this site keeps records of:</p>
<ul>
<li>Global Leaderboard</li>
<li>Staff Members</li>
<li>Villages</li>
<li>Ingame User Capes</li>
<li>Basic User Information</li>
<li>User Coordinates</li>
<li>Server Player Count</li>
<li>User Statistics</li>
<ul>
<li>Player Balance</li>
<li>Player Deaths</li>
<li>Player Kills</li>
<li>Mob Kills</li>
<li>Meters Traveled</li>
<li>Trust Score</li>
<li>Blocks Placed</li>
<li>Blocks Destroyed</li>
</ul>
</ul>
<small>There's more, just I can't be bothered to list it all out.</small>
</div>
</div>


<?php

if($_GET) {
$m = htmlspecialchars(strip_tags($_GET['msg'])); 

if(isset($m)) {
if($m == 0) {
echo '<script>Swal.fire({
title: "Empty Input",
icon: "error",
text: "Please enter a username/uuid.",
allowOutsideClick: false,
allowEscapeKey: false
});</script>';
}
elseif($m ==23) {
echo '<script>Swal.fire({
title: "Empty Input",
icon: "error",
text: "Village could not be fetched.",
allowOutsideClick: false,
allowEscapeKey: false
});</script>';
}
elseif($m == 3) {
echo '<script>Swal.fire({
title: "Not found",
icon: "error",
text: "This village could not be found",
allowOutsideClick: false,
allowEscapeKey: false
});</script>';
}
else {
echo '<script>Swal.fire({
title: "Not found",
icon: "error",
text: "This user has not joined the server",
allowOutsideClick: false,
allowEscapeKey: false
});</script>';
}
}
}
?>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
