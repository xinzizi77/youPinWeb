<?php
    require_once("../SqlAbout/sqlfunction.php");
    require_once("../SqlAbout/sqlfunction_58city.php");
    // $_SESSION['emailLogin'] = 'admin@admin.com';
    // echo $_SESSION['emailLogin']."<br>";

    // if(isset($_SESSION['emailLogin'])){
        // if(isset($_POST['submit'])){
            $oldPw = $_POST['oldPw'];
            $newPw_1 = $_POST['newPw'];
            $Pw_check = $_POST['Pw_check'];
            $oldPw = md5($oldPw);
            // echo $oldPw."<br>";        
            $newPw = md5($newPw_1);
            // echo $newPw."<br>";        
            $Pw_check =md5($Pw_check);
            // echo $Pw_check."<br>";
            
            selectin("email,password", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
            // var_dump($row);
            if($_SESSION['emailLogin'] == $row['email'] and $oldPw == $row['password']){
                // echo 1;
                if(strlen($newPw_1) < 6 or strlen($newPw_1) > 32){
                    echo "warning";//提示密码不得小于6位或者大于32位
                }else{
                    if($newPw !== $Pw_check){
                        echo "warning1";//提示两次输入的密码不一致
                    }else{
                        if($oldPw == $newPw){
                            echo "warning2";//提示用户修改的密码不得与原密码一致
                        }else{
                            update("user_table", "password='{$newPw}'", "email='{$_SESSION['emailLogin']}'");
                            echo "success";//提示用户修改成功
                        }
                    }
                }
            }
            else{
                echo "noSame";
            }
        // }
    // }
?>