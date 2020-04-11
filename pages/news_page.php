<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use PROCESS\prs as prs;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    prs::unSetData();
    prs::$table = NEWS_TABLE;
    prs::$select_cond = array('published' => 1, 'id' => $id);
    if (!empty(prs::select__record())) {
        $data = array();
        foreach (prs::select__record() as $t => $d) {
            $data = $d;
        }

        ?>

        <nav aria-label="breadcrumb" dir="rtl">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item">
                    <a href="home">الرئيسية</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="News">الاخبار</a>
                </li>
                <li class="breadcrumb-item active font-weight-bold" aria-current="page"><?= $data['title'] ?></li>
            </ol>
        </nav>
        <section class="wthree-row w3-gallery cliptop-portfolio-wthree py-lg-5 pt-4" id="portfolio">
            <div class="container">

                <div class="row" dir="rtl">

                    <div class="col-md-9 " style="float: right">
                        <div class="New_page">
                            <div class="news_head">
                                <h3 style="font-size: 25px;
    color: white;
    margin: 19px;
    text-decoration: underline;"><?= $data['title'] ?></h3>

                            </div>
                            <div class="news_image"
                                 style="background-image: url('images/ceo2.jpg');background-repeat: no-repeat;background-size: cover;width: 100%;height: 400px"></div>
                            <div class="News_Content">
                                <?php
                                $text = $data['content'];
                                $length = strlen($text);
                                $middle = round($length / 2, 0);
                                $col1 = substr($text, 0, $middle);
                                $col2 = substr($text, $middle);
                                ?>
                                <div class="row">
                                    <div class="col-md-6 first-l">
                                        <?= $col1 ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $col2 ?>
                                    </div>
                                </div>
                                <div class="row" dir="rtl">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 news-footer">
                                        <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_default_style"
                                             style="bottom:0px; left:50%; transform:translateX(-50%)">
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_twitter"></a>
                                            <a class="a2a_button_whatsapp"></a>
                                            <a class="a2a_button_telegram"></a>

                                        </div>

                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <div class="share_div">
                                            تاريخ النشر: <?= $data['date'] ?> - عدد المشاهدات
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  related-data" style="float: right">
                        <h3 style="text-align: center">أخبار متعلقه</h3>
                        <?php
                        $keywords = explode(' ', $data['title']);

                        prs::unSetData();
                        prs::$table = NEWS_TABLE;
                        prs::$select_cond = array('title' => 'LIKE:%' . $keywords[0] . '%');
                        $co = 0;

                        foreach (prs::select__record() as $r => $re) {
                            if ($co <= 2) {
                                $xx = urlencode($re['title']);
                                $xx = str_replace('+', '_', $xx);
                                prs::unSetData();
                                prs::$table = NEWS_MEDIA_TABLE;
                                prs::$select_cond = array('nid' => $re['id'], 'media_type' => 'image/jpeg');
                                prs::$limit = 1;
                                if (!empty(prs::select__record())) {
                                    $image = prs::select__record()[0]['media_url'];
                                } else {
                                    $image = 'logo-yeco.jpg';
                                }
                                ?>
                                <div class="card" style="width: 100%;border: 1px dashed #efefef;text-align: right">
                                    <img class="card-img-top" src="files/<?= $image ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted"><?= $re['date'] ?></h6>
                                        <a href="News/<?= $re['id'] ?>/<?= $xx ?>">
                                            <h5 class="card-title"><?= mb_substr($re['title'], 0, 45, 'UTF8') ?>...</h5>
                                        </a>
                                        <p class="card-text">
                                            <?= mb_substr($re['content'], 0, 60, 'UTF8') ?>...
                                        </p>

                                    </div>
                                </div>
                                <?php
                            }
                            $co++;
                        }
                        ?>


                    </div>
                </div>


            </div>

        </section>
        <?php
    }

}