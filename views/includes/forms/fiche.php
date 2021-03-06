  <form class='form-inline fiche-edit' 
        action='/?action=edit&which=fiches' method='post'>
  <fieldset>
    <input type='hidden' name='id' 
           value='<?php echo $f->getId() !== NULL ? $f->getId() :  'new' ?>' />
    <label for='label'>Libellé: </label>
    <input type='text' name='label' 
           value='<?php echo isset($f) ? $f->getLabel() : "" ?>' />
    <label>Catégorie: </label>
    <select name='cat'>
      <option value='none'>Aucune</option>
      <?php $c = $f->getCategorie(); $c = $c[0];?>
      <?php foreach($formcats as $j => $cat):?>
        <option value=<?php echo "'$j'"; 
                echo ($c AND $c->getId() == $j) ? " selected" : ""; ?>>
          <?php echo $cat->getLabel();?>
        </option>
      <?php endforeach;?>
    </select>
    <button name='save' class='btn btn-primary'>Sauvegarder</button>
    <textarea name='description' rows='20' cols='80'>
        <?php echo isset($f) ? $f->getDescription() : ''; ?>
    </textarea>
  </fieldset>
  </form>
