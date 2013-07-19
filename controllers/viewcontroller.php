<?php 

Class ViewController extends BaseController {
	
    protected function doGet() {
		if (isset($_GET['post'])) {
			$f = Fiche::getById($_GET['post']);
            $c = Categorie::getAll();
			$t = new MainTemplate(array('singlepost'));
            $t->render(array('f'    => $f,
                             'cats' => $c));
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
			$t = new MainTemplate(array('fichelist'));
            $t->render(array('fiches' => $fiches,
                             'selected' => isset($c) ? $c : NULL));
		}
	}
}

?>
