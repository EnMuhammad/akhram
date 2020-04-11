/////////////////// - Functions - /////////////
$.fn.centerToWindow = function () {
    var obj = $(this);
    var obj_width = $(this).outerWidth(true);
    var obj_height = $(this).outerHeight(true);
    var window_width = window.innerWidth ? window.innerWidth : $(window).width();
    var window_height = window.innerHeight ? window.innerHeight : $(window).height();

    obj.css({
        "position": "fixed",
        "top": ((window_height / 2) - (obj_height / 2)) + "px",
        "left": ((window_width / 2) - (obj_width / 2)) + "px"
    });
}

function Change_lang(lang) {
    $.get('index.php?lang=' + lang, function () {
        location.reload();
    })


}

function change_arrow(img) {

    $(img).toggleClass('arrow_down arrow_up');


}

function LoadAlbum(id, name, photo) {
    photo = photo || false;
    var url = "";
    $('.Window_loder').centerToWindow();
    $('.blackbackground').fadeIn();
    $('.Window_loder').fadeIn();
    if (photo != false) {
        url = "&photo=" + photo;
    }
    $('.Window_loder .Data_load').load('index.php?load_album&albumid=' + id + url, function () {
        $('.Window_loder .foot .album_name').html(name);
        $(".Window_loder .Data_load .list").mCustomScrollbar({
            scrollButtons: {
                enable: true
            },
            theme: "rounded"
        });
        $('.Window_loder .Ele').fadeOut();
    });
    $('.blackbackground').on('click', function () {
        closealbum();
    })

}

function hide_show_point(i, id) {
    change_arrow(i);
    $('.points_' + id).toggle();
    var target = $('.points_' + id);
    $('html,body').animate({scrollTop: target.offset().top}, 'slow');
}

function Certi_view(id, name) {
    $('.Window_loder').centerToWindow();
    $('.blackbackground').fadeIn();
    $('.Window_loder').fadeIn();
    $('.Window_loder .Data_load').load('home?certiview&id=' + id, function () {
        $('.Window_loder .foot .album_name').html(name);
        $(".Window_loder .Data_load .list").mCustomScrollbar({
            scrollButtons: {
                enable: true
            },
            theme: "rounded"
        });
        $('.Window_loder .Ele').fadeOut();
    });
    $('.blackbackground').on('click', function () {
        closealbum();
    })
}

function closealbum() {
    $('.Window_loder .Data_load').html('');

    $('.blackbackground').fadeOut();
    $('.Window_loder').fadeOut(function () {

        $('.Window_loder .Ele').fadeIn();


    });

}

function lunch_loader() {
    var lang = $('.WEB_LANG').val();
    if (lang == 'en') {
        $('.Page_loder').addClass('ab_left');

    } else {
        $('.Page_loder').addClass('ab_right');
    }
    $('.Page_loder_Background').fadeIn(function () {
        $('.Page_loder').show();
    })
}

function stop_loader() {
    var lang = $('.WEB_LANG').val();
    if (lang == 'en') {
        $('.Page_loder').removeClass('ab_left');

    } else {
        $('.Page_loder').removeClass('ab_right');
    }
    $('.Page_loder_Background').fadeOut(function () {
        $('.Page_loder').hide();
    })


}

function loadHomeProject(i) {
    $('.container .data .DataContent .box .Arti .content').html('<div class="loader"></div>');
    $('.container .data .DataContent .box .Arti .content').load('home?project&id=' + i);

}

function load_serv(hash) {

    hash = hash || false;
    if (hash != false) {
        hs = '#' + hash;
    } else {
        hs = '';
    }

    if ($('.container .data').length == 0) {
        window.location.replace('Services' + hs);
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'Services' + hs);
        }
        $('.dir_page').val('services');
        $('.container .data_load').load('home?services&asLoad', function () {
            if (hash != false) {
                var target = $("a[name='" + hash + "']");
                $('html,body').animate({scrollTop: target.offset().top}, 'slow');
            }
        });
    }
    return false;
}

function company_overview(i) {
    i = i || 'US';
    if ($('.container .data').length == 0) {
        window.location.replace('CompanyOverview&section=' + i);
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'CompanyOverview&section=' + i);
        }
        $('.dir_page').val('overview');
        $('.container .data_load').load('home?winfo&asLoad&ac=' + i, function () {

        });
    }
    return false;
}

