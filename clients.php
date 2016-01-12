<?php include "config.php";
$records = DB::select('pages_client');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; наши клиенты</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="clients">
	<div class="content black">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
		<div class="js-block">
			<div class="menu black hidden">
				<div class="menu-container ">
					<?php include 'view/menu.php';?>
				</div>
			</div>
			<div class="clients group">
				<div class="mainhead">Наши клиенты</div>
				<div class="clients-container">
					<ul class="clients-column">
						<?
						$i = 0; $j = 0;
						$all = count($records);
						foreach ($records as $record ) {
							?>
								<li class="clients-item">
									<img src="<?=ConfigSites::$prefix?><?=$record['img']?>" alt="" class="clients-photo">
									<div class="clients-info">
										<div class="clients-info-date"><span class="clients-info-date-value"><?=$record['year']?></span> г.</div>
										<div class="clients-info-head"><?=$record['name']?></div>
										<div class="clients-info-text">«<?=$record['text']?>»</div>
									</div>
								</li>
							<?
							$i++; $j++;
							if ($i == $all/3 AND $j<$all) {
							?></ul><ul class="clients-column"><?
								$i=0;
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?
		include 'view/popups.php';
	?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>