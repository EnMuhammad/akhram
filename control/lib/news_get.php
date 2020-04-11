<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $q = new Database_alters();
    $q->table = NEWS_TABLE;
    $q->conditions = "WHERE `id`='$id'";
    $q->select_data();
    if ($q->check_ex()) {
        $q->show_data();
        $array = array();
        $array['id'] = $q->data['id'];
        $array['tar'] = $q->data['title_ar'];
        $array['ten'] = $q->data['title_en'];
        $array['ara_con'] = $q->data['content_ar'];
        $array['eng_con'] = $q->data['content_en'];
        $array['url'] = $q->data['url'];
        echo json_encode($array, JSON_FORCE_OBJECT);
    }


}
