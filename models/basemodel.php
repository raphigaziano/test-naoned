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
            self::$db->setAttribute(
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
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
     * Execute a prepared query.
     *
     * @param $query: query name, as a string contained in the $this->queries
     *                array.
     * @param $args:  array of arguments passed to the query, defaulting to an 
     *                empty array
     * return executed query
     **/
    protected function _execQuery($query, $args=array()) {
        $q = $this->queries[$query];
        $q->execute($args);
        return $q;
    }

    /**
     * Save the object to the database.
     * Will either insert a new row or update an existing one, depending on
     * the value of $this-> id ('new' => new row)
     *
     * return void
     **/
    protected function _save($args) {
        if ($this->id === 'new') {
            $this->_execQuery('insert', $args);
        } else {
            $args[':id'] = $this->id;
            $this->_execQuery('update', $args);
        }
    }

    /**
     * Delete the categorie from the database.
     **/
    public function delete() {
        $this->_execQuery('delete', array(':id' => $this->id));
    }

    /**
     * Helper. Excecute passed query and return all results.
     **/
    protected function _getAll($query='getAll', $args=array()) {
        return $this->_execQuery($query, $args)->fetchAll();
    }

    /**
     * Initialize internal SQL queries.
     * Subclasses must override this to define their own SQL queries.
     **/
    abstract protected function _initQueries();
}

Model::initDb();

?>
