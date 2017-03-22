<?php
class Db {
    public $psql;

    function __construct() {
        $this->psql = pg_connect("host=localhost port=5432 dbname=phpweatherapp");
    }

    function create($city, $state, $lat, $lng) {
        $escapedCity = pg_escape_string($city);
        $escapedState = pg_escape_string($state);
        $escapedLat = pg_escape_string($lat);
        $escapedLng = pg_escape_string($lng);
        $query = "INSERT INTO LOCATIONS(city, state, lat, lng) VALUES('" . $escapedCity . "', '" . $escapedState . "', '" . $escapedLat . "', '" . $escapedLng . "')";
        $result = pg_query($this->psql, $query);

        if (!$result) {
            echo "An error occurred.\n";
            exit;
        } else {
            echo "YAY";
            exit;
        }
    }

    function findById($id) {
        $query = "SELECT * FROM LOCATIONS WHERE ID = '" . $id . "'";
        $result = pg_query($this->psql, $query);

        if (!$result) {
            echo "An error occurred.\n";
            exit;
        } else {
            while($data = pg_fetch_object($result)) {
                $lat = $data->lat; 
                $lng = $data->lng; 
                $id = $data->id; 
            } 
            echo json_encode(array('lat'=>$lat, 'lng'=>$lng));
        }
    }

    function findAll() {
        $query = "SELECT * FROM LOCATIONS";
        $result = pg_query($this->psql, $query);

        if (!$result) {
            return "An error occurred.\n";
            exit;
        } else {
            return $result;
            exit;
        }
    }

    function delete($id) {
        $result = pg_delete($this->psql, 'LOCATIONS', $id);

        if (!$result) {
            return "An error occurred.\n";
            exit;
        } else {
            return $result;
            exit;
        }
    }
}
?>