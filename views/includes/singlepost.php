  <article id='<?php echo $f->getId(); ?>'>
    <h1> <?php echo $f->getLabel(); ?> </h1>
    <div class='descr'><?php echo $f->getDescription(); ?></div>
    <?php $c = $f->getCategorie(); $c = $c[0]; ?>
    <p class='cat' id='<?php echo $c->getId(); ?>'>
        Categorie:
            <a href="?cat=<?php echo $c->getId(); ?>">
              <?php echo $c->getLabel(); ?>
            </a>
    </p>
  </article>
    <form class='item-edit'>
        <button class='crudbtn btn btn-primary' name='update'>
            Modifier
        </button>
        <button class='crudbtn btn btn-danger' name='delete'>
            Supprimer
        </button>
    </form>
    <div id='edit-form'> 
        <?php include('forms/fiche.php'); ?>
    </div>
    <script type='text/javascript'
            src='<?php echo get_static_url('js/deletewarning.js'); ?>'></script>
    <script type='text/javascript'
            src='<?php echo get_static_url('js/editinplace.js'); ?>'></script>
