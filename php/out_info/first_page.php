<?php
header('Content-type:text/json');
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");
    // $_GET['page'] = 12;
    // $_SESSION['emailLogin']= "admin@admin.com";


    //筛选信息
if (isset($_GET['search']) & !empty($_GET['search'])) {
    if (isset($_GET['require']) and isset($_GET['require2'])) {
        $require = $_GET['require'];
        $require2 = $_GET['require2'];
            // echo $require;
            // echo $require2;
        selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$require2}%' and jobName LIKE '%{$_GET['search']}%'", "findAll");

    } else if (isset($_GET['require'])) {
        $require = $_GET['require'];
            // echo $require;
        selectin_c("*", "job", "area_a LIKE '%{$require}%' and jobName LIKE '%{$_GET['search']}%'", "findAll");

    } else if (isset($_GET['require2'])) {
        $require2 = $_GET['require2'];
            // echo $require2;
        selectin_c("*", "job", "type LIKE '%{$require2}%' and jobName LIKE '%{$_GET['search']}%'", "findAll");

    } else {
        selectin_c("*", "job", "jobName LIKE '%{$_GET['search']}%'", "findAll");
            // echo count($rows).'|';

    }
    if (empty($rows)) {
        if (isset($_GET['require']) and isset($_GET['require2'])) {
            $require = $_GET['require'];
            $require2 = $_GET['require2'];
                    // echo $require;
                    // echo $require2;
            selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$require2}%' and type LIKE '%{$_GET['search']}%'", "findAll");
        } else if (isset($_GET['require'])) {
            $require = $_GET['require'];
                    // echo $require;
            selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$_GET['search']}%'", "findAll");
        } else if (isset($_GET['require2'])) {
            $require2 = $_GET['require2'];
                    // echo $require2;
            selectin_c("*", "job", "type LIKE '%{$require2}%' and type LIKE '%{$_GET['search']}%'", "findAll");
        } else {
            selectin_c("*", "job", "type LIKE '%{$_GET['search']}%'", "findAll");
        }
        if (empty($rows)) {
            if (isset($_GET['require']) and isset($_GET['require2'])) {
                $require = $_GET['require'];
                $require2 = $_GET['require2'];
                            // echo $require;
                            // echo $require2;
                selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$require2}%' and company_name LIKE '%{$_GET['search']}%'", "findAll");
            } else if (isset($_GET['require'])) {
                $require = $_GET['require'];
                            // echo $require;
                selectin_c("*", "job", "area_a LIKE '%{$require}%' and company_name LIKE '%{$_GET['search']}%'", "findAll");
            } else if (isset($_GET['require2'])) {
                $require2 = $_GET['require2'];
                            // echo $require2;
                selectin_c("*", "job", "type LIKE '%{$require2}%' and company_name LIKE '%{$_GET['search']}%'", "findAll");
            } else {
                selectin_c("*", "job", "company_name LIKE '%{$_GET['search']}%'", "findAll");
                            // echo count($rows).'|';
            }
            if (empty($rows)) {
                if (isset($_GET['require']) and isset($_GET['require2'])) {
                    $require = $_GET['require'];
                    $require2 = $_GET['require2'];
                                    // echo $require;
                                    // echo $require2;
                    selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$require2}%' and main LIKE '%{$_GET['search']}%'", "findAll");
                } else if (isset($_GET['require'])) {
                    $require = $_GET['require'];
                                    // echo $require;
                    selectin_c("*", "job", "area_a LIKE '%{$require}%' and main LIKE '%{$_GET['search']}%'", "findAll");
                } else if (isset($_GET['require2'])) {
                    $require2 = $_GET['require2'];
                                    // echo $require2;
                    selectin_c("*", "job", "type LIKE '%{$require2}%' and main LIKE '%{$_GET['search']}%'", "findAll");
                } else {
                    selectin_c("*", "job", "main LIKE '%{$_GET['search']}%'", "findAll");
                                    // echo count($rows).'|';
                }
                if (empty($rows)) {
                    if (isset($_GET['require']) and isset($_GET['require2'])) {
                        $require = $_GET['require'];
                        $require2 = $_GET['require2'];
                                            // echo $require;
                                            // echo $require2;
                        selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$require2}%' and info_main LIKE '%{$_GET['search']}%'", "findAll");
                    } else if (isset($_GET['require'])) {
                        $require = $_GET['require'];
                                            // echo $require;
                        selectin_c("*", "job", "area_a LIKE '%{$require}%' and info_main LIKE '%{$_GET['search']}%'", "findAll");
                    } else if (isset($_GET['require2'])) {
                        $require2 = $_GET['require2'];
                                            // echo $require2;
                        selectin_c("*", "job", "type LIKE '%{$require2}%' and info_main LIKE '%{$_GET['search']}%'", "findAll");
                    } else {
                        selectin_c("*", "job", "info_main LIKE '%{$_GET['search']}%'", "findAll");
                                            // echo count($rows).'|';
                    }
                    if (empty($rows)) {
                        $arrs = [];
                        
                        echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
                        die;
                                      //没有用户湘想找的工作
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
} else if (isset($_GET['require']) and isset($_GET['require2'])) {
    $require = $_GET['require'];
    $require2 = $_GET['require2'];
        // echo $require2;
        // echo $require;
    selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$require2}%'", "findAll");
    $Req = count($rows);
    $page = ceil(count($rows) / 10);
} else if (isset($_GET['require'])) {
    $require = $_GET['require'];
        // echo $require;
    selectin_c("*", "job", "area_a LIKE '%{$require}%'", "findAll");
    $Req = count($rows);
    $page = ceil(count($rows) / 10);
} else if (isset($_GET['require2'])) {
    $require2 = $_GET['require2'];
        // echo $require2;
    selectin_c("*", "job", "type LIKE '%{$require2}%'", "findAll");
    $Req = count($rows);
    $page = ceil(count($rows) / 10);
} else {
    select_c("*", "job", "findAll");
        // echo count($rows).'|';
    $Req = count($rows);
    $page = ceil(count($rows) / 10);
}
    // echo count($rows)."<br>";//数据的数量
    // $page = ceil(count($rows)/10);

    // echo $page;
    // echo $Req;die;
