<?php
class Pages extends ConnectDB {

    public static function selectId($id) {
        $select = parent::$DBH->prepare("SELECT * FROM section WHERE id=$id");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function PagesSelect($id) {
        $select = parent::$DBH->prepare("SELECT * FROM pages WHERE section=$id");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }


    function insertSectionSql() {
        return
            $insert_zakaz = "INSERT INTO `section` (`id`,`parent`,`nn`,`name_en`,`name_ru`) VALUES (NULL,:parent,:nn,:name_en,:name_ru)";
    }

    function insertSection ($sql,$parent,$name_en,$name_ru) {
        $bd = self::$bd;
        $select = parent::$DBH->prepare("SELECT auto_increment FROM information_schema.tables WHERE table_name='section' AND table_schema='$bd'");
        $select->execute();
        $row = $select->fetch();
        $next = $row['auto_increment'];

        $insert = parent::$DBH->prepare($sql);
        $insert->bindParam(':parent',$parent);
        $insert->bindParam(':nn',$next);
        $insert->bindParam(':name_en',$name_en);
        $insert->bindParam(':name_ru',$name_ru);
        $result = $insert->execute();
        return $result;
    }

    function updateSectionSql() {
        return
            $update_zakaz = "UPDATE `section` SET `parent` = :parent, `name_en` = :name_en, `name_ru` = :name_ru WHERE id=:id";
    }

    function updateSection ($sql,$parent,$name_en,$name_ru,$id) {
        $update = parent::$DBH->prepare($sql);
        $update->bindParam(':parent' , $parent);
        $update->bindParam(':id' , $id);
        $update->bindParam(':name_en' , $name_en);
        $update->bindParam(':name_ru' , $name_ru);
        $result = $update->execute();
        return $result;
    }

    public static function getCat() {
        $select = parent::$DBH->prepare("SELECT * FROM section ORDER BY nn ASC");
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
            echo '<li class="dd-item" data-id="'.$arrays["id"].'">
                  <span class="pull-right">
                      <a title="Перейти в категорию: '.$arrays["name_ru"].'" href="pages.php?id='.$arrays['id'].'" class="btn btn-xs main btn-success"><i class="fa fa-link"></i></a>
                      <a title="Редактировать категорию: '.$arrays["name_ru"].'" class="btn btn-xs main btn-info edit" data-id="'.$arrays['id'].'" data-parent="'.$arrays['parent'].'" data-title="pages" data-toggle="modal" data-target=".section"><i class="fa fa-pencil"></i></a>
                      <a title="Удалить категорию: '.$arrays["name_ru"].'" href="?delete='.$arrays["id"].'&title=section" class="btn btn-xs main btn-danger" onclick="return confirm(\'Удалиь?\');"><i class="fa fa-times"></i></a>
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
            echo '<option value="'.$arrays['id'].'">';
            for ($i=0;$i<$level;$i++) {
                echo "&nbsp;&nbsp;&nbsp;";
            }
            echo "-&nbsp;";
            echo $arrays["name_ru"].'</option>';
            self::viewCatOptions($arr, $arrays['id'], $level+1);
        }
    }

    function saveSort($id,$parent,$nn) {
        $update = parent::$DBH->prepare("UPDATE `section` SET `parent` = $parent, `nn` = $nn WHERE id=$id");
        $result = $update->execute();
        return $result;
    }
}