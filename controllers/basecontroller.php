<?php
include('views/template.php');

/**
 * Base controller class.
 * Implements default dispatch methods.
 **/
Abstract Class BaseController {

	protected $subcontrollers;

    protected function doGet() {
        // NO-OP, to be overriden by subclasses if necessary.
    }

    protected function doPost() {
        // NO-OP, to be overriden by subclasses if necessary.
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
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                if (isset($_REQUEST['done'])) {
                    die();
                }
                $this->doPost();
                break;
            case 'GET':
                $this->doGet();
                break;
        }
    }
}

?>
