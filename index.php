<?php 
include_once('constants.php'); 
include_once('utils.php');

include('controllers/maincontroller.php');
include('models/categories.php');
include('models/fiches.php');

$c = new MainController();
$c->dispatch();

?>
