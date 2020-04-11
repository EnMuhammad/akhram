<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $q = new Database_alters();
    $q->table = BRAN_TABLE;
    $q->conditions = "WHERE `id`='$id'";
    $q->select_data();
    if ($q->check_ex()) {
        $q->show_data();
        $array = array();
        $array['id'] = $q->data['id'];
        $array['ar'] = $q->data['title_ar'];
        $array['en'] = $q->data['title_en'];
        $array['city'] = $q->data['city'];
        $array['add_ar'] = $q->data['address_ar'];
        $array['add_en'] = $q->data['address_en'];
        echo json_encode($array, JSON_FORCE_OBJECT);
    }

}
