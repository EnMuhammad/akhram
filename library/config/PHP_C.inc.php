<?php
DEFINE('ADMIN_TABLE', 'admin');
DEFINE('ART_TABLE', 'articals');
DEFINE('BRAN_TABLE', 'bransh');
DEFINE('CERT_TABLE', 'certi');
DEFINE('FEEDBACK_TABLE', 'feedback');
DEFINE('NEWS_TABLE', 'news');
DEFINE('ALBUM_TABLE', 'albums');
DEFINE('PHOTO_TABLE', 'photo');
DEFINE('COUNTRY_TABLE', 'country');
DEFINE('EQ_SEC_TABLE', 'eq_sections');
DEFINE('EQUI_TABLE', 'equipments');
DEFINE('EQU_INFO_TABLE', 'equ_info');
DEFINE('WORK_TABLE', 'prev_work');
DEFINE('SERVICES_TABLE', 'service');
DEFINE('SERV_POINT_TABLE', 'serv_point');
DEFINE('SLIDES_TABLE', 'slides');
DEFINE('CONTACT_TABLE', 'contact_us');
DEFINE('TAGS_TABLE', 'tags');
DEFINE('VID_TABLE', 'videos');
DEFINE('SETTING_TABLE', 'web_setting');

class Database
{
    var $connect;

    function connect_db()
    {
        $this->connect = mysqli_connect(HOST, USER_HOST, USER_PASS, DATABASE);

        $this->connect->set_charset("UTF8");
        return $this->connect;
    }

    function close_connect()
    {
        return $this->connect = mysqli_close($this->connect);
    }
}

Class Database_alters
{

    var $table;
    var $query;
    var $connection;
    var $data;
    var $data_in;
    var $data_value;
    var $conditions = '';
    var $Data_type = "*";

    function select_data()
    {
        $this->query = mysqli_query($this->connections(), "SELECT " . $this->Data_type . " FROM `" . $this->table . "`" . $this->conditions);
        return $this->query;
    }

    function connections()
    {
        $this->connection = new Database();
        return $this->connection->connect_db();
    }

    function show_data($acc = false)
    {
        if ($acc == false)
            return $this->data = mysqli_fetch_array($this->query, MYSQLI_BOTH);
        else
            return $this->data = mysqli_fetch_assoc($this->query);
    }

    function check_ex()
    {
        if (mysqli_num_rows($this->query) == 0) {
            return false;
        } else {
            return true;
        }
    }

    function count_ex()
    {
        return mysqli_num_rows($this->query);
    }

    function fill_up_data()
    {
        $this->query = "INSERT INTO `" . $this->table . "` (" . $this->data_in . ") VALUES (" . $this->data_value . ")";
        if (mysqli_query($this->connections(), $this->query)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_data()
    {
        $this->query = "DELETE FROM `" . $this->table . "`" . $this->conditions;
        if (mysqli_query($this->connections(), $this->query)) {
            return true;
        } else {
            return false;
        }
    }

    function update_data()
    {
        $this->query = "UPDATE `" . $this->table . "` SET " . $this->data_in . $this->conditions;
        if (mysqli_query($this->connections(), $this->query)) {
            return true;
        } else {
            return false;
        }
    }

    private function data_close_connect()
    {
        $this->connection = new Database();
        return $this->connection->close_connect();

    }


}

Class Login
{
    var $user;
    var $password;
    var $connect;
    var $data;
    var $query;
    var $save_id;
    var $save_user;
    var $save_pass;

    function Check_in_database()
    {
        $this->data = $this->user;
        $this->user = $this->Secure_data();
        $this->data = $this->password;
        $this->password = $this->Secure_data();
        $this->password = MD5($this->password);

        $this->query = mysqli_query($this->connections(), "SELECT * FROM `" . ADMIN_TABLE . "` WHERE `username`='" . $this->user . "' AND password ='" . $this->password . "'");

        if (mysqli_num_rows($this->query) != 0) {

            $q = mysqli_fetch_array($this->query);
            $this->save_user = $this->user;
            $this->save_id = $q['id'];
            $this->save_pass = $this->password;
            $this->Save_data();
            $this->data_close_connect();
            return true;
        } else {

            return false;
        }

    }

    function Secure_data()
    {
        $this->data = mysqli_real_escape_string($this->connections(), $this->data);
        return $this->data;
    }

    private function connections()
    {
        $this->connect = new Database();
        return $this->connect->connect_db();
    }

    function Save_data()
    {
        $_SESSION ['user_id'] = $this->save_id;
        $_SESSION ['user_admin'] = $this->save_user;
        $_SESSION ['pass_admin'] = $this->save_pass;
        $this->UpdateLastSeen($this->save_id);
    }

    function UpdateLastSeen($id)
    {
        $q = new Database_alters();
        $q->table = ADMIN_TABLE;
        $q->conditions = "WHERE `id`='$id'";
        $q->select_data();
        if ($q->check_ex()) {
            $time = time();
            $q->data_in = "`last_seen`='$time'";
            $q->update_data();
        }


    }

    private function data_close_connect()
    {
        $this->connect = new Database();
        mysqli_close($this->connect->connect_db());
    }

    function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_admin']);
        unset($_SESSION['pass_admin']);
        session_unset();
    }
}

class Table
{
    var $td;
    var $tr;
    var $th;
    var $table;
    var $table_id;
    var $table_class;
    var $rows;
    var $cols;
    var $data = array();

    function createTable()
    {
        $this->table = "<table class='Table_Home " . $this->table_class . "' id='" . $this->table_id . "'>";
        for ($i = 0; $i < $this->cols; $i++) {
            $this->table .= '<tr>';
            for ($i = 0; $i < $this->rows; $i++) {
                $this->table .= "<td>" . $this->data[$i] . "</td>";
            }

            $this->table .= "</tr>";
        }


        $this->table .= "</table>";
        return $this->table;
    }


}

class web_info
{

    public static function web_information($data)
    {
        $q = new Database_alters();
        $q->table = SETTING_TABLE;
        $q->Data_type = $data;
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            return $q->data[$data];

        } else {
            return '';
        }


    }

    public static function contact_us($data, $null = false)
    {
        $q = new Database_alters();
        $q->table = CONTACT_TABLE;
        $q->Data_type = $data;
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            if ($q->data[$data] == '' || empty($q->data[$data])) {
                if ($null == true) {
                    return NULL;
                } else {
                    return '';
                }
            } else {
                return $q->data[$data];
            }
        } else {
            return '';
        }


    }


}

