<?php
$sum = 1;
$idZakaz = "Оплата счета №000113";
print <<<HTML

<p>
Сумма платежа указана с учетом комиссии Яндекс.Денег 0.5%. Если вы будете менять сумму, пожалуйста, учтите, что к нам поступит
сумма/1.005. Также в целях упрощения расчетов, у нас ведется учет всех сумм в целых числах, поэтому копейки будут обнулены.
</p>
<p>
<b>Платежи с кодом протекции не могут быть зачислены online, поэтому просьба отправлять без кода протекции.</b>
</p>
<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/shop.xml?account=410012153352644&quickpay=shop&payment-type-choice=on&writer=seller&targets=$idZakaz&targets-hint=&default-sum=$sum&button-text=01&successURL=glzn.ru%2Fnew%2Finvoice%2Fym%2Fpayment.php&label=000113" width="450" height="253"></iframe>
HTML;
?>
