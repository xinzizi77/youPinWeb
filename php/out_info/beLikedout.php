<?php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

    //个人收藏页的输出
    // $_SESSION['emailLogin'] = "admin@admin.com";    
    // $_SESSION['emailLogin'] = "12345678@qq.com";
if (isset($_SESSION['emailLogin'])) {
    selectin("love_id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
        //  var_dump($row);die;
    if (isset($row['love_id']) && $row['love_id'] !== '') {
            // echo 1;die;
        $rowOut = explode("|", $row['love_id']);
            // var_dump($rowOut);
        $arrs = [];
        for ($i = 0; $i < count($rowOut); $i++) {
                // echo $rowOut[$i];
            if ($rowOut[$i] == "") {
                continue;
            }
            selectin_cl("id,jobName,monthMoney,company_name,company_href,conditions", "job", "id={$rowOut[$i]}", "findOne");
                // var_dump($row);
            if (isset($row)) {
                $arr = array(
                    "id"    => $row['id'],
                    "jobName" => $row['jobName'],
                    "monthMoney" => $row['monthMoney'],
                    "company_name" => $row['company_name'],
                    "company_href" => $row['company_href'],
                    "conditions" => $row['conditions']
                );
                array_push($arrs, $arr);
            } else {
                    // echo "false";
                continue;
                    // return;
            }
        }
        header('Content-type:text/json');


        echo json_encode($arrs, JSON_UNESCAPED_UNICODE);
    } else {
        echo "nothing";
    }
}
?>