<?php

use Fun\functions as fun;
use Languages\Lang_database as lang;

if (isset($_GET['id'])) {
    $fun = new fun();
    $lang = new lang();
    $trans = $lang->Translations();
    $l = $lang->GetLanguage();
    $fun->page_id = intval($_GET['id']);
    $page_data = $fun->GetFullPageData($l);
    if (!empty($page_data)) {
        $cover = $fun->GetCoverMedia($fun->page_id, 'pages');

        ?>
        <div class=" banner-buying">
            <div class=" container">
                <h3><?= $page_data['title'] ?></h3>
                <!---->
            </div>
        </div>
        <!--//header-->
        <div class="about">
            <div class="about-head">
                <div class="container">
                    <h3><?= $page_data['title'] ?></h3>
                    <div class="about-in">
                        <a href="#"><img src="images/pages/<?= $cover ?>" alt="image" class="img-responsive "> </a>
                        <h6></h6>
                        <p><?= $page_data['content'] ?></p>
                    </div>
                </div>
            </div>
            <?php
            if (!empty($page_data['media']) || isset($page_data['media'])) {
                ?>
                <div class="about-head">
                    <div class="container">
                        <h3>Media</h3>
                        <div class="col-md-2 hidden-xs hidden-sm"></div>
                        <div class="col-md-8 col-sm-12 col-xs-12  single-box">
                            <div class=" buying-top">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <?php
                                        foreach ($page_data['media'] as $i => $media) {
                                            ?>
                                            <li data-thumb="images/ss.jpg">
                                                <img src="images/pages/<?= $media['url'] ?>"/>
                                            </li>
                                            <?php
                                        }
                                        ?>
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
                                            controlNav: "thumbnails",

                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="col-md-2 hidden-xs hidden-sm"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
        <!--footer-->
        <?php
    } else {
        ?>
        <div class=" banner-buying">
            <div class=" container">
                <h3>Page Not Found</h3>
                <!---->
            </div>
        </div>
        <div class="about-head">
            <div class="container">
                <h3>Page Not Found</h3>
                <div class="about-in">

                    <h6>Error</h6>
                    <p>This Page not found, Go Back to <a href="">Home</a></p>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo 'Error';
}