<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use AdminPanel\DB_DATA as admin;

$ad = new admin();
$user_perm = $ad->GetUserType();
$allow = (($user_perm == 'admin') ? true : false);
if ($allow) {
    echo $allow;
    ?>
    <div id="page-wrapper" dir="rtl">
        <div class="main-page">
            <div class="form-two widget-shadow">
                <div class="form-title">
                    <h4>أضافة مستخدمين</h4>
                </div>
                <div class="col-md-12 grid_3 grid_5 error-box" style="display: none">
                    <div class="alert alert-danger">
                        <span class="Email-Error"
                              style="display: none">يجب ان يكون البريد الالكتروني @yeco-aden.com</span>
                        <span class="Email-Ex" style="display: none">البريد الالكتروني موجود مسبقا</span>
                        <span class="Email-NT-CORR" style="display: none">البريد الالكتروني خاطئ</span>
                    </div>
                </div>
                <div class="col-md-12 grid_3 grid_5 sec-box" style="display: none">
                    <div class="alert alert-success">
                        <span class="added-alert" style="display: none">تمت الاضافة بنجاح</span>
                    </div>
                </div>
                <div class="form-body" data-example-id="simple-form-inline">
                    <form class="form-horizontal" name="add-user-form">
                        <div class="form-group">
                            <label for="exampleInputName2">أسم المستخدم</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName2"
                                   placeholder="مثال: علي, احمد ...الخ" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail2">البريد الالكتروني</label>
                            <input type="email" name="email" class="form-control" id="exampleInputName2"
                                   placeholder="البريد الالكتروني @yeco-aden.com" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">كلمة المرور</label>
                            <input type="password" name="user_pass" class="form-control" id="exampleInputEmail2"
                                   required
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">نوع المستخدم</label>
                            <select class="form-control" name="user_type">
                                <option value="mod" style="color:red;">مشرف</option>
                                <option value="branchs_controller" style="color: blue">مسؤول الفروع</option>
                                <option value="sectors_controller" style="color: blueviolet">مسؤول القطاعات</option>
                                <option value="news_controller" style="color: #00ad45">إعلامي</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">أضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div id="page-wrapper">
        <div class="main-page">
            <div class="form-two widget-shadow">
                <div class="form-title">
                    <h4>ليس لديك صلاحية لدخول هذه الصفحه</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
}