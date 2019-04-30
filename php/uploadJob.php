<?php
    require_once("SqlAbout/sqlfunction.php");
    require_once("SqlAbout/sqlfunction_58city.php");

    // $_SESSION['emailLogin'] =  'admin@admin.com';
    if(isset($_SESSION['emailLogin'])){
        selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
        $u_id = $row['id'];

        $jobName    =   $_POST['jobName'];
        $type       =   $_POST['type'];
        $monthMoney =   $_POST['monthMoney'];            
        $needPeople =   $_POST['needPeople'];
        $eduRequire =   "学历不限";



        if(isset($_POST['expRequire'])){
            $expRequire =   $_POST['expRequire'];
        }else{
            $expRequire = " ";
        }
        //经验要求
        $area_a     =   $_POST['area_a'];

        if(isset($_POST['area_b'])){
            $area_b     =   $_POST['area_b'];
        }else{
            $area_b     =   " ";
        }
        if(isset($_POST['area_c'])){
            $area_c     =   $_POST['area_c'];
        }else{
            $area_c     =   " ";
        }
        //地址
        if(isset($_POST['place'])){
            $place      =   $_POST['place'];
        }else{
            $place      =  " ";
        }
        //详细地址
        if(isset($_POST['conditions'])){
            $conditions =   $_POST['conditions'];
        }else{
            $conditions =   ' ';
        }
        //待遇
        if(isset($_POST['manager_name'])){
            $manager_name   =  $_POST['manager_name'];
        }else{
            $manager_name   =   ' ';
        }
        //经理名字
        if(isset($_POST['company_phone'])){
            $company_phone= $_POST['company_phone'];
        }else{
            $company_phone= ' ';
        }
        //公司电话或者招人的电话
        if(isset($_POST['main'])){
            $main       =   $_POST['main'];
        }else{
            $main       =   " ";
        }
        //工作简介
        if(isset($_POST['info_main'])){
            $info_main  =   $_POST['info_main'];
        }else{
            $info_main  =   "经理忙着招人，没时间写公司简介";
        }
        //公司简介
        if(isset($_POST['company_name'])){
            $company_name  =   $_POST['company_name'];
        }else{
            $company_name  =   " ";
        }
        //公司名称
        
        upload_c("job", "u_id,jobName,type,monthMoney,needPeople,eduRequire,expRequire,area_a,area_b,area_c,place,conditions,manager_name,phoneNumber,main,info_main,company_name", "'{$u_id}','{$jobName}','{$type}','{$monthMoney}','{$needPeople}','{$eduRequire}','{$expRequire}','{$area_a}','{$area_b}','{$area_c}','{$place}','{$conditions}','{$manager_name}','{$company_phone}','{$main}','{$info_main}','{$company_name}'");
        echo "success";
        
    }
?>