function Contact_us() {
    i = i || 'US';
    if ($('.container .data').length == 0) {
        window.location.replace('ContactUs');
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'ContactUs');
        }
        $('.dir_page').val('overview');
        $('.container .data_load').load('ContactUs&asLoad', function () {

        });
    }
    return false;
}

function LoadAlbumPage(btn) {
    if ($('.container .data').length == 0) {
        window.location.replace('albums');
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'albums');
        }
        $('.dir_page').val('albums');
        $('html, body').animate({scrollTop: 0}, 800);
        $('.container .data_load').load('home?loadallAlbums&asLoad', function () {
        });
    }
    return false;

}

function LoadProjectPage(i) {
    if ($('.container .data').length == 0) {
        window.location.replace('Project=' + i);
    } else {
        lunch_loader();
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'Project=' + i);
        }
        $('.dir_page').val('vpro');
        $('html, body').animate({scrollTop: 0}, 800);
        lunch_loader();
        $('.container .data_load').load('home?view_project&asLoad&pid=' + i, function () {
            stop_loader();
        });
        stop_loader();
    }

}

function LoadSectionContent(i, n) {
    if ($('.container .data').length == 0) {
        window.location.replace('Folder=' + i + '&name=' + n);
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'Folder=' + i + '&name=' + n);
        }
        $('.dir_page').val('equipments');
        $('html, body').animate({scrollTop: 0}, 800);
        $('.container .data_load').html('');
        $('.container .data_load').load('home?equipments&asLoad&bysec&sec=' + i);
    }

    return false;
}

function LoadEquPage(btn) {
    if ($('.container .data').length == 0) {
        window.location.replace('equipments');
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'equipments');
        }
        $('.dir_page').val('equipments');
        $('html, body').animate({scrollTop: 0}, 800);
        $('.container .data_load').load('home?equipments&asLoad');

    }

}

function LoadSecPage() {
    if ($('.container .data').length == 0) {
        window.location.replace('Sections');
    } else {
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'Sections');
        }
        $('.dir_page').val('sections');
        $('.container .data_load').load('home?sections&asLoad');
    }

    return false;
}

function LoadprojectsPage() {
    if ($('.container .data').length == 0) {
        window.location.replace('Projects');
    } else {
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'Projects');
        }
        $('.container .data').fadeOut();
        $('.dir_page').val('Projects');
        $('.container .data_load').load('home?projects&asLoad');
    }
    return false;
}

function Search_albums(btn, type) {
    var search_text;
    var url;

    if (type == 0) {

        search_text = $(btn).parent().children('#search_albums');
        $('.Load_search_Name').show();
        if ($.trim(search_text.val()) == '') {
            url = '';
        } else {

            url = '&name=' + search_text.val();
        }

        if (window.history.replaceState) {
            window.history.replaceState('', '', 'album' + url);
        }
    } else if (type == 1) {

        search_text = $(btn).parent().children('#projects');
        $('.Load_search_project').show();
        if ($.trim(search_text.val()) == 0) {
            url = '';
        } else {

            url = '&byproject&pid=' + search_text.val();
        }

        if (window.history.replaceState) {
            window.history.replaceState('', '', 'albums' + url);
        }
    }
    $('.Page').load('index.php?loadallAlbums&asLoad' + url);

}

function Search_Project(btn) {
    var country = $(btn).parent().children('#country');
    var city = $(btn).parent().children('#city');
    var url;

    if (country.val() != 0) {
        if (city.val() != 0) {
            url = '&country=' + country.val() + '&city=' + city.val();
        } else {
            url = '&country=' + country.val();
        }
        lunch_loader();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'Projects' + url);
        }
    }
    $('.Page').load('home?projects&asLoad' + url, function () {
        stop_loader();
    });
}

function Project_album(i) {

    if ($('.container .data').length == 0) {
        window.location.replace('albums&byproject&pid=' + i);
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'albums&byproject&pid=' + i);
        }
        $('.dir_page').val('sections');
        $('.container .data_load').load('albums&asLoad&byproject&pid=' + i);
    }
}

function LoadPhoto(img) {
    var imgs = $(img).css('backgroundImage').replace('url(', '').replace(')', '');
    var box = $(img).parent();
    $('.Album_View .list .image').removeClass('selected');
    box.addClass('selected');
    $('.Album_View .viewer .image_view').fadeOut().attr('src', imgs).fadeIn();


}

function LoadEqu(i) {
    if ($('.data_load').length == 0) {
        window.location.replace('equipment&id=' + i);
    } else {
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'equipment&id=' + i);
        }
        $('.dir_page').val('equipment_page');
        $('.container .data_load').load('home?equipment&id=' + i + '&asLoad', function () {
        });
    }


}

