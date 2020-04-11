<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use PROCESS\prs as prs;

prs::unSetData();
prs::$table = SECT_TABLE;
$s = prs::select__record();

prs::unSetData();
prs::$table = BRAN_TABLE;
$br = prs::select__record();
?>
<!-- breadcrumbs -->
<nav aria-label="breadcrumb" dir="rtl">
    <ol class="breadcrumb d-flex justify-content-center">
        <li class="breadcrumb-item">
            <a href="index.html">الرئيسية</a>
        </li>
        <li class="breadcrumb-item active font-weight-bold" aria-current="page">القطاعات والفروع</li>
    </ol>
</nav>
<!-- //breadcrumbs -->
<!-- team -->

<div class=" container">
    <div class="row">
        <section class="col-md-4 col-sm-12 col-lg-4 col-xs-12" style="padding:10px 5px ">

            <h3 class="title-head-w3l" style="text-align: center;">الفروع</h3>
            <div class="alert alert-success">
                <form class="form-horizontal">
                    <input type="search" class="form-control" placeholder="بحث عن فرع">
                </form>
            </div>
            <div class="row team_wthree py-4 py-4 py-lg-5"
                 style="padding-bottom: 2rem !important;padding-top: 1rem !important;">
                <?php
                foreach ($br as $y => $i) {
                    ?>
                    <div class="col-lg-12 mt-lg-0 mt-4" style="background-color: white">

                        <div class="team-text mt-4" style="text-align: right;direction: rtl;">
                            <h4 style="background-color: #2f72c3;color: white;padding: 15px"> <?= $i['name'] ?></h4>
                            <hr>
                            <p>رقم الهاتف:
                                <?= $i['phone'] ?>
                            </p>
                            <p>البريد الالكتروني:
                                <?= $i['email_contact'] ?>
                            </p>
                            <p>رقم الفاكس:
                                <?= $i['fax'] ?>
                            </p>
                            <p>العنوان:
                                <?= $i['address'] ?>
                            </p>
                            <hr>
                            <a href="News/branch/id=<?= $i['id'] ?>">
                                <span class="fa fa-globe "></span>
                                أخبار عن الفرع
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>


            </div>
        </section>
        <section class=" col-md-8 col-sm-12 col-lg-8 col-xs-12" id="team" dir="rtl" style="">
            <div class="container py-lg-4">
                <h3 class="title-head-w3l" style="text-align: right">القطاعات</h3>
                <div class="alert alert-info">
                    <form class="form-horizontal">
                        <input type="search" class="form-control" placeholder="بحث عن قطاع">
                    </form>
                </div>
                <div class="row py-4 py-lg-5" style="padding-bottom: 1rem !important;padding-top: 0px !important;">


                    <?php
                    foreach ($s as $ky => $item) {
                        ?>
                        <div class="col-lg-6 mt-lg-0 mt-4" style="-webkit-box-shadow: 12px 4px 8px -7px rgba(0,0,0,0.75);
-moz-box-shadow: 12px 4px 8px -7px rgba(0,0,0,0.75);
box-shadow: 12px 4px 8px -7px rgba(0,0,0,0.75);">
                            <div class="team-text mt-4" style="text-align: right;direction: rtl;padding: 17px;">
                                <h4><?= $item['name'] ?></h4>
                                <span class="my-2 d-block">عن القطاع</span>
                                <p><?= $item['about'] ?></p>
                                <hr>
                                <div class="footerv4-social d-flex align-items-center">
                                    <ul class="d-flex">
                                        <li>
                                            <a href="News/sectors/id=<?= $item['id'] ?>">
                                                <span class="fa fa-globe icon_facebook"></span>
                                                أخبار عن القطاع
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>

        </section>
    </div>
</div>
<!-- //team -->

<!-- team -->

<!-- //team -->