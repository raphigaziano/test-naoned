/**
 * Warning alert when a "delete" button is pressed
 *
 */
function warnOnDelete(elem) {
    var msg = "Etes vous sur de vouloir supprimer cette entrée?";
    if ( $(elem).parents('form').hasClass('item-edit') ) {
        msg += "\nSa supression entrainera celle de toutes les "
                + "sous-catégories ou fiches associé(e)s!";
    }
    if (confirm(msg)) {
        return true;
    }
    return false;
}

