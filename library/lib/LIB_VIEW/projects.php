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
$add_city = false;
$name = '';
$proj_id = 0;
if (isset($_GET['country'])) {
    if (is_numeric($_GET['country'])) {
        $search = true;
        $cid = intval($_GET['country']);
        if ($cid != 0) {
            if (isset($_GET['city'])) {
                $name = htmlspecialchars(strip_tags(trim($_GET['city'])));
                if ($name != '0') {
                    $add_city = true;
                }
            }
        }

    }

}
if ($page == 1){

    ?>

    <div class="Page">
        <div class="Page_container" style="float: <?= $DL['float'] ?>">
            <div class="Box_Head" style="text-align:<?= $DL['float'] ?>"><?= $project_lang['PROJES'] ?></div>
            <?php
            }

            $q = new Database_alters();
            $q_ = new Database_alters();
            $a = new Albums();
            $s = new Style();
            $s_ = new Style();
            $q->table = WORK_TABLE;

            if ($search == true) {
                if ($add_city == false) {
                    $q->conditions = "WHERE `country` = '$cid'";
                    $sql = "WHERE `country` = '$cid'";
                } else if ($add_city == true) {
                    $q->conditions = "WHERE `country` = '$cid' AND `city_" . $DL['lang'] . "`='$name'";
                    $sql = "WHERE `country` = '$cid' AND `city_" . $DL['lang'] . "`='$name'";


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
            if ($q->check_ex()) {
                while ($q->show_data()) {
                    $id = intval($q->data['id']);

                    ?>
                    <div class="Boxes" style="height: 120px;">

                        <div class="box_title"
                             style="text-align:<?= $DL['float'] ?>"><?= $q->data['title_' . $DL['lang']] ?></div>

                        <div class="box_content" dir="<?= $DL['dir'] ?>"
                             style="float:<?= $DL['float'] ?>;text-align:<?= $DL['float'] ?>;padding: 24px 0">
                            <?php
                            $pr = $q->data['content_' . $DL['lang']];
                            if (strlen($q->data['content_' . $DL['lang']]) > 300) {
                                $pr = mb_substr($q->data['content_' . $DL['lang']], 0, 300, 'UTF8') . '....';
                            }
                            echo $pr;
                            ?>
                        </div>

                        <div class="clear"></div>

                        <div class="box_footer" style="text-align: <?= $DL['op_float'] ?>">
                            <span style="float: <?= $DL['float'] ?>;cursor: default"><?= Country_name($q->data['country'], $DL['lang'])[$DL['lang']] ?></span>
                            <span><a href="Project=<?= $q->data['id'] ?>"
                                     onclick="LoadProjectPage(<?= $q->data['id'] ?>);return false;"><?= $project_lang['VIPRO'] ?></a></span>

                        </div>


                    </div>


                    <?php
                }
                if ($search == true) {
                    echo '<input type="hidden" value="' . $cid . '" class="country_search">';
                    if ($add_city == true) {
                        echo '<input type="hidden" value="' . $name . '" class="city_search">';
                    }
                }
                if ($page < $total_p) {
                    echo '<a href="#" class="More_data"><span onclick="LoadMoreProject(' . $more . ',this);return false;">More</span></a>';
                    echo '<div class="APPEND_NEW_' . $more . '"></div>';
                }
            }


            if ($page == 1){
            ?>

        </div>
        <div class="Page_func Project_Search" style="float: <?= $DL['float'] ?>;text-align: <?= $DL['float'] ?>">
            <div class="Box_Head"><?= $project_lang['SEARCH'] ?></div>
            <label for="search_albums"><?= $project_lang['COUTRY'] ?></label>
            <select id="country" dir="<?= $DL['dir'] ?>">
                <?php
                $h = new Database_alters();
                $h->table = WORK_TABLE;
                $h->Data_type = "DISTINCT country";
                $h->select_data();
                if ($h->check_ex()) {
                    echo '<option value ="0">' . $project_lang['SELECT'] . '</option>';
                    while ($h->show_data(true)) {
                        ?>
                        <option value="<?= $h->data['country'] ?>"><?= Country_name($h->data['country'], $DL['lang'])[$DL['lang']] ?></option>

                    <?php }
                } ?>
            </select>
            <label for="search_albums"><?= $project_lang['CITY'] ?></label>
            <select id="city" disabled="disabled" dir="<?= $DL['dir'] ?>">
                <?php


                echo '<option value ="0" >' . $project_lang['SELECT'] . '</option>';

                ?>


            </select>
            <input type="button" onclick="Search_Project(this)" value="<?= $project_lang['SEARCH'] ?>"
                   style="float: <?= $DL['op_float'] ?>">
            <div class="Load_search_Name SE_Loader" style="display: none">
                <div class="loader"
                     style="display: inline-block;background-image: url('<?= IMAGES_DIR ?>/loading.gif');background-position: center;background-repeat: no-repeat;width: 100%;height: 5px;"></div>
            </div>
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
        $('.Project_Search #country').on('change', function () {
            var val = $(this).val();
            if (val != 0) {
                $('.Project_Search #city').removeAttr('disabled');

                $('.Project_Search #city').load('home?loadprojectcity&country=' + val, function (data) {
                    if (data == 0) {
                        $('.Project_Search #city').val(0);
                        $('.Project_Search #city').attr('disabled', 'disabled');
                    }

                });
            } else {
                $('.Project_Search #city').val(0);
                $('.Project_Search #city').attr('disabled', 'disabled');

            }


        })

    </script>

<?php
