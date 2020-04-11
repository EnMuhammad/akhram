<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $q = new Database_alters();
    $q->table = EQ_SEC_TABLE;
    $q->conditions = "WHERE `id`='$id'";
    $q->select_data();
    if ($q->check_ex()) {
        $q->show_data();
        echo '<td></td>';
        echo '<td><input type="text" value="' . $q->data['title_ar'] . '" style=";margin:0;display:inline-block;"></td>';
        echo '<td><input type="text" value="' . $q->data['title_en'] . '" style=";margin:0;display:inline-block;"></td>';
        echo '<td><input type="button" onclick="SaveEdit_Section(this,' . $id . ')" value="حفظ" style="margin:0;display:inline-block;float:none;"></td>';

    } else {
        echo 'Error';
    }


}
