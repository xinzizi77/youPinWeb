<?php
header('Content-type:text/json');


require_once("../../SqlAbout/sqlfunction.php");
require_once("../../SqlAbout/sqlfunction_58city.php");
require_once("../../SqlAbout/sqlfunction_farm.php");

// selectin_f("*","tendency","")
// select_theSame_out_f("type", "tendency","findAll");
// var_dump($rows);
// select_theSame_f("*", "tendency", "type", "mangguo", "findAll");
// for ($i = 0; $i < count($rows); $i++) {
    // var_dump($rows[$i]);
    // if ($rows[$i][3] !== $rows[$i + 1][3]) {
        // if (!isset($rows[$i + 1][3])) {
            // break;
        // }
        // echo "<br><h1>other</h1>";
        // continue;
    // }
// }
// $_GET['maintype'] = "mangguo";
// $_GET['type'] = "澳芒";


$maintype = $_GET['maintype'];
$type = $_GET['type'];
$priceAdd = 0;
selectin_f("*", "tendency", "maintype='{$maintype}' and type='{$type}'", "findAll");
// var_dump($rows);die;
foreach ($rows as $value) {
    $strlen = strlen($value[5]);//价格的长度
    $prices = substr($value[5], 0, $strlen - 7);//提取价格
    $priceLen = strlen($prices);
    $units = substr($value[5], $strlen - 3, 3);//提取他的单位

    if ($priceLen >= 8) {
        // echo $prices . "<br>";
        preg_match_all('/(\d+)\.(\d+)/is', $prices, $arr);
        //正则表达式取出数字
        $firstNum = (float)$arr[0][0];
        $secondNum = (float)$arr[0][1];
        $prices = ($firstNum+$secondNum)/2;
        // 计算平均值
        // echo $prices . "<br>";        
    }

    // echo $units."<br>";
    $priceAdd = $priceAdd + (float)$prices;
    $avg = $priceAdd / count($rows);
    if ($units == "斤") {
        if ($prices >= $avg + 50) {
            continue;
        }
    }

    if ($units == "箱" | $units == "盒") {
        continue;
    }

    // echo (float)$prices . $units . "<br>";
    $place[] = $value[4];
    $price[] = (float)$prices;
    $time[] = $value[2];
}
if (empty($place) && empty($price)) {
    echo "没有数据";
} else {
    $arrs["time"] = $time;
    $arrs["place"] = $place;
    $arrs["price"] = $price;

    echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
}
// print_r($arrs);

