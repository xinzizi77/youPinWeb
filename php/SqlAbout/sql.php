<?php
require_once("function.php");
require_once("sqlfunction.php");


$host = "localhost";
$user = "root";
$password = "";

$db = "user_info";

$db1 = "58city";

$db2 = "farm_products";

$conn = mysqlConnect($host,$user,$password,$db);
$conn_c = mysqlConnect($host,$user,$password,$db1);
$conn_f = mysqlConnect($host,$user,$password,$db2);
?>