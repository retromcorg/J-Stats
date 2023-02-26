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
<meta name="description" content="Leaderboard for 'everything' on RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <meta content="https://j-stats.xyz/assets/img/icon.png" property="og:image" />
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | Leaderboard</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2>Leaderboard</h2>
<p>/baltop, but for everything else</p>

<select id="category" class="form-control cat bg-dark" name="cat">
<option value="" selected disabled>Select a Category to Filter by</option>
<?php

foreach($lb_methods as $method => $label) {
?>
<option value="<?php echo $method ?>"> <?php echo $label ?></option>
<?php
}
?>
</select>
<br>

<div class="table-responsive-lg lb">
        <table class="table table-dark table-borderless table-sm">
            <thead><tr>
                <th class="text-center">#</th>
                <th id="t"></th>
                <th id="n"></th>
            </tr>
</thead>
<tbody class="leaderboard"></tbody>
</table>
</div>

</div>

<script src="assets/js/leaderboard.js"></script>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
