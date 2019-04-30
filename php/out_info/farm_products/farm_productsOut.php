<?php
require_once("../../SqlAbout/sqlfunction.php");
require_once("../../SqlAbout/sqlfunction_58city.php");
require_once("../../SqlAbout/sqlfunction_farm.php");

function Get_info($type)
{
    global $rows;
    selectin_f("*", "tendency", "maintype='{$type}'", "findAll");
    // var_dump($rows);
    if (isset($_GET['page'])) {
        $pageOut = $_GET['page'];
    } else {
        $pageOut = 1;
    }

    $Req = count($rows);
    $page = ceil(count($rows) / 10);
    
//传值  页数page和物品种类maintype
    $i = ($pageOut - 1) * 10;
    for (; $i < $pageOut * 10; $i++) {
        // print_r($rows[$i]);
        if (!isset($rows[$i][2]) || $rows[$i][2] == '') {
            break;
        }
        $arrs = array(
            "maintype" => $rows[$i][0],
            "time" => $rows[$i][1],
            "type" => $rows[$i][2],
            "place" => $rows[$i][3],
            "price" => $rows[$i][4],
            "rows" => $Req,
            "page" => $page
        );

        echo json_encode($arrs, JSON_UNESCAPED_UNICODE);

    }
}

header('Content-type:text/json');
// $type = "mangguo";
$_GET['page'] = 1;
if (isset($_GET['maintype'])) {
    $type = $_GET['maintype'];
    Get_info($type);
}

?>