Class Albums
{

    var $album_id;


    public static function Get_Random_Pic($aid, $random = true)
    {

        $q = new Database_alters();
        $id = intval($aid);
        $q->table = PHOTO_TABLE;
        if ($random == true) {
            $q->conditions = "WHERE `album_id`='" . $aid . "' ORDER BY RAND()";
        } else {
            $q->conditions = "WHERE `album_id`='" . $aid . "' ORDER BY id DESC";
        }
        $q->select_data();
        $no_dir = BASE . '/' . WEB_FILES . '/def/no_image_thumb.gif';
        if ($q->check_ex()) {
            $q->show_data();
            $img = $q->data['image'];
            $dir = WEB_FILES . '/photos/' . $img;

            if (file_exists($dir)) {
                return $dir;
            } else {
                return $no_dir;
            }

        } else {
            return $no_dir;
        }


    }

    public static function Album_info($info, $id)
    {
        $id = intval($id);
        $q = new Database_alters();
        $q->table = ALBUM_TABLE;
        $q->conditions = "WHERE `id`='" . $id . "'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            return $q->data[$info];
        } else {
            return '';
        }
    }

    public static function work_album_id($id, $type = "work_id")
    {
        $id = intval($id);
        $q = new Database_alters();
        $q->table = ALBUM_TABLE;
        $q->conditions = "WHERE `$type`='" . $id . "'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            return $q->data['id'];
        } else {
            return '';
        }
    }

    public static function work_info($info, $id)
    {

        $id = intval($id);
        $q = new Database_alters();
        $q->table = WORK_TABLE;
        $q->conditions = "WHERE `id`='" . $id . "'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            return $q->data[$info];
        } else {
            return '';
        }

    }

    public static function Get_eq_album($info, $id)
    {

        $id = intval($id);
        $q = new Database_alters();
        $q->table = ALBUM_TABLE;
        $q->conditions = "WHERE `equ_id`='" . $id . "' AND `work_id`='0'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            return $q->data[$info];
        } else {
            return '';
        }

    }

    public static function Get_eq_photo($album)
    {

        $album = intval($album);
        $q = new Database_alters();
        $q->table = PHOTO_TABLE;
        $q->conditions = "WHERE `album_id`='" . $album . "'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            return $q->data['image'];
        } else {
            return '0';
        }

    }

    function Get_Album_photo()
    {

        $album = intval($this->album_id);
        $q = new Database_alters();
        $q->table = PHOTO_TABLE;
        $q->conditions = "WHERE `album_id`='" . $album . "'";
        $q->select_data();
        $img = array();
        if ($q->check_ex()) {
            $i = 0;
            while ($q->show_data()) {
                $img[$i]['img'] = $q->data['image'];
                $img[$i]['id'] = $q->data['id'];
                $i++;
            }
        }
        return $img;
    }

    function Album_Ex()
    {
        $this->album_id = intval($this->album_id);
        $q = new Database_alters();
        $q->table = ALBUM_TABLE;
        $q->conditions = "WHERE `id`='" . $this->album_id . "'";
        $q->select_data();
        if ($q->check_ex()) {
            return true;
        } else {
            return false;
        }
    }


    function First_Photo()
    {
        $this->album_id = intval($this->album_id);
        $q = new Database_alters();
        $q->table = PHOTO_TABLE;
        $q->conditions = "WHERE `album_id`='" . $this->album_id . "' ORDER BY `id` ASC ";
        $no_dir = BASE . '/' . WEB_FILES . '/def/no_image_thumb.gif';
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            $img = $q->data['image'];
            $dir = WEB_FILES . '/photos/' . $img;
            if (file_exists($dir)) {
                return $dir;
            } else {
                return $no_dir;
            }
        } else {
            return $no_dir;
        }


    }

    function Get_Photo($id)
    {
        $id = intval($id);
        $q = new Database_alters();
        $q->table = PHOTO_TABLE;
        $q->conditions = "WHERE `id`='" . $id . "'";
        $no_dir = BASE . '/' . WEB_FILES . '/def/no_image_thumb.gif';
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            $img = $q->data['image'];
            $dir = WEB_FILES . '/photos/' . $img;
            if (file_exists($dir)) {
                return $dir;
            } else {
                return $no_dir;
            }
        } else {
            return $no_dir;
        }


    }


}

