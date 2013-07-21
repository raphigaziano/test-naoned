<?php
include('controllers/basecontroller.php');
include('controllers/viewcontroller.php');
include('controllers/editcontroller.php');

/**
 * Top level controller -
 * All request will pass through this one, before being handed to more
 * specialized subcontrollers.
 **/
Class MainController extends BaseController {
    
	public function __construct() {
		$this->subcontrollers = array(
			'view'	=> new ViewController(),
			'edit'  => new EditController()
		);
	}
    
    protected function doGet() {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
		} else {
            $action = 'view';
        }
        $c = $this->subcontrollers[$action];
        $c->dispatch();
    }

    public function doPost() {
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
        $c->_postPost();
    }
}

?>
