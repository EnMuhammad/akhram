<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $style = new Style();
    $style->width = $style->height = "300px";
    $style->float = $DL['float'];
    $style->coustme_style = "margin:5px;border:1px solid #ACACAC;";
    $q = new Database_alters();
    $q->table = EQUI_TABLE;
    $q->conditions = "WHERE `id`='$id'";
    $q->select_data();
    if ($q->check_ex()) {
        $q->show_data();
        $photo = Albums::Get_eq_photo(Albums::work_album_id($id, "equ_id"));
        if ($photo == 0) {
            $photo = "/def/no_image_thumb.gif";
        } else {
            $photo = "/photos/" . $photo;
        }
        $style->img = BASE . '/' . WEB_FILES . $photo;

        ?>
        <div class="Page">
            <div class="Page_container" style="width: 90%;margin: auto;">
                <div class="Head" style="text-align: <?= $DL['float'] ?>;">
                    <a href="#" onclick="LoadSecPage()" style="color: white;"><?= $equ_lang['SEC'] ?></a> >
                    <a href="#" style="color: white;"
                       onclick="LoadSectionContent(<?= $q->data['sec'] ?>,'<?= str_replace(' ', '_', EQU_in::NAME_Sections($q->data['sec'], $DL['lang'])) ?>')">
                        <?= EQU_in::NAME_Sections($q->data['sec'], $DL['lang']) ?></a> >
                    <?= $q->data['title_' . $DL['lang']] ?></div>
                <?= $style->Div_background() ?>
                <h1 style="text-align: <?= $DL['float'] ?>;"><?= $q->data['title_' . $DL['lang']] ?></h1>
                <h2 style="text-align: <?= $DL['float'] ?>;">
                    <a href="#"><?= EQU_in::NAME_Sections($q->data['sec'], $DL['lang']) ?></a></h2>
                <h2 style="text-align: <?= $DL['float'] ?>;"><?= $q->data['co_' . $DL['lang']] ?></h2>
                <?php
                $q->table = EQU_INFO_TABLE;
                $q->conditions = "WHERE `equ_id`='$id'";
                $q->select_data();
                if ($q->check_ex()) {
                    ?>
                    <table class="Table" dir="<?= $DL['dir'] ?>" style="float: <?= $DL['float'] ?>;">
                        <tr>
                            <th><?= $equ_lang['MD_PO'] ?></th>
                            <th><?= $equ_lang['CAPC'] ?></th>
                            <th><?= $equ_lang['LOCATION'] ?></th>
                        </tr>
                        <?php
                        while ($q->show_data()) {
                            echo '<tr>';
                            echo '<td>' . $q->data['model_power'] . '</td>';
                            echo '<td>' . $q->data['capacity'] . '</td>';
                            echo '<td>' . $q->data['location'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <?php
                }
                ?>
                <div class="clear"></div>
                <div class="Share" dir="<?= $DL['dir'] ?>" style="text-align: <?= $DL['float'] ?>;">
                    <?= $equ_lang['SHARE'] ?>
                    <img src="<?= BASE . '/' . IMAGES_DIR . '/face_share.png' ?>" title="Facebook">
                    <img src="<?= BASE . '/' . IMAGES_DIR . '/twitter_share.png' ?>" title="Twitter">

                </div>
            </div>


        </div>


        <?php
    } else {
        echo 'No';
    }


}
