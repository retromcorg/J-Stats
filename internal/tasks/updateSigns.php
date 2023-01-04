<?php



include_once("../backbone.php");


$d = curlData("https://world.retromc.org/markers.js");

$d1 =  str_replace("overviewer.collections.markerDatas.push(", ' ', $d);
$d2 = str_replace(");", ' ', $d1);
$data = json_decode($d2, true);

foreach ($data as $d) {

    $db->where("msg", $d['msg']);
    $db->where("x", $d['x']);
    $db->where("y", $d['y']);
    $db->where("z", $d['z']);
    $db->where("type", $d['type']);

    $check = $db->getOne("user_signs");
    if(!$check) {
        $d4 = [
            "msg" => $d['msg'],
            "y" => $d['y'],
            "x" => $d['x'],
            "z" => $d['z'],
            "type" => $d['type'],
            "chunk" => json_encode($d['chunk'])
        ];
    $db->insert("user_signs", $d4);
    }
}





?>