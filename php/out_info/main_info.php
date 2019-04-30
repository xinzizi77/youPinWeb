<?php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

if (isset($_GET['id'])) {
    selectin_c("*", "job", "id='{$_GET['id']}'", "findOne");
    $row1 = $row;
    if (isset($_SESSION['emailLogin'])) {
        selectin("love_id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
        $outL = explode("|", $row['love_id']);
            // print_r($outL);
        for ($i = 0; $i < count($outL); $i++) {
                // echo $outL[$i]."<br>";
            if (isset($outL[$i]) && $outL[$i] !== "") {
                if ($outL[$i] == $_GET['id']) {
                    $collect = "true";
                    break;
                } else {
                    $collect = "false";
                }
                    // echo $collect;
            } else {
                $collect = "false";
                continue;
            }

        }

    } else {
        $collect = 'false';
    }
        // selectin("love_id", "user_table", "")
        // var_dump($row);
    $arr = array(
        "id" => $row1['id'],
        "jobName" => $row1['jobName'],
        "type" => $row1['type'],
        "href" => $row1["href"],
        "monthMoney" => $row1['monthMoney'],
        "needPeople" => $row1['needPeople'],
        "eduRequire" => $row1['eduRequire'],
        "expRequire" => $row1['expRequire'],
        "area_a" => $row1['area_a'],
        "area_b" => $row1['area_b'],
        "area_c" => $row1['area_c'],
        "place" => $row1['place'],
        "conditions" => $row1['conditions'],
        "manager_name" => $row1['manager_name'],
        "company_phone" => $row1['phoneNumber'],
        "main" => $row1['main'],
        "info_main" => $row1['info_main'],
        "company_name" => $row1['company_name'],
        "collect" => $collect
    );

    header('Content-type:text/json');

    echo json_encode($arr, JSON_UNESCAPED_UNICODE);


    if (!isset($row)) {
        echo "warning";
            //数据不存在提示404错误
    }
} else {
    echo "false";
        //提示404错误
}

?>