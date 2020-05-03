<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace PagesControl;

use FOOTER\Page_Footer;
use HEADER\Page_Banner;
use HEADER\Page_Header;


class Pages
{
    var $page_get;
    var $page_closed = false;
    var $loader = false;
    var $page_title = PAGE_DEF_TITLE;
    protected $page_select;

    function Action()
    {
        switch ($this->page_get) {
            case 'home':
                $this->page_select = 'home.php';
                break;
            case 'Services':
                $this->page_select = 'services.php';
                break;
            case 'SectorsBranches':
                $this->page_select = 'sectors_brans.php';
                break;
            case 'News_Page':
                $this->page_select = 'news_page.php';
                break;
            case 'Project_Page':
                $this->page_select = 'project_page.php';
                break;

        }
        if ($this->page_closed) {
            $this->Closed();
        } else {
            $this->CreatePage();
        }

    }

    protected function Closed()
    {
        include 'pages/closed/index.html';
    }

    protected function CreatePage()
    {
        if (!$this->loader) {
            new Page_Header($this->page_title);
            new Page_Banner();
            include 'pages/' . $this->page_select;
            new Page_Footer();
        } else {
            include 'pages/' . $this->page_select;
        }
    }


}