<?php
require_once("../SqlAbout/sqlfunction.php");

if (isset($_SESSION['emailLogin'])) {
    selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
    $u_id = $row['id'];
    selectin("*", "company", "u_id='{$u_id}'", "findOne");
        // var_dump($row);
    if (isset($row)) {
        $arr = array(
            "company_name" => $row['company_name'],
            "company_type" => $row['company_type'],
            "company_property" => $row['company_property'],
            "company_info" => $row['company_info'],
            "charger_man" => $row['charger_man'],
            "company_phone" => $row['company_phone'],
            "company_place_p" => $row['company_place_p'],
            "company_place_c" => $row['company_place_c'],
            "main_plcae" => $row['main_place']
        );

        header('Content-type:text/json');

        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    } else {
        echo "false";//数据库为空
    }

}
?>