<?php
    require_once("SqlAbout/sqlfunction.php");
    require_once("SqlAbout/sqlfunction_58city.php");

    // 删除当前发布信息
    // $_POST['id'] = 3;
    if(isset($_SESSION['emailLogin'])){
        if(isset($_POST['id'])){
            selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
            $u_id = $row['id'];

            selectin_c("u_id", "job", "id='{$_POST['id']}'", "findOne");
            //判断当前信息是否为当前用户所发布的
            if($row['u_id'] == $u_id){
                del_c("job", "id='{$_POST['id']}'");
                echo "delete success";
            }else{
                echo "没有权限";
            }
        }else{
            echo "no post";
        }
    }else{
        echo "请先登陆";
    }