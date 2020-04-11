<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $q = new Database_alters();
    $q->table = SERVICES_TABLE;
    $q->conditions = "WHERE `id`='$id'";
    $q->select_data();
    if ($q->check_ex()) {
        $q->show_data();
        $array = array();
        $array['id'] = $q->data['id'];
        $array['ar'] = $q->data['title_ar'];
        $array['en'] = $q->data['title_en'];
        echo json_encode($array, JSON_FORCE_OBJECT);
    }

}
