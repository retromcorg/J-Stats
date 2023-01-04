<?php

include_once("internal/backbone.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Signs">
<meta name="description" content="Get Statistics and information from RetroMC and Betalands using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/signs">
<link rel="icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Signs</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2>Signs</h2>
<p>Here you can see all the signs.</p>


<div class="card bg-dark">
<div class="card-header">Signs</div>
<div class="card-body">

<table class="table table-borderless">
<thead>
<tr>
<th>Message</th>
<th>x</th>
<th>y</th>
<th>z</th>
</tr>
</thead>
<tbody id="myTable">

<?php

$records_per_page = 20;
$pagination = new Zebra_Pagination();

$limit = [(($pagination->get_page() - 1) * $records_per_page), $records_per_page];
$signs = $db->get("user_signs", $limit);

// fetch the total number of records in the table
$rows = $db->getOne("user_signs", "COUNT(*) as cnt");

$pagination->records($rows['cnt']);
$pagination->records_per_page($records_per_page);

foreach ($signs as $sign) {

?>
<tr>
<td><?php echo $sign["msg"];?></td>
<td><?php echo $sign["x"];?></td>
<td><?php echo $sign["y"];?></td>
<td><?php echo $sign["z"];?></td>
</tr>

<?php
}
?>
</tbody>
</table>

</div>

</div>
<br>
<div class="justify-content-center">
<?php
$pagination->render();
?>
</div>
</div>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
