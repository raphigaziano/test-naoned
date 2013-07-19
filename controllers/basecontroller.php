<?php
include('views/template.php');

Abstract Class BaseController {

	private $subcontrollers;

    protected function doGet() {
        // NO-OP
    }

    protected function doPost() {
        // !!!UGLY HACK!!!
		// Must redispatch here... 
        switch ($_REQUEST['which']) {
			case 'categories':
				include_once('controllers/cat-editcontroller.php');
				$c = new CategorieEditController();
				break;
			case 'fiches':
				include_once('controllers/fiche-editcontroller.php');
				$c = new FicheEditController();
				break;			
			default:
				die('popo');
		}
			$c->doPost();
    }

    /**
     * First request filter: decides whether o call POST or GET handler.
     */
    public function dispatch() {
        //MessageHandler::grab();
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->doPost();
                break;
            case 'GET':
                $this->doGet();
                break;
        }
    }
}

?>
