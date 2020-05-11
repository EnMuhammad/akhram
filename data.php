<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use PagesControl\Pages as page;
use PROCESS\prs as prs;

require_once 'pages.php';
require_once 'pages/layouts/page_error.php';

prs::unSetData();
prs::$table = WEB_SETTINGS;
$colsed = 0;
foreach (prs::select__record() as $t => $m) {
    $colsed = $m['closed'];
}
if ($colsed == 1 && !isset($_SESSION['AdminLogin']) && !isset($_SESSION['AdminId']) && !isset($_GET['Control'])) {
    $p = new page();
    $p->page_closed = true;
    $p->page_get = 'home';
    $p->page_title = PAGE_DEF_TITLE;
    $p->Action();
} else if (isset($_GET['Control'])) {
    if (!isset($_SESSION['AdminLogin']) && !isset($_SESSION['AdminId'])) {
        $p = new page();
        $p->page_closed = false;
        $p->page_get = 'LoginAdmin';
        $p->page_title = 'Login';
        $p->Action();
    } else {
        $p = new page();
        $p->page_get = 'home';
        $p->page_title = PAGE_DEF_TITLE;
        $p->Action();
    }
} else {
    if (empty($_GET) || isset($_GET['home']) || isset($_GET['dashboard'])) {
        $p = new page();
        $p->page_get = 'home';
        $p->page_title = PAGE_DEF_TITLE;
        $p->Action();
    } else if (isset($_GET['Serv'])) {
        $p = new page();
        $p->page_get = 'Services';
        $p->page_title = 'Services';
        $p->Action();
    } else if (isset($_GET['Sections'])) {
        $p = new page();
        $p->page_get = 'SectorsBranches';
        $p->page_title = SECBRAN_TITLE;
        $p->Action();
    } else if (isset($_GET['NewsPage'])) {
        $p = new page();
        $p->page_get = 'News_Page';
        $p->page_title = NEWS_PAGE . ' أسم الخبر';
        $p->Action();
    } else if (isset($_GET['Project'])) {
        $p = new page();
        $p->page_get = 'Project_Page';
        $p->page_title = 'Project';
        $p->Action();
    } else if (isset($_GET['Lists'])) {
        $p = new page();
        $p->page_get = 'AllList';
        $p->page_title = 'All';
        $p->Action();
    } else {
        new Page_Errors\ErrorsPages();
    }
}
