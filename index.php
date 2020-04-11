<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */
session_start();
//error_reporting(0);
define('DS', DIRECTORY_SEPARATOR);
define('FOLDER_DIR', 'akhram2');
define('HOME_DIR', dirname(__FILE__));
define('DIR', dirname(__FILE__));
define('ROOT', 'http://' . $_SERVER['SERVER_NAME'] . '/' . FOLDER_DIR);
define('HOME_ROOT', 'https://' . $_SERVER['SERVER_NAME'] . '/');
define('CSS_FOLDER', 'https://' . $_SERVER['SERVER_NAME'] . '/userpanel/pub/assets/');
define('JS_FOLDER', 'https://' . $_SERVER['SERVER_NAME'] . '/userpanel/pub/assets/js/');
define('PUBLIC_FOLDER', 'https://' . $_SERVER['SERVER_NAME'] . '/userpanel/pub/');
define('CONFIG', 'config');
define('PAGES', 'pages');
//define('Media_file', ROOT.DS.'data');
require_once DIR . '/config/process.php';
require_once DIR . '/config/functions.php';
require_once 'pages/vars/languages_database.php';
if (isset($_GET['action'])) {
    require_once 'actions.php';
}
require_once 'pages/layouts/header.php';
require_once 'pages/layouts/navbar.php';
require_once 'pages/layouts/footer.php';
require_once 'data.php';









