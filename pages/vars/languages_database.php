<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace Languages;

class Lang_database
{
    var $lang_type = 'en';
    var $data_set = array();

    function __construct()
    {

        return $this->Translations();
    }

    function Translations()
    {
        $this->data_set = array(
            'TITLE' => array('ar' => '', 'en' => ''),
            'LANGUAGES' => array('ar' => 'اللغة', 'en' => 'Language'),
            'HOME' => array('ar' => ' الرئيسية', 'en' => 'Home'),
            'MENU' => array('ar' => 'القائمة', 'en' => 'Menu'),
            'TERMS' => array('ar' => 'شروط الاستخدام', 'en' => 'Terms and conditions'),
            'PRIVACY' => array('ar' => 'سياسة الخصوصية', 'en' => 'privacy policy'),
            'ABOUT' => array('ar' => 'عنا', 'en' => 'About us'),
            'NEWS' => array('ar' => 'الأخبـار والانشطة', 'en' => 'News & Activities'),
            'CONTACT' => array('ar' => 'تواصل معنا', 'en' => 'Contact Us'),
            'ADDRESS' => array('ar' => 'العنوان', 'en' => 'Address'),
            'PHONE' => array('ar' => 'رقم الهاتف', 'en' => 'Phone'),
            'EMAIL' => array('ar' => 'البريد الالكتروني', 'en' => 'Email Address'),
            'SUBSCRIBE' => array('ar' => 'أشترك', 'en' => 'Subscribe'),
            //// - Add Here - ///
            'LATEST_PROJECTS' => array('ar' => 'أخر المشاريع', 'en' => 'Latest Projects'),
            'services' => array('ar' => 'الخدمات', 'en' => 'Services'),
            'latest_equ' => array('ar' => 'أحدث المعدات', 'en' => 'Latest Equipments'),
            'photo_galleries' => array('ar' => 'البوم الصور', 'en' => 'Galleries'),
            'Partners' => array('ar' => 'شركاء النجاح', 'en' => 'Our Partners'),

        );
        $this->GetLanguage();
        return $this->data_set;
    }

    function GetLanguage()
    {
        if (isset($_SESSION['lang'])) {
            $this->lang_type = $_SESSION['lang'];
        } else {
            $this->lang_type = 'en';
        }
        return $this->lang_type;
    }
}