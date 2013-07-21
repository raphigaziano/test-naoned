mysql version: 5.5
php version: 5.3.10

http://test-naoned.alwaysdata.net/

Le répertoire db/ contient le script MySql de création de la base, ansi qu'un
script d'insertion des données utilisées pour mes tests.

Les paramètres de connection à la bdd sont définis dans le fichier 
constants.php.

La plupart des fonctionnalités sont implémentées, à l'exception de la 
possibilité de lier une fiche à plusieurs catégories (la base le permet, mais 
je ne me suis souvenu de cet aspect de la demande que trop tard pour 
l'implémenter dans l'application). Les fonctions d'édition d'une fiche semblent
ok, ayant été développées en urgence afin de pouvoir être livrées à temps, 
elle peuvent toutefois s'avérer instables.
Concernant les categories, si celles ci s'affichent récursivement, et peuvent 
donc s'imbriquer sur un nombre théoriquement infini de niveaux, le listing ou 
la suppression des fiches qui leurs sont associées ne se fait pour l'instant 
que sur un seul niveau (les fiches contenues par la catégorie elle même seront
affichées/supprimées, ansi que celles contenues par une sous catégorie, mais 
pas celles situées dans un troisième niveau d'imbrication ou au dela).

Un bref retours sur ce mini projet me semble intéressant:


J'ai essayé de respecter une architecture MVC et de séparer au maximum les 
différents couches de l'application.

Si j'y suis parvenu, je pense toutefois que l'architecture des modèles laisse
fortement à désirer: malgrés l'utilisation d'une classe abstraite pour 
regrouper certaines fonctionnalités communes, il y a toutefois beaucoup de 
duplication (chaque modèle "concret" réimplémentant parfois les mêmes methodes, 
par exemple). Un effort d'analyse supplémentaire aurait surement permis de 
réduire cette duplication, en implémentant un systéme permettant de réutiliser
simplement certaines requètes préparées, ou en remplacant les methodes 
de requetage statique par des objets de type "factory" (un design pattern que 
je ne connais que de nom, il aurait pu être intéressant de le travailler). J'ai
toutefois laissé le code tel quel afin de pouvoir avancer sur le reste de 
l'application, et n'ai pas eu le temps d'y revenir.

L'implémentation des controlleurs me semble relativement satisfaisante. Une 
classe Routeur, analysant l'url courante et instanciant directement le bon
controlleur, aurait probablement été une solution plus simple et plus élégante
(probalement plus performante également), mais encore une fois, l'idée ne m'est
venu que trop tard et j'ai preferé m'en tenir à l'approche qui fonctionnait
déjà.

Si elle n'est pas très flexible, la classe Template s'est avérée amplement 
suffisante dans le cadre de ce petit projet, et m'a permis de pouvoir découper
mes vues en plusieurs fragments et de gérer ceux ci relativement simplement.
Un plus appréciable aurait été l'inclusion optionnelle de fichiers statiques 
(js ou css) spécifiques à certaines pages: Avec le fonctionnement actuel, 
j'étais obligé d'inclure ceux ci directement dans mes fragments html, ce qui 
ne me laisse pas de controle quand au placement de l'inclusion au sein de la
page générée. Il aurait été préférable d'avoir un système permettant de 
regroupper ceux ci en bas de page pour du javascript, ou dans la balise 
<header> pour du css.

Je regrette fortement de ne pas avoir mis en place de tests unitaires. Ayant
pris l'habitude d'en écrire dans mes projets python, j'ai consideré l'idée
de rechercher et mettre en place un framework de test; Toutefois, considérant
que je devais aussi réinstaller un serveur LAMP et me réhabituer au langage
PHP lui même, que j'avoue ne pas avoir pratiqué depuis quelque temps, j'ai
estimé que cela me prendrait trop de temps avant de démarer le projet lui
même.

Il aurait été appréciable de prendre un peu de temps pour travailler la 
présentation du listing des fiches sur la page principale. N'étant pas un grand
afficionado de CSS, et encore moins designer, j'ai décidé très tot de laisser 
cet aspect de coté pour la fin du développement, me concentrant sur l'aspect 
fonctionnel du site, et n'ai pas eu le temps de m'y repencher. (Ceci explique
également l'utilisation du framework bootstrap pour pouvoir styler le site
rapidement, outil que je n'avais jamais utilisé et souhaitait découvrir).
Une meilleure gestion des erreurs, ainsi qu'un plus grand soucis de 
sécurisation des entrées, auraient également été un plus.

Si un effort global a été fourni sur la propreté et la lisibilité du code, 
j'avoue que les constantes modifications lors du debuggage et un certain retard
en fin de semaine ont laissé quelques points noirs, surtout dans les divers 
fragments d'html.
J'ai commencé à commenter en anglais par habitude, avant de réaliser que ce
n'était probalement pas pertinent dans le contexte de cet exercice. Estimant
qu'il s'agit d'une compétence utile dans ce métier, j'ai toutefois décider
de continuer sur cette lancée.
