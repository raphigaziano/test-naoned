<h2>Nouvelle Catégorie:</h2>
<?php include('views/includes/forms/categorie.php'); ?>

<?php if (!empty($cats)):?>
    <h2>Catégories existantes:</h2>
    <?php 
    foreach ($cats as $i => $c) {
        include('views/includes/forms/categorie.php');
    }
    ?>
    <script src='static/js/deletewarning.js'> </script>
<?php endif;?>