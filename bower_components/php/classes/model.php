<?php

class ConnectDB {

    protected  $host='localhost';
    protected  $dbname='baby';
    protected  $user='root';
    protected  $pass='root';
    static   $DBH;

    function __construct() {
        try {
            self::$DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            self::$DBH->exec("set names utf8");
        }
        catch(PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
}

class Queries {
    /**
     * Выбираем все категории
     * @return string
     */
    function allDataCategories() {
        return
            $categories = "SELECT * FROM categories";
    }

    /**
     * Выбираем все подкатегории
     * @return string
     */
    function allDataSubcategories() {
        return
            $subcategories = "SELECT * FROM subcategories";
    }

    /**
     * Выбираем все данные из таблицы
     * @return string
     */
    static function fullDataEnterprises() {
        return
            $get_all_enterprises = "SELECT * FROM enterprises ORDER BY date DESC";
    }

    /**
     * @param $skip
     * @param $result_per_page
     * @return string
     */
    function queryForPaginator ($skip,$result_per_page) {
        return
            $query_for_paginator = "SELECT * FROM enterprises
            WHERE subcategories_id !=  'NULL'
            ORDER BY date DESC
            LIMIT $skip, $result_per_page";
    }
    /**
     * Выбираем все данные всех предприятий
     * @return string
     */
    function allDataEnterprises() {
        return
            $enterprises = "SELECT * FROM project.enterprises
        join project.subcategories
        ON subcategories_id = subcategories.id
        ORDER BY date DESC";
    }

    /**
     * Выбираем все данные всех предприятий отнсящиеся к подкатегории $ctgrid
     * @param $ctgrid
     * @return string
     */
    function selectDataEnterprises($ctgrid) {
        return
            $enterprises = "SELECT * FROM project.enterprises
        join project.subcategories
        WHERE subcategories_id=$ctgrid AND enterprises.subcategories_id = subcategories.id
        ORDER BY date DESC";
    }
    function approvedDataEnterprises(){
        return
    $approved = "SELECT *
    FROM enterprises
    WHERE subcategories_id !=  'NULL'
    ORDER BY DATE DESC";
    }
    /**
     * @return string
     */
    function notApprovedDataEnterprises(){
        return
            $enterprises = "SELECT * FROM project.enterprises
            WHERE subcategories_id IS NULL";
    }
    /**
     * Выбираем категории и подкатегории
     * @return string
     */
    function dataCtgAndSubctg() {
        return
            $CtgAndSubctg = "SELECT subcategories.id,subcategories.sub_name,subcategories.categories_id,categories.name
        FROM project.subcategories
        join project.categories
        ON categories.id=subcategories.categories_id";
    }

    /**
     * Ввод данных о предприятии в таблицу
     * @param $name
     * @param $zipcode
     * @param $address
     * @param $phone
     * @param $website
     * @param $strEmailAddress
     * @param $description_activity
     * @return string
     */
    function insertData() {
        return
            $insert_data = "INSERT INTO enterprises (name,zipcode,address,phone,website,email,description_activity)
        VALUES (:name,:zipcode,:address,:phone,:website,:strEmailAddress,:description_activity)";
    }

    /**
     * Обновляем данные о подкатегории преприятия
     * @param $subcategories_id
     * @param $enterprise_id
     * @return string
     */
    function upDate() {
        return
            $update = "UPDATE enterprises SET subcategories_id=:subcategories_id, image='logo.png' WHERE id=:enterprise_id";
    }

    /**
     * Удаляем 1 строку из таблицы
     * @param $id
     * @return string
     */
    function  deleteDate($id) {
        return
            $delete = "DELETE FROM enterprises WHERE id='$id' LIMIT 1";
    }

}
class dbQuery extends ConnectDB {
    /**
     * Выполнение запросов
     * @param $sql
     * @return array Получаем массив с данными исходя из запроса SELECT
     */
    static function getQuery ($sql) {
        $select = parent::$DBH->prepare("$sql");
        $select->execute();
        $arr = $select->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }

    /**
     * @param $sql
     * @param $name
     * @param $zipcode
     * @param $address
     * @param $phone
     * @param $website
     * @param $strEmailAddress
     * @param $description_activity
     * @return bool
     */
    function insertQuery ($sql,$name,$zipcode,$address,$phone,$website,$strEmailAddress,$description_activity) {
        $insert = parent::$DBH->prepare("$sql");
        $insert->bindParam(':name', $name);
        $insert->bindParam(':zipcode', $zipcode);
        $insert->bindParam(':address', $address);
        $insert->bindParam(':phone', $phone);
        $insert->bindParam(':website', $website);
        $insert->bindParam(':strEmailAddress', $strEmailAddress);
        $insert->bindParam(':description_activity', $description_activity);
        $end = $insert->execute();
        //print_r ($insert->errorInfo());
        return $end;
    }

    /**
     * Обновление данных о подкатегории  преприятия
     * @param $sql
     * @return bool
     */
    function getUpdate ($sql,$subcategories_id,$enterprise_id){
        $update = parent::$DBH->prepare("$sql");
        $update->bindParam(':subcategories_id',$subcategories_id);
        $update->bindParam(':enterprise_id',$enterprise_id);
        $end = $update->execute();
        return $end;
    }

    /**
     * Удаление строоки из БД
     * @param $sql
     * @return bool
     */
    function getDelete ($sql){
        $delete = parent::$DBH->prepare("$sql");
        $end = $delete->execute();
        return $end;
    }

}

class Validator {

    /**
     * Валидация URL
     * @param $url
     * @return mixed
     */
    function valid_url($url){
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Валидация email-адреса
     * @param $email
     * @return mixed
     */
    function valid_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

class Authorization extends ConnectDB
{
    /**
     * Вход зарегестрированного пользователя
     * @param $username
     * @param $password
     * @return bool
     */
    function  LogIn($username, $password)
    {
        $error_msg = " ";
        if (!isset($_SESSION['id_user'])) {
            if (!empty($username) && !empty($password)) {
                $hash = md5($password);
                $select = parent::$DBH->prepare("SELECT * FROM clients WHERE login='$username' AND pass='$hash'");
                $select->execute();
                $count = $select->rowCount();

                if ($count == 1) {
                    $row = $select->fetch();
                    $id_user = $row['id'];

                    $_SESSION['id_user'] = $id_user;

                    $username = $row['login'];
                    $_SESSION['login'] = $username;

                    return true;
                } else {
                    $error_msg = 'To enter, you must enter a valid username and password';
                    $_SESSION['error_msg'] = $error_msg;
                }

            } else {
                $error_msg = 'Name or password is not correct';
                $_SESSION['error_msg'] = $error_msg;
            }
        }
    }

    /**
     * Выход зарегестрированного пользователя
     */
    function  LogOut()
    {

        if (isset($_SESSION['id_user'])) {
            $_SESSION = array();

            session_destroy();
            return true;
        }
        /*setcookie('username', '$username', time() - 3600);
        setcookie('id', '$id', time() - 3600);
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
        header('Location:' . $home_url);*/
    }
}

class Basket extends ConnectDB {

    /**
     * @param $id_product
     * @param $kol
     * @return bool
     */

    function addBasket($id_product,$kol,$price) {
        if (isset($id_product)) {
            $today = date("Y-m-d H:i:s");
            $select = parent::$DBH->prepare("INSERT INTO basket (id,cat_price_id,price,kol,client_id,date)
        VALUES (NULL,'$id_product','$price','$kol','{$_SESSION['id_user']}','$today')");
            $select->execute();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    function deleteBasket($id){
        if (isset($id)){
            $delete = parent::$DBH->prepare("DELETE FROM basket WHERE id='$id'");
            $delete->execute();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $attr
     * @return bool
     */
    function editCount($id,$attr){
        if (isset($id)){
            if ($attr == "plus") {
                $sql = "UPDATE `basket` SET `kol` = `kol`+1 WHERE id =".$id;
            } else {
                $sql = "UPDATE `basket` SET `kol` = `kol`-1 WHERE id =".$id;
            }
            $delete = parent::$DBH->prepare($sql);
            $delete->execute();
            return true;
        } else {
            return false;
        }
    }

}

class Zakaz extends ConnectDB {
    /**
     * @param $comment
     * @param $dostavka
     * @return bool
     */
    function oformZakaz() {
        return
        $insert_zakaz = "INSERT INTO count_zakaz (id,id_client,comment,dostavka,sun,date) VALUES (NULL,:id_client,:comment,:dostavka,:sun,:today)";
    }

    function insert_zakaz ($sql,$comment,$dostavka,$sun,$today) {
        $insert = parent::$DBH->prepare($sql);
        $insert->bindParam(':id_client' , $_SESSION['id_user']);
        $insert->bindParam(':comment' , $comment);
        $insert->bindParam(':dostavka' , $dostavka);
        $insert->bindParam(':sun' , $sun);
        $insert->bindParam(':today' , $today);
        $result = $insert->execute();
        if ($result == true) {
            $lastId = parent::$DBH->lastInsertId();
            $insert = parent::$DBH->prepare("INSERT INTO `zakaz` (`id`,`nzakaz`,`id_price`,`id_client`,`kol`,`price`) SELECT '','$lastId',`cat_price_id`,`client_id`,`kol`,`price` FROM basket WHERE client_id={$_SESSION['id_user']}");
            $insert->execute();
            $delete = parent::$DBH->prepare("DELETE FROM basket WHERE client_id={$_SESSION['id_user']}");
            $delete->execute();
        }
        return $result;

    }
}