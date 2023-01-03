<?php
include_once("internal/backbone.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Leaderboard">
<meta name="description" content="Get Statistics and information from RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="icon" href="assets/img/icon.png">
<link rel="canonical" href="https://j-stats.xyz/leaderboard">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Leaderboard</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2>Leaderboard</h2>
<p>/baltop, but for everything else</p>

<div class="row">
<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Balance</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("money", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);

foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['money'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Deaths</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("playerDeaths", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['playerDeaths'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Kills</div>
<div class="card-body">

<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("playersKilled", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['playersKilled'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Joins</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("joinCount", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['joinCount'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Mob Kills</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("creaturesKilled", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['creaturesKilled'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>


<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Traveled</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("metersTraveled", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['metersTraveled'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

</div>

<br>

<div class="row">
<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Placed</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("blocksPlaced", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['blocksPlaced'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Level</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->orderBy("trustLevel", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['trustLevel'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
</div>


<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Score</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php

$db->orderBy("trustScore", "DESC");
$db->groupBy("user_id");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['trustScore'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

</div>


<div class="row">
<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Placed</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->groupBy("user_id");
$db->orderBy("blocksPlaced", "DESC");

$stats = $db->get("user_stats", 10);

foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['blocksPlaced'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Item Dropped</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->groupBy("user_id");
$db->orderBy("itemsDropped", "DESC");

$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo $row['itemsDropped'] ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>


<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Playtime</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>User</th>
<th>#</th>
</tr>
<?php
$db->groupBy("user_id");
$db->orderBy("playTime", "DESC");
$stats = $db->get("user_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<td><?php echo secondsToWordsMini($row['playTime']) ?> hours</td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>


<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Village Assistants</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>Village</th>
<th>#</th>
</tr>
<?php
$db->groupBy("village_id");
$db->orderBy("assistantsCount", "DESC");
$stats = $db->get("village_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./village?u=<?php echo getVillageUUID($db,$row['village_id']); ?>"><?php echo getVillageNameID($db,$row['village_id']); ?></a></td>
<td><?php echo $row['assistantsCount']; ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>
</div>

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Village Member</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>Village</th>
<th>#</th>
</tr>
<?php
$db->groupBy("village_id");
$db->orderBy("memberCount", "DESC");
$stats = $db->get("village_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./village?u=<?php echo getVillageUUID($db,$row['village_id']); ?>"><?php echo getVillageNameID($db,$row['village_id']); ?></a></td><td><?php echo $row['memberCount']; ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>

</div>

<div class="col-lg-4">
<div class="card bg-dark">
<div class="card-header">Top Village Claims</div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>Village</th>
<th>#</th>
</tr>
<?php
$db->groupBy("village_id");
$db->orderBy("claims", "DESC");
$stats = $db->get("village_stats", 10);
foreach ($stats as $row) {
?>
<tr>
<td><a href="./village?u=<?php echo getVillageUUID($db,$row['village_id']); ?>"><?php echo getVillageNameID($db,$row['village_id']); ?></a></td><td><?php echo $row['claims']; ?></td>
<tr>
<?php
}
?>

</thead>
</table>
</div>
</div>
<br>

</div>
</div>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
