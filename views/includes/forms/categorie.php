<p>
  <form class='form-inline', action='', method='post'>
    <input type='hidden' name='id' 
           value='<?php echo isset($c) ? $c->getId() : 'new' ?>' />
    <label>Libellé: </label>
    <input type='text' name='label' 
           placeholder='<?php echo isset($c) ? $c->getLabel() : "" ?>' />
    <label>Catégorie parente: </label>
    <select name='parent'>
      <option value='None'>Aucune</option>
      <?php foreach($cats as $j => $cat):?>
        <option value=<?php echo "'$j'"; 
                echo (isset($c) AND $c->getParent() == $j) ? " selected" : ""; ?>>
          <?php echo $cat->getLabel();?>
        </option>
      <?php endforeach;?>
    </select>
    <button name='save'>Sauvegarder</button>
    <?php if (isset($c)):?>
        <button name='delete'>Supprimer</button>
    <?php endif; ?>
  </form>
</p>