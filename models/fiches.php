<?php
include_once('basemodel.php');

/**
 * Model class for Fiche objects
 **/
Class Fiche extends Model {

    private $id, $label, $descrption;
    
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
    protected function _initFromDb($args) {
        $this->id     = $args['fi_id'];
        $this->label  = $args['fi_label'];
        $this->parent = $args['fi_description'];
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
    }

    /**
     * Alternate, static constructor.
     *
     * @param $id: Primary key of the requested row.
     * @return New instance of Categorie from fethed db entry
     **/
    public static function getById($id) {
        $obj = new Fiche();
        $request = $obj->queries['getById'];
        $request->execute(array(':id' => $id));        
	    $db_fields = $request->fetch();	
	    if ($db_fields) {
            $obj->_initFromDb($db_fields);
            return $obj;
        } else {
            // TODO: Better Error Handling
	       return NULL;
        }
    }
}

?>

