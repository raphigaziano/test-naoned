<?php 
include('cat-editcontroller.php');
include('fiche-editcontroller.php');

/**
 * Base class for editing controllers, defining some common methods
 * & helpers.
 **/
Class EditController extends BaseController {

    // Which model class does this controller handle ?
    protected $modelClass;

    public function __construct() {
        $this->subcontrollers = array(
            'categories'    => new CategorieEditController(),
            'fiches'        => new FicheEditController()
        );
    }
        
    /**
     * Decides which db action (create, update, delete) to perform
     * depending on the received POST data.
     *
     * @param $args: parameters to pass to the actual db request.
     **/
    protected function dispatchAction($args) {
        $cls = $this->modelClass;
        // Saving => ?
        if (isset($_POST['save'])) {
            // id == new => create
            if ($_POST['id'] === 'new') {
                $new_item = new $cls();
                $this->_dbMod($new_item, 'create', $args);
            }
            // else update
            else {
                $item = $cls::getById($_POST['id']);
                $this->_dbMod($item, 'update', $args);
            }
        // Deleting
        } else if (isset($_POST['delete'])) {
            $item = $cls::getById($_POST['id']);
            $this->_dbMod($item, 'delete');
        }
    }
    
    /**
     * Wrapper around various database modifications, avoid repetition.
     * Performs the specified action, checking for exceptions, and registers
     * a message depending on the results.
     **/
    protected function _dbMod($item, $action, $args=array()) {
        try{
            switch($action) {
                case 'create':
                case 'update':
                    $item->initFromDb($args);
                    $item->save();
                    $performed = $action == 'create' ? 'ajoutée' : 'modifiée';
                    break;
                case 'delete':
                    $item->delete();
                    $performed = 'supprimée';
                    break;
                default:
                    die('Action invalide');
            }   
            $base_msg = 'La <MODEL> <LABEL> a bien été <ACTION>."';
            $msg = preg_replace(array('/<MODEL>/', '/<LABEL>/', '/<ACTION>/'),
                                array(
                                    '<MODEL>'  => strtolower($this->modelClass),
                                    '<LABEL>'  => $item->getLabel(),
                                    '<ACTION>' => $performed),
                                $base_msg);
            MessageHandler::setSuccessMsg( $msg);
        } catch (PDOException $e) {
            MessageHandler::setErrMsg('Erreur:</br>' . $e);
        }
    }

    /**
     * dispatch according to $_GET['which'] rather than request method
     **/
    private function _dispatch() {

        if (!isset($_REQUEST['which'])) {
            die('URL invalide: pas de paramètre "which"');
        }

        if ($this->subcontrollers) {
            $c = $this->subcontrollers[$_GET['which']];
            $c->dispatch();
            return $c;
        } else {
            return NULL;
        }
    }
    /**
     * Try overriden dispatch behaviour (_dispatch), falling back to the 
     * default one if we're a "leaf controller"
     */
    public function dispatch() {

        $c = $this->_dispatch();
        if (!$c) {
            parent::dispatch();
        }
    }
}

?>
