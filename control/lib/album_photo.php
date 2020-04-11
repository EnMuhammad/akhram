<?php
if (isset($_GET['albumid'])) {
    $id = intval($_GET['albumid']);
    $q = new Database_alters();
    $q->table = PHOTO_TABLE;
    $q->conditions = "WHERE `album_id`='$id'";
    $style = new Style();
    $style->c_class = "photo";
    $style->coustme_style = "margin:2px;";
    $style->float = "right;";
    $q->select_data();

    ?>
    <style type="text/css">
        .photo {
            position: relative;
            width: 140px;
            height: 140px;
            border: 2px solid #00AAE7;

        }

        .photo .delete {
            position: absolute;
            background-image: url('images/close.gif');
            background-repeat: no-repeat;
            background-position: center;
            width: 16px;
            height: 16px;
            top: 2px;
            left: 6px;
            cursor: pointer;

        }


    </style>


    <?php
    $style->text = '<div class="delete"></div>';
    if ($q->check_ex()) {
        echo '<input type="text" class="album_ar_name" value="' . Albums::Album_info('title_ar', $id) . '"> 
<input type="text" class="album_en_name" value="' . Albums::Album_info('title_en', $id) . '">';


        ?>
        <select class="projects_edit">
            <?php
            $h = new Database_alters();
            $h->table = WORK_TABLE;
            $h->select_data();
            if ($h->check_ex()) {
                echo '<option value ="0">أختر</option>';
                while ($h->show_data()) {
                    ?>
                    <option value="<?= $h->data['id'] ?>"
                        <?= ((Albums::Album_info('work_id', $id) == $h->data['id']) ? 'selected="selected"' : "") ?> ><?= $h->data['title_ar'] ?></option>


                <?php }
            } ?>
        </select>
        <br><label>أضف المزيد</label>
        <form method="post" class="uploadalbumFiles" enctype="multipart/form-data" style="display: inline-block">
            <input type="file" class="PHOTOALBUM" name="ImageAlbumUpload[]" multiple="" accept="image/*">
            <input type="hidden" value="<?= $id ?>" class="album_id" name="album_id">
            <span class="album_upload_counter" style="color: #0000FF;"></span>
            <div class="cirule" style="display: inline-block;">
                <div class="loader"></div>
            </div>
        </form>
        <?php
        echo '<div class="PHOTO_SHOW">';
        while ($q->show_data()) {
            $img = BASE . '/' . WEB_FILES . '/photos/' . $q->data['image'];
            $style->img = $img;
            echo $style->Div_background();


        }
        echo '</div>';

        echo '<div style="display:inline-block;width:100%;"><input type= "button" value="حفظ" onclick="SaveAlbum(this,' . $id . ')"></div>';

    }


}

?>

<script type="text/javascript">
    $('.Photo_editor td .uploadalbumFiles').on('change', function () {
        var bar = $('.cirule .loader');
        $('.Photo_editor td .uploadalbumFiles').ajaxSubmit({
            type: 'post',
            url: 'index.php?DirectAlbumUpload',

            beforeSubmit: function () {
                bar.show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var pVel = percentComplete + '%';
                bar.css('border-right-color', 'black');
                if (percentComplete == 25) {
                    bar.css('border-top-color', 'black');
                }
                if (percentComplete == 50) {
                    bar.css('border-top-left', 'black');
                }
                if (percentComplete == 100) {
                    bar.css('border-color', 'black');
                }
                $('.album_upload_counter').html(pVel);
            },
            success: function (data) {
                bar.hide();
                alert(data);
                $('.Photo_editor td').load('index.php?photos&albumid=<?=$id ?>');

            },
            error: function () {
                alert('Error');
            }
        });


    })


</script>