<?php
require_once "../classes/ConnectDB.php";
require_once "../classes/DBase.php";
$obj = new DB();
switch ($_POST["form"]) {
    case 'news': echo json_encode(DB::selectID("news",$_POST["id"])); break;

    case 'provider': echo json_encode(DB::selectID("provider",$_POST["id"])); break;

    case 'kurs': echo json_encode(DB::selectID($_POST["form"],$_POST["id"])); break;

    case 'provider_status': echo json_encode(DB::selectID($_POST["form"],$_POST["id"])); break;

    case 'zakaz': echo json_encode(DB::selectID($_POST["form"],$_POST["id"])); break;

    case 'clients': echo json_encode(DB::selectID($_POST["form"],$_POST["id"])); break;

    case 'section': echo json_encode(DB::selectID('catalog',$_POST["id"])); break;

    case 'pages_client': echo json_encode(DB::selectID($_POST["form"],$_POST["id"])); break;

    case 'pages_press': echo json_encode(DB::selectID($_POST["form"],$_POST["id"])); break;

    case 'edit_status': DB::update(DB::updateSql("price",array($_POST['col']=>$_POST["attr"])),array($_POST['col']=>$_POST["attr"]),$_POST["id"]); break;

    case 'savesort':
        $data = $_POST["data"];
        $menu = json_decode($data, true);
        $readbleArray = ParseJson::parseJsonArray($menu);
        $a = 1;
        $res = array();
        foreach ($readbleArray as $k=>$v) {
            if ($_POST["table"] == "catalog") {
                $res[] = DB::saveSort($_POST["table"], array("parent" => $readbleArray[$k]["parentID"], "nn" => $a), $readbleArray[$k]["id"]);
                $a++;
            }
            if ($_POST["table"] == "price") {
                $res[] = DB::saveSort($_POST["table"], array("nn" => $a), $readbleArray[$k]["id"]);
                $a++;
            }
        }
        echo json_encode($res);
    break;

    case 'pages':
        require_once "../classes/Pages.php";
        $obj = new Pages();
        $result = $obj->selectId($_POST["id"]);
        echo json_encode($result);
        break;

    case 'selectPagesParent':
        require_once "../classes/Pages.php";
        $obj = new Pages();
        $result = $obj->selectId($_POST["id"]);
        echo json_encode($result);
        break;

}