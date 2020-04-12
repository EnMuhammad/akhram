// navigation slide-in
$(window).load(function () {

});
$(window).on("scroll", function () {
    if ($(window).scrollTop() > 50) {
        $(".header").addClass("active");

    } else {
        //remove the background property so it comes transparent again (defined in your css)
        $(".header").removeClass("active");
    }
});
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