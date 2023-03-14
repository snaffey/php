$(document).ready(function () {
  $.ajax({
    type: 'GET',
    url: './home.php',
    success: function (data) {
      $('.mainer').html(data)
    }
  })

  $('#mais-informacao').click(function () {
    $.ajax({
      url: 'getImovelInfo.php',
      type: 'POST',
      data: { id: $('#id-imovel').text() },
      success: function (data) {
        $('#info-imovel').html(data)
      }
    })
  })

  $('a').click(function () {
    $.ajax({
      type: 'GET',
      url: $(this).attr('href'),
      success: function (data) {
        $('.mainer').html(data)
      }
    })
    return false
  })
})
