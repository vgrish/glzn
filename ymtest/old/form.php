<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Тестовая платежная форма</title>
</head>
<body>
<form action="https://demomoney.yandex.ru/eshop.xml" method="post" target="_blank">
    <!-- Обязательные поля -->
    <input name="shopId" value="32602" type="hidden"/>
    <input name="scid" value="60095" type="hidden"/>
    <input name="sum" value="1" type="hidden">
    <input name="customerNumber" value="glzndesign" type="hidden"/>
    <input name="orderNumber" value="<?=time()?>" type="hidden" />
    <!-- <input name="shopArticleId" value="123123123" type="hidden"/> -->
Способ оплаты:<br>
    <input name="paymentType" value="PC" type="radio">Оплата из кошелька в Яндекс.Деньгах<br>
    <input name="paymentType" value="AC" type="radio">Оплата с произвольной банковской карты<br>
    <input name="paymentType" value="GP" type="radio">Оплата наличными через кассы и терминалы<br><br>
    <input type="submit" value="Заплатить"/>
</form>

</body>
</html>