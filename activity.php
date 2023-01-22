<?php
include_once("internal/backbone.php");

if (!isset($_GET['u']) && !isset($_GET['a'])) {
    die();
}
elseif(!array_key_exists($_GET['a'], $stats_methods)) {
  die();
}

else {
    $u = htmlspecialchars(strip_tags($_GET['u']));
    $m = htmlspecialchars(strip_tags($_GET['a']));

    $stat = json_decode(curlData("https://j-stats.xyz/api/activity?uuid=". $u . "&method=" . $m), true);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | <?php echo $stat['username'] ?>'s <?php echo $stat['method'] ?> Activity">
<meta name="description" content="Get <?php echo $stat['username'] ?>'s <?php echo $stat['method'] ?> from RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <meta content="https://crafatar.com/avatars/<?php echo $stat['uuid'] ?>?size=128&overlay" property="og:image" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/activity?u=<?php echo $u ?>&a=<?php echo $m; ?>">
<link rel="icon" href="https://crafatar.com/avatars/<?php echo $stat['uuid'] ?>?size=128&overlay">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<title>J-Stats | <?php echo $stat['username'] ?>'s <?php echo $stat['method'] ?></title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2><?php echo $stat['method'] ?></h2>
<p>This is <a href="./player?u=<?php echo $stat['uuid'] ?>&n=<?php echo $stat['username'] ?>"><img src="https://crafatar.com/avatars/<?php echo $stat['uuid'] ?>?size=20&overlay" alt="<?php echo $stat['username'] ?>"> <?php echo $stat['username'] ?></a>'s <?php echo $stat['method'] ?></p>
<div class="card bg-dark">
<div class="card-header"><strong><?php echo $stat['method'] ?></strong></div>
<div class="card-body">
<?php
if(count($stat['timestamps']) < 5) {
	echo '<p class="text-danger">J-Stats does not have enough '. $stat['method'] . ' data for ' . $stat['username']  .' yet. <a href="./player?u=' . $stat['uuid'] . '&n='. $stat['username'] .'">Go back</a></p>';
}
else {
?>
<canvas id="activity" style="width:100%;"></canvas>
<?php
}
?>
</div>

</div>
</div>

<script>
 new Chart("activity", {
    type: "line",
    data: {
    labels: <?php echo json_encode($stat['timestamps'], true) ?>,
    datasets: [{
    fill: false,
    lineTension: 0,
    backgroundColor: "rgba(65, 222, 249, 0.76)",
    borderColor: "rgba(92, 227, 250, 0.8)",
    data: <?php echo json_encode($stat[$m], true) ?>
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
    display: true
    }
    }]
    }
    }
    });
</script>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
<?php
}
?>
