<?php
$q = new Database_alters();
$q->table = SLIDES_TABLE;
$q->conditions = "ORDER BY `id` DESC";
$q->select_data();
if ($q->check_ex()) {
    while ($q->show_data()) {
        ?>
        <div class="slide_box"
             style="background-image: url('<?= BASE . '/' . WEB_FILES . '/sliders/' . $q->data['image'] ?>');background-repeat: no-repeat;background-size: cover;background-position: center;">
            <input type="text" placeholder="رابط الشريحه">
            <div class="delete"><img src="images/close.gif" onclick="DeleteSlide(<?= $q->data['id'] ?>,this)"
                                     title="حذف"></div>
            <br><input type="button" onclick="SaveUrl(this,<?= $q->data['id'] ?>)" value="حفظ"></div>


        <?php
    }
}