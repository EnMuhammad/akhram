<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;
use Languages\Lang_database as lang;

$lang = new lang();
$fun = new fun();
$trans = $lang->Translations();
$l = $lang->GetLanguage();
if (isset($_GET['pid'])) {
    $fun->project_id = intval($_GET['pid']);
    $proj = $fun->GetProjectInfo($l);
} else {
    exit();
}
?>
<div class=" banner-buying">
    <div class=" container">
        <h3><?= $proj['title'] ?></h3>
        <!---->
        <div class="menu-right">
            <ul class="menu">
                <li class="item1"><a href="#"> Menu<i class="glyphicon glyphicon-menu-down"> </i> </a>
                    <ul class="cute">
                        <li class="subitem1"><a href="buy.html">Buy </a></li>
                        <li class="subitem2"><a href="buy.html">Rent </a></li>
                        <li class="subitem3"><a href="buy.html">Hostels </a></li>
                        <li class="subitem1"><a href="buy.html">Resale </a></li>
                        <li class="subitem2"><a href="loan.html">Home Loan</a></li>
                        <li class="subitem3"><a href="buy.html">Apartment </a></li>
                        <li class="subitem3"><a href="dealers.html">Dealers</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <!--initiate accordion-->


    </div>
</div>
<!--//header-->
<div class="container">

    <div class="buy-single-single">

        <div class="col-md-9 single-box">

            <div class=" buying-top">
                <div class="flexslider">
                    <ul class="slides">
                        <li data-thumb="images/ss.jpg">
                            <img src="images/ss.jpg"/>
                        </li>
                        <li data-thumb="images/ss1.jpg">
                            <img src="images/ss1.jpg"/>
                        </li>
                        <li data-thumb="images/ss2.jpg">
                            <img src="images/ss2.jpg"/>
                        </li>
                        <li data-thumb="images/ss3.jpg">
                            <img src="images/ss3.jpg"/>
                        </li>
                    </ul>
                </div>
                <!-- FlexSlider -->
                <script defer src="js/jquery.flexslider.js"></script>
                <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>

                <script>
                    // Can also be used with $(document).ready()
                    $(window).load(function () {
                        $('.flexslider').flexslider({
                            animation: "slide",
                            controlNav: "thumbnails"
                        });
                    });
                </script>
            </div>
            <div class="buy-sin-single">
                <div class="col-sm-5 middle-side immediate">
                    <h4>Information</h4>
                    <p><span class="bath">City </span><br> <span class="two"><?= $proj['city'] ?></span></p>
                    <p><span class="bath1">Service </span><br> <span class="two"><a href="#"><?= $proj['service'] ?></a></span>
                    </p>
                    <p><span class="bath2">Date Start - End</span><br> <span
                                class="two"><?= $proj['date_start'] . ' - ' . $proj['date_end'] ?></span></p>
                    <p><span class="bath3">Advisors </span><br><span class="two"> <?= $proj['ads'] ?></span></p>
                    <p><span class="bath4">Client</span> <br> <span class="two"><?= $proj['Client'] ?></span></p>
                    <p><span class="bath5">Contract Type </span><br><span class="two"> <?= $proj['contract'] ?></span>
                    </p>

                </div>
                <div class="col-sm-7 buy-sin">
                    <h4>Description</h4>
                    <p>
                    <ul>
                        <?php
                        for ($i = 0; $i < count($proj['Task']); $i++) {
                            echo '<li>' . $proj['Task'][$i] . '</li>';
                        }
                        ?>
                    </ul>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--            <div class="map-buy-single">-->
            <!--                <h4>Project On Map</h4>-->
            <!--                <div class="map-buy-single1">-->
            <!--                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d37494223.23909492!2d103!3d55!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x453c569a896724fb%3A0x1409fdf86611f613!2sRussia!5e0!3m2!1sen!2sin!4v1415776049771"></iframe>-->
            <!---->
            <!--                </div>-->
            <!--            </div>-->

        </div>


        <div class="col-md-3">
            <div class="single-box-right right-immediate">
                <h4>Featured Communities</h4>
                <div class="single-box-img ">
                    <div class="box-img">
                        <a href="single.html"><img class="img-responsive" src="images/sl.jpg" alt=""></a>
                    </div>
                    <div class="box-text">
                        <p><a href="single.html">Lorem ipsum dolor sit amet</a></p>
                        <a href="single.html" class="in-box">More Info</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="single-box-img">
                    <div class="box-img">
                        <a href="single.html"><img class="img-responsive" src="images/sl1.jpg" alt=""></a>
                    </div>
                    <div class="box-text">
                        <p><a href="single.html">Lorem ipsum dolor sit amet</a></p>
                        <a href="single.html" class="in-box">More Info</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="single-box-img">
                    <div class="box-img">
                        <a href="single.html"><img class="img-responsive" src="images/sl2.jpg" alt=""></a>
                    </div>
                    <div class="box-text">
                        <p><a href="single.html">Lorem ipsum dolor sit amet</a></p>
                        <a href="single.html" class="in-box">More Info</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="single-box-img">
                    <div class="box-img">
                        <a href="single.html"><img class="img-responsive" src="images/sl3.jpg" alt=""></a>
                    </div>
                    <div class="box-text">
                        <p><a href="single.html">Lorem ipsum dolor sit amet</a></p>
                        <a href="single.html" class="in-box">More Info</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="single-box-img">
                    <div class="box-img">
                        <a href="single.html"><img class="img-responsive" src="images/sl4.jpg" alt=""></a>
                    </div>
                    <div class="box-text">
                        <p><a href="single.html">Lorem ipsum dolor sit amet</a></p>
                        <a href="single.html" class="in-box">More Info</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
