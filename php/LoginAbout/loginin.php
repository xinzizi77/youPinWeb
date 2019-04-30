<?php
require_once("../SqlAbout/sqlfunction_58city.php");
require_once("../SqlAbout/sqlfunction.php");
    //session_start写在function中
    // if(isset($_POST['submit'])){
$email = $_POST['email'];
$password = $_POST['password'];
        // $email = "admin@admin.com";
        // $password = "123456";
$password = md5($password);
        //密码用md5进行加密，数据库也是用md5加密进行储存，进行对比

selectin("email,username", "user_table", "email='$email'", "findOne");
        // var_dump($row);
if (!isset($row)) {
            //先进行一次查询，看邮箱账户是否存在
    echo "邮箱账户不存在";
} else {
    selectin("email,password,username", "user_table", "email='$email' and password='$password'", "findOne");
            //上一步已经验证邮箱存在，所以不用再次判断row是否存在
            // var_dump($row);
            // die;
    $emailSQL = $row['email'];
    $passwordSQL = $row['password'];
    $username = $row['username'];
            // echo "<script> alert('{$emailSQL}') </script>";
    if ($email == $emailSQL and $password == $passwordSQL) {
                //如果账号密码都正确返回值1
        echo 1;
                //账户和密码正确允许登陆，并且记录session中的邮箱名
        $_SESSION['emailLogin'] = $email;
        $_SESSION['username'] = $username;
                // echo $_SESSION['emailLogin'];
    } else {
        if (empty($password)) {
                    //判断密码是否为空
            echo "密码不得为空";
        }
        if ($password !== $passwordSQL) {
            echo "密码有误";
                    //判断密码是否正确
        }
    }
}
    // }
?>
