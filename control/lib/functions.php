<?php
function Countryname($countryid)
{
    $q = new Database_alters();
    $q->table = COUNTRY_TABLE;
    $q->Data_type = "`id`,`ar`";
    $q->conditions = "WHERE `id`='$countryid'";
    $q->select_data();
    $q->show_data();
    return $q->data;
}

function createTimeStamp()
{
    return date("Y-m-d H:i:s");

}

function DeleteTempPhoto()
{
    $files = glob('../' . WEB_FILES . '/temp/*');
    foreach ($files as $file) {
        if (is_file($file))
            unlink($file);
    }

}

class sessions
{
    var $session;
    var $time;
    var $UserLocalTime = '0';
    var $show_min = true;

    function check_session()
    {
        if (isset($_SESSION['user_admin'])) {
            $this->session = $_SESSION['user_admin'];
            return true;
        } else {
            return false;
        }
    }

    function G_Time()
    {


        date_default_timezone_set('GMT');

        $time = $this->time;
        $tody = date('Y/m/d');
        if ($this->show_min == true) {
            $hour = "h:i:s";
        } else {
            $hour = "h:i a";
        }
        if (date('Y/m/d', $time) == $tody) {

            return " اليوم " . date("$hour", $time);
        } else {

            return date("l Y/m/d $hour", $time);
        }
        return false;
    }
}

Class UploadPictures
{
    var $filename = '';
    var $name;
    var $dir;
    var $title_ar;
    var $title_en;
    var $data;
    var $work_id;
    var $album_id;

    public static function Related_album($workid)
    {
        $q = new Database_alters();
        $q->table = ALBUM_TABLE;
        $q->Data_type = "`id`,`title_ar`,`title_en`";
        $q->conditions = "WHERE `work_id`='$workid'";
        $q->select_data();
        $q->show_data();
        return $q->data;

    }

    function get_mime($file)
    {
        if (function_exists("finfo_file")) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file);
            finfo_close($finfo);
            return $mime;
        } else if (function_exists("mime_content_type")) {
            return mime_content_type($file);
        } else if (!stristr(ini_get("disable_functions"), "shell_exec")) {
            $file = escapeshellarg($file);
            $mime = shell_exec("file -bi " . $file);
            return $mime;
        } else {
            return false;
        }
    }

    function Fill_album()
    {
        $a = array();
        if (strpos($this->data, ',')) {
            $d = explode(',', $this->data);
            for ($i = 0; $i < sizeof($d); $i++) {
                $a[$i] = $d[$i];
            }
        } else {
            $a[0] = $this->data;
        }
        $sec = false;
        $q = new Database_alters();
        $q->table = PHOTO_TABLE;
        foreach ($a as $file) {
            if ($file != '') {
                $temp = '../' . WEB_FILES . '/temp';
                $photo = $temp . '/' . $file;
                if (is_readable($photo)) {
                    if (!file_exists($this->dir)) {
                        mkdir($this->dir, 0755, TRUE);
                    }
                    if (copy($photo, $this->dir . '/' . $file)) {
                        $q->data_in = "`album_id`,`image`,`added_on`";
                        $q->data_value = "'" . $this->album_id . "','$file','" . createTimeStamp() . "'";
                        $q->fill_up_data();
                    }
                }
            }
        }
    }

    function Update_album()
    {

        $a = array();
        if (strpos($this->data, ',')) {
            $d = explode(',', $this->data);
            for ($i = 0; $i < sizeof($d); $i++) {
                $a[$i] = $d[$i];
            }
        } else {
            $a[0] = $this->data;
        }
        $sec = false;
        $q = new Database_alters();
        $q->table = PHOTO_TABLE;
        foreach ($a as $file) {
            if ($file != '') {
                $temp = '../' . WEB_FILES . '/temp';
                $photo = $temp . '/' . $file;
                if (is_readable($photo)) {
                    if (!file_exists($this->dir)) {
                        mkdir($this->dir, 0755, TRUE);
                    }
                    if (copy($photo, $this->dir . '/' . $file)) {
                        $q->conditions = "WHERE `album_id`='" . $this->album_id . "'";
                        $q->select_data();
                        if ($q->check_ex()) {
                            $q->data_in = "`image`='$file'";
                            $q->update_data();
                        } else {
                            $q->data_in = "`album_id`,`image`,`added_on`";
                            $q->data_value = "'" . $this->album_id . "','$file','" . createTimeStamp() . "'";
                            $q->fill_up_data();
                        }

                    }
                }
            }
        }
    }

    function CreateAlbum($type = false)
    {
        $q = new Database_alters();
        $q->table = ALBUM_TABLE;
        if ($type != false) {
            $sql = "`$type`";
        } else {
            $sql = "`work_id`";
        }
        $q->data_in = "`title_ar`,`title_en`,$sql,`added_on`";
        $q->data_value = "'" . $this->title_ar . "','" . $this->title_en . "','" . $this->work_id . "','" . createTimeStamp() . "'";
        if ($q->fill_up_data()) {
            $q->Data_type = "`id`";
            $q->conditions = "ORDER BY `id` DESC";
            $q->select_data();
            $q->show_data();
            return $q->data['id'];
        }
    }

    function UpdateAlbumWork()
    {
        $q = new Database_alters();
        $q->table = ALBUM_TABLE;
        $q->conditions = "WHERE `id`='" . $this->album_id . "'";
        $q->data_in = "`work_id`='" . $this->work_id . "'";
        $q->update_data();

    }

    function uploadImage($fileTemp, $num = 0, $dir = false)
    {
        $this->filename = htmlspecialchars(stripslashes($this->filename));
        $extension = $this->getExtension($this->filename);
        $extension = strtolower($extension);
        $fileOutputName = $num . '-' . time();
        $new = $fileOutputName . "." . $extension;
        if ($dir == false) {
            $folder = '../' . WEB_FILES . '/sliders/';
        } else {
            $folder = '../' . WEB_FILES . '/' . $dir . '/';
        }
        if (file_exists($folder)) {
            $new_name = $folder . $new;
        } else {
            mkdir($folder, 0755, TRUE);
            $new_name = $folder . $new;
        }
        $copied = copy($fileTemp, $new_name);
        if (!$copied) {
            return 'error copy !';
        } else {
            return $new;
        }


    }

    function getExtension($str)
    {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
}

function Check_user($user, $id = false)
{
    $q = new Database_alters();
    $q->table = ADMIN_TABLE;
    if ($id == false) {
        $q->conditions = "WHERE `username`='$user'";
    } else {
        $q->conditions = "WHERE `username`='$user' AND `id`<>'$id'";
    }
    $q->select_data();
    if ($q->check_ex()) {
        return false;
    } else {
        return true;
    }
}

