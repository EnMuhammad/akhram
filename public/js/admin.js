/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 * 5/5/2020
 */

$(function () {
    $("#dialog,#MetaData,#Slides,#ServicesDialog,#ProjectsItems,#MediaDialog,#ClientsDialog,#SectorDialog" +
        ",#Suppliers,#branches,#UpdateCompanyVMG").dialog({
        autoOpen: false,
        width: "auto",
        modal: true,
        height: ($(window).height() - 200),
        resizable: "auto"
    });
    $("#addAdmin").dialog({
        autoOpen: false,
        width: "auto",
        modal: true,
        height: "auto",
        resizable: "auto"
    });
    $("#PagesDialog,#UpdateContents").dialog({
        autoOpen: false,
        width: ($(window).width() - 200),
        modal: true,
        height: ($(window).height() - 200),
        resizable: "auto"
    });
    $('.updateVMG').on('click', function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $('.select-page-info').hide();
        $("#UpdateCompanyVMG").parent().css({position: "fixed"}).end().dialog('open');
        $('select[name=page_for_select]').on('change', function () {
            if ($(this).val() !== '0') {
                $.get('index.php?adminAction&Load=Pages', function (pages) {
                    $('select[name=pages_select_id]').html(pages).on('change', function () {
                        if ($(this).val() !== '0') {
                            $('.update-comp-button').show();
                        } else {
                            $('.update-comp-button').hide();
                        }
                    });
                    $('.select-page-info').show();
                });
            } else {
                $('.select-page-info').hide();
            }
        });
    });
    $('.PageDi').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#PagesDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.OpenDi').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#dialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.MetaUpdate').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#MetaData").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.show-slides-dialog').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#Slides").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.show-service-da').on("click", function (e) {
        e.preventDefault();
        $.get('index.php?adminAction&Load=sectors', function (data) {
            $('select[name=sector_id]').html(data);
        });
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#ServicesDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.ShowAddMedia').on("click", function (e) {
        e.preventDefault();
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#MediaDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.showAddProjects').on("click", function (e) {
        e.preventDefault();
        $.get('index.php?adminAction&Load=sectors', function (data) {
            $('select[name=service_id]').html('').attr('disabled', 'disabled');
            $('select[name=sector_id]').html(data);
            $('select[name=sector_id]').on('change', function () {
                let sid = $(this).val();
                if (sid != 0) {
                    $.get('index.php?adminAction&Load=services&sid=' + sid, function (cl) {
                        $('select[name=service_id]').removeAttr('disabled').html(cl);
                    });
                } else {
                    $('select[name=service_id]').html('').attr('disabled', 'disabled');
                }

            });
            $.get('index.php?adminAction&Load=clients', function (cl) {
                $('select[name=client_id]').html(cl);
            });
        });
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#ProjectsItems").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.AddMethod').on("click", function (e) {
        e.preventDefault();
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#addAdmin").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.ClientShowAdd').on("click", function (e) {
        e.preventDefault();
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#ClientsDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.SectorShowAdd').on("click", function (e) {
        e.preventDefault();
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#SectorDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.SuppliersShowAdd').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#Suppliers").parent().css({position: "fixed"}).end().dialog('open');
        LoadSuppliers();
        $(".tabs").tabs({
            beforeLoad: function (event, ui) {
                ui.jqXHR.fail(function () {
                    ui.panel.html(
                        "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                        "If this wouldn't be a demo.");
                });
            }
        });
    });
    $('.BranShowAdd').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#branches").parent().css({position: "fixed"}).end().dialog('open');
        LoadBranches();
        $(".tabs").tabs({
            beforeLoad: function (event, ui) {
                ui.jqXHR.fail(function () {
                    ui.panel.html(
                        "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                        "If this wouldn't be a demo.");
                });
            }
        });
    });
    $('.ShowUpdateDi').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#UpdateContents").parent().css({position: "fixed"}).end().dialog('open');
        $('select[name=typeUpdate]').on('change', function () {
            let t = $(this).val();
            if (t === 'ssp') {
                $('.media_section,.pages_section').hide();
                $('.ssp_section').show();
                $.get('index.php?adminAction&Load=sectors', function (data) {
                    $('select[name=sectors]').html(data);
                    $('select[name=sectors]').on('change', function () {
                        let textData = $('select[name=sectors] option:selected').text().split('-');

                        let sid = $(this).val();
                        if (sid != 0) {

                            $('input[name=sector_id]').val($.trim(sid));
                            $('input[name=sector_ar]').val($.trim(textData[0]));
                            $('input[name=sector_en]').val($.trim(textData[1]));
                            $('.sector_edit_f').show();
                            $.get('index.php?adminAction&Load=services&LoadAll&sid=' + sid, function (cl) {
                                $('select[name=services]').removeAttr('disabled').html(cl).on('change', function () {
                                    let ser_id = $(this).val();
                                    if (ser_id != 0) {
                                        $.ajax({
                                            type: 'GET',
                                            url: 'index.php?adminAction&LoadUpdates&type=services&service_id=' + ser_id,
                                            success: function (result) {
                                                var data = jQuery.parseJSON(result);
                                                $('input[name=service_id]').val(data.id);
                                                $('input[name=service_en]').val(data.name_en);
                                                $('input[name=service_ar]').val(data.name_ar);
                                                $('select[name=city]').val(data.city);
                                                $('textarea[name=about_en]').jqteVal(data.about_en);
                                                $('textarea[name=about_ar]').jqteVal(data.about_ar);
                                                $('.service_edit_f').show();
                                            }
                                        });
                                        $.get('index.php?adminAction&Load=projects&LoadAll&service=' + ser_id, function (projects) {
                                            $('select[name=projects]').html(projects).removeAttr('disabled');
                                            $.get('index.php?adminAction&Load=clients', function (cl) {
                                                $('select[name=client_project]').html(cl);
                                            });
                                            $('select[name=projects]').on('change', function () {
                                                let pid = $(this).val();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'index.php?adminAction&LoadUpdates&type=project&pid=' + pid,
                                                    success: function (result) {
                                                        var proj = jQuery.parseJSON(result);
                                                        $('input[name=project_id]').val(proj.id);
                                                        $('input[name=project_name_en]').val(proj.name_en);
                                                        $('input[name=project_name_ar]').val(proj.name_ar);
                                                        $('input[name=start]').val(proj.startOn);
                                                        $('input[name=end]').val(proj.endOn);
                                                        $('input[name=contract]').val(proj.contract);
                                                        $('input[name=adv]').val(proj.adv);
                                                        $('select[name=project_city]').val(proj.city);
                                                        $('select[name=client_project]').val(proj.client);

                                                        $('.project_edit_f').show();
                                                    }
                                                });
                                            })
                                        });
                                    } else {
                                        $('select[name=projects]').html('').attr('disabled', 'disabled');
                                        $('.service_edit_f,.project_edit_f').hide();
                                    }
                                });
                            });
                        } else {
                            $('input[name=sector_ar]').val('');
                            $('input[name=sector_en]').val('');
                            $('.service_edit_f,.project_edit_f,.sector_edit_f').hide();
                            $('select[name=services]').html('').attr('disabled', 'disabled');
                            $('select[name=projects]').html('').attr('disabled', 'disabled');
                        }
                    });
                });

            } else if (t === 'media') {
                $('.media_section').show();
                $('.ssp_section,.pages_section').hide();
            } else if (t === 'pages') {
                $('.pages_section').show();
                $('.ssp_section,.media_section').hide();
                $.get('index.php?adminAction&Load=Pages', function (pages) {
                    $('select[name=pages_select]').html(pages).on('change', function () {
                        let pid = $(this).val();
                        $.ajax(
                            {
                                type: 'GET',
                                url: 'index.php?adminAction&LoadUpdates&type=page&pid=' + pid,
                                success: function (data) {
                                    let page_data = jQuery.parseJSON(data);
                                    $('.update-page input[name=title_en]').val(page_data.name_en);
                                    $('.update-page input[name=title_ar]').val(page_data.name_ar);
                                    $('.update-page select[name=related]').val(page_data.related);
                                    $('.update-page textarea[name=content_en]').jqteVal(page_data.con_en);
                                    $('.update-page textarea[name=content_ar]').jqteVal(page_data.con_ar);
                                    $('input[name=page_id]').val(page_data.id);
                                    $('.page_edit_f').show();

                                }
                            }
                        );
                    });
                })
            }
        });
    });

    $('.viewAlbum').on('click', function (e) {
        e.preventDefault();
        let tr = $(this).parent().parent(), tmedia = $(this).attr('id');
        if ($('.media_' + tmedia).length === 0) {
            $.ajax({
                type: 'GET',
                url: 'index.php?adminAction&LoadUpdates&type=media&MediaType=' + tmedia,
                success: function (result) {
                    let media = jQuery.parseJSON(result);
                    let xtr = '<tr class="media_' + tmedia + '"><td colspan=2>';
                    $.each($(media), function (index, value) {
                        xtr += '<div class="col-md-2 media-edit" id="media_id_' + value.id + '" style="background:url(images/' + value.folder + '/' + value.name + ');height:100px;background-repeat:no-repeat;background-size: cover;background-position:center;">' +
                            '<a href="javascript:;" onclick="DeleteData(\'media\',' + value.id + ')" class="delete"><i class="fa fa-trash"></i></a>' +
                            '</div>';
                    });
                    xtr += '</td></tr>';
                    $(xtr).insertAfter(tr);
                }
            });
        }
    });
    $('form[name=actionForm]').on('submit', function (e) {
        e.preventDefault();
        let type = $(this).find('input[name=type]').val(), form = $(this);
        UpdateEditForm(form, type, {showSuccess: true});
    });
    $('form[name=updateForm]').on('submit', function (e) {
        e.preventDefault();
        let type = $(this).find('input[name=type]').val(), form = $(this);
        UpdateContentForm(form, type);
    });
    $('select[name=projectType]').on('change', function () {
        let vl = $(this).val();
        $('.type-all').hide();
        $('.type-' + vl).show();
    });
    $('select[name=MediaType]').on('change', function () {
        let vl = $(this).val();
        if (vl === 'sectors') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=sectors&unLoadAll', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === 'services') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=services', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === 'projects') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=projects', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === 'slides') {
            $('.media-button').show();
            $('select[name=media_id]').hide();
        } else if (vl === 'items') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=items', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === 'clients') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=clients', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === "0") {
            $('select[name=media_id]').html('');
            $('.media-button').hide();
        }

    });
    $('textarea').jqte();
});

