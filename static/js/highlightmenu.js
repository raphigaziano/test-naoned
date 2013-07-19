(function() {
    var navbar  = $('#topnav'),
        cur_url = location.search,
        search;
    if (cur_url === '') {
        search = 'a[href="/"]';
    } else if (cur_url.indexOf('fiches') != -1 ) {
        search = 'a[href*="fiches"]';
    } else if (cur_url.indexOf('categories') != -1 ) {
        search = 'a[href*="categories"]';
    }
    navbar.find(search).parent().addClass('active');
})();
