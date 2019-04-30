<?php
    require_once("SqlAbout/sqlfunction.php");
    require_once("SqlAbout/sqlfunction_58city.php");


    if(isset($_SESSION['emailLogin'])){
        if(isset($_POST['id'])){
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

            selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
            $u_id = $row['id'];

            selectin_c("u_id", "job", "id='{$_POST['id']}'", "findOne");
            //判断当前信息是否为当前用户所发布的
            if($row['u_id'] == $u_id){
                update_c("job", "jobName='{$jobName}',type='{$type}',monthMoney='{$monthMoney}',needPeople='{$needPeople}',eduRequire='{$eduRequire}',expRequire='{$expRequire}',area_a='{$area_a}',area_b='{$area_a}',area_c='{$area_c}',place='{$place}',conditions='{$conditions}',manager_name='{$manager_name}',phoneNumber='{$company_phone}',main='{$main}',info_main='{$info_main}',company_name='{$company_name}'", "id='{$_POST['id']}'");
                echo "change success";
            }
        }
    }
?>