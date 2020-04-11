/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 * 4/11/2019
 */
$(function () {
    $('.login_form').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        $.post('index.php?action&LoginAction', form.serialize(), function (data) {
            if (data == 100) {
                window.location.reload();
            } else if (data == 1) {
                alert('كلمة المرور خاطئة');
            } else if (data == 0) {
                alert('البريد الالكتروني او كلمة المرور خاطئة')
            } else if (data == 5) {
                alert('فقط @yeco-aden')
            } else if (data == 4) {
                alert('تاكد من ادخال البريد الالكتروني بشكل صحيح')
            }
        });
    });
});