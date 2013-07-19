  <form class='form-inline categorie-edit' 
        action='/?action=edit&which=categories' method='post'>
  <fieldset>
    <input type='hidden' name='id' 
           value='<?php echo isset($c) ? $c->getId() : 'new' ?>' />
    <label>Libellé: </label>
    <input type='text' name='label' 
           value='<?php echo isset($c) ? $c->getLabel() : "" ?>' />
    <label>Catégorie parente: </label>
    <select name='parent'>
      <option value='none'>Aucune</option>
      <?php foreach($cats as $j => $cat):?>
        <option value=<?php echo "'$j'"; 
                echo (isset($c) AND $c->getParent() == $j) ? " selected" : ""; ?>>
          <?php echo $cat->getLabel();?>
        </option>
      <?php endforeach;?>
    </select>
    <button name='save' class='btn btn-primary'>Sauvegarder</button>
    <?php if (isset($c)):?>
        <button name='delete' class='btn btn-danger'>Supprimer</button>
    <?php endif; ?>
  </fieldset>
  </form>
