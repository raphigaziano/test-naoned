<?php
include_once('basemodel.php');

/**
 * Model class for Fiche objects
 **/
Class Fiche extends Model {

    protected $description, $category;
    
    /* Accessors 
     * *********
     */

    public function getDescription() {
        return $this->description;
    }
    public function setDescription($val) {
        $this->description = $val;
    }

    public function getCategorie() {
        $res = array();
        foreach ($this->_getAll('getCategorie', array(':id' => $this->id))
                 as $cat_db) {
            $cat = new Categorie();
            $cat->initFromDb($cat_db);
            $res[] = $cat;
        }
        return $res;
    }

    public function setCategorie($catid) {
        if ($catid === 'none') {
            $catid = NULL;
        } else {
            $catid = (int)$catid;
        }
        $this->categorie = Categorie::getById($catid);
    }

    /**
     * Object's hydratation from from a DB row.
     *
     * @param $args: Array of fields from the fetched row.
     * @return void
     **/
    public function initFromDb($args) {
        extract($args);
        $this->setId($fi_id);
        $this->setLabel($fi_label);
        $this->setDescription($fi_description);
        $this->setCategorie($cat_id);
    }

    /**
     * Initialize internal SQL queries.
     *
     * @return void
     **/
    protected function _initQueries() {
        $this->queries['getById'] = $this->_prepareRequest(
            "SELECT fiche.*, cat_id 
             FROM fiche 
             JOIN categorie_fiche ON categorie_fiche.fi_id = fiche.fi_id
             WHERE fiche.fi_id = :id;"
        );
        $this->queries['getAll'] = $this->_prepareRequest(
            "SELECT fiche.*, cat_id 
             FROM fiche JOIN categorie_fiche
                ON fiche.fi_id = categorie_fiche.fi_id;"
        );
        $this->queries['getCategorie'] = $this->_prepareRequest(
            "SELECT categorie.* FROM categorie
                INNER JOIN categorie_fiche ON categorie.cat_id = categorie_fiche.cat_id
                INNER JOIN fiche ON fiche.fi_id = categorie_fiche.fi_id
            WHERE fiche.fi_id = :id;"
        );
        $this->queries['addrelation'] = $this->_prepareRequest(
            "INSERT INTO categorie_fiche (cat_id, fi_id)
             VALUES (:cat_id, :id);"
        );
        $this->queries['updaterelation'] = $this->_prepareRequest(
            "UPDATE categorie_fiche
             SET fi_id = :id
             WHERE fi_id = :id;"
        );
        $this->queries['update'] = $this->_prepareRequest(
            "UPDATE fiche 
             SET fi_label=:label, fi_description=:descript
             WHERE fi_id = :id;"
        );
        $this->queries['insert'] = $this->_prepareRequest(
            "INSERT INTO fiche (fi_label, fi_description)
             VALUES (:label, :descript);"
        );
    }

    /**
     * Init args for saving, and insert or update the fiche in the
     * categorie_fiche relation table.
     */
    public function save() {
        $cat_id = isset($this->categorie) ? $this->categorie->getId() : NULL;
        if (!$cat_id) {
            throw new PDOException('Les fiches doivent être rattachées ' .
                                   'a une catégorie!'); 
        }
        $args = array(
            ':label'    => $this->label,
            ':descript' => $this->description
        );
        $this->_save($args);
        // Update join
        $this_id = self::$db->lastInsertId();
        if ($this->id === 'new') {
            $this->_execQuery('addrelation',
                array(':cat_id' => $cat_id,
                      ':id'     => $this_id)
            );
        }
        else {
            // TODO: update
        }
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

    /**
     * Return all categories
     *
     * @return array of all fiches
     **/
    public static function getAll() {
        $obj = new Fiche();
        $query = $obj->queries['getAll'];
        $query->execute();
        $res = array();
        foreach ($query->fetchAll() as $f) {
            $fi = new Fiche();
            $fi->initFromDb($f);
            $res[] = $fi;
        }
        return $res;
    }
}

?>

