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
        if ($val != 'new') {
            $val = (int)$val;
        }
        $this->id = $val;
    }

    public function getLabel() {
        return $this->label;
    }
    public function setLabel($val) {
        if (!$val) {
            $val = NULL;
        }
        $this->label = $val;
    }

    public function getParent() {
        return $this->parent;
    }
    public function setParent($val) {
        if ($val === 'none') {
            $val = NULL;
        }
        $this->parent = $val;
    }

    public function getChildren() {
        $res = array();
        foreach ($this->_getAll('getChildren', array(':id' => $this->id))
                 as $cat_db) {
            $c = new Categorie();
            $c->initFromDb($cat_db);
            $res[] = $c;
        }
        return $res;
    }

    /**
     * Return an array of fiches object contained within this
     * category or any of its children.
     *
     * return array of Fiche objects
     **/
    public function getFiches() {
        $res = array();
        foreach ($this->_getAll('getFiches', array(':id' => $this->id))
                 as $fi) {
            $f = New Fiche();
            $f->initFromDb($fi);
            $res[] = $f;
        }
        return $res;
    }

    /**
     * Object's hydratation from from a DB row.
     *
     * @param $args: Array of fields from the fetched row.
     * @return void
     **/
    public function initFromDb($args) {
        extract($args);
        $this->setId($cat_id);
        $this->setLabel($cat_label);
        $this->setParent($cat_parent);
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
        $this->queries['getChildren'] = $this->_prepareRequest(
            "SELECT * FROM categorie WHERE cat_parent = :id;"
        );
        $this->queries['getFiches'] = $this->_prepareRequest(
            'SELECT fiche.* FROM fiche
                INNER JOIN categorie_fiche ON fiche.fi_id = categorie_fiche.fi_id
            WHERE cat_id = :id OR cat_id in (
                SELECT cat_id FROM categorie WHERE cat_parent = :id
            )'
        );
        $this->queries['insert'] = $this->_prepareRequest(
            "INSERT INTO categorie (cat_label, cat_parent)
                VALUES (:label, :parent);"
        );
        $this->queries['delete'] = $this->_prepareRequest(
            "DELETE FROM categorie WHERE cat_id = :id;"
        );
        $this->queries['update'] = $this->_prepareRequest(
            "UPDATE categorie 
             SET cat_label=:label, cat_parent=:parent
             WHERE cat_id = :id;"
        );
    }

    /**
     * Save the object to the database.
     * Will either insert a new row or update an existing one, depending on
     * the value of $this-> id ('new' => new row)
     *
     * return void
     **/
    public function save() {
        $args = array(
            ':label'  => $this->label,
            ':parent' => $this->parent
        );
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
            $obj->initFromDb($db_fields);
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
        $obj = new Categorie();
        $query = $obj->queries['getAll'];
        $query->execute();
        foreach ($query->fetchAll() as $c) {
            $cat = new Categorie();
            $cat->initFromDb($c);
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
            $cat->initFromDb($c);
            $res[] = $cat;
        }
        return $res;
    }
}

?>
