<?php include "config.php";
$records = DB::select('pages_philosophy');
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
</head>
<body id="philosophy">
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
            <div class="container group">
                <img src="<?=ConfigSites::$prefix?><?=$records[0]['img']?>" alt="" class="philosophy-img">
                <div class="philosophy-text">
                    <div class="philosophy-title"><?=$records[0]['title']?></div>
                    <div class="philosophy-info">
                        <?=$records[0]['text']?>
                    </div>
                    <div class="philosophy-name">
                        <?=$records[0]['fio']?>
                    </div>
                    <div class="philosophy-who">
                        <?=$records[0]['prof']?>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
</body>
</html>