<?php
$q = new Database_alters();
$q->table = NEWS_TABLE;
$q->data = "*";
$q->conditions = "ORDER BY `id` DESC";
$q->select_data();

if ($q->check_ex()) {
    echo '<table class="Table_Home">';
    echo '<tr><th>اختيار</th><th>العنوان بالعربيه</th><th>العنوان بالانجليزيه</th>
   <th>تاريخ الأضافه</th>
   <th>عدد الضغطات</th><th>خيارات</th>
   
   </tr>';


    while ($q->show_data()) {
        echo '<tr><td><input type="checkbox" value="' . $q->data['id'] . '"></td><td>' . $q->data['title_ar'] . '</td><td>' . $q->data['title_en'] . '</td>
          <td>' . $q->data['added_on'] . '</td>
          <td>' . $q->data['read_count'] . '</td><td><span onclick="EditNews(' . $q->data['id'] . ')">مشاهدة وتعديل </span> </td></tr>';


    }
    echo '<tr><td colspan="6"><input  style="color:#C0C0C0;background-color: #F0F0F0;cursor: default;" type="button" value="حذف"></td>';
    echo '</table>';
} else {

    echo '<div class="Empty_content"> نعتذر لا يوجد هناك أخبار مضافة</div>';


}
  