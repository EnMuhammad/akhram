<?php

use Fun\functions as fun;
use Languages\Lang_database as lang;
use PROCESS\prs as prs;

$fun = new fun();
$lang = new lang();
$trans = $lang->Translations();
$l = $lang->GetLanguage();
//$trans[''][$l];
prs::unSetData();
prs::$table = SERVICES_TABLE;
$serv = '';
prs::$limit = 7;
$serv_bottom = '';
$i = 0;
foreach (prs::select__record() as $t => $s) {

    $serv .= '
    <div class=" bottom-head" style="float:' . $trans['ALIGN'][$l] . '">
        <a href="Services/' . $s['id'] . '/' . str_replace(' ', '_', $s['service_' . $l]) . '">
                        <div class="buy-media">
                            <i class="buy"> </i>
                                <h6>' . $s['service_' . $l] . '</h6>
                        </div>
                    </a>
                    </div>';
    if ($i <= 2) {
        $serv_bottom .= '
      <div class="col-md-4 service-top1" dir="' . $trans['DIR'][$l] . '" style="float:' . $trans['ALIGN'][$l] . '">
                    <div class=" ser-grid">
                        <a href="#" class="hi-icon hi-icon-archive glyphicon glyphicon-user"> </a>
                    </div>
                    <div class="ser-top">
                        <h4>' . $s['service_' . $l] . '</h4>
                        <p>' . mb_substr($s['about_service_' . $l], 0, 150, 'UTF8') . ' ..
                        <a href="">' . $trans['READ_MORE'][$l] . '</a>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
    ';
    }
    $i++;
}
prs::unSetData();
prs::$table = EQUI_TABLE;
prs::$limit = 3;
prs::$order = 'id DESC';
$equipments = '';
foreach (prs::select__record() as $t => $s) {
    $equipments .= '
      <div class="col-md-4 box_2" style="float:' . $trans['ALIGN'][$l] . '">
                <a href="single.html" class="mask">
                    <img class="img-responsive zoom-img" src="images/equipments/' . $s['photo'] . '" alt="">
                    <!--<span class="four">40,000$</span> -->
                </a>
                <div class="most-1">
                    <h5><a href="#">' . $s['name_' . $l] . '</a></h5>
                </div>
            </div>';
}
prs::unSetData();
prs::$table = COMPANY_TABLE;
prs::$select_cond = array('data_type' => 'background');
$company_background = '';
foreach (prs::select__record() as $t => $back) {
    $company_background = $back['data_' . $l];
}
$projects = '';

foreach ($fun->GetProjects(4) as $to) {
    $url = str_replace(' ', '_', $to['title_' . $l]);
    $projects .= '
         <div class="col-md-3 project-grid" style="float:' . $trans['ALIGN'][$l] . ';direction:' . $trans['DIR'][$l] . '">
                    <div class="project-grid-top">
                        <a href="single.html" class="mask">
                        <img src="images/project_media/' . $to['id'] . '/' . $fun->GetProjectsMedia($to['id'], true) . '" class="img-responsive zoom-img"
                                                                alt=""/></a>
                        <div class="col-md1">
                            <div class="col-md2">
                               
                                <div class="col-md4">
                                    <strong>' . $to['title_ar'] . '</strong>
                                    <small>50 Views</small>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <p>' . $fun->GetCityName($to['city_id']) . '</p>
                            
                            <a href="Project/' . $to['id'] . '/' . $url . '" class="hvr-sweep-to-right more">See Details</a>
                        </div>
                    </div>
                </div>
    ';
}
prs::unSetData();
prs::$table = SLIDES_TABLE;
$i = 1;
$sliders = prs::select__record();
$style = "<style>";
$div = "";
if (!empty(prs::select__record())) {

    foreach ($sliders as $t => $s) {
        $style .= '
        .banner' . $i . '{
	background: url(images/slides/' . $s['image'] . ') no-repeat;
	width:100%;
	min-height: 550px;
	background-size: cover;
	-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
}
        ';
        $div .= '
             <li>
                        <div class="banner' . $i . ' banners_">
                            <div class="caption" style="' . $trans['ALIGN'][$l] . ':13%;">
                                <h3><span>' . $s['slide_text_' . $l] . '</span></h3>
                             
                            </div>
                        </div>
                    </li>
        ';
        $i++;
    }
    $style .= "</style>";
}
echo $style;
?>

<!--Slides-->
<div class=" header-right">
    <div class=" banner">
        <div class="slider">
            <div class="callbacks_container">
                <ul class="rslides" id="slider">
                    <?= $div ?>
                </ul>
                <?php
                if (isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])){
                ?>
                <!--                <div class="updateSlides">-->
                <!--                    <button class="btn btn-danger btn-lg show-slides-dialog">Update Slides-->
                <!--                        <i class="fa fa-photo-video"></i>-->
                <!--                    </button>-->
                <!--                </div>-->
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!--Company Services-->
<div class="banner-bottom-top">
    <div class="container">
        <div class="bottom-header">
            <div class="header-bottom">
                <?= $serv ?>
                <!--                <div class=" bottom-head">-->
                <!--                    <a href="buy.html">-->
                <!--                        <div class="buy-media">-->
                <!--                            <i class="buy"> </i>-->
                <!--                            <h6>Buy</h6>-->
                <!--                        </div>-->
                <!--                    </a>-->
                <!--                </div>-->

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--//-->

<!--//header-bottom-->


<!--//header-->
<!--content-->
<div class="content">
    <div class="content-grid">
        <div class="container">
            <h3><?= $trans['latest_equ'][$l] ?></h3>
            <?= $equipments ?>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--service-->
    <div class="services">
        <div class="container">
            <div class="service-top">
                <h3><?= $trans['services'][$l] ?></h3>
                <p>نطمح للريادة في التوسع وتغطية مشاريع البنية التحتية المدنية ، مشاريع خدمات النفط والغاز ، والخدمات
                    العامة في اليمن والإقليم
                </p>
            </div>
            <div class="services-grid">
                <?= $serv_bottom ?>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
    <!--//services-->
    <!--features-->
    <div class="content-middle">
        <div class="container">
            <div class="mid-content" dir="<?= $trans['DIR'][$l] ?>" style="float: <?= $trans['ALIGN_NATIVE'][$l] ?>">
                <h3><?= $trans['ABOUT_COMPANY'][$l] ?></h3>
                <p><?= mb_substr($company_background, 0, 150, 'UTF8') . '...' ?>
                </p>
                <a class="hvr-sweep-to-right more-in" href="single.html"><?= $trans['READ_MORE'][$l] ?></a>
            </div>
        </div>
    </div>
    <!--//features-->

    <!--project--->
    <div class="project">
        <div class="container">
            <h3><?= $trans['LATEST_PROJECTS'][$l] ?></h3>
            <div class="project-top">
                <?= $projects ?>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--//project-->

    <!--partners-->
    <div class="content-bottom1">
        <h3><?= $trans['Partners'][$l] ?></h3>
        <div class="container">
            <ul>
                <li><a href="#"><img class="img-responsive" src="images/lg.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg1.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg2.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg3.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg4.png" alt=""></a></li>
                <div class="clearfix"></div>
            </ul>
            <ul>
                <li><a href="#"><img class="img-responsive" src="images/lg5.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg6.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg7.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg8.png" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="images/lg9.png" alt=""></a></li>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
    <!--//partners-->
</div>