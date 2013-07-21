<?php 

Class ViewController extends BaseController {
	
    protected function doGet() {
		if (isset($_GET['fiche'])) {
			$f = Fiche::getById($_GET['fiche']);
            $cats = array();
            foreach (Categorie::getAll() as $c) {
                $cats[$c->getId()] = $c;
            }
			$t = new MainTemplate(array('singlepost'));
            $t->render(array('f'    => $f,
                             'cats' => $cats));
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
