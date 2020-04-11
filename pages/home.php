<?php

use Languages\Lang_database as lang;
use PROCESS\prs as prs;

$lang = new lang();
$trans = $lang->Translations();
$l = $lang->GetLanguage();
//$trans[''][$l];
prs::unSetData();
prs::$table = SERVICES_TABLE;
$serv = '';
foreach (prs::select__record() as $t => $s) {
    $serv .= '
    <div class=" bottom-head">
        <a href="Services/' . $s['id'] . '/' . str_replace(' ', '_', $s['service_' . $l]) . '">
                        <div class="buy-media">
                            <i class="buy"> </i>
                                <h6>' . $s['service_' . $l] . '</h6>
                        </div>
                    </a>
                    </div>';

}
prs::unSetData();
prs::$table = WORK_TABLE;
prs::$limit = 3;
$projects = '';
foreach (prs::select__record() as $t => $s) {
    $projects .= '
      <div class="col-md-4 box_2">
                <a href="single.html" class="mask">
                    <img class="img-responsive zoom-img" src="images/pc4.jpg" alt="">
                    <!--<span class="four">40,000$</span> -->
                </a>
                <div class="most-1">
                    <h5><a href="single.html">' . $s['title_en'] . '</a></h5>
                    <p>' . $s['city_en'] . '</p>
                </div>
            </div>';

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
                            <div class="caption">
                                <h3><span>' . $s['text_slide_info'] . '</span></h3>
                             
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
            </div>
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
            <?= $projects ?>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--service-->
    <div class="services">
        <div class="container">
            <div class="service-top">
                <h3><?= $trans['services'][$l] ?></h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="services-grid">
                <div class="col-md-6 service-top1">
                    <div class=" ser-grid">
                        <a href="#" class="hi-icon hi-icon-archive glyphicon glyphicon-user"> </a>
                    </div>
                    <div class="ser-top">
                        <h4>Ut wisi enim ad</h4>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text.
                            It has roots in a piece of classical.Contrary to popular belief, Lorem Ipsum </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-6 service-top1">
                    <div class=" ser-grid">
                        <a href="#" class="hi-icon hi-icon-archive glyphicon glyphicon-leaf"> </a>
                    </div>
                    <div class="ser-top">
                        <h4>Ut wisi enim ad</h4>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text.
                            It has roots in a piece of classical.Contrary to popular belief, Lorem Ipsum </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="services-grid">
                <div class="col-md-6 service-top1">
                    <div class=" ser-grid">
                        <a href="#" class="hi-icon hi-icon-archive glyphicon glyphicon-cog"> </a>
                    </div>
                    <div class="ser-top">
                        <h4>Ut wisi enim ad</h4>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text.
                            It has roots in a piece of classical.Contrary to popular belief, Lorem Ipsum </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-6 service-top1">
                    <div class=" ser-grid">
                        <a href="#" class="hi-icon hi-icon-archive glyphicon glyphicon-file"> </a>
                    </div>
                    <div class="ser-top">
                        <h4>Ut wisi enim ad</h4>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text.
                            It has roots in a piece of classical .Contrary to popular belief, Lorem Ipsum</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--//services-->
    <!--features-->
    <div class="content-middle">
        <div class="container">
            <div class="mid-content">
                <h3>the best features</h3>
                <p>Contrary to popular belief
                    , Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from
                    45 BC, making it over 2000 years old.</p>
                <a class="hvr-sweep-to-right more-in" href="single.html">Read More</a>
            </div>
        </div>
    </div>
    <!--//features-->

    <!--project--->
    <div class="project">
        <div class="container">
            <h3><?= $trans['LATEST_PROJECTS'][$l] ?></h3>
            <div class="project-top">
                <div class="col-md-3 project-grid">
                    <div class="project-grid-top">
                        <a href="single.html" class="mask"><img src="images/ga.jpg" class="img-responsive zoom-img"
                                                                alt=""/></a>
                        <div class="col-md1">
                            <div class="col-md2">
                                <div class="col-md3">
                                    <span class="star"> 4.5</span>
                                </div>
                                <div class="col-md4">
                                    <strong>Venice</strong>
                                    <small>50 Reviews</small>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <p>2, 3, 4 BHK Flats</p>
                            <p class="cost">$65,000</p>
                            <a href="single.html" class="hvr-sweep-to-right more">See Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 project-grid">
                    <div class="project-grid-top">
                        <a href="single.html" class="mask"><img src="images/ga1.jpg" class="img-responsive zoom-img"
                                                                alt=""/></a>
                        <div class="col-md1">
                            <div class="col-md2">
                                <div class="col-md3">
                                    <span class="star"> 4.5</span>
                                </div>
                                <div class="col-md4">
                                    <strong>Venice</strong>
                                    <small>50 Reviews</small>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <p>2, 3, 4 BHK Flats</p>
                            <p class="cost">$65,000</p>
                            <a href="single.html" class="hvr-sweep-to-right more">See Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 project-grid">
                    <div class="project-grid-top">
                        <a href="single.html" class="mask"><img src="images/ga2.jpg" class="img-responsive zoom-img"
                                                                alt=""/></a>
                        <div class="col-md1">
                            <div class="col-md2">
                                <div class="col-md3">
                                    <span class="star"> 4.5</span>
                                </div>
                                <div class="col-md4">
                                    <strong>Venice</strong>
                                    <small>50 Reviews</small>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <p>2, 3, 4 BHK Flats</p>
                            <p class="cost">$65,000</p>
                            <a href="single.html" class="hvr-sweep-to-right more">See Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 project-grid">
                    <div class="project-grid-top">
                        <a href="single.html" class="mask"><img src="images/ga3.jpg" class="img-responsive zoom-img"
                                                                alt=""/></a>
                        <div class="col-md1">
                            <div class="col-md2">
                                <div class="col-md3">
                                    <span class="star"> 4.5</span>
                                </div>
                                <div class="col-md4">
                                    <strong>Venice</strong>
                                    <small>50 Reviews</small>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <p>2, 3, 4 BHK Flats</p>
                            <p class="cost">$65,000</p>
                            <a href="single.html" class="hvr-sweep-to-right more">See Details</a>
                        </div>
                    </div>
                </div>
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