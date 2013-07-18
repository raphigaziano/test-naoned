    <h1><?php echo $f->getLabel(); ?></h1>
    <p><?php echo $f->getDescription(); ?></p>
    <p>
        Categories: 
        <?php foreach ($f->getCategorie() as $c): ?>
            <a href="?cat=<?php echo $c->getId(); ?>">
              <?php echo $c->getLabel(); ?>
            </a>
        <?php endforeach; ?>
    </p>

