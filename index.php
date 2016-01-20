<?php require_once "config.php";
    $records = DB::selectParam('price','best',1,'nn|ASC','limit 6');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="main">
	<div class="content white">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
		<div class="top js-block">
			<div class="menu white hidden">
				<div class="menu-container ">
					<?php include 'view/menu.php';?>
				</div>
			</div>
			<div class="h2">
				Одежда, которая вдохновляет
				<div class="btn-wrapp">
					<a href="<?=ConfigSites::$prefix?>catalog_all.php" class="btn light">Каталог</a>
				</div>
			</div>
		</div>
		<? if ($records) :?>
		<div class="best js-block">
			<div class="menu black hidden">
				<div class="menu-container">
					<?php include 'view/menu.php';?>
				</div>
			</div>
			<div class="subhead">Лучшие</div>
			<ul class="catalog">
				<?
					foreach ($records as $record ) {
                        $img_product = DB::selectParam('price_photo','price_id',$record['id'],false,'limit 1');
						?>
						<li class="catalog-item">
							<a href="<?=ConfigSites::$prefix?>catalog/product/<?=$record['id']?>">
								<img src="<?=ConfigSites::$prefix?><?=$img_product[0]['src']?>" alt="">
							</a>
							<div class="catalog-name"><?=$record['name']?></div>
							<div class="catalog-price"><?=ceil($record['price'])?> руб</div>
						</li>
						<?
					}
				?>
			</ul>
			<div class="btn-wrapp">
				<a href="<?=ConfigSites::$prefix?>catalog_all.php" class="btn dark">Каталог</a>
			</div>
			<a href="http://lp4lp.ru" class="mokselle"></a>
		</div>
		<?endif?>
	</div>
	<?
		include 'view/popups.php';
	?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>