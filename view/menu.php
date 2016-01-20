
<div class="menu-overlay">
	
</div>
<a href="<?=ConfigSites::$prefix?>" class="logo">
	<img src="<?=ConfigSites::$prefix?>img/logo.png" alt="" class="white">
	<img src="<?=ConfigSites::$prefix?>img/logo-alt.png" alt="" class="black">
</a>
<div class="card mobile">
	<div class="card-icon">
		<img src="<?=ConfigSites::$prefix?>img/card.png" alt="" class="white" onclick="showCard();">
		<img src="<?=ConfigSites::$prefix?>img/card-alt.png" alt="" class="black" onclick="showCard();">
	</div>
	<div class="card-count">0</div>
	<div class="popup card-popup">
		<div class="card-head-container">
			<div class="card-head">КОРЗИНА</div><div class="card-count">0</div>
			<div class="card-close" onclick="popup_out();"></div>
		</div>
		<ul class="card-goods">
		</ul>
		<div class="card-total">
			<span class="card-total-text">Итого: </span><span class="card-total-value">29970</span> руб
		</div>
		<div class="btn-wrapp"><a href="<?=ConfigSites::$prefix?>card" class="btn filled dark">Заказать</a></div>
		<p style="display:none;">Ваша корзина пуста</p>
	</div>
</div>
<div class="for-nav">
	<ul class="nav">
		<li class="nav-item sub">
			<a href="javascript:void(0);">Каталог</a>
            <? Catalog::viewCatLi(Catalog::getCat(),0); ?>
		</li>
		<li class="nav-item">
			<a href="<?=ConfigSites::$prefix?>clients">Наши клиенты</a>
		</li>
		<li class="nav-item">
			<a href="<?=ConfigSites::$prefix?>show">Шоурум</a>
		</li>
		<li class="nav-item sub">
			<a href="javascript:void(0);">О нас</a>
			<ul class="sub-menu">
				<li class="sub-item"><a href="<?=ConfigSites::$prefix?>about/founder">Основатель бренда</a></li>
				<li class="sub-item"><a href="<?=ConfigSites::$prefix?>about/philosophy">Философия</a></li>
				<li class="sub-item"><a href="<?=ConfigSites::$prefix?>about/manufacturing">Производство</a></li>
				<li class="sub-item"><a href="<?=ConfigSites::$prefix?>about/press">Пресса</a></li>
			</ul>
		</li>
		<li class="nav-item">
			<a href="<?=ConfigSites::$prefix?>delivery">Доставка</a>
		</li>
		<li class="nav-item">
			<a href="<?=ConfigSites::$prefix?>contacts">Контакты</a>
		</li>
		<li class="nav-item">
			<a href="<?=ConfigSites::$prefix?>only">Индивидуальный пошив</a>
		</li>
	</ul>
</div>
<div class="footer">
	<div class="card">
		<div class="card-icon">
			<img src="<?=ConfigSites::$prefix?>img/card.png" alt="" class="white" onclick="showCard();">
			<img src="<?=ConfigSites::$prefix?>img/card-alt.png" alt="" class="black" onclick="showCard();">
		</div>
		<div class="card-count">0</div>
		<div class="popup card-popup">
			<div class="card-head-container">
				<div class="card-head">КОРЗИНА</div><div class="card-count">0</div>
				<div class="card-close" onclick="popup_out();"></div>
			</div>
			<ul class="card-goods card-true">
			</ul>
			<div class="card-total card-true">
				<span class="card-total-text">Итого: </span><span class="card-total-value">0</span> руб
			</div>
			<div class="card-true btn-wrapp btn-wrapp_zakaz"><a href="<?=ConfigSites::$prefix?>card" class="btn filled dark">Заказать</a></div>
			<p class="card-false" style="display:none;">Ваша корзина пуста</p>
		</div>
	</div>
    <?
    $setInfo = DB::selectID("pages_contact",1);
    ?>
	<ul class="socials">
		<li><a href="<?=($setInfo[0]["fb"])?$setInfo[0]["fb"]:"javascript:void(0);"?>" <?=($setInfo[0]["fb"])?"target=\"_blank\"":""?>><img src="<?=ConfigSites::$prefix?>img/social1.png" alt="" class="white"><img src="<?=ConfigSites::$prefix?>img/social1-alt.png" alt="" class="black"></a></li>
		<li><a href="<?=($setInfo[0]["fb"])?$setInfo[0]["in"]:"javascript:void(0);"?>" <?=($setInfo[0]["fb"])?"target=\"_blank\"":""?>><img src="<?=ConfigSites::$prefix?>img/social2.png" alt="" class="white"><img src="<?=ConfigSites::$prefix?>img/social2-alt.png" alt="" class="black"></a></li>
		<li><a href="<?=($setInfo[0]["fb"])?$setInfo[0]["tw"]:"javascript:void(0);"?>" <?=($setInfo[0]["fb"])?"target=\"_blank\"":""?>><img src="<?=ConfigSites::$prefix?>img/social3.png" alt="" class="white"><img src="<?=ConfigSites::$prefix?>img/social3-alt.png" alt="" class="black"></a></li>
		<li><a href="<?=($setInfo[0]["fb"])?$setInfo[0]["vk"]:"javascript:void(0);"?>" <?=($setInfo[0]["fb"])?"target=\"_blank\"":""?>><img src="<?=ConfigSites::$prefix?>img/social4.png" alt="" class="white"><img src="<?=ConfigSites::$prefix?>img/social4-alt.png" alt="" class="black"></a></li>
	</ul>
	<div class="phones">
        <?
            $arrPhone = explode(";",$setInfo[0]["phone"]);
            foreach ($arrPhone as $phone) {
                ?>
                <div class="phone"><div class="phone_alloka"><?=$phone?></div></div>
                <?
            }
        ?>
<!--		<div class="phone">+7 925 060 16 20</div>-->
<!--		<div class="phone">+7 926 975 65 61</div>-->
	</div>
	<div class="btn" onclick="popup('request', 'Записаться в шоурум', 'ЗАПИСАТЬСЯ В ШОУРУМ', 'Оставьте свои данные, и наш менеджер свяжется с вами, чтобы записать вас на посещение шоурума', 'Записаться');">Записаться в шоурум</div>
</div>