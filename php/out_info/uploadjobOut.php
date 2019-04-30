<?php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

    //发布的招聘的管理与取出
    // $_SESSION['emailLogin'] = "admin@admin.com";
if (isset($_SESSION['emailLogin'])) {
    selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
    $u_id = $row['id'];

    selectin_c("*", "job", "u_id='{$u_id}'", "findAll");
        // var_dump($rows);
    if (isset($rows)) {
        $arrs = [];
        for ($i = 0; $i < count($rows); $i++) {
            if ($rows[$i][14] == '') {
                $manerger_name = " ";
            } else {
                $manerger_name = $rows[$i][14];
            }
                // echo $manerger_name;die;
            if ($rows[$i][15] == '') {
                $company_phone = ' ';
            } else {
                $company_phone = $rows[$i][15];
            }
            $arr = array(
                "id" => $rows[$i][0],
                "jobName" => $rows[$i][2],
                "type" => $rows[$i][3],
                "monthMoney" => $rows[$i][5],
                "needPeople" => $rows[$i][6],
                "eduRequire" => $rows[$i][7],
                "expRequire" => $rows[$i][8],
                "area_a" => $rows[$i][9],
                "area_b" => $rows[$i][10],
                "area_c" => $rows[$i][11],
                "place" => $rows[$i][12],
                "conditions" => $rows[$i][13],
                "manager_man" => $manerger_name,
                "company_phone" => $company_phone,
                "main" => $rows[$i][16],
                "info_main" => $rows[$i][17]
            );
            array_push($arrs, $arr);
        }

        header('Content-type:text/json');

        echo json_encode($arrs, JSON_UNESCAPED_UNICODE);

    } else {
        echo "nothing";
        return;
    }
}
?>