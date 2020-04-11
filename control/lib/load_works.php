<?php
$q = new Database_alters();
$q->table = WORK_TABLE;
$q->data = "*";
$q->conditions = "ORDER BY `id` DESC";
$q->select_data();

if ($q->check_ex()) {
    echo '<table class="Table_Home">';
    echo '<tr>
   <th>اختيار</th>
   <th>أسم المشروع</th>
   <th>تاريخ العمل</th>
   <th>خاص بالشركه</th>
   <th>المنطقه</th>
   <th>البوم الصور</th>
   <th>الحاله</th>
   <th>خيارات</th>
   </tr>';
    while ($q->show_data()) {
        $country = Countryname($q->data['country']);
        $album = UploadPictures::Related_album($q->data['id']);
        echo '<tr>
          <td><input type="checkbox" value="' . $q->data['id'] . '"></td>
          <td>' . $q->data['title_ar'] . '<br>' . $q->data['title_en'] . '</td>
          <td>' . $q->data['done_on'] . '</td>
          <td>' . $q->data['related_ar'] . '<br>' . $q->data['related_en'] . '</td>
          <td>' . $country['ar'] . ' ' . (($q->data['city_ar'] != '') ? "<br>" . $q->data['city_ar'] : "") . '</td>
          <td><span>البوم ' . $album['title_ar'] . '</span></td>
          <td>' . (($q->data['pub'] == 0) ? "تم النشر" : "قيد الأنتظار") . '</td>
          <td><!--<span onclick="EditWork(' . $q->data['id'] . ')"> </span>--> </td>
          </tr>';
    }
    echo '<tr><td colspan="8"><input  style="color:#C0C0C0;background-color: #F0F0F0;cursor: default;" type="button" value="حذف"></td>';
    echo '</table>';
} else {

    echo '<div class="Empty_content"> نعتذر لا يوجد هناك أخبار مضافة</div>';


}
  