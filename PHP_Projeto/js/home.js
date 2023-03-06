$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: './home.php',
        success: function (data) {
            $('.mainer').html(data);
        },
    });

    $('.ajax').click(function (e) {
        e.preventDefault();
        console.log('Ajax link clicked');
        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            success: function (data) {
                $('.mainer').html(data);
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });
});
