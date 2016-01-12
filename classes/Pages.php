<?php

class Pages extends ConnectDB {
    function select($name_en) {
        $select = parent::$DBH->prepare("SELECT * FROM section WHERE name_en='$name_en'");
        $select->execute();
        $row = $select->fetch();
        $id = $row['id'];
        $select = parent::$DBH->prepare("SELECT * FROM pages WHERE section=$id");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function selectMenu() {
        $select = parent::$DBH->prepare("SELECT * FROM section");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    function getCat() {
        $select = parent::$DBH->prepare("SELECT * FROM section WHERE name_en != 'home' AND  name_en != 'cart' ORDER BY nn ASC");
        $select->execute();
        $count = $select->rowCount();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        if ($count == 0) {
            return false;
        }
        $arr_cat = array();
        if ($count != 0) {
            foreach ($result as $results) {
                if(empty($arr_cat[$results['parent']])) {
                    $arr_cat[$results['parent']] = array();
                }
                $arr_cat[$results['parent']][] = $results;
            }
            return $arr_cat;
        }
    }

    function viewCatLi($arr,$parent) {
        if(empty($arr[$parent])) { return; }
        if ($parent != 0) { echo '<ul class="dropdown-menu">'; }
        foreach ($arr[$parent] as $arrays) {
            echo '<li class="nav-dropdown"><a href="'.self::$prefix.'pages/'.$arrays["name_en"].'" class="dropdown-toggle">'.$arrays['name_ru'].'</a>';
            $this->viewCatLi($arr,$arrays['id']);
            echo '</li>';
        }
        if ($parent != 0) { echo '</ul>'; }
    }
}