<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace HEADER;

use Fun\functions as fun;
use Languages\Lang_database as lang;
use PROCESS\prs as prs;

class Page_Banner
{

    var $banner = '';
    var $content = '';
    var $sectors = '';
    var $branches = '';

    public function __construct()
    {
        $delete = false;
        if (isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) {
            $delete = true;
        }
        $lang = new lang();
        $trans = $lang->Translations();
        $l = $lang->GetLanguage();
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        prs::$order = 'menu_order';
        foreach (prs::select__record() as $t => $s) {
            $url_name = str_replace(' ', '_', trim($s['title_' . $l]));
            $this->sectors .= '
             <li style="text-align:' . $trans['ALIGN'][$l] . ';">
           
             <a  style="display:inline-block;max-width:70%" href="Sectors/' . $s['id'] . '/' . $url_name . '">' . $s['title_' . $l] . '</a>
           
               ' . (($delete) ? '
              <a href="javascript:;" onclick="DeleteData(\'sectors\',' . $s['id'] . ')" style="float:' . $trans['ALIGN_NATIVE'][$l] . ';"><i class="fa fa-trash"></i></a>
              ' : '') . '
             </li>
        <li class="divider"></li>
            ';
        }
//        prs::unSetData();
//        prs::$table = BRAN_TABLE;
//        foreach (prs::select__record() as $t=>$b){
//            $this->branches = '<li><a href="#" class="drop-text">'.$b['name'].'</a></li>';
//        }
        echo $this->navbar();
    }

