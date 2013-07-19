<?php 
include_once('constants.php'); 

include('controllers/maincontroller.php');
include('models/categories.php');
include('models/fiches.php');

$c = new MainController();
$c->dispatch();

echo 'TODO: clean messages';
?>
