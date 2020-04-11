<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Pages\Page as page;

$p = new page();
if (isset($_GET['action'])) {
    require_once DIR . '/admin/actions.php';
    exit();
}
if (!isset($_SESSION['user_signed_email'])) {
    $p->get_method = 'login';
    $p->PagesCons();
} else {
    if (empty($_GET)) {
        $p->get_method = 'home';
        $p->PagesCons();
    } else if (isset($_GET['add'])) {
        $p->get_method = 'addPage';
        $p->PagesCons();
    } else if (isset($_GET['homepage'])) {
        $p->get_method = 'settings';
        $p->PagesCons();
    } else if (isset($_GET['users'])) {
        $p->get_method = 'users';
        $p->PagesCons();
    }
}