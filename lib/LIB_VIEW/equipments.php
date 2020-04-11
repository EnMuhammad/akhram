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
if (isset($_GET['bysec'])) {
    $sec = intval($_GET['sec']);
    $sec_b = "WHERE `sec`='$sec'";
    $section_name = EQU_in::NAME_Sections($sec, $DL['lang']);
} else {
    $sec_b = "";
    $section_name = $equ_lang['PROJ_HEAD'];
}
if ($page == 1){

    ?>

    <div class="Page">
        <div class="Page_container" style="float: <?= $DL['float'] ?>">
            <div class="Box_Head" style="text-align:<?= $DL['float'] ?>">
                <a href="#" style="color: white;" onclick="LoadSecPage()"><?= $equ_lang['SECTIONS_TAB'] ?></a>
                > <a href="" style="color: white;"><?= $section_name ?></a></div>
            <?php
            }

            $q = new Database_alters();
            $q_ = new Database_alters();
            $a = new Albums();
            $s = new Style();
            $s->coustme_style = "margin:5px;";
            $q->table = EQUI_TABLE;


            $q->select_data();
            $total = $q->count_ex();
            $total_p = ceil($total / $rows);
            $more = $page + 1;
            $q->conditions = "$sec_b ORDER BY `id` DESC LIMIT $limit,$rows";
            $q->select_data();
            if ($q->check_ex()) {
                while ($q->show_data()) {
                    $wid = $q->data['id'];
                    $photo = Albums::Get_eq_photo(Albums::work_album_id($wid, "equ_id"));
                    if ($photo == 0) {
                        $photo = "/def/no_image_thumb.gif";


                    } else {
                        $photo = "/photos/" . $photo;
                    }
                    $id = intval($q->data['id']);
                    $s->img = BASE . '/' . WEB_FILES . $photo;
                    $s->c_class = "box_image";
                    $s->float = $DL['float'];

                    ?>
                    <div class="Boxes" style="height: 170px;">

                        <div class="box_title" style="text-align:<?= $DL['float'] ?>">
                            <h2 class="box_title" style="font-size: 14px;margin: 0;cursor: pointer;"
                                onclick="LoadEqu(<?= $q->data['id'] ?>)"><?= $q->data['title_' . $DL['lang']] ?></h2>
                        </div>
                        <?= $s->Div_background() ?>

                        <div class="box_content"
                             style="float:<?= $DL['float'] ?>;text-align:<?= $DL['float'] ?>;padding: 24px 0">
                            <?= $q->data['co_' . $DL['lang']] ?>
                        </div>
                        <div class="clear"></div>
                        <div class="box_footer" style="text-align: <?= $DL['op_float'] ?>">

                            <span onclick="LoadEqu(<?= $q->data['id'] ?>)"><?= $equ_lang['VIEW'] ?></span>

                        </div>

                    </div>


                    <?php
                }
                if ($page < $total_p) {
                    echo '<a href="#" class="More_data"><span onclick="LoadMoreEqus(' . $more . ',this)">' . $DL['LOAD_MORE_DATA'] . '</span></a>';
                    echo '<div class="APPEND_NEW_' . $more . '"></div>';
                }
            }


            if ($page == 1){
            ?>

        </div>
        <div class="Page_func" style="float: <?= $DL['float'] ?>;text-align: <?= $DL['float'] ?>">
            <div class="Box_Head"><?= $equ_lang['SERCH_BTN'] ?></div>


            <label for="projects"><?= $equ_lang['SEC'] ?></label>

            <select id="projects" dir="<?= $DL['dir'] ?>">

                <?php
                $h = new Database_alters();
                $h->table = EQ_SEC_TABLE;
                $h->select_data();
                if ($h->check_ex()) {
                    echo '<option value ="0">' . $equ_lang['SELECT'] . '</option>';
                    while ($h->show_data()) {
                        ?>
                        <option value="<?= $h->data['id'] ?>" <?= (($search == true) ? (($proj_id == $h->data['id']) ? 'selected="selected"' : "") : "") ?>><?= $h->data['title_' . $DL['lang']] ?></option>


                    <?php }
                } ?>
            </select>
            <br>


            <input type="button"
                   onclick="LoadSectionContent($('#projects').val(),$('#projects option:selected').text().replace(/\s/g,'_'))"
                   style="float: <?= $DL['op_float'] ?>" value="<?= $equ_lang['SERCH_BTN'] ?>">
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
