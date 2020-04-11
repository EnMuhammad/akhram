<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $q = new Database_alters();
    $q->table = EQUI_TABLE;
    $q->conditions = "WHERE `id`='$id'";
    $q->select_data();
    if ($q->check_ex()) {
        $q->show_data();
        $array = array();
        $array['id'] = $q->data['id'];
        $array['ar'] = $q->data['title_ar'];
        $array['en'] = $q->data['title_en'];
        $array['sec'] = $q->data['sec'];
        $array['co_ar'] = $q->data['co_ar'];
        $array['co_en'] = $q->data['co_en'];

        $q->table = EQU_INFO_TABLE;
        $q->conditions = "WHERE `equ_id`='$id'";
        $q->select_data();
        if ($q->check_ex()) {
            $array['m'] = '';
            while ($q->show_data()) {
                $array['m'] .= '
            <div style="display: inline-block;" class="Model">
            <label style="width: 50px;"> الموديل *</label>
            <input type="text" value="' . $q->data['model_power'] . '" class="Model_Text" style="width:80px;">
            <label style="width: 50px;"> القدرة *</label>
            <input type="text" value="' . $q->data['capacity'] . '" class="Capcity_Text" style="width:80px;">
            <label style="width: 50px;"> المنطقة *</label>
            <input type="text" value="' . $q->data['location'] . '" class="Location_Text" style="width:80px;">
            <span onclick="RmvEq_rows(this)" style="cursor: pointer;color: #0000FF;text-decoration: underline;">حذف</span>
            </div>
           ';
            }
        } else {
            $array['m'] = '
        <div style="display: inline-block;" class="Model">
            <label style="width: 50px;"> الموديل *</label>
            <input type="text" value="" class="Model_Text" style="width:80px;">
            <label style="width: 50px;"> القدرة *</label>
            <input type="text" value="" class="Capcity_Text" style="width:80px;">
            <label style="width: 50px;"> المنطقة *</label>
            <input type="text" value="" class="Location_Text" style="width:80px;">
            </div>
           ';
        }
        echo json_encode($array, JSON_FORCE_OBJECT);
    }

}