<?php
header('Content-type:text/json');


require_once("../../SqlAbout/sqlfunction.php");
require_once("../../SqlAbout/sqlfunction_58city.php");
require_once("../../SqlAbout/sqlfunction_farm.php");

// echo $_GET['search']."<br>";
// echo $_GET['require']."<br>";
// if(empty($_GET['search']))echo 1;
// if(empty($_GET['require']))echo 3;
if (!empty($_GET['search']) & !empty($_GET['require']) ){
    // echo "搜索和筛选同时存在";
    // echo 1;
    selectin_f("*", "tendency", "maintype LIKE '%{$_GET['search']}%' and maintype='{$_GET['require']}'", "findAll");
    if (empty($rows)) {
        // echo 2;
        selectin_f("*", "tendency", "type LIKE '%{$_GET['search']}%' and maintype='{$_GET['require']}'", "findAll");
        if (empty($rows)) {
            // echo 3;
            selectin_f("*", "tendency", "place LIKE '%{$_GET['search']}%' and maintype='{$_GET['require']}'", "findAll");
            if (empty($rows)) {
                // echo 4;
                selectin_f("*", "tendency", "price LIKE '%{$_GET['search']}%' and maintype='{$_GET['require']}'", "findAll");
                if (empty($rows)) {
                    // echo 5;
                    selectin_f("*", "tendency", "time LIKE '%{$_GET['search']}%' and maintype='{$_GET['require']}'", "findAll");
                    if (empty($rows)) {
                        echo "没有想要的信息";
                        $Req = 0;
                        $page = 0;
                        die;                        
                    }
                } else {
                    $Req = count($rows);
                    $page = ceil(count($rows) / 10);
                }
            } else {
                $Req = count($rows);
                $page = ceil(count($rows) / 10);
            }
        } else {
            $Req = count($rows);
            $page = ceil(count($rows) / 10);
        }
    } else {
        $Req = count($rows);
        $page = ceil(count($rows) / 10);
    }
} else if (!empty($_GET['search']) & empty($_GET['require'])) {
    // echo "只存在搜索";
    selectin_f("*", "tendency", "maintype LIKE '%{$_GET['search']}%'", "findAll");
    // echo 1;
    if (empty($rows)) {
        // echo 2;
        selectin_f("*", "tendency", "type LIKE '%{$_GET['search']}%'", "findAll");
        if (empty($rows)) {
            // echo 3;
            selectin_f("*", "tendency", "place LIKE '%{$_GET['search']}%'", "findAll");
            if (empty($rows)) {
                // echo 4;
                selectin_f("*", "tendency", "price LIKE '%{$_GET['search']}%'", "findAll");
                if (empty($rows)) {
                    // echo 5;
                    selectin_f("*", "tendency", "time LIKE '%{$_GET['search']}%'", "findAll");
                    if (empty($rows)) {
                        // echo "没有想要的信息";
                        $Req = 0;
                        $page = 0;
                        // die;
                    }
                } else {
                    $Req = count($rows);
                    $page = ceil(count($rows) / 10);
                }
            } else {
                $Req = count($rows);
                $page = ceil(count($rows) / 10);
            }
        } else {
            $Req = count($rows);
            $page = ceil(count($rows) / 10);
        }
    } else {
        $Req = count($rows);
        $page = ceil(count($rows) / 10);
    }
} else if (empty($_GET['search']) & !empty($_GET['require'])) {
    // echo "只存在筛选";
    // echo 1;
    selectin_f("*", "tendency", "maintype='{$_GET['require']}'", "findAll");
    $Req = count($rows);
    $page = ceil(count($rows) / 10);
} else {
    // echo "没有输入关键字";
    select_f("*", "tendency", "findAll");
    $Req = count($rows);
    $page = ceil(count($rows) / 10);
}
// var_dump($rows);die;
$arrs = [];
if (isset($_GET['page'])) {
    $pageOut = $_GET['page'];
} else {
    $pageOut = 1;
}
$i = ($pageOut - 1) * 10;
for (; $i < $pageOut * 10; $i++) {
    if (empty($rows[$i])) {
        break;
    }
    $arr = array(
        "id" => $rows[$i][0],
        "maintype" => $rows[$i][1],
        "time" => $rows[$i][2],
        "type" => $rows[$i][3],
        "place" => $rows[$i][4],
        "price" => $rows[$i][5],
        "rows" => $Req,
        "page" => $page
    );
    array_push($arrs, $arr);
}
echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
