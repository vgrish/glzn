<?php
require_once "../classes/ConnectDB.php";

if (isset($_POST["pages"])) {
    require_once "../classes/Pages.php";
    $obj = new Pages();
    $data = $_POST["pages"];

    $menu = json_decode($data, true);
    $readbleArray = parseJsonArray($menu);

    $a = 1;
    foreach ($readbleArray as $k=>$v) {
        $res = $obj->saveSort($readbleArray[$k]["id"],$readbleArray[$k]["parentID"],$a);
        echo $res;
        $a++;
    }
}

//if (isset($_POST["price"])) {
//    require_once "../classes/Product.php";
//    $obj = new Product();
//    $data = $_POST["price"];
//
//    $price = json_decode($data, true);
//
//    foreach ($price as $prices) {
//        $res = $obj->saveSort($prices["id"],$prices["nn"]);
//        echo $res;
//    }
//
//}

function parseJsonArray($jsonArray, $parentID = 0) {
    $return = array();
    foreach ($jsonArray as $subArray) {
        $returnSubSubArray = array();
        if (isset($subArray['children'])) {
            $returnSubSubArray = parseJsonArray($subArray['children'], $subArray['id']);
        }
        $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
        $return = array_merge($return, $returnSubSubArray);
    }
    return $return;
}
