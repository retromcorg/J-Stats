<?php

include_once("internal/backbone.php");

$servers = curlServerInfo($db);

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
<meta name="description" content="Get Statistics and information from RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/server">
<link id="favicon" rel="icon" href="assets/img/icon.png">
<link rel="apple-touch-icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<title>J-Stats | Server</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">
<div class="card bg-dark">
<div class="card-header player"></div>
<div class="card-body players"><div class="fetchServers"></div></div>
</div>
<br>
<div class="card bg-dark">
<div class="card-header">Players Overtime</div>
<div class="card-body h-100 d-flex align-items-center justify-content-center"><canvas id="myChart" style="width:100%;"></canvas></div>
</div>
</div>

<script>
$(document).ready(function () {
$.ajax({
url: 'ajax/getServer',
type: 'GET',
dataType: 'json',
success: function(response) {
let result = ''; 
response.forEach(element => {
$(".player").text(`${element.online} Players Online`);
result += '<div class="row">';
element.players.forEach(e => {
result += `<div class="col-md-4"><img src="https://minotar.net/helm/${e[1]}/25.png" alt="${e[0]}" title="${e[0]}"><a href="player?u=${e[1]}&n=${e[0]}">${e[0]}</a></div>`
})
result += '</div>';
result += `<br><br>`;
$(".fetchServers").html(result);

new Chart("myChart", {
type: "line",
data: {
labels: element.player_date,
datasets: [{
fill: false,
lineTension: 0,
backgroundColor: "rgb(44, 207, 97)",
borderColor: "rgba(44, 207, 97,0.7)",
data: element.player_history
}]
},
options: {
legend: {display: false},
scales: {
xAxes: [{
gridLines: {
display:false
},
ticks: {
display: false
}
}],

yAxes: [{
gridLines: {
display:false
},
ticks: {
display: false
}
}]
}
}
});
});
}
});
});
</script>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
