<?
mysql_connect("u388224.mysql.masterhost.ru", "u388224", "]9aERE]s4fe");
mysql_select_db("u388224");
mysql_query('SET NAMES "utf8";');

require_once('lib/YandexMoney.php');
require_once('sample/consts.php');



main();
function main()
{
    ob_start();
    print_r($_POST);
    $message = ob_get_contents();
    ob_end_clean();

mail('tyrin@mokselle.com', 'Notification details', $message);

    if($_POST['codepro']!='false')
        return mail('tyrin@mokselle.com', 'Мы получили YM с кодом протекции', "Мы не можем автоматически получаете этот платеж.\n\n $message");


    $str=$_POST['notification_type'] . '&' .
        $_POST['operation_id'] . '&' .
        $_POST['amount'] . '&' .
        $_POST['currency'] . '&' .
        $_POST['datetime'] . '&' .
        $_POST['sender'] . '&' .
        $_POST['codepro'] . '&секретный код со страницы https://sp-money.yandex.ru/myservices/online.xml&' .
        $_POST['label'];

    if(sha1($str)!=$_POST['sha1_hash'])
        return mail('tyrin@mokselle.com', 'Поддельные уведомления', $message);


    $ym = new YandexMoney(CLIENT_ID);

    $token='410012153352644.6B26694E0A15363B88E95E5777D2DEDCB70346A4A0B20B6FE002AACF8AE2FC4B439DC118C7D158A056048824556B2A7F718FB1FB2B89F719072A141DAA2899E66BD810A2C71D0562BC4B8469787A590B6F95B0F864621A09502BAB53F7D4B5832EE3E0D5D67AD77BCC9744E906E13F796799C4A0C78574D17BD75A80A2EDC123';
    $resp = $ym->operationDetail($token, $_POST['operation_id']);
    var_dump($resp);

    $message .= "\r\n". var_export($_POST, 1) . var_export($resp);

    if($resp->isSuccess())
        mail('tyrin@mokselle.com', 'Мы получили платеж', $message);
    else
        mail('tyrin@mokselle.com', 'Мы не получили оплату ... Хм ... Почему?', $message);

    $operation_id = $_POST['operation_id'];
    $sender = $_POST['sender'];
    $amount = $_POST['amount'];
    $datetime = $_POST['datetime'];
    preg_match('/i(\d+);/', $resp->getMessage(), $m);
    $invoice_id = $m[1];
    $nZakaz = $_POST['label'];

    $r=mysql_query("INSERT INTO it_payment_ym (`id`, `operation_id`, `sender`, `amount`, `datetime`, `invoice_id`, `zakaz_id`) VALUES (NULL,'$operation_id', '$sender', '$amount', '$datetime', '$invoice_id', '$nZakaz')");
    if(!$r)
        mail('tyrin@mokselle.com', 'Проблема для вставки it_payment_ym', $message . mysql_error());


}//main
?>