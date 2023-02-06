$(document).ready(function () {
    $('#mais-informacao').click(function () {
        $.ajax({
            url: 'getImovelInfo.php',
            type: 'POST',
            data: { id: window.location.search.substring(1).split('=')[1] },
            success: function (data) {
                $('#info-imovel').html(data);
            },
        });
    });
});
