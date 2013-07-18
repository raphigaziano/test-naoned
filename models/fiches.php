<?php
include_once('basemodel.php');

/**
 * Model class for Fiche objects
 **/
Class Fiche extends Model {

    private $id, $label, $description;
    
    /* Accessors 
     * *********
     */

    public function getId() {
        return $this->id;
    }
    public function setId($val) {
        $this->id = (int)$val;
    }

    public function getLabel() {
        return $this->label;
    }
    public function setLabel($val) {
        $this->label = $val;
    }

    public function getDescription() {
        return $this->description;
    }
    public function setParent($val) {
        $this->description = $val;
    }

    /**
     * Object's hydratation from from a DB row.
     *
     * @param $args: Array of fields from the fetched row.
     * @return void
     **/
    public function initFromDb($args) {
        extract($args);
        $this->id     = $fi_id;
        $this->label  = $fi_label;
        $this->description = $fi_description;
    }

    /**
     * Initialize internal SQL queries.
     *
     * @return void
     **/
    protected function _initQueries() {
        $this->queries['getById'] = $this->_prepareRequest(
            "SELECT * FROM fiche WHERE fi_id = :id;"
        );
        $this->queries['getAll'] = $this->_prepareRequest(
            "SELECT * FROM fiche;"
        );
    }

    /**
     * Alternate, static constructor.
     *
     * @param $id: Primary key of the requested row.
     * @return New instance of Fiche from fethed db entry
     **/
    public static function getById($id) {
        $obj = new Fiche();
        $request = $obj->queries['getById'];
        $request->execute(array(':id' => $id));        
	    $db_fields = $request->fetch();	
	    if ($db_fields) {
            $obj->initFromDb($db_fields);
            return $obj;
        } else {
            // TODO: Better Error Handling
	       return NULL;
        }
    }

    public static function getAll() {
        $obj = new Fiche();
        $query = $obj->queries['getAll'];
        $query->execute();
        foreach ($query->fetchAll() as $f) {
            $fi = new Fiche();
            $fi->initFromDb($f);
            $res[] = $fi;
        }
        return $res;
    }
}

?>