function LoadMoreAlbums(page, link) {
    $(link).attr('onclick', '').css('cursor', 'default');

    $(link).html('<img src="library/styles/images/loading.gif">');
    var A = $(link).parent('a');
    $.get('home?loadallAlbums&asLoad&page=' + page, function (data) {
        A.remove();
        $('.Page .Page_container .APPEND_NEW_' + page).append(data);
    });


    return false;
}

function LoadMoreProject(p, l) {
    $(l).attr('onclick', '').css('cursor', 'default');
    var url;
    if ($('.country_search').length != 0) {
        var country = $('.country_search').val();
        if ($('.city_search').length != 0) {
            var city = $('.city_search').val();
            url = '&country=' + country + '&city=' + city;
        } else {
            url = '&country=' + country;
        }
    } else {
        url = '';
    }

    $(l).html('<img src="library/styles/images/loading.gif">');
    var A = $(l).parent('a');
    $.get('home?projects&asLoad&page=' + p + url, function (data) {
        A.remove();
        $('.Page .Page_container .APPEND_NEW_' + p).append(data);
        $('html, body').animate({scrollTop: $(document).height() - $(window).height()}, 800);
    });


    return false;
}

function LoadMoreEqus(page, link) {
    $(link).attr('onclick', '').css('cursor', 'default');

    $(link).html('<img src="library/styles/images/loading.gif">');
    var A = $(link).parent('a');
    $.get('index.php?equipments&asLoad&page=' + page, function (data) {
        A.remove();
        $('.Page .Page_container .APPEND_NEW_' + page).append(data);
    });


    return false;
}

function LoadMoreSec(page, link) {
    $(link).attr('onclick', '').css('cursor', 'default');

    $(link).html('<img src="library/styles/images/loading.gif">');
    var A = $(link).parent('a');
    $.get('Sections&asLoad&page=' + page, function (data) {
        A.remove();
        $('.Page .Page_container .APPEND_NEW_' + page).append(data);
    });


    return false;
}

function SendFeedBack(b) {
    var name = $('.contact_form').children('input[type="text"]:first');
    var email = $('.contact_form').children('input[type="text"]:eq(1)');
    var text = $('.contact_form').children('textarea');
    var emailcheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var lang = [];
    var langs = 'ar';
    switch (langs) {
        case 'en':
        default :
            lang['ERROR_EMPTY'] = "All fields are required ";
            lang['EMAIL_ERROR'] = "Email is not correct !";
            lang['DONE'] = "Message sent";
            lang['ERROR'] = "Error Sending, please try again later !";
            lang['div'] = "left";
            break;
        case 'ar':
            lang['ERROR_EMPTY'] = "جميع الحقول مطلوبة";
            lang['EMAIL_ERROR'] = "البريد الالكتروني خاطىء";
            lang['DONE'] = "تم أرسال الرسالة";
            lang['ERROR'] = "حدث خطأ أثناء الأرسال, حاول مرة أخرى";
            lang['div'] = "right";
            break;


    }
    if ($.trim(name.val()) == '') {
        name.focus();
        return false;
    }
    if ($.trim(email.val()) == '') {
        email.focus();
        return false;
    }
    if (!emailcheck.test(email.val())) {
        email.focus();
        return false;
    }
    if ($.trim(text.val()) == '') {
        text.focus();
        return false;
    }
    $('.contact_page .box .loader').show();
    $('.contact_page .box input[type="button"]').attr('disabled', 'disabled');
    $('.contact_page .box .contact_form textarea').attr('disabled', 'disabled');
    $('.contact_page .box .contact_form input[type="text"]').attr('disabled', 'disabled');
    $.post('home', {sendfeedback: true, name: name.val(), email: email.val(), text: text.val()}, function (e) {
        $('.contact_page .box .loader').hide();
        $('.contact_page .box input[type="button"]').removeAttr('disabled');
        $('.contact_page .box .contact_form textarea').removeAttr('disabled');
        $('.contact_page .box .contact_form input[type="text"]').removeAttr('disabled');
        if (e == 'ERROR_EMPTY') {
            $('.contact_page .box .contact_form .ERRORS_' + lang['div']).show().html(lang[e]);
        } else if (e == 'EMAIL_ERROR') {
            $('.contact_page .box .contact_form .ERRORS_' + lang['div']).show().html(lang[e]);
        } else if (e == 'DONE') {
            $('.contact_page .box .contact_form .DONE_' + lang['div']).show().html(lang[e]);
            name.val('');
            email.val('');
            text.val('');
        } else if (e == 'ERROR') {
            $('.contact_page .box .contact_form .ERRORS_' + lang['div']).show().html(lang[e]);
        }
    })
}

