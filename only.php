<?php include "config.php";
$records = DB::select('pages_sewing');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; индивидуальный пошив</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="only">
	<div class="content black">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
        <div class="js-block withlines">
            <div class="menu black hidden">
                <div class="menu-container">
                    <?php include 'view/menu.php';?>
                </div>
            </div>
            <div class="container">
                <div class="only-center">
                    <div class="only-content">
                        <div class="only-title">
                            <?=$records[0]['title']?>
                            <span><?=$records[0]['name']?></span>
                        </div>
                        <p><?=$records[0]['text']?></p>
                        <div class="btn" onclick="popup('request', 'Заказать индивидуальный пошив', 'ЗАКАЗАТЬ ПОШИВ', 'Оставьте свои данные, и наш менеджер свяжется с вами', 'Заказать');">Заказать пошив</div>
                    </div>
                    <img src="<?=ConfigSites::$prefix?>img/pages/only.png" alt="" class="only-img">
                </div>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>