-- 2013-07-17
-- Script d'insertion des données de test.

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `cat_label`, `cat_parent`) VALUES(1, 'SomeCategory', NULL);
INSERT INTO `categorie` (`cat_id`, `cat_label`, `cat_parent`) VALUES(2, 'SomeOtherCategory', NULL);
INSERT INTO `categorie` (`cat_id`, `cat_label`, `cat_parent`) VALUES(3, 'foo', 1);
INSERT INTO `categorie` (`cat_id`, `cat_label`, `cat_parent`) VALUES(4, 'bar', 1);
INSERT INTO `categorie` (`cat_id`, `cat_label`, `cat_parent`) VALUES(5, 'baz', 2);
INSERT INTO `categorie` (`cat_id`, `cat_label`, `cat_parent`) VALUES(6, 'dummy', 3);
