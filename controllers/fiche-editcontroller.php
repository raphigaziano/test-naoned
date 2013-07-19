<?php

Class FicheEditController extends BaseController {

    private $fiche;

    public function __construct() {
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
}

?>
