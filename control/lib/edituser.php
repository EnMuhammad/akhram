<?php
if (isset($_GET['id'])) {
    $s = new sessions();
    if ($s->check_session()) {
        $admin = 1;
        $my_id = $_SESSION['user_id'];
        $id = intval($_GET['id']);
        if ($id == $admin) {
            if ($my_id == $admin) {
                $allow = true;
                $name = false;
            } else {
                $allow = false;
                $name = false;
            }
        } else {
            $allow = true;
            $name = true;
        }
        $q = new Database_alters();
        $q->table = ADMIN_TABLE;
        $q->conditions = "WHERE `id`='$id'";
        $q->select_data();

        if ($q->check_ex()) {
            $q->show_data();
            $user = $q->data['username'];
        }
        if ($allow == true) {
            echo '
       <td><div class="cancel_img" onclick="Close_update()"></div></td>
      <td style="width:50%;">
       
      ' . (($name == true) ? "<input type=\"text\" value='$user'>" : "<div class='ADMIN_USER'>admin</div>") . '
      <div class="error_img erroruser"></div>
      </td>
      <td>
      <input type="password">
      <div class="error_img errorpass"></div>
      </td>
      <td>
      <div class="save_btn_01" onclick="SAVE_USER(this,' . $id . ')">حفظ</div>
      <div class="sec_img"></div>
      </td>
     
      
      
     
      ';
        } else {
            echo '<td colspan="4" style="color:red;font-size:14px;">ERROR EDIT</td>';
        }

    }
}

