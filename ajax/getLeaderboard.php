<?php

include_once("../internal/backbone.php");

if($_POST) {
if($_POST['category']) {
$c = htmlspecialchars(strip_tags($_POST['category']));
if(!array_key_exists($c,$lb_methods)) {
die();
}
else {


?>


<div class="card bg-dark">
<div class="card-header">Top <?php echo $lb_methods[$c] ?></div>
<div class="card-body">
<table class="table table-borderless table-sm">
<thead>
<tr>
<th>#</th>
<th></th>
<th>
<?php
if(!in_array($c,['assistantsCount', 'memberCount', 'claims'])) {
echo 'User';
}
else {
echo 'Village';
}

?>

</th>
<th><?php echo $lb_methods[$c] ?></th>
</tr>
<?php



if(in_array($c, ['assistantsCount', 'memberCount', 'claims'])) {
$db->orderby("$c", "DESC");
$db->groupby("village_id");
$d = $db->get("village_stats", 50, "MAX($c) as $c,village_id");
}

elseif($c == 'mostChatMessages') {
$db->groupBy("username");
$db->orderBy("cnt", "DESC");
$d = $db->get("user_chats", 50, "COUNT(username) as cnt,uuid,username");
}
else {
$db->orderBy("$c", "DESC");
$db->groupBy("user_id");
$d = $db->get("user_stats", 50, "max($c) as $c, user_id");
}


foreach ($d as $k => $row) {
if(!in_array($c, ['mostChatMessages', 'assistantsCount', 'memberCount', 'claims'])) {
?>
<tr>
<td><?php echo $k+1; ?></td>
<td><img src="https://crafatar.com/avatars/<?php echo getUUID($db, $row['user_id']) ?>?size=25&overlay"></td>
<td><a href="./player?u=<?php echo getUUID($db, $row['user_id']) ?>"><?php echo getUsername($db, $row['user_id']); ?></a></td>
<?php
if($c == 'playTime') {
?>
<td><span data-toggle="tooltip" data-placement="right" title="<?php  echo secondsToWords($row['playTime']); ?>"><?php echo secondsToWordsMini($row['playTime']) ?> hours</span></td>
<?php
} 
else {
?>
<td><?php echo $row[$c] ?></td>
<?php
}
?>
</tr>
<?php
}
if($c == 'mostChatMessages') {
?>
<tr>
<th><?php echo $k+1; ?></th>
<td><img src="https://crafatar.com/avatars/<?php echo $row['uuid'] ?>?size=25&overlay"></td>
<td><a href="./player?u=<?php echo $row['uuid']; ?>"><?php echo $row['username']; ?></a></td>
<td><?php echo $row['cnt'] ?></td>
</tr>

<?php
}

if(in_array($c, ['assistantsCount', 'memberCount', 'claims'])) {
?>
<tr>

<th><?php echo $k+1; ?></th>
<td></td>
<td><a href="village?u=<?php echo getVillageUUID($db, $row['village_id']) ?>"><?php echo getVillageNameID($db, $row['village_id']) ?></a></td>
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
if($c == 'playTime') {
?>
<script>
  $('[data-toggle="tooltip"]').tooltip();
</script>

<?php
}
?>
