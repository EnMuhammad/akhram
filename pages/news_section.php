<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use PROCESS\prs as prs;

if (isset($_GET['search'])) {
    $type = $_GET['search'];
    $id = $_GET['id'];
    $search = true;

} else {
    $search = false;
    $id = 0;
    $type = '';
}
prs::unSetData();
prs::$table = NEWS_TABLE;
prs::$select_cond = array('published' => 1);
if ($search) {
    if ($type == 'sectors') {
        prs::$select_cond['sc_id'] = $id;
    } else if ($type == 'branch') {
        prs::$select_cond['br_id'] = $id;
    }
}
prs::$order = 'date DESC';
$news = prs::select__record();
?>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb d-flex justify-content-center">
        <li class="breadcrumb-item">
            <a href="home">الرئيسية</a>
        </li>
        <li class="breadcrumb-item active font-weight-bold" aria-current="page">الأخبــار</li>
    </ol>
</nav>
<!-- //breadcrumbs -->
<!-- portfolio -->
<section class="wthree-row w3-gallery cliptop-portfolio-wthree py-lg-5 pt-4" id="portfolio">
    <div class="container">
        <h3 class="title-head-w3l" style="text-align: right">قائمة الاخبار</h3>
        <ul class="demo row my-4 py-lg-5">
            <?php
            if (!empty($news)) {
                $x = 0;
                foreach ($news as $i => $n) {

                    prs::unSetData();
                    prs::$table = NEWS_MEDIA_TABLE;
                    prs::$select_cond = array('nid' => $n['id'], 'media_type' => 'image/jpeg');
                    prs::$limit = 1;
                    if (!empty(prs::select__record())) {
                        $image = prs::select__record()[0]['media_url'];
                    } else {
                        $image = false;
                    }
                    $x++;
                    ?>
                    <li class="col-lg-4 col-sm-6 <?= (($x == 2) ? "my-4" : "mt-sm-0 mt-4") ?>">
                        <div class="gallery-grid1" dir="rtl">
                            <?php
                            if ($x == 2) {
                                if ($image != false) {
                                    ?>
                                    <a href="#"><img src="files/<?= $image ?>" alt=" " class="img-fluid"/></a>
                                    <?php
                                }
                            }

                            ?>
                            <div class="p-mask img-thumbnail">
                                <h4 style="text-align: center">
                                    <a href="#"><?= mb_substr($n['title'], 0, 25, 'UTF8') ?></a></h4>
                                <hr>
                                <p style="text-align: right"><?= mb_substr($n['content'], 0, 80, 'UTF8') . '..<a href="#">قراءة الخبر</a>' ?></p>
                            </div>
                            <?php
                            if ($x != 2) {
                                if ($image != false) {
                                    ?>
                                    <a href="#"><img src="files/<?= $image ?>" alt=" " class="img-fluid"/></a>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </li>
                    <?php

                    if ($x == 2) {
                        $x = 0;
                    }
                }

            } else {


                ?>
                <li class="col-lg-12 col-sm-12 ">
                    <div class="p-mask img-thumbnail">
                        <h4 style="text-align: center"> لا يوجد اخبار</h4>
                    </div>
                </li>
                <?php
            }
            ?>

        </ul>
    </div>
</section>
