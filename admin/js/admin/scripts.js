(function () {
    "use strict";

    // custom scrollbar

    $("html").niceScroll({
        styler: "fb",
        cursorcolor: "#F2B33F",
        cursorwidth: '6',
        cursorborderradius: '10px',
        background: '#424f63',
        spacebarenabled: false,
        cursorborder: '0',
        zindex: '1000'
    });

    $(".scrollbar1").niceScroll({
        styler: "fb",
        cursorcolor: "rgba(97, 100, 193, 0.78)",
        cursorwidth: '6',
        cursorborderradius: '0',
        autohidemode: 'false',
        background: '#F1F1F1',
        spacebarenabled: false,
        cursorborder: '0'
    });


    $(".scrollbar1").getNiceScroll();
    if ($('body').hasClass('scrollbar1-collapsed')) {
        $(".scrollbar1").getNiceScroll().hide();
    }

})(jQuery);

function Logout(e) {
    e.preventDefault();
    $.post('index.php?action&LogOutAction', function () {
        window.location.reload();
    })
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/([\w-.]+)@((?:yeco-aden+.)+)([a-zA-Z]{2,4})/i);
    return pattern.test(emailAddress);
};

function UpdatePublish(i, c) {
    var btn = $(c);
    btn.attr('disabled', 'disabled');
    $.post('index.php?action&UpdatePublish&nid=' + i, function () {
        if (btn.find('i').hasClass('fa-pause')) {
            btn.find('i').removeClass('fa-pause');
            btn.find('i').addClass('fa-play');
            btn.find('span').text('غير منشور');
            btn.removeAttr('disabled');
        } else {
            btn.find('i').removeClass('fa-play');
            btn.find('i').addClass('fa-pause');
            btn.find('span').text(' تم النشر');
            btn.removeAttr('disabled');
        }
    });

}

$(function () {
    $('form[name=add-user-form]').on('submit', function (e) {
        e.preventDefault();
        var email_address = $(this).find('input[name=email]').val();
        var form = $(this);
        if (isValidEmailAddress(email_address)) {
            $.post('index.php?action&addUser', form.serialize(), function (x) {
                $('.error-box').hide().find('.Email-Ex,.Email-Error,.Email-NT-CORR').hide();
                $('.sec-box').hide().find('.added-alert').hide();
                if (x == 'EX') {
                    $('.error-box').show().find('.Email-Ex').slideDown();
                } else if (x == 'ONYECO') {
                    $('.error-box').show().find('.Email-Error').slideDown();
                } else if (x == 'EMLERR') {
                    $('.error-box').show().find('.Email-NT-CORR').slideDown();
                } else {
                    form[0].reset();
                    $('.sec-box').show().find('.added-alert').slideDown();
                }
            })
        } else {
            $('.error-box').show().find('.Email-Error').show();
        }
    });
    $('form[name=add-data]').on('submit', function (e) {
        e.preventDefault();
        $('.sec-box').hide();
        var form = $(this);
        $.post('index.php?action&addData', form.serialize(), function (d) {
            // $('.sec-box').slideDown();
            // form[0].reset();
            alert(d);
        })
    });

    $('form[name=slides]').ajaxForm({
        url: 'index.php?action&addData',
        // type:'POST',
        success: function (mediaFile) {
            alert(mediaFile);
            var text = '';
            alert('تمت الاضافة بنجاح');
            $('form[name=slides]')[0].reset();
        },
        error: function () {
            alert('error');
        }
    });
    $('form[name=add-news]').ajaxForm({
        url: 'index.php?action&addData',
        // type:'POST',
        success: function (mediaFile) {
            var text = '';
            alert('تمت الاضافة بنجاح');
            $('form[name=add-news]')[0].reset();

        },
        error: function () {
            alert('error');
        }
    });
    $('.update-home-manager').ajaxForm({
        url: 'index.php?action&updateHomePage&section=Managers',
        // type:'POST',
        success: function (mediaFile) {
            $('.update-home-manager')[0].reset();
            var text = '';
            alert('تم التحديث بنجاح');
            // $('.offer-form')[0].reset();
            // var rand = Math.random();
            // text += '<div class="return_img" style="background-image: url(media/'+mediaFile+');width:200px;height: 200px;background-position: center;background-size: contain;background-repeat: no-repeat"></div> ' +
            //     '<input type=hidden name="media[]" value="'+mediaFile+'">';
            // $('.media').append(text);
        },
        error: function () {
            alert('error');
        }
    });
});

function deleteData(i, types) {
    $.post('index.php?action&deleteData&type=' + types + '&id=' + i, function () {
        $('button[name=refresh]').click();
    });
}

                     
     
  