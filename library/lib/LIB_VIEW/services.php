<?php
$q = new Database_alters();
$q->table = SERVICES_TABLE;
$q->conditions = "ORDER BY `id`";
$q->select_data();
if ($q->check_ex()) {
    ?>

    <div class="serves_page" dir="<?= $DL['dir'] ?>">

        <div class="servi_title">الخدمات</div>
        <table class="table">
            <?php
            while ($q->show_data()) {
                $hash = str_replace(" ", "_", $q->data['title_' . $DL['lang']]);
                ?>
                <tr>
                    <th align="<?= $DL['float'] ?>"><a name="<?= $hash ?>"></a><?= $q->data['title_' . $DL['lang']] ?>
                        <div class="arrow_up" onclick="hide_show_point(this,<?= $q->data['id'] ?>)"
                             style="float: <?= $DL['op_float'] ?>"></div>
                    </th>
                </tr>
                <tr class="points_<?= $q->data['id'] ?>">
                    <td>
                        <ul>
                            <?php
                            $array = servpoint($q->data['id'], $DL['lang']);
                            if (!empty($array) || $array != NULL) {
                                foreach ($array as $point) {
                                    echo '<li>' . $point . '</li>';

                                }
                            } else {
                                echo '...';
                            }

                            ?>


                        </ul>
                    </td>
                </tr>

                <?php


            }

            ?>

        </table>


    </div>


    <?php
}




