<?php

Class FicheEditController extends EditController {

    private $fiche;
    // Load all categories
    private $cats = array();

    public function __construct() {
        $this->modelClass = 'Fiche';
        if (isset($_REQUEST['fiche'])) {
            $this->fiche = Fiche::getById($_REQUEST['fiche']);
        } else {
            $this->fiche = new Fiche();
        }
        foreach (Categorie::getAll() as $c) {
            $this->cats[$c->getId()] = $c;
        }
    }

    public function doGet() {
        // simply display the form.
        $t = new MainTemplate(array('forms/fiche'));
        $t->render(array('f'    => $this->fiche,
                         'cats' => $this->cats));
    }

    public function doPost() {
        $args = array(
            'fi_id'          => $_POST['id'],
            'fi_label'       => $_POST['label'],
            'fi_description' => $_POST['description'],
            'cat_id'         => $_POST['cat'],

        );
        $this->dispatchAction($args);
    }

    public function _postPost() {
        header('Location: /');
    }
}