///////////////////// - Sliders - ////////////////////////


(function ($, f) {
    if (!$) return f;
    var Unslider = function () {
        //  Set up our elements
        this.el = f;
        this.items = f;

        //  Dimensions
        this.sizes = [];
        this.max = [0, 0];

        //  Current inded
        this.current = 0;

        //  Start/stop timer
        this.interval = f;

        //  Set some options
        this.opts = {
            speed: 500,
            delay: 3000, // f for no autoplay
            complete: f, // when a slide's finished
            keys: !f, // keyboard shortcuts - disable if it breaks things
            dots: f, // display ••••o• pagination
            fluid: f // is it a percentage width?,
        };

        //  Create a deep clone for methods where context changes
        var _ = this;

        this.init = function (el, opts) {
            this.el = el;
            this.ul = el.children('ul');
            this.max = [el.outerWidth(), el.outerHeight()];
            this.items = this.ul.children('li').each(this.calculate);

            //  Check whether we're passing any options in to Unslider
            this.opts = $.extend(this.opts, opts);

            //  Set up the Unslider
            this.setup();

            return this;
        };

        //  Get the width for an element
        //  Pass a jQuery element as the context with .call(), and the index as a parameter: Unslider.calculate.call($('li:first'), 0)
        this.calculate = function (index) {
            var me = $(this),
                width = me.outerWidth(), height = me.outerHeight();

            //  Add it to the sizes list
            _.sizes[index] = [width, height];

            //  Set the max values
            if (width > _.max[0]) _.max[0] = width;
            if (height > _.max[1]) _.max[1] = height;
        };

        //  Work out what methods need calling
        this.setup = function () {
            //  Set the main element
            this.el.css({
                overflow: 'hidden',
                width: _.max[0],
                height: this.items.first().outerHeight()
            });

            //  Set the relative widths
            this.ul.css({width: (this.items.length * 100) + '%', position: 'relative'});
            this.items.css('width', (100 / this.items.length) + '%');

            if (this.opts.delay !== f) {
                this.start();
                this.el.hover(this.stop, this.start);
            }

            //  Custom keyboard support
            this.opts.keys && $(document).keydown(this.keys);

            //  Dot pagination
            this.opts.dots && this.dots();

            //  Little patch for fluid-width sliders. Screw those guys.
            if (this.opts.fluid) {
                var resize = function () {
                    _.el.css('width', Math.min(Math.round((_.el.outerWidth() / _.el.parent().outerWidth()) * 100), 100) + '%');
                };

                resize();
                $(window).resize(resize);
            }

            if (this.opts.arrows) {
                this.el.parent().append('<p class="arrows"><span class="prev">←</span><span class="next">→</span></p>')
                    .find('.arrows span').click(function () {
                    $.isFunction(_[this.className]) && _[this.className]();
                });
            }
            ;

            //  Swipe support
            if ($.event.swipe) {
                this.el.on('swipeleft', _.prev).on('swiperight', _.next);
            }
        };

        //  Move Unslider to a slide index
        this.move = function (index, cb) {
            //  If it's out of bounds, go to the first slide
            if (!this.items.eq(index).length) index = 0;
            if (index < 0) index = (this.items.length - 1);

            var target = this.items.eq(index);
            var obj = {height: target.outerHeight()};
            var speed = cb ? 5 : this.opts.speed;

            if (!this.ul.is(':animated')) {
                //  Handle those pesky dots
                _.el.find('.dot:eq(' + index + ')').addClass('active').siblings().removeClass('active');

                this.el.animate(obj, speed) && this.ul.animate($.extend({left: '-' + index + '00%'}, obj), speed, function (data) {
                    _.current = index;
                    $.isFunction(_.opts.complete) && !cb && _.opts.complete(_.el);
                });
            }
        };

        //  Autoplay functionality
        this.start = function () {
            _.interval = setInterval(function () {
                _.move(_.current + 1);
            }, _.opts.delay);
        };

        //  Stop autoplay
        this.stop = function () {
            _.interval = clearInterval(_.interval);
            return _;
        };

        //  Keypresses
        this.keys = function (e) {
            var key = e.which;
            var map = {
                //  Prev/next
                37: _.prev,
                39: _.next,

                //  Esc
                27: _.stop
            };

            if ($.isFunction(map[key])) {
                map[key]();
            }
        };

        //  Arrow navigation
        this.next = function () {
            return _.stop().move(_.current + 1)
        };
        this.prev = function () {
            return _.stop().move(_.current - 1)
        };

        this.dots = function () {
            //  Create the HTML
            var html = '<ol class="dots">';
            $.each(this.items, function (index) {
                html += '<li class="dot' + (index < 1 ? ' active' : '') + '">' + (index + 1) + '</li>';
            });
            html += '</ol>';

            //  Add it to the Unslider
            this.el.addClass('has-dots').append(html).find('.dot').click(function () {
                _.move($(this).index());
            });
        };
    };

    //  Create a jQuery plugin
    $.fn.unslider = function (o) {
        var len = this.length;

        //  Enable multiple-slider support
        return this.each(function (index) {
            //  Cache a copy of $(this), so it
            var me = $(this);
            var instance = (new Unslider).init(me, o);

            //  Invoke an Unslider instance
            me.data('unslider' + (len > 1 ? '-' + (index + 1) : ''), instance);
        });
    };
})(window.jQuery, false);