    function navbar()
    {
        $delete = false;
        if (isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) {
            $delete = true;
        }
        $lang = new lang();
        $trans = $lang->Translations();
        $l = $lang->GetLanguage();
        $fun = new fun();
        prs::unSetData();
        prs::$table = MENU_ORDER_TABLE;
        prs::$select_cond = array('page_type' => 'about');
        prs::$order = 'order_number';
        $ul_about = $ul_contact = '';
        $about_order = prs::select__record();
        prs::$select_cond = array('page_type' => 'contact');
        $order_co = prs::select__record();
        if (!empty($about_order)) {
            $o = 0;

            foreach ($about_order as $u => $order) {
                $about_page = $fun->PageInfo($order['page_id']);
                foreach ($about_page as $z => $about) {
                    $url_name = str_replace(' ', '_', trim($about['title_' . $l]));
                    $ul_about .= '
              <li class="modify"><a href="Page/' . $about['id'] . '/' . $url_name . '">' . $about['title_' . $l] . '</a>
              ' . (($delete) ? '
              <a href="javascript:;" class="actions"  onclick="DeleteData(\'pages\',' . $about['id'] . ')" ><i class="fa fa-trash"></i></a>
              ' . (($o != 0) ? '
              <a href="javascript:;" class="actions up-button"  onclick="MoveLiUp(' . $about['id'] . ',this,\'about\')" ><i class="fa fa-arrow-up"></i></a>
              ' : '
              <a href="javascript:;" style="display:none;" class="actions up-button"  onclick="MoveLiUp(' . $about['id'] . ',this,\'about\')" ><i class="fa fa-arrow-up"></i></a>
              ') . '
              ' . (($o != (count($about_order) - 1)) ? '
               <a href="javascript:;" class="actions down-button"  onclick="MoveLiDown(' . $about['id'] . ',this,\'about\')" ><i class="fa fa-arrow-down"></i></a>
              ' : '
              <a href="javascript:;" style="display:none;" class="actions down-button"  onclick="MoveLiDown(' . $about['id'] . ',this,\'about\')" ><i class="fa fa-arrow-down"></i></a>
              ') . '
             
              ' : '') . '
              </li>
            ';

                }
                $o++;
            }
            $ul_about .= ' <li class="divider"></li>';
        }
        $drop_down = false;

        if (!empty($order_co)) {
            $o = 0;
            $drop_down = true;
            foreach ($order_co as $t => $order_contact) {
                $contact_info = $fun->PageInfo($order_contact['page_id']);
                foreach ($contact_info as $r => $contact) {
                    $url_name = str_replace(' ', '_', trim($contact['title_' . $l]));
                    $ul_contact .= '
             <li class="modify"><a href="Page/' . $contact['id'] . '/' . $url_name . '">' . $contact['title_' . $l] . '</a>
              ' . (($delete) ? '
              
               ' . (($o != 0) ? '
              <a href="javascript:;" class="actions up-button"  onclick="MoveLiUp(' . $contact['id'] . ',this,\'contact\')" ><i class="fa fa-arrow-up"></i></a>
              ' : '
              <a href="javascript:;" style="display:none;" class="actions up-button"  onclick="MoveLiUp(' . $contact['id'] . ',this,\'contact\')" ><i class="fa fa-arrow-up"></i></a>
              ') . '
                 ' . (($o != (count($order_co) - 1)) ? '
               <a href="javascript:;" class="actions down-button"  onclick="MoveLiDown(' . $contact['id'] . ',this,\'contact\')" ><i class="fa fa-arrow-down"></i></a>
              ' : '
              <a href="javascript:;" style="display:none;" class="actions down-button"  onclick="MoveLiDown(' . $contact['id'] . ',this,\'contact\')" ><i class="fa fa-arrow-down"></i></a>
              ') . '
              <a href="javascript:;" onclick="DeleteData(\'pages\',' . $contact['id'] . ')" style="float:right;"><i class="fa fa-trash"></i></a>
              ' : '') . '
              </li>
            ';
                }
                $o++;
            }
            $ul_contact .= ' <li class="divider"></li>';
        }

        $this->banner = '

<!-- banner -->
      <div class="header">
    <div class="container">
        <!--logo-->
      
        <!--//logo-->
<nav class="navbar " >   
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar" ></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="#"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav" >
                <li class="active" style="float:' . $trans['ALIGN'][$l] . '"><a href="#">' . $trans['HOME'][$l] . '</a></li>
              <li class="dropdown" style="float:' . $trans['ALIGN'][$l] . '">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['ABOUT'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu about_ul" role="menu">
      ' . $ul_about . '
        <li style="float:' . $trans['ALIGN'][$l] . '"><a href="Company/Profile/">Company Profile</a></li>
        <li style="float:' . $trans['ALIGN'][$l] . '"><a href="#">' . $trans['TERMS'][$l] . '</a></li>
        <li style="float:' . $trans['ALIGN'][$l] . '"><a href="#">' . $trans['PRIVACY'][$l] . '</a></li>
      </ul>
    </li>
                   <li class="dropdown" style="float:' . $trans['ALIGN'][$l] . ';">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['SECTORS'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu" style="min-width:260px">
    ' . $this->sectors . '
      </ul>
    </li>
     <li style="float:' . $trans['ALIGN'][$l] . '"><a href="Company/BusinessSuppliers/">' . $trans['SUPP_BUSI'][$l] . '</a></li>
    ' . (($drop_down) ? '
    <li class="dropdown" style="float:' . $trans['ALIGN'][$l] . '">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['CONTACT'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu">
    ' . $ul_contact . '
      </ul>
    </li>
    ' : '
    <li style="float:' . $trans['ALIGN'][$l] . '"><a href="Company/Contact/">' . $trans['CONTACT'][$l] . '</a></li>
    ') . '
     
                  
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="float:' . $trans['ALIGN'][$l] . '"><a href="javascript:;" class="change_lang"><span class="fa fa-language fa-lg"></span> ' . $trans['CHANGE_LANG'][$l] . '</a></li>
              <!--  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Search</a></li> -->
            </ul>
        </div>
    </div>
</nav>

        <div class="clearfix"> </div>
    </div>
</div>
 
';
        return $this->banner;
    }

}