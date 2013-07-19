<?php

Class CategorieEditController extends BaseController {

    // Load all categories
    private $cats = array();

    public function __construct() {
        foreach (Categorie::getAll() as $c) {
            $this->cats[$c->getId()] = $c;
        }
    }

    protected function doGet() {
        // simply display the forms
        $t = new MainTemplate(array('cat-edit'));
        $t->render(array('cats' => $this->cats));
    }

    protected function doPost() {
        if (isset($_REQUEST['done'])) {
            die();
        }
        // Saving => ?
        if (isset($_POST['save'])) {
            $args = array(
                'cat_id'     => $_POST['id'],
                'cat_label'  => $_POST['label'],
                'cat_parent' => $_POST['parent']
            );
            // id == new => create
            if ($_POST['id'] === 'new') {
                $new_cat = new Categorie();
                $this->_dbMod($new_cat, 'create', $args);
            }
            // else update
            else {
                $cat = Categorie::getById($_POST['id']);
                $this->_dbMod($cat, 'update', $args);
            }
        // Deleting
        } else if (isset($_POST['delete'])) {
            $cat = Categorie::getById($_POST['id']);
            $this->_dbMod($cat, 'delete');
        }
    }
    
    /* Redirect to the same page, setting an url variable 'done' to avoid
     * reprocessing the POST data
     **/
    protected function _postPost() {
        header('Location: /?action=edit&which=categories&done');
	}

    /**
     * Wrapper around various database modifications, avoid repetition.
     * Performs the specified action, checking for exceptions, and displays
     * a message depending on the results.
     **/
    private function _dbMod($cat, $action, $args=array()) {
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
            MessageHandler::setSuccessMsg('La catégorie ' . $cat->getLabel() . 
                                ' a bien été ' . $performed . '.');
        } catch (PDOException $e) {
            MessageHandler::setErrMsg('Erreur:</br>' . $e);
        }
              
        $this->_postPost();
    }
}

?>
