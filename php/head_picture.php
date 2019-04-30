<?php
    require_once("SqlAbout/sqlfunction.php");
    require_once("SqlAbout/sqlfunction_58city.php");

    // $_SESSION['emailLogin'] = "admin@admin.com";
    
    if(isset($_SESSION['emailLogin'])){
        //先判断用户是否是登陆的状态
        selectin("p_id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");    
        $picture_name = $row['p_id'];
        //从数据库中取出p_id
        if(isset($row)){
        //先看看是否存在p_id            
            if (file_exists("../upload/" . $picture_name)){
                //判断该头像文件是否存在，若不存在则无法输出
                    $src = "upload/".$picture_name;
                    echo $src;
                    /*头像文件的取出,图片必须备份
                    * $src即位头像的相对路径
                    */
            }else{
                echo "false";
                //图片文件不存在
            }
        }else{
            echo "warning";
            //不存在头像，用户信息有误或者用户不存在
        }
    }
?>