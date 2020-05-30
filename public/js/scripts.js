// navigation slide-in
$(window).load(function () {

    $('.loading_backgrounds').hide();

});
$(window).on("scroll", function () {
    if ($(window).scrollTop() > 50) {
        $(".header").addClass("active");

    } else {
        //remove the background property so it comes transparent again (defined in your css)
        $(".header").removeClass("active");
    }
});
$(document).ready(function () {

    /* Every time the window is scrolled ... */
    $(window).scroll(function () {
        /* Check the location of each desired element */
        $('.hideme').each(function (i) {
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            /* If the object is completely visible in the window, fade it it */
            if (bottom_of_window > bottom_of_object) {
                $(this).animate({'opacity': '1'}, 500);
            }
        });

    });

});

function socialWindow(url) {
    var left = (screen.width - 570) / 2;
    var top = (screen.height - 570) / 2;
    var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
    window.open(url, "NewWindow", params);
}

function setShareLinks(Url) {
    pageUrl = encodeURIComponent(document.URL + '/' + Url);
    var tweet = encodeURIComponent(jQuery("meta[property='og:description']").attr("content"));
    jQuery(".social-share.facebook").on("click", function () {
        url = "https://www.facebook.com/sharer.php?u=" + pageUrl;
        socialWindow(url);
    });
    jQuery(".social-share.twitter").on("click", function () {
        url = "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + tweet;
        socialWindow(url);
    });
}
$(function () {
    $('.change_lang').on('click', function (e) {
        e.preventDefault();
        $.get('index.php?action&change_language', function () {
            window.location.reload();
        });
    });
    $('.nav_slide_button').click(function () {
        $('.pull').slideToggle();
    });
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true   // 100% fit in a container
    });
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
    var menu_ul = $('.menu > li > ul'),
        menu_a = $('.menu > li > a');
    menu_ul.hide();
    menu_a.click(function (e) {
        e.preventDefault();
        if (!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true, true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true, true).slideUp('normal');
        }
    });
    $('.service-list').on('change', function (e) {
        let vl = $(this).val();
        if (vl !== 0) {
            $.get('index.php?action&GetProjectList&id=' + vl, function (list) {
                $('.project-list').html(list).removeAttr('disabled');
            });
        } else {
            $('.project-list').attr('disabled', 'disabled');
        }
    });
});