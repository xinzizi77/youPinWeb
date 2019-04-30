<?php
    //忘记密码找回密码的php
    require_once("../SqlAbout/sqlfunction.php");
    require_once("../SqlAbout/sqlfunction_58city.php");
    require_once("../LoginAbout/image_captcha.php");

        $email = $_POST['email'];
        //邮箱
        $captcha = $_POST['captcha'];
        //验证码
        $newpassword = $_POST['newpassword'];
        //新密码
        $newpassword = md5($newpassword);
        $pw_check = $_POST['newpw_check'];
        // 确认密码
        $pw_check = md5($pw_check);
        //密码采用md5格式加密
        selectin("email,password", "user_table", "email='{$email}'", "findOne");
        $row1 = $row;
        if(!isset($row1)){
            echo "该邮箱不存在";
        }else{           
            if($newpassword == $pw_check){
                $oldpassword = $row1['password'];
                    if($newpassword == $oldpassword){
                        echo "新密码不得与原密码一致";
                    }else{
                        if(strlen($_POST['newpassword'])<6){
                            echo "密码不得小于6位";
                        }else{
                                update("user_table", "password='$newpassword'", "email='$email'");
                                echo "修改成功";
                        }
                    }
            }else{
                echo "两次输入的密码不一致，请重新输入";                   
            
            }
        }


?>
