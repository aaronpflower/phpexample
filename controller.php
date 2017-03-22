<?php
class Controller {
    public function showLocations() {
        require 'db.php';
        $db = new Db();
        $result = $db->findAll();
        $rows = pg_num_rows($result);

        if ($rows < 0) {
            return $result;
        } else {
            return $result;
        }
    }

    public function addLocation() {
        require_once 'model.php';
        $instance = new Location($_POST['city'], $_POST['state'], $_POST['lat'], $_POST['lng']);
    }
}

$func = @$_GET["func"];
$ctrl = new Controller();

switch($func) {
    case "addLocation":
        $ctrl->addLocation();
        break;
    case "showLocations":
        $ctrl->showLocations();
        break;
    default:
        break;
}

?>