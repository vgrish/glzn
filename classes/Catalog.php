<?php
class Catalog extends ConnectDB {
    public static function getCat() {
        $select = parent::$DBH->prepare("SELECT * FROM catalog ORDER BY nn ASC");
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

    public static function viewCatLi($arr,$parent) {
        if(empty($arr[$parent])) { return; }
        if ($parent == 0) { echo '<ul class="sub-menu catalog-js">'; }
        else { echo '<ul class="sub-sub-menu">'; }
        foreach ($arr[$parent] as $arrays) {
            if ($parent==0) {
                $class="sub-item";
            } else {
                $class="sub-sub-item";
            }
            echo '<li class="'.$class.'">
                  <a href="'.ConfigSites::$prefix.'catalog/'.$arrays["name_en"].'" data-parent="'.$parent.'">'.$arrays["name_ru"].'</a>';
            self::viewCatLi($arr,$arrays['id']);
            echo '</li>';
        }
        if ($parent == 0) { echo '<li class="sub-item"><a href="'.ConfigSites::$prefix.'certificates">Сертификаты</a></li></ul>'; }
        else { echo '</ul>'; }
    }
}