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
        // Form sent via the 'Sauvegarder' button
        if (isset($_POST['save'])) {
            // id == new => create
            if ($_POST['id'] === 'new') {
                $new_cat = new Categorie();
                $new_cat->initFromDb(array(
                    'cat_id'     => $_POST['id'],
                    'cat_label'  => $_POST['label'],
                    'cat_parent' => $_POST['parent']
                ));
                try {
                    $new_cat->save();
                } catch (PDOException $e) {
                    display_error(
                        'Impossible d\'ajouter cette catégorie:</br>' . $e,
                        true
                    );
                }
                display_success('La catégorie ' . $new_cat->getLabel() . 
                                'a bien été ajoutée ;)');
            }
            // else update
            else {
                display_success('owi!');
                echo 'updating cat #' . $_POST['id'];
            }
        } else if (isset($_POST['delete'])) {
            display_success('owi!');
            echo 'deleting cat #' . $_POST['id'];
        }
        break;
    // Get request: display forms for each categorie
    case 'GET':
        include('views/cat-edit.php');
}

?>
