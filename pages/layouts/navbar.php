<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace HEADER;

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

        $lang = new lang();
        $trans = $lang->Translations();
        $l = $lang->GetLanguage();
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        foreach (prs::select__record() as $t => $s) {
            $url_name = str_replace(' ', '_', trim($s['title_' . $l]));
            $this->sectors .= '
             <li><a href="Sectors/' . $s['id'] . '/' . $url_name . '">' . $s['title_' . $l] . '</a></li>
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
        $lang = new lang();
        $trans = $lang->Translations();
        $l = $lang->GetLanguage();
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
                <li class="active" ><a href="#">' . $trans['HOME'][$l] . '</a></li>
              <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['ABOUT'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu">
       <li ><a href="#">' . $trans['BREF_INFO'][$l] . '</a></li>
        <li><a href="#">' . $trans['CHAIRMAN_WORD'][$l] . '</a></li>
        <li><a href="#">' . $trans['CEO_WORD'][$l] . '</a></li>
        <li><a href="#">' . $trans['GOAL_VISION_MISSION'][$l] . '</a></li>
        <li class="divider"></li>
        <li><a href="#">' . $trans['TERMS'][$l] . '</a></li>
        <li><a href="#">' . $trans['PRIVACY'][$l] . '</a></li>
      </ul>
    </li>
                   <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['SECTORS'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu">
    ' . $this->sectors . '
      </ul>
    </li>
      <li><a href="#">' . $trans['SUPP_BUSI'][$l] . '</a></li>
                  <li><a href="#">' . $trans['CONTACT'][$l] . '</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:;" class="change_lang"><span class="fa fa-language fa-lg"></span> ' . $trans['CHANGE_LANG'][$l] . '</a></li>
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