function Logout() {
    $.post('index.php?action&logout', function () {
        window.location.href = '?Control';
    });
}

function CreatSingleUpdateForm(item, type) {
    let updateDiv = $(item).parent().find('.updateReplace'), current_val = updateDiv.text();
    let TextBox = $('<input type="text" class="form-control" value="' + current_val + '" name="' + type + '">');
    updateDiv.replaceWith(TextBox);
}

let UpdateEditForm = function (form, type, options) {
    options = {
        showSuccess: false,
    };
    if (type === 'items' || type === 'media' || type === 'page' || type === 'suppliers') {
        jQuery.ajax({
            url: 'index.php?adminAction&formAction=' + type,
            type: "POST",
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            success: function (result) {
                // if all is well
                // play the audio file
                alert(result);
                form[0].reset();
                if (type === 'suppliers') {
                    LoadSuppliers();
                } else {
                    let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
                    $activeDialogs.dialog('close');
                }
            }
        });
    } else {
        $.post('index.php?adminAction&formAction=' + type, form.serialize(), function (x) {
            alert(x);
            form[0].reset();
            let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
            $activeDialogs.dialog('close');
        });
    }

};
let UpdateContentForm = function (form, type) {
    $.post('index.php?adminAction&updateData&type=' + type, form.serialize(), function (x) {
        alert('Updated !');
    });
};
let CloneText = function (x) {
    let newData = $(x).parent().find('.clone-this').clone(),
        old = $(x).parent().find('.clone-this');
    old.removeClass('clone-this');
    $(newData).insertAfter(old);
};
let DeleteData = function (type, id) {
    let con = confirm('Are you sure?');
    if (con) {
        $.post('index.php?adminAction&Delete=' + type + '&id=' + id, function () {
            if (type === 'media') {
                $('#media_id_' + id).remove();
            } else {
                window.location.href = '';
            }

        });
    }
};
let LoadSuppliers = function () {
    $.get('index.php?adminAction&Load=suppliers', function (data) {
        $('.loadSuppliersTable').html(data);
    });
};
let LoadBranches = function () {
    $.get('index.php?adminAction&Load=branches', function (data) {
        $('.LoadBranches').html(data);
    });
};
let UpdateMC = function (id) {
    $.get('index.php?adminAction&formAction=branches&update_mc&id=' + id, function (data) {
        LoadBranches();
    });
};
let MoveLiDown = function (id, el, page_type) {
    $(el).parent().moveDown();
    ul = $(el).parent().parent();
    ul.find('li.modify').find('.down-button').show();
    ul.find('li.modify').find('.up-button').show();

    ul.find('li.modify:first-child').find('.up-button').hide();
    ul.find('li.modify:first').find('.down-button').show();

    ul.find('li.modify:last').find('.down-button').hide();
    ul.find('li.modify:last').find('.up-button').show();
    // $('.about_ul:first-child:last-child').hide();

    $.get('index.php?adminAction&updateData&type=updateMenuOrder&order_up&id=' + id + '&ptype=' + page_type);
};
let MoveLiUp = function (id, el, page_type) {
    $(el).parent().moveUp();
    // alert($(el).parent().eq());
    ul.find('li.modify').find('.down-button').show();
    ul.find('li.modify').find('.up-button').show();

    ul.find('li.modify:first-child').find('.up-button').hide();
    ul.find('li.modify:first-child').find('.down-button').show();

    ul.find('li.modify:last').find('.down-button').hide();
    ul.find('li.modify:last').find('.up-button').show();
    $.get('index.php?adminAction&updateData&type=updateMenuOrder&id=' + id + '&ptype=' + page_type);
};
$.fn.moveUp = function () {
    let before = $(this).prev();
    $(this).insertBefore(before);
};
$.fn.moveDown = function () {
    let after = $(this).next('.modify');
    $(this).insertAfter(after);
};