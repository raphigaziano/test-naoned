<?php
include('views/helpers.php');

/**
 * Basic template object to render various pages
 **/
Class Template {

    private static $dir_ = 'views/includes/';
    private $fragments = array();

    public function __construct($htmlfragments=array()) {
        foreach ($htmlfragments as $f) {
            $this->_addTemplate($f);
        }
    }
    
    protected function _addTemplate($tmplName) {
		$this->fragments[basename($tmplName)] =
			self::$dir_ . $tmplName . '.php';
	}

    /**
     * Display each html fragment, making the passed array of variables
     * available to them
     **/
    public function render($vars=array()) {
        extract($vars);
        foreach ($this->fragments as $name => $__tmplfragment) {
            include($__tmplfragment);
        }
    }
}

Class MainTemplate extends Template {
	
	public function __construct($htmlfragments=array()) {
		$this->_addTemplate('header');
        $this->_addTemplate('messages');
		parent::__construct($htmlfragments);
		$this->_addTemplate('footer');
	}
}
?>
