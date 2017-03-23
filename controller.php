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
        return $instance = new Location($_POST['city'], $_POST['state'], $_POST['lat'], $_POST['lng']);
    }

    public function findById() {
        require_once 'db.php';
        $instance = new Db();
        return $result = $instance->findById($_POST['id']);
    } 

    public function deleteLocation() {
        require_once 'db.php';
        $instance = new Db();
        return $result = $instance->delete($_POST['deleteId']);
    }  
}

$func = @$_GET["func"];
$ctrl = new Controller();

switch($func) {
    case "addLocation":
        $ctrl->addLocation();
        break;
    case "findById":
        $ctrl->findById();
        break;
    case "deleteLocation":
        $ctrl->deleteLocation();
    default:
        break;
}

?>