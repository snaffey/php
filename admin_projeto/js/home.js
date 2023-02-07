$(document).ready(function () {
    $('#mais-informacao').click(function () {
        $.ajax({
            url: 'getImovelInfo.php',
            type: 'POST',
            data: { id: $('#id-imovel').text() },
            success: function (data) {
                $('#info-imovel').html(data);
            },
        });
    });

    $('.contact-link').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'contactos.php',
            success: function (result) {
                $('.location_banner, main, footer').hide();
                $('.header').after(result);
            },
        });
    });
});
