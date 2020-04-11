<?php
$q = new Database_alters();
$q->table = CERT_TABLE;
$q->data = "*";
$q->conditions = "ORDER BY `id` DESC";
$q->select_data();

if ($q->check_ex()) {
    $n = 1;
    echo '<table class="Table_Home">';
    echo '<tr><th colspan="2">كافة الشهادات</th></tr>';
    echo '<tr>';
    while ($q->show_data()) {
        $photo = "../" . WEB_FILES . "/Certificates/" . $q->data['photo'];
        if (file_exists($photo)) {
            echo '
        <td style="width:50%;">
        <div style="font-size:14px;margin:5px 0px;font-weight:bold ;">' . $q->data['title_ar'] . '</div>
        <div style="font-size:14px;margin:5px 0px;font-weight:bold ;">' . $q->data['title_en'] . '</div>
        <img style="width:140px;height:120px;" src="' . $photo . '" title="' . $q->data['other_ar'] . '"><br>
        <input type="checkbox" value="' . $q->data['id'] . '">
        </td>
       ';

            if ($n >= 2) {
                $n = 1;
                echo '</tr><tr>';
            }
            $n++;
        }
    }
    echo '</tr>';
    echo '<tr><td colspan="2">
    <input  style="color:#C0C0C0;background-color: #F0F0F0;cursor: default;" type="button" value="حذف"></td></tr>';
    echo '</table>';
} else {

    echo '<div class="Empty_content">نعتذر لا يوجد شهادات</div>';


}
  