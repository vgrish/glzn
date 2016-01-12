<?php include "config.php";
$records = DB::select('pages_contact');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; контакты</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
	<script type="text/javascript"
	     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM_mbqpWSgUVNgmUuxfK-5P1oCc_ZhZ7Q">
	   </script>
</head>
<body id="contacts">
	<div class="content black">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
        <div class="js-block">
            <div class="menu black hidden">
                <div class="menu-container">
                    <?php include 'view/menu.php';?>
                </div>
            </div>
            <div id="map"></div>
            <div class="container">
                <section class="contacts-block">
                <h2 class="contacts-title">Контакты</h2>
                <p class="contacts-phone">
                    <img src="http://static-eu.insales.ru/files/1/792/1483544/original/phone_icon.png" alt="phone_icon.png" width="21" height="20">
                    <span>
                        <?=str_replace(';', '<br>', $records[0]['phone']);?>
                    </span>
                </p>
                <p class="contacts-location">
                    <img src="http://static-eu.insales.ru/files/1/804/1483556/original/metka_icon.png" alt="metka_icon.png" width="21" height="22">
                    <span>
                        <?=$records[0]['adres']?>
                    </span>
                </p>
                <p class="contacts-email">
                    <img src="http://static-eu.insales.ru/files/1/805/1483557/original/email_icon.png" alt="email_icon.png" width="25" height="20">
                    <span>
                        E-mail:
                        <a href="mailto:<?=$records[0]['email']?>">
                            <?=$records[0]['email']?>
                        </a>
                    </span>
                </p>
                </section>
                <a href="http://lp4lp.ru" class="mokselle"></a>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/map.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>