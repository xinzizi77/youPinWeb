<?php
require_once("../SqlAbout/sqlfunction.php");

    // $_SESSION['emailLogin'] = "admin@admin.com";
if (isset($_SESSION['emailLogin'])) {
    selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
    $u_id = $row['id'];
    selectin("*", "userinfo", "u_id='{$u_id}'", "findAll");
        // var_dump($rows);
        // echo count($rows);
    $arrs = [];
    for ($i = 0; $i < count($rows); $i++) {
        if (isset($rows)) {
            if ($rows[$i][6] == 1) {
                $sex = "男";
            } else if ($rows[$i][6] == 2) {
                $sex = "女";
            }
            $arr = array(
                "jobType" => $rows[$i][2],
                "work_plcae" => $rows[$i][3],
                "want_money" => $rows[$i][4],

                "name" => $rows[$i][5],
                "sex" => $sex,
                "birth" => $rows[$i][7],
                "phone_number" => $rows[$i][8]
            );

            array_push($arrs, $arr);
        } else {
            echo "false";
            return;
        }
    }

    header('Content-type:text/json');

    echo json_encode($arrs, JSON_UNESCAPED_UNICODE);

}
?>