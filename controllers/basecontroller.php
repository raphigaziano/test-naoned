<?php
include('views/template.php');

Abstract Class BaseController {

	protected $subcontrollers;

    protected function doGet() {
        // NO-OP
    }

    protected function doPost() {
        // NO-OP
    }

    /* Redirect to the same page, setting an url variable 'done' to avoid
     * reprocessing the POST data
     **/
    protected function _postPost() {
        header('Location: ' . $_SERVER['REQUEST_URI'] . '&done');
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
