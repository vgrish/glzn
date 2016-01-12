<?php include "config.php";
$records = DB::select('pages_press');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; пресса</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="press">
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
                <div class="press-col">
                <?
                    $i = 0; $j = 0;
                    $all = count($records);
                    foreach ($records as $record ) {
                        ?>
                        <div class="press-block">
                            <div class="press-title">
                                <img src="<?=ConfigSites::$prefix?><?=$record['img1']?>" alt="">
                            </div>
                            <? if ($record['text']) :?>
                            <div class="press-text">&laquo;<span><?=$record['text']?></span>&raquo;</div>
                            <? endif; ?>
                            <? if ($record['img2']) :?>
                            <img src="<?=ConfigSites::$prefix?><?=$record['img2']?>" alt="" class="press-img">
                            <? endif; ?>
                        </div>
                        <?
                        $i++; $j++;
                        if($i==$all/2 AND $j<$all) {
                            ?>
                            </div>
                            <div class="press-col">
                            <?
                            $i=0;
                        }
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