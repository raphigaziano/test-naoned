/**
 * Warning alert when a "delete" button is pressed
 *
 */

(function() {
    $('button[name=delete]').click(function(ev) {
        var msg = "Etes vous sur de vouloir supprimer cette entrée?";
        if ( $(this).parents('form').hasClass('categorie-edit') ) {
            msg += "\nSa supression entrainera celle de toutes les "
                    + "sous-catégories ou fiches associé(e)s!";
        }
        if (confirm(msg)) {
            return true;
        }
        ev.preventDefault();
    });
})();
