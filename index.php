<?php
include_once("internal/backbone.php");

$stats = json_decode(curlData("https://j-stats.xyz/api/stats"), true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Home Page">
<meta name="description" content="Get Statistics and information from RetroMC using J-Stats!">
    <meta name="theme-color" content="#111111">
    <meta content="https://j-stats.xyz/assets/img/icon.png" property="og:image" />
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">
<h2>J-Stats</h2>
<p><strong class="text-info"><?php echo $stats['total_users']; ?></strong> users - <strong class="text-info"><?php echo $stats['total_villages'] ?></strong> villages - <strong class="text-info"><?php echo $stats['staff_users'] ?></strong> staff - <strong class="text-info"><?php echo $stats['cape_users'] ?></strong> capes</p>
<div class="card bg-dark">
<div class="card-header">
<strong>Introduction</strong>
</div>
<div class="card-body">    
<p>J-Stats is a website that provides information about players on <strong>RetroMC</strong>.</p> 

<p>Some of the features that this site provides:</p>
<ul>
<li>Global Server Leaderboard</li>
<li>List of Staff Members</li>
<li>List of Villages</li>
<li>All the Beta Evolutions Capes</li>
<li>Server Player List and historic graph</li>
<li>User Information Lookup:</li>
<ul>
<li>Skin/Beta Evolution cape preview</li>
<li>Ban history and information</li>
<li>Villages they own/member of or assistant in</li>
<li>First Join and Last Join dates</li>
</ul>
<li>And More</li>
</ul>



</div>
</div>


<div class="card bg-dark" style="margin-top:30px" id="credit">
<div class="card-header">
<strong>How it works</strong>
</div>
<div class="card-body">
<p>You can search for your username, see Beta Evolutions capes, villages and more.</p>

<ul>
    <li>Villages</li> - Updates every 30 minutes</li>
    <li>Leaderboards</li> - Updates every 10 minutes</li>
    <li>Players</li> - Updates when you log off of RetroMC</li>
</ul>
</div>
</div>

<div class="card bg-dark" style="margin-top:30px" id="credit">
<div class="card-header">
<strong>Credit</strong>
</div>
<div class="card-body">
<p><strong>JohnyMuffin</strong> for the help also for making RetroMC, and the API's that this site relies on to get it's data.</p>
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
