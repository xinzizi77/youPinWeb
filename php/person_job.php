<?php
    require_once("SqlAbout/sqlfunction.php");
    require_once("SqlAbout/sqlfunction.php");

    if(isset($_SESSION['emailLogin'])){
        $job_type   =    $_POST['job_type'];
        $work_place  =    $_POST['work_place'];
        $want_money =    $_POST['want_money'];

        $name       =    $_POST['name'];
        $sex        =    $_POST['sex'];

        // $job_type = 1;
        // $work_place = 2;
        // $want_money = 4;
        // $name = 4;
        // $sex = 1;
        // $birth = "2000-01-01";
        // $phone_number = "123456789";
        

        if($sex == '男'){$sex =1;}
        else if($sex == '女'){$sex = 2;}
        $birth      =    $_POST['birthday'];
        $phone_number =  $_POST['phone_number'];
        selectin("*", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
        if(isset($row)){
            $u_id = $row['id'];
            selectin("*" ,"userinfo", "u_id='{$u_id}'", "findOne");
            if(!isset($row)){
            //取出当前用户在user_table中的id值并存到userinfo中
                upload("userinfo", "u_id,jobType,WorkPlace,MoneyWant,name,sex,birth,phoneNumber", "{$u_id}, '{$job_type}', '{$work_place}', '{$want_money}', '{$name}', '{$sex}', '{$birth}', '{$phone_number}'");

                echo "success";
            }else{
                update("userinfo", "jobType='{$job_type}',WorkPlace='{$work_place}',MoneyWant='{$want_money}',name='{$name}',sex='{$sex}',birth='{$birth}',phoneNumber='{$phone_number}'", "u_id='{$u_id}'");
                echo "success";
            }
        }else{
            echo "false";
            //开始的数据为空，让他插入数据
        }
    }else{
        echo "login first";
    }
?>