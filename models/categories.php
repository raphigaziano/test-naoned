<?php
include('basemodel.php');

/**
 * Model class for Category objects
 **/
Class Categorie extends Model {

    private $id, $label, $parent;

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
        $this->queries['getById'] = $this->_prepareRequest(
            "SELECT * FROM categorie WHERE cat_id = :id;"
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

// TESTING
//$c = Categorie::getById('1');
echo '<pre>';
echo "simple instanciation</br>";
$c = new Categorie();
var_dump($c);
echo '</br></br>';
echo "intanciate from static</br>";
var_dump(Categorie::getById(1));
echo '</br></br>';
var_dump(Categorie::getById(2));
echo '</pre>';
?>
