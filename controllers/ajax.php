<?php

chdir('../');
include('index.php');

debug($_POST);
$c = new MainController();
$c->dispatch();

echo 'popo';
?>
