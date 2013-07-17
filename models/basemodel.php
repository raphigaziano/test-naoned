<?php


/**
 * Base model class, handling basic db connection
 **/
abstract Class Model {

    protected static $db;
    protected $queries = array();

    /**
     * Instance constructor.
     **/
    public function __construct() {
        $this->_initQueries();
    }

    /**
     * Database Initialisation.
     *
     * @return void
     **/
    public static function initDb() {
        try {
            self::$db = new PDO(DB_CONNECTION_STRING, DB_USER, DB_PSWD);
        } catch (PDOError $e) {
            die('Impossible de se connecter a la bdd: ' . $e->getMessage());
        }
    }

    /**
     * Helper for subclasses - prepare the passed SQL statement with
     * PDO.
     *
     * @param $sqlstmnt: SQL statement to store.
     * @return prepared statement.
     **/
    protected function _prepareRequest($sqlstmnt) {
        return self::$db->prepare($sqlstmnt);
    }

    /**
     * Initialize internal SQL queries.
     * Subclasses must override this to define their own SQL queries.
     **/
    abstract protected function _initQueries();
}

Model::initDb();

?>
