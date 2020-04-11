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
if ($page == 1){

    ?>

    <div class="Page">
        <div class="Page_container" style="float: <?= $DL['float'] ?>;width: 100%;">
            <div class="Box_Head" style="text-align:<?= $DL['float'] ?>">
                <a href="#" style="color: white;"><?= $equ_lang['SECTIONS_TAB'] ?></a></div>
            <?php
            }

            $q = new Database_alters();
            $q_ = new Database_alters();
            $a = new Albums();
            $s = new Style();
            $s->coustme_style = "margin:5px;";
            $q->table = EQ_SEC_TABLE;
            $sql = '';
            $q->select_data();
            $total = $q->count_ex();
            $total_p = ceil($total / $rows);
            $more = $page + 1;
            $q->conditions = "$sql ORDER BY `id` DESC LIMIT $limit,$rows";
            $q->select_data();
            if ($q->check_ex()) {
                while ($q->show_data()) {
                    $wid = $q->data['id'];
                    $photo = $q->data['image'];
                    if (file_exists(WEB_FILES . '/sections/' . $photo)) {
                        $photo = "/sections/" . $photo;
                    } else {

                        $photo = "/def/no_image_thumb.gif";
                    }
                    $id = intval($q->data['id']);
                    $s->img = BASE . '/' . WEB_FILES . $photo;
                    $s->c_class = "box_image";
                    $s->width = $s->height = "100px";
                    $s->float = $DL['float'];

                    ?>
                    <div class="Boxes" style="height: 150px;width: 30%;float:<?= $DL['float'] ?>;">

                        <div class="box_title" style="text-align:<?= $DL['float'] ?>">
                            <a href="#"
                               onclick="LoadSectionContent(<?= $id ?>,'<?= str_replace(' ', '_', $q->data['title_' . $DL['lang']]) ?>')">
                                <?= $q->data['title_' . $DL['lang']] ?></a></div>
                        <?= $s->Div_background() ?>
                        <div class="box_content" style="float:<?= $DL['float'] ?>;width: auto;">
                            <?php
                            $q_->table = EQUI_TABLE;
                            $q_->conditions = "WHERE `sec`='" . $q->data['id'] . "'";
                            $q_->select_data();
                            $nums = $q_->count_ex();
                            $q_->conditions = "WHERE `sec`='" . $q->data['id'] . "'ORDER BY `id` DESC LIMIT 4";
                            $q_->select_data();
                            if ($q_->check_ex()) {
                                ?>

                                <ul class="links" style="text-align: <?= $DL['float'] ?>;">
                                    <?php
                                    while ($q_->show_data()) {
                                        echo '<li onclick="LoadEqu(' . $q_->data['id'] . ')">' . $q_->data['title_' . $DL['lang']] . '</li>';


                                    }
                                    if ($nums > 4) {
                                        echo '<li>...</li>';
                                    }
                                    ?>


                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clear"></div>


                    </div>


                    <?php
                }
                if ($page > $total_p) {
                    echo '<a href="#" class="More_data"><span onclick="LoadMoreAlbums(' . $more . ',this)">More</span></a>';
                    echo '<div class="APPEND_NEW_' . $more . '"></div>';
                }
            }


            if ($page == 1){
            ?>

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
