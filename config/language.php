<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace Languages;
class Web_language
{

    var $lang = 'ar';
    var $enable_langs = false;

    function __construct($lang = '')
    {
        if ($this->enable_langs) {
            $_SESSION['lang'] = $this->lang;
        }
    }

    function Current_lang()
    {
        return $_SESSION['lang'];
    }

    function Change_Language()
    {
        $_SESSION['lang'] = $this->lang;
    }

    function ReturnLanguage()
    {
        if (isset($_SESSION['lang'])) {
            return $_SESSION['lang'];
        } else {
            return $this->lang;
        }

    }

}