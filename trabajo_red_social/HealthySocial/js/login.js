$(document).ready(function () {

    $('#btn-register').on('click', function () {
        $('#login').hide(1000).addClass('displayNone');
        $('#register').hide().removeClass('displayNone').show(1000);

    });

    $('#btn-back').on('click', function () {
        $('#register').addClass('displayNone');
        $('#login').removeClass('displayNone').show(1000);

    });

});

