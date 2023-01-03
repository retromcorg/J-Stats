<?php

include_once("internal/backbone.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Villages">
<meta name="description" content="Get Statistics and information from RetroMC and Betalands using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/villages">
<link rel="icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Villages</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2>Villages</h2>
<p>Here you can see all the villages.</p>

<input class="form-control bg-dark" id="myInput" type="text" placeholder="Filter through list..">
<br>
<div class="row">

<?php

$villages = $db->get("villages");

foreach ($villages as $village) {

?>
<div class="col-lg-4 title">
<div class="card bg-dark">
<div class="card-header"><?php echo $village['name'] ?></div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>Members</th>
<th>Assistants</th>
<th>Claims</th>
</tr>
<?php
$v = getVillageStats($db, $village['id']);
?>
<tbody>
<tr>
    <td><?php echo $v['memberCount'] ?></td>
    <td><?php echo $v['assistantsCount'] ?></td>
    <td><?php echo $v['claims'] ?></td>
</tr>
</tbody>
</table>
<a href="village?u=<?php echo $village['uuid'] ?>" class="btn btn-sm btn-info">view village</a>
</div>
</div>
<br>
</div>
<?php
}
?>
</div>

<script>
$(document).ready(function(){
$("#myInput").on("keyup", function() {
var value = $(this).val().toLowerCase();
$(".title").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
