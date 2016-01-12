<?php include "config.php";
$records = DB::select('pages_company');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; основатель</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="founder">
	<div class="content white">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
        <div class="js-block withlines">
            <div class="menu white hidden">
                <div class="menu-container">
                    <?php include 'view/menu.php';?>
                </div>
            </div>
            <div class="container">
                <div class="founder-img">
                    <img src="<?=ConfigSites::$prefix?><?=$records[0]['img']?>" alt="">
                </div>
                <div class="founder-text">
                    <?
                        list($t1,$t2) = explode(' ',$records[0]['title']);
                        list($entire1,$entire2) = explode('—',$records[0]['name']);
                    ?>
                    <div class="founder-title"><?=$t1?> <span><?=$t2?></span></div>
                    <div class="founder-entire">
                        <p><?=$entire1?> —</p>
                        <span>
                            <?=$entire2?>
                        </span>
                    </div>
                    <div class="founder-info">
                        <?=$records[0]['text']?>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>