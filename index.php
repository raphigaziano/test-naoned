<?php 

include_once('constants.php'); 
include_once('views/helpers.php'); 

include('views/header.php');

include('models/categories.php');
include('models/fiches.php');

?>
<div class="container-fluid">
  <div class="row-fluid">
    <?php categories_menu(); ?>
      <div class="span8 offset1">
    <!-- TESTING -->
        <?php
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = 'view';
        }
        switch($action) {
            case 'view':
                include('controllers/view.php');
                break;
            case 'edit':
                include('controllers/edit.php');
                break;
            default:
                die('l\'action demandée n\'existe pas :(');
        }
        ?>
    </div> <!--/.span8 --> 
  </div> <!--/.fluid-row --> 
 <!--MOVE TO FOOTER, before global js and /body-->
</div> <!--/.fluid-container--> 
<?php
include('views/footer.php');
?>
