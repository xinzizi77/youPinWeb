<?php
    require_once("./SqlAbout/sqlfunction.php");

    $company_name    =   $_POST['company_name'];
    $company_type    =   $_POST['company_type'];
    $company_property=   $_POST['company_property'];
    $company_info    =   $_POST['company_info'];
    $charger_man     =   $_POST['charger_man'];
    $company_phone   =   $_POST['company_phone'];
    $company_place_p =   $_POST['company_place_p'];
    $company_place_c =   $_POST['company_place_c'];
    $main_place      =   $_POST['main_place'];

    
    selectin("*", "user_table","email='{$_SESSION['emailLogin']}'", "findOne");
    // var_dump($row);
    if(isset($row)){
        $u_id            =   $row['id'];

        selectin("*", "company", "u_id='{$u_id}'", "findOne");
        if(!isset($row)){
            upload("company", "u_id,company_name,company_type,company_property,company_info,charger_man,company_phone,company_place_p,company_place_c,main_place", "'{$u_id}','{$company_name}','{$company_type}','{$company_property}','{$company_info}','{$charger_man}','{$company_phone}','{$company_place_p}','{$company_place_c}','{$main_place}'");
            echo "success";
            echo "upload";
        }else{
            update("company", "company_name='{$company_name}',company_type='{$company_type}',company_property='{$company_property}',company_info='{$company_info}',charger_man='{$charger_man}',company_phone='{$company_phone}',company_place_p='{$company_place_p}',company_place_c='{$company_place_c}',main_place='{$main_place}'", "u_id='{$u_id}'");
            echo "success";
            echo "update";
        }
    }else{
        echo "false";
    }
?>