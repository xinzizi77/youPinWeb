<?php
    require_once("../SqlAbout/sqlfunction.php");
    require_once("../SqlAbout/sqlfunction_58city.php");
    // $_SESSION['emailLogin'] = "admin@admin.com";
    echo $_SESSION['emailLogin'];
    //根据session识别用户
    if(isset($_SESSION['emailLogin'])){
        selectin("password", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
        // var_dump($row);
        $oldpassword = $row['password'];

        if(isset($_POST['submit'])){
            $password_old = $_POST['oldpassword'];
            $password_old =md5($password_old);
            // echo "<br>".$password_old;
            $password_new = $_POST['newpassword'];
            $password_new = md5($password_new);
            // echo "<br>".$password_new."<br>";
            $pw_check = $_POST['pw_check'];
            $pw_check = md5($pw_check);

            if(empty($password_old)){
                echo "原密码不得为空";
            }else{

                if($password_old == $oldpassword){
                    if(empty($password_new)){
                        echo "密码不得为空";
                    }else if(strlen($password_new)<6 or strlen($password_new)>32){
                        echo "密码不符合规定";
                    }else if($password_new !== $pw_check){
                        echo "密码和确认密码不一致";
                    }else if($password_new == $password_old){
                        echo "新密码和原密码一致";
                    }else{
                        update("user_table", "password='{$password_new}'", "email='{$_SESSION['emailLogin']}'");
                        echo "修改成功";
                    }
                }else{
                    echo "原密码错误";
                }
            }

        }


    }
?>
