<?php
session_start();
include "../library/lib/LIB_INCLUDES/resoures.php";
include "../library/config/PHP_C.inc.php";
include "../library/lib/LIB_INCLUDES/constants.php";
include "lib/functions.php";
$s = new sessions();
if (!$s->check_session()) {

    if (isset($_POST['login'])) {

        if (isset($_POST['user']) && isset($_POST['pass'])) {
            $sql = new Login();
            $sql->user = htmlspecialchars(strip_tags(trim($_POST['user'])));
            $sql->password = htmlspecialchars(strip_tags(trim($_POST['pass'])));
            if ($sql->user == '' || $sql->password == '') {
                echo '2';
                exit();
            }
            if ($sql->Check_in_database()) {
                echo '0';
            } else {
                echo '1';
            }
        }
        exit();
    } else {
        include "login.php";
    }
} else {
    if (isset($_GET['ImageUpload'])) {
        if (isset($_FILES['ImageUpload'])) {
            $files = '';
            $x = 1225;
            for ($i = 0; isset($_FILES['ImageUpload']['name'][$i]); $i++) {
                $x++;
                $up = new UploadPictures();
                $up->filename = $_FILES['ImageUpload']['name'][$i];
                $files = $up->uploadImage($_FILES['ImageUpload']['tmp_name'][$i], $x);
                $q = new Database_alters();
                $q->table = SLIDES_TABLE;
                $q->select_data();
                if ($q->count_ex() <= 5) {
                    $q->data_in = "`image`";
                    $q->data_value = "'" . $files . "'";
                    if ($q->fill_up_data()) {
                        $upload = true;
                    } else {
                        $upload = false;
                    }
                    if ($upload == true) {
                        $max_upload = '1';
                    } else {
                        $max_upload = 'LIMIT_MAX';
                    }
                } else {
                    $max_upload = 'LIMIT_MAX';
                }


            }
            echo $max_upload;
        }
        exit();
    } else if (filter_has_var(INPUT_GET, 'album_temp_upload')) {
        if (isset($_FILES['ImageAlbumUpload'])) {
            $files = '';
            $x = 1225;
            for ($i = 0; isset($_FILES['ImageAlbumUpload']['name'][$i]); $i++) {
                $x++;
                $up = new UploadPictures();
                $up->filename = $_FILES['ImageAlbumUpload']['name'][$i];
                $files .= $up->uploadImage($_FILES['ImageAlbumUpload']['tmp_name'][$i], $x, 'temp') . ',';
            }
            echo $files;
            exit();
        }
    } else if (filter_has_var(INPUT_GET, 'section_temp_upload')) {
        if (isset($_FILES['section_image'])) {

            $x = 1225;
            $up = new UploadPictures();
            $up->filename = $_FILES['section_image']['name'];
            $files = $up->uploadImage($_FILES['section_image']['tmp_name'], $x, 'temp');
            echo $files;
            exit();
        }
    } else if (filter_has_var(INPUT_GET, 'equ_temp_upload')) {
        if (isset($_FILES['Equ_image'])) {
            $x = 1225;
            $up = new UploadPictures();
            $up->filename = $_FILES['Equ_image']['name'];
            $files = $up->uploadImage($_FILES['Equ_image']['tmp_name'], $x, 'temp');
            echo $files;
            exit();
        }
    } else if (filter_has_var(INPUT_GET, 'certi_temp_upload')) {
        if (isset($_FILES['c_image'])) {
            $x = 1225;
            $up = new UploadPictures();
            $up->filename = $_FILES['c_image']['name'];
            $files = $up->uploadImage($_FILES['c_image']['tmp_name'], $x, 'temp');
            echo $files;
            exit();
        }
    } else if (filter_has_var(INPUT_POST, 'CreateSec')) {
        if (isset($_POST['ar']) && isset($_POST ['en']) && isset($_POST['image'])) {
            $title_ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $image = htmlspecialchars(strip_tags(trim($_POST['image'])));
            $dir = '../' . WEB_FILES . '/sections';
            $temp = BASE . '/' . WEB_FILES . '/temp/' . $image;
            if (file_exists($dir)) {
                $new_name = $dir . '/' . $image;
            } else {
                mkdir($dir, 0755, TRUE);
                $new_name = $dir . '/' . $image;
            }
            copy($temp, $new_name);
            $q = new Database_alters();
            $q->table = EQ_SEC_TABLE;
            $q->data_in = "`title_ar`,`title_en`,`image`";
            $q->data_value = "'$title_ar','$title_en','$image'";
            $q->fill_up_data();

        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'logout')) {
        $login = new Login();
        $login->logout();

        exit();
    } else if (filter_has_var(INPUT_POST, 'createUser')) {
        if (isset($_POST['user']) && isset($_POST['pass'])) {
            $user = htmlspecialchars(strip_tags(trim($_POST['user'])));
            $pass = htmlspecialchars(strip_tags(trim($_POST['pass'])));
            if (Check_user($user)) {
                $q = new Database_alters();
                $q->table = ADMIN_TABLE;
                $q->data_in = "`username`,`password`,`last_seen`";
                $q->data_value = "'$user','" . MD5($pass) . "','0'";
                $q->fill_up_data();
            } else {
                echo 'DUB_USER';
            }
        }

        exit();
    } else if (filter_has_var(INPUT_GET, 'slides')) {
        include 'lib/slides.php';
        exit();
    } else if (filter_has_var(INPUT_GET, 'load_sections')) {
        include 'lib/load_section.php';
        exit();
    } else if (filter_has_var(INPUT_GET, 'load_services')) {
        include 'lib/load_serv.php';
        exit();
    } else if (filter_has_var(INPUT_GET, 'edit_sections')) {
        include 'lib/edit_section.php';
        exit();
    } else if (filter_has_var(INPUT_GET, 'edit_serv')) {
        include 'lib/serv_edit.php';
        exit();
    } else if (filter_has_var(INPUT_GET, 'loadpoints')) {
        include 'lib/load_points.php';
        exit();
    } else if (filter_has_var(INPUT_GET, 'edituser')) {
        include "lib/edituser.php";
        exit();

    } else if (filter_has_var(INPUT_POST, 'Update_user')) {
        if (isset($_POST['new_user']) && isset($_POST['new_pass']) && isset($_POST['uid'])) {

            $id = intval($_POST['uid']);
            $user = htmlspecialchars(strip_tags(trim($_POST['new_user'])));
            $pass = htmlspecialchars(strip_tags(trim($_POST['new_pass'])));
            if ($pass == '' OR $pass == NULL OR empty($pass)) {
                $update_pass = false;
            } else {
                $update_pass = true;
            }
            $admin = 1;
            $my_id = $_SESSION['user_id'];
            if ($id == $admin) {
                $update_name = false;
                if ($my_id == $admin) {
                    $allow = true;
                } else {
                    $allow = false;
                }
            } else {
                $update_name = true;
                $allow = true;
            }
            if ($allow == true) {
                if (Check_user($user, $id)) {
                    $q = new Database_alters();
                    $q->table = ADMIN_TABLE;
                    $q->conditions = "WHERE `id`='$id'";
                    $q->select_data();
                    if ($q->check_ex()) {
                        if ($user == '' OR $user == NULL OR empty($user)) {
                            $up_pro = false;
                        } else {
                            $up_pro = true;
                        }
                        if ($update_name == true && $update_pass == true) {
                            $q->data_in = "`username`='$user',`password`='" . MD5($pass) . "'";
                        } else if ($update_name == true && $update_pass == false) {
                            $q->data_in = "`username`='$user'";
                        } else if ($update_name == false && $update_pass == true) {
                            $q->data_in = "`password`='" . MD5($pass) . "'";
                        } else {
                            $up_pro = false;
                        }
                        if ($up_pro == true) {
                            if ($q->update_data()) {
                                if ($_SESSION['user_id'] == $id) {
                                    $save_s = new Login();
                                    $save_s->save_id = $_SESSION['user_id'];
                                    if ($update_name == true && $update_pass == true) {
                                        $save_s->save_user = $user;
                                        $save_s->save_pass = MD5($pass);
                                        $save_s->Save_data();
                                    } else if ($update_name == false && $update_pass == true) {
                                        $save_s->save_user = $_SESSION['user_admin'];
                                        $save_s->save_pass = MD5($pass);
                                        $save_s->Save_data();
                                    } else if ($update_name == true && $update_pass == false) {
                                        $save_s->save_user = $user;
                                        $save_s->save_pass = $_SESSION['pass_admin'];
                                        $save_s->Save_data();
                                    }
                                    echo 'UPDATE_S_U';
                                } else {
                                    echo 'UPDATE_U';
                                }
                            } else {
                                echo 'ERR_UPDATE';
                            }

                        } else {
                            echo 'ERROR';
                        }
                    }
                } else {
                    echo 'ERROR_USER';
                }
            }
        }


        exit();
    } else if (filter_has_var(INPUT_POST, 'deleteUser')) {
        if (isset($_POST['id'])) {

            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $array = array();
            if (is_numeric($id)) {
                $array[0] = $id;
            } else {
                $uid = explode(',', $id);
                foreach ($uid as $u) {
                    $array[] = $u;
                }
            }
            if (in_array(1, $array)) {
                echo 'Admin';
            } else {
                $d_id = join(',', $array);
                $q = new Database_alters();
                $q->table = ADMIN_TABLE;
                $q->conditions = "WHERE `id` IN ($d_id) AND `id`<>'1'";
                $q->select_data();
                if ($q->check_ex()) {
                    $q->delete_data();
                }
            }
        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'UpdateAlbum')) {
        if (isset($_POST['id']) && isset($_POST['ar_title']) && isset($_POST['en_title']) && isset($_POST['proj'])) {

            $title_ar = htmlspecialchars(strip_tags(trim($_POST['ar_title'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['en_title'])));
            $proj = htmlspecialchars(strip_tags(trim($_POST['proj'])));
            $id = intval($_POST['id']);
            $q = new Database_alters();
            $q->table = ALBUM_TABLE;
            $q->data_in = "`title_ar`='$title_ar',`title_en`='$title_en',`work_id`='$proj'";
            $q->conditions = "WHERE `id`='$id'";
            if ($q->update_data()) {
                echo 'Yes';
            } else {
                echo 'No';


            }

        }
        exit();


    } else if (filter_has_var(INPUT_POST, 'UpdateSection')) {
        if (isset($_POST['id']) && isset($_POST['ar']) && isset($_POST['en'])) {
            $title_ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['en'])));

            $id = intval($_POST['id']);
            $q = new Database_alters();
            $q->table = EQ_SEC_TABLE;
            $q->data_in = "`title_ar`='$title_ar',`title_en`='$title_en'";
            $q->conditions = "WHERE `id`='$id'";
            if ($q->update_data()) {
                echo 'Yes';
            } else {
                echo 'No';


            }
        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'DeleteSec')) {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $a = array();
            if (strpos($id, ',')) {
                $i = explode(',', $id);
                for ($x = 0; $x < sizeof($i); $x++) {
                    $a[$x] = $i[$x];
                }
            } else {
                $a[0] = intval($id);
            }

            $ids = join(',', $a);
            $q = new Database_alters();
            $q->table = EQUI_TABLE;
            $q->conditions = "WHERE `sec` IN ($ids)";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();
            }
            $q->table = EQ_SEC_TABLE;
            $q->conditions = "WHERE `id` IN ($ids)";
            $q->delete_data();


        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'DeleteSlide')) {
        if (isset($_POST['slide'])) {
            $id = intval($_POST['slide']);
            $q = new Database_alters();
            $q->table = SLIDES_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->delete_data();
        }
        exit();

    } else if (filter_has_var(INPUT_POST, 'SaveSlideUrl')) {
        if (isset($_POST['url']) && isset($_POST['id'])) {
            $url = htmlspecialchars(strip_tags(trim($_POST['url'])));
            $id = intval($_POST['id']);
            $q = new Database_alters();
            $q->table = SLIDES_TABLE;
            $q->data_in = "`url`='$url'";
            $q->conditions = "WHERE `id`='$id'";
            if ($q->update_data()) {
                echo 'Yes';
            } else {
                echo 'No';


            }

        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'News_create')) {
        if (isset($_POST['nar']) && isset($_POST['nen']) && isset($_POST['url']) && isset($_POST['car']) && isset($_POST['cen'])) {
            $title_ar = htmlspecialchars(strip_tags(trim($_POST['nar'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['nen'])));
            $url = htmlspecialchars(strip_tags(trim($_POST['url'])));
            $c_ar = htmlspecialchars(strip_tags(trim($_POST['car'])));
            $c_en = htmlspecialchars(strip_tags(trim($_POST['cen'])));
            $q = new Database_alters();
            $q->table = NEWS_TABLE;
            $q->data_in = "`title_ar`,`title_en`,`content_ar`,`content_en`,`url`,`read_count`,`added_on`";
            $q->data_value = "'$title_ar','$title_en','$c_ar','$c_en','$url','1','" . date("Y-m-d H:i:s") . "'";
            if ($q->fill_up_data()) {
                print(0);
            } else {
                print(1);

            }

        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'News_Update')) {
        if (isset($_POST['id']) && isset($_POST['nar']) && isset($_POST['nen']) && isset($_POST['url']) && isset($_POST['car']) && isset($_POST['cen'])) {
            $id = intval($_POST['id']);
            $title_ar = htmlspecialchars(strip_tags(trim($_POST['nar'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['nen'])));
            $url = htmlspecialchars(strip_tags(trim($_POST['url'])));
            $c_ar = htmlspecialchars(strip_tags(trim($_POST['car'])));
            $c_en = htmlspecialchars(strip_tags(trim($_POST['cen'])));
            $q = new Database_alters();
            $q->table = NEWS_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->data_in = "`title_ar`='$title_ar',`title_en`='$title_en',`content_ar`='$c_ar',`content_en`='$c_en',`url`='$url'";
                if ($q->update_data()) {
                    print(0);
                } else {
                    print($id);

                }
            }

        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'DeleteNews')) {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $a = array();
            if (strpos($id, ',')) {
                $i = explode(',', $id);
                for ($x = 0; $x < sizeof($i); $x++) {
                    $a[$x] = $i[$x];
                }
            } else {
                $a[0] = intval($id);
            }

            $ids = join(',', $a);
            $q = new Database_alters();
            $q->table = NEWS_TABLE;
            $q->conditions = "WHERE `id` IN ($ids)";
            $q->delete_data();
        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'DeleteAlbums')) {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $a = array();
            if (strpos($id, ',')) {
                $i = explode(',', $id);
                for ($x = 0; $x < sizeof($i); $x++) {
                    $a[$x] = $i[$x];
                }
            } else {
                $a[0] = intval($id);
            }

            $ids = join(',', $a);
            $q = new Database_alters();
            $q->table = PHOTO_TABLE;
            $q->conditions = "WHERE `album_id` IN ($ids)";
            if ($q->delete_data()) {
                $q->table = ALBUM_TABLE;
                $q->conditions = "WHERE `id` IN ($ids)";
                $q->delete_data();


            }
        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'DeleteEqu')) {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $a = array();
            if (strpos($id, ',')) {
                $i = explode(',', $id);
                for ($x = 0; $x < sizeof($i); $x++) {
                    $a[$x] = $i[$x];
                }
            } else {
                $a[0] = intval($id);
            }

            $ids = join(',', $a);
            $q = new Database_alters();
            $q->table = ALBUM_TABLE;
            $q->conditions = "WHERE `equ_id` IN ($ids)";
            $q->select_data();
            if ($q->check_ex()) {
                while ($q->show_data()) {
                    $albumid = $q->data['id'];
                    $q->table = PHOTO_TABLE;
                    $q->conditions = "WHERE `album_id` = '$albumid'";
                    $q->delete_data();

                }
            }
            $q->table = ALBUM_TABLE;
            $q->conditions = "WHERE `equ_id` IN ($ids)";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();
            }
            $q->table = EQU_INFO_TABLE;
            $q->conditions = "WHERE `equ_id` IN ($ids)";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();
            }
            $q->table = EQUI_TABLE;
            $q->conditions = "WHERE `id` IN ($ids)";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();
            }

        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'Deletecerti')) {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $q = new Database_alters();
            $q->table = CERT_TABLE;
            $q->conditions = "WHERE `id` IN ($id)";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();

            }


        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'contactus')) {

        if (isset($_POST['add_ar'])
            && isset($_POST['add_en'])
            && isset($_POST['face'])
            && isset($_POST['twitter'])
            && isset($_POST['google'])
            && isset($_POST['youtube'])
            && isset($_POST['inst'])
            && isset($_POST['email'])
            && isset($_POST['phone'])
            && isset($_POST['fax'])
            && isset($_POST['mobile'])


        ) {

            $addar = htmlspecialchars(strip_tags(trim($_POST['add_ar'])));
            $adden = htmlspecialchars(strip_tags(trim($_POST['add_en'])));
            $face = htmlspecialchars(strip_tags(trim($_POST['face'])));
            $tw = htmlspecialchars(strip_tags(trim($_POST['twitter'])));
            $google = htmlspecialchars(strip_tags(trim($_POST['google'])));
            $youtube = htmlspecialchars(strip_tags(trim($_POST['youtube'])));
            $inst = htmlspecialchars(strip_tags(trim($_POST['inst'])));
            $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
            $fax = htmlspecialchars(strip_tags(trim($_POST['fax'])));
            echo $mobile = htmlspecialchars(strip_tags(trim($_POST['mobile'])));
            $q = new Database_alters();
            $q->table = CONTACT_TABLE;
            $q->conditions = "WHERE `id`='1'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->data_in = "`add_ar`='$addar',`add_en`='$adden',`facebook`='$face',`twitter`='$tw',`google`='$google',`youtube`='$youtube',`instg`='$inst',
        `email`='$email',`phone`='$phone',`fax`='$fax',`mobile`='$mobile'
        ";
                $q->update_data();
            } else {
                $q->data_in = "`add_ar`,`add_en`,`facebook`,`twitter`,`google`,`youtube`,`instg`,
        `email`,`phone`,`fax`,`mobile`";
                $q->data_value = "'$addar','$adden','$face','$tw','$google','$youtube','$inst','$email','$phone','$fax','$mobile'";
                $q->fill_up_data();
            }


        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'CreateProject')) {
        if (
            isset($_POST['title_ar']) &&
            isset($_POST['title_en']) &&
            isset($_POST['done']) &&
            isset($_POST['rel_ar']) &&
            isset($_POST['rel_en']) &&
            isset($_POST['country']) &&
            isset($_POST['city_ar']) &&
            isset($_POST['city_en']) &&
            isset($_POST['co_ar']) &&
            isset($_POST['co_en']) &&
            isset($_POST['image_type']) &&
            isset($_POST['file']) &&
            isset($_POST['pub'])
        ) {

            $title_ar = htmlspecialchars(strip_tags(trim($_POST['title_ar'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['title_en'])));
            $done = htmlspecialchars(strip_tags(trim($_POST['done'])));
            $rel_ar = htmlspecialchars(strip_tags(trim($_POST['rel_ar'])));
            $rel_en = htmlspecialchars(strip_tags(trim($_POST['rel_en'])));
            $country = htmlspecialchars(strip_tags(trim($_POST['country'])));
            $city_ar = htmlspecialchars(strip_tags(trim($_POST['city_ar'])));
            $city_en = htmlspecialchars(strip_tags(trim($_POST['city_en'])));
            $co_ar = htmlspecialchars(strip_tags(trim($_POST['co_ar'])));
            $co_en = htmlspecialchars(strip_tags(trim($_POST['co_en'])));
            $image_type = htmlspecialchars(strip_tags(trim($_POST['image_type'])));
            $files = htmlspecialchars(strip_tags(trim($_POST['file'])));
            $pub = intval($_POST['pub']);
            $q = new Database_alters();
            $q->table = WORK_TABLE;

            $q->data_in = "`title_ar`,`title_en`,`done_on`,`related_ar`,`related_en`,`country`,`city_ar`,`city_en`,`content_ar`,`content_en`,`added_on`,`pub`";
            $q->data_value = "'$title_ar','$title_en','$done','$rel_ar','$rel_en','$country','$city_ar','$city_en','$co_ar','$co_en','" . createTimeStamp() . "','$pub'";
            if ($q->fill_up_data()) {
                $q->Data_type = "`id`";
                $q->conditions = "ORDER BY `id` DESC";
                $q->select_data();
                $q->show_data();
                $work_id = $q->data ['id'];
                $upload = new UploadPictures();
                if ($image_type == 'upload') {
                    $upload->title_ar = $title_ar;
                    $upload->title_en = $title_en;
                    $upload->work_id = $work_id;
                    $upload->album_id = $upload->CreateAlbum();
                    $upload->data = $files;
                    $upload->dir = '../' . WEB_FILES . '/photos';
                    $upload->Fill_album();
                    DeleteTempPhoto();
                } else if ($image_type == 'album') {
                    $upload->album_id = $files;
                    $upload->work_id = $work_id;
                    $upload->UpdateAlbumWork();
                }

            }
        } else {
            echo 'No';
        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'CreateEqu')) {


        if (
            isset($_POST['ar']) &&
            isset($_POST['en']) &&
            isset($_POST['files']) &&
            isset($_POST['sec']) &&
            isset($_POST['co_ar']) &&
            isset($_POST['co_en']) &&
            isset($_POST['Rows'])

        ) {

            $title_ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $files = htmlspecialchars(strip_tags(trim($_POST['files'])));
            $sec = htmlspecialchars(strip_tags(trim($_POST['sec'])));
            $co_ar = htmlspecialchars(strip_tags(trim($_POST['co_ar'])));
            $co_en = htmlspecialchars(strip_tags(trim($_POST['co_en'])));

            $q = new Database_alters();
            $q->table = EQUI_TABLE;
            $q->data_in = "`title_ar`,`title_en`,`co_ar`,`co_en`,`sec`,`added_on`";
            $q->data_value = "'$title_ar','$title_en','$co_ar','$co_en','$sec','" . createTimeStamp() . "'";
            if ($q->fill_up_data()) {
                $q->Data_type = "`id`";
                $q->conditions = "ORDER BY `id` DESC";
                $q->select_data();
                $q->show_data();
                $eq_id = $q->data ['id'];
                if (!empty($_POST['Rows'])) {
                    $rows = json_decode($_POST['Rows'], true);
                    $q->table = EQU_INFO_TABLE;
                    foreach ($rows as $row => $val) {
                        if ($val['model'] != '') {
                            $model = htmlspecialchars(strip_tags(trim($val['model'])));
                            $cap = htmlspecialchars(strip_tags(trim($val['capcity'])));
                            $location = htmlspecialchars(strip_tags(trim($val['location'])));
                            $q->data_in = "`equ_id`,`model_power`,`capacity`,`location`";
                            $q->data_value = "'$eq_id','$model','$cap','$location'";
                            $q->fill_up_data();
                        }
                    }
                }
                $upload = new UploadPictures();
                $upload->title_ar = $title_ar;
                $upload->title_en = $title_en;
                $upload->work_id = $eq_id;
                $upload->album_id = $upload->CreateAlbum("equ_id");
                if ($files != '') {
                    $upload->data = $files;
                    $upload->dir = '../' . WEB_FILES . '/photos';
                    $upload->Fill_album();
                    DeleteTempPhoto();
                }
            }
        } else {
            echo 'No';
        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'UpdateEqu')) {

        if (
            isset($_POST['id']) &&
            isset($_POST['ar']) &&
            isset($_POST['en']) &&
            isset($_POST['files']) &&
            isset($_POST['sec']) &&
            isset($_POST['co_ar']) &&
            isset($_POST['co_en']) &&
            isset($_POST['Rows'])

        ) {

            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $title_ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $title_en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $files = htmlspecialchars(strip_tags(trim($_POST['files'])));
            $sec = htmlspecialchars(strip_tags(trim($_POST['sec'])));
            $co_ar = htmlspecialchars(strip_tags(trim($_POST['co_ar'])));
            $co_en = htmlspecialchars(strip_tags(trim($_POST['co_en'])));;
            $q = new Database_alters();
            $q->table = EQUI_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->data_in = "`title_ar`='$title_ar',`title_en`='$title_en',`co_ar`='$co_ar',
  `co_en`='$co_en',`sec`='$sec'";

                if ($q->update_data()) {
                    if (!empty($_POST['Rows'])) {

                        $rows = json_decode($_POST['Rows'], true);
                        $q->table = EQU_INFO_TABLE;
                        $q->conditions = "WHERE `equ_id`='$id'";
                        $q->select_data();
                        if ($q->check_ex()) {
                            $q->delete_data();
                            foreach ($rows as $row => $val) {
                                if ($val['model'] != '') {
                                    $model = htmlspecialchars(strip_tags(trim($val['model'])));
                                    $cap = htmlspecialchars(strip_tags(trim($val['capcity'])));
                                    $location = htmlspecialchars(strip_tags(trim($val['location'])));
                                    $q->data_in = "`equ_id`,`model_power`,`capacity`,`location`";
                                    $q->data_value = "'$id','$model','$cap','$location'";
                                    $q->fill_up_data();
                                }
                            }
                        } else {
                            echo 'Here';
                            foreach ($rows as $row => $val) {
                                if ($val['model'] != '' && $val['capcity'] != '' && $val['location'] != '') {
                                    $model = htmlspecialchars(strip_tags(trim($val['model'])));
                                    $cap = htmlspecialchars(strip_tags(trim($val['capcity'])));
                                    $location = htmlspecialchars(strip_tags(trim($val['location'])));
                                    $q->data_in = "`equ_id`,`model_power`,`capacity`,`location`";
                                    $q->data_value = "'$id','$model','$cap','$location'";
                                    $q->fill_up_data();
                                }
                            }
                        }
                    }
                    $q->table = ALBUM_TABLE;
                    $q->conditions = "WHERE `equ_id`='$id'";
                    $upload = new UploadPictures();
                    $upload->work_id = $id;
                    $q->select_data();
                    if ($q->check_ex()) {
                        $q->show_data();

                        if ($files != '') {
                            $upload->album_id = $q->data['id'];
                            $upload->data = $files;
                            $upload->dir = '../' . WEB_FILES . '/photos';
                            $upload->Update_album();
                            DeleteTempPhoto();
                        }
                    } else {

                        $upload->title_ar = $title_ar;
                        $upload->title_en = $title_en;

                        $upload->album_id = $upload->CreateAlbum("equ_id");
                        if ($files != '') {
                            $upload->data = $files;
                            $upload->dir = '../' . WEB_FILES . '/photos';
                            $upload->Fill_album();
                            DeleteTempPhoto();
                        }
                    }

                }
            }


        } else {
            echo 'No';
        }

        exit();
    } else if (filter_has_var(INPUT_POST, 'UpdateWebGen')) {
        if (isset($_POST['web_ar']) &&
            isset ($_POST['web_en']) &&
            isset ($_POST['owner']) &&
            isset ($_POST['bf_ar']) &&
            isset ($_POST['bf_en']) &&
            isset ($_POST['close'])

        ) {

            $t_ar = htmlspecialchars(strip_tags(trim($_POST['web_ar'])));
            $t_en = htmlspecialchars(strip_tags(trim($_POST['web_en'])));
            $owner = htmlspecialchars(strip_tags(trim($_POST['owner'])));
            $bf_ar = htmlspecialchars(strip_tags(trim($_POST['bf_ar'])));
            $bf_en = htmlspecialchars(strip_tags(trim($_POST['bf_en'])));
            $close = htmlspecialchars(strip_tags(trim(intval($_POST['close']))));
            $q = new Database_alters();
            $q->table = SETTING_TABLE;
            $q->select_data();
            if ($q->check_ex()) {
                ///// - UPDATE -///
                $q->data_in = "`web_title_ar`='$t_ar',`web_title_en`='$t_en',`owner`='$owner',`web_key_en`='$bf_en',`web_key_ar`='$bf_ar',`web_close`='$close'";
                if ($q->update_data()) {
                    echo 0;

                } else {
                    echo 1;
                }
            } else {


                //// INSERT ////
                $q->data_in = "`web_title_ar`,`web_title_en`,`owner`,`web_key_ar`,`web_key_en`,`web_close`";
                $q->data_value = "'$t_ar','$t_en','$owner','$bf_ar','$bf_en','$close'";
                if ($q->fill_up_data()) {
                    echo 0;

                } else {
                    echo 1;
                }


            }


        }


        exit();
    } else if (filter_has_var(INPUT_POST, 'createalbum')) {
        if (isset($_POST['ar']) && isset($_POST['en']) && isset($_POST['pro']) && isset($_POST['files'])) {

            $ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $pro = htmlspecialchars(strip_tags(trim($_POST['pro'])));
            $files = htmlspecialchars(strip_tags(trim($_POST['files'])));

            if ($ar != '' && $en != '' && $pro != '' && $files != '') {
                $upload = new UploadPictures();
                $upload->title_ar = $ar;
                $upload->title_en = $en;
                $upload->work_id = $pro;
                $upload->album_id = $upload->CreateAlbum();
                $upload->data = $files;
                $upload->dir = '../' . WEB_FILES . '/photos';
                $upload->Fill_album();
                DeleteTempPhoto();

            }
        }

        exit();
    } else if (filter_has_var(INPUT_GET, 'DirectAlbumUpload')) {

        if (isset($_FILES['ImageAlbumUpload']) && isset($_POST['album_id'])) {
            $album = intval($_POST['album_id']);
            $files = '';
            $x = 1225;
            $up = new UploadPictures();
            $q = new Database_alters();
            $q->table = PHOTO_TABLE;
            $q->conditions = "WHERE `album_id`='$album'";
            $q->select_data();
            if ($q->check_ex()) {
                $array = array();
                $array['photo_name'] = '';
                for ($i = 0; isset($_FILES['ImageAlbumUpload']['name'][$i]); $i++) {
                    $x++;

                    $up->filename = $_FILES['ImageAlbumUpload']['name'][$i];
                    $array['photo_name'] .= $up->uploadImage($_FILES['ImageAlbumUpload']['tmp_name'][$i], $x, 'photos');
                    $q->data_in = "`album_id`,`image`,`added_on`";
                    $q->data_value = "'$album','" . $array['photo_name'] . "','" . createTimeStamp() . "'";
                    $q->fill_up_data();

                }
                echo $album;
            }
        } else {
            echo 'Non';
        }


        exit();
    } else if (filter_has_var(INPUT_POST, 'CreateServ')) {
        if (isset($_POST['ar']) && isset($_POST['en'])) {
            $ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $q = new Database_alters();
            $q->table = SERVICES_TABLE;
            $q->data_in = "`title_ar`,`title_en`";
            $q->data_value = "'$ar','$en'";
            if ($q->fill_up_data()) {
                echo 0;
            }

        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'UpdateServ')) {
        if (isset($_POST['ar']) && isset($_POST['en']) && isset($_POST['id'])) {
            $ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $id = htmlspecialchars(strip_tags(trim(intval($_POST['id']))));
            $q = new Database_alters();
            $q->table = SERVICES_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->data_in = "`title_ar`='$ar',`title_en`='$en'";
                if ($q->update_data()) {
                    echo 0;
                }
            }

        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'DeleteServ')) {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $q = new Database_alters();

            $q->table = SERV_POINT_TABLE;
            $q->conditions = "WHERE `serv_id` IN ($id)";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();


            }
            $q->table = SERVICES_TABLE;
            $q->conditions = "WHERE `id` IN ($id)";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();
            }
        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'AddPoint')) {
        if (isset($_POST['ar']) && isset($_POST['en']) && isset($_POST['id'])) {
            $ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $sid = htmlspecialchars(strip_tags(intval($_POST['id'])));

            $q = new Database_alters();
            $q->table = SERV_POINT_TABLE;


            $q->data_in = "`title_ar`,`title_en`,`serv_id`";
            $q->data_value = "'$ar','$en','$sid'";
            if ($q->fill_up_data()) {
                echo 0;
            }
        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'DeletePoint')) {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars(strip_tags(intval($_POST['id'])));
            $q = new Database_alters();
            $q->table = SERV_POINT_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();
            }
        }
        exit();
    } else if (filter_has_var(INPUT_POST, 'create_branch')) {
        if (isset($_POST['ar']) &&
            isset($_POST['en']) &&
            isset($_POST['city']) &&
            isset($_POST['add_ar']) &&
            isset($_POST['add_en'])
        ) {
            $ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $add_ar = htmlspecialchars(strip_tags(trim($_POST['add_ar'])));
            $add_en = htmlspecialchars(strip_tags(trim($_POST['add_en'])));
            $city = htmlspecialchars(strip_tags(intval($_POST['city'])));
            $q = new Database_alters();
            $q->table = BRAN_TABLE;
            $q->data_in = "`title_ar`,`title_en`,`address_ar`,`address_en`,`city`,`added_on`";
            $q->data_value = "'$ar','$en','$add_ar','$add_en','$city','" . createTimeStamp() . "'";
            $q->fill_up_data();
        }


        exit();
    } else if (filter_has_var(INPUT_POST, 'edit_branch')) {
        if (
            isset($_POST['id']) &&
            isset($_POST['ar']) &&
            isset($_POST['en']) &&
            isset($_POST['city']) &&
            isset($_POST['add_ar']) &&
            isset($_POST['add_en'])
        ) {
            $ar = htmlspecialchars(strip_tags(trim($_POST['ar'])));
            $en = htmlspecialchars(strip_tags(trim($_POST['en'])));
            $add_ar = htmlspecialchars(strip_tags(trim($_POST['add_ar'])));
            $add_en = htmlspecialchars(strip_tags(trim($_POST['add_en'])));
            $city = htmlspecialchars(strip_tags(intval($_POST['city'])));
            $id = htmlspecialchars(strip_tags(intval($_POST['id'])));
            $q = new Database_alters();
            $q->table = BRAN_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->data_in = "`title_ar`='$ar',`title_en`='$en',`address_ar`='$add_ar',`address_en`='$add_en',`city`='$city'";
                $q->update_data();
            }


        }


        exit();
    } else if (filter_has_var(INPUT_POST, 'delete_branch')) {
        if (isset($_POST['id'])
        ) {
            $id = htmlspecialchars(strip_tags(intval($_POST['id'])));
            $q = new Database_alters();
            $q->table = BRAN_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->delete_data();
            }


        }


        exit();
    } else if (filter_has_var(INPUT_POST, 'add_certi')) {
        if (isset($_POST['photo']) && isset($_POST['title_ar']) && isset($_POST['title_en']) && isset($_POST['other_ar'])
            && isset($_POST['other_en'])

        ) {
            $photo = htmlspecialchars(strip_tags(trim($_POST['photo'])));
            if ($photo != '') {
                $dir = "../" . WEB_FILES . "/temp/";
                $ex = $dir . $photo;
                $new_dir = "../" . WEB_FILES . "/Certificates";

                if (file_exists($ex)) {
                    if (file_exists($new_dir)) {
                        $new_name = $new_dir . '/' . $photo;
                    } else {
                        mkdir($new_dir, 0755, TRUE);
                        $new_name = $new_dir . '/' . $photo;
                    }
                    copy($ex, $new_name);
                    $title_ar = htmlspecialchars(strip_tags(trim($_POST['title_ar'])));
                    $title_en = htmlspecialchars(strip_tags(trim($_POST['title_en'])));
                    $other_ar = htmlspecialchars(strip_tags(trim($_POST['other_ar'])));
                    $other_en = htmlspecialchars(strip_tags(trim($_POST['other_en'])));
                    $q = new Database_alters();
                    $q->table = CERT_TABLE;

                    $q->data_in = "`title_ar`,`title_en`,`photo`,`other_ar`,`other_en`,`added_on`";
                    $q->data_value = "'$title_ar','$title_en','$photo','$other_ar','$other_en','" . createTimeStamp() . "'";
                    $q->fill_up_data();
                    DeleteTempPhoto();

                } else {
                    echo 'NULL';
                }

            }


        }


        exit();
    } else if (filter_has_var(INPUT_GET, 'loadnews')) {
        include "lib/news_load.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'load_branch')) {
        include "lib/load_branch.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'branchdata')) {
        include "lib/load_Edit_branch.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'getnews')) {
        include "lib/news_get.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'equ_get')) {
        include "lib/eq_get.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'albums')) {
        include "lib/Editalbums.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'equipments')) {
        include "lib/equipments.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'certificates')) {
        include "lib/certificates.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'photos')) {
        include "lib/album_photo.php";


        exit();
    } else if (filter_has_var(INPUT_GET, 'loadalbums')) {
        include "lib/load_albums.php";

        exit();
    } else if (filter_has_var(INPUT_GET, 'users')) {
        include "lib/users.php";

        exit();
    } else if (filter_has_var(INPUT_GET, 'load_works')) {

        include "lib/load_works.php";
        exit();
    }
    include "lib/admin_index.inc.php";

}







