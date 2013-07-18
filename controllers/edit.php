<?php

if (!isset($_GET['items'])) {
    die('URL invalide: pas de paramètre "items"');
}

switch ($_GET['items']) {
    case 'categories':
        include('controllers/edit-categories.php');
        break;
    case 'fiches':
        echo 'TODO!';
        break;
    default:
        die('Paramètre' . $_GET['items'] . 'invalide.');
}

?>

