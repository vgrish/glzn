<?php require_once "config.php";
$catalog = DB::selectParam('catalog','name_en',$_GET['name_en'],false,false);
$records = DB::selectParam1("price","section",false,"nn|ASC",false);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; <?=$catalog[0]['title'];?></title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="catalog">
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
			<div class="mainhead">КАТАЛОГ</div>
			<div class="subhead"><?=($records==false)?"Каталог на стадии заполнения":$catalog[0]['name_ru']?></div>
			<? if ($records):?>
			<ul class="catalog">
				<?
				foreach ($records as $record) {
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
			<? endif; ?>
		</div>
	</div>
	<?
		include 'view/popups.php';
	?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>