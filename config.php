<?
require_once 'classes/ConfigSites.php';
$config = new ConfigSites();
require_once 'admin/classes/ConnectDB.php';
require_once 'admin/classes/DBase.php';
require_once 'classes/Catalog.php';
$obj2 = new Catalog();
$obj1 = new DB();
$obj3 = new ConnectDB();
