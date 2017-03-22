<?php
$func = @$_GET["func"];

switch($func) {
    case "addLocation":
        require_once 'model.php';
        $instance = new Location($_POST['city'], $_POST['state'], $_POST['lat'], $_POST['lng']);
        break;
    case "showLoactions":
        require_once 'model.php';
        $instance = new locationList();
        break;
    default:
        break;
}


?>