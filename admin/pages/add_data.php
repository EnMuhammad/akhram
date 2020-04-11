<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use AdminPanel\DB_DATA as admin;

$ad = new admin();

if (isset($_GET['type'])) {
    $type = $dataType = $_GET['type'];
} else {
    $type = $dataType = 'covering';
}


?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="form-two widget-shadow">
            <div class="form-title">
                <h4>أضافة
                    مواد
                </h4>
            </div>
            <div class="form-body" data-example-id="simple-form-inline" dir="rtl">
                <div class="col-md-12 grid_3 grid_5 sec-box" style="display: none">
                    <div class="alert alert-success">
                        <span class="added-alert">تمت الاضافة بنجاح</span>
                    </div>
                </div>
                <form class="form-horizontal" name="<?= (($dataType == 'covering') ? "add-news" : "add-data") ?>"
                      method="post" enctype="multipart/form-data">
                    <input name="type" type="hidden" value="">
                    <?php if ($dataType != 'covering') { ?>
                        <div class="form-group">
                            <label for="Name1"></label>
                            <input type="text" class="form-control" required name="name" id="Name1" placeholder="">
                        </div>
                        <?php
                    }
                    if ($dataType == 'covering') {

                        ?>
                        <h5>مدن التغطية</h5>
                        <div class="form-group">

                            <input type="hidden" class="form-control get-name" value="فرع العاصمه عدن" name="name"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName0">أسم المدينة</label>
                            <input type="text" class="form-control" name="phone" id="exampleInputName0" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName3">City Language</label>
                            <input type="text" class="form-control" name="email" id="exampleInputName3" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName4">الفاكس</label>
                            <input type="text" class="form-control" name="fax" id="exampleInputName4" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName5">العنوان</label>
                            <input type="text" class="form-control" name="address" id="exampleInputName5"
                                   placeholder="">
                        </div>


                        <?php
                    }
                    if ($dataType == 'NEWS') {
                        ?>
                        <div class="form-group shadow-textarea">
                            <label for="content">تفاصيل الخبر</label>
                            <textarea class="input-lg form-control" required name="content" id="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keywords">كلمات دلالية</label>
                            <input type="text" class="form-control" required name="keywords" id="keywords">
                        </div>
                        <div class="form-group">
                            <label for="datePub">تاريخ الخبر</label>
                            <input type="date" class="form-control" required name="date" id="datePub"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="links">الارتباط</label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="sector_id" id="links">
                                    <option value="0">الفرع</option>

                                </select>

                            </div>
                        </div>
                        <?php
                    }

                    ?>
                    <div class="form-group">
                        <label for="aboutInfo">نبذة عن ال </label>
                        <textarea class="form-control" name="about" id="aboutInfo"></textarea>
                    </div>

                    <div class="form-group">

                        <label style="float: right">نشر الخبر</label>
                        <div class="col-md-1" style="float: right">
                            <label for="yes">نعم</label>
                            <input type="radio" checked name="publish" id="yes" value="1">
                        </div>
                        <div class="col-md-1" style="float: right">
                            <label for="no">لا</label>
                            <input type="radio" name="publish" id="no" value="0">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12 pull-right">
                            <button type="button" onclick="$('.uploadMedia').click();" id="upload"
                                    class=" btn btn-primary btn-lg pull-left">
                                رفع ملفات ميديا - الامتدادت المسموح بها
                                mp4-jpg-png &nbsp;
                                <i class="fa fa-camera"></i>
                            </button>
                            <input type="file" class="uploadMedia" name="media[]" multiple="multiple"
                                   style="display: inline;visibility: hidden;width: 0;height: 0">
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>

                    <button type="submit" class="btn btn-danger btn-block btn-lg">أضافة ال
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </form>
            </div>
        </div>
        <?php if ($type == 'news') { ?>
            <div class="form-two widget-shadow">
                <div class="form-title">
                    <h4>كافة الاخبار

                    </h4>
                </div>
                <table class="col-ms-12" data-toggle="table"
                       data-url="index.php?action&FetchDataTable&type=<?= $type ?>" data-show-refresh="true"
                       data-show-toggle="false" data-show-columns="true" data-search="true"
                       data-select-item-name="toolbar1" data-pagination="true" data-sort-name="user"
                       data-sort-order="desc">
                    <thead>

                    <tr>
                        <th data-field="title" data-sortable="true">عنوان الخبر</th>
                        <th data-field="date" data-sortable="true">تاريخ الخبر</th>
                        <th data-field="publish" data-sortable="true">النشر</th>
                        <th data-field="linked" data-sortable="true">الارتباط</th>
                        <th data-field="options" data-sortable="true"> التعديل</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
            <?php
        } else if ($type == 'sectors') {
            ?>
            <div class="form-two widget-shadow">
                <div class="form-title">
                    <h4>كافة القطاعات
                    </h4>
                </div>
                <table class="col-ms-12" data-toggle="table"
                       data-url="index.php?action&FetchDataTable&type=sectors" data-show-refresh="true"
                       data-show-toggle="false" data-show-columns="true" data-search="true"
                       data-select-item-name="toolbar1" data-pagination="true" data-sort-name="user"
                       data-sort-order="desc">
                    <thead>

                    <tr>
                        <th data-field="name" data-sortable="true">أسم القطاع</th>
                        <th data-field="about" data-sortable="true">نبذة</th>
                        <th data-field="options" data-sortable="true"> التعديل</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
            <?php
        }
        ?>
        <script>
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

            function rowStyle(row, index) {
                var classes = ['active', 'success', 'info', 'warning', 'danger'];

                if (index % 2 === 0 && index / 2 < classes.length) {
                    return {
                        classes: classes[index / 2]
                    };
                }
                return {};
            }
        </script>
    </div>
</div>

