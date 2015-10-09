<?php


$db_config = array();

$db_config['host'] = 'localhost';
$db_config['dbase'] = 'aura';
$db_config['login'] = 'aura';
$db_config['password'] = 'DsKPK86Ej5V8Httc';

$link = mysql_connect($db_config['host'], $db_config['login'], $db_config['password']);
mysql_select_db($db_config['dbase'], $link);
mysql_query("SET NAMES 'cp1251'" , $link);
?>
