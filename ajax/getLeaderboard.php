<?php

include_once("../internal/backbone.php");

if($_POST) {
    if($_POST['category']) {
        $c = htmlspecialchars(strip_tags($_POST['category']));
        if(!array_key_exists($c,$methods)) {
            die();
        }
        else {

?>


<div class="card bg-dark">
<div class="card-header">Top <?php echo $methods[$c] ?></div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th></th>
<th>User</th>
<th><?php echo $methods[$c] ?></th>
</tr>
<?php

$page = !isset($_GET['page']) ? 1 : htmlspecialchars(strip_tags($_GET['page']));

$db->orderBy("$c", "DESC");
$db->groupBy("$c");
$stats = $db->get("user_stats", 50);
$d = super_unique($stats, 'user_id');
foreach ($d as $row) {
?>
<tr>
<td><img src="https://crafatar.com/avatars/<?php echo getUUID($db, $row['user_id']) ?>?size=25&overlay"></td>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>&n=<?php echo getUsername($db, $row['user_id']); ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<?php
if($c == 'playTime') {
?>
<td><span data-toggle="tooltip" data-placement="right" title="<?php  echo secondsToWords($row['playTime']); ?>"><?php echo secondsToWordsMini($row['playTime']) ?> hours</span></td>
<?php
} else {
?>
<td><?php echo $row[$c] ?></td>
<?php
}
?>
</tr>
<?php
}
?>

</thead>
</table>
</div>

</div>
<br>

<?php
}
}
}

?>
