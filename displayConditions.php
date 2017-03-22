<?php
if (isset($_POST['data'])) {
    $data = json_decode($_POST['data'], true);
    echo '<h1 class="mediumText">Currently</h1>';
    foreach($data as $key => $value) {
        echo '<div class="locationItem">'; 
        $data = <<<EOD
        <p class="smallText"> $key : $value </p>
EOD;

        echo $data; 
        echo '</div>';
    }
      
} else {
    echo '<h1 class="mediumText">You dont have any saved locations</h1>'; 
} 
// How to get the view to change?
?>