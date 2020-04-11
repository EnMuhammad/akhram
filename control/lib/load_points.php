<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $q = new Database_alters();
    $q->table = SERV_POINT_TABLE;
    $q->conditions = "WHERE `serv_id`='$id'";
    $q->select_data();
    ?>
    <table class="Table_Home Table_Home_Edit">
        <tr>
            <td><img src="images/cancel.png" class="Cancel_point_add" style="vertical-align: bottom;cursor: pointer;"
                     title="الغاء"></td>
            <td><input type="text" placeholder="بالعربيه"
                       style="vertical-align: bottom; display: inline-block; margin: 0;width: 200px;"></td>
            <td><input type="text" placeholder="بالأنجليزية" style="vertical-align:bottom ;margin: 0;width: 200px;">
            </td>
            <td><input type="button" value="أضف" style="vertical-align: bottom;margin: 0;float: none;"></td>
        </tr>
        <?php
        if ($q->check_ex()) {

            ?>
            <tr>
                <td colspan="4">
                    <table class="Table_Home Table_Home_Edit">
                        <tr>
                            <th>العربيه</th>
                            <th>الأنجلزيية</th>
                            <th>خيارات</th>
                        </tr>
                        <?php
                        while ($q->show_data()) {
                            ?>
                            <tr>
                                <td><?= $q->data['title_ar'] ?></td>
                                <td><?= $q->data['title_en'] ?></td>
                                <td><span onclick="DeletePoint(this,<?= $q->data['id'] ?>)">حذف</span></td>
                            </tr>


                            <?php


                        }
                        ?>
                    </table>


                </td>

            </tr>
            <?php
        }
        ?>
    </table>


    <script type="text/javascript">
        $('.Serv_Point td .Table_Home .Cancel_point_add').on('click', function () {
            $('.Serv_Point').remove();

        })
        $('.Serv_Point td .Table_Home').find('input[type="button"]').on('click', function () {
            var p_ar = $('.Serv_Point td .Table_Home input[type="text"]:first');
            var p_en = $('.Serv_Point td .Table_Home input[type="text"]:eq(1)');
            if ($.trim(p_ar.val()) == '') {
                p_ar.focus();
                return false;
            }
            if ($.trim(p_en.val()) == '') {
                p_en.focus();
                return false;
            }
            $.post('index.php', {AddPoint: true, id:<?=$id ?>, ar: p_ar.val(), en: p_en.val()}, function (e) {
                $('.Serv_Point td').load('index.php?loadpoints&id=<?=$id ?>');
            })
        })


    </script>
    <?php
}
