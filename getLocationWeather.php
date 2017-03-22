<?php
require_once 'model.php';
$instance = new Db();
$result = $instance->findById($_POST['id']);
?>