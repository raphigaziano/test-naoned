<?php
include_once('basemodel.php');

/**
 * Model class for Category objects
 **/
Class Categorie extends Model {

    private $id, $label, $parent;
    
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

    public function getParent() {
        return $this->parent;
    }
    public function setParent($val) {
        if (get_class($val) === 'Categorie') {
            $this->label = $val;
        }
    }

    public function getChildren() {
        $query = $this->queries['getChildrenIds'];
        $query->execute(array(':id' => $this->id));
        $ids = $query->fetchAll();
        $res = array();
        foreach ($ids as $id) {
            $res[] = Categorie::getById($id['cat_id']);
        }
        return $res;
    }

    /**
     * Object's hydratation from from a DB row.
     *
     * @param $args: Array of fields from the fetched row.
     * @return void
     **/
    protected function _initFromDb($args) {
        $this->id     = $args['cat_id'];
        $this->label  = $args['cat_label'];
        $this->parent = $args['cat_parent'];
    }

    /**
     * Initialize internal SQL queries.
     *
     * @return void
     **/
    protected function _initQueries() {
        $this->queries['getAll'] = $this->_prepareRequest(
            "SELECT * FROM categorie"
        );
        $this->queries['getAllTopLevel'] = $this->_prepareRequest(
            "SELECT * FROM categorie WHERE cat_parent IS NULL;"
        );
        $this->queries['getById'] = $this->_prepareRequest(
            "SELECT * FROM categorie WHERE cat_id = :id;"
        );
        $this->queries['getChildrenIds'] = $this->_prepareRequest(
            "SELECT cat_id FROM categorie WHERE cat_parent = :id;"
        );
    }

    /**
     * Alternate, static constructor.
     *
     * @param $id: Primary key of the requested row.
     * @return New instance of Categorie from fethed db entry
     **/
    public static function getById($id) {
        $obj = new Categorie();
        $query = $obj->queries['getById'];
        $query->execute(array(':id' => $id));        
	    $db_fields = $query->fetch();	
	    if ($db_fields) {
            $obj->_initFromDb($db_fields);
            return $obj;
        } else {
            // TODO: Better Error Handling
	       return NULL;
        }
    }

    /**
     * Return all categories
     *
     * @return array of all categories
     **/
    public static function getAll() {
        $obj = new Categorie(); // Need to intanciate a dummy obj to
                                // access stored queries...
        $query = $obj->queries['getAll'];
        $query->execute();
        $res = array();
        foreach ($query->fetchAll() as $c) {              
            $cat = new Categorie();
            $cat->_initFromDb($c);
            $res[] = $cat;
        }
        return $res;
    }

    /**
     * Return all top level categories (ie, the ones 
     * without any children)
     *
     * @return array of categories
     **/
    public static function getAllTopLevel() {
        $obj = new Categorie(); // Need to intanciate a dummy obj to
                                // access stored queries...
        $query = $obj->queries['getAllTopLevel'];
        $query->execute();
        $res = array();
        foreach ($query->fetchAll() as $c) {              
            $cat = new Categorie();
            $cat->_initFromDb($c);
            $res[] = $cat;
        }
        return $res;
    }
}

?>
