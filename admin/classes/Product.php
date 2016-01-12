<?php

class Product extends ConnectDB {
    function selectAll() {
        $select = parent::$DBH->prepare("SELECT * FROM price ORDER BY `nn` ASC");
        $select->execute();
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        }
        else {
            return $select->fetchAll(PDO::FETCH_ASSOC);;
        }
    }

    function selectId($id) {
        $select = parent::$DBH->prepare("SELECT * FROM price WHERE id=$id");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function selectSectionId($id) {
        $select = parent::$DBH->prepare("SELECT catalog.id as id, catalog.name_ru as name FROM price LEFT JOIN catalog ON catalog.id=price.section WHERE price
.id=$id");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function insertPhoto($array,$lastId) {
        foreach ($array as $arrays) {
            $insert = parent::$DBH->prepare("INSERT INTO price_photo (id,price_id,color,src) VALUES (NULL,'$lastId','{$arrays['color']}','{$arrays['photo']}')");
            $result = $insert->execute();
        }
        return $result;
    }

    function updateSql() {
        return
            $update_zakaz = "UPDATE price SET section=:section,name=:name,nomer=:nomer,brand=:brand,viscous=:viscous,type=:type,volume=:volume,price=:price,text=:text,related=:related,attr=:attr,
title=:title,description=:description,keywords=:keywords,img=:img,img_title=:img_title,img_alt=:img_alt WHERE id=:id";
    }

    function update ($sql,$section,$name,$nomer,$brand,$viscous,$type,$volume,$price,$text,$related,$attr,$title,$description,$keywords,$img,$img_title,$img_alt,$id) {
        $update = parent::$DBH->prepare($sql);
        $update->bindParam(':section',$section);
        $update->bindParam(':name',$name);
        $update->bindParam(':nomer',$nomer);
        $update->bindParam(':brand',$brand);
        $update->bindParam(':viscous',$viscous);
        $update->bindParam(':type',$type);
        $update->bindParam(':volume',$volume);
        $update->bindParam(':price',$price);
        $update->bindParam(':text',$text);
        $update->bindParam(':related',$related);
        $update->bindParam(':attr',$attr);
        $update->bindParam(':title',$title);
        $update->bindParam(':description',$description);
        $update->bindParam(':keywords',$keywords);
        $update->bindParam(':img',$img);
        $update->bindParam(':img_title',$img_title);
        $update->bindParam(':img_alt',$img_alt);
        $update->bindParam(':id',$id);
        $result = $update->execute();
        return $result;
    }
} 