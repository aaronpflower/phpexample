<?php
class Location {
    public $city;
    public $state;
    public $lat;
    public $lng;

    function __construct($city, $state, $lat, $lng) {
        $this->city = $city;
        $this->state = $state;
        $this->lat = $lat;
        $this->lng - $lng;
        require_once 'db.php';
        $instance = new Db();
        $response = $instance->create($city, $state, $lat, $lng);
    }

}

class locationList {
    public $list;

    function __construct() {
        require_once 'db.php';
        $db = new Db();
        $result = $db->findAll();
        $rows = pg_num_rows($result);
        return $rows;
    }
}
?>