class Style
{


    var $coustme_style = '';
    var $c_class;

    var $height;
    var $width;
    var $float = 'left';
    var $title = '';
    var $img;

    var $c_id = '';
    var $on_click;
    var $text = '';

    function Div_background()
    {
        return '<div class="' . $this->c_class . '" ' . $this->on_click . ' id="' . $this->c_id . '" title="' . $this->title . '" style="' . $this->coustme_style . 'background:url(' . $this->img . ');float:' . $this->float . ';width:' . $this->width . ';height:' . $this->height . ';background-repeat: no-repeat;background-position: center;background-size:cover;
      filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . $this->img . '",sizingMethod=\'scale\';)
      ">' . $this->text . '</div>';
    }


}

class EQU_in
{
    public static function Check_Sections()
    {

        $q = new Database_alters();
        $q->table = EQ_SEC_TABLE;

        $q->select_data();
        if ($q->check_ex()) {
            return true;
        } else {
            return false;
        }


    }

    public static function NAME_Sections($id, $lang = 'ar')
    {

        $q = new Database_alters();
        $q->table = EQ_SEC_TABLE;
        $q->conditions = "WHERE `id`='$id'";
        $q->select_data();
        if ($q->check_ex()) {
            $q->show_data();
            return $q->data['title_' . $lang];
        } else {
            return '';
        }


    }


}

function Country_name($countryid, $lang)
{
    $q = new Database_alters();
    $q->table = COUNTRY_TABLE;
    $q->Data_type = "`id`,`" . $lang . "`";
    $q->conditions = "WHERE `id`='$countryid'";
    $q->select_data();
    $q->show_data();
    return $q->data;
}

function servpoint($id, $lang)
{
    $a = array();
    if (is_numeric($id)) {
        $q = new Database_alters();
        $q->table = SERV_POINT_TABLE;
        $q->conditions = "WHERE `serv_id`='$id'";
        $q->select_data();
        if ($q->check_ex()) {
            while ($q->show_data()) {
                $a[] = $q->data['title_' . $lang];
            }
        }
    }
    return $a;
}
