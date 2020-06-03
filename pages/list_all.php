<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;
use Languages\Lang_database as lang;
use PROCESS\prs as prs;

$fun = new fun();
$lang = new lang();
$trans = $lang->Translations();
$l = $lang->GetLanguage();
prs::unSetData();
$data = array();
$title = '';
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    switch ($type) {
        case 'projects':
        default:
            $title = 'Projects';
            prs::$table = PROJECTS_TABLE;
            foreach (prs::select__record() as $t => $pr) {
                $data[] = array(
                    'id' => $pr['id'],
                    'title' => $pr['title_' . $l],
                    'city_id' => $pr['city_id'],
                );
            }
            $folder = 'project_media';
            $data_type = 'projects';
            break;
        case 'Items':
            $title = 'Items';
            break;
    }
}


?>

<div class=" banner-buying">
    <div class=" container">
        <h3><?= $title ?></h3>

    </div>
</div>
<!--//header-->
<!--Dealers-->
<div class="dealers">
    <div class="container">
        <h3>All <?= $title ?></h3>

        <div class="dealer-top">

            <div class="deal-top-top">
                <?php
                foreach ($data as $d => $f) {
                    ?>
                    <div class="col-md-3 top-deal-top">
                        <div class=" top-deal">
                            <a href="single.html" class="mask"><img
                                        src="images/<?= $folder ?>/<?= $fun->GetCoverMedia($f['id'], $data_type) ?>"
                                        class="img-responsive zoom-img"
                                        alt=""></a>
                            <div class="deal-bottom">
                                <div class="top-deal1">
                                    <h5><a href="#"><?= $f['title'] ?></a></h5>
                                    <p>Plot Area : 150 Sq.Yrds</p>

                                </div>
                                <div class="top-deal2">
                                    <a href="#" class="hvr-sweep-to-right more">More</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>
