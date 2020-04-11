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
define('FOLDER_DIR', 'akhram2/admin');
define('HOME_DIR', dirname(__FILE__));
define('DIR', dirname(dirname(__FILE__)));
define('ROOT', 'http://' . $_SERVER['SERVER_NAME'] . '/' . FOLDER_DIR);
define('HOME_ROOT', 'https://' . $_SERVER['SERVER_NAME'] . '/');
define('CSS_FOLDER', 'https://' . $_SERVER['SERVER_NAME'] . '/userpanel/pub/assets/');
define('JS_FOLDER', 'https://' . $_SERVER['SERVER_NAME'] . '/userpanel/pub/assets/js/');
define('PUBLIC_FOLDER', 'https://' . $_SERVER['SERVER_NAME'] . '/userpanel/pub/');
define('CONFIG', DIR . '/config');
define('PAGES', 'pages');
require_once CONFIG . '/process.php';
require_once DIR . '/admin/data.php';

require_once DIR . '/admin/pages/pages_controls.php';
require_once DIR . '/admin/pages/index.php';
