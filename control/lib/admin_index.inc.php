<?php
include "admin_header.php";
$s = new sessions();
$q = new Database_alters();
if ($s->check_session()) {
    ?>
    <link href="http://cdn.jsdelivr.net/darfonts/0.1/sul-zah-thw-san/stylesheet.css" rel="stylesheet">
    <div class="contanir">
        <div class="body_head">
            <span class="Home_head" style="display: inline-block;margin: 28px 7px;float: right;"> لوحة التحكم </span>

            <div class="user_log">
                <img src="images/user.png">
                <label><?= $s->session ?>
                    <div class="label_options">
                        <ul>
                            <li>تعديل</li>
                            <li>أضافة مستخدم</li>
                            <li>رسائل</li>
                            <li onclick="logout()">خروج</li>


                        </ul>


                    </div>

                </label>


            </div>
            <div class="clear"></div>
        </div>
        <?php

        if (isset($_GET['tab'])) {
            $tab = htmlspecialchars(strip_tags(trim($_GET['tab'])));
            $g_tab = '';
            $slide_tab = '';
            $news_tab = '';
            $prev_tab = $eq_tab = $serv_tab = '';
            $albums_tab = $articals_tab = $cert_tab = $contact = $other_option = '';
            $title = 'الاعدادات العامه';
            $disc = 'هنا يتم عرض خيارات التحكم بالموقع الرئيسيه';

            ///////////////// - Dispaly - //////////////////////
            $g_dis = '';
            $slide_dis = '';
            $news_dis = ';';
            $prev_dis = $eq_dis = $serv_dis = '';
            $albums_dis = $articals_dis = $cert_dis = $contact_dis = $other_dis = '';


            switch ($tab) {
                DEFAULT:
                case '1':
                    $g_tab = 'selected_item';
                    $g_dis = 'Tabs_selected';
                    $title = 'الاعدادات العامه';
                    $disc = 'هنا يتم عرض خيارات التحكم بالموقع الرئيسيه';

                    break;
                case '2':
                    $slide_tab = 'selected_item';
                    $slide_dis = 'Tabs_selected';
                    $title = 'الشرائح';
                    $disc = 'عدد الشرائح 6 فقط .. لرفع صور لشرائح العرض المتحركه بالصفحه الرئيسيه';

                    break;
                case '3':
                    $news_tab = 'selected_item';
                    $news_dis = 'Tabs_selected';
                    $title = 'الأخبار';
                    $disc = 'أضافة وأرزالة أحدث أخبار الشركه والتحكم بها,المربعات المطلوب تعبائتها تم العلامه عليها بـ (*)';
                    break;
                case '5':
                    $prev_tab = 'selected_item';
                    $prev_dis = 'Tabs_selected';
                    $disc = 'أضافة وازالة المشاريع الخاصه بالشركه ,كافة البيانات المطلوبه يوجد عليها (*)';
                    $title = 'المشاريع';
                    break;
                case '6':
                    $eq_tab = 'selected_item';
                    $eq_dis = 'Tabs_selected';
                    $title = 'المعدات';
                    $disc = 'التحكم باضافة وازالة وتعديل المعدات';

                    break;
                case '11':
                    $serv_tab = 'selected_item';
                    $serv_dis = 'Tabs_selected';
                    $title = 'الخدمات';
                    $disc = 'التحكم باضافة الخدمات التي تقدمها الشركه';
                    break;
                case '4':
                    $albums_tab = 'selected_item';
                    $albums_dis = 'Tabs_selected';
                    $title = 'البوم الصور';
                    $disc = 'لرفع والتحكم بالبومات صور الشركه';
                    break;
                case '7':
                    $articals_tab = 'selected_item';
                    $articals_dis = 'Tabs_selected';
                    $title = 'الفروع';
                    $disc = 'أضافة وتعديل الفروع الخاصة بالشركه';
                    break;
                case '8':
                    $cert_tab = 'selected_item';
                    $cert_dis = 'Tabs_selected';
                    $title = 'الشهادات';
                    $disc = 'صور الشهادات التي حصلت عليها الشركه';
                    break;
                case '9':
                    $contact = 'selected_item';
                    $contact_dis = 'Tabs_selected';
                    $title = 'معلومات التواصل';
                    $disc = 'أضافة معلومات التواصل للزوار';
                    break;
                case '10':
                    $other_option = 'selected_item';
                    $other_dis = 'Tabs_selected';
                    $title = 'خيارات اخرى';
                    $disc = 'روابط الموقع, الصفحات الاضافيه ,معلومات اضافيه عن الشركه ,التحكم بالمستخدمين';
                    break;


            }
        } else {
            $title = 'الاعدادات العامه';
            $disc = 'هنا يتم عرض خيارات التحكم بالموقع الرئيسيه';
            $g_tab = 'selected_item';
            $slide_tab = '';
            $news_tab = '';
            $prev_tab = $eq_tab = $serv_tab = '';
            $albums_tab = $articals_tab = $cert_tab = $contact = $other_option = '';

            $g_dis = 'Tabs_selected';
            $slide_dis = '';
            $news_dis = '';
            $prev_dis = $eq_dis = $serv_dis = '';
            $albums_dis = $articals_dis = $cert_dis = $contact_dis = $other_dis = '';
        }
        ?>

        <div class="taskbar">
            <ul>
                <li class="Head_ul">قوائم التحكم</li>
                <li class="1 <?= $g_tab ?>"><input type="hidden" value="هنا يتم عرض خيارات التحكم بالموقع الرئيسيه">
                    الاعدادات العامه
                </li>
                <li class="2 <?= $slide_tab ?>"> الشرائح<input type="hidden"
                                                               value=" عدد الشرائح 6 فقط .. لرفع صور لشرائح العرض المتحركه بالصفحه الرئيسيه">
                </li>
                <li class="3 <?= $news_tab ?>"> الأخبار
                    <input type="hidden"
                           value="أضافة وأرزالة أحدث أخبار الشركه والتحكم بها,المربعات المطلوب تعبائتها تم العلامه عليها بـ (*)">
                </li>
                <li class="5 <?= $prev_tab ?>"> المشاريع<input type="hidden"
                                                               value="أضافة وازالة المشاريع الخاصه بالشركه ,كافة البيانات المطلوبه يوجد عليها (*)">
                </li>
                <li class="6 <?= $eq_tab ?>"> المعدات <input type="hidden" value="التحكم باضافة وازالة وتعديل المعدات">
                </li>
                <li class="11 <?= $serv_tab ?>"> الخدمات <input type="hidden"
                                                                value="التحكم باضافة الخدمات التي تقدمها الشركه">
                </li>
                <li class="4 <?= $albums_tab ?>"> البوم الصور <input type="hidden"
                                                                     value="لرفع والتحكم بالبومات صور الشركه"></li>
                <li class="7 <?= $articals_tab ?>"> الفروع
                    <input type="hidden" value="أضافة وتعديل الفروع الخاصة بالشركه">
                </li>
                <li class="8 <?= $cert_tab ?>"> الشهادات
                    <input type="hidden" value="صور الشهادات التي حصلت عليها الشركه">
                </li>
                <li class="9 <?= $contact ?>"> معلومات التواصل
                    <input type="hidden" value="أضافة معلومات التواصل للزوار">
                </li>
                <li class="10 <?= $other_option ?>"> خيارات اخرى
                    <input type="hidden"
                           value="روابط الموقع, الصفحات الاضافيه ,معلومات اضافيه عن الشركه ,التحكم بالمستخدمين">
                </li>


            </ul>

        </div>
        <div class="contents">
            <div class="body_head"
                 style="background: #ffffff;color: blue;border-bottom: 1px solid #6d88b7;margin: 5px 0;width: 100%">
                <span style="display: inline-block;margin: 8px 7px;float: right;font-size: 14px;font-weight: normal;"> <?= $title ?> </span>


                <div class="clear"></div>
                <div style="font-size: 11px;display: inline-block;margin: 5px;color: #000000" class="Tab_info">
                    <?= $disc ?>

                </div>
            </div>

            <div class="Tab_1 Tabs <?= $g_dis ?>">


                <label> عنوان الموقع </label>
                <input type="text" value="<?= web_info::web_information("web_title_ar") ?>"
                       placeholder="باللغة العربيه">
                <input type="text" value="<?= web_info::web_information("web_title_en") ?>"
                       placeholder="باللغة الانجليزيه">
                <br>
                <label> المالك </label>
                <input type="text" value="<?= web_info::web_information("owner") ?>" placeholder="أسم مالك الموقع"><br>
                <label> الثيم </label>
                <select>
                    <option>Blue</option>

                </select><br>
                <label>أغلاق الموقع </label>


                <input type="radio" <?= ((web_info::web_information('web_close') == 1) ? 'checked="checked"' : "") ?>
                       name="web_closed" value="1"> نعم
                <input type="radio" <?= ((web_info::web_information('web_close') != 1) ? 'checked="checked"' : "") ?>
                       name="web_closed" value="0"> لا
                <br>
                <label> نبذة مختصرة </label><br>

                <textarea placeholder="باللغة العربيه"><?= web_info::web_information("web_key_ar") ?></textarea>
                <textarea placeholder="باللغة الأنجليزيه"><?= web_info::web_information("web_key_en") ?></textarea>

                <br>
                <input type="button" onclick="SaveWeb(this)" value="حفظ">


            </div>

            <div class="Tab_2 Tabs <?= $slide_dis ?>">
                <label style="width:;color:brown"> أضغط لأختيار صور </label>
                <form method="post" class="uploadFiles" enctype="multipart/form-data" style="display: inline-block">
                    <input type="file" class="PALBUM" name="ImageUpload[]" multiple="" accept="image/*">
                </form>
                <div class="MAX_ERROR" style="color: red;font-size: 11px;padding: 3px"></div>
                <div class="clear"></div>
                <div class="upload_progress" style="float:right">
                    <div class="bar_width" style="width: 0%"></div>


                </div>
                <div class="counter" style="float: left;margin: -4 5px;color: #0066FF;display: none;">100%</div>
                <div class="sliders">
                    <input class="SLIDE_FILE" type="hidden" value="<?= BASE . '/' . WEB_FILES . '/sliders/' ?>">
                    <?php
                    $q->table = SLIDES_TABLE;
                    $q->conditions = "ORDER BY `id` DESC";
                    $q->select_data();
                    if ($q->check_ex()) {
                        while ($q->show_data()) {
                            ?>
                            <div class="slide_box"
                                 style="background-image: url('<?= BASE . '/' . WEB_FILES . '/sliders/' . $q->data['image'] ?>');background-repeat: no-repeat;background-size: cover;background-position: center;">
                                <div class="delete"><img src="images/close.gif"
                                                         onclick="DeleteSlide(<?= $q->data['id'] ?>,this)" title="حذف">
                                </div>
                                <input type="text" value="<?= $q->data['url'] ?>" placeholder="رابط الشريحه"><br><input
                                        type="button" onclick="SaveUrl(this,<?= $q->data['id'] ?>)" value="حفظ"></div>


                            <?php
                        }
                    }


                    ?>

                </div>


            </div>
            <div class="Tab_3 Tabs <?= $news_dis ?>">
                <div class="news_tab">
                    <div class="roling selected" id="News">أضافة</div>
                    <div class="roling" id="All_news">كأفة الأخبار</div>


                    <div class="clear"></div>
                </div>
                <div class="VIEW News">
                    <div class="PLZ_WAIT" style="font-size: 11px;color: #0000FF;"></div>
                    <input type="hidden">
                    <label> عنوان الخبر*</label>
                    <input type="text" placeholder="عنوان الخبر باللغة العربيه"> <input type="text"
                                                                                        placeholder="عنوان الخبر باللغة الأنجليزيه"><br>


                    <label> رابط الخبر</label>
                    <input type="text" placeholder="ex.http://google.com..."><br>
                    <label> بالعربيه *</label>
                    <textarea placeholder="أضافة الخبر باللغة العربيه .."></textarea><br>
                    <label> بالانجليزيه *</label>
                    <textarea placeholder="أضافة الخبر باللغة الأنجليزيه .."></textarea>
                    <br>
                    <div style="display: inline-block;float: left;"></div>
                    <input type="button" value="حفظ" class="New">
                </div>
                <div class="VIEW All_news"></div>
                <!--   <div class="VIEW News_Options">
                   <span>حذف كافة الاخبار</span> <br>
                   <span>أغلاق قسم الأخبار</span> <br>
                   <span>أغلاق قسم الأخبار</span>

                   </div>    -->


            </div>

            <div class="Tab_4 Tabs <?= $albums_dis ?>">
                <div class="Tab_View">
                    <div class="rols select_tap" id="CREAT_ALBUM">أنشاء البوم</div>
                    <div class="rols" id="EDIT_ALBUMS">كأفة الالبومات</div>


                </div>


                <div class="CREAT_ALBUM ALBUM_TAB">
                    <div class="PLZ_WAIT" style="font-size: 11px;color: #0000FF;"></div>
                    <label>أسم الألبوم*</label>
                    <input type="text" placeholder="عربي"> <input type="text" placeholder="أنجليزي"> <br>
                    <label>ربط بمشروع</label>
                    <select id="projects">
                        <?php
                        $h = new Database_alters();
                        $h->table = WORK_TABLE;
                        $h->select_data();
                        if ($h->check_ex()) {
                            echo '<option value ="0">أختر</option>';
                            while ($h->show_data()) {
                                ?>
                                <option value="<?= $h->data['id'] ?>"><?= $h->data['title_ar'] ?></option>


                            <?php }
                        } ?>
                    </select>

                    <br>
                    <label> رفع الصور </label>
                    <form method="post" class="uploadalbumFiles" enctype="multipart/form-data"
                          style="display: inline-block">
                        <input type="file" class="PHOTOALBUM" name="ImageAlbumUpload[]" multiple="" accept="image/*">
                        <span class="album_upload_counter" style="color: #0000FF;"></span>
                        <div class="cirule" style="display: inline-block;">
                            <div class="loader"></div>
                        </div>
                    </form>
                    <input type="hidden" value="" class="files">

                    <br>
                    <input type="button" value="حفظ">


                </div>

                <div class="EDIT_ALBUMS ALBUM_TAB" style="display: none">

                    جار التحميل ..


                </div>
            </div>

            <div class="Tab_5 Tabs <?= $prev_dis ?>">
                <div class="section_tabs">
                    <div class="tab selected" id="section_a">أضافة مشروع</div>
                    <div class="tab" id="section_b">كأفة المشاريع</div>

                    <div class="clear"></div>
                </div>

                <div class="section_a sections" style="padding: 5px;">
                    <span class="Added" style="font-size: 11px;color: #8080FF;"></span><br>
                    <label> أسم المشروع *</label>
                    <input type="text" class="ar_name" placeholder="باللغة العربيه">
                    <input type="text" class="en_name" placeholder="باللغة الانجليزيه"> <br>
                    <label> تاريخ المشروع</label>
                    <input type="text" class="date_akhram_type done_on" readonly="readonly"><br>
                    <label> خأص بـ</label>
                    <input type="text" class="rel_ar" placeholder="مثال .. خاص بالشركه العقاريه"> <input class="rel_en"
                                                                                                         type="text"
                                                                                                         placeholder="بالانجليزيه ..."><br>
                    <label> الموقع *</label>

                    <select class="country">
                        <option value="0">أختر بلد</option>
                        <?php
                        $q = new Database_alters();
                        $q->table = COUNTRY_TABLE;
                        $q->Data_type = "`id`,`ar`";
                        $q->conditions = "WHERE `ar` <> ''";
                        $q->select_data();
                        while ($q->show_data()) {
                            echo '<option ' . (($q->data['id'] == 203) ? "selected='selected'" : "") . ' value="' . $q->data['id'] . '">' . $q->data['ar'] . '</option>';
                        }
                        ?>

                    </select>
                    <br>
                    <label> الولاية - المحافظه</label>
                    <input type="text" class="ar_city" placeholder="مثال .. الرياض"> <input class="en_city" type="text"
                                                                                            placeholder="بالانجليزيه..."><br>
                    <label> صور المشروع </label>
                    <span class="Photo_Type Photo_Type_Select" id="Upload_work_vd">رفع صور</span>
                    <span class="Photo_Type" id="Load_Albums">ربط بالبوم</span>
                    <div class="Photo_Work Upload_work_vd" style=""><label>أختر صور</label>
                        <form method="post" class="uploadalbumFiles" enctype="multipart/form-data"
                              style="display: inline-block">
                            <input type="file" class="PHOTOALBUM" name="ImageAlbumUpload[]" multiple=""
                                   accept="image/*"><span class="album_upload_counter" style="color: #0000FF;"></span>
                            <div class="cirule" style="display: inline-block;">
                                <div class="loader"></div>
                            </div>
                        </form>
                        <input type="hidden" value="" class="files">
                    </div>
                    <div class="Photo_Work Load_Albums" style="display: none;"><label>ربط بألبوم صور</label>
                        <select class="album">
                            <option disabled="disabled">Loading ...</option>
                        </select>
                    </div>
                    <label style="width: 100%;">

                        <input type="checkbox" class="pub" checked="checked"> نشر المشروع مباشرة على الصفحه الرئيسية
                        للموقع ؟
                        <label style="color: #8080FF;width: 40%;">*يتيح لك هذا الخيار للتعديل على المشروع حتى تراه
                            جاهزاً مستقبلا للنشر</label>
                    </label>

                    <br>
                    <label style="width: 100%;">المشروع باللغة العربيه *</label>
                    <textarea class="editor_content ar_content"></textarea>
                    <br>
                    <label style="width: 100%;">باللغة الأنجليزيه *</label>
                    <textarea class="editor_content en_content"></textarea>
                    <br>


                    <input type="button" value="حفظ">

                </div>
                <div class="section_b sections" style="display: none">
                    جار التحميل ..
                </div>

            </div>

            <div class="Tab_6 Tabs <?= $eq_dis ?>">
                <div class="Tab_View">
                    <div class="rols select_tap" id="sections">أنشاء قسم</div>
                    <div class="rols <?= ((EQU_in::Check_Sections()) ? "" : "disabeld_tap") ?>" id="create_equ">أضافة
                        معدات
                    </div>
                    <div class="rols <?= ((EQU_in::Check_Sections()) ? "" : "disabeld_tap") ?>" id="all_equ">كأفة
                        المعدات
                    </div>
                </div>
                <div class="SEC_WINDOW sections">
                    <label> أسم القسم *</label>
                    <input type="text" placeholder="بالعربيه"><input type="text" placeholder="بالانجليزيه"><br>
                    <label> رفع صوره *</label>
                    <form method="post" class="uploadSectionImg" enctype="multipart/form-data"
                          style="display: inline-block">
                        <input type="file" class="PHOTOSECTION" name="section_image" accept="image/*">
                        <span class="album_upload_counter" style="color: #0000FF;"></span>
                        <div class="cirule" style="display: inline-block;">
                            <div class="loader"></div>
                        </div>
                    </form>
                    <input type="hidden" class="files">
                    <br>
                    <br>
                    <input type="button" value="حفظ">
                    <div class="load_sections">Loading ...</div>
                </div>
                <div class="SEC_WINDOW create_equ" style="display: none;">
                    <span class="Added" style="font-size: 11px;color: #8080FF;"></span><br>
                    <label> اسم الأداة *</label>
                    <input type="text" placeholder="بالعربيه">
                    <input type="text" placeholder="بالانجليزيه"></br>
                    <label> رفع صور *</label>
                    <form method="post" class="uploadEquImg" enctype="multipart/form-data"
                          style="display: inline-block">
                        <input type="file" class="PHOTOEQU" name="Equ_image" accept="image/*">
                        <span class="album_upload_counter" style="color: #0000FF;"></span>
                        <div class="cirule" style="display: inline-block;">
                            <div class="loader"></div>
                        </div>
                    </form>
                    <br>
                    <input type="hidden" class="edit_id">
                    <input type="hidden" class="files">
                    <label> القسم </label>
                    <select class="sections">
                        <?php
                        $q = new Database_alters();
                        //                $q->Data_type = "`id`,`title_ar`";
                        $q->table = EQ_SEC_TABLE;
                        $q->select_data();
                        if ($q->check_ex()) {
                            while ($q->show_data()) {
                                echo '<option value="' . $q->data['id'] . '">' . $q->data['title_ar'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    </br>
                    <div class="Rows">
                        <div style="display: inline-block;" class="Model">
                            <label style="width: 50px;"> الموديل *</label>
                            <input type="text" class="Model_Text" style="width:80px;">
                            <label style="width: 50px;"> القدرة *</label>
                            <input type="text" class="Capcity_Text" style="width:80px;">
                            <label style="width: 50px;"> المنطقة *</label>
                            <input type="text" class="Location_Text" style="width:80px;">
                        </div>
                        <span onclick="AddEq_rows()" style="cursor: pointer;color: #0000FF;text-decoration: underline;">أضف صف</span><br>
                        <div class="New_rows"></div>

                    </div>
                    <label> معلومات أضافية </label><br>
                    <textarea placeholder="يالعربيه"></textarea>
                    <textarea placeholder="بالأنجليزيه"></textarea>
                    </br>
                    <input type="button" value="حفظ">
                </div>
                <div class="SEC_WINDOW all_equ" style="display: none;">
                    Loading ..

                </div>
            </div>
            <div class="Tab_7 Tabs <?= $articals_dis ?>">


                <div class="">
                    <input type="hidden" class="bran_id">
                    <label> أسم الفرع</label>
                    <input type="text" placeholder="باللغة العربيه">
                    <input type="text" placeholder="باللغة الأنجليزية">
                    <br>

                    <label> المدينة </label>
                    <select class="country">
                        <option value="0">أختر بلد</option>
                        <?php
                        $q = new Database_alters();
                        $q->table = COUNTRY_TABLE;
                        $q->Data_type = "`id`,`ar`";
                        $q->conditions = "WHERE `ar` <> ''";
                        $q->select_data();
                        while ($q->show_data()) {
                            echo '<option ' . (($q->data['id'] == 203) ? "selected='selected'" : "") . ' value="' . $q->data['id'] . '">' . $q->data['ar'] . '</option>';
                        }
                        ?>

                    </select><br>
                    <label> العنوان</label>
                    <input type="text" placeholder="بالعربيه">
                    <input type="text" placeholder="بالأنجليزية">


                    <br>

                    <input type="button" value="حفظ">

                </div>
                <div class="load_sections"></div>


            </div>

            <div class="Tab_8 Tabs <?= $cert_dis ?>">
                <div class="Tab_View">
                    <div class="rols select_tap" id="new_cer" title="أضافة شهادة جديدة">أضف شهادة</div>
                    <div class="rols" id="cert_all" title="مشاهدة وحذف كافة الشهادات">الشهادات</div>

                </div>
                <div class="new_cer tab">
                    <label> العنوان</label>
                    <input type="text" class="" placeholder="باللغة العربيه">
                    <input type="text" placeholder="باللغة الأنجليزية">
                    <br>
                    <label class="upload_photo"> رفع صورة </label>
                    <form method="post" class="uploadcertImg" enctype="multipart/form-data"
                          style="display: inline-block">
                        <input type="file" class="PHOTOCER" name="c_image" accept="image/*">
                        <span class="error_empty"
                              style="color:red ;font-weight: bold;display: none;">* يجب رفع صورة</span>
                        <span class="album_upload_counter" style="color: #0000FF;"></span>
                        <div class="cirule" style="display: inline-block;">
                            <div class="loader"></div>
                        </div>
                    </form>
                    <input type="hidden" class="files">
                    <br>


                    <label> عن الشهادة </label><br>
                    <textarea placeholder='بالعربي'></textarea>
                    <textarea placeholder='بالأنجليزية'></textarea>

                    <br>
                    <input type="button" value="حفظ">

                </div>
                <div class="cert_all tab" style="display: none;">

                </div>

            </div>

            <div class="Tab_9 Tabs <?= $contact_dis ?>">
                <span class="Added" style="font-size: 11px;color: #8080FF;"></span><br>

                <label class="head_link"> العنوان الرئيسي</label><br>
                <textarea placeholder="باللغة العربيه"><?= web_info::contact_us('add_ar', false) ?></textarea>
                <textarea placeholder="باللغة الأنجليزية"><?= web_info::contact_us('add_en', false) ?></textarea>

                <br>
                <label style="width: 100%;" class="head_link"> روابط التواصل الأجتماعي </label><br>
                <label class="social_label"> فايسبوك </label><input type="text"
                                                                    value="<?= web_info::contact_us('facebook', false) ?>"
                                                                    placeholder="رابط الفايسبوك">
                <label class="social_label"> تويتر </label><input type="text"
                                                                  value="<?= web_info::contact_us('twitter', false) ?>"
                                                                  placeholder="رابط حساب التويتر"><br>
                <label class="social_label"> جوجل بلاس </label><input type="text"
                                                                      value="<?= web_info::contact_us('google', true) ?>"
                                                                      placeholder="رابط الجوجل بلس">
                <label class="social_label"> يوتيوب </label><input type="text"
                                                                   value="<?= web_info::contact_us('youtube', false) ?>"
                                                                   placeholder="رابط فناة اليوتيوب"><br>

                <label class="social_label"> أنستقرام </label><input type="text"
                                                                     value="<?= web_info::contact_us('instg', false) ?>"
                                                                     placeholder="رابط حساب الانستقرام">
                <label class="social_label"> بريد الكتروني </label><input type="text"
                                                                          value="<?= web_info::contact_us('email', false) ?>"
                                                                          placeholder="البريد الألكتروني"><br>


                <label class="head_link"> أرقام الهواتف</label><br>
                <label class="social_label"> الهاتف الثابت</label><input type="text"
                                                                         value="<?= web_info::contact_us('phone', false) ?>"
                                                                         placeholder="مع رمز الدولة ..">
                <label class="social_label"> الفاكس </label><input type="text"
                                                                   value="<?= web_info::contact_us('fax', false) ?>"
                                                                   placeholder="مع رمز الدولة .."><br>
                <label class="social_label"> الهاتف المحمول</label><input type="text"
                                                                          value="<?= web_info::contact_us('mobile', false) ?>"
                                                                          placeholder="مع رمز الدولة .."><br>

                <input type="button" value="حفظ">


            </div>

            <div class="Tab_10 Tabs <?= $other_dis ?>">
                <div class="Tab_View">
                    <div class="rols select_tap" id="users">المستخدمين</div>
                    <div class="rols" id="mails">الرسائل</div>
                    <div class="rols" id="v_m">الرؤية والرسالة</div>
                    <div class="rols" id="about_us">من نحن</div>
                    <div class="rols" id="advs">الأعلانات</div>
                    <div class="rols" id="advanced">خيارات متقدمة</div>


                </div>
                <div class="users tab">
                    <?php
                    if ($_SESSION['user_id'] == 1) {
                        ?>
                        <div style="color: red;font-size: 10px;display: none;margin: 5px 3px;" class="ERR_TOK">*أسم
                            المستخدم موجود مسبقاً
                        </div>
                        <label> أسم المستخدم</label>
                        <input type="text" placeholder=""><br>
                        <label> كلمة المرور </label>
                        <input type="password"><br>
                        <input type="button" value="حفظ">
                        <?php
                    }
                    ?>
                    <div class="load_users"></div>

                </div>
                <div class="mails tab" style="display: none;">

                </div>
                <div class="v_m tab" style="display: none;">

                </div>
                <div class="about_us tab" style="display: none;">

                </div>
                <div class="advs tab" style="display: none;">

                </div>
                <div class="advanced tab" style="display: none;">

                </div>

            </div>

            <div class="Tab_11 Tabs <?= $serv_dis ?>">
                <input type="hidden" class="edit_serv_id">
                <label style="width: 24px;"> العنوان</label>
                <input type="text" placeholder="بالعربيه">
                <input type="text" placeholder="بالانجليزيه">
                <br>
                <input type="button" value="حفظ">

                <div class="load_sections">


                </div>

            </div>

        </div>
        <div class="clear"></div>


    </div>
    <?php
}
include "admin_footer.php";

