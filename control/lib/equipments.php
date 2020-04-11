<?php
$q = new Database_alters();
$q->table = EQUI_TABLE;
$q->data = "*";
$q->conditions = "ORDER BY `id` DESC";
$q->select_data();

if ($q->check_ex()) {
    echo '<table class="Table_Home">';
    echo '<tr><th>اختيار</th>
    <th>العنوان بالعربيه</th>
    <th>العنوان بالانجليزيه</th>
    
    <th>الصوره</th>
   <th>تاريخ الأضافه</th>
   <th>خيارات</th>
   
   </tr>';


    while ($q->show_data()) {
        $eq_id = $q->data['id'];
        $album = Albums::Get_eq_album('id', $eq_id);
        if (Albums::Get_eq_photo($album) == 0) {
            $img = BASE . '/control/images/empty.png';
            $title = 'لا يوجد صورة';
        } else {
            $img = BASE . '/' . WEB_FILES . '/photos/' . Albums::Get_eq_photo($album);
            $title = '';
        }
        echo '<tr>
        <td><input type="checkbox" value="' . $q->data['id'] . '"></td>
        <td>' . $q->data['title_ar'] . '</td>
        <td>' . $q->data['title_en'] . '</td>
     
         
          <td><img style="width:80px; vertical-align: middle;" src="' . $img . '" title="' . $title . '"></td>
           <td>' . $q->data['added_on'] . '</td>
          <td><span onclick="EditEqu(' . $eq_id . ')">تعديل </span> </td></tr>';


    }
    echo '<tr><td colspan="9"><input  style="color:#C0C0C0;background-color: #F0F0F0;cursor: default;" type="button" value="حذف"></td>';
    echo '</table>';
} else {

    echo '<div class="Empty_content">نعتذر لا يوجد معدات</div>';


}
  