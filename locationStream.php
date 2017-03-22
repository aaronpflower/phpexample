<?php
$showLoactions = function() {
    require 'model.php'; 
    $instance = new Db(); 
    $result = $instance->findAll();
    $rows = pg_num_rows($result);

    if($rows > 0) {
        echo '<h1 class="mediumText">Your Locations</h1>';
        while($data = pg_fetch_object($result)) { 
            $city = $data->city; 
            $state = $data->state; 
            $id = $data->id; 
        
            echo '<div class="locationItem">'; 
            $data = <<<EOD
            <i class="fa fa-times delete-item" aria-hidden="true"></i>
            <p class="smallText"> $city, $state </p>
            <input type="hidden" name="id" id="id" value="$id" /> 
EOD;

            echo $data; 
            echo '</div>'; 
        }
    } else {
        echo '<h1 class="mediumText">You dont have any saved locations</h1>'; 
    } 
}
?> 