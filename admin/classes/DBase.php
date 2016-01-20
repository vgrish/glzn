<?php

class IncludeClass extends ConnectDB {
    public static function inc($array) {
        foreach ($array as $name) {
            require_once 'classes/'.$name.'.php';
        }

    }
}

class DB extends ConnectDB {
    public static function select($table) {
        $select = parent::$DBH->prepare("SELECT * FROM $table");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public static function selectSql($sql) {
        $select = parent::$DBH->prepare($sql);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public static function selectID($table,$id) {
        $select = parent::$DBH->prepare("SELECT * FROM $table WHERE id=$id");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public static function selectParam($table,$attr,$val,$sort,$limit) {
        if (isset($sort) and $sort) { list($row,$s) = explode("|",$sort); $sorted = "ORDER BY  `$row` $s "; } else { $sorted = ""; }
        if (isset($limit) and $limit) { $limited = $limit; } else { $limited = ""; }

        $select = parent::$DBH->prepare("SELECT * FROM $table WHERE $attr='$val' $sorted $limited");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public static function selectParam1($table,$attr,$val,$sort,$limit) {
        if (isset($sort) and $sort) { list($row,$s) = explode("|",$sort); $sorted = "ORDER BY  `$row` $s "; } else { $sorted = ""; }
        if (isset($limit) and $limit) { $limited = $limit; } else { $limited = ""; }

        $select = parent::$DBH->prepare("SELECT * FROM $table $sorted $limited");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }
	
	
	
    public static function selectAI($table) {
        $bd = self::$bd;
        $select = parent::$DBH->prepare("SELECT auto_increment FROM information_schema.tables WHERE table_name='$table' AND table_schema='$bd'");
        $select->execute();
        $row = $select->fetch();
        $ai = $row['auto_increment'];
        return $ai;
    }

    public static function  insertSql($table,$arr) {
        $sql = "INSERT INTO ".$table." (id,";
        $i=1;$j=1;
        foreach ($arr as $k=>$v) {
            if (count($arr)==$i) { $f=""; } else {$f=",";}
            $sql .= '`'.$k.'`'.$f;
            $i++;
        }
        $sql .=") VALUES (NULL,";
        foreach ($arr as $k=>$v) {
            if (count($arr)==$j) { $f=""; } else {$f=",";}
            $sql .= ":".$k.$f;
            $j++;
        }
        $sql .=")";

        return $sql;
    }

    public static function insert($sql,$arr) {
        $insert = parent::$DBH->prepare($sql);
        foreach ($arr as $k=>$v) {
            $insert->bindParam(':'.$k , Rename::trimStr($v));
        }
        $insert->execute();
        $result = self::$DBH->lastInsertId();
        return $result;
    }

    public static function updateSql($table,$arr) {
        $sql = "UPDATE ".$table." SET ";
        $i=1;
        foreach ($arr as $k=>$v) {
            if (count($arr)==$i) { $f=""; } else {$f=",";}
            $sql .= "`".$k."`=:".$k.$f;
            $i++;
        }
        $sql .= " WHERE id=:id";
        return $sql;
    }

    public static function update($sql,$arr,$id) {
        $update = parent::$DBH->prepare($sql);
        $update->bindParam(':id' , $id);
        foreach ($arr as $k=>$v) {
            $update->bindParam(':'.$k , Rename::trimStr($v));
        }
        $result = $update->execute();
        return $result;
    }

    public static function updatePM($sql) {
        $update = parent::$DBH->prepare($sql);
        $update->execute();
    }

    public static function saveSort($table,$arr,$id) {
        $sql = "UPDATE `$table` SET ";
        $i=1;
        foreach ($arr as $k=>$v) {
            if (count($arr)==$i) { $f=""; } else {$f=", ";}
            $sql .= "`".$k."`='".$v."'".$f;
            $i++;
        }
        $sql .=" WHERE id=$id";
        $update = parent::$DBH->prepare($sql);
        $res = $update->execute();
        return $res;
    }

    public static function deletePhoto($id) {
        $select = parent::$DBH->prepare("SELECT * FROM price_photo where price_id=$id");
        $select->execute();
        $arrays = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($arrays as $array) {
            $del = "../".$array['src'];
            unlink($del);
        }

        $delete = parent::$DBH->prepare("DELETE FROM price_photo WHERE price_id=$id");
        $delete->execute();
    }

    public static function deleteCart($id) {
        $delete = parent::$DBH->prepare("DELETE FROM cart WHERE id=$id");
        $delete->execute();
    }

    public static function deleteCartLogin($session) {
        $delete = parent::$DBH->prepare("DELETE FROM cart WHERE login='$session'");
        $delete->execute();
    }

 }

class Delete extends ConnectDB {
    public static function del($table,$id) {
        if ($table == "section") {
            $delete = parent::$DBH->prepare("DELETE FROM pages WHERE section=$id");
            $delete->execute();
        }
        $delete = parent::$DBH->prepare("DELETE FROM {$table} WHERE id=$id");
        $delete->execute();
    }
}

class UploadImg extends ConnectDB {
    function upload($file,$nowPhoto) {
        $dir = '../photo/';
        if ($file["photo"]["error"] == UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($file["photo"]['name'], PATHINFO_EXTENSION));
            $photo = $dir.uniqid().".".$ext;
            move_uploaded_file($file["photo"]['tmp_name'], $photo);
            if ($nowPhoto) {
                unlink("../".$nowPhoto);
            }
        } elseif ($nowPhoto) {
            $photo = "../".$nowPhoto;
        } else {
            $photo = "";
        }
        $photo = str_replace('../', '', $photo);
        return $photo;
    }
}

class AttrValue extends ConnectDB {
    public static function conbine($attr,$value) {
        $data_attr = serialize(array_combine($attr, $value));
        return $data_attr;
    }
}

class Rename {
    public static function replace($str) {
        $str = self::trimStr($str);
        $str = self::translitIt($str);
        $str = self::replaceStr($str);
        return $str;
    }

    public static function translitIt($str) {
        $tr = array(
            "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
            "Д"=>"d","Е"=>"e","Ё"=>"e","ё"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
            "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
            "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
            "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
            "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
            "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
            "Q"=>"q","W"=>"w","E"=>"e","R"=>"r","T"=>"t",
            "Y"=>"y","U"=>"u","I"=>"i","O"=>"o","P"=>"p",
            "A"=>"a","S"=>"s","D"=>"d","F"=>"f","G"=>"g",
            "H"=>"h","J"=>"j","K"=>"k","L"=>"l","Z"=>"z",
            "C"=>"c","V"=>"v","B"=>"b","N"=>"n","M"=>"m", " "=>"-"
        );
        return strtr($str,$tr);
    }

    public static function trimStr($str) {
        $str = preg_replace('/[\s]{2,}/u',' ',$str);
        $str = trim($str) ;
        return $str;
    }

    public static function replaceStr($str) {
        $str = str_replace(' ','-', $str);
        $str = str_replace(',','', $str);
        $str = str_replace('.','', $str);
        $str = str_replace('/','', $str);
        return $str;
    }
}

class ParseJson {
    public static function parseJsonArray($jsonArray, $parentID = 0) {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray['children'])) {
                $returnSubSubArray = self::parseJsonArray($subArray['children'], $subArray['id']);
            }
            $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }
}