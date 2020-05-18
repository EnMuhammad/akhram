<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;
use Languages\Lang_database as lang;

$lang = new lang();
$fun = new fun();
$trans = $lang->Translations();
$l = $lang->GetLanguage();
$sectors = $fun->GetSectorsFullData($l);
?>

<div class=" banner-buying">
    <div class=" container">
        <h3>Company Profile</h3>
        <!---->


        <!--initiate accordion-->


    </div>
</div>
<!--//header-->
<div class="container ">

    <div class="buy-single-single">
        <div class="col-md-12 single-box">
            <div class="col-md-12 profile">

                <div class="col-md-2 logo-company">
                </div>
                <div class="col-md-10">
                    <p>
                        <?= $fun->CompanyInfo('background', $l) ?>
                    </p>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <div class="col-md-3 filter-box">
                <div class="col col-md-12">
                    <h3>Filters</h3>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label>Select City</label>

                            <select class="form-control">
                                <option value="0">City Name</option>
                                <?php
                                foreach ($fun->ServiceCompanyCities() as $city) {
                                    echo '<option value="' . $city['id'] . '">' . $city['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Search By Name</label>
                            <input type="text" class="form-control" placeholder="Type sector name">
                        </div>
                    </form>
                </div>
                <div class="col col-md-12">
                    <h3>Media</h3>

                </div>
            </div>
            <div class="col-md-9">

                <?php
                //print_r($sectors);
                foreach ($sectors as $t => $s) {

                    ?>
                    <div class="col-md-12 sector_box">
                        <h3><?= $s['title']; ?></h3>
                        <ul>
                            <li class="head">Services</li>
                            <?php

                            foreach ($s['services'] as $data) {
                                echo '
                    <li><a href="Sectors/' . $data['id'] . '/' . $fun->CreateUrlName($data['title']) . '">' . $data['title'] . '</a>
                   <ul class="projects">
                   ';
                                if (!empty($data['projects']) || isset($data['projects'])) {
                                    foreach ($data['projects'] as $pro) {
                                        echo '<li>Project: <a href="Project/' . $pro['id'] . '/' . $fun->CreateUrlName($pro['title']) . '">' . $pro['title'] . '</a></li>';
                                    }
                                }
                                echo '</ul>
               </li>
                   ';
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>

            </div>

        </div>


        <div class="clearfix"></div>
    </div>
</div>