$arrs = [];
if (isset($_SESSION['emailLogin'])) {
    selectin("love_id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
    if (!isset($row['love_id'])) {
        $rowOut = "";
    }

    $rowOut = explode("|", $row['love_id']);
        //取出用户所收藏的内容
    if (isset($_GET['page'])) {
        $pageOut = $_GET['page'];
    } else {
        $pageOut = 1;
    }
    $i = ($pageOut - 1) * 10;
    for (; $i < $pageOut * 10; $i++) {
        if (!isset($rows[$i][3]) || $rows[$i][3] == '') {
            break;
        }

        //如果不存值，跳出循环
        for ($a = 0; $a < count($rowOut); $a++) {
            if (isset($rowOut[$a]) & $rowOut[$a] !== "") {
                if ($rowOut[$a] == $rows[$i][0]) {
                                // echo $rows[$i][0];
                                if(!isset($rowOut[$a]) && $rowOut[$a] == ""){
                                    break;
                                }
                                // echo $rowOut[0];
                                // die;
                                // echo $rowOut[$a]."被收藏<br>";
                    $collect = "true";
                    break;
                                //根据collect是true还是false判断收藏按钮是否常亮
                } else {
                    $collect = "false";
                }
            } else {
                $collect = "false";
                continue;
            }
        }
        
                    // var_dump($rows[$i]);die;
        $arr = array(
            "jobName" => $rows[$i][2],
            "eduReq" => $rows[$i][7],
            "expReq" => $rows[$i][8],
            "type" => $rows[$i][3],
            "nedPeo" => $rows[$i][6],
            "place1" => $rows[$i][9],
            "place2" => $rows[$i][10],
            "place3" => $rows[$i][11],
            "thePlace" => $rows[$i][12],
            "monMoy" => $rows[$i][5],
            "weal" => $rows[$i][13],
            "id" => $rows[$i][0],
            "collect" => $collect,
            "rows" => $Req,
            "page" => $page
        );
        array_push($arrs, $arr);
    }

    // header('Content-type:text/json');
            
            // echo $require2;
    echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
} else {
    if (isset($_GET['page'])) {
        $pageOut = $_GET['page'];
    } else {
        $pageOut = 1;
    }
    $collect = "false";
    $i = ($pageOut - 1) * 10;
    for (; $i < $pageOut * 10; $i++) {

        if (!isset($rows[$i][3]) || $rows[$i][3] == '') {
            break;
        }
        $arr = array(
            "jobName" => $rows[$i][2],
            "eduReq" => $rows[$i][7],
            "expReq" => $rows[$i][8],
            "type" => $rows[$i][3],
            "nedPeo" => $rows[$i][6],
            "place1" => $rows[$i][9],
            "place2" => $rows[$i][10],
            "place3" => $rows[$i][11],
            "thePlace" => $rows[$i][12],
            "monMoy" => $rows[$i][5],
            "weal" => $rows[$i][13],
            "id" => $rows[$i][0],
            "collect" => "false",
            "rows" => $Req,
            "page" => $page
        );
        array_push($arrs, $arr);
    }

    // header('Content-type:text/json');
        
        // echo $require2;
    echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
}

?>