<?php

Abstract Class BaseController {

    abstract public function doGet();

    abstract public function doPost();

    /**
     * First request filter: decides whether to call POST or GET handler.
     */
    public function dispatch() {
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
