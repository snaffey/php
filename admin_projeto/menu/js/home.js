$(document).ready(function () {
  $.ajax({
    type: 'GET',
    url: './home.html',
    success: function (data) {
      $('.main').html(data)
    }
  })

  $('a').click(function () {
    $.ajax({
      type: 'GET',
      url: $(this).attr('href'),
      success: function (data) {
        $('.main').html(data)
      }
    })
    return false
  })
})
