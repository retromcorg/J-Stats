<?php

include_once("../internal/backbone.php");

if($_POST) {
    if(isset($_POST['uuid'])) {
        $u = htmlspecialchars(strip_tags($_POST['uuid']));

        $cape = curlData("https://capes.johnymuffin.com/storage/". $u .".png");
        // only do stuff if the cape is found
        if($cape) {
            $capeURL = 'data:image/png;base64,' . base64_encode($cape);
            echo $capeURL;
        }
    }

}




?>
