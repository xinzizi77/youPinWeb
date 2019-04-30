<?php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

if (isset($_SESSION['emailLogin'])) {
    selectin("*", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
    if (isset($row)) {
            // var_dump($row);
            // echo $row['sex'];
        if ($row['sex'] == 1) {
            $sex = '男';
        } else if ($row['sex'] == 2) {
            $sex = '女';
        }

        if (!isset($row['birth']) or $row['birth'] == '') {
            $birth = " ";
        } else {
            $birth = $row['birth'];
        }
        $arr = array(
            "username" => $row['username'],
            "sex" => $sex,
            "birth" => $birth
        );

            header('Content-type:text/json');

        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    }
}
?>