$(function () {

    $('.slides').unslider({
        speed: 500,               //  The speed to animate each slide (in milliseconds)
        delay: 3000,              //  The delay between slide animations (in milliseconds)

        keys: true,               //  Enable keyboard (left, right) arrow shortcuts
        dots: true,               //  Display dot navigation
        fluid: false              //  Support responsive design. May break non-responsive designs
    });

    $('.container .data .DataContent .box .certificate').mCustomScrollbar({
        theme: "dark-thick",
        axis: "x",
        scrollButtons: {
            enable: true
        },
        advanced: {
            autoExpandHorizontalScroll: true,
            updateOnContentResize: true
        }

    });
    $('.container .data .DataContent .box .Arti .content').load('home?project')
    $('.container .data .DataContent .box .News li').not('.Title').on('click', function () {
        var id = $(this).attr('id');
        $('.container .data .DataContent .box .News li .Buble').remove();

        $(this).append('<div class="Buble"></div>');
        $('.container .data .DataContent .box .News li .Buble').fadeIn();

        $('.container .data .DataContent .box .News li .Buble').load('index.php?news=' + id);


        $(document).mouseup(function (e) {
            var container = $(".container .data .DataContent .box .News li .Buble");

            if (!container.is(e.target)
                && container.has(e.target).length === 0) {
                container.hide();
            }
        });

    })
    $('.container .top_bar li a').on('click', function (e) {
        var cur_dir = $('.container .dir_page');
        var dis = $(this).attr('id');
        $('.drop_down').slideUp();
        $('.drop_down li').fadeOut();
        $(this).parent().children('.drop_down').find('li').fadeIn();
        $(this).siblings('.drop_down').slideDown('400');


        if (dis == 'home') {
            if (cur_dir.val() == 'home') {
                return false;
            } else {
                if ($('.data_load').length == 0) {
                    window.location.replace('home');
                } else {
                    $('.data_load').html('');
                    $('.container .data').fadeIn();
                    cur_dir.val(dis);
                    if (window.history.replaceState) {
                        window.history.replaceState('', '', 'home');
                    }
                }

            }


        } else if (dis == 'works') {


        }
        return false;

    })
    $('.container .top_bar li .drop_down li').mouseenter(function () {

        $(this).css({'background': 'white', 'color': 'black'});
        $(this).children('a').css({'background': 'white', 'color': 'black'});


    }).mouseleave(function () {

        $(this).children('a').css({'background': '', 'color': ''});
        $(this).css({'background': '', 'color': ''});
    })
    $('.container .data .DataContent .box .Albums .project .title').on('click', function () {
        var id = $(this).parent().attr('id');
        $('.container .data').fadeOut();
        if (window.history.replaceState) {
            window.history.replaceState('', '', 'equipment&id=' + id);
        }

        $('.dir_page').val('equipment_page');
        $('.container .data_load').load('home?equipment&id=' + id + '&asLoad', function () {
        });
    })

    $('.container .data .DataContent .footer_box img[class="Search"]').on('click', function () {
        var w = $('input[class="Search"]').css('width');
        if (w == '0' || w == '0px') {
            $('input[class="Search"]').show();
            $('input[class="Search"]').animate({'width': '328px'}, 'fast')
        } else {

            $('input[class="Search"]').animate({'width': '0px'}, 'fast');
            $('input[class="Search"]').fadeOut();
        }


    })

})