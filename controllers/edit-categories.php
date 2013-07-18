<?php

/**
 * Wrapper around various database modifications, avoid repetition.
 * Performs the specified action, checking for exceptions, and displays
 * a message depending on the results.
 **/
function dbMod($cat, $action, $args=array()) {
    try{
        switch($action) {
            case 'create':
            case 'update':
                $cat->initFromDb($args);
                $cat->save();
                $performed = $action == 'create' ? 'ajoutée' : 'modifiée';
                break;
            case 'delete':
                $cat->delete();
                $performed = 'supprimée';
                break;
            default:
                die('Action invalide');
        }   
    } catch (PDOException $e) {
        display_error('Erreur:</br>' . $e, true);
    }
    display_success('La catégorie ' . $cat->getLabel() . 
                    'a bien été ' . $performed . '.' );
}

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
            $args = array(
                'cat_id'     => $_POST['id'],
                'cat_label'  => $_POST['label'],
                'cat_parent' => $_POST['parent']
            );
            if ($_POST['id'] === 'new') {
                $new_cat = new Categorie();
                dbMod($new_cat, 'create', $args);
            }
            // else update
            else {
                $cat = Categorie::getById($_POST['id']);
                dbMod($cat, 'update', $args);
            }
        } else if (isset($_POST['delete'])) {
            $cat = Categorie::getById($_POST['id']);
            dbMod($cat, 'delete');
        }
        break;
    // Get request: display forms for each categorie
    case 'GET':
        include('views/cat-edit.php');
}

?>
