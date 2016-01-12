<?php
class Install extends ConnectDB {
    function select() {
        $select = parent::$DBH->prepare("SELECT * FROM install");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}