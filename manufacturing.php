<?php include "config.php";
$records = DB::select('pages_production');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; производство</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="manufacturing">
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
                <div class="manufacturing-title">производство</div>
                <ul class="manufacturing-list">
                    <?
                        $i = 1;
                        foreach ($records as $record ) {
                            ?>
                            <li class="manufacturing-list-item manufacturing-list-item<?=$i?>">
                                <div class="manufacturing-item-box manufacturing-item-icon"><img src="<?=ConfigSites::$prefix?><?=$record['img1']?>" alt=""></div>
                                <div class="manufacturing-item-box manufacturing-item-img"><img src="<?=ConfigSites::$prefix?><?=$record['img2']?>" alt=""></div>
                                <div class="manufacturing-item-box manufacturing-item-text">
                                    <p><?=$record['text']?></p>
                                </div>
                            </li>
                            <?
                            $i++;
                        }

                    ?>
                </ul>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>