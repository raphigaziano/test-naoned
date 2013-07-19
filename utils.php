<?php
/**
 * Various utilites
 *
 **/


/**
 * Messaging Helper
 *
 **/
Class MessageHandler {
    
    static private $msgs = array();

    public static function __init() {
        session_start();
        if (isset($_SESSION['msgs'])) {
            self::$msgs = $_SESSION['msgs'];
        }
    }

    /**
     * Store $msg at index $name
     **/
    static public function setMsg($name, $msg) {
        self::$msgs[$name] = $msg;
        $_SESSION['msgs'] = self::$msgs;
    }

    // Quick wrappers
    // --------------

    static public function setErrMsg($msg) {
        self::setMsg('error', $msg);
    }

    static public function setSuccessMsg($msg) {
        self::setMsg('success', $msg);
    }

    /**
     * Return the requested messages $name
     **/
    static public function getMsg($name) {
        if(array_key_exists($name, self::$msgs)) {
            return self::$msgs[$name];
        }
        return NULL;
    
    }

    /**
     * Clear the internal messages array
     **/
    static public function clear() {
        self::$msgs = array();
        $_SESSION['msgs'] = self::$msgs;
    }

    // Debug - var_dump $msgs
    static public function dump() {
        var_dump(self::$msgs);
    }
}

MessageHandler::__init();

?>
