<?php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

//修改发布信息的时候先从这里读取放到页面
// $_POST['id'] =  1007;
if (isset($_POST['id'])) {
        // echo 1;
    selectin_c("*", "job", "id='{$_POST['id']}'", "findAll");
        // var_dump($rows);
    if (isset($rows)) {
        if ($rows[0][14] == '') {
            $manerger_name = " ";
        } else {
            $manerger_name = $rows[0][14];
        }
            // echo $manerger_name;die;
        if ($rows[0][15] == '') {
            $company_phone = ' ';
        } else {
            $company_phone = $rows[0][15];
        }

        $arr = array(
            "id" => $rows[0][0],
            "jobName" => $rows[0][2],
            "type" => $rows[0][3],
            "monthMoney" => $rows[0][5],
            "needPeople" => $rows[0][6],
            "eduRequire" => $rows[0][7],
            "expRequire" => $rows[0][8],
            "area_a" => $rows[0][9],
            "area_b" => $rows[0][10],
            "area_c" => $rows[0][11],
            "place" => $rows[0][12],
            "conditions" => $rows[0][13],
            "manager_man" => $manerger_name,
            "company_phone" => $company_phone,
            "main" => $rows[0][16],
            "info_main" => $rows[0][17]
        );

        header('Content-type:text/json');

        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    }
}
?>