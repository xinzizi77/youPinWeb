<?php
    header('Content-type:text/json');

    require_once("../SqlAbout/sqlfunction.php");
    require_once("../SqlAbout/sqlfunction_58city.php");
    require_once("../SqlAbout/sqlfunction_farm.php");

    select_c("*","job","findAll");
    // var_dump($rows);

    $arrs = [];
    for($i=0;$i<=5;$i++){
        if(empty($rows[$i])){
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
        );

        array_push($arrs, $arr);

        echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
        
    }
?>