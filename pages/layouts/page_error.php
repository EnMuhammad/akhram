<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace Page_Errors;

class ErrorsPages
{
    var $header = '';
    var $footer = '';
    var $body = '';

    function __construct()
    {
        $this->NotFound404();
    }

    function NotFound404()
    {
        $this->header = '
<!DOCTYPE html>
<html lang="en">
<head>
<base href="' . ROOT . '/pages/not_found/" />
<title>هذه الصفحة غير موجودة</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="404 Error Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- font files -->
<link href="//fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
<!-- /font files -->
<!-- css files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- /css files -->
<body>
<div class="agileits-main">
';
        $this->body = '
<a href="' . ROOT . '"><h1><span>404</span>' . COMPANY_NAME . '</h1></a>
	<div class="w3ls-container text-center">
		<div class="w3layouts-image text-center">
			<img src="images/board.png" alt="" />
			<h2 class="header-w3ls">404</h2>
		</div>	
		<h3 class="img-txt">Oops, you\'ve encountered an error!</h3>
		<p>Looks like the page you are  trying to visit doesn\'t exist.</p>
		<div class="agileits-link">
			<a href="' . ROOT . '">take me home</a>
		</div>	
	</div>
';
        $this->footer = '
<div class="w3ls-footer">
		<p> &copy; ' . date('Y') . ' ' . COMPANY_NAME . '. All Rights Reserved </p>
	</div>

</div>
</body>
</html>
';
        echo $this->header;
        echo $this->body;
        echo $this->footer;
    }
}