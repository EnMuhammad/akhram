<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use PROCESS\prs as prs;

prs::unSetData();
prs::$table = HOME_MANAGER_TABLE;
if (!empty(prs::select__record())) {
    $has = true;
    $m_name = prs::select__record()[0]['m_name'];
    $m_about = prs::select__record()[0]['m_about'];
    $m_art = prs::select__record()[0]['m_article'];
    $m_photo = prs::select__record()[0]['m_photo_url'];
    $v_name = prs::select__record()[0]['v_name'];
    $v_about = prs::select__record()[0]['v_about'];
    $v_art = prs::select__record()[0]['v_article'];
    $v_photo = prs::select__record()[0]['v_photo_url'];

} else {
    $has = false;
}
?>
<div id="page-wrapper" dir="rtl">
    <div class="main-page">
        <div class="form-two widget-shadow">
            <div class="form-title">
                <h4>الصفحة الرئيسية</h4>
            </div>
            <div class="form-body" data-example-id="simple-form-inline">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">الصور المتحركة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false"> الموقع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                           aria-controls="contact" aria-selected="false">التواصل والارقام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="advanced-tab" data-toggle="tab" href="#advanced" role="tab"
                           aria-controls="advanced" aria-selected="false">خيارات متقدمة</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade in active" id="home">
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                            <div class="form-title">
                                <h4> الصور المتحركة</h4>
                            </div>
                            <div class="form-body">
                                <form name="slides" enctype="multipart/form-data" method="post">
                                    <input type="hidden" value="addSlides" name="type">
                                    <input type="file" class="slideUpload" name="slide_photo"
                                           style="visibility: hidden;display: inline;width: 0;height: 0">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="button"
                                                onclick="$('.slideUpload').click();">أختر صورة
                                        </button>
                                    </div>
                                </form>
                                <table class="col-ms-12" data-toggle="table"
                                       data-url="index.php?action&FetchDataTable&type=slides" data-show-refresh="true"
                                       data-show-toggle="false" data-show-columns="true" data-search="true"
                                       data-select-item-name="toolbar1" data-pagination="true" data-sort-name="user"
                                       data-sort-order="desc">
                                    <thead>
                                    <tr>
                                        <th data-field="url" data-sortable="true">الصورة</th>
                                        <th data-field="option" data-sortable="true">حذف</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                                <script>
                                    $('input[name=slide_photo]').on('change', function (e) {
                                        e.preventDefault();
                                        if ($(this).val() !== '') {
                                            $(this).parent().submit();
                                        }
                                    });
                                    $('[data-toggle="table"]').bootstrapTable();
                                    $('#hover, #striped, #condensed').click(function () {
                                        var classes = 'table';

                                        if ($('#hover').prop('checked')) {
                                            classes += ' table-hover';
                                        }
                                        if ($('#condensed').prop('checked')) {
                                            classes += ' table-condensed';
                                        }
                                        $('#table-style').bootstrapTable('destroy')
                                            .bootstrapTable({
                                                classes: classes,
                                                striped: $('#striped').prop('checked')
                                            });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <form class="form-horizontal update-home-manager" method="post" enctype="multipart/form-data">
                            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                                <div class="form-title">
                                    <h4>المدير العام</h4>
                                </div>

                                <div class="form-body">


                                </div>
                                <div class="form-title">
                                    <h4>نائب المدير العام</h4>
                                </div>
                                <div class="form-body">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        تحديث
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="contact">
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                            <div class="form-title">
                                <h4>التواصل</h4>
                            </div>
                            <div class="form-body">
                                <form class="">
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Facebook</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Twitter</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Youtube</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Google Plus</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Land Phone</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Fax Number</label>
                                        <input type="text" class="form-control" id="exampleInputEmail2">
                                    </div>


                                    <div class="panel-footer">
                                        <button type="button" class="btn btn-primary pull-right">حفظ</button>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="advanced">...</div>
                </div>
            </div>
        </div>
    </div>
</div>
