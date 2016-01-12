<aside id="aside" class="app-aside hidden-xs bg-dark">
	<div class="aside-wrap">
		<div class="navi-wrap">
			<!-- user -->
			<div class="clearfix hidden-xs text-center hide show" id="aside-user">
				<div class="line dk hidden-folded"></div>
			</div>
			<!-- / user -->
			<!-- nav -->
			<nav ui-nav class="navi clearfix">
				<ul class="nav">
					<li class="hidden-folded padder m-t m-b-sm text-muted text-xs"><span><i class="fa fa-star"></i> Быстрый доступ</span></li>
					<li <?=$active_e?>><a href="zakaz.php" class="transition"><i class="glyphicon glyphicon-shopping-cart text-success-lter"></i><span>Заказы</span></a></li>
					<li <?=$active_f?>><a href="callback.php" class="transition"><i class="glyphicon glyphicon-phone-alt text-success-lter"></i><span>Заявки</span></a></li>
					<li class="line dk"></li>
					<li class="hidden-folded padder m-t m-b-sm text-muted text-xs"><span>Навигация</span></li>
					<li <?=$active_d?>><a class="auto"><span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span><i class="glyphicon glyphicon-th text-info-lter"></i><span>Каталог</span></a>
						<ul class="nav nav-sub dk" style="">
							<li class="nav-sub-header"><a href=""><span>Каталог</span></a></li>
							<li><a href="production.php" class="transition"><span>Каталог</span></a></li>
							<li><a href="add_product.php" class="transition"><span>Добавить товар</span></a></li>
							<li><a href="colors.php" class="transition"><span>Цвета</span></a></li>
							<li><a href="settings_size.php" class="transition"><span>Таблица размеров</span></a></li>
						</ul>
					</li>

                    <li <?=$active_c?>><a class="auto"><span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span><i class="glyphicon glyphicon-file icon text-info-lter""></i><span>Страницы</span></a>
                        <ul class="nav nav-sub dk" style="">
                            <li class="nav-sub-header"><a href=""><span>Страницы</span></a></li>
                            <li><a href="pages_clients.php" class="transition"><span>Наши клиенты</span></a></li>
                            <li><a href="pages_showroom.php" class="transition"><span>Шоурум</span></a></li>
                            <li><a class="auto"><span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span><span>О нас</span></a>
                                <ul class="nav nav-sub dk" style="">
                                    <li class="nav-sub-header"><a href=""><span>О нас</span></a></li>
                                    <li><a href="pages_company.php" class="transition"><span>Основатель бренда</span></a></li>
                                    <li><a href="pages_philosophy.php" class="transition"><span>Философия</span></a></li>
                                    <li><a href="pages_production.php" class="transition"><span>Производство</span></a></li>
                                    <li><a href="pages_press.php" class="transition"><span>Пресса</span></a></li>
                                </ul>
                            </li>
                            <li><a href="pages_sewing.php" class="transition"><span>Индивидуальный пошив</span></a></li>
                            <li><a href="pages_settings.php" class="transition"><span>Контакты и Доставка</span></a></li>
                        </ul>
                    </li>
					<li class="line dk"></li>
					<li>
						<form class="ajax" method="post" action="ajax.php">
							<input type="hidden" name="act" value="logout">
							<div class="form-actions">
								<button class="btn btn-large btn-primary btn-block" type="submit">Выход</button>
							</div>
				      </form>
					</li>
				</ul>
			</nav>
			<!-- nav -->
		</div>
	</div>
</aside>