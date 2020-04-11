<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace Pages;

class Page
{
    var $get_method = 'home';
    var $page = 'home';
    var $header = '';
    var $footer = '';
    var $toolbar = '';

    function PagesCons()
    {
        switch ($this->get_method) {
            case 'login':
                $this->header = 'header_unsigned';
                $this->page = 'login_page';
                $this->footer = 'footer_unsigned';
                break;
            case 'home':
                $this->header = 'header_signed';
                $this->toolbar = 'toolbar_signed';
                $this->page = 'homepage';
                $this->footer = 'footer_singed';
                break;
            case 'addPage':
                $this->header = 'header_signed';
                $this->toolbar = 'toolbar_signed';
                $this->page = 'add_data';
                $this->footer = 'footer_singed';
                break;
            case 'users':
                $this->header = 'header_signed';
                $this->toolbar = 'toolbar_signed';
                $this->page = 'users_page';
                $this->footer = 'footer_singed';
                break;
            case 'settings':
                $this->header = 'header_signed';
                $this->toolbar = 'toolbar_signed';
                $this->page = 'homepage';
                $this->footer = 'footer_singed';
                break;
        }
        $this->ShowPage();
    }

    function ShowPage()
    {
        include 'pages/layouts/' . $this->header . '.php';
        if ($this->toolbar != '') {
            include 'pages/layouts/' . $this->toolbar . '.php';
        }
        include 'pages/' . $this->page . '.php';
        include 'pages/layouts/' . $this->footer . '.php';
    }
}