<?php

include_once("internal/backbone.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | Capes">
<meta name="description" content="View all the Beta Evolutions capes using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <meta content="https://j-stats.xyz/assets/img/icon.png" property="og:image" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/capes">
<link rel="icon" href="assets/img/icon.png">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Capes</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2>Capes</h2>
<p>All the Beta Evolutions capes</p>

<div class="row">
<?php

$db->where("cape", "", "!=");
$ca = $db->get("users");

foreach($ca as $c) {
?>
<div class="col-md-3">

<div class="card bg-dark">
<div class="card-header"><a href="./player?u=<?php echo $c['uuid'] ?>"><?php echo $c['username'] ?></a></div>

<img class="card-img-bottom" src="<?php echo $c['cape'] ?>" style="image-rendering: pixelated;" alt="<?php echo $c['username'] ?>'s Cape" style="width:100%">
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
