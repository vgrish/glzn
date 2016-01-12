<?php include "config.php";
$records = DB::select('pages_show');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; шоурум</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/slick.css" />
</head>
<body id="show">
	<div class="content white">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
        <div class="js-block">
            <div class="menu white hidden">
                <div class="menu-container">
                    <?php include 'view/menu.php';?>
                </div>
            </div>
            <div class="main-container group">
                <div class="text-container">
                    <div class="h1"><?=$records[0]['name']?></div>
                    <div class="text">
                        <?=$records[0]['text']?>
                    </div>
                    <div class="btn filled light" onclick="popup('request', 'Записаться в шоурум', 'ЗАПИСАТЬСЯ В ШОУРУМ', 'Оставьте свои данные, и наш менеджер свяжется с вами, чтобы записать вас на посещение шоурума', 'Записаться')">Записаться на посещение</div>
                </div>
                <div class="slider">
                    <?
                    $array_img = unserialize($records[0]['img']);
                    foreach ($array_img as $k=>$v) {
                        ?>
                        <div class="slide"><img src="<?=ConfigSites::$prefix?><?=$array_img[$k]?>" alt=""></div>
                        <?
                    }
                    ?>
                </div>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>