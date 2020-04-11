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
        prs::$table = SERVICES_TABLE;
        foreach (prs::select__record() as $t => $s) {
            $this->sectors = '<li><a href="#gal1" class="drop-text view-window">' . $s['service_' . $l] . '</a></li>';
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
       	<div class="navigation">
			<div class="container-fluid">
				<nav class="pull">
					<ul>
						<li><a  href="#">' . $trans['HOME'][$l] . '</a></li>
						<li><a  href="#">' . $trans['ABOUT'][$l] . '</a></li>
					
						<li><a  href="terms.html">' . $trans['TERMS'][$l] . '</a></li>
						<li><a  href="privacy.html">' . $trans['PRIVACY'][$l] . '</a></li>
						<li><a  href="contact.html">' . $trans['CONTACT'][$l] . '</a></li>
					</ul>
				</nav>			
			</div>
		</div>
      <div class="header">
    <div class="container">
        <!--logo-->
        <div class="logo">
            
        </div>
        <!--//logo-->
        <div class="top-nav">
            <ul class="right-icons">
                <li><span ><i class="glyphicon glyphicon-phone"> </i>+967 77 77 7777</span></li>
                <li><a  href="login.html"><i class="glyphicon glyphicon-user"> </i>' . $trans['LANGUAGES'][$l] . '</a></li>
                <li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a></li>

            </ul>
            <div class="nav-icon">
                <div class="hero fa-navicon fa-2x nav_slide_button" id="hero">
                    <a href="#"><i class="glyphicon glyphicon-menu-hamburger"></i> </a>
                </div>
                <!---
                <a href="#" class="right_bt" id="activator"><i class="glyphicon glyphicon-menu-hamburger"></i>  </a>
            --->
            </div>
            <div class="clearfix"> </div>
            <!---pop-up-box---->

          
            <!---//pop-up-box---->
            <div id="small-dialog" class="mfp-hide">
                <!----- tabs-box ---->
                <div class="sap_tabs">
                    <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                        <ul class="resp-tabs-list">
                            <li class="resp-tab-item " aria-controls="tab_item-0" role="tab"><span>All Homes</span></li>
                            <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>For Sale</span></li>
                            <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>For Rent</span></li>
                            <div class="clearfix"></div>
                        </ul>
                        <div class="resp-tabs-container">
                            <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0"><span class="resp-arrow"></span>All Homes</h2><div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                                <div class="facts">
                                    <div class="login">
                                        <input type="text" value="Search Address, Neighborhood, City or Zip" onfocus="this.value = \'\';" onblur="if (this.value == \'\') {this.value = \'Search Address, Neighborhood, City or Zip\';}">
                                        <input type="submit" value="">
                                    </div>
                                </div>
                            </div>
                            <h2 class="resp-accordion" role="tab" aria-controls="tab_item-1"><span class="resp-arrow"></span>For Sale</h2><div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
                                <div class="facts">
                                    <div class="login">
                                        <input type="text" value="Search Address, Neighborhood, City or Zip" onfocus="this.value = \'\';" onblur="if (this.value == \'\') {this.value = \'Search Address, Neighborhood, City or Zip\';}">
                                        <input type="submit" value="">
                                    </div>
                                </div>
                            </div>
                            <h2 class="resp-accordion" role="tab" aria-controls="tab_item-2"><span class="resp-arrow"></span>For Rent</h2><div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                                <div class="facts">
                                    <div class="login">
                                        <input type="text" value="Search Address, Neighborhood, City or Zip" onfocus="this.value = \'\';" onblur="if (this.value == \'\') {this.value = \'Search Address, Neighborhood, City or Zip\';}">
                                        <input type="submit" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
                </div>
            </div>
       


        </div>
        <div class="clearfix"> </div>
    </div>
</div>
 
';
        return $this->banner;
    }

}