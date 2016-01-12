<?php
class Cart extends ConnectDB {
    function select() {
        $id_session = self::sessionId();
        $select = parent::$DBH->prepare("SELECT cart.id AS id, cart.kol AS kol, price.id AS id_price, price.name AS name, price.viscous AS viscous, price.volume AS volume, price.price AS price, price.img AS img, price.img_title AS img_title, price.img_alt AS img_alt FROM cart LEFT JOIN price ON price.id = cart.id_price WHERE cart.id_session='$id_session'");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function selectCount() {
        $id_session = self::sessionId();
        $select = parent::$DBH->prepare("SELECT * FROM cart WHERE id_session='$id_session'");
        $select->execute();
        $count = $select->rowCount();
        return $count;
    }

    function insertSql() {
        return
            $insert_zakaz = "INSERT INTO cart (id,id_session,id_price,kol,date) VALUES (NULL,:id_session,:id_price,:kol,:date)";
    }

    function insert($sql,$id,$kol) {
        $session = self::sessionId();
        $date = self::today();
        $insert = parent::$DBH->prepare($sql);
        $insert->bindParam(':id_session',$session);
        $insert->bindParam(':id_price',$id);
        $insert->bindParam(':kol',$kol);
        $insert->bindParam(':date',$date);
        $result = $insert->execute();
        return $result;
    }

    function updateKolSql() {
        return $update_zakaz = "UPDATE `cart` SET `kol` = :kol WHERE id=:id";
    }

    function updateKol ($sql,$id,$kol) {
        $update = parent::$DBH->prepare($sql);
        $update->bindParam(':id' , $id);
        $update->bindParam(':kol' , $kol);
        $result = $update->execute();
        return $result;
    }

    function deleteCart($id) {
        $select = parent::$DBH->prepare("DELETE FROM `cart` WHERE id=$id");
        $select->execute();
    }
}