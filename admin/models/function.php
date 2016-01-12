<?
if (!empty($_COOKIE['sid'])) {
    session_id($_COOKIE['sid']);
}
session_start();
require_once 'classes/Auth.class.php';

if (!Auth\User::isAuthorized()) {
	header("Location: lock.php");
	exit();
}

$active_a = "";
$active_b = "";
$active_c = "";
$active_d = "";
$active_e = "";
$active_f = "";
$active_g = "";
$active_h = "";

function del_extra($srt) {
	$srt = str_replace(',',' ', $srt);
	$srt = str_replace('.',' ', $srt);
	$srt = str_replace('/',' ', $srt);
	$srt = str_replace(' ','-', $srt);
	return $srt;
}

function date_exp ($datetime) {
	list($date,$time) = explode(' ', $datetime);
	return $date;
}

function time_exp ($datetime) {
	list($date,$time) = explode(' ', $datetime);
	return $time;
}

function data_russian ($date) {
	list($y,$m,$d) = explode('-', $date);
	$date_new = $d.".".$m.".".$y;
	return $date_new;
}

require_once 'classes/ConnectDB.php';
require_once 'classes/DBase.php';
require_once 'classes/Install.php';
$settings = new Install();
$data_settings = $settings->select();
?>