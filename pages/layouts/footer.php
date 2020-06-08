<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace FOOTER;

use Fun\functions as fun;
use Languages\Lang_database as lang;
use PROCESS\prs as prs;

class Page_Footer
{

    var $footer = '';
    var $content = '';
    var $sectors = '';
    var $about = '';
    var $contact = '';

    function __construct()
    {
        $fun = new fun();
        $lang = new lang();
        $trans = $lang->Translations();
        $l = $lang->GetLanguage();
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        foreach (prs::select__record() as $t => $s) {
            $url_name = str_replace(' ', '_', trim($s['title_' . $l]));
            $this->sectors .= '
            <li><a href="Sectors/' . $s['id'] . '/' . $url_name . '">' . $s['title_' . $l] . '</a></li>
            ';
        }
        prs::unSetData();
        prs::$table = PAGES_TABLE;
        prs::$select_cond = array('related_to' => 'about');

        if (!empty(prs::select__record())) {
            foreach (prs::select__record() as $t => $about) {
                $url_name = str_replace(' ', '_', trim($about['title_' . $l]));
                $this->about .= '
             <li><a href="Page/' . $about['id'] . '/' . $url_name . '">' . $about['title_' . $l] . '</a></li>
            ';

            }

        }
        $this->about .= '
<li style=""><a href="Company/Profile/">Company Profile</a></li>
        <li ><a href="#">' . $trans['TERMS'][$l] . '</a></li>
        <li ><a href="#">' . $trans['PRIVACY'][$l] . '</a></li>
';
        foreach ($fun->BranchesMainCenter($l) as $info) {
            $this->contact .= '<p>Land-Phone: ' . $info['phone'] . '</p>';
            $this->contact .= '<p>Fax: ' . $info['fax'] . '</p>';
            $this->contact .= '<p>Whatsapp: ' . $info['whatsapp'] . '</p>';
        }
        echo $this->footer();
    }

    function footer()
    {


        $this->footer = '
    <div class="footer">
	<div class="container">
		<div class="footer-top-at">
			<div class="col-md-3 amet-sed">
				<h4>Our Company</h4>
				<ul class="nav-bottom">
					' . $this->about . '
					
				</ul>	
			</div>
			<div class="col-md-3 amet-sed ">
				<h4>Sectors</h4>
					<ul class="nav-bottom">
						' . $this->sectors . '
					</ul>	
			</div>
			<div class="col-md-3 amet-sed">
				<h4>Customer Support</h4>
				' . $this->contact . '
					<ul class="nav-bottom">
						
						<li><a href="Company/Contact/">Our Branches</a></li>
						<li><a href="Company/Contact/">Contact us</a></li>
					</ul>	
			</div>
			<div class="col-md-3 amet-sed ">
				<h4>News & Social Network</h4>
				   <ul class="nav-bottom">
						<li><a href="#">Residential Property</a></li>
						<li><a href="#">Commercial Property</a></li>
					</ul>	
					<ul class="social">
						<li><a href="#"><i> </i></a></li>
						<li><a href="#"><i class="gmail"> </i></a></li>
						<li><a href="#"><i class="twitter"> </i></a></li>
						<li><a href="#"><i class="camera"> </i></a></li>
						<li><a href="#"><i class="dribble"> </i></a></li>
					</ul>
			</div>
		<div class="clearfix"> </div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="col-md-4 footer-logo">
				<h2><a href="home">AL AKHRAM - الأخرم</a></h2>
			</div>
			<div class="col-md-8 footer-class">
				<p >© ' . date('Y') . ' . All Rights Reserved  </p>
			</div>
		<div class="clearfix"> </div>
	 	</div>
	</div>
</div>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="js/scripts.js"></script>
   
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
  <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
            <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
           ' . ((isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId']) && empty($_GET)) ? '
<script src="js/admin.js"></script>' : '') . ' 
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src=\'https://embed.tawk.to/5ed566a78ee2956d73a695a0/default\';
s1.charset=\'UTF-8\';
s1.setAttribute(\'crossorigin\',\'*\');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
            
	  </body>
	  </html>
    ';
        return $this->footer;
    }

}