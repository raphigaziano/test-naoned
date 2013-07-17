<?php 

include_once('constants.php'); 
include('views/header.php');

include('models/categories.php');
include('models/fiches.php');

$f = Fiche::getById(1);
?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <div class="well sidebar-nav">
        <ul class="nav nav-list">
          <?php foreach(Categorie::getAllTopLevel() as $cat):?>
            <li><a href=""><?php echo $cat->getLabel(); ?></a></li>
            <?php foreach ($cat->getChildren() as $child):?>
              <ul class="nav nav-list">
                <li><a href=""><?php echo $child->getLabel(); ?></a></li>
              </ul>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="span8 offset1">
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
