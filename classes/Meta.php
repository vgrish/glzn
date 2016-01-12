<?php

class Meta extends ConnectDB {
    function select($table,$name_en) {
        if ($table == 'section') {
            $select = parent::$DBH->prepare("SELECT * FROM {$table} WHERE name_en='$name_en'");
            $select->execute();
            $row = $select->fetch();
            $id = $row['id'];
            $select = parent::$DBH->prepare("SELECT * FROM pages WHERE section=$id");
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } elseif ($table == 'price') {
            $select = parent::$DBH->prepare("SELECT * FROM {$table} WHERE id=$name_en");
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            $select = parent::$DBH->prepare("SELECT * FROM {$table} WHERE name_en='$name_en'");
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}