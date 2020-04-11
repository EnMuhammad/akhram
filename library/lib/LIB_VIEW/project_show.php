<?php
$sql = new Database_alters();
$alb = new Database_alters();
$style = new Style();
$sql->table = WORK_TABLE;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

} else {
    $sql->Data_type = "id";
    $sql->conditions = "WHERE `pub`='0' ORDER BY `id` DESC";
    $sql->select_data();
    if ($sql->check_ex()) {
        $sql->show_data();
        $id = $sql->data['id'];
    } else {
        exit();
    }
}
$sql->Data_type = "`id`,`title_en`,`title_ar`,`done_on`,`related_ar`,`related_en`,`country`,`city_ar`,`city_en`
,`content_ar`,`content_en`";
$sql->conditions = "WHERE `id`='$id'";
$sql->select_data();
if ($sql->check_ex()) {
    $sql->show_data();
    echo '<div class="data">';
    echo '<h1>' . $sql->data['title_' . $DL['lang']] . '</h1>';
    echo '<h2>' . $project_lang['DONE_ON'] . ': ' . $sql->data['done_on'] . '</h2>';
    echo '<h2>' . $project_lang['RELATED'] . ': ' . $sql->data['related_' . $DL['lang']] . '</h2>';
    echo '<h2>' . $project_lang['COUTRY'] . ': ' . Country_name($sql->data['country'], $DL['lang'])[$DL['lang']] . '</h2>';
    if ($sql->data['city_' . $DL['lang']] == '') {

    } else {
        echo '<h2>' . $project_lang['CITY'] . ': ' . $sql->data['city_' . $DL['lang']] . '</h2>';
    }

    echo '<div class="project_album">';
    $alb->table = ALBUM_TABLE;
    $alb->conditions = "WHERE `work_id`='" . $sql->data['id'] . "'";
    $alb->select_data();
    $show_footer = false;
    if ($alb->check_ex()) {

        $alb->show_data();
        $album_id = $alb->data['id'];

        $alb->table = PHOTO_TABLE;
        $alb->conditions = "WHERE `album_id`='$album_id' ORDER BY `id` DESC LIMIT 5";
        $alb->select_data();
        if ($alb->check_ex()) {
            $show_footer = true;

            echo '<div class="album_data">';
            while ($alb->show_data()) {
                $style->img = WEB_FILES . '/photos/' . $alb->data['image'];
                $style->c_class = "img";
                $style->on_click = "onclick='LoadAlbum($album_id,\"" . $sql->data['title_' . $DL['lang']] . "\"," . $alb->data['id'] . ")'";
                echo $style->Div_background();
            }

            echo '</div>';

        }
    }
    echo '</div>';

    echo '<div class="project_footer font_ar" style="display:inline-block; width:100%;' . $DL['float'] . ': 0;">';
    echo '<a href="Project=' . $sql->data['id'] . '" onclick="LoadProjectPage(' . $sql->data['id'] . ');return false;">' . $project_lang['VIPRO'] . '</a>';
    if ($show_footer == true) {
        echo '- <a href="#"  onclick="LoadAlbum(' . $album_id . ',\' ' . $sql->data['title_' . $DL['lang']] . ' \')">' . $project_lang['VFULLALBUM'] . '</a> - ';
        echo '<a href="#"  onclick="Project_album(' . $album_id . ')">' . $project_lang['VRELATEDALBUM'] . '</a>';
    }

    echo '</div>';

    echo '</div>';
}