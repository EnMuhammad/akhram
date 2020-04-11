<?php
$sql = new Database_alters();

//  if(isset($_GET['load_album'])){
//            $dirs = 'home';
//        }else if(empty($_GET)){
//            $dirs = 'home';
//        }
?>


<div class="data_load"></div>
<div class="data">
    <div class="logo_theme logo_<?= $DL['lang'] ?>"></div>
    <?php
    $sql->table = SLIDES_TABLE;
    $sql->select_data();
    if ($sql->check_ex()) {

        ?>
        <div class="slides">
            <ul>
                <?php
                while ($sql->show_data()) {
                    if ($sql->data['url'] != '') {
                        $url_bol = 0;
                    } else {
                        $url_bol = 1;
                    }
                    if ($url_bol == 0) {


                        $onclick = "onclick=\"location.replace('index.php')\"";
                        $cu = "cursor: pointer;";
                    } else {

                        $onclick = '';
                        $cu = '';
                    }
                    ?>


                    <li <?= $onclick ?>
                            style="<?= $cu ?>background-image: url('<?= BASE ?>/<?= WEB_FILES ?>/sliders/<?= $sql->data['image'] ?>');background-position: center;background-repeat: no-repeat;background-size: cover">


                    </li>

                    <?php

                }
                ?>
            </ul>
        </div>
        <?php
    } else {
        ?>
        <div class="slides" style="border: 3px solid white">
            <ul>
                <li style="background-image: url('<?= BASE ?>/<?= WEB_FILES ?>/sliders/empty_slides.png');background-position: center;background-repeat: no-repeat;background-size: cover;"></li>


            </ul>
        </div>

        <?php
    }
    ?>
    <div class="DataContent" dir="<?= $DL['dir'] ?>">
        <div class="small_box box small_h_box" style="float: <?= $DL['op_float'] ?>">

            <div class="header header_<?= $DL['lang'] ?> header_small">
                <span style="float:<?= $DL['float'] ?>;"> <?= $page_lang['NEWS'] ?></span> <span
                        style="float:<?= $DL['op_float'] ?>"> </span>
                <div class="clear"></div>
            </div>
            <ul class="News ">

                <?php
                $sql->table = NEWS_TABLE;
                $sql->select_data();


                if ($sql->check_ex()) {
                    $sql->conditions = "ORDER BY `id` DESC LIMIT 4";
                    $sql->select_data();
                    while ($sql->show_data()) {
                        if (strlen($sql->data['content_' . $DL['lang']]) > 40) {
                            $content = mb_substr($sql->data['content_' . $DL['lang']], 0, 30, 'UTF8') . ' ..';
                        } else {
                            $content = $sql->data['content_' . $DL['lang']];
                        }
                        echo '<li class="Title font_' . $DL['lang'] . '_bold">' . $sql->data['title_' . $DL['lang']] . '</li>';
                        echo '<li class="font_' . $DL['lang'] . '" id="' . $sql->data['id'] . '" style="text-align:' . $DL['float'] . ';">' . $content . '

    </li>';


                    }
                } else {
                    echo '<li class="Title">No News</li>';


                } ?>

            </ul>


        </div>
        <div class="mdm_box box mdm_box_half_width" style="float: <?= $DL['float'] ?>">
            <div class="header header_<?= $DL['lang'] ?>">
                <span style="float:<?= $DL['float'] ?>;"><?= $page_lang['PHOTO'] ?></span> <span
                        style="float:<?= $DL['op_float'] ?>"
                > </span>
                <div class="clear"></div>
            </div>
            <?php
            $sql->table = ALBUM_TABLE;
            $sql->conditions = "order by `id` DESC LIMIT 6";
            $sql->select_data();
            if ($sql->check_ex()) {

                ?>
                <div class="Albums" id="photo">
                    <?php
                    while ($sql->show_data()) {
                        if (Albums::Get_Random_Pic($sql->data['id']) == BASE . '/' . WEB_FILES . '/def/no_image_thumb.gif') {
                            $rv_click = true;
                        } else {
                            $rv_click = false;
                        }
                        ?>
                        <div class="items" <?php if ($rv_click == false) { ?> onclick="LoadAlbum(<?= $sql->data['id'] ?>,'<?= Albums::Album_info('title_' . $DL['lang'], $sql->data['id']) ?>')" <?php } ?>
                             style="background-image:url('<?= Albums::Get_Random_Pic($sql->data['id']) ?>') ;background-repeat: no-repeat;background-position: center;background-size: cover;"></div>

                        <?php
                    }
                    ?>

                </div>

                <?php
            }

            ?>
            <div class="more"><span onclick="LoadAlbumPage(this)"><?= $DL['ALL_ALBUM'] ?></span></div>
        </div>

        <?php
        $sql->table = EQUI_TABLE;
        $sql->conditions = "ORDER BY `id` DESC LIMIT 4";
        $sql->select_data();
        if ($sql->check_ex()) {
            ?>
            <div class="longbox box longbox_half" style="float: <?= $DL['float'] ?>">
                <div class="header header_<?= $DL['lang'] ?>">
                    <span style="float:<?= $DL['float'] ?>;"><?= $page_lang['EQU'] ?></span>
                    <span style="float:<?= $DL['op_float'] ?>">
     </span>
                    <div class="clear"></div>
                </div>


                <div class="Albums" style="height: auto">
                    <?php
                    while ($sql->show_data()) {
                        $wid = $sql->data['id'];
                        $photo = Albums::Get_eq_photo(Albums::work_album_id($wid, "equ_id"));
                        if ($photo == 0) {
                            $photo = "/def/no_image_thumb.gif";


                        } else {
                            $photo = "/photos/" . $photo;
                        }
                        ?>
                        <div class="vds project" id="<?= $wid ?>"
                             style="background-image:url('<?= BASE ?>/<?= WEB_FILES . $photo ?>') ;background-repeat: no-repeat;background-position: center;background-size: cover;">
                            <div class="title" style="cursor: pointer;"><?= $equ_lang['VIEW'] ?></div>
                        </div>

                        <?php
                    }
                    ?>


                </div>
                <div class="more"><span onclick="LoadEquPage(this)"><?= $equ_lang['ALL_EQU_LANG'] ?></span></div>
            </div>
            <?php
        }
        ?>
        <div class="small_box box adv_small_box" style="float: <?= $DL['float'] ?>">
            <img src="<?= BASE ?>/<?= WEB_FILES ?>/albums/Pepsi_Commercial_by_mindfuckx.jpg" width="100%">


        </div>
        <div class="mdm_box box mdm_box_articals_width" style="float: <?= $DL['float'] ?>">
            <div class="header header_<?= $DL['lang'] ?>"
                 style="background-color: #3f4c6b;color: #ffffff;padding: 8px 10px">
                <span style="float:<?= $DL['float'] ?>;"><?= $page_lang['PROJ'] ?></span> <span
                        style="float:<?= $DL['op_float'] ?>">
             </span>
                <div class="clear"></div>

            </div>
            <div class="Arti">
                <div class="list font_<?= $DL['lang'] ?>"
                     style="float: <?= $DL['float'] ?>;text-align: <?= $DL['float'] ?>" dir="<?= $DL['dir'] ?>">
                    <div class="project_lists">
                        <?php
                        $sql->table = WORK_TABLE;
                        $sql->conditions = "WHERE `pub`='0' ORDER BY `id` DESC LIMIT 5";
                        $sql->select_data();
                        if ($sql->check_ex()) {
                            while ($sql->show_data()) {
                                if (strlen($sql->data['title_' . $DL['lang']]) > 20) {
                                    $ti = mb_substr($sql->data['title_' . $DL['lang']], 0, 20, 'UTF8') . '...';
                                } else {
                                    $ti = $sql->data['title_' . $DL['lang']];
                                }
                                $content = mb_substr($sql->data['content_' . $DL['lang']], 0, 20, 'UTF8');
                                echo '<h1 class="' . $DL['lang'] . '_image" title="' . $sql->data['title_' . $DL['lang']] . '" onclick="loadHomeProject(' . $sql->data['id'] . ')">' . $ti . '</h1>';
                                echo '<h2>' . $content . '</h2>';


                            }


                        }


                        ?>

                    </div>

                </div>
                <style type="text/css">
                    .container .data .DataContent .box .Arti .content .loader {
                        background-image: url(<?=BASE.'/'.IMAGES_DIR ?>/load.gif);


                    }
                </style>
                <div class="content font_<?= $DL['lang'] ?>" dir="<?= $DL['dir'] ?>"
                     style="text-align:<?= $DL['float'] ?> ; float: <?= $DL['float'] ?>;border-<?= $DL['float'] ?>:1px solid  #D0D0D0  ;">
                    <div class="loader"></div>

                </div>
                <div class="clear"></div>
            </div>

        </div>

        <?php

        $q2 = new Database_alters();
        $q2->table = CERT_TABLE;
        $q2->Data_type = "`id`,`title_" . $DL['lang'] . "`,`photo`,`other_" . $DL['lang'] . "`";
        $q2->conditions = "ORDER BY `id` DESC LIMIT 10";
        $q2->select_data();
        $sty = new Style();
        $sty->c_class = "show_box";

        $sty->float = $DL['float'];

        if ($q2->check_ex()){
        ?>

        <div class="longbox box longbox_certificate" style="float: <?= $DL['float'] ?>">
            <div class="header header_<?= $DL['lang'] ?>" dir="<?= $DL['dir'] ?>"><?= $page_lang['CERT'] ?></div>
            <div class="content certificate" dir="<?= $DL['dir'] ?>">
                <?php

                $dir = WEB_FILES . '/Certificates/';
                while ($q2->show_data()) {
                    $sty->on_click = "onclick='Certi_view(" . $q2->data['id'] . ",\"" . $q2->data['title_' . $DL['lang']] . "\")'";
                    $sty->title = 'header=[' . $q2->data['title_' . $DL['lang']] . '] body=[&nbsp;] fade=[on]';
                    $photo = $q2->data['photo'];
                    $phot_dir = $dir . $photo;
                    if (file_exists($phot_dir)) {
                        $sty->img = $dir . $photo;
                        echo $sty->Div_background();

                    }


                }
                echo '</div>
        </div>';

                }
                ?>


                <div class="clear"></div>
                <style type="text/css">
                    .container .data .DataContent .footer ul li {

                        text-align: <?=$DL['float'] ?>;

                    }


                </style>
                <div class="footer" dir="<?= $DL['dir'] ?>">
                    <div class="content font_<?= $DL['lang'] ?>">
                        <div class="footer_box " style="float: <?= $DL['float'] ?>; ">
                            <?php
                            $sql->table = CONTACT_TABLE;
                            $sql->conditions = "";
                            $sql->select_data();
                            if ($sql->check_ex()) {
                                $sql->show_data();
                                $f = $sql->data['facebook'];
                                $t = $sql->data['twitter'];
                                $g = $sql->data['google'];
                                if ($f == '' && $t == '' && $g == '') {

                                } else {
                                    ?>

                                    <?= (($f != '') ? " <a href='$f' target='_blank'><img src='" . IMAGES_DIR . "/social_icons/facebook.png'></a>" : "") ?>
                                    <?= (($t != '') ? " <a href='$t' target='_blank'><img src='" . IMAGES_DIR . "/social_icons/twitter.png'></a>" : "") ?>
                                    <?= (($g != '') ? " <a href='$g' target='_blank'><img src='" . IMAGES_DIR . "/social_icons/googleplus.png'></a>" : "") ?>


                                    <?php
                                }

                            }
                            ?>
                            <img src="<?= IMAGES_DIR ?>/search_btn.png" class="Search">
                            <input type="text" class="Search">
                        </div>
                        <ul>
                            <li class="footer_head"><?= $footer_lang['COMPANY'] ?></li>
                            <li onclick="company_overview('US')"><?= $footer_lang['ABOUTUS'] ?></li>
                            <li onclick="company_overview('vm')"><?= $footer_lang['V_M'] ?></li>
                            <li onclick="LoadAlbumPage(this)"><?= $footer_lang['PHOTOS'] ?></li>


                        </ul>

                        <ul>
                            <li class="footer_head"
                                style="text-align: <?= $DL['float'] ?>"><?= $footer_lang['PRODUCTS'] ?></li>
                            <li onclick="LoadprojectsPage();"><?= $footer_lang['PROJECT'] ?></li>
                            <li onclick="LoadEquPage(this)"><?= $footer_lang['EQI'] ?></li>


                        </ul>
                        <?php
                        $sql->table = BRAN_TABLE;
                        $sql->conditions = "LIMIT 4";
                        $sql->select_data();
                        if ($sql->check_ex()) {

                            ?>
                            <ul>
                                <li class="footer_head"
                                    style="text-align: <?= $DL['float'] ?>"><?= $footer_lang['BRANSH'] ?></li>
                                <?php
                                while ($sql->show_data()) {
                                    echo '<li>' . $sql->data['title_' . $DL['lang']] . '</li>';

                                }
                                ?>

                            </ul>
                            <?php
                        }
                        ?>
                        <?php
                        $sql->table = SERVICES_TABLE;
                        $sql->conditions = "LIMIT 5";
                        $sql->select_data();
                        if ($sql->check_ex()) {

                            ?>
                            <ul>
                                <li class="footer_head"
                                    style="text-align: <?= $DL['float'] ?>"><?= $footer_lang['SERV'] ?></li>
                                <?php
                                while ($sql->show_data()) {
                                    $hash = str_replace(" ", "_", $sql->data['title_' . $DL['lang']]);
                                    echo '<li onclick="load_serv(\'' . $hash . '\');">' . $sql->data['title_' . $DL['lang']] . '</li>';
                                }
                                ?>
                            </ul>
                            <?php
                        }

                        $sql->table = CONTACT_TABLE;
                        $sql->select_data();
                        if ($sql->check_ex()) {
                            $sql->show_data();
                            $f = $sql->data['facebook'];
                            $t = $sql->data['twitter'];
                            $g = $sql->data['google'];
                            $y = $sql->data['youtube'];
                            $i = $sql->data['instg'];
                            if ($f == '' && $t == '' && $g == '' && $y == '' && $i == '') {

                            } else {
                                ?>
                                <ul>
                                    <li class="footer_head"
                                        style="text-align: <?= $DL['float'] ?>"><?= $footer_lang['FINDUS'] ?></li>
                                    <?= (($f != '') ? "<li><a href='" . $f . "' target='_blank'>" . $footer_lang['FACEB'] . "</a></li>" : "") ?>
                                    <?= (($t != '') ? "<li><a href='" . $t . "' target='_blank'>" . $footer_lang['TWIT'] . "</a></li>" : "") ?>
                                    <?= (($g != '') ? "<li><a href='" . $g . "' target='_blank'>" . $footer_lang['GOOGLE'] . "</a></li>" : "") ?>
                                    <?= (($y != '') ? "<li><a href='" . $y . "' target='_blank'>" . $footer_lang['YOUTUBE'] . "</a></li>" : "") ?>
                                    <?= (($i != '') ? "<li><a href='" . $i . "' target='_blank'>" . $footer_lang['INST'] . "</a></li>" : "") ?>
                                </ul>
                                <?php
                            }

                        }
                        $sql->table = CONTACT_TABLE;
                        $sql->select_data();
                        if ($sql->check_ex()) {
                            $sql->show_data();
                            $e = $sql->data['email'];
                            $p = $sql->data['phone'];
                            $fax = $sql->data['fax'];
                            $m = $sql->data['mobile'];

                            if ($e == '' && $p == '' && $fax == '' && $m == '') {

                            } else {
                                ?>

                                <ul>
                                    <li class="footer_head"
                                        style="text-align: <?= $DL['float'] ?>"><?= $footer_lang['CONTACTUS'] ?></li>
                                    <?= (($e != '') ? "<li>" . $footer_lang['EMAIL'] . "<br><a href='mailto:" . $e . "'>muhjhkas@live.com</a></li>" : "") ?>
                                    <?= (($p != '') ? "<li>" . $footer_lang['PHONE'] . "<br>$p</li>" : "") ?>
                                    <?= (($fax != '') ? "<li>" . $footer_lang['FAX'] . "<br>$fax</li>" : "") ?>
                                    <?= (($m != '') ? "<li>" . $footer_lang['MOBILE'] . "<br>$m</li>" : "") ?>

                                </ul>


                                <?php
                            }


                        }
                        ?>


                    </div>
                    <div class="copyright">© 2015 - Al akhram Constructions & Contract. All Rights Reserved || Develpoed
                        by <a href="#">Owzworld for website developming</a></div>
                </div>

            </div>


        </div>
