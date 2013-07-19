<?php

Class CategorieEditController extends EditController {

    // Load all categories
    private $cats = array();

    public function __construct() {
        $this->modelClass = 'Categorie';
        foreach (Categorie::getAll() as $c) {
            $this->cats[$c->getId()] = $c;
        }
    }

    protected function doPost() {
        $args = array(
            'cat_id'     => $_POST['id'],
            'cat_label'  => $_POST['label'],
            'cat_parent' => $_POST['parent']
        );
        $this->dispatchAction($args);
    }
    protected function doGet() {
        // simply display the forms
        $t = new MainTemplate(array('cat-edit'));
        $t->render(array('cats' => $this->cats));
    }
}

?>
