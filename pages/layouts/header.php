<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace HEADER;


class Page_Header
{

    var $title = '';
    var $content = '';
    var $header = '';

    public function __construct($title = '')
    {
        $this->title = $title;
        echo $this->header();
    }

    function header()
    {

        $this->header = '
<!DOCTYPE html>
<html >
<head>
<base href="' . ROOT . '" />
<title>' . $this->title . '</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>

<!-- Custom Theme files -->
<!--menu-->

<link href="css/all.css" rel="stylesheet">
<link href="jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<!--//menu-->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
' . ((isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) ? '
<link href="css/admin.css" rel="stylesheet" type="text/css" media="all" />	' : '') . '
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Real Home Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- slide -->
<script src="js/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
</head>
<body>
<div class="loading_backgrounds">
<div class="divLoader">جــاري التحميل .. يرجى الانتظار
<br>
<i class="fa fa-spin fa-spinner"></i>
</div>

</div>
' . ((isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) ? '
<div class="bottom_tools">
<ul>
<li><a href="javascript:;" class="OpenDi"><i class="fa fa-pen"></i> Update Contact Information</a></li>
<li><a href="javascript:;" class="MetaUpdate"><i class="fa fa-pen"></i> Update Meta Data</a></li>
<li><a href="javascript:;" class="show-service-da"><i class="fa fa-plus"></i> Add Service</a></li>
<li><a href="javascript:;" class="showAddProjects"><i class="fa fa-plus"></i> Add Project - Item</a></li>
<li><a href="javascript:;" class="ShowAddMedia"><i class="fa fa-photo-video"></i> Add Media</a></li>
<li><a href="javascript:;" class="ClientShowAdd"><i class="fa fa-users"></i> Add Clients</a></li>
<li><a href="javascript:;" onclick="Logout();"><i class="fa fa-arrow-left"></i> Logout</a></li>

</ul>
</div>
' : "") . '
';
        return $this->header;
    }

}