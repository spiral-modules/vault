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

    $(document).on('click touchstart', function (e) {
        if ($(e.target).closest('#sidenav-overlay').length) {
            $('.button-collapse').toggleClass('active');
        }
    });
})