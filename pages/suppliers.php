<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;
use Languages\Lang_database as lang;

$fun = new fun();
$lang = new lang();
$trans = $lang->Translations();
$l = $lang->GetLanguage();

?>

<div class=" banner-buying">
    <div class=" container">
        <h3><?= $trans['SUPP_BUSI'][$l] ?></h3>

    </div>
</div>
<!--//header-->
<!--Dealers-->
<div class="dealers">
    <div class="container">
        <h3><?= $trans['SUPP_BUSI'][$l] ?></h3>

        <div class="dealer-top">

            <div class="deal-top-top">
                <?php
                foreach ($fun->SuppliersListArray($l) as $t) {
                    ?>
                    <div class="col-md-3 top-deal-top">
                        <div class=" top-deal">
                            <a href="<?= $t['link'] ?>" target="_blank" class="mask"><img
                                        src="images/suppliers/<?= $t['logo'] ?>"
                                        class="img-responsive zoom-img"
                                        alt=""></a>
                            <div class="deal-bottom">
                                <div class="top-deal1">
                                    <h5><a href="#"><?= $t['name'] ?></a></h5>

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



