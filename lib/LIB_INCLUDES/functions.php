<?php

class functions
{
    public static function web_closed()
    {
        $q = new Database_alters();
        $q->table = SETTING_TABLE;
        $q->Data_type = "`web_close`";
        $q->conditions = "WHERE `web_close`='1'";
        $q->select_data();
        if ($q->check_ex()) {
            return true;
        } else {
            return false;
        }
    }
}

class Sessions
{
    var $lang = 'en';

    function language()
    {
        if (isset($_SESSION['lang'])) {
            $this->lang = $_SESSION['lang'];
        }
        switch ($this->lang) {
            case 'en':
            default:
                $select = WEB_LANG . "/english.php";
                break;
            case 'ar':
                $select = WEB_LANG . "/arabic.php";
                break;
        }
        return $select;
    }

    function Select_language()
    {
        $_SESSION['lang'] = $this->lang;
    }


}

function IpAddress()
{
    $ip = $_SERVER['REMOTE_ADDR'] ?: ($_SERVER['HTTP_X_FORWARDED_FOR'] ?: $_SERVER['HTTP_CLIENT_IP']);
    return $ip;

}

function createTimeStamp()
{
    return date("Y-m-d H:i:s");

}