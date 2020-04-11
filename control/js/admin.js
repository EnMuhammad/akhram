$(function () {

    $('.contanir .contents .Tab_6 .load_sections').load('index.php?load_sections', function () {


        $('.Tab_6 .sections .Table_Home input[type="checkbox"]').on('change', function () {
            if ($('.Tab_6 .sections .Table_Home input[type="checkbox"]').is(':checked')) {

                $('.Tab_6 .sections .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteSections()');

            } else {
                $('.Tab_6 .sections .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

            }
        })
    });
    $('.contanir .contents .Tab_10 .users .load_users').load('index.php?users', function () {


        $('.Tab_10 .users .Table_Home input[type="checkbox"]').on('change', function () {
            if ($('.Tab_10 .users .Table_Home input[type="checkbox"]').is(':checked')) {

                $('.Tab_10 .users .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'Deleteuser()');

            } else {
                $('.Tab_10 .users .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

            }
        })
    });
    $('.contanir .contents .Tab_11 .load_sections').load('index.php?load_services', function () {
        $('.Tab_11 .Table_Home input[type="checkbox"]').on('change', function () {
            if ($('.Tab_11  .Table_Home input[type="checkbox"]').is(':checked')) {
                $('.Tab_11  .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteService()');

            } else {
                $('.Tab_11 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

            }
        })
    });
    $('.contanir .contents .Tab_7 .load_sections').load('index.php?load_branch', function () {
        $('.Tab_7 .Table_Home input[type="checkbox"]').on('change', function () {
            if ($('.Tab_7 .Table_Home input[type="checkbox"]').is(':checked')) {
                $('.Tab_7 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteBran()');

            } else {
                $('.Tab_7 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

            }
        })
    });

    $('.editor_content').jqte();
    $('.date_akhram_type').datepicker({
        showOn: "button",
        buttonImage: "jq/images/calendar-alt-24.png",
//       buttonImageOnly: true,
        buttonText: "أختر تاريخ",
        numberOfMonths: 2,
        showButtonPanel: true,
        changeYear: true,
        showOtherMonths: true,
        firstDay: 1
    });
    $('.date_akhram_type').datepicker("option", "dateFormat", "dd-mm-yy");


    $('.contanir .taskbar ul li').not('.Head_ul').on('click', function () {
        $('.contanir .taskbar ul li').removeClass('selected_item');
        var text = $(this).text();
        var id = $(this).attr('class');

        var info = $(this).find('input[type="hidden"]').val();
        $(this).addClass('selected_item');
        $('.contanir .body_head span').not('.Home_head').html(text);
        $('.contanir .body_head .Tab_info').html(info);
        $('.Tabs').removeClass('Tabs_selected');
        $('.Tab_' + id).addClass('Tabs_selected');
        if (window.history.replaceState) {
            window.history.replaceState('', '', '?tab=' + id);
        }

    })
    $('.contanir .contents .Tab_4 .Tab_View .rols').on('click', function () {
        $('.contanir .contents .Tab_4 .Tab_View .rols').removeClass('select_tap');
        $(this).addClass('select_tap');
        var tab = $(this).attr('id');
        $('.contanir .contents .Tab_4 .ALBUM_TAB').hide();
        $('.contanir .contents .Tab_4 .' + tab).show();
        if (tab == 'EDIT_ALBUMS') {

            $('.contanir .contents .Tab_4 .' + tab).load('index.php?albums', function () {


                $('.Tab_4 .Table_Home input[type="checkbox"]').on('change', function () {
                    if ($('.Tab_4 .Table_Home input[type="checkbox"]').is(':checked')) {

                        $('.Tab_4 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteAlbums()');

                    } else {
                        $('.Tab_4 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                    }
                })
            });


        }

    })
    $('.contanir .contents .Tab_6 .Tab_View .rols').not('.disabeld_tap').on('click', function () {
        $('.contanir .contents .Tab_6 .create_equ .Added').html('');
        $('.contanir .contents .Tab_6 .Tab_View .rols').removeClass('select_tap');
        $(this).addClass('select_tap');
        var tab = $(this).attr('id');
        $('.contanir .contents .Tab_6 .SEC_WINDOW').hide();
        $('.contanir .contents .Tab_6 .' + tab).show();
        if (tab == 'all_equ') {

            $('.contanir .contents .Tab_6 .' + tab).load('index.php?equipments', function () {


                $('.Tab_6 .Table_Home input[type="checkbox"]').on('change', function () {
                    if ($('.Tab_6 .Table_Home input[type="checkbox"]').is(':checked')) {

                        $('.Tab_6 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteEqu()');

                    } else {
                        $('.Tab_6 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                    }
                })
            });


        }

    })
    $('.contanir .contents .Tab_8 .Tab_View .rols').not('.disabeld_tap').on('click', function () {
//$('.contanir .contents .Tab_8 .create_equ .Added').html('') ;
        $('.contanir .contents .Tab_8 .Tab_View .rols').removeClass('select_tap');
        $(this).addClass('select_tap');
        var tab = $(this).attr('id');
        $('.contanir .contents .Tab_8 .tab').hide();
        $('.contanir .contents .Tab_8 .' + tab).show();
        if (tab == 'cert_all') {

            $('.contanir .contents .Tab_8 .' + tab).load('index.php?certificates', function () {


                $('.Tab_8 .Table_Home input[type="checkbox"]').on('change', function () {
                    if ($('.Tab_8 .Table_Home input[type="checkbox"]').is(':checked')) {

                        $('.Tab_8 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'Deletecertis()');

                    } else {
                        $('.Tab_8 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                    }
                })
            });


        }

    })
    $('.contanir .contents .Tab_10 .Tab_View .rols').not('.disabeld_tap').on('click', function () {

        $('.contanir .contents .Tab_10 .Tab_View .rols').removeClass('select_tap');
        $(this).addClass('select_tap');
        var tab = $(this).attr('id');
        $('.contanir .contents .Tab_10 .tab').hide();
        $('.contanir .contents .Tab_10 .' + tab).show();
//if(tab == 'cert_all'){
//    
//    $('.contanir .contents .Tab_8 .'+tab).load('index.php?certificates',function(){
//
//
//        $('.Tab_8 .Table_Home input[type="checkbox"]').on('change',function(){
//            if($('.Tab_8 .Table_Home input[type="checkbox"]').is(':checked')){
//
//                $('.Tab_8 .Table_Home input[type="button"]').attr('style','').attr('onclick','Deletecertis()');
//
//            }else{
//                $('.Tab_8 .Table_Home input[type="button"]').attr('style','color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick','');
//
//            }
//        })
//    });
//
//
//}

    })
    $('.contanir .contents .Tab_5 .section_tabs .tab').on('click', function () {

        var tab = $(this).attr('id');

        $('.contanir .contents .Tab_5 .section_tabs .tab').removeClass('selected');
        $(this).addClass('selected');
        $('.contanir .contents .Tab_5 .sections').hide();
        $('.' + tab).show();
        if (tab == 'section_b') {
            $('.contanir .contents .Tab_5 .section_b').load('index.php?load_works', function () {

                $('.Tab_5 .section_b .Table_Home input[type="checkbox"]').on('change', function () {
                    if ($('.Tab_5 .section_b .Table_Home input[type="checkbox"]').is(':checked')) {

                        $('.Tab_5 .section_b .Table_Home input[type="button"]').attr('style', '');
                        $('.Tab_5 .section_b .Table_Home input[type="button"]').attr('onclick', 'DeleteNews()');
                    } else {
                        $('.Tab_5 .section_b .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
                        $('.Tab_5 .section_b .Table_Home input[type="button"]').attr('onclick', '');
                    }
                })

            });
        }

    })

    $('.contanir .contents input[type="button"]').mouseover(function () {

        $(this).css({'backgroundColor': 'white', 'border': '1px solid #1EACF2', 'color': '#1EACF2'});


    }).mouseleave(function () {

        $(this).css({'backgroundColor': '#1EACF2', 'border': 'none', 'color': 'white'});


    })


    $('.contanir .body_head .user_log').on('click', function () {
        $('.contanir .body_head .user_log label .label_options').toggle();

    })

    $('.Tab_2 .PALBUM').on('change', function () {
        var bar = $('.contanir .contents .Tabs .upload_progress .bar_width');
        var dir = $('.SLIDE_FILE').val();
        var slides = $('.sliders .slide_box').length;
        if (slides == 6) {
            $('.MAX_ERROR').html('العدد المسموح 6 شرائح');
            $('.Tab_2 .PALBUM').val('');
            return false;
        }
        $('.uploadFiles').ajaxSubmit({
            type: 'post',
            url: 'index.php?ImageUpload',
            beforeSubmit: function () {
                $('.counter').show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var pVel = percentComplete + '%';
                bar.width(pVel);
                $('.counter').html(pVel);
            },
            success: function (data) {
                var slides = $('.sliders .slide_box').length;
                if (slides == 6) {
                    $('.MAX_ERROR').html('العدد المسموح 6 شرائح');
                    $('.Tab_2 .PALBUM').val('');
                    return false;
                }
                if (data == 'LIMIT_MAX') {
                    $('.MAX_ERROR').html('العدد المسموح 6 شرائح');
                    bar.width('0%');
                    $('.counter').hide();
                    $('.Tab_2 .PALBUM').val('');
                    $('.sliders').load('index.php?slides');
                } else if (data == 1) {
                    $('.sliders').load('index.php?slides');
                    bar.width('0%');
                    $('.counter').hide();
                    $('.Tab_2 .PALBUM').val('');
                }
            },
            error: function () {
                alert('Error');
            }
        });


    })

    $('.Tab_4 .PHOTOALBUM').on('change', function () {
        var bar = $('.Tab_4 .cirule .loader');
        $('.Tab_4 .uploadalbumFiles').ajaxSubmit({
            type: 'post',
            url: 'index.php?album_temp_upload',
            beforeSubmit: function () {
                bar.show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var pVel = percentComplete + '%';
                bar.css('border-right-color', 'black');
                if (percentComplete == 25) {
                    bar.css('border-top-color', 'black');
                }
                if (percentComplete == 50) {
                    bar.css('border-top-left', 'black');
                }
                if (percentComplete == 100) {
                    bar.css('border-color', 'black');
                }
                $('.album_upload_counter').html(pVel);
            },
            success: function (data) {
                bar.hide();

                $('.Tab_4 .album_upload_counter').html('<img src="images/correct.png"> تم رفع الصور بنجاح');
                $('.Tab_4 .uploadalbumFiles input[type="file"]').val('');
                $('.contanir .contents .Tab_4 .files').val(data);
            },
            error: function () {
                alert('Error');
            }
        });


    })
    $('.Tab_4').find('input[type="button"]').on('click', function () {

        var ar = $('.Tab_4 input[type="text"]:first');
        var en = $('.Tab_4 input[type="text"]:eq(1)');
        var pr = $('.Tab_4 select');
        var file = $('.Tab_4 input[type="hidden"]');
        if ($.trim(ar.val()) == '') {
            ar.focus();
            return false;
        }
        if ($.trim(en.val()) == '') {
            en.focus();
            return false;
        }
        if (file.val() == '') {
            $('.Tab_4 .album_upload_counter').html('<img src="images/error.png"> يجب  على الأقل رفع صورة واحده');
            return false;
        }
        $.post('index.php', {
            createalbum: true,
            ar: ar.val(),
            en: en.val(),
            pro: pr.val(),
            files: file.val()
        }, function () {
            $('.Tab_4 .PLZ_WAIT').html('تم أنشاء الألبوم بنجاح');
            $('.Tab_4 input[type="text"]').val('');
            $('.Tab_4 input[type="hidden"]').val('');

        })

    })
    $('.Tab_5 .PHOTOALBUM').on('change', function () {

        var bar = $('.cirule .loader');
        $('.Tab_5 .uploadalbumFiles').ajaxSubmit({
            type: 'post',
            url: 'index.php?album_temp_upload',
            beforeSubmit: function () {
                bar.show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var pVel = percentComplete + '%';
                bar.css('border-right-color', 'black');
                if (percentComplete == 25) {
                    bar.css('border-top-color', 'black');
                }
                if (percentComplete == 50) {
                    bar.css('border-top-left', 'black');
                }
                if (percentComplete == 100) {
                    bar.css('border-color', 'black');
                }
                $('.album_upload_counter').html(pVel);
            },
            success: function (data) {
                bar.hide();

                $('.album_upload_counter').html('<img src="images/correct.png"> تم رفع الصور بنجاح');
                $('.uploadalbumFiles input[type="file"]').val('');
                $('.contanir .contents .Tab_5 .files').val(data);
            },
            error: function () {
                alert('Error');
            }
        });


    })
    $('.Tab_6 .PHOTOSECTION').on('change', function () {
        var bar = $('.contanir .contents .Tab_6 .cirule .loader');
        $('.uploadSectionImg').ajaxSubmit({
            type: 'post',
            url: 'index.php?section_temp_upload',
            beforeSubmit: function () {
                bar.show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var pVel = percentComplete + '%';
                bar.css('border-right-color', 'black');
                if (percentComplete == 25) {
                    bar.css('border-top-color', 'black');
                }
                if (percentComplete == 50) {
                    bar.css('border-top-left', 'black');
                }
                if (percentComplete == 100) {
                    bar.css('border-color', 'black');
                }
                $('.contanir .contents .Tab_6 .album_upload_counter').html(pVel);
            },
            success: function (data) {
                bar.hide();

                $('.contanir .contents .Tab_6 .album_upload_counter').html('<img src="images/correct.png"> تم رفع الصور بنجاح');
                $('.uploadSectionImg input[type="file"]').val('');
                $('.contanir .contents .Tab_6 .files').val(data);
            },
            error: function () {
                alert('Error');
            }
        });


    })
    $('.Tab_6 .sections').find('input[type="button"]').on('click', function () {
        var sec_ar = $('.Tab_6 .sections input[type="text"]:first');
        var sec_en = $('.Tab_6 .sections input[type="text"]:eq(1)');
        var image = $('.Tab_6 .sections input[type="hidden"]');

        $.post('index.php', {CreateSec: true, ar: sec_ar.val(), en: sec_en.val(), image: image.val()}, function (e) {
            alert(e);
            $('.contanir .contents .Tab_6 .sections .load_sections').load('index.php?load_sections', function () {


                $('.Tab_6 .sections .Table_Home input[type="checkbox"]').on('change', function () {
                    if ($('.Tab_6 .sections .Table_Home input[type="checkbox"]').is(':checked')) {

                        $('.Tab_6 .sections .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteSections()');

                    } else {
                        $('.Tab_6 .sections .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                    }
                })
            });


        })
    })

    $('.Tab_6 .create_equ .PHOTOEQU').on('change', function () {
        var bar = $('.contanir .contents .Tab_6 .create_equ .cirule .loader');
        $('.Tab_6 .create_equ .uploadEquImg').ajaxSubmit({
            type: 'post',
            url: 'index.php?equ_temp_upload',
            beforeSubmit: function () {
                bar.show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var pVel = percentComplete + '%';
                bar.css('border-right-color', 'black');
                if (percentComplete == 25) {
                    bar.css('border-top-color', 'black');
                }
                if (percentComplete == 50) {
                    bar.css('border-top-left', 'black');
                }
                if (percentComplete == 100) {
                    bar.css('border-color', 'black');
                }
                $('.contanir .contents .Tab_6 .create_equ .album_upload_counter').html(pVel);
            },
            success: function (data) {
                bar.hide();

                $('.contanir .contents .Tab_6 .create_equ .album_upload_counter').html('<img src="images/correct.png"> تم رفع الصور بنجاح');
                $('.create_equ input[type="file"]').val('');
                $('.contanir .contents .Tab_6 .create_equ .files').val(data);
            },
            error: function () {
                alert('Error');
            }
        });


    })
    $('.Tab_8 .new_cer .PHOTOCER').on('change', function () {
        var bar = $('.contanir .contents .Tab_8 .new_cer .cirule .loader');
        $('.Tab_8 .new_cer .uploadcertImg').ajaxSubmit({
            type: 'post',
            url: 'index.php?certi_temp_upload',
            beforeSubmit: function () {
                bar.show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var pVel = percentComplete + '%';
                bar.css('border-right-color', 'black');
                if (percentComplete == 25) {
                    bar.css('border-top-color', 'black');
                }
                if (percentComplete == 50) {
                    bar.css('border-top-left', 'black');
                }
                if (percentComplete == 100) {
                    bar.css('border-color', 'black');
                }
                $('.contanir .contents .Tab_8 .new_cer .album_upload_counter').html(pVel);
            },
            success: function (data) {
                bar.hide();

                $('.contanir .contents .Tab_8 .new_cer .album_upload_counter').html('<img src="images/correct.png"> تم رفع الصور بنجاح');
                $('.new_cer input[type="file"]').val('');
                $('.contanir .contents .Tab_8 .new_cer .files').val(data);
                $('.contanir .contents .Tab_8 .new_cer .error_empty').hide();
            },
            error: function () {
                alert('Error');
            }
        });


    })

    $('.Tab_6 .create_equ').find('input[type="button"]').on('click', function () {
        var Row = [];
        $('.Tab_6 .create_equ .Model').each(function (i) {

            if ($.trim($(this).children('.Model_Text').val()) != '') {
                Row[i] = [];
                Row[i] = {
                    'model': $(this).children('.Model_Text').val(),
                    'capcity': $(this).children('.Capcity_Text').val(),
                    'location': $(this).children('.Location_Text').val()
                };
            }
        });


        var type = $(this).attr('class');

        //////////////// - Text - ////////////////

        var ar = $('.Tab_6 .create_equ input[type="text"]:first');
        var en = $('.Tab_6 .create_equ input[type="text"]:eq(1)');

        //////////////////// -files - /////////////
        var files = $('.Tab_6 .create_equ .files');
        ///////////////// -Section -/////////////////////
        var section = $('.Tab_6 .create_equ select');

        /////////////////// - Textarea -////////////////////

        var content_ar = $('.Tab_6 .create_equ textarea:first');
        var content_en = $('.Tab_6 .create_equ textarea:eq(1)');

        if ($.trim(ar.val()) == '') {
            ar.focus();
            return false;
        }
        if ($.trim(en.val()) == '') {
            en.focus();
            return false;
        }

        if (type == 'Edit_Equ') {
            var id = $('.contanir .contents .Tab_6 .create_equ .edit_id').val();
            if ($.trim(id) == '') {
                return false;
            } else {
                $.post('index.php', {
                    UpdateEqu: true,
                    id: id,
                    ar: ar.val(),
                    en: en.val(),
                    Rows: JSON.stringify(Row),
                    files: files.val(),
                    sec: section.val(),
                    co_ar: content_ar.val(),
                    co_en: content_en.val()
                }, function (e) {
                    $('.contanir .contents .Tab_6 .create_equ .New_rows').html('');
                    $('.contanir .contents .Tab_6 .create_equ input[type="button"]').attr('class', '');
                    $('.contanir .contents .Tab_6 .create_equ input[type="text"]').val('');
                    $('.contanir .contents .Tab_6 .create_equ textarea').val('');
                    $('.contanir .contents .Tab_6 .create_equ .album_upload_counter').html('');
                    $('.contanir .contents .Tab_6 .create_equ .sections').val($(".sections option:first").val());
                    $('.contanir .contents .Tab_6 .create_equ .edit_id').val('');
                    $('.contanir .contents .Tab_6 .Tab_View #all_equ').click();

                })
            }
        } else {
            $.post('index.php', {
                CreateEqu: true,
                ar: ar.val(),
                en: en.val(),
                Rows: JSON.stringify(Row),
                files: files.val(),
                sec: section.val(),
                co_ar: content_ar.val(),
                co_en: content_en.val()
            }, function (e) {

                $('.contanir .contents .Tab_6 .create_equ .New_rows').html('');
                $('.contanir .contents .Tab_6 .create_equ input[type="text"]').val('');
                $('.contanir .contents .Tab_6 .create_equ textarea').val('');
                $('.contanir .contents .Tab_6 .create_equ .album_upload_counter').html('');
                $('.contanir .contents .Tab_6 .create_equ .sections').val($(".sections option:first").val());
                $('.contanir .contents .Tab_6 .create_equ .Added').html('تمت الأضافة بنجاح ..!');
                $('html, body').animate({scrollTop: 0}, 800);

            })

        }
    })

    $('.Tab_5').find('input[type="button"]').on('click', function () {
        var uploaded = $('.contanir .contents .Tabs .Upload_work_vd');
        var albums = $('.contanir .contents .Tabs .Load_Albums');
        var up, al = Boolean;
        if (uploaded.is(':visible')) {
            up = true;
            al = false;
        } else if (albums.is(':visible')) {
            up = false;
            al = true;
        } else {
            up = false;
            al = false;
        }

        var title_ar = $('.contanir .contents .Tab_5 .ar_name');
        var title_en = $('.contanir .contents .Tab_5 .en_name');
        var done = $('.contanir .contents .Tab_5 .done_on');
        var rel_ar = $('.contanir .contents .Tab_5 .rel_ar');
        var rel_en = $('.contanir .contents .Tab_5 .rel_en');
        var country = $('.contanir .contents .Tab_5 .country');
        var city_ar = $('.contanir .contents .Tab_5 .ar_city');
        var city_en = $('.contanir .contents .Tab_5 .en_city');
        var co_ar = $('.contanir .contents .Tab_5 .ar_content');
        var co_en = $('.contanir .contents .Tab_5 .en_content');
        if ($('.contanir .contents .Tab_5 .pub').is(':checked')) {
            var pub = 0;
        } else {
            var pub = 1;
        }
        if (up == true) {
            var files = $('.contanir .contents .Tab_5 .files').val();
            var type = 'upload';

        } else if (al == true) {
            var files = $('.contanir .contents .Tab_5 .album').val();
            var type = 'album';
        } else {
            var files = 0;
            var type = 'NULL';
        }
        if ($.trim(title_ar.val()) == '') {
            title_ar.focus();
            title_ar.css('border-color', 'red');
            return false;
        } else {
            title_ar.css('border-color', '#BBBBBB');
        }

        if ($.trim(title_en.val()) == '') {
            title_en.focus();
            title_en.css('border-color', 'red');
            return false;
        } else {
            title_en.css('border-color', '#BBBBBB');
        }

        if (country.val() == 0) {
            country.focus();
            country.css('border-color', 'red');
            return false;
        } else {
            country.css('border-color', '#BBBBBB');
        }

        if ($.trim(co_ar.val()) == '') {
            co_ar.focus();
            co_ar.css('border-color', 'red');
            return false;
        } else {
            co_ar.css('border-color', '#BBBBBB');
        }
        if ($.trim(co_en.val()) == '') {
            co_en.focus();
            co_en.css('border-color', 'red');
            return false;
        } else {
            co_en.css('border-color', '#BBBBBB');
        }
        if ($.trim(rel_ar.val()) != '') {
            if ($.trim(rel_en.val()) == '') {
                rel_en.focus();
                rel_en.css('border-color', 'red');
                return false;
            } else {
                rel_en.css('border-color', '#BBBBBB');
            }
        }

        if ($.trim(rel_en.val()) != '') {
            if ($.trim(rel_ar.val()) == '') {
                rel_ar.focus();
                rel_ar.css('border-color', 'red');
                return false;
            } else {
                rel_ar.css('border-color', '#BBBBBB');
            }
        }

        if ($.trim(city_ar.val()) != '') {
            if ($.trim(city_en.val()) == '') {
                city_en.focus();
                city_en.css('border-color', 'red');
                return false;
            } else {
                city_en.css('border-color', '#BBBBBB');
            }
        }
        if ($.trim(city_en.val()) != '') {
            if ($.trim(city_ar.val()) == '') {
                city_ar.focus();
                city_ar.css('border-color', 'red');
                return false;
            } else {
                city_ar.css('border-color', '#BBBBBB');
            }
        }
        $.post('index.php', {
            CreateProject: true,
            title_ar: title_ar.val(),
            title_en: title_en.val(),
            done: done.val(),
            rel_ar: rel_ar.val(),
            rel_en: rel_en.val(),
            country: country.val(),
            city_ar: city_ar.val(),
            city_en: city_en.val(),
            co_ar: co_ar.val(),
            co_en: co_en.val(),
            image_type: type,
            file: files,
            pub: pub,

        }, function () {
            $('.contanir .contents .Tab_5 input[type="text"]').val('');
            $('.album_upload_counter').html('');
            $('.uploadalbumFiles input[type="file"]').val('');
            $('.contanir .contents .Tab_5 .files').val('');
            co_ar.jqteVal("");
            ;
            co_en.jqteVal("");
            ;
            $('.contanir .contents .Tab_5 .Added').html('تمت الأضافة بنجاح ..!');
            $('html, body').animate({scrollTop: 0}, 800);
        })
    })

    $('.Tab_9').find('input[type="button"]').on('click', function () {
        var ad_ar = $('.Tab_9').children('textarea:first');
        var ad_en = $('.Tab_9').children('textarea:eq(1)');
        ///// -Social -////
        var facebook = $('.Tab_9').children('input[type="text"]:first');
        var twitter = $('.Tab_9').children('input[type="text"]:eq(1)');
        var google = $('.Tab_9').children('input[type="text"]:eq(2)');
        var youtube = $('.Tab_9').children('input[type="text"]:eq(3)');
        var inst = $('.Tab_9').children('input[type="text"]:eq(4)');
        var email = $('.Tab_9').children('input[type="text"]:eq(5)');
        ////// Phone /////
        var phone = $('.Tab_9').children('input[type="text"]:eq(6)');
        var fax = $('.Tab_9').children('input[type="text"]:eq(7)');
        var mobile = $('.Tab_9').children('input[type="text"]:eq(8)');
        $.post('index.php', {
            contactus: true,
            add_ar: ad_ar.val(),
            add_en: ad_en.val(),
            face: facebook.val(),
            twitter: twitter.val(),
            google: google.val(),
            youtube: youtube.val(),
            inst: inst.val(),
            email: email.val(),
            phone: phone.val(),
            fax: fax.val(),
            mobile: mobile.val()
        }, function (e) {
            $('.contanir .contents .Tab_9 .Added').html('تمت الأضافة بنجاح ..!');

        })


        //
        //
        return false;
    })
    $('.Tab_11').find('input[type="button"]').on('click', function () {
        var type = $(this).attr('class');

        var ar = $('.Tab_11 input[type="text"]:first');
        var en = $('.Tab_11 input[type="text"]:eq(1)');
        if ($.trim(ar.val()) == '') {
            ar.focus();
            return false;
        }
        if ($.trim(en.val()) == '') {
            en.focus();
            return false;
        }
        if (type == 'Edit_serv') {
            var id = $('.Tab_11 .edit_serv_id').val();
            $.post('index.php', {UpdateServ: true, id: id, ar: ar.val(), en: en.val()}, function (e) {
                if (e == '0') {
                    $('.contanir .contents .Tab_11 .load_sections').load('index.php?load_services', function () {
                        $('.Tab_11 .Table_Home input[type="checkbox"]').on('change', function () {
                            if ($('.Tab_11  .Table_Home input[type="checkbox"]').is(':checked')) {
                                $('.Tab_11  .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteService()');

                            } else {
                                $('.Tab_11 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                            }
                        })
                    });


                }


            })
        } else {
            $.post('index.php', {CreateServ: true, ar: ar.val(), en: en.val()}, function (e) {
                if (e == '0') {
                    $('.contanir .contents .Tab_11 .load_sections').load('index.php?load_services', function () {
                        $('.Tab_11 .Table_Home input[type="checkbox"]').on('change', function () {
                            if ($('.Tab_11  .Table_Home input[type="checkbox"]').is(':checked')) {
                                $('.Tab_11  .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteService()');

                            } else {
                                $('.Tab_11 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                            }
                        })
                    });


                }
            })


        }
        $('.Tab_11 input[type="text"]').val('');
        return false;

    })
    $('.contanir .contents .Tabs .News input[type="button"]').on('click', function () {
        var btn = $(this);
        var action = $(this).attr('class');
        var add = Boolean;
        if (action == 'New') {
            add = true;
        } else {
            var id = $(this).parent().children('input[type="hidden"]');
            add = false;

        }
        var arabic_title = $(this).parent().children('input[type="text"]:eq(0)');
        var eng_title = $(this).parent().children('input[type="text"]:eq(1)');
        var news_url = $(this).parent().children('input[type="text"]:eq(2)');
        var news_content_arabic = $(this).parent().children('textarea:eq(0)');
        var news_content_eng = $(this).parent().children('textarea:eq(1)');

        if (arabic_title.val() == '') {
            arabic_title.focus();
            arabic_title.css('border-color', 'red')
            return false;
        }
        if (eng_title.val() == '') {
            eng_title.focus();
            eng_title.css('border-color', 'red');
            return false;
        }
        if (news_content_arabic.val() == '') {
            news_content_arabic.focus();
            news_content_arabic.css('border-color', 'red');
            return false;
        }
        if (news_content_eng.val() == '') {
            news_content_eng.focus();
            news_content_eng.css('border-color', 'red');
            return false;
        }
        $('.contanir .contents .Tabs .News').children('input[type="text"]').css('border-color', '#BBBBBB');
        $('.contanir .contents .Tabs .News').children('textarea').css('border-color', '#BBBBBB');
        $(this).attr('disabled', 'disabled');
        if (add == true) {
            $.post('index.php', {
                News_create: true,
                nar: arabic_title.val(),
                nen: eng_title.val(),
                url: news_url.val(),
                car: news_content_arabic.val(),
                cen: news_content_eng.val()
            }, function (e) {
                $('.contanir .contents .Tabs .News').children('input[type="text"]').val('');
                $('.contanir .contents .Tabs .News').children('textarea').val('');
                btn.removeAttr('disabled');
                $('.contanir .contents .Tabs .News .PLZ_WAIT').html('<img src="images/correct.png"> تمت أضافة الخبر بنجاح !');
            })
        } else {
            $.post('index.php', {
                News_Update: true,
                id: id.val(),
                nar: arabic_title.val(),
                nen: eng_title.val(),
                url: news_url.val(),
                car: news_content_arabic.val(),
                cen: news_content_eng.val()
            }, function (e) {

                $('.contanir .contents .Tabs .News').children('input[type="hidden"]').val('');
                $('.contanir .contents .Tabs .News').children('input[type="text"]').val('');
                $('.contanir .contents .Tabs .News').children('textarea').val('');
                btn.removeAttr('disabled');
                btn.attr('class', 'New');
                $('.contanir .contents .Tabs .news_tab #All_news').click();

            })
        }
    })
    $('.contanir .contents .Tab_7').find('input[type="button"]').on('click', function () {
        var type = $(this).attr('class');
        var ar = $('.contanir .contents .Tab_7 input[type="text"]:first');
        var en = $('.contanir .contents .Tab_7 input[type="text"]:eq(1)');
        var city = $('.contanir .contents .Tab_7 select');
        var address_ar = $('.contanir .contents .Tab_7 input[type="text"]:eq(2)');
        var address_en = $('.contanir .contents .Tab_7 input[type="text"]:eq(3)');

        if ($.trim(ar.val()) == '') {
            ar.focus();
            return false;
        }

        if ($.trim(en.val()) == '') {
            en.focus();
            return false;
        }
        if ($.trim(address_ar.val()) == '') {
            address_ar.focus();
            return false;
        }
        if ($.trim(address_en.val()) == '') {
            address_en.focus();
            return false;
        }
        if (type == 'EditBran') {
            var id = $('.contanir .contents .Tab_7 .bran_id').val();
            if (id == '') {
                return false;
            }
            $.post('index.php', {
                edit_branch: true,
                id: id,
                ar: ar.val(),
                en: en.val(),
                city: city.val(),
                add_ar: address_ar.val(),
                add_en: address_en.val()
            }, function (e) {
                $('.contanir .contents .Tab_7 .bran_id').val('');
                $('.contanir .contents .Tab_7 input[type="text"]').val('');
                $('.contanir .contents .Tab_7 select').val(203);
                $('.contanir .contents .Tab_7 input[type="button"]').attr('class', '');
            })
        } else {
            $.post('index.php', {
                create_branch: true,
                ar: ar.val(),
                en: en.val(),
                city: city.val(),
                add_ar: address_ar.val(),
                add_en: address_en.val()
            }, function (e) {
                $('.contanir .contents .Tab_7 .bran_id').val('');
                $('.contanir .contents .Tab_7 input[type="text"]').val('');
                $('.contanir .contents .Tab_7 select').val(203);
            })
        }
        $('.contanir .contents .Tab_7 .load_sections').load('index.php?load_branch', function () {
            $('.Tab_7 .Table_Home input[type="checkbox"]').on('change', function () {
                if ($('.Tab_7 .Table_Home input[type="checkbox"]').is(':checked')) {
                    $('.Tab_7 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteBran()');

                } else {
                    $('.Tab_7 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                }
            })
        });
    })
    $('.contanir .contents .Tab_8').find('input[type="button"]').on('click', function () {

        var photo = $('.contanir .contents .Tab_8 .new_cer .files').val();
        if ($.trim(photo) == '') {
            $('.contanir .contents .Tab_8 .new_cer .upload_photo').css('color', 'red');
            $('.contanir .contents .Tab_8 .new_cer .upload_photo').css('font-weight', 'bold');
            $('.contanir .contents .Tab_8 .new_cer .error_empty').show();
            return false;
        } else {
            $('.contanir .contents .Tab_8 .new_cer .upload_photo').css('color', 'black');
            $('.contanir .contents .Tab_8 .new_cer .upload_photo').css('font-weight', 'normal');
            $('.contanir .contents .Tab_8 .new_cer .error_empty').hide();
            var title_ar = $('.contanir .contents .Tab_8 .new_cer input[type="text"]:first')
            var title_en = $('.contanir .contents .Tab_8 .new_cer input[type="text"]:eq(1)')
            var other_ar = $('.contanir .contents .Tab_8 .new_cer textarea:first')
            var other_en = $('.contanir .contents .Tab_8 .new_cer textarea:eq(1)')
            if ($.trim(title_ar.val()) == '') {
                title_ar.focus();
                title_ar.css('border-color', ' red');
                return false;
            } else {
                title_ar.css('border-color', '');
            }
            if ($.trim(title_en.val()) == '') {
                title_en.focus();
                title_en.css('border-color', ' red');
                return false;
            } else {
                title_en.css('border-color', '');
            }
            $.post('index.php', {
                add_certi: true,
                photo: photo,
                title_ar: title_ar.val(),
                title_en: title_en.val(),
                other_ar: other_ar.val(),
                other_en: other_en.val()
            }, function (e) {
                if (e == 'NULL') {
                    $('.contanir .contents .Tab_8 .new_cer .upload_photo').css('color', 'red');
                    $('.contanir .contents .Tab_8 .new_cer .upload_photo').css('font-weight', 'bold');
                    $('.contanir .contents .Tab_8 .new_cer .error_empty').show();
                    $('.contanir .contents .Tab_8 .new_cer .album_upload_counter').html('')
                    $('.contanir .contents .Tab_8 .new_cer .files').val('');
                } else {
                    $('.contanir .contents .Tab_8 .new_cer input[type="text"]').val('');
                    $('.contanir .contents .Tab_8 .new_cer textarea').val('');
                    $('.contanir .contents .Tab_8 .new_cer .files').val('');
                    $('.contanir .contents .Tab_8 .new_cer .album_upload_counter').html('');
                }
            })
        }


    })
    $('.contanir .contents .Tab_10 .users').find('input[type="button"]').on('click', function () {
        $('.contanir .contents .Tab_10 .users .ERR_TOK').hide();
        var user = $('.contanir .contents .Tab_10 .users input[type="text"]');
        var pass = $('.contanir .contents .Tab_10 .users input[type="password"]');
        if ($.trim(user.val()) == '') {
            user.focus();
            return false;
        }
        if ($.trim(pass.val()) == '') {
            pass.focus();
            return false;
        }
        $.post('index.php', {createUser: true, user: user.val(), pass: pass.val()}, function (e) {
            if (e == 'DUB_USER') {
                $('.contanir .contents .Tab_10 .users .ERR_TOK').show();
                user.focus();
                return false;
            } else {

                $('.contanir .contents .Tab_10 .users input[type="text"],.contanir .contents .Tab_10 .users input[type="password"]').val('')
                $('.contanir .contents .Tab_10 .users .load_users').load('index.php?users', function () {


                    $('.Tab_10 .users .Table_Home input[type="checkbox"]').on('change', function () {
                        if ($('.Tab_10 .users .Table_Home input[type="checkbox"]').is(':checked')) {

                            $('.Tab_10 .users .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'Deleteuser()');

                        } else {
                            $('.Tab_10 .users .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                        }
                    })
                });
            }


        })
    })
    $('.contanir .contents .Tabs .news_tab .roling').on('click', function () {


        $('.contanir .contents .Tabs .news_tab .roling').removeClass('selected');
        $(this).addClass('selected');

        var type = $(this).attr('id');

        switch (type) {
            case 'News':
                $('.contanir .contents .Tabs .VIEW').hide();
                $('.contanir .contents .Tabs .News').show();


                break;
            case 'All_news':
                $('.contanir .contents .Tabs .VIEW').hide();
                $('.contanir .contents .Tabs .All_news').show();
                $('.contanir .contents .Tabs .All_news').load('index.php?loadnews', function () {
                    $('.Table_Home input[type="checkbox"]').on('change', function () {
                        if ($('.Table_Home input[type="checkbox"]').is(':checked')) {

                            $('.Table_Home input[type="button"]').attr('style', '');
                            $('.Table_Home input[type="button"]').attr('onclick', 'DeleteNews()');
                        } else {
                            $('.Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
                            $('.Table_Home input[type="button"]').attr('onclick', '');
                        }
                    })


                });


                break;


            case 'News_Options':
                $('.contanir .contents .Tabs .VIEW').hide();
                $('.contanir .contents .Tabs .News_Options').show();


                break;

        }

    })
    $('.contanir .contents .Tabs .Photo_Type').on('click', function () {
        $('.contanir .contents .Tabs .Photo_Type').removeClass('Photo_Type_Select');
        $(this).addClass('Photo_Type_Select');
        var type = $(this).attr('id');
        $('.contanir .contents .Tabs .Photo_Work').hide();
        $('.contanir .contents .Tabs .' + type).show();
        if (type == 'Load_Albums') {

            $('.contanir .contents .Tabs .Photo_Work').children('select').load('index.php?loadalbums&option')


        }

    })
})

function ShowAlbum(cl, id) {
    $('.Photo_editor').remove();
    var row = $(cl).parent().parent('tr');
    $('<tr class="Photo_editor"><td colspan="6"> <img src="images/loader.gif"></td></tr>').insertAfter(row);
    $('.Photo_editor td').load('index.php?photos&albumid=' + id);

    return false;
}

function DeleteNews() {
    var array = [];
    $('.Table_Home input[type="checkbox"]:checked').parent().parent('tr').fadeOut(function () {
        $(this).remove();
        $('.Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
        var len = $('.Table_Home tr').length;

        if (len == 2) {
            $('.contanir .contents .Tabs .news_tab #All_news').click();
        }
    });

    $('.Table_Home input[type="checkbox"]:checked').each(function () {
        array.push($(this).val());
    });
    var news_id = array.join(',');
    $.post('index.php', {DeleteNews: true, id: news_id});
    return false;
}

function DeleteAlbums() {
    var array = [];
    $('.Table_Home input[type="checkbox"]:checked').parent().parent('tr').fadeOut(function () {
        $(this).remove();
        $('.Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
        var len = $('.Table_Home tr').length;

        if (len == 2) {
            $('.contanir .contents .Tabs .news_tab #All_news').click();
        }
    });

    $('.Table_Home input[type="checkbox"]:checked').each(function () {
        array.push($(this).val());
    });
    var album_id = array.join(',');
    $.post('index.php', {DeleteAlbums: true, id: album_id});
    return false;
}

function DeleteEqu() {
    var array = [];
    $('.Tab_6 .Table_Home input[type="checkbox"]:checked').parent().parent('tr').fadeOut(function () {
        $(this).remove();
        $('.Tab_6 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
        var len = $('.Tab_6 .Table_Home tr').length;

    });

    $('.Tab_6 .Table_Home input[type="checkbox"]:checked').each(function () {
        array.push($(this).val());
    });
    var equ_id = array.join(',');
    $.post('index.php', {DeleteEqu: true, id: equ_id});
    return false;
}

function Deletecertis() {
    var array = [];


    $('.Tab_8 .Table_Home input[type="checkbox"]:checked').each(function () {
        array.push($(this).val());
    });
    var c_id = array.join(',');

    $.post('index.php', {Deletecerti: true, id: c_id}, function () {

        $('.contanir .contents .Tab_8 .cert_all').load('index.php?certificates', function () {


            $('.Tab_8 .Table_Home input[type="checkbox"]').on('change', function () {
                if ($('.Tab_8 .Table_Home input[type="checkbox"]').is(':checked')) {

                    $('.Tab_8 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'Deletecertis()');

                } else {
                    $('.Tab_8 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                }
            })
        });


    });
    return false;
}

function EditNews(id) {
    $('.contanir .contents .Tabs .VIEW').hide();
    $('.contanir .contents .Tabs .News').show();
    $('.contanir .contents .Tabs .news_tab .roling').removeClass('selected');
    $('.contanir .contents .Tabs .news_tab #News').addClass('selected');

    $('.contanir .contents .Tabs .News .PLZ_WAIT').html('<img src="images/fun.gif"> الرجاء الانتظار جار جلب المعلومات');

    $.get('index.php?getnews&id=' + id, function (data) {


        $('.contanir .contents .Tabs .News input[type="button"]').attr('class', 'Edit');
        var id = $('.contanir .contents .Tabs .News input[type="hidden"]:eq(0)').val(data.id);
        var arabic_title = $('.contanir .contents .Tabs .News input[type="text"]:eq(0)').val(data.tar);
        var eng_title = $('.contanir .contents .Tabs .News input[type="text"]:eq(1)').val(data.ten);
        var news_url = $('.contanir .contents .Tabs .News input[type="text"]:eq(2)').val(data.url);
        var news_content_arabic = $('.contanir .contents .Tabs .News textarea:eq(0)').val(data.ara_con);
        var news_content_eng = $('.contanir .contents .Tabs .News textarea:eq(1)').val(data.eng_con);
        $('.contanir .contents .Tabs .News .PLZ_WAIT').html('');


    }, 'json')


}

function DeleteSlide(id, cl) {
    var slide = $(cl).parent().parent('.slide_box');
    slide.remove();
    $.post('index.php', {DeleteSlide: true, slide: id});

}

function SaveWeb(btn) {

    var web_ar = $(btn).parent().children('input[type="text"]:first');
    var web_en = $(btn).parent().children('input[type="text"]:eq(1)');
    var owner = $(btn).parent().children('input[type="text"]:eq(2)');
    var bf_ar = $(btn).parent().children('textarea:first');
    var bf_en = $(btn).parent().children('textarea:last');
    var close_yes = $(btn).parent().children('input[type="radio"]:first');
    var cl = 0;
    if (close_yes.is(':checked')) {
        cl = 1;
    }
    $.post('index.php', {
        UpdateWebGen: true,
        web_ar: web_ar.val(),
        web_en: web_en.val(),
        owner: owner.val(),
        bf_ar: bf_ar.val(),
        bf_en: bf_en.val(),
        close: cl
    }, function (e) {
        alert('تم التحديث بنجاح');


    })


}

function SaveUrl(button, id) {
    var text = $(button).val();
    var url = $(button).parent().children('input[type=text]');
    $.post('index.php', {SaveSlideUrl: true, url: url.val(), id: id}, function (e) {
        if (e == 'Yes') {
            $(button).val('تم الحفظ');
            setInterval(function () {
                $(button).val(text);
            }, 2000)
        }
    });
}

function SaveAlbum(btn, id) {
    var ar = $('.album_ar_name');
    var en = $('.album_en_name');
    var proj = $('.projects_edit')
    $.post('index.php', {
        UpdateAlbum: true,
        id: id,
        ar_title: ar.val(),
        en_title: en.val(),
        proj: proj.val()
    }, function () {
        $('.Photo_editor').remove();
        $('.contanir .contents .Tab_4 .EDIT_ALBUMS').load('index.php?albums', function () {


            $('.Tab_4 .Table_Home input[type="checkbox"]').on('change', function () {
                if ($('.Tab_4 .Table_Home input[type="checkbox"]').is(':checked')) {

                    $('.Tab_4 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteAlbums()');

                } else {
                    $('.Tab_4 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                }
            })
        });
    })


}

function editSection(btn) {
    $('.Edit_Section_tr').remove();
    var tr = $(btn).parent().parent('tr');
    var id = tr.attr('class');
    $('<tr class="Edit_Section_tr" id="' + id + '"><tr>').insertAfter(tr);
    $('.Edit_Section_tr').load('index.php?edit_sections&id=' + id);


}

function AddServPoints(i, f) {
    var tr = $(i).parent().parent('tr');
    $('.Serv_Point').remove();
    $('<tr class="Serv_Point"><td colspan="4"></td></tr>').insertAfter(tr);
    $('.Serv_Point td').load('index.php?loadpoints&id=' + f);


}

function DeletePoint(b, i) {
    $(b).parent().parent('tr').remove()
    $.post('index.php', {DeletePoint: true, id: i}, function (e) {

    })


}

function EditServ(id) {
    $('.contanir .contents .Tab_11 input[type="button"]').attr('class', 'Edit_serv');
    $('html, body').animate({scrollTop: 0}, 800);
    $.get('index.php?edit_serv&id=' + id, function (data) {
        $('.contanir .contents .Tab_11 input[type="text"]:first').val(data.ar);
        $('.contanir .contents .Tab_11 input[type="text"]:eq(1)').val(data.en);
        $('.contanir .contents .Tab_11 .edit_serv_id').val(data.id);

    }, 'json')


}

function DeleteSections() {
    var r = confirm('جميع المعدات المرتبطه بالقسم ستحذف ,هل انت متأكد ؟');
    if (r == true) {
        var array = [];
        $('.Tab_6 .Table_Home input[type="checkbox"]:checked').parent().parent('tr').fadeOut(function () {
            $(this).remove();
            $('.Tab_6  .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
            var len = $('.Table_Home tr').length;


        });

        $('.Tab_6 .Table_Home input[type="checkbox"]:checked').each(function () {
            array.push($(this).val());
        });
        var eq_id = array.join(',');

        $.post('index.php', {DeleteSec: true, id: eq_id});
    } else {
        return false;
    }

    return false;
}

function Deleteuser() {
    var r = confirm('هل انت متاكد من حذف هذا المستخدم؟');
    if (r == true) {
        var array = [];
        $('.Tab_10 .Table_Home input[type="checkbox"]:checked').parent().parent('tr').fadeOut(function () {
            $(this).remove();
            $('.Tab_10  .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
            var len = $('.Tab_10 .Table_Home tr').length;


        });

        $('.Tab_10 .Table_Home input[type="checkbox"]:checked').each(function () {
            array.push($(this).val());
        });
        var uid = array.join(',');

        $.post('index.php', {deleteUser: true, id: uid}, function (e) {
            alert(e);
        });
    } else {
        return false;
    }

    return false;
}

function DeleteService() {

    var array = [];
    $('.Tab_11 .Table_Home input[type="checkbox"]:checked').parent().parent('tr').fadeOut(function () {
        $(this).remove();
        $('.Tab_11  .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;');
        var len = $('.Tab_10 .Table_Home tr').length;


    });

    $('.Tab_11 .Table_Home input[type="checkbox"]:checked').each(function () {
        array.push($(this).val());
    });
    var sid = array.join(',');

    $.post('index.php', {DeleteServ: true, id: sid}, function (e) {

    });


    return false;
}

function SaveEdit_Section(b, i) {
    var ar = $('.Tab_6 .Table_Home  input[type="text"]:first');
    var en = $('.Tab_6 .Table_Home  input[type="text"]:eq(1)');
    $.post('index.php', {UpdateSection: true, id: i, ar: ar.val(), en: en.val()}, function (e) {
        $('.contanir .contents .Tab_6 .load_sections').load('index.php?load_sections', function () {


            $('.Tab_6 .Table_Home input[type="checkbox"]').on('change', function () {
                if ($('.Tab_6 .Table_Home input[type="checkbox"]').is(':checked')) {

                    $('.Tab_6 .Table_Home input[type="button"]').attr('style', '').attr('onclick', 'DeleteSections()');

                } else {
                    $('.Tab_6 .Table_Home input[type="button"]').attr('style', 'color:#C0C0C0;background-color: #F0F0F0;cursor: default;').attr('onclick', '');

                }
            })
        });


    })

}

function ClickTab() {
    $(".taskbar ul").find(".2").click();


}

function EditEqu(id) {
    $('.New_rows').html('');
    $('.contanir .contents .Tab_6 .all_equ').hide();
    $('.contanir .contents .Tab_6 .create_equ').show();
    $('.contanir .contents .Tab_6 .Tab_View .rols').removeClass('select_tap');
    $('.contanir .contents .Tab_6 .Tab_View #create_equ').addClass('select_tap');

    $('.contanir .contents .Tab_6 .News .PLZ_WAIT').html('<img src="images/fun.gif"> الرجاء الانتظار جار جلب المعلومات');


    $.get('index.php?equ_get&id=' + id, function (data) {


        var id = $('.contanir .contents .Tab_6 .create_equ .edit_id').val(data.id);
        var arabic_title = $('.contanir .contents .Tab_6 .create_equ input[type="text"]:eq(0)').val(data.ar);
        var eng_title = $('.contanir .contents .Tab_6 .create_equ input[type="text"]:eq(1)').val(data.en);
        var news_content_arabic = $('.contanir .contents .Tab_6 .create_equ textarea:eq(0)').val(data.co_ar);
        var section = $('.contanir .contents .Tab_6 .create_equ select').val(data.sec);
        $('.contanir .contents .Tab_6 .create_equ input[type="button"]').attr('class', 'Edit_Equ');
        var news_content_eng = $('.contanir .contents .Tab_6 .create_equ textarea:eq(1)').val(data.co_en);
        $('.contanir .contents .Tabs .News .PLZ_WAIT').html('');

        $('.Rows .New_rows').html(data.m);


    }, 'json')


}

function EditBranch(i) {

    $.get('index.php?branchdata&id=' + i, function (d) {

        $('.contanir .contents .Tab_7 .bran_id').val(d.id);
        $('.contanir .contents .Tab_7 input[type="text"]:first').val(d.ar);
        $('.contanir .contents .Tab_7 input[type="text"]:eq(1)').val(d.en);
        $('.contanir .contents .Tab_7 select').val(d.city);
        $('.contanir .contents .Tab_7 input[type="text"]:eq(2)').val(d.add_ar);
        $('.contanir .contents .Tab_7 input[type="text"]:eq(3)').val(d.add_en);
        $('.contanir .contents .Tab_7 input[type="button"]').attr('class', 'EditBran');

    }, 'json')


}

function AddEq_rows() {
    var rows = $('.Tab_6 .create_equ .Model').html();
    $('.Tab_6 .create_equ .New_rows').append('<div class="Model">' + rows + '<span onclick="RmvEq_rows(this)" style="cursor: pointer;color: #0000FF;text-decoration: underline;">حذف</span></div>');


}

function RmvEq_rows(row) {
    $(row).parent().remove();


}

function logout() {
    $.post('index.php', {logout: true}, function () {
        location.reload();
    })


}

function UpdateUser(id, cl) {
    var p = $(cl).parent().parent('tr');
    $('.update_user').remove();
    $('<tr class="update_user" style="position: relative;"><td></td></tr>').insertAfter(p);
    $('.update_user').load('index.php?edituser&id=' + id);

}

function SAVE_USER(c, i) {
    $('.error_img').fadeOut();
    $('.error_img').attr('title', '');
    var tr = $(c).parent().parent('tr');
    var u = tr.children('td').find('input[type="text"]:eq(0)');
    var p = tr.children('td').find('input[type="password"]:eq(0)');
    var update_name = true;
    if (u.length == 0) {
        update_name = false;
        u = tr.children('td').find('.ADMIN_USER');
    }
    if (update_name == true) {
        var data = {Update_user: true, new_user: u.val(), new_pass: p.val(), uid: i};
        if ($.trim(u.val()) == '') {
            u.focus();
            return false;
        }
    } else {
        var data = {Update_user: true, new_user: u.text(), new_pass: p.val(), uid: i};
    }
    $.post('index.php', data, function (e) {
        if (e == 'UPDATE_S_U' || e == 'UPDATE_U') {
            $(c).fadeOut(function () {
                $('.sec_img').fadeIn();
            });


            setInterval(function () {
                $('.sec_img').fadeOut(function () {
                    $(c).fadeIn();
                });

            }, 2000)
            p.val('');
        }
        if (e == 'ERR_UPDATE') {
            $('.erroruser').fadeIn();
            $('.erroruser').attr('title', 'فشل في تحديث المستخدم ')
        } else if (e == 'ERROR') {
            $('.errorpass').fadeIn();
            $('.errorpass').attr('title', 'فشل في تحديث المستخدم')
        } else if (e == 'ERROR_USER') {
            $('.erroruser').fadeIn();
            $('.erroruser').attr('title', 'أسم المستخدم موجودً من قبل')
        } else {
            $(c).fadeOut(function () {
                $('.sec_img').fadeIn();
            });
            setInterval(function () {
                $('.sec_img').fadeOut(function () {
                    $(c).fadeIn();
                });
            }, 2000)
            p.val('');
        }
    })

}

function Close_update() {
    $('.update_user').remove();
}
