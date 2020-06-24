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
<div class="services" style="padding: 43px 0 0 0">
    <div class="container">
        <div class="service-top" style="padding: 0">
            <h3><?= $trans['ABOUT_SERVICE'][$l] ?></h3>
            <p class="fonter" style="font-size: 19px"><?= $service_array['about'] ?>
            </p>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container">
    <?php
    $fun->service_id = $id;

    if (!empty($fun->GetProjectListByServiceID())) {
        ?>
        <div class="container">
            <div class="future" style="padding: 0 0 12px 0; margin: 20px 0">
                <h3>كافة المشاريع</h3>
                <div class="content-bottom-in">
                    <ul id="flexiselDemo1">
                        <?php

                        foreach ($fun->GetProjectListByServiceID() as $t => $proj) {
                            //                echo ;
                            ?>
                            <li>
                                <div class="project-fur">
                                    <a href="#"><img class="img-responsive"
                                                     src="<?= 'images/project_media/' . $proj['id'] . '/' . $fun->GetProjectsMedia($proj['id'], true) ?>"
                                                     alt=""/> </a>
                                    <div class="fur">
                                        <div class="fur1">
                                            <span class="fur-money"> <?= $proj['contract_type'] ?></span>

                                            <span><?= $proj['title_' . $l] ?></span>
                                        </div>
                                        <div class="fur2">
                                            <span><a href="Project/<?= $proj['id'] ?>/<?= $fun->CreateUrlName($proj['title_' . $l]) ?>">مشاهدة</span>
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
                    <script type="text/javascript" src="js/jquery.flexisel.js"></script>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<!---->

<!---->
