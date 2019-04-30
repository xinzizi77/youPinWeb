<?php
header('Content-type:text/json');

require_once("../../SqlAbout/sqlfunction.php");
require_once("../../SqlAbout/sqlfunction_58city.php");
require_once("../../SqlAbout/sqlfunction_farm.php");

$_GET['maintype'] = "mangguo";
// $_GET['type'] = "澳芒";
$maintype = $_GET['maintype'];
// $type = $_GET['type'];
select_theSame_out_f("type", "tendency", $maintype, "findAll");
$arrs = [];
for ($i = 0; $i < count($rows); $i++) {
    // echo $rows[$i][0] . "<br>";
    array_push($arrs, $rows[$i][0]);
}

echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
