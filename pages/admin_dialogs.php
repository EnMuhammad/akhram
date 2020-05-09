<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;

$fun = new fun();
?>

<!--Update Contact Information-->
<div id="dialog" title="Contact Information">
    <form class="UpdateContactInformation" name="actionForm">
        <input type="hidden" name="type" value="ContactInfo">
        <div class="form-group">
            <label style="display: block">Phone</label>
            <input type="text" name="phone[]" class="form-control clone-this" style="">
            <button class="btn btn-primary bnt-sm" type="button" title="Add More" onclick="CloneText(this)">
                <i class="fa fa-plus"></i> add Phone
            </button>
        </div>

        <div class="form-group">
            <label>Facebook</label>
            <input type="text" name="facebook[]" class="form-control clone-this">
            <button class="btn btn-primary bnt-sm" type="button" title="Add More" onclick="CloneText(this)">
                <i class="fa fa-plus"></i> add More
            </button>
        </div>
        <div class="form-group">
            <label>Twitter</label>
            <input type="text" name="twitter[]" class="form-control clone-this">
            <button class="btn btn-primary bnt-sm" type="button" title="Add More" onclick="CloneText(this)">
                <i class="fa fa-plus"></i> add More
            </button>
        </div>
        <div class="form-group">
            <label>Instagram</label>
            <input type="text" name="insta[]" class="form-control clone-this">
            <button class="btn btn-primary bnt-sm" type="button" title="Add More" onclick="CloneText(this)">
                <i class="fa fa-plus"></i> add More
            </button>
        </div>
        <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
            <div class="ui-dialog-buttonset">
                <button type="submit" class="ui-button ui-corner-all ui-widget">Save</button>
            </div>
        </div>
    </form>
</div>

<!--Update MetaData-->
<div id="MetaData" title="Meta">
    <form class="UpdateContactInformation" name="actionForm">
        <input type="hidden" name="type" value="metaData">
        <div class="form-group">
            <label>Title English</label>
            <input type="text" name="title_en" class="form-control">
        </div>
        <div class="form-group">
            <label>العنوان بالعربية</label>
            <input type="text" name="title_ar" class="form-control">
        </div>
        <div class="form-group">
            <label>About Company</label>
            <input type="text" name="about_en" class="form-control">
        </div>
        <div class="form-group">
            <label>عن الشركة</label>
            <input type="text" name="about_ar" class="form-control">
        </div>
        <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
            <div class="ui-dialog-buttonset">
                <button type="submit" class="ui-button ui-corner-all ui-widget">Save</button>
            </div>
        </div>
    </form>
</div>

<!--Update Slides -->
<div id="Slides" title="Slides">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Preloaded</a></li>
            <li><a href="ajax/content1.html">All Slides</a></li>
        </ul>
        <div id="tabs-1">
            <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec
                sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem.
                Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend
                adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut
                et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc
                tristique tempus lectus.</p>
        </div>
    </div>
</div>

<!--Update MetaData-->
<div id="ServicesDialog" title="Services">
    <form class="UpdateContactInformation" name="actionForm">
        <input type="hidden" name="type" value="services">
        <div class="form-group">
            <label>Service name</label>
            <input type="text" name="service_en" class="form-control" required>
        </div>
        <div class="form-group">
            <label>أسم الخدمة</label>
            <input type="text" name="service_ar" class="form-control" required>
        </div>
        <div class="form-group">
            <label>City</label>
            <select class="form-control" name="city">
                <?= $fun->CityListAsOptions(true) ?>
            </select>
        </div>
        <div class="form-group">
            <label>About Service</label>
            <input type="text" name="about_en" class="form-control" required>
        </div>
        <div class="form-group">
            <label>عن الخدمة</label>
            <input type="text" name="about_ar" class="form-control" required>
        </div>
        <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
            <div class="ui-dialog-buttonset">
                <button type="submit" class="ui-button ui-corner-all ui-widget">Save</button>
            </div>
        </div>
    </form>
</div>
<!--Update MetaData-->
<div id="ProjectsItems" title="Projects & Items">

    <div class="form-group">
        <label>Type</label>
        <select name="projectType" class="form-control">
            <option value="0">select type</option>
            <option value="1">Project</option>
            <option value="2">Item - Equipment</option>
        </select>
    </div>
    <div class="type-1 type-all" style="display: none">
        <form class="UpdateContactInformation" name="actionForm">
            <input type="hidden" name="type" value="Projects">
            <div class="form-group">
                <label>عنوان المشروع</label>
                <input type="text" name="title_ar" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title_en" class="form-control" required>
            </div>
            <div class="form-group">
                <label> City</label>
                <select class="form-control" name="city">
                    <?= $fun->CityListAsOptions(false) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Service</label>
                <select class="form-control" name="service_list">

                </select>
            </div>
            <div class="form-group">
                <label>Start date</label>
                <input type="text" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>End date</label>
                <input type="text" name="end_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Client</label>
                <select class="form-control" name="client_id">

                </select>
            </div>
            <div class="form-group">
                <label>Contract Type</label>
                <input type="text" name="con_type" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Consultant</label>
                <input type="text" name="ads" class="form-control" required>
            </div>
            <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                <div class="ui-dialog-buttonset">
                    <button type="submit" class="ui-button ui-corner-all ui-widget">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="type-2 type-all" style="display: none">
        <form class="UpdateContactInformation" name="actionForm" enctype="multipart/form-data">
            <input type="hidden" name="type" value="items">
            <div class="form-group">
                <label>العنوان</label>
                <input type="text" name="title_ar" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title_en" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Service</label>
                <select class="form-control" name="service_list">
                </select>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" required>
            </div>
            <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                <div class="ui-dialog-buttonset">
                    <button type="submit" class="ui-button ui-corner-all ui-widget">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Add Media-->

<div id="MediaDialog" title="Media">


    <form class="UpdateContactInformation" name="actionForm" enctype="multipart/form-data">
        <input type="hidden" name="type" value="media">
        <div class="form-group">
            <label>Type</label>
            <select name="MediaType" class="form-control">
                <option value="0">Select Media Type</option>
                <option value="projects">Projects</option>
                <option value="slides">Slides</option>
                <option value="items">Items - Equipments</option>
                <option value="clients">Clients Logo</option>
            </select>
        </div>
        <div class="form-group">
            <label>عنوان الصورة</label>
            <input type="text" name="name_ar" class="form-control" required>
        </div>
        <div class="form-group">
            <label>media name</label>
            <input type="text" name="name_en" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Media for</label>
            <select name="media_id" class="form-control">
            </select>
        </div>
        <div class="form-group">
            <label>Upload Files</label>
            <input type="file" name="image" class="form-control">
        </div>


        <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
            <div class="ui-dialog-buttonset">
                <button type="submit" class="ui-button ui-corner-all ui-widget media-button" style="display: none">
                    Save
                </button>
            </div>
        </div>
    </form>


</div>

<!--Add Clients-->
<div id="ClientsDialog" title="Clients">


    <form class="UpdateContactInformation" name="actionForm" enctype="multipart/form-data">
        <input type="hidden" name="type" value="client">

        <div class="form-group">
            <label>أسم العميل</label>
            <input type="text" name="name_ar" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Client Name</label>
            <input type="text" name="name_en" class="form-control" required>
        </div>

        <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
            <div class="ui-dialog-buttonset">
                <button type="submit" class="ui-button ui-corner-all ui-widget">Add</button>
            </div>
        </div>
    </form>


</div>