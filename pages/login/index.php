<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */ ?>
<!DOCTYPE html>
<html>

<head>
    <base href="<?= ROOT ?>/pages/login/"/>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content=" Master  Login Form Widget Tab Form,Login Forms,Sign up Forms,Registration Forms,News letter Forms,Elements"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="//fonts.googleapis.com/css?family=Cormorant+SC:300,400,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
          rel="stylesheet">
</head>

<body>
<div class="padding-all">
    <div class="header">

        <h1>Login</h1>
    </div>

    <div class="design-w3l">
        <div class="mail-form-agile">
            <form action="<?= ROOT ?>index.php?action&login" method="post" name="login_">
                <input type="hidden" value="<?= ROOT ?>" name="href">
                <input type="text" name="username" placeholder="Username..." required=""/>
                <input type="password" name="password" class="padding" placeholder="Password" required=""/>
                <input type="submit" value="login">
            </form>
        </div>
        <div class="clear"></div>
    </div>

    <div class="footer">
        <p>© <?= date('Y') ?> All Rights Reserved </p>
    </div>
</div>
<script src="<?= ROOT ?>js/jquery.min.js">

</script>
<script src="login.js"></script>
</body>
</html>
