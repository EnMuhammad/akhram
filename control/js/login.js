$(function () {
    $('.con input[type=button]').on('click', function () {
        var user = $('.con input[type=text]');
        var pass = $('.con input[type=password]');
        if ($.trim(user.val()) == '') {

            user.focus();
            return false;
        }
        if ($.trim(pass.val()) == '') {
            pass.focus();
            return false;
        }
        $('.con .loading').fadeIn();
        $.post('index.php', {login: true, user: user.val(), pass: pass.val()}, function (e) {
            $('.con .loading,.con .error ,.con .sec').hide();
            alert(e);
            if (e == '0') {
                $('.con .sec').fadeIn();
                setInterval(function () {
                    location.reload();

                }, 1000)
            } else if (e == '1') {
                $('.con .error').fadeIn();
                pass.val('');
            } else if (e == '2') {
                $('.con .error').fadeIn();
                pass.val('');
            }

        })
    })


})
