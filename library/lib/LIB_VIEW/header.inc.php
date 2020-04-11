<?php
$q = new web_info();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $q->web_information('web_title_' . $DL['lang']) ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="<?= web_info::web_information('web_key_' . $DL['lang']) ?>">
    <meta name="owner" content="<?= web_info::web_information('owner') ?>">
    <script type="text/javascript" src="<?= BASE ?>/<?= SCRIPT_DIR ?>/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="<?= BASE ?>/<?= SCRIPT_DIR ?>/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="<?= BASE ?>/<?= SCRIPT_DIR ?>/sp-direction.js"></script>
    <script type="text/javascript" src="<?= BASE ?>/<?= SCRIPT_DIR ?>/jquery.placeholder.js"></script>
    <script type="text/javascript" src="<?= BASE ?>/<?= SCRIPT_DIR ?>/forms.js"></script>
    <script type="text/javascript" src="<?= BASE ?>/<?= SCRIPT_DIR ?>/boxOver.js"></script>
    <script>$(function () {
            $('input, textarea').placeholder();
            var html;
            if ($.fn.placeholder.input && $.fn.placeholder.textarea) {
                html = '';
            } else if ($.fn.placeholder.input) {
            }
            if (html) {
                $('').insertAfter('');
            }
        });</script>

    <link rel="stylesheet"
          href="<?= BASE ?>/<?= STYLE_DIR ?>/<?= ((web_info::web_information('theme')) != '') ? web_info::web_information('theme') : "style" ?>.css">
    <link rel="stylesheet" href="<?= BASE ?>/<?= STYLE_DIR ?>/jquery.mCustomScrollbar.css">
</head>
<body>
<div class="Page_loder"><span><?= $DL['LOADING_TXT'] ?></span></div>
<div class="Page_loder_Background"></div>
<div class="Window_loder">
    <div class="Ele" dir="<?= $DL['dir'] ?>">
        <img src="<?= IMAGES_DIR ?>/Loders.gif"><br>
        <?= $loading_box_lang['LOAD'] ?>
    </div>

    <div class="Data_load">


    </div>
    <div class="foot">
        <span class="album_name">Akhram</span>
        <span style="float: right;cursor: pointer" onclick="closealbum()"><?= $loading_box_lang['CLOSE'] ?></span>
    </div>
</div>
<div class="blackbackground"></div>

<?php
if (empty($_GET)) {
    $btn_dir = 'home';
} else if (isset($_GET['loadallAlbums']) && isset($_GET['asLoad'])) {
    $btn_dir = 'albums_reload';
} else if (isset($_GET['loadallAlbums']) && !isset($_GET['asLoad'])) {
    $btn_dir = 'albums';
}
?>
<div class="container">
    <div class="space"></div>
    <input type="hidden" class="dir_page" value="<?= $btn_dir ?>">
    <input type="hidden" class="WEB_LANG" value="<?= $DL['lang'] ?>">
    <div class="logo logo_<?= $DL['lang'] ?>"></div>
    <div class="clear"></div>
    <style type="text/css">
        .container .top_bar li {
            float: <?=$DL['float'] ?>;
        }

        .container .top_bar .li_change {
            float: <?=$DL['op_float'] ?>;
            cursor: pointer;
        }

        .container .top_bar li input[type=text] {

            background-image: url('<?=IMAGES_DIR ?>/search.png');
            background-repeat: no-repeat;
            background-position: <?=$DL['float'] ?>;
            padding- <?=$DL['float'] ?>: 20px;
            direction: <?=$DL['dir'] ?>;
        }

        .slides ul li {
            float: left;
        }


    </style>
    <ul class="top_bar font_<?= $DL['lang'] ?>">
        <li><a href="#" id="home" style="color: white;text-decoration: none;"><?= $tb_lang['Home'] ?></a></li>
        <li><a href="Projects" onclick="LoadprojectsPage();return false;" id="works"
               style="color: white;text-decoration: none;"><?= $tb_lang['Works'] ?></a>


        </li>
        <li><a href="Services" onclick="return false;" id="works"
               style="color: white;text-decoration: none;"><?= $tb_lang['SERV'] ?></a>
            <ul class="drop_down" style="<?= $DL['float'] ?>: 0;" dir="<?= $DL['dir'] ?>">
                <?php
                $q = new Database_alters();
                $q->table = SERVICES_TABLE;
                $q->conditions = "ORDER BY `id` LIMIT 5";
                $q->select_data();
                if ($q->check_ex()) {
                    while ($q->show_data()) {
                        $hash = str_replace(" ", "_", $q->data['title_' . $DL['lang']]);
                        echo ' <a href="Services#' . $hash . '" onclick="load_serv(\'' . $hash . '\');return false;"><li style="text-align: ' . $DL['float'] . '">' . $q->data['title_' . $DL['lang']] . '</li></a>';

                    }
                }
                ?>

            </ul>
        </li>

        <li><a href="#" id="about" style="color: white;text-decoration: none;"><?= $tb_lang['about'] ?></a>
            <ul class="drop_down" style="<?= $DL['float'] ?>: 0;" dir="<?= $DL['dir'] ?>">
                <li onclick="company_overview('vm')"
                    style="text-align: <?= $DL['float'] ?>"> <?= $tb_lang['V_M'] ?></li>
                <li onclick="company_overview('US')"
                    style="text-align: <?= $DL['float'] ?>"> <?= $tb_lang['about'] ?></li>
                <li onclick="Contact_us()" style="text-align: <?= $DL['float'] ?>"> <?= $tb_lang['Contact'] ?></li>
            </ul>

        </li>
        <li class="li_change" onclick="Change_lang('<?= $DL['lang_change'] ?>')"><?= $DL['lang_change_text'] ?></li>
        <li style="padding: 1px 0;width: 300px;float: <?= $DL['op_float'] ?>"><input type="text"
                                                                                     placeholder="<?= $DL['Search'] ?>">
        </li>
        <div class="clear"></div>

    </ul>
