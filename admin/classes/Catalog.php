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
        if ($parent == 0) { echo '<ol class="dd-list">'; }
        else { echo '<ol class="dd-list">'; }
        foreach ($arr[$parent] as $arrays) {
            if (isset($_GET["id"]) and $_GET["id"] == $arrays["id"]) {
                $style = 'style="color:red;"';
            } else {
                $style = '';
            }
            echo '<li class="dd-item" data-id="'.$arrays["id"].'" '.$style.'>
                  <span class="pull-right">
                      <a title="Перейти в категорию: '.$arrays["name_ru"].'" href="production.php?id='.$arrays['id'].'" class="btn btn-xs main btn-success"><i class="fa fa-link"></i></a>
                      <a title="Редактировать категорию: '.$arrays["name_ru"].'" class="btn btn-xs main btn-info edit" data-id="'.$arrays['id'].'" data-parent="'.$arrays['parent'].'" data-title="section" data-toggle="modal" data-target=".section"><i class="fa fa-pencil"></i></a>
                      <a title="Удалить категорию: '.$arrays["name_ru"].'" href="?delete='.$arrays["id"].'&title=catalog" class="btn btn-xs main btn-danger" onclick="return confirm(\'Удалить?\');"><i class="fa fa-times"></i></a>
                  </span>';
            echo '<div class="dd-handle">'.$arrays["name_ru"].'</div>';
            self::viewCatLi($arr,$arrays['id']);
            echo '</li>';
        }
        if ($parent == 0) { echo '</ol>'; }
        else { echo '</ol>'; }
    }

    public static function viewCatOptions($arr,$parent = 0, $level=0) {
        if(empty($arr[$parent])) { return; }
        foreach ($arr[$parent] as $arrays) {
            if(isset($nowSection) and $nowSection) {
                $selected = "selected=\"selected\"";
            } else {
                $selected = "";
            }
            echo '<option value="'.$arrays['id'].'" '.$selected.'>';
            for ($i=0;$i<$level;$i++) {
                echo "&nbsp;&nbsp;&nbsp;";
            }
            echo "-&nbsp;";
            echo $arrays["name_ru"].'</option>';
            self::viewCatOptions($arr, $arrays['id'], $level+1);
        }
    }
}