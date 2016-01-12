<?php

class Product extends ConnectDB {
    function select($name_en,$idx,$items) {
        $lim = $idx*$items;
        $select = parent::$DBH->prepare("SELECT * FROM catalog WHERE name_en='$name_en'");
        $select->execute();
        $row = $select->fetch();
        $id = $row['id'];
        $select = parent::$DBH->prepare("SELECT * FROM price WHERE section=$id limit $lim , $items");
        $select->execute();
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    function selectCount($name_en) {
        $select = parent::$DBH->prepare("SELECT * FROM catalog WHERE name_en='$name_en'");
        $select->execute();
        $row = $select->fetch();
        $id = $row['id'];
        $select = parent::$DBH->prepare("SELECT * FROM price WHERE section=$id");
        $select->execute();
        $count = $select->rowCount();
        return $count;
    }

    function selectBest() {
        $select = parent::$DBH->prepare("SELECT * FROM price WHERE sale=1 ORDER BY `nn` ASC limit 3");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    function selectNew() {
        $select = parent::$DBH->prepare("SELECT * FROM price WHERE new=1 ORDER BY `nn` ASC limit 2");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    function selectNameParent($id) {
        $select = parent::$DBH->prepare("SELECT * FROM catalog WHERE id=$id");
        $select->execute();
        $row = $select->fetch();
        $catalog = $row['name_ru'];
        return $catalog;
    }

    function selectRelated($str) {
        $select = parent::$DBH->prepare("SELECT * FROM price WHERE $str");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}