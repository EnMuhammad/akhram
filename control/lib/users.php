<?php
$q = new Database_alters();
$q->table = ADMIN_TABLE;
$q->data = "*";
$q->conditions = "ORDER BY `id` DESC";
$q->select_data();

if ($q->check_ex()) {
    if ($s->check_session()) {
        $my_id = $_SESSION['user_id'];
        if ($_SESSION['user_id'] == 1) {
            $allow = true;

        } else {
            $allow = false;

        }
    }
    echo '<table class="Table_Home">';
    echo '<tr>
   ' . (($allow == true) ? "<th>أختيار</th>" : "") . ' 
    <th>أسم المستخدم</th>
    <th>أخر دخول</th> 
   <th>خيارات</th>
   
   </tr>';


    while ($q->show_data()) {
        $id = $q->data['id'];
        if ($q->data['last_seen'] == 0) {
            $t_last = "لم يسجل دخول";
        } else {
            $s->time = $q->data['last_seen'];
            $t_last = $s->G_Time();
        }

        echo '<tr>
        
       ' . (($allow == true) ? '<td>
       ' . (($q->data['id'] != 1) ? '<input type="checkbox"  value="' . $q->data['id'] . '">' : '<input type="checkbox" disabled="disabled">') . '</td>' : '') . ' 
        <td>' . $q->data['username'] . '</td>
        <td> ' . $t_last . '</td>
      
          <td>' . (($allow == true) ? " <span onclick='UpdateUser(" . $q->data['id'] . ",this)'>تعديل</span> " : "") . ' 
          ' . (($q->data['id'] == $my_id && $my_id != 1) ? "<span onclick='UpdateUser(" . $q->data['id'] . ",this)'>تعديل</span>" : "") . '
          ' . (($_SESSION['user_id'] == 1 && $q->data['id'] != 1) ? "<span>حذف</span>" : "") . '
          </td></tr>';
    }
    echo '
    ' . (($allow == true) ? '<td><tr><td colspan="4">
    <input  style="color:#C0C0C0;background-color: #F0F0F0;cursor: default;" type="button" value="حذف"></td></td>' : '') . '
    ';
    echo '</table>';
} else {

    //echo '<div class="Empty_content">نعتذر لا يوجد مستخدمين</div>';


}
  