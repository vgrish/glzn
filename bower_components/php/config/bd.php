<?php
@mysql_connect("localhost", "root", "root");
@mysql_select_db("baby");

@mysql_query('SET NAMES "utf8";');

$day_global = date('d');
$mes_global = date('m');
$year_global = date('Y');

function mysql_array ($sql) {
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res,MYSQL_NUM)) {
		$data[] = $row;
	}
	return $data;
}

function mysql_assoc ($sql) {
	$res = mysql_query($sql);
	$i=0;
	while ($row = mysql_fetch_assoc($res)) {
		$data[$i] = $row;
		$i++;
	}
	return $data;
}
?>