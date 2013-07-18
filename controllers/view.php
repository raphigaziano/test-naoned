          
<?php
// View single fiche
if (isset($_GET['post'])) {
    $f = Fiche::getById($_GET['post']);
    include('views/includes/singlepost.php');
} 
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
    include('views/includes/fichelist.php');
}
