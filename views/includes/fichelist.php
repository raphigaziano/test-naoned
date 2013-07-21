    <?php if (isset($selected)) {
            echo 'Catégorie: ' . $selected->getLabel() . '<br/>';
    }?>
    <?php echo count($fiches) . ' Fiches sont affichées.'; ?>
    <?php foreach ($fiches as $f): ?>
        <p>
            <h4>
              <a href="?action=view&fiche=<?php echo $f->getId();?>">
                <?php echo $f->getLabel(); ?>
              </a>
            </h4>
        </p>
    <?php endforeach; ?>

