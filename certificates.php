<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>Каталог</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
</head>
<body id="certificates">
	<div class="content">
		<div class="js-block">
			<div class="menu black hidden">
				<div class="menu-container ">
					<?php include 'view/menu.php';?>
				</div>
			</div>
			<div class="certs group">
				<div class="mainhead">Каталог</div>
				<div class="subhead">Сертификаты</div>
				<div class="certs-container">
					<div class="certs-inner certs-left">
						<img src="<?=ConfigSites::$prefix?>img/pages/certs.jpg" alt="">
					</div>
					<div class="certs-inner certs-right">
						<div class="certs-title">
							Подарочные карты<br>
							GLZN by Galina Zhondorova —
							<span>дарить подарки просто и приятно!</span>
						</div>
						<div class="certs-wrapp">
							<p>Выберите подарочную карту на сумму:</p>
							<ul class="certs-list">
								<li><span>- 10 000 рублей</span></li>
								<li><span>- 20 000 рублей</span></li>
								<li><span>- Более 20 000 рублей</span></li>
							</ul>
							<p>
								И закажите её по телефону:<br>
								<span>+7 (925) 060 16 20</span><br>
								<span>+7 (926) 975 65 61</span>
							</p>
							<p>
								Возможен самовывоз из нашего шоу–рума в Никольском пассаже или доставка по Москве и Подмосковью.
							</p>
							<div class="certs-note">
								<p>Сертификат не подлежит возврату и обмену на денежные средства. При выборе подарка на сумму, большую номинала, владелец сертификата может доплатить разницу.</p>
								<p>При выборе подарка на сумму меньше номинала, разница не компенсируется денежным эквивалентом.</p>
							</div>
						</div>
						<a href="javascript:void(0);" class="btn filled dark" onclick="popup('request', 'Заказать подарочную карту', 'ЗАКАЗАТЬ ПОДАРОЧНУЮ КАРТУ', 'Оставьте свои данные, и наш менеджер свяжется с вами', 'Заказать');">Заказать карту</a>
					</div>
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