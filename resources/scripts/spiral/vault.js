//TODO: Polish
$(document).ready(function () {
    $(".dropdown-button").dropdown();

    $('.collapsible').collapsible({
        accordion: false
    });

    $('ul.tabs').tabs();

    $('.item-select').material_select();

    $('.button-collapse').sideNav({
            menuWidth: 300,
            edge: 'left'
        }
    );

    $('.button-collapse').on('click', function () {
        $(this).toggleClass('active');
    });

    //add tabs to url hash
    (function ($tabs) {
        if (!$tabs.length) return;
        $tabs.on('click', function (e) {
            if (window.location.hash === e.currentTarget.getAttribute('href')) return;
            var path = window.location.href,
                newPath;
            if (path.indexOf('#')) {
                path = path.substr(0, path.indexOf('#'));
            }
            newPath = path + e.currentTarget.getAttribute('href');
            window.location.href = newPath;
        });
        window.onhashchange  = function (event) {
            var tab = event.newURL.substr(event.newURL.indexOf('#') + 1, event.newURL.length),
                scrollTop = document.body.scrollTop;
            if (!$tabs.parent().find('a[href$="'+tab+'"]')) {return}
            $tabs.parent().tabs('select_tab', tab);
            window.scrollTo(0, scrollTop);
        };
    }($('.tabs a')))

    $(document).on('click touchstart', function (e) {
        if ($(e.target).closest('#sidenav-overlay').length) {
            $('.button-collapse').toggleClass('active');
        }
    });
})