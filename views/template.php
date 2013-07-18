<?php

/**
 * Basic template object to render various pages
 **/
Class Template {

    private static dir_ = 'views/includes/';
    private fragments = array();

    public __construct($htmlfragments) {
        foreach ($htmlfragments as $f) {
            $this->[fragmentsbasename($f, '.php')] = $this->dir_ . $f;
        }
    }

    /**
     * Display each html fragment, making the passed array of variables
     * available to them
     **/
    public function render($vars) {
        extract($vars);
        foreach ($this->fragments as $f) {

        }
    }
}

?>
