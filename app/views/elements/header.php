<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>Schoolendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Schoolendar: Iskolai esemény és időpont egyeztető rendszer">
    <meta name="author" content="Aszti">

    <!-- The styles -->
    <link href="<?=URL::to('/')?>/css/style.css" rel="stylesheet">

    <link href="<?=URL::to('/')?>/css/schoolendar-app.css" rel="stylesheet">
    <link href='<?=URL::to('/')?>/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?=URL::to('/')?>/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/jquery.noty.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/noty_theme_default.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/elfinder.min.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/elfinder.theme.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/uploadify.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/animate.min.css' rel='stylesheet'>
    <link href='<?=URL::to('/')?>/css/datetimepicker.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="<?=URL::to('/')?>/bower_components/jquery/jquery.min.js"></script>

	<script src="<?=URL::to('/')?>/js/datetimepicker.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="<?=URL::to('/')?>/img/favicon.ico">

</head>

<body>
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- topbar -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Navigáció mutat/elrejt</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=URL::to('/')?>"> <img alt="Schoolendar Logo" src="<?=URL::to('/')?>/img/logo20.png" class="hidden-xs"/>
                <span>Schoolendar</span></a>

            <!-- user dropdown -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo(Auth::user()->displayname); ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo(URL::to('myprofile')) ?>">Profil</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo(URL::to('logout')) ?>">Kijelentkezés</a></li>
                </ul>
            </div>
            <!-- EOF user dropdown -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
		<?php if(Session::get("megszemelyesit")){ ?>
                <li><a href="<?=URL::to('loginback')?>"><i class="glyphicon glyphicon-eject"></i> Megszemélyesítés vége</a></li>
		<?php }?>
            </ul>

        </div>
    </div>
    <!-- EOF topbar  -->
<?php } ?>
<div class="ch-container">
    <div class="row">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

	<?php include 'balmenu.php' ?>

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>Az oldal használatához <a href="http://hu.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    engedélyezése szükséges.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <?php } ?>
