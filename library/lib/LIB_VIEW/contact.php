<?php
$q = new Database_alters();
$q->table = CONTACT_TABLE;
$q->conditions = "WHERE `id`='1'";
$q->select_data();
if ($q->check_ex()) {
    $q->show_data();
    $address = $q->data['add_' . $DL['lang']];
    $facebook = $q->data['facebook'];
    $twitter = $q->data['twitter'];
    $google = $q->data['google'];
    $youtube = $q->data['youtube'];
    $inst = $q->data['instg'];
    $email = $q->data['email'];
    $phone = $q->data['phone'];
    $fax = $q->data['fax'];
    $mobile = $q->data['mobile'];

    ?>
    <div class="contact_page" dir="<?= $DL['dir'] ?>">
        <div class="box">
            <div class="contact_title <?= $contact_lang['CLASS'] ?>"><?= $contact_lang['FINDUS'] ?></div>
            <div class="social_bar">
                <?= ((trim($facebook) != '') ? '<div class="socials facebook" title="' . $contact_lang['FACE'] . '"></div>' : '') ?>
                <?= ((trim($twitter) != '') ? '<div class="socials twitter" title="' . $contact_lang['TWIT'] . '"></div>' : '') ?>
                <?= ((trim($google) != '') ? '<div class="socials google" title="' . $contact_lang['GOOG'] . '"></div>' : '') ?>
                <?= ((trim($inst) != '') ? '<div class="socials inst" title="' . $contact_lang['INST'] . '"></div>' : '') ?>
                <?= ((trim($youtube) != '') ? '<div class="socials youtube" title="' . $contact_lang['YOUT'] . '"></div>' : '') ?>
                <?= ((trim($email) != '') ? '<div class="socials mail" title="' . $contact_lang['MAIL'] . '"></div>' : '') ?>
            </div>
            <div class="contact_title <?= $contact_lang['CLASS'] ?>"><?= $contact_lang['CONTACTUS'] ?></div>
            <div class="contact_info">
                <?= ((trim($phone) != '') ? $contact_lang['PHONE'] . ': ' . $phone . '<br>' : '') ?>
                <?= ((trim($fax) != '') ? $contact_lang['FAX'] . ': ' . $fax . ' <br>' : '') ?>
                <?= ((trim($mobile) != '') ? $contact_lang['MOBILE'] . ': ' . $mobile . ' <br>' : '') ?>


            </div>
            <div class="contact_form">
                <div class="return_data ERRORS_<?= $DL['float'] ?>"></div>
                <div class="return_data DONE_<?= $DL['float'] ?>"></div>
                <input type="text" placeholder="<?= $contact_lang['NAME'] ?> ...">
                <input type="text" placeholder="<?= $contact_lang['EMAIL'] ?> ... ">
                <textarea placeholder="<?= $contact_lang['TEXT'] ?> ..."></textarea>
            </div>
            <div class="social_bar" dir="<?= $DL['op_dir'] ?>" style="border-<?= $DL['float'] ?>:1px solid #000000 ">
                <input type="button" onclick="SendFeedBack(this)" value="<?= $contact_lang['SEND'] ?>">
                <div class="loader" style="float: <?= $DL['float'] ?>"></div>
            </div>
        </div>


    </div>


    <?php
}



