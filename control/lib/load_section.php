<?php
$q = new Database_alters();
$q->table = EQ_SEC_TABLE;
$q->data = "*";
$q->conditions = "ORDER BY `id` DESC";
$q->select_data();

if ($q->check_ex()) {
    echo '<table class="Table_Home">';
    echo '<tr><th>اختيار</th><th>العنوان بالعربيه</th><th>العنوان بالانجليزيه</th><th>خيارات</th>
   
   </tr>';
    while ($q->show_data()) {
        echo '<tr class="' . $q->data['id'] . '">
        <td><input type="checkbox" value="' . $q->data['id'] . '"></td>
        <td>' . $q->data['title_ar'] . '</td>
        <td>' . $q->data['title_en'] . '</td>
        
          
          <td><span onclick="editSection(this)">تعديل </span> </td></tr>';


    }
    echo '<tr><td colspan="6"><input  style="color:#C0C0C0;background-color: #F0F0F0;cursor: default;" type="button" value="حذف"></td>';
    echo '</table>';
} else {

    echo '';


}
  