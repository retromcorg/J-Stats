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



<div class="card bg-dark" style="margin-top:30px" id="credit">
<div class="card-header">
<strong>How it works</strong>
</div>
<div class="card-body"> 
<p>You can search for your username, see Beta Evolutions capes, villages and more.</p>

<ul>
    <li>Villages</li> - Updates every 30 minutes</li>
    <li>Leaderboards</li> - Updates every 10 minutes</li>
    <li>Sign Data</li> - Updates every day</li>
    <li>Player Data</li> - Updates when you log off of RetroMC</li>
</ul>
</div>
</div>



<div class="card bg-dark" style="margin-top:30px" id="credit">
<div class="card-header">
<strong>"Invalid Mojang username", "This person never joined the server"</strong>
</div>
<div class="card-body"> 
<p>You can try to get their new username from NameMC, I can not easily ping to get user's name history because, <a href="https://help.minecraft.net/hc/en-us/articles/8969841895693-Username-History-API-Removal-FAQ-">fuck you Mojang!</a></p>
<p>Or the username you're searching for legacy and has not been migrated to RetroMC's statistics system and is sadly lost.</li>
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
</div>

<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
