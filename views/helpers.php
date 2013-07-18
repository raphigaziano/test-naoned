<?php

 /* Alert Helpers
  * *************
  */

/**
 * Internal helper.
 * Display a bootstrap alert block of type $type,
 * containing $msg
 **/
function _alert($type, $msg) {
?>
    <p class="alert alert-<?php echo $type; ?>">
      <?php echo $msg; ?>
    </p>
<?php }

/**
 * Display a success message
 **/
function display_success($msg) {
    _alert('success', $msg);  
}

/**
 * Display an error message.
 * If $die === true, then abort everyting.
 **/
function display_error($msg, $die=false) {
    _alert('error', $msg);  
    if ($die) die();
}

 /* Category Sidebar Helpers
  * ************************
  */

/**
 * Display links for a category and all its children (recursively).
 * Note: wt3c validator doesn't like those nested uls!
 *
 * @param $cat: Category to be displayed
 **/
function print_category($cat) {
    ?>
    <li>
      <a href="<?php echo '?cat=' . $cat->getId();?>">
        <?php echo $cat->getLabel(); ?>
      </a>
    </li>
    <?php $children = $cat->getChildren(); ?>
    <?php if ($children):?>
        <ul class="nav nav-list">
        <?php 
        // Recursive call to print current category's children
        foreach ($children as $child) {
            print_category($child);
        }
        ?>
        </ul>
    <?endif;?>
<?php }

/**
 * Display a menu listing categories.
 **/
function categories_menu() {
    ?>
    <div class="span2">
      <div class="well sidebar-nav">
        <a href="/">Toutes les fiches</a>
        <ul class="nav nav-list">
        <?php foreach(Categorie::getAllTopLevel() as $cat) {
            print_category($cat);
        }
        ?>
        </ul>
      </div>
    </div> <!--/span2 -->
<?php }
?>
