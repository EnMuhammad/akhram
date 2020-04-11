<?php
if (isset($_GET['option'])) {
    $option = true;
} else {
    $option = false;
}
$q = new Database_alters();
$q->table = ALBUM_TABLE;
$q->conditions = "WHERE `work_id`='0' AND `equ_id`='0'";
$q->select_data();
if ($q->check_ex()) {
    while ($q->show_data()) {
        if ($option == true) {
            echo '<option value="' . $q->data['id'] . '">' . $q->data['title_ar'] . '-' . $q->data['title_en'] . '</option>';
        } else {
            echo $q->data['title_ar'] . '-' . $q->data['title_en'];
        }
    }
} else {
    if ($option == true) {
        echo '<option value="0" disabled="disabled">لا يوجد البومات </option>';
    } else {
        echo 'Empty';
    }
}
