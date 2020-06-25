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
            'CHANGE_LANG' => array('ar' => 'English', 'en' => 'العربية'),
            'ALIGN' => array('ar' => 'right', 'en' => 'left'),
            'ALIGN_NATIVE' => array('ar' => 'left', 'en' => 'right'),
            'DIR' => array('ar' => 'rtl', 'en' => 'ltr'),
            'TITLE' => array('ar' => '', 'en' => ''),
            'LANGUAGES' => array('ar' => 'اللغة', 'en' => 'Language'),
            'HOME' => array('ar' => ' الرئيسية', 'en' => 'Home'),
            'MENU' => array('ar' => 'القائمة', 'en' => 'Menu'),
            'TERMS' => array('ar' => 'شروط الاستخدام', 'en' => 'Terms and conditions'),
            'PRIVACY' => array('ar' => 'سياسة الخصوصية', 'en' => 'privacy policy'),
            'ABOUT' => array('ar' => 'عن المجموعة', 'en' => 'About group'),
//            About menu

            'BREF_INFO' => array('ar' => 'نبذة عن الشركة', 'en' => 'About group'),
            'CHAIRMAN_WORD' => array('ar' => 'كلمة رئيس مجلس الادارة', 'en' => 'Chairman word'),
            'CEO_WORD' => array('ar' => 'كلمة الرئيس التنفيذي', 'en' => 'CEO word'),
            'GOAL_VISION_MISSION' => array('ar' => 'أهدافنا,رؤيتنا و مهمتنا', 'en' => 'Goal,Vision and Mission'),

            'ABOUT_COMPANY' => array('ar' => 'عن الشركة', 'en' => 'About Company'),
            'SECTORS' => array('ar' => 'قطاعات الاعمال', 'en' => 'Sectors'),
            'SUPP_BUSI' => array('ar' => 'شركاء الاعمال', 'en' => 'Business suppliers'),
            'NEWS' => array('ar' => 'الأخبـار والانشطة', 'en' => 'News & Activities'),
            'CONTACT' => array('ar' => 'تواصل معنا', 'en' => 'Contact Us'),
            'ADDRESS' => array('ar' => 'العنوان', 'en' => 'Address'),
            'PHONE' => array('ar' => 'رقم الهاتف', 'en' => 'Phone'),
            'EMAIL' => array('ar' => 'البريد الالكتروني', 'en' => 'Email Address'),
            'SUBSCRIBE' => array('ar' => 'أشترك', 'en' => 'Subscribe'),
            'READ_MORE' => array('ar' => 'أقراء المزيد', 'en' => 'Read More'),
            //// - Add Here - ///
            'PROJECTS' => array('ar' => 'المشاريع', 'en' => 'Projects'),
            'LATEST_PROJECTS' => array('ar' => 'أخر المشاريع', 'en' => 'Latest Projects'),
            'services' => array('ar' => 'الخدمات', 'en' => 'Services'),
            'latest_equ' => array('ar' => 'أحدث المعدات', 'en' => 'Latest Equipments'),
            'photo_galleries' => array('ar' => 'البوم الصور', 'en' => 'Galleries'),
            'Partners' => array('ar' => 'شركاء النجاح', 'en' => 'Our Partners'),
            ///// - Services - ///
            'ABOUT_SERVICE' => array('ar' => 'نبذة', 'en' => 'About'),
            'STR_SERVICES' => array('ar' => 'القدرات', 'en' => 'Strength'),
            //// Sectors ///
            'SECTOR_OVERVIEW' => array('ar' => 'نبذة عن القطاع', 'en' => 'About Sector'),
            'RELATED_PROJECT' => array('ar' => 'مشاريع متعلقة', 'en' => 'Related Projects'),
            'COMPANY_PROFILE' => array('ar' => 'الشــركة', 'en' => 'Company Profile'),
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