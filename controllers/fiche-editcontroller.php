<?php

Class FicheEditController extends EditController {

    private $fiche;

    public function __construct() {
        $this->modelClass = 'Fiche';
        if (isset($_REQUEST['fiche'])) {
            $this->fiche = Fiche::getById($_REQUEST['fiche']);
        } else {
            $this->fiche = new Fiche();
        }
    }

    public function doGet() {
        // simply display the form.
        $cats = Categorie::getAll();
        $t = new MainTemplate(array('forms/fiche'));
        $t->render(array('f'    => $this->fiche,
                         'cats' => $cats));
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
}

?>
