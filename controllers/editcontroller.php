<?php 
include('cat-editcontroller.php');
include('fiche-editcontroller.php');

Class EditController extends BaseController {

    public function __construct() {
        $this->subcontrollers = array(
            'categories'    => new CategorieEditController(),
            'fiches'        => new FicheEditController()
        );
    }
        
    /**
     * Overriding default behaviour:
     * dispatch according to $_GET['which'] rather than request method
     */
    public function dispatch() {

        if (!isset($_REQUEST['which'])) {
            die('URL invalide: pas de paramètre "which"');
        }

        $c = $this->subcontrollers[$_GET['which']];
        $c->dispatch();
    }
}

?>
