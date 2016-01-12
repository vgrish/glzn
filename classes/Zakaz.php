<?php

class Zakaz extends ConnectDB {
    function insertSql() {
        return $insert_zakaz = "INSERT INTO `zakaz` (`id`, `name`, `phone`, `email`, `comment`, `id_price`, `sun`, `date`) VALUES (NULL,:name,:phone,:email,:comment,:idprice,:sun,:date)";
    }

    function insert($sql,$name,$phone,$email,$comment) {
        $session = self::sessionId();
        $date = self::today();

        // преобразовываем корзину в "id товара"=>"количество"
        $selectTovar = parent::$DBH->prepare("SELECT id_price,kol FROM cart WHERE id_session='$session'");
        $selectTovar->execute();
        $arr = $selectTovar->fetchAll(PDO::FETCH_ASSOC);
        $idprice = serialize($arr);

        // Узнаем сумму заказа
        $selectSumm = parent::$DBH->prepare("SELECT SUM( price.price * cart.kol ) AS sun FROM cart LEFT JOIN price ON price.id = cart.id_price WHERE id_session = '$session'");
        $selectSumm->execute();
        $row = $selectSumm->fetch();
        $sun = $row['sun'];


        $selectClient = parent::$DBH->prepare("SELECT * FROM clients WHERE email = '$email'");
        $selectClient->execute();
        $count = $selectClient->rowCount();
        if ($count == 0) {
            $insertClient = parent::$DBH->prepare("INSERT INTO clients (id,name,phone,email) VALUES (NULL,'$name','$phone','$email')");
            $insertClient->execute();
        }

        $insert = parent::$DBH->prepare($sql);
        $insert->bindParam(':name',$name);
        $insert->bindParam(':phone',$phone);
        $insert->bindParam(':email',$email);
        $insert->bindParam(':comment',$comment);
        $insert->bindParam(':idprice',$idprice);
        $insert->bindParam(':sun',$sun);
        $insert->bindParam(':date',$date);
        $insert->execute();

        $result = self::$DBH->lastInsertId();

        $delete = parent::$DBH->prepare("DELETE FROM `cart` WHERE id_session='$session'");
        $delete->execute();

        return $result;
    }
}