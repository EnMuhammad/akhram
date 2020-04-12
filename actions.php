<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;
use Languages\Lang_database as lang;

$lang = new lang();
$fun = new fun();
$l = $lang->GetLanguage();
if (isset($_GET['change_language'])) {
    if ($l == 'ar' || $l == 'en') {
        if ($l == 'ar') {
            $_SESSION['lang'] = 'en';
        } else {
            $_SESSION['lang'] = 'ar';
        }
    } else {
        $_SESSION['lang'] = 'en';
    }

    exit();
} else if (isset($_GET['GetProjectList'])) {
    if (isset($_GET['id'])) {
        $fun->service_id = $_GET['id'];
        $option = '<option value="0">Select </option>';
        foreach ($fun->GetProjectListByServiceID() as $t => $pro) {
            $option .= '<option>' . $pro['title_' . $l] . '</option>';
        }
        echo $option;
    }
}