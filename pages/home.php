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
prs::$table = SECTORS_TABLE;
$sec = array();
foreach (prs::select__record() as $t => $sectors) {
    $sec[] = array(
        'id' => $sectors['id'],
        'title' => $sectors['title_' . $l],
        'about' => mb_substr($sectors['about_' . $l], 0, 20, 'UTF8'),
    );
}
prs::unSetData();
prs::$table = PAGES_TABLE;
prs::$select_cond = array('related_to' => 'news');
$all_news = array();
foreach (prs::select__record() as $t => $pa) {
    $all_news[] = array(
        'id' => $pa['id'],
        'title' => $pa['title_' . $l],
        'date' => $pa['created_on'],
    );
}
prs::unSetData();
prs::$table = PAGES_TABLE;
prs::$select_cond = array('related_to' => 'news');
prs::$limit = 1;
prs::$order = 'id DESC';
$pages = array();
foreach (prs::select__record() as $t => $pa) {
    $pages[] = array(
        'id' => $pa['id'],
        'title' => $pa['title_' . $l],
        'content' => mb_substr($pa['content_' . $l], 0, 200, 'UTF8') . '..',
    );
}

prs::unSetData();
prs::$table = COMPANY_TABLE;
prs::$select_cond = array('data_type' => 'background');
$company_background = '';
foreach (prs::select__record() as $t => $back) {
    $company_background = $back['data_' . $l];
}
prs::unSetData();
prs::$table = MEDIA_TABLE;
prs::$select_cond = array('type' => 'slides');
$i = 1;
$sliders = prs::select__record();
$style = "";
$div = "";
if (!empty(prs::select__record())) {
    $style = "<style>";
    foreach ($sliders as $t => $s) {
        $style .= '
        .banner' . $i . '{
	background: url(images/slides/' . $s['url'] . ') no-repeat;
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
                                <h3><span>' . $s['name_' . $l] . '</span></h3>
                             
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
<!--features-->
<div class="content-middle">
    <div class="container">
        <div class="mid-content" dir="<?= $trans['DIR'][$l] ?>" style="float: <?= $trans['ALIGN_NATIVE'][$l] ?>">
            <h3><?= $trans['ABOUT_COMPANY'][$l] ?></h3>
            <p><?= mb_substr($company_background, 0, 300, 'UTF8') . '...' ?>
            </p>
            <a class="hvr-sweep-to-right more-in" href="Company/Profile/"><?= $trans['READ_MORE'][$l] ?></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="content-grid background-sector-null" style="background: #1c164e">
        <div class="container">
            <h3 style="color: white"><?= $trans['SECTORS'][$l] ?></h3>
            <?php
            foreach ($sec as $da) {
                    ?>
                <div class=" col-md-3 col-sm-12 col-xs-12" style="margin: 10px 0;height: 250px;overflow: hidden;">
                        <a href="Sectors/<?= $da['id'] ?>/<?= $fun->CreateUrlName($da['title']) ?>" class="mask">
                            <img class="img-responsive zoom-img" style="width: 100%;min-height: 200px"
                                 src="images/sectors/<?= $fun->GetCoverMedia($da['id'], 'sectors') ?>" alt="">
                        </a>
                    <?php
                    if (isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) {
                        ?>
                        <span class="four" onclick="DeleteData('sectors',<?= $da['id'] ?>)">
                                    <i class="fa fa-trash"></i>
                            </span>
                        <?php
                    }
                    ?>

                        <div class="most-1">
                            <h5 style="font-size: 14px;font-weight: bold">
                                <a href="Sectors/<?= $da['id'] ?>/<?= $fun->CreateUrlName($da['title']) ?>"><?= $da['title'] ?></a>
                            </h5>
                        </div>
                    </div>
                    <?php

            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>


    <!--//project-->
    <!--test-->

</div>
<!--    //features-->
<!--content-->
<div class="content ">
    <div class="content-grid ">

        <div class="container ">
            <h3 style="padding: 0;color: red" class="red">Projects</h3>
            <div class="row counter-projects hideme">
                <div class="col-md-4 counter-box">
                    <h1><span class="counter">2,523</span></h1>
                    <p>Total Projects</p>

                </div>
                <div class="col-md-4 counter-box">
                    <h1><span class="counter">200</span></h1>
                    <p>Total Cities</p>

                </div>
                <div class="col-md-4 counter-box">
                    <h1><span class="counter">1000</span></h1>
                    <p>Total Customers</p>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 project-section">
                    <ul class="country_taps">
                        <?php
                        $i = 0;
                        foreach ($fun->ServiceCompanyCitiesLang($l) as $city) {
                            echo ' <li ' . (($i == 0) ? 'class="active"' : "") . '><a href="javascript:;" id=' . $city['id'] . '>' . $city['name'] . '</a></li>';
                            $i++;
                        }
                        ?>
                    </ul>
                </div>
                <div class="container">
                    <div class="future">
                        <div class="col-md-12 loading-data" style="display: none;">
                            <div class="loader" style="text-align: center;font-size: 32px;color:red;">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="content-bottom-in">
                            <div class="loadProjects">
                                <ul id="flexiselDemo1">
                                    <?php
                                    foreach ($fun->GetProjectsByCity(0, $l, 10) as $p) {
                                        ?>
                                        <li>
                                            <div class="project-fur">
                                                <a href="#"><img class="img-responsive"
                                                                 src="images/project_media/<?= $fun->GetCoverMedia($p['id'], 'projects') ?>"
                                                                 alt=""/> </a>
                                                <div class="fur">
                                                    <div class="fur1">
                                                        <span class="fur-money"><?= $p['name'] ?> </span>
                                                        <h6 class="fur-name"><a href="#"><?= $p['sector'] ?></a></h6>
                                                        <span><?= $p['city'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
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
                            </div>

                            <script type="text/javascript" src="js/jquery.flexisel.js"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.counterup/1.0/jquery.counterup.min.js"></script>
<script>
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });
    $('.counter').addClass('animated fadeInDownBig');
    $('h3').addClass('animated fadeIn');

</script>
<!--project--->
<?php
prs::unSetData();
prs::$table = MEDIA_TABLE;
//prs::$select_cond = array('type'=>'projects');
$data_media = prs::select__record();
?>
<div class="project" style="padding: 65px 0;background: #1c164e">
    <div class="container">
        <h3 style="color:white" class="white">Media Library</h3>
        <div class="content-bottom-in">
            <div class="loadProjects">
                <ul id="flexiselMedia1">
                    <?php
            foreach ($data_media as $k => $v) {
                if ($v['type'] == 'projects' || $v['type'] == 'items') {
                    $url = (($v['type'] == 'projects') ? 'images/project_media/' . $v['media_id'] . '/' . $v['url'] : 'images/equipments/' . $v['url']);
                    ?>
                    <li>
                        <div class="project-fur">
                            <a href="<?= $url ?>" data-options='{"caption": "<?= $v['name_' . $l] ?>"}'
                               data-fancybox="gallery"><img class="img-responsive"
                                                            src="<?= $url ?>" height="200"
                                                            alt=""/> </a>

                        </div>
                    </li>
                    <?php
                }
            }
                    ?>

                </ul>
                <script type="text/javascript">
                    $(window).load(function () {
                        $("#flexiselMedia1").flexisel({
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
            </div>


        </div>

    </div>
</div>
<!--//project-->
    <!--    News & Social-->
    <div class="project">
        <?php
        if (!empty($all_news) && count($all_news) > 0) {
            ?>
            <div class="container">
                <h3 style="color:red;padding: 40px 0;" class="red"><?= $trans['NEWS'][$l] ?></h3>
                <div class="project-top">
                    <div class="row news-section">
                        <div class="col-md-5 col-sm-12 col-xs-12" style="float:<?= $trans['ALIGN'][$l] ?>;padding: 0">
                            <?php
                            foreach ($pages as $news) {
                                ?>
                                <div class="News_box" dir="<?= $trans['DIR'][$l] ?>">

                                    <div class="col-md-12" style="padding: 0"><img
                                                src="images/pages/<?= $fun->GetCoverMedia($news['id'], 'pages') ?>"
                                                class="img"></div>
                                    <div class="col-md-12">
                                        <div class="share_buttons">
                                            <ul>
                                                <li>Share on:</li>
                                                <li class="social-share facebook">
                                                    <a href="javascript:;"
                                                       onclick="setShareLinks('Page/<?= $news['id'] ?>/<?= $fun->CreateUrlName($news['title']) ?>')"><img
                                                                src="images/share_icons/facebook.png"
                                                                alt="Share Page on Facebook"/></a></li>
                                                <li class="social-share twitter">
                                                    <a href="javascript:;"
                                                       onclick="setShareLinks('Page/<?= $news['id'] ?>/<?= $fun->CreateUrlName($news['title']) ?>')"><img
                                                                src="images/share_icons/twitter.png"
                                                                alt="Share Page on Twitter"/></a></li>
                                            </ul>
                                        </div>
                                        <div class="title_head"><?= $news['title'] ?></div>
                                        <p class="news_contact"><?= nl2br($news['content']) ?></p>
                                    </div>
                                    <div class="footer">

                                        <a href="Page/<?= $news['id'] ?>/<?= $fun->CreateUrlName($news['title']) ?>"><?= $trans['READ_MORE'][$l] ?></a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-7" style="float:<?= $trans['ALIGN_NATIVE'][$l] ?>;padding: 0">
                            <?php
                            if (empty($all_news) || count($news) < 1) {
                                ?>
                                <div class="empty-news">No News Available</div>
                                <?php
                            } else {
                                ?>
                                <table class="table table-hover table-striped table-news" style="background: white">
                                    <tbody>
                                    <?php
                                    foreach ($all_news as $n) {
                                        echo '
                                <tr>
                               <td>
                                   <a href="#">
                                   ' . $n['title'] . '  
                                   <span class="date" style="float:' . $trans['ALIGN_NATIVE'][$l] . '">
                                   ' . date('d-m-Y', strtotime($n['date'])) . '
                                   </span>
                                   </a>
                               </td>

                           </tr>
                               ';
                                    }
                                    ?>


                                    </tbody>
                                </table>
                                <?php
                            }
                            ?>
                            <!--                        -->

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php
        }
        ?>
        <!--        <div class="our_links">-->
        <!--            <h4>Follow us on:</h4>-->
        <!--            <a href="#">-->
        <!--                <img src="images/share_icons/facebook256.png" alt="facebook">-->
        <!--                <img src="images/share_icons/twitter256.png" alt="facebook">-->
        <!--                <img src="images/share_icons/instagram256.png" alt="facebook">-->
        <!--            </a>-->
        <!--        </div>-->
    </div>

    <!--partners-->
    <div class="content-bottom1">
        <!--        <h3>--><? //= $trans['Partners'][$l] ?><!--</h3>-->

    </div>
    <!--//partners-->
</div>