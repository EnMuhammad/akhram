<?php
if (isset($_GET['ac'])) {
    $action = htmlspecialchars(strip_tags(trim($_GET['ac'])));

    switch ($action) {
        case 'US':
        default:
            $title = $about_co_lang;
            $info = web_info::web_information('about_co_' . $DL['lang']);


            break;
        case 'vm':
            $title = $vi_mis_lang;
            $info = web_info::web_information('vi_mis_' . $DL['lang']);
            break;
    }
    ?>
    <div class="overview" dir="<?= $DL['dir'] ?>">


        <div class="text <?= $DL['lang'] ?>">
            <div class="title"><?= $title ?></div>
            <div class="info_text"><?= $info ?></div>


        </div>
    </div>


    <?php
}