<?php

include_once("internal/backbone.php");

$servers = curlServerInfo($db);

$stats = json_decode(curlData("https://j-stats.xyz/api/v2/server"), true);


foreach ($servers as $server) {
$info = $server;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Server">
<meta name="description" content="Get Server overview of RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <meta content="https://j-stats.xyz/assets/img/icon.png" property="og:image" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/server">
<link rel="icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<title>J-Stats | Server</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">
<h2>Server</h2>
<div class="sstats">
<p><span id="player"></span> <span id="today"></span> <span id="total"></span></p>
</div>
<div class="card bg-dark">
<div class="card-header">Player List</div>
<div class="card-body players"><div class="fetchServers"></div>
</div>
</div>
<br>
<div class="card bg-dark">
<div class="card-header">Players Overtime</div>
<div class="card-body h-100 d-flex align-items-center justify-content-center"><canvas id="myChart" style="width:100%;"></canvas></div>
</div>
</div>

<script src="assets/js/app.js"></script>
<script>loadServer()</script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
