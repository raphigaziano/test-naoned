<?php 

include_once('constants.php'); 
include_once('views/helpers.php'); 

include('views/header.php');

include('models/categories.php');
include('models/fiches.php');

$f = Fiche::getById(1);
?>
<div class="container-fluid">
  <div class="row-fluid">
    <?php categories_menu('cat='); ?>
    <div class="span8 offset1">
    <!-- TESTING -->
    <table class="table">        
	<tr>
            <th>FIELD</th>
            <th>VALUE</th>
        </tr>
        <tr>
            <td>ID</td>
            <td><?php echo $f->getId(); ?></td>
        </tr>
        <tr>
            <td>LABEL</td>
            <td><?php echo $f->getLabel(); ?></td>
        </tr>
        <tr>
            <td>Category</td>
            <td></td>
        </tr>
        <tr>
            <td>Descr</td>
            <td><?php echo $f->getDescription(); ?></td>
        </tr>
    </table>
    </div> <!--/.span9 --> 
  </div> <!--/.fluid-row --> 
 <!--MOVE TO FOOTER, before global js and /body-->
</div> <!--/.fluid-container--> 
<?php
include('views/footer.php');
?>
