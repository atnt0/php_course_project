


$(document).ready(function () {

    $('.refresh-button').click(function () {
        $.ajax({
            type: 'get',
            url: $(this).attr('data-url-captcha'),
            success: function (data) {
                $('.captcha-image').html(data.captcha);
            }
        });
    });

});
