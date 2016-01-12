<?php session_start();

class ConfigSites {
    static $prefix = "/";
    static $desc_name = '<div class="desc">Введите ваше имя</div>';
    static $desc_phone = '<div class="desc">Введите ваш телефон</div>';
    static $desc_email = '<div class="desc">Введите ваш E-mail</div>';
    static $desc_ques = '<div class="desc">Коментарий к заказу</div>';
    static $emailsArr = 'mokselleweb@yandex.ru|glzn.orders@gmail.com';
    static $phoneFormat = 'one';
    static $sitename = "GLZN";
    static $shopId = "32602"; // яндекс касса
    static $scid = "23674"; // яндекс касса

    public static function sessionId(){
        return session_id();
    }

    public static function today(){
        return date("Y-m-d H:i:s");
    }

    public static  function phoneField($confPhone){
        if ($confPhone == 'one') {
            $phone_field = '<label class="required phone"><input type="text" class="form-control" name="phone" placeholder="Ваш телефон"></label><br>';
        } else {
            $phone_field = '<label class="phone required"><input type="text" name="phone1" maxlength="5" placeholder="+7" value="+7"></label><label class="phone required"><input type="text" name="phone2" maxlength="6" placeholder="123"></label><label class="phone required"><input type="text" name="phone3" maxlength="10" placeholder="4567890"></label><br>';
        }
        return $phone_field;
    }

}