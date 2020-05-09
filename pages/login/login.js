/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 * 5/5/2020
 */
$('form[name=login_]').on('submit', function (e) {
    e.preventDefault();
    let form = $(this), url = $(this).attr('action'), href = $('input[name=href]');

    $.post(url, form.serialize(), function (data) {
        if (data === '0') {
            window.location.href = href.val();
        } else {
            alert('Error');
        }
    });
});