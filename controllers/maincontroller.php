<?php
include('controllers/basecontroller.php');
include('controllers/viewcontroller.php');
include('controllers/editcontroller.php');

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
}

?>
