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
            </div>
        </div>
    </div>
</div>
<!--content-->
<div class="content ">
    <div class="content-grid">
        <div class="container">
            <h3 style="color: black"><?= $trans['SECTORS'][$l] ?></h3>
            <div class="row hideme">
                <?php
                $i = 0;
                foreach ($sec as $da) {
                    ?>
                    <div class="col-md-4 col-sm-12 col-xs-12 boxData" style="float:<?= $trans['ALIGN'][$l] ?>">
                        <?php
                        if (isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) {
                            ?>
                            <div class="trash_btn">
                                <a class="btn btn-danger" href="javascript:;"
                                   onclick="DeleteData('sectors',<?= $da['id'] ?>)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-md-5" style="padding: 0;margin: -15px">
                            <img src="images/sectors/<?= $fun->GetCoverMedia($da['id'], 'sectors') ?>" class="img">
                        </div>
                        <div class="col-md-7 info">
                            <h4>
                                <a href="Sectors/<?= $da['id'] ?>/<?= $fun->CreateUrlName($da['title']) ?>"><?= $da['title'] ?></a>
                            </h4>
                            <p>
                                <?= $da['about'] ?>
                            </p>
                        </div>
                    </div>
                    <?php
                    $i++;
                    if ($i > 3) {
                        $i = 0;
                        echo '</div>
                      <div class="clearfix"></div>
            <div class="row hideme">
                      ';
                    }
                }
                ?>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>

    <!--features-->
    <div class="content-middle">
        <div class="container">
            <div class="mid-content" dir="<?= $trans['DIR'][$l] ?>" style="float: <?= $trans['ALIGN_NATIVE'][$l] ?>">
                <h3><?= $trans['ABOUT_COMPANY'][$l] ?></h3>
                <p><?= mb_substr($company_background, 0, 150, 'UTF8') . '...' ?>
                </p>
                <a class="hvr-sweep-to-right more-in" href="Company/Profile/"><?= $trans['READ_MORE'][$l] ?></a>
            </div>
        </div>
    </div>
    <!--    //features-->
    <!--    News & Social-->
    <div class="project">
        <div class="container">
            <h3><?= $trans['NEWS'][$l] ?></h3>
            <div class="project-top">
                <div class="row">
                    <?php
                    foreach ($pages as $news) {

                        ?>
                        <div class="col-md-3 col-sm-12 col-xs-12" style="float:<?= $trans['ALIGN'][$l] ?>">
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
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

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