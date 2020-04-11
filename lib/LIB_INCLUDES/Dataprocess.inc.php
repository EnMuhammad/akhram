<?php
$s = new Sessions();
$style = new Style();
include $s->language();

if (functions::web_closed()) {
    include "closed/p1.php";
    exit();
}
if (isset($_GET['lang'])) {
    $s->lang = $_GET['lang'];
    switch ($s->lang) {
        case 'en':
        default:
            $s->Select_language();
            break;
        case'ar':
            $s->Select_language();
            break;
    }
    exit();
} else if (filter_has_var(INPUT_GET, 'news')) {
    if (isset($_GET['news'])) {
        $id = intval($_GET['news']);
        $q = new Database_alters();
        $q->table = NEWS_TABLE;
        $q->conditions = "WHERE `id`='$id'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();

            echo $q->data['content_' . $DL['lang']];
            echo '<div class="date_font">' . $q->data['added_on'] . '</div>';
            $count = $q->data['read_count'];
            $n_count = $count + 1;
            $q->data_in = "`read_count`='$n_count'";
            $q->update_data();
        }

    }
    exit();

} else if (filter_has_var(INPUT_GET, 'load_album')) {

    if (isset($_GET['albumid'])) {
        $album_id = intval($_GET['albumid']);
        $album = new Albums();
        $album->album_id = $album_id;
        if ($album->Album_Ex()) {

            $q = new Database_alters();
            $q->table = PHOTO_TABLE;
            $q->Data_type = "`id`,`image`,`added_on`";
            $q->conditions = "WHERE `album_id`='$album_id' ORDER BY `id`";
            $q->select_data();
            if ($q->check_ex()) {
                echo '<div class="Album_View">';
                if (isset($_GET['photo'])) {
                    $photo = intval($_GET['photo']);
                } else {
                    $photo = false;
                }

                echo '<div class="viewer" style="float:' . $DL['float'] . ';">

<img src="' . (($photo == false) ? $album->First_Photo() : $album->Get_Photo($photo)) . '" class="image_view" style="width:100%;height:100%">

    </div><div class="list"  style="float:' . $DL['float'] . ';">';
                $style->float = $DL['float'];
                $style->width = "178px";
                $style->height = "100px";
                $style->coustme_style = "";
                $style->on_click = "onclick='LoadPhoto(this)';";
                $count = 0;
                while ($q->show_data()) {
                    $image = WEB_FILES . '/photos/' . $q->data['image'];


                    if (file_exists($image)) {
                        $style->img = $image;

                        echo '<div class="image ' . (($photo == false) ? (($count == 0) ? "selected" : "") : (($q->data['id'] == $photo) ? "selected" : "")) . '">' . $style->Div_background() . '</div>';
                    }
                    ?>


                    <?php
                    $count++;
                }
                echo '</div></div>';

            }

        } else {

        }


    }

    exit();
} else if (filter_has_var(INPUT_GET, 'certiview')) {
    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $id = intval($_GET['id']);
            $q = new Database_alters();
            $q->table = CERT_TABLE;
            $q->conditions = "WHERE `id`='$id'";
            $q->select_data();
            if ($q->check_ex()) {
                $q->show_data();
                $dir = WEB_FILES . '/Certificates/';
                $photo = $q->data['photo'];
//            $certi =  ;


                if (file_exists($dir . $photo)) {

//                $s->img = $dir.$photo;

                    echo '<div class="viewer"><img src="' . $dir . $photo . '" width="20%" style="margin:10% auto 0 auto;display:block;">
<div style="margin:auto;color:#ffffff;width:70%;">' . $q->data['other_' . $DL['lang']] . '</div>

                </div>';
                } else {
                    echo '<div class="viewer">No</div>';
                }

            }
        }
    }


    exit();
} else if (filter_has_var(INPUT_GET, 'loadprojectcity')) {
    if (isset($_GET['country'])) {
        if (is_numeric($_GET['country'])) {
            $c = intval($_GET['country']);
            $q = new Database_alters();
            $q->table = WORK_TABLE;
            $q->Data_type = "DISTINCT `city_" . $DL['lang'] . "`";
            $q->conditions = "WHERE `country`='$c' AND `city_" . $DL['lang'] . "`<>''";
            $q->select_data();
            if ($q->check_ex()) {
                echo '<option value="0">' . $project_lang['SELECT'] . '</option>';
                while ($q->show_data()) {
                    echo '<option value="' . $q->data['city_' . $DL['lang']] . '">' . $q->data['city_' . $DL['lang']] . '</option>';
                }

            } else {
                echo 0;
            }
        }
    }
    exit();
} else if (filter_has_var(INPUT_POST, 'sendfeedback')) {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['text'])) {
        $name = htmlspecialchars(trim(strip_tags($_POST['name'])));
        $email = htmlspecialchars(trim(strip_tags($_POST['email'])));
        $text = htmlspecialchars(trim(strip_tags($_POST['text'])));
        if ($name == '' || $email == '' || $text == '') {

            echo 'ERROR_EMPTY';
            exit();

        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'EMAIL_ERROR';
            exit();

        } else {
            $q = new Database_alters();
            $q->table = FEEDBACK_TABLE;
            $q->data_in = "`title`,`name`,`email`,`country`,`content`,`added_on`,`read`";
            $q->data_value = "'','$name','$email','" . IpAddress() . "','$text','" . createTimeStamp() . "','1'";
            if ($q->fill_up_data()) {
                echo 'DONE';
            } else {
                echo 'ERROR';
            }
        }
    }

    exit();
}


