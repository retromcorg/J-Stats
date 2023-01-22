<?php

include_once("internal/backbone.php");


if (!isset($_GET['u'])) {
    die();
}
else {
    $u = htmlspecialchars(strip_tags($_GET['u']));


    $records_per_page = 50;
    $pagination = new Zebra_Pagination();


    // fetch the total number of records in the table
    $db->where("uuid", $u);
    $rows = $db->getOne("user_chats", "COUNT(*) as cnt");

    $pagination->records($rows['cnt']);
    $pagination->records_per_page($records_per_page);


    $limit = [(($pagination->get_page() - 1) * $records_per_page), $records_per_page];
    $db->orderby("t", "DESC");
    $db->where("uuid", $u);
    $chats = $db->get("user_chats", $limit);

    $username = getUsernameUUID($db, $u);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="English">
<meta name="title" content="J-Stats | <?php echo $username ?>'s Chat History">
<meta name="description" content="Get <?php echo $username ?>'s Chat History RetroMC using J-Stats!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <meta content="https://crafatar.com/avatars/<?php echo $u ?>?size=128&overlay" property="og:image" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/style.css">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://j-stats.xyz/chat?u=<?php echo $u; ?>">
<link rel="icon" href="assets/img/icon.png">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<title>J-Stats | <?php echo $username ?>'s Chat History</title>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="container" style="margin-top:30px">

<h2><?php echo $username ?>'s Chat History</h2>
<p>This is <a href="./player?u=<?php echo $u ?>&n=<?php echo $username ?>"><img src="https://crafatar.com/avatars/<?php echo $u ?>?size=20&overlay" alt="<?php echo $stat['username'] ?>"> <?php echo $username ?></a>'s Chat History</p>

<div class="card bg-dark">
<div class="card-header">Messages</div>
<div class="card-body">

<table class="table table-sm table-borderless">
<thead>
<tr>
<th>Message</th>
<th><i class="fa fa-clock-o" aria-hidden="true"></i></th>
</tr>
</thead>
<tbody id="myTable">

<?php

foreach ($chats as $chat) {

?>
<tr>
<td><?php echo base64_decode($chat["msg"]);?></td>
<td><span data-toggle="author" data-placement="left" title="<?php echo unix($chat['t']); ?>"><?php echo to_time_ago($chat['t']);?> ago</span></td>
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

<script>
$('[data-toggle="author"]').tooltip();   
</script>
<script src="assets/js/app.js"></script>
<?php include_once("includes/footer.php"); ?>
</body>
</html>
<?php
    }
?>
