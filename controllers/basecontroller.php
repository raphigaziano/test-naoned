<?php
include('views/template.php');

Abstract Class BaseController {

	private $subcontrollers;

    protected function doGet() {
        // NO-OP
    }

    protected function doPost() {
        // NO-OP
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
