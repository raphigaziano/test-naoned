<?php categories_menu('?cat='); ?>
  <div class="span8 offset1">
          
<?php
// View single fiche
if (isset($_GET['post'])) {
    $f = Fiche::getById($_GET['post']);
    // TODO: move into view
?>
    <h1><?php echo $f->getLabel(); ?></h1>
    <p><?php echo $f->getDescription(); ?></p>
    <p>
        Categories: 
        <?php foreach ($f->getCategories() as $c): ?>
            <a href="?cat=<?php echo $c->getId(); ?>">
              <?php echo $c->getLabel(); ?>
            </a>
        <?php endforeach; ?>
    </p>
<?php } 
// List fiches
else {
    // Category filter
    if (isset($_GET['cat'])) {
        $c = Categorie::getById($_GET['cat']);
        if (!$c) {
            die("Cette catégorie n'existe pas.");
        }
        $fiches = $c->getFiches();
    }
    // All fiches
    else {
        $fiches = Fiche::getAll();
    }
    if (isset($c)) {
        echo 'Catégorie: ' . $c->getLabel() . '<br/>';
    }
    // TODO: move into view
    echo count($fiches) . ' Fiches sont affichées.';
    foreach ($fiches as $f) {
        ?>
        <p>
            <h4>
              <a href="?action=view&post=<?php echo $f->getId();?>">
                <?php echo $f->getLabel(); ?>
              </a>
            </h4>
        </p>
    <?php }
}
