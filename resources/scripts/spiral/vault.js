// TODO: Polish
$(document).ready(function() {
    $(".dropdown-button").dropdown();

    $('.collapsible').collapsible({
        accordion: false,
    });

    $('ul.tabs').tabs();

    $('.item-select').material_select();

    $('.button-collapse').sideNav({
            menuWidth: 300,
            edge: 'left',
        }
    );

    $('.button-collapse').on('click', function() {
        // eslint-disable-next-line
        $(this).toggleClass('active');
    });

    // Add tabs to url hash
    (function($tabs) {
        if (!$tabs.length) return;

        $tabs.on('click', function(e) {
            if (window.location.hash === e.currentTarget.getAttribute('href')) return;
            var path = window.location.href;
            if (path.indexOf('#')) {
                path = path.substr(0, path.indexOf('#'));
            }
            window.location.href = path + e.currentTarget.getAttribute('href');
        });

        window.onhashchange = function(event) {
            var tab = event.newURL.substr(event.newURL.indexOf('#') + 1, event.newURL.length);
            var scrollTop = document.body.scrollTop;
            if (!$tabs.parent().find('a[href$="' + tab + '"]')) {
                return;
            }
            $tabs.parent().tabs('select_tab', tab);
            window.scrollTo(0, scrollTop);
        };
    }($('.tabs a')));

    $(document).on('click touchstart', function(e) {
        if ($(e.target).closest('.drag-target').length) {
            $('.button-collapse').toggleClass('active');
        }
    });

    $(document).on('click', '.js-vault-confirm', function(e) {
        var text = $(e.target).hasClass('js-vault-confirm')
            ? $(e.target).data('confirm')
            : $(e.target).parent('.js-vault-confirm').data('confirm');
        if (!window.confirm(text)) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
});
