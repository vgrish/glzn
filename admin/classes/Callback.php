<?php
class Callback extends ConnectDB {
    function select() {
        $select = parent::$DBH->prepare("SELECT * FROM callback ORDER BY `date` DESC");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

}