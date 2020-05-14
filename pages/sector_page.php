<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;
use Languages\Lang_database as lang;

if (isset($_GET['sid'])) {
    $lang = new lang();
    $trans = $lang->Translations();
    $l = $lang->GetLanguage();
    $fun = new fun();
    $fun->sector_id = intval($_GET['sid']);
    $data = $fun->GetSectorFullData($l);

    ?>
    <div class=" banner-buying">
        <div class=" container">
            <h3><?= $data['title'] ?></h3>
            <!---->
        </div>
    </div>
    <!--//header-->
    <div class="about">
        <div class="about-head">
            <div class="container">
                <h3>Overview</h3>
                <div class="about-in">
                    <a href="blog_single.html"><img src="images/at.jpg" alt="image" class="img-responsive "> </a>

                    <p>
                        <?= $data['about'] ?>
                    </p>
                </div>
            </div>
        </div>
        <!---->
        <div class="about-middle">
            <div class="container">
                <?php
                $x = 0;
                foreach ($data['services'] as $key => $p) {
                    ?>
                    <div class="row">
                        <div class="col-md-8 about-mid" <?= (($x == 1) ? "style='float:right;'" : "style='float:left;'") ?>>
                            <h4><?= $p['title'] ?></h4>
                            <h6><a href="blog_single.html"></a></h6>
                            <p><?= $p['about'] ?></p>
                        </div>
                        <div class="col-md-4 about-mid1"
                             style="background:url('public/images/services/<?= $fun->GetCoverMedia($p['id'], 'services') ?>') ;background-repeat: no-repeat;background-size: cover;<?= (($x == 1) ? "'float:left;'" : "'float:right;'") ?>">

                            <a href="blog_single.html" class="hvr-sweep-to-right more-in">READ MORE</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                    $x++;
                    if ($x == 2) {
                        $x = 0;
                    }
                }
                ?>

            </div>
        </div>
        <!---->

        <!---->

        <!---->
        <div class="container">
            <div class="content-events">
                <h3> Related Projects</h3>
                <div class="news">
                    <div class="col-md-4 new-more">
                        <div class="event">
                            <h4>26/06/2015</h4>
                            <h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
                        </div>
                        <p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u
                            lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades
                            goertayse</p>
                        <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
                    </div>
                    <div class="col-md-4 new-more">
                        <div class="event">
                            <h4>26/06/2015</h4>
                            <h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
                        </div>
                        <p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u
                            lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades
                            goertayse</p>
                        <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
                    </div>
                    <div class="col-md-4 new-more">
                        <div class="event">
                            <h4>26/06/2015</h4>
                            <h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
                        </div>
                        <p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u
                            lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades
                            goertayse</p>
                        <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="news">
                    <div class="col-md-4 new-more">
                        <div class="event">
                            <h4>26/06/2015</h4>
                            <h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
                        </div>
                        <p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u
                            lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades
                            goertayse</p>
                        <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
                    </div>
                    <div class="col-md-4 new-more">
                        <div class="event">
                            <h4>26/06/2015</h4>
                            <h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
                        </div>
                        <p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u
                            lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades
                            goertayse</p>
                        <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
                    </div>
                    <div class="col-md-4 new-more">
                        <div class="event">
                            <h4>26/06/2015</h4>
                            <h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
                        </div>
                        <p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u
                            lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades
                            goertayse</p>
                        <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!---->

    </div>
    <?php
}