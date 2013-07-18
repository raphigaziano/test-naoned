<?php

// Get all categories
$cats = array();
foreach (Categorie::getAll() as $c) {
    $cats[$c->getId()] = $c;
}
unset($c); // Delete temporary variable to avoid it being reused further down

switch ($_SERVER['REQUEST_METHOD']) {
    // Post request: handle the update or deletion
    case 'POST':
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        // Form sent via the 'Sauvegarder' button
        if (isset($_POST['save'])) {
            // id == new => create
            if ($_POST['id'] === 'new') {
                echo 'create new cat';
            }
            // else update
            else {
                echo 'updating cat #' . $_POST['id'];
            }
        } else if (isset($_POST['delete'])) {
            echo 'deleting cat #' . $_POST['id'];
        }
        break;
    // Get request: display forms for each categorie
    case 'GET':
        include('views/cat-edit.php');
}

?>
