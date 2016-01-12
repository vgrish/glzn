<?php include "config.php";
$login = ConfigSites::sessionId();
$records = DB::selectSql("SELECT
    cart.id as id,
    price.id as price_id,
    price.nomer as nomer,
    price.name as name,
    price.price as price,
    cart.size as size,
    cart.kol as kol,
    colors.rgb as color
    FROM cart
    LEFT JOIN price ON price.id=cart.price_id
    LEFT JOIN colors ON colors.id=cart.color
    WHERE login='$login'");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<!-- <meta name="viewport" content="width=device-width"> -->
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title>GLZN &mdash; платье</title>
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css"/>
</head>
<body id="card">
    <div id="payment_form">
    </div>
	<div class="content black">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
        <div class="js-block">
            <div class="menu black hidden">
                <div class="menu-container">
                    <?php include 'view/menu.php';?>
                </div>
            </div>
            <div class="container group">
                <div class="card-head">КОРЗИНА</div>
                <?
                    if ($records == false) {?><div class="checkout-title">Ваша корзина пуста</div><?}
                    else {
                ?>
                <div class="item-names cols">
                    <div class="col col1"></div>
                    <div class="col col2">Описание</div>
                    <div class="col col3">Размер</div>
                    <div class="col col4">Кол-во</div>
                    <div class="col col5">Цена</div>
                </div>
                    <?
                        $summ =0;
                        foreach ($records as $record) {
                            $summ = $summ + ($record['price']*$record['kol']);
                            $img_product = DB::selectParam('price_photo','price_id',$record['price_id'],false,'limit 1');
                            ?>
                            <div class="card-item cols group item_product-id<?=$record['id']?>">
                                <div class="item-remove" data-id="<?=$record['id']?>">
                                    <span class="remove-icon"></span>Удалить
                                </div>
                                <div class="col col1">
                                    <a href="<?=ConfigSites::$prefix?>catalog/product/<?=$record['price_id']?>">
                                        <img src="<?=ConfigSites::$prefix?><?=$img_product[0]['src']?>" alt="">
                                    </a>
                                </div>
                                <div class="inner">
                                    <div class="col col2">
                                        <div class="item-title">
                                            <?=$record['name']?>
                                        </div>
                                        <div class="item-art"><span>Артикул: </span> <span class="arc-value"><?=$record['nomer']?></span></div>
                                        <div class="item-color"><span>Цвет:</span><span class="color" style="background-color: <?=$record['color']?>;"></span></div>
                                    </div>
                                    <div class="col col3">
                                        <span>Размер: </span>
                                        <div class="item-size-value">
                                            <?=$record['size']?>
                                        </div>
                                    </div>
                                    <div class="col col4">
                                        <span>Количество</span>
                                        <div class="item-count-value"><?=$record['kol']?></div>
                                        <div class="item-count-controls">
                                            <div class="inc" data-id="<?=$record['id']?>"></div>
                                            <div class="dec" data-id="<?=$record['id']?>"></div>
                                        </div>
                                    </div>
                                    <div class="col col5">
                                        <div class="item-price-container">
                                            <span class="item-price-value"><?=ceil($record['price'])?></span><span class="item-price"> руб</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?
                            $summ = ceil($summ);
                        }
                    ?>
                <div class="form-container">
                    <div class="form-errors">
                        Красные поля обязательны к заполнению
                    </div>
                        <div class="inputs-group group">
                            <div class="inputs-group-title">
                                Покупатель
                            </div>
                            <input type="text" name="name" class="required_of" placeholder="Имя">
                            <input type="tel" name="phone" class="required_of" placeholder="Телефон">
                            <input type="text" name="email" class="required_of" placeholder="Email">
                        </div>
                        <div class="inputs-group group">
                            <div class="inputs-group-title">
                                Адрес доставки:
                            </div>
                            <div class="select group">
                                <label>
                                    Регион:
                                    <select id="shipping_address_state" name="shipping_address[state]" type="text" class="textfield">
                                        <option data-ems="450" data-pr="400" value="г Москва">Москва, г</option>
                                        <option data-ems="451" data-pr="410" value="обл Московская">Московская, обл</option>
                                        <option data-ems="452" data-pr="420" value="г Санкт-Петербург">Санкт-Петербург, г</option>
                                        <option data-ems="453" data-pr="430" value="обл Ленинградская">Ленинградская, обл</option>
                                        <option data-ems="454" data-pr="440" value="Респ Адыгея">Адыгея, Респ</option>
                                        <option data-ems="455" data-pr="450" value="Респ Алтай">Алтай, Респ</option>
                                        <option data-ems="456" data-pr="460" value="край Алтайский">Алтайский, край</option>
                                        <option data-ems="457" data-pr="470" value="обл Амурская">Амурская, обл</option>
                                        <option data-ems="458" data-pr="480" value="обл Архангельская">Архангельская, обл</option>
                                        <option data-ems="459" data-pr="490" value="обл Астраханская">Астраханская, обл</option>
                                        <option data-ems="451" data-pr="410" value="г Байконур">Байконур, г</option>
                                        <option data-ems="452" data-pr="420" value="Респ Башкортостан">Башкортостан, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Белгородская">Белгородская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Брянская">Брянская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Бурятия">Бурятия, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Владимирская">Владимирская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Волгоградская">Волгоградская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Вологодская">Вологодская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Воронежская">Воронежская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Дагестан">Дагестан, Респ</option>
                                        <option data-ems="450" data-pr="400" value="Аобл Еврейская">Еврейская, Аобл</option>
                                        <option data-ems="450" data-pr="400" value="край Забайкальский">Забайкальский, край</option>
                                        <option data-ems="450" data-pr="400" value="обл Ивановская">Ивановская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Ингушетия">Ингушетия, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Иркутская">Иркутская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Кабардино-Балкарская">Кабардино-Балкарская, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Калининградская">Калининградская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Калмыкия">Калмыкия, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Калужская">Калужская, обл</option>
                                        <option data-ems="450" data-pr="400" value="край Камчатский">Камчатский, край</option>
                                        <option data-ems="450" data-pr="400" value="Респ Карачаево-Черкесская">Карачаево-Черкесская, Респ</option>
                                        <option data-ems="450" data-pr="400" value="Респ Карелия">Карелия, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Кемеровская">Кемеровская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Кировская">Кировская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Коми">Коми, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Костромская">Костромская, обл</option>
                                        <option data-ems="450" data-pr="400" value="край Краснодарский">Краснодарский, край</option>
                                        <option data-ems="450" data-pr="400" value="край Красноярский">Красноярский, край</option>
                                        <option data-ems="450" data-pr="400" value="Респ Крым">Крым, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Курганская">Курганская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Курская">Курская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Липецкая">Липецкая, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Магаданская">Магаданская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Марий Эл">Марий Эл, Респ</option>
                                        <option data-ems="450" data-pr="400" value="Респ Мордовия">Мордовия, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Мурманская">Мурманская, обл</option>
                                        <option data-ems="450" data-pr="400" value="АО Ненецкий">Ненецкий, АО</option>
                                        <option data-ems="450" data-pr="400" value="обл Нижегородская">Нижегородская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Новгородская">Новгородская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Новосибирская">Новосибирская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Омская">Омская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Оренбургская">Оренбургская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Орловская">Орловская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Пензенская">Пензенская, обл</option>
                                        <option data-ems="450" data-pr="400" value="край Пермский">Пермский, край</option>
                                        <option data-ems="450" data-pr="400" value="край Приморский">Приморский, край</option>
                                        <option data-ems="450" data-pr="400" value="обл Псковская">Псковская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Ростовская">Ростовская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Рязанская">Рязанская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Самарская">Самарская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Саратовская">Саратовская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Саха /Якутия/">Саха /Якутия/, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Сахалинская">Сахалинская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Свердловская">Свердловская, обл</option>
                                        <option data-ems="450" data-pr="400" value="г Севастополь">Севастополь, г</option>
                                        <option data-ems="450" data-pr="400" value="Респ Северная Осетия - Алания">Северная Осетия - Алания, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Смоленская">Смоленская, обл</option>
                                        <option data-ems="450" data-pr="400" value="край Ставропольский">Ставропольский, край</option>
                                        <option data-ems="450" data-pr="400" value="обл Тамбовская">Тамбовская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Татарстан">Татарстан, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Тверская">Тверская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Томская">Томская, обл</option>
                                        <option data-ems="450" data-pr="400" value="обл Тульская">Тульская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Тыва">Тыва, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Тюменская">Тюменская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Удмуртская">Удмуртская, Респ</option>
                                        <option data-ems="450" data-pr="400" value="обл Ульяновская">Ульяновская, обл</option>
                                        <option data-ems="450" data-pr="400" value="край Хабаровский">Хабаровский, край</option>
                                        <option data-ems="450" data-pr="400" value="Респ Хакасия">Хакасия, Респ</option>
                                        <option data-ems="450" data-pr="400" value="АО Ханты-Мансийский Автономный округ - Югра">Ханты-Мансийский Автономный округ - Югра, АО</option>
                                        <option data-ems="450" data-pr="400" value="обл Челябинская">Челябинская, обл</option>
                                        <option data-ems="450" data-pr="400" value="Респ Чеченская">Чеченская, Респ</option>
                                        <option data-ems="450" data-pr="400" value="Чувашия Чувашская Республика -">Чувашская Республика -, Чувашия</option>
                                        <option data-ems="450" data-pr="400" value="АО Чукотский">Чукотский, АО</option>
                                        <option data-ems="450" data-pr="400" value="АО Ямало-Ненецкий">Ямало-Ненецкий, АО</option>
                                        <option data-ems="450" data-pr="400" value="обл Ярославская">Ярославская, обл</option>
                                    </select>
                                </label>
                                <input type="city-index" name="city-index" placeholder="Индекс">
                            </div>
                            <input type="text" name="city" placeholder="Город">
                            <input type="text" name="street" placeholder="Улица">
                            <input type="text" name="house" placeholder="Дом/Квартира">
                            <textarea name="comment" placeholder="Комментарий к заказу"></textarea>
                        </div>
                        <div class="inputs-group group">
                            <div class="inputs-group-title">
                                Выбор способа доставки:
                            </div>
                            <label class="radio">
                                <input type="radio" name="delivery" value="Курьерская доставка" data-delsum="300" checked="checked">
                                <span class="pseudo"></span>
                                Курьерская доставка
                            </label>
                            <label class="radio">
                                <input type="radio" name="delivery" value="EMS">
                                <span class="pseudo"></span>
                                EMS
                            </label>
                            <label class="radio">
                                <input type="radio" name="delivery" value="Почта России">
                                <span class="pseudo"></span>
                                Почта России
                            </label>
                            <label class="radio">
                                <input type="radio" name="delivery" value="Самовывоз">
                                <span class="pseudo"></span>
                                Самовывоз
                            </label>
                            <!-- <div class="delivery-cost">
                                Стоимость доставки &mdash; <span class="delivery-cost-value">0</span> руб.
                            </div> -->
                        </div>
                        <div class="inputs-group group">
                            <div class="inputs-group-title">
                                Выбор способа оплаты:
                            </div>
                            <label class="radio">
                                <input type="radio" name="payment" value="Наличными курьеру" checked="checked">
                                <span class="pseudo"></span>
                                Наличными курьеру
                            </label>
                            <label class="radio">
                                <input type="radio" name="payment" value="Картой курьеру">
                                <span class="pseudo"></span>
                                Картой курьеру
                            </label>
                            <!-- <label class="radio">
                                <input type="radio" name="payment" value="Картой on-line">
                                <span class="pseudo"></span>
                                Картой On-line
                            </label> -->
                        </div>

                </div>
                <div class="cart-checkout">
                    <div class="checkout-title">
                        Сумма заказа:
                    </div>
                    <div class="checkout-price">
                        <span class="checout-price-value"><?=$summ?></span> руб
                    </div>
                    <div class="checkout-delivery">
                        <span class="checkout-title">Стоимость доставки:</span><span class="checkout-delivery-cost">300</span> руб
                    </div>
                    <div class="btn filled dark oformZakaz">Заказать</div>
                </div>
                <?
                }
                ?>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>