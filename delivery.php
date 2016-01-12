<?php include "config.php";
$records = DB::select('pages_dostavka');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; доставка</title>
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
                <h2 class="contacts-title">Доставка <span><?=$records[0]['title']?></span></h2>
                <h3 class="contacts-info-title"><?=$records[0]['ptitle']?></h3>
                <div class="contacts-info">
                <p>Курьером (по Москве и ближайшему Подмосковью) — за 1-2 дня</p>
                <p>Почта России — до 7 дней в зависимости (доставка до ближайшего отделения Почты России)</p>
                <p>Пони-Экспресс — в течение 3 дней (доставка курьером в любой регион России)</p>
                <p>Стоимость доставки рассчитывается индивидуально в зависимости от заказа.</p>
                </div>
                </section>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/map.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>