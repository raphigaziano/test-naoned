// Ajax call => delete
function ajaxcall(url, itemdata) {
    $.ajax({
        type: "POST",
        'url': url,
        datatype: 'html',
        async: false,
        data: {
            'id': itemdata.id,
            'label': itemdata.label,
            'description': itemdata.descr,
            'cat': itemdata.cat,
            'delete': true
        },
        success: function(r) {
            $('body').html(r);
        },
    });
}

(function() {
    // Collect item data on page load
    var itemdata = {
        id    : $('article').attr('id'),
        label : $('h1').text(),
        descr : $('.descr').text(),
        cat   : $('p.cat').attr('id')
    };
    // Hide form on load
    $('#edit-form').css('display', 'none');

    // Item suppression
    $('button[name="delete"]').click(function(ev) {
        ev.preventDefault();
        if (! warnOnDelete(this) ) {
            return false;
        }
        var r = ajaxcall(
            '/?action=edit&which=fiches&fiche=' + itemdata.id, 
            itemdata
        );
    });
    // Update
    $('button[name="update"]').click(function(ev) {
        ev.preventDefault();
        var that = $(this);
        $('article').toggle(100);
        $('#edit-form').toggle(100, function() {
            if ($(this).css('display') !== 'none') {
                $(that).text('Retour');
            } else {
                $(that).text('Modifier');
            }
        });
        // var data = $('#edit-form').serialize();
        // console.log(data);
    });
})();
