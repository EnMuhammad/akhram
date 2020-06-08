<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Fun\functions as fun;
use Languages\Lang_database as lang;
use PROCESS\prs as prs;

$fun = new fun();
$lang = new lang();
$trans = $lang->Translations();
$l = $lang->GetLanguage();
prs::unSetData();
prs::$table = COMPANY_TABLE;
prs::$select_cond = array('data_type' => 'background');
$company_background = '';
foreach (prs::select__record() as $t => $back) {
    $company_background = $back['data_' . $l];
}

?>

<div class="contact_us">
    <div class=" container">
        <h3><span>Cont</span>act</h3>
        <!---->
    </div>
</div>
<!--//header-->
<!--contact-->
<div class="contact">
    <div class="container">
        <h3>Contat</h3>
        <div class="contact-top">
            <div class="col-md-6 contact-top1">
                <div class="col-md-12" style="margin: 10px 0">
                    <h4> Info</h4>
                    <p class="text-contact">
                        <?= $company_background ?>

                    </p>
                </div>
                <div class="form-group col-md-12">
                    <select class="form-control loadBranches">
                        <?= $fun->CityListAsOptions(false) ?>
                    </select>
                </div>
                <div class="col-md-12 loadingBranches" style="font-size: 24px;text-align: center;display: none">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div class="clearfix"></div>
                <div class="LoadDataBranches">
                    <?= $fun->Branches($l, 0) ?>
                </div>
            </div>
            <script>
                $(function () {
                    $('.loadBranches').on('change', function () {
                        let id = $(this).val();
                        $('.loadingBranches').show();
                        $.get('home?action&loadBranch&id=' + id, function (d) {
                            $('.LoadDataBranches').html(d);
                            $('.loadingBranches').hide();
                        })
                    })
                })
            </script>
            <div class="col-md-6 contact-right">

                <form>
                    <input type="text" placeholder="Name" required="">
                    <input type="text" placeholder="Email" required="">
                    <input type="text" placeholder="Subject" required="">
                    <textarea placeholder="Message" requried=""></textarea>
                    <label class="hvr-sweep-to-right">
                        <input type="button" value="Submit">
                    </label>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
<!--//contact-->
