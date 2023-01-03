<?php

include_once("internal/backbone.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Item List">
<meta name="description" content="Get Statistics and information from RetroMC and Betalands using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/item-list">
<link id="favicon" rel="icon" href="assets/img/icon.png">
<link rel="apple-touch-icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Item List</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<div class="card bg-dark">
<div class="card-header">Item List</div>
<div class="card-body">
<input class="form-control bg-dark" id="myInput" type="text" placeholder="Filter through list..">
<div class="text-right">
<small class="text-danger">* Optionable value varies on the server.</small>
</div>
<table class="table table-borderless">
<thead>
<tr>
<th>Item ID</th>
<th>Item Name</th>
<th>Is Item Craftable?</th>
<th>Is Item Obtainable?</th>
</tr>
</thead>
<tbody id="myTable">

<?php

$file = file_get_contents("https://raw.githubusercontent.com/codenamesui/b1.7.3-resources/main/items.json");
$items = json_decode($file, true);

foreach ($items as $item) {
?>
<tr>
<td><?php echo $item["id"];?></td>
<td><?php echo $item["name"];?></td>
<td><?php echo ft($item["craftable"]);?></td>
<td><?php echo ft($item["obtainable"]);?></td>
</tr>

<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>
<script>
$(document).ready(function(){
$("#myInput").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#myTable tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
