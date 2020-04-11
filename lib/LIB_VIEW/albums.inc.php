<?php
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}
$rows = 10;
if ($page)
    $limit = ($page - 1) * $rows;
else
    $limit = 0;

$search = false;
$name = '';
$proj_id = 0;
if (isset($_GET['name'])) {
    $name = htmlspecialchars(strip_tags(trim($_GET['name'])));
    $search = true;
    $type = 'TEXT';
} else if (isset($_GET['byproject'])) {
    $proj_id = intval($_GET['pid']);
    $search = true;
    $type = 'PROJ';
}
if ($page == 1){

    ?>

    <div class="Page">
        <div class="Page_container" style="float: <?= $DL['float'] ?>">
            <div class="Box_Head" style="text-align:<?= $DL['float'] ?>"><?= $ap_lang['ALBUMS'] ?></div>
            <?php
            }

            $q = new Database_alters();
            $q_ = new Database_alters();
            $a = new Albums();
            $s = new Style();
            $s_ = new Style();
            $q->table = ALBUM_TABLE;

            if ($search == true) {
                if ($type == 'TEXT') {
                    $q->conditions = "WHERE `title_ar` LIKE '%$name%' OR `title_en` LIKE '%$name%'";
                    $sql = "WHERE `title_ar` LIKE '%$name%' OR `title_en` LIKE '%$name%' ";

                } else if ($type == 'PROJ') {
                    $q->conditions = "WHERE `work_id`='$proj_id'";
                    $sql = "WHERE `work_id`='$proj_id'";


                } else {
                    $sql = '';
                }
            } else {
                $sql = '';
            }
            $q->select_data();
            $total = $q->count_ex();
            $total_p = ceil($total / $rows);
            $more = $page + 1;

            $q->conditions = "$sql ORDER BY `id` DESC LIMIT $limit,$rows";
            $q->select_data();
            $q_->table = PHOTO_TABLE;
            if ($q->check_ex()) {
                while ($q->show_data()) {
                    $id = intval($q->data['id']);
                    $s->img = Albums::Get_Random_Pic($id, false);
                    $s->c_class = "box_image";
                    $s->float = $DL['float'];

                    ?>
                    <div class="Boxes" style="height: 170px;">

                        <div class="box_title"
                             style="text-align:<?= $DL['float'] ?>"><?= Albums::Album_info('title_' . $DL['lang'], $id) ?></div>
                        <?= $s->Div_background() ?>
                        <div class="box_content"
                             style="float:<?= $DL['float'] ?>;text-align:<?= $DL['float'] ?>;padding: 24px 0">
                            <?php
                            $q_->conditions = "WHERE `album_id`='$id'";
                            $q_->select_data();
                            if ($q_->count_ex() > 6) {
                                $l = $q_->count_ex() - 6;
                                $pics_more = "<div class='More_Num' style='float:" . $DL['float'] . "' title='more $l photos'><span>...</span></div>";
                            } else {
                                $pics_more = '';
                            }
                            $q_->conditions = "WHERE `album_id`='$id' ORDER BY `id` DESC LIMIT 6";
                            $q_->select_data();
                            if ($q_->check_ex()) {
                                $view_btn = true;
                                while ($q_->show_data()) {
                                    $img = WEB_FILES . '/photos/' . $q_->data['image'];
                                    if (file_exists($img)) {
                                        $s_->img = $img;
                                        $s_->height = $s_->width = "80px";
                                        $s_->float = $DL['float'];
                                        echo $s_->Div_background();

                                    }
                                }
                                echo $pics_more;
                            } else {
                                $view_btn = false;
                            }


                            ?>


                        </div>

                        <div class="clear"></div>
                        <?php
                        if ($view_btn == true) {
                            ?>
                            <div class="box_footer" style="text-align: <?= $DL['op_float'] ?>">

                                <span onclick="LoadAlbum(<?= $id ?>,'<?= Albums::Album_info('title_' . $DL['lang'], $id) ?>')"><?= $ap_lang['VIEW_ALBUMS'] ?></span>

                            </div>
                            <?php
                        }
                        ?>

                    </div>


                    <?php
                }
                if ($page < $total_p) {
                    echo '<a href="#" class="More_data"><span onclick="LoadMoreAlbums(' . $more . ',this)">More</span></a>';
                    echo '<div class="APPEND_NEW_' . $more . '"></div>';
                }
            }


            if ($page == 1){
            ?>

        </div>
        <div class="Page_func" style="float: <?= $DL['float'] ?>;text-align: <?= $DL['float'] ?>">
            <div class="Box_Head"><?= $ap_lang['LINKED_PROJ'] ?></div>
            <label for="search_albums"><?= $ap_lang['SEARCH'] ?></label>
            <input id="search_albums" type="text"
                   dir="<?= $DL['dir'] ?>" <?= (($search == true) ? (($type == 'TEXT') ? "value='$name'" : "") : "") ?>
                   placeholder="<?= $ap_lang['SEARCH_PALCE'] ?>..." onkeyup="detectDirection(this);">


            <input type="button" onclick="Search_albums(this,0)" value="<?= $ap_lang['SERCH_BTN'] ?>"
                   style="float: <?= $DL['op_float'] ?>">
            <div class="Load_search_Name SE_Loader" style="display: none">
                <div class="loader"
                     style="display: inline-block;background-image: url('<?= IMAGES_DIR ?>/loading.gif');background-position: center;background-repeat: no-repeat;width: 100%;height: 5px;"></div>
            </div>


            <label for="projects"><?= $ap_lang['PROJECT_LABEL'] ?></label>

            <select id="projects">

                <?php
                $h = new Database_alters();
                $h->table = WORK_TABLE;
                $h->select_data();
                if ($h->check_ex()) {
                    echo '<option value ="0">Select</option>';
                    while ($h->show_data()) {
                        ?>
                        <option value="<?= $h->data['id'] ?>" <?= (($search == true) ? (($proj_id == $h->data['id']) ? 'selected="selected"' : "") : "") ?>><?= $h->data['title_' . $DL['lang']] ?></option>


                    <?php }
                } ?>
            </select>
            <br>


            <input type="button" onclick="Search_albums(this,1)" style="float: <?= $DL['op_float'] ?>"
                   value="<?= $ap_lang['SERCH_BTN'] ?>">
            <div class="Load_search_project SE_Loader" style="display:none ;">
                <div class="loader"
                     style="display: inline-block;background-image: url('<?= IMAGES_DIR ?>/loading.gif');background-position: center;background-repeat: no-repeat;width: 100%;height: 5px;"></div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
    <?php
}

?>

    <script type="text/javascript">

        $('.Page .Page_container a').on('click', function () {

            return false;

        })

    </script>

<?php
