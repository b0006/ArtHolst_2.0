<?php

function getCurrentScriptFile() {
    $re = '/\w+.php/';
    $str = $_SERVER["SCRIPT_FILENAME"];

    preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

    return $matches[0][0];
}

?>

<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://self.ru/">

    <title>Art Holst Красноярск</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="css/uikit.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">

    <!-- custom -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div class="uk-offcanvas-content">

        <div id="offcanvas-slide" uk-offcanvas="overlay: true">
            <div class="uk-offcanvas-bar">

                <button class="uk-offcanvas-close" type="button" uk-close></button>

                <h3>Меню - Art Holst</h3>

                <ul>
                    <li>Hello</li>
                    <li>Hello</li>
                    <li>Hello</li>
                </ul>

            </div>
        </div>

        <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
            <div class="uk-offcanvas-bar">

                <button class="uk-offcanvas-close" type="button" uk-close></button>

                <h3>Меню - Art Holst</h3>

                <ul>
                    <li><a href="#">Главная</a></li>
                    <li><a href="#">Каталог</a></li>
                    <li><a href="#">Сервис</a></li>
                    <li><a href="#">Доставка</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                    <li><a href="#">О нас</a></li>
                </ul>

            </div>
        </div>

        <div id="offcanvas-reveal" uk-offcanvas="mode: reveal; overlay: true">
            <div class="uk-offcanvas-bar">

                <button class="uk-offcanvas-close" type="button" uk-close></button>

                <h3>Title</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            </div>
        </div>

        <?php
        $page = getCurrentScriptFile();
        ?>

        <!-- Main Banner -->
        <section class="banner" uk-parallax="bgy: -200">
            <div class="uk-container uk-text-center">

                <!-- navbar -->
                <nav class="top-navbar">

                    <div class="logo">
                        <p>Art</p>
                    </div>

                    <!-- mobile left-menu -->

                    <div class="navbar-mobile" style="position: fixed;">
                        <nav class="uk-navbar uk-navbar-container uk-margin">
                            <div class="uk-navbar-left">
                                <a class="uk-navbar-toggle" href="#offcanvas-push" uk-toggle>
                                    <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">МЕНЮ</span>
                                </a>
                            </div>
                        </nav>
                    </div>

                    <!-- end mobile left-menu -->

                    <ul id="menu">
                        <li><a href="index.php">Главная</a></li>
                        <li><a href="#">Каталог</a></li>
                        <li><a href="#">Сервис</a></li>
                        <li><a href="#">Доставка</a></li>
                        <li><a href="contacts.php">Контакты</a></li>
                        <li><a href="#">О нас</a></li>
                        <hr>
                    </ul>

                </nav>
                <!-- end navbar -->

                <?php if($page == "index.php"): ?>
                    <div uk-grid class="main_logo">
                        <div uk-scrollspy="cls: uk-animation-slide-top; repeat: false">
                            <h1 class="uk-width-1-1@m uk-text-center uk-margin-auto uk-margin-auto-vertical">Art <span style="background-color: #11749e">Holst</span></h1>
                            <h3>Фото на холсте</h3>
                        </div>
                    </div>
                <?php endif;?>

            </div>
        </section>
        <!-- End main banner -->

