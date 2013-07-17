<?php

 /* Category Sidebar Helpers
  * ************************
  */

/**
 * Display links for a category and all its children (recursively).
 * Note: wt3c validator doesn't like those nested uls!
 *
 * @param $cat: Category to be displayed
 * @param $baseUrl: Url for links. $cat's id will be apended to it.
 *                  This means you should provide the 'param=<id>' part
 *                  of the url in $baseUrl, and assume all category ids 
 *                  parameters should go at the end of the url.
 **/
function print_category($cat, $baseUrl) {
    ?>
    <li>
      <a href="<?php echo $baseUrl . $cat->getId();?>">
        <?php echo $cat->getLabel(); ?>
      </a>
    </li>
    <?php $children = $cat->getChildren(); ?>
    <?php if ($children):?>
        <ul class="nav nav-list">
        <?php 
        // Recursive call to print current category's children
        foreach ($children as $child) {
            print_category($child, $baseUrl);
        }
        ?>
        </ul>
    <?endif;?>
<?php }

/**
 * Display a menu listing categories.
 *
 * @param $linksUrl: Base url templates for displayed links.
 *                   Each category listed will point to
 *                   $linksUrl + category id
 **/
function categories_menu($linksUrl) {
    ?>
    <div class="span2">
      <div class="well sidebar-nav">
        <ul class="nav nav-list">
        <?php foreach(Categorie::getAllTopLevel() as $cat) {
            print_category($cat, $linksUrl);
        }
        ?>
        </ul>
      </div>
    </div>
<?php }
?>
