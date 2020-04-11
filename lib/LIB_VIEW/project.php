<?php
if (isset($_GET['pid'])) {
    if (is_numeric($_GET['pid'])) {
        $id = intval($_GET['pid']);
        $q = new Database_alters();
        $a = new Database_alters();
        $style = new  Style();
        $q->table = WORK_TABLE;
        $q->Data_type = "`id`,`title_" . $DL['lang'] . "`,`done_on`,`related_" . $DL['lang'] . "`,`country`,`city_" . $DL['lang'] . "`,`content_" . $DL['lang'] . "`";
        $q->conditions = "WHERE `id`='$id' AND `pub`='0'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            ?>
            <div class="Project_Page Project_Page_<?= $DL['lang'] ?>" style="text-align: <?= $DL['float'] ?>">
                <div class="Share" style="text-align: <?= $DL['op_float'] ?>">

                    <div class="box facebook"></div>
                    <div class="box twitter"></div>
                    <?= $DL['SHARE_TEXT'] ?>
                </div>
                <div class="Title"><?= $q->data['title_' . $DL['lang']] ?></div>
                <div class="related"><?= $q->data['related_' . $DL['lang']] ?>
                    - <?= Country_name($q->data['country'], $DL['lang'])[$DL['lang']] ?>
                    <?= (($q->data['city_' . $DL['lang']] != '' || !empty($q->data['city_' . $DL['lang']])) ? $q->data['city_' . $DL['lang']] : "") ?></div>
                <div class="date">
                    <?= $project_lang['DONE_ON'] . ' ' . $q->data['done_on'] ?>
                </div>

                <div class="content">
                    <div class="content_text" style="float: <?= $DL['op_float'] ?>" dir="<?= $DL['dir'] ?>">
                        <div class="box_title" style="float: <?= $DL['float'] ?>"><?= $project_lang['ABT_PROJ'] ?></div>
                        <div style="float: <?= $DL['op_float'] ?>;width: 100%">
                            <?= nl2br($q->data['content_' . $DL['lang']]) ?>
                        </div>


                    </div>
                    <div class="content_album" style="float: <?= $DL['float'] ?>">
                        <div class="box_title"
                             style="float: <?= $DL['float'] ?>"><?= $project_lang['PHOTO_ALBUM'] ?></div>
                        <?php

                        $a->table = ALBUM_TABLE;
                        $a->conditions = "WHERE `work_id`='$id' AND `equ_id`='0'";
                        $a->select_data();
                        if ($a->check_ex()) {
                            $a->show_data();
                            $album_id = $a->data['id'];
                            $album = new Albums();
                            $album->album_id = $album_id;
                            if (!empty($album->Get_Album_photo())) {
                                foreach ($album->Get_Album_photo() as $val => $photo) {
                                    $p = $photo['img'];
                                    $pi = $photo['id'];
                                    $dir = WEB_FILES . '/photos/';
                                    $style->width = $style->height = "80px";
                                    $style->float = $DL['float'];
                                    $style->coustme_style = "cursor: pointer;";
                                    $style->on_click = "onclick='LoadAlbum($album_id,\"" . $q->data['title_' . $DL['lang']] . "\",$pi)'";

                                    if (file_exists($dir . $p)) {
                                        $style->img = $dir . $p;
                                        echo $style->Div_background();
                                    }


                                }

                            }
                        }

                        ?>
                    </div>
                    <div class="clear"></div>


                </div>

                <div class="clear"></div>
                <div class="project_footer">All Projects - Saudi Arabia Projects - Contact us - Search</div>
            </div>


            <?php

        }


    } else {
        print('ERROR');
    }
} else {
    print('ERROR');
}


