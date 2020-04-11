<?php

use Fun\functions as fun;
use Languages\Lang_database as lang;
use PROCESS\prs as prs;

$lang = new lang();
$fun = new fun();
$trans = $lang->Translations();
$l = $lang->GetLanguage();
$service_array = array();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    prs::unSetData();
    prs::$table = SERVICES_TABLE;
    prs::$select_cond = array('id' => $id);
    foreach (prs::select__record() as $r => $s) {
        $service_array['name'] = $s['service_' . $l];
        $service_array ['about'] = $s['about_service_' . $l];
    }
} else {
    exit();
}
?>
<style>
    .banner-buying h3 {
    <?=(($l == 'ar')?"float: right;!important;":"") ?>

    }
</style>
<div class=" banner-buying">
    <div class=" container">
        <h3><?= $service_array['name'] ?></h3>
        <!---->

        <div class="clearfix"></div>
        <!--initiate accordion-->


    </div>
</div>
<!--//header-->
<div class="container">

    <!--price-->
    <div class="price" dir="rtl">
        <div class="price-grid">
            <div class="col-sm-4 price-top" style="<?= (($l == 'ar') ? "float:right;" : "") ?>">
                <h4>الخدمة</h4>
                <select class="in-drop service-list">
                    <option value="0">أختر خدمة</option>
                    <?php
                    foreach ($fun->GetServices() as $k => $serv) {
                        echo '<option value="' . $serv['id'] . '">' . $serv['service_' . $l] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-4 price-top" style="<?= (($l == 'ar') ? "float:right;" : "") ?>">
                <h4>المدينة</h4>
                <select class="in-drop project-list" disabled>
                    <option value="0">Select</option>
                </select>
            </div>
            <div class="col-sm-4 price-top" style="<?= (($l == 'ar') ? "float:right" : "") ?>">
                <h4>المشروع</h4>
                <select class="in-drop" disabled>
                    <option>Select</option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <!---->
    <div class="top-grid">
        <h3>المشاريع المرتبطة</h3>
        <div class="grid-at">
            <div class="col-md-3 grid-city">
                <div class="grid-lo">
                    <a href="buy_single.html">
                        <figure class="effect-layla">
                            <img class=" img-responsive" src="images/ce.jpg" alt="img06">
                            <figcaption>
                                <h4>London</h4>

                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
            <div class="col-md-3 grid-city">
                <div class="grid-lo">
                    <a href="buy_single.html">
                        <figure class="effect-layla">
                            <img class=" img-responsive" src="images/ce1.jpg" alt="img06">
                            <figcaption>
                                <h4>Sydney</h4>

                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
            <div class="col-md-6 grid-city grid-city1">
                <div class="grid-me">
                    <div class="col-md-8 grid-lo1">
                        <div class=" grid-lo">
                            <a href="buy_single.html">
                                <figure class="effect-layla">
                                    <img class=" img-responsive" src="images/ce2.jpg" alt="img06">
                                    <figcaption>
                                        <h4 class="effect1">New York</h4>

                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 grid-lo2">
                        <div class=" grid-lo">
                            <a href="buy_single.html">
                                <figure class="effect-layla">
                                    <img class=" img-responsive" src="images/ce3.jpg" alt="img06">
                                    <figcaption>
                                        <h4 class="effect2">Rome</h4>

                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="grid-me">
                    <div class="col-md-6 grid-lo3">
                        <div class=" grid-lo">
                            <a href="buy_single.html">
                                <figure class="effect-layla">
                                    <img class="img-responsive" src="images/ce4.jpg" alt="img06">
                                    <figcaption>
                                        <h4 class="effect3">Singapore</h4>

                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 grid-lo4">
                        <div class=" grid-lo">
                            <a href="buy_single.html">
                                <figure class="effect-layla">
                                    <img class="img-responsive" src="images/ce5.jpg" alt="img06">
                                    <figcaption>
                                        <h4 class="effect3">Paris</h4>

                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>
<!---->

<!---->
<div class="container">
    <div class="future">
        <h3>أحــدث المعدات</h3>
        <div class="content-bottom-in">
            <ul id="flexiselDemo1">
                <li>
                    <div class="project-fur">
                        <a href="single.html"><img class="img-responsive" src="images/pi.jpg" alt=""/> </a>
                        <div class="fur">
                            <div class="fur1">
                                <span class="fur-money">$2.44 Lacs - 5.28 Lacs </span>
                                <h6 class="fur-name"><a href="single.html">Contrary to popular</a></h6>
                                <span>Paris</span>
                            </div>
                            <div class="fur2">
                                <span>2 BHK</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="project-fur">
                        <a href="single.html"><img class="img-responsive" src="images/pi1.jpg" alt=""/> </a>
                        <div class="fur">
                            <div class="fur1">
                                <span class="fur-money">$2.44 Lacs - 5.28 Lacs </span>
                                <h6 class="fur-name"><a href="single.html">Contrary to popular</a></h6>
                                <span>Paris</span>
                            </div>
                            <div class="fur2">
                                <span>2 BHK</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="project-fur">
                        <a href="single.html"><img class="img-responsive" src="images/pi2.jpg" alt=""/> </a>
                        <div class="fur">
                            <div class="fur1">
                                <span class="fur-money">$2.44 Lacs - 5.28 Lacs </span>
                                <h6 class="fur-name"><a href="single.html">Contrary to popular</a></h6>
                                <span>Paris</span>
                            </div>
                            <div class="fur2">
                                <span>2 BHK</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="project-fur">
                        <a href="single.html"><img class="img-responsive" src="images/pi3.jpg" alt=""/> </a>
                        <div class="fur">
                            <div class="fur1">
                                <span class="fur-money">$2.44 Lacs - 5.28 Lacs </span>
                                <h6 class="fur-name"><a href="single.html">Contrary to popular</a></h6>
                                <span>Paris</span>
                            </div>
                            <div class="fur2">
                                <span>2 BHK</span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <script type="text/javascript">
                $(window).load(function () {
                    $("#flexiselDemo1").flexisel({
                        visibleItems: 4,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                            portrait: {
                                changePoint: 480,
                                visibleItems: 1
                            },
                            landscape: {
                                changePoint: 640,
                                visibleItems: 2
                            },
                            tablet: {
                                changePoint: 768,
                                visibleItems: 3
                            }
                        }
                    });

                });
            </script>
            <script type="text/javascript" src="js/jquery.flexisel.js"></script>
        </div>
    </div>
</div>