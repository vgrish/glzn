<?php

class News extends ConnectDB {
    function select() {
        $select = parent::$DBH->prepare("SELECT * FROM news ORDER BY `id` DESC limit 2");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}