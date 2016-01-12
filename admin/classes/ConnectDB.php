<?php

class ConnectDB {
    protected  $host='glzn.mysql';
    protected  $dbname='glzn_db';
    protected  $user='glzn_mysql';
    protected  $pass='foXE+4dO';
    static   $DBH;
    static $bd='glzn_db';

    function __construct() {
        try {
            self::$DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            self::$DBH->exec("set names utf8");
        }
        catch(PDOException $e) {
            die('Ошибка: ' . $e->getMessage());
        }
    }
}


